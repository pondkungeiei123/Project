<?php
session_start();

// Include your database connection file
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    // Perform validation and authentication here (e.g., check against a database)

    // Example: Assuming you have a 'users' table with columns 'user_email' and 'user_password'
    $stmt = $conn->prepare("SELECT * FROM users WHERE user_email = ? AND user_password = ?");
    $stmt->bind_param("ss", $user_email, $user_password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Login successful
        $_SESSION['user_email'] = $user_email;
        header('Location: index.php'); // Redirect to the dashboard or any other page
        exit();
    } else {
        // Login failed
        header('Location: login.php'); // Redirect back to the login page
        exit();
    }
} else {
    // Invalid request method
    header('Location: login.php');
    exit();
}
?>
 