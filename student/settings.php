<?php
include_once '../config.php';
include_once '../function/profile_shows.php';
session_start();
if (!isset($_SESSION['login'])) {
    $_SESSION['err_msg'] = '<div class="alert alert-danger">กรุณาเข้าสู่ระบบก่อนดำเนินการต่อ</div>';
    header('Location: ../../');;
}
if ($_SESSION['authen_type'] == 'admin' || $_SESSION['authen_type'] == 'nurse') {
    header("Location: ../admin");
}
?>
<!DOCTYPE html>
<html lang="th">

<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หมอเคียงคุณ - <?php echo $_SESSION['name']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="robots" content="noindex,nofollow">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/7b30317d32.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../fonts.css">
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <noscript><meta http-equiv="refresh" content="0; url=/block_js.html"></noscript>
    <div class="loader-wrapper">
        <div class="loader">
        </div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
    <?php include_once('components/navbar.php'); ?>
    <?php include_once('components/profile_box.php');?>
    <div class="container-sm">
        <div id="profiles" class="card my-2">
            <div class="card-header bg-dark text-white"><i class="fa-solid fa-gear"></i> เปลี่ยนแปลงประวัติสุขภาพ</div>
            <div class="card-body">
                <form action="/api/crud/changeProfile.php" method="POST" autocomplete="OFF">
                    <div class="mb-3">
                        <label for="id" class="form-label">เลขประจำตัว: <input required type="text" class="form-control-plaintext" id="id" name="id_std" aria-describedby="announce" value="<?php echo $_SESSION['id_std']; ?>" readonly></label>
                        <div id="announce" class="form-text">*เลขประจำตัวไม่สามารถเปลี่ยนแปลงได้</div>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">ชื่อ-สกุล: <input required type="text" class="form-control-plaintext" id="name" aria-describedby="announce" value="<?php echo $_SESSION['name']; ?>" readonly></label>
                        <div id="announce" class="form-text">*การเปลี่ยนชื่อ-สกุลต้องติดต่อคุณครูพยาบาล</div>
                    </div>
                    <div class="mb-3">
                        <label for="semester" class="form-label">ภาคเรียนที่:</label>
                        <input type="text" class="form-control-plaintext" id="semester" name="semester" value="<?php echo SEMESTER_SYS;?>" readonly>
                        <div id="announce" class="form-text">*คุณครู/ผู้ดูแลระบบจะเป็นผู้กำหนด</div>
                    </div>
                    <div class="mb-3">
                        <label for="year" class="form-label">ปีการศึกษา:</label>
                        <input type="text" class="form-control-plaintext" id="year" name="year" value="<?php echo YEAR_SYS?>" readonly>
                        <div id="announce" class="form-text">*คุณครู/ผู้ดูแลระบบจะเป็นผู้กำหนด</div>
                    </div>                 
                    <div class="mb-3">
                        <label for="weight" class="form-label">น้ำหนัก (ก.ก.):</label>
                        <input required type="text" class="form-control" id="weight" name="weight" value="<?php echo showWH($conn, $_SESSION['id_std'])[0];?>">
                    </div>
                    <div class="mb-3">
                        <label for="height" class="form-label">ส่วนสูง (ซ.ม.):</label>
                        <input required type="text" class="form-control" id="height" name="height" value="<?php echo showWH($conn, $_SESSION['id_std'])[1];?>">
                    </div>
                    <div class="mb-3">
                        <label for="paeya" class="form-label">ประวัติการแพ้ยา:</label>
                        <textarea class="form-control" id="paeya" name="allergy"><?php echo showAllergy($conn,$_SESSION["id_std"]);?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="disease" class="form-label">โรคประจำตัว:</label>
                        <textarea class="form-control" id="disease" name="disease"><?php echo showDisease($conn,$_SESSION["id_std"]);?></textarea>
                    </div>
                    <center><button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> บันทึกข้อมูล</button></center>
                </form>
            </div>
        </div>
    </div>
    <div class="container-sm">
        <div id="profiles" class="card my-3">
            <div class="card-header bg-primary text-white"><i class="fa-solid fa-gear"></i> การตั้งค่าบัญชี</div>
            <div class="card-body">
                <form method="POST" action="/api/authen/changepass_std.php" id="changePass">
                    <div class="mb-3">
                        <label for="pass" class="form-label">รหัสผ่านใหม่: </label>
                        <input required type="password" class="form-control" id="pass" name="pass" aria-describedby="announce">
                    </div>
                    <div class="mb-3">
                        <label for="confirmpass" class="form-label">ยืนยันรหัสผ่านใหม่: </label>
                        <input required type="password" class="form-control" id="confirmpass" name="confirmpass" aria-describedby="announce">
                    </div>
                    <center><a id="submit" role="button" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> บันทึกข้อมูล</a></center>
                </form>
            </div>
        </div>
    </div>  
    <script>
        $('document').ready(function() {
            $('#submit').click(function() {
                var pass = $('#pass').val();
                var confirmpass = $('#confirmpass').val();
                if(pass == '' || confirmpass == ''){
                    Swal.fire({
                        icon: 'error',
                        title: 'ข้อผิดพลาด',
                        text: 'กรุณากรอกรหัสผ่าน',
                        confirmButtonText: 'ตกลง'
                    })
                }else if(pass.length < 8 && confirmpass.length < 8){
                    Swal.fire({
                        icon: 'error',
                        title: 'ข้อผิดพลาด',
                        text: 'รหัสผ่านมีอย่างน้อย 8 ตัวอักษร',
                        confirmButtonText: 'ตกลง'
                    })
                }else if(pass == confirmpass){
                    $('#changePass').submit();
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'ข้อผิดพลาด',
                        text: 'รหัสผ่านทั้งสองช่องไม่ตรงกัน',
                        confirmButtonText: 'ตกลง'
                    })
                }
            })
        });
    </script>  
    <script>
        window.addEventListener('load', function() {
            document.querySelector('body').classList.add("loaded")
        });
    </script>
</body>

</html>