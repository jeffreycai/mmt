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
if ($stripe->proceedPaymentForm($purchase_order->getTotal(), $public_id)) {
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
//    $purchase_order->sendShopOwnerNewOrderConfirmation();
    // send customer email
//    $purchase_order->sendCustomerNewOrderConfirmation();

    // decrease stock number and increase sales number
    $items = $purchase_order->getItems();
    foreach ($items as $item) {
      $product = $item->getProduct();
      if ($product && $product->getStock()) {
        $stock = $product->getStock() - $item->getNumber();
        $sales = $product->getSales() + $item->getNumber();
        if ($stock >= 0) {
          $product->setStock($stock);
          $product->setSales($sales);
          $product->save();
        }
      }
    }
    
  }

  // mark as paid
  $purchase_order->setPaid(1);
  $purchase_order->setPaidAt(time());
  $purchase_order->save();
  // create a charge item
  $charge_item = new ChargeItem();
  $charge_item->setTitle('订单');
  $charge_item->setReference($public_id);
  $charge_item->setAmount($settings['member'][$user->getMemberType()]['transaction_fee']);
  $charge_item->setCreatedAt(time());
  $charge_item->setUserId($user->getId());
  $charge_item->save();
  // send shop owner paid confirmation
  $purchase_order->sendShopOwnerPaidConfirmation();
  
  if ($user->hasPermission('use sms') && !is_demo_account($user->getUsername())) {
    $sms_msg = loadSMSTemplate('shop_owner_notification_paid_order', array(
      'purchase_order' => $purchase_order,
      'user' => $user
    ));
    sendSMS($user->getProfile()->getPhone(), $sms_msg);
  }
  // send customer paid confirmation
  $purchase_order->sendCustomerPaidConfirmation();
  
  if ($user->hasPermission('use sms') && !is_demo_account($user->getUsername())) {
    $sms_msg = loadSMSTemplate('customer_notification_paid_order', array(
      'purchase_order' => $purchase_order,
      'user' => $user
    ));
    sendSMS($purchase_order->getPhone(), $sms_msg);
  }
  // log it
  $log = new Log('purchase_order', Log::SUCCESS, 'Created and paid: ' . $purchase_order->getPublicId(), $_SERVER['REMOTE_ADDR']);
  $log->save();

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