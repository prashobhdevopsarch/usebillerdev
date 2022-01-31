 <?php



session_start();

// Database Connection

include("includes/config.php"); 





// Fetch Record from Database



$output	 = "";

//$table 	 = $_GET["us_billentry"]; // Enter Your Table Name

//$sql 	 = mysql_query("select * from $table";



$fil = $_GET['fil'];

if($fil == 'all')

{

	$sql = $conn->query("SELECT * FROM us_purentry WHERE user_id='".$_SESSION["admin"]."' and finyear = '".$_SESSION["finyearid"]."' AND pe_isactive='0' and pe_balance='0' ORDER BY pe_billid DESC");

	echo "<h4>ALL BILL DETAILS</h4>";

}

else{

	$filarr = explode('$', $fil);

	$fromdate = $filarr[0];

	$todate = $filarr[1];

	

	$sql = $conn->query("SELECT * FROM us_purentry WHERE DATE(pe_billdate)>='$fromdate' AND DATE(pe_billdate) <= '$todate' AND pe_isactive='0' and pe_balance='0' AND user_id='".$_SESSION["admin"]."' and finyear = '".$_SESSION["finyearid"]."' ORDER BY pe_billid DESC");

	echo "<h4>From Date: ".date('d-M-Y', strtotime($fromdate))." &nbsp; &nbsp; To Date: ".date('d-M-Y', strtotime($todate))."</h4>";

}



//$columns_total 	= mysql_num_fields($sql);

$output .=',Billing History,';

$output .="\n";

$output .='No.,Bill No.,Bill Date,State Code,Items,Quantity,Purchase Price,Total,Total Discount,Grand Total,';

$output .="\n";





 $totalamount=0;

 $today = date('Y-m-d');

 if($sql->num_rows>0)

{

$k = 1;

while($row = $sql->fetch_assoc())

{





$output .=$k.','.$row['pe_billnumber'].','.date('d-M-Y H:i', strtotime($row['pe_billdate'])).','.$row['pe_statecode'].',';

$billid = $row['pe_billid'];





 $itmss = $conn->query("SELECT * FROM us_puritems LEFT JOIN  us_products  ON pi_productid= pr_productid WHERE pi_billid='$billid' LIMIT 1");

 $row3 = $itmss->fetch_assoc();

$output.=$row3['pr_productname'].",".$row3['pi_quantity'].",".$row3['pr_saleprice'].",".$row3['pi_total'].",".$row['pe_discount'].",".$row['pe_gtotal'];

$k++;

$output .="\n";

$i=1;

$itmss = $conn->query("SELECT * FROM us_puritems LEFT JOIN  us_products  ON pi_productid= pr_productid WHERE pi_billid='$billid' LIMIT 1000 OFFSET 1");

   while($row3 = $itmss->fetch_assoc())

   {

   $output .=" , , , ,".$row3['pr_productname'].",".$row3['pi_quantity']." ,".$row3['pr_purchaseprice']." ,".$row3['pi_total']." , , , ";

   $output.="\n";

   $i++;}

   }

   

   

   }





// Get The Field Name



//for ($i = 0; $i < $columns_total; $i++) {

//$heading	=	mysql_field_name($sql, $i);

//$heading	=	mysql_field_name($sql, $i);

//$output	 .= '"'.$heading.'",';





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



$filename = "PurchaseReport".date('d-m-Y H:i').".csv";

header('Content-type: application/csv');

header('Content-Disposition: attachment; filename='.$filename);


/*$myfile = "Salesreport.csv";





header("Cache-Control: public");

header("Content-Description: File Transfer");

header("Content-Length: ". filesize("$myfile").";");

header("Content-Disposition: attachment; filename=$myfile");

header("Content-Type: application/octet-stream; "); 

header("Content-Transfer-Encoding: binary");*/



echo $output;







exit;



?>

