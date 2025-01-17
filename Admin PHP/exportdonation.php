<?php
include 'mysqli_connect.php';

if (isset($_GET['search']) || isset($_GET['sort_by']) || isset($_GET['order'])) {
    // Get search and sorting parameters
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'donation_date';
    $order = isset($_GET['order']) ? $_GET['order'] : 'DESC';
    
    // Define allowed columns and order
    $allowed_columns = ['donation_id', 'full_name', 'email', 'phone', 'amount', 'donation_method', 'donation_date'];
    $allowed_order = ['ASC', 'DESC'];
    
    // Validate parameters
    if (!in_array($sort_by, $allowed_columns)) {
        $sort_by = 'donation_date';
    }
    if (!in_array($order, $allowed_order)) {
        $order = 'DESC';
    }
    
    // Query to fetch donation data
    $sql = "
        SELECT
            d.donation_id,
            CONCAT(u.fname, ' ', u.lname) AS full_name,
            u.email,
            u.phone,
            d.amount,
            d.donation_method,
            d.donation_date
        FROM
            Donation d
        JOIN
            Users u
        ON
            d.user_id = u.user_id
        WHERE
            CONCAT(u.fname, ' ', u.lname) LIKE '%$search%'
            OR u.email LIKE '%$search%'
            OR u.phone LIKE '%$search%'
            OR d.donation_method LIKE '%$search%'
        ORDER BY
            $sort_by $order
    ";
            
            $result = mysqli_query($connectDB, $sql);
            
            // Generate CSV
            if ($result && mysqli_num_rows($result) > 0) {
                header('Content-Type: text/csv');
                header('Content-Disposition: attachment; filename="donations.csv"');
                
                // Output column names
                $output = fopen('php://output', 'w');
                fputcsv($output, ['Donation ID', 'Full Name', 'Email', 'Phone', 'Amount', 'Donation Method', 'Donation Date']);
                
                // Output rows
                while ($row = mysqli_fetch_assoc($result)) {
                    fputcsv($output, $row);
                }
                fclose($output);
                exit;
            } else {
                echo "No data available for export.";
            }
} else {
    echo "Invalid request.";
}
?>