<?php
require_once "BaseCartItem.class.php";

class CartItem extends BaseCartItem {
  static function findAllByPurchaseOrderId($id) {
    global $mysqli;
    $query = "SELECT * FROM cart_item WHERE purchase_order_id=$id";
    $result = $mysqli->query($query);
    
    $rtn = array();
    while ($result && $b = $result->fetch_object()) {
      $obj= new CartItem();
      DBObject::importQueryResultToDbObject($b, $obj);
      $rtn[] = $obj;
    }
    
    return $rtn;
  }
}
