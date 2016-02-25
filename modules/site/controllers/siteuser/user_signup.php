<?php


// check if already login, if yes, redirect to userpage
if (is_login()) {
  HTML::forward('user');
}

// get vars
$member_type = isset($_POST['member']) ? strip_tags($_POST['member']) : 'NORMAL';
$username = isset($_POST['username']) ? strip_tags($_POST['username']) : false;

// handle payment submission
$stripe = new MyStripe(decrypt($settings['admin_stripe_public_key_'.ENV]), decrypt($settings['admin_stripe_secret_key_'.ENV]));
if ($stripe->proceedPaymentForm("$member_type: $username")) {

  // handle default submission
  $submission_handler = MODULESROOT . '/siteuser/controllers/backend/user/add_edit_submission.php';
  require $submission_handler;
  // now we should have $user from above;
  
  
  // extra handling for site specific actions, only do when there is no errors thrown before
  $err_msgs = Message::peekMessages(Message::DANGER);
  if (sizeof($err_msgs) == 0) {
    // check membership is legal
    $types = array();
    foreach ($settings['member'] as $type => $confs) {
      $types[] = $type;
    }
    if (!in_array($member_type, $types)) {
      Message::register(new Message(Message::DANGER, '会员类型不合法'));
      HTML::forwardBackToReferer();
    }
    // ok
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
    'extra' => '<div  style="text-align: center;"><small class="login"><a href="'.uri('users').'">'.i18n(array('en' => 'login as exsiting user', 'zh' => '现有用户登录')).'</a></small></div><div><br /><br /></div>'
));


exit;
