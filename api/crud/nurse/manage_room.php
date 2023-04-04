<?php
    include_once '../../../config.php';
    session_start();
    if(!isset($_SESSION['login']) && ($_SESSION['authen_type'] != 'admin' || $_SESSION['authen_type'] != 'nurse')){
        die('You must have a permission to access this!');
    }
    $mode = $_GET['mode'];
    switch($mode) {
        case 'del':
            $id_room = mysqli_real_escape_string($conn, $_GET['id_room']);
            $cmd = "DELETE FROM `room` WHERE `id_room` = $id_room";
            $query = mysqli_query($conn, $cmd);
            if($query){
                $_SESSION['alert'] = "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'ลบห้องสำเร็จ',showConfirmButton: false,timer: 1500})</script>";
            }else{
                die('Error! - Can\'t remove.');
            }
            header('Location: /nurse');
            break;
        case 'add':
            $room_name = mysqli_real_escape_string($conn, $_GET['room_name']);
            $only_sex = mysqli_real_escape_string($conn, $_GET['room_sex']);
            $cmd = "INSERT INTO `room` (`room_name`, `room_sex`) VALUES ('$room_name', '$only_sex') ";
            $query = mysqli_query($conn, $cmd);
            if($query){
                $_SESSION['alert'] = "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'เพิ่มข้อมูลสำเร็จ',showConfirmButton: false,timer: 1500})</script>";
            }else{
                die('Error! - Can\'t add.');
            }
            header('Location: /nurse');
            break;
        case 'edit':
            $id_room = mysqli_real_escape_string($conn, $_GET['id_room']);
            $room_name = mysqli_real_escape_string($conn, $_GET['room_name']);
            $only_sex = mysqli_real_escape_string($conn, $_GET['room_sex']);
            $cmd = "UPDATE `room` SET `room_name` = '$room_name', `pass` = '', `room_sex` = '$only_sex' WHERE `id_room` = $id_room ";
            $query = mysqli_query($conn, $cmd);
            if($query){
                $_SESSION['alert'] = "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'แก้ไขข้อมูลสำเร็จ',showConfirmButton: false,timer: 1500})</script>";
            }else{
                die('Error! - Can\'t edit.');
            }
            header('Location: /nurse');            
            break;
        default:
            die("Unknown mode");
    }