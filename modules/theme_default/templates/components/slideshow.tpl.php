
<div class="container">
  <div class="row" style="position: relative;">
    <div id="slideshow">
    <?php foreach ($sliders as $slide): ?>
      <img class="owl-lazy" data-src="<?php echo $slide ?>" />
    <?php endforeach; ?>
    </div>
  </div>
</div>

<script type="text/javascript">
  jQuery(function($){
    $('#slideshow').owlCarousel({
      items:1,
      lazyLoad:true,
      loop:<?php echo sizeof($sliders) == 1 ? 'false' : 'true' ?>,
      autoplay:true,
      autoplayTimeout:3000
//      margin:10
    });
  });
</script>