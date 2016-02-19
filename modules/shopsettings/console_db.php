<?php
  //-- Shopsettings:Clear cache
  if ($command == "cc") {
    if ($arg1 == "all" || $arg1 == "shopsettings") {
      echo " - Drop table 'shopsettings' ";
      echo Shopsettings::dropTable() ? "success\n" : "fail\n";
    }
  }

  //-- Shopsettings:Import DB
  if ($command == "import" && $arg1 == "db" && (is_null($arg2) || $arg2 == "shopsettings") ) {
  //- create tables if not exits
  echo " - Create table 'shopsettings' ";
  echo Shopsettings::createTableIfNotExist() ? "success\n" : "fail\n";
  }
  