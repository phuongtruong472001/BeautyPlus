<?php
session_start(); ?>
<!DOCTYPE html>
<html lang="vn">
<!-- https://cocoshop.vn/ -->
<!-- http://mauweb.monamedia.net/vanihome/ -->

<head>
    <style>
    .black-color{
            color: black !important;
        }
        .black-color:hover{
            color:black !important;
        } 
    </style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
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
    <link rel="stylesheet" type="text/css" href="./assets/css/cart.css">
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Owl caroucel Js-->
    <script src="assets/owlCarousel/owl.carousel.min.js"></script>


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
                    <div class="header__search-wrap">
                        <input type="text" class="header__search-input" placeholder="Tìm kiếm">
                        <a class="header__search-icon" href="#">
                            <i class="fas fa-search"></i>
                        </a>
                    </div>
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
                                <div class="total-money"><a href="#myedit">Sửa thông tin</a></div>
                                <div class="total-money"><a href="#">Lịch sử mua hàng</a></div>
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
                    <a href="index.php" class="header__nav-link">Trang chủ</a>
                </li>
                <li class="header__nav-item">
                    <a href="#" class="header__nav-link">Giới Thiệu</a>
                </li>
                <li class="header__nav-item">
                    <a href="#" class="header__nav-link">Sản Phẩm</a>
                    <div class="sub-nav-wrap grid wide">
                        <ul class="sub-nav">
                            <?php
                            include(".\assets\php\connect.php");

                            $sql1 = " select * from category";
                            $result = $conn->query($sql1);
                            while ($row = $result->fetch_assoc()) { ?>

                                <li class="sub-nav__item">
                                    <a href="listProduct.php?id=<?=$row["id"]?>" class="sub-nav__link"><?php echo $row["name"] ?></a>
                                </li>

                            <?php } ?>
                        </ul>

                    </div>
                </li>
                <li class="header__nav-item">
                    <a href="news.php" class="header__nav-link">Tin Tức</a>
                </li>
                <li class="header__nav-item">
                    <a href="contact.html" class="header__nav-link">Liên Hệ</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="main">
        <div class="grid wide">
            <h3 class="main__notify">
                <div class="main__notify-icon">
                    <!-- <i class="fas fa-check"></i> -->
                    <!-- <i class="fas fa-times"></i> -->
                </div>
                <!-- <div class="main__notify-text">Giỏ hàng đã được cập nhật.</div> -->
            </h3>
            <div class="row">
                <div class="col l-8 m-12 s-12">
                    <div class="main__cart">
                        <div class="row title">

                            <div class="col l-4 m-4 s-8">Sản phẩm</div>
                            <div class="col l-2 m-2 s-0">Giá</div>
                            <div class="col l-2 m-2 s-0">Số lượng</div>
                            <div class="col l-2 m-2 s-4">Tổng</div>
                            <div class="col l-1 m-1 s-0">Xóa</div>
                        </div>

                        <?php
                        include(".\assets\php\connect.php");

                        $sql = "select * from cart where user_id=$user_id";
                        $result = $conn->query($sql);
                        $sum = 0;
                        $index = 1;
                        while ($row = $result->fetch_assoc()) {
                            $index++;
                            $ID = $row['product_id'];
                            $sql1 = "select * from cart inner join product where id=$ID";
                            $result1 = $conn->query($sql1);
                            $row1 = $result1->fetch_assoc();
                            $ThanhTien = $row['quantity'] * $row1['price'];
                            $sum += $ThanhTien;
                        ?>
                            <form action="xoahang.php?id=<?= $row1['id'] ?>" method="POST">
                                <div class="row item">

                                    <div class="col l-4  m-4 s-8">
                                        <div class="main__cart-product">
                                            <img src="./assets/img/product/product2.jpg" alt="">
                                            <div class="name"><a href="product.php?id=<?= $row1["id"] ?>"><?php echo $row1["name"] ?></a></div>
                                        </div>
                                    </div>
                                    <div class="col l-2 m-2 s-0">
                                        <div class="main__cart-price m-price"><?php echo number_format($row1["price"]) ?></div>
                                    </div>
                                    <div class="col l-2 m-2 s-0">
                                        <div class="buttons_added">
                                            <input class="minus is-form" type="button" value="-" onclick="minusProduct(<?=$index?>, <?= $row1['price']?>)">
                                            
                                            <input aria-label="quantity" class=<?php echo "input-qty-$index" ?> max="10" min="1" name="" type="number" value="<?php echo $row["quantity"] ?>">
                                            <input class="plus is-form" type="button" value="+" onclick="plusProduct(<?=$index?>,<?= $row1['price']?>)">
                                        </div>
                                    </div>
                                    <div class="col l-2 m-2 s-4">
                                        <div class="main__cart-price"> <span class=<?php echo "total-price-$index" ?>>  <?php echo  $row1['price']?> </span>  <span>đ</span></div>
                                    </div>

                                    <div class="col l-1 m-1 s-0">
                                        <button>
                                            <span class="main__cart-icon">
                                                <i class="far fa-times-circle "></i>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        <?php } ?>
                        <div class="btn btn--default">
                            Cập nhật giỏ hàng
                        </div>
                    </div>
                </div>
                <div class="col l-4 m-12 s-12">
                    <div class="main__pay">
                        <div class="main__pay-title">Tổng số lượng</div>
                        <div class="pay-info">
                            <div class="main__pay-text">
                                Tổng phụ</div>
                            <div class="main__pay-price m-main-pay-1">
                                <?php echo number_format($sum) ?> ₫
                            </div>
                        </div>
                        <div class="pay-info">
                            <div class="main__pay-text">
                                Giao hàng
                            </div>
                            <div class="main__pay-text">
                                Giao hàng miễn phí
                            </div>

                        </div>
                        <div class="pay-info">
                            <div class="main__pay-text">
                                Tổng thành tiền</div>
                            <div class="main__pay-price">
                                <?php echo number_format($sum) ?> ₫
                            </div>
                        </div>
                        <!-- <div class="btn btn--default orange">Tiến hành thanh toán</div> -->
                        <form action="pay.php">
                            <div class="btn btn--default"><button class="m-order-product">Đặt hàng</button></div>
                        </form>
                        <div class="main__pay-title">Phiếu ưu đãi</div>
                        <input type="text" class="form-control">
                        <div class="btn btn--default">Áp dụng</div>
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


</body>
<script src="./assets/js/commonscript.js"></script>
<script>
    let value = 1;
    let maxProduct =10 ;

    function minusProduct(index,price) {
        
        if (value > 1) {
            value = isNaN(value) ? 1 : value;
            value--;
        }

        document.querySelector(`.total-price-${index}`).innerHTML=(value*price)+"";
        document.querySelector(`.input-qty-${index}`).value = value;
        
    }

    function plusProduct(index,price) {
      
        value = isNaN(value) ? 1 : value;
        value++;
        if (value > maxProduct) {
            value = maxProduct;
            alert('Số sản phẩm trong kho của shop đã đạt  giới hạn')
        }
        document.querySelector(`.total-price-${index}`).innerHTML=(value*price)+"";
        document.querySelector(`.input-qty-${index}`).value = value;
        // console.log(document.querySelector('.m-main-pay-1'))
        // // const element = document.querySelectorAll('.total-price');
        // console.log(element);
        const total =callTotalPrice('.input-qty-2',".m-price");
        //console.log(total);
    }

    function callTotalPrice(calssQuantity, classPrice){
        const prices = $(classPrice);
        const quantitys = $(calssQuantity);
        let total=0;
        for(let i=0;i<prices.length;i++){
          
           const quantity = parseFloat( $(quantitys[i]).val());
           const price =parseFloat($(prices[i]).text().replace(",",""));
           console.log(quantity)
        }
        return total;
    }
</script>

</html>