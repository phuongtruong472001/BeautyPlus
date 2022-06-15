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

    

    $TITLE=$_POST['title'];
    $CONTENT=$_POST['content'];
    $AUTHOR=$_POST['author'];

    $sql = "INSERT INTO  news(title,content,author) VALUES('$TITLE','$CONTENT','$AUTHOR')";
    $res=mysqli_query($con,$sql);
    

    
    if ($res && mysqli_affected_rows($con) > 0){
        echo true;
    }
    else echo false;

    mysqli_close($con);
?>