<div class="container">
  <div class="row section">
    
    <?php echo $html->render('theme_default/components/order_details', array(
      'purchase_order' => $purchase_order
    )); ?>
    
    <div class="col-xs-12">
      <table class="table">
        <tfoot>
          <tr>
            <td colspan="2" style="text-align: right;">
              <a class="btn btn-default" href="<?php echo $user->getShopUri() . '/checkout' ?>"><i class="fa fa-pencil"></i> 修改订单</a>
              <a class="btn btn-success" href="<?php 
                  if ($user->hasPermission('use payment function') && $user->isPaymentSet()) {
                    echo uri('order/payment/'.$purchase_order->getPublicId());
                  } else {
                    echo uri('order/confirmed/'.$purchase_order->getPublicId());
                  }
                ?>"><i class="fa fa-check"></i> 确认订单</a>
            </td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>