<?php
$public_id = isset($vars[1]) ? $vars[1] : null;
$purchase_order = PurchaseOrder::findByPublicId($public_id);
if (!$purchase_order) {
  dispatch('site/404');
  exit;
}
$user = $purchase_order->getUser();



/** handle payment submission **/
if (isset($_POST['stripeToken'])) {
  require_once MODULESROOT . DS . 'site' . DS . 'includes' . DS . 'libraries' . DS . 'stripe-php' . DS  . 'init.php';
  
  $error = false;
  
  // Set your secret key: remember to change this to your live secret key in production
  // See your keys here https://dashboard.stripe.com/account/apikeys
  \Stripe\Stripe::setApiKey($user->getShopSettings()->getStripePrivateKey());

  // Get the credit card details submitted by the form
  $token = strip_tags($_POST['stripeToken']);

  // Create the charge on Stripe's servers - this will charge the user's card
  try {
    $charge = \Stripe\Charge::create(array(
      "amount" => 1000, // amount in cents, again
      "currency" => "aud",
      "source" => $token,
      "description" => "Example charge",
      "metadata" => array(
        "order_id" => $public_id
      )
    ));
  } catch(\Stripe\Error\Card $e) {
    // Since it's a decline, \Stripe\Error\Card will be caught
    $body = $e->getJsonBody();
    $err  = $body['error'];

    $msg_content = "Purchase order ID: " . $public_id . "\n";
    
    $msg_content.= "Stripe payment declined\n";
    $msg_content.= 'Status is:' . $e->getHttpStatus() . "\n";
    $msg_content.= 'Type is:' . $err['type'] . "\n";
    $msg_content.= 'Code is:' . $err['code'] . "\n";
    $msg_content.= 'Param is:' . $err['param'] . "\n";
    $msg_content.= 'Message is:' . $err['message'] . "\n";
    
    if (class_exists('Log')) {
      $log = new Log('Stripe', Log::ERROR, $msg_content, $_SERVER['REMOTE_ADDR']);
      $log->save();
    }
    
    Message::register(new Message(Message::DANGER, i18n(array(
      'en' => 'An error has occured. Your payment has been declined. No charges has occurred against your credit card.',
      'zh' => '支付过程中出现错误。您的支付请求失败了。我们没有向您的信用卡扣除任何费用。'
    ))));
    
    $error = true;
  } catch (\Stripe\Error\RateLimit $e) {
    // Too many requests made to the API too quickly
    if (class_exists('Log')) {
      $msg_content = "Purchase order ID: " . $public_id . "\n";
      $msg_content.= 'Too many requests made to the API too quickly';
      
      $log = new Log('Stripe', Log::ERROR, $msg_content, $_SERVER['REMOTE_ADDR']);
      $log->save();
    }
    
    Message::register(new Message(Message::DANGER, i18n(array(
      'en' => 'An error has occured. Your payment has been declined. No charges has occurred against your credit card.',
      'zh' => '支付过程中出现错误。您的支付请求失败了。我们没有向您的信用卡扣除任何费用。'
    ))));
    
    $error = true;
  } catch (\Stripe\Error\InvalidRequest $e) {
    // Invalid parameters were supplied to Stripe's API
    if (class_exists('Log')) {
      $msg_content = "Purchase order ID: " . $public_id . "\n";
      $msg_content.= "Invalid parameters were supplied to Stripe's API";
      
      $log = new Log('Stripe', Log::ERROR, $msg_content, $_SERVER['REMOTE_ADDR']);
      $log->save();
    }
    
    Message::register(new Message(Message::DANGER, i18n(array(
      'en' => 'An error has occured. Your payment has been declined. No charges has occurred against your credit card.',
      'zh' => '支付过程中出现错误。您的支付请求失败了。我们没有向您的信用卡扣除任何费用。'
    ))));
    
    $error = true;
  } catch (\Stripe\Error\Authentication $e) {
    // Authentication with Stripe's API failed
    // (maybe you changed API keys recently)
    // Invalid parameters were supplied to Stripe's API
    
    if (class_exists('Log')) {
      $msg_content = "Purchase order ID: " . $public_id . "\n";
      $msg_content.= "Authentication with Stripe's API failed\n";
      $msg_content.= "(maybe you changed API keys recently)\n";
      $msg_content.= "Invalid parameters were supplied to Stripe's API";
      
      $log = new Log('Stripe', Log::ERROR, $msg_content, $_SERVER['REMOTE_ADDR']);
      $log->save();
    }
    
    Message::register(new Message(Message::DANGER, i18n(array(
      'en' => 'An error has occured. Your payment has been declined. No charges has occurred against your credit card.',
      'zh' => '支付过程中出现错误。您的支付请求失败了。我们没有向您的信用卡扣除任何费用。'
    ))));
    
    $error = true;
  } catch (\Stripe\Error\ApiConnection $e) {
    // Network communication with Stripe failed
    if (class_exists('Log')) {
      $msg_content = "Purchase order ID: " . $public_id . "\n";
      $msg_content.= "Network communication with Stripe failed";
      
      $log = new Log('Stripe', Log::ERROR, $msg_content, $_SERVER['REMOTE_ADDR']);
      $log->save();
    }
    
    Message::register(new Message(Message::DANGER, i18n(array(
      'en' => 'An error has occured. Your payment has been declined. No charges has occurred against your credit card.',
      'zh' => '支付过程中出现错误。您的支付请求失败了。我们没有向您的信用卡扣除任何费用。'
    ))));
    
    $error = true;
  } catch (\Stripe\Error\Base $e) {
    // Display a very generic error to the user, and maybe send
    // yourself an email
    if (class_exists('Log')) {
      $msg_content = "Purchase order ID: " . $public_id . "\n";
      $msg_content.= "a very generic error";
      
      $log = new Log('Stripe', Log::ERROR, $msg_content, $_SERVER['REMOTE_ADDR']);
      $log->save();
    }
    
    Message::register(new Message(Message::DANGER, i18n(array(
      'en' => 'An error has occured. Your payment has been declined. No charges has occurred against your credit card.',
      'zh' => '支付过程中出现错误。您的支付请求失败了。我们没有向您的信用卡扣除任何费用。'
    ))));
    
    $error = true;
  } catch (Exception $e) {
    // Something else happened, completely unrelated to Stripe
    Message::register(new Message(Message::DANGER, i18n(array(
      'en' => 'An error has occured. Your payment has been declined. No charges has occurred against your credit card.',
      'zh' => '支付过程中出现错误。您的支付请求失败了。我们没有向您的信用卡扣除任何费用。'
    ))));
    
    $error = true;
  }
  
  /**
   *  if no error, we mark order as confirmed / paid, and send notifications
   */
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
  'stripe_public_key' => $user->getShopSettings()->getStripePublicKey()
));

$html->renderOut('theme_default/components/footer');

$html->renderOut('theme_default/components/html_footer');