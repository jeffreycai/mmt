<?php

require_once 'bootstrap.php';

//echo encrypt('pk_live_h7NLvdBLekF5q4mi1yr4NH59');
//
//echo "\n\n";

$user = MySiteUser::findById(2, "MySiteUser");
$shop_settings = $user->getShopSettings();
$stripe_uid = $shop_settings->getStripeUid();

load_library_stripe();


\Stripe\Stripe::setApiKey(decrypt($settings['admin_stripe_secret_key_dev']));
$charge = \Stripe\Charge::create(array(
          "amount" => 1234, // amount in cents, again
          "currency" => 'aud',
          "customer" => $stripe_uid,
          "description" => 'A test charge',
));
