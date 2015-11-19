<div class="container">
  <div class="row">
    <div class="col-xs-12">
      <h1><?php echo i18n(array(
          'en' => 'System backend',
          'zh' => '系统后台'
      )) ?></h1>
    </div>
  </div>
  <div class="row">
    <nav id="mainnav">
      <div class="col-xs-6">
        <a href="#" class="nav-button bg-red">
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
    </nav>
  </div>
</div>