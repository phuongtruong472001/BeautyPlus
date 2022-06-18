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
    <title>Quản lý hình ảnh</title>
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
                <button></button>
            </div>

            <div class="menu-item-list scroll-bar"></div>
        </div>
        <div class="main" style="width: 624px;">
        <?php include('header.php') ?>


            <div class="content">
                <div class="title-distance" style="width: 611.594px;">
                    <div class="title">Hình ảnh</div>
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
                                    <th>Hình ảnh</th>
                                    <th>id bài viết</th>
                                    <th>id sản phẩm</th>
                                    <th>id danh mục</th>
                                    <th class="fixed-coloumn-last">Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM image";
                                $result = $conn->query($sql);
                                while ($row = $result->fetch_assoc()) {
                                ?>
                                    <tr>
                                        <td><?= $row['id'] ?></td>
                                        <td><img src="<?=$row['link']?>" alt="" width="100px" height="100px"></td>
                                        <td><?=$row['news_id']?></td>
                                        <td><?=$row['product_id']?></td>
                                        <td><?=$row['category_id']?></td>
                                        <td>
                                            <a href="updateImageForm.php?id=<?=$row['id']?>">sửa</a>
                                            <a href="deleteImage.php?id=<?=$row['id']?>">xóa</a>
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

                <!-- form them anh -->
                <form action="addImage.php" method="POST">
                    <div class="m-dialogue" style="display: none;">
                        <div class="add-emoloyee-form ui-draggable ui-draggable-handle" style="position: relative;">
                            <div class="m-form-header r-flex h-pointer">
                                <div class="m-form-menu">
                                    Thông tin hình ảnh
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
                                        <label for="">link ảnh</label>
                                        <input name="link" type="text">
                                    </div>
                                    <div class="m-news-input">
                                        <label for="">id bài viết</label>
                                        <input name="news_id" type="text">
                                    </div>
                                    <div class="m-news-input">
                                        <label for="">id danh mục</label>
                                        <input name="category_id" type="text">
                                    </div>
                                    <div class="m-news-input">
                                        <label for="">id sản phẩm</label>
                                        <input name="product_id" type="text">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="m-form-action">
                                <div class="m-news-add-action">
                                    <input class="m-news-save" type="submit" name="addImage" value="thêm">
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