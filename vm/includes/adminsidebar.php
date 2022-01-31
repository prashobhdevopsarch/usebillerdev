<?php
$page = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);

?>
<style>
.menu.accordion-menu>li>a, body:not(.page-horizontal-bar):not(.small-sidebar) .menu.accordion-menu a {
    text-align: left;
}
@media (min-width:768px){
	#activebar{display:none;}
}
</style>
<div class="page-sidebar sidebar">
                <div class="page-sidebar-inner slimscroll">
                    
                    <ul class="menu accordion-menu">
                    	<?php 
						   if($active==0)
							{?><li id="activebar" style="background: red;"><a href="#" data-toggle="modal" data-target="#myModal_msg" class="waves-effect waves-button"><p style="color: white;">Activate Your Account.<br />trial ends in <?=$endtrail?> day</p></a></li><?php }?>
                    	<li <?php if($page == 'home.php'){ ?> class="active" <?php } ?>><a href="home.php" class="waves-effect waves-button"><p><span class="menu-icon glyphicon glyphicon-dashboard"></span> Dashboard</p></a>   
                        </li>
                    	<li class="droplink <?php if($page == 'dashboard.php' || $page == 'purchase.php' || $page == 'salesreturn.php' || $page == 'purchasereturn.php'|| $page == 'estimation.php'){ ?>active open<?php } ?>"><a href="#" class="waves-effect waves-button"><p><span class="menu-icon glyphicon glyphicon-print"></span> Billing</p><span class="arrow"></span></a>
                            <ul class="sub-menu">
                                <li<?php if($page == 'dashboard.php'){ ?> class="active" <?php } ?>><a href="dashboard.php">Sales Billing</a></li>
                                
                                <li<?php if($page == 'purchase.php' ){ ?> class="active" <?php } ?>><a href="purchase.php">Purchase Billing</a></li>
                                
                                <li<?php if($page == 'salesreturn.php' ){ ?> class="active" <?php } ?>><a href="salesreturn.php">Sales Return</a></li>
                                
                                <li<?php if($page == 'purchasereturn.php' ){ ?> class="active" <?php } ?>><a href="purchasereturn.php">Purchase Return</a></li>

								<li<?php if($page == 'estimation.php' ){ ?> class="active" <?php } ?>><a href="estimation.php">Quotation</a></li>
                               <li<?php if($page == 'performoinvoice.php' ){ ?> class="active" <?php } ?>><a href="performoinvoice.php">perfomoinvoice</a></li>
                                <li<?php if($page == 'Servicebill.php' ){ ?> class="active" <?php } ?>><a href="servicebill.php">Service Bill</a></li>
                                <li<?php if($page == 'delivery1.php' ){ ?> class="active" <?php } ?>><a href="delivery1.php">Delivery Note</a></li>
                                
								</ul>
                        </li>
                        <li class="droplink <?php if($page == 'billinghistory.php' || $page == 'salesreturnhistory.php' || $page == 'purchasereturnhistory.php' || $page == 'purchasehistory.php'|| $page == 'estimationhistory.php'){ ?>active open<?php } ?>"><a href="#" class="waves-effect waves-button"><p><span class="menu-icon glyphicon glyphicon-book"></span> Reports</p><span class="arrow"></span></a>
                            <ul class="sub-menu">
                                <li<?php if($page == 'billinghistory.php'){ ?> class="active" <?php } ?>><a href="billinghistory.php">Sales Report</a></li>
                                
                                 <li<?php if($page == 'billinghistoryw.php'){ ?> class="active" <?php } ?>><a href="billinghistoryw.php">Wholesale Report</a></li>
                                
                                <li<?php if($page == 'purchasehistory.php'){ ?> class="active" <?php } ?>><a href="purchasehistory.php">Purchase Report</a></li>
                                
                                <li<?php if($page == 'salesreturnhistory.php'){ ?> class="active" <?php } ?>><a href="salesreturnhistory.php">Sales Return</a></li>
                                
                                <li<?php if($page == 'purchasereturnhistory.php'){ ?> class="active" <?php } ?>><a href="purchasereturnhistory.php">Purchase Return</a></li>
                              
							  <li<?php if($page == 'estimationhistory.php'){ ?> class="active" <?php } ?>><a href="estimationhistory.php">Quotations</a></li>
                                <li<?php if($page == 'perfomoreport.php' ){ ?> class="active" <?php } ?>><a href="perfomoreport.php">Perfomoreport</a></li>
                                <li<?php if($page == 'servicebillreport.php' ){ ?> class="active" <?php } ?>><a href="servicebillreport.php">Servicebill Report</a></li>
                                 <li<?php if($page == 'hsnreport.php' ){ ?> class="active" <?php } ?>><a href="hsnreport.php">HSN REPORT</a></li>
							</ul>
                        </li>
                        <li class="droplink <?php if($page == 'stocks.php' || $page == 'addstocks.php' || $page == 'outofstocks.php'|| $page == 'inventory.php'){ ?>active open<?php } ?>"><a href="#" class="waves-effect waves-button"><p><span class="menu-icon glyphicon glyphicon-folder-open"></span> &nbsp;Stocks</p><span class="arrow"></span></a>
                            <ul class="sub-menu">
                                <li<?php if($page == 'stocks.php'){ ?> class="active" <?php } ?>><a href="stocks.php">Stock Report</a></li>
                                
                                <li<?php if($page == 'outofstocks.php'){ ?> class="active" <?php } ?>><a href="outofstocks.php">Out of Stocks</a></li>
                               
                                
                            </ul>
                        </li>
                        <li class="droplink <?php if($page == 'addemployee.php' || $page == 'addstocks.php' || $page == 'outofstocks.php'|| $page == 'inventory.php'){ ?>active open<?php } ?>"><a href="#" class="waves-effect waves-button"><p><span class="menu-icon glyphicon glyphicon-folder-open"></span> &nbsp;Employee Management</p><span class="arrow"></span></a>
                            <ul class="sub-menu">
                                <li<?php if($page == 'addemployee.php'){ ?> class="active" <?php } ?>><a href="addemployee.php">new employee</a></li>
                                
                                <li<?php if($page == 'outofstocks.php'){ ?> class="active" <?php } ?>><a href="outofstocks.php">view employee</a></li>
                                 <li<?php if($page == 'outofstocks.php'){ ?> class="active" <?php } ?>><a href="outofstocks.php">New sales person</a></li>
                               
                                
                            </ul>
                        </li>

                           <li <?php if($page == 'reports.php'){ ?> class="active" <?php } ?>><a href="reports.php" class="waves-effect waves-button"><p><span class="menu-icon glyphicon glyphicon-book"></span>All Reports</p></a></li>


                        <li class="droplink <?php if($page == 'puchasevat.php' || $page == 'salesvat.php'){ ?>active open<?php } ?>"><a href="#" class="waves-effect waves-button"><p><span class="menu-icon glyphicon glyphicon-briefcase"></span> Tax Report</p><span class="arrow"></span></a>
                            <ul class="sub-menu">
                                <li<?php if($page == 'puchasevat.php'){ ?> class="active" <?php } ?>><a href="puchasevat.php">Purchase TAX</a></li>
                                
                               <!-- <li<?php if($page == 'salesvat.php'){ ?> class="active" <?php } ?>><a href="salesvat.php">Sales TAX</a></li>-->
								
                                <li<?php if($page == 'salesvatr.php'){ ?> class="active" <?php } ?>><a href="salesvatr.php">Retail TAX</a></li>
								
                                <li style="display:none;"<?php if($page == 'salesvatw.php'){ ?> class="active" <?php } ?>><a href="salesvatw.php">Wholesale TAX</a></li>
                                
                            </ul>
                        </li>
                        
                   
                        
                        
                           
                        <li class="droplink <?php if($page == 'groupheads.php' || $page == 'ledger.php' || $page == 'expense.php' ||  $page == 'daybooks.php'||  $page == 'profit.php'){ ?>active open<?php } ?>"><a href="#" class="waves-effect waves-button"><p><span class="menu-icon glyphicon glyphicon-folder-open"></span> &nbsp;Accounts</p><span class="arrow"></span></a>
                            <ul class="sub-menu">
                                <li<?php if($page == 'groupheads.php'){ ?> class="active" <?php } ?>><a href="groupheads.php">Group Heads</a></li>
                                 <li<?php if($page == 'ledger.php'){ ?> class="active" <?php } ?>><a href="ledger.php">Ledger</a></li>
                                   <li<?php if($page == 'expense.php'){ ?> class="active" <?php } ?>><a href="expense.php">Reciepts and vouchers</a></li>
                                <li<?php if($page == 'daybooks.php'){ ?> class="active" <?php } ?>><a href="daybooks.php">Financial Statements</a></li>
								
								 <li<?php if($page == 'profit.php'){ ?> class="active" <?php } ?>><a href="profit.php">Profit</a></li>
                                
                                
                            </ul>
                        </li>
                        
						<!--<li <?php if($page == 'expense.php'){ ?> class="active" <?php } ?>><a href="expense.php" class="waves-effect waves-button"><p><span class="menu-icon fa fa-money"></span> Expense</p></a>   
                        </li>
                        
                         <li <?php if($page == 'daybook.php'){ ?> class="active" <?php } ?>><a href="daybook.php" class="waves-effect waves-button"><p><span class="menu-icon 	glyphicon glyphicon-time"></span> Daybook</p></a>   
                        </li>
                        
                        <li <?php if($page == 'transactions.php'){ ?> class="active" <?php } ?>><a href="transactions.php" class="waves-effect waves-button"><p><span class="menu-icon glyphicon glyphicon-book"></span> Account</p></a>   
                        </li>-->
                       <!-- <li class="droplink <?php if($page == 'transactions.php' || $page == 'expense.php' || $page == 'daybook.php' ||  $page == 'addAccount.php' ||  $page == 'profit.php'){ ?>active open<?php } ?>"><a href="#" class="waves-effect waves-button"><p><span class="menu-icon glyphicon glyphicon-folder-open"></span> &nbsp;Transactions</p><span class="arrow"></span></a>
                            <ul class="sub-menu">
                                <li<?php if($page == 'transactions.php'){ ?> class="active" <?php } ?>><a href="transactions.php">Daybook</a></li>
                                 <li<?php if($page == 'addAccount.php'){ ?> class="active" <?php } ?>><a href="addAccount.php">Accounts</a></li>
                                
                                <li<?php if($page == 'expense.php'){ ?> class="active" <?php } ?>><a href="expense.php">Reciepts and vouchers</a></li>
                                <li<?php if($page == 'profit.php'){ ?> class="active" <?php } ?>><a href="profit.php">Profit</a></li>
                                
                                 
                            </ul>
                        </li>-->
                        
                        <li class="droplink <?php if($page == 'financialyear.php' || $page == 'category.php' || $page == 'customer.php' || $page == 'addsupplier.php' || $page == 'cushistory.php' || $page == 'supplierlist.php'){ ?>active open<?php } ?>"><a href="#" class="waves-effect waves-button"><p><span class="menu-icon glyphicon glyphicon-cog"></span> Settings</p><span class="arrow"></span></a>
                            <ul class="sub-menu">
                                 <li<?php if($page == 'financialyear.php'){ ?> class="active" <?php } ?>><a href="financialyear.php">Add Financial Year</a></li>
                                <li<?php if($page == 'category.php'){ ?> class="active" <?php } ?>><a href="category.php">Add Category</a></li>
                                <li<?php if($page == 'customer.php'){ ?> class="active" <?php } ?>><a href="customer.php">Add Customer</a></li>
                                <li<?php if($page == 'addsupplier.php'){ ?> class="active" <?php } ?>><a href="addsupplier.php">Add Supplier</a></li>
                                <li<?php if($page == 'cushistory.php'){ ?> class="active" <?php } ?>><a href="cushistory.php">Customer List</a></li>
                                <li<?php if($page == 'supplierlist.php'){ ?> class="active" <?php } ?>><a href="supplierlist.php">Supplier List</a></li>
						 <li<?php if($page == 'barcodemenu.php'){ ?> class="active" <?php } ?>><a href="barcodemenu.php">Barcode</a></li>
                                <li> <a onClick="return confirm('Do you want to Backup?')" href="backup.php?back=<?=$page?>">Backup</a></li>
                                
                                
                            </ul>
                        </li>
                         
						
						
                          
						
                        
						
                        
                        <li <?php if($page == 'profile.php'){ ?> class="active" <?php } ?>><a href="profile.php" class="waves-effect waves-button"><p><span class="menu-icon glyphicon glyphicon-user"></span> Profile</p></a></li>
                        

						<li <?php if($page == 'logout.php'){ ?> class="active" <?php } ?>><a href="logout.php" class="waves-effect waves-button"><p><span class="menu-icon glyphicon glyphicon-off"></span> Logout</p></a></li>
                      
		
						
					  
                    </ul>
                </div><!-- Page Sidebar Inner -->
            </div>
            <script>
/*window.onload=function(){
	var shopid=<?=$_SESSION['admin']?>;
	
   
    $.post("deactivate.php", {shopid: shopid}, function(result){
        if(result=="success")
		{
			window.location.replace("../index.php");
			//alert("hai");
		}elseif(result=="failed")
		{
			alert("Please Contact Us : 7293404311");
		}
    });
	
	}*/
	function deactivate()
	{
		
		var active=<?=$active?>;
		var endtrail=<?=$endtrail?>;
		if(active==0){if(endtrail<=0){
		var http = new XMLHttpRequest();
var url = "deactivate.php";
var params = "shopid=<?=$_SESSION["admin"]?>";
http.open("POST", url, true);

//Send the proper header information along with the request
http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

http.onreadystatechange = function() {//Call a function when the state changes.
    if(http.readyState == 4 && http.status == 200) {
        if(http.responseText=='success')
		{
			window.location.replace("../index.php?endtrail=1");
		}else
		{
			alert("Please Contact Us : 7293404311");
		}
    }
}
http.send(params);
		}else{return;}}else{return;}}
</script>
