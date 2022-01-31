<html>
<title></title>
<head> 
<link rel="stylesheet" type="text/css" media="print" href="custom/css/print.css" />
<style>
body{color:#000000;margin:0px!important;font-size: 15px !important;}
body {font-family:Verdana, Geneva, sans-serif;}
table {
    border-collapse: collapse;
}
table td
{
	height:20px;
	
}


	@media print{

    body{color:#000000;margin:0px!important;font-size: 15px !important;}
body {font-family:Verdana, Geneva, sans-serif;}
	.btn{display:none;}

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
<?php if(isset($_GET["back"])){?><a href="<?= $_GET["back"]?>"><button style="float:left;" class="btn">back</button></a><?php }else{?><a href="dashboard.php"><button style="float:left;" class="printButtonClass btn">back</button></a><?php }?>
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

$cust= $conn->query("SELECT * FROM us_customer WHERE cs_customerid='".$row["be_customerid"]."'");
    $row5=$cust->fetch_assoc();
?>

<table style="text-align:center;border-bottom: 0px #808080 solid;" width="100%"  > 
<tr>
  <!--<th style="border-center:1px solid #FFF; width:115px;"><img src="assets/grace.jpg"   style="width: 114px;height: 90px; float:center"></th>-->
  </tr>
  <tr>
    <td ><b><span style="font-size:11px;"><?=$row3['sp_shopname']?></span><br>
 			<span class="s4" ><?=$row3["sp_shopaddress"]?><br><span class="s4" >GSTIN:<?=$row3["sp_tin"]?><br>
            <span class="s4" ><?=$row3["sp_phone"]?> &nbsp;,<?=$row3["sp_mobile"]?></b>
     </td>  
  </tr>
</table>
<table border="1" width="100%">
  
  <tr>
    <td>Bill No.</td>
    <td>Date</td>
    <td rowspan="2">State: Kerala<br>
                    State Code: 32</td>
  </tr>
  <tr>
    <td><?=$row["be_billnumber"]?></td>
    <td><?=date('d-m-Y', strtotime($row["be_billdate"]))?></td>
  </tr>
</table><br>

<table style="text-align: left;border-bottom: 1px #808080 solid;" width="100%">
   <tr ><span class="s5" >
   <td style="padding:5px;"  colspan="4"> <span class="s4" >Details Of Reciever(Billed To)  <?php if ($row["be_customerid"] == "0") {
      ?>
        <br><span class="s4" >Name:
        <?php
    echo $row["be_customername"];?>
    <br><span class="s4" >Address:
    <?php
    echo $row["be_customermobile"]; 
    ?>
        <br><span class="s4" >State: <?php if($row["be_statecode"]=="AN"){echo "Andaman and Nicobar Islands ";}
                         elseif($row["be_statecode"]=="AP"){echo "Andhra Pradesh";}
                         elseif($row["be_statecode"]=="AD"){echo "Andhra Pradesh";}                                                                                   elseif($row["be_statecode"]=="AR"){echo "Arunachal Pradesh";}
                         elseif($row["be_statecode"]=="AS"){echo "Assam";}
                         elseif($row["be_statecode"]=="BH"){echo "Bihar";}
                         elseif($row["be_statecode"]=="CH"){echo "Chandigarh";}
                         elseif($row["be_statecode"]=="CT"){echo "Chattisgarh";}
                         elseif($row["be_statecode"]=="DN"){echo "Dadra and Nagar Haveli";}
                         elseif($row["be_statecode"]=="DD"){echo "Daman and Diu";}
                         elseif($row["be_statecode"]=="DL"){echo "Delhi";}
                         elseif($row["be_statecode"]=="GA"){echo "GoA";}
             elseif($row["be_statecode"]=="GJ"){echo "Gujarat";}
                         elseif($row["be_statecode"]=="HR"){echo "Hariyana";}                           
                         elseif($row["be_statecode"]=="HP"){echo "Himachal Pradesh";}
                         elseif($row["be_statecode"]=="JK"){echo "Jammu And Kashmir";}
                         elseif($row["be_statecode"]=="JH"){echo "Jharkhand";}
                         elseif($row["be_statecode"]=="KA"){echo "Karnataka";}
                         elseif($row["be_statecode"]=="KL"){echo "Kerala";}
                         elseif($row["be_statecode"]=="LD"){echo "LakshadWeep Island";}
                         elseif($row["be_statecode"]=="MP"){echo "Madhya Pradhesh";}
                         elseif($row["be_statecode"]=="MH"){echo "Maharastra";}
                         elseif($row["be_statecode"]=="MN"){echo "Manipur";}
                         elseif($row["be_statecode"]=="ME"){echo "Meghalaya";}
                         elseif($row["be_statecode"]=="MI"){echo "Mizoram";}                           
                         elseif($row["be_statecode"]=="NL"){echo "Nagaland";}
                         elseif($row["be_statecode"]=="OR"){echo "Odisha";}
                         elseif($row["be_statecode"]=="PY"){echo "Pondicherry";}
                         elseif($row["be_statecode"]=="PB"){echo "Punjab";}
                         elseif($row["be_statecode"]=="RJ"){echo "Rajasthan";}                           
                         elseif($row["be_statecode"]=="SK"){echo "Sikkim";}
                         elseif($row["be_statecode"]=="TN"){echo "Tamil Nadu";}
                         elseif($row["be_statecode"]=="TS"){echo "Telangana";}
                         elseif($row["be_statecode"]=="TR"){echo "Tripura";}
                         elseif($row["be_statecode"]=="UP"){echo "Uttar Pradesh";}
                         elseif($row["be_statecode"]=="UI"){echo "Uttarakhand";}
                         elseif($row["be_statecode"]=="WB"){echo "West Bengal";}
                         else {echo "Kerala";}?>
        <br><span class="s4" >State Code:<?php if($row["be_statecode"]==''){echo"32";}else{echo 32;}?><br>
        <span class="s4" >GSTIN Nmber:  <?php echo $row["be_customer_tin_num"];
          ?> 
   <?php } else { ?>
        <span class="s4" >Name:
        <?php
    echo $row5["cs_customername"];?>
    <br><span class="s4" >Address:
    <?php
    echo $row5["cs_address"]; 
    ?>
        <br> <span class="s4" >State:<?php if($row5["cs_statecode"]=="AN"){echo "Andaman and Nicobar Islands ";}
                         elseif($row5["cs_statecode"]=="AP"){echo "Andhra Pradesh";}
                         elseif($row5["cs_statecode"]=="AD"){echo "Andhra Pradesh";}                                                                                   elseif($row5["cs_statecode"]=="AR"){echo "Arunachal Pradesh";}
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
        <span class="s4" >State Code: 32
        <br><span class="s4" >GSTIN Nmber:  <?php echo $row5["cs_tin_number"];}?></td>
   
  </tr></span>
</table>

<table  style="text-align:left;border-bottom: 1px #808080 solid;" width="100%">
<tr style="border-bottom: 1px #808080 solid;" width="100%">
<th width="7%"><span class="s4" > SI.&nbsp;</th>
<th style="display:none;" width="100px" style bgcolor="#999999"><span class="s3" > ITEM CODE</th>

<th><span class="s4">ITEM </th>

<th   width="15%" ><span class="s4">  QTY&nbsp;&nbsp;</th>

<th  width="10%" ><span class="s4"> RATE&nbsp;</th>

<th  width="10%" ><span class="s4"> TAX&nbsp;</th>


<th   width="15%" ><span class="s4">  Rs </th>
</tr>
<?php
$i=1;

$slctitm=$conn->query("SELECT * FROM us_billitems a LEFT JOIN us_products b ON b.pr_productid=a.bi_productid WHERE a.bi_billid='$billid'");
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

<td width="70%" style="font-size:10px;" ><span class="s3"><b>
<?php

	
	echo $rowitm["pr_productname"];
?>&nbsp;&nbsp;</b>
</td>
<td ><span class="s4"><?php echo $rowitm["bi_quantity"]?></td>

<td ><span class="s4"><?php echo $rowitm["bi_taxamount"]?></td>

<td ><span class="s4"><?php echo $rowitm["bi_vatper"]?>%</td>


<td align="right" ><span class="s4"><?=$rowitm["bi_total"]?></td>

</tr>
<?php $i++;}
	$cnt=$conn->query("SELECT COUNT(bi_billitemid) AS cnts FROM us_billitems WHERE bi_billid='$billid'");
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
<td align="right"><span class="s3"><?php $slctitm=$conn->query("SELECT SUM(bi_cgst_amt) as ttlcgst, SUM(bi_sgst_amt) as ttlsgst,SUM(bi_igst_amt) as ttligst from us_billitems where bi_billid='$billid' and bi_isactive='0'");
 $rowitm=$slctitm->fetch_assoc();
 $gst=$rowitm["ttlcgst"]+=$rowitm["ttlsgst"]+=$rowitm["ttligst"];
 echo  round($gst)?></td>
  </tr>-->
  
 

<!--<table width="100%" style="font-size: 12px; border-bottom: 1px #808080 solid;">
<tr>
<td>Prepared By Admin</td><td style="text-align:right"></td>
</tr>
<tr>
<td><br>Checked By </td><td style="text-align:right"></td>
</tr>
</table>-->

<table table width="100%" style="font-size: 12px; border-bottom: 2px #808080 solid;border-top: 2px #808080 solid;">
<tr>
    <td colspan="6">
      Old Balance: 
	  <?php echo $row["be_oldbal"]; ?>
    </td>
  </tr>
    <tr>
    <td colspan="6">
      Total Discount: 
	  <?php echo $row["be_discount"]; ?>
    </td>
  </tr>
  <tr>
    <td colspan="6">
      Tax Summary
    </td>
  </tr>
  <tr>
    <td>
      Tax
    </td>
    <td>
      Tax Amount
    </td>
    <td>
      CGST
    </td>
    <td>
      SGST
    </td>
    <td>
      IGST
    </td>
    </tr>
    <?php 
$slctitsss=$conn->query("SELECT bi_vatper,SUM(bi_vatamount) as taxamnt, SUM(bi_cgst_amt) as cgsta, SUM(bi_sgst_amt) as sgsta , SUM(bi_igst_amt) as igsta FROM us_billitems  WHERE bi_billid='$billid' group by bi_vatper");







    

    while($rowitss=$slctitsss->fetch_assoc())
     {  ?>
  

  <tr>
    <td><?=round($rowitss['bi_vatper'],2)?>%</td>
<td><?=round($rowitss['taxamnt'],2)?></td>
<td><?=round($rowitss['cgsta'],2)?></td>
<td><?=round($rowitss['sgsta'],2)?></td>
<td><?=round($rowitss['igsta'],2)?></td>
  </tr>
  <?php  } ?>
</table>

<table width="100%" style="font-size: 20px; border-bottom: 2px #808080 solid;border-top: 2px #808080 solid;">
<tr>
<td style="text-align:center;font-size:17px;height: 17px;"><b>GRANT TOTAL: <?=$row["be_gtotal"]?></b></td><td style="text-align:right"></td>
</tr>
<tr>
<td style="text-align:center;font-size:15px;height: 15px;">Total Invoice Amount in Words<br/>     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Rupees <?php $gtotl=($row["be_gtotal"]); $amd=convert_number_to_words($row['be_gtotal']);echo $amd;?><br>Thanks you visit again..!!</b></td>
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