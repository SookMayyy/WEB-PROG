<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panda Pagoda</title>
    <link rel="stylesheet" href="../User CSS/style.css">
    <link rel="stylesheet" href="../User CSS/Checkout.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <!-- Navigation Section -->
    <header>
        <nav>
            <?php 
              include('header.php');
            ?>
        </nav>
    </header>
	
    <?php 
       include('checkout_function.php');
    ?>
    
    <h1>Checkout</h1>

    <div class="checkout_container">
        <!-- Left Container: Shipping Details, Address, and Payment Method -->
        <div class="left-container">
            <div class="container">
                <form method="POST" action="Checkout.php">
                    <h2><strong><i class="fa fa-inbox"></i> Shipping Details</strong></h2>
                    <p><strong>Full Name:</strong> <span class="separator2"><?php echo $_SESSION['fname'] . ' ' . $_SESSION['lname']; ?></span></p>
                    <p><strong>Email:</strong> <span class="separator"><?php echo $_SESSION['email']; ?></span></p>
                    <p><strong>Phone:</strong><span class="separator"><?php echo $_SESSION['phone'];?></span>
					
					<div class="space"> </div>
                    
                    <h2><strong><i class="fa fa-address-card-o"></i> Delivery Address</strong></h2> 
                    <p><?php 
                        if (isset($_SESSION['street'], $_SESSION['city'], $_SESSION['state'], $_SESSION['postal_code'], $_SESSION['district'])) { 
                            ?>
                            <label>Street: </label>
                            <textarea name="street" rows="2" cols="60" class="textarea_field"><?php echo htmlspecialchars($_SESSION['street']); ?></textarea><br>
                            
                            <label>City: </label>
                            <textarea name="city" rows="2" cols="60" class="textarea_field"><?php echo htmlspecialchars($_SESSION['city']); ?></textarea><br>
                            
                            <label>State: </label>
                            <textarea name="state" rows="2" cols="60" class="textarea_field"><?php echo htmlspecialchars($_SESSION['state']); ?></textarea><br>
                            
                            <label>Postcode: </label>
                            <textarea name="postal_code" rows="2" cols="60" class="textarea_field"><?php echo htmlspecialchars($_SESSION['postal_code']); ?></textarea><br>
                            
                            <label>District: </label>
                            <textarea name="district" rows="2" cols="60" class="textarea_field"><?php echo htmlspecialchars($_SESSION['district']); ?></textarea>
                        <?php 
                        } else { ?>
                            <label>Street: </label>
                            <input type="text" id="street" name="street" class="textarea_field" placeholder="Street Address" required><br>
                            
                            <label>City: </label>
                            <input type="text" id="city" name="city" class="textarea_field" placeholder="City" required><br>
                            
                            <label>State: </label>
                            <input type="text" id="state" name="state" class="textarea_field" placeholder="State" required><br>
                            
                            <label>Postcode: </label>
                            <input type="text" id="postal_code" name="postal_code" class="textarea_field" placeholder="Postal Code" required><br>
                            
                            <label>District: </label>
                            <input type="text" id="district" name="district" class="textarea_field" placeholder="District" required>
                        <?php } ?>
                    </p>
                	
                	<div class="space"> </div>
                    
                    <h2><strong><i class="fa fa-cc-visa"></i> Payment Method</strong></h2>
                    <div class="payment_method_container">
                        <div class="payment_options">
                            <label><input type="radio" name="payment_method" value="Debit card" required> Debit card</label><br>
                            <label><input type="radio" name="payment_method" value="E-Wallet"> E-Wallet</label><br>
                            <label><input type="radio" name="payment_method" value="Cash on Delivery"> Cash on Delivery</label><br>
                            <label><input type="radio" name="payment_method" value="Credit card"> Credit card</label><br>
                            <label><input type="radio" name="payment_method" value="Online Banking"> Online Banking</label>
    					</div>
					</div>
					
                    <!-- Shopping Cart Link -->
                    <div class="action_button">
                    <a href="ShoppingCart.php" class="back-to-cart"> &#11164; Shopping Cart </a>
                    <button type="submit" class="btn" name="place_order" >PLACE ORDER</button>
                   	</div>
               </form>
            </div>
        </div>
        
        <!-- Right Container: Cart Details -->
        <div class="right-container">
            <div class="container">
                <h2><strong>Checkout Details</strong><span class="price" style="color:black"><i class="fa fa-shopping-cart"></i><b><?php echo $_SESSION['total']; ?></b></span></h2>
                <table>
                    <tr>
                        <th>Menu Name</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                    </tr>
                    <!-- Get Total Items -->
                    <?php 
                    $total_items = 0;
                    foreach ($_SESSION['cart'] as $item) {
                        $total_items += $item['quantity'];
                    }
                    ?>
                    
                    <!-- Get Total Payment -->
                    <?php
                    $total_price = 0;
                    foreach ($_SESSION['cart'] as $item) {
                        echo "<tr>
                                <td>{$item['menu_name']}</td>
                                <td>{$item['quantity']}</td>
                                <td>RM" . number_format($item['total_price'], 2) . "</td>
                            </tr>";
                        $total_price += $item['total_price'];
                    }
                    ?>
                </table>
				<h3>TOTAL QUANTITY: <span class="separator"><?php echo $total_items; ?></span></h3>
                <h3>TOTAL PAYMENT: <span class="separator2">RM<?php echo number_format($total_price, 2); ?></span></h3>
                <h3>DISCOUNT: <span class="separator3">RM<?php echo isset($_SESSION['redeem_discount']) ? number_format($_SESSION['redeem_discount'], 2) : '0.00'; ?></span></h3>
                <h3>FINAL PAYMENT: <span class="separator2">RM<?php echo isset($_SESSION['final_price']) ? number_format($_SESSION['final_price'], 2) : number_format(array_sum(array_column($_SESSION['cart'], 'total_price')), 2); ?></span></h3>
            </div>
        </div>
    </div>
    
    

    <!-- Footer Section -->
    <footer>
    	<?php include('footer.php'); ?>
    </footer>
</body>
</html>