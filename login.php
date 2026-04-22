<?php
session_start();
require 'db.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['name'] = $user['name'];

            if ($user['role'] == 'employer') {
                header("Location: employer_dashboard.php");
            } else {
                header("Location: jobseeker_dashboard.php");
            }
            exit();

        } else {
            $message = "Invalid password!";
        }

    } else {
        $message = "User not found!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="font-family: 'Inter', sans-serif;">

<div class="container-fluid vh-100">
    <div class="row h-100">

        <!-- LEFT SIDE (Branding) -->
        <div class="col-md-6 d-none d-md-flex text-white align-items-center justify-content-center"
     style="background: linear-gradient(135deg, #1e293b, #000000);">
            <div class="text-center px-4">
    <h1 class="fw-bold display-5">Job Portal</h1>
    <p class="mt-3 fs-5">
        Discover opportunities.  
        Connect with employers.  
        Build your career.
    </p>
</div>
        </div>

        <!-- RIGHT SIDE (Form) -->
        <div class="col-md-6 d-flex align-items-center justify-content-center bg-light">

            <div style="width: 100%; max-width: 400px;">

                <h3 class="mb-4 fw-semibold">Welcome Back </h3>

                <?php if ($message): ?>
                    <div class="alert alert-danger"><?php echo $message; ?></div>
                <?php endif; ?>

                <form method="POST">

                    <div class="mb-3">
                       <label class="form-label text-muted">Email</label>
                        <input type="email" name="email" class="form-control form-control-lg" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted">Password</label>
                        <input type="password" name="password" class="form-control form-control-lg" required>
                    </div>

                    <button class="btn btn-primary w-100 btn-lg">
                        Login
                    </button>

                </form>

                <div class="text-center mt-3">
                    <small>
                        Don’t have an account? 
                        <a href="register.php">Register</a>
                    </small>
                </div>

            </div>

        </div>

    </div>
</div>

</body>
</html>