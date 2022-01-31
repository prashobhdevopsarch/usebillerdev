<?php include("includes/config.php");
$productcode=$_POST["productcode"];


$slct=$conn->query("SELECT * FROM us_products WHERE pr_productcode='$productcode' AND pr_isactive ='0' ");
	if($slct->num_rows>0)
	{
		echo "failed";
	}else
	{
		echo "success";
}
