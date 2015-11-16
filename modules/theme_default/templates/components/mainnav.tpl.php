<nav id="mainnav" class="container">
  <div class="row">
    <div class="col-xs-3">
      <a href="<?php echo uri('') ?>" class="<?php echo_link_active_class('//', get_cur_page_url()) ?>">
        <span class="fa fa-home"></span><br />
        <?php echo i18n(array(
          'en' => 'Home',
          'zh' => '首页'
      )) ?>
      </a>
    </div>
    <div class="col-xs-3">
      <a href="<?php echo uri('news') ?>" class="<?php echo_link_active_class('/^news$/', get_cur_page_url()) ?>">
        <span class="fa fa-bullhorn"></span><br />
        <?php echo i18n(array(
          'en' => 'News',
          'zh' => '店铺广播'
      )) ?>
      </a>
    </div>
    <div class="col-xs-3">
      
    </div>
    <div class="col-xs-3">
      
    </div>
  </div>
</nav>