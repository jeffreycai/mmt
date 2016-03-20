<?php 
/**
 * Required parrameters
 * - $purchase_order
 */
?>


<div class="col-xs-12">
  <div style="margin-top: 20px;">
    <?php echo Message::renderMessages(); ?>
  </div>
  <table class="table table-striped">
    <thead>
      <tr>
        <th colspan="5" style="color:#568fdf;">订购商品</th>
      </tr>
      <tr>
        <th>缩略图</th>
        <th width="70%">名称</th>
        <th style="text-align: right;">单价</th>
        <th style="text-align: right;">数量</th>
        <th style="text-align: right;">金额</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $total = 0;
      foreach ($purchase_order->getItems() as $item):
        $product = Product::findById($item->getProductId());
        $subtotal = intval($item->getNumber()) * floatval($item->getSinglePrice());
        $total += $subtotal;
        ?>
        <tr>
          <td><?php if ($product): ?><img width="60" src="<?php echo  uri($product->getThumbnail(), false) ?>" /><?php endif; ?></td>
          <td><?php echo $item->getTitle() ?></td>
          <td style="text-align: right;">$<?php echo $item->getSinglePrice() ?></td>
          <td style="text-align: right;"><?php echo $item->getNumber() ?></td>
          <td style="text-align: right;"><strong>$<?php echo $subtotal ?></strong></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
    <tfoot>
      <tr>
        <th colspan="5" style="text-align: right;"><strong>总金额: $<span style="color: #f40;"><?php echo $total; ?></span></strong></th>
      </tr>
    </tfoot>
  </table>
</div>

<div class="col-xs-12">
  <table class="table table-striped">
    <thead>
      <tr>
        <th colspan="2" style="color:#568fdf;">买家信息</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th>姓名:</th>
        <td><?php echo $purchase_order->getName() ?></td>
      </tr>
      <tr>
        <th>邮箱:</th>
        <td><?php echo $purchase_order->getEmail() ?></td>
      </tr>
      <tr>
        <th>电话:</th>
        <td><?php echo empty($purchase_order->getPhone()) ? "(空)" : $purchase_order->getPhone() ?></td>
      </tr>
      <tr>
        <th>微信号:</th>
        <td><?php echo empty($purchase_order->getWechat()) ? "(空)" : $purchase_order->getWechat() ?></td>
      </tr>
    </tbody>
  </table>
</div>
<?php if (!empty($purchase_order->getAddress())): ?>
<div class="col-xs-12">
  <table class="table table-striped">
    <thead>
      <tr>
        <th colspan="2" style="color:#568fdf;">邮寄地址</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td colspan="2"><?php echo $purchase_order->getFullAddress() ?></td>
      </tr>
    </tbody>
  </table>
</div>
<?php endif; ?>
<div class="col-xs-12">
  <table class="table table-striped">
    <thead>
      <tr>
        <th colspan="2" style="color:#568fdf;">其他要求</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td colspan="2"><?php echo empty($purchase_order->getComment()) ? "(空)" : $purchase_order->getComment() ?></td>
      </tr>
    </tbody>
  </table>
</div>