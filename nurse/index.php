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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body{
            background-color: #7B8FA1;
        }
    </style>
</head>
<body>
    <?php include_once 'components/navbar.php'; ?>
    <div class="container-fluid">
        <div class="container-sm">
            <div class="card">
                <div class="card-body">
                    <center><h2>รายชื่อผู้รอเข้าใช้บริการ</h2></center><hr>
                    <div class="row">
                        <div class="col-sm">
                            <h5>10 คนล่าสุดที่ขอนอน</h5>
                            <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">เลขประจำตัว</th>
                                <th scope="col">คาบแรกเข้า</th>
                                <th scope="col">คาบท้ายออก</th>
                                <th scope="col">สถานะ</th>
                                <th scope="col">เวลา</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php showSleep($conn);?>
                            </tbody>
                            </table>
                        </div>
                        <div class="col-sm">
                            <h5>10 คนล่าสุดที่ขอยา</h5>
                            <div class="table-responsive">
                                <table class="table">
                                <thead>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">เลขประจำตัว</th>
                                    <th scope="col">ยาที่คาดไว้</th>
                                    <th scope="col">เหตุผล</th>
                                    <th scope="col">สถานะ</th>
                                    <th scope="col">เวลา</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php showDrug($conn);?>
                                </tbody>
                                </table>                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-3">
        <div class="container-sm">
            <div class="card">
                <div class="card-body">
                    <center><h2>จัดการข้อมูล</h2></center><hr>
                    <div class="row">
                        <a href="add_data.php" class="col-sm mx-2 my-1 btn btn-lg btn-success"><i class="fas fa-plus"></i></br>เพิ่มข้อมูลขอเข้าใช้บริการ</a>    
                    </div>
                    <div class="row">
                        <a href="#" onClick='alert("ใช้งานด้วยกันกับ Looker Studio")' class="col-sm mx-2 my-1 btn btn-lg btn-success"><i class="fas fa-chart-line"></i></br>แผนภูมิสรุปการเข้าใช้บริการ</a>    
                    </div>                                  
                    <div class="row">
                        <a href="daily_report.php" class="col-sm mx-2 my-1 btn btn-lg btn-primary"><i class="fas fa-flag-checkered"></i></br>รายงานผู้เข้าใช้ประจำวัน</a>
                        <a href="add_user.php" class="col-sm mx-2 my-1 btn btn-lg btn-primary"><i class="fas fa-user-plus"></i></br>เพิ่มข้อมูลนักเรียน</a>
                    </div>
                    <div class="row">
                        <a class="col-sm mx-2 my-1 btn btn-lg btn-primary disabled" role="button" aria-disabled="true"><i class="fas fa-list-alt"></i></br>เรียกข้อมูลนักเรียน</a>    
                        <a href="add_room.php" class="col-sm mx-2 my-1 btn btn-lg btn-primary"><i class="fas fa-hospital"></i></br>จัดการห้องพัก</a>
                    </div>
                </div>
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
</body>
</html>