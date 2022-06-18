<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header('Location: login.php');
    }
    include_once('connectDB.php');
?>
<?php
    include_once('connectDB.php');
    $id = $_GET['id'];
    // insert data
    $sql = "DELETE FROM image WHERE id=$id";
    if($conn->query($sql)===TRUE){
        echo "<script>
            alert(\"xóa thành công\");
            window.location = '././manageProduct.php';
        </script>";
    }else{
        echo "<script>
            alert(\"Lỗi $conn->error\");
            window.location = '././manageProduct.php';
        </script>";
    }
?>