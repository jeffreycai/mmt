<div class="body">
  <div class="row hero section">
    <div class="col-xs-12">
        <img class="logo" src="<?php echo uri('modules/user/assets/images/logo.png', false) ?>" /> 
        <span><?php echo i18n(array(
        'en' => 'Your online shop',
        'zh' => '您的微店平台'
        )) ?></span>
    </div>
  </div>
  
  <div class="row list section">
    <div class="col-xs-12">
      <a href="<?php echo uri('user/shop/settings') ?>">微店设置 <?php echo empty($user->getShopSettings()->getShopName()) ? '<span>未设置</span>' : '' ?><i class="fa fa-angle-right"></i></a>
    </div>
    <div class="col-xs-12">
      <a href="<?php echo uri('user/shop/announcement') ?>">微店公告 <?php echo empty($user->getAnnouncement()) ? '<span>未设置</span>' : '' ?><i class="fa fa-angle-right"></i></a>
    </div>
    <div class="col-xs-12">
      <a href="<?php echo uri('user/shop/payment') ?>">支付设置 <?php echo $user->isPaymentSet() ? '' : '<span>未设置</span>' ?><i class="fa fa-angle-right"></i></a>
    </div>
    <div class="col-xs-12">
      <a href="<?php echo uri('user/platform_contact') ?>">联系平台客服 <i class="fa fa-angle-right"></i></a>
    </div>
  </div>
</div>