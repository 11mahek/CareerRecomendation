<?php
session_start();
include 'connect.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];  // Logged-in user ID

// Fetch existing profile data
$profileQuery = "SELECT * FROM user_profiles WHERE user_id='$user_id'";
$profileResult = $conn->query($profileQuery);
$profileData = $profileResult->fetch_assoc();

// Handle profile update
if (isset($_POST['updateProfile'])) {
    $bio = $_POST['bio'];
    $phone = $_POST['phone'];
    $linkedin = $_POST['linkedin'];

    // Handle profile picture upload
    if (!empty($_FILES['profile_pic']['name'])) {
        $target_dir = "uploads/";
        $profile_pic = basename($_FILES['profile_pic']['name']);
        $target_file = $target_dir . $profile_pic;
        move_uploaded_file($_FILES['profile_pic']['tmp_name'], $target_file);
    } else {
        $profile_pic = $profileData['profile_pic'];
    }

    // Update profile data
    $updateQuery = "UPDATE user_profiles SET bio='$bio', phone='$phone', linkedin='$linkedin', profile_pic='$profile_pic' WHERE user_id='$user_id'";
    if ($conn->query($updateQuery)) {
        header("Location: profile.php"); // Redirect back to profile
        exit();
    } else {
        echo "Error updating profile: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="profile-container">
        <h3>Edit Profile</h3>
        <form method="POST" enctype="multipart/form-data">
            <label>Bio</label>
            <textarea name="bio" class="form-control"><?php echo $profileData['bio']; ?></textarea>
            
            <label>Phone</label>
            <input type="text" name="phone" class="form-control" value="<?php echo $profileData['phone']; ?>">

            <label>LinkedIn</label>
            <input type="text" name="linkedin" class="form-control" value="<?php echo $profileData['linkedin']; ?>">

            

            <br>
            <button type="submit" name="updateProfile" class="btn btn-success">Update Profile</button>
            <a href="profile.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
</body>
</html>
