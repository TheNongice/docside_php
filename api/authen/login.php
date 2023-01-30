<?php
    include_once '../../config.php';
    session_start();

    // Recieve input
    $user = mysqli_real_escape_string($conn, $_POST['user']);
    $pass = mysqli_real_escape_string($conn, $_POST['pass']);

    $cmd = "SELECT * FROM user WHERE user='$user'";
    $query = mysqli_query($conn, $cmd);
    $data = mysqli_fetch_array($query);
    if(mysqli_num_rows($query) > 0){
        $_SESSION['login'] = 1;
        $_SESSION['authen_type'] = $rows['authen_type'];
    }else{
        $_SESSION['err_msg'] = '<div class="alert alert-danger" role="alert">ชื่อผู้ใช้/รหัสผ่านไม่ถูกต้อง!</div>';
    }
