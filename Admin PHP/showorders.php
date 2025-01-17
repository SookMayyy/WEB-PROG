<?php
include 'searchorder.php'; // Include the search function

// Handle changing order status
if (isset($_POST['update_status'])) {
    $order_id = $_POST['order_id'];
    $new_status = $_POST['new_status'];
    
    // Validate status
    $valid_statuses = ['pending', 'processing', 'in delivery', 'delivered', 'canceled'];
    if (in_array($new_status, $valid_statuses)) {
        $SQLstatus = "UPDATE orders SET status = '$new_status' WHERE order_id = '$order_id'";
        $run = mysqli_query($connectDB, $SQLstatus);
        
        if ($run) {
            $status_update_message = "Order status updated successfully for order ID $order_id.";
        } else {
            $status_update_error = "Failed to update order status: " . mysqli_error($connectDB);
        }
    } else {
        $status_update_error = "Invalid status selected.";
    }
}

// Handle search input and sorting parameters
$search_term = isset($_GET['search']) ? $_GET['search'] : '';
$sort_column = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'order_date'; // Default column
$sort_order = isset($_GET['order']) ? $_GET['order'] : 'DESC'; // Default order

// Fetch order data
$result = searchOrders($search_term, $sort_column, $sort_order);
?>

<!-- Display status update message if any -->
<?php if (isset($status_update_message)): ?>
    <div class="status-message success"><?php echo htmlspecialchars($status_update_message); ?></div>
<?php endif; ?>
<?php if (isset($status_update_error)): ?>
    <div class="status-message error"><?php echo htmlspecialchars($status_update_error); ?></div>
<?php endif; ?>

<!-- search function -->
<form action="" method="GET">
	<label>Search order: </label>
    <input type="text" name="search" placeholder="Search by name, email, phone, or order status" value="<?php echo htmlspecialchars($search_term); ?>">
    <button type="submit">Search</button>
    <a href="orderhistory.php"><button type="button">Reset</button></a>
</form>

<!-- table for donation info -->
<table>
    <thead>
        <tr>
            <th><a href="?search=<?php echo urlencode($search_term); ?>&sort_by=order_id&order=<?php echo $sort_order == 'ASC' ? 'DESC' : 'ASC'; ?>">
            	Order ID <span class="sort-icon <?php echo ($sort_column == 'order_id' ? ($sort_order == 'ASC' ? 'asc' : 'desc') : ''); ?>"></span>
        	</a></th>
            <th><a href="?search=<?php echo urlencode($search_term); ?>&sort_by=full_name&order=<?php echo $sort_order == 'ASC' ? 'DESC' : 'ASC'; ?>">
            	Full Name <span class="sort-icon <?php echo ($sort_column == 'full_name' ? ($sort_order == 'ASC' ? 'asc' : 'desc') : ''); ?>"></span>
        	</a></th>
            <th><a href="?search=<?php echo urlencode($search_term); ?>&sort_by=contact&order=<?php echo $sort_order == 'ASC' ? 'DESC' : 'ASC'; ?>">
            	Contact Information <span class="sort-icon <?php echo ($sort_column == 'contact' ? ($sort_order == 'ASC' ? 'asc' : 'desc') : ''); ?>"></span>
        	</a></th>
            <th><a href="?search=<?php echo urlencode($search_term); ?>&sort_by=payment_method&order=<?php echo $sort_order == 'ASC' ? 'DESC' : 'ASC'; ?>">
            	Payment Method <span class="sort-icon <?php echo ($sort_column == 'payment_method' ? ($sort_order == 'ASC' ? 'asc' : 'desc') : ''); ?>"></span>
        	</a></th>
            <th><a href="?search=<?php echo urlencode($search_term); ?>&sort_by=total_price&order=<?php echo $sort_order == 'ASC' ? 'DESC' : 'ASC'; ?>">
            	Total Amount <span class="sort-icon <?php echo ($sort_column == 'total_price' ? ($sort_order == 'ASC' ? 'asc' : 'desc') : ''); ?>"></span>
        	</a></th>
        	<th><a href="?search=<?php echo urlencode($search_term); ?>&sort_by=payment_amount&order=<?php echo $sort_order == 'ASC' ? 'DESC' : 'ASC'; ?>">
            	Payment Amount <span class="sort-icon <?php echo ($sort_column == 'payment_amount' ? ($sort_order == 'ASC' ? 'asc' : 'desc') : ''); ?>"></span>
        	</a></th>
            <th><a href="?search=<?php echo urlencode($search_term); ?>&sort_by=address&order=<?php echo $sort_order == 'ASC' ? 'DESC' : 'ASC'; ?>">
            	Delivery Address <span class="sort-icon <?php echo ($sort_column == 'address' ? ($sort_order == 'ASC' ? 'asc' : 'desc') : ''); ?>"></span>
    		</a></th>
            <th><a href="?search=<?php echo urlencode($search_term); ?>&sort_by=points_used&order=<?php echo $sort_order == 'ASC' ? 'DESC' : 'ASC'; ?>">
            	Points Used <span class="sort-icon <?php echo ($sort_column == 'points_used' ? ($sort_order == 'ASC' ? 'asc' : 'desc') : ''); ?>"></span>
        	</a></th>
            <th><a href="?search=<?php echo urlencode($search_term); ?>&sort_by=discount&order=<?php echo $sort_order == 'ASC' ? 'DESC' : 'ASC'; ?>">
            	Discount <span class="sort-icon <?php echo ($sort_column == 'discount' ? ($sort_order == 'ASC' ? 'asc' : 'desc') : ''); ?>"></span>
            </a></th>
            <th><a href="?search=<?php echo urlencode($search_term); ?>&sort_by=status&order=<?php echo $sort_order == 'ASC' ? 'DESC' : 'ASC'; ?>">
            	Order Status <span class="sort-icon <?php echo ($sort_column == 'status' ? ($sort_order == 'ASC' ? 'asc' : 'desc') : ''); ?>"></span>
        	</a></th>                        
            <th><a href="?search=<?php echo urlencode($search_term); ?>&sort_by=order_date&order=<?php echo $sort_order == 'ASC' ? 'DESC' : 'ASC'; ?>">
            	Order Date <span class="sort-icon <?php echo ($sort_column == 'order_date' ? ($sort_order == 'ASC' ? 'asc' : 'desc') : ''); ?>"></span>
        	</a></th>
            <th>View Order</th>
            <th>Delete Order</th>
            <th>Change Status</th>        
        </tr>
    </thead>
	<tbody>

        <?php
        if (!$result) {
            die("Query Failed: " . mysqli_error($connectDB));
        }else {
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $orderid = $row['order_id'];
                    echo "<tr>
                        <td>{$row['order_id']}</td>
                        <td>{$row['full_name']}</td>
                        <td>{$row['contact']}</td>
                        <td>{$row['payment_method']}</td>
                        <td>{$row['total_price']}</td>
                        <td>{$row['payment_amount']}</td>
                        <td>{$row['address']}</td>
                        <td>{$row['points_used']}</td>
                        <td>{$row['discount']}</td>
                        <td>{$row['status']}</td>   
                        <td>{$row['order_date']}</td>
                        <td><a href='orderdetails.php?order_id=".$orderid."' class='view-link'>View</a></td>
                        <td><a href='deleteorder.php?order_id=".$orderid."'class='delete-link'>Delete</a></td>
                        <td>
                            <form action='' method='POST' class='status-change-form'>
                                <input type='hidden' name='order_id' value='{$orderid}'>
                                <select name='new_status' class='status-dropdown'>
                                    <option value='pending' ".($row['status']=='pending'?'selected':'').">Pending</option>
                                    <option value='processing' ".($row['status']=='processing'?'selected':'').">Processing</option>
                                    <option value='in delivery' ".($row['status']=='in delivery'?'selected':'').">In Delivery</option>
                                    <option value='delivered' ".($row['status']=='delivered'?'selected':'').">Delivered</option>
                                    <option value='canceled' ".($row['status']=='canceled'?'selected':'').">Canceled</option>
                                </select>
                                <button type='submit' name='update_status' class='status-update-btn'>Update</button>
                            </form>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='12'>No orders found.</td></tr>";
            }
        }
        ?>
    </tbody>
</table>