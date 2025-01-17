<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://fonts.googleapis.com/css?family=Familjen Grotesk' rel='stylesheet'>
	<title>Panda Pagoda</title>
	<link rel="stylesheet" href="../User CSS/style.css">
	<link rel="stylesheet" href="../User CSS/Donation.css">
</head>

<body>
	<!-- Navigation Section -->
	<header>
	<nav>
		<?php 
		include ('header.php');
		?>
	</nav>
	</header>
	
	<!-- Hero Section -->
	<section id="donation_hero">
		<h1>DONATION</h1>
	</section>
	
	<!-- Quote Section -->
	<section class="donation_quote">
		<h2><span class="quote-mark">“ </span>We believe that every meal matters!<span class="quote-mark"> ”</span></h2>
		<p>Your donation helps us transform surplus ingredients into delicious, sustainable meals that nourish the community and reduce food waste.</p>
	</section>
	
	<!-- Help Us In Section -->
	<section class="help_us_in">
		<h2>HELP US IN</h2>
		
		<div class="container">
			<div class="donate_subcontainer">
				<img src="../images/Donation/help_us_in1.png">
				<h3>Buy Supplier Food from Local Supplier</h3>
				<p>Purchase surplus ingredients from local farmers and food suppliers</p>
			</div>
			
			<div class="donate_subcontainer">
				<img src="../images/Donation/help_us_in2.png">
				<h3>Support Our Food Education Progrom</h3>
				<p>Expand our community education initiatives and event on how to reduce food waste</p>
			</div>
			
			<div class="donate_subcontainer">
				<img src="../images/Donation/help_us_in3.png">
				<h3>Feed those in need</h3>
				<p>Provide affordable meals to families and individuals facing food insecurity</p>
			</div>
		</div>
	</section>
	
	<!-- Donate Payment -->
	<?php 
	   include ('donation_function.php');
	?>
	<section class="donate_payment">
		<h2>SAVE FOOD TOGETHER</h2>
		
		<div class="donate_payment_content">
			<form action=" " method="POST">
			<?php 
			if(!empty($_SESSION['user_id'])){
			?>
				<div class="form_group">
					<p>Full Name</p>
					<input type="text" id="full_name" name="full_name" value="<?php echo $_SESSION['fname']." ".$_SESSION['lname'];?>" readonly><br>
				</div>
				
				<div class="form_group">
					<p>Email Address</p>
					<input type="email" id="email" name="email" value="<?php echo $_SESSION['email']?>" readonly><br>
				</div>
				<?php 
			} else { ?>
				<div class="form_group">
					<p>Full Name</p>
					<input type="text" id="full_name" name="full_name" placeholder="Please login first to donate" readonly><br>
				</div>
				
				<div class="form_group">
					<p>Email Address</p>
					<input type="email" id="email" name="email" placeholder="Please login first to donate" readonly><br>
				</div>
				<?php 
			}?>
				
				<div class="form_group">
					<p>Payment Amount</p>
						<div class="input_container">
							<input type="number" class="payment_box" id="amount" name="amount" placeholder="0.00" required><br>
						</div>
				</div>
				
				<div class="form_group">
					<p>Payment Method</p>
					<select id="donation_method" name="donation_method" required>
        				<option value="" disabled selected>Select payment method</option>
						<option value="credit card">Credit Card</option>
						<option value="debit card">Debit Card</option>
						<option value="e-wallet">E-wallet</option>
						<option value="online banking">Online Banking</option>
					</select>
				</div>
				
				<div class="form_group_submit">
					<button type="submit" class="submit_button" name="donation">Submit</button>
				</div>
			</form>
		</div>
	</section>
	
	<!--Footer Section-->
	<footer class="footer">
		<?php 
		include ('footer.php');
		?>
	</footer>	
</body>
</html>