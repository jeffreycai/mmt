<?php
$username = isset($vars[1]) ? strip_tags($vars[1]) : null;
$pid = isset($vars[2]) ? strip_tags($vars[2]) : null;
$user = MySiteUser::findByUsername($username, 'MySiteUser');
$product = Product::findById($pid);
if (!$user || !$product || $product->getUserId() != $user->getId()) {
  dispatch('site/404');
  echo "failed";
  exit;
}
unset($_COOKIE[$product->getId()]);

$cart = isset($_COOKIE['cart']) ? unserialize($_COOKIE['cart']) : array();
if (!isset($cart[$username])) {
  $cart[$username] = array();
}
if (isset($cart[$username][$product->getId()])) {
  ++$cart[$username][$product->getId()];
} else {
  $cart[$username][$product->getId()] = 1;
}

$rtn = setcookie('cart', serialize($cart), (CART_ITEM_COOKIE_LIFE_TIME), "/" . get_sub_root(), SITEDOMAIN);

echo $rtn ? "success" : "failed";

exit;