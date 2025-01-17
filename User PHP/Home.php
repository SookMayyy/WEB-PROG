<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://fonts.googleapis.com/css?family=Familjen Grotesk' rel='stylesheet'>
	<title>Panda Pagoda</title>
	<link rel="stylesheet" href="../User CSS/style.css">
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
	<section id="hero">
		<h1><span class="quote-mark">“</span>Delicious Food Sustainable Future.<span class="quote-mark">”</span></h1>
		
		<div class="order_now_container">
			<form action="OurMenu.php" method="get">
				<button type="submit" class="order_now_button">Order Now</button>
			</form>
		</div>
	</section>
	
	<!--Body Section-->
	<section id="body">
		<div class="desc">
			<p> At Panda Pagoda, we transform surplus and inperfect ingredients into delicious meals, reducing food waste and supporting a sustainable future for all.</p>
			<form action="AboutUs.php" method="get">
				<button type="submit" class="learn_more_button">Learn More</button>
			</form>
		</div>
		<img src="../images/Home/food_image.png" alt="Spaghetti Dish" class="food-image">
	</section>
	
	<!--The Curve Section-->
	<section style= "background-color: #EC9744;">
        <svg viewBox="0 0 1440 94" xmlns="http://www.w3.org/2000/svg" style="display: block;">
            <path fill="#FFE6E6" d="M596.757 21.4939C870.187 70.0522 1295.3 105.494 1440 58.3845V94H0V37.4939C121.746 8.05225 356.24 -21.2193 596.757 21.4939Z"></path>
        </svg>
	</section>
	
	<!--Product Section-->
	<section id="product">
		<h2>Excess ingredients will be turned into Jam or Sauces to be used!</h2>
		
		<div class="container">
			<!-- Card 1 -->
			<div class="card">
				<img src="../images/Home/creamy_carbonara_sauce.png" alt="creamy_carbonara_sauce">
			
				<div class="content">
					<h3>Creamy Carbonara Sauce</h3>
					<p>This is a delicious sauce made from surplus ingredients, perfect for pasta dishes.</p>
				</div>
			</div>
			
			<!-- Card 2 -->
			<div class="card">
				<img src="../images/Home/sambal.png" alt="sambal">
			
				<div class="content">
					<h3>Spicy Sambal</h3>
					<p>This is a fiery Malaysia chilli sauce made from surplus ingredients.</p>
				</div>
			</div>
			
			<!-- Card 3 -->
			<div class="card">
				<img src="../images/Home/grape_jam.png" alt="grape jam">
			
				<div class="content">
					<h3>Grape Jam</h3>
					<p>This is a delicious grape jam made from surplus ingredients, perfect for spreading on toast or adding to desserts.</p>
				</div>
			</div>
		</div>
		
		<div class="container2">
			<p>Click here to check it out!</p>
			<img src="../images/Home/arrow.png" alt="arrow">
			
			<form action="OurMenu.php#jam_&_spreads" method="get">
			<button type="submit" class="learn_more_button">Browse</button>
			</form>
		</div>
	</section>
	
	<!--The Curve Section-->
	<section style= "background-color: #FFE6E6;">
        <svg viewBox="0 0 1440 90" xmlns="http://www.w3.org/2000/svg" style="display: block;">
            <path fill="#EC9744" d="M596.757 21.4939C870.187 70.0522 1295.3 105.494 1440 58.3845V94H0V37.4939C121.746 8.05225 356.24 -21.2193 596.757 21.4939Z"></path>
        </svg>
	</section>

	<!--Community Impact Section-->
	<section class="community_impact">
		<h2>Community Impact</h2>		
		
		<div class="container-group">
			<div class="box">
				<img src="../images/Home/local_food_supplier.jpg">
				<div class="layer"></div>
				<div class="info">
					<h3>Local Food Supplier</h3>
					<p>Partnered with 20+ local suppliers to reduce food waste</p>
				</div>
			</div>
			
			<div class="box">
				<img src="../images/Home/surplus_food.jpg">
				<div class="layer"></div>
				<div class="info">
					<h3>Surplus Food</h3>
					<p>10KG of surplus food saved each month</p>
				</div>
			</div>
			
			<div class="box">
				<img src="../images/Home/B40_income.jpg">
				<div class="layer"></div>
				<div class="info">
					<h3>Food Bank Support</h3>
					<p>Feeds 50 families every month</p>
				</div>
			</div>
		</div>
		
		<form action="Donation.php" method="get">
			<button type="submit" class="learn_more_button">Donate Now</button>
		</form>
	</section>
	
	<!--Footer Section-->
	<footer class="footer">
		<?php 
		  include ('footer.php');
		?>
	</footer>	
</body>
</html>