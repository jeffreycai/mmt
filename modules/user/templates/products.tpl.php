
  <nav class="row product_filter">
    <?php $s = $sorting; $s['column'] = 'created_at'; $s['order'] = $sorting['column'] == 'created_at' ? ($sorting['order'] == 'desc' ? 'asc' : 'desc') : 'desc'; ?>
    <a href="<?php echo uri('user/products') . "?" . build_sorting_uri_vars($s) ?>" class="col-xs-4 <?php echo $sorting['column'] == 'created_at' ? 'active' : '' ?>"><?php echo i18n(array(
        'en' => 'Time added',
        'zh' => '添加时间'
    )) ?> <?php if ($sorting['column'] == 'created_at'): ?><i class="fa fa-sort-amount-<?php echo $s['order'] == 'desc' ? 'asc' : 'desc' ?>"></i><?php endif; ?></a>
    <?php $s = $sorting; $s['column'] = 'sales'; $s['order'] = $sorting['column'] == 'sales' ? ($sorting['order'] == 'desc' ? 'asc' : 'desc') : 'desc'; ?>
    <a href="<?php echo uri('user/products') . "?" . build_sorting_uri_vars($s) ?>" class="col-xs-4 <?php echo $sorting['column'] == 'sales' ? 'active' : '' ?>"><?php echo i18n(array(
        'en' => 'Sales',
        'zh' => '销量'
    )) ?> <?php if ($sorting['column'] == 'sales'): ?><i class="fa fa-sort-amount-<?php echo $s['order'] == 'desc' ? 'asc' : 'desc' ?>"></i><?php endif; ?></a>
    <?php $s = $sorting; $s['column'] = 'stock'; $s['order'] = $sorting['column'] == 'stock' ? ($sorting['order'] == 'desc' ? 'asc' : 'desc') : 'desc'; ?>
    <a href="<?php echo uri('user/products') . "?" . build_sorting_uri_vars($s) ?>" class="col-xs-4 <?php echo $sorting['column'] == 'stock' ? 'active' : '' ?>"><?php echo i18n(array(
        'en' => 'Stock',
        'zh' => '库存'
    )) ?> <?php if ($sorting['column'] == 'stock'): ?><i class="fa fa-sort-amount-<?php echo $s['order'] == 'desc' ? 'asc' : 'desc' ?>"></i><?php endif; ?></a>
  </nav>


<?php if (sizeof($products) == 0): ?>
  <?php if ($sorting['onshelf'] == 1): ?>
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
  <?php else: ?>
  <div class="body">
    <div class="row">
      <div class="col-xs-12 empty">
        <a href="#" style="cursor: default;"><i class="fa fa-circle-o"></i><br /><?php echo i18n(array(
            'en' => 'There\'s currently no off-shelf products',
            'zh' => '目前没有下架商品'
        )) ?></a>
      </div>
    </div>
  </div>
  <?php endif; ?>
<?php else: foreach ($products as $product): ?>
  <?php if (!empty(Message::peekMessages(Message::INFO))): ?>
<div class="row product" style="padding-top: 0px; padding-bottom: 0px; border: none;">
  <?php echo Message::renderMessages(Message::INFO); ?>
</div>
  <?php endif; ?>
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
        <a href="<?php echo $user->getShopUri() . "/" . $product->getId() ?>?preview=1" target="_blank">
          <i class="fa fa-eye"></i><br />
          <?php echo i18n(array(
            'en' => 'Preview',
            'zh' => '预览'
          )) ?>
        </a>
      </div>
      <div class="col-xs-3">
        <a href="#" class="copy" data-toggle="modal" data-target="#product-url-<?php echo $product->getId() ?>">
          <i class="fa fa-copy"></i><br />
          <?php echo i18n(array(
            'en' => 'Copy',
            'zh' => '复制'
          )) ?>
        </a>
        <!-- Modal -->
        <div class="modal fade" id="product-url-<?php echo $product->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">商品页面链接</h4>
              </div>
              <div class="modal-body">
                <p>请选择并复制以下链接</p>
                <textarea class="form-control">http://<?php echo SITEDOMAIN . $user->getShopUri() . "/" . $product->getId() ?></textarea>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xs-3">
        <a href="#" class="qrcode" data-toggle="modal" data-target="#product-qr-<?php echo $product->getId() ?>">
          <i class="fa fa-qrcode"></i><br />
          <?php echo i18n(array(
            'en' => 'QR code',
            'zh' => '二维码'
          )) ?>
        </a>
        <!-- Modal -->
        <div class="modal fade" id="product-qr-<?php echo $product->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">商品页面二维码</h4>
              </div>
              <div class="modal-body">
                <h3 style="margin-bottom: 20px;"><?php echo $product->getTitle() ?></h3>
                <div class="canvas img-responsive"></div>
                <p><br /><br />保存图片分享到微信</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
              </div>
            </div>
          </div>
        </div>
        <!-- generate QR code image -->
        <script type="text/javascript">
          $('#product-qr-<?php echo $product->getId() ?> .canvas').qrcode({
            "render": 'image',
            "text": 'http://<?php echo SITEDOMAIN . $user->getShopUri() . "/" . $product->getId() ?>'
          });
        </script>
      </div>
      <div class="col-xs-3">
        <a href="#" class="delete" id="product-delete-<?php echo $product->getId() ?>" data-pid="<?php echo $product->getId() ?>">
          <i class="fa fa-trash"></i><br />
          <?php echo i18n(array(
            'en' => 'Delete',
            'zh' => '删除'
          )) ?>
        </a>
        
        <script type="text/javascript">
          // delete product
          $("#product-delete-<?php echo $product->getId() ?>").click(function(){
            var row = $(this).parents(".product").first();
            swal({
              title: "确定删除?",
              text: "删除操作不可恢复",
              type: "warning",
              showCancelButton: true,
              confirmButtonClass: "btn-danger",
              confirmButtonText: "确定删除",
              cancelButtonText: "取消",
              closeOnConfirm: false
            },
            function(){
              $.get("<?php echo uri('user/products/delete/'.$product->getId()) ?>");
              row.fadeOut();
              swal("删除成功!", "商品<?php echo $product->getTitle() ?>已被删除", "success");
            });
            
            return false;
          });
        </script>
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


<script type="text/javascript">
  jQuery(function($){
    // select text
    $('textarea').on('focus', function(){
      $(this).select();
    });
  });  
</script>