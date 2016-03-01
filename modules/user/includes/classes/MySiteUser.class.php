<?php

require_once MODULESROOT . DS . 'siteuser' . DS . 'includes' . DS . 'classes' . DS . 'SiteUser.class.php';

class MySiteUser extends SiteUser {
  /**
   * create user data, if not there
   */
  public function init_user_data() {
    
  }
  
  public function save() {
    // when it is a new object, we creat a shopsettings object for it
    $shop_settings = null;
    if ($this->isNew()) {
      $shop_settings = new Shopsettings();
    }
    
    $rtn = parent::save();
    
    // create shop settings
    if (!is_null($shop_settings)) {
      $shop_settings->setUserId($this->getId());
      $shop_settings->save();
    }
    
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
    $stripe = new MyStripe(decrypt($settings['admin_stripe_public_key_'.ENV]), decrypt($settings['admin_stripe_secret_key_'.ENV]));
    
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
    $setup_fee_literal = $setup_fee == 0 ? '免费' : '$'.$setup_fee;
    
    $rtn = Message::renderMessages() . '
<form action="'.$action.'" method="POST" id="signup" name="signup">
  <div class="form-group" id="form-field-member_type" style="text-align:center;">
    <div class="btn-group" role="group" aria-label="会员类型">
      '.$member_type_btn_group.'
    </div>
    <p style="margin-top: 10px; font-size:30px;color: #4a90e2;" id="setup_fee">'.$setup_fee_literal.'</p>
    <p><a href="'.uri('#pricing').'">&laquo; 查看会员类型区别</a></p>
    <input type="hidden" name="member_type" id="member_type" value="'.($member_type).'" />
    <script type="text/javascript">
      jQuery(function(){
        clickAction($(".btn-group .active").first());
        // when a member type is selected, update corresponding components
        $("#form-field-member_type .btn").click(function(){
          clickAction($(this));
        });

        function clickAction(btn) {
          // update hidden input and buttons
          var type = btn.data("type");
          var fee = btn.data("fee") == "0" ? "免费" : ("$" + btn.data("fee"));
          $("#member_type").val(type);
          $("#form-field-member_type .btn").removeClass("active");
          btn.addClass("active");
          $("#setup_fee").html(fee);
          // update payment form and parent form
          if (btn.data("fee") == "0") {
            $("#payment").slideUp();
            $("#payment input").attr("required", false);
            $("#card_number").addClass("disabled");
          } else {
            $("#payment").slideDown();
            $("#payment input").attr("required", true);
            $("#card_number").removeClass("disabled");
          }
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
  ' . (class_exists('MySiteProfile') ? MySiteProfile::renderUpdateForm($user) : (class_exists('SiteProfile') ? SiteProfile::renderUpdateForm($user) : '')) 
    . (in_array('active', $exclude_fields) ? '' : $active_field) . '
      
  <div id="payment" style="'.($member_type == 'NORMAL' ? 'display:none;' : '').'">
  <hr>
  <div class="form-group" style="text-align:center;">
    <p><i style="color:#28679A; font-size: 6em;" class="fa fa-lock"></i></p>
    <p>安全支付</p>
  </div>
'.$stripe->renderPaymentForm().'
  <hr>
  </div>
  <div class="form-group">
    <input type="checkbox" name="terms" id="terms" value="1" /> <label for="terms">我已阅读,并同意'.$settings['sitename_short'].'的<a href="'.uri('terms').'" target=_blank>服务条款</a> '.$mandatory_label.'</label>
    <br /><input type="checkbox" name="privacy" id="privacy" value="1" /> <label for="privacy">我已阅读,并同意'.$settings['sitename_short'].'的<a href="'.uri('privacy').'" target=_blank>隐私条款</a> '.$mandatory_label.'</label>
    <br /><input type="checkbox" name="cookies" id="cookies" value="1" /> <label for="cookies">我已阅读,并同意'.$settings['sitename_short'].'的<a href="'.uri('cookies').'" target=_blank>Cookie使用说明</a> '.$mandatory_label.'</label>
  </div>
  
  <div class="form-group" id="form-field-notice"><small><i>
    '.$mandatory_label.i18n(array(
        'en' => ' indicates mandatory fields',
        'zh' => ' 标记为必填项'
    )).'
  </i></small></div>
  <input type="submit" class="btn btn-primary btn-block disabled" value="'.i18n(array(
      'en' => 'Signup',
      'zh' => '注册'
  )).'" />
  '.(module_enabled('form') ? Form::loadSpamToken('#signup', SITEUSER_FORM_SPAM_TOKEN) : '').'
</form>
';
    return $rtn;
  }
  
  public function getMemberType() {
    $settings = Vars::getSettings();
    
    // get all types in an array
    $types = array();
    $i = 0;
    foreach ($settings['member'] as $type => $confs) {
      $types[$i] = $type;
      $i++;
    }
    
    // get user roles in an array
    $roles = $this->getRoles();
    $user_types = array();
    foreach ($roles as $role) {
      $user_types[] = $role->getName();
    }
    
    // compare and return the highest member type
    for ($i = sizeof($types) - 1; $i >= 0; $i--) {
      foreach ($user_types as $user_type) {
        if ($user_type == $types[$i]) {
          return $user_type;
        }
      }
    }
  }
}