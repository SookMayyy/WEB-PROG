<?php
include ('../User PHP/mysqli_connect.php');

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

// Check if form was submitted to delete an item
if (isset($_POST['delete_item'])) {
    $menu_id = $_POST['menu_id'];
    
    // Delete the item from the database
    $sql = "DELETE FROM menu WHERE menu_id='$menu_id'";
    
    if ($connectDB->query($sql) === TRUE) {
        echo "Item deleted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $connectDB->error;
    }
        
    header("Location: Admin_Menu.php");
    exit();
}
?>
}