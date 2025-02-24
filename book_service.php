<?php
// Include the database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "assignment"; // replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// // Check if the user is logged in
// if (!isset($_SESSION['user_id'])) {
//     echo "You must be logged in to book a service.";
//     exit;
// }

// Get the data from the form
$service_id = $_POST['service_id'];
$time_slot = $_POST['time_slot'];
$user_id = 1;
// $_SESSION['user_id']; // Get the logged-in user's ID

// Prepare SQL statement to insert the booking into the database
$sql = "INSERT INTO bookings (user_id, service_id, time_slot) VALUES (?, ?, ?)";

// Prepare the statement
$stmt = $conn->prepare($sql);

// Bind the parameters
$stmt->bind_param("iis", $user_id, $service_id, $time_slot);

// Execute the query
if ($stmt->execute()) {
    // Booking confirmed
    echo "Booking confirmed! Your appointment is set for: " . $time_slot;
    echo "<br><a href='book_service.html'>Go to My Bookings</a>";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
