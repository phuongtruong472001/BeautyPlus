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
	if (isset($_POST['login'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];
		//làm sạch thông tin, xóa bỏ các tag html, ký tự đặc biệt 
		//mà người dùng cố tình thêm vào để tấn công theo phương thức sql injection
		$username = strip_tags($username);
		$username = addslashes($username);
		$password = strip_tags($password);
		$password = addslashes($password);
		if ($username == "" || $password == "") {
			echo "không được để trống trường tên tài khoản hoặc mật khẩu.";
		} else {
			$sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password' AND role='admin'";
			$query = $conn->query($sql);
			$num_rows = $query->num_rows;
			if ($num_rows == 0) {
				echo "Tên đăng nhập hoặc mật khẩu không đúng.";
			} else {
				$_SESSION['username'] = $username;
				//chuyển hướng đến trang index;
				header('Location: manageUser.php');
			}
		}
	}
	?>

	<!-- <form action="login.php" method="POST">
		Tên đăng nhâp: <input type="text" name="username"><br>
		Mật khẩu: <input type="password" name="password"><br>
		<input type="submit" name="login" value="Đăng nhập">
	</form> -->
	<div class="login-page">
		<div class="form">
			<form class="login-form" action="login.php" method="POST">
				<h2>Đăng nhập</h2>
				<input type="text" placeholder="Tên đăng nhập" name="username"/>
				<input type="password" placeholder="Mật khẩu" name="password"/>
				<button type="submit" name="login">Đăng nhập</button>
			</form>
		</div>
	</div>
	<style>
		@import url(https://fonts.googleapis.com/css?family=Roboto:300);

		.login-page {
			width: 360px;
			padding: 8% 0 0;
			margin: auto;
		}

		.form {
			position: relative;
			z-index: 1;
			background: #FFFFFF;
			max-width: 360px;
			margin: 0 auto 100px;
			padding: 45px;
			text-align: center;
			box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
		}

		.form input {
			font-family: "Roboto", sans-serif;
			outline: 0;
			background: #f2f2f2;
			width: 100%;
			border: 0;
			margin: 0 0 15px;
			padding: 15px;
			box-sizing: border-box;
			font-size: 14px;
		}

		.form button {
			font-family: "Roboto", sans-serif;
			text-transform: uppercase;
			outline: 0;
			background: purple;
			width: 100%;
			border: 0;
			padding: 15px;
			color: #FFFFFF;
			font-size: 14px;
			-webkit-transition: all 0.3 ease;
			transition: all 0.3 ease;
			cursor: pointer;
		}

		.form button:hover,
		.form button:active,
		.form button:focus {
			background: #43A047;
		}

		.form .message {
			margin: 15px 0 0;
			color: #b3b3b3;
			font-size: 12px;
		}

		.form .message a {
			color: #4CAF50;
			text-decoration: none;
		}

		.form .register-form {
			display: none;
		}

		.container {
			position: relative;
			z-index: 1;
			max-width: 300px;
			margin: 0 auto;
		}

		.container:before,
		.container:after {
			content: "";
			display: block;
			clear: both;
		}

		.container .info {
			margin: 50px auto;
			text-align: center;
		}

		.container .info h1 {
			margin: 0 0 15px;
			padding: 0;
			font-size: 36px;
			font-weight: 300;
			color: #1a1a1a;
		}

		.container .info span {
			color: #4d4d4d;
			font-size: 12px;
		}

		.container .info span a {
			color: #000000;
			text-decoration: none;
		}

		.container .info span .fa {
			color: #EF3B3A;
		}

		body {
			background: #76b852;
			/* fallback for old browsers */
			background: rgb(141, 194, 111);
			background: whitesmoke;
			font-family: "Roboto", sans-serif;
			-webkit-font-smoothing: antialiased;
			-moz-osx-font-smoothing: grayscale;
		}
	</style>
	
</body>

</html>