<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <!-- Add HTTPS for jQuery and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Add HTTPS for SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }

        main {
            flex: 1;
        }

        .sidebar {
            background-color: #f8f9fa;
            padding: 20px;
            height: 100%;
        }

        .nav-item {
            padding: 10px;
        }
    </style>
</head>

<body class="d-flex">

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">User Management</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addUserModal">
                        Add User
                    </button>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="list_ad.php">
                                รายชื่อพนักงาน
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="list_hs.php">
                                รายชื่อช่าง
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="list_cus.php">
                                รายชื่อช่างลูกค้า
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <h2> รายชื่อพนักงาน</h2> <!-- Add a title here -->
                <div class="container">
                    <div class="row">
                        <div class="col-md-12"> <br>
                            <h3> </h3>
                            <table class="table table-striped table-hover table-responsive table-bordered">
                                <thead>
                                    <tr>
                                        <th width="5%">ลำดับ</th>
                                        <th width="40%">ชื่อ</th>
                                        <th width="45%">นามสกุล</th>
                                        <th width="5%">แก้ไข</th>
                                        <th width="5%">ลบ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- ตรงนี้คือข้อมูลที่ถูกดึงมาแสดงในตาราง -->
                                    <?php
                                    require_once 'config.php';
                                    $stmt = $conn->prepare("SELECT * FROM users");
                                    $stmt->execute();
                                    $resultSet = $stmt->get_result();
                                    $data = $resultSet->fetch_all(MYSQLI_ASSOC);

                                    foreach ($data as $k) {
                                    ?>
                                        <tr>
                                            <td><?= $k['user_id']; ?></td>
                                            <td><?= $k['user_name']; ?></td>
                                            <td><?= $k['user_lastname']; ?></td>
                                            <td><a href="formEdit.php?id=<?= $k['user_id']; ?>" class="btn btn-warning btn-sm">แก้ไข</a></td>
                                            <td><a href="delete.php?id=<?= $k['user_id']; ?>" class="btn btn-danger btn-sm">ลบ</a></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>

                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Modal เพิ่มข้อมูลผู้ใช้ -->
    <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addUserForm" method="POST">
                        <div class="form-group">
                            <label for="user_name">Name:</label>
                            <input type="text" class="form-control" name="user_name" required>
                        </div>
                        <div class="form-group">
                            <label for="user_lastname">Lastname:</label>
                            <input type="text" class="form-control" name="user_lastname" required>
                        </div>
                        <div class="form-group">
                            <label for="user_email">Email:</label>
                            <input type="email" class="form-control" name="user_email" required>
                        </div>
                        <div class="form-group">
                            <label for="hs_password">Password:</label>
                            <input type="password" class="form-control" name="hs_password" required>
                        </div>
                        <div class="form-group">
                            <label for="user_gender">Gender:</label>
                            <select class="form-control" name="user_gender" required>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="user_address">Address:</label>
                            <textarea class="form-control" name="user_address" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="user_tel">Telephone:</label>
                            <input type="tel" class="form-control" name="user_tel" required>
                        </div>
                        <div class="form-group">
                            <label for="user_age">Age:</label>
                            <input type="number" class="form-control" name="user_age" required>
                        </div>
                        <!-- เพิ่มฟิลด์ใหม่ตามที่ต้องการ -->
                        <div class="form-group">
                            <label for="user_Certificate">Certificate:</label>
                            <input type="file" class="form-control" name="user_Certificate" accept="image/*">
                        </div>
                        <button type="button" class="btn btn-primary" onclick="submitForm()">Add User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>


    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Add the script tag to link to your external script file -->

    <!-- Add HTTPS for SweetAlert2 and promise-polyfill -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        function submitForm() {
            var formData = new FormData($('#addUserForm')[0]);

            $.ajax({
                method: 'POST',
                url: "http://localhost/test/connect.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function(result) {
                    console.log(result);
                    if (result.success === true) {
                        Swal.fire({
                            title: "Success",
                            text: "User added successfully",
                            icon: "success"
                        });
                        // $('#addUserModal').modal('hide');
                    } else {
                        Swal.fire({
                            title: "Error",
                            text: "Error: " + result.message,
                            icon: "error"
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Ajax request failed:", status, error);
                    console.log(xhr.responseText); // บันทึกการตอบสนองทั้งหมด
                }
            });
        }
    </script>

</body>

</html>