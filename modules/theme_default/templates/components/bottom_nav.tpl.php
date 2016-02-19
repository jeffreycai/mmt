<div id="bottom_nav">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <a class="contact" href="<?php echo $user->getShopUri() ?>/checkout"><i class="fa fa-shopping-cart"></i><br />购物车</a>
        <a class="buynow" href="<?php echo $user->getShopUri() ?>/checkout?buynow=<?php echo $product->getId(); ?>">立即购买</a>
        <a class="addtocart" href="<?php echo $user->getShopUri() ?>/cart-add/<?php echo $product->getId() ?>">加入购物车</a>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  /** add to cart js action **/
  $('.addtocart').click(function(event){
    event.preventDefault();
    href = $(this).attr('href');
    text = $(this).html();
    $(this).addClass('disabled').html('<i class="fa fa-circle-o-notch fa-spin"></i>');
    
    $.get(href, function(){
      $('.addtocart').removeClass('disabled').html(text);
      swal("成功加入购物车!","","success");
    });
  });
</script>