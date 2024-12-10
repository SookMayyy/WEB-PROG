<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://fonts.googleapis.com/css?family=Familjen Grotesk' rel='stylesheet'>
	<title>Panda Pagoda</title>
	<link rel="stylesheet" href="../User CSS/style.css">
	<link rel="stylesheet" href="../User CSS/aboutUs.css">
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
	<section id="aboutUs_hero">
		<h1>Welcome to<br>Panda Pagoda</h1>
		
		<div class="text">
			<p>Food also deserves a second chance, as do humans</p>
		</div>
	</section>
	
	<!-- Food Mission Section -->
	<section class="food_mission">
		<h2>Food is Our Mission</h2>
		<p>At Panda Pagoda, our mission is to reduce food waste by transforming surplus ingredients and imperfect vegetables into delicious, sustainable, and affordable meals that benefit both the community and the environment.</p>
		
		<div class="About_us_container">
			<div class="sub-container">
				<img src="../images/About Us/reduceFoodWaste.png">
				<p>REDUCE FOOD WASTE</p>
			</div>
			
			<div class="sub-container">
				<img src="../images/About Us/zeroHunger.png">
				<p>END GLOBAL HUNGER</p>
			</div>
			
			<div class="sub-container">
				<img src="../images/About Us/foodPrice.png">
				<p>AFFORDABLE FOOD PRICE</p>
			</div>
		</div>
	</section>
	
	<!-- Our Story Section -->
	<section class="our_story">
		<div class="our_story_container">
			<h2>Our Story</h2>
				<p>What started as a passion project to reduce food waste has grown into a restaurant that redefines dining. 
				Since 2020, we've been partnering with <b>local suppliers and markets</b> to rescue imperfect but perfectly edible food, ensuring that every bite you take helps the planet.</p>
		</div>
	</section>
	
	<!-- Line Section -->
	<div class="line"></div>
	
	<!-- Our Impact Section -->
	<section class="our_impact">
		<div class="our_impact_container">
			<h2>Our Impact</h2>
				<p>In the past year, we've saved <b>over 1,000kg</b> of surplus food from going to waste and served <b>over 2,000 sustainable meals</b> to our community.</p>
		</div>
	</section>
	
	<!-- Join Us Section -->
	<section class="join_us">
		<h2>Join Us</h2>
		
		<div class="container">
		 	<a href="OurMenu.php">
				<div class="about_us_subcontainer">
					<img src="../images/About Us/view_our_menu.jpeg">
					<h3>View Our Menu</h3>
				</div>
			</a>
			
			 <a href="Event.php#upcoming_event_banner">
			<div class="about_us_subcontainer">
				<img src="../images/About Us/view_upcoming_event.png">
				<h3>View Upcoming Events</h3>
			</div>
			</a>
			
			 <a href="Donation.php">
			<div class="about_us_subcontainer">
				<img src="../images/About Us/donate_now.jpeg">
				<h3>Donate Now</h3>
			</div>
			</a>
		</div>
	</section>
	
	<!-- FAQ Section -->
	<section class="FAQ" id="faq_section">
		<h2>FAQ</h2>
		
		<div class="FAQ_box">
			<button class="faq_question1">How do you ensure the food is safe to consume?
	            <span class="arrow">&#9660;</span>
	        </button>
	        <div class="faq_answer">
				<p>We adhere to strict food safety standards, including proper temperature control for perishable items.</li>
				 All srplus food is inspected for quality, including checking expiration dates, appearance, and freshness.</li>
				 Our team is trained in food safety protocols, including proper handling, storage, and sanitation practices.</li>
				 We work with trusted local suppliers and ensure that all food is transported in safe, hygienic conditions.</li>
				 Regular food safety audits and quality checks are conducted.</p>        
			</div>
			
        	<button class="faq_question2">Is surplus food as nutritious as fresh food?
            	<span class="arrow">&#9660;</span>
        	</button>
        	<div class="faq_answer">
            	<p>Yes, surplus food is just as nutritious as fresh food when it is stored and handled correctly.</p>
            	<ul>
				    <li>Nutrients in food are preserved as long as it is kept in the right conditions, such as maintaining the right temperature.</li>
				    <li>Many surplus items are perfectly fine and can provide essential vitamins and minerals, just like fresh produce.</li>
				    <li>Nutrient loss primarily occurs if food is improperly stored, such as being kept at the wrong temperature or exposed to air.</li>
				    <li>We prioritize sourcing surplus food that is still nutritious and viable for consumption.</li>
				</ul>
        	</div>

			<button class="faq_question1">How does the restaurant source its ingredients?
           		<span class="arrow">&#9660;</span>
        	</button>
        	<div class="faq_answer">
            	<p>We source our ingredients from local farmers and suppliers, focusing on reducing food waste by using surplus ingredients.
            	 We collaborate with suppliers who share our commitment to reducing food waste by sourcing near-expiry or surplus products.
            	 Our ingredients are carefully selected to ensure they meet our standards for quality and sustainability.
            	 We use locally grown produce whenever possible to support the community and reduce our carbon footprint.
            	 We are part of a circular economy, helping redistribute food that would otherwise go to waste.
            	  </p>
        	</div>
			
			<button class="faq_question2">What are imperfect vegetables, and how do you use them in your meals?
            	<span class="arrow">&#9660;</span>
        	</button>
        	<div class="faq_answer">
            	<p>Imperfect vegetables are those that don’t meet the aesthetic standards of supermarkets but are still perfectly edible. We use them in various meals to minimize food waste.
            	By using imperfect vegetables, we not only reduce food waste but also support sustainable farming practices.
				These vegetables can often have just as much flavor and nutrition as their more "perfect" counterparts.</p>
            	<ul>
				    <li>Examples include <b>misshapen carrots</b>, <b>slightly overripe tomatoes</b>, or <b>vegetables with minor blemishes</b>.</li>
				    <li>We use these vegetables in various <b>meals</b>, <b>soups</b>, <b>salads</b>, and <b>side dishes</b>, ensuring nothing goes to waste.</li>
				</ul>
        	</div>
		</div>
	</section>
	
	<!--Footer Section-->
	<footer class="footer">
		<?php 
		  include ('footer.php');
		?>
	</footer>	
	
	<!-- AboutUs Javascript -->
	<script src="AboutUs.js"></script>
	
</body>
</html>
