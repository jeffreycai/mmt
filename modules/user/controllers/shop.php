<?php
require_login();


$html = new HTML();

$html->renderOut('user/components/html_header', array(
    'body_class' => 'shop',
    'title' => i18n(array(
        'en' => 'Manger your shop',
        'zh' => '管理微店'
    ))
));
$html->output('<div class="container">');
$html->renderOut('user/components/header_general', array(
    'title' => i18n(array(
        'en' => 'Manage your shop',
        'zh' => '管理微店'
    )),
    'gobackuri' => uri('user')
));
$html->renderOut('user/shop', array(
  'user' => MySiteUser::getCurrentUser()
));

$html->output('</div>');

$html->renderOut('user/components/html_footer');
