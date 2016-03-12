<?php

$html = new HTML();



$html->renderOut('core/backend/single_form_header', array('title' => i18n(array(
          'en' => 'User login',
          'zh' => '用户登录'
      ))));
$html->output(render_ga());
echo SiteUser::renderLoginForm();
$html->renderOut('core/backend/single_form_footer', array(
    'extra' => '<div  style="text-align: center;"><small class="signup"><a href="'.uri('users/signup').'">'.i18n(array('en' => 'signup as new user', 'zh' => '申请注册为新用户')).'</a><br /><a href="'.uri('').'">&laquo; '.i18n(array(
        'en' => 'Go back to homepage',
        'zh' => '返回首页'
    )).'</a></small><br /><br /></div>'
));


exit;