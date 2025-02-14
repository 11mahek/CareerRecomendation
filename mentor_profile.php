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

$isMentor = ($user['role'] === 'mentor');

if ($isMentor) {
    $mentorQuery = "SELECT * FROM mentors WHERE email = ?";
    $stmt = $conn->prepare($mentorQuery);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $mentorResult = $stmt->get_result();
    $mentor = $mentorResult->fetch_assoc() ?? [];
}

// Initialize alert message
$alertMessage = "";

// Handle Profile Update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_profile'])) {
    $bio = $_POST['bio'];
    $profession = $_POST['profession'];
    $experience = $_POST['experience'];
    $skills = $_POST['skills'];
    $availability = $_POST['availability'];
    $linkedin = $_POST['linkedin'];
    $language = $_POST['language'];

    $updateQuery = "UPDATE mentors SET bio=?, profession=?, experience=?, skills=?, availability=?, linkedin=?, language=? WHERE email=?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("ssssssss", $bio, $profession, $experience, $skills, $availability, $linkedin, $language, $email);

    if ($stmt->execute()) {
        $alertMessage = "Profile updated successfully!";
    } else {
        $alertMessage = "Error updating profile!";
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
                $alertMessage = "Password changed successfully!";
            } else {
                $alertMessage = "Error updating password!";
            }
        } else {
            $alertMessage = "New passwords do not match!";
        }
    } else {
        $alertMessage = "Incorrect current password!";
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
    // Delete from users table
    $deleteQuery = "DELETE FROM users WHERE email=?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("s", $email);
    $stmt->execute(); // Execute first query

    // Delete from mentors table
    $deleteQuery = "DELETE FROM mentors WHERE email=?";
    $stmt = $conn->prepare($deleteQuery); // Prepare new statement
    $stmt->bind_param("s", $email);
    
    if ($stmt->execute()) { // Execute second query
        session_destroy();
        echo "<script>alert('Account deleted successfully!'); window.location.href='login.php';</script>";
        exit();
    } else {
        $alertMessage = "Error deleting account!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mentor Profile</title>
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

<?php if ($alertMessage): ?>
    <script>
        alert("<?php echo $alertMessage; ?>");
        window.location.href = "mentor_profile.php";
    </script>
<?php endif; ?>

<div class="container mt-5">
    <div class="profile-container text-center">
        <img src="<?php echo htmlspecialchars($user['profile_pic']); ?>" alt="Profile Picture" class="profile-pic mb-3">
        <h2><?php echo htmlspecialchars($user['name']); ?></h2>
        <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>

        <?php if ($isMentor): ?>
            <h4>Mentor Information</h4>
            <p><strong>Bio:</strong> <?php echo $mentor['bio'] ?? 'Not Provided'; ?></p>
            <p><strong>Profession:</strong> <?php echo $mentor['profession'] ?? 'Not Provided'; ?></p>
            <p><strong>Experience:</strong> <?php echo $mentor['experience'] ?? 'Not Provided'; ?></p>
            <p><strong>Skills:</strong> <?php echo $mentor['skills'] ?? 'Not Provided'; ?></p>
            <p><strong>Availability:</strong> <?php echo $mentor['availability'] ?? 'Not Provided'; ?></p>
            <p><strong>LinkedIn:</strong> <?php echo $mentor['linkedin'] ?? 'Not Provided'; ?></p>
            <p><strong>Languages:</strong> <?php echo $mentor['language'] ?? 'Not Provided'; ?></p>

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
                    <input type="text" name="bio" class="form-control mb-2" placeholder="Bio" value="<?php echo $mentor['bio'] ?? ''; ?>" required>
                    <input type="text" name="profession" class="form-control mb-2" placeholder="Profession" value="<?php echo $mentor['profession'] ?? ''; ?>" required>
                    <input type="text" name="experience" class="form-control mb-2" placeholder="Experience" value="<?php echo $mentor['experience'] ?? ''; ?>" required>
                    <input type="text" name="skills" class="form-control mb-2" placeholder="Skills" value="<?php echo $mentor['skills'] ?? ''; ?>" required>
                    <input type="text" name="availability" class="form-control mb-2" placeholder="Availability" value="<?php echo $mentor['availability'] ?? ''; ?>" required>
                    <input type="text" name="linkedin" class="form-control mb-2" placeholder="LinkedIn Profile" value="<?php echo $mentor['linkedin'] ?? ''; ?>">
                    <input type="text" name="language" class="form-control mb-2" placeholder="Languages" value="<?php echo $mentor['language'] ?? ''; ?>">
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
