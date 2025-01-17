<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://fonts.googleapis.com/css?family=Familjen Grotesk' rel='stylesheet'>
	<title>Panda Pagoda</title>
    <link rel="stylesheet" href="../User CSS/style.css">
    <link rel="stylesheet" href="../User CSS/timeout.css">
    
</head>


<body>
	<!-- Navigation Section -->
	<header>
	<nav>
		<?php include 'header.php';?>
	</nav>
	</header>
		
	<!-- Body Section -->
	<div class="timeout_container">
    	<section>
    		<h3>Your session has expired</h3>
    		<img src="../images/Header/session_timeout.png">
    		<h1>You have been inactive for 15 minutes. Please login again.</h1>
    		<a href="login.php">Login</a>
    	</section>
	</div>
	
	<!--Footer Section-->
	<footer class="footer">
		<?php include 'footer.php'; ?>
	</footer>	
	
	
</body>
</html>