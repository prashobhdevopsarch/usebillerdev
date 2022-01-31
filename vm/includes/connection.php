<?php
error_reporting(E_ERROR | E_PARSE);
$database_hostname = "localhost";
$database_username = "usebiller_user";
$database_password = "*usebiller123#";
$main_database = "fajar";

/*$database_username = "gayathriuser";
$database_password = "*gayathri123#";
$main_database = "gayathriholdings";*/

mysql_connect($database_hostname,$database_username,$database_password);
mysql_select_db("usebiller_dbm");
?>