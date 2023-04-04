<?php 
    session_start();
    if(!isset($_SESSION['login'])){
        die('Please sign-in to countinue or try again later.');
    }
    include_once('../../config.php');
    print_r($_POST);
    $weight = mysqli_real_escape_string($conn, $_POST['weight']);
    $height = mysqli_real_escape_string($conn, $_POST['height']);
    $allergy = mysqli_real_escape_string($conn,$_POST['allergy']);
    $disease = mysqli_real_escape_string($conn,$_POST['disease']);
    $id_std = mysqli_real_escape_string($conn,$_POST['id_std']);
    $cmd = "UPDATE `student_info` SET `allegery` = '$allergy', `disease` = '$disease', `weight` = $weight, `height` = $height WHERE `student_info`.`id_std` = '$id_std' ";
    $query = mysqli_query($conn, $cmd);

    if($query){
        $_SESSION['alert'] = "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'ส่งข้อมูลสำเร็จ',showConfirmButton: false,timer: 1500})</script>";
        header('Location: /student');
    }else{
        die('Can\'t update infomation! Please try again later.');
    }