<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #000; /* black background */
            color: #fff; /* white text for better contrast */
        }

        .dashboard {
            height: 100vh; /* full height */
            display: flex;
            border: 5px solid #444; /* dark gray border for modern look */
            border-radius: 10px; /* rounded corners */
            margin: 20px; /* space around the dashboard */
            padding: 10px; /* inner padding */
            position: relative; /* for user icon positioning */
            background-color: #1a1a1a; /* dark gray for the dashboard */
        }

        .user-icon {
            position: absolute;
            top: 10px;
            left: 10px;
            cursor: pointer;
            display: flex;
            align-items: center;
            background: linear-gradient(45deg, orange, yellow);
            padding: 8px;
            border-radius: 5px;
        }

        .user-symbol {
            margin-right: 5px; /* gap between the symbol and username */
            font-size: 1.2em; /* size of the user symbol */
            border: 2px solid #fff; /* white border around the symbol */
            border-radius: 50%; /* make it circular */
            padding: 4px; /* padding inside the circle */
            display: flex;
            justify-content: center;
            align-items: center;
            width: 30px; /* fixed width for circle */
            height: 30px; /* fixed height for circle */
        }

        #username {
            font-size: 0.9em; /* size of the username */
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <div class="user-icon" onclick="openProfile()">
            <span class="user-symbol">👤</span> 
            <span id="username">Username</span>
        </div>
    </div>

    <script>
        function openProfile() {
            window.open('profile.php', '_self'); // Opens the profile page in the same window
        }
    </script>
</body>
</html>
