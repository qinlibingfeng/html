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

$del_fee_log="UPDATE vicidial_campaign_stats SET dialable_leads='0', calls_today='0', answers_today='0', drops_today='0', drops_today_pct='0', drops_answers_today_pct='0', calls_hour='0', answers_hour='0', drops_hour='0', drops_hour_pct='0', calls_halfhour='0', answers_halfhour='0', drops_halfhour='0', drops_halfhour_pct='0', calls_fivemin='0', answers_fivemin='0', drops_fivemin='0', drops_fivemin_pct='0', calls_onemin='0', answers_onemin='0', drops_onemin='0', drops_onemin_pct='0', differential_onemin='0', agents_average_onemin='0', balance_trunk_fill='0', status_category_count_1='0', status_category_count_2='0', status_category_count_3='0', status_category_count_4='0';";
mysqli_query($db_conn,$del_fee_log);
 
$del_fee_log="optimize table vicidial_campaign_stats;";
mysqli_query($db_conn,$del_fee_log);
 
$del_fee_log="UPDATE vicidial_drop_rate_groups SET calls_today='0', answers_today='0', drops_today='0', drops_today_pct='0', drops_answers_today_pct='0';";
mysqli_query($db_conn,$del_fee_log);
 
$del_fee_log="optimize table vicidial_drop_rate_groups;";
mysqli_query($db_conn,$del_fee_log);
 
$del_fee_log="delete from vicidial_campaign_server_stats;";
mysqli_query($db_conn,$del_fee_log);
 
$del_fee_log="optimize table vicidial_campaign_server_stats;";
mysqli_query($db_conn,$del_fee_log);
 
$del_fee_log="update vicidial_inbound_group_agents SET calls_today=0;";
mysqli_query($db_conn,$del_fee_log);
 
$del_fee_log="optimize table vicidial_inbound_group_agents;";
mysqli_query($db_conn,$del_fee_log);
 
$del_fee_log="update vicidial_campaign_agents SET calls_today=0;";
mysqli_query($db_conn,$del_fee_log);
 
$del_fee_log="optimize table vicidial_campaign_agents;";
mysqli_query($db_conn,$del_fee_log);
 
$del_fee_log="optimize table vicidial_live_inbound_agents;";
mysqli_query($db_conn,$del_fee_log);
 
$del_fee_log="delete from vicidial_live_agents;";
mysqli_query($db_conn,$del_fee_log);
 
$del_fee_log="optimize table vicidial_live_agents;";
mysqli_query($db_conn,$del_fee_log);
 
$del_fee_log="delete from vicidial_auto_calls;";
mysqli_query($db_conn,$del_fee_log);
 
$del_fee_log="optimize table vicidial_auto_calls;";
mysqli_query($db_conn,$del_fee_log);
   
  
unset($del_fee_log); 
unset($in_fee_log);  

mysqli_close($db_conn);
unset($db_conn); 
echo "succ";
?>

