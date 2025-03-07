<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'mysqli_connect.php';
    //fields to input info
    
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $gender=$_POST['gender'];
    $birthdate=$_POST['birthdate'];
    $email=$_POST['email'];
    $pass=$_POST['password'];
    $confirmpass=$_POST['confirmpass'];
    $phone=$_POST['phone'];
    $street=$_POST['street'];
    $city=$_POST['city'];
    $state=$_POST['state'];
    $postcode=$_POST['postal_code'];
    $district=$_POST['district'];
    
    //validation regex
    $mobile_pattern = "/^01[0-46-9]{1}-\d{7,8}$/";
    $pass_pattern = "/^(?=.*[A-Z])(?=.*\d)(?=.*\W).{8,}$/";
    $postcode_pattern = "/^[0-9]{5}$/";
    
    //validate input
    if (empty($fname) || empty($lname) || empty($gender) || empty($birthdate) || empty($email) || empty($pass) || empty($confirmpass) || empty($phone) || empty($street) || empty($district) || empty($postcode) || empty($city) || empty($state)) {
        echo "<script>alert('All fields are required.');
              window.location='addadmin.php'</script>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format.');
              window.location='addadmin.php'</script>";
    } elseif ($pass !== $confirmpass) {
        echo "<script>alert('Passwords do not match.');
              window.location='addadmin.php'</script>";
    } elseif (!preg_match($pass_pattern, $pass)) {
        echo "<script>alert('Password must be at least 8 characters long, contain one capital letter, one number, and one special character.');
              window.location='addadmin.php'</script>";
    } elseif (!preg_match($mobile_pattern, $phone)) {
        echo "<script>alert('Phone number must follow the Malaysian format and contain 11 digits.');
              window.location='addadmin.php'</script>";
    } elseif (!preg_match($postcode_pattern, $postcode)) {
        echo "<script>alert('Postcode must be exactly 5 digits.');
              window.location='addadmin.php'</script>";
    } else {
        // Check if email already exists
        $checkEmailQuery = "SELECT user_id FROM users WHERE email = '$email'";
        $uniqueEmail=mysqli_query($connectDB, $checkEmailQuery);
        $num=mysqli_num_rows($uniqueEmail);
        
        if ($num > 0 ){
            echo "Email is already registered";
        } else{
            $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
            $SQLaddadmin = "INSERT into users (fname, lname, gender, birthdate, email, password, phone, street, city, state, postal_code, district, role) VALUES
                ('$fname', '$lname', '$gender', '$birthdate', '$email', '$hashed_pass', '$phone', '$street', '$city', '$state', '$postcode', '$district', 'admin');";
            
            $run=mysqli_query($connectDB, $SQLaddadmin);
            if ($run){
                echo "<script>alert('Registration of new admin account successful. Redirecting back to user management page.');
                          window.location='userlist.php';</script>";
            }else{
                echo "<script>alert('Error registering user. Please try again.');
                        window.location='addadmin.php';</script>";
                
            }
        }
    }
}
?>
        