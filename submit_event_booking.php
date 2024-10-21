<?php
// submit_event_booking.php

// Database connection parameters
$servername = "localhost"; // Change if necessary
$username = "root"; // Database username
$password = "student"; // Database password
$dbname = "hotelreservation"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$eventName = $_POST['eventName'];
$eventDate = $_POST['eventDate'];
$eventTime = $_POST['eventTime'];
$eventGuests = $_POST['eventGuests'];
$eventDetails = $_POST['eventDetails'];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO event_bookings (event_name, event_date, event_time, number_of_guests, additional_details) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssis", $eventName, $eventDate, $eventTime, $eventGuests, $eventDetails);

// Execute the statement
if ($stmt->execute()) {
    echo "Name: " . htmlspecialchars($eventName) . "<br>";
    echo "Date: " . htmlspecialchars($eventDate) . "<br>";
    echo "Time: " . htmlspecialchars($eventTime) . "<br>";
    echo "Number of Guests: " . htmlspecialchars($eventGuests) . "<br>";
    if (!empty($eventDetails)) {
        echo "Additional Details: " . htmlspecialchars($eventDetails) . "<br>";
    }
} else {
    echo "Error: " . $stmt->error;
}

// Close the connection
$stmt->close();
$conn->close();
?>
