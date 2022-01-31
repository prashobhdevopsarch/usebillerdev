<html>
<title></title>
<head> 
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

<table style="width:100%; padding-top:0.5px;"> <tr><td><span class="s4" align="left" > Date: <?=date('d-m-Y', strtotime($row["be_billdate"]))?></span></td>
   <td><span class="s4" style="float:right;text-align:right;" >Invoice No:  <?=$row4["be_billnumber"]?>&nbsp;&nbsp;&nbsp;</span></td>
        </tr></table> 

<table style="text-align:center;border-bottom: 1px #808080 solid;" width="100%"  > 
	<tr height="100px">
    <td>
		<span class="s1"><B><?=$row3["sp_shopname"]?></span></B><br>
 			<span class="s2"><?=$row3["sp_shopaddress"]?><br>
            <?=$row3["sp_phone"]?>&nbsp;<?=$row3["sp_mobile"]?><br>
           <!-- <?=$row3["sp_email"]?></span><br>-->
         <span class="s4">GSTIN : <?=$row3["sp_tin"]?><br>
            <span class="s3" >CASH INVOICE</span>
			
    </td>
   </tr>
   
</table >  

<!--<table style="text-align: left;border-bottom: 1px #808080 solid;" width="100%">
   <tr ><span class="s5" >
   <td style="padding:5px;"> <span class="s4" >Details Of Reciever(Billed To) <?php if ($row4["be_customerid"] == "0") {
    	?>
        <br><br><span class="s4" >Name:
        <?php
		echo $row4["be_customername"];?>
		<br><span class="s4" >Address:
		<?php
		echo $row4["be_customermobile"]; 
		?>
        <br><span class="s4" >State: <?php if($row4["be_statecode"]=="AN"){echo "Andaman and Nicobar Islands ";}
                         elseif($row4["be_statecode"]=="AP"){echo "Andhra Pradesh";}
                         elseif($row4["be_statecode"]=="AD"){echo "Andhra Pradesh";}                          		                         		                         elseif($row4["be_statecode"]=="AR"){echo "Arunachal Pradesh";}
                         elseif($row4["be_statecode"]=="AS"){echo "Assam";}
                         elseif($row4["be_statecode"]=="BH"){echo "Bihar";}
                         elseif($row4["be_statecode"]=="CH"){echo "Chandigarh";}
                         elseif($row4["be_statecode"]=="CT"){echo "Chattisgarh";}
                         elseif($row4["be_statecode"]=="DN"){echo "Dadra and Nagar Haveli";}
                         elseif($row4["be_statecode"]=="DD"){echo "Daman and Diu";}
                         elseif($row4["be_statecode"]=="DL"){echo "Delhi";}
                         elseif($row4["be_statecode"]=="GA"){echo "GoA";}
						 elseif($row4["be_statecode"]=="GJ"){echo "Gujarat";}
                         elseif($row4["be_statecode"]=="HR"){echo "Hariyana";}                           
                         elseif($row4["be_statecode"]=="HP"){echo "Himachal Pradesh";}
                         elseif($row4["be_statecode"]=="JK"){echo "Jammu And Kashmir";}
                         elseif($row4["be_statecode"]=="JH"){echo "Jharkhand";}
                         elseif($row4["be_statecode"]=="KA"){echo "Karnataka";}
                         elseif($row4["be_statecode"]=="KL"){echo "Kerala";}
                         elseif($row4["be_statecode"]=="LD"){echo "LakshadWeep Island";}
                         elseif($row4["be_statecode"]=="MP"){echo "Madhya Pradhesh";}
                         elseif($row4["be_statecode"]=="MH"){echo "Maharastra";}
                         elseif($row4["be_statecode"]=="MN"){echo "Manipur";}
                         elseif($row4["be_statecode"]=="ME"){echo "Meghalaya";}
                         elseif($row4["be_statecode"]=="MI"){echo "Mizoram";}                           
                         elseif($row4["be_statecode"]=="NL"){echo "Nagaland";}
                         elseif($row4["be_statecode"]=="OR"){echo "Odisha";}
                         elseif($row4["be_statecode"]=="PY"){echo "Pondicherry";}
                         elseif($row4["be_statecode"]=="PB"){echo "Punjab";}
                         elseif($row4["be_statecode"]=="RJ"){echo "Rajasthan";}                           
                         elseif($row4["be_statecode"]=="SK"){echo "Sikkim";}
                         elseif($row4["be_statecode"]=="TN"){echo "Tamil Nadu";}
                         elseif($row4["be_statecode"]=="TS"){echo "Telangana";}
                         elseif($row4["be_statecode"]=="TR"){echo "Tripura";}
                         elseif($row4["be_statecode"]=="UP"){echo "Uttar Pradesh";}
                         elseif($row4["be_statecode"]=="UI"){echo "Uttarakhand";}
                         elseif($row4["be_statecode"]=="WB"){echo "West Bengal";}
                         else {echo "Kerala";}?>
        <br><span class="s4" >State Code:<?php if($row4["be_statecode"]==''){echo"KL";}else{echo $row4["be_statecode"];}?><br>
        <span class="s4" >GSTIN Nmber:  <?php echo $row4["be_customer_tin_num"];
        } 
		else {?>
        <span class="s4" >Name:
        <?php
		echo $row5["cs_customername"];?>
		<br><span class="s4" >Address:
		<?php
		echo $row5["cs_address"]; 
		?>
        <br> <span class="s4" >State:<?php if($row5["cs_statecode"]=="AN"){echo "Andaman and Nicobar Islands ";}
                         elseif($row5["cs_statecode"]=="AP"){echo "Andhra Pradesh";}
                         elseif($row5["cs_statecode"]=="AD"){echo "Andhra Pradesh";}                          		                         		                         elseif($row5["cs_statecode"]=="AR"){echo "Arunachal Pradesh";}
                         elseif($row5["cs_statecode"]=="AS"){echo "Assam";}
                         elseif($row5["cs_statecode"]=="BH"){echo "Bihar";}
                         elseif($row5["cs_statecode"]=="CH"){echo "Chandigarh";}
                         elseif($row5["cs_statecode"]=="CT"){echo "Chattisgarh";}
                         elseif($row5["cs_statecode"]=="DN"){echo "Dadra and Nagar Haveli";}
                         elseif($row5["cs_statecode"]=="DD"){echo "Daman and Diu";}
                         elseif($row5["cs_statecode"]=="DL"){echo "Delhi";}
                         elseif($row5["cs_statecode"]=="GA"){echo "GoA";}
						 elseif($row5["cs_statecode"]=="GJ"){echo "Gujarat";}
                         elseif($row5["cs_statecode"]=="HR"){echo "Hariyana";}                           
                         elseif($row5["cs_statecode"]=="HP"){echo "Himachal Pradesh";}
                         elseif($row5["cs_statecode"]=="JK"){echo "Jammu And Kashmir";}
                         elseif($row5["cs_statecode"]=="JH"){echo "Jharkhand";}
                         elseif($row5["cs_statecode"]=="KA"){echo "Karnataka";}
                         elseif($row5["cs_statecode"]=="KL"){echo "Kerala";}
                         elseif($row5["cs_statecode"]=="LD"){echo "LakshadWeep Island";}
                         elseif($row5["cs_statecode"]=="MP"){echo "Madhya Pradhesh";}
                         elseif($row5["cs_statecode"]=="MH"){echo "Maharastra";}
                         elseif($row5["cs_statecode"]=="MN"){echo "Manipur";}
                         elseif($row5["cs_statecode"]=="ME"){echo "Meghalaya";}
                         elseif($row5["cs_statecode"]=="MI"){echo "Mizoram";}                           
                         elseif($row5["cs_statecode"]=="NL"){echo "Nagaland";}
                         elseif($row5["cs_statecode"]=="OR"){echo "Odisha";}
                         elseif($row5["cs_statecode"]=="PY"){echo "Pondicherry";}
                         elseif($row5["cs_statecode"]=="PB"){echo "Punjab";}
                         elseif($row5["cs_statecode"]=="RJ"){echo "Rajasthan";}                           
                         elseif($row5["cs_statecode"]=="SK"){echo "Sikkim";}
                         elseif($row5["cs_statecode"]=="TN"){echo "Tamil Nadu";}
                         elseif($row5["cs_statecode"]=="TS"){echo "Telangana";}
                         elseif($row5["cs_statecode"]=="TR"){echo "Tripura";}
                         elseif($row5["cs_statecode"]=="UP"){echo "Uttar Pradesh";}
                         elseif($row5["cs_statecode"]=="UI"){echo "Uttarakhand";}
                         elseif($row5["cs_statecode"]=="WB"){echo "West Bengal";}
                         else {echo "Kerala";}?> 
        <br>
        <span class="s4" >State Code: <?php echo $row5["cs_statecode"];?>
        <br><span class="s4" >GSTIN Nmber:  <?php echo $row5["cs_tin_number"];}?></td>
    <td width="45%" style="padding:5px; text-align:right;">

    				
                   <span class="s4" > Date: <?=date('d-m-Y', strtotime($row["be_billdate"]))?></span><br>
                    <span class="s4" >Invoice No:  <?=$row4["be_billnumber"]?>&nbsp;&nbsp;&nbsp;</span><br>
               <span class="s4" >TransPort Mode:  <?=$row4["be_vehicle_number"]?></span><br>
                    </td>
  </tr></span>
</table>-->




<table  width="100%" class="table">
<tr style="border-bottom: 1px #808080 solid; text-align:center">

<td rowspan="2" style="width:35px;" ><span class="s3" > SI No </td>
<td  style="text-align:left;"rowspan="2" ><span class="s3" >ITEMS</td>
<td rowspan="2" style="width:75px;" ><span class="s3" >HSN</td>
<!--<td rowspan="2" style="width:50px;" >UNIT</td>-->
<td  rowspan="2" style="width:75px;" width="20" ><span class="s3" >RATE </td>

<td rowspan="2" style="width:50px;" ><span class="s3" >QTY</td>
<td rowspan="2" style="width:50px;" ><span class="s3" >NET AMNT</td>
<td rowspan="2" style="width:50px;" ><span class="s3" >DIS.</td>
<td  rowspan="2" style="width:50px;" ><span class="s3" >TAXABLE VALUE</td>
<?php if($row8['bi_igst_amt']==0){?>
<td  style="text-align:center" colspan="2"  width="15%"><span class="s3" >CGST</td>
<td  style="text-align:center" colspan="2" width="15%"><span class="s3" >SGST</td>
<?php }else {?>
<td style="text-align:center" colspan="2"  width="15%"><span class="s3" >IGST</td>
<?php }?>
<td rowspan="2"  style="width:50px;" > <span class="s3" >TOTAL</SPAN></td>
</tr>
<tr style="border-bottom: 1px #808080 solid; text-align:center">
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


</tr>
<?php
$i=1;

$slctitm=$conn->query("SELECT * FROM vm_billitems a LEFT JOIN vm_products b ON b.pr_productid=a.bi_productid WHERE a.bi_billid='$billid'");
while($rowitm=$slctitm->fetch_assoc())
{
?>
<tr>
<td align="center"><span class="s4" ><?=$i?></td>

<td width="400px"><span class="s4" >
<?php

	echo $rowitm["pr_productname"];
?>
</td>
<td><span class="s4" >
<?php

	echo $rowitm["pr_hsn"];
?>
</td>
<!--<td align="center"><span class="s4" >
<?php

	echo $rowitm["pr_unit"];
?>
</td>-->
<td align="center"><span class="s4" ><?=$rowitm["bi_price"]?></td>

<td align="center"><span class="s4" ><?=$rowitm["bi_quantity"]?></td>
<td align="center"><span class="s4" ><?=$rowitm["bi_quantity"]*$rowitm["bi_price"]?></td>
<td align="center"><span class="s4" ><?=$rowitm["bi_discount"]?></td>
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
<td align="center"><span class="s4" ><?=$rowitm["bi_total"]?></td>
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
 -->

 <tr><tr><td></td>
 <tr><td></td></tr>
 <tr><td colspan="<?= $m-1?>" align="right"><span class="s4" >TOTAL </td>
 <td align="center"><span class="s4" ><?=$row["be_total"]?></td></tr>
 <tr>
<td colspan="<?= $m-1?>" align="right"><span class="s4" >Freight :</td>
 <td align="center"><span class="s4" ><?=$row["be_coolie"]?></td>
</tr>
 <td colspan="<?= $m-1?>" align="right"><B><span class="s3" >GRAND TOTAL :</td>
 <td align="center"><B><span class="s2" ><?php $total = $row["be_total"]+$row["be_coolie"];echo $total;?></td>
 
</tr>

 
 <td   style="border-bottom: 1px #808080 solid;" colspan="15"><span class="s3" >Grand Total(in words) : <?php $amd=convert_number_to_words($total);echo $amd;?></td>
 

<tr>
<td colspan="15"  style="text-align: center"><span class="s3" >Declaration</span></td>
</tr>
<tr>
<td colspan="15" style="text-align: center"><p><span class="s4" >Certified that all the particulars shown in the above tax invoice
are true and correct.

</SPAN></p></td>
</tr>
<tr>
<td colspan="15"  style="text-align:right"><span class="s3" >Authorised Signatory</SPAN></td>
</tr>
 
</table>
<footer></footer>



<script>

</script>
<link rel="stylesheet" type="text/css" media="print" href="custom/css/print.css" />
<style>
table {
    border-collapse: collapse;
}
table td
{
	height:15px;
}


@media print
{
	@page {width:auto;
	height:50px;}
/*size:250mm 170mm; margin:0;
}*/
.printButtonClass{display:none;}
.table{width:100%;}
<!--.table th{font-size:10px;}-->
.printButtonClass{display:none;}
	.s1{font-size:17px;}
	.s2{font-size:13px;}
	.s3{font-size:12px;}
	.s4{font-size:12px;}
	.s5{font-size:15px;}
	.s6{font-size:9px;}
	.s7{font-size:8px;}
	footer {page-break-after:always;}
	/*font-weight: lighter;*/
}

/*@font-face{font-family:abc;
src: url(includes/dotmat.ttf);}*/
body {font-family:verdana;
}
</style>
</body>
</html>