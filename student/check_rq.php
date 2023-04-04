<?php
session_start();
include_once('../config.php');
if (!isset($_SESSION['login'])) {
    $_SESSION['alert'] = '<div class="alert alert-danger">กรุณาเข้าสู่ระบบก่อนดำเนินการต่อ</div>';
    header('Location: ../../');;
}
if ($_SESSION['authen_type'] == 'admin' || $_SESSION['authen_type'] == 'nurse') {
    header("Location: ../");
}
$id_std = $_SESSION['id_std'];
$cmd = "SELECT * FROM `onlinerequest` WHERE `id_std` = '$id_std' ORDER BY timestamp DESC";
$rounds = 1;
$result = mysqli_query($conn, $cmd);
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หมอเคียงคุณ - <?php echo $_SESSION['name']; ?></title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <meta name="robots" content="noindex,nofollow">
    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/7b30317d32.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../fonts.css">
    <script src="/js/sweetalert2.all.min.js"></script>
    <script src="/js/jquery.min.js"></script>
</head>

<body>
    <noscript>
        <meta http-equiv="refresh" content="0; url=/block_js.html">
    </noscript>
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
                    <h3 class="mb-3">ประวัติขอเข้ารักษา</h3>
                </center>
                <a href="/">
                    < ย้อนกลับ</a>
                        <hr>
                        <?php if(mysqli_num_rows($result) > 0){?>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">ลำดับ</th>
                                    <th scope="col">ประเภท</th>
                                    <th scope="col">เหตุผล</th>
                                    <th scope="col">วัน/เวลา</th>
                                    <th scope="col">สถานะ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($rows = mysqli_fetch_assoc($result)){?>
                                <tr>
                                    <th scope="row"><?php echo $rounds;$rounds++; ?></th>
                                    <td><?php echo $rows['typeservice']?></td>
                                    <td><?php echo substr($rows['reason'],0,45)."..";?></td>
                                    <td><?php echo substr($rows['timestamp'],0,19)?></td>
                                    <?php 
                                     $status = $rows['status'];
                                     if($status == 'รอการอนุญาต'){
                                        echo '<td>'.$status.'</td>';
                                     }else if($status == 'ปฏิเสธ'){
                                        echo '<td id="deny">'.$status.'</td>';
                                     }else if($status == 'อนุญาต'){
                                        echo '<td id="allow">'.$status.'</td>';
                                     }
                                    ?>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    <?php }else{?>
                        <h5 class="text-center">ไม่พบประวัติการขอ</h5>
                    <?php }?>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('load', function() {
            document.querySelector('body').classList.add("loaded")
        });
    </script>
    <style>
        #deny{
            color: red;
            font-weight: bold;
        }
        #allow{
            color: green;
            font-weight: bold;
        }
    </style>
</body>

</html>