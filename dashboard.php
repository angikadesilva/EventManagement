<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management Dashboard</title>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.1.8/index.global.min.css' rel='stylesheet' />
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.1.8/index.global.min.js'></script>
    <style>
    body {
    margin: 0;
    font-family: Arial, sans-serif;
    background-color: #121212; /* Dark background */
    color: #fff; /* White text for better contrast */
    display: flex;
    height: 100vh;
}

.dashboard {
    height: 100vh; /* full height */
    display: flex;
    border: 5px solid #444; /* Dark gray border for modern look */
    border-radius: 10px; /* rounded corners */
    margin: 20px; /* space around the dashboard */
    padding: 10px; /* inner padding */
    position: relative; /* for user icon positioning */
    background-color: #1a1a1a; /* Dark gray for the dashboard */
    flex: 1; /* allow the dashboard to grow */
}

/* Left section for profile and form */
.profile-container {
    width: 50%;
    padding: 20px;
    background-color: #222; /* Darker background for profile */
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.2);
    overflow-y: auto;
    color: #fff; /* White text color */
}

/* Right section for the calendar */
.calendar-container {
    width: 45%; /* Slightly smaller width for calendar */
    padding: 20px;
}
.calendar-container h3 {
    font-size: 24px; /* Change this value to your desired size */
    margin-top: 10px;
}

/* Header styling */
.profile-header {
    font-size: 1.5em;
    margin-bottom: 20px;
}

/* Event form styling */
.event-form {
    margin-top: 130px;
    background-color: #444; /* Slightly lighter dark gray for form */
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

.event-form input,
.event-form textarea,
.event-form button {
    display: block;
    width: 100%;
    margin-bottom: 15px;
    padding: 10px;
    font-size: 1em;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

.event-form input:focus,
.event-form textarea:focus {
    border-color: #FFD700; /* Yellow focus color */
    outline: none;
}

.event-form button {
    background: #FFD700; /* Yellow for buttons */
    color: black; /* Black text for better contrast */
    border: none;
    cursor: pointer;
    font-size: 1.1em;
    font-weight: bold;
    transition: background-color 0.3s;
}

.event-form button:hover {
    background-color: #FFC107; /* Slightly darker yellow on hover */
}

/* Modal Styling */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1000; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgba(0, 0, 0, 0.8); /* Black w/ opacity */
}

.modal-content {
    background-color: #1a1a1a; /* Dark background for modal */
    color: #fff; /* White text for contrast */
    margin: 15% auto; /* 15% from the top and centered */
    padding: 20px;
    border: 1px solid #888; /* Light border for visibility */
    width: 40%; /* Could be more or less, depending on screen size */
    border-radius: 10px; /* Rounded corners */
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.7); /* Deeper shadow for modal */
}

/* Buttons for edit and delete */
.action-button {
    padding: 10px 20px;
    margin: 5px;
    border: none;
    cursor: pointer;
    font-size: 1em;
    border-radius: 5px;
    transition: background-color 0.3s, transform 0.2s; /* Add transition */
}

.edit-btn {
    background-color: #FFD700; /* Yellow for edit */
    color: black;
}

.delete-btn {
    background-color: #FFD700; /* Yellow for delete */
    color: black;
}

.more-info-btn {
    background-color: #FFD700; /* Yellow for more info */
    color: black;
}

/* Dark mode button hover effect */
.edit-btn:hover,
.delete-btn:hover,
.more-info-btn:hover {
    background-color: #FFC107; /* Slightly darker yellow on hover */
    transform: scale(1.05); /* Slightly enlarge on hover */
}

/* User icon */
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

/* Notification styling */
.notification {
    background-color: #333; /* Darker gray background for notification */
    color: #fff; /* White text */
    border-radius: 5px;
    padding: 10px 20px;
    margin-top: 10px;
    font-size: 0.9em;
    display: none; /* Hidden by default */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); /* Shadow for depth */
}

/* Success and error notification colors */
.notification.success {
    background-color: #4CAF50; /* Green background for success */
}

.notification.error {
    background-color: #f44336; /* Red background for error */
}

/* Additional notification features */
.notification.fade-in {
    animation: fadeIn 0.5s; /* Fade-in effect */
}

.notification.fade-out {
    animation: fadeOut 0.5s; /* Fade-out effect */
}

/* Keyframes for fade-in and fade-out animations */
@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

@keyframes fadeOut {
    from {
        opacity: 1;
    }
    to {
        opacity: 0;
    }
}

    </style>
</head>
<body>
    <div class="dashboard">
        <div class="user-icon" onclick="openProfile()">
            <span class="user-symbol">👤</span> 
            <span id="username">Username</span>
        </div>

        <!-- Left Section: Profile Management and Event Form -->
        <div class="profile-container">
            <div class="profile-header"></div>


            <!-- Event Creation Form -->
            <div class="event-form">
                <h3>Create an Event</h3>
                <form method="POST" action="dashboard.php">
                    <input type="text" name="event_name" placeholder="Event Name" required>
                    <input type="date" name="event_date" required>
                    <input type="time" name="event_time" required>
                    <input type="text" name="event_location" placeholder="Location" required>
                    <textarea name="event_notes" placeholder="Special Notes" rows="4"></textarea>
                    <button type="submit" name="create_event">Create Event</button>
                </form>
            </div>
        </div>

        <!-- Right Section: Calendar -->
        <div class="calendar-container">
    <h3>Event Calendar</h3>
    <div id="calendar"></div>
</div>

<!-- Modal for Event Actions -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <h2 id="modalEventTitle"></h2>
        <p id="modalEventLocation"></p>
        <p id="modalEventNotes"></p>
        <button class="action-button edit-btn" onclick="editEvent()">Edit Event</button>
        <button class="action-button delete-btn" onclick="deleteEvent()">Delete Event</button>
        <button class="action-button more-info-btn" onclick="moreInfo()">More Info</button>
        <button class="action-button" onclick="closeModal()">Close</button>
    </div>
</div>

<script>
    let currentEventId = null;

    function openProfile() {
        window.open('profile.php', '_self');
    }

    function closeModal() {
        document.getElementById("myModal").style.display = "none";
    }

    function deleteEvent() {
        if (currentEventId) {
            window.location.href = 'dashboard.php?delete_id=' + currentEventId;
        }
    }

    function editEvent() {
        if (currentEventId) {
            window.location.href = 'edit_event.php?event_id=' + currentEventId; // Redirect to edit event page
        }
        closeModal(); // Close the modal after initiating the edit
    }

    function moreInfo() {
        if (currentEventId) {
            // Redirect to the more_details.php page with the event_id as a query parameter
            window.location.href = 'more_details.php?event_id=' + currentEventId;
        }
        closeModal(); // Close the modal after redirecting
    }

    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: [
                <?php
                // Database connection
                $conn = new mysqli("localhost", "root", "", "EventManagement");
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Create table if it doesn't exist
                $createTableQuery = "CREATE TABLE IF NOT EXISTS CreateEvent (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    event_name VARCHAR(255) NOT NULL,
                    event_date DATE NOT NULL,
                    event_time TIME NOT NULL,
                    event_location VARCHAR(255) NOT NULL,
                    event_notes TEXT
                )";
                $conn->query($createTableQuery);

                // Handle event creation
                if (isset($_POST['create_event'])) {
                    $eventName = $_POST['event_name'];
                    $eventDate = $_POST['event_date'];
                    $eventTime = $_POST['event_time'];
                    $eventLocation = $_POST['event_location'];
                    $eventNotes = $_POST['event_notes'];

                    $insertQuery = "INSERT INTO CreateEvent (event_name, event_date, event_time, event_location, event_notes) VALUES (?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($insertQuery);
                    $stmt->bind_param("sssss", $eventName, $eventDate, $eventTime, $eventLocation, $eventNotes);
                    $stmt->execute();
                    $stmt->close();
                }

                // Handle event deletion
                if (isset($_GET['delete_id'])) {
                    $deleteId = $_GET['delete_id'];
                    $deleteQuery = "DELETE FROM CreateEvent WHERE id = ?";
                    $stmt = $conn->prepare($deleteQuery);
                    $stmt->bind_param("i", $deleteId);
                    $stmt->execute();
                    $stmt->close();
                }

                // Fetch events from the database
                $fetchEventsQuery = "SELECT * FROM CreateEvent";
                $result = $conn->query($fetchEventsQuery);
                while ($row = $result->fetch_assoc()) {
                    echo "{
                        id: " . $row['id'] . ",
                        title: '" . addslashes($row['event_name']) . "',
                        start: '" . $row['event_date'] . "T" . $row['event_time'] . "',
                        location: '" . addslashes($row['event_location']) . "',
                        notes: '" . addslashes($row['event_notes']) . "'
                    },";
                }

                $conn->close();
                ?>
            ],
            eventClick: function (info) {
                currentEventId = info.event.id; // Set the current event ID
                document.getElementById("modalEventTitle").innerText = info.event.title;
                document.getElementById("modalEventLocation").innerText = "Location: " + info.event.extendedProps.location;
                document.getElementById("modalEventNotes").innerText = "Notes: " + info.event.extendedProps.notes;
                document.getElementById("myModal").style.display = "block";
            },
            eventContent: function(arg) {
                // Add a yellow dot in front of the event title
                return {
                    html: '<div><span style="color: yellow; font-weight: bold;">&#9679;</span> ' + arg.event.title + '</div>'
                };
            }
        });
        calendar.render();
    });
</script>

</body>
</html>
