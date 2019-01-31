<?php 
$conn = mysqli_connect("localhost","root", "", "menufi"); 
$gross_profit = array(
    "January" => 0,
    "February" => 0,
    "March" => 0,
    "April" => 0,
    "May" => 0,
    "June" => 0,
    "July" => 0,
    "August" => 0,
    "September" => 0,
    "October" => 0,
    "November" => 0,
    "December" => 0,
  );  
$currentMonth = date("F");  
$sql = "SELECT * FROM sales WHERE refund='0'";
$res = $conn -> query($sql);
if($res->num_rows > 0){
	
	while($row = $res -> fetch_assoc()){
	  $ro = $row['Timestamp']; 
	  $month = date('F', strtotime($ro));
	  $gross_profit[$month] += $row['net_total'];
	}
 }
 
 /*  foreach($gross_profit as $k => $v){
	if($k == $currentMonth){
		
		$revenue = $v;
	}
  } */
  $ingredientslist = array();
  $resukt = $conn->query("select * from ingredients"); 
  if($res->num_rows > 0){
	
	while($row = $resukt -> fetch_assoc()){
	  
	  $ingredientslist[] += ($row['quantity']/1000)*($row['cost']);
	}
 }
 
if($ingredientslist){
	
	$delimiter = ",";
    $filename = "report_" . date('Y-m-d') . ".csv";
    
    //create a file pointer
    $f = fopen('php://memory', 'w');
    
    //set column headers
    $fields = array('Revenue', 'Expenses');
    fputcsv($f, $fields, $delimiter);
    
    //output each row of the data, format line as csv and write to file pointer
    
	foreach ($ingredientslist as $value) { 
		
			$lineData = array($gross_profit[$month], $value);
			fputcsv($f, $lineData, $delimiter);
			
		} 
    
    //move back to beginning of file
    fseek($f, 0);
    
    //set headers to download file rather than displayed
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    
    //output all remaining data on a file pointer
    fpassthru($f);
}
exit;

?>
