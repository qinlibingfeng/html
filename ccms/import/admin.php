<?php
$dir = '/var/www/html/ccms/import/data';
$handle = opendir($dir);

$con = mysql_connect("10.201.107.82","root","anlaigz");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("crm_default", $con);
mysql_query("SET NAMES 'UTF8'");

while(false !== $file=(readdir($handle))){
	if(stripos($file,".txt")){
		//echo $file . "------------------------------------------<br>";
		$file_name = str_ireplace(".txt","",$file);
		$file = fopen($dir . "/" . $file, "r") or exit("Unable to open file!");
		while(!feof($file))
		{
			$line = trim(iconv("gb2312","utf8",fgets($file)));
			if($line!=""){
				$arr = explode("     ",$line);
				if(count($arr)==2){
					$sql = "insert into vtiger_phone_region(phone,type,city) value(\"" . $arr[0] . "\",\"" . $arr[1] . "\",\"" . $file_name . "\");";
					mysql_query($sql);
				}
			}
		}
		fclose($file);
	}
}
mysql_close($con);
closedir($handle);
echo "success";

?>
