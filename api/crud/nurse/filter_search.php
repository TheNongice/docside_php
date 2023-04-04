<?php
    include '../../../config.php';
    session_start();
    $filter = $_GET['filter'];
    switch ($filter) {
        case 'room':
            $classroom = $_GET['class'];
            $filter_mode = "WHERE classroom='$classroom'";
            break;
        default:
            die('Unknown filter method!');
    }
    $cmd = "SELECT * FROM student_info $filter_mode";
    $query = mysqli_query($conn,$cmd);
    while($rows = mysqli_fetch_assoc($query)){
        // echo table result from filter
        echo $rows['firstname']."</br>";
    }
