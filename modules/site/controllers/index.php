<?php

$user = MySiteUser::getCurrentUser();

$html = new HTML();
$html->renderOut('site/index', array(
    'user' => $user
));