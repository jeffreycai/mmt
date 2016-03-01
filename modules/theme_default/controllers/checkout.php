<?php
$username = isset($vars[1]) ? strip_tags($vars[1]) : null;
$user = MySiteUser::findByUsername($username, 'MySiteUser');
if (!$user) {
  dispatch('site/404');
  exit;
}
$settings = Shopsettings::findByUserid($user->getId());
$checkout_form_spam_token = "LKSDJFoie_kfje9";

$items;
// if it is "buy now"
$buynow_pid = isset($_GET['buynow']) && preg_match('/^\d+?$/', $_GET['buynow']) ? intval($_GET['buynow']) : false;
$buynow_product;
if ($buynow_pid) {
  $buynow_product = Product::findById($buynow_pid);
  $buynow_product->number = 1;
  $items = array();
  $items[] = $buynow_product;
  // update cart with only this product
  $cart = @unserialize($_COOKIE['cart']);
  $cart[$username] = array();
  $cart[$username][$buynow_pid] = 1;
  setcookie('cart', serialize($cart), (CART_ITEM_COOKIE_LIFE_TIME), "/" . get_sub_root(), SITEDOMAIN);
} else {
  $items = get_cart_items($user);
}

//_debug($_COOKIE['cart']);
/** handle form submission **/
if (isset($_POST['submit'])) {
  // get vars from $_POST
  $number = $_POST['number'];
  $pid = $_POST['pid'];
  
  $name = isset($_POST['name']) ? trim(strip_tags($_POST['name'])) : null;
  $email = isset($_POST['email']) ? trim(strip_tags($_POST['email'])) : null;
  $phone = isset($_POST['phone']) ? trim(strip_tags($_POST['phone'])) : null;
  $wechat = isset($_POST['wechat']) ? trim(strip_tags($_POST['wechat'])) : null;
  $state = isset($_POST['state']) ? trim(strip_tags($_POST['state'])) : null;
  $suburb = isset($_POST['suburb']) ? trim(strip_tags($_POST['suburb'])) : null;
  $postcode = isset($_POST['postcode']) ? trim(strip_tags($_POST['postcode'])) : null;
  $address = isset($_POST['address']) ? trim(strip_tags($_POST['address'])) : null;
  $comment = isset($_POST['comment']) ? trim(strip_tags($_POST['comment'])) : null;
  // update cart
  $cart = @unserialize($_COOKIE['cart']);
  $cart_items = array();
  for ($i = 0; $i < sizeof($number); $i++) {
    $product_id = intval($pid[$i]);
    $product = Product::findById($product_id);
    // sanity check. product must be the shop own's product
    if ($product->getUserId() !== $user->getId()) {
      continue;
    }
    // create cart items for further usage
    $cart_item = new CartItem();
    $cart_item->setProductId($product_id);
    $cart_item->setNumber($number[$i]);
    $cart_item->setSinglePrice($product->getPrice());
    $cart_item->setTitle($product->getTitle());
    $cart_items[] = $cart_item;
    // update cart item
    $qty = intval($number[$i]);
    if ($qty != 0) {
      $cart[$username][$product_id] = $qty;
    } else {
      unset($cart[$username][$product_id]);
    }
  }
  setcookie('cart', serialize($cart), (CART_ITEM_COOKIE_LIFE_TIME), "/" . get_sub_root(), SITEDOMAIN);

  // validation
  $error = false;
  // spam check
  if (!Form::checkSpamToken($checkout_form_spam_token)) {
    Message::register(new Message(Message::DANGER, '表格已过期，请尝试重新提交'));
    $error |= true;
  }
  // not empty
  $fields = array(
    'name' => '姓名',
    'email' => '邮箱',
    'state' => '州',
    'suburb' => 'Suburb / 区',
    'postcode' => '邮编',
    'address' => '街道地址'
  );
  foreach ($fields as $key => $val) {
    if (empty($$key)) {
      Message::register(new Message(Message::DANGER, '"'.$val.'"不能为空，请填写'));
      $error |= true;
    }
  }
  // email
  if (!is_email_address($email)) {
    Message::register(new Message(Message::DANGER, '邮箱地址不合法，请重新填写'));
    $error |= true;
  }
  // postcode
  if (!preg_match('/^\d\d\d\d$/', $postcode)) {
    Message::register(new Message(Message::DANGER, '邮编应为4位数字，请检查'));
    $error |= true;
  }
  // phone
  if (empty($phone) && $user->hasPermission('use sms')) {
    Message::register(new Message(Message::DANGER, '请填写手机号码'));
    $error |= true;
  }
  if (!empty($phone) && !preg_match('/^04\d+$/', $phone)) {
    Message::register(new Message(Message::DANGER, '电话号码不合法，请检查'));
    $error |= true;
  }
  
  
  // when no error
  if ($error === false) {
    // store values to cookie
    $cookie_time = DELIVERY_INFO_COOKIE_LIFE_TIME;
    setcookie('delivery[name]', $name ? $name : "", $cookie_time, "/" . get_sub_root(), SITEDOMAIN);
    setcookie('delivery[email]', $email ? $email : "", $cookie_time, "/" . get_sub_root(), SITEDOMAIN);
    setcookie('delivery[phone]', $phone ? $phone : "", $cookie_time, "/" . get_sub_root(), SITEDOMAIN);
    setcookie('delivery[wechat]', $wechat ? $wechat : "", $cookie_time, "/" . get_sub_root(), SITEDOMAIN);
    setcookie('delivery[state]', $state ? $state : "", $cookie_time, "/" . get_sub_root(), SITEDOMAIN);
    setcookie('delivery[suburb]', $suburb ? $suburb : "", $cookie_time, "/" . get_sub_root(), SITEDOMAIN);
    setcookie('delivery[postcode]', $postcode ? $postcode : "", $cookie_time, "/" . get_sub_root(), SITEDOMAIN);
    setcookie('delivery[address]', $address ? $address : "", $cookie_time, "/" . get_sub_root(), SITEDOMAIN);
    setcookie('delivery[comment]', $comment ? $comment : "", $cookie_time, "/" . get_sub_root(), SITEDOMAIN);
    // create purchase order
    $purchase_order = new PurchaseOrder();
    $purchase_order->setPublicId(get_random_string(6));
    $purchase_order->setUserId($user->getId());
    $purchase_order->setName($name);
    $purchase_order->setEmail($email);
    $purchase_order->setPhone($phone);
    $purchase_order->setWechat($wechat);
    $purchase_order->setSuburb($suburb);
    $purchase_order->setState($state);
    $purchase_order->setPostcode($postcode);
    $purchase_order->setAddress($address);
    $purchase_order->setComment($comment);
    $purchase_order->setPaid(0);
    $purchase_order->setCreatedAt(time());
    $purchase_order->save();
    // create cart items
    for ($i = 0; $i < sizeof($cart_items); $i++) {
      $cart_items[$i]->setPurchaseOrderId($purchase_order->getId());
      $cart_items[$i]->save();
    }
    // direct to purchase order confirm page
    Message::register(new Message(Message::SUCCESS, '请确认您的订单'));
    HTML::forward('order/confirm/' . $purchase_order->getPublicId());
  }
}


// generate spam token for the form
Form::generateSpamToken($checkout_form_spam_token);


/** presentation **/

$html = new HTML();
$html->renderOut('theme_default/components/html_header', array(
    'body_class' => 'theme_default checkout',
    'title' => '完成订单'
));
$html->renderOut('theme_default/components/navback', array(
  'uri' => $user->getShopUri(),
  'user' => $user,
  '完成订单'
));


$html->output("\n<form id='checkout' action='".$user->getShopUri()."/checkout".($buynow_pid ? '?buynow='.$buynow_pid : '')."#delivery' method='POST'>\n");
$html->renderOut('theme_default/components/cart', array(
  'user' => $user,
  'items' => $items,
  'settings' => $settings
));
if (!empty($items)) {
  $html->renderOut('theme_default/components/delivery', array(
    'user' => $user
  ));
  Form::loadSpamToken('#checkout', $checkout_form_spam_token);
}
$html->output("\n</form>\n");

$html->renderOut('theme_default/components/footer');

$html->renderOut('theme_default/components/html_footer');