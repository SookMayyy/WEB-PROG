<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://fonts.googleapis.com/css?family=Familjen Grotesk' rel='stylesheet'>
	<title>Panda Pagoda</title>
	<link rel="stylesheet" href="../Admin CSS/style.css">
	<link rel="stylesheet" href="../Admin CSS/adminmenu.css">
	<link rel="stylesheet" href="../Admin CSS/import.css">
</head>

<body>
	<!-- Navigation Section -->
	<header>
	<nav>
		<?php include 'header.php';?>
	</nav>
	</header>
	
    <!-- import section	 -->
	<div class="container">
	<section class="import">
		
		<?php 
		// Variable to store status messages
		$status_update_message = null;
		$status_update_error = null;

		if(empty($_POST['import'])) {
		?>
			<h1>Import Menu Items</h1>
			<div class="instructions">
                <h2>File Upload Format Instructions</h2>
                <p><strong>1. CSV File Requirements:</strong></p>
                <ul>
                    <li>The file must be in <strong>CSV format</strong>.</li>
                    <li>The first row is dedicated to the header. Please do not include important data on the first row.</li>
                    <li>Each row in the CSV should represent a menu item with the following columns in this exact order:</li>
                    <ul>
                        <li><strong>menu_name:</strong> Name of the menu item.</li>
                        <li><strong>description:</strong> Description of the menu item.</li>
                        <li><strong>price:</strong> Price of the menu item.</li>
                        <li><strong>category:</strong> Category of the menu item. They must be one of these categories in lower case letters ('main dish', 'soups', 'snacks', 'desserts', 'beverages', 'jam & spread', 'sauces').</li>
                        <li><strong>image_file_name:</strong> Name of the image file including its extension (e.g., burger.jpg).</li>
                    </ul>
                </ul>
                <p><strong>2. Image File Requirements:</strong></p>
                <ul>
                    <li>Ensure the <strong>image_file_name</strong> in the CSV matches exactly with the file name of the uploaded image, including the extension (e.g., "pizza.jpg").</li>
                    <li>All images must be uploaded in the "Upload Images" section below.</li>
                    <li>Supported image formats: JPG, PNG.</li>
                </ul>
            </div>

            <!-- Display status update message if any -->
            <?php if ($status_update_message): ?>
                <div class="status-message success"><?php echo htmlspecialchars($status_update_message); ?></div>
            <?php endif; ?>
            <?php if ($status_update_error): ?>
                <div class="status-message error"><?php echo htmlspecialchars($status_update_error); ?></div>
            <?php endif; ?>

			<form action="import.php" method="POST" enctype="multipart/form-data">
                <label>Upload Menu Items (CSV Format):</label>
                <input type="file" name="file" accept=".csv" required>
                
                <label>Upload Images for Menu Items:</label>
                <input type="file" name="image[]" multiple required>
                
                <input type="submit" value="Upload Data CSV" name="import">
            </form>
            
            <a href="Admin_Menu.php" class="button">Go back to Menu List</a>
            

		<?php }else{ 
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
                $fileTmpName = $_FILES['file']['tmp_name'];
                $fileType = $_FILES['file']['type'];
                
                if ($fileType !== 'text/csv' && $fileType !== 'application/vnd.ms-excel') {
                    $status_update_error = "Invalid file type. Please upload a CSV file.";
                } elseif (($handle = fopen($fileTmpName, 'r')) !== false) {
                    include 'mysqli_connect.php';
                    $uploadsDir = "../menu_upload/"; // Directory for uploaded images
                    $rowCount = 0;
                    $successCount = 0;
                    $errorCount = 0;
                    
                    while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                        $rowCount++;
                        if ($rowCount === 1) continue; // Skip header row
                        
                        // Parse CSV data
                        $menuName = mysqli_real_escape_string($connectDB, $data[0]);
                        $description = mysqli_real_escape_string($connectDB, $data[1]);
                        $price = $data[2];
                        $category = mysqli_real_escape_string($connectDB, $data[3]);
                        $imageFileName = $data[4]; // Image file name from the CSV
                        $imageTmpKey = array_search($imageFileName, $_FILES['image']['name']);
                        if ($imageTmpKey !== false) {
                            $imageTmpName = $_FILES['image']['tmp_name'][$imageTmpKey];
                            $imageExt = pathinfo($imageFileName, PATHINFO_EXTENSION);
                            $imageName = uniqid() . '.' . $imageExt;
                            $imagePath = $uploadsDir . $imageName;
                            
                            if (move_uploaded_file($imageTmpName, $imagePath)) {
                                // Insert data into the database
                                $sql = "INSERT INTO menu (menu_name, description, price, category, image)
                                        VALUES ('$menuName', '$description', $price, '$category', '$imagePath')";
                                if (mysqli_query($connectDB, $sql)) {
                                    $successCount++;
                                } else {
                                    $status_update_error .= "Error inserting row $rowCount: " . mysqli_error($connectDB) . ". ";
                                    $errorCount++;
                                }
                            } else {
                                $status_update_error .= "Error uploading image $imageFileName for row $rowCount. ";
                                $errorCount++;
                            }
                        } else {
                            $status_update_error .= "Image file $imageFileName not found in uploaded images. ";
                            $errorCount++;
                        }
                    }
                    
                    fclose($handle);
                    
                    // Summary of the import process
                    $status_update_message = "Import completed: $successCount items imported successfully, $errorCount failed.";
                } else {
                    $status_update_error = "Failed to open uploaded file.";
                }
            } 
        ?>
            
            <!-- Display status update message if any -->
            <?php if ($status_update_message): ?>
                <div class="status-message success"><?php echo htmlspecialchars($status_update_message); ?></div>
            <?php endif; ?>
            <?php if ($status_update_error): ?>
                <div class="status-message error"><?php echo htmlspecialchars($status_update_error); ?></div>
            <?php endif; ?>

            <a href="import.php" class="button">Return to import page</a>
            <?php 
        }
        ?>
       
	</section>
	</div>
	
	<!--Footer Section-->
	<footer class="footer">
		<?php include 'footer.php'; ?>
	</footer>	
	
</body>
</html>