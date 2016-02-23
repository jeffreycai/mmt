<?php

$html = new HTML();
$html->renderOut('site/components/html_header', array(
  'title' => '服务条款 :: ' . $settings['sitename'],
  'body_class' => 'terms',
  'html_class' => 'document'
));
$html->renderOut('site/terms');
$html->renderOut('site/components/html_footer');