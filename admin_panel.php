<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "assignment";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $service_name = trim($_POST['service_name']);
    $service_price = trim($_POST['service_price']);

    // Validate inputs
    if (empty($service_name) || empty($service_price)) {
        die("Error: Please fill in all fields.");
    }

    if (!is_numeric($service_price) || $service_price < 0) {
        die("Error: Invalid price. It must be a positive number.");
    }

    // Secure the SQL query using prepared statements
    $stmt = $conn->prepare("INSERT INTO adminservices (name, price) VALUES (?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("sd", $service_name, $service_price);

    if ($stmt->execute()) {
        echo "<script>
                alert('Service added successfully!');
                window.location.href = 'admin_panel.php';
              </script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
