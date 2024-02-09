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
        <h2>เเก้ไขช่างตัดผม</h2>

        <?php
        // ตรวจสอบว่ามีพารามิเตอร์ id ที่ถูกส่งมาหรือไม่
        if (isset($_GET['id'])) {
            $userId = $_GET['id'];

            require_once '../config.php';

            // ดึงข้อมูลผู้ใช้จากฐานข้อมูล
            $stmt = $conn->prepare("SELECT * FROM user_table WHERE user_id = ?");
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $result = $stmt->get_result();

            // ตรวจสอบว่ามีข้อมูลหรือไม่
            if ($result->num_rows > 0) {
                $userData = $result->fetch_assoc();
        ?>
                <form action="../black_end/hs/updateProcess.php" method="POST">
                    <input type="hidden" name="user_id" value="<?= $userData['user_id']; ?>">
                    <div class="row">
                        <div class=" col-md-6 ">
                            <div class="form-group">
                                <label for="user_name">ชื่อ:</label>
                                <input type="text" class="form-control" name="user_name" value="<?= $userData['user_name']; ?>" required disabled>
                            </div>
                        </div>
                        <div class=" col-md-6 ">
                            <div class="form-group">
                                <label for="user_lastname">นามสกุล:</label>
                                <input type="text" class="form-control" name="user_lastname" value="<?= $userData['user_lastname']; ?>" required disabled>
                            </div>
                        </div>
                        <div class=" col-md-6 ">
                            <div class="form-group">
                                <label for="user_email">Email:</label>
                                <input type="email" class="form-control" name="user_email" value="<?= $userData['user_email']; ?>" required disabled>
                            </div>
                        </div>
                        <div class=" col-md-6 ">
                            <div class="form-group">
                                <label for="user_password">Password:</label>
                                <input type="password" class="form-control" name="user_password" required disabled>
                            </div>
                        </div>
                        <div class=" col-md-6 ">
                            <div class="form-group">
                                <label for="user_gender">เพศ:</label>
                                <select class="form-control" name="user_gender" required>
                                    <option value="male" <?= ($userData['user_gender'] === 'male') ? 'selected' : ''; ?>>ชาย</option>
                                    <option value="female" <?= ($userData['user_gender'] === 'female') ? 'selected' : ''; ?>>หญิง</option>
                                </select>
                            </div>
                        </div>
                        <div class=" col-md-6 ">
                            <div class="form-group">
                                <label for="user_age">อายุ:</label>
                                <input type="number" class="form-control" name="user_age" value="<?= $userData['user_age']; ?>" required>
                            </div>
                        </div>
                        <div class=" col-md-6 ">
                            <div class="form-group">
                                <label for="user_phone">เบอร์โทรศัพท์:</label>
                                <input type="phone" class="form-control" name="user_phone" value="<?= $userData['user_phone']; ?>" required>
                            </div>
                        </div>
                        <div class=" col-md-6 ">
                            <div class="form-group">
                                <label for="user_idcard">หมายเลขบัตรประชาชน:</label>
                                <input type="number" class="form-control" name="user_idcard" value="<?= $userData['user_idcard']; ?>" required>
                            </div>
                        </div>
                        
                        <div class=" col-md-5 ">
                            <div class="form-group">
                                <label for="user_birthdate">วัน-เดือน-ปีเกิด:</label>
                                <input type="date" class="form-control" id="user_birthdate" name="user_birthdate" required>
                            </div>
                        </div>
                        <div class=" col-md-7 ">
                            <div class="form-group">
                                <label for="user_address">ที่อยู่:</label>
                                <textarea class="form-control" name="user_address" rows="3" required><?= $userData['user_address']; ?></textarea>
                            </div>
                        </div>

                        <div class=" col-md-6 ">
                            <div class="form-group">
                                <label for="user_nationality">สัญชาติ:</label>
                                <input type="nationality" class="form-control" name="user_nationality	" value="<?= $userData['user_nationality']; ?>" required disabled>
                            </div>
                        </div>
                        <div class=" col-md-6 ">
                            <div class="form-group">
                                <label for="user_religion">ศาสนา:</label>
                                <input type="religion" class="form-control" name="user_religion" value="<?= $userData['user_religion']; ?>" required disabled>
                            </div>
                        </div>
                        <div class=" col-md-12 ">
                            <div class="form-group">
                                <label for='user_Certificate'>ใบเซอร์:</label>
                                <img src='../asset/Certificate/$cer' style='width:400px;heigh:400px;'>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">ยืนยันการเเก้ไข</button>
                    </div>
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