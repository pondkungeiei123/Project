<?php
// include config file
include '../config.php';

// ตรวจสอบการลงชื่อเข้าใช้งานและประมวลผลข้อมูลต่าง ๆ
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ตรวจสอบการลงชื่อเข้าใช้งาน
    $user_email = $_POST['email'];
    $password = $_POST['password'];

    // ค้นหาผู้ใช้ในฐานข้อมูล
    $sql = "SELECT * FROM users WHERE user_email = '$user_email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // พบผู้ใช้
        $row = $result->fetch_assoc();
        
        if ($row['status'] == 1) {
            // User status is confirmed
            if (password_verify($password, $row['user_password'])) {
                // รหัสผ่านถูกต้อง
                // ทำอย่างอื่นตามที่ต้องการ เช่น ตั้ง session, ส่งไปยังหน้าหลัก, etc.
                session_start();
                $_SESSION['user_email'] = $row['user_email'];
                $_SESSION['user_password'] = $row['user_password'];
                header('Location: index.php'); // ส่งไปยังหน้าหลัก
                exit;
            } else {
                // รหัสผ่านไม่ถูกต้อง
                displayError('รหัสผ่านไม่ถูกต้อง');
            }
        } else {
            // User status is not confirmed
            displayError('กรุณายืนยันสถานะก่อนใช้งาน');
        }
    } else {
        // ไม่พบผู้ใช้
        displayError('ไม่พบผู้ใช้');
    }
}

function displayError($message) {
    echo '<script>
        Swal.fire({
            icon: "error",
            title: "' . $message . '",
            text: "กรุณาตรวจสอบข้อมูลและลองอีกครั้ง"
        }).then(function () {
            window.location.href = "login.php";
        });
    </script>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #d2b48c; /* Dark grayish-blue background color */
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            margin: auto;
        }

        .login-container h2 {
            text-align: center;
        }

        .login-form {
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        .form-group button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        /* เพิ่มสไตล์สำหรับปุ่มสมัครสมาชิก */
        .resume-button {
            background-color: #3498db;
            color: #fff;
            text-align: center;
            padding: 5px;
            cursor: pointer;
            border: none;
            border-radius: 4px;
            width: 100%;
            margin-top: 10px; /* เพิ่มขึ้นมาหน่อย */
        }
    </style>
</head>
<body>
<? 


?>
    <div class="login-container">
        <h2>Login</h2>
        <form class="login-form" action="" method="post">
            <div class="form-group">
                <label for="email">email:</label>
                <input type="text" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <button type="submit">Login</button>
            </div>
            
            <a href="create_resume.php" class="resume-button">สร้าง Resume</a>
        </form>
    </div>

</body>
</html>
