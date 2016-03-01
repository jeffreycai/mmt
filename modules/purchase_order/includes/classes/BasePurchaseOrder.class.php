<?php
include_once MODULESROOT . DS . 'core' . DS . 'includes' . DS . 'classes' . DS . 'DBObject.class.php';

/**
 * DB fields
 * - id
 * - public_id
 * - user_id
 * - name
 * - email
 * - phone
 * - wechat
 * - state
 * - suburb
 * - postcode
 * - address
 * - comment
 * - confirmed
 * - paid
 * - created_at
 * - confirmed_at
 * - paid_at
 * - dispatched
 */
class BasePurchaseOrder extends DBObject {
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
    $this->table_name = 'purchase_order';
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
   public function setPublicId($var) {
     $this->setDbFieldPublic_id($var);
   }
   public function getPublicId() {
     return $this->getDbFieldPublic_id();
   }
   public function setUserId($var) {
     $this->setDbFieldUser_id($var);
   }
   public function getUserId() {
     return $this->getDbFieldUser_id();
   }
   public function setName($var) {
     $this->setDbFieldName($var);
   }
   public function getName() {
     return $this->getDbFieldName();
   }
   public function setEmail($var) {
     $this->setDbFieldEmail($var);
   }
   public function getEmail() {
     return $this->getDbFieldEmail();
   }
   public function setPhone($var) {
     $this->setDbFieldPhone($var);
   }
   public function getPhone() {
     return $this->getDbFieldPhone();
   }
   public function setWechat($var) {
     $this->setDbFieldWechat($var);
   }
   public function getWechat() {
     return $this->getDbFieldWechat();
   }
   public function setState($var) {
     $this->setDbFieldState($var);
   }
   public function getState() {
     return $this->getDbFieldState();
   }
   public function setSuburb($var) {
     $this->setDbFieldSuburb($var);
   }
   public function getSuburb() {
     return $this->getDbFieldSuburb();
   }
   public function setPostcode($var) {
     $this->setDbFieldPostcode($var);
   }
   public function getPostcode() {
     return $this->getDbFieldPostcode();
   }
   public function setAddress($var) {
     $this->setDbFieldAddress($var);
   }
   public function getAddress() {
     return $this->getDbFieldAddress();
   }
   public function setComment($var) {
     $this->setDbFieldComment($var);
   }
   public function getComment() {
     return $this->getDbFieldComment();
   }
   public function setConfirmed($var) {
     $this->setDbFieldConfirmed($var);
   }
   public function getConfirmed() {
     return $this->getDbFieldConfirmed();
   }
   public function setPaid($var) {
     $this->setDbFieldPaid($var);
   }
   public function getPaid() {
     return $this->getDbFieldPaid();
   }
   public function setCreatedAt($var) {
     $this->setDbFieldCreated_at($var);
   }
   public function getCreatedAt() {
     return $this->getDbFieldCreated_at();
   }
   public function setConfirmedAt($var) {
     $this->setDbFieldConfirmed_at($var);
   }
   public function getConfirmedAt() {
     return $this->getDbFieldConfirmed_at();
   }
   public function setPaidAt($var) {
     $this->setDbFieldPaid_at($var);
   }
   public function getPaidAt() {
     return $this->getDbFieldPaid_at();
   }
   public function setDispatched($var) {
     $this->setDbFieldDispatched($var);
   }
   public function getDispatched() {
     return $this->getDbFieldDispatched();
   }

  
  
  /**
   * self functions
   */
  static function dropTable() {
    return parent::dropTableByName('purchase_order');
  }
  
  static function tableExist() {
    return parent::tableExistByName('purchase_order');
  }
  
  static function createTableIfNotExist() {
    global $mysqli;

    if (!self::tableExist()) {
      return $mysqli->query('
CREATE TABLE IF NOT EXISTS `purchase_order` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `public_id` VARCHAR(6) UNIQUE ,
  `user_id` INT NOT NULL ,
  `name` VARCHAR(32) ,
  `email` VARCHAR(256) ,
  `phone` VARCHAR(128) ,
  `wechat` VARCHAR(128) ,
  `state` VARCHAR(4) ,
  `suburb` VARCHAR(32) ,
  `postcode` VARCHAR(4) ,
  `address` VARCHAR(512) ,
  `comment` TEXT ,
  `confirmed` TINYINT DEFAULT 0 ,
  `paid` TINYINT DEFAULT 0 ,
  `created_at` INT ,
  `confirmed_at` INT ,
  `paid_at` INT ,
  `dispatched` INT DEFAULT 0 ,
  PRIMARY KEY (`id`)
 ,
INDEX `purchase_order_public_id` (`public_id` ASC) ,
INDEX `fk-purchase_order-user_id-idx` (`user_id` ASC),
CONSTRAINT `fk-purchase_order-user_id`
  FOREIGN KEY (`user_id`)
  REFERENCES `site_user` (`id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;
      ');
    }
    
    return true;
  }
  
  static function findById($id, $instance = 'PurchaseOrder') {
    global $mysqli;
    $query = 'SELECT * FROM purchase_order WHERE id=' . $id;
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
    $query = "SELECT * FROM purchase_order";
    $result = $mysqli->query($query);
    
    $rtn = array();
    while ($result && $b = $result->fetch_object()) {
      $obj= new PurchaseOrder();
      DBObject::importQueryResultToDbObject($b, $obj);
      $rtn[] = $obj;
    }
    
    return $rtn;
  }
  
  static function findAllWithPage($page, $entries_per_page) {
    global $mysqli;
    $query = "SELECT * FROM purchase_order LIMIT " . ($page - 1) * $entries_per_page . ", " . $entries_per_page;
    $result = $mysqli->query($query);
    
    $rtn = array();
    while ($result && $b = $result->fetch_object()) {
      $obj= new PurchaseOrder();
      DBObject::importQueryResultToDbObject($b, $obj);
      $rtn[] = $obj;
    }
    
    return $rtn;
  }
  
  static function countAll() {
    global $mysqli;
    $query = "SELECT COUNT(*) as 'count' FROM purchase_order";
    if ($result = $mysqli->query($query)) {
      return $result->fetch_object()->count;
    }
  }
  
  static function truncate() {
    global $mysqli;
    $query = "TRUNCATE TABLE purchase_order";
    return $mysqli->query($query);
  }
}