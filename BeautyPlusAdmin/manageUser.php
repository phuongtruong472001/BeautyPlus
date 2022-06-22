<!-- NOTE : user thêm ở trang admin sẽ có quyền admin -->
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
    <title>Quan ly tai khoan</title>
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
                    <div class="title">Tài Khoản</div>
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
                                    <th><input type="checkbox"></th>
                                    <th>id</th>
                                    <th>Tên Tài Khoản</th>
                                    <th>Họ Tên</th>
                                    <th>Vai Trò</th>
                                    <th>Địa chỉ</th>
                                    <th>Số điện thoại</th>
                                    <th>Email</th>
                                    <th class="fixed-coloumn-last">Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM user";
                                $result = $conn->query($sql);
                                while ($row = $result->fetch_assoc()) {
                                ?>
                                    <tr>
                                        <td class="fixed-coloumn-first"><input type="checkbox"></td>
                                        <td><?= $row['id'] ?></td>
                                        <td><?= $row['username'] ?></td>
                                        <td><?= $row['fullname'] ?></td>
                                        <td><?= $row['role'] ?></td>
                                        <td><?= $row['address'] ?></td>
                                        <td><?= $row['phone'] ?></td>
                                        <td><?= $row['email'] ?></td>
                                        <td>
                                            <!-- <a href="updateUserForm.php?id=<?= $row['id'] ?>">sửa</a>
                                            <a href="deleteUser.php?id=<?= $row['id'] ?>">xóa</a> -->
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

                <!-- form them bai viet -->
                <form action="addUser.php" method="POST">
                    <div class="m-dialogue" style="display: none;">
                        <div class="add-emoloyee-form ui-draggable ui-draggable-handle" style="position: relative;">
                            <div class="m-form-header r-flex h-pointer">
                                <div class="m-form-menu">
                                    Thông tin bài viết
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
                                        <label for="">Tên đăng nhập</label>
                                        <input name="username" type="text" required>
                                    </div>
                                    <div class="m-news-input">
                                        <label for="">Mật khẩu</label>
                                        <input name="password" type="password" required>
                                    </div>
                                    <div class="m-news-input">
                                        <label for="">Nhập lại mật khẩu</label>
                                        <input name="confirmPassword" type="password" required>
                                    </div>
                                    <div class="m-news-input">
                                        <label for="">Họ tên</label>
                                        <input name="fullname" type="text">
                                    </div>
                                    <div class="m-news-input">
                                        <label for="">Địa chỉ</label>
                                        <input name="address" type="text">
                                    </div>
                                    <div class="m-news-input">
                                        <label for="">Số điện thoại</label>
                                        <input name="phone" type="text">
                                    </div>
                                    <div class="m-news-input">
                                        <label for="">Email</label>
                                        <input name="email" type="email">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="m-form-action">
                                <div class="m-news-add-action">
                                    <input class="m-news-save" type="submit" name="addUser" value="thêm">
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