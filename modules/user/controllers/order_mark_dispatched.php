<?php

require_login();

$oid = isset($vars[1]) ? intval(strip_tags($vars[1])) : null;
$purchase_order = PurchaseOrder::findById($oid);
$user = MySiteUser::getCurrentUser();

// we don't want a user to update an order that is not his
if ($purchase_order->getUser()->getId() !== $user->getId()) {
  die('no permission to update');
}

// toggle dispatched
$dispatched = $purchase_order->getDispatched();
if ($dispatched) {
  $purchase_order->setDispatched(0);
} else {
  $purchase_order->setDispatched(1);
}
$purchase_order->save();

die($purchase_order->getDispatched() ? "Y" : "N");