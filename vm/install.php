<?php
error_reporting(E_ERROR | E_PARSE);
ob_start();
#Default Username and password
$link = mysql_connect("localhost","root","");
if ($link)
{
	include_once "create-database.php";
	create_database();
} else {
	header("database-credentials.php");
}
ob_end_flush();
?>

