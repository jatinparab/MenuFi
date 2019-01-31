<?php 

	
    $conn = mysqli_connect("localhost","root", "", "menufi");
    $sql = "SELECT * FROM coupons WHERE c_code='$code'";
	$res = $conn -> query($sql);
    $valid = false;
    $valid2 = false;
    if(mysqli_num_rows($res) > 0){
        $row = $res -> fetch_assoc();
        if($row['c_status'] == 'ON'){
            $valid = true;
        }
		$sql2 = "SELECT * FROM sales WHERE Order_id='$id'";
		//echo $sql2;
		$res2 = $conn -> query($sql2);
        $row2 = $res2 -> fetch_assoc();
        if($row2['net_total'] > $row['c_minvalue']){
            $valid2 = true;
        }
    }
    
    
    if(!$valid){
        echo 'Invalid Coupon Code';
    }else{
    if(!$valid2){
        echo 'Not Enough Amount Order';
    }
}
    if($valid == true && $valid2 == true){
        $prev_total = $row2['net_total'];
        $type = $row['c_type'];
        $value = $row['c_value'];
        if($type == 'flat'){
            $new_total = $prev_total - $value;
        }
        if($type == 'percent'){
            $new_total = $prev_total - floor($prev_total*($value/100));
        }
        $sql3 = "UPDATE sales SET net_total='$new_total',coupon_apply='1',coupon_code='$code' WHERE Order_id='$id'";
        $res3 = $conn -> query($sql3);
        if(isset($res3)){
            echo 'success';
        }
    }
    


?>