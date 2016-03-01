<?php
require_once MODULESROOT . DS . 'siteuser_profile' . DS . 'includes' . DS . 'classes' . DS . 'SiteProfile.class.php';

class MySiteProfile extends SiteProfile {
  static function renderUpdateForm(SiteUser $user = null, $exclude_fields = array()) {
    $settings = Vars::getSettings();
    
    $profile = $user ? $user->getProfile() : null;

    // get vars from form submission
    $nickname = isset($_POST['nickname'])  ? strip_tags($_POST['nickname'])  : (isset($profile) ? $profile->getNickname()  : '');
    $phone = isset($_POST['phone']) ? strip_tags($_POST['phone']) : (isset($profile) ? $profile->getPhone() : '');
    
    $mandatory_label = ' <span style="color: rgb(185,2,0); font-weight: bold;">*</span>';
    $avatar_field = '
  <div class="form-group" id="form-field-avatar" >
    <label for="avatar">'.i18n(array('en' => 'Avatar', 'zh' => '头像')).' <small style="font-weight: normal;"><i>('.  i18n(array(
        'en' => 'optional',
        'zh' => '可选'
    )).')</i></small></label>
    '.( $profile ? "<div><img src='" . $profile->getThumbnailUrl() . "' alt='" . $user->getUsername() . "' style='cursor: pointer;' /></div>" : '').'
    <input type="file" id="avatar" name="avatar"' .($profile ?  ' style="display: none;"' : '') . ' />
    <small>'.  i18n(array(
        'en' => 'Max image file size: ' . round($settings['profile']['avatar_max_size'] / 1000000, 1) . 'MB',
        'zh' => '最大图片上传尺寸： ' . round($settings['profile']['avatar_max_size'] / 1000000, 1) . 'MB'
    )).'</small>
  </div>
';
    $phone_field = '
  <div class="form-group" id="form-field-phone">
    <label for="phone">'.i18n(array('en' => 'Mobile number', 'zh' => '手机号码')).$mandatory_label.' <small style="font-weight: normal;"><i>('.i18n(array(
        'en' => 'Your mobile phone number',
        'zh' => '您的手机号码，用来接收订单提醒'
    )).')</i></small></label>
    <input type="text" class="form-control" id="phone" name="phone" value="'.$phone.'" required placeholder="" />
  </div>
';
    $rtn = '
  <div class="form-group" id="form-field-nickname">
    <label for="nickname">'.i18n(array('en' => 'Nick name', 'zh' => '昵称')).$mandatory_label.' <small style="font-weight: normal;"><i>('.i18n(array(
        'en' => 'what others see you as',
        'zh' => '其他用户看到的您的称呼'
    )).')</i></small></label>
    <input type="text" class="form-control" id="nickname" name="nickname" value="'.$nickname.'" required placeholder="" />
  </div>
  ' . (in_array('avatar', $exclude_fields) ? '' : $avatar_field) . '
  ' . (in_array('phone', $exclude_fields) ? '' : $phone_field) . '
  <script type="text/javascript">
    $("#form-field-avatar img").click(function(){
      $("#avatar").trigger("click");
    });
    $("#avatar").change(function(){
      //$("#form-field-avatar img").fadeOut();
      $(this).fadeIn();
    });
  </script>
';
    return $rtn;
  }
}