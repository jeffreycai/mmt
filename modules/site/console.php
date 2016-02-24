<?php

$settings = Vars::getSettings();

//-- Reset demo user
if ($command == "reset") {
  if ($arg1 == "demo") {
    $user = MySiteUser::findByUsername($settings['demo_account'], 'MySiteUser');
    
    if ($user) {
      $user->delete();
      echo " - Demo user already exists. Deleted now. \n";
    }
    
//    echo " - Create new demo user \n";
//    $user = new MySiteUser();
//    $user->setUsername('demo');
//    $user->setEmail('bluestream186@gmail.com');
//    $user->setSalt('6hctqLbWl6z1M7AC');
//    $user->setPassword('4c4359c6841df4e0cb60b86def0dfdc6');
//    $user->setActive(1);
//    $user->setEmailActivated(1);
//    $user->setCreatedAt(1456272538);
//    $user->save();
  }
}