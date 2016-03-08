<div class="body">
  <div class="row hero section">
    <div class="col-xs-12">
        <i class="fa fa-user logo"></i>
        <span><?php echo i18n(array(
        'en' => 'Manage your account',
        'zh' => '管理帐号'
        )) ?></span>
    </div>
  </div>
  
  <div class="row list section">
    <div class="col-xs-12">
      <a href="<?php echo uri('user/account/details') ?>">更改个人信息及密码 <i class="fa fa-angle-right"></i></a>
    </div>
    <div class="col-xs-12">
      <a href="<?php echo uri('user/account/change') ?>">更改会员类型 <span><?php echo $user->getMemberType(true) ?></span><i class="fa fa-angle-right"></i></a>
    </div>
    <div class="col-xs-12">
      <a href="<?php echo uri('user/account/charges') ?>">查看平台支付记录 <i class="fa fa-angle-right"></i></a>
    </div>
  </div>
</div>