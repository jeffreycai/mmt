<?php

$id = isset($vars[1]) ? $vars[1] : null;
$object = Product::findById($id);
if (is_null($object)) {
  HTML::forward('core/404');
}

// handle form submission
if (isset($_POST['submit'])) {
  $error_flag = false;

  /// validation
  
  // validation for $title
  $title = isset($_POST["title"]) ? strip_tags($_POST["title"]) : null;
  if (empty($title)) {
    Message::register(new Message(Message::DANGER, i18n(array("en" => "title is required.", "zh" => "请填写title"))));
    $error_flag = true;
  }
  
  // validation for $thumbnail
  $thumbnail = isset($_POST["thumbnail"]) ? strip_tags(trim($_POST["thumbnail"])) : null;  
  // validation for $description
  $description = isset($_POST["description"]) ? $_POST["description"] : null;
  if (empty($description)) {
    Message::register(new Message(Message::DANGER, i18n(array("en" => "description is required.", "zh" => "请填写description"))));
    $error_flag = true;
  }
  
  // validation for $price
  $price = isset($_POST["price"]) ? strip_tags($_POST["price"]) : null;
  if (empty($price)) {
    Message::register(new Message(Message::DANGER, i18n(array("en" => "price is required.", "zh" => "请填写price"))));
    $error_flag = true;
  }
  /// proceed submission
  
  // proceed for $title
  $object->setTitle($title);
  
  // proceed for $thumbnail
  $object->setThumbnail($thumbnail);
  
  // proceed for $description
  $object->setDescription($description);
  
  // proceed for $price
  $object->setPrice($price);
  if ($error_flag == false) {
    if ($object->save()) {
      Message::register(new Message(Message::SUCCESS, i18n(array("en" => "Record saved", "zh" => "记录保存成功"))));
      HTML::forwardBackToReferer();
    } else {
      Message::register(new Message(Message::DANGER, i18n(array("en" => "Record failed to save", "zh" => "记录保存失败"))));
    }
  }
}



$html = new HTML();

$html->renderOut('core/backend/html_header', array(
  'title' => i18n(array(
  'en' => 'Edit Product',
  'zh' => 'Edit 产品',
  )),
));
$html->output('<div id="wrapper">');
$html->renderOut('core/backend/header');


$html->renderOut('product/backend/product_edit', array(
  'object' => $object
));


$html->output('</div>');

$html->renderOut('core/backend/html_footer');

exit;

