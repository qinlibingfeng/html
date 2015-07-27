<?php
echo str_replace("w","A","stqqwewqeqw")."<br>";

echo substr("12345678",0,-5);

echo date("YmdHis");;

 
function getMsecTime(){
    $arr = explode( ' ', microtime() );
    return $arr[0] + $arr[1];
}

//开始时间
$startTime = getMsecTime();

$numArr = array( 100 , -100 , 1000 , -1000 , 1 );





//程序运行时间
$runTime = 0;
$k = 0;
$j = 0;
while( $j < 1000000 ){
    $j++;
    $k += $numArr[$j % 5];
}



require 'lib/PHPExcel.php';
set_time_limit(90);
$input_file = "data.xlsx";
$objPHPExcel = PHPExcel_IOFactory::load($input_file); 
$sheet_count = $objPHPExcel->getSheetCount(); 
for ($s = 0; $s < $sheet_count; $s++){ 
	$currentSheet = $objPHPExcel->getSheet($s);// 当前页 
	$row_num = $currentSheet->getHighestRow();// 当前页行数 
	$col_max = $currentSheet->getHighestColumn(); // 当前页最大列号 
	// 循环从第二行开始，第一行往往是表头
	for($i = 2; $i <= $row_num; $i++){
		$cell_values = array(); 
		for($j = 'A'; $j < $col_max; $j++){ 
			$address = $j . $i; // 单元格坐标 
			
			$cell_values[] = $currentSheet->getCell($address)->getFormattedValue();
		}
		// 看看数据
		print_r($cell_values);
		
	} 
	
} 


$runTime = getMsecTime() - $startTime;

echo 'Running time:' , $runTime , '<br>';
echo 'Memory usage:' . memory_get_usage();

