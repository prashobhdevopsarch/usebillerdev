<?php include("includes/config.php");
if(isset($_SESSION["admin"]))
{

if(isset($_GET["delete"]))
{
	$empid=$_GET["empid"];
	$update=$conn->query("UPDATE nfdb_employee SET em_isactive='1' WHERE em_empid='$empid'");
	if($update)
	{
		header("Location:employeelist.php?suc=success");
	}
}
if(isset($_GET["unread"]))
{
	$id=$_GET["id"];
	$update=$conn->query("UPDATE nfdb_message SET msg_isread='0' WHERE msg_mesgid='$id'");
	if($update)
	{
		header("Location:inbox.php?suc=success");
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<!-- BEGIN HEAD -->

<head>
    <meta charset="UTF-8">
    <title>INIFD Admin</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="libs/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/fonts/line-awesome/css/line-awesome.min.css">
    <!--<link rel="stylesheet" type="text/css" href="assets/fonts/open-sans/styles.css">-->

    <link rel="stylesheet" type="text/css" href="assets/fonts/montserrat/styles.css">

    <link rel="stylesheet" type="text/css" href="libs/tether/css/tether.min.css">
    <link rel="stylesheet" type="text/css" href="libs/jscrollpane/jquery.jscrollpane.css">
    <link rel="stylesheet" type="text/css" href="libs/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" type="text/css" href="assets/styles/common.min.css">
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN THEME STYLES -->
    <link rel="stylesheet" type="text/css" href="assets/styles/themes/primary.min.css">
    <link class="ks-sidebar-dark-style" rel="stylesheet" type="text/css" href="assets/styles/themes/sidebar-black.min.css">
    <!-- END THEME STYLES -->

<link rel="stylesheet" type="text/css" href="assets/styles/apps/mail.min.css"> <!-- Customization -->
<link rel="stylesheet" type="text/css" href="libs/datatables-net/media/css/dataTables.bootstrap4.min.css"> <!-- original -->
<link rel="stylesheet" type="text/css" href="assets/styles/libs/datatables-net/datatables.min.css"> <!-- customization -->
<link rel="stylesheet" type="text/css" href="libs/select2/css/select2.min.css"> <!-- Original -->
<link rel="stylesheet" type="text/css" href="assets/styles/libs/select2/select2.min.css"> <!-- Customization -->
<style>
.center {
    margin: auto;
    width: 50%;
    padding: 10px;
	margin-top: 10%;
}
.enable {
    color: #258628;
}
.deleterw
{
	color: #F00;
}
</style>
</head>
<!-- END HEAD -->

<body class="ks-navbar-fixed ks-sidebar-default ks-sidebar-position-fixed ks-page-header-fixed ks-theme-primary ks-page-loading"> <!-- remove ks-page-header-fixed to unfix header -->

    <!-- BEGIN HEADER -->
<?php include("includes/header.php");?>

<!-- END HEADER -->

    <!-- BEGIN DEFAULT SIDEBAR -->

<!-- END DEFAULT SIDEBAR -->











    <div class="ks-column ks-page">
        <div class="ks-header" style="width: 100%;">
            <section class="ks-title">
                <h3>Employee List</h3>
                <?php if(isset($_GET["suc"])){?><div class="alert ks-active-border" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true" class="la la-close"></span>
                                        </button>
                                        Success!!.
                                    </div><?php }?>
                <button class="btn btn-primary-outline ks-light ks-mail-navigation-block-toggle" data-block-toggle=".ks-mail > .ks-navigation">Menu</button>
            </section>
        </div>
        <div class="ks-content">
            <div class="ks-body ks-content-nav">
                
                <div class="ks-nav-body">
                    <div class="ks-nav-body-wrapper">
                        <div class="container-fluid">
                            <table id="ks-datatable-1" class="table table-striped table-bordered ks-multiple-table" width="100%">
                                <thead>
                                <tr>
                                	<th>#</th>
                                    <th>Name</th>
                                    <th>Employee ID</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Employee ID</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th></th>
                                </tr>
                                </tfoot>
                                <tbody>
                                <?php
								$k=1;
								$slct=$conn->query("SELECT * FROM nfdb_employee WHERE em_isactive='0'");
								while($row=$slct->fetch_assoc())
								{
								?>
                                <tr>
                                    
                                    <td><?=$k?></td>
                                    <td><?=$row["em_firstname"]." ".$row["em_lastname"]?></td>
                                    <td><?=$row["em_employeenumber"]?></td>
                                    <td><?=$row["em_phoneoffice"]?></td>
                                    <td><?=$row["em_email"]?></td>
                                    <td><?=$row["em_address"]?></td>
                                    <td><a href="viewemployee.php?empid=<?=$row["em_empid"]?>" class="enable"><span class="ks-icon la la-eye"></span> View</a><br><a href="editemployee.php?empid=<?=$row["em_empid"]?>" ><span class="ks-icon la la-pencil"></span> Edit</a><br><a onClick="return confirm('Are you sure?')" href="employeelist.php?empid=<?=$row["em_empid"]?>&delete" class="deleterw"><span class="ks-icon la la-trash"></span> Delete</a></td>
                                </tr>
                                <?php $k++;
								}?>
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script src="libs/jquery/jquery.min.js"></script>
<script src="libs/responsejs/response.min.js"></script>
<script src="libs/loading-overlay/loadingoverlay.min.js"></script>
<script src="libs/tether/js/tether.min.js"></script>
<script src="libs/bootstrap/js/bootstrap.min.js"></script>
<script src="libs/jscrollpane/jquery.jscrollpane.min.js"></script>
<script src="libs/jscrollpane/jquery.mousewheel.js"></script>
<script src="libs/flexibility/flexibility.js"></script>
<script src="libs/noty/noty.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="assets/scripts/common.min.js"></script>
<!-- END THEME LAYOUT SCRIPTS -->

<script src="libs/datatables-net/media/js/jquery.dataTables.min.js"></script>
<script src="libs/datatables-net/media/js/dataTables.bootstrap4.min.js"></script>
<script src="libs/select2/js/select2.min.js"></script>


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

        $('#ks-datatable-2').DataTable({
            "initComplete": function () {
                $('.dataTables_wrapper select').select2({
                    minimumResultsForSearch: Infinity
                });
            }
        });
    });
})(jQuery);
</script>
<script>

function viewmail(str) {
	$(document).ready(function(){
	$("#maillist"+str).removeClass("ks-new");
	var isread = $("#isread").val();
	if(isread==0)
	{
		var mailcnt = document.getElementById("msgcount").innerHTML;
		mailcnt = mailcnt-1;
		document.getElementById("msgcount").innerHTML=mailcnt;
		$("#isread").val(1);
	}
	
});
	//document.getElementById("mail"+srt).classList.remove("ks-new");
	//document.getElementById("mail"+srt).classList.toggle("ks-newe");
	if (str.length == 0) { 
        document.getElementById("mailboxview").innerHTML = "";
        return;
    } else {
		
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("mailboxview").innerHTML = this.responseText;
				
            }
        };
        xmlhttp.open("GET", "viewmail.php?msgid=" + str, true);
        xmlhttp.send();
    }
}


</script>
<div class="ks-mobile-overlay"></div>

<!-- BEGIN SETTINGS BLOCK -->

<!-- END SETTINGS BLOCK -->
</body>

</html>
<?php }else{header("Location:index.php");}?>