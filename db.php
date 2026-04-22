<?php

$host = "localhost";
$user = "root";
$password = "4490"; // default is empty in XAMPP
$database = "job_portal";

// Create connection
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



?>