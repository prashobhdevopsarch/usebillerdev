<?php
session_start();
if(isset($_SESSION['admin']))
{
	include("includes/config.php");
	if(isset($_POST['submit']))
	{
		$insrtitms=true;
		$billno = $_POST['billno'];
		$customername = $_POST['customername'];
		$phone = $_POST['phone'];
		$date = date('Y-m-d', strtotime($_POST['date']));
		$time = date('H:i:s', strtotime($_POST['time']));
		$billdate = $date . " " . $time;
		$totalprice = $_POST['totalprice'];
		$discount = $_POST['discount'];
		$discount_amt=$_POST['discount_amt'];
		$paidamount = $_POST['paidamount'];
		$curdate = date('Y-m-d H:i:s');
		
		$vehicle_number=$_POST["vehicle_number"];
		$tin_number=$_POST["tin_number"];
		$purp=$_POST["purchaseprice"];
		$prodid= $_POST['prodid'];
		$saleprice= $_POST['saleprice'];
		$qty= $_POST['qty'];
		$discounti=$_POST["discounti"];
		$vatamnt = $_POST['vatamnt'];
		$vatper = $_POST['vatper'];
		$total= $_POST['total'];
		$balance=$_POST['balance'];
		$customer1=$_POST['customername1'];
		$customercheck=$_POST['customercheck'];
		$customer=$_POST['customerid'];
		$billtype=$_POST["billtype"];
		$netamnt=$_POST["netamnt"];
		$purp=$_POST["purchaseprice"];
		$paytype=$_POST["paytype"];
		
		$coolie=$_POST["coolie"];
		$oldbalance=$_POST["oldbalance"];
		$gtotalprice=$_POST["gtotalprice"];
		
		$particulars="Sales";
		$transactiontype="income";
		$date=$_POST['date'];
		$time=$_POST['time'];
		$datetime=date("Y-m-d", strtotime($_POST["date"]))." ".date("H:i", strtotime($_POST["time"]));
		$amount=$_POST['paidamount'];
		$billid=$_POST['billno'];
		
		$supplyplace=$_POST["supplyplace"];
		
		$slct_empnum=$conn->query("SELECT tr_closingbalance FROM us_transaction ORDER BY tr_id DESC LIMIT 1");
if(mysqli_num_rows($slct_empnum)>0)
 {
$last=$slct_empnum->fetch_assoc();
$openingbalence = $last['tr_closingbalance'] ;
 }
 else{
 $openingbalence =0;
 }
 $closingbalance=$openingbalence+$amount;
// echo $openingbalence."<br>1".$closingbalance."<br>2".$amount;
		
		if($customer!='0')
{
$queryb=$conn->query("SELECT be_balance FROM us_billentry WHERE be_billid='".$_GET["billid"]."'");
    $rowbalz=$queryb->fetch_assoc();
$balz=$rowbalz["be_balance"];

$slct_cusbal=$conn->query("SELECT cs_balance FROM us_customer WHERE cs_customerid= '$customer'");
$row_cusbal=$slct_cusbal->fetch_assoc();
$prebalz=$row_cusbal["cs_balance"];
$balancenewz=$prebalz-$balz;
$balancenew=$balancenewz+$balance;
$update1 = $conn->query("UPDATE us_customer SET  cs_balance='$balancenew'  WHERE cs_customerid= '$customer'");

}
		
		$sql="UPDATE us_billentry SET be_billnumber='$billno',be_customerid='$customer', be_customername='$customername', be_customermobile='$phone', be_customer_tin_num='$tin_number', be_billdate='$billdate', be_total='$totalprice', be_paidamount='$paidamount', be_updateddate='$curdate', be_discount='$discount', be_mode='sales', user_id='".$_SESSION["admin"]."', be_vehicle_number='$vehicle_number', be_coolie='$coolie', be_gtotal='$gtotalprice', be_oldbal='$oldbalance', be_balance='$balance', be_statecode='$supplyplace', be_paymethod ='$paytype',finyear = '".$_SESSION["finyearid"]."' WHERE be_billid='".$_GET["billid"]."'";
		//$sql1="INSERT INTO us_customer (cs_customerid ,user_id) VALUES ('$customer','".$_SESSION["admin"]."') WHERE $be_billid=$customer";  
		//echo $sql;
		$insrtbill=$conn->query("$sql");
		//$insert=$conn->query("$sql1");
		//$cutomer_id=$conn->insert_id;
		if($insrtbill)
		{
			$bill_id = $_GET["billid"];
			$query=$conn->query("SELECT bi_productid,bi_quantity FROM us_billitems WHERE bi_billid='$bill_id'");
			while($rowupdat=$query->fetch_assoc())
			{
				$query1=$conn->query("SELECT pr_stock FROM us_products WHERE pr_productid='".$rowupdat["bi_productid"]."'");
				$rowupdate1=$query1->fetch_assoc();
				$sum=$rowupdate1["pr_stock"]+$rowupdat["bi_quantity"];
				$query2=$conn->query("UPDATE us_products SET pr_stock='$sum' WHERE pr_productid='".$rowupdat["bi_productid"]."'");
			}
			$delet=$conn->query("DELETE FROM us_billitems WHERE bi_billid='".$bill_id."'");
			if($delet){
			$n=0;
			foreach($prodid as $prdval)
			{
				if($prdval != "")
				{
					if($supplyplace==$_SESSION["stcode"])
					{
						$cgst_p=$vatper[$n]/2;
						$cgst_a=$vatamnt[$n]/2;
						
						$sgst_p=$vatper[$n]/2;
						$sgst_a=$vatamnt[$n]/2;
						
						$igst_p='';
						$igst_a='';
					}elseif($supplyplace=='')
					{
						$cgst_p=$vatper[$n]/2;
						$cgst_a=$vatamnt[$n]/2;
						
						$sgst_p=$vatper[$n]/2;
						$sgst_a=$vatamnt[$n]/2;
						
						$igst_p='';
						$igst_a='';
					}else
					{
						$cgst_p='';
						$cgst_a='';
						
						$sgst_p='';
						$sgst_a='';
						
						$igst_p=$vatper[$n];
						$igst_a=$vatamnt[$n];
					}
					if($customer!='0')
					{
						$slct_price=$conn->query("SELECT * FROM us_customeritemprice WHERE cp_customer_id='$customer' AND cp_itemid='$prdval'");
						if($slct_price->num_rows>0)
						{
							$rowitmprice=$slct_price->fetch_assoc();
							$update=$conn->query("UPDATE us_customeritemprice SET  WHERE cp_itemid='$prdval'");
						}
					}
					$insrtitms = $conn->query("INSERT INTO us_billitems(bi_discount_amount,bi_billid, bi_productid, bi_price, bi_cess, bi_mrp1, bi_quantity, bi_discount,bi_vatamount,bi_vatper, bi_total, bi_updatedon, bi_sgst, bi_sgst_amt, bi_cgst, bi_cgst_amt, bi_igst, bi_igst_amt, user_id, bi_taxamount,bi_billdate,bi_purprice,bi_disc,bi_prenet,finyear) VALUES('$discount_amt[$n]','$bill_id', '$prdval', '$saleprice[$n]', '$cess[$n]', '$mrp1[$n]','$qty[$n]', '$discounti[$n]', '$vatamnt[$n]','$vatper[$n]','$total[$n]', '$curdate', '$sgst_p', '$sgst_a','$cgst_p','$cgst_a','$igst_p','$igst_a','".$_SESSION["admin"]."','$netamnt[$n]','$billdate','$purp[$n]','$prediscount[$n]','$prenetamnt[$n]','".$_SESSION["finyearid"]."')");
					$stcs = $conn->query("SELECT pr_stock FROM us_products WHERE pr_productid='$prdval'");
					$row = $stcs->fetch_assoc();
					$nwstock = $row['pr_stock'] - $qty[$n];
					$update = $conn->query("UPDATE us_products SET pr_stock='$nwstock' WHERE pr_productid='$prdval'");

					$deletst=$conn->query("DELETE FROM us_stockreport WHERE billid='".$bill_id."' and sr_mode='Sales'");

					$closingstockamount=$nwstock*$purp[$n];

					$stockrepo="INSERT INTO us_stockreport(sr_itemid,sr_date,sr_qty,sr_amount,sr_closingstock,sr_mode,finyear,billid) VALUES( '$prdval','$billdate','$qty[$n]','$closingstockamount','$nwstock','Sales','".$_SESSION["finyearid"]."','$bill_id')";

					$insrtbill1=$conn->query("$stockrepo");
				}
				$n++;
			}
			
			if($insrtitms)
{
	

	$delet=$conn->query("DELETE FROM us_transaction WHERE tr_billid='".$bill_id."' and tr_particulars='Sales'");

         $delet=$conn->query("DELETE FROM administrator_daybook WHERE bill_id='".$bill_id."' and credit='5'");



				$insert=$conn->query("insert into us_transaction(tr_particulars,tr_openingbalance,tr_transactionamount,tr_closingbalance,tr_date,tr_transactiontype,tr_billid,user_id,finyear)
                   values('$particulars',' $openingbalence','$amount','$closingbalance','$datetime','$transactiontype','$bill_id','".$_SESSION["admin"]."','".$_SESSION["finyearid"]."')");

				$slct_cuss=$conn->query("SELECT sum(bi_vatamount) as vatamnt,sum(bi_taxamount) as taxamnt FROM us_billitems WHERE bi_billid= '$bill_id'");
					$rowday=$slct_cuss->fetch_assoc();
				   $vat=$rowday['vatamnt'];
				    $taxs=$rowday['taxamnt'];
				if($insert)
				{
					
				
					if($customer!='' && $balance >'0')
				{
					//echo print_r($_POST);

					if($paytype=='CASH' )
                   {
					$slct_cus=$conn->query("SELECT cs_balance FROM us_customer WHERE cs_customerid= '$customer'");
					$row_cus=$slct_cus->fetch_assoc();
					$prebal=$row_cus["cs_balance"];
					$bill_ball=$balance;
					$balance1=$prebal+$balance;
					
					$update1 = $conn->query("UPDATE us_customer SET  cs_balance='$balance1'  WHERE cs_customerid= '$customer'");
					$slct=$conn->query("SELECT * FROM us_customer LEFT JOIN administrator_account_name ON refid=cs_acntid WHERE cs_customerid = '$customer'");
					$rowacnt=$slct->fetch_assoc();
					$acntname=$rowacnt["acc_name"];
					$acntid=$rowacnt["refid"];
					
					$insert_acnt=$conn->query("INSERT INTO administrator_daybook(ad_branchid, dayBookDate, debit, credit, dayBookContra, dayBookAmount, description, backup,finyear,bill_id,mode,dr_cr,bill_amnt,user_id) VALUE('".$_SESSION["admin"]."','$date','1','5','Y','$paidamount','CASH SALE','','".$_SESSION["finyearid"]."','$bill_id','1','C','$gtotalprice','".$_SESSION["admin"]."')");
					$acntid1=$conn->insert_id;
					//$update1=$conn->query("UPDATE vm_billentry SET be_debitid='$acntid1' WHERE be_billid ='$bill_id'");
					
					$insert_acnt1=$conn->query("INSERT INTO administrator_daybook(ad_branchid, dayBookDate, debit, credit, dayBookContra, dayBookAmount, description, backup,finyear,bill_id,mode,dr_cr,user_id) VALUE('".$_SESSION["admin"]."','$date','$acntid','5','Y','$balance','CREDIT SALE','','".$_SESSION["finyearid"]."','$bill_id','1','D','".$_SESSION["admin"]."')");
					$acntid2=$conn->insert_id;

					$day_tax=$conn->query("INSERT INTO administrator_daybook(ad_branchid, dayBookDate, debit,credit, dayBookContra, dayBookAmount, description, backup,finyear,bill_id,user_id) VALUE('".$_SESSION["admin"]."','$date','34','5','Y','$vat','GST','','".$_SESSION["finyearid"]."','$bill_id','".$_SESSION["admin"]."')");

					$day_taxable=$conn->query("INSERT INTO administrator_daybook(ad_branchid, dayBookDate, debit,credit, dayBookContra, dayBookAmount, description, backup,finyear,bill_id,user_id) VALUE('".$_SESSION["admin"]."','$date','41','5','Y','$taxs','TAXABLE VALUE','','".$_SESSION["finyearid"]."','$bill_id','".$_SESSION["admin"]."')");
						if($coolie > 0){
				$day_disc=$conn->query("INSERT INTO administrator_daybook(ad_branchid, dayBookDate, debit,credit, dayBookContra, dayBookAmount, description, backup,finyear,bill_id,user_id) VALUE('".$_SESSION["admin"]."','$date','36','5','Y','$coolie','COOLIE','','".$_SESSION["finyearid"]."','$bill_id','".$_SESSION["admin"]."')");
			}
			if($discount >0){
				$day_coolie=$conn->query("INSERT INTO administrator_daybook(ad_branchid, dayBookDate, debit,credit, dayBookContra, dayBookAmount, description, backup,finyear,bill_id,user_id) VALUE('".$_SESSION["admin"]."','$date','37','5','Y','$discount','DISCOUNT','','".$_SESSION["finyearid"]."','$bill_id','".$_SESSION["admin"]."')");
			}

					$update1=$conn->query("UPDATE us_billentry SET be_debitid='$acntid' WHERE be_billid ='$bill_id'");
					
					
					$update2=$conn->query("UPDATE us_billentry SET be_creditid='$acntid2' WHERE be_billid ='$bill_id'");
				}
				else{
					$slct_cus=$conn->query("SELECT cs_balance FROM us_customer WHERE cs_customerid= '$customer'");
					$row_cus=$slct_cus->fetch_assoc();
					$prebal=$row_cus["cs_balance"];
					$bill_ball=$balance;
					$balance1=$prebal+$balance;
					
					$update1 = $conn->query("UPDATE us_customer SET  cs_balance='$balance1'  WHERE cs_customerid= '$customer'");
					$slct=$conn->query("SELECT * FROM us_customer LEFT JOIN administrator_account_name ON refid=cs_acntid WHERE cs_customerid = '$customer'");
					$rowacnt=$slct->fetch_assoc();
					$acntname=$rowacnt["acc_name"];
					$acntname=$rowacnt["refid"];
					//$insert_acnt=$conn->query("INSERT INTO administrator_daybook(ad_branchid, dayBookDate, debit, credit, dayBookContra, dayBookAmount, description, backup,finyear,bill_id) VALUE('".$_SESSION["admin"]."','$date','$acntname','SALES','Y','$gtotalprice','5','','".$_SESSION["finyearid"]."','$bill_id')");

					$insert_acnt=$conn->query("INSERT INTO administrator_daybook(ad_branchid, dayBookDate, debit, credit, dayBookContra, dayBookAmount, description, backup,finyear,bill_id,mode,dr_cr,bill_amnt,user_id) VALUE('".$_SESSION["admin"]."','$date','13','5','Y','$paidamount','CASH SALE','','".$_SESSION["finyearid"]."','$bill_id','1','C','$gtotalprice','".$_SESSION["admin"]."')");
					


					$acntid1=$conn->insert_id;

					$insert_acnt1=$conn->query("INSERT INTO administrator_daybook(ad_branchid, dayBookDate, debit, credit, dayBookContra, dayBookAmount, description, backup,finyear,bill_id,mode,dr_cr,user_id) VALUE('".$_SESSION["admin"]."','$date','$acntid','5','Y','$balance','CREDIT SALE','','".$_SESSION["finyearid"]."','$bill_id','1','D','".$_SESSION["admin"]."')");

					$acntid2=$conn->insert_id;

					$day_tax=$conn->query("INSERT INTO administrator_daybook(ad_branchid, dayBookDate, debit,credit, dayBookContra, dayBookAmount, description, backup,finyear,bill_id,user_id) VALUE('".$_SESSION["admin"]."','$date','34','5','Y','$vat','GST','','".$_SESSION["finyearid"]."','$bill_id','".$_SESSION["admin"]."')");

					$day_taxable=$conn->query("INSERT INTO administrator_daybook(ad_branchid, dayBookDate, debit,credit, dayBookContra, dayBookAmount, description, backup,finyear,bill_id,user_id) VALUE('".$_SESSION["admin"]."','$date','41','5','Y','$taxs','TAXABLE VALUE','','".$_SESSION["finyearid"]."','$bill_id','".$_SESSION["admin"]."')");
				if($coolie > 0){
				   $day_coolie=$conn->query("INSERT INTO administrator_daybook(ad_branchid, dayBookDate, debit,credit, dayBookContra, dayBookAmount, description, backup,finyear,bill_id,user_id) VALUE('".$_SESSION["admin"]."','$date','36','5','Y','$coolie','COOLIE','','".$_SESSION["finyearid"]."','$bill_id','".$_SESSION["admin"]."')");
			      }
			     if($discount >0){
				$day_disc=$conn->query("INSERT INTO administrator_daybook(ad_branchid, dayBookDate, debit,credit, dayBookContra, dayBookAmount, description, backup,finyear,bill_id,user_id) VALUE('".$_SESSION["admin"]."','$date','37','5','Y','$discount','DISCOUNT','','".$_SESSION["finyearid"]."','$bill_id','".$_SESSION["admin"]."')");
			       }
					$update1=$conn->query("UPDATE us_billentry SET be_debitid='$acntid1' WHERE be_billid ='$bill_id'");
					
					
					$update2=$conn->query("UPDATE us_billentry SET be_creditid='$acntid2' WHERE be_billid ='$bill_id'");
				

				}
					
				}else{

                   if($paytype=='CASH')
                   {
			      	$insert_acnt=$conn->query("INSERT INTO administrator_daybook(ad_branchid, dayBookDate, debit, credit, dayBookContra, dayBookAmount, description, backup,finyear,bill_id,mode,dr_cr,bill_amnt,user_id) VALUE('".$_SESSION["admin"]."','$date','1','5','Y','$gtotalprice','CASH SALE','','".$_SESSION["finyearid"]."','$bill_id','1','C','$gtotalprice','".$_SESSION["admin"]."')");
				    $acntid2=$conn->insert_id;

				     $day_tax=$conn->query("INSERT INTO administrator_daybook(ad_branchid, dayBookDate, debit,credit, dayBookContra, dayBookAmount, description, backup,finyear,bill_id,user_id) VALUE('".$_SESSION["admin"]."','$date','34','5','Y','$vat','GST','','".$_SESSION["finyearid"]."','$bill_id','".$_SESSION["admin"]."')");
					if($coolie > 0){
				    $day_coolie=$conn->query("INSERT INTO administrator_daybook(ad_branchid, dayBookDate, debit,credit, dayBookContra, dayBookAmount, description, backup,finyear,bill_id,user_id) VALUE('".$_SESSION["admin"]."','$date','36','5','Y','$coolie','COOLIE','','".$_SESSION["finyearid"]."','$bill_id','".$_SESSION["admin"]."')");
			        }
			       if($discount >0){
				     $day_disc=$conn->query("INSERT INTO administrator_daybook(ad_branchid, dayBookDate, debit,credit, dayBookContra, dayBookAmount, description, backup,finyear,bill_id,user_id) VALUE('".$_SESSION["admin"]."','$date','37','5','Y','$discount','DISCOUNT','','".$_SESSION["finyearid"]."','$bill_id','".$_SESSION["admin"]."')");
			        }

					 $day_taxable=$conn->query("INSERT INTO administrator_daybook(ad_branchid, dayBookDate, debit,credit, dayBookContra, dayBookAmount, description, backup,finyear,bill_id,user_id) VALUE('".$_SESSION["admin"]."','$date','41','5','Y','$taxs','TAXABLE VALUE','','".$_SESSION["finyearid"]."','$bill_id','".$_SESSION["admin"]."')");
				$update2=$conn->query("UPDATE us_billentry SET be_debitid='$acntid2' WHERE be_billid ='$bill_id'");
			       }
			else{
					$insert_acnt=$conn->query("INSERT INTO administrator_daybook(ad_branchid, dayBookDate, debit, credit, dayBookContra, dayBookAmount, description, backup,finyear,bill_id,mode,dr_cr,bill_amnt,user_id) VALUE('".$_SESSION["admin"]."','$date','13','5','Y','$gtotalprice','CASH SALE','','".$_SESSION["finyearid"]."','$bill_id','1','C','$gtotalprice','".$_SESSION["admin"]."')");
				$acntid2=$conn->insert_id;

				   $day_tax=$conn->query("INSERT INTO administrator_daybook(ad_branchid, dayBookDate, debit,credit, dayBookContra, dayBookAmount, description, backup,finyear,bill_id,user_id) VALUE('".$_SESSION["admin"]."','$date','34','5','Y','$vat','GST','','".$_SESSION["finyearid"]."','$bill_id','".$_SESSION["admin"]."')");
				    if($coolie > 0){
				    $day_coolie=$conn->query("INSERT INTO administrator_daybook(ad_branchid, dayBookDate, debit,credit, dayBookContra, dayBookAmount, description, backup,finyear,bill_id,user_id) VALUE('".$_SESSION["admin"]."','$date','36','5','Y','$coolie','COOLIE','','".$_SESSION["finyearid"]."','$bill_id','".$_SESSION["admin"]."')");
			        }
			        if($discount >0){
				     $day_disc=$conn->query("INSERT INTO administrator_daybook(ad_branchid, dayBookDate, debit,credit, dayBookContra, dayBookAmount, description, backup,finyear,bill_id,user_id) VALUE('".$_SESSION["admin"]."','$date','37','5','Y','$discount','DISCOUNT','','".$_SESSION["finyearid"]."','$bill_id','".$_SESSION["admin"]."')");
			         }

					$day_taxable=$conn->query("INSERT INTO administrator_daybook(ad_branchid, dayBookDate, debit,credit, dayBookContra, dayBookAmount, description, backup,finyear,bill_id,user_id) VALUE('".$_SESSION["admin"]."','$date','41','5','Y','$taxs','TAXABLE VALUE','','".$_SESSION["finyearid"]."','$bill_id','".$_SESSION["admin"]."')");
				$update2=$conn->query("UPDATE us_billentry SET be_debitid='$acntid2' WHERE be_billid ='$bill_id'");
			

			}
				}
				switch($billtype)
				{
					//case 1: header("location:bill_print.php?billid=$bill_id&csid=".$customer);break;
                    case 1: header("location:bill_print_A4.php?billid=$bill_id&csid=".$customer);break;
					case 2: header("location:bill_print_cus.php?billid=$bill_id&csid=".$customer);break;
					case 3: header("location:bill_print_cus1.php?billid=$bill_id&csid=".$customer);break;
				}
				}else{
					header('Location: dashboard.php?er=error1');
			}
			

			}



		}
			else{
				//echo $sql1;
				header('Location: dashboard.php?er=error1');
			}
		}
		
		else{
			//echo $sql;
			
			header('Location: dashboard.php?er=error');
			//echo print_r($_POST);
			
			
		}
	}
	
?>
<!DOCTYPE html>
<html>  
<head>  
        <!-- Title -->
        <title>US e-Biller</title>
        
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta charset="UTF-8">
        <meta name="description" content="Utpara administrator" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Utpara Solutions" />
        
        <?php
		include("includes/files.php");
		?>
        <style>
	#results td:hover{
		background-color:rgba(58, 87, 149, 0.28);
		
	}
	.secol table td{
cursor:pointer;
padding:3px;
}
.secol table td:hover{
background-color:rgba(58, 87, 149, 0.39);
}
#drgcartitms input
{
	padding:2px !important;
	height:25px;
	font-size:12px;
}
#drgcartitms th,#drgcartitms td
{
	font-size:12px;
}
	.table td, .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
padding: 5px!important;}

	</style>
    <!-- Styles -->
       
        
        <link href="assets/plugins/metrojs/MetroJs.min.css" rel="stylesheet" type="text/css"/>	
        <link href="assets/plugins/toastr/toastr.min.css" rel="stylesheet" type="text/css"/>	
	
        	<link rel="stylesheet" href="includes/auto/jquery-ui.css">
<script src="includes/auto/jquery-1.js"></script>
<script src="includes/auto/jquery-ui.js"></script>
        <!-- Theme Styles -->
        	
        <!-- Theme Styles -->
        
    </head>
    <body class="page-header-fixed" onLoad="deactivate()">
    
<div class="overlay"></div>   
        <main class="page-content content-wrap">
            <?php
			include("includes/topheader.php");
			?>
            <!-- Navbar -->
            <?php
			include("includes/adminsidebar.php");
			?>
            <!-- Page Sidebar -->
            <div class="page-inner">
                <div class="page-title">
                    <h3><strong>Retail  Billing (<?= date('d-M-Y') ?>)</strong></h3>
                    <div class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="active">Retail Billing</li>
                        </ol>
                    </div>
                </div>
                 <?php
				$today = date('Y-m-d');
				$today = date('Y-m-d');
				if(isset($_GET['billid']))
				{
					$billid = $_GET['billid'];
				}
					$stocks = $conn->query("SELECT * FROM us_billentry WHERE be_billid='$billid' AND user_id='".$_SESSION["admin"]."' and finyear = '".$_SESSION["finyearid"]."' AND be_mod='1'");
					if(mysqli_num_rows($stocks)>0)
					{
						$row = $stocks->fetch_assoc();
						
					}
				
				?>
				
			
                <div id="main-wrapper">
                    <!-- Row -->
                    <div class="row">
                        
                        
                        
                        
                        
                        <div class="col-lg-12 col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h4 class="panel-title">Billing</h4>
                                   <!-- <a href="dashboard.php?billno=<?= $billno+1 ?>" target="_blank"><button type="button" class="btn btn-primary btn-addon m-b-sm" style="float:right"><i class="fa fa-plus"></i> Another Bill</button></a>-->
                                    <a href="javascript:window.open('customer.php','mywindowtitle','width=500,height=800')" ><button type="button"  class="btn btn-primary btn-addon m-b-sm" style="float: right;margin-right:13px;"><i class="fa fa-plus"></i>New Customer</button></a>
                                </div>
                                <?php
								if(isset($_GET['id']))
								{
									?>
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        Bill saved successfully.
                                    </div>
                                    <?php
								}
								if(isset($_GET['er']))
								{
									
									?>
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
										
                                        Error occured, please try again.
                                    </div>
                                    <?php
								}
								?>
                                <div class="panel-body">
                                    <div class="project-stats">  
                                       <form class="form-horizontal" name="addbilldetails" method="post" action="<?= $_SERVER['PHP_SELF'] ?>?billid=<?=$billid?>" enctype="multipart/form-data">
                                       <div class="table-responsive">
                                       <input type="hidden" name="billno" id="billno" value="<?= $billno ?>">
                                       <table class="table">
                                       	<tr>
                                        	<td>
                                            Bill No: <input type="text" name="billno" id="billno" value="<?= $row["be_billnumber"] ?>" style="width:60px;" ><br><br>
											
                                            <label for="customercheck"> <b>Already existing customer?</b>
                                            <input type="checkbox" <?php if($row["be_customerid"]!=0){?> checked <?php } ?>class="form-control" name="customercheck" id="customercheck"  ></label>
                                            <div id="show" style="display: none;">
                                            <br>
											
											 <input type="hidden" id="customerid" name="customerid" value="<?=$row["be_customerid"]?>">
                                             <?php
												 $slctcust=$conn->query("SELECT * FROM us_customer WHERE cs_customerid='".$row['be_customerid']."'");
													$rowcus=$slctcust->fetch_assoc();
													// echo $rowcus["cs_customername"];
													  $csid=$rowcus["cs_customerid"];
											 ?>
                                             <input type="text" class="form-control"onKeyUp="customersearch(this.value)" id="customer1"  value="<?=$rowcus["cs_customername"]?>" autocomplete="off" name="customername1[]" style="width: 220px; display: inline;" placeholder="Customer Name"> <br> 
                                           
											<div id="result" class="secol" style="position: absolute; font-size: 12px; z-index: 999; width: 50%; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px; display: none;background-color: rgb(255, 255, 255);">
											<div class="secol" style="padding:5px;" id="searchresult">
                                            </div></div> 

											
                                            
                                            
											</div>
                                            <div id="normal">
											
                                           <br> <input type="text" class="form-control" name="customername"  value="<?php if($row['be_customerid']=='0'){ $csid=0; echo $row['be_customername'];}
												   else{											

													   $slctcust=$conn->query("SELECT * FROM us_customer WHERE cs_customerid='".$row['be_customerid']."'");
														$rowcus=$slctcust->fetch_assoc();
													   echo $rowcus["cs_customername"];
													   $csid=$rowcus["cs_customerid"];
													   }?>"style="width: 220px; display: inline;" id="customername" placeholder="Customer Name"> &nbsp; 
                                            <input type="text" class="form-control" name="phone" style="width: 220px; display: inline;" id="phone" placeholder="Phone Number" value="<?=$row["be_customermobile"]?>">
											</div>
                                            <input type="text" class="form-control"  value="<?=$row["be_vehicle_number"]?>" name="vehicle_number" style="width: 220px; display: inline;margin-top: 15px;" id="vehicle_number" placeholder="Vehicle Number">
											<input type="text" class="form-control" name="tin_number" style="width: 220px; display: inline;margin-top: 15px; margin-left:10px;" value="<?=$row["be_customer_tin_num"]?>" id="tin_number" placeholder="GSTIN">
                                             <select class="form-control" id="supplyplace" name="supplyplace" style="width: 220px; display: inline;" >
                                            		
                                                	
                                                   <option  <?php  if($row['be_statecode']=='AN'){ ?> selected  <?php } ?> value="AN">Andaman and Nicobar Islands </option>
                                                    
											<option <?php  if($row['be_statecode']=='AP'){ ?> selected  <?php } ?> value="AP">Andhra Pradesh</option>
											<option <?php  if($row['be_statecode']=='AD'){ ?> selected  <?php } ?> value="AD">Andhra Pradesh (New)</option>
											<option <?php  if($row['be_statecode']=='AR'){ ?> selected  <?php } ?> value="AR">Arunachal Pradesh</option>
											<option <?php  if($row['be_statecode']=='AS'){ ?> selected  <?php } ?> value="AS">Assam</option>
											<option <?php  if($row['be_statecode']=='BH'){ ?> selected  <?php } ?> value="BH">Bihar</option>
											<option <?php  if($row['be_statecode']=='CH'){ ?> selected  <?php } ?> value="CH">Chandigarh</option>
											<option <?php  if($row['be_statecode']=='CT'){ ?> selected  <?php } ?> value="CT">Chattisgarh</option>
											<option <?php  if($row['be_statecode']=='DN'){ ?> selected  <?php } ?> value="DN">Dadra and Nagar Haveli</option>
											<option <?php  if($row['be_statecode']=='DD'){ ?> selected  <?php } ?> value="DD">Daman and Diu</option>
										    <option <?php  if($row['be_statecode']=='DL'){ ?> selected  <?php } ?> value="DL">Delhi</option>
											<option <?php  if($row['be_statecode']=='GA'){ ?> selected  <?php } ?> value="GA">Goa</option>
											<option <?php  if($row['be_statecode']=='GJ'){ ?> selected  <?php } ?> value="GJ">Gujarat</option>
											<option <?php  if($row['be_statecode']=='HR'){ ?> selected  <?php } ?> value="HR">Haryana</option>
											<option <?php  if($row['be_statecode']=='HP'){ ?> selected  <?php } ?> value="HP">Himachal Pradesh</option>
											<option <?php  if($row['be_statecode']=='JK'){ ?> selected  <?php } ?> value="JK">Jammu and Kashmir</option>
											<option <?php  if($row['be_statecode']=='JH'){ ?> selected  <?php } ?> value="JH">Jharkhand</option>
											<option <?php  if($row['be_statecode']=='KA'){ ?> selected  <?php } ?> value="KA">Karnataka</option>
											<option <?php  if($row['be_statecode']=='KL'){ ?> selected  <?php } ?> value="KL">Kerala</option>
										    <option <?php  if($row['be_statecode']=='LD'){ ?> selected  <?php } ?> value="LD">Lakshadweep Islands</option>
											<option <?php  if($row['be_statecode']=='MP'){ ?> selected  <?php } ?> value="MP">Madhya Pradesh</option>
											<option <?php  if($row['be_statecode']=='MH'){ ?> selected  <?php } ?> value="MH">Maharashtra</option>
											<option <?php  if($row['be_statecode']=='MN'){ ?> selected  <?php } ?> value="MN">Manipur</option>
											<option <?php  if($row['be_statecode']=='ME'){ ?> selected  <?php } ?> value="ME">Meghalaya</option>
											<option <?php  if($row['be_statecode']=='MI'){ ?> selected  <?php } ?> value="MI">Mizoram</option>
											<option <?php  if($row['be_statecode']=='NL'){ ?> selected  <?php } ?> value="NL">Nagaland</option>
										    <option <?php  if($row['be_statecode']=='OR'){ ?> selected  <?php } ?> value="OR">Odisha</option>
											<option <?php  if($row['be_statecode']=='PY'){ ?> selected  <?php } ?> value="PY">Pondicherry</option>
											<option <?php  if($row['be_statecode']=='PB'){ ?> selected  <?php } ?> value="PB">Punjab</option>
											<option <?php  if($row['be_statecode']=='RJ'){ ?> selected  <?php } ?> value="RJ">Rajasthan</option>
											<option <?php  if($row['be_statecode']=='SK'){ ?> selected  <?php } ?> value="SK">Sikkim</option>
											<option <?php  if($row['be_statecode']=='TN'){ ?> selected  <?php } ?> value="TN">Tamil Nadu</option>
											<option <?php  if($row['be_statecode']=='TS'){ ?> selected  <?php } ?> value="TS">Telangana</option>
											<option <?php  if($row['be_statecode']=='TR'){ ?> selected  <?php } ?> value="TR">Tripura</option>
											<option <?php  if($row['be_statecode']=='UP'){ ?> selected  <?php } ?> value="UP">Uttar Pradesh</option>
										    <option <?php  if($row['be_statecode']=='UT'){ ?> selected  <?php } ?> value="UT">Uttarakhand</option>
											<option <?php  if($row['be_statecode']=='WB'){ ?> selected  <?php } ?> value="WB">West Bengal</option>
                                            </select>

											<td>
                                            <td align="right"><input type="date" class="form-control" style="width: 155px; display: inline;" name="date" id="date" value="<?= date('Y-m-d', strtotime($row["be_billdate"]))?>"> &nbsp; 
                                            <input type="time" class="form-control" style="width: 120px; display: inline;" name="time" id="time" value="<?= date('H:i:s', strtotime($row["be_billdate"])) ?>"></td>
                                        </tr>
                                       </table>
                                       
                                    <table class="table" id="drgcartitms">
                                    <thead>
                                    <tr>
                                    	<th>Sl No.</th>
                                         
                                        <th>Product id</th>
                                        <th>Product Name</th>
										<!--<th>Purchase Rate</th>-->
										
                                        <th>Unit Price</th>
                                         <th>MRP</th>
                                         <th>Rack NO:</th>
                                        <th>GST %</th>
                                        <th>CESS %</th>
                                        <th>Qty</th>
                                        <th>Discount %</th>
                                         <th>Discount amt</th>
										<!--<th>Unit</th>-->
                                        <th>Net Amount</th>
                                        <th>GST</th> 
                                        <th>cess</th>
                                        <th>Total</th>                
                                        <th></th>
                                    </tr>
                                    </thead>
                                    
                                    <tbody><?php
										$k=1;
										$m=1;
										$slctitm=$conn->query("SELECT * FROM us_billitems WHERE bi_billid='$billid'");
										while($rowitm=$slctitm->fetch_assoc())
										{
											$itm=$conn->query("SELECT * FROM us_products WHERE pr_productid='".$rowitm["bi_productid"]."'");
											$itmrow=$itm->fetch_assoc();
									
										?>
										<tr style="border-bottom:1px #EEE solid;" id="tr<?= $k ?>">
										<td><input type="text" class="form-control" placeholder="No." name="no[]" id="no<?= $m ?>" value="<?=$m?>" style="width:45px;"></td>
										<td>
                                        <input type="hidden" name="prodid[]" id="prodid<?= $k ?>" value="<?=$rowitm["bi_productid"]?>">
											
                                            <input type="text" autocomplete="off" class="form-control" onKeyPress="(<?= $k ?>)" name="productcode[]" id="productcode<?= $k ?>" style="width:70px;" placeholder="Code" onkeydown="if (event.keyCode === 13 || event.keyCode === 9){$('#vatper<?= $k ?>').focus();}" onBlur="addproductdetais(this.value, <?= $k ?>)" value="<?=$itmrow["pr_productcode"]?>">
										</td>
                                        <td>
                                        <input type="text" onKeyPress="(<?= $k ?>)" onkeydown="if (event.keyCode == 13 || event.keyCode == 9){$('#vatper<?= $k ?>').focus();}" onBlur="addproductdetais_name(this.value, <?= $k ?>)" autocomplete="off" class="form-control" name="productmlname[]" id="productmlname<?= $k ?>" style="width:275px;" placeholder="Product Name" value="<?=$itmrow["pr_productname"]?>" ></td>
										
                                        <td><input type="number" step="any" class="form-control" placeholder="Sale Price" name="saleprice[]" id="saleprice<?= $k ?>" onKeyUp="calculatetotal(<?= $k ?>)" style="width:100px;" value="<?=$rowitm["bi_price"]?>">
                                        <input type="hidden" class="form-control"  name="purchaseprice[]" id="purchaseprice<?= $k ?>" value="<?=$rowitm["bi_purprice"]?>" >
                                        </td>
                                             <td>
                                        <input type="number" step="any" placeholder="MRP" style="width:60px;" value="<?=$rowitm["bi_mrp1"]?>" class="form-control" name="mrp1[]" id="mrp1<?= $k ?>"></td>
                                        <td>
                                        <input type="number" step="any" placeholder="rackno" style="width:60px;" value="<?=$rowitm["bi_rack"]?>" class="form-control" name="rackno[]" id="mrp1<?= $k ?>"></td>
                                            <td>
                                        <input type="number" step="any" placeholder="rackno" style="width:60px;" value="<?=$rowitm["bi_vatper"]?>" class="form-control" name="rackno[]" id="mrp1<?= $k ?>"></td>
                                        <td>
                                        <!--<input type="number" step="any" placeholder="GST %" style="width:60px;" value="<?=$rowitm["bi_vatper"]?>" class="form-control" name="vatper[]" id="vatper<?= $k ?>">--></td>
										<td><input type="number" step="any" class="form-control" value="<?=$rowitm["bi_quantity"]?>" name="qty[]" onChange="calculatetotal(<?= $k ?>),sub_stock(this.value,<?=$k?>)" onKeyUp="calculatetotal(<?= $k ?>),sub_stock(this.value,<?=$k?>)" id="qty<?= $k ?>" placeholder="Qty" style="width:90px;">
                                       Avail Stock: <span id="availableqty<?= $k ?>"></span> Balance: <span id="bal<?=$k?>"></span>
                                        </td>
                                        <?php
										$disp=$rowitm["bi_discount"]/100;
										$disc=$disp*$rowitm["bi_taxamount"];
										
										?>
                                        <td><input type="number" step="any" style="width:60px;" onkeydown="if (event.keyCode === 9){$('#no<?= $k+1 ?>').focus();}" class="form-control" onChange="calcdisc(this.value,<?= $k ?>)" name="discounti[]"  value="<?=$rowitm["bi_discount"]?>" id="discount<?= $k ?>"><input type="hidden" name="prediscount[]" value="<?=$disc?>" id="prediscount<?= $k ?>"></td>
                                      <td>
                                          	<input type="number" style="width:60px;"   class="form-control discount_amt" onChange="calcdisc_amt(this.value,<?= $k ?>)"  name="discount_amt[]" id="discount_amt<?= $k ?>" value="<?=$rowitm['bi_discount_amount'];?>">
                                        </td>
										<td style="display:none;">
										<input type="number" step="any" class="form-control" readonly placeholder="Unit" name="unittype[]" id="unittype<?= $k ?>" style="width:70px;">
										</td>
                                        <td>
                                        <input type="hidden" name="prenetamnt[]" value="<?=$rowitm["bi_taxamount"]?>" id="prenetamnt<?= $k ?>">
                                        <input type="text" class="form-control" readonly placeholder="Net amount" value="<?=$rowitm["bi_taxamount"]?>" name="netamnt[]" id="netamnt<?= $k ?>" style="width:100px;"></td>
										
                                        <td>
                                        <input type="text" class="form-control" readonly placeholder="GST" value="<?=$rowitm["bi_vatamount"]?>" onKeyUp="calculatetotal(<?= $k ?>)" name="vatamnt[]" id="vatamnt<?= $k ?>" style="width:70px;"></td>
                                            <td>
                                        <input type="text" class="form-control" readonly placeholder="cessamount" onKeyUp="calculatetotal(<?= $k ?>)" value="<?=$rowitm["bi_cess"]?>" name="cess[]" id="cess<?= $k ?>" style="width:70px;"></td>
										
                                        <td>
                                        	<input readonly type="text" class="form-control" placeholder="Total" name="total[]" id="total<?= $k ?>" style="width:100px;" value="<?=$rowitm["bi_total"]?>">
                                            
                                            <input type="hidden" class="form-control" name="pretotal[]" id="pretotal<?= $k ?>" style="width:100px;" value="<?=$rowitm["bi_total"]?>">
                                            
                                            
                                        </td>
										<td>
										<a href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" title="" onclick="removeproduct(<?= $k ?>)" class="btn btn-default btn-sm m-user-delete" data-original-title="Remove Product"><div class="btn-group" role="group">
													<i class="fa fa-times" aria-hidden="true"></i>
										  </div></a>
                                          
										</td>
										</tr>
										<?php
										$k++;
										$m++;
										}
                                        ?>
                                        
									</tbody>
									<tbody id="cartitems">
									</tbody>
                                    </table>
                                    
                                    <table class="table">
                                    	<tr>
                                        <a style="float:right" href="javascript:void(0)" onClick="addproductfields()">add  <span class="glyphicon glyphicon-plus"></span></a>
                                        <td align="right">Total Amount:</td>
                                        <td width="150"><input type="text" readonly class="form-control" name="totalprice" id="totalprice"  value="<?=$row["be_total"]?>" placeholder="Total Amount" style="width:120px;">
                                        
                                        </td>
                                        </tr>
                                        <tr>
                                        <td align="right">Discount:</td>
                                        <td width="150"><input type="text" readonly class="form-control" name="discount" id="discount" placeholder="Discount"value="<?=$row["be_discount"]?>" onKeyUp="calculatedicounttotal(1)" style="width:120px;">
                                        
                                        </td>
                                        </tr>
										<tr>
                                        <td style=" font-stretch:expanded;" align="right">Freight:</td>
                                        <td width="150"><input type="text" value="<?=$row["be_coolie"]?>"  class="form-control" name="coolie" id="coolie" onKeyUp="calculatedicounttotal(3)"   placeholder="Coolie" style="width:120px;">
                                        
                                        </td>
                                        </tr>
										<tr id="show1" <?php if($row["be_oldbal"]==0){ ?> style="display:none;<?php } ?>">
										 
												<td   align="right">Old Balance</td>
												<td style="width:150px;"><input type="text" readonly class="form-control" value="<?=$row["be_oldbal"]?>"  name="oldbalance" id="oldbalance" placeholder="Old Balance" style="width:120px;">
                                        
											</td>
																					 
										</tr> 
										<tr>
											<td align="right">Grant Total:</td>
											<td width="150"><input type="text" readonly class="form-control" name="gtotalprice" id="gtotalprice"  value="<?=$row["be_gtotal"]?>" placeholder="Grant Total" style="width:120px;">
                                        
											</td>
										</tr>
										
                                        
                                        <td align="right">Paid Amount:</td>
                                        <td width="150"><input type="text" class="form-control" name="paidamount" id="paidamount" onKeyUp="calculatedicounttotal(2)" placeholder="Paid Amount" value="<?=$row["be_paidamount"]?>" required style="width:120px;">
                                        
                                        </td>
                                        </tr>
										
										<tr>
                                        <td align="right">Balance Amount:</td>
                                        <td width="150"><input type="text" readonly class="form-control" value="<?=$row["be_balance"]?>"name="balance" id="balance" placeholder="Balance" required style="width:120px;">
                                        
                                        </td>
                                        </tr>
                                        <tr>
                                        <td align="right">Payment Method</td>
                                        <td width="150"><select class="form-control" name="paytype" id="paytype" required style="width:120px;">
                                        <option <?php if($row['be_paymethod']=='CASH'){ ?> selected  <?php } ?> value="CASH">Cash</option>
										
                                        <option <?php if($row['be_paymethod']=='BANK'){ ?> selected  <?php } ?> value="BANK">Bank</option>
                                        </select>
                                        </td>
                                        
                                        <td align="right">Bill Type</td>
                                        <td width="150"><select class="form-control" name="billtype" id="billtype" required style="width:120px;">
                                        <option value="1">Tax Invoice</option>
										<!--<option value="2">Tax Invoice 8</option>-->
                                        <option value="3">Customer Invoice</option>
                                        </select>
                                        </td>
                                        </tr>
                                        
                                    </table>
                                       
                                        
                                        
                                        <div class="form-group" align="right" style="padding-right:30px;">
                                        <label for="input-help-block" class="col-sm-2 control-label"></label>
                                        <button type="submit" name="submit" onclick="return confirm('Do you want to Save & print the Bill?')" class="btn btn-primary">Save & Print</button>
                                        </div></div>
                                     </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- Main Wrapper -->
                <?php
				include("includes/footer.php");
			?>
            </div><!-- Page Inner -->
        </main><!-- Page Content -->
        <script src="assets/js/pages/dashboard.js"></script>
        <script src="assets/js/pages/form-elements.js"></script>
        <?php
		include("includes/footerfiles.php");
		?>
        
        
        
        <script>
function productcodesearch(num)
{
	$( document ).ready(function() {
    $( "#productcode"+num).autocomplete({
      source: "includes/autocomplete.php?htid=<?=$_SESSION['admin']?>"
    });
});
}
function productsearch(num)
{
	$( document ).ready(function() {
    $( "#productmlname"+num).autocomplete({
      source: "includes/autocomplete_name.php?htid=<?=$_SESSION['admin']?>"
    });
});
}

function autocus()
{
$( document ).ready(function() {
    $( "#customer1").autocomplete({
      source: "cusautocomplete.php?htid=<?=$_SESSION['admin']?>"
    });
});
}		

		
		var k = <?php echo $k ?>;
		var m=<?php echo $m ?>;
function addproductfields()	
{
	
	var fields = '<tr style="border-bottom:1px #EEE solid;" id="tr'+k+'"><td><input type="text" class="form-control" placeholder="No." name="no[]" id="no'+m+'" value="'+m+'" style="width:45px;"></td><td><input type="hidden" name="prodid[]" id="prodid'+k+'"><input type="text" autocomplete="off" class="form-control" onKeyPress="productcodesearch('+k+')" name="productcode[]" id="productcode'+k+'" style="width:70px;" placeholder="Code" onkeydown="if (event.keyCode === 13 || event.keyCode === 9){if(this.value==\'\'){}else{$(\'#vatper'+k+'\').focus();}}" onBlur="addproductdetais(this.value,'+k+')"></td><td><input type="text" onKeyPress="productsearch('+k+')" onkeydown="if (event.keyCode == 13 || event.keyCode == 9){$(\'#vatper'+k+'\').focus();}" onBlur="addproductdetais_name(this.value, '+k+')" autocomplete="off" class="form-control" name="productmlname[]" id="productmlname'+k+'" style="width:275px;" placeholder="Product Name"></td><td><input type="text" class="form-control" onKeyUp="calculatetotal('+k+')" placeholder="Sale Price" name="saleprice[]" id="saleprice'+k+'" style="width:100px;"><input type="hidden" class="form-control"  name="purchaseprice[]" id="purchaseprice'+k+'" ></td><td><input type="text" placeholder="GST %" style="width:60px;" readonly class="form-control" name="vatper[]" id="vatper'+k+'"></td><td><input type="number" class="form-control" step="any" onChange="calculatetotal('+k+'),sub_stock(this.value,'+k+')" onKeyUp="calculatetotal('+k+'),sub_stock(this.value,'+k+')" name="qty[]" id="qty'+k+'"  placeholder="Qty" style="width:100px;">Avail Stock: <span id="availableqty'+k+'"></span>Balance: <span id="bal'+k+'"></span></td><td><input type="text" onkeydown="if (event.keyCode === 9){$(\'#no'+(m+1)+'\').focus();}" style="width:60px;" class="form-control" onChange="calcdisc(this.value,'+k+')" name="discounti[]" id="discount'+k+'" ><input type="hidden" name="prediscount[]" id="prediscount'+k+'"></td><td><input type="number" style="width:60px;"   class="form-control" onChange="calcdisc_amt(this.value,'+k+')"  name="discount_amt[]" id="discount_amt'+k+'"> </td><td style="display:none;"><input type="text" class="form-control" readonly placeholder="Unit" name="unittype[]" id="unittype'+k+'" style="width:70px;"></td><td><input type="hidden" name="prenetamnt[]" id="prenetamnt'+k+'"><input type="text" class="form-control" readonly placeholder="Net amount" name="netamnt[]" id="netamnt'+k+'" style="width:100px;"></td><td><input type="text" class="form-control" readonly placeholder="GST" name="vatamnt[]" id="vatamnt'+k+'" style="width:70px;"></td><td><input readonly type="text" class="form-control" placeholder="Total" name="total[]" id="total'+k+'" style="width:100px;"><input type="hidden" class="form-control" name="pretotal[]" id="pretotal'+k+'" style="width:100px;"></td><td><div class="btn-group" role="group"><a href="#" data-toggle="tooltip" data-placement="bottom" title="" onclick="removeproduct('+k+')" class="btn btn-default btn-sm m-user-delete" data-original-title="Remove Product"><i class="fa fa-times" aria-hidden="true"></i></a></div></td></tr>';
	$('#cartitems').append(fields);
	k = k+1;
	m=m+1;
}
function addcus(srchky)
{
	//alert("hai");
	if(srchky == "")
	{
		document.getElementById('results'+num).style.display='none';
	}
	else{
		
		$.ajax({
			url : "cusautosearch.php",
			type: "POST",
			data : {key : srchky, shid:"<?=$_SESSION['admin']?>"},
			
			dataType: 'json',
			success: function(data)
			{
				
				
				
				
				$('#customerid').val(data[0]);
				//$('#customer1').val(data[1]);
				//$('#productmlname'+data[8]).val(data[2]);
				//$('#productcode'+data[8]).prop('readonly',true);
				//$('#productmlname'+data[8]).prop('readonly',true);
				//$('#bottleprice'+data[8]).val(data[3]);
				$('#address').val(data[2]);
				//$('#oldbalance').val(data[3]);
				$('#tin_number').val(data[4]);
				$('#supplyplace').val(data[5]);
				
				
				//$('#vatper'+data[8]).val(data[6]);
				//$('#unittype'+data[8]).val(data[7]);
				
				/*var tot = Number(data[4]);
				$('#total'+data[8]).val(tot);
				
				if($('#totalprice').val() == "")
				{
					$('#totalprice').val(tot);
				}else{
					var total = Number($('#totalprice').val())+Number(tot);
					$('#totalprice').val(total);
					
				}
				
				
				
				$('#productcode'+data[8]).removeAttr("onkeyup");
				$('#productname'+data[8]).removeAttr("onkeyup");*/
				
				//$('#results'+data[6]).css('display': 'inline');
			},
			
		});
		//document.getElementsByClassName('secol').style.display='none';
		document.getElementById('results').style.display='none';
		//$('#qty'+num).focus();
	}
}	
function addproductdetais(srchky, num)
{
	
	//alert("hai");
	var exists = 0;
	if(srchky == "")
	{
		document.getElementById('results'+num).style.display='none';
	}
	else{
		
		$.ajax({
			url : "includes/autosearchdetails.php",
			type: "POST",
			data : {key : srchky, number:num, shid:"<?=$_SESSION['admin']?>"},
			dataType: 'json',
			success: function(data)
			{
				
				if(data[15]==1)
				{
                var prodid=data[0];
				var prodcode=data[1];
				var enname=data[2];
				var purprice=data[3];
				var saleprice=data[4];
				var stock=data[5];
				var num=data[8];
				var vat=data[6];
                    var cess=data[12];
				var unit=data[7];
				
				var mrp=data[4];
				var retail=data[4];
				var wholesale=data[10];
				var hsn=data[11];
                    var mrp1=data[13];
                    var rackno=data[14];
                    
				var billmode=$('#billmode').val();
				switch(billmode)
				{
				case "retail":saleprice=retail;break;
				case "whole":saleprice=wholesale;break;
				//case "mrp":saleprice=mrp;break;
				default:saleprice=retail;break;
				}
				
	$('input[name^="prodid"]').each(function() {
		if($(this).val() == prodid)
		{
			exists = 1;
		}
	});
	if(exists == 0)
	{
		
	$('#prodid'+num).val(prodid);
	$('#productcode'+num).val(prodcode);
	$('#productmlname'+num).val(enname);
	var oldbal = $('#oldbalance').val();
	
	
	$('#availableqty'+num).html(stock);
	$('#bal'+num).html(Number(stock)-1);
	$('#qty'+num).val(1);
	$('#vatper'+num).val(vat);
        $('#cess'+num).val(cess);
	$('#unittype'+num).val(unit);
       $('#mrp1'+num).val(mrp1);
        $('#rackno'+num).val(rackno); 
	//var vtamnt = (Number(vat)/(Number(vat)+100))*Number(saleprice);
       //var tt_cess = (Number(cess)/(Number(cess)+100))*Number(saleprice);
        //var tt_cess = (Number(cess)/(Number(cess)+100))*Number(saleprice);
//alert(vtamnt);
	//var vtamnt = (Number(vat)/100)*Number(saleprice);
	//var product_prive =(Number(saleprice) - Number(vtamnt)).toFixed(2);
   // var tt_cess = (Number(cess)*Number(saleprice))/100;
	//var product_prive = ((Number(saleprice) - Number(vtamnt))-Number(tt_cess)).toFixed(2);
      //var tt_cess1 = Number(tt_cess);  
        var net2 = (Number(cess) + Number(vat) + 100) / 100;
        var product_prive = Number(saleprice)/ Number(net2); 
        var vtamnt = (Number(product_prive)*Number(vat))/100;
        var tt_cess = (Number(product_prive)*Number(cess))/100;
         var tt_cess1 = Number(tt_cess) * Number(cess);
	$('#saleprice'+num).val(saleprice);
	$('#purchaseprice'+num).val(purprice);
	$('#netamnt'+num).val(product_prive.toFixed(2));
	$('#prenetamnt'+num).val(product_prive);
        //var tt_cess = (Number(cess)/(Number(cess)+100))*Number(product_prive);
        
	var tot = Number(saleprice);
	$('#total'+num).val(tot.toFixed(2));
	$('#vatamnt'+num).val(vtamnt.toFixed(2));
    $('#cess1'+num).val(tt_cess1.toFixed(2));
	
	if($('#totalprice').val() == "")
	{
		$('#totalprice').val(tot.toFixed(2));
		//var tt=Number(tot)+Number(oldbal);
		var tt=Number(tot)
		tt= Math.round(tt);
		$('#gtotalprice').val(Number(Math.round(tt)));
		$('#paidamount').val(Number(Math.round(tt)));
		
	}
	else{
		var total = Number($('#totalprice').val())+Number(tot);
		$('#totalprice').val(total.toFixed(2));
		
		$('#gtotalprice').val(Number(Math.round(total)));
		$('#paidamount').val(Number(Math.round(total)));
	}
	$('#productcode'+num).attr("readonly", "true");
	$('#productmlname'+num).attr("readonly", "true");
	
	$('#productcode'+num).removeAttr("onblur");
	$('#productmlname'+num).removeAttr("onblur");
	
	addproductfields();
	
	document.getElementById('results'+num).style.display='none';
	
		
	}
			else{
		alert("Product already selected.");
	} 
	}else{
				
				return;
			}
			},
			
			
		
		});
		//document.getElementsByClassName('secol').style.display='none';
		//document.getElementById('results'+num).style.display='none';
		//$('#saleprice'+num).focus();
	}
	

	
}
function addproductdetais_name(srchky, num)
{
	
	//alert("hai");
	var exists = 0;
	if(srchky == "")
	{
		document.getElementById('results'+num).style.display='none';
	}
	else{
		
		$.ajax({
			url : "includes/autosearchdetails_name.php",
			type: "POST",
			data : {key : srchky, number:num, shid:"<?=$_SESSION['admin']?>"},
			dataType: 'json',
			success: function(data)
			{
				if(data[15]==1)
				{				
				var prodid=data[0];
				var prodcode=data[1];
				var enname=data[2];
				var purprice=data[3];
				var saleprice=data[4];
				var stock=data[5];
				var num=data[8];
				var vat=data[6];
                var cess=data[12];
				var unit=data[7];
				
				var mrp=data[4];
				var retail=data[9];
				var wholesale=data[10];
				var hsn=data[11];
                    var mrp1=data[13];
				var rackno=data[14];
                    
	$('input[name^="prodid"]').each(function() {
		if($(this).val() == prodid)
		{
			exists = 1;
		}
	});
	if(exists == 0)
	{
		
		
	$('#prodid'+num).val(prodid);
	$('#productcode'+num).val(prodcode);
	$('#productmlname'+num).val(enname);
	var oldbal = $('#oldbalance').val();
	
	$('#availableqty'+num).html(stock);
	$('#bal'+num).html(Number(stock)-1);
	$('#qty'+num).val(1);
	$('#vatper'+num).val(vat);
	$('#unittype'+num).val(unit);
	var vtamnt = (Number(vat)/(Number(vat)+100))*Number(saleprice);
	//var vtamnt = (Number(vat)/100)*Number(saleprice);
	//var product_prive =(Number(saleprice) - Number(vtamnt)).toFixed(2);
	var product_prive =(Number(saleprice) - Number(vtamnt)).toFixed(2);
	$('#saleprice'+num).val(saleprice);
	$('#purchaseprice'+num).val(purprice);
	$('#netamnt'+num).val(product_prive);
	$('#prenetamnt'+num).val(product_prive);
	var tot = Number(saleprice);
	$('#total'+num).val(tot);
	$('#vatamnt'+num).val(vtamnt.toFixed(2));
	
	if($('#totalprice').val() == "")
	{
		$('#totalprice').val(tot.toFixed(2));
		var tt=Number(tot);
		tt= Math.round(tt);
		$('#gtotalprice').val(Number(Math.round(tt)));
		$('#paidamount').val(Number(Math.round(tt)));
		
	}
	else{
		var total = Number($('#totalprice').val())+Number(tot);
		$('#totalprice').val(total.toFixed(2));
		
		$('#gtotalprice').val(Number(Math.round(total)));
		$('#paidamount').val(Number(Math.round(total)));
	}
	$('#productcode'+num).attr("readonly", "ture");
	$('#productmlname'+num).attr("readonly", "ture");
	
	$('#productcode'+num).removeAttr("onblur");
	$('#productmlname'+num).removeAttr("onblur");
	addproductfields();
	
	document.getElementById('results'+num).style.display='none';
	
		
	
		
	}
			else{
		alert("Product already selected.");
	}}else{
				
				return;
			}
			},
			
			
		
		});
		//document.getElementsByClassName('secol').style.display='none';
		//document.getElementById('results'+num).style.display='none';
		//$('#saleprice'+num).focus();
	}
	

	
}
function removeproduct(num)
{
	/*if(confirm("Are you sure?"))
	{*/
	var discount = Number($('#discount').val())-Number($('#prediscount'+num).val());
	$('#discount').val(discount.toFixed(2));
		var deltotal = $('#total'+num).val();
		var minustotal = Number($('#totalprice').val()) - Number(deltotal);
		var newgtotal = Number($('#gtotalprice').val()) - Number(deltotal);
		$('#totalprice').val(minustotal.toFixed(2));
		$('#gtotalprice').val(Math.round(newgtotal));
		//$('#discount').val(0);
		$('#paidamount').val(Math.round(newgtotal));
		$('table#drgcartitms tr#tr'+num).remove();
		
		var j=1;
	for(i=1;i<=k;i++)
	{
if($("#no"+i).length){
	//alert(j);
	$("#no"+i).val(j);
	$("#no"+i).attr("id","no"+j)
	j++;
	}
	else{
		
		}

	} m = j;
	//}
}

function calculatetotal(num)
{
	var discount = $('#discount').val();
	var discounti = $('#prediscount'+num).val();
	discount12 = Number(discount)-Number(discounti);
	
	var discount = $('#discount').val();
	
	var vat = $('#vatper'+num).val();
	var qty = $('#qty'+num).val();
	//var prce = $('#saleprice'+num).val();
	// var prce = $('#netamnt'+num).val();
	var prce = $('#saleprice'+num).val();
	// var pri = $('#saleprice'+num).val();
    var tcess = $('#cess'+num).val();
	var balance=$('#balance').val();
	var coolie=$('#coolie').val();
	//var ototal=$('#oldbalance').val();
	if(prce != "")
	{
		/*var preval = $('#pretotal'+num).val();
		if(preval == "")
		{
			var prval = prce;
		}
		else{
			var prval = Number(preval);
		}*/
		var prval = $('#total'+num).val();
		
		var minustotal = Number($('#totalprice').val()) - Number(prval);
		
		
		//var vtamnt = ((Number(vat)/100)*prce);
		//var vtamnt =(Number(vat)/(Number(vat)+100))*Number(prce);
       //var vtamnt = (Number(vat)/(Number(vat)+100))*Number(prce);
        //var tt_cess = (Number(tcess)*Number(prce))/100;
        //var tt_cess =(Number(tcess)/(Number(tcess)+100))*Number(prce);
       // var netamnt1 = (Number(qty)*(Number(prce)-Number(vtamnt)))-Number(tt_cess1);
//var tt_cess = (Number(tcess)*Number(prce))/100;
        //var tt_cess = (Number(tcess)*Number(netamnt))/100;
        var net3 = ((Number(vat)+Number(tcess)+100)/100);
        var netamnt = (Number(prce)/Number(net3))*Number(qty);
		//var ttl_vat = Number(vtamnt)*Number(qty);
        //var net3 = ((Number(prce)-Number(vtamnt))-Number(tt_cess));
        //var ttl_cess1 = (((Number(net3)*Number(qty))/100) * Number(tcess)); 
       //var tt_cess1 = Number(tt_cess)*Number(qty);
		//var netamnt = (Number(qty)*((Number(prce)-Number(vtamnt))-Number(tt_cess)));
        //var tt_cess = (Number(tcess)/(Number(tcess)+100))*Number(netamnt);
       // var tt_cess = (Number(tcess)*Number(netamnt))/100;
        //var netamt1 = Number(netamnt)-Number(tt_cess);
        var vtamnt = ((Number(netamnt)*Number(vat))/100);
      var tt_cess = (Number(tcess)*Number(netamnt))/100;
        var ttl_cess1 = (Number(tt_cess)*Number(tcess));
		var total = Number(qty)*Number(prce);
		
		var totamnt = Number(total.toFixed(2));
				
		var lastotal = Number(minustotal) + Number(totamnt);
		$('#vatamnt'+num).val(vtamnt.toFixed(2))
		$('#totalprice').val(lastotal.toFixed(2));
		$('#total'+num).val(totamnt);
		$('#prenetamnt'+num).val(netamnt);
		$('#netamnt'+num).val(netamnt.toFixed(2));
        $('#cess1'+num).val(ttl_cess1.toFixed(2));
		$('#discount'+num).val('');
		$('#prediscount'+num).val('');
		$('#pretotal'+num).val(totamnt);
		
		//var gtotal = Number(lastotal) + Number(coolie) + Number(ototal);
		var gtotal = (Number(lastotal) + Number(coolie))-Number(discount);
		$('#gtotalprice').val(Math.round(gtotal));
		$('#paidamount').val(Math.round(gtotal));
		$('#discount').val(discount12.toFixed(2));
	}
}
function calcdisc(disc,num)
{
	disc=Number(disc);
	var netamt=$("#netamnt"+num).val();
	var one_per=Number(netamt)/Number(100);
	var dis_amt=Number(disc)*Number(one_per);
	//alert(dis_amt);

	var predisc=$('#prediscount'+num).val();
	var prenetamnt=$('#prenetamnt'+num).val();
	
	var disc=(disc/100)*prenetamnt;
	//predisc=(predisc/100)*prenetamnt;
	
	//prenetamnt=Number(prenetamnt)+Number(predisc);
	
	var tdisc = $('#discount').val();
	var olddisc = Number(tdisc)-Number(predisc);
	//alert(olddisc);
	var newtdisc = olddisc+Number(disc);
	var taxp=$('#vatper'+num).val();
	var cess=$('#cess_per'+num).val();
	//alert(cess);
	
	var total = $('#total'+num).val();


	var totalprice = $('#totalprice').val();
	var gtotal = $('#gtotalprice').val();
	
	var newtotalprice = Number(totalprice)-Number(total);
	var newgtotal = Number(gtotal)-Number(total);
	
	var newnet = Number(prenetamnt)-Number(disc);
	//alert(newnet);

	var newtax = (Number(taxp)/100)*newnet;
	var newcess=(Number(cess)/100)*newnet;

	//alert(newtax);
	//alert(newcess);
	var newtotal = newnet+newtax;
	
	newtotalprice = newtotalprice+newtotal;
	newgtotal = newgtotal+newtotal;

	$('#discount_amt'+num).val(dis_amt.toFixed(2));
	//$('#prenetamnt'+num).val(newnet.toFixed(2));
	$('#netamnt'+num).val(newnet.toFixed(2));
	$('#vatamnt'+num).val(newtax.toFixed(2));
	$('#cess_amount'+num).val(newcess.toFixed(2));
	$('#total'+num).val(newtotal.toFixed(2));
	$('#pretotal'+num).val(newtotal.toFixed(2));
	$('#totalprice').val(newtotalprice.toFixed(2));
	$('#gtotalprice').val(Math.round(newgtotal));
	$('#paidamount').val(Math.round(newgtotal));
	//$('#discount').val(newtdisc.toFixed(2));
	$('#prediscount'+num).val(disc.toFixed(2));
	total_disc_amt();
}

///////////////////////
function total_disc_amt(){
    
          var sum=0;
       $('.discount_amt').each(function () {
            
            sum +=Number(($(this).val()));
            });
//alert(sum);
           $("#discount").val(sum.toFixed(2));
}
////////////////
function calcdisc_amt_total(disc,num)
{
	disc=Number(disc);
	var netamt=$("#netamnt"+num).val();
	var one_per=Number(netamt)/Number(100);
	var dis_amt=Number(disc)*Number(one_per);
	
	var predisc=$('#prediscount'+num).val();
	var prenetamnt=$('#prenetamnt'+num).val();
	// alert(" hi");
	// alert("welcome");

	
	disc=(disc/100)*prenetamnt;
	//predisc=(predisc/100)*prenetamnt;
	
	//prenetamnt=Number(prenetamnt)+Number(predisc);
	
	var tdisc = $('#discount').val();

	var olddisc = Number(tdisc)-Number(predisc);
	//alert(olddisc);
	var newtdisc = olddisc+Number(disc);
	var taxp=$('#vatper'+num).val();
	var cess=$('#cess_per'+num).val();
	//alert(cess);
	
	var total = $('#total'+num).val();


	var totalprice = $('#totalprice').val();
	var gtotal = $('#gtotalprice').val();
	
	var newtotalprice = Number(totalprice)-Number(total);
	var newgtotal = Number(gtotal)-Number(total);
	
	var newnet = Number(prenetamnt)-Number(disc);
	//alert(newnet);

	var newtax = (Number(taxp)/100)*newnet;
	var newcess=(Number(cess)/100)*newnet;

	//alert(newtax);
	//alert(newcess);
	var newtotal = newnet+newtax;
	
	newtotalprice = newtotalprice+newtotal;
	newgtotal = newgtotal+newtotal;

	//$('#discount_amt'+num).val(dis_amt.toFixed(2));
	//$('#prenetamnt'+num).val(newnet.toFixed(2));
	$('#netamnt'+num).val(newnet.toFixed(2));
	$('#vatamnt'+num).val(newtax.toFixed(2));
	$('#cess_amount'+num).val(newcess.toFixed(2));
	$('#total'+num).val(newtotal.toFixed(2));
	$('#pretotal'+num).val(newtotal.toFixed(2));
	$('#totalprice').val(newtotalprice.toFixed(2));
	$('#gtotalprice').val(Math.round(newgtotal));
	$('#paidamount').val(Math.round(newgtotal));
	//$('#discount').val(newtdisc.toFixed(2));
	$('#prediscount'+num).val(disc.toFixed(2));
	total_disc_amt();
	
}
//////////discount in amount///////////
function calcdisc_amt(val,id){
	var netamnt=$("#netamnt"+id).val();
	var one_per=Number(netamnt)/Number(100);
	var dis_amt=(Number(netamnt)-Number(val));
//alert(dis_amt);
var new_dis=Number(val)/Number(one_per);
	//var dis=Number(dis_amt)/Number(one_per);
	$("#discount"+id).val(new_dis.toFixed(2));
	//alert(dis);
	calcdisc_amt_total(new_dis,id);

}

////////////////
function calculatedicounttotal(cat)
{
	var paidamount = $('#paidamount').val();
	var discount = $('#discount').val();
	var totalprice = $('#totalprice').val();
	var coolie = $('#coolie').val();
	//var oldbalance = $('#oldbalance').val();
	var gtotal = $('#gtotalprice').val();
	if(cat==2)
	{
	
	var paidamnt = Number(gtotal) - Number(paidamount);
	$('#balance').val(paidamnt.toFixed(2));
	}
	if(cat==1)
	{
		
		//var gtotal = Number(totalprice) + Number(coolie) + Number(oldbalance);
		var gtotal = Number(totalprice) + Number(coolie);
		$('#gtotalprice').val(Math.round(gtotal));
		$('#paidamount').val(Math.round(gtotal));
	}
	if(cat==3)
	{
		//var gtotal = Number(totalprice) + Number(coolie) + Number(oldbalance);
		var gtotal = Number(totalprice) + Number(coolie);
		$('#gtotalprice').val(Math.round(gtotal));
		$('#paidamount').val(Math.round(gtotal));
	}
	
}

function sub_stock(a,k)
		{
			
			if(a=="")
			{
			return;
			}
			var b=document.getElementById("availableqty"+k).innerHTML;
			var sub= Number(b)-Number(a);
			document.getElementById("bal"+k).innerHTML=sub;
		
		}

	var chech = document.getElementById('customercheck');
	chech.onchange=function()
	{
		if(this.checked)
			{
			
			document.getElementById('show').style.display="block";
			//document.getElementById('show1').style.display="table-row";
			document.getElementById('normal').style.display="none";
			}
			else
			{
				document.getElementById('customer1').value='';
				document.getElementById('customerid').value='';
				document.getElementById('tin_number').value='';
				document.getElementById('normal').style.display="block";
				document.getElementById('show').style.display="none";
				//document.getElementById('show1').style.display="none";
				//document.getElementById('oldbalance').value=0;
			}
	}

		
		$(document).keyup(function(e){
	if(e.keyCode === 113)
	{window.open('addstocks.php','myNewWinsr','width=620,height=800,toolbar=0,menubar=no,status=no,resizable=yes,location=no,directories=no');} //esc
});

$(document).keyup(function(e){
	if(e.keyCode === 115)
	{window.open('customer.php','myNewWinsr','width=620,height=800,toolbar=0,menubar=no,status=no,resizable=yes,location=no,directories=no');} //esc
});
		
		
function ValidatePassKey()
 {
    if (event.keyCode === 9)
	{
		$('#productcode<?= $k ?> '+ 1).focus();
		}
  }
  
  $('form').on('focus', 'input[type=number]', function (e) {
  $(this).on('mousewheel.disableScroll', function (e) {
    e.preventDefault()
  })
})
$('form').on('blur', 'input[type=number]', function (e) {
  $(this).off('mousewheel.disableScroll')
})

window.addEventListener("keydown", function(e) {
    // space and arrow keys
    if([37, 38, 39, 40].indexOf(e.keyCode) > -1) {
        e.preventDefault();
    }
}, false);

</script>
		
		</script>
        
    </body>

</html>
<?php
}else{
	header("Location:../index.php");
}
?>