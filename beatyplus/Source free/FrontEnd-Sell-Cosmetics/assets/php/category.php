<?php
include("connect.php");
$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
    die("khong ket noi dc" . mysqli_connect_error());
} else {
    echo "ket noi thanh cong";
}
$sql1 = " select * from category";
$result = $conn->query($sql1);

if ($result->num_rows > 0) {
    echo "<table border=1>
        <tr>
            <th>Name</th>
            <th>Description</th>
            
        </tr>";
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>" . $row["NAME"] . "</td>
            <td>" . $row["DESCIPTION"] . " </td>
            
        </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
