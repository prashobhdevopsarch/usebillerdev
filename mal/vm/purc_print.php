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
<?php if(isset($_GET["back"])){if(isset($_GET["supid"])){$supid="?supid=".$_GET["supid"];}else{$supid='';}?>
<a href="<?=$_GET["back"]?><?=$supid?>"><button class="printButtonClass">back</button></a>
<?php }else{?>
<a href="purchase.php"><button class="printButtonClass">back</button></a>
<?php }
session_start();
include("includes/config.php");
if(isset($_GET["billid"]))
{
	$billid=$_GET["billid"];
	$slct=$conn->query("SELECT * FROM vm_purentry WHERE pe_billid='$billid'");
	$row=$slct->fetch_assoc();
}
$profl = $conn->query("SELECT * FROM vm_shopprofile WHERE sp_shopid='".$_SESSION["admin"]."'");
$row3 = $profl->fetch_assoc()
?>

<table style="float:right;text-align:left;" width="200" border="0">
  <tr>
    <th>Date</th>
    <td><?=date('d-m-Y H:i', strtotime($row["pe_billdate"]))?></td>
  </tr>
  <tr>
    <th>Bill NO.</th>
    <td><?=$row["pe_billnumber"]?></td>
  </tr>
</table>
<div>
<table style="text-align:left;float:left;" width="50%" border="0">

  <tr>
    <th><?= $row3['sp_shopname'] ?></th>
    
    
  </tr>
  <tr>
    <td><?= $row3['sp_shopaddress'] ?><br/> Ph: <?= $row3['sp_phone'] ?>, Mob: <?= $row3['sp_mobile'] ?><br/> Email:<?= $row3['sp_email'] ?></td>
    
    
  </tr>
</table>
<table style="text-align:left;float:right;" width="50%" border="0">
<?php $slctsup=$conn->query("SELECT * FROM vm_supplier WHERE rs_supplierid='".$row["pe_supplierid"]."'");
$rowsup=$slctsup->fetch_assoc();?>
  <tr>
    <th><?= $rowsup['rs_company_name'] ?></th>
    
    
  </tr>
  <tr>
    <td>GSTIN No. <?= $rowsup['rs_tinnum'] ?></td>
    
    
  </tr>
  <tr>
    <td><?= $rowsup['rs_name'] ?><br/> Ph: <?= $rowsup['rs_phone'] ?><br/> Email:<?= $rowsup['rs_email'] ?><br> Address:<?= $rowsup['rs_address'] ?></td>
   </tr>
   <tr>
   	<td>Invoice No. :<?=$row["pe_invoice_number"]?>, Date: <?=$row["pe_invoice_date"]?></td>
   </tr>
   <tr>
   	<td>Vehicle No. :<?=$row["pe_vehicle_number"]?></td>
   </tr>
</table>
</div>

<br>


<table border="1" width="100%" style="margin-top:15px;">
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

$slctitm=$conn->query("SELECT * FROM vm_puritems a LEFT JOIN vm_products b ON b.pr_productid=a.pi_productid WHERE a.pi_billid='$billid'");
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
<td align="center"><?=$rowitm["pr_purchaseprice"]?></td>
<td align="center"><?=$rowitm["pi_quantity"]?></td>
<td align="center"><?=$rowitm["pi_sgst"]?></td>
<td align="center"><?=$rowitm["pi_sgstamt"]?></td>
<td align="center"><?=$rowitm["pi_cgst"]?></td>
<td align="center"><?=$rowitm["pi_cgstamt"]?></td>
<td align="center"><?=$rowitm["pi_igst"]?></td>
<td align="center"><?=$rowitm["pi_igstamt"]?></td>


<td align="center"><?=$rowitm["pi_total"]?></td>

</tr>
<?php $i++;}?>
 <tr>
 <td colspan="10" align="right">TOTAL </td>
 <td align="center"><?=$row["pe_total"]?></td>

 
 </tr>
 <tr>
 
 <td colspan="10" align="right">DISCOUNT</td>
 <td align="center"><?=$row["pe_discount"]?></td>
</tr>
 <tr>
 
 <td colspan="10" align="right">OB</td>
 <td align="center"><?=$row["pe_oldbal"]?></td>
</tr>
<tr>
 <td colspan="10" align="right">GRAND TOTAL </td>
 <td align="center"><?=$row["pe_gtotal"]?></td>

 
 </tr>
 <tr>
 
 <td colspan="10" align="right">PAID AMOUNT</td>
 <td align="center"><?=$row["pe_paidamount"]?></td>
</tr>
<tr>
 
 <td colspan="10" align="right">BALANCE AMOUNT</td>
 <td align="center"><?=$row["pe_balance"]?></td>
</tr>
 </tr>

 
 <td colspan="11">Grand Total(in words) : <?php $amd=convert_number_to_words($row["pe_gtotal"]);echo $amd;?></td>
 
</tr>
</table>
<br>

<!--<table width="100%">
<tr>
<td bgcolor="#999999" align="center"><?= $row3['sp_shopname'] ?>, <?= $row3['sp_shopaddress'] ?>, Ph:<?= $row3['sp_phone'] ?>, Mob:<?= $row3['sp_mobile'] ?>, EMAIL:<?= $row3['sp_email'] ?></td>
</tr>
</table>-->

<script>

</script>
</body>
</html>