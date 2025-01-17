<?php
include 'mysqli_connect.php';
//user sorting
include 'searchusers.php';

// Get parameters from URL
$search_term = isset($_GET['search']) ? $_GET['search'] : '';
$sort_column = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'fname';
$sort_order = isset($_GET['order']) && $_GET['order'] === 'DESC' ? 'DESC' : 'ASC';

// Fetch user data
$result = getUsers($connectDB, $search_term, $sort_column, $sort_order);
?>

<!-- form to search user -->
<form method="GET" action="">
	<label>Search user: </label>
    <input type="text" name="search" placeholder="Search by name or email" value="<?php echo htmlspecialchars($search_term); ?>">
    <button type="submit" name="searchuser">Search</button>
    <a href="userlist.php"><button type="button">Reset</button></a>
</form>
    
<a href="addadmin.php" class="button">Add an Admin Account</a>    


<!-- print user data -->
<table>
	<thead>
	   <tr>
           <th><a href="?search=<?php echo urlencode($search_term); ?>&sort_by=fname&order=<?php echo $sort_order == 'ASC' ? 'DESC' : 'ASC'; ?>">
            	First Name<span class="sort-icon <?php echo ($sort_column == 'fname' ? ($sort_order == 'ASC' ? 'asc' : 'desc') : ''); ?>"></span>
        	</a></th>
           <th><a href="?search=<?php echo urlencode($search_term); ?>&sort_by=lname&order=<?php echo $sort_order == 'ASC' ? 'DESC' : 'ASC'; ?>">
           		Last Name<span class="sort-icon <?php echo ($sort_column == 'lname' ? ($sort_order == 'ASC' ? 'asc' : 'desc') : ''); ?>"></span>
       		</a></th>
           <th><a href="?search=<?php echo urlencode($search_term); ?>&sort_by=gender&order=<?php echo $sort_order == 'ASC' ? 'DESC' : 'ASC'; ?>">
           		Gender<span class="sort-icon <?php echo ($sort_column == 'gender' ? ($sort_order == 'ASC' ? 'asc' : 'desc') : ''); ?>"></span>
       		</a></th>
           <th><a href="?search=<?php echo urlencode($search_term); ?>&sort_by=birthdate&order=<?php echo $sort_order == 'ASC' ? 'DESC' : 'ASC'; ?>">
           		Birth Date<span class="sort-icon <?php echo ($sort_column == 'birthdate' ? ($sort_order == 'ASC' ? 'asc' : 'desc') : ''); ?>"></span>
       		</a></th>
           <th><a href="?search=<?php echo urlencode($search_term); ?>&sort_by=phone&order=<?php echo $sort_order == 'ASC' ? 'DESC' : 'ASC'; ?>">
       			Phone Number<span class="sort-icon <?php echo ($sort_column == 'phone' ? ($sort_order == 'ASC' ? 'asc' : 'desc') : ''); ?>"></span>
   			</a></th>
           <th><a href="?search=<?php echo urlencode($search_term); ?>&sort_by=street&order=<?php echo $sort_order == 'ASC' ? 'DESC' : 'ASC'; ?>">
           		Street<span class="sort-icon <?php echo ($sort_column == 'street' ? ($sort_order == 'ASC' ? 'asc' : 'desc') : ''); ?>"></span>
       		</a></th>
           <th><a href="?search=<?php echo urlencode($search_term); ?>&sort_by=city&order=<?php echo $sort_order == 'ASC' ? 'DESC' : 'ASC'; ?>">
           		City<span class="sort-icon <?php echo ($sort_column == 'city' ? ($sort_order == 'ASC' ? 'asc' : 'desc') : ''); ?>"></span>
           </a></th>
           <th><a href="?search=<?php echo urlencode($search_term); ?>&sort_by=state&order=<?php echo $sort_order == 'ASC' ? 'DESC' : 'ASC'; ?>">
           		State<span class="sort-icon <?php echo ($sort_column == 'state' ? ($sort_order == 'ASC' ? 'asc' : 'desc') : ''); ?>"></span>
           </a></th>
           <th><a href="?search=<?php echo urlencode($search_term); ?>&sort_by=postal_code&order=<?php echo $sort_order == 'ASC' ? 'DESC' : 'ASC'; ?>">
           		Postcode<span class="sort-icon <?php echo ($sort_column == 'postal_code' ? ($sort_order == 'ASC' ? 'asc' : 'desc') : ''); ?>"></span>
           </a></th>
           <th><a href="?search=<?php echo urlencode($search_term); ?>&sort_by=district&order=<?php echo $sort_order == 'ASC' ? 'DESC' : 'ASC'; ?>">
           		District<span class="sort-icon <?php echo ($sort_column == 'district' ? ($sort_order == 'ASC' ? 'asc' : 'desc') : ''); ?>"></span>
           </a></th>          
           <th><a href="?search=<?php echo urlencode($search_term); ?>&sort_by=email&order=<?php echo $sort_order == 'ASC' ? 'DESC' : 'ASC'; ?>">
           		Email<span class="sort-icon <?php echo ($sort_column == 'email' ? ($sort_order == 'ASC' ? 'asc' : 'desc') : ''); ?>"></span>
           </a></th>
           <th><a href="?search=<?php echo urlencode($search_term); ?>&sort_by=point_balance&order=<?php echo $sort_order == 'ASC' ? 'DESC' : 'ASC'; ?>">
           		Points<span class="sort-icon <?php echo ($sort_column == 'point_balance' ? ($sort_order == 'ASC' ? 'asc' : 'desc') : ''); ?>"></span>
           </a></th>
           <th><a href="?search=<?php echo urlencode($search_term); ?>&sort_by=role&order=<?php echo $sort_order == 'ASC' ? 'DESC' : 'ASC'; ?>">
           		Role<span class="sort-icon <?php echo ($sort_column == 'role' ? ($sort_order == 'ASC' ? 'asc' : 'desc') : ''); ?>"></span>
           </a></th>
           <th><a href="?search=<?php echo urlencode($search_term); ?>&sort_by=registration_date&order=<?php echo $sort_order == 'ASC' ? 'DESC' : 'ASC'; ?>">
           		Registration Date<span class="sort-icon <?php echo ($sort_column == 'registration_date' ? ($sort_order == 'ASC' ? 'asc' : 'desc') : ''); ?>"></span>
           </a></th>
           <th>Edit</th>
           <th>Delete</th>
       </tr>
     </thead>
     <tbody>
     	<?php 
     	//check if there is data in database
     	if ($result && mysqli_num_rows($result) > 0) {
     	    //loop each row in the database
     	    while($data=mysqli_fetch_array($result)) {
     	        $userid = $data['user_id'];
     	           echo "<tr>
             	          <td>".$data['fname']."</td>
             	          <td>".$data['lname']."</td>
             	          <td>".$data['gender']."</td>
             	          <td>".$data['birthdate']."</td>
             	          <td>".$data['phone']."</td>
             	          <td>".$data['street']."</td>
             	          <td>".$data['city']."</td>
             	          <td>".$data['state']."</td>
             	          <td>".$data['postal_code']."</td>
                          <td>".$data['district']."</td>
             	          <td>".$data['email']."</td>
             	          <td>".$data['point_balance']."</td>
             	          <td>".$data['role']."</td>
             	          <td>".$data['registration_date']."</td>
                          <td><a href='edituser.php?user_id=".$userid."' class='view-link'>Edit</a></td>
                          <td><a href='deleteuser.php?user_id=".$userid."'class='delete-link'>Delete</a></td>
             	      </tr>";
     	      }
     	    } else {
     	        echo "<tr><td colspan='16'>No users found</td></tr>";
     	    }
     	?>
     </tbody>
 </table>