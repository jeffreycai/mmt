<div id="cards" class="container">
<?php foreach ($products as $product): ?>
  <div class="card row">
    <div class="col-xs-5 first" style="text-align: center;">
      <img class="img-responsive" src="<?php echo uri($product->getThumbnail(), false) ?>" alt="<?php echo htmlentities($product->getTitle()) ?>" />
    </div>
    <div class="col-xs-7 last">
      <h3><?php echo $product->getTitle() ?></h3>
      <p>
        <?php echo $product->getDescription() ?>
      </p>
      <div class="row">
        <div class="col-xs-6">
          <div class="price">
          $<?php echo $product->getPrice() ?>
          </div>
        </div>
        <div class="col-xs-6">
          
<form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="BWRK8U5P38BFG">
<input type="submit" class="btn btn-sm btn-default" name="submit" alt="<?php echo i18n(array(
  'en' => 'Add to cart',
  'zh' => '加入购物车'
)) ?>" value="<?php echo i18n(array(
  'en' => 'Add to cart',
  'zh' => '加入购物车'
)) ?>">
<img alt="" border="0" src="https://www.paypalobjects.com/en_AU/i/scr/pixel.gif" width="1" height="1">
</form>
          
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>
</div>