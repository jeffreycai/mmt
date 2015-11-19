
  <nav class="row product_filter">
    <a href="" class="col-xs-4 <?php echo isset($_GET['sort']) && $_GET['sort'] == 'created' ? 'active' : '' ?>"><?php echo i18n(array(
        'en' => 'Time added',
        'zh' => '添加时间'
    )) ?></a>
    <a href="" class="col-xs-4 <?php echo isset($_GET['sort']) && $_GET['sort'] == 'sales' ? 'active' : '' ?>"><?php echo i18n(array(
        'en' => 'Sales',
        'zh' => '销量'
    )) ?></a>
    <a href="" class="col-xs-4 <?php echo isset($_GET['sort']) && $_GET['sort'] == 'stock' ? 'active' : '' ?>"><?php echo i18n(array(
        'en' => 'Stock',
        'zh' => '库存'
    )) ?></a>
  </nav>

  <div class="row body">
  <?php if (sizeof($products) == 0): ?>
    <div class="col-xs-12 empty">
      <a href="<?php echo uri('user/products/add') ?>"><i class="fa fa-plus-circle"></i><br /><?php echo i18n(array(
          'en' => 'There\'s a sale every minute!<br />Add your product NOW ~',
          'zh' => '每秒都有新商品成交<br />快来添加商品吧 ~'
      )) ?></a>
    </div>
  <?php endif; ?>
  </div>


<footer class="sticky addmore">
  <div class="container">
  <a href="<?php echo uri('user/products/add') ?>"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;<?php echo i18n(array(
      'en' => 'Add new product',
      'zh' => '添加新产品'
  )) ?></a>
  </div>
</footer>