<!--
    Author: W3layouts
    Author URL: http://w3layouts.com
    License: Creative Commons Attribution 3.0 Unported
    License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<?php session_start();
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	//To debug for errors during connection to DB
	require 'php/connect.php';
	require 'php/security.php';
	//global $log_success=False;
    ?>
<html>
<head>
	<title>Airline Reservation System</title>
	<link href="css/style.css" rel="stylesheet">
	<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
	<meta http-equiv="refresh" content="5;url=/projects/welcome.php" />
	<meta content="Flight Ticket Booking Widget Responsive, Login Form Web Template, Flat Pricing Tables, Flat Drop-Downs, Sign-Up Web Templates, Flat Web Templates, Login Sign-up Responsive Web Template, Smartphone Compatible Web Template, Free Web Designs for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design" name="keywords">
	<script type="application/x-javascript">
	addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } 
	</script>
</head>
<body class="body">
	<?php
		if (isset($_POST['ticketID']) && isset($_POST['passName']) && isset($_POST['flight']) && isset($_POST['source'])) 
		{
			//$db->prepare. This avoids sql injection.
			
			$ticketID  = trim($_POST['ticketID']);
			$passName = trim($_POST['passName']);
			$flight = trim($_POST['flight']);
			$passport  = trim($_POST['source']);

			
				if($view_query=$db->prepare("delete from ticket where ticketID='$ticketID'")){
					$view_query->execute();
								$_SESSION['delete_success']=1;

				}
				else{
								$_SESSION['delete_success']=0;

				}
			
			if($view_query=$db->prepare("delete from passenger where ticketID='$ticketID'")){
					$view_query->execute();
								$_SESSION['delete_success']=1;

				}
				else{
								$_SESSION['delete_success']=0;

				}
		}
		else 
		{
			$_SESSION['delete_success']=0;
			echo "Deletion Failed. Try again with the correct inputs.\n";
			echo nl2br("\n");
			die($db->error);
			echo 'Could not fetch rows from your table- check your query again';
			echo nl2br("\n");
		}	
	?>
	<div id="overlay"></div>

	<div class="main-agileinfo">
		<div class="sap_tabs">
			<div id="horizontalTab">
				<ul class="resp-tabs-list">
					<li class="resp-tab-item"><span>Confirmation<br/>
					</span></li>
				</ul>
				<div class="clearfix"></div>
				<div class="resp-tabs-container">
						<form action="" method="" style="height:224px;">
							<div class="from" style="text-align: center;width:100%;">
								<?php 
									if ($_SESSION['delete_success']==1){
										echo '<h2>Your Reference ticket ',$ticketID,' has been cancelled.';
										echo '</h2>';

									}
									else{
										echo '<h2>Oops! Seems like you are late! Go to the counter for cancellation.</h2>';
									}
								?>
							</div>
						</form>
				</div>
			</div>
		</div>
	</div>
	<div class="footer-w3l">
		<p class="footer-new">&copy; 2016 Airline Reservation System . Isha Potnis, Kaushik Velusamy, Nitika Khurana</p>
	</div><!--script for portfolio-->
	<script src="js/jquery.min.js">
	</script> 
	<script src="js/easyResponsiveTabs.js" type="text/javascript">
	</script> 
	 <!--//script for portfolio-->
									
	 <!-- Calendar -->
	<link href="css/jquery-ui.css" rel="stylesheet">
	<script src="js/jquery-ui.js">
	</script> 
	 <!-- //Calendar -->
	 <!--quantity-->
	 
 <!--//quantity-->
	 <!--load more-->
	 
 <!-- //load-more -->
<!--	<script>
	function mysuggest() {
    loc = "%" + $("input[name=scity]").val() + "%";
}
	</script>-->
</body>
</html>