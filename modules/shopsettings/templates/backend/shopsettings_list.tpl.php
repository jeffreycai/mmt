

<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header"><?php i18n_echo(array('en' => 'Shop settings','zh' => '微店设置',)); ?></h1>
    </div>
  </div>
  
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading"><?php i18n_echo(array('en' => 'List', 'zh' => '列表')) ?></div>
        <div class="panel-body">
          
        <?php echo Message::renderMessages(); ?>
          
<table class="table table-striped table-bordered table-hover dataTable no-footer">
  <thead>
      <tr role="row">
                <th>id</th>
                <th>user_id</th>
                <th>shop_name</th>
                <th>shop_introduction</th>
                <th>shop_announcement</th>
                <th>shop_logo</th>
                <th>shop_wechat</th>
                <th>shop_phone</th>
                <th>shop_address</th>
                <th>shop_email</th>
                <th>stripe_public_key</th>
                <th>stripe_private_key</th>
                <th>Actions</th>
      </tr>
  </thead>
  <tbody>
    <?php foreach ($objects as $object): ?>
    <tr>
            <td><?php echo $object->getId() ?></td>
            <td><?php echo $object->getUserId() ?></td>
            <td><?php echo $object->getShopName() ?></td>
            <td><?php echo $object->getShopIntroduction() ?></td>
            <td><?php echo $object->getShopAnnouncement() ?></td>
            <td><?php echo $object->getShopLogo() ?></td>
            <td><?php echo $object->getShopWechat() ?></td>
            <td><?php echo $object->getShopPhone() ?></td>
            <td><?php echo $object->getShopAddress() ?></td>
            <td><?php echo $object->getShopEmail() ?></td>
            <td><?php echo $object->getStripePublicKey() ?></td>
            <td><?php echo $object->getStripePrivateKey() ?></td>
            <td>
        <div class="btn-group">
          <a class="btn btn-default btn-sm" href="<?php echo uri('admin/shopsettings/edit/' . $object->getId()); ?>"><i class="fa fa-edit"></i></a>
          <a onclick="return confirm('<?php echo i18n(array('en' => 'Are you sure to delete this record ?', 'zh' => '你确定删除这条记录吗 ?')); ?>');" class="btn btn-default btn-sm" href="<?php echo uri('admin/shopsettings/delete/' . $object->getId(), false); ?>"><i class="fa fa-remove"></i></a>
        </div>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<div class="row">
  <div class="col-sm-12" style="text-align: right;">
  <?php i18n_echo(array(
      'en' => 'Showing ' . $start_entry . ' to ' . $end_entry . ' of ' . $total . ' entries', 
      'zh' => '显示' . $start_entry . '到' . $end_entry . '条记录，共' . $total . '条记录',
  )); ?>
  </div>
  <div class="col-sm-12" style="text-align: right;">
  <?php echo $pager; ?>
  </div>
</div>
          
        </div>
      </div>
    </div>
  </div>
</div>