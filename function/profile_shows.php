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
    $cmd = "SELECT * FROM `profilestudents` WHERE id_std='$user';";
    $send = mysqli_query($conn, $cmd);
    $rows = mysqli_fetch_array($send);
    return $rows['allergy'];
}

function calBMI($w, $h){
    $formula = $w / (($h / 100) ** 2);
    return $formula;
}

/*
function showHealth($conn, $user){
    $cmd = "SELECT * FROM `profilestudents` WHERE id_std='$user';";
    $send = mysqli_query($conn, $cmd);
    $rows = mysqli_fetch_array($send);
    echo "น้ำหนัก " . $rows['weight'] . " ก.ก. ส่วนสูง " . $rows['height'] . " ซ.ม. BMI " . $rows['bmi'] . " (" . bmiShowText($rows['height'], $rows['weight']) . ")<br>" . "การแพ้ยา/อาหาร <strong>" . $rows['allergy'] . "</strong>";
}*/