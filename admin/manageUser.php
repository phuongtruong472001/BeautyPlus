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
    <title>Quan Ly Tai Khoan</title>
</head>

<body>
    <!-- Button đăng nhập để mở form đăng nhập -->
    <button id="btn_addUser">Thêm</button>
    <!-- Modal Box -->
    <div id="myModal" class="modal">
        <!-- Nội dung form  -->
        <div class="modal-content">
            <form action="addUser.php" method="POST">
                <span class="close">&times;</span>
                <h2>Thêm tài khoản admin</h2>
                Tên đăng nhập: <br>
                <input type="text" name="username" required><br>
                Mật khẩu: <br>
                <input type="password" name="password" required><br>
                Nhập lại mật khẩu: <br>
                <input type="password" name="confirmPassword" required><br>
                Họ tên: <br>
                <input type="text" name="fullname"> <br>
                Địa chỉ: <br>
                <input type="text" name="address"> <br>
                Số điện thoại: <br>
                <input type="text" name="phone"><br>
                Email: <br>
                <input type="email" name="email"> <br>
                <br>
                <input type="submit" name="addUser" value="Thêm">
                <input type="reset" value="Xóa">
            </form>
        </div>
    </div>

    <?php
        $sql = "SELECT * FROM user";
        $result = $conn->query($sql);
    ?>
    <table border="1">
        <tr>
            <th>id</th>
            <th>Tên Tài Khoản</th>
            <th>Họ Tên</th>
            <th>Vai Trò</th>
            <th>Địa chỉ</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            <th>Thao tác</th>
        </tr>
        <?php
        while ($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['username'] ?></td>
                <td><?= $row['fullname'] ?></td>
                <td><?= $row['role'] ?></td>
                <td><?= $row['address'] ?></td>
                <td><?= $row['phone'] ?></td>
                <td><?= $row['email'] ?></td>
                <td>
                    <a href="updateUser.php?id=<?=$row['id']?>">sửa</a>
                    <a href="deleteUser.php?id=<?=$row['id']?>">xóa</a>
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
        var btn = document.getElementById("btn_addUser");

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