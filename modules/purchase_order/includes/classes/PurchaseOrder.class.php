<?php
require_once "BasePurchaseOrder.class.php";

class PurchaseOrder extends BasePurchaseOrder {
  static function findByPublicId($id, $instance = 'PurchaseOrder') {
    global $mysqli;
    $query = 'SELECT * FROM purchase_order WHERE public_id=' . DBObject::prepare_val_for_sql($id);
    $result = $mysqli->query($query);
    if ($result && $b = $result->fetch_object()) {
      $obj = new $instance();
      DBObject::importQueryResultToDbObject($b, $obj);
      return $obj;
    }
    return null;
  }
  
  static function findAllConfirmedByUserWithPage($uid, $page, $entries_per_page) {
    global $mysqli;
    $query = "SELECT * FROM purchase_order WHERE confirmed=1 AND user_id=$uid ORDER BY confirmed_at DESC LIMIT " . ($page - 1) * $entries_per_page . ", " . $entries_per_page;
    $result = $mysqli->query($query);
    
    $rtn = array();
    while ($result && $b = $result->fetch_object()) {
      $obj= new PurchaseOrder();
      DBObject::importQueryResultToDbObject($b, $obj);
      $rtn[] = $obj;
    }
    
    return $rtn;
  }
  
  static function countAllConfirmedByUser($uid) {
    global $mysqli;
    $query = "SELECT count(*) as total FROM purchase_order WHERE confirmed=1 AND user_id=$uid ORDER BY confirmed_at DESC";
    $result = $mysqli->query($query);
    
    if ($result && $b = $result->fetch_object()) {
      return $b->total;
    }
    
    return false;
  }
  
  public function getUser() {
    return MySiteUser::findById($this->getUserId(), 'MySiteUser');
  }
  
  public function getItems() {
    return CartItem::findAllByPurchaseOrderId($this->getId());
  }
  
  public function getFullAddress() {
    return $this->getAddress() . ", " . $this->getSuburb() . " " . $this->getState() . ", Australia " . $this->getPostcode();
  }
  
  public function getCommentFormatted() {
    return str_replace("\n", "<br />", parent::getComment());
  }
  
  public function getConfirmedAt($date_format = false) {
    if ($date_format) {
      return date($date_format, parent::getConfirmedAt());
    } else {
      return parent::getConfirmedAt();
    }
  }
  
  public function getCreatedAt($date_format = false) {
    if ($date_format) {
      return date($date_format, parent::getConfirmedAt());
    } else {
      return parent::getCreatedAt();
    }
  }
  
  public function getPaidAt($date_format = false) {
    if ($date_format) {
      return date($date_format, parent::getPaidAt());
    } else {
      return parent::getPaidAt();
    }
  }
  
  /**
   * Send shop owner confirmed email
   */
  public function sendShopOwnerNewOrderConfirmation() {
    $settings = Vars::getSettings();
    
    sendMailViaLocal(
            $this->getUser()->getEmail(), // $to
            $this->getUser()->getProfile()->getNickname(), //$to_nickname, 
            $settings['siteemail'], //$reply_to, 
            $settings['sitename'],//$reply_to_nickname, 
            'pdrupal@maimaitionline.com', // $from, 
            $settings['sitename'], // $from_nickname, 
            '您有新的订单 - ' . $this->getPublicId(), // $subject, 
            loadEmailTemplate('shop_owner_notification_confirmed_order', array(
                'purchase_order' => $this
            ))
    );
  }
  
  public function sendShopOwnerPaidConfirmation() {
    $settings = Vars::getSettings();
    
    sendMailViaLocal(
            $this->getUser()->getEmail(), // $to
            $this->getUser()->getProfile()->getNickname(), //$to_nickname, 
            $settings['siteemail'], //$reply_to, 
            $settings['sitename'],//$reply_to_nickname, 
            'pdrupal@maimaitionline.com', // $from, 
            $settings['sitename'], // $from_nickname, 
            '新订单' . $this->getPublicId() . ' - 已付款', // $subject, 
            loadEmailTemplate('shop_owner_notification_paid_order', array(
                'purchase_order' => $this
            ))
    );
  }
  
  public function sendCustomerNewOrderConfirmation() {
    $settings = Vars::getSettings();
    
    sendMailViaLocal(
            $this->getEmail(), // $to
            $this->getName(), //$to_nickname, 
            $this->getUser()->getEmail(), //$reply_to, 
            $this->getUser()->getShopName(),//$reply_to_nickname, 
            'pdrupal@maimaitionline.com', // $from, 
            $this->getUser()->getShopName(), // $from_nickname, 
            '您的订单'.$this->getPublicId().'已送达', // $subject, 
            loadEmailTemplate('customer_notification_confirmed_order', array(
                'purchase_order' => $this
            ))
    );
  }
  
  public function sendCustomerPaidConfirmation() {
    $settings = Vars::getSettings();
    
    sendMailViaLocal(
            $this->getEmail(), // $to
            $this->getName(), //$to_nickname, 
            $this->getUser()->getEmail(), //$reply_to, 
            $this->getUser()->getShopName(),//$reply_to_nickname, 
            'pdrupal@maimaitionline.com', // $from, 
            $this->getUser()->getShopName(), // $from_nickname, 
            '您的订单' . $this->getPublicId() . '已付款', // $subject, 
            loadEmailTemplate('customer_notification_paid_order', array(
                'purchase_order' => $this
            ))
    );
  }
  
  public function getTotal() {
    $items = $this->getItems();
    $total = 0;
    foreach ($items as $item) {
      $total += $item->getNumber() * floatval($item->getSinglePrice());
    }
    return floor($total * 100);
  }
}
