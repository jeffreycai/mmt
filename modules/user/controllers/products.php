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

// prepare vars
$user = MySiteUser::getCurrentUser();
$products = Product::findAllByUserId($user->getId(), intval($sorting['onshelf']), null, $sorting['column'], $sorting['order']);

// set alert if onShelf products is more than allowed
$member_type = $user->getMemberType();
$member_type_verbal = $user->getMemberType(true);
$limit = $user->getProductLimit();
if ($limit < sizeof($products)) {
  Message::register(new Message(Message::INFO, '您当前为'.$member_type_verbal.'，最多可以上架'.$limit.'件商品。<br />您当前上架商品总数为'.sizeof($products).'件，已超出限额。微店前台将只显示'.$limit.'件商品'));
}

/** presentation **/
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
    'products' => $products,
    'user' => $user
));

$html->output('</div>');

$html->renderOut('user/components/html_footer');
