<?php
    session_start();
    if(!isset($_SESSION['authen'])){
        header('Location: ../../');;
    }
    if($_SESSION['roles']=='admin'){
        header("Location: ../admin");
    }
    if(isset($_SESSION['reason'])){
        $reasonBan = $_SESSION['reason'];
    }else{
        $reasonBan = 'null';
    }
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หมอเคียงคุณ - ยินดีต้อนรับ</title>
    <script src="https://kit.fontawesome.com/7b30317d32.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.2/js/bootstrap.min.js" integrity="sha512-28e47INXBDaAH0F91T8tup57lcH+iIqq9Fefp6/p+6cgF7RKnqIMSmZqZKceq7WWo9upYMBLMYyMsFq7zHGlug==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.2/css/bootstrap.min.css" integrity="sha512-dhpxh4AzF050JM736FF+lLVybu28koEYRrSJtTKfA4Z7jKXJNQ5LcxKmHEwruFN2DuOAi9xeKROJ4Z+sttMjqw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../fonts.css">
    <style>
    html{
    height: 100%
    }
    body{
        background-image: linear-gradient(to bottom, #0b0f4b, #003068, #004c78, #00687d, #07827e);
        background-attachment: fixed;
        height: 100%;
        font-family: 'Fira Code',monospace,'Taviraj', serif;
    }        
    </style>
</head>
<body>
    <div class="container mt-4 well">
        <div class="card-body">
            <img class="img-fluid" src="/img/logo_a.png">
            <hr>
            <h1>ยินดีต้อนรับสู่หมอเคียงคุณ!</h1>
            <h4 class="text-break">ขณะนี้ท่านยังไม่สามารถเข้าสู่ระบบได้เนื่องจาก<strong><?php echo $reasonBan?></strong> ณ วันนี้กรุณาติดต่อผู้ดูแลระบบเพื่อดำเนินการต่อ</h4>
            <hr>
            <a href="/api/logout.php" class="btn btn-danger">ออกจากระบบ</a>
            <h3><code>ขณะนี้ท่านกำลังเข้าสู่ระบบในนามของ <strong><?php echo $_SESSION['name'];?></strong></code></h3>
        </div>
    </div>
</body>
</html>