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

$sql="show tables";
$rows=mysqli_query($db_conn,$sql);
 
$tab_arr=array();

while($rs= mysqli_fetch_array($rows)){
	$table=$rs[0];
  	 
	//if (!ereg("^data_",$table)){
		 
		$table_chk=mysqli_query($db_conn,"check table ".$table." fast QUICK");
		//echo $table."<br>";
	//}
 	
	$rs_c = mysqli_fetch_row($table_chk);
	$chk_result=$rs_c[2];
	mysqli_free_result($table_chk);
	
	if(ereg("error|warning|corrupt|wrong",strtolower($chk_result))){
 		
		$rep_sql="repair table ".$table;
		mysqli_query($db_conn,$rep_sql);
		
		//echo " -----repair table ".$table."<br>";
	 
		$opt_sql="optimize table ".$table;
		mysqli_query($db_conn,$opt_sql);
		
		
	} 
	
}
mysqli_free_result($rows);

$opt_sql="truncate table call_log";
mysqli_query($db_conn,$opt_sql);
		
$opt_sql="optimize table call_log";
mysqli_query($db_conn,$opt_sql);

$opt_sql="truncate table server_performance";
mysqli_query($db_conn,$opt_sql);
		
$opt_sql="optimize table server_performance";
mysqli_query($db_conn,$opt_sql);


$opt_sql="insert into vicidial_carrier_log_archive select * from vicidial_carrier_log"; 

if(mysqli_query($db_conn,$opt_sql)){

	$opt_sql="truncate table vicidial_carrier_log";
	mysqli_query($db_conn,$opt_sql);
			
	$opt_sql="optimize table vicidial_carrier_log";
	mysqli_query($db_conn,$opt_sql); 
	
	$opt_sql="optimize table vicidial_carrier_log_archive";
	mysqli_query($db_conn,$opt_sql); 
}


$opt_sql="optimize table data_ask_result";
mysqli_query($db_conn,$opt_sql);
		
$opt_sql="optimize table data_quality_log";
mysqli_query($db_conn,$opt_sql);

$opt_sql="optimize table data_record_job_log";
mysqli_query($db_conn,$opt_sql);

$opt_sql="optimize table data_report_agent_log_list";
mysqli_query($db_conn,$opt_sql);

$opt_sql="optimize table data_report_call_log_list";
mysqli_query($db_conn,$opt_sql);

$opt_sql="truncate table data_cam_sale_alt_lists";
mysqli_query($db_conn,$opt_sql);

$opt_sql="optimize table data_cam_sale_alt_lists";
mysqli_query($db_conn,$opt_sql);

//----------------------------------------
//----------------------------------------

$date_s=date("Y-m-d 00:00");
$date_e=date("Y-m-d 23:59");
    
//----- 

$del_call_log="delete from data_report_call_log_list where call_date between '".$date_s."' and '".$date_e."'";
mysqli_query($db_conn,$del_call_log);
//echo $del_agent_log;
//$aff1 = mysql_affected_rows(); 
 
$in_call_log="insert into data_report_call_log_list(call_date,campaign_id,list_id,user,status,quality_status,counts,talk_length_sec,length_in_sec,max_talk_length_sec,max_length_in_sec ) select left(call_date,13),campaign_id,list_id,user,status,quality_status,count(*),sum(talk_length_sec),sum(length_in_sec),ifnull(max(talk_length_sec),0),ifnull(max(length_in_sec),0) from vicidial_log where call_date between '".$date_s."' and '".$date_e."' group by left(call_date,13),campaign_id,list_id,user,status,quality_status ;"; 

mysqli_query($db_conn,$in_call_log);


//----------------------

$del_agent_log="delete from data_report_agent_log_list where event_time between '".$date_s."' and '".$date_e."'";
mysqli_query($db_conn,$del_agent_log); 
//$aff3 = mysql_affected_rows();

$in_agent_log="insert into data_report_agent_log_list(event_time,campaign_id,user,status,sub_status,pause_sec,max_pause_sec,wait_sec,max_wait_sec,talk_sec,max_talk_sec,dispo_sec,max_dispo_sec,dead_sec,max_dead_sec,talk_length_sec,max_talk_length_sec,counts ) select  left(a.event_time,13),a.campaign_id,a.user,ifnull(a.status,''),a.sub_status,ifnull(sum(a.pause_sec),0),ifnull(max(a.pause_sec),0),ifnull(sum(a.wait_sec),0),ifnull(max(a.wait_sec),0),ifnull(sum(a.talk_sec),0),ifnull(max(a.talk_sec),0),ifnull(sum(a.dispo_sec),0),ifnull(max(a.dispo_sec),0),ifnull(sum(a.dead_sec),0),ifnull(max(a.dead_sec),0),ifnull(sum(b.talk_length_sec),0),ifnull(max(b.talk_length_sec),0),count(*) from vicidial_agent_log a left join vicidial_log b on a.vicidial_id=b.uniqueid where a.event_time BETWEEN '".$date_s."' and '".$date_e."' group by left(event_time,13),a.campaign_id,a.user,a.status,a.sub_status;";
 
mysqli_query($db_conn,$in_agent_log); 

//----------------------


/*$del_fee_log="delete from data_report_fee_log_list where call_date between '".$date_s."' and '".$date_e."'";
mysqli_query($db_conn,$del_fee_log);

//$aff3 = mysql_affected_rows();

$in_fee_log="insert into data_report_fee_log_list(call_date,campaign_id,list_id,user,status,counts,fee_length_sec,fee,max_fee_length_sec,max_fee) select left(call_date,13),campaign_id,list_id,user,status,count(*),sum(talk_length_sec ),sum(ceil(talk_length_sec/60)*0.07),ifnull(max(talk_length_sec ),0),max(ceil(talk_length_sec/60)*0.07) from vicidial_log where call_date BETWEEN '".$date_s."' and '".$date_e."' group by left(call_date,13),campaign_id,list_id,user,status;";
mysqli_query($db_conn,$in_fee_log); */


/*if(mysqli_query($db_conn,$in_agent_log)){ 
	$pev_day=date("Y-m-d",strtotime("-31 day"));
	
 	$opt_sql="INSERT IGNORE INTO vicidial_agent_log_archive select * from vicidial_agent_log where event_time<'".$pev_day." 00:00:01'";
	if(mysqli_query($db_conn,$opt_sql)){
		
		$opt_sql="delete from table vicidial_agent_log where event_time<'".$pev_day." 00:00:01'";
		mysqli_query($db_conn,$opt_sql);
	}
	
	$opt_sql="optimize table vicidial_agent_log";
	mysqli_query($db_conn,$opt_sql); 
	
	$opt_sql="optimize table vicidial_agent_log_archive";
	mysqli_query($db_conn,$opt_sql); 

}
 */
mysqli_close($db_conn); 
echo "succ";
?>

