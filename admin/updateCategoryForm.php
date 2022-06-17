<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header('Location: login.php');
    }
    include_once('connectDB.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        // lấy thông tin danh mục cần sửa
        $id = $_GET['id'];
        $sql = "SELECT * FROM category WHERE id=$id";
        $rs = $conn->query($sql)->fetch_assoc();
        $name = $rs['name'];
        $description = $rs['description'];
    ?>
    <h2>Sửa thông tin danh mục</h2>
    <form action="updateCategory.php" method="POST">
        ID: <br>
        <input type="text" name="id" value="<?=$id?>" readonly><br>
        Tên: <br>
        <input type="text" name="name" value="<?=$name?>"><br>
        Mô tả: <br>
        <input type="text" name="description" value="<?=$description?>">
        <br>
        <input type="submit" name="updateCategory" value="sửa">
    </form>
</body>
</html>