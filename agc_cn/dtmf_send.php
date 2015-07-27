<?php 
$db_host = "localhost";
$db_port = "";
$db_name = "asterisk";
$db_user = "cron";
$db_pass = "1234";

header( 'Expires: Sat, 26 Jul 1997 05:00:00 GMT' ); 
header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT' ); 
header( 'Cache-Control: no-store, no-cache, must-revalidate' ); 
header( 'Cache-Control: post-check=0, pre-check=0', false ); 
header( 'Pragma: no-cache' ); 
 
header("content-type:text/html;charset=utf-8"); 
date_default_timezone_set('PRC');
 
//数据库
$db_conn = mysqli_connect("$db_host$db_port","$db_user","$db_pass");
 
if (!$db_conn){
	
    //die('数据库连接错误：'.mysqli_error());
	
	$json_data="{";
	$json_data=$json_data."\"counts\":\"0\",";
	$json_data=$json_data."\"des\":\"数据库连接错误\"";
 	$json_data=$json_data."}";
	
	echo $json_data;
	die();
}
mysqli_select_db($db_conn,$db_name);
mysqli_query($db_conn,"SET NAMES utf8"); 

$uniqueid=trim($_REQUEST["uniqueid"]);
if($uniqueid!=""){
	
	$sql="select b.dtmf_value,b.id,case when b.dtmf_value=c.dtmf then 'y' else 'n' end is_true from call_log a left join dtmf_log b on a.channel=b.dtmf_channel left join vicidial_log d on d.uniqueid=a.uniqueid left join data_campaign_dtmf c on d.campaign_id=c.campaign_id where a.uniqueid='".$uniqueid."' order by b.id desc limit 1";
	
	$rows=mysqli_query($db_conn,$sql);
	$row_counts_list=mysqli_num_rows($rows);
	
 	if ($row_counts_list!=0) {
		while($rs= mysqli_fetch_array($rows)){ 
		 
			$dtmf_id=$rs["id"];
			$dtmf_value=$rs["dtmf_value"];
 			$is_true=$rs["is_true"];
		}
		$counts="1";
		$des="suc";
	}else {
		$counts="0";
		$des="null";
		
		$dtmf_id="0";
		$dtmf="0";
	}
	
}else{
	$counts="0";
	$des="uniqueid is null";
}


$json_data="{";
$json_data=$json_data."\"counts\":\"".$counts."\",";
$json_data=$json_data."\"des\":\"".$des."\",";
$json_data=$json_data."\"datalist\":[{\"dtmf_id\":\"".$dtmf_id."\",\"dtmf_value\":\"".$dtmf_value."\",\"is_true\":\"".$is_true."\"}]";

$json_data=$json_data."}";

echo $json_data;

mysqli_close($db_conn);
?>