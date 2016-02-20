<div class="container">
  <div class="row">
    <div id="header" style="background-image: url(<?php echo uri('modules/theme_default/assets/images/bg1.jpg', false) ?>); background-size: cover;">
      <div class="profile">
        <img width="80" height="80" src="<?php echo isset($shoplogo) ? $shoplogo : 'http://placehold.it/80x80' ?>" alt="<?php echo $shopname; ?>" />
        <h1><?php echo $shopname ?></h1>
      </div>
      <?php if (isset($product_onsale_number)): ?>
      <ul class="badgets">
        <li><?php echo $product_onsale_number; ?> <br />宝贝</li>
      </ul>
      <?php endif; ?>
    </div>
  </div>
</div>