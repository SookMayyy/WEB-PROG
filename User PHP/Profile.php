<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://fonts.googleapis.com/css?family=Familjen Grotesk' rel='stylesheet'>
	<title>Panda Pagoda</title>
	<link rel="stylesheet" href="../User CSS/style.css">
	<link rel="stylesheet" href="../User CSS/Profile.css">
</head>

<body>
	<!-- Navigation Section -->
	<header>
	<nav>
		<?php 
		  include ('header.php');
		?>
	</nav>
	</header>
	
	<?php 
	   include ('profile_function.php');
	?>
	
	<h1>User Profile</h1>
	
	<div class="profile-container">
    <h1>Profile Details</h1>
    
    <!-- Display user details -->
    <form method="POST" action="Profile.php">
         <div class="form-group">
              <label for="fname">First Name:</label>
              <input type="text" id="fname" name="fname" value="<?= $user_data['fname']; ?>" required>
         </div>

         <div class="form-group">
              <label for="lname">Last Name:</label>
              <input type="text" id="lname" name="lname" value="<?= $user_data['lname']; ?>" required>
          </div>

          <div class="form-group">
              <label for="email">Email:</label>
              <input type="email" id="email" name="email" value="<?= $user_data['email']; ?>" required>
          </div>

          <div class="form-group">
              <label for="phone">Phone Number:</label>
              <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($user_data['phone']); ?>" required>
          </div>

          <div class="form-group">
              <label for="address">Address:</label>
              <textarea id="address" name="address" required><?= htmlspecialchars($user_data['address']); ?></textarea>
          </div>

          <button type="submit" name="update_profile">Update Profile</button>
   </form>

     <!-- Order History Section -->
     <h2>Order History</h2>
        <div class="order-history">
            <?php
            // Check if there are orders to display
            if (isset($order_history) && !empty($order_history)) {
                echo "<table>";
                echo "<tr><th>Order ID</th><th>Date</th><th>Items</th><th>Total</th></tr>";
                foreach ($order_history as $order) {
                    echo "<tr>";
                    echo "<td>" . $order['order_id'] . "</td>";
                    echo "<td>" . $order['order_date'] . "</td>";
                    echo "<td>" . $order['items'] . "</td>";
                    echo "<td>RM " . $order['total_price'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>You have no order history yet.</p>";
            }
            ?>
        </div>
   </div>

<?php
if (isset($_SESSION['phone'])) {
    echo "Phone: " . $_SESSION['phone'] . "<br>";
} else {
    echo "Phone number is not set in session.<br>";
}

if (isset($_SESSION['address'])) {
    echo "Address: " . $_SESSION['address'] . "<br>";
} else {
    echo "Address is not set in session.<br>";
}
?>
	</div>

</body>
</html>
	