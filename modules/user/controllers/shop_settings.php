<?php
require_login();
$user = MySiteUser::getCurrentUser();

/** handle form submission **/
if (isset($_POST['submit'])) {
  $name = isset($_POST['name']) ? trim(strip_tags($_POST['name'])) : null;
  $introduction = isset($_POST['introduction']) ? trim(strip_tags($_POST['introduction'])) : null;
  $wechat = isset($_POST['wechat']) ? trim(strip_tags($_POST['wechat'])) : null;
  $phone = isset($_POST['phone']) ? trim(strip_tags($_POST['phone'])) : null;
  $address = isset($_POST['address']) ? trim(strip_tags($_POST['address'])) : null;
  $email = isset($_POST['email']) ? trim(strip_tags($_POST['email'])) : null;
  // validation
  $error = false;
  if (empty($name)) {
    Message::register(new Message(Message::DANGER, i18n(array(
      'en' => 'Please fill in shop name',
      'zh' => '请填写微店名称'
    ))));
    $error |= true;
  }
  // validation for shop email
  if ($email && !is_email_address($email)) {
    $error |= true;
    Message::register(new Message(Message::DANGER, '请填写正确的Email地址'));
  }
  // validation for $shop_logo
  $shop_logo = isset($_POST["shop_logo"]) ? strip_tags(trim($_POST["shop_logo"])) : null;
  // check upload_dir
  if (!is_dir(WEBROOT . DS . "files/user/".$user->getId())) {
    mkdir(WEBROOT . DS . "files/user/".$user->getId());
  }
  if (!is_writable(WEBROOT . DS . "files/user/".$user->getId())) {
    $error |= true;
    Message::register(new Message(Message::DANGER, i18n(array("en" => "Upload dir is not writable.", "zh" => "上传文件夹不可写"))));
  } else {
    $files = explode("\n", trim($shop_logo));
    // check max_file_number
    if (sizeof($files) > 1) {
      Message::register(new Message(Message::DANGER, i18n(array("en" => "Max file allowed to be uploed is 1. Please reduce uploaed files.", "zh" => "您最多可以上传1个文件，请减少上传的文件数量"))));
      $error |= true;
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
        Message::register(new Message(Message::DANGER, i18n(array("en" => "Only file with extension jpg,jpeg,png,gif is allowed. Please restrict your files with these types.", "zh" => "上传文件仅支持jpg,jpeg,png,gif，请检查您的上传文件"))));
        $error_flag = true;
        break;
      }
    }
  }

  // store in db if no error
  if ($error === false) {
    $settings = Shopsettings::findByUserid($user->getId());
    $settings = $settings ? $settings : new Shopsettings();
    
    $settings->setUserId($user->getId());
    $settings->setShopName($name);
    $settings->setShopIntroduction($introduction);
    $settings->setShopWechat($wechat);
    $settings->setShopPhone($phone);
    $settings->setShopAddress($address);
    $settings->setShopEmail($email);
    
    // store shop logo
    $files = explode("\n", trim($shop_logo));
    $rtn = array();
    foreach ($files as $file) {
      $file = trim($file);
      // for cache file, we move it to its proper location 
      if (strpos($file, str_replace(WEBROOT . DS, "", CACHE_DIR)) === 0) {
        $oldname = WEBROOT . DS . $file;
        $newname = WEBROOT . DS . "files/user/".$user->getId() . str_replace(CACHE_DIR, "", WEBROOT . DS . $file);
        rename($oldname, $newname);
        $file = str_replace(WEBROOT . DS, "", $newname);
      }
      $rtn[] = $file;
    }
    $settings->setShopLogo(implode("\n", $rtn));
    
    if ($settings->save()) {
      Message::register(new Message(Message::SUCCESS, i18n(array(
        'en' => 'Your shop settings have been successfully updated!',
        'zh' => '您的微店设置已成功更新！'
      ))));
      HTML::forwardBackToReferer();
    } else {
      Message::register(new Message(Message::DANGER, i18n(array(
        'en' => 'Shop settings failed to be saved',
        'zh' => '微店设置更新失败'
      ))));
    }
  }
}

/** prepare form **/
// bootstrap field widgets
FormWidgetPlupfile::bootstrap('shop_logo');


/** presentation **/
$html = new HTML();

$html->renderOut('user/components/html_header', array(
    'body_class' => 'shop shop_settings',
    'title' => i18n(array(
        'en' => 'Change shop settings',
        'zh' => '微店设置'
    ))
));
$html->output('<div class="container">');
$html->renderOut('user/components/header_general', array(
    'title' => i18n(array(
        'en' => 'Change shop settings',
        'zh' => '微店设置'
    )),
    'gobackuri' => uri('user/shop'),
//    'right' => '<a class="addFormSubmit" href="#">'.i18n(array(
//        'en' => 'Complete',
//        'zh' => '完成'
//    )).'</a>'
));
$html->renderOut('user/shop_settings', array(
  'user' => MySiteUser::getCurrentUser(),
  'settings' => Shopsettings::findByUserid($user->getId())
));

$html->output('</div>');

$html->renderOut('user/components/html_footer');
