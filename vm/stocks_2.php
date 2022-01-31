<?php
session_start();
if(isset($_SESSION['admin']))
{
	include("includes/config.php");
	if(isset($_POST['updateprdct']))
	{
		$page=$_GET["p"];
     $count=$_GET["shw"];
		$productid = $_POST['productid'];
		$purchaseprice = $_POST['purchaseprice'];
		$saleprice = $_POST['saleprice'];
		//$retail=$_POST['retail'];
		//$wholesale=$_POST['wholesale'];
		$stock = $_POST['stock'];
		$productcode=$_POST['productcode'];
		$productname=$_POST['productname'];
		$hsn=$_POST['hsn'];
		$type=$_POST['type'];
		$unittype=$_POST['unittype'];
		$per=$_POST['percentage'];
		$updte = $conn->query("UPDATE vm_products SET pr_purchaseprice='$purchaseprice', pr_saleprice='$saleprice',  pr_stock='$stock', pr_productcode='$productcode', pr_productname='$productname', pr_hsn='$hsn', pr_type='$type',pr_unit='$unittype',pr_pecentage='$per' WHERE pr_productid='$productid'");
		if($updte)
		{
			header('Location:stocks.php?shw='.$count.'&p='.$page.'&id=success');
		}
	  else{
		 header('Location:stocks.php?shw='.$count.'&p='.$page.'&id=fail');
		}

	}
	if(isset($_GET["delete"]))
	{
		$pid=$_GET["pid"];
		$count=$_GET["show"];
		$page=$_GET["p"];
		$delete=$conn->query("UPDATE vm_products SET pr_isactive='1' WHERE pr_productid='$pid'");
		if($delete)
		{
		header('Location:stocks.php?shw='.$count.'&p='.$page.'&id=success');
	  }
	  else{
		  header('Location:stocks.php?shw='.$count.'&p='.$page.'&id=fail');
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
        
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
        <link href="assets/plugins/pace-master/themes/blue/pace-theme-flash.css" rel="stylesheet"/>
        <link href="assets/plugins/uniform/css/uniform.default.min.css" rel="stylesheet"/>
        <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/fontawesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/line-icons/simple-line-icons.css" rel="stylesheet" type="text/css"/>	
        <link href="assets/plugins/offcanvasmenueffects/css/menu_cornerbox.css" rel="stylesheet" type="text/css"/>	
        <link href="assets/plugins/waves/waves.min.css" rel="stylesheet" type="text/css"/>	
        <link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/3d-bold-navigation/css/style.css" rel="stylesheet" type="text/css"/>	
        <link href="assets/plugins/slidepushmenus/css/component.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/datatables/css/jquery.datatables.min.css" rel="stylesheet" type="text/css"/>	
        <link href="assets/plugins/datatables/css/jquery.datatables_themeroller.css" rel="stylesheet" type="text/css"/>	
        <link href="assets/plugins/x-editable/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet" type="text/css">
        <link href="assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" type="text/css"/>
        
        <!-- Theme Styles -->
        <link href="assets/css/modern.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/themes/green.css" class="theme-color" rel="stylesheet" type="text/css"/>
        <link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>
        
        <script src="assets/plugins/3d-bold-navigation/js/modernizr.js"></script>
        <script src="assets/plugins/offcanvasmenueffects/js/snap.svg-min.js"></script>
        
                        
    </head>
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
body{ 
zoom:85%;
}

	</style>
    
    
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
                    <h3><strong>Stocks</strong></h3>
                    <div class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li>Billing</li>
                            <li class="active">Stocks</li>
                        </ol>
                    </div>
                </div>
                <?php
				$today = date('Y-m-d');
				$stocks = $conn->query("SELECT * FROM vm_products WHERE user_id='".$_SESSION['admin']."' and pr_isactive='0' ORDER BY pr_productcode ASC");
				
				
				?>
                <div id="main-wrapper">
                	
                    <!-- Row -->
                    <div class="row">
                        
                        <div class="col-lg-12 col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h4 class="panel-title">Stocks</h4>
                                    <a href="addstocks.php"><button type="button" class="btn btn-primary btn-addon m-b-sm" style="float:right"><i class="fa fa-plus"></i> Add New Products</button></a>
                                </div>
                                <div class="panel-heading">
                                    <a href="stocksexport.php"><button type="button" class="btn btn-primary btn-addon m-b-sm" style="float:right"> EXPORT</button></a>
                                     <a href="exportstock.php"><button type="button" class="btn btn-primary btn-addon m-b-sm" style="float:right;margin-right:10px;"> Print</button></a>
                                </div>
                                <?php
								if(isset($_GET['id']))
								{
									if($_GET["id"]=="success")
									{
									?>
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        Stock details added successfully.
                                    </div>
                                    <?php
								}}
								?>
                                <div class="panel-body">
                                   <div class="container-fluid">
                                     
                                      
                            <div id="ks-datatable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"><div class="dataTables_length" id="ks-datatable_length"><label>Show <select name="ks-datatable_length" onchange="location = this.value;" aria-controls="ks-datatable" class="form-control input-sm">
                            <option <?php if(isset($_GET["shw"])){if($_GET["shw"]==10){echo"selected";}}?> value="stocks.php?shw=10&<?php if(isset($_GET["p"])){echo "p=".$_GET["p"]."&";}?><?php if(isset($_GET["search"])){echo "search=".$_GET["search"]."&";}?>">10</option>
                            <option <?php if(isset($_GET["shw"])){if($_GET["shw"]==25){echo"selected";}}?> value="stocks.php?shw=25&<?php if(isset($_GET["p"])){echo "p=".$_GET["p"]."&";}?><?php if(isset($_GET["search"])){echo "search=".$_GET["search"]."&";}?>">25</option>
                            <option <?php if(isset($_GET["shw"])){if($_GET["shw"]==50){echo"selected";}}?> value="stocks.php?shw=50&<?php if(isset($_GET["p"])){echo "p=".$_GET["p"]."&";}?><?php if(isset($_GET["search"])){echo "search=".$_GET["search"]."&";}?>">50</option>
                            <option <?php if(isset($_GET["shw"])){if($_GET["shw"]==100){echo"selected";}}?> value="stocks.php?shw=100&<?php if(isset($_GET["p"])){echo "p=".$_GET["p"]."&";}?><?php if(isset($_GET["search"])){echo "search=".$_GET["search"]."&";}?>">100</option>
                            </select> entries</label></div></div><div class="col-sm-12 col-md-6"><div id="ks-datatable_filter" class="dataTables_filter"><form action="stocks.php"><label>Search:<input autocomplete="off" name="search" type="search" id="search" class="form-control input-sm" onKeyUp="productsearch(this.value,1)" placeholder="" aria-controls="ks-datatable" style="width:250px;"></label>
                            <div id="results1" class="secol" style="font-size: 12px;position: absolute; z-index: 999; width: 50%; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px; display: none;max-height: 200px;overflow:scroll; background-color: rgb(255, 255, 255);right: 0;"><div class="secol" style="padding:5px;" id="serchreslt1"></div></div>
                            </form></div></div> <br>
                            <div class="row"><div class="col-sm-12">
                           <div class="table-responsive">
						   <table id="ks-datatable" class="table" width="100%" role="grid" aria-describedby="ks-datatable_info" style="width: 100%;">
                                           <thead>
                                               <tr>
                                                   <th>#</th>
                                                   <th>Product Code</th>
												   <th>Product Name</th>
                                                   <th>HSN Number</th>
                                                   <th>Type</th>
												   <th>Unit</th>
                                                   <th>Purchase Price</th>
                                                   <th>Profit Percentage</th>
                                                   <th>Sale Price</th>
												   <!--<th>Retail Price</th>
												   <th>Whole Sale Price</th>-->
                                                   <th>Stock</th>
                                                   <th>Amount</th>
												   <th>PR Rate</th>
												   <th></th>
                                               </tr>
                                           </thead>
                                           <tbody>
                                           <?php
										   if(isset($_GET["shw"]))
										   {
											   $shw=$_GET["shw"];
										   }else{
											   $shw=10;
										   }
										   
										   if(isset($_GET["p"]))
										   {
											   $p=$_GET["p"];
											   $strt=$p*$shw;
										   }else
										   {
											$p=0;
										   $strt=0;
										   }
												$today = date('Y-m-d');
												if(isset($_GET["search"]))
												{
												$key=$_GET["search"];
												$stocks = $conn->query("SELECT * FROM vm_products WHERE user_id='".$_SESSION['admin']."' AND pr_isactive='0' AND ( pr_productcode LIKE '$key%' OR pr_productname LIKE '$key%' OR pr_hsn LIKE '$key%') ORDER BY pr_productcode ASC LIMIT ".$strt.",".$shw."");	
												}else
												{
												$stocks = $conn->query("SELECT * FROM vm_products WHERE user_id='".$_SESSION['admin']."' AND pr_isactive='0' ORDER BY pr_productcode ASC LIMIT ".$strt.",".$shw."");
												}
											   
											   $today = date('Y-m-d');
											   $total=0;
											   if(mysqli_num_rows($stocks)>0)
											   {
												   $k =  $strt+1;
												   
												   while($row = $stocks->fetch_assoc())
												   {
											   ?>
                                              <form action="<?= $_SERVER['PHP_SELF'] ?>?shw=<?=$shw?>&p=<?=$p?>" method="post" name="updform<?= $k ?>">
                                               <tr>
                                               
                                                   <th scope="row">
												    
                                               <input type="hidden" name="productid" value="<?= $row['pr_productid'] ?>">
												   <?= $k ?></th>
                                                   <td><input type="text" class="form-control" name ="productcode" style="width :100px;"  value="<?= $row['pr_productcode'] ?>"></td>
                                                    <td>
                                                   <input type="text" class="form-control" name="productname" style="width:300px;" value="<?= $row['pr_productname'] ?>">
                                                   </td>
												   <td>
                                                   <input type="text" class="form-control" name="hsn" style="width:100px;" value="<?= $row['pr_hsn'] ?>">
                                                   </td>
												   <td><select name="type" id="type<?= $k ?>" class="form-control" style="width:100px;">
													<?php
													$type = $row['pr_type'];
													$sql1="SELECT * FROM vm_catogory " ;
													$sql= $conn->query("$sql1");
                                        
													while($rowcat=$sql->fetch_assoc())
													{?>
                                                
													<option <?php
															if($rowcat["ca_categoryid"]==$type)
																{?>selected <?php }?> value="<?=$rowcat["ca_categoryid"]?>"><?=$rowcat["ca_categoryname"]?>
																
															</option>
													<?php }?>
													</select>
												   
                                                   
                                                   </td>
												   	<td>
														<select name="unittype" id="unit<?=$k?>" class="form-control" style="width:100px;">
														
														   <option <?php  if($row['pr_unit']=='Piece'){ ?> selected  <?php } ?> value="Piece">Pieces</option>
															<option <?php  if($row['pr_unit']=='Kg'){ ?> selected  <?php } ?> value="Kg">Kilogram</option>
															<option <?php  if($row['pr_unit']=='Sqft'){ ?> selected  <?php } ?> value="Sqft">Sqft</option>
															<option <?php  if($row['pr_unit']=='M'){ ?> selected  <?php } ?> value="M">Metre</option>
															<option <?php  if($row['pr_unit']=='Nos.'){ ?> selected  <?php } ?> value="Nos.">Number</option>
															<option <?php  if($row['pr_unit']=='Bag'){ ?> selected  <?php } ?> value="Bag">Bag</option>
															<option <?php  if($row['pr_unit']=='Lt'){ ?> selected  <?php } ?> value="Lt">Litre</option>
															
															</select>
												   
												  
												   </td>
                                                  
                                                   <td><input type="text" class="form-control" id="price<?=$k?>" name="purchaseprice" style="width: 60px;" value="<?= $row['pr_purchaseprice'] ?>" onChange="calcsale(<?=$k?>)"></td>
                                                  <td><input type="text"  class="form-control" placeholder="%" value="<?= $row['pr_pecentage'] ?>" name="percentage" onKeyUp="calcsale(<?=$k?>)" id="pertg<?=$k?>" style="width:50px;"></td>
                                                   <td>
                                                       <input type="text" class="form-control" name="saleprice" id="saleprice<?=$k?>" style="width: 60px;" value="<?= $row['pr_saleprice'] ?>">
                                                   </td>
												   <td style="display:none;">
                                                       <input type="text" class="form-control" name="retail" style="width: 60px;" value="<?= $row['pr_retail'] ?>">
                                                   </td>
												  <!-- <td>
                                                       <input type="text" name="wholesale" style="width: 60px;" value="<?= $row['pr_wholesale'] ?>">
                                                   </td>-->
                                                   <td>
                                                   	<input type="text" class="form-control" name="stock" style="width: 60px;" value="<?= $row['pr_stock'] ?>">
                                                   </td>
												   <td><?php $ttl=$row['pr_purchaseprice']*$row['pr_stock'];echo $ttl; $total=$total+$ttl; ?></td>
                                                                  
                                                   
												   <td>
												   
												   
												   <?php
												   if($row['pr_stock'] <= 0)
												   {
													   ?>
                                                       <span class="label label-danger">Out of Stock</span>
                                                       <?php
												   }
												   
												   else{
												   ?>
                                                   	<span class="label label-success">In Stock</span>
                                                    <?php
												   }
													?>
                                                    <input type="hidden" name="page" value="<?=$_GET["p"]?>">
                                                    <button type="submit" name="updateprdct" onClick="return confirm('Are you sure you want to update?')" style="float: right;" class="btn btn-primary btn-addon  btn-xs"><i class="fa fa-plus"></i> Update</button><br>
                                                    <a onClick="return confirm('Are you sure you want to Delete?')" href="stocks.php?pid=<?=$row['pr_productid']?>&show=<?php if(isset($_GET["shw"])){echo $_GET["shw"];}else{echo 10;}?>&p=<?php if(isset($_GET["p"])){echo $_GET["p"];}else{echo 0;}?>&delete"><button type="button"  style="float: right;" class="btn btn-primary btn-addon  btn-xs"><i class="fa fa-plus"></i> Delete</button></a>
                                                    </td>
													
                                               </tr>
                                               </form>
                                               <?php
											   $k++;
												   }
											   }
											   ?>
						                  </tbody>
                                          <tfoot>
										  <tr>
										  <td colspan="8" align="right"><b>Page Total</b></td>
									   	   <td colspan="3"><?php echo $total; ?></td>
										  </tr>
                                          <tr>
										  <td colspan="8" align="right"><b> Total</b></td>
									   	   <td colspan="3"><?php 
										   if(isset($_GET["search"]))
							{
							$key=$_GET["search"];
							$sum = $conn->query("SELECT SUM(pr_purchaseprice*pr_stock) AS pr_count FROM vm_products WHERE user_id='".$_SESSION['admin']."' AND pr_isactive='0' AND ( pr_productcode LIKE '$key%' OR pr_productname LIKE '$key%' OR pr_hsn LIKE '$key%')");
							}else
							{
							$sum = $conn->query("SELECT SUM(pr_purchaseprice*pr_stock) AS pr_count FROM vm_products WHERE user_id='".$_SESSION['admin']."' AND pr_isactive='0'");
							}$row_sum=$sum->fetch_assoc();echo round_up($row_sum["pr_count"],2);
										    ?></td>
										  </tr>
                                          </tfoot>
                                        </table>
										</div>
                            </div></div><div class="row">
                            <?php
							if(isset($_GET["search"]))
							{
							$key=$_GET["search"];
							$cnt = $conn->query("SELECT COUNT(*) AS pr_count FROM vm_products WHERE user_id='".$_SESSION['admin']."' AND pr_isactive='0' AND ( pr_productcode LIKE '$key%' OR pr_productname LIKE '$key%' OR pr_hsn LIKE '$key%')");
							}else
							{
							$cnt = $conn->query("SELECT COUNT(*) AS pr_count FROM vm_products WHERE user_id='".$_SESSION['admin']."' AND pr_isactive='0'");
							}
							if($cnt->num_rows>0){
							$row_cnt=$cnt->fetch_assoc();
							$cnt=$row_cnt["pr_count"];
							$pg=pagecount($cnt,$shw);
							?>
                            <div class="col-sm-12 col-md-5"></div>
                            <div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="ks-datatable_paginate">
                            <ul class="pagination">
                            <?php
							$blk=$p+1;
							if(($blk-2)>0)
							{
							?>
                            <li class="paginate_button page-item"><a href="stocks.php?p=0<?php if(isset($_GET["search"])){echo "&search=".$_GET["search"];}?><?php if(isset($_GET["shw"])){echo "&shw=".$_GET["shw"];}?>" aria-controls="ks-datatable" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                            <?php 
							}
							if(($blk-3)>0)
							{
							?>
                            <li class="paginate_button page-item disabled"><a href="#" aria-controls="ks-datatable" data-dt-idx="1" tabindex="0" class="page-link">...</a></li>
                            <?php 
							}
							for($i=0;$i<$pg-1;$i++)
							{
								$j=$p-$i;
								$j=abs($j);
								if($j<2)
								{
							?>
                            <li class="paginate_button page-item <?php if($p==$i){?>active<?php }?>"><a href="stocks.php?p=<?=$i?><?php if(isset($_GET["search"])){echo "&search=".$_GET["search"];}?><?php if(isset($_GET["shw"])){echo "&shw=".$_GET["shw"];}?>" aria-controls="ks-datatable" data-dt-idx="1" tabindex="0" class="page-link"><?=$i+1?></a></li>
                            <?php }}?>
                            <?php
							
							$blk=$pg-$p;
							if($blk>3){
							?>
                            <li class="paginate_button page-item disabled"><a href="#" aria-controls="ks-datatable" data-dt-idx="1" tabindex="0" class="page-link">...</a></li>
							<?php }?>
                            <li class="paginate_button page-item <?php if($p==($pg-1)){?>active<?php }?>"><a href="stocks.php?p=<?=$pg-1?><?php if(isset($_GET["search"])){echo "&search=".$_GET["search"];}?><?php if(isset($_GET["shw"])){echo "&shw=".$_GET["shw"];}?>" aria-controls="ks-datatable" data-dt-idx="1" tabindex="0" class="page-link"><?=$pg?></a></li>
							
							
                            
                           
                            </ul>
							<br>
							<form action="stocks.php" method="get">
							<label >Jump To</label><input name="p" class="form-control" style="width: 100px;float:right">
							</form>
                            </div>
                            </div>
                            </div><?php }?>
                            </div>
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
        
        <div class="cd-overlay"></div>
	

        <!-- Javascripts -->
        <script src="assets/plugins/jquery/jquery-2.1.4.min.js"></script>
        <script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
        <script src="assets/plugins/pace-master/pace.min.js"></script>
        <script src="assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <script src="assets/plugins/switchery/switchery.min.js"></script>
        <script src="assets/plugins/uniform/jquery.uniform.min.js"></script>
        <script src="assets/plugins/offcanvasmenueffects/js/classie.js"></script>
        <script src="assets/plugins/offcanvasmenueffects/js/main.js"></script>
        <script src="assets/plugins/waves/waves.min.js"></script>
        <script src="assets/plugins/3d-bold-navigation/js/main.js"></script>
        <script src="assets/plugins/jquery-mockjax-master/jquery.mockjax.js"></script>
        <script src="assets/plugins/moment/moment.js"></script>
        <script src="assets/plugins/datatables/js/jquery.datatables.min.js"></script>
        <script src="assets/plugins/x-editable/bootstrap3-editable/js/bootstrap-editable.js"></script>
        <script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script src="assets/js/modern.min.js"></script>
        <script src="assets/js/pages/table-data.js"></script>
 
<script type="application/javascript">
(function ($) {
    $(document).ready(function() {
        $('#ks-datatable-1').DataTable({
            "initComplete": function () {
                $('.dataTables_wrapper select').select2({
                    minimumResultsForSearch: Infinity
                });
            }
        });

        
    });
})(jQuery);
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
function calcsale(num)
{
	var puprice=$('#price'+num).val();
	var pertg=$('#pertg'+num).val();
	
	var sale=Number(puprice)+((Number(puprice)*Number(pertg))/100);
	$('#saleprice'+num).val(sale.toFixed(2));
}
function addtoproduct(prodid, prodcode, enname, purprice, saleprice, stock, num, vat,unit)
{
	$('#search').val(enname);
	document.getElementById('results'+num).style.display='none';
	$('#search').focus();
}

</script> 
    </body>

</html>
<?php
}else{
	header("Location:index.php");
}
?>