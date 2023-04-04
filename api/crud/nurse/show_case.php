<?php 
    include_once '../config.php';
    function showSleep($conn,$case = 'ขอนอนพัก'){
        $cmd = "SELECT * FROM treatment WHERE type_service = '$case' AND status = '⌛' ORDER BY timestamp DESC LIMIT 10";
        $query = mysqli_query($conn, $cmd);
        if(mysqli_num_rows($query) < 1){
            echo '<h5 class="text-center">** ไม่พบประวัติในระบบ **</h5>';
            return 1;
        }else{
            $round = 1;
        }
        while($rows = mysqli_fetch_assoc($query)){
            echo "<tr onClick='window.location.href=\"edit_request.php?id_ref=".$rows['id_ref']."\"'>";
            echo "<th scope='row'>".$round;$round++."</th>";
            echo "<td>".substr($rows['id_std'],0,45)."</td>";
            echo "<td>".substr($rows['pauseperiod_st'],0,45)."</td>";
            echo "<td>".substr($rows['pauseperiod_nd'],0,45)."</td>";
            echo "<td>".substr($rows['status'],0,45)."</td>";
            echo "<td>".substr($rows['timestamp'],0,45)."</td>";
            echo "</tr>";
        }
    }
    
    function showDrug($conn,$case = 'ขอยา'){
        $cmd = "SELECT * FROM treatment WHERE type_service = '$case' AND status = '⌛' ORDER BY timestamp DESC LIMIT 10";
        $query = mysqli_query($conn, $cmd);
        if(mysqli_num_rows($query) < 1){
            echo '<h5 class="text-center">** ไม่พบประวัติในระบบ **</h5>';
            return 1;
        }else{
            $round = 1;
        }
        while($rows = mysqli_fetch_assoc($query)){
            echo "<tr onClick='window.location.href=\"edit_request.php?id_ref=".$rows['id_ref']."\"'>";
            echo "<th scope='row'>".$round;$round++."</th>";
            echo "<td>".substr($rows['id_std'],0,45)."</td>";
            echo "<td>".substr($rows['drug_note'],0,45)."</td>";
            echo "<td>".substr($rows['reason'],0,45)."</td>";
            echo "<td>".substr($rows['status'],0,45)."</td>";
            echo "<td>".substr($rows['timestamp'],0,45)."</td>";
            echo "</tr>";
        }
    }

    function showDaily($conn){
        $date = date("Y-m-d");
        $cmd = "SELECT * FROM treatment WHERE timestamp LIKE '%$date%'";
        $query = mysqli_query($conn, $cmd);
        if(mysqli_num_rows($query) < 1){
            echo '<h5 class="text-center">** ไม่พบประวัติในระบบ **</h5>';
            return 1;
        }else{
            $round = 1;
        }
        while($rows = mysqli_fetch_assoc($query)){
            echo "<tr onClick='window.location.href=\"edit_request.php?id_ref=".$rows['id_ref']."\"'>";
            echo "<th scope='row'>".$round;$round++."</th>";
            echo "<td>".substr($rows['id_std'],0,45)."</td>";
            echo "<td>".substr($rows['type_service'],0,45)."</td>";
            echo "<td>".substr($rows['status'],0,45)."</td>";
            echo "<td>".substr($rows['timestamp'],0,45)."</td>";
            echo "</tr>";
        }
    }

    function graphDaily($conn){

    }
    