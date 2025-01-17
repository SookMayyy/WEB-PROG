<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    include 'mysqli_connect.php';
    
    $user_id = $_SESSION['user_id'];
    $SQLprofile= "SELECT * FROM users WHERE user_id='$user_id';";
    $run = mysqli_query($connectDB, $SQLprofile);
    $data = mysqli_fetch_array($run);
    
    // Store birthdate and registration date in the session
    $_SESSION['birthdate'] = $data['birthdate'];
    $_SESSION['registration_date'] = $data['registration_date'];
    
    // Change birthdate format to dd/Mon/yyyy
    $birthdate = $data['birthdate'];
    $regisDate = $data['registration_date'];
    
    $formatted_birthdate = date("d M Y", strtotime($birthdate));
    $formatted_register_birthdate = date("d M Y", strtotime($regisDate));
    
    // Edit button
    if (isset($_POST['edit'])) {
        header("Location: EditProfile.php");
        exit();
    }
    
    //Delete button
    if (isset($_POST['delete'])){
        session_start();
        $userid=$_SESSION['user_id'];
        $SQLdeleteuser = "DELETE FROM users WHERE user_id = '$userid'";
        
        $run = mysqli_query($connectDB, $SQLdeleteuser);
        
        if($run) {
            session_unset();
            session_destroy();
            ?>
            <script type="text/javascript">
            window.alert("Your account has been deleted. You will be directed to the login page.");
            window.location='login.php';
            </script>
        <?php 
        } else { ?>
            <script type="text/javascript">
            window.alert("Sorry, your profile could not be deleted. You will be returned to your profile page.");
            window.location='profile.php';
            </script>
            <?php 
        }
    }

?>