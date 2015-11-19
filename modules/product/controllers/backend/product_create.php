<?php

$object = new Product();

// bootstrap field widgets
FormWidgetPlupfile::bootstrap('thumbnail');
  
// handle form submission
if (isset($_POST['submit'])) {
  $error_flag = false;

  /// validation
  
  // validation for $title
  $title = isset($_POST["title"]) ? strip_tags($_POST["title"]) : null;
  if (empty($title)) {
    Message::register(new Message(Message::DANGER, i18n(array("en" => "title is required.", "zh" => "请填写title"))));
    $error_flag = true;
  }
  
  // validation for $thumbnail
  $thumbnail = isset($_POST["thumbnail"]) ? strip_tags(trim($_POST["thumbnail"])) : null;
  // check upload_dir
  if (!is_dir(WEBROOT . DS . "files/user/1")) {
    mkdir(WEBROOT . DS . "files/user/1");
  }
  if (!is_writable(WEBROOT . DS . "files/user/1")) {
    $error_flag = true;
    Message::register(new Message(Message::DANGER, i18n(array("en" => "Upload dir is not writable.", "zh" => "上传文件夹不可写"))));
  } else {
    $files = explode("\n", trim($thumbnail));
    // check max_file_number
    if (sizeof($files) > 8) {
      Message::register(new Message(Message::DANGER, i18n(array("en" => "Max file allowed to be uploed is 8. Please reduce uploaed files.", "zh" => "您最多可以上传8个文件，请减少上传的文件数量"))));
      $error_flag = true;
    }
    // check file extension
    foreach ($files as $file) {
      $file = trim($file);
      if (sizeof($files) == 1 && $file == "") {
        break;
      }
      $tokens = explode(".", $file);
      $extension = array_pop($tokens);
      if (!in_array(strtolower($extension), array('jpg','png','gif'))) {
        Message::register(new Message(Message::DANGER, i18n(array("en" => "Only file with extension jpg,png,gif is allowed. Please restrict your files with these types.", "zh" => "上传文件仅支持jpg,png,gif，请检查您的上传文件"))));
        $error_flag = true;
        break;
      }
    }
  }
  
  // validation for $description
  $description = isset($_POST["description"]) ? $_POST["description"] : null;
  if (empty($description)) {
    Message::register(new Message(Message::DANGER, i18n(array("en" => "description is required.", "zh" => "请填写description"))));
    $error_flag = true;
  }
  
  // validation for $price
  $price = isset($_POST["price"]) ? strip_tags($_POST["price"]) : null;
  if (empty($price)) {
    Message::register(new Message(Message::DANGER, i18n(array("en" => "price is required.", "zh" => "请填写price"))));
    $error_flag = true;
  }
  /// proceed submission
  
  // proceed for $title
  $object->setTitle($title);
  
  // proceed for $thumbnail
  $files = explode("\n", trim($thumbnail));
  $rtn = array();
  foreach ($files as $file) {
    $file = trim($file);
    // for cache file, we move it to its proper location 
    if (strpos($file, str_replace(WEBROOT . DS, "", CACHE_DIR)) === 0) {
      $oldname = WEBROOT . DS . $file;
      $newname = WEBROOT . DS . "files/user/1" . str_replace(CACHE_DIR, "", WEBROOT . DS . $file);
      rename($oldname, $newname);
      $file = str_replace(WEBROOT . DS, "", $newname);
    }
    $rtn[] = $file;
  }
  $object->setThumbnail(implode("\n", $rtn));
  
  // proceed for $description
  $object->setDescription($description);
  
  // proceed for $price
  $object->setPrice($price);
  if ($error_flag == false) {
    if ($object->save()) {
      Message::register(new Message(Message::SUCCESS, i18n(array("en" => "Record saved", "zh" => "记录保存成功"))));
      HTML::forwardBackToReferer();
    } else {
      Message::register(new Message(Message::DANGER, i18n(array("en" => "Record failed to save", "zh" => "记录保存失败"))));
    }
  }
}



$html = new HTML();

$html->renderOut('core/backend/html_header', array(
  'title' => i18n(array(
  'en' => 'Create Product',
  'zh' => 'Create 产品',
  )),
));
$html->output('<div id="wrapper">');
$html->renderOut('core/backend/header');


$html->renderOut('product/backend/product_create', array(
  'object' => $object
));


$html->output('</div>');

$html->renderOut('core/backend/html_footer');

exit;

