<?php
    // Disable error reporting
    // error_reporting(0);
    
    require_once __DIR__ . '/vendor/autoload.php';
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    define("HOST",$_ENV['HOST_DB']);
    define("USER_DB",$_ENV['USER_DB']);
    define("PASS_DB",$_ENV['PASS_DB']);
    define("NAME_DB",$_ENV['NAME_DB']);
    
    define("YEAR_SYS",2566);
    define("SEMESTER_SYS",2);

    $conn = mysqli_connect(HOST,USER_DB,PASS_DB,NAME_DB);
    $token = $_ENV['LINE_TOKEN'];
    function sendLine($token,$id,$type,$reason){
        date_default_timezone_set("Asia/Bangkok");
        $sMessage = "\nมีคำร้องขอจากนักเรียน \nเลขประจำตัว: ".$id."\nประเภท: ".$type."\nเหตุผล: ".$reason."\nกรุณาตรวจสอบ!!!";  
        $chOne = curl_init(); 
        curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
        curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
        curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
        curl_setopt( $chOne, CURLOPT_POST, 1); 
        curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
        $headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$token.'', );
        curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
        curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
        $result = curl_exec( $chOne ); 
        curl_close( $chOne );
    }