<?php
include 'mysqli_connect.php';

$menuid = $_GET['menu_id'];

// Delete the item from the database
$sql = "DELETE FROM menu WHERE menu_id='$menuid'";

if ($connectDB->query($sql) === TRUE) { ?>
	<script type="text/javascript">
        window.alert("This menu item has been deleted. You will be returned to the menu list page."); 
        window.location.href = 'Admin_Menu.php';        
    </script>
<?php     
} else {?>
    <script type="text/javascript">
        window.alert("Sorry, this menu item could not be deleted. You will be returned to the menu list page.");
        window.location.href = 'Admin_Menu.php';
    </script>
<?php
}
?>