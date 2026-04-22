<?php
session_start();
require 'db.php';

// Only employers
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'employer') {
    header("Location: login.php");
    exit();
}

// CHECK job_id FIRST
if (!isset($_GET['job_id'])) {
    header("Location: manage_jobs.php");
    exit();
}

$job_id = $_GET['job_id'];

// 🔥 HANDLE ACCEPT
if (isset($_GET['accept'])) {
    $app_id = $_GET['accept'];

    $conn->query("UPDATE applications SET status='accepted' WHERE id='$app_id'");

    header("Location: view_applicants.php?job_id=$job_id");
    exit();
}

// 🔥 HANDLE REJECT
if (isset($_GET['reject'])) {
    $app_id = $_GET['reject'];

    $conn->query("UPDATE applications SET status='rejected' WHERE id='$app_id'");

    header("Location: view_applicants.php?job_id=$job_id");
    exit();
}
$job_id = $_GET['job_id'];

// Fetch applicants
$sql = "SELECT applications.id, users.name, users.email, 
        applications.applied_at, applications.status
        FROM applications
        JOIN users ON applications.user_id = users.id
        WHERE applications.job_id = '$job_id'
        ORDER BY applications.id DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Applicants</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
</head>

<body style="font-family: 'Inter', sans-serif;">

<?php include 'navbar_employer.php'; ?>

<div class="container mt-5" style="max-width: 1000px;">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-semibold mb-0">Applicants</h3>
        <a href="manage_jobs.php" class="btn btn-outline-secondary btn-sm">
            ← Back
        </a>
    </div>

    <!-- TABLE CARD -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">

            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Applied On</th>
                    </tr>
                </thead>

                <tbody>

            <?php while($row = $result->fetch_assoc()): ?>

<tr>
    <td class="fw-medium"><?php echo $row['name']; ?></td>
    <td><?php echo $row['email']; ?></td>
    <td><?php echo date('d M Y', strtotime($row['applied_at'])); ?></td>

    <td class="text-end">

        <?php if ($row['status'] == 'pending'): ?>

            <a href="view_applicants.php?job_id=<?php echo $job_id; ?>&accept=<?php echo $row['id']; ?>"
               class="btn btn-success btn-sm">
               Accept
            </a>

            <a href="view_applicants.php?job_id=<?php echo $job_id; ?>&reject=<?php echo $row['id']; ?>"
               class="btn btn-danger btn-sm">
               Reject
            </a>

        <?php elseif ($row['status'] == 'accepted'): ?>

            <span class="badge bg-success">Accepted</span>

        <?php else: ?>

            <span class="badge bg-danger">Rejected</span>

        <?php endif; ?>

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