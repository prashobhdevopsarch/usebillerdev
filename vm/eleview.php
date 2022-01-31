<?php
session_start();
error_reporting(0);
if(isset($_SESSION['admin']))
{
	include("includes/config.php");
	
	if(isset($_POST['update']))
	{
		$billid=$_POST['billid'];
		$customerid=$_POST['customerid'];
		$balance=$_POST['balance'];
		$newpayment=$_POST['newpay'];
		$newbalance=$_POST['newbalance'];
		$acount=$_POST["acount"];
		
		//echo print_r($_POST);
		$slctacntname=$conn->query("SELECT * FROM us_customer a, administrator_account_name b WHERE b.refid=a.cs_acntid AND a.cs_customerid='$customerid'");
		$cusacnt=$slctacntname->fetch_assoc();
		$scntname=$cusacnt["cs_customername"];
		
		$instrt=$conn->query("INSERT INTO administrator_daybook(ad_branchid, dayBookDate, debit, credit, dayBookContra, dayBookAmount, description) VALUES('".$_SESSION["admin"]."',NOW(),'$acount','$scntname','Y','$newpayment','Customer Balance Payment')");
		$trid = $conn->insert_id;	
		$update=$conn->query("UPDATE us_supplier SET rs_balance='$newbal' WHERE rs_supplierid='$customerid'");
		
		$update=$conn->query("UPDATE us_customer SET cs_balance='$newbalance' WHERE cs_customerid='$customerid'");  


		$sql="INSERT INTO vm_payment(pa_billid, pa_customerid, pa_balance, pa_newpayment, pa_newbalance, pa_updatedon, user_id, pa_mode, pa_transactionid) VALUES('$billid','$customerid','$balance','$newpayment','$newbalance',NOW(),'".$_SESSION["admin"]."','1','$trid')";
			$sql1= $conn->query("$sql");
			$payid = $conn->insert_id;	
		if($sql1)
		{
					
			$sql2=$conn->query("SELECT * FROM us_billentry WHERE be_billid='$billid'");
				
				$row=$sql2->fetch_assoc();
					$updatebal=$row['be_balance']-$newpayment;
					$updatepaid=$row['be_paidamount']+$newpayment;
			
			$sql3="UPDATE  us_billentry SET be_balance='$updatebal', be_paidamount='$updatepaid' WHERE be_billid='$billid'";
				$sql4= $conn->query("$sql3");
			
			$sql5=$conn->query("SELECT * FROM us_customer WHERE cs_customerid='$customerid'");
				$rowcat=$sql5->fetch_assoc();
					$updatebal1=$rowcat['cs_balance']-$newpayment;
			
			
			if($sql1)
			{
				header("Location:newpay_print.php?id=success&payid=".$payid);
			}
			else
			{
				header('Location:view.php?id=faill&csid='.$customerid);
			}
			
		}
		
		
		else
		{
		  header('Location:view.php?id=faill2&csid='.$customerid);
		}
	}
	
	if(isset($_POST["update1"]))
	{
		
		$acount=$_POST["acount"];
		
		$newbal=$_POST["newbalance"];
		$csid=$_POST["csid"];
		$newpay=$_POST["newpay"];
		$balance=$_POST["balance"];
		//echo print_r($_POST);
		
		$slctacntname=$conn->query("SELECT b.acc_name FROM us_customer a, administrator_account_name b WHERE b.refid=a.cs_acntid AND a.cs_customerid='$csid'");
		$cusacnt=$slctacntname->fetch_assoc();
		$scntname=$cusacnt["acc_name"];
		
		$instrt=$conn->query("INSERT INTO administrator_daybook(ad_branchid, dayBookDate, debit, credit, dayBookContra, dayBookAmount, description) VALUES('".$_SESSION["admin"]."',NOW(),'$acount','$scntname','Y','$newpay','Customer Balance Payment')");
		$trid = $conn->insert_id;	
		$update=$conn->query("UPDATE us_supplier SET rs_balance='$newbal' WHERE rs_supplierid='$csid'");
		
		$update=$conn->query("UPDATE us_customer SET cs_balance='$newbal' WHERE cs_customerid='$csid'");
		
		$sql="INSERT INTO us_payment(pa_customerid, pa_balance, pa_newpayment, pa_newbalance, pa_updatedon, user_id, pa_mode, pa_transactionid) VALUES('$csid','$balance','$newpay','$newbal',NOW(),'".$_SESSION["admin"]."','1','$trid')";
			$sql1= $conn->query("$sql");
			$payid = $conn->insert_id;	
		
		if($update && $sql1)
		{
			//$suc=minusbalance($conn,$newpay,$_SESSION["admin"],$csid);
			
			header("location:newpay_print.php?id=success&payid=".$payid);
			
		}else{header('Location:view.php?id=faill2&csid='.$csid);}
	}
	if(isset($_GET["delete"]))
	{
		$billid=$_GET["billid"];
		$csid=$_GET["csid"];
		$oldbal=$_GET["oldbal"];
		$balcal=$conn->query("select * from us_billentry  WHERE be_billid='$billid' ");
		$rowbalcal= $balcal->fetch_assoc();

		$realoldbal = $oldbal - $rowbalcal['be_balance'];
		$delete=$conn->query("UPDATE vm_billentry SET be_isactive='1' WHERE be_billid='$billid' AND be_customerid='$csid'");
		$slct=$conn->query("update us_transaction set tr_isactive='1' where tr_billid='$billid' and tr_transactiontype='income' AND user_id='".$_SESSION["admin"]."'");
		if($delete && $slct)
		{
			$acc=$conn->query("SELECT be_debitid,be_creditid FROM us_billentry WHERE be_billid='$billid'");
			$rowacc=$acc->fetch_assoc();
			$debitid= $rowacc["be_debitid"];
			$creditid= $rowacc["be_creditid"];
		if($debitid!="")
			{
			$delet2=$conn->query("DELETE FROM administrator_daybook WHERE refid='".$debitid."'");
			}
			if($creditid!="")
			{
			$delet3=$conn->query("DELETE FROM administrator_daybook WHERE refid='".$creditid."'");
			}
			$cusbal=$conn->query("UPDATE us_customer SET cs_balance='$realoldbal' WHERE cs_customerid='$csid'");
			$updatstk=updatestock($conn,$billid,$csid,$_SESSION["admin"]);
			if($updatstk=="succ")
			{
			header('Location:view.php?id=success&csid='.$csid);
			}else{header('Location:view.php?id=faill&csid='.$csid);}
		}else{header('Location:view.php?id=faill&csid='.$csid);}
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
	.pay td{
		padding:10px;
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
                    <h3><strong>Electrician Details</strong></h3>
                    <div class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li><a href="dashboard.php">Billing</a></li>
							<li>Electrician Management</a></li>
							<li>Electrician List</a></li>
                            <li class="active">View</li>
                        </ol>
                    </div>
                </div>
                
                <div id="main-wrapper">
                    <!-- Row -->
                    <div class="row">
                        
                        <div class="col-lg-12 col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h4 class="panel-title">Electrician Details</h4>
                                    
                                    <a href="cushistory.php"><button type="button" class="btn btn-primary btn-addon m-b-sm btn-sm" style="float:right"><i class="fa fa-backward"></i> back</button></a>
                                </div>
                                <div class="panel-body">
                                <?php
								$csid=0;
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

                                <div class="row">
                                    <div class="col-md-6">
                                        <?php
										$customerid=$_GET['eleid'];
										$slct=$conn->query("SELECT * FROM us_elec WHERE el_id='$customerid'");
										$rowcus=$slct->fetch_assoc();
										
										
										?>
                                            <table class="pading">
                                            	<tbody>
                                                	
													 <tr><td><h4>Electrician Name</h4></td><td> &nbsp;: <?= $rowcus["el_name"] ?></td></tr>
                                                    <tr><td><h4>Phone Number</h4></td><td> &nbsp;: <?= $rowcus["el_phone"] ?></td></tr>
                                                    <tr><td><h4>Address</h4></td><td> &nbsp;: <?=$rowcus["el_address"] ?></td></tr>
                                                    <tr><td><h4>Email</h4></td><td> &nbsp; : <?= $rowcus["el_email"] ?></td></tr>
                                                   <!-- <tr><td><h4>GSTIN</h4></td><td> &nbsp; : <?= $rowcus["cs_tin_number"] ?></td></tr>-->
													<tr><td><h4>State Code</h4></td><td> &nbsp; : <?= $rowcus["el_statecode	"] ?></td></tr>
													<tr><td colspan="2">&nbsp;</td></tr>
													<tr><td><h4>Balance</h4></td><td> &nbsp; : <?= $rowcus["el_balance"] ?></td></tr>
													<tr><!--<td><button type="button" class="btn btn-primary btn-rounded" onClick="showmodel(<?= $rowcus["cs_balance"] ?>)">Pay</button></td>--><td> &nbsp; <button type="button" class="btn btn-primary btn-rounded" onClick="showHint(1,<?= $customerid?>)">Pay History</button></td></tr>
                                                </tbody>
                                            </table>
                                        </div>
									</div>
                                    <!--<table class="table">
                                        <td align="right">Total Amount:</td>
                                        <td width="150"><input type="text" readonly class="form-control" name="totalprice" id="totalprice" placeholder="Total Amount" style="width:120px;"></td>
                                    </table>-->
                                       
                                        
                                       
                            </div>
                        </div>
                        <?php
                if(isset($_GET['id']))
								{if($_GET["id"]=="success"){
									?>
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        Updated  successfully.
                                        </div>
                                        <?php
								}}
								?>
                        <div id="main-wrapper">
						
						  <!-- Row -->
                    <div class="row">
                        <div class="col-lg-12 col-md-12" style="padding:0px;">
                            <div class="panel panel-white">
                                <?php
							//$bill=$_POST['bill'];

							if(isset($_POST['filter']))
							{
								$fromdate = $_POST['fromdate'];
								$todate = $_POST['todate'];
								$filt = $fromdate . "$" . $todate;
							}
							else{
								$filt = "all";
							}
							?>
                                <div class="panel-heading"><!--<a href="custexport_printrealhelper.php?fil=<?= $filt ?>&csid=<?=$customerid?>" target="blank"><button type="button" class="btn btn-primary btn-addon m-b-sm" onclick="return confirm('Do you want to Print a Statement?')" style="float:right;"><span class="glyphicon glyphicon-print"></span>Statement</button></a>-->
                                	<a href="cus_bill_report.php?fil=<?= $filt ?>&csid=<?=$customerid?>" target="_blank"><button type="button" class="btn btn-primary btn-addon m-b-sm" style="float:right;"><span class="glyphicon glyphicon-print"></span>Print</button></a>
                                	<?php if($_SESSION['admin']){ ?>
<a href="commision.php?fil=<?=$filt?>&eleid=<?=$customerid?>" ><button type="button" class="btn btn-primary btn-addon m-b-sm" style="float:right;"><span class="glyphicon glyphicon-print"></span>Commision List</button></a><?php }?>
                                	
									
									<a href="cus_bill_export.php?fil=<?= $filt ?>&csid=<?=$customerid?>" target="_blank"><button type="button" class="btn btn-primary btn-addon m-b-sm" style="float:right; margin-right:10px;"><span class="glyphicon glyphicon-print"></span>Export</button></a>
                                    <h4 class="panel-title">Customer History</h4>
                                </div>

                                 <div class="panel-body">
                                  <form action="eleview.php?eleid=<?=$customerid?>" method="post">
                                    <input type="date" name="fromdate" id="fromdate">
                                    <input type="date" name="todate" id="todate">
                                    <button type="submit" name="filter">Filter</button>
                                </form>
                                <?php
	$tablconectn = $conn->query("SELECT * FROM us_elec WHERE el_id ='$customerid'");
	$elecname=$tablconectn->fetch_assoc();
	$eletrname = $elecname['el_name'];


	if(isset($_POST['filter']))
	{
		$fromdate = $_POST['fromdate'];
		$todate = $_POST['todate'];
		$tablconn = $conn->query("SELECT * FROM us_billentry WHERE DATE(be_billdate)>='$fromdate' AND DATE(be_billdate) <= '$todate' AND be_isactive='0' AND user_id='".$_SESSION["admin"]."' AND  `be_electrician` ='$eletrname' ORDER BY be_billid DESC");
		echo "<h3>From Date: ".date('d-M-Y', strtotime($fromdate))." &nbsp; &nbsp; To Date: ".date('d-M-Y', strtotime($todate))."</h3>";

	}
	else{
		$tablconn = $conn->query("SELECT * FROM us_billentry WHERE `be_isactive`='0' AND `user_id`='".$_SESSION["admin"]."' AND `be_electrician` ='$eletrname' ORDER BY be_billid DESC");
											
		//	echo '<script type="text/javascript">alert("' . $tablconn . '")</script>';
		echo "<h3>ALL BILL DETAILS</h3>";
	}
	?>
						
						
						
                	
                    <!-- Row -->
                    <div class="row">
                        <div class="col-lg-12 col-md-12" style="padding:0px;">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h4 class="panel-title">Item List</h4>
                                 </div>   
    
                                     
                                  <div class="panel-body">
                                    <div class="table-responsive project-stats">  
                                       <table id="example" class="display table" style="width: 100%; cellspacing: 0;">
                                     
                                       
                                    		  <thead>
                                               <tr>
												   <th>#</th>
                                                   <th>Bill No</th>
                                                   <th>Bill Date</th>  
                                                   <th>Customer Name</th>                          
                                                   <th>Items</th>
                                                   <th>Total</th>
                                                   <th>Coolie</th>
                                                   <th>Discount</th>
                                                   <th>OB</th>
                                                   <th>Grant Total</th>
                                                   <th>Paid Amount</th>
												   <th>Balance</th>
												   <th>Status</th>
                                                   <th>Action</th>

                                                
												</tr>
											</thead>
                                   		 <tbody>
                                    	<?php
										$k=1;
										
											   $totalamnt = 0;
											   $today = date('Y-m-d');
										
                                        if($tablconn)
										{
												while($rowcat=$tablconn->fetch_assoc())
												{
											?>
                                            <tr>
                                             
                                            
                                            	<td><?=$k?></td>
                                                <td><?=$rowcat["be_billnumber"]?></td>
												 <td>
                                                   <?= date('d-M-Y H:i', strtotime($rowcat['be_billdate'])) ?>
                                                  </td>
                                                  <td>
                                                   <?= $rowcat['be_customername'] ?>
                                                  </td>
												  <td>
                                                   	<?php
													$billid = $rowcat['be_billid'];
													$itms = $conn->query("SELECT * FROM us_billitems a LEFT JOIN us_products b ON b.pr_productid=a.bi_productid WHERE a.bi_billid='$billid'");
													$n=1;
													while($row2 = $itms->fetch_assoc())
													{
														echo $n . ". " .$row2['pr_productname'] . ", <b>Unit Price:</b>" . $row2['bi_price'] . ", <b>Qty:</b>" . $row2['bi_quantity'] . ", <b>Total:</b>" . $rowcat['be_total'] . "<br/>";
														$n++;
													}
													?>
                                                   </td>
												   <td><?=$rowcat['be_total']?></td>
                                                   <td><?=$rowcat['be_coolie']?></td>
                                                   <td><?=$rowcat['be_discount']?></td>
                                                   <td><?=$rowcat['be_oldbal']?></td>
                                                   <td><?=$rowcat['be_gtotal']?></td>
                                                   
													    <td>
                                                       <?php
													   echo $rowcat['be_paidamount'];
													   $totalamnt = $totalamnt +$rowcat['be_paidamount'];
													   ?>
                                                   </td>
                                                   
												   <td>
												   <?php
												   echo $rowcat['be_balance'];
												  // echo   $_GET['csbal'];
												   ?>
												   </td>
												  <td>
												    <?php 
													if($rowcat['be_balance']!=0){?><button class="btn  btn-danger" onClick="newpay(<?=$rowcat['be_billid']?>,<?= $customerid ?>,<?=$rowcat['be_balance']?>)" id="myBtn">Pay</button><?php  } else{echo "<b>Completed</b>";}?>
												   </td>
												   <td><a href="bill_print.php?billid=<?=$rowcat['be_billid']?>&back=<?=$page?>?csid=<?=$_GET["csid"]?>&csid=<?=$_GET["csid"]?>"><span class="glyphicon glyphicon-print"></span> TAX print</a><br>
                                                   <a href="bill_print_cus1.php?billid=<?=$rowcat['be_billid']?>&back=<?=$page?>?csid=<?=$_GET["csid"]?>&csid=<?=$_GET["csid"]?>"><span class="glyphicon glyphicon-print"></span> bill print</a><br>
                                                    <a href="editbill.php?billid=<?=$rowcat['be_billid']?>"><span class="glyphicon glyphicon-edit"></span> edit</a><br>
                                                   <?php
												   $slctdil=$conn->query("SELECT be_billid FROM us_billentry WHERE user_id='".$_SESSION["admin"]."' AND be_customerid='$customerid' AND be_isactive='0' ORDER BY be_billid DESC LIMIT 1");
												   $rowdel=$slctdil->fetch_assoc();
												   if($rowdel["be_billid"]==$rowcat["be_billid"]){
												   ?> 
                                                   <a onClick="return confirm('Are you sure you want to delete?')" href="view.php?billid=<?=$rowcat['be_billid']?>&delete&csid=<?=$_GET["csid"]?>&oldbal=<?=$rowcus['cs_balance']?>"><span class="glyphicon glyphicon-trash"></span> delete</a><?php }?>
                                                   </td>
                                                
                                                
        </button></a></td>
                                               
                          
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
        
        <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Balance Payment</h4>
        </div>
        <div id="popbal" class="modal-body">
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
  
  <div class="modal fade" id="myModalpay" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Balance Payment</h4>
        </div>
        <div class="modal-body">
		<form action="view.php" method="post">
		<input type="hidden" name="csid" value="<?=$_GET["csid"]?>">
          <table class="pay" style="width:100%;">
		<tr>
		<td>Acount</td><td><select required class="form-control" id="acount" name="acount">
        <?php 
		$slctacnt=$conn->query("SELECT * FROM administrator_account_name WHERE act_group_head='CASH' OR act_group_head='BANK CURRENT ACCOUNT'");
		while($rowacnt=$slctacnt->fetch_assoc()){
		?>
        <option value="<?=$rowacnt["acc_name"]?>"><?=$rowacnt["acc_name"]?></option>
        <?php }?>
        </select></td>
		</tr>
		<tr>
		<td>Balance</td><td><input readonly class="form-control" id="balance1" name="balance"></td>
		</tr>
		<tr>
		<td>New Payment</td><td><input class="form-control" onKeyUp=" calnewbal1()" required id="newpay1" name="newpay" value="0"></td>
		</tr>
		<tr>
		<td>New Balance</td><td><input readonly class="form-control" id="newbalance1" name="newbalance"></td>
		</tr>
		<tr>
		
		
		<td></td><td align="right"><button class="btn btn-success" name="update1" type="submit">Update</button></td>
		
		</tr>
		</table>
		</form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
  
  <div class="modal fade" id="myModalrcv" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">New Payment</h4>
        </div>
        <div class="modal-body">
		<form action="view.php" method="post">
		<input id="billid" name="billid" type="hidden">
		<input id="customerid" name="customerid" type="hidden">
		<input name="back" value="<?=$page?>" type="hidden">
		<table class="pay" style="width:100%;">
		
		<tr>
		<td>Balance</td><td><input readonly class="form-control" id="balance" name="balance"></td>
		</tr>
		<tr>
		<td>New Payment</td><td><input class="form-control" onKeyUp=" calnewbal()" required id="newpay" name="newpay" value="0"></td>
		</tr>
		<tr>
		<td>New Balance</td><td><input readonly class="form-control" id="newbalance" name="newbalance"></td>
		</tr>
		<tr>
		<td></td><td align="right"><button class="btn btn-success" name="update" type="submit">Update</button></td>
		</tr>
		</table>
		</form>
          
        </div>
        
      </div>
      
    </div>
  </div>
        
        
       
        
        <script src="assets/plugins/jquery-mockjax-master/jquery.mockjax.js"></script>
        <script src="assets/plugins/datatables/js/jquery.datatables.min.js"></script>
        <script src="assets/plugins/x-editable/bootstrap3-editable/js/bootstrap-editable.js"></script>
        <script src="assets/js/pages/table-data.js"></script>
        
        <script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script src="assets/plugins/summernote-master/summernote.min.js"></script>
        <script src="assets/js/pages/form-elements.js"></script>
        
        
        
        <script>
		
		function showmodel(bal)
		{
			document.getElementById("balance1").value=Number(bal);
			document.getElementById("newbalance1").value=Number(bal);
			
			$('#myModalpay').modal('show'); 
		}
		
function newpay(billidvar,customeridvar,balancevar)
{
	
	//alert(billidvar+" "+customeridvar+" "+balancevar);
	document.getElementById("billid").value=billidvar;
	document.getElementById("customerid").value=customeridvar;
	document.getElementById("balance").value=balancevar;
	document.getElementById("newbalance").value = balancevar;
	$('#myModalrcv').modal('show'); 
	
}
function calnewbal()
{
	
	var bal = document.getElementById("balance").value;
	var newpay = document.getElementById("newpay").value;
	
	var newbal = Number(bal)-Number(newpay);
	
	document.getElementById("newbalance").value = newbal;
	
	
}
function calnewbal1()
{
	
	var bal = document.getElementById("balance1").value;
	var newpay = document.getElementById("newpay1").value;
	
	var newbal = Number(bal)-Number(newpay);
	
	document.getElementById("newbalance1").value = newbal;
	
	
}
		
		
function showHint(mode,csid) {
    if (mode.length == 0) { 
        document.getElementById("popbal").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("popbal").innerHTML = this.responseText;
				$('#myModal').modal('show'); 
            }
        };
        xmlhttp.open("GET", "payhstry.php?mode=" + mode+"&csid="+csid, true);
        xmlhttp.send();
    }
}
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
}
else{
	header("Location:index.php");
}
?>