<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header('Location: login.php');
    }
    include_once('connectDB.php');
?>
<?php
    include_once('connectDB.php');
    //xử lí sửa sản phẩm
    if(isset($_POST['updateProduct'])){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $category_id = $_POST['category_id'];
        $quantity = $_POST['quantity'];
        $sold = $_POST['sold'];
        $disscount = $_POST['disscount'];
        $brand = $_POST['brand'];
        $description = $_POST['description'];
        $link = $_POST['link'];
        $status = $_POST['status'];

        if(empty($name) || empty($price+1) || empty($category_id+1) || empty($quantity+1) || empty($sold+1) || empty($disscount+1) || empty($link)){
            echo "<script>
                alert(\"các trường không được để trống\");
                window.location = '././manageProduct.php';
            </script>";
        }else{
            // update data
            $sql = "UPDATE product SET name='$name', price=$price, category_id=$category_id, quantity=$quantity, 
            sold=$sold, disscount=$disscount, brand='$brand', description='$description', status='$status'   
            WHERE id=$id";
            if($conn->query($sql)===TRUE){
                $sql = "UPDATE image SET link='$link' WHERE product_id=$id";
                if($conn->query($sql)===TRUE){
                    echo "<script>
                        alert(\"cập nhật thành công\");
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