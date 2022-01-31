<?php
include("includes/connection.php");

if(isset($_POST["update"]))
{
$billid=$_POST["billid"];
$balance=$_POST["balance"];
$newpay=$_POST["newpay"];
$newbal=$_POST["newbal"];
$payamd=$_POST["payamd"];

$pay=$payamd+$newpay;

$back=$_POST["back"];
	
$updatebill=$conn->query("UPDATE rid_bill_entry SET be_paid_amount='$pay', be_balance='$newbal', be_updatedtime=NOW() WHERE be_id='$billid'");
if($updatebill)
{
	$payhistory=$conn->query("INSERT INTO rid_paylist(pi_billid, pi_date, pi_paidamount, pi_amount, pi_newbal) VALUES('$billid',NOW(),'$payamd','$newpay','$newbal')");
	if($payhistory)
	{
		header("location: newpaybill.php?billnum=".$billid."&newpay=".$newpay."&bal=".$balance."&nwbal=".$newbal."&back=".$back);
	}
}else{header("location: ".$back."?fail=update");}
	
}
?>