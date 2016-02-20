<div class="container">
  <div class="row section">
    <div class="col-xs-12 content">
      <h2><?php echo $user->getShopName() ?></h2>

      <table class="table table-striped">
        <tr>
          <th>微信:</th>
          <td><?php echo empty($shop_settings->getShopWechat()) ? '(未提供)' : $shop_settings->getShopWechat(); ?></td>
        </tr>
        <tr>
          <th>电话:</th>
          <td><?php echo empty($shop_settings->getShopPhone()) ? '(未提供)' : $shop_settings->getShopPhone(); ?></td>
        </tr>
        <tr>
          <th>地址:</th>
          <td><?php echo empty($shop_settings->getShopAddress()) ? '(未提供)' : $shop_settings->getShopAddress(); ?></td>
        </tr>
        <tr>
          <th>电子邮箱:</th>
          <td><?php echo empty($shop_settings->getShopEmail()) ? '(未提供)' : $shop_settings->getShopEmail(); ?></td>
        </tr>
      </table>
    </div>
  </div>
</div>