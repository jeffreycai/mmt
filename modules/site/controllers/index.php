<?php

$user = MySiteUser::getCurrentUser();

HTML::forward('shop/'.$user->getId());