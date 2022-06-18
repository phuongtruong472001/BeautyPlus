<?php
include(".\assets\php\connect.php");

$fullname = $_POST['fullname'];
$phone = $_POST['phone'];
$username = $_POST['username'];
$password = $_POST['password'];

$sql = "UPDATE user SET fullname='$fullname',
phone=$phone,
password='$password' WHERE username='$username'";
 $result = $conn->query($sql);
 if($result){
    header("Location:index.php");
 }
else{
    echo "Sửa thất bại";
}
// include('index.php');
?>