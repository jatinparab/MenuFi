<?php 
    $conn = mysqli_connect("localhost","root", "", "menufi");
    $sql = "UPDATE order_status SET seen='1' WHERE Order_id='$id'";
    $res = $conn -> query($sql);
    if(isset($res)){
        echo 'success';
    }
?>