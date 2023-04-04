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
                    <h3>จัดการห้องพัก - <a href="?ready_a">เพิ่มห้องพัก</a></h3>
                    <?php if(!isset($_GET['ready_a'])){?>
                    <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">ลำดับ</th>
                        <th scope="col">ห้องพัก</th>
                        <th scope="col">สำหรับ</th>
                        <th scope="col">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $cmd = "SELECT * FROM room";
                        $query = mysqli_query($conn, $cmd);
                        $num = 1;
                        while($data = mysqli_fetch_assoc($query)){
                    ?>
                        <tr>
                        <th scope="row"><?php echo $num?></th>
                        <td><?php echo $data['room_name']; $num++;?></td>
                        <td><?php echo $data['room_sex'];?></td>
                        <td><a href="?ready_a=edit&id=<?php echo $data['id_room']; ?>" class="btn btn-success">แก้ไข</a> <a onClick="confirmDelete(<?php echo $data['id_room'];?>,'<?php echo $data['room_name'];?>');" class="btn btn-danger">ลบ</a></td>
                        </tr>
                    <?php }?>
                    </tbody>
                    </table>
                    <?php }else if($_GET['ready_a'] == 'edit'){ 
                        $id_room = $_GET['id'];
                        $cmd = "SELECT * FROM room WHERE id_room = $id_room";
                        $query = mysqli_query($conn, $cmd);
                        $data = mysqli_fetch_array($query);
                    ?>
                        <form action="/api/crud/nurse/manage_room.php" method="GET">
                          <div class="mb-3">
                            <label for="room_name" class="form-label">ชื่อห้องพัก</label>
                            <input type="text" name="room_name" class="form-control" value="<?php echo $data['room_name']?>">
                          </div>
                          <div class="mb-3">
                            <label for="room_sex" class="form-label">สำหรับเพศ</label>
                            <select name="room_sex" class="form-control">
                                <option value="<?php echo $data['room_sex']?>" selected><?php echo $data['room_sex']?></option>
                                <option disabled>------</option>
                                <option value="ชาย">ชาย</option>
                                <option value="หญิง">หญิง</option>
                            </select>
                          </div>
                          <input type="hidden" name="mode" value="edit">
                          <button type="submit" class="btn btn-success">บันทึกการแก้ไข</button>
                        </form>                        
                    <?php }else{?>
                        <form action="/api/crud/nurse/manage_room.php" method="GET">
                          <div class="mb-3">
                            <label for="room_name" class="form-label">ชื่อห้องพัก</label>
                            <input type="text" name="room_name" class="form-control">
                          </div>
                          <div class="mb-3">
                            <label for="room_sex" class="form-label">สำหรับเพศ</label>
                            <select name="room_sex" class="form-control">
                                <option value="ชาย">ชาย</option>
                                <option value="หญิง">หญิง</option>
                            </select>
                          </div>
                          <input type="hidden" name="mode" value="add">
                          <button type="submit" class="btn btn-success">บันทึก</button>
                        </form>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
    <script>
        function confirmDelete(id,room_name){
            let decide = confirm(`ต้องการลบห้อง ${room_name} (รหัส ${id}) ใช่หรือไม่?`);
            console.log(decide);
            if(decide === true){
                window.location.href = `/api/crud/nurse/manage_room.php?mode=del&id_room=${id}`;
            }
        }
    </script>
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