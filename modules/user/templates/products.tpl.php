
  <nav class="row product_filter">
    <?php $s = $sorting; $s['column'] = 'created_at'; $s['order'] = $sorting['column'] == 'created_at' ? ($sorting['order'] == 'desc' ? 'asc' : 'desc') : 'desc'; ?>
    <a href="<?php echo uri('user/products') . "?" . build_sorting_uri_vars($s) ?>" class="col-xs-4 <?php echo $sorting['column'] == 'created_at' ? 'active' : '' ?>"><?php echo i18n(array(
        'en' => 'Time added',
        'zh' => '添加时间'
    )) ?> <?php if ($sorting['column'] == 'created_at'): ?><i class="fa fa-sort-amount-<?php echo $s['order'] ?>"></i><?php endif; ?></a>
    <?php $s = $sorting; $s['column'] = 'sales'; $s['order'] = $sorting['column'] == 'sales' ? ($sorting['order'] == 'desc' ? 'asc' : 'desc') : 'desc'; ?>
    <a href="<?php echo uri('user/products') . "?" . build_sorting_uri_vars($s) ?>" class="col-xs-4 <?php echo $sorting['column'] == 'sales' ? 'active' : '' ?>"><?php echo i18n(array(
        'en' => 'Sales',
        'zh' => '销量'
    )) ?> <?php if ($sorting['column'] == 'sales'): ?><i class="fa fa-sort-amount-<?php echo $s['order'] ?>"></i><?php endif; ?></a>
    <?php $s = $sorting; $s['column'] = 'stock'; $s['order'] = $sorting['column'] == 'stock' ? ($sorting['order'] == 'desc' ? 'asc' : 'desc') : 'desc'; ?>
    <a href="<?php echo uri('user/products') . "?" . build_sorting_uri_vars($s) ?>" class="col-xs-4 <?php echo $sorting['column'] == 'stock' ? 'active' : '' ?>"><?php echo i18n(array(
        'en' => 'Stock',
        'zh' => '库存'
    )) ?> <?php if ($sorting['column'] == 'stock'): ?><i class="fa fa-sort-amount-<?php echo $s['order'] ?>"></i><?php endif; ?></a>
  </nav>


<?php if (sizeof($products) == 0): ?>
<div class="body">
  <div class="row">
    <div class="col-xs-12 empty">
      <a href="<?php echo uri('user/products/add') ?>"><i class="fa fa-plus-circle"></i><br /><?php echo i18n(array(
          'en' => 'There\'s a sale every minute!<br />Add your product NOW ~',
          'zh' => '每秒都有新商品成交<br />快来添加商品吧 ~'
      )) ?></a>
    </div>
  </div>
</div>
<?php else: foreach ($products as $product): ?>
  <div class="row product">
    <div class="col-xs-12 upper">
      <div class="left">
        <a href="<?php echo uri('user/products/edit/' . $product->getId()) ?>"><img src="<?php echo uri($product->getThumbnail()) ?>" /></a>
      </div>
      <div class="right">
        <h2 class="title"><a href="<?php echo uri('user/products/edit/' . $product->getId()) ?>"><?php echo $product->getTitle() ?></a></h2>
        <div class="price">$ <?php echo $product->getPrice() ?></div>
        <div class="info">
          <div class="entry">
            <?php echo i18n(array(
                'en' => 'Sale',
                'zh' => '销量'
            )) ?>
            <?php echo $product->getSales() ?>
          </div>
          <div class="entry">
            <?php echo i18n(array(
                'en' => 'Stock',
                'zh' => '库存'
            )) ?>
            <?php echo $product->getStock() ?>
          </div>
          <div class="entry">
            <?php echo i18n(array(
                'en' => 'Added at',
                'zh' => '添加'
            )) ?>
            <?php echo date('Y/m/d', $product->getCreatedAt()) ?>
          </div>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
    <div class="col-xs-12 lower">
      <div class="col-xs-3">
        <a href="#">
          <i class="fa fa-eye"></i><br />
          <?php echo i18n(array(
            'en' => 'Preview',
            'zh' => '预览'
          )) ?>
        </a>
      </div>
      <div class="col-xs-3">
        <a href="#">
          <i class="fa fa-copy"></i><br />
          <?php echo i18n(array(
            'en' => 'Copy',
            'zh' => '复制'
          )) ?>
        </a>
      </div>
      <div class="col-xs-3">
        <a href="#">
          <i class="fa fa-qrcode"></i><br />
          <?php echo i18n(array(
            'en' => 'QR code',
            'zh' => '二维码'
          )) ?>
        </a>
      </div>
      <div class="col-xs-3">
        <a href="#">
          <i class="fa fa-share"></i><br />
          <?php echo i18n(array(
            'en' => 'Share',
            'zh' => '分享'
          )) ?>
        </a>
      </div>
    </div>
  </div>
<?php endforeach; endif; ?>



<footer class="sticky addmore">
  <div class="container">
  <a href="<?php echo uri('user/products/add') ?>"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;<?php echo i18n(array(
      'en' => 'Add new product',
      'zh' => '添加新产品'
  )) ?></a>
  </div>
</footer>