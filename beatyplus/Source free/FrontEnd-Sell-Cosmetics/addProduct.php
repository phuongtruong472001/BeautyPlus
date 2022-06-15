<?php
session_start();
include(".\assets\php\connect.php");
$conn = mysqli_connect($host, $username, $password, $dbname);
$ID = $_GET["id"];
$sql = "select * from product where id=$ID";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$name = $row['name'];
$price = $row['price'];
$quantity = $_POST["quantity"];
// echo $name . $price . $quantity;
//Kiểm tra xem đã có giỏ hàng chưa
$sql = "select * from cart";
$result = $conn->query($sql);
while ($row1 = $result->fetch_assoc()) {
	if ($row1["product_id"] == $ID) {
		$SL=$quantity+$row1['quantity'];
		$id_product=$row1['product_id'];
		$sql = "update cart set quantity=$SL where $id_product=$ID";
		$result = $conn->query($sql);
		if ($result) {
			echo "Thêm thành công";
		}//
		return;
	}
}
$sql = "insert into cart(product_id,quantity) values($ID,$quantity)";
$result = $conn->query($sql);
header("Location:cart.php");
?>
//$row = $result->fetch_assoc();


// if (isset($_SESSION['cart'])) //đã có giỏ thì lấy ra
// {
// 	$cart = $_SESSION['cart'];
// } else { //chưa có thì tạo
// 	$cart = [];
// }
// //Kiểm tra hàng có trong giỏ chưa
// if (array_key_exists($id, $cart)) { //hàng đã có trong giỏ
// 	$cart[$id]['quantity']++;
// } else { //chưa có sp trong giỏ
// 	$cart[$id] = array('name' => $name, 'quantity' => 1, 'price' => $price);
// }
//cập nhật lại giỏ hàng
//$_SESSION['cart'] = $cart;
	//header("Location: product.php");
