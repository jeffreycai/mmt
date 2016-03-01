<?php
include_once MODULESROOT . DS . 'core' . DS . 'includes' . DS . 'classes' . DS . 'DBObject.class.php';

/**
 * DB fields
 * - id
 * - title
 * - reference
 * - amount
 * - created_at
 * - charged
 */
class BaseChargeItem extends DBObject {
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
    $this->table_name = 'charge_item';
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
   public function setTitle($var) {
     $this->setDbFieldTitle($var);
   }
   public function getTitle() {
     return $this->getDbFieldTitle();
   }
   public function setReference($var) {
     $this->setDbFieldReference($var);
   }
   public function getReference() {
     return $this->getDbFieldReference();
   }
   public function setAmount($var) {
     $this->setDbFieldAmount($var);
   }
   public function getAmount() {
     return $this->getDbFieldAmount();
   }
   public function setCreatedAt($var) {
     $this->setDbFieldCreated_at($var);
   }
   public function getCreatedAt() {
     return $this->getDbFieldCreated_at();
   }
   public function setCharged($var) {
     $this->setDbFieldCharged($var);
   }
   public function getCharged() {
     return $this->getDbFieldCharged();
   }

  
  
  /**
   * self functions
   */
  static function dropTable() {
    return parent::dropTableByName('charge_item');
  }
  
  static function tableExist() {
    return parent::tableExistByName('charge_item');
  }
  
  static function createTableIfNotExist() {
    global $mysqli;

    if (!self::tableExist()) {
      return $mysqli->query('
CREATE TABLE IF NOT EXISTS `charge_item` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(256) ,
  `reference` VARCHAR(256) ,
  `amount` VARCHAR(5) ,
  `created_at` INT ,
  `charged` TINYINT DEFAULT 0 ,
  PRIMARY KEY (`id`)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;
      ');
    }
    
    return true;
  }
  
  static function findById($id, $instance = 'ChargeItem') {
    global $mysqli;
    $query = 'SELECT * FROM charge_item WHERE id=' . $id;
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
    $query = "SELECT * FROM charge_item";
    $result = $mysqli->query($query);
    
    $rtn = array();
    while ($result && $b = $result->fetch_object()) {
      $obj= new ChargeItem();
      DBObject::importQueryResultToDbObject($b, $obj);
      $rtn[] = $obj;
    }
    
    return $rtn;
  }
  
  static function findAllWithPage($page, $entries_per_page) {
    global $mysqli;
    $query = "SELECT * FROM charge_item LIMIT " . ($page - 1) * $entries_per_page . ", " . $entries_per_page;
    $result = $mysqli->query($query);
    
    $rtn = array();
    while ($result && $b = $result->fetch_object()) {
      $obj= new ChargeItem();
      DBObject::importQueryResultToDbObject($b, $obj);
      $rtn[] = $obj;
    }
    
    return $rtn;
  }
  
  static function countAll() {
    global $mysqli;
    $query = "SELECT COUNT(*) as 'count' FROM charge_item";
    if ($result = $mysqli->query($query)) {
      return $result->fetch_object()->count;
    }
  }
  
  static function truncate() {
    global $mysqli;
    $query = "TRUNCATE TABLE charge_item";
    return $mysqli->query($query);
  }
}