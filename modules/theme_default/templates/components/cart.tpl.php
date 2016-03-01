<div class="container" id="cart">
  <div class="row section">
    <div class="col-xs-12">
      <h2>您在<span style="color:#568fdf;"><?php echo $user->getShopName() ?></span>订购的商品</h2>
    </div>
<?php 
$total = 0;
if (sizeof($items)): $i = -1; ?>
  <?php foreach ($items as $product): 
    $i++;
    $total += floatval($product->getPrice()) * $product->number;
  ?>
    <div class="col-xs-12">
      <div class="item">
        <div class="left">
          <img src="<?php echo uri($product->getThumbnail(), false) ?>" />
        </div>
        <div class="center">
          <?php echo $product->getTitle() ?>
        </div>
        <div class="right">
          <p style="text-align: right;"><small>$<?php echo $product->getPrice() ?></small></p>
          <div class="input-group">
            <div class="input-group-btn">
              <button type="button" class="btn btn-default minus">-</button>
            </div>
            <input type="text"   name="number[<?php echo $i ?>]" class="number form-control" value="<?php echo isset($_POST['number'][$i]) ? $_POST['number'][$i] : "$product->number" ?>">
            <input type="hidden" name="pid[<?php echo $i ?>]"    class="pid" value="<?php echo $product->getId() ?>">
            <input type="hidden" name="price[<?php echo $i ?>]"  class="price" value="<?php echo $product->getPrice() ?>">
            <div class="input-group-btn">
              <button type="button" class="btn btn-default plus">+</button>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach ?>
    <div class="col-xs-12">
      <p style="text-align: right;">共计： <span style="font-weight: bold; color: #f40;">$ <i class="total"><?php echo $total.""; ?></i></span></p>
    </div>
<?php else: ?>
    <div class="col-xs-12">
      <div class="item">
      <p style="text-align: center; color: #AAA; margin-top: 30px;"><?php echo '购物车为空，请<a href="'.$user->getShopUri().'">返回首页</a>选购商品' ?></p>
      </div>
    </div>
<?php endif; ?>
  </div>
</div>

<script type="text/javascript">
  /** cart item + and - actions **/
  $('#cart .right').each(function(){
    var number = $('input.number', this);
    $('.plus', this).on('click', function(){
      var val = number.val();
      if (/^\d+?$/.test(val)) {
        number.val(parseInt(val) + 1);
      } else {
        number.val(0);
      }
      updateTotal();
    });
    $('.minus', this).on('click', function(){
      var val = number.val();
      if (/^\d+?$/.test(val) && parseInt(val) > 0) {
        number.val(parseInt(val) - 1);
      } else {
        number.val(0);
      }
      updateTotal();
    });
  });

  function updateTotal() {
    var total = 0;
    $('#cart .item').each(function(){
      var number = $('input.number', this).val();
      var price = $('input.price', this).val();
      total += parseFloat(price) * parseInt(number);
    });
    // round
    total = Math.round(total * 100) / 100;
    $('.total').html(total.toString());
  }
  
  // cart number change action
  $('#cart .number').on('change', function(){
    updateTotal();
  });
</script>