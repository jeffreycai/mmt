<?php

require_once __DIR__ .'/../../../../bootstrap.php';

$fid = strip_tags($_POST['fid']);
$furi = WEBROOT . DS . strip_tags($_POST['furi']);

// check if the user has right to delete file
$user = MySiteUser::getCurrentUser();
if (strpos($furi, '/user/'.$user->getId().'/') === false && // under his own folder
    strpos($furi, '/files/cache/') === false) { // or under cache folder
  $rtn->error = i18n(array('en' => 'Authorisation required.', 'zh' => '抱歉，您没有权限进行此操作'));
  echo json_encode($rtn);
  exit;
}

// if passed, delete the file
$rtn->fid = strip_tags($_POST['fid']);
if (is_file($furi) && unlink($furi)) {
  $rtn->success = 1;
} else {
  $rtn->error = i18n(array(
    "en" => "Failed to delete file",
    "zh" => "删除文件失败"
  ));
}
echo json_encode($rtn);

