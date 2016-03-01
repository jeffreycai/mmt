<p>
  您有新的订单：(已支付)
</p>
<p>
  <br />
  订单号: <strong><?php echo $purchase_order->getPublicId() ?></strong><br />
  查看： <a href="http://<?php echo SITEDOMAIN ?>/user/orders">http://<?php echo SITEDOMAIN ?>/user/orders</a>
</p>

<p>
  -----------------
</p>

<?php $html = new HTML(); ?>
<?php echo $html->render('theme_default/components/order_details_simple', array(
  'purchase_order' => $purchase_order
)); ?>
