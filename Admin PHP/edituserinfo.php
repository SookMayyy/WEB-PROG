<?php
include 'mysqli_connect.php';
$userid = $_GET['user_id'];
$SQLshow = "SELECT * FROM users where user_id = '$userid';";
$run = mysqli_query($connectDB, $SQLshow);
$data = mysqli_fetch_array($run);
?>

<h2>Edit User Details</h2>
<p>User ID and Role cannot be edited.</p>
<!-- edit user details form where original data is already inputted -->
<!-- if admin does not change some info, it will submit original data -->
<form action="" method="POST">
	<label>User ID: </label>
    <textarea name="user_id" rows="1" cols="60" readonly><?php echo $data['user_id']; ?></textarea>
	<input type="hidden" name="user_id" value="<?php echo $data['user_id']?>">
	
	<label>First Name: </label>
		<textarea name="fname" rows="1" cols="60"><?php echo $data['fname']?></textarea>
	
	<label>Last Name: </label>
		<textarea name="lname" rows="1" cols="60"><?php echo $data['lname']?></textarea>
	
	<label>Gender:</label>
    	<select name="gender">
    		<option value="male" <?php echo $data['gender'] == 'male' ? 'selected' : ''; ?>>Male</option>
  		    <option value="female" <?php echo $data['gender'] == 'female' ? 'selected' : ''; ?>>Female</option>
    	</select>
	
	<label>Birth Date: </label>
		<input type="date" id="birthdate" name="birthdate" value="<?php echo $data['birthdate']; ?>">
	
	<label>Email: </label>
		<textarea name="email" rows="1" cols="60"><?php echo $data['email']?></textarea>
	
	<label>Phone Number: </label>
	<textarea name="phone" rows="1" cols="60"><?php echo $data['phone']?></textarea>
	
	<label>Street: </label>
		<textarea name="street" rows="1" cols="60"><?php echo $data['street']?></textarea>
	
	<label>City: </label>
		<textarea name="city" rows="1" cols="60"><?php echo $data['city']?></textarea>
	
	<label>State: </label>
		<textarea name="state" rows="1" cols="60"><?php echo $data['state']?></textarea>
	
	<label>Postcode: </label>
		<textarea name="postal_code" rows="1" cols="60"><?php echo $data['postal_code']?></textarea>
	
	<label>District: </label>
		<textarea name="district" rows="1" cols="60"><?php echo $data['district']?></textarea>
	
	<label>Role: </label>
    <textarea name="role" rows="1" cols="60" readonly><?php echo $data['role']; ?></textarea>
    <input type="hidden" name="role" value="<?php echo $data['role']; ?>">
	
	<div class="button-group">
		<button type="submit" name="edituser">Edit</button>
		<button type="reset">Reset</button>
	</div>
</form>
<a href="userlist.php" class="button">Return to user list</a>	
