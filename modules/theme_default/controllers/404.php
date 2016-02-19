<?php


$html = new HTML();
$html->renderOut('theme_default/components/html_header', array(
    'body_class' => 'theme_default 404',
    'title' => '您访问的页面不存在'
));


$html->renderOut('theme_default/404');

$html->renderOut('theme_default/components/footer');

$html->renderOut('theme_default/components/html_footer');