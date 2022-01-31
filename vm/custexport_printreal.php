<?php
session_start();
include("includes/config.php");

$curdate = date('d/m/Y');
$customerid = $_GET['csid'];
$fil = $_GET['fil'];

?>


<html>
<meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta charset="UTF-8">
        <meta name="description" content="Utpara administrator" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Utpara Solutions" />

<title></title>
<head>
<link rel="stylesheet" type="text/css" media="print" href="custom/css/print.css" />
<style>
table {
    border-collapse: collapse;
}
table td
{	
	font-size:14px;
	height:15px;
}
@font-face {
   font-family: verdana;
   
}

.fnt td,.fnt th{border:1px solid black;}
.nonborder td{border:0px solid #808080 !important;}
@media print{
.printButtonClass{display:none;}
.table{width:100%;}
.table th{font-size:10px;}
.s1{font-size:28px;}
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
<?php if(isset($_GET["back"])){?><a href="<?= $_GET["back"]?>"><button style="float:left;" class="printButtonClass">back</button></a><?php }else{?><a href="view.php?csid=<?=$customerid?>"><button style="float:left;" class="printButtonClass">back</button></a><?php }?>
<?php
if($fil == 'all')
{
	$bil = $conn->query("SELECT * FROM us_billentry WHERE user_id='".$_SESSION["admin"]."' AND be_customerid='$customerid' AND be_isactive='0' ORDER BY be_billid DESC");
	
}
else{
	$filarr = explode('$', $fil);
	$fromdate = $filarr[0];
	$todate = $filarr[1];
	$bil = $conn->query("SELECT * FROM us_billentry WHERE DATE(be_billdate)>='$fromdate' AND DATE(be_billdate) <= '$todate' AND be_isactive='0' AND user_id='".$_SESSION["admin"]."' AND be_customerid='$customerid'  ORDER BY be_billid DESC");
	
}

$profl = $conn->query("SELECT * FROM us_shopprofile WHERE sp_shopid='".$_SESSION["admin"]."' ");
$row3 = $profl->fetch_assoc();
$slct=$conn->query("SELECT * FROM us_customer WHERE cs_customerid='$customerid'");
$rowcus=$slct->fetch_assoc();

$stno = $_GET['stno'];

$r=20;

?>

<table width="100%" border="0" >
	<tr>


    <td style="width: 50%"><b><span class="s1"><?=$row3["sp_shopname"]?></b><br>
 			<?=$row3["sp_shopaddress"]?><br>
   <?php $phone= $row3["sp_phone"]; echo $phone;?>,<?=$row3["sp_mobile"]?> ,<?=$row3["sp_email"]?></span>
</td>
<td style="width:25%"></td>
   
  </tr>
  <tr></tr><tr></tr>
  <tr>
    <td style=" text-align: left;font-size: 23px" rowspan="2">To.<br><?=$rowcus["cs_customername"]?><br><?=$rowcus["cs_address"]?> </i></td><td rowspan="2"></td><td rowspan="2"></td>
  	<td style="font-size: 23px">Date: <?=$curdate?></i></td></tr>
    <tr><td style="font-size: 23px">Statement No.<?=$stno?></i></td></tr>
  	<tr><td style="text-align: center;font-size: 23px;" colspan="4"><?php if($fil!='all'){ echo
  	                                   "Statement account of ".$rowcus["cs_customername"]."for the date from".date('d-M-Y', strtotime($fromdate))." to ".date('d-M-Y', strtotime($todate))."";}else{ echo "All statement account of ".$rowcus["cs_customername"]." till date";}

  	                                   ?></td></tr>
</table>
<div style="border: 1px #808080 solid;margin-bottom:5px;">
<table width="100%" class="s4" border="1">
<tr>

<th >Sl No.</th>
<th >Invoice No.</th>
<th >Date</th>
<th >Item</th>
<th >Total</th>

</tr>
<?php
$k=1;
$total = 0;
if($bil->num_rows>0)
{
	
while($row = $bil->fetch_assoc())
{?>

<tr style="text-align:center;" >
	<td style="width: 10%" ><?php echo $k ?></td>
    <td style="width: 10%"><?php echo $row['be_billnumber'];?></td>
    <td style="width: 15%"><?php echo date('d/m/Y', strtotime($row['be_billdate']));?></td>
    <?php $billid = $row['be_billid'];


 $itmss = $conn->query("SELECT * FROM us_billitems LEFT JOIN  us_products  ON bi_productid= pr_productid WHERE bi_isactive=0 AND bi_billid='$billid' LIMIT 1"); 
 $row3 = $itmss->fetch_assoc(); ?>
    <td style="width: 50%"><?php echo $row3['pr_productname'];?><?php $itmss = $conn->query("SELECT * FROM us_billitems LEFT JOIN  us_products  ON bi_productid= pr_productid WHERE bi_isactive=0 AND bi_billid='$billid' LIMIT 1000 OFFSET 1");
   while($row3 = $itmss->fetch_assoc())
   { echo ','.$row3['pr_productname']; } ?></td>
    <td style="width: 15%"><?php $total = $row['be_gtotal']+$total; echo $row['be_gtotal'];?></td>
   


    </tr>
    <?php $k++;}}
    while($k<=20)
{?>
<tr style="border-bottom:0px solid white;"><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
<?php $k++;}?>

<?php ?>
<tr style="border-bottom:0px solid white;"><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>Total</td><td><?=$total?></td></tr>


</table>
</div>
<table border="0" width="100%"><tr><td style="text-align: left; font-size:12px;">IN WORDS,&nbsp;&nbsp; <?php $amd=convert_number_to_words($total);echo $amd.'&nbsp;QR ONLY';?></i>
 </td></tr><tr><td></td></tr></table>
<footer></footer>

</body>
</html>
