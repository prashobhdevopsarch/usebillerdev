<html>
<title></title>
<head> 
<link rel="stylesheet" type="text/css" media="print" href="custom/css/print.css" />
</head>
<body  onLoad="window.print()">

<?php if(isset($_GET["back"])){?><a href="<?= $_GET["back"]?>"><button style="float:left;" class="printButtonClass">back</button></a><?php }else{?><a href="dashboard.php"><button style="float:left;" class="printButtonClass">back</button></a><?php }?>
<?php 
session_start();
include("includes/config.php");
if(isset($_GET["billid"]))
{
	$billid=$_GET["billid"];
	$slct=$conn->query("SELECT * FROM vm_billentry WHERE be_billid='$billid'");
	$row=$slct->fetch_assoc();
	$cnt=$conn->query("SELECT COUNT(bi_billitemid) AS cnt FROM vm_billitems WHERE bi_billid='$billid'");
	$row12=$cnt->fetch_assoc();
	$billitems=$conn->query("SELECT * FROM vm_billitems WHERE bi_billid='$billid'");
	$row8= $billitems->fetch_assoc();
	$cnt1=$row12["cnt"];
	$r=1;
	$numbill=$cnt1/32;
	$numbill=$numbill+1;
	$ttl=intval($numbill);
	
	
	
}

$profl = $conn->query("SELECT * FROM vm_shopprofile WHERE sp_shopid='".$_SESSION["admin"]."'");
$row3 = $profl->fetch_assoc();
$bill = $conn->query("SELECT * FROM vm_billentry WHERE be_billid='$billid'");
$row4=$bill->fetch_assoc();
$cust= $conn->query("SELECT * FROM vm_customer WHERE cs_customerid='".$row4["be_customerid"]."'");
		$row5=$cust->fetch_assoc();

?>
<!--<span class="s4">GSTIN Number: <?=$row3["sp_tin"]?></span><br>-->
<table style="text-align:center;border-bottom: 0px #808080 solid;" width="100%"  > 
	<tr>
    <td style="display:none">
		<span class="s1"><B><?=$row3["sp_shopname"]?></span></B><br>
 			<span class="s2"><?=$row3["sp_shopaddress"]?><br>
            <?=$row3["sp_phone"]?>&nbsp;<?=$row3["sp_mobile"]?><br>
           <!-- <?=$row3["sp_email"]?></span><br>-->
         
            
    </td>
    <tr>
    <td>ESTIMATE</td>
    </tr>
    <tr>
    <!--<td style="text-align:left; display:none;">NAME:&nbsp;<?=$row3["sp_shopname"]?></td>-->
    </tr>
   </tr>
   </table >
   <table>
   <?php if($_GET['csid']!=0)
{
	$slctcust=$conn->query("SELECT * FROM vm_customer WHERE cs_customerid='".$_GET['csid']."'");
	$rowcus=$slctcust->fetch_assoc();
	?>
  <tr>
    <td><span class="s4" align="left" >M/s &nbsp;&nbsp;<?=$rowcus["cs_customername"]?></td>
  </tr>
  
  <tr>
    <td><span class="s4" ><?= $rowcus['cs_address'] ?><br/><span class="s4" > <?= $rowcus['cs_customerphone'] ?></td>
  </tr>
  <?php }else{?>
  <tr>
    <td>M/s &nbsp;&nbsp;<?=$row["be_customername"]?></td>
  </tr>
  <tr>
    <td><?=$row["be_customermobile"]?></td>
  </tr>
  
  <?php }?>

</table>  

<table style="text-align: right;border-bottom: 1px #808080 solid;" width="100%">
   <tr ><span class="s5" >
   <td><span class="s4" > Date: <?=date('d-m-Y', strtotime($row["be_billdate"]))?></span><br><span class="s4" >Invoice No:  <?=$row4["be_billnumber"]?>&nbsp;&nbsp;&nbsp;</span> </td>
   
  </tr></span>
</table>




<table  width="100%" class="table">
<tr style="border-bottom: 1px #808080 solid; text-align: center;">

<td  style="width:15%; text-align:left;" ><span class="s4" > SI No </span></td>
<td  style="text-align:left;" ><span class="s4" >ITEM</span></td>
<!--<td rowspan="2" style="width:75px;" ><span class="s3" >HSN</td>-->
<!--<td rowspan="2" style="width:50px;" >UNIT</td>-->

<td   style="width:11%;" width="20" ><span class="s4">RATE</span></td>
<td  style="width:11%;" ><span class="s4" >QTY</span></td>

<td   style="width:12&;" ><span class="s4" >TOTAL</SPAN></td>
<!--<td rowspan="2" style="width:50px;" ><span class="s3" >NET AMNT</td>-->
<!--<td rowspan="2" style="width:50px;" ><span class="s3" >DIS.</td>
<td  rowspan="2" style="width:50px;" ><span class="s3" >TAXABLE VALUE</td>
<?php if($row8['bi_igst_amt']==0){?>
<td  style="text-align:center" colspan="2"  width="15%"><span class="s3" >CGST</td>
<td  style="text-align:center" colspan="2" width="15%"><span class="s3" >SGST</td>
<?php }else {?>
<td style="text-align:center" colspan="2"  width="15%"><span class="s3" >IGST</td>-->
<?php }?>

</tr>
<!--<tr style="border-bottom: 1px #808080 solid; text-align:center">
<?php if($row8['bi_igst_amt']==0){?>
<td><span class="s5" >Rate</SPAN></td>
<td><span class="s5" >Amt.</SPAN></td>
<td><span class="s5" >Rate</SPAN></td>
<td><span class="s5" >Amt.</SPAN></td>
<?php }
else {?>
<td><span class="s5" >Rate</SPAN></td>
<td><span class="s5" >Amt.</SPAN></td>
<?php }?>
</tr>


</tr>-->
<?php
$i=1;

$slctitm=$conn->query("SELECT * FROM vm_billitems a LEFT JOIN vm_products b ON b.pr_productid=a.bi_productid WHERE a.bi_billid='$billid'");
while($rowitm=$slctitm->fetch_assoc())
{
?>
<tr>
<td align="left"><span class="s4" >&nbsp;&nbsp;<?=$i?></td>

<td align="left" width=""><span class="s4" >
<?php

	echo $rowitm["pr_productname"];
?>
</td>
<!--<td><span class="s4" >
<?php

	echo $rowitm["pr_hsn"];
?>
</td>
<td align="center"><span class="s4" >
<?php

	echo $rowitm["pr_unit"];
?>
</td>-->
<td align="center"><span class="s4" ><?=$rowitm["bi_price"]?></td>
<td align="center"><span class="s4" ><?=$rowitm["bi_quantity"]?>&nbsp;<?=$rowitm["pr_unit"]?></td>



<td align="center"><span class="s4" ><?=$rowitm["bi_quantity"]*$rowitm["bi_price"]?></td>
<!--<td align="center"><span class="s4" ><?=$rowitm["bi_discount"]?></td>
<td align="center"><span class="s4" ><?=$rowitm["bi_quantity"]*$rowitm["bi_price"]-$rowitm["bi_discount"]?></td>
<span class="s4" ><?php if($row8['bi_igst_amt']==0){?>
<td align="center"><span class="s4" ><?=$rowitm["bi_sgst"]?></td>
<td align="center"><span class="s4" ><?=$rowitm["bi_sgst_amt"]?></td>
<td align="center"><span class="s4" ><?=$rowitm["bi_cgst"]?></td>
<td align="center"><span class="s4" ><?=$rowitm["bi_cgst_amt"]?></td>
<?php }else{?>

<td align="center"><span class="s4" ><?=$rowitm["bi_igst"]?></td>
<td align="center"><span class="s4" ><?=$rowitm["bi_igst_amt"]?></td>
<?php }?>
<td align="center"><span class="s4" ><?=$rowitm["bi_total"]?></td>-->
</tr>
<?php $i++;}?>
<!-- <tr>
 <tr>
 <?php if($row8['bi_igst_amt']==0){$m=13;}else{$m=11;}?>
 <td colspan="<?= $m?>" align="right">TOTAL </td>
 <td align="center"><?=$row["be_total"]?></td>

 
 </tr>
 
 

 
 <td colspan="<?= $m?>" align="right">DISCOUNT</td>
 <td align="center"><?=$row["be_discount"]?></td>
</tr>

 <tr>


 <tr><tr><td></td>
 <tr><td colspan="<?= $m-1?>" align="right"><span class="s4" >TOTAL </td>
 <td align="center"><span class="s4" ><?=$row["be_total"]?></td></tr>
 <tr>
<td colspan="<?= $m-1?>" align="right"><span class="s4" >Freight :</td>
 <td align="center"><span class="s4" ><?=$row["be_coolie"]?></td>
</tr> --><br>
 <td colspan="4" align="right"><B><span class="s3" ><br>GRAND TOTAL :</td>
 <td align="center"><B><span class="s2" ><br><?php $total = $row["be_total"]+$row["be_coolie"];echo $total;?></td>
 
</tr>

 
 <td   style="border-bottom: 1px #808080 solid;" colspan="5"><span class="s3" >Grand Total(in words) : <?php $amd=convert_number_to_words($total);echo $amd;?></td>
 

<!--<tr>
<td colspan="15"  style="text-align: center"><span class="s3" >Declaration</SPAN></td>
</tr>
<tr>
<td colspan="15"><p><span class="s4" >Certified that all the particulars shown in the above tax invoice
are true and correct.

</SPAN></p></td>-->
</tr>
<tr style="display:none;">
<td></td><td></td><td colspan="3"><span class="s3" ><br>Thank You Visit Again</SPAN></td>
</tr>
 
</table>
<footer></footer>



<script>

</script>
</body>
<style>
table {
    border-collapse: collapse;
}
table td
{
	height:15px;
}
   /*@font-face {
   font-family: eras;
src: url(includes/eras-bold-itc.ttf);
}*/
.eras{font-family:eras;}
.fnt td,.fnt th{border:1px solid grey;}
.nonborder td{border:1px solid #FFF !important;}
@media print{
.printButtonClass{display:none;}
.table{width:100%;}
.table th{font-size:10px;}
.s1{font-size:22px;}
	.s2{font-size:13px;}
	.s3{font-size:12px;}
	.s4{font-size:14px;}
	.s5{font-size:18px;}
	.s6{font-size:16px;}
	.s7{font-size:8px;}
/*.fnt td{font-size:14px;}*/
.fnt th{font-size:12px;}
footer {page-break-after: always;}



	
	
	<?php 
$slctid=$conn->query("SELECT COUNT(bi_productid) AS fkk  FROM vm_billitems WHERE bi_billid ='".$_GET['billid']."'");
	$rowid=$slctid->fetch_assoc();
	
	$f = $rowid['fkk'];
	?>
<?php if($f >= 10){ ?> 

@body {
      size: 152mm 254mm;
    }
	<?php }
	
	elseif($f <= 10){ ?>
	@body {
     size: 152mm 150mm;
    }
	<?php }?>

}
body {font-family:VERDANA;}

</style>
</html>