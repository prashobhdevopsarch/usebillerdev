<?php

session_start();
// Database Connection
include("includes/config.php"); 

	
// Fetch Record from Database

$output			= "";
//$table 			= $_GET["us_billentry"]; // Enter Your Table Name
//$sql 			= mysql_query("select * from $table");
if(isset($_POST['print_bar']))
{
	if (empty($_POST["bill"]))
	{
	 $bill='';	
	}else{
$bill=$_POST['bill'];
$bill1 = implode(",", $bill);
if($bill!="")
   {

$sql =$conn->query("SELECT * FROM us_billentry WHERE be_isactive='0' AND user_id='".$_SESSION["admin"]."'  AND be_billid IN ($bill1) ORDER BY be_billid ASC");
   }
   else{
   	$sql = $conn->query("SELECT * FROM us_billentry WHERE be_isactive='0' AND user_id='".$_SESSION["admin"]."' ORDER BY be_billid ASC");

   }
	}}
	if (empty($_POST["bill"]))
   
   {
   	$sql = $conn->query("SELECT * FROM us_billentry WHERE be_isactive='0' AND user_id='".$_SESSION["admin"]."' ORDER BY be_billid ASC");
}
//$columns_total 	= mysql_num_fields($sql);
$output .=',,,,Sales,,,Return,';
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
		
		
		$output .=$k.','.$row['be_billnumber'].','.date('d-M-Y H:i', strtotime($row['be_billdate'])).',';
													$billid = $row['be_billid'];
													$itms = $conn->query("SELECT SUM(bi_cgst_amt) AS cgst,SUM(bi_sgst_amt) AS sgst,SUM(bi_igst_amt) AS igst FROM us_billitems WHERE bi_billid='$billid'");
													$n1=0;$n2=0;$n3=0;$n4=0;$n5=0;$n6=0;
													if($row2 = $itms->fetch_assoc())
													{
														$n1=round_up($row2['cgst'],2);
														$n2=round_up($row2['sgst'],2);
														$n3=round_up($row2['igst'],2);
														
														
													}
													$itms = $conn->query("SELECT SUM(sri_cgstamt) AS cgst,SUM(sri_sgstamt) AS sgst,SUM(sri_igstamt) AS igst FROM us_salreturnitem WHERE sri_returnbillid='$billid'");
													$n=0;
													if($row2 = $itms->fetch_assoc())
													{
														$n4=round_up($row2['cgst'],2);
														$n5=round_up($row2['sgst'],2);
														$n6=round_up($row2['igst'],2);
														
													}
													
													 //echo $n1.",".$n2.",".$n3.",".$n4.",".$n5.",".$n6;
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

$filename = "billerp".date('d-m-Y H:i:s').".csv";
header('Content-type: application/csv');
header('Content-Disposition: attachment; filename='.$filename);
echo $output;



exit;

?>
