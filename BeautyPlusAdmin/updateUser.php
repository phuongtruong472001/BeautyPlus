<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header('Location: login.php');
    }
    include_once('connectDB.php');
?>
<?php
    include_once('connectDB.php');
    //sử lí sửa tài khoản
    if(isset($_POST['updateUser'])){
        $id = $_POST['id'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
        if(strcmp($password, $confirmPassword) != 0){
            echo "<script>
                alert(\"Lỗi: nhập lại mật khẩu không đúng\");
                window.location = '././manageUser.php';
            </script>";
        }else{
            // insert data
            $sql = "UPDATE user SET address='$address', phone='$phone', fullname='$fullname', email='$email', password='$password' WHERE id=$id";
            if($conn->query($sql)===TRUE){
                echo "<script>
                    alert(\"cập nhật thành công\");
                    window.location = '././manageUser.php';
                </script>";
            }else{
                echo "<script>
                    alert(\"Lỗi $conn->error\");
                    window.location = '././manageUser.php';
                </script>";
            }
        }
        
        
    }
?>