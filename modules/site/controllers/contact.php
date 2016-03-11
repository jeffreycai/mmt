<?php

$html = new HTML();
$html->renderOut('site/components/html_header', array(
  'title' => '联系我们 :: ' . $settings['sitename'],
  'body_class' => 'contact',
  'html_class' => 'document'
));
$html->renderOut('site/contact');
$html->renderOut('site/components/html_footer');