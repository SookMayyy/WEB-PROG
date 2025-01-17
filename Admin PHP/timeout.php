<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://fonts.googleapis.com/css?family=Familjen Grotesk' rel='stylesheet'>
	<title>Panda Pagoda</title>
    <link rel="stylesheet" href="../Admin CSS/style.css">
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
	<section>
		<h3>Your session has expired</h3>
		<h1>You have been inactive for 15 minutes. Please login again.</h1>
		<a href="adminlogin.php">Login</a>
	</section>
	
	<!--Footer Section-->
	<footer class="footer">
		<?php include 'footer.php'; ?>
	</footer>	
	
	
</body>
</html>
