<?php
require_login();


$user = MySiteUser::getCurrentUser();
// get orders to be displayed
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$orders = $user->getAllConfirmedPurchaseOrdersWithPage($page, $settings['purchase_order_per_page']);


/** presentation **/
$html = new HTML();

$html->renderOut('user/components/html_header', array(
    'body_class' => 'user orders',
    'title' => i18n(array(
        'en' => 'Manger orders',
        'zh' => '管理订单'
    ))
));
$html->output('<div class="container">');
$html->renderOut('user/components/header_general', array(
    'title' => i18n(array(
        'en' => 'Manage orders',
        'zh' => '管理订单'
    )),
    'gobackuri' => uri('user')
));
$html->renderOut('user/orders', array(
  'user' => $user,
  'orders' => $orders,
  'pager' => $html->render('user/components/pagination', array(
    'total' => ceil($user->countAllConfirmedPurchaseOrders() / $settings['purchase_order_per_page']),
    'page' => $page
  ))
));

$html->output('</div>');

$html->renderOut('user/components/html_footer');
