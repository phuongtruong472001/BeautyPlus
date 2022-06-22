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
    <title>Quan ly hoa don</title>
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
                    <div class="title">Hóa đơn</div>
                </div>
                <div class="m-table-wrapper">
                    <div class="m-table-action">
                    </div>
                    <div class="m-table sticky-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>mã tài khoản</th>
                                    <th>ngày tạo</th>
                                    <th>tổng tiền</th>
                                    <th>trạng thái</th>
                                    <th>tên</th>
                                    <th>địa chỉ</th>
                                    <th>số dt</th>
                                    <th>email</th>
                                    <th>ghi chú</th>
                                    <th class="fixed-coloumn-last">Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM bill ORDER BY id DESC";
                                $result = $conn->query($sql);
                                while ($row = $result->fetch_assoc()) {
                                ?>
                                    <tr>
                                        <td><?= $row['id'] ?></td>
                                        <td><?= $row['user_id'] ?></td>
                                        <td><?= $row['created'] ?></td>
                                        <td><?= $row['total'] ?></td>
                                        <td><?= $row['status'] ?></td>
                                        <td><?= $row['name'] ?></td>
                                        <td><?= $row['address'] ?></td>
                                        <td><?= $row['phone'] ?></td>
                                        <td><?= $row['phone'] ?></td>
                                        <td><?= $row['note'] ?></td>
                                        <td>
                                            <a href="updateBillForm.php?id=<?=$row['id']?>">cập nhật</a>
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
            </div>
        </div>
    </div>
</body>

</html>