<div class="body">
  <div class="row hero section">
    <div class="col-xs-12">
        <i class="fa fa-users logo"></i>
        <span><?php echo i18n(array(
        'en' => 'Contact customer support',
        'zh' => '联系微店客服'
        )) ?></span>
    </div>
  </div>
  
  <div class="row section">
    <div class="col-xs-12">
      <br />
      <ul>
        <li>客服邮箱: <a href="mailto:<?php echo $settings['siteemail'] ?>"><?php echo $settings['siteemail'] ?></a></li>
        <li>客服微信: aueightnews</li>
        <li>微信二维码: </li>
      </ul>
    </div>
    <div class="col-xs-8 col-xs-offset-2">
      <img class="img-responsive" style="width: 100%;" src="<?php echo uri('modules/site/assets/images/qr-code.png') ?>" />
      <br />
    </div>

  </div>
</div>

<script type="text/javascript">
  $('body').on('click', '.mark_paid', function(){
    var id = $(this).data('id');
    var text = $(this).html();
    var width = $(this).css('width');
    $(this).css('width', width).html('<i class="fa fa-spin fa-circle-o-notch"></i>').prop('disabled', true);
    $btn = $('#mark_paid_' + id);
    $row = $('#order-' + id);
    
    $.get("<?php echo uri('user/order_mark_paid') ?>" + "/" + id, function(data){
      
      switch (data) {
        case "0":
          $btn.html('标记为已付款').removeClass('btn-danger').addClass('btn-success').prop('disabled', false);
          $('.fa-check', $row).removeClass('fa-check').addClass('fa-times');
          break;
        case "1":
          $btn.html('标记为未付款').removeClass('btn-success').addClass('btn-danger').prop('disabled', false);
          $('.fa-times', $row).removeClass('fa-times').addClass('fa-check');
          break;
        default:
          $btn.html(text).prop('disabled', false);
          swal("更新出错", "十分抱歉，订单更新不成功", "error");
      }
    });
    
    return false;
  });
</script>