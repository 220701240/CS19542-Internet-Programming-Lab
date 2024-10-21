<?php
// Database connection
$servername = "localhost"; // Your database server
$username = "root"; // Your database username
$password = "student"; // Your database password
$dbname = "hotelreservation"; // Your database name

// Create connection

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

// Prepare SQL to check if the date and time are already booked
$sql = "SELECT * FROM spa_bookings WHERE date = ? AND time = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $spaDate, $spaTime);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // If there's an existing booking, send error response
    echo json_encode(["status" => "error", "message" => "Sorry, this date and time is already fully booked."]);
} else {
    // No existing booking found
    echo json_encode(["status" => "success"]);
}

$stmt->close();
$conn->close();
?>

