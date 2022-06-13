<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="header.php" method="POST">
        <input type="submit" name="logout" value="Đăng xuất">
    </form>
    <?php
        require_once("connectDB.php");
        if(isset($_POST['logout'])){
            unset($_SESSION['username']);
            header('Location: login.php');
        }
    ?>
</body>
</html>