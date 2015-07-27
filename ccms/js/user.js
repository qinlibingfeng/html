function CHANGE_ADMIN_INTERFACE_OPTIONS(){
	var obj = document.getElementById("user_level");
	var level = obj.options[obj.selectedIndex].value;

	if(level==5){
		document.getElementById("vicidial_transfers").selectedIndex = 1;
		document.getElementById("agentcall_manual").selectedIndex = 1;
		document.getElementById("view_agent_status").selectedIndex = 1;
		document.getElementById("allow_alerts").selectedIndex = 0;
		document.getElementById("grab_calls_in_queue").selectedIndex = 0;
		document.getElementById("scheduled_callbacks").selectedIndex = 1;
		document.getElementById("agentonly_callbacks").selectedIndex = 1;
		
		document.getElementById("view_reports").selectedIndex = 0;
		document.getElementById("alter_agent_interface_options").selectedIndex = 0;
		document.getElementById("modify_users").selectedIndex = 0;
		document.getElementById("change_agent_campaign").selectedIndex = 0;
		document.getElementById("delete_users").selectedIndex = 0;
		document.getElementById("modify_usergroups").selectedIndex = 0;
		document.getElementById("delete_user_groups").selectedIndex = 0;
		document.getElementById("modify_lists").selectedIndex = 0;
		document.getElementById("delete_lists").selectedIndex = 0;
		document.getElementById("load_leads").selectedIndex = 0;
		document.getElementById("modify_leads").selectedIndex = 0;
		document.getElementById("download_lists").selectedIndex = 0;
		document.getElementById("export_reports").selectedIndex = 0;
		document.getElementById("delete_from_dnc").selectedIndex = 0;
		document.getElementById("modify_campaigns").selectedIndex = 0;
		document.getElementById("campaign_detail").selectedIndex = 0;
		document.getElementById("delete_campaigns").selectedIndex = 0;
		document.getElementById("modify_ingroups").selectedIndex = 0;
		document.getElementById("delete_ingroups").selectedIndex = 0;
		document.getElementById("modify_inbound_dids").selectedIndex = 0;
		document.getElementById("delete_inbound_dids").selectedIndex = 0;
		document.getElementById("modify_remoteagents").selectedIndex = 0;
		document.getElementById("delete_remote_agents").selectedIndex = 0;
		document.getElementById("modify_scripts").selectedIndex = 0;
		document.getElementById("delete_scripts").selectedIndex = 0;
		document.getElementById("modify_filters").selectedIndex = 0;
		document.getElementById("delete_filters").selectedIndex = 0;
		document.getElementById("ast_admin_access").selectedIndex = 0;
		document.getElementById("ast_delete_phones").selectedIndex = 0;
		document.getElementById("modify_call_times").selectedIndex = 0;
		document.getElementById("delete_call_times").selectedIndex = 0;
		document.getElementById("modify_servers").selectedIndex = 0;
		document.getElementById("vdc_agent_api_access").selectedIndex = 1;
		document.getElementById("add_timeclock_log").selectedIndex = 0;
		document.getElementById("modify_timeclock_log").selectedIndex = 0;
		document.getElementById("delete_timeclock_log").selectedIndex = 0;
		document.getElementById("manager_shift_enforcement_override").selectedIndex = 0;
		document.getElementById("add_new_users").selectedIndex = 0;
		document.getElementById("add_new_campaigns").selectedIndex = 0;
		document.getElementById("add_new_lists").selectedIndex = 0;
		document.getElementById("add_new_usergroups").selectedIndex = 0;
		document.getElementById("add_from_dnc").selectedIndex = 0;
		document.getElementById("view_historical_reports").selectedIndex = 0;
		document.getElementById("live_monitor").selectedIndex = 0;
		document.getElementById("search_historical_call").selectedIndex = 0;
		document.getElementById("search_voice_mail").selectedIndex = 0;
	}
	if(level==6){
		document.getElementById("vicidial_transfers").selectedIndex = 1;
		document.getElementById("agentcall_manual").selectedIndex = 1;
		document.getElementById("view_agent_status").selectedIndex = 1;
		document.getElementById("allow_alerts").selectedIndex = 1;
		document.getElementById("grab_calls_in_queue").selectedIndex = 1;
		document.getElementById("scheduled_callbacks").selectedIndex = 1;
		document.getElementById("agentonly_callbacks").selectedIndex = 1;
		
		document.getElementById("view_reports").selectedIndex = 0;
		document.getElementById("alter_agent_interface_options").selectedIndex = 0;
		document.getElementById("modify_users").selectedIndex = 0;
		document.getElementById("change_agent_campaign").selectedIndex = 0;
		document.getElementById("delete_users").selectedIndex = 0;
		document.getElementById("modify_usergroups").selectedIndex = 0;
		document.getElementById("delete_user_groups").selectedIndex = 0;
		document.getElementById("modify_lists").selectedIndex = 0;
		document.getElementById("delete_lists").selectedIndex = 0;
		document.getElementById("load_leads").selectedIndex = 0;
		document.getElementById("modify_leads").selectedIndex = 0;
		document.getElementById("download_lists").selectedIndex = 0;
		document.getElementById("export_reports").selectedIndex = 0;
		document.getElementById("delete_from_dnc").selectedIndex = 0;
		document.getElementById("modify_campaigns").selectedIndex = 0;
		document.getElementById("campaign_detail").selectedIndex = 0;
		document.getElementById("delete_campaigns").selectedIndex = 0;
		document.getElementById("modify_ingroups").selectedIndex = 0;
		document.getElementById("delete_ingroups").selectedIndex = 0;
		document.getElementById("modify_inbound_dids").selectedIndex = 0;
		document.getElementById("delete_inbound_dids").selectedIndex = 0;
		document.getElementById("modify_remoteagents").selectedIndex = 0;
		document.getElementById("delete_remote_agents").selectedIndex = 0;
		document.getElementById("modify_scripts").selectedIndex = 0;
		document.getElementById("delete_scripts").selectedIndex = 0;
		document.getElementById("modify_filters").selectedIndex = 0;
		document.getElementById("delete_filters").selectedIndex = 0;
		document.getElementById("ast_admin_access").selectedIndex = 0;
		document.getElementById("ast_delete_phones").selectedIndex = 0;
		document.getElementById("modify_call_times").selectedIndex = 0;
		document.getElementById("delete_call_times").selectedIndex = 0;
		document.getElementById("modify_servers").selectedIndex = 0;
		document.getElementById("vdc_agent_api_access").selectedIndex = 1;
		document.getElementById("add_timeclock_log").selectedIndex = 0;
		document.getElementById("modify_timeclock_log").selectedIndex = 0;
		document.getElementById("delete_timeclock_log").selectedIndex = 0;
		document.getElementById("manager_shift_enforcement_override").selectedIndex = 0;
		document.getElementById("add_new_users").selectedIndex = 0;
		document.getElementById("add_new_campaigns").selectedIndex = 0;
		document.getElementById("add_new_lists").selectedIndex = 0;
		document.getElementById("add_new_usergroups").selectedIndex = 0;
		document.getElementById("add_from_dnc").selectedIndex = 0;
		document.getElementById("view_historical_reports").selectedIndex = 0;
		document.getElementById("live_monitor").selectedIndex = 1;
		document.getElementById("search_historical_call").selectedIndex = 1;
		document.getElementById("search_voice_mail").selectedIndex = 1;
	}
	if(level==7 || level==8){
		document.getElementById("vicidial_transfers").selectedIndex = 1;
		document.getElementById("agentcall_manual").selectedIndex = 1;
		document.getElementById("view_agent_status").selectedIndex = 1;
		document.getElementById("allow_alerts").selectedIndex = 1;
		document.getElementById("grab_calls_in_queue").selectedIndex = 1;
		document.getElementById("scheduled_callbacks").selectedIndex = 1;
		document.getElementById("agentonly_callbacks").selectedIndex = 1;
		
		document.getElementById("view_reports").selectedIndex = 1;
		document.getElementById("alter_agent_interface_options").selectedIndex = 1;
		document.getElementById("modify_users").selectedIndex = 1;
		document.getElementById("change_agent_campaign").selectedIndex = 1;
		document.getElementById("delete_users").selectedIndex = 1;
		document.getElementById("modify_usergroups").selectedIndex = 1;
		document.getElementById("delete_user_groups").selectedIndex = 0;
		document.getElementById("modify_lists").selectedIndex = 1;
		document.getElementById("delete_lists").selectedIndex = 0;
		document.getElementById("load_leads").selectedIndex = 1;
		document.getElementById("modify_leads").selectedIndex = 1;
		document.getElementById("download_lists").selectedIndex = 1;
		document.getElementById("export_reports").selectedIndex = 1;
		document.getElementById("delete_from_dnc").selectedIndex = 0;
		document.getElementById("modify_campaigns").selectedIndex = 1;
		document.getElementById("campaign_detail").selectedIndex = 0;
		document.getElementById("delete_campaigns").selectedIndex = 0;
		document.getElementById("modify_ingroups").selectedIndex = 0;
		document.getElementById("delete_ingroups").selectedIndex = 0;
		document.getElementById("modify_inbound_dids").selectedIndex = 0;
		document.getElementById("delete_inbound_dids").selectedIndex = 0;
		document.getElementById("modify_remoteagents").selectedIndex = 0;
		document.getElementById("delete_remote_agents").selectedIndex = 0;
		document.getElementById("modify_scripts").selectedIndex = 0;
		document.getElementById("delete_scripts").selectedIndex = 0;
		document.getElementById("modify_filters").selectedIndex = 0;
		document.getElementById("delete_filters").selectedIndex = 0;
		document.getElementById("ast_admin_access").selectedIndex = 0;
		document.getElementById("ast_delete_phones").selectedIndex = 0;
		document.getElementById("modify_call_times").selectedIndex = 0;
		document.getElementById("delete_call_times").selectedIndex = 0;
		document.getElementById("modify_servers").selectedIndex = 0;
		document.getElementById("vdc_agent_api_access").selectedIndex = 1;
		document.getElementById("add_timeclock_log").selectedIndex = 1;
		document.getElementById("modify_timeclock_log").selectedIndex = 1;
		document.getElementById("delete_timeclock_log").selectedIndex = 1;
		document.getElementById("manager_shift_enforcement_override").selectedIndex = 1;
		document.getElementById("add_new_users").selectedIndex = 1;
		document.getElementById("add_new_campaigns").selectedIndex = 0;
		document.getElementById("add_new_lists").selectedIndex = 1;
		document.getElementById("add_new_usergroups").selectedIndex = 0;
		document.getElementById("add_from_dnc").selectedIndex = 0;
		document.getElementById("view_historical_reports").selectedIndex = 1;
		document.getElementById("live_monitor").selectedIndex = 1;
		document.getElementById("search_historical_call").selectedIndex = 1;
		document.getElementById("search_voice_mail").selectedIndex = 1;
	}
	if(level==9){
		document.getElementById("vicidial_transfers").selectedIndex = 1;
		document.getElementById("agentcall_manual").selectedIndex = 1;
		document.getElementById("view_agent_status").selectedIndex = 1;
		document.getElementById("allow_alerts").selectedIndex = 1;
		document.getElementById("grab_calls_in_queue").selectedIndex = 1;
		document.getElementById("scheduled_callbacks").selectedIndex = 1;
		document.getElementById("agentonly_callbacks").selectedIndex = 1;
		
		document.getElementById("view_reports").selectedIndex = 1;
		document.getElementById("alter_agent_interface_options").selectedIndex = 1;
		document.getElementById("modify_users").selectedIndex = 1;
		document.getElementById("change_agent_campaign").selectedIndex = 1;
		document.getElementById("delete_users").selectedIndex = 1;
		document.getElementById("modify_usergroups").selectedIndex = 1;
		document.getElementById("delete_user_groups").selectedIndex = 1;
		document.getElementById("modify_lists").selectedIndex = 1;
		document.getElementById("delete_lists").selectedIndex = 1;
		document.getElementById("load_leads").selectedIndex = 1;
		document.getElementById("modify_leads").selectedIndex = 1;
		document.getElementById("download_lists").selectedIndex = 1;
		document.getElementById("export_reports").selectedIndex = 1;
		document.getElementById("delete_from_dnc").selectedIndex = 1;
		document.getElementById("modify_campaigns").selectedIndex = 1;
		document.getElementById("campaign_detail").selectedIndex = 1;
		document.getElementById("delete_campaigns").selectedIndex = 1;
		document.getElementById("modify_ingroups").selectedIndex = 0;
		document.getElementById("delete_ingroups").selectedIndex = 0;
		document.getElementById("modify_inbound_dids").selectedIndex = 0;
		document.getElementById("delete_inbound_dids").selectedIndex = 0;
		document.getElementById("modify_remoteagents").selectedIndex = 0;
		document.getElementById("delete_remote_agents").selectedIndex = 0;
		document.getElementById("modify_scripts").selectedIndex = 0;
		document.getElementById("delete_scripts").selectedIndex = 0;
		document.getElementById("modify_filters").selectedIndex = 0;
		document.getElementById("delete_filters").selectedIndex = 0;
		document.getElementById("ast_admin_access").selectedIndex = 0;
		document.getElementById("ast_delete_phones").selectedIndex = 0;
		document.getElementById("modify_call_times").selectedIndex = 0;
		document.getElementById("delete_call_times").selectedIndex = 0;
		document.getElementById("modify_servers").selectedIndex = 0;
		document.getElementById("vdc_agent_api_access").selectedIndex = 1;
		document.getElementById("add_timeclock_log").selectedIndex = 1;
		document.getElementById("modify_timeclock_log").selectedIndex = 1;
		document.getElementById("delete_timeclock_log").selectedIndex = 1;
		document.getElementById("manager_shift_enforcement_override").selectedIndex = 1;
		document.getElementById("add_new_users").selectedIndex = 1;
		document.getElementById("add_new_campaigns").selectedIndex = 1;
		document.getElementById("add_new_lists").selectedIndex = 1;
		document.getElementById("add_new_usergroups").selectedIndex = 1;
		document.getElementById("add_from_dnc").selectedIndex = 1;
		document.getElementById("view_historical_reports").selectedIndex = 1;
		document.getElementById("live_monitor").selectedIndex = 1;
		document.getElementById("search_historical_call").selectedIndex = 1;
		document.getElementById("search_voice_mail").selectedIndex = 1;
	}
}
function CHANGE_ADMIN_INTERFACE_OPTIONS2(){
	try{
	var obj = document.getElementById("user_level");
	var level = obj.options[obj.selectedIndex].value;
	if(level==5){
		document.getElementById("vicidial_transfers").value = 1;
		document.getElementById("agentcall_manual").value = 1;
		document.getElementById("view_agent_status").value = 'N';
		document.getElementById("allow_alerts").value = 0;
		document.getElementById("grab_calls_in_queue").value = 'N';
		document.getElementById("scheduled_callbacks").value = 1;
		document.getElementById("agentonly_callbacks").value = 1;
		
		document.getElementById("view_reports").value = 0;
		document.getElementById("alter_agent_interface_options").value = 0;
		document.getElementById("modify_users").value = 0;
		document.getElementById("change_agent_campaign").value = 0;
		document.getElementById("delete_users").value = 0;
		document.getElementById("modify_usergroups").value = 0;
		document.getElementById("delete_user_groups").value = 0;
		document.getElementById("modify_lists").value = 0;
		document.getElementById("delete_lists").value = 0;
		document.getElementById("load_leads").value = 0;
		document.getElementById("modify_leads").value = 0;
		document.getElementById("download_lists").value = 0;
		document.getElementById("export_reports").value = 0;
		document.getElementById("delete_from_dnc").value = 0;
		document.getElementById("modify_campaigns").value = 0;
		document.getElementById("campaign_detail").value = 0;
		document.getElementById("delete_campaigns").value = 0;
		document.getElementById("modify_ingroups").value = 0;
		document.getElementById("delete_ingroups").value = 0;
		document.getElementById("modify_inbound_dids").value = 0;
		document.getElementById("delete_inbound_dids").value = 0;
		document.getElementById("modify_remoteagents").value = 0;
		document.getElementById("delete_remote_agents").value = 0;
		document.getElementById("modify_scripts").value = 0;
		document.getElementById("delete_scripts").value = 0;
		document.getElementById("modify_filters").value = 0;
		document.getElementById("delete_filters").value = 0;
		document.getElementById("ast_admin_access").value = 0;
		document.getElementById("ast_delete_phones").value = 0;
		document.getElementById("modify_call_times").value = 0;
		document.getElementById("delete_call_times").value = 0;
		document.getElementById("modify_servers").value = 0;
		document.getElementById("vdc_agent_api_access").value = 1;
		document.getElementById("add_timeclock_log").value = 0;
		document.getElementById("modify_timeclock_log").value = 0;
		document.getElementById("delete_timeclock_log").value = 0;
		document.getElementById("manager_shift_enforcement_override").value = 0;
		document.getElementById("add_new_users").value = 0;
		document.getElementById("add_new_campaigns").value = 0;
		document.getElementById("add_new_lists").value = 0;
		document.getElementById("add_new_usergroups").value = 0;
		document.getElementById("add_from_dnc").value = 0;
		document.getElementById("view_historical_reports").value = 0;
		document.getElementById("live_monitor").value = 0;
		document.getElementById("search_historical_call").value = 0;
		document.getElementById("search_voice_mail").value = 0;
	}
	if(level==6){
		document.getElementById("vicidial_transfers").value = 1;
		document.getElementById("agentcall_manual").value = 1;
		document.getElementById("view_agent_status").value = 'Y';
		document.getElementById("allow_alerts").value = 1;
		document.getElementById("grab_calls_in_queue").value = 'Y';
		document.getElementById("scheduled_callbacks").value = 1;
		document.getElementById("agentonly_callbacks").value = 1;
		
		document.getElementById("view_reports").value = 0;
		document.getElementById("alter_agent_interface_options").value = 0;
		document.getElementById("modify_users").value = 0;
		document.getElementById("change_agent_campaign").value = 0;
		document.getElementById("delete_users").value = 0;
		document.getElementById("modify_usergroups").value = 0;
		document.getElementById("delete_user_groups").value = 0;
		document.getElementById("modify_lists").value = 0;
		document.getElementById("delete_lists").value = 0;
		document.getElementById("load_leads").value = 0;
		document.getElementById("modify_leads").value = 0;
		document.getElementById("download_lists").value = 0;
		document.getElementById("export_reports").value = 0;
		document.getElementById("delete_from_dnc").value = 0;
		document.getElementById("modify_campaigns").value = 0;
		document.getElementById("campaign_detail").value = 0;
		document.getElementById("delete_campaigns").value = 0;
		document.getElementById("modify_ingroups").value = 0;
		document.getElementById("delete_ingroups").value = 0;
		document.getElementById("modify_inbound_dids").value = 0;
		document.getElementById("delete_inbound_dids").value = 0;
		document.getElementById("modify_remoteagents").value = 0;
		document.getElementById("delete_remote_agents").value = 0;
		document.getElementById("modify_scripts").value = 0;
		document.getElementById("delete_scripts").value = 0;
		document.getElementById("modify_filters").value = 0;
		document.getElementById("delete_filters").value = 0;
		document.getElementById("ast_admin_access").value = 0;
		document.getElementById("ast_delete_phones").value = 0;
		document.getElementById("modify_call_times").value = 0;
		document.getElementById("delete_call_times").value = 0;
		document.getElementById("modify_servers").value = 0;
		document.getElementById("vdc_agent_api_access").value = 1;
		document.getElementById("add_timeclock_log").value = 0;
		document.getElementById("modify_timeclock_log").value = 0;
		document.getElementById("delete_timeclock_log").value = 0;
		document.getElementById("manager_shift_enforcement_override").value = 0;
		document.getElementById("add_new_users").value = 0;
		document.getElementById("add_new_campaigns").value = 0;
		document.getElementById("add_new_lists").value = 0;
		document.getElementById("add_new_usergroups").value = 0;
		document.getElementById("add_from_dnc").value = 0;
		document.getElementById("view_historical_reports").value = 0;
		document.getElementById("live_monitor").value = 1;
		document.getElementById("search_historical_call").value = 1;
		document.getElementById("search_voice_mail").value = 1;
	}
	if(level==7 || level==8){
		document.getElementById("vicidial_transfers").value = 1;
		document.getElementById("agentcall_manual").value = 1;
		document.getElementById("view_agent_status").value = 'Y';
		document.getElementById("allow_alerts").value = 1;
		document.getElementById("grab_calls_in_queue").value = 'Y';
		document.getElementById("scheduled_callbacks").value = 1;
		document.getElementById("agentonly_callbacks").value = 1;
		

		document.getElementById("view_reports").value = 1;
		document.getElementById("alter_agent_interface_options").value = 1;
		document.getElementById("modify_users").value = 1;
		document.getElementById("change_agent_campaign").value = 1;
		document.getElementById("delete_users").value = 1;
		document.getElementById("modify_usergroups").value = 1;
		document.getElementById("delete_user_groups").value = 0;
		document.getElementById("modify_lists").value = 1;
		document.getElementById("delete_lists").value = 0;
		document.getElementById("load_leads").value = 1;
		document.getElementById("modify_leads").value = 1;
		document.getElementById("download_lists").value = 1;
		document.getElementById("export_reports").value = 1;
		document.getElementById("delete_from_dnc").value = 0;
		document.getElementById("modify_campaigns").value = 1;
		document.getElementById("campaign_detail").value = 0;
		document.getElementById("delete_campaigns").value = 0;
		document.getElementById("modify_ingroups").value = 0;
		document.getElementById("delete_ingroups").value = 0;
		document.getElementById("modify_inbound_dids").value = 0;
		document.getElementById("delete_inbound_dids").value = 0;
		document.getElementById("modify_remoteagents").value = 0;
		document.getElementById("delete_remote_agents").value = 0;
		document.getElementById("modify_scripts").value = 0;
		document.getElementById("delete_scripts").value = 0;
		document.getElementById("modify_filters").value = 0;
		document.getElementById("delete_filters").value = 0;
		document.getElementById("ast_admin_access").value = 0;
		document.getElementById("ast_delete_phones").value = 0;
		document.getElementById("modify_call_times").value = 0;
		document.getElementById("delete_call_times").value = 0;
		document.getElementById("modify_servers").value = 0;
		document.getElementById("vdc_agent_api_access").value = 1;
		document.getElementById("add_timeclock_log").value = 1;
		document.getElementById("modify_timeclock_log").value = 1;
		document.getElementById("delete_timeclock_log").value = 1;
		document.getElementById("manager_shift_enforcement_override").value = 1;
		document.getElementById("add_new_users").value = 1;
		document.getElementById("add_new_campaigns").value = 0;
		document.getElementById("add_new_lists").value = 1;
		document.getElementById("add_new_usergroups").value = 0;
		document.getElementById("add_from_dnc").value = 0;
		document.getElementById("view_historical_reports").value = 1;
		document.getElementById("live_monitor").value = 1;
		document.getElementById("search_historical_call").value = 1;
		document.getElementById("search_voice_mail").value = 1;
	}
	if(level==9){
		document.getElementById("vicidial_transfers").value = 1;
		document.getElementById("agentcall_manual").value = 1;
		document.getElementById("view_agent_status").value = 'Y';
		document.getElementById("allow_alerts").value = 1;
		document.getElementById("grab_calls_in_queue").value = 'Y';
		document.getElementById("scheduled_callbacks").value = 1;
		document.getElementById("agentonly_callbacks").value = 1;
		
		document.getElementById("view_reports").value = 1;
		document.getElementById("alter_agent_interface_options").value = 1;
		document.getElementById("modify_users").value = 1;
		document.getElementById("change_agent_campaign").value = 1;
		document.getElementById("delete_users").value = 1;
		document.getElementById("modify_usergroups").value = 1;
		document.getElementById("delete_user_groups").value = 1;
		document.getElementById("modify_lists").value = 1;
		document.getElementById("delete_lists").value = 1;
		document.getElementById("load_leads").value = 1;
		document.getElementById("modify_leads").value = 1;
		document.getElementById("download_lists").value = 1;
		document.getElementById("export_reports").value = 1;
		document.getElementById("delete_from_dnc").value = 1;
		document.getElementById("modify_campaigns").value = 1;
		document.getElementById("campaign_detail").value = 1;
		document.getElementById("delete_campaigns").value = 1;
		document.getElementById("modify_ingroups").value = 0;
		document.getElementById("delete_ingroups").value = 0;
		document.getElementById("modify_inbound_dids").value = 0;
		document.getElementById("delete_inbound_dids").value = 0;
		document.getElementById("modify_remoteagents").value = 0;
		document.getElementById("delete_remote_agents").value = 0;
		document.getElementById("modify_scripts").value = 0;
		document.getElementById("delete_scripts").value = 0;
		document.getElementById("modify_filters").value = 0;
		document.getElementById("delete_filters").value = 0;
		document.getElementById("ast_admin_access").value = 0;
		document.getElementById("ast_delete_phones").value = 0;
		document.getElementById("modify_call_times").value = 0;
		document.getElementById("delete_call_times").value = 0;
		document.getElementById("modify_servers").value = 0;
		document.getElementById("vdc_agent_api_access").value = 1;
		document.getElementById("add_timeclock_log").value = 1;
		document.getElementById("modify_timeclock_log").value = 1;
		document.getElementById("delete_timeclock_log").value = 1;
		document.getElementById("manager_shift_enforcement_override").value = 1;
		document.getElementById("add_new_users").value = 1;
		document.getElementById("add_new_campaigns").value = 1;
		document.getElementById("add_new_lists").value = 1;
		document.getElementById("add_new_usergroups").value = 1;
		document.getElementById("add_from_dnc").value = 1;
		document.getElementById("view_historical_reports").value = 1;
		document.getElementById("live_monitor").value = 1;
		document.getElementById("search_historical_call").value = 1;
		document.getElementById("search_voice_mail").value = 1;
	}
	}catch(err){
		alert(err);
	}
}
function changeInboundMode(para){
	var obj = document.getElementById("campaign_inbound_mode");
	var level = obj.options[obj.selectedIndex].value;

	if(level=="auto"){
		window.location="admin.php?ADD=31&campaign_id="+para+"&modepara=auto";
	}else{
		window.location="admin.php?ADD=31&campaign_id="+para+"&modepara=ring";
	}
}
function checkUserLevelOptions(level,user){
	
	var obj = document.getElementById("user_group");
	var val = obj.options[obj.selectedIndex].value;
	//alert(val + "--" + level + "---" + user);
	if(level=="7"){
		var para = "&action=usergroup&usergroup=" + val + "&user=" + user;
		var xhr = new AjaxXmlHttpRequest();
		xhr.open("POST", "ajax.php", true);
		xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
		
		xhr.send(para);
		xhr.onreadystatechange = function()
		{
			if (xhr.readyState == 4)
			{
				var result = xhr.responseText;
				if(result!=""){
					alert(user + " is the supervisor of usergroup " + result + ". Please change the supervisor of " + result + " to NONE at first!");
					obj.options[obj.options.length-1].selected = true;
					return false;
				}
			}
		}
	}
}
function changeCampaignByUsergroup(disablestr,level,user){
	var obj = document.getElementById("user_group");
	var val = obj.options[obj.selectedIndex].value;
	
	var para = "&action=campaign&usergroup=" + val + "&disabled_campaigns=" + disablestr + "&level=" + level + "&user=" + user;
	
	var xhr = new AjaxXmlHttpRequest();
	xhr.open("POST", "ajax.php", true);
	xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
	
	xhr.send(para);
	xhr.onreadystatechange = function()
	{
		if (xhr.readyState == 4)
		{
			//alert(xhr.responseText);
			var result = xhr.responseText;
			if(result.indexOf("::")>0){
				alert(user + " is the supervisor of usergroup " + result.substring(3) + ". Please change the supervisor of " + result.substring(3) + " to NONE at first!");
				obj.options[obj.options.length-1].selected = true;
			}else{
				document.getElementById("campaign_span_html").innerHTML= result;
			}
			
		}
	}

}

function AjaxXmlHttpRequest(){
	var xmlHttp;
	try{
		xmlHttp = new XMLHttpRequest();
	}
	catch (e){
		try{
			xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e){
			try{
				xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
			}catch (e){
				alert("您的浏览器不支持AJAX！");
				return false;
			}
		}
	}
	return xmlHttp;
} 
function changeRingMode(){

	var obj = document.getElementById("inbound_mode");
	//	var val = obj.options[obj.selectedIndex].text;
	//兼容IE、Firefox写法
	var val = document.getElementById("inbound_mode").options[document.getElementById("inbound_mode").options.selectedIndex].text;
	//alert(val);
	if(val=="ring"){
		document.getElementById("ring_tr1").style.display="";
		//document.getElementById("ring_tr2").style.display="";
		//document.getElementById("ring_tr3").style.display="";
		//document.getElementById("ring_tr4").style.display="";
		//document.getElementById("ring_tr5").style.display="";
		document.getElementById("ring_tr6").style.display="";
		document.getElementById("auto_tr1").style.display="none";
		//window.location="admin.php?ADD=3111&group_id="+para+"&modepara=ring";
	}else{
		document.getElementById("ring_tr1").style.display="none";
		//document.getElementById("ring_tr2").style.display="none";
		//document.getElementById("ring_tr3").style.display="none";
		//document.getElementById("ring_tr4").style.display="none";
		//document.getElementById("ring_tr5").style.display="none";
		document.getElementById("ring_tr6").style.display="none";
		document.getElementById("auto_tr1").style.display="";
	//window.location="admin.php?ADD=3111&group_id="+para+"&modepara=auto";
	}
}

function SetCwinHeight(iframeObj){ 
if (document.getElementById){ 
   if (iframeObj && !window.opera){ 
   if (iframeObj.contentDocument && iframeObj.contentDocument.body.offsetHeight){ 
   iframeObj.height = iframeObj.contentDocument.body.offsetHeight; 
   iframeObj.width = iframeObj.contentDocument.body.offsetWidth;
   }else if(document.frames[iframeObj.name].document && document.frames[iframeObj.name].document.body.scrollHeight){ 
   iframeObj.height = document.frames[iframeObj.name].document.body.scrollHeight+30+'px'; 
   //iframeObj.width = document.frames[iframeObj.name].document.body.scrollWidth+150+'px';
   } 
   } 
} 
}
function changeDncLinkPara(){
	var obj = document.getElementById("campaign_id");
	var val = obj.options[obj.selectedIndex].value;
	document.getElementById('dnc_detail').href = './dnc.php?action=dnc&list=' + val;
	document.getElementById('dnc_change_log').href = './dnc.php?list=' + val;
}
function changeDncLinkPara2(){
	var obj = document.getElementById("campaign_id");
	var val = obj.options[obj.selectedIndex].value;
	document.getElementById('dnc_detail').href = './dnc.php?direction=inbound&action=dnc&list=' + val;
	document.getElementById('dnc_change_log').href = './dnc.php?direction=inbound&list=' + val;
}
function SetIframeHeight(iframeObj){ 
if (document.getElementById){ 
   if (iframeObj && !window.opera){ 
   if (iframeObj.contentDocument && iframeObj.contentDocument.body.offsetHeight){ 
   iframeObj.height = iframeObj.contentDocument.body.offsetHeight; 
//alert(iframeObj.height);
   if(iframeObj.height < 488){iframeObj.height = 488;}
   iframeObj.width = iframeObj.contentDocument.body.offsetWidth;
   }else if(document.frames[iframeObj.name].document && document.frames[iframeObj.name].document.body.scrollHeight){ 
   iframeObj.height = document.frames[iframeObj.name].document.body.scrollHeight+30+'px'; 
//alert(iframeObj.height);
   if(iframeObj.height < 488){iframeObj.height = 488;}
   //iframeObj.width = document.frames[iframeObj.name].document.body.scrollWidth+150+'px';
   } 
   } 
} 
} 
function delete_confirm(myUrl){
	if(confirm("确认删除？")==true){
		document.location.href = myUrl;
	}
}
function contentFilter(getValStr){
	var getValArray = Array();
	var getVal;
	var getVal_field;
	var getVal_field_title;
	var getVal_field_id;
	var getVal_field_type;
	var msg;
	var return_val = true;
	
	var specia = 0;
	var specia_from;
	var specia_to;
	
	
	getValArray = getValStr.split("&&&");
	
	for(i=0;i<getValArray.length;i++){
		getVal_field = getValArray[i].split(",");
		getVal_field_title = getVal_field[0];
		getVal_field_id = getVal_field[1];
		getVal_field_type = getVal_field[2];
		
		if(getVal_field_type == 1){
			var reg = /^[a-z\d_]{2,16}$/i;
			msg = "please use 2 to 16 characters with \"0\-9\|a\-Z\|\_\"";
		}
		else if(getVal_field_type == 2 || getVal_field_type == 3){
			var reg = /^\d+$/;
			msg = "only be made up by numbers";
		}
		
		if(getVal_field_type == 3){
			specia = 1;
			if(getVal_field_id == "extension_from"||getVal_field_id == "user_name_suffix_from"){specia_from = document.getElementById(getVal_field_id).value;}
			else if(getVal_field_id == "extension_to"||getVal_field_id == "user_name_suffix_to"){specia_to = document.getElementById(getVal_field_id).value;}
		}
		
		if(!reg.test(document.getElementById(getVal_field_id).value)){
			alert("["+getVal_field_title+"] ERROR! "+msg);
			return_val = false;
		}
		
	}
	
	if(return_val&&specia){
		specia_from = parseInt(specia_from,10);
		specia_to = parseInt(specia_to,10);
		if(specia_to <= specia_from){
			alert("ERROR! [Phone Extension To] must biger than [Phone Extension From]");
			return_val = false;
		}
	}
	
	return return_val;

}


function dnc_phone_numbers(textarea_id){
	var phone_number_list = document.getElementById(textarea_id).value;
	var phone_number_array = Array();
	var return_val = true;
	var reg = /^\d+$/;
	var phone_number;
	phone_number_array = phone_number_list.split("\n");
	
	for(i=0;i<phone_number_array.length;i++){
		phone_number = phone_number_array[i].replace(/(^\s*)|(\s*$)/g,"");
		if(phone_number != "" && (!reg.test(phone_number))){
			alert("["+phone_number+"] is invalid!only be made up by numbers");
			return_val = false;
		}
		else if(phone_number != "" && (!limit_length_(phone_number,3,18))){
			alert("["+phone_number+"] is invalid!the number length must between 3 and 18");
			return_val = false;
		}
	}
	return return_val;
}

function limit_length_(myStr,strMin,strMax){
	var return_val = true;
	if(myStr.length>strMax||myStr.length<strMin){
		return_val = false;
	}
	return return_val;
}

function query_type_select(myId){
	var query_type = document.getElementById(myId).value.toUpperCase();
	query_type = query_type.replace(/(^\s*)|(\s*$)/g, "");
	if(query_type == 'BETWEEN'){
		document.getElementById(myId+"_2a").style.display = '';
	}
	else{
		document.getElementById(myId+"_2a").style.display = 'none';
		document.getElementById(myId+"_2").value = '';
	}
}
function change_SubPages_page_size(formId,SubPages_page_size){
	document.getElementById('SubPages_page_size').value = SubPages_page_size;
	document.getElementById(formId).submit();
}