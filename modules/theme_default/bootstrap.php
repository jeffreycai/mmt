<?php

// register theme css and js

Asset::addDynamicAsset('theme_default', 'css', 'frontend', '
<!-- theme default style -->
<link rel="stylesheet" href="'.uri('modules/theme_default/assets/css/style.css', false).'">
');
Asset::addDynamicAsset('theme_default', 'js', 'frontend', '
<!-- theme default js -->
<script type="text/javascript" src="'.uri('modules/theme_default/assets/js/script.js', false).'"></script>
');