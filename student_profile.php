<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];
$query = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo "User not found!";
    exit();
}

$isStudent = ($user['role'] === 'student');

if ($isStudent) {
    $studentQuery = "SELECT * FROM user_details WHERE email = ?";
    $stmt = $conn->prepare($studentQuery);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $studentResult = $stmt->get_result();
    $student = $studentResult->fetch_assoc() ?? [];
}

// Handle Profile Update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_profile'])) {
    $bio = $_POST['bio'];
    $school = $_POST['school'];
    $interests = $_POST['interests'];
    $skills = $_POST['skills'];

    // Check if user exists in user_details
    $checkQuery = "SELECT email FROM user_details WHERE email = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        // Update record
        $updateQuery = "UPDATE user_details SET bio=?, school=?, interests=?, skills=? WHERE email=?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("sssss", $bio, $school, $interests, $skills, $email);
    } else {
        // Insert new record
        $insertQuery = "INSERT INTO user_details (email, bio, school, interests, skills) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("sssss", $email, $bio, $school, $interests, $skills);
    }

    if ($stmt->execute()) {
        echo "<script>alert('Profile updated successfully!'); window.location.href='student_profile.php';</script>";
    } else {
        echo "<script>alert('Error updating profile!');</script>";
    }
}

// Handle Password Change
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['change_password'])) {
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    if (password_verify($currentPassword, $user['password'])) {
        if ($newPassword === $confirmPassword) {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $updatePasswordQuery = "UPDATE users SET password=? WHERE email=?";
            $stmt = $conn->prepare($updatePasswordQuery);
            $stmt->bind_param("ss", $hashedPassword, $email);

            if ($stmt->execute()) {
                echo "<script>alert('Password changed successfully!');</script>";
            } else {
                echo "<script>alert('Error updating password!');</script>";
            }
        } else {
            echo "<script>alert('New passwords do not match!');</script>";
        }
    } else {
        echo "<script>alert('Incorrect current password!');</script>";
    }
}

// Handle Logout
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}

// Handle Account Deletion
if (isset($_POST['delete_account'])) {
    $deleteQuery = "DELETE FROM users WHERE email=?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("s", $email);
    
    if ($stmt->execute()) {
        session_destroy();
        echo "<script>alert('Account deleted successfully!'); window.location.href='login.php';</script>";
        exit();
    } else {
        echo "<script>alert('Error deleting account!');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body { background-color: #f4f4f9; }
        .profile-container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .profile-pic {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="profile-container text-center">
        <img src="<?php echo htmlspecialchars($user['profile_pic']); ?>" alt="Profile Picture" class="profile-pic mb-3">
        <h2><?php echo htmlspecialchars($user['name']); ?></h2>
        <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>

        <?php if ($isStudent): ?>
            <h4>Basic Information</h4>
            <p><strong>Bio:</strong> <?php echo $student['bio'] ?? 'Not Provided'; ?></p>
            <p><strong>School:</strong> <?php echo $student['school'] ?? 'Not Provided'; ?></p>
            <p><strong>Interests:</strong> <?php echo $student['interests'] ?? 'Not Provided'; ?></p>
            <p><strong>Skills:</strong> <?php echo $student['skills'] ?? 'Not Provided'; ?></p>

            <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#editProfileModal">Edit Profile</button>
            <button class="btn btn-secondary mt-3" data-bs-toggle="modal" data-bs-target="#settingsModal">Settings</button>
        <?php endif; ?>
    </div>
</div>

<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <input type="text" name="bio" class="form-control mb-2" placeholder="Bio" value="<?php echo $student['bio'] ?? ''; ?>" required>
                    <input type="text" name="school" class="form-control mb-2" placeholder="school" value="<?php echo $student['school'] ?? ''; ?>" required>
                    <input type="text" name="skills" class="form-control mb-2" placeholder="Skills" value="<?php echo $student['skills'] ?? ''; ?>" required>
                    <input type="text" name="interests" class="form-control mb-2" placeholder="interests" value="<?php echo $student['interests'] ?? ''; ?>" required>
                    <button type="submit" name="update_profile" class="btn btn-success w-100">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Settings Modal -->
<div class="modal fade" id="settingsModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Settings</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <!-- Change Password -->
                <h5>Change Password</h5>
                <form method="POST">
                    <input type="password" name="current_password" class="form-control mb-2" placeholder="Current Password" required>
                    <input type="password" name="new_password" class="form-control mb-2" placeholder="New Password" required>
                    <input type="password" name="confirm_password" class="form-control mb-2" placeholder="Confirm New Password" required>
                    <button type="submit" name="change_password" class="btn btn-primary w-100">Update Password</button>
                </form>
                <hr>
                
                <!-- Logout Button -->
                <h5>Logout</h5>
                <form method="POST">
                    <button type="submit" name="logout" class="btn btn-warning w-100">Logout</button>
                </form>
                <hr>

                <!-- Delete Account -->
                <h5>Delete Account</h5>
                <form method="POST">
                    <button type="submit" name="delete_account" class="btn btn-danger w-100" onclick="return confirm('Are you sure you want to delete your account? This action is irreversible.');">Delete My Account</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
