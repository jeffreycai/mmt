<?php

// register theme css and js

Asset::addDynamicAsset('theme_weidian', 'css', 'frontend', '
<!-- theme default style -->
<link rel="stylesheet" href="'.uri('modules/theme_weidian/assets/css/style.css', false).'">
');
Asset::addDynamicAsset('theme_weidian', 'js', 'frontend', '
<!-- theme default js -->
<script type="text/javascript" src="'.uri('modules/theme_weidian/assets/js/script.js', false).'"></script>
');