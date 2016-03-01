<?php
$public_id = isset($vars[1]) ? $vars[1] : null;
$purchase_order = PurchaseOrder::findByPublicId($public_id);
if (!$purchase_order) {
  dispatch('site/404');
  exit;
}
$user = $purchase_order->getUser();

/** order confirmed actions **/
// if a new order, mark as confirmed
if ($purchase_order->getConfirmed() == 0) {
  // clear cart / delivery cookie
  $cart = unserialize($_COOKIE['cart']);
  unset($cart[$user->getUsername()]);
  setcookie('cart', serialize($cart), (CART_ITEM_COOKIE_LIFE_TIME), "/" . get_sub_root(), SITEDOMAIN);
  setcookie('delivery[comment]', "", DELIVERY_INFO_COOKIE_LIFE_TIME, "/" . get_sub_root(), SITEDOMAIN);
  // mark confirmed
  $purchase_order->setConfirmed(1);
  $purchase_order->setConfirmedAt(time());
  $purchase_order->save();
  // send shop owner email
  $purchase_order->sendShopOwnerNewOrderConfirmation();
  // send customer email
  $purchase_order->sendCustomerNewOrderConfirmation();
  // log it
  $log = new Log('purchase_order', Log::SUCCESS, 'Created: ' . $purchase_order->getPublicId(), $_SERVER['REMOTE_ADDR']);
  $log->save();
// if old order, check if it expires, if yes, no access
} else if ($purchase_order->getConfirmedAt() < time() - ($settings['purchase_order_page_life_time'] * 60)) {
  dispatch('site/404');
  exit;
}



/** presentation **/

$html = new HTML();
$html->renderOut('theme_default/components/html_header', array(
    'body_class' => 'theme_default order_confirmed',
    'title' => '订单下达'
));
$html->renderOut('theme_default/components/navback', array(
  'uri' => $user->getShopUri(),
  'user' => $user,
  'title' => '订单下达'
));


$html->renderOut('theme_default/order_confirmed', array(
  'user' => $user,
  'purchase_order' => $purchase_order
));

$html->renderOut('theme_default/components/footer');

$html->renderOut('theme_default/components/html_footer');