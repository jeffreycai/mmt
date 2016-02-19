

<?php if (!empty($user->getAnnouncement())): ?>
<div class="container">
  <div class="row">

    <div class="alert alert-info" style="margin-bottom: 0px;"> <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
        <p><?php echo $user->getAnnouncementFormatted() ?></p>
    </div>

  </div>
</div>
<?php endif; ?>

<?php $html->renderOut('theme_default/components/tiles', array(
    'user' => $user,
    'products' => $products
)); ?>
