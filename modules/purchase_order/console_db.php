<?php
  //-- PurchaseOrder:Clear cache
  if ($command == "cc") {
    if ($arg1 == "all" || $arg1 == "purchase_order") {
      echo " - Drop table 'purchase_order' ";
      echo PurchaseOrder::dropTable() ? "success\n" : "fail\n";
    }
  }

  //-- PurchaseOrder:Import DB
  if ($command == "import" && $arg1 == "db" && (is_null($arg2) || $arg2 == "purchase_order") ) {
  //- create tables if not exits
  echo " - Create table 'purchase_order' ";
  echo PurchaseOrder::createTableIfNotExist() ? "success\n" : "fail\n";
  }
  
  //-- CartItem:Clear cache
  if ($command == "cc") {
    if ($arg1 == "all" || $arg1 == "purchase_order") {
      echo " - Drop table 'cart_item' ";
      echo CartItem::dropTable() ? "success\n" : "fail\n";
    }
  }

  //-- CartItem:Import DB
  if ($command == "import" && $arg1 == "db" && (is_null($arg2) || $arg2 == "cart_item") ) {
  //- create tables if not exits
  echo " - Create table 'cart_item' ";
  echo CartItem::createTableIfNotExist() ? "success\n" : "fail\n";
  }
  