<?php

function get_cart_items($user) {
  $rtn = array();
  if (isset($_COOKIE['cart'])) {
    $cart = unserialize($_COOKIE['cart']);

    if (is_array($cart) && isset($cart[$user->getUsername()])) {
      $items = $cart[$user->getUsername()];
      if (is_array($items)) {
        foreach ($items as $pid => $quantity) {
          $product = Product::findById($pid);
          $product->number = $quantity;
          $rtn[] = $product;
        }
      }
    }
  }
  return $rtn;
}