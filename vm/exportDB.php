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
	$bil = $conn->query("SELECT * FROM us_billentry WHERE user_id='".$_SESSION["admin"]."' AND be_isactive='0' ORDER BY be_billid DESC");
	echo "";
}
else{
	$filarr = explode('$', $fil);
	$fromdate = $filarr[0];
	$todate = $filarr[1];
	
	$bil = $conn->query("SELECT * FROM us_billentry WHERE DATE(be_billdate)>='$fromdate' AND DATE(be_billdate) <= '$todate' AND be_isactive='0' AND user_id='".$_SESSION["admin"]."' ORDER BY be_billid DESC");
	echo "From Date: ".date('d-M-Y', strtotime($fromdate))." To Date: ".date('d-M-Y', strtotime($todate))."";
}
         
//$columns_total 	= mysql_num_fields($sql);
$output .=',,,,SALES REPORT,,,,';
$output .="\n";
$output .='No.,Bill No.,Bill Date,GROSS AMT';
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
		
		
		
		$output .=$k.','.$row['be_billnumber'].','.date('d-M-Y H:i', strtotime($row['be_billdate'])).',';
													$billid = $row['be_billid'];
													$itms = $conn->query("SELECT SUM(bi_total) AS Netamt, SUM(bi_taxamount) AS gross ,SUM(bi_cgst_amt) AS cgst,SUM(bi_sgst_amt) AS sgst,SUM(bi_igst_amt) AS igst,bi_productid FROM us_billitems WHERE bi_billid='$billid'");
													//$n1=0;$n2=0;$n3=0;$n4=0;$n5=0;$n6=0;$n7=0;
													$n1=0;
													$n7=0;
													if($row2 = $itms->fetch_assoc())
													{
												$n1=round_up($row2['gross'],2);
												$n7=round_up($row2['Netamt'],2);
														 $total =$total+$n1;
														 $totalamount=$totalamount+$n7;
													$output.= $n1;
												// $taxpers=array();
												 
													}
												  
												$vat=$conn->query("SELECT ca_vat FROM  us_catogory");
												$j=0;
												 while($row17=$vat->fetch_assoc())
												 {
												 $taxpers= $row17['ca_vat']/2;
												 $taxpers1= $row17['ca_vat'];
												
		$profl1 = $conn->query("SELECT SUM(bi_sgst_amt) AS tax0 FROM us_billitems WHERE bi_billid='$billid' AND bi_sgst='$taxpers'");
		
        $row9 = $profl1->fetch_assoc();
		$n2=round_up($row9['tax0']*2,2);
		if($n2==0)
		{
		$profl1 = $conn->query("SELECT SUM(bi_igst_amt) AS tax0 FROM us_billitems WHERE bi_billid='$billid' AND bi_igst='$taxpers1'");
        $row9 = $profl1->fetch_assoc();
		$n2=round_up($row9['tax0'],2);
		}
		
		$tax=$tax+$n2;
		
		// echo $n2."<br>";
		 
												 
												 
												$totaltax[$j]=$totaltax[$j]+$n2;
												 $output.=",".$n2;
												$j++;
												}
		
		/*$profl6 = $conn->query("SELECT SUM(bi_sgst_amt) AS tax5 FROM us_billitems WHERE bi_billid='$billid' AND bi_sgst='2.5'");
        $row6 = $profl6->fetch_assoc();  
		
		$profl4 = $conn->query("SELECT SUM(bi_sgst_amt) AS tax12 FROM us_billitems WHERE bi_billid='$billid' AND bi_sgst='6'");
        $row7 = $profl4->fetch_assoc();
										  			
		$prof2 = $conn->query("SELECT SUM(bi_sgst_amt) AS tax18 FROM us_billitems WHERE bi_billid='$billid' AND bi_sgst='9'");
        $row4 = $prof2->fetch_assoc();
													
		$prof3 = $conn->query("SELECT SUM(bi_sgst_amt) AS tax28 FROM us_billitems WHERE bi_billid='$billid' AND bi_sgst='14'");
        $row5 = $prof3->fetch_assoc();*/
		
		//$profl = $conn->query("SELECT * FROM us_products WHERE 	pr_productid='".$row2["bi_productid"]."'");
       // $row3 = $profl->fetch_assoc();
														
														
														/*$n3=round_up($row6['tax0'],2);
														$n4=round_up($row7['tax0'],2);
														
														
										                $n5=round_up($row4['tax0'],2);
														/*$n6=round_up($row5['tax0'],2); */
														
														
													
													
													 //echo $n1.",".$n2.",".$n3.",".$n4.",".$n5.",".$n6;
												//$output.=$n1.",";
												//$output.=$n2.",";
												$output.=",".$n7;
													$k++;
													$output .="\n";
													
												   }
												   
												   
												   $output.= ',,TOTAL,'.$total;
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
