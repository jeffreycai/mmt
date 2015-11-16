<?php

// register theme css and js

Asset::addDynamicAsset('user', 'css', 'frontend', '
<!-- user style -->
<link rel="stylesheet" href="'.uri('modules/user/assets/css/style.css', false).'">
');
Asset::addDynamicAsset('user', 'js', 'frontend', '
<!-- user js -->
<script type="text/javascript" src="'.uri('modules/user/assets/js/script.js', false).'"></script>
');