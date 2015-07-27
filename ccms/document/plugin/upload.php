<?php
header( 'Expires: Sat, 26 Jul 1997 05:00:00 GMT' ); 
header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT' ); 
header( 'Cache-Control: no-store, no-cache, must-revalidate' ); 
header( 'Cache-Control: post-check=0, pre-check=0', false ); 
header( 'Pragma: no-cache' ); 

header("content-type:text/html;charset=utf-8"); 
date_default_timezone_set('PRC');

function create_dir(){
	$year_dir="../../data/upload/".date("Y");
	$month_dir=$year_dir."/".date("m");
	$day_dir=$month_dir."/".date("d");
	
	if(!file_exists($year_dir)){
		mkdir($year_dir,0777);	
	}
	if(!file_exists($month_dir)){
		mkdir($month_dir,0777);	
	}
	if(!file_exists($day_dir)){
		mkdir($day_dir,0777);	
	}
	return $day_dir;
}

 
function utf82gb($utfstr){
	if(function_exists('iconv')){
		return iconv('utf-8','gbk//ignore',$utfstr);
	}
	global $UC2GBTABLE;
	$okstr = "";
	if(trim($utfstr)==""){
		return $utfstr;
	}
	if(empty($UC2GBTABLE)){
		$filename = "../../data/gb2312-utf8.dat";
		$fp = fopen($filename,"r");
		while($l = fgets($fp,15)){
			$UC2GBTABLE[hexdec(substr($l, 7, 6))] = hexdec(substr($l, 0, 6));
		}
		fclose($fp);
	}
	$okstr = "";
	$ulen = strlen($utfstr);
	for($i=0;$i<$ulen;$i++){
		$c = $utfstr[$i];
		$cb = decbin(ord($utfstr[$i]));
		if(strlen($cb)==8){
			$csize = strpos(decbin(ord($cb)),"0");
			for($j=0;$j < $csize;$j++){
				$i++; $c .= $utfstr[$i];
			}
			$c = utf82u($c);
			if(isset($UC2GBTABLE[$c])){
				$c = dechex($UC2GBTABLE[$c]+0x8080);
				$okstr .= chr(hexdec($c[0].$c[1])).chr(hexdec($c[2].$c[3]));
			}else{
				$okstr .= "&#".$c.";";
			}
		}else{
			$okstr .= $c;
		}
	}
	$okstr = trim($okstr);
	return $okstr;
}
 
 
//GB转UTF-8编码
function gb2utf8($gbstr){
	if(function_exists('iconv'))
	{
		return iconv('gbk','utf-8//ignore',$gbstr);
	}
	global $CODETABLE;
	if(trim($gbstr)=="")
	{
		return $gbstr;
	}
	if(empty($CODETABLE))
	{
		$filename = "../../data/gb2312-utf8.dat";
		$fp = fopen($filename,"r");
		while ($l = fgets($fp,15))
		{
			$CODETABLE[hexdec(substr($l, 0, 6))] = substr($l, 7, 6);
		}
		fclose($fp);
	}
	$ret = "";
	$utf8 = "";
	while ($gbstr != '')
	{
		if (ord(substr($gbstr, 0, 1)) > 0x80)
		{
			$thisW = substr($gbstr, 0, 2);
			$gbstr = substr($gbstr, 2, strlen($gbstr));
			$utf8 = "";
			@$utf8 = u2utf8(hexdec($CODETABLE[hexdec(bin2hex($thisW)) - 0x8080]));
			if($utf8!="")
			{
				for ($i = 0;$i < strlen($utf8);$i += 3)
				$ret .= chr(substr($utf8, $i, 3));
			}
		}
		else
		{
			$ret .= substr($gbstr, 0, 1);
			$gbstr = substr($gbstr, 1, strlen($gbstr));
		}
	}
	return $ret;
} 
    
if (!empty($_FILES)) {
	//$startTime = time(); 	
	$tempFile = $_FILES['Filedata']['tmp_name'];
 	$targetFile = create_dir()."/".utf82gb($_FILES['Filedata']['name']);
	
 	$fileTypes = array('xls','txt','xlsx'); //文件类型
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	$load_time=date("YmdHis");
	
	if (in_array($fileParts['extension'],$fileTypes)){
		
		if($fileParts['extension']=="xls"){
			$tar_len=-4;
			$tar_type=".xls";
 		}elseif($fileParts['extension']=="xlsx"){
			$tar_len=-5;
			$tar_type=".xlsx";
 		}else{
			$tar_len=-4;
			$tar_type=".txt";
 		}
		
 		$targetFile=substr($targetFile,0,$tar_len).$load_time.$tar_type;
 		
		move_uploaded_file($tempFile,$targetFile);
		
 		$load_to_txt=$targetFile;
		if($fileParts['extension']=="xls"||$fileParts['extension']=="xlsx"){
			
			require("../plugin/PHPExcel.php");
 			if($fileParts['extension']=="xls"){
 				$_load_len=-4;
				$_load_excel='Excel5';
 			}else{
				$_load_len=-5;
				$_load_excel='Excel2007';
 			}
			
			$load_to_txt=substr($targetFile,0,$_load_len).".txt";
			$fp=fopen($load_to_txt,"w");
			$objReader = PHPExcel_IOFactory::createReader($_load_excel);
			
			$objPHPExcel = $objReader->load($targetFile);
 			foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
 			
				foreach ($worksheet->getRowIterator() as $row) {
 					
					$cellIterator = $row->getCellIterator();
					$cellIterator->setIterateOnlyExistingCells(false);
					
					foreach ($cellIterator as $cell) {
						if (!is_null($cell)) {
 							fwrite($fp,utf82gb(str_replace(array("\r\n","\r","\n"), "",$cell->getCalculatedValue())."\t"));
						}
					}
 					fwrite($fp,"\n");
				}
			}
			
			fclose($fp);
			
		} 
		
		$counts="1";
		$des="上传完成，即将执行导入过程！";
		
	}else {
		$counts="0";
		$des="上传失败，文件格式不正确！";
 	}
  		
}else{
	$counts="0";
	$des="上传失败，请检查文件后重新上传！";
 
}
	
$json_data="{";
$json_data.="\"counts\":".json_encode($counts).",";
$json_data.="\"file_path\":".json_encode(gb2utf8($load_to_txt)).",";
$json_data.="\"des\":".json_encode($des)."";
$json_data.="}";

echo $json_data;
if($counts=="0"){
	die();	
}
?>