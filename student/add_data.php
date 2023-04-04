<?php
include_once '../config.php';
include_once '../function/profile_shows.php';
session_start();
if (!isset($_SESSION['login'])) {
    $_SESSION['err_msg'] = '<div class="alert alert-danger">กรุณาเข้าสู่ระบบก่อนดำเนินการต่อ</div>';
    header('Location: ../../');;
}
if ($_SESSION['authen_type'] == 'admin' || $_SESSION['authen_type'] == 'nurse') {
    header("Location: ../admin");
}
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หมอเคียงคุณ - <?php echo $_SESSION['name']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="robots" content="noindex,nofollow">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/7b30317d32.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../fonts.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
</head>

<body>
    <div class="loader-wrapper">
        <div class="loader">
        </div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
    <?php include_once('components/navbar.php'); ?>
    <?php include_once('components/profile_box.php'); ?>
    <div class="container-sm my-3" id="drug">
        <div class="card">
            <div class="card-body">
                <h3><i class="fa-solid fa-scroll"></i> ฟอร์มขอยา</h3>
                <hr>
                <form action="/api/request/sendDrug.php" method="post" autocomplete="OFF">
                    <div class="mb-3">
                        <label for="id_std" class="form-label"><i class="fa-solid fa-user"></i> เลขประจำตัวนักเรียน</label>
                        <input type="text" class="form-control-plaintext" id="id_std" aria-describedby="id_std" value="<?php echo $_SESSION['id_std'] ?>" name="id_std" readonly>
                        <div id="id_std" class="form-text">* ไม่สามารถเปลี่ยนแปลงได้</div>
                    </div>
                    <div class="mb-3">
                        <label for="drugReason" class="form-label"><span style="color:red;">*</span> <i class="fa-solid fa-prescription-bottle-medical"></i> อาการของนักเรียน/สาเหตุการขอยา</label>
                        <select name="drugReason" id="drugReason" class="form-control" required>
                            <option selected disabled>กรุณาเลือก...</option>
                            <option>ป่วย/ไข้ ไม่สบายตัว</option>
                            <option>ท้องเสีย</option>
                            <option>อื่น ๆ</option>
                        </select>
                    </div>
                    <div class="mb-3" id="otherReason_drug">

                    </div>
                    <div class="mb-3">
                        <label for="drugWants" class="form-label"><i class="fa-solid fa-paperclip"></i> ยาที่คาดว่าต้องการ</label>
                        <textarea type="text" class="form-control" id="drugWants" name="drugWants"></textarea>
                    </div>
                    <p style="color:red;">* บังคับการกรอก</p>
                    <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> บันทึกข้อมูล</button>
                </form>
            </div>
        </div>
    </div>
    <div class="container-sm my-4" id="sleep">
        <div class="card">
            <div class="card-body">
                <h3><i class="fa-solid fa-scroll"></i> ฟอร์มขอพักในห้องพยาบาล</h3>
                <hr>
                <form action="/api/request/sendSleep.php" method="post" id="sleepSubmit">
                    <div class="mb-3">
                        <label for="id_std" class="form-label"><i class="fa-solid fa-user"></i> เลขประจำตัวนักเรียน</label>
                        <input type="text" class="form-control-plaintext" id="id_std" aria-describedby="id_std" value="<?php echo $_SESSION['id_std'] ?>" name="id_std" readonly>
                        <div id="id_std" class="form-text">* ไม่สามารถเปลี่ยนแปลงได้</div>
                    </div>
                    <div class="mb-3">
                        <label for="reasonSleep" class="form-label"><i style="color:red">*</i> <i class="fa-solid fa-bed"></i> สาเหตุการเข้านอนพัก</label>
                        <select name="reasonSleep" id="reasonSleep" class="form-control" required>
                            <option selected disabled>กรุณาเลือก...</option>
                            <option>ป่วย/ไข้ ไม่สบายตัว</option>
                            <option>ท้องเสีย</option>
                            <option>เพลีย/อ่อนล้า</option>
                            <option>อื่น ๆ</option>
                        </select>
                    </div>
                    <div class="mb-3" id="otherReason_sleep">

                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col">
                                <label for="peroidwants" class="form-label"><i style="color:red">*</i> <i class="fa-solid fa-clock"></i> ระยะเวลา (คาบ) ที่ต้องการพัก</label>
                                <br>(คาบแรก)
                                <select name="peroid_st" class="form-control" id="peroid_st">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                </select>
                            </div>
                            <div class="col">
                                <br>(คาบสุดท้าย)
                                <select name="peroid_nd" class="form-control" id="peroid_nd">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <p style="color:red;">* บังคับการกรอก</p>
                    <a id="submit" role="button" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> บันทึกข้อมูล</a>
                </form>
            </div>
        </div>
    </div>
    <script>
        $('document').ready(function() {
            $('#drugReason').change(function() {
                let _this = $(this).val();
                if (_this === "อื่น ๆ") {
                    $("#other_drug").remove();
                    $('#otherReason_drug').append("<textarea placeholder='กรุณากรอกเหตุผลอื่น ๆ' required class='form-control' name='drugReason' id='other_drug'></textarea>");
                } else {
                    $("#other_drug").remove();
                }
            })
            $('#reasonSleep').change(function() {
                let _this = $(this).val();
                if (_this === "อื่น ๆ") {
                    $("#other_sleep").remove();
                    $('#otherReason_sleep').append("<textarea placeholder='กรุณากรอกเหตุผลอื่น ๆ' required class='form-control' name='reasonSleep' id='other_sleep'></textarea>");
                } else {
                    $("#other_sleep").remove();
                }
            })            
            $('#submit').click(function() {
                var reasonSleep = $('#reasonSleep').val()
                var start_t = $('#peroid_st').val()
                var end_t = $('#peroid_nd').val()
                if (reasonSleep.length == 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'ข้อผิดพลาด',
                        text: 'กรุณากรอกเหตุผลการขอพัก',
                        confirmButtonText: 'ตกลง'
                    })
                } else {
                    if (start_t > end_t) {
                        Swal.fire({
                            icon: 'error',
                            title: 'ข้อผิดพลาด',
                            text: 'เวลาเริ่มต้นต้องน้อยกว่าเวลาสิ้นสุด',
                            confirmButtonText: 'ตกลง'
                        })
                    } else {
                        $('#sleepSubmit').submit();
                    }
                }
            })
        })
    </script>
    <script>
        window.addEventListener('load', function() {
            document.querySelector('body').classList.add("loaded")
        });
    </script>
</body>

</html>