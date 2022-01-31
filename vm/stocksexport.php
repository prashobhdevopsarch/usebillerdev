 <?php

session_start();
// Database Connection
include("includes/config.php"); 


// Fetch Record from Database

$output	 = "";
//$table 	 = $_GET["us_billentry"]; // Enter Your Table Name
//$sql 	 = mysql_query("select * from $table";
if(isset($_POST['print_bar']))
{
	if (empty($_POST["product"]))
	{
	 $product='';	
	}else{
$product=$_POST['product'];
$product1 = implode(",", $product);


if($product!="")
   {


   $sql = $conn->query("SELECT * FROM us_products a left join us_catogory b on b.ca_categoryid = a.pr_type WHERE a.pr_isactive='0' AND a.user_id='".$_SESSION["admin"]."' AND a.pr_productid IN ($product1)ORDER BY a.pr_productid ASC");
  // echo "SELECT * FROM us_billentry WHERE be_isactive='0' AND user_id='".$_SESSION["admin"]."' AND be_billid IN ('$bill1')ORDER BY be_billid ASC";
   }
   else{
   	$sql = $conn->query("SELECT * FROM us_products a left join us_catogory b on b.ca_categoryid = a.pr_type WHERE a.pr_isactive='0' AND a.user_id='".$_SESSION["admin"]."' ORDER BY a.pr_productid ASC");

   }
   }
	}
   if (empty($_POST["product"]))
   
   {
   	$sql = $conn->query("SELECT * FROM us_products a left join us_catogory b on b.ca_categoryid = a.pr_type WHERE a.pr_isactive='0' AND a.user_id='".$_SESSION["admin"]."' ORDER BY a.pr_productid ASC");
}
//$columns_total 	= mysql_num_fields($sql);
$output .=',Stock Details,';
$output .="\n";
$output .='No.,Product Code,Product Name,HSN Code,Exp Date:,Tax,Unit,Purchase price,Sales price,Stock';
$output .="\n";


 $totalamount=0;
 $today = date('Y-m-d');
 
 if($sql->num_rows>0)
{
$k = 1;
while($row = $sql->fetch_assoc())
{


$output .=$k.','.$row['pr_productcode'].','.$row['pr_productname'].','.$row['pr_hsn'].','.$row['pr_rack'].','.$row['ca_categoryname'].','.$row['pr_unit'].','.$row['pr_purchaseprice'].','.$row['pr_saleprice'].','.$row['pr_stock'].',';
$productid = $row['pr_productid'];

$k++;
$output .="\n";

   
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

$filename = "StockReport".date('d-m-Y H:i').".csv";
header('Content-type: application/csv');
header('Content-Disposition: attachment; filename='.$filename);
echo $output;



exit;

?>