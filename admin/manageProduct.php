<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header('Location: login.php');
    }
    include_once('connectDB.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quan ly san pham</title>
</head>
<body>
    <!-- Button đăng nhập để mở form đăng nhập -->
    <button id="btn_addProduct">Thêm</button>
    <!-- Modal Box -->
    <div id="myModal" class="modal">
        <!-- Nội dung form  -->
        <div class="modal-content">
            <form action="addProduct.php" method="POST">
                <span class="close">&times;</span>
                <h2>Thêm sản phẩm</h2>
                Tên sản phẩm: <br>
                <input type="text" name="name" required><br>
                Danh mục: <br>
                <select name="category">
                <?php
                    $sql = "SELECT name, id FROM category";
                    $rs = $conn->query($sql);
                    while($row = $rs->fetch_assoc()){
                        echo "<option value=\"".$row['id']."\">".$row['name']."</option>";
                    }
                ?>
                </select><br>
                Giá: <br>
                <input type="text" name="price" required value="0"><br>
                Số lượng có: <br>
                <input type="text" name="quantity" required value="0"><br>
                Khuyến mãi: <br>
                <input type="text" name="disscount" required value="0"><br>
                Thương hiệu: <br>
                <input type="text" name="branch"><br>
                Mô tả: <br>
                <input type="text" name="description"><br>
                <br>
                <input type="submit" name="addProduct" value="Thêm">
                <input type="reset" value="Xóa">
            </form>
        </div>
    </div>

    <?php
        $sql = "SELECT * FROM Product";
        $result = $conn->query($sql);
    ?>
    <table border="1">
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
            <th>Thao tác</th>
        </tr>
        <?php
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
    </table>


    <!-----------------CSS--------------------->
    <style>
        .formAddUser {
            width: 70%;
            margin: auto;
            text-align: center;
        }

        /* The Modal (background) */
        .modal {
            display: none;
            /* mặc định được ẩn đi */
            position: fixed;
            /* vị trí cố định */
            z-index: 1;
            /* Ưu tiên hiển thị trên cùng */
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
        }

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 60%;
        }

        /* The Close Button */
        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
    </style>

    <!-----------------JS---------------------->
    <script>
        // lấy phần Modal
        var modal = document.getElementById('myModal');

        // Lấy phần button mở Modal
        var btn = document.getElementById("btn_addProduct");

        // Lấy phần span đóng Modal
        var span = document.getElementsByClassName("close")[0];

        // Khi button được click thi mở Modal
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // Khi span được click thì đóng Modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // Khi click ngoài Modal thì đóng Modal
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>