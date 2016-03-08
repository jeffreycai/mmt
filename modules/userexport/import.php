<?php

define('IMPORT_USERNAME', 'foodking');
define('RENAMED_USERNAME', 'foodking'); // if you need the user to be renamed, put new username here, otherwise leave it blank
if (RENAMED_USERNAME) {
  define('RENAMED_EMAIL', 'bluestream.186@gmail.com'); // new user's email, must be unique
}

require_once __DIR__ . "/../../bootstrap.php";

if (is_cli()) {
  die('Please run under browser, not cli');
}

// only myself can do the export
if (User::getInstance()->isLogin()) {
  if (RENAMED_USERNAME) {
    $user = MySiteUser::findByUsername(RENAMED_USERNAME, 'MySiteUser');
    if (!$user) {
      $user = MySiteUser::findByEmail(RENAMED_EMAIL);
    }
  } else {
    $user = MySiteUser::findByUsername(IMPORT_USERNAME, 'MySiteUser');
  }
  if ($user) {
    die('user already exists. abort import.');
  }
  

  
  $export_folder = __DIR__ . "/results/" . IMPORT_USERNAME;
  // import vars
  $vars = unserialize(file_get_contents($export_folder . '/vars.info'));
  
  $user = $vars['user'];
  $old_uid = $user->getId();
  if (RENAMED_USERNAME) {
    $user->setUserName(RENAMED_USERNAME);
    if (RENAMED_EMAIL) {
      $user->setEmail(RENAMED_EMAIL);
    }
  }
  $user->setNew();
  $result = $user->save();// _debug($user->getLastExecuteQuery());
  $uid = $user->getId();
  
  $profile = $vars['profile'];
  $profile->setNew();
  $profile->setUserId($uid);
  $profile->save();
  
  $site_user_roles = $vars['site_user_roles'];
  foreach ($site_user_roles as $site_user_role) {
    $site_user_role->setNew();
    $site_user_role->setUserId($uid);
    $site_user_role->save();
  }
  
  $products = $vars['products'];
  foreach ($products as $product) {
    $product->setNew();
    $product->setUserId($uid);
    $product->setThumbnail(str_replace("/$old_uid/", "/$uid/", $product->getThumbnail()));
    $product->setImages(str_replace("/$old_uid/", "/$uid/", $product->getImages()));
    $product->save();
  }
  
  $shopsettings = $vars['shopsettings'];
  $shopsettings->setId($user->getShopSettings()->getId());
  $shopsettings->setUserId($uid);
  $shopsettings->setShopLogo(str_replace("/$old_uid/", "/$uid/", $shopsettings->getShopLogo()));
  $shopsettings->save();
  
  // copy file assets over
  $target_folder = FILE_DIR . "/user/" . $uid;
  if (is_dir($target_folder)) {
    delFolder($target_folder);
  }
  mkdir($target_folder);
  copyFolderFilesOver($export_folder, $target_folder);
  unlink($target_folder . "/vars.info");
  
  echo "Import done!\n";
} else {
  echo "Only backend user can do this task.";
}