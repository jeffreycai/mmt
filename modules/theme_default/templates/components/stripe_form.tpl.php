<?php 
/**
 * Required parrameters:
 * - $stripe_public_key
 */
?>

<div class="col-xs-12">
  
  <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
  
  <form id="creditcard" action="" method="POST" id="payment-form" autocomplete="off">
    <div class="alert alert-danger payment-errors" role="alert" style="display: none;"></div>

    <div class="form-row form-group">
      <label for="card_number">
        <span><?php echo i18n(array(
          'en' => 'Credit card number',
          'zh' => '信用卡号码'
        )) ?></span>
      </label>
      <input id="card_number" class="form-control" type="text" size="20" maxlength="20" data-stripe="number" required placeholder="<?php echo i18n(array(
                      'en' => 'Your credit card number',
                      'zh' => '您的信用卡卡号'
                  )) ?>" autocomplete="off" />
    </div>

    <div class="form-row form-group">
      <label for="cvc">
        <span>CVC</span>
      </label>
      <input id="cvc" class="form-control" type="text" size="4" maxlength="4" data-stripe="cvc" required placeholder="<?php echo i18n(array(
                      'en' => 'CVC number',
                      'zh' => 'CVC码'
                  )) ?>" autocomplete="off" />
    </div>

    <div class="form-row form-group">
      <label style="display: block;" for="month">
        <span><?php echo i18n(array(
          'en' => 'Expiration',
          'zh' => '有效期'
        )) ?> (MM/YYYY)</span>
      </label>
      <input style="display: inline-block; width: 4em;" class="form-control" id="month" type="text" size="2" maxlength="2" data-stripe="exp-month" placeholder="MM" autocomplete="off" />
      <span> / </span>
      <input style="display: inline-block; width: 6em;" class="form-control" id="year" type="text" size="4" maxlength="4" data-stripe="exp-year" placeholder="YYYY" autocomplete="off" />
    </div>

    <div class="form-group">
      <button class="btn btn-success" style="float: right;" type="submit"><?php echo i18n(array(
        'en' => 'Submit Payment',
        'zh' => '提交支付'
      )) ?>
      </button>
      <div class="clearfix"></div>
    </div>
  </form>
</div>


<script type="text/javascript">
// This identifies your website in the createToken call below
Stripe.setPublishableKey("<?php echo $stripe_public_key ?>");
var payment_btn_text;
jQuery(function($){
  $('#creditcard').submit(function(event) {
    event.preventDefault();
    
    var $form = $(this);
    payment_btn_text = $form.find('button').html();

    // Disable the submit button to prevent repeated clicks
    $form.find('button').prop('disabled', true).html("<?php echo i18n(array(
        'en' => 'Processing ...',
        'zh' => '处理中 ...'
    )) ?>  <img src='<?php echo get_sub_root(); ?>/modules/theme_default/assets/images/ajax-loader.gif' alt='<?php echo i18n(array(
              'en' => 'loading',
              'zh' => '加载中'
            )); ?>' />");

    Stripe.card.createToken($form, stripeResponseHandler);

    // Prevent the form from submitting with the default action
    return false;
  });
});

function stripeResponseHandler(status, response) {
  var $form = $('#creditcard');

  if (response.error) {
    // Show the errors on the form
    var message = '';
    switch (response.error.code) {
      case 'incorrect_number':
        message = '<?php echo i18n(array(
            'en' => 'Your card number is incorrect.',
            'zh' => '您的卡号不正确'
        )) ?>'; break;
      case 'invalid_number':
        message = '<?php echo i18n(array(
            'en' => 'The card number is not a valid credit card number.',
            'zh' => '您填写的卡号不是一张有效的信用卡卡号'
        )) ?>'; break;
      case 'invalid_expiry_month':
        message = '<?php echo i18n(array(
            'en' => "The card\'s expiration month is invalid.",
            'zh' => '您填写的有效期月份不合法'
        )) ?>'; break;
      case 'invalid_expiry_year':
        message = '<?php echo i18n(array(
            'en' => "The card\'s expiration year is invalid.",
            'zh' => '您填写的有效期年份不合法'
        )) ?>'; break;
      case 'invalid_cvc':
        message = '<?php echo i18n(array(
            'en' => "Your card\'s security code (cvc) is invalid",
            'zh' => '您的CVC安全码无效'
        )) ?>'; break;
      case 'expired_card':
        message = '<?php echo i18n(array(
            'en' => 'The card has expired.',
            'zh' => '您的信用卡已过期'
        )) ?>'; break;
      case 'incorrect_cvc':
        message = '<?php echo i18n(array(
            'en' => "The card\'s security code (cvc) is incorrect.",
            'zh' => '您的CVC安全码不正确'
        )) ?>'; break;
      case 'incorrect_zip':
        message = '<?php echo i18n(array(
            'en' => "The card\'s zip code failed validation.",
            'zh' => '信用卡的zip码验证失败'
        )) ?>'; break;
      case 'card_declined':
        message = '<?php echo i18n(array(
            'en' => 'The card was declined.',
            'zh' => '信用卡支付请求被拒绝了'
        )) ?>'; break;
      case 'missing':
        message = '<?php echo i18n(array(
            'en' => 'There is no card on a customer that is being charged.',
            'zh' => '支付客户无信用卡'
        )) ?>'; break;
      case 'processing_error':
        message = '<?php echo i18n(array(
            'en' => 'An error occurred while processing the card.',
            'zh' => '信用卡支付处理出错'
        )) ?>'; break;
      case 'rate_limit':
        message = '<?php echo i18n(array(
            'en' => 'An error occurred due to requests too frequent.',
            'zh' => '支付请求过频'
        )) ?>'; break;
      default:
        message = '<?php echo i18n(array(
            'en' => 'An error has occured when processing your request',
            'zh' => '处理支付请求时出现错误'
        )) ?>';
    }
    
    $form.find('.payment-errors').show().html('<span class="glyphicon glyphicon-warning-sign"></span> ' + message + '。 支付请求取消，没有转账发生。');
    $form.find('button').prop('disabled', false).html(payment_btn_text);
  } else {
    // response contains id and card, which contains additional card details
    var stripeToken = response.id;
    // Insert the token into the form so it gets submitted to the server
    $form.append($('<input type="hidden" name="stripeToken" />').val(stripeToken));
    // and submit
    $form.get(0).submit();
  }
};
</script>