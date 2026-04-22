<?php
session_start();
require 'db.php';

// Check if user is logged in AND is employer
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'employer') {
    header("Location: login.php");
    exit();
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = $_POST['title'];
    $description = $_POST['description'];
    $location = $_POST['location'];

    $employer_id = $_SESSION['user_id'];

    $sql = "INSERT INTO jobs (employer_id, title, description, location)
            VALUES ('$employer_id', '$title', '$description', '$location')";

    if ($conn->query($sql) === TRUE) {
        $message = "Job posted successfully!";
    } else {
        $message = "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Job</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
</head>

<body style="font-family: 'Inter', sans-serif;">

<?php include 'navbar_employer.php'; ?>


<div class="container mt-5" style="max-width: 700px;">

    <!-- HEADER -->
    <div class="mb-4">
        <h3 class="fw-semibold mb-1">Post a Job</h3>
        <p class="text-muted small mb-0">Fill in the details to create a job listing.</p>
    </div>

    <!-- FORM CARD -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">

            <?php if (isset($message)): ?>
                <!-- <div class="alert alert-info"><?php echo $message; ?></div> -->
            <?php endif; ?>

            <form method="POST">

                <div class="mb-3">
                    <label class="form-label text-muted">Job Title</label>
                    <input type="text" name="title" class="form-control form-control-lg" required>
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted">Location</label>
                    <input type="text" name="location" class="form-control form-control-lg" required>
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted">Description</label>
                    <textarea name="description" rows="4" class="form-control" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    Post Job
                </button>

            </form>

        </div>
    </div>

</div>

</body>
</html>