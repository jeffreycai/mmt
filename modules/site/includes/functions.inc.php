<?php

function is_demo_account($username) {
  $settings = Vars::getSettings();
  return in_array($username, $settings['demo_accounts']);
}

function render_ga() {
  if (ENV == 'prod') {
    return "
<!-- GA -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-75028141-1', 'auto');
  ga('send', 'pageview');

</script>
<!-- /GA -->
";
  }
  return '';
}