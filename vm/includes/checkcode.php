<?php include("includes/config.php");
$productcode=$_POST["productcode"];
$userid=$_POST[""];

$slct=$conn->query("SELECT * FROM us_products WHERE userid='$userid' AND pr_productcode='$productcode' ");
	if($slct->num_rows>0)
	{
		echo "failed";
	}else
	{
		echo "success";
}
