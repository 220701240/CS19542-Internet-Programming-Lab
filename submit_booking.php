<?php
// submit_booking.php

// Database configuration
$host = 'localhost'; // Change if necessary
$dbName = 'hotelreservation'; // Change to your database name
$user = 'root'; // Change to your database username
$password = 'student'; // Change to your database password

// Create connection
$conn = new mysqli($host, $user, $password, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the JSON input
$data = json_decode(file_get_contents("php://input"), true);

// Prepare and bind the statement
$stmt = $conn->prepare("INSERT INTO dining_reservation (service, date, time, num_guests, table_Layout, diet_preferences) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $data['service'], $data['date'], $data['time'], $data['numGuests'], $data['tableLayout'], $data['dietPreferences']);

// Execute the statement and check for success
if ($stmt->execute()) {
    // Success response with user details
    echo json_encode([
        "status" => "success",
        "details" => [
            "service" => $data['service'],
            "date" => $data['date'],
            "time" => $data['time'],
            "numGuests" => $data['numGuests'],
            "tableLayout" => $data['tableLayout'],
            "dietPreferences" => $data['dietPreferences']
        ]
    ]);
} else {
    // Error response
    echo json_encode([
        "status" => "error",
        "message" => "Database error: " . $stmt->error
    ]);
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
