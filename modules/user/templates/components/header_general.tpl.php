<header class="row">
  <div class="col-xs-12">
    <a class="goback" href="<?php echo isset($gobackuri) ? $gobackuri : uri('user') ?>"><i class="fa fa-angle-left"></i></a>
    <h1><?php echo $title ?></h1>
    <div class="right">
      <?php echo isset($right) ? $right : '' ?>
    </div>
  </div>
</header>