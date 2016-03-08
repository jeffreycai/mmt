<?php
require_login();


$html = new HTML();

$html->renderOut('user/components/html_header', array(
    'body_class' => 'account_index',
    'title' => i18n(array(
        'en' => 'Manage your account',
        'zh' => '管理帐号'
    ))
));
$html->output('<div class="container">');
$html->renderOut('user/components/header_general', array(
    'title' => i18n(array(
        'en' => 'Manage your account',
        'zh' => '管理帐号'
    )),
    'gobackuri' => uri('user')
));
$html->renderOut('user/account_index', array(
  'user' => MySiteUser::getCurrentUser()
));

$html->output('</div>');

$html->renderOut('user/components/html_footer');
