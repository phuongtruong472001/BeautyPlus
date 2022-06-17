<?php
    include_once('connectDB.php');
    if(isset($_POST['addCategory'])){
        $name = $_POST['name'];
        $description = $_POST['description'];

        if(empty($name)){
            echo "<script>
                alert(\"Tên danh mục không được để trống\");
                window.location = '././manageCategory.php';
            </script>";
        }else{
            // insert data
            $sql = "INSERT INTO category (name, description)
            VALUES ('$name', '$description')";
            if($conn->query($sql)===TRUE){
                echo "<script>
                    alert(\"Tạo danh mục mới thành công\");
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