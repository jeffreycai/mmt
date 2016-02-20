<?php
require_login();
$user = MySiteUser::getCurrentUser();

/** handle form submission **/
if (isset($_POST['submit'])) {
  $stripe_public_key = isset($_POST['stripe_public_key']) ? trim(strip_tags($_POST['stripe_public_key'])) : null;
  $stripe_private_key = isset($_POST['stripe_private_key']) ? trim(strip_tags($_POST['stripe_private_key'])) : null;
  // validation
  $error = false;
  if (empty($stripe_public_key)) {
    Message::register(new Message(Message::DANGER, i18n(array(
      'en' => 'Please fill in Stripe public key',
      'zh' => '请填写Stripe公共密匙(Public key)'
    ))));
    $error |= true;
  }
  if (empty($stripe_private_key)) {
    Message::register(new Message(Message::DANGER, i18n(array(
      'en' => 'Please fill in Stripe private key',
      'zh' => '请填写Stripe私人密匙(Private key)'
    ))));
    $error |= true;
  }

  // store in db if no error
  if ($error === false) {
    $settings = Shopsettings::findByUserid($user->getId());
    $settings = $settings ? $settings : new Shopsettings();
    
    $settings->setUserId($user->getId());
    $settings->setStripePublicKey($stripe_public_key);
    $settings->setStripePrivateKey($stripe_private_key);
    
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


$html = new HTML();

$html->renderOut('user/components/html_header', array(
    'body_class' => 'shop shop_settings',
    'title' => i18n(array(
        'en' => 'Change shop settings',
        'zh' => '微店支付设置'
    ))
));
$html->output('<div class="container">');
$html->renderOut('user/components/header_general', array(
    'title' => i18n(array(
        'en' => 'Change shop settings',
        'zh' => '微店支付设置'
    )),
    'gobackuri' => uri('user/shop'),
//    'right' => '<a class="addFormSubmit" href="#">'.i18n(array(
//        'en' => 'Complete',
//        'zh' => '完成'
//    )).'</a>'
));
$html->renderOut('user/shop_payment', array(
  'user' => MySiteUser::getCurrentUser(),
  'settings' => Shopsettings::findByUserid($user->getId())
));

$html->output('</div>');

$html->renderOut('user/components/html_footer');
