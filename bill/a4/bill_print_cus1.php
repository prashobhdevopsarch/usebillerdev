<html>
<title></title>
<head> 
<link rel="stylesheet" type="text/css" media="print" href="custom/css/print.css" />
<style>
table {
    border-collapse: collapse;
}
table td
{
	height:15px;
}
@media print{
.printButtonClass{display:none;}
.s2{font-size:13px;}
	.s3{font-size:15px;}
	.s4{font-size:12px;}
	.s5{font-size:11px;}
	.s6{font-size:10px;}
	.s7{font-size:8px;}
}
</style></head>
<body onLoad="window.print()">
<?php if(isset($_GET["back"])){?><a href="<?= $_GET["back"]?>"><button style="float:left;" class="printButtonClass">back</button></a><?php }else{?><a href="dashboard.php"><button style="float:left;" class="printButtonClass">back</button></a><?php }?>
<?php 
include("includes/config.php");
if(isset($_GET["billid"]))
{
	$billid=$_GET["billid"];
	$slct=$conn->query("SELECT * FROM vm_billentry WHERE be_billid='$billid'");
	$row=$slct->fetch_assoc();
}
$profl = $conn->query("SELECT * FROM vm_shopprofile");
$row3 = $profl->fetch_assoc()
?>
<!--<table style="float:left;text-align:left;" width="200" border="0">
  <tr>
    <th>TIN No.</th>
    <td><?=$row3["sp_tin"]?></td>
  </tr>
  
</table>-->
<table style="float:right;text-align:left;" width="200" border="0">
  <tr>
    <th><span class="s5">Date : <?=date('d-m-Y', strtotime($row["be_billdate"]))?></th>
    
  </tr>
  <tr>
    <th><span class="s5">Bill NO :<?=$row["be_billnumber"]?></th>
   
  </tr>
</table>

<!--<table style="text-align:left;" width="100%" border="0">
<col width="30%">
<col width="40%">
<col width="30%">
  <tr>
    <th><?= $row3['sp_shopname'] ?></th>
    <td>&nbsp;</td>
    <td><?=$row["be_customername"]?></td>
  </tr>
  <tr>
    <td><?= $row3['sp_shopaddress'] ?><br/> Ph: <?= $row3['sp_phone'] ?>, Mob: <?= $row3['sp_mobile'] ?><br/> Email:<?= $row3['sp_email'] ?></td>
    <td>&nbsp;</td>
    <td><?=$row["be_customermobile"]?></td>
  </tr>
</table>-->
<table style="text-align:left;" width="100%" border="0">
<col width="40%">
<col width="20%">
<col width="40%">
<tr>
	<td></td>
	<th>ESTIMATION</th>
	<td></td>
	
</tr>
<?php if($_GET['csid']!=0)
{
	$slctcust=$conn->query("SELECT * FROM vm_customer WHERE cs_customerid='".$_GET['csid']."'");
	$rowcus=$slctcust->fetch_assoc();
	?>
  <tr>
    <th><b><?=$rowcus["cs_customername"]?></b></th><td></td><td></td>
  </tr>
  
  <tr>
    <td><span class="s5"><?= $rowcus['cs_address'] ?><br/> <span class="s5">Ph: <?= $rowcus['cs_customerphone'] ?></td><td></td><td></td>
  </tr>
  <?php }else{?>
  <tr>
    <th><b><span class="s5"><?=$row["be_customername"]?></b></th><td></td><td></td>
  </tr>
  <tr>
    <th><span class="s5"><?=$row["be_customermobile"]?></th><td></td><td></td>
  </tr>
  
  <?php }?>
</table>



<table border="1" width="100%">
<tr>
<th width="50px" style bgcolor="#999999"><span class="s4"> SI No</th>
<!--<th width="100px" style bgcolor="#999999"> ITEM CODE</th>-->

<th  bgcolor="#999999"><span class="s4">ITEMS</th>
<!--<th  width="100px" bgcolor="#999999"><span class="s4">UNIT</th>-->
<th  width="10%" bgcolor="#999999"><span class="s4">RATE</th>

<th   width="15%" bgcolor="#999999"><span class="s4">QTY</th>

<th   width="15%" bgcolor="#999999"><span class="s4">AMOUNT</th>
</tr>
<?php
$i=1;

$slctitm=$conn->query("SELECT * FROM vm_billitems a LEFT JOIN vm_products b ON b.pr_productid=a.bi_productid WHERE a.bi_billid='$billid'");
while($rowitm=$slctitm->fetch_assoc())
{
?>
<tr>
<td align="center"><span class="s5"><?=$i?></td>
<!--<td>
<?php

	echo $rowitm["pr_productcode"];
?>
</td>-->

<td><span class="s5">
<?php

	echo $rowitm["pr_productname"];
?>
</td>
<!--<td align="center">
<?php

	echo $rowitm["pr_unit"];
?>
</td>-->
<td align="center"><span class="s5"><?=$rowitm["bi_price"]?></td>

<td align="center"><span class="s5"><?=$rowitm["bi_quantity"]?></td>

<td align="center"><span class="s5"><?=$rowitm["bi_total"]?></td>

</tr>
<?php $i++;}?>
 <tr>
 <td colspan="4" align="right"><span class="s4">TOTAL</td>
 <td align="center"><span class="s4"><?=$row["be_total"]?></td>

 
 </tr>
 <tr>
 
 <td colspan="4" align="right"><span class="s4">DISCOUNT</td>
 <td align="center"><span class="s4"><?=$row["be_discount"]?></td>
</tr>
<!--<tr>
 
 <td colspan="6" align="right"><span class="s4">FREIGHT</td>
 <td align="center"><?=$row["be_coolie"]?></td>
</tr>
<tr>
 
 <td colspan="6" align="right"><span class="s4">OB</td>
 <td align="center"><?=$row["be_oldbal"]?></td>
</tr>-->
<tr>
 
 <td colspan="4" align="right">GRAND TOTAL</td>
 <td align="center"><?=$row["be_gtotal"]?></td>
</tr>
 <!--<tr>
 
 <td colspan="6" align="right"><span class="s4">PAID AMOUNT</td>
 <td align="center"><?=$row["be_paidamount"]?></td>
</tr>
<tr>
 
 <td colspan="6" align="right"><span class="s4">BALANCE</td>
 <td align="center"><?=$row["be_balance"]?></td>
</tr>-->
 
</table>

<br>
<table width="100%" style="font-size: 12px;">
<tr>
<td><span class="s5">E & OE</td><td style="text-align:right"></td>
</tr>
</table>
<!--<table width="100%">
<tr>
<td bgcolor="#999999" align="center"><?= $row3['sp_shopname'] ?>, <?= $row3['sp_shopaddress'] ?>, Ph:<?= $row3['sp_phone'] ?>, Mob:<?= $row3['sp_mobile'] ?>, EMAIL:<?= $row3['sp_email'] ?></td>
</tr>
</table>-->

<script>

</script>
</body>
</html>