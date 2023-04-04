<div class="container-fluid">
    <div class="container-sm">
        <div class="card">
            <div class="card-body">
                <div id="profiles" class="text-center">
                    <!-- <div class="profile m-3">
                        <h3>**รูป profiles จะพัฒนาเร็วๆ นี้**</h3>
                    </div> -->
                <h2><?php echo $_SESSION['name'];?></h2>
                <h5><?php calAge($conn,$_SESSION['id_std'])?><br></h5>
                <p><?php showHealth($conn,$_SESSION['id_std']);?><br></p>
                <a class="btn btn-secondary" roles="button" href="settings.php"><i class="fa-solid fa-gear"></i> เปลี่ยนแปลง/บันทึกข้อมูล</a>
                <a class="btn btn-danger" roles="button" href="/api/authen/logout.php"><i class="fa-solid fa-right-from-bracket"></i> ออกจากระบบ</a>
            </div>
        </div>
    </div>
</div>