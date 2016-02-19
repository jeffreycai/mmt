<div id="navback">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <a class="backbtn" href="<?php echo isset($uri) ? $uri : '#' ?>" onclick="<?php echo isset($uri) ? '' : 'history.go(-1);return false;' ?>"><i class="fa fa-chevron-circle-left"></i></a>
        <span><?php echo isset($title) ? $title : '' ?></span>
      </div>
    </div>
  </div>
</div>