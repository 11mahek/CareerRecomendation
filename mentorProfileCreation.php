<?php
include('connect.php');
session_start(); // Start session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $linkedin = $_POST['linkedin'];
    $language = $_POST['language'];

    // Image Upload Handling
    $image = $_FILES['image'];
    $imageName = time() . '_' . basename($image['name']);
    $targetDir = "uploads/";
    $targetFilePath = $targetDir . $imageName;

    if (move_uploaded_file($image['tmp_name'], $targetFilePath)) {
        // Insert into mentors table
        $sql = "INSERT INTO mentors (full_name, email, phone, dob, gender, linkedin, language, profile_pic) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssss", $fullName, $email, $phone, $dob, $gender, $linkedin, $language, $imageName);

        if ($stmt->execute()) {
            $_SESSION['user_name'] = $fullName; // Store mentor's name in session
            $_SESSION['user_role'] = "mentor";
            header('Location: homepage.php'); // Redirect to homepage after profile creation
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error uploading image.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 60%;
            margin: 50px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        section {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        input[type="checkbox"] {
            width: auto;
        }

        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 15px 20px;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
            width: 100%;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Mentor Profile Creation</h1>
        <form action="mentorprofilecreation.php" method="POST" enctype="multipart/form-data">
            <!-- Personal Information -->
            <section>
                <h2>Personal Information</h2>
                <label for="fullName">Full Name:</label>
                <input type="text" id="fullName" name="fullName" required><br><br>

                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" required><br><br>

                <label for="phone">Phone Number:</label>
                <input type="tel" id="phone" name="phone"><br><br>

                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" name="dob"><br><br>

                <label for="gender">Gender:</label>
                <select id="gender" name="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                    <option value="preferNotToSay">Prefer not to say</option>
                </select><br><br>
                <label for="linkedin">LinkedIn Profile:</label>
                <input type="url" id="linkedin" name="linkedin">
    
                <label for="image">Upload Profile Picture:</label>
                <input type="file" id="image" name="image" accept="image/*" required>
            </section>
            <!-- Preferences Section -->
            <section>
                <h2>Preferences</h2>
                <label for="language">Preferred Language:</label>
                <input type="text" id="language" name="language"><br><br>
	    </section>

            <button type="submit">Save Profile</button>
        </form>
    </div>

    <script>
        document.getElementById("profileForm").addEventListener("submit", function(event) {
            event.preventDefault();
            const formData = new FormData(event.target);
            let userProfile = {};

            formData.forEach((value, key) => {
                userProfile[key] = value;
            });

            console.log("User Profile Data Submitted:", userProfile);
            alert("Profile Updated Successfully!");
        });
    </script>
</body>
</html>