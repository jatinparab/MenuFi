<?php 
$conn = mysqli_connect("localhost","root", "", "menufi");
$sql = "SELECT * FROM addresses WHERE mobile='$mobile'";
$res = $conn -> query($sql);
$row = $res -> fetch_assoc();
if($row){
    echo $row['address'];
}


?>