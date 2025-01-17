<?php
include 'mysqli_connect.php';

//Check if form was submitted to an item
if (isset($_POST['add_item'])) {
    $menu_name = $_POST['menu_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    
    // Handle the uploaded image
    $target_dir = "../menu_upload/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    
    // Move the uploaded image to the target directory
    if ($_FILES["image"]["error"] == UPLOAD_ERR_OK) {
        // No error, so move the file
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    } else {
        echo "Error during file upload: " . $_FILES["image"]["error"];
    }
    
    // Insert the new item into the database
    $sql = "INSERT INTO Menu (menu_name, description, price, image, category) VALUES ('$menu_name', '$description', '$price', '$target_file', '$category')";
    
    if ($connectDB->query($sql) === TRUE) {
        echo "New item added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $connectDB->error;
    }
    
    // Redirect back to Admin Menu page
    header("Location: Admin_Menu.php");
    exit();
}

//SEARCH FUNCTION FOR MENU
function getMenu($connectDB, $search_term = '', $sort_column = 'category', $sort_order = 'ASC') {
    // Define allowed columns and orders
    $allowed_columns = ['menu_name', 'category', 'price'];
    $allowed_orders = ['ASC', 'DESC'];
    
    // Validate sorting column and order
    if (!in_array($sort_column, $allowed_columns)) {
        $sort_column = 'category'; // Default column
    }
    
    if (!in_array($sort_order, $allowed_orders)) {
        $sort_order = 'ASC'; // Default order
    }
    
    // Build base SQL query
    $sql = "SELECT * FROM menu";
    
    // Add search condition if a search term is provided
    if (!empty($search_term)) {
        $search_term = mysqli_real_escape_string($connectDB, trim($search_term));
        $sql .= " WHERE menu_name LIKE '%$search_term%'
                  OR category LIKE '%$search_term%'";
    }
    
    // Add sorting condition
    $sql .= " ORDER BY $sort_column $sort_order";
    
    // Execute query
    $result = mysqli_query($connectDB, $sql);
    
    // Error handling
    if (!$result) {
        die("Query failed: " . mysqli_error($connectDB));
    }
    
    return $result;
}

?>
