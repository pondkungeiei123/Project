<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-Requested-With, content-type, access-control-allow-origin, access-control-allow-methods, access-control-allow-headers");

require "connect.php";

// Check connection
if (!$con) {
    die("Connection error: " . mysqli_connect_error());
}

// Ensure that the variables are defined with default values
$user_email = isset($_POST['email']) ? $_POST['email'] : '';
$user_password = isset($_POST['password']) ? $_POST['password'] : '';



$sql = "SELECT * FROM users WHERE user_email = '" . $user_email . "'";
$result = mysqli_query($con, $sql);

if ($result) {
    $resultObj = mysqli_fetch_assoc($result);
    if ($resultObj && password_verify($user_password,$resultObj['user_password'])) {
        echo json_encode(array(
            "result" => 1,
            "message" => "Success",
            "data" => array(
                'user_id' => $resultObj['user_id'],
            )
        ));
    } else {
        echo json_encode(array("result" => 0, "message" => "Error"));
    }
} else {
    // Error in the SQL query
    echo json_encode(['error' => mysqli_error($con)]);
}

// Stop execution after sending JSON response
exit();

