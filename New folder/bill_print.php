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
	height:10px;
}
@font-face {
   font-family: supreme;
   src: url(includes/SUPRRG.ttf);
}
.supreme{font-family:supreme;}
.fnt td,.fnt th{border:1px solid grey; font-size:12px;}
.nonborder td{border-bottom:1px solid #FFF !important;}
.border td{border:1px solid #000;}

@media print{
.printButtonClass{display:none;}
.table{width:100%;}
.table th{font-size:10px;}
.s1{font-size:27px;}
	.s2{font-size:12px;}
	.s3{font-size:13px;}
	.s4{font-size:20px;}
	.s5{font-size:11px;}
	.s6{font-size:16px;}
	.s7{font-size:8px;}
/*.fnt td{font-size:14px;}*/
.fnt th{font-size:12px;}


}

</style></head>
<body onLoad="window.print()">
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
	$cnt1=$row12["cnt"];
	$r=1;
	$numbill=$cnt1/20;
	$a=intval($numbill);
	$an=$numbill-$a;
	if($an>0)
	{
	$numbill=$numbill+1;
	}
	$ttl=intval($numbill);
}



$profl = $conn->query("SELECT * FROM vm_shopprofile WHERE sp_shopid='".$_SESSION["admin"]."'");
$row3 = $profl->fetch_assoc();
$bill = $conn->query("SELECT * FROM vm_billentry WHERE be_billid='$billid'");
$row4=$bill->fetch_assoc();
$cust= $conn->query("SELECT * FROM vm_customer WHERE cs_customerid='".$row4["be_customerid"]."'");
		$row5=$cust->fetch_assoc();

?>
<table  width="100%" border="0">
  <tr>
    <!--<th style="text-align:left;"><span class="s5">GSTIN : <?=$row3["sp_tin"]?></th>-->
    
    <th style="text-align:right;"><span class="s5">State Code :32, State :Kerala</th>
   
  </tr>
</table>
<table style="text-align:center; border:1px solid #fff;" width="100%" class="nonborder">
	<tr height="">
  	
    <th style="width:150px;"></th><th>
	
   <b><span  > <SPAN class="s1"><span style="letter-spacing:px;"><?=$row3["sp_shopname"]?></span></b><br>
 			<?=$row3["sp_shopaddress"]?><br>
           
            <?=$row3["sp_phone"]?> &nbsp;<?=$row3["sp_mobile"]?><br><?=$row3["sp_email"]?></b></span>
            
			<br><br>TAX INVOICE 
			<?php $stcode_s=$row3["sp_stcode"];?>
    </th><th style="width:150px; text-align:right; padding-right:10px;"></th>
  </tr>
  <tr>
  <td><span class="s5"><B>GSTIN : <?=$row3["sp_tin"]?></B></td> <td></td><td style="text-align:right;"><b>INVOICE NO :<?=$row["be_billnumber"]?></b></td>
  </tr>
</table> 

<table  width="100%" >

<tr style="border-top:1px solid black">
<?php if($_GET['csid']!=0)
{
	$slctcust=$conn->query("SELECT * FROM vm_customer WHERE cs_customerid='".$_GET['csid']."'");
	$rowcus=$slctcust->fetch_assoc();
	?>
<td><span class="s3">To: &nbsp;&nbsp;<?=$rowcus["cs_customername"]?><br>&nbsp;&nbsp;&nbsp;&nbsp;<?= $rowcus['cs_address'] ?></td>
<td><br><span class="s3">E-mail:<?= $rowcus['cs_email'] ?><br>Ph:<?= $rowcus['cs_customerphone'] ?></td>
<td><span class="s3"><b> </td><td align="right"><span class="s3"><b>Date :<?=date('d-m-Y', strtotime($row["be_billdate"]))?></td>


</tr>
<tr>
<td><br><span class="s3">State Code:<?php if($rowcus['cs_statecode']==''){$stcode_c='KL';echo"32";}else{$stcode_c=$rowcus["cs_statecode"];switch($rowcus["cs_statecode"])
		{
			case 'AN':echo "35";break;
			case 'AP':echo "28";break;
			case 'AD':echo "37";break;
			case 'AR':echo "12";break;
			case 'AS':echo "18";break;
			case 'BH':echo "10";break;
			case 'CH':echo "04";break;
			case 'CT':echo "22";break;
			case 'DN':echo "26";break;
			case 'DD':echo "25";break;
			case 'DL':echo "07";break;
			case 'GA':echo "30";break;
			case 'GJ':echo "24";break;
			case 'HR':echo "06";break;
			case 'HP':echo "02";break;
			case 'JK':echo "01";break;
			case 'JH':echo "20";break;
			case 'KA':echo "29";break;
			case 'KL':echo "32";break;
			case 'LD':echo "31";break;
			case 'MP':echo "23";break;
			case 'MH':echo "27";break;
			case 'MN':echo "14";break;
			case 'ME':echo "17";break;
			case 'MI':echo "15";break;
			case 'NL':echo "13";break;
			case 'OR':echo "21";break;
			case 'PY':echo "34";break;
			case 'PB':echo "03";break;
			case 'RJ':echo "06";break;
			case 'SK':echo "11";break;
			case 'TN':echo "33";break;
			case 'TS':echo "36";break;
			case 'TR':echo "16";break;
			case 'UP':echo "09";break;
			case 'UT':echo "05";break;
			case 'WB':echo "19";break;
			
		}}?>, State:<?php if($rowcus["cs_statecode"]=="AN"){echo "Andaman and Nicobar Islands ";}
elseif($rowcus["cs_statecode"]=="AP"){echo "Andhra Pradesh";}
                         elseif($rowcus["cs_statecode"]=="AD"){echo "Andhra Pradesh";}                          		                         		                         elseif($row4["be_statecode"]=="AR"){echo "Arunachal Pradesh";}
                         elseif($rowcus["cs_statecode"]=="AS"){echo "Assam";}
                         elseif($rowcus["cs_statecode"]=="BH"){echo "Bihar";}
                         elseif($rowcus["cs_statecode"]=="CH"){echo "Chandigarh";}
                         elseif($rowcus["cs_statecode"]=="CT"){echo "Chattisgarh";}
                         elseif($rowcus["cs_statecode"]=="DN"){echo "Dadra and Nagar Haveli";}
                         elseif($rowcus["cs_statecode"]=="DD"){echo "Daman and Diu";}
                         elseif($rowcus["cs_statecode"]=="DL"){echo "Delhi";}
                         elseif($rowcus["cs_statecode"]=="GA"){echo "GoA";}
						 elseif($rowcus["cs_statecode"]=="GJ"){echo "Gujarat";}
                         elseif($rowcus["cs_statecode"]=="HR"){echo "Hariyana";}                           
                         elseif($rowcus["cs_statecode"]=="HP"){echo "Himachal Pradesh";}
                         elseif($rowcus["cs_statecode"]=="JK"){echo "Jammu And Kashmir";}
                         elseif($rowcus["cs_statecode"]=="JH"){echo "Jharkhand";}
                         elseif($rowcus["cs_statecode"]=="KA"){echo "Karnataka";}
                         elseif($rowcus["cs_statecode"]=="KL"){echo "Kerala";}
                         elseif($rowcus["cs_statecode"]=="LD"){echo "LakshadWeep Island";}
                         elseif($rowcus["cs_statecode"]=="MP"){echo "Madhya Pradhesh";}
                         elseif($rowcus["cs_statecode"]=="MH"){echo "Maharastra";}
                         elseif($rowcus["cs_statecode"]=="MN"){echo "Manipur";}
                         elseif($rowcus["cs_statecode"]=="ME"){echo "Meghalaya";}
                         elseif($rowcus["cs_statecode"]=="MI"){echo "Mizoram";}                           
                         elseif($rowcus["cs_statecode"]=="NL"){echo "Nagaland";}
                         elseif($rowcus["cs_statecode"]=="OR"){echo "Odisha";}
                         elseif($rowcus["cs_statecode"]=="PY"){echo "Pondicherry";}
                         elseif($rowcus["cs_statecode"]=="PB"){echo "Punjab";}
                         elseif($rowcus["cs_statecode"]=="RJ"){echo "Rajasthan";}                           
                         elseif($rowcus["cs_statecode"]=="SK"){echo "Sikkim";}
                         elseif($rowcus["cs_statecode"]=="TN"){echo "Tamil Nadu";}
                         elseif($rowcus["cs_statecode"]=="TS"){echo "Telangana";}
                         elseif($rowcus["cs_statecode"]=="TR"){echo "Tripura";}
                         elseif($rowcus["cs_statecode"]=="UP"){echo "Uttar Pradesh";}
                         elseif($rowcus["cs_statecode"]=="UI"){echo "Uttarakhand";}
                         elseif($rowcus["cs_statecode"]=="WB"){echo "West Bengal";}
                         else {echo "Kerala";}?>
						 <br> <span class="s3">GSTIN:<?= $rowcus['cs_tin_number'] ?></td>
 <?php } else {?>
<td><span class="s3">To: &nbsp;&nbsp;<?=$row["be_customername"]?><br></td>
<td><br><span class="s3">E-mail:<br>Ph:<?= $row['be_customermobile'] ?></td>
<td><span class="s3"></td><td align="right"><span class="s3"><b>Date :<?=date('d-m-Y', strtotime($row["be_billdate"]))?></td>


</tr>
<tr>
<td><br><span class="s3">State Code: <?php if($row4["be_statecode"]==''){echo"32";$stcode_c='KL';}else{$stcode_c=$row4["be_statecode"];switch($row4["be_statecode"])
		{
			case 'AN':echo "35";break;
			case 'AP':echo "28";break;
			case 'AD':echo "37";break;
			case 'AR':echo "12";break;
			case 'AS':echo "18";break;
			case 'BH':echo "10";break;
			case 'CH':echo "04";break;
			case 'CT':echo "22";break;
			case 'DN':echo "26";break;
			case 'DD':echo "25";break;
			case 'DL':echo "07";break;
			case 'GA':echo "30";break;
			case 'GJ':echo "24";break;
			case 'HR':echo "06";break;
			case 'HP':echo "02";break;
			case 'JK':echo "01";break;
			case 'JH':echo "20";break;
			case 'KA':echo "29";break;
			case 'KL':echo "32";break;
			case 'LD':echo "31";break;
			case 'MP':echo "23";break;
			case 'MH':echo "27";break;
			case 'MN':echo "14";break;
			case 'ME':echo "17";break;
			case 'MI':echo "15";break;
			case 'NL':echo "13";break;
			case 'OR':echo "21";break;
			case 'PY':echo "34";break;
			case 'PB':echo "03";break;
			case 'RJ':echo "06";break;
			case 'SK':echo "11";break;
			case 'TN':echo "33";break;
			case 'TS':echo "36";break;
			case 'TR':echo "16";break;
			case 'UP':echo "09";break;
			case 'UT':echo "05";break;
			case 'WB':echo "19";break;
			
		}}?> <span class="s3">State:<?php if($row4["be_statecode"]=="AN"){echo "Andaman and Nicobar Islands ";}
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
						 
						 <br><span class="s3"> GSTIN:<?= $row['be_customer_tin_num'] ?></td>
 <?php }?>
<td></td>
<td></td>
<td></td></tr>
</table>


<div style="border: 1px #808080 ;" class="nonborder">
<table width="100%" class="fnt" style="border:1px  #808080;">
<tr>
<th  style="width:4%;" bgcolor="#999999"> <span class="s2">SI</th>
<th  bgcolor="#999999" align="left" width="22%"><span class="s2">Commodity/Item</th>
<th  style="width:10%;" bgcolor="#999999"><span class="s2">HSN </th>
<th  style="width:10%;" bgcolor="#999999"><span class="s2">Price</th>
<th  style="width:5%;" bgcolor="#999999"><span class="s2">Qty</th>
<!--<th  width="10%" bgcolor="#999999">UOM</th>-->

<th  style="width:10%;" bgcolor="#999999"><span class="s2">Gross Value</th>
<th  style="width:5%;" bgcolor="#999999"><span class="s2">Dis Amt</th>
<th  style="width:10%;" bgcolor="#999999"><span class="s2">Net Value</th>
<th  style="width:5%;" bgcolor="#999999"><span class="s2">GST %</th>
<th  style="width:8%;" bgcolor="#999999"><span class="s2">GST Amt</th>

<th  style="width:12%;" bgcolor="#999999"><span class="s2">Total</th>
<!--<?php if($stcode_c==$stcode_s)
{?>


<th colspan="2"  style="width:60px;" bgcolor="#999999">CGST</th>
<th  colspan="2"style="width:60px;" bgcolor="#999999">SGST</th>
<?php }else{
?>
<th colspan="2"  style="width:60px;" bgcolor="#999999">IGST</th>
<?php }?>

</tr>
<tr>
<?php if($stcode_c==$stcode_s)
{?><th>Rate</th>
<th>Amt.</th>
<th>Rate</th>
<th>Amt.</th><?php }else{?>
<th>Rate</th>
<th>Amt.</th><?php }?>-->
</tr>
<?php
$k=1;
$j=0;
$tcgst=0;
$tsgst=0;
$tigst=0;
$cg=0;
$sg=0;
$qt=0;
$su=0;
$tt=0;
$grsv=0;
$dsc=0;
$nt=0;
$vt=0;
$gt=0;

$ig=0;
$tigst=0;
$bill2=$conn->query("SELECT * FROM vm_billitems a LEFT JOIN vm_products b ON b.pr_productid=a.bi_productid WHERE a.bi_billid='$billid' LIMIT 20");
$tot=0;
while($row6=$bill2->fetch_assoc()){?>
<tr style="text-align:center;">
	<td><span class="s2"><?php echo $k;?></td>
    
    <td align="left"><span class="s5"><?php echo $row6['pr_productname'];?></td>
    <td border-bottom="0"><span class="s2"><?php echo $row6['pr_hsn'];?></td>
	<td><span class="s2"><?php echo $row6['bi_price'];?></td>
    <td><span class="s2"><?php echo $row6['bi_quantity'];?></td>
    <!--<td><?php echo $row6['pr_unit'];?></td>-->
    
    <td><span class="s2"><?php $gv=($row6['bi_price']*$row6['bi_quantity']); echo $gv;?></td>
	 <td><span class="s2"><?php echo $row6['bi_discount'];?></td>
	  <td><span class="s2"><?php echo $dis=($gv-$row6['bi_discount']);?></td>
    <td><span class="s2"><?php echo $row6['bi_vatper']?></td>
    <td><span class="s2"><?php echo $row6['bi_vatamount']?></td>
    <td><span class="s2"><?php echo $row6['bi_total']?></td>
</tr>
<?php
	$qt=$qt+$row6['bi_quantity'];
	$su=$su+$row6['bi_price'];
	$p= $row6['bi_taxamount']; 
	$grsv=$grsv+$gv;
	$dsc=$dsc+$row6['bi_discount'];
	$nt=$nt+$dis;
	$vt=$vt+$row6['bi_vatamount'];
	$gt=$gt+$row6['bi_total'];
	
	$cg=$cg+$row6['bi_cgst_amt'];
	$sg=$sg+$row6['bi_sgst_amt'];
	$ig=$ig+$row6['bi_igst_amt'];
?>
<?php $k++; }
while($k<=20)
{?>
<tr style="border-bottom:0px solid white;"><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>


<?php $k++;}?>

<tr style="border: 2px #000 ">

 <td style="border-top: 2px #000 solid;border-bottom: 2px #000 solid; text-align:right;" colspan="2" align="right"><h3><b>Total: </b></h3></td>
 <td style="border-top: 2px #000 solid;border-bottom: 2px #000 solid;"></td>
 <td style="border-top: 2px #000 solid; text-align:center;"></td>
 <td style="border-top: 2px #000 solid; text-align:center;"><?php echo $qt;?></td>
  <td style="border-top: 2px #000 solid; text-align:center;"><?php echo $grsv;?></td> 
 <td style="border-top: 2px #000 solid; text-align:center;"><?php echo $dsc;?></td>
 <td style="border-top: 2px #000 solid; text-align:center;"><?php echo $nt;?></td>
 <td style="border-top: 2px #000 solid; text-align:center;"></td>
 <td style="border-top: 2px #000 solid; text-align:center;"><?php echo $vt;?></td>
 <td style="border-top: 2px #000 solid; text-align:center;"><?php echo $gt;?></td>
 
 
 
 
 </tr>
 <?php if($r==$ttl){?>
 <!--<tr style="border: 2px #808080 solid; text-align:left;" >
 
 <td width="100%" colspan="6" rowspan="4">
  <b>Total Invoice Amount in Words</b><br/>     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Rupees <?php $gtotl=($tt); $amd=convert_number_to_words($row4['be_gtotal']);echo $amd;?></td></b>
  <td colspan="4" width="100%" align="center">
  <b>CGST</b>
  </td>
  <td align="center">
  <b><?php echo $cg; ?></b>
  </td>
  </tr>
  
 <tr style="border: 2px #808080 solid;">
 <td colspan="4" align="center">
 <b>SGST</b>
 </td>
 <td align="center">
 <b><?php echo $sg; ?></b>
 </td>
 </tr>
 <tr style="border: 2px #808080 solid;">
 <td colspan="4" align="center">
 <b>IGST</b>
 </td>
 <td align="center">
 <b><?php echo $ig; ?></b>
 </td>
 </tr>
 <tr style="border: 2px #808080 solid;">
 <td colspan="4" align="center">
 <b>Freight</b>
 </td>
 <td align="center">
 <b><?= $row['be_coolie'] ?></b>
 </td>
 </tr>
 <tr style="border: 2px #808080 solid;">
 <td colspan="10" align="center">
 <b>Grant Total</b>
 </td>
 <td align="center">
 <b><?=$row4["be_gtotal"]?></b>
 </td>
 </tr>
 <tr style="border: 2px #808080 solid;">
 <td colspan="2" rowspan="3">
 <b>Bank Details<br>Bank Account Number: <?=$row4["be_accno"]?></b><br><b>Bank Branch IFSC <?=$row4["be_ifsc"]?></b>
 </td>
 <td rowspan="3" align="center">
 Seal
 </td>
 <!--<td colspan="9">
<b>GST payable on Reverse Charge</b>
 </td>
 
 </tr>
 <tr style="border: 2px #808080 solid;">
 <td colspan="10">
 <b>Certified that the particulars given above are true and correct.</b><br>
 </td>
 </tr>
 <tr>
 <td colspan="10" align="right" style="border-top:2px solid #FFF;">
<br> <b>Authorized Signature</b>
 </td>
 </tr>-->
 
 <!--<tr style="border: 2px #808080 solid;">
 <td colspan="5" style="border-right:2px solid #FFF">
<b> Certified that the Particulars given above are true and correct</b>
 </td>
 <td colspan="4" >
 For <b><?=$row3["sp_shopname"]?></b><br><br> Authorised Signature
 </td>
 </tr>-->
 </table>
 </div>
 <!--<div style="border: 1px #808080 solid;margin-bottom:0px;" class="border">
 <table width=100% style="display:none;">
  
 <tr >
 <td colspan="3" style="border-bottom:2px solid #000;" >
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:Bank Details:<br>Bank Account Number:<br>Bank Branch IFSC
 </td>
 <td colspan="3" style="border-bottom:1px solid #FFF;">
 </td>
 <td colspan="3">
 </td>
 </tr>
 <tr align="center" >
 <td border-top="1px solid #000" colspan="3">
 <b>:Terms and Conditions:</b>
 </td>
 <td colspan="3">
 (Common Seal)
 </td>
 <td colspan="3">
 Certified that the particulars given above are true and correct<br>
 <h3 align="center"><?=$row3["sp_shopname"]?></h3><br>
 Authorised Signatory
 </td>
 </tr>
 </table>
 </div>--> 
 

 
  
  
  
 <!-- <div style="border: 1px #808080 solid;margin-bottom:5px;" class="border">
 <table width=100%>
  
  
 <tr>
  <td colspan="8" align="right"><b>Amount of Tax Subject to Reverse Charge</b></td>
  <td colspan="3" ></td>
  <td colspan="2"></td>
  </tr>-->
  <!--<tr>
  <td  colspan="6" align="center">
  Certified that the Particular given above are true and correct
  </td>
  <td colspan="7">
  Electronic Reference Number
  </td>
  </tr>-->
  <!--<tr>
  <td colspan="6"></td>
  <td colspan="7"></td>
  </tr>-->
 <!-- <tr>
  <td align="left" colspan="6">
  Remarks,if any<br><br><br><br>
  </td>  
  <td colspan="7">
  <h6 align="right"><?=$row3["sp_shopname"]?><br><br><br>Authorized Signature</h6>
  Name<br/>
  Designation
  </td>-->
  <table style="padding-top:0px;" width="100%" border="1"><tr>
  
  <td style="width: 50%;border-right: hidden" ><table width="100%"><tr><td><span class="s5"><u>GST Slab &nbsp;</u><br>5%<br>12%<br>18%<br>28%</td><td><span class="s5">&nbsp;<u>Taxable Amt</u><br><?php $slctsgst5t=$conn->query("select sum(bi_taxamount) as 5tax from vm_billitems where bi_vatper='5' and bi_billid='$billid'"); $rowitm5t=$slctsgst5t->fetch_assoc();
 $sgst5t=$rowitm5t["5tax"];
 if($sgst5t==''){ echo '0';}else{ echo round($sgst5t, 2);}?><br><?php $slctsgst12t=$conn->query("select sum(bi_taxamount) as 12tax from vm_billitems where bi_vatper='12' and bi_billid='$billid'"); $rowitm12t=$slctsgst12t->fetch_assoc();
 $sgst12t=$rowitm12t["12tax"];
 if($sgst12t==''){ echo '0';}else{ echo round($sgst12t, 2);}?><br><?php $slctsgst18t=$conn->query("select sum(bi_taxamount) as 18tax from vm_billitems where bi_vatper='18' and bi_billid='$billid'"); $rowitm18t=$slctsgst18t->fetch_assoc();
 $sgst18t=$rowitm18t["18tax"];
 if($sgst18t==''){ echo '0';}else{ echo round($sgst18t, 2);}?><br><?php $slctsgst28t=$conn->query("select sum(bi_taxamount) as 28tax from vm_billitems where bi_vatper='28' and bi_billid='$billid'"); $rowitm28t=$slctsgst28t->fetch_assoc();
 $sgst28t=$rowitm28t["28tax"];
 if($sgst28t==''){ echo '28';}else{ echo round($sgst28t, 2);}?><br></td><td><span class="s5">&nbsp;<u>SGST</u/><br>2.5% - <?php $slctsgst=$conn->query("select sum(bi_sgst_amt) as sgst from vm_billitems where bi_sgst='2.5' and bi_billid='$billid'"); $rowitm=$slctsgst->fetch_assoc();
 $sgst=$rowitm["sgst"];
if($sgst==''){ echo '';}else{ echo round($sgst, 2);} ?><br>6% -<?php $slctsgst12=$conn->query("select sum(bi_sgst_amt) as sgst from vm_billitems where bi_sgst='6' and bi_billid='$billid'"); $rowitm12=$slctsgst12->fetch_assoc();
 $sgst12=$rowitm12["sgst"];
 if($sgst12==''){ echo '';}else{ echo round($sgst12, 2);}?><br>9% -<?php $slctsgst18=$conn->query("select sum(bi_sgst_amt) as sgst from vm_billitems where bi_sgst='9' and bi_billid='$billid'"); $rowitm18=$slctsgst18->fetch_assoc();
 $sgst18=$rowitm18["sgst"];
 if($sgst18==''){ echo '';}else{ echo round($sgst18, 2);}?><br>14% -<?php $slctsgst28=$conn->query("select sum(bi_sgst_amt) as sgst from vm_billitems where bi_sgst='14' and bi_billid='$billid'"); $rowitm28=$slctsgst28->fetch_assoc();
 $sgst28=$rowitm28["sgst"];
 if($sgst28==''){ echo '';}else{ echo round($sgst28, 2);} ?></td><td><span class="s5">&nbsp;<u>CGST</u><br>2.5% - <?php if($sgst==''){ echo '';}else{ echo round($sgst, 2);}  ?><br>6% -<?php if($sgst12==''){ echo '';}else{ echo round($sgst12, 2);}  ?><br>9% -<?php if($sgst18==''){ echo '';}else{ echo round($sgst18, 2);} ?><br>14% -<?php if($sgst28==''){ echo '';}else{ echo round($sgst28, 2);}  ?></td></tr></table></td>
  <td style="width: 50%;"><table width="100%"><tr><td align="right"><b>Bill Amount</b></td><td align="right"><b><?=$row4["be_gtotal"]?>.00 &nbsp;</b></td></tr></table></td>
  </tr></table>
  
  <table width="100%" ><tr><td style="border-bottom: 1px #000000 solid;"><span class="s5">
  Rupees <?php $gtotl=($tt); $amd=convert_number_to_words($row4['be_gtotal']);echo $amd;?><br><br>
  Bank Details<br>
  Name :<?=$row3["sp_bank"]?>
  <br>A/C No :<?=$row3["sp_accno"]?> 
  <br>Branch :<?=$row3["sp_branch"]?>
  <br>IFSC :<?=$row3["sp_ifsc"]?></span><td>
  <td style="border-bottom: 1px #000000 solid;text-align:right"><span class="s5"><br>For &nbsp; <b><?=$row3["sp_shopname"]?></b><br><br><br><br><br><br><br><span class="s5">Authorised Signatory</td></tr>
  </table>
  
  
<?php }else{?>
<table width="100%" style="border-top: 1px #000000 solid;" >

<tr>
    <td colspan="<?=$clmspan+7?>" style="text-align:right; border-bottom:1px solid #fff">&nbsp;</td>
</tr>
<tr>
    <td colspan="<?=$clmspan+7?>" style="text-align:right; border-bottom:1px solid #fff">&nbsp;</td>
</tr>
<tr>
    <td colspan="<?=$clmspan+7?>" style="text-align:right; border-bottom:1px solid #fff">&nbsp;</td>
</tr>
<tr>
    <td colspan="<?=$clmspan+7?>" style="text-align:right; border-bottom:1px solid #fff">&nbsp;</td>
</tr>


<tr>
    <td colspan="<?=$clmspan+7?>" style="text-align:right">Continue..</td>
</tr>
<tr>
    <td colspan="<?=$clmspan+7?>" style="text-align:right; border-bottom:1px solid #fff">&nbsp;</td>
</tr>
</table>
<?php }?>
</table>
</div>
<?php 
$j=0;
$j=$j+20;
while($cnt1>$j)
{
	$r++;	
$slctitm1=$conn->query("SELECT * FROM vm_billitems a LEFT JOIN vm_products b ON b.pr_productid=a.bi_productid WHERE a.bi_billid='$billid' LIMIT ".$j.",20");
if($slctitm1->num_rows>0)
{
?>
<table  width="100%" border="0">
  <tr>
    <!--<th style="text-align:left;"><span class="s5">GSTIN : <?=$row3["sp_tin"]?></th>-->
    
    <th style="text-align:right;"><span class="s5">State Code :32, State :Kerala</th>
   
  </tr>
</table>
<table style="text-align:center; border:1px solid #fff;" width="100%" class="nonborder">
	<tr height="">
  	
    <th style="width:150px;"></th><th>
	
   <b><span  > <SPAN class="s1"><span style="letter-spacing:px;"><?=$row3["sp_shopname"]?></span></b><br>
 			<?=$row3["sp_shopaddress"]?><br>
           
            <?=$row3["sp_phone"]?> &nbsp;<?=$row3["sp_mobile"]?><br><?=$row3["sp_email"]?></b></span>
            
			<br><br>TAX INVOICE - CREDIT
			<?php $stcode_s=$row3["sp_stcode"];?>
    </th><th style="width:150px; text-align:right; padding-right:10px;"></th>
  </tr>
  <tr>
  <td><span class="s5"><B>GSTIN : <?=$row3["sp_tin"]?></B></td> <td></td><td style="text-align:right;"><b>INVOICE NO :<?=$row["be_billnumber"]?></b></td>
  </tr>
</table> 
<table  width="100%" >

<tr style="border-top:1px solid black">
<?php if($_GET['csid']!=0)
{
	$slctcust=$conn->query("SELECT * FROM vm_customer WHERE cs_customerid='".$_GET['csid']."'");
	$rowcus=$slctcust->fetch_assoc();
	?>
<td><span class="s3">To: &nbsp;&nbsp;<?=$rowcus["cs_customername"]?><br>&nbsp;&nbsp;&nbsp;&nbsp;<?= $rowcus['cs_address'] ?></td>
<td><br><span class="s3">E-mail:<?= $rowcus['cs_email'] ?><br>Ph:<?= $rowcus['cs_customerphone'] ?></td>
<td><span class="s3"></td><td align="right"><span class="s3"><b>Date :<?=date('d-m-Y', strtotime($row["be_billdate"]))?></td>


</tr>
<tr>
<td><br><span class="s3">State Code:<?php if($rowcus['cs_statecode']==''){$stcode_c='KL';echo"32";}else{$stcode_c=$rowcus["cs_statecode"];switch($rowcus["cs_statecode"])
		{
			case 'AN':echo "35";break;
			case 'AP':echo "28";break;
			case 'AD':echo "37";break;
			case 'AR':echo "12";break;
			case 'AS':echo "18";break;
			case 'BH':echo "10";break;
			case 'CH':echo "04";break;
			case 'CT':echo "22";break;
			case 'DN':echo "26";break;
			case 'DD':echo "25";break;
			case 'DL':echo "07";break;
			case 'GA':echo "30";break;
			case 'GJ':echo "24";break;
			case 'HR':echo "06";break;
			case 'HP':echo "02";break;
			case 'JK':echo "01";break;
			case 'JH':echo "20";break;
			case 'KA':echo "29";break;
			case 'KL':echo "32";break;
			case 'LD':echo "31";break;
			case 'MP':echo "23";break;
			case 'MH':echo "27";break;
			case 'MN':echo "14";break;
			case 'ME':echo "17";break;
			case 'MI':echo "15";break;
			case 'NL':echo "13";break;
			case 'OR':echo "21";break;
			case 'PY':echo "34";break;
			case 'PB':echo "03";break;
			case 'RJ':echo "06";break;
			case 'SK':echo "11";break;
			case 'TN':echo "33";break;
			case 'TS':echo "36";break;
			case 'TR':echo "16";break;
			case 'UP':echo "09";break;
			case 'UT':echo "05";break;
			case 'WB':echo "19";break;
			
		}}?>, State:<?php if($rowcus["cs_statecode"]=="AN"){echo "Andaman and Nicobar Islands ";}
elseif($rowcus["cs_statecode"]=="AP"){echo "Andhra Pradesh";}
                         elseif($rowcus["cs_statecode"]=="AD"){echo "Andhra Pradesh";}                          		                         		                         elseif($row4["be_statecode"]=="AR"){echo "Arunachal Pradesh";}
                         elseif($rowcus["cs_statecode"]=="AS"){echo "Assam";}
                         elseif($rowcus["cs_statecode"]=="BH"){echo "Bihar";}
                         elseif($rowcus["cs_statecode"]=="CH"){echo "Chandigarh";}
                         elseif($rowcus["cs_statecode"]=="CT"){echo "Chattisgarh";}
                         elseif($rowcus["cs_statecode"]=="DN"){echo "Dadra and Nagar Haveli";}
                         elseif($rowcus["cs_statecode"]=="DD"){echo "Daman and Diu";}
                         elseif($rowcus["cs_statecode"]=="DL"){echo "Delhi";}
                         elseif($rowcus["cs_statecode"]=="GA"){echo "GoA";}
						 elseif($rowcus["cs_statecode"]=="GJ"){echo "Gujarat";}
                         elseif($rowcus["cs_statecode"]=="HR"){echo "Hariyana";}                           
                         elseif($rowcus["cs_statecode"]=="HP"){echo "Himachal Pradesh";}
                         elseif($rowcus["cs_statecode"]=="JK"){echo "Jammu And Kashmir";}
                         elseif($rowcus["cs_statecode"]=="JH"){echo "Jharkhand";}
                         elseif($rowcus["cs_statecode"]=="KA"){echo "Karnataka";}
                         elseif($rowcus["cs_statecode"]=="KL"){echo "Kerala";}
                         elseif($rowcus["cs_statecode"]=="LD"){echo "LakshadWeep Island";}
                         elseif($rowcus["cs_statecode"]=="MP"){echo "Madhya Pradhesh";}
                         elseif($rowcus["cs_statecode"]=="MH"){echo "Maharastra";}
                         elseif($rowcus["cs_statecode"]=="MN"){echo "Manipur";}
                         elseif($rowcus["cs_statecode"]=="ME"){echo "Meghalaya";}
                         elseif($rowcus["cs_statecode"]=="MI"){echo "Mizoram";}                           
                         elseif($rowcus["cs_statecode"]=="NL"){echo "Nagaland";}
                         elseif($rowcus["cs_statecode"]=="OR"){echo "Odisha";}
                         elseif($rowcus["cs_statecode"]=="PY"){echo "Pondicherry";}
                         elseif($rowcus["cs_statecode"]=="PB"){echo "Punjab";}
                         elseif($rowcus["cs_statecode"]=="RJ"){echo "Rajasthan";}                           
                         elseif($rowcus["cs_statecode"]=="SK"){echo "Sikkim";}
                         elseif($rowcus["cs_statecode"]=="TN"){echo "Tamil Nadu";}
                         elseif($rowcus["cs_statecode"]=="TS"){echo "Telangana";}
                         elseif($rowcus["cs_statecode"]=="TR"){echo "Tripura";}
                         elseif($rowcus["cs_statecode"]=="UP"){echo "Uttar Pradesh";}
                         elseif($rowcus["cs_statecode"]=="UI"){echo "Uttarakhand";}
                         elseif($rowcus["cs_statecode"]=="WB"){echo "West Bengal";}
                         else {echo "Kerala";}?>
						 <br> <span class="s3">GSTIN:<?= $rowcus['cs_tin_number'] ?></td>
 <?php } else {?>
<td><span class="s3">To: &nbsp;&nbsp;<?=$row["be_customername"]?><br></td>
<td><br><span class="s3">E-mail:<br>Ph:<?= $row['be_customermobile'] ?></td>
<td><span class="s3"> </td><td align="right"><span class="s3"><b>Date :<?=date('d-m-Y', strtotime($row["be_billdate"]))?></td>


</tr>
<tr>
<td><br><span class="s3">State Code: <?php if($row4["be_statecode"]==''){echo"32";$stcode_c='KL';}else{$stcode_c=$row4["be_statecode"];switch($row4["be_statecode"])
		{
			case 'AN':echo "35";break;
			case 'AP':echo "28";break;
			case 'AD':echo "37";break;
			case 'AR':echo "12";break;
			case 'AS':echo "18";break;
			case 'BH':echo "10";break;
			case 'CH':echo "04";break;
			case 'CT':echo "22";break;
			case 'DN':echo "26";break;
			case 'DD':echo "25";break;
			case 'DL':echo "07";break;
			case 'GA':echo "30";break;
			case 'GJ':echo "24";break;
			case 'HR':echo "06";break;
			case 'HP':echo "02";break;
			case 'JK':echo "01";break;
			case 'JH':echo "20";break;
			case 'KA':echo "29";break;
			case 'KL':echo "32";break;
			case 'LD':echo "31";break;
			case 'MP':echo "23";break;
			case 'MH':echo "27";break;
			case 'MN':echo "14";break;
			case 'ME':echo "17";break;
			case 'MI':echo "15";break;
			case 'NL':echo "13";break;
			case 'OR':echo "21";break;
			case 'PY':echo "34";break;
			case 'PB':echo "03";break;
			case 'RJ':echo "06";break;
			case 'SK':echo "11";break;
			case 'TN':echo "33";break;
			case 'TS':echo "36";break;
			case 'TR':echo "16";break;
			case 'UP':echo "09";break;
			case 'UT':echo "05";break;
			case 'WB':echo "19";break;
			
		}}?> <span class="s3">State:<?php if($row4["be_statecode"]=="AN"){echo "Andaman and Nicobar Islands ";}
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
						 
						 <br><span class="s3"> GSTIN:<?= $row['be_customer_tin_num'] ?></td>
 <?php }?>
<td></td>
<td></td>
<td></td></tr>
</table>

<?php 
if($stcode_c==$stcode_s)
{
	$clmspan='7';
}else{$clmspan='5';}
?>
<div style="border: 1px #808080 ;" class="nonborder">
<table width="100%" class="fnt" style="border:1px  #808080;">
<tr>
<th  style="width:4%;" bgcolor="#999999"> <span class="s2">SI</th>
<th  bgcolor="#999999" align="left" width="22%"><span class="s2">Commodity/Item</th>
<th  style="width:10%;" bgcolor="#999999"><span class="s2">HSN </th>
<th  style="width:10%;" bgcolor="#999999"><span class="s2">Price</th>
<th  style="width:5%;" bgcolor="#999999"><span class="s2">Qty</th>
<!--<th  width="10%" bgcolor="#999999">UOM</th>-->

<th  style="width:10%;" bgcolor="#999999"><span class="s2">Gross Value</th>
<th  style="width:5%;" bgcolor="#999999"><span class="s2">Dis Amt</th>
<th  style="width:10%;" bgcolor="#999999"><span class="s2">Net Value</th>
<th  style="width:5%;" bgcolor="#999999"><span class="s2">GST %</th>
<th  style="width:8%;" bgcolor="#999999"><span class="s2">GST Amt</th>

<th  style="width:12%;" bgcolor="#999999"><span class="s2">Total</th>
<!--<?php 
if($stcode_c==$stcode_s)
{?>
<th colspan="2"  style="width:100px;" bgcolor="#999999">CGST</th>
<th  colspan="2"style="width:100px;" bgcolor="#999999">SGST</th><?php }else{?>
<th colspan="2"  style="width:100px;" bgcolor="#999999">IGST</th><?php }?>

</tr>
<tr>
<?php 
if($stcode_c==$stcode_s)
{?>
<th>Rate</th>
<th>Amt.</th>
<th>Rate</th>
<th>Amt.</th><?php }else{?>
<th>Rate</th>
<th>Amt.</th><?php }?>-->
</tr>
<?php

//$j=0;

$bill2=$conn->query("SELECT * FROM vm_billitems a LEFT JOIN vm_products b ON b.pr_productid=a.bi_productid WHERE a.bi_billid='$billid' LIMIT ".$j.",20");

while($row6=$bill2->fetch_assoc()){?>
<tr style="text-align:center;">
	<td><span class="s2"><?php echo $k;?></td>
    
    <td align="left"><span class="s5"><?php echo $row6['pr_productname'];?></td>
    <td border-bottom="0"><span class="s2"><?php echo $row6['pr_hsn'];?></td>
	<td><span class="s2"><?php echo $row6['bi_price'];?></td>
    <td><span class="s2"><?php echo $row6['bi_quantity'];?></td>
    <!--<td><?php echo $row6['pr_unit'];?></td>-->
    
    <td><span class="s2"><?php $gv=($row6['bi_price']*$row6['bi_quantity']); echo $gv;?></td>
	 <td><span class="s2"><?php echo $row6['bi_discount'];?></td>
	  <td><span class="s2"><?php echo $dis=($gv-$row6['bi_discount']);?></td>
    <td><span class="s2"><?php echo $row6['bi_vatper']?></td>
    <td><span class="s2"><?php echo $row6['bi_vatamount']?></td>
    <td><span class="s2"><?php echo $row6['bi_total']?></td>
</tr>
<?php
	$qt=$qt+$row6['bi_quantity'];
	$su=$su+$row6['bi_price'];
	$p= $row6['bi_taxamount']; 
	$grsv=$grsv+$gv;
	$dsc=$dsc+$row6['bi_discount'];
	$nt=$nt+$dis;
	$vt=$vt+$row6['bi_vatamount'];
	$gt=$gt+$row6['bi_total'];
	
	$cg=$cg+$row6['bi_cgst_amt'];
	$sg=$sg+$row6['bi_sgst_amt'];
	$ig=$ig+$row6['bi_igst_amt'];
?>
<?php $k++; }
while($k<=20)
{?>
<tr style="border-bottom:0px solid white;"><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>


<?php $k++;}?>
<tr style="border: 2px #000 ">

 <td style="border-top: 2px #000 solid;border-bottom: 2px #000 solid; text-align:right;" colspan="2" align="right"><h3><b>Total: </b></h3></td>
 <td style="border-top: 2px #000 solid;border-bottom: 2px #000 solid;"></td>
 <td style="border-top: 2px #000 solid; text-align:center;"></td>
 <td style="border-top: 2px #000 solid; text-align:center;"><?php echo $qt;?></td>
  <td style="border-top: 2px #000 solid; text-align:center;"><?php echo $grsv;?></td> 
 <td style="border-top: 2px #000 solid; text-align:center;"><?php echo $dsc;?></td>
 <td style="border-top: 2px #000 solid; text-align:center;"><?php echo $nt;?></td>
 <td style="border-top: 2px #000 solid; text-align:center;"></td>
 <td style="border-top: 2px #000 solid; text-align:center;"><?php echo $vt;?></td>
 <td style="border-top: 2px #000 solid; text-align:center;"><?php echo $gt;?></td>
 
 
 
 
 </tr>
 <?php if($r==$ttl){?>
 <!--<tr style="border: 2px #808080 solid; text-align:left;" >
 
 <td width="100%" colspan="6" rowspan="4">
  <b>Total Invoice Amount in Words</b><br/>     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Rupees <?php $gtotl=($tt); $amd=convert_number_to_words($row4['be_gtotal']);echo $amd;?></td></b>
  <td colspan="4" width="100%" align="center">
  <b>CGST</b>
  </td>
  <td align="center">
  <b><?php echo $cg; ?></b>
  </td>
  </tr>
  
 <tr style="border: 2px #808080 solid;">
 <td colspan="4" align="center">
 <b>SGST</b>
 </td>
 <td align="center">
 <b><?php echo $sg; ?></b>
 </td>
 </tr>
 <tr style="border: 2px #808080 solid;">
 <td colspan="4" align="center">
 <b>IGST</b>
 </td>
 <td align="center">
 <b><?php echo $ig; ?></b>
 </td>
 </tr>
 <tr style="border: 2px #808080 solid;">
 <td colspan="4" align="center">
 <b>Freight</b>
 </td>
 <td align="center">
 <b><?= $row['be_coolie'] ?></b>
 </td>
 </tr>
 <tr style="border: 2px #808080 solid;">
 <td colspan="10" align="center">
 <b>Grant Total</b>
 </td>
 <td align="center">
 <b></b>
 </td>
 </tr>
 <tr style="border: 2px #808080 solid;">
 <td colspan="2" rowspan="3">
 <b>Bank Details<br>Bank Account Number: <?=$row4["be_accno"]?></b><br><b>Bank Branch IFSC <?=$row4["be_ifsc"]?></b>
 </td>
 <td rowspan="3" align="center">
 Seal</td>
 <!--<td colspan="9">
<b>GST payable on Reverse Charge</b>
 </td>
 
 </tr>
 <tr style="border: 2px #808080 solid;">
 <td colspan="10">
 <b>Certified that the particulars given above are true and correct.</b><br>
 </td>
 </tr>
 <tr>
 <td colspan="10" align="right" style="border-top:2px solid #FFF;">
<br> <b>Authorized Signature</b>
 </td>
 </tr>-->
 
 <!--<tr style="border: 2px #808080 solid;">
 <td colspan="5" style="border-right:2px solid #FFF">
<b> Certified that the Particulars given above are true and correct</b>
 </td>
 <td colspan="4" >
 For <b><?=$row3["sp_shopname"]?></b><br><br> Authorised Signature
 </td>
 </tr>-->
 </table>
 </div>
 <!--<div style="border: 1px #808080 solid;margin-bottom:0px;" class="border">
 <table width=100% style="display:none;">
  
 <tr >
 <td colspan="3" style="border-bottom:2px solid #000;" >
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:Bank Details:<br>Bank Account Number:<br>Bank Branch IFSC
 </td>
 <td colspan="3" style="border-bottom:1px solid #FFF;">
 </td>
 <td colspan="3">
 </td>
 </tr>
 <tr align="center" >
 <td border-top="1px solid #000" colspan="3">
 <b>:Terms and Conditions:</b>
 </td>
 <td colspan="3">
 (Common Seal)
 </td>
 <td colspan="3">
 Certified that the particulars given above are true and correct<br>
 <h3 align="center"><?=$row3["sp_shopname"]?></h3><br>
 Authorised Signatory
 </td>
 </tr>
 </table>
 </div>
<!--<tr>
	<td style="border-top: 2px #808080 solid" colspan="9"></td>-->
    
<!--<div style="border: 1px #808080 solid;margin-bottom:0px;" class="border">
 <table width=100%>
  
 <tr >
 <td colspan="3" style="border-bottom:2px solid #000;" >
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:Bank Details:<br>Bank Account Number:<br>Bank Branch IFSC
 </td>
 <td colspan="3" style="border-bottom:1px solid #FFF;">
 </td>
 <td colspan="3">
 </td>
 </tr>
 <tr align="center" >
 <td border-top="1px solid #000" colspan="3">
 <b>:Terms and Conditions:</b>
 </td>
 <td colspan="3">
 (Common Seal)
 </td>
 <td colspan="3">
 Certified that the particulars given above are true and correct<br>
 <h3 align="center"><?=$row3["sp_shopname"]?></h3><br>
 Authorised Signatory
 </td>
 </tr>
 </table>
 </div> -->
 
 
<!-- </tr>
  <tr rowspan="4" >
  <td colspan="8">
  <b>Amnt. in Words:</b><br/>     Rupees <?php $gtotl=($row["be_total"]); $amd=convert_number_to_words($gtotl);echo $amd;?></td>
  </td>
  <td colspan="3" align="right">
  <b>Total</b><br/>Rounded Off<br/>Loading<br/><br/><br/><b>Invoice Total</b>
  </td>
  <td colspan="2" align="right">
  <b><?php echo $row4['be_total'];?></b><br/>
  <?php echo round($row4['be_total']);?><br/>
  <?php echo $row4['be_coolie'];?><br/><br/><br/><b><?php echo $row4['be_gtotal'];?>
  </tr>
  <tr>
  <td colspan="8" align="right"><b>Amount of Tax Subject to Reverse Charge</b></td>
  <td colspan="3" ></td>
  <td colspan="2"></td>
  </tr>
  <tr>
  <td  colspan="6" align="center">
  Certified that the Particular given above are true and correct
  </td>
  <td colspan="7">
  Electronic Reference Number
  </td>
  </tr>
  <tr>
  <td colspan="6"></td>
  <td colspan="7"></td>
  </tr>
  <tr>
  <td align="left" colspan="6">
  Remarks,if any<br><br><br><br>
  </td>  
  <td colspan="7">
  <h6 align="right"><?=$row3["sp_shopname"]?><br><br><br>Authorized Signature</h6>
  Name<br/>
  Designation
  </td>-->
  <table style="padding-top:0px;" width="100%" border="1"><tr>
  
  <td style="width: 50%;border-right: hidden" ><table width="100%"><tr><td><span class="s5"><u>GST Slab &nbsp;</u><br>5%<br>12%<br>18%<br>28%</td><td><span class="s5">&nbsp;<u>Taxable Amt</u><br><?php $slctsgst5t=$conn->query("select sum(bi_taxamount) as 5tax from vm_billitems where bi_vatper='5' and bi_billid='$billid'"); $rowitm5t=$slctsgst5t->fetch_assoc();
 $sgst5t=$rowitm5t["5tax"];
 if($sgst5t==''){ echo '0';}else{ echo round($sgst5t, 2);}?><br><?php $slctsgst12t=$conn->query("select sum(bi_taxamount) as 12tax from vm_billitems where bi_vatper='12' and bi_billid='$billid'"); $rowitm12t=$slctsgst12t->fetch_assoc();
 $sgst12t=$rowitm12t["12tax"];
 if($sgst12t==''){ echo '0';}else{ echo round($sgst12t, 2);}?><br><?php $slctsgst18t=$conn->query("select sum(bi_taxamount) as 18tax from vm_billitems where bi_vatper='18' and bi_billid='$billid'"); $rowitm18t=$slctsgst18t->fetch_assoc();
 $sgst18t=$rowitm18t["18tax"];
 if($sgst18t==''){ echo '0';}else{ echo round($sgst18t, 2);}?><br><?php $slctsgst28t=$conn->query("select sum(bi_taxamount) as 28tax from vm_billitems where bi_vatper='28' and bi_billid='$billid'"); $rowitm28t=$slctsgst28t->fetch_assoc();
 $sgst28t=$rowitm28t["28tax"];
 if($sgst28t==''){ echo '28';}else{ echo round($sgst28t, 2);}?><br></td><td><span class="s5">&nbsp;<u>SGST</u/><br>2.5% - <?php $slctsgst=$conn->query("select sum(bi_sgst_amt) as sgst from vm_billitems where bi_sgst='2.5' and bi_billid='$billid'"); $rowitm=$slctsgst->fetch_assoc();
 $sgst=$rowitm["sgst"];
if($sgst==''){ echo '';}else{ echo round($sgst, 2);} ?><br>6% -<?php $slctsgst12=$conn->query("select sum(bi_sgst_amt) as sgst from vm_billitems where bi_sgst='6' and bi_billid='$billid'"); $rowitm12=$slctsgst12->fetch_assoc();
 $sgst12=$rowitm12["sgst"];
 if($sgst12==''){ echo '';}else{ echo round($sgst12, 2);}?><br>9% -<?php $slctsgst18=$conn->query("select sum(bi_sgst_amt) as sgst from vm_billitems where bi_sgst='9' and bi_billid='$billid'"); $rowitm18=$slctsgst18->fetch_assoc();
 $sgst18=$rowitm18["sgst"];
 if($sgst18==''){ echo '';}else{ echo round($sgst18, 2);}?><br>14% -<?php $slctsgst28=$conn->query("select sum(bi_sgst_amt) as sgst from vm_billitems where bi_sgst='14' and bi_billid='$billid'"); $rowitm28=$slctsgst28->fetch_assoc();
 $sgst28=$rowitm28["sgst"];
 if($sgst28==''){ echo '';}else{ echo round($sgst28, 2);} ?></td><td><span class="s5">&nbsp;<u>CGST</u><br>2.5% - <?php if($sgst==''){ echo '';}else{ echo round($sgst, 2);}  ?><br>6% -<?php if($sgst12==''){ echo '';}else{ echo round($sgst12, 2);}  ?><br>9% -<?php if($sgst18==''){ echo '';}else{ echo round($sgst18, 2);} ?><br>14% -<?php if($sgst28==''){ echo '';}else{ echo round($sgst28, 2);}  ?></td></tr></table></td>
  <td style="width: 50%;"><table width="100%"><tr><td align="right"><b>Bill Amount</b></td><td align="right"><b><?=$row4["be_gtotal"]?>.00 &nbsp;</b></td></tr></table></td>
  </tr></table>
  
  <table width="100%" ><tr><td style="border-bottom: 1px #000000 solid;"><span class="s5">
  Rupees <?php $gtotl=($tt); $amd=convert_number_to_words($row4['be_gtotal']);echo $amd;?><br><br>
  Bank Details<br>
  Name :<?=$row3["sp_bank"]?>
  <br>A/C No :<?=$row3["sp_accno"]?> 
  <br>Branch :<?=$row3["sp_branch"]?>
  <br>IFSC :<?=$row3["sp_ifsc"]?></span><td>
  <td style="border-bottom: 1px #000000 solid;text-align:right"><span class="s5"><br>For &nbsp; <b><?=$row3["sp_shopname"]?></b><br><br><br><br><br><br><br><span class="s5">Authorised Signatory</td></tr>
  </table>
  
  
  
  
<?php }else{?>
<table width="100%" style="border-top: 1px #000000 solid;" >

<tr>
    <td colspan="<?=$clmspan+7?>" style="text-align:right; border-bottom:1px solid #fff">&nbsp;</td>
</tr>
<tr>
    <td colspan="<?=$clmspan+7?>" style="text-align:right; border-bottom:1px solid #fff">&nbsp;</td>
</tr>
<tr>
    <td colspan="<?=$clmspan+7?>" style="text-align:right; border-bottom:1px solid #fff">&nbsp;</td>
</tr>
<tr>
    <td colspan="<?=$clmspan+7?>" style="text-align:right; border-bottom:1px solid #fff">&nbsp;</td>
</tr>


<tr>
    <td colspan="<?=$clmspan+7?>" style="text-align:right">Continue..</td>
</tr>
<tr>
    <td colspan="<?=$clmspan+7?>" style="text-align:right; border-bottom:1px solid #fff">&nbsp;</td>
</tr>
</table>
<?php }?>  
</table>
</div>
<?php
}$j=$j+20;}
?>
</body>
</html>