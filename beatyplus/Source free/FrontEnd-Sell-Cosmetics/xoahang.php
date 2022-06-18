<?php
session_start();
include(".\assets\php\connect.php");

$id_product = $_GET["id"];
$id_user=$_SESSION['user_id'];
$sql = "delete from cart where user_id =$id_user and product_id =$id_product";
$result = $conn->query($sql);
header("Location:cart.php");
?>