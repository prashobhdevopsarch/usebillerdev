<?php
session_start();
// Database Connection
include("includes/config.php");

	
// Fetch Record from Database

$output			= "";
//$table 			= $_GET["vm_billentry"]; // Enter Your Table Name
//$sql 			= mysql_query("select * from $table");
$sql =$conn->query("SELECT * FROM vm_purentry WHERE pe_isactive='0' AND user_id='".$_SESSION["admin"]."' ORDER BY pe_billid DESC");
//$columns_total 	= mysql_num_fields($sql);
$output .=',,,,Purchase,,,Return,';
$output .="\n";
$output .='No.,Bill No.,Bill Date,CGST,SGST,IGST,CGST,SGST,IGST';
$output .="\n";


 $totalamount=0;
 $today = date('Y-m-d');
 if($sql->num_rows>0)
	{
		$k = 1;
		while($row = $sql->fetch_assoc())
		{
		
		
		$output .=$k.','.$row['pe_billnumber'].','.date('d-M-Y H:i', strtotime($row['pe_billdate'])).',';
													$billid = $row['pe_billid'];
													$itms = $conn->query("SELECT SUM(pi_cgstamt) AS cgst,SUM(pi_sgstamt) AS sgst,SUM(pi_igstamt) AS igst FROM vm_puritems WHERE pi_billid='$billid'");
													$n1=0;$n2=0;$n3=0;$n4=0;$n5=0;$n6=0;
													if($row2 = $itms->fetch_assoc())
													{
														$n1=round_up($row2['cgst'],2);
														$n2=round_up($row2['sgst'],2);
														$n3=round_up($row2['igst'],2);
														
														
													}
													$itms = $conn->query("SELECT SUM(pr_cgstamt) AS cgst,SUM(pri_sgstamt) AS sgst,SUM(pri_igstamt) AS igst FROM vm_purreturnitem WHERE pri_returnbillid='$billid'");
													if($row2 = $itms->fetch_assoc())
													{
														$n4=round_up($row2['cgst'],2);
														$n5=round_up($row2['sgst'],2);
														$n6=round_up($row2['igst'],2);
														
													}
													
													 
												$output.=$n1.",".$n2.",".$n3.",".$n4.",".$n5.",".$n6;
													$k++;
													$output .="\n";
												   }
												   
											   }
											 

// Get The Field Name

//for ($i = 0; $i < $columns_total; $i++) {
	//$heading	=	mysql_field_name($sql, $i);
	//$heading	=	mysql_field_name($sql, $i);
	//$output		.= '"'.$heading.'",';
	
	
//}


// Get Records from the table

//while ($row = mysql_fetch_array($sql)) {
//for ($i = 0; $i < $columns_total; $i++) {
//$output .='"'.$row["$i"].'"';
//if($i < $columns_total-1)
//{
	//$output .=',';
//}
//}
//$output .="\n";
//}

// Download the file

$filename = "biller".date('d-m-Y H:i:s').".csv";
header('Content-type: application/csv');
header('Content-Disposition: attachment; filename='.$filename);

echo $output;



exit;

?>
