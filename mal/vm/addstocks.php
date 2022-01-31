<?php
session_start();
if(isset($_SESSION['admin']))
{
	include("includes/config.php");
	
	if(isset($_POST['submit']))
	{
		$productcode = $_POST['productcode'];
		$productname = $_POST['productname'];
		$hsn=$_POST['hsn'];
		$price = $_POST['price'];
		$saleprice = $_POST['saleprice'];
		$qty = $_POST['qty'];
		$type = $_POST['type'];
		$unittype=$_POST['unittype'];
		$check=mysqli_query($conn,"SELECT * FROM  vm_products WHERE pr_productcode='$productcode'");
        $checkrows=mysqli_num_rows($check);
		
		$k=0;
		
		
		 if($checkrows>0) {
      echo "customer exists";
}
else
{

		
		foreach($productname as $prdctval)
		{
			if($prdctval!='')
			{
				
				
				

				

  
			$sql= $conn->query("INSERT INTO vm_products(pr_productcode, pr_productname, pr_hsn, pr_purchaseprice, pr_saleprice, pr_stock, pr_updateddate, pr_type,pr_unit, user_id) VALUES('$productcode[$k]', '$prdctval','$hsn[$k]', '$price[$k]', '$saleprice[$k]', '$qty[$k]', NOW(), '$type[$k]','$unittype[$k]','".$_SESSION["admin"]."')");
			
			}
			$k++;
		}
			
		}
	if($sql)
	 {
		 header('Location:stocks.php?id=success');
		 //error_reporting(E_ALL);
	  }
	  else{
		  header('Location:stocks.php?id=fail');
		 //error_reporting(E_ALL);
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
        <link href="assets/plugins/summernote-master/summernote.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" type="text/css"/>
        
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
                    <h3>ആഡ് സ്റ്റോക്‌സ്</h3>
                    <div class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li><a href="dashboard.php">ബില്ലിംഗ്</a></li>
                            <li class="active">ആഡ് സ്റ്റോക്‌സ്</li>
                        </ol>
                    </div>
                </div>
                <?php
				$today = date('Y-m-d');
				$stdos = $conn->query("SELECT * FROM vm_products WHERE user_id='".$_SESSION["admin"]."' ORDER BY pr_productcode ASC");
				
				?>
                <div id="main-wrapper">
                    <!-- Row -->
                    <div class="row">
                        
                        <div class="col-lg-12 col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h4 class="panel-title">ആഡ് സ്റ്റോക്‌സ്</h4>
                                    
                                    <a href="stocks.php"><button type="button" class="btn btn-primary btn-addon m-b-sm btn-sm" style="float:right"><i class="fa fa-backward"></i> ബാക്ക്</button></a>
                                </div>
                                <div class="panel-body">
                                <?php
								if(isset($_GET['id']))
								{
									?>
                                    <div class="alert alert-danger alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
											എറർ ഒക്യൂർഡ്, പ്ളീസ് ട്രൈ എഗൈൻ.
                                    </div>
                                    <?php
								}
								?>
                                    <form class="form-horizontal" name="addstudio" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
                                    <div class="table-responsive">
                                    <table class="table" id="drgcartitms">
                                    <thead>
                                    <tr>
                                        <th>പ്രോഡക്റ്റ് കോഡ്</th>
                                        <th>പ്രോഡക്റ്റ് നെയിം</th>
										<th>എച് എസ് എൻ നമ്പർ</th>
                                        <th>ടൈപ്പ്</th>
										<th>യൂണിറ്റ്</th>
                                        <th>പർച്ചേയ്‌സ് പ്രൈസ്</th>
                                        <th>സെയിൽ  പ്രൈസ്</th>
                                        <th>സ്റ്റോക്ക്</th>
                                                        
                                        <th></th>
                                    </tr>
                                    </thead>
                                    
                                    <tbody>
									
									<?php
									     
										$k=1;
										//for($k=1; $k<4; $k++)
										//{
										?>
										<tr style="border-bottom:1px #EEE solid;" id="tr<?= $k ?>">
										
										<td>
										<?php
										
										$slct=$conn->query("SELECT * FROM vm_products WHERE pr_isactive='0' ORDER BY pr_productcode DESC LIMIT 1");
										 $row=$slct->fetch_assoc();
										 $proc=$row['pr_productcode'];
										 $pron=$row['pr_productname'];
										   
										?>
                                        <input type="hidden" name="prodid[]" id="prodid<?= $k ?>">
											
											<input type="text" required autocomplete="off" class="form-control" name="productcode[]" id="productcode<?= $k ?>" onChange="checkcode(this.value,<?=$k?>)" style="width:105px;" placeholder="<?php echo $proc ?>">
                                               <span id="usermsg<?=$k?>" style="color:#F00;"></span>
										</td>
                                        <td><input type="text" required autocomplete="off" class="form-control" name="productname[]" id="productname<?= $k ?>" placeholder="<?php echo $pron ?>" style="width:105px;"> 
										</td>
										 <td><input type="text" required autocomplete="off" class="form-control" name="hsn[]" id="hsn<?= $k ?>" placeholder="എച് എസ് എൻ കോഡ് " style="width:105px;"> 
										</td>
                                       
										<td>
                                        	<select name="type[]" id="type<?= $k ?>" class="form-control" style="width:100px;">
                                             <?php
                                             $sql1="SELECT * FROM vm_catogory  WHERE user_id='".$_SESSION["admin"]."'" ;
                                              $sql= $conn->query("$sql1");
                                        
												while($rowcat=$sql->fetch_assoc())
                                                {?>
                                                
                                            	<option value="<?=$rowcat["ca_categoryid"]?>"><?=$rowcat["ca_categoryname"]?></option>
                                                <?php }?>
                                            </select>
                                        </td>
										<td>
											<select class="form-control" name="unittype[]" id="unit<?=$k?>" required style="width:100px;">
												<option value="Piece">Pieces</option>
												<option value="Kg">Kilogram</option>
												<option value="Sqft">Sqft</option>
												<option value="M">Metre</option>
												<option value="Nos.">Number</option>
												<option value="Bag">Bag</option>
												<option value="Lt">Litre</option>
											</select>
										</td>
										<td><input type="text" required class="form-control" placeholder="പ്രൈസ്" name="price[]" id="price<?= $k ?>" style="width:100px;"></td>
                                        <td><input type="text" required class="form-control" placeholder="സെയിൽ  പ്രൈസ്" name="saleprice[]" id="saleprice<?= $k ?>" style="width:100px;"></td>
										<td><input type="number" step="any" class="form-control" name="qty[]" onChange="calculatetotal(<?= $k ?>)" onKeyUp="calculatetotal(<?= $k ?>)" value="1" id="qty<?= $k ?>" placeholder="ക്വാണ്ടിറ്റി " style="width:100px;"></td>
                                        
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
                                    <a href="javascript:void(0)" onClick="addproductfields()">ആഡ് മോർ ...</a>
                    
                                    <!--<table class="table">
                                        <td align="right">Total Amount:</td>
                                        <td width="150"><input type="text" readonly class="form-control" name="totalprice" id="totalprice" placeholder="Total Amount" style="width:120px;"></td>
                                    </table>-->
                                       
                                        
                                        <div class="form-group" align="right" style="padding-right:30px;">
                                        <label for="input-help-block" class="col-sm-2 control-label"></label>
                                        <button type="submit" id="save" name="submit" class="btn btn-primary">സബ്‌മിറ്റ്</button>
                                        </div>
                                     </form>
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
        
        <script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script src="assets/plugins/summernote-master/summernote.min.js"></script>
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
		
		var k=2;
function addproductfields()
{
	var fields = '<tr style="border-bottom:1px #EEE solid;" id="tr'+k+'"><td><input type="hidden" name="prodid[]" id="prodid'+k+'"><input type="text" autocomplete="off" class="form-control" name="productcode[]" id="productcode'+k+'" onChange="checkcode(this.value,'+k+')" placeholder="കോഡ്" style="width:105px;"><span id="usermsg'+k+'" style="color:#F00;"></span></td> <td><input type="text" autocomplete="off" class="form-control" name="productname[]" id="productname'+k+'" placeholder="പ്രോഡക്റ്റ് നെയിം"></td><td><input type="text" required autocomplete="off" class="form-control" name="hsn[]" id="hsn'+k+'" placeholder="എച് എസ് എൻ  കോഡ്"></td><td><select name="type[]" id="type'+k+'" class="form-control"><?php $sql1="SELECT * FROM vm_catogory  WHERE user_id='".$_SESSION["admin"]."'" ;$sql= $conn->query("$sql1");while($rowcat=$sql->fetch_assoc()) { ?><option value="<?=$rowcat["ca_categoryid"]?>"><?=$rowcat["ca_categoryname"]?></option><?php } ?></select></td><td><select class="form-control" name="unittype[]" id="unit'+k+'" required style="width:100px;"><option value="Piece">Pieces</option><option value="Kg">Kilogram</option><option value="Sqft">Sqft</option><option value="M">Metre</option><option value="Nos.">Number</option><option value="Bag">Bag</option><option value="Lt">Litre</option></select></td><td><input type="text" class="form-control" placeholder="പ്രൈസ്" name="price[]" id="price'+k+'" style="width:100px;"></td><td><input type="text" class="form-control" placeholder="സെയിൽ പ്രൈസ്" name="saleprice[]" id="saleprice'+k+'" style="width:100px;"></td><td><input type="number" class="form-control" step="any" value="1" onChange="calculatetotal('+k+')" onKeyUp="calculatetotal('+k+')" name="qty[]" id="qty'+k+'" placeholder="ക്വാണ്ടിറ്റി " style="width:100px;"></td><td><div class="btn-group" role="group"><a href="#" data-toggle="tooltip" data-placement="bottom" title="" onclick="removeproduct('+k+')" class="btn btn-default btn-sm m-user-delete" data-original-title="Remove Product"><i class="fa fa-times" aria-hidden="true"></i></a></div></td></tr>';
	$('#cartitems').append(fields);
	k = k+1;
}

function addtoproduct(prodid, mlname, enname, purprice, saleprice, unt, stock, num)
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
	$('#productname'+num).val(enname);
	$('#productmlname'+num).val(mlname);
	$('#price'+num).val(purprice);
	$('#saleprice'+num).val(saleprice);
	$('#unit'+num).val(unt);
	$('#prestock'+num).val(stock);
	
	$('#productname'+num).attr('readonly', true);
	$('#productmlname'+num).attr('readonly', true);
	
	/*if($('#totalprice').val() == "")
	{
		$('#totalprice').val(price);
	}
	else{
		var total = Number($('#totalprice').val())+Number(price);
		$('#totalprice').val(total);
	}*/
	
	document.getElementById('results'+num).style.display='none';
	}else{
		alert("Product already selected.");
	}
}

function removeproduct(num)
{
	if(confirm("Are you sure?"))
	{
		var deltotal = $('#total'+num).val();
		var minustotal = Number($('#totalprice').val()) - Number(deltotal);
		$('#totalprice').val(minustotal);
		$('table#drgcartitms tr#tr'+num).remove();
	}
}
function checkcode(un,k)
{
	
	if(un=='')
	{
		$("#usermsg"+k).html("");
		$("#save").prop("disabled", false);
		return
	}else
	{
	$.post("checkcode.php", {productcode: un}, function(result){
        if(result=="success")
		{
			$("#usermsg"+k).html("");
			$("#save").prop("disabled", false);
			return;
		}
		else{
		$("#usermsg"+k).html("Product Code Already Exist");
		$("#save").attr("disabled",true)
		}
		
    });
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