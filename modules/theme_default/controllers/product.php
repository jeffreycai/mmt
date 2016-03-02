<?php
$username = isset($vars[1]) ? strip_tags($vars[1]) : null;
$pid = isset($vars[2]) ? strip_tags($vars[2]) : null;
$user = MySiteUser::findByUsername($username, 'MySiteUser');
$product = Product::findById($pid);
if (!$user || !$product) {
  dispatch('site/404');
  exit;
}
$preview = isset($_GET['preview']) && $_GET['preview'] == 1 ? true : false;

// check if it is preview mode
if ($preview) {
  // we only put preview message for loggin shop owner
  if (MySiteUser::getCurrentUser()->getId() == $user->getId()) {
    Message::register(new Message(Message::INFO, '您是本商品店主，预览商品中'));
    // if product is off shelf, we notice shop owner not to send it over to customer
    if (!$product->getOnShelf()) {
      Message::register(new Message(Message::INFO, '此商品未上架，请勿将预览模式下的商品页链接分享给客户，客户是无法访问的'));
    }
  }
// when not preview, we don't allow customer to access off-shelf product
} else {
  if (!$product->getOnShelf()) {
    $html = new HTML();
    $html->renderOut('core/backend/single_form_header', array(
      'title' => '此商品未上架'
    ));
    $html->output('<p>抱歉，您所访问的商品没有上架。<br /><small><a href="#" onclick="window.history.back();">&laquo; 返回上页</a></small></p>');
    $html->renderOut('core/backend/single_form_footer');
    exit;
  }
}

// get sliders
$sliders = empty(trim($product->getImages())) ? explode("\n", trim($product->getThumbnail())) : explode("\n", trim($product->getImages()));
for ($i = 0; $i < sizeof($sliders); $i++) {
  $sliders[$i] = uri($sliders[$i], false);
}


/** presentation **/
$html = new HTML();
$html->renderOut('theme_default/components/html_header', array(
    'body_class' => 'theme_default product',
    'title' => '商品 :: ' . htmlentities($product->getTitle())
));
$html->renderOut('theme_default/components/navback_transparent', array(
  'uri' => $user->getShopUri(),
  'user' => $user
));
$html->renderOut('theme_default/components/slideshow', array(
    'sliders' => $sliders
));
$html->renderOut('theme_default/product', array(
    'user' => $user,
    'product' => $product
));
$html->renderOut('theme_default/components/footer');
$html->renderOut('theme_default/components/bottom_nav', array(
  'user' => $user,
  'product'  => $product
));

$html->renderOut('theme_default/components/html_footer');