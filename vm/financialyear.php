<?php
session_start();
if(isset($_SESSION['admin']))
{
	include("includes/config.php");
	
	/*CREATE TABLE `aysha`.`us_financialyear` ( `fy_id` INT(11) NOT NULL AUTO_INCREMENT , `fy_name` VARCHAR(100) NOT NULL , `fy_startdate` DATETIME NOT NULL , `fy_enddate` DATETIME NOT NULL , `fy_updatedtime` DATETIME NOT NULL , `fy_default` INT(11) NOT NULL DEFAULT '0' , PRIMARY KEY (`fy_id`)) ENGINE = InnoDB;
	*/
	if(isset($_POST['submit']))
	{
		$name = $_POST['name'];
		$startdate = date('Y-m-d', strtotime($_POST['startdate']));
		$endtdate = date('Y-m-d', strtotime($_POST['endtdate']));
		
		
		
		$sql1="INSERT INTO us_financialyear(fy_name, fy_startdate, fy_enddate, fy_updatedtime ) VALUES('".$name."','".$startdate."','".$endtdate."',NOW())";
			$sql= $conn->query("$sql1");
			
		
			
	
	if($sql)
	  {
		  header('Location:financialyear.php?id=success');
	  }
	  else{
		  header('Location:financialyear.php?id=fail');
		 
	  }
	}
	if(isset($_POST['update']))
	{
		$name = $_POST['name'];
		$startdate = date('Y-m-d', strtotime($_POST['startdate']));
		$endtdate = date('Y-m-d', strtotime($_POST['endtdate']));
		
		$id=$_GET["fid"];
		
		
			$sql1="UPDATE us_financialyear SET fy_name='$name',fy_startdate='$startdate',fy_enddate='$endtdate' WHERE fy_id='$id'";
			$sql= $conn->query("$sql1");
			
		
			
	
	if($sql)
	  {
		  header('Location:financialyear.php?id=success');
	  }
	  else{
		  header('Location:financialyear.php?id=fail');
		 
	  }
	}
	
	if(isset($_GET['default']))
	{
		
		$id=$_GET["id"];
		
		    $update=$conn->query("UPDATE us_financialyear SET fy_default='0'");
			if($update)
			{
			$sql1="UPDATE us_financialyear SET fy_default='1' WHERE fy_id='$id'";
			$sql= $conn->query("$sql1");
			
		
			
	
	if($sql)
	  {
		  header('Location:financialyear.php?id=success');
	  }
	  else{
		  header('Location:financialyear.php?id=fail');
		 
	  }
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
        
        
        
        
        <link href="assets/plugins/datatables/css/jquery.datatables.min.css" rel="stylesheet" type="text/css"/>	
        <link href="assets/plugins/datatables/css/jquery.datatables_themeroller.css" rel="stylesheet" type="text/css"/>	
        <link href="assets/plugins/x-editable/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet" type="text/css">
        
        
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
                    <h3><strong>Add Financial Year</strong></h3>
                    <div class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li><a href="dashboard.php"></a></li>
                            <li class="active">Add Financial Year</li>
                        </ol>
                    </div>
                </div>
                
                <div id="main-wrapper">
                    <!-- Row -->
                    <div class="row">
                        
                        <div class="col-lg-12 col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h4 class="panel-title">Add Financial Year</h4>
                                    
                                    <a href="dashboard.php"><button type="button" class="btn btn-primary btn-addon m-b-sm btn-sm" style="float:right"><i class="fa fa-backward"></i> back</button></a>
                                </div>
                                <div class="panel-body">
                                <?php
								if(isset($_GET['id']))
								{if($_GET["id"]=="fail"){
									?>
                                    <div class="alert alert-danger alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        Error occured.. Please try again...
                                    </div>
                                    <?php
								}}
								?>
                                    <form class="form-horizontal" name="addstudio" method="post"
                                     action="financialyear.php<?php if(isset($_GET["id"])){echo "?fid=".$_GET["id"];}?>" enctype="multipart/form-data">
                                    <div class="table-responsive">
                                    <table class="table" id="drgcartitms">
                                    <col width="30%">
                                    <col width="40%">
                                    <thead>
                                    <tr>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Name</th>
                                                        
                                        
                                    </tr>
                                    </thead>
                                    
                                    <tbody><?php
										$k=1;
										//for($k=1; $k<4; $k++)
										//{
											if(isset($_GET['edit'])){
										$id=$_GET['id'];
                                        $sql1="SELECT * FROM us_financialyear WHERE fy_id='$id'" ;
                                        $sql= $conn->query("$sql1");
                                        
												$rowcat=$sql->fetch_assoc();
											}
											?>
										<tr style="border-bottom:1px #EEE solid;" id="tr<?= $k ?>">
										
										
                                        <td><input type="date" required autocomplete="off" <?php if(isset($_GET["edit"])){?> value="<?=date('Y-m-d', strtotime($rowcat["fy_startdate"]))?>"<?php }?> class="form-control" name="startdate" id="vatp<?= $k ?>"style="width:200px;" ></td>
										<td><input type="date" required autocomplete="off" <?php if(isset($_GET["edit"])){?> value="<?=date('Y-m-d', strtotime($rowcat["fy_enddate"]))?>"<?php }?> class="form-control" name="endtdate" id="vatp<?= $k ?>"style="width:200px;" ></td>
                                        
										<td>
                                        
											<input type="text"  required <?php if(isset($_GET["edit"])){?> value="<?=$rowcat["fy_name"]?>"<?php }?> class="form-control" name="name" id="name" style="width:200px;" placeholder="2017-2018">
                                           
                                            
										</td>
										
										</tr>
										
									</tbody>
									<tbody id="cartitems">
									</tbody>
                                    </table></div>
                                    
                                    
                                    <!--<table class="table">
                                        <td align="right">Total Amount:</td>
                                        <td width="150"><input type="text" readonly class="form-control" name="totalprice" id="totalprice" placeholder="Total Amount" style="width:120px;"></td>
                                    </table>-->
                                       
                                        
                                        <div class="form-group" align="right" style="padding-right:30px;">
                                        <label for="input-help-block" class="col-sm-2 control-label"></label>
                                        <button type="submit" <?php
										if(isset($_GET['edit'])){?>
											name="update" class="btn btn-primary">Update
											<?php }else
											{?>
												name="submit" class="btn btn-primary">Submit
											<?php }
											?></button>
                                          </div> 
                                           
                                     </form>
                                </div>
                            </div>
                        </div>
                        <?php
                if(isset($_GET['id']))
								{if($_GET["id"]=="success"){
									?>
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                         added successfully.
                                        </div>
                                        <?php
								}}
								?>
                        <div id="main-wrapper">
                	
                    <!-- Row -->
                    <div class="row">
                        <div class="col-lg-12 col-md-12" style="padding:0px;">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h4 class="panel-title">Year List</h4>
                                 </div>   
    
                                     
                                  <div class="panel-body">
                                    <div class="table-responsive project-stats">  
                                       <table id="example" class="display table" style="width: 100%; cellspacing: 0;">
                                     
                                       
                                    		  <thead>
                                               <tr>
                                    				<th col width=200px;>Serial Number</th>
                                                	<th col width=250px;> Name</th>
                                                	<th col width=200px;>Start Date</th>
													<th col width=200px;>End Date</th>
                                                	<th align="center" style="width: 115px;
">Action</th>
<th align="center" style="width: 115px;
">Status</th>
                                                
												</tr>
											</thead>
                                   		 <tbody>
                                    	<?php
										$k=1;
										$tablconn=$conn->query("SELECT *FROM us_financialyear");
                                        if($tablconn)
										{
												while($rowcat=$tablconn->fetch_assoc())
												{
											?>
                                            <tr>
                                             
                                            
                                            	<td><?=$k?></td>
                                                <td><?=$rowcat["fy_name"]?></td>
                                                <td><?= date('d-m-Y', strtotime($rowcat["fy_startdate"]))?></td>
												<td><?= date('d-m-Y', strtotime($rowcat["fy_enddate"]))?></td>
                                                <td><a href="financialyear.php?id=<?=$rowcat['fy_id']?>&edit=Edit"><button type="button" class="btn btn-primary btn-addon m-b-sm" style="float:right">
         <i class="fa fa-pencil" aria-hidden="true"></i> Edit
        </button></a></td>
		<td><?php if($rowcat['fy_default']=='0') { ?><a href="financialyear.php?id=<?=$rowcat['fy_id']?>&default"><button type="button" class="btn btn-primary btn-addon m-b-sm" style="float:right">
          Set as Default
        </button></a><?php } else { ?><button type="button" class="btn btn-primary btn-addon m-b-sm" style="float:right">
          Default
        </button><?php  } ?></td>
                                               
                          
                                               </tr>
                                            <?php $k++;}}?>
                                                
                                                    	
									
									</tbody>
									
                                    </table>
                                    
                                 </div>   
                                                                       
                                        
                                       <!-- <div class="form-group" align="right" style="padding-right:30px;">
                                        <label for="input-help-block" class="col-sm-2 control-label"></label>
                                       
                                        </div>-->
                                     
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
        <?php
		include("includes/footerfiles.php");
		?>
        
        
        
        
       
        
        <script src="assets/plugins/jquery-mockjax-master/jquery.mockjax.js"></script>
        <script src="assets/plugins/datatables/js/jquery.datatables.min.js"></script>
        <script src="assets/plugins/x-editable/bootstrap3-editable/js/bootstrap-editable.js"></script>
        <script src="assets/js/pages/table-data.js"></script>
        
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
	var fields = '<tr style="border-bottom:1px #EEE solid;" id="tr'+k+'"><td><input type="hidden" name="prodid[]" id="prodid'+k+'"><input type="text" autocomplete="off" class="form-control" name="productcode[]" id="productcode'+k+'" placeholder="Product Code" style="width:100px;"></td> <td><input type="text" autocomplete="off" class="form-control" name="productname[]" id="productname'+k+'" placeholder="Product Name"></td><td><select name="type[]" id="type'+k+'" class="form-control"><option value="1">Readymades</option><option value="2">Millsgoods</option></select></td><td><input type="text" class="form-control" placeholder="Price" name="price[]" id="price'+k+'" style="width:100px;"></td><td><input type="text" class="form-control" placeholder="Sale Price" name="saleprice[]" id="saleprice'+k+'" style="width:100px;"></td><td><input type="number" class="form-control" min="1" value="1" onChange="calculatetotal('+k+')" onKeyUp="calculatetotal('+k+')" name="qty[]" id="qty'+k+'" placeholder="Qty" style="width:100px;"></td><td><div class="btn-group" role="group"><a href="#" data-toggle="tooltip" data-placement="bottom" title="" onclick="removeproduct('+k+')" class="btn btn-default btn-sm m-user-delete" data-original-title="Remove Product"><i class="fa fa-times" aria-hidden="true"></i></a></div></td></tr>';
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
		</script>
        
    </body>

</html>
<?php
}else{
	header("Location:index.php");
}
?>