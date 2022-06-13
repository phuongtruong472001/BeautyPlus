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
</body>
</html>