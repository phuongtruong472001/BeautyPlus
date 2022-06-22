<?php
session_start();
include(".\assets\php\connect.php");
$user_id=$_SESSION['user_id'];
$ID = $_GET["id"];
$sql = "select * from cart where user_id = $user_id";
$result = $conn->query($sql);


while ($row1 = $result->fetch_assoc()) {
	if ($row1["product_id"] == $ID) {
		$SL = $row1['quantity'];
		if($SL==1){
			
			header("Location:cart.php");
			return;
		}
		$SL = $row1['quantity']-1;
		$id_product = $row1['product_id'];
		$sql = "update cart set quantity = $SL where product_id=$ID ";
		$result = $conn->query($sql);
		header("Location:cart.php");
		return;
	}
}
?>