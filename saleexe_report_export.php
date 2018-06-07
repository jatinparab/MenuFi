<?php 
    $conn = mysqli_connect("localhost","root", "", "menufi");
    $discounts = array(
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
      $refunds = array(
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
    $sql = "SELECT * FROM sales WHERE refund='1'";
    $res = $conn -> query($sql);
    if($res){
        while($row = $res -> fetch_assoc()){
            $r = $row['Timestamp'];
            $month = date('F',strtotime($r));
            $refunds[$month] += 1;
        }
    }
    $sql = "SELECT * FROM sales WHERE coupon_apply='1'";
    $res = $conn -> query($sql);
    if($res){
        while($row = $res -> fetch_assoc()){
            $r = $row['Timestamp'];
            $month = date('F',strtotime($r));
            $discounts[$month] += 1;
        }
    }
    

include('IOFactory.php');
$coloumn = "Months, Discounts, Refunds";
$nativeColumns = explode(',', $coloumn);
$nativeColumnsCount = count($nativeColumns);

$majorArray = array();

$majorArray[] = $nativeColumns;

$start = 0;
$sr = 1;

foreach($discounts as $k => $v){ ?>
        <tr><td><?php  echo $k; ?></td><td><?php echo $v ?></td><td><?php 
            echo $refunds[$k];
            ?></td></tr> 
<?php
    $smallArray = array($k, $v, $refunds[$k]);

    $majorArray[] = $smallArray;
    $sr++;
}
//print_r(@$smallArray);die;
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

//HEre your first sheet
$objWorkSheet = $objPHPExcel->getActiveSheet();

$limit_col = $nativeColumnsCount;
$limit_row = count($majorArray);
$current_col = 'A';
$current_row = 1;

// Create the row and column arrays starting at index 1
$row_arr = array(1 => $current_row);
$column_arr = array(1 => $current_col);

// Build the column array
while (count($column_arr) < $limit_col) {
    $column_arr[] = ++$current_col;
}

// Build the row array
while (count($row_arr) < $limit_row) {
    $row_arr[] = ++$current_row;
}

//echo "Row<pre>".print_r($row_arr, true)."</pre><br />";
//echo "Column<pre>".print_r($column_arr, true)."</pre><br />";

foreach ($row_arr as $row_number) {
    $excel_matrix[$row_number] = $column_arr;
}

foreach ($excel_matrix as $row_number => $column_position) {

    foreach ($column_position as $column_key => $column_value) {
        $cell = (string) $column_value . '' . $row_number;   // $column_value AS 'A' & $row_number AS 1 . Thus $cell becomes A1
        //echo "Cell: ".$cell."<br />\n";
        $objWorkSheet->SetCellValue($cell, $majorArray[$row_number - 1][$column_key - 1]); //Write cells

        if ($row_number == 1) { // Set all the cells of 1st row with below styling
            $objWorkSheet->getStyle($cell)->getFont()->setBold(true); // Bold the text
            $objWorkSheet->getStyle($cell)->getFont()->setSize(11); // Set font size
            $objWorkSheet->getStyle($cell)->getFont()->setName('Verdana'); // Set font family
            $objWorkSheet->getStyle($cell)->getFont()->getColor()->setRGB('02026e'); // Set font color
            //$objWorkSheet->getStyle($cell)->getFill()->setFillType('solid')->getStartColor()->setRGB('f5fc43');	// Set Cell BG color
            //$objWorkSheet->getStyle($cell)->getBorders()->getAllBorders()->setBorderStyle('thin')->getColor()->setRGB('FF0000');// Set Cell Border with color & style
            //$objWorkSheet->getStyle($cell)->getFont()->setItalic(true);	// Set font Italic
            //$objWorkSheet->getStyle($cell)->getFont()->setUnderline('double');	// Set font Underline. Pass 'true' OR 'single', 'double' etc
            //$objWorkSheet->getStyle($cell)->getFont()->setStrikethrough(true);	// Set font Strikethrough
        }
    }
    if ($row_number == 1) { // To merge the cells of 1st row
        //$objWorkSheet->mergeCells("A1:".$cell);		// It will lost the data from the cells other than A1(first cell).
    }
}
//echo 'test';die;
// Rename sheet
$objWorkSheet->setTitle('Subscribers');

//$objWriter->save(date("Y-m-d-H-i-s").'.xls');
ob_clean();
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private", false);
header('Cache-Control: max-age=0');
header("Content-Description: File Transfer");
//header("Content-Type: application/force-download"); 
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=certificates-" . date("Y-m-d-H-i-s") . ".xls;");
//header("Content-Transfer-Encoding: binary");
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); // Excel5, Excel2007
$objWriter->setPreCalculateFormulas(false);
// This line will force the file to download
$objWriter->save('php://output');
?>