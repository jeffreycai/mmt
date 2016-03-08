<?php
include_once MODULESROOT . DS . 'core' . DS . 'includes' . DS . 'classes' . DS . 'DBObject.class.php';

/**
 * DB fields
 * - id
 * - user_id
 * - title
 * - thumbnail
 * - images
 * - description
 * - price
 * - original_price
 * - onshelf
 * - sales
 * - stock
 * - created_at
 */
class BaseProduct extends DBObject {
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
    $this->table_name = 'product';
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
   public function setTitle($var) {
     $this->setDbFieldTitle($var);
   }
   public function getTitle() {
     return $this->getDbFieldTitle();
   }
   public function setThumbnail($var) {
     $this->setDbFieldThumbnail($var);
   }
   public function getThumbnail() {
     return $this->getDbFieldThumbnail();
   }
   public function setImages($var) {
     $this->setDbFieldImages($var);
   }
   public function getImages() {
     return $this->getDbFieldImages();
   }
   public function setDescription($var) {
     $this->setDbFieldDescription($var);
   }
   public function getDescription() {
     return $this->getDbFieldDescription();
   }
   public function setPrice($var) {
     $this->setDbFieldPrice($var);
   }
   public function getPrice() {
     return $this->getDbFieldPrice();
   }
   public function setOriginalPrice($var) {
     $this->setDbFieldOriginal_price($var);
   }
   public function getOriginalPrice() {
     return $this->getDbFieldOriginal_price();
   }
   public function setOnshelf($var) {
     $this->setDbFieldOnshelf($var);
   }
   public function getOnshelf() {
     return $this->getDbFieldOnshelf();
   }
   public function setSales($var) {
     $this->setDbFieldSales($var);
   }
   public function getSales() {
     return $this->getDbFieldSales();
   }
   public function setStock($var) {
     $this->setDbFieldStock($var);
   }
   public function getStock() {
     return $this->getDbFieldStock();
   }
   public function setCreatedAt($var) {
     $this->setDbFieldCreated_at($var);
   }
   public function getCreatedAt() {
     return $this->getDbFieldCreated_at();
   }

  
  
  /**
   * self functions
   */
  static function dropTable() {
    return parent::dropTableByName('product');
  }
  
  static function tableExist() {
    return parent::tableExistByName('product');
  }
  
  static function createTableIfNotExist() {
    global $mysqli;

    if (!self::tableExist()) {
      return $mysqli->query('
CREATE TABLE IF NOT EXISTS `product` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `user_id` INT NOT NULL ,
  `title` VARCHAR(512) NOT NULL ,
  `thumbnail` VARCHAR(256) ,
  `images` VARCHAR(1024) ,
  `description` TEXT ,
  `price` VARCHAR(10) NOT NULL ,
  `original_price` VARCHAR(10) ,
  `onshelf` TINYINT(1) DEFAULT 1 ,
  `sales` INT DEFAULT 0 ,
  `stock` INT DEFAULT 0 ,
  `created_at` INT ,
  PRIMARY KEY (`id`)
 ,
INDEX `fk-product-user_id-idx` (`user_id` ASC),
CONSTRAINT `fk-product-user_id`
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
  
  static function findById($id, $instance = 'Product') {
    global $mysqli;
    $query = 'SELECT * FROM product WHERE id=' . $id;
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
    $query = "SELECT * FROM product";
    $result = $mysqli->query($query);
    
    $rtn = array();
    while ($result && $b = $result->fetch_object()) {
      $obj= new Product();
      DBObject::importQueryResultToDbObject($b, $obj);
      $rtn[] = $obj;
    }
    
    return $rtn;
  }
  
  static function findAllWithPage($page, $entries_per_page) {
    global $mysqli;
    $query = "SELECT * FROM product LIMIT " . ($page - 1) * $entries_per_page . ", " . $entries_per_page;
    $result = $mysqli->query($query);
    
    $rtn = array();
    while ($result && $b = $result->fetch_object()) {
      $obj= new Product();
      DBObject::importQueryResultToDbObject($b, $obj);
      $rtn[] = $obj;
    }
    
    return $rtn;
  }
  
  static function countAll() {
    global $mysqli;
    $query = "SELECT COUNT(*) as 'count' FROM product";
    if ($result = $mysqli->query($query)) {
      return $result->fetch_object()->count;
    }
  }
  
  static function truncate() {
    global $mysqli;
    $query = "TRUNCATE TABLE product";
    return $mysqli->query($query);
  }
}