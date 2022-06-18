<?php
session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="hoadon.css">
</head>

<body>
    <?php
    include(".\assets\php\connect.php");
    $user_id = $_SESSION['user_id'];
    $sql = "select * from bill where user_id =$user_id"; //lấy ra các bill của người dùng
    $result = $conn->query($sql);
    if ($result->num_rows == 0) {
        echo "bạn chưa đặt đơn hàng nào !";
    } else {
    while ($row = $result->fetch_assoc()) {
        $ID = $row['id']; //lấy id của 1 bill
        //echo $ID;
        $sql1 = "select * from bill_product where bill_id =$ID"; //lấy ra bill
        $result1 = $conn->query($sql1);
        
    ?>
            <div class="cart-container">
                <?php
                while ($row1 = $result1->fetch_assoc()) {
                    $id_product = $row1["product_id"];
                    $sql2 = "select * from product where id=$id_product";
                    $result2 = $conn->query($sql2);
                    $row2 = $result2->fetch_assoc();
                    $thanhtien = $row1["quantity"] * $row2["price"];
                ?>

                    <div class="cart-content">
                        <div class="cart-avatar">
                            <?php
                            $sql3 = "select * from image where product_id=$id_product ";
                            $result3 = $conn->query($sql3);
                            $row3 = $result3->fetch_assoc(); ?>
                            <img src="<?php echo $row3['link'] ?>" alt="" srcset="">
                        </div>
                        <div class="cart-description-wrapper">
                            <div class="cart-description">
                                <div><?php echo $row2["name"] ?> </div>
                                <div></div>
                                <div>x<?php echo $row1["quantity"] ?></div>
                            </div>
                            <div class="item-price">
                                Thành tiền : <?php echo number_format($thanhtien) ?> vnd
                            </div>
                        </div>
                    </div>



                <?php } ?>
            </div>
            <div class="statistical">
                <div>Được đặt vào lúc <?php echo $row["created"] ?></div>
                <div>Tổng số Tiền: <?php echo number_format($row["total"]) ?> vnd</div>
            </div>
            <div class="statistical"></div>

    <?php
        }
    } ?>

</body>

</html>