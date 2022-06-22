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
    <title>Quan ly danh muc</title>
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
        <?php include('header.php') ?>


            <div class="content">
                <div class="title-distance" style="width: 611.594px;">
                    <div class="title">Danh mục</div>
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
                                    <th>tên</th>
                                    <th>mô tả</th>
                                    <th class="fixed-coloumn-last">Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM category ORDER BY id DESC";
                                $result = $conn->query($sql);
                                while ($row = $result->fetch_assoc()) {
                                ?>
                                    <tr>
                                        <td><?= $row['id'] ?></td>
                                        <td><?= $row['name'] ?></td>
                                        <td><?= $row['description'] ?></td>
                                        <td>
                                            <a href="updateCategoryForm.php?id=<?=$row['id']?>">sửa</a>
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
                <form action="addCategory.php" method="POST">
                    <div class="m-dialogue" style="display: none;">
                        <div class="add-emoloyee-form ui-draggable ui-draggable-handle" style="position: relative;">
                            <div class="m-form-header r-flex h-pointer">
                                <div class="m-form-menu">
                                    Thông tin Danh mục
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
                                        <label for="">Tên Danh mục</label>
                                        <input name="name" type="text">
                                    </div>
                                    <div class="m-news-input">
                                        <label for="">Mô tả</label>
                                        <input name="description" type="text">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="m-form-action">
                                <div class="m-news-add-action">
                                    <input class="m-news-save" type="submit" name="addCategory" value="thêm">
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