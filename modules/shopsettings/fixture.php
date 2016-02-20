<?php

require_once __DIR__ . DS . '..' . DS . '..' . DS . 'bootstrap.php';

if (is_cli()) {
  $settings = Shopsettings::findByUserid(1) ? Shopsettings::findByUserid(1) : new Shopsettings();
  $settings->setUserId(1);
  $settings->setShopName('爱心回国礼品');
  $settings->setShopIntroduction("我们是澳大利亚价格最实惠的保健品批发和零售代理商.我们的专业代理可以拿到比其他保健品销售商更低的价格.如果您是批量购买,还有优惠哦~!\n\n我们在Hursvilleyou实体店,店的地址是xxxxx,欢迎广大新老客户上门选购.");
  $settings->setStripePublicKey('pk_test_YV4pfXBFqa2Btu6p10fpSgoe');
  $settings->setStripePrivateKey('sk_test_YLpeLwiF5ZRL3UF6ITezppip');
  //$settings->setShopLogo('modules/user/assets/images/logo.png');
  $settings->save();
}