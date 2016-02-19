<div class="container">
  
  <div class="row section">
    <div class="col-xs-12">
      <div class="alert alert-info" role="alert" style="text-align: center; margin-top: 20px;">
        您的订单已成功下达。商家会收到订单提醒并及时处理。<br />请记录您的订单号，<strong>妥善保管</strong>，以便向商家查询：<br /><br />
        <strong style="font-size: 2em;"><?php echo $purchase_order->getPublicId() ?></strong>
      </div>
      <p style="text-align: center;"><small>* 请记录您的订单号，为保护您的隐私，此页面<?php echo $settings['purchase_order_page_life_time'] ?>分钟后将无法访问</small></p>
    </div>
  </div>
  
  <div class="row section">
    
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