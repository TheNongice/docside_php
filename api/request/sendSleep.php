<?php
    session_start();
    include_once('../../config.php');
    if(!isset($_SESSION['login'])){
        die('Please sign-in to countinue or try again later.');
    }
    // print_r($_POST);
    $reason = mysqli_real_escape_string($conn,$_POST['reasonSleep']);
    $time_start = mysqli_real_escape_string($conn,$_POST['peroid_st']);
    $time_end = mysqli_real_escape_string($conn,$_POST['peroid_nd']);
    if($_SESSION['authen_type'] != 'std'){
        $id_std = mysqli_real_escape_string($conn,$_POST['id_std']);
        $status = '✅';        
    }else{
        $id_std = mysqli_real_escape_string($conn,$_SESSION['id_std']);
        $status = '⌛';
    }
    $cmd = "INSERT INTO `treatment` (`id_std`, `type_service`, `reason`, `pauseperiod_st`,`pauseperiod_nd`,`status`) VALUES ('$id_std', 'ขอนอนพัก', '$reason', '$time_start','$time_end','$status');";
    $result = mysqli_query($conn,$cmd);
    if($cmd){
        if($_SESSION['authen_type'] == 'std'){
            sendLine($token, $id_std, "ขอนอนพัก", $reason);
        }
        $_SESSION['alert'] = "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'ส่งข้อมูลสำเร็จ',showConfirmButton: false,timer: 1500})</script>";
        header('Location: /student');
    }else{
        die('Cannot add these data to database. Please try again later.');   
    }