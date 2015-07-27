<?php
function utf82gb($utfstr)
{
	if(function_exists('iconv'))
	{
		return iconv('utf-8','gbk//ignore',$utfstr);
	}
	global $UC2GBTABLE;
	$okstr = "";
	if(trim($utfstr)=="")
	{
		return $utfstr;
	}
	if(empty($UC2GBTABLE))
	{
		$filename = "../../data/gb2312-utf8.dat";
		$fp = fopen($filename,"r");
		while($l = fgets($fp,15))
		{
			$UC2GBTABLE[hexdec(substr($l, 7, 6))] = hexdec(substr($l, 0, 6));
		}
		fclose($fp);
	}
	$okstr = "";
	$ulen = strlen($utfstr);
	for($i=0;$i<$ulen;$i++)
	{
		$c = $utfstr[$i];
		$cb = decbin(ord($utfstr[$i]));
		if(strlen($cb)==8)
		{
			$csize = strpos(decbin(ord($cb)),"0");
			for($j=0;$j < $csize;$j++)
			{
				$i++; $c .= $utfstr[$i];
			}
			$c = utf82u($c);
			if(isset($UC2GBTABLE[$c]))
			{
				$c = dechex($UC2GBTABLE[$c]+0x8080);
				$okstr .= chr(hexdec($c[0].$c[1])).chr(hexdec($c[2].$c[3]));
			}
			else
			{
				$okstr .= "&#".$c.";";
			}
		}
		else
		{
			$okstr .= $c;
		}
	}
	$okstr = trim($okstr);
	return $okstr;
}
    
$filename=trim($_REQUEST["paths"]);
header("Content-Type:application/force-download");
if(file_exists(utf82gb($filename))){
 	 
	header("Content-Disposition: attachment;charset=utf-8;filename=".utf82gb(trim($_REQUEST["names"]))); 
	readfile(utf82gb($filename));
}else{
 	header("Content-Disposition: attachment;charset=utf-8;filename=".utf82gb("文件不存在.txt")); 
 	return false;	
}
?> 