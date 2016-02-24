<?php


// check if already login, if yes, redirect to userpage
if (is_login()) {
  HTML::forward('user');
}

// handle default submission
$submission_handler = MODULESROOT . '/siteuser/controllers/backend/user/add_edit_submission.php';
require $submission_handler;


// extra handling for site specific actions
$member_type = isset($_GET['member']) ? strip_tags($_GET['member']) : 'NORMAL';
// TODO


/** presentation **/
$html = new HTML();



$html->renderOut('core/backend/single_form_header', array('title' => i18n(array(
          'en' => 'New user signup',
          'zh' => '新用户注册'
      ))));
echo MySiteUser::renderSignupForm(null, '', array('avatar', 'active'));

$html->renderOut('site/components/signup_form_strip_script');

$html->renderOut('core/backend/single_form_footer', array(
    'extra' => '<div  style="text-align: center;"><small class="login"><a href="'.uri('users').'">'.i18n(array('en' => 'login as exsiting user', 'zh' => '现有用户登录')).'</a></small></div>'
));


exit;
