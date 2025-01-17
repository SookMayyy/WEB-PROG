<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://fonts.googleapis.com/css?family=Familjen Grotesk' rel='stylesheet'>
	<title>Panda Pagoda</title>
	<link rel="stylesheet" href="../Admin CSS/style.css">
</head>


<body>
	<!-- Navigation Section -->
	<header>
	<nav>
		<?php include 'header.php';?>
	</nav>
	</header>
	
	<!-- Donation Section -->
	<?php 
        // Check if admin is logged in
        if (!isset($_SESSION['user_id'])) {
            // Redirect to login page if not logged in
            echo '<script>
                    window.alert("Please login first.");
                    window.location="adminLogin.php";
                  </script>';
            exit(); 
        }
    ?>
	
	<div class="container">
	<section>
		<h1>Donation List</h1>
		<?php 
    		if (isset($_POST['searchdonation'])) {
    		  include 'searchdonation.php';
    		} else {
    		  include 'showdonation.php';
    		}
    	?>
	</section>
	</div>
	
	<!--Footer Section-->
	<footer class="footer">
		<?php include 'footer.php'; ?>
	</footer>	
	
	
</body>
</html>