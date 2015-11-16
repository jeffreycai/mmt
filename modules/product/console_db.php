<?php
  //-- Product:Clear cache
  if ($command == "cc") {
    if ($arg1 == "all" || $arg1 == "product") {
      echo " - Drop table 'product' ";
      echo Product::dropTable() ? "success\n" : "fail\n";
    }
  }

  //-- Product:Import DB
  if ($command == "import" && $arg1 == "db" && (is_null($arg2) || $arg2 == "product") ) {
  //- create tables if not exits
  echo " - Create table 'product' ";
  echo Product::createTableIfNotExist() ? "success\n" : "fail\n";
  }
  