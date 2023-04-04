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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
    <script src="https://kit.fontawesome.com/7b30317d32.js" crossorigin="anonymous"></script>
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
    <?php include_once('components/profile_box.php'); ?>
    <div class="container-sm my-2">
        <div class="card">
            <div class="card-body">
                <center>
                <h3 class="mb-3">โปรดเลือกเมนูที่ท่านต้องการ</h3><hr>
                <div class="row">
                    <div class="btn-group">
                        <a href="add_data.php#drug" class="btn btn-primary p-3">
                            <i class="fa-solid fa-pills"></i><br>ขอยา
                        </a>
                        <a href="add_data.php#sleep" class="btn btn-secondary p-3">
                            <i class="fa-solid fa-bed"></i><br>ขอเข้าพัก
                        </a>
                        <a href="view.php" class="btn btn-info p-3">
                            <i class="fa-sharp fa-solid fa-magnifying-glass"></i><br>เรียกดูประวัติการได้รับบริการ
                        </a>
                    </div>
                </div>
                </center>
            </div>
        </div>
    </div>
    <?php 
        if(isset($_SESSION['changePass'])){
            echo $_SESSION['changePass'];
            unset($_SESSION['changePass']);
        }
        if(isset($_SESSION['alert'])){
            echo $_SESSION['alert'];
            unset($_SESSION['alert']);
        }
    ?>
    <script>
        window.addEventListener('load', function() {
            document.querySelector('body').classList.add("loaded")
        });
    </script>
</body>

</html>