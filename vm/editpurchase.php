<?php
session_start();
error_reporting(0);
if(isset($_SESSION['admin']))
{
	include("includes/config.php");
	
	
	if(isset($_POST['submit1']))
	{
		$company_name = $_POST['company_name'];
		$supplier_name = $_POST['supplier_name'];
		$supplier_phone = $_POST['supplier_phone'];
		$supplier_address = $_POST['supplier_address'];
		$supplier_email = $_POST['supplier_email'];
		$tin_number = $_POST["tin_number"];
		$statecode=$_POST['statecode'];
		$balance=$_POST["balance"];
		
		
		//echo print_r($_POST);
		$insert = $conn->query("INSERT INTO us_supplier(rs_company_name, rs_name, rs_phone, rs_address, rs_email, user_id, rs_balance, rs_tinnum, rs_statecode,finyear) VALUES('$company_name','$supplier_name','$supplier_phone','$supplier_address','$supplier_email','".$_SESSION["admin"]."', '$balance', '$tin_number', '$statecode','".$_SESSION["finyearid"]."')");
		if($insert)
		{
			header('Location:purchase.php?id=success');
	  }
	  else{
		  header('Location:purchase.php?id=fail');
		}
	}
	
	
	if(isset($_POST['submit']))
	{
		$insrtitms=true;
		
		$billno = $_POST['billno'];
		
		$customerid=$_POST["customerid"];
		
		$vehicle_number=$_POST["vehicle_number"];
		$invoice_number=$_POST["invoice_number"];
		$invoice_date=$_POST["invoice_date"];
		
		
		$customername = "";
		$phone = "";
		$date = date('Y-m-d', strtotime($_POST['date']));
		$time = date('H:i:s', strtotime($_POST['time']));
		$billdate = $date . " " . $time;
		$totalprice = $_POST['totalprice'];
		$discount = $_POST['discount'];
		$paidamount = $_POST['paidamount'];
		$balance=$_POST["balance"];
		$paydate = $_POST['pdate'];
		$paytype=$_POST["paytype"];
		
		$curdate = date('Y-m-d H:i:s');
		
		$prodname= $_POST['productmlname'];
		$prodid= $_POST['prodid'];
		$saleprice= $_POST['purchaseprice'];
		$qty= $_POST['qty'];
		$vatamnt = $_POST['vatamnt'];
		$vatper = $_POST['vatper'];
		$stateid=$_POST['stateid'];
		$discounti=$_POST['discounti'];
		$netamnt=$_POST["netamnt"];
		$prrate=$_POST["prrate"];
		
		$oldbalance=$_POST["oldbalance"];
		$gtotalprice=$_POST["gtotalprice"];
		
		
		
		$particulars="Purchase";
		$transactiontype="expense";
		//$date=$_POST['pdate'];
		$time=$_POST['time'];
		$datetime=date("Y-m-d", strtotime($_POST["pdate"]))." ".date("H:i", strtotime($_POST["time"]));
		$amount=$_POST['paidamount'];
		$billid=$_POST['billid'];
		
				
 $slct_empnum=$conn->query("SELECT	tr_closingbalance FROM us_transaction ORDER BY tr_id DESC LIMIT 1");
if(mysqli_num_rows($slct_empnum)>0)
 {
$last=$slct_empnum->fetch_assoc();
$openingbalence = $last['tr_closingbalance'] ;
 }
 else{
 $openingbalence =0;
 }
 $closingbalance=$openingbalence-$amount;
 $total= $_POST['total'];
 
 $queryb=$conn->query("SELECT * FROM us_purentry WHERE pe_billid='".$billid."'");
    $rowbalz=$queryb->fetch_assoc();
$balz=$rowbalz["pe_balance"];

$slct_cusbal=$conn->query("SELECT rs_balance FROM us_supplier WHERE rs_supplierid= '$customerid'");
$row_cusbal=$slct_cusbal->fetch_assoc();
$prebalz=$row_cusbal["rs_balance"];
$balancenewz=$prebalz-$balz;
$balancenew=$balancenewz+$balance;
$update1 = $conn->query("UPDATE us_supplier SET  rs_balance='$balancenew'  WHERE rs_supplierid= '$customerid'");
		
		
		
		//echo $billno."<br>".$customername."<br>".$phone."<br>".$date."<br>".$time."<br>".$billdate."<br>".$totalprice."<br>".$discount."<br>".$paidamount."<br>".$curdate."<br>".$paydate."<br>pname:".$prodname[0]."<br>pid:".$prodid[0]."<br>".$saleprice[0]."<br>".$qty[0]."<br>".$total[0];
		$insrtbill=$conn->query("UPDATE us_purentry SET pe_billnumber='$billno', pe_customername='$customername', pe_customermobile='$phone', pe_billdate='$billdate', pe_total= '$totalprice', pe_paidamount='$paidamount', pe_updateddate='$curdate', pe_discount='$discount', pe_mode= 'purchase', pe_paydate='$paydate',user_id='".$_SESSION["admin"]."',pe_balance='$balance',pe_supplierid='$customerid',pe_vehicle_number='$vehicle_number',pe_invoice_number='$invoice_number',pe_invoice_date='$invoice_date', pe_gtotal='$gtotalprice', pe_oldbal='$oldbalance',pe_statecode='$stateid',pe_paymethod='$paytype',finyear = '".$_SESSION["finyearid"]."' WHERE pe_billid='".$billid."'");
		if($insrtbill)
		{
			

			
					
					//$update1 = $conn->query("UPDATE us_supplier SET  rs_balance='$totbalance'  WHERE rs_supplierid= '$customerid'");
			$query=$conn->query("SELECT pi_productid,pi_quantity FROM us_puritems WHERE pi_billid='$billid'");
			while($rowupdat=$query->fetch_assoc())
			{
				$query1=$conn->query("SELECT pr_stock FROM us_products WHERE pr_productid='".$rowupdat["pi_productid"]."'");
				$rowupdate1=$query1->fetch_assoc();
				$sum=$rowupdate1["pr_stock"]-$rowupdat["pi_quantity"];
				$query2=$conn->query("UPDATE us_products SET pr_stock='$sum' WHERE pr_productid='".$rowupdat["pi_productid"]."'");
			
			}
			$delet=$conn->query("DELETE FROM us_puritems WHERE pi_billid='".$billid."'");
			if($delet)
			{
				$n=0;
			foreach($prodid as $prdval)
			{
				if($stateid==$_SESSION['stcode'])
			{
				$sgst=$vatper[$n]/2;
				$sgstamnt=$vatamnt[$n]/2;
				$cgst=$vatper[$n]/2;
				$cgstamnt=$vatamnt[$n]/2;
				//echo $stateid."-".$sgst."-".$sgstamnt."-".$cgst."-".$cgstamnt;
			}
			else
			{
				$igst=$vatper[$n];
				$igstamnt=$vatamnt[$n];
			}
				
				if($prdval != "")
				{
					
					$insrtitms = $conn->query("INSERT INTO  us_puritems(pi_billid, pi_productid, pi_price, pi_quantity, pi_total, pi_updatedon,pi_vatamount,pi_discount, pi_taxamount,pi_prrate,pi_vatper,pi_sgst,pi_sgstamt,pi_cgst,pi_cgstamt,pi_igst,pi_igstamt,user_id,finyear) VALUES('$billid', '$prdval', '$saleprice[$n]', '$qty[$n]', '$total[$n]', '$curdate','$vatamnt[$n]','$discounti[$n]','$netamnt[$n]','$prrate[$n]','$vatper[$n]','$sgst','$sgstamnt','$cgst','$cgstamnt','$igst','$igstamnt','".$_SESSION["admin"]."','".$_SESSION["finyearid"]."')");
					$stcs = $conn->query("SELECT pr_stock FROM us_products WHERE pr_productid='$prdval'");
					$row = $stcs->fetch_assoc();
					$nwstock = $row['pr_stock'] + $qty[$n];
					$update = $conn->query("UPDATE us_products SET pr_stock='$nwstock' WHERE pr_productid='$prdval'");

					$deletst=$conn->query("DELETE FROM us_stockreport WHERE billid='".$bill_id."' and sr_mode='Purchase'");
					$closingstockamount=$nwstock*$purchaseprice[$n];

					$stockrepo="INSERT INTO us_stockreport(sr_itemid,sr_date,sr_qty,sr_amount,sr_closingstock,sr_mode,finyear,billid) VALUES( '$prdval','$billdate','$qty[$n]','$closingstockamount','$nwstock','Purchase','".$_SESSION["finyearid"]."','$bill_id')";

					$insrtbill1=$conn->query("$stockrepo");
					
				}
				$n++;
			}
			//echo $insrtitms;

		  $delet=$conn->query("DELETE FROM us_transaction WHERE tr_billid='".$billid."' and tr_particulars='Purchase'");

         $delet=$conn->query("DELETE FROM administrator_daybook WHERE bill_id='".$billid."' and debit='6'");



				if($paytype=='CASH')
                   {
						
                $insert=$conn->query("insert into us_transaction(tr_particulars,tr_openingbalance,tr_transactionamount,tr_closingbalance,tr_date,tr_transactiontype,tr_billid,user_id,finyear)
                   values('$particulars',' $openingbalence','$amount','$closingbalance','$billdate','$transactiontype','$billid','".$_SESSION["admin"]."','".$_SESSION["finyearid"]."')");
				   
				   $slct=$conn->query("SELECT * FROM us_supplier LEFT JOIN administrator_account_name ON refid=rs_acntid WHERE rs_supplierid= '$customerid'");
					$rowacnt=$slct->fetch_assoc();
					$acntname=$rowacnt["acc_name"];
					$acntid=$rowacnt["refid"];

					//$insert_acnt=$conn->query("INSERT INTO administrator_daybook(ad_branchid, dayBookDate, debit, credit, dayBookContra, dayBookAmount, description, backup,finyear,bill_id,mode) VALUE('".$_SESSION["admin"]."','$date','1','5','Y','$gtotalprice','CASH SALE','','".$_SESSION["finyearid"]."','$bill_id','1')");
				if($balance>'0'){
				$insert_acnt=$conn->query("INSERT INTO administrator_daybook(ad_branchid, dayBookDate, debit, credit, dayBookContra, dayBookAmount, description,finyear,bill_id,mode,dr_cr,bill_amnt,user_id) VALUES('".$_SESSION["admin"]."','$date','6','1','Y','$paidamount','CASH PURCHASE','".$_SESSION["finyearid"]."','$bill_id','1','D','$gtotalprice','".$_SESSION["admin"]."')");
				    $acntid2=$conn->insert_id;
				    $update2=$conn->query("UPDATE us_purentry SET pe_debitid='$acntid2' WHERE pe_billid ='$bill_id'");

				    $insrtacnt1=$conn->query("INSERT INTO administrator_daybook(ad_branchid, dayBookDate, debit, credit, dayBookContra, dayBookAmount, description,finyear,bill_id,mode,dr_cr,user_id) VALUES('".$_SESSION["admin"]."','$date','6','$acntid','Y','$balance','CREDIT PURCHASE','".$_SESSION["finyearid"]."','$bill_id','1','C','".$_SESSION["admin"]."')");
					$acntid2=$conn->insert_id;
					$update2=$conn->query("UPDATE us_purentry SET pe_creditid='$acntid2' WHERE pe_billid ='$bill_id'");

				}else{

					$insert_acnt=$conn->query("INSERT INTO administrator_daybook(ad_branchid, dayBookDate, debit, credit, dayBookContra, dayBookAmount, description,finyear,bill_id,mode,dr_cr,bill_amnt,user_id) VALUES('".$_SESSION["admin"]."','$date','6','1','Y','$amount',' PURCHASE','".$_SESSION["finyearid"]."','$bill_id','1','D','$gtotalprice','".$_SESSION["admin"]."')");
				    $acntid2=$conn->insert_id;
				    $update2=$conn->query("UPDATE us_purentry SET pe_debitid='$acntid2' WHERE pe_billid ='$bill_id'");
				}
					
					//$day_tax=$conn->query("INSERT INTO administrator_daybook(ad_branchid, dayBookDate, debit,credit, dayBookContra, dayBookAmount, description, backup,finyear,bill_id) VALUE('".$_SESSION["admin"]."','$date','34','5','Y','$vat','GST','','".$_SESSION["finyearid"]."','$bill_id')");

					//$day_taxable=$conn->query("INSERT INTO administrator_daybook(ad_branchid, dayBookDate, debit,credit, dayBookContra, dayBookAmount, description, backup,finyear,bill_id) VALUE('".$_SESSION["admin"]."','$date','41','5','Y','$taxs','TAXABLE VALUE','','".$_SESSION["finyearid"]."','$bill_id')");
						if($coolie > 0){
				//$day_disc=$conn->query("INSERT INTO administrator_daybook(ad_branchid, dayBookDate, debit,credit, dayBookContra, dayBookAmount, description, backup,finyear,bill_id) VALUE('".$_SESSION["admin"]."','$date','36','5','Y','$coolie','COOLIE','','".$_SESSION["finyearid"]."','$bill_id')");
			}
				
					
					}
					else{
						 $insert=$conn->query("insert into us_transaction(tr_particulars,tr_openingbalance,tr_transactionamount,tr_closingbalance,tr_date,tr_transactiontype,tr_billid,user_id,finyear)
                   values('$particulars',' $openingbalence','$amount','$closingbalance','$billdate','$transactiontype','$billid','".$_SESSION["admin"]."','".$_SESSION["finyearid"]."')");
				   
				   $slct=$conn->query("SELECT * FROM us_supplier LEFT JOIN administrator_account_name ON refid=rs_acntid WHERE rs_supplierid= '$customerid'");
					$rowacnt=$slct->fetch_assoc();
					$acntname=$rowacnt["acc_name"];
					$acntid=$rowacnt["refid"];
				
				if($balance>'0'){
				$insert_acnt=$conn->query("INSERT INTO administrator_daybook(ad_branchid, dayBookDate, debit, credit, dayBookContra, dayBookAmount, description,finyear,bill_id,mode,dr_cr,bill_amnt,user_id) VALUES('".$_SESSION["admin"]."','$date','6','13','Y','$paidamount','CASH PURCHASE','".$_SESSION["finyearid"]."','$bill_id','1','D','$gtotalprice','".$_SESSION["admin"]."')");
				    $acntid2=$conn->insert_id;
				    $update2=$conn->query("UPDATE us_purentry SET pe_debitid='$acntid2' WHERE pe_billid ='$bill_id'");

				    $insrtacnt1=$conn->query("INSERT INTO administrator_daybook(ad_branchid, dayBookDate, debit, credit, dayBookContra, dayBookAmount, description,finyear,bill_id,mode,dr_cr,user_id) VALUES('".$_SESSION["admin"]."','$date','6','$acntid','Y','$balance','CREDIT PURCHASE','".$_SESSION["finyearid"]."','$bill_id','1','C','".$_SESSION["admin"]."')");
					$acntid2=$conn->insert_id;
					$update2=$conn->query("UPDATE us_purentry SET pe_creditid='$acntid2' WHERE pe_billid ='$bill_id'");


				}else{

					$insert_acnt=$conn->query("INSERT INTO administrator_daybook(ad_branchid, dayBookDate, debit, credit, dayBookContra, dayBookAmount, description,finyear,bill_id,mode,dr_cr,bill_amnt,user_id) VALUES('".$_SESSION["admin"]."','$date','6','13','Y','$amount',' PURCHASE','".$_SESSION["finyearid"]."','$bill_id','1','D','$gtotalprice','".$_SESSION["admin"]."')");
				    $acntid2=$conn->insert_id;
				    $update2=$conn->query("UPDATE us_purentry SET pe_debitid='$acntid2' WHERE pe_billid ='$bill_id'");
				}
					
					}
					
                  
				
				if($insert)
	       {header("location:purc_print.php?billid=$billid");}
	   else{
				header('Location: purchase.php?er=error1');
			}
				
				//header('Location: purchase.php?suc=success');
				
				
			}
			else{
				header('Location: purchase.php?er=error1');
			}
		}
		else{
			header('Location: purchase.php?er=error2');
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
	.margin-left input{margin-right:10px; margin-top:10px;}
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
    </head>
    <body class="page-header-fixed">
    
<div class="overlay"></div>   
<link rel="stylesheet" href="includes/auto/jquery-ui.css">
<script src="includes/auto/jquery-1.js"></script>
<script src="includes/auto/jquery-ui.js"></script>
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
                    <h3><strong>Purchase (<?= date('d-M-Y') ?>)</strong></h3>
                    <div class="page-breadcrumb">
                        <ol class="breadcrumb">
                        	<li>Billing</li>
                            <li class="active">Purchase</li>
                        </ol>
                    </div>
                </div>
                <?php
			$today = date('Y-m-d');
				if(isset($_GET['billid']))
				{
					$billid = $_GET['billid'];
				
					$stocks = $conn->query("SELECT * FROM us_purentry WHERE pe_billid='$billid' AND user_id='".$_SESSION["admin"]."'");
					if(mysqli_num_rows($stocks)>0)
					{
						$row = $stocks->fetch_assoc();
						
					}
					
				}
				?>
                <div id="main-wrapper">
                    <!-- Row -->
                    <div class="row">
                        
                        
                        
                        
                        
                        <div class="col-lg-12 col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h4 class="panel-title">Purchase</h4>
                                    <!--<a href="dashboard.php?billno=<?= $billno+1 ?>" target="_blank"> </a>
                                    <a href="javascript:window.open('addsupplier.php','mywindowtitle','width=500,height=800')" ><button type="button" class="btn btn-primary btn-addon m-b-sm" style="float: right;margin-right:13px;"><i class="fa fa-plus"></i>New Supplier</button></a>-->
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
                                      <form class="form-horizontal" name="addbilldetails" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
                                       
                                       <input type="hidden" name="billid" id="billid" value="<?= $_GET["billid"] ?>">
                                      <div class="table-responsive">
                                       <table class="table">
                                       	<tr>
                                        	<td>
                                            Bill No: <input type="text" name="billno" id="billno" value="<?=$row["pe_billnumber"] ?>"  style="width:60px;" ><br><br>
                                           
                                              <?php 
                                            $spname = $conn->query("SELECT * FROM us_supplier  WHERE rs_supplierid = '".$row["pe_supplierid"]."'");
													  $rowsp=$spname->fetch_assoc(); ?>
                                            <div id="show">
                                            <br>
											 <input type="hidden" id="stateid" name="stateid" value="<?=$row["pe_statecode"]?>" >
											 <input type="hidden" id="customerid" name="customerid" value="<?=$row["pe_supplierid"]?>" >
                                             <input type="text" class="form-control" onKeyUp="suppliersearch(this.value)" id="customer1" autocomplete="off" name="customername1[]" style="width: 220px; display: inline;" placeholder="Supplier Name" onKeyPress="autosup()" onBlur="addsup(this.value)" value="<?=$rowsp["rs_company_name"] ?>" required><br> 
                                           
											<div id="result" class="secol" style="position: absolute; font-size: 12px; z-index: 999; width: 50%; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px; display: none;background-color: rgb(255, 255, 255);">
											<div class="secol" style="padding:5px;" id="searchresult">
                                            </div></div> 

											
                                            
                                            
											</div>
                                            
                                            <div class="margin-left">
                                             <input type="text" class="form-control" autocomplete="off" name="vehicle_number" style="width: 220px; display: inline;" placeholder="Vehicle Number" value="<?=$row["pe_vehicle_number"] ?>"><br><input type="text" class="form-control" autocomplete="off" name="invoice_number" style="width: 220px; display: inline;" placeholder="Invoice Number" value="<?=$row["pe_invoice_number"] ?>"><input type="date" class="form-control" autocomplete="off" name="invoice_date" style="width: 220px; display: inline;" placeholder="Invoice Date"  value="<?=$row["pe_invoice_date"] ?>">
                                             
                                             </div>
                                            </td>
                                            <td align="right"><input type="date" class="form-control" style="width: 155px; display: inline;" name="date" id="date"  value="<?= date('Y-m-d', strtotime($row["pe_billdate"])) ?>"> &nbsp; 
                                            <input type="time" class="form-control" style="width: 120px; display: inline;" name="time" id="time" value="<?= date('H:i:s', strtotime($row["pe_billdate"])) ?>"></td>
                                            
                                        </tr>
                                       </table>
                                       
                                    <table class="table" id="drgcartitms">
                                    <thead>
                                    <tr>
                                    	<th>Sl No.</th>
                                        <th>Product id</th>
                                        <th>Product Name</th>
                                      <th>HSN Number</th>
                                        <th>Purchase Price</th>
										<!--<th>Unit Price</th>-->
                                        <th>GST %</th>
                                        <th>Qty</th>
                                        <th>Discount%</th>
                                         <th>Net</th>
										<!--<th>Unit</th>-->
										
                                        <th>GST </th> 
                                        <th>Total</th>
                                        <th>PR Rate</th>                
                                        <th></th>
                                    </tr>
                                    </thead>
                                    
                                    <tbody><?php
										$k=1;
										$m=1;
										$slctitm=$conn->query("SELECT * FROM us_puritems WHERE pi_billid='$billid'");
										while($rowitm=$slctitm->fetch_assoc())
										{
											$itm=$conn->query("SELECT * FROM us_products WHERE pr_productid='".$rowitm["pi_productid"]."'");
											$itmrow=$itm->fetch_assoc();
										
										?>
										<tr style="border-bottom:1px #EEE solid;" id="tr<?= $k ?>">
										<td><input type="text" class="form-control" placeholder="No." name="no[]" id="no<?= $m ?>" value="<?=$m?>" style="width:45px;"></td>
										<td>
                                      <input type="hidden" name="prodid[]" id="prodid<?= $k ?>" value="<?=$rowitm["pi_productid"]?>">
											<input type="text" autocomplete="off" class="form-control" onKeyPress="(<?= $k ?>)" name="productcode[]" id="productcode<?= $k ?>" style="width:70px;" placeholder="Code" onkeydown="if (event.keyCode === 13 || event.keyCode === 9){$('#productmlname<?= $k ?>').focus();}" onBlur="addproductdetais(this.value, <?= $k ?>)" value="<?=$itmrow["pr_productcode"]?>">
										</td>
                                        <td><input type="text" onKeyPress="(<?= $k ?>)" onkeydown="if (event.keyCode == 13 || event.keyCode == 9){$('#productmlname<?= $k ?>').focus();}" onBlur="addproductdetais_name(this.value, <?= $k ?>)" autocomplete="off" class="form-control" name="productmlname[]" id="productmlname<?= $k ?>" style="width:200px;" placeholder="Product Name" value="<?=$itmrow["pr_productname"]?>" ></td>
                                        <td >
										<input type="text" class="form-control" placeholder="HSN" name="hsn[]" id="hsn<?= $k ?>" style="width:90px;" value="<?=$itmrow["pr_hsn"]?>">
										</td>
										
                                        <td><input type="number" step="any" class="form-control" value="<?=$rowitm["pi_price"]?>"  name="purchaseprice[]"placeholder="Purchase Price"  id="saleprice<?= $k ?>" onKeyUp="calculatetotal(<?= $k ?>)"  style="width:70px;"></td>
										<td style="display:none;"><input type="number" step="any" readonly placeholder="Unit Price" style="width:100px;" class="form-control" id="unitprice<?= $k ?>"></td>
                                        <td>
										<input type="number" step="any"  placeholder="GST %" style="width:50px;" value="<?=$rowitm["pi_vatper"]?>"class="form-control" name="vatper[]" id="vatper<?= $k ?>"></td>
										<td><input type="number" step="any" class="form-control" value="<?=$rowitm["pi_quantity"]?>" name="qty[]" onChange="calculatetotal(<?= $k ?>)" onKeyUp="calculatetotal(<?= $k ?>)" id="qty<?= $k ?>" placeholder="Qty" style="width:60px;">
                                        Avail Stock: <span id="availableqty<?= $k ?>"></span>
                                        </td>
                                        <?php
										$disp=$rowitm["pi_discount"]/100;
										$disc=$disp*$rowitm["pi_taxamount"];
										
										?>
                                         <td><input type="number" step="any" style="width:50px;" class="form-control" onChange="calcdisc(this.value,<?= $k ?>)" onkeydown="if (event.keyCode === 13 || event.keyCode === 9){$('#no<?= $k+1 ?>').focus();}" name="discounti[]" value="<?=$rowitm["pi_discount"]?>"id="discount<?= $k ?>"><input type="hidden" name="prediscount[]" id="prediscount<?= $k ?>" value="<?=$disc?>"  ></td>
                                        
                                        <td>
                                        <input type="hidden" name="prenetamnt[]" id="prenetamnt<?= $k ?>"  value="<?=$rowitm["pi_taxamount"]?>" >
                                        <input type="text" class="form-control" readonly placeholder="Net amount" name="netamnt[]"  value="<?=$rowitm["pi_taxamount"]?>"  id="netamnt<?= $k ?>" style="width:70px;"></td>
										<!--<td>
										<input type="text" class="form-control" readonly placeholder="Unit" name="unittype[]" id="unittype<?= $k ?>" style="width:70px;">
										</td>-->
                                        
                                        
                                        <td>
                                        <input type="text" class="form-control" readonly placeholder="Gst amount" name="vatamnt[]" value="<?=$rowitm["pi_vatamount"]?>"id="vatamnt<?= $k ?>" style="width:70px;"></td>
										
										<td>
                                        	<input readonly type="text" class="form-control" placeholder="Total" name="total[]" id="total<?= $k ?>" style="width:100px;" value="<?=$rowitm["pi_total"]?>">
                                            
                                            <input type="hidden" class="form-control" name="pretotal[]" id="pretotal<?= $k ?>" style="width:100px;" value="<?=$rowitm["pi_total"]?>">
                                            
                                        </td>
                                         
                                        <td>
                                        <input type="text" class="form-control" readonly placeholder="PR Rate" value="<?=$rowitm["pi_prrate"]?>" name="prrate[]" id="prrate<?= $k ?>" style="width:60px;"></td>
										<td>
										<div class="btn-group" role="group">
													<a href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" title="" onclick="removeproduct(<?= $k ?>)" class="btn btn-default btn-sm m-user-delete" data-original-title="Remove Product"><i class="fa fa-times" aria-hidden="true"></i></a>
										  </div>
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
                                    <a href="javascript:void(0)" onClick="addproductfields()">add</a>
                    
                                    <table class="table">
                                    	<tr>
                                        <td align="right">Total Amount:</td>
                                        <td width="150"><input type="text" readonly class="form-control" name="totalprice" id="totalprice" placeholder="Total Amount" style="width:150px;" value="<?=$row["pe_total"]?>">
                                        
                                        </td>
                                        </tr>
                                        <tr>
                                        <td align="right">Discount:</td>
                                        <td width="150"><input type="text" class="form-control" name="discount" id="discount" placeholder="Discount" value="<?=$row["pe_discount"]?>" onChange="calculatedicounttotal(1)" onKeyUp="calculatedicounttotal(1)" style="width:150px;">
                                        
                                        </td>
                                        </tr>
                                        <tr>
										 
												<td align="right">Old Balance</td>
												<td style="width:150px;"><input type="text"  class="form-control" value="<?=$row["pe_oldbal"]?>" name="oldbalance" id="oldbalance" placeholder="Old Balance" style="width:150px;">
                                        
											</td>
																					 
										</tr>
                                        <tr>
											<td align="right">Grant Total:</td>
											<td width="150"><input type="text" readonly class="form-control" name="gtotalprice" id="gtotalprice" placeholder="Grant Total" style="width:150px;" value="<?=$row["pe_gtotal"]?>">
                                        
											</td>
										</tr>
                                        <tr>
                                        <td align="right">Paid Amount:</td>
                                        <td width="150"><input type="number" step="any" class="form-control" name="paidamount" onChange="calculatedicounttotal(2)" onKeyUp="calculatedicounttotal(2)" id="paidamount" placeholder="Paid Amount" required style="width:150px;" value="<?=$row["pe_paidamount"]?>" >
                                        
                                        </td>
                                        </tr>
                                        <tr>
                                        <td align="right">Balance Amount:</td>
                                        <td width="150"><input type="text" readonly class="form-control" value="<?=$row["pe_balance"]?>"  name="balance" id="balance" placeholder="Balance" required style="width:150px;">
                                        
                                        </td>
                                        </tr>
                                        <tr style="display: none">
                                        <td align="right" style="display: none">Paid Date:</td>
                                        <td align="right" style="display: none"><input  type="date" class="form-control" style="width: 150px;" name="pdate" id="pdate" value="<?= date('Y-m-d', strtotime($row["pe_paydate"])) ?>"> &nbsp; </td></tr>
                                        </tr>
                                        <tr>
                                        <td align="right">Payment Method</td>
                                        <td width="150"><select class="form-control" name="paytype" id="paytype" required style="width:120px;">
                                        <option <?php if($row['pe_paymethod']=='CASH'){ ?> selected  <?php } ?> value="CASH">Cash</option>
										
                                        <option <?php if($row['pe_paymethod']=='BANK'){ ?> selected  <?php } ?> value="BANK">Bank</option>
                                        </select>
                                        </td></tr>
                                    </table>
                                      
                                        </div>
                                        <div class="form-group" align="right" style="padding-right:30px;">
                                        <label for="input-help-block" class="col-sm-2 control-label"></label>
                                        <button type="submit" name="submit" onclick="return confirm('Do you want to Save & print the Bill?')" class="btn btn-primary">Save & Print</button>
                                        </div>
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
	
	function autosup()
{
$( document ).ready(function() {
    $( "#customer1").autocomplete({
      source: "supautocomplete.php?htid=<?=$_SESSION['admin']?>"
    });
});
}
		
		
		var k = <?php echo $k ?>;
		var m = <?php echo $m ?>;
		
function addproductfields()
{
	var fields = '<tr style="border-bottom:1px #EEE solid;" id="tr'+k+'"><td ><input type="hidden" id="mrp'+k+'" name="mrp[]" style="width: 100px;"><input type="hidden" style="width: 100px;" name="retail[]" id="retail'+k+'"><input type="hidden" style="width: 100px;" name="wholesale[]" id="wholesale'+k+'"><input type="text" class="form-control" placeholder="No." name="no[]" id="no'+m+'" value="'+m+'" style="width:45px;"></td><td><input type="hidden" name="prodid[]" id="prodid'+k+'"><input type="text" onClick="addprice('+k+')" onKeyPress="productcodesearch('+k+')" onBlur="addproductdetais(this.value, '+k+')" name="productcode[]" onkeydown="if (event.keyCode === 13 || event.keyCode === 9){$(\'#productcode'+k+'\').focus();}" autocomplete="off" class="form-control" name="productcode[]" id="productcode'+k+'" style="width:100px;" placeholder="Code"></td> <td><input type="text" autocomplete="off" class="form-control" onKeyPress="productsearch('+k+')" onkeydown="if (event.keyCode == 13 || event.keyCode == 9){$(\'#productmlname'+k+'\').focus();}" onBlur="addproductdetais_name(this.value,'+k+')" name="productmlname[]" id="productmlname'+k+'" style="width:200px;"placeholder="Product Name"></td><td ><input type="text" class="form-control" placeholder="HSN" name="hsn[]" id="hsn'+k+'" style="width:90px;"></td><td><input type="number" step="any" class="form-control" placeholder="Purchase Price" name="purchaseprice[]" id="saleprice'+k+'" onKeyUp="calculatetotal('+k+')" style="width:70px;"></td><td style="display:none;"><input type="number" step="any" readonly placeholder="Unit Price" style="width:100px;" class="form-control" onKeyUp="calculatetotal('+k+')"  id="unitprice'+k+'"></td><td><input type="number" step="any" placeholder="Gst %" style="width:50px;" class="form-control" name="vatper[]" id="vatper'+k+'"></td><td><input type="number" class="form-control" step="any" onChange="calculatetotal('+k+')" onKeyUp="calculatetotal('+k+')" name="qty[]" id="qty'+k+'" placeholder="Qty" style="width:60px;">Avail Stock: <span id="availableqty'+k+'"></span></td><td><input type="number" step="any" style="width:50px;" class="form-control" onChange="calcdisc(this.value,'+k+')" name="discounti[]" onkeydown="if (event.keyCode === 13 || event.keyCode === 9){$(\'#no'+(m+1)+'\').focus();}" id="discount'+k+'"><input type="hidden" name="prediscount[]" id="prediscount'+k+'"></td><td><input type="hidden" name="prenetamnt[]" id="prenetamnt'+k+'"><input type="text" class="form-control" readonly placeholder="Net amount" name="netamnt[]" id="netamnt'+k+'" style="width:70px;"></td><td style=" display:none;"><input type="text" class="form-control" readonly placeholder="Unit" name="unittype[]" id="unittype'+k+'" style="width:70px;"></td><td><input type="text" class="form-control" readonly placeholder="Vat amount" name="vatamnt[]" id="vatamnt'+k+'" style="width:70px;"></td><td><input readonly type="text" class="form-control" placeholder="Total" name="total[]" id="total'+k+'" style="width:100px;"><input type="hidden" class="form-control" name="pretotal[]" id="pretotal'+k+'" style="width:100px;"></td><td><input type="text" class="form-control" readonly placeholder="PR Rate"  id="prrate'+k+'" name="prrate[]" style="width:60px;"></td><td><div class="btn-group" role="group"><a href="#" data-toggle="tooltip" data-placement="bottom" title="" onclick="removeproduct('+k+')" class="btn btn-default btn-sm m-user-delete" data-original-title="Remove Product"><i class="fa fa-times" aria-hidden="true"></i></a></div></td></tr>';
	$('#cartitems').append(fields);
		k = k+1;
		m = m+1;
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
				if(data[12]==1)
				{
				
				
				var prodid=data[0];
				var prodcode=data[1];
				var enname=data[2];
				var purprice=data[3];
				var saleprice=data[4];
				var stock=data[5];
				var num=data[8];
				var vat=data[6];
				var unit=data[7];
				
				var mrp=data[4];
				var retail=data[9];
				var wholesale=data[10];
				var hsn=data[11];
				
				
	$('input[name^="prodid"]').each(function() {
		if($(this).val() == prodid)
		{
			exists = 1;
		}
	});
	if(exists == 0)
	{
	
	var actttl=$('#actualtot').val();
	
	$('#mrp'+num).val(mrp);
	$('#retail'+num).val(retail);
	$('#wholesale'+num).val(wholesale);
	
	$('#prodid'+num).val(prodid);
	$('#productcode'+num).val(prodcode);
	$('#productmlname'+num).val(enname);
	$('#hsn'+num).val(hsn);
	var oldbal = $('#oldbalance').val();
	
	$('#availableqty'+num).html(stock);
	$('#qty'+num).val(1);
	$('#vatper'+num).val(vat);
	$('#unittype'+num).val(unit);
	var vtamnt = ((Number(vat)/100)*purprice);
	//var vtamnt = (Number(vat)/(Number(vat)+100))*Number(purprice);
	
	var product_prive =(Number(purprice));
	$('#saleprice'+num).val(purprice);
	$('#unitprice'+num).val(product_prive);
	$('#netamnt'+num).val(product_prive);
	$('#prenetamnt'+num).val(product_prive);
	var tot = Number(product_prive)+Number(vtamnt);
	//alert(tot);
	$('#total'+num).val(tot.toFixed(2));
	
	var pr =Number(tot.toFixed(2));
	$('#prrate'+num).val(pr.toFixed(2));
	$('#vatamnt'+num).val(vtamnt.toFixed(2));
	
	
	if($('#totalprice').val() == "")
	{
		$('#totalprice').val(tot.toFixed(2));
		var tt=Number(tot);
		
		$('#gtotalprice').val(Number(tt));
		$('#paidamount').val(Number(tt));
		var total1=tot.toFixed(2);
	}
	else{
		var total = Number($('#totalprice').val())+Number(tot);
		$('#totalprice').val(total.toFixed(2));
		total=Math.round(total);
		$('#gtotalprice').val(Number(total));
		$('#paidamount').val(Number(total));
		var total1=total.toFixed(2);
	}
	
	$('#productcode'+num).attr("readonly", "ture");
	$('#productmlname'+num).attr("readonly", "ture");
	
	$('#productcode'+num).removeAttr("onblur");
	$('#productmlname'+num).removeAttr("onblur");
	
	//var diff=Number(actttl)-Number(total1);	
	//if(diff<0){diff=Number(diff)*(-1);}
	//if(diff<2){$('#saveprint').removeAttr("disabled");}else{$('#saveprint').attr("disabled", "ture");};
	addproductfields();
	
	//document.getElementById('results'+num).style.display='none';
	
		
	
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
				
				if(data[12]==1)
				{
				
				var prodid=data[0];
				var prodcode=data[1];
				var enname=data[2];
				var purprice=data[3];
				var saleprice=data[4];
				var stock=data[5];
				var num=data[8];
				var vat=data[6];
				var unit=data[7];
				
				var mrp=data[4];
				var retail=data[9];
				var wholesale=data[10];
				var hsn=data[11];
				
	$('input[name^="prodid"]').each(function() {
		if($(this).val() == prodid)
		{
			exists = 1;
		}
	});
	if(exists == 0)
	{
	
	var actttl=$('#actualtot').val();
	
	$('#mrp'+num).val(mrp);
	$('#retail'+num).val(retail);
	$('#wholesale'+num).val(wholesale);
	
	$('#prodid'+num).val(prodid);
	$('#productcode'+num).val(prodcode);
	$('#productmlname'+num).val(enname);
	$('#hsn'+num).val(hsn);
	var oldbal = $('#oldbalance').val();
	
	$('#availableqty'+num).html(stock);
	$('#qty'+num).val(1);
	$('#vatper'+num).val(vat);
	$('#unittype'+num).val(unit);
	var vtamnt = ((Number(vat)/100)*purprice);
	//var vtamnt = (Number(vat)/(Number(vat)+100))*Number(purprice);
	
	var product_prive =(Number(purprice));
	$('#saleprice'+num).val(purprice);
	$('#unitprice'+num).val(product_prive);
	$('#netamnt'+num).val(product_prive);
	$('#prenetamnt'+num).val(product_prive);
	var tot = Number(product_prive)+Number(vtamnt);
	//alert(tot);
	$('#total'+num).val(tot.toFixed(2));
	
	var pr =Number(tot.toFixed(2));
	$('#prrate'+num).val(pr);
	$('#vatamnt'+num).val(vtamnt.toFixed(2));
	
	
	if($('#totalprice').val() == "")
	{
		$('#totalprice').val(tot.toFixed(2));
		var tt=Number(tot);
		tt= Math.round(tt);
		$('#gtotalprice').val(Number(tt));
		$('#paidamount').val(Number(tt));
		var total1=tot.toFixed(2);
	}
	else{
		var total = Number($('#totalprice').val())+Number(tot);
		$('#totalprice').val(total.toFixed(2));
		total=Math.round(total);
		$('#gtotalprice').val(Number(total));
		$('#paidamount').val(Number(total));
		var total1=total.toFixed(2);
	}
	
	$('#productcode'+num).attr("readonly", "ture");
	$('#productmlname'+num).attr("readonly", "ture");
	
	$('#productcode'+num).removeAttr("onblur");
	$('#productmlname'+num).removeAttr("onblur");
	
	/*var diff=Number(actttl)-Number(total1);	
	if(diff<0){diff=Number(diff)*(-1);}
	if(diff<2){$('#saveprint').removeAttr("disabled");}else{$('#saveprint').attr("disabled", "ture");};*/
	addproductfields();
	
	//document.getElementById('results'+num).style.display='none';
	
		
	
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
/*function addtoproduct(prodid, prodcode, enname, purprice, saleprice, stock, num, vat,unit,hsn)
{
	
	
	var discount = $('#discount').val();
	var exists = 0;
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
	$('#hsn'+num).val(hsn);
	var oldbal = $('#oldbalance').val();
	
	$('#availableqty'+num).html(stock);
	$('#qty'+num).val(1);
	$('#vatper'+num).val(vat);
	$('#unittype'+num).val(unit);
	var vtamnt = ((Number(vat)/100)*purprice);
	//var vtamnt = (Number(vat)/(Number(vat)+100))*Number(purprice);
	var product_prive =(Number(purprice));
	$('#saleprice'+num).val(purprice);
	$('#unitprice'+num).val(product_prive);
	$('#netamnt'+num).val(product_prive);
	$('#prenetamnt'+num).val(product_prive);
	var tot = Number(product_prive)+Number(vtamnt);
	$('#total'+num).val(Math.round(tot));
	var pr =Number(tot);
	$('#prrate'+num).val(Math.round(pr));
	$('#vatamnt'+num).val(vtamnt.toFixed(2));
	
	
	if($('#totalprice').val() == "")
	{
		$('#totalprice').val(Math.round(tot));
		var tt=Number(tot)+Number(oldbal);
		tt= Math.round(tt);
		$('#gtotalprice').val(Number(tt));
		$('#paidamount').val(Number(tt));
		
	}
	else{
		var total = Number($('#totalprice').val())+Number(tot);
		$('#totalprice').val(Math.round(total));
		total=Math.round(total);
		$('#gtotalprice').val(Number(total));
		$('#paidamount').val(Number(total));
	}
	
	/*if($('#totalprice').val() == "")
	{
		$('#totalprice').val(Math.round(tot));
		
		$('#gtotalprice').val(Number(tot)+Number(oldbal));
		$('#paidamount').val(Number(tot)+Number(oldbal));
	}
	else{
		var total = Number($('#totalprice').val())+Number(tot);
		$('#totalprice').val(total);
		
		$('#gtotalprice').val(Number(total)+Number(oldbal));
		$('#paidamount').val(Number(total)+Number(oldbal));
	}*
	
	addproductfields();
	
	document.getElementById('results'+num).style.display='none';
	}else{
		alert("Product already selected.");
	}
}*/

function removeproduct(num)
{
	
	var discount = Number($('#discount').val())-Number($('#prediscount'+num).val());
	$('#discount').val(discount.toFixed(2));
		var deltotal = $('#total'+num).val();
		var minustotal = Number($('#totalprice').val()) - Number(deltotal);
		var newgtotal = Number($('#gtotalprice').val()) - Number(deltotal);
		$('#totalprice').val(minustotal.toFixed(2));
		$('#gtotalprice').val(Math.round(newgtotal))
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
	/*if(confirm("Are you sure?"))
	{*/
	/*
	var discount = $('#discount').val();
		var deltotal = $('#total'+num).val();
		var minustotal = Number($('#totalprice').val()) - Number(deltotal);
		$('#totalprice').val(minustotal.toFixed(2));
		//$('#discount').val(0);
		$('#paidamount').val((Number(minustotal)-Number(discount)).toFixed(2));
		$('table#drgcartitms tr#tr'+num).remove();*/
	//}
}

function calculatetotal(num)
{
	var actttl=$('#actualtot').val();
	
	var discount = $('#discount').val();
	var discounti = $('#prediscount'+num).val();
	discount12 = Number(discount)-Number(discounti);
	
	var discount = $('#discount').val();
	
	
	var vat = $('#vatper'+num).val();
	var qty = $('#qty'+num).val();
	var prce = $('#saleprice'+num).val();
	
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
		
		
	var vtamnt = ((Number(vat)/100)*prce);
		//var vtamnt = (Number(vat)/(Number(vat)+100))*Number(prce);
		var ttl_vat = Number(vtamnt)*Number(qty);
		var netamnt = Number(qty)*Number(prce);
		//var total = Number(qty)*(Number(prce)+Number(vtamnt.toFixed(2)));
		var total = Number(ttl_vat)+Number(netamnt);
		//var total = Math.round(total);
		
		var totamnt = Number(total.toFixed(2));
				
		/*var lastotal = Number(minustotal) + Number(totamnt);
		$('#vatamnt'+num).val(ttl_vat.toFixed(2))
		$('#totalprice').val(lastotal);
		$('#total'+num).val(totamnt);
		$('#pretotal'+num).val(totamnt);
		
		
		var unitprice= Number(prce)-Number( vtamnt);
		$('#unitprice'+num).val(unitprice)
		
		var gtotal = Number(lastotal) - Number(discount) + Number(ototal);
		$('#gtotalprice').val(gtotal);
		$('#paidamount').val(gtotal);*/
		
		
		var lastotal = Number(minustotal) + Number(totamnt);
		$('#vatamnt'+num).val(ttl_vat.toFixed(2))
		$('#totalprice').val(lastotal.toFixed(2));
		$('#total'+num).val(totamnt.toFixed(2));
		$('#prenetamnt'+num).val(netamnt.toFixed(2));
		$('#netamnt'+num).val(netamnt.toFixed(2));
		$('#discount'+num).val('');
		$('#prediscount'+num).val('');
		$('#pretotal'+num).val(totamnt.toFixed(2));
		var pr =Number(totamnt) / Number(qty);
	$('#prrate'+num).val(pr.toFixed(2));
		
		//var gtotal = Number(lastotal) + Number(ototal);
		var gtotal = Number(lastotal);
		$('#gtotalprice').val(Math.round(gtotal));
		$('#paidamount').val(Math.round(gtotal));
		$('#discount').val(discount12.toFixed(2));
		
		var total1=gtotal.toFixed(2);
		var diff=Number(actttl)-Number(total1);	
		//if(diff<0){diff=Number(diff)*(-1);}
		//if(diff<2){$('#saveprint').removeAttr("disabled");}else{$('#saveprint').attr("disabled", "ture");};
	}
}

function calcdisc(disc,num)
{
	disc=Number(disc);
	
	var predisc=$('#prediscount'+num).val();
	var prenetamnt=$('#prenetamnt'+num).val();
	
	disc=(disc/100)*prenetamnt;
	//predisc=(predisc/100)*prenetamnt;
	
	//prenetamnt=Number(prenetamnt)+Number(predisc);
	
	var tdisc = $('#discount').val();
	var olddisc = Number(tdisc)-Number(predisc);
	newtdisc = olddisc+Number(disc);
	var taxp=$('#vatper'+num).val();
	var qty = $('#qty'+num).val();
	
	var total = $('#total'+num).val();
	var totalprice = $('#totalprice').val();
	var gtotal = $('#gtotalprice').val();
	
	var newtotalprice = Number(totalprice)-Number(total);
	var newgtotal = Number(gtotal)-Number(total);
	
	var newnet = Number(prenetamnt)-Number(disc);
	var newtax = (Number(taxp)/100)*newnet;
	var newtotal = newnet+newtax;
	
	newtotalprice = newtotalprice+newtotal;
	newgtotal = newgtotal+newtotal;
	
	//$('#prenetamnt'+num).val(newnet.toFixed(2));
	$('#netamnt'+num).val(newnet.toFixed(2));
	$('#vatamnt'+num).val(newtax.toFixed(2));
	$('#total'+num).val((newtotal.toFixed(2)));
	$('#pretotal'+num).val(newtotal.toFixed(2));
	
	var pr =Number(newtotal) / Number(qty);
	$('#prrate'+num).val(pr.toFixed(2));
	$('#totalprice').val((newtotalprice.toFixed(2)));
	$('#gtotalprice').val(Math.round(newgtotal));
	$('#paidamount').val(Math.round(newgtotal));
	$('#discount').val(newtdisc.toFixed(2));
	$('#prediscount'+num).val(disc.toFixed(2));
	
}
function calculatedicounttotal(cat)
{
	var paidamount = $('#paidamount').val();
	var discount = $('#discount').val();
	var totalprice = $('#totalprice').val();
	//var oldbalance = $('#oldbalance').val();
	var gtotal = $('#gtotalprice').val();
	if(cat==2)
	{
	
	var paidamnt = Number(gtotal) - Number(paidamount);
	$('#balance').val(paidamnt);
	}
	if(cat==1)
	{
		
		//var gtotal = Number(totalprice) - Number(discount) + Number(oldbalance);
		var gtotal = Number(totalprice) - Number(discount);
		 
		$('#gtotalprice').val(gtotal);
	$('#paidamount').val(gtotal);
		
	}
	
}
function addsup(srchky)
{
	//alert("hai");
	if(srchky == "")
	{
		document.getElementById('results'+num).style.display='none';
	}
	else{
		
		$.ajax({
			url : "supautosearch.php",
			type: "POST",
			data : {key : srchky, shid:"<?=$_SESSION['admin']?>"},
			dataType: 'json',
			success: function(data)
			{
				
				
				
				
				$('#customerid').val(data[0]);
				$('#oldbalance').val(data[2]);
				//$('#customer1').val(data[1]);
				//$('#productmlname'+data[8]).val(data[2]);
				//$('#productcode'+data[8]).prop('readonly',true);
				//$('#productmlname'+data[8]).prop('readonly',true);
				//$('#bottleprice'+data[8]).val(data[3]);
				//$('#address').val(data[2]);
				$('#stateid').val(data[3]);
				
				
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
function addtocustomer(companyname,supid,suppliername,bal,statecode)
{

	//alert(customername+customerid)
	

		var name = companyname+" ( "+suppliername+" )";
		$('#customerid').val(supid);
		$('#customer1').val(name);
		$('#oldbalance').val(bal);
		$('#gtotalprice').val(bal);
		$('#stateid').val(statecode);
	//document.getElementById('customer1').value=customername;
	
	
	document.getElementById('result').style.display='none';
		
	
}

function showmodel()
		{
			
			
			
			$('#newcusadd').modal('show'); 
		}
		
		$(document).keyup(function(e){
	if(e.keyCode === 113)
	{window.open('addstocks.php','myNewWinsr','width=620,height=800,toolbar=0,menubar=no,status=no,resizable=yes,location=no,directories=no');} //esc
});

$(document).keyup(function(e){
	if(e.keyCode === 115)
	{window.open('addsupplier.php','myNewWinsr','width=620,height=800,toolbar=0,menubar=no,status=no,resizable=yes,location=no,directories=no');} //esc
});

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
    </body>
<div class="modal fade" id="newcusadd" role="dialog">
    <div class="modal-dialog" style="max-width: 50%;">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add New Supplier</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" id="formcustomer" method="post">
          
          <div class="form-group">
                                            <label for="input-Default" class="col-sm-3 control-label">Company Name</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="company_name" value="" id="company_name" placeholder="Company Name" required>
                                            </div>
                                        </div>
										
                                        <div class="form-group">
                                            <label for="input-Default" class="col-sm-3 control-label">Supplier Name</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="name" value="" id="customer_name" placeholder="Supplier Name" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="input-help-block" class="col-sm-3 control-label">Phone Number</label>
                                            <div class="col-sm-12">
											
                                             <input type="text" pattern="[0-9]{10}" title="Enter valid 10 digit number" class="form-control" name="cutomer_phone"  id="cutomer_phone" placeholder="Phone Number">    
                                              
                                                
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="input-help-block" class="col-sm-3 control-label">Address</label>
                                            <div class="col-sm-12">
                                                <textarea class="form-control" name="address" value="" id="customer_address" placeholder="Address"></textarea>
                                                
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="input-help-block" class="col-sm-3 control-label">Email</label>
                                            <div class="col-sm-12">
                                                <input type="email" class="form-control" name="email" value="" id="customer_email" Placeholder="Email ID">
                                                
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="input-help-block" class="col-sm-3 control-label">TIN Number</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="tin_number" value="" id="tin_number" Placeholder="TIN number">
                                                
                                            </div>
                                        </div>
										 
										<div class="form-group">
                                            <label for="input-help-block" class="col-sm-3 control-label">Balance Amount</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="balance" value="0" id="balance" Placeholder="Balance Amount">
                                                
                                            </div>
                                        </div>
										
                                       


                                        
                                            
											<div class="form-group" align="right" style="padding-right:30px;">
                                            
                                        <label for="input-help-block" class="col-sm-2 control-label"></label>
                                        <button type="submit"  name="custpost" class="btn btn-primary">Save</button>
                                        </div>
                                     </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
</html>
<?php
}else{
	header("Location:index.php");
}
?>