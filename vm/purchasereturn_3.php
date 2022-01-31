<?php
session_start();
if(isset($_SESSION['admin']) && !isset($_SESSION['staf']))
{
	include("includes/config.php");
	if(isset($_POST['submit']))
	{
		$insrtitms=true;
		$billno = $_POST['billno'];
		$customerid=$_POST["customerid"];
		$customername = $_POST['customername1'];
		$phone = "";
		
		$date = date('Y-m-d', strtotime($_POST['date']));
		$time = date('H:i:s', strtotime($_POST['time']));
		$billdate = $date . " " . $time;
		$totalprice = $_POST['totalprice'];
		$discount = $_POST['discount'];
		$paidamount = $_POST['paidamount'];
		$curdate = date('Y-m-d H:i:s');
		
		$vehicle_number=$_POST["vehicle_number"];
		//$tin_number=$_POST["tin_number"];
		
		$prodid= $_POST['prodid'];
		$saleprice= $_POST['purchaseprice'];
		$qty= $_POST['qty'];
		$vatamnt = $_POST['vatamnt'];
		$vatper = $_POST['vatper'];
		$total= $_POST['total'];
		$balance=$_POST['balance'];
		//$customer1=$_POST['customername1'];
		//$customercheck=$_POST['customercheck'];
		//$customer=$_POST['customerid'];
		//$billtype=$_POST["billtype"];
		
		//$coolie=$_POST["coolie"];
		//$oldbalance=$_POST["oldbalance"];
		$gtotalprice=$_POST["gtotalprice"];
		$rebill =$_POST["rebill"];
		
		$particulars="Purchase Return";
		$transactiontype="income";
		$date=$_POST['date'];
		$time=$_POST['time'];
		$datetime=date("Y-m-d", strtotime($_POST["date"]))." ".date("H:i", strtotime($_POST["time"]));
		$amount=$_POST['paidamount'];
		$billno=$_POST['billno'];
		
		$invoice_number=$_POST['invoice_number'];
		$invoice_date=$_POST['invoice_date'];
		
		$slct_bill=$conn->query("SELECT pe_billid FROM vm_purentry WHERE pe_billnumber='$rebill'");
		$row_bill=$slct_bill->fetch_assoc();
		$rebill=$row_bill['pe_billid'];
		
		$stateid=$_POST['stateid'];
		
		$slct_empnum=$conn->query("SELECT tr_closingbalance FROM vm_transaction ORDER BY tr_id DESC LIMIT 1");
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
		
		
		$sql="INSERT INTO vm_purreturnentry(pre_billnumber, pre_customerid, pre_customername, pre_billdate, pre_total, pre_paidamount, pre_updateddate, pre_discount, pre_mode, user_id, pre_vehicle_number, pre_gtotal, pre_balance, pre_invoice_number, pre_invoice_date, pre_rebill,pre_statecode) VALUES('$billno','$customerid', '$customername', '$billdate', '$totalprice', '$paidamount', '$curdate', '$discount', 'purchasereturn', '".$_SESSION["admin"]."','$vehicle_number', '$gtotalprice', '$balance', '$invoice_number', '$invoice_date', '$rebill','$stateid')";
		//$sql1="INSERT INTO vm_customer (cs_customerid ,user_id) VALUES ('$customer','".$_SESSION["admin"]."') WHERE $be_billid=$customer";  
		
		$insrtbill=$conn->query("$sql");
		//$insert=$conn->query("$sql1");
		//$cutomer_id=$conn->insert_id;
		if($insrtbill)
		{
			$bill_id = $conn->insert_id;
			$n=0;
			foreach($prodid as $prdval)
			{
				if($prdval != "")
				{
					if($stateid==$_SESSION['stcode'])
			{
				$sgst=$vatper[$n]/2;
				$sgstamnt=$vatamnt[$n]/2;
				$cgst=$vatper[$n]/2;
				$cgstamnt=$vatamnt[$n]/2;
				$igst='';
				$igstamnt='';
				//echo $stateid."-".$sgst."-".$sgstamnt."-".$cgst."-".$cgstamnt."-".$_SESSION['stcode'];
			}
			else
			{
				$sgst='';
				$sgstamnt='';
				$cgst='';
				$cgstamnt='';
				$igst=$vatper[$n];
				$igstamnt=$vatamnt[$n];
			}
					
					$insrtitms = $conn->query("INSERT INTO vm_purreturnitem(pri_billid, pri_returnbillid, pri_productid, pri_price, pri_quantity, pri_total, pri_updatedon, pri_sgst, pri_sgstamt, pri_cgst, pr_cgstamt, pri_igst, pri_igstamt, user_id) VALUES('$bill_id', '$rebill', '$prdval', '$saleprice[$n]', '$qty[$n]', '$total[$n]', '$curdate', '$sgst', '$sgstamnt', '$cgst', '$cgstamnt', '$igst', '$igstamnt','".$_SESSION["admin"]."')");
					$stcs = $conn->query("SELECT pr_stock FROM vm_products WHERE pr_productid='$prdval'");
					$row = $stcs->fetch_assoc();
					$nwstock = $row['pr_stock'] - $qty[$n];
					$update = $conn->query("UPDATE vm_products SET pr_stock='$nwstock' WHERE pr_productid='$prdval'");
					
					
					$selectsupplierbal=$conn->query("select rs_balance from vm_supplier where rs_supplierid='$customerid'");
					$oldbalance = $selectsupplierbal->fetch_assoc();
					
					$totbalance = $oldbalance["rs_balance"]-$balance;
					
					$updatesup = $conn->query("UPDATE vm_supplier SET rs_balance='$totbalance' WHERE rs_supplierid='$customerid'");
				
					}
				$n++;
			}
			
			if($insrtitms)
			{
				$slct=$conn->query("SELECT acc_name FROM vm_supplier LEFT JOIN administrator_account_name ON refid=rs_acntid WHERE rs_supplierid= '$customerid'");
					$rowacnt=$slct->fetch_assoc();
					$acntname=$rowacnt["acc_name"];
				$insert=$conn->query("insert into vm_transaction(tr_particulars,tr_openingbalance,tr_transactionamount,tr_closingbalance,tr_date,tr_transactiontype,tr_billid,user_id)
                   values('$particulars',' $openingbalence','$amount','$closingbalance','$datetime','$transactiontype','$bill_id','".$_SESSION["admin"]."')");
				   
				   $insert_acnt=$conn->query("INSERT INTO administrator_daybook(ad_branchid, dayBookDate, debit, credit, dayBookContra, dayBookAmount, description, backup) VALUE('".$_SESSION["admin"]."','$date','$acntname','PURCHASE RETURN','Y','$paidamount','PURCHASE RETURN','')");
					$acntid1=$conn->insert_id;
					$update2=$conn->query("UPDATE vm_purreturnentry SET pre_debitid='$acntid1' WHERE pre_billid ='$bill_id'");
				   
				    $insert_acnt=$conn->query("INSERT INTO administrator_daybook(ad_branchid, dayBookDate, debit, credit, dayBookContra, dayBookAmount, description, backup) VALUE('".$_SESSION["admin"]."','$date','CASH','$acntname','Y','$paidamount','CREDIT PURCHASE RETURN','')");
					$acntid2=$conn->insert_id;
					$update3=$conn->query("UPDATE vm_purreturnentry SET pre_creditid='$acntid2' WHERE pre_billid ='$bill_id'");
				   
				if($insert)
				{
				
				
				
				
					 header("location:purchasereturn_print.php?billid=$bill_id&csid=".$customer);
					//case 2: header("location:bill_print_cus.php?billid=$bill_id&csid=".$customer);break;
					//case 3: header("location:bill_print_cus1.php?billid=$bill_id&csid=".$customer);break;
				
				
				}else{
					header('Location: purchasereturn.php?er=error1');
			}
			}
			else{
				//echo $sql1;
				header('Location: purchasereturn.php?er=error1');
			}
		}
		
		else{
			//echo $sql;
			
			//header('Location: purchasereturn.php?er=error');
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
    
    <link rel="stylesheet" href="includes/auto/jquery-ui.css">
<script src="includes/auto/jquery-1.js"></script>
<script src="includes/auto/jquery-ui.js"></script>
    <!-- Styles -->
       
        
       <!-- <link href="assets/plugins/metrojs/MetroJs.min.css" rel="stylesheet" type="text/css"/>	
        <link href="assets/plugins/toastr/toastr.min.css" rel="stylesheet" type="text/css"/>-->	
	
        	
        <!-- Theme Styles -->
        
    </head>
    <body class="page-header-fixed">
    
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
                    <h3><strong>Purchase Return (<?= date('d-M-Y') ?>)</strong></h3>
                    <div class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="active">Billing</li>
							 <li class="active">Purchase Return</li>
                        </ol>
                    </div>
                </div>
                <?php
				$today = date('Y-m-d');
				if(isset($_GET['billno']))
				{
					$billno = $_GET['billno'];
				}
				else{
					$stocks = $conn->query("SELECT * FROM vm_purreturnentry WHERE user_id='".$_SESSION["admin"]."' ORDER BY pre_billid DESC LIMIT 1");
					if(mysqli_num_rows($stocks)>0)
					{
						$row = $stocks->fetch_assoc();
						$billno = $row['pre_billnumber'] + 1;
					}
					else{
						$billno = 1;
					}
				}
				
				?>
                <div id="main-wrapper">
                    <!-- Row -->
                    <div class="row">
                        
                        
                        
                        
                        
                        <div class="col-lg-12 col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h4 class="panel-title">Purchase Return</h4>
                                    <a href="purchasereturn.php?billno=<?= $billno+1 ?>" target="_blank"><button type="button" class="btn btn-primary btn-addon m-b-sm" style="float:right"><i class="fa fa-plus"></i> Another Bill</button></a>
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
                                       
                                       <input type="hidden" name="billno" id="billno" value="<?= $billno ?>">
                                      <div class="table-responsive">
                                       <table class="table">
                                       	<tr>
                                        	<td>
                                            Bill No: <input type="text" name="billno" id="billno" value="<?= $billno ?>" style="width:60px;" ><br><br>
                                           
                                            
                                            <div id="show">
                                            
											 <input type="hidden" id="stateid" name="stateid" >
											 <input type="hidden" id="customerid" name="customerid" >
                                            <!-- <input type="text" class="form-control"onKeyUp="customersearch(this.value)" id="customer1" autocomplete="off" name="customername1" style="width: 220px; display: inline;" placeholder="Supplier Name" required>-->
                                             <input type="text" class="form-control" onKeyUp="suppliersearch(this.value)" id="customer1" autocomplete="off" name="customername1[]" style="width: 220px; display: inline;" placeholder="Supplier Name" onKeyPress="autosup()" onBlur="addsup(this.value)" required>       <br> 
                                           
											 

											
                                            
                                            
											</div>
                                            
                                            <div class="margin-left">
                                             <input type="text" class="form-control" autocomplete="off" name="vehicle_number" style="width: 220px; display: inline;" placeholder="Vehicle Number"><input type="text" class="form-control" autocomplete="off" name="invoice_number" style="width: 220px; display: inline;" placeholder="Invoice Number"><input type="date" class="form-control" autocomplete="off" name="invoice_date" style="width: 220px; display: inline;" placeholder="Invoice Date">
                                             
                                             </div>
                                            </td>
                                            <td align="right">
                                            <b>Return Bill : </b><input type="text" required class="form-control" style="width: 90px; margin-left:5px; display: inline;" placeholder="Return bill" name="rebill" id="rebill">
                                            <input type="date" class="form-control" style="width: 155px; display: inline;" name="date" id="date" value="<?= date('Y-m-d') ?>"> &nbsp; 
                                            <input type="time" class="form-control" style="width: 120px; display: inline;" name="time" id="time" value="<?= date('H:i') ?>">
											<br>
											<br>
											<!--<input type="text" class="form-control" placeholder="Amount" style="width: 120px; display: inline;" name="actualtot" id="actualtot" >-->
											</td>
                                            
                                        </tr>
                                       </table>
                                       <div >
                                    <table class="table" id="drgcartitms">
                                    <thead>
                                    <tr>
                                    	<th>Sl No.</th>
                                        <th>Product id</th>
                                        <th>Product Name</th>
                                        <!-- <th>HSN Number</th>-->
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
										//for($k=1; $k<4; $k++)
										//{
										?>
										<tr style="border-bottom:1px #EEE solid;" id="tr<?= $k ?>">
										<td>
										<input type="hidden" id="mrp<?= $k ?>" name="mrp[]" style="width: 100px;">
										<input type="hidden" style="width: 100px;" name="retail[]" id="retail<?= $k ?>">
										<input type="hidden" style="width: 100px;" name="wholesale[]" id="wholesale<?= $k ?>">
										<input type="text" class="form-control" placeholder="No." name="no[]" id="no<?= $m ?>" value="<?=$m?>" style="width:45px;"></td>
										<td>
                                      <input type="hidden" name="prodid[]" id="prodid<?= $k ?>">
											<input onClick="addprice(<?= $k ?>)" type="text" autocomplete="off" class="form-control" onKeyPress="productcodesearch(<?= $k ?>)" name="productcode[]" onkeydown="if (event.keyCode === 13 || event.keyCode === 9){if(this.value==''){}{$('#productcode<?= $k ?>').focus();}}" onBlur="addproductdetais(this.value, <?= $k ?>)" id="productcode<?= $k ?>" style="width:100px;" placeholder="Code">
                                           
										</td>
                                        <td><input type="text" autocomplete="off" class="form-control" name="productmlname[]" onKeyPress="productsearch(<?= $k ?>)" onkeydown="if (event.keyCode == 13 || event.keyCode == 9){$('#vatper<?= $k ?>').focus();}" onBlur="addproductdetais_name(this.value, <?= $k ?>)" style="width:200px;"  id="productmlname<?= $k ?>" placeholder="Product Name"></td>
                                        <td style="display:none;">
										<input type="text" class="form-control" readonly placeholder="HSN" name="hsn[]" id="hsn<?= $k ?>" style="width:90px;">
										</td>
										
                                        <td><input type="number" step="any" class="form-control" placeholder="Purchase Price"  id="saleprice<?= $k ?>" onKeyUp="calculatetotal(<?= $k ?>)" style="width:70px;"></td>
										<td style="display:none;"><input type="text" readonly placeholder="Unit Price" style="width:100px;" class="form-control" name="purchaseprice[]" id="unitprice<?= $k ?>"></td>
                                        <td>
										<input type="number" step="any"  placeholder="GST %" style="width:50px;" class="form-control" name="vatper[]" id="vatper<?= $k ?>"></td>
										<td><input type="number" step="any" class="form-control" name="qty[]" onChange="calculatetotal(<?= $k ?>)" onKeyUp="calculatetotal(<?= $k ?>)" id="qty<?= $k ?>" placeholder="Qty" style="width:60px;">
                                        Avail Stock: <span id="availableqty<?= $k ?>"></span>
                                        </td>
                                         <td><input type="number" step="any" style="width:50px;" class="form-control" onChange="calcdisc(this.value,<?= $k ?>)" onkeydown="if (event.keyCode === 9){$('#no<?= $k+1 ?>').focus();}" name="discounti[]" id="discount<?= $k ?>"><input type="hidden" name="prediscount[]" id="prediscount<?= $k ?>"></td>
                                        
                                        <td>
                                        <input type="hidden" name="prenetamnt[]" id="prenetamnt<?= $k ?>">
                                        <input type="text" class="form-control" readonly placeholder="Net amount" name="netamnt[]" id="netamnt<?= $k ?>" style="width:70px;"></td>
										<!--<td>
										<input type="text" class="form-control" readonly placeholder="Unit" name="unittype[]" id="unittype<?= $k ?>" style="width:70px;">
										</td>-->
                                        
                                        
                                        <td>
                                        <input type="text" class="form-control" readonly placeholder="Gst amount" name="vatamnt[]" id="vatamnt<?= $k ?>" style="width:70px;"></td>
										
										<td>
                                        	<input readonly type="text" class="form-control" placeholder="Total" name="total[]" id="total<?= $k ?>" style="width:100px;">
                                            
                                            <input type="hidden" class="form-control" name="pretotal[]" id="pretotal<?= $k ?>" style="width:100px;">
                                            
                                        </td>
                                         
                                        <td>
                                        <input type="text" class="form-control" readonly placeholder="PR Rate"  id="prrate<?= $k ?>" style="width:60px;"></td>
										<td>
										<div class="btn-group" role="group">
													<a href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" title="" onclick="removeproduct(<?= $k ?>)" class="btn btn-default btn-sm m-user-delete" data-original-title="Remove Product"><i class="fa fa-times" aria-hidden="true"></i></a>
										  </div>
										</td>
										</tr>
										<?php
										//}
										?>
									</tbody>
									<tbody id="cartitems">
									</tbody>
                                    </table></div>
                                    <a href="javascript:void(0)" onClick="addproductfields()">add</a>
                    
                                    <table class="table">
                                    	
										<td align="right">Discount:</td>
                                        <td width="150"><input type="text" class="form-control" name="discount" id="discount" placeholder="Discount" value="0" onChange="calculatedicounttotal(1)" onKeyUp="calculatedicounttotal(1)" style="width:150px;">
                                        
                                        
                                        </td>
                                        </td>
                                        </tr>
										<tr>
                                        
                                        <td align="right">Total Amount:</td>
                                        <td width="150"><input type="text" readonly class="form-control" name="totalprice" id="totalprice" placeholder="Total Amount" style="width:150px;">
                                       
                                        
										 
												<!--<td align="right">Old Balance</td>
												<td style="width:150px;"><input type="text" readonly class="form-control" value="0" name="oldbalance" id="oldbalance" placeholder="Old Balance" style="width:150px;">
                                        
											</td>-->
																					 
										</tr>
                                        <tr>
											<td align="right">Grant Total:</td>
											<td width="150"><input type="text" readonly class="form-control" name="gtotalprice" id="gtotalprice" placeholder="Grant Total" style="width:150px;">
                                        
											</td>
										
                                        <td align="right">Paid Amount:</td>
                                        <td width="150"><input type="number" step="any" class="form-control" name="paidamount" onChange="calculatedicounttotal(2)" onKeyUp="calculatedicounttotal(2)" id="paidamount" placeholder="Paid Amount" required style="width:150px;">
                                        
                                        </td>
                                        </tr>
                                        <tr>
                                        <td colspan="3" align="right">Balance Amount:</td>
                                        <td width="150"><input type="text" readonly class="form-control" value="0" name="balance" id="balance" placeholder="Balance" required style="width:150px;">
                                        
                                        </td>
                                        </tr>
                                        <tr style="display:none;">
                                        <td align="right">Paid Date:</td>
                                        <td align="right"><input  type="date" class="form-control" style="width: 150px;" name="pdate" id="pdate" value="<?= date('d-M-Y') ?>"> &nbsp; </td></tr>
                                    </table>
                                      
                                        </div>
                                        <div class="form-group" align="right" style="padding-right:30px;">
                                        <label for="input-help-block" class="col-sm-2 control-label"></label>
                                        <button type="submit" name="submit" id="saveprint" class="btn btn-primary">Save & Print</button>
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
       <!-- <script src="assets/js/pages/dashboard.js"></script>
        <script src="assets/js/pages/form-elements.js"></script>-->
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

		
		var k=2;
		var m=2;
function addproductfields()	
{
	
	var fields = '<tr style="border-bottom:1px #EEE solid;" id="tr'+k+'"><td><input type="hidden" id="mrp'+k+'" name="mrp[]" style="width: 100px;"><input type="hidden" style="width: 100px;" name="retail[]" id="retail'+k+'"><input type="hidden" style="width: 100px;" name="wholesale[]" id="wholesale'+k+'"><input type="text" class="form-control" placeholder="No." name="no[]" id="no'+m+'" value="'+m+'" style="width:45px;"></td><td><input type="hidden" name="prodid[]" id="prodid'+k+'"><input type="text" onClick="addprice('+k+')" onKeyPress="productcodesearch('+k+')" onBlur="addproductdetais(this.value, '+k+')" name="productcode[]" onkeydown="if (event.keyCode === 13 || event.keyCode === 9){if(this.value==\'\'){}else{$(\'#vatper'+k+'\').focus();}" autocomplete="off" class="form-control" name="productcode[]" id="productcode'+k+'" style="width:100px;" placeholder="Code"></td> <td><input type="text" autocomplete="off" class="form-control" onKeyPress="productsearch('+k+')" onkeydown="if (event.keyCode == 13 || event.keyCode == 9){$(\'#vatper'+k+'\').focus();}" onBlur="addproductdetais_name(this.value,'+k+')" name="productmlname[]" id="productmlname'+k+'" style="width:200px;"placeholder="Product Name"></td><td style="display:none;"><input type="text" class="form-control" readonly placeholder="HSN" name="hsn[]" id="hsn'+k+'" style="width:90px;"></td><td><input type="text" class="form-control" placeholder="Purchase Price"  id="saleprice'+k+'" onKeyUp="calculatetotal('+k+')" style="width:70px;"></td><td style="display:none;"><input type="number" step="any" readonly placeholder="Unit Price" style="width:100px;" class="form-control" onKeyUp="calculatetotal('+k+')" name="purchaseprice[]" id="unitprice'+k+'"></td><td><input type="number" step="any" placeholder="Gst %" style="width:50px;" class="form-control" name="vatper[]" id="vatper'+k+'"></td><td><input type="number" class="form-control" step="any" onChange="calculatetotal('+k+')" onKeyUp="calculatetotal('+k+')" name="qty[]" id="qty'+k+'" placeholder="Qty" style="width:60px;">Avail Stock: <span id="availableqty'+k+'"></span></td><td><input type="number" step="any" style="width:50px;" class="form-control" onChange="calcdisc(this.value,'+k+')" onkeydown="if (event.keyCode === 9){$(\'#no'+(m+1)+'\').focus();}"  name="discounti[]" id="discount'+k+'"><input type="hidden" name="prediscount[]" id="prediscount'+k+'"></td><td><input type="hidden" name="prenetamnt[]" id="prenetamnt'+k+'"><input type="text" class="form-control" readonly placeholder="Net amount" name="netamnt[]" id="netamnt'+k+'" style="width:70px;"></td><td style=" display:none;"><input type="text" class="form-control" readonly placeholder="Unit" name="unittype[]" id="unittype'+k+'" style="width:70px;"></td><td><input type="text" class="form-control" readonly placeholder="Vat amount" name="vatamnt[]" id="vatamnt'+k+'" style="width:70px;"></td><td><input readonly type="text" class="form-control" placeholder="Total" name="total[]" id="total'+k+'" style="width:100px;"><input type="hidden" class="form-control" name="pretotal[]" id="pretotal'+k+'" style="width:100px;"></td><td><input type="text" class="form-control" readonly placeholder="PR Rate"  id="prrate'+k+'" style="width:60px;"></td><td><div class="btn-group" role="group"><a href="#" data-toggle="tooltip" data-placement="bottom" title="" onclick="removeproduct('+k+')" class="btn btn-default btn-sm m-user-delete" data-original-title="Remove Product"><i class="fa fa-times" aria-hidden="true"></i></a></div></td></tr>';
	$('#cartitems').append(fields);
	k = k+1;
	m=m+1;
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
				//$('#jjj').val(data[0]);
				//$('#customer1').val(data[1]);
				//$('#productmlname'+data[8]).val(data[2]);
				//$('#productcode'+data[8]).prop('readonly',true);
				//$('#productmlname'+data[8]).prop('readonly',true);
				//$('#bottleprice'+data[8]).val(data[3]);
				//$('#address').val(data[2]);
				//$('#oldbalance').val(data[2]);
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
	//$('#hsn'+num).val(hsn);
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
		//var tt=Number(tot)+Number(oldbal);
		var tt=Number(tot);
		tt= Math.round(tt);
		$('#gtotalprice').val(Number(tt));
		$('#paidamount').val(Number(tt));
		//$('#balance').val(Number(-tt));
		var total1=tot.toFixed(2);
	}
	else{
		var total = Number($('#totalprice').val())+Number(tot);
		$('#totalprice').val(total.toFixed(2));
		total=Math.round(total);
		$('#gtotalprice').val(Number(total));
		$('#paidamount').val(Number(total));
		//$('#balance').val(Number(-total));
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
	//$('#hsn'+num).val(hsn);
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
		//$('#balance').val(Number(-tt));
		var total1=tot.toFixed(2);
	}
	else{
		var total = Number($('#totalprice').val())+Number(tot);
		$('#totalprice').val(total.toFixed(2));
		total=Math.round(total);
		$('#gtotalprice').val(Number(total));
		$('#paidamount').val(Number(total));
		//$('#balance').val(Number(-total));
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
		//$('#balance').val(Math.round(-newgtotal));
		$('table#drgcartitms tr#tr'+num).remove();
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
		$('#gtotalprice').val(gtotal.toFixed(2));
		$('#paidamount').val(gtotal.toFixed(2));
		//$('#balance').val(-gtotal.toFixed(2));
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
	$('#total'+num).val(Math.round(newtotal.toFixed(2)));
	$('#pretotal'+num).val(newtotal.toFixed(2));
	
	var pr =Number(newtotal) / Number(qty);
	$('#prrate'+num).val(Math.round(pr));
	$('#totalprice').val(Math.round(newtotalprice.toFixed(2)));
	$('#gtotalprice').val(Math.round(newgtotal));
	$('#paidamount').val(Math.round(newgtotal));
	//$('#balance').val(Math.round(-newgtotal));
	
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
	$('#balance').val(Math.round(-newgtotal));
		
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
			document.getElementById('show1').style.display="table-row";
			document.getElementById('normal').style.display="none";
			}
			else
			{
				document.getElementById('customer1').value='';
				document.getElementById('customerid').value='';
				document.getElementById('tin_number').value='';
				document.getElementById('normal').style.display="block";
				document.getElementById('show').style.display="none";
				document.getElementById('show1').style.display="none";
				document.getElementById('oldbalance').value=0;
			}
	}

		
	
		
		</script>
        
    </body>

</html>
<?php
}else{
	header("Location:../index.php");
}
?>