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
.order-details {
    margin: 20px auto;
    max-width: 800px;
    font-family: 'Familjen Grotesk', sans-serif;
}
</style>

<body>
	<!-- Navigation Section -->
	<header>
	<nav>
		<?php include 'header.php';?>
	</nav>
	</header>
	
	<!-- Order Details Section -->
	<section class="order-details">
	<div class="container">
		<h1>Order Details</h1>
		<?php 
		include 'mysqli_connect.php';
		$orderid = $_GET['order_id'];
		$SQLod= "SELECT 
                    m.menu_name,
                    od.quantity, 
                    m.price, 
                    od.subtotal 
                FROM orderdetails od 
                JOIN menu m ON od.menu_id = m.menu_id 
                WHERE order_id = '$orderid' ";
		$run = mysqli_query($connectDB, $SQLod); ?>
        <!-- table for order details -->
        <h2>Order ID: <?php echo $orderid; ?></h2>
        <!-- table for order details -->
        <table>
            <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
        	<tbody>
                <?php
                if ($run && mysqli_num_rows($run) > 0) {
                    while ($row = mysqli_fetch_assoc($run)) {
                        echo "<tr>
                            <td>{$row['menu_name']}</td>
                            <td>{$row['quantity']}</td>
                            <td>{$row['price']}</td>
                            <td>{$row['subtotal']}</td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No items found in this order.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <br>
		<a href="orderhistory.php" class= "button">Go back to order history page</a>    
		</div>  
	</section>
	
	
	<!--Footer Section-->
	<footer class="footer">
		<?php include 'footer.php'; ?>
	</footer>	
	
	
</body>
</html>