<?php
function getUsers($connectDB, $search_term = '', $sort_column = 'fname', $sort_order = 'ASC') {
    //  Define allowed columns and orders
    $allowed_columns = ['user_id', 'fname', 'lname', 'email', 'gender', 'birthdate', 'phone', 'street', 'city', 'state', 'postal_code', 'district', 'role', 'registration_date'];
    $allowed_orders = ['ASC', 'DESC'];
    
    //default parameters
    if (!in_array($sort_column, $allowed_columns)) {
        $sort_column = 'fname';
    }
    
    if (!in_array($sort_order, $allowed_orders)) {
        $sort_order = 'ASC';
    }
    
    // Build base SQL query
    $sql = "SELECT * FROM users";
    
    // Add search condition if provided
    if (!empty($search_term)) {
        $search_term = mysqli_real_escape_string($connectDB, trim($search_term));
        $sql .= " WHERE fname LIKE '%$search_term%' OR lname LIKE '%$search_term%' OR email LIKE '%$search_term%'";
    }
    
    // Add sorting
    $sql .= " ORDER BY $sort_column $sort_order";
    
    // Execute query
    $result = mysqli_query($connectDB, $sql);
    
    return $result;
}
?>


