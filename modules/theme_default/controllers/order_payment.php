<?php
$public_id = isset($vars[1]) ? $vars[1] : null;
$purchase_order = PurchaseOrder::findByPublicId($public_id);
if (!$purchase_order) {
  dispatch('site/404');
  exit;
}
$user = $purchase_order->getUser();
$stripe = new MyStripe($user->getShopSettings()->getStripePublicKey(), $user->getShopSettings()->getStripePrivateKey());


/** handle payment submission **/
if ($stripe->proceedPaymentForm($public_id)) {
  // mark as confirmed
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
  }

  // mark as paid
  $purchase_order->setPaid(1);
  $purchase_order->setPaidAt(time());
  $purchase_order->save();
  // send shop owner paid confirmation
  $purchase_order->sendShopOwnerPaidConfirmation();
  // send customer email
  $purchase_order->sendCustomerPaidConfirmation();

  HTML::forward('order/payment_confirmed/' . $public_id);
}




/** presentation **/

$html = new HTML();
$html->renderOut('theme_default/components/html_header', array(
    'body_class' => 'theme_default order_payment',
    'title' => '在线支付'
));
$html->renderOut('theme_default/components/navback', array(
  'uri' => $user->getShopUri() . '/checkout',
  'user' => $user,
  'title' => '在线支付'
));


$html->renderOut('theme_default/order_payment', array(
  'user' => $user,
  'purchase_order' => $purchase_order,
  'stripe' => $stripe
));

$html->renderOut('theme_default/components/footer');

$html->renderOut('theme_default/components/html_footer');