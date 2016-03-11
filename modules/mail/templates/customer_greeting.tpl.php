<p>
  亲爱的<?php echo $user->getProfile()->getNickname() ?>，你好！<br /><br />
  欢迎您注册<?php echo $settings['sitename_short'] ?>的<strong><?php echo $user->getMemberType(true) ?></strong>帐号。我们对您的加入表示最诚挚的欢迎！
</p>

<p>
  作为一位新用户，您一定有许多还不熟悉的地方，下面是我们列出的一些小贴士,希望可以帮助您尽快的上手我们的电商平台，早日开始您的互联网电商之旅！
  <br />
</p>

<ul>
  <li>您应该已经收到了我们向您发送的帐号激活邮件，请点击邮件内的激活链接，然后在后台登陆您的帐号。登录页链接是： <a href="http://<?php echo SITEDOMAIN ?>/signin">http://<?php echo SITEDOMAIN ?>/signin</a></li>
  <li>在登录后台之后，请您：
    <ol>
      <li>更新您的微店设置： <a href="http://<?php echo SITEDOMAIN ?>/user/shop">http://<?php echo SITEDOMAIN ?>/user/shop</a></li>
      <li>添加并管理您的微店商品： <a href="http://<?php echo SITEDOMAIN ?>/user/products">http://<?php echo SITEDOMAIN ?>/user/products</a></li>
      <li>如果您的帐号有在线支付功能，请回复本邮件联系我们的客服帮助您开通，开通时间一般为24-48小时。</li>
    <ol>
  </li>
  <li>
    您在<?php echo $settings['sitename_short'] ?>的所有消费记录可以在后台的“支付记录”页面查看： <a href="http://<?php echo SITEDOMAIN ?>/user/account/charges">http://<?php echo SITEDOMAIN ?>/user/account/charges</a>
  </li>
</ul>
      
<p>
  <br />
  如果您有任何其他问题，欢迎您回复本邮件咨询，或通过其他方式联系我们： <a href="http://<?php echo SITEDOMAIN ?>/contact">http://<?php echo SITEDOMAIN ?>/contact</a>
</p>

<p>
  <br />
  谢谢！
</p>