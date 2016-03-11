<?php
require_once "BaseShopsettings.class.php";

class Shopsettings extends BaseShopsettings {
  public static function findByUserid($uid, $instance = 'Shopsettings') {
    global $mysqli;
    $query = 'SELECT * FROM shopsettings WHERE user_id=' . $uid;
    $result = $mysqli->query($query);
    if ($result && $b = $result->fetch_object()) {
      $obj = new $instance();
      DBObject::importQueryResultToDbObject($b, $obj);
      return $obj;
    }
    return null;
  }
  
  public function setStripePrivateKey($var) {
    return parent::setStripePrivateKey(encrypt($var));
  }
  
  public function getStripePrivateKey() {
    return decrypt(parent::getStripePrivateKey());
  }
}
