<?php
require_login();

$html = new HTML();

$html->output('<div class="container">');

$html->renderOut('user/components/html_header', array(
    'body_class' => 'products',
    'title' => i18n(array(
        'en' => 'Manger products',
        'zh' => '管理商品'
    ))
));
$html->renderOut('user/components/header_general', array(
    'title' => i18n(array(
        'en' => 'Manage products',
        'zh' => '管理商品'
    )),
    'gobackuri' => uri('user')
));
$html->renderOut('user/products', array(
    'products' => MySiteUser::getCurrentUser()->getProducts()
));

$html->output('</div>');

$html->renderOut('user/components/html_footer');
