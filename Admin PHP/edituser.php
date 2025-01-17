<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://fonts.googleapis.com/css?family=Familjen Grotesk' rel='stylesheet'>
	<title>Panda Pagoda</title>
	<link rel="stylesheet" href="../Admin CSS/style.css">
	<link rel="stylesheet" href="../Admin CSS/editform.css">
</head>


<body>
	<!-- Navigation Section -->
	<header>
	<nav>
		<?php include 'header.php';?>
	</nav>
	</header>
	
	<!-- Edit Section -->
	<div class="container">
	<section>
		<h1>User Management</h1>
		<?php 
		if(isset($_POST['edituser'])) {
		  include 'edituser_function.php';
		} else{
		  include 'edituserinfo.php';
		}?>
	</section>
	</div>
	
	<!--Footer Section-->
	<footer class="footer">
		<?php include 'footer.php'; ?>
	</footer>	
	
	
</body>
</html>
	