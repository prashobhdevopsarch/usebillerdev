<?php
include("includes/connection.php");
$q=$_GET["q"];
if(isset($_GET["p"]))
	{
	$cmp=$conn->query("SELECT * FROM administrator_account_name WHERE acc_name='$q'");
	if($cmp->num_rows > 0)
	{
		$row=$cmp->fetch_assoc();
		if($row["refid"]==$_GET["p"])
		{echo 0;}
		else{
		echo 1;
		}
	}

}else{
	$cmp=$conn->query("SELECT * FROM administrator_account_name WHERE acc_name='$q'");
	if($cmp->num_rows > 0)
	{
	echo 1;
	}
	}

?>