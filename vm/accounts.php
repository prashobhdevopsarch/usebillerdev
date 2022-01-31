<?php
include("includes/connection.php");

$hour = time() + 86400;

$shop="hotel";


/*$slct=$conn->query("SELECT * FROM gq_branch_category WHERE bc_acnttablename='$shop'");
$row=$slct->fetch_assoc();*/

//$_SESSION["id"]=$shop[1];
$_SESSION["category"]="1";

$id="1";



	
	setcookie(username, $shop, $hour);
	$_SESSION["name"]=$shop;

//$sname=$row["sh_shopname"];
header("location: accounting/index.php");

?>