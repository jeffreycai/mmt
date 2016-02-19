<nav id="mainnav" class="container">
  <div class="row">
    <div class="col-xs-3">
      <a href="<?php echo $user->getShopUri() ?>" class="<?php echo_link_active_class('//', get_cur_page_url()) ?>">
        <span class="fa fa-home"></span><br />
        <?php echo i18n(array(
          'en' => 'Home',
          'zh' => '首页'
      )) ?>
      </a>
    </div>
    <div class="col-xs-3">
      <a href="<?php echo $user->getShopUir() ?>/contact" class="<?php echo_link_active_class('/contact$/', get_cur_page_url()) ?>">
        <span class="fa fa-envelope-o"></span><br />
        <?php echo i18n(array(
          'en' => 'Contact',
          'zh' => '联系店家'
      )) ?>
      </a>
    </div>
    <div class="col-xs-3">
      <a href="<?php echo $user->getShopUri() ?>/checkout">
        <span class="fa fa-shopping-cart"></span><br />
        <?php echo i18n(array(
          'en' => 'Shopping cart',
          'zh' => '购物车'
      )) ?>
      </a>
    </div>
<?php if (MySiteUser::getCurrentUser()->getId() == $user->getId()): ?>
    <div class="col-xs-3">
      <a href="<?php echo uri('user') ?>">
        <span class="fa fa-user"></span><br />
        <?php echo i18n(array(
          'en' => 'Backend',
          'zh' => '微店后台'
        )) ?>
      </a>
    </div>
<?php endif; ?>
  </div>
</nav>