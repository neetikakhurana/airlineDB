<!DOCTYPE html>
<?php 		
	session_start();
    require "php/connect.php";
	$_SESSION['flight_ID']=$_POST['flight_ID'];
	$_SESSION['rflight_name']=$_POST['rflight_name'];
	$_SESSION['rflight_source']=$_POST['rflight_source'];
	$_SESSION['rflight_dest']=$_POST['rflight_dest'];
	$_SESSION['rflight_dur']=$_POST['rflight_dur'];
	$_SESSION['rflight_price']=$_POST['rflight_price'];
	$_SESSION['rflight_ID']=$_POST['rflight_ID'];
	if (!isset($_SESSION['login_user'])){
		$_SESSION['login_user']=null;
	}
?>
<html lang='en'>
	<head>
		<meta charset="UTF-8" /> 
		<title>
			Checkout
		</title>
	  
		<link rel="stylesheet" href="css/style.css">
		<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
		<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	</head>
<!--  Start here -->

	<body class="body">
		<?php 
			if ($_SESSION['fname']==null){
				echo '<div id="tologin" style="background-color: #FFC107;height: 34px;">
					<a class="resp-tab-item" href="#" id="loginUp" style="float:right;color:white;">Login/Sign Up</a>
				</div>';
			}
			else{
				echo '<div style="background-color: #FFC107;height: 34px;">
				<a href="#" class="resp-tab-item" style="float:right;color:white;" id="loginUp">Hi ';echo $_SESSION['fname'];echo '!</a></div>';
			}
		?>	
		<div class="headline">							
			<h1 style="">
				Flight Summary
			</h1>
		</div>
		<div id="wrap">
			<div id="grid">
				<div class="column column1">
					<div class="step" id="step1">
						<div class="number">
							<span>1</span>
						</div>
						<div class="title mycolor">
							<h1>Email Address</h1>
						</div>
						<div class="modify">
							<i class="fa fa-plus-circle"></i>
						</div>
					</div>
					<div class="content" id="email">
						<div>
							<label for="first_name" class="mycolor">Email</label>
							<input type="name" name="first_name" value="<?php echo $_SESSION['login_user'];?>" id="first_name" placeholder="First Name" data-trigger="change" data-validation-minlength="1" data-type="name" data-required="true" data-error-message="Enter Your First Name"/>
						</div>		
					</div>
					<div class="step" id="step2">
						<div class="number">
							<span>2</span>
						</div>
						<div class="title mycolor">
							<h1>Billing Information</h1>
						</div>
					</div>
					<div class="content" id="address">
					<form action="confirm.php" method="post" id="form1">

						<div>

							<div>
								<label for="first_name" class="mycolor">Passenger Name</label>
								<input type="name" name="first_name" value="<?php echo $_SESSION['fname'];?>&nbsp;<?php echo $_SESSION['lname'];?>" id="first_name" placeholder="First Name" data-trigger="change" data-validation-minlength="1" data-type="name" data-required="true" data-error-message="Enter Your First Name"/>
							</div>
							<div>
								<label for="dob" class="mycolor">Date of Birth</label>

								<input type="text" name="dob"  id="dob"  onblur="if (this.value == '') {this.value = 'yyyy-mm-dd';}" onfocus="this.value = '';" placeholder="yyyy-mm-dd" required="" type="text" value="yyyy-mm-dd"/>
							</div>
							<div>
								<label for="telephone" class="mycolor">Telephone</label>

								<input type="phone" name="telephone"  id="telephone" placeholder="(555)-555-5555" data-trigger="change" data-validation-minlength="1" data-type="number" data-required="true" data-error-message="Enter Your Telephone Number"/>
							</div>
							<div>
								<label for="passport" class="mycolor">Passport</label>

								<input type="text" name="passport"  id="passport" placeholder="" data-trigger="change" data-validation-minlength="1"/>
							</div>
						</div>
											     <input type="submit" id="submit-form" class="hidden" />
					</form>
						<div class="is-hidden">
							<div>
								<label for="first_name" class="mycolor">Passenger Name</label>
								<input type="name" name="first_name" value="<?php echo $_SESSION['fname'];?>&nbsp;<?php echo $_SESSION['lname'];?>" id="first_name" placeholder="First Name" data-trigger="change" data-validation-minlength="1" data-type="name" data-required="true" data-error-message="Enter Your First Name"/>
							</div>
							<div>
								<label for="dob" class="mycolor">Date of Birth</label>
								<input type="text" name="dob"  id="dob"  onblur="if (this.value == '') {this.value = 'yyyy-mm-dd';}" onfocus="this.value = '';" placeholder="yyyy-mm-dd" required="" type="text" value="yyyy-mm-dd"/>
							</div>
							<div>
								<label for="telephone" class="mycolor">Telephone</label>
								<input type="phone" name="telephone"  id="telephone" placeholder="(555)-555-5555" data-trigger="change" data-validation-minlength="1" data-type="number" data-required="true" data-error-message="Enter Your Telephone Number"/>
							</div>
							<div>
								<label for="passport" class="mycolor">Passport</label>
								<input type="text" name="passport"  required="required" id="passport" placeholder="" data-trigger="change" data-validation-minlength="1" placeholder="123456"/>
							</div>
						</div>
					</div>

				</div>
				<div class="column column2">
					<div class="step" id="step3">
						<div class="number">
							<span>3</span>
						</div>
						<div class="title mycolor">
							<h1>Flight Details</h1>
						</div>
						<div class="modify">
							<i class="fa fa-plus-circle"></i>
						</div>
					</div>
					<div style="padding-left:47px;font-size:large;" class="subtitle">
						<label for="first_name" style="color:white;padding-top:24px;">Flight name: <?php echo $_SESSION['rflight_name'];?></label><br/>
						<label for="first_name" style="color:white;">From: <?php echo $_SESSION['source'];?></label><br/>
						<label for="first_name" style="color:white;">To: <?php echo $_SESSION['dest'];?></label><br/>
						<label for="first_name" style="color:white;">Class: <?php echo $_SESSION['class'];?></label><br/>
						<label for="first_name" style="color:white;">Seat No: <?php echo '39';?></label><br/>
						
						<label for="first_name" style="color:white;padding-top:24px;">Flight name: <?php echo $_POST['flight_name'];?></label><br/>
						<label for="first_name" style="color:white;">From: <?php echo $_SESSION['dest'];?></label><br/>
						<label for="first_name" style="color:white;">To: <?php echo $_SESSION['source'];?></label><br/>
						<label for="first_name" style="color:white;">Class: <?php echo $_SESSION['class'];?></label><br/>
						<label for="first_name" style="color:white;">Seat No: <?php echo '40';?></label>
						
						
					</div>
					<div class="step" id="step4">
						<div class="number">
							<span>4</span>
						</div>
						<div class="title mycolor">
							<h1>Payment Information</h1>
						</div>
						<div class="modify">
							<i class="fa fa-plus-circle"></i>
						</div>
					</div>
					<div class="content" id="payment">
						<div class="left">
							<div>
								<label for="card_number" class="mycolor">Card Number</label>
								<input type="text" name="card_number" value="1234-5678-9345-3876" id="card_number" placeholder="xxxx-xxxx-xxxx-xxxx" data-trigger="change" data-validation-minlength="1" data-type="name" data-required="true" data-error-message="Enter Your Credit Card Number"/>
							</div>
							<div>
								<label class="mycolor" for="Exp_Date">Valid Thru</label>
								<div class="expiry">	
									<div class="month_select" style="background-color:white;">
										<select name="exp_month" value="02 (Feb)" id="exp_month" placeholder="" data-trigger="change" data-type="name" data-required="true" data-error-message="Enter Your Credit Card Expiration Date">
											<option value = "1">01 (Jan)</option>
											<option value = "2">02 (Feb)</option>
											<option value = "3">03 (Mar)</option>
											<option value = "4">04 (Apr)</option>
											<option value = "5">05 (May)</option>
											<option value = "6">06 (Jun)</option>
											<option value = "7">07 (Jul)</option>
											<option value = "8">08 (Aug)</option>
											<option value = "9">09 (Sep)</option>
											<option value = "10">10 (Oct)</option>
											<option value = "11">11 (Nov)</option>
											<option value = "12">12 (Dec)</option>
										</select>
									</div>
									<div class="year_select" style="background-color:white;">
										<select name="exp_year" value="16 (Mar)" id="exp_year" placeholder="" data-trigger="change" data-type="name" data-required="true" data-error-message="Enter Your Credit Card Expiration Date">
											<option value = "1">14 </option>
											<option value = "2">15 (Feb)</option>
											<option value = "3">16 (Mar)</option>
											<option value = "4">17 (Apr)</option>
											<option value = "5">18 (May)</option>
											<option value = "6">19 (Jun)</option>
											<option value = "7">20 (Jul)</option>
											<option value = "8">22 (Aug)</option>
											<option value = "9">23 (Sep)</option>
											<option value = "10">24 (Oct)</option>
											<option value = "11">25 (Nov)</option>
											<option value = "12">26 (Dec)</option>
										</select>
									</div>
									<label class="mycolor" for="Exp_Date">Exp Date</label>
									<input type="text" name="Exp_Date" value="07/23"/>
								</div>
							</div>
							<div class="sec_num">
								<div>
									<label for="ccv" class="mycolor">Security Code</label>
									<input type="text" name="ccv" value="***" id="ccv" placeholder="123" data-trigger="change" data-validation-minlength="3" data-type="name" data-required="true" data-error-message="Enter Your Card Security Code"/>
								</div>
							</div>
						</div>
						<div class="right">
							<div class="accepted">
								<span><img src="images/Z5HVIOt.png"></span>
								<span><img src="images/Le0Vvgx.png"></span>
								<span><img src="images/D2eQTim.png"></span>
								<span><img src="images/Pu4e7AT.png"></span>
								<span><img src="images/ewMjaHv.png"></span>
								<span><img src="images/3LmmFFV.png"></span>
							</div>
						</div>
					</div>
				</div>
				<div class="column column3">
					<div class="step" id="step5">
						<div class="number">
							<span>5</span>
						</div>
						<div class="title mycolor">
							<h1>Finalize Booking</h1>
						</div>
						<div class="modify">
							<i class="fa fa-plus-circle"></i>
						</div>
					</div>
					<div class="content" id="final_products">
						<div class="left" id="ordered">
						<div class="products" style="color:white;">
								<div class="product_image">
									<img src="images/lady.jpg" width="70%" style="margin-left:-24px;"/>
								</div>
								<div class="product_details" style="color:white;">
									<span class="product_name">
										<?php echo $_POST['rflight_name'];?>
									</span>
									<span class="price">
										$<?php 
											if ($_SESSION['class']=='Economy'){
												echo $_SESSION['rflight_price'];
												//$_SESSION['rflight_price'] = ($_SESSION['rflight_price'] * $_SESSION['adult_count']) + (($_SESSION['rflight_price']/2) * $_SESSION['child_count']);
											}
											else if ($_SESSION['class']=='Premimum'){
												$_SESSION['rflight_price'] = $_SESSION['rflight_price']*2;
												echo $_SESSION['rflight_price'];
												//$_SESSION['rflight_price'] = ($_SESSION['rflight_price'] * $_SESSION['adult_count']) + (($_SESSION['rflight_price']/2) * $_SESSION['child_count']);
											}
											else if ($_SESSION['class']=='Business'){
												$_SESSION['rflight_price'] = $_SESSION['rflight_price']*3;
												echo $_SESSION['rflight_price'];
												//$_SESSION['rflight_price'] = ($_SESSION['rflight_price'] * $_SESSION['adult_count']) + (($_SESSION['rflight_price']/2) * $_SESSION['child_count']);	
											}
											else{
												$_SESSION['rflight_price'] = $_SESSION['rflight_price']*5;
												echo $_SESSION['rflight_price'];
												//$_SESSION['rflight_price'] = ($_SESSION['rflight_price'] * $_SESSION['adult_count']) + (($_SESSION['rflight_price']/2) * $_SESSION['child_count']);
											}
										?>.00
									</span>
									<span class="quantity" style="width:19%;">&nbsp;&nbsp;X <?php echo $_SESSION['adult_count'];?></span>
								</div>
								<div class="product_details" style="color:white;">
									<span class="price">Child : 
										$<?php 
											if ($_SESSION['class']=='Economy'){
												echo $_SESSION['rflight_price']/2;
												$_SESSION['rflight_price'] = ($_SESSION['rflight_price'] * $_SESSION['adult_count']) + (($_SESSION['rflight_price']/2) * $_SESSION['child_count']);
												
											}
											else if ($_SESSION['class']=='Premimum'){
												//$_SESSION['rflight_price'] = $_SESSION['rflight_price']*2;
												echo $_SESSION['rflight_price']/2;
												$_SESSION['rflight_price'] = ($_SESSION['rflight_price'] * $_SESSION['adult_count']) + (($_SESSION['rflight_price']/2) * $_SESSION['child_count']);
												//echo $_SESSION['rflight_price'];
											}
											else if ($_SESSION['class']=='Business'){
												echo $_SESSION['rflight_price']/2;
												//$_SESSION['rflight_price'] = $_SESSION['rflight_price']*3;
												$_SESSION['rflight_price'] = ($_SESSION['rflight_price'] * $_SESSION['adult_count']) + (($_SESSION['rflight_price']/2) * $_SESSION['child_count']);
												//echo $_SESSION['rflight_price'];
											}
											else{
												//$_SESSION['rflight_price'] = $_SESSION['rflight_price']*5;
												echo $_SESSION['rflight_price']/2;
												$_SESSION['rflight_price'] = ($_SESSION['rflight_price'] * $_SESSION['adult_count']) + (($_SESSION['rflight_price']/2) * $_SESSION['child_count']);
												
											}
										?>.00
									</span>
									<span class="quantity" style="width:19%;">&nbsp;&nbsp;X <?php echo $_SESSION['child_count'];?></span>
								</div>
							</div>
							<div class="products" style="color:white;">
								<div class="product_image">
									<img src="images/lady.jpg" width="70%" style="margin-left:-24px;"/>
								</div>
								<div class="product_details" style="color:white;">
									<span class="product_name">
										<?php echo $_POST['flight_name'];?>
									</span>
									<span class="price">
										$<?php 
											if ($_SESSION['class']=='Economy'){
												echo $_POST['flight_price'];
											}
											else if ($_SESSION['class']=='Premimum'){
												echo $_POST['flight_price']*2;
												$_SESSION['flight_price']=$_POST['flight_price']*2;
												
											}
											else if ($_SESSION['class']=='Business'){
												echo $_POST['flight_price']*3;
												$_SESSION['flight_price']=$_POST['flight_price']*3;
											}
											else{
												echo $_POST['flight_price']*5;
												$_SESSION['flight_price']=$_POST['flight_price']*5;
											}
										?>.00
									</span>
									<span class="quantity" style="width:19%;">&nbsp;&nbsp;X <?php echo $_SESSION['adult_count'];?></span>
									<!--<span class="quantity" style="width:19%;">Child:&nbsp;&nbsp;X <?php //echo $_SESSION['child_count'];?></span>-->

								</div>
							</div>
							
							
							<div class="totals" style="color:white;">
								<span class="subtitle " style="color:white;">Subtotal 
									<span id="sub_price">
										$<?php echo $_POST['flight_price']+$_SESSION['rflight_price'];?>.00
									</span>
								</span>
								<span class="subtitle" style="color:white;">Tax <span id="sub_tax">$20.00</span></span>
							</div>
							<div class="final" style="color:white;">
								<span class="title">Total <span id="calculated_total">$<?php $price=$_POST['flight_price']+$_SESSION['rflight_price']; echo $price+20;?>.00</span></span>
							</div>
						</div>	
						<div class="right" id="reviewed">
							<div class="billing">
								<div class="clear"></div>
								<div id="complete">
									<label for="submit-form" class="big_button" id="complete">Complete Booking</label>
								</div>
								<div>
									<?php if ($_SESSION['fname']!=null){
										echo '<a href="welcome.php" style="color:white;float:right;font-size:large;">Cancel Booking?</a>';
									}
									else{
										echo '<a href="index.php" style="color:white;float:right;font-size:large;">Cancel Booking?</a>';
									}
									?>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
		<script>
$(document).ready(function () {				
			   $( '#dob' ).datepicker();
			   $('#form1').removeClass('form');
			 });
		</script>

	</body>
</html>
