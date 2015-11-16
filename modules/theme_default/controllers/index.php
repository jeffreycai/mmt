<?php

$html = new HTML();
$html->renderOut('theme_default/components/html_header', array(
    'body_class' => 'theme_default',
    'title' => i18n(array(
        'en' => 'Secure payment page',
        'zh' => '安全支付页面'
    ))
));
$html->renderOut('theme_default/components/header', array(
    'bgimage' => '',
    'shoplogo' => '',
    'shopname' => ''
));
$html->renderOut('theme_default/components/mainnav');
$html->renderOut('theme_default/components/slideshow', array(
    'sliders' => array(
      'http://placehold.it/600x320',
      'http://placehold.it/600x320',
      'http://placehold.it/600x320',
      'http://placehold.it/600x320',
      'http://placehold.it/600x320'
    )
));
$html->renderOut('theme_default/components/cards', array(
    'products' => Product::findAll()
));
$html->renderOut('theme_default/components/footer');

$html->renderOut('theme_default/components/html_footer');