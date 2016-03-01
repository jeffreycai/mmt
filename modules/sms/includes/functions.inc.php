<?php

function sendSMS($to_number, $text) {
  $settings = Vars::getSettings();
  
  $username = decrypt($settings['sms_un']);
  $password = decrypt($settings['sms_pw']);
  $destination = $to_number; //Multiple numbers can be entered, separated by a comma
  $source = $settings['sms_sender'];
  $ref = 'abc123';

  $content = 'username=' . rawurlencode($username) .
          '&password=' . rawurlencode($password) .
          '&to=' . rawurlencode($destination) .
          '&from=' . rawurlencode($source) .
          '&message=' . rawurlencode($text) .
          '&ref=' . rawurlencode($ref);

  $ch = curl_init('https://api.smsbroadcast.com.au/api-adv.php');
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $output = curl_exec ($ch);
  curl_close ($ch);
  
  $smsbroadcast_response = $output;
  $response_lines = explode("\n", $smsbroadcast_response);

  foreach ($response_lines as $data_line) {
    $message_data = "";
    $message_data = explode(':', $data_line);
    if ($message_data[0] == "OK") {
      // success
      if (class_exists('Log')) {
        $log = new Log('SMS', Log::SUCCESS, 'Message sent to ' . $message_data[1], $_SERVER['REMOTE_ADDR']);
        $log->save();
      }
    } elseif ($message_data[0] == "BAD") {
      // register error message
      // Message::register(new Message(Message::DANGER, 'SMS delivery failed.'));
      // log it
      if (class_exists('Log')) {
        $log = new Log('SMS', Log::ERROR, 'Message failed to send to ' .$message_data[1] . '. Reason: ' . $message_data[2], $_SERVER['REMOTE_ADDR']);
        $log->save();
      }
    } elseif ($message_data[0] == "ERROR") {
      if (class_exists('Log')) {
        $log = new Log('SMS', Log::ERROR, 'Message failed to send. Reason: ' . $message_data[1], $_SERVER['REMOTE_ADDR']);
        $log->save();
      }
    }
  }
}


function loadSMSTemplate($template_name, $vars = array()) {
  foreach ($vars as $key => $val) {
    $$key = $val;
  }
  
  ob_start();
  include(MODULESROOT . DS . 'sms' . DS . 'templates' . DS . $template_name . '.tpl.php');
  $content = ob_get_clean(); 
  return $content;
}