<?php 
header( 'Expires: Sat, 26 Jul 1997 05:00:00 GMT' ); 
header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT' ); 
header( 'Cache-Control: no-store, no-cache, must-revalidate' ); 
header( 'Cache-Control: post-check=0, pre-check=0',false); 
header( 'Pragma: no-cache' ); 
 
header("content-type:text/html;charset=utf-8"); 
date_default_timezone_set('PRC');

$server_id=trim($_REQUEST["server_id"]);
$callback=$_REQUEST['callback'];
 
//$os = strtolower(PHP_OS);
//if(strpos($os, "win") === false){
	if(file_exists("/proc/loadavg")) {
		$load = file_get_contents("/proc/loadavg");
		$load = explode(' ', $load);
		
		$load_1=$load[0];
		$load_5=$load[1];
		$load_15=$load[2];				
		
	}elseif(function_exists("shell_exec")){
		$load = explode(' ', `uptime`);
		//return $load[count($load)-3] . ' ' . $load[count($load)-2] . ' ' . $load[count($load)-1];
		
		$load_1=$load[count($load)-3];
		$load_5=$load[count($load)-2];
		$load_15=$load[count($load)-1];
		
	}else{
		$load_1="0";
		$load_5="0";
		$load_15="0";
	}
//}  

$json_data="{";
$json_data.="\"counts\":\"1\",";
$json_data.="\"load_1\":\"".$load_1."\",";
$json_data.="\"load_5\":\"".$load_5."\",";
$json_data.="\"load_15\":\"".$load_15."\"";
$json_data.="}";

echo $callback.'('.$json_data.')';   

//exit();
?>
