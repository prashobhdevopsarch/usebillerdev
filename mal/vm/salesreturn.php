<?php
session_start();
if(isset($_SESSION['admin']))
{
	include("includes/config.php");
	if(isset($_POST['submit']))
	{
		$insrtitms=true;
		
		$billno = $_POST['billno'];
		
		$customerid=$_POST["customerid"];
		
		$vehicle_number=$_POST["vehicle_number"];
		//$invoice_number=$_POST["invoice_number"];
		//$invoice_date=$_POST["invoice_date"];
		
		
		$customername = $_POST['customername'];
		$phone = $_POST['phone'];
		
		$date = date('Y-m-d', strtotime($_POST['date']));
		$time = date('H:i:s', strtotime($_POST['time']));
		$billdate = $date . " " . $time;
		$totalprice = $_POST['totalprice'];
		$discount = $_POST['discount'];
		$paidamount = $_POST['paidamount'];
		$balance=$_POST["balance"];
		$paydate = $_POST['pdate'];
		
		$curdate = date('Y-m-d H:i:s');
		
		$prodname= $_POST['productmlname'];
		$prodid= $_POST['prodid'];
		$saleprice= $_POST['saleprice'];
		$qty= $_POST['qty'];
		$vatamnt = $_POST['vatamnt'];
		$vatper = $_POST['vatper'];
		$rebill = $_POST['rebill'];
		
		$oldbalance=$_POST["oldbalance"];
		$gtotalprice=$_POST["gtotalprice"];
		
		
		
		$particulars="Sales Return";
		$transactiontype="expense";
		$date=$_POST['pdate'];
		$time=$_POST['time'];
		$datetime=date("Y-m-d", strtotime($_POST["pdate"]))." ".date("H:i", strtotime($_POST["time"]));
		$amount=$_POST['paidamount'];
		$billid=$_POST['billno'];
		
		$supplyplace=$_POST["supplyplace"];
				
 $slct_empnum=$conn->query("SELECT	tr_closingbalance FROM vm_transaction ORDER BY tr_id DESC LIMIT 1");
 
		$slct_bill=$conn->query("SELECT be_billid FROM vm_billentry WHERE be_billnumber='$rebill'");
		$row_bill=$slct_bill->fetch_assoc();
		$rebill=$row_bill['be_billid'];
 
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
		//echo $billno."<br>".$customername."<br>".$phone."<br>".$date."<br>".$time."<br>".$billdate."<br>".$totalprice."<br>".$discount."<br>".$paidamount."<br>".$curdate."<br>".$paydate."<br>pname:".$prodname[0]."<br>pid:".$prodid[0]."<br>".$saleprice[0]."<br>".$qty[0]."<br>".$total[0];
		$insrtbill=$conn->query("INSERT INTO vm_salreturnentry(sre_billnumber, sre_customername, sre_customermobile, sre_billdate, sre_total, sre_paidamount, sre_updateddate, sre_discount, sre_mode, sre_paydate, user_id, sre_balance, sre_supplierid, sre_vehicle_number, sre_gtotal, sre_oldbal, sre_rebill,sre_statecode) VALUES('$billid', '$customername', '$phone', '$billdate', '$totalprice', '$paidamount', '$curdate', '$discount', 'salesreturn', '$paydate','".$_SESSION["admin"]."','$balance','$customerid','$vehicle_number', '$gtotalprice','$oldbalance','$rebill','$supplyplace')");
		if($insrtbill)
		{
			$bill_id = $conn->insert_id;
			
					
					
			
			//$bill_id = 1;
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
					
					$insrtitms = $conn->query("INSERT INTO  vm_salreturnitem(sri_billid, sri_returnbillid, sri_productid, sri_price, sri_quantity, sri_total, sri_updatedon, sri_sgst, sri_sgstamt, sri_cgst, sri_cgstamt, sri_igst, sri_igstamt, user_id) VALUES('$bill_id', '$rebill', '$prdval', '$saleprice[$n]', '$qty[$n]', '$total[$n]', '$curdate','$sgst_p', '$sgst_a','$cgst_p', '$cgst_a','$igst_p', '$igst_a','".$_SESSION["admin"]."')");
					$stcs = $conn->query("SELECT pr_stock FROM vm_products WHERE pr_productid='$prdval'");
					$row = $stcs->fetch_assoc();
					$nwstock = $row['pr_stock'] + $qty[$n];
					$update = $conn->query("UPDATE vm_products SET pr_stock='$nwstock' WHERE pr_productid='$prdval'");
					$updatesup = $conn->query("UPDATE vm_customer SET cs_balance='$balance' WHERE cs_customerid='$customerid'");
				}
				$n++;
			}
			//echo $insrtitms;
			if($insrtitms)
			{
						
                    $insert=$conn->query("insert into vm_transaction(tr_particulars, tr_openingbalance, tr_transactionamount, tr_closingbalance, tr_date, tr_transactiontype, tr_billid, user_id)
                   values('$particulars',' $openingbalence','$amount','$closingbalance','$billdate','$transactiontype','$billid','".$_SESSION["admin"]."')");
				
				if($insert)
	       {header("location:salesreturn_print.php?billid=$bill_id");}
	   else{
				header('Location: salesreturn.php?er=error1');
			}
				
				//header('Location: salesreturn.php?suc=success');
				
				
			}
			else{
				header('Location: salesreturn.php?er=error1');
			}
		}
		else{
			//header('Location: salesreturn.php?er=error2');
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
	</style>
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
                    <h3><strong>സെയിൽസ് റിട്ടേൺ(<?= date('d-M-Y') ?>)</strong></h3>
                    <div class="page-breadcrumb">
                        <ol class="breadcrumb">
                        	<li>ബില്ലിംഗ്</li>
                            <li class="active">സെയിൽസ് റിട്ടേൺ </li>
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
					$stocks = $conn->query("SELECT * FROM vm_salreturnentry ORDER BY sre_billid DESC LIMIT 1");
					if(mysqli_num_rows($stocks)>0)
					{
						$row = $stocks->fetch_assoc();
						$billno = $row['sre_billnumber'] + 1;
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
                                    <h4 class="panel-title">സെയിൽസ് റിട്ടേൺ </h4>
                                    <a href="dashboard.php?billno=<?= $billno+1 ?>" target="_blank"> </a>
                                </div>
                                <?php
								if(isset($_GET['id']))
								{
									?>
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
											ബിൽ സേവ്ഡ്  സക്‌സെസ്സ്ഫുള്ളി .
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
                                       
                                       <input type="hidden" name="billno" id="billno" value="<?= $billno ?>">
                                      <div class="table-responsive">
                                       <table class="table">
                                       	<tr>
                                        	<td>
												ബിൽ നം:  <?= $billno ?><br><br>
											
                                            <label for="customercheck"> <b>ആൾറെഡി എക്സിസ്റ്റിങ് കസ്റ്റമർ ?</b>
                                            <input type="checkbox"  class="form-control" name="customercheck" id="customercheck"  ></label>
                                            <div id="show" style="display: none;">
                                            <br>
											
											 <input type="hidden" id="customerid" name="customerid" >
                                             <input type="text" class="form-control"onKeyUp="customersearch(this.value)" id="customer1" autocomplete="off" name="customername1[]" style="width: 220px; display: inline;" placeholder="കസ്റ്റമർ നെയിം"> <br> 
                                           
											<div id="result" class="secol" style="position: absolute; font-size: 12px; z-index: 999; width: 50%; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px; display: none;background-color: rgb(255, 255, 255);">
											<div class="secol" style="padding:5px;" id="searchresult">
                                            </div></div> 

											</div>
                                            <div id="normal"> 
											
                                           <br> <input type="text" class="form-control" name="customername" style="width: 220px; display: inline;" id="customername" placeholder="കസ്റ്റമർ നെയിം"> &nbsp; 
                                            <input type="text" class="form-control" name="phone" style="width: 220px; display: inline;" id="phone" placeholder="ഫോൺ നമ്പർ">
											</div>
											
                                            <input type="text" class="form-control" name="vehicle_number" style="width: 220px; display: inline;margin-top: 15px;" id="vehicle_number" placeholder="വെഹിക്കിൾ നമ്പർ">
											<input type="text" class="form-control" name="tin_number" style="width: 220px; display: inline;margin-top: 15px; margin-left:10px;" id="tin_number" placeholder="ജിഎസ് ടിൻ">
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
											</td>
											
                                            <td align="right">
											<b>റിട്ടേൺ  ബിൽ  :  </b><input required type="text" class="form-control" placeholder="റിട്ടേൺ  ബിൽ  : " name="rebill" id="rebill" style="width:100px;margin-right:20px; display: inline;"> 
											<input type="date" class="form-control" style="width: 155px; display: inline;" name="date" id="date" value="<?= date('Y-m-d') ?>"> &nbsp; 
                                            <input type="time" class="form-control" style="width: 120px; display: inline;" name="time" id="time" value="<?= date('H:i') ?>"></td>
                                        </tr>
						                </table>
                                       
                                    <table class="table" id="drgcartitms">
                                    <thead>
                                    <tr>
                                        <th>പ്രോഡക്റ്റ് ഐഡി</th>
                                        <th>പ്രോഡക്റ്റ് നെയിം</th>
                                        <th>യൂണിറ്റ് പ്രൈസ്</th>
                                        <th>ജിഎസ് ടി %</th>
                                        <th>ക്വാണ്ടിറ്റി</th>
                                        <th>ഡിസ്‌കൗണ്ട്</th>
										<th>യൂണിറ്റ്</th>
                                        <th>നെറ്റ് എമൗണ്ട്</th>
                                        <th>ജിഎസ് ടി </th> 
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
											<input type="text" autocomplete="off" class="form-control" onKeyUp="productcodesearch(this.value, <?= $k ?>)" name="productcode[]" id="productcode<?= $k ?>" style="width:70px;" placeholder="കോഡ് ">
                                            <div id="results<?= $k ?>" class="secol" style="position: absolute; font-size: 12px; z-index: 999; width: 50%; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px; display: none; background-color: rgb(255, 255, 255);"><div class="secol" style="padding:5px;" id="serchreslt<?= $k ?>">
                                            </div></div>
										</td>
                                        <td><input type="text" onKeyUp="productsearch(this.value, <?= $k ?>)" autocomplete="off" class="form-control" name="productmlname[]" id="productmlname<?= $k ?>" style="width:110px;" placeholder="പ്രോഡക്റ്റ് നെയിം"></td>
										
                                        <td><input type="text" class="form-control" placeholder="യൂണിറ്റ് പ്രൈസ്" name="saleprice[]" id="saleprice<?= $k ?>" onKeyUp="calculatetotal(<?= $k ?>)" style="width:100px;"></td>
                                        <td>
                                        <input type="text" placeholder="GST %" style="width:60px;" class="form-control" name="vatper[]" id="vatper<?= $k ?>"></td>
										<td><input type="number" step="any" class="form-control" name="qty[]" onChange="calculatetotal(<?= $k ?>),sub_stock(this.value,<?=$k?>)" onKeyUp="calculatetotal(<?= $k ?>),sub_stock(this.value,<?=$k?>)" id="qty<?= $k ?>" placeholder="ക്വാണ്ടിറ്റി" style="width:90px;">
											അവയിൽ സ്റ്റോക്ക്: <span id="availableqty<?= $k ?>"></span> ബാലൻസ്: <span id="bal<?=$k?>"></span>
                                        </td>
                                        <td><input type="text" style="width:60px;" class="form-control" onChange="calcdisc(this.value,<?= $k ?>)" name="discounti[]" id="discount<?= $k ?>"><input type="hidden" name="prediscount[]" id="prediscount<?= $k ?>"></td>
                                        </td>
										<td>
										<input type="text" class="form-control" readonly placeholder="യൂണിറ്റ്" name="unittype[]" id="unittype<?= $k ?>" style="width:70px;">
										</td>
                                        <td>
                                        <input type="hidden" name="prenetamnt[]" id="prenetamnt<?= $k ?>">
                                        <input type="text" class="form-control" readonly placeholder="Net amount" name="netamnt[]" id="netamnt<?= $k ?>" style="width:100px;"></td>
										
                                        <td>
                                        <input type="text" class="form-control" readonly placeholder="ജിഎസ് ടി" name="vatamnt[]" id="vatamnt<?= $k ?>" style="width:100px;"></td>
										<td>
                                        	<input readonly type="text" class="form-control" placeholder="ടോട്ടൽ" name="total[]" id="total<?= $k ?>" style="width:100px;">
                                            
                                            <input type="hidden" class="form-control" name="pretotal[]" id="pretotal<?= $k ?>" style="width:100px;">
                                            
                                            
                                        </td>
										<td>
										<a href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" title="" onclick="removeproduct(<?= $k ?>)" class="btn btn-default btn-sm m-user-delete" data-original-title="റിമൂവ് പ്രോഡക്റ്റ് "><div class="btn-group" role="group">
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
                                    <a href="javascript:void(0)" onClick="addproductfields()">ആഡ് </a>
                    
                                    <table class="table">
                                    	<tr>
                                        <td align="right">ടോട്ടൽ എമൗണ്ട്:</td>
                                        <td width="150"><input type="text" readonly class="form-control" name="totalprice" id="totalprice" placeholder="ടോട്ടൽ എമൗണ്ട്" style="width:150px;">
                                        
                                        </td>
                                        </tr>
                                        <tr>
                                        <td align="right">ഡിസ്‌കൗണ്ട്:</td>
                                        <td width="150"><input type="text" class="form-control" name="discount" id="discount" placeholder="ഡിസ്‌കൗണ്ട്" value="0" onChange="calculatedicounttotal(1)" onKeyUp="calculatedicounttotal(1)" style="width:150px;">
                                        
                                        </td>
                                        </tr>
                                        
                                        <tr>
											<td align="right">ഗ്രാൻറ് ടോട്ടൽ :</td>
											<td width="150"><input type="text" readonly class="form-control" name="gtotalprice" id="gtotalprice" placeholder="ഗ്രാൻറ് ടോട്ടൽ" style="width:120px;">
                                        
											</td>
										</tr>
                                        <tr>
                                        <td align="right">പെയ്ഡ് എമൗണ്ട് :</td>
                                        <td width="150"><input type="text" class="form-control" name="paidamount" onChange="calculatedicounttotal(2)" onKeyUp="calculatedicounttotal(2)" id="paidamount" placeholder="പെയ്ഡ് എമൗണ്ട് " required style="width:150px;">
                                        
                                        </td>
                                        </tr>
										<tr id="show1" style="display:none;">
										 
												<td align="right">ഓൾഡ്  ബാലൻസ് :</td>
												<td style="width:150px;"><input type="text" readonly class="form-control" value="0" name="oldbalance" id="oldbalance" placeholder="Old Balance" style="width:120px;">
                                        
											</td>
																					 
										</tr>
                                        <tr>
                                        <td align="right">ബാലൻസ് എമൗണ്ട് </td>
                                        <td width="150"><input type="text" readonly class="form-control" value="0" name="balance" id="balance" placeholder="ബാലൻസ് " required style="width:120px;">
                                        
                                        </td>
                                        </tr>
                                        <tr style="display:none;">
                                        <td align="right">പെയ്ഡ് ഡേറ്റ്:</td>
                                        <td align="right"><input  type="date" class="form-control" style="width: 150px;" name="pdate" id="pdate" value="<?= date('d-M-Y') ?>"> &nbsp; </td></tr>
                                    </table>
                                      
                                        </div>
                                        <div class="form-group" align="right" style="padding-right:30px;">
                                        <label for="input-help-block" class="col-sm-2 control-label"></label>
                                        <button type="submit" name="submit" class="btn btn-primary">സേവ് & പ്രിൻറ്</button>
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
		
		var k=2;
function addproductfields()
{
	var fields = '<tr style="border-bottom:1px #EEE solid;" id="tr'+k+'"><td><input type="hidden" name="prodid[]" id="prodid'+k+'"><input type="text" onKeyUp="productcodesearch(this.value, '+k+')" autocomplete="off" class="form-control" name="productcode[]" id="productcode'+k+'" style="width:70px;" placeholder="കോഡ് "><div id="results'+k+'" class="secol" style="position: absolute; font-size: 12px; z-index: 999; width: 50%; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px; display: none; background-color: rgb(255, 255, 255);"><div class="secol" style="padding:5px;" id="serchreslt'+k+'"></div></div></td> <td><input type="text" autocomplete="off" class="form-control" onKeyUp="productsearch(this.value, '+k+')" name="productmlname[]" id="productmlname'+k+'" placeholder="പ്രോഡക്റ്റ് നെയിം" style="width:110px;"></td><td><input type="text" class="form-control" placeholder="യൂണിറ്റ് പ്രൈസ്" name="saleprice[]" id="saleprice'+k+'" style="width:100px;"></td><td><input type="text" placeholder="ജിഎസ് ടി %" style="width:60px;" class="form-control" name="vatper[]" id="vatper'+k+'"></td><td><input type="number" class="form-control" step="any" onChange="calculatetotal('+k+'),sub_stock(this.value,'+k+')" onKeyUp="calculatetotal('+k+'),sub_stock(this.value,'+k+')" name="qty[]" id="qty'+k+'" placeholder="ക്വാണ്ടിറ്റി" style="width:100px;">അവയിൽ സ്റ്റോക്ക്: <span id="availableqty'+k+'"></span>ബാലൻസ്: <span id="bal'+k+'"></span></td><td><input type="text" style="width:60px;" class="form-control" onChange="calcdisc(this.value,'+k+')" name="discounti[]" id="discount'+k+'"><input type="hidden" name="prediscount[]" id="prediscount'+k+'"></td><td><input type="text" class="form-control" readonly placeholder="യൂണിറ്റ്" name="unittype[]" id="unittype'+k+'" style="width:70px;"></td><td><input type="hidden" name="prenetamnt[]" id="prenetamnt'+k+'"><input type="text" class="form-control" readonly placeholder="നെറ്റ് എമൗണ്ട്" name="netamnt[]" id="netamnt'+k+'" style="width:100px;"></td><td><input type="text" class="form-control" readonly placeholder="GST amount" name="vatamnt[]" id="vatamnt'+k+'" style="width:100px;"></td><td><input readonly type="text" class="form-control" placeholder="ടോട്ടൽ" name="total[]" id="total'+k+'" style="width:100px;"><input type="hidden" class="form-control" name="pretotal[]" id="pretotal'+k+'" style="width:100px;"></td><td><div class="btn-group" role="group"><a href="#" data-toggle="tooltip" data-placement="bottom" title="" onclick="removeproduct('+k+')" class="btn btn-default btn-sm m-user-delete" data-original-title="Remove Product"><i class="fa fa-times" aria-hidden="true"></i></a></div></td></tr>';
	$('#cartitems').append(fields);
	k = k+1;
}
function addtocustomer(customername,customerid,tin_number,bal,stcode)
{

	//alert(customername+customerid)
	

		$('#tin_number').val(tin_number);
		$('#customerid').val(customerid);
		$('#customer1').val(customername);
		$('#oldbalance').val(bal);
		$('#gtotalprice').val(bal);
		$('#supplyplace').val(stcode);
	document.getElementById('customer1').value=customername;
	
	
	document.getElementById('result').style.display='none';
		
	
}

function addtoproduct(prodid, prodcode, enname, purprice, saleprice, stock, num, vat,unit)
{
	//$bal=$availableqty-1;
	//document.getElementById("availableqty"+k)-1=$bal;
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
	$('#bal'+num).html(Number(stock)-1);
	$('#qty'+num).val(1);
	$('#vatper'+num).val(vat);
	$('#unittype'+num).val(unit);
	var vtamnt = (Number(vat)/(Number(vat)+100))*Number(saleprice);
	var product_prive =(Number(saleprice) - Number(vtamnt)).toFixed(2);
	$('#saleprice'+num).val(product_prive);
	$('#netamnt'+num).val(product_prive);
	$('#prenetamnt'+num).val(product_prive);
	var tot = Number(saleprice);
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
	
	//addproductfields();
	
	document.getElementById('results'+num).style.display='none';
	}else{
		alert("Product already selected.");
	}$('#qty'+num).focus();	
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
		$('#gtotalprice').val(newgtotal.toFixed(2))
		//$('#discount').val(0);
		$('#paidamount').val(Number(minustotal.toFixed(2)));
		$('table#drgcartitms tr#tr'+num).remove();
	//}
}

function calculatetotal(num)
{
	var discount = $('#discount').val();
	
	var vat = $('#vatper'+num).val();
	var qty = $('#qty'+num).val();
	var prce = $('#saleprice'+num).val();
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
		
		
		var vtamnt = ((Number(vat)/100)*prce);
		var ttl_vat = Number(vtamnt)*Number(qty);
		var netamnt = Number(qty)*Number(prce);
		var total = Number(qty)*(Number(prce)+Number(vtamnt.toFixed(2)));
		var total = Math.round(total);
		var totamnt = Number(total.toFixed(2));
				
		var lastotal = Number(minustotal) + Number(totamnt);
		$('#vatamnt'+num).val(ttl_vat.toFixed(2))
		$('#totalprice').val(lastotal);
		$('#total'+num).val(totamnt);
		$('#netamnt'+num).val(netamnt);
		$('#pretotal'+num).val(totamnt);
		
		var gtotal = Number(lastotal) - Number(discount);
		$('#gtotalprice').val(gtotal);
		$('#paidamount').val(gtotal);
		$('#balance').val(Number(ototal)-Number(gtotal));
		
	}
}
function calcdisc(disc,num)
{
	disc=Number(disc);
	var predisc=$('#prediscount'+num).val();
	var tdisc = $('#discount').val();
	var newtdisc = Number(tdisc)-Number(predisc);
	newtdisc = newtdisc+Number(disc);
	var taxp=$('#vatper'+num).val();
	var prenetamnt=$('#prenetamnt'+num).val();
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
	
	$('#netamnt'+num).val(newnet.toFixed(2));
	$('#vatamnt'+num).val(newtax.toFixed(2));
	$('#total'+num).val(newtotal.toFixed(2));
	$('#pretotal'+num).val(newtotal.toFixed(2));
	$('#totalprice').val(newtotalprice.toFixed(2));
	$('#gtotalprice').val(newgtotal.toFixed(2));
	$('#paidamount').val(newgtotal.toFixed(2));
	$('#discount').val(newtdisc.toFixed(2));
	$('#prediscount'+num).val(disc.toFixed(2));
	
}
function calculatedicounttotal(cat)
{
	var paidamount = $('#paidamount').val();
	var discount = $('#discount').val();
	var totalprice = $('#totalprice').val();
	var oldbalance = $('#oldbalance').val();
	var gtotal = $('#gtotalprice').val();
	if(cat==2)
	{
	
	var paidamnt = Number(gtotal) - Number(paidamount);
	$('#balance').val(paidamnt);
	$('#balance').val(Number(oldbalance)-Number(gtotal));
	
	}
	if(cat==1)
	{
		
		var gtotal = Number(totalprice) - Number(discount);
		$('#gtotalprice').val(gtotal);
	$('#paidamount').val(gtotal);
	$('#balance').val(Number(oldbalance)-Number(gtotal));
		
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
 xhttp.open("GET", "searchcustomer.php?key="+str, true);
 xhttp.send();

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
	header("Location:index.php");
}
?>