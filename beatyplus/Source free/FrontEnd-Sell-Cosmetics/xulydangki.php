<?php 
    // nếu ko phải là đăng kí thì ko xử lí
    if(!isset ($_POST['txtUsername'])){
        die('');
    }
    include(".\assets\php\connect.php");
    $conn = mysqli_connect($host, $username, $password, $dbname);
    header('Content-type: text/html; charset= UTF-8');
    $username = addslashes($_POST['txtUsername']);
    $password = addslashes($_POST['txtPassword']);
    $cfpassword = addslashes($_POST['cfpassword']);
    $fullname = addslashes($_POST['txtFullname']);
    $phone = addslashes($_POST['txtPhone']);

    // kiểm tra ng dùng nhập đầy đủ dữ liệu chưa ?
    if(!$username || !$password || !$cfpassword || !$fullname || !$phone)
    {
        echo "Vui lòng nhập đầy đủ thông tin.<a href='javascript: history.go(-1)'>Trở lại</a>";
        exit;
    }
    $password = md5($password);
    // kiểm tra username có ng dùng chưa
    if(mysqli_num_rows(mysqli_query($conn,"SELECT username FROM `user` WHERE username='$username'")) >0){
        echo "Tên đăng nhập đã được sử dụng.<a href='javascript: history.go(-1)'>Trở lại</a>";
        exit;
    }
    $user = mysqli_query($conn,"INSERT INTO user( role,
        username,
        password,
        fullname,
        phone
    )
    VALUES('user',
            '$username',
            '$password',
            '$fullname',
            '$phone'
        )
    ");
    if ($user){
    echo "Đăng ký thành công. <a href='index.php'>Về trang chủ</a>";
    header("Location:index.php");
    }
else
    echo "Có lỗi xảy ra trong quá trình đăng ký. <a href='news.php'>Thử lại</a>";
?>