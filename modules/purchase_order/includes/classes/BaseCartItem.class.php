<?php
include_once MODULESROOT . DS . 'core' . DS . 'includes' . DS . 'classes' . DS . 'DBObject.class.php';

/**
 * DB fields
 * - id
 * - product_id
 * - purchase_order_id
 * - number
 * - single_price
 * - title
 */
class BaseCartItem extends DBObject {
  /**
   * Implement parent abstract functions
   */
  protected function setPrimaryKeyName() {
    $this->primary_key = array(
      'id'
    );
  }
  protected function setPrimaryKeyAutoIncreased() {
    $this->pk_auto_increased = TRUE;
  }
  protected function setTableName() {
    $this->table_name = 'cart_item';
  }
  
  /**
   * Setters and getters
   */
   public function setId($var) {
     $this->setDbFieldId($var);
   }
   public function getId() {
     return $this->getDbFieldId();
   }
   public function setProductId($var) {
     $this->setDbFieldProduct_id($var);
   }
   public function getProductId() {
     return $this->getDbFieldProduct_id();
   }
   public function setPurchaseOrderId($var) {
     $this->setDbFieldPurchase_order_id($var);
   }
   public function getPurchaseOrderId() {
     return $this->getDbFieldPurchase_order_id();
   }
   public function setNumber($var) {
     $this->setDbFieldNumber($var);
   }
   public function getNumber() {
     return $this->getDbFieldNumber();
   }
   public function setSinglePrice($var) {
     $this->setDbFieldSingle_price($var);
   }
   public function getSinglePrice() {
     return $this->getDbFieldSingle_price();
   }
   public function setTitle($var) {
     $this->setDbFieldTitle($var);
   }
   public function getTitle() {
     return $this->getDbFieldTitle();
   }

  
  
  /**
   * self functions
   */
  static function dropTable() {
    return parent::dropTableByName('cart_item');
  }
  
  static function tableExist() {
    return parent::tableExistByName('cart_item');
  }
  
  static function createTableIfNotExist() {
    global $mysqli;

    if (!self::tableExist()) {
      return $mysqli->query('
CREATE TABLE IF NOT EXISTS `cart_item` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `product_id` INT ,
  `purchase_order_id` INT NOT NULL ,
  `number` INT(4) ,
  `single_price` VARCHAR(10) NOT NULL ,
  `title` VARCHAR(512) ,
  PRIMARY KEY (`id`)
 ,
INDEX `fk-cart_item-product_id-idx` (`product_id` ASC),
CONSTRAINT `fk-cart_item-product_id`
  FOREIGN KEY (`product_id`)
  REFERENCES `product` (`id`)
  ON DELETE SET NULL  ON UPDATE CASCADE ,
INDEX `fk-cart_item-purchase_order_id-idx` (`purchase_order_id` ASC),
CONSTRAINT `fk-cart_item-purchase_order_id`
  FOREIGN KEY (`purchase_order_id`)
  REFERENCES `purchase_order` (`id`)
  ON DELETE CASCADE  ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;
      ');
    }
    
    return true;
  }
  
  static function findById($id, $instance = 'CartItem') {
    global $mysqli;
    $query = 'SELECT * FROM cart_item WHERE id=' . $id;
    $result = $mysqli->query($query);
    if ($result && $b = $result->fetch_object()) {
      $obj = new $instance();
      DBObject::importQueryResultToDbObject($b, $obj);
      return $obj;
    }
    return null;
  }
  
  static function findAll() {
    global $mysqli;
    $query = "SELECT * FROM cart_item";
    $result = $mysqli->query($query);
    
    $rtn = array();
    while ($result && $b = $result->fetch_object()) {
      $obj= new CartItem();
      DBObject::importQueryResultToDbObject($b, $obj);
      $rtn[] = $obj;
    }
    
    return $rtn;
  }
  
  static function findAllWithPage($page, $entries_per_page) {
    global $mysqli;
    $query = "SELECT * FROM cart_item LIMIT " . ($page - 1) * $entries_per_page . ", " . $entries_per_page;
    $result = $mysqli->query($query);
    
    $rtn = array();
    while ($result && $b = $result->fetch_object()) {
      $obj= new CartItem();
      DBObject::importQueryResultToDbObject($b, $obj);
      $rtn[] = $obj;
    }
    
    return $rtn;
  }
  
  static function countAll() {
    global $mysqli;
    $query = "SELECT COUNT(*) as 'count' FROM cart_item";
    if ($result = $mysqli->query($query)) {
      return $result->fetch_object()->count;
    }
  }
  
  static function truncate() {
    global $mysqli;
    $query = "TRUNCATE TABLE cart_item";
    return $mysqli->query($query);
  }
}