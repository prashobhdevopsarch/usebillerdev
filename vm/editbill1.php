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
		$discount = $_POST['discount'];
		$paidamount = $_POST['paidamount'];
		$curdate = date('Y-m-d H:i:s');
		
		$prodid= $_POST['prodid'];
		$saleprice= $_POST['saleprice'];
		$qty= $_POST['qty'];
		$vatamnt = $_POST['vatamnt'];
		$vatper = $_POST['vatper'];
		$total= $_POST['total'];
		$balance=$_POST['balance'];
		$insrtbill=$conn->query("UPDATE vm_billentry SET be_customername='$customername', be_customermobile='$phone', be_total='$totalprice', be_paidamount='$paidamount', be_updateddate='$curdate', be_discount='$discount' ,be_balance='$balance' WHERE be_billid='".$_GET["billid"]."'");
		if($insrtbill)
		{
			$bill_id = $_GET["billid"];
			$query=$conn->query("SELECT bi_productid,bi_quantity FROM vm_billitems WHERE bi_billid='$bill_id'");
			while($rowupdat=$query->fetch_assoc())
			{
				$query1=$conn->query("SELECT pr_stock FROM vm_products WHERE pr_productid='".$rowupdat["bi_productid"]."'");
				$rowupdate1=$query1->fetch_assoc();
				$sum=$rowupdate1["pr_stock"]+$rowupdat["bi_quantity"];
				$query2=$conn->query("UPDATE vm_products SET pr_stock='$sum' WHERE pr_productid='".$rowupdat["bi_productid"]."'");
			}
			$delet=$conn->query("DELETE FROM vm_billitems WHERE bi_billid='".$bill_id."'");
			if($delet){
			$n=0;
			foreach($prodid as $prdval)
			{
				if($prdval != "")
				{
					$insrtitms = $conn->query("INSERT INTO vm_billitems(bi_billid, bi_productid, bi_price, bi_quantity, bi_total, bi_updatedon, bi_vatamount, bi_vatper) VALUES('$bill_id', '$prdval', '$saleprice[$n]', '$qty[$n]', '$total[$n]', '$curdate', '$vatamnt[$n]', '$vatper[$n]')");
					$stcs = $conn->query("SELECT pr_stock FROM vm_products WHERE pr_productid='$prdval'");
					$row = $stcs->fetch_assoc();
					$nwstock = $row['pr_stock'] - $qty[$n];
					$update = $conn->query("UPDATE vm_products SET pr_stock='$nwstock' WHERE pr_productid='$prdval'");
				}
				$n++;
			}
			if($insrtitms)
			{
				header("location:bill_print.php?billid=$bill_id");
			}
			else{
				header('Location: dashboard.php?er=error1');
			}}
		}
		else{
			header('Location: dashboard.php?er=error2');
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
                    <h3><strong>Billing (<?= date('d-M-Y') ?>)</strong></h3>
                    <div class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="active">Billing</li>
                        </ol>
                    </div>
                </div>
                <?php
				$today = date('Y-m-d');
				if(isset($_GET['billid']))
				{
					$billid = $_GET['billid'];
				
					$stocks = $conn->query("SELECT * FROM vm_billentry WHERE be_billid='$billid'");
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
                                    <h4 class="panel-title">Billing</h4>
                                    
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
                                       <table width="100%">
                                       	<tr>
                                        	<td>
                                            Bill No: <?=$row["be_billnumber"] ?> &nbsp;&nbsp;
                                            <input type="text" class="form-control" name="customername" value="<?=$row["be_customername"]?>" style="width: 220px; display: inline;" id="customername" placeholder="Customer Name"> &nbsp; 
                                            <input type="text" class="form-control" name="phone" value="<?=$row["be_customermobile"]?>" style="width: 180px; display: inline;" id="phone" placeholder="Phone Number"></td>
                                            <td align="right"><input type="text" class="form-control" style="width: 100px; display: inline;" name="date" id="date" value="<?= date('d-M-Y', strtotime($row["be_billdate"])) ?>"> &nbsp; 
                                            <input type="text" class="form-control" style="width: 70px; display: inline;" name="time" id="time" value="<?= date('H:i', strtotime($row["be_billdate"])) ?>"></td>
                                        </tr>
                                       </table>
                                       <table class="table" id="drgcartitms">
                                    <thead>
                                    <tr>
                                        <th>Product id</th>
                                        <th>Product Name</th>
                                        <th>Sale Price</th>
                                        <th>Qty</th>
                                        <th>VAT %</th>
                                        <th>VAT</th> 
                                        <th>Total</th>                
                                        <th></th>
                                    </tr>
                                    </thead>
                                    
                                    <tbody><?php
										$k=1;
										$slctitm=$conn->query("SELECT * FROM vm_billitems WHERE bi_billid='$billid'");
										while($rowitm=$slctitm->fetch_assoc())
										{
											$itm=$conn->query("SELECT * FROM vm_products WHERE pr_productid='".$rowitm["bi_productid"]."'");
											$itmrow=$itm->fetch_assoc();
										?>
										<tr style="border-bottom:1px #EEE solid;" id="tr<?= $k ?>">
										
										<td>
                                        <input type="hidden" name="prodid[]" value="<?=$rowitm["bi_productid"]?>" id="prodid<?= $k ?>">
											<input type="text" autocomplete="off" value="<?=$itmrow["pr_productcode"]?>" class="form-control" onKeyUp="productcodesearch(this.value, <?= $k ?>)" name="productcode[]" id="productcode<?= $k ?>" style="width:100px;" placeholder="Code">
                                            <div id="results<?= $k ?>" class="secol" style="position: absolute; font-size: 12px; z-index: 999; width: 50%; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px; display: none; background-color: rgb(255, 255, 255);"><div class="secol" style="padding:5px;" id="serchreslt<?= $k ?>">
                                            </div></div>
										</td>
                                        <td><input type="text" onKeyUp="productsearch(this.value, <?= $k ?>)" value="<?=$itmrow["pr_productname"]?>" autocomplete="off" class="form-control" name="productmlname[]" id="productmlname<?= $k ?>" placeholder="Product Name"></td>
										
                                        <td><input type="text" class="form-control" value="<?php $actl=$itmrow["pr_saleprice"];
										$totalvat=$rowitm["bi_vatamount"];
										$qnty=$rowitm["bi_quantity"];
										echo $actl-($totalvat/$qnty);
										?>" placeholder="Sale Price" name="saleprice[]" id="saleprice<?= $k ?>" onKeyUp="calculatetotal(<?= $k ?>)" style="width:80px;"></td>
										<td><input type="number" min="1" value="<?=$qnty?>" class="form-control" name="qty[]" onChange="calculatetotal(<?= $k ?>),sub_stock(this.value,<?=$k?>)" onKeyUp="calculatetotal(<?= $k ?>),sub_stock(this.value,<?=$k?>)" id="qty<?= $k ?>" placeholder="Qty" style="width:90px;">
                                        Avail Stock: <span id="availableqty<?= $k ?>"></span> Balance: <span id="bal<?=$k?>"></span>
                                        </td>
                                        <td>
                                        <input type="text"  value="<?=$rowitm["bi_vatper"]?>" readonly placeholder="Vat %" style="width:60px;" class="form-control" name="vatper[]" id="vatper<?= $k ?>"></td>
										
										<td>
                                        <input type="text" class="form-control" value="<?=$totalvat/$qnty?>" readonly placeholder="Vat amount" name="vatamnt[]" id="vatamnt<?= $k ?>" style="width:100px;"></td>
										<td>
                                        	<input readonly type="text" class="form-control" placeholder="Total" value="<?=$rowitm["bi_total"]?>" name="total[]" id="total<?= $k ?>" style="width:100px;">
                                            
                                            <input type="hidden" class="form-control" name="pretotal[]" id="pretotal<?= $k ?>" style="width:100px;">
                                            
                                        </td>
										<td>
										<div class="btn-group" role="group">
													<a href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" title="" onclick="removeproduct(<?= $k ?>)" class="btn btn-default btn-sm m-user-delete" data-original-title="Remove Product"><i class="fa fa-times" aria-hidden="true"></i></a>
										  </div>
										</td>
										</tr>
										<?php
										$k++;}
										?>
									</tbody>
									<tbody id="cartitems">
									</tbody>
                                    </table>
                                    <a href="javascript:void(0)" id="addrow" onClick="addproductfields()">add more...</a>
                    
                                    <table class="table">
                                    	<tr>
                                        <td align="right">Total Amount:</td>
                                        <td width="150"><input type="text" readonly value="<?=$row["be_total"]?>" class="form-control" name="totalprice" id="totalprice" placeholder="Total Amount" style="width:120px;">
                                        
                                        </td>
                                        </tr>
                                        <tr>
                                        <td align="right">Discount:</td>
                                        <td width="150"><input type="text" class="form-control" name="discount" id="discount" placeholder="Discount" value="<?=$row["be_discount"]?>" onChange="calculatedicounttotal()" onKeyUp="calculatedicounttotal()" style="width:120px;">
                                        
                                        </td>
                                        </tr>
                                        <tr>
                                        <td align="right">Paid Amount:</td>
                                        
                                        <td width="150"><input type="text" class="form-control" value="<?=$row["be_paidamount"]?>" name="paidamount" id="paidamount" onChange="calculatedicounttotal(2)"  onKeyUp="calculatedicounttotal(2)" placeholder="Paid Amount" required style="width:120px;">
                                        
                                        
                                        </td>
                                        </tr>
										<tr>
                                        <td align="right">Balance:</td>
                                        <td width="150"><input type="text" readonly class="form-control" value="<?=$row["be_balance"]?>" name="balance" id="balance" placeholder="Balance"  style="width:120px;">
                                        
                                        </td>
                                        </tr>
                                    </table>
                                       </div>
                                        
                                        <div class="form-group" align="right" style="padding-right:30px;">
                                        <label for="input-help-block" class="col-sm-2 control-label"></label>
                                        <button type="submit" name="submit" class="btn btn-primary">Update & Print</button>
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
		
		var k=<?=$k?>;
		/*if(k>=10){document.getElementById('addrow').style.display='none';}*/
function addproductfields()
{
	var fields = '<tr style="border-bottom:1px #EEE solid;" id="tr'+k+'"><td><input type="hidden" name="prodid[]" id="prodid'+k+'"><input type="text" onKeyUp="productcodesearch(this.value, '+k+')" autocomplete="off" class="form-control" name="productcode[]" id="productcode'+k+'" style="width:100px;" placeholder="Code"><div id="results'+k+'" class="secol" style="position: absolute; font-size: 12px; z-index: 999; width: 50%; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px; display: none; background-color: rgb(255, 255, 255);"><div class="secol" style="padding:5px;" id="serchreslt'+k+'"></div></div></td> <td><input type="text" autocomplete="off" class="form-control" onKeyUp="productsearch(this.value, '+k+')" name="productmlname[]" id="productmlname'+k+'" placeholder="Product Name"></td><td><input type="text" class="form-control" placeholder="Sale Price" name="saleprice[]" id="saleprice'+k+'" style="width:100px;"></td><td><input type="number" class="form-control" min="1" onChange="calculatetotal('+k+'),sub_stock(this.value,'+k+')" onKeyUp="calculatetotal('+k+'),sub_stock(this.value,'+k+')" name="qty[]" id="qty'+k+'" placeholder="Qty" style="width:100px;">Avail Stock: <span id="availableqty'+k+'"></span> Balance: <span id="bal'+k+'"></span></td><td><input type="text" readonly placeholder="Vat %" style="width:60px;" class="form-control" name="vatper[]" id="vatper'+k+'"></td><td><input type="text" class="form-control" readonly placeholder="Vat amount" name="vatamnt[]" id="vatamnt'+k+'" style="width:100px;"></td><td><input readonly type="text" class="form-control" placeholder="Total" name="total[]" id="total'+k+'" style="width:100px;"><input type="hidden" class="form-control" name="pretotal[]" id="pretotal'+k+'" style="width:100px;"></td><td><div class="btn-group" role="group"><a href="#" data-toggle="tooltip" data-placement="bottom" title="" onclick="removeproduct('+k+')" class="btn btn-default btn-sm m-user-delete" data-original-title="Remove Product"><i class="fa fa-times" aria-hidden="true"></i></a></div></td></tr>';
	$('#cartitems').append(fields);
	k = k+1;
	/*if(k>=10){document.getElementById('addrow').style.display='none';}*/
}

function addtoproduct(prodid, prodcode, enname, purprice, saleprice, stock, num, vat)
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
	
	
	$('#availableqty'+num).html(stock);
	$('#bal'+num).html(Number(stock)-1);
	$('#qty'+num).val(1);
	$('#vatper'+num).val(vat);
	
	var vtamnt = (Number(vat)/(Number(vat)+100))*Number(saleprice);
	var product_prive =(Number(saleprice) - Number(vtamnt)).toFixed(2);
	$('#saleprice'+num).val(product_prive);
	var tot = Number(saleprice);
	$('#total'+num).val(tot);
	$('#vatamnt'+num).val(vtamnt.toFixed(2));
	
	if($('#totalprice').val() == "")
	{
		$('#totalprice').val(tot);
		
		$('#paidamount').val(Number(tot)-Number(discount));
	}
	else{
		var total = Number($('#totalprice').val())+Number(tot);
		$('#totalprice').val(total);
		
		$('#paidamount').val(Number(total)-Number(discount));
	}
	
	
	
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
		var total = Number(qty)*(Number(prce)+Number(vtamnt.toFixed(2)));
		var total = Math.round(total);
		var totamnt = Number(total.toFixed(2));
				
		var lastotal = Number(minustotal) + Number(totamnt);
		$('#vatamnt'+num).val(ttl_vat.toFixed(2))
		$('#totalprice').val(lastotal);
		$('#total'+num).val(totamnt);
		$('#pretotal'+num).val(totamnt);
		
		var paidamnt = Number(lastotal) - Number(discount);
		$('#paidamount').val(paidamnt);
	}
}
function calculatedicounttotal(cat)
{
	var paidamount = $('#paidamount').val();
	var discount = $('#discount').val();
	var totalprice = $('#totalprice').val();
	
	if(cat==2)
	{
	
	var paidamnt = Number(totalprice) - Number(discount) - Number(paidamount);
	$('#balance').val(paidamnt);
	}
	if(cat==1)
	{
		
		var paidamnt = Number(totalprice) - Number(discount);
	$('#paidamount').val(paidamnt);
		
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

		</script>
    </body>

</html>
<?php
}else{
	header("Location:index.php");
}
?>