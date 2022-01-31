<?php
include("config.php");
$shid=$_POST['shid'];
$key = $_POST['key'];
$number = $_POST['number'];

$search1 = $conn->query("select COUNT(pr_productid) AS pr_cnt from us_products where pr_productname = '".$key."' AND user_id='$shid' AND pr_isactive='0'");
$row1 = $search1->fetch_assoc();
$cnt=$row1["pr_cnt"];
if($cnt!=0)
{

	$search = $conn->query("select * from us_products where pr_productname = '".$key."' AND user_id='$shid' AND pr_isactive='0'");

if($row = $search->fetch_assoc())	
{
	
	
	
	$type = $row['pr_type'];
	  
     $sql1="SELECT * FROM us_catogory WHERE ca_categoryid='$type'" ;
      $sql= $conn->query("$sql1");
                                        
	$rowcat=$sql->fetch_assoc();
	$vt = $rowcat['ca_vat'];
	/*if($cnter=='1')
	{
		$price=$row["bi_price_ac"];
		$price_peg=$row["bi_price_peg_ac"];
	}else
	{
		$price=$row["bi_price_nonac"];
		$price_peg=$row["bi_price_peg_nonac"];
	}*/
	
	
	
	
	$array=array();
	$array[]=$row['pr_productid'];
	$array[]=$row['pr_productcode'];
	$array[]=$row['pr_productname'];
    $array[]=$row['pr_purchaseprice'];
	$array[]=$row['pr_saleprice'];
	$array[]=$row['pr_stock'];
   
	$array[]=$vt;
	$array[]=$row['pr_unit'];
	 $array[]=$number;
	 
	 $array[]=$row['pr_retail'];
	 $array[]=$row['pr_wholesale'];
	 $array[]=$row['pr_hsn'];
    $array[]=$row['pr_cess'];
    $array[]=$row['pr_mrp1'];
    $array[]=$row['pr_rack'];
	$array[15]=1;
	echo json_encode($array);
	//echo $array[2];
}
}else{
	$array[15]=0;
	echo json_encode($array);
}
?>