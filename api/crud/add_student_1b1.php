<?php
    include_once '../../config.php';
    session_start();
    if(!isset($_SESSION['login']) && ($_SESSION['authen_type'] != 'admin' || $_SESSION['authen_type'] != 'nurse')){
        die('You must have a permission to access this!');
    }
    // ดึง Input Parameters
    $id_std = mysqli_real_escape_string($conn,$_POST['id_std']);
    $user_std = mysqli_real_escape_string($conn,$_POST['user_std']);
    $name = explode(" ",mysqli_real_escape_string($conn, $_POST['name']));
    $class = mysqli_real_escape_string($conn, $_POST['classroom']);
    $sex = mysqli_real_escape_string($conn, $_POST['sex']);
    $birth = mysqli_real_escape_string($conn, $_POST['birthday']);
    $weight = mysqli_real_escape_string($conn, $_POST['weight']);
    $height = mysqli_real_escape_string($conn, $_POST['height']);
    $allegery = mysqli_real_escape_string($conn, $_POST['allegery']);
    $disease = mysqli_real_escape_string($conn, $_POST['disease']);

    $firstname = $name[0];
    $lastname = $name[1];

    // SQL Command & Connection
    $cmd = "INSERT INTO `student_authen` (`id_std`, `user`, `pass`) VALUES ('$id_std', '$user_std', '$2a$10\$oJXFf.l7KLgiy1YVM4X8meu8QwbFFOr2nIiN0EMjcXRywuMNjOeD6')";
    $cmd2 = "INSERT INTO `student_info` (`id_std`, `firstname`, `lastname`, `classroom`, `birthday`, `sex`, `weight`, `height`, `allegery`, `disease`) VALUES ('$id_std', '$firstname', '$lastname', '$class', '$birth', '$sex', '$weight', '$height', '$allegery', '$disease') ";
    $query = mysqli_query($conn,$cmd);
    $query2 = mysqli_query($conn,$cmd2);
    if($query && $query2){
        $_SESSION['alert'] = "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'เพิ่มข้อมูลสำเร็จ',showConfirmButton: false,timer: 1500})</script>";
        header('Location: /nurse');
    }else{
        die('Can\'t add student!');
    }