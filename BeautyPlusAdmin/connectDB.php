<?php
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $HOST = "localhost";
    $USERNAME = "root";
    $PASSWORD = "";
    $DBNAME = "beautyplus";

    $conn = new mysqli($HOST, $USERNAME, $PASSWORD, $DBNAME);
    if($conn->connect_error){
        die("ket noi that bai".$conn->connect_error);
    }
?>