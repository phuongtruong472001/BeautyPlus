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
    <title>Document</title>
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
    ?>
    <h2>Sửa thông tin sản phẩm</h2>
    <form action="updateProduct.php" method="POST">
        ID: <br>
        <input type="text" name="id" value="<?=$id?>" readonly><br>
        Tên sản phẩm: <br>
        <input type="text" name="name" required value="<?=$name?>"><br>
        Danh mục: <br>
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
        </select><br>
        Giá: <br>
        <input type="text" name="price" required value="<?=$price?>"><br>
        Số lượng có: <br>
        <input type="text" name="quantity" required value="<?=$quantity?>"><br>
        Đã bán: <br>
        <input type="text" name="sold" value="<?=$sold?>" required><br>
        Khuyến mãi: <br>
        <input type="text" name="disscount" required value="<?=$disscount?>"><br>
        Thương hiệu: <br>
        <input type="text" name="brand" value="<?=$brand?>"><br>
        Mô tả: <br>
        <input type="text" name="description" value="<?=$description?>"><br>
        <br>
        <input type="submit" name="updateProduct" value="Thêm">
    </form>
</body>
</html>