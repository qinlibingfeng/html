<?php 
require("dbconnect.php");
require("agc_head.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xHTML1/DTD/xHTML1-transitional.dtd">
<HTML xmlns="http://www.w3.org/1999/xHTML">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $system_info ?></title>
<link href="style.css?v=<?php echo $random ?>" rel="stylesheet" />
<script type="text/javascript" src="/js/splitter.js?v=<?php echo $random ?>"></script>
<script>
jQuery.ajaxSetup({ 
	type: "post", 
	dataType: "html", 
	cache:false,complete:function(xhr,ts){xhr=null}
});
   
var MTvar;
var NOW_TIME = '<?php echo $NOW_TIME ?>';
var SQLdate = '<?php echo $NOW_TIME ?>';
var StarTtimE = '<?php echo $StarTtimE ?>';
var UnixTime = '<?php echo $StarTtimE ?>';
var UnixTimeMS = 0;
var t = new Date();
var c = new Date();
LCAe = new Array('','','','','','');
LCAc = new Array('','','','','','');
LCAt = new Array('','','','','','');
LMAe = new Array('','','','','','');
var CalL_XC_a_Dtmf = '<?php echo $xferconf_a_dtmf ?>';
var CalL_XC_a_NuMber = '<?php echo $xferconf_a_number ?>';
var CalL_XC_b_Dtmf = '<?php echo $xferconf_b_dtmf ?>';
var CalL_XC_b_NuMber = '<?php echo $xferconf_b_number ?>';
var CalL_XC_c_NuMber = '<?php echo $xferconf_c_number ?>';
var CalL_XC_d_NuMber = '<?php echo $xferconf_d_number ?>';
var CalL_XC_e_NuMber = '<?php echo $xferconf_e_number ?>';
var VU_hotkeys_active = '<?php echo $VU_hotkeys_active ?>';
var VU_agent_choose_ingroups = '<?php echo $VU_agent_choose_ingroups ?>';
var VU_agent_choose_ingroups_DV = '';
var agent_choose_territories = '<?php echo $VU_agent_choose_territories ?>';
var agent_select_territories = '<?php echo $agent_select_territories ?>';
var VU_closer_campaigns = '<?php echo $VU_closer_campaigns ?>';
var CallBackDatETimE = '';
var CallBackrecipient = '';
var CallBackCommenTs = '';
var scheduled_callbacks = '<?php echo $scheduled_callbacks ?>';
var dispo_check_all_pause = '<?php echo $dispo_check_all_pause ?>';
var api_check_all_pause = '<?php echo $api_check_all_pause ?>';
VARgroup_alias_ids = new Array(<?php echo $VARgroup_alias_ids ?>);
VARgroup_alias_names = new Array(<?php echo $VARgroup_alias_names ?>);
VARcaller_id_numbers = new Array(<?php echo $VARcaller_id_numbers ?>);
var VD_group_aliases_ct = '<?php echo $VD_group_aliases_ct ?>';
var agent_allow_group_alias = '<?php echo $agent_allow_group_alias ?>';
var default_group_alias = '<?php echo $default_group_alias ?>';
var default_group_alias_cid = '<?php echo $default_group_alias_cid ?>';
var active_group_alias = '';
var agent_pause_codes_active = '<?php echo $agent_pause_codes_active ?>';
VARpause_codes = new Array(<?php echo $VARpause_codes ?>);
VARpause_code_names = new Array(<?php echo $VARpause_code_names ?>);
var VD_pause_codes_ct = '<?php echo $VD_pause_codes_ct ?>';
VARstatuses = new Array(<?php echo $VARstatuses ?>);
VARstatusnames = new Array(<?php echo $VARstatusnames ?>);
var VD_statuses_ct = '<?php echo $VD_statuses_ct ?>';
VARingroups = new Array(<?php echo $VARingroups ?>);
var INgroupCOUNT = '<?php echo $INgrpCT ?>';
VARterritories = new Array(<?php echo $VARterritories ?>);
var territoryCOUNT = '<?php echo $territoryCT ?>';
VARxfergroups = new Array(<?php echo $VARxfergroups ?>);
VARxfergroupsnames = new Array(<?php echo $VARxfergroupsnames ?>);
var XFgroupCOUNT = '<?php echo $XFgrpCT ?>';
var default_xfer_group = '<?php echo $default_xfer_group ?>';
var default_xfer_group_name = '<?php echo $default_xfer_group_name ?>';
var LIVE_default_xfer_group = '<?php echo $default_xfer_group ?>';
var HK_statuses_camp = '<?php echo $HK_statuses_camp ?>';
HKhotkeys = new Array(<?php echo $HKhotkeys ?>);
HKstatuses = new Array(<?php echo $HKstatuses ?>);
HKstatusnames = new Array(<?php echo $HKstatusnames ?>);
var hotkeys = new Array();
<?php 
$h=0;
while ($HK_statuses_camp > $h){
	echo "hotkeys['$HKhotkey[$h]'] = \"$HKstatus[$h] ----- $HKstatus_name[$h]\";\n";
	$h++;
}
?>
var HKdispo_display = 0;
var HKbutton_allowed = 1;
var HKfinish = 0;
var scriptnames = new Array();
<?php $h=0;
while ($MM_scripts > $h){
	echo "scriptnames['$MMscriptid[$h]'] = \"$MMscriptname[$h]\";\n";
	$h++;
}
?>
var decoded = '';
var view_scripts = '<?php echo $view_scripts ?>';
var LOGfullname = '<?php echo $LOGfullname ?>';
var recLIST = '';
var filename = '';
var last_filename = '';
var LCAcount = 0;
var LMAcount = 0;
var filedate = '<?php echo $FILE_TIME ?>';
var agcDIR = '<?php echo $agcDIR ?>';
var agcPAGE = '<?php echo $agcPAGE ?>';
var extension = '<?php echo $extension ?>';
var extension_xfer = '<?php echo $extension ?>';
var dialplan_number = '<?php echo $dialplan_number ?>';
var ext_context = '<?php echo $ext_context ?>';
var protocol = '<?php echo $protocol ?>';
var agentchannel = '';
var local_gmt ='<?php echo $local_gmt ?>';
var server_ip = '<?php echo $server_ip ?>';
var server_ip_dialstring = '<?php echo $server_ip_dialstring ?>';
var asterisk_version = '<?php echo $asterisk_version ?>';
<?php
if ($enable_fast_refresh < 1) {
	echo "\tvar refresh_interval = 1000;\n";
}else {
	echo "\tvar refresh_interval = $fast_refresh_rate;\n";
}
?>
var session_id = '<?php echo $session_id ?>';
var VICIDiaL_closer_login_checked = 0;
var VICIDiaL_closer_login_selected = 0;
var VICIDiaL_pause_calling = 1;
var CalLCID = '';
var MDnextCID = '';
var XDnextCID = '';
var LasTCID = '';
var lead_dial_number = '';
var MD_channel_look = 0;
var XD_channel_look = 0;
var MDuniqueid = '';
var MDchannel = '';
var MD_ring_secondS = 0;
var MDlogEPOCH = 0;
var VD_live_customer_call = 0;
var VD_live_call_secondS = 0;
var XD_live_customer_call = 0;
var XD_live_call_secondS = 0;
var open_dispo_screen = 0;
var AgentDispoing = 0;
var logout_stop_timeouts = 0;
var VICIDiaL_allow_closers = '<?php echo $VICIDiaL_allow_closers ?>';
var VICIDiaL_closer_blended = '0';
var VU_closer_default_blended = '<?php echo $VU_closer_default_blended ?>';
var VDstop_rec_after_each_call = '<?php echo $VDstop_rec_after_each_call ?>';
var phone_login = '<?php echo $phone_login ?>';
var original_phone_login = '<?php echo $original_phone_login ?>';
var phone_pass = '<?php echo $phone_pass ?>';
var user = '<?php echo $VD_login ?>';
var user_abb = '<?php echo $user_abb ?>';
var pass = '<?php echo $VD_pass ?>';
var campaign = '<?php echo $VD_campaign ?>';
var group = '<?php echo $VD_campaign ?>';
var VICIDiaL_web_form_address_enc = '<?php echo $VICIDiaL_web_form_address_enc ?>';
var VICIDiaL_web_form_address = '<?php echo $VICIDiaL_web_form_address ?>';
var VDIC_web_form_address = '<?php echo $VICIDiaL_web_form_address ?>';
var VICIDiaL_web_form_address_two_enc = '<?php echo $VICIDiaL_web_form_address_two_enc ?>';
var VICIDiaL_web_form_address_two = '<?php echo $VICIDiaL_web_form_address_two ?>';
var VDIC_web_form_address_two = '<?php echo $VICIDiaL_web_form_address_two ?>';
var CalL_ScripT_id="";
var CalL_AutO_LauncH="";
var panel_bgcolor = '<?php echo $MAIN_COLOR ?>';
var CusTCB_bgcolor = '#FFFF66';
var auto_dial_level = '<?php echo $auto_dial_level ?>';
var starting_dial_level = '<?php echo $auto_dial_level ?>';
var dial_timeout = '<?php echo $dial_timeout ?>';
var dial_prefix = '<?php echo $dial_prefix ?>';
var three_way_dial_prefix = '<?php echo $three_way_dial_prefix ?>';
var campaign_cid = '<?php echo $campaign_cid ?>';
var campaign_vdad_exten = '<?php echo $campaign_vdad_exten ?>';
var campaign_leads_to_call = '<?php echo $campaign_leads_to_call ?>';
var epoch_sec = <?php echo $StarTtimE ?>;
var dtmf_send_extension = '<?php echo $dtmf_send_extension ?>';
var recording_exten = '<?php echo $campaign_rec_exten ?>';
var campaign_recording = '<?php echo $campaign_recording ?>';
var campaign_rec_filename = '<?php echo $campaign_rec_filename ?>';
var LIVE_campaign_recording = '<?php echo $campaign_recording ?>';
var LIVE_campaign_rec_filename = '<?php echo $campaign_rec_filename ?>';
var LIVE_default_group_alias = '<?php echo $default_group_alias ?>';
var LIVE_caller_id_number = '<?php echo $default_group_alias_cid ?>';
var LIVE_web_vars = '<?php echo $default_web_vars ?>';
var default_web_vars = '<?php echo $default_web_vars ?>';
var campaign_script = '<?php echo $campaign_script ?>';
var get_call_launch = '<?php echo $get_call_launch ?>';
var campaign_am_message_exten = '<?php echo $campaign_am_message_exten ?>';
var park_on_extension = '<?php echo $VICIDiaL_park_on_extension ?>';
var park_count=0;
var customerparked=0;
var check_n = 0;
var conf_check_recheck = 0;
var lastconf='';
var lastcustchannel='';
var lastcustserverip='';
var lastxferchannel='';
var custchannellive=0;
var xferchannellive=0;
var nochannelinsession=0;
var agc_dial_prefix = '91';
var dtmf_silent_prefix = '<?php echo $dtmf_silent_prefix ?>';
var conf_silent_prefix = '<?php echo $conf_silent_prefix ?>';
var menuheight = 30;
var menuwidth = 30;
var menufontsize = 8;
var textareafontsize = 10;
var check_s;
var active_display = 1;
var conf_channels_xtra_display = 0;
var display_message = '';
var web_form_vars = '';
var Nactiveext;
var Nbusytrunk;
var Nbusyext;
var extvalue = extension;
var activeext_query;
var busytrunk_query;
var busyext_query;
var busytrunkhangup_query;
var busylocalhangup_query;
var activeext_order='asc';
var busytrunk_order='asc';
var busyext_order='asc';
var busytrunkhangup_order='asc';
var busylocalhangup_order='asc';
var xmlhttp=false;
var XfeR_channel = '';
var XDcheck = '';
var agent_log_id = '<?php echo $agent_log_id ?>';
var session_name = '<?php echo $session_name ?>';
var AutoDialReady = 0;
var AutoDialWaiting = 0;
var fronter = '';
var VDCL_group_id = '';
var previous_dispo = '';
var previous_called_count = '';
var hot_keys_active = 0;
var all_record = 'NO';
var all_record_count = 0;
var LeaDDispO = '';
var LeaDPreVDispO = '';
var AgaiNHanguPChanneL = '';
var AgaiNHanguPServeR = '';
var AgainCalLSecondS = '';
var AgaiNCalLCID = '';
var CB_count_check = 60;
var callholdstatus = '<?php echo $callholdstatus ?>'
var agentcallsstatus = '<?php echo $agentcallsstatus ?>'
var campagentstatctmax = '<?php echo $campagentstatctmax ?>'
var campagentstatct = '0';
var manual_dial_in_progress = 0;
var auto_dial_alt_dial = 0;
var reselect_preview_dial = 0;
var reselect_alt_dial = 0;
var alt_dial_active = 0;
var alt_dial_status_display = 0;
var mdnLisT_id = '<?php echo $manual_dial_list_id ?>';
var VU_vicidial_transfers = '<?php echo $VU_vicidial_transfers ?>';
var agentonly_callbacks = '<?php echo $agentonly_callbacks ?>';
var agentcall_manual = '<?php echo $agentcall_manual ?>';
var manual_dial_preview = '<?php echo $manual_dial_preview ?>';
var starting_alt_phone_dialing = '<?php echo $alt_phone_dialing ?>';
var alt_phone_dialing = '<?php echo $alt_phone_dialing ?>';
var DefaulTAlTDiaL = '<?php echo $DefaulTAlTDiaL ?>';
var wrapup_seconds = '<?php echo $wrapup_seconds ?>';
var wrapup_message = '<?php echo $wrapup_message ?>';
var wrapup_counter = 0;
var wrapup_waiting = 0;
var use_internal_dnc = '<?php echo $use_internal_dnc ?>';
var use_campaign_dnc = '<?php echo $use_campaign_dnc ?>';
var three_way_call_cid = '<?php echo $three_way_call_cid ?>';
var outbound_cid = '<?php echo $outbound_cid ?>';
var threeway_cid = '';
var cid_choice = '';
var prefix_choice = '';
var agent_dialed_number='';
var agent_dialed_type='';
var allcalls_delay = '<?php echo $allcalls_delay ?>';
var omit_phone_code = '<?php echo $omit_phone_code ?>';
var no_delete_sessions = '<?php echo $no_delete_sessions ?>';
var webform_session = '<?php echo $webform_sessionname ?>';
var local_consult_xfers = '<?php echo $local_consult_xfers ?>';
var vicidial_agent_disable = '<?php echo $vicidial_agent_disable ?>';
var CBentry_time = '';
var CBcallback_time = '';
var CBuser = '';
var CBcomments = '';
var volumecontrol_active = '<?php echo $volumecontrol_active ?>';
var PauseCode_HTML = '';
var manual_auto_hotkey = 0;
var dialed_number = '';
var dialed_label = '';
var source_id = '';
var DispO3waychannel = '';
var DispO3wayXtrAchannel = '';
var DispO3wayCalLserverip = '';
var DispO3wayCalLxfernumber = '';
var DispO3wayCalLcamptail = '';
var PausENotifYCounTer = 0;
var RedirecTxFEr = 0;
var phone_ip = '<?php echo $phone_ip ?>';
var enable_sipsak_messages = '<?php echo $enable_sipsak_messages ?>';
var allow_sipsak_messages = '<?php echo $allow_sipsak_messages ?>';
var HidEMonitoRSessionS = '<?php echo $HidEMonitoRSessionS ?>';
var LogouTKicKAlL = '<?php echo $LogouTKicKAlL ?>';
var flag_channels = '<?php echo $flag_channels ?>';
var flag_string = '<?php echo $flag_string ?>';
var vdc_header_date_format = '<?php echo $vdc_header_date_format ?>';
var vdc_customer_date_format = '<?php echo $vdc_customer_date_format ?>';
var vdc_header_phone_format = '<?php echo $vdc_header_phone_format ?>';
var disable_alter_custphone = '<?php echo $disable_alter_custphone ?>';
var manual_dial_filter = '<?php echo $manual_dial_filter ?>';
var CopY_tO_ClipboarD = '<?php echo $CopY_tO_ClipboarD ?>';
var inOUT = 'OUT';
var useIE = '<?php echo $useIE ?>';
var random = '<?php echo $random ?>';
var threeway_end = 0;
var agentphonelive = 0;
var conf_dialed = 0;
var leaving_threeway = 0;
var blind_transfer = 0;
var hangup_all_non_reserved = '<?php echo $hangup_all_non_reserved ?>';
var dial_method = '<?php echo $dial_method ?>';
var web_form_target = '<?php echo $web_form_target ?>';
var TEMP_VDIC_web_form_address = '';
var TEMP_VDIC_web_form_address_two = '';
var APIPausE_ID = '99999';
var APIDiaL_ID = '99999';
var CheckDEADcall = 0;
var CheckDEADcallON = 0;
var VtigeRLogiNScripT = '<?php echo $vtiger_screen_login ?>';
var VtigeRurl = '<?php echo $vtiger_url ?>';
var VtigeREnableD = '<?php echo $enable_vtiger_integration ?>';
var alert_enabled = '<?php echo $VU_alert_enabled ?>';
var allow_alerts = '<?php echo $VU_allow_alerts ?>';
var shift_logout_flag = 0;
var vtiger_callback_id = 0;
var agent_status_view = '<?php echo $agent_status_view ?>';
var agent_status_view_time = '<?php echo $agent_status_view_time ?>';
var agent_status_view_active = 0;
var xfer_select_agents_active = 0;
var even=0;
var VU_user_group = '<?php echo $VU_user_group ?>';
var quick_transfer_button = '<?php echo $quick_transfer_button ?>';
var quick_transfer_button_enabled = '<?php echo $quick_transfer_button_enabled ?>';
var prepopulate_transfer_preset = '<?php echo $prepopulate_transfer_preset ?>';
var prepopulate_transfer_preset_enabled = '<?php echo $prepopulate_transfer_preset_enabled ?>';
var view_calls_in_queue = '<?php echo $view_calls_in_queue ?>';
var view_calls_in_queue_launch = '<?php echo $view_calls_in_queue_launch ?>';
var view_calls_in_queue_active = '<?php echo $view_calls_in_queue_launch ?>';
var call_requeue_button = '<?php echo $call_requeue_button ?>';
var no_hopper_dialing = '<?php echo $no_hopper_dialing ?>';
var agent_dial_owner_only = '<?php echo $agent_dial_owner_only ?>';
var agent_display_dialable_leads = '<?php echo $agent_display_dialable_leads ?>';
var no_empty_session_warnings = '<?php echo $no_empty_session_warnings ?>';
var script_width = '<?php echo $SDwidth ?>';
var script_height = '<?php echo $SSheight ?>';
var enable_second_webform = '<?php echo $enable_second_webform ?>';
var no_delete_VDAC=0;
var manager_ingroups_set=0;
var external_igb_set_name='';
var recording_filename='';
var recording_id='';
var delayed_script_load='';
var script_recording_delay='';
var VDRP_stage='PAUSED';
var VU_custom_one = '<?php echo $VU_custom_one ?>';
var VU_custom_two = '<?php echo $VU_custom_two ?>';
var VU_custom_three = '<?php echo $VU_custom_three ?>';
var VU_custom_four = '<?php echo $VU_custom_four ?>';
var VU_custom_five = '<?php echo $VU_custom_five ?>';
var crm_popup_login = '<?php echo $crm_popup_login ?>';
var crm_login_address = '<?php echo $crm_login_address ?>';
var update_fields=0;
var update_fields_data='';
var campaign_timer_action = '<?php echo $timer_action ?>';
var campaign_timer_action_message = '<?php echo $timer_action_message ?>';
var campaign_timer_action_seconds = '<?php echo $timer_action_seconds ?>';
var timer_action='';
var timer_action_message='';
var timer_action_seconds='';
var pause_code_counter=1;
var last_uniqueid='';
var tmp_vicidial_id='';
var EAphone_code='';
var EAphone_number='';
var EAalt_phone_notes='';
var EAalt_phone_active='';
var EAalt_phone_count='';
var DiaLControl_auto_HTML = "<img src=\"./images/vdc_LB_pause_OFF.gif\" alt=\" 暂停 \"><a href=\"javascript:void(0);\" onclick=\"AutoDial_ReSume_PauSe('VDADready');\"><img src=\"./images/vdc_LB_resume.gif\" alt=\"恢复\"></a>";
var DiaLControl_auto_HTML_ready = "<a href=\"javascript:void(0);\" onclick=\"AutoDial_ReSume_PauSe('VDADpause');\"><img src=\"./images/vdc_LB_pause.gif\" alt=\" 暂停 \"></a><img src=\"./images/vdc_LB_resume_OFF.gif\" alt=\"恢复\">";
var DiaLControl_auto_HTML_OFF = "<img src=\"./images/vdc_LB_pause_OFF.gif\" alt=\" 暂停 \"><img src=\"./images/vdc_LB_resume_OFF.gif\" alt=\"恢复\">";
var DiaLControl_manual_HTML = "<a href=\"javascript:void(0);\" onclick=\"ManualDialNext('','','','','','0');\"><img src=\"./images/vdc_LB_dialnextnumber.gif\" alt=\"拨打下通电话\"></a>";
var UID_test=""; 
var NoneIn_ShowPauseCodeSelect=0;
var is_manual_dialed="N";
var record_file_name="";
var hangup_stop_rec="<?php echo $hangup_stop_rec ?>";  
var display_dtmf_alter="<?php echo $display_dtmf_alter ?>";  
var agent_out_time_check="<?php echo $agent_out_time_check ?>"; 

// ################################################################################
// Send Hangup command for Live call connected to phone now to Manager
function livehangup_send_hangup(taskvar) {
    
 	var queryCID = "HLagcW" + epoch_sec + user_abb;
	var hangupvalue = taskvar;
	livehangup_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ACTION=Hangup&format=text&channel=" + hangupvalue + "&queryCID=" + queryCID;
 	
	$.ajax({
 		url: "manager_send.php",
		data:livehangup_query,
  		success: function(){}
	});
	//conf_send_recording('StopMonitorConf',session_id,record_file_name);
};

// ################################################################################
// Send volume control command for meetme participant
function volume_control(taskdirection, taskvolchannel, taskagentmute) {
    if (taskagentmute == 'AgenT') {
        taskvolchannel = agentchannel
    }
 
	var queryCID = "VCagcW" + epoch_sec + user_abb;
	var volchanvalue = taskvolchannel;
	livevolume_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ACTION=VolumeControl&format=text&channel=" + volchanvalue + "&stage=" + taskdirection + "&exten=" + session_id + "&ext_context=" + ext_context + "&queryCID=" + queryCID;
	 
	$.ajax({
 		url: "manager_send.php",
		data:livevolume_query,
  		success: function(htmls){ 
 			Nactiveext = null;
			Nactiveext = htmls;
 		}
	});
	
    if (taskagentmute == 'AgenT') {
        if (taskdirection == 'MUTING') {
            $("#AgentMuteSpan").html("<a href=\"#CHAN-" + agentchannel + "\" onclick=\"volume_control('UNMUTE','" + agentchannel + "','AgenT');\"><img src=\"./images/vdc_volume_UNMUTE.gif\" BORDER=0></a>");
        } else {
            $("#AgentMuteSpan").html("<a href=\"#CHAN-" + agentchannel + "\" onclick=\"volume_control('MUTING','" + agentchannel + "','AgenT');\"><img src=\"./images/vdc_volume_MUTE.gif\" BORDER=0></a>");
        }
    }
};

// ################################################################################
// Send alert control command for agent
function alert_control(taskalert) {
    
	alert_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ACTION=AlertControl&format=text&stage=" + taskalert;
 	
	$.ajax({
 		url: "vdc_db_query.php",
		data:alert_query,
  		success: function(htmls){ 
 			Nactiveext = null;
			Nactiveext = htmls;
 		}
	});
	
    if (taskalert == 'ON') {
        alert_enabled = 'ON';
        $("#AgentAlertSpan").html("<a href=\"javascript:void(0);\" onclick=\"alert_control('OFF');\">进线提示已启用</a>");
    } else {
        alert_enabled = 'OFF';
        $("#AgentAlertSpan").html("<a href=\"javascript:void(0);\" onclick=\"alert_control('ON');\">进线提示已关闭</a>");
    }
	
	
};

// ################################################################################
// park customer and place 3way call
function xfer_park_dial() {
    conf_dialed = 1;
    mainxfer_send_redirect('ParK', lastcustchannel, lastcustserverip);
    SendManualDial('YES')
};
// ################################################################################
// place 3way and customer into other conference and fake-hangup the lines
function leave_3way_call(tempvarattempt) {
    threeway_end = 0;
    leaving_threeway = 1;
    if (customerparked > 0) {
        mainxfer_send_redirect('FROMParK', lastcustchannel, lastcustserverip)
    }
    mainxfer_send_redirect('3WAY', '', '', tempvarattempt);
    
 	$("#call_status_list").removeClass("focus");
	$("#call_status_pos").html("未通话").removeClass("red");
	$("#SecondSDISP").html("00:00:00").removeClass("focus");
	 
	$("#VolumeUpSpan,#VolumeDownSpan,#call_status_hangup").removeClass("focus").off();
	
    conf_send_recording('StopMonitorConf',session_id,record_file_name);
};
// ################################################################################
// filter manual dialstring and pass on to originate call
function SendManualDial(taskFromConf) {
    conf_dialed = 1;
    var sending_group_alias = 0;
    if (taskFromConf == 'YES') {
        agent_dialed_number = '1';
        agent_dialed_type = 'XFER_3WAY';
		
        $("#DialWithCustomer").html("<img src=\"./images/vdc_XB_dialwithcustomer_OFF.gif\" alt=\"Dial With Customer\" style=\"vertical-align:middle\"></a>");
		
        $("#ParkCustomerDial").html("<img src=\"./images/vdc_XB_parkcustomerdial_OFF.gif\" alt=\"Park Customer Dial\" style=\"vertical-align:middle\"></a>");
		
        var manual_number = $("#xfernumber").val();
        var manual_string = manual_number.toString();
        var dial_conf_exten = session_id;
        threeway_cid = '';
        if (three_way_call_cid == 'CAMPAIGN') {
            threeway_cid = campaign_cid
        }
        if (three_way_call_cid == 'AGENT_PHONE') {
            threeway_cid = outbound_cid
        }
        if (three_way_call_cid == 'CUSTOMER') {
            threeway_cid = $("#phone_number").val()
        }
        if (three_way_call_cid == 'AGENT_CHOOSE') {
            threeway_cid = cid_choice;
            if (active_group_alias.length > 1) {
                var sending_group_alias = 1
            }
        }
    } else {
        var manual_number = $("#xfernumber").val();
        var manual_string = manual_number.toString()
    }
    var regXFvars = new RegExp("XFER", "g");
    if (manual_string.match(regXFvars)) {
        var donothing = 1
    } else {
        if ($("#xferoverride").is(":checked") == false) {
            if (three_way_dial_prefix == 'X') {
                var temp_dial_prefix = ''
            } else {
                var temp_dial_prefix = three_way_dial_prefix
            }
            if (omit_phone_code == 'Y') {
                var temp_phone_code = ''
            } else {
                var temp_phone_code = $("#phone_code").val()
            }
            if (manual_string.length > 7) {
                manual_string = temp_dial_prefix + "" + temp_phone_code + "" + manual_string
            }
        } else {
            agent_dialed_type = 'XFER_OVERRIDE'
        }
    }
    if (taskFromConf == 'YES') {
        basic_originate_call(manual_string, 'NO', 'YES', dial_conf_exten, 'NO', taskFromConf, threeway_cid, sending_group_alias)
    } else {
        basic_originate_call(manual_string, 'NO', 'NO', '', '', '', '1', sending_group_alias)
    }
    MD_ring_secondS = 0
};
// ################################################################################
// Send Originate command to manager to place a phone call
function basic_originate_call(tasknum, taskprefix, taskreverse, taskdialvalue, tasknowait, taskconfxfer, taskcid, taskusegroupalias) {  
    var usegroupalias = 0;
    var consultativexfer_checked = 0;
    if ($("#consultativexfer").is(":checked")== true) {
        consultativexfer_checked = 1
    }
    var regCXFvars = new RegExp("CXFER", "g");
    var tasknum_string = tasknum.toString();
    if ((tasknum_string.match(regCXFvars)) || (consultativexfer_checked > 0)) {
        if (tasknum_string.match(regCXFvars)) {
            var Ctasknum = tasknum_string.replace(regCXFvars, '');
            if (Ctasknum.length < 2) {
                Ctasknum = '990009'
            }
            var agentdirect = ''
        } else {
            Ctasknum = '990009';
            var agentdirect = tasknum_string
        }
         
        tasknum = Ctasknum + "*" + $("#XfeRGrouP").val() + '*CXFER*' + $("#lead_id").val() + '**' + dialed_number + '*' + user + '*' + agentdirect + '*' + VD_live_call_secondS + '*';
        CustomerData_update()
    }
    var regAXFvars = new RegExp("AXFER", "g");
    if (tasknum_string.match(regAXFvars)) {
        var Ctasknum = tasknum_string.replace(regAXFvars, '');
        if (Ctasknum.length < 2) {
            Ctasknum = '83009'
        }
        var closerxfercamptail = '_L';
        if (closerxfercamptail.length < 3) {
            closerxfercamptail = 'IVR'
        }
        tasknum = Ctasknum + '*' + $("#phone_number").val() + '*' + $("#lead_id").val() + '*' + campaign + '*' + closerxfercamptail + '*' + user + '**' + VD_live_call_secondS + '*';
        CustomerData_update()
    }
    
 
	if (taskprefix == 'NO') {
		var call_prefix = ''
	} else {
		var call_prefix = agc_dial_prefix
	}
	if (prefix_choice.length > 0) {
		var call_prefix = prefix_choice
	}
	if (taskreverse == 'YES') {
		if (taskdialvalue.length < 2) {
			var dialnum = dialplan_number
		} else {
			var dialnum = taskdialvalue
		}
		var call_prefix = '';
		var originatevalue = "Local/" + tasknum + "@" + ext_context
	} else {
		var dialnum = tasknum;
		if ((protocol == 'EXTERNAL') || (protocol == 'Local')) {
			var protodial = 'Local';
			var extendial = extension
		} else {
			var protodial = protocol;
			var extendial = extension
		}
		var originatevalue = protodial + "/" + extendial
	}
	if (taskconfxfer == 'YES') {
		var queryCID = "DCagcW" + epoch_sec + user_abb
	} else {
		var queryCID = "DVagcW" + epoch_sec + user_abb
	}
	if (cid_choice.length > 3) {
		var call_cid = cid_choice;
		usegroupalias = 1
	} else {
		if (taskcid.length > 3) {
			var call_cid = taskcid
		} else {
			var call_cid = campaign_cid
		}
	}
	
	VMCoriginate_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ACTION=Originate&format=text&channel=" + originatevalue + "&queryCID=" + queryCID + "&exten=" + call_prefix + "" + dialnum + "&ext_context=" + ext_context + "&ext_priority=1&outbound_cid=" + call_cid + "&usegroupalias=" + usegroupalias + "&account=" + active_group_alias + "&agent_dialed_number=" + agent_dialed_number + "&agent_dialed_type=" + agent_dialed_type;

	$.ajax({
		url: "manager_send.php",
		data:VMCoriginate_query,
		success: function(htmls){ 
			var regBOerr = new RegExp("ERROR", "g");
			var BOresponse = htmls;
			if (BOresponse.match(regBOerr)) {
				request_tip(BOresponse,0);
			}
			if ((taskdialvalue.length > 0) && (tasknowait != 'YES')) {
				XDnextCID = queryCID;
				MD_channel_look = 1;
				XDcheck = 'YES'
			}
		}
	});
	
	active_group_alias = '';
	cid_choice = '';
	prefix_choice = '';
	agent_dialed_number = '';
	agent_dialed_type = '';
	CalL_ScripT_id = ''
    
};
// ################################################################################
// filter conf_dtmf send string and pass on to originate call
function SendConfDTMF(taskconfdtmf) {
    var dtmf_number = $("#conf_dtmf").val();
    //var dtmf_string = dtmf_number.toString();
    var conf_dtmf_room = taskconfdtmf;
    
 	var queryCID = dtmf_number;
	VMCoriginate_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ACTION=SysCIDOriginate&format=text&channel=" + dtmf_send_extension + "&queryCID=" + queryCID + "&exten=" + dtmf_silent_prefix + conf_dtmf_room + "&ext_context=" + ext_context + "&ext_priority=1";
         
	$.ajax({
		url: "manager_send.php",
		data:VMCoriginate_query,
		success: function(){}
	});
 	
    //$("#conf_dtmf").val('');
};

// ################################################################################
// Check to see if there are any channels live in the agent's conference meetme room
function check_for_conf_calls(taskconfnum, taskforce) {
     
	custchannellive--;
	if ((agentcallsstatus == '1') || (callholdstatus == '1')) {
		campagentstatct++;
		if (campagentstatct > campagentstatctmax) {
			campagentstatct = 0;
			var campagentstdisp = 'YES'
		} else {
			var campagentstdisp = 'NO'
		}
	} else {
		var campagentstdisp = 'NO'
	}
  	
	checkconf_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&client=vdc&conf_exten=" + taskconfnum + "&auto_dial_level=" + auto_dial_level + "&campagentstdisp=" + campagentstdisp;
	 
	$.ajax({
 		url: "conf_exten_check.php",
		data:checkconf_query,
		success: function(htmls){
			
			var check_conf = null;
			var LMAforce = taskforce;
			check_conf = htmls;
			var check_ALL_array = check_conf.split("\n");
			var check_time_array = check_ALL_array[0].split("|");
			var Time_array = check_time_array[1].split("UnixTime: ");
			
			if(agent_out_time_check=="Y"){
				var out_time_array=check_time_array[0].split(" ")[2].split(":");
				 
				var out_time_check=parseInt(out_time_array[0]+""+out_time_array[1]);
				if((out_time_check>830 && out_time_check<1201)||(out_time_check>1320 && out_time_check<1720)){
					$("#LogouTBoxLink").attr("onclick","").css({"color":"#FF0","font-weight":""});
				}else{
					$("#LogouTBoxLink").attr("onclick","NormalLogout()").css({"color":"#FFF","font-weight":"bold"});
				}
			}
 			
			UnixTime = Time_array[1];
			UnixTime = parseInt(UnixTime);
			UnixTimeMS = (UnixTime * 1000);
			t.setTime(UnixTimeMS);
			if ((callholdstatus == '1') || (agentcallsstatus == '1') || (vicidial_agent_disable != 'NOT_ACTIVE')) {
				var Alogin_array = check_time_array[2].split("Logged-in: ");
				var AGLogiN = Alogin_array[1];
				var CamPCalLs_array = check_time_array[3].split("CampCalls: ");
				var CamPCalLs = CamPCalLs_array[1];
				var DiaLCalLs_array = check_time_array[5].split("DiaLCalls: ");
				var DiaLCalLs = DiaLCalLs_array[1];
				if (AGLogiN != 'N') {
					$("#AgentStatusStatus").show().html(AGLogiN)
				}
				if (CamPCalLs != 'N') {
					$("#AgentStatusCalls_li").removeClass("hide");
					$("#AgentStatusCalls").html(CamPCalLs);
				}
				if (DiaLCalLs != 'N') {
					$("#AgentStatusDiaLs").html(DiaLCalLs)
				}
				if ((AGLogiN == 'DEAD_VLA') && ((vicidial_agent_disable == 'LIVE_AGENT') || (vicidial_agent_disable == 'ALL'))) {
					showDiv('AgenTDisablEBoX')
				}
				if ((AGLogiN == 'DEAD_EXTERNAL') && ((vicidial_agent_disable == 'EXTERNAL') || (vicidial_agent_disable == 'ALL'))) {
					showDiv('AgenTDisablEBoX')
				}
				if ((AGLogiN == 'TIME_SYNC') && (vicidial_agent_disable == 'ALL')) {
					showDiv('SysteMDisablEBoX')
				}
				if (AGLogiN == 'SHIFT_LOGOUT') {
					shift_logout_flag = 1
				}
			}
			var VLAStatuS_array = check_time_array[4].split("Status: ");
			var VLAStatuS = VLAStatuS_array[1];
			if ((VLAStatuS == 'PAUSED') && (AutoDialWaiting == 1)) {
				if (PausENotifYCounTer > 10) {
					 
					request_tip("您的会话已被暂停",0,8000);
					AutoDial_ReSume_PauSe('VDADpause');
					PausENotifYCounTer = 0
				} else {
					PausENotifYCounTer++
				}
			} else {
				PausENotifYCounTer = 0
			}
			var APIHanguP_array = check_time_array[6].split("APIHanguP: ");
			var APIHanguP = APIHanguP_array[1];
			var APIStatuS_array = check_time_array[7].split("APIStatuS: ");
			var APIStatuS = APIStatuS_array[1];
			var APIPausE_array = check_time_array[8].split("APIPausE: ");
			var APIPausE = APIPausE_array[1];
			var APIDiaL_array = check_time_array[9].split("APIDiaL: ");
			var APIDiaL = APIDiaL_array[1];
			var CheckDEADcall_array = check_time_array[10].split("DEADcall: ");
			var CheckDEADcall = CheckDEADcall_array[1];
			var InGroupChange_array = check_time_array[11].split("InGroupChange: ");
			var InGroupChange = InGroupChange_array[1];
			var InGroupChangeBlend = check_time_array[12];
			var InGroupChangeUser = check_time_array[13];
			var InGroupChangeName = check_time_array[14];
			var APIFields_array = check_time_array[15].split("APIFields: ");
			update_fields = APIFields_array[1];
			var APIFieldsData_array = check_time_array[16].split("APIFieldsData: ");
			update_fields_data = APIFieldsData_array[1];
			var APITimerAction_array = check_time_array[17].split("APITimerAction: ");
			api_timer_action = APITimerAction_array[1];
			var APITimerMessage_array = check_time_array[18].split("APITimerMessage: ");
			api_timer_action_message = APITimerMessage_array[1];
			var APITimerSeconds_array = check_time_array[19].split("APITimerSeconds: ");
			api_timer_action_seconds = APITimerSeconds_array[1];
			if (api_timer_action.length > 2) {
				timer_action = api_timer_action;
				timer_action_message = api_timer_action_message;
				timer_action_seconds = api_timer_action_seconds
			}
			if ((APIHanguP == 1) && (VD_live_customer_call == 1)) {
				hideDiv('CustomerGoneBox');
				WaitingForNextStep = 0;
				custchannellive = 0;
				dialedcall_send_hangup()
			}
			if ((APIStatuS.length < 10) && (APIStatuS.length > 0) && (AgentDispoing > 0)) {
				$("#DispoSelection").val(APIStatuS);
				DispoSelect_submit();
			}
			if (APIPausE.length > 4) {
				var APIPausE_array = APIPausE.split("!");
				if (APIPausE_ID == APIPausE_array[1]) {} else {
					APIPausE_ID = APIPausE_array[1];
					if (APIPausE_array[0] == 'PAUSE') {
						if (VD_live_customer_call == 1) {
							$("#DispoSelectStop").attr("checked",true);
						} else {
							if (AutoDialReady == 1) {
								if (auto_dial_level != '0') {
									AutoDialWaiting = 0;
									AutoDial_ReSume_PauSe("VDADpause")
								}
								VICIDiaL_pause_calling = 1
							}
						}
					}
					if ((APIPausE_array[0] == 'RESUME') && (AutoDialReady < 1) && (auto_dial_level > 0)) {
						AutoDialWaiting = 1;
						AutoDial_ReSume_PauSe("VDADready")
					}
				}
			}
			if (APIDiaL.length > 9) {
				var APIDiaL_array_detail = APIDiaL.split("!");
				if (APIDiaL_ID == APIDiaL_array_detail[6]) {} else {
					APIDiaL_ID = APIDiaL_array_detail[6];
					$("#MDDiaLCodE").val(APIDiaL_array_detail[1]);
					$("#phone_code").val(APIDiaL_array_detail[1]);
					$("#MDPhonENumbeR").val(APIDiaL_array_detail[0]);
					$("#vendor_lead_code").val(APIDiaL_array_detail[5]);
					prefix_choice = APIDiaL_array_detail[7];
					active_group_alias = APIDiaL_array_detail[8];
					cid_choice = APIDiaL_array_detail[9];
					vtiger_callback_id = APIDiaL_array_detail[10];
					if (APIDiaL_array_detail[2] == 'YES') {
						$("#LeadLookuP").attr("checked",true)
					} else {
						$("#LeadLookuP").attr("checked",false)
					}
					if (APIDiaL_array_detail[4] == 'YES') {
						window.focus();
						alert("放置电话:" + APIDiaL_array_detail[1] + " " + APIDiaL_array_detail[0])
					}
					if (APIDiaL_array_detail[3] == 'YES') {
						NeWManuaLDiaLCalLSubmiT('PREVIEW')
					} else {
						NeWManuaLDiaLCalLSubmiT('NOW')
					}
				}
			}
			if ((CheckDEADcall > 0) && (VD_live_customer_call == 1)) {
				if (CheckDEADcallON < 1) {
					
					//$("#livecall").attr("src",image_livecall_DEAD.src);
							
					CheckDEADcallON = 1;
					
					if(dial_method== "INBOUND_MAN"||dial_method== "MANUAL"){
					}else{
						AutoDialWaiting = 0;
						//request_tip("挂机",0)
						AutoDial_ReSume_PauSe("VDADpause_dead");
 					}
 					
					$("#call_status_list").removeClass("focus");
					$("#call_status_pos").html("通话结束").addClass("red");
 					$("#VolumeUpSpan,#VolumeDownSpan,#call_status_hangup").removeClass("focus").off();
 					$("#btn_vdc_pause,#btn_vdc_resume").addClass("btn-disabled").off();
					$("#ParkControl").html("<img src=\"./images/vdc_LB_parkcall_OFF.gif\" alt=\"电话保持\">");
					$("#XferControl").html("<img src=\"./images/vdc_LB_transferconf_OFF.gif\" alt=\"会议 - 转接\">");
					
					if(hangup_stop_rec=="stop"){
						request_tip("录音已停止;N:"+record_file_name,1);
						conf_send_recording("StopMonitorConf",session_id,record_file_name);
						setTimeout("conf_send_recording('StopMonitorConf',session_id,record_file_name)",100);
						setTimeout("conf_send_recording('StopMonitorConf',session_id,record_file_name)",150);
					}
 				}
			}
			if (InGroupChange > 0) {
				var external_blended = InGroupChangeBlend;
				var external_igb_set_user = InGroupChangeUser;
				external_igb_set_name = InGroupChangeName;
				manager_ingroups_set = 1;
				if ((external_blended == '1') && (dial_method != 'INBOUND_MAN')) {
					VICIDiaL_closer_blended = '1'
				}
				if (external_blended == '0') {
					VICIDiaL_closer_blended = '0'
				}
			}
			var check_conf_array = check_ALL_array[1].split("|");
			var live_conf_calls = check_conf_array[0];
			var conf_chan_array = check_conf_array[1].split(" ~");
			if ((conf_channels_xtra_display == 1) || (conf_channels_xtra_display == 0)) {
				if (live_conf_calls > 0) {
					var loop_ct = 0;
					var ARY_ct = 0;
					var LMAalter = 0;
					var LMAcontent_change = 0;
					var LMAcontent_match = 0;
					agentphonelive = 0;
					var conv_start = -1;
					var live_conf_HTML = "<strong>会议中的电话:</strong><BR><TABLE WIDTH=<?php echo $CQwidth ?>><TR BGCOLOR=<?php echo $SCRIPT_COLOR ?>><TD>#</TD><TD>远程通道</TD><TD>挂机</TD><TD>音量</TD></TR>";
					if ((LMAcount > live_conf_calls) || (LMAcount < live_conf_calls) || (LMAforce > 0)) {
						LMAe[0] = '';
						LMAe[1] = '';
						LMAe[2] = '';
						LMAe[3] = '';
						LMAe[4] = '';
						LMAe[5] = '';
						LMAcount = 0;
						LMAcontent_change++
					}
					while (loop_ct < live_conf_calls) {
						loop_ct++;
						loop_s = loop_ct.toString();
						if (loop_s.match(/1$|3$|5$|7$|9$/)) {
							var row_color = '#DDDDFF'
						} else {
							var row_color = '#CCCCFF'
						}
						var conv_ct = (loop_ct + conv_start);
						var channelfieldA = conf_chan_array[conv_ct];
						var regXFcred = new RegExp(flag_string, "g");
						var regRNnolink = new RegExp('Local/5' + taskconfnum, "g");
						if ((channelfieldA.match(regXFcred)) && (flag_channels > 0)) {
							var chan_name_color = 'log_text_red'
						} else {
							var chan_name_color = 'log_text'
						}
						if ((HidEMonitoRSessionS == 1) && (channelfieldA.match(/ASTblind/))) {
							var hide_channel = 1
						} else {
							if (channelfieldA.match(regRNnolink)) {
								live_conf_HTML = live_conf_HTML + "<tr bgcolor=\"" + row_color + "\"><td>" + loop_ct + "</td><td><span class=\"" + chan_name_color + "\">" + channelfieldA + "</span></td><td>录音</td><td></td></tr>"
							} else {
								if (volumecontrol_active != 1) {
									live_conf_HTML = live_conf_HTML + "<tr bgcolor=\"" + row_color + "\"><td>" + loop_ct + "</td><td><span class=\"" + chan_name_color + "\">" + channelfieldA + "</span></td><td><a href=\"javascript:void(0);\" onclick=\"livehangup_send_hangup('" + channelfieldA + "');\">挂机</a></td><td></td></tr>"
								} else {
									live_conf_HTML = live_conf_HTML + "<tr bgcolor=\"" + row_color + "\"><td>" + loop_ct + "</td><td><span class=\"" + chan_name_color + "\">" + channelfieldA + "</span></td><td><a href=\"javascript:void(0);\" onclick=\"livehangup_send_hangup('" + channelfieldA + "');\">挂机</a></td><td><a href=\"javascript:void(0);\" onclick=\"volume_control('UP','" + channelfieldA + "','');\"><img src=\"./images/vdc_volume_up.gif\" BORDER=0></a> &nbsp; <a href=\"javascript:void(0);\" onclick=\"volume_control('DOWN','" + channelfieldA + "','');\"><img src=\"./images/vdc_volume_down.gif\" BORDER=0></a> &nbsp; &nbsp; &nbsp; <a href=\"javascript:void(0);\" onclick=\"volume_control('MUTING','" + channelfieldA + "','');\"><img src=\"./images/vdc_volume_MUTE.gif\" BORDER=0></a> &nbsp; <a href=\"javascript:void(0);\" onclick=\"volume_control('UNMUTE','" + channelfieldA + "','');\"><img src=\"./images/vdc_volume_UNMUTE.gif\" BORDER=0></a></td></tr>"
								}
							}
						}
						if (channelfieldA == lastcustchannel) {
							custchannellive++
						} else {
							if (customerparked == 1) {
								custchannellive++
							}
							if (server_ip == lastcustserverip) {
								var nothing = ''
							} else {
								custchannellive++
							}
						}
						if (volumecontrol_active > 0) {
							if ((protocol != 'EXTERNAL') && (protocol != 'Local')) {
								var regAGNTchan = new RegExp(protocol + '/' + extension, "g");
								if ((channelfieldA.match(regAGNTchan)) && (agentchannel != channelfieldA)) {
									agentchannel = channelfieldA;
									$("#AgentMuteSpan").html("<a href=\"#CHAN-" + agentchannel + "\" onclick=\"volume_control('MUTING','" + agentchannel + "','AgenT');\"><img src=\"./images/vdc_volume_MUTE.gif\" BORDER=0></a>")
								}
							} else {
								if (agentchannel.length < 3) {
									agentchannel = channelfieldA;
									$("#AgentMuteSpan").html("<a href=\"#CHAN-" + agentchannel + "\" onclick=\"volume_control('MUTING','" + agentchannel + "','AgenT');\"><img src=\"./images/vdc_volume_MUTE.gif\" BORDER=0></a>");
								}
							}
						}
						if (!LMAe[ARY_ct]) {
							LMAe[ARY_ct] = channelfieldA;
							LMAcontent_change++;
							LMAalter++
						} else {
							if (LMAe[ARY_ct].length < 1) {
								LMAe[ARY_ct] = channelfieldA;
								LMAcontent_change++;
								LMAalter++
							} else {
								if (LMAe[ARY_ct] == channelfieldA) {
									LMAcontent_match++
								} else {
									LMAcontent_change++;
									LMAe[ARY_ct] = channelfieldA
								}
							}
						}
						if (LMAalter > 0) {
							LMAcount++
						}
						if (agentchannel == channelfieldA) {
							agentphonelive++
						}
						ARY_ct++
					}
					if (agentphonelive < 1) {
						agentchannel = ''
					}
					live_conf_HTML = live_conf_HTML + "</table>";
					if (LMAcontent_change > 0) {
						if (conf_channels_xtra_display == 1) {
							$("#outboundcallsspan").html(live_conf_HTML)
						}
					}
					nochannelinsession = 0
				} else {
					LMAe[0] = '';
					LMAe[1] = '';
					LMAe[2] = '';
					LMAe[3] = '';
					LMAe[4] = '';
					LMAe[5] = '';
					LMAcount = 0;
					if (conf_channels_xtra_display == 1) {
						if ($("#outboundcallsspan").html().length > 2) {
							$("#outboundcallsspan").html('')
						}
					}
					custchannellive = -99;
					nochannelinsession++
				}
			}
 			
		},error:function(){
			$("#LogouTBoxLink").attr("onclick","NormalLogout()").css({"color":"#FFF","font-weight":"bold"}); 
		}
		
	});
     
};
// ################################################################################
// Send MonitorConf/StopMonitorConf command for recording of conferences
function conf_send_recording(taskconfrectype, taskconfrec, taskconffile) {
    if (inOUT == 'OUT') {
        tmp_vicidial_id = $("#uniqueid").val()
    } else {
        tmp_vicidial_id = 'IN'
    }
 	
	if (taskconfrectype == 'MonitorConf') {
		var REGrecCAMPAIGN = new RegExp("CAMPAIGN", "g");
		var REGrecCUSTPHONE = new RegExp("CUSTPHONE", "g");
		var REGrecFULLDATE = new RegExp("FULLDATE", "g");
		var REGrecTINYDATE = new RegExp("TINYDATE", "g");
		var REGrecEPOCH = new RegExp("EPOCH", "g");
		var REGrecAGENT = new RegExp("AGENT", "g");
		filename = LIVE_campaign_rec_filename;
		filename = filename.replace(REGrecCAMPAIGN, campaign);
		filename = filename.replace(REGrecCUSTPHONE, lead_dial_number);
		filename = filename.replace(REGrecFULLDATE, filedate);
		filename = filename.replace(REGrecTINYDATE, tinydate);
		filename = filename.replace(REGrecEPOCH, epoch_sec);
		filename = filename.replace(REGrecAGENT, user);
		record_file_name=filename;
		//request_tip(record_file_name,1);
		var query_recording_exten = recording_exten;
		var channelrec = "Local/" + conf_silent_prefix + taskconfrec + "@" + ext_context;
		
		
		if (LIVE_campaign_recording == 'ALLFORCE') {
			//$("#RecorDControl").html("<img src=\"./images/vdc_LB_startrecording_OFF2.gif\" alt=\"开始录音\">");
			$("#RecorDControl").html("<img src=\"./images/vdc_LB_startrecording2.gif\" alt=\"开始录音\">");
		} else {
			 
			$("#RecorDControl").html("<a href=\"javascript:void(0);\" onclick=\"conf_send_recording('StopMonitorConf','" + taskconfrec + "','" + filename + "');\"><img src=\"./images/vdc_LB_stoprecording2.gif\" alt=\"停止录音\"></a>");
		}
		 
	}
	if (taskconfrectype == 'StopMonitorConf') {
		$("#record_filename,record_id").val("");
		filename = taskconffile;
		var query_recording_exten = session_id;
		var channelrec = "Local/" + conf_silent_prefix + taskconfrec + "@" + ext_context;
		
 		if (LIVE_campaign_recording == 'ALLFORCE') {
			//$("#RecorDControl").html("<img src=\"./images/vdc_LB_startrecording_OFF2.gif\" alt=\"录音停止\">");
			$("#RecorDControl").html("<img src=\"./images/vdc_LB_stoprecording_OFF2.gif\" alt=\"录音停止\">");
		} else {
			 
			$("#RecorDControl").html("<a href=\"javascript:void(0);\" onclick=\"conf_send_recording('MonitorConf','" + taskconfrec + "','');\"><img src=\"./images/vdc_LB_startrecording2.gif\" alt=\"开始录音\"></a>");
		}
		
	}
 	
	confmonitor_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ACTION=" + taskconfrectype + "&format=text&channel=" + channelrec + "&filename=" + filename + "&exten=" + query_recording_exten + "&ext_context=" + ext_context + "&lead_id=" + $("#lead_id").val() + "&ext_priority=1&FROMvdc=YES&uniqueid=" + tmp_vicidial_id;
	
	$.ajax({
		url: "manager_send.php",
		data:confmonitor_query,
		success: function(htmls){ 
			 
			var RClookResponse = null;
			RClookResponse = htmls;
			var RClookResponse_array = RClookResponse.split("\n");
			var RClookFILE = RClookResponse_array[1];
			var RClookID = RClookResponse_array[2];
			var RClookFILE_array = RClookFILE.split("Filename: ");
			var RClookID_array = RClookID.split("RecorDing_ID: ");
			if (RClookID_array.length > 0) {
				recording_filename = RClookFILE_array[1];
				recording_id = RClookID_array[1];
 				var RecDispNamE = RClookFILE_array[1];
				
				$("#record_filename").val(RecDispNamE);
				$("#record_id").val(RClookID_array[1]);
				
				if (delayed_script_load == 'YES') {
					RefresHScript();
					delayed_script_load = 'NO'
				}
			}
		}
	});	
     
};
// ################################################################################
// Send Redirect command for live call to Manager sends phone name where call is going to
// Covers the following types: XFER, VMAIL, ENTRY, CONF, PARK, FROMPARK, XfeRLOCAL, XfeRINTERNAL, XfeRBLIND, VfeRVMAIL
function mainxfer_send_redirect(taskvar, taskxferconf, taskserverip, taskdebugnote, taskdispowindow) {
    blind_transfer = 1;
    var consultativexfer_checked = 0;
    if ($("#consultativexfer").is(":checked") == true) {
        consultativexfer_checked = 1
    }
    if (auto_dial_level == 0) {
        RedirecTxFEr = 1
    }
      
	var redirectvalue = MDchannel;
	var redirectserverip = lastcustserverip;
	if (redirectvalue.length < 2) {
		redirectvalue = lastcustchannel
	}
	if ((taskvar == 'XfeRBLIND') || (taskvar == 'XfeRVMAIL')) {
		var queryCID = "XBvdcW" + epoch_sec + user_abb;
		var blindxferdialstring = $("#xfernumber").val();
		var regXFvars = new RegExp("XFER", "g");
		if (blindxferdialstring.match(regXFvars)) {
			var regAXFvars = new RegExp("AXFER", "g");
			if (blindxferdialstring.match(regAXFvars)) {
				var Ctasknum = blindxferdialstring.replace(regAXFvars, '');
				if (Ctasknum.length < 2) {
					Ctasknum = '83009'
				}
				var closerxfercamptail = '_L';
				if (closerxfercamptail.length < 3) {
					closerxfercamptail = 'IVR'
				}
				blindxferdialstring = Ctasknum + '*' + $("#phone_number").val() + '*' + $("#lead_id").val() + '*' + campaign + '*' + closerxfercamptail + '*' + user + '**' + VD_live_call_secondS + '*'
			}
		} else {
			if ($("#xferoverride").is(":checked") == false) {
				if (three_way_dial_prefix == 'X') {
					var temp_dial_prefix = ''
				} else {
					var temp_dial_prefix = three_way_dial_prefix
				}
				if (omit_phone_code == 'Y') {
					var temp_phone_code = ''
				} else {
					var temp_phone_code = $("#phone_code").val()
				}
				if (blindxferdialstring.length > 7) {
					blindxferdialstring = temp_dial_prefix + "" + temp_phone_code + "" + blindxferdialstring
				}
			}
		}
		no_delete_VDAC = 0;
		if (taskvar == 'XfeRVMAIL') {
			var blindxferdialstring = campaign_am_message_exten + '*' + campaign + '*' + $("#phone_code").val() + '*' + $("#phone_number").val() + '*' + $("#lead_id").val();
			no_delete_VDAC = 1
		}
		if (blindxferdialstring.length < '2') {
			xferredirect_query = '';
			taskvar = 'NOTHING';
 			request_tip("转接号码必须大于1位数字:" + blindxferdialstring,0);
		} else {
			
			xferredirect_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ACTION=RedirectVD&format=text&channel=" + redirectvalue + "&call_server_ip=" + redirectserverip + "&queryCID=" + queryCID + "&exten=" + blindxferdialstring + "&ext_context=" + ext_context + "&ext_priority=1&auto_dial_level=" + auto_dial_level + "&campaign=" + campaign + "&uniqueid=" + $("#uniqueid").val() + "&lead_id=" + $("#lead_id").val() + "&secondS=" + VD_live_call_secondS + "&session_id=" + session_id + "&nodeletevdac=" + no_delete_VDAC;
			
		}
	}
	
	if (taskvar == 'XfeRINTERNAL') {
		var closerxferinternal = '';
		taskvar = 'XfeRLOCAL'
	} else {
		var closerxferinternal = '9'
	}
	if (taskvar == 'XfeRLOCAL') {
		CustomerData_update();
		 
		var queryCID = "XLvdcW" + epoch_sec + user_abb;
		var redirectdestination = closerxferinternal + '90009*' + $("#XfeRGrouP").val() + '**' + $("#lead_id").val() + '**' + dialed_number + '*' + user + '*' + $("#xfernumber").val() + '*';
		
		xferredirect_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ACTION=RedirectVD&format=text&channel=" + redirectvalue + "&call_server_ip=" + redirectserverip + "&queryCID=" + queryCID + "&exten=" + redirectdestination + "&ext_context=" + ext_context + "&ext_priority=1&auto_dial_level=" + auto_dial_level + "&campaign=" + campaign + "&uniqueid=" + $("#uniqueid").val() + "&lead_id=" + $("#lead_id").val() + "&secondS=" + VD_live_call_secondS + "&session_id=" + session_id;
		
	}
	if (taskvar == 'XfeR') {
		var queryCID = "LRvdcW" + epoch_sec + user_abb;
		var redirectdestination = $("#extension_xfer").val();
		xferredirect_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ACTION=RedirectName&format=text&channel=" + redirectvalue + "&call_server_ip=" + redirectserverip + "&queryCID=" + queryCID + "&extenName=" + redirectdestination + "&ext_context=" + ext_context + "&ext_priority=1" + "&session_id=" + session_id;
	}
	if (taskvar == 'VMAIL') {
		var queryCID = "LVvdcW" + epoch_sec + user_abb;
		var redirectdestination = $("#extension_xfer").val();
		xferredirect_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ACTION=RedirectNameVmail&format=text&channel=" + redirectvalue + "&call_server_ip=" + redirectserverip + "&queryCID=" + queryCID + "&exten=" + voicemail_dump_exten + "&extenName=" + redirectdestination + "&ext_context=" + ext_context + "&ext_priority=1" + "&session_id=" + session_id;
	}
	if (taskvar == 'ENTRY') {
		var queryCID = "LEvdcW" + epoch_sec + user_abb;
		var redirectdestination = $("#extension_xfer_entry").val();
		xferredirect_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ACTION=Redirect&format=text&channel=" + redirectvalue + "&call_server_ip=" + redirectserverip + "&queryCID=" + queryCID + "&exten=" + redirectdestination + "&ext_context=" + ext_context + "&ext_priority=1" + "&session_id=" + session_id;
	}
	if (taskvar == '3WAY') {
		xferredirect_query = '';
		var queryCID = "VXvdcW" + epoch_sec + user_abb;
		var redirectdestination = "NEXTAVAILABLE";
		var redirectXTRAvalue = XDchannel;
		var redirecttype_test = $("#xfernumber").val();
		 
		var regRXFvars = new RegExp("CXFER", "g");
		if (((redirecttype_test.match(regRXFvars)) || (consultativexfer_checked > 0)) && (local_consult_xfers > 0)) {
			var redirecttype = 'RedirectXtraCXNeW'
		} else {
			var redirecttype = 'RedirectXtraNeW'
		}
		DispO3waychannel = redirectvalue;
		DispO3wayXtrAchannel = redirectXTRAvalue;
		DispO3wayCalLserverip = redirectserverip;
		DispO3wayCalLxfernumber = $("#xfernumber").val();
		DispO3wayCalLcamptail = '';
		xferredirect_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ACTION=" + redirecttype + "&format=text&channel=" + redirectvalue + "&call_server_ip=" + redirectserverip + "&queryCID=" + queryCID + "&exten=" + redirectdestination + "&ext_context=" + ext_context + "&ext_priority=1&extrachannel=" + redirectXTRAvalue + "&lead_id=" + $("#lead_id").val() + "&phone_code=" + $("#phone_code").val() + "&phone_number=" + $("#phone_number").val() + "&filename=" + taskdebugnote + "&campaign=" + $("#XfeRGrouP").val() + "&session_id=" + session_id + "&agentchannel=" + agentchannel + "&protocol=" + protocol + "&extension=" + extension + "&auto_dial_level=" + auto_dial_level;
		if (taskdebugnote == 'FIRST') {
			$("#DispoSelectHAspan").html("<a class=\"zInputBtn\" href=\"javascript:void(0);\" onclick=\"DispoLeavE3wayAgaiN();\" title=\"点击再次离开三方通话\"><input type=\"button\" value=\"再次离开三方通话\" class=\"inputButton\"></a>")
		}
	}
	if (taskvar == 'ParK') {
		if (CalLCID.length < 1) {
			CalLCID = MDnextCID
		}
		blind_transfer = 0;
		var queryCID = "LPvdcW" + epoch_sec + user_abb;
		var redirectdestination = taskxferconf;
		var redirectdestserverip = taskserverip;
		var parkedby = protocol + "/" + extension;
		xferredirect_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ACTION=RedirectToPark&format=text&channel=" + redirectdestination + "&call_server_ip=" + redirectdestserverip + "&queryCID=" + queryCID + "&exten=" + park_on_extension + "&ext_context=" + ext_context + "&ext_priority=1&extenName=park&parkedby=" + parkedby + "&session_id=" + session_id + "&CalLCID=" + CalLCID;
		
		$("#ParkControl").html("<a href=\"javascript:void(0);\" onclick=\"mainxfer_send_redirect('FROMParK','" + redirectdestination + "','" + redirectdestserverip + "');\"><img src=\"./images/vdc_LB_grabparkedcall.gif\" alt=\"接起电话\"></a>");
		customerparked = 1
	}
	if (taskvar == 'FROMParK') {
		blind_transfer = 0;
		var queryCID = "FPvdcW" + epoch_sec + user_abb;
		var redirectdestination = taskxferconf;
		var redirectdestserverip = taskserverip;
		if ((server_ip == taskserverip) && (taskserverip.length > 6)) {
			var dest_dialstring = session_id
		} else {
			if (taskserverip.length > 6) {
				var dest_dialstring = server_ip_dialstring + "" + session_id
			} else {
				var dest_dialstring = session_id
			}
		}
		xferredirect_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ACTION=RedirectFromPark&format=text&channel=" + redirectdestination + "&call_server_ip=" + redirectdestserverip + "&queryCID=" + queryCID + "&exten=" + dest_dialstring + "&ext_context=" + ext_context + "&ext_priority=1" + "&session_id=" + session_id;
		
		$("#ParkControl").html("<a href=\"javascript:void(0);\" onclick=\"mainxfer_send_redirect('ParK','" + redirectdestination + "','" + redirectdestserverip + "');\"><img src=\"./images/vdc_LB_parkcall.gif\" alt=\"电话保持\"></a>");
		customerparked = 0
	}
	var XFRDop = '';
	
	$.ajax({
		url: "manager_send.php",
		data:xferredirect_query,
		success: function(htmls){ 
			var XfeRRedirecToutput = null;
			XfeRRedirecToutput = htmls;
			var XfeRRedirecToutput_array = XfeRRedirecToutput.split("|");
			var XFRDop = XfeRRedirecToutput_array[0];
			if (XFRDop == "NeWSessioN") {
				threeway_end = 1;
				$("#callchannel").val('');
				$("#callserverip").val('');
				dialedcall_send_hangup();
				$("#xferchannel").val('');
				xfercall_send_hangup();
				session_id = XfeRRedirecToutput_array[1];
				$("#sessionIDspan").html(session_id)
			}
		}
	});	
 	
    if ((auto_dial_level == 0) && (taskvar != '3WAY')) {
        RedirecTxFEr = 1;
          
		$.ajax({
			url: "manager_send.php",
			data:xferredirect_query + "&stage=2NDXfeR",
			success: function(htmls){ 
				Nactiveext = null;
                Nactiveext = htmls
			}
		});	
 		
    }
	
    if ((taskvar == 'XfeRLOCAL') || (taskvar == 'XfeRBLIND') || (taskvar == 'XfeRVMAIL')) {
        if (auto_dial_level == 0) {
            RedirecTxFEr = 1
        }
        $("#callchannel").val('');
        $("#callserverip").val('');
 		
		$("#call_status_pos").html("未通话").removeClass("red");
		$("#SecondSDISP").html("00:00:00");
		$("#call_status_hangup").removeClass("focus").off();
		
        dialedcall_send_hangup(taskdispowindow,'','',no_delete_VDAC)
    }
};
// ################################################################################
// Finish the alternate dialing and move on to disposition the call
function ManualDialAltDonE() {
    alt_phone_dialing = starting_alt_phone_dialing;
    alt_dial_active = 0;
    alt_dial_status_display = 0;
    open_dispo_screen = 1;
    
	request_tip("拨打下通电话",1);
};

function up_recording_un(u_lead_id,u_uniqueid){
	/*up_query="action=up_recording_log&lead_id="+u_lead_id+"&uniqueid="+u_uniqueid+"&record_id="+$("#record_id").val()+"&record_filename="+$("#record_filename").val();
	
	$.ajax({
 		url: "work_send.php",
		data:up_query,
  		success: function(htmls){ 
 			request_tip(htmls,1);
		}
	});*/ 
}
// ################################################################################
// Insert or update the vicidial_log entry for a customer call
function DialLog(taskMDstage, nodeletevdac) {
    var alt_num_status = 0;
 	
    if (taskMDstage == "start") {
        var MDlogEPOCH = 0;
        UID_test = $("#uniqueid").val();
        if (UID_test.length < 4) {
            UID_test = epoch_sec + '.' + random;
            $("#uniqueid").val(UID_test);
        }
    } else {
        if (alt_phone_dialing == 1) {
            if ($("#DiaLAltPhonE").is(":checked") == true) {
                alt_num_status = 1;
                reselect_alt_dial = 1;
                alt_dial_active = 1;
                alt_dial_status_display = 1;
                var man_status = "备用号码: <a href=\"javascript:void(0);\" onclick=\"ManualDialOnly('MaiNPhonE')\">常用</a> Or <a href=\"javascript:void(0);\" onclick=\"ManualDialOnly('ALTPhonE')\">备用</a> Or <a href=\"javascript:void(0);\" onclick=\"ManualDialOnly('AddresS3')\">地址3</a> Or <a href=\"javascript:void(0);\" onclick=\"ManualDialAltDonE()\">完成</a>";
                $("#MainStatuSSpan").html(man_status);
            }
        }
    }
    if(last_uniqueid==""){last_uniqueid=$("#uniqueid").val()}
	manDiaLlog_query = "format=text&server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=manDiaLlogCaLL&stage=" + taskMDstage + "&uniqueid=" +last_uniqueid+ "&user=" + user + "&pass=" + pass + "&campaign=" + campaign + "&lead_id=" + $("#lead_id").val() + "&list_id=" + $("#list_id").val() + "&length_in_sec=0&phone_code=" + $("#phone_code").val() + "&phone_number=" + lead_dial_number + "&exten=" + extension + "&channel=" + lastcustchannel + "&start_epoch=" + MDlogEPOCH + "&auto_dial_level=" + auto_dial_level + "&VDstop_rec_after_each_call=" + VDstop_rec_after_each_call + "&conf_silent_prefix=" + conf_silent_prefix + "&protocol=" + protocol + "&extension=" + extension + "&ext_context=" + ext_context + "&conf_exten=" + session_id + "&user_abb=" + user_abb + "&agent_log_id=" + agent_log_id + "&MDnextCID=" + LasTCID + "&inOUT=" + inOUT + "&alt_dial=" + dialed_label + "&DB=0" + "&agentchannel=" + agentchannel + "&conf_dialed=" + conf_dialed + "&leaving_threeway=" + leaving_threeway + "&hangup_all_non_reserved=" + hangup_all_non_reserved + "&blind_transfer=" + blind_transfer + "&dial_method=" + dial_method + "&nodeletevdac=" + nodeletevdac + "&alt_num_status=" + alt_num_status;
 	
	$.ajax({
 		url: "vdc_db_query.php",
		data:manDiaLlog_query,
  		success: function(htmls){ 
 			var MDlogResponse = null;
			MDlogResponse = htmls;
			var MDlogResponse_array = MDlogResponse.split("\n");
			MDlogLINE = MDlogResponse_array[0];
			if ((MDlogLINE == "LOG NOT ENTERED") && (VDstop_rec_after_each_call != 1)) {
			}else {
				MDlogEPOCH = MDlogResponse_array[1];
				if ((taskMDstage != "start") && (VDstop_rec_after_each_call == 1)) {
					
					if ((LIVE_campaign_recording == 'NEVER') || (LIVE_campaign_recording == 'ALLFORCE')) {
						//$("#RecorDControl").html("<img src=\"./images/vdc_LB_startrecording_OFF2.gif\" alt=\"开始录音\">");
						$("#RecorDControl").html("<img src=\"./images/vdc_LB_stoprecording_OFF2.gif\" alt=\"开始录音\">");
					} else {
						 
						$("#RecorDControl").html("<a href=\"javascript:void(0);\" onclick=\"conf_send_recording('MonitorConf','" + session_id + "','');\"><img src=\"./images/vdc_LB_startrecording2.gif\" alt=\"开始录音\"></a>")
					}
					MDlogRecorDings = MDlogResponse_array[3];
					if (window.MDlogRecorDings) {
						var MDlogRecorDings_array = MDlogRecorDings.split("|");
						var RecDispNamE = MDlogRecorDings_array[2];
						
						$("#record_filename").val(RecDispNamE);
						$("#record_id").val(MDlogRecorDings_array[3]);
						//$("#RecorDingFilename").html(RecDispNamE);
						//$("#RecorDID").html(MDlogRecorDings_array[3]);
					}
				}
			}
			
			//if (taskMDstage == "start")
			/*v_uniqueid=$("#uniqueid").val();
			if (v_uniqueid.length < 4) {
 				v_uniqueid=UID_test;
			}
			up_recording_un($("#lead_id").val(),UID_test);*/
		}
	});
	
    RedirecTxFEr = 0;
    conf_dialed = 0
};
// ################################################################################
// Request number of dialable leads left in this campaign
function DiaLableLeaDsCounT() {
    
	DLcount_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ACTION=DiaLableLeaDsCounT&campaign=" + campaign + "&format=text";
  	$("#dialableleadsspan_li").removeClass("hide");
	$.ajax({
 		url: "vdc_db_query.php",
		data:DLcount_query,
  		success: function(vals){ 
  			$("#dialableleadsspanss").html(vals);
 		}
	});
	
};
// ################################################################################
// Request number of USERONLY callbacks for this agent
function CalLBacKsCounTCheck() {
    
	CBcount_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ACTION=CalLBacKCounT&campaign=" + campaign + "&format=text";
 	
	$.ajax({
 		url: "vdc_db_query.php",
		data:CBcount_query,
  		success: function(htmls){ 
 			var CBcounT = htmls,CBprint="";
			if (CBcounT == 0) {
				CBprint = "无"
			} else {
				CBprint = CBcounT
			}
			$("#CBstatusSpan").html("<a href=\"javascript:void(0);\" onclick=\"CalLBacKsLisTCheck();\">" + CBprint + " 回拨</a>")
		}
	});
 
};
// ################################################################################
// Request list of USERONLY callbacks for this agent
function CalLBacKsLisTCheck() {
    if ((AutoDialWaiting == 1) || (VD_live_customer_call == 1) || (alt_dial_active == 1) || (MD_channel_look == 1)) {
		request_tip("在自动外拨模式下你必须先暂停才能查看回拨记录！",0);
    } else {
        showDiv('CallBacKsLisTBox');
         
		var CBlist_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ACTION=CalLBacKLisT&campaign=" + campaign + "&format=text";
 		
		$.ajax({
			url: "vdc_db_query.php",
			data:CBlist_query,
			success: function(htmls){ 
				var all_CBs = null;
				all_CBs = htmls;
				var all_CBs_array = all_CBs.split("\n");
				var CB_calls = all_CBs_array[0];
				var loop_ct = 0;
				var conv_start = 0;
				var CB_HTML = "<table width=610><tr bgcolor=<?php echo $SCRIPT_COLOR ?>><td>#</td><td> 回拨日期/时间</td><td>号码</td><td>名字</td><td>  状态</td><td align=right>活动</td><td>上次呼叫日期/时间</td><td align=left> 备注</td></tr>"
				while (loop_ct < CB_calls) {
					loop_ct++;
					loop_s = loop_ct.toString();
					if (loop_s.match(/1$|3$|5$|7$|9$/)) {
						var row_color = '#DDDDFF'
					} else {
						var row_color = '#CCCCFF'
					}
					var conv_ct = (loop_ct + conv_start);
					var call_array = all_CBs_array[conv_ct].split(" ~");
					var CB_name = call_array[0] + " " + call_array[1];
					var CB_phone = call_array[2];
					var CB_id = call_array[3];
					var CB_lead_id = call_array[4];
					var CB_campaign = call_array[5];
					var CB_status = call_array[6];
					var CB_lastcall_time = call_array[7];
					var CB_callback_time = call_array[8];
					var CB_comments = call_array[9];
					CB_HTML = CB_HTML + "<tr bgcolor=\"" + row_color + "\"><td>" + loop_ct + "</td><td>" + CB_callback_time + "</td><td><a href=\"javascript:void(0);\" onclick=\"new_callback_call('" + CB_id + "','" + CB_lead_id + "');\">" + CB_phone + "</a></td><td>" + CB_name + "</td><td>" + CB_status + "</td><td>" + CB_campaign + "</td><td align=right>" + CB_lastcall_time + "&nbsp;</td><td align=right>" + CB_comments + "&nbsp;</td></tr>"
				}
				CB_HTML = CB_HTML + "</table>";
				$("#CallBacKsLisT").html(CB_HTML)
			}
		});
	 
    }
};
// ################################################################################
// Open up a callback customer record as manual dial preview mode
function new_callback_call(taskCBid,taskLEADid,is_skip) {
    auto_dial_level = 0;
	
    manual_dial_in_progress = 1;
	
    MainPanelToFront();
    buildDiv('DiaLLeaDPrevieW');
    if (alt_phone_dialing == 1) {
        buildDiv('DiaLDiaLAltPhonE')
    }
    $("#LeadPreview").attr("checked",true);
	if(is_skip=="N"){
		manual_dial_in_progress = 0;
		$("#LeadPreview").attr("is_skip","N");
	}
    hideDiv('CallBacKsLisTBox');
    ManualDialNext(taskCBid, taskLEADid, '', '', '', '0')
};
// ################################################################################
// Finish Callback and go back to original screen
function manual_dial_finished() {
    alt_phone_dialing = starting_alt_phone_dialing;
    auto_dial_level = starting_dial_level;
    MainPanelToFront();
    CalLBacKsCounTCheck();
    manual_dial_in_progress = 0
};
// ################################################################################
// Open page to enter details for a new manual dial lead
function NeWManuaLDiaLCalL(TVfast) {
	 
    if ((AutoDialWaiting == 1) || (VD_live_customer_call == 1) || (alt_dial_active == 1) || (MD_channel_look == 1)) {
 		request_tip("当前模式下您必须先暂停正在进行的呼叫才能手动外拨！",0);
    } else {
        if (TVfast == 'FAST') {
            NeWManuaLDiaLCalLSubmiTfast()
        } else {
            if (agent_allow_group_alias == 'Y') {
                $("#ManuaLDiaLGrouPSelecteD").html("<span>组别名: " + active_group_alias + "</span>");
                $("#ManuaLDiaLGrouP").html("<a href=\"javascript:void(0);\" onclick=\"GroupAliasSelectContent_create('0');\">选择一个组别名</a>")
            }
			 
            showDiv('NeWManuaLDiaLBox');
        }
		
		var get_prefix_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&action=get_prefix&campaign_id="+ campaign;
 		
		$.ajax({
			url: "work_send.php",
			data:get_prefix_query,
			dataType:"json",cache:false,async:false,
			success: function(json){ 
				if(parseInt(json.counts)>0){
					dial_prefix=json.prefix;
					campaign_cid=json.cid;
				}
			}
		});
		
    }
};
// ################################################################################
// Insert the new manual dial as a lead and go to manual dial screen
function NeWManuaLDiaLCalLSubmiT(tempDiaLnow) {
	
	if($("#MDPhonENumbeR").val().length<4){
 		request_tip("请填写呼叫号码后再点击呼叫!",0);
		$("#MDPhonENumbeR").focus();
		return false;
	}
	
    hideDiv('NeWManuaLDiaLBox');
	is_manual_dialed="Y";
    var sending_group_alias = 0;
    var MDDiaLCodEform = $("#MDDiaLCodE").val();
    var MDPhonENumbeRform = $("#MDPhonENumbeR").val();
    var MDDiaLOverridEform = $("#MDDiaLOverridE").val();
    var MDVendorLeadCode = $("#vendor_lead_code").val();
    var MDLookuPLeaD = 'new';
    if ($("#LeadLookuP").is(":checked") == true) {
        MDLookuPLeaD = 'lookup'
    }
    if (MDDiaLCodEform.length < 1) {
        MDDiaLCodEform = $("#phone_code").val()
    }
    if (MDDiaLOverridEform.length > 0) {
        agent_dialed_number = 1;
        agent_dialed_type = 'MANUAL_OVERRIDE';
        basic_originate_call(session_id, 'NO', 'YES', MDDiaLOverridEform, 'YES', '', '1', '0')
    } else {
		
        auto_dial_level = 0;
        manual_dial_in_progress = 1;
        agent_dialed_number = 1;
        MainPanelToFront();
        if (tempDiaLnow == 'PREVIEW') {
            agent_dialed_type = 'MANUAL_PREVIEW';
            buildDiv('DiaLLeaDPrevieW','N');
            if (alt_phone_dialing == 1) {
                buildDiv('DiaLDiaLAltPhonE')
            }
            $("#LeadPreview").attr("checked",true)
        } else {
			
            agent_dialed_type = 'MANUAL_DIALNOW';
            $("#LeadPreview").attr("checked",false);
            $("#DiaLAltPhonE").attr("checked",false)
        }
        if (active_group_alias.length > 1) {
            var sending_group_alias = 1
        }
		$("#dial_ring_list").fadeIn();
		$("#dial_ring_number,#phone_numberDISP").html(phone_number_format(MDPhonENumbeRform));
        ManualDialNext("", "", MDDiaLCodEform, MDPhonENumbeRform, MDLookuPLeaD, MDVendorLeadCode, sending_group_alias)
    }
	
	$("#MDPhonENumbeR_text").text("");
    $("#MDPhonENumbeR,#MDDiaLOverridE").val("");    
};
// ################################################################################
// Fast version of manual dial
function NeWManuaLDiaLCalLSubmiTfast() {
    var MDDiaLCodEform = $("#phone_code").val();
    var MDPhonENumbeRform = $("#phone_number").val();
    var MDVendorLeadCode = $("#vendor_lead_code").val();
    if ((MDDiaLCodEform.length < 1) || (MDPhonENumbeRform.length < 5)) {
 		request_tip("快速拨号必须先输入电话号码和区号！",0);
    } else {
        var MDLookuPLeaD = 'new';
        if ($("#LeadLookuP").is(":checked") == true) {
            MDLookuPLeaD = 'lookup'
        }
        agent_dialed_number = 1;
        agent_dialed_type = 'MANUAL_DIALFAST';
        auto_dial_level = 0;
        manual_dial_in_progress = 1;
        MainPanelToFront();
        buildDiv('DiaLLeaDPrevieW');
        if (alt_phone_dialing == 1) {
            buildDiv('DiaLDiaLAltPhonE')
        }
        $("#LeadPreview").attr("checked",false);
        ManualDialNext("", "", MDDiaLCodEform, MDPhonENumbeRform, MDLookuPLeaD, MDVendorLeadCode, '0')
    }
};
// ################################################################################
// Request lookup of manual dial channel
function ManualDialCheckChanneL(taskCheckOR) {
    if (taskCheckOR == 'YES') {
        var CIDcheck = XDnextCID
    } else {
        var CIDcheck = MDnextCID
    }
     
	manDiaLlook_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=manDiaLlookCaLL&conf_exten=" + session_id + "&user=" + user + "&pass=" + pass + "&MDnextCID=" + CIDcheck + "&agent_log_id=" + agent_log_id + "&lead_id=" + $("#lead_id").val() + "&DiaL_SecondS=" + MD_ring_secondS;
	
	$.ajax({
		url: "vdc_db_query.php",
		data:manDiaLlook_query,
		success: function(htmls){ 
			 
			var MDlookResponse = null;
			MDlookResponse = htmls;
			var MDlookResponse_array = MDlookResponse.split("\n");
			var MDlookCID = MDlookResponse_array[0];
			var regMDL = new RegExp("^Local", "ig");
			if (MDlookCID == "NO") {
				MD_ring_secondS++;
				var dispnum = lead_dial_number;
				var status_display_number = phone_number_format(dispnum);
				if (alt_dial_status_display == '0') {
					//$("#MainStatuSSpan").html("用户ID: <span class=\"blue_f\">" + CIDcheck + "</span> 正在呼叫: <span class=\"red_f\">" + status_display_number + "</span> 等待振铃中... <span class=\"blue_f\">" + MD_ring_secondS + "</span>  秒")
 					 
					$("#dial_ring_second").html(MD_ring_secondS);
				}
 				
			} else {
				if (taskCheckOR == 'YES') {
					XDuniqueid = MDlookResponse_array[0];
					XDchannel = MDlookResponse_array[1];
					var XDalert = MDlookResponse_array[2];
					if (XDalert == 'ERROR') {
						var XDerrorDesc = MDlookResponse_array[3];
						var DiaLAlerTMessagE = "电话被拒: " + XDchannel + "\n" + XDerrorDesc;
						TimerActionRun("DiaLAlerT", DiaLAlerTMessagE)
					}
					if ((XDchannel.match(regMDL)) && (asterisk_version != '1.0.8') && (asterisk_version != '1.0.9') && (MD_ring_secondS < 10)) {
						MD_ring_secondS++
					} else {
						$("#xferuniqueid").val(MDlookResponse_array[0]);
						$("#xferchannel").val(MDlookResponse_array[1]);
						lastxferchannel = MDlookResponse_array[1];
						$("#xferlength").val(0);
						XD_live_customer_call = 1;
						XD_live_call_secondS = 0;
						MD_channel_look = 0;
						$("#MainStatuSSpan").html("三方通话: <span class=\"blue\">" + $("#xfernumber").val() + "</span> 用户ID: <span class=\"blue_f\">" + CIDcheck + "</span>");
						$("#dial_ring_number").html($("#xfernumber").val());
						
						$("#Leave3WayCall").html("<a href=\"javascript:void(0);\" onclick=\"leave_3way_call('FIRST');\"><img src=\"./images/vdc_XB_leave3waycall.gif\" alt=\"离开三方通话\" style=\"vertical-align:middle\"></a>");
						
						$("#DialWithCustomer").html("<img src=\"./images/vdc_XB_dialwithcustomer_OFF.gif\" alt=\"直转\" style=\"vertical-align:middle\">");
						
						$("#ParkCustomerDial").html("<img src=\"./images/vdc_XB_parkcustomerdial_OFF.gif\" alt=\"保持客户转接\" style=\"vertical-align:middle\">");
						
						$("#HangupXferLine").html("<a href=\"javascript:void(0);\" onclick=\"xfercall_send_hangup();\"><img src=\"./images/vdc_XB_hangupxferline.gif\" alt=\"挂机转接线\" style=\"vertical-align:middle\"></a>");
						
						$("#HangupBothLines").html("<a href=\"javascript:void(0);\" onclick=\"bothcall_send_hangup();\"><img src=\"./images/vdc_XB_hangupbothlines.gif\" alt=\"全部挂机\" style=\"vertical-align:middle\"></a>");
						xferchannellive = 1;
						XDcheck = ''
					}
				} else {
					MDuniqueid = MDlookResponse_array[0];
					MDchannel = MDlookResponse_array[1];
					var MDalert = MDlookResponse_array[2];
					if (MDalert == 'ERROR') {
						var MDerrorDesc = MDlookResponse_array[3];
						var DiaLAlerTMessagE = "呼叫被拒绝: " + MDchannel + "\n" + MDerrorDesc;
						TimerActionRun("DiaLAlerT", DiaLAlerTMessagE)
					}
					if ((MDchannel.match(regMDL)) && (asterisk_version != '1.0.8') && (asterisk_version != '1.0.9')) {
						MD_ring_secondS++
					} else {
						custchannellive = 1;
						$("#uniqueid").val(MDlookResponse_array[0]);
						last_uniqueid = MDlookResponse_array[0];
 						//up_recording_un($("#lead_id").val(),MDlookResponse_array[0]);
						
						$("#callchannel").val(MDlookResponse_array[1]);
						lastcustchannel = MDlookResponse_array[1];
												
						$("#SecondS").val(0);
						$("#SecondSDISP").html('00:00:00');
						
						VD_live_customer_call = 1;
						VD_live_call_secondS = 0;
						MD_channel_look = 0;
						var dispnum = lead_dial_number;
						var status_display_number = phone_number_format(dispnum);
						
						$("#call_status_time").toggleClass("focus");
						$("#dial_ring_number").html(status_display_number);
						$("#call_status_list").addClass("focus");
						$("#call_status_pos").html("正在通话").addClass("focus");
						$("#call_status_hangup").addClass("focus").off().on("click",function(){livehangup_send_hangup(lastcustchannel)});
										
						$("#ParkControl").html("<a href=\"javascript:void(0);\" onclick=\"mainxfer_send_redirect('ParK','" + lastcustchannel + "','" + lastcustserverip + "');\"><img src=\"./images/vdc_LB_parkcall.gif\" alt=\"电话保持\"></a>");
						
						$("#HangupControl").html("<a href=\"javascript:void(0);\" onclick=\"dialedcall_send_hangup();\"><img src=\"./images/vdc_LB_hangupcustomer.gif\" alt=\"挂断本次通话，提交呼叫结果\"></a>");
						
						$("#hangup_subs").removeClass("btn-disabled").off().on("click",function(){dialedcall_send_hangup();});
 						$("#XferControl").html("<a href=\"javascript:void(0);\" ><img src=\"./images/vdc_LB_transferconf.gif\" alt=\"会议 - 转接\"></a>");//onclick=\"ShoWTransferMain('ON');\"
						
						//$("#LocalCloser").html("<a href=\"javascript:void(0);\" onclick=\"mainxfer_send_redirect('XfeRLOCAL','" + lastcustchannel + "','" + lastcustserverip + "');\"><img src=\"./images/vdc_XB_localcloser.gif\" alt=\"本地呼入组\" style=\"vertical-align:middle\"></a>");
						
						//$("#DialBlindTransfer").html("<a href=\"javascript:void(0);\" onclick=\"mainxfer_send_redirect('XfeRBLIND','" + lastcustchannel + "','" + lastcustserverip + "');\"><img src=\"./images/vdc_XB_blindtransfer.gif\" alt=\"盲转\" style=\"vertical-align:middle\"></a>");
						
						//$("#DialBlindVMail").html("<a href=\"javascript:void(0);\" onclick=\"mainxfer_send_redirect('XfeRVMAIL','" + lastcustchannel + "','" + lastcustserverip + "');\"><img src=\"./images/vdc_XB_ammessage.gif\" alt=\"Blind Transfer VMail Message\" style=\"vertical-align:middle\"></a>");
						
						
						$("#VolumeUpSpan").addClass("focus").off().on("click",function(){volume_control('UP',MDchannel,'');});
						
						$("#VolumeDownSpan").addClass("focus").off().on("click",function(){volume_control('DOWN',MDchannel,'');});
						
						if (quick_transfer_button == 'IN_GROUP') {
							//$("#QuickXfer").html("<a href=\"javascript:void(0);\" onclick=\"mainxfer_send_redirect('XfeRLOCAL','" + lastcustchannel + "','" + lastcustserverip + "');\"><img src=\"./images/vdc_LB_quickxfer.gif\" alt=\"QUICK TRANSFER\"></a>")
						}
						if (prepopulate_transfer_preset_enabled > 0) {
							if (prepopulate_transfer_preset == 'PRESET_1') {
								$("#xfernumber").val(CalL_XC_a_NuMber)
							}
							if (prepopulate_transfer_preset == 'PRESET_2') {
								$("#xfernumber").val(CalL_XC_b_NuMber)
							}
							if (prepopulate_transfer_preset == 'PRESET_3') {
								$("#xfernumber").val(CalL_XC_c_NuMber)
							}
							if (prepopulate_transfer_preset == 'PRESET_4') {
								$("#xfernumber").val(CalL_XC_d_NuMber)
							}
							if (prepopulate_transfer_preset == 'PRESET_5') {
								$("#xfernumber").val(CalL_XC_e_NuMber)
							}
						}
						if ((quick_transfer_button == 'PRESET_1') || (quick_transfer_button == 'PRESET_2') || (quick_transfer_button == 'PRESET_3') || (quick_transfer_button == 'PRESET_4') || (quick_transfer_button == 'PRESET_5')) {
							
							$("#QuickXfer").html("<a href=\"javascript:void(0);\" onclick=\"mainxfer_send_redirect('XfeRBLIND','" + lastcustchannel + "','" + lastcustserverip + "');\"><img src=\"./images/vdc_LB_quickxfer.gif\" alt=\"QUICK TRANSFER\"></a>");
							
							if (quick_transfer_button == 'PRESET_1') {
								$("#xfernumber").val(CalL_XC_a_NuMber)
							}
							if (quick_transfer_button == 'PRESET_2') {
								$("#xfernumber").val(CalL_XC_b_NuMber)
							}
							if (quick_transfer_button == 'PRESET_3') {
								$("#xfernumber").val(CalL_XC_c_NuMber)
							}
							if (quick_transfer_button == 'PRESET_4') {
								$("#xfernumber").val(CalL_XC_d_NuMber)
							}
							if (quick_transfer_button == 'PRESET_5') {
								$("#xfernumber").val(CalL_XC_e_NuMber)
							}
						}
						if (call_requeue_button > 0) {
							var CloserSelectChoices = $("#CloserSelectList").val();
							var regCRB = new RegExp("AGENTDIRECT", "ig");
							if ((CloserSelectChoices.match(regCRB)) || (VU_closer_campaigns.match(regCRB))) {
								$("#ReQueueCall").html("<a href=\"javascript:void(0);\" onclick=\"call_requeue_launch();\"><img src=\"./images/vdc_LB_requeue_call.gif\" alt=\"Re-Queue Call\"></a>")
							} else {
								$("#ReQueueCall").html("<img src=\"./images/vdc_LB_requeue_call_OFF.gif\" alt=\"Re-Queue Call\">")
							}
						}
						var loop_ct = 0;
						var live_XfeR_HTML = '';
						var XfeR_SelecT = '';
						while (loop_ct < XFgroupCOUNT) {
							if (VARxfergroups[loop_ct] == LIVE_default_xfer_group) {
								XfeR_SelecT = 'selected '
							} else {
								XfeR_SelecT = ''
							}
							live_XfeR_HTML = live_XfeR_HTML + "<option " + XfeR_SelecT + "value=\"" + VARxfergroups[loop_ct] + "\">" + VARxfergroups[loop_ct] + " - " + VARxfergroupsnames[loop_ct] + "</option>\n";
							loop_ct++
						}
						$("#XfeRGrouPLisT").html("<select size=1 name='XfeRGrouP' id='XfeRGrouP' onChange=\"XferAgentSelectLink();return false;\">" + live_XfeR_HTML + "</select>");
						DialLog("start");
						custchannellive = 1
					}
				}
			}
			
		}
	});	
     
    if (MD_ring_secondS > 49) {
        MD_channel_look = 0;
        MD_ring_secondS = 0;
        
		request_tip("呼叫超时，请检查号码格式是否正确或联系系统管理员！",0,10000)
    }
};
// ################################################################################
// Update Agent screen with values from vicidial_list record
function UpdateFieldsData() {
    var fields_list = update_fields_data + ',';
    update_fields = 0;
    update_fields_data = '';
    
	UpdateFields_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=UpdateFields&conf_exten=" + session_id + "&user=" + user + "&pass=" + pass + "&stage=" + update_fields_data;

	$.ajax({
 		url: "vdc_db_query.php",
		data:UpdateFields_query,
  		success: function(htmls){ 
  			
			var UDfieldsResponse = null;
			UDfieldsResponse = htmls;
			var UDfieldsResponse_array = UDfieldsResponse.split("\n");
			var UDresponse_status = UDfieldsResponse_array[0];
			if (UDresponse_status == 'GOOD') {
				$("#vendor_lead_code").val(UDfieldsResponse_array[1]);
				source_id = UDfieldsResponse_array[2];
				$("#gmt_offset_now").val(UDfieldsResponse_array[3]);
				$("#phone_code").val(UDfieldsResponse_array[4]);
				$("#phone_numberDISP").html(phone_number_format(UDfieldsResponse_array[5]));
				  
				$("#phone_number").val(UDfieldsResponse_array[5]);
				$("#title").val(UDfieldsResponse_array[6]);
				$("#first_name").val(UDfieldsResponse_array[7]);
				$("#middle_initial").val(UDfieldsResponse_array[8]);
				$("#last_name").val(UDfieldsResponse_array[9]);
				$("#address1").val(UDfieldsResponse_array[10]);
				$("#address2").val(UDfieldsResponse_array[11]);
				$("#address3").val(UDfieldsResponse_array[12]);
				$("#city").val(UDfieldsResponse_array[13]);
				$("#state").val(UDfieldsResponse_array[14]);
				$("#province").val(UDfieldsResponse_array[15]);
				$("#postal_code").val(UDfieldsResponse_array[16]);
				$("#country_code").val(UDfieldsResponse_array[17]);
				$("#gender").val(UDfieldsResponse_array[18]);;
				$("#date_of_birth").val(UDfieldsResponse_array[19]);
				$("#alt_phone").val(UDfieldsResponse_array[20]);
				$("#email").val(UDfieldsResponse_array[21]);
				$("#security_phrase").val(UDfieldsResponse_array[22]);
				
				var REGcommentsNL = new RegExp("!N", "g");
				UDfieldsResponse_array[23] = UDfieldsResponse_array[23].replace(REGcommentsNL, "\n");
				$("#comments").val(UDfieldsResponse_array[23]);
				$("#rank").val(UDfieldsResponse_array[24]);
				
				$("#owner").val(UDfieldsResponse_array[25]);
				  
					web_form_vars = "&"+$('#vicidial_form').serialize() 
					+ "&user=" + user 
					+ "&pass=" + pass 
					+ "&campaign=" + campaign 
					+ "&phone_login=" + phone_login 
					+ "&original_phone_login=" + original_phone_login 
					+ "&phone_pass=" + phone_pass 
					+ "&fronter=" + fronter 
					+ "&closer=" + user 
					+ "&group=" + group 
					+ "&channel_group=" + group 
					+ "&SQLdate=" + SQLdate 
					+ "&epoch=" + UnixTime 
					+ "&customer_zap_channel=" + lastcustchannel 
					+ "&customer_server_ip=" + lastcustserverip 
					+ "&server_ip=" + server_ip 
					+ "&SIPexten=" + extension 
					+ "&session_id=" + session_id 
					+ "&phone=" + $("#phone_number").val() 
					+ "&parked_by=" + $("#lead_id").val() 
					+ "&dispo=" + LeaDDispO 
					+ "&dialed_number=" + dialed_number 
					+ "&dialed_label=" + dialed_label 
					+ "&source_id=" + source_id 
					+ "&camp_script=" + campaign_script 
					+ "&in_script=" + CalL_ScripT_id 
					+ "&fullname=" + LOGfullname 
					+ "&recording_filename=" + recording_filename 
					+ "&recording_id=" + recording_id 
					+ "&user_custom_one=" + VU_custom_one 
					+ "&user_custom_two=" + VU_custom_two 
					+ "&user_custom_three=" + VU_custom_three 
					+ "&user_custom_four=" + VU_custom_four 
					+ "&user_custom_five=" + VU_custom_five 
					+ "&preset_number_a=" + CalL_XC_a_NuMber
					+ "&preset_number_b=" + CalL_XC_b_NuMber
					+ "&preset_number_c=" + CalL_XC_c_NuMber 
					+ "&preset_number_d=" + CalL_XC_d_NuMber 
					+ "&preset_number_e=" + CalL_XC_e_NuMber 
					+ "&preset_dtmf_a=" + CalL_XC_a_Dtmf 
					+ "&preset_dtmf_b=" + CalL_XC_b_Dtmf 
					+ webform_session;
					 
					var regWFAvars = new RegExp("\\?", "ig");
					if (VDIC_web_form_address.match(regWFAvars)) {
						web_form_vars = '&' + web_form_vars
					} else {
						web_form_vars = '?' + web_form_vars
					}
					TEMP_VDIC_web_form_address = VDIC_web_form_address + "" + web_form_vars;
					var regWFAqavars = new RegExp("\\?&", "ig");
					var regWFAaavars = new RegExp("&&", "ig");
					TEMP_VDIC_web_form_address = TEMP_VDIC_web_form_address.replace(regWFAqavars, '?');
					TEMP_VDIC_web_form_address = TEMP_VDIC_web_form_address.replace(regWFAaavars, '&')
				  
				$("#WebFormSpan").html("<a href=\"javascript:void(0)\" onclick=\"tab_frame('WEBFORM','y');return false;\"><img src=\"./images/vdc_LB_webform.gif\" alt=\"网页表单\"></a>\n");
				
				if (enable_second_webform > 0) {
					web_form_vars_two = "&"+$('#vicidial_form').serialize()
					 + "&user=" + user 
					 + "&pass=" + pass 
					 + "&campaign=" + campaign 
					 + "&phone_login=" + phone_login 
					 + "&original_phone_login=" + original_phone_login 
					 + "&phone_pass=" + phone_pass 
					 + "&fronter=" + fronter 
					 + "&closer=" + user 
					 + "&group=" + group 
					 + "&channel_group=" + group 
					 + "&SQLdate=" + SQLdate 
					 + "&epoch=" + UnixTime						  
					 + "&customer_zap_channel=" + lastcustchannel 
					 + "&customer_server_ip=" + lastcustserverip 
					 + "&server_ip=" + server_ip 
					 + "&SIPexten=" + extension 
					 + "&session_id=" + session_id 
					 + "&phone=" + $("#phone_number").val() 
					 + "&parked_by=" + $("#lead_id").val() 
					 + "&dispo=" + LeaDDispO 
					 + "&dialed_number=" + dialed_number 
					 + "&dialed_label=" + dialed_label 
					 + "&source_id=" + source_id 
					 + "&rank=" + $("#rank").val() 
					 + "&owner=" + $("#owner").val() 
					 + "&camp_script=" + campaign_script 
					 + "&in_script=" + CalL_ScripT_id 
					 + "&fullname=" + LOGfullname 
					 + "&recording_filename=" + recording_filename 
					 + "&recording_id=" + recording_id 
					 + "&user_custom_one=" + VU_custom_one 
					 + "&user_custom_two=" + VU_custom_two
					 + "&user_custom_three=" + VU_custom_three 
					 + "&user_custom_four=" + VU_custom_four 
					 + "&user_custom_five=" + VU_custom_five 
					 + "&preset_number_a=" + CalL_XC_a_NuMber 
					 + "&preset_number_b=" + CalL_XC_b_NuMber 
					 + "&preset_number_c=" + CalL_XC_c_NuMber 
					 + "&preset_number_d=" + CalL_XC_d_NuMber 
					 + "&preset_number_e=" + CalL_XC_e_NuMber 
					 + "&preset_dtmf_a=" + CalL_XC_a_Dtmf + "&preset_dtmf_b=" + CalL_XC_b_Dtmf 
					 + webform_session;
					
					var regWFAvars = new RegExp("\\?", "ig");
					if (VDIC_web_form_address_two.match(regWFAvars)) {
						web_form_vars_two = '&' + web_form_vars
					} else {
						web_form_vars_two = '?' + web_form_vars
					}
					TEMP_VDIC_web_form_address_two = VDIC_web_form_address_two + "" + web_form_vars_two;
					var regWFAqavars = new RegExp("\\?&", "ig");
					var regWFAaavars = new RegExp("&&", "ig");
					TEMP_VDIC_web_form_address_two = TEMP_VDIC_web_form_address_two.replace(regWFAqavars, '?');
					TEMP_VDIC_web_form_address_two = TEMP_VDIC_web_form_address_two.replace(regWFAaavars, '&');
					 
					$("#WebFormSpanTwo").html("<a href=\"javascript:void(0)\" onclick=\"tab_frame('WEBFORMTWO','y');return false;\"><img src=\"./images/vdc_LB_webform_two.gif\" alt=\"网页表单二\"></a>\n");
				}
				
			} else {
				request_tip("更新号码资料错误!请检查重试!",1)
			}
      
		}
	});
	
};

function set_dial_btn_status(dial_m){
	if(dial_m=="Manual_en"){	
		$("#btn_vdc_pause,#btn_vdc_resume").addClass("btn-disabled").off().hide();
		$("#btn_vdc_dialnext").show();
		if(agent_pause_codes_active != 'N'&&(dial_method == "INBOUND_MAN"||dial_method== "MANUAL")) {
		   $("#btn_vdc_pause_m").removeClass("btn-disabled").off().on("click",function(){PauseCodeSelectContent_create();}).show();
		}
		$("#btn_vdc_dialnext,#btn_vdc_dialnext_2").removeClass("btn-disabled").off().on("click",function(){ManualDialNext('','','','','','0');});
		
	}else if(dial_m=="pau_btn_dis"){
	
		$("#btn_vdc_pause").removeClass("btn-disabled").off().on("click",function(){AutoDial_ReSume_PauSe('VDADpause');}).show();
		$("#btn_vdc_resume").addClass("btn-disabled").off().show();
		$("#btn_vdc_dialnext,#btn_vdc_pause_m").hide();
		$("#btn_vdc_dialnext,#btn_vdc_dialnext_2,#btn_vdc_pause_m").addClass("btn-disabled").off();
		
	}else if(dial_m=="Auto_re_en"){
	
		$("#btn_vdc_pause").addClass("btn-disabled").off().show();
		$("#btn_vdc_resume").removeClass("btn-disabled").off().on("click",function(){AutoDial_ReSume_PauSe('VDADready');}).show();
		$("#btn_vdc_dialnext,#btn_vdc_pause_m").hide();
		$("#btn_vdc_dialnext,#btn_vdc_dialnext_2,#btn_vdc_pause_m").addClass("btn-disabled").off();
		
	}else if(dial_m=="dis_all_btn"){
	
		$("#btn_vdc_pause,#btn_vdc_resume,#btn_vdc_dialnext,#btn_vdc_dialnext_2,#btn_vdc_pause_m").addClass("btn-disabled").off();
		
	}else if(dial_m=="show_next_btn_dis"){
		$("#btn_vdc_pause,#btn_vdc_resume").hide();
		$("#btn_vdc_dialnext").show();
		if(agent_pause_codes_active != 'N'&&(dial_method == "INBOUND_MAN"||dial_method== "MANUAL")) {
		   $("#btn_vdc_pause_m").show();
		}
	}else if(dial_m=="show_auto_btn_dis"){
		$("#btn_vdc_pause,#btn_vdc_resume").show();
		$("#btn_vdc_dialnext,#btn_vdc_pause_m").hide();
	}
};

// ################################################################################
// Send the Manual Dial Next Number request
function ManualDialNext(mdnCBid, mdnBDleadid, mdnDiaLCodE, mdnPhonENumbeR, mdnStagE, mdVendorid, mdgroupalias,mdnListid) {
    inOUT = 'OUT';
    all_record = 'NO';
    all_record_count = 0;
    if (dial_method == "INBOUND_MAN"||dial_method== "MANUAL") {
        auto_dial_level = 0;
        if (VDRP_stage != 'PAUSED') {
            agent_log_id = AutoDial_ReSume_PauSe("VDADpause", '', '', '', "DIALNEXT");
            PauseCodeSelect_submit("NXDIAL")
        } else {
            auto_dial_level = starting_dial_level
        }
        
		set_dial_btn_status("show_next_btn_dis");
  		
    } else {        
 		set_dial_btn_status("show_auto_btn_dis");
    }
	set_dial_btn_status("dis_all_btn");
 	
    if ($("#LeadPreview").is(":checked") == true) {
        reselect_preview_dial = 1;
        var man_preview = 'YES',btn_skip="";
        
		if($("#LeadPreview").attr("is_skip")=="N"){
			btn_skip="<a class=\"btn\" href=\"javascript:void(0);\" title=\"点击取消呼叫本号码\" onclick=\"ManualDialCan();return false\"><span class=\"btn_f_nor red\" >取消</span></a>";
		}else{
			btn_skip="<a class=\"btn\" href=\"javascript:void(0);\" title=\"点击跳过本号码，获取新号码继续呼叫\" onclick=\"ManualDialSkip();return false\"><span class=\"btn_f_nor red\">跳过</span></a>"
		}
		
		var man_status = "<a class=\"btn\" href=\"javascript:void(0);\" title=\"点击继续呼叫本号码\" onclick=\"ManualDialOnly();return false\"><span class=\"btn_f_nor green\">呼叫</span></a> "+btn_skip;
		
    } else {
        reselect_preview_dial = 0;
        var man_preview = 'NO';
        var man_status = ""
    }
 
	if (cid_choice.length > 3) {
		var call_cid = cid_choice
	} else {
		var call_cid = campaign_cid
	}
	if (prefix_choice.length > 0) {
		var call_prefix = prefix_choice
	} else {
		var call_prefix = dial_prefix
	}
	
	if($("#last_list_id").val()!=""){mdnLisT_id=$("#last_list_id").val()}
	
	manDiaLnext_query = "server_ip=" + server_ip 
	+ "&session_name=" + session_name 
	+ "&ACTION=manDiaLnextCaLL&conf_exten=" + session_id 
	+ "&user=" + user 
	+ "&pass=" + pass 
	+ "&campaign=" + campaign 
	+ "&ext_context=" + ext_context 
	+ "&dial_timeout=" + dial_timeout 
	+ "&dial_prefix=" + call_prefix 
	+ "&campaign_cid=" + call_cid 
	+ "&preview=" + man_preview 
	+ "&agent_log_id=" + agent_log_id 
	+ "&callback_id=" + mdnCBid 
	+ "&lead_id=" + mdnBDleadid 
	+ "&phone_code=" + mdnDiaLCodE 
	+ "&phone_number=" + mdnPhonENumbeR 
	+ "&list_id=" + mdnLisT_id 
	+ "&stage=" + mdnStagE 
	+ "&use_internal_dnc=" + use_internal_dnc 
	+ "&use_campaign_dnc=" + use_campaign_dnc 
	+ "&omit_phone_code=" + omit_phone_code 
	+ "&manual_dial_filter=" + manual_dial_filter 
	+ "&vendor_lead_code=" + mdVendorid 
	+ "&usegroupalias=" + mdgroupalias 
	+ "&account=" + active_group_alias 
	+ "&agent_dialed_number=" + agent_dialed_number 
	+ "&agent_dialed_type=" + agent_dialed_type 
	+ "&vtiger_callback_id=" + vtiger_callback_id 
	+ "&dial_method=" + dial_method;
	
	$.ajax({
		url: "vdc_db_query.php",
		data:manDiaLnext_query,
		success: function(htmls){ 
			
			var MDnextResponse = null;
			MDnextResponse = htmls;
			var MDnextResponse_array = MDnextResponse.split("\n");
			MDnextCID = MDnextResponse_array[0];
			var regMNCvar = new RegExp("HOPPER", "ig");
			var regMDFvarDNC = new RegExp("DNC", "ig");
			var regMDFvarCAMP = new RegExp("CAMPLISTS", "ig");
			if ((MDnextCID.match(regMNCvar)) || (MDnextCID.match(regMDFvarDNC)) || (MDnextCID.match(regMDFvarCAMP))) {
				var alert_displayed = 0;
				alt_phone_dialing = starting_alt_phone_dialing;
				auto_dial_level = starting_dial_level;
				MainPanelToFront();
				CalLBacKsCounTCheck();
				if (MDnextCID.match(regMNCvar)) {
					alert("本业务活动内没有可呼叫号码:" + campaign);
					alert_displayed = 1
				}
				if (MDnextCID.match(regMDFvarDNC)) {
 					request_tip("该号码在呼叫黑名单中:" + mdnPhonENumbeR,0);
					alert_displayed = 1
				}
				if (MDnextCID.match(regMDFvarCAMP)) {
					 
					request_tip("该号码不在本业务活动所属客户清单中:" + mdnPhonENumbeR,0);
					alert_displayed = 1
				}
				if (alert_displayed == 0) {
				 
					request_tip("未指定的错误:" + mdnPhonENumbeR+ "|" + MDnextCID,0);
					alert_displayed = 1
				}
				if (starting_dial_level == 0) { 
				
					set_dial_btn_status("Manual_en");
					
				} else {
					if (dial_method == "INBOUND_MAN"||dial_method== "MANUAL") {
						auto_dial_level = starting_dial_level; 
						set_dial_btn_status("Manual_en");
					} else { 
						set_dial_btn_status("Auto_re_en");
					}
					
					reselect_alt_dial = 0
				}
				
			} else {
				fronter = user;
				LasTCID = MDnextResponse_array[0];
				$("#lead_id").val(MDnextResponse_array[1]);
				LeaDPreVDispO = MDnextResponse_array[2];
				$("#vendor_lead_code").val(MDnextResponse_array[4]);
				$("#list_id,#last_list_id").val(MDnextResponse_array[5]);
				$("#gmt_offset_now").val(MDnextResponse_array[6]);
				$("#phone_code").val(MDnextResponse_array[7]); 				 
				$("#phone_numberDISP").html(phone_number_format(MDnextResponse_array[8]));					 
				$("#phone_number").val(MDnextResponse_array[8]);
				$("#title").val(MDnextResponse_array[9]);
				$("#first_name").val(MDnextResponse_array[10]);
				$("#middle_initial").val(MDnextResponse_array[11]);
				$("#last_name").val(MDnextResponse_array[12]);
				$("#address1").val(MDnextResponse_array[13]);
				$("#address2").val(MDnextResponse_array[14]);
				$("#address3").val(MDnextResponse_array[15]);
				$("#city").val(MDnextResponse_array[16]);
				$("#state").val(MDnextResponse_array[17]);
				$("#province").val(MDnextResponse_array[18]);
				$("#postal_code").val(MDnextResponse_array[19]);
				$("#country_code").val(MDnextResponse_array[20]);
				$("#gender").val(MDnextResponse_array[21]);
				$("#date_of_birth").val(MDnextResponse_array[22]);
				$("#alt_phone").val(MDnextResponse_array[23]);
				$("#email").val(MDnextResponse_array[24]);
				$("#security_phrase").val(MDnextResponse_array[25]);
				var REGcommentsNL = new RegExp("!N", "g");
				MDnextResponse_array[26] = MDnextResponse_array[26].replace(REGcommentsNL, "\n");
				$("#comments").val(MDnextResponse_array[26]);
				$("#called_count").val(MDnextResponse_array[27]) ;
				previous_called_count = MDnextResponse_array[27];
				previous_dispo = MDnextResponse_array[2];
				CBentry_time = MDnextResponse_array[28];
				CBcallback_time = MDnextResponse_array[29];
				CBuser = MDnextResponse_array[30];
				CBcomments = MDnextResponse_array[31];
				dialed_number = MDnextResponse_array[32];
				dialed_label = MDnextResponse_array[33];
				source_id = MDnextResponse_array[34];
				$("#rank").val(MDnextResponse_array[35]);
				$("#owner").val(MDnextResponse_array[36]);
				script_recording_delay = MDnextResponse_array[38];
				CalL_XC_a_NuMber = MDnextResponse_array[39];
				CalL_XC_b_NuMber = MDnextResponse_array[40];
				CalL_XC_c_NuMber = MDnextResponse_array[41];
				CalL_XC_d_NuMber = MDnextResponse_array[42];
				CalL_XC_e_NuMber = MDnextResponse_array[43];
				timer_action = campaign_timer_action;
				timer_action_message = campaign_timer_action_message;
				timer_action_seconds = campaign_timer_action_seconds;
				lead_dial_number = $("#phone_number").val();
				var dispnum = $("#phone_number").val();
				var status_display_number = phone_number_format(dispnum);
				$("#MainStatuSSpan").html(man_status);
				
				$("#dial_ring_list").fadeIn();
				$("#dial_ring_number,#phone_numberDISP").html(status_display_number);
 				
				if ((dialed_label.length < 2) || (dialed_label == 'NONE')) {
					dialed_label = 'MAIN'
				}
				
				LeaDDispO = '';
				VDIC_web_form_address = VICIDiaL_web_form_address;
				VDIC_web_form_address_two = VICIDiaL_web_form_address_two;
 				 
					web_form_vars = "&"+$('#vicidial_form').serialize()
					
					+ "&phone=" + $("#phone_number").val() 
					+ "&parked_by=" + $("#lead_id").val()						
					+ "&user=" + user 
					+ "&pass=" + pass 
					+ "&campaign=" + campaign 
					+ "&phone_login=" + phone_login 
					+ "&original_phone_login=" + original_phone_login 
					+ "&phone_pass=" + phone_pass 
					+ "&fronter=" + fronter 
					+ "&closer=" + user 
					+ "&group=" + group 
					+ "&channel_group=" + group 
					+ "&SQLdate=" + SQLdate 
					+ "&epoch=" + UnixTime						
					+ "&customer_zap_channel=" + lastcustchannel 
					+ "&customer_server_ip=" + lastcustserverip 
					+ "&server_ip=" + server_ip 
					+ "&SIPexten=" + extension 
					+ "&session_id=" + session_id 
					+ "&dispo=" + LeaDDispO 
					+ "&dialed_number=" + dialed_number 
					+ "&dialed_label=" + dialed_label 
					+ "&source_id=" + source_id 
					+ "&camp_script=" + campaign_script 
					+ "&in_script=" + CalL_ScripT_id 
					+ "&fullname=" + LOGfullname 
					+ "&recording_filename=" + recording_filename 
					+ "&recording_id=" + recording_id 
					+ "&user_custom_one=" + VU_custom_one 
					+ "&user_custom_two=" + VU_custom_two
					+ "&user_custom_three=" + VU_custom_three 
					+ "&user_custom_four=" + VU_custom_four 
					+ "&user_custom_five=" + VU_custom_five 
					+ "&preset_number_a=" + CalL_XC_a_NuMber 
					+ "&preset_number_b=" + CalL_XC_b_NuMber 
					+ "&preset_number_c=" + CalL_XC_c_NuMber 
					+ "&preset_number_d=" + CalL_XC_d_NuMber 
					+ "&preset_number_e=" + CalL_XC_e_NuMber 
					+ "&preset_dtmf_a=" + CalL_XC_a_Dtmf 
					+ "&preset_dtmf_b=" + CalL_XC_b_Dtmf 
					+ webform_session;
					
					
					var regWFAvars = new RegExp("\\?", "ig");
					if (VDIC_web_form_address.match(regWFAvars)) {
						web_form_vars = '&' + web_form_vars
					} else {
						web_form_vars = '?' + web_form_vars
					}
					TEMP_VDIC_web_form_address = VDIC_web_form_address + "" + web_form_vars;
					var regWFAqavars = new RegExp("\\?&", "ig");
					var regWFAaavars = new RegExp("&&", "ig");
					TEMP_VDIC_web_form_address = TEMP_VDIC_web_form_address.replace(regWFAqavars, '?');
					TEMP_VDIC_web_form_address = TEMP_VDIC_web_form_address.replace(regWFAaavars, '&');
					
					if (VDIC_web_form_address_two.match(regWFAvars)) {
						web_form_vars_two = '&' + web_form_vars
					} else {
						web_form_vars_two = '?' + web_form_vars
					}
					TEMP_VDIC_web_form_address_two = VDIC_web_form_address_two + "" + web_form_vars_two;
					var regWFAqavars = new RegExp("\\?&", "ig");
					var regWFAaavars = new RegExp("&&", "ig");
					TEMP_VDIC_web_form_address_two = TEMP_VDIC_web_form_address_two.replace(regWFAqavars, '?');
					TEMP_VDIC_web_form_address_two = TEMP_VDIC_web_form_address_two.replace(regWFAaavars, '&');
 				
				/*if (enable_second_webform > 0) {
					
					//$("#WebFormSpanTwo").html("<a href=\"" + TEMP_VDIC_web_form_address_two + "\" target=\"" + web_form_target + "\" onMouseOver=\"WebFormTwoRefresH();\"><img src=\"./images/vdc_LB_webform_two.gif\" alt=\"网页表单二\"></a>\n")
				}*/
				if (LeaDPreVDispO == 'CALLBK') {
					$("#CusTInfOSpaN").html(" <strong> PREVIOUS CALLBACK </strong>");
					$("#CusTInfOSpaN").css("background",CusTCB_bgcolor);
					$("#CBcommentsBoxA").html("<strong>Last Call: </strong>" + CBentry_time);
					$("#CBcommentsBoxB").html("<strong>CallBack: </strong>" + CBcallback_time);
					$("#CBcommentsBoxC").html("<strong>Agent: </strong>" + CBuser);
					$("#CBcommentsBoxD").html("<strong>Comments: </strong><br>" + CBcomments);
					showDiv('CBcommentsBox')
				}
				if ($("#LeadPreview").is(":checked") == false) {
					reselect_preview_dial = 0;
					MD_channel_look = 1;
					custchannellive = 1;
					
					$("#HangupControl").html("<a href=\"javascript:void(0);\" onclick=\"dialedcall_send_hangup();\"><img src=\"./images/vdc_LB_hangupcustomer.gif\" alt=\"挂断本次通话，提交呼叫结果\"></a>");
					
 					$("#hangup_subs").removeClass("btn-disabled").off().on("click",function(){dialedcall_send_hangup();});
					
					if ((LIVE_campaign_recording == 'ALLCALLS') || (LIVE_campaign_recording == 'ALLFORCE')) {
						all_record = 'YES'
					}
					if ((view_scripts == 1) && (campaign_script.length > 0)) {
						
						web_form_vars = "&"+$('#vicidial_form').serialize() 
						+ "&user=" + user 
						+ "&pass=" + pass 
						+ "&campaign=" + campaign 
						+ "&phone_login=" + phone_login 
						+ "&original_phone_login=" + original_phone_login 
						+ "&phone_pass=" + phone_pass 
						+ "&fronter=" + fronter 
						+ "&closer=" + user 
						+ "&group=" + group 
						+ "&channel_group=" + group 
						+ "&SQLdate=" + SQLdate 
						+ "&epoch=" + UnixTime 
						+ "&customer_zap_channel=" + lastcustchannel 
						+ "&customer_server_ip=" + lastcustserverip 
						+ "&server_ip=" + server_ip 
						+ "&SIPexten=" + extension 
						+ "&session_id=" + session_id 
						+ "&phone=" + $("#phone_number").val() 
						+ "&parked_by=" + $("#lead_id").val() 
						+ "&dispo=" + LeaDDispO 
						+ "&dialed_number=" + dialed_number 
						+ "&dialed_label=" + dialed_label 
						+ "&source_id=" + source_id 
						+ "&camp_script=" + campaign_script 
						+ "&in_script=" + CalL_ScripT_id 
						+ "&fullname=" + LOGfullname 
						+ "&recording_filename=" + recording_filename 
						+ "&recording_id=" + recording_id 
						+ "&user_custom_one=" + VU_custom_one
						+ "&user_custom_two=" + VU_custom_two 
						+ "&user_custom_three=" + VU_custom_three 
						+ "&user_custom_four=" + VU_custom_four 
						+ "&user_custom_five=" + VU_custom_five 
						+ "&preset_number_a=" + CalL_XC_a_NuMber 
						+ "&preset_number_b=" + CalL_XC_b_NuMber 
						+ "&preset_number_c=" + CalL_XC_c_NuMber 
						+ "&preset_number_d=" + CalL_XC_d_NuMber 
						+ "&preset_number_e=" + CalL_XC_e_NuMber 
						+ "&preset_dtmf_a=" + CalL_XC_a_Dtmf 
						+ "&preset_dtmf_b=" + CalL_XC_b_Dtmf 
						+ webform_session;
						
 						/*if ((script_recording_delay > 0) && ((LIVE_campaign_recording == 'ALLCALLS') || (LIVE_campaign_recording == 'ALLFORCE'))) {
							delayed_script_load = 'YES';
							RefresHScript('CLEAR')
						} else {
							load_script_contents()
						}*/
					}
					
 					
					if (get_call_launch == 'SCRIPT'||get_call_launch == 'NONE') {
 						load_script_contents();
						 
						//$("#frame_c_WEBFORM").attr("src",TEMP_VDIC_web_form_address);
 					}
					if (get_call_launch == 'WEBFORM') {
						//load_script_contents("N");
						$("#WEBFORM_url").val(TEMP_VDIC_web_form_address);
						tab_frame('WEBFORM','y');
					}
					
					if (get_call_launch == 'WEBFORMTWO') {
						request_tip(TEMP_VDIC_web_form_address_two);
						$("#WEBFORMTWO_url").val(TEMP_VDIC_web_form_address_two);
						tab_frame('WEBFORMTWO','y');
					}
					
				} else {
					reselect_preview_dial = 1
				}
			}
			
		}
	});	
	
 	if ($("#LeadPreview").is(":checked") == false) {
		active_group_alias = '';
		cid_choice = '';
		prefix_choice = '';
		agent_dialed_number = '';
		agent_dialed_type = '';
		CalL_ScripT_id = ''
	}

};
// ################################################################################
// Send the Manual Dial Skip
function ManualDialSkip() {
    if (manual_dial_in_progress == 1) {        
		request_tip('您不能跳过或取消本次拨号，必须拨打本号码！',0);
    } else {
        if (dial_method == "INBOUND_MAN"||dial_method== "MANUAL") {
            auto_dial_level = starting_dial_level;			
            
			set_dial_btn_status("show_next_btn_dis");
         } else {
            
			set_dial_btn_status("show_auto_btn_dis");
         }
        set_dial_btn_status("dis_all_btn");
		
		manDiaLskip_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=manDiaLskip&conf_exten=" + session_id + "&user=" + user + "&pass=" + pass + "&lead_id=" + $("#lead_id").val() + "&stage=" + previous_dispo + "&called_count=" + previous_called_count;
		
		$.ajax({
			url: "vdc_db_query.php",
			data:manDiaLskip_query,
			success: function(htmls){ 
				var MDSnextResponse = null;
				MDSnextResponse = htmls;
				var MDSnextResponse_array = MDSnextResponse.split("\n");
				MDSnextCID = MDSnextResponse_array[0];
				if (MDSnextCID == "LEAD NOT REVERTED") {
					request_tip("号码不能恢复, 错误如下:" + MDSnextResponse,0);
				} else {
					
					$(":input","#vicidial_form").val("");
					$("#phone_numberDISP").html('');					
					$("#MainStatuSSpan").html("");
					$("#dial_ring_list").fadeOut();
					
					VDCL_group_id = '';
					fronter = '';
					previous_called_count = '';
					previous_dispo = '';
					custchannellive = 1;
					
					request_tip("已跳过当前号码, 请继续点击呼叫下一个获取新号码！",1);
					
					if (dial_method == "INBOUND_MAN"||dial_method== "MANUAL") { 
						
						set_dial_btn_status("Manual_en");
						
					} else { 
						set_dial_btn_status("Auto_re_en");
						
					}
				}
			}
		});	
		
		active_group_alias = '';
		cid_choice = '';
		prefix_choice = '';
		agent_dialed_number = '';
		agent_dialed_type = '';
		CalL_ScripT_id = ''
    }
};

function ManualDialCan(){
	if (dial_method == "INBOUND_MAN"||dial_method== "MANUAL") {}else{
		clearDiv('DiaLLeaDPrevieW');
	}
	$(":input","#vicidial_form").val("");	
	$("#phone_numberDISP").html('');	
	$("#MainStatuSSpan").html("");
	$("#dial_ring_list").fadeOut();
	
	VDCL_group_id = '';
	fronter = '';
	previous_called_count = '';
	previous_dispo = '';
	custchannellive = 1;
	
	request_tip("已取消呼叫当前号码！",1);
	
	if (dial_method == "INBOUND_MAN"||dial_method== "MANUAL") {
 		set_dial_btn_status("Manual_en");
 	} else {
 		set_dial_btn_status("Auto_re_en");
	}
		 
	active_group_alias = '';
	cid_choice = '';
	prefix_choice = '';
	agent_dialed_number = '';
	agent_dialed_type = '';
	CalL_ScripT_id = ''
     
};
// ################################################################################
// Send the Manual Dial Only - dial the previewed lead
function ManualDialOnly(taskaltnum) {
    inOUT = 'OUT';
    alt_dial_status_display = 0;
    all_record = 'NO';
    all_record_count = 0;
    var usegroupalias = 0;
    if (taskaltnum == 'ALTPhonE') {
        var manDiaLonly_num = $("#alt_phone").val();
        lead_dial_number = $("#alt_phone").val();
        dialed_number = lead_dial_number;
        dialed_label = 'ALT';
        WebFormRefresH('')
    } else {
        if (taskaltnum == 'AddresS3') {
            var manDiaLonly_num = $("#address3").val();
            lead_dial_number = $("#address3").val();
            dialed_number = lead_dial_number;
            dialed_label = 'ADDR3';
            WebFormRefresH('')
        } else {
            var manDiaLonly_num = $("#phone_number").val();
            lead_dial_number = $("#phone_number").val();
            dialed_number = lead_dial_number;
            dialed_label = 'MAIN';
            WebFormRefresH('')
        }
    }
    if (dialed_label == 'ALT') {
        $("#CusTInfOSpaN").html(" <strong> 备用号码: ALT </strong>")
    }
    if (dialed_label == 'ADDR3') {
        $("#CusTInfOSpaN").html(" <strong> 备用号码: ADDRESS3 </strong>")
    }
    var REGalt_dial = new RegExp("X", "g");
    if (dialed_label.match(REGalt_dial)) {
		
        $("#CusTInfOSpaN").html(" <strong> 备用号码: " + dialed_label + "</strong>");
        $("#EAcommentsBoxA").html("<strong>电话区号和号码: </strong>" + EAphone_code + " " + EAphone_number);
		
        var EAactive_link = '';
        if (EAalt_phone_active == 'Y') {
            EAactive_link = "<a href=\"javascript:void(0);\" onclick=\"alt_phone_change('" + EAphone_number + "','" + EAalt_phone_count + "','" + $("#lead_id").val() + "','N');\">Change this phone number to INACTIVE</a>"
        } else {
            EAactive_link = "<a href=\"javascript:void(0);\" onclick=\"alt_phone_change('" + EAphone_number + "','" + EAalt_phone_count + "','" + $("#lead_id").val() + "','Y');\">Change this phone number to ACTIVE</a>"
        }
        $("#EAcommentsBoxB").html("<strong>活动: </strong>" + EAalt_phone_active + "<BR>" + EAactive_link);
        $("#EAcommentsBoxC").html("<strong>备用次数: </strong>" + EAalt_phone_count);
        $("#EAcommentsBoxD").html("<strong>备注: </strong><br>" + EAalt_phone_notes);
        showDiv('EAcommentsBox')
    }
 
	if (cid_choice.length > 3) {
		var call_cid = cid_choice;
		usegroupalias = 1
	} else {
		var call_cid = campaign_cid
	}
	if (prefix_choice.length > 0) {
		var call_prefix = prefix_choice
	} else {
		var call_prefix = dial_prefix
	}
	manDiaLonly_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=manDiaLonly&conf_exten=" + session_id + "&user=" + user + "&pass=" + pass + "&lead_id=" + $("#lead_id").val() + "&phone_number=" + manDiaLonly_num + "&phone_code=" + $("#phone_code").val() + "&campaign=" + campaign + "&ext_context=" + ext_context + "&dial_timeout=" + dial_timeout + "&dial_prefix=" + call_prefix + "&campaign_cid=" + call_cid + "&omit_phone_code=" + omit_phone_code + "&usegroupalias=" + usegroupalias + "&account=" + active_group_alias + "&agent_dialed_number=" + agent_dialed_number + "&agent_dialed_type=" + agent_dialed_type + "&dial_method=" + dial_method + "&agent_log_id=" + agent_log_id;
	 
	$.ajax({
		url: "vdc_db_query.php",
		data:manDiaLonly_query,
		success: function(htmls){ 
		
			var MDOnextResponse = null;
			MDOnextResponse = htmls;
			var MDOnextResponse_array = MDOnextResponse.split("\n");
			MDnextCID = MDOnextResponse_array[0];
			agent_log_id = MDOnextResponse_array[1];
			//request_tip(MDnextCID,1,10000);
			if (MDnextCID == " CALL NOT PLACED") {
				 
				request_tip("呼叫不能覆盖，发生错误:" + MDSnextResponse,0);
			} else {
				LasTCID = MDOnextResponse_array[0];
				MD_channel_look = 1;
				custchannellive = 1;
				var dispnum = manDiaLonly_num;
				var status_display_number = phone_number_format(dispnum);
				if (alt_dial_status_display == '0') {
 					
					$("#dial_ring_number").html(status_display_number);
					$("#MainStatuSSpan").html("");
					$("#HangupControl").html("<a href=\"javascript:void(0);\" onclick=\"dialedcall_send_hangup();return false;\"><img src=\"./images/vdc_LB_hangupcustomer.gif\" alt=\"挂断本次通话，提交呼叫结果\"></a>");
					$("#hangup_subs").removeClass("btn-disabled").off().on("click",function(){dialedcall_send_hangup();});
				}
				if ((LIVE_campaign_recording == 'ALLCALLS') || (LIVE_campaign_recording == 'ALLFORCE')) {
					all_record = 'YES'
				}
				if ((view_scripts == 1) && (campaign_script.length > 0)) {
					web_form_vars = "&"+$('#vicidial_form').serialize()
											
					+ "&user=" + user 
					+ "&pass=" + pass 
					+ "&campaign=" + campaign 
					+ "&phone_login=" + phone_login 
					+ "&original_phone_login=" + original_phone_login 
					+ "&phone_pass=" + phone_pass 
					+ "&fronter=" + fronter 
					+ "&closer=" + user 
					+ "&group=" + group 
					+ "&channel_group=" + group 
					+ "&SQLdate=" + SQLdate 
					+ "&epoch=" + UnixTime 						 
					+ "&customer_zap_channel=" + lastcustchannel 
					+ "&customer_server_ip=" + lastcustserverip 
					+ "&server_ip=" + server_ip 
					+ "&SIPexten=" + extension 
					+ "&session_id=" + session_id 
					+ "&phone=" + $("#phone_number").val() 
					+ "&parked_by=" + $("#lead_id").val() 
					+ "&dispo=" + LeaDDispO 
					+ "&dialed_number=" + dialed_number 
					+ "&dialed_label=" + dialed_label 
					+ "&source_id=" + source_id 						
					+ "&camp_script=" + campaign_script 
					+ "&in_script=" + CalL_ScripT_id 
					+ "&fullname=" + LOGfullname 
					+ "&recording_filename=" + recording_filename 
					+ "&recording_id=" + recording_id 
					+ "&user_custom_one=" + VU_custom_one 
					+ "&user_custom_two=" + VU_custom_two 
					+ "&user_custom_three=" + VU_custom_three 
					+ "&user_custom_four=" + VU_custom_four 
					+ "&user_custom_five=" + VU_custom_five 
					+ "&preset_number_a=" + CalL_XC_a_NuMber 
					+ "&preset_number_b=" + CalL_XC_b_NuMber 
					+ "&preset_number_c=" + CalL_XC_c_NuMber 
					+ "&preset_number_d=" + CalL_XC_d_NuMber 
					+ "&preset_number_e=" + CalL_XC_e_NuMber 

					+ "&preset_dtmf_a=" + CalL_XC_a_Dtmf 
					+ "&preset_dtmf_b=" + CalL_XC_b_Dtmf 
					+ webform_session;
					
					if ((script_recording_delay > 0) && ((LIVE_campaign_recording == 'ALLCALLS') || (LIVE_campaign_recording == 'ALLFORCE'))) {
						delayed_script_load = 'YES';
						RefresHScript('CLEAR')
					} else {
						load_script_contents()
					}
				}
				if (get_call_launch == 'SCRIPT'||get_call_launch == 'NONE') {
 					load_script_contents();
					//$("#frame_c_WEBFORM").attr("src",TEMP_VDIC_web_form_address);
 				}
				
				if (get_call_launch == 'WEBFORM') {
					//load_script_contents("N");
					$("#WEBFORM_url").val(TEMP_VDIC_web_form_address);
					tab_frame('WEBFORM','y');
				}
				
				if (get_call_launch == 'WEBFORMTWO') {
					//request_tip(TEMP_VDIC_web_form_address_two);
					$("#WEBFORMTWO_url").val(TEMP_VDIC_web_form_address_two);
					tab_frame('WEBFORMTWO','y');
				}
			}
			
		}
	});	
	 
	active_group_alias = '';
	cid_choice = '';
	prefix_choice = '';
	agent_dialed_number = '';
	agent_dialed_type = '';
	CalL_ScripT_id = ''
    
};
// ################################################################################
// Set the client to READY and start looking for calls (VDADready, VDADpause)
function AutoDial_ReSume_PauSe(taskaction, taskagentlog, taskwrapup, taskstatuschange, temp_reason) {
	
    if (taskaction == 'VDADready') {
        VDRP_stage = 'READY';
        if (INgroupCOUNT > 0) {
            if (VICIDiaL_closer_blended == 0) {
                VDRP_stage = 'CLOSER'
            } else {
                VDRP_stage = 'READY'
            }
        }
        AutoDialReady = 1;
        AutoDialWaiting = 1;
        if (dial_method == "INBOUND_MAN"||dial_method== "MANUAL") {			
            auto_dial_level = starting_dial_level;	 			
			set_dial_btn_status("Manual_en");
        } else {            
			set_dial_btn_status("pau_btn_dis");
        }
		
    } else {
        VDRP_stage = 'PAUSED';
        AutoDialReady = 0;
        AutoDialWaiting = 0;
        pause_code_counter = 0;
		
        if (dial_method == "INBOUND_MAN"||dial_method== "MANUAL") {
            auto_dial_level = starting_dial_level;
			set_dial_btn_status("Manual_en");
        } else {
			
 			set_dial_btn_status("Auto_re_en");
        }
		
        if ((agent_pause_codes_active == 'FORCE') && (temp_reason != 'LOGOUT') && (temp_reason != 'REQUEUE') && (temp_reason != 'DIALNEXT') && (CheckDEADcallON != 1)&& (NoneIn_ShowPauseCodeSelect==0)) {
            PauseCodeSelectContent_create()
        }
    }
    
	autoDiaLready_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=" + taskaction + "&user=" + user + "&pass=" + pass + "&stage=" + VDRP_stage + "&agent_log_id=" + agent_log_id + "&agent_log=" + taskagentlog + "&wrapup=" + taskwrapup + "&campaign=" + campaign + "&dial_method=" + dial_method + "&comments=" + taskstatuschange;
         
	$.ajax({
 		url: "vdc_db_query.php",
		data:autoDiaLready_query,
  		success: function(htmls){ 
		
 			var check_dispo = null;
			check_dispo = htmls;
			var check_DS_array = check_dispo.split("\n");
			if (check_DS_array[1] == 'Next agent_log_id:') {
				agent_log_id = check_DS_array[2]
			}
			
		}
	});
	//request_tip(agent_log_id,0);
    return agent_log_id
};

// ################################################################################
// Check to see if there is a call being sent from the auto-dialer to agent conf
function ReChecKCustoMerChaN() {
      
	recheckVDAI_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&campaign=" + campaign + "&ACTION=VDADREcheckINCOMING" + "&agent_log_id=" + agent_log_id + "&lead_id=" + $("#lead_id").val();
	 
    $.ajax({
 		url: "vdc_db_query.php",
		data:recheckVDAI_query,
  		success: function(htmls){ 
		
 			var recheck_incoming = null;
			recheck_incoming = htmls;
			var recheck_VDIC_array = recheck_incoming.split("\n");
			if (recheck_VDIC_array[0] == '1') {
				var reVDIC_data_VDAC = recheck_VDIC_array[1].split("|");
				if (reVDIC_data_VDAC[3] == lastcustchannel) {
				} else {
					$("#callchannel").val(reVDIC_data_VDAC[3]);
					lastcustchannel = reVDIC_data_VDAC[3];
					$("#callserverip").val(reVDIC_data_VDAC[4]);
					lastcustserverip = reVDIC_data_VDAC[4];
					custchannellive = 1
				}
			}
			
		}
	});   
};
// ################################################################################
// pull the script contents sending the webform variables to the script display script
function load_script_contents(is_show) {
     
	if (web_form_vars == "") {
		web_form_vars = "camp_script=" + campaign_script + "&phone_number=13589104688"
	}
	
	NeWscript_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ScrollDIV=1&" + web_form_vars;
	
	$("#SCRIPT_url").val("vdc_script_display_new.php?"+NeWscript_query);
	if(is_show==""){tab_frame('SCRIPT','y');}else{$("#frame_c_SCRIPT").attr("src",$("#SCRIPT_url").val());}
 	 
};
// ################################################################################
// Alternate phone number change
function alt_phone_change(APCphone, APCcount, APCleadID, APCactive) {
    var EAactive_link = '';
    if (APCactive == 'Y') {
		
        EAactive_link = "<a href=\"javascript:void(0);\" onclick=\"alt_phone_change('" + EAphone_number + "','" + EAalt_phone_count + "','" + $("#lead_id").val() + "','N');\">Change this phone number to INACTIVE</a>"
		
    } else {
		
        EAactive_link = "<a href=\"javascript:void(0);\" onclick=\"alt_phone_change('" + EAphone_number + "','" + EAalt_phone_count + "','" + $("#lead_id").val() + "','Y');\">Change this phone number to ACTIVE</a>"
		
    }
    $("#EAcommentsBoxB").html("<strong>活动: </strong>" + EAalt_phone_active + "<BR>" + EAactive_link);
    
 	APC_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&campaign=" + campaign + "&ACTION=alt_phone_change" + "&phone_number=" + APCphone + "&lead_id=" + APCleadID + "&called_count=" + APCcount + "&stage=" + APCactive;
       
	$.ajax({
 		url: "vdc_db_query.php",
		data:APC_query,
  		success: function(){}
	});
};
// ################################################################################
// Check to see if there is a call being sent from the auto-dialer to agent conf
function check_for_auto_incoming() {
     
	all_record = 'NO';
	all_record_count = 0;
	$("#lead_id").val('');
         
	checkVDAI_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&campaign=" + campaign + "&ACTION=VDADcheckINCOMING&agent_log_id=" + agent_log_id;
	
	$.ajax({
		url: "vdc_db_query.php",
		data:checkVDAI_query,
		success: function(htmls){ 
		
			var check_incoming = null;
			check_incoming = htmls;
			var check_VDIC_array = check_incoming.split("\n");
			if (check_VDIC_array[0] == '1') {
				AutoDialWaiting = 0;
				$("#call_status_time,#call_status_list").addClass("focus");
				$("#call_status_hangup").addClass("focus").off().on("click",function(){livehangup_send_hangup(lastcustchannel)});
				$("#call_status_pos").html("正在通话").addClass("focus");				
				
				$("#SecondS").val(0);				
				$("#SecondSDISP").html('00:00:00');	
				
				var VDIC_data_VDAC = check_VDIC_array[1].split("|");
				VDIC_web_form_address = VICIDiaL_web_form_address;
				VDIC_web_form_address_two = VICIDiaL_web_form_address_two;
				var VDIC_fronter = '';
				var VDIC_data_VDIG = check_VDIC_array[2].split("|");
				if (VDIC_data_VDIG[0].length > 5) {
					VDIC_web_form_address = VDIC_data_VDIG[0]
				}
				var VDCL_group_name = VDIC_data_VDIG[1];
				var VDCL_group_color = VDIC_data_VDIG[2];
				var VDCL_fronter_display = VDIC_data_VDIG[3];
				VDCL_group_id = VDIC_data_VDIG[4];
				CalL_ScripT_id = VDIC_data_VDIG[5];
				CalL_AutO_LauncH = VDIC_data_VDIG[6];
				CalL_XC_a_Dtmf = VDIC_data_VDIG[7];
				CalL_XC_a_NuMber = VDIC_data_VDIG[8];
				CalL_XC_b_Dtmf = VDIC_data_VDIG[9];
				CalL_XC_b_NuMber = VDIC_data_VDIG[10];
				if ((VDIC_data_VDIG[11].length > 1) && (VDIC_data_VDIG[11] != '---NONE---')) {
					LIVE_default_xfer_group = VDIC_data_VDIG[11]
				} else {
					LIVE_default_xfer_group = default_xfer_group
				}
				if ((VDIC_data_VDIG[12].length > 1) && (VDIC_data_VDIG[12] != 'DISABLED')) {
					LIVE_campaign_recording = VDIC_data_VDIG[12]
				} else {
					LIVE_campaign_recording = campaign_recording
				}
				if ((VDIC_data_VDIG[13].length > 1) && (VDIC_data_VDIG[13] != 'NONE')) {
					LIVE_campaign_rec_filename = VDIC_data_VDIG[13]
				} else {
					LIVE_campaign_rec_filename = campaign_rec_filename
				}
				if ((VDIC_data_VDIG[14].length > 1) && (VDIC_data_VDIG[14] != 'NONE')) {
					LIVE_default_group_alias = VDIC_data_VDIG[14]
				} else {
					LIVE_default_group_alias = default_group_alias
				}
				if ((VDIC_data_VDIG[15].length > 1) && (VDIC_data_VDIG[15] != 'NONE')) {
					LIVE_caller_id_number = VDIC_data_VDIG[15]
				} else {
					LIVE_caller_id_number = default_group_alias_cid
				}
				if (VDIC_data_VDIG[16].length > 0) {
					LIVE_web_vars = VDIC_data_VDIG[16]
				} else {
					LIVE_web_vars = default_web_vars
				}
				if (VDIC_data_VDIG[17].length > 5) {
					VDIC_web_form_address_two = VDIC_data_VDIG[17]
				}
				var call_timer_action = VDIC_data_VDIG[18];
				if ((call_timer_action == 'NONE') || (call_timer_action.length < 2)) {
					timer_action = campaign_timer_action;
					timer_action_message = campaign_timer_action_message;
					timer_action_seconds = campaign_timer_action_seconds
				} else {
					var call_timer_action_message = VDIC_data_VDIG[19];
					var call_timer_action_seconds = VDIC_data_VDIG[20];
					timer_action = call_timer_action;
					timer_action_message = call_timer_action_message;
					timer_action_seconds = call_timer_action_seconds
				}
				CalL_XC_c_NuMber = VDIC_data_VDIG[21];
				CalL_XC_d_NuMber = VDIC_data_VDIG[22];
				CalL_XC_e_NuMber = VDIC_data_VDIG[23];
				var VDIC_data_VDFR = check_VDIC_array[3].split("|");
				if ((VDIC_data_VDFR[1].length > 1) && (VDCL_fronter_display == 'Y')) {
					VDIC_fronter = "  Fronter: " + VDIC_data_VDFR[0] + " - " + VDIC_data_VDFR[1]
				}
				$("#lead_id").val(VDIC_data_VDAC[0]);
				$("#uniqueid").val(VDIC_data_VDAC[1]);  				
				last_uniqueid = VDIC_data_VDAC[1];
				//up_recording_un(VDIC_data_VDAC[0],VDIC_data_VDAC[1]);
				
				CIDcheck = VDIC_data_VDAC[2];
				CalLCID = VDIC_data_VDAC[2];
				$("#callchannel").val(VDIC_data_VDAC[3]);
				lastcustchannel = VDIC_data_VDAC[3];
				$("#callserverip").val(VDIC_data_VDAC[4]);
				lastcustserverip = VDIC_data_VDAC[4];                        
  					
				VD_live_customer_call = 1;				
				VD_live_call_secondS = 0;
				
				custchannellive = 1;
				LasTCID = check_VDIC_array[4];
				LeaDPreVDispO = check_VDIC_array[6];
				fronter = check_VDIC_array[7];
				$("#vendor_lead_code").val(check_VDIC_array[8]);
				$("#list_id,#last_list_id").val(check_VDIC_array[9]);
				$("#gmt_offset_now").val(check_VDIC_array[10]);
				$("#phone_code").val(check_VDIC_array[11]);
				 
				$("#phone_numberDISP").html(phone_number_format(check_VDIC_array[12]));
					 
				$("#phone_number").val(check_VDIC_array[12]);
				$("#title").val(check_VDIC_array[13]);
				$("#first_name").val(check_VDIC_array[14]);
				$("#middle_initial").val(check_VDIC_array[15]);
				$("#last_name").val(check_VDIC_array[16]);
				$("#address1").val(check_VDIC_array[17]);
				$("#address2").val(check_VDIC_array[18]);
				$("#address3").val(check_VDIC_array[19]);
				$("#city").val(check_VDIC_array[20]);
				$("#state").val(check_VDIC_array[21]);
				$("#province").val(check_VDIC_array[22]);
				$("#postal_code").val(check_VDIC_array[23]);
				$("#country_code").val(check_VDIC_array[24]);
				$("#gender").val(check_VDIC_array[25]);
				$("#date_of_birth").val(check_VDIC_array[26]);
				$("#alt_phone").val(check_VDIC_array[27]);
				$("#email").val(check_VDIC_array[28]);
				$("#security_phrase").val(check_VDIC_array[29]);
				var REGcommentsNL = new RegExp("!N", "g");
				check_VDIC_array[30] = check_VDIC_array[30].replace(REGcommentsNL, "\n");
				$("#comments").val(check_VDIC_array[30]);
				$("#called_count").val(check_VDIC_array[31]);
				CBentry_time = check_VDIC_array[32];
				CBcallback_time = check_VDIC_array[33];
				CBuser = check_VDIC_array[34];
				CBcomments = check_VDIC_array[35];
				dialed_number = check_VDIC_array[36];
				dialed_label = check_VDIC_array[37];
				source_id = check_VDIC_array[38];
				EAphone_code = check_VDIC_array[39];
				EAphone_number = check_VDIC_array[40];
				EAalt_phone_notes = check_VDIC_array[41];
				EAalt_phone_active = check_VDIC_array[42];
				EAalt_phone_count = check_VDIC_array[43];
				$("#rank").val(check_VDIC_array[44]);
				$("#owner").val(check_VDIC_array[45]);
				script_recording_delay = check_VDIC_array[46];
				 
				lead_dial_number = $("#phone_number").val();
				var dispnum = $("#phone_number").val();
				var status_display_number = phone_number_format(dispnum);
				var callnum = dialed_number;
				var dial_display_number = status_display_number;
				
				if (alert_enabled == 'ON') { 
					request_tip(" 进线提醒: " + dialed_number,1);
					//document.getElementById("wav_player").Filename="./alert_enabled.wav";
					//$("#wav_player_wmp").attr("src","./alert_enabled.wav");					
				}
				 
				//$("#MainStatuSSpan").html("自动用户ID: <span class=\"blue_f\">" + CIDcheck + "</span> 正在呼叫: <span class=\"red_f\">" + dial_display_number + "</span>  &nbsp; " + VDIC_fronter);
				
				if (LeaDPreVDispO == 'CALLBK') {
					$("#CusTInfOSpaN").html(" <strong> 上次回呼 </strong>");
					$("#CusTInfOSpaN").css("background",CusTCB_bgcolor);
					$("#CBcommentsBoxA").html("<strong>上次呼叫: </strong>" + CBentry_time);
					$("#CBcommentsBoxB").html("<strong>回呼: </strong>" + CBcallback_time);
					$("#CBcommentsBoxC").html("<strong>工号: </strong>" + CBuser);
					$("#CBcommentsBoxD").html("<strong>描述: </strong><br>" + CBcomments);
					showDiv('CBcommentsBox')
				}
				if (dialed_label == 'ALT') {
					$("#CusTInfOSpaN").html(" <strong> 备用电话: 备用 </strong>")
				}
				if (dialed_label == 'ADDR3') {
					$("#CusTInfOSpaN").html(" <strong> 备用电话: 地址3 </strong>")
				}
				var REGalt_dial = new RegExp("X", "g");
				if (dialed_label.match(REGalt_dial)) {
					$("#CusTInfOSpaN").html(" <strong> 备用电话: " + dialed_label + "</strong>");
					$("#EAcommentsBoxA").html("<strong>区号和电话: </strong>" + EAphone_code + " " + EAphone_number);
					var EAactive_link = '';
					if (EAalt_phone_active == 'Y') {
						EAactive_link = "<a href=\"javascript:void(0);\" onclick=\"alt_phone_change('" + EAphone_number + "','" + EAalt_phone_count + "','" + $("#lead_id").val() + "','N');\">将号码设为不活动</a>"
					} else {
						EAactive_link = "<a href=\"javascript:void(0);\" onclick=\"alt_phone_change('" + EAphone_number + "','" + EAalt_phone_count + "','" + $("#lead_id").val() + "','Y');\">将号码设为活动</a>"
					}
					$("#EAcommentsBoxB").html("<strong>活动: </strong>" + EAalt_phone_active + "<BR>" + EAactive_link);
					$("#EAcommentsBoxC").html("<strong>备用次数: </strong>" + EAalt_phone_count);
					$("#EAcommentsBoxD").html("<strong>备注: </strong>" + EAalt_phone_notes);
					showDiv('EAcommentsBox')
				}
				if (VDIC_data_VDIG[1].length > 0) {
					inOUT = 'IN';
					if (VDIC_data_VDIG[2].length > 2) {
						//$("#MainStatuSSpan").css("background",VDIC_data_VDIG[2])
					}
					var dispnum = $("#phone_number").val();
					var status_display_number = phone_number_format(dispnum);
					var callnum = dialed_number;
					var dial_display_number = phone_number_format(callnum);
					$("#MainStatuSSpan").html(" 坐席组- " + VDIC_data_VDIG[1] + "正在呼叫: <span class=\"red_f\">" + dial_display_number + "</span>  &nbsp; " + VDIC_fronter)
				}
				$("#ParkControl").html("<a href=\"javascript:void(0);\" onclick=\"mainxfer_send_redirect('ParK','" + lastcustchannel + "','" + lastcustserverip + "');\"><img src=\"./images/vdc_LB_parkcall.gif\" alt=\"电话保持\"></a>");
				
				$("#HangupControl").html("<a href=\"javascript:void(0);\" onclick=\"dialedcall_send_hangup();\"><img src=\"./images/vdc_LB_hangupcustomer.gif\" alt=\"挂断本次通话，提交呼叫结果\"></a>");
				
				
				$("#hangup_subs").removeClass("btn-disabled").off().on("click",function(){dialedcall_send_hangup();});
				$("#XferControl").html("<a href=\"javascript:void(0);\" ><img src=\"./images/vdc_LB_transferconf.gif\" alt=\"会议 - 转接\"></a>");//onclick=\"ShoWTransferMain('ON');\"
				
				$("#LocalCloser").html("<a href=\"javascript:void(0);\" onclick=\"mainxfer_send_redirect('XfeRLOCAL','" + lastcustchannel + "','" + lastcustserverip + "');\"><img src=\"./images/vdc_XB_localcloser.gif\" alt=\"本地呼入组\" style=\"vertical-align:middle\"></a>");
				
				$("#DialBlindTransfer").html("<a href=\"javascript:void(0);\" onclick=\"mainxfer_send_redirect('XfeRBLIND','" + lastcustchannel + "','" + lastcustserverip + "');\"><img src=\"./images/vdc_XB_blindtransfer.gif\" alt=\"盲转\" style=\"vertical-align:middle\"></a>");
				
				$("#DialBlindVMail").html("<a href=\"javascript:void(0);\" onclick=\"mainxfer_send_redirect('XfeRVMAIL','" + lastcustchannel + "','" + lastcustserverip + "');\"><img src=\"./images/vdc_XB_ammessage.gif\" alt=\"Blind Transfer VMail Message\" style=\"vertical-align:middle\"></a>");
				
				if (quick_transfer_button == 'IN_GROUP') {
					$("#QuickXfer").html("<a href=\"javascript:void(0);\" onclick=\"mainxfer_send_redirect('XfeRLOCAL','" + lastcustchannel + "','" + lastcustserverip + "');\"><img src=\"./images/vdc_LB_quickxfer.gif\" alt=\"QUICK TRANSFER\"></a>")
				}
				if (prepopulate_transfer_preset_enabled > 0) {
					if (prepopulate_transfer_preset == 'PRESET_1') {
						$("#xfernumber").val(CalL_XC_a_NuMber)
					}
					if (prepopulate_transfer_preset == 'PRESET_2') {
						$("#xfernumber").val(CalL_XC_b_NuMber)
					}
					if (prepopulate_transfer_preset == 'PRESET_3') {
						$("#xfernumber").val(CalL_XC_c_NuMber)
					}
					if (prepopulate_transfer_preset == 'PRESET_4') {
						$("#xfernumber").val(CalL_XC_d_NuMber)
					}
					if (prepopulate_transfer_preset == 'PRESET_5') {
						$("#xfernumber").val(CalL_XC_e_NuMber)
					}
				}
				if ((quick_transfer_button == 'PRESET_1') || (quick_transfer_button == 'PRESET_2') || (quick_transfer_button == 'PRESET_3') || (quick_transfer_button == 'PRESET_4') || (quick_transfer_button == 'PRESET_5')) {
					$("#QuickXfer").html("<a href=\"javascript:void(0);\" onclick=\"mainxfer_send_redirect('XfeRBLIND','" + lastcustchannel + "','" + lastcustserverip + "');\"><img src=\"./images/vdc_LB_quickxfer.gif\" alt=\"QUICK TRANSFER\"></a>");
					if (quick_transfer_button == 'PRESET_1') {
						$("#xfernumber").val(CalL_XC_a_NuMber)
					}
					if (quick_transfer_button == 'PRESET_2') {
						$("#xfernumber").val(CalL_XC_b_NuMber)
					}
					if (quick_transfer_button == 'PRESET_3') {
						$("#xfernumber").val(CalL_XC_c_NuMber)
					}
					if (quick_transfer_button == 'PRESET_4') {
						$("#xfernumber").val(CalL_XC_d_NuMber)
					}
					if (quick_transfer_button == 'PRESET_5') {
						$("#xfernumber").val(CalL_XC_e_NuMber)
					}
				}
				if (call_requeue_button > 0) {
					var CloserSelectChoices = $("#CloserSelectList").val();
					var regCRB = new RegExp("AGENTDIRECT", "ig");
					if ((CloserSelectChoices.match(regCRB)) || (VU_closer_campaigns.match(regCRB))) {
						$("#ReQueueCall").html("<a href=\"javascript:void(0);\" onclick=\"call_requeue_launch();\"><img src=\"./images/vdc_LB_requeue_call.gif\" alt=\"Re-Queue Call\"></a>")
					} else {
						$("#ReQueueCall").html("<img src=\"./images/vdc_LB_requeue_call_OFF.gif\" alt=\"Re-Queue Call\">")
					}
				}
				var loop_ct = 0;
				var live_XfeR_HTML = '';
				var XfeR_SelecT = '';
				while (loop_ct < XFgroupCOUNT) {
					if (VARxfergroups[loop_ct] == LIVE_default_xfer_group) {
						XfeR_SelecT = 'selected '
					} else {
						XfeR_SelecT = ''
					}
					live_XfeR_HTML = live_XfeR_HTML + "<option " + XfeR_SelecT + "value=\"" + VARxfergroups[loop_ct] + "\">" + VARxfergroups[loop_ct] + " - " + VARxfergroupsnames[loop_ct] + "</option>\n";
					loop_ct++
				}
				$("#XfeRGrouPLisT").html("<select size=1 name=XfeRGrouP  id=XfeRGrouP onChange=\"XferAgentSelectLink();return false;\">" + live_XfeR_HTML + "</select>");
				
				if (lastcustserverip == server_ip) {
					
					 
					$("#VolumeUpSpan").addClass("focus").off().on("click",function(){volume_control('UP',lastcustchannel,'');});
					 
					$("#VolumeDownSpan").addClass("focus").off().on("click",function(){volume_control('DOWN',lastcustchannel,'');});
				}
				if (dial_method == "INBOUND_MAN"||dial_method== "MANUAL") {
					
					set_dial_btn_status("show_next_btn_dis");
				} else {
 					
					set_dial_btn_status("show_auto_btn_dis");
 				}
				set_dial_btn_status("dis_all_btn");
				
				if (VDCL_group_id.length > 1) {
					var group = VDCL_group_id
				} else {
					var group = campaign
				}
				if ((dialed_label.length < 2) || (dialed_label == 'NONE')) {
					dialed_label = 'MAIN'
				} 
				LeaDDispO = '';
			 
				web_form_vars = "&"+$('#vicidial_form').serialize() 
				
				+ "&user=" + user 
				+ "&pass=" + pass 
				+ "&campaign=" + campaign 
				+ "&phone_login=" + phone_login 
				+ "&original_phone_login=" + original_phone_login 
				+ "&phone_pass=" + phone_pass 
				+ "&fronter=" + fronter 
				+ "&closer=" + user 
				+ "&group=" + group 
				+ "&channel_group=" + group 
				+ "&SQLdate=" + SQLdate 
				+ "&epoch=" + UnixTime 
				
				+ "&customer_zap_channel=" + lastcustchannel 
				+ "&customer_server_ip=" + lastcustserverip 
				+ "&server_ip=" + server_ip 
				+ "&SIPexten=" + extension 
				+ "&session_id=" + session_id 
				+ "&phone=" + $("#phone_number").val() 
				+ "&parked_by=" + $("#lead_id").val() 
				+ "&dispo=" + LeaDDispO 
				+ "&dialed_number=" + dialed_number 
				+ "&dialed_label=" + dialed_label 
				+ "&source_id=" + source_id  
				
				+ "&camp_script=" + campaign_script 
				+ "&in_script=" + CalL_ScripT_id 
				+ "&fullname=" + LOGfullname 
				+ "&recording_filename=" + recording_filename 
				+ "&recording_id=" + recording_id 
				+ "&user_custom_one=" + VU_custom_one 
				+ "&user_custom_two=" + VU_custom_two 
				+ "&user_custom_three=" + VU_custom_three 
				+ "&user_custom_four=" + VU_custom_four 
				+ "&user_custom_five=" + VU_custom_five 
				+ "&preset_number_a=" + CalL_XC_a_NuMber 
				+ "&preset_number_b=" + CalL_XC_b_NuMber 
				+ "&preset_number_c=" + CalL_XC_c_NuMber 
				+ "&preset_number_d=" + CalL_XC_d_NuMber 
				+ "&preset_number_e=" + CalL_XC_e_NuMber 
				+ "&preset_dtmf_a=" + CalL_XC_a_Dtmf 
				+ "&preset_dtmf_b=" + CalL_XC_b_Dtmf 
				+ webform_session;
				
				var regWFAvars = new RegExp("\\?", "ig");
				if (VDIC_web_form_address.match(regWFAvars)) {
					web_form_vars = '&' + web_form_vars
				} else {
					web_form_vars = '?' + web_form_vars
				}
				TEMP_VDIC_web_form_address = VDIC_web_form_address + "" + web_form_vars;
				var regWFAqavars = new RegExp("\\?&", "ig");
				var regWFAaavars = new RegExp("&&", "ig");
				TEMP_VDIC_web_form_address = TEMP_VDIC_web_form_address.replace(regWFAqavars, '?');
				TEMP_VDIC_web_form_address = TEMP_VDIC_web_form_address.replace(regWFAaavars, '&')
			 
				if (VDIC_web_form_address_two.match(regWFAvars)) {
					web_form_vars_two = '&' + web_form_vars
				} else {
					web_form_vars_two = '?' + web_form_vars
				}
				TEMP_VDIC_web_form_address_two = VDIC_web_form_address_two + "" + web_form_vars_two;
				var regWFAqavars = new RegExp("\\?&", "ig");
				var regWFAaavars = new RegExp("&&", "ig");
				TEMP_VDIC_web_form_address_two = TEMP_VDIC_web_form_address_two.replace(regWFAqavars, '?');
				TEMP_VDIC_web_form_address_two = TEMP_VDIC_web_form_address_two.replace(regWFAaavars, '&');
				
				 
				$("#WebFormSpan").html("<a href=\"javascript:void(0)\" onclick=\"tab_frame('WEBFORM');\"><img src=\"./images/vdc_LB_webform.gif\" alt=\"网页表单\"></a>\n");
				
				/*if (enable_second_webform > 0) {
					web_form_vars_two = "&"+$('#vicidial_form').serialize()
				 
					+ "&user=" + user 
					+ "&pass=" + pass 
					+ "&campaign=" + campaign 
					+ "&phone_login=" + phone_login 
					+ "&original_phone_login=" + original_phone_login 
					+ "&phone_pass=" + phone_pass 
					+ "&fronter=" + fronter 
					+ "&closer=" + user 
					+ "&group=" + group 
					+ "&channel_group=" + group 
					+ "&SQLdate=" + SQLdate 
					+ "&epoch=" + UnixTime 
					+ "&customer_zap_channel=" + lastcustchannel 
					+ "&customer_server_ip=" + lastcustserverip 
					+ "&server_ip=" + server_ip 
					+ "&SIPexten=" + extension 
					+ "&session_id=" + session_id 
					+ "&phone=" + $("#phone_number").val() 
					+ "&parked_by=" + $("#lead_id").val() 
					+ "&dispo=" + LeaDDispO + "&dialed_number=" + dialed_number 
					+ "&dialed_label=" + dialed_label 
					+ "&source_id=" + source_id 
					+ "&camp_script=" + campaign_script 
					+ "&in_script=" + CalL_ScripT_id 
					+ "&fullname=" + LOGfullname 
					+ "&recording_filename=" + recording_filename 
					+ "&recording_id=" + recording_id 
					+ "&user_custom_one=" + VU_custom_one 
					+ "&user_custom_two=" + VU_custom_two 
					+ "&user_custom_three=" + VU_custom_three 
					+ "&user_custom_four=" + VU_custom_four 
					+ "&user_custom_five=" + VU_custom_five 
					+ "&preset_number_a=" + CalL_XC_a_NuMber 
					+ "&preset_number_b=" + CalL_XC_b_NuMber 
					+ "&preset_number_c=" + CalL_XC_c_NuMber 
					+ "&preset_number_d=" + CalL_XC_d_NuMber 
					+ "&preset_number_e=" + CalL_XC_e_NuMber 
					+ "&preset_dtmf_a=" + CalL_XC_a_Dtmf 
					+ "&preset_dtmf_b=" + CalL_XC_b_Dtmf 
					+ webform_session;
 					
					var regWFAvars = new RegExp("\\?", "ig");
					if (VDIC_web_form_address_two.match(regWFAvars)) {
						web_form_vars_two = '&' + web_form_vars_two
					} else {
						web_form_vars_two = '?' + web_form_vars_two
					}
					TEMP_VDIC_web_form_address_two = VDIC_web_form_address_two + "" + web_form_vars_two;
					var regWFAqavars = new RegExp("\\?&", "ig");
					var regWFAaavars = new RegExp("&&", "ig");
					TEMP_VDIC_web_form_address_two = TEMP_VDIC_web_form_address_two.replace(regWFAqavars, '?');
					TEMP_VDIC_web_form_address_two = TEMP_VDIC_web_form_address_two.replace(regWFAaavars, '&')
				 
					$("#WebFormSpanTwo").html("<a href=\"javascript:void(0)\" onclick=\"tab_frame('WEBFORMTWO');\"><img src=\"./images/vdc_LB_webform_two.gif\" alt=\"网页表单二\"></a>\n");
					
				}*/
				
				if ((LIVE_campaign_recording == 'ALLCALLS') || (LIVE_campaign_recording == 'ALLFORCE')) {
					all_record = 'YES'
				}
				if ((view_scripts == 1) && (CalL_ScripT_id.length > 0)) {
					
					web_form_vars = "&"+$('#vicidial_form').serialize() 
					
					+ "&user=" + user 
					+ "&pass=" + pass 
					+ "&campaign=" + campaign 
					+ "&phone_login=" + phone_login 
					+ "&original_phone_login=" + original_phone_login 
					+ "&phone_pass=" + phone_pass 
					+ "&fronter=" + fronter 
					+ "&closer=" + user 
					+ "&group=" + group 
					+ "&channel_group=" + group 
					+ "&SQLdate=" + SQLdate 
					+ "&epoch=" + UnixTime 
					+ "&customer_zap_channel=" + lastcustchannel 
					+ "&customer_server_ip=" + lastcustserverip 
					+ "&server_ip=" + server_ip 
					+ "&SIPexten=" + extension 
					+ "&session_id=" + session_id 
					+ "&phone=" + $("#phone_number").val() 
					+ "&parked_by=" + $("#lead_id").val() 
					+ "&dispo=" + LeaDDispO 
					+ "&dialed_number=" + dialed_number 
					+ "&dialed_label=" + dialed_label 
					+ "&source_id=" + source_id 
					+ "&camp_script=" + campaign_script 
					+ "&in_script=" + CalL_ScripT_id 
					+ "&fullname=" + LOGfullname 
					+ "&recording_filename=" + recording_filename 
					+ "&recording_id=" + recording_id 
					+ "&user_custom_one=" + VU_custom_one 
					+ "&user_custom_two=" + VU_custom_two 
					+ "&user_custom_three=" + VU_custom_three 
					+ "&user_custom_four=" + VU_custom_four 
					+ "&user_custom_five=" + VU_custom_five 
					+ "&preset_number_a=" + CalL_XC_a_NuMber 
					+ "&preset_number_b=" + CalL_XC_b_NuMber 
					+ "&preset_number_c=" + CalL_XC_c_NuMber 
					+ "&preset_number_d=" + CalL_XC_d_NuMber  
					+ "&preset_number_e=" + CalL_XC_e_NuMber 
					+ "&preset_dtmf_a=" + CalL_XC_a_Dtmf 
					+ "&preset_dtmf_b=" + CalL_XC_b_Dtmf 
					+ webform_session;
 				}
				
				if (CalL_AutO_LauncH == 'SCRIPT'||CalL_AutO_LauncH == 'NONE') {
 					load_script_contents();
 	
					/*if($("#frame_c_WEBFORM").length<1){
						$("#tab_content").append("<iframe id='frame_c_WEBFORM' width='100%' frameborder='0' ></iframe>");			
					}
					$("#frame_c_WEBFORM").attr("src",TEMP_VDIC_web_form_address);*/
 				}
 				
				if (CalL_AutO_LauncH == 'WEBFORM') {
					//load_script_contents("N");
					$("#WEBFORM_url").val(TEMP_VDIC_web_form_address);
					tab_frame('WEBFORM','y');
				}
				if (CalL_AutO_LauncH == 'WEBFORMTWO') {
					$("#WEBFORMTWO_url").val(TEMP_VDIC_web_form_address_two);
					tab_frame('WEBFORMTWO','y');
				}
				if ((CopY_tO_ClipboarD != 'NONE') && (useIE > 0)) {
					var tmp_clip = $("#"+CopY_tO_ClipboarD).val();
					window.clipboardData.setData('Text',tmp_clip)
				}
				
			} else {}
			
		}
	});
     
};

// ################################################################################
// refresh or clear the SCRIPT frame contents
function RefresHScript(temp_wipe) {
    if (temp_wipe == 'CLEAR') {
        $("#ScriptContents").html('')
    } else {
        $("#ScriptContents").html('');
        WebFormRefresH('', '', '1');
        load_script_contents()

    }
};
// ################################################################################
// refresh the content of the 网页表单 URL
function WebFormRefresH(taskrefresh, submittask, force_webvars_refresh) {
    var webvars_refresh = 0;
    if (VDCL_group_id.length > 1) {
        var group = VDCL_group_id
    } else {
        var group = campaign
    }
    if ((dialed_label.length < 2) || (dialed_label == 'NONE')) {
        dialed_label = 'MAIN'
    }
     
        webvars_refresh = 1
    
    if ((webvars_refresh > 0) || (force_webvars_refresh > 0)) {
		
        web_form_vars = "&"+$('#vicidial_form').serialize()
 		 
		+ "&user=" + user 
		+ "&pass=" + pass 
		+ "&campaign=" + campaign 
		+ "&phone_login=" + phone_login 
		+ "&original_phone_login=" + original_phone_login 
		+ "&phone_pass=" + phone_pass 
		+ "&fronter=" + fronter 
		+ "&closer=" + user 
		+ "&group=" + group 
		+ "&channel_group=" + group 
		+ "&SQLdate=" + SQLdate 
		+ "&epoch=" + UnixTime 
		 
		+ "&customer_zap_channel=" + lastcustchannel 
		+ "&customer_server_ip=" + lastcustserverip 
		+ "&server_ip=" + server_ip 
		+ "&SIPexten=" + extension 
		+ "&session_id=" + session_id 
		+ "&phone=" + $("#phone_number").val() 
		+ "&parked_by=" + $("#lead_id").val() 
		+ "&dispo=" + LeaDDispO 
		+ "&dialed_number=" + dialed_number 
		+ "&dialed_label=" + dialed_label 
		+ "&source_id=" + source_id 
		 
		+ "&camp_script=" + campaign_script 
		+ "&in_script=" + CalL_ScripT_id 
		+ "&fullname=" + LOGfullname 
		+ "&recording_filename=" + recording_filename 
		+ "&recording_id=" + recording_id 
		+ "&user_custom_one=" + VU_custom_one 
		+ "&user_custom_two=" + VU_custom_two 
		+ "&user_custom_three=" + VU_custom_three 
		+ "&user_custom_four=" + VU_custom_four 
		+ "&user_custom_five=" + VU_custom_five 
		+ "&preset_number_a=" + CalL_XC_a_NuMber 
		+ "&preset_number_b=" + CalL_XC_b_NuMber 
		+ "&preset_number_c=" + CalL_XC_c_NuMber 
		+ "&preset_number_d=" + CalL_XC_d_NuMber 
		+ "&preset_number_e=" + CalL_XC_e_NuMber 
		+ "&preset_dtmf_a=" + CalL_XC_a_Dtmf 
		+ "&preset_dtmf_b=" + CalL_XC_b_Dtmf 
		+ webform_session;
		
        
        var regWFAvars = new RegExp("\\?", "ig");
        if (VDIC_web_form_address.match(regWFAvars)) {
            web_form_vars = '&' + web_form_vars
        } else {
            web_form_vars = '?' + web_form_vars
        }
        TEMP_VDIC_web_form_address = VDIC_web_form_address + "" + web_form_vars;
        var regWFAqavars = new RegExp("\\?&", "ig");
        var regWFAaavars = new RegExp("&&", "ig");
        TEMP_VDIC_web_form_address = TEMP_VDIC_web_form_address.replace(regWFAqavars, '?');
        TEMP_VDIC_web_form_address = TEMP_VDIC_web_form_address.replace(regWFAaavars, '&')
    }
     
		$("#WebFormSpan").html("<a href=\"javascript:void(0)\" onclick=\"tab_frame('WEBFORM');\"><img src=\"./images/vdc_LB_webform.gif\" alt=\"网页表单\"></a>\n")
		
     
};
// ################################################################################
// refresh the content of the second 网页表单 URL
function WebFormTwoRefresH(taskrefresh, submittask) {
    if (VDCL_group_id.length > 1) {
        var group = VDCL_group_id
    } else {
        var group = campaign
    }
    if ((dialed_label.length < 2) || (dialed_label == 'NONE')) {
        dialed_label = 'MAIN'
    }
     
     
        web_form_vars_two = "&"+$('#vicidial_form').serialize()
		 
		  
		+ "&user=" + user 
		+ "&pass=" + pass 
		+ "&campaign=" + campaign 
		+ "&phone_login=" + phone_login 
		+ "&original_phone_login=" + original_phone_login 
		+ "&phone_pass=" + phone_pass 
		+ "&fronter=" + fronter 
		+ "&closer=" + user 
		+ "&group=" + group 
		+ "&channel_group=" + group 
		+ "&SQLdate=" + SQLdate 
		+ "&epoch=" + UnixTime 
		+ "&customer_zap_channel=" + lastcustchannel 
		+ "&customer_server_ip=" + lastcustserverip 
		+ "&server_ip=" + server_ip 
		+ "&SIPexten=" + extension 
		+ "&session_id=" + session_id 
		+ "&phone=" + $("#phone_number").val() 
		+ "&parked_by=" + $("#lead_id").val() 
		+ "&dispo=" + LeaDDispO 
		+ "&dialed_number=" + dialed_number 
		+ "&dialed_label=" + dialed_label 
		+ "&source_id=" + source_id 
	
		+ "&camp_script=" + campaign_script 
		+ "&in_script=" + CalL_ScripT_id 
		+ "&fullname=" + LOGfullname 
		+ "&recording_filename=" + recording_filename 
		+ "&recording_id=" + recording_id 
		+ "&user_custom_one=" + VU_custom_one 
		+ "&user_custom_two=" + VU_custom_two 
		+ "&user_custom_three=" + VU_custom_three 
		+ "&user_custom_four=" + VU_custom_four 
		+ "&user_custom_five=" + VU_custom_five 
		+ "&preset_number_a=" + CalL_XC_a_NuMber 
		+ "&preset_number_b=" + CalL_XC_b_NuMber 
		+ "&preset_number_c=" + CalL_XC_c_NuMber 
		+ "&preset_number_d=" + CalL_XC_d_NuMber 
		+ "&preset_number_e=" + CalL_XC_e_NuMber 
		+ "&preset_dtmf_a=" + CalL_XC_a_Dtmf 
		+ "&preset_dtmf_b=" + CalL_XC_b_Dtmf 
		+ webform_session;
		
        
        var regWFAvars = new RegExp("\\?", "ig");
        if (VDIC_web_form_address_two.match(regWFAvars)) {
            web_form_vars_two = '&' + web_form_vars_two
        } else {
            web_form_vars_two = '?' + web_form_vars_two
        }
        TEMP_VDIC_web_form_address_two = VDIC_web_form_address_two + "" + web_form_vars_two;
        var regWFAqavars = new RegExp("\\?&", "ig");
        var regWFAaavars = new RegExp("&&", "ig");
        TEMP_VDIC_web_form_address_two = TEMP_VDIC_web_form_address_two.replace(regWFAqavars, '?');
        TEMP_VDIC_web_form_address_two = TEMP_VDIC_web_form_address_two.replace(regWFAaavars, '&')
    //}
    if (enable_second_webform > 0) {
        if (taskrefresh == 'OUT') {
			
 			$("#WebFormSpanTwo").html("<a href=\"javascript:void(0)\" onclick=\"tab_frame('WEBFORM');\"><img src=\"./images/vdc_LB_webform_two.gif\" alt=\"网页表单二\"></a>\n")
        } else {
			
 			$("#WebFormSpanTwo").html("<a href=\"javascript:void(0)\" onclick=\"tab_frame('WEBFORMTWO');\"><img src=\"./images/vdc_LB_webform_two.gif\" alt=\"网页表单二\"></a>\n")
        }
    }
};
// ################################################################################
// Send hangup a second time from the dispo screen 
function DispoHanguPAgaiN() {
    form_cust_channel = AgaiNHanguPChanneL;
    $("#callchannel").val(AgaiNHanguPChanneL);
    $("#callserverip").val(AgaiNHanguPServeR);
    lastcustchannel = AgaiNHanguPChanneL;
    lastcustserverip = AgaiNHanguPServeR;
    VD_live_call_secondS = AgainCalLSecondS;
    CalLCID = AgaiNCalLCID;
    $("#DispoSelectHAspan").html("");
    dialedcall_send_hangup()
};

// ################################################################################
// Send leave 3way call a second time from the dispo screen 
function DispoLeavE3wayAgaiN() {
    XDchannel = DispO3wayXtrAchannel;
    $("#xfernumber").val(DispO3wayCalLxfernumber);
    MDchannel = DispO3waychannel;
    lastcustserverip = DispO3wayCalLserverip;
    $("#DispoSelectHAspan").html("");
    leave_3way_call('SECOND');
    DispO3waychannel = '';
    DispO3wayXtrAchannel = '';
    DispO3wayCalLserverip = '';
    DispO3wayCalLxfernumber = '';
    DispO3wayCalLcamptail = ''
};

// ################################################################################
// Start Hangup Functions for both 
function bothcall_send_hangup() {
    if (lastcustchannel.length > 3) {
        dialedcall_send_hangup()
    }
    if (lastxferchannel.length > 3) {
        xfercall_send_hangup()
    }
};
 

// ################################################################################
// Send Hangup command for customer call connected to the conference now to Manager
function dialedcall_send_hangup(dispowindow, hotkeysused, altdispo, nodeletevdac) {
    if (VDCL_group_id.length > 1) {
        var group = VDCL_group_id
    } else {
        var group = campaign
    }
    var form_cust_channel = $("#callchannel").val();
    var form_cust_serverip = $("#callserverip").val();
    var customer_channel = lastcustchannel;
    var customer_server_ip = lastcustserverip;
    AgaiNHanguPChanneL = lastcustchannel;
    AgaiNHanguPServeR = lastcustserverip;
    AgainCalLSecondS = VD_live_call_secondS;
    AgaiNCalLCID = CalLCID;
    var process_post_hangup = 0;
    if ((RedirecTxFEr < 1) && ((MD_channel_look == 1) || (auto_dial_level == 0))) {
        MD_channel_look = 0;
        DialTimeHangup('MAIN');
    }
    if (form_cust_channel.length > 3) {
         
		var queryCID = "HLvdcW" + epoch_sec + user_abb;
		var hangupvalue = customer_channel;
		custhangup_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=Hangup&format=text&user=" + user + "&pass=" + pass + "&channel=" + hangupvalue + "&call_server_ip=" + customer_server_ip + "&queryCID=" + queryCID + "&auto_dial_level=" + auto_dial_level + "&CalLCID=" + CalLCID + "&secondS=" + VD_live_call_secondS + "&exten=" + session_id + "&campaign=" + group + "&stage=CALLHANGUP&nodeletevdac=" + nodeletevdac;
		 
		$.ajax({
			url: "manager_send.php",
			data:custhangup_query,
			success: function(){}
		});	
		process_post_hangup = 1;
         
    } else {
        process_post_hangup = 1
    }
	
    if (process_post_hangup == 1) {
        VD_live_customer_call = 0;
        VD_live_call_secondS = 0;
        MD_ring_secondS = 0;
        CalLCID = '';
        MDnextCID = '';
        DialLog("end", nodeletevdac);
        conf_dialed = 0;
        if (dispowindow == 'NO') {
            open_dispo_screen = 0
        } else {
            if (auto_dial_level == 0) {
                if ($("#DiaLAltPhonE").is(":checked") == true) {
                    reselect_alt_dial = 1;
                    open_dispo_screen = 0
                } else {
                    reselect_alt_dial = 0;
                    open_dispo_screen = 1
                }
            } else {
                if ($("#DiaLAltPhonE").is(":checked") == true) {
                    reselect_alt_dial = 1;
                    open_dispo_screen = 0;
                    auto_dial_level = 0;
                    manual_dial_in_progress = 1;
                    auto_dial_alt_dial = 1
                } else {
                    reselect_alt_dial = 0;
                    open_dispo_screen = 1
                }
            }
        }
        $("#callchannel").val('');
        $("#callserverip").val('');
        lastcustchannel = '';
        lastcustserverip = '';
        MDchannel = '';
 		
        $("#WebFormSpan").html("<img src=\"./images/vdc_LB_webform_OFF.gif\" alt=\"网页表单\">");
        if (enable_second_webform > 0) {
            $("#WebFormSpanTwo").html("<img src=\"./images/vdc_LB_webform_two_OFF.gif\" alt=\"网页表单二\">")
        }
        $("#ParkControl").html("<img src=\"./images/vdc_LB_parkcall_OFF.gif\" alt=\"电话保持\">");
        $("#HangupControl").html("<img src=\"./images/vdc_LB_hangupcustomer_OFF.gif\" alt=\"挂断本次通话，提交呼叫结果\">");
		
        //$("#hangup_subs").html("<a href='javascript:void(0);' class='zPushBtn zPushBtnDisabled'  onselectstart='return false' title='挂断本次通话，提交呼叫结果' ><img src='/img/icons/icon004a3.gif' /><b>挂机提交&nbsp;</b></a>");
		$("#hangup_subs").addClass("btn-disabled").off();
        $("#XferControl").html("<img src=\"./images/vdc_LB_transferconf_OFF.gif\" alt=\"会议 - 转接\">");
        //$("#LocalCloser").html("<img src=\"./images/vdc_XB_localcloser_OFF.gif\" alt=\"本地呼入组\" style=\"vertical-align:middle\">");
        //$("#DialBlindTransfer").html("<img src=\"./images/vdc_XB_blindtransfer_OFF.gif\" alt=\"盲转\" style=\"vertical-align:middle\">");
        //$("#DialBlindVMail").html("<img src=\"./images/vdc_XB_ammessage_OFF.gif\" alt=\"盲转语音邮箱\" style=\"vertical-align:middle\">");
        //$("#VolumeUpSpan").html("<img src=\"./images/vdc_volume_up_off.gif\" BORDER=0>");
        //$("#VolumeDownSpan").html("<img src=\"./images/vdc_volume_down_off.gif\" BORDER=0>");
		
		$("#VolumeUpSpan,#VolumeDownSpan").removeClass("focus").off();
 		
        if (quick_transfer_button_enabled > 0) {
            $("#QuickXfer").html("<img src=\"./images/vdc_LB_quickxfer_OFF.gif\" alt=\"快速转接\">")
        }
        if (call_requeue_button > 0) {
            $("#ReQueueCall").html("<img src=\"./images/vdc_LB_requeue_call_OFF.gif\" alt=\"重派到队列\">")
        }
        $("#custdatetime").val('');
		
        if ((auto_dial_level == 0) && (dial_method != 'INBOUND_MAN')) {
            if ($("#DiaLAltPhonE").is(":checked") == true) {
                reselect_alt_dial = 1;
                if (altdispo == 'ALTPH2') {
                    ManualDialOnly('ALTPhonE')
                } else {
                    if (altdispo == 'ADDR3') {
                        ManualDialOnly('AddresS3')
                    } else {
                        if (hotkeysused == 'YES') {
                            reselect_alt_dial = 0;
                            manual_auto_hotkey = 1
                        }
                    }
                }
            } else {
                if (hotkeysused == 'YES') {
                    manual_auto_hotkey = 1
                } else {
 					if (dial_method == "INBOUND_MAN"||dial_method== "MANUAL") {
  						set_dial_btn_status("Manual_en");
 					} else {
 						set_dial_btn_status("Auto_re_en");
 					}
                 }
                reselect_alt_dial = 0
            }
        } else {
            if ($("#DiaLAltPhonE").is(":checked") == true) {
                reselect_alt_dial = 1;
                if (altdispo == 'ALTPH2') {
                    ManualDialOnly('ALTPhonE')
                } else {
                    if (altdispo == 'ADDR3') {
                        ManualDialOnly('AddresS3')
                    } else {
                        if (hotkeysused == 'YES') {
                            manual_auto_hotkey = 1;
                            alt_dial_active = 0;
                             
                            $("#MainStatuSSpan").html('');
                            if (dial_method == "INBOUND_MAN"||dial_method== "MANUAL") {
                               
								set_dial_btn_status("show_next_btn_dis");
                            } else {
                               
								set_dial_btn_status("show_auto_btn_dis");
                            }
							set_dial_btn_status("dis_all_btn");
                            reselect_alt_dial = 0
                        }
                    }
                }
            } else {
                 
                if (dial_method == "INBOUND_MAN"||dial_method== "MANUAL") {
 					set_dial_btn_status("show_next_btn_dis");
                } else {
 					set_dial_btn_status("show_auto_btn_dis");
                }
				set_dial_btn_status("dis_all_btn");
                reselect_alt_dial = 0
            }
        }
        ShoWTransferMain('OFF')
    }
};
// ################################################################################
// Send Hangup command for 3rd party call connected to the conference now to Manager
function xfercall_send_hangup() {
    var xferchannel = $("#xferchannel").val();
    var xfer_channel = lastxferchannel;
    var process_post_hangup = 0;
    if ((MD_channel_look == 1) && (leaving_threeway < 1)) {
        MD_channel_look = 0;
        DialTimeHangup('XFER')
    }
    if (xferchannel.length > 3) {
  		
		var queryCID = "HXvdcW" + epoch_sec + user_abb;
		var hangupvalue = xfer_channel;
		custhangup_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=Hangup&format=text&user=" + user + "&pass=" + pass + "&channel=" + hangupvalue + "&queryCID=" + queryCID;
		
 		$.ajax({
			url: "manager_send.php",
			data:custhangup_query,
			success: function(){}
		});	
		process_post_hangup = 1;
          
    } else {
        process_post_hangup = 1
    }
    if (process_post_hangup == 1) {
        XD_live_customer_call = 0;
        XD_live_call_secondS = 0;
        MD_ring_secondS = 0;
        MD_channel_look = 0;
        XDnextCID = '';
        XDcheck = '';
        xferchannellive = 0;
        $("#xferchannel").val("");
        lastxferchannel = '';
        $("#DialWithCustomer").html("<a href=\"javascript:void(0);\" onclick=\"SendManualDial('YES');\"><img src=\"./images/vdc_XB_dialwithcustomer.gif\" alt=\"直转\" style=\"vertical-align:middle\"></a>");
		
        $("#ParkCustomerDial").html("<a href=\"javascript:void(0);\" onclick=\"xfer_park_dial();\"><img src=\"./images/vdc_XB_parkcustomerdial.gif\" alt=\"保持客户转接\" style=\"vertical-align:middle\"></a>");
		
        $("#HangupXferLine").html("<img src=\"./images/vdc_XB_hangupxferline_OFF.gif\" alt=\"挂机转接线\" style=\"vertical-align:middle\">");
		
        $("#HangupBothLines").html("<a href=\"javascript:void(0);\" onclick=\"bothcall_send_hangup();\"><img src=\"./images/vdc_XB_hangupbothlines.gif\" alt=\"全部挂机\" style=\"vertical-align:middle\"></a>")
    }
};

// ################################################################################
// Send Hangup command for any Local call that is not in the quiet(7) entry - used to stop manual dials even if no connect
function DialTimeHangup(tasktypecall) {
    if ((RedirecTxFEr < 1) && (leaving_threeway < 1)) {
        MD_channel_look = 0;
         
		var queryCID = "HTvdcW" + epoch_sec + user_abb;
		custhangup_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=HangupConfDial&format=text&user=" + user + "&pass=" + pass + "&exten=" + session_id + "&ext_context=" + ext_context + "&queryCID=" + queryCID;
 		
		$.ajax({
			url: "manager_send.php",
			data:custhangup_query,
			success: function(){}
		});	
         
    }
};

// ################################################################################
// Update vicidial_list lead record with all altered values from form
function CustomerData_update() {
	
    var REGcommentsAMP = new RegExp('&', "g");
    var REGcommentsQUES = new RegExp("\\?", "g");
    var REGcommentsPOUND = new RegExp("\\#", "g");
    var REGcommentsRESULT = $("#comments").val().replace(REGcommentsAMP, "--AMP--");
    REGcommentsRESULT = REGcommentsRESULT.replace(REGcommentsQUES, "--QUES--");
    REGcommentsRESULT = REGcommentsRESULT.replace(REGcommentsPOUND, "--POUND--");
    $("#comments").val(REGcommentsRESULT);
	
	VLupdate_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&campaign=" + campaign + "&ACTION=updateLEAD&format=text&user=" + user + "&pass=" + pass + "&"+$('#vicidial_form').serialize();
 	
	$.ajax({
		url: "vdc_db_query.php",
		data:VLupdate_query,
		success: function(){}
	});	
    
};

// ################################################################################
// Generate the Call Disposition Chooser panel

function DispoSelectContent_create(taskDSgrp, taskDSstage) {
	
    AgentDispoing = 1;
    var dispo_HTML = "";
 
	if(VARstatusnames.length>0){
		for(i=0;i<VARstatusnames.length;i++) {
			if (taskDSgrp == VARstatuses[i]) {
				dispo_HTML+="<a href=\"javascript:void(0);\" onclick=\"DispoSelect_submit();return false;\" class=\"selected\" title=\"双击提交本次通话结果为：" + VARstatusnames[i] + "\" >" + VARstatusnames[i] + " - " + VARstatuses[i] + "</a>"
			} else {
				dispo_HTML+="<a href=\"javascript:void(0);\" onclick=\"DispoSelectContent_create('" + VARstatuses[i] + "','ADD');return false;\" title=\"双击提交本次通话结果为：" + VARstatusnames[i] + "\" >" + VARstatusnames[i] + " - <span class=\"gray\">" + VARstatuses[i] + "</span></a>"
			}
		}
 	
	}else{
		dispo_HTML="系统当前未设置呼叫结果选项！"
	}
	
    if (taskDSstage == 'ReSET') {
        $("#DispoSelection").val('')
    } else {
        $("#DispoSelection").val(taskDSgrp)
    }
    $("#DispoSelectContent").html(dispo_HTML)
};

// ################################################################################
// Generate the Pause Code Chooser panel
function PauseCodeSelectContent_create() {
    if ((AutoDialWaiting == 1) || (VD_live_customer_call == 1) || (alt_dial_active == 1) || (MD_channel_look == 1)) {
		 request_tip("在外拨模式下你必须先暂停呼叫才能输入暂停原因",0);
    } else {
        
        WaitingForNextStep = 1;
        PauseCode_HTML = '';
        $("#PauseCodeSelection").val('');
        showDiv('PauseCodeSelectBox'); 
        for(pause_i=0;pause_i<VARpause_codes.length;pause_i++) {
			
            PauseCode_HTML+="<a href=\"javascript:void(0);\" title=\"点击选择暂停原因为："+VARpause_code_names[pause_i]+"\" onclick=\"PauseCodeSelect_submit('" + VARpause_codes[pause_i] + "');\">" + VARpause_code_names[pause_i] + " - " + VARpause_codes[pause_i] + "</a>";
            
        }
        
        $("#PauseCodeSelectContent").html(PauseCode_HTML);
		
    }
};

// ################################################################################
// Generate the Group Alias Chooser panel
function GroupAliasSelectContent_create(task3way) {
    
    showDiv('GroupAliasSelectBox');
    WaitingForNextStep = 1;
    GroupAlias_HTML = '';
    $("#GroupAliasSelection").val('');
    var VD_group_aliases_ct_half = parseInt(VD_group_aliases_ct / 2);
    GroupAlias_HTML = "<table cellpadding=5 cellspacing=5 width=500><tr><td colspan=2><strong> 组别名</strong></td></tr><tr><td bgcolor=\"#99FF99\" height=300 width=240 valign=top><span id=GroupAliasSelectA>";
    if (task3way > 0) {
        VD_group_aliases_ct_half = (VD_group_aliases_ct_half - 1);
        GroupAlias_HTML = GroupAlias_HTML + "<font size=2 style=\"BACKGROUND-COLOR: #FFFFCC\"><strong><a href=\"javascript:void(0);\" onclick=\"GroupAliasSelect_submit('CAMPAIGN','" + campaign_cid + "','0');\">活动 - " + campaign_cid + "</a></strong><BR><BR>";
        GroupAlias_HTML = GroupAlias_HTML + "<font size=2 style=\"BACKGROUND-COLOR: #FFFFCC\"><strong><a href=\"javascript:void(0);\" onclick=\"GroupAliasSelect_submit('CUSTOMER','" + $("#phone_number").val() + "','0');\">客户 - " + $("#phone_number").val() + "</a></strong><BR><BR>";
        GroupAlias_HTML = GroupAlias_HTML + "<font size=2 style=\"BACKGROUND-COLOR: #FFFFCC\"><strong><a href=\"javascript:void(0);\" onclick=\"GroupAliasSelect_submit('AGENT_PHONE','" + outbound_cid + "','0');\">AGENT_PHONE - " + outbound_cid + "</a></strong><BR><BR>"
    }
    var loop_ct = 0;
    while (loop_ct < VD_group_aliases_ct) {
        GroupAlias_HTML = GroupAlias_HTML + "<font size=2 style=\"BACKGROUND-COLOR: #FFFFCC\"><strong><a href=\"javascript:void(0);\" onclick=\"GroupAliasSelect_submit('" + VARgroup_alias_ids[loop_ct] + "','" + VARcaller_id_numbers[loop_ct] + "','1');\">" + VARgroup_alias_ids[loop_ct] + " - " + VARgroup_alias_names[loop_ct] + " - " + VARcaller_id_numbers[loop_ct] + "</a></strong><BR><BR>";
        loop_ct++;
        if (loop_ct == VD_group_aliases_ct_half) {
            GroupAlias_HTML = GroupAlias_HTML + "</span></td><td bgcolor=\"#99FF99\" height=300 width=240 valign=top><span id=GroupAliasSelectB>"
        }
    }
    var Go_BacK_LinK = "<font size=3 style=\"BACKGROUND-COLOR: #FFFFCC\"><strong><a href=\"javascript:void(0);\" onclick=\"GroupAliasSelect_submit('');\">返回</a>";
    GroupAlias_HTML = GroupAlias_HTML + "</span></td></tr></table><BR><BR>" + Go_BacK_LinK;
    $("#GroupAliasSelectContent").html(GroupAlias_HTML)
};
// ################################################################################
// open 网页表单, then submit disposition
function WeBForMDispoSelect_submit() {
    leaving_threeway = 0;
    blind_transfer = 0;
    $("#callchannel").val('');
    $("#callserverip").val('');
    $("#xferchannel").val('');
    $("#DialWithCustomer").html("<a href=\"javascript:void(0);\" onclick=\"SendManualDial('YES');\"><img src=\"./images/vdc_XB_dialwithcustomer.gif\" alt=\"直转\" style=\"vertical-align:middle\"></a>");
	
    $("#ParkCustomerDial").html("<a href=\"javascript:void(0);\" onclick=\"xfer_park_dial();\"><img src=\"./images/vdc_XB_parkcustomerdial.gif\" alt=\"保持客户转接\" style=\"vertical-align:middle\"></a>");
	
    $("#HangupBothLines").html("<a href=\"javascript:void(0);\" onclick=\"bothcall_send_hangup();\"><img src=\"./images/vdc_XB_hangupbothlines.gif\" alt=\"全部挂机\" style=\"vertical-align:middle\"></a>");
	
    var DispoChoice = $("#DispoSelection").val();	
    if (DispoChoice.length < 1) {
       
		request_tip("您必须选择一个电话呼叫结果！",1,8000);
    } else {
		
        $("#CusTInfOSpaN").html("");
        
        LeaDDispO = DispoChoice;
		DispoSelect_submit();
        WebFormRefresH('NO', 'YES');
        $("#WebFormSpan").html("<img src=\"./images/vdc_LB_webform_OFF.gif\" alt=\"网页表单\">");
        if (enable_second_webform > 0) {
            $("#WebFormSpanTwo").html("<img src=\"./images/vdc_LB_webform_two_OFF.gif\" alt=\"网页表单二\">")
        }
 		$("#WEBFORM_url").val(TEMP_VDIC_web_form_address);
		tab_frame('WEBFORM','y');
         
    }
};
// ################################################################################
// Update vicidial_list lead record with disposition selection
function DispoSelect_submit() {
    if (VDCL_group_id.length > 1) {
        var group = VDCL_group_id
    } else {
        var group = campaign
    }
    leaving_threeway = 0;
    blind_transfer = 0;
    CheckDEADcallON = 0;
    $("#callchannel").val('');
    $("#callserverip").val('');
    $("#xferchannel").val('');
    //$("#DialWithCustomer").html("<a href=\"javascript:void(0);\" onclick=\"SendManualDial('YES');\"><img src=\"./images/vdc_XB_dialwithcustomer.gif\" alt=\"直转\" style=\"vertical-align:middle\"></a>");
	
    //$("#ParkCustomerDial").html("<a href=\"javascript:void(0);\" onclick=\"xfer_park_dial();\"><img src=\"./images/vdc_XB_parkcustomerdial.gif\" alt=\"保持客户转接\" style=\"vertical-align:middle\"></a>");
	
    //$("#HangupBothLines").html("<a href=\"javascript:void(0);\" onclick=\"bothcall_send_hangup();\"><img src=\"./images/vdc_XB_hangupbothlines.gif\" alt=\"全部挂机\" style=\"vertical-align:middle\"></a>");
	
    var DispoChoice = $("#DispoSelection").val();
    if (DispoChoice.length < 1) {
 		request_tip("您必须选择一个呼叫结果选项",0);
    } else {
        $("#CusTInfOSpaN").html("");
        
        if ((DispoChoice == 'CALLBK') && (scheduled_callbacks > 0)) {
            showDiv('CallBackSelectBox')
        } else {
            
            if(last_uniqueid==""){last_uniqueid=$("#uniqueid").val()}
			
			DSupdate_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=updateDISPO&format=text&user=" + user + "&pass=" + pass + "&dispo_choice=" + DispoChoice + "&lead_id=" + $("#lead_id").val() + "&campaign=" + campaign + "&auto_dial_level=" + auto_dial_level + "&agent_log_id=" + agent_log_id + "&CallBackDatETimE=" + CallBackDatETimE + "&list_id=" + $("#list_id").val() + "&recipient=" + CallBackrecipient + "&use_internal_dnc=" + use_internal_dnc + "&use_campaign_dnc=" + use_campaign_dnc + "&MDnextCID=" + LasTCID + "&stage=" + group + "&vtiger_callback_id=" + vtiger_callback_id + "&phone_number=" + $("#phone_number").val() + "&phone_code=" + $("#phone_code").val() + "&call_des=" + $("#call_des").val() + "&dial_method=" + dial_method + "&uniqueid=" + last_uniqueid + "&agent_dialed_type=" + agent_dialed_type+ "&is_manual_dialed=" + is_manual_dialed + "&comments=" + CallBackCommenTs;
			
 			is_manual_dialed="N";
			 
            $.ajax({
				url: "vdc_db_query.php",
				data:DSupdate_query,
				success: function(htmls){ 
				
					if(auto_dial_level < 1){
						
						var check_dispo = null;
						check_dispo = htmls;
						var check_DS_array = check_dispo.split("\n");
						if (check_DS_array[1] == 'Next agent_log_id:') {
							agent_log_id = check_DS_array[2]
						}
					}
					
				}
			});	
			agent_dialed_type="";
			$("#dial_ring_number,#phone_numberDISP").html('');
			$("#dial_ring_second").html('0');
            $("#dial_ring_list").fadeOut();
			$("#call_status_list").removeClass("focus");
			$("#call_status_pos").removeClass("red").html("未通话");
			$("#call_status_time").removeClass("focus");
			$("#SecondSDISP").removeClass("focus").html("00:00:00");
			$("#call_status_hangup").removeClass("focus").off();
			
			$(":input","#vicidial_form").val("");
			
			//if (get_call_launch == 'WEBFORM'){
				//window.frames["frame_c_WEBFORM"].do_submit();
				//setTimeout('$("#frame_c_WEBFORM").attr("src",VICIDiaL_web_form_address)',10);
			//}
			/*if (get_call_launch == 'WEBFORMTWO'){
				$("#frame_c_WEBFORMTWO").attr("src",VICIDiaL_web_form_address_two);
			}*/
			
            VDCL_group_id = '';
            fronter = '';
            inOUT = 'OUT';
            vtiger_callback_id = '0';
            recording_filename = '';
            recording_id = '';
            
            MDuniqueid = '';
            XDuniqueid = '';
            tmp_vicidial_id = '';
            EAphone_code = '';
            EAphone_number = '';
            EAalt_phone_notes = '';
            EAalt_phone_active = '';
            EAalt_phone_count = '';
            XDnextCID = '';
            XDcheck = '';
            MDnextCID = '';
            XD_live_customer_call = 0;
            XD_live_call_secondS = 0;
            MD_channel_look = 0;
            MD_ring_secondS = 0;
            if (manual_dial_in_progress == 1) {
                manual_dial_finished()
            }
            
            hideDiv('DispoSelectBox');
            hideDiv('DispoButtonHideA');
            hideDiv('DispoButtonHideB');
            hideDiv('DispoButtonHideC');
			
            $("#DispoSelectHAspan").html("<a class=\"zInputBtn\" href=\"javascript:void(0);\" onclick=\"DispoHanguPAgaiN();\" title=\"点击再次挂机\"><input type=\"button\" value=\"再次挂机\" class=\"inputButton\"></a>");
            CBcommentsBoxhide();
            EAcommentsBoxhide();
            AgentDispoing = 0;
            if (shift_logout_flag < 1) {
                if (wrapup_waiting == 0) {
                    if ($("#DispoSelectStop").is(":checked") == true) {
                        if (auto_dial_level != '0') {
                            AutoDialWaiting = 0;
                            AutoDial_ReSume_PauSe("VDADpause")
                        }
                        VICIDiaL_pause_calling = 1;
                        if (dispo_check_all_pause != '1') {
                            $("#DispoSelectStop").attr("checked",false)
                        }
                    } else {
                        if (auto_dial_level != '0') {
                            AutoDialWaiting = 1;
 							agent_log_id = AutoDial_ReSume_PauSe("VDADready", "NEW_ID");
 							
                        } else {
							AutoDialWaiting = 0;
                            if (manual_auto_hotkey == '1') {
                                manual_auto_hotkey = 0;
                                ManualDialNext('', '', '', '', '', '0')
                            }
                        }
                    }
                }
            } else {
                LogouT('SHIFT')
            }
        }
    }
};


// ################################################################################
// Submit the Pause Code 
function PauseCodeSelect_submit(newpausecode) {
    hideDiv('PauseCodeSelectBox');
    
    WaitingForNextStep = 0;
   
	VMCpausecode_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ACTION=PauseCodeSubmit&format=text&status=" + newpausecode + "&agent_log_id=" + agent_log_id + "&campaign=" + campaign + "&extension=" + extension + "&protocol=" + protocol + "&phone_ip=" + phone_ip + "&enable_sipsak_messages=" + enable_sipsak_messages + "&stage=" + pause_code_counter;
	pause_code_counter++;
	 
	$.ajax({
 		url: "vdc_db_query.php",
		data:VMCpausecode_query,
		success: function(htmls){ 
		
 			var check_pause_code = null;
			var check_pause_code = htmls;
			var check_PC_array = check_pause_code.split("\n");
			if (check_PC_array[1] == 'Next agent_log_id:') {
				agent_log_id = check_PC_array[2]
			}
			
		}
	});	
         
};

// ################################################################################
// Submit the Group Alias 
function GroupAliasSelect_submit(newgroupalias, newgroupcid, newusegroup) {
    hideDiv('GroupAliasSelectBox');
    
    WaitingForNextStep = 0;
    if (newusegroup > 0) {
        active_group_alias = newgroupalias;
        $("#ManuaLDiaLGrouPSelecteD").html("<font size=2 face=\"Arial,Helvetica\">组别名: " + active_group_alias + "");
        $("#XfeRDiaLGrouPSelecteD").html("组别名: " + active_group_alias + "")
    }
    cid_choice = newgroupcid
};

// ################################################################################
// Populate the dtmf and xfer number for each preset link in xfer-conf frame
function DtMf_PreSet_a() {
    $("#conf_dtmf").val(CalL_XC_a_Dtmf);
    $("#xfernumber").val(CalL_XC_a_NuMber)
};

function DtMf_PreSet_b() {
    $("#conf_dtmf").val(CalL_XC_b_Dtmf);
    $("#xfernumber").val(CalL_XC_b_NuMber)
};

function DtMf_PreSet_c() {
    $("#xfernumber").val(CalL_XC_c_NuMber)
};

function DtMf_PreSet_d() {
    $("#xfernumber").val(CalL_XC_d_NuMber)
};

function DtMf_PreSet_e() {
    $("#xfernumber").val(CalL_XC_e_NuMber)
};

function DtMf_PreSet_a_DiaL() {
    $("#conf_dtmf").val(CalL_XC_a_Dtmf);
    $("#xfernumber").val(CalL_XC_a_NuMber);
    basic_originate_call(CalL_XC_a_NuMber, 'NO', 'YES', session_id, 'YES', '', '1', '0')
};

function DtMf_PreSet_b_DiaL() {
    $("#conf_dtmf").val(CalL_XC_b_Dtmf);
    $("#xfernumber").val(CalL_XC_b_NuMber);
    basic_originate_call(CalL_XC_b_NuMber, 'NO', 'YES', session_id, 'YES', '', '1', '0')
};

function DtMf_PreSet_c_DiaL() {
    $("#xfernumber").val(CalL_XC_c_NuMber);
    basic_originate_call(CalL_XC_c_NuMber, 'NO', 'YES', session_id, 'YES', '', '1', '0')
};

function DtMf_PreSet_d_DiaL() {
    $("#xfernumber").val(CalL_XC_d_NuMber);
    basic_originate_call(CalL_XC_d_NuMber, 'NO', 'YES', session_id, 'YES', '', '1', '0')
};

function DtMf_PreSet_e_DiaL() {
    $("#xfernumber").val(CalL_XC_e_NuMber);
    basic_originate_call(CalL_XC_e_NuMber, 'NO', 'YES', session_id, 'YES', '', '1', '0')
};

// ################################################################################
// Show message that customer has hungup the call before agent has
function CustomerChanneLGone() {
    showDiv('CustomerGoneBox');
    $("#callchannel,#callserverip").val('');
     
    $("#CustomerGoneChanneL").html("请点击“挂机提交”保存后继续呼叫！\n或点击“确认返回”继续停留 300 秒！");//lastcustchannel
  	
    WaitingForNextStep = 1;
	$("#call_status_list").removeClass("focus");
	$("#call_status_pos").html("未通话").removeClass("red");
	$("#SecondSDISP").html("00:00:00").removeClass("focus");
 
	$("#VolumeUpSpan,#VolumeDownSpan,#call_status_hangup").removeClass("focus").off();
};

function CustomerGoneOK() {
    hideDiv('CustomerGoneBox');
    WaitingForNextStep = 0;
    custchannellive = 0
};

function CustomerGoneHangup() {
    hideDiv('CustomerGoneBox');
    WaitingForNextStep = 0;
    custchannellive = 0;
    dialedcall_send_hangup()
};
// ################################################################################
// Show message that there are no voice channels in the VICIDIAL session
function NoneInSession() {
    showDiv('NoneInSessionBox');
	$("#agent_client_conn").addClass("no_conn").off().on("click",function(){EAcommentsBoxshow();}).attr("title","点击呼叫坐席分机");
    $("#NoneInSessionID").html(session_id);
    WaitingForNextStep = 1
};

function NoneInSessionOK() {
    hideDiv('NoneInSessionBox');
	$("#agent_client_conn").removeClass("no_conn").off().attr("title","");
    WaitingForNextStep = 0;
    nochannelinsession = 0
};

function NoneInSessionCalL() {
    hideDiv('NoneInSessionBox');
	
    WaitingForNextStep = 0;
    nochannelinsession = 0;
    if ((protocol == 'EXTERNAL') || (protocol == 'Local')) {
        var protodial = 'Local';
        var extendial = extension
    } else {
        var protodial = protocol;
        var extendial = extension
    }
    var originatevalue = protodial + "/" + extendial;
    var queryCID = "ACagcW" + epoch_sec + user_abb;
    
	VMCoriginate_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ACTION=OriginateVDRelogin&format=text&channel=" + originatevalue + "&queryCID=" + queryCID + "&exten=" + session_id + "&ext_context=" + ext_context + "&ext_priority=1" + "&extension=" + extension + "&protocol=" + protocol + "&phone_ip=" + phone_ip + "&enable_sipsak_messages=" + enable_sipsak_messages + "&allow_sipsak_messages=" + allow_sipsak_messages + "&campaign=" + campaign + "&outbound_cid=" + campaign_cid;

	$.ajax({
 		url: "manager_send.php",
		data:VMCoriginate_query,
		success: function(){}
	});
		
	$("#agent_client_conn").removeClass("no_conn").off().attr("title","");
	
    if (auto_dial_level > 0) {
        AutoDial_ReSume_PauSe("VDADpause");
    }
};
// ################################################################################
// Generate the Closer In Group Chooser panel
function CloserSelectContent_create() {
    
    if ((VU_agent_choose_ingroups == '1') && (manager_ingroups_set < 1)) {
        var live_CSC_HTML = "<table cellpadding=5 cellspacing=5 width=500><tr><td><strong>可选呼入组</strong></td><td><strong>已选呼入组</strong></td></tr><tr><td bgcolor=\"#99FF99\" height=300 width=240 valign=top><span id=CloserSelectAdd> &nbsp; <a href=\"javascript:void(0);\" onclick=\"CloserSelect_change('-----ADD-ALL-----','ADD');\"><strong>--- 全选 ---</strong><BR>";
        var loop_ct = 0;
        while (loop_ct < INgroupCOUNT) {
            live_CSC_HTML = live_CSC_HTML + "<a href=\"javascript:void(0);\" onclick=\"CloserSelect_change('" + VARingroups[loop_ct] + "','ADD');\">" + VARingroups[loop_ct] + "<BR>";
            loop_ct++
        }
        live_CSC_HTML = live_CSC_HTML + "</span></td><td bgcolor=\"#99FF99\" height=300 width=240 valign=top><span id=CloserSelectDelete></span></td></tr></table>";
        $("#CloserSelectList").val('');
        $("#CloserSelectContent").html(live_CSC_HTML)
    } else {
        VU_agent_choose_ingroups_DV = "MGRLOCK";
        var live_CSC_HTML = "管理员已为你设定了呼入组<BR>";
        $("#CloserSelectList").val('');
        $("#CloserSelectContent").html(live_CSC_HTML)
    }
};

// ################################################################################
// Move a Closer In Group record to the selected column or reverse
function CloserSelect_change(taskCSgrp, taskCSchange) {
    var CloserSelectListValue = $("#CloserSelectList").val();
    var CSCchange = 0;
    var regCS = new RegExp(" " + taskCSgrp + " ", "ig");
    var regCSall = new RegExp("-ALL-----", "ig");
    var regCSallADD = new RegExp("-----ADD-ALL-----", "ig");
    var regCSallDELETE = new RegExp("-----DELETE-ALL-----", "ig");
    if ((CloserSelectListValue.match(regCS)) && (CloserSelectListValue.length > 3)) {
        if (taskCSchange == 'DELETE') {
            CSCchange = 1
        }
    } else {
        if (taskCSchange == 'ADD') {
            CSCchange = 1
        }
    }
    if (taskCSgrp.match(regCSall)) {
        CSCchange = 1
    }
    if (CSCchange == 1) {
        var loop_ct = 0;
        var CSCcolumn = '';
        var live_CSC_HTML_ADD = '';
        var live_CSC_HTML_DELETE = '';
        var live_CSC_LIST_value = " ";
        while (loop_ct < INgroupCOUNT) {
            var regCSL = new RegExp(" " + VARingroups[loop_ct] + " ", "ig");
            if (CloserSelectListValue.match(regCSL)) {
                CSCcolumn = 'DELETE'
            } else {
                CSCcolumn = 'ADD'
            }
            if (((VARingroups[loop_ct] == taskCSgrp) && (taskCSchange == 'DELETE')) || (taskCSgrp.match(regCSallDELETE))) {
                CSCcolumn = 'ADD'
            }
            if (((VARingroups[loop_ct] == taskCSgrp) && (taskCSchange == 'ADD')) || (taskCSgrp.match(regCSallADD))) {
                CSCcolumn = 'DELETE'
            }
            if (CSCcolumn == 'DELETE') {
                live_CSC_HTML_DELETE = live_CSC_HTML_DELETE + "<a href=\"javascript:void(0);\" onclick=\"CloserSelect_change('" + VARingroups[loop_ct] + "','DELETE');\">" + VARingroups[loop_ct] + "<BR>";
                live_CSC_LIST_value = live_CSC_LIST_value + VARingroups[loop_ct] + " "
            } else {
                live_CSC_HTML_ADD = live_CSC_HTML_ADD + "<a href=\"javascript:void(0);\" onclick=\"CloserSelect_change('" + VARingroups[loop_ct] + "','ADD');\">" + VARingroups[loop_ct] + "<BR>"
            }
            loop_ct++
        }
        $("#CloserSelectList").val(live_CSC_LIST_value);
        $("#CloserSelectAdd").html(" &nbsp; <a href=\"javascript:void(0);\" onclick=\"CloserSelect_change('-----ADD-ALL-----','ADD');\"><strong>--- 全选 ---</strong><BR>" + live_CSC_HTML_ADD);
        $("#CloserSelectDelete").html(" &nbsp; <a href=\"javascript:void(0);\" onclick=\"CloserSelect_change('-----DELETE-ALL-----','DELETE');\"><strong>--- 全部取消 ---</strong><BR>" + live_CSC_HTML_DELETE)
    }
};

// ################################################################################
// Update vicidial_live_agents record with closer in group choices
function CloserSelect_submit() {
    if (dial_method == "INBOUND_MAN"||dial_method== "MANUAL") {
        $("#CloserSelectBlended").attr("checked",false)
    }
    if ($("#CloserSelectBlended").is(":checked") == true) {
        VICIDiaL_closer_blended = 1
    } else {
        VICIDiaL_closer_blended = 0
    }
    var CloserSelectChoices = $("#CloserSelectList").val();
    if (call_requeue_button > 0) {
        $("#ReQueueCall").html("<img src=\"./images/vdc_LB_requeue_call_OFF.gif\" alt=\"重派到队列\">")
    } else {
        $("#ReQueueCall").html("")
    }
    if (VU_agent_choose_ingroups_DV == "MGRLOCK") {
        CloserSelectChoices = "MGRLOCK"
    }
  
	CSCupdate_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=regCLOSER&format=text&user=" + user + "&pass=" + pass + "&comments=" + VU_agent_choose_ingroups_DV + "&closer_blended=" + VICIDiaL_closer_blended + "&campaign=" + campaign + "&dial_method=" + dial_method + "&closer_choice=" + CloserSelectChoices + "-";
 	
	$.ajax({
 		url: "vdc_db_query.php",
		data:CSCupdate_query,
		success: function(){}
	});	
    	
    hideDiv('CloserSelectBox');
    MainPanelToFront();
    CloserSelecting = 0
};
// ################################################################################
// Generate the Territory Chooser panel
function TerritorySelectContent_create() {
    if (agent_select_territories == '1') {
        
        if (agent_choose_territories > 0) {
            var live_TERR_HTML = "<table cellpadding=5 cellspacing=5 width=500><tr><td><strong>可选地区</strong></td><td><strong>已选地区</strong></td></tr><tr><td bgcolor=\"#99FF99\" height=300 width=240 valign=top><span id=TerritorySelectAdd> &nbsp; <a href=\"javascript:void(0);\" onclick=\"TerritorySelect_change('-----ADD-ALL-----','ADD');\"><strong>--- 全选 ---</strong><BR>";
            var loop_ct = 0;
            while (loop_ct < territoryCOUNT) {
                live_TERR_HTML = live_TERR_HTML + "<a href=\"javascript:void(0);\" onclick=\"TerritorySelect_change('" + VARterritories[loop_ct] + "','ADD');\">" + VARterritories[loop_ct] + "<BR>";
                loop_ct++
            }
            live_TERR_HTML = live_TERR_HTML + "</span></td><td bgcolor=\"#99FF99\" height=300 width=240 valign=top><span id=TerritorySelectDelete></span></td></tr></table>";
            $("#TerritorySelectList").val('');
            $("#TerritorySelectContent").html(live_TERR_HTML)
        } else {
            agent_select_territories = "MGRLOCK";
            var live_TERR_HTML = "管理员已为你设定了地区<BR>";
            $("#TerritorySelectList").val('');
            $("#TerritorySelectContent").html(live_TERR_HTML)
        }
    }
};

// ################################################################################
// Move a Territory record to the selected column or reverse
function TerritorySelect_change(taskTERRgrp, taskTERRchange) {
    var TerritorySelectListValue = $("#TerritorySelectList").val();
    var TERRchange = 0;
    var regTERR = new RegExp(" " + taskTERRgrp + " ", "ig");
    var regTERRall = new RegExp("-ALL-----", "ig");
    var regTERRallADD = new RegExp("-----ADD-ALL-----", "ig");
    var regTERRallDELETE = new RegExp("-----DELETE-ALL-----", "ig");
    if ((TerritorySelectListValue.match(regTERR)) && (TerritorySelectListValue.length > 3)) {
        if (taskTERRchange == 'DELETE') {
            TERRchange = 1
        }
    } else {
        if (taskTERRchange == 'ADD') {
            TERRchange = 1
        }
    }
    if (taskTERRgrp.match(regTERRall)) {
        TERRchange = 1
    }
    if (TERRchange == 1) {
        var loop_ct = 0;
        var TERRcolumn = '';
        var live_TERR_HTML_ADD = '';
        var live_TERR_HTML_DELETE = '';
        var live_TERR_LIST_value = " ";
        while (loop_ct < territoryCOUNT) {
            var regTERRL = new RegExp(" " + VARterritories[loop_ct] + " ", "ig");
            if (TerritorySelectListValue.match(regTERRL)) {
                TERRcolumn = 'DELETE'
            } else {
                TERRcolumn = 'ADD'
            }
            if (((VARterritories[loop_ct] == taskTERRgrp) && (taskTERRchange == 'DELETE')) || (taskTERRgrp.match(regTERRallDELETE))) {
                TERRcolumn = 'ADD'
            }
            if (((VARterritories[loop_ct] == taskTERRgrp) && (taskTERRchange == 'ADD')) || (taskTERRgrp.match(regTERRallADD))) {
                TERRcolumn = 'DELETE'
            }
            if (TERRcolumn == 'DELETE') {
                live_TERR_HTML_DELETE = live_TERR_HTML_DELETE + "<a href=\"javascript:void(0);\" onclick=\"TerritorySelect_change('" + VARterritories[loop_ct] + "','DELETE');\">" + VARterritories[loop_ct] + "<BR>";
                live_TERR_LIST_value = live_TERR_LIST_value + VARterritories[loop_ct] + " "
            } else {
                live_TERR_HTML_ADD = live_TERR_HTML_ADD + "<a href=\"javascript:void(0);\" onclick=\"TerritorySelect_change('" + VARterritories[loop_ct] + "','ADD');\">" + VARterritories[loop_ct] + "<BR>"
            }
            loop_ct++
        }
        $("#TerritorySelectList").val(live_TERR_LIST_value);
        $("#TerritorySelectAdd").html(" &nbsp; <a href=\"javascript:void(0);\" onclick=\"TerritorySelect_change('-----ADD-ALL-----','ADD');\"><strong>--- 全选 ---</strong><BR>" + live_TERR_HTML_ADD);
        $("#TerritorySelectDelete").html(" &nbsp; <a href=\"javascript:void(0);\" onclick=\"TerritorySelect_change('-----DELETE-ALL-----','DELETE');\"><strong>--- 全部取消 ---</strong><BR>" + live_TERR_HTML_DELETE)
    }
};

// ################################################################################
// Update vicidial_live_agents record with territory choices
function TerritorySelect_submit() {
    var TerritorySelectChoices = $("#TerritorySelectList").val();
    if (agent_select_territories == "MGRLOCK") {
        TerritorySelectChoices = "MGRLOCK"
    }
      
	TERRupdate_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=regTERRITORY&format=text&user=" + user + "&pass=" + pass + "&comments=" + agent_select_territories + "&campaign=" + campaign + "&agent_territories=" + TerritorySelectChoices + "-";
 	$.ajax({
 		url: "vdc_db_query.php",
		data:TERRupdate_query,
		success: function(){}
	});	
          
    hideDiv('TerritorySelectBox');
    MainPanelToFront();
    TerritorySelecting = 0
};
// ################################################################################
// Log the user out of the system when they close their browser while logged in
function BrowserCloseLogout() {
    if (logout_stop_timeouts < 1) {
		
        if (VDRP_stage != 'PAUSED') {
            AutoDial_ReSume_PauSe("VDADpause", '', '', '', "LOGOUT")
        }
        LogouT('CLOSE');
		$("#LOGOUT_href").css("color","#ff0000");
		setTimeout('$("#LOGOUT_href").css("color","#FFF")',5000);
	    alert("下次请点击\"签退重登\"链接来退出系统！\n");
    }
};
// ################################################################################
// Normal logout with check for pause stage first
function NormalLogout() {
    if (logout_stop_timeouts < 1) {
        if (VDRP_stage != 'PAUSED') {
            AutoDial_ReSume_PauSe("VDADpause", '', '', '', "LOGOUT")
        }
        LogouT('NORMAL');
		$("#frame_c_SCRIPT").attr("src","about:blank");
		$("#frame_c_WEBFORM").attr("src","about:blank");
		$("#frame_c_WEBFORMTWO").attr("src","about:blank");
		$("#frame_c_HIS").attr("src","about:blank");
    }
};
// ################################################################################
// Log the user out of the system, if active call or active dial is occuring, don't let them.
function LogouT(tempreason) {
    if (MD_channel_look == 1) {
 		request_tip("您不能在拨号期间退出系统,如果对方无应答请等待50秒",0);
    } else {
        if (VD_live_customer_call == 1) {
			request_tip("当前正在振铃、通话中，请挂机提交后再退出",0);
        } else {
            if (alt_dial_status_display == 1) {
                
				request_tip("在拨打备用号模式中，你必须先结束该通话再退出系统："+ reselect_alt_dial,0);
            } else {
                
				VDlogout_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=userLOGout&format=text&user=" + user + "&pass=" + pass + "&campaign=" + campaign + "&conf_exten=" + session_id + "&extension=" + extension + "&protocol=" + protocol + "&agent_log_id=" + agent_log_id + "&no_delete_sessions=" + no_delete_sessions + "&phone_ip=" + phone_ip + "&enable_sipsak_messages=" + enable_sipsak_messages + "&LogouTKicKAlL=" + LogouTKicKAlL + "&ext_context=" + ext_context;

				$.ajax({
					url: "vdc_db_query.php",
					data:VDlogout_query,
					success: function(){}
				});		
                     
                hideDiv('MainPanel');
                
                var logout_content = '',login_tip="";
                if (tempreason == 'SHIFT') {
                    logout_content = '您的转换键已经结束或改变，请重新登录！'
                }
                var go_url=agcPAGE + "?relogin=YES&session_epoch=" + epoch_sec + "&session_id=" + session_id + "&session_name=" + session_name + "&VD_login=" + user + "&VD_campaign=" + campaign + "&phone_login=" + original_phone_login + "&phone_pass=" + phone_pass + "&VD_pass=" + pass;
				
				$("#LogouTBoxLink").attr({"title":logout_content+" 点击 重新登录 系统"}).html("重新登录 <i></i>");
				
                logout_stop_timeouts = 1;
				window.onbeforeunload = null;
				$("#btn_relogonin_2,#btn_relogonin_1,#close_relogonin").off().on("click",function(){
					location.href=go_url	
				});
				
				showDiv('LogouTBox');
				
            }
        }
    }
};
<?php
if ($useIE > 0){
?>
// ################################################################################
// MSIE-only hotkeypress function to bind hotkeys defined in the campaign to dispositions
function hotkeypress(evt) {
    enter_disable();
    if ((hot_keys_active == 1) && ((VD_live_customer_call == 1) || (MD_ring_secondS > 4))) {
        var e = evt ? evt: window.event;
        if (!e) return;
        var key = 0;
        if (e.keyCode) {
            key = e.keyCode
        } else if (typeof(e.which) != 'undefined') {
            key = e.which
        }
        var HKdispo = hotkeys[String.fromCharCode(key)];
        if (HKdispo) {
            CustomerData_update();
            var HKdispo_ary = HKdispo.split(" ----- ");
            if ((HKdispo_ary[0] == 'ALTPH2') || (HKdispo_ary[0] == 'ADDR3')) {
                if ($("#DiaLAltPhonE").is(":checked") == true) {
                    dialedcall_send_hangup('NO', 'YES', HKdispo_ary[0])
                }
            } else {
                HKdispo_display = 4;
                HKfinish = 1;
                $("#HotKeyDispo").html(HKdispo_ary[0] + " - " + HKdispo_ary[1]);
                showDiv('HotKeyActionBox');
                hideDiv('HotKeyEntriesBox');
                $("#DispoSelection").val(HKdispo_ary[0]);
                dialedcall_send_hangup('NO', 'YES', HKdispo_ary[0])
            }
        }
    }
};

<?php
}else{
?>
// ################################################################################
// W3C-compliant hotkeypress function to bind hotkeys defined in the campaign to dispositions
function hotkeypress(evt) {
    enter_disable();
    if ((hot_keys_active == 1) && ((VD_live_customer_call == 1) || (MD_ring_secondS > 4))) {
        var e = evt ? evt: window.event;
        if (!e) return;
        var key = 0;
        if (e.keyCode) {
            key = e.keyCode
        } else if (typeof(e.which) != 'undefined') {
            key = e.which
        }
        var HKdispo = hotkeys[String.fromCharCode(key)];
        if (HKdispo) {
            $("#inert_button").focus();
            $("#inert_button").blur();
            CustomerData_update();
            var HKdispo_ary = HKdispo.split(" ----- ");
            if ((HKdispo_ary[0] == 'ALTPH2') || (HKdispo_ary[0] == 'ADDR3')) {
                if ($("#DiaLAltPhonE").is(":checked") == true) {
                    dialedcall_send_hangup('NO', 'YES', HKdispo_ary[0])
                }
            } else {
                HKdispo_display = 4;
                HKfinish = 1;
                $("#HotKeyDispo").html(HKdispo_ary[0] + " - " + HKdispo_ary[1]);
                showDiv('HotKeyActionBox');
                hideDiv('HotKeyEntriesBox');
                $("#DispoSelection").val(HKdispo_ary[0]);
                dialedcall_send_hangup('NO', 'YES', HKdispo_ary[0])
            }
        }
    }
};

<?php
}
### end of onkeypress functions
?>
// ################################################################################
// disable enter/return keys to not clear out vars on customer info
function enter_disable(evt) {
    var e = evt ? evt: window.event;
    if (!e) return;
    var key = 0;
    if (e.keyCode) {
        key = e.keyCode
    } else if (typeof(e.which) != 'undefined') {
        key = e.which
    }
    return key != 13
};
// ################################################################################
// decode the scripttext and scriptname so that it can be displayed
function URLDecode(encodedvar, scriptformat) {
     
    decoded = encoded;
    decoded = decoded.replace(RGnl, "<BR>");
    return false
};


// ################################################################################
// Taken form php.net Angelos
function utf8_decode(utftext) {
    var string = "";
    var i = 0;
    var c = c1 = c2 = 0;
    while (i < utftext.length) {
        c = utftext.charCodeAt(i);
        if (c < 128) {
            string += String.fromCharCode(c);
            i++
        } else if ((c > 191) && (c < 224)) {
            c2 = utftext.charCodeAt(i + 1);
            string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
            i += 2
        } else {
            c2 = utftext.charCodeAt(i + 1);
            c3 = utftext.charCodeAt(i + 2);
            string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
            i += 3
        }
    }
    return string
};
// ################################################################################
// phone number format
function phone_number_format(formatphone) {
   /* var regUS_DASHphone = new RegExp("US_DASH", "g");
    var regUS_PARNphone = new RegExp("US_PARN", "g");
    var regUK_DASHphone = new RegExp("UK_DASH", "g");
    var regAU_SPACphone = new RegExp("AU_SPAC", "g");
    var regIT_DASHphone = new RegExp("IT_DASH", "g");
    var regFR_SPACphone = new RegExp("FR_SPAC", "g");
    var status_display_number = formatphone;
    var dispnum = formatphone;
    if (disable_alter_custphone == 'HIDE') {
        var status_display_number = 'XXXXXXXXXX';
        var dispnum = 'XXXXXXXXXX'
    }
     
    return status_display_number*/
  
    var regUS_DASHphone = new RegExp("US_DASH", "g");
   	
    if (disable_alter_custphone == 'HIDE') {
         
		return 'XXXXXXXXXX';
		
    }else if(regUS_DASHphone.test(vdc_header_phone_format)){
		 
		if(formatphone.length<10){
			return formatphone;	
		}else{
			phone_sub=formatphone.substring(0,3);
			 
			if(phone_sub=="010"||new RegExp("^02[1-9]","g").test(phone_sub)){
				return formatphone.replace(/(\d{3})(\d{4})(\d{3})/, "$1 $2 $3");	
			}else if(new RegExp("^01[3-8]","g").test(phone_sub)){
				return formatphone.replace(/(\d{1})(\d{3})(\d{4})(\d{4})/, "$1 $2 $3 $4");	
			}else if(new RegExp("^1[3-8]","g").test(phone_sub)){
				return formatphone.replace(/(\d{3})(\d{4})(\d{4})/, "$1 $2 $3");	
			}else if(new RegExp("^0[3-9]","g").test(phone_sub)){
				return formatphone.replace(/(\d{4})(\d{4})(\d{3})/, "$1 $2 $3");	
			}else{
				return formatphone;	
			}
 		}	
	}else{
		return formatphone
	}
 	
};
// ################################################################################
// RefresH the agents view sidebar or xfer frame
function refresh_agents_view(RAlocation, RAcount) {
    if (RAcount > 0) {
        if (even > 0) {
            
             
			RAview_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=AGENTSview&format=text&user=" + user + "&pass=" + pass + "&user_group=" + VU_user_group + "&conf_exten=" + session_id + "&extension=" + extension + "&protocol=" + protocol + "&stage=" + agent_status_view_time + "&campaign=" + campaign + "&comments=" + RAlocation;
			 
			$.ajax({
				url: "vdc_db_query.php",
				data:RAview_query,
				success: function(htmls){ 
					
					var newRAlocationHTML = htmls;
					if (RAlocation == 'AgentXferViewSelect') {
						$("#"+RAlocation).html(newRAlocationHTML + "\n<BR><BR><a href=\"javascript:void(0);\" onclick=\"AgentsXferSelect('0','AgentXferViewSelect');\">关闭窗口</a>&nbsp;")
					} else {
						$("#"+RAlocation).html(newRAlocationHTML + "\n")
					}
					
				}
			});	
			
        }
    }
};	
// ################################################################################
// Grab the call in queue and bring it into the session
function callinqueuegrab(CQauto_call_id) {
    if (CQauto_call_id > 0) {
        if ((AutoDialWaiting == 1) || (VD_live_customer_call == 1) || (alt_dial_active == 1) || (MD_channel_look == 1)) {
			request_tip("您必须先暂停才能在队列中提取电话",0);
        } else {
            
 			RAview_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=CALLSINQUEUEgrab&format=text&user=" + user + "&pass=" + pass + "&conf_exten=" + session_id + "&extension=" + extension + "&protocol=" + protocol + "&campaign=" + campaign + "&stage=" + CQauto_call_id;
			 
			$.ajax({
				url: "vdc_db_query.php",
				data:RAview_query,
				success: function(htmls){ 
					
					var CQgrabresponse = htmls;
					var regCQerror = new RegExp("ERROR", "ig");
					if (CQgrabresponse.match(regCQerror)) {
						request_tip(CQgrabresponse,0);
					} else {
						AutoDial_ReSume_PauSe("VDADready", '', '', 'NO_STATUS_CHANGE');
						AutoDialWaiting = 1
					}
					
				}
			});	
                  
        }
    }
};


// ################################################################################
// RefresH the calls in queue bottombar
function refresh_calls_in_queue(CQcount) {
    if (CQcount > 0) {
        if (even > 0) {
            
 			RAview_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=CALLSINQUEUEview&format=text&user=" + user + "&pass=" + pass + "&conf_exten=" + session_id + "&extension=" + extension + "&protocol=" + protocol + "&campaign=" + campaign + "&stage=<?php echo $CQwidth ?>";
                 
            $.ajax({
				url: "vdc_db_query.php",
				data:RAview_query,
				success: function(htmls){ 
					$('#callsinqueuelist').html(htmls + "\n")
				}
			});	
 			   
        }
    }
};


// ################################################################################
// Open or close the callsinqueue view bottombar
function show_calls_in_queue(CQoperation) {
    if (CQoperation == 'SHOW') {
        $("#callsinqueuelink").html("<a href=\"javascript:void(0);\"  onclick=\"show_calls_in_queue('HIDE');\">隐藏队列中的电话</a>");
        view_calls_in_queue_active = 1;
        showDiv('callsinqueuedisplay')
    } else {
        $("#callsinqueuelink").html("<a href=\"javascript:void(0);\"  onclick=\"show_calls_in_queue('SHOW');\">显示队列中的电话</a>");
        view_calls_in_queue_active = 0;
        hideDiv('callsinqueuedisplay')
    }
};

// ################################################################################
// Open or close the agents view sidebar or xfer frame
function AgentsViewOpen(AVlocation, AVoperation) {
    if (AVoperation == 'open') {
        if (AVlocation == 'AgentViewSpan') {
            $("#AgentViewLink").html("<a href=\"javascript:void(0);\" onclick=\"AgentsViewOpen('AgentViewSpan','close');\">查看坐席 -</a>");
            agent_status_view_active = 1
        }
        showDiv(AVlocation)
    } else {
        if (AVlocation == 'AgentViewSpan') {
            $("#AgentViewLink").html("<a href=\"javascript:void(0);\" onclick=\"AgentsViewOpen('AgentViewSpan','open');\">查看坐席 +</a>");
            agent_status_view_active = 0
        }
        hideDiv(AVlocation)
    }
};

// ################################################################################
// Populate the number to dial field with the selected user ID
function AgentsXferSelect(AXuser, AXlocation) {
    xfer_select_agents_active = 0;
    $('#AgentXferViewSelect').html('');
    hideDiv('AgentXferViewSpan');
    hideDiv(AXlocation);
    $("#xfernumber").val(AXuser)
};
// ################################################################################
// OnChange function for transfer group select list
function XferAgentSelectLink() {
    var XScheck = document.getElementById("XfeRGrouP").value;
    //var XScheck = $("#XfeRGrouP").val();
    if (XScheck.match(/AGENTDIRECT/)) {
        showDiv('agentdirectlink')
    } else {
        hideDiv('agentdirectlink')
    }
};

// ################################################################################
// function for number to dial for AGENTDIRECT in-group transfers
function XferAgentSelectLaunch() {
    
    var XScheck = document.getElementById("XfeRGrouP").value;
    if (XScheck.match(/AGENTDIRECT/)) {
        showDiv('AgentXferViewSpan');
        AgentsViewOpen('AgentXferViewSelect', 'open');
        refresh_agents_view('AgentXferViewSelect', agent_status_view);
		xfer_select_agents_active = 1
    }
};

// ################################################################################
// Call ReQueue call back to AGENTDIRECT queue launch
function call_requeue_launch() {
    $("#xfernumber").val(user);
    var loop_ct = 0;
    var live_XfeR_HTML = '';
    var XfeR_SelecT = '';
    while (loop_ct < XFgroupCOUNT) {
        if (VARxfergroups[loop_ct] == 'AGENTDIRECT') {
            XfeR_SelecT = 'selected '
        } else {
            XfeR_SelecT = ''
        }
        live_XfeR_HTML = live_XfeR_HTML + "<option " + XfeR_SelecT + "value=\"" + VARxfergroups[loop_ct] + "\">" + VARxfergroups[loop_ct] + " - " + VARxfergroupsnames[loop_ct] + "</option>\n";
        loop_ct++
    }
    $("#XfeRGrouPLisT").html("<select size=1 name='XfeRGrouP'  id='XfeRGrouP' onChange=\"XferAgentSelectLink();\">" + live_XfeR_HTML + "</select>");
	
    mainxfer_send_redirect('XfeRLOCAL', lastcustchannel, lastcustserverip, '', 'NO');
    $("#DispoSelection").val('RQXFER');
	
    DispoSelect_submit();
    AutoDial_ReSume_PauSe("VDADpause", '', '', '', "REQUEUE");
    PauseCodeSelect_submit("RQUEUE")
};
 
// ################################################################################
// Move the Dispo frame out of the way and change the link to maximize
function DispoMinimize() {
    showDiv('DispoButtonHideA');
    showDiv('DispoButtonHideB');
    showDiv('DispoButtonHideC');
    $("#DispoSelectBox").css("top",340);
    $("#DispoSelectMaxMin").html("<a href='javascript:void(0);' class='zPushBtn'  onselectstart='return false' onclick=\"DispoMinimize()\" title=\"最小化\"><img src=\"/img/icons/icon003a17.gif\" /><strong>最小化&nbsp;</strong></a>")
};

// ################################################################################
// Move the Dispo frame to the top and change the link to minimize
function DispoMaximize() {
    $("#DispoSelectBox").css("top",1);
    $("#DispoSelectMaxMin").html("<a href='javascript:void(0);' class='zPushBtn'  onselectstart='return false' onclick=\"DispoMinimize()\" title=\"最小化\"><img src=\"/img/icons/icon003a17.gif\" /><strong>最小化&nbsp;</strong></a>");
    hideDiv('DispoButtonHideA');
    hideDiv('DispoButtonHideB');
    hideDiv('DispoButtonHideC')
};

// ################################################################################
// Show the groups selection span
function OpeNGrouPSelectioN() {
    if ((AutoDialWaiting == 1) || (VD_live_customer_call == 1) || (alt_dial_active == 1) || (MD_channel_look == 1)) {
 
		request_tip("您必须先暂停才能切换呼入组！",0);
    } else {
        if (manager_ingroups_set > 0) {
             
			request_tip("管理员 " + external_igb_set_name + " 已经为你设定了呼入组",0);
        } else {
            
            showDiv('CloserSelectBox')
        }
    }
};
// ################################################################################
// Show the territories selection span
function OpeNTerritorYSelectioN() {
    if ((AutoDialWaiting == 1) || (VD_live_customer_call == 1) || (alt_dial_active == 1) || (MD_channel_look == 1)) {
 		request_tip("您必须先暂停才能切换地区",0);
    } else {
        showDiv('TerritorySelectBox')
    }
};
// ################################################################################
// Hide the CBcommentsBox span upon click
function CBcommentsBoxhide() {
    CBentry_time = '';
    CBcallback_time = '';
    CBuser = '';
    CBcomments = '';
    $("#CBcommentsBoxA").html("");
    $("#CBcommentsBoxB").html("");
    $("#CBcommentsBoxC").html("");
    $("#CBcommentsBoxD").html("");
    hideDiv('CBcommentsBox')
};


// ################################################################################
// Hide the EAcommentsBox span upon click
function EAcommentsBoxhide(minimizetask) {
    hideDiv('EAcommentsBox');
    if (minimizetask == 'YES') {
        showDiv('EAcommentsMinBox')
    } else {
        hideDiv('EAcommentsMinBox')
    }
};

// ################################################################################
// Show the EAcommentsBox span upon click
function EAcommentsBoxshow() {
    showDiv('EAcommentsBox');
    hideDiv('EAcommentsMinBox')
};
// ################################################################################
// Populating the date field in the callback frame prior to submission
function CB_date_pick(taskdate) {
    $("#CallBackDatESelectioN").val(taskdate);
    $("#CallBackDatEPrinT").html(taskdate)
};
// ################################################################################
// Submitting the callback date and time to the system
function CallBackDatE_submit() {
    CallBackDatEForM = $("#CallBackDatESelectioN").val();
    CallBackCommenTs = $("#CallBackCommenTsField").val();
    if (CallBackDatEForM.length < 2) {
 		request_tip("您必须选择一个日期",0);
    } else { 
<?php
	if ($useIE > 0) { 
?>
		var CallBackTimEHouRFORM = document.getElementById('CBT_hour');
		var CallBackTimEHouR = CallBackTimEHouRFORM[CallBackTimEHouRFORM.selectedIndex].text;
		var CallBackTimEMinuteSFORM = document.getElementById('CBT_minute');
		var CallBackTimEMinuteS = CallBackTimEMinuteSFORM[CallBackTimEMinuteSFORM.selectedIndex].text;
		var CallBackTimEAmpMFORM = document.getElementById('CBT_ampm');
		var CallBackTimEAmpM = CallBackTimEAmpMFORM[CallBackTimEAmpMFORM.selectedIndex].text;
		CallBackTimEHouRFORM.selectedIndex = '0';
		CallBackTimEMinuteSFORM.selectedIndex = '0';
		CallBackTimEAmpMFORM.selectedIndex = '1'; 
<?php
	} else { 
?>
		CallBackTimEHouR = $("#CBT_hour").val();
		CallBackTimEMinuteS = $("#CBT_minute").val();
		CallBackTimEAmpM = $("#CBT_ampm").val();
		$("#CBT_hour").val('01');
		$("#CBT_minute").val('00');
		$("#CBT_ampm").val('PM'); 
<?php
	} 
?>
        if (CallBackTimEHouR == '12') {
            if (CallBackTimEAmpM == 'AM') {
                CallBackTimEHouR = '00'
            }
        } else {
            if (CallBackTimEAmpM == 'PM') {
                CallBackTimEHouR = CallBackTimEHouR * 1;
                CallBackTimEHouR = (CallBackTimEHouR + 12)
            }
        }
        CallBackDatETimE = CallBackDatEForM + " " + CallBackTimEHouR + ":" + CallBackTimEMinuteS + ":00";
        if ($("#CallBackOnlyMe").is(":checked") == true) {
            CallBackrecipient = 'USERONLY'
        } else {
            CallBackrecipient = 'ANYONE'
        }
		
        $("#CallBackDatEPrinT").html("选择一个日期");
        $("#CallBackOnlyMe").attr("checked",false);
        $("#CallBackDatESelectioN").val('');
        $("#CallBackCommenTsField").val('');
        $("#DispoSelection").val('CBHOLD');
        hideDiv('CallBackSelectBox');
        DispoSelect_submit()
    }
};	

// ################################################################################
// Finish the wrapup timer early
function TimerActionRun(taskaction, taskdialalert) {
    if (taskaction == 'DiaLAlerT') {
        $("#TimerContentSpan").html("<strong>拨号警告:<BR><BR>" + taskdialalert.replace("\n", "<BR>") + "</strong>");
        showDiv('TimerSpan')
    } else {
        if ((timer_action_message.length > 0) || (timer_action == 'MESSAGE_ONLY')) {
            $("#TimerContentSpan").html("<strong>计时器消息: " + timer_action_seconds + " 秒<BR><BR>" + timer_action_message + "</strong>");
            showDiv('TimerSpan')
        }
		
        if (timer_action == 'WEBFORM') {
            $("#WEBFORM_url").val(TEMP_VDIC_web_form_address);
			tab_frame('WEBFORM','y');
        }
		
        if (timer_action == 'WEBFORM2') {
			$("#WEBFORMTWO_url").val(TEMP_VDIC_web_form_address_two);
 			tab_frame('WEBFORMTWO','y');
        }
		
        if (timer_action == 'D1_DIAL') {
            DtMf_PreSet_a_DiaL()
        }
        if (timer_action == 'D2_DIAL') {
            DtMf_PreSet_b_DiaL()
        }
        if (timer_action == 'D3_DIAL') {
            DtMf_PreSet_c_DiaL()
        }
        if (timer_action == 'D4_DIAL') {
            DtMf_PreSet_d_DiaL()
        }
        if (timer_action == 'D5_DIAL') {
            DtMf_PreSet_e_DiaL()
        }
    }
    timer_action = 'NONE'
};


// ################################################################################
// Finish the wrapup timer early
function WrapupFinish(){
	wrapup_counter=999
};
 
// ################################################################################
// GLOBAL FUNCTIONS
function begin_all_refresh() { 
	<?php 
	if ( ($HK_statuses_camp > 0) && (($user_level>=$HKuser_level) or ($VU_hotkeys_active >0))){
		echo "document.onkeypress = hotkeypress;\n";
	} 
 	?>
	all_refresh();
}; 
	
function start_all_refresh() { 
       
	if(AutoDialWaiting==1 || VD_live_customer_call==1 || alt_dial_active==1 || MD_channel_look==1) {
 		$("#btn_new_manual_dial").addClass("btn-disabled").off();
    }else if(agentcall_manual=='1'){
	   $("#btn_new_manual_dial").removeClass("btn-disabled").off().on("click",function(){NeWManuaLDiaLCalL('NO');});	
	}
  
    if (VICIDiaL_closer_login_checked == 0) {
  
		$("div.dialog,#dialog_bg").hide();
        if (view_calls_in_queue_launch != '1') {
            hideDiv('callsinqueuedisplay')
        }
        if (agentonly_callbacks != '1') {
            hideDiv('CallbacksButtons')
        }
        /*if (allow_alerts < 1) {
            hideDiv('AgentAlertSpan')
        }*/
 		
        if (callholdstatus != '1') {
            $('#AgentStatusCalls').fadeOut();
        }
        if (agentcallsstatus != '1') {
            hideDiv('AgentStatusSpan')
        }
        if (((auto_dial_level > 0) && (dial_method != "INBOUND_MAN")) || (manual_dial_preview < 1)) {
            clearDiv('DiaLLeaDPrevieW')
        }
        if (alt_phone_dialing != 1) {
            clearDiv('DiaLDiaLAltPhonE')
        }
        if (volumecontrol_active != '1') {
            hideDiv('VolumeControlSpan')
        }
        if (DefaulTAlTDiaL == '1') {
            $("#DiaLAltPhonE").attr("checked",true)
        }
        if (agent_status_view != '1') {
            $("#AgentViewLink").html("")
        }
        if (dispo_check_all_pause == '1') {
            $("#DispoSelectStop").attr("checked",true)
        }
        $("#LeadLookuP").attr("checked",true);
		
        if (VICIDiaL_allow_closers < 1) {
            $("#LocalCloser").css("visibility",'hidden')
        }
        $("#sessionIDspan").html(session_id);
        if ((LIVE_campaign_recording == 'NEVER') || (LIVE_campaign_recording == 'ALLFORCE')) {
            //$("#RecorDControl").html("<img src=\"./images/vdc_LB_startrecording_OFF2.gif\" alt=\"开始录音\">");
			$("#RecorDControl").html("<img src=\"./images/vdc_LB_stoprecording_OFF2.gif\" alt=\"开始录音\">");
        }
        if (INgroupCOUNT > 0) {
            if (VU_closer_default_blended == 1) {
                $("#CloserSelectBlended").attr("checked",true)
            }
            CloserSelectContent_create();
            showDiv('CloserSelectBox');
            var CloserSelecting = 1;
            CloserSelectContent_create()
        } else {
            hideDiv('CloserSelectBox');
            MainPanelToFront();
            var CloserSelecting = 0;
            if (dial_method == "INBOUND_MAN"||dial_method== "MANUAL") {
                dial_method = "MANUAL";
                auto_dial_level = 0;
                starting_dial_level = 0;

				set_dial_btn_status("Manual_en");
            }
        }
        if (territoryCOUNT > 0) {
            showDiv('TerritorySelectBox');
            var TerritorySelecting = 1;
            TerritorySelectContent_create()
        } else {
            hideDiv('TerritorySelectBox');
            MainPanelToFront();
            var TerritorySelecting = 0
        }
        if ((VtigeRLogiNScripT == 'Y') && (VtigeREnableD > 0)) {
            
			$("#WEBFORM_url").val(VtigeRurl+ "/index.php?module=Users&action=Authenticate&return_module=Users&return_action=Login&user_name=" + user + "&user_password=" + pass + "&login_theme=softed&login_language=en_us");
			tab_frame('WEBFORM','y');
        }
        if ((VtigeRLogiNScripT == 'NEW_WINDOW') && (VtigeREnableD > 0)) {
            var VtigeRall = VtigeRurl + "/index.php?module=Users&action=Authenticate&return_module=Users&return_action=Login&user_name=" + user + "&user_password=" + pass + "&login_theme=softed&login_language=en_us";
            VtigeRwin = window.open(VtigeRall, web_form_target, 'toolbar=1,location=1,directories=1,status=1,menubar=1,scrollbars=1,resizable=1,width=700,height=480');
            VtigeRwin.blur()
        }
        if ((crm_popup_login == 'Y') && (crm_login_address.length > 4)) {
            var regWFAcustom = new RegExp("^VAR", "ig");
            URLDecode(crm_login_address, 'YES');
            var TEMP_crm_login_address = decoded;
            TEMP_crm_login_address = TEMP_crm_login_address.replace(regWFAcustom, '');
            var CRMwin = 'CRMwin';
            CRMwin = window.open(TEMP_crm_login_address, CRMwin, 'toolbar=1,location=1,directories=1,status=1,menubar=1,scrollbars=1,resizable=1,width=700,height=480');
            CRMwin.blur()
        }
        if (INgroupCOUNT > 0) {
            HidEGenDerPulldown()
        }
        VICIDiaL_closer_login_checked = 1
    } else {
        var WaitingForNextStep = 0;
        if ((CloserSelecting == 1) || (TerritorySelecting == 1)) {
            WaitingForNextStep = 1
        }
        if (open_dispo_screen == 1) {
			showDiv('DispoSelectBox');
            DispoSelectContent_create('', 'ReSET');
            wrapup_counter = 0;
            if (wrapup_seconds > 0) {
                showDiv('WrapupBox');
                $("#WrapupTimer").html(wrapup_seconds);
                wrapup_waiting = 1
            }
            CustomerData_update();
            $("#GENDERhideFORie").html('');
            
            WaitingForNextStep = 1;
            open_dispo_screen = 0;
            LIVE_default_xfer_group = default_xfer_group;
            LIVE_campaign_recording = campaign_recording;
            LIVE_campaign_rec_filename = campaign_rec_filename;
            if (disable_alter_custphone != 'HIDE') {
                $("#DispoSelectPhonE").html($("#phone_number").val())
            } else {
                $("#DispoSelectPhonE").html('');
            }
            if (auto_dial_level == 0) {
                if ($("#DiaLAltPhonE").is(":checked") == true) {
                    reselect_alt_dial = 1;

					request_tip("拨打下通电话",1);
					set_dial_btn_status("Manual_en");
                } else {
                    reselect_alt_dial = 0
                }
            }
        }
        if (AgentDispoing == 1) {
            WaitingForNextStep = 1;
            check_for_conf_calls(session_id, '0')
        }
        if (logout_stop_timeouts == 1) {
            WaitingForNextStep = 1
        }
		 
        if ((custchannellive < -300) && (lastcustchannel.length > 3) && (no_empty_session_warnings < 1)) {
            CustomerChanneLGone()
        }
        if ((custchannellive < -10) && (lastcustchannel.length > 3)) {
            ReChecKCustoMerChaN()
        }
        if ((nochannelinsession > 16) && (check_n > 15) && (no_empty_session_warnings < 1)) {
            NoneInSession()
			NoneIn_ShowPauseCodeSelect=1;
        }else{
			NoneIn_ShowPauseCodeSelect=0;
		}
		
        if (WaitingForNextStep == 0) {
            check_for_conf_calls(session_id, '0');
			
			if (all_record == 'YES') {
                /*if (all_record_count < allcalls_delay) {
                    all_record_count++
                } else {*/
                    conf_send_recording('MonitorConf', session_id, '');
                    all_record = 'NO';
                    all_record_count = 0
                /*}*/
            }
			
            if (agent_status_view_active > 0) {
                refresh_agents_view('AgentViewStatus', agent_status_view)
            }
            if (view_calls_in_queue_active > 0) {
                refresh_calls_in_queue(view_calls_in_queue)
            }
            if (xfer_select_agents_active > 0) {
                refresh_agents_view('AgentXferViewSelect', agent_status_view)
            }
            if (agentonly_callbacks == '1') {
                CB_count_check++
            }
            if (AutoDialWaiting == 1) {
                check_for_auto_incoming()
            }
			
            if (MD_channel_look == 1) {				
                ManualDialCheckChanneL(XDcheck)
            }
            if ((CB_count_check > 19) && (agentonly_callbacks == '1')) {
                CalLBacKsCounTCheck();
                CB_count_check = 0
            }
            if ((even > 0) && (agent_display_dialable_leads > 0)) {
                DiaLableLeaDsCounT()
            }
            if (VD_live_customer_call == 1) {
				
                VD_live_call_secondS++;
                $("#SecondS").val(VD_live_call_secondS);
				dial_ring_call_second=time_To_hhmmss(VD_live_call_secondS);
                $("#SecondSDISP").html(dial_ring_call_second);
				if($("#callchannel").val().substr(0,3)=="SIP"){
					$("#dial_ring_second").html(VD_live_call_secondS);
				}
            }
            if (XD_live_customer_call == 1) {
                XD_live_call_secondS++;
                $("#xferlength").val(XD_live_call_secondS)
            }
            if ((update_fields > 0) && (update_fields_data.length > 2)) {
                UpdateFieldsData()
            }
            if ((timer_action != 'NONE') && (timer_action.length > 3) && (timer_action_seconds <= VD_live_call_secondS) && (timer_action_seconds >= 0)) {
                TimerActionRun('', '')
            }
            if (HKdispo_display > 0) {
                if ((HKdispo_display == 3) && (HKfinish == 1)) {
                    HKfinish = 0;
                    DispoSelect_submit()
                }
                if (HKdispo_display == 1) {
                    if (hot_keys_active == 1) {
                        showDiv('HotKeyEntriesBox')
                    }
                    hideDiv('HotKeyActionBox')
                }
                HKdispo_display--
            }
            
            if (active_display == 1) {
                check_s = check_n.toString();
                if ((check_s.match(/00$/)) || (check_n < 2)) {}
            }
            if (check_n < 2) {} else {
                check_s = check_n.toString()
            }
            if (wrapup_seconds > 0) {
                $("#WrapupTimer").html((wrapup_seconds - wrapup_counter));
                wrapup_counter++;
                if ((wrapup_counter > wrapup_seconds) && ($("#WrapupBox").is(":visible")==true)) {
                    wrapup_waiting = 0;
                    hideDiv('WrapupBox');
                    if ($("#DispoSelectStop").is(":checked") == true) {
                        if (auto_dial_level != '0') {
                            AutoDialWaiting = 0;
                            AutoDial_ReSume_PauSe("VDADpause")
                        }
                        VICIDiaL_pause_calling = 1;
                        if (dispo_check_all_pause != '1') {
                            $("#DispoSelectStop").attr("checked",false);
 							request_tip("取消暂停",0);
                        }
                    } else {
                        if (auto_dial_level != '0') {
                            AutoDialWaiting = 1;
                            AutoDial_ReSume_PauSe("VDADready", "NEW_ID", "WRAPUP")
                        }
                    }
                }
            }
        }
    }
    setTimeout("all_refresh()", refresh_interval)
};
	

function all_refresh() {
    epoch_sec++;
    check_n++;
    even++;
    if (even > 1) {
        even = 0
    }
    var year = t.getYear();
	var month = t.getMonth();
	month++;
    var daym = t.getDate();
	var hours = t.getHours();
    var min = t.getMinutes();
    var sec = t.getSeconds();
    var regMSdate = new RegExp("MS_", "g");
    var regUSdate = new RegExp("US_", "g");
    var regEUdate = new RegExp("EU_", "g");
    var regALdate = new RegExp("AL_", "g");
    var regAMPMdate = new RegExp("AMPM", "g");
    if (year < 1000) {
        year += 1900
    }
    if (month < 10) {
        month = "0" + month
    }
    if (daym < 10) {
        daym = "0" + daym
    }
    if (hours < 10) {
        hours = "0" + hours
    }
    if (min < 10) {
        min = "0" + min
    }
    if (sec < 10) {
        sec = "0" + sec
    }
    var Tyear = (year - 2000);
    filedate = year + "" + month + "" + daym + "-" + hours + "" + min + "" + sec;
    tinydate = Tyear + "" + month + "" + daym + "" + hours + "" + min + "" + sec;
    SQLdate = year + "-" + month + "-" + daym + " " + hours + ":" + min + ":" + sec;
    var status_date = '';
    var status_time = hours + ":" + min + ":" + sec;
    if (vdc_header_date_format.match(regMSdate)) {
        status_date = year + "-" + month + "-" + daym
    }
   /* if (vdc_header_date_format.match(regUSdate)) {
        status_date = month + "/" + daym + "/" + year
    }
    if (vdc_header_date_format.match(regEUdate)) {
        status_date = daym + "/" + month + "/" + year
    }
    if (vdc_header_date_format.match(regALdate)) {

        var statusmon = '';
        if (month == 1) {
            statusmon = "一月"
        }
        if (month == 2) {
            statusmon = "二月"
        }
        if (month == 3) {
            statusmon = "三月"
        }
        if (month == 4) {
            statusmon = "四月"
        }
        if (month == 5) {
            statusmon = "五月"
        }
        if (month == 6) {
            statusmon = "六月"
        }
        if (month == 7) {
            statusmon = "七月"
        }
        if (month == 8) {
            statusmon = "八月"
        }
        if (month == 9) {
            statusmon = "九月"
        }
        if (month == 10) {
            statusmon = "十月"
        }
        if (month == 11) {
            statusmon = "十一月"
        }
        if (month == 12) {
            statusmon = "十二月"
        }
        status_date = statusmon + " " + daym
    }
    if (vdc_header_date_format.match(regAMPMdate)) {
        var AMPM = '上午';
        if (hours == 12) {
            AMPM = '下午'
        }
        if (hours == 0) {
            AMPM = '上午';
            hours = '12'
        }
        if (hours > 12) {
            hours = (hours - 12);
            AMPM = '下午'
        }
        status_time = hours + ":" + min + ":" + sec + " " + AMPM
    }*/
    $("#status").html(status_date + " " + status_time + display_message);
	
    /*if (VD_live_customer_call == 1) {
        var customer_gmt = parseFloat($("#gmt_offset_now").val());
        var AMPM = '上午';
        var customer_gmt_diff = (customer_gmt - local_gmt);
        var UnixTimec = (UnixTime + (3600 * customer_gmt_diff));
        var UnixTimeMSc = (UnixTimec * 1000);
        c.setTime(UnixTimeMSc);
        var Cyear = c.getYear();
		var Cmon = c.getMonth();
		Cmon++;
        var Cdaym = c.getDate();
		var Chours = c.getHours();
        var Cmin = c.getMinutes();
        var Csec = c.getSeconds();
        if (Cyear < 1000) {
            Cyear += 1900
        }
        if (Cmon < 10) {
            Cmon = "0" + Cmon
        }
        if (Cdaym < 10) {
            Cdaym = "0" + Cdaym
        }
        if (Chours < 10) {
            Chours = "0" + Chours
        }
        if ((Cmin < 10) && (Cmin.length < 2)) {
            Cmin = "0" + Cmin
        }
        if ((Csec < 10) && (Csec.length < 2)) {
            Csec = "0" + Csec
        }
        if (Cmin < 10) {
            Cmin = "0" + Cmin
        }
        if (Csec < 10) {
            Csec = "0" + Csec
        }
        var customer_date = '';
        var customer_time = Chours + ":" + Cmin + ":" + Csec;
        if (vdc_customer_date_format.match(regMSdate)) {
            customer_date = Cyear + "-" + Cmon + "-" + Cdaym
        }
        if (vdc_customer_date_format.match(regUSdate)) {
            customer_date = Cmon + "/" + Cdaym + "/" + Cyear
        }
        if (vdc_customer_date_format.match(regEUdate)) {
            customer_date = Cdaym + "/" + Cmon + "/" + Cyear
        }
        if (vdc_customer_date_format.match(regALdate)) {
            var customermon = '';
            if (Cmon == 1) {
                customermon = "一月"
            }
            if (Cmon == 2) {
                customermon = "二月"
            }
            if (Cmon == 3) {
                customermon = "三月"
            }
            if (Cmon == 4) {
                customermon = "四月"
            }
            if (Cmon == 5) {
                customermon = "五月"
            }
            if (Cmon == 6) {
                customermon = "六月"
            }
            if (Cmon == 7) {
                customermon = "七月"
            }
            if (Cmon == 8) {
                customermon = "八月"
            }
            if (Cmon == 9) {
                customermon = "九月"
            }
            if (Cmon == 10) {
                customermon = "十月"
            }
            if (Cmon == 11) {
                customermon = "十一月"
            }
            if (Cmon == 12) {
                customermon = "十二月"
            }
            customer_date = customermon + " " + Cdaym + " "
        }
        if (vdc_customer_date_format.match(regAMPMdate)) {
            var AMPM = '上午';
            if (Chours == 12) {
                AMPM = '下午'
            }
            if (Chours == 0) {
                AMPM = '上午';
                Chours = '12'
            }
            if (Chours > 12) {
                Chours = (Chours - 12);
                AMPM = '下午'
            }
            customer_time = Chours + ":" + Cmin + ":" + Csec + " " + AMPM
        }
        var customer_local_time = customer_date + " " + customer_time;
        $("#custdatetime").val(customer_local_time)
    }*/
    start_all_refresh()
};

function pause() {
    active_display = 2;
    display_message = "  - 暂停刷新客户清单 - "
};

function start() {
    active_display = 1;
    display_message = ''
};

function faster() {
    if (refresh_interval > 1001) {
        refresh_interval = (refresh_interval - 1000)
    }
};

function slower() {
    refresh_interval = (refresh_interval + 1000)
};

function activeext_force_refresh() {
    getactiveext()
};

function activeext_order_asc() {
    activeext_order = "asc";
    getactiveext();
    desc_order_HTML = '<a href="javascript:void(0);" onclick="activeext_order_desc();">排序</a>';
    $("#activeext_order").html(desc_order_HTML)
};

function activeext_order_desc() {
    activeext_order = "desc";
    getactiveext();
    asc_order_HTML = '<a href="javascript:void(0);" onclick="activeext_order_asc();">排序</a>';
    $("#activeext_order").html(asc_order_HTML)
};

function busytrunk_force_refresh() {
    getbusytrunk()
};

function busytrunk_order_asc() {
    busytrunk_order = "asc";
    getbusytrunk();
    desc_order_HTML = '<a href="javascript:void(0);" onclick="busytrunk_order_desc();">排序</a>';
    $("#busytrunk_order").html(desc_order_HTML)
};

function busytrunk_order_desc() {
    busytrunk_order = "desc";
    getbusytrunk();
    asc_order_HTML = '<a href="javascript:void(0);" onclick="busytrunk_order_asc();">排序</a>';
    $("#busytrunk_order").html(asc_order_HTML)
};

function busytrunkhangup_force_refresh() {
    busytrunkhangup()
};

function busyext_force_refresh() {
    getbusyext()
};

function busyext_order_asc() {
    busyext_order = "asc";
    getbusyext();
    desc_order_HTML = '<a href="javascript:void(0);" onclick="busyext_order_desc();">排序</a>';
    $("#busyext_order").html(desc_order_HTML)
};

function busyext_order_desc() {
    busyext_order = "desc";
    getbusyext();
    asc_order_HTML = '<a href="javascript:void(0);" onclick="busyext_order_asc();">排序</a>';
    $("#busyext_order").html(asc_order_HTML)
};

function busylocalhangup_force_refresh() {
    busylocalhangup()
};

// functions to hide and show different DIVs
	
function clearDiv(divvar) {
     
	$("#"+divvar).html('');
	if (divvar == 'DiaLLeaDPrevieW') {
		var buildDivHTML = "<input type=\"checkbox\" name=\"LeadPreview\" id=\"LeadPreview\" size='1' value=\"0\"><label for=\"LeadPreview\" title=\"预览将要拨打的号码，可选择继续呼叫与跳过选择下一个号码\">预览</label>";
		$("#DiaLLeaDPrevieWHide").html(buildDivHTML)
	}
	if (divvar == 'DiaLDiaLAltPhonE') {
		/*var buildDivHTML = " <input type='checkbox' name='DiaLAltPhonE' id='DiaLAltPhonE' size='1' value=\"0\"><label for=\"DiaLAltPhonE\">拨打备用号码</label>";
		$("#DiaLDiaLAltPhonEHide").html(buildDivHTML)*/
	}
	if (DefaulTAlTDiaL == '1') {
		$("#DiaLAltPhonE").attr("checked",true)
	}
     
};	
	
function buildDiv(divvar,is_skip) {
	var buildDivHTML = "";
	if (divvar == 'DiaLLeaDPrevieW') {
		$("#DiaLLeaDPrevieWHide").html('');
		var buildDivHTML = "<input type=\"checkbox\" name=\"LeadPreview\" id=\"LeadPreview\" size=1 value=\"0\"><label for=\"LeadPreview\" title=\"预览将要拨打的号码，可选择继续呼叫与跳过选择下一个号码\">预览</label>";
		$("#"+divvar).html(buildDivHTML);
		if(is_skip=="N"){
			$("#LeadPreview").attr("is_skip","N")
		}else{
			$("#LeadPreview").attr("is_skip","")
		}
		if (reselect_preview_dial == 1) {
			$("#LeadPreview").attr("checked",true)
		}
	}
	/*if (divvar == 'DiaLDiaLAltPhonE') {
		$("#DiaLDiaLAltPhonEHide").html('');
		
		var buildDivHTML = "<label for=\"DiaLAltPhonE\"><input type=\"checkbox\" name=\"DiaLAltPhonE\"  id=\"DiaLAltPhonE\" size=1 value=\"0\"> 拨打备用号码</label><BR>";
		
		$("#"+divvar).html(buildDivHTML);
		
		if (reselect_alt_dial == 1) {
			$("#DiaLAltPhonE").attr("checked",true)
		}
		if (DefaulTAlTDiaL == '1') {
			$("#DiaLAltPhonE").attr("checked",true)
		}
	}*/
};
	

function conf_channels_detail(divvar) {
    if (divvar == 'SHOW') {
        conf_channels_xtra_display = 1;
        $("#busycallsdisplay").html("<a href=\"javascript:void(0);\"  onclick=\"conf_channels_detail('HIDE');\">隐藏会议室通道信息</a>");
        LMAe[0] = '';
        LMAe[1] = '';
        LMAe[2] = '';
        LMAe[3] = '';
        LMAe[4] = '';
        LMAe[5] = '';
        LMAcount = 0
    } else {
        conf_channels_xtra_display = 0;
        $("#busycallsdisplay").html("<a href=\"javascript:void(0);\"  onclick=\"conf_channels_detail('SHOW');\">显示会议室通道信息</a><BR><BR>&nbsp;");
        $("#outboundcallsspan").html('');
        LMAe[0] = '';
        LMAe[1] = '';
        LMAe[2] = '';
        LMAe[3] = '';
        LMAe[4] = '';
        LMAe[5] = '';
        LMAcount = 0
    }
};
		

function HotKeys(HKstate) {
    if ((HKstate == 'ON') && (HKbutton_allowed == 1)) {
        showDiv('HotKeyEntriesBox');
        hot_keys_active = 1;
        $("#hotkeysdisplay").html("<a href=\"javascript:void(0);\" onMouseOut=\"HotKeys('OFF')\"><img src=\"./images/vdc_XB_hotkeysactive.gif\" alt=\"激活热键\"></a>")
    } else {
        hideDiv('HotKeyEntriesBox');
        hot_keys_active = 0;
        $("#hotkeysdisplay").html("<a href=\"javascript:void(0);\" onMouseOver=\"HotKeys('ON')\"><img src=\"./images/vdc_XB_hotkeysactive_OFF.gif\" alt=\"关闭热键\"></a>")
    }
};
		

function ShoWTransferMain(showxfervar, showoffvar) {
	
    if (VU_vicidial_transfers == '1') {
        XferAgentSelectLink();
        if (showxfervar == 'ON') {
            var xfer_height = <?php echo $HTheight ?>;
            if (alt_phone_dialing > 0) {
                xfer_height = (xfer_height + 20)
            }
            if ((auto_dial_level == 0) && (manual_dial_preview == 1)) {
                xfer_height = (xfer_height + 20)
            }
            $("#TransferMain").css("top",xfer_height);
            HKbutton_allowed = 0;
            showDiv('TransferMain');
            $("#XferControl").html("<a href=\"javascript:void(0);\" ><img src=\"./images/vdc_LB_transferconf.gif\" alt=\"会议 - 转接\"></a>");//onclick=\"ShoWTransferMain('OFF','YES');\"
            if (quick_transfer_button_enabled > 0) {
                $("#QuickXfer").html("<img src=\"./images/vdc_LB_quickxfer_OFF.gif\" alt=\"快速转接\">")
            }
        } else {
            HKbutton_allowed = 1;
            hideDiv('TransferMain');
            hideDiv('agentdirectlink');
            if (showoffvar == 'YES') {
                $("#XferControl").html("<a href=\"javascript:void(0);\" ><img src=\"./images/vdc_LB_transferconf.gif\" alt=\"会议 - 转接\"></a>");//onclick=\"ShoWTransferMain('ON');\"
                if (quick_transfer_button == 'IN_GROUP') {
                    $("#QuickXfer").html("<a href=\"javascript:void(0);\" onclick=\"mainxfer_send_redirect('XfeRLOCAL','" + lastcustchannel + "','" + lastcustserverip + "');\"><img src=\"./images/vdc_LB_quickxfer.gif\" alt=\"快速转接\"></a>")
                }
                if ((quick_transfer_button == 'PRESET_1') || (quick_transfer_button == 'PRESET_2') || (quick_transfer_button == 'PRESET_3') || (quick_transfer_button == 'PRESET_4') || (quick_transfer_button == 'PRESET_5')) {
                    $("#QuickXfer").html("<a href=\"javascript:void(0);\" onclick=\"mainxfer_send_redirect('XfeRBLIND','" + lastcustchannel + "','" + lastcustserverip + "');\"><img src=\"./images/vdc_LB_quickxfer.gif\" alt=\"快速转接\"></a>")
                }
            }
        }
        if (three_way_call_cid == 'AGENT_CHOOSE') {
            if ((active_group_alias.length < 1) && (LIVE_default_group_alias.length > 1) && (LIVE_caller_id_number.length > 3)) {
                active_group_alias = LIVE_default_group_alias;
                cid_choice = LIVE_caller_id_number
            }
            $("#XfeRDiaLGrouPSelecteD").html("组别名: " + active_group_alias + "");
            $("#XfeRCID").html("<a href=\"javascript:void(0);\" onclick=\"GroupAliasSelectContent_create('1');\">点击此处选择组别名</a>")
        } else {
            $("#XfeRCID").html("");
            $("#XfeRDiaLGrouPSelecteD").html("")
        }
    } else {
        if (showxfervar != 'OFF') {
 			request_tip("您没有权限转接电话",0);
        }
    }
};


function MainPanelToFront(resumevar) {
	
    if (resumevar != 'NO') {
        if (alt_phone_dialing == 1) {
            buildDiv('DiaLDiaLAltPhonE')
        } else {
            clearDiv('DiaLDiaLAltPhonE')
        }
        if (auto_dial_level == 0) {
            if (auto_dial_alt_dial == 1) {
                auto_dial_alt_dial = 0;
				
				$("#btn_vdc_pause,#btn_vdc_resume").addClass("btn-disabled").off().show();
				$("#btn_vdc_dialnext,#btn_vdc_pause_m").hide();
				$("#btn_vdc_dialnext,#btn_vdc_dialnext_2,#btn_vdc_pause_m").addClass("btn-disabled").off();
            } else {
                
				
				set_dial_btn_status("Manual_en");
				if (manual_dial_preview == 1) {
                    buildDiv('DiaLLeaDPrevieW')
                }
            }
        } else {
            if (dial_method == "INBOUND_MAN"||dial_method== "MANUAL") {
				
				set_dial_btn_status("Manual_en");
                if (manual_dial_preview == 1) {
                    buildDiv('DiaLLeaDPrevieW')
                }
				
            } else {
				set_dial_btn_status("Auto_re_en");				
                clearDiv('DiaLLeaDPrevieW')
            }
        }
    }
    
    
};

function ScriptPanelToFront(){};

function HidEGenDerPulldown(){};

function ShoWGenDerPulldown(){};
 
function request_tip(tip,is_yes,times){if(times==""||times==null){times=4300}$('#auto_save_res').html(tip).css({top:$(document).scrollTop(),right:($(document).width()-$('#auto_save_res').outerWidth())/2}).fadeIn("slow");if(is_yes=="1"){$('#auto_save_res').removeClass("red_layer").addClass("green_layer")}else{$('#auto_save_res').removeClass("green_layer").addClass("red_layer")}setTimeout("$('#auto_save_res').fadeOut('fast');",times)};
   
function time_To_hhmmss(seconds){var hh;var mm;var ss;if(seconds==null||seconds<0){return}hh=seconds/3600|0;seconds=parseInt(seconds)-hh*3600;if(parseInt(hh)<10){hh="0"+hh}mm=seconds/60|0;ss=parseInt(seconds)-mm*60;if(parseInt(mm)<10){mm="0"+mm}if(ss<10){ss="0"+ss}return hh+":"+mm+":"+ss}

jQuery.fn.center=function(absolute){var t=$(this);t.addClass("dialog_pos").css({marginLeft:-+(t.outerWidth()/2),marginTop:-(t.outerHeight()/2)}).animate({marginTop:-(t.outerHeight()/2)},300);t=undefined;};
  
function tab_frame(tab_id,up_url,is_show) {
	if(tab_id==""||tab_id==undefined){
		tab_id="SCRIPT";
	}
	var url=$("#"+tab_id+"_url").val();
	
    $("#tabs a").removeClass("tab_on");
    $("#tab_li_"+tab_id).addClass("tab_on");
	
    $("iframe[id!='frame_c_"+tab_id+"']").attr("height", "0").hide();
	
	if(tab_id=="WEBFORM"&&VICIDiaL_web_form_address=="about:blank"){
		url=""
	}else if(tab_id=="WEBFORMTWO"&&VICIDiaL_web_form_address_two=="about:blank"){
		url=""
	}else if(tab_id=="SCRIPT"&&campaign_script=="NONE"){
		url="vdc_script_none.php?web_form=script"
	}
	
 	frame_c_id=$("#frame_c_"+tab_id);
	
    if(frame_c_id.length<1){
 		$("#tab_content").append("<iframe id='frame_c_"+tab_id+"' width='100%' frameborder='0' ></iframe>");
		frame_c_id=$("#frame_c_"+tab_id);
		//frame_c_id[0].contentWindow.document.write('');
		//frame_c_id[0].contentWindow.close();
		frame_c_id.attr("src","about:blank");
		frame_c_id.attr("src",url);
	}else if(up_url=="y"){	
		//frame_c_id[0].contentWindow.document.write('');
		//frame_c_id[0].contentWindow.close();
		frame_c_id.attr("src","about:blank");	
		frame_c_id.attr("src",url);		
	}
 	 
	frame_c_id.show().attr("height",$("#BottomPane").height()-30+"px");
	$("#tabs").data("tab_id",tab_id);
	url=undefined;
	frame_c_id=undefined;
};
  
function showDiv(elm) {
 	
	$("div.dialog").css("z-index",200);
	div=$("#"+elm);
 	if(div.length>0){
 		div.css("z-index",216).show().center();
 		$("#dialog_bg").css("z-index",206).show();
 	}
	div=undefined;
};
		
function hideDiv(elm){
 	$("#dialog_bg").hide();
	div=$("#"+elm);
	if(div.is(":visible")==true){
 		div.hide();
 		$vis=$("div.dialog:visible");if($vis.length>0){$last=$vis.last();$("#dialog_bg").show();$last.css("z-index",220)}
  	}
	div=undefined;
};
 
function hide_note_side(){$('#note-side').animate({right:"-240px"},400)};

function get_c_n_list(actions,loading){if(logout_stop_timeouts==0){$('#side_loading_'+loading).show();var url="action="+actions+"&user="+user+"&user_group="+VU_user_group+"&campaign_id="+campaign;$.ajax({type:"post",dataType:"json",url:"work_send.php",data:url,beforeSend:function(){$('#side_loading_'+loading).show('100')},complete:function(){$('#side_loading_'+loading).hide('100')},success:function(json){if(actions=="get_notice_list"){$("#notice_list li").remove();if(parseInt(json.counts)>0){var tits="";td_str="";fun_str="";qua_str="";$.each(json.datalist,function(index,con){is_new="";if(con.is_read=='0'){is_new=" <span class='red'>新</span>"}tr_str="<li><div><a href='javascript:void(0)' title='"+con.notice_title+"' onclick=\"show_Notice('"+con.notice_id+"');\">"+con.notice_title+is_new+"</a> </div></li>";$("#notice_list").append(tr_str)})}else{tr_str="<li><div>"+json.des+"</div></li>";$("#notice_list").append(tr_str)}}else if(actions=="get_work_count"){f_cg="0";f_counts="0";f_user="NA";f_name="NA";f_cgl="0%";c_f_cg="0";c_f_counts="0";c_f_user="NA";c_f_name="NA";c_f_cgl="0%";s_cg="0";s_counts="0";s_cgl="0%";s_order="0";g_order="0";c_s_cg="0";c_s_counts="0";c_s_cgl="0%";c_s_order="0";if(parseInt(json.counts)>0){$.each(json.datalist,function(index,con){if(con.order=="1"){f_cg=con.cg;f_counts=con.counts;f_user=con.user;f_name=con.full_name;f_cgl=con.cgl;f_order=con.order}if(con.user==user){s_cg=con.cg;s_counts=con.counts;s_cgl=con.cgl;s_order=con.order;g_order=json.group_order}})}if(parseInt(json.cam_counts)>0){$.each(json.datalist_cam,function(index,con){if(con.order=="1"){c_f_cg=con.cg;c_f_counts=con.counts;c_f_user=con.user;c_f_name=con.full_name;c_f_cgl=con.cgl;c_f_order=con.order}if(con.user==user){c_s_cg=con.cg;c_s_counts=con.counts;c_s_cgl=con.cgl;c_s_order=con.order}})}$("#sys_cam_count").html("业务排名：<span class='blue_tip'>"+c_s_order+"</span> / <span class='blue_tip'>"+c_s_cg+"</span> / <span class='blue_tip'>"+c_s_counts+"</span> / <span class='blue_tip'>"+c_s_cgl+"</span>").attr("title","本工号在当前业务内，排名："+c_s_order+"/成功量："+c_s_cg+"/呼叫量："+c_s_counts+"/成功率："+c_s_cgl);$("#sys_cam_count_top").html("业务最高：<span class='green'>"+c_f_name+" ["+c_f_user+"]</span> / <span class='blue_tip'>"+c_f_cg+"</span> / <span class='blue_tip'>"+c_f_counts+"</span> / <span class='blue_tip'>"+c_f_cgl+"</span>").attr("title","当前业务内成功量最高，工号："+c_f_name+" ["+c_f_user+"]/成功量："+c_f_cg+"/呼叫量："+c_f_counts+"/成功率："+c_f_cgl);$("#sys_work_count").html("系统排名：<span class='blue_tip'>"+s_order+"</span> / <span class='blue_tip'>"+s_cg+"</span> / <span class='blue_tip'>"+s_counts+"</span> / <span class='blue_tip'>"+s_cgl+"</span>").attr("title","本工号在整个系统内，排名："+s_order+"/成功量："+s_cg+"/呼叫量："+s_counts+"/成功率："+s_cgl);$("#sys_work_count_top").html("系统最高：<span class='green'>"+f_name+" ["+f_user+"]</span> / <span class='blue_tip'>"+f_cg+"</span> / <span class='blue_tip'>"+f_counts+"</span> / <span class='blue_tip'>"+f_cgl+"</span>").attr("title","在整个系统内成功量最高，工号："+f_name+" ["+f_user+"]/成功量："+f_cg+"/呼叫量："+f_counts+"/成功率："+f_cgl);$("#sys_work_count_group").html("本组排名：<span class='red'>"+g_order+"</span>").attr("title","本工号在所属组，排名："+g_order)}else{if(parseInt(json.n_counts)>0){$("#notice_read_alter").html(json.n_counts).attr("title","您有 "+json.n_counts+" 条未查看公告")}else{$("#notice_read_alter").html("0").attr("title","您有 0 条未查看公告")}setTimeout("get_c_n_list('get_notice_alter','noald')",140000)}}})}};

function show_Notice(cid){$('#side_loading_n_con').show();if(cid=="0"){cid=$("#notice_Box").data("cid")}var url="action=get_notice_con&cid="+cid+"&user="+user;$("#notice_Box").data("cid",cid);$.ajax({type:"post",dataType:"json",url:"work_send.php",data:url,beforeSend:function(){$('#side_loading_n_con').show('100')},complete:function(){$('#side_loading_n_con').hide('100')},success:function(json){if(parseInt(json.counts)>0){notice_title=json.notice_title;notice_addtime=json.addtime;notice_content=json.notice_content;full_name=json.full_name;user_id=json.user_id;if(json.is_read==0){$("#c_notice_read").html("<span class='red'>否</span>");set_notice_read(cid)}else{$("#c_notice_read").html("<span class='green'>是</span>")}}else{notice_title="公告不存在";notice_addtime="";notice_content="";full_name="";user_id=""}$("#c_notice_title").html(notice_title);$("#c_notice_addtime").html(notice_addtime);$("#c_notice_content").html(notice_content);$("#c_notice_full_name").html(full_name);$("#c_notice_user_id").html(user_id)}});showDiv("notice_Box")};

function set_notice_read(cid){if(cid!=""&&cid!=null){var url="action=set_notice_read&cid="+cid+"&user="+user;$.ajax({type:"post",dataType:"json",url:"work_send.php",data:url,success:function(json){}})}};

function random_time(){return "&ran_times="+new Date().getTime()+"&ran_round="+Math.random() };

function get_dtmf(){
	//console.log($("#uniqueid").val()+""+$("#call_status_hangup").hasClass("focus"));
	var dtmf_id=$("#dtmf_list").attr("dtmf_id");if($("#uniqueid").val()!=""&&$("#call_status_hangup").hasClass("focus")){var datas="action=get_dtmf&uniqueid="+$("#uniqueid").val()+"&dtmf_id="+dtmf_id;
	//console.log(datas);
	$.ajax({url:"work_send.php",data:datas,dataType:"json",success:function(json){if(json.counts=="1"){//console.log(json.dtmf_key);
		$("#dtmf_list").attr("dtmf_id",json.dtmf_id).append("<li>客户按了：<span>"+json.dtmf_key+"</span></li>");}}});}else if($("#uniqueid").val()==""){$("#dtmf_list li").remove();}setTimeout("get_dtmf()",500);};
 
$(document).ready(function(){
	begin_all_refresh();
	
	$(":text").addClass("inputText").hover(function(){$(this).addClass("inputTextHover")},function(){$(this).removeClass("inputTextHover")}).focus(function(){$(this).removeClass("inputText inputTextHover").addClass("input_focus")}).blur(function(){$(this).addClass("inputText").removeClass("input_focus inputTextHover")});
	
	$("#MySplitter").splitter({type:"h",sizeTop:true,accessKey:"P"});
 	
 	var url_ext="&user="+user+"&campaign="+campaign+"&group="+group+"&list_id="+mdnLisT_id;
	
	if(VICIDiaL_web_form_address.indexOf("?")>-1){
		$("#WEBFORM_url").val(VICIDiaL_web_form_address+url_ext);
	}else{
		$("#WEBFORM_url").val(VICIDiaL_web_form_address+"?"+url_ext);
	}
	
	if(VICIDiaL_web_form_address_two.indexOf("?")>-1){
		$("#WEBFORMTWO_url").val(VICIDiaL_web_form_address_two+url_ext);
	}else{
		$("#WEBFORMTWO_url").val(VICIDiaL_web_form_address_two+"?"+url_ext);	
	}
 	
	$("#SCRIPT_url").val("vdc_script_display_new.php?server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ScrollDIV=1&camp_script=" + campaign_script + "&phone_number=13589104688"+url_ext);
	
	if (get_call_launch == 'SCRIPT'||get_call_launch == 'NONE') {
 		if(campaign_script=="NONE"){
			$("#SCRIPT_url").val("vdc_script_none.php");
		}
		tab_frame('SCRIPT');
		
	}else if (get_call_launch == 'WEBFORM') {
		tab_frame('WEBFORM');
	}else{
		tab_frame('WEBFORMTWO');
	}
	
	$('#close-sidebar').toggle(function(){
		
		get_c_n_list('get_notice_list','notice');
		get_c_n_list('get_work_count','count');
  		$('#note-side').animate({right:"0px"},300);
 		
 		},function(){
  		$('#note-side').animate({right: "-240px"}, 400);
 	});
	get_c_n_list('get_notice_alter','noald');
	
 	$("a[href^='javascript:void(0)']").live("click",function(e){e.preventDefault();});
	
	$("#show_dtmf_btn").toggle(function(){
		$("#dtmf_layer").css("display","inline-block").fadeIn();
		$("#dtmf_layer a").each(function(i,e){
 			$(this).off().on("click",function(){$("#conf_dtmf").val($(this).text());SendConfDTMF(session_id);}).attr("title","点击发送："+$(this).text());
         });
	},function(){
		$("#dtmf_layer").fadeOut("fast");	
 	});
	 
	
	/*if(dial_method!= "INBOUND_MAN"&&dial_method!= "MANUAL"){
		$("#alert_enabled_btn").removeClass("hide");
		if(allow_alerts=="1"){
			alert_enabled = 'ON';
			$("#alert_enabled_chk").attr("checked",true);
			$("#alert_enabled_btn").addClass("green");
		} 
		
		$("#alert_enabled_chk").click(function(){
		 
			if(this.checked==true){
				request_tip("进线提醒音已开启",1);
				alert_enabled = 'ON';
				$("#alert_enabled_btn").addClass("green");
			}else{
				request_tip("进线提醒音已关闭",0);
				alert_enabled = 'OFF';
				$("#alert_enabled_btn").removeClass("green"); 	
			}
		});	
	}*/
	
	$(".pnumber_del").click(function() {
		var numbers = $('#MDPhonENumbeR_text').text();
		var numbers2 = $('#MDPhonENumbeR_text').text().length;
		$('#MDPhonENumbeR_text').text(numbers.substr(0, numbers2 - 1));
		$("#MDPhonENumbeR").val($('#MDPhonENumbeR_text').text());
	});
	

	$(".number_list a").click(function() { 
		$("#MDPhonENumbeR_text").append($(this).text());
		$("#MDPhonENumbeR").val($('#MDPhonENumbeR_text').text());
		
	});
	if(display_dtmf_alter=="Y"){
		get_dtmf();
	}
	window.onbeforeunload = function(){
		return "您点击了刷新或关闭本页面，此操作将会引起系统数据异常！\n请点击\"返回\"按钮，并保存当前拨打的通话信息后，再点击\"签退重登\"链接来退出系统！\n";
		if (logout_stop_timeouts < 1) {
			
			if (VDRP_stage != 'PAUSED') {
				AutoDialWaiting = 0;
				AutoDial_ReSume_PauSe("VDADpause", '', '', '', "LOGOUT")
			}
 			
			LogouT('CLOSE'); 
			$("#LOGOUT_href").css("color","#ff0000");
			$("#frame_c_SCRIPT").attr("src","about:blank");
			$("#frame_c_WEBFORM").attr("src","about:blank");
			$("#frame_c_WEBFORMTWO").attr("src","about:blank");
			$("#frame_c_HIS").attr("src","about:blank");
			
			setTimeout('$("#LOGOUT_href").css("color","#FFF")',5000);
 			window.onbeforeunload = null;
		}
	}
	  
});


</script>
</head>
<!-- onunload="BrowserCloseLogout()"-->
<body>
<div class="hide"><img src="images/vdc_LB_startrecording2.gif"/><img src="images/vdc_LB_stoprecording_OFF2.gif"/></div>
<div id="auto_save_res" class="load_layer"></div>

<div id="dialog_bg"></div>
<?php require("agc_dialog_box.php")?>
 
<div class="frame-header">
  <h1 class="frame-logo"><a href="javascript:void(0);" title="<?php echo $system_info ?>"></a></h1>
  <ul class="user-menu">
    <li><a href="javascript:void(0);" class="menu-switch menu-arrow" title="当前时间">当前时间：<b class="no-data" id="status"></b></a></li>
    <li><a href="javascript:void(0);" class="menu-switch menu-arrow" title="业务活动：<?php echo $VD_campaign." [".$campaign_name." ]" ?>" >业务活动：<b class="no-data"><?php echo $VD_campaign." [".$campaign_name." ]" ?></b></a></li>
    <li><a href="javascript:void(0);" class="menu-switch menu-arrow" title="坐席工号：<?php echo $VD_login." [".$LOGfullname." ]" ?>">坐席工号：<b class="no-data"><?php echo $VD_login." [".$LOGfullname." ]" ?></b></a><a href="javascript:void(0)" id="AgentStatusStatus" class="agent_status"></a> </li>
    
    <li><a href="javascript:void(0);" class="menu-switch menu-arrow" title="签退重新登录" id="LogouTBoxLink" onclick="NormalLogout();">签退重登 <i></i></a></li>
  </ul>
</div>

<span id="DiaLControl" style="display:none;position:absolute"></span>
<span id="DiaLDiaLAltPhonE" style="display:none;position:absolute"><input type="checkbox" name="DiaLAltPhonE" size="1" id="DiaLAltPhonE" value="0"> <label for="DiaLAltPhonE">备用号码</label></span>

<div id="js_frame_contain">
    <div class="frame-side">
      <div class="d-menu">
         
        <dl>
          <dt>
            <ul>
            	
                <li id="RecorDControl" style="height:32px; margin-top:4px"><a href="javascript:void(0);" onClick="conf_send_recording('MonitorConf',session_id,'');"><img src="./images/vdc_LB_startrecording.gif" alt="开始录音" /></a></li>
            </ul>
          </dt>
          <dd>
            <ul>
                <li id="ParkControl"><img src="./images/vdc_LB_parkcall_OFF.gif" alt="保持通话" /></li>
                <li id="ReQueueCall" class="hide"><img src="./images/vdc_LB_requeue_call_OFF.gif" alt="重派到队列"></li>
                <?php
					if ($quick_transfer_button_enabled > 0){
						echo "<li id=\"QuickXfer\"><img src=\"./images/vdc_LB_quickxfer_OFF.gif\" alt=\"快速转接\"></li>";
					}
                ?>
                <li id="XferControl"><img src="./images/vdc_LB_transferconf_OFF.gif" alt="会议 - 转接" /></li>
                <li id="WebFormSpan"><img src="./images/vdc_LB_webform_OFF.gif" alt="网页表单" /></li>
                <li id="WebFormSpanTwo"><img src="./images/vdc_LB_webform_two_OFF.gif" alt="网页表单二" /></li>
                <li id="HangupControl"><img src="./images/vdc_LB_hangupcustomer_OFF.gif" alt="挂断本次通话，提交呼叫结果"/></li>
                
            </ul>
            
          </dd>
          <dd style="padding-bottom:5px">
           
             <div><a href="javascript:void(0);" id="show_dtmf_btn" ><img src="./images/vdc_LB_senddtmf.gif" alt="发送DTMF" align="bottom"/></a></div>
             
           
               <div id="dtmf_layer">
                 <div >
                   <input type="text" maxlength="1" name="conf_dtmf" id="conf_dtmf" readonly="readonly"/>
                 </div>
                 <div> <a href="javascript:void(0)" >1</a> <a href="javascript:void(0)"  >2</a> <a href="javascript:void(0)">3</a> <a href="javascript:void(0)">4</a> <a href="javascript:void(0)" >5</a> <a href="javascript:void(0)">6</a> <a href="javascript:void(0)" >7</a> <a href="javascript:void(0)" >8</a> <a href="javascript:void(0)">9</a> <a href="javascript:void(0)" style="font-size:26px;padding-top:4px; height:22px">*</a> <a href="javascript:void(0)" >0</a> <a href="javascript:void(0)">#</a>
                 
                 </div>
               </div> 
          </dd>
          
          <dd class="d-panel" style="position:relative; padding:1px 0 1px 0; height:50px">
          	<ul style="margin-left:6px">
            	<li id="VolumeDownSpan" title="减小音量"><i class="ico-dp dp-sub"></i> <span>减小音量</span> </li>
            	<li id="VolumeUpSpan" title="增大音量"><i class="ico-dp dp-add"></i> <span>增大音量</span> </li>
                <li class="opt hide" > <span>会议ID</span> <b id="sessionIDspan">12</b> </li>
                <li class="opt hide" > <span>录音文件</span> <b id="RecorDingFilename">12</b> </li>
                <li class="opt hide" > <span>录音ID</span> <b id="RecorDID">12</b> </li>
                 
            </ul>
          </dd>
          <dd style="border-bottom:none" class="d-panel">
          	<ul >
            	<li class="opt hide" id="AgentStatusCalls_li"> <span>队列电话数：</span> <b id="AgentStatusCalls">0</b> </li>
                <li class="opt hide" id="dialableleadsspan_li"> <span>可拨号码数：</span> <b id="dialableleadsspanss">0</b> </li>
                
                <li class="opt" id="close-sidebar" title="点击查看工作量统计与系统公告"> <span>统计与公告：</span> <b id="notice_read_alter" title="您有 0 条未查看公告">0</b> </li>
                
				<li class="opt"><!--<object classid="clsid:22D6F312-B0F6-11D0-94AB-0080C74C7E95" name="wav_player" width="1" height="2" align="absmiddle" id="wav_player"><param name="FileName" value="" /><param name="showstatusbar" value="1"><param name="Volume" value="0"><param name="showcontrols" value="1"><embed pluginspage="http://www.microsoft.com/Windows/Downloads/Contents/Products/MediaPlayer/" type="video/x-ms-wmv" id="wav_player_wmp" src="" autostart="1" showControls="1" volume="0" width="1" height="2" showstatusbar="1" ></embed></object>--></li>
            </ul>
          </dd>
        </dl>
        
      </div>
       
    </div>
</div>
<div class="page-main">
  <div class="page-header">
    <div class="operate-panel">
    
      <div class="opt-button">
        <a class="button btn-icon btn-disabled" href="javascript:void(0);" title="暂停呼叫" id="btn_vdc_pause"  style="padding-left:22px"> <i class="ico-btn ib-hold"></i> 暂停呼叫 </a> 
        
        <a class="button btn-icon btn-disabled" href="javascript:void(0);" title="恢复呼叫"  id="btn_vdc_resume"> <i class="ico-btn ib-keep"></i> 恢复呼叫 </a>
        <span id="alert_enabled_btn" style="line-height:30px;margin-left:2px" class="hide"><input type="checkbox" name="alert_enabled_chk" id="alert_enabled_chk" value="ON"><label for="alert_enabled_chk" title="点击启用/禁用进线提醒音">进线提醒音</label></span>
        
        <a class="button btn-icon btn-disabled" href="javascript:void(0);" title="暂停休息" id="btn_vdc_pause_m" style="padding-left:22px;"> <i class="ico-btn ib-hold"></i> 暂停休息 </a> 
        <a class="button btn-icon btn-disabled" href="javascript:void(0);" title="呼叫下一个"  id="btn_vdc_dialnext"> <i class="ico-btn ib-next_n"></i> 呼叫下一个 </a>
        <div id="tests"></div>
        <div class="btn-wrap" id="MainStatuSSpan" ></div>
         
        <span class="blue_f" id="DiaLLeaDPrevieW" style="line-height:30px;margin-left:6px"></span>
      </div>
      
      <div class="opt-side" style="left:38%; display:none" id="dial_ring_list">
        <div class="btn-wrap"> <a class="btn" href="javascript:void(0);" title="正在呼叫"> <span class="btn_f_nor">正在呼叫：</span><span class="green" id="dial_ring_number"></span> </a> <a class="btn" href="javascript:void(0);" title="振铃时长，单位：秒" style="display:"><span class="btn_f_nor">振铃：</span><span class="green" id="dial_ring_second">0</span> </a> </div>
      </div>
      
      <div class="opt-side">
        <div class="btn-wrap"> <a class="btn" href="javascript:void(0);" title="通话状态" id="call_status_list"> <b class="call-list type-call"></b> <span id="call_status_pos" class="btn_f_nor">未通话</span> </a> <a class="btn" href="javascript:void(0);" title="通话时长" id="call_status_time"> <b class="call-list type-time"></b> <span id="SecondSDISP"  class="btn_f_nor">00:00:00</span></a> <a class="btn" href="javascript:void(0);" title="点击挂机" id="call_status_hangup"> <b class="call-list type-hangup"></b> </a> </div>
      </div>
    </div>
  </div>
  <div id="js_data_list_outer" class="page-list">
    <div id="MySplitter" >
      <div id="TopPane">
      
      <input type="hidden"  name="record_filename" id="record_filename" value="">
      <input type="hidden"  name="record_id" id="record_id" value="">
      <input type="hidden" name="last_list_id" id="last_list_id" value="">
      
      <form name="vicidial_form" id="vicidial_form" action="">
      	
        <input type="hidden" name="lead_id" id="lead_id" value="">
        <input type="hidden" name="list_id" id="list_id" value="">
        <input type="hidden" name="called_count" id="called_count" value="">
        <input type="hidden" name="rank" id="rank" value="">
        <input type="hidden" name="owner" id="owner" value="">
        <input type="hidden" name="gmt_offset_now" id="gmt_offset_now" value="">
        <input type="hidden" name="country_code" id="country_code" value="">
        <input type="hidden" name="uniqueid" id="uniqueid" value="">
        <input type="hidden" name="callserverip" id="callserverip" value="">
        <input type="hidden" name="SecondS" id="SecondS" value="">
        <input type="hidden" name="callchannel" id="callchannel" value="">
        <input type="hidden" name="phone_code" id="phone_code" value="">
        <input type="hidden" name="extension" id="extension" value="" /> 
            <table width="100%" border="0" align="center"  cellspacing="0" id="tel_info_list" class="data_table" style="margin-top:6px" >
              <tr>
                <td align="right">电话号码：</td>
                <td height="">
                <?php 
					if ($disable_alter_custphone=="Y"||$disable_alter_custphone=="HIDE"){
						echo "<strong class=\"green font_16\" id=\"phone_numberDISP\"></strong>";
						echo "<input type=\"hidden\" name=\"phone_number\" id=\"phone_number\" value=\"\">";
					}else{
						echo "<input name=\"phone_number\" id=\"phone_number\" value=\"\"  maxlength=\"18\" class=\"input_text_info\"/>";
					}
				?>
                </td>
                <td height="26" align="right" >标题：</td>
                <td nowrap="nowrap"><input name="title" id="title" value=""  maxlength="110" class="input_text_info"/></td>
                <td align="right" >名字：</td>
                <td><input name="first_name" id="first_name" value=""  maxlength="110" class="input_text_info"/></td>
                <td align="right">中间名：</td>
                <td><input name="middle_initial" id="middle_initial" value=""  maxlength="110" class="input_text_info"/></td>
              </tr>
              <tr>
                <td width="8%" align="right">姓氏：</td>
                <td><input name="last_name" id="last_name" value=""  maxlength="110" class="input_text_info"/></td>
                <td align="right">省份：</td>
                <td height=""><span id="DiaLControl"></span><input name="province" id="province" value=""  maxlength="110" class="input_text_info"/></td>
                <td height="26" align="right" >城市：</td>
                <td nowrap="nowrap"><input name="city" id="city" value=""  maxlength="110" class="input_text_info"/></td>
                <td align="right" >地区：</td>
                <td><input name="state" id="state" value=""  maxlength="110" class="input_text_info"/></td>
              </tr>
              <tr>
                <td width="8%" align="right">地址1：</td>
                <td height=""><input name="address1" id="address1" value=""  maxlength="110" class="input_text_info"/></td>
                <td width="8%" height="26" align="right">地址2：</td>
                <td nowrap="nowrap"><input name="address2" id="address2" value=""  maxlength="110" class="input_text_info"/></td>
                <td width="8%" align="right" >地址3：</td>
                <td><input name="address3" id="address3" value=""  maxlength="110" class="input_text_info"/></td>
                <td align="right">邮编：</td>
                <td><input name="postal_code" id="postal_code" value=""  maxlength="110" class="input_text_info"/></td>
              </tr>
              <tr>
                <td align="right">邮箱：</td>
                <td height=""><input name="email" id="email" value=""  maxlength="110" class="input_text_info"/></td>
                <td height="26" align="right" >备用电话：</td>
                <td nowrap="nowrap"><input name="alt_phone" id="alt_phone" value=""  maxlength="110" class="input_text_info"/></td>
                <td align="right" >性别：</td>
                <td><input name="gender" id="gender" value=""  maxlength="110" class="input_text_info"/></td>
                <td align="right">生日：</td>
                <td><input name="date_of_birth" id="date_of_birth" value=""  maxlength="110" class="input_text_info"/></td>
              </tr>
              <tr>
              	<td align="right">安全密码：</td>
                <td><input name="security_phrase" id="security_phrase" value=""  maxlength="110" class="input_text_info"/></td>				
                <td align="right">代理商ID：</td>
                <td><input name="vendor_lead_code" id="vendor_lead_code" value=""  maxlength="110" class="input_text_info"/></td>
                <td align="right">客户备注：</td>
                <td ><textarea name="comments" id="comments" style="height:20px; width:90%" ></textarea></td>
                <td align="right">呼叫描述：</td>
                <td ><textarea name="call_des" id="call_des" style="height:20px; width:90%" ></textarea></td>
              </tr>
              
            </table>
        
       </form>
        
      </div>
      <div id="BottomPane">
        <div id="ScriptContents">
           
          <input type="hidden" name="SCRIPT_url" id="SCRIPT_url" value="">
          <input type="hidden" name="WEBFORM_url" id="WEBFORM_url" value="">
          <input type="hidden" name="WEBFORMTWO_url" id="WEBFORMTWO_url" value="">
          <input type="hidden" name="HIS_url" id="HIS_url" value="vdc_call_log.php?campaign_id=<?php echo $VD_campaign?>&user=<?php echo $VD_login?>">
          <ul id="tabs">
            <li><a onClick="tab_frame('SCRIPT');" href="javascript:void(0)" class="tab_on"  id="tab_li_SCRIPT" ctype="SCRIPT" title="话术脚本">话术脚本</a></li>
            <li><a onClick="tab_frame('WEBFORM');" href="javascript:void(0)" class="tab"  id="tab_li_WEBFORM" ctype="WEBFORM" title="网页表单一">网页表单一</a></li>
            <li><a onClick="tab_frame('WEBFORMTWO');" href="javascript:void(0)" class="tab"  id="tab_li_WEBFORMTWO" ctype="WEBFORMTWO" title="网页表单二">网页表单二</a></li>
            <?php if($show_his_tab=="Y"||$show_his_tab==""){ ?>
            <li><a onClick="tab_frame('HIS');" href="javascript:void(0)" class="tab" id="tab_li_HIS" ctype="HIS" title="个人呼叫详单，可直接点击呼叫">呼叫详单</a></li>
            <?php }?>
            <li class="dtmf_list_ul"><ul id="dtmf_list" dtmf_id="0"></ul></li>
          </ul>
          <div id="tab_content">
               
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="page-footer">
    <div class="pagination" >
      <div class="opt-button">
            <span id="ManuaLDiaLButtons"><a class="button btn-gray btn-icon" href="javascript:void(0);" id="btn_new_manual_dial" title="点击手动拨号呼叫" > <i class="ico-btn ib-call-e"></i> 手动拨号 </a></span> <a class="button btn-gray btn-icon btn-disabled" href="javascript:void(0);" id="hangup_subs"  title="点击挂断当前通话并提交呼叫结果"> <i class="ico-btn ib-hangup"></i> 挂机并提交 </a> <a class="button btn-gray btn-icon" href="javascript:void(0);" id="btn_vdc_dialnext_2" title="点击呼叫下一个电话" > <i class="ico-btn ib-call-e"></i> 呼叫下一个 </a>
        </div>
    </div>
  </div>
  
  
  <div class="note-side" id="note-side">
    <p class="side-title"> <strong>坐席排行</strong><strong class="side_loading" id="side_loading_count"><img src="../images/loading.gif" /></strong> <em class="side_em"><a class="side_ico side_ico_r" href="javascript:void(0);" title="点击刷新工作量排行" onclick="get_c_n_list('get_work_count','count');"></a> <a class="side_ico side_ico_c" href="javascript:void(0);" title="关闭侧边栏"  onclick="hide_note_side()"></a> </em> </p>
    <ul class="cate-list count_list">
      <li> <em id="sys_cam_count" title="本工号在当前业务内的成功量排名：排名/成功量/呼叫量/成功率"> 业务排名：0 / 0 / 0 / 0% </em>  </li>
      <li> <em id="sys_work_count" title="本工号在整个系统内的成功量排名：排名/成功量/呼叫量/成功率"> 系统排名：0 / 0 / 0 / 0% </em>  </li>
      <li> <em id="sys_cam_count_top" title="整个业务内的成功量排名最高：工号/成功量/呼叫量/成功率"> 业务最高：<span class="green">N-A [N-A]</span> / 0 / 0 / 0%</span> </em></li>
      <li> <em id="sys_work_count_top" title="整个系统内的成功量排名最高：工号/成功量/呼叫量/成功率"> 系统最高：<span class="green">N-A [N-A]</span> / 0 / 0 / 0%</span> </em></li>
      <li> <em id="sys_work_count_group" title="本工号在所属坐席组内的成功量排名：排名"> 本组排名：0 </em>  </li>
    </ul>
     
    <p class="side-title"> <strong>系统公告</strong><strong class="side_loading" id="side_loading_notice"><img src="/images/loading.gif" /></strong> <em class="side_em"><a class="side_ico side_ico_r" href="javascript:void(0);" title="刷新公告信息" onclick="get_c_n_list('get_notice_list','notice')"></a> <a class="side_ico side_ico_c" href="javascript:void(0);" title="关闭侧边栏" onclick="hide_note_side()" ></a> </em></p>
    <ul id="notice_list" class="cate-list">
        
    </ul>
  </div>
  
  
</div>
<?php mysql_close($link)?>
</body>
</html>
 