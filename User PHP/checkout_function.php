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
        
        // Ensure all address fields are available in the session
        if (!isset($_SESSION['street'], $_SESSION['city'], $_SESSION['state'], $_SESSION['postal_code'], $_SESSION['district'])) {
            echo '<script>
                    alert("Please complete your address information.");
                    window.location = "UserProfile.php"; // Redirect to profile or address form page
                  </script>';
            exit();
        }
        
                
        /* ORDERS TABLE */
        
        // Retrieve address details from session
        $street = $_SESSION['street'];
        $city = $_SESSION['city'];
        $state = $_SESSION['state'];
        $postal_code = $_SESSION['postal_code'];
        $district = $_SESSION['district'];
        
        // Calculate the total price
        $total_price = array_sum(array_column($_SESSION['cart'], 'total_price'));

        // Insert the order into the 'orders' table
        $query = "INSERT INTO orders (user_id, total_price, street, city, state, postal_code, district, status, order_date)
                  VALUES ('$user_id', '$total_price', '$street', '$city', '$state', '$postal_code', '$district', 'Pending', NOW())"; 
        
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
        $payment_method = htmlspecialchars($_POST['payment_method']);
        
        // Insert payment information into the 'payments' table
        $query3 = "INSERT INTO payments (order_id, payment_method, payment_date)
                   VALUES ('$order_id', '$menu_id', NOW())"; 
        mysqli_query($connectDB, $query3);        
       
             
        /* USERPOINTSBALANCE TABLE */
        
        // RM10 = 1 POINT
        $points_earned = floor($total_price / 10); // floor used to round number to the nearest integer
        
        //Check if user's point already stored in userpointsbalance 
        $result = mysqli_query($connectDB, "SELECT * FROM userpointsbalance WHERE user_id = '$user_id'");
        if (mysqli_num_rows($result) == 0) {
            // Insert points into the userpointsbalance table
            $query4 = "INSERT INTO userpointsbalance (user_id, points_balance)
                       VALUES ('$user_id', '$points_earned')";
        } else {
            $query4 = "UPDATE userpointsbalance SET points_balance = points_balance + $points_earned 
                       WHERE user_id = $user_id";
        }
        mysqli_query($connectDB, $query4);
        
        
        /* REWARDS TABLE */
        $query5 = "INSERT INTO rewards (user_id, order_id, points, type, transaction_date)
                   VALUES ('$user_id', '$order_id', '$points_earned', 'earn', NOW())";
        mysqli_query($connectDB, $query5);
        
        
        /* Clear the cart after the order is placed */
        unset($_SESSION['cart']);
        
        // Retrive points_balance from userpointsbalance
        $getPoints = mysqli_query($connectDB, "SELECT points_balance FROM userpointsbalance WHERE user_id = $user_id");
        $row = mysqli_fetch_assoc($getPoints);
        $current_points = $row['points_balance'];
        $_SESSION['points_balance'] = $current_points; // set points_balance into session
              
        
        /* Show success message and user points */
        echo '<script>
                  alert("Your order has been placed successfully!\nYou earned ' . $points_earned . ' points.\nYour current total points balance is ' . $current_points . '");
                  window.location = "ShoppingCart.php";
              </script>';
        exit();
    } 
?>