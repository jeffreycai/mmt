<?php

require_once __DIR__ . DS . '..' . DS . '..' . DS . 'bootstrap.php';

if (is_cli()) {
  $settings = Shopsettings::findByUserid(1) ? Shopsettings::findByUserid(1) : new Shopsettings();
  $settings->setUserId(1);
  $settings->save();
}