<div class="container" id="delivery">
  <div class="row section">

    <div class="col-xs-12">
      <h2>订单信&nbsp;&nbsp;&nbsp;<small><span style="color:red">*</span>为必填项目</small></h2>
      
      <?php echo Message::renderMessages(); ?>
      
      <fieldset>
        <legend>买家信息</legend>
        <div class="form-group">
          <label for="name" class="control-label">姓名 <span style="color:red">*</span></label>
          <input type="text" class="form-control" id="name" name="name" placeholder="您的姓名" required="" value="<?php echo isset($_POST['name']) ? htmlentities($_POST['name']) : (isset($_COOKIE['delivery']['name']) ? htmlentities($_COOKIE['delivery']['name']) : '') ?>" />
        </div>
        <div class="form-group">
          <label for="email" class="control-label">邮箱 <span style="color:red">*</span></label>
          <input type="email" class="form-control" id="email" name="email" placeholder="您的邮箱" required="" value="<?php echo isset($_POST['email']) ? htmlentities($_POST['email']) : (isset($_COOKIE['delivery']['email']) ? htmlentities($_COOKIE['delivery']['email']) : '') ?>" />
          <p><small>* 此邮箱将被用来接收订单信息</small></p>
        </div>
        <div class="form-group">
          <label for="phone" class="control-label">手机 <?php if ($user->hasPermission('use sms')): ?><span style="color:red">*</span><?php endif; ?></label>
          <input type="text" class="form-control" id="phone" name="phone" placeholder="04xxxxxxxx" value="<?php echo isset($_POST['phone']) ? htmlentities($_POST['phone']) : (isset($_COOKIE['delivery']['phone']) ? htmlentities($_COOKIE['delivery']['phone']) : '') ?>" <?php if ($user->hasPermission('use sms')): ?>required=""<?php endif; ?> />
        </div>
        <div class="form-group">
          <label for="wechat" class="control-label">微信号</label>
          <input type="text" class="form-control" id="wechat" name="wechat" placeholder="微信号码" value="<?php echo isset($_POST['wechat']) ? htmlentities($_POST['wechat']) : (isset($_COOKIE['delivery']['wechat']) ? htmlentities($_COOKIE['delivery']['wechat']) : '') ?>" />
        </div>
      </fieldset>
      
      <?php if (isset($require_delivery) && $require_delivery): ?>
      <br />
      
      <fieldset>
        <legend>邮寄地址</legend>
        <div class="form-group">
          <label for="state" class="control-label">州 <span style="color:red">*</span></label>
          <select class="form-control" id="state" name="state" required="">
            <option value="NSW" <?php echo (isset($_POST['state']) && $_POST['state']=='NSW') || (isset($_COOKIE['delivery']['state']) && $_COOKIE['delivery']['state']=='NSW') ? 'selected="selected"' : ''  ?>>NSW</option>
            <option value="VIC" <?php echo (isset($_POST['state']) && $_POST['state']=='VIC') || (isset($_COOKIE['delivery']['state']) && $_COOKIE['delivery']['state']=='VIC') ? 'selected="selected"' : ''  ?>>VIC</option>
            <option value="QLD" <?php echo (isset($_POST['state']) && $_POST['state']=='QLD') || (isset($_COOKIE['delivery']['state']) && $_COOKIE['delivery']['state']=='QLD') ? 'selected="selected"' : ''  ?>>QLD</option>
            <option value="SA" <?php echo (isset($_POST['state']) && $_POST['state']=='SA') || (isset($_COOKIE['delivery']['state']) && $_COOKIE['delivery']['state']=='SA') ? 'selected="selected"' : ''  ?>>SA</option>
            <option value="TAS" <?php echo (isset($_POST['state']) && $_POST['state']=='TAS') || (isset($_COOKIE['delivery']['state']) && $_COOKIE['delivery']['state']=='TAS') ? 'selected="selected"' : ''  ?>>TAS</option>
            <option value="WA" <?php echo (isset($_POST['state']) && $_POST['state']=='WA') || (isset($_COOKIE['delivery']['state']) && $_COOKIE['delivery']['state']=='WA') ? 'selected="selected"' : ''  ?>>WA</option>
          </select>
        </div>
        <div class="form-group">
          <label for="suburb" class="control-label">Suburb / 区 <span style="color:red">*</span></label>
          <input type="text" class="form-control" id="suburb" name="suburb" placeholder="例如：Parramatta" required="" value="<?php echo isset($_POST['suburb']) ? htmlentities($_POST['suburb']) : (isset($_COOKIE['delivery']['suburb']) ? htmlentities($_COOKIE['delivery']['suburb']) : '') ?>" />
        </div>
        <div class="form-group">
          <label for="postcode" class="control-label">邮编 <span style="color:red">*</span></label>
          <input type="text" class="form-control" id="postcode" name="postcode" placeholder="4位邮政编码，例如：2234" required="" value="<?php echo isset($_POST['postcode']) ? htmlentities($_POST['postcode']) : (isset($_COOKIE['delivery']['postcode']) ? htmlentities($_COOKIE['delivery']['postcode']) : '') ?>" />
        </div>
        <div class="form-group">
          <label for="address" class="control-label">街道地址 <span style="color:red">*</span></label>
          <textarea class="form-control" id="address" name="address" placeholder="例如：3/34 Pitt Street Sydney" required=""><?php echo isset($_POST['address']) ? htmlentities($_POST['address']) : (isset($_COOKIE['delivery']['address']) ? htmlentities($_COOKIE['delivery']['address']) : '') ?></textarea>
        </div>
      </fieldset>
      <?php endif; ?>
      
      <br />
      
      <fieldset>
        <legend>其他要求</legend>
        <div class="form-group">
          <textarea class="form-control" id="comment" name="comment" placeholder="其他订单要求"><?php echo isset($_POST['comment']) ? htmlentities($_POST['comment']) : (isset($_COOKIE['delivery']['comment']) ? htmlentities($_COOKIE['delivery']['comment']) : '') ?></textarea>
        </div>
      </fieldset>
      
      <div class="form-group" style="margin-top: 20px;">
        <button type="submit" name="submit" style="float:right;" class="btn btn-primary">提交</button>
        <div class="clearfix"></div>
      </div>
      
    </div>
  </div>
</div>