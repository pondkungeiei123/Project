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
    $ad_name = $_POST["ad_name"];
    $ad_lastname = $_POST["ad_lastname"];
    $ad_email = $_POST["ad_email"];
    $ad_password = password_hash($_POST["ad_password"], PASSWORD_DEFAULT); // Hash the password
    $ad_gender = $_POST["ad_gender"];
    
    // add additional fields as needed

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO admin (ad_name, ad_lastname, ad_email, ad_password, ad_gender) VALUES (?, ?, ?, ?, ?)");

    $stmt->bind_param("sssss", $ad_name, $ad_lastname, $ad_email, $ad_password, $ad_gender);


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
