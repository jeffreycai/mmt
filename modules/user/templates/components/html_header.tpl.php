<!DOCTYPE html>
<!--[if IEMobile 7]><html class="iem7"  lang="<?php echo get_language(); ?>" dir="ltr"><![endif]-->
<!--[if lte IE 6]><html class="lt-ie9 lt-ie8 lt-ie7"  lang="<?php echo get_language(); ?>" dir="ltr"><![endif]-->
<!--[if (IE 7)&(!IEMobile)]><html class="lt-ie9 lt-ie8"  lang="<?php echo get_language(); ?>" dir="ltr"><![endif]-->
<!--[if IE 8]><html class="lt-ie9"  lang="<?php echo get_language(); ?>" dir="ltr"><![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)]><!--><html lang="<?php echo get_language(); ?>" dir="ltr"><!--<![endif]-->

<head profile="http://www.w3.org/1999/xhtml/vocab">
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  
  <!-- favicon start -->
  <link rel="apple-touch-icon" sizes="57x57" href="<?php echo uri('favicon', false) ?>/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="<?php echo uri('favicon', false) ?>/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="<?php echo uri('favicon', false) ?>/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="<?php echo uri('favicon', false) ?>/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="<?php echo uri('favicon', false) ?>/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="<?php echo uri('favicon', false) ?>/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="<?php echo uri('favicon', false) ?>/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="<?php echo uri('favicon', false) ?>/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo uri('favicon', false) ?>/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo uri('favicon', false) ?>/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo uri('favicon', false) ?>/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="<?php echo uri('favicon', false) ?>/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo uri('favicon', false) ?>/favicon-16x16.png">
  <link rel="manifest" href="<?php echo uri('favicon', false) ?>/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="<?php echo uri('favicon', false) ?>/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">
  <!-- favicon end -->
  

  <title><?php echo isset($title) ? $title : ''; ?></title>
  <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<script type="text/javascript">
  var site = jQuery();
  site.settings = <?php echo HTML::renderSettingsInJson() ?>;
  site.settings.subroot = '<?php echo get_sub_root(); ?>';
</script>

<?php HTML::renderOutHeaderUpperRegistry(); ?>  
<?php Asset::printTopAssets('frontend'); ?>
<?php HTML::renderOutHeaderLowerRegistry(); ?>

<?php Asset::renderAllDynamicAssets('js', 'frontend') ?>
<?php Asset::renderAllDynamicAssets('css', 'frontend') ?>

</head>

<body class="<?php if (isset($body_class)) {echo $body_class; }?>">

