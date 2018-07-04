<?php
    $conn = mysqli_connect("localhost","root", "", "menufi");
    $date = date('Y-m-d h:i:sa');
    $sql = "INSERT INTO opening_amount (opening_amount,added_date) VALUES ('$amt','$date')";
    if ($conn->query($sql) === TRUE) {
        echo "success";
    }else{
        echo "error";
    }
    

?>