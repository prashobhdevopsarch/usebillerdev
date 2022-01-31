<?php
 include 'config.php';
 ?>
<?php
session_start();
if(isset($_POST['submit']))
{	
	$username = $_POST['username'];
	$password = $_POST['password'];
	$finyear = $_POST['fyear'];
	
	$st=$conn->query("SELECT * FROM us_shopprofile WHERE sp_username='$username' AND sp_password='$password' AND sp_isactive='0'");
	
	if($st->num_rows>0)	
	{
		$row=$st->fetch_assoc();
		$_SESSION['admin'] = $row["sp_shopid"];
		$_SESSION['name'] = $row["sp_shopname"];
		$_SESSION['user'] = $row["sp_username"];
		$_SESSION['stcode'] = $row["sp_stcode"];
		$_SESSION['finyearid'] = $finyear;
		if($row["sp_acnttype"]==0)
		{
			$_SESSION["startdate"]=$row["sp_adddate"];
		}
		header('Location:vm/dashboard.php');
	}
	else{
		header('Location:index.php?fail=failed');
		
	}
}
?>
<!DOCTYPE html>
<html>
 
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="USe-biller Application">
        <meta name="author" content="Utpara Solutions">


        <title>US eBiller Login</title>
        
        <style>
		body{
  font-family: 'Roboto';
  text-align: center;
  background: #f1f1f1;
}

h3{
  color: #555;
}

#presentation{
  width: 480px;
  height: 120px;
  padding: 20px;
  margin: auto;
  background: #FFF;
  margin-top: 10px;
  box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23); 
  transition: all 0.3s; 
  border-radius: 3px;
}

#presentation:hover{
  box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
  transition: all 0.3s;
  transform: translateZ(10px);
}

#floating-button{
  width: 55px;
  height: 55px;
  border-radius: 50%;
  background: #00aeef;
  position: fixed;
  bottom: 100px;
  left:: 30px;
  cursor: pointer;
  box-shadow: 0px 2px 5px #666;
}

.plus{
  color: white;
  position: absolute;
  top: 0;
  display: block;
  bottom: 0;
  left: 0;
  right: 0;
  text-align: center;
  padding: 0;
  margin: 0;
  line-height: 55px;
  font-size: 38px;
  font-family: 'Roboto';
  font-weight: 300;
  animation: plus-out 0.3s;
  transition: all 0.3s;
}

#container-floating{
  position: fixed;
  width: 70px;
  height: 70px;
  bottom: 30px;
  left: 30px;
  z-index: 50px;
}

#container-floating:hover{
  height: 800px;
  width: 90px;
  padding: 30px;
}

#container-floating:hover .plus{
  animation: plus-in 0.15s linear;
  animation-fill-mode: forwards;
}

.edit{
  position: absolute;
  top: 0;
  display: block;
  bottom: 0;
  left: 0;
  display: block;
  right: 0;
  padding: 0;
  opacity: 0;
  margin: auto;
  line-height: 65px;
  transform: rotateZ(-70deg);
  transition: all 0.3s;
  animation: edit-out 0.3s;
}

#container-floating:hover .edit{
  animation: edit-in 0.2s;
   animation-delay: 0.1s;
  animation-fill-mode: forwards;
}

@keyframes edit-in{
    from {opacity: 0; transform: rotateZ(-70deg);}
    to {opacity: 1; transform: rotateZ(0deg);}
}

@keyframes edit-out{
    from {opacity: 1; transform: rotateZ(0deg);}
    to {opacity: 0; transform: rotateZ(-70deg);}
}

@keyframes plus-in{
    from {opacity: 1; transform: rotateZ(0deg);}
    to {opacity: 0; transform: rotateZ(180deg);}
}

@keyframes plus-out{
    from {opacity: 0; transform: rotateZ(180deg);}
    to {opacity: 1; transform: rotateZ(0deg);}
}

.nds{
  width: 40px;
  height: 40px;
  border-radius: 50%;
  position: fixed;
  z-index: 300;
  transform:  scale(0);
  cursor: pointer;
}

.nd1{
  background: #d3a411;
  left: 40px;
  bottom: 160px;
  animation-delay: 0.2s;
    animation: bounce-out-nds 0.3s linear;
  animation-fill-mode:  forwards;
}

.nd3{
  background: #1746cc;
  left: 40px;
  bottom: 220px;
  animation-delay: 0.15s;
    animation: bounce-out-nds 0.15s linear;
  animation-fill-mode:  forwards;
}

.nd4{
  background: #58c589;
  left: 40px;
  bottom: 280px;
  animation-delay: 0.1s;
    animation: bounce-out-nds 0.1s linear;
  animation-fill-mode:  forwards;
}

.nd5{
  background-image: url('https://lh3.googleusercontent.com/-X-aQXHatDQY/Uy86XLOyEdI/AAAAAAAAAF0/TBEZvkCnLVE/w140-h140-p/fb3a11ae-1fb4-4c31-b2b9-bf0cfa835c27');
  background-size: 100%;
  left: 40px;
  bottom: 340px;
  animation-delay: 0.08s;
  animation: bounce-out-nds 0.1s linear;
  animation-fill-mode:  forwards;
}

@keyframes bounce-nds{
    from {opacity: 0;}
    to {opacity: 1; transform: scale(1);}
}

@keyframes bounce-out-nds{
    from {opacity: 1; transform: scale(1);}
    to {opacity: 0; transform: scale(0);}
}

#container-floating:hover .nds{
  
  animation: bounce-nds 0.1s linear;
  animation-fill-mode:  forwards;
}

#container-floating:hover .nd3{
  animation-delay: 0.08s;
}
#container-floating:hover .nd4{
  animation-delay: 0.15s;
}
#container-floating:hover .nd5{
  animation-delay: 0.2s;
}

.letter{
  font-size: 23px;
  font-family: 'Roboto';
  color: white;
  position: absolute;
  left: 0;
  right: 0;
  margin: 0;
  top: 0;
  bottom: 0;
  text-align: center;
  line-height: 40px;
}

.reminder{
  position: absolute;
  left: 0;
  right: 0;
  margin: auto;
  top: 0;
  bottom: 0;
  line-height: 40px;
}

.profile{
  border-radius: 50%;
  width: 40px;
  position: absolute;
  top: 0;
  bottom: 0;
  margin: auto;
  right: 20px;
}
		</style>

        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="assets/js/modernizr.min.js"></script>
        
    </head>
    <body >
    
     <div>
<marquee><h3 style="color:#006;">For More Details  Call us :+91-9544710795 </h3></marquee>
</div>

        <!--<div class="animationload">
            <div class="loader"></div>
        </div>-->

        <div class="account-pages" style="background-image:url(assets/bg.jpg); background-size: cover; background-repeat: no-repeat;"></div>
        <div class="clearfix"></div>
        <div class="wrapper-page">
        	<div class=" card-box" style="background: rgba(185, 204, 198, 0.5);;">
            <div class="panel-heading" style="text-align: center;"> 
            	<img src="assets/logo.png" style="height: 70px;">
                <!--<h1 style="color:#FFF"><span style="font-size:50px;">US eBiller</span></h1>-->
            </div> 
			<?php
			if(isset($_GET['fail']))
			{
				?>
                <div class="alert alert-danger alert-dismissable">
	                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                 Invalid Username or Password.
	            </div>
                <?php
			}
			?>
            <?php
			if(isset($_GET['endtrail']))
			{
				?>
                <div class="alert alert-danger alert-dismissable">
	                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                 Your trial period has expired, Contact us.<br> PH: +91-9544710795
	            </div>
                <?php
			}
			?>

            <div class="panel-body">
            <form class="form-horizontal" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                
				<div class="form-group ">
                    <div class="col-xs-12">
                       <select class="form-control"  name="fyear" >
  
                                         <?php  
                                        $fyear1= $conn->query("SELECT * FROM us_financialyear ");
                                        while($rowcat=$fyear1->fetch_assoc()) 
										{
										?>
									<option <?php if($rowcat['fy_default']=='1'){ ?> selected  <?php } ?>  value="<?= $rowcat['fy_id']?>"><?= $rowcat['fy_name']?></option>
									<?php } ?>
</select>
                    </div>
                </div>
				
                <div class="form-group ">
                    <div class="col-xs-12">
                        <input class="form-control" type="text" name="username" autocomplete="off" required placeholder="Username">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" type="password" name="password" required placeholder="Password">
                    </div>
                </div>

               
                                
                <div class="form-group text-center">
                    <div class="col-xs-12">
                        <button class="btn btn-pink btn-block text-uppercase waves-effect waves-light" name="submit" type="submit">Log In</button>
                    </div>
                </div>
              <!--  <div style="margin-left:5px; color:#fffff ">
				<b><span style=" color:#309;">Translate to</span></b>
				<a href="mal/" ><b><i style="color:#F00;">Malayalam</i></b></a>
				
				</div>-->

                <div class="form-group m-t-20 m-b-0">
                    <div class="col-sm-12">
                        <p class="text-center m-t-xs text-sm" style="color:#FFF; margin:0px;">2021 © US eBiller application<br/>
                                Powered By <a href="http://utparasolutions.com/" target="_blank" style="color:#441010;">Utpara Technology Pvt. Ltd.</a>
                                </p>
                    </div>
                </div>
            </form> 
            
            </div>   
            </div>                              
                
            
        </div>
        
   

<div id="container-floating">

   <!--<a href="#"><div class="nd5 nds" data-toggle="tooltip" data-placement="right" data-original-title="Simone"></div></a>-->
  <a href="tel:7293404311"><div class="nd4 nds" data-toggle="tooltip" data-placement="right" data-original-title="Phone: 7293404311"><img class="icon icons8-Phone" width="26" height="40" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAACQUlEQVRoQ+2ZMVrCMBiGv7+DjHoD8QTqCXw4gXACZRQGy6J10q3FBZbiCDeQI3gDuYG9gbqBg/FJFKRa0iQtjfi0Y5/8yff+/5ekSQkb/tCG60cJYLuCZQXKCmTMgNxCg24djA1B2JGME4FYE2dXDxm1GIXLAcLgOUX8fNAILW/PSEHGoJQKBEy5/5ZnZUEoARYVKiugbNZYw39voQmAfaXc/EkLhcEYhOMNBvBvQHS9wQC3B6D3x1QAxppoX41S262hQfrmE/oRiHZXjm1RPNekABD0QThPBLAsXg3gzq+C0dMvgD8gXg2Atxr4I4BOFhAME7S9wzVYWrvLdAvxLpOqQKxm6xN6mVINgEeEP+YCr8JbpYZO50U7bTkGqAP0ejuozCIA20tWGqHtNXPUo92VOoCYC906wO5jo1iezHoASVYSNNRA63Ksnb4cAvQBRCWC+Ecewwvg1NC+4O8LfcwAkueDFQgzAGEl8Z3EbyKWJ3XhEOYAMgiHNVL3iNA/BdFQ6je+VMNpyqyZDWAVBH8vW51UxH+TSa9ssgNIIfB7n9AT/4khOe3lA/ANwc8E8SMot4HDOsJSJuILA+AD8dVpazZKPIZyEMKB0RpbSAWWlQ26LsB6RmKTggoHkFnKhMoKwFzop+/7sf1CF8IqwGJuTF0QuUYg1gHmGReTfFr/AlG7MANe0fJW/p/IbxnVtYU45Tl14J2vTFWAjhK6eAVjruzKxh6ALvCK9iVATok07qasgHHqcgosK5BTIo27+QC+PsUx6S2bCAAAAABJRU5ErkJggg==">
    <p class="letter"></p>
  </div></a>
   <a href="https://www.facebook.com/pg/utpara/about/" target="_blank"><div class="nd3 nds" data-toggle="tooltip" data-placement="right" data-original-title="Facebook"><img class="icon icons8-Facebook" width="26" height="40" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAABr0lEQVRoQ2NkGOKAcYi7n2HUAwMdg6MxMOhjwDZgazAjw/9MRkZGZ3o69v///3v/MzBOP7zBey0+e/EmIbvALR2MDIzl9HQ4ul3/GRhbD633qsHlBpwesAnc6sPMwLB5IB0Pt/s/o9fBDV7bsbkFpwfsArceYGRgsB8MHvjPwHDw0HpvB5I8YB+49QMDAwP/YPAAAwPDx4PrvQVI9cD/QeJ4sDMOrvfGmlpwJiH7wK2jHsAWgx6OMgzujtIMhjrCGNIOQdtwRvqgiIGWCmMGGzNxnI4c1B4AhXxFrh7ebDWoPTCh2YLBQFto6HrgwDovDMfXdJxlOHLqJVGF3YDnAWwewJdk0H016gGi4hmPoiEZA9gcjcuPX779YfCJ2TW46gFSPHDh6juGgtoTQ9cDa7Y8YJgy79rQ9cCClbcZQBgXGC2FRmQphOzpIVmMjnoAKQRGM/FoJsbSnB5tjTIw4J4foPaoxGgxOtDjQgMRA1QdWqTQA6QPLQ79wd2AbZ4MjP9xD5VRWjGQop+c4XWQ+UN6ggMWQEN6iomUWB4otaPTrAMV8jB7R2NgNAYoDAEAqqgHQFrb1m4AAAAASUVORK5CYII="> </div></a>
 <a href="http://utparasolutions.com/" target="_blank"> <div class="nd1 nds" data-toggle="tooltip" data-placement="right" data-original-title="About Utpara"><img class="icon icons8-Home" width="26" height="40" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAADGUlEQVRoQ+2YTWgTQRTH3yQgxqw1RKgpG0k92CB46MmLKPSiRFSiF5EebA6KBxWFIhWKxlJQpFBRD34cEhHxZouKwV7ixYunHASJnoJZGgvWELbWgzoyGyduNrM7u9ndhIWdU7J5M/v/vffmzcsg8PhAHtcPPkC/I+hqBJZEcZQAHpCkklugrgEURHECEMopwjHOpCQp7waEKwBt4qlqlyAcB2CKdxHCUYDXojiPELpI9YZ2JpWP65/LrezBGN8+JEmXnEonxwAKopgDhCbU4kcePVW+fjo93gYBGOdTkpRRQ7x7/xVrofbu2cbVxzUw4ymt+OjhNGyfnIbAwIAy/U+jAV/mZmH11eL/5TQQfQEoRiKRdUHIIYA0VUbEJ2ZuMbkrVy+3QWCAxZAsZ8bq9XrPARTx4XARIaTUejKMxFObDgiMS6G1tbENS+XvPUshlvjYmXMwdPaCmYyD5ft3oPbwnnpjl7Y8eTsKQjPl6HBlDxRisWEcDC6oPZ/I3oTo0eOmxFOj1RfPoZKdas0JDI+AMPMA1BCOA5DW4BdCRQQQoW/uRrweBIQ3KxCBHc3y6yiAVnxQECA+OW3Z89owkUhU52bhtyw3f1JBOAbAEk9q/MbkLmbaDJ1v1n/tWL47znz+s/xROSu0EPtO7OeWea4BaQ0wQvM0bYjnjcQThVYByBwWBMgNbhNoCKDta8yI7xaACUEecppAXQCteNLXEM/T09Wo5HQTAboeObUZrYduJJgAhXj8GgBk6aJWxNuJgCEEQDZVrV7XOq4DQK8pM+N5uridCHAi0dEEsgBa/6TMtAaWTi+Lxh1NIGM/sFNIFPPRI8dO6TVlFnXYNlf6p5cLj1OS1GrX6aK6m7i28qOjP7etxMYCscFNTK0+gA2nWprqegTqJxOWBEWeVSzZ+wA8d/kR4HjITyE/hTQe8GQVEgZjIK/UFBRPAiQPpqH8pnk75wP8S0nHeiEz50BPU4h1V2lUibZe2c0rVG2/f7vxwZK93hWLbgR8AI5//QjwNrHnU8jSDuujMfdqsY/aTL3aBzDlJheN/gKQULRAedly5QAAAABJRU5ErkJggg==">
    
  </div></a>

  <div id="floating-button" data-toggle="tooltip" data-placement="right" data-original-title="view">
    <p class="plus" style=" font-style:italic; font-size:33px">i</p>
    <img class="edit" src="http://ssl.gstatic.com/bt/C3341AA7A1A076756462EE2E5CD71C11/1x/bt_compose2_1x.png">
  </div>

</div>


        
    	<script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/wow.min.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>


        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>
	
	</body>

</html>