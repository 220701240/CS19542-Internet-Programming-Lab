<?php
// Database connection
$servername = "localhost"; // Your database server
$username = "root"; // Your database username
$password = "student"; // Your database password
$dbname = "hotelreservation"; // Your database name

 // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the data from POST
$spaName = $_POST['spaName'];
$spaDate = $_POST['spaDate'];
$spaTime = $_POST['spaTime'];
$spaGuests = $_POST['spaGuests'];

// Prepare SQL to insert the booking
$sql = "INSERT INTO spa_bookings (name, date, time, guests) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssi", $spaName, $spaDate, $spaTime, $spaGuests);

if ($stmt->execute()) {
    // Booking successful
    echo "Booking registered successfully for " . $spaName . " on " . $spaDate . " at " . $spaTime;
} else {
    // Error inserting the booking
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
