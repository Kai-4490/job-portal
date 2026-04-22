<?php
session_start();
require 'db.php';

// Check login
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'job_seeker') {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Get job_id from URL
if (!isset($_GET['job_id'])) {
    header("Location: jobs.php");
    exit();
}

$job_id = $_GET['job_id'];

// Check if already applied
$check_sql = "SELECT * FROM applications 
              WHERE job_id = '$job_id' AND user_id = '$user_id'";
$check_result = $conn->query($check_sql);

if ($check_result->num_rows > 0) {
    // Already applied
    header("Location: jobs.php");
    exit();
}

// Insert application
$sql = "INSERT INTO applications (job_id, user_id)
        VALUES ('$job_id', '$user_id')";

$conn->query($sql);

// Redirect back
header("Location: jobs.php");
exit();
?>