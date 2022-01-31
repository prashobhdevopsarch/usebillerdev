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
   font-family: eras;
   src: url(includes/eras-bold-itc.ttf);
}
.eras{font-family:eras;}
.fnt td,.fnt th{border:1px solid grey; font-size:12px;}
.nonborder td{border-bottom:1px solid #FFF !important;}
.border td{border:1px solid #000;}

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
	$numbill=$cnt1/28;
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
<table style="text-align:center; border:1px solid #fff;" width="100%" class="nonborder">
	<tr height="40px">
  	
    <th style="width:150px;"></th><th>
	
    <span class="eras"><b><span class="s1"><?=$row3["sp_shopname"]?></span></b><br>
 			<?=$row3["sp_shopaddress"]?><br>
           
            <?=$row3["sp_phone"]?> &nbsp;<?=$row3["sp_mobile"]?><br>GSTIN : <b><?=$row3["sp_tin"]?></b></span>
            <?php $stcode_s=$row3["sp_stcode"];?>
    </th><th style="width:150px; text-align:right; padding-right:10px;"></th>
  </tr>
  <tr>
  <th align="left"><b>Invoice No.<?=$row4["be_billnumber"]?> </b></th><th></th><th align="left"></th>
  </tr>
</table> 
<!--<table style="text-align: left; border-color:#000;" width="100%" border="1">
   <tr border="1" >
    <td  style="width:40%;">GST NO : <b><?=$row3["sp_tin"]?></b><br>DOOR NO : <b><?=$row3["sp_door"]?></b>
    </td>
    <td  style="width:100%; border-left:1px solid #FFF; text-align:left">
    <span class="eras"><img src="../assets/hanger.png" style="width:30%;" align="left"></span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td  style="padding:5px;width:40%; border-left:1px solid #FFF">
                    
                    </td>
                    <td  style="padding:5px;width:40%; border-left:1px solid #FFF">
                                        </td>
                    <td  style="padding:5px;width:40%; border-left:1px solid #FFF">
                    <b>Ph:<?=$row3["sp_mobile"]?></b>
                    </td>
                    <td  style="padding:5px;width:40%; border-left:1px solid #FFF">
                    
                    </td>
                    
  </tr>
  <tr style="border-top:1px solid #fff">
    <td  style="width:40%;" colspan="6" align="center"><b><?=$row3["sp_shopaddress"]?></b> 
    </td>
     </tr>
  <tr style="border-top:1px solid #fff">
    <td  style="width:40%; border-right:1px solid #FFF" ><b>Invoice No.<?=$row4["be_billnumber"]?> </b></td>
    <td style="width:40%; border-right:1px solid #FFF"></td><td style="width:40%; border-right:1px solid #FFF"></td><td style="width:40%; border-right:1px solid #FFF"></td>
    <td style="width:40%;" colspan="2"> Date:&nbsp;<?=date('d-m-Y', strtotime($row4["be_billdate"]))?></b>
    </td>
    </tr>
  
  <tr style="border-top:1px solid #FFF; text-align:left;">
  <td  style="padding:5px;width:40%;">
   <?php if ($row4["be_customerid"] == 0) {
    	?>
  Bill To. &nbsp;<?=$row4["be_customername"]?><br>GSTIN: <?=$row4["be_customer_tin_num"]?>
  <?php } 
		else {?>
        Bill To. &nbsp;<?=$row5["cs_customername"]?><br>GSTIN: <?=$row5["cs_tin_number"]?>
        <?php }?>
    </td>
    <td  style="padding:5px;width:40%; border-left:1px solid #FFF">
    State: <b><?php if ($row4["be_customerid"] == 0) { 
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
						}	 ?>
                    </td>
                    <td  style="padding:5px;width:40%; border-left:1px solid #FFF">
                    
                    </td>
                    <td  style="padding:5px;width:40%; border-left:1px solid #FFF">
                    
                    </td>
                    <td  style="padding:5px;width:40%; border-left:1px solid #FFF" colspan="2">
                    Code: <?php echo $row3["sp_stcode"]?>
                    </td>
                    
    </tr>
    
  <tr style="display:none;">
  <td style="padding:5px;width:40%;">
  
  Serial Number : <b><?=$row4["be_billnumber"]?></b><br>
  Date of Issue : <b><?=date('d-m-Y', strtotime($row4["be_billdate"]))?></b>
  </td>
  
            <td  style="padding:5px;width:40%; border-left:1px solid #FFF">
                    </td>       
  
  <td style="padding:5px;width:40%; border-left:1px solid #FFF">
  State: <b><?php if ($row4["be_customerid"] == 0) { 
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
						$stcode_c=$row5["cs_statecode"];
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
					
					
					
					
					
					?></b><br>
                     State Code : <?php echo $row3["sp_stcode"]?>
  </td>
   
                    <td  style="padding:5px;width:40%; border-left:1px solid #FFF">
                    </td>
                    <td  style="padding:5px;width:40%; border-left:1px solid #FFF">
                    </td>
                    
  </tr>
</table>-->
<table border="1" width="100%" class="table" >
	<tr>
    	<td style="text-align:left;width: 50%;">Reverse charge:<br>Invoice Date: <b><?=date('d-m-Y', strtotime($row4["be_billdate"]))?></b><br>State:<b><?php if($row4["be_statecode"]=="AN"){echo "Andaman and Nicobar Islands ";}
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
                         else {echo "Kerala";}?></b></td>
        <td style="text-align:left;width: 50%;">Transportation Mode: <br>Vehicle No:<?=$row4["be_vehicle_number"]?><br>Date of Supply:<?=date('d-m-Y', strtotime($row4["be_billdate"]))?><br>Place of Supply:<b><?php if($row4["be_statecode"]=="AN"){echo "Andaman and Nicobar Islands ";}
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
                         else {echo "Kerala";}?></b></td>
                         
	</tr>
    
    <tr>
   
    	<td style="padding:5px;" colspan="2"> <?php if ($row4["be_customerid"] == "0") {
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
                         
        
       <br> GSTIN/UIN :  <b><?php echo $row4["be_customer_tin_num"];
        } 
		else {?></b>
        Name:
        <b><?php
		echo $row5["cs_customername"];?></b>
		<br>Address:
		<b> <span style="font-size:10px;"><?php
		echo $row5["cs_address"]; 
		?></span></b>
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
        
        
        <br>GSTIN/UIN:  <b><?php echo $row5["cs_tin_number"];}?></b></td>
        
        <td style="padding:5px; display:none;"> <?php if ($row4["be_customerid"] == "0") {
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
        &nbsp;&nbsp;&nbsp;&nbsp; State Code:<b><?php if($row4["be_statecode"]==''){$stcode_c='KL';echo"32";}else{$stcode_c=$row4["be_statecode"];switch($row4["be_statecode"])
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
        GSTIN/UIN:  <b><?php echo $row4["be_customer_tin_num"];
        } 
		else {$cust= $conn->query("SELECT * FROM vm_customer WHERE cs_customerid='".$row4["be_customerid"]."'");
		$row5=$cust->fetch_assoc();?></b>
        Name:
        <b><?php
		echo $row5["cs_customername"];?></b>
		<br>Address:
		<b><span style="font-size:10px;"><?php
		echo $row5["cs_address"]; 
		?></span></b>
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
        
        
         
        &nbsp;&nbsp;&nbsp;&nbsp; State Code: <b><?php //echo $row5["cs_statecode"];
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
        <br>GSTIN/UIN:  <b><?php echo $row5["cs_tin_number"];}?></b></td>
        
     
        
    </tr>
</table>
<?php 
if($stcode_c==$stcode_s)
{
	$clmspan='7';
}else{$clmspan='5';}
?>
<div style="border: 1px #808080 solid;margin-bottom:5px;" class="nonborder">
<table width="100%" class="fnt" style="border:2px solid #808080;">
<tr>
<th  width="5%" bgcolor="#999999"> Sl.No</th>
<th  bgcolor="#999999" align="left" width="30%">Description of Goods</th>
<th  width="10%" bgcolor="#999999">HSN CODE</th>
<th  width="9%" bgcolor="#999999">Qty</th>
<th  width="10%" bgcolor="#999999">UOM</th>
<th  width="10%" bgcolor="#999999">Rate</th>
<!--<th  style="width:50px;" bgcolor="#999999">Amount</th>
<th  style="width:50px;" bgcolor="#999999">Taxable Value</th>
<th  style="width:30px;" bgcolor="#999999">&nbsp;&nbsp;Less Dis.&nbsp;&nbsp;</th>-->
<th  width="20%" bgcolor="#999999">Total</th>
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
$ig=0;
$tigst=0;
$bill2=$conn->query("SELECT * FROM vm_billitems a LEFT JOIN vm_products b ON b.pr_productid=a.bi_productid WHERE a.bi_billid='$billid' LIMIT 28");
$tot=0;
while($row6=$bill2->fetch_assoc()){?>
<tr style="text-align:center;">
	<td><?php echo $k;?></td>
    
    <td align="left"><?php echo $row6['pr_productname'];?></td>
    <td border-bottom="0"><?php echo $row6['pr_hsn'];?></td>
    <td><?php echo $row6['bi_quantity'];?></td>
    <td><?php echo $row6['pr_unit'];?></td>
    <td><?php echo $row6['bi_price'];?></td>
    <td><?php echo $row6['bi_total']?></td>
    <!--<?php if($stcode_c==$stcode_s)
	{?>
    <td><?php echo $row6['bi_cgst_amt'] + $row6['bi_sgst_amt']; ?></td>
    <?php }else{?>
    <td><?php echo $row6['bi_igst'];?>%</td>
    <?php }?>
    <?php if($stcode_c==$stcode_s)
	{?>
    <td><?php echo $row6['bi_cgst'];?>%</td>
    <td><?php $tcgst=$tcgst+round($row6['bi_cgst_amt']);echo ($row6['bi_cgst_amt']);?></td>
    <td><?php echo $row6['bi_sgst'];?>%</td>
    <td><?php $tsgst=$tsgst+round($row6['bi_sgst_amt']);echo ($row6['bi_sgst_amt']);?></td>
    <?php }else{?>
    <td><?php echo $row6['bi_igst'];?>%</td>
    <td><?php $tigst=$tigst+round($row6['bi_igst_amt']);echo ($row6['bi_igst_amt']);?></td>
    <?php }?>-->
    
</tr>
<?php
	$qt=$qt+$row6['bi_quantity'];
	$su=$su+$row6['bi_price'];
	$p= $row6['bi_taxamount']; 
	$tt=$tt+$row6['bi_total'];
	$cg=$cg+$row6['bi_cgst_amt'];
	$sg=$sg+$row6['bi_sgst_amt'];
	$ig=$ig+$row6['bi_igst_amt'];
?>
<?php $k++; }
while($k<=28)
{?>
<tr style="border-bottom:0px solid white;"><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>


<?php $k++;}?>

<tr style="border: 2px #000 solid">

 <td style="border-top: 2px #000 solid;border-bottom: 2px #000 solid; text-align:right;" colspan="2" align="right"><h3><b>Total: </b></h3></td>
 <td style="border-top: 2px #000 solid;border-bottom: 2px #000 solid;"></td>
 <td style="border-top: 2px #000 solid; text-align:center;"><?php echo $qt;?></td>
 <td style="border-top: 2px #000 solid; text-align:center;"></td>
  <td style="border-top: 2px #000 solid; text-align:center;"><?php echo $su;?></td> 
 <td style="border-top: 2px #000 solid; text-align:center;"><?php echo $tt;?></td>
 
 
 
 
 </tr>
 <?php if($r==$ttl){?>
 <tr style="border: 2px #808080 solid; text-align:left;" >
 
 <td width="100%" colspan="2" rowspan="4">
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
 <b>Total Amount After Tax</b>
 </td>
 <td align="center">
 <b><?php echo $tt; ?></b>
 </td>
 </tr>
 <tr style="border: 2px #808080 solid;">
 <td colspan="2" rowspan="3">
 <b>Bank Details<br>Bank Account Number: <?=$row3["sp_accno"]?></b><br><b>Bank Branch IFSC <?=$row3["sp_ifsc"]?></b>
 </td>
 <td rowspan="3" align="center">
 Seal
 </td>
 <td colspan="3">
<b>GST payable on Reverse Charge</b>
 </td>
 <td>
<b></b>
 </td>
 </tr>
 <tr style="border: 2px #808080 solid;">
 <td colspan="4">
 <b>Certified that the particulars given above are true and correct.</b><br>
 </td>
 </tr>
 <tr>
 <td colspan="4" align="right" style="border-top:2px solid #FFF;">
<br> <b>Authorized Signature</b>
 </td>
 </tr>
 
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
<?php }else{?>
<table width="100%" style="border-top:1px solid #fff; border-bottom:1px solid #fff; border-left:1px solid #fff; border-right:1px solid #fff">

<tr>
    <td colspan="<?=$clmspan+7?>" style="text-align:right; border-bottom:1px solid #fff"">&nbsp;</td>
</tr>
<tr>
    <td colspan="<?=$clmspan+7?>" style="text-align:right; border-bottom:1px solid #fff"">&nbsp;</td>
</tr>
<tr>
    <td colspan="<?=$clmspan+7?>" style="text-align:right; border-bottom:1px solid #fff"">&nbsp;</td>
</tr>
<tr>
    <td colspan="<?=$clmspan+7?>" style="text-align:right; border-bottom:1px solid #fff"">&nbsp;</td>
</tr>
<tr>
    <td colspan="<?=$clmspan+7?>" style="text-align:right; border-bottom:1px solid #fff"">&nbsp;</td>
</tr>
<tr>
    <td colspan="<?=$clmspan+7?>" style="text-align:right; border-bottom:1px solid #fff"">&nbsp;</td>
</tr>

<tr>
    <td colspan="<?=$clmspan+7?>" style="text-align:right; border-bottom:1px solid #fff"">&nbsp;</td>
</tr>
<tr>
    <td colspan="<?=$clmspan+7?>" style="text-align:right; border-bottom:1px solid #fff"">&nbsp;</td>
</tr>
<tr>
    <td colspan="<?=$clmspan+7?>" style="text-align:right; border-bottom:1px solid #fff"">&nbsp;</td>
</tr>
<tr>
    <td colspan="<?=$clmspan+7?>" style="text-align:right; border-bottom:1px solid #fff"">&nbsp;</td>
</tr>
<tr>
    <td colspan="<?=$clmspan+7?>" style="text-align:right; border-bottom:1px solid #fff"">&nbsp;</td>
</tr>
<tr>
    <td colspan="<?=$clmspan+7?>" style="text-align:right; border-bottom:1px solid #fff"">&nbsp;</td>
</tr>
<tr>
    <td colspan="<?=$clmspan+7?>" style="text-align:right">Continue..</td>
</tr>
<tr>
    <td colspan="<?=$clmspan+7?>" style="text-align:right; border-bottom:1px solid #fff"">&nbsp;</td>
</tr>
</table>
<?php }?>
</table>
</div>
<?php 
$j=0;
$j=$j+28;
while($cnt1>$j)
{
	$r++;	
$slctitm1=$conn->query("SELECT * FROM vm_billitems a LEFT JOIN vm_products b ON b.pr_productid=a.bi_productid WHERE a.bi_billid='$billid' LIMIT ".$j.",28");
if($slctitm1->num_rows>0)
{
?>
<table style="text-align:center; border:1px solid #fff;" width="100%" border="0">
	<tr height="40px">
  	
    <th style="width:150px;"></th><th>
	
    <span class="eras"><b><span class="s1"><?=$row3["sp_shopname"]?></span></b><br>
 			<?=$row3["sp_shopaddress"]?><br>
           
            <?=$row3["sp_phone"]?>&nbsp;<?=$row3["sp_mobile"]?><br>GSTIN : <b><?=$row3["sp_tin"]?></b></span>
            <?php $stcode_s=$row3["sp_stcode"];?>
    </th><th style="width:150px; text-align:right; padding-right:10px;"></th>
  </tr>
  <tr>
  <th align="left"><b>Invoice No.<?=$row4["be_billnumber"]?> </b></th><th></th><th align="left"></th>
  </tr>
</table> 
<!--<table style="text-align: left; border-color:#000;" width="100%" border="1">
   <tr border="1" >
    <td  style="width:40%;">GST NO : <b><?=$row3["sp_tin"]?></b><br>DOOR NO : <b><?=$row3["sp_door"]?></b>
    </td>
    <td  style="width:100%; border-left:1px solid #FFF; text-align:left">
    <span class="eras"><img src="../assets/hanger.png" style="width:30%;" align="left"></span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td  style="padding:5px;width:40%; border-left:1px solid #FFF">
                    
                    </td>
                    <td  style="padding:5px;width:40%; border-left:1px solid #FFF">
                                        </td>
                    <td  style="padding:5px;width:40%; border-left:1px solid #FFF">
                    <b>Ph:<?=$row3["sp_mobile"]?></b>
                    </td>
                    <td  style="padding:5px;width:40%; border-left:1px solid #FFF">
                    
                    </td>
                    
  </tr>
  <tr style="border-top:1px solid #fff">
    <td  style="width:40%;" colspan="6" align="center"><b><?=$row3["sp_shopaddress"]?></b> 
    </td>
     </tr>
  <tr style="border-top:1px solid #fff">
    <td  style="width:40%; border-right:1px solid #FFF" ><b>Invoice No.<?=$row4["be_billnumber"]?> </b></td>
    <td style="width:40%; border-right:1px solid #FFF"></td><td style="width:40%; border-right:1px solid #FFF"></td><td style="width:40%; border-right:1px solid #FFF"></td>
    <td style="width:40%;" colspan="2"> Date:&nbsp;<?=date('d-m-Y', strtotime($row4["be_billdate"]))?></b>
    </td>
    </tr>
  
  <tr style="border-top:1px solid #FFF; text-align:left;">
  <td  style="padding:5px;width:40%;">
   <?php if ($row4["be_customerid"] == 0) {
    	?>
  Bill To. &nbsp;<?=$row4["be_customername"]?><br>GSTIN: <?=$row4["be_customer_tin_num"]?>
  <?php } 
		else {?>
        Bill To. &nbsp;<?=$row5["cs_customername"]?><br>GSTIN: <?=$row5["cs_tin_number"]?>
        <?php }?>
    </td>
    <td  style="padding:5px;width:40%; border-left:1px solid #FFF">
    State: <b><?php if ($row4["be_customerid"] == 0) { 
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
						$stcode_c=$row5["cs_statecode"];
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
						}	 ?>
                    </td>
                    <td  style="padding:5px;width:40%; border-left:1px solid #FFF">
                    
                    </td>
                    <td  style="padding:5px;width:40%; border-left:1px solid #FFF">
                    
                    </td>
                    <td  style="padding:5px;width:40%; border-left:1px solid #FFF" colspan="2">
                    Code: <?php echo $row3["sp_stcode"]?>
                    </td>
                    
    </tr>
    
  <tr style="display:none;">
  <td style="padding:5px;width:40%;">
  
  Serial Number : <b><?=$row4["be_billnumber"]?></b><br>
  Date of Issue : <b><?=date('d-m-Y', strtotime($row4["be_billdate"]))?></b>
  </td>
  
            <td  style="padding:5px;width:40%; border-left:1px solid #FFF">
                    </td>       
  
  <td style="padding:5px;width:40%; border-left:1px solid #FFF">
  State: <b><?php if ($row4["be_customerid"] == 0) { 
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
					
					
					
					
					
					?></b><br>
                     State Code : <?php echo $row3["sp_stcode"]?>
  </td>
   
                    <td  style="padding:5px;width:40%; border-left:1px solid #FFF">
                    </td>
                    <td  style="padding:5px;width:40%; border-left:1px solid #FFF">
                    </td>
                    
  </tr>
</table>-->
<table border="1" width="100%" class="table" >
	<tr>
    	<td style="text-align:left;width: 50%;">Reverse charge:<br>Invoice Date: <b><?=date('d-m-Y', strtotime($row4["be_billdate"]))?></b><br>State:<b><?php if($row4["be_statecode"]=="AN"){echo "Andaman and Nicobar Islands ";}
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
                         else {echo "Kerala";}?></b></td>
        <td style="text-align:left;width: 50%;">Transportation Mode: <br>Vehicle No:<?=$row4["be_vehicle_number"]?><br>Date of Supply:<?=date('d-m-Y', strtotime($row4["be_billdate"]))?><br>Place of Supply:<b><?php if($row4["be_statecode"]=="AN"){echo "Andaman and Nicobar Islands ";}
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
                         else {echo "Kerala";}?></b></td>
	</tr>
    <tr>
   
    	<td style="padding:5px;" colspan="2"> <?php if ($row4["be_customerid"] == "0") {
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
                         
        
       <br> GSTIN/UIN :  <b><?php echo $row4["be_customer_tin_num"];
        } 
		else {?></b>
        Name:
        <b><?php
		echo $row5["cs_customername"];?></b>
		<br>Address:
		<b> <span style="font-size:10px;"><?php
		echo $row5["cs_address"]; 
		?></span></b>
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
        
        
        <br>GSTIN/UIN:  <b><?php echo $row5["cs_tin_number"];}?></b></td>
        
       <!-- <td style="padding:5px;"> <?php if ($row4["be_customerid"] == "0") {
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
        &nbsp;&nbsp;&nbsp;&nbsp; State Code:<b><?php if($row4["be_statecode"]==''){$stcode_c='KL';echo"32";}else{$stcode_c=$row4["be_statecode"];switch($row4["be_statecode"])
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
        GSTIN/UIN:  <b><?php echo $row4["be_customer_tin_num"];
        } 
		else {$cust= $conn->query("SELECT * FROM vm_customer WHERE cs_customerid='".$row4["be_customerid"]."'");
		$row5=$cust->fetch_assoc();?></b>
        Name:
        <b><?php
		echo $row5["cs_customername"];?></b>
		<br>Address:
		<b><span style="font-size:10px;"><?php
		echo $row5["cs_address"]; 
		?></span></b>
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
        
        
         
        &nbsp;&nbsp;&nbsp;&nbsp; State Code: <b><?php //echo $row5["cs_statecode"];
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
        <br>GSTIN/UIN:  <b><?php echo $row5["cs_tin_number"];}?></b></td>-->
        
     
        
    </tr>
</table>
<?php 
if($stcode_c==$stcode_s)
{
	$clmspan='7';
}else{$clmspan='5';}
?>
<div style="border: 1px #808080 solid;margin-bottom:30px;" class="nonborder">
<table width="100%" class="fnt" style="border:2px solid #808080;">
<tr>
<th  width="5%" bgcolor="#999999"> Sl.No</th>
<th  bgcolor="#999999" align="left" width="30%">Description of Goods</th>
<th  width="10%" bgcolor="#999999">HSN CODE</th>
<th  width="9%" bgcolor="#999999">Qty</th>
<th  width="10%" bgcolor="#999999">UOM</th>
<th  width="10%" bgcolor="#999999">Rate</th>
<!--<th  style="width:50px;" bgcolor="#999999">Amount</th>
<th  style="width:50px;" bgcolor="#999999">Taxable Value</th>
<th  style="width:30px;" bgcolor="#999999">&nbsp;&nbsp;Less Dis.&nbsp;&nbsp;</th>-->
<th  width="20%" bgcolor="#999999">Total</th>
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

$bill2=$conn->query("SELECT * FROM vm_billitems a LEFT JOIN vm_products b ON b.pr_productid=a.bi_productid WHERE a.bi_billid='$billid' LIMIT ".$j.",28");

while($row6=$bill2->fetch_assoc()){?>
<tr style="text-align:center;">
	<td><?php echo $k;?></td>
    
     <td align="left"><?php echo $row6['pr_productname'];?></td>
    <td border-bottom="0"><?php echo $row6['pr_hsn'];?></td>
    <td><?php echo $row6['bi_quantity'];?></td>
    <td><?php echo $row6['pr_unit'];?></td>
    <td><?php echo $row6['bi_price'];?></td>
    <td><?php echo $row6['bi_total']?></td>
    <!--<?php if($stcode_c==$stcode_s)
	{?>
    <td><?php echo $row6['bi_cgst_amt'] + $row6['bi_sgst_amt']; ?></td>
    <?php }else{?>
    <td><?php echo $row6['bi_igst'];?>%</td>
    <?php }?>
    <?php if($stcode_c==$stcode_s)
	{?>
    <td><?php echo $row6['bi_cgst'];?>%</td>
    <td><?php $tcgst=$tcgst+round($row6['bi_cgst_amt']);echo ($row6['bi_cgst_amt']);?></td>
    <td><?php echo $row6['bi_sgst'];?>%</td>
    <td><?php $tsgst=$tsgst+round($row6['bi_sgst_amt']);echo ($row6['bi_sgst_amt']);?></td>
    <?php }else{?>
    <td><?php echo $row6['bi_igst'];?>%</td>
    <td><?php $tigst=$tigst+round($row6['bi_igst_amt']);echo ($row6['bi_igst_amt']);?></td>
    <?php }?>-->
    
</tr>
<?php
	$qt=$qt+$row6['bi_quantity'];
	$su=$su+$row6['bi_price'];
	$p= $row6['bi_taxamount']; 
	$tt=$tt+$row6['bi_total'];
	$cg=$cg+$row6['bi_cgst_amt'];
	$sg=$sg+$row6['bi_sgst_amt'];
	$ig=$ig+$row6['bi_igst_amt'];
?>
<?php $k++; }
while($k<=28)
{?>
<tr style="border-bottom:0px solid white;"><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>


<?php $k++;}?>
<tr style="border: 2px #000 solid">

<td style="border-top: 2px #000 solid;border-bottom: 2px #000 solid; text-align:right;" colspan="2" align="right"><h3><b>Total: </b></h3></td>
 <td style="border-top: 2px #000 solid;border-bottom: 2px #000 solid;"></td>
 <td style="border-top: 2px #000 solid; text-align:center;"><?php echo $qt;?></td>
 <td style="border-top: 2px #000 solid; text-align:center;"></td>
  <td style="border-top: 2px #000 solid; text-align:center;"><?php echo $su;?></td> 
 <td style="border-top: 2px #000 solid; text-align:center;"><?php echo $tt;?></td>
 
 <?php if($r==$ttl){?>
 <tr style="border: 2px #808080 solid; text-align:left;" >
 
 <td width="100%" colspan="2" rowspan="4">
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
 <b>Total Amount After Tax</b>
 </td>
 <td align="center">
 <b><?php echo $tt; ?></b>
 </td>
 </tr>
 <tr style="border: 2px #808080 solid;">
 <td colspan="2" rowspan="3">
 <b>Bank Details<br>Bank Account Number: <?=$row3["sp_accno"]?></b><br><b>Bank Branch IFSC <?=$row3["sp_ifsc"]?></b>
 </td>
 <td rowspan="3" align="center">
 Seal
 </td>
 <td colspan="3">
<b>GST payable on Reverse Charge</b>
 </td>
 <td>
<b></b>
 </td>
 </tr>
 <tr style="border: 2px #808080 solid;">
 <td colspan="4">
 <b>Certified that the particulars given above are true and correct.</b><br>
 </td>
 </tr>
 <tr>
 <td colspan="4" align="right" style="border-top:2px solid #FFF;">
<br> <b>Authorized Signature</b>
 </td>
 </tr>
 
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
<?php }else{?>
<table width="100%" style="border-top:1px solid #fff; border-bottom:1px solid #fff; border-left:1px solid #fff; border-right:1px solid #fff">
<tr >
    <td colspan="<?=$clmspan+7?>" style="text-align:right; border-bottom:1px solid #fff">&nbsp;</td>
</tr>
<tr>
    <td colspan="<?=$clmspan+7?>" style="text-align:right; border-bottom:1px solid #fff"">&nbsp;</td>
</tr>
<tr>
    <td colspan="<?=$clmspan+7?>" style="text-align:right; border-bottom:1px solid #fff"">&nbsp;</td>
</tr>
<tr>
    <td colspan="<?=$clmspan+7?>" style="text-align:right; border-bottom:1px solid #fff"">&nbsp;</td>
</tr>
<tr>
    <td colspan="<?=$clmspan+7?>" style="text-align:right; border-bottom:1px solid #fff"">&nbsp;</td>
</tr>
<tr>
    <td colspan="<?=$clmspan+7?>" style="text-align:right; border-bottom:1px solid #fff"">&nbsp;</td>
</tr>
<tr>
    <td colspan="<?=$clmspan+7?>" style="text-align:right; border-bottom:1px solid #fff"">&nbsp;</td>
</tr>
<tr>
    <td colspan="<?=$clmspan+7?>" style="text-align:right; border-bottom:1px solid #fff"">&nbsp;</td>
</tr>
<tr>
    <td colspan="<?=$clmspan+7?>" style="text-align:right; border-bottom:1px solid #fff"">&nbsp;</td>
</tr>
<tr>
    <td colspan="<?=$clmspan+7?>" style="text-align:right; border-bottom:1px solid #fff"">&nbsp;</td>
</tr>
<tr>
    <td colspan="<?=$clmspan+7?>" style="text-align:right; border-bottom:1px solid #fff"">&nbsp;</td>
</tr>

<tr>
    <td colspan="<?=$clmspan+7?>" style="text-align:right; border-bottom:1px solid #fff"">&nbsp;</td>
</tr>
<tr>
    <td colspan="<?=$clmspan+7?>" style="text-align:right; border-bottom:1px solid #fff"">&nbsp;</td>
</tr>
<tr>
    <td colspan="<?=$clmspan+7?>" style="text-align:right; border-bottom:1px solid #fff"">&nbsp;</td>
</tr>
</table>
<?php }?>  
</table>
</div>
<?php
}$j=$j+28;}
?>
</body>
</html>