<?php
session_start();
include("includes/config.php");

$customerid = $_GET['csid'];
$fil = $_GET['fil'];
if($fil=='all'){


	$chkstno=$conn->query("SELECT be_billdate FROM us_billentry WHERE be_customerid='$customerid' ORDER BY be_billid DESC LIMIT 1 ");
    $chkstno1=$conn->query("SELECT be_billdate FROM us_billentry WHERE be_customerid='$customerid' ORDER BY be_billid asc LIMIT 1 ");


 	if($row=$chkstno->fetch_assoc() && $row1=$chkstno1->fetch_assoc()){
 		$stno = $row['st_no']+1;

 		$fromdate=$row1['be_billdate'];
        $todate=$row['be_billdate'];
 		$inst = $conn->query("insert into us_statements(fromdate,todate,customerid,st_no)values('$fromdate','$todate','$customerid','$stno')");
}
else{
	header("Location:view.php?csid=".$customerid);


}

}


	else{
	$filarr = explode('$', $fil);
	$fromdate = date('Y-m-d', strtotime($filarr[0]));
	$todate = date('Y-m-d', strtotime($filarr[1]));

	$chkstno=$conn->query("SELECT * FROM us_statements WHERE fromdate='$fromdate' AND todate='$todate' AND customerid='$customerid'  ");
	
	if($chkstno->num_rows>0)
	
	{
		$row=$chkstno->fetch_assoc();

     $stno = $row['st_no'];

 }
 else{

 	$chkstno=$conn->query("SELECT * FROM us_statements WHERE customerid='$customerid' ORDER BY st_no DESC LIMIT 1 ");


 	if($row=$chkstno->fetch_assoc()){
 		$stno = $row['st_no']+1;

 	}else{

 		$stno =1;
 	}
	
	

	$inst = $conn->query("insert into us_statements(fromdate,todate,customerid,st_no)values('$fromdate','$todate','$customerid','$stno')");


}

}
	header("Location:custexport_printreal.php?fil=$fil&csid=".$customerid."&stno=".$stno);




?>