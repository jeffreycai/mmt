<?php
require_login();
$user = MySiteUser::getCurrentUser();

$pid = isset($vars[1]) ? $vars[1] : null;
$object = Product::findById($pid);
if ($object == null || $object->getUserId() != $user->getId()) {
  access_denied();
}

/** --------------------------------------- **/





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
    if (sizeof($files) > 1) {
      Message::register(new Message(Message::DANGER, i18n(array("en" => "Max file allowed to be uploed is 1. Please reduce uploaed files.", "zh" => "您最多可以上传1个文件，请减少上传的文件数量"))));
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
      if (!in_array(strtolower($extension), array('jpg','jpeg','png','gif'))) {
        Message::register(new Message(Message::DANGER, i18n(array("en" => "Only file with extension jpg,jpeg,png,gif is allowed. Please restrict your files with these types.", "zh" => "上传文件仅支持jpg,jpeg,png,gif，请检查您的上传文件"))));
        $error_flag = true;
        break;
      }
    }
  }
  
  // validation for $images
  $images = isset($_POST["images"]) ? strip_tags(trim($_POST["images"])) : null;
  // check upload_dir
  if (!is_dir(WEBROOT . DS . "files/user/" . $user->getId())) {
    mkdir(WEBROOT . DS . "files/user/" . $user->getId());
  }
  if (!is_writable(WEBROOT . DS . "files/user/" . $user->getId())) {
    $error_flag = true;
    Message::register(new Message(Message::DANGER, i18n(array("en" => "Upload dir is not writable.", "zh" => "上传文件夹不可写"))));
  } else {
    $files = explode("\n", trim($images));
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
      if (!in_array(strtolower($extension), array('jpg','jpeg','png','gif'))) {
        Message::register(new Message(Message::DANGER, i18n(array("en" => "Only file with extension jpg,jpeg,png,gif is allowed. Please restrict your files with these types.", "zh" => "上传文件仅支持jpg,jpeg,png,gif，请检查您的上传文件"))));
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
  
  // validation for $original_price
  $original_price = isset($_POST["original_price"]) ? strip_tags($_POST["original_price"]) : null;  
  // validation for $stock
  $stock = isset($_POST["stock"]) ? intval(strip_tags($_POST["stock"])) : 0;
  if (!preg_match('/^\d+$/', $stock)) {
    Message::register(new Message(Message::DANGER, i18n(array("en" => "Please enter a valid stock number", "zh" => "请填写一个合法的库存数"))));
    $error_flag = true;
  }
  // validation for $onshelf
  $onshelf = isset($_POST["onshelf"]) ? 1 : 0;  /// proceed submission
  
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
  
  // proceed for $images
  $files = explode("\n", trim($images));
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
  $object->setImages(implode("\n", $rtn));
  
  // proceed for $description
  $object->setDescription($description);
  
  // proceed for $price
  $object->setPrice($price);
  
  // proceed for $original_price
  $object->setOriginalPrice($original_price);
  
  // proceed for $stock
  $object->setStock($stock);
  
  // proceed for $onshelf
  $object->setOnshelf($onshelf);
  
  // proceed for user_id
  $object->setUserId($user->getId());
  
  // proceed for created_at
  $object->setCreatedAt(time());
  
  if ($error_flag == false) {
    if ($object->save()) {
      Message::register(new Message(Message::SUCCESS, i18n(array("en" => "Product has been successfully edited.", "zh" => "商品修改成功！"))));
      HTML::forwardBackToReferer();
    } else {
      Message::register(new Message(Message::DANGER, i18n(array("en" => "Product failed to be edited", "zh" => "修改商品失败"))));
    }
  }
}




/** -------------------------------**/





$html = new HTML();

$html->renderOut('user/components/html_header', array(
    'body_class' => 'products_add',
    'title' => i18n(array(
        'en' => 'Edit product',
        'zh' => '修改商品'
    ))
));
$html->output('<div class="container">');
$html->renderOut('user/components/header_general', array(
    'title' => i18n(array(
        'en' => 'Edit product',
        'zh' => '修改商品'
    )),
    'gobackuri' => uri('user/products'),
//    'right' => '<a class="addFormSubmit" href="#">'.i18n(array(
//        'en' => 'Complete',
//        'zh' => '完成'
//    )).'</a>'
));
$html->renderOut('user/products_edit', array(
    'object' => $object
));

$html->output('</div>');

$html->renderOut('user/components/html_footer');