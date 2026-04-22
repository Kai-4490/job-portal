<?php
session_start();
require 'db.php';

// Only job seekers
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'job_seeker') {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// ✅ Query with applied status
$sql = "SELECT jobs.id, jobs.title, jobs.location, jobs.created_at,
        applications.id AS applied
        FROM jobs
        LEFT JOIN applications 
        ON jobs.id = applications.job_id 
        AND applications.user_id = '$user_id'
        ORDER BY jobs.id DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Jobs</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
</head>

<body style="font-family: 'Inter', sans-serif;">

<?php include 'navbar.php'; ?>

<div class="container mt-5" style="max-width: 1000px;">

    <!-- HEADER -->
    <div class="mb-4">
        <h3 class="fw-semibold mb-0">Available Jobs</h3>
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
                                <?php echo date('d M Y', strtotime($row['created_at'])); ?>
                            </td>

                            <td class="text-end">
                                <?php if ($row['applied']): ?>

                                    <button class="btn btn-gray btn-sm" disabled>
                                        Applied
                                    </button>

                                <?php else: ?>

                                    <a href="apply.php?job_id=<?php echo $row['id']; ?>" 
                                       class="btn btn-primary btn-sm">
                                       Apply
                                    </a>

                                <?php endif; ?>
                            </td>
                        </tr>

                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center text-muted">
                            No jobs available.
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