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
        // lấy thông tin danh mục cần sửa
        $id = $_GET['id'];
        $sql = "SELECT * FROM category WHERE id=$id";
        $rs = $conn->query($sql)->fetch_assoc();
        $name = $rs['name'];
        $description = $rs['description'];
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
                    <div class="title">Sửa danh mục</div>
                </div>

                <!-- form them danh muc -->
                <form action="updateCategory.php" method="POST">
                    <div>
                        <div class="add-emoloyee-form ui-draggable ui-draggable-handle" style="position: relative;">
                            <div class="m-form-header r-flex h-pointer">
                                <div class="m-form-menu">
                                    Thông tin danh mục
                                </div>
                            </div>
                            <div class="m-form-content">
                                <div>
                                    <div class="m-news-input">
                                        <label for="">ID</label>
                                        <input name="id" type="text" value="<?=$id?>" readonly>
                                    </div>
                                    <div class="m-news-input">
                                        <label for="">Tên danh mục</label>
                                        <input name="name" type="text" value="<?=$name?>">
                                    </div>
                                    <div class="m-news-input">
                                        <label for="">Mô tả</label>
                                        <input name="description" type="text" value="<?=$description?>">
                                    </div>
                                </div>
                            </div>

                            <div class="m-form-action">
                                <div class="m-news-add-action">
                                    <input class="m-news-save" type="submit" name="updateCategory" value="Sửa">
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