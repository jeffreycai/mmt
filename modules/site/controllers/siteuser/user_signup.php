<?php
//MySiteUser::findByUsername('demo');

// check if already login, if yes, redirect to userpage
if (is_login()) {
  HTML::forward('user');
}

// get vars
$member_type = isset($_POST['member_type']) ? strip_tags($_POST['member_type']) : 'NORMAL';
$username = isset($_POST['username']) ? strip_tags($_POST['username']) : false;

if (isset($_POST['username'])) {
  // handle default submission
  $_POST['noemailnotification'] = 1; // we don't want to send user notification in default handler, gonna wait till payment is through, will do it later
  $submission_handler = MODULESROOT . '/siteuser/controllers/backend/user/add_edit_submission.php';
  require $submission_handler;
  

  
  // now we should have "$user" var from the default handler above;
  $user = isset($user) ? $user : new MySiteUser();
  // see if default submission has error thrown, if not, proceed to payment
  $err_msgs = Message::peekMessages(Message::DANGER);
  if (sizeof($err_msgs) == 0) {
    // user needs to activate account
    if (!$user->isNew()) {
      $user->setEmailActivated(0);
      $user->save();
    }
    
    // we fetch success message as we don't want the default, gonna wait till payment is through, will do it later
    Message::getMessages(Message::SUCCESS); 
    
    // check membership is legal
    $types = array();
    foreach ($settings['member'] as $type => $confs) {
      $types[] = $type;
    }
    if (!in_array($member_type, $types)) {
      Message::register(new Message(Message::DANGER, '会员类型不合法'));
      $user->delete();
      HTML::forwardBackToReferer();
    }
    // handle payment for GOLD and PLATINUM user
    if (in_array($member_type, array('GOLD', 'PLATINUM'))) {
      $stripe = new MyStripe(decrypt($settings['admin_stripe_public_key_'.ENV]), decrypt($settings['admin_stripe_secret_key_'.ENV]));
      if ($stripe->proceedPaymentForm("$member_type: $username")) {
        /*** NOW　WE ARE ALL GOOD ***/
        
        $user->assignRole($member_type);
        $user->sendAccountActivationEmail();
        
        Message::register(new Message(Message::SUCCESS, i18n(array(
            'en' => 'Thank you for registering with us. An activation email has been sent to your mail box. Please activate your account by clicking the link in the mail.',
            'zh' => '感谢您注册'.$settings['member'][$member_type]['name'].'帐号。我们刚给您的注册邮箱发送了一份帐号激活邮件，请点击邮件内的激活链接'
        )). '<br /><br />'.i18n(array(
            'en' => 'After you activate your account, you can ',
            'zh' => '激活您的账号后，您可以'
        )).'<a href="'.uri('users').'">'.i18n(array(
            'en' => 'login here',
            'zh' => '在此登录'
        )).'</a>'));
            
        $log = new Log('siteuser', Log::SUCCESS, 'New user registered: '.$member_type.' - '.$user->getUsername(), $_SERVER['REMOTE_ADDR']);
        $log->save();
        sendemailAdmin('New user registered: '.$member_type.' - '.$user->getUsername(), 'New user registered: '.$member_type.' - '.$user->getUsername());
      
        HTML::forwardBackToReferer();
      } else {
        Message::register(new Message(Message::DANGER, '支付失败'));
        $user->delete();
      }
    // go straight to register for NORMAL user
    } else {
      /*** NOW WE ARE ALL GOOD ***/
      
      $user->assignRole($member_type);
      $user->sendAccountActivationEmail();
      
      Message::register(new Message(Message::SUCCESS, i18n(array(
          'en' => 'Thank you for registering with us. An activation email has been sent to your mail box. Please activate your account by clicking the link in the mail.',
          'zh' => '感谢您注册普通会员帐号。我们刚给您的注册邮箱发送了一份帐号激活邮件，请点击邮件内的激活链接'
      )). '<br /><br />'.i18n(array(
          'en' => 'After you activate your account, you can ',
          'zh' => '激活您的账号后，您可以'
      )).'<a href="'.uri('users').'">'.i18n(array(
          'en' => 'login here',
          'zh' => '在此登录'
      )).'</a>'));
            
      $log = new Log('siteuser', Log::SUCCESS, 'New user registered: '.$member_type.' - '.$user->getUsername(), $_SERVER['REMOTE_ADDR']);
      $log->save();
      sendemailAdmin('New user registered: '.$member_type.' - '.$user->getUsername(), 'New user registered: '.$member_type.' - '.$user->getUsername());
      
      HTML::forwardBackToReferer();
    }
  }
}

/** presentation **/
$html = new HTML();



$html->renderOut('core/backend/single_form_header', array('title' => i18n(array(
          'en' => 'New user signup',
          'zh' => '新用户注册'
      ))));
echo MySiteUser::renderSignupForm(null, '', array('avatar', 'active'));

$html->renderOut('core/backend/single_form_footer', array(
    'extra' => '<div  style="text-align: center;"><small class="login"><a href="'.uri('users').'">'.i18n(array('en' => 'login as exsiting user', 'zh' => '现有用户登录')).'</a><br /><a href="'.uri('').'">&laquo; 返回首页</a></small></div><div><br /><br /></div>'
));


exit;
