
<!DOCTYPE html>
<?php 		session_start();
            require "php/connect.php";  
	if (!isset($_SESSION['fname'])){
		$_SESSION['fname']=null;
	}
			$source = trim($_POST['scity']);
			//echo $_SESSION['no'],trim($_POST['child']);
			$_SESSION['source']=$source;
			$destination = trim($_POST['dcity']);
			$_SESSION['dest']=$destination;
			$departDate = trim($_POST['departDate']);
			$_SESSION['dDate']=$departDate;
			if (isset($_POST['fclass'])){
				$_SESSION['class']=trim($_POST['fclass']);
			}
			if (isset($_POST['adult_count1'])){
				$adult = trim($_POST['adult_count1']);
				$_SESSION['adult_count1'] = $adult;
			}
			if (isset($_POST['child_count1'])){
				$mychild = trim($_POST['child_count1']);
				$_SESSION['child_count1'] = $mychild;
			}
			//echo $_SESSION['passengers'];
			
			if(isset($_POST['airline'])){
				$flight=$_POST['airline'];
			}
			if(isset($_POST['points'])){
				$range=$_POST['points'];
			}
			if(isset($_POST['dur'])){
				$time=$_POST['dur'];
			}
			//echo $_POST['airline'],$_POST['points'],$_POST['dur'];
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
		<style>
			#map {
				height: 350px;
				width: 100%;
			}
		</style>
		<style>  
			.login-panel {  
				margin-top: 150px;  
			}  
			.table {  
				margin-top: 50px;  
		  
			}  
		</style>  

	</head> 
 
      
	<body id="body" class="body" >
		<?php
			if($view_query=$db->prepare("SELECT countryID from countries where countryName=?")){
				$view_query->bind_param('s', $source);
				$view_query->execute();
				$view_query->bind_result($sid);
				while ($view_query->fetch()) 
				{			
					$_SESSION['sID']=$sid; 

				}
			}
			if($view=$db->prepare("SELECT countryID from countries where countryName=?")){
				$view->bind_param('s', $destination);
				$view->execute();
				$view->bind_result($did);
				while ($view->fetch()) 
				{			
					$_SESSION['dID']=$did; 

				}
			}
			$sid=$_SESSION['sID'];
			$did=$_SESSION['dID'];
		?>
		<?php 
			if ($_SESSION['fname']==null){
				echo '<div id="tologin" style="background-color: #FFC107;height: 34px;">
					<a class="resp-tab-item" href="#" id="loginUp" style="float:right;color:white;">Login/Sign Up</a>
				</div>';
			}
			else{
				echo '<div style="background-color: #FFC107;height: 34px;">
				<a href="php/logout.php" class="resp-tab-item" style="float:right;color:white;" id="loginUp">Hi ';echo $_SESSION['fname'];echo '!</a></div>';
			}
		?>	
		<form action="Flight_details.php" method="post">
			<div style="height:72px;">
				<div style="margin-top: -65px;">
					<label class="h31" style="margin-right: 21px;margin-left: 54px;">From</label>
						<?php
							$sql="SELECT countryName FROM countries"; 
							$result=mysqli_query($db,$sql);
							echo '<input list="scity" class="city1" name="scity" placeholder="Type Departure City" required=""  style="width: 10%;padding: 5px;float:none;" value="';
							echo $_SESSION['source'];
							echo '" type="text" autocomplete = "on">
							<datalist id="scity">';
							while($rows=mysqli_fetch_array($result)){
								ECHO $rows["countryName"];
						?>
						<option value="<?php echo $rows["countryName"]; ?>">
						<?php
							}
						?>
						</datalist>
					<label class="h31" style="margin-right: 10px;margin-left: 52px;">To</label>
						<?php
							$sql="SELECT countryName FROM countries"; 
							$result=mysqli_query($db,$sql);
							echo '<input list="dcity" class="city2" name="dcity" placeholder="Type Destination City" required=""  style="width: 10%;padding: 5px;float:none;" value="';
							echo $_SESSION['dest'];
							echo '" type="text" autocomplete = "on">
							<datalist id="dcity">';
							while($rows=mysqli_fetch_array($result)){
								ECHO $rows["countryName"];
						?>
						<option value="<?php echo $rows["countryName"]; ?>">
						<?php
							}
						?>
						</datalist>
					<label class="h31" style="margin-right: 10px;margin-left: 54px;">Depart</label>
					<input id="datepicker" name="departDate" placeholder="mm/dd/yyyy" value="<?php echo $_SESSION['dDate']; ?>" onfocus="if (this.value == '') {this.value = 'mm/dd/yyyy';this.class = 'hasDatepicker'}" onblur="if (this.value == '') {this.value = 'mm/dd/yyyy';}" required="" style="width: 10%;padding: 5px;margin-bottom:5px;float:none;" type="text">
					<input value="Modify Search" style="margin-right: 10px;margin-left: 75px;" type="submit">
				</div>										
		
		</div>
		</form>
	<!--filter-->
		<div class="clear"></div><br/>

		<!--<img src="images/loading.jpg"/>-->
		  
		<div class="table-scrol">  
			<h1 align="center" style="color:#FFC107;margin-bottom:50px;">Flight Details</h1>  
		</div>

		<form action="Flight_details.php" method="post" style="margin-bottom:-50px;" style="background: rgba(3, 3, 3, 0.0);">
			<div style="height:72px;">
				<div style="margin-top: -65px;">
				<input type="hidden" name="fclass" value="<?php echo $_SESSION['class'];?>">
					<span>
						<label class="h31" style="margin-right: 21px;margin-left: 54px;margin-top:53px">Price</label>
						<?php
							$sql="SELECT min(booking_rate) FROM flight"; 
							$result=mysqli_query($db,$sql);
							while($rows=mysqli_fetch_array($result)){
								$min=$rows["min(booking_rate)"];
							}
							$sql="SELECT max(booking_rate) FROM flight"; 
							$result=mysqli_query($db,$sql);
							while($rows=mysqli_fetch_array($result)){
								$max=$rows["max(booking_rate)"];
							}
										
						?>				
						<span>
							<span style="margin-top:40px;color:white;">$<?php echo $min;?></span>
							<input type="range" style="width:10%;display:inline;" name="points" min="<?php echo $min;?> max="<?php echo $max;?>">						
							<span style="margin-top:40px;color:white;">$<?php echo $max;?></span>
						</span>
					</span>
					<span>
						<label class="h31" style="margin-right: 10px;margin-left: 52px;">Airlines</label>
				
							<?php
								$view_users_query="select distinct v.vendorName from flightvendor v, flight_info f where v.vendorID=f.f_vendorID and f.c_sourceID='$sid' and f.c_destID='$did'";//select query for viewing users.  
								$run=mysqli_query($db,$view_users_query);//here run the sql query.  
								while($row=mysqli_fetch_array($run))//while look to fetch the result and store in a array $row.  
								{  
									$name=$row[0];
									
							?>		<span class="checkbox2">
							<label class="checkbox">
						
								<input data-mini="true" id="airline" name="airline" type="checkbox" value="<?php echo $name;?>">
								<i></i><?php echo $name;?>
							</label>
						</span>
						<?php 
								//}
							}
						?>
					</span>
					<span>
						<label class="h31" style="margin-right: 10px;margin-left: 54px;">Duration(Hrs)</label>
						<?php 
							$view_query="SELECT DISTINCT Travel_Duration FROM flight_info WHERE c_sourceID = '$sid' AND c_destID = '$did'";//select query for viewing users.  
							$run=mysqli_query($db,$view_query);//here run the sql query.  
							while($row=mysqli_fetch_array($run))//while look to fetch the result and store in a array $row.  
							{  
								$dur=$row[0];  
						?>
						<span class="checkbox2">
							<label class="checkbox">
								<input data-mini="true" id="airline" name="dur" type="checkbox" value="<?php echo $dur;?>">
								<i></i><?php echo $dur;?>
							</label>
						</span>
						<?php 
							}
						?>
					</span>
					<input value="Filter" style="margin-right: 10px;margin-left: 40px;" type="submit">
				</div>											
			</div>
		</form>
		<div style="float:right;width:100%">
			<div class="table-responsive" style="margin-bottom: -21px;"><!--this is used for responsive display in mobile and other devices-->  
			 
				<table class="table table-bordered table-hover" style="table-layout: fixed;">  
					<thead style="background-color: #FFC107;">  
						<tr>  
				  
							<th>Flight</th>  
							<th>Start Time</th>  
							<th>Arrival Time</th>  
							<th>Duration(Hrs)</th>  
							<th>Price</th>
							<th></th>	
						</tr>  
					</thead>  
					<?php 
						/*if (!isset($_POST['airline']) && !isset($_POST['dur']) && !isset($_POST['points'])){
							$view_users_query="select concat(f.flightName,' ',v.vendorName),concat(f.departDate,' ',f.departTime),concat(f.arrivalDate,' ',f.arrivalTime),f.Travel_Duration,fl.booking_rate,fl.flight_ID from flightvendor v, flight_info f,flight fl where v.vendorID=f.f_vendorID and f.c_sourceID='$sid' and f.c_destID='$did' and fl.flight_info_ID=f.flight_info_ID;";								
							}
						else if (isset($_POST['airline']) && !isset($_POST['dur']) && !isset($_POST['points'])){
							$view_users_query="select concat(f.flightName,' ',v.vendorName),concat(f.departDate,' ',f.departTime),concat(f.arrivalDate,' ',f.arrivalTime),f.Travel_Duration,fl.booking_rate,fl.flight_ID from flightvendor v, flight_info f,flight fl where v.vendorID=f.f_vendorID and f.c_sourceID='$sid' and f.c_destID='$did' and fl.flight_info_ID=f.flight_info_ID and f.flightName='$flight';";								
							}
						else if (!isset($_POST['airline']) && isset($_POST['dur']) && !isset($_POST['points'])){
							$view_users_query="select concat(f.flightName,' ',v.vendorName),concat(f.departDate,' ',f.departTime),concat(f.arrivalDate,' ',f.arrivalTime),f.Travel_Duration,fl.booking_rate,fl.flight_ID from flightvendor v, flight_info f,flight fl where v.vendorID=f.f_vendorID and f.c_sourceID='$sid' and f.c_destID='$did' and fl.flight_info_ID=f.flight_info_ID and f.Travel_Duration='$time;";								
							}
						else if (isset(!$_POST['airline']) && !isset($_POST['dur']) && isset($_POST['points'])){
							$view_users_query="select concat(f.flightName,' ',v.vendorName),concat(f.departDate,' ',f.departTime),concat(f.arrivalDate,' ',f.arrivalTime),f.Travel_Duration,fl.booking_rate,fl.flight_ID from flightvendor v, flight_info f,flight fl where v.vendorID=f.f_vendorID and f.c_sourceID='$sid' and f.c_destID='$did' and fl.flight_info_ID=f.flight_info_ID and fl.booking_rate='$range';";								
							}
						else if (isset($_POST['airline']) && isset($_POST['dur']) && !isset($_POST['points'])){
							$view_users_query="select concat(f.flightName,' ',v.vendorName),concat(f.departDate,' ',f.departTime),concat(f.arrivalDate,' ',f.arrivalTime),f.Travel_Duration,fl.booking_rate,fl.flight_ID from flightvendor v, flight_info f,flight fl where v.vendorID=f.f_vendorID and f.c_sourceID='$sid' and f.c_destID='$did' and fl.flight_info_ID=f.flight_info_ID;";								
							}
						else if (isset(!$_POST['airline']) && isset($_POST['dur']) && isset($_POST['points'])){
							$view_users_query="select concat(f.flightName,' ',v.vendorName),concat(f.departDate,' ',f.departTime),concat(f.arrivalDate,' ',f.arrivalTime),f.Travel_Duration,fl.booking_rate,fl.flight_ID from flightvendor v, flight_info f,flight fl where v.vendorID=f.f_vendorID and f.c_sourceID='$sid' and f.c_destID='$did' and fl.flight_info_ID=f.flight_info_ID;";								
							}
						else if (isset($_POST['airline']) && !isset($_POST['dur']) && isset($_POST['points'])){
							$view_users_query="select concat(f.flightName,' ',v.vendorName),concat(f.departDate,' ',f.departTime),concat(f.arrivalDate,' ',f.arrivalTime),f.Travel_Duration,fl.booking_rate,fl.flight_ID from flightvendor v, flight_info f,flight fl where v.vendorID=f.f_vendorID and f.c_sourceID='$sid' and f.c_destID='$did' and fl.flight_info_ID=f.flight_info_ID;";								
							}
						else{
							$view_users_query="select concat(f.flightName,' ',v.vendorName),concat(f.departDate,' ',f.departTime),concat(f.arrivalDate,' ',f.arrivalTime),f.Travel_Duration,fl.booking_rate,fl.flight_ID from flightvendor v, flight_info f,flight fl where v.vendorID=f.f_vendorID and f.c_sourceID='$sid' and f.c_destID='$did' and fl.flight_info_ID=f.flight_info_ID;";								
							}
								*/
						$dDate=$_SESSION['dDate'];
						if($view_users_query="select concat(f.flightName,' ',v.vendorName),concat(f.departDate,' ',f.departTime),concat(f.arrivalDate,' ',f.arrivalTime),f.Travel_Duration,fl.booking_rate,fl.flight_ID from flightvendor v, flight_info f,flight fl where v.vendorID=f.f_vendorID and f.c_sourceID='$sid' and f.c_destID='$did' and fl.flight_info_ID=f.flight_info_ID and f.departDate='$dDate';")
						{//select query for viewing users.  
							$run=mysqli_query($db,$view_users_query);//here run the sql query.  
							while($row=mysqli_fetch_array($run))//while look to fetch the result and store in a array $row.  
							{  
								$flight_name=$row[0];  
								$flight_source=$row[1];  
								$flight_dest=$row[2];  
								$flight_duration=$row[3];
								$flight_price=$row[4];
								$flight_ID=$row[5];
					?>  
					<tr>  
			<!--here showing results in the table -->
						<form action="checkout.php" method="POST" style="background: rgba(3, 3, 3, 0.0);">
							<input type="hidden" name="flight_name" value="<?php echo $flight_name;?>">
							<input type="hidden" name="flight_source" value="<?php echo $flight_source; ?>">
							<input type="hidden" name="flight_dest" value="<?php echo $flight_dest; ?>">
							<input type="hidden" name="flight_dur" value="<?php echo $flight_duration; ?>">
							<input type="hidden" name="flight_price" value="<?php echo $flight_price;?>">
							<input type="hidden" name="flight_ID" value="<?php echo $flight_ID;?>">
							<td name="flname" style="background: rgba(3, 3, 3, 0.57);">
								<span style="color:#FFC107;">
									<?php echo $flight_name;  ?>
								</span>
							</td>  
							<td name="flsource" style="background: rgba(3, 3, 3, 0.57);">
								<span style="color:#FFC107;">
									<?php echo $flight_source;  ?>
								<span>
							</td>  
							<td name="fldest" style="background: rgba(3, 3, 3, 0.57);">
								<span style="color:#FFC107;">
									<?php echo $flight_dest;  ?>
								<span>
							</td>  
							<td name="fldur" style="background: rgba(3, 3, 3, 0.57);">
								<span style="color:#FFC107;">
									<?php echo $flight_duration;  ?>
								<span>
							</td>
							<td name="flprice" style="background: rgba(3, 3, 3, 0.57);">
								<span style="color:#FFC107;">
									$<?php echo $flight_price;  ?>
								<span>
							</td>
							<td style="background: rgba(3, 3, 3, 0.57);">
								<button class="btn btn-danger">Book</button>
															<a href="javascript:AlertIt();">Baggage</a>

							</td> <!--btn btn-danger is a bootstrap button to show danger-->  
						</form>
					</tr>  
			  
					<?php 
						}
					}else{
						echo '<h3>Sorry, no flights among these locations are flying for this date!</h3>';
					}
					?>  
			  
				</table>  
			</div>  
		</div>  
		
		<div id="map" style="float:right;width:100%">
		</div>
					<?php 
						$sid=$_SESSION['sID'];
					    $did=$_SESSION['dID'];
						$view_users_query="SELECT latitude,longitude FROM countries WHERE countryID = '$sid'";//select query for viewing users.  
					    $run=mysqli_query($db,$view_users_query);//here run the sql query.  
					    while($row=mysqli_fetch_array($run))//while look to fetch the result and store in a array $row.  
					    {  
					        $_SESSION['c1_latitude']=$row[0];  
					        $_SESSION['c1_longitude']=$row[1];  
					    }
						
						$view_users_query="SELECT latitude,longitude FROM countries WHERE countryID = '$did'";//select query for viewing users.  
					    $run=mysqli_query($db,$view_users_query);//here run the sql query.  
					    while($row=mysqli_fetch_array($run))//while look to fetch the result and store in a array $row.  
					    {  
					        $c2_latitude=$row[0];  
					        $c2_longitude=$row[1];  
					                      
					    }
						?>
		<script>
			
			function AlertIt(){
				confirm("1 bag : 23 KGS");
			}
			/*function initMap() {
	
				var uluru = {lat: 41.8781, lng: 87.6298};
				var map = new google.maps.Map(document.getElementById('map'), {
					zoom: 4,
					center: uluru
				});
				var marker = new google.maps.Marker({
					position: uluru,
					map: map
				});
			}*/
		function initMap() {
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 7,
          center: {lat: 41.85, lng: -87.65}
        });
        directionsDisplay.setMap(map);
          calculateAndDisplayRoute(directionsService, directionsDisplay);
      }

      function calculateAndDisplayRoute(directionsService, directionsDisplay) {
        directionsService.route({
          origin: "new york, ny",
          destination: "chicago, il",//{lat: 56.1304,lng: 106.3468},
          travelMode: 'DRIVING'
        }, function(response, status) {
          if (status === 'OK') {
            directionsDisplay.setDirections(response);
          } else {
           // window.alert('Directions request failed due to ' + status);
          }
        });
      }

		</script>
		<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDU_jOpV1q7GoeRdwxN16Q1L3hBvt-qDQc&callback=initMap">
		</script>
		<!--script for portfolio-->

		<script src="js/jquery.min.js">
		</script>
		<script src="js/easyResponsiveTabs.js" type="text/javascript"></script>
		<link href="css/jquery-ui.css" rel="stylesheet">
		<script src="js/jquery-ui.js">
		</script> 
		<script>
			 $(function() {
			   $( "#datepicker,#datepicker1,#datepicker2,#datepicker3" ).datepicker({ dateFormat: 'yy-mm-dd',minDate: 0 });
			 });
		</script>
		<!-- //Calendar -->
		<!--quantity-->

		<!--//quantity-->
		<!--load more-->

	</body>  
      
</html>  