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
    <th>Date</th>
    <td><?=date('d-m-Y H:i', strtotime($row["be_billdate"]))?></td>
  </tr>
  <tr>
    <th>Bill NO.</th>
    <td><?=$row["be_billnumber"]?></td>
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
<?php if($_GET['csid']!='0')
{
	$slctcust=$conn->query("SELECT * FROM vm_customer WHERE cs_customerid='".$_GET['csid']."'");
	$rowcus=$slctcust->fetch_assoc();
	?>
  <tr>
    <th><b><?=$rowcus["cs_customername"]?></b></th><td></td><td></td>
  </tr>
  
  <tr>
    <td><?= $rowcus['cs_address'] ?><br/> Ph: <?= $rowcus['cs_customerphone'] ?><br> Email:<?= $rowcus['cs_email'] ?></td><td></td><td></td>
  </tr>
  <?php }else{?>
  <tr>
    <th><b><?=$row["be_customername"]?></b></th><td></td><td></td>
  </tr>
  <tr>
    <th><?=$row["be_customermobile"]?></th><td></td><td></td>
  </tr>
  
  <?php }?>
</table>



<table border="1" width="100%">
<tr>
<th width="50px" style bgcolor="#999999"> SI No</th>
<th width="100px" style bgcolor="#999999"> ITEM CODE</th>

<th  bgcolor="#999999">ITEM NAME</th>
<th  width="100px" bgcolor="#999999">UNIT</th>
<th  width="10%" bgcolor="#999999">UNIT PRICE</th>

<th   width="15%" bgcolor="#999999">TOTAL QTY</th>

<th   width="15%" bgcolor="#999999"> TOTAL PRICE</th>
</tr>
<?php
$i=1;

$slctitm=$conn->query("SELECT * FROM vm_billitems a LEFT JOIN vm_products b ON b.pr_productid=a.bi_productid WHERE a.bi_billid='$billid'");
while($rowitm=$slctitm->fetch_assoc())
{
?>
<tr>
<td align="center"><?=$i?></td>
<td>
<?php

	echo $rowitm["pr_productcode"];
?>
</td>

<td>
<?php

	echo $rowitm["pr_productname"];
?>
</td>
<td align="center">
<?php

	echo $rowitm["pr_unit"];
?>
</td>
<td align="center"><?=$rowitm["pr_saleprice"]?></td>

<td align="center"><?=$rowitm["bi_quantity"]?></td>

<td align="center"><?=$rowitm["bi_total"]?></td>

</tr>
<?php $i++;}?>
 <tr>
 <td colspan="6" align="right">TOTAL</td>
 <td align="center"><?=$row["be_total"]?></td>

 
 </tr>
 <tr>
 
 <td colspan="6" align="right">DISCOUNT</td>
 <td align="center"><?=$row["be_discount"]?></td>
</tr>
<tr>
 
 <td colspan="6" align="right">COOLIE</td>
 <td align="center"><?=$row["be_coolie"]?></td>
</tr>
<tr>
 
 <td colspan="6" align="right">OB</td>
 <td align="center"><?=$row["be_oldbal"]?></td>
</tr>
<tr>
 
 <td colspan="6" align="right">GRAND TOTAL</td>
 <td align="center"><?=$row["be_gtotal"]?></td>
</tr>
 <tr>
 
 <td colspan="6" align="right">PAID AMOUNT</td>
 <td align="center"><?=$row["be_paidamount"]?></td>
</tr>
<tr>
 
 <td colspan="6" align="right">BALANCE</td>
 <td align="center"><?=$row["be_balance"]?></td>
</tr>
 
</table>

<br>
<table width="100%" style="font-size: 12px;">
<tr>
<td>E & OE</td><td style="text-align:right">Authorised Signatory<br>(with Status & Seal)&nbsp;</td>
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