<?php
    $conn = mysqli_connect("localhost","root", "", "menufi");
    $s = "ALTER TABLE customer_order DROP FOREIGN KEY Menu_Constraint";
    $conn -> query($s);
    $sql2 = "SELECT * FROM categories WHERE id='$id'";
    $res = $conn -> query($sql2);
    $row = $res -> fetch_assoc();
    $ix = $row['name'];
    $sql = "DELETE FROM categories WHERE id='$id'";
    
    $sql3 = "DELETE FROM menu WHERE Category='$ix'";
    if ($conn->query($sql) === TRUE && $conn -> query($sql3) === TRUE) {
        echo "success";
    }else{
        echo "error";
    }
    

?>