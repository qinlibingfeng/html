<?php
require("../../inc/pub_func.php");
require("../../inc/pub_set.php");
        
switch($action){
	 
    //中继列表
	case "get_carrier_list":
  		 
		if($carrier_id<>""){
 			
			if(strpos($carrier_id,",")>-1){
				$carrier_id=str_replace(",","','",$carrier_id);
				$carrier_id="'".$carrier_id."'";
				$sql_carrier_id=" in(".$campaign_id.") ";
			}else{
				$sql_carrier_id=" like '%".$carrier_id."%' ";
			}
			$sql1=" and a.carrier_id ".$sql_carrier_id."";
		}
		
		if($carrier_name<>""){
 			$sql2=" and a.carrier_name like '%".$carrier_name."%'";
		} 
 		
		if($active<>""){
			$sql6=" and a.active='".$active."'";		
		} 
		
		if($carrier_description<>""){
			$sql7=" and a.carrier_description like '%".$carrier_description."%' ";	
		} 
		
		$wheres=$sql1.$sql2.$sql3.$sql4.$sql5.$sql6.$sql7;
		//获取记录集个数
		if($do_actions=="count"){
			
			$sql="select count(*) from vicidial_server_carriers a left join data_sys_status b on a.active=b.status and b.status_type='active' where 1=1 ".$wheres." ";
			//echo $sql;
			$rows=mysqli_fetch_row(mysqli_query($db_conn,$sql));
			$counts=$rows[0];
			if(!$counts){$counts="0";}
			$des="d";
			$list_arr=array('id'=>'none');
			
		}else if($do_actions=="list"){
		
			$offset=($pages-1)*$pagesize;
			
			$sql="SELECT a.carrier_id,a.carrier_name,a.server_ip,b.status_name as active,ifnull(a.carrier_description,'') as carrier_description,a.protocol from vicidial_server_carriers a left join data_sys_status b on a.active=b.status and b.status_type='active' where 1=1 ".$wheres." ".$sort_sql."  limit ".$offset.",".$pagesize." ";
  			//echo $sql;
 			$rows=mysqli_query($db_conn,$sql);
			$row_counts_list=mysqli_num_rows($rows);			
			
			$list_arr=array();
			 
			if ($row_counts_list!=0) {
				while($rs= mysqli_fetch_array($rows)){ 
				 
					$list=array("carrier_id"=>$rs['carrier_id'],"carrier_name"=>$rs['carrier_name'],"server_ip"=>$rs['server_ip'],"active"=>$rs['active'],"carrier_description"=>$rs['carrier_description'],"protocol"=>$rs['protocol']);
					 
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
     	  
	//添加、修改中继
	case "carrier_set":
  		
		if($do_actions=="add"){
			
			$sql="select carrier_id from vicidial_server_carriers where carrier_id='".$carrier_id."' limit 0,1";
 			//echo $sql;
			$rows=mysqli_query($db_conn,$sql);
			$row_counts_list=mysqli_num_rows($rows);			
			mysqli_free_result($rows);
			
			if ($row_counts_list!=0) {
 				$counts="0";
				$des="该中继ID已存在，请检查更换其他！";
				
			}else {
   			
				 $sql="insert into vicidial_server_carriers (carrier_id,carrier_name,registration_string,template_id,account_entry,protocol,globals_string,dialplan_entry,server_ip,active,carrier_description)
				  select '".$carrier_id."','".$carrier_name."','".$registration_string."','".$template_id."','".$account_entry."','".$protocol."','".$globals_string."','".$dialplan_entry."','".$server_ip."','".$active."','".$carrier_description."' from (select '".$carrier_id."' as carrier_id ) datas where not exists(select carrier_id from vicidial_server_carriers a where a.carrier_id=datas.carrier_id );";
  			 	//echo $sql;
				if(mysqli_query($db_conn,$sql)){
					
  					$counts="1";
					$des="新建中继 ".$carrier_id." 成功！";
					
					$up_sql="update servers SET rebuild_conf_files='Y' where generate_vicidial_conf='Y' and active_asterisk_server='Y'  and server_ip='".$server_ip."';";
					mysqli_query($db_conn,$up_sql);
					
 				}else{
					$counts="0";
					$des="新建中继 ".$carrier_id." 失败，请检查重试！";
 				}
			}
 			
		}else if($do_actions=="update"){			
			if($carrier_id!=""){
				
				$sql_1="update vicidial_server_carriers set carrier_name='".$carrier_name."',registration_string='".$registration_string."',template_id='".$template_id."',account_entry='".$account_entry."',protocol='".$protocol."',globals_string='".$globals_string."',dialplan_entry='".$dialplan_entry."',server_ip='".$server_ip."',active='".$active."',carrier_description='".$carrier_description."' where carrier_id='".$carrier_id."';";
 				
				if(mysqli_query($db_conn,$sql_1)){
					$counts="1";
					$des="修改中继 ".$carrier_id." 成功！";
					
					$up_sql="update servers SET rebuild_conf_files='Y' where generate_vicidial_conf='Y' and active_asterisk_server='Y'  and server_ip='".$server_ip."';";
					mysqli_query($db_conn,$up_sql);
					 
				}else{
					$counts="0";
					$des="修改中继 ".$carrier_id." 失败，系统错误，请检查重试！";
					 
				}
				
			}else{
				$counts="0";
				$des="修改中继 ".$carrier_id." 失败，中继ID不存在！";
			}
						
		}else if($do_actions=="copy"){
			$source_carrier_id=trim($_REQUEST["source_carrier_id"]);
			
			$sql="select carrier_id from vicidial_server_carriers where carrier_id='".$carrier_id."' limit 0,1";
 			//echo $sql;
			$rows=mysqli_query($db_conn,$sql);
			$row_counts_list=mysqli_num_rows($rows);			
			mysqli_free_result($rows);
			
			if ($row_counts_list!=0) {
 				$counts="0";
				$des="该中继ID已存在，请检查更换其他！";
				
			}else {
   			
				 $sql="insert into vicidial_server_carriers (carrier_id,carrier_name,carrier_description,registration_string,template_id,account_entry,protocol,globals_string,dialplan_entry,server_ip,active)
				  select '".$carrier_id."','".$carrier_name."','".$carrier_description."',registration_string,template_id,account_entry,protocol,globals_string,dialplan_entry,server_ip,active from vicidial_server_carriers  where carrier_id='".$source_carrier_id."';";
  			 	//echo $sql;
				if(mysqli_query($db_conn,$sql)){
					
  					$counts="1";
					$des="复制中继 ".$carrier_id." 成功！";
					
					$up_sql="update servers SET rebuild_conf_files='Y' where generate_vicidial_conf='Y' and active_asterisk_server='Y'  and server_ip='".$server_ip."';";
					mysqli_query($db_conn,$up_sql);
					
 				}else{
					$counts="0";
					$des="复制中继 ".$carrier_id." 失败，请检查重试！";
 				}
			}
 			
		} 
 		//echo $sql;
  		
 		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
  		$json_data.="\"des\":".json_encode($des)."";
  		$json_data.="}";
		
		echo $json_data;
	
	break;
    	
	//删除中继
  	case "del_carrier":
 		
		if($cid!=""){
			
			if(strpos($cid,",")>-1){
				$cid=str_replace(",","','",$cid);
				$cid="'".$cid."'";
				$where_sql=" in(".$cid.") ";
			}else{
				$where_sql=" ='".$cid."' ";
			}
 			
			$up_sql="update servers SET rebuild_conf_files='Y' where generate_vicidial_conf='Y' and active_asterisk_server='Y' and server_ip in(select server_ip from (select server_ip from vicidial_server_carriers where carrier_id ".$where_sql.") temp_tbl)";
			if (mysqli_query($db_conn,$up_sql)){
			 
				$sql_1="delete from vicidial_server_carriers where carrier_id ".$where_sql." ";
	 
				if (mysqli_query($db_conn,$sql_1)){
					$counts="1";
					$des="中继删除成功！";
				}else{
					$counts="0";
					$des="中继删除失败，请检查相关设置重试！";
				}
			
			}else{
				$counts="0";
				$des="中继删除失败，系统错误！";			
			}
			
		}else{
			$counts="0";
			$des="中继删除失败，请输入要删除的行！";			
		}
  		
 		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
 		$json_data.="\"des\":".json_encode($des)."";
  		$json_data.="}";
		
		echo $json_data;
		
	break;
 	
 	//获
	case "get_carrier_all_list":
 	
		$sql="select carrier_id,carrier_name,carrier_description,server_ip from vicidial_server_carriers order by carrier_id asc";
 		//echo $sql;
		$rows=mysqli_query($db_conn,$sql);
		$row_counts_list=mysqli_num_rows($rows);			
		
		$list_arr=array();
	 
 		if ($row_counts_list!=0) {
			while($rs= mysqli_fetch_array($rows)){ 
			
				$list=array("carrier_id"=>$rs['carrier_id'],"carrier_name"=>$rs['carrier_name'],"carrier_description"=>$rs['carrier_description'],"server_ip"=>$rs['server_ip']);
				array_push($list_arr,$list);
  			}
 			$counts="1";
			$des="获取成功！";
		}else {
			$counts="0";
			$des="未找到符合条件的数据！";
 		}
  		
  		mysqli_free_result($rows);
 		
		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
 		$json_data.="\"des\":".json_encode($des).",";
		$json_data.="\"datalist\":".json_encode($list_arr)."";
 		$json_data.="}";
		
		echo $json_data;
	
	break;
	 
	//验证中继是否存在
	case "check_carrier":
 		
		if($carrier_id!=""){
			$sql="select carrier_id from vicidial_server_carriers where carrier_id='".$carrier_id."' limit 0,1";
			
			//echo $sql;
			$rows=mysqli_query($db_conn,$sql);
			$row_counts_list=mysqli_num_rows($rows);			
			
			if ($row_counts_list>0) {
 				 
				$counts="0";
				$des="该中继ID已存在，请检查更换其他！";
			}else {
				$counts="1";
				$des="";
			}
			
			mysqli_free_result($rows);
			
		}else{
			$counts="-1";
			$des="未输入中继ID！";
		}
		
		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
 		$json_data.="\"des\":".json_encode($des).",";
		$json_data.="\"datalist\":".json_encode($list_arr)."";
 		$json_data.="}";
		
		echo $json_data;
	
	break;
	
	//修改服务器中继数
	case "update_server_trunks":
 		
		if($server_id!=""){
			$sql="select server_id from servers where server_id='".$server_id."' limit 0,1";
			
			//echo $sql;
			$rows=mysqli_query($db_conn,$sql);
			$row_counts_list=mysqli_num_rows($rows);			
			
			if ($row_counts_list>0) {
				
 				$up_sql="update servers set max_vicidial_trunks='".$max_vicidial_trunks."' where server_id='".$server_id."' ";
				if(mysqli_query($db_conn,$up_sql)){
					
					$up_sql="update servers set rebuild_conf_files='Y',rebuild_music_on_hold='Y' where generate_vicidial_conf='Y' and active_asterisk_server='Y';";
					mysqli_query($db_conn,$up_sql);
					
 					$counts="1";
					$des="服务器 ".$server_id." 中继数修改完成！";
				}else{
 					$counts="0";
					$des="服务器 ".$server_id." 中继数修改失败！";
				}
			}else {
				$counts="0";
				$des="中继数修改失败，服务器 ".$server_id." 不存在！";
			}
			
			mysqli_free_result($rows);
			
		}else{
			$counts="-1";
			$des="未输入服务器ID！";
		}
		
		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
 		$json_data.="\"des\":".json_encode($des)."";
  		$json_data.="}";
		
		echo $json_data;
	
	break;	
	
	//服务器修改
	case "update_system":
 		
		$use_non_latin =				trim($_REQUEST["use_non_latin"]);
		$webroot_writable =				trim($_REQUEST["webroot_writable"]);
		$enable_queuemetrics_logging =	trim($_REQUEST["enable_queuemetrics_logging"]);
		$queuemetrics_server_ip =		trim($_REQUEST["queuemetrics_server_ip"]);
		$queuemetrics_dbname =			trim($_REQUEST["queuemetrics_dbname"]);
		$queuemetrics_login =			trim($_REQUEST["queuemetrics_login"]);
		$queuemetrics_pass =			trim($_REQUEST["queuemetrics_pass"]);
		$queuemetrics_url =				trim($_REQUEST["queuemetrics_url"]);
		$queuemetrics_log_id =			trim($_REQUEST["queuemetrics_log_id"]);
		$queuemetrics_eq_prepend =		trim($_REQUEST["queuemetrics_eq_prepend"]);
		$vicidial_agent_disable =		trim($_REQUEST["vicidial_agent_disable"]);
		$allow_sipsak_messages =		trim($_REQUEST["allow_sipsak_messages"]);
		$admin_home_url =				trim($_REQUEST["admin_home_url"]);
		$enable_agc_xfer_log =			trim($_REQUEST["enable_agc_xfer_log"]);
		$db_schema_version =			trim($_REQUEST["db_schema_version"]);
		$auto_user_add_value =			trim($_REQUEST["auto_user_add_value"]);
		$timeclock_end_of_day =			trim($_REQUEST["timeclock_end_of_day"]);
		$timeclock_last_reset_date =	trim($_REQUEST["timeclock_last_reset_date"]);
		$vdc_header_date_format =		trim($_REQUEST["vdc_header_date_format"]);
		$vdc_customer_date_format =		trim($_REQUEST["vdc_customer_date_format"]);
		$vdc_header_phone_format =		trim($_REQUEST["vdc_header_phone_format"]);
		$vdc_agent_api_active =			trim($_REQUEST["vdc_agent_api_active"]);
		$qc_last_pull_time = 			trim($_REQUEST["qc_last_pull_time"]);
		$enable_vtiger_integration = 	trim($_REQUEST["enable_vtiger_integration"]);
		$vtiger_server_ip = 			trim($_REQUEST["vtiger_server_ip"]);
		$vtiger_dbname = 				trim($_REQUEST["vtiger_dbname"]);
		$vtiger_login = 				trim($_REQUEST["vtiger_login"]);
		$vtiger_pass = 					trim($_REQUEST["vtiger_pass"]);
		$vtiger_url = 					trim($_REQUEST["vtiger_url"]);
		$qc_features_active =			trim($_REQUEST["qc_features_active"]);
		$outbound_autodial_active =		trim($_REQUEST["outbound_autodial_active"]);
		$outbound_calls_per_second =	trim($_REQUEST["outbound_calls_per_second"]);
		$enable_tts_integration =		trim($_REQUEST["enable_tts_integration"]);
		$agentonly_callback_campaign_lock = trim($_REQUEST["agentonly_callback_campaign_lock"]);
		$sounds_central_control_active = trim($_REQUEST["sounds_central_control_active"]);
		$sounds_web_server =			trim($_REQUEST["sounds_web_server"]);
		$sounds_web_directory =			trim($_REQUEST["sounds_web_directory"]);
		$active_voicemail_server =		trim($_REQUEST["active_voicemail_server"]);
		$auto_dial_limit =				trim($_REQUEST["auto_dial_limit"]);
		$user_territories_active =		trim($_REQUEST["user_territories_active"]);
		$allow_custom_dialplan =		trim($_REQUEST["allow_custom_dialplan"]);
		$db_schema_update_date =		trim($_REQUEST["db_schema_update_date"]);
		$enable_second_webform =		trim($_REQUEST["enable_second_webform"]);
		$server_trunks =		trim($_REQUEST["server_trunks"]);
		
		$sql="UPDATE system_settings set use_non_latin='$use_non_latin',webroot_writable='$webroot_writable',enable_queuemetrics_logging='$enable_queuemetrics_logging',queuemetrics_server_ip='$queuemetrics_server_ip',queuemetrics_dbname='$queuemetrics_dbname',queuemetrics_login='$queuemetrics_login',queuemetrics_pass='$queuemetrics_pass',queuemetrics_url='$queuemetrics_url',queuemetrics_log_id='$queuemetrics_log_id',queuemetrics_eq_prepend='$queuemetrics_eq_prepend',vicidial_agent_disable='$vicidial_agent_disable',allow_sipsak_messages='$allow_sipsak_messages',admin_home_url='$admin_home_url',enable_agc_xfer_log='$enable_agc_xfer_log',timeclock_end_of_day='$timeclock_end_of_day',vdc_header_date_format='$vdc_header_date_format',vdc_customer_date_format='$vdc_customer_date_format',vdc_header_phone_format='$vdc_header_phone_format',vdc_agent_api_active='$vdc_agent_api_active',enable_vtiger_integration='$enable_vtiger_integration',vtiger_server_ip='$vtiger_server_ip',vtiger_dbname='$vtiger_dbname',vtiger_login='$vtiger_login',vtiger_pass='$vtiger_pass',vtiger_url='$vtiger_url',qc_features_active='$qc_features_active',outbound_autodial_active='$outbound_autodial_active',outbound_calls_per_second='$outbound_calls_per_second',enable_tts_integration='$enable_tts_integration',agentonly_callback_campaign_lock='$agentonly_callback_campaign_lock',sounds_central_control_active='$sounds_central_control_active',sounds_web_server='$sounds_web_server',sounds_web_directory='$sounds_web_directory',active_voicemail_server='$active_voicemail_server',auto_dial_limit='$auto_dial_limit',user_territories_active='$user_territories_active',allow_custom_dialplan='$allow_custom_dialplan',enable_second_webform='$enable_second_webform';";
  		
		if(mysqli_query($db_conn,$sql)){
			
			if($server_trunks!=""){
				$server_trunks_arr=explode("|",$server_trunks);

				foreach($server_trunks_arr as $trunks){
					$trunks_list=explode("#_#",$trunks);
  					 
					$up_sql="update servers set max_vicidial_trunks='".$trunks_list[0]."' where server_id='".$trunks_list[1]."';";
 					mysqli_query($db_conn,$up_sql);
					//echo $up_sql."<br/>";
 				}
				
				$up_sql="update servers set rebuild_conf_files='Y',rebuild_music_on_hold='Y' where generate_vicidial_conf='Y' and active_asterisk_server='Y';";
				mysqli_query($db_conn,$up_sql);
			}
 			
 			$counts="1";
			$des="系统设置修改完成！";
			
		}else{
 			$counts="0";
			$des="系统设置修改失败，请检查重试！";
		}
 		
		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
 		$json_data.="\"des\":".json_encode($des)."";
  		$json_data.="}";
		
		echo $json_data;
	
	break;
 	 
	//获取业务客户清单列表
	case "do_chk_system":
 
		$fast=trim($_REQUEST["chk_fast"]);
		$chk_rank=trim($_REQUEST["chk_rank"]);
		
		//终止死锁进程
		$sql="SHOW PROCESSLIST";
 		$rows=mysqli_query($db_conn,$sql);
 		while($rs= mysqli_fetch_array($rows)){
			 if($rs[6]!=""){
				 mysqli_query($db_conn,"kill ".$rs[0]);
			 }
		}
   		mysqli_free_result($rows);
		
 		//检查损坏表
 		$sql="show tables";
 		$rows=mysqli_query($db_conn,$sql);
		$all_count=0;
   		$bad_count=0;
		$chk_count=0;
		$tab_arr=array();
		
		while($rs= mysqli_fetch_array($rows)){
			$table=$rs[0];
			$all_count++;
			
			if($chk_rank=="system"){
				if (!ereg("_archive",$table)&&!ereg("data_",$table)){
					$chk_count++;
					$table_chk=mysqli_query($db_conn,"check table ".$table." ".$fast." ");
				}
			}else if($chk_rank=="system_data"){
				if (!ereg("data_",$table)){
					$chk_count++;
					$table_chk=mysqli_query($db_conn,"check table ".$table." ".$fast."  ");
 				}
			}else{
				$chk_count++;
				$table_chk=mysqli_query($db_conn,"check table ".$table." ".$fast."  ");
 			}
			
			$rs_c = mysqli_fetch_row($table_chk);
			$chk_result=$rs_c[2];
  			mysqli_free_result($table_chk);
			
			if(ereg("error|warning|corrupt|wrong",strtolower($chk_result))){
				$bad_count++;
				array_push($tab_arr,$table);
			} 
 			
		}
 		
		mysqli_free_result($rows);
		 
		$json_data="{";
		$json_data.="\"all_count\":".json_encode($all_count).",";
		$json_data.="\"bad_count\":".json_encode($bad_count).",";
		$json_data.="\"tab_arr\":".json_encode($tab_arr).",";
		$json_data.="\"chk_count\":".json_encode($chk_count)."";
		$json_data.="}";
		
		echo $json_data;
 		
	break;
 	
	//修复并优化损坏表
	case "do_repair_system":
 
		$tab_arr=trim($_REQUEST["tab_arr"]);
		$auto_optimize=trim($_REQUEST["auto_optimize"]);
 		
		//终止死锁进程
		$sql="SHOW PROCESSLIST";
 		$rows=mysqli_query($db_conn,$sql);
 		while($rs= mysqli_fetch_array($rows)){
			 if($rs[6]!=""){
				 mysqli_query($db_conn,"kill ".$rs[0]);
			 }
		}
   		mysqli_free_result($rows);
  		
		if($tab_arr!=""){
			$tab_arrs=explode(",",$tab_arr);
			
			foreach($tab_arrs as $table){
				$rep_sql="repair table ".$table;
				
				mysqli_query($db_conn,$rep_sql);
				
				if($auto_optimize=="y"){
					$opt_sql="optimize table ".$table;
					
					mysqli_query($db_conn,$opt_sql);
				}
  			}
		}
  				
		//----------------------------------------
		//----------------------------------------
		
		$date_s=date("Y-m-d 00:00");
		$date_e=date("Y-m-d 23:59");
			
		//----- 
		
		$del_agent_log="delete from data_report_call_log_list where call_date between '".$date_s."' and '".$date_e."'";
		mysqli_query($db_conn,$del_agent_log);
		//echo $del_agent_log;
		//$aff1 = mysql_affected_rows(); 
		 
		$in_call_log="insert into data_report_call_log_list(call_date,campaign_id,list_id,user,status,quality_status,counts,talk_length_sec,length_in_sec,max_talk_length_sec,max_length_in_sec ) select left(call_date,13),campaign_id,list_id,user,status,quality_status,count(*),sum(talk_length_sec),sum(length_in_sec),ifnull(max(talk_length_sec),0),ifnull(max(length_in_sec),0) from vicidial_log where call_date between '".$date_s."' and '".$date_e."' group by left(call_date,13),campaign_id,list_id,user,status,quality_status ;";
		
		//echo $in_call_log."\n";

		mysqli_query($db_conn,$in_call_log); 


		$in_call_log="insert into data_report_call_log_list(call_date,campaign_id,list_id,user,status,counts,talk_length_sec,length_in_sec,max_talk_length_sec,max_length_in_sec ) select left(call_date,13),campaign_id,list_id,user,status,count(*),sum(end_epoch-start_epoch),sum(length_in_sec),ifnull(max(end_epoch-start_epoch),0),ifnull(max(length_in_sec),0) from vicidial_closer_log where call_date between '".$date_s."' and '".$date_e."' group by left(call_date,13),campaign_id,list_id,user,status ;";
		
		//echo $in_call_log."\n";

		mysqli_query($db_conn,$in_call_log); 
		
		//$aff2 = mysql_affected_rows();
		
		//----------------------
		
		$del_agent_log="delete from data_report_agent_log_list where event_time between '".$date_s."' and '".$date_e."'";
		mysql_query($del_agent_log); 
		//$aff3 = mysql_affected_rows();
		
		$in_agent_log="insert into data_report_agent_log_list(event_time,campaign_id,user,status,sub_status,pause_sec,max_pause_sec,wait_sec,max_wait_sec,talk_sec,max_talk_sec,dispo_sec,max_dispo_sec,dead_sec,max_dead_sec,talk_length_sec,max_talk_length_sec,counts ) select  left(a.event_time,13),a.campaign_id,a.user,ifnull(a.status,''),a.sub_status,ifnull(sum(a.pause_sec),0),ifnull(max(a.pause_sec),0),ifnull(sum(a.wait_sec),0),ifnull(max(a.wait_sec),0),ifnull(sum(a.talk_sec),0),ifnull(max(a.talk_sec),0),ifnull(sum(a.dispo_sec),0),ifnull(max(a.dispo_sec),0),ifnull(sum(a.dead_sec),0),ifnull(max(a.dead_sec),0),ifnull(sum(b.talk_length_sec),0),ifnull(max(b.talk_length_sec),0),count(*) from vicidial_agent_log a left join vicidial_log b on a.vicidial_id=b.uniqueid where a.event_time BETWEEN '".$date_s."' and '".$date_e."' group by left(event_time,13),a.campaign_id,a.user,a.status,a.sub_status;";
		mysqli_query($db_conn,$in_agent_log); 
		//----------------------
		


		
		
 		$counts="1";
		$des="数据表修复完成！请告知坐席人员重新签入本系统！如问题仍存在，请再次检查修复！";
		
 		$json_data="{";
		$json_data.="\"counts\":".json_encode($counts).",";
		$json_data.="\"des\":".json_encode($des)."";
		$json_data.="}";
		
		echo $json_data;
 		
	break;
 	
	//简单获取服务器功能列表
	case "get_server_simple_list":
 			 
		if($do_actions=="count"){
 			 
			$counts=$server_count;
			if(!$counts){$counts="0";}
			$des="d";
			$list_arr=array('id'=>'none');
			
		}else if($do_actions=="list"){
 			//$db_host="192.168.23.170";
			if($db_server_ip==""){
				$db_server_ip=$db_host;	
			}
			
			$row_counts_list=$server_count;
			$list_arr=array();
  			 
			if ($row_counts_list!=0) {
				$list_arr=array(
					array("server_id"=>"1","server_name"=>"CentOS主机","server_type"=>"centos","server_ip"=>$db_server_ip,"server_info"=>"自动外呼、数据存储")
					
				);
				
				if($server_count!=1){
					if (strtoupper(PHP_OS) =='LINUX'){  
					    $two_server_type="centos";  
					} else {  
					    $two_server_type="windows";;  
					} 

					array_push($list_arr,array("server_id"=>"2","server_name"=>"WIN主机","server_type"=>$two_server_type,"server_ip"=>$_SERVER["HTTP_HOST"],"server_info"=>"报表查询、录音备份"));
				}
				
				if($three_server_ip!=""){
					array_push($list_arr,array("server_id"=>"3","server_name"=>"WIN主机","server_type"=>$three_server_type,"server_ip"=>$three_server_ip,"server_info"=>"报表查询、录音备份"));
				}
 				 
				$counts="1";
				$des="获取成功！";
			}else {
				$counts="0";
				$des="未找到符合条件的数据！";
				$list_arr=array('id'=>'none');
			}
			
		} 
 		 
		$json_data="{";
		$json_data.="\"counts\":".json_encode($counts).",";
		$json_data.="\"des\":".json_encode($des).",";
		$json_data.="\"datalist\":".json_encode($list_arr)."";
		$json_data.="}";
		
		echo $json_data;
		
	break;
	
	//呼叫结果修正
	case "repair_today_call":
 		
		$up_sql="update vicidial_log a ,vicidial_list b set a.status=b.status where a.call_date BETWEEN '".date("Y-m-d")." 00:00:01' and '".date("Y-m-d")." 23:40:01' and a.status='DISPO' and a.lead_id=b.lead_id";
		
		if(mysqli_query($db_conn,$up_sql)){
 			$counts="1";
			$des="呼叫结果修正完成！";
		}else{
			$counts="-1";
			$des="呼叫结果修正失败，请检查重试！";
		}
		
		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
 		$json_data.="\"des\":".json_encode($des)."";
 		$json_data.="}";
		
		echo $json_data;
	
	break;
	
	//获取默认线路IP
	case "get_def_carrier_server":
 	
		$sql="select account_entry from vicidial_server_carriers where carrier_id='goautodial'";
 		//echo $sql;
		$rows=mysqli_query($db_conn,$sql);
		$row_counts_list=mysqli_num_rows($rows);			
  	 
 		if ($row_counts_list!=0) {
			while($rs= mysqli_fetch_array($rows)){ 
 				 $carrier_str=$rs["account_entry"];
  			}
			
			if($carrier_str){
				$carrier_str_ary=explode("\n",$carrier_str);
 
				foreach ($carrier_str_ary as $carrier_str_p){
					
					$carrier_str_p = preg_replace("/ |>|\n|\r|\t|\#.*|;.*/","",$carrier_str_p);
					if (ereg("^host=", $carrier_str_p)){
						$carrier_server = preg_replace("/.*=/","",$carrier_str_p);
 					}
 				}
 			}else{
				$carrier_server="10.2.16.251";	
			}
			
 			$counts="1";
			$des="success";
		}else {
			$counts="0";
			$des="error";
			$carrier_server="0.0.0.0";
 		}
  		
  		mysqli_free_result($rows);
 		
		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
 		$json_data.="\"des\":".json_encode($des).",";
		$json_data.="\"carrier_server\":".json_encode($carrier_server)."";
 		$json_data.="}";
		
		echo $json_data;
	
	break;
 	
	//设定使用的默认中继IP
	case "set_def_carrier_server":
 		
		$carrier_server=trim($_REQUEST["carrier_server"]);
		//$current_server=trim($_REQUEST["current_server"]); 
		
		$sql="select account_entry from vicidial_server_carriers where carrier_id='goautodial'";
 		//echo $sql;
		$rows=mysqli_query($db_conn,$sql);
		$row_counts_list=mysqli_num_rows($rows);			
  	 
 		if ($row_counts_list!=0) {
			while($rs= mysqli_fetch_array($rows)){ 
 				 $carrier_str=$rs["account_entry"];
  			}
			
			if($carrier_str){
				$carrier_str_ary=explode("\n",$carrier_str);
 
				foreach ($carrier_str_ary as $carrier_str_p){
					
					$carrier_str_p = preg_replace("/ |>|\n|\r|\t|\#.*|;.*/","",$carrier_str_p);
					if (ereg("^host=", $carrier_str_p)){
						$current_server = preg_replace("/.*=/","",$carrier_str_p);
 					}
 				}
 			}else{
				$current_server="10.2.16.251";	
			}
			 
		}else { 
			$current_server="0.0.0.0";
 		}
  		
  		mysqli_free_result($rows); 
		
		function isIP($value,$match='/^(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9])\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9]|0)\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9]|0)\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[0-9])$/'){
			$v = trim($value);
			if(empty($v))
				return false;
			return preg_match($match,$v);
		}
		$new_ip=isIP($carrier_server);
		$old_ip=isIP($current_server); 
		
		if($carrier_server&&$new_ip=="1"&&$old_ip=="1"){
 
			$up_sql1="update vicidial_server_carriers set account_entry=replace(account_entry,'".$current_server."','".$carrier_server."') where carrier_id='goautodial';";
			
			$up_sql2="update servers SET rebuild_conf_files='Y' where generate_vicidial_conf='Y' and active_asterisk_server='Y';";
		
			if(mysqli_query($db_conn,$up_sql1)&&mysqli_query($db_conn,$up_sql2)){
				
				$counts="1";
				$des="系统默认中继设定完成，本设定将在1分钟内生效，如呼叫异常请等待或还原默认后重试!";
			}else{
				$counts="-1";
				$des="系统默认中继设定失败，请联系系统管理员!";
			}
			
		}else{
			$counts="-1";
			$des="系统默认中继设定失败，请联系系统管理员!";
		
		}		
		
		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
 		$json_data.="\"des\":".json_encode($des)."";
 		$json_data.="}";
		
		echo $json_data;
	
	break;
	
	default :
  
}

 
mysqli_close($db_conn);

?>