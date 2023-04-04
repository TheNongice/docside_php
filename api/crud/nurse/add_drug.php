<?php
    session_start();
    include_once('../../../config.php');
    if(!isset($_SESSION['login'])){
        die('Please sign-in to countinue or try again later.');
    }
    // print_r($_POST);
    $id_std = mysqli_real_escape_string($conn,$_SESSION['id_std']);
    $reason = mysqli_real_escape_string($conn,$_POST['drugReason']);
    if($_POST['drugWants'] == ''){
        $drugwant = 'ไม่ระบุ';
    }else{
        $drugwant = $_POST['drugWants'];
    }
    $cmd = "INSERT INTO `treatment` (`id_std`, `type_service`, `reason`, `drug_note`) VALUES ('$id_std', 'ขอยา', '$reason', '$drugwant');";
    $result = mysqli_query($conn,$cmd);
    if($cmd){
        $_SESSION['alert'] = "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'ส่งข้อมูลสำเร็จ',showConfirmButton: false,timer: 1500})</script>";
        header('Location: /nurse');
    }else{
        die('Cannot add these data to database. Please try again later.');   
    }