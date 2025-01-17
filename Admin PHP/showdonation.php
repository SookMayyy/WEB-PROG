<?php
include 'searchdonation.php'; // Include the search function

// Handle search input and sorting parameters
$search_term = isset($_GET['search']) ? $_GET['search'] : '';
$sort_column = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'donation_date'; // Default column
$sort_order = isset($_GET['order']) ? $_GET['order'] : 'DESC'; // Default order

// Fetch donation data
$result = searchDonations($search_term, $sort_column, $sort_order);
?>

<!-- search function -->
<form action="" method="GET">
	<label>Search donation: </label>
    <input type="text" name="search" placeholder="Search by name, email, phone, or method" value="<?php echo htmlspecialchars($search_term); ?>">
    <button type="submit">Search</button>
    <a href="donationlist.php"><button type="button">Reset</button></a>
</form>

<!-- Export button -->
<form action="exportdonation.php" method="GET">
    <input type="hidden" name="search" value="<?php echo htmlspecialchars($search_term); ?>">
    <input type="hidden" name="sort_by" value="<?php echo htmlspecialchars($sort_column); ?>">
    <input type="hidden" name="order" value="<?php echo htmlspecialchars($sort_order); ?>">
    <button type="submit">Export to CSV</button>
</form>

<!-- table for donation info -->
<table>
    <thead>
        <tr>
            <th><a href="?search=<?php echo urlencode($search_term); ?>&sort_by=donation_id&order=<?php echo $sort_column == 'ASC' ? 'DESC' : 'ASC'; ?>">
            	Donation ID<span class="sort-icon <?php echo ($sort_column == 'donation_id' ? ($sort_order == 'ASC' ? 'asc' : 'desc') : ''); ?>"></span>
            </a></th>
            <th><a href="?search=<?php echo urlencode($search_term); ?>&sort_by=full_name&order=<?php echo $sort_column == 'ASC' ? 'DESC' : 'ASC'; ?>">
            	Full Name<span class="sort-icon <?php echo ($sort_column == 'full_name' ? ($sort_order == 'ASC' ? 'asc' : 'desc') : ''); ?>"></span>
            </a></th>
            <th><a href="?search=<?php echo urlencode($search_term); ?>&sort_by=email&order=<?php echo $sort_column == 'ASC' ? 'DESC' : 'ASC'; ?>">
            	Email<span class="sort-icon <?php echo ($sort_column == 'email' ? ($sort_order == 'ASC' ? 'asc' : 'desc') : ''); ?>"></span>
            </a></th>
            <th><a href="?search=<?php echo urlencode($search_term); ?>&sort_by=phone&order=<?php echo $sort_column == 'ASC' ? 'DESC' : 'ASC'; ?>">
            	Phone<span class="sort-icon <?php echo ($sort_column == 'phone' ? ($sort_order == 'ASC' ? 'asc' : 'desc') : ''); ?>"></span>
            </a></th>
            <th><a href="?search=<?php echo urlencode($search_term); ?>&sort_by=amount&order=<?php echo $sort_column == 'ASC' ? 'DESC' : 'ASC'; ?>">
            	Donation Amount<span class="sort-icon <?php echo ($sort_column == 'amount' ? ($sort_order == 'ASC' ? 'asc' : 'desc') : ''); ?>"></span>
            </a></th>
            <th><a href="?search=<?php echo urlencode($search_term); ?>&sort_by=donation_method&order=<?php echo $sort_column == 'ASC' ? 'DESC' : 'ASC'; ?>">
            	Donation Method<span class="sort-icon <?php echo ($sort_column == 'donation_method' ? ($sort_order == 'ASC' ? 'asc' : 'desc') : ''); ?>"></span>
            </a></th>
            <th><a href="?search=<?php echo urlencode($search_term); ?>&sort_by=donation_date&order=<?php echo $sort_column == 'ASC' ? 'DESC' : 'ASC'; ?>">
            	Donation Date<span class="sort-icon <?php echo ($sort_column == 'donation_date' ? ($sort_order == 'ASC' ? 'asc' : 'desc') : ''); ?>"></span>
            </a></th>
        </tr>
    </thead>
	<tbody>
        <?php
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                    <td>{$row['donation_id']}</td>
                    <td>{$row['full_name']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['phone']}</td>
                    <td>{$row['amount']}</td>
                    <td>{$row['donation_method']}</td>
                    <td>{$row['donation_date']}</td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No donations found.</td></tr>";
        }
        ?>
    </tbody>
</table>

