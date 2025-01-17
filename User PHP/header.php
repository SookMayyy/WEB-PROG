<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
ob_start();
include 'mysqli_connect.php';

// Set session timeout duration (15 minutes)
$timeout_duration = 15 * 60; // 15 minutes

//Check if user is logged in
if (!empty($_SESSION['email'])){
    // Check if the session has timed out
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout_duration) {
        // If the session has expired, destroy the session and redirect to the login page
        session_unset();     // Unset session variables
        session_destroy();   // Destroy the session
        header("Location: timeout.php");  // Redirect to timeout page
        exit();
    }
}
// Update last activity time
$_SESSION['last_activity'] = time();  // Store current timestamp
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<ul>
	<li class="logo"><img src="../images/Header/logoPanda.webp" alt="Panda Pagoda Logo"></li>
	<li><a href="Home.php">Home</a></li>
	<li><a href="AboutUs.php">About Us</a></li>
	<li><a href="OurMenu.php">Our Menu</a></li>
	<li><a href="Event.php">Event</a></li>
	<li><a href="Donation.php">Donation</a></li>
	
	<?php 
	if (isset($_SESSION['email'])) { 
	    $email = $_SESSION['email'];
	    $sql = " SELECT * FROM users WHERE email='$email' ";
	    $run= mysqli_query($connectDB, $sql);
	    $data=mysqli_fetch_array($run);
	    
	    if ($data['role'] == 'user') {
	        $fullname= $_SESSION['fname'].' '. $_SESSION['lname'] ; ?>
             <li class="right-menu">
             	<a href="Profile.php"><?php echo $fullname?></a>
             	<a href="Logout.php">Log Out <i class="fa fa-sign-out"></i></a>
             </li> <?php
    	} else {
    	    session_unset();
    	    session_destroy();
    	    ?>   
        	<li class="right-menu">
            	<a href="Login.php">Login</a>
            	<a href="Signin.php">Sign in</a>
            </li> <?php 
	   } 
	   
	} else {
	    ?>
	   <li class="right-menu">
	   		<a href="Login.php">Login</a>
        	<a href="Signin.php">Sign in</a>
       </li> <?php 
	} ?>
</ul>
<?php ob_end_flush(); // Flush output buffer ?>