<div class="body">
  <div class="row hero section">
    <div class="col-xs-12">
        <i class="fa fa-file-text-o logo"></i>
        <span><?php echo i18n(array(
        'en' => 'Your orders',
        'zh' => '订单'
        )) ?></span>
    </div>
  </div>
  
  <div class="row section">
    <div class="col-xs-12">
      <br />
      <?php echo $pager ?>
      <table class="table table-bordered table-striped" id="orders_table">
        <tr>
          <th>订单号</th>
          <th>下单时间</th>
          <th>已支付?</th>
          <th>已发货?</th>
          <th></th>
        </tr>
<?php foreach ($orders as $order): ?>
        <tr id="order-<?php echo $order->getId(); ?>">
          <td><?php echo $order->getPublicId() ?></td>
          <td><?php echo time_ago($order->getConfirmedAt()); ?></td>
          <td><i class="fa fa-<?php echo $order->getPaid() ? 'check' : 'times' ?> paid"></i></td>
          <td><i class="fa fa-<?php echo $order->getDispatched() ? 'check' : 'times' ?> dispatched"></i></td>
          <td>
            <a href="#" style="display: block;" class="btn btn-sm btn-default" data-toggle="modal" data-target="#order-modal-<?php echo $order->getId() ?>"><i class="fa fa-search-plus"></i></a>
          </td>
        </tr>
<?php endforeach; ?>
      </table>
      <?php echo $pager ?>
    </div>
    
<?php foreach ($orders as $order): ?>
<div class="modal fade" id="order-modal-<?php echo $order->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="订单<?php echo $order->getPublicId() ?>详情">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">订单 <?php echo $order->getPublicId() ?></h4>
      </div>
      <div class="modal-body">
        <p>下单时间: <?php echo $order->getConfirmedAt('Y-m-d H:i:s') ?></p>

        <?php $html->renderOut('theme_default/components/order_details_simple', array(
          'purchase_order' => $order
        )) ?>

        <p>
          <button id="mark_paid_<?php echo $order->getId(); ?>" class="mark_paid btn btn-sm btn-<?php echo $order->getPaid() ? 'success' : 'danger' ?>" data-id="<?php echo $order->getId() ?>" ><i class="fa fa-usd"></i> <span><?php echo $order->getPaid() ? '已' : '未' ?>付款</span></button>
          <button id="mark_dispatched_<?php echo $order->getId(); ?>" class="mark_dispatched btn btn-sm btn-<?php echo $order->getDispatched() ? 'success' : 'danger' ?>" data-id="<?php echo $order->getId() ?>" ><i class="fa fa-truck"></i> <span><?php echo $order->getDispatched() ? '已' : '未' ?>发货</span></button>
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
      </div>
    </div>
  </div>
</div>
<?php endforeach; ?>

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
        case "N":
          $btn.html('<i class="fa fa-usd"></i> 未付款').removeClass('btn-success').addClass('btn-danger').prop('disabled', false);
          $('.fa-check.paid', $row).removeClass('fa-check').addClass('fa-times');
          break;
        case "Y":
          $btn.html('<i class="fa fa-usd"></i> 已付款').removeClass('btn-danger').addClass('btn-success').prop('disabled', false);
          $('.fa-times.paid', $row).removeClass('fa-times').addClass('fa-check');
          break;
        default:
          $btn.html(text).prop('disabled', false);
          swal("更新出错", "十分抱歉，订单更新不成功", "error");
      }
    });
    
    return false;
  });
  
  $('body').on('click', '.mark_dispatched', function(){
    var id = $(this).data('id');
    var text = $(this).html();
    var width = $(this).css('width');
    $(this).css('width', width).html('<i class="fa fa-spin fa-circle-o-notch"></i>').prop('disabled', true);
    $btn = $('#mark_dispatched_' + id);
    $row = $('#order-' + id);
    
    $.get("<?php echo uri('user/order_mark_dispatched') ?>" + "/" + id, function(data){
      
      switch (data) {
        case "N":
          $btn.html('<i class="fa fa-truck"></i> 未发货').removeClass('btn-success').addClass('btn-danger').prop('disabled', false);
          $('.fa-check.dispatched', $row).removeClass('fa-check').addClass('fa-times');
          break;
        case "Y":
          $btn.html('<i class="fa fa-truck"></i> 已发货').removeClass('btn-danger').addClass('btn-success').prop('disabled', false);
          $('.fa-times.dispatched', $row).removeClass('fa-times').addClass('fa-check');
          break;
        default:
          $btn.html(text).prop('disabled', false);
          swal("更新出错", "十分抱歉，订单更新不成功", "error");
      }
    });
    
    return false;
  });
</script>