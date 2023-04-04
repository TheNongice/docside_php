<?php
include_once '../api/crud/nurse/show_case.php';

session_start();
if (!isset($_SESSION['login'])) {
    $_SESSION['err_msg'] = '<div class="alert alert-danger">กรุณาเข้าสู่ระบบก่อนดำเนินการต่อ</div>';
    header('Location: /');
}

$date = date("Y-m-d");
$cmd = "SELECT * FROM treatment WHERE timestamp LIKE '%$date%'";
$result = mysqli_query($conn, $cmd);
$total_drug = 0;
$total_sleep = 0;
if (mysqli_num_rows($result) > 0) {

    while($row = mysqli_fetch_assoc($result)) {
        
        $labels[] = $row['type_service'];
        
        switch ($row['type_service']) {
            case 'ขอยา':
                $total_drug++;
                break;
            case 'ขอนอนพัก':
                $total_sleep++;
                break;
            default:
                break;
        }
    }
    $labels = array_unique($labels);
    if($labels[0] == 'ขอยา'){
        $data = [$total_drug,$total_sleep];
    }else{
        $data = [$total_sleep,$total_drug];
    }
}else{
    echo "<script>alert('ไม่พบประวัติการขอเข้าใช้บริการในวันนี้!')</script>";
}

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
    'BI' => 'THSarabun BoldItalic.ttf'
    ]
    ],
    'default_font' => 'sarabun'
]);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>:: หมอเคียงคุณ - คุณครูห้องพยาบาล ::</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/7b30317d32.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background-color: #7B8FA1;
        }
    </style>
</head>

<body>
    <?php include_once 'components/navbar.php'; ?>
    <div class="container-fluid">
        <div class="container-sm">
            <div class="card">
                <div class="card-body">
                    <center>
                        <h2>รายงานผู้เข้าใช้ประจำวัน</h2>
                        <h5>ประจำวันที่ <?php echo date('d/m/Y'); ?></h5>
                        <a href="daily_pdf.php" class="btn btn-warning">พิมพ์รายงานข้อมูล</a>
                    </center>
                    <hr>
    <?php ob_start(); ?>
                    <div class="row">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">เลขประจำตัว</th>
                                    <th scope="col">ประเภทบริการ</th>
                                    <th scope="col">สถานะ</th>
                                    <th scope="col">เวลา</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php showDaily($conn); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-sm my-3">
        <div class="card">
            <div class="card-body">
                <center><h2>แผนภูมิสถิติข้อมูลขอเข้าใช้ห้องพยาบาลประจำวัน</h2></center>
                <div class="card">
                    <div class="card-body">
                        <canvas id="myChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    var ctx = document.getElementById("myChart");
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?=json_encode($labels)?>,
            datasets: [{
                label: 'Report',
                data: <?=json_encode($data, JSON_NUMERIC_CHECK);?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 0
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            },
             responsive: true,
             title: {
                display: true,
                text: 'สถิติข้อมูลการขอเขาใช้ห้องพยาบาลประจำวัน'
            },
            indexAxis: 'y'
        }
    });
    </script>    
    <?php
    if (isset($_SESSION['changePass'])) {
        echo $_SESSION['changePass'];
        unset($_SESSION['changePass']);
    }
    if (isset($_SESSION['alert'])) {
        echo $_SESSION['alert'];
        unset($_SESSION['alert']);
    }
    ?>
</body>

</html>