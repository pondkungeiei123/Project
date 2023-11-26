<?php

ob_start();
?>
<!-- Your page-specific content -->
<h2> รายชื่อช่างตัดผม</h2> <!-- Add a title here -->
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
                    require_once '../config.php';
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
<!-- ... -->
<?php
$content = ob_get_clean();
include '../template/master.php';
?>