<?php

require_once MODULESROOT . DS . 'siteuser' . DS . 'includes' . DS . 'classes' . DS . 'SiteUser.class.php';

class MySiteUser extends SiteUser {
  /**
   * create user data, if not there
   */
  public function init_user_data() {
    
  }
  
  public function getProducts($onshelf = false) {
    return Product::findAllByUserId($this->getId(), $onshelf);
  }
}