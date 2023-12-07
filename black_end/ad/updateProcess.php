<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $adId = $_POST['ad_id'];
    $adName = $_POST['ad_name'];
    $adLastname = $_POST['ad_lastname'];
    $adEmail = $_POST['ad_email'];
    $adPassword = $_POST['ad_password'];
    $adGender = $_POST['ad_gender'];

    // ตรวจสอบว่ามีการอัปเดตข้อมูลในฐานข้อมูลหรือไม่
    $stmt = $conn->prepare("UPDATE admin SET ad_name = ?, ad_lastname = ?, ad_email = ?, ad_password = ?, ad_gender = ? WHERE ad_id = ?");
    $stmt->bind_param("sssssi", $adName, $adLastname, $adEmail, $adPassword, $adGender, $adId);

    if ($stmt->execute()) {
        // ทำการ redirect ไปที่ index.php หลังจากอัปเดตข้อมูลสำเร็จ
        header("Location: ../../font_end/list_ad.php");
        exit();
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update ad']);
    }

    $stmt->close();
    $conn->close();
} else {
    // ถ้าไม่ใช่เมธอด POST ก็ไม่ต้องทำอะไร
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
