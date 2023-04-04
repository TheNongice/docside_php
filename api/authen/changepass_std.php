<?php
    include_once '../../config.php';
    session_start();
    
    $user = $_SESSION['id_std'];
    $pass = $_POST['confirmpass'];
    $pass_encrypt = password_hash($pass,PASSWORD_DEFAULT);

    $cmd = "UPDATE `student_authen` SET `pass` = '$pass_encrypt' WHERE `id_std` = '$user'";
    $query = mysqli_query($conn, $cmd);

    if($query){
        $_SESSION['alert'] = "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'เปลี่ยนรหัสผ่านสำเร็จ',showConfirmButton: false,timer: 1500})</script>";
        header("Location: /student");
    }else{
        die('ไม่สามารถเปลี่ยนรหัสผ่านได้ เกิดข้อผิดพลาดบางประการ!');
    }
