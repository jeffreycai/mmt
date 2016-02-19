<?php
$public_id = isset($vars[1]) ? $vars[1] : null;
$purchase_order = PurchaseOrder::findByPublicId($public_id);
if (!$purchase_order) {
  dispatch('site/404');
  exit;
}
$user = $purchase_order->getUser();


/** presentation **/

$html = new HTML();
$html->renderOut('theme_default/components/html_header', array(
    'body_class' => 'theme_default order_confirm',
    'title' => '确认订单'
));
$html->renderOut('theme_default/components/navback', array(
  'uri' => $user->getShopUri() . '/checkout',
  'user' => $user,
  'title' => '确认订单'
));


$html->renderOut('theme_default/order_confirm', array(
  'user' => $user,
  'purchase_order' => $purchase_order
));

$html->renderOut('theme_default/components/footer');

$html->renderOut('theme_default/components/html_footer');