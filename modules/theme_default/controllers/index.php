<?php

$username = isset($vars[1]) ? strip_tags($vars[1]) : null;
$user = MySiteUser::findByUsername($username, 'MySiteUser');
if (!$user) {
  dispatch('site/404');
  exit;
}

$products = $user->getTotalProductsOnSale();


/** presentation **/
$html = new HTML();
$html->renderOut('theme_default/components/html_header', array(
    'body_class' => 'theme_default',
    'title' => $user->getShopName() . " :: " . $settings['sitename']
));
$html->renderOut('theme_default/components/header', array(
    'shoplogo' => $user->getShopLogo(),
    'shopname' => $user->getShopName(),
    'product_onsale_number' => sizeof($products)
));
$html->renderOut('theme_default/components/mainnav', array(
    'user' => $user
));
$html->renderOut('theme_default/index', array(
    'user' => $user,
    'products' => $products
));
$html->renderOut('theme_default/components/footer');

$html->renderOut('theme_default/components/html_footer');