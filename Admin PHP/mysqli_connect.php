<?php
// Make database connection
$connectDB = mysqli_connect('localhost', 'root', '', 'pandapagoda');

// If failed connection
if(!$connectDB) {
    echo "Connection to the database is unsuccessful.";
}

// Set the encoding...
mysqli_set_charset($connectDB, 'utf8');
?>