<header>
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <a class="goback" href="<?php echo isset($gobackuri) ? $gobackuri : uri('user') ?>"><i class="fa fa-angle-left"></i></a>
  <div class="btn-group" role="group" aria-label="product filter">
    <?php $s = $sorting; $s['onshelf'] = "1"; ?>
    <a class="btn btn-default <?php echo $sorting['onshelf'] == '1' ? 'active' : '' ?>" href="<?php echo uri('user/products') . "?" . build_sorting_uri_vars($s) ?>"><?php echo i18n(array(
        'en' => 'On shelf',
        'zh' => '出售中'
    )) ?></a>
    <?php $s = $sorting; $s['onshelf'] = "0"; ?>
    <a class="btn btn-default <?php echo $sorting['onshelf'] == '0' ? 'active' : '' ?>" href="<?php echo uri('user/products') . "?" . build_sorting_uri_vars($s) ?>"><?php echo i18n(array(
        'en' => 'Off shelf',
        'zh' => '已下架'
    )) ?></a>
  </div>
        <div class="right">
          <?php echo isset($right) ? $right : '' ?>
        </div>
      </div>
    </div>
  </div>
</header>