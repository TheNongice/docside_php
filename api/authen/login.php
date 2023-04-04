<?php
    include_once '../../config.php';
    session_start();

    // Recieve input
    $user = mysqli_real_escape_string($conn, $_POST['user']);
    $pass = mysqli_real_escape_string($conn, $_POST['pass']);

    $cmd = "SELECT * FROM admin_nurse WHERE user='$user'";
    $query = mysqli_query($conn, $cmd);
    $data = mysqli_fetch_array($query);
    if(mysqli_num_rows($query) > 0){
        $pass_db = $data['pass'];
        if(password_verify($pass,$pass_db)){
            $_SESSION['login'] = 1;
            $_SESSION['authen_type'] = $data['roles'];
            $_SESSION['user'] = $data['user'];
        }else{
            $_SESSION['err_msg'] = '<div class="alert alert-danger" role="alert">ชื่อผู้ใช้/รหัสผ่านไม่ถูกต้อง!</div>';
        }
        header('Location: ../../');
    }else{
        $cmd = "SELECT * FROM student_authen WHERE user='$user'";
        $query = mysqli_query($conn, $cmd);
        $data = mysqli_fetch_array($query);
        $pass_db = $data['pass'];
        if(mysqli_num_rows($query) > 0){
            if(password_verify($pass,$pass_db)){
                $_SESSION['login'] = 1;
                $_SESSION['authen_type'] = "std";
                $cmd2 = "SELECT student_info.* FROM `student_authen` INNER JOIN `student_info` ON student_authen.id_std = student_info.id_std WHERE student_authen.user = '$user';";
                $query2 = mysqli_query($conn, $cmd2);
                $data2 = mysqli_fetch_array($query2);
                $_SESSION['name'] = $data2['firstname']. " ".$data2['lastname'];
                $_SESSION['id_std'] = $data2['id_std'];
                header('Location: ../../');
            }else{
                $_SESSION['err_msg'] = '<div class="alert alert-danger" role="alert">ชื่อผู้ใช้/รหัสผ่านไม่ถูกต้อง!</div>';
            }
        }else{
            $_SESSION['err_msg'] = '<div class="alert alert-danger" role="alert">ชื่อผู้ใช้/รหัสผ่านไม่ถูกต้อง!</div>';
        }
        header('Location: ../../');
    }
