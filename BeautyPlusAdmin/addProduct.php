<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header('Location: login.php');
    }
    include_once('connectDB.php');
?>
<?php
    include_once('connectDB.php');
    if(isset($_POST['addProduct'])){
        $name = $_POST['name'];
        $category_id = $_POST['category'];
        $quantity = $_POST['quantity'];
        $disscount = $_POST['disscount'];
        $brand = $_POST['brand'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $link = $_POST['link'];

        if(empty($name) || empty($price+1) || empty($category_id+1) || empty($quantity+1) || empty($disscount+1)){
            echo "<script>
                alert(\"Các trường không được để trống\");
                window.location = '././manageProduct.php';
            </script>";
        }else{
            // insert data
            $sql = "INSERT INTO product (name, category_id, price, quantity, sold, disscount, brand, description, status)
            VALUES ('$name', $category_id, $price, $quantity, 0, $disscount, '$brand', '$description', 'ban')";
            if($conn->query($sql)===TRUE){
                //insert image
                $sql = "SELECT MAX(id) as rs FROM product";
                $id = $conn->query($sql)->fetch_assoc()['rs'];
                $sql = "INSERT INTO image(link, product_id) VALUES('$link', $id)";
                if($conn->query($sql)===TRUE){
                    echo "<script>
                    alert(\"Tạo sản phẩm mới thành công\");
                    window.location = '././manageProduct.php';
                    </script>";
                }else{
                    echo "<script>
                    alert(\"Lỗi $conn->error\");
                    window.location = '././manageProduct.php';
                    </script>";
                }
            }else{
                echo "<script>
                    alert(\"Lỗi $conn->error\");
                    window.location = '././manageProduct.php';
                </script>";
            }
        }
    }
?>