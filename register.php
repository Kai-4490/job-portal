<?php
require 'db.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert into DB
    $sql = "INSERT INTO users (name, email, password, role) 
            VALUES ('$name', '$email', '$hashed_password', '$role')";

    if ($conn->query($sql) === TRUE) {
        $message = "Registration successful! <a href='login.php'>Login here</a>";
    } else {
        $message = "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
</head>

<body style="font-family: 'Inter', sans-serif;">

<div class="container-fluid vh-100">
    <div class="row h-100">

        <!-- LEFT SIDE -->
        <div class="col-md-6 d-none d-md-flex text-white align-items-center justify-content-center"
             style="background: linear-gradient(135deg, #1e293b, #334155);">

            <div class="text-center px-4">
                <h1 class="fw-semibold display-5">Job Portal</h1>
                <p class="mt-3 text-light opacity-75">
                    Join the platform.  
                    Discover opportunities.  
                    Build your future.
                </p>
            </div>

        </div>

        <!-- RIGHT SIDE -->
        <div class="col-md-6 d-flex align-items-center justify-content-center bg-light">

            <div style="width: 100%; max-width: 420px;">

                <h3 class="mb-4 fw-semibold">Create Account</h3>

                <?php if (isset($message)): ?>
                    <!-- <div class="alert alert-info"><?php echo $message; ?></div> -->
                <?php endif; ?>

                <form method="POST">

                    <div class="mb-3">
                        <label class="form-label text-muted">Name</label>
                        <input type="text" name="name" class="form-control form-control-lg" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted">Email</label>
                        <input type="email" name="email" class="form-control form-control-lg" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted">Password</label>
                        <input type="password" name="password" class="form-control form-control-lg" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted">Role</label>
                        <select name="role" class="form-select form-select-lg">
                            <option value="job_seeker">Job Seeker</option>
                            <option value="employer">Employer</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 btn-lg">
                        Register
                    </button>

                </form>

                <div class="text-center mt-3">
                    <small>
                        Already have an account? 
                        <a href="login.php">Login</a>
                    </small>
                </div>

            </div>

        </div>

    </div>
</div>

</body>
</html>