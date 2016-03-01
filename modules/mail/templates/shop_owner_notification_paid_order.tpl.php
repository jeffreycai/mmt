<p>
  您有新的订单 - <strong><?php echo $purchase_order->getPublicId() ?></strong>.<br />
  订单已付款。
</p>

<p>
  -----------------
</p>

<?php $html = new HTML(); ?>
<?php echo $html->render('theme_default/components/order_details_simple', array(
  'purchase_order' => $purchase_order
)); ?>
