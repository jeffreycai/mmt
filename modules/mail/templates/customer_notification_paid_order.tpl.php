<p>
  <?php echo $purchase_order->getName() ?>您好，
  <br />
  <br />
  您的订单<strong><?php echo $purchase_order->getPublicId() ?></strong>已付款成功。<br />
  回复本邮件可以直接和商家邮件联系。
</p>

<p>
  通过其他方式联系商家:<br />
  <?php $shop_url = "http://" . SITEDOMAIN . $purchase_order->getUser()->getShopUri() . "/contact"; ?>
  <a href="<?php echo $shop_url ?>"><?php echo $shop_url ?></a>
</p>

<p>
  -----------------
</p>

<?php $html = new HTML(); ?>
<?php echo $html->render('theme_default/components/order_details_simple', array(
  'purchase_order' => $purchase_order
)); ?>
