<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://fonts.googleapis.com/css?family=Familjen Grotesk' rel='stylesheet'>
	<title>Panda Pagoda</title>
	<link rel="stylesheet" href="../User CSS/style.css">
	<link rel="stylesheet" href="../User CSS/OrderHistory.css">
</head>


<body>
	<!-- Navigation Section -->
	<header>
    	<nav>
    		<?php include 'header.php';?>
    	</nav>
	</header>
	
	<!-- Order History Section -->
	<section class="orderHistory">
    	<h1>Order History</h1>
    
    	<div class="orderHistory_content">
    		<h3><strong>Name:</strong> <?php echo $_SESSION['fname']." ".$_SESSION['lname']; ?></h3>
    		<h3><strong>Email:</strong> <?php echo $_SESSION['email']; ?></h3>
    		
    		<table>
    			<thead>
    			<tr>
    				<th>Order ID</th>
    				<th>Order Date</th>
    				<th>Order Status</th>
    				<th>Payment Amount</th>
    				<th>View Details</th>
    			</tr>
    			</thead>	
    			
        		<?php 
        		  include 'orderHistory_function.php';
        		?>		
    		  
    		</table> 
    		 		
    		<div class="actions">
                <a href="Profile.php" class="profile"> <<< User Profile </a>
            </div>
    	</div>
	</section>
	
	<!--Footer Section-->
	<footer class="footer">
		<?php include 'footer.php'; ?>
	</footer>	
	
	
</body>
</html>