<?php
include ('mysqli_connect.php'); // Database connection

/*Ensure the user is logged in*/
if (!isset($_SESSION['user_id'])) {
    echo '<script>
                alert("Please sigin to complete order!");
                window.location = "Login.php";
              </script>';
    exit();
}

/*Ensure the cart is not empty*/
$cart_items = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
if (empty($cart_items)) {
    echo '<script>
            alert("Your cart is empty. Add items to your cart before checking out!");
            window.location = "ourMenu.php"; // Redirect to menu page
          </script>';
    exit();
}

/*Place Order button is clicked*/
if (isset($_POST['place_order'])) {
    
    // Retrieve user information from session
    $user_id = $_SESSION['user_id'];
    
    //address fields
    $street=$_POST['street'];
    $city=$_POST['city'];
    $state=$_POST['state'];
    $postal_code=$_POST['postal_code'];
    $district=$_POST['district'];
    
    //regex
    $postcode_pattern = "/^[0-9]{5}$/";
    
    if (empty($street) || empty($district) || empty($postal_code) || empty($city) || empty($state)) {
        echo "<script>alert('All fields are required.');</script>";
    }   elseif (!preg_match($postcode_pattern, $postal_code)) {
        echo "<script>alert('Postcode must be exactly 5 digits.');</script>";
    } else {
        
        /* Calculate Totals */
        $total_price_before_discount = array_sum(array_column($_SESSION['cart'], 'total_price'));
        $redeem_discount = isset($_SESSION['redeem_discount']) ? $_SESSION['redeem_discount'] : 0;
        $redeemed_points = isset($_SESSION['redeem_points']) ? $_SESSION['redeem_points'] : 0;
        $total_price_after_discount = $total_price_before_discount - $redeem_discount;
        
        // Ensure total after discount is not negative
        if ($total_price_after_discount < 0) $total_price_after_discount = 0;
        
        /* ORDERS TABLE */
        // Insert the order into the 'orders' table
        $query = "INSERT INTO orders (user_id, total_price, street, city, state, postal_code, district, points_used, discount, status, order_date)
                      VALUES ('$user_id', '$total_price_before_discount', '$street', '$city', '$state', '$postal_code', '$district', '$redeemed_points', '$redeem_discount', 'Pending', NOW())";
        
        if (mysqli_query($connectDB, $query)) {
            // Get the inserted order ID
            $order_id = mysqli_insert_id($connectDB); // Return the id in ascending order
            
            foreach ($_SESSION['cart'] as $item) {
                $menu_id = $item['menu_id'];
                $quantity = $item['quantity'];
                $subtotal = $item['total_price'];
                $query2 = "INSERT INTO orderdetails (order_id, menu_id, quantity, subtotal)
                               VALUES ('$order_id', '$menu_id', '$quantity', '$subtotal')";
                mysqli_query($connectDB, $query2);
            }
        }
        
        
        /* PAYMENTS TABLE */
        
        // Retrieve payment method from form submission
        $payment_method_input = htmlspecialchars($_POST['payment_method']);
        
        $payment_method = '';
        
        if ($payment_method_input == 'Debit card') {
            $payment_method = 'debit card';
        } else if ($payment_method_input == 'E-Wallet') {
            $payment_method = 'e-wallet';
        } else if ($payment_method_input == 'Cash on Delivery') {
            $payment_method = 'cash';
        } else if ($payment_method_input == 'Credit card') {
            $payment_method = 'credit card';
        } else if ($payment_method_input == 'Online Banking') {
            $payment_method = 'online banking';
        } else {
            echo "Invalid payment method!";
            exit();
        }
        
        // Insert payment information into the 'payments' table
        $query3 = "INSERT INTO payments (order_id, payment_method, payment_amount, payment_date)
                       VALUES ('$order_id', '$payment_method', '$total_price_after_discount', NOW())";
        mysqli_query($connectDB, $query3);
        
        
        /* USER'S POINTSBALANCE MANAGEMENT */
        /* REDEEM POINTS */
        if (isset($_SESSION['redeem_points'])) {
            // Deduct points from the user's balance in the database
            $query6 = "UPDATE users SET point_balance = point_balance - $redeemed_points WHERE user_id = $user_id";
            mysqli_query($connectDB, $query6);
            
            //Record redeem point transaction in Rewards Table
            $query7 = "INSERT INTO rewards (user_id, order_id, points, type, transaction_date)
                       VALUES ('$user_id', '$order_id', '$redeemed_points', 'redeem', NOW())";
            mysqli_query($connectDB, $query7);
            
            // Clear redeemed points from session
            unset($_SESSION['redeem_points']);
            unset($_SESSION['redeem_discount']);
            unset($_SESSION['final_price']);
        }
        
        /* EARN POINTS*/
        // RM1 = 1 POINT
        $points_earned = floor($total_price_after_discount); // floor used to round number to the nearest integer
        
        //add newly earned userpoint into table
        $query4 = "UPDATE users SET point_balance = point_balance + $points_earned
                       WHERE user_id = $user_id";
        
        mysqli_query($connectDB, $query4);
        
        /* REWARDS TABLE */
        $query5 = "INSERT INTO rewards (user_id, order_id, points, type, transaction_date)
                       VALUES ('$user_id', '$order_id', '$points_earned', 'earn', NOW())";
        mysqli_query($connectDB, $query5);
        
        
        /* Clear the cart after the order is placed */
        unset($_SESSION['cart']);
        $_SESSION['total'] = 0;
        
        // Retrive points_balance from userpointsbalance
        $getPoints = mysqli_query($connectDB, "SELECT point_balance FROM users WHERE user_id = $user_id");
        $points = mysqli_fetch_array($getPoints);
        $current_points = $points['point_balance'];
        $_SESSION['points_balance'] = $current_points; // set points_balance into session
        
        
        /* Show success message and user points */
        echo '<script>
                      alert("Your order has been placed successfully!\nYou earned ' . $points_earned . ' points.\nYour current total points balance is ' . $current_points . '");
                      window.location = "ShoppingCart.php";
                  </script>';
        exit();
    }
}
?>