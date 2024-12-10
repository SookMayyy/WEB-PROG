<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://fonts.googleapis.com/css?family=Familjen Grotesk' rel='stylesheet'>
	<title>Panda Pagoda</title>
	<link rel="stylesheet" href="../User CSS/style.css">
	<link rel="stylesheet" href="../User CSS/login.css">
</head>


<body>
	<!-- Navigation Section -->
	<header>
	<nav>
		<?php include 'header.php';?>
	</nav>
	</header>
	
	<!-- Logout Section -->
	<section class="login">
		<?php
            // If no session variable exists, redirect the user:
            if (!isset($_SESSION['user_id'])) { ?>
                
                <script type="text/javascript">
                    window.alert("Please login first.");
                    window.location='login.php';
                </script>
         <?php   
            } else { // Cancel the session:
                
                session_unset();
                session_destroy();
                echo "You have logged out!";
            }
        ?>
	</section>
	
	<!--Footer Section-->
	<footer class="footer">
		<?php include 'footer.php'; ?>
	</footer>	
	
	
</body>
</html>
