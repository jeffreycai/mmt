<?php
$username = isset($vars[1]) ? strip_tags($vars[1]) : null;
$pid = isset($vars[2]) ? strip_tags($vars[2]) : null;
$user = MySiteUser::findByUsername($username, 'MySiteUser');
$product = Product::findById($pid);
if (!$user || !$product) {
  dispatch('site/404');
  exit;
}

$html = new HTML();
$html->renderOut('theme_default/components/html_header', array(
    'body_class' => 'theme_default product',
    'title' => '商品 :: ' . htmlentities($product->getTitle())
));
$html->renderOut('theme_default/components/navback_transparent', array(
  'uri' => $user->getShopUri(),
  'user' => $user
));
$html->renderOut('theme_default/components/slideshow', array(
    'sliders' => array(
      'http://placehold.it/600x320',
      'http://placehold.it/600x320',
      'http://placehold.it/600x320',
      'http://placehold.it/600x320',
      'http://placehold.it/600x320'
    )
));
$html->renderOut('theme_default/product', array(
    'user' => $user,
    'product' => $product
));
$html->renderOut('theme_default/components/footer');
$html->renderOut('theme_default/components/bottom_nav', array(
  'user' => $user,
  'product'  => $product
));

$html->renderOut('theme_default/components/html_footer');