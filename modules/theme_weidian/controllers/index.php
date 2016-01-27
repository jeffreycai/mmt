<?php

$username = isset($vars[1]) ? strip_tags($vars[1]) : null;
$user = MySiteUser::findByUsername($username);
if ($user == null) {
  HTML::forward('site/404');
  exit;
}

$html = new HTML();
$html->renderOut('theme_weidian/components/html_header', array(
    'body_class' => 'home',
    'title' => i18n(array(
        'en' => 'Your personal online shop',
        'zh' => '您的个人网店'
    ))
));



$html->renderOut('theme_weidian/components/html_footer');