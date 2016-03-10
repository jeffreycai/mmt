<?php

define('SITEDOMAIN', ENV == 'prod' ? 'songguo.com.au' : 'songguo.websitesydney.net');

define('CART_ITEM_COOKIE_LIFE_TIME', time() + (3600 * 24));
define('DELIVERY_INFO_COOKIE_LIFE_TIME', time() + (3600 * 24 * 30));