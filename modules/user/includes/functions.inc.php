<?php

function build_sorting_uri_vars($sorting) {
  $rtn = array();
  if (isset($sorting['onshelf'])) {
    $rtn[] = "onshelf=" . urlencode($sorting['onshelf']);
  }
  if (isset($sorting['column'])) {
    $rtn[] = "column=" . urlencode($sorting['column']);
  }
  if (isset($sorting['order'])) {
    $rtn[] = "order=" . urlencode($sorting['order']);
  }
  return implode("&", $rtn);
}


function access_denied() {
  header('HTTP/1.0 401 Unauthorized');
  echo 'You do not have permission to access this page.';
  exit;
}