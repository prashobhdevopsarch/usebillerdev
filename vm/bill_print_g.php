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
.s1{font-size:24px;}
	.s2{font-size:13px;}
	.s3{font-size:12px;}
	.s4{font-size:20px;}
	.s5{font-size:18px;}
	.s6{font-size:16px;}
	.s7{font-size:8px;}
.fnt td{font-size:8px;}
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

}



$profl = $conn->query("SELECT * FROM us_shopprofile WHERE sp_shopid='".$_SESSION["admin"]."'");
$row3 = $profl->fetch_assoc();
$bill = $conn->query("SELECT * FROM us_billentry WHERE be_billid='$billid'");
$row4=$bill->fetch_assoc();
$cust= $conn->query("SELECT * FROM us_customer WHERE cs_customerid='".$row4["be_customerid"]."'");
		$row5=$cust->fetch_assoc();

?>
<span>GSTIN Number: <?=$row3["sp_tin"]?></span><br>
<table style="text-align:center;border-bottom: 1px #808080 solid;" width="100%"  > 
	<tr height="170px">
    <th><b><span class="s1"><?=$row3["sp_shopname"]?></span></b><br>
 			<?=$row3["sp_shopaddress"]?><br>
            <?=$row3["sp_phone"]?><br>
            <?=$row3["sp_email"]?><br><br> CASH/CREDIT Invoice
          
    </th>
    
  </tr>
</table>  

<table style="text-align: left;border-bottom: 1px #808080 solid;" width="100%">
   <tr>
   <td style="padding:5px;">Details Of Reciever(Billed To) <?php if ($row4["be_customerid"] == "0") {
    	?>
        <br>Name:
        <?php
		echo $row4["be_customername"];?>
		<br>Address:
		<?php
		echo $row4["be_customermobile"]; 
		?>
        <br>State: <?php if($row4["be_statecode"]=="AN"){echo "Andaman and Nicobar Islands ";}
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
        <br>State Code:<?php if($row4["be_statecode"]==''){echo"KL";}else{echo $row4["be_statecode"];}?><br>
        GSTIN Nmber:  <?php echo $row4["be_customer_tin_num"];
        } 
		else {?>
        Name:
        <?php
		echo $row5["cs_customername"];?>
		<br>Address:
		<?php
		echo $row5["cs_address"]; 
		?>
        <br> State:<?php if($row5["cs_statecode"]=="AN"){echo "Andaman and Nicobar Islands ";}
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
        State Code: <?php echo $row5["cs_statecode"];?>
        <br>GSTIN Nmber:  <?php echo $row5["cs_tin_number"];}?></td>
    <td width="45%" style="padding:5px; text-align:right;">
    				
                    Date And Time: <?=$row4["be_billdate"]?><br>
                    Your Invoice Serial Number:  <?=$row4["be_billnumber"]?><br>
                
                    </td>
  </tr>
</table>

<table width="100%" class="fnt" style="margin-bottom:23px;border-bottom: 1px #808080 solid;">
<tr style="border-bottom: 1px #808080 solid;">
<th  style="width:25px;" > SI No</th>
<th  >Description Of Goods</th>
<th  style="width:75px;" >HSN<br>code</th>
<th  style="width:50px;" >Qty</th>
<th   style="width:75px;" width="20" >UOM</th>
<th  style="width:50px;" >Rate</th>
<th  style="width:50px;" >Total</th>
</tr>
<?php
$k=1;
$j=0;
$tcgst=0;
$tsgst=0;
$tigst=0;
$qty=0;
$unit=0;
$pri=0;
$total=0;
$bill2=$conn->query("SELECT * FROM us_billitems a LEFT JOIN us_products b ON b.pr_productid=a.bi_productid WHERE a.bi_billid='$billid' LIMIT 32");
$tot=0;
while($row6=$bill2->fetch_assoc()){?>
<tr style="text-align:center;">
	<td><?php echo $k;?></td>
    <td><?php echo $row6['pr_productname'];?></td>
    <td><?php echo $row6['pr_hsn'];?></td>
    <td><?php echo $row6['bi_quantity']; $qty=$qty+$row6['bi_quantity'];?></td>
    <td><?php echo $row6['pr_unit'];$unit=$unit+$row6['bi_quantity'];?></td>
    <td><?php echo $row6['bi_price'];$pri=$pri+$row6['bi_quantity'];?></td>
    <td>&#8377;<?php echo $row6['bi_quantity'] * $row6['bi_price']; $total=$total+$row6['bi_quantity']*$row6['bi_price']; ?></td>    
</tr>
<?php $k++; }
while($k<=32)
{?>
<tr style="border-bottom:0px solid white;"><td colspan="7">&nbsp;</td></tr>
<?php $k++;}?>


<tr>
<td></td>
<td style="padding-left:40%;">CGST &nbsp;&nbsp;SGST &nbsp;&nbsp;IGST <br><span style="padding-left:4%"><?php echo $row4['cgst_amount']?></span><span style="padding-left:9%"><?php echo $row4['sgst_amount']?></span><span style="padding-left:12%"><?php echo $row4['igst_amount']?></span></td>
<td></td>
</tr>

<tr>
<td></td>
<td></td>
<td></td>
</tr>
<tr style="border-bottom: 1px #808080 solid;">

	<td colspan="3"style="text-align:left">Sub Total</td>
    <td style="text-align:center"><?php echo $qty;?></td>
    <td style="text-align:center"><?php echo $pri?></td>
    <td style="text-align:center"><?php echo $total?></td>
    <td></td>
    <?php $total1=$total;?>
</tr>

<tr>
	<td colspan="6"style="text-align:left">Round Off</td>
    <td style="text-align:center"><?php echo round($total);?></td>
</tr>

<tr>
	<td colspan="6"style="text-align:left">Discount</td>
    <td style="text-align:center"><?php echo $row4['be_discount'] ;?></td>
    
</tr>

<tr >
	<td colspan="6"style="text-align:left">Grand total</td>
    <td style="text-align:center"><?php echo $row4['be_gtotal'] ;?></td>
    
</tr>
<tr style="border-bottom: 1px #808080 solid;">

<td colspan="7" style="text-align:center">Rs.<?php $amd=convert_number_to_words(round($row4['be_gtotal']));echo $amd;?></td>
</tr>
<tr>

<tr>
<td colspan="7"><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p></td>
</tr>
<tr>
<td colspan="7"  style="text-align:right">Authorised Signatory</td>
</tr>

</table>
<?php
}
?>
</body>
</html>