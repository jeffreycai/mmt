<?php

define('SITEDOMAIN', ENV == 'prod' ? 'www.maimaitionline.com' : 'maimaitionline.websitesydney.net');

define('CART_ITEM_COOKIE_LIFE_TIME', time() + (3600 * 24));
define('DELIVERY_INFO_COOKIE_LIFE_TIME', time() + (3600 * 24 * 30));