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
  
/*
function getMsecTime(){
	$arr = explode( ' ', microtime() );
	return $arr[0] + $arr[1];
}

$startTime = getMsecTime();
*/
 
$date_s=date("Y-m-d H:i:s",strtotime(" -25 minute"));
$date_e=date("Y-m-d H:i:s",strtotime(" -6 minute")); 

 
$up_sql1="update vicidial_log a,vicidial_list b set a.status=b.status where a.call_date BETWEEN '".$date_s."' and '".$date_e."' and a.status='DISPO' and a.lead_id=b.lead_id and a.user=b.user ;";
mysqli_query($db_conn,$up_sql1);

//------------
 
$up_sql2="update vicidial_log a left join vicidial_list b on a.lead_id=b.lead_id left join vicidial_lists c on a.list_id=c.list_id set a.phone_number=b.phone_number,a.campaign_id=c.campaign_id where a.call_date BETWEEN '".$date_s."' and '".$date_e."' and a.phone_number='';";
mysqli_query($db_conn,$up_sql2);

//------------

$up_sql21="truncate table data_tmp_log;";
mysqli_query($db_conn,$up_sql21);

//------------
$up_sql22="insert into data_tmp_log select phone_number,uniqueid,lead_id,call_date,user from vicidial_log where call_date BETWEEN '".$date_s."' and '".$date_e."' and comments='AUTO' and user!='VDAD' group by phone_number HAVING count(*)=1;";
mysqli_query($db_conn,$up_sql22);

//------------
$up_sql23="update recording_log a inner join data_tmp_log b on SUBSTRING(a.filename FROM 17 FOR 14) =b.phone_number and a.user=b.user and TIMESTAMPDIFF(second,b.call_date,a.start_time) BETWEEN -30 and 70 set a.lead_id=b.lead_id , a.vicidial_id=b.uniqueid where a.start_time BETWEEN '".$date_s."' and '".$date_e."';";
mysqli_query($db_conn,$up_sql23);

//------------

$up_sql3="insert into vicidial_log(uniqueid,lead_id,list_id,campaign_id,call_date,length_in_sec,status,phone_number,user,talk_length_sec)  select a.uniqueid,a.lead_id,b.list_id,c.campaign_id,a.call_date,0,case when a.dialstatus='ANSWER' then 'DROP' else 'NA' end,b.phone_number,'VDAD',a.answered_time from vicidial_carrier_log a left join vicidial_list b on a.lead_id=b.lead_id left join vicidial_lists c on b.list_id=c.list_id where not exists(select lead_id from vicidial_log where vicidial_log.lead_id=a.lead_id and vicidial_log.call_date BETWEEN '".$date_s."' and '".$date_e."') and a.call_date BETWEEN '".$date_s."' and '".$date_e."'";
mysqli_query($db_conn,$up_sql3);

//------------

$up_sql4="delete from vicidial_log where status='NA' and comments='AUTO' and phone_code='' AND call_date BETWEEN '".$date_s."' and '".$date_e."';";
mysqli_query($db_conn,$up_sql4);

//------------

$up_sql5="update vicidial_log a inner join vicidial_carrier_log b on a.lead_id=b.lead_id and TIMESTAMPDIFF(second,b.call_date,a.call_date) between -5 and 120 set a.status='DROP',a.talk_length_sec=b.answered_time where a.call_date BETWEEN '".$date_s."' and '".$date_e."' and a.status='NA' and a.comments='AUTO' and b.dialstatus='ANSWER' ;";
mysqli_query($db_conn,$up_sql5);

//------------

$up_sql6="delete from vicidial_log where call_date BETWEEN '".$date_s."' and '".$date_e."' and status in('DROP','NA') and start_epoch is null and lead_id in(select lead_id from(select lead_id from vicidial_log where call_date BETWEEN '".$date_s."' and '".$date_e."' group by lead_id HAVING count(*)>1)tmp);"; //and comments='auto' 
mysqli_query($db_conn,$up_sql6); 

//------------

//$up_sql7="update vicidial_list a inner join vicidial_log b on a.lead_id=b.lead_id and TIMESTAMPDIFF(second,a.last_local_call_time,b.call_date) between -5 and 120 set a.status=b.status 
// where b.call_date BETWEEN '".$date_s."' and '".$date_e."' and b.status in('NA','B','DROP');";
//mysqli_query($db_conn,$up_sql7);
 
//-------------------------------------------------
unset($date_s); 
unset($date_e); 
  
 
$date_s=date("Y-m-d H",strtotime(" -1 hour"));
$date_e=date("Y-m-d H");
    
//----------------------

$del_call_log="delete from data_report_call_log_list where call_date between '".$date_s."' and '".$date_e."'";
mysqli_query($db_conn,$del_call_log);
//echo $del_agent_log;
//$aff1 = mysql_affected_rows(); 
 
$in_call_log="insert into data_report_call_log_list(call_date,campaign_id,list_id,user,status,quality_status,counts,talk_length_sec,length_in_sec,max_talk_length_sec,max_length_in_sec ) select left(call_date,13),campaign_id,list_id,user,status,quality_status,count(*),sum(talk_length_sec),sum(length_in_sec),ifnull(max(talk_length_sec),0),ifnull(max(length_in_sec),0) from vicidial_log where call_date between '".$date_s.":00:00' and '".$date_e.":59:59' group by left(call_date,13),campaign_id,list_id,user,status,quality_status ;";

mysqli_query($db_conn,$in_call_log); 

//$aff2 = mysql_affected_rows();

//----------------------

$del_agent_log="delete from data_report_agent_log_list where event_time between '".$date_s."' and '".$date_e."'";
mysqli_query($db_conn,$del_agent_log); 
//$aff3 = mysql_affected_rows();

$in_agent_log="insert into data_report_agent_log_list(event_time,campaign_id,user,status,sub_status,pause_sec,max_pause_sec,wait_sec,max_wait_sec,talk_sec,max_talk_sec,dispo_sec,max_dispo_sec,dead_sec,max_dead_sec,talk_length_sec,max_talk_length_sec,counts ) select  left(a.event_time,13),a.campaign_id,a.user,ifnull(a.status,''),a.sub_status,ifnull(sum(a.pause_sec),0),ifnull(max(a.pause_sec),0),ifnull(sum(a.wait_sec),0),ifnull(max(a.wait_sec),0),ifnull(sum(a.talk_sec),0),ifnull(max(a.talk_sec),0),ifnull(sum(a.dispo_sec),0),ifnull(max(a.dispo_sec),0),ifnull(sum(a.dead_sec),0),ifnull(max(a.dead_sec),0),ifnull(sum(b.talk_length_sec),0),ifnull(max(b.talk_length_sec),0),count(*) from vicidial_agent_log a left join vicidial_log b on a.vicidial_id=b.uniqueid where a.event_time BETWEEN '".$date_s.":00:00' and '".$date_e.":59:59' group by left(event_time,13),a.campaign_id,a.user,a.status,a.sub_status;";
 
mysqli_query($db_conn,$in_agent_log); 
 //$aff4 = mysql_affected_rows(); 
 
 
/**************************************/

$del_lists_sql="truncate table data_cam_sale_alt_lists";
mysqli_query($db_conn,$del_lists_sql);  

$in_lists_sql="
insert into data_cam_sale_alt_lists
select c.list_id from data_cam_sale_alt a inner join (
select b.campaign_id,sum(counts) as cg from (select campaign_id from vicidial_live_agents group by campaign_id
) a inner join data_report_call_log_list b on a.campaign_id=b.campaign_id and b.status='CG'
) b on a.campaign_id=b.campaign_id and a.sale_alt_type='cam' and b.cg>a.sale_alt_num-1 inner join vicidial_lists c on a.campaign_id=c.campaign_id and c.active='Y'

union 

select c.list_id from data_cam_sale_alt a inner join (
select b.campaign_id,b.list_id,sum(counts) as cg from (select campaign_id from vicidial_live_agents group by campaign_id
) a inner join data_report_call_log_list b on a.campaign_id=b.campaign_id and b.status='CG' group by b.list_id
) b on a.campaign_id=b.campaign_id and a.sale_alt_type='list' and b.cg>a.sale_alt_num-1 inner join vicidial_lists c on b.list_id=c.list_id and c.active='Y';";

mysqli_query($db_conn,$in_lists_sql); 
$lists_aff = mysqli_affected_rows($db_conn);

if($lists_aff>0){
	
	$up_lists_sql="update vicidial_lists a inner join data_cam_sale_alt_lists b on a.list_id=b.list_id set a.active='N';";
	mysqli_query($db_conn,$up_lists_sql);
	
 	$del_hopper_sql="delete vicidial_hopper from data_cam_sale_alt_lists , vicidial_hopper where data_cam_sale_alt_lists.list_id=vicidial_hopper.list_id;";
	mysqli_query($db_conn,$del_hopper_sql);
}
 
 
/*$time2=time();
$file=dirname(__FILE__)."/repair_1.txt";
$fp=fopen($file,"a");
//chmod($file,0777);
$runTime = getMsecTime() - $startTime;

$repair_log=$del_agent_log."\t\n".$in_agent_log."\r\n\n";
$repair_log.=$aff1."\t".$aff2."\t".$aff3."\t".$aff4."\t".$runTime."\r\n";

echo $repair_log;
fwrite($fp,$repair_log);
fclose($fp);*/
//echo $repair_log;
 
unset($date_s); 
unset($date_e); 
unset($up_sql1); 
unset($up_sql2); 
unset($up_sql21); 
unset($up_sql22); 
unset($up_sql23); 
unset($up_sql3); 
unset($up_sql4); 
unset($up_sql5); 
unset($up_sql6); 
unset($up_sql7); 

unset($in_agent_log); 
unset($in_call_log); 
unset($del_agent_log); 
unset($del_call_log); 

unset($del_lists_sql); 
unset($in_lists_sql); 
unset($up_lists_sql); 
unset($del_hopper_sql);  

mysqli_close($db_conn);
unset($db_conn); 
echo "succ";
?>

