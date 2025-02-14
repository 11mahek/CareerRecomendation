<?php
require 'connect.php';

if (!isset($_GET["token"])) {
    die("Invalid request.");
}

$token = $_GET["token"];

// Check if token is valid and not expired
$stmt = $conn->prepare("SELECT email FROM users WHERE reset_token=? AND reset_token_expiry > NOW()");
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Invalid or expired token. <a href='forgot_password.php'>Request a new one</a>");
}

$row = $result->fetch_assoc();
$email = $row["email"];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newPassword = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // Update password and remove token
    $stmt = $conn->prepare("UPDATE users SET password=?, reset_token_expiry=NULL WHERE email=?");
    $stmt->bind_param("ss", $newPassword, $email);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $message[] = "<p class='success'>Password reset successfully. <a href='login.php'>Login</a></p>";
    } else {
        $message[] = "<p class='error'>Error resetting password.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 350px;
        }
        h2 {
            margin-bottom: 20px;
            color: #333;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        button {
            width: 100%;
            padding: 10px;
            background: #6a11cb;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }
        button:hover {
            background: #2575fc;
        }
        .success {
            color: green;
            font-weight: bold;
        }
        .error {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Reset Your Password</h2>
        <form method="post">
            <input type="password" name="password" placeholder="Enter new password" required>
            <button type="submit">Reset Password</button>
            <?php
             if(isset($message)){
                foreach($message as $m){
                    echo $m;
                }
             }
            ?>
        </form>
    </div>
</body>
</html>
