<?php
require_login();


$user = MySiteUser::getCurrentUser();
// get orders to be displayed
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$charge_items = $user->getChargeItemsWithPage($page, $settings['charge_item_per_page']);


/** presentation **/
$html = new HTML();

$html->renderOut('user/components/html_header', array(
    'body_class' => 'user charge',
    'title' => i18n(array(
        'en' => 'Charge records',
        'zh' => '支付记录'
    ))
));
$html->output('<div class="container">');
$html->renderOut('user/components/header_general', array(
    'title' => i18n(array(
        'en' => 'Charge records',
        'zh' => '支付记录'
    )),
    'gobackuri' => uri('account')
));
$html->renderOut('user/account_charge', array(
  'user' => $user,
  'charge_items' => $charge_items,
  'pager' => $html->render('user/components/pagination', array(
    'total' => ceil($user->countAllChargeItems() / $settings['charge_item_per_page']),
    'page' => $page
  ))
));

$html->output('</div>');

$html->renderOut('user/components/html_footer');
