<?php
session_start();

include(".\assets\php\connect.php");
$username = $_SESSION['username'];
$sql = "SELECT * FROM user WHERE username = '$username'";
$rs = mysqli_query($conn, $sql);
$r = mysqli_fetch_assoc($rs); ?>
<!DOCTYPE html>
<html lang="vn">

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
  <link rel="stylesheet" href="suathongtincanhan.css">
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
                  <a href="listProduct.php?id=<?= $row["id"] ?> " class="sub-nav__link"><?php echo $row["name"] ?></a>
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
            Sửa thông tin cá nhân
          </div>
        </div>
        <!-- Tab content -->
        <div class="tab-content">
          <form action="xulysuatt.php" method="POST">
            <div class="container">

              <hr>
              <label for="fullname"><b>Họ tên</b></label>
              <input type="text" name="fullname" value="<?= $r['fullname'] ?>" required>
              <br>
              <label for="phone"><b>Số điện thoại</b></label>
              <input type="text" name="phone" value="<?= $r['phone'] ?>" required>
              <br>
              <label for="username"><b>Tài khoản</b></label>
              <input type="text" name="username" value="<?= $r['username'] ?>" required readonly>
              <br>
              <label for="password"><b>Mật khẩu</b>
                <input type="password" name="password" value="<?= $r['password'] ?>" required>
              </label>
              <div class="clearfix">
                <button type="submit" class="signupbtn">Sửa</button>
                <a href="index.php"><button type="button" class="signupbtn">Hủy sửa</button></a>
              </div>
            </div>
          </form>
        </div>
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