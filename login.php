<?php
session_start();
$servername = "localhost"; // Update if needed
$username = "root"; // Update based on your database
$password = ""; // Update based on your database
$dbname = "assignment"; // Update based on your database

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hardcoded admin credentials
    $admin_email = 'admin@gmail.com';
    $admin_password = 'admin';

    // Check if the entered credentials match the admin credentials
    if ($email === $admin_email && $password === $admin_password) {
        // Set session variables for admin
        $_SESSION['user'] = 'Administrator';

        // Redirect to the admin page
        echo "<script>
                alert('Admin login successful! Redirecting to admin dashboard...');
                window.location.href = 'admin_panel.php'; 
              </script>";
        exit();
    }

    // Query to check if the user exists in the database
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Set session variables for regular user
            $_SESSION['user'] = $row['name'];

            // Redirect to the user dashboard page
            echo "<script>
                    alert('Login successful! Redirecting to dashboard...');
                    window.location.href = 'book_service.html'; 
                  </script>";
            exit();
        } else {
            echo "<script>alert('Incorrect password!'); window.location.href = 'index.html';</script>";
        }
    } else {
        echo "<script>alert('User not found! Please register.'); window.location.href = 'index.html';</script>";
    }
}

$conn->close();
?>
