<?php
require_login();

$html = new HTML();
$html->renderOut('user/components/html_header', array(
    'body_class' => 'home',
    'title' => i18n(array(
        'en' => 'Backend panel',
        'zh' => '平台管理'
    ))
));
$html->renderOut('user/index');
$html->renderOut('user/components/html_footer');