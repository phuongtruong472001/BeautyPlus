<?php

session_start();

//Khai báo utf-8 để hiển thị được tiếng việt
header('Content-Type: text/html; charset=UTF-8');
$name = $_POST['fullname'];
$address = $_POST['address'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$note = $_POST['note'];
//Xử lý đăng nhập

    //Kết nối tới database
    include(".\assets\php\connect.php");
    $sql = "select * from cart ";
    $result = $conn->query($sql);
    $sum = 0;
    while ($row = $result->fetch_assoc()) {
        $ID = $row['product_id'];
        $sql1 = "select * from cart inner join product where id=$ID";
        $result1 = $conn->query($sql1);
        $row1 = $result1->fetch_assoc();
        $ThanhTien = $row['quantity'] * $row['price'];
        $sum += $ThanhTien;
    }
    $x=$_SESSION['username'];
    $sql = "select * from user where username= '$x'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $id=$row['id'];
    $sql = "INSERT into bill(user_id,total, status, name, address, phone, email, note) 
    values($id,$sum, 'chưa xác nhận', '$name', '$address', '$phone', '$email', '$note')";
    $result = $conn->query($sql);

    $sql = "select * from bill where id=(select MAX(id) from bill)";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $id_bill= $row['id'];
    // echo $id_bill;
    $sql1 = "select * from cart ";
    $result1 = $conn->query($sql1);
    while ($row1 = $result1->fetch_assoc()) {
        $ID = $row1['product_id'];
        //echo $ID;
        $price = $row1['price'];
        $quantity=$row1['quantity'];
        $sql2 = "insert into bill_product(bill_id,product_id,quantity,price) values($id_bill,$ID,$quantity,$price)";
        $result2 = $conn->query($sql2);

        $sql3 = "update product set quantity=quantity-$quantity,sold=sold+$quantity where id=$ID";
        $result3 = $conn->query($sql3);
       
    }
    $sql1 = "delete  from cart ";
    $result1 = $conn->query($sql1);
    echo "<script>
			alert(\"đặt hành thành công\");
			window.location = '././hoadon.php';
		</script>";
?>