<h2>Add New Admin Account</h2> <br>
	
<form action="addadmin_function.php" method="POST">
        <p>First Name:</p>
        <input type="text" id="fname" name="fname" placeholder="First Name" required>

        <p>Last Name:</p>
        <input type="text" id="lname" name="lname" placeholder="Last Name" required>

        <p>Email:</p>
        <input type="email" id="email" name="email" placeholder="Email" required>

        <p>Password:</p>
        <input type="password" id="password" name="password" placeholder="Password" required>

        <p>Confirm Password:</p>
        <input type="password" id="confirmpass" name="confirmpass" placeholder="Confirm Password" required>

        <p>Phone Number:</p>
        <input type="tel" id="phone" name="phone" placeholder="Phone Number" required>

        <p>Street Address:</p>
        <input type="text" id="street" name="street" placeholder="Street Address" required>

        <p>City:</p>
        <input type="text" id="city" name="city" placeholder="City" required>

        <p>State:</p>
        <input type="text" id="state" name="state" placeholder="State" required>

        <p>Postal Code:</p>
        <input type="text" id="postal_code" name="postal_code" placeholder="Postal Code" required>

        <p>District:</p>
        <input type="text" id="district" name="district" placeholder="District" required>

        <p>Gender:</p>
        <div class="radio_group">
            <input type="radio" id="male" name="gender" value="Male">
            <label for="male">Male</label>
            <input type="radio" id="female" name="gender" value="Female">
            <label for="female">Female</label>
        </div>

        <p>Birthdate:</p>
        <input type="date" id="birthdate" name="birthdate" required>
		
		<div class="button-group">
        	<button type="submit" name="userregister">Add</button>
        	<button type="reset">Reset</button>
        </div>
</form>
<a href="userlist.php" class="button">Return to user management page</a>

<script>
      const currentDate = new Date().toISOString().split('T')[0];
//       Set the max year is the current date
      document.getElementById('birthdate').setAttribute('max', currentDate);
</script>
    