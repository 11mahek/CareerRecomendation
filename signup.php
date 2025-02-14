<?php
session_start();
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signupbtn'])) {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = trim($_POST['password']);
    $role = htmlspecialchars(trim($_POST['role']));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message[] = "Invalid email format!";
    } elseif (strlen($password) < 6) {
        $message[] = "Password must be at least 6 characters!";
    } else {
        $checkEmailQuery = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($checkEmailQuery);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $message[] = "Email Already Exists!";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $profilePic = "uploads/default_user.png"; 

            if (!empty($_FILES['profile_pic']['name'])) {
                $profilePic = "uploads/" . basename($_FILES["profile_pic"]["name"]);
                move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $profilePic);
            }

            $insertQuery = "INSERT INTO users (name, email, password, role, profile_pic) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($insertQuery);
            $stmt->bind_param("sssss", $name, $email, $hashedPassword, $role, $profilePic);

            if ($stmt->execute()) {
                $_SESSION['email'] = $email;
                $_SESSION['role'] = $role;
                if ($role === 'student') {
                    header("Location: login.php");
                } else {
                    header("Location: mentorProfileCreation.php?email=$email");
                }
                exit();
            } else {
                $message[] = "Error: " . $conn->error;
            }
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea, #764ba2);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Poppins', sans-serif;
        }
        .container {
            max-width: 500px;
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
        }
        h3 {
            text-align: center;
            color: #333;
            font-weight: bold;
        }
        .form-control {
            border-radius: 8px;
            padding: 5px;
            font-size: 16px;
        }
        .form-control:focus {
            border-color: #764ba2;
            box-shadow: 0px 0px 8px rgba(118, 75, 162, 0.3);
        }
        .btn-primary {
            background: #764ba2;
            border: none;
            padding: 12px;
            font-size: 18px;
            font-weight: bold;
            border-radius: 8px;
            transition: 0.3s;
        }
        .btn-primary:hover {
            background: #5b3d91;
        }
        .text-center a {
            text-decoration: none;
            color: #764ba2;
            font-weight: bold;
        }
        .text-center a:hover {
            text-decoration: underline;
        }
        .alert {
            font-size: 14px;
            padding: 8px;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h3 class="text-center">Sign Up</h3>
    <p class="text-center">Already have an account? <a href="login.php">Login</a></p>
    
    <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email Address</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Profile Picture (Optional)</label>
            <input type="file" name="profile_pic" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Register As:</label>
            <select name="role" class="form-control" required>
                <option value="student">Student</option>
                <option value="mentor">Mentor</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary w-100" name="signupbtn">Sign Up</button>
        <?php
        if (!empty($message)) {
            foreach ($message as $m) {
                echo "<div class='alert alert-danger mt-3'>$m</div>";
            }
        }
        ?>
    </form>
</div>
</body>
</html>
