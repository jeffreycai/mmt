<div class="container">
  <div class="row section">
    
<?php if (is_demo_account($user->getUserName())): ?>
    <div class="col-xs-12">
      <br />
      <div class="alert alert-info"> 
      <strong>请使用以下信用卡信息做测试用</strong><br />
      <strong>信用卡号码：</strong> 4242424242424242<br />
      <strong>CVC：</strong> 任意三位数字<br />
      <strong>有效日期：</strong> 08 2017
      </div>
    </div>
<?php endif; ?>
    
    <div class="col-xs-12">
      <br />
      <p style="font-size: 6em; text-align: center; color: #28679A;"><i class="fa fa-lock"></i></p>
      <p style="text-align: center;">安全支付</p>
    </div>
    
    <div class="col-xs-12">
      <?php echo Message::renderMessages(); ?>
    </div>
    
    <!-- payment form -->
    <div class="col-xs-12">  
      <form action="" method="POST" data-payment_disabled="false">
        <?php echo $stripe->renderPaymentForm(); ?>
        <div class="form-group">
          <button class="btn btn-success" style="float: right;" type="submit"><?php
                 echo i18n(array(
                   'en' => 'Submit Payment',
                   'zh' => '提交支付'
                 ))
                 ?>
          </button>
          <div class="clearfix"></div>
        </div>
      </form>
    </div>
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