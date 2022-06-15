<?php
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $HOST = "localhost";
    $USERNAME = "root";
    $PASSWORD = "";
    $DBNAME = "beautyplus";

    $con = new mysqli($HOST, $USERNAME, $PASSWORD, $DBNAME);
    if($con->connect_error){
        die("ket noi that bai".$conn->connect_error);
    }

    $sql = "SELECT * FROM news";
    $rs = mysqli_query($con,$sql);

    $response = array();
    $count = 0;
    while($row = mysqli_fetch_assoc($rs)){
      array_push($response,$row);
    }
   
    echo json_encode($response);

    mysqli_close($con);

?>