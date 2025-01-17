<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://fonts.googleapis.com/css?family=Familjen Grotesk' rel='stylesheet'>
	<title>Panda Pagoda</title>
	<link rel="stylesheet" href="../Admin CSS/style.css">
	<link rel="stylesheet" href="../Admin CSS/login.css">
</head>


<body>
	<!-- Navigation Section -->
	<header>
	<nav>
		<?php include 'header.php';?>
	</nav>
	</header>
	
	<!-- Home Section -->
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
		<h1>Admin Homepage</h1>
		<p>Welcome, Admin! You can view, monitor and manage users, order history and donations here.<p>
		<p>Click on one of the Quick Action Buttons to get started!</p>
		
		<h1>Quick Action Buttons</h1>
		<div class="button-group">
			<a href="userlist.php" class="button">Manage Users</a>
			<a href="orderhistory.php" class="button">View all Orders</a>
			<a href="Admin_Menu.php" class="button">View all Menu Items</a>
			<a href="donationlist.php" class="button">View all Donations</a>
		</div>
	</section>
	</div>
	
	<!--Footer Section-->
	<footer class="footer">
		<?php include 'footer.php'; ?>
	</footer>	
	
</body>
</html>
	