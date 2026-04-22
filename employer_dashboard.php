<?php
session_start();

// Check if user is logged in and is employer
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'employer') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Employer Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
</head>

<body style="font-family: 'Inter', sans-serif;">

<?php include 'navbar_employer.php'; ?>

<div class="container mt-5" style="max-width: 1000px;">

    <!-- HEADER -->
    <div class="mb-4">
        <h3 class="fw-semibold mb-1">Dashboard</h3>
        <p class="text-muted small mb-0">Manage your job postings and applicants.</p>
    </div>

    <!-- ACTION CARDS -->
    <div class="row g-4">

        <!-- ADD JOB -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="fw-semibold">Post a Job</h5>
                        <p class="text-muted small">
                            Create and publish new job listings.
                        </p>
                    </div>
                    <a href="add_job.php" class="btn btn-primary btn-sm mt-3">
                        Add Job
                    </a>
                </div>
            </div>
        </div>

        <!-- MANAGE JOBS -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="fw-semibold">Manage Jobs</h5>
                        <p class="text-muted small">
                            View, edit, or delete your job postings.
                        </p>
                    </div>
                    <a href="manage_jobs.php" class="btn btn-outline-dark btn-sm mt-3">
                        Manage Jobs
                    </a>
                </div>
            </div>
        </div>

        <!-- VIEW APPLICANTS -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="fw-semibold">View Applicants</h5>
                        <p class="text-muted small">
                            Check who has applied to your jobs.
                        </p>
                    </div>
                    <a href="manage_jobs.php" class="btn btn-outline-secondary btn-sm mt-3">
                        View Applicants
                    </a>
                </div>
            </div>
        </div>

    </div>

</div>

</body>
</html>