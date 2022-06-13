<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Đăng nhập</title>
</head>
<body>
<?php
		require_once("connectDB.php");
		if(isset($_POST['login'])){
			$username = $_POST['username'];
			$password = $_POST['password'];
			//làm sạch thông tin, xóa bỏ các tag html, ký tự đặc biệt 
			//mà người dùng cố tình thêm vào để tấn công theo phương thức sql injection
			$username = strip_tags($username);
			$username = addslashes($username);
			$password = strip_tags($password);
			$password = addslashes($password);
			if($username == "" || $password == ""){
				echo "không được để trống trường tên tài khoản hoặc mật khẩu.";
			}else{
				$sql = "select * from user where username = '$username' and password = '$password' ";
				$query = $conn->query($sql);
				$num_rows = $query->num_rows;
				if($num_rows==0){
					echo "Tên đăng nhập hoặc mật khẩu không đúng.";
				}else{
					$_SESSION['username'] = $username;
					//chuyển hướng đến trang index;
					header('Location: index.php');
				}
			}
		}
	?>

	<form action="login.php" method="POST">
		Tên đăng nhâp: <input type="text" name="username"><br>
		Mật khẩu: <input type="password" name="password"><br>
		<input type="submit" name="login" value="Đăng nhập">
	</form>
</body>
</html>