<?php
    include ('mysqli_connect.php');

    // Check if the user is logged in
    if (!isset($_SESSION['user_id'])) {
        echo '<script>
                alert("Please sigin to complete order!");
                window.location = "Login.php";
              </script>';
        exit();      
    }
    
    // Fetch user data 
    $user_id = $_SESSION['user_id'];
    $user_data = getUserProfile($connectDB, $user_id);
    
    // Function to fetch user data
    function getUserProfile($connectDB, $user_id) {
        $sql = "SELECT * FROM users WHERE user_id = ?";
        $stmt = $connectDB->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    
    // Function to update user profile
    function updateUserProfile($connectDB, $user_id, $fname, $lname, $gender, $phone, $password, $street, $city, $state, $postal_code, $district) {
        $sql = "UPDATE users SET fname=?, lname=?, gender=?, phone=?, password=?, street=?, city=?, state=?, postal_code=?, district=? WHERE user_id=?";
        $stmt = $connectDB->prepare($sql);
        $stmt->bind_param("ssssssssssi", $fname, $lname, $gender, $phone, $password, $street, $city, $state, $postal_code, $district, $user_id);
        return $stmt->execute();
    }
    
    if(isset($_POST['update_profile'])) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $gender = $_POST['gender'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $street = $_POST['street'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $postal_code = $_POST['postal_code'];
        $district = $_POST['district'];
    }
    
    // Call update function
    if (updateUserProfile($connectDB, $user_id, $fname, $lname, $gender, $phone, $password, $street, $city, $state, $postal_code, $district)) {
        $_SESSION['update_success'] = "Profile updated successfully!";
    } else {
        $_SESSION['error_message'] = "Failed to update profile!";
    }
    
    header ("Location: Profile.php");
    exit();
    
    /*// Fetch user data from the database if not already set in session
    if (!isset($_SESSION['profile_data'])) {
        $user_id = $_SESSION['user_id'];
        $sql = "SELECT * FROM users WHERE user_id = ?";
        $stmt = $connectDB->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $user_data = $result->fetch_assoc();
            
            // Store user data in session
            $_SESSION['profile_data'] = [
                'fname' => $user_data['fname'],
                'lname' => $user_data['lname'],
                'email' => $user_data['email'],
                'phone' => $user_data['phone'],
                'address' => $user_data['street'] . ', ' . $user_data['city'] . ', ' . $user_data['state'] . ', ' . $user_data['postal_code'],
            ];
        }
        $stmt->close();
    }
    
    // Fetch order history
    $order_history = [];
    $sql_orders = "SELECT * FROM orders WHERE user_id = ? ORDER BY order_date DESC";
    $stmt_orders = $connectDB->prepare($sql_orders);
    $stmt_orders->bind_param("i", $_SESSION['user_id']);
    $stmt_orders->execute();
    $result_orders = $stmt_orders->get_result();
    
    while ($row = $result_orders->fetch_assoc()) {
        // Collecting orders in an array for display
        $order_history[] = [
            'order_id' => $row['order_id'],
            'order_date' => $row['order_date'],
            'items' => $row['items'], // Assuming `items` is stored as a string
            'total_price' => $row['total_price']
        ];
    }
    $stmt_orders->close();
    
    // Handle profile update form submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $new_fname = htmlspecialchars($_POST['fname']);
        $new_lname = htmlspecialchars($_POST['lname']);
        $new_email = htmlspecialchars($_POST['email']);
        $new_phone = htmlspecialchars($_POST['phone']);
        $new_address = htmlspecialchars($_POST['address']); // Assuming this is a combined address field
        
        // Update user data in the database
        $sql_update = "UPDATE users SET fname = ?, lname = ?, email = ?, phone = ? WHERE user_id = ?";
        $stmt_update = $connectDB->prepare($sql_update);
        $stmt_update->bind_param("ssssi", $new_fname, $new_lname, $new_email, $new_phone, $_SESSION['user_id']);
        $stmt_update->execute();
        $stmt_update->close();
        
        // Update session with new profile data
        $_SESSION['profile_data'] = [
            'fname' => $new_fname,
            'lname' => $new_lname,
            'email' => $new_email,
            'phone' => $new_phone,
            'address' => $new_address
        ];
        
        // Provide feedback to the user
        echo "<script>alert('Profile updated successfully!');</script>";
    }*/
    
?>