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
  
  <title><?php echo $title; ?></title>

  <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <link rel='stylesheet' href='//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'>
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css'>
  <style>
    input[type=submit] {
      margin-bottom: 10px;
    }
  </style>
</head>

<body class="admin <?php if (isset($body_class)) {echo $body_class; }?>">




<div class="container">
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <div class="login-panel panel panel-default" style="margin-top: 60px;">
        <div class="panel-heading">
          <h3 class="panel-title"><?php echo $title; ?></h3>
        </div>
        <div class="panel-body">
          