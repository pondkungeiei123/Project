<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'])) {
    $userId = $_POST['user_id'];

    // ลบข้อมูลผู้ใช้
    $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $userId);

    if ($stmt->execute()) {
        // ทำการ redirect ไปที่ index.php หลังจากลบข้อมูลสำเร็จ
        header("Location: list_hs.php");
        exit();
    } else {
        echo "<p>Failed to delete user</p>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<p>Invalid request</p>";
}
?>
