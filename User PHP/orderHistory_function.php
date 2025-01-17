<?php
    include 'mysqli_connect.php';    
    
    if (!isset($_SESSION['user_id'])) {
        echo '<script>
                  window.alert("Please login first.");
                  window.location="Login.php";
              </script>';
        exit();   	   
    }
    
    $user_id = $_SESSION['user_id'];    
    $query = mysqli_query($connectDB, "
             SELECT orders.order_id, order_date, status, payments.payment_amount 
             FROM orders 
             JOIN payments ON orders.order_id = payments.order_id
             WHERE user_id = '$user_id'
             ORDER BY order_id DESC
             ");
    
    $_SESSION['order_history'] = array();
    
    while ($data = mysqli_fetch_assoc($query)) {
    $order_id = $data['order_id'];
    $payment_amount = $data['payment_amount'];
    $status = $data['status'];
    
    // Convert order date into d-m-Y
    $order_date = $data['order_date'];
    $order_date_formatted = date("d-m-Y, h:iA", strtotime($order_date));
    
    // Insert data into order history array
    $_SESSION['order_history'][] = array (
        'order_id' => $order_id,
        'order_date' => $order_date_formatted,
        'payment_amount' => $payment_amount,
        'status' => $status
    );
    }
    
    if (isset($_SESSION['order_history']) && !empty($_SESSION['order_history'])) {
        
        // Display order history
        foreach ($_SESSION['order_history'] as $order) { ?>
        	<tbody>
        	<tr>
        		<td><?php echo $order['order_id']; ?></td>
        		<td><?php echo $order['order_date']; ?></td>
        		<td><?php echo $order['status']; ?></td>
        		<td><?php echo "RM" . $order['payment_amount']; ?></td>
        		<td><a href="OrderDetails.php?order_id=<?php echo $order['order_id']; ?>" class="order_details">View</a></td>
        	</tr>
        	</tbody>
        <?php }
        	
    } else {
        echo '<tr><td colspan="6">Your order history is empty.</td></tr>';
    }
?>	