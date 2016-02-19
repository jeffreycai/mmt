<?php
require_login();
$user = MySiteUser::getCurrentUser();

/** handle form submission **/
if (isset($_POST['submit'])) {
  $name = isset($_POST['name']) ? trim(strip_tags($_POST['name'])) : null;
  $introduction = isset($_POST['introduction']) ? trim(strip_tags($_POST['introduction'])) : null;
  // validation
  $error = false;
  if (empty($name)) {
    Message::register(new Message(Message::DANGER, i18n(array(
      'en' => 'Please fill in shop name',
      'zh' => '请填写微店名称'
    ))));
    $error |= true;
  }

  // store in db if no error
  if ($error === false) {
    $settings = Shopsettings::findByUserid($user->getId());
    $settings = $settings ? $settings : new Shopsettings();
    
    $settings->setUserId($user->getId());
    $settings->setShopName($name);
    $settings->setShopIntroduction($introduction);
    
    if ($settings->save()) {
      Message::register(new Message(Message::SUCCESS, i18n(array(
        'en' => 'Your shop settings have been successfully updated!',
        'zh' => '您的微店设置已成功更新！'
      ))));
    } else {
      Message::register(new Message(Message::DANGER, i18n(array(
        'en' => 'Shop settings failed to be saved',
        'zh' => '微店设置更新失败'
      ))));
    }
  }
}


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
