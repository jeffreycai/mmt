<p>
  订单 <strong><?php echo $purchase_order->getPublicId() ?></strong> 已付款。
</p>

<?php $html = new HTML(); ?>
<?php echo $html->render('theme_default/components/order_details_simple', array(
  'purchase_order' => $purchase_order
)); ?>
