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
.table{width:100%;}
.table th{font-size:10px;}
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
<table style="text-align:center;" width="100%" border="0">

  <tr>
    <th><b>Government of India/State<br>Department of..............</b></th>
  </tr>
  <td>&nbsp;</td>
  <tr>
  </tr>
  <tr>
    <td>Form GST INV - 1<br>(See Rule...........)<br><b>TAX INVOICE</b></td>
  </tr>
</table>
<table width="100%">
<tr><td>
<table style="text-align:center;" width="50%" border="0">

  <tr>
    <th><b><?= $row3['sp_shopname'] ?></b></th>
  </tr>
  <tr>
    <td><?= $row3['sp_shopaddress'] ?><br/> Ph: <?= $row3['sp_phone'] ?><br> Mob: <?= $row3['sp_mobile'] ?> Email:<?= $row3['sp_email'] ?><br>State Code : <?=$row3['sp_stcode']?></td>
  </tr>
</table>
<table style="float:left;text-align:left;" width="200" border="0">
  <tr>
    <th collapse="2">GST No.</th>
    <td collapse="2"><?=$row3["sp_tin"]?></td>
  </tr>
  

  <tr>
	
    <th>Date</th>
    <td><?=date('d-m-Y H:i', strtotime($row["be_billdate"]))?></td>
  </tr>
  <tr>
  
    <th>Bill NO.</th>
    <td><?=$row["be_billnumber"]?></td>
  </tr>
</table>
<table style="float:right; text-align:center;">
<tr>
<td>

</td>
</tr>
</table>

</td>
<td>
<table style="text-align:center;" width="100%" border="0">
<?php if($_GET['csid']!='0')
{
	$slctcust=$conn->query("SELECT * FROM vm_customer WHERE cs_customerid='".$_GET['csid']."'");
	$rowcus=$slctcust->fetch_assoc();
	?>
  <tr>
    <th><b><?=$rowcus["cs_customername"]?></b></th>
  </tr>
  <tr>
    <td>TIN Number : <?=$rowcus["cs_tin_number"]?></td>
  </tr>
  <tr>
    <td><?= $rowcus['cs_address'] ?><br/> Ph: <?= $rowcus['cs_customerphone'] ?><br> Email:<?= $rowcus['cs_email'] ?><br>State Code : <?=$rowcus['cs_statecode']?></td>
  </tr>
  <tr>
    <td>Vehicle Number : <?=$row["be_vehicle_number"]?></td>
  </tr>
  <?php }else{?>
  <tr>
    <th><b><?=$row["be_customername"]?></b></th>
  </tr>
  <tr>
    <th><?=$row["be_customermobile"]?></th>
  </tr>
 <tr>
    <td>State Code :<?=$row["be_statecode"]?></th>
  </tr>
  <tr>
    <td>Vehicle Number : <?=$row["be_vehicle_number"]?></td>
  </tr>
  <?php }?>
</table>
</td>
</tr>
</table>


<table border="1" width="100%" class="table">
<tr>
<th rowspan="2" style="width:25px;" bgcolor="#999999"> SI No</th>
<th rowspan="2" bgcolor="#999999">DESCRIPTION OF GOODS</th>
<th rowspan="2" style="width:75px;" bgcolor="#999999">HSN</th>
<th rowspan="2" style="width:50px;" bgcolor="#999999">UNIT</th>
<th  rowspan="2" style="width:75px;" width="20" bgcolor="#999999">UNIT PRICE</th>

<th rowspan="2" style="width:50px;" bgcolor="#999999">TOTAL QTY</th>
<th rowspan="2" style="width:50px;" bgcolor="#999999">NET AMNT</th>
<th rowspan="2" style="width:50px;" bgcolor="#999999">DISCOUNT</th>
<th  rowspan="2" style="width:50px;" bgcolor="#999999">TAXABLE VALUE</th>

<th colspan="2"  style="width:100px;" bgcolor="#999999">CGST</th>
<th  colspan="2"style="width:100px;" bgcolor="#999999">SGST</th>
<th colspan="2"  style="width:100px;" bgcolor="#999999">IGST</th>
<th rowspan="2"  style="width:50px;" bgcolor="#999999"> TOTAL PRICE</th>
</tr>
<tr>
<th>Rate</th>
<th>Amt.</th>
<th>Rate</th>
<th>Amt.</th>
<th>Rate</th>
<th>Amt.</th>
</tr>


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
<td>
<?php

	echo $rowitm["pr_hsn"];
?>
</td>
<td align="center">
<?php

	echo $rowitm["pr_unit"];
?>
</td>
<td align="center"><?=$rowitm["bi_price"]?></td>

<td align="center"><?=$rowitm["bi_quantity"]?></td>
<td align="center"><?=$rowitm["bi_quantity"]*$rowitm["bi_price"]?></td>
<td align="center"><?=$rowitm["bi_discount"]?></td>
<td align="center"><?=$rowitm["bi_vatamount"]?></td>

<td align="center"><?=$rowitm["bi_sgst"]?></td>
<td align="center"><?=$rowitm["bi_sgst_amt"]?></td>
<td align="center"><?=$rowitm["bi_cgst"]?></td>
<td align="center"><?=$rowitm["bi_cgst_amt"]?></td>
<td align="center"><?=$rowitm["bi_igst"]?></td>
<td align="center"><?=$rowitm["bi_igst_amt"]?></td>
<td align="center"><?=$rowitm["bi_total"]?></td>
</tr>
<?php $i++;}?>
 <tr>
 <td colspan="15" align="right">TOTAL </td>
 <td align="center"><?=$row["be_total"]?></td>

 
 </tr>
 <tr>
 
 <td colspan="15" align="right">DISCOUNT</td>
 <td align="center"><?=$row["be_discount"]?></td>
</tr>
<tr>
 
 <td colspan="15" align="right">COOLIE</td>
 <td align="center"><?=$row["be_coolie"]?></td>
</tr>
<tr>
 <tr>
 
 <td colspan="15" align="right">GRAND TOTAL</td>
 <td align="center"><?php $total = $row["be_total"]+$row["be_coolie"]-$row["be_discount"];echo $total;?></td>
</tr>

 
 <td colspan="16">Grand Total(in words) : <?php $amd=convert_number_to_words($total);echo $amd;?></td>
 
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