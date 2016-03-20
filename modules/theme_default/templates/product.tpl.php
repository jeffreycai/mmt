
<div id="product" class="page-body">
  
  <?php if (!empty(Message::peekMessages())): ?>
  <div class="container">
    <div class="row">
      <div class="col-xs-12" style="padding-top: 8px;">
        <?php echo Message::renderMessages(); ?>
      </div>
    </div>
  </div>
  <?php endif; ?>
  
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <h2><?php echo htmlentities($product->getTitle()) ?></h2>
        <p class="price">
          $<?php echo $product->getPrice() ?>
          <?php if (!empty($product->getOriginalPrice())): ?>
            &nbsp;&nbsp;&nbsp;<span><del>$<?php echo $product->getOriginalPrice(); ?></del></span>
          <?php endif; ?>
        </p>
      </div>
      <div class="col-xs-4 subcontent">
        <small>库存：<?php echo $product->getStock() ?></small>
      </div>
      <div class="col-xs-4 subcontent">
        &nbsp;
      </div>
      <div class="col-xs-4 subcontent">
        &nbsp;
      </div>
    </div>
  </div>
  
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <h3>商品简介</h3>
        <div class="description">
          <?php echo $product->getDescriptionFormatted() ?>
        </div>
      </div>
    </div>
  </div>
  
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <h3><img src="<?php echo uri('favicon', false) ?>/favicon-16x16.png" style="float: left; display: block; margin-right: 8px;" /> 卖家： <?php echo $user->getShopName() ?></h3>
        <div class="description">
          <?php echo $user->getShopIntroductionFormatted() ?>
        </div>
      </div>
      <div class="col-xs-6 subcontent">
        <a class="btn btn-default btn-sm" href="<?php echo $user->getShopUri() ?>/contact"><i class="fa fa-envelope"></i> 联系商家</a>
      </div>
      <div class="col-xs-6 subcontent">
        <a class="btn btn-default btn-sm" href="<?php echo $user->getShopUri() ?>"><i class="fa fa-shopping-bag"></i> 进入店铺</a>
      </div>
    </div>
  </div>
  
  <?php if (!$user->hasPermission('no ads')): ?>
    <div class="container section">
      <div class="row">
        <div class="col-xs-12">
          <a style="width: 100%;" class="btn btn-danger btn-lg" target="_blank" href="<?php echo uri('') ?>">我也要免费开微店,澳元在线收账!</a>
        </div>
      </div>
    </div>
  <?php endif; ?>
  
</div>