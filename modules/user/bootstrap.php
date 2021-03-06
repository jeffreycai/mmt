<?php

// register theme css and js

Asset::addDynamicAsset('user', 'css', 'frontend', '
<!-- user style -->
<link rel="stylesheet" href="'.uri('modules/user/assets/css/style.css', false).'">
');
Asset::addDynamicAsset('user', 'js', 'frontend', '
<!-- user js -->
<script type="text/javascript" src="'.uri('modules/user/assets/js/script.js', false).'"></script>
<script type="text/javascript" src="'.uri('libraries/jquery-qrcode/dist/jquery.qrcode.min.js', false).'"></script>
');


/**
 *  we remove assets added by other themes if it is user admin
 */
if (is_useradmin()) {
  Asset::removeDynamicAsset('theme_default', 'css', 'frontend');
  Asset::removeDynamicAsset('theme_default', 'js', 'frontend');
}
