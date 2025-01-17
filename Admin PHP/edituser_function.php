<?php
include "mysqli_connect.php";
$userid=$_POST['user_id'];
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$gender=$_POST['gender'];
$birthdate=$_POST['birthdate'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$street=$_POST['street'];
$city=$_POST['city'];
$state=$_POST['state'];
$postcode=$_POST['postal_code'];
$district=$_POST['district'];

//validation regex
$mobile_pattern = "/^01[0-46-9]{1}-\d{7,8}$/";
$postcode_pattern = "/^[0-9]{5}$/";

//validate input
if (empty($fname) || empty($lname) || empty($gender) || empty($birthdate) || empty($email) || empty($phone) || empty($street) || empty($district) || empty($postcode) || empty($city) || empty($state)) {
    echo "<script>alert('All fields are required.');
                window.location='edituser.php?user_id=".$userid."';</script>";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script>alert('Invalid email format.');
                window.location='edituser.php?user_id=".$userid."';</script>";
} elseif (!preg_match($mobile_pattern, $phone)) {
    echo "<script>alert('Phone number must follow the Malaysian format and contain 11 digits.');
                window.location='edituser.php?user_id=".$userid."';</script>";
} elseif (!preg_match($postcode_pattern, $postcode)) {
    echo "<script>alert('Postcode must be exactly 5 digits.');
                window.location='edituser.php?user_id=".$userid."';</script>";
} else {
    $SQLedit= "UPDATE users SET fname='$fname', lname='$lname', gender='$gender',  birthdate='$birthdate', email='$email',
                phone='$phone', street='$street', city='$city',
                state='$state', postal_code='$postcode', district='$district' WHERE user_id = '$userid' ";
    $run = mysqli_query($connectDB, $SQLedit);
    if($run){
        echo "<script>alert('User information successfully edited. Redirecting back to user management page.');
                          window.location='userlist.php';</script>";
    } else {
        echo "<script>alert('User information could not be edited. Redirecting back to user management page.');
                          window.location='userlist.php';</script>";
    }
}

?>