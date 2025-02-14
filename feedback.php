<?php
include('connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .feedback-form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        .form-group {
            margin: 15px;
        }
        .form-group label {
            font-weight: bold;
        }
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-group textarea {
            resize: vertical;
        }
        .form-group button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .form-group button:hover {
            background-color: #45a049;
        }
        .rating-label {
            font-weight: bold;
        }
        .rating {
            display: flex;
            justify-content: space-between;
        }
        .rating span {
            cursor: pointer;
            font-size: 20px;
        }
        .rating span:hover {
            color: #FFD700;
        }
        .rating span.selected {
            color: #FFD700;
        }
    </style>
</head>
<body>

    <center><h1>Feedback Form</h1></center>
    <form class="feedback-form" method="POST" action="submit_feedback.php">
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div class="form-group">
        <label for="contact">Contact Number:</label>
        <input type="text" id="contact" name="contact" required>
    </div>
    <div class="form-group">
        <label for="rating" class="rating-label">Rating (out of 5):</label>
        <div class="rating" id="rating">
            <span class="star" data-value="1">&#9733;</span>
            <span class="star" data-value="2">&#9733;</span>
            <span class="star" data-value="3">&#9733;</span>
            <span class="star" data-value="4">&#9733;</span>
            <span class="star" data-value="5">&#9733;</span>
        </div>
        <input type="hidden" id="ratingInput" name="rating" required>
    </div>
    <div class="form-group">
        <label for="comments">Additional Comments:</label>
        <textarea id="comments" name="comments" rows="4"></textarea>
    </div>
    <div class="form-group">
        <button type="submit">Submit Feedback</button>
    </div>
</form>


    <div id="ratingDisplay" style="display:none;">
        <h3>Thank you for your feedback!</h3>
        <p>Your rating: <span id="userRating"></span> out of 5</p>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let selectedRating = 0;

            // Handle rating click
            const stars = document.querySelectorAll('.star');
            stars.forEach(star => {
                star.addEventListener('click', function() {
                    selectedRating = parseInt(star.getAttribute('data-value'));
                    updateRatingDisplay();
                });
            });

            function updateRatingDisplay() {
                stars.forEach(star => {
                    star.classList.remove('selected');
                    if (parseInt(star.getAttribute('data-value')) <= selectedRating) {
                        star.classList.add('selected');
                    }
                });
            }

            // Handle form submission
            const form = document.getElementById('feedbackForm');
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                
                if (selectedRating > 0) {
                    document.getElementById('userRating').innerText = selectedRating;
                    document.getElementById('ratingDisplay').style.display = 'block';
                    form.reset();
                    selectedRating = 0;
                    updateRatingDisplay();
                } else {
                    alert('Please provide a rating.');
                }
            });
        });
    </script>

</body>
</html>