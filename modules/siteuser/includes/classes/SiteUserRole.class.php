<?php
require_once "BaseSiteUserRole.class.php";

class SiteUserRole extends BaseSiteUserRole {
  static function findByUid($uid, $instance = 'SiteUserRole') {
    global $mysqli;
    $query = 'SELECT * FROM site_user_role WHERE user_id=' . $uid;
    $result = $mysqli->query($query);
    $rtn = array();
    while ($result && $b = $result->fetch_object()) {
      $obj = new $instance();
      DBObject::importQueryResultToDbObject($b, $obj);
      $rtn[] = $obj;
    }
    return $rtn;
  }
}
