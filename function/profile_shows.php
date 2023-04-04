<?php
function calSeparateAge($date) {
    // $bdDates = $rows['birthday']; // ดึงวันเกิดเข้ามาคำนวณ
    $currentDate = date('d-m-Y');
    $age = date_diff(date_create($date), date_create($currentDate));
    // echo "อายุ " . $age->format("%y") . " ปี " . $age->format("%m") . " เดือน " . $age->format("%d") . " วัน";
    return [$age->format("%y"),$age->format("%m"),$age->format("%d")];
}

function bmiShowText($h, $w) {
    $formula = $w / (($h / 100) ** 2);
    if ($formula < 18.5) {
        return "ต่ำกว่าเกณฑ์";
    } else if ($formula >= 18.5 && $formula <= 22.9) {
        return "สมส่วน";
    } else if ($formula >= 23 && $formula <= 24.9) {
        return "น้ำหนักเกิน";
    } else if ($formula >= 25 && $formula <= 29.9) {
        return "อ้วน";
    } else {
        return "อ้วนอันตราย";
    }
}

function showAllergy($conn, $user){
    $cmd = "SELECT * FROM `student_info` WHERE id_std='$user';";
    $send = mysqli_query($conn, $cmd);
    $rows = mysqli_fetch_array($send);
    return $rows['allegery'];
}

function showDisease($conn, $user){
    $cmd = "SELECT * FROM `student_info` WHERE id_std='$user';";
    $send = mysqli_query($conn, $cmd);
    $rows = mysqli_fetch_array($send);
    return $rows['disease'];
}
function calBMI($w, $h){
    $formula = $w / (($h / 100) ** 2);
    return number_format($formula, 2, '.');
}

function calAge($conn, $user)
{
    $cmd = "SELECT * FROM `student_info` WHERE id_std='$user';";
    $send = mysqli_query($conn, $cmd);
    if (mysqli_num_rows($send) < 1) {
        header("Location: welcome.php");
    } else {
        $rows = mysqli_fetch_array($send);
        $bdDates = $rows['birthday']; // ดึงวันเกิดเข้ามาคำนวณ
        $currentDate = date('d-m-Y');
        $age = date_diff(date_create($bdDates), date_create($currentDate));
        echo "อายุ " . $age->format("%y") . " ปี " . $age->format("%m") . " เดือน " . $age->format("%d") . " วัน";
    }
}

function showHealth($conn, $user){
    $cmd = "SELECT * FROM `student_info` WHERE id_std='$user';";
    $send = mysqli_query($conn, $cmd);
    $rows = mysqli_fetch_array($send);
    if($rows['allegery'] != ''){
        $allegery = 'มี';
    }else{
        $allegery = 'ไม่มี';
    }
    if($rows['disease'] != ''){
        $disease = 'มี';
    }else{
        $disease = 'ไม่มี';
    }
    echo "น้ำหนัก " . $rows['weight'] . " ก.ก. ส่วนสูง " . $rows['height'] . " ซ.ม. BMI " . calBMI($rows['weight'],$rows['height']) . " (" . bmiShowText($rows['height'], $rows['weight']) . ")<br>" . "การแพ้ยา/อาหาร <strong>" . $allegery . "</strong> โรคประจำตัว: <strong>".$disease."</strong>";
}

function showWH($conn, $user){
    $cmd = "SELECT * FROM `student_info` WHERE id_std='$user';";
    $send = mysqli_query($conn, $cmd);
    $rows = mysqli_fetch_array($send);
    return [$rows['weight'],$rows['height']];
}