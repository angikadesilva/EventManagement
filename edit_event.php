<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "EventManagement");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if event_id is set
if (isset($_GET['event_id'])) {
    $eventId = $_GET['event_id'];

    // Fetch event details
    $stmt = $conn->prepare("SELECT * FROM CreateEvent WHERE id = ?");
    $stmt->bind_param("i", $eventId);
    $stmt->execute();
    $result = $stmt->get_result();
    $event = $result->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Update event details
        $eventName = $_POST['event_name'];
        $eventDate = $_POST['event_date'];
        $eventTime = $_POST['event_time'];
        $eventLocation = $_POST['event_location'];
        $eventNotes = $_POST['event_notes'];

        $updateStmt = $conn->prepare("UPDATE CreateEvent SET event_name = ?, event_date = ?, event_time = ?, event_location = ?, event_notes = ? WHERE id = ?");
        $updateStmt->bind_param("sssssi", $eventName, $eventDate, $eventTime, $eventLocation, $eventNotes, $eventId);
        if ($updateStmt->execute()) {
            // Redirect back to the dashboard after editing
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Error updating record: " . $conn->error;
        }
        $updateStmt->close();
    }
} else {
    echo "No event selected.";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
    <style>
        body {
            background-color: #1a1a1a; /* Dark background */
            color: #ffffff; /* White text */
            font-family: Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .edit-event-container {
            background-color: #333333; /* Slightly lighter than body */
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0px 0px 10px 2px rgba(0, 0, 0, 0.5);
            width: 80%;
            max-width: 500px;
        }

        .edit-event-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .edit-event-container form {
            display: flex;
            flex-direction: column;
        }

        .edit-event-container input, 
        .edit-event-container textarea, 
        .edit-event-container button {
            margin-bottom: 15px;
            padding: 10px;
            border: none;
            border-radius: 4px;
            font-size: 1em;
        }

        .edit-event-container input, 
        .edit-event-container textarea {
            background-color: #555555; /* Darker input background */
            color: #ffffff;
        }

        .edit-event-container button {
            background-color: #ffeb3b; /* Yellow button */
            color: #000000; /* Black text */
            cursor: pointer;
        }

        .edit-event-container button:hover {
            background-color: #fdd835; /* Darker yellow on hover */
        }

        .edit-event-container input:focus, 
        .edit-event-container textarea:focus {
            outline: none;
            background-color: #666666; /* Slightly lighter on focus */
        }

        .back-dashboard-button {
            background-color: #ffeb3b; /* Yellow button */
            color: #000000; /* Black text */
            cursor: pointer;
            margin-top: 15px; /* Additional margin for spacing */
        }

        .back-dashboard-button:hover {
            background-color: #fdd835; /* Darker yellow on hover */
        }
    </style>
</head>
<body>
    <div class="edit-event-container">
        <h2>Edit Event</h2>
        <form method="POST" action="edit_event.php?event_id=<?php echo $eventId; ?>">
            <input type="text" name="event_name" value="<?php echo htmlspecialchars($event['event_name']); ?>" placeholder="Event Name" required>
            <input type="date" name="event_date" value="<?php echo htmlspecialchars($event['event_date']); ?>" required>
            <input type="time" name="event_time" value="<?php echo htmlspecialchars($event['event_time']); ?>" required>
            <input type="text" name="event_location" value="<?php echo htmlspecialchars($event['event_location']); ?>" placeholder="Location" required>
            <textarea name="event_notes" placeholder="Special Notes" rows="4"><?php echo htmlspecialchars($event['event_notes']); ?></textarea>
            <button type="submit">Update Event</button>
        </form>
        <form action="dashboard.php" method="get">
            <button type="submit" class="back-dashboard-button">Back to Dashboard</button>
        </form>
    </div>
</body>
</html>
