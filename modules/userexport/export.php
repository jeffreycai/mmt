<?php

define('EXPORT_USERNAME', 'aixin');

require_once __DIR__ . "/../../bootstrap.php";

if (is_cli()) {
  die('Please run under browser, not cli');
}

// only myself can do the export
if (User::getInstance()->isLogin()) {
  $user = MySiteUser::findByUsername(EXPORT_USERNAME, 'MySiteUser');
  if (!$user) {
    die('user "'.EXPORT_USERNAME.'" does not exist');
  }
  
  
  $export_folder = __DIR__ . "/results/" . $user->getUsername();
  // delete the foler if exists
  if (is_dir($export_folder)) {
    delFolder($export_folder);
  }
  
  mkdir($export_folder);
  if (!is_writable($export_folder)) {
    die('folder "'.$export_folder.'" is not writable');
  }
  // copy user images over
  copyFolderFilesOver(FILE_DIR . '/user/' . $user->getId(), $export_folder);
  // store all user objects
  $products = $user->getProducts();
  $shopsettings = $user->getShopSettings();
  $profile = $user->getProfile();
  $roles = SiteUserRole::findByUid($user->getId());
  
  $fp = fopen($export_folder.'/vars.info', 'w');
  fwrite($fp, serialize(array(
    'user' => $user,
    'products' => $products,
    'shopsettings' =>$shopsettings,
    'profile' => $profile,
    'site_user_roles' => $roles
  )));
  fclose($fp);
  
  echo "Export done!\n";
} else {
  echo "Only backend user can do this task.";
}