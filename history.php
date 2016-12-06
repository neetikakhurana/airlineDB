
<!DOCTYPE html>
<?php 		session_start();
            require "php/connect.php";  
    ?>
<html>
<!--nitika-->

    <head>
		<title>Airline Reservation System</title>
		<link rel="stylesheet" href="css/style.css">
		<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
		<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="Flight Ticket Booking  Widget Responsive, Login Form Web Template, Flat Pricing Tables, Flat Drop-Downs, Sign-Up Web Templates, Flat Web Templates, Login Sign-up Responsive Web Template, Smartphone Compatible Web Template, Free Web Designs for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design" />
		<script type="application/x-javascript">
			addEventListener("load", function() {
				setTimeout(hideURLbar, 0);
			}, false);

			function hideURLbar() {
				window.scrollTo(0, 1);
			}
		</script>


	</head> 
 
      
	<body id="body" class="body" >

		<?php 
			if ($_SESSION['fname']==""){
				echo '<div id="tologin" style="background-color: #FFC107;height: 34px;">
					<a class="resp-tab-item" href="#" id="loginUp" style="float:right;color:white;">Login/Sign Up</a>
				</div>';
			}
			else{
				echo '<div style="background-color: #FFC107;height: 34px;">
				<a href="php/logout.php" class="resp-tab-item" style="float:right;color:white;" id="loginUp">Hi ';echo $_SESSION['fname'];echo '!</a></div>';
			}
		?>	

	<!--filter-->
		<div class="clear"></div><br/>

		<!--<img src="images/loading.jpg"/>-->
		  
		<div class="table-scrol">  
			<h1 align="center" style="color:#FFC107;margin-bottom:50px;">Flight Details</h1>  
		</div>


		<div style="float:right;width:100%">
			<div class="table-responsive" style="margin-bottom: -21px;"><!--this is used for responsive display in mobile and other devices-->  
			 
				<table class="table table-bordered table-hover" style="table-layout: fixed;">  
					<thead style="background-color: #FFC107;">  
						<tr>  
				  
							<th>TicketID</th>  
							<th>Passenger Name</th>  
							<th>Flight Info</th>  
							<th>Source</th>  
							<th>Destination</th>
							<th></th>	
						</tr>  
					</thead>  
					<?php 
						$login=$_SESSION['login_user'];
						if($view_users_query="SELECT distinct ticket.ticketID,passenger.passName,concat(flight.flight_ID,' ',flightvendor.vendorName),flight_info.c_sourceID,flight_info.c_destID from 
countries,flight,flight_info,flightvendor,ticket,passenger,phplogin where flight.flight_ID=ticket.flightID and ticket.ticketID=passenger.ticketID and flightvendor.vendorID=flight_info.f_vendorID and flight.flight_info_ID=flight_info.flight_info_ID and passenger.phploginuserID=phplogin.phploginuserID and phplogin.phploginuserID in (select phplogin.phploginuserID from phplogin where phplogin.email='$login')")
						{  
							$run=mysqli_query($db,$view_users_query);//here run the sql query.  
							while($row=mysqli_fetch_array($run))//while look to fetch the result and store in a array $row.  
							{  
								$ticketID=$row[0];  
								$passName=$row[1];  
								$flight=$row[2];  
								$source=$row[3];
								$dest=$row[4];
								if ($ticketID==null){
									echo '<h3>Sorry, no flights have been booked by you!</h3>';
								}
								//$flight_price=$row[4];
								//$flight_ID=$row[5];
					?>  
					<tr>  
			<!--here showing results in the table -->  
						<form action="cancel.php" method="POST">
							<input type="hidden" name="ticketID" value="<?php echo $ticketID;?>">
							<input type="hidden" name="passName" value="<?php echo $passName; ?>">
							<input type="hidden" name="flight" value="<?php echo $flight; ?>">
							<input type="hidden" name="source" value="<?php echo $source; ?>">
							<input type="hidden" name="dest" value="<?php echo $dest; ?>">
							<!--<input type="hidden" name="flight_price" value="<?php echo $flight_price;?>">
							<input type="hidden" name="flight_ID" value="<?php echo $flight_ID;?>">-->
							<td name="flname" style="background: rgba(3, 3, 3, 0.57);">
								<span style="color:#FFC107;">
									<?php echo $ticketID;  ?>
								</span>
							</td>  
							<td name="flsource" style="background: rgba(3, 3, 3, 0.57);">
								<span style="color:#FFC107;">
									<?php echo $passName;  ?>
								<span>
							</td>  
							<td name="fldest" style="background: rgba(3, 3, 3, 0.57);">
								<span style="color:#FFC107;">
									<?php echo $flight;  ?>
								<span>
							</td>  
							<td name="fldur" style="background: rgba(3, 3, 3, 0.57);">
								<span style="color:#FFC107;">
									<?php echo $source;  ?>
								<span>
							</td>
							<td name="flprice" style="background: rgba(3, 3, 3, 0.57);">
								<span style="color:#FFC107;">
									<?php echo $dest;  ?>
								<span>
							</td>
							<td style="background: rgba(3, 3, 3, 0.57);">
								<button class="btn btn-danger">Cancel</button>
							</td> <!--btn btn-danger is a bootstrap button to show danger-->  
						</form>
					</tr>  
			  
					<?php 
						}
					}else{
						echo '<h3>Sorry, no flights have been booked by you!</h3>';
					}
					?>  
			  
				</table>  
			</div>  
		</div>  
		

		<!--script for portfolio-->

		<script src="js/jquery.min.js">
		</script>
		<script src="js/easyResponsiveTabs.js" type="text/javascript"></script>
		<link href="css/jquery-ui.css" rel="stylesheet">
		<script src="js/jquery-ui.js">
		</script> 
		<script>
			 $(function() {
			   $( "#datepicker,#datepicker1,#datepicker2,#datepicker3" ).datepicker();
			 });
		</script>
		<!-- //Calendar -->
		<!--quantity-->

		<!--//quantity-->
		<!--load more-->

	</body>  
      
</html>  