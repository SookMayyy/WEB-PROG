<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://fonts.googleapis.com/css?family=Familjen Grotesk' rel='stylesheet'>
	<title>Panda Pagoda</title>
	<link rel="stylesheet" href="../User CSS/style.css">
	<link rel="stylesheet" href="../User CSS/Signin.css">
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
	
	<!-- Login Section -->
	<section class="signin">
		<!-- Left Banner -->
		<div class="pagoda_banner">
			<img src="../images/Signin/pagoda_banner2.png" alt="Panda_Pagoda_Banner">
		</div>
		
		<!-- Right Banner -->
		<div class="sigin_content">
            
            <h2>Create your account</h2>
			
			<form action="register.php" method="POST">
                <div class="form_group">
                    <p>First Name</p>
                    <input type="text" id="fname" name="fname" placeholder="First Name" required><br>
                </div>
            
                <div class="form_group">
                    <p>Last Name</p>
                    <input type="text" id="lname" name="lname" placeholder="Last Name" required><br>
                </div>
            
                <div class="form_group">
                    <p>Email</p>
                    <input type="email" id="email" name="email" placeholder="Email" required><br>
                </div>
            
                <div class="form_group">
                    <p>Password</p>
                    <input type="password" id="password" name="password" placeholder="Password" required><br>
                </div>
            
                <div class="form_group">
                    <p>Confirm Password</p>
                    <input type="password" id="confirmpass" name="confirmpass" placeholder="Confirm Password" required><br>
                </div>
            
                <div class="form_group">
                    <p>Phone Number</p>
                    <input type="tel" id="phone" name="phone" placeholder="Phone Number e.g 012-3456789" required><br>
                </div>
            
                <div class="form_group">
                    <p>Street Address</p>
                    <input type="text" id="street" name="street" placeholder="Street Address" required><br>
                </div>
            
                <div class="form_group">
                    <p>City</p>
                    <input type="text" id="city" name="city" placeholder="City" required><br>
                </div>
            
                <div class="form_group">
                    <p>State</p>
                    <input type="text" id="state" name="state" placeholder="State" required><br>
                </div>
            
                <div class="form_group">
                    <p>Postal Code</p>
                    <input type="text" id="postal_code" name="postal_code" placeholder="Postal Code" required><br>
                </div>
            
                <div class="form_group">
                    <p>District</p>
                    <input type="text" id="district" name="district" placeholder="District" required><br>
                </div>
            
                <div class="form_group">
                    <p>Gender</p>
                    <div class="radio_group">
                        <input type="radio" id="male" name="gender" value="Male">
                        <label for="male">Male</label>
                        <input type="radio" id="female" name="gender" value="Female">
                        <label for="female">Female</label>
                    </div>
                </div>
            
                <div class="form_group">
                    <p>Birthdate</p>
                    <input type="date" id="birthdate" name="birthdate" min="1900-01-01" required><br>
                </div>
            
                <button type="submit" class="signin_button">Sign In</button>
            </form>
		</div>
	</section>
	
	<!--Footer Section-->
	<footer class="footer">
		<?php 
		  include ('footer.php');
		?>
	</footer>	
	
	<script>
          const currentDate = new Date().toISOString().split('T')[0];
          // Set the max year is the current date
          document.getElementById('birthdate').setAttribute('max', currentDate);
	</script>
	
</body>
</html>
	