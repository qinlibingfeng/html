<?php
	require("agc_cn/dbconnect.php");
	
	if (isset($_GET["action"]))						    {$action=$_GET["action"];}
	        elseif (isset($_POST["action"]))            {$action=$_POST["action"];}        
	if (isset($_GET["phone_login"]))						    {$phone_login=$_GET["phone_login"];}
	        elseif (isset($_POST["phone_login"]))            {$phone_login=$_POST["phone_login"];}
	if (isset($_GET["phone_pass"]))						    	{$phone_pass=$_GET["phone_pass"];}
	        elseif (isset($_POST["phone_pass"]))            {$phone_pass=$_POST["phone_pass"];}
	if (isset($_GET["VD_login"]))						    		{$VD_login=$_GET["VD_login"];}
	        elseif (isset($_POST["VD_login"]))            {$VD_login=$_POST["VD_login"];}
	if (isset($_GET["VD_pass"]))						    		{$VD_pass=$_GET["VD_pass"];}
	        elseif (isset($_POST["VD_pass"]))            {$VD_pass=$_POST["VD_pass"];}
	
	if (isset($_GET["VD_campaign"]))						    		{$VD_campaign=$_GET["VD_campaign"];}
	        elseif (isset($_POST["VD_pass"]))            {$VD_campaign=$_POST["VD_campaign"];}      
	
	if (isset($_GET["iframe_id"]))						    		{$iframe_id=$_GET["iframe_id"];}
			elseif (isset($_POST["iframe_id"]))            {$iframe_id=$_POST["iframe_id"];}   
				
	if (isset($_GET["callnum"]))						    		{$callnum=$_GET["callnum"];}
			elseif (isset($_POST["callnum"]))            {$callnum=$_POST["callnum"];} 
			
	if (isset($_GET["user"]))	{$user=$_GET["user"];}
		elseif (isset($_POST["user"]))	{$user=$_POST["user"];}
	if (isset($_GET["pass"]))	{$pass=$_GET["pass"];}
		elseif (isset($_POST["pass"]))	{$pass=$_POST["pass"];}
	if (isset($_GET["user_level"]))	{$user_level=$_GET["user_level"];}
		elseif (isset($_POST["user_level"]))	{$user_level=$_POST["user_level"];}
	if (isset($_GET["user_group"]))	{$user_group=$_GET["user_group"];}
		elseif (isset($_POST["user_group"]))	{$user_group=$_POST["user_group"];}
	if (isset($_GET["full_name"]))	{$full_name=$_GET["full_name"];}
		elseif (isset($_POST["full_name"]))	{$full_name=$_POST["full_name"];}
	if (isset($_GET["user_toggle"]))	{$user_toggle=$_GET["user_toggle"];}
		elseif (isset($_POST["user_toggle"]))	{$user_toggle=$_POST["user_toggle"];}

	if (isset($_GET["view_reports"])){$view_reports=$_GET["view_reports"];}
		elseif(isset($_POST["view_reports"])){$view_reports=$_POST["view_reports"];}
	if (isset($_GET["alter_agent_interface_options"]))					{$alter_agent_interface_options=$_GET["alter_agent_interface_options"];}
		elseif (isset($_POST["alter_agent_interface_options"]))	{$alter_agent_interface_options=$_POST["alter_agent_interface_options"];}


	/*if (isset($_GET["modify_users"]))	{$modify_users=$_GET["modify_users"];}
		elseif (isset($_POST["modify_users"]))	{$modify_users=$_POST["modify_users"];}
	if (isset($_GET["change_agent_campaign"]))	{$change_agent_campaign=$_GET["change_agent_campaign"];}
		elseif (isset($_POST["change_agent_campaign"]))	{$change_agent_campaign=$_POST["change_agent_campaign"];}
	if (isset($_GET["delete_users"]))	{$delete_users=$_GET["delete_users"];}
		elseif (isset($_POST["delete_users"]))	{$delete_users=$_POST["delete_users"];}

	if (isset($_GET["modify_usergroups"]))	{$modify_usergroups=$_GET["modify_usergroups"];}
		elseif (isset($_POST["modify_usergroups"]))	{$modify_usergroups=$_POST["modify_usergroups"];}

	if (isset($_GET["delete_user_groups"]))	{$delete_user_groups=$_GET["delete_user_groups"];}
		elseif (isset($_POST["delete_user_groups"]))	{$delete_user_groups=$_POST["delete_user_groups"];}
	if (isset($_GET["modify_lists"]))	{$modify_lists=$_GET["modify_lists"];}
		elseif (isset($_POST["modify_lists"]))	{$modify_lists=$_POST["modify_lists"];}
	if (isset($_GET["delete_lists"]))	{$delete_lists=$_GET["delete_lists"];}
		elseif (isset($_POST["delete_lists"]))	{$delete_lists=$_POST["delete_lists"];}
	if (isset($_GET["load_leads"]))	{$load_leads=$_GET["load_leads"];}
		elseif (isset($_POST["load_leads"]))	{$load_leads=$_POST["load_leads"];}
	if (isset($_GET["modify_leads"]))	{$modify_leads=$_GET["modify_leads"];}
		elseif (isset($_POST["modify_leads"]))	{$modify_leads=$_POST["modify_leads"];}
	if (isset($_GET["download_lists"]))	{$download_lists=$_GET["download_lists"];}
		elseif (isset($_POST["download_lists"]))	{$download_lists=$_POST["download_lists"];}


	if (isset($_GET["export_reports"]))	{$export_reports=$_GET["export_reports"];}
		elseif (isset($_POST["export_reports"]))	{$export_reports=$_POST["export_reports"];}
	if (isset($_GET["delete_from_dnc"]))	{$delete_from_dnc=$_GET["delete_from_dnc"];}
		elseif (isset($_POST["delete_from_dnc"]))	{$delete_from_dnc=$_POST["delete_from_dnc"];}
	if (isset($_GET["modify_campaigns"]))	{$modify_campaigns=$_GET["modify_campaigns"];}
		elseif (isset($_POST["modify_campaigns"]))	{$modify_campaigns=$_POST["modify_campaigns"];}
	if (isset($_GET["campaign_detail"]))	{$campaign_detail=$_GET["campaign_detail"];}
		elseif (isset($_POST["campaign_detail"]))	{$campaign_detail=$_POST["campaign_detail"];}
	if (isset($_GET["delete_campaigns"]))	{$delete_campaigns=$_GET["delete_campaigns"];}
		elseif (isset($_POST["delete_campaigns"]))	{$delete_campaigns=$_POST["delete_campaigns"];}
	if (isset($_GET["modify_ingroups"]))	{$modify_ingroups=$_GET["modify_ingroups"];}
		elseif (isset($_POST["modify_ingroups"]))	{$modify_ingroups=$_POST["modify_ingroups"];}
	if (isset($_GET["delete_ingroups"]))	{$delete_ingroups=$_GET["delete_ingroups"];}
		elseif (isset($_POST["delete_ingroups"]))	{$delete_ingroups=$_POST["delete_ingroups"];}
	if (isset($_GET["modify_inbound_dids"]))	{$modify_inbound_dids=$_GET["modify_inbound_dids"];}
		elseif (isset($_POST["modify_inbound_dids"]))	{$modify_inbound_dids=$_POST["modify_inbound_dids"];}
	if (isset($_GET["delete_inbound_dids"]))	{$delete_inbound_dids=$_GET["delete_inbound_dids"];}
		elseif (isset($_POST["delete_inbound_dids"]))	{$delete_inbound_dids=$_POST["delete_inbound_dids"];}
	if (isset($_GET["modify_remoteagents"]))	{$modify_remoteagents=$_GET["modify_remoteagents"];}
		elseif (isset($_POST["modify_remoteagents"]))	{$modify_remoteagents=$_POST["modify_remoteagents"];}
	if (isset($_GET["delete_remote_agents"]))	{$delete_remote_agents=$_GET["delete_remote_agents"];}
		elseif (isset($_POST["delete_remote_agents"]))	{$delete_remote_agents=$_POST["delete_remote_agents"];}
	if (isset($_GET["modify_scripts"]))	{$modify_scripts=$_GET["modify_scripts"];}
		elseif (isset($_POST["modify_scripts"]))	{$modify_scripts=$_POST["modify_scripts"];}
	if (isset($_GET["delete_scripts"]))	{$delete_scripts=$_GET["delete_scripts"];}
		elseif (isset($_POST["delete_scripts"]))	{$delete_scripts=$_POST["delete_scripts"];}
	if (isset($_GET["modify_filters"]))	{$modify_filters=$_GET["modify_filters"];}
		elseif (isset($_POST["modify_filters"]))	{$modify_filters=$_POST["modify_filters"];}
	if (isset($_GET["delete_filters"]))	{$delete_filters=$_GET["delete_filters"];}
		elseif (isset($_POST["delete_filters"]))	{$delete_filters=$_POST["delete_filters"];}
	if (isset($_GET["ast_admin_access"]))	{$ast_admin_access=$_GET["ast_admin_access"];}
		elseif (isset($_POST["ast_admin_access"]))	{$ast_admin_access=$_POST["ast_admin_access"];}
	if (isset($_GET["ast_delete_phones"]))	{$ast_delete_phones=$_GET["ast_delete_phones"];}
		elseif (isset($_POST["ast_delete_phones"]))	{$ast_delete_phones=$_POST["ast_delete_phones"];}
	if (isset($_GET["modify_call_times"]))	{$modify_call_times=$_GET["modify_call_times"];}
		elseif (isset($_POST["modify_call_times"]))	{$modify_call_times=$_POST["modify_call_times"];}
	if (isset($_GET["delete_call_times"]))	{$delete_call_times=$_GET["delete_call_times"];}
		elseif (isset($_POST["delete_call_times"]))	{$delete_call_times=$_POST["delete_call_times"];}
	if (isset($_GET["modify_servers"]))	{$modify_servers=$_GET["modify_servers"];}
		elseif (isset($_POST["modify_servers"]))	{$modify_servers=$_POST["modify_servers"];}
	if (isset($_GET["vdc_agent_api_access"]))	{$vdc_agent_api_access=$_GET["vdc_agent_api_access"];}
		elseif (isset($_POST["vdc_agent_api_access"]))	{$vdc_agent_api_access=$_POST["vdc_agent_api_access"];}
	if (isset($_GET["add_timeclock_log"]))	{$add_timeclock_log=$_GET["add_timeclock_log"];}
		elseif (isset($_POST["add_timeclock_log"]))	{$add_timeclock_log=$_POST["add_timeclock_log"];}
	if (isset($_GET["modify_timeclock_log"]))	{$modify_timeclock_log=$_GET["modify_timeclock_log"];}
		elseif (isset($_POST["modify_timeclock_log"]))	{$modify_timeclock_log=$_POST["modify_timeclock_log"];}
	if (isset($_GET["delete_timeclock_log"]))	{$delete_timeclock_log=$_GET["delete_timeclock_log"];}
		elseif (isset($_POST["delete_timeclock_log"]))	{$delete_timeclock_log=$_POST["delete_timeclock_log"];}
	if (isset($_GET["manager_shift_enforcement_override"]))	{$manager_shift_enforcement_override=$_GET["manager_shift_enforcement_override"];}
		elseif (isset($_POST["manager_shift_enforcement_override"]))	{$manager_shift_enforcement_override=$_POST["manager_shift_enforcement_override"];}
	if (isset($_GET["add_new_users"]))	{$add_new_users=$_GET["add_new_users"];}
		elseif (isset($_POST["add_new_users"]))	{$add_new_users=$_POST["add_new_users"];}
	if (isset($_GET["add_new_campaigns"]))	{$add_new_campaigns=$_GET["add_new_campaigns"];}
		elseif (isset($_POST["add_new_campaigns"]))	{$add_new_campaigns=$_POST["add_new_campaigns"];}
	if (isset($_GET["add_new_lists"]))	{$add_new_lists=$_GET["add_new_lists"];}
		elseif (isset($_POST["add_new_lists"]))	{$add_new_lists=$_POST["add_new_lists"];}
	if (isset($_GET["add_new_usergroups"]))	{$add_new_usergroups=$_GET["add_new_usergroups"];}
		elseif (isset($_POST["add_new_usergroups"]))	{$add_new_usergroups=$_POST["add_new_usergroups"];}
	if (isset($_GET["add_from_dnc"]))	{$add_from_dnc=$_GET["add_from_dnc"];}
		elseif (isset($_POST["add_from_dnc"]))	{$add_from_dnc=$_POST["add_from_dnc"];}
	if (isset($_GET["view_historical_reports"])){$view_historical_reports=$_GET["view_historical_reports"];}
		elseif(isset($_POST["view_historical_reports"])){$view_historical_reports=$_POST["view_historical_reports"];}
	if (isset($_GET["live_monitor"]))	{$live_monitor=$_GET["live_monitor"];}
		elseif (isset($_POST["live_monitor"]))	{$live_monitor=$_POST["live_monitor"];}
	if (isset($_GET["search_historical_call"]))	{$search_historical_call=$_GET["search_historical_call"];}
		elseif (isset($_POST["search_historical_call"]))	{$search_historical_call=$_POST["search_historical_call"];}
	if (isset($_GET["search_voice_mail"]))	{$search_voice_mail=$_GET["search_voice_mail"];}
		elseif (isset($_POST["search_voice_mail"]))	{$search_voice_mail=$_POST["search_voice_mail"];}
	if (isset($_GET["vicidial_transfers"]))	{$vicidial_transfers=$_GET["vicidial_transfers"];}
		elseif (isset($_POST["vicidial_transfers"]))	{$vicidial_transfers=$_POST["vicidial_transfers"];}
	if (isset($_GET["agentcall_manual"]))	{$agentcall_manual=$_GET["agentcall_manual"];}
		elseif (isset($_POST["agentcall_manual"]))	{$agentcall_manual=$_POST["agentcall_manual"];}
	if (isset($_GET["view_agent_status"]))	{$view_agent_status=$_GET["view_agent_status"];}
		elseif (isset($_POST["view_agent_status"]))	{$view_agent_status=$_POST["view_agent_status"];}
	if (isset($_GET["allow_alerts"])){$allow_alerts=$_GET["allow_alerts"];}
		elseif(isset($_POST["allow_alerts"])){$allow_alerts=$_POST["allow_alerts"];}
	if (isset($_GET["grab_calls_in_queue"]))	{$grab_calls_in_queue=$_GET["grab_calls_in_queue"];}
		elseif (isset($_POST["grab_calls_in_queue"]))	{$grab_calls_in_queue=$_POST["grab_calls_in_queue"];}
	if (isset($_GET["scheduled_callbacks"]))	{$scheduled_callbacks=$_GET["scheduled_callbacks"];}
		elseif (isset($_POST["scheduled_callbacks"]))	{$scheduled_callbacks=$_POST["scheduled_callbacks"];}
	if (isset($_GET["agentonly_callbacks"]))	{$agentonly_callbacks=$_GET["agentonly_callbacks"];}
		elseif (isset($_POST["agentonly_callbacks"]))	{$agentonly_callbacks=$_POST["agentonly_callbacks"];}
	if (isset($_GET["vicidial_recording"]))	{$vicidial_recordingvicidial_recording=$_GET["vicidial_recording"];}
		elseif (isset($_POST["vicidial_recording"]))	{$vicidial_recording=$_POST["vicidial_recording"];}
	if (isset($_GET["vicidial_recording_override"]))	{$vicidial_recording_override=$_GET["vicidial_recording_override"];}
		elseif (isset($_POST["vicidial_recording_override"]))	{$vicidial_recording_override=$_POST["vicidial_recording_override"];}*/

	if (isset($_GET["extension"]))	{$extension=$_GET["extension"];}
		elseif (isset($_POST["extension"]))	{$extension=$_POST["extension"];}
	if (isset($_GET["dialplan_number"]))	{$dialplan_number=$_GET["dialplan_number"];}
		elseif (isset($_POST["dialplan_number"]))	{$dialplan_number=$_POST["dialplan_number"];}
	if (isset($_GET["voicemail_id"]))	{$voicemail_id=$_GET["voicemail_id"];}
		elseif (isset($_POST["voicemail_id"]))	{$voicemail_id=$_POST["voicemail_id"];}
	if (isset($_GET["outbound_cid"]))	{$outbound_cid=$_GET["outbound_cid"];}
		elseif (isset($_POST["outbound_cid"]))	{$outbound_cid=$_POST["outbound_cid"];}
	if (isset($_GET["phone_ip"]))	{$phone_ip=$_GET["phone_ip"];}
		elseif (isset($_POST["phone_ip"]))	{$phone_ip=$_POST["phone_ip"];}
	if (isset($_GET["computer_ip"]))	{$computer_ip=$_GET["computer_ip"];}
		elseif (isset($_POST["computer_ip"]))	{$computer_ip=$_POST["computer_ip"];}
	if (isset($_GET["server_ip"]))	{$server_ip=$_GET["server_ip"];}
		elseif (isset($_POST["server_ip"]))	{$server_ip=$_POST["server_ip"];}
	if (isset($_GET["login"]))	{$login=$_GET["login"];}
		elseif (isset($_POST["login"]))	{$login=$_POST["login"];}
	if (isset($_GET["status"]))	{$status=$_GET["status"];}
		elseif (isset($_POST["status"]))	{$status=$_POST["status"];}
	if (isset($_GET["active"]))	{$active=$_GET["active"];}
		elseif (isset($_POST["active"]))	{$active=$_POST["active"];}
	if (isset($_GET["phone_type"]))	{$phone_type=$_GET["phone_type"];}
		elseif (isset($_POST["phone_type"]))	{$phone_type=$_POST["phone_type"];}
	if (isset($_GET["fullname"]))	{$fullname=$_GET["fullname"];}
		elseif (isset($_POST["fullname"]))	{$fullname=$_POST["fullname"];}
	if (isset($_GET["company"]))	{$company=$_GET["company"];}
		elseif (isset($_POST["company"]))	{$company=$_POST["company"];}
	if (isset($_GET["picture"]))	{$picture=$_GET["picture"];}
		elseif (isset($_POST["picture"]))	{$picture=$_POST["picture"];}
	if (isset($_GET["protocol"]))	{$protocol=$_GET["protocol"];}
		elseif (isset($_POST["protocol"]))	{$protocol=$_POST["protocol"];}
	if (isset($_GET["local_gmt"]))	{$local_gmt=$_GET["local_gmt"];}
		elseif (isset($_POST["local_gmt"]))	{$local_gmt=$_POST["local_gmt"];}	
	if (isset($_GET["group_id"]))	{$group_id=$_GET["group_id"];}
		elseif (isset($_POST["group_id"]))	{$group_id=$_POST["group_id"];}
	if (isset($_GET["force_logout"]))	{$force_logout=$_GET["force_logout"];}
		elseif (isset($_POST["force_logout"]))	{$force_logout=$_POST["force_logout"];}
	if (isset($_GET["groups"]))	{$groups=$_GET["groups"];}
		elseif (isset($_POST["groups"]))	{$groups=$_POST["groups"];}
	if (isset($_GET["phone_number"]))	{$phone_number=$_GET["phone_number"];}
		elseif (isset($_POST["phone_number"]))	{$phone_number=$_POST["phone_number"];}

	
	$user_toggle=0;
	$view_reports=0;
	$alter_agent_interface_options=0;
	$modify_users=0;
	$change_agent_campaign=0;
	$delete_users=0;
	$modify_usergroups=0;
	$delete_user_groups=0;
	$modify_lists=0;
	$delete_lists=0;
	$load_leads=0;
	$modify_leads=0;
	$download_lists=0;
	$export_reports=0;
	$delete_from_dnc=0;
	$modify_campaigns=0;
	$campaign_detail=0;
	$delete_campaigns=0;
	$modify_ingroups=0;
	$delete_ingroups=0;
	$modify_inbound_dids=0;
	$delete_inbound_dids=0;
	$modify_remoteagents=0;
	$delete_remote_agents=0;
	$modify_scripts=0;
	$delete_scripts=0;
	$modify_filters=0;
	$delete_filters=0;
	$ast_admin_access=0;
	$ast_delete_phones=0;
	$modify_call_times=0;
	$delete_call_times=0;
	$modify_servers=0;
	$vdc_agent_api_access=1;
	$add_timeclock_log=0;
	$modify_timeclock_log=0;
	$delete_timeclock_log=0;
	$manager_shift_enforcement_override=0;
	$add_new_users=0;
	$add_new_campaigns=0;
	$add_new_lists=0;
	$add_new_usergroups=0;
	$add_from_dnc=0;
	$view_historical_reports=0;
	$live_monitor=0;
	$search_historical_call=0;
	$search_voice_mail=0;
	$vicidial_transfers=1;
	$agentcall_manual=1;
	$view_agent_status=N;
	$allow_alerts=0;
	$grab_calls_in_queue=N;
	$scheduled_callbacks=1;
	$agentonly_callbacks=1;
	$vicidial_recording=0;
	$vicidial_recording_override=DISABLED;

	$user_level=5;
	$user_group=Demo;

	
	
	/*$server_ip=172.17.1.90;
	$status=ACTIVE;
	$active=Y;
	$phone_type=5555;
	$fullname=5555;
	$company=;
	$picture=;
	$protocol=SIP;
	$local_gmt=8.00;*/

	function redirectTo($url){
	   echo '<Script>location.href="'.$url.'";</Script>'; 
	}
	if($action == "Authenticate"){
			redirectTo("agc_cn/vicidial.php?VD_login=$VD_login&VD_campaign=$VD_campaign&phone_login=$phone_login&phone_pass=$phone_pass&VD_pass=$VD_pass");	
			//http://172.17.1.90/ccms/vicidial_interface_lgq.php?action=Authenticate&VD_login=1000&VD_campaign=edu&phone_login=1000&phone_pass=100 0&VD_pass=1000
	}
	if($action == "Simultaneous_Users"){ //创建用户		
			$url = "http://172.17.1.90/ccms/admin.php?ADD=2&VD_login=$VD_login&VD_campaign=$VD_campaign&phone_login=$phone_login&phone_pass=$phone_pass&VD_pass=$VD_pass&user=$user&pass=$pass&full_name=$full_name&user_level=$user_level&user_group=$user_group&user_toggle=$user_toggle&view_reports=$view_reports&alter_agent_interface_options=$alter_agent_interface_options&modify_users=$modify_users&change_agent_campaign=$change_agent_campaign&delete_users=$delete_users&modify_usergroups=$modify_usergroups&delete_user_groups=$delete_user_groups&modify_lists=$modify_lists&delete_lists=$delete_lists&load_leads=$load_leads&modify_leads=$modify_leads&download_lists=$download_lists&export_reports=$export_reports&delete_from_dnc=$delete_from_dnc&modify_campaigns=$modify_campaigns&campaign_detail=$campaign_detail&delete_campaigns=$delete_campaigns&modify_ingroups=$modify_ingroups&delete_ingroups=$delete_ingroups&modify_inbound_dids=$modify_inbound_dids&delete_inbound_dids=$delete_inbound_dids&modify_remoteagents=$modify_remoteagents&delete_remote_agents=$delete_remote_agents&modify_scripts=$modify_scripts&delete_scripts=$delete_scripts&modify_filters=$modify_filters&delete_filters=$delete_filters&ast_admin_access=$ast_admin_access&ast_delete_phones=$ast_delete_phones&modify_call_times=$modify_call_times&delete_call_times=$delete_call_times&modify_servers=$modify_servers&vdc_agent_api_access=$vdc_agent_api_access&add_timeclock_log=$add_timeclock_log&modify_timeclock_log=$modify_timeclock_log&delete_timeclock_log=$delete_timeclock_log&manager_shift_enforcement_override=$manager_shift_enforcement_override&add_new_users=$add_new_users&add_new_campaigns=$add_new_campaigns&add_new_lists=$add_new_lists&add_new_usergroups=$add_new_usergroups&add_from_dnc=$add_from_dnc&view_historical_reports=$view_historical_reports&live_monitor=$live_monitor&search_historical_call=$search_historical_call&search_voice_mail=$search_voice_mail&vicidial_transfers=$vicidial_transfers&agentcall_manual=$agentcall_manual&view_agent_status=$view_agent_status&allow_alerts=$allow_alerts&grab_calls_in_queue=$grab_calls_in_queue&scheduled_callbacks=$scheduled_callbacks&agentonly_callbacks=$agentonly_callbacks&vicidial_recording=$vicidial_recording&vicidial_recording_override=$vicidial_recording_override";
			//echo $url;
			$html=file_get_contents($url);
			echo "添加成功";
			//172.17.1.90/ccms/vicidial_interface_lgq.php?action=Simultaneous_Users&VD_login=1000&VD_campaign=edu&phone_login=1000&phone_pass=1000&VD_pass=1000&user=5555&pass=5555&full_name=5555&user_level=5&user_group=Demo&user_toggle=0&view_reports=0&alter_agent_interface_options=0&modify_users=0&change_agent_campaign=0&delete_users=0&modify_usergroups=0&delete_user_groups=0&modify_lists=0&delete_lists=0&load_leads=0&modify_leads=0&download_lists=0&export_reports=0&delete_from_dnc=0&modify_campaigns=0&campaign_detail=0&delete_campaigns=0&modify_ingroups=0&delete_ingroups=0&modify_inbound_dids=0&delete_inbound_dids=0&modify_remoteagents=0&delete_remote_agents=0&modify_scripts=0&delete_scripts=0&modify_filters=0&delete_filters=0&ast_admin_access=0&ast_delete_phones=0&modify_call_times=0&delete_call_times=0&modify_servers=0&vdc_agent_api_access=1&add_timeclock_log=0&modify_timeclock_log=0&delete_timeclock_log=0&manager_shift_enforcement_override=0&add_new_users=0&add_new_campaigns=0&add_new_lists=0&add_new_usergroups=0&add_from_dnc=0&view_historical_reports=0&live_monitor=0&search_historical_call=0&search_voice_mail=0&vicidial_transfers=1&agentcall_manual=1&view_agent_status=N&allow_alerts=0&grab_calls_in_queue=N&scheduled_callbacks=1&agentonly_callbacks=1&vicidial_recording=&vicidial_recording_override=DISABLED
	}
	if($action == "Sibmit_Users_active"){ //用户激活
			//redirectTo("admin.php?ADD=4A&VD_login=$VD_login&VD_campaign=$VD_campaign&phone_login=$phone_login&phone_pass=$phone_pass&VD_pass=$VD_pass&user=$user&pass=$pass&full_name=$full_name&user_level=$user_level&user_group=$user_group&active=$active&group_id=$group_id");

			$url="http://172.17.1.90/ccms/admin.php?ADD=4A&VD_login=$VD_login&VD_campaign=$VD_campaign&phone_login=$phone_login&phone_pass=$phone_pass&VD_pass=$VD_pass&user=$user&pass=$pass&full_name=$full_name&user_level=$user_level&user_group=$user_group&active=$active&groups=$groups";
			$html=file_get_contents($url);
			echo "用户已激活";

			//172.17.1.90/ccms/vicidial_interface_lgq.php?action=Sibmit_Users_active&VD_login=22222&VD_campaign=edu&phone_login=22222&phone_pass=22222&VD_pass=22222&user=5555&pass=5555&full_name=5555
		
	}
	if($action == "Add_phones"){		//创建phones
			//redirectTo("admin.php?ADD=21111111111&VD_login=$VD_login&VD_campaign=$VD_campaign&phone_login=$phone_login&phone_pass=$phone_pass&VD_pass=$VD_pass&extension=$extension&dialplan_number=$dialplan_number&server_ip=$server_ip&login=$login&pass=$pass&status=$status&active=$active&phone_type=$phone_type&fullname=$fullname&protocol=$protocol&local_gmt=$local_gmt");
		
			$url="http://$server_ip/ccms/admin.php?ADD=21111111111&VD_login=$VD_login&VD_campaign=$VD_campaign&phone_login=$phone_login&phone_pass=$phone_pass&VD_pass=$VD_pass&login=$login&pass=$pass&extension=$extension&dialplan_number=$dialplan_number&server_ip=$server_ip&status=ACTIVE&active=Y&phone_type=5555&fullname=5555&company=&picture=&protocol=SIP&local_gmt=8.00";
			$html=file_get_contents($url);
			echo "phones创建成功";

			//172.17.1.90/ccms/vicidial_interface_lgq.php?action=Add_phones&VD_login=22222&VD_campaign=edu&phone_login=22222&phone_pass=22222&VD_pass=22222&extension=5555&dialplan_number=5555&server_ip=172.17.1.90&login=5555&pass=5555&status=ACTIVE&active=Y&phone_type=5555&fullname=5555&company=&picture=&protocol=SIP&local_gmt=8.00

	}
	
?>


