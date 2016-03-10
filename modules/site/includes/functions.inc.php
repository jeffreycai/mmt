<?php

function is_demo_account($username) {
  $settings = Vars::getSettings();
  return in_array($username, $settings['demo_accounts']);
}