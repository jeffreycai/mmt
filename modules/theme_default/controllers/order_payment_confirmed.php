<?php
$public_id = isset($vars[1]) ? $vars[1] : null;
$purchase_order = PurchaseOrder::findByPublicId($public_id);
if (!$purchase_order) {
  dispatch('site/404');
  exit;
}
$user = $purchase_order->getUser();


// if old order, check if it expires, if yes, no access
if ($purchase_order->getConfirmedAt() < time() - ($settings['purchase_order_page_life_time'] * 60)) {
  dispatch('site/404');
  exit;
}


/** presentation **/

$html = new HTML();
$html->renderOut('theme_default/components/html_header', array(
    'body_class' => 'theme_default order_payment_confirmed',
    'title' => '购买成功'
));
$html->renderOut('theme_default/components/navback', array(
  'uri' => $user->getShopUri(),
  'user' => $user,
  'title' => '购买成功'
));


$html->renderOut('theme_default/order_payment_confirmed', array(
  'user' => $user,
  'purchase_order' => $purchase_order
));

$html->renderOut('theme_default/components/footer');

$html->renderOut('theme_default/components/html_footer');