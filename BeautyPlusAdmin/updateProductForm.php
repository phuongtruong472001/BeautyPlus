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
    // lấy thông tin sản phẩm cần sửa
    $id = $_GET['id'];
    $sql = "SELECT * FROM product WHERE id=$id";
    $rs = $conn->query($sql)->fetch_assoc();
    $name = $rs['name'];
    $price = $rs['price'];
    $category_id = $rs['category_id'];
    $quantity = $rs['quantity'];
    $sold = $rs['sold'];
    $disscount = $rs['disscount'];
    $brand = $rs['brand'];
    $description = $rs['description'];
    $status = $rs['status'];

    $sql = "SELECT link from image WHERE product_id=$id";
    $link = $conn->query($sql)->fetch_assoc()['link'];
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
                    <div class="title">Sửa sản phẩm</div>
                </div>

                <!-- form them san pham -->
                <form action="updateProduct.php" method="POST">
                    <div>
                        <div class="add-emoloyee-form ui-draggable ui-draggable-handle" style="position: relative;">
                            <div class="m-form-header r-flex h-pointer">
                                <div class="m-form-menu">
                                    Thông tin sản phẩm
                                </div>
                            </div>
                            <div class="m-form-content">
                                <div>
                                    <div class="m-news-input">
                                        <label for="">ID</label>
                                        <input name="id" type="text" value="<?=$id?>" readonly>
                                    </div>
                                    <div class="m-news-input">
                                        <label for="">Tên sản phẩm</label>
                                        <input name="name" type="text" value="<?=$name?>">
                                    </div>
                                    <div class="m-news-input">
                                        <label for="">Danh mục</label>
                                        <select name="category_id">
                                        <?php
                                            $sql = "SELECT name, id FROM category";
                                            $rs = $conn->query($sql);
                                            while($row = $rs->fetch_assoc()){
                                                echo "<option value=\"".$row['id']."\"";
                                                if($row['id']==$category_id){
                                                    echo "selected";
                                                }
                                                echo ">".$row['name']."</option>";
                                            }
                                        ?>
                                        </select>
                                    </div>
                                    <div class="m-news-input">
                                        <label for="">giá</label>
                                        <input name="price" type="text" value="<?=$price?>">
                                    </div>
                                    <div class="m-news-input">
                                        <label for="">Số lượng có</label>
                                        <input name="quantity" type="text" value="<?=$quantity?>">
                                    </div>
                                    <div class="m-news-input">
                                        <label for="">đã bán</label>
                                        <input name="sold" type="text" value="<?=$sold?>">
                                    </div>
                                    <div class="m-news-input">
                                        <label for="">Khuyến mãi</label>
                                        <input name="disscount" type="text" value="<?=$disscount?>">
                                    </div>
                                    <div class="m-news-input">
                                        <label for="">Thương hiệu</label>
                                        <input name="brand" type="text" value="<?=$brand?>">
                                    </div>
                                    <div class="m-news-input">
                                        <label for="">Mô tả</label>
                                        <input name="description" type="text" value="<?=$description?>">
                                    </div>
                                    <div class="m-news-input">
                                        <label for="">link ảnh</label>
                                        <input name="link" type="text" value="<?=$link?>">
                                    </div>
                                    <div class="m-news-input">
                                        <label for="">Trạng thái</label>
                                        <select name="status">
                                            <option value="ban"<?php if($status=="ban") echo "selected" ?>>bán</option>
                                            <option value="ngung_ban"<?php if($status=="ngung_ban") echo "selected" ?>>ngừng bán</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="m-form-action">
                                <div class="m-news-add-action">
                                    <input class="m-news-save" type="submit" name="updateProduct" value="Sửa">
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