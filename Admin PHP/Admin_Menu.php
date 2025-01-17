<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://fonts.googleapis.com/css?family=Familjen Grotesk' rel='stylesheet'>
	<title>Panda Pagoda</title>
	<link rel="stylesheet" href="../Admin CSS/style.css">
	<link rel="stylesheet" href="../Admin CSS/adminmenu.css">
</head>


<body>
	<!-- Navigation Section -->
	<header>
	<nav>
		<?php 
		  include 'header.php';
		?>
	</nav>
	</header>
	
    <!-- Admin Menu Section -->
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
	<?php
        // Connect to the database
        include 'mysqli_connect.php';
        //menu sorting
        include 'adminMenu_function.php';
        
        // Get parameters from URL
        $search_term = isset($_GET['search']) ? $_GET['search'] : '';
        $sort_column = isset($_GET['sort_column']) ? $_GET['sort_column'] : 'category';
        $sort_order = isset($_GET['order']) && $_GET['order'] === 'DESC' ? 'DESC' : 'ASC';
        
        // Fetch menu data
        $result = getMenu($connectDB, $search_term, $sort_column, $sort_order);
    ?>
	<h1>Admin Menu</h1>
	
	 <!-- Form for adding a new menu item -->
    <h2>Add New Menu Item</h2>
    <form action="adminMenu_function.php" method="POST" enctype="multipart/form-data">
        <label for="menu_name">Item Name:</label>
        <input type="text" id="menu_name" name="menu_name" required>
        
        <label for="category">Category:</label>
        <select id="category" name="category" required>
            <option value="main dish">Main Dish</option>
            <option value="soups">Soups</option>
            <option value="snacks">Snacks</option>
            <option value="desserts">Desserts</option>
            <option value="beverages">Beverages</option>
            <option value="jam & spread">Jam & Spread</option>
            <option value="sauces">Sauces</option>
        </select>
        
        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>
        
        <label for="price">Price (RM):</label>
        <input type="number" step="0.01" id="price" name="price" required>
        
        <label for="image">Upload Image:</label>
        <input type="file" id="image" name="image" accept="image/*" required>
        
        <button type="submit" name="add_item">Add Item</button>    	              
	</form>
	
    <!--link to import page -->
	<a href="import.php" class="button">Mass import menu items</a>
	
	 
	<h2>Existing Menu Items</h2>
    <!-- form to search menu -->
    <form method="GET" action="">
    	<label>Search menu: </label>
        <input type="text" name="search" placeholder="Search by name or category" value="<?php echo htmlspecialchars($search_term); ?>">
        <button type="submit">Search</button>
        <a href="Admin_Menu.php"><button type="button">Reset</button></a>
    </form>

    <!-- List of existing menu items -->
    
    <table>
        <thead>
            <tr>
                <th><a href="?search=<?php echo urlencode($search_term); ?>&sort_column=menu_name&order=<?php echo $sort_order == 'ASC' ? 'DESC' : 'ASC'; ?>">
                    Item Name<span class="sort-icon <?php echo ($sort_column == 'menu_name' ? ($sort_order == 'ASC' ? 'asc' : 'desc') : ''); ?>"></span>
                </a></th>
                <th><a href="?search=<?php echo urlencode($search_term); ?>&sort_column=category&order=<?php echo $sort_order == 'ASC' ? 'DESC' : 'ASC'; ?>">
                    Category<span class="sort-icon <?php echo ($sort_column == 'category' ? ($sort_order == 'ASC' ? 'asc' : 'desc') : ''); ?>"></span>
                </a></th>
                <th>Description</th>
                <th><a href="?search=<?php echo urlencode($search_term); ?>&sort_column=price&order=<?php echo $sort_order == 'ASC' ? 'DESC' : 'ASC'; ?>">
           			Price<span class="sort-icon <?php echo ($sort_column == 'price' ? ($sort_order == 'ASC' ? 'asc' : 'desc') : ''); ?>"></span>
    			</a></th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
       <?php 
       if (mysqli_num_rows($result) > 0) {
           while ($row = mysqli_fetch_assoc($result)) {
               $menuid = $row['menu_id'];
                    echo "<tr>
                            <td>" . $row["menu_name"] . "</td>
                            <td>" . $row["category"] . "</td>
                            <td>" . $row["description"] . "</td>
                            <td>RM" . $row["price"] . "</td>
                            <td><img src='" . $row["image"] . "' width='100'></td>                             
                            <td><a href='deletemenu.php?menu_id=".$menuid."' class='delete-link'>Delete</a></td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No menu items found</td></tr>";
            }
            ?>
        </tbody>
    </table>
    </div>
	

	<!--Footer Section-->
	<footer class="footer">
		<?php 
		  include 'footer.php';
		?>
	</footer>	
</body>
</html>
