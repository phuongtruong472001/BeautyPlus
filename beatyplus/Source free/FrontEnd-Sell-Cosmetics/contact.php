<?php
session_start(); ?>
<!DOCTYPE html>
<html lang="vn">
<!-- https://cocoshop.vn/ -->
<!-- http://mauweb.monamedia.net/vanihome/ -->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh Toán</title>
    <!-- Font roboto -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Icon fontanwesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- Reset css & grid sytem -->
    <link rel="stylesheet" href="./assets/css/library.css">
    <!-- Owl Slider css -->
    <link rel="stylesheet" href="assets/owlCarousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/owlCarousel/assets/owl.theme.default.min.css">
    <!-- Layout -->
    <link rel="stylesheet" href="./assets/css/common.css">
    <!-- index -->
    <link rel="stylesheet" type="text/css" href="./assets/css/contact.css">
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Owl caroucel Js-->
    <script src="assets/owlCarousel/owl.carousel.min.js"></script>
    <style>
        .black-color {
            color: #9e5bab !important;
        }

        .black-color:hover {
            color: green !important;
        }
    </style>
</head>

<body>
    <div class="header scrolling" id="myHeader">
        <div class="grid wide">
            <div class="header__top">
                <div class="navbar-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <a href="index.html" class="header__logo">
                    <img src="./assets/logo.png" alt="">
                </a>
                <div class="header__search">
                    <form id="myform" method="POST" action="timkiem.php">
                        <div class="header__search-wrap">
                            <input type="text" class="header__search-input" placeholder="Tìm kiếm" name="search">
                            <!-- <a class="header__search-icon" href="">
                                <i class="fas fa-search"></i>
                            </a> -->
                            <a class="header__search-icon" href="javascript:void()" onclick="document.getElementById('myform').submit();">
                                <i class="fas fa-search"></i>
                            </a>
                        </div>
                    </form>
                </div>
                <div class="header__account">
                    <?php
                    if (isset($_SESSION['username']) && $_SESSION['username']) {
                        include(".\assets\php\connect.php");
                        $x = $_SESSION['username'];
                        $sql = "select * from user where username ='$x'";
                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();
                    ?>

                        <div class="header__cart have black-color"><a class="footer__link black-color"><?php echo $row["fullname"] ?></a>
                            <!-- --------------------menu doc----------------- -->
                            <div class="header__cart-wrap">
                                <div class="total-money"><a href="suathongtincanhanform.php">Sửa thông tin</a></div>
                                <div class="total-money"><a href="hoadon.php">Lịch sử mua hàng</a></div>
                                <div class="total-money"><a href="xulydangxuat.php">Đăng xuất</a></div>


                            </div>
                        </div>

                    <?php } else { ?>
                        <a href="#my-Login" class="header__account-login">Đăng Nhập</a>
                        <a href="#my-Register" class="header__account-register">Đăng Kí</a>
                    <?php } ?>
                </div>
                <!-- Cart -->
                <div class="header__cart have" href="#">
                    <?php
                    if ((isset($_SESSION['username']) && $_SESSION['username'])) {
                        include(".\assets\php\connect.php");
                        $x = $_SESSION['username'];
                        $sql = "select * from user where username= '$x'";
                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();
                        $user_id = $row['id'];
                        $sql = "select * from cart where user_id=$user_id";
                        $result = $conn->query($sql);

                    ?>
                        <i class="fas fa-shopping-basket"></i>
                        <div class="header__cart-amount">
                            <?php echo $result->num_rows ?>
                        </div>
                        <div class="header__cart-wrap">
                            <ul class="order__list">
                                <?php
                                include(".\assets\php\connect.php");


                                $sql = "select * from cart where user_id=$user_id";
                                $result = $conn->query($sql);
                                $sum = 0;
                                while ($row = $result->fetch_assoc()) {
                                    $ID = $row['product_id'];
                                    $sql1 = "select * from cart inner join product where id=$ID";
                                    $result1 = $conn->query($sql1);
                                    $row1 = $result1->fetch_assoc();
                                    $ThanhTien = $row['quantity'] * $row1['price'];
                                    $sum += $ThanhTien;
                                ?>
                                    <li class="item-order">
                                        <div class="order-wrap">
                                            <?php
                                            $sql2 = "select * from image where product_id=$ID ";
                                            $result2 = $conn->query($sql2);
                                            $row2 = $result2->fetch_assoc(); ?>
                                            <a href="product.php?id=<?= $row1["id"] ?>" class="order-img">

                                                <img src="<?php echo $row2['link'] ?>" alt="">
                                            </a>
                                            <div class="order-main">
                                                <a href="product.php?id=<?= $row1["id"] ?>" class="order-main-name"> <?php echo $row1["name"] ?></a>
                                                <div class="order-main-price"><?php echo $row["quantity"] ?> x <?php echo number_format($row1["price"]) ?> ₫</div>
                                            </div>
                                            <a href="product.php?id=<?= $row1["id"] ?>" class="order-close"><i class="far fa-times-circle"></i></a>
                                        </div>

                                    </li>
                                <?php } ?>

                            </ul>
                            <div class="total-money">Tổng cộng: <?php echo number_format($sum) ?></div>
                            <a href="cart.php" class="btn btn--default cart-btn">Xem giỏ hàng</a>
                            <a href="pay.php" class="btn btn--default cart-btn orange">Thanh toán</a>
                        </div>
                    <?php } else { ?>
                        <i class="fas fa-shopping-basket"></i>
                        <div class="header__cart-amount">
                            <a href="#my-Login"> 0</a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <!-- Menu -->
        <div class="header__nav">
            <ul class="header__nav-list">
                <li class="header__nav-item nav__search">
                    <div class="nav__search-wrap">
                        <input class="nav__search-input" type="text" name="" id="" placeholder="Tìm sản phẩm...">
                    </div>
                    <div class="nav__search-btn">
                        <i class="fas fa-search"></i>
                    </div>
                </li>
                <li class="header__nav-item authen-form">
                    <a href="#" class="header__nav-link">Tài Khoản</a>
                    <ul class="sub-nav">
                        <li class="sub-nav__item">
                            <a href="#my-Login" class="sub-nav__link">Đăng Nhập</a>
                        </li>
                        <li class="sub-nav__item">
                            <a href="#my-Register" class="sub-nav__link">Đăng Kí</a>
                        </li>
                    </ul>
                </li>
                <li class="header__nav-item index">
                    <a type="submit" href="index.php" class="header__nav-link active">Trang chủ</a>

                </li>
                <li class="header__nav-item">
                    <a href="index.php" class="header__nav-link">Giới Thiệu</a>
                </li>
                <li class="header__nav-item">
                    <a href="listProduct.php" class="header__nav-link ">Sản Phẩm</a>
                    <div class="sub-nav-wrap grid wide">
                        <ul class="sub-nav">
                            <?php
                            include(".\assets\php\connect.php");
                            $sql1 = " select * from category";
                            $result = $conn->query($sql1);
                            while ($row = $result->fetch_assoc()) { ?>

                                <li class="sub-nav__item">
                                    <a href="listProduct.php?id=<?= $row["id"] ?>" class="sub-nav__link"><?php echo $row["name"] ?></a>
                                </li>

                            <?php } ?>
                        </ul>

                    </div>
                </li>
                <li class="header__nav-item">
                    <a href="news.php" class="header__nav-link active">Tin Tức</a>
                </li>
                <li class="header__nav-item">
                    <a href="contact.php" class="header__nav-link">Liên Hệ</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="main">
        <div class="grid wide">
            <div class="main__breadcrumb">
                <div class="breadcrumb__item">
                    <a href="#" class="breadcrumb__link">Trang chủ</a>
                </div>
                <div class="breadcrumb__item">
                    <a href="#" class="breadcrumb__link">Giới thiệu</a>
                </div>
            </div>
            <div class="row">
                <div class="col l-6 m-12 s-12">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d3738.382986183426!2d106.33761211423521!3d20.449457212678926!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1zbmfhu41jIMOhbmggY29zbWV0aWNz!5e0!3m2!1svi!2s!4v1621128017258!5m2!1svi!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
                <div class="col l-6 m-12 s-12">
                    <div class="contact__wrap">
                        <div class="contact__img">
                            <img src="http://mauweb.monamedia.net/vanihome/wp-content/uploads/2018/04/logo-mona.png" alt="">
                        </div>
                        <ul class="contact__info">
                            <li class="contact__text">
                                <i class="fas fa-map-marked-alt"></i> 319 C16 Lý Thường Kiệt, Phường 15, Quận 11, Tp.HCM
                            </li>
                            <li>
                                <a href="tel:076 922 0162" class="contact__link">
                                    <i class="fas fa-phone"></i> 076 922 0162
                                </a>
                                <a href="tel:076 922 0162" class="contact__link">
                                    &#8212; 076 922 0162
                                </a>
                            </li>

                            <li>
                                <a href="#" class="contact__link">
                                    <i class="fas fa-envelope"></i> phuonggiang150@gmail.com
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="about-us">
                        <div class="about-us__heading">Liên hệ với chúng tôi</div>
                        <div class="form__group">
                            <div>
                                <input type="text" value="Họ và tên">
                            </div>
                            <div>
                                <input type="text" value="Email">
                            </div>
                            <div>
                                <input type="text" value="Địa chỉ">
                            </div>
                            <div>
                                <input type="text" value="Số điện thoại">
                            </div>
                        </div>
                        <textarea name="" id="" cols="30" rows="5" placeholder="Lời nhắn"></textarea>
                        <button type="submit" class="btn btn--default">Gửi</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="footer">
        <div class="grid wide">
            <div class="row">
                <div class="col l-3 m-6 s-12">
                    <h3 class="footer__title">Menu</h3>
                    <ul class="footer__list">
                        <li class="footer__item">
                            <a href="#" class="footer__link">Trang điểm</a>
                        </li>
                        <li class="footer__item">
                            <a href="#" class="footer__link">Chăm sóc da</a>
                        </li>
                        <li class="footer__item">
                            <a href="#" class="footer__link">Chăm sóc tóc</a>
                        </li>
                        <li class="footer__item">
                            <a href="#" class="footer__link">Nước hoa</a>
                        </li>
                        <li class="footer__item">
                            <a href="#" class="footer__link">Chăm sóc toàn thân </a>
                        </li>
                    </ul>
                </div>
                <div class="col l-3 m-6 s-12">
                    <h3 class="footer__title">Hỗ trợ khách hàng</h3>
                    <ul class="footer__list">
                        <li class="footer__item">
                            <a href="#" class="footer__link">Hướng dẫn mua hàng</a>
                        </li>
                        <li class="footer__item">
                            <a href="#" class="footer__link">Giải đáp thắc mắc</a>
                        </li>
                        <li class="footer__item">
                            <a href="#" class="footer__link">Chính sách mua hàng</a>
                        </li>
                        <li class="footer__item">
                            <a href="#" class="footer__link">Chính sách đổi trả</a>
                        </li>
                    </ul>
                </div>
                <div class="col l-3 m-6 s-12">
                    <h3 class="footer__title">Liên hệ</h3>
                    <ul class="footer__list">
                        <li class="footer__item">
                            <span class="footer__text">
                                <i class="fas fa-map-marked-alt"></i> 319 C16 Lý Thường Kiệt, Phường 15, Quận 11, Tp.HCM
                            </span>
                        </li>
                        <li class="footer__item">
                            <a href="#" class="footer__link">
                                <i class="fas fa-phone"></i> 076 922 0162
                            </a>
                        </li>
                        <li class="footer__item">
                            <a href="#" class="footer__link">
                                <i class="fas fa-envelope"></i> phuonggiang150@gmail.com
                            </a>
                        </li>
                        <li class="footer__item">
                            <div class="social-group">
                                <a href="#" class="social-item"><i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="social-item"><i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="social-item"><i class="fab fa-pinterest-p"></i>
                                </a>
                                <a href="#" class="social-item"><i class="fab fa-invision"></i>
                                </a>
                                <a href="#" class="social-item"><i class="fab fa-youtube"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col l-3 m-6 s-12">
                    <h3 class="footer__title">Đăng kí</h3>
                    <ul class="footer__list">
                        <li class="footer__item">
                            <span class="footer__text">Đăng ký để nhận được được thông tin ưu đãi mới nhất từ chúng tôi.</span>
                        </li>
                        <li class="footer__item">
                            <div class="send-email">
                                <input class="send-email__input" type="email" placeholder="Nhập Email...">
                                <a href="#" class="send-email__link">
                                    <i class="fas fa-paper-plane"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="copyright">
            <span class="footer__text"> &copy Bản quyền thuộc về <a class="footer__link" href="#"> Phương Giang</a></span>
        </div>
    </div>
    <!-- Modal Form -->
    <div class="ModalForm">
        <div class="modal" id="my-Register">
            <a href="#" class="overlay-close"></a>
            <div class="authen-modal register">
                <h3 class="authen-modal__title">Đăng Kí</h3>
                <div class="form-group">
                    <label for="account" class="form-label">Họ Tên</label>
                    <input id="account" name="account" type="text" class="form-control">
                    <span class="form-message">Không hợp lệ !</span>
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">Tài khoản Email *</label>
                    <input id="password" name="password" type="text" class="form-control">
                    <span class="form-message"></span>
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">Mật khẩu *</label>
                    <input id="password" name="password" type="text" class="form-control">
                    <span class="form-message"></span>
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">Nhập lại mật khẩu *</label>
                    <input id="password" name="password" type="text" class="form-control">
                    <span class="form-message"></span>
                </div>
                <div class="authen__btns">
                    <div class="btn btn--default">Đăng Kí</div>
                </div>
            </div>
        </div>
        <div class=" modal" id="my-Login">
            <a href="#" class="overlay-close"></a>
            <div class="authen-modal login">
                <h3 class="authen-modal__title">Đăng Nhập</h3>
                <div class="form-group">
                    <label for="account" class="form-label">Địa chỉ email *</label>
                    <input id="account" name="account" type="text" class="form-control">
                    <span class="form-message">Tài khoản không chính xác !</span>
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">Mật khẩu *</label>
                    <input id="password" name="password" type="text" class="form-control">
                    <span class="form-message"></span>
                </div>
                <div class="authen__btns">
                    <div class="btn btn--default">Đăng Nhập</div>
                    <input type="checkbox" class="authen-checkbox">
                    <label class="form-label">Ghi nhớ mật khẩu</label>
                </div>
                <a class="authen__link">Quên mật khẩu ?</a>
            </div>
        </div>
        <div class="up-top" id="upTop" onclick="goToTop()">
            <i class="fas fa-chevron-up"></i>
        </div>

    </div>
    <!-- Sccipt for owl caroucel -->

    <!-- Script common -->
    <script src="./assets/js/commonscript.js"></script>


</body>

</html>