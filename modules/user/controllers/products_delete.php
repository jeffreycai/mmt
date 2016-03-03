<?php
require_login();
$user = MySiteUser::getCurrentUser();

$pid = isset($vars[1]) ? $vars[1] : null;
$object = Product::findById($pid);
if ($object == null || $object->getUserId() != $user->getId()) {
  access_denied();
}

/** --------------------------------------- **/

if ($object->delete()) {
  die(1);
} else {
  die(0);
}