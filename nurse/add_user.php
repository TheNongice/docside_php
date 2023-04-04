<?php
include_once '../api/crud/nurse/show_case.php';
session_start();
if (!isset($_SESSION['login'])) {
    $_SESSION['err_msg'] = '<div class="alert alert-danger">กรุณาเข้าสู่ระบบก่อนดำเนินการต่อ</div>';
    header('Location: /');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>:: หมอเคียงคุณ - คุณครูห้องพยาบาล ::</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/7b30317d32.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script>
    <style>
        body {
            background-color: #7B8FA1;
        }
    </style>
</head>

<body>
    <?php include_once 'components/navbar.php'; ?>
    <div class="container-fluid mb-2">
        <div class="container-sm">
            <div class="card">
                <div class="card-body">
                    <center>
                        <h2>เพิ่มข้อมูลนักเรียน</h2>
                    </center>
                    <hr>
                    <form method="POST" action="/api/crud/add_student_1b1.php">
                        <div class="mb-3">
                            <label for="id_std" class="form-label"><i class="fas fa-user"></i> รหัสประจำตัวนักเรียน</label>
                            <input name="id_std" class="form-control" id="id_std" aria-describedby="id_std">
                            <div id="id_std" class="form-text">ไม่สามารถเปลี่ยนแปลงในภายหลัง การเปลี่ยนต้องแจ้งผู้ดูแลระบบ</div>
                        </div>
                        <div class="mb-3">
                            <label for="user" class="form-label"><i class="fas fa-user-shield"></i> ชื่อที่ใช้ในการเข้าสู่ระบบ</label>
                            <input name="user_std" class="form-control" id="user" aria-describedby="user">
                            <div id="user" class="form-text">สามารถใช้ชื่ออื่นได้ แต่หากไม่กรอกจะยึดเลขประจำตัวเป็นหลัก</div>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label"><i class="fas fa-file-signature"></i> ชื่อ-สกุล</label>
                            <input name="name" class="form-control" id="name">
                        </div>
                        <div class="mb-3">
                            <label for="classroom" class="form-label"><i class="fas fa-users-class"></i> ชั้นที่ศึกษา</label>
                            <input name="classroom" id="classroom" class="form-control">
                            <div id="user" class="form-text">กรอกในรูปแบบดังนี้ เช่น ม.5/5 กรอก 5/5</div>
                        </div>                         
                        <div class="mb-3">
                            <label for="sex" class="form-label"><i class="fas fa-genderless"></i> เพศ</label>
                            <select name="sex" id="sex" class="form-control">
                                <option value="ชาย">ชาย</option>
                                <option value="หญิง">หญิง</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="birthday" class="form-label"><i class="fas fa-calendar-week"></i> วัน/เดือน/ปี เกิด</label>
                            <input type="date" name="birthday" id="birthday" class="form-control">
                        </div>                                                                     
                        <div class="mb-3">
                            <label for="weight" class="form-label"><i class="fas fa-weight"></i> น้ำหนัก (ก.ก.)</label>
                            <input name="weight" class="form-control" id="weight" inputmode="numberic" type="number">
                        </div>
                        <div class="mb-3">
                            <label for="height" class="form-label"><i class="fas fa-weight"></i> ส่วนสูง (ซ.ม.)</label>
                            <input name="height" class="form-control" id="height" inputmode="numberic" type="number">
                        </div>
                        <div class="mb-3">
                            <label for="allegery" class="form-label"><i class="fas fa-soup"></i> อาหาร/ยาที่แพ้</label>
                            <textarea name="allegery" class="form-control" id="allegery"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="disease" class="form-label"><i class="fas fa-viruses"></i> โรคประจำตัว</label>
                            <textarea name="disease" class="form-control" id="disease"></textarea>
                        </div>                                                
                        <center><button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i> เพิ่มข้อมูลนักเรียน</button></center>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#id_std').change(function(){
                $('#user').attr('value', $('#id_std').val());
            })
        })
    </script>
    <?php
    if (isset($_SESSION['changePass'])) {
        echo $_SESSION['changePass'];
        unset($_SESSION['changePass']);
    }
    if (isset($_SESSION['alert'])) {
        echo $_SESSION['alert'];
        unset($_SESSION['alert']);
    }
    ?>
</body>

</html>