<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://fonts.googleapis.com/css?family=Familjen Grotesk' rel='stylesheet'>
	<title>Panda Pagoda</title>
	<link rel="stylesheet" href="../User CSS/style.css">
	<link rel="stylesheet" href="../User CSS/ShoppingCart.css">
</head>


<body>
	<!-- Navigation Section -->
	<header>
	<nav>
		<?php 
		  include ('../User PHP/header.php');
		?>
	</nav>
	</header>
	
	<h1>Admin Menu</h1>
	
	 <!-- Form for adding a new menu item -->
    <h2>Add New Menu Item</h2>
    <form action="adminMenu_function.php" method="POST" enctype="multipart/form-data">
        <label for="menu_name">Item Name:</label>
        <input type="text" id="menu_name" name="menu_name" required><br>
        
        <label for="category">Category:</label>
        <select id="category" name="category" required>
            <option value="main dish">Main Dish</option>
            <option value="soups">Soups</option>
            <option value="snacks">Snacks</option>
            <option value="desserts">Desserts</option>
            <option value="beverages">Beverages</option>
            <option value="jam & spread">Jam & Spread</option>
            <option value="sauces">Sauces</option>
        </select><br>
        
        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea><br>
        
        <label for="price">Price (RM):</label>
        <input type="number" step="0.01" id="price" name="price" required><br>
        
        <label for="image">Upload Image:</label>
        <input type="file" id="image" name="image" accept="image/*" required><br>
        
        <button type="submit" name="add_item">Add Item</button>
</form>

    <!-- List of existing menu items -->
    <h2>Existing Menu Items</h2>
    <table>
        <thead>
            <tr>
                <th>Item Name</th>
                <th>Category</th>
                <th>Description</th>
                <th>Price</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Connect to the database
            include '../User PHP/mysqli_connect.php';

            $sql = "SELECT * FROM Menu";
            $result = $connectDB->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["menu_name"] . "</td>
                            <td>" . $row["category"] . "</td>
                            <td>" . $row["description"] . "</td>
                            <td>RM" . $row["price"] . "</td>
                            <td><img src='" . $row["image"] . "' width='100'></td>                             <td>
                                <form action='adminMenu_function.php' method='POST'>
                                    <input type='hidden' name='menu_id' value='" . $row['menu_id'] . "'>
                                    <button type='submit' name='delete_item'>Delete</button>
                                </form>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No menu items found</td></tr>";
            }
            ?>
        </tbody>
    </table>
	

	<!--Footer Section-->
	<footer class="footer">
		<?php 
		  include ('../User PHP/footer.php');
		?>
	</footer>	
</body>
</html>