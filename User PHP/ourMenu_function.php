<?php
include ('mysqli_connect.php'); // Database connection

// Define categories
$categories = ['main dish', 'desserts', 'beverages', 'snacks', 'soups', 'jam & spread', 'sauces'];

// Loop through each category to display items under that category
foreach ($categories as $category) {
    echo "<div id='$category'>";
    echo "<h2>" . ucfirst($category) . "</h2>";
    echo "<div class='menu_items'>";
    
    // Fetch all menu items from the database for the current category
    $sql = "SELECT menu_id, menu_name, price, image, description FROM Menu WHERE category = '$category' "; // Only display available items
    $result = $connectDB->query($sql);
    
    if ($result->num_rows > 0) {
        // Loop through each menu item and display
        while ($row = $result->fetch_assoc()) { ?>
            <div class='menu_item_card'>
                <form method="POST" action="ShoppingCart.php">
                    <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['menu_name']; ?>">
                    <p><?php echo $row['menu_name']; ?></p>
                    <p class="price">RM<?php echo number_format($row['price'], 2); ?></p>

                    <!-- Hidden Inputs -->
                    <input type="hidden" name="menu_id" value="<?php echo $row['menu_id']; ?>">
                    <input type="hidden" name="image" value="<?php echo $row['image']; ?>">
                    <input type="hidden" name="menu_name" value="<?php echo $row['menu_name']; ?>">
                    <input type="hidden" name="description" value="<?php echo $row['description']; ?>">
                    <input type="hidden" name="unit_price" value="<?php echo $row['price']; ?>">
                    <input type="hidden" name="quantity" value="1">

                    <!-- Add to Cart Button -->
                    <button type="submit" class="add_to_cart" name="add_to_cart">Add to Cart</button>
                </form>
            </div>
        <?php }
    } else {
        echo '<p>No menu items available in this category.</p>';
    }

    echo "</div>"; // End of .menu_items
    echo "</div>"; // End of category div
}

?>