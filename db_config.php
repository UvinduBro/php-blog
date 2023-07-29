<?php
// Replace these values with your actual database credentials
$host = "localhost";
$username = "your_mysql_username";
$password = "your_mysql_password";
$database = "blog_db";

// Create a connection
$conn = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
