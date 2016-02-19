<?php
require_login();

// get sorting vars from $_GET
$sorting = array();
/// sort
$sorting['column'] = isset($_GET['column']) ? strip_tags($_GET['column']) : 'created_at';
if (!in_array($sorting['column'], array(
    'created_at',
    'stock',
    'sales'
))) {
  $sorting['column'] = 'created_at';
}
/// order
$sorting['order'] = isset($_GET['order']) ? strip_tags($_GET['order']) : 'desc';
if (!in_array($sorting['order'], array(
    'asc',
    'desc'
))) {
  $sorting['order'] = 'desc';
}
/// onshelf
$sorting['onshelf'] = isset($_GET['onshelf']) ? strip_tags($_GET['onshelf']) : '1';
if (!in_array($sorting['onshelf'], array(
    '1',
    '0'
))) {
  $sorting['onshelf'] = '1';
}


$html = new HTML();

$html->renderOut('user/components/html_header', array(
    'body_class' => 'products',
    'title' => i18n(array(
        'en' => 'Manger products',
        'zh' => '管理商品'
    ))
));
$html->output('<div class="container">');
$html->renderOut('user/components/header_filter', array(
    'sorting' => $sorting,
    'gobackuri' => uri('user')
));
$html->renderOut('user/products', array(
    'sorting' => $sorting,
    'products' => MySiteUser::getCurrentUser()->getProducts(1)
));

$html->output('</div>');

$html->renderOut('user/components/html_footer');
