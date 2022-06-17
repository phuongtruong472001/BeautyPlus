<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header('Location: login.php');
    }
    include_once('connectDB.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        // lấy thông tin tài khoản cần sửa
        $id = $_GET['id'];
        $sql = "SELECT * FROM user WHERE id=$id";
        $rs = $conn->query($sql)->fetch_assoc();
        $username = $rs['username'];
        $fullname = $rs['fullname'];
        $address = $rs['address'];
        $phone = $rs['phone'];
        $email = $rs['email'];
    ?>
    <h2>Sửa thông tin tài khoản</h2>
    <form action="updateUser.php" method="POST">
        ID: <br>
        <input type="text" name="id" value="<?=$id?>" readonly><br>
        username: <br>
        <input type="text" name="username" value="<?=$username?>" readonly><br>
        Họ tên: <br>
        <input type="text" name="fullname" value="<?=$fullname?>"> <br>
        Địa chỉ: <br>
        <input type="text" name="address" value="<?=$address?>"> <br>
        Số điện thoại: <br>
        <input type="text" name="phone" value="<?=$phone?>"><br>
        Email: <br>
        <input type="email" name="email" value="<?=$email?>"> <br>
        <br>
        <input type="submit" name="updateUser" value="sửa">
    </form>
</body>
</html>