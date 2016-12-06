<!DOCTYPE html>
<?php 
    session_start();
    require "php/connect.php";
	if (!isset($_SESSION['fname'])){
		$_SESSION['fname']=null;
	}
    $source = trim($_POST['scity']);
    $_SESSION['source']=$source;
    $destination = trim($_POST['dcity']);
    $_SESSION['dest']=$destination;
    $departDate = trim($_POST['departDate']);
    $_SESSION['dDate']=$departDate;
    $retDate = trim($_POST['returnDate']);
    $_SESSION['rDate']=$retDate;
	if (!isset($_SESSION['lname'])){
		$_SESSION['lname']=null;
	}
	if (!isset($_SESSION['login_user'])){
		$_SESSION['login_user']=null;
	}
	if (isset($_POST['fclass'])){
		$_SESSION['class']=trim($_POST['fclass']);
	}
	if (isset($_POST['adult_count'])){
		$adult = trim($_POST['adult_count']);
		$_SESSION['adult_count'] = $adult;
	}
	if (isset($_POST['child_count'])){
		$mychild = trim($_POST['child_count']);
		$_SESSION['child_count'] = $mychild;
	}
	$_SESSION['count']=-1;

?>
<html>
<head>
	<title>Airline Reservation System</title>
	<link href="css/style.css" rel="stylesheet">
	<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
	<meta content="Flight Ticket Booking Widget Responsive, Login Form Web Template, Flat Pricing Tables, Flat Drop-Downs, Sign-Up Web Templates, Flat Web Templates, Login Sign-up Responsive Web Template, Smartphone Compatible Web Template, Free Web Designs for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design" name="keywords">
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
<body class="body" id="body">
	
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
	<form action="Flight_round.php" method="post">
		<div style="height:72px;">
				<div style="margin-top: -23px;">
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
					<label class="h31" style="margin-right: 10px;margin-left: 54px;">Return</label>
					<input id="datepicker1" name="returnDate" placeholder="mm/dd/yyyy" value="<?php echo $_SESSION['rDate']; ?>" onfocus="if (this.value == '') {this.value = 'mm/dd/yyyy';this.class = 'hasDatepicker'}" onblur="if (this.value == '') {this.value = 'mm/dd/yyyy';}" required="" style="width: 10%;padding: 5px;margin-bottom:5px;float:none;" type="text">
					<input value="Modify Search" style="margin-right: 10px;margin-left: 75px;" type="submit">
				</div>										
			
			</div>

	</form>
	<div class="table-scrol">
		<h1 align="center" style="color:#FFC107;">Flight Details</h1>
		<div style="float:right;width:50%">
			<div style="margin-bottom: -21px;">
				<!--this is used for responsive display in mobile and other devices-->
				<table class="table table-bordered table-hover to_country" style="table-layout: fixed;" id="from">
					<thead style="background-color: #FFC107;">
						<tr>
							<th>Flight</th>
							<th>Start Time</th>
							<th>Arrival Time</th>
							<th>Duration</th>
							<th>Price</th>
							<th></th>
						</tr>
					</thead><?php
						if($view_query=$db->prepare("SELECT countryID from countries where countryName=?")){
					        $view_query->bind_param('s', $source);
					        $view_query->execute();
					        $view_query->bind_result($sid);
					        while ($view_query->fetch()){           
					            $_SESSION['sID']=$sid;
					        }
					    }
					    if($view=$db->prepare("SELECT countryID from countries where countryName=?")){
					        $view->bind_param('s', $destination);
					        $view->execute();
					        $view->bind_result($did);
					        while ($view->fetch()){         
					            $_SESSION['dID']=$did; 
					        }
					    }
					    $sid=$_SESSION['dID'];
					    $did=$_SESSION['sID'];
														$retDate=$_SESSION['rDate'];

					/*	$view_users_query="SELECT latitude,longitude FROM countries WHERE countryID = '$sid'";//select query for viewing users.  
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
					                      
					    }*/
					    if($view_users_query="select concat(f.flightName,' ',v.vendorName),concat(f.departDate,' ',f.departTime),concat(f.arrivalDate,' ',f.arrivalTime),f.Travel_Duration,fl.booking_rate,fl.flight_ID from flightvendor v, flight_info f,flight fl where v.vendorID=f.f_vendorID and f.c_sourceID='$sid' and f.c_destID='$did' and fl.flight_info_ID=f.flight_info_ID and f.arrivalDate='$retDate';")
						{//select query for viewing users.  
							$run=mysqli_query($db,$view_users_query);//here run the sql query. 
							//echo "yooo",count(mysqli_fetch_array($run));							
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
					<form action="rcheckout.php" method="post">
						<!--here showing results in the table -->
						<td style="background: rgba(3, 3, 3, 0.57);">
						<input name="flight_name" type="hidden" value="<?php echo $flight_name; ?>">
						<input name="flight_source" type="hidden" value="<?php echo $flight_source; ?>">
						<input name="flight_dest" type="hidden" value="<?php echo $flight_dest; ?>">
						<input name="flight_dur" type="hidden" value="<?php echo $flight_duration; ?>">
						<input name="flight_price" type="hidden" value="<?php echo $flight_price; ?>">
						<span style="color:#FFC107;"><?php echo $flight_name;  ?></span>
						<input type="hidden" name="flight_ID" value="<?php echo $flight_ID;?>">
						
						<input name="rflight_name" type="hidden" value="">
							<input name="rflight_source" type="hidden" value="">
							<input name="rflight_dest" type="hidden" value="">
							<input name="rflight_dur" type="hidden" value="">
							<input name="rflight_price" type="hidden" value="">
							<input type="hidden" name="rflight_ID" value="">

							<!--<form action="checkout.php" method="post">
								
							</form>-->	
						</td>
						<td style="background: rgba(3, 3, 3, 0.57);">
							<span style="color:#FFC107;"><?php echo $flight_source;  ?>
							</span>
						</td>
						<td style="background: rgba(3, 3, 3, 0.57);">
							<span style="color:#FFC107;"><?php echo $flight_dest;  ?>
							</span>
						</td>
						<td style="background: rgba(3, 3, 3, 0.57);">
							<span style="color:#FFC107;"><?php echo $flight_duration;  ?>
							</span>
						</td>
						<td style="background: rgba(3, 3, 3, 0.57);">
							<span style="color:#FFC107;">$<?php echo $flight_price;  ?>
							</span>
						</td>
						<td style="background: rgba(3, 3, 3, 0.57);">
							<button class="btn btn-danger" type="submit">Book</button>
							<a href="javascript:AlertIt();">Baggage</a>
							
						</td>
					</form>

					</tr>
					<?php }
					}else{
						echo '<h3>Sorry, no flights among these locations are flying for this date!</h3>';
					} ?>
				</table>
			</div>
		</div>
		<div style="float:right;width:50%">
			<div class="table-responsive" style="margin-bottom: -21px;">
				<!--this is used for responsive display in mobile and other devices-->
				<table class="table table-bordered table-hover" style="table-layout: fixed; from_country" id="return">
					<thead style="background-color: #FFC107;">
						<tr>
							<th>Flight</th>
							<th>Start Time</th>
							<th>Arrival Time</th>
							<th>Duration(Hrs)</th>
							<th>Price</th>
							<th></th>
						</tr>
					</thead><?php
					           
					            //echo $_SESSION['dID'],"hh",$_SESSION['sID'];
					            $sid=$_SESSION['sID'];
					            $did=$_SESSION['dID'];
								$departDate=$_SESSION['dDate'];
					           if($view_users_query="select concat(f.flightName,' ',v.vendorName),concat(f.departDate,' ',f.departTime),concat(f.arrivalDate,' ',f.arrivalTime),f.Travel_Duration,fl.booking_rate,fl.flight_ID from flightvendor v, flight_info f,flight fl where v.vendorID=f.f_vendorID and f.c_sourceID='$sid' and f.c_destID='$did' and fl.flight_info_ID=f.flight_info_ID and f.departDate='$departDate';")
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
					            $_SESSION['count']=$_SESSION['count']+1;
					            ?>
					<tr>
						<!--here showing results in the table -->
						<td style="background: rgba(3, 3, 3, 0.57);">
							<input name="dflight_name" type="hidden" value="<?php echo $flight_name; ?>">
							<input name="dflight_source" type="hidden" value="<?php echo $flight_source; ?>">
							<input name="dflight_dest" type="hidden" value="<?php echo $flight_dest; ?>">
							<input name="dflight_dur" type="hidden" value="<?php echo $flight_duration; ?>">
							<input name="dflight_price" type="hidden" value="<?php echo $flight_price; ?>">
							<span style="color:#FFC107;"><?php echo $flight_name;?></span>
							<input type="hidden" name="dflight_ID" value="<?php echo $flight_ID;?>">

							
						</td>
						<td style="background: rgba(3, 3, 3, 0.57);">
						<span style="color:#FFC107;"><?php echo $flight_source;  ?></span>
						</td>
						<td style="background: rgba(3, 3, 3, 0.57);">
						<span style="color:#FFC107;"><?php echo $flight_dest;  ?></span>
						</td>
						<td style="background: rgba(3, 3, 3, 0.57);">
						<span style="color:#FFC107;"><?php echo $flight_duration;  ?></span>
						</td>
						<td style="background: rgba(3, 3, 3, 0.57);">
						<span style="color:#FFC107;">$<?php echo $flight_price;  ?></span>
						</td>
						<td style="background: rgba(3, 3, 3, 0.57);">
						<input type="hidden" name="count" id="count" value="<?php echo $_SESSION['count'];?>">
						<button class="btn btn-danger" id="frombook" onclick="clicked();">Book</button>
													<a href="javascript:AlertIt();">Baggage</a>

						</td>
					</tr>
					<?php }
					}else{
						echo '<h3>Sorry, no flights among these locations are flying for this date!</h3>';
					} ?>
				</table>
			</div>
		</div>
		<div id = "selection"></div>
		<script>
		function AlertIt(){
			confirm("1 bag : 23 KGS");
		}
		/*$('#frombook').on('click',function(){
			alert("hi");
			document.getElementByName('rflight_name').value=document.getElementByName('flight_name').value;
			alert(document.getElementByName('rflight_name').value);
			document.getElementByName('rflight_source').value=document.getElementByName('flight_source').value;
			document.getElementByName('rflight_dest').value=document.getElementByName('flight_dest').value;
			document.getElementByName('rflight_dur').value=document.getElementByName('flight_dur').value;
			document.getElementByName('rflight_price').value=document.getElementByName('flight_price').value;
			document.getElementByName('rflight_ID').value=document.getElementByName('flight_ID').value;
			
		});*/
		function clicked(){
			var index=document.getElementById('count').value;
			document.getElementsByName('rflight_name')[0].value=document.getElementsByName('dflight_name')[0].value;
			document.getElementsByName('rflight_source')[0].value=document.getElementsByName('dflight_source')[0].value;
			document.getElementsByName('rflight_dest')[0].value=document.getElementsByName('dflight_dest')[0].value;
			document.getElementsByName('rflight_dur')[0].value=document.getElementsByName('dflight_dur')[0].value;
			document.getElementsByName('rflight_price')[0].value=document.getElementsByName('dflight_price')[0].value;
			document.getElementsByName('rflight_ID')[0].value=document.getElementsByName('dflight_ID')[0].value;
		}
	/*$('.to_addValues').on('click','button',function(){
		console.log("hi");
	});*/
	/*$(function () {
		$(".to_addValues").click(function () {
        alert("hello");
		var $this = $(this),
            myCol = $this.closest("td"),
            myRow = myCol.closest("tr"),
            targetArea = $("#selection");
        targetArea.append(myRow.children().not(myCol).text() + "<br />");
		alert("hiii"+ targetArea);
    });
});*/
		</script>
		<div id="map" style="float:right;width:100%"></div>
		<div>
			<script>
			function x(){
				 alert('hello');
			 };
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

        /*var onChangeHandler = function() {
        };
        document.getElementById('start').addEventListener('change', onChangeHandler);
        document.getElementById('end').addEventListener('change', onChangeHandler);*/
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
			</script> <!--script for portfolio-->
			 
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
			</script> <!-- //Calendar -->
			 <!--quantity-->
			 
 <!--//quantity-->
			 <!--load more-->
			 

		</div>
	</div>
</body>
</html>