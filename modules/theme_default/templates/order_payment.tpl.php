<div class="container">
  <div class="row section">
    
    <!-- payment form -->
    <?php echo $html->render('theme_default/components/stripe_form', array(
      'stripe_public_key' => $stripe_public_key
    )); ?>
    <!-- /payment form -->
    
    
    <!-- order details -->
    <div class="col-xs-12">
      <div style="margin: 10px 0px;">
      <a href="#" class="more collapsed"><i class="fa fa-caret-right"></i> 点击查看订单详情</a>
      </div>
    </div>
    
    <div class="details" style="display: none;">
      <div class="col-xs-12">
        下单时间: <?php echo $purchase_order->getConfirmedAt('Y-m-d H:i:s') ?>
      </div>
    <?php echo $html->render('theme_default/components/order_details', array(
      'purchase_order' => $purchase_order
    )); ?>
    </div>
    <!-- /order details -->
    

  </div>
</div>


<script type="text/javascript">
  $('.more').click(function(){
    if ($(this).hasClass('collapsed')) {
      $(this).removeClass('collapsed');
      $('i', this).removeClass('fa-caret-right').addClass('fa-caret-down');
      $('.details').slideDown();
    } else {
      $(this).addClass('collapsed');
      $('i', this).removeClass('fa-caret-down').addClass('fa-caret-right')
      $('.details').slideUp();
    }
  });
</script>