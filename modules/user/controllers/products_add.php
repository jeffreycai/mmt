<?php
require_login();
$user = MySiteUser::getCurrentUser();



/** --------------------------------------- **/





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
  if (!is_dir(WEBROOT . DS . "files/user/" . $user->getId())) {
    mkdir(WEBROOT . DS . "files/user/" . $user->getId());
  }
  if (!is_writable(WEBROOT . DS . "files/user/" . $user->getId())) {
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
    Message::register(new Message(Message::DANGER, i18n(array("en" => "Description is required.", "zh" => "请填写description"))));
    $error_flag = true;
  }
  
  // validation for $price
  $price = isset($_POST["price"]) ? strip_tags($_POST["price"]) : null;
  if (empty($price)) {
    Message::register(new Message(Message::DANGER, i18n(array("en" => "Price is required.", "zh" => "请填写price"))));
    $error_flag = true;
  } else if (!preg_match('/^\d+(\.\d\d?)?$/', $price)) {
    Message::register(new Message(Message::DANGER, i18n(array("en" => "Please enter a valid price. e.g. 23.4", "zh" => "请填写一个合法的产品价格。例如： 23.4"))));
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
      $newname = WEBROOT . DS . "files/user/" . $user->getId() . str_replace(CACHE_DIR, "", WEBROOT . DS . $file);
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
  
  // proceed for user_id
  $object->setUserId($user->getId());
  
  if ($error_flag == false) {
    if ($object->save()) {
      Message::register(new Message(Message::SUCCESS, i18n(array("en" => "Product has been successfully added. You can continue to add new product.", "zh" => "商品添加成功！您可以继续添加新的商品"))));
      HTML::forwardBackToReferer();
    } else {
      Message::register(new Message(Message::DANGER, i18n(array("en" => "Product failed to save", "zh" => "记录产品失败"))));
    }
  }
}




/** -------------------------------**/





$html = new HTML();

$html->output('<div class="container">');

$html->renderOut('user/components/html_header', array(
    'body_class' => 'products_add',
    'title' => i18n(array(
        'en' => 'Add product',
        'zh' => '添加商品'
    ))
));
$html->renderOut('user/components/header_general', array(
    'title' => i18n(array(
        'en' => 'Add product',
        'zh' => '添加商品'
    )),
    'gobackuri' => uri('user/products'),
    'right' => '<a class="addFormSubmit" href="#">'.i18n(array(
        'en' => 'Complete',
        'zh' => '完成'
    )).'</a>'
));
$html->renderOut('user/products_add', array(
    'object' => new Product()
));

$html->output('</div>');

$html->renderOut('user/components/html_footer');