 <?php
session_start();

// Database Connection

include("includes/config.php"); 

// Fetch Record from Database

$output	 = "";

//$table 	 = $_GET["us_ser"]; // Enter Your Table Name

//$sql 	 = mysql_query("select * from $table";

$fil = $_GET['fil'];

if($fil == 'all')

{
$sql = $conn->query("SELECT * FROM us_ser WHERE user_id='".$_SESSION["admin"]."' and finyear = '".$_SESSION["finyearid"]."' AND se_isactive='0' AND se_mod='1' ORDER BY se_billid DESC");

	echo "service BILL DETAILS";

}

else{

	$filarr = explode('$', $fil);

	$fromdate = $filarr[0];

	$todate = $filarr[1];

	$sql = $conn->query("SELECT * FROM us_ser WHERE DATE(se_billdate)>='$fromdate' AND DATE(se_billdate) <= '$todate' AND se_isactive='0' AND se_mod='1' AND user_id='".$_SESSION["admin"]."' and finyear = '".$_SESSION["finyearid"]."' ORDER BY se_billid DESC");

	echo "<h4>From Date: ".date('d-M-Y', strtotime($fromdate))." &nbsp; &nbsp; To Date: ".date('d-M-Y', strtotime($todate))."</h4>";

}



//$columns_total 	= mysql_num_fields($sql);

$output .=',Billing History,';

$output .="\n";

$output .='No.,Bill No.,Bill Date,Items,complaint,cost,';

$output .="\n";





 $totalamount=0;

 $today = date('Y-m-d');

 if($sql->num_rows>0)

{

$k = 1;

while($row = $sql->fetch_assoc())

{





$output .=$k.','.$row['se_billnumber'].','.date('d-M-Y H:i', strtotime($row['se_billdate'])).','.$row['se_statecode'].',';

$billid = $row['se_billid'];





 $itmss = $conn->query("SELECT * FROM us_seritem LEFT JOIN  us_products  ON se_productid= pr_productid WHERE se_billid='$billid' LIMIT 1");

 $row3 = $itmss->fetch_assoc();

$output.=$row3['se_item'].",".$row3['se_com'].",".$row3['se_price1'];

$k++;

$output .="\n";

$i=1;

$itmss = $conn->query("SELECT * FROM us_seritem LEFT JOIN  us_products  ON se_productid= pr_productid WHERE se_billid='$billid' LIMIT 1000 OFFSET 1");

   while($row3 = $itmss->fetch_assoc())

   {

   $output .=" , , , ,".$row3['se_item'].",".$row3['se_com']." ,".$row3['se_price1']." ,, , , ";

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



$filename = "Service bill report".date('d-m-Y H:i').".csv";

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

