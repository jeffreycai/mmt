
<?php foreach ($settings['promoted_shops'] as $ps): $shop = MySiteUser::findByUsername($ps, 'MySiteUser'); ?>
  <?php if ($shop && $shop->getUserName() != $user->getUserName()): ?>
<div class="col-xs-4 col-sm-3 promoted_shop">
  <h3><?php echo $shop->getShopName(); ?></h3>
  <a href="<?php echo $shop->getShopUri(); ?>" target="_blank">
    <img class="img-responsive" src="<?php echo $shop->getShopLogo() ?>" />
  </a>
</div>
  <?php endif; ?>
<?php endforeach; ?>