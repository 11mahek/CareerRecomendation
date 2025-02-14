<?php
include('connect.php');

// Fetch all mentors from the database
$sql = "SELECT full_name, email, phone, dob, gender, linkedin, language, profile_pic FROM mentors";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mentorship Page</title>
    <style>
        /* body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        } */
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: auto;
            background: linear-gradient(-45deg, #6a0dad, #1e90ff, #ffffff, #000000);
            background-size: 400% 400%;
            animation: gradientAnimation 10s ease infinite;
            flex-direction: column;
            text-align: center;
            margin: 10px;
        }
        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .container {
            width: 80%;
            margin: 50px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            color: #333;
        }

        .mentor-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .mentor-card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 250px;
            text-align: center;
        }

        .mentor-card img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .mentor-card h3 {
            margin: 10px 0;
            color: #333;
        }

        .mentor-card p {
            font-size: 14px;
            color: #666;
        }

        .mentor-card a {
            display: inline-block;
            margin-top: 10px;
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Meet Our Mentors</h1>
        <div class="mentor-list">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="mentor-card">
                    <img src="uploads/<?php echo htmlspecialchars($row['profile_pic']); ?>" alt="Mentor Image">
                    <h3><?php echo htmlspecialchars($row['full_name']); ?></h3>
                    <p>Email: <?php echo htmlspecialchars($row['email']); ?></p>
                    <p>Phone: <?php echo htmlspecialchars($row['phone']); ?></p>
                    <p>Language: <?php echo htmlspecialchars($row['language']); ?></p>
                    <a href="<?php echo htmlspecialchars($row['linkedin']); ?>" target="_blank">LinkedIn Profile</a>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>
