<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}
include_once('connectDB.php');
?>
<!DOCTYPE html>
<html lang="vn">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cap nhat don hang</title>
    <link rel="stylesheet" href="./index.css">
    <script src="./lib/jquery-3.6.0.min.js"></script>
    <script src="./lib/jquery-ui.min.js"></script>
    <script src="./js/navbar.js"></script>
    <script src="./js/dialouge.js"> </script>
    <script src="./index.js"></script>
</head>

<body>
<?php
        // lấy thông tin hoa don cần sửa
        $id = $_GET['id'];
        $sql = "SELECT * FROM bill WHERE id=$id";
        $rs = $conn->query($sql)->fetch_assoc();
        $user_id = $rs['user_id'];
        $created = $rs['created'];
        $total = $rs['total'];
        $status = $rs['status'];
        $name = $rs['name'];
        $address = $rs['address'];
        $phone = $rs['phone'];
        $email = $rs['email'];
        $note = $rs['note'];
    ?>

    <div class="container">
        <div class="navbar stick-navbar">
            <div class="m-logo">
                <button></button>
                <button> </button>
            </div>

            <div class="menu-item-list scroll-bar"></div>
        </div>
        <div class="main" style="width: 624px;">
            <?php include('header.php') ?>
            

            <div class="content">
                <div class="title-distance" style="width: 611.594px;">
                    <div class="title">cập nhật đơn hàng</div>
                </div>

                <!-- form them danh muc -->
                <form action="updateBill.php" method="POST">
                    <div>
                        <div class="add-emoloyee-form ui-draggable ui-draggable-handle" style="position: relative;">
                            <div class="m-form-header r-flex h-pointer">
                                <div class="m-form-menu">
                                    Thông tin đơn hàng
                                </div>
                            </div>
                            <div class="m-form-content">
                                <div>
                                    <div class="m-news-input">
                                        <label for="">ID</label>
                                        <input name="id" type="text" value="<?=$id?>" readonly>
                                    </div>
                                    <div class="m-news-input">
                                        <label for="">mã tài khoản</label>
                                        <input name="user_id" type="text" value="<?=$user_id?>" readonly>
                                    </div>
                                    <div class="m-news-input">
                                        <label for="">ngày tạo</label>
                                        <input name="created" type="text" value="<?=$created?>" readonly>
                                    </div>
                                    <div class="m-news-input">
                                        <label for="">Tổng tiền</label>
                                        <input name="total" type="text" value="<?=$total?>" readonly>
                                    </div>
                                    <div class="m-news-input">
                                        <label for="">trạng thái</label>
                                        <select name="status">
                                            <option value="chưa xác nhận" <?php if($status=="chưa xác nhận") echo "selected" ?>>chưa xác nhận</option>
                                            <option value="chưa gửi" <?php if($status=="chưa gửi") echo "selected" ?>>chưa gửi</option>
                                            <option value="đang giao hàng" <?php if($status=="đang giao hàng") echo "selected" ?>>đang giao hàng</option>
                                            <option value="đã thanh toán" <?php if($status=="đã thanh toán") echo "selected" ?>>đã thanh toán</option>
                                            <option value="hoàn trả" <?php if($status=="hoàn trả") echo "selected" ?>>hoàn trả</option>
                                        </select>
                                    </div>
                                    
                                    <div class="m-news-input">
                                        <label for="">tên</label>
                                        <input name="name" type="text" value="<?=$name?>" >
                                    </div>
                                    <div class="m-news-input">
                                        <label for="">địa chỉ</label>
                                        <input name="address" type="text" value="<?=$address?>" >
                                    </div>
                                    <div class="m-news-input">
                                        <label for="">số dt</label>
                                        <input name="phone" type="text" value="<?=$phone?>" >
                                    </div>
                                    <div class="m-news-input">
                                        <label for="">email</label>
                                        <input name="email" type="text" value="<?=$email?>" >
                                    </div>
                                    <div class="m-news-input">
                                        <label for="">ghi chú</label>
                                        <input name="note" type="text" value="<?=$note?>" >
                                    </div>
                                </div>
                            </div>

                            <div class="m-form-action">
                                <div class="m-news-add-action">
                                    <input class="m-news-save" type="submit" name="updateBill" value="Cập nhật">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $('.m-news-add').click(function() {
            $('.m-dialogue').show();
        })
    </script>
</body>

</html>