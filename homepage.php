<?php
session_start();
include("connect.php");
if(!isset($_SESSION['user_name'])){
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
</head>
<body>
    <h1>Welcome! <h2><?php echo $_SESSION['user_name']?></h2></h1>
    <a href="mentorProfileCreation.php">Mentor Profile Creation</a>
    <a href="mentorship.php">Mentorship</a>
    <a href="logout.php">Logout</a>
    <a href="home_feedback.php">Feedback</a>
    <a href="student_profile.php">STUDENT PROFILE</a>
    <a href="mentor_profile.php">MENTOR PROFILE</a>
</body>
</html>