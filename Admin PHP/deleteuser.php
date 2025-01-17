<?php
include 'mysqli_connect.php';

$userid = $_GET['user_id'];

$SQLdelete = "DELETE FROM users WHERE user_id ='$userid' ";

$run = mysqli_query($connectDB, $SQLdelete);

if($run) { ?>
    <script type="text/javascript">
    window.alert("This user has been deleted. You will be returned to the user management page.");
    window.location='userlist.php';
    </script>
    <?php 
} else { ?>
    <script type="text/javascript">
    window.alert("Sorry, this user could not be deleted. You will be returned to the user management page.");
    window.location='userlist.php';
    </script>
    <?php 
}

?>

