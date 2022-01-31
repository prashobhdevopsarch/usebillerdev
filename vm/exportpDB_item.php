 <?php

session_start();
// Database Connection
include("includes/config.php"); 


// Fetch Record from Database

$output	 = "";
//$table 	 = $_GET["us_purentry"]; // Enter Your Table Name
//$sql 	 = mysql_query("select * from $table";
$fil = $_GET['fil'];

if($fil == 'all')
{
	$sql = $conn->query("SELECT * FROM us_purentry WHERE user_id='".$_SESSION["admin"]."' and finyear = '".$_SESSION["finyearid"]."' AND pe_isactive='0' ORDER BY pe_billid DESC");
	$title= "All";
}
else{
	$filarr = explode('$', $fil);
	$fromdate = $filarr[0];
	$todate = $filarr[1];
	
	$sql = $conn->query("SELECT * FROM us_purentry WHERE DATE(pe_billdate)>='$fromdate' AND DATE(pe_billdate) <= '$todate' AND pe_isactive='0' AND user_id='".$_SESSION["admin"]."' and finyear = '".$_SESSION["finyearid"]."' ORDER BY pe_billid DESC");
	$title= "From Date: ".date('d-M-Y', strtotime($fromdate))." To Date: ".date('d-M-Y', strtotime($todate))."";
}
//$columns_total 	= mysql_num_fields($sql);
$output .=',Billing History,';
$output .="\n";
$output .=$title;
$output .="\n";
$output .='No.,Bill No.,Party,GSTIN/UIN,Bill Date,State Code,Items,HSN,Quantity,Taxable Amount,Tax,Tax Amount,Total,Total Discount,Grand Total,';
$output .="\n";


 $totalamount=0;
 $today = date('Y-m-d');
 if($sql->num_rows>0)
{
$k = 1;
while($row = $sql->fetch_assoc())
{

if($row['pe_supplierid']!=0){
	$slctcus=$conn->query("SELECT * FROM us_supplier WHERE rs_supplierid='".$row['pe_supplierid']."'");
	$rowcus=$slctcus->fetch_assoc();
	$cus=$rowcus['rs_name'];$gstin=$rowcus['rs_tinnum'];
	}else{$cus=$row['pe_customername'];$gstin='';}


$output .=$k.','.$row['pe_billnumber'].','.$cus.','.$gstin.','.date('d-M-Y H:i', strtotime($row['pe_billdate'])).','.$row['pe_statecode'].',';
$billid = $row['pe_billid'];


 $itmss = $conn->query("SELECT * FROM us_puritems LEFT JOIN  us_products ON pr_productid=pi_productid WHERE pi_billid='$billid' LIMIT 1");
 $row3 = $itmss->fetch_assoc();
$output.=$row3['pr_productname'].",".$row3['pr_hsn'].",".$row3['pi_quantity'].",".($row3['pi_total']-$row3['pi_vatamount']).",".$row3['pi_vatper']."%,".$row3['pi_vatamount'].",".$row3['pi_total'].",".$row['pe_discount'].",".$row['pe_gtotal'];
$k++;
$output .="\n";
$i=1;
$itmss = $conn->query("SELECT * FROM us_puritems LEFT JOIN  us_products  ON pi_productid= pr_productid WHERE pi_billid='$billid' LIMIT 1000 OFFSET 1");
   while($row3 = $itmss->fetch_assoc())
   {
   $output .=", , , , , ,".$row3['pr_productname'].",".$row3['pr_hsn'].",".$row3['pi_quantity']." ,".($row3['pi_total']-$row3['pi_vatamount'])." ,".$row3['pi_vatper']."%,".$row3['pi_vatamount'].",".$row3['pi_total'].", , , ";
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

$filename = "billerp".date('d-m-Y H:i').".csv";
header('Content-type: application/csv');
header('Content-Disposition: attachment; filename='.$filename);
echo $output;



exit;

?>
