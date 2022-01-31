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
		$saleprice= $_POST['purchaseprice'];
		$qty= $_POST['qty'];
		$vatamnt = $_POST['vatamnt'];
		$vatper = $_POST['vatper'];
		$total= $_POST['total'];
		$balance=$_POST['balance'];
		//$customer1=$_POST['customername1'];
		//$customercheck=$_POST['customercheck'];
		//$customer=$_POST['customerid'];
		$billtype=$_POST["billtype"];
		
		$coolie=$_POST["coolie"];
		$oldbalance=$_POST["oldbalance"];
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
		
		
		$sql="INSERT INTO vm_purreturnentry(pre_billnumber, pre_customerid, pre_customername, pre_customermobile, pre_customer_tin_num, pre_billdate, pre_total, pre_paidamount, pre_updateddate, pre_discount, pre_mode, user_id, pre_vehicle_number, pre_coolie, pre_gtotal, pre_oldbal, pre_balance, pre_invoice_number, pre_invoice_date, pre_rebill,pre_statecode) VALUES('$billno','$customerid', '$customername', '$phone', '$tin_number', '$billdate', '$totalprice', '$paidamount', '$curdate', '$discount', 'purchasereturn', '".$_SESSION["admin"]."','$vehicle_number', '$coolie', '$gtotalprice', '$oldbalance', '$balance', '$invoice_number', '$invoice_date', '$rebill','$stateid')";
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
					$updatesup = $conn->query("UPDATE vm_supplier SET rs_balance='$balance' WHERE rs_supplierid='$customerid'");
				}
				$n++;
			}
			
			if($insrtitms)
			{
				$insert=$conn->query("insert into vm_transaction(tr_particulars,tr_openingbalance,tr_transactionamount,tr_closingbalance,tr_date,tr_transactiontype,tr_billid,user_id)
                   values('$particulars',' $openingbalence','$amount','$closingbalance','$datetime','$transactiontype','$bill_id','".$_SESSION["admin"]."')");
				   
				if($insert)
				{
				
				
				switch($billtype)
				{
					case 1: header("location:purchasereturn_print.php?billid=$bill_id&csid=".$customer);break;
					//case 2: header("location:bill_print_cus.php?billid=$bill_id&csid=".$customer);break;
					//case 3: header("location:bill_print_cus1.php?billid=$bill_id&csid=".$customer);break;
				}
				
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
			
			header('Location: purchasereturn.php?er=error');
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
	

	</style>
    <!-- Styles -->
       
        
        <link href="assets/plugins/metrojs/MetroJs.min.css" rel="stylesheet" type="text/css"/>	
        <link href="assets/plugins/toastr/toastr.min.css" rel="stylesheet" type="text/css"/>	
	
        	
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
                    <h3><strong>പർച്ചേയ്‌സ് റിട്ടേൺ  (<?= date('d-M-Y') ?>)</strong></h3>
                    <div class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="active">ബില്ലിംഗ്</li>
							 <li class="active">പർച്ചേയ്‌സ് റിട്ടേൺ </li>
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
                                    <h4 class="panel-title">പർച്ചേയ്‌സ് റിട്ടേൺ</h4>
                                    <a href="purchasereturn.php?billno=<?= $billno+1 ?>" target="_blank"><button type="button" class="btn btn-primary btn-addon m-b-sm" style="float:right"><i class="fa fa-plus"></i> Another Bill</button></a>
                                </div>
                                <?php
								if(isset($_GET['id']))
								{
									?>
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
											ബിൽ സേവ്ഡ് സക്‌സെസ്സ്ഫുള്ളി.
                                    </div>
                                    <?php
								}
								if(isset($_GET['er']))
								{
									
									?>
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
										എറർ ഒക്യൂർഡ്, പ്ളീസ് ട്രൈ എഗൈൻ.
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
												ബിൽ നം: <?= $billno ?> &nbsp;&nbsp;
                                           
                                            
                                            <div id="show">
                                            <br>
											<input type="hidden" id="stateid" name="stateid" >
											 <input type="hidden" id="customerid" name="customerid" >
                                             <input type="text" class="form-control"onKeyUp="customersearch(this.value)" id="customer1" autocomplete="off" name="customername1" style="width: 220px; display: inline;" placeholder="സപ്ലയർ നെയിം" required> <br> <br> 
                                           
											<div id="result" class="secol" style="position: absolute; font-size: 12px; z-index: 999; width: 50%; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px; display: none;background-color: rgb(255, 255, 255);">
											<div class="secol" style="padding:5px;" id="searchresult">
                                            </div></div> 
											</div>
                                            
                                            <div class="margin-left">
                                             <input type="text" class="form-control" autocomplete="off" name="vehicle_number" style="width: 220px; display: inline;" placeholder="വെഹിക്കിൾ നമ്പർ"><br><br><input type="text" class="form-control" autocomplete="off" name="invoice_number" style="width: 220px; display: inline;" placeholder="ഇൻവോയ്‌സ്‌ നമ്പർ">&nbsp;&nbsp; <input type="date" class="form-control" autocomplete="off" name="invoice_date" style="width: 220px; display: inline;" placeholder="ഇൻവോയ്‌സ്‌ നമ്പർ">
                                             </div>
                                            </td>
											 <td align="right"><b>റിട്ടേൺ  ബിൽ  : </b><input type="text" required class="form-control" style="width: 90px; margin-left:5px; display: inline;" placeholder="റിട്ടേൺ  ബിൽ  " name="rebill" id="rebill">
					                        <input type="date" class="form-control" style="width: 155px; margin-left:8px; display: inline;" name="date"  id="date" value="<?= date('Y-m-d') ?>"> &nbsp; 
                                            <input type="time" class="form-control" style="width: 120px; display: inline;" name="time" id="time" value="<?= date('H:i') ?>"></td>
                                            
                                        </tr>
											
                                        
										
                                       </table>
                                       
                                    <table class="table" id="drgcartitms">
                                    <thead>
                                    <tr>
                                        <th>പ്രോഡക്റ്റ് ഐഡി</th>
                                        <th>പ്രോഡക്റ്റ് നെയിം</th>
                                        <th>എച് എസ് എൻ നമ്പർ</th>
                                        <th>പർച്ചേയ്‌സ് പ്രൈസ്</th>
										<th style="display:none;">യൂണിറ്റ് പ്രൈസ്</th>
                                        <th>ക്വാണ്ടിറ്റി</th>
										
										<th>ജിഎസ് ടിൻ %</th>
                                        <th style="display:none;">ജിഎസ് ടിൻ</th> 
                                        <th>ടോട്ടൽ</th>                
                                        <th></th>
                                    </tr>
                                    </thead>
                                    
                                    <tbody><?php
										$k=1;
										//for($k=1; $k<4; $k++)
										//{
										?>
										<tr style="border-bottom:1px #EEE solid;" id="tr<?= $k ?>">
										
										<td>
                                      <input type="hidden" name="prodid[]" id="prodid<?= $k ?>">
											<input type="text" autocomplete="off" class="form-control" onKeyUp="productcodesearch(this.value, <?= $k ?>)" name="productcode[]" id="productcode<?= $k ?>" style="width:100px;" placeholder="Code">
                                            <div id="results<?= $k ?>" class="secol" style="position: absolute; font-size: 12px; z-index: 999; width: 50%; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px; display: none; background-color: rgb(255, 255, 255);"><div class="secol" style="padding:5px;" id="serchreslt<?= $k ?>">
                                            </div></div>
										</td>
                                        <td><input type="text" onKeyUp="productsearch(this.value, <?= $k ?>)" autocomplete="off" class="form-control" name="productmlname[]" id="productmlname<?= $k ?>" placeholder="പ്രോഡക്റ്റ് നെയിം"></td>
                                        <td>
										<input type="text" class="form-control" readonly placeholder="എച് എസ് എൻ നമ്പർ" name="hsn[]" id="hsn<?= $k ?>" style="width:90px;">
										</td>
										
                                        <td><input type="text" class="form-control" placeholder="പർച്ചേയ്‌സ് പ്രൈസ്"  id="saleprice<?= $k ?>" onKeyUp="calculatetotal(<?= $k ?>)" style="width:112px;"></td>
										<td style="display:none;"><input type="text" readonly placeholder="യൂണിറ്റ് പ്രൈസ്" style="width:100px;" class="form-control" name="purchaseprice[]" id="unitprice<?= $k ?>"></td>
										<td><input type="number" step="any" class="form-control" name="qty[]" onChange="calculatetotal(<?= $k ?>)" onKeyUp="calculatetotal(<?= $k ?>)" id="qty<?= $k ?>" placeholder="ക്വാണ്ടിറ്റി" style="width:90px;">
											അവയിൽ സ്റ്റോക്ക്: <span id="availableqty<?= $k ?>"></span>
                                        </td>
										<!--<td>
										<input type="text" class="form-control" readonly placeholder="Unit" name="unittype[]" id="unittype<?= $k ?>" style="width:70px;">
										</td>-->
                                        <td>
										<input type="text" readonly placeholder="ജിഎസ് ടി %" style="width:60px;" class="form-control" name="vatper[]" id="vatper<?= $k ?>"></td>
                                        <td style="display:none;">
                                        <input type="text" class="form-control" readonly placeholder="ജിഎസ് ടി " name="vatamnt[]" id="vatamnt<?= $k ?>" style="width:100px;"></td>
										
										<td>
                                        	<input readonly type="text" class="form-control" placeholder="ടോട്ടൽ" name="total[]" id="total<?= $k ?>" style="width:100px;">
                                            
                                            <input type="hidden" class="form-control" name="pretotal[]" id="pretotal<?= $k ?>" style="width:100px;">
                                            
                                        </td>
										<td>
										<div class="btn-group" role="group">
													<a href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" title="" onclick="removeproduct(<?= $k ?>)" class="btn btn-default btn-sm m-user-delete" data-original-title="റിമൂവ്  പ്രോഡക്റ്റ്"><i class="fa fa-times" aria-hidden="true"></i></a>
										  </div>
										</td>
										</tr>
										<?php
										//}
										?>
									</tbody>
									<tbody id="cartitems">
									</tbody>
                                    </table>
                                    
                                    <table class="table">
                                    	<tr>
                                        <a style="float:right" href="javascript:void(0)" onClick="addproductfields()">ആഡ്  <span class="glyphicon glyphicon-plus"></span></a>
                                        <td align="right">ടോട്ടൽ എമൗണ്ട്:</td>
                                        <td width="150"><input type="text" readonly class="form-control" name="totalprice" id="totalprice" placeholder="ടോട്ടൽ എമൗണ്ട്" style="width:120px;">
                                        
                                        </td>
                                        </tr>
                                        <tr>
                                        <td align="right">ഡിസ്‌കൗണ്ട്:</td>
                                        <td width="150"><input type="text" class="form-control" name="discount" id="discount" placeholder="ഡിസ്‌കൗണ്ട്" value="0" onKeyUp="calculatedicounttotal(1)" style="width:120px;">
                                        
                                        </td>
                                        </tr>
										<tr>
                                        <td align="right">കൂലി</td>
                                        <td width="150"><input type="text" value="0" class="form-control" name="coolie" id="coolie" onKeyUp="calculatedicounttotal(3)"   placeholder="കൂലി" style="width:120px;">
                                        
                                        </td>
                                        </tr>
										 
										<tr>
											<td align="right">ഗ്രാൻറ് ടോട്ടൽ :</td>
											<td width="150"><input type="text" readonly class="form-control" name="gtotalprice" id="gtotalprice" placeholder="Grant Total" style="width:120px;">
                                        
											</td>
										</tr>
										
                                        
                                        <td align="right">പെയ്ഡ് എമൗണ്ട് :</td>
                                        <td width="150"><input type="text" class="form-control" name="paidamount" id="paidamount" onKeyUp="calculatedicounttotal(2)" placeholder="Paid Amount" required style="width:120px;">
                                        
                                        </td>
                                        </tr>
										<tr id="show1">
										 
												<td align="right">ഓൾഡ് ബാലൻസ്  :</td>
												<td style="width:150px;"><input type="text" readonly class="form-control" value="0" name="oldbalance" id="oldbalance" placeholder="ഓൾഡ് ബാലൻസ്" style="width:120px;">
                                        
											</td>
																					 
										</tr>
										<tr>
                                        <td align="right">ബാലൻസ് എമൗണ്ട്:</td>
                                        <td width="150"><input type="text" readonly class="form-control" value="0" name="balance" id="balance" placeholder="Balance" required style="width:120px;">
                                        
                                        </td>
                                        </tr>
                                        <tr>
                                        <td align="right">ബിൽ ടൈപ്പ്</td>
                                        <td width="150"><select class="form-control" name="billtype" id="billtype" required style="width:120px;">
                                        <option value="1">ടാക്‌സ് ഇൻവോയ്‌സ്‌</option>
										<!--<option value="2">Tax Invoice 8</option>-->
                                        <option value="3">കസ്റ്റമർ ഇൻവോയ്‌സ്‌</option>
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
        <script src="assets/js/pages/dashboard.js"></script>
        <script src="assets/js/pages/form-elements.js"></script>
        <?php
		include("includes/footerfiles.php");
		?>
        
        
        
        <script>
function productsearch(srchky, num)
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
}

function customersearch(str)
{
var xhttp;
if(str == "")
{
document.getElementById('result').style.display='none';
return;
}
xhttp = new XMLHttpRequest();
 xhttp.onreadystatechange = function() {
if (this.readyState == 4 && this.status == 200) {
 document.getElementById("searchresult").innerHTML = this.responseText;
 document.getElementById('result').style.display='inline';

 
}
 };
 xhttp.open("GET", "searchsupplier.php?key="+str, true);
 xhttp.send();

}

		
		var k=2;
function addproductfields()	
{
	var fields = '<tr style="border-bottom:1px #EEE solid;" id="tr'+k+'"><td><input type="hidden" name="prodid[]" id="prodid'+k+'"><input type="text" onKeyUp="productcodesearch(this.value, '+k+')" autocomplete="off" class="form-control" name="productcode[]" id="productcode'+k+'" style="width:100px;" placeholder="കോഡ് "><div id="results'+k+'" class="secol" style="position: absolute; font-size: 12px; z-index: 999; width: 50%; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px; display: none; background-color: rgb(255, 255, 255);"><div class="secol" style="padding:5px;" id="serchreslt'+k+'"></div></div></td> <td><input type="text" autocomplete="off" class="form-control" onKeyUp="productsearch(this.value, '+k+')" name="productmlname[]" id="productmlname'+k+'" placeholder="പ്രോഡക്റ്റ് നെയിം"></td><td><input type="text" class="form-control" placeholder="പർച്ചേയ്‌സ് പ്രൈസ്"  id="saleprice'+k+'" onKeyUp="calculatetotal('+k+')" style="width:112px;"></td><td style="display:none;"><input type="text" readonly placeholder="Unit Price" style="width:100px;" class="form-control" name="purchaseprice[]" id="unitprice'+k+'"></td><td><input type="number" class="form-control" step="any" onChange="calculatetotal('+k+')" onKeyUp="calculatetotal('+k+')" name="qty[]" id="qty'+k+'" placeholder="ക്വാണ്ടിറ്റി" style="width:100px;">Avail Stock: <span id="availableqty'+k+'"></span></td><td><input type="text" class="form-control" readonly placeholder="യൂണിറ്റ്" name="unittype[]" id="unittype'+k+'" style="width:70px;"></td><td><input type="text" readonly placeholder="ജിഎസ് ടിൻ%" style="width:60px;" class="form-control" name="vatper[]" id="vatper'+k+'"></td><td style="display:none;"><input type="text" class="form-control" readonly placeholder="ജിഎസ് ടി" name="vatamnt[]" id="vatamnt'+k+'" style="width:100px;"></td><td><input readonly type="text" class="form-control" placeholder="ടോട്ടൽ" name="total[]" id="total'+k+'" style="width:100px;"><input type="hidden" class="form-control" name="pretotal[]" id="pretotal'+k+'" style="width:100px;"></td><td><div class="btn-group" role="group"><a href="#" data-toggle="tooltip" data-placement="bottom" title="" onclick="removeproduct('+k+')" class="btn btn-default btn-sm m-user-delete" data-original-title="Remove Product"><i class="fa fa-times" aria-hidden="true"></i></a></div></td></tr>';
	$('#cartitems').append(fields);
	k = k+1;
}
function addtocustomer(customername,customerid,tin_number,bal,statecode)
{

	//alert(customername+customerid)
	

		$('#tin_number').val(tin_number);
		$('#customerid').val(customerid);
		$('#customer1').val(customername);
		$('#oldbalance').val(bal);
		//$('#gtotalprice').val(bal);
		$('#stateid').val(statecode);
	document.getElementById('customer1').value=customername;
	
	
	document.getElementById('result').style.display='none';
		
	
}
function addtoproduct(prodid, prodcode, enname, purprice, saleprice, stock, num, vat,unit)
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
	var oldbal = $('#oldbalance').val();
	
	$('#availableqty'+num).html(stock);
	$('#qty'+num).val(1);
	$('#vatper'+num).val(vat);
	$('#unittype'+num).val(unit);
	
	var vtamnt = (Number(vat)/(Number(vat)+100))*Number(purprice);
	var product_prive =(Number(purprice) - Number(vtamnt)).toFixed(2);
	$('#saleprice'+num).val(purprice);
	$('#unitprice'+num).val(product_prive);
	var tot = Number(purprice);
	$('#total'+num).val(tot);
	$('#vatamnt'+num).val(vtamnt.toFixed(2));
	
	if($('#totalprice').val() == "")
	{
		$('#totalprice').val(tot);
		
		$('#gtotalprice').val(Number(tot));
		$('#paidamount').val(Number(tot));
		$('#balance').val(Number(oldbal)-Number(tot));
	}
	else{
		var total = Number($('#totalprice').val())+Number(tot);
		$('#totalprice').val(total);
		
		$('#gtotalprice').val(Number(total));
		$('#paidamount').val(Number(total));
		$('#balance').val(Number(oldbal)-Number(total));
	}
	
	addproductfields();
	
	document.getElementById('results'+num).style.display='none';
	}else{
		alert("Product already selected.");
	}
}

function removeproduct(num)
{
	/*if(confirm("Are you sure?"))
	{*/
	var discount = $('#discount').val();
		var deltotal = $('#total'+num).val();
		
		var minustotal = Number($('#totalprice').val()) - Number(deltotal);
		var minusgtotal = Number($('#gtotalprice').val()) - Number(deltotal);
		$('#totalprice').val(minustotal.toFixed(2));
		$('#gtotalprice').val(minusgtotal.toFixed(2));
		var balance = Number($('#balance').val())+Number(deltotal);
		//$('#discount').val(0);
		$('#balance').val(balance);
		$('#paidamount').val((Number(minustotal)-Number(discount)).toFixed(2)+Number($('#coolie').val()));
		$('table#drgcartitms tr#tr'+num).remove();
	//}
}

function calculatetotal(num)
{
	var discount = $('#discount').val();
	
	var vat = $('#vatper'+num).val();
	var qty = $('#qty'+num).val();
	var prce = $('#saleprice'+num).val();
	
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
		
		
		var vtamnt = ((Number(vat)/100)*prce);
		var ttl_vat = Number(vtamnt)*Number(qty);
		var total = Number(qty)*(Number(prce));
		var total = Math.round(total);
		var totamnt = Number(total.toFixed(2));
				
		var lastotal = Number(minustotal) + Number(totamnt);
		$('#vatamnt'+num).val(ttl_vat.toFixed(2))
		$('#totalprice').val(lastotal);
		$('#total'+num).val(totamnt);
		$('#pretotal'+num).val(totamnt);
		
		
		var unitprice= Number(prce)-Number( vtamnt);
		$('#unitprice'+num).val(unitprice)
		
		var gtotal = Number(lastotal) - Number(discount);
		$('#gtotalprice').val(gtotal);
		$('#paidamount').val(gtotal);
		$('#balance').val(Number(ototal)-Number(gtotal));
	}
}
function calculatedicounttotal(cat)
{
	var paidamount = $('#paidamount').val();
	var discount = $('#discount').val();
	var totalprice = $('#totalprice').val();
	var coolie = $('#coolie').val();
	var oldbalance = $('#oldbalance').val();
	var gtotal = $('#gtotalprice').val();
	if(cat==2)
	{
	
	var paidamnt = Number(gtotal) - Number(paidamount);
	$('#balance').val(paidamnt);
	}
	if(cat==1)
	{
		
		var gtotal = Number(totalprice) - Number(discount) + Number(coolie);
		$('#gtotalprice').val(gtotal);
		$('#paidamount').val(gtotal);
		$('#balance').val(Number(oldbalance)-Number(gtotal));
	}
	if(cat==3)
	{
		var gtotal = Number(totalprice) - Number(discount) + Number(coolie);
		$('#gtotalprice').val(gtotal);
		$('#paidamount').val(gtotal);
		$('#balance').val(Number(oldbalance)-Number(gtotal));
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