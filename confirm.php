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
	<?php 
	if ($_SESSION['fname']!=null){
		echo '<meta http-equiv="refresh" content="5;url=/projects/welcome.php" />';
	}
	else{
		echo '<meta http-equiv="refresh" content="5;url=/projects/" />';	
	}
	?>	
	<meta content="Flight Ticket Booking Widget Responsive, Login Form Web Template, Flat Pricing Tables, Flat Drop-Downs, Sign-Up Web Templates, Flat Web Templates, Login Sign-up Responsive Web Template, Smartphone Compatible Web Template, Free Web Designs for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design" name="keywords">
	<script type="application/x-javascript">
	addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } 
	</script>
</head>
<body class="body">
	<?php
		if (isset($_POST['first_name']) && isset($_POST['dob']) && isset($_POST['telephone']) && isset($_POST['passport'])) 
		{
			//$db->prepare. This avoids sql injection.
			
			$first_name  = trim($_POST['first_name']);
			$dob = trim($_POST['dob']);
			$telephone = trim($_POST['telephone']);
			$passport  = trim($_POST['passport']);
			$user=$_SESSION['login_user'];
			if($view_query=$db->prepare("SELECT phploginuserID from phplogin where email='$user'")){
				$view_query->execute();
				$view_query->bind_result($uid);
				while ($view_query->fetch()) 
				{			
					echo $uid;
				}
			}
			if($register_query = $db->prepare("INSERT INTO passenger (passengerID,phploginuserID,passName, passDOB, Telephone, PassportNo) VALUES(?,?,?,?,?,?)")){
				$register_query->bind_param("iissii", $telephone,$uid,$first_name, $dob, $telephone, $passport);
				$register_query->execute();
				$_SESSION['insert_success']=1;
				$register_query->close();
				
										
							$view_query="SELECT ticketID from passenger where PassportNo='$passport'";//select query for viewing users.  
							$run=mysqli_query($db,$view_query);//here run the sql query.  
							while($row=mysqli_fetch_array($run))//while look to fetch the result and store in a array $row.  
							{  
								$tid=$row[0];
							}	
								
								
								
							if($ticket_query = $db->prepare("INSERT INTO ticket (flightID,passengerID,ticketID,seatNo) VALUES(?,?,?,?)"))
							{	
								$seat=40;
								$ticket_query->bind_param("dddd",$_SESSION['flight_ID'], $telephone,$tid,$seat);
								$ticket_query->execute();
							
							}	

			}
			else{
				$_SESSION['insert_success']=0;
				$error = $db->errno . ' ' . $db->error;
				echo $error; // 1054 Unknown column 'foo' in 'field list'
			}
			
		}
		else 
		{
			echo "Registration Failed. Try again with the correct inputs.\n";
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
					<li class="resp-tab-item"><span>Confirmation</span></li>
				</ul>
				<div class="clearfix"></div>
				<div class="resp-tabs-container">
					<div class="tab-1 resp-tab-content roundtrip">
						<form action="" method="" style="height:224px;">
							<div class="from" style="text-align: center;width:100%;">
								<?php 
									if ($_SESSION['insert_success']==1){
										echo '<h2>Hurray! Your ticket has been booked. Ticket Reference id:';
										if($view_query=$db->prepare("SELECT ticketID from passenger where PassportNo=?"))
										{
											$view_query->bind_param('s', $passport);
											$view_query->execute();
											$view_query->bind_result($sid);
											while ($view_query->fetch()) 
											{			
												echo $sid; 

											}
										}
										echo '</h2>';
										/*if($register_query = $db->prepare("INSERT INTO ticket (passengerID,ticketID,seatNo,payment_ID) VALUES(?,?,?,?)"))
										{
											$register_query->bind_param("dddd", $telephone,$sid,40,250);
											$register_query->execute();
											printf("%d Row inserted. Registration successful \n", $register_query->affected_rows);
										
										}*/

									}
									else{
										echo '<h2>Oops! Seems like the seat is no longer available. Please book again</h2>';
									}
								?>
							</div>
						</form>
					</div>
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
	<script type="text/javascript">
	               $('#pswd1, #cpswd').on('keyup', function () 
	               {
	                   if ($('#pswd1').val() == $('#cpswd').val()) 
	                   {
	                       $('#message').html('Matching').css('color', 'white').required = true;
	                   } else 
	                       $('#message').html('Not Matching').css('color', 'white');
	                       return false;
	               });
	           $(document).ready(function () {
	               $('#horizontalTab').easyResponsiveTabs({
	                   type: 'default', //Types: default, vertical, accordion           
	                   width: 'auto', //auto or any width like 600px
	                   fit: true   // 100% fit in a container
	               });
	               $('#overlay').click(function(){
	                   popupClose();
	               });
	               $('#loginUp').click(function(){
	               $('#myPopup').removeClass("is-hidden");
	               $('#overlay').addClass("overlay");
	               });
	               
	               			   
	               
	           }); 
			  
	          
	</script> <!--//script for portfolio-->
									
	 <!-- Calendar -->
	<link href="css/jquery-ui.css" rel="stylesheet">
	<script src="js/jquery-ui.js">
	</script> 
	 <!-- //Calendar -->
	 <!--quantity-->
	 
	<script>
	                                   $('.value-plus').on('click', function(){
	                                       var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)+1;
	                                       divUpd.text(newVal);
	                                   });

	                                   $('.value-minus').on('click', function(){
	                                       var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)-1;
	                                       if(newVal>=1) divUpd.text(newVal);
	                                   });
	</script> <!--//quantity-->
	 <!--load more-->
	 
	<script>
	   $(document).ready(function () {
	       size_li = $("#myList li").size();
	       x=1;
	       $('#myList li:lt('+x+')').show();
	       $('#loadMore').click(function () {
	           x= (x+1 <= size_li) ? x+1 : size_li;
	           $('#myList li:lt('+x+')').show();
	       });
	       $('#showLess').click(function () {
	           x=(x-1<0) ? 1 : x-1;
	           $('#myList li').not(':lt('+x+')').hide();
	       });
	   });
	</script> <!-- //load-more -->
<!--	<script>
	function mysuggest() {
    loc = "%" + $("input[name=scity]").val() + "%";
}
	</script>-->
</body>
</html>