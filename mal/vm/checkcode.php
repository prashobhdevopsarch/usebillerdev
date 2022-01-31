<?php include("includes/config.php");
$productcode=$_POST["productcode"];

$slct=$conn->query("SELECT * FROM vm_products WHERE pr_productcode='$productcode' ");
	if($slct->num_rows>0)
	{
		echo "failed";
	}else
	{
		echo "success";
}
