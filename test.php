<?php

require_once 'bootstrap.php';

load_library_phpmailer();
sendMailViaLocal('1642537426@qq.com', 'Jeffrey Cai', 'maimaitionline@gmail.com', '买买提在线商务平台', 'admin@maimaitionline.com', '买买提在线商务平台', '订单已下达', '<p>你好，<a href="#">您的订单</a>已下达<img src="http://maimaitionline.websitesydney.net/files/user/1/o_1a4eu9ef11gf5qoo40m2na1tr6a.jpg" /></p>', array(
  __DIR__ . '/modules/mail/includes/libraries/PHPMailer/examples/images/phpmailer_mini.png',
  __DIR__ . '/modules/mail/includes/libraries/PHPMailer/examples/images/phpmailer.png'
));

echo "done \n\n";