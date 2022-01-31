<?php
include("includes/config.php");
$key = $_POST['key'];
//$number = $_POST['number'];



	$search = $conn->query("select * from us_customer where cs_customername = '".$key."'");

if($row = $search->fetch_assoc())
{
	
	
	
	/*$type = $row['pr_type'];
	  
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
	$array[]=$row['cs_customerid'];
	$array[]=$row['cs_customername'];
	$array[]=$row['cs_address'];
    $array[]=$row['cs_balance'];
	$array[]=$row['cs_tin_number'];
	$array[]=$row['cs_statecode'];
	//$array[]=$row['pr_stock'];
   
	//$array[]=$vt;
	//$array[]=$row['pr_unit'];
	// $array[]=$number;
	
	echo json_encode($array);
	//echo $array[2];
}
?>