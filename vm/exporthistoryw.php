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

	$sql = $conn->query("SELECT * FROM us_billentry WHERE user_id='".$_SESSION["admin"]."' and finyear = '".$_SESSION["finyearid"]."' AND be_isactive='0' AND be_mod='2' ORDER BY be_billid DESC");

	echo "<h4>WHOLESALE BILL DETAILS</h4>";

}

else{

	$filarr = explode('$', $fil);

	$fromdate = $filarr[0];

	$todate = $filarr[1];

	

	$sql = $conn->query("SELECT * FROM us_billentry WHERE DATE(be_billdate)>='$fromdate' AND DATE(be_billdate) <= '$todate' AND be_isactive='0' AND be_mod='2' AND user_id='".$_SESSION["admin"]."' and finyear = '".$_SESSION["finyearid"]."' ORDER BY be_billid DESC");

	echo "<h4>From Date: ".date('d-M-Y', strtotime($fromdate))." &nbsp; &nbsp; To Date: ".date('d-M-Y', strtotime($todate))."</h4>";

}



//$columns_total 	= mysql_num_fields($sql);

$output .=',Billing History,';

$output .="\n";

$output .='No.,Bill No.,Bill Date,State Code,Items,Quantity,Unit Price,Total,Total Discount,Grand Total,';

$output .="\n";





 $totalamount=0;

 $today = date('Y-m-d');

 if($sql->num_rows>0)

{

$k = 1;

while($row = $sql->fetch_assoc())

{





$output .=$k.','.$row['be_billnumber'].','.date('d-M-Y H:i', strtotime($row['be_billdate'])).','.$row['be_statecode'].',';

$billid = $row['be_billid'];





 $itmss = $conn->query("SELECT * FROM us_billitems LEFT JOIN  us_products  ON bi_productid= pr_productid WHERE bi_billid='$billid' LIMIT 1");

 $row3 = $itmss->fetch_assoc();

$output.=$row3['pr_productname'].",".$row3['bi_quantity'].",".$row3['bi_price'].",".$row3['bi_total'].",".$row['be_discount'].",".$row['be_gtotal'];

$k++;

$output .="\n";

$i=1;

$itmss = $conn->query("SELECT * FROM us_billitems LEFT JOIN  us_products  ON bi_productid= pr_productid WHERE bi_billid='$billid' LIMIT 1000 OFFSET 1");

   while($row3 = $itmss->fetch_assoc())

   {

   $output .=" , , , ,".$row3['pr_productname'].",".$row3['bi_quantity']." ,".$row3['bi_price']." ,".$row3['bi_total']." , , , ";

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



$filename = "Salesreport".date('d-m-Y H:i').".csv";

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

