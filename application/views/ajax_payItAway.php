<?php
    $conn = mysqli_connect("localhost","root", "", "menufi");
    $sql2 = "SELECT * FROM sales WHERE Order_id='$id'";
    $res = $conn -> query($sql2);
    $row = $res -> fetch_assoc();
    $total = $row['net_total'];
    date_default_timezone_set("Asia/Kolkata");
    $date = date('Y-m-d H:i:s');
    if($type == 'Cash'){
        $sql = "INSERT INTO payment_details (order_id,payment_type,total_amount,given_amount,return_amount,added_date) VALUES ('$id','$type','$total','$given_amt','$return_amt','$date')";

    }else{
        $sql = "INSERT INTO payment_details (order_id,payment_type,total_amount,given_amount,return_amount,added_date) VALUES ('$id','$type','$total','$total','0','$date')";
    }
    if ($conn->query($sql) === TRUE) {
        echo "success";
    }else{
        echo "error";
    }
    

?>