<?php
include("includes/config.php");
$key = $_POST['key'];
$admin = $_POST['shid'];



	$search = $conn->query("select * from us_elec where el_name = '".$key."' AND user_id = '$admin'");

if($row = $search->fetch_assoc())
{
	
	
	
	/*$type = $row['pr_type'];
	  
     $sql1="SELECT * FROM us_catogory WHERE ca_categoryid='$type'" ;
      $sql= $conn->query("$sql1");
                                        
	$rowcat=$sql->fetch_assoc();
	$vt = $rowcat['ca_vat'];*/
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
	$array[]=$row['el_id'];
	//$array[]=$row['rs_company_name'];
	$array[]=$row['el_name'];
    $array[]=$row['el_balance'];
	$array[]=$row['el_statecode'];
	
	//$array[]=$row['pr_saleprice'];
	//$array[]=$row['pr_stock'];
   
	//$array[]=$vt;
	//$array[]=$row['pr_unit'];
	 //$array[]=$number;
	
	echo json_encode($array);
	//echo $array[2];
}
?>