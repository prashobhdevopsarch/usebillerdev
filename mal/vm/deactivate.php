<?php
session_start();
include("includes/config.php");
if(isset($_POST["shopid"]))
{
$shopid=$_POST["shopid"];
$update=$conn->query("UPDATE vm_shopprofile SET sp_isactive='1' WHERE sp_shopid='$shopid'");	
if($update)
{
	unset($_SESSION['admin']);
	unset($_SESSION['user']);
	unset($_SESSION['name']);
	echo "success";
}else
{
	echo "failed";
}
}
?>