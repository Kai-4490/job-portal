<?php
session_start();

// Only job seekers
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'job_seeker') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Job Seeker Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
</head>

<body style="font-family: 'Inter', sans-serif;">

<?php include 'navbar.php'; ?>

<div class="container mt-5" style="max-width: 1000px;">

    <!-- HEADER -->
    <div class="mb-4">
        <h3 class="fw-semibold mb-1">Dashboard</h3>
        <p class="text-muted small mb-0">Explore jobs and track your applications.</p>
    </div>

    <!-- ACTION CARDS -->
    <div class="row g-4">

        <!-- BROWSE JOBS -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="fw-semibold">Browse Jobs</h5>
                        <p class="text-muted small">
                            Discover new opportunities and apply.
                        </p>
                    </div>
                    <a href="jobs.php" class="btn btn-primary btn-sm mt-3">
                        View Jobs
                    </a>
                </div>
            </div>
        </div>

        <!-- MY APPLICATIONS -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="fw-semibold">My Applications</h5>
                        <p class="text-muted small">
                            Track and manage your applied jobs.
                        </p>
                    </div>
                    <a href="my_applications.php" class="btn btn-outline-dark btn-sm mt-3">
                        View Applications
                    </a>
                </div>
            </div>
        </div>

    </div>

</div>

</body>
</html>