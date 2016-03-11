<?php
include_once MODULESROOT . DS . 'core' . DS . 'includes' . DS . 'classes' . DS . 'DBObject.class.php';

/**
 * DB fields
 * - id
 * - user_id
 * - shop_name
 * - shop_introduction
 * - shop_announcement
 * - shop_logo
 * - shop_wechat
 * - shop_phone
 * - shop_address
 * - shop_email
 * - stripe_public_key
 * - stripe_private_key
 * - stripe_uid
 */
class BaseShopsettings extends DBObject {
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
    $this->table_name = 'shopsettings';
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
   public function setUserId($var) {
     $this->setDbFieldUser_id($var);
   }
   public function getUserId() {
     return $this->getDbFieldUser_id();
   }
   public function setShopName($var) {
     $this->setDbFieldShop_name($var);
   }
   public function getShopName() {
     return $this->getDbFieldShop_name();
   }
   public function setShopIntroduction($var) {
     $this->setDbFieldShop_introduction($var);
   }
   public function getShopIntroduction() {
     return $this->getDbFieldShop_introduction();
   }
   public function setShopAnnouncement($var) {
     $this->setDbFieldShop_announcement($var);
   }
   public function getShopAnnouncement() {
     return $this->getDbFieldShop_announcement();
   }
   public function setShopLogo($var) {
     $this->setDbFieldShop_logo($var);
   }
   public function getShopLogo() {
     return $this->getDbFieldShop_logo();
   }
   public function setShopWechat($var) {
     $this->setDbFieldShop_wechat($var);
   }
   public function getShopWechat() {
     return $this->getDbFieldShop_wechat();
   }
   public function setShopPhone($var) {
     $this->setDbFieldShop_phone($var);
   }
   public function getShopPhone() {
     return $this->getDbFieldShop_phone();
   }
   public function setShopAddress($var) {
     $this->setDbFieldShop_address($var);
   }
   public function getShopAddress() {
     return $this->getDbFieldShop_address();
   }
   public function setShopEmail($var) {
     $this->setDbFieldShop_email($var);
   }
   public function getShopEmail() {
     return $this->getDbFieldShop_email();
   }
   public function setStripePublicKey($var) {
     $this->setDbFieldStripe_public_key($var);
   }
   public function getStripePublicKey() {
     return $this->getDbFieldStripe_public_key();
   }
   public function setStripePrivateKey($var) {
     $this->setDbFieldStripe_private_key($var);
   }
   public function getStripePrivateKey() {
     return $this->getDbFieldStripe_private_key();
   }
   public function setStripeUid($var) {
     $this->setDbFieldStripe_uid($var);
   }
   public function getStripeUid() {
     return $this->getDbFieldStripe_uid();
   }

  
  
  /**
   * self functions
   */
  static function dropTable() {
    return parent::dropTableByName('shopsettings');
  }
  
  static function tableExist() {
    return parent::tableExistByName('shopsettings');
  }
  
  static function createTableIfNotExist() {
    global $mysqli;

    if (!self::tableExist()) {
      return $mysqli->query('
CREATE TABLE IF NOT EXISTS `shopsettings` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `user_id` INT NOT NULL ,
  `shop_name` VARCHAR(255) ,
  `shop_introduction` TEXT ,
  `shop_announcement` TEXT ,
  `shop_logo` VARCHAR(255) ,
  `shop_wechat` VARCHAR(25) ,
  `shop_phone` VARCHAR(15) ,
  `shop_address` VARCHAR(512) ,
  `shop_email` VARCHAR(32) ,
  `stripe_public_key` VARCHAR(48) ,
  `stripe_private_key` VARCHAR(80) ,
  `stripe_uid` VARCHAR(32) ,
  PRIMARY KEY (`id`)
 ,
INDEX `fk-shopsettings-user_id-idx` (`user_id` ASC),
CONSTRAINT `fk-shopsettings-user_id`
  FOREIGN KEY (`user_id`)
  REFERENCES `site_user` (`id`)
  ON DELETE CASCADE  ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;
      ');
    }
    
    return true;
  }
  
  static function findById($id, $instance = 'Shopsettings') {
    global $mysqli;
    $query = 'SELECT * FROM shopsettings WHERE id=' . $id;
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
    $query = "SELECT * FROM shopsettings";
    $result = $mysqli->query($query);
    
    $rtn = array();
    while ($result && $b = $result->fetch_object()) {
      $obj= new Shopsettings();
      DBObject::importQueryResultToDbObject($b, $obj);
      $rtn[] = $obj;
    }
    
    return $rtn;
  }
  
  static function findAllWithPage($page, $entries_per_page) {
    global $mysqli;
    $query = "SELECT * FROM shopsettings LIMIT " . ($page - 1) * $entries_per_page . ", " . $entries_per_page;
    $result = $mysqli->query($query);
    
    $rtn = array();
    while ($result && $b = $result->fetch_object()) {
      $obj= new Shopsettings();
      DBObject::importQueryResultToDbObject($b, $obj);
      $rtn[] = $obj;
    }
    
    return $rtn;
  }
  
  static function countAll() {
    global $mysqli;
    $query = "SELECT COUNT(*) as 'count' FROM shopsettings";
    if ($result = $mysqli->query($query)) {
      return $result->fetch_object()->count;
    }
  }
  
  static function truncate() {
    global $mysqli;
    $query = "TRUNCATE TABLE shopsettings";
    return $mysqli->query($query);
  }
}