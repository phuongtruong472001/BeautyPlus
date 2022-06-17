<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header('Location: login.php');
    }
    include_once('connectDB.php');
?>
<?php
    include_once('connectDB.php');
    //xử lí sửa danh mục
    if(isset($_POST['updateCategory'])){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        if(empty($name)){
            echo "<script>
                alert(\"Tên danh mục không được để trống\");
                window.location = '././manageCategory.php';
            </script>";
        }else{
            // insert data
            $sql = "UPDATE category SET name='$name', description='$description' WHERE id=$id";
            if($conn->query($sql)===TRUE){
                echo "<script>
                    alert(\"cập nhật thành công\");
                    window.location = '././manageCategory.php';
                </script>";
            }else{
                echo "<script>
                    alert(\"Lỗi $conn->error\");
                    window.location = '././manageCategory.php';
                </script>";
            }
        }
    }
?>