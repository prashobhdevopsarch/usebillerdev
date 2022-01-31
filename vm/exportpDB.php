<?php

session_start();
// Database Connection
include("includes/config.php");
//ini_set('max_execution_time', 6000); 

	
// Fetch Record from Database

$output			= "";
//$table 			= $_GET["us_billentry"]; // Enter Your Table Name
//$sql 			= mysql_query("select * from $table");
$fil = $_GET['fil'];

if($fil == 'all')
{
	$bil = $conn->query("SELECT * FROM us_purentry WHERE user_id='".$_SESSION["admin"]."' and finyear = '".$_SESSION["finyearid"]."' AND pe_isactive='0' ORDER BY pe_billid DESC");
	echo "";
}
else{
	$filarr = explode('$', $fil);
	$fromdate = $filarr[0];
	$todate = $filarr[1];
	
	$bil = $conn->query("SELECT * FROM us_purentry WHERE DATE(pe_billdate)>='$fromdate' AND DATE(pe_billdate) <= '$todate' AND pe_isactive='0' AND user_id='".$_SESSION["admin"]."' and finyear = '".$_SESSION["finyearid"]."' ORDER BY pe_billid DESC");
	echo "From Date: ".date('d-M-Y', strtotime($fromdate))." To Date: ".date('d-M-Y', strtotime($todate))."";
}
         
//$columns_total 	= mysql_num_fields($sql);
$output .=',,,,PURCHASE REPORT,,,,';
$output .="\n";
$output .='No.,Bill No.,Bill Date';
$taxper=array();
$vat=$conn->query("SELECT ca_vat FROM  us_catogory");
               while($row17=$vat->fetch_assoc())
			   {
				$taxper[]= $row17['ca_vat'];
				$output.=",".$row17['ca_vat']."%";
			   }



$output.=',TOTAL AMOUNT';
$output .="\n";

  $total =0;
 $totalamount=0;
 $tax=0;

 $index=$conn->query("SELECT COUNT(ca_vat) AS cnt FROM  us_catogory");
 $rowindex=$index->fetch_assoc();
 $r=$rowindex["cnt"];
  $totaltax=array();
 for($p=0;$p<$r;$p++)
 {
	 $totaltax[$p]='0';
 }
 
 
 $today = date('Y-m-d');
 if($bil->num_rows>0)
	{
		$k = 1; $tax=0;
		while($row = $bil->fetch_assoc())
		{
		
		
		
		$output .=$k.','.$row['pe_billnumber'].','.date('d-M-Y H:i', strtotime($row['pe_billdate']));
													$billid = $row['pe_billid'];
													$itms = $conn->query("SELECT SUM(pi_total) AS Netamt,SUM(pi_cgstamt) AS cgst,SUM(pi_sgstamt) AS sgst,SUM(pi_igstamt) AS igst,pi_productid FROM us_puritems WHERE pi_billid='$billid'");
													//$n1=0;$n2=0;$n3=0;$n4=0;$n5=0;$n6=0;$n7=0;
													$n1=0;
													$n7=0;
													if($row2 = $itms->fetch_assoc())
												//$n1=round_up($row2['Netamt'],2);
												$n7=round_up($row2['Netamt'],2);
														// $total =$total+$n1;
														 $totalamount=$totalamount+$n7;
														//$output.= $n1;
												// $taxpers=array();
												 
												 
												  
												$vat=$conn->query("SELECT ca_vat FROM  us_catogory");
												$j=0;
												 while($row17=$vat->fetch_assoc())
												 {
												 $taxpers= $row17['ca_vat']/2;
												  $taxpers1= $row17['ca_vat'];
												
		$profl1 = $conn->query("SELECT SUM(pi_sgstamt) AS tax0 FROM us_puritems WHERE pi_billid='$billid' AND pi_sgst='$taxpers'");
        $row9 = $profl1->fetch_assoc();
		$n2=round_up($row9['tax0']*2,2);
		if($n2==0){
			$profl1 = $conn->query("SELECT SUM(pi_igstamt) AS tax0 FROM us_puritems WHERE pi_billid='$billid' AND pi_igst='$taxpers1'");
        $row9 = $profl1->fetch_assoc();
		$n2=round_up($row9['tax0'],2);
		}
		
		$tax=$tax+$n2;
		
		// echo $n2."<br>";
		 
												 
												 
												$totaltax[$j]=$totaltax[$j]+$n2;
												 $output.=",".$n2;
												$j++;
												}
		
		
												$output.=",".$n7;
													$k++;
													$output .="\n";
													
												   }
												   
												   
												   $output.= ',,TOTAL';
												  foreach($totaltax as $totaltax1)
												   {
													$output.=",".$totaltax1; 
												   }
												   $output.=",".$totalamount;
												    
												  
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

$filename = "billerp".date('d-m-Y H:i:s').".csv";
header('Content-type: application/csv');
header('Content-Disposition: attachment; filename='.$filename);
echo $output;
//echo "<br>".print_r($totaltax);


exit;

?>
