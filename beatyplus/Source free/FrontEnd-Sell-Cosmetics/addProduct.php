<?php
session_start();
include(".\assets\php\connect.php");
$conn = mysqli_connect($host, $username, $password, $dbname);
$ID = $_GET["id"];
$sql = "select * from product where id=$ID";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$name = $row['name'];
$price = $row['price']*(100-$row["disscount"])/100;


// echo $name . $price . $quantity;
//Kiểm tra xem đã có giỏ hàng chưa
$user_id=$_SESSION['user_id'];

$sql = "select * from cart where user_id = $user_id";
$result = $conn->query($sql);

while ($row1 = $result->fetch_assoc()) {
	if ($row1["product_id"] == $ID) {
		$SL =1 + $row1['quantity'];
		$id_product = $row1['product_id'];
		$sql = "update cart set quantity = $SL where product_id=$ID ";
		$result = $conn->query($sql);
		header("Location:cart.php");
		return;
	}
}

$sql = "insert into cart(user_id,product_id,quantity,price) values($user_id,$ID,1,$price)";
$result = $conn->query($sql);
header("Location:cart.php");
?>
