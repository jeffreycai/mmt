<?php


$html = new HTML();
$html->renderOut('site/components/html_header', array(
  'title' => $settings['sitename'],
  'body_class' => 'landing'
));
$html->output('<div style="overflow:hidden; width:0px; height:0px; position:absolute;"><img src="'.uri('modules/site/assets/images/Grabby-Cost.png', false).'" /></div>');
$html->renderOut('site/index');
$html->renderOut('site/components/html_footer');
