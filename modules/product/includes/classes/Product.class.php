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
  
  public function getFirstThumbnail() {
    $thumbnail = $this->getThumbnail();
    $tokens = explode("\n", trim($thumbnail));
    return $tokens[0];
  }
  
  public function getUser() {
    return MySiteUser::findById($this->getUserId());
  }
  
  public function getDescriptionFormatted() {
    return "<p>" . str_replace("\n", "<br />", $this->getDescription()) . "</p>";
  }
  
  static function findAllByUserId($uid, $onshelf = null, $stock_larger_than = null) {
    global $mysqli;
    $query = "SELECT * FROM product";
    
    $where = array();
    $where[] = "user_id=" . intval($uid);
    if ($onshelf !== null) {
      $where[] = "onshelf=" . DBObject::prepare_val_for_sql($onshelf);
    }
    if ($stock_larger_than !== null) {
      $where[] = "stock>" . $stock_larger_than;
    }
    $where = " WHERE " . implode(" AND ", $where);

    $result = $mysqli->query($query . $where);
    
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
}
