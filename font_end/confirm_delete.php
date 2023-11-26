<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $userId = $_GET['id'];

    // ดึงข้อมูลผู้ใช้จากฐานข้อมูล
    $stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    // ตรวจสอบว่ามีข้อมูลหรือไม่
    if ($result->num_rows > 0) {
        $userData = $result->fetch_assoc();
    ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Delete User</title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        </head>

        <body>

            <div class="container">
                <h2>Delete User</h2>

                <form action="deleteProcess.php" method="POST">
                    <input type="hidden" name="user_id" value="<?= $userData['user_id']; ?>">
                    <p>คุณต้องการลบผู้ใช้นี้: <?= $userData['user_name'] . ' ' . $userData['user_lastname']; ?> ใช่หรือไม่?</p>
                    <button type="submit" class="btn btn-danger">ลบ</button>
                    <a href="index.php" class="btn btn-secondary">ยกเลิก</a>
                </form>

            </div>

        </body>

        </html>
    <?php
    } else {
        echo "<p>User not found</p>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<p>Invalid request</p>";
}
?>
