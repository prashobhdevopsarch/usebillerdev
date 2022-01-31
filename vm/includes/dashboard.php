<?php
session_start();
if(isset($_SESSION['admin']))
{
	include("includes/config.php");
	if(isset($_POST['submit']))
	{
		$billno = $_POST['billno'];
		$customername = $_POST['customername'];
		$phone = $_POST['phone'];
		$date = date('Y-m-d', strtotime($_POST['date']));
		$time = date('H:i:s', strtotime($_POST['time']));
		$billdate = $date . " " . $time;
		$totalprice = $_POST['totalprice'];
		$paidamount = $_POST['paidamount'];
		$curdate = date('Y-m-d H:i:s');
		
		$prodid= $_POST['prodid'];
		$saleprice= $_POST['saleprice'];
		$qty= $_POST['qty'];
		$total= $_POST['total'];
		
		$insrtbill=$conn->query("INSERT INTO us_billentry(be_billnumber, be_customername, be_customermobile, be_billdate, be_total, be_paidamount, be_updateddate) VALUES('$billno', '$customername', '$phone', '$billdate', '$totalprice', '$paidamount', '$curdate')");
		if($insrtbill)
		{
			$bill_id = $conn->insert_id;
			$n=0;
			foreach($prodid as $prdval)
			{
				if($prdval != "")
				{
					$insrtitms = $conn->query("INSERT INTO us_billitems(bi_billid, bi_productid, bi_price, bi_quantity, bi_total, bi_updatedon) VALUES('$bill_id', '$prdval', '$saleprice[$n]', '$qty[$n]', '$total[$n]', '$curdate')");
					$stcs = $conn->query("SELECT pr_stock FROM us_products WHERE pr_productid='$prdval'");
					$row = $stcs->fetch_assoc();
					$nwstock = $row['pr_stock'] - $qty[$n];
					$update = $conn->query("UPDATE us_products SET pr_stock='$nwstock' WHERE pr_productid='$prdval'");
				}
				$n++;
			}
			if($insrtitms)
			{
				header("location:bill_print.php?billid=$bill_id");
			}
			else{
				header('Location: dashboard.php?er=error');
			}
		}
		else{
			header('Location: dashboard.php?er=error');
		}
	}
?>
<!DOCTYPE html>
<html>  
<head>  
        <!-- Title -->
        <title>Vasthramalika Billing</title>
        
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
                    <h3>Billing (<?= date('d-M-Y') ?>)</h3>
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
					$stocks = $conn->query("SELECT * FROM us_billentry ORDER BY be_billid DESC LIMIT 1");
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
                                       <table width="100%">
                                       	<tr>
                                        	<td>
                                            Bill No: <?= $billno ?> &nbsp;&nbsp;
                                            <input type="text" class="form-control" name="customername" style="width: 220px; display: inline;" id="customername" placeholder="Customer Name"> &nbsp; 
                                            <input type="text" class="form-control" name="phone" style="width: 180px; display: inline;" id="phone" placeholder="Phone Number"></td>
                                            <td align="right"><input type="text" class="form-control" style="width: 100px; display: inline;" name="date" id="date" value="<?= date('d-M-Y') ?>"> &nbsp; 
                                            <input type="text" class="form-control" style="width: 70px; display: inline;" name="time" id="time" value="<?= date('H:i') ?>"></td>
                                        </tr>
                                       </table>
                                    <table class="table" id="drgcartitms">
                                    <thead>
                                    <tr>
                                        <th>Product id</th>
                                        <th>Product Name</th>
                                        <th>Sale Price</th>
                                        <th>Qty</th> 
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
										
										<td>
                                        <input type="hidden" name="prodid[]" id="prodid<?= $k ?>">
											<input type="text" autocomplete="off" class="form-control" onKeyUp="productcodesearch(this.value, <?= $k ?>)" name="productcode[]" id="productcode<?= $k ?>" style="width:100px;" placeholder="Code">
                                            <div id="results<?= $k ?>" class="secol" style="position: absolute; font-size: 12px; z-index: 999; width: 50%; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px; display: none; background-color: rgb(255, 255, 255);"><div class="secol" style="padding:5px;" id="serchreslt<?= $k ?>">
                                            </div></div>
										</td>
                                        <td><input type="text" onKeyUp="productsearch(this.value, <?= $k ?>)" autocomplete="off" class="form-control" name="productmlname[]" id="productmlname<?= $k ?>" placeholder="Product Name"></td>
										
                                        <td><input type="text" class="form-control" placeholder="Sale Price" name="saleprice[]" id="saleprice<?= $k ?>" onKeyUp="calculatetotal(<?= $k ?>)" style="width:100px;"></td>
										<td><input type="number" min="1" class="form-control" name="qty[]" onChange="calculatetotal(<?= $k ?>)" onKeyUp="calculatetotal(<?= $k ?>)" id="qty<?= $k ?>" placeholder="Qty" style="width:100px;">
                                        Avail Stock: <span id="availableqty<?= $k ?>"></span>
                                        </td>
                                        
										<td>
                                        	<input readonly type="text" class="form-control" placeholder="Total" name="total[]" id="total<?= $k ?>" style="width:100px;">
                                            
                                            <input type="hidden" class="form-control" name="pretotal[]" id="pretotal<?= $k ?>" style="width:100px;">
                                            
                                        </td>
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
                                    </table>
                                    <a href="javascript:void(0)" onClick="addproductfields()">add more...</a>
                    
                                    <table class="table">
                                    	<tr>
                                        <td align="right">Total Amount:</td>
                                        <td width="150"><input type="text" readonly class="form-control" name="totalprice" id="totalprice" placeholder="Total Amount" style="width:120px;">
                                        
                                        </td>
                                        </tr>
                                        <tr>
                                        <td align="right">Paid Amount:</td>
                                        <td width="150"><input type="text" class="form-control" name="paidamount" id="paidamount" placeholder="Paid Amount" required style="width:120px;">
                                        
                                        </td>
                                        </tr>
                                    </table>
                                       
                                        
                                        <div class="form-group" align="right" style="padding-right:30px;">
                                        <label for="input-help-block" class="col-sm-2 control-label"></label>
                                        <button type="submit" name="submit" class="btn btn-primary">Save & Print</button>
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
        
        <script src="assets/js/pages/dashboard.js"></script>
        <script src="assets/js/pages/form-elements.js"></script>
        
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
	var fields = '<tr style="border-bottom:1px #EEE solid;" id="tr'+k+'"><td><input type="hidden" name="prodid[]" id="prodid'+k+'"><input type="text" onKeyUp="productcodesearch(this.value, '+k+')" autocomplete="off" class="form-control" name="productcode[]" id="productcode'+k+'" style="width:100px;" placeholder="Code"><div id="results'+k+'" class="secol" style="position: absolute; font-size: 12px; z-index: 999; width: 50%; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px; display: none; background-color: rgb(255, 255, 255);"><div class="secol" style="padding:5px;" id="serchreslt'+k+'"></div></div></td> <td><input type="text" autocomplete="off" class="form-control" onKeyUp="productsearch(this.value, '+k+')" name="productmlname[]" id="productmlname'+k+'" placeholder="Product Name"></td><td><input type="text" class="form-control" placeholder="Sale Price" name="saleprice[]" id="saleprice'+k+'" style="width:100px;"></td><td><input type="number" class="form-control" min="1" onChange="calculatetotal('+k+')" onKeyUp="calculatetotal('+k+')" name="qty[]" id="qty'+k+'" placeholder="Qty" style="width:100px;">Avail Srock: <span id="availableqty'+k+'"></span></td><td><input readonly type="text" class="form-control" placeholder="Total" name="total[]" id="total'+k+'" style="width:100px;"><input type="hidden" class="form-control" name="pretotal[]" id="pretotal'+k+'" style="width:100px;"></td><td><div class="btn-group" role="group"><a href="#" data-toggle="tooltip" data-placement="bottom" title="" onclick="removeproduct('+k+')" class="btn btn-default btn-sm m-user-delete" data-original-title="Remove Product"><i class="fa fa-times" aria-hidden="true"></i></a></div></td></tr>';
	$('#cartitems').append(fields);
	k = k+1;
}

function addtoproduct(prodid, prodcode, enname, purprice, saleprice, stock, num)
{
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
	$('#saleprice'+num).val(saleprice);
	$('#total'+num).val(saleprice);
	$('#availableqty'+num).html(stock);
	$('#qty'+num).val(1);
	
	if($('#totalprice').val() == "")
	{
		$('#totalprice').val(saleprice);
	}
	else{
		var total = Number($('#totalprice').val())+Number(saleprice);
		$('#totalprice').val(total);
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
		var deltotal = $('#total'+num).val();
		var minustotal = Number($('#totalprice').val()) - Number(deltotal);
		$('#totalprice').val(minustotal);
		$('table#drgcartitms tr#tr'+num).remove();
	//}
}

function calculatetotal(num)
{
	var qty = $('#qty'+num).val();
	var prce = $('#saleprice'+num).val();
	if(prce != "")
	{
		var preval = $('#pretotal'+num).val();
		if(preval == "")
		{
			var prval = prce;
		}
		else{
			var prval = Number(preval);
		}
		var minustotal = Number($('#totalprice').val()) - Number(prval);
		var total = Number(qty)*Number(prce);
		var lastotal = Number(minustotal) + Number(total);
		$('#totalprice').val(lastotal);
		$('#total'+num).val(total);
		$('#pretotal'+num).val(total);
		
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