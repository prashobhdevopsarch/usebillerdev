
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
<?php if(isset($_GET["back"])){?><a href="<?= $_GET["back"]?>"><button style="float:left;" class="printButtonClass">back</button></a><?php }else{?><a href="purchasereturn.php"><button style="float:left;" class="printButtonClass">back</button></a><?php }?>
<?php 
session_start();
include("includes/config.php");
//print_r($_SESSION);
if(isset($_GET["billid"]))
{
	$billid=$_GET["billid"];
	$slct=$conn->query("SELECT * FROM vm_purreturnentry WHERE pre_billid='$billid'");
	$row=$slct->fetch_assoc();
}
$profl = $conn->query("SELECT * FROM vm_shopprofile");
$row3 = $profl->fetch_assoc()
?>
<table style="float:left;text-align:left;" width="200" border="0">
  <tr>
    <th>GSTIN No :</th>
    <td><?=$row3["sp_tin"]?></td>
  </tr>
  
</table>
<table style="float:right;text-align:left;" width="200" border="0">
  <tr>
    <th>Date :</th>
    <td><?=date('d-m-Y H:i', strtotime($row["pre_billdate"]))?></td>
  </tr>
 <!-- <tr>
  <th>Ph: <?= $row3['sp_phone'] ?><br> Mob: <?= $row3['sp_mobile'] ?></th>
  </tr>  -->
  <tr>
    <th>Bill NO :</th>
    <td><?=$row["pre_billnumber"]?></td>
  </tr>
</table>

<table style="text-align:center;" width="100%" border="0">

  <tr>
    <th><h3><?= $row3['sp_shopname'] ?></h3></th>
  </tr>
  <tr>
    <td><?= $row3['sp_shopaddress'] ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr><td><tr><td>Ph: <?= $row3['sp_phone'] ?>, Mob: <?= $row3['sp_mobile'] ?></td></tr></td></tr>
 <!-- <tr>
    <th><b>DEALERS OF QUALITY HANDLOOM FANCY FABRICS</b></th>
    
  </tr> -->
  
  <tr><th>Purchase Return</th></tr>
  <tr><td>Return Bill No :<?=$row["pre_rebill"]?></td></tr>
</table>


<table style="text-align:left;float:left;" width="40%" border="0">
<?php $slctsup=$conn->query("SELECT * FROM vm_supplier WHERE rs_supplierid='".$row["pre_customerid"]."'");
$rowsup=$slctsup->fetch_assoc();?>
  <tr>
    <th><?= $rowsup['rs_company_name'] ?></th>
    <td>GSTIN No. :<?= $rowsup['rs_tinnum'] ?></td>
  </tr>
  <tr>
  <td> Name :<?= $rowsup['rs_name'] ?></td>
  <td>Address:<?= $rowsup['rs_address'] ?></td>
   </tr>
  <tr>
    <td>Ph: <?= $rowsup['rs_phone'] ?></td>
	 <td>Email:<?= $rowsup['rs_email'] ?></td>
   </tr>
   <tr>
   	<td>Invoice No. :<?=$row["pre_invoice_number"]?></td>
	<td>Date :<?=$row["pre_invoice_date"]?></td>
   </tr>
   <tr>
   	<td><td>Vehicle No. :<?=$row["pre_vehicle_number"]?></td></td>
   </tr>
</table>


<table border="1" width="100%">
<tr>
<th rowspan="2" width="50px" style bgcolor="#999999"> SI No</th>
<th rowspan="2" bgcolor="#999999">ITEM NAME</th>
<th rowspan="2" width="10%" bgcolor="#999999">UNIT PRICE</th>
<th rowspan="2"   width="15%" bgcolor="#999999">TOTAL QTY</th>
<th colspan="2"  width="15%" bgcolor="#999999">CGST</th>
<th  colspan="2" width="15%" bgcolor="#999999">SGST</th>
<th colspan="2"  width="15%" bgcolor="#999999">IGST</th>
<th rowspan="2"  width="15%" bgcolor="#999999"> TOTAL PRICE</th>
</tr>
<tr>
<th>Rate</th>
<th>Amt.</th>
<th>Rate</th>
<th>Amt.</th>
<th>Rate</th>
<th>Amt.</th>
</tr>
<?php
$i=1;

$slctitm=$conn->query("SELECT * FROM vm_purreturnitem a LEFT JOIN vm_products b ON b.pr_productid=a.pri_productid WHERE a.pri_billid='$billid'");
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

<td align="center"><?=$rowitm["pri_price"]?></td>
<td align="center"><?=$rowitm["pri_quantity"]?></td>
<!--<td align="center"><?=$rowitm["pri_quantity"]*$rowitm["pri_price"]?></td>
<td align="center"><?=$rowitm["pri_vatamount"]?></td>-->
<td><?=$rowitm["pri_cgst"]?></td>
<td><?=$rowitm["pr_cgstamt"]?></td>
<td><?=$rowitm["pri_sgst"]?></td>
<td><?=$rowitm["pri_sgstamt"]?></td>
<td><?=$rowitm["pri_igst"]?></td>
<td><?=$rowitm["pri_igstamt"]?></td>
<td align="center"><?=$rowitm["pri_total"]?></td>

</tr>

<?php $i++;}?>
 <tr>
 <td colspan="10" align="right">TOTAL </td>
 <td align="center"><?=$row["pre_total"]?></td>

 
 </tr>
 <tr>
 
 <td colspan="10" align="right">DISCOUNT</td>
 <td align="center"><?=$row["pre_discount"]?></td>
</tr>
<tr>
 
 <td colspan="10" align="right">COOLIE</td>
 <td align="center"><?=$row["pre_coolie"]?></td>
</tr>
<tr>
 <tr>
 
 <td colspan="10" align="right">GRAND TOTAL</td>
 <td align="center"><?php $total = $row["pre_total"]+$row["pre_coolie"]-$row["pre_discount"];echo $total;?></td>
</tr>

 
 <td colspan="11">Grand Total(in words) : <?php $amd=convert_number_to_words($total);echo $amd;?></td>
 
</tr>
 
</table>

<br>
<table width="100%" style="font-size: 12px;">
<tr>
<td>E & OE</td><td style="text-align:right">Authorised Signatory<br>(with Status & Seal)&nbsp;</td>
</tr>
</table>


<script>

</script>
</body>
</html>