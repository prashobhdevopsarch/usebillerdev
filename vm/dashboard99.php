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
		$paidamount = $_POST['paidamount'];
		$curdate = date('Y-m-d H:i:s');
		
		$vehicle_number=$_POST["vehicle_number"];
		$tin_number=$_POST["tin_number"];
		
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
		
		
		$sql="INSERT INTO vm_billentry(be_billnumber,be_customerid, be_customername, be_customermobile, be_customer_tin_num, be_billdate, be_total, be_paidamount, be_updateddate, be_discount, be_mode, user_id, be_vehicle_number, be_coolie, be_gtotal, be_oldbal, be_balance, be_statecode) VALUES('$billno','$customer', '$customername', '$phone', '$tin_number', '$billdate', '$totalprice', '$paidamount', '$curdate', '$discount','sales','".$_SESSION["admin"]."','$vehicle_number', '$coolie', '$gtotalprice', '$oldbalance', '$balance','$supplyplace')";
		//$sql1="INSERT INTO vm_customer (cs_customerid ,user_id) VALUES ('$customer','".$_SESSION["admin"]."') WHERE $be_billid=$customer";  
		//echo $sql;
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
					if($customer!='')
					{
						$slct_price=$conn->query("SELECT * FROM vm_customeritemprice WHERE cp_customer_id='$customer' AND cp_itemid='$prdval'");
						if($slct_price->num_rows>0)
						{
							$rowitmprice=$slct_price->fetch_assoc();
							$update=$conn->query("UPDATE vm_customeritemprice SET  WHERE cp_itemid='$prdval'");
						}
					}
					$insrtitms = $conn->query("INSERT INTO vm_billitems(bi_billid, bi_productid, bi_price, bi_quantity, bi_discount,bi_vatamount,bi_vatper, bi_total, bi_updatedon, bi_sgst, bi_sgst_amt, bi_cgst, bi_cgst_amt, bi_igst, bi_igst_amt, user_id, bi_taxamount) VALUES('$bill_id', '$prdval', '$saleprice[$n]', '$qty[$n]', '$discounti[$n]', '$vatamnt[$n]','$vatper[$n]','$total[$n]', '$curdate', '$sgst_p', '$sgst_a','$cgst_p','$cgst_a','$igst_p','$igst_a','".$_SESSION["admin"]."','$netamnt[$n]')");
					$stcs = $conn->query("SELECT pr_stock FROM vm_products WHERE pr_productid='$prdval'");
					$row = $stcs->fetch_assoc();
					$nwstock = $row['pr_stock'] - $qty[$n];
					$update = $conn->query("UPDATE vm_products SET pr_stock='$nwstock' WHERE pr_productid='$prdval'");
				}
				$n++;
			}
			
			if($insrtitms)
			{
				$insert=$conn->query("insert into vm_transaction(tr_particulars,tr_openingbalance,tr_transactionamount,tr_closingbalance,tr_date,tr_transactiontype,tr_billid,user_id,pay_type,cus_id) values('$particulars','$openingbalence','$amount','$closingbalance','$datetime','$transactiontype','$bill_id','".$_SESSION["admin"]."','Sales','$customer')");
				   
				if($insert)
				{
					
				
					if($customer!='')
				{
					//echo print_r($_POST);
					$slct_cus=$conn->query("SELECT cs_balance FROM vm_customer WHERE cs_customerid= '$customer'");
					$row_cus=$slct_cus->fetch_assoc();
					$prebal=$row_cus["cs_balance"];
					$bill_ball=$balance;
					$balance=$prebal+$balance;
					
					$update1 = $conn->query("UPDATE vm_customer SET  cs_balance='$balance'  WHERE cs_customerid= '$customer'");
					$slct=$conn->query("SELECT acc_name FROM vm_customer LEFT JOIN administrator_account_name ON refid=cs_acntid WHERE cs_customerid = '$customer'");
					$rowacnt=$slct->fetch_assoc();
					$acntname=$rowacnt["acc_name"];
					
					$insert_acnt=$conn->query("INSERT INTO administrator_daybook(ad_branchid, dayBookDate, debit, credit, dayBookContra, dayBookAmount, description, backup) VALUE('".$_SESSION["admin"]."','$date','CASH','$acntname','Y','$paidamount','SALES','')");
					$acntid1=$conn->insert_id;
					$update1=$conn->query("UPDATE vm_billentry SET be_creditid='$acntid1' WHERE be_billid ='$bill_id'");
					if($bill_ball!=0)
					{
					$insert_acnt=$conn->query("INSERT INTO administrator_daybook(ad_branchid, dayBookDate, debit, credit, dayBookContra, dayBookAmount, description, backup) VALUE('".$_SESSION["admin"]."','$date','$acntname','SALES','Y','$bill_ball','CREDIT SALES','')");
					$acntid2=$conn->insert_id;
					$update2=$conn->query("UPDATE vm_billentry SET be_debitid='$acntid2' WHERE be_billid ='$bill_id'");
					}
				}else{
				$insert_acnt=$conn->query("INSERT INTO administrator_daybook(ad_branchid, dayBookDate, debit, credit, dayBookContra, dayBookAmount, description, backup) VALUE('".$_SESSION["admin"]."','$date','CASH','SALES','Y','$gtotalprice','CASH SALES','')");
				$acntid2=$conn->insert_id;
				$update2=$conn->query("UPDATE vm_billentry SET be_debitid='$acntid2' WHERE be_billid ='$bill_id'");
				}
				switch($billtype)
				{
					case 1: header("location:bill_print.php?billid=$bill_id&csid=".$customer);break;
					case 2: header("location:bill_print_cus.php?billid=$bill_id&csid=".$customer);break;
					case 3: header("location:bill_print_cus1.php?billid=$bill_id&csid=".$customer);break;
				}
				}else{
					header('Location: dashboard.php?er=error1');
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
       
        
        <!--<link href="assets/plugins/metrojs/MetroJs.min.css" rel="stylesheet" type="text/css"/>	
        <link href="assets/plugins/toastr/toastr.min.css" rel="stylesheet" type="text/css"/>-->	
	
        	<link rel="stylesheet" href="includes/auto/jquery-ui.css">
<script src="includes/auto/jquery-1.js"></script>
<script src="includes/auto/jquery-ui.js"></script>
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
                    <h3><strong>Billing (<?= date('d-M-Y') ?>)</strong></h3>
                    <div class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="active">Billing</li>
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
					$stocks = $conn->query("SELECT * FROM vm_billentry WHERE user_id='".$_SESSION["admin"]."' ORDER BY be_billid DESC LIMIT 1");
					if(mysqli_num_rows($stocks)>0)
					{
						$row = $stocks->fetch_assoc();
						$billno = $row['be_billnumber'] + 1;
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
                                    <h4 class="panel-title">Billing</h4>
                                    <a href="dashboard.php?billno=<?= $billno+1 ?>" target="_blank"><button type="button" class="btn btn-primary btn-addon m-b-sm" style="float:right"><i class="fa fa-plus"></i> Another Bill</button></a>
									<a href="javascript:window.open('addstocks.php','mywindowtitle','width=1200,height=400')" ><button type="button"  class="btn btn-primary btn-addon m-b-sm" style="float: right;margin-right:13px;"><i class="fa fa-plus"></i>New Product OR F2</button></a>
                                    <a href="javascript:window.open('customer.php','mywindowtitle','width=500,height=800')" ><button type="button"  class="btn btn-primary btn-addon m-b-sm" style="float: right;margin-right:13px;"><i class="fa fa-plus"></i>New Customer OR F4</button></a>
                                </div>
                                <?php
								if(isset($_GET['id']))
								{
									?>
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">??</span></button>
                                        Bill saved successfully.
                                    </div>
                                    <?php
								}
								if(isset($_GET['er']))
								{
									
									?>
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">??</span></button>
										
                                        Error occured, please try again.
                                    </div>
                                    <?php
								}
								?>
                                <div class="panel-body">
                                    <div class="project-stats">  
                                       <form class="form-horizontal" name="addbilldetails" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
                                       <div class="table-responsive">
                                       <input type="hidden" name="billno" id="billno" value="<?= $billno ?>">
                                       <table class="table">
                                       	<tr>
                                        	<td>
                                            Bill No: <input type="text" name="billno" id="billno" value="<?= $billno ?>" style="width:60px;" ><br><br>
											
                                            <label for="customercheck"> <b>Already existing customer?</b>
                                            <input type="checkbox"  class="form-control" name="customercheck" id="customercheck"  ></label>
                                            <div id="show" style="display: none;">
                                            <br>
											
											 <input type="hidden" id="customerid" name="customerid" >
                                             <input type="text" class="form-control"onKeyUp="customersearch(this.value)" id="customer1" autocomplete="off" name="customername1[]" style="width: 220px; display: inline;" placeholder="Customer Name" onKeyPress="autocus()" onBlur="addcus(this.value)"> <br> 
                                           

											
                                            
                                            
											</div>
                                            <div id="normal">
											
                                           <br> <input type="text" class="form-control" name="customername" style="width: 220px; display: inline;" id="customername" placeholder="Customer Name"> &nbsp; 
                                            <input type="text" class="form-control" name="phone" style="width: 220px; display: inline;" id="phone" placeholder="Phone Number">
											</div>
											
                                            <input type="text" class="form-control" name="vehicle_number" style="width: 220px; display: inline;margin-top: 15px;" id="vehicle_number" placeholder="Vehicle Number">
											<input type="text" class="form-control" name="tin_number" style="width: 220px; display: inline;margin-top: 15px; margin-left:10px;" id="tin_number" placeholder="GSTIN">
                                            <select class="form-control" id="supplyplace" name="supplyplace" style="width: 220px; display: inline;" >
                                            		<option value="">- Select place of supply</option>
                                                	<option value="AN">Andaman and Nicobar Islands </option>
                                                    <option value="AP">Andhra Pradesh</option>
                                                    <option value="AD">Andhra Pradesh (New)</option>
                                                    <option value="AR">Arunachal Pradesh</option>
                                                    <option value="AS">Assam</option>
                                                    <option value="BH">Bihar</option>
                                                    <option value="CH">Chandigarh</option>
                                                    <option value="CT">Chattisgarh</option>
                                                    <option value="DN">Dadra and Nagar Haveli</option>
                                                    <option value="DD">Daman and Diu</option>
                                                        <option value="DL">Delhi</option>
                                                    <option value="GA">Goa</option>
                                                    <option value="GJ">Gujarat</option>
                                                    <option  value="HR">Haryana</option>
                                                    <option value="HP">Himachal Pradesh</option>
                                                    <option value="JK">Jammu and Kashmir</option>
                                                    <option value="JH">Jharkhand</option>
                                                    <option value="KA">Karnataka</option>
                                                    <option value="KL">Kerala</option>
                                                        <option value="LD">Lakshadweep Islands</option>
                                                    <option value="MP">Madhya Pradesh</option>
                                                    <option value="MH">Maharashtra</option>
                                                    <option value="MN">Manipur</option>
                                                    <option value="ME">Meghalaya</option>
                                                    <option value="MI">Mizoram</option>
                                                    <option value="NL">Nagaland</option>
                                                        <option value="OR">Odisha</option>
                                                    <option value="PY">Pondicherry</option>
                                                    <option value="PB">Punjab</option>
                                                    <option value="RJ">Rajasthan</option>
                                                    <option value="SK">Sikkim</option>
                                                    <option value="TN">Tamil Nadu</option>
                                                    <option value="TS">Telangana</option>
                                                    <option value="TR">Tripura</option>
                                                    <option value="UP">Uttar Pradesh</option>
                                                        <option value="UT">Uttarakhand</option>
                                                    <option value="WB">West Bengal</option>
                                            </select>
											<select class="form-control" id="billmode" name="billmode" style="width: 220px; display: inline;">
											<option value="retail">Retail</option>
											<option value="whole">Whole Sale</option>
											<!--<option value="mrp">MRP</option>-->
											</select>
											<td>
                                            <td align="right"><input type="date" class="form-control" style="width: 155px; display: inline;" name="date" id="date" value="<?= date('Y-m-d') ?>"> &nbsp; 
                                            <input type="time" class="form-control" style="width: 120px; display: inline;" name="time" id="time" value="<?= date('H:i') ?>">
											
											</td>
                                        </tr>
                                       </table>
                                       <div style="max-height: 200px;overflow: scroll;">
                                    <table class="table" id="drgcartitms">
                                    <thead>
                                    <tr>
                                    	<th>Sl No.</th>
                                        <th>Product id</th>
                                        <th>Product Name</th>
                                        <th>Unit Price</th>
                                        <th>GST %</th>
                                        <th>Qty</th>
                                        <th>Discount %</th>
										<!--<th>Unit</th>-->
                                        <th>Net Amount</th>
                                        <th>GST</th> 
                                        <th>Total</th>                
                                        <th></th>
                                    </tr>
                                    </thead>
                                    
                                    <tbody><?php
										$k=1;
										//for($k=1; $k<4; $k++)
										//{
										?>
										<tr style="border-bottom:1px #EEE solid;" id="tr<?= $k ?>">
										<td><input type="text" class="form-control" placeholder="No." name="no[]" id="no<?= $k ?>" value="<?=$k?>" style="width:45px;"></td>
										<td>
                                        <input type="hidden" name="prodid[]" id="prodid<?= $k ?>">
											<input type="text" autocomplete="off" class="form-control" onKeyPress="productcodesearch(<?= $k ?>)" name="productcode[]" id="productcode<?= $k ?>" style="width:70px;" placeholder="Code" onkeydown="if (event.keyCode === 13 || event.keyCode === 9){$('#vatper<?= $k ?>').focus();}" onBlur="addproductdetais(this.value, <?= $k ?>)">
                                            
										</td>
                                        <td><input type="text" onKeyPress="productsearch(<?= $k ?>)" onkeydown="if (event.keyCode == 13 || event.keyCode == 9){$('#vatper<?= $k ?>').focus();}" onBlur="addproductdetais_name(this.value, <?= $k ?>)" autocomplete="off" class="form-control" name="productmlname[]" id="productmlname<?= $k ?>" style="width:200px;" placeholder="Product Name"></td>
										
                                        <td><input type="text" class="form-control" placeholder="Sale Price" name="saleprice[]" id="saleprice<?= $k ?>" onKeyUp="calculatetotal(<?= $k ?>)" style="width:100px;"></td>
                                        <td>
                                        <input type="text" placeholder="GST %" style="width:60px;" class="form-control" name="vatper[]" id="vatper<?= $k ?>"></td>
										<td><input type="number" step="any" class="form-control" name="qty[]" onChange="calculatetotal(<?= $k ?>),sub_stock(this.value,<?=$k?>)" onKeyUp="calculatetotal(<?= $k ?>),sub_stock(this.value,<?=$k?>)" id="qty<?= $k ?>" placeholder="Qty" style="width:90px;">
                                       Avail Stock: <span id="availableqty<?= $k ?>"></span> Balance: <span id="bal<?=$k?>"></span>
                                        </td>
                                        <td><input type="text" style="width:60px;" class="form-control" onChange="calcdisc(this.value,<?= $k ?>)" onkeydown="if (event.keyCode === 9){$('#no <?= $k+ 1 ?>').focus();}" name="discounti[]" id="discount<?= $k ?>"><input type="hidden" name="prediscount[]" id="prediscount<?= $k ?>"></td>
                                        </td>
										<td style="display:none;">
										<input type="text" class="form-control" readonly placeholder="Unit" name="unittype[]" id="unittype<?= $k ?>" style="width:70px;">
										</td>
                                        <td>
                                        <input type="hidden" name="prenetamnt[]" id="prenetamnt<?= $k ?>">
                                        <input type="text" class="form-control" readonly placeholder="Net amount" name="netamnt[]" id="netamnt<?= $k ?>" style="width:100px;"></td>
										
                                        <td>
                                        <input type="text" class="form-control" readonly placeholder="GST" name="vatamnt[]" id="vatamnt<?= $k ?>" style="width:70px;"></td>
										<td>
                                        	<input readonly type="text" class="form-control" placeholder="Total" name="total[]" id="total<?= $k ?>" style="width:100px;">
                                            
                                            <input type="hidden" class="form-control" name="pretotal[]" id="pretotal<?= $k ?>" style="width:100px;">
                                            
                                            
                                        </td>
										<td>
										<a href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" title="" onclick="removeproduct(<?= $k ?>)" class="btn btn-default btn-sm m-user-delete" data-original-title="Remove Product"><div class="btn-group" role="group">
													<i class="fa fa-times" aria-hidden="true"></i>
										  </div></a>
                                          
										</td>
										</tr>
										<?php
										//}
										?>
                                        
									</tbody>
									<tbody id="cartitems">
									</tbody>
                                    </table>
                                    </div>
                                    <table class="table">
									<tr>
                                        <td align="right">Discount:</td>
                                        <td width="150"><input type="text" readonly class="form-control" name="discount" id="discount" placeholder="Discount" value="0" onKeyUp="calculatedicounttotal(1)" style="width:120px;">
                                        
                                        </td>
                                        
                                        <a style="float:right" href="javascript:void(0)" onClick="addproductfields()">add  <span class="glyphicon glyphicon-plus"></span></a>
                                        <td align="right">Total Amount:</td>
                                        <td width="150"><input type="text" readonly class="form-control" name="totalprice" id="totalprice" placeholder="Total Amount" style="width:120px;">
                                        
                                        </td>
                                        </tr>
                                        
										<tr>
                                        <td style=" font-stretch:expanded;" align="right">Freight:</td>
                                        <td width="150"><input type="text" value="0" class="form-control" name="coolie" id="coolie" onKeyUp="calculatedicounttotal(3)"   placeholder="Coolie" style="width:120px;">
                                        
                                        </td>
                                        </tr>
										
                                       
										<!--<tr id="show1" style="display:none;">
										 
												<td   align="right">Old Balance</td>
												<td style="width:150px;"><input type="text" readonly class="form-control" value="0" name="oldbalance" id="oldbalance" placeholder="Old Balance" style="width:120px;">
                                        
											</td>
																					 
										</tr> -->
										<tr>
											<td align="right">Grant Total:</td>
											<td width="150"><input type="text" readonly class="form-control" name="gtotalprice" id="gtotalprice" placeholder="Grant Total" style="width:120px;">
                                        
											</td>
										
										
                                        
                                        <td align="right">Paid Amount:</td>
                                        <td width="150"><input type="text" class="form-control" name="paidamount" id="paidamount" onKeyUp="calculatedicounttotal(2)" placeholder="Paid Amount" required style="width:120px;">
                                        
                                        </td>
                                        </tr>
										
										<tr>
                                        <td align="right">Balance Amount:</td>
                                        <td width="150"><input type="text" readonly class="form-control" value="0" name="balance" id="balance" placeholder="Balance" required style="width:120px;">
                                        
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
                                        <button type="submit" name="submit" class="btn btn-primary">Save & Print</button>
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
        <!--<script src="assets/js/pages/dashboard.js"></script>
        <script src="assets/js/pages/form-elements.js"></script>-->
        <?php
		include("includes/footerfiles.php");
		?>
        
        
        
        <script>
/*function productsearch(srchky, num)
{
	
	if(srchky == "")
	{
		document.getElementById('results'+num).style.display='none';
	}
	else{
		
		$.ajax({
			url : "searchproducts.php",
			type: "POST",
			data : {key : srchky, number:num},
			success: function(data, textStatus, jqXHR)
			{
				$('#serchreslt'+num).html(data);
			},
			
		});
		//document.getElementsByClassName('secol').style.display='none';
		document.getElementById('results'+num).style.display='inline';
	}
	
}
function productcodesearch(srchky, num)
{
	if(srchky == "")
	{
		document.getElementById('results'+num).style.display='none';
	}
	else{
		
		$.ajax({
			url : "searchproductcode.php",
			type: "POST",
			data : {key : srchky, number:num},
			success: function(data, textStatus, jqXHR)
			{
				$('#serchreslt'+num).html(data);
			},
			
		});
		//document.getElementsByClassName('secol').style.display='none';
		document.getElementById('results'+num).style.display='inline';
	}
}*/

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
      source: "cusautocomplete.php"
    });
});
}

		
		var k=2;
function addproductfields()	
{
	var fields = '<tr style="border-bottom:1px #EEE solid;" id="tr'+k+'"><td><input type="text" class="form-control" placeholder="No." name="no[]" id="no'+k+'" value="'+k+'" style="width:45px;"></td><td><input type="hidden" name="prodid[]" id="prodid'+k+'"><input type="text" autocomplete="off" class="form-control" onKeyPress="productcodesearch('+k+')" name="productcode[]" id="productcode'+k+'" style="width:70px;" placeholder="Code" onkeydown="if (event.keyCode == 13 || event.keyCode == 9){$(\'#vatper'+k+'\').focus();}" onBlur="addproductdetais(this.value,'+k+')"></td><td><input type="text" onKeyPress="productsearch('+k+')" onkeydown="if (event.keyCode == 13 || event.keyCode == 9){$(\'#vatper'+k+'\').focus();}" onBlur="addproductdetais_name(this.value, '+k+')" autocomplete="off" class="form-control" name="productmlname[]" id="productmlname'+k+'" style="width:200px;" placeholder="Product Name"></td><td><input type="text" class="form-control" onKeyUp="calculatetotal('+k+')" placeholder="Sale Price" name="saleprice[]" id="saleprice'+k+'" style="width:100px;"></td><td><input type="text" placeholder="GST %" style="width:60px;" class="form-control" name="vatper[]" id="vatper'+k+'"></td><td><input type="number" class="form-control" step="any" onChange="calculatetotal('+k+'),sub_stock(this.value,'+k+')" onKeyUp="calculatetotal('+k+'),sub_stock(this.value,'+k+')" name="qty[]" id="qty'+k+'" placeholder="Qty" style="width:100px;">Avail Stock: <span id="availableqty'+k+'"></span>Balance: <span id="bal'+k+'"></span></td><td><input type="text" style="width:60px;" class="form-control" onChange="calcdisc(this.value,'+k+')" name="discounti[]" id="discount'+k+'"><input type="hidden" name="prediscount[]" id="prediscount'+k+'"></td><td style="display:none;"><input type="text" class="form-control" readonly placeholder="Unit" name="unittype[]" id="unittype'+k+'" style="width:70px;"></td><td><input type="hidden" name="prenetamnt[]" id="prenetamnt'+k+'"><input type="text" class="form-control" readonly placeholder="Net amount" name="netamnt[]" id="netamnt'+k+'" style="width:100px;"></td><td><input type="text" class="form-control" readonly placeholder="GST" name="vatamnt[]" id="vatamnt'+k+'" style="width:70px;"></td><td><input readonly type="text" class="form-control" placeholder="Total" name="total[]" id="total'+k+'" style="width:100px;"><input type="hidden" class="form-control" name="pretotal[]" id="pretotal'+k+'" style="width:100px;"></td><td><div class="btn-group" role="group"><a href="#" data-toggle="tooltip" data-placement="bottom" title="" onclick="removeproduct('+k+')" class="btn btn-default btn-sm m-user-delete" data-original-title="Remove Product"><i class="fa fa-times" aria-hidden="true"></i></a></div></td></tr>';
	$('#cartitems').append(fields);
	k = k+1;
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
			data : {key : srchky},
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
				var retail=data[4];
				var wholesale=data[10];
				
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
	$('#unittype'+num).val(unit);
	var vtamnt = (Number(vat)/(Number(vat)+100))*Number(saleprice);
	//var vtamnt = (Number(vat)/100)*Number(saleprice);
	//var product_prive =(Number(saleprice) - Number(vtamnt)).toFixed(2);
	var product_prive =(Number(saleprice) - Number(vtamnt)).toFixed(2);
	$('#saleprice'+num).val(saleprice);
	$('#netamnt'+num).val(product_prive);
	$('#prenetamnt'+num).val(product_prive);
	var tot = Number(saleprice);
	$('#total'+num).val(Math.round(tot));
	$('#vatamnt'+num).val(vtamnt.toFixed(2));
	
	if($('#totalprice').val() == "")
	{
		$('#totalprice').val(Math.round(tot));
		//var tt=Number(tot)+Number(oldbal);
		var tt=Number(tot);
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
	
	addproductfields();
	
	document.getElementById('results'+num).style.display='none';
	
		
	}
			else{
		alert("Product already selected.");
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
	$('#netamnt'+num).val(product_prive);
	$('#prenetamnt'+num).val(product_prive);
	var tot = Number(saleprice);
	$('#total'+num).val(Math.round(tot));
	$('#vatamnt'+num).val(vtamnt.toFixed(2));
	
	if($('#totalprice').val() == "")
	{
		$('#totalprice').val(Math.round(tot));
		//var tt=Number(tot)+Number(oldbal);
		var tt=Number(tot);
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
	
	addproductfields();
	
	document.getElementById('results'+num).style.display='none';
	
		
	
		
	}
			else{
		alert("Product already selected.");
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
		$('#gtotalprice').val(Math.round(newgtotal))
		//$('#discount').val(0);
		$('#paidamount').val(Math.round(newgtotal));
		$('table#drgcartitms tr#tr'+num).remove();
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
	var balance=$('#balance').val();
	var coolie=$('#coolie').val();
	var ototal=$('#oldbalance').val();
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
		var vtamnt =(Number(vat)/(Number(vat)+100))*Number(prce);
		var ttl_vat = Number(vtamnt)*Number(qty);
		var netamnt = Number(qty)*(Number(prce)-Number(vtamnt));
		var total = Number(qty)*(Number(prce));
		var total = Math.round(total);
		var totamnt = Number(total.toFixed(2));
				
		var lastotal = Number(minustotal) + Number(totamnt);
		$('#vatamnt'+num).val(ttl_vat.toFixed(2))
		$('#totalprice').val(Math.round(lastotal));
		$('#total'+num).val(Math.round(totamnt));
		//$('#prenetamnt'+num).val(netamnt);
		$('#netamnt'+num).val(netamnt.toFixed(2));
		$('#discount'+num).val('');
		$('#prediscount'+num).val('');
		$('#pretotal'+num).val(totamnt);
		
		//var gtotal = Number(lastotal) + Number(coolie) + Number(ototal);
		var gtotal = Number(lastotal) + Number(coolie);
		$('#gtotalprice').val(Math.round(gtotal));
		$('#paidamount').val(Math.round(gtotal));
		$('#discount').val(discount12.toFixed(2));
	}
}
function calcdisc(disc,num)
{
	disc=Number(disc);
	
	var predisc=$('#prediscount'+num).val();
	var prenetamnt=$('#netamnt'+num).val();
	
	disc=(disc/100)*prenetamnt;
	//predisc=(predisc/100)*prenetamnt;
	
	//prenetamnt=Number(prenetamnt)+Number(predisc);
	
	var tdisc = $('#discount').val();
	var olddisc = Number(tdisc)-Number(predisc);
	newtdisc = olddisc+Number(disc);
	var taxp=$('#vatper'+num).val();
	
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
	$('#totalprice').val(Math.round(newtotalprice.toFixed(2)));
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





function checkUsername()
{
  var username = document.getElementById('customer1');
  var message = document.getElementById('confirmUsername');
  
  /*This is just to see how it works, remove this lines*/
  //message.innerHTML = username.value;
  //document.getElementById("submit").disabled = true;  
  /*********************************************/

 $.ajax({ 
    url : "check_username.php",// your username checker url
    type : "POST",
    data : {username: customer1},        
    success:  function (response) {						
        if (response==0)
        {
              message.innerHTML = "Valid Username";
              document.getElementById("submit").disabled = false;		
	}
	if (response==1)
	{
              message.innerHTML = "Already Used";
              document.getElementById("submit").disabled = true;	
   	}
					
							
     }
 });					
}
</script>
		
		</script>
        
    </body>

</html>
<?php
}else{
	header("Location:../index.php");
}
?>