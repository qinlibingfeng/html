<?php
require("../inc/config.ini.php");

if(!$db_host){$db_host="localhost";}
if(!$db__name){$db__name="asterisk";}
if(!$db__user){$db__user="cron";}
if(!$db__pass){$db__pass="1234";}
 

$db_conn = mysqli_connect("$db_host","$db__user","$db__pass");
 
if (!$db_conn){
	
    //die('数据库连接错误：'.mysqli_error());
	
	$json_data="{";
	$json_data=$json_data."\"counts\":\"0\",";
	$json_data=$json_data."\"des\":\"数据库连接错误\"";
 	$json_data=$json_data."}";
	
	echo $json_data;
	die();
}
mysqli_select_db($db_conn,$db__name);
mysqli_query($db_conn,"SET NAMES utf8"); 
  
$date_s=date("Y-m-d H",strtotime(" -1 hour"));
$date_e=date("Y-m-d H");
     
//----------------------

$del_fee_log="delete from data_report_fee_log_list where call_date between '".$date_s."' and '".$date_e."'";
mysqli_query($db_conn,$del_fee_log);
//echo $del_fee_log;
//$aff1 = mysql_affected_rows(); 
 
//$in_fee_log="insert into data_report_fee_log_list(call_date,campaign_id,list_id,user,status,counts,fee_length_sec,max_fee_length_sec) select left(a.call_date,13),a.campaign_id,a.list_id,a.user,a.status,count(*),sum(case when b.lead_id is not null then a.talk_length_sec else 0 end),ifnull(max(case when b.lead_id is not null then a.talk_length_sec else 0 end),0) from vicidial_log a left join vicidial_carrier_log b on a.lead_id=b.lead_id and TIMESTAMPDIFF(second,a.call_date,b.call_date) between -5 and 120 and b.dialstatus='ANSWER' where a.call_date BETWEEN '".$date_s.":00:00' and '".$date_e.":59:59' group by left(a.call_date,13),a.campaign_id,a.list_id,a.user,a.status ;";

$in_fee_log="insert into data_report_fee_log_list(call_date,campaign_id,list_id,user,status,counts,fee_length_sec,fee,max_fee_length_sec,max_fee) select left(call_date,13),campaign_id,list_id,user,status,count(*),sum(talk_length_sec ),sum(ceil(talk_length_sec/60)*0.07),ifnull(max(talk_length_sec ),0),max(ceil(talk_length_sec/60)*0.07) from vicidial_log where call_date BETWEEN '".$date_s.":00:00' and '".$date_e.":59:59' group by left(call_date,13),campaign_id,list_id,user,status;";


mysqli_query($db_conn,$in_fee_log); 
 
 
unset($del_fee_log); 
unset($in_fee_log);  

mysqli_close($db_conn);
unset($db_conn); 
echo "succ";
?>

