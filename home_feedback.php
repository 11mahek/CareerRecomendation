<?php
include('connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Feedback Slider</title>
    <style>
              body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(-45deg, #6a0dad, #1e90ff, #ffffff, #000000);
            background-size: 400% 400%;
            animation: gradientAnimation 10s ease infinite;
            flex-direction: column;
            text-align: center;
        }
        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        .quote {
            font-size: 2rem;
            color: white;
            margin-bottom: 50px;
            font-style: italic;
        }
        .feedback-button {
            background-color:black;
            margin-top: 40px;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 1.2em;
            cursor: pointer;
            border-radius: 5px;
        }
        .feedback-button:hover {
            background-color:darkblue;
        }

        .slider-container {
            width: 80%;
            overflow: hidden;
            position: relative;
        }

        .slider {
            display: flex;
            width: 100%;
            animation: slide 28s linear infinite;
        }

        .slide {
            flex: 0 0 33.33%;
            padding: 20px;
            background: #fff;
            margin: 10px;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .slide:hover {
            transform: scale(1.05);
        }

        .stars {
            color: #ffcc00;
            font-size: 18px;
        }

        .feedback-text {
            margin: 10px 0;
            font-size: 14px;
            color: #333;
        }

        .user-info {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }

        .user-info img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .user-name {
            font-weight: bold;
        }

        @keyframes slide {
            0% { transform: translateX(0); }
            25% { transform: translateX(-33.33%); }
            50% { transform: translateX(-66.66%); }
            75% { transform: translateX(-99.99%); }
            100% { transform: translateX(0); }
        }
    </style>
</head>
<body>
    <div class="quote"><b>"Your feedback fuels our growth. Share your thoughts!" 🚀</b></div>

    <div class="slider-container">
        <div class="slider">
            <div class="slide">
                <div class="stars">★★★★★</div>
                <p class="feedback-text">"Amazing product! Helped me improve my business efficiency."</p>
                <div class="user-info">
                    <img src="https://randomuser.me/api/portraits/men/1.jpg" alt="User">
                    <div>
                        <div class="user-name">John Doe</div>
                        <small>Mentor</small>
                    </div>
                </div>
            </div>

            <div class="slide">
                <div class="stars">★★★★★</div>
                <p class="feedback-text">"The best service I have ever used. Highly recommend to everyone!"</p>
                <div class="user-info">
                    <img src="https://randomuser.me/api/portraits/women/2.jpg" alt="User">
                    <div>
                        <div class="user-name">Jane Smith</div>
                        <small>Student</small>
                    </div>
                </div>
            </div>

            <div class="slide">
                <div class="stars">★★★★★</div>
                <p class="feedback-text">"Very easy to use and the results are outstanding. 10/10!"</p>
                <div class="user-info">
                    <img src="https://randomuser.me/api/portraits/men/3.jpg" alt="User">
                    <div>
                        <div class="user-name">Michael Brown</div>
                        <small>Student</small>
                    </div>
                </div>
            </div>

            <div class="slide">
                <div class="stars">★★★★★</div>
                <p class="feedback-text">"The best service I have ever used. Highly recommend to everyone!"</p>
                <div class="user-info">
                    <img src="https://randomuser.me/api/portraits/women/2.jpg" alt="User">
                    <div>
                        <div class="user-name">Jane Smith</div>
                        <small>Mentor</small>
                    </div>
                </div>
            </div>

            <div class="slide">
                <div class="stars">★★★★★</div>
                <p class="feedback-text">"Customer support was fantastic. They really care about their users."</p>
                <div class="user-info">
                    <img src="https://randomuser.me/api/portraits/women/4.jpg" alt="User">
                    <div>
                        <div class="user-name">Emily Johnson</div>
                        <small>Mentor</small>
                    </div>
                </div>
            </div>

            <div class="slide">
                <div class="stars">★★★★★</div>
                <p class="feedback-text">"Best decision I made this year! Highly recommended."</p>
                <div class="user-info">
                    <img src="https://randomuser.me/api/portraits/men/5.jpg" alt="User">
                    <div>
                        <div class="user-name">David Lee</div>
                        <small>Product Manager</small>
                    </div>
                </div>
            </div>

            <div class="slide">
                <div class="stars">★★★★★</div>
                <p class="feedback-text">"The best service I have ever used. Highly recommend to everyone!"</p>
                <div class="user-info">
                    <img src="https://randomuser.me/api/portraits/women/2.jpg" alt="User">
                    <div>
                        <div class="user-name">Jane Smith</div>
                        <small>Business Consultant</small>
                    </div>
                </div>
            </div>

            <div class="slide">
                <div class="stars">★★★★★</div>
                <p class="feedback-text">"It’s been a pleasure using this service. Excellent results."</p>
                <div class="user-info">
                    <img src="https://randomuser.me/api/portraits/women/6.jpg" alt="User">
                    <div>
                        <div class="user-name">Sarah Wilson</div>
                        <small>CEO</small>
                    </div>
                </div>
            </div>

            <div class="slide">
                <div class="stars">★★★★★</div>
                <p class="feedback-text">"The best service I have ever used. Highly recommend to everyone!"</p>
                <div class="user-info">
                    <img src="https://randomuser.me/api/portraits/women/2.jpg" alt="User">
                    <div>
                        <div class="user-name">Jane Smith</div>
                        <small>Business Consultant</small>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <button class="feedback-button" onclick="openFeedbackForm()">Give Feedback</button>
    <script>
        function openFeedbackForm() {
            window.location.href = "feedback.php"; // Redirect to a feedback form page
        }
    </script>

</body>
</html>
