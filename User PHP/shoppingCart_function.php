<!-- ADD TO CART FUNCTION, UPDATE QUANTITY FUNCTION, REMOVE CART FUNCTION, REDEEM POINTS FUNCTION -->
<?php
    include ('mysqli_connect.php');
    
    // Ensure user is logged in
    if (!isset($_SESSION['user_id'])) {
        echo '<script>
                alert("Please sign in to complete order!");
                window.location = "Login.php";
              </script>';
        exit();            
    }
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        // Initialize the shopping cart session
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
            $_SESSION['total']; //keep track of total items
        }
        
        // Add to cart functionality
        if (isset($_POST['add_to_cart'])) {
            $menu_id = $_POST['menu_id'];
            $image = $_POST['image'];
            $menu_name = $_POST['menu_name'];
            $description = $_POST['description'];
            $unit_price = $_POST['unit_price'];
            $quantity = $_POST['quantity'];
            
            // Check if the cart already exists in the session
            if (isset($_SESSION['cart'][$menu_id])) {
                // Increment the quantity if the item is already in the cart
                $_SESSION['cart'][$menu_id]['quantity'] += $quantity;
                $_SESSION['cart'][$menu_id]['total_price'] = $_SESSION['cart'][$menu_id]['unit_price'] * $_SESSION['cart'][$menu_id]['quantity'];
                $_SESSION['total'] += $quantity;          
            } else {
                // If the item is not in the cart, add it
                $_SESSION['cart'][$menu_id] = [
                    'menu_id' => $menu_id,
                    'image' => $image,
                    'menu_name' => $menu_name,
                    'description' => $description,
                    'unit_price' => $unit_price,
                    'quantity' => $quantity,
                    'total_price' => $unit_price * $quantity
                ];
                $_SESSION['total'] += $quantity;
                
            }
            
            header ('Location: OurMenu.php#menu_site');
    
        }
        
        // Update quantity functionality
        if (isset($_POST['quantity_function']) && $_POST['quantity_function'] == 'update_quantity') {
            $menu_id = $_POST['menu_id'];
            $change = $_POST['change']; // 'increase' or 'decrease'
            
            foreach ($_SESSION['cart'] as &$cart_item) {
                if ($cart_item['menu_id'] == $menu_id) {
                    if ($change == 'increase') {
                        $cart_item['quantity'] += 1;
                        $_SESSION['total'] += 1;
                    } elseif ($change == 'decrease' && $cart_item['quantity'] > 1) {
                        $cart_item['quantity'] -= 1;
                        $_SESSION['total'] -= 1;
                    }
                    // Update total price
                    $cart_item['total_price'] = $cart_item['unit_price'] * $cart_item['quantity'];
                }
            }
            
            header('Location: ShoppingCart.php'); // Redirect to avoid form resubmission
            exit();
        }
        
        // Remove item functionality
        if (isset($_POST['action_type']) && $_POST['action_type'] == 'remove') {
            $menu_id = $_POST['menu_id'];
            
            // Check if cart exists and menu_id is valid
            if (isset($_SESSION['cart'][$menu_id])) {
                $_SESSION['total'] -= $_SESSION['cart'][$menu_id]['quantity'];
                unset($_SESSION['cart'][$menu_id]); // Remove the item from the cart
            }
            
            header('Location: ShoppingCart.php'); // Redirect after removing
            exit();
        }
    }
    
        // Remove all items functionality
        if (isset($_GET['action']) && $_GET['action'] == "remove_all") {
            unset($_SESSION['cart']); // Clear the entire cart
            unset($_SESSION['redeem_discount']);
            unset($_SESSION['final_price']);
            $_SESSION['total'] = 0;
            header("Location: ShoppingCart.php"); // Reload the page to reflect changes
            exit();
        }
    ?>
    
    <!-- REDEEM POINTS FUNCTION -->
	<?php 
    // Check if redeem points form is submitted
    if (isset($_POST['redeem_points'])) {
        $points_to_redeem = (int)$_POST['points_to_redeem'];
        $available_points = $_SESSION['points_balance'];
        $total_price = array_sum(array_column($_SESSION['cart'], 'total_price'));
    
        if ($points_to_redeem > $available_points) {
            echo "<script>alert('You do not have enough points to redeem.');</script>";
        } elseif ($points_to_redeem * 0.10 > $total_price) {
            echo "<script>alert('Redeemed points exceed the total price.');</script>";
        } else {
            // Calculate redeem discount
            $redeem_discount = $points_to_redeem * 0.10; // Conversion rate: 1 point = RM0.10
    
            // Update session
            $_SESSION['redeem_discount'] = $redeem_discount;
            $_SESSION['final_price'] = $total_price - $redeem_discount;
            $_SESSION['redeem_points'] = $points_to_redeem;
    
            echo "<script>alert('Redeemed RM$redeem_discount using $points_to_redeem points.');</script>";
        }
    }
    ?>
    
    <!-- DISPLAY SHOPPING CART LIST -->
    <?php
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        
        // Display cart items
        foreach ($_SESSION['cart'] as $item) {?>
                <tr>
                <!-- Display menu item data -->
                <td>
                    <div class="menu_item_container">
                        <img src="<?= $item['image'] ?>" class="item_image" alt="<?= $item['menu_name'] ?>">
                        <span class="menu_name"><?= $item['menu_name'] ?></span>
                    </div>
                </td>
                <td><?= $item['description'] ?></td>
                <td>RM<?= number_format($item['unit_price'], 2) ?></td>
    
                <!-- Quantity update buttons with menu_id -->
                <td class="quantity_container">
                    <form method="POST" action="ShoppingCart.php">
                        <input type="hidden" name="menu_id" value="<?= $item['menu_id'] ?>">
                        <input type="hidden" name="quantity_function" value="update_quantity">
                        <button class="quantity_button" name="change" value="decrease" type="submit">-</button>
                        <span class="item_quantity"><?= $item['quantity'] ?></span>
                        <button class="quantity_button" name="change" value="increase" type="submit">+</button>
                    </form>
                </td>
    
                <!-- Total price display -->
                <td>RM<?= number_format($item['total_price'], 2) ?></td>
    
                <!-- Remove button in a separate form -->
                <td>
                    <form method="POST" action="ShoppingCart.php">
                        <input type="hidden" name="menu_id" value="<?= $item['menu_id'] ?>">
                        <input type="hidden" name="action_type" value="remove">
                        <button type="submit" class="remove_button"><i class="fa fa-trash-o fa-lg"></i></button>
                    </form>
                </td>
            </tr>
       <?php }
        
    } else {
        echo '<tr><td colspan="8">Your cart is empty.</td></tr>';
    }
?>