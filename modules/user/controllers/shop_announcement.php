<?php
require_login();
$user = MySiteUser::getCurrentUser();

/** handle form submission **/
if (isset($_POST['submit'])) {
  $announcement = isset($_POST['announcement']) ? trim(strip_tags($_POST['announcement'])) : null;
  // validation
  // <none>

  // store in db if no error
  $settings = Shopsettings::findByUserid($user->getId());
  $settings = $settings ? $settings : new Shopsettings();

  $settings->setUserId($user->getId());
  $settings->setShopAnnouncement($announcement);

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


$html = new HTML();

$html->renderOut('user/components/html_header', array(
    'body_class' => 'shop shop_settings',
    'title' => i18n(array(
        'en' => 'Change shop announcement',
        'zh' => '微店公告'
    ))
));
$html->output('<div class="container">');
$html->renderOut('user/components/header_general', array(
    'title' => i18n(array(
        'en' => 'Change shop announcement',
        'zh' => '微店公告'
    )),
    'gobackuri' => uri('user/shop'),
//    'right' => '<a class="addFormSubmit" href="#">'.i18n(array(
//        'en' => 'Complete',
//        'zh' => '完成'
//    )).'</a>'
));
$html->renderOut('user/shop_announcement', array(
  'user' => MySiteUser::getCurrentUser(),
  'settings' => Shopsettings::findByUserid($user->getId())
));

$html->output('</div>');

$html->renderOut('user/components/html_footer');

