<!--
    Author: W3layouts
    Author URL: http://w3layouts.com
    License: Creative Commons Attribution 3.0 Unported
    License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<?php 
session_start();
require 'php/connect.php';
        if($_SESSION['success'] == 0){
        }
		else{

		}
    ?>
<html>
<head>
	<title>Airline Reservation System</title>
	<link href="css/style.css" rel="stylesheet">
	<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
	<meta content="Flight Ticket Booking Widget Responsive, Login Form Web Template, Flat Pricing Tables, Flat Drop-Downs, Sign-Up Web Templates, Flat Web Templates, Login Sign-up Responsive Web Template, Smartphone Compatible Web Template, Free Web Designs for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design" name="keywords">
	<script type="application/x-javascript">
	addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } 
	</script>
</head>
<body class="body">
	<div id="overlay"></div>
		<div style="background-color: #FFC107;height: 34px;">
			<a href="php/logout.php" class="resp-tab-item" style="float:right;color:white;" id="loginUp">
			Hi <?php echo $_SESSION['fname'];?>!
			</a>
			<?php
				if ($_SESSION['fname']!=null){
					echo '<a href="history.php" class="resp-tab-item" style="float:right;color:white;" id="loginUp">
						Browse History
					</a>';
				}
			?>
	</div>
	<div class="main-agileinfo">
		<div class="sap_tabs">
			<div id="horizontalTab">
				<ul class="resp-tabs-list">
					<li class="resp-tab-item"><span>Round Trip</span></li>
					<li class="resp-tab-item"><span>One way</span></li>
				</ul>
				<div class="clearfix"></div>
				<div class="resp-tabs-container">
					<div class="tab-1 resp-tab-content roundtrip">
						<form action="Flight_round.php" method="post">
							<div class="from">
								<h3>From</h3>
								<?php
								$sql="SELECT countryName FROM countries"; 
								$result=mysqli_query($db,$sql);
								echo '<input list="scity" class="city1" name="scity" placeholder="Type Departure City" required="" type="text" autocomplete = "on">
								<datalist id="scity">';
								while($rows=mysqli_fetch_array($result)){
									ECHO $rows["countryName"];
								?>
								<option value="<?php echo $rows["countryName"]; ?>">
								<?php
								}
								?>
							</div>
							<div class="to">
								<h3>To</h3>
								<?php
								$sql="SELECT countryName FROM countries"; 
								$result=mysqli_query($db,$sql);
								echo '<input list="dcity" class="city2" name="dcity" placeholder="Type Destination City" required="" type="text" autocomplete = "on">
								<datalist id="dcity">';
								while($rows=mysqli_fetch_array($result)){
									ECHO $rows["countryName"];
								?>
								<option value="<?php echo $rows["countryName"]; ?>">
								<?php
								}
								?>
								</datalist>
							</div>
							<div class="clear"></div>
							<div class="date">
								<div class="depart">
									<h3>Depart</h3>
									<input id="datepicker" name="departDate" onblur="if (this.value == '') {this.value = 'mm/dd/yyyy';}" onfocus="this.value = '';" placeholder="mm/dd/yyyy" required="" type="text" value="mm/dd/yyyy">
								</div>
								<div class="return">
									<h3>Return</h3><input id="datepicker1" name="returnDate" onblur="if (this.value == '') {this.value = 'mm/dd/yyyy';}" onfocus="this.value = '';" placeholder="mm/dd/yyyy" required="" type="text" value="mm/dd/yyyy"> <!--<span class="checkbox1">
                                        <label class="checkbox"><input type="checkbox" name="" checked=""><i> </i>Flexible with date</label>
                                    </span>-->
								</div>
								<div class="clear"></div>
							</div>
							<div class="class">
								<h3>Class</h3>
								<select class="frm-field required" id="w3_country1" onchange="change_country(this.value)" name="fclass">
									<option value="Economy" name="eco">
										Economy
									</option>
									<option value="Premimum" name="pre">
										Premium Economy
									</option>
									<option value="Business" name="bus">
										Business
									</option>
									<option value="First" name="fir">
										First class
									</option>
								</select>
							</div>
							<div class="clear"></div>
							<div class="numofppl">
								<div class="adults">
									<h3>Adult:(12+ yrs)</h3>
									<div class="quantity">
										<div class="quantity-select">
											<div class="entry value-minus adult">
												&nbsp;
											</div>
											<input type = 'text' name = 'adult_count' id = 'adult_count1' value = "1" hidden></input>
											<div class="entry value">
												<span>1</span>
											</div>
											<div class="entry value-plus active adult">
												&nbsp;
											</div>
										</div>
									</div>
								</div>
								<div class="child">
									<h3>Child:(2-11 yrs)</h3>
									<div class="quantity">
										<div class="quantity-select">
											<div class="entry value-minus children">
												&nbsp;
											</div>
											<input type = 'text' name = 'child_count' id = 'child_count1' value = "0" hidden></input>
											<div class="entry value">
												<span>0</span>
											</div>
											<div class="entry value-plus active children">
												&nbsp;
											</div>
										</div>
									</div>
								</div>
								<div class="clear"></div>
							</div>
							<div class="clear"></div><input type="submit" value="Search Flights">
						</form>
					</div>
					<div class="tab-1 resp-tab-content oneway">
						<form action="Flight_details.php" method="post">
							<div class="from">
								<h3>From</h3>
								<?php
									$sql="SELECT countryName FROM countries"; 
									$result=mysqli_query($db,$sql);
									echo '<input list="scity" class="city1" name="scity" placeholder="Type Departure City" required="" type="text" autocomplete = "on">
									<datalist id="scity">';
									while($rows=mysqli_fetch_array($result)){
										ECHO $rows["countryName"];
								?>
								<option value="<?php echo $rows["countryName"]; ?>">
								<?php
									}
								?>	
								</datalist>
							</div>
							<div class="to">
								<h3>To</h3>
								<?php
									$sql="SELECT countryName FROM countries"; 
									$result=mysqli_query($db,$sql);
									echo '<input list="dcity" class="city2" name="dcity" placeholder="Type Destination City" required="" type="text" autocomplete = "on">
									<datalist id="dcity">';
									while($rows=mysqli_fetch_array($result)){
										ECHO $rows["countryName"];
								?>
								<option value="<?php echo $rows["countryName"]; ?>">
								<?php
									}
								?>
								</datalist>
							</div>
							<div class="clear"></div>
							<div class="date">
								<div class="depart">
									<h3>Depart</h3>
									<input class="date" id="datepicker2" name="departDate" onblur="if (this.value == '') {this.value = 'yyyy-mm-dd';}" onfocus="this.value = '';" placeholder="yyyy-mm-dd" required="" type="text" value="yyyy-mm-dd">
								</div>
							</div>
							<div class="class">
								<h3>Class</h3>
								<select class="frm-field required" id="w3_country1" onchange="change_country(this.value)" name="fclass">
									<option value="Economy" name="eco">
										Economy
									</option>
									<option value="Premium" name="pre">
										Premium Economy
									</option>
									<option value="Business" name="bus">
										Business
									</option>
									<option value="First" name="fir">
										First class
									</option>
								</select>
							</div>
							<div class="clear"></div>
							<div class="numofppl">
								<div class="adults">
									<h3>Adult:(12+ yrs)</h3>
									<div class="quantity">
										<div class="quantity-select">
											<div class="entry value-minus adult">
												&nbsp;
											</div>
											<input type = 'text' name = 'adult_count1' id = 'adult_count1' value = "1" hidden></input>
											<div class="entry value">
												<span>1</span>
											</div>
											<div class="entry value-plus active adult">
												&nbsp;
											</div>
										</div>
									</div>
								</div>
								<div class="child">
									<h3>Child:(2-11 yrs)</h3>
									<div class="quantity">
										<div class="quantity-select">
											<div class="entry value-minus children">
												&nbsp;
											</div>
											<input type = 'text' name = 'child_count1' id = 'child_count1' value = "0" hidden></input>
											<div class="entry value">
												<span>0</span>
											</div>
											<div class="entry value-plus active children">
												&nbsp;
											</div>
										</div>
									</div>
								</div>
								<div class="clear"></div>
							</div>
							<div class="clear"></div><input type="submit" value="Search Flights">
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
	               
	               $('#close').click(function(){
	                   $('#myPopup').addClass("is-hidden");
	                   $('#overlay').removeClass("overlay");
	               });
	               $('#close1').click(function(){
	                   $('#myPopup1').addClass("is-hidden");
	                   $('#overlay').removeClass("overlay");
	               });
	               
	               $('#register').click(function(){
	               $('#myPopup1').removeClass("is-hidden");
	               $('#myPopup').addClass("is-hidden");
	               $('#overlay').addClass("overlay");
	               });
				   
	               
	           }); 
			  
	           function popupClose(){
	               $('#myPopup').addClass("is-hidden");
	               $('#myPopup1').addClass("is-hidden");
	               $('#overlay').removeClass("overlay");
	           }
	</script> <!--//script for portfolio-->
	 <!-- Calendar -->
	<link href="css/jquery-ui.css" rel="stylesheet">
	<script src="js/jquery-ui.js">
	</script> 
	<script>
	                         $(function() {
	                           $( "#datepicker,#datepicker1,#datepicker2,#datepicker3" ).datepicker({ dateFormat: 'yy-mm-dd',minDate: 0 });
							   $('#datepicker').on('change', function() {
    $('#datepicker1').datepicker("option", "minDate", $('#datepicker').datepicker('getDate'));
});
$('#datepicker1').on('change', function() {
    $('#datepicker').datepicker("option", "maxDate", $('#datepicker1').datepicker('getDate'));
});
	                         });
	</script> <!-- //Calendar -->
	 <!--quantity-->
	  <!--//quantity-->
	 <!--load more-->
	<script>
			$('.adult.value-plus').on('click', function(){
			  var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)+1;
			  divUpd.text(newVal);
			document.getElementById('adult_count')?document.getElementById('adult_count').value =  newVal:document.getElementById('adult_count1').value =  newVal;
			});			
			$('.adult.value-minus').on('click', function(){
			  var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)-1;
			  if(newVal>=1) divUpd.text(newVal);
				document.getElementById('adult_count')?document.getElementById('adult_count').value =  newVal:document.getElementById('adult_count1').value =  newVal;
					
		  });

			$('.children.value-plus').on('click', function(){
			  var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)+1;
			  divUpd.text(newVal);
			document.getElementById('child_count')?document.getElementById('child_count').value =  newVal:document.getElementById('child_count1').value =  newVal;
		  });

		  $('children.value-minus').on('click', function(){
			  var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)-1;
			  if(newVal>=1) divUpd.text(newVal);
				document.getElementById('child_count')?document.getElementById('child_count').value =  newVal:document.getElementById('child_count1').value =  newVal;
		  });
		</script> 	 
 <!-- //load-more -->
</body>
</html>