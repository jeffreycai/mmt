<?php

require_once MODULESROOT . DS . 'siteuser' . DS . 'includes' . DS . 'classes' . DS . 'SiteUser.class.php';

class MySiteUser extends SiteUser {
  /**
   * create user data, if not there
   */
  public function init_user_data() {
    
  }
  
  public function save() {
    $rtn = parent::save();
    
    // create shop settings
    $shop_settings = new Shopsettings();
    $shop_settings->setUserId($this->getId());
    $shop_settings->save();
    
    return $rtn;
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
  
  public function delete() {
    // remove user folder
    $user_folder = FILE_DIR . '/files/user/' .$this->getId();
    if (is_dir($user_folder)) {
      delFolder($user_folder);
    }
    return parent::delete();
  }
  
  
  static function renderSignupForm(SiteUser $user = null, $action = '', $exclude_fields = array()) {
    $settings = Vars::getSettings();
    
    // set default action value
    if ($action != '') {
      $action = uri($action);
    }
    
    // get vars from form submission
    $username = isset($_POST['username'])  ? strip_tags($_POST['username'])  : (isset($user) ? $user->getUsername()  : '');
    $email    = isset($_POST['email'])     ? strip_tags($_POST['email'])     : (isset($user) ? $user->getEmail()     : '');
    $password = '';
    $password_confirm = '';
    $active   = isset($_POST['active'])    ? strip_tags($_POST['active'])    : (isset($user) ? $user->getActive()    : false);
    
    $mandatory_label = ' <span style="color: rgb(185,2,0); font-weight: bold;">*</span>';
    
    $active_field = '
  <div class="checkbox" id="form-field-active">
    <label>
      <input type="checkbox" id="active" name="active" value="1" '.($active == false ? '' : 'checked="checked"').'> '.  i18n(array('en' => 'Active?', 'zh' => '有效用户')).'
    </label>
  </div>
  ';
    
    $member_type = isset($_POST['member_type']) ? strip_tags($_POST['member_type']) : (isset($_GET['member_type']) ? strip_tags($_GET['member_type']) : 'NORMAL');
    $member_type_btn_group = "";
    foreach ($settings['member'] as $type => $confs) {
      $member_type_btn_group .= "      <button type=\"button\" class=\"btn btn-default ".($member_type == $type ? 'active' : '')."\" data-type=\"$type\" data-fee=\"".$confs['setup_fee']."\">".$confs['name']."</button>\n";
    }
    $setup_fee = $settings['member'][$member_type]['setup_fee'];
    
    $rtn = Message::renderMessages() . '
<form action="'.$action.'" method="POST" id="signup" enctype="multipart/form-data">
  <div class="form-group" id="form-field-member_type" style="text-align:center;">
    <div class="btn-group" role="group" aria-label="会员类型">
      '.$member_type_btn_group.'
    </div>
    <p style="margin-top: 10px;" id="setup_fee">$'.$setup_fee.'</p>
    <input type="hidden" name="member_type" id="member_type" value="'.($member_type).'" />
    <script type="text/javascript">
      // when a member type is selected, update corresponding components
      $("#form-field-member_type .btn").click(function(){
        // update hidden input and buttons
        var type = $(this).data("type");
        var fee = $(this).data("fee") == "0" ? "免费" : ("$" + $(this).data("fee"));
        $("#member_type").val(type);
        $("#form-field-member_type .btn").removeClass("active");
        $(this).addClass("active");
        $("#setup_fee").html(fee);
        // update payment form
        if ($(this).data("fee") == "0") {
          $("#payment").slideUp();
        } else {
          $("#payment").slideDown();
        }
      });
    </script>
  </div>
  <div class="form-group" id="form-field-username">
    <label for="username">'.i18n(array('en' => 'Username', 'zh' => '用户名')).$mandatory_label.' <small style="font-weight: normal;"><i>('.  i18n(array('en' => 'alphabetical letters, number or underscore', 'zh' => '英文字母，数字或下划线')).')</i></small></label>
    <input type="text" class="form-control" id="username" name="username" value="'.$username.'" required placeholder="" />
  </div>
  <div class="form-group" id="form-field-email" >
    <label for="email">'.i18n(array('en' => 'Email', 'zh' => '电子邮箱')).$mandatory_label.'</label>
    <input type="email" class="form-control" id="email" name="email" value="'.$email.'" required />
  </div>
  <div class="form-group" id="form-field-password">
    <label for="password">'.i18n(array('en' => 'Password', 'zh' => '密码')).$mandatory_label.' <small style="font-weight: normal;"><i>('.i18n(array('en' => 'at least 6 letters', 'zh' => '至少6位')).')</i></small></label>
    <input type="password" class="form-control" id="password" name="password" value="'.$password.'" required />
  </div>
  <div class="form-group" id="form-field-password_confirm">
    <label for="password_confirm">'.i18n(array('en' => 'Password again', 'zh' => '再次确认密码')).$mandatory_label.'</label>
    <input type="password" class="form-control" id="password_confirm" name="password_confirm" value="'.$password_confirm.'" required />
  </div>
  ' . (class_exists('SiteProfile') ? SiteProfile::renderUpdateForm($user, $exclude_fields) : '') 
    . (in_array('active', $exclude_fields) ? '' : $active_field) . '
      
  <div id="payment">
  <hr>
    <div class="alert alert-danger payment-errors" role="alert" style="display: none;"></div>

    <div class="form-row form-group">
      <label for="card_number">
        信用卡号码
      </label>
      <input id="card_number" class="form-control" type="text" size="20" maxlength="20" data-stripe="number" required placeholder="您的信用卡卡号" autocomplete="off" />
    </div>

    <div class="form-row form-group">
      <label for="cvc">
        <span>CVC</span>
      </label>
      <input id="cvc" class="form-control" type="text" size="4" maxlength="4" data-stripe="cvc" required placeholder="CVC码" autocomplete="off" />
    </div>

    <div class="form-row form-group">
      <label style="display: block;" for="month">
        <span>有效期 (MM/YYYY)</span>
      </label>
      <input style="display: inline-block; width: 4em;" class="form-control" id="month" type="text" size="2" maxlength="2" data-stripe="exp-month" placeholder="MM" autocomplete="off" />
      <span> / </span>
      <input style="display: inline-block; width: 6em;" class="form-control" id="year" type="text" size="4" maxlength="4" data-stripe="exp-year" placeholder="YYYY" autocomplete="off" />
    </div>
  <hr>
  </div>

  <div class="form-group" id="form-field-notice"><small><i>
    '.$mandatory_label.i18n(array(
        'en' => ' indicates mandatory fields',
        'zh' => ' 标记为必填项'
    )).'
  </i></small></div>
  <input type="submit" name="submit" class="btn btn-primary btn-block disabled" value="'.i18n(array(
      'en' => 'Signup',
      'zh' => '注册'
  )).'" />
  '.(module_enabled('form') ? Form::loadSpamToken('#signup', SITEUSER_FORM_SPAM_TOKEN) : '').'
</form>
';
    return $rtn;
  }
}