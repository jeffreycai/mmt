<?php if ($user->hasPermission('use payment function')): ?>
  <div class="body">
    <div class="row section">
      <form action="<?php echo uri('user/shop/payment') ?>" method="POST">
      <div class="col-xs-12">
        <br />

        <div class="alert alert-info" id="iknow"> <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>请谨慎更改支付设置,如果您不清楚它们是做什么的,请不要更改!<br />
          <p style="text-align: center;"><a class="btn btn-sm btn-info" href="#"><strong>没关系,我知道自己在做什么</strong></a></p></div>

        <br />

        <?php echo Message::renderMessages(); ?>


          <div class="form-group">
            <label for="stripe_public_key" class="control-label"><?php echo i18n(array(
              'en' => 'Stripe publishable key',
              'zh' => 'Stripe公共密匙(Publishable key)'
            )) ?> <span style="color:red">*</span></label>
            <input disabled="" type="text" name="stripe_public_key" required class="form-control" placeholder="<?php echo i18n(array(
              'en' => 'Stripe publishable key',
              'zh' => 'Stripe publishable key'
            )) ?>" value="<?php echo (isset($_POST['stripe_public_key']) ? $_POST['stripe_public_key'] : ($settings ? $settings->getStripePublicKey() : '')) ?>" />
          </div>
          <div class="form-group">
            <label for="stripe_private_key" class="control-label"><?php echo i18n(array(
              'en' => 'Stripe secret key',
              'zh' => 'Stripe私人密匙(Secret key)'
            )) ?> <span style="color:red">*</span></label>
            <input disabled="" type="text" name="stripe_private_key" required class="form-control" placeholder="<?php echo i18n(array(
              'en' => 'Stripe secret key',
              'zh' => 'Stripe secret key'
            )) ?>" value="<?php echo (isset($_POST['stripe_private_key']) ? $_POST['stripe_private_key'] : ($settings ? $settings->getStripePrivateKey() : '')) ?>" />
          </div>

      </div>

      <div class="col-xs-12">
        <input disabled="" class="btn btn-success" style="float: right; margin-bottom: 20px;" type="submit" name="submit" value="<?php echo i18n(array(
          'en' => 'Submit',
          'zh' => '提交'
        )) ?>" />
        <div class="clearfix"></div>
      </div>
        </form>
    </div>

  </div>

  <script type="text/javascript">
    $('#iknow a.btn').click(function(){
      $('input').prop('disabled', false);
      $('#iknow').fadeOut();
      return false;
    });
  </script>
  
<?php else: ?>
  
  <div class="body">
    <div class="row section">
      <div class="col-xs-12">
        <br />
        <div class="alert alert-info" style="text-align: center;"> <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>您尚未开通在线支付功能<br />
          <p style="text-align: center;"><a class="btn btn-sm btn-info" href="#"><strong>马上开通</strong></a></p>
        </div>
      </div>
    </div>
  </div>
  
<?php endif; ?>
