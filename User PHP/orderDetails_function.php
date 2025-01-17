<?php
    include 'mysqli_connect.php';
    
    if (isset($_GET['order_id'])) {
        $order_id = $_GET['order_id'];
        $query = mysqli_query($connectDB, "
                     SELECT menu.menu_name, quantity, menu.price, orderdetails.subtotal
                     FROM orders
                     JOIN orderdetails ON orders.order_id = orderdetails.order_id
                     JOIN menu ON orderdetails.menu_id = menu.menu_id
                     WHERE orders.order_id = '$order_id'
                     ");
        
        $_SESSION['order_details'] = array();
        
        while ($data = mysqli_fetch_assoc($query)) {
            $menu_name = $data['menu_name'];
            $quantity = $data['quantity'];
            $unit_price = $data['price'];
            $subtotal = $data['subtotal'];
            
            // Insert data into order history array
            $_SESSION['order_details'][] = array (
                'menu_name' => $menu_name,
                'quantity' => $quantity,
                'price' => $unit_price,
                'subtotal' => $subtotal
            );
        }
        
        if (isset($_SESSION['order_details']) && !empty($_SESSION['order_details'])) {
            
            // Display order details
            foreach ($_SESSION['order_details'] as $order) { ?>
                	<tbody>
                	<tr>
                		<td><?php echo $order['menu_name']; ?></td>
                		<td><?php echo $order['quantity']; ?></td>
                		<td><?php echo $order['price']; ?></td>
                		<td><?php echo "RM" . $order['subtotal']; ?></td>
                	</tr>
                	</tbody>
                <?php }
                	
            } else {
                echo '<tr><td colspan="6">No order details found for this order.</td></tr>';
            }
            
    } else {
        echo"No Order ID found.";
       
    }
?>	