<!-- Left Banner -->
	<div class="pagoda_banner">
		<img src="../images/Login/pagoda_banner.png" alt="Panda_Pagoda_Banner">
	</div>


<!-- Right Banner -->
<div class="login_content">
    <h2>Admin Log In</h2>
    
    <form action="adminlogin_function.php" method="POST">
        <input type="email" id="email" name="email" placeholder="Email" required><br>
        <input type="password" id="password" name="password" placeholder="Password" required><br>
        <input type="hidden" name="adminlogin" value="true">
        <button type="submit" class="login_button">Login</button>
    </form>
    
    <a href="../User PHP/login.php">User Login</a>
</div>