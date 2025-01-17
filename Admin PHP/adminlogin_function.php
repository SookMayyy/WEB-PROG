<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        include 'mysqli_connect.php';
        $email = mysqli_real_escape_string($connectDB, trim($_POST['email']));
        $pass = trim($_POST['password']);
        $SQLlogin = "SELECT * FROM users WHERE email='$email' && role='admin';";
        
        $run=mysqli_query($connectDB, $SQLlogin);
        $data=mysqli_fetch_array($run);
        
        if (empty($data['email'])) {
            ?>
    	<script type="text/javascript">
    		window.alert("Sorry, your email/password is incorrect.");
    		window.location='adminlogin.php';
    	</script>
    	<?php
        }else{
            if (password_verify($pass, $data['password'])) {
            	$_SESSION['user_id']=$data['user_id'];
            	$_SESSION['email']=$data['email'];
            	$_SESSION['fname']=$data['fname'];
            	$_SESSION['lname']=$data['lname'];
            	
            	?>
            	<script type="text/javascript">
            		window.alert("Your login is successful. <?php echo "Welcome, admin ".$_SESSION['fname']." ".$_SESSION['lname']."."; ?>");
             		window.location='adminhome.php';
            	</script>
        <?php	
            } else {
                ?>
                <script type="text/javascript">
                    window.alert("Sorry, your email/password is incorrect.");
                    window.location='adminlogin.php';
                </script>
            <?php 
            }
        }
    }
?>
