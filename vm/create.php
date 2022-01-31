<?php session_start();
include("includes/config.php");?>
<html>
<title></title>
<head> 
<style>
body {
    display: block;
    margin: 0px;
	text-align:center;
}
table td
{
	height: 28mm;
    width: auto;
	font-size:8px;
	padding:4mm;
	border:1mm solid #fff;
}
@page
   {
    size: 79mm 112mm;
   margin: 0;
  }
@media print{
	@page
   {
    size: 80mm 112mm;
   margin: 0;
  }
	body {
		
    margin: 0;
}
.printButtonClass{display:none;}
table{width:100%;
    border-collapse: collapse;
}
table td
{
	height: 27.75mm;
    width: auto;
	font-size:8px;
	padding:4mm;
	border:1mm solid #fff;}
	
}
</style></head>
<body onLoad="window.print()">
<?php if(isset($_GET["back"])){?><a href="<?= $_GET["back"]?>"><button style="float:left;" class="printButtonClass">back</button></a><?php }else{?><a href="barcodemenu.php"><button style="float:left;" class="printButtonClass">back</button></a><?php }?>
<?php 

$profl = $conn->query("SELECT * FROM us_shopprofile WHERE sp_shopid='".$_SESSION['admin']."'");
$row3 = $profl->fetch_assoc();
$datatoencode=$row3['sp_barcode'];

?>
<?php if(isset($_POST['productid']))
{

$k=1;
?>
<table style="table-layout: fixed;">
<?php
if(isset($_POST["selectall"]))
{
	$slct_pr=$conn->query("SELECT * FROM us_products WHERE pr_isactive='0'");
	while($rpw_pr=$slct_pr->fetch_assoc()){
	?>
	<td style="text-align:center;"><b>ITEM :<?php echo $rpw_pr['pr_productname']?></b><br><b>CODE :<?php echo $rpw_pr['pr_productcode']?></b><br><b>PRICE :<?php echo $rpw_pr['pr_saleprice']?></b><br><img width="50%" src="barcode.php?text=<?= $rpw_pr['pr_productcode'] ?>" alt="testing" /></td>
		
	<?php
	if($k%2==0){echo "<tr>";} $k++;}
	
}else{
	$productid=$_POST['productid'];
		foreach($productid as $pid)
	{
		
	$slct_pr=$conn->query("SELECT * FROM us_products WHERE pr_productid='$pid'");
	$rpw_pr=$slct_pr->fetch_assoc();
	for($c=1;$c<=$_POST["cunt".$pid];$c++)
	{
	?>
	<td style="text-align:center;"><b style="font-size: 10px;"><?php echo $row3['sp_shopname']?></b><br><b>ITEM :<?php echo $rpw_pr['pr_productname']?></b><br><b  style="font-size: 10px;">PRICE :<?php echo $rpw_pr['pr_saleprice']?></b><br><img width="100%" src="barcode.php?text=<?= $rpw_pr['pr_productcode'] ?>" alt="testing" /><br><b>CODE :<?php echo $rpw_pr['pr_productcode']?></b></td>
		
	<?php if($k%2==0){echo "<tr>";} $k++; }
	}
}
?>
</table>
<?php }
?>
</body>
</html>