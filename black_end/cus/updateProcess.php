<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cusId = $_POST['cus_id'];
    $cusName = $_POST['cus_name'];
    $cusLastname = $_POST['cus_lastname'];
    $cusEmail = $_POST['cus_email'];
    $cusPassword = $_POST['cus_password'];
    $cusGender = $_POST['cus_gender'];
    $cusAddress = $_POST['cus_address'];
    $cusTel = $_POST['cus_tel'];
    $cusAge = $_POST['cus_age'];

    // ตรวจสอบว่ามีการอัปเดตข้อมูลในฐานข้อมูลหรือไม่
    $stmt = $conn->prepare("UPDATE customer SET cus_name = ?, cus_lastname = ?, cus_email = ?, cus_password = ?, cus_gender = ?, cus_address = ?, cus_tel = ?, cus_age = ? WHERE cus_id = ?");
    $stmt->bind_param("ssssssssi", $cusName, $cusLastname, $cusEmail, $cusPassword, $cusGender, $cusAddress, $cusTel, $cusAge, $cusId);

    if ($stmt->execute()) {
        // ทำการ redirect ไปที่ index.php หลังจากอัปเดตข้อมูลสำเร็จ
        header("Location: ../../font_end/list_cus.php");
        exit();
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update cus']);
    }

    $stmt->close();
    $conn->close();
} else {
    // ถ้าไม่ใช่เมธอด POST ก็ไม่ต้องทำอะไร
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
