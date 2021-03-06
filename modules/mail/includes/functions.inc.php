<?php

function load_library_phpmailer() {
  require_once WEBROOT . DS . 'modules' . DS . 'mail' . DS . 'includes' . DS . 'libraries' . DS . 'PHPMailer' . DS . 'PHPMailerAutoload.php';
}

/*
function sendemailAdmin($subject, $msg) {
  $settings = Vars::getSettings();
  $username = $settings['mail']['admin']['username'];
  $password = $settings['mail']['admin']['password'];
  if (strpos($username, '@') == false) {
    $username = decrypt($username);
    $password = decrypt($password);
  }
  
  
  load_library_phpmailer();

  $mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch

  $mail->IsSMTP(); // telling the class to use SMTP

  try {
    $mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
    $mail->Mailer = $settings['mail']['admin']['mailer'];
    $mail->SMTPAuth   = true;                  // enable SMTP authentication
    $mail->CharSet = 'UTF-8';
    $mail->SMTPSecure = $settings['mail']['admin']['SMTPSecure'];                 // sets the prefix to the servier
    $mail->Host       = $settings['mail']['admin']['host'];      // sets GMAIL as the SMTP server
    $mail->Port       = $settings['mail']['admin']['port'];                   // set the SMTP port for the GMAIL server
    $mail->Username   = $username;  // GMAIL username
    $mail->Password   = $password;            // GMAIL password
    $mail->AddReplyTo($settings['mail']['admin']['to']);
    $mail->AddAddress($settings['mail']['admin']['to']);
    $mail->SetFrom($settings['mail']['admin']['from'], $settings['mail']['admin']['nickname']);
    $mail->Subject = $subject;
    $mail->MsgHTML($msg);
    $mail->Send();
    
//    if (class_exists('Log')) {
//      $log = new Log('mail', Log::SUCCESS, 'Send email to admin');
//      $log->save();
//    }
  } catch (phpmailerException $e) {
    $log = new Log('mail', Log::ERROR, 'Failed to send email: ' . $e->errorMessage());
    $log->save();
    return false;
  } catch (Exception $e) {
    $log = new Log('mail', Log::ERROR, 'Failed to send email: ' . $e->getMessage());
    return false;
  }
  return true;
}
 * 
 */


function sendemailAdmin($subject, $msg) {
  $settings = Vars::getSettings();
  
  return sendMailViaLocal($settings['siteemail'], 'Site Admin', 'admin@songguo.com.au', 'Site Admin', 'admin@songguo.com.au', $settings['sitename'], $subject, $msg);
}



function sendTicketToClient($subject, $msg, Array $attachements, $to) {
  $settings = Vars::getSettings();
  $username = $settings['mail']['ticket']['username'];
  $password = $settings['mail']['ticket']['password'];
  if (strpos($username, '@') == false) {
    $username = decrypt($username);
    $password = decrypt($password);
  }
  
  load_library_phpmailer();
  
  $mail = new PHPMailer(true);
  
  try {
//    $mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
    $mail->Mailer = $settings['mail']['ticket']['mailer'];
    $mail->SMTPAuth   = true;                  // enable SMTP authentication
    $mail->CharSet = 'UTF-8';
    $mail->SMTPSecure = $settings['mail']['ticket']['SMTPSecure'];                 // sets the prefix to the servier
    $mail->Host       = $settings['mail']['ticket']['host'];      // sets GMAIL as the SMTP server
    $mail->Port       = $settings['mail']['ticket']['port'];                   // set the SMTP port for the GMAIL server
    $mail->Username   = $username;  // GMAIL username
    $mail->Password   = $password;            // GMAIL password
    $mail->AddReplyTo($settings['mail']['ticket']['from']);
    $mail->AddAddress($to);
    $mail->SetFrom($settings['mail']['ticket']['from'], $settings['sitename']);
    $mail->Subject = $subject;
    $mail->MsgHTML($msg);
    foreach ($attachements as $ticket) {
      $mail->addAttachment($ticket);
    }
    $mail->Send();
    

  } catch (phpmailerException $e) {
    $log = new Log('mail', Log::ERROR, 'Failed to send email: ' . $e->errorMessage());
    $log->save();
    return false;
  } catch (Exception $e) {
    $log = new Log('mail', Log::ERROR, 'Failed to send email: ' . $e->getMessage());
    $log->save();
    return false;
  }
  return true;
}


function sendMailViaLocal($to, $to_nickname = false, $reply_to, $reply_to_nickname = false, $from, $from_nickname = false, $subject, $body, $attachments = array(), $wordwrap = 78) {
  
  load_library_phpmailer();
  
  $mail = new PHPMailer(true);
  $mail->CharSet = 'utf-8';

  try {
    if(!PHPMailer::validateAddress($to)) {
      throw new Exception("Email address " . $to . " is invalid -- aborting!");
    }
    $mail->isMail();
    $mail->addReplyTo($reply_to, $reply_to_nickname);
    $mail->From       = $from;
    if ($from_nickname) {$mail->FromName   = $from_nickname;}
    $mail->addAddress($to, $to_nickname);
    $mail->Subject  = $subject;

    if ($wordwrap) {$mail->WordWrap = 78;};
    $mail->msgHTML($body, dirname(__FILE__), true); //Create message bodies and embed images
    
    // add attachments
    foreach ($attachments as $key => $val) {
      if (is_int($key)) {
        $mail->addAttachment($val);
      } else {
        $mail->addAttachment($val, $key);
      }
    }


    try {
      $result = $mail->send();
      return $result;
    }
    catch (Exception $e) {
      throw new Exception('Unable to send to: ' . $to. ': '.$e->getMessage());
    }
  }
  catch (Exception $e) {
    if (class_exists('Log')) {
      $log = new Log('PHPMailer', Log::ERROR, $e->errorMessage());
      $log->save();
    }
    return false;
  }
}

function sendMailViaSMTP() {
  
}

function loadEmailTemplate($template_name, $vars = array()) {
  foreach ($vars as $key => $val) {
    $$key = $val;
  }
  
  ob_start();
  include(MODULESROOT . DS . 'mail' . DS . 'templates' . DS . $template_name . '.tpl.php');
  $content = ob_get_clean(); 
  return $content;
}


function sendmail($subject, $body, $to) {
  $settings = Vars::getSettings();
  return sendMailViaLocal($to, '', $settings['siteemail'], $settings['sitename'], 'pdrupal@'.SITEDOMAIN, $settings['sitename'], $subject, $body);
}