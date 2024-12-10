<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://fonts.googleapis.com/css?family=Familjen Grotesk' rel='stylesheet'>
	<title>Panda Pagoda</title>
	<link rel="stylesheet" href="../User CSS/style.css">
	<link rel="stylesheet" href="../User CSS/ShoppingCart.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
	<!-- Navigation Section -->
	<header>
	<nav>
		<?php 
		  include ('header.php');
		?>
	</nav>
	</header>
	
	
	<h1>Shopping Cart</h1>
	
	<!-- Shopping Cart List -->
    <div class="cart_container">
       <table>
        	<thead>
        		<tr>
        			<th>Menu Name</th>
        			<th>Description</th>
        			<th>Unit Price</th>
        			<th>Quantity</th>
        			<th>Total Price</th>
    				<th><a href="javascript:void(0);" id="remove_all_link">Remove All</a></th>
        		</tr>
        	</thead>
        	<tbody>
            	<?php 
                include ('shoppingCart_function.php');
                ?>
        	</tbody>
       </table> 
        	
       <section class="cart_container2"> 
        	<div class="continue_browsing">
        	   <a href="OurMenu.php#ourMenu_hero" class="continue_shopping"> &#11164; Continue browsing</a>		
        	</div>
        	
    		 <div class="cart_summary">
                <?php if (!empty($_SESSION['cart'])): ?>
                    <p><b>Total Items:</b> <span class="space"><?php echo count($_SESSION['cart']); ?></span></p>
                    <p><b>Total Price:</b> <span class="space">RM<?php echo number_format(array_sum(array_column($_SESSION['cart'], 'total_price')), 2); ?></span></p>
                <?php else: ?>
                    <p>Total Items: 0</p>
                    <p>Total Price: RM0.00</p>
                <?php endif; ?>
                <form method="POST" action="Checkout.php">
                	<button class="checkout_button">CHECK OUT</button>
                </form>
            </div>
      </section>
    </div>
    		
	<!-- Footer Section -->
    <footer class="footer">
        <?php 
          include ('footer.php');
        ?>
    </footer>
    
	<script>	
        // Handle "Remove All" action with confirmation
       	document.getElementById("remove_all_link").addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default action (i.e., not following the link)
        
        // Show a confirmation dialog
        if (confirm("Are you sure you want to clear all items in your cart?")) {
            // Redirect to ShoppingCart.php with the "remove_all" action in the query string
            window.location.href = "ShoppingCart.php?action=remove_all"; 
        }
    });
    </script>
</body>
</html>
