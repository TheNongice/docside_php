<?php
  session_start();
  if(isset($_SESSION['login']) && $_SESSION['login'] == 1){
    if($_SESSION['authen_type'] == 'admin'){
      header("Location: /admin");
    }else if($_SESSION['authen_type'] == 'nurse'){
      header("Location: /nurse");
    }else if($_SESSION['authen_type'] == 'teacher'){
      header("Location: /teacher");
    }else{
      header("Location: /student");
    }
  }
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>หมอเคียงคุณ</title>
  <!-- Bootstrap CSS & JS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <!-- FontAwesome -->
  <script src="https://kit.fontawesome.com/7b30317d32.js" crossorigin="anonymous"></script>
  <!-- Custom CSS -->
  <link rel="stylesheet" href="style.css">
  <meta http-equiv="refresh" content="0; url=http://example.com">
</head>
<body>
  
<noscript><meta http-equiv="refresh" content="0; url=/block_js.html"></noscript>
  <div class="h-100 d-flex align-items-center justify-content-center">
      <div class="card p-3">
          <div class="card-header bg-primary text-white">
              เข้าสู่ระบบ (Authentication)
          </div>
          <div class="card-body">
              <div class="row">
                  <div class="col-sm d-grid">
                      <center>
                          <img class="img" src="img/logo_a.png" alt="Logo หมอเคียงคุณ" height="180">
                      </center>
                  </div>
              </div>
              <h1 class="text-center">หมอเคียงคุณ</h1>
              <p class="text-center fst-italic">PCSHSST ~ ว.จ.ภ.สตูล</p>
              <hr>
              <?php if (isset($_SESSION['err_msg'])) { echo $_SESSION['err_msg']; unset($_SESSION['err_msg']);} ?>
              <form action="api/authen/login.php" method="POST" autocomplete="OFF">
                  <div class="mb-3">
                      <label for="username" class="form-label"><i class="fa-solid fa-user"></i> ชื่อผู้ใช้งาน:</label>
                      <input type="text" class="form-control" id="username" name="user" required>
                  </div>
                  <div class="mb-3">
                      <label for="password" class="form-label"><i class="fa-solid fa-key"></i> รหัสผ่าน:</label>
                      <input type="password" class="form-control" id="password" name="pass" required>
                  </div>
                  <center><button type="submit" class="btn btn-success"><i class="fa-solid fa-right-to-bracket"></i> เข้าสู่ระบบ</button></center>
              </form>
              <hr>
              <code class="fs-6 fst-italic">Version 1.0.0 <code>Alpha</code>
          </div>
      </div>
  </div>

</body>
</html>