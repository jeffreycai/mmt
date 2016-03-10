<?php

include 'bootstrap.php';

$result = sendMailViaLocal('jeffreycaizhenyuan@gmail.com', 'Jeffrey Cai', 'admin@songguo.com.au', 'Songguo', 'admin@songguo.com.au', 'Songguo', 'Test', 'A test email');

echo $result ? "success" : "fail";
echo "\n";