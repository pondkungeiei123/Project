<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <div class="container">
        <h2>Edit User</h2>

        <?php
        // ตรวจสอบว่ามีพารามิเตอร์ id ที่ถูกส่งมาหรือไม่
        if (isset($_GET['id'])) {
            $userId = $_GET['id'];

            require_once '../config.php';

            // ดึงข้อมูลผู้ใช้จากฐานข้อมูล
            $stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $result = $stmt->get_result();

            // ตรวจสอบว่ามีข้อมูลหรือไม่
            if ($result->num_rows > 0) {
                $userData = $result->fetch_assoc();
        ?>
                <form action="../black_end/hs/updateProcess.php" method="POST">
                    <input type="hidden" name="user_id" value="<?= $userData['user_id']; ?>">
                    <div class="form-group">
                        <label for="user_name">Name:</label>
                        <input type="text" class="form-control" name="user_name" value="<?= $userData['user_name']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="user_lastname">Lastname:</label>
                        <input type="text" class="form-control" name="user_lastname" value="<?= $userData['user_lastname']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="user_email">Email:</label>
                        <input type="email" class="form-control" name="user_email" value="<?= $userData['user_email']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="hs_password">Password:</label>
                        <input type="password" class="form-control" name="hs_password" required>
                    </div>
                    <div class="form-group">
                        <label for="user_gender">Gender:</label>
                        <select class="form-control" name="user_gender" required>
                            <option value="male" <?= ($userData['user_gender'] === 'male') ? 'selected' : ''; ?>>Male</option>
                            <option value="female" <?= ($userData['user_gender'] === 'female') ? 'selected' : ''; ?>>Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="user_address">Address:</label>
                        <textarea class="form-control" name="user_address" rows="3" required><?= $userData['user_address']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="user_tel">Telephone:</label>
                        <input type="tel" class="form-control" name="user_tel" value="<?= $userData['user_tel']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="user_age">Age:</label>
                        <input type="number" class="form-control" name="user_age" value="<?= $userData['user_age']; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
        <?php
            } else {
                echo "<p>User not found</p>";
            }

            // ปิดการเชื่อมต่อ
            $stmt->close();
            $conn->close();
        } else {
            echo "<p>Invalid user ID</p>";
        }
        ?>

    </div>

</body>

</html>