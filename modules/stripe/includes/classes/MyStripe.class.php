<?php

class MyStripe {
  private $public_key;
  private $secret_key;
  private $alipay; // if this stripe instance is alipay enabled
  
  /**
   * Constructor
   * 
   * @param type $public_key
   * @param type $secret_key
   */
  public function __construct($public_key, $secret_key) {
    $this->public_key = $public_key;
    $this->secret_key = $secret_key;
    $this->alipay = false;
  }
  
  /**
   * Set Alipay on or off
   * 
   * @param boolean $on
   */
  public function setAlipay(boolean $on) {
    $this->alipay = $on;
  }
  
  public function load_library_stripe() {
    require_once MODULESROOT . '/stripe/includes/libraries/stripe-php/init.php';
  }
  
  public function renderPaymentForm($template = false) {
    ob_start();
    
    // prepare vars
    $public_key = $this->public_key;
    $secret_key = $this->secret_key;
      
    if (is_file($template)) {
      include $template;
    } else {
      include MODULESROOT . '/stripe/templates/credit_card_form.tpl.php';
    }
    return ob_get_clean();
  }
  
  public function proceedPaymentForm($order_id = false) {
    /** handle payment submission **/
    if (isset($_POST['stripeToken'])) {
      $this->load_library_stripe();

      $error = false;

      // Set your secret key: remember to change this to your live secret key in production
      // See your keys here https://dashboard.stripe.com/account/apikeys
      \Stripe\Stripe::setApiKey($this->secret_key);

      // Get the credit card details submitted by the form
      $token = strip_tags($_POST['stripeToken']);

      // Create the charge on Stripe's servers - this will charge the user's card
      try {
        $params = array(
          "amount" => 1000, // amount in cents, again
          "currency" => "aud",
          "source" => $token,
          "description" => "Example charge",
//          "metadata" => array(
//            "order_id" => $order_id
//          )
        );
        if ($order_id) {
          $params['metadata'] = array(
            "order_id" => $order_id
          );
        }
        $charge = \Stripe\Charge::create($params);
      } catch(\Stripe\Error\Card $e) {
        // Since it's a decline, \Stripe\Error\Card will be caught
        $body = $e->getJsonBody();
        $err  = $body['error'];

        $msg_content = "Purchase order ID: " . $public_id . "\n";

        $msg_content.= "Stripe payment declined\n";
        $msg_content.= 'Status is:' . $e->getHttpStatus() . "\n";
        $msg_content.= 'Type is:' . $err['type'] . "\n";
        $msg_content.= 'Code is:' . $err['code'] . "\n";
        $msg_content.= 'Param is:' . $err['param'] . "\n";
        $msg_content.= 'Message is:' . $err['message'] . "\n";

        if (class_exists('Log')) {
          $log = new Log('Stripe', Log::ERROR, $msg_content, $_SERVER['REMOTE_ADDR']);
          $log->save();
        }

        Message::register(new Message(Message::DANGER, i18n(array(
          'en' => 'An error has occured. Your payment has been declined. No charges has occurred against your credit card.',
          'zh' => '支付过程中出现错误。您的支付请求失败了。我们没有向您的信用卡扣除任何费用。'
        ))));

        $error |= true;
      } catch (\Stripe\Error\RateLimit $e) {
        // Too many requests made to the API too quickly
        if (class_exists('Log')) {
          $msg_content = "Purchase order ID: " . $public_id . "\n";
          $msg_content.= 'Too many requests made to the API too quickly';

          $log = new Log('Stripe', Log::ERROR, $msg_content, $_SERVER['REMOTE_ADDR']);
          $log->save();
        }

        Message::register(new Message(Message::DANGER, i18n(array(
          'en' => 'An error has occured. Your payment has been declined. No charges has occurred against your credit card.',
          'zh' => '支付过程中出现错误。您的支付请求失败了。我们没有向您的信用卡扣除任何费用。'
        ))));

        $error |= true;
      } catch (\Stripe\Error\InvalidRequest $e) {
        // Invalid parameters were supplied to Stripe's API
        if (class_exists('Log')) {
          $msg_content = "Purchase order ID: " . $public_id . "\n";
          $msg_content.= "Invalid parameters were supplied to Stripe's API";

          $log = new Log('Stripe', Log::ERROR, $msg_content, $_SERVER['REMOTE_ADDR']);
          $log->save();
        }

        Message::register(new Message(Message::DANGER, i18n(array(
          'en' => 'An error has occured. Your payment has been declined. No charges has occurred against your credit card.',
          'zh' => '支付过程中出现错误。您的支付请求失败了。我们没有向您的信用卡扣除任何费用。'
        ))));

        $error |= true;
      } catch (\Stripe\Error\Authentication $e) {
        // Authentication with Stripe's API failed
        // (maybe you changed API keys recently)
        // Invalid parameters were supplied to Stripe's API

        if (class_exists('Log')) {
          $msg_content = "Purchase order ID: " . $public_id . "\n";
          $msg_content.= "Authentication with Stripe's API failed\n";
          $msg_content.= "(maybe you changed API keys recently)\n";
          $msg_content.= "Invalid parameters were supplied to Stripe's API";

          $log = new Log('Stripe', Log::ERROR, $msg_content, $_SERVER['REMOTE_ADDR']);
          $log->save();
        }

        Message::register(new Message(Message::DANGER, i18n(array(
          'en' => 'An error has occured. Your payment has been declined. No charges has occurred against your credit card.',
          'zh' => '支付过程中出现错误。您的支付请求失败了。我们没有向您的信用卡扣除任何费用。'
        ))));

        $error |= true;
      } catch (\Stripe\Error\ApiConnection $e) {
        // Network communication with Stripe failed
        if (class_exists('Log')) {
          $msg_content = "Purchase order ID: " . $public_id . "\n";
          $msg_content.= "Network communication with Stripe failed";

          $log = new Log('Stripe', Log::ERROR, $msg_content, $_SERVER['REMOTE_ADDR']);
          $log->save();
        }

        Message::register(new Message(Message::DANGER, i18n(array(
          'en' => 'An error has occured. Your payment has been declined. No charges has occurred against your credit card.',
          'zh' => '支付过程中出现错误。您的支付请求失败了。我们没有向您的信用卡扣除任何费用。'
        ))));

        $error |= true;
      } catch (\Stripe\Error\Base $e) {
        // Display a very generic error to the user, and maybe send
        // yourself an email
        if (class_exists('Log')) {
          $msg_content = "Purchase order ID: " . $public_id . "\n";
          $msg_content.= "a very generic error";

          $log = new Log('Stripe', Log::ERROR, $msg_content, $_SERVER['REMOTE_ADDR']);
          $log->save();
        }

        Message::register(new Message(Message::DANGER, i18n(array(
          'en' => 'An error has occured. Your payment has been declined. No charges has occurred against your credit card.',
          'zh' => '支付过程中出现错误。您的支付请求失败了。我们没有向您的信用卡扣除任何费用。'
        ))));

        $error |= true;
      } catch (Exception $e) {
        // Something else happened, completely unrelated to Stripe
        Message::register(new Message(Message::DANGER, i18n(array(
          'en' => 'An error has occured. Your payment has been declined. No charges has occurred against your credit card.',
          'zh' => '支付过程中出现错误。您的支付请求失败了。我们没有向您的信用卡扣除任何费用。'
        ))));

        $error |= true;
      }

      return $error ? false : true;

    }
  }
}