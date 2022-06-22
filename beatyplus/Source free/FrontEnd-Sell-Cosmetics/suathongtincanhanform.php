<?php
session_start();
include(".\assets\php\connect.php");
$username = $_SESSION['username'];
$sql = "SELECT * FROM user WHERE username = '$username'";
$rs = mysqli_query($conn, $sql);
$r = mysqli_fetch_assoc($rs);
?>
<!DOCTYPE html>
<html lang="vn">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="suathongtincanhan.css">
  <title>Sửa thông tin</title>
</head>

<body>
  <form action="xulysuatt.php" method="POST">
    <div class="container">
      <h1>Sửa thông tin cá nhân</h1>
      <hr>
      <label for="fullname"><b>Họ tên</b></label>
      <input type="text" name="fullname" value="<?= $r['fullname'] ?>" required>
      <br>
      <label for="phone"><b>Số điện thoại</b></label>
      <input type="text" name="phone" value="<?= $r['phone'] ?>" required>
      <br>
      <label for="username"><b>Tài khoản</b></label>
      <input type="text" name="username" value="<?= $r['username'] ?>" required readonly>
      <br>
      <label for="password"><b>Mật khẩu</b>
        <input type="password" name="password" value="<?= $r['password'] ?>" required>
      </label>
      <div class="clearfix">
        <button type="submit" class="signupbtn">Sửa</button>
        <a href="index.php"><button type="button" class="signupbtn">Hủy sửa</button></a>
      </div>
    </div>
  </form>
</body>

</html>