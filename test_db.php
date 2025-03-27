<?php
// Database connection details
$host = 'localhost:3307';
$username = 'root';
$password = '';
$database = 'souffle_db';

// Create a connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

// Close the connection
$conn->close();
?>