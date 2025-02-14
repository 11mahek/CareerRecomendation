<?php
include('connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $rating = $_POST['rating'];
    $comments = $_POST['comments'];

    $sql = "INSERT INTO feedback (name, email, contact, rating, comments) VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssis", $name, $email, $contact, $rating, $comments);

    if ($stmt->execute()) {
        echo "<script>
                alert('Feedback submitted successfully!');
                window.location.href='homepage.php';
              </script>";
    } else {
        echo "<script>
                alert('Error submitting feedback.');
                window.location.href='index.php';
              </script>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<script>
            alert('Invalid request.');
            window.location.href='index.php';
          </script>";
}
?>
