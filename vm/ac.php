<?php
ob_start();
session_start();
include_once "lib.dbconnect.php";
include_once "lib.actualGroupHeadConfig.php";
//header('Content-type: text/xml');
//mysql_select_db($_COOKIE['username']);

$writeContent = "<accounts>";

//Query all accounts except the STOCK(grouphead) accounts.
$query = "select refid,acc_name, acc_head, group_head, other_details from administrator_account_name where act_group_head <> 'STOCK'";
if ($group_id != ""){
	$query .= " where group_head='".$group_id."'";
}
$result = mysql_query($query);
if (mysql_num_rows($result) > 0) {
	while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
		$writeContent .= "<account>";
		$writeContent .= "<id>".$row[0]."</id> \n";
		$writeContent .= "<accountname>".$row[1]."</accountname> \n";
		$writeContent .= "<accounthead>".$row[2]."</accounthead> \n";
		$writeContent .= "<grouphead>".$row[3]."</grouphead> \n";
		$writeContent .= "<otherdetails>".$row[4]."</otherdetails> \n";
		$writeContent .= "</account> \n";
	}
}
$writeContent .= "</accounts>";
echo $writeContent;
exit;	
?>