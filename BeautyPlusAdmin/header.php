<div class="header">
    <form action="header.php" method="POST">
        <!-- <input type="submit" name="logout" value="Đăng xuất"> -->
        <button type="submit" name="logout" style="position: absolute; right: 20px">Đăng xuất</button>
    </form>
</div>
<?php
    require_once("connectDB.php");
    if(isset($_POST['logout'])){
        unset($_SESSION['username']);
        header('Location: login.php');
    }
?>