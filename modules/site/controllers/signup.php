<?php
// log out if already login
if (is_login()) {
  MySiteUser::getCurrentUser()->logout();
}

dispatch('site/siteuser/user_signup');