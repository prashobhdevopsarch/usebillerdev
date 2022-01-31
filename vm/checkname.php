<?php include("includes/config.php");
$productname=$_POST["productname"];


$slct=$conn->query("SELECT * FROM us_products WHERE pr_productname='$productname' AND pr_isactive ='0' ");
	if($slct->num_rows>0)
	{
		echo "failed";
	}else
	{
		echo "success";
}
