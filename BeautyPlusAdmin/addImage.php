<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header('Location: login.php');
    }
    include_once('connectDB.php');
?>
<?php
    include_once('connectDB.php');
    if(isset($_POST['addImage'])){
        $link = $_POST['link'];
        $news_id = $_POST['news_id'];
        $category_id=$_POST['category_id'];
        $product_id = $_POST['product_id'];
        if($news_id==""){
            $news_id='null';
        }
        if($category_id==""){
            $category_id='null';
        }
        if($product_id==""){
            $product_id='null';
        }

        if(empty($link)){
            echo "<script>
                alert(\"link ảnh không được để trống\");
                window.location = '././manageImage.php';
            </script>";
        }else{
            // insert data
            $sql = "INSERT INTO image (link, news_id, category_id, product_id) 
            VALUES ('$link', $news_id, $category_id, $product_id)";
            if($conn->query($sql)===TRUE){
                echo "<script>
                    alert(\"Thêm ảnh thành công\");
                    window.location = '././manageImage.php';
                </script>";
            }else{
                echo "<script>
                    alert(\"Lỗi $conn->error\");
                    window.location = '././manageImage.php';
                </script>";
            }
        }
    }
?>