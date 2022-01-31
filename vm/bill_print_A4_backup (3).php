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
	border-left:1px solid #fff;
}
@font-face {
   font-family: eras;
   src: url(includes/eras-bold-itc.ttf);
}
.eras{font-family:eras;}
@font-face {
   font-family: infotext;
   src: url(includes/infotext.ttf);
}
.infotext{font-family:infotext;}
.fnt td,.fnt th{border:1px solid grey;}
.nonborder td{border:1px solid #FFF !important;}
.border td{border-left:1px solid #000;border-bottom:1px solid #FFF ;}
@media print{
    
.printButtonClass{display:none;}
.table{width:100%;}
.table th{font-size:10px;}
.s1{font-size:22px;}
	.s2{font-size:10px;}
	.s3{font-size:15px;}
	.s4{font-size:24px;}
	.s5{font-size:18px;}
	.s6{font-size:16px;}
	.s7{font-size:10px;}
	.s8{font-size:13px;}
/*.fnt td{font-size:14px;}*/
.fnt th{font-size:12px;}
footer {page-break-after: always;}
/*@page
   {
    size: 214mm 150mm;
   margin: 0;
   padding:0;
  }*/

}
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
	$slct=$conn->query("SELECT * FROM us_billentry WHERE be_billid='$billid'");
	$row=$slct->fetch_assoc();
	
	$cnt=$conn->query("SELECT COUNT(bi_billitemid) AS cnt FROM us_billitems WHERE bi_billid='$billid'");
	$row12=$cnt->fetch_assoc();
	$cnt1=$row12["cnt"];
	$r=1;
	$numbill=$cnt1/15;
	$a=intval($numbill);
	$an=$numbill-$a;
	if($an>0)
	{
	$numbill=$numbill+1;
	}
	$ttl=intval($numbill);
}



$profl = $conn->query("SELECT * FROM us_shopprofile WHERE sp_shopid='".$_SESSION["admin"]."'");
$row3 = $profl->fetch_assoc();
$bill = $conn->query("SELECT * FROM us_billentry WHERE be_billid='$billid'");
$row4=$bill->fetch_assoc();
$cust= $conn->query("SELECT * FROM us_customer WHERE cs_customerid='".$row4["be_customerid"]."'");
		$row5=$cust->fetch_assoc();

?>
<table  style="width:100%;" align="absmiddle"  border="1">
	<tr height="100px">
  	
   <!-- <th style="width:150px;"></th><th><span>INVOICE</span></th><br>-->
  
	<th   align="center" colspan="3" ><!--<span style="font-family:'Times New Roman', Times, serif">--><!--<span class="eras" style="font-family:forte;">-->
	<br>
      <img src="image/Gklogo1.png"  style="float:left;"  width="20%" height="auto" >
         <b> <p style="float:right; top:15px;"><?=$row3["sp_shopaddress"]?></b> <br>       
           &nbsp; &nbsp; &nbsp;Email:<?=$row3["sp_email"]?><br>
            &nbsp;<?php $stcode_s=$row3["sp_stcode"];?>
        &nbsp;GSTIN:<?=$row3["sp_tin"]?><br>
       &nbsp; Ph: <?=$row3["sp_phone"]?>Mob:<?=$row3["sp_mobile"]?><br></p>
       &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<b> <p style="color:red; font-size: 20px; float:center;"><?=$row3["sp_shopname"]?></p></b>
            

  </th>
  </tr>
 
</table> 


<table style="text-align: left; border-color:#000;" width="100%" border="1">
   <tr border="1" >
    <td  style="border-left:1px solid #000;">    				
                    <b>Invoice Serial Number:  <?=$row4["be_billnumber"]?>(<?php $d=date('d-m',strtotime($row4["be_billdate"]));echo $d;?>)</b>
                  </td><td>  <b>State: <?php 
						 if($row3["sp_stcode"]=="AN"){echo "Andaman and Nicobar Islands ";}
                         elseif($row3["sp_stcode"]=="AP"){echo "Andhra Pradesh";}
                         elseif($row3["sp_stcode"]=="AD"){echo "Andhra Pradesh";}                          		                         		                         elseif($row3["sp_stcode"]=="AR"){echo "Arunachal Pradesh";}
                         elseif($row3["sp_stcode"]=="AS"){echo "Assam";}
                         elseif($row3["sp_stcode"]=="BH"){echo "Bihar";}
                         elseif($row3["sp_stcode"]=="CH"){echo "Chandigarh";}
                         elseif($row3["sp_stcode"]=="CT"){echo "Chattisgarh";}
                         elseif($row3["sp_stcode"]=="DN"){echo "Dadra and Nagar Haveli";}
                         elseif($row3["sp_stcode"]=="DD"){echo "Daman and Diu";}
                         elseif($row3["sp_stcode"]=="DL"){echo "Delhi";}
                         elseif($row3["sp_stcode"]=="GA"){echo "GoA";}
						 elseif($row3["sp_stcode"]=="GJ"){echo "Gujarat";}
                         elseif($row3["sp_stcode"]=="HR"){echo "Hariyana";}                           
                         elseif($row3["sp_stcode"]=="HP"){echo "Himachal Pradesh";}
                         elseif($row3["sp_stcode"]=="JK"){echo "Jammu And Kashmir";}
                         elseif($row3["sp_stcode"]=="JH"){echo "Jharkhand";}
                         elseif($row3["sp_stcode"]=="KA"){echo "Karnataka";}
                         elseif($row3["sp_stcode"]=="KL"){echo "Kerala";}
                         elseif($row3["sp_stcode"]=="LD"){echo "LakshadWeep Island";}
                         elseif($row3["sp_stcode"]=="MP"){echo "Madhya Pradhesh";}
                         elseif($row3["sp_stcode"]=="MH"){echo "Maharastra";}
                         elseif($row3["sp_stcode"]=="MN"){echo "Manipur";}
                         elseif($row3["sp_stcode"]=="ME"){echo "Meghalaya";}
                         elseif($row3["sp_stcode"]=="MI"){echo "Mizoram";}                           
                         elseif($row3["sp_stcode"]=="NL"){echo "Nagaland";}
                         elseif($row3["sp_stcode"]=="OR"){echo "Odisha";}
                         elseif($row3["sp_stcode"]=="PY"){echo "Pondicherry";}
                         elseif($row3["sp_stcode"]=="PB"){echo "Punjab";}
                         elseif($row3["sp_stcode"]=="RJ"){echo "Rajasthan";}                           
                         elseif($row3["sp_stcode"]=="SK"){echo "Sikkim";}
                         elseif($row3["sp_stcode"]=="TN"){echo "Tamil Nadu";}
                         elseif($row3["sp_stcode"]=="TS"){echo "Telangana";}
                         elseif($row3["sp_stcode"]=="TR"){echo "Tripura";}
                         elseif($row3["sp_stcode"]=="UP"){echo "Uttar Pradesh";}
                         elseif($row3["sp_stcode"]=="UI"){echo "Uttarakhand";}
                         elseif($row3["sp_stcode"]=="WB"){echo "West Bengal";}
                         else {echo "Kerala";}
					
					
					
					
					
					
					?>
    </td>
    <td>State Code:<b><?php if($row4["be_statecode"]==''){echo"32";$stcode_c='KL';}else{$stcode_c=$row4["be_statecode"];switch($row4["be_statecode"])
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
			
		}}?></b></td>
	<td>  <b>Invoice Date: <?php $dt=date('d-m-y',strtotime($row4["be_billdate"]));echo $dt?></b>
                  </td>
  </tr>
</table>
<table border="0" width="100%" class="table">
	
    <tr>
   
    	<td style="padding:5px; border-left:1px solid #000; border-right:1px solid #000;font-size: 14px;"> <?php if ($row4["be_customerid"] == "0") {
    	?>
        Name & Address : 
         <b><?php
		echo $row4["be_customername"]."  ".$row4["be_address"]; ?></b>
		<br>
		
        
        
        GST Number:  <b><?php echo $row4["be_customer_tin_num"]."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Tel No. :".$row4["be_customermobile"]; echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Sales person:&nbsp&nbsp"  .$row4["be_saleperson"];
		echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspEmail : ";
	   } 		
		else {?></b>
       Name & Address : 
        <b><?php
		echo $row5["cs_customername"]." ".$row5["cs_address"];?></b><br>     
              
       
        GST Number:  <b><?php echo $row5["cs_tin_number"]."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Tel No. :".$row5["cs_customerphone"];
			echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspEmail : ".$row5["cs_email"];
		}?></b></td>
        
        
        
     
        
    </tr>
</table>
<?php 
if($stcode_c==$stcode_s)
{
	$clmspan='0';
}else{$clmspan='7';}
?>
<div style="border: 1px #808080 solid;margin-bottom:5px;" class="border">
<table width="100%" class="fnt" style="border:1px solid #808080;">
<tr>
<th rowspan="2" style="width:10px;" bgcolor="#999999"> S#</th>
    <th rowspan="2" style="width:10px;" bgcolor="#999999"> code</th>
<!--<th rowspan="2" bgcolor="#999999" style="width:50px;">Code</th>-->
<th rowspan="2" bgcolor="#999999" align="center">Item Name</th>
<th rowspan="2" style="width:75px;" bgcolor="#999999">HSN</th>
    <th rowspan="2" style="width:50px;" bgcolor="#999999">Qty</th>
    <th rowspan="2" style="width:50px;" bgcolor="#999999">UOM</th>
   <th rowspan="2" style="width:50px;" bgcolor="#999999">Rate</th>
    <th rowspan="2" style="width:50px;" bgcolor="#999999">Value</th>
<th rowspan="2" style="width:50px;" bgcolor="#999999">GST%</th>

    

  <th rowspan="2" style="width:50px;" bgcolor="#999999">Unit price</th>
<!--<th rowspan="2" style="width:50px;" bgcolor="#999999">Amount</th>-->
<th rowspan="2" style="width:30px;" bgcolor="#999999">Discount</th>
    <th rowspan="2" style="width:75px;" bgcolor="#999999">CGST</th>
    <th rowspan="2" style="width:75px;" bgcolor="#999999">SGST</th>
    <th rowspan="2" style="width:75px;" bgcolor="#999999">IGST</th>
<th rowspan="2" style="width:100px;" bgcolor="#999999">Net Amount</th>

</tr>
<tr>
</tr>
<?php
$k=1;
$j=0;
$tcgst=0;
$tsgst=0;
$tigst=0;
$qt=0;
$amt=0;
$amt3=0;
$amt2=0;
$totdisc=0;
$dis=0;
$tax=0;
$totalbi1=0;
$gk2=0;
$gk3=0;
$bill2=$conn->query("SELECT * FROM us_billitems a LEFT JOIN us_products b ON b.pr_productid=a.bi_productid WHERE a.bi_billid='$billid' LIMIT 15");
$tot=0;

while($row6=$bill2->fetch_assoc()){?>
<tr style="text-align:center;">
<?php $disc= $row6['bi_disc'];




$am= $disc+$row6['bi_taxamount'];?>
	<td><span class="s8"><?php echo $k;?></span></td>
   <td> <span class="s8"><?php echo $row6['pr_productcode'];?></span></td>
    <td align="left" style="width:35%; font-size: 14px;"><span class="s8"><?php  echo $row6["pr_productname"];?></span></td>
    <td><span class="s8"><?php echo $row6['pr_hsn'];?></span></td>
    <td><span class="s8"><?php echo $row6['bi_quantity']; ?></span></td>
    <td><span class="s8"><?php echo $row6['pr_unit'];?></span></td>
    <td><span class="s8"><?php if($row6['bi_quantity']!=0) { echo $gk2=number_format(($row6['bi_taxamount']+$row6['bi_disc'])/$row6['bi_quantity'],2); } else { echo 0;}?></span></td>
    
    <td align="left" style="width:10%; font-size: 14px;" ><span class="s8" ><?php echo $row6['bi_taxamount'];?></span></td>
    
     <td><span class="s8"><?php echo $row6['bi_vatper'];?></span></td>
	 
   
       
     <!--<td><span class="s8"><?php echo number_format($gk2+(($row6['bi_sgst_amt']+$row6['bi_cgst_amt'])/$row6['bi_quantity']),2); ?></span></td>-->
    <td><span class="s8"><?php  echo $row6["pr_saleprice"];?></span></td>
    <!--<td><span class="s8"><?php echo $gk2*$row6['bi_quantity']; ?></span></td>-->
    <td><span class="s8"><?php echo round($disc,2);?></span></td>
     <td><span class="s8"><?php echo $row6['bi_sgst_amt'];?></span></td>
     <td><span class="s8"><?php echo $row6['bi_cgst_amt'];?></span></td>
    <td><span class="s8"><?php echo $row6['bi_igst_amt'];?></span></td>
    <!--<td><span class="s8"><?php echo $row6['bi_taxamount'];?></span></td>--> 
    <td align="center" style="width:10%; font-size: 14px;" ><span class="s8" ><?php echo $row6['bi_taxamount']+$row6['bi_cgst_amt']+$row6['bi_sgst_amt']+$row6['bi_cess']+$row6['bi_igst_amt'];?></span></td>
</tr>
<?php $qt=$qt+$row6['bi_quantity'];
$amt=$amt+$row6['bi_taxamount'];
$amt3=$amt3+$row6['bi_taxamount']+$row6['bi_cgst_amt']+$row6['bi_sgst_amt']+$row6['bi_igst_amt']+$row6['bi_cess'];                                   
$dis=$dis+$disc;
$tax=$tax+round($row6['bi_taxamount']);
$totalbi1=$totalbi1+$row6['bi_taxamount']+$row6['bi_cgst_amt']+$row6['bi_sgst_amt']+$row6['bi_cess']+$row6['bi_igst_amt'];?>
<?php $k++; }
while($k<=15)
{?>
<tr><td style="border-right:1px solid #808080;">&nbsp;</td><td style="border-right:1px solid #808080;">&nbsp;</td><td style="border-right:1px solid #808080;">&nbsp;</td><td style="border-right:1px solid #808080;">&nbsp;</td><td style="border-right:1px solid #808080;">&nbsp;</td><td style="border-right:1px solid #808080;">&nbsp;</td><td style="border-right:1px solid #808080;">&nbsp;</td><td style="border-right:1px solid #808080;">&nbsp;</td><td style="border-right:1px solid #808080;">&nbsp;</td><td style="border-right:1px solid #808080;">&nbsp;</td><td style="border-right:1px solid #808080;">&nbsp;</td><td style="border-right:1px solid #808080;">&nbsp;</td><td style="border-right:1px solid #808080;">&nbsp;</td><td style="border-right:1px solid #808080;">&nbsp;</td></tr>
<?php $k++;}?>
<tr style="border-top: 2px #808080 solid;border-bottom: 2px #808080 solid">
	<td></td><td></td>
    <td style="text-align:right;">Total:</td>
    
	<td></td>
   
   <td align="center"><?php echo $qt;?></td>
      <td></td>
 
    <td></td>
       <td align="center"><?php echo $amt;?></td></td>
    <td></td>
     <td></td>
   
    <td align="center"><?php echo $dis;?></td>
    <td align="center">
<?php $slctsgst5t=$conn->query("select sum(bi_cgst_amt) as 5tax from us_billitems where bi_billid='$billid'"); $rowitm5t=$slctsgst5t->fetch_assoc();
 $sgst5t=$rowitm5t["5tax"];
 echo round($sgst5t,2);?>
</td>
	 <td align="center">
<?php $slctsgst5t=$conn->query("select sum(bi_sgst_amt) as 5tax from us_billitems where bi_billid='$billid'"); $rowitm5t=$slctsgst5t->fetch_assoc();
 $sgst5t=$rowitm5t["5tax"];
 echo round($sgst5t,2);?>
</td><td align="center">
<span class="s8"><?php $slctsgst6t=$conn->query("select sum(bi_igst_amt) as 6tax from us_billitems where bi_billid='$billid'"); $rowitm6t=$slctsgst6t->fetch_assoc();
 $igst6t=$rowitm6t["6tax"];
 echo round($igst6t,2);?></span>
</td>
<td align="center"><?php echo $amt3;?></td>
    
</tr>
</table>
<?php if($r==$ttl){?>


<table width="100%">
<tr>
<td colspan="5" style="border-bottom:1px solid #000;">

<?php $slctsgst=$conn->query("select sum(bi_cgst_amt) as cgs,sum(bi_sgst_amt) as sgs,sum(bi_igst_amt) as igs  from us_billitems where bi_billid='$billid'"); $rowi=$slctsgst->fetch_assoc();
$totax=$rowi["cgs"]+$rowi["sgs"]+$rowi["igs"];?>

<span class="s8">Total Invoice Amount in words : <b> <?php $amd=convertToIndianCurrency(round($totalbi1));echo $amd;?> </b> </span>
</td>

</tr>
<tr>
<td></td>
<td style="border-bottom:1px solid #000;" colspan="3">
<span class="s8">Net Amount Before Tax:</span>
</td>
    
<td style="border-bottom:1px solid #000;" colspan="3">
<span class="s8"><?php echo $amt;?></span>
</td>
</tr>
<tr>
<td>

</td>
    
	<td style="border-bottom:1px solid #000;" colspan="3">
<span class="s8">Add:CGST</span>
</td>
<td style="border-bottom:1px solid #000;" colspan="3">
<span class="s8"><?php $slctsgst5t=$conn->query("select sum(bi_cgst_amt) as 5tax from us_billitems where bi_billid='$billid'"); $rowitm5t=$slctsgst5t->fetch_assoc();
 $sgst5t=$rowitm5t["5tax"];
 echo round($sgst5t,2);?></span>
</td>

</tr>
<tr>
<td></td>
<td style="border-bottom:1px solid #000;" colspan="3">

<span class="s8">Add:SGST</span>
</td>
<td style="border-bottom:1px solid #000;" colspan="3">
<span class="s8"><?php $slctsgst6t=$conn->query("select sum(bi_sgst_amt) as 6tax from us_billitems where bi_billid='$billid'"); $rowitm6t=$slctsgst6t->fetch_assoc();
 $sgst6t=$rowitm6t["6tax"];
 echo round($sgst6t,2);?></span>
</td>
</tr>
    <tr><td></td>
<td style="border-bottom:1px solid #000;" colspan="3">

<span class="s8">Add:IGST</span>
</td>
<td style="border-bottom:1px solid #000;" colspan="3">
<span class="s8"><?php $slctsgst6t=$conn->query("select sum(bi_igst_amt) as 6tax from us_billitems where bi_billid='$billid'"); $rowitm6t=$slctsgst6t->fetch_assoc();
 $igst6t=$rowitm6t["6tax"];
 echo round($igst6t,2);?></span>
</td>
</tr>
<tr>
<td></td>
<td style="border-bottom:1px solid #000;" colspan="3">

<span class="s8">Total cess</span>
</td>
<td style="border-bottom:1px solid #000;" colspan="3">
<span class="s8"><?php $slcess=$conn->query("select sum(bi_cess) as b6cess from us_billitems where bi_billid='$billid'"); $rowitmcess=$slcess->fetch_assoc();
 $cessd=$rowitmcess["b6cess"];
 echo round($cessd,2);?></span>
</td>
</tr>
    <tr>
<td></td>
<td style="border-bottom:1px solid #000;" colspan="3">

<b>
<span class="s8">Total Discount</span></b>
</td>
<td style="border-bottom:1px solid #000;" colspan="3">
<span class="s8">
<b><?= $row4["be_discount"];?></b>
</span>
</td>
</tr>
<tr>
<td></td>
<td style="border-bottom:1px solid #000;" colspan="3">

<b>
<span class="s8">Total Amount After Tax</span></b>
</td>
<td style="border-bottom:1px solid #000;" colspan="3">
<span class="s8">
<b><?= round(($totalbi1+$row4["be_coolie"])-$row4["be_discount"]);?></b>
</span>
</td>
</tr>

<tr></tr>

<tr>
<td colspan="1" style="border-bottom:1px solid #000;" width="40%"><span class="s2">
Transport Vehicle No. : <?=$row4["be_vehicle_number"]?><br>
    100% Advance : <?=$row4["be_hunad"]?><br>
     Shipping Address : <?=$row4["be_shipping"]?><br>
    <b>Bank Detail :</b> <?=$row3["sp_bank"]?> <br>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;       <?=$row3["sp_accno"]?><br>
  &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?=$row3["sp_branch"]?><br>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    <?=$row3["sp_ifsc"]?>
</span></td>


<td style="border-bottom:1px solid #000;" ><span class="s3">Certified that the Particulars are <br> given above are true and correct</span><br>
<br>
For <?=$row3["sp_shopname"]?>
</td>
</tr>
</table>
<?php }else{?>
<table>

<tr>
    <td colspan="<?=$clmspan+9?>" style="text-align:right">&nbsp;</td>
</tr>
<tr>
    <td colspan="<?=$clmspan+9?>" style="text-align:right">&nbsp;</td>
</tr>
<tr>
    <td colspan="<?=$clmspan+9?>" style="text-align:right">Continue..</td>
</tr>
</table>
<?php }?>
</div>
<!--<div style="width:300px;float:right; text-align:center;">
For <?=$row3["sp_shopname"]?><br>( authorised signature )
</div>-->
<!--<table width="100%" border="1" style="text-align:center;">
<tr>
	<td>Certified that the Particulars given above are true and correct</td>
    <td>Electronic Reference Number</td>
    
</tr>
<tr style="height:50px;">
	<td></td>
    <td></td>
</tr>
<tr>
	<td>Terms &jgjhghjgjgh Conditions</td>
    <td><b><?=$row3["sp_shopname"]?></b></td>
  
</tr>
</tr>
<tr style="height:30px;">
	<td ></td>
    <td align="left">Signature</td>
   
 </tr>
 <tr>
 	<td style="border-bottom:1px solid #FFF;border-top:1px solid #FFF;"></td>
    <td>Authorized Signatory</td>
      
 </tr>
 <tr align="left">
 	<td></td>
    <td>Name : <br>Designation :</td>
 </tr>
</table>-->

<footer></footer>
<?php 
$j=0;
$j=$j+15;
while($cnt1>$j)
{
	$r++;	
$slctitm1=$conn->query("SELECT * FROM us_billitems a LEFT JOIN us_products b ON b.pr_productid=a.bi_productid WHERE a.bi_billid='$billid' LIMIT ".$j.",15");
if($slctitm1->num_rows>0)
{
?>
<table  style="width:100%;" align="absmiddle"  border="1">
    <tr height="100px">
    
   <!-- <th style="width:150px;"></th><th><span>INVOICE</span></th><br>-->
  
    <th   align="center" colspan="3" ><!--<span style="font-family:'Times New Roman', Times, serif">--><!--<span class="eras" style="font-family:forte;">--><b><span class="s1"><?=$row3["sp_shopname"]?></span></b><br>
            <?=$row3["sp_shopaddress"]?><br>
           GSTIN:<?=$row3["sp_tin"]?><br>
            <?=$row3["sp_email"]?></span>
            <?php $stcode_s=$row3["sp_stcode"];?>
  <?=$row3["sp_phone"]?><BR><?=$row3["sp_mobile"]?></th>
  </tr>
 
</table> 

<table  width="100%" border="1">
   
  <tr border="1" >
    <td rowspan="3" style="padding:5px;width:75%; border-left:1px solid #000;text-align: center;">SALES INVOICE - LOCAL(Wholesale)</td>
    <td style="padding:5px;width:50%; border-left:1px solid #000;font-size: 10px;">Original For Recipient</td>
    
  </tr>
  <tr border="1" >
    <td style="padding:5px; border-left:1px solid #000;font-size: 10px;">Duplicate For Suppier/Transporter</td>
    
    
  </tr>
  <tr border="1" >
    <td style="padding:5px; border-left:1px solid #000;font-size: 10px;">Triplicate For Supplier</td>
    
    
  </tr>
  
</table>


 
<table style="text-align: left; border-color:#000;" width="100%" border="1">
   <tr border="1" >
    <td  style="padding:5px;width:50%; border-left:1px solid #000;">
                    Tax is Payable On Reverse Charge(Yes/No):<br>
                    Invoice Serial Number:  <b><?=$row4["be_billnumber"]?>(<?php $d=date('d-m',strtotime($row4["be_billdate"]));echo $d;?>)</b><br>
                    Invoice Date: <?php $dt=date('d-m-y',strtotime($row4["be_billdate"]));echo $dt?><br>
                    State: Place Of Supply: <b><?php 
                         if($row3["sp_stcode"]=="AN"){echo "Andaman and Nicobar Islands ";}
                         elseif($row3["sp_stcode"]=="AP"){echo "Andhra Pradesh";}
                         elseif($row3["sp_stcode"]=="AD"){echo "Andhra Pradesh";}                                                                                        elseif($row3["sp_stcode"]=="AR"){echo "Arunachal Pradesh";}
                         elseif($row3["sp_stcode"]=="AS"){echo "Assam";}
                         elseif($row3["sp_stcode"]=="BH"){echo "Bihar";}
                         elseif($row3["sp_stcode"]=="CH"){echo "Chandigarh";}
                         elseif($row3["sp_stcode"]=="CT"){echo "Chattisgarh";}
                         elseif($row3["sp_stcode"]=="DN"){echo "Dadra and Nagar Haveli";}
                         elseif($row3["sp_stcode"]=="DD"){echo "Daman and Diu";}
                         elseif($row3["sp_stcode"]=="DL"){echo "Delhi";}
                         elseif($row3["sp_stcode"]=="GA"){echo "GoA";}
                         elseif($row3["sp_stcode"]=="GJ"){echo "Gujarat";}
                         elseif($row3["sp_stcode"]=="HR"){echo "Hariyana";}                           
                         elseif($row3["sp_stcode"]=="HP"){echo "Himachal Pradesh";}
                         elseif($row3["sp_stcode"]=="JK"){echo "Jammu And Kashmir";}
                         elseif($row3["sp_stcode"]=="JH"){echo "Jharkhand";}
                         elseif($row3["sp_stcode"]=="KA"){echo "Karnataka";}
                         elseif($row3["sp_stcode"]=="KL"){echo "Kerala";}
                         elseif($row3["sp_stcode"]=="LD"){echo "LakshadWeep Island";}
                         elseif($row3["sp_stcode"]=="MP"){echo "Madhya Pradhesh";}
                         elseif($row3["sp_stcode"]=="MH"){echo "Maharastra";}
                         elseif($row3["sp_stcode"]=="MN"){echo "Manipur";}
                         elseif($row3["sp_stcode"]=="ME"){echo "Meghalaya";}
                         elseif($row3["sp_stcode"]=="MI"){echo "Mizoram";}                           
                         elseif($row3["sp_stcode"]=="NL"){echo "Nagaland";}
                         elseif($row3["sp_stcode"]=="OR"){echo "Odisha";}
                         elseif($row3["sp_stcode"]=="PY"){echo "Pondicherry";}
                         elseif($row3["sp_stcode"]=="PB"){echo "Punjab";}
                         elseif($row3["sp_stcode"]=="RJ"){echo "Rajasthan";}                           
                         elseif($row3["sp_stcode"]=="SK"){echo "Sikkim";}
                         elseif($row3["sp_stcode"]=="TN"){echo "Tamil Nadu";}
                         elseif($row3["sp_stcode"]=="TS"){echo "Telangana";}
                         elseif($row3["sp_stcode"]=="TR"){echo "Tripura";}
                         elseif($row3["sp_stcode"]=="UP"){echo "Uttar Pradesh";}
                         elseif($row3["sp_stcode"]=="UI"){echo "Uttarakhand";}
                         elseif($row3["sp_stcode"]=="WB"){echo "West Bengal";}
                         else {echo "Kerala";}
                    
                    
                    
                    
                    
                    
                    ?>
    </td>
    <td  style="padding:5px;width:50%; border-left:1px solid #000">Transportation Mode:<br>
                    Vehicle Number: <?=$row4["be_vehicle_number"]?><br>
                    Date And Time Of Supply:<?php $dt=date('d-m-y',strtotime($row4["be_billdate"]));echo $dt?><br>
                    Place Of Supply: <b><?php if ($row4["be_customerid"] == "0") { 
                         if($row4["be_statecode"]=="AN"){echo "Andaman and Nicobar Islands ";}
                         elseif($row4["be_statecode"]=="AP"){echo "Andhra Pradesh";}
                         elseif($row4["be_statecode"]=="AD"){echo "Andhra Pradesh";}                                                                                         elseif($row4["be_statecode"]=="AR"){echo "Arunachal Pradesh";}
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
                         else {echo "Kerala";}}
                    else{
                         if($row5["cs_statecode"]=="AN"){echo "Andaman and Nicobar Islands ";}
                         elseif($row5["cs_statecode"]=="AP"){echo "Andhra Pradesh";}
                         elseif($row5["cs_statecode"]=="AD"){echo "Andhra Pradesh";}                                                                                         elseif($row5["cs_statecode"]=="AR"){echo "Arunachal Pradesh";}
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
                         else {echo "Kerala";}
                        }    
                    
                    
                    
                    
                    
                    ?></b>
                    </td>
  </tr>
</table>
<table border="1" width="100%" class="table">
    <tr>
        <td style="text-align:center;width: 50%; border-left:1px solid #000;">Details Of Reciever (Billed To)</td>
        <td style="text-align:center;width: 50%; border-left:1px solid #000;">Details Of Consignee</td>
    </tr>
    <tr>
   
        <td style="padding:5px; border-left:1px solid #000;"> <?php if ($row4["be_customerid"] == "0") {
        ?>
        Name:
        <b><?php
        echo $row4["be_customername"];?></b>
        <br>Ph:
        <b><?php
        echo $row4["be_customermobile"]; 
        ?></b>
        <br>State: <b><?php if($row4["be_statecode"]=="AN"){echo "Andaman and Nicobar Islands ";}
                         elseif($row4["be_statecode"]=="AP"){echo "Andhra Pradesh";}
                         elseif($row4["be_statecode"]=="AD"){echo "Andhra Pradesh";}                                                                                         elseif($row4["be_statecode"]=="AR"){echo "Arunachal Pradesh";}
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
                         else {echo "Kerala";}?></b>
        <br>State Code:<b><?php if($row4["be_statecode"]==''){echo"32";$stcode_c='KL';}else{$stcode_c=$row4["be_statecode"];switch($row4["be_statecode"])
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
            
        }}?></b><br>
        GST Number:  <b><?php echo $row4["be_customer_tin_num"];
        } 
        else {?></b>
        Name:
        <b><?php
        echo $row5["cs_customername"];?></b>
        <br>Address:
        <b><?php
        echo $row5["cs_address"]; 
        ?></b>
          
        <br> State:<b><?php if($row5["cs_statecode"]=="AN"){echo "Andaman and Nicobar Islands ";}
                         elseif($row5["cs_statecode"]=="AP"){echo "Andhra Pradesh";}
                         elseif($row5["cs_statecode"]=="AD"){echo "Andhra Pradesh";}                                                                                         elseif($row5["cs_statecode"]=="AR"){echo "Arunachal Pradesh";}
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
                         else {echo "Kerala";}?></b>&nbsp;&nbsp;&nbsp;&nbsp; Ph:
        <b><?php
        echo $row5["cs_customerphone"]; 
        ?></b>
        <br>
        State Code:<b><?php //echo $row5["cs_statecode"];
        $stcode_c=$row5["cs_statecode"];
        switch($row5["cs_statecode"])
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
            
        }?></b>
        <br>GST Number:  <b><?php echo $row5["cs_tin_number"];}?></b></td>
        
        <td style="padding:5px; border-left:1px solid #000;"> <?php if ($row4["be_customerid"] == "0") {
        ?>
        Name:
        <b><?php
        echo $row4["be_customername"];?></b>
        <br>Address:
        <b><?php
        echo $row4["be_customermobile"]; 
        ?></b>
        <br>State: <b><?php if($row4["be_statecode"]=="AN"){echo "Andaman and Nicobar Islands ";}
                         elseif($row4["be_statecode"]=="AP"){echo "Andhra Pradesh";}
                         elseif($row4["be_statecode"]=="AD"){echo "Andhra Pradesh";}                                                                                         elseif($row4["be_statecode"]=="AR"){echo "Arunachal Pradesh";}
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
                         else {echo "Kerala";}?></b>
        <br>State Code:<b><?php if($row4["be_statecode"]==''){$stcode_c='KL';echo"32";}else{$stcode_c=$row4["be_statecode"];switch($row4["be_statecode"])
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
            
        }}?></b><br>
        GST Number:  <b><?php echo $row4["be_customer_tin_num"];
        } 
        else {$cust= $conn->query("SELECT * FROM us_customer WHERE cs_customerid='".$row4["be_customerid"]."'");
        $row5=$cust->fetch_assoc();?></b>
        Name:
        <b><?php
        echo $row5["cs_customername"];?></b>
        <br>Address:
        <b><?php
        echo $row5["cs_address"]; 
        ?></b>
        <br> State:<b><?php if($row5["cs_statecode"]=="AN"){echo "Andaman and Nicobar Islands ";}
                         elseif($row5["cs_statecode"]=="AP"){echo "Andhra Pradesh";}
                         elseif($row5["cs_statecode"]=="AD"){echo "Andhra Pradesh";}                                                                                         elseif($row5["cs_statecode"]=="AR"){echo "Arunachal Pradesh";}
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
                         else {echo "Kerala";}?></b>&nbsp;&nbsp;&nbsp;&nbsp;Ph:
        <b><?php
        echo $row5["cs_customerphone"]; 
        ?></b>
        
        
         <br>
        State Code: <b><?php //echo $row5["cs_statecode"];
        $row4["be_statecode"]=$row5["cs_statecode"];
        switch($row5["cs_statecode"])
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
            
        }?></b>
        <br>GST Number:  <b><?php echo $row5["cs_tin_number"];}?></b></td>
        
     
        
    </tr>
</table>
<?php 
if($stcode_c==$stcode_s)
{
	$clmspan='7';
}else{$clmspan='5';}
?>
<div style="border: 1px #808080 solid;margin-bottom:5px;" class="border">
<table width="100%" class="fnt" style="border:1px solid #808080;">
<tr>
<th rowspan="2" style="width:10px;" bgcolor="#999999"> S#</th>
<!--<th rowspan="2" bgcolor="#999999" style="width:50px;">Code</th>-->
<th rowspan="2" bgcolor="#999999" align="left">Name of Product/Service</th>
<th rowspan="2" style="width:75px;" bgcolor="#999999">HSN<br>ACS</th>
<th rowspan="2" style="width:50px;" bgcolor="#999999">Qty</th>
<th rowspan="2" style="width:50px;" bgcolor="#999999">UOM</th>
<th rowspan="2" style="width:50px;" bgcolor="#999999">Unit Rate</th>
<th rowspan="2" style="width:50px;" bgcolor="#999999">Amount</th>
<th rowspan="2" style="width:30px;" bgcolor="#999999">Less<br>Disc</th>
<th rowspan="2" style="width:50px;" bgcolor="#999999">Taxable Values</th>
<?php if($stcode_c==$stcode_s)
{?>


<th colspan="2"  style="width:60px;" bgcolor="#999999">CGST</th>
<th  colspan="2" style="width:60px;" bgcolor="#999999">SGST</th>
<?php }

else{
?>
<th colspan="2"  style="width:60px;" bgcolor="#999999">IGST</th>
<?php }?>

<th rowspan="2" style="width:50px;" bgcolor="#999999">Total</th>

</tr>
<tr>
<?php if($stcode_c==$stcode_s)
{?><th>Rate</th>
<th>Amt.</th>
<th>Rate</th>
<th>Amt.</th><?php }else{?>
<th>Rate</th>
<th>Amt.</th><?php }?>

</tr>
<?php
//$k=1;
$tcgst=0;
$tsgst=0;
$tigst=0;
$qt=0;
$amt=0;
$totdisc=0;
$dis=0;
$tax=0;
$totalbi2=0;
$gk2=0;
$tot=0;
$bill2=$conn->query("SELECT * FROM us_billitems a LEFT JOIN us_products b ON b.pr_productid=a.bi_productid WHERE a.bi_billid='$billid' LIMIT ".$j.",20");

while($row6=$bill2->fetch_assoc()) { ?>
<tr style="text-align:center;">
<?php $disc= $row6['bi_disc'];

//$brand=$row6['pr_cname'];
//    $brandselect=$conn->query("select * from us_producthead where hr_headid='$brand'");
 //   $rowbrnd=$brandselect->fetch_assoc();


$am= $disc+$row6['bi_taxamount'];?>
    <td><span class="s8"><?php echo $k;?></span></td>
   <!-- <td style="display:none;"><?php echo $row6['pr_productcode'];?></td>-->
    <td align="left" style="width:35%; font-size: 14px;"><span class="s8"><?php echo $row6["pr_productname"];?></span></td>
    <td><span class="s8"><?php echo $row6['pr_hsn'];?></span></td>
     <td><span class="s8"><?php echo $row6['bi_quantity'];?></span></td>
<td><span class="s8"><?php echo $row6['pr_unit'];?></span></td>

      <td><span class="s8"><?php if($row6['bi_quantity']!=0) { echo $gk2=number_format(($row6['bi_taxamount']+$row6['bi_disc'])/$row6['bi_quantity'],2); } else { echo 0;}?></span></td>
    <td><span class="s8"><?php echo $gk2*$row6['bi_quantity']; ?></span></td>
    <td><span class="s8"><?php echo round($disc,2);?></span></td>
    <td><span class="s8"><?php echo $row6['bi_taxamount'];?></span></td>
   
    <?php if($stcode_c==$stcode_s)
    {?>
    <td class="s8"><?php echo $row6['bi_cgst'];?></td>
    <td class="s8"><?php $tcgst=$tcgst+round($row6['bi_cgst_amt']);echo ($row6['bi_cgst_amt']);?></td>
    <td class="s8"><?php echo $row6['bi_sgst'];?></td>
    <td class="s8"><?php $tsgst=$tsgst+round($row6['bi_sgst_amt']);echo ($row6['bi_sgst_amt']);?></td>
    <?php }else{?>
    <td class="s8"><?php echo $row6['bi_igst'];?></td>
    <td class="s8"><?php $tigst=$tigst+round($row6['bi_igst_amt']);echo ($row6['bi_igst_amt']);?></td>
    <?php }?>
<td><span class="s8"><?php echo $row6['bi_total'];?></span></td>
   
    
</tr>
<?php $qt=$qt+$row6['bi_quantity'];
$amt=$amt+$row6['bi_taxamount'];
$dis=$dis+$disc;
$tax=$tax+round($row6['bi_taxamount']);
$totalbi2=$totalbi2+$row6['bi_total'];?>
<?php $k++; }
while($k<=$j+9)
{?>

<tr><td style="border-right:1px solid #808080;">&nbsp;</td><td style="border-right:1px solid #808080;">&nbsp;</td><td style="border-right:1px solid #808080;">&nbsp;</td><td style="border-right:1px solid #808080;">&nbsp;</td><td style="border-right:1px solid #808080;">&nbsp;</td><td style="border-right:1px solid #808080;">&nbsp;</td><td style="border-right:1px solid #808080;">&nbsp;</td><td style="border-right:1px solid #808080;">&nbsp;</td><td style="border-right:1px solid #808080;">&nbsp;</td><td style="border-right:1px solid #808080;">&nbsp;</td><td style="border-right:1px solid #808080;">&nbsp;</td><td style="border-right:1px solid #808080;">&nbsp;</td><td style="border-right:1px solid #808080;">&nbsp;</td></tr>
<?php $k++;}?>
<tr style="border-top: 2px #808080 solid;border-bottom: 2px #808080 solid">
    <td></td>
     <td style="text-align:right;">Total:</td>
    <td></td>
   
   <td align="center"><?php echo $qt;?></td>
    
 <td></td>
     <td><?php echo $dis;?></td>
    <td></td>

<td align="center"><?php echo $amt;?></td>
    <td></td>
    <td></td>
    <td></td>
    
    <td align="center"></td>
     <td></td>
    <td align="center"><?php echo $totalbi2;?></td>
</tr>
</table>
<?php if($r==$ttl){?>


<table width="100%">
<tr>
<td colspan="2" style="border-bottom:1px solid #000;" rowspan="4">

<?php $slctsgst=$conn->query("select sum(bi_cgst_amt) as cgs,sum(bi_sgst_amt) as sgs,sum(bi_igst_amt) as igs  from us_billitems where bi_billid='$billid'"); $rowi=$slctsgst->fetch_assoc();
$totax=$rowi["cgs"]+$rowi["sgs"]+$rowi["igs"];?>

<span class="s8">Rupees: <?php $amd=convertToIndianCurrency(round($totalbi2));echo $amd;?> Only</span>
</td>
<td style="border-bottom:1px solid #000;" colspan="2">
<span class="s8">Total Amount Before Tax:</span>
</td>
<td style="border-bottom:1px solid #000;" colspan="2">
<span class="s8"><?php echo $tax;?></span>
</td>
</tr>
<tr>
    <td>
<span class="s8">Add:CGST</span>
</td>
<td style="border-bottom:1px solid #000;" colspan="2">
<span class="s8"><?php $slctsgst5t=$conn->query("select sum(bi_cgst_amt) as 5tax from us_billitems where bi_billid='$billid'"); $rowitm5t=$slctsgst5t->fetch_assoc();
 $sgst5t=$rowitm5t["5tax"];
 echo round($sgst5t,2);?></span>
</td>

</tr>
<tr>
<td style="border-bottom:1px solid #000;" colspan="2">
<span class="s8">Add:SGST</span>
</td>
<td style="border-bottom:1px solid #000;" colspan="2">
<span class="s8"><?php $slctsgst6t=$conn->query("select sum(bi_sgst_amt) as 6tax from us_billitems where bi_billid='$billid'"); $rowitm6t=$slctsgst6t->fetch_assoc();
 $sgst6t=$rowitm6t["6tax"];
 echo round($sgst6t,2);?></span>
</td>
</tr>
<tr>
<td style="border-bottom:1px solid #000;" colspan="2">
<span class="s8">Add:IGST</span>
</td>
<td style="border-bottom:1px solid #000;" colspan="2">
<span class="s8"><?php $slctsgst7t=$conn->query("select sum(bi_igst_amt) as 7tax from us_billitems where bi_billid='$billid'"); $rowitm7t=$slctsgst7t->fetch_assoc();
 $sgst7t=$rowitm7t["7tax"];
 echo round($sgst7t,2);?></span>
</td>
</tr>

<tr>
<td colspan="2" rowspan="4" style="border-bottom:1px solid #000;">
<span class="s7">Bank Name:<?=$row3["sp_bank"]?><br>
Account No:<?=$row3["sp_accno"]?><br>
IFSC Code:<?=$row3["sp_ifsc"]?>&nbsp;&nbsp;Branch:<?=$row3["sp_branch"]?></span>
</td>
<td style="border-bottom:1px solid #000;" colspan="2">
Total Amount:GST
</td>
<td style="border-bottom:1px solid #000;" colspan="2">
<?php $ta=round($sgst5t+$sgst6t+$sgst7t,2);echo $ta;?>
</td>
</tr>

<tr>
<td style="border-bottom:1px solid #000;" colspan="2">Other Charges</td><td style="border-bottom:1px solid #000;" colspan="2"><?=$row4["be_coolie"]?></td>
</tr>

<tr>
<td style="border-bottom:1px solid #000;" colspan="2"><b>Invoice Total(Rs) </b></td><td style="border-bottom:1px solid #000;" colspan="2"><b><?= round($totalbi2+$row4["be_coolie"]);?></b></td>
</tr>
<?php
    $billtot = $conn->query("SELECT sum(bi_total) as grandtotal FROM us_billitems WHERE bi_billid='$billid'");
    $rowval=$billtot->fetch_assoc();
    $grndtot=$rowval["grandtotal"];
?>
<tr>
<td style="border-bottom:1px solid #000;" colspan="2"><b> Grand Total(Rs)</b></td>
<td style="border-bottom:1px solid #000;" colspan="2"><b><?=$grndtot;?></b></td>
</tr>

<tr>
<td colspan="1" style="border-bottom:1px solid #000;" width="40%"><span class="s2"><b>Terms & Conditions:</b><br>
Goods once sold will not taken back or exchanged<br>
</span></td>

<td style="border-bottom:1px solid #000; text-align:center;" width="30%" align="center"><br><br>(Common seal)</td>
<td style="border-bottom:1px solid #000;" ><span class="s3">Certified that the given above are true and correct</span><br>
Authorised Signatory</td>
</tr>
</table>
<?php }?>
</div>

<footer></footer>
<?php
}$j=$j+20;}

?>
<table>

</table>

</body>
</html>