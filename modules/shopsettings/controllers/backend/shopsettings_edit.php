<?php

$id = isset($vars[1]) ? $vars[1] : null;
$object = Shopsettings::findById($id);
if (is_null($object)) {
  HTML::forward('core/404');
}

// bootstrap field widgets
FormWidgetPlupfile::bootstrap('shop_logo');

// handle form submission
if (isset($_POST['submit'])) {
  $error_flag = false;

  /// validation
  
  // validation for $shop_logo
  $shop_logo = isset($_POST["shop_logo"]) ? strip_tags(trim($_POST["shop_logo"])) : null;
  // check upload_dir
  if (!is_dir(WEBROOT . DS . "files/user")) {
    mkdir(WEBROOT . DS . "files/user");
  }
  if (!is_writable(WEBROOT . DS . "files/user")) {
    $error_flag = true;
    Message::register(new Message(Message::DANGER, i18n(array("en" => "Upload dir is not writable.", "zh" => "上传文件夹不可写"))));
  } else {
    $files = explode("\n", trim($shop_logo));
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
      if (!in_array(strtolower($extension), array('jpg','png','gif','jpeg'))) {
        Message::register(new Message(Message::DANGER, i18n(array("en" => "Only file with extension jpg,png,gif,jpeg is allowed. Please restrict your files with these types.", "zh" => "上传文件仅支持jpg,png,gif,jpeg，请检查您的上传文件"))));
        $error_flag = true;
        break;
      }
    }
  }
  
  // validation for $shop_wechat
  $shop_wechat = isset($_POST["shop_wechat"]) ? strip_tags($_POST["shop_wechat"]) : null;  
  // validation for $shop_phone
  $shop_phone = isset($_POST["shop_phone"]) ? strip_tags($_POST["shop_phone"]) : null;  
  // validation for $shop_address
  $shop_address = isset($_POST["shop_address"]) ? $_POST["shop_address"] : null;  
  // validation for $shop_email
  $shop_email = isset($_POST["shop_email"]) ? strip_tags($_POST["shop_email"]) : null;  /// proceed submission
  
  // proceed for $shop_logo
  $files = explode("\n", trim($shop_logo));
  $rtn = array();
  foreach ($files as $file) {
    $file = trim($file);
    // for cache file, we move it to its proper location 
    if (strpos($file, str_replace(WEBROOT . DS, "", CACHE_DIR)) === 0) {
      $oldname = WEBROOT . DS . $file;
      $newname = WEBROOT . DS . "files/user" . str_replace(CACHE_DIR, "", WEBROOT . DS . $file);
      rename($oldname, $newname);
      $file = str_replace(WEBROOT . DS, "", $newname);
    }
    $rtn[] = $file;
  }
  $object->setShopLogo(implode("\n", $rtn));
  
  // proceed for $shop_wechat
  $object->setShopWechat($shop_wechat);
  
  // proceed for $shop_phone
  $object->setShopPhone($shop_phone);
  
  // proceed for $shop_address
  $object->setShopAddress($shop_address);
  
  // proceed for $shop_email
  $object->setShopEmail($shop_email);
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
  'en' => 'Edit Shop settings',
  'zh' => 'Edit 微店设置',
  )),
));
$html->output('<div id="wrapper">');
$html->renderOut('core/backend/header');


$html->renderOut('shopsettings/backend/shopsettings_edit', array(
  'object' => $object
));


$html->output('</div>');

$html->renderOut('core/backend/html_footer');

exit;

