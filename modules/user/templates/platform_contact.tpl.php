<div class="body">
  <div class="row hero section">
    <div class="col-xs-12">
        <i class="fa fa-users logo"></i>
        <span><?php echo i18n(array(
        'en' => 'Contact customer support',
        'zh' => '联系微店客服'
        )) ?></span>
    </div>
  </div>
  
  <div class="row section">
    <div class="col-xs-12">
      <br />
      <ul>
        <li>客服邮箱: <a href="mailto:<?php echo $settings['siteemail'] ?>"><?php echo $settings['siteemail'] ?></a></li>
        <li>客服微信: aueightnews</li>
        <li>微信二维码: </li>
      </ul>
    </div>
    <div class="col-xs-8 col-xs-offset-2">
      <img class="img-responsive" style="width: 100%;" src="<?php echo uri('modules/site/assets/images/qr-code.png') ?>" />
      <br />
    </div>

  </div>
</div>