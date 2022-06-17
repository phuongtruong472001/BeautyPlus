<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}
include_once('connectDB.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./index.css">
    <script src="./lib/jquery-3.6.0.min.js"></script>
    <script src="./lib/jquery-ui.min.js"></script>
    <script src="./js/navbar.js"></script>
    <script src="./js/dialouge.js"> </script>
    <script src="./index.js"></script>
</head>

<body>
    <?php
    // lấy thông tin tài khoản cần sửa
    $id = $_GET['id'];
    $sql = "SELECT * FROM user WHERE id=$id";
    $rs = $conn->query($sql)->fetch_assoc();
    $username = $rs['username'];
    $fullname = $rs['fullname'];
    $address = $rs['address'];
    $phone = $rs['phone'];
    $email = $rs['email'];
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
            <div class="header">
                <div class="h-bars">
                    <div></div>
                </div>
                <div class="h-brands">
                    <div class="h-brand-name">
                        <p>BEAUTY PLUS</p>
                    </div>
                    <div class="h-dropdown">
                        <div></div>
                    </div>
                </div>
                <div>
                    <div class="h-current-db">
                        <div class="icon-header-current-db"></div>
                        <div class="header-current-db-name">DC-02</div>
                    </div>
                </div>
                <div class="download-process">
                    <div class="icon-download-process">

                    </div>
                </div>
                <div class="h-search">

                    <div class="m-icon-input">
                        <div></div>
                        <input placeholder="Nhập từ khoá tìm kiểm" type="text" class="h-input m-input">
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="title-distance" style="width: 611.594px;">
                    <div class="title">Sửa tài khoản</div>
                </div>

                <!-- form them bai viet -->
                <form action="updateUser.php" method="POST">
                    <div>
                        <div class="add-emoloyee-form ui-draggable ui-draggable-handle" style="position: relative;">
                            <div class="m-form-header r-flex h-pointer">
                                <div class="m-form-menu">
                                    Thông tin tài khoản
                                </div>
                                <div class="m-form-close">
                                    <div class="md-close">
                                        <div class="md-close-icon"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="m-form-content">
                                <div>
                                    <div class="m-news-input">
                                        <label for="">iD</label>
                                        <input name="id" type="text" value="<?=$id?>" readonly>
                                    </div>
                                    <div class="m-news-input">
                                        <label for="">Tên đăng nhập</label>
                                        <input name="username" type="text" value="<?=$username?>" readonly>
                                    </div>
                                    <div class="m-news-input">
                                        <label for="">Họ tên</label>
                                        <input name="fullname" type="text" value="<?=$fullname?>">
                                    </div>
                                    <div class="m-news-input">
                                        <label for="">Địa chỉ</label>
                                        <input name="address" type="text" value="<?=$address?>">
                                    </div>
                                    <div class="m-news-input">
                                        <label for="">Số điện thoại</label>
                                        <input name="phone" type="text" value="<?=$phone?>">
                                    </div>
                                    <div class="m-news-input">
                                        <label for="">Email</label>
                                        <input name="email" type="text" value="<?=$email?>">
                                    </div>
                                </div>
                            </div>

                            <div class="m-form-action">
                                <div class="m-news-add-action">
                                    <input class="m-news-save" type="submit" name="updateUser" value="Sửa">
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