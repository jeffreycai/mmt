<?php
  //-- ChargeItem:Clear cache
  if ($command == "cc") {
    if ($arg1 == "all" || $arg1 == "charge_item") {
      echo " - Drop table 'charge_item' ";
      echo ChargeItem::dropTable() ? "success\n" : "fail\n";
    }
  }

  //-- ChargeItem:Import DB
  if ($command == "import" && $arg1 == "db" && (is_null($arg2) || $arg2 == "charge_item") ) {
  //- create tables if not exits
  echo " - Create table 'charge_item' ";
  echo ChargeItem::createTableIfNotExist() ? "success\n" : "fail\n";
  }
  