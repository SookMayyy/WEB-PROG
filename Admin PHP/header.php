<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
ob_start();
include 'mysqli_connect.php';

// Set session timeout duration (15 minutes)
$timeout_duration = 15 * 60; // 15 minutes

//Check if admin is logged in
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

<ul>
	<li class="logo"><img src="../images/Header/logoPanda.webp" alt="Panda Pagoda Logo"></li>
	<li><a href="adminhome.php">Home</a></li>
	<li><a href="userlist.php">User List</a></li>
	<li><a href="orderhistory.php">Order History</a></li>
	<li><a href="Admin_Menu.php">Menu List</a></li>
	<li><a href="donationlist.php">Donation</a></li>
	
	<?php 
	if (isset($_SESSION['email'])) { 
	    $email = $_SESSION['email'];
	    $sql = " SELECT * FROM users WHERE email='$email' ";
	    $run= mysqli_query($connectDB, $sql);
	    $data=mysqli_fetch_array($run);
	    if ($data['role'] == 'admin') {
    	    $fullname= $_SESSION['fname'].' '. $_SESSION['lname'] ; ?>
             <li class="right-menu">
                 <span class="fullname"><?php echo $fullname?></span>
                 <a href="adminlogout.php">Log Out</a>
             </li> <?php
    	} else {
    	    session_unset();
    	    session_destroy();
    	    ?>   
        	<li class="right-menu">
            	<a href="adminlogin.php">Login</a>
            	<a href="../User PHP/Signin.php">Sign in</a>
            </li> <?php 
	   } 
	} else {
	    ?>
	   <li class="right-menu">
	   <a href="adminlogin.php">Login</a>
	   <a href="../User PHP/Signin.php">Sign in</a>
	   </li> <?php 
	} ?>
</ul>
<?php ob_end_flush(); // Flush output buffer ?>