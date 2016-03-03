
<div class="tiles container">
  <div class="row">
<?php if (sizeof($products)): ?>
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