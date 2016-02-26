<?php

// override this call if "site" module has the override controller
$override_controller = MODULESROOT . '/site/controllers/siteuser/user_signup.php';
if (is_file($override_controller)) {
  require $override_controller;
  exit;
}




// check if already login, if yes, redirect to homepage
if (is_login()) {
  HTML::forward('');
}

// handle submission
$submission_handler = MODULESROOT . '/siteuser/controllers/backend/user/add_edit_submission.php';
require $submission_handler;




$html = new HTML();



$html->renderOut('core/backend/single_form_header', array('title' => i18n(array(
          'en' => 'New user signup',
          'zh' => '新用户注册'
      ))));
echo SiteUser::renderSignupForm(null, '', array('avatar', 'active'));
$html->renderOut('core/backend/single_form_footer', array(
    'extra' => '<div  style="text-align: center;"><small class="login"><a href="'.uri('users').'">'.i18n(array('en' => 'login as exsiting user', 'zh' => '现有用户登录')).'</a><a href="'.uri('users/signup').'">'.i18n(array('en' => 'signup as new user', 'zh' => '申请注册为新用户')).'</a><br /><a href="'.uri('').'">&laquo; '.i18n(array(
        'en' => 'Go back to homepage',
        'zh' => '返回首页'
    )).'</a></small><br /><br /></div>'
));


exit;
