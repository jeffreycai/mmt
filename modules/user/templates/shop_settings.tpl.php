<div class="body">
  <div class="row section">
    <form action="<?php echo uri('user/shop/settings') ?>" method="POST">
    <div class="col-xs-12">
      <br />
      
      <?php echo Message::renderMessages(); ?>
      
      
        <div class="form-group">
          <label for="name" class="control-label"><?php echo i18n(array(
            'en' => 'Shop name',
            'zh' => '微店名称'
          )) ?> <span style="color:red">*</span></label>
          <input type="text" name="name" id="thumbnail" required class="form-control" placeholder="<?php echo i18n(array(
            'en' => 'Your shop\'s name that is shown to public',
            'zh' => '买家看到的微店名称'
          )) ?>" value="<?php echo (isset($_POST['name']) ? $_POST['name'] : ($settings ? $settings->getShopName() : '')) ?>" />
        </div>
        <div class="form-group">
          <label for="introduction" class="control-label"><?php echo i18n(array(
            'en' => 'Shop introduction',
            'zh' => '微店简介'
          )) ?></label>
          <textarea name="introduction" id="introduction" class="form-control" placeholder="<?php echo i18n(array(
            'en' => 'Your shop\'s introduction that is shown to public',
            'zh' => '买家看到的微店简介'
          )) ?>" rows="10"><?php echo (isset($_POST['introduction']) ? htmlentities($_POST['introduction']) : (($settings && !empty(trim($settings->getShopIntroduction()))) ? htmlentities($settings->getShopIntroduction()) : '')) ?></textarea>
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