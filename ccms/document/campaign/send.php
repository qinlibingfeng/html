<?php
require("../../inc/pub_func.php");
require("../../inc/pub_set.php");
        
switch($action){
	 
    //活动列表
	case "get_campaign_list":
  		 
		if($campaign_id<>""){
 			
			if(strpos($campaign_id,",")>-1){
				$campaign_id=str_replace(",","','",$campaign_id);
				$campaign_id="'".$campaign_id."'";
				$sql_campaign_id=" in(".$campaign_id.") ";
			}else{
				$sql_campaign_id=" like '%".$campaign_id."%' ";
			}
			$sql1=" and campaign_id ".$sql_campaign_id."";
		}/*else{
			
			if($_SESSION["allow_campaigns"]=="none"){
				$sql1=" ";
				
			}elseif($_SESSION["session_campaigns_list"]!=""){
				
				if(strpos($_SESSION["session_campaigns_list"],",")>-1){
					 
					$sql1=" and campaign_id in(".$_SESSION["session_campaigns_list"].")";
				}else{
					$sql1=" and campaign_id =".$_SESSION["session_campaigns_list"];
				}	
			}
				
		}*/
		
		if($campaign_name<>""){
 			$sql2=" and campaign_name like '%".$campaign_name."%'";
		} 
		
		if($dial_method<>""){
 			$sql3=" and dial_method ='".$dial_method."'";
		}
		
		if($auto_dial_level<>""){
			$sql4=" and auto_dial_level='".$auto_dial_level."'";		
		} 
		
		if($campaign_cid<>""){
			if(strpos($campaign_cid,",")>-1){
				$campaign_cid=str_replace(",","','",$campaign_cid);
				$campaign_cid="'".$campaign_cid."'";
				$sql_campaign_cid=" in(".$campaign_cid.") ";
			}else{
				$sql_campaign_cid=" like '%".$campaign_cid."%' ";
			}
			$sql5=" and campaign_cid ".$sql_campaign_cid."";		
		} 
		
		if($campaign_active<>""){
			$sql6=" and active='".$campaign_active."'";		
		} 
		
		if($campaign_description<>""){
			$sql7=" and campaign_description like '%".$campaign_description."%' ";	
		} 
		
		$wheres=$sql1.$sql2.$sql3.$sql4.$sql5.$sql6.$sql7;
		//获取记录集个数
		if($do_actions=="count"){
			
			$sql="select count(*) from vicidial_campaigns a left join data_sys_status b on a.dial_method=b.status and b.status_type='dial_method' where 1=1 ".$wheres." ";
			//echo $sql;
			$rows=mysqli_fetch_row(mysqli_query($db_conn,$sql));
			$counts=$rows[0];
			if(!$counts){$counts="0";}
			$des="d";
			$list_arr=array('id'=>'none');
			
		}else if($do_actions=="list"){
		
			$offset=($pages-1)*$pagesize;
			
			$sql="select campaign_id,campaign_name,campaign_description,case when active='Y' then '启用' else '禁用' end as active,lead_order,hopper_level,auto_dial_level,campaign_cid,a.dial_statuses,b.status_name from vicidial_campaigns a left join data_sys_status b on a.dial_method=b.status and b.status_type='dial_method' where 1=1 ".$wheres." ".$sort_sql." limit ".$offset.",".$pagesize." ";
			
 			//echo $sql;
			
			$rows=mysqli_query($db_conn,$sql);
			$row_counts_list=mysqli_num_rows($rows);			
			
			$list_arr=array();
			 
			if ($row_counts_list!=0) {
				while($rs= mysqli_fetch_array($rows)){ 
				 
					$list=array("campaign_id"=>$rs['campaign_id'],"campaign_name"=>$rs['campaign_name'],"campaign_description"=>$rs['campaign_description'],"active"=>$rs['active'],"lead_order"=>$rs['lead_order'],"hopper_level"=>$rs['hopper_level'],"auto_dial_level"=>$rs['auto_dial_level'],"campaign_cid"=>$rs['campaign_cid'],"dial_statuses"=>$rs['dial_statuses'],"status_name"=>$rs['status_name']);
					 
					array_push($list_arr,$list);
				}
				$counts="1";
				$des="sucess";
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
	
	//获取活动列表
	case "get_campaigns_list":
		 
 		if($active!=""){
			$wheres=" where active='".$active."' ";
		}
		
		$sql="select a.campaign_id,a.campaign_name,a.dial_method,b.status_name from vicidial_campaigns a left join data_sys_status b on a.dial_method=b.status and b.status_type='dial_method' ".$wheres." order by a.campaign_name,a.campaign_id";
  		$rows=mysqli_query($db_conn,$sql);
		$row_counts_list=mysqli_num_rows($rows);			
		
		$list_arr=array();
		 
		$MANUAL_ary=array();
		$INBOUND_MAN_ary=array();
		$RATIO_ary=array();
		$ADAPT_HARD_LIMIT_ary=array();
		$ADAPT_TAPERED_ary=array();
		$ADAPT_AVERAGE_ary=array();
 		
		$man_ary_c=0;
		$inb_ary_c=0;
		$ratio_ary_c=0;
		$adpat_h_ary_c=0;
		$adpat_t_ary_c=0;
		$adpat_a_ary_c=0;
 		
 		if ($row_counts_list!=0){
			while($rs= mysqli_fetch_array($rows)){ 
			
				$list=array("o_val"=>$rs['campaign_id'],"o_name"=>$rs['campaign_name']);
 				
				if($rs["dial_method"]=="MANUAL"){
					array_push($MANUAL_ary,$list);
					$man_ary_c=1;
				}elseif($rs["dial_method"]=="INBOUND_MAN"){
					array_push($INBOUND_MAN_ary,$list);
					$inb_ary_c=1;
				}elseif($rs["dial_method"]=="RATIO"){
					array_push($RATIO_ary,$list);
					$ratio_ary_c=1;
				}elseif($rs["dial_method"]=="ADAPT_HARD_LIMIT"){
					array_push($ADAPT_HARD_LIMIT_ary,$list);
					$adpat_h_ary_c=1;
				}elseif($rs["dial_method"]=="ADAPT_TAPERED"){
					array_push($ADAPT_TAPERED_ary,$list);
					$adpat_t_ary_c=1;
				}elseif($rs["dial_method"]=="ADAPT_AVERAGE"){
					array_push($ADAPT_AVERAGE_ary,$list);
					$adpat_a_ary_c=1;
				}
  			}
			
			if($man_ary_c==1){
				array_push($list_arr,array("o_name"=>"手动-MANUAL","o_c_list"=>$MANUAL_ary));	
			}
			
			if($inb_ary_c==1){
				array_push($list_arr,array("o_name"=>"手动-INBOUND_MAN ","o_c_list"=>$INBOUND_MAN_ary));	
			}
			
			if($ratio_ary_c==1){
				array_push($list_arr,array("o_name"=>"自动-RATIO","o_c_list"=>$RATIO_ary));	
			}
			
			if($adpat_h_ary_c==1){
				array_push($list_arr,array("o_name"=>"自动-ADAPT_HARD_LIMIT","o_c_list"=>$ADAPT_HARD_LIMIT_ary));	
			}
			if($adpat_t_ary_c==1){
				array_push($list_arr,array("o_name"=>"自动-ADAPT_TAPERED","o_c_list"=>$ADAPT_TAPERED_ary));	
			}
 			
			if($adpat_a_ary_c==1){
				array_push($list_arr,array("o_name"=>"自动-ADAPT_AVERAGE","o_c_list"=>$ADAPT_AVERAGE_ary));	
			}
 			 
			$counts="1";
			$des="sucess";
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
		 
		unset($MANUAL_ary);
		unset($INBOUND_MAN_ary); 
		unset($RATIO_ary);
		unset($ADAPT_HARD_LIMIT_ary); 
		unset($ADAPT_TAPERED_ary); 
		unset($ADAPT_AVERAGE_ary); 
	break;
    	
	//获取呼叫模式列表
	case "get_dial_method":
 	
		$sql="select status,status_name from data_sys_status where status_type='dial_method' ";
		
		//echo $sql;
		$rows=mysqli_query($db_conn,$sql);
		$row_counts_list=mysqli_num_rows($rows);			
		
		$list_arr=array();
		$mod_auto=array();
		$mod_man=array();
		
 		if ($row_counts_list!=0) {
			while($rs= mysqli_fetch_array($rows)){ 
			
				$status_name=$rs['status_name'];
				
				$list=array("o_val"=>$rs['status'],"o_name"=>$status_name);
 				
				if (ereg("自动",$status_name)){
 					array_push($mod_auto,$list);
				}else{
					array_push($mod_man,$list);
				}
  			}
			array_push($list_arr,array("o_name"=>"手动模式","o_c_list"=>$mod_man));
			array_push($list_arr,array("o_name"=>"自动模式","o_c_list"=>$mod_auto));
			
			$counts="1";
			$des="sucess";
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
 	
	//获取呼叫级别列表
	case "get_auto_dial_level":
 		
		$sql = "select auto_dial_limit from system_settings;";
		$rows=mysqli_fetch_row(mysqli_query($db_conn,$sql));
		if($rows){
			$counts="1";
 			$SSauto_dial_limit=$rows[0];
 			 
			$adl=0;
			$list_arr=array(array("o_val"=>"0","o_name"=>"0"));
			
			while($adl <= $SSauto_dial_limit){
				 
				if ($adl < 1){$adl = ($adl + 1);}
				else{
					if ($adl < 3){$adl = ($adl + 0.1);}
					else{
						if ($adl < 8){$adl = ($adl + 0.25);}
						else{
							if ($adl < 11){$adl = ($adl + 0.5);}
							else{
								if ($adl < 15){$adl = ($adl + 1);}
								else{
									if ($adl < 20){$adl = ($adl + 2);}
										else{
											if ($adl < 40){$adl = ($adl + 5);}
											else{
												if ($adl < 200){$adl = ($adl + 10);}
												else{
													if ($adl < 400){$adl = ($adl + 50);}
													else{
														if ($adl < 1000){$adl = ($adl + 100);}
														else{$adl = ($adl + 1);}
												}
											}
										}
									}
								}
							}
						}
					}
				}
				$list=array("o_val"=>"".$adl."","o_name"=>"".$adl."");
				array_push($list_arr,$list);
			}
		}else{
			$counts="0";
		}
    	
		mysqli_free_result($rows);
		
		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
 		$json_data.="\"des\":".json_encode($des).",";
		$json_data.="\"datalist\":".json_encode($list_arr)."";
 		$json_data.="}";
		
		echo $json_data;
	
	break;
		
 	//获取业务可呼叫状态
	case "get_dial_status":
 		
		$sql="select status,status_name from data_sys_status where status_type='call_status' order by status_name,status";
 		//echo $sql;
		$rows=mysqli_query($db_conn,$sql);
		$row_counts_list=mysqli_num_rows($rows);			
		
		$list_arr=array();
		 
 		if ($row_counts_list!=0) {
			while($rs= mysqli_fetch_array($rows)){ 
			
				$list=array("o_val"=>$rs['status'],"o_name"=>$rs['status_name']);
				array_push($list_arr,$list);
  			}
 			$counts="1";
			$des="sucess";
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
	
 	
	//验证活动是否存在
	case "check_campaign":
 		
		if($campaign_id!=""){
			$sql="select campaign_id from vicidial_campaigns where campaign_id='".$campaign_id."' limit 0,1";
			
			//echo $sql;
			$rows=mysqli_query($db_conn,$sql);
			$row_counts_list=mysqli_num_rows($rows);			
			
			if ($row_counts_list!=0) {
 				 
				$counts="0";
				$des="该活动ID已存在，请检查更换其他！";
			}else {
				$counts="1";
				$des="";
			}
			
			mysqli_free_result($rows);
			
		}else{
			$counts="-1";
			$des="未输入活动ID！";
		}
		
		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
 		$json_data.="\"des\":".json_encode($des)."";
 		$json_data.="}";
		
		echo $json_data;
	
	break;	
 	
	//添加活动
	case "campaign_set":
  		$old_dial_method=trim($_REQUEST["old_dial_method"]);
		
		if($dial_method==""){$dial_method=$old_dial_method;}
		
		if($do_actions=="add"){
			
			$sql="select campaign_id from vicidial_campaigns where campaign_id='".$campaign_id."' limit 0,1";
 			//echo $sql;
			$rows=mysqli_query($db_conn,$sql);
			$row_counts_list=mysqli_num_rows($rows);			
			mysqli_free_result($rows);
			
			if ($row_counts_list!=0) {
 				$counts="0";
				$des="该活动ID已存在，请检查更换其他！";
				
			}else {
   			
				 $sql="insert into vicidial_campaigns (campaign_name,campaign_id,active,campaign_description,lead_order,web_form_address,allow_closers,hopper_level,auto_dial_level,next_agent_call,local_call_time,dial_timeout,dial_prefix,campaign_cid,campaign_recording,campaign_script,get_call_launch,lead_filter_id,use_internal_dnc,dial_method,adaptive_latest_server_time,dial_statuses,no_hopper_leads_logins,manual_dial_filter,use_campaign_dnc,view_calls_in_queue,view_calls_in_queue_launch,pause_after_each_call,agent_dial_owner_only,agent_display_dialable_leads,agent_select_territories,crm_popup_login,crm_login_address,timer_action_seconds,omit_phone_code,adaptive_dropped_percentage,agent_pause_codes_active,display_queue_count,hangup_stop_rec,display_dtmf_alter)
				  select '".$campaign_name."',campaign_id,'".$active."','".$campaign_description."','".$lead_order."','".mysqli_real_escape_string($db_conn,$web_form_address)."','".$allow_closers."','".$hopper_level."','".$auto_dial_level."','".$next_agent_call."','".$local_call_time."','".$dial_timeout."','".$dial_prefix."','".$campaign_cid."','".$campaign_recording."','".$campaign_script."','".$get_call_launch."','".$lead_filter_id."','".$use_internal_dnc."','".$dial_method."','".$adaptive_latest_server_time."','".$dial_statuses."','".$no_hopper_leads_logins."','".$manual_dial_filter."','".$use_campaign_dnc."','".$view_calls_in_queue."','".$view_calls_in_queue_launch."','".$pause_after_each_call."','".$agent_dial_owner_only."','".$agent_display_dialable_leads."','".$agent_select_territories."','".$crm_popup_login."','".mysqli_real_escape_string($db_conn,$crm_login_address)."','".$timer_action_seconds."','".$omit_phone_code."','".$adaptive_dropped_percentage."','".$agent_pause_codes_active."','".$display_queue_count."','".$hangup_stop_rec."','".$display_dtmf_alter."' from (select '".$campaign_id."' as campaign_id ) datas where not exists(select campaign_id from vicidial_campaigns a where a.campaign_id=datas.campaign_id );";
  			 	//echo $sql;
				if(mysqli_query($db_conn,$sql)){
     					 
					$sql2="INSERT INTO vicidial_campaign_stats (campaign_id) select campaign_id from (select '".$campaign_id."' as campaign_id ) datas where not exists(select campaign_id from vicidial_campaign_stats a where a.campaign_id=datas.campaign_id );";
					mysqli_query($db_conn,$sql2);
 					
					$sale_alt_type=trim($_REQUEST["sale_alt_type"]);
					$sale_alt_num=trim($_REQUEST["sale_alt_num"]);
					if(!$sale_alt_num){$sale_alt_num=0;}
					
					$del_sal_sql="delete from data_cam_sale_alt where campaign_id='".$campaign_id."'";
					mysqli_query($db_conn,$del_sal_sql);
 
 					if($sale_alt_type!="NONE"&&$sale_alt_type!=""&&$sale_alt_num>0){
						$in_sal_sql="insert into data_cam_sale_alt values('".$campaign_id."','".$sale_alt_type."','".$sale_alt_num."')";
						mysqli_query($db_conn,$in_sal_sql);
					}
 					
					$counts="1";
					$des="新建业务活动：$campaign_name [$campaign_id] 成功！";
 					
				}else{
					$counts="0";
					$des="新建业务活动：$campaign_name [$campaign_id] 失败，请检查重试！";
 				}
			}
 			
		}elseif($do_actions=="copy"){

			$sql="select campaign_id from vicidial_campaigns where campaign_id='".$campaign_id."' limit 1";
 			//echo $sql;
			$rows=mysqli_query($db_conn,$sql);
			$row_counts_list=mysqli_num_rows($rows);			
			mysqli_free_result($rows);
			
			if ($row_counts_list!=0) {
 				$counts="0";
				$des="该活动ID已存在，请检查更换其他！";
				
			}else {
			
				$sql="INSERT INTO vicidial_campaigns (campaign_name,campaign_id,active,dial_status_a,dial_status_b,dial_status_c,dial_status_d,dial_status_e,lead_order,park_ext,park_file_name,web_form_address,allow_closers,hopper_level,auto_dial_level,next_agent_call,local_call_time,voicemail_ext,dial_timeout,dial_prefix,campaign_cid,campaign_vdad_exten,campaign_rec_exten,campaign_recording,campaign_rec_filename,campaign_script,get_call_launch,am_message_exten,amd_send_to_vmx,xferconf_a_dtmf,xferconf_a_number,xferconf_b_dtmf,xferconf_b_number,alt_number_dialing,scheduled_callbacks,lead_filter_id,drop_call_seconds,drop_action,safe_harbor_exten,display_dialable_count,wrapup_seconds,wrapup_message,closer_campaigns,use_internal_dnc,allcalls_delay,omit_phone_code,dial_method,available_only_ratio_tally,adaptive_dropped_percentage,adaptive_maximum_level,adaptive_latest_server_time,adaptive_intensity,adaptive_dl_diff_target,concurrent_transfers,auto_alt_dial,auto_alt_dial_statuses,agent_pause_codes_active,campaign_description,campaign_changedate,campaign_stats_refresh,campaign_logindate,dial_statuses,disable_alter_custdata,no_hopper_leads_logins,list_order_mix,campaign_allow_inbound,manual_dial_list_id,default_xfer_group,queue_priority,drop_inbound_group,qc_enabled,qc_statuses,qc_lists,qc_web_form_address,qc_script,survey_first_audio_file,survey_dtmf_digits,survey_ni_digit,survey_opt_in_audio_file,survey_ni_audio_file,survey_method,survey_no_response_action,survey_ni_status,survey_response_digit_map,survey_xfer_exten,survey_camp_record_dir,disable_alter_custphone,display_queue_count,qc_get_record_launch,qc_show_recording,qc_shift_id,manual_dial_filter,agent_clipboard_copy,agent_extended_alt_dial,use_campaign_dnc,three_way_call_cid,three_way_dial_prefix,web_form_target,vtiger_search_category,vtiger_create_call_record,vtiger_create_lead_record,vtiger_screen_login,cpd_amd_action,agent_allow_group_alias,default_group_alias,vtiger_search_dead,vtiger_status_call,survey_third_digit,survey_fourth_digit,survey_third_audio_file,survey_fourth_audio_file,survey_third_status,survey_fourth_status,survey_third_exten,survey_fourth_exten,drop_lockout_time,quick_transfer_button,prepopulate_transfer_preset,drop_rate_group,view_calls_in_queue,view_calls_in_queue_launch,grab_calls_in_queue,call_requeue_button,pause_after_each_call,no_hopper_dialing,agent_dial_owner_only,agent_display_dialable_leads,web_form_address_two,waitforsilence_options,agent_select_territories,crm_popup_login,crm_login_address,timer_action,timer_action_message,timer_action_seconds,start_call_url,dispo_call_url,xferconf_c_number,xferconf_d_number,xferconf_e_number,hangup_stop_rec,display_dtmf_alter) 
				SELECT '".$campaign_name."','".$campaign_id."','Y',dial_status_a,dial_status_b,dial_status_c,dial_status_d,dial_status_e,lead_order,park_ext,park_file_name,web_form_address,allow_closers,hopper_level,auto_dial_level,next_agent_call,local_call_time,voicemail_ext,dial_timeout,dial_prefix,campaign_cid,campaign_vdad_exten,campaign_rec_exten,campaign_recording,campaign_rec_filename,campaign_script,get_call_launch,am_message_exten,amd_send_to_vmx,xferconf_a_dtmf,xferconf_a_number,xferconf_b_dtmf,xferconf_b_number,alt_number_dialing,scheduled_callbacks,lead_filter_id,drop_call_seconds,drop_action,safe_harbor_exten,display_dialable_count,wrapup_seconds,wrapup_message,closer_campaigns,use_internal_dnc,allcalls_delay,omit_phone_code,dial_method,available_only_ratio_tally,adaptive_dropped_percentage,adaptive_maximum_level,adaptive_latest_server_time,adaptive_intensity,adaptive_dl_diff_target,concurrent_transfers,auto_alt_dial,auto_alt_dial_statuses,agent_pause_codes_active,'".$campaign_description."',campaign_changedate,campaign_stats_refresh,campaign_logindate,dial_statuses,disable_alter_custdata,no_hopper_leads_logins,'DISABLED',campaign_allow_inbound,manual_dial_list_id,default_xfer_group,queue_priority,drop_inbound_group,qc_enabled,qc_statuses,qc_lists,qc_web_form_address,qc_script,survey_first_audio_file,survey_dtmf_digits,survey_ni_digit,survey_opt_in_audio_file,survey_ni_audio_file,survey_method,survey_no_response_action,survey_ni_status,survey_response_digit_map,survey_xfer_exten,survey_camp_record_dir,disable_alter_custphone,display_queue_count,qc_get_record_launch,qc_show_recording,qc_shift_id,manual_dial_filter,agent_clipboard_copy,agent_extended_alt_dial,use_campaign_dnc,three_way_call_cid,three_way_dial_prefix,web_form_target,vtiger_search_category,vtiger_create_call_record,vtiger_create_lead_record,vtiger_screen_login,cpd_amd_action,agent_allow_group_alias,default_group_alias,vtiger_search_dead,vtiger_status_call,survey_third_digit,survey_fourth_digit,survey_third_audio_file,survey_fourth_audio_file,survey_third_status,survey_fourth_status,survey_third_exten,survey_fourth_exten,drop_lockout_time,quick_transfer_button,prepopulate_transfer_preset,drop_rate_group,view_calls_in_queue,view_calls_in_queue_launch,grab_calls_in_queue,call_requeue_button,pause_after_each_call,no_hopper_dialing,agent_dial_owner_only,agent_display_dialable_leads,web_form_address_two,waitforsilence_options,agent_select_territories,crm_popup_login,crm_login_address,timer_action,timer_action_message,timer_action_seconds,start_call_url,dispo_call_url,xferconf_c_number,xferconf_d_number,xferconf_e_number,hangup_stop_rec,display_dtmf_alter from vicidial_campaigns where campaign_id='".$source_campaign_id."';";
  
			if(mysqli_query($db_conn,$sql)){
				
					$del_sql1="delete from vicidial_campaign_stats where campaign_id='".$campaign_id."'";
					mysqli_query($db_conn,$del_sql1);
					
					$del_sql2="delete from data_cam_sale_alt where campaign_id='".$campaign_id."'";
					mysqli_query($db_conn,$del_sql2);
					
					$in_sql1="insert into data_cam_sale_alt(campaign_id,sale_alt_type,sale_alt_num) select '".$campaign_id."',sale_alt_type,sale_alt_num from data_cam_sale_alt where campaign_id='".$campaign_id."'";
					mysqli_query($db_conn,$in_sql1);
     					 
					$in_sql2="INSERT INTO vicidial_campaign_stats (campaign_id) select campaign_id from (select '".$campaign_id."' as campaign_id ) datas where not exists(select campaign_id from vicidial_campaign_stats a where a.campaign_id=datas.campaign_id );";
					mysqli_query($db_conn,$in_sql2);
 					 
					$counts="1";
					$des="复制业务活动：$campaign_name [$campaign_id] 成功！";
				 
					
				}else{
					$counts="0";
					$des="复制业务活动：$campaign_name [$campaign_id] 失败，请检查重试！";
 				}
			}
			
		}else{			
			if($campaign_id!=""){
				
				$sql = "select use_non_latin,enable_queuemetrics_logging,enable_vtiger_integration,qc_features_active,outbound_autodial_active,sounds_central_control_active,enable_second_webform,user_territories_active FROM system_settings;";
				$rslt=mysqli_query($db_conn,$sql);
				 
				$qm_conf_ct = mysqli_num_rows($rslt);
				if ($qm_conf_ct > 0){
					$row=mysqli_fetch_row($rslt);
					$non_latin =						$row[0];
					$SSenable_queuemetrics_logging =	$row[1];
					$SSenable_vtiger_integration =		$row[2];
					$SSqc_features_active =				$row[3];
					$SSoutbound_autodial_active =		$row[4];
					$SSsounds_central_control_active =	$row[5];
					$SSenable_second_webform =			$row[6];
					$SSuser_territories_active =		$row[7];
				}
				mysqli_free_result($rslt);
				
				if ($SSoutbound_autodial_active < 1){
					$adaptive_dl_diff_target =		'0';
					$adaptive_dropped_percentage =	'99';
					$adaptive_intensity =			'0';
					$adaptive_latest_server_time =	'2359';
					$adaptive_maximum_level =		'1.0';
					$agent_extended_alt_dial =		'N';
					$alt_number_dialing =			'N';
					$am_message_exten =				'8320';
					$amd_send_to_vmx =				'N';
					$auto_alt_dial =				'N';
					$auto_dial_level =				'1.0';
					$available_only_ratio_tally =	'Y';
					$campaign_allow_inbound =		'Y';
					$campaign_vdad_exten =			'8368';
					$concurrent_transfers =			'AUTO';
					$dial_method =					'RATIO';
					$dial_status =					'';
					$dial_timeout =					'60';
					$drop_action =					'HANGUP';
					$drop_call_seconds =			'5';
					$drop_inbound_group =			'---NONE---';
					$force_reset_hopper =			'N';
					$hopper_level =					'5';
					$lead_filter_id =				'NONE';
					$lead_order =					'DOWN';
					$list_order_mix =				'DISABLED';
					$no_hopper_leads_logins =		'Y';
					$queue_priority =				'50';
					$safe_harbor_exten =			'8300';
					$survey_camp_record_dir =		'/home/survey';
					$survey_dtmf_digits =			'1238';
					$survey_first_audio_file =		'US_pol_survey_hello';
					$survey_method =				'AGENT_XFER';
					$survey_ni_audio_file =			'';
					$survey_ni_digit =				'8';
					$survey_ni_status =				'NI';
					$survey_no_response_action =	'OPTIN';
					$survey_opt_in_audio_file =		'US_pol_survey_transfer';
					$survey_response_digit_map =	'1-DEMOCRAT|2-REPUBLICAN|3-INDEPENDANT|8-OPTOUT|X-NO RESPONSE|';
					$survey_xfer_exten =			'8300';
					$voicemail_ext =				'';
					$cpd_amd_action =				'DISABLED';
					$drop_lockout_time =			'0';
				}
 				
				if ( ($dial_method != 'MANUAL') and ($dial_method != 'INBOUND_MAN') ){
					$no_hopper_dialing='N';
					$agent_dial_owner_only='NONE';
				}
				if ($no_hopper_dialing == 'Y'){
					$auto_alt_dial='NONE';
					$list_order_mix='DISABLED';
				}
				if ($dial_method == 'MANUAL'){
					$auto_dial_level='0';
					$up_sql = ",auto_dial_level='0'";
					$campaign_allow_inbound='N';
				}else{
					if ($dial_level_override > 0){
						$up_sql =",auto_dial_level='".$auto_dial_level."'";
					}else{
						if ($dial_method == 'RATIO'){
							if ($auto_dial_level < 1) {
								$auto_dial_level = "1.0";
							}
							$up_sql = ",auto_dial_level='".$auto_dial_level."'";
						}else{
							$adlSQL = "";
							if ($auto_dial_level < 1) {
								$auto_dial_level = "1.0";
								$up_sql = ",auto_dial_level='".$auto_dial_level."'";
							}
						}
					}
				}
				
				if ( (!ereg("DISABLED",$list_order_mix)) and ($hopper_level < 100) ){
					$hopper_level='100';
				}
				
				if(!$no_hopper_dialing){$no_hopper_dialing='N';}
				
 				$sql="update vicidial_campaigns set campaign_name='".$campaign_name."',active='".$active."',campaign_description='".$campaign_description."',web_form_address='".mysqli_real_escape_string($db_conn,$web_form_address)."',web_form_address_two='".mysqli_real_escape_string($db_conn,$web_form_address_two)."',hopper_level='".$hopper_level."',next_agent_call='".$next_agent_call."',local_call_time='".$local_call_time."',dial_timeout='".$dial_timeout."',dial_prefix='".$dial_prefix."',campaign_cid='".$campaign_cid."',campaign_script='".$campaign_script."',get_call_launch='".$get_call_launch."',lead_filter_id='".$lead_filter_id."',dial_method='".$dial_method."',dial_statuses='".$dial_statuses."',view_calls_in_queue='".$view_calls_in_queue."',view_calls_in_queue_launch='".$view_calls_in_queue_launch."',pause_after_each_call='".$pause_after_each_call."',agent_dial_owner_only='".$agent_dial_owner_only."',agent_display_dialable_leads='".$agent_display_dialable_leads."',campaign_changedate='".$SQLdate."',no_hopper_dialing='".$no_hopper_dialing."',campaign_allow_inbound='".$campaign_allow_inbound."',auto_alt_dial='".$auto_alt_dial."',list_order_mix='".$list_order_mix."',omit_phone_code='".$omit_phone_code."',adaptive_dropped_percentage='".$adaptive_dropped_percentage."',lead_order='".$lead_order."',agent_pause_codes_active='".$agent_pause_codes_active."',manual_dial_filter='".$manual_dial_filter."',display_queue_count='".$display_queue_count."',hangup_stop_rec='".$hangup_stop_rec."',display_dtmf_alter='".$display_dtmf_alter."'".$up_sql." where campaign_id='".$campaign_id."';";
				//echo $sql;
				if(mysqli_query($db_conn,$sql)){
 					 
					$sale_alt_type=trim($_REQUEST["sale_alt_type"]);
					$sale_alt_num=trim($_REQUEST["sale_alt_num"]);
					if(!$sale_alt_num){$sale_alt_num=0;}
					
					$del_sal_sql="delete from data_cam_sale_alt where campaign_id='".$campaign_id."'";
					mysqli_query($db_conn,$del_sal_sql);
 
 					if($sale_alt_type!="NONE"&&$sale_alt_type!=""&&$sale_alt_num>0){
						$in_sal_sql="insert into data_cam_sale_alt values('".$campaign_id."','".$sale_alt_type."','".$sale_alt_num."')";
						mysqli_query($db_conn,$in_sal_sql);
						
						
						$del_lists_sql="delete data_cam_sale_alt_lists from data_cam_sale_alt_lists,vicidial_lists where data_cam_sale_alt_lists.list_id=vicidial_lists.list_id and vicidial_lists.campaign_id='".$campaign_id."';";
						mysqli_query($db_conn,$del_lists_sql); 
						
						
						$in_lists_sql="
						insert into data_cam_sale_alt_lists
						select c.list_id from data_cam_sale_alt a inner join (
						select campaign_id,sum(counts) as cg from data_report_call_log_list where campaign_id='".$campaign_id."' and call_date between '".$today." 01' and '".$today." 23' and status='CG'
						) b on a.campaign_id=b.campaign_id and a.sale_alt_type='cam' and b.cg>a.sale_alt_num-1 inner join vicidial_lists c on a.campaign_id=c.campaign_id and c.active='Y'
						
						union 
						
						select c.list_id from data_cam_sale_alt a inner join (
						select campaign_id,list_id,sum(counts) as cg from data_report_call_log_list where campaign_id='".$campaign_id."' and call_date between '".$today." 01' and '".$today." 23' and status='CG' group by list_id
						) b on a.campaign_id=b.campaign_id and a.sale_alt_type='list' and b.cg>a.sale_alt_num-1 inner join vicidial_lists c on b.list_id=c.list_id and c.active='Y';";
						
						mysqli_query($db_conn,$in_lists_sql); 
						$lists_aff = mysqli_affected_rows($db_conn);
						
						if($lists_aff>0){
							
							$up_lists_sql="update vicidial_lists a inner join data_cam_sale_alt_lists b on a.list_id=b.list_id set a.active='N';";
							mysqli_query($db_conn,$up_lists_sql);
							
							$del_hopper_sql="delete vicidial_hopper from data_cam_sale_alt_lists , vicidial_hopper where data_cam_sale_alt_lists.list_id=vicidial_hopper.list_id;";
							mysqli_query($db_conn,$del_hopper_sql);
						}
						
					}
 					 
					$counts="1";
					$des="业务活动：$campaign_name [$campaign_id] 修改成功！";
				 
 				}else{
					$counts="0";
					$des="业务活动：$campaign_name [$campaign_id]修改失败，请检查相关设置重试！";
				 
				}
				
 			}else{
				$counts="0";
				$des="业务活动：$campaign_name [$campaign_id]修改失败，活动ID不存在！";
			}
			
		}
 		//echo $sql;
  		
 		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
		$json_data.="\"campaign_id\":".json_encode($campaign_id).",";
		$json_data.="\"auto_dial_level\":".json_encode($auto_dial_level).",";
 		$json_data.="\"des\":".json_encode($des)."";
  		$json_data.="}";
		
		echo $json_data;
	
	break;
  	 
  	
	//删除 
  	case "del_campaign":
 		
		if($cid!=""){
			
			if(strpos($cid,",")>-1){
				$cid=str_replace(",","','",$cid);
				$cid="'".$cid."'";
				$where_sql=" in(".$cid.") ";
			}else{
				$where_sql=" ='".$cid."' ";
			}
		
			$sql_1="DELETE from vicidial_campaigns where campaign_id ".$where_sql.";";
			mysqli_query($db_conn,$sql_1);
	
			$sql_2="DELETE from vicidial_campaign_agents where campaign_id ".$where_sql.";";
			mysqli_query($db_conn,$sql_2);
	
			$sql_3="DELETE from vicidial_live_agents where campaign_id ".$where_sql.";";
			mysqli_query($db_conn,$sql_3);
	
			$sql_4="DELETE from vicidial_campaign_statuses where campaign_id ".$where_sql.";";
			mysqli_query($db_conn,$sql_4);
	
			$sql_5="DELETE from vicidial_campaign_hotkeys where campaign_id ".$where_sql.";";
			mysqli_query($db_conn,$sql_5);
	
			$sql_6="DELETE from vicidial_callbacks where campaign_id ".$where_sql.";";
			mysqli_query($db_conn,$sql_6);
	
			$sql_7="DELETE from vicidial_campaign_stats where campaign_id ".$where_sql.";";
			mysqli_query($db_conn,$sql_7);
	
			$sql_8="DELETE from vicidial_lead_recycle where campaign_id ".$where_sql.";";
			mysqli_query($db_conn,$sql_8);
	
			$sql_9="DELETE from vicidial_campaign_server_stats where campaign_id ".$where_sql.";";
			mysqli_query($db_conn,$sql_9);
	
			$sql_10="DELETE from vicidial_server_trunks where campaign_id ".$where_sql.";";
			mysqli_query($db_conn,$sql_10);
	
			//$sql_11="DELETE from vicidial_pause_codes where campaign_id ".$where_sql.";";
			//mysqli_query($db_conn,$sql_11);
	
			$sql_12="DELETE from vicidial_campaigns_list_mix where campaign_id ".$where_sql.";";
			mysqli_query($db_conn,$sql_12);
	
 			$sql_13="DELETE from vicidial_hopper where campaign_id ".$where_sql.";";
			mysqli_query($db_conn,$sql_13);
			
			$sql_14="delete from data_cam_sale_alt where campaign_id ".$where_sql.";";
			mysqli_query($db_conn,$sql_14);
			
			$counts="1";
			$des="删除成功！";
 			
		}else{
			$counts="0";
			$des="删除失败，请输入要删除的行！";			
		}
 		 
 		
 		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
 		$json_data.="\"des\":".json_encode($des)."";
  		$json_data.="}";
		
		echo $json_data;
		
	break;
 	  
	//签退业务坐席
	case "set_campaign_agent_out":
 		
		if($campaign_id!=""){
			   
			$now_date_epoch = date('U');
			$inactive_epoch = ($now_date_epoch - 60);
			$sql = "SELECT user,campaign_id,UNIX_TIMESTAMP(last_update_time) from vicidial_live_agents where campaign_id='$campaign_id';";
			$rslt=mysqli_query($db_conn,$sql);
			
			$vla_ct = mysqli_num_rows($rslt);
			$k=0;
			while ($vla_ct > $k)
				{
				$row=mysqli_fetch_row($rslt);
				$VLA_user[$k] =			$row[0];
				$VLA_campaign_id[$k] =	$row[1];
				$VLA_update_time[$k] =	$row[2];
				$k++;
				}

			$k=0;
			while ($vla_ct > $k)
				{
				if ($VLA_update_time[$k] > $inactive_epoch)
					{
					$lead_active=0;
					$sql = "SELECT agent_log_id,user,server_ip,event_time,lead_id,campaign_id,pause_epoch,pause_sec,wait_epoch,wait_sec,talk_epoch,talk_sec,dispo_epoch,dispo_sec,status,user_group,comments,sub_status,dead_epoch,dead_sec from vicidial_agent_log where user='$VLA_user[$k]' order by agent_log_id desc LIMIT 1;";
					$rslt=mysqli_query($db_conn,$sql);
					
					$val_ct = mysqli_num_rows($rslt);
					if ($val_ct > 0)
						{
						$row=mysqli_fetch_row($rslt);
						$VAL_agent_log_id =		$row[0];
						$VAL_user =				$row[1];
						$VAL_server_ip =		$row[2];
						$VAL_event_time =		$row[3];
						$VAL_lead_id =			$row[4];
						$VAL_campaign_id =		$row[5];
						$VAL_pause_epoch =		$row[6];
						$VAL_pause_sec =		$row[7];
						$VAL_wait_epoch =		$row[8];
						$VAL_wait_sec =			$row[9];
						$VAL_talk_epoch =		$row[10];
						$VAL_talk_sec =			$row[11];
						$VAL_dispo_epoch =		$row[12];
						$VAL_dispo_sec =		$row[13];
						$VAL_status =			$row[14];
						$VAL_user_group =		$row[15];
						$VAL_comments =			$row[16];
						$VAL_sub_status =		$row[17];
						$VAL_dead_epoch =		$row[18];
						$VAL_dead_sec =			$row[19];

 						if ( ($VAL_wait_epoch < 1) || ( ($VAL_status == 'PAUSE') && ($VAL_dispo_epoch < 1) ) )
							{
							$VAL_pause_sec = ( ($now_date_epoch - $VAL_pause_epoch) + $VAL_pause_sec);
							$sql = "UPDATE vicidial_agent_log SET wait_epoch='$now_date_epoch', pause_sec='$VAL_pause_sec' where agent_log_id='$VAL_agent_log_id';";
							}
						else
							{
							if ($VAL_talk_epoch < 1)
								{
								$VAL_wait_sec = ( ($now_date_epoch - $VAL_wait_epoch) + $VAL_wait_sec);
								$sql = "UPDATE vicidial_agent_log SET talk_epoch='$now_date_epoch', wait_sec='$VAL_wait_sec' where agent_log_id='$VAL_agent_log_id';";
								}
							else
								{
								$lead_active++;
								$status_update_SQL='';
								if ( ( (strlen($VAL_status) < 1) or ($VAL_status == 'NULL') ) and ($VAL_lead_id > 0) )
									{
									$status_update_SQL = ", status='PU'";
									$sql="UPDATE vicidial_list SET status='PU' where lead_id='$VAL_lead_id';";
									
									$rslt=mysqli_query($db_conn,$sql);
									}
								if ($VAL_dispo_epoch < 1)
									{
									$VAL_talk_sec = ($now_date_epoch - $VAL_talk_epoch);
									$sql = "UPDATE vicidial_agent_log SET dispo_epoch='$now_date_epoch', talk_sec='$VAL_talk_sec'$status_update_SQL where agent_log_id='$VAL_agent_log_id';";
									}
								else
									{
									if ($VAL_dispo_sec < 1)
										{
										$VAL_dispo_sec = ($now_date_epoch - $VAL_dispo_epoch);
										$sql = "UPDATE vicidial_agent_log SET dispo_sec='$VAL_dispo_sec' where agent_log_id='$VAL_agent_log_id';";
										}
									}
								}
							}

						
						$rslt=mysqli_query($db_conn,$sql);
						}
					}

				$sql="DELETE from vicidial_live_agents where user='$VLA_user[$k]';";
				
				$rslt=mysqli_query($db_conn,$sql);

				if (strlen($VAL_user_group) < 1){
					$sql = "SELECT user_group FROM vicidial_users where user='$VLA_user[$k]';";
					$rslt=mysqli_query($db_conn,$sql);
					
					$val_ct = mysqli_num_rows($rslt);
					if ($val_ct > 0){
						$row=mysqli_fetch_row($rslt);
						$VAL_user_group =		$row[0];
					}
				}

				$sql = "INSERT INTO vicidial_user_log (user,event,campaign_id,event_date,event_epoch,user_group) values('$VLA_user[$k]','LOGOUT','$VLA_campaign_id[$k]','$NOW_TIME','$now_date_epoch','$VAL_user_group');";
				
				$rslt=mysqli_query($db_conn,$sql);

 
				$sql = "SELECT enable_queuemetrics_logging,queuemetrics_server_ip,queuemetrics_dbname,queuemetrics_login,queuemetrics_pass,queuemetrics_log_id FROM system_settings;";
				$rslt=mysqli_query($db_conn,$sql);
				
				$qm_conf_ct = mysqli_num_rows($rslt);
				if ($qm_conf_ct > 0){
						$row=mysqli_fetch_row($rslt);
						$enable_queuemetrics_logging =	$row[0];
						$queuemetrics_server_ip	=		$row[1];
						$queuemetrics_dbname =			$row[2];
						$queuemetrics_login	=			$row[3];
						$queuemetrics_pass =			$row[4];
						$queuemetrics_log_id =			$row[5];
					}
				 
					if ($enable_queuemetrics_logging > 0){
						$db_connB=mysql_connect("$queuemetrics_server_ip", "$queuemetrics_login", "$queuemetrics_pass");
						mysql_select_db("$queuemetrics_dbname",$db_connB);
	
						$agents='@agents';
						$agent_logged_in='';
						$time_logged_in='';
	
						$sqlB = "SELECT agent,time_id FROM queue_log where agent='Agent/$VLA_user[$k]' and verb='AGENTLOGIN' order by time_id desc limit 1;";
						$rsltB=mysql_query($sqlB,$db_connB);
						 
						$qml_ct = mysql_num_rows($rsltB);
						if ($qml_ct > 0){
							$row=mysql_fetch_row($rsltB);
							$agent_logged_in =	$row[0];
							$time_logged_in =	$row[1];
						}

						$time_logged_in = ($now_date_epoch - $time_logged_in);
						if ($time_logged_in > 1000000) {$time_logged_in=1;}

						$sqlB = "INSERT INTO queue_log SET partition='P01',time_id='$now_date_epoch',call_id='NONE',queue='NONE',agent='$agent_logged_in',verb='AGENTLOGOFF',serverid='$queuemetrics_log_id',data1='$VLA_user[$k]$agents',data2='$time_logged_in';";
						 
						$rsltB=mysql_query($sqlB,$db_connB);
						
						mysql_close($db_connB);
 					}

				$k++;
			}
			
			$counts="1";
			$des="签退成功，请告知坐席人员重新选择活动登录！";
 			
		}else{
			$counts="-1";
			$des="签退失败，未输入活动ID！";
		}
		
		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
 		$json_data.="\"des\":".json_encode($des).",";
		$json_data.="\"datalist\":".json_encode($list_arr)."";
 		$json_data.="}";
		
		echo $json_data;
	
	break;	
 	 
	
	//获取业务客户清单列表
	case "get_campaign_leads_list":
 		
 		if($campaign_id!=""){
			 
			$wheres=" a.campaign_id='".$campaign_id."'";
			if($list_active!=""){
				$wheres.=" and a.active='".$list_active."'";
			} 
			if($do_actions=="count"){
			
				$sql="select count(*) from vicidial_lists a left join (select '00' as list_id ) b on a.list_id=b.list_id where ".$wheres." ";
				//echo $sql;
				$rows=mysqli_fetch_row(mysqli_query($db_conn,$sql));
				$counts=$rows[0];
				if(!$counts){$counts="0";}
				$des="d";
				$list_arr=array('id'=>'none');
				
			}else if($do_actions=="list"){
			
				$offset=($pages-1)*$pagesize;
  				
				$sql="select a.list_id,a.list_name,case when a.active='Y' then '启用' else '禁用' end as active,a.list_description,a.list_changedate,a.list_lastcalldate,ifnull(b.counts,0) as counts,ifnull(b.sale_num,0) as sale_num from vicidial_lists a inner join (select count(*) as counts,a.list_id,c.sale_num from vicidial_lists a left join vicidial_list b on a.list_id=b.list_id left join (select sum(counts) as sale_num,list_id from data_report_call_log_list where call_date BETWEEN '".$today." 01' and '".$today." 23' and status='CG' and campaign_id='".$campaign_id."' group by list_id) c on a.list_id=c.list_id where ".$wheres." group by a.list_id ".$sort_sql." limit ".$offset.",".$pagesize.") b on a.list_id=b.list_id left join vicidial_campaigns c on a.campaign_id=c.campaign_id";
				//echo $sql;
				
				$rows=mysqli_query($db_conn,$sql);
				$row_counts_list=mysqli_num_rows($rows);			
				
				$list_arr=array();
				 
				if ($row_counts_list!=0) {
					while($rs= mysqli_fetch_array($rows)){ 
					 
						$list=array("list_id"=>$rs['list_id'],"list_name"=>$rs['list_name'],"active"=>$rs['active'],"list_description"=>$rs['list_description'],"list_changedate"=>$rs['list_changedate'],"list_lastcalldate"=>$rs['list_lastcalldate'],"counts"=>$rs['counts'],"sale_num"=>$rs['sale_num']);
						 
						array_push($list_arr,$list);
					}
					$counts="1";
					$des="获取成功!";
				}else {
					$counts="0";
					$des="未找到符合条件的数据!";
					$list_arr=array('id'=>'none');
				}
				
			}  
		 
			mysqli_free_result($rows);
			
		}else{
			$counts="0";
			$des="未输入业务活动ID！";
			$list_arr=array('id'=>'none');
		}
		$json_data="{";
		$json_data.="\"counts\":".json_encode($counts).",";
		$json_data.="\"des\":".json_encode($des).",";
		$json_data.="\"datalist\":".json_encode($list_arr)."";
		$json_data.="}";
		
		echo $json_data;
		
	 break;
	
	//获取漏斗表清单列表
	case "get_campaign_lead_hopper_list":
 		
  		if($campaign_id!=""){
			 
			$wheres=" and a.campaign_id='".$campaign_id."' and a.status='READY'";
			 
			if($do_actions=="count"){
				
				$sql="select count(*) from vicidial_hopper a left join vicidial_list b on a.lead_id=b.lead_id left join data_sys_status c on b.status=c.status and c.status_type='call_status' left join vicidial_lists d on a.list_id=d.list_id where 1=1 ".$wheres." ";
				//echo $sql;
				$rows=mysqli_fetch_row(mysqli_query($db_conn,$sql));
				$counts=$rows[0];
				if(!$counts){$counts="0";}
				$des="d";
				$list_arr=array('id'=>'none');
				
			}else if($do_actions=="list"){
			
				$offset=($pages-1)*$pagesize;
				
				$sql="select a.priority,a.lead_id,a.list_id,a.gmt_offset_now,a.state,a.alt_dial,c.status_name,b.called_count,b.phone_number,d.list_name from vicidial_hopper a left join vicidial_list b on a.lead_id=b.lead_id left join data_sys_status c on b.status=c.status and c.status_type='call_status' left join vicidial_lists d on a.list_id=d.list_id where 1=1 ".$wheres." ".$sort_sql."  limit ".$offset.",".$pagesize." ";
 				//echo $sql;
				$rows=mysqli_query($db_conn,$sql);
				$row_counts_list=mysqli_num_rows($rows);			
				
				$list_arr=array();
				 
				if ($row_counts_list!=0) {
					while($rs= mysqli_fetch_array($rows)){ 
					 
						$list=array("list_id"=>$rs['list_id'],"priority"=>$rs['priority'],"lead_id"=>$rs['lead_id'],"gmt_offset_now"=>$rs['gmt_offset_now'],"state"=>$rs['state'],"alt_dial"=>$rs['alt_dial'],"status_name"=>$rs['status_name'],"called_count"=>$rs['called_count'],"phone_number"=>$rs['phone_number'],"list_name"=>$rs['list_name']);
						 
						array_push($list_arr,$list);
					}
					$counts="1";
					$des="sucess";
				}else {
					$counts="0";
					$des="未找到符合条件的数据！";
					$list_arr=array('id'=>'none');
				}
				
			} 
		 
			mysqli_free_result($rows);
			
		}else{
			$counts="0";
			$des="未输入业务活动ID！";
			$list_arr=array('id'=>'none');
		}
		$json_data="{";
		$json_data.="\"counts\":".json_encode($counts).",";
		$json_data.="\"des\":".json_encode($des).",";
		$json_data.="\"datalist\":".json_encode($list_arr)."";
		$json_data.="}";
		
		echo $json_data;
		
	break;
	
  	
	//删除话术
  	case "del_pause_code":
 		
		if($cid!=""){
			
			if(strpos($cid,",")>-1){
				$cid=str_replace(",","','",$cid);
				$cid="'".$cid."'";
				$where_sql=" in(".$cid.") ";
			}else{
				$where_sql=" ='".$cid."' ";
			}
 		
  			//删除话术
			$sql="delete from vicidial_pause_codes where pause_code ".$where_sql." ";
			
			if (mysqli_query($db_conn,$sql)){
				$counts="1";
				$des="删除成功！";
			}else{
				$counts="0";
				$des="删除失败，请检查相关设置重试！";
			}
			
		}else{
			$counts="0";
			$des="删除失败，请输入要删除的行！";			
		}
 		 
 		
 		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
 		$json_data.="\"des\":".json_encode($des)."";
  		$json_data.="}";
		
		echo $json_data;
		
	break;
 	
	//暂停原因列表
	case "get_pause_code_list":
  		 
		if($pause_code<>""){
 			
			if(strpos($pause_code,",")>-1){
				$pause_code=str_replace(",","','",$pause_code);
				$pause_code="'".$pause_code."'";
				$sql_pause_code=" in(".$pause_code.") ";
			}else{
				$sql_pause_code=" like '%".$pause_code."%' ";
			}
			$sql1=" and pause_code ".$sql_pause_code."";
		}
		
		if($pause_code_name<>""){
 			$sql2=" and pause_code_name like '%".$pause_code_name."%'";
		} 
 		
		$wheres=$sql1.$sql2.$sql3;
		//获取记录集个数
		if($do_actions=="count"){
			
			$sql="select count(*) from vicidial_pause_codes where 1=1 ".$wheres." ";
			//echo $sql;
			$rows=mysqli_fetch_row(mysqli_query($db_conn,$sql));
			$counts=$rows[0];
			if(!$counts){$counts="0";}
			$des="d";
			$list_arr=array('id'=>'none');
			
		}else if($do_actions=="list"){
		
			$offset=($pages-1)*$pagesize;
			
			$sql="select pause_code,pause_code_name from vicidial_pause_codes where 1=1 ".$wheres." ".$sort_sql." limit ".$offset.",".$pagesize." ";
			
 			//echo $sql;
			
			$rows=mysqli_query($db_conn,$sql);
			$row_counts_list=mysqli_num_rows($rows);			
			
			$list_arr=array();
			 
			if ($row_counts_list!=0) {
				while($rs= mysqli_fetch_array($rows)){ 
				 
					$list=array("pause_code"=>$rs['pause_code'],"pause_code_name"=>$rs['pause_code_name']);
					 
					array_push($list_arr,$list);
				}
				$counts="1";
				$des="sucess";
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
	
	//验证暂停码是否存在
	case "check_pause_code":
 		
		if($pause_code!=""){
			
			$sql="select pause_code from (select 'LOGIN' as pause_code union all select pause_code from vicidial_pause_codes)datas where pause_code='".$pause_code."' limit 1";
			
			//echo $sql;
			$rows=mysqli_query($db_conn,$sql);
			$row_counts_list=mysqli_num_rows($rows);			
			
			if ($row_counts_list!=0) {
 				 
				$counts="0";
				$des="该暂停原因ID已存在，请检查更换其他！";
			}else {
				$counts="1";
				$des="";
			}
			
			mysqli_free_result($rows);
			
		}else{
			$counts="-1";
			$des="未输入暂停原因ID！";
		}
		
		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
 		$json_data.="\"des\":".json_encode($des)."";
 		$json_data.="}";
		
		echo $json_data;
	
	break;
	
 	//验证暂停码是否存在
	case "check_pause_code_name":
 		
		if($pause_code!=""){
			
			$sql="select pause_code_name from  vicidial_pause_codes where pause_code_name='".$pause_code_name."' limit 1";
			
			//echo $sql;
			$rows=mysqli_query($db_conn,$sql);
			$row_counts_list=mysqli_num_rows($rows);			
			
			if ($row_counts_list!=0) {
 				 
				$counts="0";
				$des="该暂停原因名称已存在，请检查更换其他！";
			}else {
				$counts="1";
				$des="";
			}
			
			mysqli_free_result($rows);
			
		}else{
			$counts="-1";
			$des="未输入暂停原因名称！";
		}
		
		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
 		$json_data.="\"des\":".json_encode($des)."";
 		$json_data.="}";
		
		echo $json_data;
	
	break;	
	
	//添加、修改话术
	case "pause_code_set":
  		
		if($do_actions=="add"){
			if(!preg_match("/^\d*$/",$pause_code)){
				
				if(!preg_match("/^\d*$/",$pause_code_name)){
					
					$sql="select pause_code from (select 'LOGIN' as pause_code union all select pause_code from vicidial_pause_codes)datas where pause_code='".$pause_code."' limit 1";
					//echo $sql;
					$rows=mysqli_query($db_conn,$sql);
					$row_counts_script=mysqli_num_rows($rows);			
					mysqli_free_result($rows);
					
					if ($row_counts_script!=0) {
						$counts="0";
						$des="该暂停原因ID已存在，请检查更换其他！";
						
					}else {
					
						 $sql="insert into vicidial_pause_codes (pause_code,pause_code_name)
						  select '".$pause_code."','".$pause_code_name."' from (select '".$pause_code."' as pause_code ) datas where not exists(select pause_code from vicidial_pause_codes a where a.pause_code=datas.pause_code );";
						//echo $sql;
						if(mysqli_query($db_conn,$sql)){
							
							$counts="1";
							$des="新建暂停原因 ".$pause_code_name." [".$pause_code."] 成功！";
							
						}else{
							$counts="0";
							$des="新建暂停原因 ".$pause_code_name." [".$pause_code."] 失败，请检查重试！";
						}
					}
				}else{
					$counts="0";
					$des="暂停原因名称不能用纯数字！";	
				}
 			}else{
				$counts="0";
				$des="暂停原因ID不能用纯数字！";	
			}
		}else if($do_actions=="update"){		
			if($pause_code!=""){
				
				if(!preg_match("/^\d*$/",$pause_code_name)){
 				
					$sql="update vicidial_pause_codes set pause_code_name='".$pause_code_name."' where pause_code='".$pause_code."';";
					//echo $sql;
					if(mysqli_query($db_conn,$sql)){
				 
						$counts="1";
						$des="暂停原因 ".$pause_code_name." [".$pause_code."] 修改成功！";
					 
					}else{
						$counts="0";
						$des="暂停原因 ".$pause_code_name." [".$pause_code."] 修改失败，请检查相关设置重试！";
					 
					}
				
				}else{
					$counts="0";
					$des="暂停原因ID不能用纯数字！";	
				}
				
 			}else{
				$counts="0";
				$des="修改失败，暂停原因ID不存在！";
			}
						
		}else{
			if($pause_code!=""){
				$source_pause_code=trim($_REQUEST["source_pause_code"]);
				
				$sql="insert into vicidial_pause_codes(pause_code,pause_code_name)
select '".$pause_code."','".$pause_code_name."' from vicidial_pause_codes where pause_code='".$source_pause_code."'";
 				
				if(mysqli_query($db_conn,$sql)){
					$counts="1";
					$des="暂停原因 ".$pause_code_name." [".$pause_code."] 复制成功！";
					 
				}else{
					$counts="0";
					$des="暂停原因 ".$pause_code_name." [".$pause_code."] 复制失败，系统错误，请检查重试！";
				 
				}
				
			}else{
				$counts="0";
				$des="复制失败，暂停原因ID不存在！";
			}
 		}
 		//echo $sql;
  		
 		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
  		$json_data.="\"des\":".json_encode($des)."";
  		$json_data.="}";
		
		echo $json_data;
	
	break;
    	
	//删除话术
  	case "del_pause_code":
 		
		if($cid!=""){
			
			if(strpos($cid,",")>-1){
				$cid=str_replace(",","','",$cid);
				$cid="'".$cid."'";
				$where_sql=" in(".$cid.") ";
			}else{
				$where_sql=" ='".$cid."' ";
			}
 		
  			//删除话术
			$sql="delete from vicidial_pause_codes where pause_code ".$where_sql." ";
			
			if (mysqli_query($db_conn,$sql)){
				$counts="1";
				$des="删除成功！";
			}else{
				$counts="0";
				$des="删除失败，请检查相关设置重试！";
			}
			
		}else{
			$counts="0";
			$des="删除失败，请输入要删除的行！";			
		}
 		 
 		
 		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
 		$json_data.="\"des\":".json_encode($des)."";
  		$json_data.="}";
		
		echo $json_data;
		
	break;
	
	//获取本地呼叫时间
	case "get_local_call_time":
 	
		$sql="select call_time_id,call_time_name from vicidial_call_times order by call_time_id";
 		//echo $sql;
		$rows=mysqli_query($db_conn,$sql);
		$row_counts_list=mysqli_num_rows($rows);			
		
		$list_arr=array();
		 
 		if ($row_counts_list!=0) {
			while($rs= mysqli_fetch_array($rows)){ 
			
				$list=array("o_val"=>$rs['call_time_id'],"o_name"=>$rs['call_time_name']);
				array_push($list_arr,$list);
  			}
 			$counts="1";
			$des="sucess";
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
 	
	//添加、修改字典
	case "data_dic_set":
  		
		if($do_actions=="add"){
			if($dic_id!=""){
				
				if($dic_id!=""){
					
					$sql="select dic_id from data_dic where dic_id='".$dic_id."' limit 1";
					//echo $sql;
					$rows=mysqli_query($db_conn,$sql);
					$row_counts_script=mysqli_num_rows($rows);			
					mysqli_free_result($rows);
					
					if ($row_counts_script!=0) {
						$counts="0";
						$des="该数据字典ID已存在，请检查更换其他！";
						
					}else {
					
						$sql="insert into data_dic(dic_id,dic_name,dic_des)
						  select '".$dic_id."','".$dic_name."','".$dic_des."' from (select '".$dic_id."' as dic_id ) datas where not exists(select dic_id from data_dic a where a.dic_id=datas.dic_id );";
						//echo $sql."<br/>";
						if(mysqli_query($db_conn,$sql)){
							
							if($form_list!=""){
								$form_lists=explode("|",$form_list);
								$f_in_sql="";
								foreach($form_lists as $form_value){
									$value_list=explode("#_#",$form_value);								 
									$v_dic_list_name=$value_list[0];
									$v_dic_list_val=$value_list[1];
									$v_dic_list_def=$value_list[2];
 									
									if(!$v_dic_list_val){$v_dic_list_val=$v_dic_list_name;}
									
									$f_in_sql.="('".$dic_id."','".$v_dic_list_name."','".$v_dic_list_val."','".$v_dic_list_def."'),";
								}
								if($f_in_sql){
									$in_sql="insert into data_dic_list(dic_id,dic_list_name,dic_list_val,dic_list_def) values  ".substr($f_in_sql,0,-1)." ";
									//echo $in_sql;
									mysqli_query($db_conn,$in_sql);
								}
							}
							
							$result="1";
 							
 						} 
						
 						if($result=="1"){
							$counts="1";
							$des="新建数据字典 ".$dic_name." [".$dic_id."] 成功！";
						}else{
							$counts="0";
							$des="新建数据字典 ".$dic_name." [".$dic_id."] 失败，请检查重试！";
							 
						}
						
 					}
				}else{
					$counts="0";
					$des="数据字典名称不能为空！";	
				}
 			}else{
				$counts="0";
				$des="数据字典ID不能为空！";	
			}
		}else if($do_actions=="update"){		
			if($dic_id!=""){
				
				if($dic_name!=""){
 				
					$sql="update data_dic set dic_name='".$dic_name."',dic_des='".$dic_des."' where dic_id='".$dic_id."';";
					//echo $sql;
					if(mysqli_query($db_conn,$sql)){
				 		
						$del_sql="delete from data_dic_list where dic_id='".$dic_id."'; ";
						mysqli_query($db_conn,$del_sql);
						
						if($form_list!=""){
							$form_lists=explode("|",$form_list);
							$f_in_sql="";
							foreach($form_lists as $form_value){
								$value_list=explode("#_#",$form_value);								 
								$v_dic_list_name=$value_list[0];
								$v_dic_list_val=$value_list[1];
								$v_dic_list_def=$value_list[2];
								
								if(!$v_dic_list_val){$v_dic_list_val=$v_dic_list_name;}
								
								$f_in_sql.="('".$dic_id."','".$v_dic_list_name."','".$v_dic_list_val."','".$v_dic_list_def."'),";
							}
 						}
 						
						if($f_in_sql){
							$in_sql="insert into data_dic_list(dic_id,dic_list_name,dic_list_val,dic_list_def) values ".substr($f_in_sql,0,-1)." ";
 							if(mysqli_query($db_conn,$in_sql)){
								$result="1";
							}else{
								$result="0";	
							}
						}else{
							$result="1";	
						}
						
					}else{
 						$result="0";	
					}
					 
					if($result=="1"){
						$counts="1";
						$des="数据字典 ".$dic_name." [".$dic_id."] 修改成功！";
					}else{
						$counts="0";
						$des="数据字典 ".$dic_name." [".$dic_id."] 修改失败，请检查重试！";
						 
					}
 				
				}else{
					$counts="0";
					$des="字典名称不能为空！";	
				}
				
 			}else{
				$counts="0";
				$des="字典ID不能为空！";
			}
						
		}else{
			if($dic_id!=""){
				$source_dic_id=trim($_REQUEST["source_dic_id"]);
				
				$sql="insert into data_dic(dic_id,dic_name,dic_des)
select '".$dic_id."','".$dic_name."','".$dic_des."' ";
 				
				if(mysqli_query($db_conn,$sql)){
					
					$s_sql="insert into data_dic_list(dic_id,dic_list_name,dic_list_val,dic_list_def) select dic_id,dic_list_name,dic_list_val,dic_list_def from data_dic_list where dic_id='".$source_dic_id."' ";
 				
					if(mysqli_query($db_conn,$s_sql)){
						$result="1";
					}else{
						$result="0";
 					}
 					 
				}else{
					$result="0";
 				}
				
				if($result=="1"){
					$counts="1";
					$des="数据字典 ".$dic_name." [".$dic_id."] 复制成功！";
				}else{
					$counts="0";
					$des="数据字典 ".$dic_name." [".$dic_id."] 复制失败，系统错误，请检查重试！";
				}
				
			}else{
				$counts="0";
				$des="复制失败，数据字典ID不存在！";
			}
 		}
 		//echo $sql;
  		
 		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
  		$json_data.="\"des\":".json_encode($des)."";
  		$json_data.="}";
		
		echo $json_data;
	
	break;
 
	//数据字典列表
	case "get_data_dic_list":
  		 
		if($dic_id<>""){
 			
			if(strpos($dic_id,",")>-1){
				$dic_id=str_replace(",","','",$dic_id);
				$dic_id="'".$dic_id."'";
				$sql_dic_id=" in(".$dic_id.") ";
			}else{
				$sql_dic_id=" like '%".$dic_id."%' ";
			}
			$sql1=" and a.dic_id ".$sql_dic_id."";
		}
		
		if($dic_name<>""){
 			$sql2=" and a.dic_name like '%".$dic_name."%'";
		} 
 		
		$wheres=$sql1.$sql2.$sql3;
		//获取记录集个数
		if($do_actions=="count"){
			
			$sql="select count(*) from data_dic a left join (select count(*) as counts,dic_id from data_dic_list group by dic_id order by null) b on a.dic_id=b.dic_id where 1=1 ".$wheres." ";
			//echo $sql;
			$rows=mysqli_fetch_row(mysqli_query($db_conn,$sql));
			$counts=$rows[0];
			if(!$counts){$counts="0";}
			$des="d";
			$list_arr=array('id'=>'none');
			
		}else if($do_actions=="list"){
		
			$offset=($pages-1)*$pagesize;
			
			$sql="select a.dic_id,a.dic_name,a.dic_des,b.counts from data_dic a left join (select count(*) as counts,dic_id from data_dic_list group by dic_id order by null) b on a.dic_id=b.dic_id where 1=1 ".$wheres." ".$sort_sql." limit ".$offset.",".$pagesize." ";
 			
			$rows=mysqli_query($db_conn,$sql);
			$row_counts_list=mysqli_num_rows($rows);			
			
			$list_arr=array();
			 
			if ($row_counts_list!=0) {
				while($rs= mysqli_fetch_array($rows)){ 
				 	
					$d_counts=$rs['counts'];
					if(!$d_counts){
						$d_counts=0;	
					}
					$list=array("dic_id"=>$rs['dic_id'],"dic_name"=>$rs['dic_name'],"dic_des"=>$rs['dic_des'],"counts"=>$d_counts);
					 
					array_push($list_arr,$list);
				}
				$counts="1";
				$des="sucess";
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
	
	//验证数据字典ID是否存在
	case "check_dic_id":
 		
		if($dic_id!=""){
			
			$sql="select dic_id from data_dic where dic_id='".$dic_id."' limit 1";
			
			//echo $sql;
			$rows=mysqli_query($db_conn,$sql);
			$row_counts_list=mysqli_num_rows($rows);			
			
			if ($row_counts_list!=0) {
 				 
				$counts="0";
				$des="该数据字典ID已存在，请检查更换其他！";
			}else {
				$counts="1";
				$des="";
			}
			
			mysqli_free_result($rows);
			
		}else{
			$counts="-1";
			$des="未输入数据字典ID！";
		}
		
		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
 		$json_data.="\"des\":".json_encode($des)."";
 		$json_data.="}";
		
		echo $json_data;
	
	break;
	
	//获取字典列表
	case "get_dic_id_list":
		 
 		if($active!=""){
			$wheres=" where active='".$active."' ";
		}
		
		$sql="select dic_id,dic_name from data_dic order by dic_name,dic_id";
  		$rows=mysqli_query($db_conn,$sql);
		$row_counts_list=mysqli_num_rows($rows);			

   		$list_arr=array();
		
 		if ($row_counts_list!=0){
			while($rs= mysqli_fetch_array($rows)){ 
			
				$list=array("o_val"=>$rs['dic_id'],"o_name"=>$rs['dic_name']);
 			 	array_push($list_arr,$list);
  			}
 		 
			$counts="1";
			$des="";
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
   
	//删除数据字典
  	case "del_data_dic":
 		
		if($cid!=""){
			
			if(strpos($cid,",")>-1){
				$cid=str_replace(",","','",$cid);
				$cid="'".$cid."'";
				$where_sql=" in(".$cid.") ";
			}else{
				$where_sql=" ='".$cid."' ";
			}
 		
  			//删除
			$sql1="delete from data_dic where dic_id ".$where_sql." ";
			
			//删除
			$sql2="delete from data_dic_list where dic_id ".$where_sql." ";
			
			
			if (mysqli_query($db_conn,$sql1)&&mysqli_query($db_conn,$sql2)){
				$counts="1";
				$des="删除成功！";
			}else{
				$counts="0";
				$des="删除失败，请检查相关设置重试！";
			}
			
		}else{
			$counts="0";
			$des="删除失败，请输入要删除的行！";			
		}
  		
 		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
 		$json_data.="\"des\":".json_encode($des)."";
  		$json_data.="}";
		
		echo $json_data;
		
	break;
	
    //删除数据字典
  	case "get_dic_list":
 		
		if($dic_id!=""){
			
			$sql="select dic_list_name,dic_list_val,dic_list_def from data_dic_list where dic_id='".$dic_id."' order by dic_list_id ";
 			 
			$rows=mysqli_query($db_conn,$sql);
			$row_counts_list=mysqli_num_rows($rows);			
			
			$list_arr=array();
			 
			if ($row_counts_list!=0) {
				while($rs= mysqli_fetch_array($rows)){ 
				 	
 					$list=array("dic_list_name"=>$rs['dic_list_name'],"dic_list_val"=>$rs['dic_list_val'],"dic_list_def"=>$rs['dic_list_def']);
					 
					array_push($list_arr,$list);
				}
				$counts="1";
				$des="sucess";
			}else {
				$counts="0";
				$des="未找到符合条件的数据！";
				$list_arr=array('id'=>'none');
			}
			
		}else{
			$counts="0";
			$des="删除失败，请输入要删除的行！";			
		}
  		
 		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
		$json_data.="\"datalist\":".json_encode($list_arr).",";
 		$json_data.="\"des\":".json_encode($des)."";
  		$json_data.="}";
		
		echo $json_data;
		
	break;
	
 	default :
}

unset($list_arr);
unset($lists_arr); 
unset($json_data);
unset($sql); 
mysqli_close($db_conn);

?>