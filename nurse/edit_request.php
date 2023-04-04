<?php
    include_once '../api/crud/nurse/show_case.php';
    session_start();
    if (!isset($_SESSION['login'])) {
        $_SESSION['err_msg'] = '<div class="alert alert-danger">กรุณาเข้าสู่ระบบก่อนดำเนินการต่อ</div>';
        header('Location: /');
    }
    $id_ref = $_GET['id_ref'];
    $cmd = "SELECT treatment.*,student_info.firstname,student_info.lastname,student_info.classroom,student_info.birthday,student_info.sex,student_info.weight,student_info.height,student_info.allegery,student_info.disease FROM treatment INNER JOIN student_info ON treatment.id_std = student_info.id_std WHERE id_ref = '$id_ref'; ";
    $query = mysqli_query($conn, $cmd);
    $result = mysqli_fetch_array($query);

    $room = "SELECT * FROM room";
    $query_room = mysqli_query($conn, $room);
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
    <script src="https://kit.fontawesome.com/7b30317d32.js" crossorigin="anonymous"></script>
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
                    <h2><i class="fas fa-user-circle"></i> ข้อมูลของผู้ป่วย</h2><hr>
                    <ul>
                        <li><strong><i class="fas fa-user"></i> ชื่อ-สกุล:</strong> <?php echo $result['firstname']." ".$result['lastname'];?></li>
                        <li><strong><i class="fas fa-users-class"></i> ชั้น:</strong> <?php echo $result['classroom'];?></li>
                        <li><strong><i class="fas fa-concierge-bell"></i> ประเภทบริการ:</strong> <?php echo $result['type_service'];?></li>
                        <li><strong><i class="fas fa-notes-medical"></i> อาหาร/ยาที่แพ้:</strong> <?php if($result['allegery'] != ""){echo $result['allegery'];}else{echo "-";}?></li>
                        <li><strong><i class="fas fa-notes-medical"></i> โรคประจำตัว:</strong> <?php if($result['disease'] != ""){echo $result['disease'];}else{echo "-";}?></li>
                        <?php switch($result['type_service']){
                            case 'ขอยา':
                        ?>
                        <li><strong><i class="fas fa-sticky-note"></i> เหตุผลขอใช้ยา:</strong> <textarea class="form-control" readonly><?php echo $result['reason'];?></textarea></li>
                        <li><strong><i class="fas fa-sticky-note"></i> ยาที่ต้องการพิเศษ:</strong> <textarea class="form-control"><?php echo $result['drug_note'];?></textarea></li>
                        <?php 
                                break;
                            case 'ขอนอนพัก':
                        ?>
                        <li><strong><i class="fas fa-sticky-note"></i> เหตุผลขอเข้าพัก:</strong> <textarea class="form-control" readonly><?php echo $result['reason'];?></textarea></li>
                        <li><strong><i class="fas fa-clock"></i> คาบแรกเข้า:</strong> <input class="form-control" readonly value="<?php echo $result['pauseperiod_st'];?>"></li>
                        <li><strong><i class="fas fa-clock"></i> คาบท้ายออก:</strong> <input class="form-control" readonly value="<?php echo $result['pauseperiod_nd'];?>"></li>
                        <li><strong><i class="fas fa-bed"></i> ให้เข้าพักเตียง:</strong> <select name="room_sleep" class="form-control">
                            <?php while($rows = mysqli_fetch_assoc($query_room)){?>
                                <option value="<?php echo $rows['room_name'];?>"><?php echo $rows['room_name'];?></option>
                            <?php } ?>
                        </select></li>
                        <?php
                                break;
                        ?>
                        <?php }?>
                    </ul><hr>
                    <a href="/api/crud/nurse/approve_std.php?id_ref=<?php echo $result['id_ref'];?>&status=approve" class="btn btn-success">อนุญาต</a>
                    <a href="/api/crud/nurse/approve_std.php?id_ref=<?php echo $result['id_ref'];?>&status=deny" class="btn btn-danger">ปฏิเสธ</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
