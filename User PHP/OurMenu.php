<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Familjen Grotesk' rel='stylesheet'>
    <title>Panda Pagoda</title>
    <link rel="stylesheet" href="../User CSS/style.css">
    <link rel="stylesheet" href="../User CSS/OurMenu.css">
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
    
    <!-- Hero Section -->
    <section id="ourMenu_hero">
        <h1>Panda Pagoda's Menu</h1>
    </section>
    
    <!-- Our Menu & Shopping Cart Section -->
    <div id="menu_site"></div>
    <section class="ourMenu_banner">
        <h2>Our Menu</h2>
        
        <a href="ShoppingCart.php">
            <button type="button" class="shopping_cart_button">
                Shopping Cart (<?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>)
                <img src="../images/Our Menu/shopping_cart_icon.png">
            </button>
        </a>
    </section>
    
    <!-- All Menu Navigator Section -->
    <section class="allMenu">
        <a href="#main dish">Main Dish</a>
        <a href="#soups">Soups</a>
        <a href="#snacks">Snacks</a>
        <a href="#desserts">Desserts</a>
        <a href="#beverages">Beverages</a>
        <a href="#jam & spread">Jam & Spreads</a>
        <a href="#sauces">Sauces</a>
    </section>

    <!-- All Menu Content Section -->
    <section class="allMenu_content">
        <?php 
          include ('ourMenu_function.php');
        ?>
    </section>
    
    <!-- Footer Section -->
    <footer class="footer">
        <?php 
          include ('footer.php');
        ?>
    </footer>
    
    
 </body>
</html>