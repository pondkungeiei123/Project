<?php
// Include your database connection file
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Perform validation and registration logic here (e.g., check for existing username)

    // Example: Assuming you have a 'users' table with columns 'username' and 'password'
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        // Registration successful
        header('Location: login.php'); // Redirect to the login page
        exit();
    } else {
        // Registration failed
        header('Location: register.php'); // Redirect back to the registration page
        exit();
    }
} else {
    // Invalid request method
    header('Location: register.php');
    exit();
}
?>
