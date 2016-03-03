<?php
require_once "BaseProduct.class.php";

class Product extends BaseProduct {
  public function delete() {
    // delete all thumbnails
    if (trim($this->getThumbnail()) != '') {
      $files = explode("\n", trim($this->getThumbnail()));
      foreach ($files as $file) {
        $path = WEBROOT . DS . $file;
        if (is_file($path)) {
          unlink($path);
        }
      }
    }
    
    return parent::delete();
  }
  
  public function getUser() {
    return MySiteUser::findById($this->getUserId(), 'MySiteUser');
  }
  
  public function getDescriptionFormatted() {
    return "<p>" . str_replace("\n", "<br />", $this->getDescription()) . "</p>";
  }
  
  static function findAllByUserId($uid, $onshelf = null, $stock_larger_than = null, $sort_column = null, $sort_order = 'ASC') {
    global $mysqli;
    $query = "SELECT * FROM product";
    
    // where
    $where = array();
    $where[] = "user_id=" . intval($uid);
    if ($onshelf !== null) {
      $where[] = "onshelf=" . DBObject::prepare_val_for_sql($onshelf);
    }
    if ($stock_larger_than !== null) {
      $where[] = "stock>" . $stock_larger_than;
    }
    $where = " WHERE " . implode(" AND ", $where);
    
    // order
    $order = "";
    if (!is_null($sort_column)) {
      $order = " ORDER BY $sort_column $sort_order ";
    }

    $result = $mysqli->query($query . $where . $order);
    
    $rtn = array();
    while ($result && $b = $result->fetch_object()) {
      $obj= new Product();
      DBObject::importQueryResultToDbObject($b, $obj);
      $rtn[] = $obj;
    }

    return $rtn;
  }
  
  static function countAllByUserId($uid, $onshelf = null, $stock_larger_than = null) {
    global $mysqli;
    $query = "SELECT count(*) as total FROM product";
    
    $where = array();
    $where[] = "user_id=" . intval($uid);
    if ($onshelf !== null) {
      $where[] = "onshelf=" . DBObject::prepare_val_for_sql($onshelf);
    }
    if ($only_show_the_ones_with_stock !== null) {
      $where[] = "stock>" . $stock_larger_than;
    }
    $where = " WHERE " . implode(" AND ", $where);

    $result = $mysqli->query($query . $where);
    $b = $result->fetch_object();
    
    return $b->total;
  }
  
  public function getShopUri() {
    $user = $this->getUser();
    return $user->getShopUri() . "/" . $this->getId();
  }
  
  public function getPreviewUri() {
    return $this->getShopUri() . "?preview=1";
  }
}
