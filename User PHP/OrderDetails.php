<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://fonts.googleapis.com/css?family=Familjen Grotesk' rel='stylesheet'>
	<title>Panda Pagoda</title>
	<link rel="stylesheet" href="../User CSS/style.css">
	<link rel="stylesheet" href="../User CSS/OrderDetails.css">
</head>


<body>
	<!-- Navigation Section -->
	<header>
    	<nav>
    		<?php include 'header.php';?>
    	</nav>
	</header>
	
	<!-- Order History Section -->
	<section class="orderDetails">
    	<h1>Order Details</h1>
    
    	<div class="orderDetails_content">
    		<h3><strong>View Order Details</strong></h3>
    		<h3><strong>Order ID:</strong> <?php echo $_GET['order_id']; ?></h3>
    		
    		<table>
    			<thead>
    			<tr>
    				<th>Item Name</th>
    				<th>Quantity</th>
    				<th>Unit Price</th>
    				<th>Total Price</th>
    			</tr>
    			</thead>	
    			
        		<?php 
        		  include 'orderDetails_function.php';
        		?>		
    		  
    		</table> 
    		 		
    		<div class="actions">
                <a href="OrderHistory.php" class="order_history"> <<< Order History </a>
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