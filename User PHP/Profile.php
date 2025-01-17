<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://fonts.googleapis.com/css?family=Familjen Grotesk' rel='stylesheet'>
	<title>Panda Pagoda</title>
	<link rel="stylesheet" href="../User CSS/style.css">
	<link rel="stylesheet" href="../User CSS/Profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>


<body>
	<!-- Navigation Section -->
	<header>
    	<nav>
    		<?php include 'header.php';?>
    	</nav>
	</header>
	
	<?php 
    	/* Ensure the user is logged in */
    	if (!isset($_SESSION['user_id'])) {
    	    echo '<script>
                    window.alert("Please login first.");
                    window.location="Login.php";
                  </script>';
    	    exit();   	    
    	} else {
    	   include 'profile_function.php';
    	}
	?>
	
	<!-- Profile Section -->
	<section class="profile">
    	<h1>User Profile</h1>
    
    	<div class="profile_content">
    		<form method="POST" action="profile_function.php">
    			<h3>USER INFORMATION</h3>
    			<p><strong>Full Name:</strong> <?php echo $_SESSION['fname']." ".$_SESSION['lname']; ?></p>
                <p><strong>Gender:</strong> <?php echo $_SESSION['gender']; ?></p>
                <p><strong>Phone Number:</strong> <?php echo $_SESSION['phone'];?></p>
                <p><strong>Address:</strong> <?php echo $_SESSION['street'] . ', ' . $_SESSION['city'] . ', ' . $_SESSION['district'] . ', ' . $_SESSION['state'] . ', ' . $_SESSION['postal_code'];?></p>
                <p><strong>Birth Date:</strong> <?php echo $formatted_birthdate ?></p>
    					
    			<h3>ACCOUNT INFORMATION</h3>
    			<p><strong>Email Address:</strong> <?php echo $_SESSION['email']; ?></p>
    			<p><strong>Password:</strong> ******** <span class="grey">(click "Edit" to view password)</span></p>
    			<p><strong>Points Balance:</strong> <?php echo $_SESSION['points_balance']?></p>
                <p><strong>Registration Date:</strong> <?php echo $formatted_register_birthdate; ?></p>
    				
    			<div class="actions">
                    <button type="submit" class="edit" name="edit"><i class="fa fa-pencil"></i> Edit</button>
                    <button type="submit" class="delete" name="delete" onclick="return confirmDelete();"><i class="fa fa-trash-o"></i> Delete Entire Account</button>
                    <a href="OrderHistory.php" class="order_history">Order History >>> </a>
                </div>
    		</form>
    	</div>
	</section>
	
	<!--Footer Section-->
	<footer class="footer">
		<?php include 'footer.php'; ?>
	</footer>	
	
	<script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete your account? This action cannot be undone.");
        }
    </script>
	
</body>
</html>