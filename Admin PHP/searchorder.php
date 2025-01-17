<?php
include 'mysqli_connect.php';

function searchOrders($search_term, $sort_column, $sort_order)
{
    global $connectDB;
    
    // Define allowed columns for sorting
    $allowed_columns = ['order_id', 'full_name','contact', 'payment_method', 'payment_amount', 'total_price', 'address', 'points_used', 'discount', 'status', 'order_date'];
    $allowed_order = ['ASC', 'DESC'];
    
    // Validate the sort_by and order parameters
    if (!in_array($sort_column, $allowed_columns)) {
        $sort_column = 'order_date'; // Default column to sort
    }
    if (!in_array($sort_order, $allowed_order)) {
        $sort_order = 'DESC'; // Default order
    }
    
    // Query to fetch donation data with search and sorting
    $sql = "
        SELECT
            o.order_id,
            CONCAT(u.fname, ' ', u.lname) AS full_name,
            CONCAT(u.email, ', ', u.phone) AS contact,
            o.status,
            o.points_used,
            o.discount,
            o.total_price,
            p.payment_method,
            p.payment_amount,
            CONCAT(o.street, ', ', o.city, ', ', o.state, ', ', o.postal_code, ', ', o.district) AS address,
            o.order_date
        FROM
            orders o
        INNER JOIN
            users u ON o.user_id = u.user_id
        INNER JOIN
            payments p ON o.order_id = p.order_id
        WHERE
            CONCAT(u.fname, ' ', u.lname) LIKE '%$search_term%'
            OR u.email LIKE '%$search_term%'
            OR u.phone LIKE '%$search_term%'
            OR o.status LIKE '%$search_term%'
        ORDER BY
            $sort_column $sort_order
    ";
            
            return mysqli_query($connectDB, $sql);
}