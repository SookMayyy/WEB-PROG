<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://fonts.googleapis.com/css?family=Familjen Grotesk' rel='stylesheet'>
	<title>Panda Pagoda</title>
	<link rel="stylesheet" href="../User CSS/style.css">
	<link rel="stylesheet" href="../User CSS/EditProfile.css">
</head>


<body>
	<!-- Navigation Section -->
	<header>
    	<nav>
    		<?php include 'header.php';?>
    	</nav>
	</header>
	
	<?php 
        include 'editProfile_function.php';
	?>
	
	<!-- Edit Profile Section -->
	<section class="edit">
    	<h1>Edit Profile</h1>
    
    	<div class="edit_content">
    		<form method="POST" action="editProfile.php">
    			<!-- User Section -->
    			<h3>USER INFORMATION</h3>
    			
    			<div class="edit_container">
        			<p><strong>First Name:</strong></p> 
        			<input type="text" name="fname" value= "<?php echo $_SESSION['fname']; ?>">
    			</div>
    			
    			<div class="edit_container">
        			<p><strong>Last Name:</strong></p> 
        			<input type="text" name="lname" value="<?php echo $_SESSION['lname']; ?>">
    			</div>

    			<div class="edit_container_phone">
        			<p><strong>Phone Number:</strong></p>
        			<input type="text" name="phone_num" value="<?php echo $_SESSION['phone']; ?>">
    			</div>
    			 			
    			<div class="edit_container">
        			<p><strong>Gender:</strong></p> 
        			<div class="radio_group">
        			<input type="radio" id="male" name="gender" value="male" <?php echo ($_SESSION['gender'] == 'male') ? 'checked' : ''; ?>>
        			<label for="male">Male</label>
        			<input type="radio" id="female" name="gender" value="female" <?php echo ($_SESSION['gender'] == 'female') ? 'checked' : ''; ?>>
        			<label for="female">Female</label>
    				</div>
    			</div>
    			
    			<div class="edit_container">
        			<p><strong>Birth Date:</strong></p> 
        			<input type="date" name="birthdate" min="1900-01-01" id="current_date" value="<?php echo $_SESSION['birthdate']; ?>">
    			</div>

				<!-- Address Section -->
    			<h3>ADDRESS INFORMATION</h3>
    			
    			<div class="address">
        			<div class="edit_container_address">
            			<p><strong>Street:</strong></p> 
            			<textarea name="street"><?php echo $_SESSION['street']; ?></textarea>
        			</div>
        			
        			<div class="edit_container_address">
            			<p><strong>City:</strong></p> 
            			<textarea name="city"><?php echo $_SESSION['city']; ?></textarea>
        			</div>
        			
        			<div class="edit_container_address">
            			<p><strong>District:</strong></p> 
            			<textarea name="district"><?php echo $_SESSION['district']; ?></textarea>
        			</div>
        			
        			<div class="edit_container_address">
            			<p><strong>State:</strong></p> 
            			<textarea name="state"><?php echo $_SESSION['state']; ?></textarea>
        			</div>
    			</div>
    			
					<div class="edit_container_address">
            			<p><strong>Postal Code:</strong></p> 
            			<input type="text" name="postal_code" value="<?php echo $_SESSION['postal_code']; ?>">
        			</div>
    			
    			<!-- Account Section -->	
    			<h3>ACCOUNT INFORMATION</h3>
    			
    			<div class="edit_container">
        			<p><strong>Email Address:</strong></p> 
					<p><?php echo $_SESSION['email']; ?></p>
    			</div>
    			
    			<div class="edit_container_password">
        			<p><strong>Current password:</strong></p> 
        			<input type="password" name="password" placeholder="Leave blank if no password change">
    			</div>
    			
    			<div class="edit_container_confirmpass">
        			<p><strong>New Password:</strong></p> 
        			<input type="password" name="newpass" placeholder="Leave blank if no password change">
    			</div>
    				
    			<div class="actions">
    			    <button type="submit" class="cancel" name="canceledit">Cancel</button>
                    <button type="submit" class="edit" name="editprofile">Save</button>
                </div>
                
    		</form>
    	</div>
	</section>
	
	<!--Footer Section-->
	<footer class="footer">
		<?php include 'footer.php'; ?>
	</footer>	
	
	<script>
          const currentDate = new Date().toISOString().split('T')[0];
          // Set the max year is the current date
          document.getElementById('current_date').setAttribute('max', currentDate);
	</script>
	
</body>
</html>