<?php
session_start();
include("includes/config.php");
	if(isset($_POST['submit']))
	{
		$name=$_POST['name'];
		$particulars=$_POST['particulars'];
		//$transactiontype=$_POST['type'];
		$transactiontype="expense";
		$date=$_POST['date'];
		$time=$_POST['time'];
		$note=$_POST['note'];
		$datetime=date("Y-m-d", strtotime($_POST["date"]))." ".date("H:i", strtotime($_POST["time"]));
		$datecc=date("Y-m-d", strtotime($_POST["date"]));
		$amount=$_POST['amount'];
		
 $slct_empnum=$conn->query("SELECT	tr_closingbalance FROM us_transaction ORDER BY tr_id DESC LIMIT 1");
if(mysqli_num_rows($slct_empnum)>0)
 {
$last=$slct_empnum->fetch_assoc();
$openingbalance = $last['tr_closingbalance'] ;
 }
 else{
 $openingbalance =0;
 }

	if($transactiontype=='expense')	
	{
		$closingbalance=$openingbalance-$amount;
	}
	elseif($transactiontype=='income')
	{
		$closingbalance=$openingbalance+$amount;
	}
	
	$insrtacnt=$conn->query("INSERT INTO administrator_daybook(ad_branchid, dayBookDate, debit, credit, dayBookContra, dayBookAmount, description) VALUES('".$_SESSION["admin"]."',NOW(),'$name','$particulars','Y','$amount','$note')");
				    $acntid2=$conn->insert_id;	
		
$insert=$conn->query("insert into us_transaction(tr_name,tr_particulars,tr_openingbalance,tr_transactionamount,tr_closingbalance,tr_date,tr_transactiontype,user_id, tr_mode, tr_accid)
values('$name','$particulars',' $openingbalance','$amount','$closingbalance','NOW()','$note','".$_SESSION["admin"]."', '1','$acntid2')");
$trid = $conn->insert_id;
if($insert)
	{
		if ($transactiontype=='expense')
		{
			header("location:expensevoucher.php?trid=$trid");
			}
	
	else if ($transactiontype=='income')
	{
			header("location:expensereciept.php?trid=$trid");
			}
			}
			
else{  
header("location:expense.php?er");
}


	}
	?>