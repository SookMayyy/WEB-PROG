<?php
include 'mysqli_connect.php';

if (isset($_POST['editprofile'])) {
    
    $user_id = $_SESSION['user_id'];
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $gender=$_POST['gender'];
    $birthdate=$_POST['birthdate'];
    $pass=$_POST['password'];
    $newpass=$_POST['newpass'];
    $phone=$_POST['phone_num'];
    $street=$_POST['street'];
    $city=$_POST['city'];
    $state=$_POST['state'];
    $postcode=$_POST['postal_code'];
    $district=$_POST['district'];
    
    // Validation
    $mobile_pattern = "/^01[0-46-9]{1}-\d{7,8}$/";
    $pass_pattern = "/^(?=.*[A-Z])(?=.*\d)(?=.*\W).{8,}$/";
    $postcode_pattern = "/^[0-9]{5}$/";
    
    // Validate input
    if (empty($fname) || empty($lname) || empty($gender) || empty($birthdate) || empty($phone) || empty($street) || empty($district) || empty($postcode) || empty($city) || empty($state)) {
        echo "<script>alert('All fields except password are required.');
              window.location='EditProfile.php'</script>";
    } elseif (!preg_match($mobile_pattern, $phone)) {
        echo "<script>alert('Phone number must follow the Malaysian format and contain 11 digits.');
              window.location='EditProfile.php'</script>";
    } elseif (!preg_match($postcode_pattern, $postcode)) {
        echo "<script>alert('Postcode must be exactly 5 digits.');
              window.location='EditProfile.php'</script>";
    } else {
        $SQLeditprofile = "UPDATE users SET fname='$fname', lname='$lname', gender='$gender', birthdate='$birthdate',
                         phone='$phone', street='$street', city='$city', state='$state', postal_code='$postcode', district='$district'";
        
        // Fetch current password from the database
        $query = "SELECT password FROM users WHERE user_id = '$user_id'";
        $result = mysqli_query($connectDB, $query);
        $row = mysqli_fetch_assoc($result);
        $stored_password = $row['password'];
        
        // Check if current password is provided
        if (!empty($pass) && !empty($newpass)) {
            //check if current password is correct
            if (!password_verify($pass, $stored_password)) {
                echo "<script>alert('The current password you entered is incorrect.');
                      window.location='EditProfile.php'</script>";
                exit();
            } elseif (!preg_match($pass_pattern, $newpass)) {
                echo "<script>alert('Password must be at least 8 characters long, contain one capital letter, one number, and one special character.');
                      window.location='EditProfile.php'</script>";
                exit();
            }
            
            // Hash password and add to query
            $hashed_pass = password_hash($newpass, PASSWORD_DEFAULT);
            $SQLeditprofile .= ", password='$hashed_pass'";
        }
        
        $SQLeditprofile .= " WHERE user_id = '$user_id'";
        
        // Execute the query
        $run = mysqli_query($connectDB, $SQLeditprofile);
        
        if ($run) {
            // Update session variables
            $_SESSION['fname'] = $fname;
            $_SESSION['lname'] = $lname;
            $_SESSION['gender'] = $gender;
            $_SESSION['birthdate'] = $birthdate;
            $_SESSION['phone'] = $phone;
            $_SESSION['street'] = $street;
            $_SESSION['city'] = $city;
            $_SESSION['state'] = $state;
            $_SESSION['postal_code'] = $postcode;
            $_SESSION['district'] = $district;
            
            echo "<script>alert('Your user details have been updated.');
                  window.location='Profile.php'</script>";
        } else {
            echo "<script>alert('Sorry, there was a problem updating your user details.');
                  window.location='Profile.php'</script>";
        }
    }
}

if (isset($_POST['canceledit'])) {
    echo "<script>window.location='Profile.php';</script>";
}
?>
