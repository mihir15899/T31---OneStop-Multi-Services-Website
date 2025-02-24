<?php
$servername = "localhost"; // Change if needed
$username = "root"; // Change based on your database
$password = ""; // Change based on your database
$dbname = "assignment"; // Change based on your database

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Secure password storage

    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Registration successful! Redirecting to login...');
                window.location.href = 'index.html';
                setTimeout(function() { document.getElementById('loginForm').style.display = 'block'; 
                                         document.getElementById('registerForm').style.display = 'none'; 
                                       }, 100);
              </script>";
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
