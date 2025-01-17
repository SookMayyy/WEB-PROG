<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href='https://fonts.googleapis.com/css?family=Familjen Grotesk' rel='stylesheet'>
<title>Panda Pagoda</title>
<link rel="stylesheet" href="../User CSS/style.css">
<link rel="stylesheet" href="../Admin CSS/login.css">
</head>


<body>
<!-- Navigation Section -->
<header>
<nav>
<?php include 'header.php';?>
	</nav>
	</header>
	
	<!-- Login Section -->
	<section class="login">
		<?php 
		if(isset($_POST['adminlogin'])) {
		  include 'adminlogin_function.php';
		} else{
		  include 'adminloginform.php';
		}?>
	</section>
	
	<!--Footer Section-->
	<footer class="footer">
		<?php include 'footer.php'; ?>
	</footer>	
	
	
</body>
</html>
	