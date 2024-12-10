<?php 
session_start(); ?>
<ul>
	<li class="logo"><img src="../images/Header/logoPanda.webp" alt="Panda Pagoda Logo"></li>
	<li><a href="Home.php">Home</a></li>
	<li><a href="AboutUs.php">About Us</a></li>
	<li><a href="OurMenu.php">Our Menu</a></li>
	<li><a href="Event.php">Event</a></li>
	<li><a href="Donation.php">Donation</a></li>
	
	<?php 
	if (isset($_SESSION['email'])) { 
	    $fullname= $_SESSION['fname'].' '. $_SESSION['lname'] ; ?>
         <li class="right-menu">
         	<a href="Profile.php"><?php echo $fullname?></a>
         	<a href="Logout.php">Log Out</a>
         </li> <?php  
	}else{ ?>   
    	<li class="right-menu">
        	<a href="Login.php">Login</a>
        	<a href="Signin.php">Sign in</a>
        </li> <?php 
	}
	
// 	// Set session timeout duration (15 minutes)
// 	$timeout_duration = 15 * 60; // 15 minutes
	
// 	// Check if the session has timed out
// 	if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout_duration) {
// 	    // If the session has expired, destroy the session and redirect to the login page
// 	    session_unset();     // Unset session variables
// 	    session_destroy();   // Destroy the session
// 	    header("Location: timeout.php");  // Redirect to login page
// 	    exit();
// 	}
	
// 	// Update last activity time
	//$_SESSION['last_activity'] = time();  // Store current timestamp
	?>	
</ul>