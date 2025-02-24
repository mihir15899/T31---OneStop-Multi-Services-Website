<?php

// Include the database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "assignment"; // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capture the form data
    $service_name = $_POST['service_name'];
    $service_price = $_POST['service_price'];

    // Validate and sanitize inputs (optional but recommended)
    $service_name = mysqli_real_escape_string($conn, $service_name);
    $service_price = mysqli_real_escape_string($conn, $service_price);

    // Prepare SQL statement to insert the service
    $sql = "INSERT INTO adminservices (name, price) VALUES ('$service_name', '$service_price')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "Service added successfully!";
        // Optionally, redirect to the admin panel or reset the form
        header("Location: admin_panel.php"); // Redirect back to admin panel
        exit();
    } else {
        echo "Error: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>






