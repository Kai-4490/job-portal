<?php
session_start();
require 'db.php';

// Check if user is logged in and is employer
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'employer') {
    header("Location: login.php");
    exit();
}

$employer_id = $_SESSION['user_id'];

// DELETE JOB
if (isset($_GET['delete'])) {
    $job_id = $_GET['delete'];

    $delete_sql = "DELETE FROM jobs WHERE id = '$job_id' AND employer_id = '$employer_id'";
    $conn->query($delete_sql);

    header("Location: manage_jobs.php");
    exit();
}

// FETCH JOBS
$sql = "SELECT * FROM jobs WHERE employer_id = '$employer_id'";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Jobs</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
</head>

<body style="font-family: 'Inter', sans-serif;">

<?php include 'navbar_employer.php'; ?>


<div class="container mt-5" style="max-width: 1000px;">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-semibold mb-0">My Jobs</h3>
        <a href="add_job.php" class="btn btn-primary btn-sm">+ Add Job</a>
    </div>

    <!-- TABLE CARD -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">

            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Location</th>
                        <th>Posted On</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>

                <tbody>

                <?php while($row = $result->fetch_assoc()): ?>

                    <tr>
                        <td><?php echo $row['title']; ?></td>
                        <td><?php echo $row['location']; ?></td>
                        <td><?php echo $row['created_at']; ?></td>

                        <td class="text-end">
                            <a href="view_applicants.php?job_id=<?php echo $row['id']; ?>" 
                               class="btn btn-outline-dark btn-sm">
                                View
                            </a>

                            <a href="manage_jobs.php?delete=<?php echo $row['id']; ?>" 
                               class="btn btn-sm text-danger"
                               onclick="return confirm('Delete this job?')">
                                Delete
                            </a>
                        </td>
                    </tr>

                <?php endwhile; ?>

                </tbody>
            </table>

        </div>
    </div>

</div>

</body>
</html>