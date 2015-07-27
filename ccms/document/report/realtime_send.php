<?php
require("../../inc/pub_func.php");

$with_rollup=trim($_REQUEST["with_rollup"]);
$user_group=trim($_REQUEST["user_group"]);
 
switch($action){
  	
 	//坐席实时报表
	case "agent_realtime_report":
 			
 		if($agent_list<>""){
			if(strpos($agent_list,",")>-1){
				$agent_list=str_replace(",","','",$agent_list);
				$agent_list="'".$agent_list."'";
				$sql1=" and a.user in(".$agent_list.")";
			}else{
				$sql1=" and a.user ='".$agent_list."'";
			}
		}
 
		if($campaign_id<>""){
			if(strpos($campaign_id,",")>-1){
				$campaign_id=str_replace(",","','",$campaign_id);
				$campaign_id="'".$campaign_id."'";
				$sql2=" and a.campaign_id in(".$campaign_id.") ";
				$sql2_status=" and campaign_id in(".$campaign_id.") ";
			}else{
				$sql2=" and a.campaign_id ='".$campaign_id."' ";
				$sql2_status=" and campaign_id ='".$campaign_id."' ";
			}
		}
 		
		if($user_group<>""){
			if(strpos($user_group,",")>-1){
				$user_group=str_replace(",","','",$user_group);
				$user_group="'".$user_group."'";
				$sql3=" and b.user_group in(".$user_group.") ";
			}else{
				$sql3=" and b.user_group ='".$user_group."' ";
			}
		}
		
		$wheres=$sql1.$sql2.$sql3;
  		
		$sql="select *,SEC_TO_TIME(call_time_s) as call_time_t from (select a.user,b.full_name,ifnull(f.phone_number,'') as phone_number,a.campaign_id,ifnull(c.campaign_name,'未知业务') as campaign_name,b.user_group,d.group_name ,a.calls_today,case when a.status not in('INCALL','QUEUE','PARK','3-WAY') then UNIX_TIMESTAMP(now())-UNIX_TIMESTAMP(last_state_change) when a.status='3-WAY' then UNIX_TIMESTAMP(now())-UNIX_TIMESTAMP(last_call_time) when a.status in('READY','PAUSED') then UNIX_TIMESTAMP(now())-UNIX_TIMESTAMP(last_state_change) when a.status='INCALL' and a.callerid not in(select callerid from(select callerid from vicidial_auto_calls)temp_tbl) then UNIX_TIMESTAMP(now())-UNIX_TIMESTAMP(last_state_change) else  UNIX_TIMESTAMP(now())-UNIX_TIMESTAMP(last_call_time) end as call_time_s ,case when a.status in('READY','PAUSED') and a.lead_id>0 then  'DISPO' when a.status='INCALL' and e.parked_channel>0 then 'PARK' when a.status='INCALL' and a.callerid not in(select callerid from(select callerid from vicidial_auto_calls)temp_tbl) then  'DEAD' else a.status end as call_status ,case when a.comments='AUTO' or LENGTH(a.comments)<1 then '自动' when a.comments='INBOUND' then '呼入' else '手动' end as comments from vicidial_live_agents a left join vicidial_users b on a.user=b.user left join vicidial_campaigns c on a.campaign_id=c.campaign_id left join vicidial_user_groups d on b.user_group=d.user_group left join (select count(*) as parked_channel,channel_group from parked_channels group by channel_group )e on a.callerid=e.channel_group left join vicidial_auto_calls f on a.lead_id=f.lead_id where 1=1 ".$wheres.")datas ".$sort_sql.";";
		
		//echo $sql;
		$rows=mysqli_query($db_conn,$sql);
		$row_counts_list=mysqli_num_rows($rows);			
		
		$list_arr=array();
		 
 		if ($row_counts_list!=0) {
			while($rs= mysqli_fetch_array($rows)){ 
 				$list=array("user"=>$rs['user'],"full_name"=>$rs['full_name'],"phone_number"=>$rs['phone_number'],"campaign_id"=>$rs['campaign_id'],"campaign_name"=>$rs['campaign_name'],"user_group"=>$rs['user_group'],"group_name"=>$rs['group_name'],"calls_today"=>$rs['calls_today'],"call_time_s"=>$rs['call_time_s'],"call_status"=>$rs['call_status'],"comments"=>$rs['comments'],"call_time_t"=>$rs['call_time_t']);
				 
				array_push($list_arr,$list);
			}
			$counts="1";
			$des="获取成功！";
		}else {
			$counts="0";
			$des="系统当前没有登录的坐席！";
			$list_arr=array('id'=>'none');
		}
  		mysqli_free_result($rows);
		
		
		//呼叫情况
 		$sql2="SELECT status,count(*) as counts from vicidial_auto_calls where status NOT IN('XFER') ".$sql2_status." group by status;";
 		//echo $sql;
		$rows=mysqli_query($db_conn,$sql2);
		$row_counts_list=mysqli_num_rows($rows);			
 		
		$list_arr_s=array();
		
  		if ($row_counts_list!=0) {
			while($rs= mysqli_fetch_array($rows)){ 
 				$list_s=array("status"=>$rs['status'],"counts"=>$rs['counts']);
 				array_push($list_arr_s,$list_s);
			}
 		} 
  		mysqli_free_result($rows);
   		
		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
 		$json_data.="\"des\":".json_encode($des).",";
		$json_data.="\"datalist\":".json_encode($list_arr).",";
		$json_data.="\"data_status_list\":".json_encode($list_arr_s)."";
 		$json_data.="}";
		
		echo $json_data;
	
	break;
 	
	//系统实时
	case "system_realtime_report":
  	 
		if($campaign_id<>""){
			if(strpos($campaign_id,",")>-1){
				$campaign_id=str_replace(",","','",$campaign_id);
				$campaign_id="'".$campaign_id."'";
				$sql1=" and campaign_id in(".$campaign_id.") ";
				 
			}else{
				$sql2=" and campaign_id ='".$campaign_id."' ";
				 
			}
		}
 		 
		$wheres=$sql1.$sql2.$sql3;
  		
		$sql_1="select ifnull(avg(auto_dial_level),0),min(dial_status_a),min(dial_status_b),min(dial_status_c),min(dial_status_d),min(dial_status_e),ifnull(min(lead_order),''),ifnull(min(lead_filter_id),'无'),ifnull(sum(hopper_level),0),ifnull(min(dial_method),'无'),ifnull(avg(adaptive_maximum_level),0),ifnull(avg(adaptive_dropped_percentage),0),ifnull(avg(adaptive_dl_diff_target),0),ifnull(avg(adaptive_intensity),0),ifnull(min(available_only_ratio_tally),''),ifnull(min(adaptive_latest_server_time),''),ifnull(min(local_call_time),''),ifnull(avg(dial_timeout),0),ifnull(min(dial_statuses),'无'),ifnull(max(agent_pause_codes_active),''),ifnull(max(list_order_mix),'') from vicidial_campaigns where active='Y' ".$wheres.";";
		
		//echo $sql_1;
		$rows=mysqli_query($db_conn,$sql_1);
		//$row_counts_list=mysqli_num_rows($rows);			
		 
 		//if ($row_counts_list!=0) {
			 
		$rs=mysqli_fetch_row($rows);
		
		if($rs[0]&&$rs[9]){
		
			$DIALlev =		$rs[0];
			$DIALstatusA =	$rs[1];
			$DIALstatusB =	$rs[2];
			$DIALstatusC =	$rs[3];
			$DIALstatusD =	$rs[4];
			$DIALstatusE =	$rs[5];
			$DIALorder =	$rs[6];
			$DIALfilter =	$rs[7];
			$HOPlev =		$rs[8];
			$DIALmethod =	$rs[9];
			$maxDIALlev =	$rs[10];
			$DROPmax =		$rs[11];
			//$targetDIFF =	$rs[12];
			//$ADAintense =	$rs[13]; //拨号强度
			//$ADAavailonly =	$rs[14];
			//$TAPERtime =	$rs[15]; //呼叫结束时间
			//$CALLtime =		$rs[16]; //本地呼叫时间
			$DIALtimeout =	$rs[17];
			$DIALstatuses =	$rs[18];
			$agent_pause_codes_active = $rs[19];
			$DIALmix =		$rs[20];
			
			mysqli_free_result($rows);
			
			//获取漏斗缓存号码
			$sql_2="select count(*) from vicidial_hopper where 1=1 ".$wheres.";";
			 
			$rows=mysqli_query($db_conn,$sql_2);
			$rs=mysqli_fetch_row($rows);
			$VDhop = $rs[0];
			
			mysqli_free_result($rows);
			
			//今日呼叫情况
			$sql_3="select ifnull(sum(dialable_leads),0),ifnull(sum(calls_today),0),ifnull(sum(drops_today),0),ifnull(avg(drops_answers_today_pct),0),ifnull(avg(differential_onemin),0),ifnull(avg(agents_average_onemin),0),ifnull(sum(balance_trunk_fill),0),ifnull(sum(answers_today),0),ifnull(max(status_category_1),0),ifnull(sum(status_category_count_1),0),ifnull(max(status_category_2),0),ifnull(sum(status_category_count_2),0),ifnull(max(status_category_3),0),ifnull(sum(status_category_count_3),0),ifnull(max(status_category_4),0),ifnull(sum(status_category_count_4),0) from vicidial_campaign_stats where 1=1 ".$wheres.";";
			
			//echo $sql3."<br/>";
			$rows=mysqli_query($db_conn,$sql_3);
			$rs=mysqli_fetch_row($rows);
			
			$DAleads =		$rs[0];
			$callsTODAY =	$rs[1];
			$dropsTODAY =	$rs[2];
			$drpctTODAY =	$rs[3];
			$diffONEMIN =	$rs[4];
			//$agentsONEMIN = $rs[5];
			$balanceFILL =	$rs[6];
			$answersTODAY = $rs[7];
			 
			$VSCcat1 =		$rs[8];
			$VSCcat1tally = $rs[9];
			$VSCcat2 =		$rs[10];
			$VSCcat2tally = $rs[11];
			$VSCcat3 =		$rs[12];
			$VSCcat3tally = $rs[13];
			$VSCcat4 =		$rs[14];
			$VSCcat4tally = $rs[15];
			 
			mysqli_free_result($rows);
			
			//短缺中继
			$sql_4="select ifnull(sum(local_trunk_shortage),0) from vicidial_campaign_server_stats where 1=1 ".$wheres.";";
			
			$rows=mysqli_query($db_conn,$sql_4);
			$rs=mysqli_fetch_row($rows);
			$balanceSHORT = $rs[0];
			
			mysqli_free_result($rows);
			
			if (ereg('DISABLED',$DIALmix)){
				$DIALstatuses = (preg_replace("/ -$|^ /","",$DIALstatuses));
				$DIALstatuses = (str_replace(' ',', ',$DIALstatuses));
				
			}else{
				$sql_5="select vcl_id from vicidial_campaigns_list_mix where status='ACTIVE' ".$wheres." limit 1;";
				
				$rows=mysqli_query($db_conn,$sql_5);
				$rs=mysqli_fetch_row($rows);
				
				if ($Lmix_to_print > 0){
					 
					$DIALstatuses = $rs[0];
					$DIALorder =	$rs[0];
				}
				mysqli_free_result($rows);
			}
			
			$counts="1";
			$des="获取成功！";
		}else{
			$counts="0";
			$des="未找到符合条件的数据！";	
		}
  			
		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
 		$json_data.="\"des\":".json_encode($des).",";
 		$json_data.="\"DIALlev\":".json_encode($DIALlev).",";
 		//$json_data.="\"DIALstatusA\":".json_encode($DIALstatusA).",";
 		//$json_data.="\"DIALstatusB\":".json_encode($DIALstatusB).",";
 		//$json_data.="\"DIALstatusC\":".json_encode($DIALstatusC).",";
 		//$json_data.="\"DIALstatusC\":".json_encode($DIALstatusC).",";
 		//$json_data.="\"DIALstatusE\":".json_encode($DIALstatusE).",";
 		$json_data.="\"DIALorder\":".json_encode($DIALorder).",";
 		$json_data.="\"DIALfilter\":".json_encode($DIALfilter).",";
 		$json_data.="\"HOPlev\":".json_encode($HOPlev).",";

 		$json_data.="\"DIALmethod\":".json_encode($DIALmethod).",";
 		$json_data.="\"maxDIALlev\":".json_encode($maxDIALlev).",";
 		$json_data.="\"DROPmax\":".json_encode($DROPmax).",";
 		//$json_data.="\"targetDIFF\":".json_encode($targetDIFF).",";
 		//$json_data.="\"ADAintense\":".json_encode($ADAintense).",";

 		//$json_data.="\"ADAavailonly\":".json_encode($ADAavailonly).",";
 		//$json_data.="\"TAPERtime\":".json_encode($TAPERtime).",";
 		//$json_data.="\"CALLtime\":".json_encode($CALLtime).",";
 		$json_data.="\"DIALtimeout\":".json_encode($DIALtimeout).",";
 		$json_data.="\"DIALstatuses\":".json_encode($DIALstatuses).",";

 		$json_data.="\"agent_pause_codes_active\":".json_encode($agent_pause_codes_active).",";
 		$json_data.="\"DIALmix\":".json_encode($DIALmix).",";
 		$json_data.="\"VDhop\":".json_encode($VDhop).",";
 		$json_data.="\"DAleads\":".json_encode($DAleads).",";
 		$json_data.="\"callsTODAY\":".json_encode($callsTODAY).",";
  		$json_data.="\"dropsTODAY\":".json_encode($dropsTODAY).",";
 		//$json_data.="\"drpctTODAY\":".json_encode($drpctTODAY).",";
 		//$json_data.="\"diffONEMIN\":".json_encode($diffONEMIN).",";
 		//$json_data.="\"agentsONEMIN\":".json_encode($agentsONEMIN).",";
 		$json_data.="\"balanceFILL\":".json_encode($balanceFILL).",";
		$json_data.="\"balanceSHORT\":".json_encode($balanceSHORT).",";
  		$json_data.="\"answersTODAY\":".json_encode($answersTODAY).",";
  		$json_data.="\"DIALstatuses\":".json_encode($DIALstatuses).",";
   
		$json_data.="\"NOW_TIME\":".json_encode(date("Y-m-d H:i:s"))."";
  		$json_data.="}";
		
		echo $json_data;
	
	break;
	
 	
	case "log_agent_out":
	
		if($user!=""){
			
			$now_date_epoch = date('U');
			$inactive_epoch = ($now_date_epoch - 60);
			$sql = "SELECT a.user,a.campaign_id,UNIX_TIMESTAMP(a.last_update_time),b.user_group from vicidial_live_agents a left join vicidial_users b on a.user=b.user where a.user='".$user."';";
			$rslt=mysqli_query($db_conn, $sql);
			$vla_ct = mysqli_num_rows($rslt);
			
			if ($vla_ct > 0){
				$rows=mysqli_fetch_row($rslt);
				$VLA_user =					$rows[0];
				$VLA_campaign_id =			$rows[1];
				$VLA_update_time =			$rows[2];
				$VAL_user_group =			$rows[3];
		
				if ($VLA_update_time > $inactive_epoch){
					$lead_active=0;
					$sql = "SELECT agent_log_id,user,server_ip,event_time,lead_id,campaign_id,pause_epoch,pause_sec,wait_epoch,wait_sec,talk_epoch,talk_sec,dispo_epoch,dispo_sec,status,user_group,comments,sub_status,dead_epoch,dead_sec from vicidial_agent_log where user='$VLA_user' order by agent_log_id desc LIMIT 1;";
					$rslt=mysqli_query($db_conn, $sql);
					 
					$val_ct = mysqli_num_rows($rslt);
					if ($val_ct > 0){
						$rows=mysqli_fetch_row($rslt);
						$VAL_agent_log_id =		$rows[0];
						$VAL_user =				$rows[1];
						$VAL_server_ip =		$rows[2];
						$VAL_event_time =		$rows[3];
						$VAL_lead_id =			$rows[4];
						$VAL_campaign_id =		$rows[5];
						$VAL_pause_epoch =		$rows[6];
						$VAL_pause_sec =		$rows[7];
						$VAL_wait_epoch =		$rows[8];
						$VAL_wait_sec =			$rows[9];
						$VAL_talk_epoch =		$rows[10];
						$VAL_talk_sec =			$rows[11];
						$VAL_dispo_epoch =		$rows[12];
						$VAL_dispo_sec =		$rows[13];
						$VAL_status =			$rows[14];
						$VAL_user_group =		$rows[15];
						$VAL_comments =			$rows[16];
						$VAL_sub_status =		$rows[17];
						$VAL_dead_epoch =		$rows[18];
						$VAL_dead_sec =			$rows[19];
		
						if ( ($VAL_wait_epoch < 1) || ( ($VAL_status == 'PAUSE') && ($VAL_dispo_epoch < 1) ) ){
							$VAL_pause_sec = ( ($now_date_epoch - $VAL_pause_epoch) + $VAL_pause_sec);
							$sql = "UPDATE vicidial_agent_log SET wait_epoch='$now_date_epoch', pause_sec='$VAL_pause_sec' where agent_log_id='$VAL_agent_log_id';";
							
						}else{
							if ($VAL_talk_epoch < 1){
								
								$VAL_wait_sec = ( ($now_date_epoch - $VAL_wait_epoch) + $VAL_wait_sec);
								$sql = "UPDATE vicidial_agent_log SET talk_epoch='$now_date_epoch', wait_sec='$VAL_wait_sec' where agent_log_id='$VAL_agent_log_id';";
								
							}else{
								$lead_active++;
								$status_update_SQL='';
								if ( ( (strlen($VAL_status) < 1) or ($VAL_status == 'NULL') ) and ($VAL_lead_id > 0) ){
									$status_update_SQL = ", status='PU'";
									
									$sql="UPDATE vicidial_list SET status='PU' where lead_id='$VAL_lead_id';";
									//mysqli_query($db_conn, $sql);
								}
								if ($VAL_dispo_epoch < 1){
									
									$VAL_talk_sec = ($now_date_epoch - $VAL_talk_epoch);
									$sql = "UPDATE vicidial_agent_log SET dispo_epoch='$now_date_epoch', talk_sec='$VAL_talk_sec'$status_update_SQL where agent_log_id='$VAL_agent_log_id';";
									
								}else{
									if ($VAL_dispo_sec < 1){
										$VAL_dispo_sec = ($now_date_epoch - $VAL_dispo_epoch);
										$sql = "UPDATE vicidial_agent_log SET dispo_sec='$VAL_dispo_sec' where agent_log_id='$VAL_agent_log_id';";
									}
								}
							}
						}
						
						if($sql!=""){
							mysqli_query($db_conn,$sql);
						}
						
					}
				}
		
				$sql="DELETE from vicidial_live_agents where user='".$user."';";
				mysqli_query($db_conn, $sql);
		
				$sql = "INSERT INTO vicidial_user_log (user,event,campaign_id,event_date,event_epoch,user_group) values('$VLA_user','LOGOUT','$VLA_campaign_id','$NOW_TIME','$now_date_epoch','$VAL_user_group');";
				
				mysqli_query($db_conn, $sql);
				
				$counts="1";
				$des="坐席： $full_name [$user] 已经被签退, 请确认该坐席关闭了浏览器！";
			
			}else{
				$counts="0";
				$des="坐席： $full_name [$user] 未登录, 请检查后重试！";	
			}
			
 			mysqli_free_result($rslt);
			
		}else{
			$counts="0";
			$des="未输入要签退的坐席工号, 请检查后重试！";	
		}
		
		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
 		$json_data.="\"des\":".json_encode($des)."";
   		$json_data.="}";
		
		echo $json_data;
		
	break;
	
	//获取等待电话列表
	case "get_calls_wait_list":
  			 
		if($campaign_id<>""){
			if(strpos($campaign_id,",")>-1){
				$campaign_id=str_replace(",","','",$campaign_id);
				$campaign_id="'".$campaign_id."'";
				$sql1=" and a.campaign_id in(".$campaign_id.") ";
				 
			}else{
				$sql2=" and a.campaign_id ='".$campaign_id."' ";
				 
			}
		}
		
		if($do_actions=="count"){
			
			$sql="select count(*) from vicidial_auto_calls a left join vicidial_campaigns b on a.campaign_id=b.campaign_id where a.status ='LIVE' ".$wheres." ";
			//echo $sql;
			$rows=mysqli_fetch_row(mysqli_query($db_conn,$sql));
			$counts=$rows[0];
			if(!$counts){$counts="0";}
			$des="d";
			$list_arr=array('id'=>'none');
			
		}else if($do_actions=="list"){
		
			$offset=($pages-1)*$pagesize;
			
			$sql="select a.server_ip,a.status,a.phone_number,ifnull(b.campaign_name,'未知业务') as campaign_name,a.campaign_id,case when a.call_type='OUT' then '呼出' else '呼入'end as call_type,UNIX_TIMESTAMP(now())-UNIX_TIMESTAMP(a.call_time) as call_time from vicidial_auto_calls a left join vicidial_campaigns b on a.campaign_id=b.campaign_id where a.status ='LIVE' ".$wheres." ".$sort_sql." limit ".$offset.",".$pagesize." ";
			//echo $sql;
			$rows=mysqli_query($db_conn,$sql);
			$row_counts_list=mysqli_num_rows($rows);			
			
			$list_arr=array();
			 
			if ($row_counts_list!=0) {
				while($rs= mysqli_fetch_array($rows)){ 
				 
					$list=array("server_ip"=>$rs['server_ip'],"status"=>$rs['status'],"phone_number"=>$rs['phone_number'],"campaign_name"=>$rs['campaign_name'],"campaign_id"=>$rs['campaign_id'],"call_type"=>$rs['call_type'],"call_time"=>$rs['call_time']);
					 
					array_push($list_arr,$list);
				}
				$counts="1";
				$des="获取成功！";
			}else {
				$counts="0";
				$des="未找到符合条件的数据！";
				$list_arr=array('id'=>'none');
			}
			
		} 
	 
		mysqli_free_result($rows);
 		 
		$json_data="{";
		$json_data.="\"counts\":".json_encode($counts).",";
		$json_data.="\"des\":".json_encode($des).",";
		$json_data.="\"datalist\":".json_encode($list_arr)."";
		$json_data.="}";
		
		echo $json_data;
		
	break;
	
	case "blind_monitor":
		if ($function == 'blind_monitor'){
		if(strlen($source)<2){
			$result = 'ERROR';
			$result_reason = "Invalid Source";
			echo "$result: $result_reason - $source\n";
			api_log($link,$api_logging,$api_script,$user,$agent_user,$function,$value,$result,$result_reason,$source,$data);
			echo "ERROR: Invalid Source: |$source|\n";
			exit;
		}else{
			$stmt="SELECT count(*) from vicidial_users where user='$user' and pass='$pass' and vdc_agent_api_access='1' and user_level > 6;";
			$rslt=mysql_query($stmt, $link);
			$row=mysql_fetch_row($rslt);
			$allowed_user=$row[0];
			if ( ($allowed_user < 1) and ($source != 'queuemetrics') ){
				$result = 'ERROR';
				$result_reason = "blind_monitor USER DOES NOT HAVE PERMISSION TO BLIND MONITOR";
				echo "$result: $result_reason: |$user|$allowed_user|\n";
				$data = "$allowed_user";
				api_log($link,$api_logging,$api_script,$user,$agent_user,$function,$value,$result,$result_reason,$source,$data);
				exit;
			}else{
				$stmt="SELECT count(*) from vicidial_conferences where conf_exten='$session_id' and server_ip='$server_ip';";
				$rslt=mysql_query($stmt, $link);
				$row=mysql_fetch_row($rslt);
				$session_exists=$row[0];
	
				if ($session_exists < 1){
					$result = 'ERROR';
					$result_reason = "blind_monitor INVALID SESSION ID";
					echo "$result: $result_reason - $session_id|$server_ip|$user\n";
					$data = "$session_id";
					api_log($link,$api_logging,$api_script,$user,$agent_user,$function,$value,$result,$result_reason,$source,$data);
					exit;
				}else{
					$stmt="SELECT count(*) from phones where login='$phone_login';";
					$rslt=mysql_query($stmt, $link);
					$row=mysql_fetch_row($rslt);
					$phone_exists=$row[0];
	
					if ( ($phone_exists < 1) and ($source != 'queuemetrics') ){
						$result = 'ERROR';
						$result_reason = "blind_monitor INVALID PHONE LOGIN";
						echo "$result: $result_reason - $phone_login|$user\n";
						$data = "$phone_login";
						api_log($link,$api_logging,$api_script,$user,$agent_user,$function,$value,$result,$result_reason,$source,$data);
						exit;
					}else{
						if ($source == 'queuemetrics'){
							$stmt="SELECT active_voicemail_server from system_settings;";
							$rslt=mysql_query($stmt, $link);
							$row=mysql_fetch_row($rslt);
							$monitor_server_ip =	$row[0];
							$dialplan_number =		$phone_login;
							$outbound_cid =			'';
							if (strlen($monitor_server_ip)<7){
								$monitor_server_ip = $server_ip;
							}
						}else{
							$stmt="SELECT dialplan_number,server_ip,outbound_cid from phones where login='$phone_login';";
							$rslt=mysql_query($stmt, $link);
							$row=mysql_fetch_row($rslt);
							$dialplan_number =	$row[0];
							$monitor_server_ip =$row[1];
							$outbound_cid =		$row[2];
						}
	
						$S='*';
						$D_s_ip = explode('.', $server_ip);
						if (strlen($D_s_ip[0])<2) {$D_s_ip[0] = "0$D_s_ip[0]";}
						if (strlen($D_s_ip[0])<3) {$D_s_ip[0] = "0$D_s_ip[0]";}
						if (strlen($D_s_ip[1])<2) {$D_s_ip[1] = "0$D_s_ip[1]";}
						if (strlen($D_s_ip[1])<3) {$D_s_ip[1] = "0$D_s_ip[1]";}
						if (strlen($D_s_ip[2])<2) {$D_s_ip[2] = "0$D_s_ip[2]";}
						if (strlen($D_s_ip[2])<3) {$D_s_ip[2] = "0$D_s_ip[2]";}
						if (strlen($D_s_ip[3])<2) {$D_s_ip[3] = "0$D_s_ip[3]";}
						if (strlen($D_s_ip[3])<3) {$D_s_ip[3] = "0$D_s_ip[3]";}
						$monitor_dialstring = "$D_s_ip[0]$S$D_s_ip[1]$S$D_s_ip[2]$S$D_s_ip[3]$S";
	
						$PADuser = sprintf("%08s", $user);
						while (strlen($PADuser) > 8){
 							$PADuser = substr("$PADuser", 0, -1);
						}
						$BMquery = "BM$StarTtime$PADuser";
	
						if ((ereg('MONITOR',$stage)) or (strlen($stage)<1) ) {
							$stage = '0';
						}
						if (ereg('BARGE',$stage)) {
							$stage = '';
						}
						if (ereg('HIJACK',$stage)) {
							$stage = '';
						}
	
						### insert a new lead in the system with this phone number
						$stmt = "INSERT INTO vicidial_manager values('','','$NOW_TIME','NEW','N','$monitor_server_ip','','Originate','$BMquery','Channel: Local/$monitor_dialstring$stage$session_id@default','Context; default','Exten: $dialplan_number','Priority: 1','Callerid: \"VC Blind Monitor\" <$outbound_cid>','','','','','');";
						if ($DB>0) {echo "DEBUG: blind_monitor query - $stmt\n";}
						$rslt=mysql_query($stmt, $link);
						$affected_rows = mysql_affected_rows($link);
						if ($affected_rows > 0){
							$man_id = mysql_insert_id($link);
	
							$result = 'SUCCESS';
							$result_reason = "blind_monitor HAS BEEN LAUNCHED";
							echo "$result: $result_reason - $phone_login|$monitor_dialstring$stage$session_id|$dialplan_number|$session_id|$man_id|$user\n";
							$data = "$phone_login|$monitor_dialstring|$session_id|$man_id";
							api_log($link,$api_logging,$api_script,$user,$agent_user,$function,$value,$result,$result_reason,$source,$data);
							}
						}
					}
				}
			}
		exit;
		}
	
	break;
	
 	default :
  
}

unset($list_arr);
unset($lists_arr); 
unset($json_data);
unset($sql); 
mysqli_close($db_conn);
 
?>