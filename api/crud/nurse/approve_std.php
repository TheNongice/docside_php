<?php
    include_once '../../../config.php';
    session_start();

    $id_ref = mysqli_real_escape_string($conn, $_GET['id_ref']);
    $status = mysqli_real_escape_string($conn, $_GET['status']);
    $room_sleep = mysqli_real_escape_string($conn, $_GET['room_sleep']);

    switch ($status){
        case 'approve':
            $cmd = "UPDATE `treatment` SET `drug_note` = '$drug_note', `drug_send` = '$drug_send', `room_sleep` = '$room_sleep', `status` = '✅' WHERE id_ref = $id_ref ";
            break;
        case 'deny':
            $cmd = "UPDATE `treatment` SET `drug_note` = '$drug_note', `drug_send` = '$drug_send', `room_sleep` = '$room_sleep', `status` = '❌' WHERE id_ref = $id_ref ";
            break;
        default:
            die("Unknown status!");
    }
    $query = mysqli_query($conn, $cmd);
    if($query){
        $_SESSION['alert'] = "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'แก้ไขข้อมูลสำเร็จ',showConfirmButton: false,timer: 1500})</script>";
        header('Location: /nurse');
    }else{
        die("Can't update data!");
    }