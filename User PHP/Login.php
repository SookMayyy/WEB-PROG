<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://fonts.googleapis.com/css?family=Familjen Grotesk' rel='stylesheet'>
	<title>Panda Pagoda</title>
	<link rel="stylesheet" href="../User CSS/style.css">
	<link rel="stylesheet" href="../User CSS/Login.css">
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
	<section class="login">
		<!-- Left Banner -->
		<div class="pagoda_banner">
			<img src="../images/Login/pagoda_banner.png" alt="Panda_Pagoda_Banner">
		</div>
		
		<!-- Right Banner -->
		<div class="login_content">
			<h2>Log In</h2>
			
			<form action="login_function.php" method="POST">
				<input type="email" id="email" name="email" placeholder="Email" required><br>
				<input type="password" id="password" name="password" placeholder="Password" required><br>
				<input type="hidden" name="userlogin" value="true">
				<button type="submit" class="login_button">Login</button>
			</form>
			
			<p>If you don't have an account yet, join us to start a journey</p>
			
			<a href="Signin.php">
				<button type="submit" class="register_button">Register</button>
			</a>
			
			<a href="Signin.php">Admin Login</a>
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
	