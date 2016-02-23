<?php


$html = new HTML();
$html->renderOut('site/components/html_header', array(
  'title' => $settings['sitename'],
  'body_class' => 'landing'
));
$html->renderOut('site/index');
$html->renderOut('site/components/html_footer');
