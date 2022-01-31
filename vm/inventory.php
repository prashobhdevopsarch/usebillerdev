<?php
session_start();
if(isset($_SESSION['admin']))
{
	include("includes/config.php");
	if(isset($_POST['updateprdct']))
	{
		$productid = $_POST['productid'];
		$purchaseprice = $_POST['purchaseprice'];
		$saleprice = $_POST['saleprice'];
		$stock = $_POST['stock'];
		$productcode=$_POST['productcode'];
		$productname=$_POST['productname'];
		$type=$_POST['type'];
		$unittype=$_POST['unittype'];
		$kgwise=$unittype * $stock;
		$updte = $conn->query("UPDATE us_products SET pr_purchaseprice='$purchaseprice', pr_saleprice='$saleprice', pr_stock='$stock', pr_productcode='$productcode', pr_productname='$productname', pr_type='$type',pr_unit='$unittype',pr_kgwise='$kgwise' WHERE pr_productid='$productid'");
		if($updte)
		{
			header('Location:stocks.php?id=success');
	  }
	  else{
		  header('Location:stocks.php?id=fail');
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
                    <h3><strong>Inventory</strong></h3>
                    <div class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li>Billing</li>
                            <li class="active">Inventory</li>
                        </ol>
                    </div>
                </div>
                <?php
				$today = date('Y-m-d h:i');
				
				$stocks = $conn->query("SELECT * FROM us_products WHERE user_id='".$_SESSION['admin']."' ORDER BY pr_updateddate DESC");
				
				    //$time=date('d-m-Y H:i',strtotime($row[" pr_updateddate"]);                     
				?>
                <div id="main-wrapper">
                	
                    <!-- Row -->
                    <div class="row">
                        
                        <div class="col-lg-12 col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h4 class="panel-title">Stocks</h4>
                                    
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
                                    <div class="table-responsive project-stats">  
                                       <table id="example" class="display table" style="width: 100%; cellspacing: 0;">
                                           <thead>
                                               <tr>
                                                   <th>#</th>
                                                   <th style="width: 100px;">Product Code</th>
												   <th style="width:100px;">Product Name</th>
                                                   <th>Type</th>
												   <th style="width: 100px;">Unit</th>
                                                   
                                                  <!-- <th>Purchase Price</th>
                                                   <th>Selling Price-Retail</th>
                                                    <th>Selling Price-Wholesale</th>-->
                                                   <th style="width: 100px;">Opening Stock ( Kg )</th>
												   <th style="width: 150px;">Opening Stock ( Bag )</th>
                                                   <th style="width: 100px;">Closing Stock ( Kg )</th>
												   <th style="width: 150px;">Closing Stock ( Bag )</th>
                                                  <!-- <th>Amount</th>-->
												   <th style="width: 100px;"></th>
                                               </tr>
                                           </thead>
                                           <tbody>
                                               <?php
											   $today = date('Y-m-d');
											   if(mysqli_num_rows($stocks)>0)
											   {
												   $k = 1;
												   $total=0;
												   while($row = $stocks->fetch_assoc())
												   {
											   ?>
                                              
                                               <tr>
                                               <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" name="updform<?= $k ?>">
                                                   <th scope="row">
												    
                                               <input type="hidden" name="productid" value="<?= $row['pr_productid'] ?>">
												   <?= $k ?></th>
                                                   <td><?= $row['pr_productcode'] ?> </td>
												   <td><?= $row['pr_productname'] ?> 
                                                  
                                                   </td>
                                                   <?php
												   $type = $row['pr_type'];
                                                   $sql1="SELECT * FROM us_catogory " ;
													$sql= $conn->query("$sql1");
                                        
													while($rowcat=$sql->fetch_assoc())
													{
															if($rowcat["ca_categoryid"]==$type){?>
                                                           
                                                   <td><?=$rowcat["ca_categoryname"]?> <?php }}?></td>
                                                   <!--<td><?=$rowcat["ca_categoryname"]?><<select name="type" id="type<?= $k ?>" class="form-control" style="width:85px;">
													<?php
													$type = $row['pr_type'];
													$sql1="SELECT * FROM us_catogory " ;
													$sql= $conn->query("$sql1");
                                        
													while($rowcat=$sql->fetch_assoc())
													{?>
                                                
													<option <?php
															if($rowcat["ca_categoryid"]==$type)
																{?>selected <?php }?> value="<?=$rowcat["ca_categoryid"]?>"><?=$rowcat["ca_categoryname"]?>
																
															</option>
													<?php }?>
													</select>
												   
                                                   
                                                   </td>-->
												   	<!--<td>
														<select name="unittype" id="unit<?=$k?>" class="form-control" style="width:100px;">
														
															<option <?php  if($row['pr_unit']=='1'){ ?> selected  <?php } ?> value="1">Kilogram</option>
															<option <?php  if($row['pr_unit']=='25'){ ?> selected  <?php } ?> value="25">25 kg bag</option>
															<option <?php  if($row['pr_unit']=='30'){ ?> selected  <?php } ?> value="30">30 kg bag</option>
															<option <?php  if($row['pr_unit']=='50'){ ?> selected  <?php } ?> value="50">50 kg bag</option>
															<option <?php  if($row['pr_unit']=='60'){ ?> selected  <?php } ?> value="60">60 kg bag</option>
															
															
															
															</select>
												   
												  
												   </td>-->
                                                   <td style="width:150px;"><?php $unit=$row['pr_unit'];echo $unit;?> kg bag</td>
                                                   
                                                   <!--<td><input type="text" name="purchaseprice" style="width: 60px;" value="<?= $row['pr_purchaseprice'] ?>"></td>
                                                   <td>
                                                       <input type="text" name="saleprice" style="width: 60px;" value="<?= $row['pr_saleprice'] ?>">
                                                   </td>
                                                   <td>
                                                       <input type="text" name="saleprice" style="width: 60px;" value="<?= $row['pr_saleprice_w'] ?>">
                                                   </td>-->
												   <?php
												   $today = date('Y-m-d');
												   $retail=$conn->query("SELECT SUM(st_qty) AS totretail FROM us_stock WHERE user_id='".$_SESSION["admin"]."' AND st_category='retail' AND st_productid='".$row['pr_productid']."' AND DATE(st_date)='$today'");
													$rowret=$retail->fetch_assoc();                                                   
													$retailtotal=$rowret['totretail'];
													$wholesale=$conn->query("SELECT SUM(st_qty) AS totwhole FROM us_stock WHERE user_id='".$_SESSION["admin"]."' AND st_category='wholesale' AND st_productid='".$row['pr_productid']."' AND DATE(st_date)='$today'");
													$rowwh=$wholesale->fetch_assoc();
													$wholetotal=$rowwh['totwhole'];
													$purchase=$conn->query("SELECT SUM(st_qty) AS totpur FROM us_stock WHERE user_id='".$_SESSION["admin"]."' AND st_category='purchasestock' AND st_productid='".$row['pr_productid']."' AND DATE(st_date)='$today'");
													$rowpur=$purchase->fetch_assoc();
													$puttotal=$rowpur['totpur'];
													$totalplus=$retailtotal+$wholetotal;
													$totalsale=$row['pr_stock']+$totalplus;
													$lasttot=$totalsale-$puttotal;
													
												   ?>
                                                   <td style="width:190px;">
                                                   	<?=  $lasttot ?>
                                                   </td>
                                                   <td>
                                                   	<?php
													$itmstock = $lasttot/$unit;
													$bag = intval($itmstock);
													$itmkg=($itmstock-$bag)*$unit;
													echo $bag." BAG ".$itmkg." KG"
													?>
                                                   </td>
                                                   <td style="width:180px;"><?= $row['pr_stock']." kg" ?></td>
                                                   
                                                   <td>
												   <?php $intstock=($row['pr_stock']) / ($row['pr_unit']);
														$inttot=intval($intstock);
														$itmkg=($intstock-$inttot)*$row['pr_unit'];

												   ?>
                                                   	<?= $inttot." Bag ".$itmkg." kg"?>
                                                    </td>
												  <!-- <td><input type="text" name="amt" style="width: 60px;" value="<?php $ttl=$row['pr_purchaseprice']*$row['pr_stock'];echo $ttl; $total=$total+$ttl; ?>"></td>-->
                                                   
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
                                                   <!-- <button type="submit" name="updateprdct" style="float: right;width: 75px;" class="btn btn-primary btn-addon  btn-xs"><i class="fa fa-plus"></i> Update</button>-->
                                                    </form>
                                                    </td>
													
                                               </tr>
                                               
                                               <?php
											   $k++;
												   }
											   }
											   ?>
						                  </tbody>
										  <tr>
										  <!--<td colspan="8" align="right"><b>Total</b></td>
									   	   <td><?php echo $total; ?></td>-->
										  </tr>
                                        </table>
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
        <script>
        	/*function calculatetotal(num)

	{
		//var stock = $('#stock'+num).val();
		//var unittypee = $('#unit'+num).val();
		//var kgwisee = Number(stock) * Number(unittypee);
		$('#kgwise').val(kgwisee);
		var unittype=document.getElementById('unit');
		var stock=document.getElementById('stock').innerHTML;
		var multi=Number(unittype)*Number()
		var kgwise=document.getElementById('kgwise');
	}*/
        </script>
    </body>

</html>
<?php
}else{
	header("Location:index.php");
}
?>