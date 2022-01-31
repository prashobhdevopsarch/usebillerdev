<html>
<title></title>
<head> 
<link rel="stylesheet" type="text/css" media="print" href="custom/css/print.css" />
<style>
body{color:#000000;}
table {
    border-collapse: collapse;
}
table td
{
height:15px;
}
.table-curved-head {
border-collapse: separate;
    border: solid #000000 1px;
border-bottom:0px;
    border-radius: 15px 15px 0px 0px;
}
.table-curved-foot {
border-collapse: separate;
    border: solid #000000 1px;
border-top:0px;
    border-radius: 0px 0px 15px 15px;
    
}
/*.table-body th, .table-body td{
borderolid #000000 1px;
}*/
.table-body th{
background: #000000;
color: white;
}
/*@page { size: 2480px 1754px; margin: 0px;}*/
 /* change the margins as you want them to be. */
/*#footer{bottom:0;position:absolute; padding-right:5px;}*/
@media print{ 
.btn {display:none;}
@page {
    /*size: 595px 421px;*/
    margin: 5px 10px 5px 5px; }  
    
table{font-size:16px;color:#000000;
}
.table-body{
bottom: 500px;	
}
.table-body th{
background: #000000;
color: white;}
/*#footer{bottom:5px;position: absolute; padding-right:5px;}
body {
    position: relative;
}
@page:last {
    @bottom-center {
        content: "…";
    }*/
body {font-family:;}
}

}
.s1{font-size:10px;}
	.s2{font-size:13px;}
	.s3{font-size:14px;}
	.s4{font-size:13px;}
	.s5{font-size:18px;}
	@media print{
	.printButtonClass{display:none;}


</style>


</head>
<body onLoad="window.print()">
<?php if(isset($_GET["back"])){?><a href="<?= $_GET["back"]?>"><button style="float:left;" class="btn">back</button></a><?php }else{?><a href="dashboard.php"><button style="float:left;" class="printButtonClass">back</button></a><?php }?>
<?php 
session_start();
include("includes/config.php");
if(isset($_GET["billid"]))
{
	$billid=$_GET["billid"];
	$slct=$conn->query("SELECT * FROM vm_estimation WHERE be_billid='$billid'");
	$row=$slct->fetch_assoc();
}
$profl = $conn->query("SELECT * FROM vm_shopprofile WHERE sp_shopid='".$_SESSION["admin"]."'");
$row3 = $profl->fetch_assoc();
?>

<table style="text-align:center;border-bottom: 0px #808080 solid;" width="100%"  > 
	<tr style="display:none;">
    <td ><b><span style="font-size:17px;"><?=$row3['sp_shopname']?></span></b><br>
 			<!--<span class="s3" ><?=$row3["sp_shopaddress"]?><br>
            <span class="s4" ><?=$row3["sp_phone"]?> &nbsp;<?=$row3["sp_mobile"]?>-->
     </td>  
  </tr>
  <tr><td>ESTIMATE</td></tr>
</table>
<table width="100%" border="0" style="border-bottom: 0px #808080 solid;">
 
	

   <tr>
    <td><span class="s3"> Date:<?=date('d-m-Y', strtotime($row["be_billdate"]))?></td>
    <td style="text-align:right"><span class="s3"> Invoice # :<?=$row["be_billnumber"]?></td>
  </tr>
  
 
</table><br>

<table  style="text-align:left;border-bottom: 1px #808080 solid;" width="100%">
<tr style="border-bottom: 1px #808080 solid;" width="100%">
<th width="7%"><span class="s4" > SI.&nbsp;</th>
<th style="display:none;" width="100px" style bgcolor="#999999"><span class="s3" > ITEM CODE</th>

<th><span class="s4">ITEM </th>
<th style="display:none;"  width="100px" >UNIT</th>
<th  width="10%" ><span class="s4"> MRP&nbsp;</th>

<th   width="15%" ><span class="s4">  QTY&nbsp;&nbsp;</th>

<th   width="15%" ><span class="s4">  Rs </th>
</tr>
<?php
$i=1;

$slctitm=$conn->query("SELECT * FROM vm_estimationitems a LEFT JOIN vm_products b ON b.pr_productid=a.bi_productid WHERE a.bi_billid='$billid'");
while($rowitm=$slctitm->fetch_assoc())
{
?>
<tr>
<td width="5%" ><span class="s4"> <?=$i?></td>
<td style="display:none;">
<?php

	echo $rowitm["pr_productcode"];
?>
</td>

<td width="70%"><span class="s4">
<?php

	echo $rowitm["pr_productname"];
?>&nbsp;&nbsp;
</td>
<td style="display:none;">
<?php

	echo $rowitm["bi_unit"];if($rowitm["bi_unit"]=='bag'){echo " ( ".$rowitm["pr_unit"]." kg )";};
?>
</td>
<td ><span class="s4"><?php echo $rowitm["bi_price"]?></td>

<td ><span class="s4"><?php echo $rowitm["bi_quantity"]?></td>

<td align="right" ><span class="s4"><?=$rowitm["bi_total"]?></td>

</tr>
<?php $i++;}
	$cnt=$conn->query("SELECT COUNT(bi_billitemid) AS cnts FROM vm_estimationitems WHERE bi_billid='$billid'");
	$row12=$cnt->fetch_assoc();

?>
 <tr>
  <td ></td>
 <td ></td>
  </tr>
 <!--<tr>
 <!--<td>Items:<?=$row12["cnts"]?></td>
 <td colspan="4" align="right">TOTAL: &nbsp;</td>
 <td ><?=$row["be_total"]?></td>
 </tr>
 <tr>
  <td colspan="4" align="right"><span class="s3">DISCOUNT: &nbsp;</td>
 <td align="right"><span class="s3"><?=$row["be_discount"]?></td>
  </tr>
  <tr>
  <td colspan="4" align="right"><span class="s3">GST (include): &nbsp;</td>
<td align="right"><span class="s3"><?php $slctitm=$conn->query("SELECT SUM(bi_cgst_amt) as ttlcgst, SUM(bi_sgst_amt) as ttlsgst,SUM(bi_igst_amt) as ttligst from vm_estimationitems where bi_billid='$billid' and bi_isactive='0'");
 $rowitm=$slctitm->fetch_assoc();
 $gst=$rowitm["ttlcgst"]+=$rowitm["ttlsgst"]+=$rowitm["ttligst"];
 echo  round($gst)?></td>
  </tr>-->
  <TR>
  <td colspan="4" align="right"><span class="s3">GRANT TOTAL: &nbsp;</td>
 <td align="right"><span class="s3"><?=$row["be_gtotal"]?></td>
 </tr>
 

<!--<table width="100%" style="font-size: 12px; border-bottom: 1px #808080 solid;">
<tr>
<td>Prepared By Admin</td><td style="text-align:right"></td>
</tr>
<tr>
<td><br>Checked By </td><td style="text-align:right"></td>
</tr>
</table>-->

<table width="100%" style="font-size: 12px; border-bottom: 1px #808080 solid;">
<tr>
<td style="text-align:center">Thank You....Visit Again..!</td><td style="text-align:right"></td>
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