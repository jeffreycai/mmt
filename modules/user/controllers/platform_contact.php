<?php
require_login();
$user = MySiteUser::getCurrentUser();

/** presentation **/
$html = new HTML();

$html->renderOut('user/components/html_header', array(
    'body_class' => 'user platform_contact',
    'title' => i18n(array(
        'en' => 'Contact customer support',
        'zh' => '联系微店客服'
    ))
));
$html->output('<div class="container">');
$html->renderOut('user/components/header_general', array(
    'title' => i18n(array(
        'en' => 'Contact customer support',
        'zh' => '联系微店客服'
    )),
    'gobackuri' => uri('user/shop')
));
$html->renderOut('user/platform_contact');

$html->output('</div>');

$html->renderOut('user/components/html_footer');
