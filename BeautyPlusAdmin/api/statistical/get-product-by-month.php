<?php
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $HOST = "localhost";
    $USERNAME = "root";
    $PASSWORD = "";
    $DBNAME = "beautyplus";

    $con = new mysqli($HOST, $USERNAME, $PASSWORD, $DBNAME);
    if($con->connect_error){
        die("ket noi that bai".$conn->connect_error);
    }

    $datetime=$_GET['datetime'];
    
    $sql = "SELECT p.id AS ProductID, p.name AS ProductName, p.quantity AS ProductQuantity ,p.brand AS ProductBrand ,
            bp.quantity AS BillProductQuantity, bp.price AS BillProductPrice 
    FROM  bill b INNER JOIN bill_product bp ON b.id= bp.bill_id  INNER  JOIN product p ON P.id = bp.product_id 
    WHERE MONTH(b.created)  =MONTH('$datetime') AND YEAR(b.created) = YEAR('$datetime')";

   
   
    $rs = mysqli_query($con,$sql);

    $response = array();
    $count = 0;
    while($row = mysqli_fetch_assoc($rs)){
      array_push($response,$row);
    }
   
    echo json_encode($response);

    mysqli_close($con);

?>