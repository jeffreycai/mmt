<?php

$user = MySiteUser::getCurrentUser();

/** handle submission **/
if (isset($_POST['email'])) {
  
  $uid = $user->getId();
  $_POST['username'] = $user->getUserName();

  // handle default submission
  $_POST['noemailnotification'] = 1; // we don't want to send user notification in default handler, gonna wait till payment is through, will do it later
  $submission_handler = MODULESROOT . '/siteuser/controllers/backend/user/add_edit_submission.php';
  require $submission_handler;
  
}

require_login();

/** presentation **/
$html = new HTML();

$html->renderOut('user/components/html_header', array(
    'body_class' => 'account_details',
    'title' => i18n(array(
        'en' => 'Update personal details',
        'zh' => '修改个人信息'
    ))
));
$html->output('<div class="container">');
$html->renderOut('user/components/header_general', array(
    'title' => i18n(array(
        'en' => 'Update personal details',
        'zh' => '修改个人信息'
    )),
    'gobackuri' => uri('user/account')
));
$html->renderOut('user/account_details', array(
  'user' => $user
));

$html->output('</div>');

$html->renderOut('user/components/html_footer');
