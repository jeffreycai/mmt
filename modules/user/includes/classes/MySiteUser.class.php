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
  
  public function getShopUri($i18n = true) {
    return uri('shop/' . $this->getUsername(), $i18n);
  }
  
  public function getShopName() {
    $settings = Shopsettings::findByUserid($this->getId());
    $shopname = $settings->getShopName();
    if (empty($shopname)) {
      return $this->getProfile()->getNickname() . i18n(array(
        'en' => '\'s online shop',
        'zh' => '的微店'
      ));
    } else {
      return $shopname;
    }
  }
  
  public function getShopLogo() {
    return empty($this->getProfile()->getThumbnail()) ? uri('modules/user/assets/images/logo.png', false) : $this->getProfile()->getThumbnailUrl();
  }
  
  public function getShopSettings() {
    return Shopsettings::findByUserid($this->getId());
  }
  
  public function getAllConfirmedPurchaseOrdersWithPage($page, $entries_per_page) {
    return PurchaseOrder::findAllConfirmedByUserWithPage($this->getId(), $page, $entries_per_page);
  }
  
  public function countAllConfirmedPurchaseOrders() {
    return PurchaseOrder::countAllConfirmedByUser($this->getId());
  }
  
  public function isPaymentSet() {
    if (!empty($this->getShopSettings()->getStripePublicKey()) && !empty($this->getShopSettings()->getStripePrivateKey())) {
      return true;
    }
    return false;
  }
  
  public function getShopIntroductionFormatted() {
    return "<p>" . str_replace("\n", "<br />", $this->getShopSettings()->getShopIntroduction()) . "</p>";
  }
  
  public function getTotalProductsOnSale() {
    $products = Product::findAllByUserId($this->getId(), 1, 0);
    $limit = $this->getProductLimit();
    $products = array_slice($products, 0, $limit);
    return $products;
  }
  
  public function getTotalProductsOnSaleNumber() {
    $products = Product::countAllByUserId($this->getId(), 1, 0);
  }
  
  public function getProductLimit() {
    $settings = Vars::getSettings();
    $limit;
    if ($this->hasRole('GOLDMEMBER')) {
      $limit = $settings['product_limit_GOLDMEMBER'];
    } else if ($this->hasRole('SILVERMEMBER')) {
      $limit = $settings['product_limit_SILVERMEMBER'];
    } else {
      $limit = $settings['product_limit_AUTHENTICATED'];
    }
    return $limit;
  }
  
  public function getAnnouncement() {
    return Shopsettings::findByUserid($this->getId())->getShopAnnouncement();
  }
  
  public function getAnnouncementFormatted() {
    return str_replace("\n", "<br />", $this->getAnnouncement());
  }
}