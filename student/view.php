<?php
session_start();
include_once '../config.php';
include_once '../function/profile_shows.php';
include_once '../function/tellmepage_std.php';
if (!isset($_SESSION['login'])) {
    $_SESSION['err_msg'] = '<div class="alert alert-danger">กรุณาเข้าสู่ระบบก่อนดำเนินการต่อ</div>';
    header('Location: ../../');
}
if ($_SESSION['authen_type'] == 'admin' || $_SESSION['authen_type'] == 'nurse') {
    header("Location: ../");
}
// Filter the data
if(isset($_GET['filter'])) {
    $title = tellMetoLocationOfTopic($_GET['filter']);
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
                <a href="/">< ย้อนกลับ</a>
                <center>
                <h3>ประวัติการ<?php if(isset($_GET['filter'])){echo $title[0];}else{echo "ใช้บริการ";}?></h3><hr>
                </center>
                <form action="/student/view.php" method="get" id="submit_menu">
                    <p class="text-end">คัดกรองจาก: 
                    <select id="menu_filter" name="filter">
                        <option>กรุณาเลือก</option>
                        <option value="1">การขอนอน</option>
                        <option value="2">การขอยา</option>
                    </select>
                    </p>
                </form>
                <?php if(!isset($_GET['filter'])){ ?>
                    <center><h5>** โปรดเลือกหัวข้อที่ต้องการหา **</h5></center>
                <?php }else{?>
                <?php if($_GET['filter'] == '1'){?>
                    <!-- การขอนอน Box -->
                    <?php 
                        $id_std = $_SESSION['id_std'];
                        $cmd2 = "SELECT * FROM treatment WHERE id_std = '$id_std' AND type_service = 'ขอนอนพัก' ORDER BY timestamp DESC";
                        $result = mysqli_query($conn,$cmd2);
                        if(mysqli_num_rows($result) < 1){
                            echo '<h5 class="text-center">** ไม่พบข้อมูลในระบบ **</h5>';
                        }else{
                            $round = 1;
                    ?>
                    <table class="table table-hover table-fluid">
                    <thead>
                        <tr>
                        <th scope="col">No.</th>
                        <th scope="col">เหตุผลการขอพัก</th>
                        <th scope="col">คาบเริ่มพัก</th>
                        <th scope="col">คาบที่ออก</th>
                        <th scope="col">ยาที่มอบให้</th>
                        <th scope="col">สถานะ</th>
                        <th scope="col">วันที่</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        while($rows = mysqli_fetch_assoc($result)){
                    ?>
                        <tr>
                        <th scope="row"><?php echo $round;$round++;?></th>
                        <td><?php echo substr($rows['reason'],0,45)."...";?></td>
                        <td><?php echo $rows['pauseperiod_st'];?></td>
                        <td><?php echo $rows['pauseperiod_nd'];?></td>
                        <td><?php echo substr($rows['drug_send'],0,45).'...';?></td>
                        <td><?php echo substr($rows['status'],0,19);?></td>
                        <td><?php echo substr($rows['timestamp'],0,19);?></td>
                        </tr>
                    <?php
                        }}
                    ?>
                    </tbody>
                    </table>
                <?php }else if($_GET['filter'] == '2'){?>
                    <!-- การขอยา Box -->
                    <?php 
                        $id_std = $_SESSION['id_std'];
                        $cmd2 = "SELECT * FROM treatment WHERE id_std = '$id_std' AND type_service = 'ขอยา' ORDER BY timestamp DESC";
                        $result = mysqli_query($conn,$cmd2);
                        if(mysqli_num_rows($result) < 1){
                            echo '<h5 class="text-center">** ไม่พบข้อมูลในระบบ **</h5>';
                        }else{
                            $round = 1;
                    ?>
                    <table class="table table-hover table-fluid">
                    <thead>
                        <tr>
                        <th scope="col">No.</th>
                        <th scope="col">เหตุผลการขอยา</th>
                        <th scope="col">ยาที่ต้องการเพิ่มเติม</th>
                        <th scope="col">ยาที่มอบให้</th>
                        <th scope="col">สถานะ</th>
                        <th scope="col">วันที่</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        while($rows = mysqli_fetch_assoc($result)){
                    ?>
                        <tr>
                        <th scope="row"><?php echo $round;$round++;?></th>
                        <td><?php echo substr($rows['reason'],0,45)."...";?></td>
                        <td><?php echo substr($rows['drug_note'],0,45)."...";?></td>
                        <td><?php echo substr($rows['drug_send'],0,45).'...';?></td>
                        <td><?php echo substr($rows['status'],0,19);?></td>
                        <td><?php echo substr($rows['timestamp'],0,19);?></td>
                        </tr>
                    <?php
                        }}
                    ?>
                    </tbody>
                    </table>
                <?php }else{
                    echo $title[1];
                    echo '<meta http-equiv="refresh" content="5; url='.$title[2].'">';
                }
            }?>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('#menu_filter').on('input',function(){
                $('#submit_menu').submit();
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