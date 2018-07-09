<?php 
    $conn = mysqli_connect("localhost","root", "", "menufi");
    $sql = "UPDATE order_status SET status='4' WHERE Order_id='$id'";
    if($conn -> query($sql)){
        echo 'success';
    }else{
        echo 'error';
    }

?>