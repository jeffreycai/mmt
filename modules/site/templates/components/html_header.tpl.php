<!DOCTYPE html>
<!--[if IEMobile 7]><html class="iem7 no-js"  lang="<?php echo get_language(); ?>" dir="ltr"><![endif]-->
<!--[if lte IE 6]><html class="lt-ie9 lt-ie8 lt-ie7 no-js"  lang="<?php echo get_language(); ?>" dir="ltr"><![endif]-->
<!--[if (IE 7)&(!IEMobile)]><html class="lt-ie9 lt-ie8 no-js"  lang="<?php echo get_language(); ?>" dir="ltr"><![endif]-->
<!--[if IE 8]><html class="lt-ie9 no-js"  lang="<?php echo get_language(); ?>" dir="ltr"><![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)]><!--><html class="no-js <?php echo isset($html_class) ? $html_class : '' ?>" lang="<?php echo get_language(); ?>" dir="ltr"><!--<![endif]-->

<head profile="http://www.w3.org/1999/xhtml/vocab">
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

  <title><?php echo isset($title) ? $title : ''; ?></title>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

  <link rel="apple-touch-icon" href="<?php echo uri('modules/site/assets/images/apple-touch-icon.png', false) ?>" />
  <link rel="icon" href="<?php echo uri('modules/site/assets/images/favicon.png') ?>" type="image/png" />


  <link rel='stylesheet' href='//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'>
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css'>
  <link rel="stylesheet" href="<?php echo uri('modules/site/assets/css/original.css', false) ?>" />
  <link rel='stylesheet' href='<?php echo uri('modules/site/assets/css/style.css', false) ?>'>

  <script src="<?php echo uri('modules/site/assets/js/original.js') ?>"></script>
</head>

<body class="<?php if (isset($body_class)) {echo $body_class; }?>">
<?php echo render_ga(); ?>
