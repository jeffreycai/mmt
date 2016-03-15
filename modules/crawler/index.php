<?php
/** set cron job to run on this gateway script, every 1 min **/
$cookie = __DIR__ . '/cookie';
require_once  __DIR__ . '/../../bootstrap.php';

// time table
$time_table = array();

// yanwo
$time_table['10:01'] = 'yanwo1_1070892';
$time_table['17:00'] = 'yanwo1_1070910';
$time_table['20:21'] = 'yanwo1_1070934';
// ozboxoffice
$time_table['17:15'] = 'ozboxoffice_878884';
$time_table['19:12'] = 'ozboxoffice_843303';
$time_table['20:20'] = 'ozboxoffice_808710';
$time_table['21:05'] = 'ozboxoffice_681595';
// broker sydney
$time_table['21:01'] = 'brokersydney_924527';
$time_table['21:02'] = 'brokersydney_924543';
$time_table['21:03'] = 'brokersydney_924501';



/** task **/
// no access for public
if (!is_cli()) {
  if (User::getInstance()->isLogin()) {
    echo "<pre>";
    print_r($time_table);
    die("</pre>");
  }
  die('Please login first');
}

// check if there is cron job to run
$H_i = date('H:i');
if (isset($time_table[$H_i])) {
  $log = new Log('cron', Log::NOTICE, $H_i . ' - ' . $time_table[$H_i] . ' START');
  $log->save();
  
  $tokens = explode('_', $time_table[$H_i]);
  $script = $tokens[0];
  $tid = $tokens[1];
  
  $crawler = new Crawler();
  $crawler->setCookiePath($cookie);
  // check if login, if not login
  $result = $crawler->read('http://www.sydneytoday.com/user');
  
  // login if cookie does not exist or too old
  if (strpos($result, ' bluestream186@gmail.com') == false) {
    $f = fopen($cookie, 'w');
    fclose($f);

    $result = $crawler->read('http://www.sydneytoday.com/user/login?destination=/');
    $matches = array();
    preg_match('/name="form_build_id" value="([^"]+)"/', $result, $matches);
    $form_build_id = isset($matches[1]) ? $matches[1] : false;
    $crawler->setReferer('http://www.sydneytoday.com/user/login?destination=/');
    $result = $crawler->post('http://www.sydneytoday.com/user/login?destination=/', 'name=bluestream186%40gmail.com&pass=0172122a&persistent_login=1&form_build_id='.$form_build_id.'&form_id=user_login');
    $crawler->read('http://www.sydneytoday.com/user');
  }
  
  // ding
  $result = $crawler->read('http://www.sydneytoday.com/nodesticky/' . $tid);

  if (strpos($result, 'status":1') !== false) {
    $log = new Log('cron', Log::SUCCESS, $H_i . ' - ' . $time_table[$H_i] . ' - ' . serialize($result));
  } else {
    $log = new Log('cron', Log::ERROR, $H_i . ' - ' . $time_table[$H_i] . ' - ' . serialize($result));
  }
  $log->save();
}

echo "\nDone\n";