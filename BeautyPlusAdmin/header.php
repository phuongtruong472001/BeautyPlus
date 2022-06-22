<div class="header">
    <form action="updateUserForm.php?username=<?= $_SESSION['username']?>" method="POST">
        <button type="submit" name="updateUserAdmin" style="position: absolute; right: 120px">sửa thông tin</button>
    </form>
    <form action="header.php" method="POST">
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