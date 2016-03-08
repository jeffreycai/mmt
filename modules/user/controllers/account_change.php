<?php

/** presentation **/
$html = new HTML();

$html->renderOut('user/components/html_header', array(
    'body_class' => 'account_details',
    'title' => i18n(array(
        'en' => 'Change membership type',
        'zh' => '更改会员类型'
    ))
));
$html->output('<div class="container">');
$html->renderOut('user/components/header_general', array(
    'title' => i18n(array(
        'en' => 'Change membership type',
        'zh' => '更改会员类型'
    )),
    'gobackuri' => uri('user/account')
));
$html->renderOut('user/account_change');

$html->output('</div>');

$html->renderOut('user/components/html_footer');