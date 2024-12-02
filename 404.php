<?php
    http_response_code(404); // Set the response code to 404
    session_start();
    include './functions/common_files.php';
    include 'connect.php';
    date_default_timezone_set("Asia/Kolkata");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - proTech</title>
    <link rel="icon" type="image/png" href="/project1/logo.png" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body, html {
            height: 100%;
            display: flex;
            flex-direction:column;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            padding:10px;
        }

        .image-container {
            margin-bottom: 20px;
        }

        .image-container img {
            max-width: 150px;
        }

        h1 {
            font-size: 2rem;
            color: #333;
            margin-bottom: 20px;
        }

        p {
            font-size: 1.2rem;
            color: #666;
            margin-bottom: 20px;
        }

        .button {
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1rem;
        }

        .button:hover {
            background-color: #0056b3;
        }

        /* responsive design */
        @media (max-width: 480px) {
            .container {
                padding: 15px;
                width: 90%;
            }

            h1 {
                font-size: 1.8rem;
            }

            .button {
                padding: 10px 18px;
                font-size: 1rem;
            }
        }

    </style>
</head>
<body>
    <div class="image-container">
        <img src="/project1/logo.png" alt="Company logo">
    </div>
    <h1>404 - Page Not Found</h1>
    <p>Oops! The page you're looking for doesn't exist or has been moved.</p>
    <p>Please check the URL or return to our homepage.</p>
    <a href="http://localhost/project1/home.php" class="button">Go Back to Home</a>
</body>
</html>