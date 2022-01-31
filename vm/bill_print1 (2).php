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
@font-face {
   font-family: eras;
   src: url(includes/eras-bold-itc.ttf);
}
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
	.s4{font-size:20px;}
	.s5{font-size:18px;}
	.s6{font-size:16px;}
	.s7{font-size:8px;}
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
	$numbill=$numbill+1;
	$ttl=intval($numbill);
}



$profl = $conn->query("SELECT * FROM us_shopprofile WHERE sp_shopid='".$_SESSION["admin"]."'");
$row3 = $profl->fetch_assoc();
$bill = $conn->query("SELECT * FROM us_billentry WHERE be_billid='$billid'");
$row4=$bill->fetch_assoc();
$cust= $conn->query("SELECT * FROM us_customer WHERE cs_customerid='".$row4["be_customerid"]."'");
		$row5=$cust->fetch_assoc();

?>
<table  style="width:100%;"   style="text-align:center" border="1">
	<tr height="100px" style="text-align:center">
  	
   <!-- <th style="width:150px;"></th><th><span>INVOICE</span></th><br>-->
   <!--<th colspan="2" rowspan="2" ><img src="../assets/LED.png" alt="" align="middle" style="width:450px;"></th>-->
	
   <td style="text-align:center"><span class="eras" style="font-family:forte;" style="text-align:center"><b><span class="s1"><?=$row3["sp_shopname"]?></span></b><br>
 			<?=$row3["sp_shopaddress"]?><br>
           
            <?=$row3["sp_email"]?></span>
            <?php $stcode_s=$row3["sp_stcode"];?>
   <?=$row3["sp_phone"]?><br><?=$row3["sp_mobile"]?></td>
  </tr>
</table> 
 
<table style="text-align: left; border-color:#000;" width="100%" border="1">
   <tr border="1" >
    <td  style="padding:5px;width:50%;">GSTin Number: <?=$row3["sp_tin"]?><br>
    				Tax is Payable On Reverse Charge(Yes/No):<br>
                    Invoice Serial Number:  <?=$row4["be_billnumber"]?><br>
                    Invoice Date: <?=$row4["be_billdate"]?>
    </td>
    <td  style="padding:5px;width:50%;">Transportation Mode:<br><span style="font-size:9px">(Apply For Supply Of Goods Only)</span><br>
    				Vehicle Number: <?=$row4["be_vehicle_number"]?><br>
                    Date And Time Of Supply:<?=$row4["be_billdate"]?><br>
                    Place Of Supply: <b><?php if ($row4["be_customerid"] == "0") { 
						 if($row4["be_statecode"]=="AN"){echo "Andaman and Nicobar Islands ";}
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
                         else {echo "Kerala";}}
					else{
						 if($row5["cs_statecode"]=="AN"){echo "Andaman and Nicobar Islands ";}
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
                         else {echo "Kerala";}
						}	 
					
					
					
					
					
					?></b>
                    </td>
  </tr>
</table>
<table border="1" width="100%" class="table">
	<tr>
    	<td style="text-align:center;width: 50%;">Details Of Reciever (Billed To)</td>
        <td style="text-align:center;width: 50%;">Details Of Consignee</td>
	</tr>
    <tr>
   
    	<td style="padding:5px;"> <?php if ($row4["be_customerid"] == "0") {
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
                         else {echo "Kerala";}?></b> 
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
        
        <td style="padding:5px;"> <?php if ($row4["be_customerid"] == "0") {
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
                         else {echo "Kerala";}?></b>
        
        
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
<div style="border: 1px #808080 solid;margin-bottom:5px;" class="nonborder">
<table width="100%" class="fnt" style="border:1px solid #808080;">
<tr>
<th rowspan="2" style="width:10px;" bgcolor="#999999"> SI No</th>
<!--<th rowspan="2" bgcolor="#999999" style="width:50px;">Code</th>-->
<th rowspan="2" bgcolor="#999999" align="left">Description Of Goods</th>
<th rowspan="2" style="width:75px;" bgcolor="#999999">HSN<br>code</th>
<th rowspan="2" style="width:30px;" bgcolor="#999999">Qty</th>
<th  rowspan="2" style="width:75px;" width="20" bgcolor="#999999">UOM</th>

<th rowspan="2" style="width:50px;" bgcolor="#999999">Rate</th>
<th rowspan="2" style="width:50px;" bgcolor="#999999">Total</th>
<th rowspan="2" style="width:30px;" bgcolor="#999999">Dis %</th>
<th  rowspan="2" style="width:50px;" bgcolor="#999999">Taxable Values</th>


<th colspan="2"  style="width:60px;" bgcolor="#999999">CGST</th>
<th  colspan="2"style="width:60px;" bgcolor="#999999">SGST</th>

<th colspan="2"  style="width:60px;" bgcolor="#999999">IGST</th>
<th  rowspan="2" style="width:60px;" bgcolor="#999999">Net Amount</th>
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
$k=1;
$j=0;
$tcgst=0;
$tsgst=0;
$tigst=0;
$bill2=$conn->query("SELECT * FROM us_billitems a LEFT JOIN us_products b ON b.pr_productid=a.bi_productid WHERE a.bi_billid='$billid' LIMIT 15");
$tot=0;
while($row6=$bill2->fetch_assoc()){?>
<tr style="text-align:center;">
	<td><?php echo $k;?></td>
    <td style="display:none;"><?php echo $row6['pr_productcode'];?></td>
    <td align="left" style="width:30%; font-size: 14px;"><?php echo $row6['pr_productname'];?></td>
    <td><?php echo $row6['pr_hsn'];?></td>
    <td><?php echo $row6['bi_quantity'];?></td>
    <td><?php echo $row6['pr_unit'];?></td>
    <td><?php echo $row6['bi_price'];?></td>
    <td><?php echo $row6['bi_quantity'] * $row6['bi_price']; ?></td>
    <td><?php echo $row6['bi_discount']?></td>
    <td><?php echo ($row6['bi_taxamount'])?></td>
    
    <td><?php echo $row6['bi_cgst'];?>%</td>
    <td><?php $tcgst=$tcgst+$row6['bi_cgst_amt'];echo $row6['bi_cgst_amt'];?></td>
    <td><?php echo $row6['bi_sgst'];?>%</td>
    <td><?php $tsgst=$tsgst+$row6['bi_sgst_amt'];echo $row6['bi_sgst_amt'];?></td>
   
    <td><?php echo $row6['bi_igst'];?>%</td>
    <td><?php $tigst=$tigst+$row6['bi_igst_amt'];echo $row6['bi_igst_amt'];?></td>
    
    <td align="right"><?php $tot=$tot+round($row6['bi_total']);echo round($row6['bi_total']).".00";?></td>
</tr>
<?php $k++; }
while($k<=15)
{?>
<tr style="border-bottom:0px solid white;"><td colspan="<?=$clmspan+7?>">&nbsp;</td></tr>
<?php $k++;}?>
<tr style="border-top: 2px #808080 solid">
	<td  colspan="9"></td>
    
    
   
    <td>CGST</td>
    <td><?=$tcgst?></td>
    <td>SGST</td>
    <td><?=$tsgst?></td>
    <td>IGST</td>
    <td><?=$tigst?></td>
    <td></td>
</tr>
<?php if($r==$ttl){?>
<tr>
	
    <td colspan="<?=$clmspan+8?>" style="text-align:right">Discount</td>
    <td align="right"><?=round($row4["be_discount"]).".00"?></td>
    
</tr>
<tr>
	
    <td colspan="<?=$clmspan+8?>" style="text-align:right">Total</td>
    <td align="right"><?=round($tot).".00"?></td>
    
</tr>

<tr>
	
    <td colspan="<?=$clmspan+8?>" style="text-align:right">Freight</td>
    <td align="right"><?=round($row4["be_coolie"]).".00"?></td>
    
</tr>
<tr style="height:50px;">
	<td colspan="<?=$clmspan+6?>"style="text-align:center">Invoice Value(In Words): <?php $amd=convert_number_to_words($row4["be_gtotal"]);echo $amd;?></td>
    <td colspan="2" style="text-align:right"><b>Total</b></td>
    <td style="text-align:right"><b><?php echo round($row4["be_gtotal"]).".00";?></b></td>
    
</tr>
<?php }else{?>
<tr>
    <td colspan="<?=$clmspan+9?>" style="text-align:right">&nbsp;</td>
</tr>
<tr>
    <td colspan="<?=$clmspan+9?>" style="text-align:right">&nbsp;</td>
</tr>
<tr>
    <td colspan="<?=$clmspan+9?>" style="text-align:right">&nbsp;</td>
</tr>
<tr>
    <td colspan="<?=$clmspan+9?>" style="text-align:right">Continue..</td>
</tr>
<?php }?>
</table>
</div>
<!--<div style="width:300px;float:right; text-align:center;">
For <?=$row3["sp_shopname"]?><br>( authorised signature )
</div>-->
<table width="100%" border="1" style="text-align:center;">
<tr>
	<td>Certified that the Particulars given above are true and correct</td>
    <td>Electronic Reference Number</td>
    
</tr>
<tr style="height:50px;">
	<td></td>
    <td></td>
</tr>
<tr>
	<td>Terms & Conditions</td>
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
</table>

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
   <th colspan="2" rowspan="2" ><img src="../assets/LED-copy2.png" alt="" align="middle" style="width:450px;"></th>
	
   <!-- <span class="eras" style="font-family:forte;"><b><span class="s1"><?=$row3["sp_shopname"]?></span></b><br>
 			<?=$row3["sp_shopaddress"]?><br>
           
            <?=$row3["sp_email"]?></span>
            <?php $stcode_s=$row3["sp_stcode"];?>
   <th style="width:150px; text-align:right; padding-right:10px;"><?=$row3["sp_phone"]?><br><?=$row3["sp_mobile"]?></th>-->
  </tr>
</table> 
<table style="text-align: left; border-color:#000;" width="100%" border="1">
   <tr border="1" >
    <td  style="padding:5px;width: 50%;">GSTin Number: <?=$row3["sp_tin"]?><br>
    				Tax is Payable On Reverse Charge(Yes/No):<br>
                    Invoice Serial Number:  <?=$row4["be_billnumber"]?><br>
                    Invoice Date: <?=$row4["be_billdate"]?>
    <td  style="padding:5px;width: 50%;">Transportation Mode:<br><span style="font-size:9px">(Apply For Supply Of Goods Only)</span><br>
    				Vehicle Number: <?=$row4["be_vehicle_number"]?><br>
                    Date And Time Of Supply:<?=$row4["be_billdate"]?><br>
                    Place Of Supply: <b><?php if ($row4["be_customerid"] == "0") { 
						 if($row4["be_statecode"]=="AN"){echo "Andaman and Nicobar Islands ";}
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
                         else {echo "Kerala";}}
					else{
						 if($row5["cs_statecode"]=="AN"){echo "Andaman and Nicobar Islands ";}
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
                         else {echo "Kerala";}
						}	 
					
					
					
					
					
					?></b>
                    </td>
  </tr>
</table>
<table border="1" width="100%" class="table">
	<tr>
    	<td style="text-align:center;width: 50%;">Details Of Reciever (Billed To)</td>
        <td style="text-align:center;width: 50%;">Details Of Consignee(Shipped To)</td>
	</tr>
    <tr>
   
    	<td style="padding:5px;"> <?php if ($row4["be_customerid"] == "0") {
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
			case 'GJ':echo "22";break;
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
                         else {echo "Kerala";}?> </b>
        <br>
        State Code: <b><?php switch($row5["cs_statecode"])
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
        
        <td style="padding:5px;"> <?php if ($row4["be_customerid"] == "0") {
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
                         else {echo "Kerala";}?></b>
        <br>State Code:<b><?php if($row4["be_statecode"]==''){echo"32";}else{switch($row4["be_statecode"])
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
                         else {echo "Kerala";}?></b>
        
        
         <br>
        State Code: <b><?php switch($row5["cs_statecode"])
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
<div style="border: 1px #808080 solid;margin-bottom:5px;" class="nonborder">
<table width="100%" class="fnt" style="border:1px solid #808080">
<tr>
<th rowspan="2" style="width:25px;" bgcolor="#999999"> SI No</th>	
<!--<th  bgcolor="#999999" rowspan="2">Code</th>-->
<th rowspan="2" bgcolor="#999999" align="left">Description Of Goods</th>
<th rowspan="2" style="width:75px;" bgcolor="#999999">HSN<br>code</th>
<th rowspan="2" style="width:50px;" bgcolor="#999999">Qty</th>
<th  rowspan="2" style="width:75px;" width="20" bgcolor="#999999">UOM</th>

<th rowspan="2" style="width:50px;" bgcolor="#999999">Rate</th>
<th rowspan="2" style="width:50px;" bgcolor="#999999">Total</th>
<th rowspan="2" style="width:50px;" bgcolor="#999999">Dis %</th>
<th  rowspan="2" style="width:50px;" bgcolor="#999999">Taxable Values</th>

<th colspan="2"  style="width:100px;" bgcolor="#999999">CGST</th>
<th  colspan="2"style="width:100px;" bgcolor="#999999">SGST</th>
<th colspan="2"  style="width:100px;" bgcolor="#999999">IGST</th>
<th  rowspan="2" style="width:50px;" bgcolor="#999999">Net Amount</th>
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
//$k=1;
$tcgst=0;
$tsgst=0;
$tigst=0;
$bill2=$conn->query("SELECT * FROM us_billitems a LEFT JOIN us_products b ON b.pr_productid=a.bi_productid WHERE a.bi_billid='$billid' LIMIT ".$j.",15");

while($row6=$bill2->fetch_assoc()){?>
<tr style="text-align:center;">
	<td><?php echo $k;?></td>
    <td style="display:none;"><?php echo $row6['pr_productcode'];?></td>
    <td align="left" style="width:30%; font-size: 14px;"><?php echo $row6['pr_productname'];?></td>
    <td><?php echo $row6['pr_hsn'];?></td>
    <td><?php echo $row6['bi_quantity'];?></td>
    <td><?php echo $row6['pr_unit'];?></td>
    <td><?php echo $row6['bi_price'];?></td>
    <td><?php echo $row6['bi_quantity'] * $row6['bi_price']; ?></td>
    <td><?php echo $row6['bi_discount']?></td>
    <td><?php echo ($row6['bi_taxamount'])?></td>
	

    <td><?php echo $row6['bi_cgst'];?>%</td>
    <td><?php $tcgst=$tcgst+$row6['bi_cgst_amt'];echo $row6['bi_cgst_amt'];?></td>
    <td><?php echo $row6['bi_sgst'];?>%</td>
    <td><?php $tsgst=$tsgst+$row6['bi_sgst_amt'];echo $row6['bi_sgst_amt'];?></td>
    <td><?php echo $row6['bi_igst'];?>%</td>
    <td><?php $tigst=$tigst+$row6['bi_igst_amt'];echo $row6['bi_igst_amt'];?></td>
    <td align="right"><?php $tot=$tot+round($row6['bi_total']);echo round($row6['bi_total']).".00";?></td>
</tr>
<?php $k++; }
while($k<=$j+15)
{?>

<tr style="border-bottom:0px solid white;"><td colspan="<?=$clmspan+7?>">&nbsp;</td></tr>
<?php $k++;}?>
<tr style="border-top: 2px #808080 solid">
	<td  colspan="9"></td>
    
    
    <td>CGST</td>
    <td><?=$tcgst?></td>
    <td>SGST</td>
    <td><?=$tsgst?></td>
    <td>IGST</td>
    <td><?=$tigst?></td>
    <td></td>
</tr>
<?php if($r==$ttl){?>
<tr>
	
    <td colspan="<?=$clmspan+8?>" style="text-align:right">Discount</td>
    <td align="right"><?=round($row4["be_discount"]).".00"?></td>
    
</tr>
<tr>
	
    <td colspan="<?=$clmspan+8?>" style="text-align:right">Total</td>
    <td align="right"><?=round($tot).".00"?></td>
    
</tr>

<tr>
	
    <td colspan="<?=$clmspan+8?>" style="text-align:right">Freight</td>
    <td align="right"><?=round($row4["be_coolie"]).".00"?></td>
    
</tr>
<tr style="height: 50px;">
	<td colspan="<?=$clmspan+6?>"style="text-align:center">Invoice Value(In Words): <?php $amd=convert_number_to_words($row4["be_gtotal"]);echo $amd;?></td>
    <td colspan="2" style="text-align:right"><b>Total</b></td>
    <td align="right"><b><?=round($row4["be_gtotal"]).".00"?></b></td>
    
</tr>
<?php }else{?>
<tr>
    <td colspan="<?=$clmspan+9?>" style="text-align:right">&nbsp;</td>
</tr>
<tr>
    <td colspan="<?=$clmspan+9?>" style="text-align:right">&nbsp;</td>
</tr>
<tr>
    <td colspan="<?=$clmspan+9?>" style="text-align:right">&nbsp;</td>
</tr>
<tr>
    <td colspan="<?=$clmspan+9?>" style="text-align:right">Continue..</td>
</tr>
<?php }?>
</table>
</div>
<!--<div style="width:300px;float:right; text-align:center;">
For <?=$row3["sp_shopname"]?><br>( authorised signature )
</div>-->
<table width="100%" border="1" style="text-align:center;">
<tr>
	<td>Certified that the Particulars given above are true and correct</td>
    <td>Electronic Reference Number</td>
    
</tr>
<tr style="height:50px;">
	<td></td>
    <td></td>
</tr>
<tr>
	<td>Terms & Conditions</td>
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
</table>

<footer></footer>
<?php
}$j=$j+15;}
?>
</body>
</html>