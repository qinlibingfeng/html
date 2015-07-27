<?php 
header( 'Expires: Sat, 26 Jul 1997 05:00:00 GMT' ); 
header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT' ); 
header( 'Cache-Control: no-store, no-cache, must-revalidate' ); 
header( 'Cache-Control: post-check=0, pre-check=0',false); 
header( 'Pragma: no-cache' ); 
 
header("content-type:text/html;charset=utf-8"); 
date_default_timezone_set('PRC');

$shell_cmd=stripslashes(trim($_REQUEST["shell_cmd"]));
$shell_do=trim($_REQUEST["shell_do"]);
$server_id=trim($_REQUEST["server_id"]);
$callback=$_REQUEST['callback'];
  
if($shell_cmd!=""){
	
	
	if($server_id=="1"){
		if($shell_cmd=="restart"){
			$shell_cmd="init 6";
		}else{
			$shell_cmd="init 0";	
		}
	}else{
		if($shell_cmd=="restart"){
			$shell_cmd="shutdown -r -t 5";
		}else{
			$shell_cmd="shutdown -s -t 5";	
		}
	}
	
	if($shell_cmd=="init 0"&&date("H")>16){
		exec("/usr/share/astguiclient/clear_today_count_p.pl");
	}
	
	if(exec($shell_cmd)){
		
 		$des=$shell_do."指令执行成功，请退出管理页！";
		$counts="1";
	}else{
		//$des=$shell_do."指令执行失败，请检查服务器后重试！";
		//$counts="0";
		$des=$shell_do."指令执行成功，请退出管理页！";
		$counts="1";
	}
	 
}else{
	$des="未收到指令，请检查重试！";
	$counts="0";
}
//echo "<script>window.parent.shell_result('".$counts."','".$des."','".$server_id."')<//script>";

$json_data="{";
$json_data.="\"counts\":".$counts.",";
$json_data.="\"des\":\"".$des."\",";
$json_data.="\"server_id\":".$server_id."";
$json_data.="}";
   
echo $callback.'('.$json_data.')';   

//exit();
?>
