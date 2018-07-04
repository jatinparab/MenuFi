<?php
    $conn = mysqli_connect("localhost","root", "", "menufi");
    //$s = "ALTER TABLE customer_order DROP FOREIGN KEY Menu_Constraint";
    //$conn -> query($s);
    //$sql2 = "SELECT * FROM categories WHERE id='$id'";
    //$res = $conn -> query($sql2);
    //$row = $res -> fetch_assoc();
   // $ix = $row['name'];
    $sql = "SELECT * FROM sales WHERE Order_id='$id'";
    $res = $conn -> query($sql);
    $row = $res -> fetch_assoc();
    $amt = $given - $row['net_total'];
    echo $amt;
    

?>