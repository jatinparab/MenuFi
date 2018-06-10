<?php
    $conn = mysqli_connect("localhost","root", "", "menufi");
    $sql2 = "SELECT * FROM sales WHERE Order_id='$id'";
    $res = $conn -> query($sql2);
    $row = $res -> fetch_assoc();
    $total = $row['net_total'];
    if($type == 'Cash'){
        $sql = "INSERT INTO payment_details (order_id,payment_type,total_amount,given_amount,return_amount) VALUES ('$id','$type','$total','$given_amt','$return_amt')";

    }else{
        $sql = "INSERT INTO payment_details (order_id,payment_type,total_amount,given_amount,return_amount) VALUES ('$id','$type','$total','$total','0')";
    }
    if ($conn->query($sql) === TRUE) {
        echo "success";
    }else{
        echo "error";
    }
    

?>