<?php
session_start();
require 'db.php';

// Only job seekers
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'job_seeker') {
    header("Location: login.php");
    exit();
}

// HANDLE WITHDRAW (ONLY IF PENDING)
if (isset($_GET['delete'])) {
    $app_id = $_GET['delete'];
    $user_id = $_SESSION['user_id'];

    $delete_sql = "DELETE FROM applications 
                   WHERE id = '$app_id' 
                   AND user_id = '$user_id'
                   AND status = 'pending'";
    $conn->query($delete_sql);

    header("Location: my_applications.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// ✅ UPDATED QUERY (includes status)
$sql = "SELECT applications.id, jobs.title, jobs.location, 
        applications.applied_at, applications.status
        FROM applications
        JOIN jobs ON applications.job_id = jobs.id
        WHERE applications.user_id = '$user_id'
        ORDER BY applications.id DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Applications</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
</head>

<body style="font-family: 'Inter', sans-serif;">

<?php include 'navbar.php'; ?>

<div class="container mt-5" style="max-width: 1000px;">

    <!-- HEADER -->
    <div class="mb-4">
        <h3 class="fw-semibold mb-0">My Applications</h3>
    </div>

    <!-- TABLE CARD -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">

            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Job Title</th>
                        <th>Location</th>
                        <th>Applied On</th>
                        <th>Status</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>

                <tbody>

                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>

                        <tr>
                            <td class="fw-medium"><?php echo $row['title']; ?></td>
                            <td><?php echo $row['location']; ?></td>

                            <td>
                                <?php echo date('d M Y', strtotime($row['applied_at'])); ?>
                            </td>

                            <!-- STATUS -->
                            <td>
                                <?php if ($row['status'] == 'accepted'): ?>
                                    <span class="badge bg-success">Accepted</span>
                                <?php elseif ($row['status'] == 'rejected'): ?>
                                    <span class="badge bg-danger">Rejected</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Pending</span>
                                <?php endif; ?>
                            </td>

                            <!-- ACTION -->
                            <td class="text-end">

                                <?php if ($row['status'] == 'pending'): ?>

                                    <a href="my_applications.php?delete=<?php echo $row['id']; ?>"
                                       class="btn btn-sm text-danger"
                                       onclick="return confirm('Withdraw application?')">
                                       Withdraw
                                    </a>

                                <?php else: ?>

                                    <span class="text-muted small">No action</span>

                                <?php endif; ?>

                            </td>
                        </tr>

                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center text-muted">
                            No applications found.
                        </td>
                    </tr>
                <?php endif; ?>

                </tbody>
            </table>

        </div>
    </div>

</div>

</body>
</html>