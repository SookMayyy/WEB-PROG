<?php
include 'mysqli_connect.php';

function searchDonations($search_term, $sort_column, $sort_order)
{
    global $connectDB;
    
    // Define allowed columns for sorting
    $allowed_columns = ['donation_id', 'full_name', 'email', 'phone', 'amount', 'donation_method', 'donation_date'];
    $allowed_order = ['ASC', 'DESC'];
    
    // Validate the sort_by and order parameters
    if (!in_array($sort_column, $allowed_columns)) {
        $sort_column = 'donation_date'; // Default column to sort
    }
    if (!in_array($sort_order, $allowed_order)) {
        $sort_order = 'DESC'; // Default order
    }
    
    // Query to fetch donation data with search and sorting
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
            CONCAT(u.fname, ' ', u.lname) LIKE '%$search_term%'
            OR u.email LIKE '%$search_term%'
            OR u.phone LIKE '%$search_term%'
            OR d.donation_method LIKE '%$search_term%'
        ORDER BY
            $sort_column $sort_order
    ";
            
            return mysqli_query($connectDB, $sql);
}