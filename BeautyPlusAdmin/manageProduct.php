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
    <title>Quan ly san pham</title>
    <link rel="stylesheet" href="./index.css">
    <script src="./lib/jquery-3.6.0.min.js"></script>
    <script src="./lib/jquery-ui.min.js"></script>
    <script src="./js/navbar.js"></script>
    <script src="./js/dialouge.js"> </script>
    <script src="./index.js"></script>
</head>

<body>
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
                    <div class="title">Sản phẩm</div>
                    <div class="add-new-employee">
                        <button class="btn-add m-news-add">Thêm</button>
                        <div class="btn-space">
                            <div></div>
                        </div>
                        <button class="import-from-excel">
                            <div></div>
                        </button>
                    </div>
                </div>
                <div class="m-table-wrapper">


                    <div class="m-table-action">
                    </div>
                    <div class="m-table sticky-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Danh mục</th>
                                    <th>Giá</th>
                                    <th>Số lượng có</th>
                                    <th>Đã bán</th>
                                    <th>khuyến mại(%)</th>
                                    <th>Thương hiệu</th>
                                    <th>Mô tả</th>
                                    <th class="fixed-coloumn-last">Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM product";
                                $result = $conn->query($sql);
                                while ($row = $result->fetch_assoc()) {
                                    $temp = $row['category_id'];
                                    $category_name = $conn->query("SELECT name FROM category WHERE id=$temp")->fetch_assoc()['name'];
                                ?>
                                    <tr>
                                        <td><?= $row['id'] ?></td>
                                        <td><?= $row['name'] ?></td>
                                        <td><?= $category_name ?></td>
                                        <td><?=$row['price']?></td>
                                        <td><?= $row['quantity'] ?></td>
                                        <td><?= $row['sold'] ?></td>
                                        <td><?= $row['disscount'] ?></td>
                                        <td><?= $row['brand'] ?></td>
                                        <td><?= $row['description'] ?></td>
                                        <td>
                                            <a href="updateProductForm.php?id=<?=$row['id']?>">sửa</a>
                                            <a href="deleteProduct.php?id=<?=$row['id']?>">xóa</a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="m-table-footer"></div>
                </div>

                <!-- form them phan loai -->
                <form action="addProduct.php" method="POST">
                    <div class="m-dialogue" style="display: none;">
                        <div class="add-emoloyee-form ui-draggable ui-draggable-handle" style="position: relative;">
                            <div class="m-form-header r-flex h-pointer">
                                <div class="m-form-menu">
                                    Thông tin Sản phẩm
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
                                        <label for="">Tên Sản phẩm</label>
                                        <input name="name" type="text">
                                    </div>
                                    <div class="m-news-input">
                                        <label for="">Danh mục</label>
                                        <select name="category">
                                        <?php
                                            $sql = "SELECT name, id FROM category";
                                            $rs = $conn->query($sql);
                                            while($row = $rs->fetch_assoc()){
                                                echo "<option value=\"".$row['id']."\">".$row['name']."</option>";
                                            }
                                        ?>
                                        </select>
                                    </div>
                                    <div class="m-news-input">
                                        <label for="">Giá</label>
                                        <input name="price" type="text">
                                    </div>
                                    <div class="m-news-input">
                                        <label for="">Số lượng có</label>
                                        <input name="quantity" type="text">
                                    </div>
                                    <div class="m-news-input">
                                        <label for="">Khuyến mãi</label>
                                        <input name="disscount" type="text">
                                    </div>
                                    <div class="m-news-input">
                                        <label for="">Thương hiệu</label>
                                        <input name="brand" type="text">
                                    </div>
                                    <div class="m-news-input">
                                        <label for="">Mô tả</label>
                                        <input name="description" type="text">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="m-form-action">
                                <div class="m-news-add-action">
                                    <input class="m-news-save" type="submit" name="addProduct" value="thêm">
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