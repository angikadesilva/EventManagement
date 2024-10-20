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
    <title>Event Details</title>
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

.details-container {
    background-color: #333333; /* Slightly lighter than body */
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0px 0px 10px 2px rgba(0, 0, 0, 0.5);
    width: 80%;
    max-width: 600px;
}

.details-container h2 {
    text-align: center;
    margin-bottom: 20px;
}

.details-container p {
    font-size: 1.2em;
    line-height: 1.5;
    margin-bottom: 10px;
}

.back-button {
    display: block;
    margin: 20px auto 0;
    padding: 10px 20px;
    background-color: #ffeb3b; /* Yellow background */
    color: #000000; /* Black text */
    border: none;
    border-radius: 4px;
    cursor: pointer;
    text-align: center;
    text-decoration: none;
    font-size: 1em;
}

.back-button:hover {
    background-color: #fdd835; /* Darker yellow on hover */
}

    </style>
</head>
<body>
    <div class="details-container">
        <h2>Event Details</h2>
        <?php if ($event): ?>
            <p><strong>Event Name:</strong> <?php echo htmlspecialchars($event['event_name']); ?></p>
            <p><strong>Date:</strong> <?php echo htmlspecialchars($event['event_date']); ?></p>
            <p><strong>Time:</strong> <?php echo htmlspecialchars($event['event_time']); ?></p>
            <p><strong>Location:</strong> <?php echo htmlspecialchars($event['event_location']); ?></p>
            <p><strong>Notes:</strong> <?php echo nl2br(htmlspecialchars($event['event_notes'])); ?></p>
        <?php else: ?>
            <p>No event details available.</p>
        <?php endif; ?>
        <a href="dashboard.php" class="back-button">Back to Dashboard</a>
    </div>
</body>
</html>
