<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header('Location: login.php');
    }
    include_once('connectDB.php');
?>
<?php
    include_once('connectDB.php');
    //xử lí 
    if(isset($_POST['updateBill'])){
        $id = $_POST['id'];
        $user_id = $_POST['user_id'];
        $created = $_POST['created'];
        $total = $_POST['total'];
        $status = $_POST['status'];
        $name = $_POST['name'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $note = $_POST['note'];
        if(empty($name)||empty($address)||empty($phone)||empty($email)){
            echo "<script>
                alert(\"Thông tin người nhận không được để trống\");
                window.location = '././manageBill.php';
            </script>";
        }else{
            // insert data
            $sql = "UPDATE bill SET status='$status', name='$name', phone='$phone', address='$address', email='$email', note='$note' 
            WHERE id=$id";
            if($conn->query($sql)===TRUE){
                echo "<script>
                    alert(\"cập nhật thành công\");
                    window.location = '././manageBill.php';
                </script>";
            }else{
                echo "<script>
                    alert(\"Lỗi $conn->error\");
                    window.location = '././manageBill.php';
                </script>";
            }
        }
    }
?>