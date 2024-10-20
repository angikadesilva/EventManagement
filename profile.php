<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile Management</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            overflow: hidden; /* Prevent scrolling */
        }

        .profile-container {
            position: fixed;
            top: 0;
            right: -400px; /* Hide off-screen */
            width: 400px; /* Width of the sliding menu */
            height: 100vh; /* Full height */
            background-color: white;
            border-left: 1px solid #ddd;
            box-shadow: -2px 0 5px rgba(0, 0, 0, 0.1);
            transition: right 0.3s ease; /* Smooth slide-in effect */
            padding: 20px;
        }

        .profile-header {
            font-size: 1.5em;
            margin-bottom: 20px;
        }

        .close-btn {
            cursor: pointer;
            color: red;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="profile-container" id="profileContainer">
        <div class="close-btn" onclick="closeProfile()">✖ Close</div>
        <div class="profile-header">User Profile Management</div>
        <p>Manage your profile settings here.</p>
        <!-- Add more profile management elements as needed -->
    </div>

    <script>
        // Function to close the profile
        function closeProfile() {
            document.getElementById('profileContainer').style.right = '-400px';
        }

        // Function to open the profile (call this when you click on the username in the dashboard)
        function openProfile() {
            document.getElementById('profileContainer').style.right = '0';
        }
    </script>
</body>
</html>