<?php


$to_ding = array(
    '924527',
    '924543',
    '924501'
);
$cookie = __DIR__ . '/cookie';

require_once  __DIR__ . '/../../bootstrap.php';

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
$rtn = array();
foreach ($to_ding as $tie) {
  $result = $crawler->read('http://www.sydneytoday.com/nodesticky/' . $tie);
  $rtn[] = $result;
}

sendMailViaLocal('jeffreycaizhenyuan@gmail.com', // to
  'Jeffrey',// $to_nickname, 
  'jeffreycaizhenyuan@gmail.com', // $reply_to, 
  'MaimaiTi', // $reply_to_nickname, 
  'admin@maimaitionline.com', // $from, 
  'MaimaiTi', // $from_nickname, 
  '今日悉尼顶帖', // $subject, 
  '<p>'.implode('<br /><br />', $rtn).'</p>' // $body, $attachments, $wordwrap)
);

echo implode("\n\n", $rtn);