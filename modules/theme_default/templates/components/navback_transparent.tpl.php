<div id="navback" class="transparent">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <a class="backbtn" href="<?php echo isset($uri) ? $uri : '#' ?>" onclick="<?php echo isset($uri) ? '' : 'history.go(-1);' ?>"><i class="fa fa-chevron-circle-left"></i></a>
        <!--<a class="cart" href="<?php echo $user->getShopUri() ?>/checkout"><i class="fa fa-shopping-cart"></i></a>-->
      </div>
    </div>
  </div>
</div>