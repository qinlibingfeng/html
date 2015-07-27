<?php

$page_width='770';
$section_width='750';
$header_font_size='3';
$subheader_font_size='2';
$subcamp_font_size='2';
$header_selected_bold='<b>';
$header_nonselected_bold='';
$users_color =		'#FFFF99';
$campaigns_color =	'#FFCC99';
$lists_color =		'#FFCCCC';
$ingroups_color =	'#CC99FF';
$remoteagent_color ='#CCFFCC';
$usergroups_color =	'#CCFFFF';
$scripts_color =	'#99FFCC';
$filters_color =	'#CCCCCC';
$admin_color =		'#FF99FF';
$reports_color =	'#99FF33';
	$times_color =		'#FF33FF';
	$shifts_color =		'#FF33FF';
	$phones_color =		'#FF33FF';
	$conference_color =	'#FF33FF';
	$server_color =		'#FF33FF';
	$templates_color =	'#FF33FF';
	$carriers_color =	'#FF33FF';
	$settings_color = 	'#FF33FF';
	$status_color = 	'#FF33FF';
	$moh_color = 		'#FF33FF';
	$vm_color = 		'#FF33FF';
	$tts_color = 		'#FF33FF';
$subcamp_color =	'#FF9933';
$users_font =		'BLACK';
$campaigns_font =	'BLACK';
$lists_font =		'BLACK';
$ingroups_font =	'BLACK';
$remoteagent_font =	'BLACK';
$usergroups_font =	'BLACK';
$scripts_font =		'BLACK';
$filters_font =		'BLACK';
$admin_font =		'BLACK';
$reports_font =		'BLACK';
	$times_font =		'BLACK';
	$phones_font =		'BLACK';
	$conference_font =	'BLACK';
	$server_font =		'BLACK';
	$settings_font = 	'BLACK';
	$status_font = 	'BLACK';
	$moh_font = 	'BLACK';
	$vm_font = 		'BLACK';
	$tts_font = 	'BLACK';
$subcamp_font =		'BLACK';

### comment this section out for colorful section headings
$users_color =		'#ff9900';
$campaigns_color =	'#ff9900';
$lists_color =		'#ff9900';
$ingroups_color =	'#ff9900';
$remoteagent_color ='#ff9900';
$usergroups_color =	'#ff9900';
$scripts_color =	'#ff9900';
$filters_color =	'#ff9900';
$admin_color =		'#ff9900';
$reports_color =	'#ff9900';
	$times_color =		'#ff9900';
	$shifts_color =		'#ff9900';
	$phones_color =		'#ff9900';
	$conference_color =	'#ff9900';
	$server_color =		'#ff9900';
	$templates_color =	'#ff9900';
	$carriers_color =	'#ff9900';
	$settings_color = 	'#ff9900';
	$status_color = 	'#ff9900';
	$moh_color = 		'#ff9900';
	$vm_color = 		'#ff9900';
	$tts_color = 		'#ff9900';
$subcamp_color =	'#ff9900';
###


$PHP_AUTH_USER=$_SERVER['PHP_AUTH_USER'];
$PHP_AUTH_PW=$_SERVER['PHP_AUTH_PW'];
$PHP_SELF=$_SERVER['PHP_SELF'];

######################################################################################################
######################################################################################################
#######   Form variable declaration
######################################################################################################
######################################################################################################


if (isset($_GET["DB"]))				{$DB=$_GET["DB"];}
	elseif (isset($_POST["DB"]))	{$DB=$_POST["DB"];}
if (isset($_GET["active"]))	{$active=$_GET["active"];}
	elseif (isset($_POST["active"]))	{$active=$_POST["active"];}
if (isset($_GET["adaptive_dl_diff_target"]))	{$adaptive_dl_diff_target=$_GET["adaptive_dl_diff_target"];}
	elseif (isset($_POST["adaptive_dl_diff_target"]))	{$adaptive_dl_diff_target=$_POST["adaptive_dl_diff_target"];}
if (isset($_GET["adaptive_dropped_percentage"]))	{$adaptive_dropped_percentage=$_GET["adaptive_dropped_percentage"];}
	elseif (isset($_POST["adaptive_dropped_percentage"])){$adaptive_dropped_percentage=$_POST["adaptive_dropped_percentage"];}
if (isset($_GET["adaptive_intensity"]))	{$adaptive_intensity=$_GET["adaptive_intensity"];}
	elseif (isset($_POST["adaptive_intensity"]))	{$adaptive_intensity=$_POST["adaptive_intensity"];}
if (isset($_GET["adaptive_latest_server_time"]))	{$adaptive_latest_server_time=$_GET["adaptive_latest_server_time"];}
	elseif (isset($_POST["adaptive_latest_server_time"])){$adaptive_latest_server_time=$_POST["adaptive_latest_server_time"];}
if (isset($_GET["adaptive_maximum_level"]))	{$adaptive_maximum_level=$_GET["adaptive_maximum_level"];}
	elseif (isset($_POST["adaptive_maximum_level"]))	{$adaptive_maximum_level=$_POST["adaptive_maximum_level"];}
if (isset($_GET["SUB"]))			{$SUB=$_GET["SUB"];}
	elseif (isset($_POST["SUB"]))	{$SUB=$_POST["SUB"];}
if (isset($_GET["ADD"]))			{$ADD=$_GET["ADD"];}
	elseif (isset($_POST["ADD"]))	{$ADD=$_POST["ADD"];}
if (isset($_GET["admin_hangup_enabled"]))	{$admin_hangup_enabled=$_GET["admin_hangup_enabled"];}
	elseif (isset($_POST["admin_hangup_enabled"]))	{$admin_hangup_enabled=$_POST["admin_hangup_enabled"];}
if (isset($_GET["admin_hijack_enabled"]))	{$admin_hijack_enabled=$_GET["admin_hijack_enabled"];}
	elseif (isset($_POST["admin_hijack_enabled"]))	{$admin_hijack_enabled=$_POST["admin_hijack_enabled"];}
if (isset($_GET["admin_monitor_enabled"]))	{$admin_monitor_enabled=$_GET["admin_monitor_enabled"];}
	elseif (isset($_POST["admin_monitor_enabled"]))	{$admin_monitor_enabled=$_POST["admin_monitor_enabled"];}
if (isset($_GET["AFLogging_enabled"]))	{$AFLogging_enabled=$_GET["AFLogging_enabled"];}
	elseif (isset($_POST["AFLogging_enabled"]))	{$AFLogging_enabled=$_POST["AFLogging_enabled"];}
if (isset($_GET["agent_choose_ingroups"]))	{$agent_choose_ingroups=$_GET["agent_choose_ingroups"];}
	elseif (isset($_POST["agent_choose_ingroups"]))	{$agent_choose_ingroups=$_POST["agent_choose_ingroups"];}
if (isset($_GET["agentcall_manual"]))	{$agentcall_manual=$_GET["agentcall_manual"];}
	elseif (isset($_POST["agentcall_manual"]))	{$agentcall_manual=$_POST["agentcall_manual"];}
if (isset($_GET["agentonly_callbacks"]))	{$agentonly_callbacks=$_GET["agentonly_callbacks"];}
	elseif (isset($_POST["agentonly_callbacks"]))	{$agentonly_callbacks=$_POST["agentonly_callbacks"];}
if (isset($_GET["AGI_call_logging_enabled"]))	{$AGI_call_logging_enabled=$_GET["AGI_call_logging_enabled"];}
	elseif (isset($_POST["AGI_call_logging_enabled"]))	{$AGI_call_logging_enabled=$_POST["AGI_call_logging_enabled"];}
if (isset($_GET["agi_output"]))	{$agi_output=$_GET["agi_output"];}
	elseif (isset($_POST["agi_output"]))	{$agi_output=$_POST["agi_output"];}
if (isset($_GET["allcalls_delay"]))	{$allcalls_delay=$_GET["allcalls_delay"];}
	elseif (isset($_POST["allcalls_delay"]))	{$allcalls_delay=$_POST["allcalls_delay"];}
if (isset($_GET["allow_closers"]))	{$allow_closers=$_GET["allow_closers"];}
	elseif (isset($_POST["allow_closers"]))	{$allow_closers=$_POST["allow_closers"];}
if (isset($_GET["alt_number_dialing"]))	{$alt_number_dialing=$_GET["alt_number_dialing"];}
	elseif (isset($_POST["alt_number_dialing"]))	{$alt_number_dialing=$_POST["alt_number_dialing"];}
if (isset($_GET["alter_agent_interface_options"]))	{$alter_agent_interface_options=$_GET["alter_agent_interface_options"];}
	elseif (isset($_POST["alter_agent_interface_options"]))	{$alter_agent_interface_options=$_POST["alter_agent_interface_options"];}
if (isset($_GET["am_message_exten"]))	{$am_message_exten=$_GET["am_message_exten"];}
	elseif (isset($_POST["am_message_exten"]))	{$am_message_exten=$_POST["am_message_exten"];}
if (isset($_GET["amd_send_to_vmx"]))	{$amd_send_to_vmx=$_GET["amd_send_to_vmx"];}
	elseif (isset($_POST["amd_send_to_vmx"]))	{$amd_send_to_vmx=$_POST["amd_send_to_vmx"];}
if (isset($_GET["answer_transfer_agent"]))	{$answer_transfer_agent=$_GET["answer_transfer_agent"];}
	elseif (isset($_POST["answer_transfer_agent"]))	{$answer_transfer_agent=$_POST["answer_transfer_agent"];}
if (isset($_GET["ast_admin_access"]))	{$ast_admin_access=$_GET["ast_admin_access"];}
	elseif (isset($_POST["ast_admin_access"]))	{$ast_admin_access=$_POST["ast_admin_access"];}
if (isset($_GET["ast_delete_phones"]))	{$ast_delete_phones=$_GET["ast_delete_phones"];}
	elseif (isset($_POST["ast_delete_phones"]))	{$ast_delete_phones=$_POST["ast_delete_phones"];}
if (isset($_GET["asterisk_version"]))	{$asterisk_version=$_GET["asterisk_version"];}
	elseif (isset($_POST["asterisk_version"]))	{$asterisk_version=$_POST["asterisk_version"];}
if (isset($_GET["ASTmgrSECRET"]))	{$ASTmgrSECRET=$_GET["ASTmgrSECRET"];}
	elseif (isset($_POST["ASTmgrSECRET"]))	{$ASTmgrSECRET=$_POST["ASTmgrSECRET"];}
if (isset($_GET["ASTmgrUSERNAME"]))	{$ASTmgrUSERNAME=$_GET["ASTmgrUSERNAME"];}
	elseif (isset($_POST["ASTmgrUSERNAME"]))	{$ASTmgrUSERNAME=$_POST["ASTmgrUSERNAME"];}
if (isset($_GET["ASTmgrUSERNAMElisten"]))	{$ASTmgrUSERNAMElisten=$_GET["ASTmgrUSERNAMElisten"];}
	elseif (isset($_POST["ASTmgrUSERNAMElisten"]))	{$ASTmgrUSERNAMElisten=$_POST["ASTmgrUSERNAMElisten"];}
if (isset($_GET["ASTmgrUSERNAMEsend"]))	{$ASTmgrUSERNAMEsend=$_GET["ASTmgrUSERNAMEsend"];}
	elseif (isset($_POST["ASTmgrUSERNAMEsend"]))	{$ASTmgrUSERNAMEsend=$_POST["ASTmgrUSERNAMEsend"];}
if (isset($_GET["ASTmgrUSERNAMEupdate"]))	{$ASTmgrUSERNAMEupdate=$_GET["ASTmgrUSERNAMEupdate"];}
	elseif (isset($_POST["ASTmgrUSERNAMEupdate"]))	{$ASTmgrUSERNAMEupdate=$_POST["ASTmgrUSERNAMEupdate"];}
if (isset($_GET["attempt_delay"]))	{$attempt_delay=$_GET["attempt_delay"];}
	elseif (isset($_POST["attempt_delay"]))	{$attempt_delay=$_POST["attempt_delay"];}
if (isset($_GET["attempt_maximum"]))	{$attempt_maximum=$_GET["attempt_maximum"];}
	elseif (isset($_POST["attempt_maximum"]))	{$attempt_maximum=$_POST["attempt_maximum"];}
if (isset($_GET["auto_dial_level"]))	{$auto_dial_level=$_GET["auto_dial_level"];}
	elseif (isset($_POST["auto_dial_level"]))	{$auto_dial_level=$_POST["auto_dial_level"];}
if (isset($_GET["auto_dial_next_number"]))	{$auto_dial_next_number=$_GET["auto_dial_next_number"];}
	elseif (isset($_POST["auto_dial_next_number"]))	{$auto_dial_next_number=$_POST["auto_dial_next_number"];}
if (isset($_GET["available_only_ratio_tally"]))	{$available_only_ratio_tally=$_GET["available_only_ratio_tally"];}
	elseif (isset($_POST["available_only_ratio_tally"])){$available_only_ratio_tally=$_POST["available_only_ratio_tally"];}
if (isset($_GET["call_out_number_group"]))	{$call_out_number_group=$_GET["call_out_number_group"];}
	elseif (isset($_POST["call_out_number_group"]))	{$call_out_number_group=$_POST["call_out_number_group"];}
if (isset($_GET["call_parking_enabled"]))	{$call_parking_enabled=$_GET["call_parking_enabled"];}
	elseif (isset($_POST["call_parking_enabled"]))	{$call_parking_enabled=$_POST["call_parking_enabled"];}
if (isset($_GET["call_time_comments"]))	{$call_time_comments=$_GET["call_time_comments"];}
	elseif (isset($_POST["call_time_comments"]))	{$call_time_comments=$_POST["call_time_comments"];}
if (isset($_GET["call_time_id"]))	{$call_time_id=$_GET["call_time_id"];}
	elseif (isset($_POST["call_time_id"]))	{$call_time_id=$_POST["call_time_id"];}
if (isset($_GET["call_time_name"]))	{$call_time_name=$_GET["call_time_name"];}
	elseif (isset($_POST["call_time_name"]))	{$call_time_name=$_POST["call_time_name"];}
if (isset($_GET["CallerID_popup_enabled"]))	{$CallerID_popup_enabled=$_GET["CallerID_popup_enabled"];}
	elseif (isset($_POST["CallerID_popup_enabled"]))	{$CallerID_popup_enabled=$_POST["CallerID_popup_enabled"];}
if (isset($_GET["campaign_cid"]))	{$campaign_cid=$_GET["campaign_cid"];}
	elseif (isset($_POST["campaign_cid"]))	{$campaign_cid=$_POST["campaign_cid"];}
if (isset($_GET["campaign_detail"]))	{$campaign_detail=$_GET["campaign_detail"];}
	elseif (isset($_POST["campaign_detail"]))	{$campaign_detail=$_POST["campaign_detail"];}
if (isset($_GET["campaign_id"]))	{$campaign_id=$_GET["campaign_id"];}
	elseif (isset($_POST["campaign_id"]))	{$campaign_id=$_POST["campaign_id"];}
if (isset($_GET["campaign_name"]))	{$campaign_name=$_GET["campaign_name"];}
	elseif (isset($_POST["campaign_name"]))	{$campaign_name=$_POST["campaign_name"];}
if (isset($_GET["campaign_rec_exten"]))	{$campaign_rec_exten=$_GET["campaign_rec_exten"];}
	elseif (isset($_POST["campaign_rec_exten"]))	{$campaign_rec_exten=$_POST["campaign_rec_exten"];}
if (isset($_GET["campaign_rec_filename"]))	{$campaign_rec_filename=$_GET["campaign_rec_filename"];}
	elseif (isset($_POST["campaign_rec_filename"]))	{$campaign_rec_filename=$_POST["campaign_rec_filename"];}
if (isset($_GET["ingroup_rec_filename"]))	{$ingroup_rec_filename=$_GET["ingroup_rec_filename"];}
	elseif (isset($_POST["ingroup_rec_filename"]))	{$ingroup_rec_filename=$_POST["ingroup_rec_filename"];}
if (isset($_GET["campaign_recording"]))	{$campaign_recording=$_GET["campaign_recording"];}
	elseif (isset($_POST["campaign_recording"]))	{$campaign_recording=$_POST["campaign_recording"];}
if (isset($_GET["campaign_vdad_exten"]))	{$campaign_vdad_exten=$_GET["campaign_vdad_exten"];}
	elseif (isset($_POST["campaign_vdad_exten"]))	{$campaign_vdad_exten=$_POST["campaign_vdad_exten"];}
if (isset($_GET["change_agent_campaign"]))	{$change_agent_campaign=$_GET["change_agent_campaign"];}
	elseif (isset($_POST["change_agent_campaign"]))	{$change_agent_campaign=$_POST["change_agent_campaign"];}
if (isset($_GET["client_browser"]))	{$client_browser=$_GET["client_browser"];}
	elseif (isset($_POST["client_browser"]))	{$client_browser=$_POST["client_browser"];}
if (isset($_GET["closer_default_blended"]))	{$closer_default_blended=$_GET["closer_default_blended"];}
	elseif (isset($_POST["closer_default_blended"]))	{$closer_default_blended=$_POST["closer_default_blended"];}
if (isset($_GET["company"]))	{$company=$_GET["company"];}
	elseif (isset($_POST["company"]))	{$company=$_POST["company"];}
if (isset($_GET["computer_ip"]))	{$computer_ip=$_GET["computer_ip"];}
	elseif (isset($_POST["computer_ip"]))	{$computer_ip=$_POST["computer_ip"];}
if (isset($_GET["conf_exten"]))	{$conf_exten=$_GET["conf_exten"];}
	elseif (isset($_POST["conf_exten"]))	{$conf_exten=$_POST["conf_exten"];}
if (isset($_GET["conf_on_extension"]))	{$conf_on_extension=$_GET["conf_on_extension"];}
	elseif (isset($_POST["conf_on_extension"]))	{$conf_on_extension=$_POST["conf_on_extension"];}
if (isset($_GET["conferencing_enabled"]))	{$conferencing_enabled=$_GET["conferencing_enabled"];}
	elseif (isset($_POST["conferencing_enabled"]))	{$conferencing_enabled=$_POST["conferencing_enabled"];}
if (isset($_GET["CoNfIrM"]))	{$CoNfIrM=$_GET["CoNfIrM"];}
	elseif (isset($_POST["CoNfIrM"]))	{$CoNfIrM=$_POST["CoNfIrM"];}
if (isset($_GET["ct_default_start"]))	{$ct_default_start=$_GET["ct_default_start"];}
	elseif (isset($_POST["ct_default_start"]))	{$ct_default_start=$_POST["ct_default_start"];}
if (isset($_GET["ct_default_stop"]))	{$ct_default_stop=$_GET["ct_default_stop"];}
	elseif (isset($_POST["ct_default_stop"]))	{$ct_default_stop=$_POST["ct_default_stop"];}
if (isset($_GET["ct_friday_start"]))	{$ct_friday_start=$_GET["ct_friday_start"];}
	elseif (isset($_POST["ct_friday_start"]))	{$ct_friday_start=$_POST["ct_friday_start"];}
if (isset($_GET["ct_friday_stop"]))	{$ct_friday_stop=$_GET["ct_friday_stop"];}
	elseif (isset($_POST["ct_friday_stop"]))	{$ct_friday_stop=$_POST["ct_friday_stop"];}
if (isset($_GET["ct_monday_start"]))	{$ct_monday_start=$_GET["ct_monday_start"];}
	elseif (isset($_POST["ct_monday_start"]))	{$ct_monday_start=$_POST["ct_monday_start"];}
if (isset($_GET["ct_monday_stop"]))	{$ct_monday_stop=$_GET["ct_monday_stop"];}
	elseif (isset($_POST["ct_monday_stop"]))	{$ct_monday_stop=$_POST["ct_monday_stop"];}
if (isset($_GET["ct_saturday_start"]))	{$ct_saturday_start=$_GET["ct_saturday_start"];}
	elseif (isset($_POST["ct_saturday_start"]))	{$ct_saturday_start=$_POST["ct_saturday_start"];}
if (isset($_GET["ct_saturday_stop"]))	{$ct_saturday_stop=$_GET["ct_saturday_stop"];}
	elseif (isset($_POST["ct_saturday_stop"]))	{$ct_saturday_stop=$_POST["ct_saturday_stop"];}
if (isset($_GET["ct_sunday_start"]))	{$ct_sunday_start=$_GET["ct_sunday_start"];}
	elseif (isset($_POST["ct_sunday_start"]))	{$ct_sunday_start=$_POST["ct_sunday_start"];}
if (isset($_GET["ct_sunday_stop"]))	{$ct_sunday_stop=$_GET["ct_sunday_stop"];}
	elseif (isset($_POST["ct_sunday_stop"]))	{$ct_sunday_stop=$_POST["ct_sunday_stop"];}
if (isset($_GET["ct_thursday_start"]))	{$ct_thursday_start=$_GET["ct_thursday_start"];}
	elseif (isset($_POST["ct_thursday_start"]))	{$ct_thursday_start=$_POST["ct_thursday_start"];}
if (isset($_GET["ct_thursday_stop"]))	{$ct_thursday_stop=$_GET["ct_thursday_stop"];}
	elseif (isset($_POST["ct_thursday_stop"]))	{$ct_thursday_stop=$_POST["ct_thursday_stop"];}
if (isset($_GET["ct_tuesday_start"]))	{$ct_tuesday_start=$_GET["ct_tuesday_start"];}
	elseif (isset($_POST["ct_tuesday_start"]))	{$ct_tuesday_start=$_POST["ct_tuesday_start"];}
if (isset($_GET["ct_tuesday_stop"]))	{$ct_tuesday_stop=$_GET["ct_tuesday_stop"];}
	elseif (isset($_POST["ct_tuesday_stop"]))	{$ct_tuesday_stop=$_POST["ct_tuesday_stop"];}
if (isset($_GET["ct_wednesday_start"]))	{$ct_wednesday_start=$_GET["ct_wednesday_start"];}
	elseif (isset($_POST["ct_wednesday_start"]))	{$ct_wednesday_start=$_POST["ct_wednesday_start"];}
if (isset($_GET["ct_wednesday_stop"]))	{$ct_wednesday_stop=$_GET["ct_wednesday_stop"];}
	elseif (isset($_POST["ct_wednesday_stop"]))	{$ct_wednesday_stop=$_POST["ct_wednesday_stop"];}
if (isset($_GET["DBX_database"]))	{$DBX_database=$_GET["DBX_database"];}
	elseif (isset($_POST["DBX_database"]))	{$DBX_database=$_POST["DBX_database"];}
if (isset($_GET["DBX_pass"]))	{$DBX_pass=$_GET["DBX_pass"];}
	elseif (isset($_POST["DBX_pass"]))	{$DBX_pass=$_POST["DBX_pass"];}
if (isset($_GET["DBX_port"]))	{$DBX_port=$_GET["DBX_port"];}
	elseif (isset($_POST["DBX_port"]))	{$DBX_port=$_POST["DBX_port"];}
if (isset($_GET["DBX_server"]))	{$DBX_server=$_GET["DBX_server"];}
	elseif (isset($_POST["DBX_server"]))	{$DBX_server=$_POST["DBX_server"];}
if (isset($_GET["DBX_user"]))	{$DBX_user=$_GET["DBX_user"];}
	elseif (isset($_POST["DBX_user"]))	{$DBX_user=$_POST["DBX_user"];}
if (isset($_GET["DBY_database"]))	{$DBY_database=$_GET["DBY_database"];}
	elseif (isset($_POST["DBY_database"]))	{$DBY_database=$_POST["DBY_database"];}
if (isset($_GET["DBY_pass"]))	{$DBY_pass=$_GET["DBY_pass"];}
	elseif (isset($_POST["DBY_pass"]))	{$DBY_pass=$_POST["DBY_pass"];}
if (isset($_GET["DBY_port"]))	{$DBY_port=$_GET["DBY_port"];}
	elseif (isset($_POST["DBY_port"]))	{$DBY_port=$_POST["DBY_port"];}
if (isset($_GET["DBY_server"]))	{$DBY_server=$_GET["DBY_server"];}
	elseif (isset($_POST["DBY_server"]))	{$DBY_server=$_POST["DBY_server"];}
if (isset($_GET["DBY_user"]))	{$DBY_user=$_GET["DBY_user"];}
	elseif (isset($_POST["DBY_user"]))	{$DBY_user=$_POST["DBY_user"];}
if (isset($_GET["delete_call_times"]))	{$delete_call_times=$_GET["delete_call_times"];}
	elseif (isset($_POST["delete_call_times"]))	{$delete_call_times=$_POST["delete_call_times"];}
if (isset($_GET["delete_campaigns"]))	{$delete_campaigns=$_GET["delete_campaigns"];}
	elseif (isset($_POST["delete_campaigns"]))	{$delete_campaigns=$_POST["delete_campaigns"];}
if (isset($_GET["delete_filters"]))	{$delete_filters=$_GET["delete_filters"];}
	elseif (isset($_POST["delete_filters"]))	{$delete_filters=$_POST["delete_filters"];}
if (isset($_GET["delete_ingroups"]))	{$delete_ingroups=$_GET["delete_ingroups"];}
	elseif (isset($_POST["delete_ingroups"]))	{$delete_ingroups=$_POST["delete_ingroups"];}
if (isset($_GET["delete_lists"]))	{$delete_lists=$_GET["delete_lists"];}
	elseif (isset($_POST["delete_lists"]))	{$delete_lists=$_POST["delete_lists"];}
if (isset($_GET["delete_remote_agents"]))	{$delete_remote_agents=$_GET["delete_remote_agents"];}
	elseif (isset($_POST["delete_remote_agents"]))	{$delete_remote_agents=$_POST["delete_remote_agents"];}
if (isset($_GET["delete_scripts"]))	{$delete_scripts=$_GET["delete_scripts"];}
	elseif (isset($_POST["delete_scripts"]))	{$delete_scripts=$_POST["delete_scripts"];}
if (isset($_GET["delete_user_groups"]))	{$delete_user_groups=$_GET["delete_user_groups"];}
	elseif (isset($_POST["delete_user_groups"]))	{$delete_user_groups=$_POST["delete_user_groups"];}
if (isset($_GET["delete_users"]))	{$delete_users=$_GET["delete_users"];}
	elseif (isset($_POST["delete_users"]))	{$delete_users=$_POST["delete_users"];}
if (isset($_GET["dial_method"]))	{$dial_method=$_GET["dial_method"];}
	elseif (isset($_POST["dial_method"]))	{$dial_method=$_POST["dial_method"];}
if (isset($_GET["dial_prefix"]))	{$dial_prefix=$_GET["dial_prefix"];}
	elseif (isset($_POST["dial_prefix"]))	{$dial_prefix=$_POST["dial_prefix"];}
if (isset($_GET["dial_status_a"]))	{$dial_status_a=$_GET["dial_status_a"];}
	elseif (isset($_POST["dial_status_a"]))	{$dial_status_a=$_POST["dial_status_a"];}
if (isset($_GET["dial_status_b"]))	{$dial_status_b=$_GET["dial_status_b"];}
	elseif (isset($_POST["dial_status_b"]))	{$dial_status_b=$_POST["dial_status_b"];}
if (isset($_GET["dial_status_c"]))	{$dial_status_c=$_GET["dial_status_c"];}
	elseif (isset($_POST["dial_status_c"]))	{$dial_status_c=$_POST["dial_status_c"];}
if (isset($_GET["dial_status_d"]))	{$dial_status_d=$_GET["dial_status_d"];}
	elseif (isset($_POST["dial_status_d"]))	{$dial_status_d=$_POST["dial_status_d"];}
if (isset($_GET["dial_status_e"]))	{$dial_status_e=$_GET["dial_status_e"];}
	elseif (isset($_POST["dial_status_e"]))	{$dial_status_e=$_POST["dial_status_e"];}
if (isset($_GET["dial_timeout"]))	{$dial_timeout=$_GET["dial_timeout"];}
	elseif (isset($_POST["dial_timeout"]))	{$dial_timeout=$_POST["dial_timeout"];}
if (isset($_GET["dialplan_number"]))	{$dialplan_number=$_GET["dialplan_number"];}
	elseif (isset($_POST["dialplan_number"]))	{$dialplan_number=$_POST["dialplan_number"];}
if (isset($_GET["drop_call_seconds"]))	{$drop_call_seconds=$_GET["drop_call_seconds"];}
	elseif (isset($_POST["drop_call_seconds"]))	{$drop_call_seconds=$_POST["drop_call_seconds"];}
if (isset($_GET["drop_exten"]))	{$drop_exten=$_GET["drop_exten"];}
	elseif (isset($_POST["drop_exten"]))	{$drop_exten=$_POST["drop_exten"];}
if (isset($_GET["drop_action"]))	{$drop_action=$_GET["drop_action"];}
	elseif (isset($_POST["drop_action"]))	{$drop_action=$_POST["drop_action"];}
if (isset($_GET["dtmf_send_extension"]))	{$dtmf_send_extension=$_GET["dtmf_send_extension"];}
	elseif (isset($_POST["dtmf_send_extension"]))	{$dtmf_send_extension=$_POST["dtmf_send_extension"];}
if (isset($_GET["enable_fast_refresh"]))	{$enable_fast_refresh=$_GET["enable_fast_refresh"];}
	elseif (isset($_POST["enable_fast_refresh"]))	{$enable_fast_refresh=$_POST["enable_fast_refresh"];}
if (isset($_GET["enable_persistant_mysql"]))	{$enable_persistant_mysql=$_GET["enable_persistant_mysql"];}
	elseif (isset($_POST["enable_persistant_mysql"]))	{$enable_persistant_mysql=$_POST["enable_persistant_mysql"];}
if (isset($_GET["ext_context"]))	{$ext_context=$_GET["ext_context"];}
	elseif (isset($_POST["ext_context"]))	{$ext_context=$_POST["ext_context"];}
if (isset($_GET["extension"]))	{$extension=$_GET["extension"];}
	elseif (isset($_POST["extension"]))	{$extension=$_POST["extension"];}
if (isset($_GET["fast_refresh_rate"]))	{$fast_refresh_rate=$_GET["fast_refresh_rate"];}
	elseif (isset($_POST["fast_refresh_rate"]))	{$fast_refresh_rate=$_POST["fast_refresh_rate"];}
if (isset($_GET["force_logout"]))	{$force_logout=$_GET["force_logout"];}
	elseif (isset($_POST["force_logout"]))	{$force_logout=$_POST["force_logout"];}
if (isset($_GET["fronter_display"]))	{$fronter_display=$_GET["fronter_display"];}
	elseif (isset($_POST["fronter_display"]))	{$fronter_display=$_POST["fronter_display"];}
if (isset($_GET["full_name"]))	{$full_name=$_GET["full_name"];}
	elseif (isset($_POST["full_name"]))	{$full_name=$_POST["full_name"];}
if (isset($_GET["fullname"]))	{$fullname=$_GET["fullname"];}
	elseif (isset($_POST["fullname"]))	{$fullname=$_POST["fullname"];}
if (isset($_GET["get_call_launch"]))	{$get_call_launch=$_GET["get_call_launch"];}
	elseif (isset($_POST["get_call_launch"]))	{$get_call_launch=$_POST["get_call_launch"];}
if (isset($_GET["group_color"]))	{$group_color=$_GET["group_color"];}
	elseif (isset($_POST["group_color"]))	{$group_color=$_POST["group_color"];}
if (isset($_GET["group_id"]))	{$group_id=$_GET["group_id"];}
	elseif (isset($_POST["group_id"]))	{$group_id=$_POST["group_id"];}
if (isset($_GET["group_name"]))	{$group_name=$_GET["group_name"];}
	elseif (isset($_POST["group_name"]))	{$group_name=$_POST["group_name"];}
if (isset($_GET["manager_select"]))	{$manager_select=$_GET["manager_select"];}
	elseif (isset($_POST["manager_select"]))	{$manager_select=$_POST["manager_select"];}
if (isset($_GET["supervisor_select"]))	{$supervisor_select=$_GET["supervisor_select"];}
	elseif (isset($_POST["supervisor_select"]))	{$supervisor_select=$_POST["supervisor_select"];}
if (isset($_GET["qa_select"]))	{$qa_select=$_GET["qa_select"];}
	elseif (isset($_POST["qa_select"]))	{$qa_select=$_POST["qa_select"];}	
if (isset($_GET["groups"]))	{$groups=$_GET["groups"];}
	elseif (isset($_POST["groups"]))	{$groups=$_POST["groups"];}
if (isset($_GET["XFERgroups"]))	{$XFERgroups=$_GET["XFERgroups"];}
	elseif (isset($_POST["XFERgroups"]))	{$XFERgroups=$_POST["XFERgroups"];}
if (isset($_GET["HKstatus"]))	{$HKstatus=$_GET["HKstatus"];}
	elseif (isset($_POST["HKstatus"]))	{$HKstatus=$_POST["HKstatus"];}
if (isset($_GET["hopper_level"]))	{$hopper_level=$_GET["hopper_level"];}
	elseif (isset($_POST["hopper_level"]))	{$hopper_level=$_POST["hopper_level"];}
if (isset($_GET["hotkey"]))	{$hotkey=$_GET["hotkey"];}
	elseif (isset($_POST["hotkey"]))	{$hotkey=$_POST["hotkey"];}
if (isset($_GET["hotkeys_active"]))	{$hotkeys_active=$_GET["hotkeys_active"];}
	elseif (isset($_POST["hotkeys_active"]))	{$hotkeys_active=$_POST["hotkeys_active"];}
if (isset($_GET["install_directory"]))	{$install_directory=$_GET["install_directory"];}
	elseif (isset($_POST["install_directory"]))	{$install_directory=$_POST["install_directory"];}
if (isset($_GET["lead_filter_comments"]))	{$lead_filter_comments=$_GET["lead_filter_comments"];}
	elseif (isset($_POST["lead_filter_comments"]))	{$lead_filter_comments=$_POST["lead_filter_comments"];}
if (isset($_GET["lead_filter_id"]))	{$lead_filter_id=$_GET["lead_filter_id"];}
	elseif (isset($_POST["lead_filter_id"]))	{$lead_filter_id=$_POST["lead_filter_id"];}
if (isset($_GET["lead_filter_name"]))	{$lead_filter_name=$_GET["lead_filter_name"];}
	elseif (isset($_POST["lead_filter_name"]))	{$lead_filter_name=$_POST["lead_filter_name"];}
if (isset($_GET["lead_filter_sql"]))	{$lead_filter_sql=$_GET["lead_filter_sql"];}
	elseif (isset($_POST["lead_filter_sql"]))	{$lead_filter_sql=$_POST["lead_filter_sql"];}
if (isset($_GET["lead_order"]))	{$lead_order=$_GET["lead_order"];}
	elseif (isset($_POST["lead_order"]))	{$lead_order=$_POST["lead_order"];}
if (isset($_GET["list_id"]))	{$list_id=$_GET["list_id"];}
	elseif (isset($_POST["list_id"]))	{$list_id=$_POST["list_id"];}
if (isset($_GET["list_name"]))	{$list_name=$_GET["list_name"];}
	elseif (isset($_POST["list_name"]))	{$list_name=$_POST["list_name"];}
if (isset($_GET["load_leads"]))	{$load_leads=$_GET["load_leads"];}
	elseif (isset($_POST["load_leads"]))	{$load_leads=$_POST["load_leads"];}
if (isset($_GET["local_call_time"]))	{$local_call_time=$_GET["local_call_time"];}
	elseif (isset($_POST["local_call_time"]))	{$local_call_time=$_POST["local_call_time"];}
if (isset($_GET["local_gmt"]))	{$local_gmt=$_GET["local_gmt"];}
	elseif (isset($_POST["local_gmt"]))	{$local_gmt=$_POST["local_gmt"];}
if (isset($_GET["local_web_callerID_URL"]))	{$local_web_callerID_URL=$_GET["local_web_callerID_URL"];}
	elseif (isset($_POST["local_web_callerID_URL"]))	{$local_web_callerID_URL=$_POST["local_web_callerID_URL"];}
if (isset($_GET["login"]))	{$login=$_GET["login"];}
	elseif (isset($_POST["login"]))	{$login=$_POST["login"];}
if (isset($_GET["login_campaign"]))	{$login_campaign=$_GET["login_campaign"];}
	elseif (isset($_POST["login_campaign"]))	{$login_campaign=$_POST["login_campaign"];}
if (isset($_GET["login_pass"]))	{$login_pass=$_GET["login_pass"];}
	elseif (isset($_POST["login_pass"]))	{$login_pass=$_POST["login_pass"];}
if (isset($_GET["login_user"]))	{$login_user=$_GET["login_user"];}
	elseif (isset($_POST["login_user"]))	{$login_user=$_POST["login_user"];}
if (isset($_GET["max_vicidial_trunks"]))	{$max_vicidial_trunks=$_GET["max_vicidial_trunks"];}
	elseif (isset($_POST["max_vicidial_trunks"]))	{$max_vicidial_trunks=$_POST["max_vicidial_trunks"];}
if (isset($_GET["modify_call_times"]))	{$modify_call_times=$_GET["modify_call_times"];}
	elseif (isset($_POST["modify_call_times"]))	{$modify_call_times=$_POST["modify_call_times"];}
if (isset($_GET["modify_leads"]))	{$modify_leads=$_GET["modify_leads"];}
	elseif (isset($_POST["modify_leads"]))	{$modify_leads=$_POST["modify_leads"];}
if (isset($_GET["monitor_prefix"]))	{$monitor_prefix=$_GET["monitor_prefix"];}
	elseif (isset($_POST["monitor_prefix"]))	{$monitor_prefix=$_POST["monitor_prefix"];}
if (isset($_GET["next_agent_call"]))	{$next_agent_call=$_GET["next_agent_call"];}
	elseif (isset($_POST["next_agent_call"]))	{$next_agent_call=$_POST["next_agent_call"];}
if (isset($_GET["next_agent_call_ring"]))	{$next_agent_call_ring=$_GET["next_agent_call_ring"];}
	elseif (isset($_POST["next_agent_call_ring"]))	{$next_agent_call_ring=$_POST["next_agent_call_ring"];}	
if (isset($_GET["number_of_lines"]))	{$number_of_lines=$_GET["number_of_lines"];}
	elseif (isset($_POST["number_of_lines"]))	{$number_of_lines=$_POST["number_of_lines"];}
if (isset($_GET["old_campaign_id"]))	{$old_campaign_id=$_GET["old_campaign_id"];}
	elseif (isset($_POST["old_campaign_id"]))	{$old_campaign_id=$_POST["old_campaign_id"];}
if (isset($_GET["old_conf_exten"]))	{$old_conf_exten=$_GET["old_conf_exten"];}
	elseif (isset($_POST["old_conf_exten"]))	{$old_conf_exten=$_POST["old_conf_exten"];}
if (isset($_GET["old_extension"]))	{$old_extension=$_GET["old_extension"];}
	elseif (isset($_POST["old_extension"]))	{$old_extension=$_POST["old_extension"];}
if (isset($_GET["old_server_id"]))	{$old_server_id=$_GET["old_server_id"];}
	elseif (isset($_POST["old_server_id"]))	{$old_server_id=$_POST["old_server_id"];}
if (isset($_GET["old_server_ip"]))	{$old_server_ip=$_GET["old_server_ip"];}
	elseif (isset($_POST["old_server_ip"]))	{$old_server_ip=$_POST["old_server_ip"];}
if (isset($_GET["OLDuser_group"]))	{$OLDuser_group=$_GET["OLDuser_group"];}
	elseif (isset($_POST["OLDuser_group"]))	{$OLDuser_group=$_POST["OLDuser_group"];}
if (isset($_GET["omit_phone_code"]))	{$omit_phone_code=$_GET["omit_phone_code"];}
	elseif (isset($_POST["omit_phone_code"]))	{$omit_phone_code=$_POST["omit_phone_code"];}
if (isset($_GET["outbound_cid"]))	{$outbound_cid=$_GET["outbound_cid"];}
	elseif (isset($_POST["outbound_cid"]))	{$outbound_cid=$_POST["outbound_cid"];}
if (isset($_GET["park_ext"]))	{$park_ext=$_GET["park_ext"];}
	elseif (isset($_POST["park_ext"]))	{$park_ext=$_POST["park_ext"];}
if (isset($_GET["park_file_name"]))	{$park_file_name=$_GET["park_file_name"];}
	elseif (isset($_POST["park_file_name"]))	{$park_file_name=$_POST["park_file_name"];}
if (isset($_GET["park_on_extension"]))	{$park_on_extension=$_GET["park_on_extension"];}
	elseif (isset($_POST["park_on_extension"]))	{$park_on_extension=$_POST["park_on_extension"];}
if (isset($_GET["pass"]))	{$pass=$_GET["pass"];}
	elseif (isset($_POST["pass"]))	{$pass=$_POST["pass"];}
if (isset($_GET["phone_ip"]))	{$phone_ip=$_GET["phone_ip"];}
	elseif (isset($_POST["phone_ip"]))	{$phone_ip=$_POST["phone_ip"];}
if (isset($_GET["phone_login"]))	{$phone_login=$_GET["phone_login"];}
	elseif (isset($_POST["phone_login"]))	{$phone_login=$_POST["phone_login"];}
if (isset($_GET["phone_number"]))	{$phone_number=$_GET["phone_number"];}
	elseif (isset($_POST["phone_number"]))	{$phone_number=$_POST["phone_number"];}
if (isset($_GET["phone_pass"]))	{$phone_pass=$_GET["phone_pass"];}
	elseif (isset($_POST["phone_pass"]))	{$phone_pass=$_POST["phone_pass"];}
if (isset($_GET["phone_type"]))	{$phone_type=$_GET["phone_type"];}
	elseif (isset($_POST["phone_type"]))	{$phone_type=$_POST["phone_type"];}
if (isset($_GET["picture"]))	{$picture=$_GET["picture"];}
	elseif (isset($_POST["picture"]))	{$picture=$_POST["picture"];}
if (isset($_GET["protocol"]))	{$protocol=$_GET["protocol"];}
	elseif (isset($_POST["protocol"]))	{$protocol=$_POST["protocol"];}
if (isset($_GET["QUEUE_ACTION_enabled"]))	{$QUEUE_ACTION_enabled=$_GET["QUEUE_ACTION_enabled"];}
	elseif (isset($_POST["QUEUE_ACTION_enabled"]))	{$QUEUE_ACTION_enabled=$_POST["QUEUE_ACTION_enabled"];}
if (isset($_GET["recording_exten"]))	{$recording_exten=$_GET["recording_exten"];}
	elseif (isset($_POST["recording_exten"]))	{$recording_exten=$_POST["recording_exten"];}
if (isset($_GET["remote_agent_id"]))	{$remote_agent_id=$_GET["remote_agent_id"];}
	elseif (isset($_POST["remote_agent_id"]))	{$remote_agent_id=$_POST["remote_agent_id"];}
if (isset($_GET["reset_hopper"]))	{$reset_hopper=$_GET["reset_hopper"];}
	elseif (isset($_POST["reset_hopper"]))	{$reset_hopper=$_POST["reset_hopper"];}
if (isset($_GET["reset_list"]))	{$reset_list=$_GET["reset_list"];}
	elseif (isset($_POST["reset_list"]))	{$reset_list=$_POST["reset_list"];}
if (isset($_GET["safe_harbor_exten"]))	{$safe_harbor_exten=$_GET["safe_harbor_exten"];}
	elseif (isset($_POST["safe_harbor_exten"]))	{$safe_harbor_exten=$_POST["safe_harbor_exten"];}
if (isset($_GET["drop_action"]))	{$drop_action=$_GET["drop_action"];}
	elseif (isset($_POST["drop_action"]))	{$drop_action=$_POST["drop_action"];}
if (isset($_GET["scheduled_callbacks"]))	{$scheduled_callbacks=$_GET["scheduled_callbacks"];}
	elseif (isset($_POST["scheduled_callbacks"]))	{$scheduled_callbacks=$_POST["scheduled_callbacks"];}
if (isset($_GET["script_comments"]))	{$script_comments=$_GET["script_comments"];}
	elseif (isset($_POST["script_comments"]))	{$script_comments=$_POST["script_comments"];}
if (isset($_GET["script_id"]))	{$script_id=$_GET["script_id"];}
	elseif (isset($_POST["script_id"]))	{$script_id=$_POST["script_id"];}
if (isset($_GET["script_name"]))	{$script_name=$_GET["script_name"];}
	elseif (isset($_POST["script_name"]))	{$script_name=$_POST["script_name"];}
if (isset($_GET["script_text"]))	{$script_text=$_GET["script_text"];}
	elseif (isset($_POST["script_text"]))	{$script_text=$_POST["script_text"];}
if (isset($_GET["selectable"]))	{$selectable=$_GET["selectable"];}
	elseif (isset($_POST["selectable"]))	{$selectable=$_POST["selectable"];}
if (isset($_GET["server_description"]))	{$server_description=$_GET["server_description"];}
	elseif (isset($_POST["server_description"]))	{$server_description=$_POST["server_description"];}
if (isset($_GET["server_id"]))	{$server_id=$_GET["server_id"];}
	elseif (isset($_POST["server_id"]))	{$server_id=$_POST["server_id"];}
if (isset($_GET["server_ip"]))	{$server_ip=$_GET["server_ip"];}
	elseif (isset($_POST["server_ip"]))	{$server_ip=$_POST["server_ip"];}
if (isset($_GET["stage"]))	{$stage=$_GET["stage"];}
	elseif (isset($_POST["stage"]))	{$stage=$_POST["stage"];}
if (isset($_GET["state_call_time_state"]))	{$state_call_time_state=$_GET["state_call_time_state"];}
	elseif (isset($_POST["state_call_time_state"]))	{$state_call_time_state=$_POST["state_call_time_state"];}
if (isset($_GET["state_rule"]))	{$state_rule=$_GET["state_rule"];}
	elseif (isset($_POST["state_rule"]))	{$state_rule=$_POST["state_rule"];}
if (isset($_GET["status"]))	{$status=$_GET["status"];}
	elseif (isset($_POST["status"]))	{$status=$_POST["status"];}
if (isset($_GET["status_id"]))	{$status_id=$_GET["status_id"];}
	elseif (isset($_POST["status_id"]))	{$status_id=$_POST["status_id"];}
if (isset($_GET["status_name"]))	{$status_name=$_GET["status_name"];}
	elseif (isset($_POST["status_name"]))	{$status_name=$_POST["status_name"];}
if (isset($_GET["submit"]))	{$submit=$_GET["submit"];}
	elseif (isset($_POST["submit"]))	{$submit=$_POST["submit"];}
if (isset($_GET["SUBMIT"]))	{$SUBMIT=$_GET["SUBMIT"];}
	elseif (isset($_POST["SUBMIT"]))	{$SUBMIT=$_POST["SUBMIT"];}
if (isset($_GET["sys_perf_log"]))	{$sys_perf_log=$_GET["sys_perf_log"];}
	elseif (isset($_POST["sys_perf_log"]))	{$sys_perf_log=$_POST["sys_perf_log"];}
if (isset($_GET["telnet_host"]))	{$telnet_host=$_GET["telnet_host"];}
	elseif (isset($_POST["telnet_host"]))	{$telnet_host=$_POST["telnet_host"];}
if (isset($_GET["telnet_port"]))	{$telnet_port=$_GET["telnet_port"];}
	elseif (isset($_POST["telnet_port"]))	{$telnet_port=$_POST["telnet_port"];}
if (isset($_GET["updater_check_enabled"]))	{$updater_check_enabled=$_GET["updater_check_enabled"];}
	elseif (isset($_POST["updater_check_enabled"]))	{$updater_check_enabled=$_POST["updater_check_enabled"];}
if (isset($_GET["use_internal_dnc"]))	{$use_internal_dnc=$_GET["use_internal_dnc"];}
	elseif (isset($_POST["use_internal_dnc"]))	{$use_internal_dnc=$_POST["use_internal_dnc"];}
if (isset($_GET["use_campaign_dnc"]))	{$use_campaign_dnc=$_GET["use_campaign_dnc"];}
	elseif (isset($_POST["use_campaign_dnc"]))	{$use_campaign_dnc=$_POST["use_campaign_dnc"];}
if (isset($_GET["user"]))	{$user=$_GET["user"];}
	elseif (isset($_POST["user"]))	{$user=$_POST["user"];}
if (isset($_GET["user_group"]))	{$user_group=$_GET["user_group"];}
	elseif (isset($_POST["user_group"]))	{$user_group=$_POST["user_group"];}
if (isset($_GET["user_level"]))	{$user_level=$_GET["user_level"];}
	elseif (isset($_POST["user_level"]))	{$user_level=$_POST["user_level"];}
if (isset($_GET["user_start"]))	{$user_start=$_GET["user_start"];}
	elseif (isset($_POST["user_start"]))	{$user_start=$_POST["user_start"];}
if (isset($_GET["user_switching_enabled"]))	{$user_switching_enabled=$_GET["user_switching_enabled"];}
	elseif (isset($_POST["user_switching_enabled"]))	{$user_switching_enabled=$_POST["user_switching_enabled"];}
if (isset($_GET["vd_server_logs"]))	{$vd_server_logs=$_GET["vd_server_logs"];}
	elseif (isset($_POST["vd_server_logs"]))	{$vd_server_logs=$_POST["vd_server_logs"];}
if (isset($_GET["VDstop_rec_after_each_call"]))	{$VDstop_rec_after_each_call=$_GET["VDstop_rec_after_each_call"];}
	elseif (isset($_POST["VDstop_rec_after_each_call"]))	{$VDstop_rec_after_each_call=$_POST["VDstop_rec_after_each_call"];}
if (isset($_GET["VICIDIAL_park_on_extension"]))	{$VICIDIAL_park_on_extension=$_GET["VICIDIAL_park_on_extension"];}
	elseif (isset($_POST["VICIDIAL_park_on_extension"]))	{$VICIDIAL_park_on_extension=$_POST["VICIDIAL_park_on_extension"];}
if (isset($_GET["VICIDIAL_park_on_filename"]))	{$VICIDIAL_park_on_filename=$_GET["VICIDIAL_park_on_filename"];}
	elseif (isset($_POST["VICIDIAL_park_on_filename"]))	{$VICIDIAL_park_on_filename=$_POST["VICIDIAL_park_on_filename"];}
if (isset($_GET["vicidial_recording"]))	{$vicidial_recording=$_GET["vicidial_recording"];}
	elseif (isset($_POST["vicidial_recording"]))	{$vicidial_recording=$_POST["vicidial_recording"];}
if (isset($_GET["vicidial_transfers"]))	{$vicidial_transfers=$_GET["vicidial_transfers"];}
	elseif (isset($_POST["vicidial_transfers"]))	{$vicidial_transfers=$_POST["vicidial_transfers"];}
if (isset($_GET["VICIDIAL_web_URL"]))	{$VICIDIAL_web_URL=$_GET["VICIDIAL_web_URL"];}
	elseif (isset($_POST["VICIDIAL_web_URL"]))	{$VICIDIAL_web_URL=$_POST["VICIDIAL_web_URL"];}
if (isset($_GET["voicemail_button_enabled"]))	{$voicemail_button_enabled=$_GET["voicemail_button_enabled"];}
	elseif (isset($_POST["voicemail_button_enabled"]))	{$voicemail_button_enabled=$_POST["voicemail_button_enabled"];}
if (isset($_GET["voicemail_dump_exten"]))	{$voicemail_dump_exten=$_GET["voicemail_dump_exten"];}
	elseif (isset($_POST["voicemail_dump_exten"]))	{$voicemail_dump_exten=$_POST["voicemail_dump_exten"];}
if (isset($_GET["voicemail_ext"]))	{$voicemail_ext=$_GET["voicemail_ext"];}
	elseif (isset($_POST["voicemail_ext"]))	{$voicemail_ext=$_POST["voicemail_ext"];}
if (isset($_GET["voicemail_exten"]))	{$voicemail_exten=$_GET["voicemail_exten"];}
	elseif (isset($_POST["voicemail_exten"]))	{$voicemail_exten=$_POST["voicemail_exten"];}
if (isset($_GET["voicemail_id"]))	{$voicemail_id=$_GET["voicemail_id"];}
	elseif (isset($_POST["voicemail_id"]))	{$voicemail_id=$_POST["voicemail_id"];}
if (isset($_GET["web_form_address"]))	{$web_form_address=$_GET["web_form_address"];}
	elseif (isset($_POST["web_form_address"]))	{$web_form_address=$_POST["web_form_address"];}
if (isset($_GET["wrapup_message"]))	{$wrapup_message=$_GET["wrapup_message"];}
	elseif (isset($_POST["wrapup_message"]))	{$wrapup_message=$_POST["wrapup_message"];}
if (isset($_GET["wrapup_seconds"]))	{$wrapup_seconds=$_GET["wrapup_seconds"];}
	elseif (isset($_POST["wrapup_seconds"]))	{$wrapup_seconds=$_POST["wrapup_seconds"];}
if (isset($_GET["xferconf_a_dtmf"]))	{$xferconf_a_dtmf=$_GET["xferconf_a_dtmf"];}
	elseif (isset($_POST["xferconf_a_dtmf"]))	{$xferconf_a_dtmf=$_POST["xferconf_a_dtmf"];}
if (isset($_GET["xferconf_a_number"]))	{$xferconf_a_number=$_GET["xferconf_a_number"];}
	elseif (isset($_POST["xferconf_a_number"]))	{$xferconf_a_number=$_POST["xferconf_a_number"];}
if (isset($_GET["xferconf_b_dtmf"]))	{$xferconf_b_dtmf=$_GET["xferconf_b_dtmf"];}
	elseif (isset($_POST["xferconf_b_dtmf"]))	{$xferconf_b_dtmf=$_POST["xferconf_b_dtmf"];}
if (isset($_GET["xferconf_b_number"]))	{$xferconf_b_number=$_GET["xferconf_b_number"];}
	elseif (isset($_POST["xferconf_b_number"]))	{$xferconf_b_number=$_POST["xferconf_b_number"];}
if (isset($_GET["vicidial_balance_active"]))	{$vicidial_balance_active=$_GET["vicidial_balance_active"];}
	elseif (isset($_POST["vicidial_balance_active"]))	{$vicidial_balance_active=$_POST["vicidial_balance_active"];}
if (isset($_GET["balance_trunks_offlimits"]))	{$balance_trunks_offlimits=$_GET["balance_trunks_offlimits"];}
	elseif (isset($_POST["balance_trunks_offlimits"]))	{$balance_trunks_offlimits=$_POST["balance_trunks_offlimits"];}
if (isset($_GET["dedicated_trunks"]))	{$dedicated_trunks=$_GET["dedicated_trunks"];}
	elseif (isset($_POST["dedicated_trunks"]))	{$dedicated_trunks=$_POST["dedicated_trunks"];}
if (isset($_GET["trunk_restriction"]))	{$trunk_restriction=$_GET["trunk_restriction"];}
	elseif (isset($_POST["trunk_restriction"]))	{$trunk_restriction=$_POST["trunk_restriction"];}
if (isset($_GET["campaigns"]))						{$campaigns=$_GET["campaigns"];}
	elseif (isset($_POST["campaigns"]))				{$campaigns=$_POST["campaigns"];}
if (isset($_GET["dial_level_override"]))			{$dial_level_override=$_GET["dial_level_override"];}
	elseif (isset($_POST["dial_level_override"]))	{$dial_level_override=$_POST["dial_level_override"];}
if (isset($_GET["concurrent_transfers"]))			{$concurrent_transfers=$_GET["concurrent_transfers"];}
	elseif (isset($_POST["concurrent_transfers"]))	{$concurrent_transfers=$_POST["concurrent_transfers"];}
if (isset($_GET["auto_alt_dial"]))			{$auto_alt_dial=$_GET["auto_alt_dial"];}
	elseif (isset($_POST["auto_alt_dial"]))	{$auto_alt_dial=$_POST["auto_alt_dial"];}
if (isset($_GET["modify_users"]))				{$modify_users=$_GET["modify_users"];}
	elseif (isset($_POST["modify_users"]))		{$modify_users=$_POST["modify_users"];}
	
if (isset($_GET["add_from_dnc"]))				{$add_from_dnc=$_GET["add_from_dnc"];}
	elseif (isset($_POST["add_from_dnc"]))		{$add_from_dnc=$_POST["add_from_dnc"];}
if (isset($_GET["add_new_users"]))				{$add_new_users=$_GET["add_new_users"];}
	elseif (isset($_POST["add_new_users"]))		{$add_new_users=$_POST["add_new_users"];}
if (isset($_GET["add_new_campaigns"]))				{$add_new_campaigns=$_GET["add_new_campaigns"];}
	elseif (isset($_POST["add_new_campaigns"]))		{$add_new_campaigns=$_POST["add_new_campaigns"];}
if (isset($_GET["add_new_lists"]))				{$add_new_lists=$_GET["add_new_lists"];}
	elseif (isset($_POST["add_new_lists"]))		{$add_new_lists=$_POST["add_new_lists"];}
if (isset($_GET["add_new_usergroups"]))				{$add_new_usergroups=$_GET["add_new_usergroups"];}
	elseif (isset($_POST["add_new_usergroups"]))		{$add_new_usergroups=$_POST["add_new_usergroups"];}
if (isset($_GET["agent_follow_up"]))				{$agent_follow_up=$_GET["agent_follow_up"];}
	elseif (isset($_POST["agent_follow_up"]))		{$agent_follow_up=$_POST["agent_follow_up"];}
	
if (isset($_GET["modify_campaigns"]))			{$modify_campaigns=$_GET["modify_campaigns"];}
	elseif (isset($_POST["modify_campaigns"]))	{$modify_campaigns=$_POST["modify_campaigns"];}
if (isset($_GET["modify_lists"]))				{$modify_lists=$_GET["modify_lists"];}
	elseif (isset($_POST["modify_lists"]))		{$modify_lists=$_POST["modify_lists"];}
if (isset($_GET["modify_scripts"]))				{$modify_scripts=$_GET["modify_scripts"];}
	elseif (isset($_POST["modify_scripts"]))	{$modify_scripts=$_POST["modify_scripts"];}
if (isset($_GET["modify_filters"]))				{$modify_filters=$_GET["modify_filters"];}
	elseif (isset($_POST["modify_filters"]))	{$modify_filters=$_POST["modify_filters"];}
if (isset($_GET["modify_ingroups"]))			{$modify_ingroups=$_GET["modify_ingroups"];}
	elseif (isset($_POST["modify_ingroups"]))	{$modify_ingroups=$_POST["modify_ingroups"];}
if (isset($_GET["modify_usergroups"]))			{$modify_usergroups=$_GET["modify_usergroups"];}
	elseif (isset($_POST["modify_usergroups"]))	{$modify_usergroups=$_POST["modify_usergroups"];}
if (isset($_GET["modify_remoteagents"]))			{$modify_remoteagents=$_GET["modify_remoteagents"];}
	elseif (isset($_POST["modify_remoteagents"]))	{$modify_remoteagents=$_POST["modify_remoteagents"];}
if (isset($_GET["modify_servers"]))				{$modify_servers=$_GET["modify_servers"];}
	elseif (isset($_POST["modify_servers"]))	{$modify_servers=$_POST["modify_servers"];}
if (isset($_GET["view_reports"]))				{$view_reports=$_GET["view_reports"];}
	elseif (isset($_POST["view_reports"]))		{$view_reports=$_POST["view_reports"];}
if (isset($_GET["agent_pause_codes_active"]))			{$agent_pause_codes_active=$_GET["agent_pause_codes_active"];}
	elseif (isset($_POST["agent_pause_codes_active"]))	{$agent_pause_codes_active=$_POST["agent_pause_codes_active"];}
if (isset($_GET["pause_code"]))					{$pause_code=$_GET["pause_code"];}
	elseif (isset($_POST["pause_code"]))		{$pause_code=$_POST["pause_code"];}
if (isset($_GET["pause_code_name"]))			{$pause_code_name=$_GET["pause_code_name"];}
	elseif (isset($_POST["pause_code_name"]))	{$pause_code_name=$_POST["pause_code_name"];}
if (isset($_GET["billable"]))					{$billable=$_GET["billable"];}
	elseif (isset($_POST["billable"]))			{$billable=$_POST["billable"];}
if (isset($_GET["campaign_description"]))			{$campaign_description=$_GET["campaign_description"];}
	elseif (isset($_POST["campaign_description"]))	{$campaign_description=$_POST["campaign_description"];}
if (isset($_GET["campaign_stats_refresh"]))			{$campaign_stats_refresh=$_GET["campaign_stats_refresh"];}
	elseif (isset($_POST["campaign_stats_refresh"])){$campaign_stats_refresh=$_POST["campaign_stats_refresh"];}
if (isset($_GET["list_description"]))			{$list_description=$_GET["list_description"];}
	elseif (isset($_POST["list_description"]))	{$list_description=$_POST["list_description"];}
if (isset($_GET["vicidial_recording_override"]))		{$vicidial_recording_override=$_GET["vicidial_recording_override"];}	
	elseif (isset($_POST["vicidial_recording_override"]))	{$vicidial_recording_override=$_POST["vicidial_recording_override"];}
if (isset($_GET["use_non_latin"]))				{$use_non_latin=$_GET["use_non_latin"];}
	elseif (isset($_POST["use_non_latin"]))		{$use_non_latin=$_POST["use_non_latin"];}
if (isset($_GET["webroot_writable"]))			{$webroot_writable=$_GET["webroot_writable"];}
	elseif (isset($_POST["webroot_writable"]))	{$webroot_writable=$_POST["webroot_writable"];}
if (isset($_GET["enable_queuemetrics_logging"]))	{$enable_queuemetrics_logging=$_GET["enable_queuemetrics_logging"];}
	elseif (isset($_POST["enable_queuemetrics_logging"]))	{$enable_queuemetrics_logging=$_POST["enable_queuemetrics_logging"];}
if (isset($_GET["queuemetrics_server_ip"]))				{$queuemetrics_server_ip=$_GET["queuemetrics_server_ip"];}
	elseif (isset($_POST["queuemetrics_server_ip"]))	{$queuemetrics_server_ip=$_POST["queuemetrics_server_ip"];}
if (isset($_GET["queuemetrics_dbname"]))			{$queuemetrics_dbname=$_GET["queuemetrics_dbname"];}
	elseif (isset($_POST["queuemetrics_dbname"]))	{$queuemetrics_dbname=$_POST["queuemetrics_dbname"];}
if (isset($_GET["queuemetrics_login"]))				{$queuemetrics_login=$_GET["queuemetrics_login"];}
	elseif (isset($_POST["queuemetrics_login"]))	{$queuemetrics_login=$_POST["queuemetrics_login"];}
if (isset($_GET["queuemetrics_pass"]))			{$queuemetrics_pass=$_GET["queuemetrics_pass"];}
	elseif (isset($_POST["queuemetrics_pass"]))	{$queuemetrics_pass=$_POST["queuemetrics_pass"];}
if (isset($_GET["queuemetrics_url"]))			{$queuemetrics_url=$_GET["queuemetrics_url"];}
	elseif (isset($_POST["queuemetrics_url"]))	{$queuemetrics_url=$_POST["queuemetrics_url"];}
if (isset($_GET["queuemetrics_log_id"]))			{$queuemetrics_log_id=$_GET["queuemetrics_log_id"];}
	elseif (isset($_POST["queuemetrics_log_id"]))	{$queuemetrics_log_id=$_POST["queuemetrics_log_id"];}
if (isset($_GET["dial_status"]))				{$dial_status=$_GET["dial_status"];}
	elseif (isset($_POST["dial_status"]))		{$dial_status=$_POST["dial_status"];}
if (isset($_GET["queuemetrics_eq_prepend"]))			{$queuemetrics_eq_prepend=$_GET["queuemetrics_eq_prepend"];}
	elseif (isset($_POST["queuemetrics_eq_prepend"]))	{$queuemetrics_eq_prepend=$_POST["queuemetrics_eq_prepend"];}
if (isset($_GET["vicidial_agent_disable"]))				{$vicidial_agent_disable=$_GET["vicidial_agent_disable"];}
	elseif (isset($_POST["vicidial_agent_disable"]))	{$vicidial_agent_disable=$_POST["vicidial_agent_disable"];}
if (isset($_GET["disable_alter_custdata"]))				{$disable_alter_custdata=$_GET["disable_alter_custdata"];}
	elseif (isset($_POST["disable_alter_custdata"]))	{$disable_alter_custdata=$_POST["disable_alter_custdata"];}
if (isset($_GET["alter_custdata_override"]))			{$alter_custdata_override=$_GET["alter_custdata_override"];}
	elseif (isset($_POST["alter_custdata_override"]))	{$alter_custdata_override=$_POST["alter_custdata_override"];}
if (isset($_GET["no_hopper_leads_logins"]))				{$no_hopper_leads_logins=$_GET["no_hopper_leads_logins"];}
	elseif (isset($_POST["no_hopper_leads_logins"]))	{$no_hopper_leads_logins=$_POST["no_hopper_leads_logins"];}
if (isset($_GET["enable_sipsak_messages"]))				{$enable_sipsak_messages=$_GET["enable_sipsak_messages"];}
	elseif (isset($_POST["enable_sipsak_messages"]))	{$enable_sipsak_messages=$_POST["enable_sipsak_messages"];}
if (isset($_GET["allow_sipsak_messages"]))				{$allow_sipsak_messages=$_GET["allow_sipsak_messages"];}
	elseif (isset($_POST["allow_sipsak_messages"]))		{$allow_sipsak_messages=$_POST["allow_sipsak_messages"];}
if (isset($_GET["admin_home_url"]))				{$admin_home_url=$_GET["admin_home_url"];}
	elseif (isset($_POST["admin_home_url"]))	{$admin_home_url=$_POST["admin_home_url"];}
if (isset($_GET["list_order_mix"]))				{$list_order_mix=$_GET["list_order_mix"];}
	elseif (isset($_POST["list_order_mix"]))	{$list_order_mix=$_POST["list_order_mix"];}
if (isset($_GET["vcl_id"]))						{$vcl_id=$_GET["vcl_id"];}
	elseif (isset($_POST["vcl_id"]))			{$vcl_id=$_POST["vcl_id"];}
if (isset($_GET["vcl_name"]))					{$vcl_name=$_GET["vcl_name"];}
	elseif (isset($_POST["vcl_name"]))			{$vcl_name=$_POST["vcl_name"];}
if (isset($_GET["list_mix_container"]))				{$list_mix_container=$_GET["list_mix_container"];}
	elseif (isset($_POST["list_mix_container"]))	{$list_mix_container=$_POST["list_mix_container"];}
if (isset($_GET["mix_method"]))					{$mix_method=$_GET["mix_method"];}
	elseif (isset($_POST["mix_method"]))		{$mix_method=$_POST["mix_method"];}
if (isset($_GET["human_answered"]))				{$human_answered=$_GET["human_answered"];}
	elseif (isset($_POST["human_answered"]))	{$human_answered=$_POST["human_answered"];}
if (isset($_GET["status_class"]))                             {$status_class=$_GET["status_class"];}
        elseif (isset($_POST["status_class"]))        {$status_class=$_POST["status_class"];}
if (isset($_GET["category"]))					{$category=$_GET["category"];}
	elseif (isset($_POST["category"]))			{$category=$_POST["category"];}
if (isset($_GET["vsc_id"]))						{$vsc_id=$_GET["vsc_id"];}
	elseif (isset($_POST["vsc_id"]))			{$vsc_id=$_POST["vsc_id"];}
if (isset($_GET["vsc_name"]))					{$vsc_name=$_GET["vsc_name"];}
	elseif (isset($_POST["vsc_name"]))			{$vsc_name=$_POST["vsc_name"];}
if (isset($_GET["vsc_description"]))			{$vsc_description=$_GET["vsc_description"];}
	elseif (isset($_POST["vsc_description"]))	{$vsc_description=$_POST["vsc_description"];}
if (isset($_GET["tovdad_display"]))				{$tovdad_display=$_GET["tovdad_display"];}
	elseif (isset($_POST["tovdad_display"]))	{$tovdad_display=$_POST["tovdad_display"];}
if (isset($_GET["mix_container_item"]))				{$mix_container_item=$_GET["mix_container_item"];}
	elseif (isset($_POST["mix_container_item"]))	{$mix_container_item=$_POST["mix_container_item"];}
if (isset($_GET["enable_agc_xfer_log"]))			{$enable_agc_xfer_log=$_GET["enable_agc_xfer_log"];}
	elseif (isset($_POST["enable_agc_xfer_log"]))	{$enable_agc_xfer_log=$_POST["enable_agc_xfer_log"];}
if (isset($_GET["after_hours_action"]))				{$after_hours_action=$_GET["after_hours_action"];}
	elseif (isset($_POST["after_hours_action"]))	{$after_hours_action=$_POST["after_hours_action"];}
if (isset($_GET["after_hours_message_filename"]))			{$after_hours_message_filename=$_GET["after_hours_message_filename"];}
	elseif (isset($_POST["after_hours_message_filename"]))	{$after_hours_message_filename=$_POST["after_hours_message_filename"];}
if (isset($_GET["after_hours_exten"]))				{$after_hours_exten=$_GET["after_hours_exten"];}
	elseif (isset($_POST["after_hours_exten"]))		{$after_hours_exten=$_POST["after_hours_exten"];}
if (isset($_GET["after_hours_voicemail"]))			{$after_hours_voicemail=$_GET["after_hours_voicemail"];}
	elseif (isset($_POST["after_hours_voicemail"]))	{$after_hours_voicemail=$_POST["after_hours_voicemail"];}
if (isset($_GET["welcome_message_filename"]))			{$welcome_message_filename=$_GET["welcome_message_filename"];}
	elseif (isset($_POST["welcome_message_filename"]))	{$welcome_message_filename=$_POST["welcome_message_filename"];}
if (isset($_GET["moh_context"]))					{$moh_context=$_GET["moh_context"];}
	elseif (isset($_POST["moh_context"]))			{$moh_context=$_POST["moh_context"];}
if (isset($_GET["onhold_prompt_filename"]))				{$onhold_prompt_filename=$_GET["onhold_prompt_filename"];}
	elseif (isset($_POST["onhold_prompt_filename"]))	{$onhold_prompt_filename=$_POST["onhold_prompt_filename"];}
if (isset($_GET["prompt_interval"]))				{$prompt_interval=$_GET["prompt_interval"];}
	elseif (isset($_POST["prompt_interval"]))		{$prompt_interval=$_POST["prompt_interval"];}
if (isset($_GET["agent_alert_exten"]))				{$agent_alert_exten=$_GET["agent_alert_exten"];}
	elseif (isset($_POST["agent_alert_exten"]))		{$agent_alert_exten=$_POST["agent_alert_exten"];}
if (isset($_GET["agent_alert_delay"]))				{$agent_alert_delay=$_GET["agent_alert_delay"];}
	elseif (isset($_POST["agent_alert_delay"]))		{$agent_alert_delay=$_POST["agent_alert_delay"];}
if (isset($_GET["group_rank"]))					{$group_rank=$_GET["group_rank"];}
	elseif (isset($_POST["group_rank"]))		{$group_rank=$_POST["group_rank"];}
if (isset($_GET["campaign_allow_inbound"]))				{$campaign_allow_inbound=$_GET["campaign_allow_inbound"];}
	elseif (isset($_POST["campaign_allow_inbound"]))	{$campaign_allow_inbound=$_POST["campaign_allow_inbound"];}
if (isset($_GET["manual_dial_list_id"]))				{$manual_dial_list_id=$_GET["manual_dial_list_id"];}
	elseif (isset($_POST["manual_dial_list_id"]))		{$manual_dial_list_id=$_POST["manual_dial_list_id"];}
if (isset($_GET["campaign_rank"]))				{$campaign_rank=$_GET["campaign_rank"];}
	elseif (isset($_POST["campaign_rank"]))		{$campaign_rank=$_POST["campaign_rank"];}
if (isset($_GET["source_campaign_id"]))				{$source_campaign_id=$_GET["source_campaign_id"];}
	elseif (isset($_POST["source_campaign_id"]))	{$source_campaign_id=$_POST["source_campaign_id"];}
if (isset($_GET["source_user_id"]))				{$source_user_id=$_GET["source_user_id"];}
	elseif (isset($_POST["source_user_id"]))	{$source_user_id=$_POST["source_user_id"];}
if (isset($_GET["source_group_id"]))			{$source_group_id=$_GET["source_group_id"];}
	elseif (isset($_POST["source_group_id"]))	{$source_group_id=$_POST["source_group_id"];}
if (isset($_GET["default_xfer_group"]))				{$default_xfer_group=$_GET["default_xfer_group"];}
	elseif (isset($_POST["default_xfer_group"]))	{$default_xfer_group=$_POST["default_xfer_group"];}
if (isset($_GET["qc_enabled"]))					{$qc_enabled=$_GET["qc_enabled"];}
	elseif (isset($_POST["qc_enabled"]))		{$qc_enabled=$_POST["qc_enabled"];}
if (isset($_GET["qc_user_level"]))				{$qc_user_level=$_GET["qc_user_level"];}
	elseif (isset($_POST["qc_user_level"]))		{$qc_user_level=$_POST["qc_user_level"];}
if (isset($_GET["qc_pass"]))					{$qc_pass=$_GET["qc_pass"];}
	elseif (isset($_POST["qc_pass"]))			{$qc_pass=$_POST["qc_pass"];}
if (isset($_GET["qc_finish"]))					{$qc_finish=$_GET["qc_finish"];}
	elseif (isset($_POST["qc_finish"]))			{$qc_finish=$_POST["qc_finish"];}
if (isset($_GET["qc_commit"]))					{$qc_commit=$_GET["qc_commit"];}
	elseif (isset($_POST["qc_commit"]))			{$qc_commit=$_POST["qc_commit"];}
if (isset($_GET["qc_campaigns"]))				{$qc_campaigns=$_GET["qc_campaigns"];}
	elseif (isset($_POST["qc_campaigns"]))		{$qc_campaigns=$_POST["qc_campaigns"];}
if (isset($_GET["qc_groups"]))					{$qc_groups=$_GET["qc_groups"];}
	elseif (isset($_POST["qc_groups"]))			{$qc_groups=$_POST["qc_groups"];}
if (isset($_GET["queue_priority"]))				{$queue_priority=$_GET["queue_priority"];}
	elseif (isset($_POST["queue_priority"]))	{$queue_priority=$_POST["queue_priority"];}
if (isset($_GET["ccms_report_url"]))				{$ccms_report_url=$_GET["ccms_report_url"];}
	elseif (isset($_POST["ccms_report_url"]))	{$ccms_report_url=$_POST["ccms_report_url"];}
if (isset($_GET["ccms_url"]))				{$ccms_url=$_GET["ccms_url"];}
	elseif (isset($_POST["ccms_url"]))	{$ccms_url=$_POST["ccms_url"];}

if (isset($_GET["extension_from"]))	{$extension_from=$_GET["extension_from"];}
	elseif (isset($_POST["extension_from"]))	{$extension_from=$_POST["extension_from"];}
if (isset($_GET["extension_to"]))	{$extension_to=$_GET["extension_to"];}
	elseif (isset($_POST["extension_to"]))	{$extension_to=$_POST["extension_to"];}

if (isset($_GET["user_name_prefix"]))	{$user_name_prefix=$_GET["user_name_prefix"];}
	elseif (isset($_POST["user_name_prefix"]))	{$user_name_prefix=$_POST["user_name_prefix"];}
if (isset($_GET["user_name_suffix_from"]))	{$user_name_suffix_from=$_GET["user_name_suffix_from"];}
	elseif (isset($_POST["user_name_suffix_from"]))	{$user_name_suffix_from=$_POST["user_name_suffix_from"];}
if (isset($_GET["user_name_suffix_to"]))	{$user_name_suffix_to=$_GET["user_name_suffix_to"];}
	elseif (isset($_POST["user_name_suffix_to"]))	{$user_name_suffix_to=$_POST["user_name_suffix_to"];}
if (isset($_GET["ccms_wait_in_queue"]))	{$ccms_wait_in_queue=$_GET["ccms_wait_in_queue"];}
	elseif (isset($_POST["ccms_wait_in_queue"]))	{$ccms_wait_in_queue=$_POST["ccms_wait_in_queue"];}

if (isset($_GET["SubPages_page_size"]))				{$SubPages_page_size=$_GET["SubPages_page_size"];}
	elseif (isset($_POST["SubPages_page_size"]))	{$SubPages_page_size=$_POST["SubPages_page_size"];}
if (isset($_GET["SubPages_nums"]))					{$SubPages_nums=$_GET["SubPages_nums"];}
	elseif (isset($_POST["SubPages_nums"]))			{$SubPages_nums=$_POST["SubPages_nums"];}
if (isset($_GET["SubPages_sub_pages"]))				{$SubPages_sub_pages=$_GET["SubPages_sub_pages"];}
	elseif (isset($_POST["SubPages_sub_pages"]))	{$SubPages_sub_pages=$_POST["SubPages_sub_pages"];}
if (isset($_GET["SubPages_pageCurrent"]))			{$SubPages_pageCurrent=$_GET["SubPages_pageCurrent"];}
	elseif (isset($_POST["SubPages_pageCurrent"]))	{$SubPages_pageCurrent=$_POST["SubPages_pageCurrent"];}
	
if((!isset($SubPages_page_size))||trim($SubPages_page_size)=="") $SubPages_page_size = 20;
if((!isset($SubPages_pageCurrent))||trim($SubPages_pageCurrent)=="") $SubPages_pageCurrent = 1;
if((!isset($SubPages_sub_pages))||trim($SubPages_sub_pages)=="") $SubPages_sub_pages = 10;
#Add by fnatic start#
$ring_timeout_seconds=30;
$ring_timeout_action='IN_GROUP';
$ring_timeout_exten='8307';
$ring_timeout_voicemail_ext='';
$ring_timeout_inbound_group='---NONE---';

if (isset($_GET["inbound_mode"]))				{$inbound_mode=$_GET["inbound_mode"];}
	elseif (isset($_POST["inbound_mode"]))	{$inbound_mode=$_POST["inbound_mode"];}
if (isset($_GET["ring_timeout_seconds"]))	{$ring_timeout_seconds=$_GET["ring_timeout_seconds"];}
	elseif (isset($_POST["ring_timeout_seconds"])) {$ring_timeout_seconds=$_POST["ring_timeout_seconds"];}
if (isset($_GET["ring_timeout_action"]))	{$ring_timeout_action=$_GET["ring_timeout_action"];}
	elseif (isset($_POST["ring_timeout_action"]))	{$ring_timeout_action=$_POST["ring_timeout_action"];}
if (isset($_GET["ring_timeout_exten"]))		{$ring_timeout_exten=$_GET["ring_timeout_exten"];}
	elseif (isset($_POST["ring_timeout_exten"]))	{$ring_timeout_exten=$_POST["ring_timeout_exten"];}
if (isset($_GET["ring_timeout_voicemail_ext"]))		{$ring_timeout_voicemail_ext=$_GET["ring_timeout_voicemail_ext"];}
	elseif (isset($_POST["ring_timeout_voicemail_ext"]))	{$ring_timeout_voicemail_ext=$_POST["ring_timeout_voicemail_ext"];}
if (isset($_GET["ring_timeout_inbound_group"]))	{$ring_timeout_inbound_group=$_GET["ring_timeout_inbound_group"];}
	elseif (isset($_POST["ring_timeout_inbound_group"]))	{$ring_timeout_inbound_group=$_POST["ring_timeout_inbound_group"];}
#End#
if (isset($_GET["drop_inbound_group"]))				{$drop_inbound_group=$_GET["drop_inbound_group"];}
	elseif (isset($_POST["drop_inbound_group"]))	{$drop_inbound_group=$_POST["drop_inbound_group"];}

if (isset($_GET["drop_menu_id"]))				{$drop_menu_id=$_GET["drop_menu_id"];}
	elseif (isset($_POST["drop_menu_id"]))		{$drop_menu_id=$_POST["drop_menu_id"];}

if (isset($_GET["qc_statuses"]))			{$qc_statuses=$_GET["qc_statuses"];}
	elseif (isset($_POST["qc_statuses"]))	{$qc_statuses=$_POST["qc_statuses"];}
if (isset($_GET["qc_lists"]))				{$qc_lists=$_GET["qc_lists"];}
	elseif (isset($_POST["qc_lists"]))		{$qc_lists=$_POST["qc_lists"];}
if (isset($_GET["qc_get_record_launch"]))			{$qc_get_record_launch=$_GET["qc_get_record_launch"];}
	elseif (isset($_POST["qc_get_record_launch"]))	{$qc_get_record_launch=$_POST["qc_get_record_launch"];}
if (isset($_GET["qc_show_recording"]))				{$qc_show_recording=$_GET["qc_show_recording"];}
	elseif (isset($_POST["qc_show_recording"]))		{$qc_show_recording=$_POST["qc_show_recording"];}
if (isset($_GET["qc_shift_id"]))				{$qc_shift_id=$_GET["qc_shift_id"];}
	elseif (isset($_POST["qc_shift_id"]))		{$qc_shift_id=$_POST["qc_shift_id"];}
if (isset($_GET["qc_web_form_address"]))				{$qc_web_form_address=$_GET["qc_web_form_address"];}
	elseif (isset($_POST["qc_web_form_address"]))	{$qc_web_form_address=$_POST["qc_web_form_address"];}
if (isset($_GET["qc_script"]))						{$qc_script=$_GET["qc_script"];}
	elseif (isset($_POST["qc_script"]))				{$qc_script=$_POST["qc_script"];}
if (isset($_GET["ingroup_recording_override"]))		{$ingroup_recording_override=$_GET["ingroup_recording_override"];}	
	elseif (isset($_POST["ingroup_recording_override"]))	{$ingroup_recording_override=$_POST["ingroup_recording_override"];}
if (isset($_GET["code"]))				{$code=$_GET["code"];}	
	elseif (isset($_POST["code"]))		{$code=$_POST["code"];}
if (isset($_GET["code_name"]))			{$code_name=$_GET["code_name"];}	
	elseif (isset($_POST["code_name"]))	{$code_name=$_POST["code_name"];}
if (isset($_GET["afterhours_xfer_group"]))			{$afterhours_xfer_group=$_GET["afterhours_xfer_group"];}	
	elseif (isset($_POST["afterhours_xfer_group"]))	{$afterhours_xfer_group=$_POST["afterhours_xfer_group"];}
if (isset($_GET["alias_id"]))				{$alias_id=$_GET["alias_id"];}	
	elseif (isset($_POST["alias_id"]))		{$alias_id=$_POST["alias_id"];}
if (isset($_GET["alias_name"]))				{$alias_name=$_GET["alias_name"];}	
	elseif (isset($_POST["alias_name"]))		{$alias_name=$_POST["alias_name"];}
if (isset($_GET["logins_list"]))				{$logins_list=$_GET["logins_list"];}	
	elseif (isset($_POST["logins_list"]))		{$logins_list=$_POST["logins_list"];}
if (isset($_GET["shift_id"]))				{$shift_id=$_GET["shift_id"];}	
	elseif (isset($_POST["shift_id"]))		{$shift_id=$_POST["shift_id"];}
if (isset($_GET["shift_name"]))				{$shift_name=$_GET["shift_name"];}	
	elseif (isset($_POST["shift_name"]))		{$shift_name=$_POST["shift_name"];}
if (isset($_GET["shift_start_time"]))			{$shift_start_time=$_GET["shift_start_time"];}	
	elseif (isset($_POST["shift_start_time"]))	{$shift_start_time=$_POST["shift_start_time"];}
if (isset($_GET["shift_length"]))				{$shift_length=$_GET["shift_length"];}	
	elseif (isset($_POST["shift_length"]))		{$shift_length=$_POST["shift_length"];}
if (isset($_GET["shift_weekdays"]))				{$shift_weekdays=$_GET["shift_weekdays"];}	
	elseif (isset($_POST["shift_weekdays"]))	{$shift_weekdays=$_POST["shift_weekdays"];}
if (isset($_GET["group_shifts"]))			{$group_shifts=$_GET["group_shifts"];}	
	elseif (isset($_POST["group_shifts"]))	{$group_shifts=$_POST["group_shifts"];}
if (isset($_GET["timeclock_end_of_day"]))			{$timeclock_end_of_day=$_GET["timeclock_end_of_day"];}	
	elseif (isset($_POST["timeclock_end_of_day"]))	{$timeclock_end_of_day=$_POST["timeclock_end_of_day"];}
if (isset($_GET["survey_first_audio_file"]))			{$survey_first_audio_file=$_GET["survey_first_audio_file"];}	
	elseif (isset($_POST["survey_first_audio_file"]))	{$survey_first_audio_file=$_POST["survey_first_audio_file"];}
if (isset($_GET["survey_dtmf_digits"]))					{$survey_dtmf_digits=$_GET["survey_dtmf_digits"];}	
	elseif (isset($_POST["survey_dtmf_digits"]))		{$survey_dtmf_digits=$_POST["survey_dtmf_digits"];}
if (isset($_GET["survey_ni_digit"]))					{$survey_ni_digit=$_GET["survey_ni_digit"];}	
	elseif (isset($_POST["survey_ni_digit"]))			{$survey_ni_digit=$_POST["survey_ni_digit"];}
if (isset($_GET["survey_opt_in_audio_file"]))			{$survey_opt_in_audio_file=$_GET["survey_opt_in_audio_file"];}	
	elseif (isset($_POST["survey_opt_in_audio_file"]))	{$survey_opt_in_audio_file=$_POST["survey_opt_in_audio_file"];}
if (isset($_GET["survey_ni_audio_file"]))				{$survey_ni_audio_file=$_GET["survey_ni_audio_file"];}	
	elseif (isset($_POST["survey_ni_audio_file"]))		{$survey_ni_audio_file=$_POST["survey_ni_audio_file"];}
if (isset($_GET["survey_method"]))						{$survey_method=$_GET["survey_method"];}	
	elseif (isset($_POST["survey_method"]))				{$survey_method=$_POST["survey_method"];}
if (isset($_GET["survey_no_response_action"]))			{$survey_no_response_action=$_GET["survey_no_response_action"];}	
	elseif (isset($_POST["survey_no_response_action"]))	{$survey_no_response_action=$_POST["survey_no_response_action"];}
if (isset($_GET["survey_ni_status"]))					{$survey_ni_status=$_GET["survey_ni_status"];}	
	elseif (isset($_POST["survey_ni_status"]))			{$survey_ni_status=$_POST["survey_ni_status"];}
if (isset($_GET["survey_response_digit_map"]))			{$survey_response_digit_map=$_GET["survey_response_digit_map"];}	
	elseif (isset($_POST["survey_response_digit_map"]))	{$survey_response_digit_map=$_POST["survey_response_digit_map"];}
if (isset($_GET["survey_xfer_exten"]))					{$survey_xfer_exten=$_GET["survey_xfer_exten"];}	
	elseif (isset($_POST["survey_xfer_exten"]))			{$survey_xfer_exten=$_POST["survey_xfer_exten"];}
if (isset($_GET["survey_camp_record_dir"]))				{$survey_camp_record_dir=$_GET["survey_camp_record_dir"];}	
	elseif (isset($_POST["survey_camp_record_dir"]))	{$survey_camp_record_dir=$_POST["survey_camp_record_dir"];}
if (isset($_GET["add_timeclock_log"]))				{$add_timeclock_log=$_GET["add_timeclock_log"];}	
	elseif (isset($_POST["add_timeclock_log"]))		{$add_timeclock_log=$_POST["add_timeclock_log"];}
if (isset($_GET["modify_timeclock_log"]))			{$modify_timeclock_log=$_GET["modify_timeclock_log"];}	
	elseif (isset($_POST["modify_timeclock_log"]))	{$modify_timeclock_log=$_POST["modify_timeclock_log"];}
if (isset($_GET["delete_timeclock_log"]))			{$delete_timeclock_log=$_GET["delete_timeclock_log"];}	
	elseif (isset($_POST["delete_timeclock_log"]))	{$delete_timeclock_log=$_POST["delete_timeclock_log"];}
if (isset($_GET["phone_numbers"]))					{$phone_numbers=$_GET["phone_numbers"];}	
	elseif (isset($_POST["phone_numbers"]))			{$phone_numbers=$_POST["phone_numbers"];}
if (isset($_GET["vdc_header_date_format"]))					{$vdc_header_date_format=$_GET["vdc_header_date_format"];}	
	elseif (isset($_POST["vdc_header_date_format"]))		{$vdc_header_date_format=$_POST["vdc_header_date_format"];}
if (isset($_GET["vdc_customer_date_format"]))				{$vdc_customer_date_format=$_GET["vdc_customer_date_format"];}	
	elseif (isset($_POST["vdc_customer_date_format"]))		{$vdc_customer_date_format=$_POST["vdc_customer_date_format"];}
if (isset($_GET["vdc_header_phone_format"]))				{$vdc_header_phone_format=$_GET["vdc_header_phone_format"];}	
	elseif (isset($_POST["vdc_header_phone_format"]))		{$vdc_header_phone_format=$_POST["vdc_header_phone_format"];}
if (isset($_GET["disable_alter_custphone"]))			{$disable_alter_custphone=$_GET["disable_alter_custphone"];}	
	elseif (isset($_POST["disable_alter_custphone"]))	{$disable_alter_custphone=$_POST["disable_alter_custphone"];}
if (isset($_GET["alter_custphone_override"]))			{$alter_custphone_override=$_GET["alter_custphone_override"];}	
	elseif (isset($_POST["alter_custphone_override"]))	{$alter_custphone_override=$_POST["alter_custphone_override"];}
if (isset($_GET["vdc_agent_api_access"]))				{$vdc_agent_api_access=$_GET["vdc_agent_api_access"];}	
	elseif (isset($_POST["vdc_agent_api_access"]))		{$vdc_agent_api_access=$_POST["vdc_agent_api_access"];}
if (isset($_GET["vdc_agent_api_active"]))				{$vdc_agent_api_active=$_GET["vdc_agent_api_active"];}	
	elseif (isset($_POST["vdc_agent_api_active"]))		{$vdc_agent_api_active=$_POST["vdc_agent_api_active"];}
if (isset($_GET["display_queue_count"]))				{$display_queue_count=$_GET["display_queue_count"];}	
	elseif (isset($_POST["display_queue_count"]))		{$display_queue_count=$_POST["display_queue_count"];}
if (isset($_GET["sale_category"]))				{$sale_category=$_GET["sale_category"];}	
	elseif (isset($_POST["sale_category"]))		{$sale_category=$_POST["sale_category"];}
if (isset($_GET["dead_lead_category"]))				{$dead_lead_category=$_GET["dead_lead_category"];}	
	elseif (isset($_POST["dead_lead_category"]))	{$dead_lead_category=$_POST["dead_lead_category"];}
if (isset($_GET["manual_dial_filter"]))				{$manual_dial_filter=$_GET["manual_dial_filter"];}	
	elseif (isset($_POST["manual_dial_filter"]))	{$manual_dial_filter=$_POST["manual_dial_filter"];}
if (isset($_GET["agent_clipboard_copy"]))			{$agent_clipboard_copy=$_GET["agent_clipboard_copy"];}	
	elseif (isset($_POST["agent_clipboard_copy"]))	{$agent_clipboard_copy=$_POST["agent_clipboard_copy"];}
if (isset($_GET["agent_extended_alt_dial"]))			{$agent_extended_alt_dial=$_GET["agent_extended_alt_dial"];}	
	elseif (isset($_POST["agent_extended_alt_dial"]))	{$agent_extended_alt_dial=$_POST["agent_extended_alt_dial"];}
if (isset($_GET["play_place_in_line"]))				{$play_place_in_line=$_GET["play_place_in_line"];}	
	elseif (isset($_POST["play_place_in_line"]))	{$play_place_in_line=$_POST["play_place_in_line"];}
if (isset($_GET["play_language"]))				{$play_language=$_GET["play_language"];}	
	elseif (isset($_POST["play_language"]))	{$play_language=$_POST["play_language"];}
if (isset($_GET["play_estimate_hold_time"]))			{$play_estimate_hold_time=$_GET["play_estimate_hold_time"];}	
	elseif (isset($_POST["play_estimate_hold_time"]))	{$play_estimate_hold_time=$_POST["play_estimate_hold_time"];}
if (isset($_GET["hold_time_option"]))				{$hold_time_option=$_GET["hold_time_option"];}	
	elseif (isset($_POST["hold_time_option"]))		{$hold_time_option=$_POST["hold_time_option"];}
if (isset($_GET["hold_time_option_seconds"]))			{$hold_time_option_seconds=$_GET["hold_time_option_seconds"];}	
	elseif (isset($_POST["hold_time_option_seconds"]))	{$hold_time_option_seconds=$_POST["hold_time_option_seconds"];}
if (isset($_GET["hold_time_option_exten"]))				{$hold_time_option_exten=$_GET["hold_time_option_exten"];}	
	elseif (isset($_POST["hold_time_option_exten"]))	{$hold_time_option_exten=$_POST["hold_time_option_exten"];}
if (isset($_GET["hold_time_option_voicemail"]))				{$hold_time_option_voicemail=$_GET["hold_time_option_voicemail"];}	
	elseif (isset($_POST["hold_time_option_voicemail"]))	{$hold_time_option_voicemail=$_POST["hold_time_option_voicemail"];}
if (isset($_GET["hold_time_option_xfer_group"]))			{$hold_time_option_xfer_group=$_GET["hold_time_option_xfer_group"];}	
	elseif (isset($_POST["hold_time_option_xfer_group"]))	{$hold_time_option_xfer_group=$_POST["hold_time_option_xfer_group"];}
if (isset($_GET["hold_time_option_callback_filename"]))				{$hold_time_option_callback_filename=$_GET["hold_time_option_callback_filename"];}	
	elseif (isset($_POST["hold_time_option_callback_filename"]))	{$hold_time_option_callback_filename=$_POST["hold_time_option_callback_filename"];}
if (isset($_GET["hold_time_option_callback_list_id"]))				{$hold_time_option_callback_list_id=$_GET["hold_time_option_callback_list_id"];}	
	elseif (isset($_POST["hold_time_option_callback_list_id"]))		{$hold_time_option_callback_list_id=$_POST["hold_time_option_callback_list_id"];}
if (isset($_GET["hold_recall_xfer_group"]))				{$hold_recall_xfer_group=$_GET["hold_recall_xfer_group"];}	
	elseif (isset($_POST["hold_recall_xfer_group"]))	{$hold_recall_xfer_group=$_POST["hold_recall_xfer_group"];}
if (isset($_GET["no_delay_call_route"]))			{$no_delay_call_route=$_GET["no_delay_call_route"];}	
	elseif (isset($_POST["no_delay_call_route"]))	{$no_delay_call_route=$_POST["no_delay_call_route"];}
if (isset($_GET["play_welcome_message"]))			{$play_welcome_message=$_GET["play_welcome_message"];}	
	elseif (isset($_POST["play_welcome_message"]))	{$play_welcome_message=$_POST["play_welcome_message"];}
if (isset($_GET["did_id"]))					{$did_id=$_GET["did_id"];}	
	elseif (isset($_POST["did_id"]))		{$did_id=$_POST["did_id"];}
if (isset($_GET["source_did"]))				{$source_did=$_GET["source_did"];}	
	elseif (isset($_POST["source_did"]))	{$source_did=$_POST["source_did"];}
if (isset($_GET["did_pattern"]))			{$did_pattern=$_GET["did_pattern"];}	
	elseif (isset($_POST["did_pattern"]))	{$did_pattern=$_POST["did_pattern"];}
if (isset($_GET["did_description"]))			{$did_description=$_GET["did_description"];}	
	elseif (isset($_POST["did_description"]))	{$did_description=$_POST["did_description"];}
if (isset($_GET["did_active"]))				{$did_active=$_GET["did_active"];}	
	elseif (isset($_POST["did_active"]))	{$did_active=$_POST["did_active"];}
if (isset($_GET["did_route"]))				{$did_route=$_GET["did_route"];}	
	elseif (isset($_POST["did_route"]))		{$did_route=$_POST["did_route"];}
if (isset($_GET["exten_context"]))			{$exten_context=$_GET["exten_context"];}	
	elseif (isset($_POST["exten_context"]))	{$exten_context=$_POST["exten_context"];}
if (isset($_GET["phone"]))					{$phone=$_GET["phone"];}	
	elseif (isset($_POST["phone"]))			{$phone=$_POST["phone"];}
if (isset($_GET["user_unavailable_action"]))			{$user_unavailable_action=$_GET["user_unavailable_action"];}	
	elseif (isset($_POST["user_unavailable_action"]))	{$user_unavailable_action=$_POST["user_unavailable_action"];}
if (isset($_GET["user_route_settings_ingroup"]))			{$user_route_settings_ingroup=$_GET["user_route_settings_ingroup"];}	
	elseif (isset($_POST["user_route_settings_ingroup"]))	{$user_route_settings_ingroup=$_POST["user_route_settings_ingroup"];}
if (isset($_GET["call_handle_method"]))				{$call_handle_method=$_GET["call_handle_method"];}	
	elseif (isset($_POST["call_handle_method"]))	{$call_handle_method=$_POST["call_handle_method"];}
if (isset($_GET["agent_search_method"]))			{$agent_search_method=$_GET["agent_search_method"];}	
	elseif (isset($_POST["agent_search_method"]))	{$agent_search_method=$_POST["agent_search_method"];}
if (isset($_GET["phone_code"]))				{$phone_code=$_GET["phone_code"];}	
	elseif (isset($_POST["phone_code"]))	{$phone_code=$_POST["phone_code"];}
if (isset($_GET["email"]))					{$email=$_GET["email"];}	
	elseif (isset($_POST["email"]))			{$email=$_POST["email"];}
if (isset($_GET["modify_inbound_dids"]))			{$modify_inbound_dids=$_GET["modify_inbound_dids"];}	
	elseif (isset($_POST["modify_inbound_dids"]))	{$modify_inbound_dids=$_POST["modify_inbound_dids"];}
if (isset($_GET["delete_inbound_dids"]))			{$delete_inbound_dids=$_GET["delete_inbound_dids"];}	
	elseif (isset($_POST["delete_inbound_dids"]))	{$delete_inbound_dids=$_POST["delete_inbound_dids"];}
if (isset($_GET["three_way_call_cid"]))				{$three_way_call_cid=$_GET["three_way_call_cid"];}	
	elseif (isset($_POST["three_way_call_cid"]))	{$three_way_call_cid=$_POST["three_way_call_cid"];}
if (isset($_GET["three_way_dial_prefix"]))			{$three_way_dial_prefix=$_GET["three_way_dial_prefix"];}
	elseif (isset($_POST["three_way_dial_prefix"]))	{$three_way_dial_prefix=$_POST["three_way_dial_prefix"];}
if (isset($_GET["forced_timeclock_login"]))				{$forced_timeclock_login=$_GET["forced_timeclock_login"];}
	elseif (isset($_POST["forced_timeclock_login"]))	{$forced_timeclock_login=$_POST["forced_timeclock_login"];}
if (isset($_GET["answer_sec_pct_rt_stat_zero"]))			{$answer_sec_pct_rt_stat_zero=$_GET["answer_sec_pct_rt_stat_zero"];}
	elseif (isset($_POST["answer_sec_pct_rt_stat_zero"]))	{$answer_sec_pct_rt_stat_zero=$_POST["answer_sec_pct_rt_stat_zero"];}
if (isset($_GET["answer_sec_pct_rt_stat_one"]))				{$answer_sec_pct_rt_stat_one=$_GET["answer_sec_pct_rt_stat_one"];}
	elseif (isset($_POST["answer_sec_pct_rt_stat_one"]))	{$answer_sec_pct_rt_stat_one=$_POST["answer_sec_pct_rt_stat_one"];}
if (isset($_GET["answer_sec_pct_rt_stat_two"]))				{$answer_sec_pct_rt_stat_two=$_GET["answer_sec_pct_rt_stat_two"];}
	elseif (isset($_POST["answer_sec_pct_rt_stat_two"]))	{$answer_sec_pct_rt_stat_two=$_POST["answer_sec_pct_rt_stat_two"];}
if (isset($_GET["list_active_change"]))				{$list_active_change=$_GET["list_active_change"];}
	elseif (isset($_POST["list_active_change"]))	{$list_active_change=$_POST["list_active_change"];}
if (isset($_GET["web_form_target"]))			{$web_form_target=$_GET["web_form_target"];}
	elseif (isset($_POST["web_form_target"]))	{$web_form_target=$_POST["web_form_target"];}
if (isset($_GET["alt_server_ip"]))				{$alt_server_ip=$_GET["alt_server_ip"];}
	elseif (isset($_POST["alt_server_ip"]))	{$alt_server_ip=$_POST["alt_server_ip"];}
if (isset($_GET["recording_web_link"]))				{$recording_web_link=$_GET["recording_web_link"];}
	elseif (isset($_POST["recording_web_link"]))	{$recording_web_link=$_POST["recording_web_link"];}
if (isset($_GET["enable_vtiger_integration"]))			{$enable_vtiger_integration=$_GET["enable_vtiger_integration"];}
	elseif (isset($_POST["enable_vtiger_integration"]))	{$enable_vtiger_integration=$_POST["enable_vtiger_integration"];}
if (isset($_GET["vtiger_server_ip"]))			{$vtiger_server_ip=$_GET["vtiger_server_ip"];}
	elseif (isset($_POST["vtiger_server_ip"]))	{$vtiger_server_ip=$_POST["vtiger_server_ip"];}
if (isset($_GET["vtiger_dbname"]))				{$vtiger_dbname=$_GET["vtiger_dbname"];}
	elseif (isset($_POST["vtiger_dbname"]))		{$vtiger_dbname=$_POST["vtiger_dbname"];}
if (isset($_GET["vtiger_login"]))			{$vtiger_login=$_GET["vtiger_login"];}
	elseif (isset($_POST["vtiger_login"]))	{$vtiger_login=$_POST["vtiger_login"];}
if (isset($_GET["vtiger_pass"]))			{$vtiger_pass=$_GET["vtiger_pass"];}
	elseif (isset($_POST["vtiger_pass"]))	{$vtiger_pass=$_POST["vtiger_pass"];}
if (isset($_GET["vtiger_url"]))				{$vtiger_url=$_GET["vtiger_url"];}
	elseif (isset($_POST["vtiger_url"]))	{$vtiger_url=$_POST["vtiger_url"];}
if (isset($_GET["vtiger_search_category"]))				{$vtiger_search_category=$_GET["vtiger_search_category"];}
	elseif (isset($_POST["vtiger_search_category"]))	{$vtiger_search_category=$_POST["vtiger_search_category"];}
if (isset($_GET["vtiger_create_call_record"]))			{$vtiger_create_call_record=$_GET["vtiger_create_call_record"];}
	elseif (isset($_POST["vtiger_create_call_record"]))	{$vtiger_create_call_record=$_POST["vtiger_create_call_record"];}
if (isset($_GET["vtiger_create_lead_record"]))			{$vtiger_create_lead_record=$_GET["vtiger_create_lead_record"];}
	elseif (isset($_POST["vtiger_create_lead_record"]))	{$vtiger_create_lead_record=$_POST["vtiger_create_lead_record"];}
if (isset($_GET["vtiger_screen_login"]))			{$vtiger_screen_login=$_GET["vtiger_screen_login"];}
	elseif (isset($_POST["vtiger_screen_login"]))	{$vtiger_screen_login=$_POST["vtiger_screen_login"];}
if (isset($_GET["qc_features_active"]))				{$qc_features_active=$_GET["qc_features_active"];}
	elseif (isset($_POST["qc_features_active"]))	{$qc_features_active=$_POST["qc_features_active"];}
if (isset($_GET["outbound_autodial_active"]))			{$outbound_autodial_active=$_GET["outbound_autodial_active"];}
	elseif (isset($_POST["outbound_autodial_active"]))	{$outbound_autodial_active=$_POST["outbound_autodial_active"];}
if (isset($_GET["cpd_amd_action"]))				{$cpd_amd_action=$_GET["cpd_amd_action"];}
	elseif (isset($_POST["cpd_amd_action"]))	{$cpd_amd_action=$_POST["cpd_amd_action"];}
if (isset($_GET["download_lists"]))				{$download_lists=$_GET["download_lists"];}
	elseif (isset($_POST["download_lists"]))	{$download_lists=$_POST["download_lists"];}
if (isset($_GET["active_asterisk_server"]))				{$active_asterisk_server=$_GET["active_asterisk_server"];}
	elseif (isset($_POST["active_asterisk_server"]))	{$active_asterisk_server=$_POST["active_asterisk_server"];}
if (isset($_GET["generate_vicidial_conf"]))				{$generate_vicidial_conf=$_GET["generate_vicidial_conf"];}
	elseif (isset($_POST["generate_vicidial_conf"]))	{$generate_vicidial_conf=$_POST["generate_vicidial_conf"];}
if (isset($_GET["rebuild_conf_files"]))				{$rebuild_conf_files=$_GET["rebuild_conf_files"];}
	elseif (isset($_POST["rebuild_conf_files"]))	{$rebuild_conf_files=$_POST["rebuild_conf_files"];}
if (isset($_GET["template_id"]))			{$template_id=$_GET["template_id"];}
	elseif (isset($_POST["template_id"]))	{$template_id=$_POST["template_id"];}
if (isset($_GET["conf_override"]))			{$conf_override=$_GET["conf_override"];}
	elseif (isset($_POST["conf_override"]))	{$conf_override=$_POST["conf_override"];}
if (isset($_GET["template_name"]))			{$template_name=$_GET["template_name"];}
	elseif (isset($_POST["template_name"]))	{$template_name=$_POST["template_name"];}
if (isset($_GET["template_contents"]))			{$template_contents=$_GET["template_contents"];}
	elseif (isset($_POST["template_contents"]))	{$template_contents=$_POST["template_contents"];}
if (isset($_GET["carrier_id"]))			{$carrier_id=$_GET["carrier_id"];}
	elseif (isset($_POST["carrier_id"]))	{$carrier_id=$_POST["carrier_id"];}
if (isset($_GET["carrier_name"]))			{$carrier_name=$_GET["carrier_name"];}
	elseif (isset($_POST["carrier_name"]))	{$carrier_name=$_POST["carrier_name"];}
if (isset($_GET["registration_string"]))			{$registration_string=$_GET["registration_string"];}
	elseif (isset($_POST["registration_string"]))	{$registration_string=$_POST["registration_string"];}
if (isset($_GET["account_entry"]))			{$account_entry=$_GET["account_entry"];}
	elseif (isset($_POST["account_entry"]))	{$account_entry=$_POST["account_entry"];}
if (isset($_GET["globals_string"]))				{$globals_string=$_GET["globals_string"];}
	elseif (isset($_POST["globals_string"]))	{$globals_string=$_POST["globals_string"];}
if (isset($_GET["dialplan_entry"]))				{$dialplan_entry=$_GET["dialplan_entry"];}
	elseif (isset($_POST["dialplan_entry"]))	{$dialplan_entry=$_POST["dialplan_entry"];}
if (isset($_GET["group_alias_id"]))				{$group_alias_id=$_GET["group_alias_id"];}
	elseif (isset($_POST["group_alias_id"]))	{$group_alias_id=$_POST["group_alias_id"];}
if (isset($_GET["group_alias_name"]))				{$group_alias_name=$_GET["group_alias_name"];}
	elseif (isset($_POST["group_alias_name"]))	{$group_alias_name=$_POST["group_alias_name"];}
if (isset($_GET["caller_id_number"]))				{$caller_id_number=$_GET["caller_id_number"];}
	elseif (isset($_POST["caller_id_number"]))	{$caller_id_number=$_POST["caller_id_number"];}
if (isset($_GET["caller_id_name"]))				{$caller_id_name=$_GET["caller_id_name"];}
	elseif (isset($_POST["caller_id_name"]))	{$caller_id_name=$_POST["caller_id_name"];}
if (isset($_GET["agent_allow_group_alias"]))			{$agent_allow_group_alias=$_GET["agent_allow_group_alias"];}
	elseif (isset($_POST["agent_allow_group_alias"]))	{$agent_allow_group_alias=$_POST["agent_allow_group_alias"];}
if (isset($_GET["default_group_alias"]))				{$default_group_alias=$_GET["default_group_alias"];}
	elseif (isset($_POST["default_group_alias"]))		{$default_group_alias=$_POST["default_group_alias"];}
if (isset($_GET["outbound_calls_per_second"]))				{$outbound_calls_per_second=$_GET["outbound_calls_per_second"];}
	elseif (isset($_POST["outbound_calls_per_second"]))		{$outbound_calls_per_second=$_POST["outbound_calls_per_second"];}
if (isset($_GET["shift_enforcement"]))				{$shift_enforcement=$_GET["shift_enforcement"];}
	elseif (isset($_POST["shift_enforcement"]))		{$shift_enforcement=$_POST["shift_enforcement"];}
if (isset($_GET["agent_shift_enforcement_override"]))			{$agent_shift_enforcement_override=$_GET["agent_shift_enforcement_override"];}
	elseif (isset($_POST["agent_shift_enforcement_override"]))	{$agent_shift_enforcement_override=$_POST["agent_shift_enforcement_override"];}
if (isset($_GET["manager_shift_enforcement_override"]))				{$manager_shift_enforcement_override=$_GET["manager_shift_enforcement_override"];}
	elseif (isset($_POST["manager_shift_enforcement_override"]))	{$manager_shift_enforcement_override=$_POST["manager_shift_enforcement_override"];}
if (isset($_GET["export_reports"]))				{$export_reports=$_GET["export_reports"];}
	elseif (isset($_POST["export_reports"]))	{$export_reports=$_POST["export_reports"];}
if (isset($_GET["view_historical_reports"]))				{$view_historical_reports=$_GET["view_historical_reports"];}
	elseif (isset($_POST["view_historical_reports"]))	{$view_historical_reports=$_POST["view_historical_reports"];}
if (isset($_GET["live_monitor"]))				{$live_monitor=$_GET["live_monitor"];}
	elseif (isset($_POST["live_monitor"]))	{$live_monitor=$_POST["live_monitor"];}
if (isset($_GET["search_voice_mail"]))				{$search_voice_mail=$_GET["search_voice_mail"];}
	elseif (isset($_POST["search_voice_mail"]))	{$search_voice_mail=$_POST["search_voice_mail"];}
if (isset($_GET["search_historical_call"]))				{$search_historical_call=$_GET["search_historical_call"];}
	elseif (isset($_POST["search_historical_call"]))	{$search_historical_call=$_POST["search_historical_call"];}
if (isset($_GET["delete_from_dnc"]))			{$delete_from_dnc=$_GET["delete_from_dnc"];}
	elseif (isset($_POST["delete_from_dnc"]))	{$delete_from_dnc=$_POST["delete_from_dnc"];}
if (isset($_GET["vtiger_search_dead"]))				{$vtiger_search_dead=$_GET["vtiger_search_dead"];}
	elseif (isset($_POST["vtiger_search_dead"]))	{$vtiger_search_dead=$_POST["vtiger_search_dead"];}
if (isset($_GET["vtiger_status_call"]))				{$vtiger_status_call=$_GET["vtiger_status_call"];}
	elseif (isset($_POST["vtiger_status_call"]))	{$vtiger_status_call=$_POST["vtiger_status_call"];}
if (isset($_GET["sale"]))				{$sale=$_GET["sale"];}
	elseif (isset($_POST["sale"]))		{$sale=$_POST["sale"];}
if (isset($_GET["dnc"]))				{$dnc=$_GET["dnc"];}
	elseif (isset($_POST["dnc"]))		{$dnc=$_POST["dnc"];}
if (isset($_GET["customer_contact"]))			{$customer_contact=$_GET["customer_contact"];}
	elseif (isset($_POST["customer_contact"]))	{$customer_contact=$_POST["customer_contact"];}
if (isset($_GET["not_interested"]))				{$not_interested=$_GET["not_interested"];}
	elseif (isset($_POST["not_interested"]))	{$not_interested=$_POST["not_interested"];}
if (isset($_GET["unworkable"]))					{$unworkable=$_GET["unworkable"];}
	elseif (isset($_POST["unworkable"]))		{$unworkable=$_POST["unworkable"];}
if (isset($_GET["user_code"]))					{$user_code=$_GET["user_code"];}
	elseif (isset($_POST["user_code"]))			{$user_code=$_POST["user_code"];}
if (isset($_GET["territory"]))					{$territory=$_GET["territory"];}
	elseif (isset($_POST["territory"]))			{$territory=$_POST["territory"];}
if (isset($_GET["survey_third_digit"]))				{$survey_third_digit=$_GET["survey_third_digit"];}
	elseif (isset($_POST["survey_third_digit"]))	{$survey_third_digit=$_POST["survey_third_digit"];}
if (isset($_GET["survey_fourth_digit"]))			{$survey_fourth_digit=$_GET["survey_fourth_digit"];}
	elseif (isset($_POST["survey_fourth_digit"]))	{$survey_fourth_digit=$_POST["survey_fourth_digit"];}
if (isset($_GET["survey_third_audio_file"]))			{$survey_third_audio_file=$_GET["survey_third_audio_file"];}
	elseif (isset($_POST["survey_third_audio_file"]))	{$survey_third_audio_file=$_POST["survey_third_audio_file"];}
if (isset($_GET["survey_fourth_audio_file"]))			{$survey_fourth_audio_file=$_GET["survey_fourth_audio_file"];}
	elseif (isset($_POST["survey_fourth_audio_file"]))	{$survey_fourth_audio_file=$_POST["survey_fourth_audio_file"];}
if (isset($_GET["survey_third_status"]))				{$survey_third_status=$_GET["survey_third_status"];}
	elseif (isset($_POST["survey_third_status"]))		{$survey_third_status=$_POST["survey_third_status"];}
if (isset($_GET["survey_fourth_status"]))				{$survey_fourth_status=$_GET["survey_fourth_status"];}
	elseif (isset($_POST["survey_fourth_status"]))		{$survey_fourth_status=$_POST["survey_fourth_status"];}
if (isset($_GET["survey_third_exten"]))					{$survey_third_exten=$_GET["survey_third_exten"];}
	elseif (isset($_POST["survey_third_exten"]))		{$survey_third_exten=$_POST["survey_third_exten"];}
if (isset($_GET["survey_fourth_exten"]))				{$survey_fourth_exten=$_GET["survey_fourth_exten"];}
	elseif (isset($_POST["survey_fourth_exten"]))		{$survey_fourth_exten=$_POST["survey_fourth_exten"];}
if($did_route == 'CALLMENU'){
    if (isset($_GET["menu_id"])) {$menu_id=$_GET["menu_id"];}
    elseif (isset($_POST["menu_id"])) {$menu_id=$_POST["menu_id"];}
}elseif($did_route == 'Intelligent_Route'){
    if (isset($_GET["menu_id"])) {$menu_id=$_GET["menu_id"];}
    elseif (isset($_POST["ir_menu_id"])) {$menu_id=$_POST["ir_menu_id"];}
}else{
    if (isset($_GET["menu_id"])) {$menu_id=$_GET["menu_id"];}
    elseif (isset($_POST["menu_id"])) {$menu_id=$_POST["menu_id"];}
}
if (isset($_GET["menu_name"]))				{$menu_name=$_GET["menu_name"];}
	elseif (isset($_POST["menu_name"]))		{$menu_name=$_POST["menu_name"];}
if (isset($_GET["menu_prompt"]))			{$menu_prompt=$_GET["menu_prompt"];}
	elseif (isset($_POST["menu_prompt"]))	{$menu_prompt=$_POST["menu_prompt"];}
if (isset($_GET["menu_timeout"]))			{$menu_timeout=$_GET["menu_timeout"];}
	elseif (isset($_POST["menu_timeout"]))	{$menu_timeout=$_POST["menu_timeout"];}
if (isset($_GET["menu_timeout_prompt"]))			{$menu_timeout_prompt=$_GET["menu_timeout_prompt"];}
	elseif (isset($_POST["menu_timeout_prompt"]))	{$menu_timeout_prompt=$_POST["menu_timeout_prompt"];}
if (isset($_GET["menu_invalid_prompt"]))			{$menu_invalid_prompt=$_GET["menu_invalid_prompt"];}
	elseif (isset($_POST["menu_invalid_prompt"]))	{$menu_invalid_prompt=$_POST["menu_invalid_prompt"];}
if (isset($_GET["menu_repeat"]))				{$menu_repeat=$_GET["menu_repeat"];}
	elseif (isset($_POST["menu_repeat"]))		{$menu_repeat=$_POST["menu_repeat"];}
if (isset($_GET["menu_time_check"]))			{$menu_time_check=$_GET["menu_time_check"];}
	elseif (isset($_POST["menu_time_check"]))	{$menu_time_check=$_POST["menu_time_check"];}
if (isset($_GET["track_in_vdac"]))				{$track_in_vdac=$_GET["track_in_vdac"];}
	elseif (isset($_POST["track_in_vdac"]))		{$track_in_vdac=$_POST["track_in_vdac"];}
if (isset($_GET["source_menu"]))			{$source_menu=$_GET["source_menu"];}
	elseif (isset($_POST["source_menu"]))	{$source_menu=$_POST["source_menu"];}
if (isset($_GET["agentonly_callback_campaign_lock"]))			{$agentonly_callback_campaign_lock=$_GET["agentonly_callback_campaign_lock"];}
	elseif (isset($_POST["agentonly_callback_campaign_lock"]))	{$agentonly_callback_campaign_lock=$_POST["agentonly_callback_campaign_lock"];}
if (isset($_GET["sounds_central_control_active"]))			{$sounds_central_control_active=$_GET["sounds_central_control_active"];}
	elseif (isset($_POST["sounds_central_control_active"]))	{$sounds_central_control_active=$_POST["sounds_central_control_active"];}
if (isset($_GET["sounds_web_server"]))				{$sounds_web_server=$_GET["sounds_web_server"];}
	elseif (isset($_POST["sounds_web_server"]))		{$sounds_web_server=$_POST["sounds_web_server"];}
if (isset($_GET["sounds_web_directory"]))			{$sounds_web_directory=$_GET["sounds_web_directory"];}
	elseif (isset($_POST["sounds_web_directory"]))	{$sounds_web_directory=$_POST["sounds_web_directory"];}
if (isset($_GET["sounds_update"]))			{$sounds_update=$_GET["sounds_update"];}
	elseif (isset($_POST["sounds_update"]))	{$sounds_update=$_POST["sounds_update"];}
if (isset($_GET["active_voicemail_server"]))			{$active_voicemail_server=$_GET["active_voicemail_server"];}
	elseif (isset($_POST["active_voicemail_server"]))	{$active_voicemail_server=$_POST["active_voicemail_server"];}
if (isset($_GET["auto_dial_limit"]))			{$auto_dial_limit=$_GET["auto_dial_limit"];}
	elseif (isset($_POST["auto_dial_limit"]))	{$auto_dial_limit=$_POST["auto_dial_limit"];}
if (isset($_GET["user_territories_active"]))			{$user_territories_active=$_GET["user_territories_active"];}
	elseif (isset($_POST["user_territories_active"]))	{$user_territories_active=$_POST["user_territories_active"];}
if (isset($_GET["vicidial_recording_limit"]))			{$vicidial_recording_limit=$_GET["vicidial_recording_limit"];}
	elseif (isset($_POST["vicidial_recording_limit"]))	{$vicidial_recording_limit=$_POST["vicidial_recording_limit"];}
if (isset($_GET["phone_context"]))				{$phone_context=$_GET["phone_context"];}
	elseif (isset($_POST["phone_context"]))		{$phone_context=$_POST["phone_context"];}
if (isset($_GET["carrier_logging_active"]))				{$carrier_logging_active=$_GET["carrier_logging_active"];}
	elseif (isset($_POST["carrier_logging_active"]))	{$carrier_logging_active=$_POST["carrier_logging_active"];}
if (isset($_GET["drop_lockout_time"]))				{$drop_lockout_time=$_GET["drop_lockout_time"];}
	elseif (isset($_POST["drop_lockout_time"]))		{$drop_lockout_time=$_POST["drop_lockout_time"];}
if (isset($_GET["allow_custom_dialplan"]))				{$allow_custom_dialplan=$_GET["allow_custom_dialplan"];}
	elseif (isset($_POST["allow_custom_dialplan"]))		{$allow_custom_dialplan=$_POST["allow_custom_dialplan"];}
if (isset($_GET["custom_dialplan_entry"]))				{$custom_dialplan_entry=$_GET["custom_dialplan_entry"];}
	elseif (isset($_POST["custom_dialplan_entry"]))		{$custom_dialplan_entry=$_POST["custom_dialplan_entry"];}
if (isset($_GET["phone_ring_timeout"]))					{$phone_ring_timeout=$_GET["phone_ring_timeout"];}
	elseif (isset($_POST["phone_ring_timeout"]))		{$phone_ring_timeout=$_POST["phone_ring_timeout"];}
if (isset($_GET["conf_secret"]))					{$conf_secret=$_GET["conf_secret"];}
	elseif (isset($_POST["conf_secret"]))			{$conf_secret=$_POST["conf_secret"];}
if (isset($_GET["tracking_group"]))					{$tracking_group=$_GET["tracking_group"];}
	elseif (isset($_POST["tracking_group"]))		{$tracking_group=$_POST["tracking_group"];}
if (isset($_GET["no_agent_no_queue"]))				{$no_agent_no_queue=$_GET["no_agent_no_queue"];}
	elseif (isset($_POST["no_agent_no_queue"]))		{$no_agent_no_queue=$_POST["no_agent_no_queue"];}
if (isset($_GET["no_agent_action"]))				{$no_agent_action=$_GET["no_agent_action"];}
	elseif (isset($_POST["no_agent_action"]))		{$no_agent_action=$_POST["no_agent_action"];}
if (isset($_GET["no_agent_action_value"]))			{$no_agent_action_value=$_GET["no_agent_action_value"];}
	elseif (isset($_POST["no_agent_action_value"]))	{$no_agent_action_value=$_POST["no_agent_action_value"];}
if (isset($_GET["quick_transfer_button"]))			{$quick_transfer_button=$_GET["quick_transfer_button"];}
	elseif (isset($_POST["quick_transfer_button"]))	{$quick_transfer_button=$_POST["quick_transfer_button"];}
if (isset($_GET["prepopulate_transfer_preset"]))			{$prepopulate_transfer_preset=$_GET["prepopulate_transfer_preset"];}
	elseif (isset($_POST["prepopulate_transfer_preset"]))	{$prepopulate_transfer_preset=$_POST["prepopulate_transfer_preset"];}
if (isset($_GET["enable_tts_integration"]))				{$enable_tts_integration=$_GET["enable_tts_integration"];}
	elseif (isset($_POST["enable_tts_integration"]))	{$enable_tts_integration=$_POST["enable_tts_integration"];}
if (isset($_GET["tts_id"]))							{$tts_id=$_GET["tts_id"];}
	elseif (isset($_POST["tts_id"]))				{$tts_id=$_POST["tts_id"];}
if (isset($_GET["tts_name"]))						{$tts_name=$_GET["tts_name"];}
	elseif (isset($_POST["tts_name"]))				{$tts_name=$_POST["tts_name"];}
if (isset($_GET["tts_text"]))						{$tts_text=$_GET["tts_text"];}
	elseif (isset($_POST["tts_text"]))				{$tts_text=$_POST["tts_text"];}
if (isset($_GET["drop_rate_group"]))				{$drop_rate_group=$_GET["drop_rate_group"];}
	elseif (isset($_POST["drop_rate_group"]))		{$drop_rate_group=$_POST["drop_rate_group"];}
if (isset($_GET["agent_status_viewable_groups"]))			{$agent_status_viewable_groups=$_GET["agent_status_viewable_groups"];}
	elseif (isset($_POST["agent_status_viewable_groups"]))	{$agent_status_viewable_groups=$_POST["agent_status_viewable_groups"];}
if (isset($_GET["agent_status_view_time"]))				{$agent_status_view_time=$_GET["agent_status_view_time"];}
	elseif (isset($_POST["agent_status_view_time"]))	{$agent_status_view_time=$_POST["agent_status_view_time"];}
if (isset($_GET["view_calls_in_queue"]))			{$view_calls_in_queue=$_GET["view_calls_in_queue"];}
	elseif (isset($_POST["view_calls_in_queue"]))	{$view_calls_in_queue=$_POST["view_calls_in_queue"];}
if (isset($_GET["view_calls_in_queue_launch"]))				{$view_calls_in_queue_launch=$_GET["view_calls_in_queue_launch"];}
	elseif (isset($_POST["view_calls_in_queue_launch"]))	{$view_calls_in_queue_launch=$_POST["view_calls_in_queue_launch"];}
if (isset($_GET["grab_calls_in_queue"]))			{$grab_calls_in_queue=$_GET["grab_calls_in_queue"];}
	elseif (isset($_POST["grab_calls_in_queue"]))	{$grab_calls_in_queue=$_POST["grab_calls_in_queue"];}
if (isset($_GET["view_agent_status"]))			{$view_agent_status=$_GET["view_agent_status"];}
	elseif (isset($_POST["view_agent_status"]))	{$view_agent_status=$_POST["view_agent_status"];}
if (isset($_GET["call_requeue_button"]))			{$call_requeue_button=$_GET["call_requeue_button"];}
	elseif (isset($_POST["call_requeue_button"]))	{$call_requeue_button=$_POST["call_requeue_button"];}
if (isset($_GET["pause_after_each_call"]))			{$pause_after_each_call=$_GET["pause_after_each_call"];}
	elseif (isset($_POST["pause_after_each_call"]))	{$pause_after_each_call=$_POST["pause_after_each_call"];}
if (isset($_GET["no_hopper_dialing"]))				{$no_hopper_dialing=$_GET["no_hopper_dialing"];}
	elseif (isset($_POST["no_hopper_dialing"]))		{$no_hopper_dialing=$_POST["no_hopper_dialing"];}
if (isset($_GET["agent_dial_owner_only"]))			{$agent_dial_owner_only=$_GET["agent_dial_owner_only"];}
	elseif (isset($_POST["agent_dial_owner_only"]))	{$agent_dial_owner_only=$_POST["agent_dial_owner_only"];}
if (isset($_GET["reset_time"]))						{$reset_time=$_GET["reset_time"];}
	elseif (isset($_POST["reset_time"]))			{$reset_time=$_POST["reset_time"];}
if (isset($_GET["allow_alerts"]))					{$allow_alerts=$_GET["allow_alerts"];}
	elseif (isset($_POST["allow_alerts"]))			{$allow_alerts=$_POST["allow_alerts"];}
if (isset($_GET["agent_display_dialable_leads"]))			{$agent_display_dialable_leads=$_GET["agent_display_dialable_leads"];}
	elseif (isset($_POST["agent_display_dialable_leads"]))	{$agent_display_dialable_leads=$_POST["agent_display_dialable_leads"];}
if (isset($_GET["vicidial_balance_rank"]))			{$vicidial_balance_rank=$_GET["vicidial_balance_rank"];}
	elseif (isset($_POST["vicidial_balance_rank"]))	{$vicidial_balance_rank=$_POST["vicidial_balance_rank"];}
if (isset($_GET["agent_script_override"]))			{$agent_script_override=$_GET["agent_script_override"];}
	elseif (isset($_POST["agent_script_override"]))	{$agent_script_override=$_POST["agent_script_override"];}
if (isset($_GET["moh_id"]))				{$moh_id=$_GET["moh_id"];}
	elseif (isset($_POST["moh_id"]))	{$moh_id=$_POST["moh_id"];}
if (isset($_GET["moh_name"]))			{$moh_name=$_GET["moh_name"];}
	elseif (isset($_POST["moh_name"]))	{$moh_name=$_POST["moh_name"];}
if (isset($_GET["random"]))				{$random=$_GET["random"];}
	elseif (isset($_POST["random"]))	{$random=$_POST["random"];}
if (isset($_GET["filename"]))			{$filename=$_GET["filename"];}
	elseif (isset($_POST["filename"]))	{$filename=$_POST["filename"];}
if (isset($_GET["rank"]))				{$rank=$_GET["rank"];}
	elseif (isset($_POST["rank"]))		{$rank=$_POST["rank"];}
if (isset($_GET["rebuild_music_on_hold"]))				{$rebuild_music_on_hold=$_GET["rebuild_music_on_hold"];}
	elseif (isset($_POST["rebuild_music_on_hold"]))		{$rebuild_music_on_hold=$_POST["rebuild_music_on_hold"];}
if (isset($_GET["active_agent_login_server"]))			{$active_agent_login_server=$_GET["active_agent_login_server"];}
	elseif (isset($_POST["active_agent_login_server"]))	{$active_agent_login_server=$_POST["active_agent_login_server"];}
if (isset($_GET["enable_second_webform"]))			{$enable_second_webform=$_GET["enable_second_webform"];}
	elseif (isset($_POST["enable_second_webform"]))	{$enable_second_webform=$_POST["enable_second_webform"];}
if (isset($_GET["web_form_address_two"]))			{$web_form_address_two=$_GET["web_form_address_two"];}
	elseif (isset($_POST["web_form_address_two"]))	{$web_form_address_two=$_POST["web_form_address_two"];}
if (isset($_GET["waitforsilence_options"]))			{$waitforsilence_options=$_GET["waitforsilence_options"];}
	elseif (isset($_POST["waitforsilence_options"]))	{$waitforsilence_options=$_POST["waitforsilence_options"];}
if (isset($_GET["campaign_cid_override"]))			{$campaign_cid_override=$_GET["campaign_cid_override"];}
	elseif (isset($_POST["campaign_cid_override"]))	{$campaign_cid_override=$_POST["campaign_cid_override"];}
if (isset($_GET["am_message_exten_override"]))			{$am_message_exten_override=$_GET["am_message_exten_override"];}
	elseif (isset($_POST["am_message_exten_override"]))	{$am_message_exten_override=$_POST["am_message_exten_override"];}
if (isset($_GET["drop_inbound_group_override"]))			{$drop_inbound_group_override=$_GET["drop_inbound_group_override"];}
	elseif (isset($_POST["drop_inbound_group_override"]))	{$drop_inbound_group_override=$_POST["drop_inbound_group_override"];}
if (isset($_GET["agent_select_territories"]))			{$agent_select_territories=$_GET["agent_select_territories"];}
	elseif (isset($_POST["agent_select_territories"]))	{$agent_select_territories=$_POST["agent_select_territories"];}
if (isset($_GET["agent_choose_territories"]))			{$agent_choose_territories=$_GET["agent_choose_territories"];}
	elseif (isset($_POST["agent_choose_territories"]))	{$agent_choose_territories=$_POST["agent_choose_territories"];}
if (isset($_GET["carrier_description"]))			{$carrier_description=$_GET["carrier_description"];}
	elseif (isset($_POST["carrier_description"]))	{$carrier_description=$_POST["carrier_description"];}
if (isset($_GET["delete_vm_after_email"]))			{$delete_vm_after_email=$_GET["delete_vm_after_email"];}
	elseif (isset($_POST["delete_vm_after_email"]))	{$delete_vm_after_email=$_POST["delete_vm_after_email"];}
if (isset($_GET["custom_one"]))					{$custom_one=$_GET["custom_one"];}
	elseif (isset($_POST["custom_one"]))		{$custom_one=$_POST["custom_one"];}
if (isset($_GET["custom_two"]))					{$custom_two=$_GET["custom_two"];}
	elseif (isset($_POST["custom_two"]))		{$custom_two=$_POST["custom_two"];}
if (isset($_GET["custom_three"]))				{$custom_three=$_GET["custom_three"];}
	elseif (isset($_POST["custom_three"]))		{$custom_three=$_POST["custom_three"];}
if (isset($_GET["custom_four"]))				{$custom_four=$_GET["custom_four"];}
	elseif (isset($_POST["custom_four"]))		{$custom_four=$_POST["custom_four"];}
if (isset($_GET["custom_five"]))				{$custom_five=$_GET["custom_five"];}
	elseif (isset($_POST["custom_five"]))		{$custom_five=$_POST["custom_five"];}
if (isset($_GET["crm_popup_login"]))			{$crm_popup_login=$_GET["crm_popup_login"];}
	elseif (isset($_POST["crm_popup_login"]))	{$crm_popup_login=$_POST["crm_popup_login"];}
if (isset($_GET["crm_login_address"]))			{$crm_login_address=$_GET["crm_login_address"];}
	elseif (isset($_POST["crm_login_address"]))	{$crm_login_address=$_POST["crm_login_address"];}
if (isset($_GET["timer_action"]))					{$timer_action=$_GET["timer_action"];}
	elseif (isset($_POST["timer_action"]))			{$timer_action=$_POST["timer_action"];}
if (isset($_GET["timer_action_message"]))			{$timer_action_message=$_GET["timer_action_message"];}
	elseif (isset($_POST["timer_action_message"]))	{$timer_action_message=$_POST["timer_action_message"];}
if (isset($_GET["timer_action_seconds"]))			{$timer_action_seconds=$_GET["timer_action_seconds"];}
	elseif (isset($_POST["timer_action_seconds"]))	{$timer_action_seconds=$_POST["timer_action_seconds"];}
if (isset($_GET["start_call_url"]))				{$start_call_url=$_GET["start_call_url"];}
	elseif (isset($_POST["start_call_url"]))	{$start_call_url=$_POST["start_call_url"];}
if (isset($_GET["dispo_call_url"]))				{$dispo_call_url=$_GET["dispo_call_url"];}
	elseif (isset($_POST["dispo_call_url"]))	{$dispo_call_url=$_POST["dispo_call_url"];}
if (isset($_GET["xferconf_c_number"]))			{$xferconf_c_number=$_GET["xferconf_c_number"];}
	elseif (isset($_POST["xferconf_c_number"]))	{$xferconf_c_number=$_POST["xferconf_c_number"];}
if (isset($_GET["xferconf_d_number"]))			{$xferconf_d_number=$_GET["xferconf_d_number"];}
	elseif (isset($_POST["xferconf_d_number"]))	{$xferconf_d_number=$_POST["xferconf_d_number"];}
if (isset($_GET["xferconf_e_number"]))			{$xferconf_e_number=$_GET["xferconf_e_number"];}
	elseif (isset($_POST["xferconf_e_number"]))	{$xferconf_e_number=$_POST["xferconf_e_number"];}
if (isset($_GET["campaign_inbound_mode"]))			{$campaign_inbound_mode=$_GET["campaign_inbound_mode"];}
	elseif (isset($_POST["campaign_inbound_mode"]))	{$campaign_inbound_mode=$_POST["campaign_inbound_mode"];}
if (isset($_GET["modepara"]))			{$modepara=$_GET["modepara"];}
	elseif (isset($_POST["modepara"]))	{$modepara=$_POST["modepara"];}
	
if (isset($_GET["xfer_a_name"]))			{$xfer_a_name=$_GET["xfer_a_name"];}
	elseif (isset($_POST["xfer_a_name"]))	{$xfer_a_name=$_POST["xfer_a_name"];}
if (isset($_GET["xfer_b_name"]))			{$xfer_b_name=$_GET["xfer_b_name"];}
	elseif (isset($_POST["xfer_b_name"]))	{$xfer_b_name=$_POST["xfer_b_name"];}
if (isset($_GET["xfer_c_name"]))			{$xfer_c_name=$_GET["xfer_c_name"];}
	elseif (isset($_POST["xfer_c_name"]))	{$xfer_c_name=$_POST["xfer_c_name"];}
if (isset($_GET["xfer_d_name"]))			{$xfer_d_name=$_GET["xfer_d_name"];}
	elseif (isset($_POST["xfer_d_name"]))	{$xfer_d_name=$_POST["xfer_d_name"];}
if (isset($_GET["xfer_e_name"]))			{$xfer_e_name=$_GET["xfer_e_name"];}
	elseif (isset($_POST["xfer_e_name"]))	{$xfer_e_name=$_POST["xfer_e_name"];}
	
if (isset($_GET["ring_start_launch"]))			{$ring_start_launch=$_GET["ring_start_launch"];}
	elseif (isset($_POST["ring_start_launch"]))	{$ring_start_launch=$_POST["ring_start_launch"];}
if (isset($_GET["ring_ingroup_script"]))			{$ring_ingroup_script=$_GET["ring_ingroup_script"];}
	elseif (isset($_POST["ring_ingroup_script"]))	{$ring_ingroup_script=$_POST["ring_ingroup_script"];}
if (isset($_GET["ring_form_address"]))			{$ring_form_address=$_GET["ring_form_address"];}
	elseif (isset($_POST["ring_form_address"]))	{$ring_form_address=$_POST["ring_form_address"];}
if (isset($_GET["ring_form_address_two"]))			{$ring_form_address_two=$_GET["ring_form_address_two"];}
	elseif (isset($_POST["ring_form_address_two"]))	{$ring_form_address_two=$_POST["ring_form_address_two"];}


	
### 增加的GET POST参数 + fnatic
if (isset($_GET["ccms_admin_modules"])) {$ccms_admin_modules=$_GET["ccms_admin_modules"];}
    elseif(isset($_POST["ccms_admin_modules"])) {$ccms_admin_modules=$_POST["ccms_admin_modules"];}

if (isset($_GET["crm_target"]))		{$crm_target=$_GET["crm_target"];}
	elseif(isset($_POST["crm_target"]))		{$crm_target=$_POST["crm_target"];}

if (isset($_GET["play_agent_info"]))	{$play_agent_info=$_GET["play_agent_info"];}
	elseif(isset($_POST["play_agent_info"]))	{$play_agent_info=$_POST["play_agent_info"];}
### end
	if (isset($script_id)) {$script_id= strtoupper($script_id);}
	if (isset($lead_filter_id)) {$lead_filter_id = strtoupper($lead_filter_id);}




if (isset($_GET["status_type"]))		{$status_type=$_GET["status_type"];}
	elseif(isset($_POST["status_type"]))		{$status_type=$_POST["status_type"];}
	
if (isset($_GET["trans_switch"]))		{$trans_switch=$_GET["trans_switch"];}
	elseif(isset($_POST["trans_switch"]))		{$trans_switch=$_POST["trans_switch"];}
if (isset($_GET["system_status_state"]))		{$system_status_state=$_GET["system_status_state"];}
	elseif(isset($_POST["system_status_state"]))		{$system_status_state=$_POST["system_status_state"];}
if (isset($_GET["sql_on_table"]))		{$sql_on_table=$_GET["sql_on_table"];}
	elseif(isset($_POST["sql_on_table"]))		{$sql_on_table=$_POST["sql_on_table"];}




if (strlen($dial_status) > 0) 
	{
	$ADD='28';
	$status = $dial_status;
	}
	
 if ( isset($manager_select) ){
 	    $manager_select = implode(",",$manager_select);
 }else{
 	    $manager_select = "";  
 }
 if ( isset($supervisor_select) ){
 	    $supervisor_select = implode(",",$supervisor_select);
 }else{
 	    $supervisor_select = "";
 }
  if ( isset($qa_select) ){
 	    $qa_select = implode(",",$qa_select);
 }else{
 	    $qa_select = "";
 }

#############################################
##### START SYSTEM_SETTINGS LOOKUP #####
$stmt = "SELECT use_non_latin,enable_queuemetrics_logging,qc_features_active,outbound_autodial_active,sounds_central_control_active,enable_second_webform,user_territories_active FROM system_settings;";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$qm_conf_ct = mysql_num_rows($rslt);
if ($qm_conf_ct > 0)
	{
	$row=mysql_fetch_row($rslt);
	$non_latin =						$row[0];
	$SSenable_queuemetrics_logging =	$row[1];
	$SSqc_features_active =				$row[2];
	$SSoutbound_autodial_active =		$row[3];
	$SSsounds_central_control_active =	$row[4];
	$SSenable_second_webform =			$row[5];
	$SSuser_territories_active =		$row[6];
	}
$stmt = "SELECT enable_vtiger_integration FROM vicidial_campaigns where campaign_id='$campaign_id';";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$qm_conf_ct = mysql_num_rows($rslt);
if ($qm_conf_ct > 0)
	{
	$row=mysql_fetch_row($rslt);
	$SSenable_vtiger_integration =	$row[0];
	}
##### END SETTINGS LOOKUP #####
###########################################

######################################################################################################
######################################################################################################
#######   Form variable filtering for security and data integrity
######################################################################################################
######################################################################################################

if ($non_latin < 1)
	{
	### DIGITS ONLY ###
	$adaptive_latest_server_time = ereg_replace("[^0-9]","",$adaptive_latest_server_time);
	$admin_hangup_enabled = ereg_replace("[^0-9]","",$admin_hangup_enabled);
	$admin_hijack_enabled = ereg_replace("[^0-9]","",$admin_hijack_enabled);
	$admin_monitor_enabled = ereg_replace("[^0-9]","",$admin_monitor_enabled);
	$AFLogging_enabled = ereg_replace("[^0-9]","",$AFLogging_enabled);
	$agent_choose_ingroups = ereg_replace("[^0-9]","",$agent_choose_ingroups);
	$agentcall_manual = ereg_replace("[^0-9]","",$agentcall_manual);
	$agentonly_callbacks = ereg_replace("[^0-9]","",$agentonly_callbacks);
	$AGI_call_logging_enabled = ereg_replace("[^0-9]","",$AGI_call_logging_enabled);
	$allcalls_delay = ereg_replace("[^0-9]","",$allcalls_delay);
	$alter_agent_interface_options = ereg_replace("[^0-9]","",$alter_agent_interface_options);
	$answer_transfer_agent = ereg_replace("[^0-9]","",$answer_transfer_agent);
	$ast_admin_access = ereg_replace("[^0-9]","",$ast_admin_access);
	$ast_delete_phones = ereg_replace("[^0-9]","",$ast_delete_phones);
	$attempt_delay = ereg_replace("[^0-9]","",$attempt_delay);
	$attempt_maximum = ereg_replace("[^0-9]","",$attempt_maximum);
	$auto_dial_next_number = ereg_replace("[^0-9]","",$auto_dial_next_number);
	$balance_trunks_offlimits = ereg_replace("[^0-9]","",$balance_trunks_offlimits);
	$call_parking_enabled = ereg_replace("[^0-9]","",$call_parking_enabled);
	$CallerID_popup_enabled = ereg_replace("[^0-9]","",$CallerID_popup_enabled);
	$campaign_detail = ereg_replace("[^0-9]","",$campaign_detail);
	$campaign_rec_exten = ereg_replace("[^0-9]","",$campaign_rec_exten);
	$campaign_vdad_exten = ereg_replace("[^0-9]","",$campaign_vdad_exten);
	$change_agent_campaign = ereg_replace("[^0-9]","",$change_agent_campaign);
	$closer_default_blended = ereg_replace("[^0-9]","",$closer_default_blended);
	$conf_exten = ereg_replace("[^0-9]","",$conf_exten);
	$conf_on_extension = ereg_replace("[^0-9]","",$conf_on_extension);
	$conferencing_enabled = ereg_replace("[^0-9]","",$conferencing_enabled);
	$ct_default_start = ereg_replace("[^0-9]","",$ct_default_start);
	$ct_default_stop = ereg_replace("[^0-9]","",$ct_default_stop);
	$ct_friday_start = ereg_replace("[^0-9]","",$ct_friday_start);
	$ct_friday_stop = ereg_replace("[^0-9]","",$ct_friday_stop);
	$ct_monday_start = ereg_replace("[^0-9]","",$ct_monday_start);
	$ct_monday_stop = ereg_replace("[^0-9]","",$ct_monday_stop);
	$ct_saturday_start = ereg_replace("[^0-9]","",$ct_saturday_start);
	$ct_saturday_stop = ereg_replace("[^0-9]","",$ct_saturday_stop);
	$ct_sunday_start = ereg_replace("[^0-9]","",$ct_sunday_start);
	$ct_sunday_stop = ereg_replace("[^0-9]","",$ct_sunday_stop);
	$ct_thursday_start = ereg_replace("[^0-9]","",$ct_thursday_start);
	$ct_thursday_stop = ereg_replace("[^0-9]","",$ct_thursday_stop);
	$ct_tuesday_start = ereg_replace("[^0-9]","",$ct_tuesday_start);
	$ct_tuesday_stop = ereg_replace("[^0-9]","",$ct_tuesday_stop);
	$ct_wednesday_start = ereg_replace("[^0-9]","",$ct_wednesday_start);
	$ct_wednesday_stop = ereg_replace("[^0-9]","",$ct_wednesday_stop);
	$DBX_port = ereg_replace("[^0-9]","",$DBX_port);
	$DBY_port = ereg_replace("[^0-9]","",$DBY_port);
	$dedicated_trunks = ereg_replace("[^0-9]","",$dedicated_trunks);
	$delete_call_times = ereg_replace("[^0-9]","",$delete_call_times);
	$delete_campaigns = ereg_replace("[^0-9]","",$delete_campaigns);
	$delete_filters = ereg_replace("[^0-9]","",$delete_filters);
	$delete_ingroups = ereg_replace("[^0-9]","",$delete_ingroups);
	$delete_lists = ereg_replace("[^0-9]","",$delete_lists);
	$delete_remote_agents = ereg_replace("[^0-9]","",$delete_remote_agents);
	$delete_scripts = ereg_replace("[^0-9]","",$delete_scripts);
	$delete_user_groups = ereg_replace("[^0-9]","",$delete_user_groups);
	$delete_users = ereg_replace("[^0-9]","",$delete_users);
	$dial_timeout = ereg_replace("[^0-9]","",$dial_timeout);
	$dialplan_number = ereg_replace("[^0-9]","",$dialplan_number);
	$enable_fast_refresh = ereg_replace("[^0-9]","",$enable_fast_refresh);
	$enable_persistant_mysql = ereg_replace("[^0-9]","",$enable_persistant_mysql);
	$fast_refresh_rate = ereg_replace("[^0-9]","",$fast_refresh_rate);
	$hopper_level = ereg_replace("[^0-9]","",$hopper_level);
	$hotkey = ereg_replace("[^0-9]","",$hotkey);
	$hotkeys_active = ereg_replace("[^0-9]","",$hotkeys_active);
	$list_id = ereg_replace("[^0-9]","",$list_id);
	$load_leads = ereg_replace("[^0-9]","",$load_leads);
	$max_vicidial_trunks = ereg_replace("[^0-9]","",$max_vicidial_trunks);
	$modify_call_times = ereg_replace("[^0-9]","",$modify_call_times);
	$modify_users = ereg_replace("[^0-9]","",$modify_users);
	$modify_campaigns = ereg_replace("[^0-9]","",$modify_campaigns);
	$modify_lists = ereg_replace("[^0-9]","",$modify_lists);
	$modify_scripts = ereg_replace("[^0-9]","",$modify_scripts);
	$modify_filters = ereg_replace("[^0-9]","",$modify_filters);
	$modify_ingroups = ereg_replace("[^0-9]","",$modify_ingroups);
	$modify_usergroups = ereg_replace("[^0-9]","",$modify_usergroups);
	$modify_remoteagents = ereg_replace("[^0-9]","",$modify_remoteagents);
	$modify_servers = ereg_replace("[^0-9]","",$modify_servers);
	$view_reports = ereg_replace("[^0-9]","",$view_reports);
	$modify_leads = ereg_replace("[^0-9]","",$modify_leads);
	$monitor_prefix = ereg_replace("[^0-9]","",$monitor_prefix);
	$number_of_lines = ereg_replace("[^0-9]","",$number_of_lines);
	$old_conf_exten = ereg_replace("[^0-9]","",$old_conf_exten);
	$outbound_cid = ereg_replace("[^0-9]","",$outbound_cid);
	$park_ext = ereg_replace("[^0-9]","",$park_ext);
	$park_on_extension = ereg_replace("[^0-9]","",$park_on_extension);
	$phone_number = ereg_replace("[^0-9]","",$phone_number);
	$QUEUE_ACTION_enabled = ereg_replace("[^0-9]","",$QUEUE_ACTION_enabled);
	$recording_exten = ereg_replace("[^0-9]","",$recording_exten);
	$remote_agent_id = ereg_replace("[^0-9]","",$remote_agent_id);
	$telnet_port = ereg_replace("[^0-9]","",$telnet_port);
	$updater_check_enabled = ereg_replace("[^0-9]","",$updater_check_enabled);
	$user_level = ereg_replace("[^0-9]","",$user_level);
	$user_start = ereg_replace("[^0-9]","",$user_start);
	$user_switching_enabled = ereg_replace("[^0-9]","",$user_switching_enabled);
	$VDstop_rec_after_each_call = ereg_replace("[^0-9]","",$VDstop_rec_after_each_call);
	$VICIDIAL_park_on_extension = ereg_replace("[^0-9]","",$VICIDIAL_park_on_extension);
	$vicidial_recording = ereg_replace("[^0-9]","",$vicidial_recording);
	$vicidial_transfers = ereg_replace("[^0-9]","",$vicidial_transfers);
	$voicemail_button_enabled = ereg_replace("[^0-9]","",$voicemail_button_enabled);
	$voicemail_dump_exten = ereg_replace("[^0-9]","",$voicemail_dump_exten);
	$voicemail_ext = ereg_replace("[^0-9]","",$voicemail_ext);
	$voicemail_exten = ereg_replace("[^0-9]","",$voicemail_exten);
	$wrapup_seconds = ereg_replace("[^0-9]","",$wrapup_seconds);
	$use_non_latin = ereg_replace("[^0-9]","",$use_non_latin);
	$webroot_writable = ereg_replace("[^0-9]","",$webroot_writable);
	$enable_queuemetrics_logging = ereg_replace("[^0-9]","",$enable_queuemetrics_logging);
	$enable_sipsak_messages = ereg_replace("[^0-9]","",$enable_sipsak_messages);
	$allow_sipsak_messages = ereg_replace("[^0-9]","",$allow_sipsak_messages);
	$mix_container_item = ereg_replace("[^0-9]","",$mix_container_item);
	$prompt_interval = ereg_replace("[^0-9]","",$prompt_interval);
	$agent_alert_delay = ereg_replace("[^0-9]","",$agent_alert_delay);
	$manual_dial_list_id = ereg_replace("[^0-9]","",$manual_dial_list_id);
	$qc_user_level = ereg_replace("[^0-9]","",$qc_user_level);
	$qc_pass = ereg_replace("[^0-9]","",$qc_pass);
	$qc_finish = ereg_replace("[^0-9]","",$qc_finish);
	$qc_commit = ereg_replace("[^0-9]","",$qc_commit);
	$shift_start_time = ereg_replace("[^0-9]","",$shift_start_time);
	$timeclock_end_of_day = ereg_replace("[^0-9]","",$timeclock_end_of_day);
	$survey_xfer_exten = ereg_replace("[^0-9]","",$survey_xfer_exten);
	$add_timeclock_log = ereg_replace("[^0-9]","",$add_timeclock_log);
	$modify_timeclock_log = ereg_replace("[^0-9]","",$modify_timeclock_log);
	$delete_timeclock_log = ereg_replace("[^0-9]","",$delete_timeclock_log);
	$vdc_agent_api_access = ereg_replace("[^0-9]","",$vdc_agent_api_access);
	$vdc_agent_api_active = ereg_replace("[^0-9]","",$vdc_agent_api_active);
	$hold_time_option_seconds = ereg_replace("[^0-9]","",$hold_time_option_seconds);
	$hold_time_option_callback_list_id = ereg_replace("[^0-9]","",$hold_time_option_callback_list_id);
	$did_id = ereg_replace("[^0-9]","",$did_id);
	$source_did = ereg_replace("[^0-9]","",$source_did);
	$modify_inbound_dids = ereg_replace("[^0-9]","",$modify_inbound_dids);
	$delete_inbound_dids = ereg_replace("[^0-9]","",$delete_inbound_dids);
	$answer_sec_pct_rt_stat_one = ereg_replace("[^0-9]","",$answer_sec_pct_rt_stat_one);
	$answer_sec_pct_rt_stat_two = ereg_replace("[^0-9]","",$answer_sec_pct_rt_stat_two);
	$enable_vtiger_integration = ereg_replace("[^0-9]","",$enable_vtiger_integration);
	$qc_features_active = ereg_replace("[^0-9]","",$qc_features_active);
	$outbound_autodial_active = ereg_replace("[^0-9]","",$outbound_autodial_active);
	$download_lists = ereg_replace("[^0-9]","",$download_lists);
	$caller_id_number = ereg_replace("[^0-9]","",$caller_id_number);
	$outbound_calls_per_second = ereg_replace("[^0-9]","",$outbound_calls_per_second);
	$manager_shift_enforcement_override = ereg_replace("[^0-9]","",$manager_shift_enforcement_override);
	$export_reports = ereg_replace("[^0-9]","",$export_reports);
	$delete_from_dnc = ereg_replace("[^0-9]","",$delete_from_dnc);
	
	$view_historical_reports = ereg_replace("[^0-9]","",$view_historical_reports);
	$live_monitor = ereg_replace("[^0-9]","",$live_monitor);
	$search_historical_call = ereg_replace("[^0-9]","",$search_historical_call);
	$search_voice_mail = ereg_replace("[^0-9]","",$search_voice_mail);
	$add_new_users = ereg_replace("[^0-9]","",$add_new_users);
	$add_new_campaigns = ereg_replace("[^0-9]","",$add_new_campaigns);
	$add_new_lists = ereg_replace("[^0-9]","",$add_new_lists);
	$add_new_usergroups = ereg_replace("[^0-9]","",$add_new_usergroups);
	$add_from_dnc = ereg_replace("[^0-9]","",$add_from_dnc);
	
	$menu_timeout = ereg_replace("[^0-9]","",$menu_timeout);
	$menu_time_check = ereg_replace("[^0-9]","",$menu_time_check);
	$track_in_vdac = ereg_replace("[^0-9]","",$track_in_vdac);
	$menu_repeat = ereg_replace("[^0-9]","",$menu_repeat);
	$agentonly_callback_campaign_lock = ereg_replace("[^0-9]","",$agentonly_callback_campaign_lock);
	$sounds_central_control_active = ereg_replace("[^0-9]","",$sounds_central_control_active);
	$user_territories_active = ereg_replace("[^0-9]","",$user_territories_active);
	$vicidial_recording_limit = ereg_replace("[^0-9]","",$vicidial_recording_limit);
	$allow_custom_dialplan = ereg_replace("[^0-9]","",$allow_custom_dialplan);
	$phone_ring_timeout = ereg_replace("[^0-9]","",$phone_ring_timeout);
	$enable_tts_integration = ereg_replace("[^0-9]","",$enable_tts_integration);
	$allow_alerts = ereg_replace("[^0-9]","",$allow_alerts);
	$vicidial_balance_rank = ereg_replace("[^0-9]","",$vicidial_balance_rank);
	$rank = ereg_replace("[^0-9]","",$rank);
	$enable_second_webform = ereg_replace("[^0-9]","",$enable_second_webform);
	$campaign_cid_override = ereg_replace("[^0-9]","",$campaign_cid_override);
	$agent_choose_territories = ereg_replace("[^0-9]","",$agent_choose_territories);
	$timer_action_seconds = ereg_replace("[^0-9]","",$timer_action_seconds);

	$drop_call_seconds = ereg_replace("[^-0-9]","",$drop_call_seconds);

	### DIGITS and COLONS
	$shift_length = ereg_replace("[^\:0-9]","",$shift_length);

	### DIGITS and HASHES and STARS
	$survey_dtmf_digits = ereg_replace("[^\#\*0-9]","",$survey_dtmf_digits);
	$survey_ni_digit = ereg_replace("[^\#\*0-9]","",$survey_ni_digit);

	### DIGITS and DASHES
	$group_rank = ereg_replace("[^-0-9]","",$group_rank);
	$campaign_rank = ereg_replace("[^-0-9]","",$campaign_rank);
	$queue_priority = ereg_replace("[^-0-9]","",$queue_priority);

	### DIGITS and NEWLINES
	$phone_numbers = ereg_replace("[^X\n0-9]","",$phone_numbers);

	### Y or N ONLY ###
	$allow_closers = ereg_replace("[^NY]","",$allow_closers);
	$reset_hopper = ereg_replace("[^NY]","",$reset_hopper);
	$amd_send_to_vmx = ereg_replace("[^NY]","",$amd_send_to_vmx);
	$alt_number_dialing = ereg_replace("[^NY]","",$alt_number_dialing);
	$selectable = ereg_replace("[^NY]","",$selectable);
	$reset_list = ereg_replace("[^NY]","",$reset_list);
	$fronter_display = ereg_replace("[^NY]","",$fronter_display);
	$omit_phone_code = ereg_replace("[^NY]","",$omit_phone_code);
	$available_only_ratio_tally = ereg_replace("[^NY]","",$available_only_ratio_tally);
	$sys_perf_log = ereg_replace("[^NY]","",$sys_perf_log);
	$vicidial_balance_active = ereg_replace("[^NY]","",$vicidial_balance_active);
	$vd_server_logs = ereg_replace("[^NY]","",$vd_server_logs);
	$campaign_stats_refresh = ereg_replace("[^NY]","",$campaign_stats_refresh);
	$disable_alter_custdata = ereg_replace("[^NY]","",$disable_alter_custdata);
	$no_hopper_leads_logins = ereg_replace("[^NY]","",$no_hopper_leads_logins);
	$human_answered = ereg_replace("[^NY]","",$human_answered);
        $status_class = ereg_replace("[^NY]","",$status_class);
	$tovdad_display = ereg_replace("[^NY]","",$tovdad_display);
	$campaign_allow_inbound = ereg_replace("[^NY]","",$campaign_allow_inbound);
	$display_queue_count = ereg_replace("[^NY]","",$display_queue_count);
	$qc_show_recording = ereg_replace("[^NY]","",$qc_show_recording);
	$sale_category = ereg_replace("[^NY]","",$sale_category);
	$dead_lead_category = ereg_replace("[^NY]","",$dead_lead_category);
	$agent_extended_alt_dial  = ereg_replace("[^NY]","",$agent_extended_alt_dial);
	$play_place_in_line  = ereg_replace("[^NY]","",$play_place_in_line);
	$play_language  = ereg_replace("[^NY]","",$play_language);
	$play_estimate_hold_time  = ereg_replace("[^NY]","",$play_estimate_hold_time);
	$no_delay_call_route  = ereg_replace("[^NY]","",$no_delay_call_route);
	$did_active  = ereg_replace("[^NY]","",$did_active);
	$active_asterisk_server = ereg_replace("[^NY]","",$active_asterisk_server);
	$generate_vicidial_conf = ereg_replace("[^NY]","",$generate_vicidial_conf);
	$rebuild_conf_files = ereg_replace("[^NY]","",$rebuild_conf_files);
	$agent_allow_group_alias = ereg_replace("[^NY]","",$agent_allow_group_alias);
	$vtiger_status_call = ereg_replace("[^NY]","",$vtiger_status_call);
	$sale = ereg_replace("[^NY]","",$sale);
	$dnc = ereg_replace("[^NY]","",$dnc);
	$customer_contact = ereg_replace("[^NY]","",$customer_contact);
	$not_interested = ereg_replace("[^NY]","",$not_interested);
	$unworkable = ereg_replace("[^NY]","",$unworkable);
	$sounds_update = ereg_replace("[^NY]","",$sounds_update);
	$carrier_logging_active = ereg_replace("[^NY]","",$carrier_logging_active);
	$agent_status_view_time = ereg_replace("[^NY]","",$agent_status_view_time);
	$no_hopper_dialing = ereg_replace("[^NY]","",$no_hopper_dialing);
	$agent_display_dialable_leads = ereg_replace("[^NY]","",$agent_display_dialable_leads);
	$random = ereg_replace("[^NY]","",$random);
	$rebuild_music_on_hold = ereg_replace("[^NY]","",$rebuild_music_on_hold);
	$active_agent_login_server = ereg_replace("[^NY]","",$active_agent_login_server);
	$agent_select_territories = ereg_replace("[^NY]","",$agent_select_territories);
	$delete_vm_after_email = ereg_replace("[^NY]","",$delete_vm_after_email);
	$crm_popup_login = ereg_replace("[^NY]","",$crm_popup_login);

	$qc_enabled = ereg_replace("[^0-9NY]","",$qc_enabled);
	$active = ereg_replace("[^0-9NY]","",$active);


	### ALPHA-NUMERIC ONLY ###
	$script_id = ereg_replace("[^0-9a-zA-Z]","",$script_id);
	$agent_script_override = ereg_replace("[^0-9a-zA-Z]","",$agent_script_override);
	$campaign_script = ereg_replace("[^0-9a-zA-Z]","",$campaign_script);
	$submit = ereg_replace("[^0-9a-zA-Z]","",$submit);
	$campaign_cid = ereg_replace("[^0-9a-zA-Z]","",$campaign_cid);
	$get_call_launch = ereg_replace("[^0-9a-zA-Z]","",$get_call_launch);
	$campaign_recording = ereg_replace("[^0-9a-zA-Z]","",$campaign_recording);
	$ADD = ereg_replace("[^0-9a-zA-Z]","",$ADD);
	$dial_prefix = ereg_replace("[^0-9a-zA-Z]","",$dial_prefix);
	$state_call_time_state = ereg_replace("[^0-9a-zA-Z]","",$state_call_time_state);
	$scheduled_callbacks = ereg_replace("[^0-9a-zA-Z]","",$scheduled_callbacks);
	$concurrent_transfers = ereg_replace("[^0-9a-zA-Z]","",$concurrent_transfers);
	$billable = ereg_replace("[^0-9a-zA-Z]","",$billable);
	$pause_code = ereg_replace("[^0-9a-zA-Z]","",$pause_code);
	$vicidial_recording_override = ereg_replace("[^0-9a-zA-Z]","",$vicidial_recording_override);
	$ingroup_recording_override = ereg_replace("[^0-9a-zA-Z]","",$ingroup_recording_override);
	$queuemetrics_log_id = ereg_replace("[^0-9a-zA-Z]","",$queuemetrics_log_id);
	$after_hours_exten = ereg_replace("[^0-9a-zA-Z]","",$after_hours_exten);
	$after_hours_voicemail = ereg_replace("[^0-9a-zA-Z]","",$after_hours_voicemail);
	$qc_script = ereg_replace("[^0-9a-zA-Z]","",$qc_script);
	$code = ereg_replace("[^0-9a-zA-Z]","",$code);
	$survey_no_response_action = ereg_replace("[^0-9a-zA-Z]","",$survey_no_response_action);
	$survey_ni_status = ereg_replace("[^0-9a-zA-Z]","",$survey_ni_status);
	$qc_get_record_launch = ereg_replace("[^0-9a-zA-Z]","",$qc_get_record_launch);
	$agent_pause_codes_active = ereg_replace("[^0-9a-zA-Z]","",$agent_pause_codes_active);
	$three_way_dial_prefix = ereg_replace("[^0-9a-zA-Z]","",$three_way_dial_prefix);
	$shift_enforcement = ereg_replace("[^0-9a-zA-Z]","",$shift_enforcement);
	$agent_shift_enforcement_override = ereg_replace("[^0-9a-zA-Z]","",$agent_shift_enforcement_override);
	$survey_third_status = ereg_replace("[^0-9a-zA-Z]","",$survey_third_status);
	$survey_fourth_status = ereg_replace("[^0-9a-zA-Z]","",$survey_fourth_status);
	$sounds_web_directory = ereg_replace("[^0-9a-zA-Z]","",$sounds_web_directory);
	$disable_alter_custphone = ereg_replace("[^0-9a-zA-Z]","",$disable_alter_custphone);
	$view_calls_in_queue = ereg_replace("[^0-9a-zA-Z]","",$view_calls_in_queue);
	$view_calls_in_queue_launch = ereg_replace("[^0-9a-zA-Z]","",$view_calls_in_queue_launch);
	$grab_calls_in_queue = ereg_replace("[^0-9a-zA-Z]","",$grab_calls_in_queue);
	$view_agent_status = ereg_replace("[^0-9a-zA-Z]","",$view_agent_status);
	$call_requeue_button = ereg_replace("[^0-9a-zA-Z]","",$call_requeue_button);
	$pause_after_each_call = ereg_replace("[^0-9a-zA-Z]","",$pause_after_each_call);
	$use_internal_dnc = ereg_replace("[^0-9a-zA-Z]","",$use_internal_dnc);
	$use_campaign_dnc = ereg_replace("[^0-9a-zA-Z]","",$use_campaign_dnc);
	$voicemail_id = ereg_replace("[^0-9a-zA-Z]","",$voicemail_id);
	$status_id = ereg_replace("[^0-9a-zA-Z]","",$status_id);

	### DIGITS and Dots
	$server_ip = ereg_replace("[^\.0-9]","",$server_ip);
	$auto_dial_level = ereg_replace("[^\.0-9]","",$auto_dial_level);
	$adaptive_maximum_level = ereg_replace("[^\.0-9]","",$adaptive_maximum_level);
	$phone_ip = ereg_replace("[^\.0-9]","",$phone_ip);
	$old_server_ip = ereg_replace("[^\.0-9]","",$old_server_ip);
	$computer_ip = ereg_replace("[^\.0-9]","",$computer_ip);
	$queuemetrics_server_ip = ereg_replace("[^\.0-9]","",$queuemetrics_server_ip);
	$vtiger_server_ip = ereg_replace("[^\.0-9]","",$vtiger_server_ip);
	$active_voicemail_server = ereg_replace("[^\.0-9]","",$active_voicemail_server);
	$auto_dial_limit = ereg_replace("[^\.0-9]","",$auto_dial_limit);
	$adaptive_dropped_percentage = ereg_replace("[^\.0-9]","",$adaptive_dropped_percentage);
	$drop_lockout_time = ereg_replace("[^\.0-9]","",$drop_lockout_time);

	### ALPHA-NUMERIC and spaces and hash and star and comma
	$xferconf_a_dtmf = ereg_replace("[^ \,\*\#0-9a-zA-Z]","",$xferconf_a_dtmf);
	$xferconf_b_dtmf = ereg_replace("[^ \,\*\#0-9a-zA-Z]","",$xferconf_b_dtmf);
	$xferconf_c_dtmf = ereg_replace("[^ \,\*\#0-9a-zA-Z]","",$xferconf_c_dtmf);
	$xferconf_d_dtmf = ereg_replace("[^ \,\*\#0-9a-zA-Z]","",$xferconf_d_dtmf);
	$xferconf_e_dtmf = ereg_replace("[^ \,\*\#0-9a-zA-Z]","",$xferconf_e_dtmf);
	$survey_third_digit = ereg_replace("[^ \,\*\#0-9a-zA-Z]","",$survey_third_digit);
	$survey_fourth_digit = ereg_replace("[^ \,\*\#0-9a-zA-Z]","",$survey_fourth_digit);
	$survey_third_exten = ereg_replace("[^ \,\*\#0-9a-zA-Z]","",$survey_third_exten);
	$survey_fourth_exten = ereg_replace("[^ \,\*\#0-9a-zA-Z]","",$survey_fourth_exten);

	### ALPHACAPS-NUMERIC
	$xferconf_a_number = ereg_replace("[^0-9A-Z]","",$xferconf_a_number);
	$xferconf_b_number = ereg_replace("[^0-9A-Z]","",$xferconf_b_number);

	### ALPHA-NUMERIC and underscore and dash
	$agi_output = ereg_replace("[^-_0-9a-zA-Z]","",$agi_output);
	$ASTmgrSECRET = ereg_replace("[^-_0-9a-zA-Z]","",$ASTmgrSECRET);
	$ASTmgrUSERNAME = ereg_replace("[^-_0-9a-zA-Z]","",$ASTmgrUSERNAME);
	$ASTmgrUSERNAMElisten = ereg_replace("[^-_0-9a-zA-Z]","",$ASTmgrUSERNAMElisten);
	$ASTmgrUSERNAMEsend = ereg_replace("[^-_0-9a-zA-Z]","",$ASTmgrUSERNAMEsend);
	$ASTmgrUSERNAMEupdate = ereg_replace("[^-_0-9a-zA-Z]","",$ASTmgrUSERNAMEupdate);
	$call_time_id = ereg_replace("[^-_0-9a-zA-Z]","",$call_time_id);
	$campaign_id = ereg_replace("[^-_0-9a-zA-Z]","",$campaign_id);
	$CoNfIrM = ereg_replace("[^-_0-9a-zA-Z]","",$CoNfIrM);
	$DBX_database = ereg_replace("[^-_0-9a-zA-Z]","",$DBX_database);
	$DBX_pass = ereg_replace("[^-_0-9a-zA-Z]","",$DBX_pass);
	$DBX_user = ereg_replace("[^-_0-9a-zA-Z]","",$DBX_user);
	$DBY_database = ereg_replace("[^-_0-9a-zA-Z]","",$DBY_database);
	$DBY_pass = ereg_replace("[^-_0-9a-zA-Z]","",$DBY_pass);
	$DBY_user = ereg_replace("[^-_0-9a-zA-Z]","",$DBY_user);
	$dial_method = ereg_replace("[^-_0-9a-zA-Z]","",$dial_method);
	$dial_status_a = ereg_replace("[^-_0-9a-zA-Z]","",$dial_status_a);
	$dial_status_b = ereg_replace("[^-_0-9a-zA-Z]","",$dial_status_b);
	$dial_status_c = ereg_replace("[^-_0-9a-zA-Z]","",$dial_status_c);
	$dial_status_d = ereg_replace("[^-_0-9a-zA-Z]","",$dial_status_d);
	$dial_status_e = ereg_replace("[^-_0-9a-zA-Z]","",$dial_status_e);
	$ext_context = ereg_replace("[^-_0-9a-zA-Z]","",$ext_context);
	$group_id = ereg_replace("[^-_0-9a-zA-Z]","",$group_id);
	$lead_filter_id = ereg_replace("[^-_0-9a-zA-Z]","",$lead_filter_id);
	$local_call_time = ereg_replace("[^-_0-9a-zA-Z]","",$local_call_time);
	$login = ereg_replace("[^-_0-9a-zA-Z]","",$login);
	$login_campaign = ereg_replace("[^-_0-9a-zA-Z]","",$login_campaign);
	$login_pass = ereg_replace("[^-_0-9a-zA-Z]","",$login_pass);
	$login_user = ereg_replace("[^-_0-9a-zA-Z]","",$login_user);
	$next_agent_call = ereg_replace("[^-_0-9a-zA-Z]","",$next_agent_call);
	$next_agent_call_ring = ereg_replace("[^-_0-9a-zA-Z]","",$next_agent_call_ring);	
	$old_campaign_id = ereg_replace("[^-_0-9a-zA-Z]","",$old_campaign_id);
	$old_server_id = ereg_replace("[^-_0-9a-zA-Z]","",$old_server_id);
	$OLDuser_group = ereg_replace("[^-_0-9a-zA-Z]","",$OLDuser_group);
	$park_file_name = ereg_replace("[^-_0-9a-zA-Z]","",$park_file_name);
	$pass = ereg_replace("[^-_0-9a-zA-Z]","",$pass);
	$phone_login = ereg_replace("[^-_0-9a-zA-Z]","",$phone_login);
	$phone_pass = ereg_replace("[^-_0-9a-zA-Z]","",$phone_pass);
	$PHP_AUTH_PW = ereg_replace("[^-_0-9a-zA-Z]","",$PHP_AUTH_PW);
	$PHP_AUTH_USER = ereg_replace("[^-_0-9a-zA-Z]","",$PHP_AUTH_USER);
	$protocol = ereg_replace("[^-_0-9a-zA-Z]","",$protocol);
	$server_id = ereg_replace("[^-_0-9a-zA-Z]","",$server_id);
	$stage = ereg_replace("[^-_0-9a-zA-Z]","",$stage);
	$state_rule = ereg_replace("[^-_0-9a-zA-Z]","",$state_rule);
	$trunk_restriction = ereg_replace("[^-_0-9a-zA-Z]","",$trunk_restriction);
	$user = ereg_replace("[^-_0-9a-zA-Z]","",$user);
	$user_group = ereg_replace("[^-_0-9a-zA-Z]","",$user_group);
	$VICIDIAL_park_on_filename = ereg_replace("[^-_0-9a-zA-Z]","",$VICIDIAL_park_on_filename);
	$auto_alt_dial = ereg_replace("[^-_0-9a-zA-Z]","",$auto_alt_dial);
	$dial_status = ereg_replace("[^-_0-9a-zA-Z]","",$dial_status);
	$queuemetrics_eq_prepend = ereg_replace("[^-_0-9a-zA-Z]","",$queuemetrics_eq_prepend);
	$vicidial_agent_disable = ereg_replace("[^-_0-9a-zA-Z]","",$vicidial_agent_disable);
	$alter_custdata_override = ereg_replace("[^-_0-9a-zA-Z]","",$alter_custdata_override);
	$list_order_mix = ereg_replace("[^-_0-9a-zA-Z]","",$list_order_mix);
	$vcl_id = ereg_replace("[^-_0-9a-zA-Z]","",$vcl_id);
	$mix_method = ereg_replace("[^-_0-9a-zA-Z]","",$mix_method);
	$category = ereg_replace("[^-_0-9a-zA-Z]","",$category);
	$vsc_id = ereg_replace("[^-_0-9a-zA-Z]","",$vsc_id);
	$moh_context = ereg_replace("[^-_0-9a-zA-Z]","",$moh_context);
	$source_campaign_id = ereg_replace("[^-_0-9a-zA-Z]","",$source_campaign_id);
	$source_user_id = ereg_replace("[^-_0-9a-zA-Z]","",$source_user_id);
	$source_group_id = ereg_replace("[^-_0-9a-zA-Z]","",$source_group_id);
	$default_xfer_group = ereg_replace("[^-_0-9a-zA-Z]","",$default_xfer_group);
	$drop_exten = ereg_replace("[^-_0-9a-zA-Z]","",$drop_exten);
	$safe_harbor_exten = ereg_replace("[^-_0-9a-zA-Z]","",$safe_harbor_exten);
	$drop_action = ereg_replace("[^-_0-9a-zA-Z]","",$drop_action);
	$drop_inbound_group = ereg_replace("[^-_0-9a-zA-Z]","",$drop_inbound_group);
	$drop_menu_id = ereg_replace("[^-_0-9a-zA-Z]","",$drop_menu_id);
	$afterhours_xfer_group = ereg_replace("[^-_0-9a-zA-Z]","",$afterhours_xfer_group);
	$after_hours_action = ereg_replace("[^-_0-9a-zA-Z]","",$after_hours_action);
	$alias_id = ereg_replace("[^-_0-9a-zA-Z]","",$alias_id);
	$shift_id = ereg_replace("[^-_0-9a-zA-Z]","",$shift_id);
	$qc_shift_id = ereg_replace("[^-_0-9a-zA-Z]","",$qc_shift_id);
	$survey_first_audio_file = ereg_replace("[^-_0-9a-zA-Z]","",$survey_first_audio_file);
	$survey_opt_in_audio_file = ereg_replace("[^-_0-9a-zA-Z]","",$survey_opt_in_audio_file);
	$survey_ni_audio_file = ereg_replace("[^-_0-9a-zA-Z]","",$survey_ni_audio_file);
	$survey_method = ereg_replace("[^-_0-9a-zA-Z]","",$survey_method);
	$alter_custphone_override = ereg_replace("[^-_0-9a-zA-Z]","",$alter_custphone_override);
	$manual_dial_filter = ereg_replace("[^-_0-9a-zA-Z]","",$manual_dial_filter);
	$agent_clipboard_copy = ereg_replace("[^-_0-9a-zA-Z]","",$agent_clipboard_copy);
	$hold_time_option = ereg_replace("[^-_0-9a-zA-Z]","",$hold_time_option);
	$hold_time_option_xfer_group = ereg_replace("[^-_0-9a-zA-Z]","",$hold_time_option_xfer_group);
	$hold_recall_xfer_group = ereg_replace("[^-_0-9a-zA-Z]","",$hold_recall_xfer_group);
	$play_welcome_message = ereg_replace("[^-_0-9a-zA-Z]","",$play_welcome_message);
	$did_route = ereg_replace("[^-_0-9a-zA-Z]","",$did_route);
	$user_unavailable_action = ereg_replace("[^-_0-9a-zA-Z]","",$user_unavailable_action);
	$user_route_settings_ingroup = ereg_replace("[^-_0-9a-zA-Z]","",$user_route_settings_ingroup);
	$call_handle_method = ereg_replace("[^-_0-9a-zA-Z]","",$call_handle_method);
	$agent_search_method = ereg_replace("[^-_0-9a-zA-Z]","",$agent_search_method);
	$hold_time_option_voicemail = ereg_replace("[^-_0-9a-zA-Z]","",$hold_time_option_voicemail);
	$exten_context = ereg_replace("[^-_0-9a-zA-Z]","",$exten_context);
	$three_way_call_cid = ereg_replace("[^-_0-9a-zA-Z]","",$three_way_call_cid);
	$web_form_target = ereg_replace("[^-_0-9a-zA-Z]","",$web_form_target);
	$recording_web_link = ereg_replace("[^-_0-9a-zA-Z]","",$recording_web_link);
	$vtiger_search_category = ereg_replace("[^-_0-9a-zA-Z]","",$vtiger_search_category);
	$vtiger_create_call_record = ereg_replace("[^-_0-9a-zA-Z]","",$vtiger_create_call_record);
	$vtiger_create_lead_record = ereg_replace("[^-_0-9a-zA-Z]","",$vtiger_create_lead_record);
	$vtiger_screen_login = ereg_replace("[^-_0-9a-zA-Z]","",$vtiger_screen_login);
	$cpd_amd_action = ereg_replace("[^-_0-9a-zA-Z]","",$cpd_amd_action);
	$template_id = ereg_replace("[^-_0-9a-zA-Z]","",$template_id);
	$carrier_id = ereg_replace("[^-_0-9a-zA-Z]","",$carrier_id);
	$group_alias_id = ereg_replace("[^-_0-9a-zA-Z]","",$group_alias_id);
	$default_group_alias = ereg_replace("[^-_0-9a-zA-Z]","",$default_group_alias);
	$vtiger_search_dead = ereg_replace("[^-_0-9a-zA-Z]","",$vtiger_search_dead);
	$survey_third_audio_file = ereg_replace("[^-_0-9a-zA-Z]","",$survey_third_audio_file);
	$survey_fourth_audio_file = ereg_replace("[^-_0-9a-zA-Z]","",$survey_fourth_audio_file);
	$menu_id = ereg_replace("[^-_0-9a-zA-Z]","",$menu_id);
	$source_menu = ereg_replace("[^-_0-9a-zA-Z]","",$source_menu);
	$call_time_id = ereg_replace("[^-_0-9a-zA-Z]","",$call_time_id);
	$phone_context = ereg_replace("[^-_0-9a-zA-Z]","",$phone_context);
	$conf_secret = ereg_replace("[^-_0-9a-zA-Z]","",$conf_secret);
	$tracking_group = ereg_replace("[^-_0-9a-zA-Z]","",$tracking_group);
	$no_agent_no_queue = ereg_replace("[^-_0-9a-zA-Z]","",$no_agent_no_queue);
	$no_agent_action = ereg_replace("[^-_0-9a-zA-Z]","",$no_agent_action);
	$quick_transfer_button = ereg_replace("[^-_0-9a-zA-Z]","",$quick_transfer_button);
	$prepopulate_transfer_preset = ereg_replace("[^-_0-9a-zA-Z]","",$prepopulate_transfer_preset);
	$tts_id = ereg_replace("[^-_0-9a-zA-Z]","",$tts_id);
	$drop_rate_group = ereg_replace("[^-_0-9a-zA-Z]","",$drop_rate_group);
	$agent_dial_owner_only = ereg_replace("[^-_0-9a-zA-Z]","",$agent_dial_owner_only);
	$reset_time = ereg_replace("[^-_0-9a-zA-Z]","",$reset_time);
	$moh_id = ereg_replace("[^-_0-9a-zA-Z]","",$moh_id);
	$drop_inbound_group_override = ereg_replace("[^-_0-9a-zA-Z]","",$drop_inbound_group_override);
	$timer_action = ereg_replace("[^-_0-9a-zA-Z]","",$timer_action);

	$user_name_prefix = ereg_replace("[^-_0-9a-zA-Z]","",$user_name_prefix);
	$user_name_suffix_from = ereg_replace("[^-_0-9a-zA-Z]","",$user_name_suffix_from);
	$user_name_suffix_to = ereg_replace("[^-_0-9a-zA-Z]","",$user_name_suffix_to);

	### ALPHA-NUMERIC and underscore and dash and slash and dot
	$menu_prompt = ereg_replace("[^-\/\|\._0-9a-zA-Z]","",$menu_prompt);
	$menu_timeout_prompt = ereg_replace("[^-\/\|\._0-9a-zA-Z]","",$menu_timeout_prompt);
	$menu_invalid_prompt = ereg_replace("[^-\/\|\._0-9a-zA-Z]","",$menu_invalid_prompt);
	$after_hours_message_filename = ereg_replace("[^-\/\|\._0-9a-zA-Z]","",$after_hours_message_filename);
	$welcome_message_filename = ereg_replace("[^-\/\|\._0-9a-zA-Z]","",$welcome_message_filename);
	$onhold_prompt_filename = ereg_replace("[^-\/\|\._0-9a-zA-Z]","",$onhold_prompt_filename);
	$hold_time_option_callback_filename = ereg_replace("[^-\/\|\._0-9a-zA-Z]","",$hold_time_option_callback_filename);
	$agent_alert_exten = ereg_replace("[^-\|\/\._0-9a-zA-Z]","",$agent_alert_exten);
	$filename = ereg_replace("[^-\/\._0-9a-zA-Z]","",$filename);
	$am_message_exten = ereg_replace("[^-\|\/\._0-9a-zA-Z]","",$am_message_exten);
	$am_message_exten_override = ereg_replace("[^-\|\/\._0-9a-zA-Z]","",$am_message_exten_override);

	### ALPHA-NUMERIC and underscore and dash and comma
	$logins_list = ereg_replace("[^-\,\_0-9a-zA-Z]","",$logins_list);
	$forced_timeclock_login = ereg_replace("[^-\,\_0-9a-zA-Z]","",$forced_timeclock_login);

	### ALPHA-NUMERIC and dots
	$sounds_web_server = ereg_replace("[^\.0-9a-zA-Z]","",$sounds_web_server);
	### ALPHA-NUMERIC and spaces
	$lead_order = ereg_replace("[^ 0-9a-zA-Z]","",$lead_order);
	### ALPHA-NUMERIC and hash
	$group_color = ereg_replace("[^\#0-9a-zA-Z]","",$group_color);
	### ALPHA-NUMERIC and hash and star and dot and underscore
	$hold_time_option_exten = ereg_replace("[^\*\#\.\_0-9a-zA-Z]","",$hold_time_option_exten);
	$did_pattern = ereg_replace("[^\*\#\.\_0-9a-zA-Z]","",$did_pattern);
	$voicemail_ext = ereg_replace("[^\*\#\.\_0-9a-zA-Z]","",$voicemail_ext);
	$phone = ereg_replace("[^\*\#\.\_0-9a-zA-Z]","",$phone);
	$phone_code = ereg_replace("[^\*\#\.\_0-9a-zA-Z]","",$phone_code);

	### ALPHA-NUMERIC and spaces dots, commas, dashes, underscores
	$adaptive_dl_diff_target = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$adaptive_dl_diff_target);
	$adaptive_intensity = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$adaptive_intensity);
	$asterisk_version = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$asterisk_version);
	$call_time_comments = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$call_time_comments);
	$call_time_name = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$call_time_name);
	$campaign_name = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$campaign_name);
	$campaign_rec_filename = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$campaign_rec_filename);
	$ingroup_rec_filename = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$ingroup_rec_filename);
	$company = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$company);
	$full_name = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$full_name);
	$fullname = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$fullname);
	$group_name = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$group_name);
	$HKstatus = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$HKstatus);
	$lead_filter_comments = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$lead_filter_comments);
	$lead_filter_name = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$lead_filter_name);
	$list_name = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$list_name);
	$local_gmt = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$local_gmt);
	$phone_type = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$phone_type);
	$picture = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$picture);
	$script_comments = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$script_comments);
	$script_name = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$script_name);
	$server_description = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$server_description);
	$status = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$status);
	$status_name = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$status_name);
	$wrapup_message = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$wrapup_message);
	$pause_code_name = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$pause_code_name);
	$campaign_description = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$campaign_description);
	$list_description = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$list_description);
	$vcl_name = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$vcl_name);
	$vsc_name = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$vsc_name);
	$vsc_description = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$vsc_description);
	$code_name = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$code_name);
	$alias_name = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$alias_name);
	$shift_name = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$shift_name);
	$did_description = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$did_description);
	$alt_server_ip = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$alt_server_ip);
	$template_name = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$template_name);
	$carrier_name = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$carrier_name);
	$group_alias_name = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$group_alias_name);
	$caller_id_name = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$caller_id_name);
	$user_code = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$user_code);
	$territory = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$territory);
	$tts_name = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$tts_name);
	$moh_name = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$moh_name);
	$timer_action_message = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$timer_action_message);

	### ALPHA-NUMERIC and underscore and dash and slash and at and dot
	$call_out_number_group = ereg_replace("[^-\.\:\/\@\_0-9a-zA-Z]","",$call_out_number_group);
	$client_browser = ereg_replace("[^-\.\:\/\@\_0-9a-zA-Z]","",$client_browser);
	$DBX_server = ereg_replace("[^-\.\:\/\@\_0-9a-zA-Z]","",$DBX_server);
	$DBY_server = ereg_replace("[^-\.\:\/\@\_0-9a-zA-Z]","",$DBY_server);
	$dtmf_send_extension = ereg_replace("[^-\.\:\/\@\_0-9a-zA-Z]","",$dtmf_send_extension);
	$extension = ereg_replace("[^-\.\:\/\@\_0-9a-zA-Z]","",$extension);
	$install_directory = ereg_replace("[^-\.\:\/\@\_0-9a-zA-Z]","",$install_directory);
	$old_extension = ereg_replace("[^-\.\:\/\@\_0-9a-zA-Z]","",$old_extension);
	$telnet_host = ereg_replace("[^-\.\:\/\@\_0-9a-zA-Z]","",$telnet_host);
	$queuemetrics_dbname = ereg_replace("[^-\.\:\/\@\_0-9a-zA-Z]","",$queuemetrics_dbname);
	$queuemetrics_login = ereg_replace("[^-\.\:\/\@\_0-9a-zA-Z]","",$queuemetrics_login);
	$queuemetrics_pass = ereg_replace("[^-\.\:\/\@\_0-9a-zA-Z]","",$queuemetrics_pass);
	$email = ereg_replace("[^-\.\:\/\@\_0-9a-zA-Z]","",$email);
	$vtiger_dbname = ereg_replace("[^-\.\:\/\@\_0-9a-zA-Z]","",$vtiger_dbname);
	$vtiger_login = ereg_replace("[^-\.\:\/\@\_0-9a-zA-Z]","",$vtiger_login);
	$vtiger_pass = ereg_replace("[^-\.\:\/\@\_0-9a-zA-Z]","",$vtiger_pass);
	$custom_one = ereg_replace("[^-\.\:\/\@\_0-9a-zA-Z]","",$custom_one);
	$custom_two = ereg_replace("[^-\.\:\/\@\_0-9a-zA-Z]","",$custom_two);
	$custom_three = ereg_replace("[^-\.\:\/\@\_0-9a-zA-Z]","",$custom_three);
	$custom_four = ereg_replace("[^-\.\:\/\@\_0-9a-zA-Z]","",$custom_four);
	$custom_five = ereg_replace("[^-\.\:\/\@\_0-9a-zA-Z]","",$custom_five);

	$extension_from	= ereg_replace("[^-\.\:\/\@\_0-9a-zA-Z]","",$extension_from);
	$extension_to		= ereg_replace("[^-\.\:\/\@\_0-9a-zA-Z]","",$extension_to);

	### NUMERIC and comma and pipe
	$waitforsilence_options = ereg_replace("[^\|\,0-9]","",$waitforsilence_options);

	### value cleaning
	$no_agent_action_value = ereg_replace("[^-\/\|\_\#\*\,\.\_0-9a-zA-Z]","",$no_agent_action_value);

	### ALPHA-NUMERIC and underscore and dash and slash and at and space and colon
	$vdc_header_date_format = ereg_replace("[^- \:\/\_0-9a-zA-Z]","",$vdc_header_date_format);
	$vdc_customer_date_format = ereg_replace("[^- \:\/\_0-9a-zA-Z]","",$vdc_customer_date_format);
	$menu_name = ereg_replace("[^- \:\/\_0-9a-zA-Z]","",$menu_name);

	### ALPHA-NUMERIC and underscore and dash and at and space and parantheses
	$vdc_header_phone_format = ereg_replace("[^- \(\)\_0-9a-zA-Z]","",$vdc_header_phone_format);

	### remove semi-colons ###
	$lead_filter_sql = ereg_replace(";","",$lead_filter_sql);
	$list_mix_container = ereg_replace(";","",$list_mix_container);
	$survey_response_digit_map = ereg_replace(";","",$survey_response_digit_map);
	$survey_camp_record_dir = ereg_replace(";","",$survey_camp_record_dir);
	$conf_override = ereg_replace(";","",$conf_override);
	$template_contents = ereg_replace(";","",$template_contents);
	$registration_string = ereg_replace(";","",$registration_string);
	$account_entry = ereg_replace(";","",$account_entry);
	$account_entry = ereg_replace("\r","",$account_entry);
	$globals_string = ereg_replace(";","",$globals_string);
	$dialplan_entry = ereg_replace(";","",$dialplan_entry);
	$dialplan_entry = ereg_replace("\r","",$dialplan_entry);
	$custom_dialplan_entry = ereg_replace("\\\\","",$custom_dialplan_entry);
	$custom_dialplan_entry = ereg_replace(";","",$custom_dialplan_entry);
	$custom_dialplan_entry = ereg_replace("\r","",$custom_dialplan_entry);
	$tts_text = ereg_replace("\\\\","",$tts_text);
	$tts_text = ereg_replace(";","",$tts_text);
	$tts_text = ereg_replace("\r","",$tts_text);
	$tts_text = ereg_replace("\"","",$tts_text);
	$carrier_description = ereg_replace("\\\\","",$carrier_description);
	$carrier_description = ereg_replace(";","",$carrier_description);
	$carrier_description = ereg_replace("\r","",$carrier_description);
	$carrier_description = ereg_replace("\"","",$carrier_description);


	### VARIABLES TO BE mysql_real_escape_string ###
	# $web_form_address
	# $queuemetrics_url
	# $admin_home_url
	# $qc_web_form_address
	# $vtiger_url
	# $web_form_address_two
	# $crm_login_address
	# $start_call_url
	# $dispo_call_url

	### VARIABLES not filtered at all ###
	# $script_text

	}	# end of non_latin
else
	{
	$PHP_AUTH_PW = ereg_replace("'|\"|\\\\|;","",$PHP_AUTH_PW);
	$PHP_AUTH_USER = ereg_replace("'|\"|\\\\|;","",$PHP_AUTH_USER);
	}



##### END VARIABLE FILTERING FOR SECURITY #####


# CCMS database administration
# admin.php
# 
# CHANGELOG:
# 50315-1110 - Added Custom Campaign Call Result
# 50317-1438 - Added Fronter Display var to inbound groups
# 50322-1355 - Added custom callerID per campaign
# 50517-1356 - Added user_groups sections and user_group to vicidial_users
# 50517-1440 - Added ability to logout (must click OK with empty user/pass)
# 50602-1622 - Added lead loader pages to load new files into vicidial_list
# 50620-1351 - Added custom vdad transfer AGI extension per campaign
# 50810-1414 - modified in groups to kick out spaces and dashes
# 50908-2136 - Added Custom Campaign HotKeys
# 50914-0950 - Fixed user search by user_group
# 50926-1358 - Modified to allow for language translation
# 50926-1615 - Added WeBRooTWritablE write controls
# 51020-1008 - Added editable web address and park ext - NEW dial campaigns
# 51020-1056 - Added fields and help for campaign recording control
# 51123-1335 - Altered code to function in php globals=off
# 51208-1038 - Added user_level changes, function controls and default user phones
# 51208-1556 - Added deletion of users/lists/campaigns/in groups/remote agents
# 51213-1706 - Added add/delete/modify vicidial scripts
# 51214-1737 - Added preview of vicidial script in popup window
# 51219-1225 - Added campaign and ingroups script selector and get_call_launch field
# 51222-1055 - Added am_message_exten to campaigns to allow for AM Message button
# 51222-1125 - Fixed new vicidial_campaigns default values not being assigned bug
# 51222-1156 - Added LOG OUT ALL AGENTS ON THIS CAMPAIGN button to campaign screen
# 60204-0659 - Fixed hopper reset bug
# 60207-1413 - Added AMD send to voicemail extension and xfer-conf dtmf presets
# 60213-1100 - Added several vicidial_users permissions fields
# 60215-1319 - Added On-hold CallBacks display and links
# 60227-1226 - Fixed vicidial_inbound_groups insert bug
# 60413-1308 - Fixed list display to have 1 row/status: count and time zone tables
#            - Added status name in selected dial Call Result in campaign screen
# 60417-1416 - Added vicidial_lead_filters sections
#            - Changed the header links to color-coded sectional with sublinks below
#            - Added filter name and script name to campaign and in-group modify sections
#            - Added callback and alt dial options to campaigns section
#            - Added callback, alt dial and other options to users section
# 60419-1628 - Alter Callbacks display to include status and LIVE listings, reordered
# 60421-1441 - check GET/POST vars lines with isset to not trigger PHP NOTICES
# 60425-2355 - Added agent options to vicidial_users, reformatted user page
# 60502-1627 - Added drop_call_seconds and safe_harbor_ fields to campaign screen
# 60503-1228 - Added drop_call_seconds and drop_ fields to inbound groups screen
# 60505-1117 - Added initial framework for new local_call_times tables and definitions
# 60506-1033 - More revisions to the local_call_time section
# 60508-1354 - Finished call_times and state_call_times sections
#            - Added modify/delete options for call_times
# 60509-1311 - Functionalize campaign dialable leads calculation
#            - Change state_call_times selection from call_times to only allow one per state
#            - Added dialable leads count popup to campaign screen if auto-calc is disabled
#            - Added test dialable leads count popup to filter screen 
# 60510-1050 - Added Wrapup seconds and Wrapup message to campaigns screen
# 60608-1401 - Added allowable inbound_groups checkboxes to CLOSER campaign detail screen
# 60609-1051 - Added add-to-dnc in LISTS section
# 60613-1415 - Added lead recycling options to campaign detail screen
# 60619-1523 - Added variable filtering to eliminate SQL injection attack threat
# 60622-1216 - Fixed HotKey addition form issues and variable filtering
# 60623-1159 - Fixed Scheduled Callbacks over-filtering bug and filter_sql bug
# 60808-1147 - Changed filtering for and added instructions for consutative transfers
# 60816-1552 - Added allcalls_delay start delay for recordings in vicidial.php
# 60817-2226 - Fixed bug that would not allow lead recycling of non-selectable Call Result
# 60821-1543 - Added option to Omit Phone Code while dialing in vicidial
# 60821-1625 - Added ALLFORCE recording option for campaign_recording
# 60823-1154 - Added fields for adaptive dialing
# 60824-1326 - Added adaptive_latest_target_gmt for ADAPT_TAPERED dial method
# 60825-1205 - Added adaptive_intensity for ADAPT_ dial methods
# 60828-1019 - Changed adaptive_latest_target_gmt to adaptive_latest_server_time
# 60828-1115 - Added adaptive_dl_diff_target and changed intensity dropdown
# 60927-1246 - Added astguiclient/admin.php functions under SERVERS tab
# 61002-1402 - Added fields for vicidial balance trunk controls
# 61003-1123 - Added functions for vicidial_server_trunks records
# 61109-1022 - Added Emergency VDAC Jam Clear function to Campaign Detail screen
# 61110-1502 - Add ability to select NONE in dial Call Result, new list_id must not be < 100
# 61122-1228 - Added user group campaign restrictions
# 61122-1535 - Changed script_text to unfiltered and added more variables to SCRIPTS
# 61129-1028 - Added headers to Users and Phones with clickable order-by titles
# 70108-1405 - Added ADAPT OVERRIDE to allow for forced dial_level changes in ADAPT dial methods
#            - Screen width definable at top of script, merged server_stats into this script
# 70109-1638 - Added ALTPH2 and ADDR3 hotkey options for alt number dialing with HotKeys
# 70109-1716 - Added concurrent_transfers option to vicidial_campaigns
# 70115-1152 - Aded (CLOSER|BLEND|INBND|_C$|_B$|_I$) options for CLOSER-type campaigns
# 70115-1532 - Added auto_alt_dial field to campaign screen for auto-dialing of alt numbers
# 70116-1200 - Added auto_alt_dial_status functionality to campaign screen
# 70117-1235 - Added header formatting variables at top of script
#            - Moved Call Times and Phones/Server functions to Admin section
# 70118-1706 - Added new user group displays and links
# 70123-1519 - Added user permission settings for all sections
# 70124-1346 - Fixed spelling errors and formatting consistency
# 70202-1120 - Added agent_pause_codes section to campaigns
# 70205-1204 - Added memo, last dialed, timestamp and stats-refresh fields to vicidial_campaigns/lists
# 70206-1323 - Added user setting for vicidial_recording_override
# 70212-1412 - Added system settings section
# 70214-1226 - Added QueueMetrics Log ID field to system settings section
# 70219-1102 - Changed campaign dial Call Result to be one string allowing for high limit
# 70223-0957 - Added queuemetrics_eq_prepend for custom ENTERQUEUE prepending of a field
# 70302-1111 - Fixed small bug in dialable leads calculation
# 70314-1133 - Added insert selection on script forms
# 70319-1423 - Added Alter Customer Data and agent disable display functions
# 70319-1625 - Added option to allow agents to login to outbound campaigns with no leads in the hopper
# 70322-1455 - Added sipsak messages parameters
# 70402-1157 - Added HOME link and entry to system_settings table, added QM link on reports section
# 70516-1628 - Started reformatting campaigns to use submenus to break up options
# 70529-1653 - Added help for list mix
# 70530-1354 - Added human_answered field to Call Result, added system status modification
# 70530-1714 - Added lists for all campaign subsections
# 70531-1631 - Development on List mix admin interface
# 70601-1629 - More development on List mix admin interface, formatting, and added some javascript
# 70602-1300 - More development on List mix admin interface, more javascript
# 70608-1459 - Added option to set LIVE Callbacks to INACTIVE after one month
# 70612-1451 - Added Callback INACTIVE link for after one week, sort by user/group/entrydate
# 70614-0231 - Added Status Categories, ability to Modify Call Result, moved system Call Result to sub-section
# 70623-1008 - List Mix section now allows modification of list mix entries
# 70629-1721 - List Mix section adding and removing of list entries active
# 70706-1636 - List Mix section cleanup and more error-checking
# 70908-0941 - Added agc logile enable system_settings
# 71020-1934 - Added inbound groups options: on-hold music, messages, call_times
# 71022-1343 - Added inbound group ranks for users
# 71029-1710 - Added option for campaign to be inbound and/or blended with no restrictions on the campaign_id name
#            - Added 5th NEW and 6th NEW to the dial order options
# 71030-2010 - Added Manual Dial List ID field to campaigns table
# 71103-2207 - Added inbound_group_rank and fewest_calls to the inbound groups call order options
# 71113-1521 - Added campaign_rank to agent options
#            - Added ability to Copy a campaign's setting to a new campaign
# 71113-2225 - Added ability to copy user and in-group settings to new users and in-groups
# 71116-0942 - Added campaign_rank and fewest_calls as methods for agent call routing
# 71122-1135 - Added default transfer group for campaigns and inbound groups
# 71125-1751 - Added allowable transfer groups to campaign detail screen
# 80107-1204 - Started framework for new QC section
# 80112-0242 - Added more options for lead order
# 80211-1901 - Added DB Schema Version to system settings display
# 80224-1334 - Added Queue Priority to in-groups and campaigns
# 80302-0232 - added drop_action and transfer to in-group for both in-groups and outbound
# 80310-1504 - added QC settings section to campaign screen
# 80317-2037 - Added Recording override settings to in-groups
# 80414-1505 - More work on QC, added vicidial_qc_codes
# 80424-0442 - Added non_latin system_settings lookup at top to override dbconnect setting
# 80505-0333 - Added phones_alias sections to allow for load-balanced-phone-logins
# 80512-1529 - Added auto-generate of User ID feature
# 80515-1345 - Added Shifts sub-section to Admin section
# 80528-0001 - Added campaign survey sub-section
# 80528-1102 - Added user timeclock edit options
# 80608-1304 - Changed add-to-DNC to allow for multiple entries per submission
# 80625-0032 - Added time/phone display format options to system settings
# 80703-0124 - Added alter cust phone and api settings
# 80715-1130 - Added Recycle leads limit count
# 80719-1351 - Changed QC settings in campaigns and In-Groups
# 80809-2305 - Added Sale and Dead Lead categories to status categories page
# 80815-1036 - Added manual dial filter to capaigns
# 80823-2124 - Added copy to clipboard campaign option
# 80829-2359 - Added EXTENDED auto_alt_dial options
# 80831-0406 - Added agent screen extended alt-dial option to campaigns
# 80909-0553 - Added campaign-specific DNC list option and add
# 81002-1101 - Added more in-group options and new DID section and user options
# 81007-0936 - Added three_way_call_cid option to campaigns
# 81012-1725 - Added INBOUND_MAN dial method allowing for manual list dialing with inbound calls
# 81030-0348 - Added campaign pause code force option
# 81030-2228 - Fixed DIDs creation issue
# 81103-1408 - Added 3way call dial prefix option
# 81107-1551 - Added Stats Percent of Calls Answered Within X seconds fields to in-groups
# 81118-0933 - Changed lists listing with links and more options
# 81119-0715 - Added ability to bulk enable/disable lists from modify campaign screen
# 81209-1538 - Added web_form_target to campaign screen
# 81210-1430 - Added http server IP and recording link options to servers
# 81222-0500 - Reformatted all listings to same format changed to field selects instead of *
# 81228-2300 - Added fields for vtiger integration and active vicidial_user display
# 90101-1216 - Added options for user synchronization with vtiger
# 90112-0335 - Added vtiger_create_lead_record and vtiger_create_lead_record options
# 90115-0502 - Activated AGENT DID routing option
# 90126-2256 - Added vtiger_screen_login campaign option and user agent alert option
# 90201-1503 - Added option to disable the viewing of inactive QC features
# 90202-0112 - Added option to disable outbound autodialing(or list dialing)
# 90202-0444 - Added cpd_amd_action option for processing of AMD messages
# 90209-1339 - Added download_lists option to allow downloading of lists
# 90210-1042 - Added options for auto-generation of asterisk conf files
# 90301-2026 - Added Vtiger group synchronization
# 90302-2046 - Changed Section heading to be on the left side of the screen
# 90303-0631 - Added web vars to agent campaign and in-group settings
# 90303-2047 - Added group aliases and default group aliases
# 90306-1214 - Added shift enforcement and server/system calls per second options
# 90308-0956 - Added server statistics
# 90309-0059 - Changed logging to admin_server_log
# 90310-2203 - Added export_reports option for call activity report data exports
# 90315-1010 - Changed revision for new trunk 2.2.0
# 90320-0424 - Fixed several small bugs conf records group alias and permissions
# 90322-0122 - Added ability to delete from the DNC lists
# 90322-1105 - Added new status settings and vtiger options
# 90409-2133 - Fixed special characters in SCRIPTS
# 90413-0755 - Fixed filter and script slashes issues
# 90417-0211 - Fixed filter and script slashes issues
# 90422-0613 - Added user_code, territory and email to vicidial_users
# 90429-0542 - Added 3rd&4th options to SURVEY campaigns
# 90430-0154 - Added RANDOM and LAST CALL TIME options to lead order for campaigns
# 90504-0901 - Added IVR feature, changed script to use long PHP tags
# 90511-0910 - Added agentonly_callback_campaign_lock to system_settings
# 90512-0440 - Added sounds settings to system_settings table
# 90514-0607 - Added select prompts from list in IVR and in-group screens
# 90521-0029 - Added user territories enable option
# 90522-0506 - Security fix for logins when using non-latin setting
# 90524-2307 - Changed Reports screen layout
# 90528-2055 - Added ViciDial recording limit field in servers and phone_context to phones
# 90530-1206 - Changed List Mix to allow for 40 mixes
# 90531-1802 - Added auto-generated options for users, campaigns, in-groups, etc..., added option to HIDE custphone
# 90531-2339 - Added Dynamic options for IVR
# 90605-0248 - Added carrier_logging_active servers option
# 90607-1716 - Changed drop percent limit to allow for 0.1 steps under 3%
# 90608-0944 - Added Drop Lockout Time feature to Campaign Detail Modification screen
# 90612-0909 - Added audio prompt selection feature to survey screen
# 90614-0827 - Added In-Group routing to IVR screen, Added pull-down IVR option to DID screen
# 90617-0733 - Added phone ring timeout and IVR custom dialplan entries
# 90621-0821 - Added phone Conf File Secret field to use a separate password from the user interface for a phone
# 90621-1220 - Added IVR logging tracking_group
# 90627-0547 - Added no-agent-no-queue options
# 90627-2333 - Added default transfer button and prepopulate preset options
# 90628-0924 - Added Text To Speech(TTS) fields
# 90628-2213 - Added Multi-campaign drop rate groups
# 90705-0926 - Added User Group agent view options
# 90710-1528 - Added Agent view and grab queue calls and every call pause options
# 90717-0646 - Added dialed_label and dialed_number to script variables
# 90721-1350 - Added RANK and OWNER as list order options and list screen display tables
# 90722-1235 - Added list reset time and campaign no hopper dialing, agent dial owner only options
# 90726-0153 - Added allow_alerts for users to disable agent browser alerts
# 90729-0555 - Added agent_display_dialable_leads and vicidial_balance_rank options
# 90808-0300 - Added longest_wait_time option for agent call routing
# 90827-1552 - Added agent_script_override option for lists
# 90830-2217 - Added Music On Hold section
# 90904-1536 - Added moh chooser option, timezone list ordering
# 90908-1207 - Added cross-listing linking for DIDs, CallMenus and In-groups
# 90916-1105 - Added second web form to ingroups and campaigns and added audio choose for answering machine message and waitforsilence_options
# 90917-1108 - Added Extra Voicemail boxes config in Admin section
# 90919-2251 - Removed all SELECT STAR instances in the code, code cleanup to conform to standard
# 90924-1645 - Added list_id overrides for cid, am_message and drop in-group
# 90930-2107 - Added agent territory selection options for ViciDial agents
# 91026-1050 - Added AREACODE DNC option for campaigns
# 91031-1232 - Added carrier_description field, campaigns links from in-group screen, server links on reports page, agent ranks listing active only
# 91121-0334 - Limited list called count display to 100+
# 91125-0628 - Added conf_secret for servers
# 91204-1652 - Added recording_filename and recording_id as script variables
# 91205-2231 - Added delete_vm_after_email voicemail option to phones and extra voicemail sections
# 91210-2038 - Added better logging of Campaign emergency logout
# 91211-1359 - Added custom user fields and campaign CRM login fields
# 91219-0719 - Changed some field backgrounds in the Campaign Modification screens
# 91223-1031 - Added VIDPROMPT options for in-group routing in DIDs
# 91228-1837 - Added timer action settings to in-groups and campaigns
# 100103-0727 - Added Start/Dispo call url, 3/4/5 conf number presets, Lists conf-number overrides
# 100104-1454 - Fixed in-group/campaign copy duplication issue
# 100116-0718 - Added presets to script select list
# 100319-1708 - Changed user/pass for users to 20 characters in length, highlighted conf file secret in phones
# 100413-2328 - several small fixes, logging, removal of old SIP/IAX monitor/barge links
# 100510-2015 - prep for 2.2.1 release
#
# make sure you have added a user to the vicidial_users MySQL table with at least user_level 8 to access this page the first time

$admin_version = '2.2.1-237';
$build = '100510-2015';

$STARTtime = date("U");
$SQLdate = date("Y-m-d H:i:s");
$REPORTdate = date("Y-m-d");
$MT[0]='';
$US='_';
$active_lists=0;
$inactive_lists=0;

$month_old = mktime(0, 0, 0, date("m")-1, date("d"),  date("Y"));
$past_month_date = date("Y-m-d H:i:s",$month_old);
$week_old = mktime(0, 0, 0, date("m"), date("d")-7,  date("Y"));
$past_week_date = date("Y-m-d H:i:s",$week_old);

$dtmf[0]='0';			$dtmf_key[0]='0';
$dtmf[1]='1';			$dtmf_key[1]='1';
$dtmf[2]='2';			$dtmf_key[2]='2';
$dtmf[3]='3';			$dtmf_key[3]='3';
$dtmf[4]='4';			$dtmf_key[4]='4';
$dtmf[5]='5';			$dtmf_key[5]='5';
$dtmf[6]='6';			$dtmf_key[6]='6';
$dtmf[7]='7';			$dtmf_key[7]='7';
$dtmf[8]='8';			$dtmf_key[8]='8';
$dtmf[9]='9';			$dtmf_key[9]='9';
$dtmf[10]='HASH';		$dtmf_key[10]='#';
$dtmf[11]='STAR';		$dtmf_key[11]='*';
$dtmf[12]='A';			$dtmf_key[12]='A';
$dtmf[13]='B';			$dtmf_key[13]='B';
$dtmf[14]='C';			$dtmf_key[14]='C';
$dtmf[15]='D';			$dtmf_key[15]='D';
$dtmf[16]='TIMECHECK';	$dtmf_key[16]='TIMECHECK';
$dtmf[17]='TIMEOUT';	$dtmf_key[17]='TIMEOUT';
$dtmf[18]='INVALID';	$dtmf_key[18]='INVALID';

if ($force_logout)
	{
	if( (strlen($PHP_AUTH_USER)>0) or (strlen($PHP_AUTH_PW)>0) )
		{
		Header("WWW-Authenticate: Basic realm=\"CCMS\"");
		Header("HTTP/1.0 401 Unauthorized");
		}
	echo "<meta http-equiv=\"refresh\" content=\"0;URL=welcome.php\">";
	echo "You have now logged out. Thank you\n";
	unset($_SESSION['login']);
	if(strlen($PHP_AUTH_USER)>0){
		$NOW_TIME = date("Y-m-d H:i:s");
		$StarTtimE = date("U");
		$stmt="SELECT user_group from vicidial_users where user='$PHP_AUTH_USER';";
		$rslt=mysql_query($stmt, $link);
		$row=mysql_fetch_row($rslt);
		$user_group	=$row[0];
		$stmt = "INSERT INTO vicidial_user_log (user,event,campaign_id,event_date,event_epoch,user_group) values('$PHP_AUTH_USER','LOGOUT','Admin','$NOW_TIME','$StarTtimE','$user_group')";
		$rslt=mysql_query($stmt, $link);
	}
	exit;
	}

#############################################
##### START SYSTEM_SETTINGS LOOKUP #####
$stmt = "SELECT use_non_latin,auto_dial_limit,user_territories_active,allow_custom_dialplan FROM system_settings;";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$qm_conf_ct = mysql_num_rows($rslt);
if ($qm_conf_ct > 0)
	{
	$row=mysql_fetch_row($rslt);
	$non_latin =					$row[0];
	$SSauto_dial_limit =			$row[1];
	$SSuser_territories_active =	$row[2];
	$SSallow_custom_dialplan =		$row[3];
	}
##### END SETTINGS LOOKUP #####
###########################################

$stmt="SELECT count(*) from vicidial_users where BINARY user='$PHP_AUTH_USER' and BINARY pass='$PHP_AUTH_PW' and user_level >= 5 and active='Y';";

if ($DB) {echo "|$stmt|\n";}
if ($non_latin > 0) {$rslt=mysql_query("SET NAMES 'UTF8'");}
$rslt=mysql_query($stmt, $link);
$row=mysql_fetch_row($rslt);
$auth=$row[0];

if ($WeBRooTWritablE > 0)
	{$fp = fopen ("./project_auth_entries.txt", "a");}

$date = date("r");
$ip = getenv("REMOTE_ADDR");
$browser = getenv("HTTP_USER_AGENT");
if( (strlen($PHP_AUTH_USER)<2) or (strlen($PHP_AUTH_PW)<2) or ($auth<1))
	{
    Header("WWW-Authenticate: Basic realm=\"CCMS\"");
    Header("HTTP/1.0 401 Unauthorized");
    echo "Invalid Username/Password: |$PHP_AUTH_USER|$PHP_AUTH_PW|\n";
    exit;
	}
else
	{
	if($auth>0)
		{
		if(!isset($_SESSION['login'])){
			$_SESSION['login'] = true;
			$sql = "SELECT pwd_status FROM vicidial_users WHERE USER='$PHP_AUTH_USER'";
			$rslt=mysql_query($sql, $link);
			$row=mysql_fetch_row($rslt);
			$pwd_status	=$row[0];
			if($pwd_status == '0'){				
				$user=$PHP_AUTH_USER;
				$ADD=120329;
				}
			$NOW_TIME = date("Y-m-d H:i:s");
			$StarTtimE = date("U");
			$stmt="SELECT user_group from vicidial_users where user='$PHP_AUTH_USER';";
			$rslt=mysql_query($stmt, $link);
			$row=mysql_fetch_row($rslt);
			$user_group	=$row[0];
			$stmt = "INSERT INTO vicidial_user_log (user,event,campaign_id,event_date,event_epoch,user_group) values('$PHP_AUTH_USER','LOGIN','Admin','$NOW_TIME','$StarTtimE','$user_group')";
			$rslt=mysql_query($stmt, $link);
		}			
		
		$office_no=strtoupper($PHP_AUTH_USER);
		$password=strtoupper($PHP_AUTH_PW);
		$stmt="SELECT user_id,user,pass,full_name,user_level,user_group,phone_login,phone_pass,delete_users,delete_user_groups,delete_lists,delete_campaigns,delete_ingroups,delete_remote_agents,load_leads,campaign_detail,ast_admin_access,ast_delete_phones,delete_scripts,modify_leads,hotkeys_active,change_agent_campaign,agent_choose_ingroups,closer_campaigns,scheduled_callbacks,agentonly_callbacks,agentcall_manual,vicidial_recording,vicidial_transfers,delete_filters,alter_agent_interface_options,closer_default_blended,delete_call_times,modify_call_times,modify_users,modify_campaigns,modify_lists,modify_scripts,modify_filters,modify_ingroups,modify_usergroups,modify_remoteagents,modify_servers,view_reports,vicidial_recording_override,alter_custdata_override,qc_enabled,qc_user_level,qc_pass,qc_finish,qc_commit,add_timeclock_log,modify_timeclock_log,delete_timeclock_log,alter_custphone_override,vdc_agent_api_access,modify_inbound_dids,delete_inbound_dids,active,alert_enabled,download_lists,agent_shift_enforcement_override,manager_shift_enforcement_override,shift_override_flag,export_reports,delete_from_dnc,email,user_code,territory,allow_alerts,add_new_users,add_new_campaigns,add_new_lists,add_new_usergroups,add_from_dnc,view_historical_reports,live_monitor,search_historical_call,search_voice_mail,add_remoteagentgroups,modify_remoteagentgroups,delete_remoteagentgroups from vicidial_users where user='$PHP_AUTH_USER' and pass='$PHP_AUTH_PW';";
		$rslt=mysql_query($stmt, $link);
		$row=mysql_fetch_row($rslt);
		$LOGuser_id					=$row[0];
		$LOGuser_name_id			=$row[1];
		$LOGfull_name				=$row[3];
		$LOGuser_level				=$row[4];
		$LOGuser_group				=$row[5];
		$LOGdelete_users			=$row[8];
		$LOGdelete_user_groups		=$row[9];
		$LOGdelete_lists			=$row[10];
		$LOGdelete_campaigns		=$row[11];
		$LOGdelete_ingroups			=$row[12];
		$LOGdelete_remote_agents	=$row[13];
		$LOGload_leads				=$row[14];
		$LOGcampaign_detail			=$row[15];
		$LOGast_admin_access		=$row[16];
		$LOGast_delete_phones		=$row[17];
		$LOGdelete_scripts			=$row[18];
		$LOGdelete_filters			=$row[29];
		$LOGalter_agent_interface	=$row[30];
		$LOGdelete_call_times		=$row[32];
		$LOGmodify_call_times		=$row[33];
		$LOGmodify_users			=$row[34];
		$LOGmodify_campaigns		=$row[35];
		$LOGmodify_lists			=$row[36];
		$LOGmodify_scripts			=$row[37];
		$LOGmodify_filters			=$row[38];
		$LOGmodify_ingroups			=$row[39];
		$LOGmodify_usergroups		=$row[40];
		$LOGmodify_remoteagents		=$row[41];
		$LOGmodify_servers			=$row[42];
		$LOGview_reports			=$row[43];
		$LOGmodify_dids				=$row[56];
		$LOGdelete_dids				=$row[57];
		$LOGmanager_shift_enforcement_override=$row[61];
		$LOGexport_reports			=$row[64];
		$LOGdelete_from_dnc			=$row[65];
		
		$LOGadd_new_users			=$row[70];
		$LOGadd_new_campaigns		=$row[71];
		$LOGadd_new_lists			=$row[72];
		$LOGadd_new_usergroups		=$row[73];
		$LOGadd_from_dnc			=$row[74];
		$LOGview_historical_reports =$row[75];
		$LOGlive_monitor			=$row[76];
		$LOGsearch_historical_call	=$row[77];
		$LOGsearch_voice_mail = $row[78];
		$LOGadd_remoteagentgroups = $row[79];
		$LOGmodify_remoteagentgroups = $row[80];
		$LOGdelete_remoteagentgroups = $row[81];
		
		$_SESSION["LOGuser_id"]			=$LOGuser_id;
		$_SESSION["LOGfull_name"]		=$LOGfull_name;
		$_SESSION["LOGuser_level"]		=$LOGuser_level;
		$_SESSION["LOGuser_group"]		=$LOGuser_group;
		$_SESSION["LOGuser_id"]			=$LOGuser_id;

		$stmt="SELECT allowed_campaigns from vicidial_user_groups where user_group='$LOGuser_group';";
		$rslt=mysql_query($stmt, $link);
		$row=mysql_fetch_row($rslt);
		$LOGallowed_campaigns = $row[0];

		if ($WeBRooTWritablE > 0)
			{
			fwrite ($fp, "CCMS|GOOD|$date|$PHP_AUTH_USER|XXXX|$ip|$browser|$LOGfull_name|\n");
			fclose($fp);
			}
		}
	else
		{
		if ($WeBRooTWritablE > 0)
			{
			fwrite ($fp, "CCMS|FAIL|$date|$PHP_AUTH_USER|$PHP_AUTH_PW|$ip|$browser|\n");
			fclose($fp);
			}
		}
	}
	

######################################################################################################
######################################################################################################
#######   Header settings
######################################################################################################
######################################################################################################


header ("Content-type: text/html; charset=utf-8");
echo "<html>\n";
echo "<head>\n";
echo "<script language = \"JavaScript\" type=\"text/javascript\" src = \"js/user.js\"></script>";
echo "<!-- VERSION: $admin_version   BUILD: $build   ADD: $ADD   PHP_SELF: $PHP_SELF-->\n";
echo "<title>CCMS";

if (!isset($ADD))   {$ADD=0;}

if ($ADD=="1")			{$hh='users';}
if ($ADD=="1A")			{$hh='users';}
if ($ADD=="1C")			{$hh='users';}
if ($ADD=="2C")			{$hh='users';}
//add by fox about notice
if ($ADD=="423")			{$hh='notice';}
if ($ADD=="424")			{$hh='notice';}
if ($ADD=="427")			{$hh='notice';}
//end
if ($ADD==11)			{$hh='campaigns';	$sh='basic';}
if ($ADD==12)			{$hh='campaigns';	$sh='basic';}
if ($ADD==111)			{$hh='lists';}
if ($ADD==121)			{$hh='lists';}
if ($ADD==121121)		{$hh='lists';}
if ($ADD==1111)			{$hh='ingroups';}
if ($ADD==1211)			{$hh='ingroups';}
if ($ADD==1311)			{$hh='ingroups';}
if ($ADD==1411)			{$hh='ingroups';}
if ($ADD==1511)			{$hh='ingroups';}
if ($ADD==1611)			{$hh='ingroups';}
if ($ADD==11111)		{$hh='remoteagent';}
if ($ADD==111111)		{$hh='usergroups';}
if ($ADD==1111111)		{$hh='scripts';}
if ($ADD==11111111)		{$hh='filters';}
if ($ADD==111111111)	{$hh='admin';	$sh='times';}
if ($ADD==131111111)	{$hh='admin';	$sh='shifts';}
if ($ADD==1111111111)	{$hh='admin';	$sh='times';}
if ($ADD==11111111111)	{$hh='admin';	$sh='phones';}
if ($ADD==12111111111)	{$hh='admin';	$sh='phones';}
if ($ADD==13111111111)	{$hh='admin';	$sh='phones';}
if ($ADD==17111111111)	{$hh='admin';	$sh='phones';}
if ($ADD==111111111111)	{$hh='admin';	$sh='server';}
if ($ADD==131111111111)	{$hh='admin';	$sh='templates';}
if ($ADD==141111111111)	{$hh='admin';	$sh='carriers';}
if ($ADD==151111111111)	{$hh='admin';	$sh='tts';}
if ($ADD==161111111111)	{$hh='admin';	$sh='moh';}
if ($ADD==171111111111)	{$hh='admin';	$sh='vm';}
if ($ADD==1111111111111)	{$hh='admin';	$sh='conference';}
if ($ADD==11111111111111)	{$hh='admin';	$sh='conference';}
if ($ADD=='2')			{$hh='users';}
if ($ADD=='2A')			{$hh='users';}
if ($ADD=='2C')			{$hh='users';}
if ($ADD==20)			{$hh='campaigns';	$sh='basic';;}
if ($ADD==21)			{$hh='campaigns';	$sh='basic';}
if ($ADD==22)			{$hh='campaigns';	$sh='status';}
if ($ADD==23)			{$hh='campaigns';	$sh='hotkey';}
if ($ADD==25)			{$hh='campaigns';	$sh='recycle';}
if ($ADD==26)			{$hh='campaigns';	$sh='autoalt';}
if ($ADD==27)			{$hh='campaigns';	$sh='pause';}
if ($ADD==28)			{$hh='campaigns';	$sh='dialstat';}
if ($ADD==29)			{$hh='campaigns';	$sh='listmix';}
if ($ADD==211)			{$hh='lists';}
if ($ADD==2111)			{$hh='ingroups';}
if ($ADD==2011)			{$hh='ingroups';}
if ($ADD==2311)			{$hh='ingroups';}
if ($ADD==2411)			{$hh='ingroups';}
if ($ADD==2511)			{$hh='ingroups';}
if ($ADD==2611)			{$hh='ingroups';}
if ($ADD==21111)		{$hh='remoteagent';}
if ($ADD==211111)		{$hh='usergroups';}
if ($ADD==2111111)		{$hh='scripts';}
if ($ADD==21111111)		{$hh='filters';}
if ($ADD==211111111)	{$hh='admin';	$sh='times';}
if ($ADD==231111111)	{$hh='admin';	$sh='shifts';}
if ($ADD==2111111111)	{$hh='admin';	$sh='times';}
if ($ADD==21111111111)	{$hh='admin';	$sh='phones';}
if ($ADD==22111111111)	{$hh='admin';	$sh='phones';}
if ($ADD==23111111111)	{$hh='admin';	$sh='phones';}
if ($ADD==71111111111)	{$hh='admin';	$sh='phones';}
if ($ADD==211111111111)	{$hh='admin';	$sh='server';}
if ($ADD==221111111111)	{$hh='admin';	$sh='server';}
if ($ADD==231111111111)	{$hh='admin';	$sh='templates';}
if ($ADD==241111111111)	{$hh='admin';	$sh='carriers';}
if ($ADD==251111111111)	{$hh='admin';	$sh='tts';}
if ($ADD==261111111111)	{$hh='admin';	$sh='moh';}
if ($ADD==271111111111)	{$hh='admin';	$sh='vm';}
if ($ADD==2111111111111)	{$hh='admin';	$sh='conference';}
if ($ADD==21111111111111)	{$hh='admin';	$sh='conference';}
if ($ADD==221111111111111)	{$hh='admin';	$sh='status';}
if ($ADD==231111111111111)	{$hh='admin';	$sh='status';}
if ($ADD==241111111111111)	{$hh='admin';	$sh='status';}
if ($ADD==3)			{$hh='users';}
if ($ADD==30)			{$hh='campaigns';}
if ($ADD==31)			
	{
	$hh='campaigns';	$sh='detail';;
	}
if ($ADD==34)
	{
	$hh='campaigns';	$sh='basic';

	}
if ($ADD==32)			{$hh='campaigns';	$sh='status';}
if ($ADD==33)			{$hh='campaigns';	$sh='hotkey';}
if ($ADD==35)			{$hh='campaigns';	$sh='recycle';}
if ($ADD==36)			{$hh='campaigns';	$sh='autoalt';}
if ($ADD==37)			{$hh='campaigns';	$sh='pause';}
if ($ADD==377)			{$hh='lists';	$sh='pause';}
if ($ADD==377111)			{$hh='lists';	$sh='pause';}
if ($ADD==377222)			{$hh='lists';	$sh='pause';}
if ($ADD==377333)			{$hh='lists';	$sh='pause';}
if ($ADD==3777)			{$hh='admin';	$sh='pause';}
if ($ADD==38)			{$hh='campaigns';	$sh='dialstat';}
if ($ADD==39)			{$hh='campaigns';	$sh='listmix';}
if ($ADD==311)			{$hh='lists';}
if ($ADD==3111)			{$hh='ingroups';}
if ($ADD==3311)			{$hh='ingroups';}
if ($ADD==3511)			{$hh='ingroups';}
if ($ADD==35113511)			{$hh='ingroups';}
if ($ADD==31111)		{$hh='remoteagent';}
if ($ADD==311111)		{$hh='usergroups';}
if ($ADD==3111111)		{$hh='scripts';}
if ($ADD==31111111)		{$hh='filters';}
if ($ADD==311111111)	{$hh='admin';	$sh='times';}
if ($ADD==321111111)	{$hh='admin';	$sh='times';}
if ($ADD==331111111)	{$hh='admin';	$sh='shifts';}
if ($ADD==3111111111)	{$hh='admin';	$sh='times';}
if ($ADD==31111111111)	{$hh='admin';	$sh='phones';}
if ($ADD==32111111111)	{$hh='admin';	$sh='phones';}
if ($ADD==33111111111)	{$hh='admin';	$sh='phones';}
if ($ADD==311111111111)	{$hh='admin';	$sh='server';}
if ($ADD==331111111111)	{$hh='admin';	$sh='templates';}
if ($ADD==341111111111)	{$hh='admin';	$sh='carriers';}
if ($ADD==351111111111)	{$hh='admin';	$sh='tts';}
if ($ADD==361111111111)	{$hh='admin';	$sh='moh';}
if ($ADD==371111111111)	{$hh='admin';	$sh='vm';}
if ($ADD==3111111111111)	{$hh='admin';	$sh='conference';}
if ($ADD==31111111111111)	{$hh='admin';	$sh='conference';}
if ($ADD==311111111111111)	{$hh='admin';	$sh='settings';}
if ($ADD==321111111111111)	{$hh='admin';	$sh='status';}
if ($ADD==331111111111111)	{$hh='admin';	$sh='status';}
if ($ADD==341111111111111)	{$hh='admin';	$sh='status';}
if ($ADD=="4A")			{$hh='users';}
if ($ADD=="4B")			{$hh='users';}
if ($ADD==4)			{$hh='users';}
if ($ADD==41)			{$hh='campaigns';	$sh='detail';}
if ($ADD==42)			{$hh='campaigns';	$sh='status';}
if ($ADD==43)			{$hh='campaigns';	$sh='hotkey';}
if ($ADD==44)			{$hh='campaigns';	$sh='basic';}
if ($ADD==45)			{$hh='campaigns';	$sh='recycle';}
if ($ADD==47)			{$hh='campaigns';	$sh='pause';}
if ($ADD==48)			{$hh='campaigns';	$sh='qc';}
if ($ADD==49)			{$hh='campaigns';	$sh='listmix';}
if ($ADD=='40A')		{$hh='campaigns';	$sh='survey';}
if ($ADD==411)			{$hh='lists';}
if ($ADD==4111)			{$hh='ingroups';}
if ($ADD==4311)			{$hh='ingroups';}
if ($ADD==4511)			{$hh='ingroups';}
if ($ADD==41111)		{$hh='remoteagent';}
if ($ADD==411111)		{$hh='usergroups';}
if ($ADD==4111111)		{$hh='scripts';}
if ($ADD==41111111)		{$hh='filters';}
if ($ADD==411111111)	{$hh='admin';	$sh='times';}
if ($ADD==431111111)	{$hh='admin';	$sh='shifts';}
if ($ADD==4111111111)	{$hh='admin';	$sh='times';}
if ($ADD==41111111111)	{$hh='admin';	$sh='phones';}
if ($ADD==42111111111)	{$hh='admin';	$sh='phones';}
if ($ADD==43111111111)	{$hh='admin';	$sh='phones';}
if ($ADD==411111111111)	{$hh='admin';	$sh='server';}
if ($ADD==421111111111)	{$hh='admin';	$sh='server';}
if ($ADD==431111111111)	{$hh='admin';	$sh='templates';}
if ($ADD==441111111111)	{$hh='admin';	$sh='carriers';}
if ($ADD==451111111111)	{$hh='admin';	$sh='tts';}
if ($ADD==461111111111)	{$hh='admin';	$sh='moh';}
if ($ADD==471111111111)	{$hh='admin';	$sh='vm';}
if ($ADD==4111111111111)	{$hh='admin';	$sh='conference';}
if ($ADD==41111111111111)	{$hh='admin';	$sh='conference';}
if ($ADD==411111111111111)	{$hh='admin';	$sh='settings';}
if ($ADD==421111111111111)	{$hh='admin';	$sh='status';}
if ($ADD==431111111111111)	{$hh='admin';	$sh='status';}
if ($ADD==441111111111111)	{$hh='admin';	$sh='status';}
if ($ADD==5)			{$hh='users';}
if ($ADD==51)			{$hh='campaigns';	$sh='detail';}
if ($ADD==52)			{$hh='campaigns';	$sh='detail';}
if ($ADD==53)			{$hh='campaigns';	$sh='detail';}
if ($ADD==511)			{$hh='lists';}
if ($ADD==5111)			{$hh='ingroups';}
if ($ADD==5311)			{$hh='ingroups';}
if ($ADD==5511)			{$hh='ingroups';}
if ($ADD==51111)		{$hh='remoteagent';}
if ($ADD==511111)		{$hh='usergroups';}
if ($ADD==5111111)		{$hh='scripts';}
if ($ADD==51111111)		{$hh='filters';}
if ($ADD==511111111)	{$hh='admin';	$sh='times';}
if ($ADD==531111111)	{$hh='admin';	$sh='shifts';}
if ($ADD==5111111111)	{$hh='admin';	$sh='times';}
if ($ADD==51111111111)	{$hh='admin';	$sh='phones';}
if ($ADD==52111111111)	{$hh='admin';	$sh='phones';}
if ($ADD==53111111111)	{$hh='admin';	$sh='phones';}
if ($ADD==511111111111)	{$hh='admin';	$sh='server';}
if ($ADD==531111111111)	{$hh='admin';	$sh='templates';}
if ($ADD==541111111111)	{$hh='admin';	$sh='carriers';	}
if ($ADD==551111111111)	{$hh='admin';	$sh='tts';}
if ($ADD==561111111111)	{$hh='admin';	$sh='moh';}
if ($ADD==571111111111)	{$hh='admin';	$sh='vm';}
if ($ADD==5111111111111)	{$hh='admin';	$sh='conference';}
if ($ADD==51111111111111)	{$hh='admin';	$sh='conference';}
if ($ADD==6)			{$hh='users';}
if ($ADD==61)			{$hh='campaigns';	$sh='detail';}
if ($ADD==62)			{$hh='campaigns';	$sh='detail';}
if ($ADD==63)			{$hh='campaigns';	$sh='detail';}
if ($ADD==65)			{$hh='campaigns';	$sh='recycle';	}
if ($ADD==66)			{$hh='campaigns';	$sh='autoalt';}
if ($ADD==67)			{$hh='campaigns';	$sh='pause';	}
if ($ADD==68)			{$hh='campaigns';	$sh='dialstat';	}
if ($ADD==69)			{$hh='campaigns';	$sh='listmix';}
if ($ADD==611)			{$hh='lists';		}
if ($ADD==6111)			{$hh='ingroups';}
if ($ADD==6311)			{$hh='ingroups';	}
if ($ADD==6511)			{$hh='ingroups';	}
if ($ADD==61111)		{$hh='remoteagent';	}
if ($ADD==611111)		{$hh='usergroups';	}
if ($ADD==6111111)		{$hh='scripts';	}
if ($ADD==61111111)		{$hh='filters';	}
if ($ADD==611111111)	{$hh='admin';	$sh='times';	}
if ($ADD==631111111)	{$hh='admin';	$sh='shifts';	}
if ($ADD==6111111111)	{$hh='admin';	$sh='times';	}
if ($ADD==61111111111)	{$hh='admin';	$sh='phones';	}
if ($ADD==62111111111)	{$hh='admin';	$sh='phones';	}
if ($ADD==63111111111)	{$hh='admin';	$sh='phones';	}
if ($ADD==611111111111)	{$hh='admin';	$sh='server';	}
if ($ADD==621111111111)	{$hh='admin';	$sh='server';	}
if ($ADD==631111111111)	{$hh='admin';	$sh='templates';	}
if ($ADD==641111111111)	{$hh='admin';	$sh='carriers';	}
if ($ADD==651111111111)	{$hh='admin';	$sh='tts';	}
if ($ADD==661111111111)	{$hh='admin';	$sh='moh';	}
if ($ADD==671111111111)	{$hh='admin';	$sh='vm';	}
if ($ADD==6111111111111)	{$hh='admin';	$sh='conference';	}
if ($ADD==61111111111111)	{$hh='admin';	$sh='conference';	}
if ($ADD==73)			{$hh='campaigns';	}
if ($ADD==7111111)		{$hh='scripts';		}
if ($ADD==700000000000000)	{$hh='reports';	}
if ($ADD==710000000000000)	{$hh='reports';	}
if ($ADD==720000000000000)	{$hh='reports';	}
if ($ADD==730000000000000)	{$hh='reports';	}
if ($ADD==99999999999999)	{$hh='reports';	}
if ($ADD==0)			{$hh='users';		}
if ($ADD==8)			{$hh='users';		}
if ($ADD==81)			{$hh='campaigns';	$sh='list';	}
if ($ADD==811)			{$hh='lists';	}
if ($ADD==8111)			{$hh='usergroups';	}
if ($ADD==10)			{$hh='campaigns';	$sh='list';		}
if ($ADD==100)			{$hh='lists';		}
if ($ADD==1000)			{$hh='ingroups';	}
if ($ADD==1300)			{$hh='ingroups';	}
if ($ADD==1500)			{$hh='ingroups';	}
if ($ADD==15000)			{$hh='ingroups';	}
if ($ADD==1500099)			{$hh='ingroups';	}
if ($ADD==10000)		{$hh='remoteagent';	}
if ($ADD==201315 ||$ADD==201316 ||$ADD==2013161 ||$ADD==2013171 ||$ADD==201318 ||$ADD==201319 ||$ADD==2013191 )		{$hh='remoteagentgroups_hh';	}
if ($ADD==100000)		{$hh='usergroups';	}
if ($ADD==1000000)		{$hh='scripts';		}
if ($ADD==10000000)		{$hh='filters';		}
if ($ADD==100000000)	{$hh='admin';	$sh='times';	}
if ($ADD=="99998888" ||$ADD=="999988888")	{$hh='admin';	$sh='csat';	}
if ($ADD==130000000)	{$hh='admin';	$sh='shifts';	}
if ($ADD==1000000000)	{$hh='admin';	$sh='times';	}
if ($ADD==10000000000)	{$hh='admin';	$sh='phones';	}
if ($ADD==12000000000)	{$hh='admin';	$sh='phones';	}
if ($ADD==13000000000)	{$hh='admin';	$sh='phones';	}
if ($ADD==100000000000)	{$hh='admin';	$sh='server';	}
if ($ADD==130000000000)	{$hh='admin';	$sh='templates';	}
if ($ADD==140000000000)	{$hh='admin';	$sh='carriers';	}
if ($ADD==150000000000)	{$hh='admin';	$sh='tts';	}
if ($ADD==160000000000)	{$hh='admin';	$sh='moh';	}
if ($ADD==170000000000)	{$hh='admin';	$sh='vm';	}
if($ccms_admin_modules=='performance_report') { $hh='admin';}
if ($ADD==700000000000000)		{$hh='admin';}

if ($ADD==1000000000000)	{$hh='admin';	$sh='conference';	}
if ($ADD==10000000000000)	{$hh='admin';	$sh='conference';	}
if ($ADD==9999999999)	{$hh='reports';	$sh='Real-Time Reports';	}
if ($ADD==999999)	{$hh='reports';	$sh='Historical Reports';	}
if ($ADD==550)			{$hh='users';	}
if ($ADD==551)			{$hh='users';		}
if ($ADD==660)			{$hh='users';		}
if ($ADD==661)			{$hh='users';	}
if ($ADD==99999)		{$hh='users';}
if ($ADD==999999 || $ADD==9999991 || $ADD==9999992|| $ADD==9999993|| $ADD==9999994|| $ADD==9999995 || $ADD==9999996 || $ADD==9999998 || $ADD==9999999  || $ADD==99999999 || $ADD==201211161052|| $ADD==201211151704|| $ADD==201211200945|| $ADD==201211151027 || $ADD==201211151034|| $ADD==201211131535|| $ADD==201211131143)		{$hh='reports';} //change by fox for 0002374

### Add by fnatic start ###
if($ccms_admin_modules=='list_leads') { $hh='lists';}
if($ccms_admin_modules=='vtigercrm') { $hh='admin';}
if($ccms_admin_modules=='search_call_log') { $hh='Monitor';}

if($ccms_admin_modules=='search_voice_mail') { $hh='Monitor';}
if($ccms_admin_modules=='live_monitor') { $hh='Monitor';}
### Add by fnatic end



//截取中文长度 by akin
function cutstr($string, $length, $encoding  = 'utf-8') {
	$string_or = $string;
    $string = trim($string);   
    
    if($length && strlen($string) > $length) {
        //截断字符   
        $wordscut = '';   
        if(strtolower($encoding) == 'utf-8') {
            //utf8编码   
            $n = 0;   
            $tn = 0;   
            $noc = 0;   
            while ($n < strlen($string)) {   
                $t = ord($string[$n]);   
                if($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {   
                    $tn = 1;   
                    $n++;   
                    $noc++;   
                } elseif(194 <= $t && $t <= 223) {   
                    $tn = 2;   
                    $n += 2;   
                    $noc += 2;   
                } elseif(224 <= $t && $t < 239) {   
                    $tn = 3;   
                    $n += 3;   
                    $noc += 2;   
                } elseif(240 <= $t && $t <= 247) {   
                    $tn = 4;   
                    $n += 4;   
                    $noc += 2;   
                } elseif(248 <= $t && $t <= 251) {   
                    $tn = 5;   
                    $n += 5;   
                    $noc += 2;   
                } elseif($t == 252 || $t == 253) {   
                    $tn = 6;   
                    $n += 6;   
                    $noc += 2;   
                } else {   
                    $n++;   
                }   
                if ($noc >= $length) {   
                    break;   
                }   
            }   
            if ($noc > $length) {   
                $n -= $tn;   
            }   
            $wordscut = substr($string, 0, $n);   
        } else {   
            for($i = 0; $i < $length - 1; $i++) {   
                if(ord($string[$i]) > 127) {   
                    $wordscut .= $string[$i].$string[$i + 1];   
                    $i++;   
                } else {   
                    $wordscut .= $string[$i];   
                }   
            }   
        }   
        $string = $wordscut;   
    }   
	if(strlen($string)<strlen($string_or)) $string .= "...";
    return trim($string);
}  


if ( ($ADD>9) && ($ADD < 99998) ||$ADD == 1500099)
	{
	
	##### get scripts listing for dynamic pulldown
	$stmt="SELECT script_id,script_name from vicidial_scripts order by script_id";
	$rslt=mysql_query($stmt, $link);
	$scripts_to_print = mysql_num_rows($rslt);
	$scripts_list="<option value=\"\">NONE</option>\n";

	$o=0;
	while ($scripts_to_print > $o)
		{
		$rowx=mysql_fetch_row($rslt);
		$scripts_list .= "<option value=\"$rowx[0]\">$rowx[0] - $rowx[1]</option>\n";
		$scriptname_list["$rowx[0]"] = "$rowx[1]";
		$o++;
		}

	##### get filters listing for dynamic pulldown
	$stmt="SELECT lead_filter_id,lead_filter_name,lead_filter_sql from vicidial_lead_filters order by lead_filter_id";
	$rslt=mysql_query($stmt, $link);
	$filters_to_print = mysql_num_rows($rslt);
	$filters_list="<option value=\"\">NONE</option>\n";

	$o=0;
	while ($filters_to_print > $o)
		{
		$rowx=mysql_fetch_row($rslt);
		$filters_list .= "<option value=\"$rowx[0]\">$rowx[0] - $rowx[1]</option>\n";
		$filtername_list["$rowx[0]"] = "$rowx[1]";
		$filtersql_list["$rowx[0]"] = "$rowx[2]";
		$o++;
		}

	##### get call_times listing for dynamic pulldown
	$stmt="SELECT call_time_id,call_time_name from vicidial_call_times order by call_time_id";
	$rslt=mysql_query($stmt, $link);
	$times_to_print = mysql_num_rows($rslt);

	$o=0;
	while ($times_to_print > $o)
		{
		$rowx=mysql_fetch_row($rslt);
		$call_times_list .= "<option value=\"$rowx[0]\">$rowx[0] - $rowx[1]</option>\n";
		$call_timename_list["$rowx[0]"] = "$rowx[1]";
		$o++;
		}
	}

if ( ( (strlen($ADD)>4) && ($ADD < 99998) ) or ($ADD==3) or (($ADD>20) and ($ADD<70)) or ($ADD=="4A")  or ($ADD=="4B") or (strlen($ADD)==12) )
	{
	##### get server listing for dynamic pulldown
	$stmt="SELECT server_ip,server_description from servers order by server_ip";
	$rslt=mysql_query($stmt, $link);
	$servers_to_print = mysql_num_rows($rslt);
	$servers_list='';

	$o=0;
	while ($servers_to_print > $o)
		{
		$rowx=mysql_fetch_row($rslt);
		$servers_list .= "<option value=\"$rowx[0]\">$rowx[0] - $rowx[1]</option>\n";
		$o++;
		}

	##### BEGIN get campaigns listing for rankings #####

	$stmt="SELECT campaign_id,campaign_name from vicidial_campaigns order by campaign_id";
	$rslt=mysql_query($stmt, $link);
	$campaigns_to_print = mysql_num_rows($rslt);
	$campaigns_list='';
	$campaigns_value='';
	$RANKcampaigns_list="<tr><td>CAMPAIGN</td><td> &nbsp; &nbsp; RANK</td><td> &nbsp; &nbsp; CALLS</td><td ALIGN=CENTER>WEB VARS</td></tr>\n";

	$o=0;
	while ($campaigns_to_print > $o)
		{
		$rowx=mysql_fetch_row($rslt);
		$campaigns_list .= "<option value=\"$rowx[0]\">$rowx[0] - $rowx[1]</option>\n";
		$campaign_id_values[$o] = $rowx[0];
		$campaign_name_values[$o] = $rowx[1];
		$o++;
		}

	$o=0;
	while ($campaigns_to_print > $o)
		{
		$group_web_vars='';
		$campaign_web='';
		$stmt="SELECT campaign_rank,calls_today,group_web_vars from vicidial_campaign_agents where user='$user' and campaign_id='$campaign_id_values[$o]'";
		$rslt=mysql_query($stmt, $link);
		$ranks_to_print = mysql_num_rows($rslt);
		if ($ranks_to_print > 0)
			{
			$row=mysql_fetch_row($rslt);
			$SELECT_campaign_rank = $row[0];
			$calls_today =			$row[1];
			$group_web_vars =		$row[2];
			}
		else
			{$calls_today=0;   $SELECT_campaign_rank=0;   $group_web_vars='';}
		if ( ($ADD=="4A") or ($ADD=="4B") )
			{
			$stmt_grp_values='';
			if (isset($_GET["RANK_$campaign_id_values[$o]"]))			{$campaign_rank=$_GET["RANK_$campaign_id_values[$o]"];}
				elseif (isset($_POST["RANK_$campaign_id_values[$o]"]))	{$campaign_rank=$_POST["RANK_$campaign_id_values[$o]"];}
			if (isset($_GET["WEB_$campaign_id_values[$o]"]))			{$campaign_web=$_GET["WEB_$campaign_id_values[$o]"];}
				elseif (isset($_POST["WEB_$campaign_id_values[$o]"]))	{$campaign_web=$_POST["WEB_$campaign_id_values[$o]"];}
			if ($non_latin < 1)
				{
				$campaign_rank = ereg_replace("[^-\_0-9]","",$campaign_rank);
				$campaign_web = preg_replace("/;|\"|\'/","",$campaign_web);
				}

			if ($ranks_to_print > 0)
				{
				$stmt="UPDATE vicidial_campaign_agents set campaign_rank='$campaign_rank', campaign_weight='$campaign_rank', group_web_vars='$campaign_web' where campaign_id='$campaign_id_values[$o]' and user='$user';";
				$rslt=mysql_query($stmt, $link);
				$stmt_grp_values .= "$stmt|";
				}
			else
				{
				$stmt="INSERT INTO vicidial_campaign_agents set campaign_rank='$campaign_rank', campaign_weight='$campaign_rank', campaign_id='$campaign_id_values[$o]', user='$user', group_web_vars='$campaign_web';";
				$rslt=mysql_query($stmt, $link);
				$stmt_grp_values .= "$stmt|";
				}

			$stmt="UPDATE vicidial_live_agents set campaign_weight='$campaign_rank' where campaign_id='$campaign_id_values[$o]' and user='$user';";
			$rslt=mysql_query($stmt, $link);
			$stmt_grp_values .= "$stmt|";
			}
		else {$campaign_rank = $SELECT_campaign_rank;}

		if (eregi("1$|3$|5$|7$|9$", $o))
			{$bgcolor='bgcolor="#FFFFFF"';} 
		else
			{$bgcolor='bgcolor="#C2C2C2"';}

		# disable non user-group allowable campaign ranks
		$stmt="SELECT user_group from vicidial_users where user='$user';";
		$rslt=mysql_query($stmt, $link);
		$row=mysql_fetch_row($rslt);
		$Ruser_group =	$row[0];

		$stmt="SELECT allowed_campaigns from vicidial_user_groups where user_group='$Ruser_group';";
		$rslt=mysql_query($stmt, $link);
		$row=mysql_fetch_row($rslt);
		$allowed_campaigns =	$row[0];
		$allowed_campaigns = preg_replace("/ -$/","",$allowed_campaigns);
		$UGcampaigns = explode(" ", $allowed_campaigns);

		$p=0;   $RANK_camp_active=0;   $CR_disabled = '';
		if (eregi('-ALL-CAMPAIGNS-',$allowed_campaigns))
			{$RANK_camp_active++;}
		else
			{
			$UGcampaign_ct = count($UGcampaigns);
			while ($p < $UGcampaign_ct)
				{
				if ($campaign_id_values[$o] == $UGcampaigns[$p]) 
					{$RANK_camp_active++;}
				$p++;
				}
			}
		if ($RANK_camp_active < 1) {$CR_disabled = 'DISABLED';}

		$RANKcampaigns_list .= "<tr $bgcolor><td>";
		$campaigns_list .= "<a href=\"$PHP_SELF?ADD=31&campaign_id=$campaign_id_values[$o]\">$campaign_id_values[$o]</a> - $campaign_name_values[$o] <BR>\n";
		$RANKcampaigns_list .= "<a href=\"$PHP_SELF?ADD=31&campaign_id=$campaign_id_values[$o]\">$campaign_id_values[$o]</a> - $campaign_name_values[$o] </td>";
		$RANKcampaigns_list .= "<td> &nbsp; &nbsp; <select size=1 name=RANK_$campaign_id_values[$o] $CR_disabled>\n";
		$h="9";
		while ($h>=-9)
			{
			$RANKcampaigns_list .= "<option value=\"$h\"";
			if ($h==$campaign_rank)
				{$RANKcampaigns_list .= " SELECTED";}
			$RANKcampaigns_list .= ">$h</option>";
			$h--;
			}
		if ( (strlen($campaign_web) < 1) and (strlen($group_web_vars) > 0) )
			{$campaign_web=$group_web_vars;}
		$RANKcampaigns_list .= "</select></td>\n";
		$RANKcampaigns_list .= "<td align=right> &nbsp; &nbsp; $calls_today</td>\n";
		$RANKcampaigns_list .= "<td> &nbsp; &nbsp; <input type=text size=25 maxlength=255 name=WEB_$campaign_id_values[$o] value=\"$campaign_web\"></td></tr>\n";
		$o++;
		}
	##### END get campaigns listing for rankings #####


	##### BEGIN get inbound groups listing for checkboxes #####
	$xfer_groupsSQL='';
	$inbound_mode='';
	if ( (($ADD>20) and ($ADD<70)) and ($ADD!=41) or ( ($ADD==41) and (eregi('list_activation', $stage))) )
		{
		$stmt="SELECT closer_campaigns,xfer_groups,inbound_mode from vicidial_campaigns where campaign_id='$campaign_id';";
		$rslt=mysql_query($stmt, $link);
		$row=mysql_fetch_row($rslt);
		$closer_campaigns =	$row[0];
			$closer_campaigns = preg_replace("/ -$/","",$closer_campaigns);
			$groups = explode(" ", $closer_campaigns);
		$xfer_groups =	$row[1];
			$xfer_groups = preg_replace("/ -$/","",$xfer_groups);
			$XFERgroups = explode(" ", $xfer_groups);
		$xfer_groupsSQL = preg_replace("/^ | -$/","",$xfer_groups);
		$xfer_groupsSQL = preg_replace("/ /","','",$xfer_groupsSQL);
		$xfer_groupsSQL = "WHERE group_id IN('$xfer_groupsSQL')";
		$inbound_mode = $row[2];
		}
	if ($ADD==41)
		{
		$p=0;
		$XFERgroup_ct = count($XFERgroups);
		while ($p < $XFERgroup_ct)
			{
			$xfer_groups .= " $XFERgroups[$p]";
			$p++;
			}
		$xfer_groupsSQL = preg_replace("/^ | -$/","",$xfer_groups);
		$xfer_groupsSQL = preg_replace("/ /","','",$xfer_groupsSQL);
		$xfer_groupsSQL = "WHERE group_id IN('$xfer_groupsSQL')";
		}

	if ( (($ADD==31111) or ($ADD==31111)) and (count($groups)<1) )
		{
		$stmt="SELECT closer_campaigns from vicidial_remote_agents where remote_agent_id='$remote_agent_id';";
		$rslt=mysql_query($stmt, $link);
		$row=mysql_fetch_row($rslt);
		$closer_campaigns =	$row[0];
		$closer_campaigns = preg_replace("/ -$/","",$closer_campaigns);
		$groups = explode(" ", $closer_campaigns);
		}

	if ($ADD==3)
		{
		$stmt="SELECT closer_campaigns from vicidial_users where user='$user';";
		$rslt=mysql_query($stmt, $link);
		$row=mysql_fetch_row($rslt);
		$closer_campaigns =	$row[0];
		$closer_campaigns = preg_replace("/ -$/","",$closer_campaigns);
		$groups = explode(" ", $closer_campaigns);
		}
	
	$stmt="SELECT group_id,group_name,inbound_mode from vicidial_inbound_groups order by inbound_mode,group_id";

#	$stmt="SELECT group_id,group_name from vicidial_inbound_groups where group_id NOT IN('AGENTDIRECT') order by group_id";
	$rslt=mysql_query($stmt, $link);
	$groups_to_print = mysql_num_rows($rslt);
	$groups_list='';
	$groups_value='';
	$XFERgroups_list='';
	$RANKgroups_list="<tr><td>INBOUND GROUP</td><td stylexxx=\"display:none\"> &nbsp; &nbsp; RANK</td><td style=\"display:none\"> &nbsp; &nbsp; CALLS</td><td ALIGN=CENTER style=\"display:none\">WEB VARS</td></tr>\n";
	
	$o=0;
	while ($groups_to_print > $o)
		{
		$rowx=mysql_fetch_row($rslt);
		$group_id_values[$o] = $rowx[0];
		$group_name_values[$o] = $rowx[1];
		$inbound_modes[$o] = $rowx[2];
		$o++;
		}
	$o=0;
	while ($groups_to_print > $o)
		{
		$group_web_vars='';
		$group_web='';
		$stmt="SELECT group_rank,calls_today,group_web_vars from vicidial_inbound_group_agents where user='$user' and group_id='$group_id_values[$o]'";
		$rslt=mysql_query($stmt, $link);
		$ranks_to_print = mysql_num_rows($rslt);
		if ($ranks_to_print > 0)
			{
			$row=mysql_fetch_row($rslt);
			$SELECT_group_rank =	$row[0];
			$calls_today =			$row[1];
			$group_web_vars =		$row[2];
			}
		else
			{$calls_today=0;   $SELECT_group_rank=0;}
		if ( ($ADD=="4A") or ($ADD=="4B") )
			{
			if (isset($_GET["RANK_$group_id_values[$o]"]))			{$group_rank=$_GET["RANK_$group_id_values[$o]"];}
				elseif (isset($_POST["RANK_$group_id_values[$o]"]))	{$group_rank=$_POST["RANK_$group_id_values[$o]"];}
			if (isset($_GET["WEB_$group_id_values[$o]"]))			{$group_web=$_GET["WEB_$group_id_values[$o]"];}
				elseif (isset($_POST["WEB_$group_id_values[$o]"]))	{$group_web=$_POST["WEB_$group_id_values[$o]"];}

			if ($non_latin < 1)
				{
				$group_rank = ereg_replace("[^-\_0-9]","",$group_rank);
				$group_web = preg_replace("/;|\"|\'/","",$group_web);
				}

			if ($ranks_to_print > 0)
				{
				$stmt="UPDATE vicidial_inbound_group_agents set group_rank='$group_rank', group_weight='$group_rank', group_web_vars='$group_web' where group_id='$group_id_values[$o]' and user='$user';";
				$rslt=mysql_query($stmt, $link);
				$stmt_grp_values .= "$stmt|";
				}
			else
				{
				$stmt="INSERT INTO vicidial_inbound_group_agents set group_rank='$group_rank', group_weight='$group_rank', group_id='$group_id_values[$o]', user='$user', group_web_vars='$group_web';";
				$rslt=mysql_query($stmt, $link);
				$stmt_grp_values .= "$stmt|";
				}

			$stmt="UPDATE vicidial_live_inbound_agents set group_weight='$group_rank' where group_id='$group_id_values[$o]' and user='$user';";
			$rslt=mysql_query($stmt, $link);
			$stmt_grp_values .= "$stmt|";
			}
		else {$group_rank = $SELECT_group_rank;}

		if (eregi("1$|3$|5$|7$|9$", $o))
			{$bgcolor='bgcolor="#FFFFFF"';} 
		else
			{$bgcolor='bgcolor="#C2C2C2"';}
		$disable_str = "";
		if($modepara=='')
		{
			$modepara=$campaign_inbound_mode;
		}
		if($modepara =="ring" || $modepara == "auto"){
			$inbound_mode = $modepara;
		}
		if($inbound_mode!="" && ($inbound_modes[$o] != $inbound_mode)){
			//$disable_str = " disabled=\"disabled\"";
		}
		$groups_list .= "<input type=\"checkbox\" name=\"groups[]\" value=\"$group_id_values[$o]\"$disable_str";
		$XFERgroups_list .= "<input type=\"checkbox\" name=\"XFERgroups[]\" value=\"$group_id_values[$o]\"$disable_str";
		$RANKgroups_list .= "<tr $bgcolor><td><input type=\"checkbox\" name=\"groups[]\" value=\"$group_id_values[$o]\"";
		$p=0;
		$group_ct = count($groups);
		while ($p < $group_ct)
			{
			if ($group_id_values[$o] == $groups[$p]) 
				{
				$groups_list .= " CHECKED";
				$RANKgroups_list .= " CHECKED";
				$groups_value .= " $group_id_values[$o]";
				}
			$p++;
			}
		$p=0;
		$XFERgroup_ct = count($XFERgroups);
		while ($p < $XFERgroup_ct)
			{
			if ($group_id_values[$o] == $XFERgroups[$p]) 
				{
				$XFERgroups_list .= " CHECKED";
				$XFERgroups_value .= " $group_id_values[$o]";
				}
			$p++;
			}
		$stmt="SELECT queue_priority from vicidial_inbound_groups where group_id='$group_id_values[$o]';";
		$rslt=mysql_query($stmt, $link);
		$row=mysql_fetch_row($rslt);
		$VIG_priority =			$row[0];

		$groups_list .= "> <a href=\"$PHP_SELF?ADD=3111&group_id=$group_id_values[$o]\">$group_id_values[$o]</a> - $group_name_values[$o] - $VIG_priority <BR>\n";
		$XFERgroups_list .= "> <a href=\"$PHP_SELF?ADD=3111&group_id=$group_id_values[$o]\">$group_id_values[$o]</a> - $group_name_values[$o] <BR>\n";
		$RANKgroups_list .= "> <a href=\"$PHP_SELF?ADD=3111&group_id=$group_id_values[$o]\">$group_id_values[$o]</a> - $group_name_values[$o] </td>";
		$RANKgroups_list .= "<td stylexxx=\"display:none\"> &nbsp; &nbsp; <select size=1 name=RANK_$group_id_values[$o]>\n";
		$h="9";
		while ($h>=-9)
			{
			$RANKgroups_list .= "<option value=\"$h\"";
			if ($h==$group_rank)
				{$RANKgroups_list .= " SELECTED";}
			$RANKgroups_list .= ">$h</option>";
			$h--;
			}
		if ( (strlen($group_web) < 1) and (strlen($group_web_vars) > 0) )
			{$group_web=$group_web_vars;}
		$RANKgroups_list .= "</select></td>\n";
		$RANKgroups_list .= "<td align=right style=\"display:none\"> &nbsp; &nbsp; $calls_today</td>\n";
		$RANKgroups_list .= "<td style=\"display:none\"> &nbsp; &nbsp; <input type=text size=25 maxlength=255 name=WEB_$group_id_values[$o] value=\"$group_web\"></td></tr>\n";
		$o++;
		}
	if (strlen($groups_value)>2) {$groups_value .= " -";}
	if (strlen($XFERgroups_value)>2) {$XFERgroups_value .= " -";}
	}
	##### END get inbound groups listing for checkboxes #####


##### BEGIN get campaigns listing for checkboxes #####
if ( ($ADD==211111) or ($ADD==311111) or ($ADD==411111) or ($ADD==511111) or ($ADD==611111) )
	{
	if ( ($ADD==211111) or ($ADD==311111) or ($ADD==511111) or ($ADD==611111) )
		{
		$stmt="SELECT allowed_campaigns,qc_allowed_campaigns,qc_allowed_inbound_groups from vicidial_user_groups where user_group='$user_group';";
		$rslt=mysql_query($stmt, $link);
		$row=mysql_fetch_row($rslt);
		$allowed_campaigns =			$row[0];
		$qc_allowed_campaigns =			$row[1];
		$qc_allowed_inbound_groups =	$row[2];
		$allowed_campaigns = preg_replace("/ -$/","",$allowed_campaigns);
		$campaigns = explode(" ", $allowed_campaigns);
		$qc_allowed_campaigns = preg_replace("/ -$/","",$qc_allowed_campaigns);
		$qc_campaigns = explode(" ", $qc_allowed_campaigns);
		$qc_allowed_inbound_groups = preg_replace("/ -$/","",$qc_allowed_inbound_groups);
		$qc_groups = explode(" ", $qc_allowed_inbound_groups);
		}

	$campaigns_value='';
	$campaigns_list='<B><input type="checkbox" name="campaigns[]" value="-ALL-CAMPAIGNS-"';
	$qc_campaigns_value='';
	$qc_campaigns_list='<B><input type="checkbox" name="qc_campaigns[]" value="-ALL-CAMPAIGNS-"';
	$qc_groups_value='';
	$qc_groups_list='<B><input type="checkbox" name="qc_groups[]" value="-ALL-GROUPS-"';
	$p=0;
	while ($p<2000)
		{
		if (eregi('ALL-CAMPAIGNS',$campaigns[$p])) 
			{
			$campaigns_list.=" CHECKED";
			$campaigns_value .= " -ALL-CAMPAIGNS-";
			}
		if (eregi('ALL-CAMPAIGNS',$qc_campaigns[$p])) 
			{
			$qc_campaigns_list.=" CHECKED";
			$qc_campaigns_value .= " -ALL-CAMPAIGNS-";
			}
		if (eregi('ALL-GROUPS',$qc_groups[$p])) 
			{
			$qc_groups_list.=" CHECKED";
			$qc_groups_value .= " -ALL-GROUPS-";
			}
		$p++;
		}
	$campaigns_list.="> ALL-CAMPAIGNS - USERS CAN VIEW ANY CAMPAIGN</B><BR>\n";
	$qc_campaigns_list.="> ALL-CAMPAIGNS - USERS CAN QC ANY CAMPAIGN</B><BR>\n";
	$qc_groups_list.="> ALL-GROUPS - USERS CAN QC ANY INBOUND GROUP</B><BR>\n";

	$stmt="SELECT campaign_id,campaign_name from vicidial_campaigns where active='Y' order by campaign_id";
	$rslt=mysql_query($stmt, $link);
	$campaigns_to_print = mysql_num_rows($rslt);

	$o=0;
	while ($campaigns_to_print > $o)
		{
		$rowx=mysql_fetch_row($rslt);
		$campaign_id_value = $rowx[0];
		$campaign_name_value = $rowx[1];
		$campaigns_list .= "<input type=\"checkbox\" name=\"campaigns[]\" value=\"$campaign_id_value\"";
		$qc_campaigns_list .= "<input type=\"checkbox\" name=\"qc_campaigns[]\" value=\"$campaign_id_value\"";
		$p=0;
		while ($p<1000)
			{
			if ( ($campaign_id_value == $campaigns[$p]) and (strlen($campaign_id_value) > 1) )
				{
			#	echo "<!--  X $p|$campaign_id_value|$campaigns[$p]| -->";
				$campaigns_list .= " CHECKED";
				$campaigns_value .= " $campaign_id_value";
				}
			if ($campaign_id_value == $qc_campaigns[$p]) 
				{
				$qc_campaigns_list .= " CHECKED";
				$qc_campaigns_value .= " $campaign_id_value";
				}
		#	echo "<!--  O $p|$campaign_id_value|$campaigns[$p]| -->";
			$p++;
			}
		$campaigns_list .= "> $campaign_id_value - $campaign_name_value<BR>\n";
		$qc_campaigns_list .= "> $campaign_id_value - $campaign_name_value<BR>\n";
		$o++;
		}

	$stmt="SELECT group_id,group_name from vicidial_inbound_groups where group_id NOT IN('AGENTDIRECT') order by group_id";
	$rslt=mysql_query($stmt, $link);
	$groups_to_print = mysql_num_rows($rslt);

	$o=0;
	while ($groups_to_print > $o)
		{
		$rowx=mysql_fetch_row($rslt);
		$group_id_value = $rowx[0];
		$group_name_value = $rowx[1];
		$qc_groups_list .= "<input type=\"checkbox\" name=\"qc_groups[]\" value=\"$group_id_value\"";
		$p=0;
		while ($p<2000)
			{
			if ( ($group_id_value == $qc_groups[$p]) and (strlen($group_id_value) > 1) )
				{
				$qc_groups_list .= " CHECKED";
				$qc_groups_value .= " $group_id_value";
				}
			$p++;
			}
		$qc_groups_list .= "> $group_id_value - $group_name_value<BR>\n";
		$o++;
		}

	if (strlen($campaigns_value)>2) {$campaigns_value .= " -";}
	if (strlen($qc_campaigns_value)>2) {$qc_campaigns_value .= " -";}
	if (strlen($qc_groups_value)>2) {$qc_groups_value .= " -";}
	}
	##### END get campaigns listing for checkboxes #####


if ( (strlen($ADD)==11) or (strlen($ADD)>12) or ( ($ADD > 1299) and ($ADD < 9999) ) )
	{
	##### get server listing for dynamic pulldown
	$stmt="SELECT server_ip,server_description from servers order by server_ip";
	$rsltx=mysql_query($stmt, $link);
	$servers_to_print = mysql_num_rows($rsltx);
	$servers_list='';

	$o=0;
	while ($servers_to_print > $o)
		{
		$rowx=mysql_fetch_row($rsltx);
		$servers_list .= "<option value=\"$rowx[0]\">$rowx[0] - $rowx[1]</option>\n";
		$o++;
		}
	}



$NWB = " &nbsp; <a href=\"javascript:openNewWindow('$PHP_SELF?ADD=99999";
$NWE = "')\"><IMG SRC=\"help.gif\" WIDTH=20 HEIGHT=20 BORDER=0 ALT=\"HELP\" ALIGN=TOP></A>";


######################################################################################################
######################################################################################################
#######   9 series, HELP screen
######################################################################################################
######################################################################################################


######################
# ADD=99999 display the HELP SCREENS
######################

if ($ADD==99999)
	{
	echo "</title>\n";
	echo "</head>\n";
	echo "<BODY BGCOLOR=white marginheight=0 marginwidth=0 leftmargin=0 topmargin=0>\n";
	echo "<CENTER>\n";
	echo "<TABLE WIDTH=98% BGCOLOR=#E6E6E6 cellpadding=2 cellspacing=0><TR><TD ALIGN=LEFT><FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=4><B>ADMINISTRATION: HELP<BR></B></FONT><FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2><BR><BR>\n";

	?>
	<B><FONT SIZE=3>VICIDIAL_USERS TABLE</FONT></B><BR><BR>
	<A NAME="vicidial_users-user">
	<BR>
	<B>User ID -</B> This field is where you put the CCMS users ID number, can be up to 8 digits in length, Must be at least 2 characters in length.

	<BR>
	<A NAME="vicidial_users-pass">
	<BR>
	<B>Password -</B> This field is where you put the CCMS users password. Must be at least 2 characters in length.

	<BR>
	<A NAME="vicidial_users-full_name">
	<BR>
	<B>Full Name -</B> This field is where you put the CCMS users full name. Must be at least 2 characters in length.

	<BR>
	<A NAME="vicidial_users-user_level">
	<BR>
	<B>User Level -</B> This menu is where you select the CCMS users user level. Must be a level of 1 to log into CCMS, Must be level greater than 2 to log in as a closer, Must be user level 8 or greater to get into admin web section.

	<BR>
	<A NAME="vicidial_users-user_group">
	<BR>
	<B>User Group -</B> This menu is where you select the CCMS users group that this user will belong to. This does not have any restrictions at this time, this is just to subdivide users and allow for future features based upon it.

	<BR>
	<A NAME="vicidial_users-phone_login">
	<BR>
	<B>Phone Login -</B> Here is where you can set a default phone login value for when the user logs into vicidial.php. This value will populate the phone_login automatically when the user logs in with their user-pass-campaign in the vicidial.php login screen.

	<BR>
	<A NAME="vicidial_users-phone_pass">
	<BR>
	<B>Phone Pass -</B> Here is where you can set a default phone pass value for when the user logs into vicidial.php. This value will populate the phone_pass automatically when the user logs in with their user-pass-campaign in the vicidial.php login screen.

	<BR>
	<A NAME="vicidial_users-active">
	<BR>
	<B>Active -</B> This field defines whether the user is active in the system and can use CCMS resources. Default is Y

	<BR>
	<A NAME="vicidial_users-optional">
	<BR>
	<B>Email, User Code and Territory -</B> These are optional fields.

<!--
	<BR>
	<A NAME="vicidial_users-hotkeys_active">
	<BR>
	<B>Hot Keys Active -</B> This option if set to Y allows the user to use the Hot Keys quick-dispositioning function in vicidial.php.

	<BR>
	<A NAME="vicidial_users-agent_choose_ingroups">
	<BR>
	<B>Agent Choose Ingroups -</B> This option if set to Y allows the user to choose the ingroups that they will receive calls from when they login to a CLOSER or INBOUND campaign. Otherwise the Manager will need to set this in their user detail screen of the admin page.
-->
	<BR>
	<A NAME="vicidial_users-agent_choose_territories">
	<BR>
	<B>Agent Choose Territories -</B> This option if set to Y allows the user to choose the territories that they will receive calls from when they login to a MANUAL or INBOUND_MAN campaign. Otherwise the user will be set to use all of the territories that they are set to belong to in the User Territories administrative section.

	<BR>
	<A NAME="vicidial_users-scheduled_callbacks">
	<BR>
	<B>Scheduled Callbacks -</B> This option allows an agent to disposition a call as CALLBK and choose the date and time at which the lead will be re-activated.

	<BR>
	<A NAME="vicidial_users-agentonly_callbacks">
	<BR>
	<B>Agent-Only Callbacks -</B> This option allows an agent to set a callback so that they are the only Agent that can call the customer back. This also allows the agent to see their callback listings and call them back any time they want to.

	<BR>
	<A NAME="vicidial_users-agentcall_manual">
	<BR>
	<B>Agent Call Manual -</B> This option allows an agent to manually enter a new lead into the system and call them. This also allows the calling of any phone number from their CCMS screen and puts that call into their session. Use this option with caution.

<!--
	<BR>
	<A NAME="vicidial_users-vicidial_recording">
	<BR>
	<B>CCMS Recording -</B> This option can prevent an agent from doing any recordings after they log in to CCMS. This option must be on for CCMS to follow the campaign recording session.
-->

	<BR>
	<A NAME="vicidial_users-vicidial_transfers">
	<BR>
	<B>CCMS Transfers -</B> This option can prevent an agent from opening the transfer - conference session of CCMS. If this is disabled, the agent cannot third party call or blind transfer any calls.

	<?php
	if ($SSoutbound_autodial_active > 0)
		{
		?>
	<!--
		<BR>
		<A NAME="vicidial_users-closer_default_blended">
		<BR>
		<B>Closer Default Blended -</B> This option simply defaults the Blended checkbox on a CLOSER login screen.
-->
		<?php
		}
	?>

<!--
	<BR>
	<A NAME="vicidial_users-vicidial_recording_override">
	<BR>
	<B>CCMS Recording Override -</B> This option will override whatever the option is in the campaign for recording. DISABLED will not override the campaign recording setting. NEVER will disable recording on the client. ONDEMAND is the default and allows the agent to start and stop recording as needed. ALLCALLS will start recording on the client whenever a call is sent to an agent. ALLFORCE will start recording on the client whenever a call is sent to an agent giving the agent no option to stop recording. For ALLCALLS and ALLFORCE there is an option to use the Recording Delay to cut down on very short recordings and recude system load.
-->

<!--
	<BR>
	<A NAME="vicidial_users-agent_shift_enforcement_override">
	<BR>
	<B>Agent Shift Enforcement Override -</B> This setting will override whatever the users user group has set for Shift Enforcement. DISABLED will use the user group setting. OFF will not enforce shifts at all. START will only enforce the login time but will not affect an agent that is running over their shift time if they are already logged in. ALL will enforce shift start time and will log an agent out after they run over the end of their shift time. Default is DISABLED.
-->

	<BR>
	<A NAME="vicidial_users-alert_enabled">
	<BR>
	<B>Alert Enabled -</B> This field shows whether the agent has web browser alerts enabled for when calls come into their vicidial.php session. Default is N for NO.

	<BR>
	<A NAME="vicidial_users-allow_alerts">
	<BR>
	<B>Allow Alerts -</B> This field gives you the ability to allow agent browser alerts to be enabled by the agent for when calls come into their vicidial.php session. Default is N for NO.

	<BR>
	<A NAME="vicidial_users-view_agent_status">
	<BR>
	<B>View Agent Status -</B> 在CCMS Agent中是否显示"查看话务员状态"链接
	<BR>
	<A NAME="vicidial_users-vicidial_users-campaign_ranks">
	<BR>
	<B>Campaign Ranks -</B> In this section you can define the rank an agent will have for each campaign. These ranks can be used to allow for preferred call routing when Next Agent Call is set to campaign_rank. Also in this section are the WEB VARs for each campaign. These allow each agent to have a different variable string that can be added to the WEB FORM or SCRIPT tab URLs by simply putting --A--web_vars--B-- as you would put any other field.

	<BR>
	<A NAME="vicidial_users-closer_campaigns">
	<BR>
	<B>Inbound Groups -</B> Here is where you select the inbound groups you want to receive calls from if you have selected the CLOSER campaign. You will also be able to set the rank, or skill level, in this section for each of the inbound groups as well as being able to see the number of calls received from each inbound group for this specific agent. Also in this section is the ability to give the agent a rank for each inbound group. These ranks can be used for preferred call routing when that option is selected in the in-group screen. Also in this section are the WEB VARs for each campaign. These allow each agent to have a different variable string that can be added to the WEB FORM or SCRIPT tab URLs by simply putting --A--web_vars--B-- as you would put any other field.
	
	<BR>
	<A NAME="allowed-campaigns">
	<BR>
	<B>Allowed Campaigns -</B> 只有勾选上的campaign才可以在CCMS Agent登陆界面里列出来并给对应agent使用
	
<!--
	<BR>
	<A NAME="vicidial_users-alter_custdata_override">
	<BR>
	<B>Agent Alter Customer Data Override -</B> This option will override whatever the option is in the campaign for altering of customer data. NOT_ACTIVE will use whatever setting is present for the campaign. ALLOW_ALTER will always allow for the agent to alter the customer data, no matter what the campaign setting is. Default is NOT_ACTIVE.
-->

<!--
	<BR>
	<A NAME="vicidial_users-alter_custphone_override">
	<BR>
	<B>Agent Alter Customer Phone Override -</B> This option will override whatever the option is in the campaign for altering of customer phone number. NOT_ACTIVE will use whatever setting is present for the campaign. ALLOW_ALTER will always allow for the agent to alter the customer phone number, no matter what the campaign setting is. Default is NOT_ACTIVE.
-->

	<BR>
	<A NAME="vicidial_users-custom_one">
	<BR>
	<B>Custom User Fields -</B> These five fields can be used for various purposes, and they can be populated in the web form addresses and scripts as user_custom_one and so on.

	<BR>
	<A NAME="vicidial_users-alter_agent_interface_options">
	<BR>
	<B>Alter Agent Interface Options -</B> This option if set to Y allows the administrative user to modify the Agents interface options in admin.php.

	<BR>
	<A NAME="vicidial_users-delete_users">
	<BR>
	<B>Delete Users -</B> This option if set to Y allows the user to delete other users of equal or lesser user level from the system.

	<BR>
	<A NAME="vicidial_users-add_new_user_groups">
	<BR>
	<B>Add New User Groups -</B> 是否有权限新增用户组。

	<BR>
	<A NAME="vicidial_users-delete_user_groups">
	<BR>
	<B>Delete User Groups -</B> This option if set to Y allows the user to delete user groups from the system.

	<BR>
	<A NAME="vicidial_users-add_new_lists">
	<BR>
	<B>Add New Lists -</B> 是否有权限新增List。

	<BR>
	<A NAME="vicidial_users-delete_lists">
	<BR>
	<B>Delete Lists -</B> This option if set to Y allows the user to delete CCMS lists from the system.

	<BR>
	<A NAME="vicidial_users-delete_campaigns">
	<BR>
	<B>Delete Campaigns -</B> This option if set to Y allows the user to delete CCMS campaigns from the system.

	<BR>
	<A NAME="vicidial_users-delete_ingroups">
	<BR>
	<B>Delete In-Groups -</B> This option if set to Y allows the user to delete CCMS In-Groups from the system.

	<BR>
	<A NAME="vicidial_users-delete_remote_agents">
	<BR>
	<B>Delete Remote Agents -</B> This option if set to Y allows the user to delete CCMS remote agents from the system.

	<?php
	if ($SSoutbound_autodial_active > 0)
		{
		?>
		<BR>
		<A NAME="vicidial_users-load_leads">
		<BR>
		<B>Load Leads -</B> This option if set to Y allows the user to load CCMS leads into the vicidial_list table by way of the web based lead loader.
		<?php
		}
	?>

	<BR>
	<A NAME="vicidial_users-campaign_detail">
	<BR>
	<B>Campaign Detail -</B> This option if set to Y allows the user to view and modify the campaign detail screen elements.

	<BR>
	<A NAME="vicidial_users-ast_admin_access">
	<BR>
	<B>AGC Admin Access -</B> This option if set to Y allows the user to login to the astGUIclient admin pages.

	<BR>
	<A NAME="vicidial_users-ast_delete_phones">
	<BR>
	<B>AGC Delete Phones -</B> This option if set to Y allows the user to delete phone entries in the astGUIclient admin pages.

	<BR>
	<A NAME="vicidial_users-delete_scripts">
	<BR>
	<B>Delete Scripts -</B> This option if set to Y allows the user to delete Campaign scripts in the script modification screen.

	<BR>
	<A NAME="vicidial_users-modify_leads">
	<BR>
	<B>Modify Leads -</B> This option if set to Y allows the user to modify leads in the admin section lead search results page.

	<BR>
	<A NAME="vicidial_users-change_agent_campaign">
	<BR>
	<B>Change Agent Campaign -</B> This option if set to Y allows the user to alter the campaign that an agent is logged into while they are logged into it.

	<?php
	if ($SSoutbound_autodial_active > 0)
		{
		?>
		<BR>
		<A NAME="vicidial_users-delete_filters">
		<BR>
		<B>Delete Filters -</B> This option allows the user to be able to delete CCMS lead filters from the system.
		<?php
		}
	?>

	<BR>
	<A NAME="vicidial_users-delete_call_times">
	<BR>
	<B>Delete Call Times -</B> This option allows the user to be able to delete CCMS call times records and CCMS state call times records from the system.

	<BR>
	<A NAME="vicidial_users-modify_call_times">
	<BR>
	<B>Modify Call Times -</B> This option allows the user to view and modify the call times and state call times records. A user doesn't need this option enabled if they only need to change the call times option on the campaigns screen.

	<BR>
	<A NAME="vicidial_users-modify_sections">
	<BR>
	<B>Modify Sections -</B> These options allow the user to view and modify each sections records. If set to N, the user will be able to see the section list, but not the detail or modification screen of a record in that section.

	<BR>
	<A NAME="vicidial_users-view_reports">
	<BR>
	<B>View Reports -</B> This option allows the user to view the CCMS reports.
	<BR>
	<A NAME="vicidial_users-view_istorical_reports">
	<BR>
	<B>View Historical Reports -</B> 是否有权限查看Real-Time Reports和Historical Reports。


	<BR>
	<A NAME="vicidial_users-live_monitor">
	<BR>
	<B>Live Monitor -</B> 是否有权限查看Live Monitor。

	<BR>
	<A NAME="vicidial_users-search_call_log">
	<BR>
	<B>Search Call Log -</B> 是否有权限查看Search Call Log。

	<BR>
	<A NAME="vicidial_users-search_voice_mail">
	<BR>
	<B>Search Voice mail -</B> 是否有权限查看Search Voice mail。

	<BR>
	<A NAME="vicidial_users-add_new_users">
	<BR>
	<B>Add New Users -</B> 是否有权限添加用户。


	<?php
	if ($SSqc_features_active > 0)
		{
		?>
		<BR>
		<A NAME="vicidial_users-qc_enabled">
		<BR>
		<B>QC Enabled -</B> This option allows the user to log in to the Quality Control agent screen.

		<BR>
		<A NAME="vicidial_users-qc_user_level">
		<BR>
		<B>QC User Level -</B> This setting defines what the agent Quality Control user level is. This will dictate the level of functionality for the agent in the QC section:<BR>
		1 - Modify Nothing<BR>
		2 - Modify Nothing Except Status<BR>
		3 - Modify All Fields<BR>
		4 - Verify First Round of QC<BR>
		5 - View QC Statistics<BR>
		6 - Ability to Modify FINISHed records<BR>
		7 - Manager Level<BR>

		<BR>
		<A NAME="vicidial_users-qc_pass">
		<BR>
		<B>QC Record Pass -</B> This option allows the agent to specify that a record has passed the first round of QC after reviewing the record.

		<BR>
		<A NAME="vicidial_users-qc_finish">
		<BR>
		<B>QC Record Finish -</B> This option allows the agent to specify that a record has finished the second round of QC after reviewing the passed record.

		<BR>
		<A NAME="vicidial_users-qc_commit">
		<BR>
		<B>QC Record Commit -</B> This option allows the agent to specify that a record has been committed in QC. It can no longer be modified by anyone.
		<?php
		}
	?>

	<BR>
	<A NAME="vicidial_users-add_timeclock_log">
	<BR>
	<B>Add Timeclock Log Record -</B> This option allows the user to add records to the timeclock log.

	<BR>
	<A NAME="vicidial_users-modify_timeclock_log">
	<BR>
	<B>Modify Timeclock Log Record -</B> This option allows the user to modify records in the timeclock log.

	<BR>
	<A NAME="vicidial_users-delete_timeclock_log">
	<BR>
	<B>Delete Timeclock Log Record -</B> This option allows the user to delete records in the timeclock log.

	<BR>
	<A NAME="vicidial_users-vdc_agent_api_access">
	<BR>
	<B>Agent API Access -</B> This option allows the account to be used with the CCMS agent API commands.

	<BR>
	<A NAME="vicidial_users-manager_shift_enforcement_override">
	<BR>
	<B>Manager Shift Enforcement Override -</B> This setting if set to Y will allow a manager to enter their user and password on an agent screen to override the shift restrictions on an agent session if the agent is trying to log in outside of their shift. Default is N.

	<BR>
	<A NAME="vicidial_users-download_lists">
	<BR>
	<B>Download Lists -</B> This setting if set to Y will allow a manager to click on the download list link at the bottom of a list modification screen to export the entire contents of a list to a flat data file. Default is N.

	<BR>
	<A NAME="vicidial_users-export_reports">
	<BR>
	<B>Export Reports -</B> This setting if set to Y will allow a manager to access the export call reports on the REPORTS screen. Default is N. For the Export Calls Report, the following field order is used for exports: <BR>call_date, phone_number, status, user, full_name, campaign_id/in-group, vendor_lead_code, source_id, list_id, gmt_offset_now, phone_code, phone_number, title, first_name, middle_initial, last_name, address1, address2, address3, city, state, province, postal_code, country_code, gender, date_of_birth, alt_phone, email, security_phrase, comments, length_in_sec, user_group, alt_dial/queue_seconds, rank, owner

	<BR>
	<A NAME="vicidial_users-add_from_dnc">
	<BR>
	<B>Add Number From DNC Lists -</B> 是否有权限将电话添加到黑名单列表中。
	<BR>
	<A NAME="vicidial_users-delete_from_dnc">
	<BR>
	<B>Delete Number From DNC Lists -</B> This setting if set to Y will allow a manager to remove phone numbers from the DNC lists in the CCMS system.
	<BR>
	<A NAME="vicidial_users-add_new_campaigns">
	<BR>
	<B>Add New Campaigns -</B> 是否有权限添加新的Campaigns。






	<BR><BR><BR><BR>

	<B><FONT SIZE=3>VICIDIAL_CAMPAIGNS TABLE</FONT></B><BR><BR>
	<A NAME="vicidial_campaigns-campaign_id">
	<BR>
	<B>Campaign ID -</B> This is the short name of the campaign, it is not editable after initial submission, cannot contain spaces and must be between 2 and 8 characters in length.

	<BR>
	<A NAME="vicidial_campaigns-campaign_name">
	<BR>
	<B>Campaign Name -</B> This is the description of the campaign, it must be between 6 and 40 characters in length.

	<BR>
	<A NAME="vicidial_campaigns-campaign_description">
	<BR>
	<B>Campaign Description -</B> This is a memo field for the campaign, it is optional and can be a maximum of 255 characters in length.

	<BR>
	<A NAME="vicidial_campaigns-campaign_changedate">
	<BR>
	<B>Campaign Change Date -</B> This is the last time that the settings for this campaign were modified in any way.

	<BR>
	<A NAME="vicidial_campaigns-campaign_logindate">
	<BR>
	<B>Last Campaign Login Date -</B> This is the last time that an agent was logged into this campaign.

	<BR>
	<A NAME="vicidial_campaigns-campaign_calldate">
	<BR>
	<B>Last Campaign Call Date -</B> This is the last time that a call was handled by an agent logged into this campaign.

	<BR>
	<A NAME="vicidial_campaigns-campaign_stats_refresh">
	<BR>
	<B>Campaign Stats Refresh -</B> This checkbox will allow you to force a CCMS stats refresh, even if the campaign is not active.

	<BR>
	<A NAME="vicidial_campaigns-active">
	<BR>
	<B>Active -</B> This is where you set the campaign to Active or Inactive. If Inactive, noone can log into it.

	<BR>
	<A NAME="vicidial_campaigns-park_ext">
	<BR>
	<B>Park Extension -</B> This is where you can customize the on-hold music for CCMS. Make sure the extension is in place in the extensions.conf and that it points to the filename below.

	<BR>
	<A NAME="vicidial_campaigns-park_file_name">
	<BR>
	<B>Park File Name -</B> This is where you can customize the on-hold music for CCMS. Make sure the filename is 10 characters in length or less and that the file is in place in the /var/lib/asterisk/sounds directory.

	<BR>
	<A NAME="vicidial_campaigns-web_form_address">
	<BR>
	<B>Web Form -</B> This is where you can set the custom web page that will be opened when the user clicks on the WEB FORM button. To customize the query string after the web form, simply begin the web form with VAR and then the URL that you want to use, replacing the variables with the variable names that you want to use --A--phone_number--B-- just like in the SCRIPTS tab section.

	<BR>
	<A NAME="vicidial_campaigns-web_form_target">
	<BR>
	<B>Web Form Target-</B> This is where you can set the custom web page frame that the web form will be opened in when the user clicks on the WEB FORM button. Default is _blank.

	<BR>
	<A NAME="vicidial_campaigns-allow_closers">
	<BR>
	<B>Allow Closers -</B> This is where you can set whether the users of this campaign will have the option to send the call to a closer.

	<BR>
	<A NAME="vicidial_campaigns-default_xfer_group">
	<BR>
	<B>Default Transfer Group -</B> This field is the default In-Group that will be automatically selected when the agent goes to the transfer-conference frame in their agent interface.

	<BR>
	<A NAME="vicidial_campaigns-xfer_groups">
	<BR>
	<B>Allowed Transfer Groups -</B> With these checkbox listings you can select the groups that agents in this campaign can transfer calls to. Allow Closers must be enabled for this option to show up.
	<BR>
	<A NAME="more_manual_ring_launch">
	<BR>
	<B>Manual Ring Launch -</B> 
	手动外拨响铃时触发
NONE表示不触发任何
SCRIPT表示外拨响铃时触发SCRIPT。
	<BR>
	<A NAME="more_custom_dispo">
	<BR>
	<B>Custom Dispo -</B> 
	是否可定制小结界面，如果项目需要在小结时填写特有的字段，可将此项设为Y。
		<BR>
	<A NAME="more_custom_dispo_script">
	<BR>
	<B>Custom Dispo Script -</B> 
	当Custom Dispo=Y时，设置定制小结的脚本(一般为xxx_dispo.php)。
		<BR>
	<A NAME="more_customer_hangup_goto_dispo_enable">
	<BR>
	<B>Customer Hangup Goto Dispo Enable -</B> 
	是否启用“客户挂机后，自动进入电话小结”。
		<BR>
		<A NAME="more_auto_dispo_time">
	<BR>
	<B>Auto Dispo Time -</B> 
	从小结界面弹出时开始计时，当计时超过“Auto Dispo Time”所设定的时间时，自动帮用户提交小结。为“0”时该功能不启用。
		<BR>
		<A NAME="more_Auto_Submit_Dispo">
	<BR>
	<B>Auto Submit Dispo -</B> 
	是否默认提交电话小结。
		<BR>
	<A NAME="more_default_call_result">
	<BR>
	<B>Default Call Result -</B> 
	小结界面默认选中值
		<BR>
	<A NAME="more_webForm_button_display">
	<BR>
	<B>WebForm Button Display -</B> 
	是否显示Web Form按钮。
		<BR>
	<A NAME="more_conference_channel_display">
	<BR>
	<B>Conference Channel Display -</B> 
	是否在坐席系统显示“通道信息链接”。
		<BR>
	<A NAME="more_xfer_blind_display">
	<BR>
	<B>Xfer Blind Display -</B> 
	是否显示 转接面板 - 盲转按钮。
		<BR>
	<A NAME="more_xfer_local_closer_display">
	<BR>
	<B>Xfer Local Closer Display -</B> 
	是否显示 转接面板 - 转技能组按钮。
		<BR>
	<A NAME="more_xfer_dial_with_customer_display">
	<BR>
	<B>Xfer Dial With Customer Display -</B> 
	是否显示 转接面板 - 不挂断拨号按钮。
		<BR>
	<A NAME="more_xfer_answer_machine_message_display">
	<BR>
	<B>Xfer Answer Machine Message Display -</B> 
	坐席系统转接面板的“转接目标”中有个“语音信息”的项目，这个变量是控制该功能开关。
			<BR>
	<A NAME="more_Fast_Hangup_Xferline_And_Grab_Custline">
	<BR>
	<B>Fast Hangup Xferline And Grab Custline -</B> 
	在原来的VICIDIAL系统里，如果转接方式选择的是“保持客户拨号”，那么在坐席B不可用的时候，要通过“挂断第三方转接线”来取消转接，并且还要在电话控制区点击“接起”按钮才能继续和客户通话。目前如果设置该变量为Y时，在点击“挂断第三方转接线”的时候就顺带触发了“接起”按钮，不需要操作两次就可以继续和客户通话。
			<BR>
	<A NAME="more_Xfer_Target_Unavailable_Remind_Enable">
	<BR>
	<B>Xfer Target Unavailable Remind Enable -</B> 
	是否启用“转接坐席不可用的时候，弹出提示”功能。
			<BR>
	<A NAME="more_Xfer_Waiting_Web_Play_Music_Enable">
	<BR>
	<B>Xfer Waiting Web Play Music Enable -</B> 
	转接的时候，坐席A转坐席B，坐席B状态为不可用的时候电话在等待，这时WEB播放提示音乐提醒坐席B。
			<BR>
	<A NAME="more_Xfer_Waiting_Web_Play_Music_Filename">
	<BR>
	<B>Xfer Waiting Web Play Music Filename -</B> 
	转接的时候，坐席A转坐席B，坐席B状态为不可用的时候电话在等待，这时WEB播放提示音乐提醒坐席B。提示音乐的路径。
				<BR>
	<A NAME="more_phone_place_enable">
	<BR>
	<B>Phone Place Enable -</B> 
	在CCMS Agent界面来电时是否显示来电归属地。
	<BR>


	<A NAME="more_Phone_Place_DB_Server_IP">
	<BR>
	<B>Phone Place DB Server IP -</B> 
	在CCMS Agent界面来电时显示来电归属地信息查询数据库的IP。
	<BR>
		<A NAME="more_Phone_Place_DB_Name">
	<BR>
	<B>Phone Place DB Name -</B> 
	在CCMS Agent界面来电时显示来电归属地信息查询数据库的数据库名。
	<BR>
		<A NAME="more_Phone_Place_DB_Login">
	<BR>
	<B>Phone Place DB Login -</B> 
	在CCMS Agent界面来电时显示来电归属地信息查询数据库的用户名。
	<BR>
		<A NAME="more_Phone_Place_DB_Password">
	<BR>
	<B>Phone Place DB Password -</B> 
	在CCMS Agent界面来电时显示来电归属地信息查询数据库的密码。
	<BR>
		<A NAME="more_Phone_Place_Defaul">
	<BR>
	<B>Phone Place Defaul -</B> 
	在CCMS Agent界面来电时显示来电归属地默认值。
	<BR>



	<A NAME="more_Lead_Preview_Display">
	<BR>
	<B>Lead Preview Display -</B> 
	是否在按钮控制区显示"预览Lead"复选框。
				<BR>
	<A NAME="more_Dial_Next_Display">
	<BR>
	<B>Dial Next Display -</B> 
	当Campaign.dial_method配置为MANUAL或INBOUND_MAN模式时，系统外拨方式为：先从VICIDIAL后台导入一批Leads,然后让坐席通过点击“拨下一个”按钮来从数据库取lead外拨。回顾在东森项目刚上线的时候，我们配置的Campaign.dial_method为RATIO，这个模式由于是AUTODIAL模式的一种，所以在长时间没有呼入或者呼出时，系统会提示“您的会话已暂停”并且将该坐席的状态置为暂停，这就大大影响了他们工作。后来经过讨论决定将其模式转变为INBOUND_MAN模式，该问题就解决了。但INBOUND_MAN模式会在坐席系统界面多了一个“拨下一个”按钮，故用Dial_Next_Display变量来控制该按钮显示与否。
				<BR>
	<A NAME="more_Ingroup_Change_Enable">
	<BR>
	<B>Ingroup Change Enable -</B> 
	是否启用“坐席自由切换技能组”功能。
				<BR>
	<A NAME="more_Skip_Choose_Ingroup_Enable">
	<BR>
	<B>Skip Choose Ingroup Enable -</B> 
	当Campaign配置了多个技能组时，原版在登陆坐席系统的过程中会出现一个技能组多选界面，让坐席去选择技能组。该变量是控制该界面是否显示，因为现在坐席对应的技能组都是在后台user菜单里预先勾选好的。
				<BR>
	<A NAME="more_Incoming_Web_Play_Music_Enable">
	<BR>
	<B>Incoming Web Play Music Enable -</B> 
	是否启用“进线时，WEB播放提示音”功能。
	<BR>
	<A NAME="more_Incoming_Web_Play_Music_Filename">
	<BR>
	<B>Incoming Web Play Music Filename -</B> 
	当启用进线播放提示音功能，该项就需要填写录音文件路径。
	<BR>
	<A NAME="more_Default_Pause_Code_Enable">
	<BR>
	<B>Default Pause Code Enable -</B> 
	控制坐席登陆和选择暂停代码时是否自动插入默认暂停码。
	<BR>
	<A NAME="more_Pause_Code_Selected_Link_Display">
	<BR>
	<B>Pause Code Select Link Enable-</B> 
	是否显示“选择暂停原因链接”。
	<BR>
	<A NAME="more_Max_Pauses">
	<BR>
	<B>Max Pauses - </B> 
	同时暂停最大人数。
	<BR>
	<A NAME="more_Default_Pause_Code">
	<BR>
	<B>Default Pause Code -</B> 
	当Default_Pause_Code_Enable=Y,这项需要填写默认暂停码的status值。
	<BR>
	<A NAME="more_inbound_dids">
	<BR>
	<B>Inbound DIDs -</B> 
	campaign对应的DID。
	<BR>
	<A NAME="more_inbound_ivr">
	<BR>
	<B>Inbound IVR -</B>
	campaign对应的IVR。
	<BR>
	<A NAME="more_Extension_Info_Integration_Enable">
	<BR>
	<B>Enable Extension Info Integration -</B>
	是否启用"来电扩展信息"。
	<BR>
	<A NAME="more_Extension_Info_Db_Server_Ip">
	<BR>
	<B>Extension Info DB Server IP -</B>
	"来电扩展信息"对应的数据库IP。
	<BR>
	<A NAME="more_Extension_Info_Db_Name">
	<BR>
	<B>Extension Info DB Name -</B>
	"来电扩展信息"对应的数据库名。
	<BR>
	<A NAME="more_Extension_Info_Db_Login">
	<BR>
	<B>Extension Info DB Login -</B>
	"来电扩展信息"对应的数据库用户名。
	<BR>
	<A NAME="more_Extension_Info_Db_Password">
	<BR>
	<B>Extension Info DB Password -</B>
	"来电扩展信息"对应的数据库用户密码。
	<BR>
	<A NAME="more_extension_info_sql">
	<BR>
	<B>Extension Info SQL -</B>
	电话进线时，通话信息区自定义显示内容配置SQL,如：SELECT concat(concat("CID:",字段1),concat(" TID:",字段2)) FROM 表名 WHERE uniqueid=--A--uniqueid--B--。
	<BR>

	<A NAME="more_CCMS_Agent_Window_Align">
	<BR>
	<B>CCMS Agent Window Align -</B>
	当点击桌面图标时弹出CCMS Agent窗口水平对齐方式。
	<BR>
	<A NAME="more_CCMS_Agent_Window_Width">
	<BR>
	<B>CCMS Agent Window Width -</B>
	当点击桌面图标时弹出CCMS Agent窗口的宽度。
	<BR>


	<A NAME="more_IM_Enable">
	<BR>
	<B>IM Enable -</B>
	即时信息模块开关，默认为‘N’。
	<BR>
	<A NAME="more_IM_Talk_Level">
	<BR>
	<B>IM Send Message Level -</B>
	即时信息模块发送消息权限用户最低级别设置。
	<BR>
	<A NAME="more_IM_Admin_Level">
	<BR>
	<B>IM Admin Level  -</B>
	即时信息模块查看聊天记录和群发信息权限用户的最低级别设置。


	<!--  预测外拨功能 System Config:-->
	<BR>
	<A NAME="sys_conf_auto_dial_level_checkbox">
	<BR>
	<B>系统自动调整拨号级别 -</B>
	勾选系统自动调整拨号级别，系统将根据以下公式计算外呼线路数量， 外呼线路数量=当前空闲座席数*（刷新前  的拨号级别+/-当前平均等待时间导致的拨号级别增量+/-当前掉线率导致的拨号级别增量）【上述是+或者-可以通过页面配置项进行设置】，同时根据设置的刷新频率实时调整外呼线路数量进行外呼，反之，则按照拨号级别设置的固定值及当前空闲座席数计算外呼线路数量进行外呼
	<BR>
	<A NAME="sys_conf_auto_dial_level">
	<BR>
	<B>拨号级别: -</B>
	外呼拨号速率
	<BR>
	<A NAME="sys_conf_drop_call_seconds">
	<BR>
	<B>客户最大等待时长(S): -</B>
	外线接通后，等待多少秒系统主动挂机
	<BR>
	<A NAME="sys_conf_shortest_time_send_call">
	<BR>
	<B>最短提前派Call时长(S): -</B>
	ACW状态座席休息多长时间等待外线可以提前接入
	<BR>
	<A NAME="sys_conf_acw_hold_time">
	<BR>
	<B>ACW状态保持时长(S): -</B>
	ACW状态座席保持多长时间自动置为可用状态
	<BR>
	<A NAME="sys_conf_wait_time_for_connet_agent">
	<BR>
	<B>外拨派Call时长： -</B>
	外线接通到接入座席间隔多长时间
	<BR>
	<A NAME="sys_conf_limit_used_leads">
	<BR>
	<B>最低可拨打Lead百分比：-</B>
	系统最低可拨打百分比，当前可拨打Lead百分比（可拨打Lead数/总Lead数）如果低于最低可拨打Lead百分比，座席与管理员将会显示对应提示消息
	<BR>
	<A NAME="sys_conf_refresh_time">
	<BR>
	<B>刷新频率(M): -</B>
	系统参数，在自动调整拨号级别时使用，代表系统间隔多长时间来自动调整一次参数
	<BR>
	<A NAME="sys_conf_hopper_level">
	<BR>
	<B>拨号漏斗级别: -</B>
	 系统参数，号码缓冲池大小，拨号漏斗级别=座席数*最大拨号级别
	<BR>
	<A NAME="sys_conf_max_abandon_rate">
	<BR>
	<B>目标掉线率(%): -</B>
	KPI值，用户能接受的最高掉线率
	<BR>
	<A NAME="sys_conf_max_wait_time">
	<BR>
	<B>目标平均等待时间(S): -</B>
	KPI值，用户能接受的最长平均等待时间
	<BR>
	<A NAME="sys_conf_wait_time_avg">
	<BR>
	<B>平均等待时间(S): -</B>
	对比目标平均等待时间，平均等待时间变化量对应拨号级别变化量，如目标平均等待时间为15秒，  实际等待时间为20秒，平均等待时间变化量与拨号级别变化量的对应关系是1秒 VS 0.1,当前拨号级别将增加0.5
	<BR>
	<A NAME="sys_conf_wait_hopper_level">
	<BR>
	<B>拨号级别:  -</B>
	对比目标平均等待时间，平均等待时间变化量对应拨号级别变化量，如目标平均等待时间为15秒，  实际等待时间为20秒，平均等待时间变化量与拨号级别变化量的对应关系是1秒 VS 0.1,当前拨号级别将增加0.5
	<BR>
	<A NAME="sys_conf_abadon_rate_avg">
	<BR>
	<B>掉线率(%): -</B>
	 对比目标掉线率，掉线率变化量对应拨号级别变化量，如目标掉线率为10%，实际掉线率为15%，掉线率变化量与拨号级别变化量的对应关系是1% VS -0.1,当前拨号级别将减少0.5
	<BR>
	<A NAME="sys_conf_abandon_hopper_level">
	<BR>
	<B>拨号级别:  -</B>
	 对比目标掉线率，掉线率变化量对应拨号级别变化量，如目标掉线率为10%，实际掉线率为15%，掉线率变化量与拨号级别变化量的对应关系是1% VS -0.1,当前拨号级别将减少0.5




	<?php
	if ($SSoutbound_autodial_active > 0)
		{
		?>
		<BR>
		<A NAME="vicidial_campaigns-campaign_allow_inbound">
		<BR>
		<B>Allow Inbound and Blended -</B> This is where you can set whether the users of this campaign will have the option to take inbound calls with this campaign. If you want to do blended inbound and outbound then this must be set to Y. If you only want to do outbound dialing on this campaign set this to N. Default is N.

		<BR>
		<A NAME="vicidial_campaigns-dial_status">
		<BR>
		<B>Dial Status -</B> This is where you set the Call Result that you are wanting to dial on within the lists that are active for the campaign below. To add another status to dial, select it from the drop-down list and click ADD. To remove one of the dial Call Result, click on the REMOVE link next to the status you want to remove.

		<BR>
		<A NAME="vicidial_campaigns-lead_order">
		<BR>
		<B>List Order -</B> This menu is where you select how the leads that match the Call Result selected above will be put in the lead hopper:
		 <BR> &nbsp; - DOWN: select the first leads loaded into the vicidial_list table
		 <BR> &nbsp; - UP: select the last leads loaded into the vicidial_list table
		 <BR> &nbsp; - UP PHONE: select the highest phone number and works its way down
		 <BR> &nbsp; - DOWN PHONE: select the lowest phone number and works its way up
		 <BR> &nbsp; - UP LAST NAME: starts with last names starting with Z and works its way down
		 <BR> &nbsp; - DOWN LAST NAME: starts with last names starting with A and works its way up
		 <BR> &nbsp; - UP COUNT: starts with most called leads and works its way down
		 <BR> &nbsp; - DOWN COUNT: starts with least called leads and works its way up
		 <BR> &nbsp; - DOWN COUNT 2nd NEW: starts with least called leads and works its way up inserting a NEW lead in every other lead - Must NOT have NEW selected in the dial Call Result
		 <BR> &nbsp; - DOWN COUNT 3nd NEW: starts with least called leads and works its way up inserting a NEW lead in every third lead - Must NOT have NEW selected in the dial Call Result
		 <BR> &nbsp; - DOWN COUNT 4th NEW: starts with least called leads and works its way up inserting a NEW lead in every forth lead - Must NOT have NEW selected in the dial Call Result
		 <BR> &nbsp; - RANDOM: Randomly grabs lead within the Call Result and lists defined
		 <BR> &nbsp; - UP LAST CALL TIME: Sorts by the newest local call time for the leads
		 <BR> &nbsp; - DOWN LAST CALL TIME: Sorts by the oldest local call time for the leads
		 <BR> &nbsp; - UP RANK: Starts with the highest rank and works its way down
		 <BR> &nbsp; - DOWN RANK: Starts with the lowest rank and works its way up
		 <BR> &nbsp; - UP OWNER: Starts with owners beginning with Z and works its way down
		 <BR> &nbsp; - DOWN OWNER: Starts with owners beginning with A and works its way up
		 <BR> &nbsp; - UP TIMEZONE: Starts with Eastern timezones and works West
		 <BR> &nbsp; - DOWN TIMEZONE: Starts with Western timezones and works East

		<BR>
		<A NAME="vicidial_campaigns-hopper_level">
		<BR>
		<B>Hopper Level -</B> This is how many leads the VDhopper script tries to keep in the vicidial_hopper table for this campaign. If running VDhopper script every minute, make this slightly greater than the number of leads you go through in a minute.

		<BR>
		<A NAME="vicidial_campaigns-lead_filter_id">
		<BR>
		<B>Lead Filter -</B> This is a method of filtering your leads using a fragment of a SQL query. Use this feature with caution, it is easy to stop dialing accidentally with the slightest alteration to the SQL statement. Default is NONE.

		<BR>
		<A NAME="vicidial_campaigns-drop_lockout_time">
		<BR>
		<B>Drop Lockout Time -</B> This is a number of hours that DROP abandon calls will be prevented from being dialed, to disable set to N. This setting is very useful in countries like the UK where there are regulations preventing the attempted calling of customers within 72 hours of an Abandon, or DROP. Default is 0.

		<BR>
		<A NAME="vicidial_campaigns-force_reset_hopper">
		<BR>
		<B>Force Reset of Hopper -</B> This allows you to wipe out the hopper contents upon form submission. It should be filled again when the VDhopper script runs.

		<BR>
		<A NAME="vicidial_campaigns-dial_method">
		<BR>
		<B>Dial Method -</B> This field is the way to define how dialing is to take place. If MANUAL then the auto_dial_level will be locked at 0 unless Dial Method is changed. If RATIO then the normal dialing a number of lines for Active agents. ADAPT_HARD_LIMIT will dial predictively up to the dropped percentage and then not allow aggressive dialing once the drop limit is reached until the percentage goes down again. ADAPT_TAPERED allows for running over the dropped percentage in the first half of the shift -as defined by call_time selected for campaign- and gets more strict as the shift goes on. ADAPT_AVERAGE tries to maintain an average or the dropped percentage not imposing hard limits as aggressively as the other two methods. You cannot change the Auto Dial Level if you are in any of the ADAPT dial methods. Only the Dialer can change the dial level when in predictive dialing mode. INBOUND_MAN allows the agent to place manual dial calls from a campaign list while being able to take inbound calls between manual dial calls.

		<BR>
		<A NAME="vicidial_campaigns-auto_dial_level">
		<BR>
		<B>Auto Dial Level -</B> This is where you set how many lines CCMS should use per active agent. zero 0 means auto dialing is off and the agents will click to dial each number. Otherwise CCMS will keep dialing lines equal to active agents multiplied by the dial level to arrive at how many lines this campaign on each server should allow. The ADAPT OVERRIDE checkbox allows you to force a new dial level even though the dial method is in an ADAPT mode. This is useful if there is a dramatic shift in the quality of leads and you want to drastically change the dial_level manually.

		<BR>
		<A NAME="vicidial_campaigns-available_only_ratio_tally">
		<BR>
		<B>Available Only Tally -</B> This field if set to Y will leave out INCALL and QUEUE status agents when calculating the number of calls to dial when not in MANUAL dial mode. Default is N.

		<BR>
		<A NAME="vicidial_campaigns-adaptive_dropped_percentage">
		<BR>
		<B>Drop Percentage Limit -</B> This field is where you set the limit of the percentage of dropped calls you would like while using an adaptive-predictive dial method, not MANUAL or RATIO.

		<BR>
		<A NAME="vicidial_campaigns-adaptive_maximum_level">
		<BR>
		<B>Maximum Adapt Dial Level -</B> This field is where you set the limit of the limit to the numbr of lines you would like dialed per agent while using an adaptive-predictive dial method, not MANUAL or RATIO. This number can be higher than the Auto Dial Level if your hardware will support it. Value must be a positive number greater than one and can have decimal places Default 3.0.

		<BR>
		<A NAME="vicidial_campaigns-adaptive_latest_server_time">
		<BR>
		<B>Latest Server Time -</B> This field is only used by the ADAPT_TAPERED dial method. You should enter in the hour and minute that you will stop calling on this campaign, 2100 would mean that you will stop dialing this campaign at 9PM server time. This allows the Tapered algorithm to decide how aggressively to dial by how long you have until you will be finished calling.

		<BR>
		<A NAME="vicidial_campaigns-adaptive_intensity">
		<BR>
		<B>Adapt Intensity Modifier -</B> This field is used to adjust the predictive intensity either higher or lower. The higher a positive number you select, the greater the dialer will increase the call pacing when it goes up and the slower the dialer will decrease the call pacing when it goes down. The lower the negative number you select here, the slower the dialer will increase the call pacing and the faster the dialer will lower the call pacing when it goes down. Default is N. This field is not used by the MANUAL or RATIO dial methods.

		<BR>
		<A NAME="vicidial_campaigns-adaptive_dl_diff_target">
		<BR>
		<B>Dial Level Difference Target -</B> This field is used to define whether you want to target having a specific number of agents waiting for calls or calls waiting for agents. For example if you would always like to have on average one agent free to take calls immediately you would set this to -1, if you would like to target always having one call on hold waiting for an agent you would set this to 1. Default is 0. This field is not used by the MANUAL or RATIO dial methods.

		<BR>
		<A NAME="vicidial_campaigns-concurrent_transfers">
		<BR>
		<B>Concurrent Transfers -</B> This setting is used to define the number of calls that can be sent to agents at the same time. It is recommended that this setting is left at AUTO. This field is not used by the MANUAL dial method.

		<BR>
		<A NAME="vicidial_campaigns-queue_priority">
		<BR>
		<B>Queue Priority -</B> This setting is used to define the order in which the calls from this outbound campaign should be answered in relation to the inbound calls if this campaign is in blended mode.

		<BR>
		<A NAME="vicidial_campaigns-drop_rate_group">
		<BR>
		<B>Multiple Campaign Drop Rate Group -</B> This feature allows you to set a campaign as a member of a Campaign Drop Rate Group, or a group of campaigns whose Human Answered calls and Drop calls for all campaigns in the group will be combined into a shared drop percentage, or abandon rate. This allows you to to run multiple campaigns at once and more easily control your drop rate. This is particularly useful in the UK where regulations permit this drop rate calculation method with campaign grouping for the same company even if there are several campaigns that company is running during the same day. To enable this for a campaign, just select a group from the list. There are 10 groups defined in the system by default, you can contact your system administrator to add more. Default is DISABLED.

		<BR>
		<A NAME="vicidial_campaigns-auto_alt_dial">
		<BR>
		<B>Auto Alt-Number Dialing -</B> This setting is used to automatically dial alternate number fields while dialing in the RATIO and ADAPT dial methods when there is no contact at the main phone number for a lead, the NA, B, DC and N Call Result. This setting is not used by the MANUAL dial method. EXTENDED alternate numbers are numbers loaded into the system outside of the standard lead information screen. Using EXTENDED you can have hundreds of phone numbers for a single customer record.

		<BR>
		<A NAME="vicidial_campaigns-dial_timeout">
		<BR>
		<B>Dial Timeout -</B> If defined, calls that would normally hang up after the timeout defined in extensions.conf would instead timeout at this amount of seconds if it is less than the extensions.conf timeout. This allows for quickly changing dial timeouts from server to server and limiting the effects to a single campaign. If you are having a lot of Answering Machine or Voicemail calls you may want to try changing this value to between 21-26 and see if results improve.

		<BR>
		<A NAME="vicidial_campaigns-campaign_vdad_exten">
		<BR>
		<B>Campaign VDAD extension -</B> This field allows for a custom VDAD transfer extension. This allows you to use different call handling methods depending upon your campaign. 
	  - 8364 - same as 8368
	  - 8365 - Will send the call only to an agent on the same server as the call is on
	  - 8366 - Used for press-1 and survey campaigns
	  - 8367 - Will try to first send the call to an agent on the local server, then it will look on other servers
	  - 8368 - DEFAULT ?Will send the call to the next available agent no matter what server they are on
	  - 8369 - Used for Answering Machine Detection after that, same behavior as 8368
	  - 8373 - Used for Answering Machine Detection after that same behavior as 8366

		<BR>
		<A NAME="vicidial_campaigns-am_message_exten">
		<BR>
		<B>Answering Machine Message -</B> This field is for entering the prompt to play when the agent gets an answering machine and clicks on the Answering Machine Message button in the transfer conference frame. You must set this to either an audio file in the audio store or a TTS prompt if TTS is enabled on your system.

		<BR>
		<A NAME="vicidial_campaigns-waitforsilence_options">
		<BR>
		<B>WaitForSilence Options -</B> If Wait For Silence is desired on calls that are detected as Answering Machines then this field has those options. There are two settings separated by a comma, the first option is how long to detect silence in milliseconds and the second option is for how many times to detect that before playing the message. Default is EMPTY for disabled. A standard value for this would be wait for 2 seconds of silence twice: 2000,2

		<BR>
		<A NAME="vicidial_campaigns-amd_send_to_vmx">
		<BR>
		<B>AMD send to vm exten -</B> This menu allows you to define whether a message is left on an answering machine when it is detected. the call will be immediately forwarded to the Answering-Machine-Message extension if AMD is active and it is determined that the call is an answering machine.

		<BR>
		<A NAME="vicidial_campaigns-cpd_amd_action">
		<BR>
		<B>CPD AMD Action -</B> If you are using the Sangoma ParaXip Call Progress Detection software then you will want to enable this setting either setting it to DISPO which will disposition the call as AA and hang it up if the call is being processed and has not been sent to an agent yet or MESSAGE which will send the call to the defined Answering Machine Message for this campaign. Default is DISABLED.

		<BR>
		<A NAME="vicidial_campaigns-alt_number_dialing">
		<BR>
		<B>Agent Alt Num Dialing -</B> This option allows an agent to manually dial the alternate phone number or address3 field after the main number has been called.

		<BR>
		<A NAME="vicidial_campaigns-drop_call_seconds">
		<BR>
		<B>Drop Call Seconds -</B> The number of seconds from the time the customer line is picked up until the call is considered a DROP, only applies to outbound calls.

		<BR>
		<A NAME="vicidial_campaigns-drop_action">
		<BR>
		<B>Drop Action -</B> This menu allows you to choose what happens to a call when it has been waiting for longer than what is set in the Drop Call Seconds field. HANGUP will simply hang up the call, MESSAGE will send the call the Drop Exten that you have defined below, VOICEMAIL will send the call to the voicemail box that you have defined below and IN_GROUP will send the call to the Inbound Group that is defined below

		<BR>
		<A NAME="vicidial_campaigns-safe_harbor_exten">
		<BR>
		<B>Safe Harbor Exten -</B> This is the dial plan extension that the desired Safe Harbor audio file is located at on your server.

		<BR>
		<A NAME="vicidial_campaigns-voicemail_ext">
		<BR>
		<B>Voicemail -</B> If defined, calls that would normally DROP would instead be directed to this voicemail box to hear and leave a message.

		<BR>
		<A NAME="vicidial_campaigns-drop_inbound_group">
		<BR>
		<B>Drop Transfer Group -</B> If Drop Action is set to IN_GROUP, the call will be sent to this inbound group if it reaches Drop Call Seconds.

		<BR>
		<A NAME="vicidial_campaigns-no_hopper_leads_logins">
		<BR>
		<B>Allow No-Hopper-Leads Logins -</B> If set to Y, allows agents to login to the campaign even if there are no leads loaded into the hopper for that campaign. This function is not needed in CLOSER-type campaigns. Default is N.

		<BR>
		<A NAME="vicidial_campaigns-no_hopper_dialing">
		<BR>
		<B>No Hopper Dialing -</B> If This is enabled, the hopper will not run for this campaign. This option is only available when the dial method is set to MANUAL or INBOUND_MAN. It is recommended that you do not enable this option if you have a very large lead database, over 100,000 leads. With No Hopper Dialing, the following features do not work: lead recycling, auto-alt-dialing, list mix, list ordering with Xth NEW. If you want to use Owner Only Dialing you must have No Hopper Dialing enabled. Default is N for disabled.

		<BR>
		<A NAME="vicidial_campaigns-agent_dial_owner_only">
		<BR>
		<B>Owner Only Dialing -</B> If This is enabled, the agent will only receive leads that they are within the ownership parameters for. If this is set to USER then the agent must be the user defined in the database as the owner of this lead. If this is set to TERRITORY then the owner of the lead must match the territory listed in the User Modification screen for this agent. If this is set to USER_GROUP then the owner of the lead must match the user group that the agent is a member of. For this feature to work the dial method must be set to MANUAL or INBOUND_MAN and No Hopper Dialing must be enabled. Default is NONE for disabled.

		<?php
		if ($SSuser_territories_active > 0)
			{
			?>
			<BR>
			<A NAME="vicidial_campaigns-agent_select_territories">
			<BR>
			<B>Agent Select Territories -</B> If this option is enabled and the agent belongs to at least one territory, the agent will have the option of selecting territories to dial leads from. The agent will see a list of available territories upon login and they will have the ability to go back to that territory list when paused to change their territories. For this function to work the Owner Only Dialing option must be set to TERRITORY and User Terriories must be enabled in the System Settings.
			<?php
			}
		?>

		<BR>
		<A NAME="vicidial_campaigns-list_order_mix">
		<BR>
		<B>List Order Mix -</B> Overrides the Lead Order and Dial Status fields. Will use the List and status parameters for the selected List Mix entry in the List Mix sub section instead. Default is DISABLED.

		<BR>
		<A NAME="vicidial_campaigns-vcl_id">
		<BR>
		<B>List Mix ID -</B> ID of the list mix. Must be from 2-20 characters in length with no spaces or other special punctuation.

		<BR>
		<A NAME="vicidial_campaigns-vcl_name">
		<BR>
		<B>List Mix Name -</B> Descriptive name of the list mix. Must be from 2-50 characters in length.

		<BR>
		<A NAME="vicidial_campaigns-list_mix_container">
		<BR>
		<B>List Mix Detail -</B> The composition of the List Mix entry. Contains the List ID, mix order, percentages and Call Result that make up this List Mix. The percentages always have to add up to 100, and the lists all have to be active and set to the campaign for the order mix entry to be Activated.

		<BR>
		<A NAME="vicidial_campaigns-mix_method">
		<BR>
		<B>List Mix Method -</B> The method of mixing all of the parts of the List Mix Detail together. EVEN_MIX will mix leads from each part interleaved with the other parts, like this 1,2,3,1,2,3,1,2,3. IN_ORDER will put the leads in the order in which they are listed in the List Mix Detail screen 1,1,1,2,2,2,3,3,3. RANDOM will put them in RANDOM order 1,3,2,1,1,3,2,1,3. Default is IN_ORDER.

		<BR>
		<A NAME="vicidial_campaigns-agent_extended_alt_dial">
		<BR>
		<B>Agent Screen Extended Alt Dial -</B> This feature allows for agents to access extended alternate phone numbers for leads beyond the standard Alt Phone and Address3 fields that can be used in CCMS for phone numbers beyond the main phone number. The Extended phone numbers can be dialed automatically using the Auto-Alt-Dial feature in CCMS Campaign settings, but enabling this Agent Screen feature will also allow for the agent to call these numbers from their agent screen as well as edit their information.

		<BR>
		<A NAME="vicidial_campaigns-survey_first_audio_file">
		<BR>
		<B>Survey First Audio File -</B> This is the audio filename that is played as soon as the customer picks up the phone when running a survey campaign.

		<BR>
		<A NAME="vicidial_campaigns-survey_dtmf_digits">
		<BR>
		<B>Survey DTMF Digits -</B> This field is where you define the digits that a customer can press as an option on a survey campaign. valid dtmf digits are 0123456789*#. All options except for the Not Interested, Third and Fourth digit options will move on to the Survey Method call path.

		<BR>
		<A NAME="vicidial_campaigns-survey_ni_digit">
		<BR>
		<B>Survey Not Interested Digit -</B> This field is where you define the customer digit pressed that will show they are Not Interested.

		<BR>
		<A NAME="vicidial_campaigns-survey_ni_status">
		<BR>
		<B>Survey Not Interested Status -</B> This field is where you select the status to be used for Not Interested. If DNC is used and the campaign is set to use DNC then the phone number will be automatically added to the CCMS internal DNC list and possibly the campaign-specific DNC list.

		<BR>
		<A NAME="vicidial_campaigns-survey_opt_in_audio_file">
		<BR>
		<B>Survey Opt-in Audio File -</B> This is the audio filename that is played when the customer has opted-in to the survey, not opted-out or not responded if the no-response-action is set to OPTOUT. After this audio file is played, the Survey Method action is taken.

		<BR>
		<A NAME="vicidial_campaigns-survey_ni_audio_file">
		<BR>
		<B>Survey Not Interested Audio File -</B> This is the audio filename that is played when the customer has opted-out of the survey, not opted-in or not responded if the no-response-action is set to OPTIN. After this audio file is played, the call will be hung up.

		<BR>
		<A NAME="vicidial_campaigns-survey_method">
		<BR>
		<B>Survey Method -</B> This option defines what happens to a call after the customer has opted-in. AGENT_XFER will send the call to the next available agent. VOICEMAIL will send the call to the voicemail box that is specified in the Voicemail field. EXTENSION will send the customer to the extension defined in the Survey Xfer Extension field. HANGUP will hang up the customer. CAMPREC_60_WAV will send the customer to have a recording made with their response, this recording will be placed in a folder named as the campaign inside of the Survey Campaign Recording Directory.

		<BR>
		<A NAME="vicidial_campaigns-survey_no_response_action">
		<BR>
		<B>Survey No-Response Action -</B> This is where you define what will happen if there is no response to the survey question. OPTIN will only send the call on to the Survey Method if the customer presses a dtmf digit. OPTOUT will send the customer on to the Survey Method even if they do not press a dtmf digit.

		<BR>
		<A NAME="vicidial_campaigns-survey_response_digit_map">
		<BR>
		<B>Survey Response Digit Map -</B> This is the section where you can define a description to go with each dtmf digit option that the customer may select.

		<BR>
		<A NAME="vicidial_campaigns-survey_xfer_exten">
		<BR>
		<B>Survey Xfer Extension -</B> If the Survey Method of EXTENSION is selected then the customer call would be directed to this dialplan extension.

		<BR>
		<A NAME="vicidial_campaigns-survey_camp_record_dir">
		<BR>
		<B>Survey Campaign Recording Directory -</B> If the Survey Method of CAMPREC_60_WAV is selected then the customer response will be recorded and placed in a directory named after the campaign inside of this directory.

		<BR>
		<A NAME="vicidial_campaigns-survey_third_digit">
		<BR>
		<B>Survey Third Digit -</B> This allows for a third call path if the Third digit as defined in this field is pressed by the customer.

		<BR>
		<A NAME="vicidial_campaigns-survey_fourth_digit">
		<BR>
		<B>Survey Fourth Digit -</B> This allows for a fourth call path if the Fourth digit as defined in this field is pressed by the customer.

		<BR>
		<A NAME="vicidial_campaigns-survey_third_audio_file">
		<BR>
		<B>Survey Third Audio File -</B> This is the third audio file to be played upon the selection by the customer of the Third Digit option.

		<BR>
		<A NAME="vicidial_campaigns-survey_third_status">
		<BR>
		<B>Survey Third Status -</B> This is the third status used for the call upon the selection by the customer of the Third Digit option.

		<BR>
		<A NAME="vicidial_campaigns-survey_third_exten">
		<BR>
		<B>Survey Third Extension -</B> This is the third extension used for the call upon the selection by the customer of the Third Digit option. Default is 8300 which immediately hangs up the call after the Audio File message is played.

		<BR>
		<A NAME="vicidial_campaigns-agent_display_dialable_leads">
		<BR>
		<B>Agent Display Dialable Leads -</B> This option if enabled will show the number of dialable leads available in the campaign in the agent screen. This number is updated in the system once a minute and will be refreshed on the agent screen every few seconds.

		<?php
		}
	?>

	<BR>
	<A NAME="vicidial_campaigns-next_agent_call">
	<BR>
	<B>Next Agent Call -</B> This determines which agent receives the next call that is available:
	 <BR> &nbsp; - random: orders by the random update value in the vicidial_live_agents table
	 <BR> &nbsp; - oldest_call_start: orders by the last time an agent was sent a call. Results in agents receiving about the same number of calls overall.
	 <BR> &nbsp; - oldest_call_finish: orders by the last time an agent finished a call. AKA agent waiting longest receives first call.
	 <BR> &nbsp; - overall_user_level: orders by the user_level of the agent as defined in the vicidial_users table a higher user_level will receive more calls.
	 <BR> &nbsp; - campaign_rank: orders by the rank given to the agent for the campaign. Highest to Lowest.
	 <BR> &nbsp; - fewest_calls: orders by the number of calls received by an agent for that specific inbound group. Least calls first.
	 <BR> &nbsp; - longest_wait_time: orders by the amount of time agent has been actively waiting for a call.

	<BR>
	<A NAME="vicidial_campaigns-local_call_time">
	<BR>
	<B>Local Call Time -</B> This is where you set during which hours you would like to dial, as determined by the local time in the are in which you are calling. This is controlled by area code and is adjusted for Daylight Savings time if applicable. General Guidelines in the USA for Business to Business is 9am to 5pm and Business to Consumer calls is 9am to 9pm.

	<BR>
	<A NAME="vicidial_campaigns-dial_prefix">
	<BR>
	<B>Dial Prefix -</B> This field allows for more easily changing a path of dialing to go out through a different method without doing a reload in Asterisk. Default is 9 based upon a 91NXXNXXXXXX in the dial plan - extensions.conf.

	<BR>
	<A NAME="vicidial_campaigns-omit_phone_code">
	<BR>
	<B>Omit Phone Code -</B> This field allows you to leave out the phone_code field while dialing within CCMS. For instance if you are dialing in the UK from the UK you would have 44 in as your phone_code field for all leads, but you just want to dial 10 digits in your dial plan extensions.conf to place calls instead of 44 then 10 digits. Default is N.

	<BR>
	<A NAME="vicidial_campaigns-campaign_cid">
	<BR>
	<B>Campaign CallerID -</B> This field allows for the sending of a custom callerid number on the outbound calls. This is the number that would show up on the callerid of the person you are calling. The default is UNKNOWN. If you are using T1 or E1s to dial out this option is only available if you are using PRIs - ISDN T1s or E1s - that have the custom callerid feature turned on, this will not work with Robbed-bit service -RBS- circuits. This will also work through most VOIP -SIP or IAX trunks- providers that allow dynamic outbound callerID. The custom callerID only applies to calls placed for the CCMS campaign directly, any 3rd party calls or transfers will not send the custom callerID. NOTE: Sometimes putting UNKNOWN or PRIVATE in the field will yield the sending of your default callerID number by your carrier with the calls. You may want to test this and put 0000000000 in the callerid field instead if you do not want to send you CallerID.

	<BR>
	<A NAME="vicidial_campaigns-campaign_rec_exten">
	<BR>
	<B>Campaign Rec extension -</B> This field allows for a custom recording extension to be used with CCMS. This allows you to use different extensions depending upon how long you want to allow a maximum recording and what type of codec you want to record in. The default exten is 8309 which if you follow the SCRATCH_INSTALL examples will record in the WAV format for upto one hour. Another option included in the examples is 8310 which will record in GSM format for upto one hour.

	<BR>
	<A NAME="vicidial_campaigns-campaign_recording">
	<BR>
	<B>Campaign Recording -</B> This menu allows you to choose what level of recording is allowed on this campaign. NEVER will disable recording on the client. ONDEMAND is the default and allows the agent to start and stop recording as needed. ALLCALLS will start recording on the client whenever a call is sent to an agent. ALLFORCE will start recording on the client whenever a call is sent to an agent giving the agent no option to stop recording. For ALLCALLS and ALLFORCE there is an option to use the Recording Delay to cut down on very short recordings and recude system load.

	<BR>
	<A NAME="vicidial_campaigns-campaign_rec_filename">
	<BR>
	<B>Campaign Rec Filename -</B> This field allows you to customize the name of the recording when Campaign recording is ONDEMAND or ALLCALLS. The allowed variables are CAMPAIGN CUSTPHONE FULLDATE TINYDATE EPOCH AGENT. The default is FULLDATE_AGENT and would look like this 20051020-103108_6666. Another example is CAMPAIGN_TINYDATE_CUSTPHONE which would look like this TESTCAMP_51020103108_3125551212. 50 char max.

	<BR>
	<A NAME="vicidial_campaigns-allcalls_delay">
	<BR>
	<B>Recording Delay -</B> For ALLCALLS and ALLFORCE recording only. This setting will delay the starting of the recording on all calls for the number of seconds specified in this field. Default is 0.

	<BR>
	<A NAME="vicidial_campaigns-campaign_script">
	<BR>
	<B>Campaign Script -</B> This menu allows you to choose the script that will appear on the agents screen for this campaign. Select NONE to show no script for this campaign.

	<BR>
	<A NAME="vicidial_campaigns-get_call_launch">
	<BR>
	<B>Get Call Launch -</B> This menu allows you to choose whether you want to auto-launch the web-form page in a separate window, auto-switch to the SCRIPT tab or do nothing when a call is sent to the agent for this campaign. 

	<BR>
	<A NAME="vicidial_campaigns-xferconf_a_dtmf">
	<BR>
	<B>Xfer-Conf DTMF -</B> These four fields allow for you to have two sets of Transfer Conference and DTMF presets. When the call or campaign is loaded, the vicidial.php script will show two buttons on the transfer-conference frame and auto-populate the number-to-dial and the send-dtmf fields when pressed. If you want to allow Consultative Transfers, a fronter to a closer, have the agent use the CONSULTATIVE checkbox, which does not work for third party non-CCMS consultative calls. For those just have the agent click the Dial With Customer button. Then the agent can just LEAVE-3WAY-CALL and move on to their next call. If you want to allow Blind transfers of customers to a CCMS AGI script for logging or an IVR, then place AXFER in the number-to-dial field. You can also specify an custom extension after the AXFER, for instance if you want to do a call to a special IVR you have set to extension 83900 you would put AXFER83900 in the number-to-dial field.

	<BR>
	<A NAME="vicidial_campaigns-xferconf_a_dtmf_name">
	<BR>
	<B>Transfer-Conf Name -</B> 转接面版外线号码对应的名称
	
	<BR>
	<A NAME="vicidial_campaigns-quick_transfer_button">
	<BR>
	<B>Quick Transfer Button -</B> This option will add a Quick Transfer button to the agent screen below the Transfer-Conf button that will allow one click blind transferring of calls to the selected In-Group or number. IN_GROUP will send calls to the Default Xfer Group for this Campaign, or In-Group if there was an inbound call. The PRESET options will send the calls to the preset selected. Default is N for disabled.

	<BR>
	<A NAME="vicidial_campaigns-prepopulate_transfer_preset">
	<BR>
	<B>PrePopulate Transfer Preset -</B> This option will fill in the Number to Dial field in the Transfer Conference frame of the agent screen if defined. Default is N for disabled.

	<BR>
	<A NAME="vicidial_campaigns-timer_action">
	<BR>
	<B>Timer Action -</B> This feature allows you to trigger actions after a certain amount of time. the D1 and D2 DIAL options will launch a call to the Transfer Conference Number presets and send them to the agent session, this is usually used for simple IVR validation AGI applications or just to play a pre-recorded message. WEBFORM will open the web form address. MESSAGE_ONLY will simply display the message that is in the field below. NONE will disable this feature and is the default.

	<BR>
	<A NAME="vicidial_campaigns-timer_action_message">
	<BR>
	<B>Timer Action Message -</B> This is the message that appears on the agent screen at the time the Timer Action is triggered.

	<BR>
	<A NAME="vicidial_campaigns-timer_action_seconds">
	<BR>
	<B>Timer Action Seconds -</B> This is the amount of time after the call is connected to the customer that the Timer Action is triggered. Default is -1 which is also inactive.

	<BR>
	<A NAME="vicidial_campaigns-scheduled_callbacks">
	<BR>
	<B>Scheduled Callbacks -</B> This option allows an agent to disposition a call as CALLBK and choose the data and time at which the lead will be re-activated.

	<BR>
	<A NAME="vicidial_campaigns-wrapup_seconds">
	<BR>
	<B>Wrap Up Seconds -</B> The number of seconds to force an agent to wait before allowing them to receive or dial another call. The timer begins as soon as an agent hangs up on their customer - or in the case of alternate number dialing when the agent finishes the lead - Default is 0 seconds. If the timer runs out before the agent has dispositioned the call, the agent still will NOT move on to the next call until they select a disposition.

	<BR>
	<A NAME="vicidial_campaigns-wrapup_message">
	<BR>
	<B>Wrap Up Message -</B> This is a campaign-specific message to be displayed on the wrap up screen if wrap up seconds is set.

	<BR>
	<A NAME="vicidial_campaigns-use_internal_dnc">
	<BR>
	<B>Use Internal DNC List -</B> This defines whether this campaign is to filter leads against the Internal DNC list. If it is set to Y, the hopper will look for each phone number in the DNC list before placing it in the hopper. If it is in the DNC list then it will change that lead status to DNCL so it cannot be dialed. Default is N. The AREACODE option is just like the Y option, except it is used to also filter out an entire area code in North America from being dialed, in this case using the 201XXXXXXX entry in the DNC list would block all calls to the 201 areacode if enabled.

	<BR>
	<A NAME="vicidial_campaigns-use_campaign_dnc">
	<BR>
	<B>Use Campaign DNC List -</B> This defines whether this campaign is to filter leads against a DNC list that is specific to that campaign only. If it is set to Y, the hopper will look for each phone number in the campaign-specific DNC list before placing it in the hopper. If it is in the campaign-specific DNC list then it will change that lead status to DNCC so it cannot be dialed. Default is N. The AREACODE option is just like the Y option, except it is used to also filter out an entire area code in North America from being dialed, in this case using the 201XXXXXXX entry in the DNC list would block all calls to the 201 areacode if enabled.

	<BR>
	<A NAME="vicidial_campaigns-closer_campaigns">
	<BR>
	<B>Allowed Inbound Groups -</B> For CLOSER campaigns only. Here is where you select the inbound groups you want agents in this CLOSER campaign to be able to take calls from. It is important for BLENDED inbound-outbound campaigns only to select the inbound groups that are used for agents in this campaign. The calls coming into the inbound groups selected here will be counted as active calls for a blended campaign even if all agents in the campaign are not logged in to receive calls from all of those selected inbound groups.

	<BR>
	<A NAME="vicidial_campaigns-agent_pause_codes_active">
	<BR>
	<B>Agent Pause Codes Active -</B> Allows agents to select a pause code when they click on the PAUSE button in vicidial.php. Pause codes are definable per campaign at the bottom of the campaign view detail screen and they are stored in the vicidial_agent_log table. Default is N. FORCE will force the agents to choose a PAUSE code if they click on the PAUSE button.

	<BR>
	<A NAME="vicidial_campaigns-disable_alter_custdata">
	<BR>
	<B>Disable Alter Customer Data -</B> If set to Y, does not change any of the customer data record when an agent dispositions the call. Default is N.

	<BR>
	<A NAME="vicidial_campaigns-disable_alter_custphone">
	<BR>
	<B>Disable Alter Customer Phone -</B> If set to Y, does not change the customer phone number when an agent dispositions the call. Default is Y. Use the HIDE option to completely remove the customer phone number from the agent display.

	<BR>
	<A NAME="vicidial_campaigns-display_queue_count">
	<BR>
	<B>Agent Display Queue Count -</B> If set to Y, when a customer is waiting for an agent, the Queue Calls display at the top of the agent screen will turn red and show the number of waiting calls. Default is Y.

	<BR>
	<A NAME="vicidial_campaigns-manual_dial_list_id">
	<BR>
	<B>Manual Dial List ID -</B> The default list_id to be used when an agent placces a manual call and a new lead record is created in vicidial_list. Default is 999. This field can contain digits only.

	<BR>
	<A NAME="vicidial_campaigns-manual_dial_filter">
	<BR>
	<B>Manual Dial Filter -</B> This allows you to filter the calls that agents make in manual dial mode for this campaign by any combination of the following: DNC - to kick out, CAMPAIGNLISTS - the number must be within the lists for the campaign, NONE - no filter on manual dial or fast dial lists.

	<BR>
	<A NAME="vicidial_campaigns-agent_clipboard_copy">
	<BR>
	<B>Agent Screen Clipboard Copy -</B> THIS FEATURE IS CURRENTLY ONLY ENABLED FOR INTERNET EXPLORER. This feature allows you to select a field that will be copied to the computer clipboard of the agent computer upon a call being sent to an agent. Common uses for this are to allow for easy pasting of account numbers or phone numbers into legacy client applications on the agent computer.

	<BR>
	<A NAME="vicidial_campaigns-three_way_call_cid">
	<BR>
	<B>3-Way Call Outbound CallerID -</B> This defines what is sent out as the outbound callerID number from 3-way calls placed by the agent, CAMPAIGN uses the custom campaign callerID, CUSTOMER uses the number of the customer that is active on the agents screen and AGENT_PHONE uses the callerID for the phone that the agent is logged into. AGENT_CHOOSE allows the agent to choose which callerID to use for 3-way calls from a list of choices.

	<BR>
	<A NAME="vicidial_campaigns-three_way_dial_prefix">
	<BR>
	<B>3-Way Call Dial Prefix -</B> This defines what is used as the dial prefix for 3-way calls, default is empty so the campaign dial prefix is used, passthru so you can hear ringing is 88.

	<?php
	if ($SSqc_features_active > 0)
		{
		?>
		<BR>
		<A NAME="vicidial_campaigns-qc_enabled">
		<BR>
		<B>QC Enabled -</B> Setting this field to Y allows for the agent Quality Control features to work. Default is N.

		<BR>
		<A NAME="vicidial_campaigns-qc_statuses">
		<BR>
		<B>QC Call Result -</B> This area is where you select which Call Result of leads should be gone over by the QC system. Place a check next to the status that you want QC to review. 

		<BR>
		<A NAME="vicidial_campaigns-qc_shift_id">
		<BR>
		<B>QC Shift -</B> This is the shift timeframe used to pull QC records for a campaign. The days of the week are ignored for these functions.

		<BR>
		<A NAME="vicidial_campaigns-qc_get_record_launch">
		<BR>
		<B>QC Get Record Launch-</B> This allows one of the following actions to be triggered upon a QC agent receiving a new record.

		<BR>
		<A NAME="vicidial_campaigns-qc_show_recording">
		<BR>
		<B>QC Show Recording -</B> This allows for a recording that may be linked with the QC record to be display in the QC agent screen.

		<BR>
		<A NAME="vicidial_campaigns-qc_web_form_address">
		<BR>
		<B>QC WebForm Address -</B> This is the website address that a QC agent can go to when clicking on the WEBFORM link in the QC screen.

		<BR>
		<A NAME="vicidial_campaigns-qc_script">
		<BR>
		<B>QC Script -</B> This is the script that can be used by QC agents in the SCRIPT tab in the QC screen.
		<?php
		}
	?>

	<BR>
	<A NAME="vicidial_campaigns-vtiger_search_category">
	<BR>
	<B>CRM Search Category -</B> If CRM integration is enabled in the system settings then this setting will define where the vtiger_search.php page will search for the phone number that was entered. There are 4 options that can be used in this field: LEAD- This option will search through the CRM leads only, ACCOUNT- This option will search through the CRM accounts and all contacts and sub-contacts for the phone number, VENDOR- This option will only search through the CRM vendors, ACCTID- This option works only for accounts and it will take the CCMS vendor_lead_code field and try to search for the CRM account ID. If unsuccessful it will try any other methods listed that you have selected. Multiple options can be used for each search, but on large databases this is not recommended. Default is LEAD. UNIFIED_CONTACT- This option will use the beta CRM 5.1.0 feature to search by phone number and bring up a search page in CRM.

	<BR>
	<A NAME="vicidial_campaigns-vtiger_search_dead">
	<BR>
	<B>CRM Search Dead Accounts -</B> If CRM integration is enabled in the system settings then this setting will define whether deleted accounts will be searched when the agent clicks WEB FORM to search in the CRM system. DISABLED- deleted leads will not be searched, ASK- deleted leads will be searched and the CRM search web page will ask the agent if they want to make the CRM account active, RESURRECT- will automatically make the deleted account active again and will take the agent to the account screen without delay upon clicking on WEB FORM. Default is DISABLED.

	<BR>
	<A NAME="vicidial_campaigns-vtiger_create_call_record">
	<BR>
	<B>CRM Create Call Record -</B> If CRM integration is enabled in the system settings then this setting will define whether a new CRM activity record is created for the call when the agent goes to the vtiger_search page. Default is Y. The DISPO option will create a call record for the CRM account without the agent needing to go to the CRM search page through the WEB FORM.

	<BR>
	<A NAME="vicidial_campaigns-vtiger_create_lead_record">
	<BR>
	<B>CRM Create Lead Record -</B> If CRM integration is enabled in the system settings and CRM Search Category includes LEAD then this setting will define whether a new CRM lead record is created when the agent goes to the vtiger_search page and no record is found to have the call phone number. Default is Y.

	<BR>
	<A NAME="vicidial_campaigns-vtiger_screen_login">
	<BR>
	<B>CRM Screen Login -</B> If CRM integration is enabled in the system settings then this setting will define whether the user is logged into the CRM interface automatically when they login to CCMS. Default is Y. The NEW_WINDOW option will open a new window upon login to the CCMS agent screen.

	<BR>
	<A NAME="vicidial_campaigns-vtiger_status_call">
	<BR>
	<B>CRM Status Call -</B> If CRM integration is enabled in the system settings then this setting will define whether the status of the CRM Account will be updated with the status of the CCMS call after it has been dispositioned. Default is N.

	<BR>
	<A NAME="vicidial_campaigns-crm_popup_login">
	<BR>
	<B>CRM Popup Login -</B> If set to Y, the CRM Popup Address is used to open a new window on agent login to this campaign. Default is N.

	<BR>
	<A NAME="vicidial_campaigns-crm_login_address">
	<BR>
	<B>CRM Popup Address -</B> The web address of a CRM login page, it can have variables populated just like the web form address, with the VAR in the front and using --A--user_custom_one--B-- to define variables.
	<BR>
	<A NAME="vicidial_campaigns-start_call_url">
	<BR>
	<B>Start Call URL -</B> This web URL address is not seen by the agent, but it is called every time a call is sent to an agent if it is populated. Uses the same variables as the web form fields and scripts. This URL can NOT be a relative path. The Start URL does not work for Manual dial calls. Default is blank.

	<BR>
	<A NAME="vicidial_campaigns-crm_target">
	<BR>
	<B>CRM Target -</B> CRM open target.
	<BR>
	<A NAME="vicidial_campaigns-dispo_call_url">
	<BR>
	<B>Dispo Call URL -</B> This web URL address is not seen by the agent, but it is called every time a call is dispositioned by an agent if it is populated. Uses the same variables as the web form fields and scripts. dispo and talk_time are the variables you can use to retrieve the agent-defined disposition for the call and the actual talk time in seconds of the call. This URL can NOT be a relative path. Default is blank.

	<BR>
	<A NAME="vicidial_campaigns-agent_allow_group_alias">
	<BR>
	<B>Group Alias Allowed -</B> If you want to allow your agents to use group aliases then you need to set this to Y. Group Aliases are explained more in the Admin section, they allow agents to select different callerIDs for outbound manual calls that they may place. Default is N.

	<BR>
	<A NAME="vicidial_campaigns-default_group_alias">
	<BR>
	<B>Default Group Alias -</B> If you have allowed Group Aliases then this is the group alias that is selected first by default when the agent chooses to use a Group Alias for an outbound manual call. Default is NONE or empty.

	<BR>
	<A NAME="vicidial_campaigns-view_calls_in_queue">
	<BR>
	<B>Agent View Calls in Queue -</B> If set to anything but NONE, agents will be able to see details about the calls that are waiting in queue in their agent screen. If set to a number value, the calls displayed will be limited to the number selected. Default is NONE.

	<BR>
	<A NAME="vicidial_campaigns-view_calls_in_queue_launch">
	<BR>
	<B>View Calls in Queue Launch -</B> This setting if set to AUTO will have the Calls in Queue frame show up upon login by the agent into the agent screen. Default is MANUAL.

	<BR>
	<A NAME="vicidial_campaigns-grab_calls_in_queue">
	<BR>
	<B>Agent Grab Calls in Queue -</B> This option if set to Y will allow the agent to select the call that they want to take from the Calls in Queue display by clicking on it while paused. Agents will only be able to grab inbound calls or transferred calls, not outbound calls. Default is N.

	<BR>
	<A NAME="vicidial_campaigns-call_requeue_button">
	<BR>
	<B>Agent Call Re-Queue Button -</B> This option if set to Y will add a Re-Queue Customer button to the agent screen, allowing the agent to send the call into an AGENTDIRECT queue that is reserved for the agent only. Default is N.

	<BR>
	<A NAME="vicidial_campaigns-pause_after_each_call">
	<BR>
	<B>Agent Pause After Each Call -</B> This option if set to Y will pause the agent after every call automatically. Default is N.





	<BR><BR><BR><BR>

	<B><FONT SIZE=3>VICIDIAL_LISTS TABLE</FONT></B><BR><BR>
	<A NAME="vicidial_lists-list_id">
	<BR>
	<B>List ID -</B> This is the numerical name of the list, it is not editable after initial submission, must contain only numbers and must be between 2 and 8 characters in length. Must be a number greater than 100.

	<BR>
	<A NAME="vicidial_lists-list_name">
	<BR>
	<B>List Name -</B> This is the description of the list, it must be between 2 and 20 characters in length.

	<BR>
	<A NAME="vicidial_lists-list_description">
	<BR>
	<B>List Description -</B> This is the memo field for the list, it is optional.

	<BR>
	<A NAME="vicidial_lists-list_changedate">
	<BR>
	<B>List Change Date -</B> This is the last time that the settings for this list were modified in any way.

	<BR>
	<A NAME="vicidial_lists-list_lastcalldate">
	<BR>
	<B>List Last Call Date -</B> This is the last time that lead was dialed from this list.

	<BR>
	<A NAME="vicidial_lists-campaign_id">
	<BR>
	<B>Campaign -</B> This is the campaign that this list belongs to. A list can only be dialed on a single campaign at one time.

	<BR>
	<A NAME="vicidial_lists-active">
	<BR>
	<B>Active -</B> This defines whether the list is to be dialed on or not.

	<BR>
	<A NAME="vicidial_lists-reset_list">
	<BR>
	<B>Reset Lead-Called-Status for this list -</B> This resets all leads in this list to N for "not called since last reset" and means that any lead can now be called if it is the right status as defined in the campaign screen.

	<BR>
	<A NAME="vicidial_lists-reset_time">
	<BR>
	<B>Reset Times -</B> This field allows you to put times in, separated by a dash-, that this list will be automatically reset by the system. The times must be in 24 hour format with no punctuation, for example 0800-1700 would reset the list at 8AM and 5PM every day. Default is empty.

	<BR>
	<A NAME="vicidial_lists-agent_script_override">
	<BR>
	<B>Agent Script Override -</B> If this field is set, this will be the script that the agent sees on their screen instead of the campaign script when the lead is from this list. Default is not set.

	<BR>
	<A NAME="vicidial_lists-campaign_cid_override">
	<BR>
	<B>Campaign CID Override -</B> If this field is set, this will override the campaign CallerID that is set for calls that are placed to leads in this list. Default is not set.

	<BR>
	<A NAME="vicidial_lists-am_message_exten_override">
	<BR>
	<B>Answering Machine Message Override -</B> If this field is set, this will override the Answering Machine Message set in the campaign for customers in this list. Default is not set. 
	<BR>
	<A NAME="vicidial_lists-drop_inbound_group_override">
	<BR>
	<B>Drop Inbound Group Override -</B> If this field is set, this in-group will be used for outbound calls within this list that drop from the outbound campaign instead of the drop in-group set in the campaign detail screen. Default is not set.

	<BR>
	<A NAME="vicidial_lists-xferconf_a_dtmf">
	<BR>
	<B>Xfer-Conf Number Override -</B> These five fields allow for you to override the Transfer Conference number presets when the lead is from this list. Default is blank.


	<BR>
	<A NAME="vicidial_list-dnc">
	<BR>
	<B>CCMS DNC List -</B> This Do Not Call list contains every lead that has been set to a status of DNC in the system. Through the LISTS - ADD NUMBER TO DNC page you are able to manually add numbers to this list so that they will not be called by campaigns that use the internal DNC list. There is also the option to add leads to the campaign-specific DNC lists for those campaigns that have them. If you have the active DNC option set to AREACODE then you can also use area code wildcard entries like this 201XXXXXXX to block all calls to the 201 areacode when enabled.



	<BR><BR><BR><BR>

	<B><FONT SIZE=3>VICIDIAL_INBOUND_GROUPS TABLE</FONT></B><BR><BR>
	<A NAME="vicidial_inbound_groups-group_id">
	<BR>
	<B>Group ID -</B> This is the short name of the inbound group, it is not editable after initial submission, must not contain any spaces and must be between 2 and 20 characters in length.

	<BR>
	<A NAME="vicidial_inbound_groups-group_name">
	<BR>
	<B>Group Name -</B> This is the description of the group, it must be between 2 and 30 characters in length. Cannot include dashes, plusses or spaces .

	<BR>
	<A NAME="vicidial_inbound_groups-group_color">
	<BR>
	<B>Group Color -</B> This is the color that displays in the CCMS client app when a call comes in on this group. It must be between 2 and 7 characters long. If this is a hex color definition you must remember to put a # at the beginning of the string or CCMS will not work properly.

	<BR>
	<A NAME="vicidial_inbound_groups-active">
	<BR>
	<B>Active -</B> This determines whether this group show up in the selection box when a CCMS agent logs in.

	<BR>
	<A NAME="vicidial_inbound_groups-web_form_address">
	<BR>
	<B>Web Form -</B> This is the custom address that clicking on the WEB FORM button in CCMS will take you to for calls that come in on this group.

	<BR>
	<A NAME="vicidial_inbound_groups-inbound_mode">
	<BR>
	<B>Inbound Mode -</B> 响铃模式,可选择的选项包括ring和auto。
	<BR>
	<A NAME="vicidial_inbound_groups-ring_timeout_seconds">
	<BR>
	<B>Ring timeout Seconds -</B> 响铃模式为ring时的响铃超时时间。

	<BR>
	<A NAME="vicidial_inbound_groups-next_agent_call">
	<BR>
	<B>Next Agent Call -</B> This determines which agent receives the next call that is available:
	 <BR> &nbsp; - random: orders by the random update value in the vicidial_live_agents table
	 <BR> &nbsp; - oldest_call_start: orders by the last time an agent was sent a call. Results in agents receiving about the same number of calls overall.
	 <BR> &nbsp; - oldest_call_finish: orders by the last time an agent finished a call. AKA agent waiting longest receives first call.
	 <BR> &nbsp; - overall_user_level: orders by the user_level of the agent as defined in the vicidial_users table a higher user_level will receive more calls.
	 <BR> &nbsp; - inbound_group_rank: orders by the rank given to the agent for the specific inbound group. Highest to Lowest.
	 <BR> &nbsp; - fewest_calls: orders by the number of calls received by an agent for that specific inbound group. Least calls first.
	 <BR> &nbsp; - campaign_rank: orders by the rank given to the agent for the campaign. Highest to Lowest.
	 <BR> &nbsp; - fewest_calls_campaign: orders by the number of calls received by an agent for the campaign. Least calls first.
	 <BR> &nbsp; - longest_wait_time: orders by the amount of time agent has been actively waiting for a call.
	<BR>

	<A NAME="vicidial_agent_follow_up">
	<BR>
	<B>Agent Follow Up -</B> 当为Y时，进入该In-Group的的Call首先判断此lead此前的处理人(user)是否不为空，并且当前登录用户有此user且状态为可用，则优先分派给此user，否则按原流程分派.

	<BR>
	<A NAME="vicidial_inbound_groups-queue_priority">
	<BR>
	<B>Queue Priority -</B> This setting is used to define the order in which the calls from this inbound group should be answered in relation to calls from other inbound groups.

	<A NAME="vicidial_inbound_groups-fronter_display">
	<BR>

	<B>Fronter Display -</B> This field determines whether the inbound CCMS agent would have the fronter name - if there is one - displayed in the Status field when the call comes to the agent.

	<BR>
	<A NAME="vicidial_inbound_groups-ingroup_script">
	<BR>
	<B>Campaign Script -</B> This menu allows you to choose the script that will appear on the agents screen for this campaign. Select NONE to show no script for this campaign.

	<BR>
	<A NAME="vicidial_inbound_groups-get_call_launch">
	<BR>
	<B>Get Call Launch -</B> This menu allows you to choose whether you want to auto-launch the web-form page in a separate window, auto-switch to the SCRIPT tab or do nothing when a call is sent to the agent for this campaign. 

	<BR>
	<A NAME="vicidial_inbound_groups-xferconf_a_dtmf">
	<BR>
	<B>Xfer-Conf DTMF -</B> These four fields allow for you to have two sets of Transfer Conference and DTMF presets. When the call or campaign is loaded, the vicidial.php script will show two buttons on the transfer-conference frame and auto-populate the number-to-dial and the send-dtmf fields when pressed. If you want to allow Consultative Transfers, a fronter to a closer, have the agent use the CONSULTATIVE checkbox, which does not work for third party non-CCMS consultative calls. For those just have the agent click the Dial With Customer button. Then the agent can just LEAVE-3WAY-CALL and move on to their next call. If you want to allow Blind transfers of customers to a CCMS AGI script for logging or an IVR, then place AXFER in the number-to-dial field. You can also specify an custom extension after the AXFER, for instance if you want to do a call to a special IVR you have set to extension 83900 you would put AXFER83900 in the number-to-dial field.

	<BR>
	<A NAME="vicidial_inbound_groups-timer_action">
	<BR>
	<B>Timer Action -</B> This feature allows you to trigger actions after a certain amount of time. the D1 and D2 DIAL options will launch a call to the Transfer Conference Number presets and send them to the agent session, this is usually used for simple IVR validation AGI applications or just to play a pre-recorded message. WEBFORM will open the web form address. MESSAGE_ONLY will simply display the message that is in the field below. NONE will disable this feature and is the default. This setting will override the Campaign settings.

	<BR>
	<A NAME="vicidial_inbound_groups-timer_action_message">
	<BR>
	<B>Timer Action Message -</B> This is the message that appears on the agent screen at the time the Timer Action is triggered.

	<BR>
	<A NAME="vicidial_inbound_groups-timer_action_seconds">
	<BR>
	<B>Timer Action Seconds -</B> This is the amount of time after the call is connected to the customer that the Timer Action is triggered. Default is -1 which is also inactive.

	<BR>
	<A NAME="vicidial_inbound_groups-drop_call_seconds">
	<BR>
	<B>Drop Call Seconds -</B> The number of seconds a call will stay in queue before being considered a DROP.

	<BR>
	<A NAME="vicidial_inbound_groups-drop_action">
	<BR>
	<B>Drop Action -</B> This menu allows you to choose what happens to a call when it has been waiting for longer than what is set in the Drop Call Seconds field. HANGUP will simply hang up the call, MESSAGE will send the call the Drop Exten that you have defined below, VOICEMAIL will send the call to the voicemail box that you have defined below and IN_GROUP will send the call to the Inbound Group that is defined below.

	<BR>
	<A NAME="vicidial_inbound_groups-drop_exten">
	<BR>
	<B>Drop Exten -</B> If Drop Action is set to MESSAGE, this is the dial plan extension that the call will be sent to if it reaches Drop Call Seconds.

	<BR>
	<A NAME="vicidial_inbound_groups-voicemail_ext">
	<BR>
	<B>Voicemail -</B> If Drop Action is set to VOICEMAIL, the call DROP would instead be directed to this voicemail box to hear and leave a message.

	<BR>
	<A NAME="vicidial_inbound_groups-drop_inbound_group">
	<BR>
	<B>Drop Transfer Group -</B> If Drop Action is set to IN_GROUP, the call will be sent to this inbound group if it reaches Drop Call Seconds.
	<BR>
	<A NAME="vicidial_inbound_groups-ivrs">
	<BR>
	<B>IVR -</B> If Drop Action is set to CALLMENU, the call will be sent to this IVR.

	
	<BR>
	<A NAME="vicidial_inbound_groups-call_time_id">
	<BR>
	<B>Call Time -</B> This is the call time scheme to use for this inbound group. Keep in mind that the time is based on the server time. Default is 24hours.

	<BR>
	<A NAME="vicidial_inbound_groups-after_hours_action">
	<BR>
	<B>After Hours Action -</B> The action to perform if it is after hours as defined in the call time for this inbound group. HANGUP will immediately hangup the call, MESSASGE will play the file in the After Hours Message Filenam field, EXTENSION will send the call to the After Hours Extension in the dialplan and VOICEMAIL will send the call to the voicemail box listed in the After Hours Voicemail field, IN_GROUP will send the call to the inbound group selected in the After Hours Transfer Group select list. Default is MESSAGE.

	<BR>
	<A NAME="vicidial_inbound_groups-after_hours_message_filename">
	<BR>
	<B>After Hours Message Filename -</B> The audio file located on the server to be played if the Action is set to MESSAGE. Default is vm-goodbye

	<BR>
	<A NAME="vicidial_inbound_groups-after_hours_exten">
	<BR>
	<B>After Hours Extension -</B> The dialplan extension to send the call to if the Action is set to EXTENSION. Default is 8300.

	<BR>
	<A NAME="vicidial_inbound_groups-after_hours_voicemail">
	<BR>
	<B>After Hours Voicemail -</B> The voicemail box to send the call to if the Action is set to VOICEMAIL.

	<BR>
	<A NAME="vicidial_inbound_groups-afterhours_xfer_group">
	<BR>
	<B>After Hours Transfer Group -</B> If After Hours Action is set to IN_GROUP, the call will be sent to this inbound group if it enters the in-group outside of the call time scheme defined for the in-group.

	<BR>
	<A NAME="vicidial_inbound_groups-no_agent_no_queue">
	<BR>
	<B>No Agents No Queueing -</B> If this field is set to Y or NO_PAUSED then no calls will be put into the queue for this in-group if there are no agents logged in and the calls will go to the No Agent No Queue Action. The NO_PAUSED option will also not send the callers into the queue if there are only paused agents in the in-group. Default is N.

	<BR>
	<A NAME="vicidial_inbound_groups-no_agent_action">
	<BR>
	<B>No Agent No Queue Action -</B> If No Agent No Queue is enabled, then this field defines where the call will go if there are no agents in the In-Group. Default is MESSAGE, this plays the sound files in the Action Value field and then hangs up.

	<BR>
	<A NAME="vicidial_inbound_groups-no_agent_action_value">
	<BR>
	<B>No Agent No Queue Action Value -</B> This is the value for the Action above. Default is nbdy-avail-to-take-call|vm-goodbye.

	<BR>
	<A NAME="vicidial_inbound_groups-welcome_message_filename">
	<BR>
	<B>Welcome Message Filename -</B> The audio file located on the server to be played when the call comes in. If set to ---NONE--- then no message will be played. Default is ---NONE---. This field as with the other audio fields in In-Groups, with the exception of the Agent Alert Filename, can have multiple audio files played if you put a pipe-separated list of audio files into the field.

	<BR>
	<A NAME="vicidial_inbound_groups-play_welcome_message">
	<BR>
	<B>Play Welcome Message -</B> These settings select when to play the defined welcome message, ALWAYS will play it every time, NEVER will never play it, IF_WAIT_ONLY will only play the welcome message if the call does not immediately go to an agent, and YES_UNLESS_NODELAY will always play the welcome message unless the NO_DELAY setting is enabled. Default is ALWAYS.

	<BR>
	<A NAME="vicidial_inbound_groups-moh_context">
	<BR>
	<B>Music On Hold Context -</B> The music on hold context to use when the customer is placed on hold. Default is default.

	<BR>
	<A NAME="vicidial_inbound_groups-onhold_prompt_filename">
	<BR>
	<B>On Hold Prompt Filename -</B> The audio file located on the server to be played at a regular interval when the customer is on hold. Default is generic_hold. This audio file MUST be 9 seconds or less in length.

	<BR>
	<A NAME="vicidial_inbound_groups-prompt_interval">
	<BR>
	<B>On Hold Prompt Interval -</B> The length of time in seconds to wait before playing the on hold prompt. Default is 60. To disable the On Hold Prompt, set the interval to 0.

	<BR>
	<A NAME="vicidial_inbound_groups-play_place_in_line">
	<BR>
	<B>Play Place in Line -</B> This defines whether the caller will hear their place in line when they enter the queue as well as when they hear the announcemend. Default is N.
	<BR>
	<A NAME="vicidial_inbound_groups-play_language">
	<BR>
	<B>Play Language -</B> Play language.

	<BR>
	<A NAME="vicidial_inbound_groups-play_estimate_hold_time">
	<BR>
	<B>Play Estimated Hold Time -</B> This defines whether the caller will hear the estimated hold time before they are transferred to an agent. Default is N. If the customer is on hold and hears this estimated hold time message, the minimum time that will be played is 15 seconds.

	<BR>
	<A NAME="vicidial_inbound_groups-hold_time_option">
	<BR>
	<B>Hold Time Option -</B> This allows you to specify the routing of the call if the estimated hold time is over the amount of seconds specified below. Default is NONE.

	<BR>
	<A NAME="vicidial_inbound_groups-hold_time_option_seconds">
	<BR>
	<B>Hold Time Option Seconds -</B> If Hold Time Option is set to anything but NONE, this is the number of seconds of estimated hold time that will trigger the hold time option. Default is 360 seconds.

	<BR>
	<A NAME="vicidial_inbound_groups-hold_time_option_exten">
	<BR>
	<B>Hold Time Option Extension -</B> If Hold Time Option is set to EXTENSION, this is the dialplan extension that the call will be sent to if the estimated hold time exceeds the Hold Time Option Seconds.

	<BR>
	<A NAME="vicidial_inbound_groups-hold_time_option_voicemail">
	<BR>
	<B>Hold Time Option Voicemail -</B> If Hold Time Option is set to VOICEMAIL, this is the voicemail box that the call will be sent to if the estimated hold time exceeds the Hold Time Option Seconds.

	<BR>
	<A NAME="vicidial_inbound_groups-hold_time_option_xfer_group">
	<BR>
	<B>Hold Time Option Transfer In-Group -</B> If Hold Time Option is set to IN_GROUP, this is the inbound group that the call will be sent to if the estimated hold time exceeds the Hold Time Option Seconds.

	<BR>
	<A NAME="vicidial_inbound_groups-hold_time_option_callback_filename">
	<BR>
	<B>Hold Time Option Callback Filename -</B> If Hold Time Option is set to CALLERID_CALLBACK, this is the filename prompt that is played before the call is logged as a new lead to the list ID specified below if the estimated hold time exceeds the Hold Time Option Seconds.

	<BR>
	<A NAME="vicidial_inbound_groups-hold_time_option_callback_list_id">
	<BR>
	<B>Hold Time Option Callback List ID -</B> If Hold Time Option is set to CALLERID_CALLBACK, this is the List ID the call is added to as a new lead if the estimated hold time exceeds the Hold Time Option Seconds.

	<BR>
	<A NAME="vicidial_inbound_groups-agent_alert_exten">
	<BR>
	<B>Agent Alert Filename -</B> The audio file to play to an agent to announce that a call is coming to the agent. To not use this function set this to X. Default is ding.

	<BR>
	<A NAME="vicidial_inbound_groups-agent_alert_delay">
	<BR>
	<B>Agent Alert Delay -</B> The length of time in milliseconds to wait before sending the call to the agent after playing the on Agent Alert Extension. Default is 1000.

	<BR>
	<A NAME="vicidial_inbound_groups-default_xfer_group">
	<BR>
	<B>Default Transfer Group -</B> This field is the default In-Group that will be automatically selected when the agent goes to the transfer-conference frame in their agent interface.

	<BR>
	<A NAME="vicidial_inbound_groups-ingroup_recording_override">
	<BR>
	<B>In-Group Recording Override -</B> This field allows for the overriding of the campaign call recording setting. This setting can be overridden by the vicidial_user recording override setting. DISABLED will not override the campaign recording setting. NEVER will disable recording on the client. ONDEMAND is the default and allows the agent to start and stop recording as needed. ALLCALLS will start recording on the client whenever a call is sent to an agent. ALLFORCE will start recording on the client whenever a call is sent to an agent giving the agent no option to stop recording.

	<BR>
	<A NAME="vicidial_inbound_groups-ingroup_rec_filename">
	<BR>
	<B>In-Group Recording Filename -</B> This field will override the Campaign Recording Filenaming Scheme unless it is set to NONE. The allowed variables are CAMPAIGN CUSTPHONE FULLDATE TINYDATE EPOCH AGENT. The default is FULLDATE_AGENT and would look like this 20051020-103108_6666. Another example is CAMPAIGN_TINYDATE_CUSTPHONE which would look like this TESTCAMP_51020103108_3125551212. 50 char max. Default is NONE.

	<?php
	if ($SSqc_features_active > 0)
		{
		?>
		<BR>
		<A NAME="vicidial_inbound_groups-qc_enabled">
		<BR>
		<B>QC Enabled -</B> Setting this field to Y allows for the agent Quality Control features to work. Default is N.

		<BR>
		<A NAME="vicidial_inbound_groups-qc_statuses">
		<BR>
		<B>QC Call Result -</B> This area is where you select which Call Result of leads should be gone over by the QC system. Place a check next to the status that you want QC to review. 

		<BR>
		<A NAME="vicidial_inbound_groups-qc_shift_id">
		<BR>
		<B>QC Shift -</B> This is the shift timeframe used to pull QC records for an inbound_group. The days of the week are ignored for these functions.

		<BR>
		<A NAME="vicidial_inbound_groups-qc_get_record_launch">
		<BR>
		<B>QC Get Record Launch-</B> This allows one of the following actions to be triggered upon a QC agent receiving a new record.

		<BR>
		<A NAME="vicidial_inbound_groups-qc_show_recording">
		<BR>
		<B>QC Show Recording -</B> This allows for a recording that may be linked with the QC record to be display in the QC agent screen.

		<BR>
		<A NAME="vicidial_inbound_groups-qc_web_form_address">
		<BR>
		<B>QC WebForm Address -</B> This is the website address that a QC agent can go to when clicking on the WEBFORM link in the QC screen.

		<BR>
		<A NAME="vicidial_inbound_groups-qc_script">
		<BR>
		<B>QC Script -</B> This is the script that can be used by QC agents in the SCRIPT tab in the QC screen.
		<?php
		}
	?>

	<BR>
	<A NAME="vicidial_inbound_groups-hold_recall_xfer_group">
	<BR>
	<B>Hold Recall Transfer In-Group -</B> If a customer calls back to this in-group more than once and this is not set to NONE, then the call will automatically be sent on to the In-Group selected in this field. Default is NONE.

	<BR>
	<A NAME="vicidial_inbound_groups-no_delay_call_route">
	<BR>
	<B>No Delay Call Route -</B> Setting this to Y will remove all wait times and audio prompts and attempt to send the call right to an agent. Does not override welcome message or on hold prompt settings. Default is N.

	<BR>
	<A NAME="vicidial_inbound_groups-answer_sec_pct_rt_stat_one">
	<BR>
	<B>Stats Percent of Calls Answered Within X seconds -</B> This field allows you to set the number of hold seconds that the realtime stats display will use to calculate the percentage of answered calls that were answered within X number of seconds on hold.

	<BR>
	<A NAME="vicidial_inbound_groups-start_call_url">
	<BR>
	<B>Start Call URL -</B> This web URL address is not seen by the agent, but it is called every time a call is sent to an agent if it is populated. Uses the same variables as the web form fields and scripts. Default is blank.

	<BR>
	<A NAME="vicidial_inbound_groups-dispo_call_url">
	<BR>
	<B>Dispo Call URL -</B> This web URL address is not seen by the agent, but it is called every time a call is dispositioned by an agent if it is populated. Uses the same variables as the web form fields and scripts. dispo and talk_time are the variables you can use to retrieve the agent-defined disposition for the call and the actual talk time in seconds of the call. Default is blank.

	<BR>
	<A NAME="vicidial_inbound_groups-default_group_alias">
	<BR>
	<B>Default Group Alias -</B> If you have allowed Group Aliases for the campaign that the agent is logged into then this is the group alias that is selected first by default on a call coming in from this inbound group when the agent chooses to use a Group Alias for an outbound manual call. Default is NONE or empty.





	<BR><BR><BR><BR>

	<B><FONT SIZE=3>VICIDIAL_INBOUND_DIDS TABLE</FONT></B><BR><BR>
	<BR>
	<A NAME="vicidial_inbound_dids-did_pattern">
	<BR>
	<B>DID Extension -</B> This is the number, extension or DID that will trigger this entry and that you will route within the system using this function. There is a reserved default DID that you can use which is just the word -default- without the dashes, that will allos you to send any call that does not match any other existing patterns to the default DID.

	<BR>
	<A NAME="vicidial_inbound_dids-did_description">
	<BR>
	<B>DID Description -</B> This is the description of the DID routing entry.

	<BR>
	<A NAME="vicidial_inbound_dids-did_active">
	<BR>
	<B>DID Active -</B> This the field where you set the DID entry to active or not. Default is Y.

	<BR>
	<A NAME="vicidial_inbound_dids-did_route">
	<BR>
	<B>DID Route -</B> This the type of route that you set the DID to use. EXTEN will send calls to the extension entered below, VOICEMAIL will send calls directly to the voicemail box entered below, AGENT will send calls to a CCMS agent if they are logged in, PHONE will send the call to a phones entry selected below, IN_GROUP will send calls directly to the specified inbound group. Default is EXTEN. CALLMENU will send the call to the defined IVR.

	<BR>
	<A NAME="vicidial_inbound_dids-extension">
	<BR>
	<B>Extension -</B> If EXTEN is selected as the DID Route, then this is the dialplan extension that calls will be sent to. Default is 9998811112, no-service.

	<BR>
	<A NAME="vicidial_inbound_dids-exten_context">
	<BR>
	<B>Extension Context -</B> If EXTEN is selected as the DID Route, then this is the dialplan context that calls will be sent to. Default is default.

	<BR>
	<A NAME="vicidial_inbound_dids-voicemail_ext">
	<BR>
	<B>Voicemail Box -</B> If VOICEMAIL is selected as the DID Route, then this is the voicemail box that calls will be sent to. Default is empty.

	<BR>
	<A NAME="vicidial_inbound_dids-phone">
	<BR>
	<B>Phone Extension -</B> If PHONE is selected as the DID Route, then this is the phone extension that calls will be sent to.

	<BR>
	<A NAME="vicidial_inbound_dids-server_ip">
	<BR>
	<B>Phone Server IP -</B> If PHONE is selected as the DID Route, then this is the server IP for the phone extension that calls will be sent to.

	<BR>
	<A NAME="vicidial_inbound_dids-menu_id">
	<BR>
	<B>IVR -</B> If CALLMENU is selected as the DID Route, then this is the IVR that calls will be sent to.

	<BR>
	<A NAME="vicidial_inbound_dids-user">
	<BR>
	<B>User Agent -</B> If AGENT is selected as the DID Route, then this is the CCMS Agent that calls will be sent to.

	<BR>
	<A NAME="vicidial_inbound_dids-user_unavailable_action">
	<BR>
	<B>User Unavailable Action -</B> If AGENT is selected as the DID Route, and the user is not logged in or available, then this is the route that the calls will take.

	<BR>
	<A NAME="vicidial_inbound_dids-user_route_settings_ingroup">
	<BR>
	<B>User Route Settings In-Group -</B> If AGENT is selected as the DID Route, then this is the In-Group that will be used for the queue settings as the caller is waiting to be sent to the agent. Default is AGENTDIRECT.

	<BR>
	<A NAME="vicidial_inbound_dids-group_id">
	<BR>
	<B>In-Group ID -</B> If IN_GROUP is selected as the DID Route, then this is the In-Group that calls will be sent to.

	<BR>
	<A NAME="vicidial_inbound_dids-call_handle_method">
	<BR>
	<B>In-Group Call Handle Method -</B> If IN_GROUP is selected as the DID Route, then this is the call handling method used for these calls. CID will add a new lead record with every call using the CallerID as the phone number, CIDLOOKUP will attempt to lookup the phone number by the CallerID in the entire system, CIDLOOKUPRL will attempt to lookup the phone number by the CallerID in only one specified list, CIDLOOKUPRC will attempt to lookup the phone number by the CallerID in all of the lists that belong to the specified campaign, CLOSER is specified for CCMS Closer calls, ANI will add a new lead record with every call using the ANI as the phone number, ANILOOKUP will attempt to lookup the phone number by the ANI in the entire system, ANILOOKUPRL will attempt to lookup the phone number by the ANI in only one specified list, XDIGITID will prompt the caller for an X digit code before the call will be put into the queue, VIDPROMPT will prompt the caller for their ID number and will create a new lead record with the CallerID as the phone number and the ID as the Vendor ID, VIDPROMPTLOOKUP will attempt to lookup the ID in the entire system, VIDPROMPTLOOKUPRL will attempt to lookup the vendor ID by the ID in only one specified list, VIDPROMPTLOOKUPRC will attempt to lookup the vendor ID by the ID in all of the lists that belong to the specified campaign. Default is CID.

	<BR>
	<A NAME="vicidial_inbound_dids-agent_search_method">
	<BR>
	<B>In-Group Agent Search Method -</B> If IN_GROUP is selected as the DID Route, then this is the agent search method to be used by the inbound group, LO is Load-Balanced-Overflow and will try to send the call to an agent on the local server before trying to send it to an agent on another server, LB is Load-Balanced and will try to send the call to the next agent no matter what server they are on, SO is Server-Only and will only try to send the calls to agents on the server that the call came in on. Default is LB.

	<BR>
	<A NAME="vicidial_inbound_dids-list_id">
	<BR>
	<B>In-Group List ID -</B> If IN_GROUP is selected as the DID Route, then this is the List ID that leads may be searched through and that leads will be inserted into if necessary.

	<BR>
	<A NAME="vicidial_inbound_dids-campaign_id">
	<BR>
	<B>In-Group Campaign ID -</B> If IN_GROUP is selected as the DID Route, then this is the Campaign ID that leads may be searched for in if the call handle method is CIDLOOKUPRC.

	<BR>
	<A NAME="vicidial_inbound_dids-phone_code">
	<BR>
	<B>In-Group Phone Code -</B> If IN_GROUP is selected as the DID Route, then this is the Phone Code used if a new lead is created.




	<BR><BR><BR><BR>

	<B><FONT SIZE=3>VICIDIAL_CALL MENU TABLE</FONT></B><BR><BR>
	<A NAME="vicidial_call_menu-menu_id">
	<BR>
	<B>Menu ID -</B> This is the ID for this step of the IVR. This will also show up as the context that is used in the dialplan for this IVR.

	<BR>
	<A NAME="vicidial_call_menu-menu_name">
	<BR>
	<B>Menu Name -</B> This field is the descriptive name for the IVR.

	<BR>
	<A NAME="vicidial_call_menu-menu_prompt">
	<BR>
	<B>Menu Prompt -</B> This field contains the file name of the audio prompt to play at the beginning of this menu. You can enter multiple propmts in this field and the other prompt fields by separating them with a pipe character.

	<BR>
	<A NAME="vicidial_call_menu-menu_timeout">
	<BR>
	<B>Menu Timeout -</B> This field is where you set the timeout in seconds that the menu will wait for the caller to enter in a DTMF choice. Setting this field to zero 0 will mean that there will be no wait time after the prompt is played.

	<BR>
	<A NAME="vicidial_call_menu-menu_timeout_prompt">
	<BR>
	<B>Menu Timeout Prompt -</B> This field contains the file name of the audio prompt to play when the timeout has been reached. Default is NONE to play no audio at timeout.

	<BR>
	<A NAME="vicidial_call_menu-menu_invalid_prompt">
	<BR>
	<B>Menu Invalid Prompt -</B> This field contains the file name of the audio prompt to play when the caller has selected an invalid option. Default is NONE to play no audio at invalid.

	<BR>
	<A NAME="vicidial_call_menu-menu_repeat">
	<BR>
	<B>Menu Repeat -</B> This field is where you define the number of times that the menu will play after the first time if no valid choice is made by the caller. Default is 1 to repeat the menu once.

	<BR>
	<A NAME="vicidial_call_menu-menu_time_check">
	<BR>
	<B>Menu Time Check -</B> This field is where you can select whether to restrict the IVR access to the specific hours set up in the selected Call Time. If the Call Time is blank, this setting will be ignored. Default is 0 for disabled.

	<BR>
	<A NAME="vicidial_call_menu-call_time_id">
	<BR>
	<B>Call Time ID -</B> This is the Call Time ID that will be used to restrict calling times if the Menu Time Check option is enabled.

	<BR>
	<A NAME="vicidial_call_menu-track_in_vdac">
	<BR>
	<B>Track Calls in Real-Time Report -</B> This field is where you can select whether you want the call to be tracked in the Real-time screen as an incoming IVR type call. Default is 1 for active.

	<BR>
	<A NAME="vicidial_call_menu-tracking_group">
	<BR>
	<B>Tracking Group -</B> This is the ID that you can use to track calls to this IVR when looking at the IVR Report. The list includes CALLMENU as the default as well as all of the In-Groups.

	<BR>
	<A NAME="vicidial_call_menu-option_value">
	<BR>
	<B>Option Value -</B> This field is where you define the menu option, possible choices are: 0,1,2,3,4,5,6,7,8,9,*,#,A,B,C,D,TIMECHECK. The special option TIMECHECK can be used only if you have Menu Time Check enabled and there is a Call Time defined for the Menu. To delete an Option, just set the Route to REMOVE and the option will be deleted when you click the SUBMIT button.

	<BR>
	<A NAME="vicidial_call_menu-option_description">
	<BR>
	<B>Option Description -</B> This field is where you can describe the option, this description will be put into the dialplan as a comment above the option.

	<BR>
	<A NAME="vicidial_call_menu-option_route">
	<BR>
	<B>Option Route -</B> This menu contains the options for where to send the call if this option is selected: CALLMENU,INGROUP,DID,HANGUP,EXTENSION,PHONE. For CALLMENU, the Route Value should be the Menu ID of the IVR that you want the call sent to. For INGROUP, the In-Group that you want the call to be sent to needs to be selected as well as the other 5 options that need to be set to properly route a call to an Inbound Group. For DID, the Route Value needs to be the DID pattern that you want to send the call to. For HANGUP, the Route Value can be the name of an audio file to play before hanging up the call. For EXTENSION, the Route Value needs to be the dialplan extension you want to send the call to, and the Route Value Context is the context that extension is located in, if left blank the context will default to default. For PHONE, the Route Value needs to be the phone login value for the phones entry that you want to send the call to. For VOICEMAIL, the Route Value needs to be the voicemail box number, the unavailable mesage will be played. For AGI, the Route Value needs to be the agi script and any values taht need to be passed to it.

	<BR>
	<A NAME="vicidial_call_menu-option_route_value">
	<BR>
	<B>Option Route Value -</B> This field is where you enter the value that defines where in the selected Option Route that the call is to be directed to.

	<BR>
	<A NAME="vicidial_call_menu-option_route_value_context">
	<BR>
	<B>Option Route Value Context -</B> This field is optional and only used for EXTENSION Option Routes.

	<BR>
	<A NAME="vicidial_call_menu-custom_dialplan_entry">
	<BR>
	<B>Custom Dilplan Entry -</B> This field allows you to enter in any dialplan elements that you want for the IVR.





	<BR><BR><BR><BR>

	<B><FONT SIZE=3>VICIDIAL_REMOTE_AGENTS TABLE</FONT></B><BR><BR>
	<A NAME="vicidial_remote_agents-user_start">
	<BR>
	<B>User ID Start -</B> This is the starting User ID that is used when the remote agent entries are inserted into the system. If the Number of Lines is set higher than 1, this number is incremented by one until each line has an entry. Make sure you create a new CCMS user account with a user level of 4 or great if you want them to be able to use the vdremote.php page for remote web access of this account.

	<BR>
	<A NAME="vicidial_remote_agents-number_of_lines">
	<BR>
	<B>Number of Lines -</B> This defines how many remote agent entries the system creates, and determines how many lines it thinks it can safely send to the number below.

	<BR>
	<A NAME="vicidial_remote_agents-server_ip">
	<BR>
	<B>Server IP -</B> A remote agent entry is only good for one specific server, here is where you select which server you want.

	<BR>
	<A NAME="vicidial_remote_agents-conf_exten">
	<BR>
	<B>External Extension -</B> This is the number that you want the calls forwarded to. Make sure that it is a full dial plan number and that if you need a 9 at the beginning you put it in here. Test by dialing this number from a phone on the system.

	<BR>
	<A NAME="vicidial_remote_agents-status">
	<BR>
	<B>Status -</B> Here is where you turn the remote agent on and off. As soon as the agent is Active the system assumes that it can send calls to it. It may take up to 30 seconds once you change the status to Inactive to stop receiving calls.

	<BR>
	<A NAME="vicidial_remote_agents-campaign_id">
	<BR>
	<B>Campaign -</B> Here is where you select the campaign that these remote agents will be logged into. Inbound needs to use the CLOSER campaign and select the inbound campaigns below that you want to receive calls from.

	<BR>
	<A NAME="vicidial_remote_agents-closer_campaigns">
	<BR>
	<B>Inbound Groups -</B> Here is where you select the inbound groups you want to receive calls from if you have selected the CLOSER campaign.


	<BR><BR><BR><BR>

	<B><FONT SIZE=3>CCMS_CAMPAIGN_LISTS</FONT></B><BR><BR>
	<A NAME="vicidial_campaign_lists">
	<BR>
	<B>The lists within this campaign are listed here, whether they are active is denoted by the Y or N and you can go to the list screen by clicking on the list ID in the first column.</B>


	<BR><BR><BR><BR>

	<B><FONT SIZE=3>VICIDIAL_CAMPAIGN_STATUSES TABLE</FONT></B><BR><BR>
	<A NAME="vicidial_campaign_statuses">
	<BR>
	<B>Through the use of custom campaign Call Result, you can have Call Result that only exist for a specific campaign. The Status must be 1-8 characters in length, the description must be 2-30 characters in length and Selectable defines whether it shows up in CCMS as a disposition. The human_answered field is used when calculating the drop percentage, or abandon rate. Setting human_answered to Y will use this status when counting the human-answered calls. The Category option allows you to group several Call Result into a catogy that can be used for statistical analysis.</B>



	<?php
	if ($SSoutbound_autodial_active > 0)
		{
		?>
		<BR><BR><BR><BR>

		<B><FONT SIZE=3>VICIDIAL_CAMPAIGN_HOTKEYS TABLE</FONT></B><BR><BR>
		<A NAME="vicidial_campaign_hotkeys">
		<BR>
		<B>Through the use of custom campaign hot keys, agents that use the CCMS web-client can hang up and disposition calls just by pressing a single key on their keyboard.</B> There are two special HotKey options that you can use in conjunction with Alternate Phone number dialing, ALTPH2 - Alternate Phone Hot Dial and ADDR3-----Address3 Hot Dial allow an agent to use a hotkey to hang up their call, stay on the same lead, and dial another contact number from that lead. 





		<BR><BR><BR><BR>

		<B><FONT SIZE=3>VICIDIAL_LEAD_RECYCLE TABLE</FONT></B><BR><BR>
		<A NAME="vicidial_lead_recycle">
		<BR>
		<B>Through the use of lead recycling, you can call specific Call Result of leads again at a specified interval without resetting the entire list. Lead recycling is campaign-specific and does not have to be a selected dialable status in your campaign. The attempt delay field is the number of seconds until the lead can be placed back in the hopper, this number must be at least 120 seconds. The attempt maximum field is the maximum number of times that a lead of this status can be attempted before the list needs to be reset, this number can be from 1 to 10. You can activate and deactivate a lead recycle entry with the provided links.</B>





		<BR><BR><BR><BR>

		<B><FONT SIZE=3>CCMS AUTO ALT DIAL Call Result</FONT></B><BR><BR>
		<A NAME="vicidial_auto_alt_dial_statuses">
		<BR>
		<B>If the Auto Alt-Number Dialing field is set, then the leads that are dispositioned under these auto alt dial Call Result will have their alt_phone and-or address3 fields dialed after any of these no-answer Call Result are set.</B>

		<?php
		}
	?>



	<BR><BR><BR><BR>

	<B><FONT SIZE=3>CCMS AGENT PAUSE CODES</FONT></B><BR><BR>
	<A NAME="vicidial_pause_codes">
	<BR>
	<B>If the Agent Pause Codes Active field is set to active then the agents will be able to select from these pause codes when they click on the PAUSE button on their screens. This data is then stored in the CCMS agent log. The Pause code must contain only letters and numbers and be less than 7 characters long. The pause code name can be no longer than 30 characters.</B>





	<BR><BR><BR><BR>

	<B><FONT SIZE=3>VICIDIAL_USER_GROUPS TABLE</FONT></B><BR><BR>
	<A NAME="vicidial_user_groups-user_group">
	<BR>
	<B>User Group -</B> This is the short name of a CCMS User group, try not to use any spaces or punctuation for this field. max 20 characters, minimum of 2 characters.

	<BR>
	<A NAME="vicidial_user_groups-group_name">
	<BR>
	<B>Group Name -</B> This is the description of the CCMS user group max of 40 characters.

	<BR>
	<A NAME="vicidial_user_groups-forced_timeclock_login">
	<BR>
	<B>Force Timeclock Login -</B> This option allows you to not let an agent log in to the CCMS agent interface if they have not logged into the timeclock. Default is N. There is an option to exempt admin users, levels 8 and 9.

	<BR>
	<A NAME="vicidial_user_groups-shift_enforcement">
	<BR>
	<B>Shift Enforcement -</B> This setting allows you to restrict agent logins based upon the shifts that are selected below. OFF will not enforce shifts at all. START will only enforce the login time but will not affect an agent that is running over their shift time if they are already logged in. ALL will enforce shift start time and will log an agent out after they run over the end of their shift time. Default is OFF.

	<BR>
	<A NAME="vicidial_user_groups-group_shifts">
	<BR>
	<B>Group Shifts -</B> This is a selectable list of shifts that can restrict the agents login time on the system.

	<BR>
	<A NAME="vicidial_user_groups-allowed_campaigns">
	<BR>
	<B>Allowed Campaigns -</B> This is a selectable list of Campaigns to which members of this user group can log in to. The ALL-CAMPAIGNS option allows the users in this group to see and log in to any campaign on the system.

	<BR>
	<A NAME="vicidial_user_groups-agent_status_viewable_groups">
	<BR>
	<B>Agent Status Viewable Groups -</B> This is a selectable list of User Groups and user functions to which members of this user group can view the status of as well as transfer calls to inside of the agent screen. The ALL-GROUPS option allows the users in this group to see and transfer calls to any user on the system. The CAMPAIGN-AGENTS option allows users in this group to see and transfer calls to any user in the campaign that they are logged into.

	<BR>
	<A NAME="vicidial_user_groups-agent_status_view_time">
	<BR>
	<B>Agent Status View Time -</B> This option defines whether the agent will see the amount of time that users in their agent sidebar have been in their current status. Default is N for no or disabled.

	<?php
	if ($SSqc_features_active > 0)
		{
		?>
		<BR>
		<A NAME="vicidial_user_groups-qc_allowed_campaigns">
		<BR>
		<B>QC Allowed Campaigns -</B> This is a selectable list of Campaigns which members of this user group will be able to QC. The ALL-CAMPAIGNS option allows the users in this group to QC any campaign on the system.

		<BR>
		<A NAME="vicidial_user_groups-qc_allowed_inbound_groups">
		<BR>
		<B>QC Allowed Inbound Groups -</B> This is a selectable list of Inbound Groups which members of this user group will be able to QC. The ALL-GROUPS option allows the users in this user group to QC any inbound group on the system.
		<?php
		}
	?>




	<BR><BR><BR><BR>

	<B><FONT SIZE=3>VICIDIAL_SCRIPTS TABLE</FONT></B><BR><BR>
	<A NAME="vicidial_scripts-script_id">
	<BR>
	<B>Script ID -</B> This is the short name of a CCMS Script. This needs to be a unique identifier. Try not to use any spaces or punctuation for this field. max 10 characters, minimum of 2 characters.

	<BR>
	<A NAME="vicidial_scripts-script_name">
	<B>Script Name -</B> This is the title of a CCMS Script. This is a short summary of the script. max 50 characters, minimum of 2 characters. There should be no spaces or punctuation of any kind in theis field.

	<BR>
	<A NAME="vicidial_scripts-script_comments">
	<B>Script Comments -</B> This is where you can place comments for a CCMS Script such as -changed to free upgrade on Sept 23-.  max 255 characters, minimum of 2 characters.

	<BR>
	<A NAME="vicidial_scripts-script_text">
	<B>Script Text -</B> This is where you place the content of a CCMS Script. Minimum of 2 characters. You can have customer information be auto-populated in this script using "--A--field--B--" where field is one of the following fieldnames: vendor_lead_code, source_id, list_id, gmt_offset_now, called_since_last_reset, phone_code, phone_number, title, first_name, middle_initial, last_name, address1, address2, address3, city, state, province, postal_code, country_code, gender, date_of_birth, alt_phone, email, security_phrase, comments, lead_id, campaign, phone_login, group, channel_group, SQLdate, epoch, uniqueid, customer_zap_channel, server_ip, SIPexten, session_id, dialed_number, dialed_label, rank, owner, camp_script, in_script, script_width, script_height, recording_filename, recording_id. For example, this sentence would print the persons name in it----<BR><BR>  Hello, can I speak with --A--first_name--B-- --A--last_name--B-- please? Well hello --A--title--B-- --A--last_name--B-- how are you today?<BR><BR> This would read----<BR><BR>Hello, can I speak with John Doe please? Well hello Mr. Doe how are you today?<BR><BR> You can also use an iframe to load a separate window within the SCRIPT tab, here is an example with prepopulated variables:

	<DIV style="height:200px;width:400px;background:white;overflow:scroll;font-size:12px;font-family:sans-serif;" id=iframe_example>
	&#60;iframe src="http://astguiclient.sf.net/test_VICIDIAL_output.php?lead_id=--A--lead_id--B--&#38;vendor_id=--A--vendor_lead_code--B--&#38;list_id=--A--list_id--B--&#38;gmt_offset_now=--A--gmt_offset_now--B--&#38;phone_code=--A--phone_code--B--&#38;phone_number=--A--phone_number--B--&#38;title=--A--title--B--&#38;first_name=--A--first_name--B--&#38;middle_initial=--A--middle_initial--B--&#38;last_name=--A--last_name--B--&#38;address1=--A--address1--B--&#38;address2=--A--address2--B--&#38;address3=--A--address3--B--&#38;city=--A--city--B--&#38;state=--A--state--B--&#38;province=--A--province--B--&#38;postal_code=--A--postal_code--B--&#38;country_code=--A--country_code--B--&#38;gender=--A--gender--B--&#38;date_of_birth=--A--date_of_birth--B--&#38;alt_phone=--A--alt_phone--B--&#38;email=--A--email--B--&#38;security_phrase=--A--security_phrase--B--&#38;comments=--A--comments--B--&#38;user=--A--user--B--&#38;campaign=--A--campaign--B--&#38;phone_login=--A--phone_login--B--&#38;fronter=--A--fronter--B--&#38;closer=--A--user--B--&#38;group=--A--group--B--&#38;channel_group=--A--group--B--&#38;SQLdate=--A--SQLdate--B--&#38;epoch=--A--epoch--B--&#38;uniqueid=--A--uniqueid--B--&#38;customer_zap_channel=--A--customer_zap_channel--B--&#38;server_ip=--A--server_ip--B--&#38;SIPexten=--A--SIPexten--B--&#38;session_id=--A--session_id--B--&#38;dialed_number=--A--dialed_number--B--&#38;dialed_label=--A--dialed_label--B--&#38;rank=--A--rank--B--&#38;owner=--A--owner--B--&#38;phone=--A--phone--B--&#38;camp_script=--A--camp_script--B--&#38;in_script=--A--in_script--B--&#38;script_width=--A--script_width--B--&#38;script_height=--A--script_height--B--&#38;recording_filename=--A--recording_filename--B--&#38;recording_id=--A--recording_id--B--&#38;" style="width:580;height:290;background-color:transparent;" scrolling="auto" frameborder="0" allowtransparency="true" id="popupFrame" name="popupFrame" width="460" height="290" STYLE="z-index:17"&#62;
	&#60;/iframe&#62;
	</DIV>

	<BR>
	<A NAME="vicidial_scripts-active">
	<BR>
	<B>Active -</B> This determines whether this script can be selected to be used by a campaign.





	<?php
	if ($SSoutbound_autodial_active > 0)
		{
		?>
		<BR><BR><BR><BR>

		<B><FONT SIZE=3>VICIDIAL_LEAD_FILTERS TABLE</FONT></B><BR><BR>
		<A NAME="vicidial_lead_filters-lead_filter_id">
		<BR>
		<B>Filter ID -</B> This is the short name of a CCMS Lead Filter. This needs to be a unique identifier. Do not use any spaces or punctuation for this field. max 10 characters, minimum of 2 characters.

		<BR>
		<A NAME="vicidial_lead_filters-lead_filter_name">
		<B>Filter Name -</B> This is a more descriptive name of the Filter. This is a short summary of the filter. max 30 characters, minimum of 2 characters.

		<BR>
		<A NAME="vicidial_lead_filters-lead_filter_comments">
		<B>Filter Comments -</B> This is where you can place comments for a CCMS Filter such as -calls all California leads-.  max 255 characters, minimum of 2 characters.

		<BR>
		<A NAME="vicidial_lead_filters-lead_filter_sql">
		<B>Filter SQL -</B> This is where you place the SQL query fragment that you want to filter by. do not begin or end with an AND, that will be added by the hopper cron script automatically. an example SQL query that would work here is- called_count > 4 and called_count < 8 -.
		<?php
		}
	?>




	<BR><BR><BR><BR>

	<B><FONT SIZE=3>VICIDIAL_CALL TIMES TABLE</FONT></B><BR><BR>
	<A NAME="vicidial_call_times-call_time_id">
	<BR>
	<B>Call Time ID -</B> This is the short name of a CCMS Call Time Definition. This needs to be a unique identifier. Do not use any spaces or punctuation for this field. max 10 characters, minimum of 2 characters.

	<BR>
	<A NAME="vicidial_call_times-call_time_name">
	<B>Call Time Name -</B> This is a more descriptive name of the Call Time Definition. This is a short summary of the Call Time definition. max 30 characters, minimum of 2 characters.

	<BR>
	<A NAME="vicidial_call_times-call_time_comments">
	<B>Call Time Comments -</B> This is where you can place comments for a CCMS Call Time Definition such as -10am to 4pm with extra call state restrictions-.  max 255 characters.

	<BR>
	<A NAME="vicidial_call_times-ct_default_start">
	<B>Default Start and Stop Times -</B> This is the default time that calling will be allowed to be started or stopped within this call time definition if the day-of-the-week start time is not defined. 0 is midnight. To prevent calling completely set this field to 2400 and set the Default Stop time to 2400. To allow calling 24 hours a day set the start time to 0 and the stop time to 2400.

	<BR>
	<A NAME="vicidial_call_times-ct_sunday_start">
	<B>Weekday Start and Stop Times -</B> These are the custom times per day that can be set for the call time definition. same rules apply as with the Default start and stop times.

	<BR>
	<A NAME="vicidial_call_times-ct_state_call_times">
	<B>State Call Time Definitions -</B> This is the list of State specific call time definitions that are followed in this Call Time Definition.

	<BR>
	<A NAME="vicidial_call_times-state_call_time_state">
	<B>State Call Time State -</B> This is the two letter code for the state that this calling time definition is for. For this to be in effect the local call time that is set in the campaign must have this state call time record in it as well as all of the leads having two letter state codes in them.




	<BR><BR><BR><BR>

	<B><FONT SIZE=3>VICIDIAL_SHIFTS TABLE</FONT></B><BR><BR>
	<A NAME="vicidial_shifts-shift_id">
	<BR>
	<B>Shift ID -</B> This is the short name of a CCMS Shift Definition. This needs to be a unique identifier. Do not use any spaces or punctuation for this field. max 20 characters, minimum of 2 characters.

	<BR>
	<A NAME="vicidial_shifts-shift_name">
	<B>Shift Name -</B> This is a more descriptive name of the Shift Definition. This is a short summary of the Shift definition. max 50 characters, minimum of 2 characters.

	<BR>
	<A NAME="vicidial_shifts-shift_start_time">
	<B>Shift Start Time -</B> This is the time that the campaign shift begins. Must only be numbers, 9:30 AM would be 0930 and 5:00 PM would be 1700.

	<BR>
	<A NAME="vicidial_shifts-shift_length">
	<B>Shift Length -</B> This is the time in Hours and Minutes that the campaign shift lasts. 8 hours would be 08:00 and 7 hours and 30 minutes would be 07:30.

	<BR>
	<A NAME="vicidial_shifts-shift_weekdays">
	<B>Shift Weekdays -</B> In this section you should choose the days of the week that this shift is active.





	<BR><BR><BR><BR>
	<A NAME="audio_store">
	<B>Audio Store -</B> This utility allows you to upload audio files to the web server so that they can be distributed to all of the CCMS servers in a multi-server cluster. An important note, only two audio file types will work, .wav files that are PCM 16bit 8k and .gsm files that are 8bit 8k. Please verify that your files are properly formatted before uploading them here.



	<BR><BR><BR><BR>

	<B><FONT SIZE=3>VICIDIAL_MUSIC_ON_HOLD TABLE</FONT></B><BR><BR>
	<A NAME="vicidial_music_on_hold-moh_id">
	<BR>
	<B>Music On Hold ID -</B> This is the short name of a Music On Hold entry. This needs to be a unique identifier. Do not use any spaces or punctuation for this field. max 100 characters, minimum of 2 characters.

	<BR>
	<A NAME="vicidial_music_on_hold-moh_name">
	<B>Music On Hold Name -</B> This is a more descriptive name of the Music On Hold entry. This is a short summary of the Music On Hold context and will show as a comment in the musiconhold-vicidial.conf file. max 255 characters, minimum of 2 characters.

	<BR>
	<A NAME="vicidial_music_on_hold-active">
	<B>Active -</B> This option allows you to set the Music On Hold entry to active or inactive. Inactive will remove the entry from the conf files.

	<BR>
	<A NAME="vicidial_music_on_hold-random">
	<B>Random Order -</B> This option allows you to define the playback of the audio files in a random order. If set to N then the defined order will be used.

	<BR>
	<A NAME="vicidial_music_on_hold-filename">
	<B>Filename -</B> To add a new audio file to a Music On Hold entry the file must first be in the audio store, then you can select the file and click submit to add it to the file list. Music on hold is updated once per minute if there have been changes made. Any files not listed in a music on hold entry that are present in the music on hold folder will be deleted.




	<BR><BR><BR><BR>

	<B><FONT SIZE=3>VICIDIAL_TTS_PROMPTS TABLE</FONT></B><BR><BR>
	<A NAME="vicidial_tts_prompts-tts_id">
	<BR>
	<B>TTS ID -</B> This is the short name of a TTS entry. This needs to be a unique identifier. Do not use any spaces or punctuation for this field. max 50 characters, minimum of 2 characters.

	<BR>
	<A NAME="vicidial_tts_prompts-tts_name">
	<B>TTS Name -</B> This is a more descriptive name of the TTS entry. This is a short summary of the TTS definition. max 100 characters, minimum of 2 characters.

	<BR>
	<A NAME="vicidial_tts_prompts-active">
	<B>Active -</B> This option allows you to set the TTS entry to active or inactive.

	<BR>
	<A NAME="vicidial_tts_prompts-tts_text">
	<B>TTS Text -</B> This is the actual Text To Speech data field that is sent to Cepstral for creation of the audio file to be played to the customer. you can use Speech Synthesis Markup Language -SSML- in this field, for example, &lt;break time='1000ms'/&gt; for a 1 second break. You can also use several variables such as first name, last name and title as CCMS variables just like you do in a Script: --A--first_name--B--. Here is a list of the available variables: lead_id, entry_date, modify_date, status, user, vendor_lead_code, source_id, list_id, phone_number, title, first_name, middle_initial, last_name, address1, address2, address3, city, state, province, postal_code, country_code, gender, date_of_birth, alt_phone, email, security_phrase, comments, called_count, last_local_call_time, rank, owner




	<BR><BR><BR><BR>

	<B><FONT SIZE=3>VICIDIAL_VOICEMAIL TABLE</FONT></B><BR><BR>
	<A NAME="vicidial_voicemail-voicemail_id">
	<BR>
	<B>Voicemail ID -</B> This is the all numbers identifier of this mailbox. This must not be a duplicate of an existing voicemail ID or the voicemail ID of a phone on the system, minimum of 2 characters.

	<BR>
	<A NAME="vicidial_voicemail-fullname">
	<B>Name -</B> This is name associated with this voicemail box. max 100 characters, minimum of 2 characters.

	<BR>
	<A NAME="vicidial_voicemail-pass">
	<B>Password -</B> This is the password that is used to gain access to the voicemail box when dialing in to check messages max 10 characters, minimum of 2 characters.

	<BR>
	<A NAME="vicidial_voicemail-active">
	<B>Active -</B> This option allows you to set the voicemail box to active or inactive. If the box is inactive you cannot leave messages on it and you cannot check messages in it.

	<BR>
	<A NAME="vicidial_voicemail-email">
	<B>Email -</B> This optional setting allows you to have the voicemail messages sent to an email account, if your system is set up to send out email. If this field is empty then no emails will be sent out.

	<BR>
	<A NAME="vicidial_voicemail-delete_vm_after_email">
	<B>Delete Voicemail After Email -</B> This optional setting allows you to have the voicemail messages deleted from the system after they have been emailed out. Default is N.




	<?php
	if ($SSoutbound_autodial_active > 0)
		{
		?>

		<BR><BR><BR><BR>

		<B><FONT SIZE=3>CCMS LIST LOADER FUNCTIONALITY</FONT></B><BR><BR>
		<A NAME="vicidial_list_loader">
		<BR>
		The CCMS basic web-based lead loader is designed simply to take a lead file - up to 8MB in size - that is either tab or pipe delimited and load it into the vicidial_list table. The lead loader allows for field choosing and TXT- Plain Text, CSV- Comma Separated Values and XLS- Excel file formats. The lead loader does not do data validation, but it does allow you to check for duplicates in itself, within the campaign or within the entire system. Also, make sure that you have created the list that these leads are to be under so that you can use them. Here is a list of the fields in their proper order for the lead files:
			<OL>
			<LI>Vendor Lead Code - shows up in the Vendor ID field of the GUI
			<LI>Source Code - internal use only for admins and DBAs
			<LI>List ID - the list number that these leads will show up under
			<LI>Phone Code - the prefix for the phone number - 1 for US, 01144 for UK, 01161 for AUS, etc
			<LI>Phone Number - must be at least 8 digits long
			<LI>Title - title of the customer - Mr. Ms. Mrs, etc...
			<LI>First Name
			<LI>Middle Initial
			<LI>Last Name
			<LI>Address Line 1
			<LI>Address Line 2
			<LI>Address Line 3
			<LI>City
			<LI>State - limited to 2 characters
			<LI>Province
			<LI>Postal Code
			<LI>Country
			<LI>Gender
			<LI>Date of Birth
			<LI>Alternate Phone Number
			<LI>Email Address
			<LI>Security Phrase
			<LI>Comments
			</OL>

		<BR>NOTES: The Excel Lead loader functionality is enabled by a series of perl scripts and needs to have a properly configured /etc/astguiclient.conf file in place on the web server. Also, a couple perl modules must be loaded for it to work as well - OLE-Storage_Lite and Spreadsheet-ParseExcel. You can check for runtime errors in these by looking at your apache error_log file. Also, for duplication checks against gampaign lists, the list that has new leads going into it does need to be created in the system before you start to load the leads.




		<BR><BR><BR><BR>
		<?php
		}
	?>





	<B><FONT SIZE=3>PHONES TABLE</FONT></B><BR><BR>
	<A NAME="phones-extension">
	<BR>
	<B>Phone extension -</B> This field is where you put the phones name as it appears to Asterisk not including the protocol or slash at the beginning. For Example: for the SIP phone SIP/test101 the Phone extension would be test101. Also, for IAX2 phones make sure you use the full phones name: IAX2/IAXphone1@IAXphone1 would be IAXphone1@IAXphone1. For Zap phones make sure you put the full channel: Zap/25-1 would be 25-1.  Another note, make sure you set the Protocol below correctly for your type of phone.

	<BR>
	<A NAME="phones-dialplan_number">
	<BR>
	<B>Dial Plan Number -</B> This field is for the number you dial to have the phone ring. This number is defined in the extensions.conf file of your Asterisk server

	<BR>
	<A NAME="phones-voicemail_id">
	<BR>
	<B>Voicemail Box -</B> This field is for the voicemail box that the messages go to for the user of this phone. We use this to check for voicemail messages and for the user to be able to use the VOICEMAIL button on astGUIclient app.

	<BR>
	<A NAME="phones-outbound_cid">
	<BR>
	<B>Outbound CallerID -</B> This field is where you would enter the callerID number that you would like to appear on outbound calls placed form the astguiclient web-client. This does not work on RBS, non-PRI, T1/E1s.

	<BR>
	<A NAME="phones-phone_ip">
	<BR>
	<B>Phone IP address -</B> This field is for the phone's IP address if it is a VOIP phone. This is an optional field

	<BR>
	<A NAME="phones-computer_ip">
	<BR>
	<B>Computer IP address -</B> This field is for the user's computer IP address. This is an optional field

	<BR>
	<A NAME="phones-server_ip">
	<BR>
	<B>Server IP -</B> This menu is where you select which server the phone is active on.

	<BR>
	<A NAME="phones-login">
	<BR>
	<B>Login -</B> The login used for the phone user to login to the client applications.

	<BR>
	<A NAME="phones-pass">
	<BR>
	<B>Password -</B>  The password used for the phone user to login to the client applications. IMPORTANT, this is the password only for the agent web interface phone login, to change the sip.conf or iax.conf password, or secret, for this phone device you need to modify the Conf File Secret field further down on this page.

	<BR>
	<A NAME="phones-status">
	<BR>
	<B>Status -</B> The status of the phone in the system, ACTIVE and ADMIN allow for GUI clients to work. ADMIN allows access to this administrative web site. All other Call Result do not allow GUI or Admin web access.

	<BR>
	<A NAME="phones-active">
	<BR>
	<B>Active Account -</B> Whether the phone is active to put it in the list in the GUI client.

	<BR>
	<A NAME="phones-phone_type">
	<BR>
	<B>Phone Type -</B> Purely for administrative notes.

	<BR>
	<A NAME="phones-fullname">
	<BR>
	<B>Full Name -</B> Used by the GUIclient in the list of active phones.

	<BR>
	<A NAME="phones-company">
	<BR>
	<B>Company -</B> Purely for administrative notes.

	<BR>
	<A NAME="phones-email">
	<BR>
	<B>Phones Email -</B> The email address associated with this phone entry. This is used for voicemail settings.

	<BR>
	<A NAME="phones-delete_vm_after_email">
	<B>Delete Voicemail After Email -</B> This optional setting allows you to have the voicemail messages deleted from the system after they have been emailed out. Default is N.

	<BR>
	<A NAME="phones-picture">
	<BR>
	<B>Picture -</B> Not yet Implemented.

	<BR>
	<A NAME="phones-messages">
	<BR>
	<B>New Messages -</B> Number of new voicemail messages for this phone on the Asterisk server.

	<BR>
	<A NAME="phones-old_messages">
	<BR>
	<B>Old Messages -</B> Number of old voicemail messages for this phone on the Asterisk server.

	<BR>
	<A NAME="phones-protocol">
	<BR>
	<B>Client Protocol -</B> The protocol that the phone uses to connect to the Asterisk server: SIP, IAX2, Zap . Also, there is EXTERNAL for remote dial numbers or speed dial numbers that you want to list as phones.

	<BR>
	<A NAME="phones-local_gmt">
	<BR>
	<B>Local GMT -</B> The difference from Greenwich Mean time, or ZULU time where the phone is located. DO NOT ADJUST FOR DAYLIGHT SAVINGS TIME. This is used by the CCMS campaign to accurately display the time and customer time.

	<BR>
	<A NAME="phones-phone_ring_timeout">
	<BR>
	<B>Phone Ring Timeout -</B> This is the amount of time, in seconds, that the phone will ring in the dialplan before sending the call to voicemail. Default is 60 seconds.

	<BR>
	<A NAME="phones-ASTmgrUSERNAME">
	<BR>
	<B>Manager Login -</B> This is the login that the GUI clients for this phone will use to access the Database where the server data resides.

	<BR>
	<A NAME="phones-ASTmgrSECRET">
	<BR>
	<B>Manager Secret -</B> This is the password that the GUI clients for this phone will use to access the Database where the server data resides.

	<BR>
	<A NAME="phones-login_user">
	<BR>
	<B>CCMS Default User -</B> This is to place a default value in the CCMS user field whenever this phone user opens the astVICIDIAL client app. Leave blank for no user.

	<BR>
	<A NAME="phones-login_pass">
	<BR>
	<B>CCMS Default Pass -</B> This is to place a default value in the CCMS password field whenever this phone user opens the astVICIDIAL client app. Leave blank for no pass.

	<BR>
	<A NAME="phones-login_campaign">
	<BR>
	<B>CCMS Default Campaign -</B> This is to place a default value in the CCMS campaign field whenever this phone user opens the astVICIDIAL client app. Leave blank for no campaign.

	<BR>
	<A NAME="phones-park_on_extension">
	<BR>
	<B>Park Exten -</B> This is the default Parking extension for the client apps. Verify that a different one works before you change this.

	<BR>
	<A NAME="phones-conf_on_extension">
	<BR>
	<B>Conf Exten -</B> This is the default Conference park extension for the client apps. Verify that a different one works before you change this.

	<BR>
	<A NAME="phones-VICIDIAL_park_on_extension">
	<BR>
	<B>CCMS Park Exten -</B> This is the default Parking extension for CCMS client app. Verify that a different one works before you change this.

	<BR>
	<A NAME="phones-VICIDIAL_park_on_filename">
	<BR>
	<B>CCMS Park File -</B> This is the default CCMS park extension file name for the client apps. Verify that a different one works before you change this. limited to 10 characters.

	<BR>
	<A NAME="phones-monitor_prefix">
	<BR>
	<B>Monitor Prefix -</B> This is the dial plan prefix for monitoring of Zap channels automatically within the astGUIclient app. Only change according to the extensions.conf ZapBarge extensions records.

	<BR>
	<A NAME="phones-recording_exten">
	<BR>
	<B>Recording Exten -</B> This is the dial plan extension for the recording extension that is used to drop into meetme conferences to record them. It usually lasts upto one hour if not stopped. verify with extensions.conf file before changing.

	<BR>
	<A NAME="phones-voicemail_exten">
	<BR>
	<B>VMAIL Main Exten -</B> This is the dial plan extension going to check your voicemail. verify with extensions.conf file before changing.

	<BR>
	<A NAME="phones-voicemail_dump_exten">
	<BR>
	<B>VMAIL Dump Exten -</B> This is the dial plan prefix used to send calls directly to a user's voicemail from a live call in the astGUIclient app. verify with extensions.conf file before changing.

	<BR>
	<A NAME="phones-ext_context">
	<BR>
	<B>Exten Context -</B> This is the dial plan context that the agent applications, like CCMS, primarily use. It is assumed that all numbers dialed by the client apps are using this context so it is a good idea to make sure this is the most wide context possible. verify with extensions.conf file before changing. default is default.

	<BR>
	<A NAME="phones-phone_context">
	<BR>
	<B>Phone Context -</B> This is the dial plan context that this phone will use to dial out. If you are running a call center and you do not want your agents to be able to dial out outside of the CCMS applicaiton for example, then you would set this field to a dialplan context that does not exist, something like agent-nodial. default is default.

	<BR>
	<A NAME="phones-conf_secret">
	<BR>
	<B>Conf File Secret -</B> This is the secret, or password, for the phone in the iax or sip auto-generated conf file for this phone. Limit is 20 characters alphanumeric dash and underscore accepted. Default is test.

	<BR>
	<A NAME="phones-dtmf_send_extension">
	<BR>
	<B>DTMF send Channel -</B> This is the channel string used to send DTMF sounds into meetme conferences from the client apps. Verify the exten and context with the extensions.conf file.

	<BR>
	<A NAME="phones-call_out_number_group">
	<BR>
	<B>Outbound Call Group -</B> This is the channel group that outbound calls from this phone are placed out of. There are a couple routines in the client apps that use this. For Zap channels you want to use something like Zap/g2 , for IAX2 trunks you would want to use the full IAX prefix like IAX2/VICItest1:secret@10.10.10.15:4569. Verify the trunks with the extensions.conf file, it is usually what you have defined as the TRUNK global variable at the top of the file.

	<BR>
	<A NAME="phones-client_browser">
	<BR>
	<B>Browser Location -</B> This is applicable to only UNIX/LINUX clients, the absolute path to Mozilla or Firefox browser on the machine. verify this by launching it manually.

	<BR>
	<A NAME="phones-install_directory">
	<BR>
	<B>Install Directory -</B> This is the place where the astGUIclient and astVICIDIAL scripts are located on your machine. For Win32 it should be something like C:\AST_VICI and for UNIX it should be something like /usr/local/perl_TK. verify this manually.

	<BR>
	<A NAME="phones-local_web_callerID_URL">
	<BR>
	<B>CallerID URL -</B> This is the web address of the page used to do custom callerID lookups. default testing address is: http://astguiclient.sf.net/test_callerid_output.php

	<BR>
	<A NAME="phones-VICIDIAL_web_URL">
	<BR>
	<B>CCMS Default URL -</B> This is the web address of the page used to do custom CCMS Web Form queries. default testing address is: http://astguiclient.sf.net/test_VICIDIAL_output.php

	<BR>
	<A NAME="phones-AGI_call_logging_enabled">
	<BR>
	<B>Call Logging -</B> This is set to true if the call_log.agi file is in place in the extensions.conf file for all outbound and hang up 'h' extensions to log all calls. This should always be 1 because it is manditory for many astGUIclient and CCMS features to work properly.

	<BR>
	<A NAME="phones-user_switching_enabled">
	<BR>
	<B>User Switching -</B> Set to true to allow user to switch to another user account. NOTE: If user switches they can initiate recording on the new user's phone conversation

	<BR>
	<A NAME="phones-conferencing_enabled">
	<BR>
	<B>Conferencing -</B> Set to true to allow user to start conference calls with upto six external lines.

	<BR>
	<A NAME="phones-admin_hangup_enabled">
	<BR>
	<B>Admin Hang Up -</B> Set to true to allow user to be able to hang up any line at will through astGUIclient. Good idea only to enable this for Admin users.

	<BR>
	<A NAME="phones-admin_hijack_enabled">
	<BR>
	<B>Admin Hijack -</B> Set to true to allow user to be able to grab and redirect to their extension any line at will through astGUIclient. Good idea only to enable this for Admin users. But is very useful for Managers.

	<BR>
	<A NAME="phones-admin_monitor_enabled">
	<BR>
	<B>Admin Monitor -</B> Set to true to allow user to be able to grab and redirect to their extension any line at will through astGUIclient. Good idea only to enable this for Admin users. But is very useful for Managers and as a training tool.

	<BR>
	<A NAME="phones-call_parking_enabled">
	<BR>
	<B>Call Park -</B> Set to true to allow user to be able to park calls on astGUIclient hold to be picked up by any other astGUIclient user on the system. Calls stay on hold for upto a half hour then hang up. Usually enabled for all.

	<BR>
	<A NAME="phones-updater_check_enabled">
	<BR>
	<B>Updater Check -</B> Set to true to display a popup warning that the updater time has not changed in 20 seconds. Useful for Admin users.

	<BR>
	<A NAME="phones-AFLogging_enabled">
	<BR>
	<B>AF Logging -</B> Set to true to log many actions of astGUIclient usage to a text file on the user's computer.

	<BR>
	<A NAME="phones-QUEUE_ACTION_enabled">
	<BR>
	<B>Queue Enabled -</B> Set to true to have client apps use the Asterisk Central Queue system. Required for CCMS and recommended for all users.

	<BR>
	<A NAME="phones-CallerID_popup_enabled">
	<BR>
	<B>CallerID Popup -</B> Set to true to allow for numbers defined in the extensions.conf file to send CallerID popup screens to astGUIclient users.

	<BR>
	<A NAME="phones-voicemail_button_enabled">
	<BR>
	<B>VMail Button -</B> Set to true to display the VOICEMAIL button and the messages count display on astGUIclient.

	<BR>
	<A NAME="phones-enable_fast_refresh">
	<BR>
	<B>Fast Refresh -</B> Set to true to enable a new rate of refresh of call information for the astGUIclient. Default disabled rate is 1000 ms ,1 second. Can increase system load if you lower this number.

	<BR>
	<A NAME="phones-fast_refresh_rate">
	<BR>
	<B>Fast Refresh Rate -</B> in milliseconds. Only used if Fast Refresh is enabled. Default disabled rate is 1000 ms ,1 second. Can increase system load if you lower this number.

	<BR>
	<A NAME="phones-enable_persistant_mysql">
	<BR>
	<B>Persistant MySQL -</B> If enabled the astGUIclient connection will remain connected instead of connecting every second. Useful if you have a fast refresh rate set. It will increase the number of connections on your MySQL machine.

	<BR>
	<A NAME="phones-auto_dial_next_number">
	<BR>
	<B>Auto Dial Next Number -</B> If enabled the CCMS client will dial the next number on the list automatically upon disposition of a call unless they selected to "Stop Dialing" on the disposition screen.

	<BR>
	<A NAME="phones-VDstop_rec_after_each_call">
	<BR>
	<B>Stop Rec after each call -</B> If enabled the CCMS client will stop whatever recording is going on after each call has been dispositioned. Useful if you are doing a lot of recording or you are using a web form to trigger recording.

	<BR>
	<A NAME="phones-enable_sipsak_messages">
	<BR>
	<B>Enable SIPSAK Messages -</B> If enabled the server will send messages to the SIP phone to display on the phone LCD display when logged into CCMS. Feature only works with SIP phones and requires sipsak application to be installed on the web server. Default is 0.

	<BR>
	<A NAME="phones-DBX_server">
	<BR>
	<B>DBX Server -</B> The MySQL database server that this user should be connecting to.

	<BR>
	<A NAME="phones-DBX_database">
	<BR>
	<B>DBX Database -</B> The MySQL database that this user should be connecting to. Default is asterisk.

	<BR>
	<A NAME="phones-DBX_user">
	<BR>
	<B>DBX User -</B> The MySQL user login that this user should be using when connecting. Default is cron.

	<BR>
	<A NAME="phones-DBX_pass">
	<BR>
	<B>DBX Pass -</B> The MySQL user password that this user should be using when connecting. Default is 1234.

	<BR>
	<A NAME="phones-DBX_port">
	<BR>
	<B>DBX Port -</B> The MySQL TCP port that this user should be using when connecting. Default is 3306.

	<BR>
	<A NAME="phones-DBY_server">
	<BR>
	<B>DBY Server -</B> The MySQL database server that this user should be connecting to. Secondary server, not used currently.

	<BR>
	<A NAME="phones-DBY_database">
	<BR>
	<B>DBY Database -</B> The MySQL database that this user should be connecting to. Default is asterisk. Secondary server, not used currently.

	<BR>
	<A NAME="phones-DBY_user">
	<BR>
	<B>DBY User -</B> The MySQL user login that this user should be using when connecting. Default is cron. Secondary server, not used currently.

	<BR>
	<A NAME="phones-DBY_pass">
	<BR>
	<B>DBY Pass -</B> The MySQL user password that this user should be using when connecting. Default is 1234. Secondary server, not used currently.

	<BR>
	<A NAME="phones-DBY_port">
	<BR>
	<B>DBY Port -</B> The MySQL TCP port that this user should be using when connecting. Default is 3306. Secondary server, not used currently.

	<BR>
	<A NAME="phones-alias_id">
	<BR>
	<B>Alias ID -</B> The ID of the alias used to allow for phone load balanced logins. no spaces or other special characters allowed. Must be between 2 and 20 characters in length.

	<BR>
	<A NAME="phones-alias_name">
	<BR>
	<B>Alias Name -</B> The name used to describe a phones alias, Must be between 2 and 50 characters in length.

	<BR>
	<A NAME="phones-logins_list">
	<BR>
	<B>Phones Logins List -</B> The comma separated list of phone logins used when an agent logs in using phone load balanced logins. The Agent application will find the active server with the fewest agents logged into it and place a call from that server to the agent upon login.

	<BR>
	<A NAME="phones-template_id">
	<BR>
	<B>Template ID -</B> This is the conf file template ID that this phone entry will use for its Asterisk settings. Default is --NONE--.

	<BR>
	<A NAME="phones-conf_override">
	<BR>
	<B>Conf Override Settings -</B> If populated, and the Template ID is set to --NONE-- then the contents of this field are used as the conf file entries for this phone. generate_vicidial_conf for this phones server must be set to Y for this to work. This field should NOT contain the [extension] line, that will be automatically generated.

	<BR>
	<A NAME="phones-group_alias_id">
	<BR>
	<B>Group Alias ID -</B> The ID of the group alias used by agents to dial out calls from the CCMS agent interface with different Caller IDs. no spaces or other special characters allowed. Must be between 2 and 20 characters in length.

	<BR>
	<A NAME="phones-group_alias_name">
	<BR>
	<B>Group Alias Name -</B> The name used to describe a group alias, Must be between 2 and 50 characters in length.

	<BR>
	<A NAME="phones-caller_id_number">
	<BR>
	<B>Caller ID Number -</B> The Caller ID number used in this Group Alias. Must be digits only.

	<BR>
	<A NAME="phones-caller_id_name">
	<BR>
	<B>Caller ID Name -</B> The Caller ID name that can be sent out with this Group Alias. As far as we know this will only work in Canada on PRI circuits and using an IAX loop trunk through Asterisk.


	<BR><BR><BR><BR>

	<B><FONT SIZE=3>BATCH ADD PHONES TABLE</FONT></B><BR>
	<BR>
	<A NAME="phone-extension-from">
	<BR>
	<B>Phone Extension From -</B> 批量添加分机的开始分机号码.

	<BR>
	<A NAME="phone-extension-to">
	<BR>
	<B>Phone Extension to -</B> 批量添加分机的结束分机号码.

	<BR>
	<A NAME="ACS-server-IP">
	<BR>
	<B>ACS Server IP -</B> This menu is where you select which server the phone is active on.


	<BR><BR><BR><BR>

	<B><FONT SIZE=3>BATCH COPY USER TABLE</FONT></B><BR>
	<BR>
	<A NAME="user-number-prefix">
	<BR>
	<B>User Number Prefix -</B> 批量拷贝用户的前缀，可以为空.

	<BR>
	<A NAME="user-number-suffix">
	<BR>
	<B>User Number Suffix From | To -</B> 批量拷贝用户的后缀开始号码和结束号码，只能是数字，且长度不能小于2.

	<BR>
	<A NAME="user-number-password">
	<BR>
	<B>Password -</B> This field is where you put the CCMS users password. Must be at least 2 characters in length.

	<BR>
	<A NAME="user-number-active">
	<BR>
	<B>Active - </B>This field defines whether the user is active in the system and can use CCMS resources. Default is Y 

	<BR>
	<A NAME="user-number-source-user">
	<BR>
	<B>Source User -</B>能被进行批量拷贝的用户源.





	<BR><BR><BR><BR>

	<B><FONT SIZE=3>SERVERS TABLE</FONT></B><BR><BR>
	<A NAME="servers-server_id">
	<BR>
	<B>Server ID -</B> This field is where you put the Asterisk servers name, doesnt have to be an official domain sub, just a nickname to identify the server to Admin users.

	<BR>
	<A NAME="servers-server_description">
	<BR>
	<B>Server Description -</B> The field where you use a small phrase to describe the Asterisk server.

	<BR>
	<A NAME="servers-server_ip">
	<BR>
	<B>Server IP Address -</B> The field where you put the Network IP address of the Asterisk server.

	<BR>
	<A NAME="servers-active">
	<BR>
	<B>Active -</B> Set whether the Asterisk server is active or inactive.

	<BR>
	<A NAME="servers-sysload">
	<BR>
	<B>System Load -</B> These two statistics show the loadavg of a system times 100 and the CPU usage percentage of the server and is updated every minute. The loadavg should on average be below 100 multiplied by the number of CPU cores your system has, for optimal performance. The CPU usage percentage should stay below 50 for optimal performance.

	<BR>
	<A NAME="servers-channels_total">
	<BR>
	<B>Live Channels -</B> This field shows the current number of Asterisk channels that are live on the system right now. It is important to note that the number of Asterisk channels is usually much higher than the number of actual calls on a system. This field is updated once every minute.

	<BR>
	<A NAME="servers-disk_usage">
	<BR>
	<B>Disk Usage -</B> This field will show the disk usage for every partition on this server. This field is updated once every minute.

	<BR>
	<A NAME="servers-asterisk_version">
	<BR>
	<B>Asterisk Version -</B> Set the version of Asterisk that you have installed on this server. Examples: '1.2', '1.0.8', '1.0.7', 'CVS_HEAD', 'REALLY OLD', etc... This is used because versions 1.0.8 and 1.0.9 have a different method of dealing with Local/ channels, a bug that has been fixed in CVS v1.0, and need to be treated differently when handling their Local/ channels. Also, current CVS_HEAD and the 1.2 release tree uses different manager and command output so it must be treated differently as well.

	<BR>
	<A NAME="servers-max_vicidial_trunks">
	<BR>
	<B>Max CCMS Trunks -</B> This field will determine the maximum number of lines that the CCMS auto-dialer will attempt to call on this server. If you want to dedicate two full PRI T1s to VICIDIALing on a server then you would set this to 46. Default is 96.

	<BR>
	<A NAME="servers-outbound_calls_per_second">
	<BR>
	<B>Max Calls per Second -</B> This setting determines the maximum number of calls that can be placed by the outbound auto-dialing script on this server per second. Must be from 1 to 100. Default is 20.

	<BR>
	<A NAME="servers-telnet_host">
	<BR>
	<B>Telnet Host -</B> This is the address or name of the Asterisk server and is how the manager applications connect to it from where they are running. If they are running on the Asterisk server, then the default of 'localhost' is fine.

	<BR>
	<A NAME="servers-telnet_port">
	<BR>
	<B>Telnet Port -</B> This is the port of the Asterisk server Manager connection and is how the manager applications connect to it from where they are running. The default of '5038' is fine for a standard install.

	<BR>
	<A NAME="servers-ASTmgrUSERNAME">
	<BR>
	<B>Manager User -</B> The username or login used to connect genericly to the Asterisk server manager. Default is 'cron'

	<BR>
	<A NAME="servers-ASTmgrSECRET">
	<BR>
	<B>Manager Secret -</B> The secret or password used to connect genericly to the Asterisk server manager. Default is '1234'

	<BR>
	<A NAME="servers-ASTmgrUSERNAMEupdate">
	<BR>
	<B>Manager Update User -</B> The username or login used to connect to the Asterisk server manager optimized for the Update scripts. Default is 'updatecron' and assumes the same secret as the generic user.

	<BR>
	<A NAME="servers-ASTmgrUSERNAMElisten">
	<BR>
	<B>Manager Listen User -</B> The username or login used to connect to the Asterisk server manager optimized for scripts that only listen for output. Default is 'listencron' and assumes the same secret as the generic user.

	<BR>
	<A NAME="servers-ASTmgrUSERNAMEsend">
	<BR>
	<B>Manager Send User -</B> The username or login used to connect to the Asterisk server manager optimized for scripts that only send Actions to the manager. Default is 'sendcron' and assumes the same secret as the generic user.

	<BR>
	<A NAME="servers-conf_secret">
	<BR>
	<B>Conf File Secret -</B> This is the secret, or password, for the server in the iax auto-generated conf file for this server on other servers. Limit is 20 characters alphanumeric dash and underscore accepted. Default is test.

	<BR>
	<A NAME="servers-local_gmt">
	<BR>
	<B>Server GMT offset -</B> The difference in hours from GMT time not adjusted for Daylight-Savings-Time of the server. Default is '-5'

	<BR>
	<A NAME="servers-voicemail_dump_exten">
	<BR>
	<B>VMail Dump Exten -</B> The extension prefix used on this server to send calls directly through agc to a specific voicemail box. Default is '85026666666666'

	<BR>
	<A NAME="servers-answer_transfer_agent">
	<BR>
	<B>CCMS AD extension -</B> The default extension if none is present in the campaign to send calls to for CCMS auto dialing. Default is '8365'

	<BR>
	<A NAME="servers-ext_context">
	<BR>
	<B>Default Context -</B> The default dial plan context used for scripts that operate for this server. Default is 'default'

	<BR>
	<A NAME="servers-sys_perf_log">
	<BR>
	<B>System Performance -</B> Setting this option to Y will enable logging of system performance stats for the server machine including system load, system processes and Asterisk channels in use. Default is N.

	<BR>
	<A NAME="servers-vd_server_logs">
	<BR>
	<B>Server Logs -</B> Setting this option to Y will enable logging of all CCMS related scripts to their text log files. Setting this to N will stop writing logs to files for these processes, also the screen logging of asterisk will be disabled if this is set to N when Asterisk is started. Default is Y.

	<BR>
	<A NAME="servers-agi_output">
	<BR>
	<B>AGI Output -</B> Setting this option to NONE will disable output from all CCMS related AGI scripts. Setting this to STDERR will send the AGI output to the Asterisk CLI. Setting this to FILE will send the output to a file in the logs directory. Setting this to BOTH will send output to both the Asterisk CLI and a log file. Default is FILE.

	<BR>
	<A NAME="servers-vicidial_balance_active">
	<BR>
	<B>CCMS Balance Dialing -</B> Setting this field to Y will allow the server to place balance calls for campaigns in CCMS so that the defined dial level can be met even if there are no agents logged into that campaign on this server. Default is N.

	<BR>
	<A NAME="servers-vicidial_balance_rank">
	<BR>
	<B>CCMS Balance Rank -</B> This field allows you to set the order in which this server is to be used for balance dialing, if balance dialing is enabled. The server with the highest rank will be used first in placing Balance fill calls. Default is 0.

	<BR>
	<A NAME="servers-balance_trunks_offlimits">
	<BR>
	<B>CCMS Balance Offlimits -</B> This setting defines the number of trunks to not allow CCMS balance dialing to use. For example if you have 40 max CCMS trunks and balance offlimits is set to 10 you will only be able to use 30 trunk lines for CCMS balance dialing. Default is 0.

	<BR>
	<A NAME="servers-recording_web_link">
	<BR>
	<B>Recording Web Link -</B> This setting allows you to override the default of the display of the recording link in the admin web pages. Default is SERVER_IP.

	<BR>
	<A NAME="servers-alt_server_ip">
	<BR>
	<B>Alternate Recording Server IP -</B> This setting is where you can put a server IP or other machine name that can be used in place of the server_ip in the links to recordings within the admin web pages. Default is empty.

	<BR>
	<A NAME="servers-active_asterisk_server">
	<BR>
	<B>Active Asterisk Server -</B> If Asterisk is not running on this server, or if CCMS should not be using this server, or if are only using this server for other scripts like the hopper loading script you would want to set this to N. Default is Y.

	<BR>
	<A NAME="servers-active_agent_login_server">
	<BR>
	<B>Active Agent Server -</B> Setting this option to N will prevent agents from being able to login to this server through the CCMS agent screen. This is very useful when using a phone login load balanced setup. Default is Y.

	<BR>
	<A NAME="servers-generate_vicidial_conf">
	<BR>
	<B>Generate conf files -</B> If you would like the system to auto-generate asterisk conf files based upon the phones entries, carrier entries and load balancing setup within CCMS then set this to Y. Default is Y.

	<BR>
	<A NAME="servers-rebuild_conf_files">
	<BR>
	<B>Rebuild conf files -</B> If you want to force a rebuilding of the Asterisk conf files or if any of the phones or carrier entries have changed then this should be set to Y. After the conf files have been generated and Asterisk has been reloaded then this will be changed to N. Default is Y.

	<BR>
	<A NAME="servers-rebuild_music_on_hold">
	<BR>
	<B>Rebuild Music On Hold -</B> If you want to force a rebuilding of the music on hold files or if the music on hold entries or server entries have changed then this should be set to Y. After the music on hold files have been synchronized and reloaded then this will be changed to N. Default is Y.

	<BR>
	<A NAME="servers-sounds_update">
	<BR>
	<B>Sounds Update -</B> If you want to force a check of the sound files on this server, and the central audio store is enabled as a system setting, then this field will allow the sounds updater to run at the next top of the minute. Any time an audio file is uploaded from the web interface this is automatically set to Y for all servers that have Asterisk active. Default is N.

	<BR>
	<A NAME="servers-vicidial_recording_limit">
	<BR>
	<B>CCMS Recording Limit -</B> This field is where you set the maximum number of minutes that a call recording initiated by CCMS can be. Default is 60 minutes.

	<BR>
	<A NAME="servers-carrier_logging_active">
	<BR>
	<B>Carrier Logging Active -</B> This setting allows you to log all hangup return codes for any outbound list dialing calls that you are placing. Default is N.






	<BR><BR><BR><BR>

	<B><FONT SIZE=3>vicidial_conf_templates TABLE</FONT></B><BR><BR>
	<A NAME="vicidial_conf_templates-template_id">
	<BR>
	<B>Template ID -</B> This field needs to be at least 2 characters in length and no more than 15 characters in length, no spaces. This is the ID that will be used to identify the conf template throughout the system.

	<BR>
	<A NAME="vicidial_conf_templates-template_name">
	<BR>
	<B>Template Name -</B> This is the descriptive name of the conf file template entry.

	<BR>
	<A NAME="vicidial_conf_templates-template_contents">
	<BR>
	<B>Template Contents -</B> This field is where you can enter in the specific settings to be used by all phones and-or carriers that are set to use this conf template. Fields that should NOT be included in this box are: secret, accountcode, account, username and mailbox.





	<BR><BR><BR><BR>

	<B><FONT SIZE=3>vicidial_server_carriers TABLE</FONT></B><BR><BR>
	<A NAME="vicidial_server_carriers-carrier_id">
	<BR>
	<B>Carrier ID -</B> This field needs to be at least 2 characters in length and no more than 15 characters in length, no spaces. This is the ID that will be used to identify the carrier for this specific entry throughout the system.

	<BR>
	<A NAME="vicidial_server_carriers-carrier_name">
	<BR>
	<B>Carrier Name -</B> This is the descriptive name of the carrier entry.

	<BR>
	<A NAME="vicidial_server_carriers-carrier_description">
	<BR>
	<B>Carrier Description -</B> This is put in the comments of the asterisk conf files above the dialplan and account entries. Maximum 255 characters.

	<BR>
	<A NAME="vicidial_server_carriers-registration_string">
	<BR>
	<B>Registration String -</B> This field is where you can enter in the exact string needed in the IAX or SIP configuration file to register to the provider. Optional but highly recommended if your carrier allows registration.

	<BR>
	<A NAME="vicidial_server_carriers-template_id">
	<BR>
	<B>Template ID -</B> This optional field allows you to choose a conf file template for this carrier entry.

	<BR>
	<A NAME="vicidial_server_carriers-account_entry">
	<BR>
	<B>Account Entry -</B> This field is used if you have not selected a template to use, and it is where you can enter in the specific account settings to be used for this carrier. If you will be taking in inbound calls from this carrier trunk you might want to set the context=trunkinbound within this field so that you can use the DID handling process within CCMS.

	<BR>
	<A NAME="vicidial_server_carriers-protocol">
	<BR>
	<B>Protocol -</B> This field allows you to define the protocol to use for the carrier entry. Currently only IAX and SIP are supported.

	<BR>
	<A NAME="vicidial_server_carriers-globals_string">
	<BR>
	<B>Globals String -</B> This optional field allows you to define a global variable to use for the carrier in the dialplan.

	<BR>
	<A NAME="vicidial_server_carriers-dialplan_entry">
	<BR>
	<B>Dialplan Entry -</B> This optional field allows you to define a set of dialplan entries to use for this carrier.

	<BR>
	<A NAME="vicidial_server_carriers-server_ip">
	<BR>
	<B>Server IP -</B> This is the server that this specific carrier record is associated with.

	<BR>
	<A NAME="vicidial_server_carriers-active">
	<BR>
	<B>Active -</B> This defines whether the carrier will be included in the auto-generated conf files or not.





	<BR><BR><BR><BR>

	<B><FONT SIZE=3>CONFERENCES TABLE</FONT></B><BR><BR>
	<A NAME="conferences-conf_exten">
	<BR>
	<B>Conference Number -</B> This field is where you put the meetme conference dialpna number. It is also recommended that the meetme number in meetme.conf matches this number for each entry. This is for the conferences in astGUIclient and is used for leave-3way-call functionality in CCMS.

	<BR>
	<A NAME="conferences-server_ip">
	<BR>
	<B>Server IP -</B> The menu where you select the Asterisk server that this conference will be on.




	<?php
	if ($SSoutbound_autodial_active > 0)
		{
		?>
		<BR><BR><BR><BR>

		<B><FONT SIZE=3>VICIDIAL_SERVER_TRUNKS TABLE</FONT></B><BR><BR>
		<A NAME="vicidial_server_trunks">
		<BR>
		<B>CCMS Server Trunks allows you to restrict the outgoing lines that are used on this server for campaign dialing on a per-campaign basis. You have the option to reserve a specific number of lines to be used by only one campaign as well as allowing that campaign to run over its reserved lines into whatever lines remain open, as long at the total lines used by CCMS on this server is less than the Max CCMS Trunks setting. Not having any of these records will allow the campaign that dials the line first to have as many lines as it can get under the Max CCMS Trunks setting.</B>
		<?php
		}
	?>




	<BR><BR><BR><BR>

	<B><FONT SIZE=3>SYSTEM_SETTINGS TABLE</FONT></B><BR><BR>
	<A NAME="settings-use_non_latin">
	<BR>
	<B>Use Non-Latin -</B> This option allows you to default the web display script to use UTF8 characters and not do any latin-character-family regular expression filtering or display formatting. Default is 0.

	<BR>
	<A NAME="settings-webroot_writable">
	<BR>
	<B>Webroot Writable -</B> This setting allows you to define whether temp files and authentication files should be placed in the webroot on your web server. Default is 1.

	<BR>
	<A NAME="settings-vicidial_agent_disable">
	<BR>
	<B>CCMS Agent Disable Display -</B> This field is used to select when to show an agent when their session has been disabled by the system, a manager action or by an external measure. The NOT_ACTIVE setting will disable the message on the agents screen. The LIVE_AGENT setting will only display the disabled message when the agents vicidial_auto_calls record has been removed, such as during a force logout or emergency logout. 

	<BR>
	<A NAME="settings-allow_sipsak_messages">
	<BR>
	<B>Allow SIPSAK Messages -</B> If set to Y, this will allow the phones table setting to work properly, the server will send messages to the SIP phone to display on the phone LCD display when logged into CCMS. This feature only works with SIP phones and requires sipsak application to be installed on the web server. Default is 0. 

	<BR>
	<A NAME="settings-vdc_agent_api_active">
	<BR>
	<B>Agent API Active -</B> If set to Y, this will allow the Agent API interface to function. Default is 0. 

	<BR>
	<A NAME="settings-admin_home_url">
	<BR>
	<B>Admin Home URL -</B> This is the URL or web site address that you will go to if you click on the HOME link at the top of the admin.php page.

	<BR>
	<A NAME="settings-ccms_url">
	<BR>
	<B>CCMS URL -</B> CCMS对应的链接。
	
	<BR>
	<A NAME="settings-ccms_report_url">
	<BR>
	<B>CCMS Report URL -</B> CCMS报表对应的链接.

	
	<BR>
	<A NAME="settings-enable_agc_xfer_log">
	<BR>
	<B>Enable Agent Transfer Logfile -</B> This option will log to a text logfile on the webserver every time a call is transferred to an agent. Default is 0, disabled.

	<BR>
	<A NAME="settings-timeclock_end_of_day">
	<BR>
	<B>Timeclock End Of Day -</B> This setting defines when all users are to be auto logged out of the timeclock system. Only runs once a day. must be only 4 digits 2 digit hour and 2 digit minutes in 24 hour time. Default is 0000.

	<BR>
	<A NAME="settings-timeclock_last_reset_date">
	<BR>
	<B>Timeclock Last Auto Logout -</B> This field displays the date of the last auto-logout.

	<BR>
	<A NAME="settings-vdc_header_date_format">
	<BR>
	<B>Agent Screen Header Date Format -</B> This menu allows you to choose the format of the date that shows up at the top of the CCMS agent screen. The options for this setting are: default is MS_DASH_24HR<BR>
	MS_DASH_24HR  2008-06-24 23:59:59 - Default date format with year month day followed by 24 hour time<BR>
	US_SLASH_24HR 06/24/2008 23:59:59 - USA date format with month day year followed by 24 hour time<BR>
	EU_SLASH_24HR 24/06/2008 23:59:59 - European date format with day month year followed by 24 hour time<BR>
	AL_TEXT_24HR  JUN 24 23:59:59 - Text date format with abbreviated month day followed by 24 hour time<BR>
	MS_DASH_AMPM  2008-06-24 11:59:59 PM - Default date format with year month day followed by 12 hour time<BR>
	US_SLASH_AMPM 06/24/2008 11:59:59 PM - USA date format with month day year followed by 12 hour time<BR>
	EU_SLASH_AMPM 24/06/2008 11:59:59 PM - European date format with day month year followed by 12 hour time<BR>
	AL_TEXT_AMPM  JUN 24 11:59:59 PM - Text date format with abbreviated month day followed by 12 hour time<BR>

	<BR>
	<A NAME="settings-vdc_customer_date_format">
	<BR>
	<B>Agent Screen Customer Date Format -</B> This menu allows you to choose the format of the customer time zone date that shows up at the top of the Customer Information section of the CCMS agent screen. The options for this setting are: default is AL_TEXT_AMPM<BR>
	MS_DASH_24HR  2008-06-24 23:59:59 - Default date format with year month day followed by 24 hour time<BR>
	US_SLASH_24HR 06/24/2008 23:59:59 - USA date format with month day year followed by 24 hour time<BR>
	EU_SLASH_24HR 24/06/2008 23:59:59 - European date format with day month year followed by 24 hour time<BR>
	AL_TEXT_24HR  JUN 24 23:59:59 - Text date format with abbreviated month day followed by 24 hour time<BR>
	MS_DASH_AMPM  2008-06-24 11:59:59 PM - Default date format with year month day followed by 12 hour time<BR>
	US_SLASH_AMPM 06/24/2008 11:59:59 PM - USA date format with month day year followed by 12 hour time<BR>
	EU_SLASH_AMPM 24/06/2008 11:59:59 PM - European date format with day month year followed by 12 hour time<BR>
	AL_TEXT_AMPM  JUN 24 11:59:59 PM - Text date format with abbreviated month day followed by 12 hour time<BR>

	<BR>
	<A NAME="settings-vdc_header_phone_format">
	<BR>
	<B>Agent Screen Customer Phone Format -</B> This menu allows you to choose the format of the customer phone number that shows up in the status section of the CCMS agent screen. The options for this setting are: default is US_PARN<BR>
	US_DASH 000-000-0000 - USA dash separated phone number<BR>
	US_PARN (000)000-0000 - USA dash separated number with area code in parenthesis<BR>
	MS_NODS 0000000000 - No formatting<BR>
	UK_DASH 00 0000-0000 - UK dash separated phone number with space after city code<BR>
	AU_SPAC 000 000 000 - Australia space separated phone number<BR>
	IT_DASH 0000-000-000 - Italy dash separated phone number<BR>
	FR_SPAC 00 00 00 00 00 - France space separated phone number<BR>

	<BR>
	<A NAME="settings-vdc_agent_api_active">
	<BR>
	<B>Agent interface API Access Active -</B> This option allows you to enable or disable the agent interface API. Default is 0.

	<BR>
	<A NAME="settings-agentonly_callback_campaign_lock">
	<BR>
	<B>Agent Only Callback Campaign Lock -</B> This option defines whether AGENTONLY callbacks are locked to the campaign that the agent originally created them under. Setting this to 1 means that the agent can only dial them from the campaign they were set under, 0 means that the agent can access them no matter what campaign they are logged into. Default is 1.

	<BR>
	<A NAME="settings-sounds_central_control_active">
	<BR>
	<B>Central Sound Control Active -</B> This option defines whether the sound synchronization system is active across all servers. Default is 0 for inactive.

	<BR>
	<A NAME="settings-sounds_web_server">
	<BR>
	<B>Sounds Web Server -</B> This is the server name or IP address of the web server that will be handling the sound files on this system, this must match the server name or IP of the machine you are trying to access the audio_store.php webpage on or it will not work. Default is 127.0.0.1.

	<BR>
	<A NAME="settings-sounds_web_directory">
	<BR>
	<B>Sounds Web Directory -</B> This auto-generated directory name is created at random by the system as the place that the audio store will be kept. All audio files will reside in this directory.

	<BR>
	<A NAME="settings-active_voicemail_server">
	<BR>
	<B>Active Voicemail Server -</B> In multi-server systems, this is the server that will handle all voicemail boxes. This server is also where the dial-in generated prompts will be uploaded from, the 8168 recordings.

	<BR>
	<A NAME="settings-outbound_autodial_active">
	<BR>
	<B>Outbound Auto-Dial Active -</B> This option allows you to enable or disable outbound auto-dialing within CCMS, setting this field to 0 will remove the LISTS and FILTERS sections and many fields from the Campaign Modification screens. Manual entry dialing will still be allowable from within the agent screen, but no list dialing will be possible. Default is 1 for active.

	<BR>
	<A NAME="settings-auto_dial_limit">
	<BR>
	<B>Ratio Dial Limit -</B> This is the maximum limit of the auto dial level in the campaign screen.

	<BR>
	<A NAME="settings-outbound_calls_per_second">
	<BR>
	<B>Max FILL Calls per Second -</B> This setting determines the maximum number of calls that can be placed by the auto-FILL outbound auto-dialing script on for all servers, per second. Must be from 1 to 200. Default is 40.

	<BR>
	<A NAME="settings-allow_custom_dialplan">
	<BR>
	<B>Allow Custom Dialplan Entries -</B> This option allows you to enter custom dialplan lines into IVRs. Default is 0 for inactive.

	<BR>
	<A NAME="settings-user_territories_active">
	<BR>
	<B>User Territories Active -</B> This setting allows you to enable the User Territories setttings from the user modification screen. This feature was added to allow for more integration with a customized CRM installation but can have applications in a pure CCMS system as well. Default is 0 for disabled.

	<BR>
	<A NAME="settings-enable_second_webform">
	<BR>
	<B>Enable Second Webform -</B> This setting allows you to have a second web form for campaigns and in-groups in the agent interface. Default is 0 for disabled.

	<BR>
	<A NAME="settings-enable_tts_integration">
	<BR>
	<B>Enable TTS Integration -</B> This setting allows you to enable Text To Speech integration with Cepstral. This is currently only available for outbound Survey type campaigns. Default is 0 for disabled.

	<BR>
	<A NAME="settings-qc_features_active">
	<BR>
	<B>QC Features Active -</B> This option allows you to enable or disable the QC or Quality Control features. Default is 0 for inactive.

	<BR>
	<A NAME="settings-enable_queuemetrics_logging">
	<BR>
	<B>Enable QueueMetrics Logging -</B> This setting allows you to define whether CCMS will insert log entries into the queue_log database table as Asterisk Queues activity does. QueueMetrics is a standalone, closed-source statistical analysis program. You must have QueueMetrics already installed and configured before enabling this feature. Default is 0.

	<BR>
	<A NAME="settings-queuemetrics_server_ip">
	<BR>
	<B>QueueMetrics Server IP -</B> This is the IP address of the database for your QueueMetrics installation.

	<BR>
	<A NAME="settings-queuemetrics_dbname">
	<BR>
	<B>QueueMetrics Database Name -</B> This is the database name for your QueueMetrics database.

	<BR>
	<A NAME="settings-queuemetrics_login">
	<BR>
	<B>QueueMetrics Database Login -</B> This is the user name used to log in to your QueueMetrics database.

	<BR>
	<A NAME="settings-queuemetrics_pass">
	<BR>
	<B>QueueMetrics Database Password -</B> This is the password used to log in to your QueueMetrics database.

	<BR>
	<A NAME="settings-queuemetrics_url">
	<BR>
	<B>QueueMetrics URL -</B> This is the URL or web site address used to get to your QueueMetrics installation.

	<BR>
	<A NAME="settings-queuemetrics_log_id">
	<BR>
	<B>QueueMetrics Log ID -</B> This is the server ID that all CCMS logs going into the QueueMetrics database will use as an identifier for each record.

	<BR>
	<A NAME="settings-queuemetrics_eq_prepend">
	<BR>
	<B>QueueMetrics EnterQueue Prepend -</B> This field is used to allow for prepending of one of the vicidial_list data fields in front of the phone number of the customer for customized QueueMetrics reports. Default is NONE to not populate anything.

	<BR>
	<A NAME="settings-enable_vtiger_integration">
	<BR>
	<B>Enable CRM Integration -</B> This setting allows you to enable CRM integration with CCMS. Currently links to CRM admin and search as well as user replication are the only integration features available. Default is 0.

	<BR>
	<A NAME="settings-vtiger_server_ip">
	<BR>
	<B>CRM DB Server IP -</B> This is the IP address of the database for your CRM installation.

	<BR>
	<A NAME="settings-vtiger_dbname">
	<BR>
	<B>CRM Database Name -</B> This is the database name for your CRM database.

	<BR>
	<A NAME="settings-vtiger_login">
	<BR>
	<B>CRM Database Login -</B> This is the user name used to log in to your CRM database.

	<BR>
	<A NAME="settings-vtiger_pass">
	<BR>
	<B>CRM Database Password -</B> This is the password used to log in to your CRM database.

	<BR>
	<A NAME="settings-vtiger_url">
	<BR>
	<B>CRM URL -</B> This is the URL or web site address used to get to your CRM installation.


	<BR><BR><BR><BR>

	<B><FONT SIZE=3>VICIDIAL_STATUSES TABLE</FONT></B><BR><BR>
	<A NAME="vicidial_statuses">
	<BR>
	<B>Through the use of system Call Result, you can have Call Result that exist for campaign and in-group. The Status must be 1-6 characters in length, the description must be 2-30 characters in length and Selectable defines whether it shows up in CCMS as an agent disposition. The human_answered field is used when calculating the drop percentage, or abandon rate. Setting human_answered to Y will use this status when counting the human-answered calls. The Category option allows you to group several Call Result into a catogy that can be used for statistical analysis. There are also 5 additional settings that will define the kind of status: sale, dnc, customer contact, not interested, unworkable.</B>



	<BR><BR><BR><BR>

	<B><FONT SIZE=3>VICIDIAL_STATUS_CATEGORIES TABLE</FONT></B><BR><BR>
	<A NAME="vicidial_status_categories">
	<BR>
	<B>Through the use of system status categories, you can group together Call Result to allow for statistical analysis on a group of Call Result. The Category ID must be 2-20 characters in length with no spaces, the name must be 2-50 characters in length, the description is optional and TimeonVDAD Display defines whether that status will be one of the upto 4 Call Result that can be calculated and displayed on the Time On VDAD Real-Time report.</B> The Sale Category and Dead Lead Category are both used by the List Suggestion system when analyzing list statistics.


	<?php
	if ($SSqc_features_active > 0)
		{
		?>
		<BR><BR><BR><BR>

		<B><FONT SIZE=3>CCMS QC STATUS CODES</FONT></B><BR><BR>
		<A NAME="vicidial_qc_status_codes">
		<BR>
		<B>The Quality Control-QC system within CCMS has its own set of status codes separate from those within the call handling functions of CCMS. QC statuse codes must be between 2 and 8 characters in length and contain no special characters like a space or colon. The QC status code description must be between 2 and 30 characters in length.</B>
		<?php
		}
	?>



	<BR><BR><BR><BR><BR><BR><BR><BR>
	<BR><BR><BR><BR><BR><BR><BR><BR>
	THE END
	</TD></TR></TABLE></BODY></HTML>
	<?php
	exit;

	#### END HELP SCREENS
	}

?>
