<nav class="navbar navbar-expand-md navbar-dark mb-3" style="background-color: #F1AF6D;">
  <div class="container">
    <a class="navbar-brand" href="/"><img src="/img/logo_a.png" height="65"/> หมอเคียงคุณ</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarScroll">
      <ul class="navbar-nav ms-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">ผู้ใช้ UID:[<?php echo $_SESSION["id_std"];?>]</a>
          <ul class="dropdown-menu">
            <li><p class="dropdown-item" style='font-family: "Taviraj",serif;'>สวัสดี! <?php echo $_SESSION["name"]; ?></p></li>
            <li><a class="dropdown-item" href="settings.php"><i class="fa-solid fa-gear"></i> ตั้งค่าโพรไฟล์</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/api/authen/logout.php"><i class="fa-solid fa-right-from-bracket"></i> ออกจากระบบ</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>