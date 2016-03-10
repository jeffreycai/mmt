<div class="body">
  <div class="row hero section">
    <div class="col-xs-12">
        <i class="fa fa-usd logo"></i>
        <span><?php echo i18n(array(
        'en' => 'Your charge history',
        'zh' => '支付记录'
        )) ?></span>
    </div>
  </div>
  
  <div class="row section">
    <div class="col-xs-12">
      <br />
      <?php echo $pager ?>
      <table class="table table-bordered table-striped" id="orders_table">
        <tr>
          <th>名目</th>
          <th>相关项</th>
          <th>数额</th>
          <th>时间</th>
          <th>是否已付款</th>
        </tr>
<?php foreach ($charge_items as $charge_item): ?>
        <tr id="item-<?php echo $charge_item->getId(); ?>">
          <td><?php echo $charge_item->getTitle() ?></td>
          <td><?php echo $charge_item->getReference(); ?></td>
          <td>$<?php echo $charge_item->getAmount(); ?></td>
          <td><?php echo date('Y-m-d H:i:s', $charge_item->getCreatedAt()) ?></td>
          <td><i class="fa fa-<?php echo $charge_item->getCharged() ? 'check' : 'times' ?>"></i></td>
        </tr>
<?php endforeach; ?>
      </table>
      <?php echo $pager ?>
    </div>
  </div>
</div>