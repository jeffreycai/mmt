<div class="body">
  <div class="row section">
    <form action="<?php echo uri('user/shop/announcement') ?>" method="POST">
    <div class="col-xs-12">
      <br />
      
      <?php echo Message::renderMessages(); ?>
      
      
        <div class="form-group">
          <label for="announcement" class="control-label"><?php echo i18n(array(
            'en' => 'Shop announcement',
            'zh' => '微店公告'
          )) ?></label>
          <textarea name="announcement" id="announcement" placeholder="显示在微店首页的公告，如不填写，则不显示" class="form-control"><?php echo (isset($_POST['announcement']) ? htmlentities($_POST['announcement']) : ($settings ? htmlentities($settings->getShopAnnouncement()) : '')) ?></textarea>
        </div>
    </div>
    
    <div class="col-xs-12">
      <input class="btn btn-success" style="float: right; margin-bottom: 20px;" type="submit" name="submit" value="<?php echo i18n(array(
        'en' => 'Submit',
        'zh' => '提交'
      )) ?>" />
      <div class="clearfix"></div>
    </div>
      </form>
  </div>

</div>
