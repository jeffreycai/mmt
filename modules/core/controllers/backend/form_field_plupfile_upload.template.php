
require_once __DIR__ .'/../../../../bootstrap.php';

/**
 * upload.php
 *
 * Copyright 2013, Moxiecode Systems AB
 * Released under GPL License.
 *
 * License: http://www.plupload.com/license
 * Contributing: http://www.plupload.com/contributing
 */

#!! IMPORTANT: 
#!! this file is just an example, it doesn't incorporate any security checks and 
#!! is not recommended to be used in production environment as it is. Be sure to 
#!! revise it and customize to your needs.


// Make sure file is not cached (as it happens for example on iOS devices)
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");


$rtn = new stdClass();
///// validation

if (!User::getInstance()->isLogin()) {
  $rtn->error = i18n(array(
    'en' => 'Authorisation required.',
    'zh' => '抱歉，您没有权限进行此操作'
  ));
  echo json_encode($rtn);
  exit;
}

// we check if the target folder exists and writable
if (!is_writable(WEBROOT . DS . '<?php echo $upload_dir ?>')) {
  $rtn->error = i18n(array(
    'en' => 'File upload error: File upload folder needs to be writable.',
    'zh' => '文件上传出错： 文件上传目录必须为可写'
  ));
  echo json_encode($rtn);
  exit;
}


/* 
// Support CORS
header("Access-Control-Allow-Origin: *");
// other CORS headers if any...
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
	exit; // finish preflight CORS requests here
}
*/

// 5 minutes execution time
@set_time_limit(5 * 60);

// Uncomment this one to fake upload time
// usleep(5000);

// Settings
$targetDir = CACHE_DIR;
//$targetDir = 'uploads';
$cleanupTargetDir = true; // Remove old files
$maxFileAge = 5 * 3600; // Temp file age in seconds


// Create target dir
if (!file_exists($targetDir)) {
	@mkdir($targetDir);
}

// Get a file name
if (isset($_REQUEST["name"])) {
	$fileName = $_REQUEST["name"];
  $fileName = preg_replace('/[^0-9a-zA-Z\-_\.]/', '_', $fileName);
  $fileName = preg_replace('/_+/', '_', $fileName);
  $fileName = strtolower($fileName);
  $tokens = explode(".", $fileName);
  // $tokens[sizeof($tokens)-2] = $tokens[sizeof($tokens)-2] . "_" . rand(100, 999);
  $fileName = implode(".", $tokens);
} elseif (!empty($_FILES)) {
	$fileName = $_FILES["file"]["name"];
  $fileName = preg_replace('/[^0-9a-zA-Z\-_\.]/', '_', $fileName);
  $fileName = preg_replace('/_+/', '_', $fileName);
  $fileName = strtolower($fileName);
  $tokens = explode(".", $fileName);
  // $tokens[sizeof($tokens)-2] = $tokens[sizeof($tokens)-2] . "_" . rand(100, 999);
  $fileName = implode(".", $tokens);
} else {
	$fileName = uniqid("file_");
}

// check if the file has a valid extension
$tokens = explode('.', $fileName);
$extension = array_pop($tokens);
$extension = strtolower($extension);
$extensions = explode(',', '<?php echo $file_extensions ?>');
if (!in_array($extension, $extensions)) {
    $rtn->error = i18n(array(
      'en' => 'File upload error: File type not allowed.',
      'zh' => '文件上传出错：文件类型非法'
    ));
    echo json_encode($rtn);
    exit;
}

$filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;

// Chunking might be enabled
$chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
$chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;


// Remove old temp files	
if ($cleanupTargetDir) {
	if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
    $rtn->error = i18n(array(
      'en' => 'File upload error: Failed to open temp directory.',
      'zh' => '文件上传出错： 打开临时文件夹出错'
    ));
    echo json_encode($rtn);
    exit;
  }

	while (($file = readdir($dir)) !== false) {
		$tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;

		// If temp file is current file proceed to the next
		if ($tmpfilePath == "{$filePath}.part") {
			continue;
		}

		// Remove temp file if it is older than the max age and is not the current file
		if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge)) {
			@unlink($tmpfilePath);
		}
	}
	closedir($dir);
}	


// Open temp file
if (!$out = @fopen("{$filePath}.part", $chunks ? "ab" : "wb")) {
  $rtn->error = i18n(array(
    'en' => 'File upload error: Failed to open output stream.',
    'zh' => '文件上传出错： 打开output stream出错'
  ));
  echo json_encode($rtn);
  exit;
}

if (!empty($_FILES)) {
	if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
    $rtn->error = i18n(array(
      'en' => 'File upload error: Failed to move uploaded file.',
      'zh' => '文件上传出错： 移动上传文件出错'
    ));
    echo json_encode($rtn);
    exit;
  }

	// Read binary input stream and append it to temp file
	if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
    $rtn->error = i18n(array(
      'en' => 'File upload error: Failed to open input stream.',
      'zh' => '文件上传出错： 打开input stream出错'
    ));
    echo json_encode($rtn);
    exit;
  }
} else {	
	if (!$in = @fopen("php://input", "rb")) {
    $rtn->error = i18n(array(
      'en' => 'File upload error: Failed to open input stream.',
      'zh' => '文件上传出错： 打开input stream出错'
    ));
    echo json_encode($rtn);
    exit;
  }
}

while ($buff = fread($in, 4096)) {
	fwrite($out, $buff);
}

@fclose($out);
@fclose($in);

// Check if file has been uploaded
if (!$chunks || $chunk == $chunks - 1) {
	// Strip the temp .part suffix off 
	rename("{$filePath}.part", $filePath);
}

// Return Success JSON-RPC response
$rtn->success = i18n(array(
  'en' => 'File upload success.',
  'zh' => '文件上传成功'
));
$rtn->filepath = str_replace(WEBROOT . DS , '', $filePath);
echo json_encode($rtn);
exit;