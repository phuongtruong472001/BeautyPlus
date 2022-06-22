<?php
session_start();
include(".\assets\php\connect.php");
$user_id=$_SESSION['user_id'];
$ID = $_GET["id"];
$sql = "SELECT * FROM cart WHERE user_id = $user_id AND product_id=$ID";
$result = $conn->query($sql)->fetch_assoc();


// while ($row1 = $result->fetch_assoc()) {
// 	if ($row1["product_id"] == $ID) {
// 		$s = "select * from product where id=$ID";
// 		$re = $conn->query($sql);
// 		$r = $re->fetch_assoc();
// 		if($r["quantity"]<=$row1['quantity']){
// 			echo "<script>
//                 alert(\"Sản phẩm đã đạt số lượng tối đa\");
//                 window.location = '././cart.php';
//             </script>";
// 		}else{
// 			$SL =1 + $row1['quantity'];
// 			$id_product = $row1['product_id'];
// 			$sql = "update cart set quantity = $SL where product_id=$ID ";
// 			$result = $conn->query($sql);
// 			header("Location:cart.php");
// 			return;
// 		}
// 	}
// }

	$s = "select * from product where id=$ID";
	$re = $conn->query($s);
	$r = $re->fetch_assoc();
	if($r["quantity"]<=$result['quantity']){
		echo "<script>
			alert(\"Sản phẩm đã đạt số lượng tối đa\");
			window.location = '././cart.php';
		</script>";
	}else{
		$SL =1 + $result['quantity'];
		$id_product = $result['product_id'];
		$sql = "update cart set quantity = $SL where product_id=$ID and user_id=$user_id";
		$result = $conn->query($sql);
		header("Location:cart.php");
		return;
	}
?>