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
		
		$curdate = date('Y-m-d H:i:s');
		
		$prodname= $_POST['productmlname'];
		$prodid= $_POST['prodid'];
		$saleprice= $_POST['purchaseprice'];
		$qty= $_POST['qty'];
		$vatamnt = $_POST['vatamnt'];
		$vatper = $_POST['vatper'];
		$stateid=$_POST['stateid'];
		
		
		
		$oldbalance=$_POST["oldbalance"];
		$gtotalprice=$_POST["gtotalprice"];
		
		
		
		$particulars="Purchase";
		$transactiontype="expense";
		$date=$_POST['pdate'];
		$time=$_POST['time'];
		$datetime=date("Y-m-d", strtotime($_POST["pdate"]))." ".date("H:i", strtotime($_POST["time"]));
		$amount=$_POST['paidamount'];
		$billid=$_POST['billno'];
		
				
 $slct_empnum=$conn->query("SELECT	tr_closingbalance FROM vm_transaction ORDER BY tr_id DESC LIMIT 1");
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
		$insrtbill=$conn->query("INSERT INTO vm_purentry(pe_billnumber, pe_customername, pe_customermobile, pe_billdate, pe_total, pe_paidamount, pe_updateddate, pe_discount, pe_mode, pe_paydate,user_id,pe_balance,pe_supplierid,pe_vehicle_number,pe_invoice_number,pe_invoice_date, pe_gtotal, pe_oldbal,pe_statecode) VALUES('$billno', '$customername', '$phone', '$billdate', '$totalprice', '$paidamount', '$curdate', '$discount', 'purchase', '$paydate','".$_SESSION["admin"]."','$balance','$customerid','$vehicle_number','$invoice_number','$invoice_date','$gtotalprice','$oldbalance','$stateid')");
		if($insrtbill)
		{
			$bill_id = $conn->insert_id;
			
					
					$update1 = $conn->query("UPDATE vm_supplier SET  rs_balance='$balance'  WHERE rs_supplierid= '$customerid'");
			
			//$bill_id = 1;
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
					
					$insrtitms = $conn->query("INSERT INTO  vm_puritems(pi_billid, pi_productid, pi_price, pi_quantity, pi_total, pi_updatedon,pi_vatamount, pi_vatper,pi_sgst,pi_sgstamt,pi_cgst,pi_cgstamt,pi_igst,pi_igstamt,user_id) VALUES('$bill_id', '$prdval', '$saleprice[$n]', '$qty[$n]', '$total[$n]', '$curdate','$vatamnt[$n]', '$vatper[$n]','$sgst','$sgstamnt','$cgst','$cgstamnt','$igst','$igstamnt','".$_SESSION["admin"]."')");
					$stcs = $conn->query("SELECT pr_stock FROM vm_products WHERE pr_productid='$prdval'");
					$row = $stcs->fetch_assoc();
					$nwstock = $row['pr_stock'] + $qty[$n];
					$update = $conn->query("UPDATE vm_products SET pr_stock='$nwstock' WHERE pr_productid='$prdval'");
					
				}
				$n++;
			}
			//echo $insrtitms;
			if($insrtitms)
			{
						
                    $insert=$conn->query("insert into vm_transaction(tr_particulars,tr_openingbalance,tr_transactionamount,tr_closingbalance,tr_date,tr_transactiontype,tr_billid,user_id)
                   values('$particulars',' $openingbalence','$amount','$closingbalance','$billdate','$transactiontype','$billid','".$_SESSION["admin"]."')");
				
				if($insert)
	       {header("location:purc_print.php?billid=$bill_id");}
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
                    <h3><strong>പർച്ചേയ്‌സ് (<?= date('d-M-Y') ?>)</strong></h3>
                    <div class="page-breadcrumb">
                        <ol class="breadcrumb">
                        	<li>ബില്ലിംഗ്</li>
                            <li class="active">പർച്ചേയ്‌സ്</li>
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
					$stocks = $conn->query("SELECT * FROM vm_purentry ORDER BY pe_billid DESC LIMIT 1");
					if(mysqli_num_rows($stocks)>0)
					{
						$row = $stocks->fetch_assoc();
						$billno = $row['pe_billnumber'] + 1;
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
                                    <h4 class="panel-title">പർച്ചേയ്‌സ്</h4>
                                    <a href="dashboard.php?billno=<?= $billno+1 ?>" target="_blank"> </a>
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
											എറർ ഒക്യൂർഡ്, പ്ളീസ് ട്രൈ എഗൈൻ
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
												ബിൽ നം:  <?= $billno ?> &nbsp;&nbsp;
                                           
                                            
                                            <div id="show">
                                            <br>
											 <input type="hidden" id="stateid" name="stateid" >
											 <input type="hidden" id="customerid" name="customerid" >
                                             <input type="text" class="form-control"onKeyUp="customersearch(this.value)" id="customer1" autocomplete="off" name="customername1" style="width: 220px; display: inline;" placeholder="സപ്ലയർ നെയിം" required> <br> 
                                           
											<div id="result" class="secol" style="position: absolute; font-size: 12px; z-index: 999; width: 50%; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px; display: none;background-color: rgb(255, 255, 255);">
											<div class="secol" style="padding:5px;" id="searchresult">
                                            </div></div> 

											
                                            
                                            
											</div>
                                            
                                            <div class="margin-left">
                                             <input type="text" class="form-control" autocomplete="off" name="vehicle_number" style="width: 220px; display: inline;" placeholder="വെഹിക്കിൾ നമ്പർ"><br><input type="text" class="form-control" autocomplete="off" name="invoice_number" style="width: 220px; display: inline;" placeholder="ഇൻവോയ്‌സ്‌ നമ്പർ"><input type="date" class="form-control" autocomplete="off" name="invoice_date" style="width: 220px; display: inline;" placeholder="Invoice Date">
                                             
                                             </div>
                                            </td>
                                            <td align="right"><input type="date" class="form-control" style="width: 155px; display: inline;" name="date" id="date" value="<?= date('Y-m-d') ?>"> &nbsp; 
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
										<!--<th>Unit</th>-->
										<th>ജിഎസ് ടി %</th>
                                        <th style="display:none;">ജിഎസ് ടി</th> 
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
											<input type="text" autocomplete="off" class="form-control" onKeyUp="productcodesearch(this.value, <?= $k ?>)" name="productcode[]" id="productcode<?= $k ?>" style="width:100px;" placeholder="കോഡ്">
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
											അവയിൽ സ്റ്റോക്ക് :  <span id="availableqty<?= $k ?>"></span>
                                        </td>
										<!--<td>
										<input type="text" class="form-control" readonly placeholder="യൂണിറ്റ്" name="unittype[]" id="unittype<?= $k ?>" style="width:70px;">
										</td>-->
                                        <td>
										<input type="text" readonly placeholder="GST %" style="width:60px;" class="form-control" name="vatper[]" id="vatper<?= $k ?>"></td>
                                        <td style="display:none;">
                                        <input type="text" class="form-control" readonly placeholder="ജിഎസ് ടി" name="vatamnt[]" id="vatamnt<?= $k ?>" style="width:100px;"></td>
										
										<td>
                                        	<input readonly type="text" class="form-control" placeholder="ടോട്ടൽ" name="total[]" id="total<?= $k ?>" style="width:100px;">
                                            
                                            <input type="hidden" class="form-control" name="pretotal[]" id="pretotal<?= $k ?>" style="width:100px;">
                                            
                                        </td>
										<td>
										<div class="btn-group" role="group">
													<a href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" title="" onclick="removeproduct(<?= $k ?>)" class="btn btn-default btn-sm m-user-delete" data-original-title="റിമൂവ്  പ്രോഡക്റ്റ് "><i class="fa fa-times" aria-hidden="true"></i></a>
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
                                    <a href="javascript:void(0)" onClick="addproductfields()">ആഡ് </a>
                    
                                    <table class="table">
                                    	<tr>
                                        <td align="right">ടോട്ടൽ എമൗണ്ട് :</td>
                                        <td width="150"><input type="text" readonly class="form-control" name="totalprice" id="totalprice" placeholder="ടോട്ടൽ എമൗണ്ട്" style="width:150px;">
                                        
                                        </td>
                                        </tr>
                                        <tr>
                                        <td align="right">ഡിസ്‌കൗണ്ട് :</td>
                                        <td width="150"><input type="text" class="form-control" name="discount" id="discount" placeholder="ഡിസ്‌കൗണ്ട്" value="0" onChange="calculatedicounttotal(1)" onKeyUp="calculatedicounttotal(1)" style="width:150px;">
                                        
                                        </td>
                                        </tr>
                                        <tr>
										 
												<td align="right">ഓൾഡ്  ബാലൻസ് :</td>
												<td style="width:150px;"><input type="text" readonly class="form-control" value="0" name="oldbalance" id="oldbalance" placeholder="Old Balance" style="width:150px;">
                                        
											</td>
																					 
										</tr>
                                        <tr>
											<td align="right">ഗ്രാൻറ് ടോട്ടൽ :</td>
											<td width="150"><input type="text" readonly class="form-control" name="gtotalprice" id="gtotalprice" placeholder="ഗ്രാൻറ് ടോട്ടൽ" style="width:150px;">
                                        
											</td>
										</tr>
                                        <tr>
                                        <td align="right">പെയ്ഡ് എമൗണ്ട് :</td>
                                        <td width="150"><input type="text" class="form-control" name="paidamount" onChange="calculatedicounttotal(2)" onKeyUp="calculatedicounttotal(2)" id="paidamount" placeholder="പെയ്ഡ് എമൗണ്ട്" required style="width:150px;">
                                        
                                        </td>
                                        </tr>
                                        <tr>
                                        <td align="right">ബാലൻസ് എമൗണ്ട് :</td>
                                        <td width="150"><input type="text" readonly class="form-control" value="0" name="balance" id="balance" placeholder="ബാലൻസ്" required style="width:150px;">
                                        
                                        </td>
                                        </tr>
                                        <tr style="display:none;">
                                        <td align="right">പെയ്ഡ് ഡേറ്റ് :</td>
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
	var fields = '<tr style="border-bottom:1px #EEE solid;" id="tr'+k+'"><td><input type="hidden" name="prodid[]" id="prodid'+k+'"><input type="text" onKeyUp="productcodesearch(this.value, '+k+')" autocomplete="off" class="form-control" name="productcode[]" id="productcode'+k+'" style="width:100px;" placeholder="കോഡ് "><div id="results'+k+'" class="secol" style="position: absolute; font-size: 12px; z-index: 999; width: 50%; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px; display: none; background-color: rgb(255, 255, 255);"><div class="secol" style="padding:5px;" id="serchreslt'+k+'"></div></div></td> <td><input type="text" autocomplete="off" class="form-control" onKeyUp="productsearch(this.value, '+k+')" name="productmlname[]" id="productmlname'+k+'" placeholder="Pപ്രോഡക്റ്റ് നെയിം"></td><td><input type="text" class="form-control" readonly placeholder="എച് എസ് എൻ നമ്പർ" name="hsn[]" id="hsn'+k+'" style="width:90px;"></td><td><input type="text" class="form-control" placeholder="പർച്ചേയ്‌സ് പ്രൈസ്"  id="saleprice'+k+'" onKeyUp="calculatetotal('+k+')" style="width:112px;"></td><td style="display:none;"><input type="text" readonly placeholder="യൂണിറ്റ് പ്രൈസ്" style="width:100px;" class="form-control" name="purchaseprice[]" id="unitprice'+k+'"></td><td><input type="number" class="form-control" step="any" onChange="calculatetotal('+k+')" onKeyUp="calculatetotal('+k+')" name="qty[]" id="qty'+k+'" placeholder="ക്വാണ്ടിറ്റി" style="width:100px;">അവയിൽ സ്റ്റോക്ക് : <span id="availableqty'+k+'"></span></td><td style=" display:none;"><input type="text" class="form-control" readonly placeholder="യൂണിറ്റ്" name="unittype[]" id="unittype'+k+'" style="width:70px;"></td><td><input type="text" readonly placeholder="ജിഎസ് ടി %" style="width:60px;" class="form-control" name="vatper[]" id="vatper'+k+'"></td><td style="display:none;"><input type="text" class="form-control" readonly placeholder="ജിഎസ് ടി" name="vatamnt[]" id="vatamnt'+k+'" style="width:100px;"></td><td><input readonly type="text" class="form-control" placeholder="ടോട്ടൽ" name="total[]" id="total'+k+'" style="width:100px;"><input type="hidden" class="form-control" name="pretotal[]" id="pretotal'+k+'" style="width:100px;"></td><td><div class="btn-group" role="group"><a href="#" data-toggle="tooltip" data-placement="bottom" title="" onclick="removeproduct('+k+')" class="btn btn-default btn-sm m-user-delete" data-original-title="Remove Product"><i class="fa fa-times" aria-hidden="true"></i></a></div></td></tr>';
	$('#cartitems').append(fields);
	k = k+1;
}

function addtoproduct(prodid, prodcode, enname, purprice, saleprice, stock, num, vat,unit,hsn)
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
		
		$('#gtotalprice').val(Number(tot)+Number(oldbal));
		$('#paidamount').val(Number(tot)+Number(oldbal));
	}
	else{
		var total = Number($('#totalprice').val())+Number(tot);
		$('#totalprice').val(total);
		
		$('#gtotalprice').val(Number(total)+Number(oldbal));
		$('#paidamount').val(Number(total)+Number(oldbal));
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
		$('#totalprice').val(minustotal.toFixed(2));
		//$('#discount').val(0);
		$('#paidamount').val((Number(minustotal)-Number(discount)).toFixed(2));
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
		
		var gtotal = Number(lastotal) - Number(discount) + Number(ototal);
		$('#gtotalprice').val(gtotal);
		$('#paidamount').val(gtotal);
	}
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
	}
	if(cat==1)
	{
		
		var gtotal = Number(totalprice) - Number(discount) + Number(oldbalance);
		$('#gtotalprice').val(gtotal);
	$('#paidamount').val(gtotal);
		
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
		</script>
    </body>

</html>
<?php
}else{
	header("Location:index.php");
}
?>