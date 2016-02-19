<?php if (is_login()): ?>
<a href="<?php echo $user->getShopUri(); ?>">Shop</a>
<?php else: ?>
<a href="<?php echo uri('users'); ?>">login</a>
<?php endif; ?>
