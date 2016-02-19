<p>
  <?php echo $purchase_order->getName() ?>您好，
  <br />
  <br />
  您的订单<strong><?php echo $purchase_order->getPublicId() ?></strong>已成功发送给商家 <?php echo $purchase_order->getUser()->getShopName() ?>。<br />
  回复本邮件可以直接和商家联系。
</p>


<?php $html = new HTML(); ?>
<?php echo $html->render('theme_default/components/order_details_simple', array(
  'purchase_order' => $purchase_order
)); ?>
