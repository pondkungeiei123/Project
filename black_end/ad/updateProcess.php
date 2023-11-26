<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['user_id'];
    $userName = $_POST['user_name'];
    $userLastname = $_POST['user_lastname'];
    $userEmail = $_POST['user_email'];
    $userPassword = $_POST['hs_password'];
    $userGender = $_POST['user_gender'];
    $userAddress = $_POST['user_address'];
    $userTel = $_POST['user_tel'];
    $userAge = $_POST['user_age'];

    // ตรวจสอบว่ามีการอัปเดตข้อมูลในฐานข้อมูลหรือไม่
    $stmt = $conn->prepare("UPDATE users SET user_name = ?, user_lastname = ?, user_email = ?, hs_password = ?, user_gender = ?, user_address = ?, user_tel = ?, user_age = ? WHERE user_id = ?");
    $stmt->bind_param("ssssssssi", $userName, $userLastname, $userEmail, $userPassword, $userGender, $userAddress, $userTel, $userAge, $userId);

    if ($stmt->execute()) {
        // ทำการ redirect ไปที่ index.php หลังจากอัปเดตข้อมูลสำเร็จ
        header("Location: index.php");
        exit();
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update user']);
    }

    $stmt->close();
    $conn->close();
} else {
    // ถ้าไม่ใช่เมธอด POST ก็ไม่ต้องทำอะไร
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
