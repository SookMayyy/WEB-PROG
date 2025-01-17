<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://fonts.googleapis.com/css?family=Familjen Grotesk' rel='stylesheet'>
	<title>Panda Pagoda</title>
	<link rel="stylesheet" href="../Admin CSS/style.css">
	<link rel="stylesheet" href="../Admin CSS/login.css">
</head>

<style>
        /* Set the body to a white background and hide all other content */
        body {
            background-color: white;
            color: white;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }
    </style>
    
</head>


<body>
	<!-- Logout Section -->
	<section class="login">
		<?php
		    session_start();
            // If no session variable exists, redirect the user:
            if (!isset($_SESSION['user_id'])) { ?>
                
                <script>
                    window.alert("Please login first.");
                    window.location='adminlogin.php';
                </script>
         <?php   
            } else { // Cancel the session:
                
                session_unset();
                session_destroy();
     
                echo "<script>
                        window.alert('You have logged out');
                        setTimeout(function() {
                            window.location.href = 'adminlogin.php';
                        }, 500);
                    </script>";
                
           }
        ?>
	</section>
	
</body>
</html>