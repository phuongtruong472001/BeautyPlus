<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header('Location: login.php');
    }
?>
<html>
<head>
	<title>trang admin</title>
	<meta charset="utf-8">
</head>
<body>
	<?php
        include_once("header.php"); 
        echo $_SESSION['username']; 
    ?>
    <br>
    <a href="manageUser.php">Quan ly tai khoan</a><br>
    <a href="manageCategory.php">Quan ly danh muc</a><br>
    <a href="manageProduct.php">Quan ly san pham</a><br>
</body>
</html>