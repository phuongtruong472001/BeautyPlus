<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header('Location: login.php');
    }
    include_once('connectDB.php');
?>
<?php
    include_once('connectDB.php');
    if(isset($_POST['addUser'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $confirmPassword = $_POST['confirmPassword'];
        if(empty($username) || empty($password) || empty($confirmPassword)){
            echo "<script>
                alert(\"Tài khoản và mật khẩu không được để trống\");
                window.location = '././manageUser.php';
            </script>";
        }elseif(strcmp($password, $confirmPassword) != 0){
            echo "<script>
                alert(\"Nhập lại mật khẩu không đúng\");
                window.location = '././manageUser.php';
            </script>";
        }else{
            // insert data
            $sql = "INSERT INTO user (role, username, password, address, phone, fullname, email)
            VALUES ('admin', '$username', '$password', '$address', '$phone', '$fullname', '$email')";
            if($conn->query($sql)===TRUE){
                echo "<script>
                    alert(\"Tạo tài khoản mới thành công\");
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