<?php
  // 1. Create a database connection
  Define("DB_SERVER","localhost");
  Define("DB_USER","root");
  Define("DB_PASS","");
  Define("DB_NAME","afa");

  $connection = @mysql_connect(DB_SERVER, DB_USER, DB_PASS);
  mysql_select_db(DB_NAME);
  
?>
