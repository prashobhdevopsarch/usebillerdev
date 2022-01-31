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
<a href="dashboard.php"><button style="float:left;" class="printButtonClass">back</button></a>
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
<table style="float:left;text-align:left;" width="200" border="0">
  <tr>
    <th>TIN No.</th>
    <td><?=$row3["sp_tin"]?></td>
  </tr>
  
</table>
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

<table style="text-align:center;" width="100%" border="0">

  <tr>
    <th><?= $row3['sp_shopname'] ?></th>
    
  </tr>
  <tr>
    <th><b></b></th>
    
  </tr>
  <tr>
    <td><?= $row3['sp_shopaddress'] ?><br/> Ph: <?= $row3['sp_phone'] ?>, Mob: <?= $row3['sp_mobile'] ?><br/> Email:<?= $row3['sp_email'] ?></td>
    <td>&nbsp;</td>
    <td><?=$row["be_customermobile"]?></td>
  </tr>
</table>
<table width="100%">
<tr>
<td align="center">The Kerala value added Tax Rules 2005 form No.8[See Rule 58(10)]<br><b>TAX INVOICE &nbsp; CASH/CREDIT</b></td>
</tr>
</table>
<table style="text-align:center;" width="100%" border="1">

  <tr>
    <td>Invoice No. & Date</td>
    <td>Delivery Note No. & Date</td>
	<td>Purchase Order No. Date</td>
	<td>Despatch Document No. & Date if any</td>
	<td>Terms of Delivery if any</td>
  </tr>
  <tr>
    <td rowspan="2">&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
  </tr>
  <tr>
  <td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
  </tr>
  
</table>
<table width="100%">
<tr>
<tr><td>Name & Address of Purchasing daler: </td><td><?=$row["be_customername"]?></td></tr>

<tr><td>TIN/PIN:</td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td>Mobile</td><td><?=$row["be_customermobile"]?></td><td></td><td></td></tr>
</tr>
</table>
<table border="1" width="100%">
<tr>
<th width="50px" style bgcolor="#999999"> SI No</th>

<th  bgcolor="#999999">ITEM NAME</th>
<th  width="10%" bgcolor="#999999">UNIT PRICE</th>
<th   width="15%" bgcolor="#999999">VAT %</th>
<th   width="15%" bgcolor="#999999">TOTAL QTY</th>
<th   width="15%" bgcolor="#999999">NET AMNT</th>
<th   width="15%" bgcolor="#999999">VAT AMNT</th>
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

	echo $rowitm["pr_productname"];
?>
</td>
<td align="center"><?=$rowitm["bi_price"]?></td>
<td align="center"><?=$rowitm["bi_vatper"]?></td>
<td align="center"><?=$rowitm["bi_quantity"]?></td>
<td align="center"><?=$rowitm["bi_quantity"]*$rowitm["bi_price"]?></td>
<td align="center"><?=$rowitm["bi_vatamount"]?></td>
<td align="center"><?=$rowitm["bi_total"]?></td>

</tr>
<?php $i++;}?>
 <tr>
 <td colspan="7" align="right">GRAND TOTAL </td>
 <td align="center"><?=$row["be_total"]?></td>

 
 </tr>
 <tr>
 
 <td colspan="7" align="right">DISCOUNT</td>
 <td align="center"><?=$row["be_discount"]?></td>
</tr>
<tr>
 
 <td colspan="7" align="right">OB</td>
 <td align="center"><?=$row["be_oldbal"]?></td>
</tr>
 <tr>
 
 <td colspan="7" align="right">PAID AMOUNT</td>
 <td align="center"><?=$row["be_paidamount"]?></td>
</tr>

<tr>
 
 <td colspan="7" align="right">BALANCE</td>
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
<table width="100%" >
<tr><td align="center">
<b>DECLARATION:</b>(To be furnished by the seller) Certified that all the particulars shown in the adove Tax<br>
invoice are true and correct and that my/our Registration under KVAT Act 2003 is valid as on the date of this Bill
</td></tr>
</table>
<script>

</script>
</body>
</html>