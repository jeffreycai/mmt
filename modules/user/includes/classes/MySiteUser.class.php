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
    return empty($this->getShopSettings()->getShopLogo()) ? uri('modules/user/assets/images/logo.png', false) : uri($this->getShopSettings()->getShopLogo(), false);
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
    $products = Product::findAllByUserId($this->getId(), 1);
    $limit = $this->getProductLimit();
    $products = array_slice($products, 0, $limit);
    return $products;
  }
  
  public function getTotalProductsOnSaleNumber() {
    $products = Product::countAllByUserId($this->getId(), 1);
  }
  
  public function getProductLimit() {
    $settings = Vars::getSettings();
    $limit;
    if ($this->hasRole('PLATINUM')) {
      $limit = $settings['member']['PLATINUM']['product_limit'];
    } else if ($this->hasRole('GOLD')) {
      $limit = $settings['member']['GOLD']['product_limit'];
    } else {
      $limit = $settings['member']['NORMAL']['product_limit'];
    }
    return $limit;
  }
  
  public function getAnnouncement() {
    return Shopsettings::findByUserid($this->getId())->getShopAnnouncement();
  }
  
  public function getAnnouncementFormatted() {
    return str_replace("\n", "<br />", $this->getAnnouncement());
  }
  
  public function getShopWechat() {
    return Shopsettings::findByUserid($this->getId())->getShopWechat();
  }
  
  public function getShopPhone() {
    return Shopsettings::findByUserid($this->getId())->getShopPhone();
  }
  
  public function getShopAddress() {
    return Shopsettings::findByUserid($this->getId())->getShopAddress();
  }
  
  public function getShopEmail() {
    return Shopsettings::findByUserid($this->getId())->getShopEmail();
  }
}