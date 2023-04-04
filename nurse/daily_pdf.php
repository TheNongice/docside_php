<?php
require_once '../vendor/autoload.php';
include_once '../config.php';
session_start();

$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];

$mpdf = new \Mpdf\Mpdf([
    'fontDir' => array_merge($fontDirs, [
        __DIR__ . '/temps',
    ]),
    'fontdata' => $fontData + [ // lowercase letters only in font key
        'sarabun' => [
            'R' => 'THSarabunNew.ttf',
            'I' => 'THSarabunNew Italic.ttf',
            'B' => 'THSarabunNew Bold.ttf',
            'BI' => 'THSarabunNew BoldItalic.ttf'
        ]
    ],
    'default_font' => 'sarabun'
]);
$total_drug = 0;
$total_sleep = 0;
$date = date("Y-m-d");
$cmd = "SELECT student_info.id_std,student_info.firstname,student_info.lastname,student_info.classroom,treatment.type_service,treatment.timestamp,treatment.status FROM student_info INNER JOIN treatment ON student_info.id_std = treatment.id_std WHERE timestamp LIKE '%$date%'";
$query = mysqli_query($conn, $cmd);
$date = date("d/m/Y");
$date_time = date("d/m/Y - H:i:s น.");
$user = $_SESSION['user'];
$data = "
    <style>
        .container{
            font-size: 16px;
        }
        .text-center{
            text-align: center;
        }
    </style>
</head>
<body>
    <div class='container'>
        <div class='text-center'>
            <h1>รายงานการขอเข้าใช้บริการ<br><i style='font-size:18px;'>ประจำวันที่ $date</i></h1>
            <hr>
        </div>
        <div>
            <table class='table' style='width:100%; text-align: center;'>
                <thead>
                    <tr>
                        <th scope='col'>ลำดับที่</th>
                        <th scope='col'>เลขประจำตัว</th>
                        <th scope='col'>ชื่อ-สกุล</th>
                        <th scope='col'>ชั้นเรียน</th>
                        <th scope='col'>ประเภทบริการ</th>
                        <th scope='col'>สถานะ</th>
                        <th scope='col'>เวลา</th>
                    </tr>
                </thead>
                <tbody>";
if (mysqli_num_rows($query) < 1) {
    header("Location: /");
    return 1;
} else {
    $round = 1;
}
while ($rows = mysqli_fetch_assoc($query)) {
    $data .= "<tr>";
    $data .= "<th scope='row'>" . $round;
    $round++ . "</th>";
    $data .= "<td>" . substr($rows['id_std'], 0, 45) . "</td>";
    $data .= "<td>" . $rows['firstname']." ".$rows['lastname']. "</td>";
    $data .= "<td>" . substr($rows['type_service'], 0, 45) . "</td>";
    if($rows['type_service'] == 'ขอยา'){
        $total_drug++;
    }else{
        $total_sleep++;
    }
    $data .= "<td>ม." . $rows['classroom'] . "</td>";
    switch ($rows['status']) {
        case '✅':
            $rows['status'] = 'อนุมัติ';
            break;
        case '⌛':
            $rows['status'] = 'รอ';
            break;
        case '❌':
            $rows['status'] = 'ปฏิเสธ';
            break;
    }
    $data .= "<td>" . substr($rows['status'], 0, 45) . "</td>";
    $data .= "<td>" . substr($rows['timestamp'], 0, 45) . "</td>";
    $data .= "</tr>";
}
$data .= "</tbody></table></div></div><hr>";
$data .= "
<p>
<strong style='font-size:18px'>สรุปผลข้อมูลภายในระบบ</strong><br>
มีผู้ขอเข้านอนพักจำนวน $total_sleep คน<br>
มีผู้ขอขอยาจำนวน $total_drug คน
</p>";
$data .= "<p><strong>ออกรายงานด้วย Doctor By Side V 1.0.0 Alpha</strong><br><strong>ข้อมูลนี้ออกโดย:</strong> $user <strong>เมื่อ:</strong> $date_time</p>";
?>
<?php
$mpdf->WriteHTML($data);
$mpdf->Output();
?>
</body>

</html>