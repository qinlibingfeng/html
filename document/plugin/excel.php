<?php
error_reporting(E_ALL);
/** PHPExcel */
require('../plugin/PHPExcel.php');
 
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
//创建样式 
$excel_tit_left = new PHPExcel_Style(); 
$excel_list_left = new PHPExcel_Style(); 
//$excel_tit_center = new PHPExcel_Style(); 
//$excel_list_center = new PHPExcel_Style(); 

$excel_tit_left->applyFromArray(
	array('fill'=> array(
				'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
				'color'		=> array('argb' => 'FF92D050')
			),
			'borders' => array(
				'bottom'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
				'right'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN) //BORDER_MEDIUM 宽边
			),
			'font' => array(
				'size' => 10,'name' => '宋体','bold' => true
			),
			'alignment' => array(
				//'wrap' => true,
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
			)
		 ));
		 
$excel_list_left->applyFromArray(
	array(
		   'borders' => array(
				'bottom'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
				'right'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN) //BORDER_MEDIUM 宽边
			),
			'font' => array(
				'size' => 10,'name' => '宋体'
			),
			'alignment' => array(
				//'wrap' => true,
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
			)
		 ));	
		 
/*$excel_tit_center->applyFromArray(
	array('fill'=> array(
				'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
				'color'		=> array('argb' => 'FF92D050')
			),
			'borders' => array(
				'bottom'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
				'right'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN) //BORDER_MEDIUM 宽边
			),
			'font' => array(
				'size' => 10,'name' => '宋体','bold' => true
			),
			'alignment' => array(
				//'wrap' => true,
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
			)
		 ));
		 
$excel_list_center->applyFromArray(
	array(
		   'borders' => array(
				'bottom'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
				'right'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN) //BORDER_MEDIUM 宽边
			),
			'font' => array(
				'size' => 10,'name' => '宋体'
			),
			'alignment' => array(
				//'wrap' => true,
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
			)
		 ));	*/
		 
//设置默认字体
/*$objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setName('宋体');
$objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(10);*/
//$objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(15);

//设置单元格对齐方式
//$objPHPExcel->getActiveSheet()->getDefaultStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

$cacheMethod = PHPExcel_CachedObjectStorageFactory::cache_in_memory_serialized;
$cacheSettings = array('memoryCacheSize' => '350MB');
PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);
 
//设置列宽
$tit_arr=array("0"=>"A","1"=>"B","2"=>"C","3"=>"D","4"=>"E","5"=>"F","6"=>"G","7"=>"H","8"=>"I","9"=>"J","10"=>"K","11"=>"L","12"=>"M","13"=>"N","14"=>"O","15"=>"P","16"=>"Q","17"=>"R","18"=>"S","19"=>"T","20"=>"U","21"=>"V","22"=>"W","23"=>"X","24"=>"Y","25"=>"Z","26"=>"AA","27"=>"AB","28"=>"AC","29"=>"AD","30"=>"AE","31"=>"AF","32"=>"AG","33"=>"AH","34"=>"AI","35"=>"AJ","36"=>"AK","37"=>"AL","38"=>"AM","39"=>"AN","40"=>"AO","41"=>"AP","42"=>"AQ","43"=>"AR","44"=>"AS","45"=>"AT","46"=>"AU","47"=>"AV","48"=>"AW","49"=>"AX","50"=>"AY","51"=>"AZ","52"=>"BA","53"=>"BB","54"=>"BC","55"=>"BD","56"=>"BE","57"=>"BF","58"=>"BG","59"=>"BH","60"=>"BI","61"=>"BJ","62"=>"BK","63"=>"BL","64"=>"BM","65"=>"BN","66"=>"BO","67"=>"BP","68"=>"BQ","69"=>"BR","70"=>"BS","71"=>"BT","72"=>"BU","73"=>"BV","74"=>"BW","75"=>"BX","76"=>"BY","77"=>"BZ","78"=>"CA","79"=>"CB","80"=>"CC","81"=>"CD","82"=>"CE","83"=>"CF","84"=>"CG","85"=>"CH","86"=>"CI","87"=>"CJ","88"=>"CK","89"=>"CL","90"=>"CM","91"=>"CN","92"=>"CO","93"=>"CP","94"=>"CQ","95"=>"CR","96"=>"CS","97"=>"CT","98"=>"CU","99"=>"CV","100"=>"CW","101"=>"CX","102"=>"CY","103"=>"CZ","104"=>"DA","105"=>"DB","106"=>"DC","107"=>"DD","108"=>"DE","109"=>"DF","110"=>"DG","112"=>"DH");

 
?>