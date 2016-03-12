

<?php if (!empty($user->getAnnouncement())): ?>
<div class="container">
  <div class="row" style="background-color: #FFF">
    <div class="col-xs-12" style="background-color: #FFF; padding-top: 15px; padding-bottom: 15px;">

      <div class="alert alert-info" style="margin-bottom: 0px;"> <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
          <p><?php echo $user->getAnnouncementFormatted() ?></p>
      </div>

    </div>
  </div>
</div>
<?php endif; ?>

<div class="tiles container">
  <div class="row">
<?php if (sizeof($products)): ?>
    <div class="col-xs-12">
      <h2>上架商品</h2>
    </div>
    
  <?php foreach ($products as $product): ?>
      <a class="tile col-xs-6 col-sm-4" href="<?php echo ($user->getShopUri() . '/' . $product->getId()) ?>">
        <img class="img-responsive thumb" src="<?php echo uri($product->getThumbnail(), false) ?>" alt="<?php echo htmlentities($product->getTitle()) ?>" />
        <h3><?php echo $product->getTitle() ?></h3>
        <p class="price">
          $<?php echo $product->getPrice() ?>
  <?php if (!empty($product->getOriginalPrice())): ?>
          &nbsp;&nbsp;<span><del>$<?php echo $product->getOriginalPrice(); ?></del></span>
  <?php endif; ?>
          <span style="float: right;">库存: <?php echo $product->getStock() ?></span>
        </p>
      </a>
  <?php endforeach; ?>
<?php else: ?>
    <div class="col-xs-12">
      <div class="item">
      <p style="text-align: center; color: #AAA; margin-top: 30px; margin-bottom: 20px;"><?php echo '店家还没有放任何宝贝上来哦 ~' ?></p>
      </div>
    </div>
<?php endif; ?>
  </div>
  
</div>

<?php if (!$user->hasPermission('no ads')): ?>
<div class="container section">
  <div class="row">
    <div class="col-xs-12">
      <h2>推广商家</h2>
    </div>
    <?php $html->renderOut('theme_default/components/promoted_shops', array(
        'user' => $user
    )); ?>
  </div>
</div>

<div class="container section">
  <div class="row">
    <div class="col-xs-12">
      <a style="width: 100%;" class="btn btn-danger btn-lg" target="_blank" href="<?php echo uri('') ?>">我也要开微店,收澳元!</a>
    </div>
  </div>
</div>
<?php endif; ?>