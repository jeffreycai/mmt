<div class="container">
  <div class="row">
    <div class="col-xs-12">
      <h1><?php echo i18n(array(
          'en' => 'System backend',
          'zh' => '微店后台'
      )) ?></h1>
    </div>
  </div>
  
  <div class="row">
    <nav id="mainnav">
      <div class="col-xs-6">
        <a href="<?php echo uri('user/shop') ?>" class="nav-button bg-red">
          <i class="fa fa-building"></i>
          <span><?php echo i18n(array(
              'en' => 'My Shop',
              'zh' => '微店'
          )) ?></span>
        </a>
      </div>
      <div class="col-xs-6">
        <a href="<?php echo uri('user/products') ?>" class="nav-button bg-cyan">
          <i class="fa fa-gift"></i>
          <span><?php echo i18n(array(
              'en' => 'Products',
              'zh' => '商品'
          )) ?></span>
        </a>
      </div>
      <div class="col-xs-6">
        <a href="<?php echo uri('user/orders') ?>" class="nav-button bg-yellow">
          <i class="fa fa-file-text-o"></i>
          <span><?php echo i18n(array(
              'en' => 'Orders',
              'zh' => '订单'
          )) ?></span>
        </a>
      </div>
    </nav>
  </div>
  
  <div class="row">
    <div class="col-xs-12" style="margin-top: 20px;">
      <a style="width: 140px; background-color: #008ECB; color:#EEE; margin: 0px auto; display: block; text-align: center; padding: 5px 8px; border: 3px solid #EEE; -webkit-border-radius: 10px 10px 10px 10px; border-radius: 10px 10px 10px 10px;" href="<?php echo $user->getShopUri() ?>"><i class="fa fa-reply"></i> <?php echo i18n(array(
        'en' => 'Go to shop frontend',
        'zh' => '前往微店前台'
      )) ?></a>
    </div>
  </div>
</div>