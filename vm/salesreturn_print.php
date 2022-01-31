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
<?php if(isset($_GET["back"])){?><a href="<?= $_GET["back"]?>"><button style="float:left;" class="printButtonClass">back</button></a><?php }else{?><a href="salesreturn.php"><button style="float:left;" class="printButtonClass">back</button></a><?php }?>
<?php 
session_start();
include("includes/config.php");
if(isset($_GET["billid"]))
{
	$billid=$_GET["billid"];
	$slct=$conn->query("SELECT * FROM us_salreturnentry WHERE sre_billid='$billid'");
	$row=$slct->fetch_assoc();
}
$profl = $conn->query("SELECT * FROM us_shopprofile WHERE sp_shopid='".$_SESSION["admin"]."'");
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
    <td><?=date('d-m-Y H:i', strtotime($row["sre_billdate"]))?></td>
  </tr>
  <tr>
    <th>Bill NO :</th>
    <td><?=$row["sre_billnumber"]?></td>
  </tr>
</table>


<table style="text-align:center;" width="100%" border="0">

  <tr>
    <th><h3><?= $row3['sp_shopname'] ?></h3></th>
  </tr>
  <tr>
    <td><?= $row3['sp_shopaddress'] ?></td>
      </tr>
	  <tr><td>Ph: <?= $row3['sp_phone'] ?>, Mob: <?= $row3['sp_mobile'] ?></td></tr>
 <!-- <tr>
    <th><b>DEALERS OF QUALITY HANDLOOM FANCY FABRICS</b></th>
    
  </tr> -->
  
  <tr><th>Sales Return</th></tr>
  <tr><td>Return Bill No :<?=$row["sre_rebill"]?></td></tr>
</table>
<table style="text-align:left;float:left;" width="40%" border="0">
<tr>
<td><?php if($row['sre_supplierid']=='0'){ $csid=0; echo $row['sre_customername'];}
												   else{
													   $slctcust=$conn->query("SELECT * FROM us_customer WHERE cs_customerid='".$row['sre_supplierid']."'");
														$rowcus=$slctcust->fetch_assoc();
													   echo $rowcus["cs_customername"];
													   echo "  &nbsp; &nbsp; ( " .$rowcus["cs_address"].")";
													   $csid=$rowcus["cs_customerid"];
													   }?></td>
 </tr>
  <tr><td>TIN :<?php if($row['sre_supplierid']=='0'){ echo $row['sre_customer_tin_num'];}else{echo $rowcus["cs_tin_number"];} ?></td>

  </tr>
  <tr>
    <td>Ph :<?php if($row['sre_supplierid']=='0'){ echo $row['sre_customermobile'];}else{echo $rowcus["cs_customerphone"];} ?></td>
     </tr>                                             
  <tr>
    <td>Vehicle Number : <?=$row["sre_vehicle_number"]?></td>
  </tr>

</table>
</td>
</tr>
</table>

<br>


<table border="1" width="100%" style="margin-top:15px;">
<tr>
<th rowspan="2" width="50px" style bgcolor="#999999"> SI No</th>

<th rowspan="2" bgcolor="#999999">ITEM NAME</th>
<th rowspan="2" width="10%" bgcolor="#999999">UNIT PRICE</th>
<th rowspan="2" width="15%" bgcolor="#999999">TOTAL QTY</th>
<th rowspan="2" width="15%" bgcolor="#999999">NET AMNT</th>
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
<?php
$i=1;

$slctitm=$conn->query("SELECT * FROM  us_salreturnitem a LEFT JOIN us_products b ON b.pr_productid=a.sri_productid WHERE a.sri_billid='$billid'");
while($rowitm=$slctitm->fetch_assoc())
{
?>
<tr>
<td align="center"><?=$i?></td>

<td>
<?php

	echo $rowitm["pr_productname"];
?>
<td align="center"><?=$rowitm["sri_price"]?></td>	
</td>
<td align="center"><?=$rowitm["sri_quantity"]?></td>
<td align="center"><?=$rowitm["sri_quantity"]*$rowitm["sri_price"]?></td>
<td align="center"><?=$rowitm["sri_cgst"]?></td>
<td align="center"><?=$rowitm["sri_cgstamt"]?></td>
<td align="center"><?=$rowitm["sri_sgst"]?></td>
<td align="center"><?=$rowitm["sri_sgstamt"]?></td>
<td align="center"><?=$rowitm["sri_igst"]?></td>
<td align="center"><?=$rowitm["sri_igstamt"]?></td>
<td align="center"><?=$rowitm["sri_total"]?></td>

</tr>
<?php $i++;}?>
 <tr>
 <td colspan="11" align="right">TOTAL </td>
 <td align="center"><?=$row["sre_total"]?></td>

 
 </tr>
 <tr>
 
 <td colspan="11" align="right">DISCOUNT</td>
 <td align="center"><?=$row["sre_discount"]?></td>
</tr>
 <tr>
 
 <td colspan="11" align="right">OB</td>
 <td align="center"><?=$row["sre_oldbal"]?></td>
</tr>
<tr>
 <td colspan="11" align="right">GRAND TOTAL </td>
 <td align="center"><?=$total =$row["sre_gtotal"]?></td>

 
 </tr>
 <tr>
 
 <td colspan="11" align="right">PAID AMOUNT</td>
 <td align="center"><?=$row["sre_paidamount"]?></td>
</tr>
<tr>
 
 <td colspan="11" align="right">BALANCE AMOUNT</td>
 <td align="center"><?=$row["sre_balance"]?></td>
</tr>
 
 <td colspan="12">Grand Total(in words) : <?php $amd=convert_number_to_words($total);echo $amd; ?></td>
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