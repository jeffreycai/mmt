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
      echo "The message to " . $message_data[1] . " was successful, with reference " . $message_data[2] . "\n";
    } elseif ($message_data[0] == "BAD") {
      echo "The message to " . $message_data[1] . " was NOT successful. Reason: " . $message_data[2] . "\n";
    } elseif ($message_data[0] == "ERROR") {
      echo "There was an error with this request. Reason: " . $message_data[1] . "\n";
    }
  }
}
