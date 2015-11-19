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
}
