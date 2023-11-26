<?php
// connect.php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testdata2";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data is received
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process form data
    $user_name = $_POST["user_name"];
    $user_lastname = $_POST["user_lastname"];
    $user_email = $_POST["user_email"];
    $user_password = password_hash($_POST["user_password"], PASSWORD_DEFAULT); // Hash the password
    $user_gender = $_POST["user_gender"];
    $user_address = $_POST["user_address"];
    $user_tel = $_POST["user_tel"];
    $user_age = $_POST["user_age"];
    // Add additional fields as needed

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO users (user_name, user_lastname, user_email, user_password, user_gender, user_address, user_tel, user_age) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("sssssssi", $user_name, $user_lastname, $user_email, $user_password, $user_gender, $user_address, $user_tel, $user_age);

    // Execute the statement
    if ($stmt->execute()) {
        $response = array("success" => true);
    } else {
        $response = array("success" => false, "message" => $conn->error);
    }

    // Close statement
    $stmt->close();
} else {
    $response = array("success" => false, "message" => "Invalid request method");
}

// Close connection
$conn->close();

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
