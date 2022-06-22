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
    <title>Danh sách sản phẩm</title>
    <!-- Font roboto -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Icon fontanwesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- Reset css & grid sytem -->
    <link rel="stylesheet" href="./assets/css/library.css">
    <link href="./assets/owlCarousel/assets/owl.carousel.min.css" rel="stylesheet" />
    <!-- Layout -->
    <link rel="stylesheet" href="./assets/css/common.css">
    <!-- index -->
    <link href="./assets/css/home.css" rel="stylesheet" />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Owl caroucel Js-->
    <script src="./assets/owlCarousel/owl.carousel.min.js"></script>
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
                    <!-- norcart -->
                    <!-- <img class="header__cart-img-nocart" src="http://www.giaybinhduong.com/images/empty-cart.png" alt=""> -->

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
                                    <a href="listProduct.php?id=<?=$row["id"]?> " class="sub-nav__link"><?php echo $row["name"] ?></a>
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
        <!-- Slider -->
        <div class="main__slice">
            <div class="slider">
                <div class="slide active" style="background-image:url(./assets/img/slider/slide-6.jpg)">
                    <div class="container">
                        <div class="caption">
                            <h1>Giảm giá 30%</h1>
                            <p>Giảm giá cực sốc trong tháng 6!</p>
                            <a href="listProduct.html" class="btn btn--default">Xem ngay</a>

                        </div>
                    </div>
                </div>
                <div class="slide active" style="background-image:url(./assets/img/slider/slide-4.jpg)">
                    <div class="container">
                        <div class="caption">
                            <h1>Giảm giá 30%</h1>
                            <p>Giảm giá cực sốc trong tháng 6!</p>
                            <a href="listProduct.html" class="btn btn--default">Xem ngay</a>

                        </div>
                    </div>
                </div>
                <div class="slide active" style="background-image:url(./assets/img/slider/slide-5.jpg)">
                    <div class="container">
                        <div class="caption">
                            <h1>Giảm giá 30%</h1>
                            <p>Giảm giá cực sốc trong tháng 6!</p>
                            <a href="listProduct.html" class="btn btn--default">Xem ngay</a>

                        </div>
                    </div>
                </div>
            </div>
            <!-- controls  -->
            <div class="controls">
                <div class="prev">
                    <i class="fas fa-chevron-left"></i>
                </div>
                <div class="next">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </div>
            <!-- indicators -->
            <div class="indicator">
            </div>
        </div>
        <!--Product Category -->
        <div class="main__tabnine">
            <div class="grid wide">
                <!-- Tab items -->
                <div class="tabs">
                    <div class="tab-item active">
                        Bán Chạy
                    </div>
                </div>
                <!-- Tab content -->
                <div class="tab-content">
                    <div class="tab-pane active">
                        <div class="row">
                            <?php
                            include(".\assets\php\connect.php");
                            $sql1 = " select * from product";
                            $result = $conn->query($sql1);
                            while ($row = $result->fetch_assoc()) {
                                $ID = $row["id"];

                            ?>
                                <div class="col l-2 m-4 s-6">
                                    <div class="product">
                                        <?php
                                        $sql2 = "select * from image where product_id=$ID ";
                                        $result2 = $conn->query($sql2);
                                        $row2 = $result2->fetch_assoc(); ?>
                                        <div class="product__avt" style="background-image: url(<?php echo $row2['link'] ?>);">
                                        </div>
                                        <div class="product__info">
                                            <h3 class="product__name"><?php echo $row["name"] ?></h3>
                                            <div class="product__price">
                                                <div class="price__old">
                                                    <?php echo number_format($row["price"]) ?>
                                                </div>
                                                <div class="price__new"><?php echo number_format($row["price"] * (100 - $row["disscount"]) / 100) ?> <span class="price__unit">đ</span></div>
                                            </div>
                                            <div class="product__sale">
                                                <span class="product__sale-percent"><?php echo $row["disscount"]  ?>%</span>
                                                <span class="product__sale-text">Giảm</span>
                                            </div>
                                        </div>
                                        <a class="viewDetail" href="product.php?id=<?= $row["id"] ?>">Chi tiết</a>

                                    </div>
                                </div>
                            <?php } ?>
                        </div>

                    </div>
                    <!-- HightLight  -->
                    <div class="main__frame">
                        <div class="grid wide">
                            <h3 class="category__title">Ngọc Ánh Cometics</h3>
                            <h3 class="category__heading">SẢN PHẨM NỔI BẬT</h3>
                            <div class="row">
                                <?php
                                include(".\assets\php\connect.php");
                                $sql1 = " select * from product";
                                $result = $conn->query($sql1);
                                while ($row = $result->fetch_assoc()) {
                                    $ID = $row["id"];
                                ?>
                                    <div class="col l-2 m-4 s-6">
                                        <div class="product">
                                            <?php
                                            $sql2 = "select * from image where product_id=$ID ";
                                            $result2 = $conn->query($sql2);
                                            $row2 = $result2->fetch_assoc(); ?>
                                            <div class="product__avt" style="background-image: url(<?php echo $row2['link'] ?>);">
                                            </div>
                                            <div class="product__info">
                                                <h3 class="product__name"><?php echo $row["name"] ?></h3>
                                                <div class="product__price">
                                                    <div class="price__old">
                                                        <?php echo number_format($row["price"]) ?>
                                                    </div>
                                                    <div class="price__new"><?php echo number_format($row["price"] * (100 - $row["disscount"]) / 100) ?> <span class="price__unit">đ</span></div>
                                                </div>
                                                <div class="product__sale">
                                                    <span class="product__sale-percent"><?php echo $row["disscount"]  ?>%</span>
                                                    <span class="product__sale-text">Giảm</span>
                                                </div>
                                            </div>
                                            <a class="viewDetail" href="product.php?id=<?= $row["id"] ?>">chi tiết</a>
                                            <!-- <a href="cart.php?ID=<?= $row["id"] ?>" class="addToCart">Thêm vào giỏ</a> -->

                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <!-- Sales Policy -->
                        <div class="main__policy">
                            <div class="row">
                                <div class="col l-3 m-6">
                                    <div class="policy bg-1">
                                        <img src="./assets/img/policy/policy1.png" class="policy__img"></img>
                                        <div class="policy__info">
                                            <h3 class="policy__title">GIAO HÀNG MIỄN PHÍ</h3>
                                            <p class="policy__description">Cho đơn hàng từ 300K</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col l-3 m-6">
                                    <div class="policy bg-2">
                                        <img src="./assets/img/policy/policy2.png" class="policy__img"></img>
                                        <div class="policy__info">
                                            <h3 class="policy__title">ĐỔI TRẢ HÀNG</h3>
                                            <p class="policy__description">Trong 3 ngày đầu tiên</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col l-3 m-6">
                                    <div class="policy bg-1">
                                        <img src="./assets/img/policy/policy3.png" class="policy__img"></img>
                                        <div class="policy__info">
                                            <h3 class="policy__title">HÀNG CHÍNH HÃNG</h3>
                                            <p class="policy__description">Cam kết chất lượng</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col l-3 m-6">
                                    <div class="policy bg-2">
                                        <img src="./assets/img/policy/policy4.png" class="policy__img"></img>
                                        <div class="policy__info">
                                            <h3 class="policy__title">TƯ VẤN 24/24</h3>
                                            <p class="policy__description">Giải đáp mọi thắc mắc</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- News -->
                        <div class="main__frame bg-3">
                            <div class="grid wide">
                                <h3 class="category__title">Ngọc Ánh Cometics</h3>
                                <h3 class="category__heading">Tin Tức</h3>
                                <div class="owl-carousel news owl-theme">

                                    <?php
                                    include(".\assets\php\connect.php");
                                    $sql = "select * from news ";
                                    $result = $conn->query($sql);
                                    while ($row = $result->fetch_assoc()) {
                                        $ID=$row["id"];
                                    ?>
                                        <a href="news.php" class="news">
                                            <?php
                                            $sql2 = "select * from image where news_id =$ID ";
                                            $result2 = $conn->query($sql2);
                                            $row2 = $result2->fetch_assoc(); ?>
                                            <!-- <div class="product__avt" style="background-image: url(<?php echo $row2['link'] ?>);">
                                            </div> -->
                                            <div class="news__img">
                                                <img src="<?php echo $row2['link'] ?>" alt="">
                                            </div>
                                            <div class="news__body">
                                                <h3 class="news__body-title"><?php echo $row["title"] ?></h3>
                                                <div class="new__body-date"><?php echo $row["created"] ?></div>
                                                <p class="news__description">
                                                    <?php echo $row["content"] ?> </p>
                                            </div>
                                        </a>

                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="main__bands">
                            <div class="grid wide">
                                <div class="owl-carousel bands">
                                    <a href="listProduct.html" class="band__item" style="background-image: url(./assets/img/band/band1.png)"></a>
                                    <a href="listProduct.html" class="band__item" style="background-image: url(./assets/img/band/band2.png)"></a>
                                    <a href="listProduct.html" class="band__item" style="background-image: url(./assets/img/band/band3.png)"></a>
                                    <a href="listProduct.html" class="band__item" style="background-image: url(./assets/img/band/band4.png)"></a>
                                    <a href="listProduct.html" class="band__item" style="background-image: url(./assets/img/band/band5.png)"></a>
                                    <a href="listProduct.html" class="band__item" style="background-image: url(./assets/img/band/band6.png)"></a>
                                    <a href="listProduct.html" class="band__item" style="background-image: url(./assets/img/band/band7.png)"></a>
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
                        <div class=" modal" id="myedit">
                            <a href="#" class="overlay-close"></a>
                            <div class="authen-modal register">
                                <form method="POST" action="suathongtincanhan.php">
                                    <h3 class="authen-modal__title">Chỉnh sửa thông tin cá nhân</h3>
                                    <?php
                                    include(".\assets\php\connect.php");
                                    $username = $_SESSION['username'];
                                    $sql = "SELECT * FROM user WHERE username = '$username'";
                                    $rs = mysqli_query($con, $sql);
                                    $r = mysqli_fetch_assoc($rs);
                                    ?>
                                    <div class="form-group">
                                        <label for="account" class="form-label">Họ tên</label>
                                        <input type="text" name="fullname" value="<?= $r['fullname'] ?>">

                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="form-label">Số điện thoại </label>
                                        <input type="text" name="phone" id="txtPhone" value="<?= $r['phone'] ?>">

                                    </div>
                                    <div class="form-group">
                                        <label for="account" class="form-label">Tài khoản</label>
                                        <input type="text" name="username" id="txtUsername" value="<?= $r['username'] ?>">

                                    </div>

                                    <div class="form-group">
                                        <label for="password" class="form-label">Mật khẩu </label>
                                        <input type="text" name="password" id="txtPassword" value="<?= $r['password'] ?>">
                                        <span class="form-message"></span>
                                    </div>

                                    <button>
                                        <div class="btn btn--default">Thay đổi</div>
                                    </button>


                                </form>
                            </div>
                        </div>
                        <div class="modal" id="my-Register">
                            <a href="#" class="overlay-close"></a>
                            <div class="authen-modal register">
                                <form method="POST" action="xulydangki.php">
                                    <h3 class="authen-modal__title">Đăng Kí</h3>
                                    <div class="form-group">
                                        <label for="account" class="form-label">Họ Tên</label>
                                        <input id="account" name="txtFullname" type="text" class="form-control">
                                        <span class="form-message">Không hợp lệ !</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="form-label">Số điện thoại *</label>
                                        <input id="password" name="txtPhone" type="text" class="form-control">
                                        <span class="form-message"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="account" class="form-label">Tài khoản</label>
                                        <input id="account" name="txtUsername" type="text" class="form-control">
                                        <span class="form-message">Không hợp lệ !</span>
                                    </div>

                                    <div class="form-group">
                                        <label for="password" class="form-label">Mật khẩu *</label>
                                        <input id="password" name="txtPassword" type="password" class="form-control">
                                        <span class="form-message"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="form-label">Nhập lại mật khẩu *</label>
                                        <input id="password" name="cfpassword" type="password" class="form-control">
                                        <span class="form-message"></span>
                                    </div>
                                    <button>Đăng Kí</button>

                                </form>
                            </div>
                        </div>
                        <div class=" modal" id="my-Login">
                            <a href="#" class="overlay-close"></a>
                            <div class="authen-modal login">
                                <form action="xulydangnhap.php" method="POST">
                                    <h3 class="authen-modal__title">Đăng Nhập</h3>
                                    <div class="form-group">
                                        <label for="account" class="form-label">Tài khoản *</label>
                                        <input id="account" name="txtUsername" type="text" class="form-control">
                                        <span class="form-message">Tài khoản không chính xác !</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="form-label">Mật khẩu *</label>
                                        <input id="password" name="txtPassword" type="password" class="form-control">
                                        <span class="form-message"></span>
                                    </div>
                                    <div class="authen__btns">
                                        <button name="login">
                                            <div class="btn btn--default">Đăng Nhập</div>
                                        </button>
                                        <input type="checkbox" class="authen-checkbox">
                                        <label class="form-label">Ghi nhớ mật khẩu</label>
                                    </div>
                                    <a class="authen__link">Quên mật khẩu ?</a>
                                </form>
                            </div>
                        </div>

                        <div class="up-top" id="upTop" onclick="goToTop()">
                            <i class="fas fa-chevron-up"></i>
                        </div>

                    </div>
                    <script>
                        $('.owl-carousel.hight').owlCarousel({
                            loop: true,
                            margin: 20,
                            nav: true,
                            dots: false,
                            autoplay: true,
                            autoplayTimeout: 3000,
                            autoplayHoverPause: true,
                            responsive: {
                                0: {
                                    items: 2
                                },
                                600: {
                                    items: 3
                                },
                                1000: {
                                    items: 5
                                }
                            }
                        })
                        $('.owl-carousel.news').owlCarousel({
                            loop: true,
                            margin: 20,
                            nav: true,
                            dots: false,
                            autoplay: true,
                            autoplayTimeout: 4000,
                            autoplayHoverPause: true,
                            responsive: {
                                0: {
                                    items: 1
                                },
                                600: {
                                    items: 1
                                },
                                1000: {
                                    items: 2
                                }
                            }
                        })
                        $('.owl-carousel.bands').owlCarousel({
                            loop: true,
                            margin: 20,
                            nav: false,
                            dots: false,
                            autoplay: true,
                            autoplayTimeout: 2000,
                            autoplayHoverPause: true,
                            responsive: {
                                0: {
                                    items: 2
                                },
                                600: {
                                    items: 3
                                },
                                1000: {
                                    items: 6
                                }
                            }
                        })
                    </script>
                    <!-- Script common -->
                    <script src="./assets/js/homeScript.js"></script>
                    <script src="./assets/js/commonscript.js"></script>
                    <script type="text/javascript">
                        function submitform() {
                            document.formTim.submit();
                        }
                    </script>
</body>

</html>