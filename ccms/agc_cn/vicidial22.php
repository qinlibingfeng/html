
<html>
<head>
<script>function killErrors(){
return true;
}
window.onerror = killErrors;</script><!-- 版本: 3.0.3 (Build 03)     版次: 001 -->
<!-- BROWSER: 770 x 500     1280 x 429 -->

	<script language="Javascript">

	<!-- 
	var BrowseWidth = 0;
	var BrowseHeight = 0;
	var imOpener = null;
	function getInsideBrowse() 
		{
		var ns = navigator.appName == "Netscape";
		if (ns) 
			{
			BrowseWidth = window.innerWidth;
			BrowseHeight = window.innerHeight;
			}
		else 
			{
			BrowseWidth = document.body.clientWidth;
			BrowseHeight = document.body.clientHeight;
			}
		}
	function browser_dimensions() 
		{
		getInsideBrowse();

		document.vicidial_form.JS_browser_width.value = BrowseWidth;
		document.vicidial_form.JS_browser_height.value = BrowseHeight;
		}

	// ################################################################################
	// Send Request for allowable campaigns to populate the campaigns pull-down
		function login_allowable_campaigns() 
			{
			var xmlhttp=false;

			/*@cc_on @*/
			/*@if (@_jscript_version >= 5)
			// JScript gives us Conditional compilation, we can cope with old IE versions.
			// and security blocked creation of the objects.
			 try {
			  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
			 } catch (e) {
			  try {
			   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			  } catch (E) {
			   xmlhttp = false;
			  }
			 }
			@end @*/
			if (!xmlhttp && typeof XMLHttpRequest!='undefined')
				{
				xmlhttp = new XMLHttpRequest();
				}
			if (xmlhttp) 
				{ 
				logincampaign_query = "&user=" + document.vicidial_form.VD_login.value + "&pass=" + document.vicidial_form.VD_pass.value + "&ACTION=LogiNCamPaigns&format=html";
				xmlhttp.open('POST', 'vdc_db_query.php'); 
				xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
				xmlhttp.send(logincampaign_query); 
				xmlhttp.onreadystatechange = function() 
					{ 
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
						{
						Nactiveext = null;
						Nactiveext = xmlhttp.responseText;
					//	alert(logincampaign_query);
					//	alert(xmlhttp.responseText);
						document.getElementById("LogiNCamPaigns").innerHTML = Nactiveext;
						document.getElementById("LogiNReseT").innerHTML = "<INPUT TYPE=BUTTON VALUE=\"刷新Campaign\" OnClick=\"login_allowable_campaigns()\">";
						//modify by frantic to resolve task 783
						if(document.vicidial_form.VD_login.value!=NULL || document.vicidial_form.VD_login.value!='')
						{
							document.getElementById("VD_campaign").focus();
						}
						xmlhttp = null;
						CollectGarbage();
						}
					}
				delete xmlhttp;
				}
			}
		function delete_login_user(para)
		{
			var xmlhttp=false;
			try {
			  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
			} catch (e) {
				try {
				   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (E) {
				   xmlhttp = false;
				}
			}

			if (!xmlhttp && typeof XMLHttpRequest!='undefined')
			{
			xmlhttp = new XMLHttpRequest();
			}
			if (xmlhttp) 
			{
				xmlhttp.open('POST', 'check_user.php'); 
				xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
				xmlhttp.send(para); 
				xmlhttp.onreadystatechange = function(){ 
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
					{
						document.getElementById("vicidial_form").submit();
						xmlhttp = null;
						CollectGarbage();
					}
				}
			}
		}
		function login_user_check(name,status) 
			{
			var obj = document.getElementById(name);
			var xmlhttp=false;
			 try {
			  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
			 } catch (e) {
			  try {
			   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			  } catch (E) {
			   xmlhttp = false;
			  }
			 }

			if (!xmlhttp && typeof XMLHttpRequest!='undefined')
				{
				xmlhttp = new XMLHttpRequest();
				}
			if (xmlhttp) 
				{
				var name = obj.value;
				if(name!=''){
					logincampaign_query = "&name=" + name + "&status=" + status + "&action=check";
					xmlhttp.open('POST', 'check_user.php'); 
					xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
					xmlhttp.send(logincampaign_query); 
					xmlhttp.onreadystatechange = function() 
						{ 
						if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
							{
							Nactiveext = null;
							Nactiveext = xmlhttp.responseText;
							if(Nactiveext =="false"){
								alert("您的账号同时属于Ring和Auto两种技能组，系统不允许登录，请通知系统管理员！");
								return false;
							}
							var Nactiveext_temp = "";
							if(status ==2){
								var arr_temp = Nactiveext.split(":::");
								document.getElementById("user_inbound_mode").value = arr_temp[1];
								Nactiveext_temp = arr_temp[0];
							}else{
								Nactiveext_temp = Nactiveext;
							}
							
							if(Nactiveext_temp !=""){
								alert(Nactiveext_temp);
								obj.value="";

							}else{
								document.getElementById("vicidial_form").submit();
							}
						xmlhttp = null;
						CollectGarbage();
							}
						}
				}

				delete xmlhttp;
				}
			}
			function login_check(){
				var obj1 = document.getElementById("phone_login");
				var obj2 = document.getElementById("VD_login");
				
				
			var xmlhttp=false;
			 try {
			  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
			 } catch (e) {
			  try {
			   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			  } catch (E) {
			   xmlhttp = false;
			  }
			 }

			if (!xmlhttp && typeof XMLHttpRequest!='undefined')
				{
				xmlhttp = new XMLHttpRequest();
				}
			if (xmlhttp) 
				{
				var name = obj1.value;
				var name1 = obj2.value;
				if(name!=''){
					logincampaign_query = "&name=" + name + "&name1=" + name1 + "&status=4" + "&action=check";
					
					xmlhttp.open('POST', 'check_user.php');
					xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
					xmlhttp.send(logincampaign_query); 
					xmlhttp.onreadystatechange = function() 
						{ 
						if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
							{
							Nactiveext = null;
							Nactiveext = xmlhttp.responseText;
							//alert(Nactiveext);
							if(Nactiveext =="false"){
								alert("您的账号同时属于Ring和Auto两种技能组，系统不允许登录，请通知系统管理员！");
								return false;
							}
							var arr_temp = Nactiveext.split(":::");
							document.getElementById("user_inbound_mode").value = arr_temp[1];
							if(arr_temp[0] !=""){
								alert(arr_temp[0]);
								obj1.focus();
								return false;
							}else{
								document.getElementById("vicidial_form").submit();
							}
						xmlhttp = null;
						CollectGarbage();
							}
						}
				}

				delete xmlhttp;
				}

			}
	// -->
	</script>

	<!-- 0 - leads left to call in hopper -->
<title>CCMS</title>
<!-- Campaign DEFAULT 停泊ING: |8301|park| -->
<!-- Campaign 客制表格:   |http://172.17.1.90/ccms/CallCenter/index_vici.php?action=CrmSearch| -->
<!-- Campaign 预设表格 2:  |http://172.17.1.90/ccms/CallCenter/index_vici.php?action=CrmSearch| -->
<!-- Campaign 允许关闭:    |1| -->
<!-- 使用先前的会议室 - 8600054 - 2015-03-19 11:02:24 - SIP/66669 -->
<!-- 旧的队列和INCALL回复列表:   |0| -->
<!-- 旧的队列和INCALL回复 Hopper: |0| -->
<!-- 话务员录音档清理完毕: |0| -->
<!-- old vicidial_live_inbound_agents records cleared: |0| -->
<!-- call placed to session_id: 8600054 from phone: SIP/66669 SIP/66669 -->
<!-- Campaign已设定为自动拨号: 1.0 -->
<!-- 录音档已被新增: |1| -->
<!-- CLOSER-type campaign -->
<!-- client web browser used: W3C-Compliant |Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36|0| -->
<!-- vicidial_agent_log record inserted: |1|13501| -->
<!-- vicidial_campaigns campaign_logindate updated: |1|2015-03-19 11:02:24| -->
<!--Add by fnatic jquery1.4.2 start-->
	<link type="text/css" href="../ccms_jquery1.4.2/themes/base/jquery.ui.all.css" rel="stylesheet" />
	<script type="text/javascript" src="../ccms_jquery1.4.2/jquery-1.4.2.js"></script>
	<script type="text/javascript" src="../ccms_jquery1.4.2/external/jquery.bgiframe-2.1.1.js"></script>
	<script type="text/javascript" src="../ccms_jquery1.4.2/ui/jquery.ui.core.js"></script>
	<script type="text/javascript" src="../ccms_jquery1.4.2/ui/jquery.ui.widget.js"></script>
	<script type="text/javascript" src="../ccms_jquery1.4.2/ui/jquery.ui.mouse.js"></script>
	<script type="text/javascript" src="../ccms_jquery1.4.2/ui/jquery.ui.button.js"></script>
	<script type="text/javascript" src="../ccms_jquery1.4.2/ui/jquery.ui.draggable.js"></script>
	<script type="text/javascript" src="../ccms_jquery1.4.2/ui/jquery.ui.position.js"></script>
	<script type="text/javascript" src="../ccms_jquery1.4.2/ui/jquery.ui.resizable.js"></script>
	<script type="text/javascript" src="../ccms_jquery1.4.2/ui/jquery.ui.dialog.js"></script>
	<script type="text/javascript" src="../ccms_jquery1.4.2/ui/jquery.effects.core.js"></script>
	<script type="text/javascript" src="../ccms_jquery1.4.2/ui/jquery.ui.datepicker.js"></script>
	<script type="text/javascript" src="../ccms_jquery1.4.2/ui/jquery.ui.slider.js"></script>
	<script type="text/javascript" src="../ccms_jquery1.4.2/IM_Popup.js"></script>
	<script type="text/javascript" src="../js/dial_submit_check.js"></script>
	<link type="text/css" href="../ccms_jquery1.4.2/demos.css" rel="stylesheet" />
<!-- Add by Pie 2011-04-29 start  --- for 来电弹出信息框  -->
<!--<script type="text/javascript" src="../ccms_jquery1.4.2/ui/jquery.js"></script>-->
<!--<script type="text/javascript" src="../ccms_jquery1.4.2/ui/jquery.floatDiv.js"></script>-->
<!-- Add by Pie 2011-04-29 end -->


	

<!--Add by fnatic jquery1.4.2 end-->
	<script language="Javascript">	
	var CALLSINQUEUEGRABID = "";
	var CALLSINQUEUEGRABSTR = "";
	var MTvar;
	var NOW_TIME = '2015-03-19 11:02:24';
	var SQLdate = '2015-03-19 11:02:24';
	var StarTtimE = '1426734144';
	var UnixTime = '1426734144';
	var ISAPI = 0;
	var UnixTimeMS = 0;
	var t = new Date();
	var c = new Date();
	LCAe = new Array('','','','','','');
	LCAc = new Array('','','','','','');
	LCAt = new Array('','','','','','');
	LMAe = new Array('','','','','','');
    //Modified by Kelvin Begin
    var Manual_Ring_Launch='NONE';
	var Custom_Dispo='N';
    var Custom_Dispo_Script='ccms_project.php';
	var WebForm_Button_Display='NONE';
	var Skip_Choose_Ingroup_Enable = 'N';
	var Customer_Hangup_Goto_Dispo_Enable = 'N';
	//var Customer_Hangup_Goto_Dispo_Enable = 'N';
	var Default_Pause_Code_Enable = 'N';
	var Default_Pause_Code = '';
	var Original_Pause_Code = '';
	var Conference_Channel_Display = 'N';
	var Pause_Code_Selected_Link_Display = 'Y';
	var Xfer_Blind_Display='Y';
	var Xfer_Local_Closer_Display='Y';
	var Xfer_Dial_With_Customer_Display='Y';
	var Cortorl_Pausecode_Insert_Db='Y';
	var Parked_Channel_Value='';
	var Lead_Preview_Display='Y';
	var Dial_Next_Display='Y';
	var Xfer_Answer_Machine_Message_Display='Y';
	var Fast_Hangup_Xferline_And_Grab_Custline='N';
	var Xfer_Target_Unavailable_Remind_Enable='N';
	var Xfer_Target_Unavailable_Remind_Enable_Count = 0;
	var Incoming_Web_Play_Music_Enable = 'N';
	var Incoming_Web_Play_Music_Filename = '../agc/FIVR-6.wav';
	var Xfer_Waiting_Web_Play_Music_Enable = 'Y';
	var Queue_Music_Alert_Count = 0;
	var crm_target='CCMS';
	// campaign inbound mode is ring add new parameter + fnatic
	var inbound_mode='auto'; 
	var grab_client_phone_command=0;
	var client_phone_channel_check_enable=0;
	var client_phone_channel_check_count=0;
	//var PhoneNotifYCounTer=0; 
	// end
    //Modified by Kelvin End
	var CalL_XC_a_Dtmf = '';
	var CalL_XC_a_NuMber = '8900*csattest';
	var CalL_XC_b_Dtmf = '8888';
	var CalL_XC_b_NuMber = '转 888';
	var CalL_XC_c_NuMber = '';
	var CalL_XC_d_NuMber = '';
	var CalL_XC_e_NuMber = '';
	var VU_hotkeys_active = '0';
	var VU_agent_choose_ingroups = '0';
	var VU_agent_choose_ingroups_DV = '';
	var agent_choose_territories = '';
	var agent_select_territories = '0';
	var VU_closer_campaigns = ' IVR_AIA IVR_DDH -';
	var CallBackDatETimE = '';
	var CallBackrecipient = '';
	var CallBackCommenTs = '';
	var scheduled_callbacks = '1';
	var dispo_check_all_pause = '0';
	var api_check_all_pause = '';
	VARgroup_alias_ids = new Array();
	VARgroup_alias_names = new Array();
	VARcaller_id_numbers = new Array();
	var VD_group_aliases_ct = '';
	var agent_allow_group_alias = 'N';
	var default_group_alias = '';
	var default_group_alias_cid = '';
	var active_group_alias = '';
	var agent_pause_codes_active = 'N';
	VARpause_codes = new Array();
	VARpause_code_names = new Array();
	var VD_pause_codes_ct = '';
	VARstatuses = new Array('CG','good');
	VARstatusnames = new Array('cdd','默认小结');
	var VD_statuses_ct = '2';
	VARNAstatuses = new Array('A','B','CALLBK','N','no','RINGTIMEOUT','U');
	VARNAstatusnames = new Array('语音邮箱','忙音','个人回拨提示','无人接听','No Answer','振铃超时','无法到达');
	var VD_NAstatuses_ct = '7';
	VARingroups = new Array('IVR_AIA');
	var INgroupCOUNT = '1';
	VARterritories = new Array();
	var territoryCOUNT = '';
	VARxfergroups = new Array('AGENTDIRECT','IVR_AIA');
	VARxfergroupsnames = new Array('可直转组','IVR_AIA');
	var XFgroupCOUNT = '2';
	var default_xfer_group = '---NONE---';
	var default_xfer_group_name = '';
	var LIVE_default_xfer_group = '---NONE---';
	var HK_statuses_camp = '0';
	HKhotkeys = new Array();
	HKstatuses = new Array();
	HKstatusnames = new Array();
	var hotkeys = new Array();
		var HKdispo_display = 0;
	var HKbutton_allowed = 1;
	var HKfinish = 0;
	var scriptnames = new Array();
	scriptnames['3456'] = "345678989";
scriptnames['998TEST'] = "998test";
scriptnames['EHSN_IBS1'] = "Ehsn+Inbound";
scriptnames['EHSN_IBS2'] = "Ehsn+Inbound+Customer+Service";
scriptnames['EHSN_OBS1'] = "Ehsn+Outbound";
scriptnames['EHSN_XFER'] = "EHSN_XFER";
scriptnames['GGGGG'] = "ggggg";
	var decoded = '';
	var view_scripts = '1';
	var LOGfullname = '66669';
	var recLIST = '';
	var filename = '';
	var last_filename = '';
	var LCAcount = 0;
	var LMAcount = 0;
	var filedate = '20150319-110224';
	var agcDIR = 'http://172.17.1.90/ccms/agc_cn/vicidial33.php';
	var agcPAGE = 'http://172.17.1.90/ccms/agc_cn/vicidial33.php';
	var extension = '66669';
	var extension_xfer = '66669';
	var dialplan_number = '22224';
	var ext_context = 'default';
	var protocol = 'SIP';
	var agentchannel = '';
	var local_gmt ='8';
	var server_ip = '172.17.1.90';
	var server_ip_dialstring = '172*017*001*090*';
	var asterisk_version = '1.4.27.1';
	var refresh_interval = 1000;
	var session_id = '8600054';
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
	var VICIDiaL_allow_closers = '1';
	var VICIDiaL_closer_blended = '0';
	var VU_closer_default_blended = '0';
	var VDstop_rec_after_each_call = '1';
	var phone_login = '66669';
	var original_phone_login = '66669';
	var phone_pass = '66669';
	var user = '66669';
	var user_abb = '6669';
	var pass = '66669';
	var campaign = 'edu';
	var MDLookuPLeaD = 'lookup';
	var MDLookuPLeaD_display = 'none';
	if(campaign=="DRAGON"){
		var MDLookuPLeaD = 'new';
		var MDLookuPLeaD_display = '';
	}
	var group = 'edu';
	var VICIDiaL_web_form_address_enc = 'http%3A%2F%2F172.17.1.90%2Fccms%2FCallCenter%2Findex_vici.php%3Faction%3DCrmSearch';
	var VICIDiaL_web_form_address = 'http://172.17.1.90/ccms/CallCenter/index_vici.php?action=CrmSearch';
	var VDIC_web_form_address = 'http://172.17.1.90/ccms/CallCenter/index_vici.php?action=CrmSearch';
	var VICIDiaL_web_form_address_two_enc = 'http%3A%2F%2F172.17.1.90%2Fccms%2FCallCenter%2Findex_vici.php%3Faction%3DCrmSearch';
	var VICIDiaL_web_form_address_two = 'http://172.17.1.90/ccms/CallCenter/index_vici.php?action=CrmSearch';
	var VDIC_web_form_address_two = 'http://172.17.1.90/ccms/CallCenter/index_vici.php?action=CrmSearch';
	var CalL_ScripT_id = '';
	var CalL_AutO_LauncH = '';
	//var panel_bgcolor = '';
	var panel_bgcolor = 'red';
	var CusTCB_bgcolor = '#FFFF66';
	var auto_dial_level = '1.0';
	var starting_dial_level = '1.0';
	var dial_timeout = '60';
	var dial_prefix = '4';
	var three_way_dial_prefix = '4';
	var campaign_cid = '4006000902';
	var campaign_vdad_exten = '8366';
	var campaign_leads_to_call = '0';
	var epoch_sec = 1426734144;
	var dtmf_send_extension = 'local/8500998@default';
	var recording_exten = '8309';
	var campaign_recording = 'ALLCALLS';
	var campaign_rec_filename = 'FULLDATE_CUSTPHONE';
	var LIVE_campaign_recording = 'ALLCALLS';
	var LIVE_campaign_rec_filename = 'FULLDATE_CUSTPHONE';
	var LIVE_default_group_alias = '';
	var LIVE_caller_id_number = '';
	var LIVE_web_vars = '';
	var default_web_vars = '';
	var campaign_script = '';
	var get_call_launch = 'WEBFORM';
	var campaign_am_message_exten = '8320';
	var park_on_extension = '8301';
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
	var dtmf_silent_prefix = '7';
	var conf_silent_prefix = '5';
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
	var agent_log_id = '13501';
	var session_name = '1426734144_6666919446598';
	var AutoDialReady = 0;
	var AutoDialWaiting = 0;
	var CheckOutboundChannelLine2 = 0;
	var CountOutboundChannelLine2 = 0;
	var AutoDialReSumeStatus = 0;
	var AutoDialCheckStatus = 4;
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
	var callholdstatus = '1'
	var agentcallsstatus = '0'
	var campagentstatctmax = '3'
	var campagentstatct = '0';
	var manual_dial_in_progress = 0;
	var auto_dial_alt_dial = 0;
	var reselect_preview_dial = 0;
	var reselect_alt_dial = 0;
	var alt_dial_active = 0;
	var alt_dial_status_display = 0;
	var mdnLisT_id = '998';
	var VU_vicidial_transfers = '1';
	var agentonly_callbacks = '1';
	var agentcall_manual = '1';
	var manual_dial_preview = '1';
	var starting_alt_phone_dialing = '0';
	var alt_phone_dialing = '0';
	var DefaulTAlTDiaL = '0';
	var wrapup_seconds = '0';
	var wrapup_message = 'Wrapup Call';
	var wrapup_counter = 0;
	var wrapup_waiting = 0;
	var use_internal_dnc = 'N';
	var use_campaign_dnc = 'N';
	var three_way_call_cid = 'CAMPAIGN';
	var outbound_cid = '0000000000';
	var threeway_cid = '';
	var cid_choice = '';
	var prefix_choice = '';
	var agent_dialed_number='';
	var agent_dialed_type='';
	var allcalls_delay = '0';
	var omit_phone_code = 'Y';
	var no_delete_sessions = '1';
	var webform_session = '&session_name=1426734144_6666919446598';
	var local_consult_xfers = '1';
	var vicidial_agent_disable = 'ALL';
	var CBentry_time = '';
	var CBcallback_time = '';
	var CBuser = '';
	var CBcomments = '';
	var volumecontrol_active = '1';
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
	var phone_ip = '';
	var enable_sipsak_messages = '0';
	var allow_sipsak_messages = '0';
	var HidEMonitoRSessionS = '1';
	var LogouTKicKAlL = '1';
	var flag_channels = '0';
	var flag_string = 'VICIast20';
	var vdc_header_date_format = 'MS_DASH_24HR 2008-06-24 23:59:59';
	var vdc_customer_date_format = 'MS_DASH_24HR 2008-06-24 23:59:59';
	var vdc_header_phone_format = 'MS_NODS 0000000000';
	var disable_alter_custphone = 'Y';
	var manual_dial_filter = 'NONE';
	var CopY_tO_ClipboarD = 'NONE';
	var inOUT = 'OUT';
	var useIE = '0';
	var random = '11800935';
	var threeway_end = 0;
	var agentphonelive = 0;
	var conf_dialed = 0;
	var leaving_threeway = 0;
	var blind_transfer = 0;
	var hangup_all_non_reserved = '1';
	var dial_method = 'INBOUND_MAN';
	var web_form_target = 'popupFrame';
	var TEMP_VDIC_web_form_address = '';
	var TEMP_VDIC_web_form_address_two = '';
	var APIPausE_ID = '99999';
	var APIDiaL_ID = '99999';
	var CheckDEADcall = 0;
	var CheckDEADcallON = 0;
	var VtigeRLogiNScripT = 'Y';
	var VtigeRurl = 'http://172.17.1.90/ccms/CallCenter/index_vici.php';
	var VtigeREnableD = '1';
	var alert_enabled = 'OFF';
	var allow_alerts = '1';
	var shift_logout_flag = 0;
	var vtiger_callback_id = 0;
	var agent_status_view = '1';
	var agent_status_view_time = '0';
	var agent_status_view_active = 0;
	var xfer_select_agents_active = 0;
	var even=0;
	var VU_user_group = 'Demo';
	var quick_transfer_button = 'N';
	var quick_transfer_button_enabled = '0';
	var prepopulate_transfer_preset = 'N';
	var prepopulate_transfer_preset_enabled = '0';
	var view_calls_in_queue = '0';
	var view_calls_in_queue_launch = '0';
	var view_calls_in_queue_active = '0';
	var call_requeue_button = '0';
	var no_hopper_dialing = '0';
	var agent_dial_owner_only = 'NONE';
	var agent_display_dialable_leads = '0';
	var no_empty_session_warnings = '0';
	var auto_dispo_time = '0';
	var auto_dispo_time_count = 0;
	
	var acw_hold_time = '120';
	
	
	//var script_width = '810';
	//Mod by fnatic
	var script_width = '100%';
	//用于停止transferTarget和transferTargetStart轮询函数 + fnatic
	var transferTarget_t;
	var transferTargetStart_t;
	var Undefined_Dialog_Status = 'N';
    //End
	var script_height = '431';
	var enable_second_webform = '1';
	var no_delete_VDAC=0;
	var manager_ingroups_set=0;
	var external_igb_set_name='';
	var recording_filename='';
	var recording_id='';
	var delayed_script_load='';
	var script_recording_delay='';
	var VDRP_stage='PAUSED';
	var VU_custom_one = '';
	var VU_custom_two = '';
	var VU_custom_three = '';
	var VU_custom_four = '';
	var VU_custom_five = '';
	var crm_popup_login = 'N';
	var crm_login_address = '';
	var update_fields=0;
	var update_fields_data='';
	var campaign_timer_action = 'NONE';
	var campaign_timer_action_message = '';
	var campaign_timer_action_seconds = '-1';
	var agent_hangup_confirm = 'N';
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
	var DiaLControl_auto_HTML = "<IMG SRC=\"../agc/images/cn/vdc_LB_pause_OFF_cn.gif\" border=0 alt=\" 暂停 \"><a href=\"#\" onclick=\"AutoDial_ReSume_PauSe('VDADready');\"><IMG SRC=\"../agc/images/cn/vdc_LB_resume_cn.gif\" border=0 alt=\"恢复\"></a>";
	var DiaLControl_auto_HTML_ready = "<a href=\"#\" onclick=\"check_max_pause_count();\"><IMG SRC=\"../agc/images/cn/vdc_LB_pause_cn.gif\" border=0 alt=\" 暂停 \"></a><IMG SRC=\"../agc/images/cn/vdc_LB_resume_OFF_cn.gif\" border=0 alt=\"恢复\">";
	var DiaLControl_auto_HTML_OFF = "<IMG SRC=\"../agc/images/cn/vdc_LB_pause_OFF_cn.gif\" border=0 alt=\" 暂停 \"><IMG SRC=\"../agc/images/cn/vdc_LB_resume_OFF_cn.gif\" border=0 alt=\"恢复\">";
	var DispoSelectBoxStatus = 0;
	var Ring_Uniqueid_old = "";
	//Mod by fnatic start
	if(Dial_Next_Display=='Y')
	   {
	var DiaLControl_manual_HTML = "<a href=\"#\" onclick=\"ManualDialNext('','','','','','0');\"><IMG SRC=\"../agc/images/cn/vdc_LB_dialnextnumber_cn.gif\" border=0 alt=\"拨下一个号码\"></a>";
	   }
	else
	  {
	var DiaLControl_manual_HTML = "";
	   }

	var manudial_noanswer_log = 0;
	//Mod by fnatic end

	var image_blank = new Image();
		image_blank.src="../agc/images/blank.gif";
	var image_livecall_OFF = new Image();
		image_livecall_OFF.src="../agc/images/cn/agc_live_call_OFF_cn.gif";
	var image_livecall_ON = new Image();
		image_livecall_ON.src="../agc/images/cn/agc_live_call_ON_cn.gif";
	var image_livecall_DEAD = new Image();
		image_livecall_DEAD.src="../agc/images/cn/agc_live_call_DEAD_cn.gif";
	var image_LB_dialnextnumber = new Image();
		image_LB_dialnextnumber.src="../agc/images/cn/vdc_LB_dialnextnumber_cn.gif";
	var image_LB_hangupcustomer = new Image();
		image_LB_hangupcustomer.src="../agc/images/cn/vdc_LB_hangupcustomer_cn.gif";
	var image_LB_transferconf = new Image();
		image_LB_transferconf.src="../agc/images/cn/vdc_LB_transferconf_cn.gif";
	var image_LB_grabparkedcall = new Image();
		image_LB_grabparkedcall.src="../agc/images/cn/vdc_LB_grabparkedcall_cn.gif";
	var image_LB_parkcall = new Image();
		image_LB_parkcall.src="../agc/images/cn/vdc_LB_parkcall_cn.gif";
	var image_LB_webform = new Image();
		image_LB_webform.src="../agc/images/cn/vdc_LB_webform_cn.gif";
	var image_LB_stoprecording = new Image();
		image_LB_stoprecording.src="../agc/images/vdc_LB_stoprecording_cn.gif";
	var image_LB_startrecording = new Image();
		image_LB_startrecording.src="../agc/images/vdc_LB_startrecording_cn.gif";
	var image_LB_pause = new Image();
		image_LB_pause.src="../agc/images/cn/vdc_LB_pause_cn.gif";
	var image_LB_resume = new Image();
		image_LB_resume.src="../agc/images/cn/vdc_LB_resume_cn.gif";
	var image_LB_senddtmf = new Image();
		image_LB_senddtmf.src="../agc/images/vdc_LB_senddtmf_cn.gif";
	var image_LB_dialnextnumber_OFF = new Image();
		image_LB_dialnextnumber_OFF.src="../agc/images/cn/vdc_LB_dialnextnumber_OFF_cn.gif";
	var image_LB_hangupcustomer_OFF = new Image();
		image_LB_hangupcustomer_OFF.src="../agc/images/cn/vdc_LB_hangupcustomer_OFF_cn.gif";
	var image_LB_transferconf_OFF = new Image();
		image_LB_transferconf_OFF.src="../agc/images/cn/vdc_LB_transferconf_OFF_cn.gif";
	var image_LB_grabparkedcall_OFF = new Image();
		image_LB_grabparkedcall_OFF.src="../agc/images/vdc_LB_grabparkedcall_OFF_cn.gif";
	var image_LB_parkcall_OFF = new Image();
		image_LB_parkcall_OFF.src="../agc/images/cn/vdc_LB_parkcall_OFF_cn.gif";
	var image_LB_webform_OFF = new Image();
		image_LB_webform_OFF.src="../agc/images/cn/vdc_LB_webform_OFF_cn.gif";
	var image_LB_stoprecording_OFF = new Image();
		image_LB_stoprecording_OFF.src="../agc/images/vdc_LB_stoprecording_OFF.gif";
	var image_LB_startrecording_OFF = new Image();
		image_LB_startrecording_OFF.src="../agc/images/vdc_LB_startrecording_OFF.gif";
	var image_LB_pause_OFF = new Image();
		image_LB_pause_OFF.src="../agc/images/cn/vdc_LB_pause_OFF_cn.gif";
	var image_LB_resume_OFF = new Image();
		image_LB_resume_OFF.src="../agc/images/cn/vdc_LB_resume_OFF_cn.gif";
	var image_LB_senddtmf_OFF = new Image();
		image_LB_senddtmf_OFF.src="../agc/images/vdc_LB_senddtmf_OFF_cn.gif";
	var agent_dial_start_epoch = "";
	var AutopauseControlCount = 0;
	var ParkControlCount = 0;
	var ParkControlredirectdestserverip = "";
	var ParkControlredirectdestination = "";
	var Xfer_Target_Unavailable_Update_Enable_Count = 0;
	var transfer_Xfre_Value = 0;
	var check_for_grab_incoming_count = 0;
	var status_type = 0;
	var agent_available_reset = 'N';
	var agent_available_reset_codde = '';
	var agent_available_reset_count = 0;
	var agent_available_reset_check = 0;
	var redirectcalltoagentid = "";
	var session_RemotePhone = '';
	var pauseCodeSelectBoxStatus = 0;
// ################################################################################
//jquery dialog window parameter default

//pausecode content 
$(function(){
$('#PauseCodeSelectBoxDIV').dialog('destory');
$('#PauseCodeSelectBoxDIV').dialog
({
autoOpen:false,//是否自动打开窗口
draggable:false,//是否可以手抓移动
resizable:false,//是否可以拉伸窗口大小
closeOnEscape: false, //是否可以按ESC关闭窗口
dialogClass: "PauseCode-dialog",//该窗口的样式名
title:'暂停原因',
height:'auto',
width:550,
modal:true
});
})

//agentview content
$(function(){

$('#AgentViewSpanDIV').dialog('destory');
$('#AgentViewSpanDIV').dialog
({
autoOpen:false,
draggable:false,
resizable:false,
title: '查看话务员状态',
height:'auto',
width: 500,
modal: false
});
//电话小结
$('#DispoSelectBox').dialog('destory');
$('#DispoSelectBox').dialog
({
position:['center','top'],
autoOpen:false,
draggable:true,
resizable:false,
title: '电话小结',
height:'auto',
width: '750px',
modal: false,
closeOnEscape: false,
open: function(event, ui) { $(this).closest('.ui-dialog').find('.ui-dialog-titlebar-close').hide();}
});
//个人回拔提示
$('#CallBackSelectBox').dialog
({
autoOpen:false,
draggable:true,
resizable:false,
title: '个人回拨提示',
height:'auto',
width: 580,
modal: true,
closeOnEscape: false,
open: function(event, ui) { $(this).closest('.ui-dialog').find('.ui-dialog-titlebar-close').hide();}
});

$( "#CallBackDatESelectioN" ).datepicker({dateFormat : 'yy-mm-dd '});

})

//callsinqueuedisplay content
$(function(){
$('#callsinqueuedisplayDIV').dialog('destory');
$('#callsinqueuedisplayDIV').dialog
({
autoOpen:false,
draggable:false,
resizable:false,
title:'提取队列通话',
width:950,
height:'auto',
modal: true

});
})

//TransferMain content
$(function(){
$('#TransferMainDIV').dialog('destory');
$("#TransferMainDIV").dialog
({
autoOpen:false,
draggable:false,
resizable:false,
title:'转接电话',
height:360,
width:390,
modal:false,
position:['center',200]
});
})


//DIAL ALERT content

$(function(){
$('#DailAlertDIV').dialog('destory');
$('#DailAlertDIV').dialog
({
autoOpen:false,
draggable:false,
resizable:false,
title:'系统提示',
width:250,
height:140,
modal: true
});
})


var fdiv;
var Volume_data_array = Array();

function divfun() {
	this.eventSrc = null; 
	this.div = document.getElementById("divtest");  
}
function hiddenDiv() {
	var div = document.getElementById("divtest");
	div.style.display = "none";
}

function showVolumeDiv(channel,e)
{
	var t = e.offsetTop, h = e.offsetHeight, l = e.offsetLeft, p = e.type;
	fdiv = new divfun();
	var o = fdiv.div.style;
	fdiv.eventSrc = e;

	while (e = e.offsetParent) { t += e.offsetTop; l += e.offsetLeft; }
	o.top = t - h -60;
	o.left = l+20;
	o.display = "block";
	if(!Volume_data_array[channel]){Volume_data_array[channel] = Volume_original;}
	volume_display_value(Volume_data_array[channel]);
}
     
function setvalue(obj) {
	var t = document.getElementById("t1");
	t1.value = obj.innerText;
}

// ################################################################################
// Send Hangup command for Live call connected to phone now to Manager
	function livehangup_send_hangup(taskvar) 
		{
		var xmlhttp=false;
		/*@cc_on @*/
		/*@if (@_jscript_version >= 5)
		// JScript gives us Conditional compilation, we can cope with old IE versions.
		// and security blocked creation of the objects.
		 try {
		  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		 } catch (e) {
		  try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  } catch (E) {
		   xmlhttp = false;
		  }
		 }
		@end @*/
		if (!xmlhttp && typeof XMLHttpRequest!='undefined')
			{
			xmlhttp = new XMLHttpRequest();
			}
		if (xmlhttp) 
			{ 
			var queryCID = "HLagcW" + epoch_sec + user_abb;
			var hangupvalue = taskvar;
			livehangup_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ACTION=Hangup&format=text&channel=" + hangupvalue + "&queryCID=" + queryCID;
			xmlhttp.open('POST', 'manager_send.php'); 
			xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
			xmlhttp.send(livehangup_query); 
			xmlhttp.onreadystatechange = function() 
				{ 
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
					{
					Nactiveext = null;
					Nactiveext = xmlhttp.responseText;
					//alert(xmlhttp.responseText);
						xmlhttp = null;
						CollectGarbage();
					}
				}
			delete xmlhttp;
			}
		}
	function outbound_dial_line2(){
		
		var phone_temp = document.getElementById('tel_out_line2').value;
		phone_temp = phone_temp.replace(/^\s*/,"").replace(/\s*$/,"");
		if(phone_temp != ""){
			document.getElementById("out_line12").innerHTML = "<input type='button' onClick=\"outbound_hangup_line2();return false;\" value=\"挂断\" />";
			if ( customerparked == 0 )
				{
					mainxfer_send_redirect('ParK',lastcustchannel,lastcustserverip);
				}
			var xmlhttp=false;
			/*@cc_on @*/
			/*@if (@_jscript_version >= 5)
			// JScript gives us Conditional compilation, we can cope with old IE versions.
			// and security blocked creation of the objects.
			 try {
			  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
			 } catch (e) {
			  try {
			   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			  } catch (E) {
			   xmlhttp = false;
			  }
			 }
			@end @*/
			if (!xmlhttp && typeof XMLHttpRequest!='undefined')
				{
				xmlhttp = new XMLHttpRequest();
				}
			if (xmlhttp) 
				{
				var para = "phone_number=" + phone_temp + "&campaign=" + campaign + "&user_group=" + VU_user_group + "&dial_prefix=" + dial_prefix + "&server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ACTION=outbound_dial_line2&conf_exten=" + session_id + "&extension=" + extension + "&campaign=" + campaign;
				xmlhttp.open('POST', 'vdc_db_query.php'); 
				xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
				xmlhttp.send(para); 
				xmlhttp.onreadystatechange = function() 
					{ 
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
						{
						CheckOutboundChannelLine2 = 1;
						Nactiveext = null;
						var Nactiveextoutput   =  xmlhttp.responseText;
						var A_Nactiveextoutput =  Nactiveextoutput.split("|");
						Nactiveext                  = A_Nactiveextoutput[0];
						agent_log_id_outbound_line2 = A_Nactiveextoutput[1];
						
						xmlhttp = null;
						CollectGarbage();
						outbound_line2_para = Nactiveext;
						CountOutboundChannelLine2 = 0;
						}
					}
				delete xmlhttp;
				}
		}
		
	}
	function outbound_hangup_line2(){
		CheckOutboundChannelLine2 = 0;
		var xmlhttp=false;
		/*@cc_on @*/
		/*@if (@_jscript_version >= 5)
		// JScript gives us Conditional compilation, we can cope with old IE versions.
		// and security blocked creation of the objects.
		 try {
		  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		 } catch (e) {
		  try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  } catch (E) {
		   xmlhttp = false;
		  }
		 }
		@end @*/
		if (!xmlhttp && typeof XMLHttpRequest!='undefined')
			{
			xmlhttp = new XMLHttpRequest();
			}
		if (xmlhttp) 
			{ 
			var para = "uniqueid=" + outbound_line2_para + "&server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ACTION=outbound_hangup_line2&conf_exten=" + session_id + "&agent_log_id_line2=" + agent_log_id_outbound_line2;
			xmlhttp.open('POST', 'vdc_db_query.php'); 
			xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
			xmlhttp.send(para); 
			xmlhttp.onreadystatechange = function() 
				{ 
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
					{
					//alert(CALLSINQUEUEGRABSTR);
					Nactiveext = null;
					Nactiveext = xmlhttp.responseText;
					agent_log_id_outbound_line2 = 0;
					xmlhttp = null;
					CollectGarbage();
					if(document.images['livecall'].src == image_livecall_ON.src){
						document.getElementById("out_line12").innerHTML = "<input type='text' size=\"15\" maxlength=\"20\" name=\"tel_out_line2\" id=\"tel_out_line2\" value=\"\" ><input type='button' onClick=\"outbound_dial_line2();return false;\" value=\"拨号\" />";
					}else{
						document.getElementById("out_line12").innerHTML = "";
					}
					}
				}
			delete xmlhttp;
			}
	}
	function outbound_redirect_line2(var_exten){
		var xmlhttp=false;
		/*@cc_on @*/
		/*@if (@_jscript_version >= 5)
		// JScript gives us Conditional compilation, we can cope with old IE versions.
		// and security blocked creation of the objects.
		 try {
		  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		 } catch (e) {
		  try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  } catch (E) {
		   xmlhttp = false;
		  }
		 }
		@end @*/
		if (!xmlhttp && typeof XMLHttpRequest!='undefined')
			{
			xmlhttp = new XMLHttpRequest();
			}
		if (xmlhttp) 
			{ 
			var para = "exten=" + var_exten + "&server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ACTION=outbound_redirect_line2&session_id=" + session_id;
			xmlhttp.open('POST', 'vdc_db_query.php'); 
			xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
			xmlhttp.send(para); 
			xmlhttp.onreadystatechange = function() 
				{ 
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
					{
					//alert(CALLSINQUEUEGRABSTR);
					Nactiveext = null;
					Nactiveext = xmlhttp.responseText;
					xmlhttp = null;
					CollectGarbage();
					}
				}
			delete xmlhttp;
			}
	}
// ################################################################################
// Send volume control command for meetme participant
	function volume_control(taskdirection,taskvolchannel,taskagentmute) 
		{
		if (taskagentmute=='AgenT')
			{
			taskvolchannel = agentchannel;
			}
		var xmlhttp=false;
		/*@cc_on @*/
		/*@if (@_jscript_version >= 5)
		// JScript gives us Conditional compilation, we can cope with old IE versions.
		// and security blocked creation of the objects.
		 try {
		  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		 } catch (e) {
		  try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  } catch (E) {
		   xmlhttp = false;
		  }
		 }
		@end @*/
		if (!xmlhttp && typeof XMLHttpRequest!='undefined')
			{
			xmlhttp = new XMLHttpRequest();
			}
		if (xmlhttp) 
			{ 
			var queryCID = "VCagcW" + epoch_sec + user_abb;
			var volchanvalue = taskvolchannel;
			
			try{volume_display_control(taskdirection,taskvolchannel,'start',queryCID);}
			catch(err){}
			
			livevolume_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ACTION=VolumeControl&format=text&channel=" + volchanvalue + "&stage=" + taskdirection + "&exten=" + session_id + "&ext_context=" + ext_context + "&queryCID=" + queryCID;
			//alert(livevolume_query);
			xmlhttp.open('POST', 'manager_send.php'); 
			xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
			xmlhttp.send(livevolume_query); 
			xmlhttp.onreadystatechange = function() 
				{ 
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
					{
					Nactiveext = null;
					Nactiveext = xmlhttp.responseText;
				//	alert(xmlhttp.responseText);
						xmlhttp = null;
						CollectGarbage();
					}
				}
			delete xmlhttp;
			if(!(taskdirection == "UP" || taskdirection == "DOWN")){
				try{volume_display_control(taskdirection,taskvolchannel,'end',queryCID);}
				catch(err){}
			}
			}
		if (taskagentmute=='AgenT')
			{
			if (taskdirection=='MUTING')
				{
				document.getElementById("AgentMuteSpan").innerHTML = "<a href=\"#CHAN-" + agentchannel + "\" onclick=\"volume_control('UNMUTE','" + agentchannel + "','AgenT');return false;\"><IMG SRC=\"../agc/images/cn/vdc_volume_UNMUTE_cn.gif\" BORDER=0></a>";
				}
			else
				{
				document.getElementById("AgentMuteSpan").innerHTML = "<a href=\"#CHAN-" + agentchannel + "\" onclick=\"volume_control('MUTING','" + agentchannel + "','AgenT');return false;\"><IMG SRC=\"../agc/images/cn/vdc_volume_MUTE_cn.gif\" BORDER=0></a>";
				}
			}

		}


// ################################################################################
// Send alert control command for agent
	function alert_control(taskalert) 
		{
		var xmlhttp=false;
		/*@cc_on @*/
		/*@if (@_jscript_version >= 5)
		// JScript gives us Conditional compilation, we can cope with old IE versions.
		// and security blocked creation of the objects.
		 try {
		  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		 } catch (e) {
		  try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  } catch (E) {
		   xmlhttp = false;
		  }
		 }
		@end @*/
		if (!xmlhttp && typeof XMLHttpRequest!='undefined')
			{
			xmlhttp = new XMLHttpRequest();
			}
		if (xmlhttp) 
			{ 
			alert_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ACTION=AlertControl&format=text&stage=" + taskalert;
			xmlhttp.open('POST', 'vdc_db_query.php'); 
			xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
			xmlhttp.send(alert_query); 
			xmlhttp.onreadystatechange = function() 
				{ 
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
					{
					Nactiveext = null;
					Nactiveext = xmlhttp.responseText;
				//	alert(xmlhttp.responseText);
						xmlhttp = null;
						CollectGarbage();
					}
				}
			delete xmlhttp;
			}
		if (taskalert=='ON')
			{
			alert_enabled = 'ON';
			document.getElementById("AgentAlertSpan").innerHTML = "<a href=\"#\" onclick=\"alert_control('OFF');return false;\">关闭进线提示</a>";
			}
		else
			{
			alert_enabled = 'OFF';
			document.getElementById("AgentAlertSpan").innerHTML = "<a href=\"#\" onclick=\"alert_control('ON');return false;\">开启进线提示</a>";
			}

		}


// ################################################################################
// park customer and place 3way call
	function xfer_park_dial()
		{
		//yanson@20110310 start
		try{
			document.getElementById("consultativexfer").disabled=true;
			document.getElementById("xferoverride").disabled=true;
			document.getElementById("xferoverrideaaa").disabled=true;
			document.getElementById("xferoverridebbb").disabled=true;
		}catch(err){ }
			//yanson@20110310 end
		conf_dialed=1;

		mainxfer_send_redirect('ParK',lastcustchannel,lastcustserverip);

		SendManualDial('YES');
		}

// ################################################################################
// place 3way and customer into other conference and fake-hangup the lines
	function leave_3way_call(tempvarattempt)
		{
		threeway_end=0;
		leaving_threeway=1;

		if (customerparked > 0)
			{
			mainxfer_send_redirect('FROMParK',lastcustchannel,lastcustserverip);
			}

		mainxfer_send_redirect('3WAY','','',tempvarattempt);

//		if (threeway_end == '0')
//			{
//			document.vicidial_form.xferchannel.value = '';
//			xfercall_send_hangup();
//
//			document.vicidial_form.callchannel.value = '';
//			document.vicidial_form.callserverip.value = '';
//			dialedcall_send_hangup();
//			}

		if( document.images ) { document.images['livecall'].src = image_livecall_OFF.src;}
		}

// ################################################################################
// filter manual dialstring and pass on to originate call
	function SendManualDial(taskFromConf)
		{
		conf_dialed=1;
		var sending_group_alias = 0;
		if (taskFromConf == 'YES')
			{
			//yanson@20110310 start
		try{
			document.getElementById("consultativexfer").disabled=true;
			document.getElementById("xferoverride").disabled=true;
			document.getElementById("xferoverrideaaa").disabled=true;
			document.getElementById("xferoverridebbb").disabled=true;
		}catch(err){ }
			//yanson@20110310 end
			agent_dialed_number='1';
			agent_dialed_type='XFER_3WAY';
            //Mod by fnatic start
			if(Xfer_Dial_With_Customer_Display=='Y')
				{
			document.getElementById("DialWithCustomer").innerHTML ="<IMG SRC=\"../agc/images/cn/vdc_XB_dialwithcustomer_OFF_cn.gif\" border=0 alt=\"不挂断拨号\" style=\"vertical-align:middle\"></a>";
                }
			//Mod by fnatic end
			document.getElementById("ParkCustomerDial").innerHTML ="<IMG SRC=\"../agc/images/cn/vdc_XB_parkcustomerdial_OFF_cn.gif\" border=0 alt=\"保持客户拨号\" style=\"vertical-align:middle\"></a>";
			document.getElementById("DialBlindTransfer").innerHTML = "<IMG SRC=\"../agc/images/cn/vdc_XB_blindtransfer_OFF_cn.gif\" border=0 alt=\"盲转\" style=\"vertical-align:middle\">";
			document.getElementById("agentdirectlink").innerHTML = "话务员";
			//Mod by fnatic
			//var manual_number = document.vicidial_form.xfernumber.value;
			var manual_number = document.getElementById("xfernumber").value;
			var manual_string = manual_number.toString();
			var dial_conf_exten = session_id;
			threeway_cid = '';
			if (three_way_call_cid == 'CAMPAIGN')
				{threeway_cid = campaign_cid;}
			if (three_way_call_cid == 'AGENT_PHONE')
				{threeway_cid = outbound_cid;}
			if (three_way_call_cid == 'CUSTOMER')
				{threeway_cid = document.vicidial_form.phone_number.value;}
			if (three_way_call_cid == 'AGENT_CHOOSE')
				{
				threeway_cid = cid_choice;
				if (active_group_alias.length > 1)
					{var sending_group_alias = 1;}
				}
			}
		else
			{
			//Mod by fnatic
			//var manual_number = document.vicidial_form.xfernumber.value;
			var manual_number = document.getElementById("xfernumber").value;
			var manual_string = manual_number.toString();
			}
		var regXFvars = new RegExp("XFER","g");
		if (manual_string.match(regXFvars))
			{
			var donothing=1;
			}
		else
			{//Mod by fnatic
			//if (document.vicidial_form.xferoverride.checked==false)
			if (document.getElementById("xferoverride").checked==false)
				{
				if (three_way_dial_prefix == 'X') {var temp_dial_prefix = '';}
				else {var temp_dial_prefix = three_way_dial_prefix;}
				if (omit_phone_code == 'Y') {var temp_phone_code = '';}
				else {var temp_phone_code = document.vicidial_form.phone_code.value;}
				
				if (manual_string.length > 7)
					{manual_string = temp_dial_prefix + "" + temp_phone_code + "" + manual_string;}
				}

			else
				{
				
				var reg=eval("/^"+dial_prefix+".+/");
				if(!reg.test(manual_string)){manual_string = dial_prefix+manual_string;}
				agent_dialed_type='XFER_OVERRIDE';
				
				}
			}
		if (taskFromConf == 'YES')
			{basic_originate_call(manual_string,'NO','YES',dial_conf_exten,'NO',taskFromConf,threeway_cid,sending_group_alias);}
		else
			{basic_originate_call(manual_string,'NO','NO','','','','1',sending_group_alias);}

		MD_ring_secondS=0;
		}


/*  vicidial auto模式内部分机互打函数 + fnatic
	function local_internal_call(called_user)
		{
		var manual_string	= called_user;
		var dial_conf_exten = session_id;
		var taskconfxfer	= 'YES';
		var sending_group_alias = 0;
		var local_callerid = phone_login;
		var taskFromConf = taskconfxfer;
		document.getElementById("consultativexfer").checked=true;
		document.getElementById("xfernumber").value = user;

		var loop_ct = 0;
		var live_XfeR_HTML = '';
		var XfeR_SelecT = '';
		//alert(VARxfergroups[0]+"----"+VARxfergroups[1]+"----"+VARxfergroups[2]);
		
		
		//alert(loop_ct);

		while (loop_ct < XFgroupCOUNT)
			{
			if (VARxfergroups[loop_ct] == 'AGENTDIRECT')
				{XfeR_SelecT = 'selected ';}
			else {XfeR_SelecT = '';}
			live_XfeR_HTML = live_XfeR_HTML + "<option " + XfeR_SelecT + "value=\"" + VARxfergroups[loop_ct] + "\">" + VARxfergroups[loop_ct] + " - " + VARxfergroupsnames[loop_ct] + "</option>\n";
			loop_ct++;
			}

		document.getElementById("XfeRGrouPLisT").innerHTML = "<select size=1 name=XfeRGrouP class=\"cust_form\" id=XfeRGrouP onChange=\"XferAgentSelectLink();return false;\">" + live_XfeR_HTML + "</select>";

//		alert(manual_string+"----"+dial_conf_exten+"----"+taskFromConf+"----"+local_callerid+"----"+sending_group_alias);
		basic_originate_call(manual_string,'NO','YES',dial_conf_exten,'NO',taskFromConf,local_callerid,sending_group_alias);

		}

*/
// ################################################################################
// Send Originate command to manager to place a phone call
	function basic_originate_call(tasknum,taskprefix,taskreverse,taskdialvalue,tasknowait,taskconfxfer,taskcid,taskusegroupalias) 
		{
		var usegroupalias=0;
		var consultativexfer_checked = 0;

		//Mod by fnatic
		//if (document.vicidial_form.consultativexfer.checked==true)
		if (document.getElementById("consultativexfer").checked==true)
			{consultativexfer_checked = 1;}
		var regCXFvars = new RegExp("CXFER","g");
		var tasknum_string = tasknum.toString();
		if ( (tasknum_string.match(regCXFvars)) || (consultativexfer_checked > 0) )
			{
			if (tasknum_string.match(regCXFvars))
				{
				var Ctasknum = tasknum_string.replace(regCXFvars, '');
				if (Ctasknum.length < 2)
					{Ctasknum = '90009';}
				var agentdirect = '';
				}
			else
				{
				Ctasknum = '90009';
				var agentdirect = tasknum_string;
				}
			var XfeRSelecT = document.getElementById("XfeRGrouP");
			tasknum = Ctasknum + "*" + XfeRSelecT.value + '*CXFER*' + document.vicidial_form.lead_id.value + '**' + dialed_number + '*' + user + '*' + agentdirect + '*' + VD_live_call_secondS + '*';
			//alert(tasknum);

			CustomerData_update();
			}
		var regAXFvars = new RegExp("AXFER","g");
		if (tasknum_string.match(regAXFvars))
			{
			var Ctasknum = tasknum_string.replace(regAXFvars, '');
			if (Ctasknum.length < 2)
				{Ctasknum = '83009';}
			var closerxfercamptail = '_L';
			if (closerxfercamptail.length < 3)
				{closerxfercamptail = 'IVR';}
			tasknum = Ctasknum + '*' + document.vicidial_form.phone_number.value + '*' + document.vicidial_form.lead_id.value + '*' + campaign + '*' + closerxfercamptail + '*' + user + '**' + VD_live_call_secondS + '*';

			CustomerData_update();

			}


		var xmlhttp=false;
		/*@cc_on @*/
		/*@if (@_jscript_version >= 5)
		// JScript gives us Conditional compilation, we can cope with old IE versions.
		// and security blocked creation of the objects.
		 try {
		  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		 } catch (e) {
		  try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  } catch (E) {
		   xmlhttp = false;
		  }
		 }
		@end @*/
		if (!xmlhttp && typeof XMLHttpRequest!='undefined')
			{
			xmlhttp = new XMLHttpRequest();
			}
		if (xmlhttp) 
			{
			if (taskprefix == 'NO') {var call_prefix = '';}
			  else {var call_prefix = agc_dial_prefix;}

			if (prefix_choice.length > 0)
				{var call_prefix = prefix_choice;}

			if (taskreverse == 'YES')
				{
				if (taskdialvalue.length < 2)
					{var dialnum = dialplan_number;}
				else
					{var dialnum = taskdialvalue;}
				var call_prefix = '';
				var originatevalue = "Local/" + tasknum + "@" + ext_context;
				}
			  else 
				{
				var dialnum = tasknum;
				if ( (protocol == 'EXTERNAL') || (protocol == 'Local') )
					{
					var protodial = 'Local';
					var extendial = extension;
			//		var extendial = extension + "@" + ext_context;
					}
				else
					{
					var protodial = protocol;
					var extendial = extension;
					}
				var originatevalue = protodial + "/" + extendial;
				}
			if (taskconfxfer == 'YES')
				{var queryCID = "DCagcW" + epoch_sec + user_abb;}
			else
				{var queryCID = "DVagcW" + epoch_sec + user_abb;}

			if (cid_choice.length > 3) 
				{
				var call_cid = cid_choice;
				usegroupalias=1;
				}
			else 
				{
				if (taskcid.length > 3) 
					{var call_cid = taskcid;}
				else 
					{var call_cid = campaign_cid;}
				}

			VMCoriginate_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ACTION=Originate&format=text&channel=" + originatevalue + "&queryCID=" + queryCID + "&exten=" + call_prefix + "" + dialnum + "&ext_context=" + ext_context + "&ext_priority=1&outbound_cid=" + call_cid + "&usegroupalias=" + usegroupalias + "&account=" + active_group_alias + "&agent_dialed_number=" + agent_dialed_number + "&agent_dialed_type=" + agent_dialed_type;
			xmlhttp.open('POST', 'manager_send.php'); 
			xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
			xmlhttp.send(VMCoriginate_query); 
			xmlhttp.onreadystatechange = function() 
				{ 
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
					{
				//	alert(VMCoriginate_query);
				//	alert(xmlhttp.responseText);

					var regBOerr = new RegExp("ERROR","g");
					var BOresponse = xmlhttp.responseText;
					if (BOresponse.match(regBOerr))
						{
						alert(BOresponse);
						}

					if ((taskdialvalue.length > 0) && (tasknowait != 'YES'))
						{
						XDnextCID = queryCID;
						MD_channel_look=1;
						XDcheck = 'YES';

				//		document.getElementById("HangupXferLine").innerHTML ="<a href=\"#\" onclick=\"xfercall_send_hangup();return false;\"><IMG SRC=\"../agc/images/cn/vdc_XB_hangupxferline_cn.gif\" border=0 alt=\"挂断第三方转接线\"></a>";
						}
						xmlhttp = null;
						CollectGarbage();
					}
				}
			delete xmlhttp;
			active_group_alias='';
			cid_choice='';
			prefix_choice='';
			agent_dialed_number='';
			agent_dialed_type='';
			CalL_ScripT_id='';
			}
		}

// ################################################################################
// filter conf_dtmf send string and pass on to originate call
	function SendConfDTMF(taskconfdtmf)
		{
		var dtmf_number = document.vicidial_form.conf_dtmf.value;
		var dtmf_string = dtmf_number.toString();
		var conf_dtmf_room = taskconfdtmf;

		var xmlhttp=false;
		/*@cc_on @*/
		/*@if (@_jscript_version >= 5)
		// JScript gives us Conditional compilation, we can cope with old IE versions.
		// and security blocked creation of the objects.
		 try {
		  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		 } catch (e) {
		  try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  } catch (E) {
		   xmlhttp = false;
		  }
		 }
		@end @*/
		if (!xmlhttp && typeof XMLHttpRequest!='undefined')
			{
			xmlhttp = new XMLHttpRequest();
			}
		if (xmlhttp) 
			{ 
			var queryCID = dtmf_string;
			VMCoriginate_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass  + "&ACTION=SysCIDOriginate&format=text&channel=" + dtmf_send_extension + "&queryCID=" + queryCID + "&exten=" + dtmf_silent_prefix + '' + conf_dtmf_room + "&ext_context=" + ext_context + "&ext_priority=1";
			xmlhttp.open('POST', 'manager_send.php'); 
			xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
			xmlhttp.send(VMCoriginate_query); 
			xmlhttp.onreadystatechange = function() 
				{ 
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
					{
			//		alert(xmlhttp.responseText);
									xmlhttp = null;
						CollectGarbage();
					}
				}
			delete xmlhttp;
			}
		document.vicidial_form.conf_dtmf.value = '';
		}
	function ring_redirect_to_page(uniqueid){
		var xmlhttp=false;
		try {
		  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
			   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (E) {
			   xmlhttp = false;
			}
		}

		if (!xmlhttp && typeof XMLHttpRequest!='undefined')
		{
		xmlhttp = new XMLHttpRequest();
		}
		if (xmlhttp) 
		{
			var para = "ACTION=getringinfo&uniqueid=" + uniqueid + "&server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&campaign=" + campaign;
			xmlhttp.open('POST', 'vdc_db_query.php'); 
			xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
			xmlhttp.send(para);
			xmlhttp.onreadystatechange = function(){ 
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
				{
					var BOresponse = xmlhttp.responseText;
					var BOresponseArr = BOresponse.split("+++");
					//alert(BOresponse);
					if (BOresponseArr[0] == 'SCRIPT')
						{
							web_form_vars = BOresponseArr[1];
							var regWFspace = new RegExp(" ","ig");
							web_form_vars = web_form_vars.replace(regWF, '');
							var regWF = new RegExp("\\`|\\~|\\:|\\;|\\#|\\'|\\\"|\\{|\\}|\\(|\\)|\\*|\\^|\\%|\\$|\\!|\\%|\\r|\\t|\\n","ig");
							web_form_vars = web_form_vars.replace(regWFspace, '+');
							web_form_vars = web_form_vars.replace(regWF, '');
							//alert(web_form_vars);
							load_script_contents();
						}
					if (BOresponseArr[0] == 'WEBFORM')
						{
						BOresponseArr[1] = BOresponseArr[1] + "&user=" + user;
						window.open(BOresponseArr[1], web_form_target, 'toolbar=1,scrollbars=1,location=1,statusbar=1,menubar=1,resizable=1,width=640,height=450');
						}
					xmlhttp = null;
					CollectGarbage();
				}
			}
		}
	}
// ################################################################################
// Check to see if there are any channels live in the agent's conference meetme room
	function check_for_conf_calls(taskconfnum,taskforce)
		{
		if (typeof(xmlhttprequestcheckconf) == "undefined") {
			//alert (xmlhttprequestcheckconf == xmlhttpSendConf);
			//++ 20101029
			xmlhttprequestcheckconf_wait = 0;
			custchannellive--;
			if ( (agentcallsstatus == '1') || (callholdstatus == '1') )
				{
				campagentstatct++;
				if (campagentstatct > campagentstatctmax) 
					{
					campagentstatct=0;
					var campagentstdisp = 'YES';
					}
				else
					{
					var campagentstdisp = 'NO';
					}
				}
			else
				{
				var campagentstdisp = 'NO';
				}

			xmlhttprequestcheckconf=false;
			/*@cc_on @*/
			/*@if (@_jscript_version >= 5)
			// JScript gives us Conditional compilation, we can cope with old IE versions.
			// and security blocked creation of the objects.
			 try {
			  xmlhttprequestcheckconf = new ActiveXObject("Msxml2.XMLHTTP");
			 } catch (e) {
			  try {
			   xmlhttprequestcheckconf = new ActiveXObject("Microsoft.XMLHTTP");
			  } catch (E) {
			   xmlhttprequestcheckconf = false;
			  }
			 }
			@end @*/
			//alert ("1");
			if (!xmlhttprequestcheckconf && typeof XMLHttpRequest!='undefined')
				{
				xmlhttprequestcheckconf = new XMLHttpRequest();
				}
			if (xmlhttprequestcheckconf) 
				{ 
				checkconf_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&client=vdc&conf_exten=" + taskconfnum + "&auto_dial_level=" + auto_dial_level + "&campagentstdisp=" + campagentstdisp;

				// + check park channel +fnatic
				//alert(Customer_Hangup_Goto_Dispo_Enable+"|"+Parked_Channel_Value);
				if(Customer_Hangup_Goto_Dispo_Enable =='Y' && Parked_Channel_Value!='')
					{
				     checkconf_query=checkconf_query+'&Parked_Channel_Value='+Parked_Channel_Value;
				    }
					
				if(dial_method=='INBOUND_MAN' && inbound_mode=='ring')
					{
					// check client phone send outbound call command from database + fnatic 
						if(grab_client_phone_command==0 && DispoSelectBoxStatus != 1){client_phone_manager('client_phone_request_dial');}
						if(client_phone_channel_check_enable)
							{
							client_phone_manager('client_phone_sip_channel_checked');
							if (client_phone_channel_check_count<=-3) //轮询三次分机通道如果都不存在就认为分机已挂断 + fnatic
								{
								//alert("坐席分机已挂断！");
								dialedcall_send_hangup();
								}
							}
					// end					
					checkconf_query=checkconf_query+'&inbound_mode=ring';
					}
				// end

				//xmlhttprequestcheckconf.open('POST', 'conf_exten_check.php'); --20101029
				xmlhttprequestcheckconf.open('POST', 'conf_exten_check.php', true); //++20101029
				xmlhttprequestcheckconf.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
				//alert(checkconf_query);
				xmlhttprequestcheckconf.send(checkconf_query); 
				xmlhttprequestcheckconf.onreadystatechange = function() 
					{ 
					//if (xmlhttprequestcheckconf.readyState == 4 && xmlhttprequestcheckconf.status == 200) --20101029
					if (xmlhttprequestcheckconf && xmlhttprequestcheckconf.readyState == 4 && xmlhttprequestcheckconf.status == 200) //++20101029
						{
						var check_conf = null;
						var LMAforce = taskforce;
						check_conf = xmlhttprequestcheckconf.responseText;
						//alert(check_conf);
						//mysql_log
						check_mysql_connect = check_conf.split("|");
						
						if(check_mysql_connect[0] == "mysql_error")
						  {
						    createText(check_mysql_connect[1],"mysql_error");
						  }
					//	alert(checkconf_query);
					//	alert(xmlhttprequestcheckconf.responseText);
					//document.getElementById("debugbottomspan").innerHTML=xmlhttprequestcheckconf.responseText;
						var check_ALL_array=check_conf.split("\n");
						var check_time_array=check_ALL_array[0].split("|");
						var Time_array = check_time_array[1].split("UnixTime: ");
						 UnixTime = Time_array[1];
						 UnixTime = parseInt(UnixTime);
						 UnixTimeMS = (UnixTime * 1000);
						t.setTime(UnixTimeMS);
						if ( (callholdstatus == '1') || (agentcallsstatus == '1') || (vicidial_agent_disable != 'NOT_ACTIVE') )
						{
							var Alogin_array = check_time_array[2].split("Logged-in: ");
							var AGLogiN = Alogin_array[1];
							var CamPCalLs_array = check_time_array[3].split("CampCalls: ");
							var CamPCalLs = CamPCalLs_array[1];
							var agent_status_array = check_time_array[4].split("Status: ");
							var agent_status = agent_status_array[1];
							var DiaLCalLs_array = check_time_array[5].split("DiaLCalls: ");
							var DiaLCalLs = DiaLCalLs_array[1];
							var limitleads_array = check_time_array[21].split("Limitleads: ");
							var limitleads = limitleads_array[1];
							var list_lead_total_array = check_time_array[22].split("List_lead_total: ");
							var list_lead_total = list_lead_total_array[1];
							var unused_leads_total_array = check_time_array[23].split("Unused_leads_total: ");
							var unused_leads_total = unused_leads_total_array[1];
							var dial_method_array = check_time_array[24].split("Dial_method: ");
							var dial_method = dial_method_array[1];
							//alert(agent_status);
							if(limitleads > 0 && list_lead_total > 0)
							{
								alert("当前Lead即将外呼完毕,请联系管理员导入New Lead");
							}
							if(unused_leads_total <= 0 && (agent_status == 'CLOSER' || agent_status == 'READY') && dial_method == 'RATIO')
							{
								alert("当前没有可拨打的Lead，请稍后再置为可用");
								AutoDial_ReSume_PauSe('VDADpause');
							}
							
							if (AGLogiN != 'N')
								{
								document.getElementById("AgentStatusStatus").innerHTML = AGLogiN; //cn bug
								}
							if (CamPCalLs != 'N')
								{
								if(CamPCalLs.indexOf("ppc.gif")>0){
									var Ring_info_array = CamPCalLs.split("---");
									CamPCalLs = Ring_info_array[0];
									if(Ring_Uniqueid_old!=Ring_info_array[1]){
										Ring_Uniqueid_old = Ring_info_array[1];
										ring_redirect_to_page(Ring_info_array[1]);
									}
								}
								if(CamPCalLs.indexOf("SIP")>0){
									document.getElementById("AgentStatusCalls").innerHTML = CamPCalLs.substr(0,CamPCalLs.indexOf("SIP")); //cn bug
								}else{
									document.getElementById("AgentStatusCalls").innerHTML = CamPCalLs;
								}
								if(CamPCalLs.indexOf("QueueWarning.gif")>0 && agent_available_reset_check==1){
									var DiaLControl_html = document.getElementById("DiaLControl").innerHTML;
									if(DiaLControl_html.indexOf("vdc_LB_resume_OFF_cn.gif")>0){
										
									}else{	
										AutoDial_ReSume_PauSe('VDADready');
										agent_available_reset_check = 0;
									}
								}
								// web pay music when incoming + fnatic
                                if(CamPCalLs.length>3 && Xfer_Waiting_Web_Play_Music_Enable=='Y')
									{
								      Queue_Music_Alert_Count++;
									  if(Queue_Music_Alert_Count>0 && Queue_Music_Alert_Count<2)
										{
									     document.getElementById('snd').src=Incoming_Web_Play_Music_Filename;
										}
									   if(Queue_Music_Alert_Count==3) //轮询三次就重新播一次
										   {
										  //alert(Queue_Music_Alert_Count);
										   document.getElementById('snd').src="";
										   Queue_Music_Alert_Count=0;
										   }
									}

								else if(CamPCalLs.indexOf("IAX2")>0 && Xfer_Target_Unavailable_Remind_Enable=='Y')
									{
									 Xfer_Target_Unavailable_Remind_Enable_Count++;
									 if(Xfer_Target_Unavailable_Remind_Enable_Count == 1)
										 {
										 window.focus();//光标聚焦窗口
										 alert('有内部转接电话接入！');
										 //Xfer_Target_Unavailable_Remind_Enable_Count = 0;
										 }								
									}
								
								else
									{
									Xfer_Target_Unavailable_Remind_Enable_Count = 0 ;
									}
								// end
								}
							if (DiaLCalLs != 'N')
								{
								document.getElementById("AgentStatusDiaLs").innerHTML = DiaLCalLs; //cn bug
								}
							if ( (AGLogiN == 'DEAD_VLA') && ( (vicidial_agent_disable == 'LIVE_AGENT') || (vicidial_agent_disable == 'ALL') ) )
								{
								showDiv('AgenTDisablEBoX');
								}
							if ( (AGLogiN == 'DEAD_EXTERNAL') && ( (vicidial_agent_disable == 'EXTERNAL') || (vicidial_agent_disable == 'ALL') ) )
								{
								showDiv('AgenTDisablEBoX');
								}
							if ( (AGLogiN == 'TIME_SYNC') && (vicidial_agent_disable == 'ALL') )
								{
								showDiv('SysteMDisablEBoX');
								}
							if (AGLogiN == 'SHIFT_LOGOUT')
								{
								shift_logout_flag=1;
								}
							}
						var VLAStatuS_array = check_time_array[4].split("Status: ");
						var VLAStatuS = VLAStatuS_array[1];
						//PausENotifYCounTer=11;
						//alert(VLAStatuS+"|"+AutoDialWaiting);
						if ( (VLAStatuS == 'PAUSED') && (AutoDialWaiting == 1) )
							{
							if (PausENotifYCounTer > 10)
								{
								if(dial_method=='INBOUND_MAN' && inbound_mode=='ring')
									{
									var Phone_status_array = check_time_array[20].split("Comments: ");
									var Phone_status = Phone_status_array[1];
									if(Phone_status_array[1]=="DISCONNECT_PHONE")
										{
									//	if(PhoneNotifYCounTer>10)
									//		{
											alert("派call失败，请检查分机SIP/66669是否处于摘机状态，你的会话被暂停！");
											AutoDial_ReSume_PauSe('VDADpause');
											PausENotifYCounTer=0;
									//		PhoneNotifYCounTer=0;
									//		}
									//	else
									//		{
									//		PhoneNotifYCounTer++;
									//		}
										}
									else
										{
										alert('你的会话已被暂停！');
										AutoDial_ReSume_PauSe('VDADpause');
										PausENotifYCounTer=0;
										}
									}
								else
									{
									alert(newpausecode);
							        alert('你的会话已被暂停！');
									AutoDial_ReSume_PauSe('VDADpause');
									PausENotifYCounTer=0;
									}
								}
							else {PausENotifYCounTer++;}
							}
						else {PausENotifYCounTer=0;}
						
						var API_array = check_time_array[6].split("APIHanguP: ");
						var API = API_array[1];
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



						if (api_timer_action.length > 2)
							{
							timer_action = api_timer_action;
							timer_action_message = api_timer_action_message;
							timer_action_seconds = api_timer_action_seconds;
							}

						if ( (API==1) && (VD_live_customer_call==1) )
							{
							hideDiv('CustomerGoneBox');
							WaitingForNextStep=0;
							custchannellive=0;
							dialedcall_send_hangup();
							}
						if ( (APIStatuS.length < 10) && (APIStatuS.length > 0) && (AgentDispoing > 0) )
							{
							document.getElementById("DispoSelection").value = APIStatuS;
							DispoSelect_submit2();
							}
						if (APIPausE.length > 4)
							{
							var APIPausE_array = APIPausE.split("!");
							if (APIPausE_ID == APIPausE_array[1])
								{
							//	alert("PAUSE ALREADY RECEIVED");
								}
							else
								{
								APIPausE_ID = APIPausE_array[1];
								if (APIPausE_array[0]=='PAUSE')
									{
									if (VD_live_customer_call==1)
										{
										// set to pause on next dispo
										document.getElementById("DispoSelectStop").checked=true;
									//	alert("Setting dispo to PAUSE");
										}
									else
										{
										if (AutoDialReady==1)
											{
											if (auto_dial_level != '0')
												{
												AutoDialWaiting = 0;
												AutoDial_ReSume_PauSe("VDADpause");
												}
											VICIDiaL_pause_calling = 1;
											}
										}
									}
								if ( (APIPausE_array[0]=='RESUME') && (AutoDialReady < 1) && (auto_dial_level > 0) )
									{
									AutoDialWaiting = 1;
									AutoDial_ReSume_PauSe("VDADready");
									}
								}
							}
						if (APIDiaL.length > 9)
							{
							var APIDiaL_array_detail = APIDiaL.split("!");
							if (APIDiaL_ID == APIDiaL_array_detail[6])
								{
								//alert("DiaL ALREADY RECEIVED: " + APIDiaL_ID + "|" + APIDiaL_array_detail[5]);
								}
							else
								{
                                APIDiaL_ID = APIDiaL_array_detail[6];
								//Mod by fnaitc 
								//document.vicidial_form.MDDiaLCodE.value = APIDiaL_array_detail[1];
								document.getElementById('MDDiaLCodE').value = APIDiaL_array_detail[1];
								document.vicidial_form.phone_code.value = APIDiaL_array_detail[1];
								//document.vicidial_form.MDPhonENumbeR.value = APIDiaL_array_detail[0];
								document.getElementById('MDPhonENumbeR').value = APIDiaL_array_detail[0];
								document.getElementById('MDDiaLCodE').value = APIDiaL_array_detail[0];
								document.vicidial_form.vendor_lead_code.value = APIDiaL_array_detail[5];
								prefix_choice = APIDiaL_array_detail[7];
								active_group_alias = APIDiaL_array_detail[8];
								cid_choice = APIDiaL_array_detail[9];
								vtiger_callback_id = APIDiaL_array_detail[10];

							//	alert(APIDiaL_array_detail[1] + "-----" + APIDiaL + "-----" + document.vicidial_form.MDDiaLCodE.value + "-----" + document.vicidial_form.phone_code.value);
								if (APIDiaL_array_detail[2] == 'YES')  // lookup lead in system
									{document.getElementById('LeadLookuP').checked=true;}
								else
									{document.getElementById('LeadLookuP').checked=false;}

								if (APIDiaL_array_detail[4] == 'YES')  // focus on vicidial agent screen
									{
										window.focus();   
										//alert("Placing call to:" + APIDiaL_array_detail[1] + " " + APIDiaL_array_detail[0]);
									}
								
								if (APIDiaL_array_detail[3] == 'YES')  // call preview
									{NeWManuaLDiaLCalLSubmiT('PREVIEW');}
								else
									{NeWManuaLDiaLCalLSubmiT('NOW');}
								}
							}
				//		if ( (CheckDEADcall > 0) && (VD_live_customer_call==1) )
				//		alert(CheckDEADcall + "--" + VD_live_customer_call + "------" + check_ALL_array[2]);
				        if ( ((CheckDEADcall > 0) && (VD_live_customer_call==1)) || (check_ALL_array[2]=='PARKED CHANNEL NOT FOUND'))		{
							
							Parked_Channel_Value='';
							if (CheckDEADcallON < 1)
								{

								if( document.images ) { 
									document.images['livecall'].src = image_livecall_DEAD.src;
									// hangup agent client phone if campaign is inbound mode + fantic 
									if(dial_method=='INBOUND_MAN' && inbound_mode=='ring'){	client_phone_manager('client_phone_hangup');}
									
									//if(LIVE_campaign_recording == 'ALLFORCE' || LIVE_campaign_recording == 'ALLCALLS')
										//{
										//alert(session_id+'|'+document.getElementById("RecorDingFilename_input").value)
										//conf_send_recording( 'StopMonitorConf',session_id, document.getElementById("RecorDingFilename_input").value );
										//document.getElementById("RecorDingFilename_input").value='';
										//}
									// End111
									//yanson@20101018 start
									if(Customer_Hangup_Goto_Dispo_Enable == 'Y')
									  {								
									   dialedcall_send_hangup();
									  }
									//yanson@20101018 end
								}
								CheckDEADcallON=1;
								}
							}
						if (InGroupChange > 0)
							{
							var external_blended = InGroupChangeBlend;
							var external_igb_set_user = InGroupChangeUser;
							external_igb_set_name = InGroupChangeName;
							manager_ingroups_set=1;

							if ( (external_blended == '1') && (dial_method != 'INBOUND_MAN') )
								{VICIDiaL_closer_blended = '1';}

							if (external_blended == '0')
								{VICIDiaL_closer_blended = '0';}
							}


// ZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZ  above section working on API functions
						var check_conf_array=check_ALL_array[1].split("|");
						var live_conf_calls = check_conf_array[0];
						var conf_chan_array = check_conf_array[1].split(" ~");
					//	document.getElementById("debugbottomspan").innerHTML=check_ALL_array[1];
						
						//转接开始时更新数据 by akin
						if(conf_chan_array[2]){
							if(conf_chan_array[2].match(/^IAX2\/ASTloop/i)){
								Xfer_Target_Unavailable_Update_Enable_Count++;
								if(Xfer_Target_Unavailable_Update_Enable_Count == 1){check_xfre_update("start");}
							}
						}
						else{Xfer_Target_Unavailable_Update_Enable_Count = 0;}
						//end

						if ( (conf_channels_xtra_display == 1) || (conf_channels_xtra_display == 0) )
							{
							if (live_conf_calls > 0)
								{
								var loop_ct=0;
								var ARY_ct=0;
								var LMAalter=0;
								var LMAcontent_change=0;
								var LMAcontent_match=0;
								agentphonelive=0;
								var conv_start=-1;
								var live_conf_HTML = "<TABLE border=0 cellspacing=1 cellpadding=1 width=100%><TR BGCOLOR='#CCCCCC'><TD>#</TD><TD>远程通道</TD><TD>挂断</TD><TD>音量</TD></TR>";
								if ( (LMAcount > live_conf_calls)  || (LMAcount < live_conf_calls) || (LMAforce > 0))
									{
									LMAe[0]=''; LMAe[1]=''; LMAe[2]=''; LMAe[3]=''; LMAe[4]=''; LMAe[5]=''; 
									LMAcount=0;   LMAcontent_change++;
									}
									
								var channelfieldA_array = Array();
								while (loop_ct < live_conf_calls)
									{
									loop_ct++;
									loop_s = loop_ct.toString();
									if (loop_s.match(/1$|3$|5$|7$|9$/)) 
										{var row_color = '#E7E7E7';}
									else
										{var row_color = '#FFFFFF';}
									var conv_ct = (loop_ct + conv_start);
									var channelfieldA = conf_chan_array[conv_ct];
									var regXFcred = new RegExp(flag_string,"g");
									var regRNnolink = new RegExp('Local/5' + taskconfnum,"g")
									if ( (channelfieldA.match(regXFcred)) && (flag_channels>0) )
										{
										var chan_name_color = 'log_text_red';
										}
									else
										{
										var chan_name_color = 'log_text';
										}
									if ( (HidEMonitoRSessionS==1) && (channelfieldA.match(/ASTblind/)) )
										{
										var hide_channel=1;
										}
									else
										{
										if (channelfieldA.match(regRNnolink))
											{
											// do not show hangup or volume control links for recording channels
											live_conf_HTML = live_conf_HTML + "<tr bgcolor=\"" + row_color + "\"><td><font class=\"log_text\">" + loop_ct + "</td><td><font class=\"" + chan_name_color + "\">" + channelfieldA + "</td><td><font class=\"log_text\">recording</td><td></td></tr>";
											}
										else
											{
											if (volumecontrol_active!=1)
												{
												live_conf_HTML = live_conf_HTML + "<tr bgcolor=\"" + row_color + "\"><td><font class=\"log_text\">" + loop_ct + "</td><td><font class=\"" + chan_name_color + "\">" + channelfieldA + "</td><td><font class=\"log_text\"><a href=\"#\" onclick=\"livehangup_send_hangup('" + channelfieldA + "');return false;\">挂断</a></td><td></td></tr>";
												}
											else
												{

												live_conf_HTML = live_conf_HTML + "<tr bgcolor=\"" + row_color + "\"><td><font class=\"log_text\">" + loop_ct + "</td><td><font class=\"" + chan_name_color + "\">" + channelfieldA + "</td><td><font class=\"log_text\"><a href=\"#\" onclick=\"livehangup_send_hangup('" + channelfieldA + "');return false;\">挂断</a></td><td><a href=\"#\" onclick=\"volume_control('UP','" + channelfieldA + "','');return false;\"><IMG SRC=\"../agc/images/vdc_volume_up.gif\" BORDER=0></a> &nbsp; <a href=\"#\" onclick=\"volume_control('DOWN','" + channelfieldA + "','');return false;\"><IMG SRC=\"../agc/images/vdc_volume_down.gif\" BORDER=0></a> &nbsp; &nbsp; &nbsp; <a href=\"#\" onclick=\"volume_control('MUTING','" + channelfieldA + "','');return false;\"><IMG SRC=\"../agc/images/vdc_volume_MUTE_cn.gif\" BORDER=0></a> &nbsp; <a href=\"#\" onclick=\"volume_control('UNMUTE','" + channelfieldA + "','');return false;\"><IMG SRC=\"../agc/images/vdc_volume_UNMUTE_cn.gif\" BORDER=0></a></td></tr>";
												}
											}
										}
				//		var debugspan = document.getElementById("debugbottomspan").innerHTML;

									if (channelfieldA == lastcustchannel) {custchannellive++;}
									else
										{
										if(customerparked == 1)
											{custchannellive++;}
										// allow for no customer hungup errors if call from another server
										if(server_ip == lastcustserverip)
											{var nothing='';}
										else
											{custchannellive++;}
										}

									if (volumecontrol_active > 0)
										{
										if ( (protocol != 'EXTERNAL') && (protocol != 'Local') )
											{
											var regAGNTchan = new RegExp(protocol + '/' + extension,"g");
											if  ( (channelfieldA.match(regAGNTchan)) && (agentchannel != channelfieldA) )
												{
												agentchannel = channelfieldA;

												document.getElementById("AgentMuteSpan").innerHTML = "<a href=\"#CHAN-" + agentchannel + "\" onclick=\"volume_control('MUTING','" + agentchannel + "','AgenT');return false;\"><IMG SRC=\"../agc/images/cn/vdc_volume_MUTE_cn.gif\" BORDER=0></a>";
												}
											}
										else							
											{
											if (agentchannel.length < 3)
												{
												agentchannel = channelfieldA;

												document.getElementById("AgentMuteSpan").innerHTML = "<a href=\"#CHAN-" + agentchannel + "\" onclick=\"volume_control('MUTING','" + agentchannel + "','AgenT');return false;\"><IMG SRC=\"../agc/images/cn/vdc_volume_MUTE_cn.gif\" BORDER=0></a>";
												}
											}
							//			document.getElementById("agentchannelSPAN").innerHTML = agentchannel;
										}

				//		document.getElementById("debugbottomspan").innerHTML = debugspan + '<BR>' + channelfieldA + '|' + lastcustchannel + '|' + custchannellive + '|' + LMAcontent_change + '|' + LMAalter;

									if (!LMAe[ARY_ct]) 
										{LMAe[ARY_ct] = channelfieldA;   LMAcontent_change++;  LMAalter++;}
									else
										{
										if (LMAe[ARY_ct].length < 1) 
											{LMAe[ARY_ct] = channelfieldA;   LMAcontent_change++;  LMAalter++;}
										else
											{
											if (LMAe[ARY_ct] == channelfieldA) {LMAcontent_match++;}
											 else {LMAcontent_change++;   LMAe[ARY_ct] = channelfieldA;}
											}
										}
									if (LMAalter > 0) {LMAcount++;}
									
									if (agentchannel == channelfieldA) {agentphonelive++;}

									ARY_ct++;
									}
									
									
								refresh_Volume_hidden_data(channelfieldA_array);
		//	var debug_LMA = LMAcontent_match+"|"+LMAcontent_change+"|"+LMAcount+"|"+live_conf_calls+"|"+LMAe[0]+LMAe[1]+LMAe[2]+LMAe[3]+LMAe[4]+LMAe[5];
		//							document.getElementById("confdebug").innerHTML = debug_LMA + "<BR>";

								if (agentphonelive < 1) {agentchannel='';}

								live_conf_HTML = live_conf_HTML + "</table>";

								if (LMAcontent_change > 0)
									{
									if (conf_channels_xtra_display == 1)
										{
										 document.getElementById("outboundcallsspan").innerHTML = live_conf_HTML;
										 }
									}
								nochannelinsession=0;
								}
							else
								{
								LMAe[0]=''; LMAe[1]=''; LMAe[2]=''; LMAe[3]=''; LMAe[4]=''; LMAe[5]=''; 
								LMAcount=0;
								if (conf_channels_xtra_display == 1)
									{
									if (document.getElementById("outboundcallsspan").innerHTML.length > 2)
										{
										document.getElementById("outboundcallsspan").innerHTML = '';
										}
									}
								custchannellive = -99;
								nochannelinsession++;
								}
							}

							//++20101029
							delete xmlhttprequestcheckconf;
							//++20101029 去掉注释
							xmlhttprequestcheckconf = undefined; 
							//delete xmlhttprequestcheckconf;	--20101029					
						}
						//++20101029 start
						else if (xmlhttprequestcheckconf && xmlhttprequestcheckconf.readyState == 4 && xmlhttprequestcheckconf.status != 200) {
							// Cleanup  after AJAX Request returns error.
							// alert("Status: " + xmlhttprequestcheckconf.status);
							delete xmlhttprequestcheckconf;
							xmlhttprequestcheckconf = undefined;
						}
					}
				}
			}
		else {
			if (xmlhttprequestcheckconf) {
				xmlhttprequestcheckconf_wait++;
				if (xmlhttprequestcheckconf_wait >= 3) {
					// Abort AJAX Request, due to timeout.
					// The handler must take care of cleanup.
					// alert("xmlhttprequestcheckconf: Abort (Wait > 3 sec)");
					xmlhttprequestcheckconf.abort();
					//++20101029 end
					}
				}
				//++20101029 start
				if (xmlhttprequestcheckconf_wait >= 5) {
					// In case the handler function fails to do cleanup, cleanup manually.
					xmlhttprequestcheckconf_wait = 0;
					delete xmlhttprequestcheckconf;
					xmlhttprequestcheckconf = undefined;
				}
			else {
				xmlhttprequestcheckconf = undefined;
				}
				//++20101029 end
			}
		}

// ################################################################################
// Send MonitorConf/StopMonitorConf command for recording of conferences
	function conf_send_recording(taskconfrectype,taskconfrec,taskconffile) 
		{
		if (inOUT == 'OUT')
			{
			tmp_vicidial_id = document.vicidial_form.uniqueid.value;
			}
		else
			{
			tmp_vicidial_id = 'IN';
			}
		var xmlhttp=false;
		/*@cc_on @*/
		/*@if (@_jscript_version >= 5)
		// JScript gives us Conditional compilation, we can cope with old IE versions.
		// and security blocked creation of the objects.
		 try {
		  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		 } catch (e) {
		  try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  } catch (E) {
		   xmlhttp = false;
		  }
		 }
		@end @*/
		if (!xmlhttp && typeof XMLHttpRequest!='undefined')
			{
			xmlhttp = new XMLHttpRequest();
			}
		if (xmlhttp) 
			{ 
			if (taskconfrectype == 'MonitorConf')
				{
				// 	var campaign_recording = 'ALLCALLS';
				//	var campaign_rec_filename = 'FULLDATE_CUSTPHONE';
				//	CAMPAIGN CUSTPHONE FULLDATE TINYDATE EPOCH AGENT
				var REGrecCAMPAIGN = new RegExp("CAMPAIGN","g");
				var REGrecCUSTPHONE = new RegExp("CUSTPHONE","g");
				var REGrecFULLDATE = new RegExp("FULLDATE","g");
				var REGrecTINYDATE = new RegExp("TINYDATE","g");
				var REGrecEPOCH = new RegExp("EPOCH","g");
				var REGrecAGENT = new RegExp("AGENT","g");
				filename = LIVE_campaign_rec_filename;
				filename = filename.replace(REGrecCAMPAIGN, campaign);
				filename = filename.replace(REGrecCUSTPHONE, lead_dial_number);
				filename = filename.replace(REGrecFULLDATE, filedate);
				filename = filename.replace(REGrecTINYDATE, tinydate);
				filename = filename.replace(REGrecEPOCH, epoch_sec);
				filename = filename.replace(REGrecAGENT, user);
			//	filename = filedate + "_" + user_abb;
				var query_recording_exten = recording_exten;
				var channelrec = "Local/" + conf_silent_prefix + '' + taskconfrec + "@" + ext_context;
				var conf_rec_start_html = "<a href=\"#\" onclick=\"conf_send_recording('StopMonitorConf','" + taskconfrec + "','" + filename + "');return false;\"><IMG SRC=\"../agc/images/vdc_LB_stoprecording_cn.gif\" border=0 alt=\"停止录音\"></a>";
				
				// 修复录音按钮隐藏时不能挂断录音通道 + fantic
			    document.getElementById("RecorDingFilename_input").value=filename;
				//document.getElementById("recording_debug").innerHTML = "录音开始..";
				// 结束

				if (LIVE_campaign_recording == 'ALLFORCE')
					{
					document.getElementById("RecorDControl").innerHTML = "<IMG SRC=\"../agc/images/vdc_LB_startrecording_OFF.gif\" border=0 alt=\"启动录音\">";					
					}
				else
					{
					document.getElementById("RecorDControl").innerHTML = conf_rec_start_html;
					}
			}
			if (taskconfrectype == 'StopMonitorConf')
				{
				filename = taskconffile;
				var query_recording_exten = session_id;
				var channelrec = "Local/" + conf_silent_prefix + '' + taskconfrec + "@" + ext_context;
				var conf_rec_start_html = "<a href=\"#\" onclick=\"conf_send_recording('MonitorConf','" + taskconfrec + "','');return false;\"><IMG SRC=\"../agc/images/vdc_LB_startrecording_cn.gif\" border=0 alt=\"启动录音\"></a>";
				if (LIVE_campaign_recording == 'ALLFORCE')
					{
					document.getElementById("RecorDControl").innerHTML = "<IMG SRC=\"../agc/images/vdc_LB_startrecording_OFF.gif\" border=0 alt=\"启动录音\">";
					}
				else
					{
					document.getElementById("RecorDControl").innerHTML = conf_rec_start_html;
					}
				}
		    // fix vicidial record bug + fantic
			confmonitor_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ACTION=" + taskconfrectype + "&format=text&channel=" + channelrec + "&filename=" + filename + "&exten=" + query_recording_exten + "&ext_context=" + ext_context + "&lead_id=" + document.vicidial_form.lead_id.value + "&ext_priority=1&FROMvdc=YES&uniqueid=" + tmp_vicidial_id + "&custphone=" + lead_dial_number + "&campaign=" + campaign;
			// end
			//alert(confmonitor_query);
			xmlhttp.open('POST', 'manager_send.php'); 
			xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
			xmlhttp.send(confmonitor_query); 
			xmlhttp.onreadystatechange = function() 
				{ 
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
					{
					var RClookResponse = null;
			//		document.getElementById("busycallsdebug").innerHTML = confmonitor_query;
			//		alert(xmlhttp.responseText);
					RClookResponse = xmlhttp.responseText;
					var RClookResponse_array=RClookResponse.split("\n");
					var RClookFILE = RClookResponse_array[1];
					var RClookID = RClookResponse_array[2];
					var RClookFILE_array = RClookFILE.split("Filename: ");
					var RClookID_array = RClookID.split("RecorDing_ID: ");
					if (RClookID_array.length > 0)
						{
						recording_filename = RClookFILE_array[1];
						recording_id = RClookID_array[1];

						if (delayed_script_load == 'YES')
							{
							RefresHScript();
							delayed_script_load='NO';
							}

						var RecDispNamE = RClookFILE_array[1];
						if (RecDispNamE.length > 25)
							{
							RecDispNamE = RecDispNamE.substr(0,22);
							RecDispNamE = RecDispNamE + '...';
							}
						 document.getElementById("RecorDingFilename").innerHTML = RecDispNamE;
						 document.getElementById("RecorDID").innerHTML = RClookID_array[1];
						}
											xmlhttp = null;
						CollectGarbage();
					}
				}
			delete xmlhttp;
			}
		}

// ################################################################################
// Send Redirect command for live call to 经理sends phone name where call is going to
// Covers the following types: XFER, VMAIL, ENTRY, CONF, 停泊, FROM停泊, XfeRLOCAL, XfeRINTERNAL, XfeRBLIND, VfeRVMAIL
	function mainxfer_send_redirect(taskvar,taskxferconf,taskserverip,taskdebugnote,taskdispowindow) 
		{
		//alert(taskvar + "---" + taskxferconf + "---" + taskserverip);
		blind_transfer=1;
		var consultativexfer_checked = 0;
		//mod by fnatic
		//if (document.vicidial_form.consultativexfer.checked==true)
		if (document.getElementById("consultativexfer").checked==true)
			{consultativexfer_checked = 1;}

	//	conf_dialed=1;
		if (auto_dial_level == 0) {RedirecTxFEr = 1;}
		var xmlhttpXF=false;
		/*@cc_on @*/
		/*@if (@_jscript_version >= 5)
		// JScript gives us Conditional compilation, we can cope with old IE versions.
		// and security blocked creation of the objects.
		 try {
		  xmlhttpXF = new ActiveXObject("Msxml2.XMLHTTP");
		 } catch (e) {
		  try {
		   xmlhttpXF = new ActiveXObject("Microsoft.XMLHTTP");
		  } catch (E) {
		   xmlhttpXF = false;
		  }
		 }
		@end @*/
		if (!xmlhttpXF && typeof XMLHttpRequest!='undefined')
			{
			xmlhttpXF = new XMLHttpRequest();
			}
		if (xmlhttpXF) 
			{ 
			var redirectvalue = MDchannel;
			var redirectserverip = lastcustserverip;
			if (redirectvalue.length < 2)
				{redirectvalue = lastcustchannel}
			if ( (taskvar == 'XfeRBLIND') || (taskvar == 'XfeRVMAIL') )
				{
				var queryCID = "XBvdcW" + epoch_sec + user_abb;
				//Mod by fnatic
				//var blindxferdialstring = document.vicidial_form.xfernumber.value;
				var blindxferdialstring = dial_prefix + document.getElementById("xfernumber").value;
				
				var regXFvars = new RegExp("XFER","g");
				if (blindxferdialstring.match(regXFvars))
					{
					var regAXFvars = new RegExp("AXFER","g");
					if (blindxferdialstring.match(regAXFvars))
						{
						var Ctasknum = blindxferdialstring.replace(regAXFvars, '');
						if (Ctasknum.length < 2)
							{Ctasknum = '83009';}
						var closerxfercamptail = '_L';
						if (closerxfercamptail.length < 3)
							{closerxfercamptail = 'IVR';}
						blindxferdialstring = Ctasknum + '*' + document.vicidial_form.phone_number.value + '*' + document.vicidial_form.lead_id.value + '*' + campaign + '*' + closerxfercamptail + '*' + user + '**' + VD_live_call_secondS + '*';
						}
					}
				else
					{//Mod by fnatic
					//if (document.vicidial_form.xferoverride.checked==false)
                    if (document.getElementById("xferoverride").checked==false)
						{
						if (three_way_dial_prefix == 'X') {var temp_dial_prefix = '';}
						else {var temp_dial_prefix = three_way_dial_prefix;}
						if (omit_phone_code == 'Y') {var temp_phone_code = '';}
						else {var temp_phone_code = document.vicidial_form.phone_code.value;}
                        //解决当帐户名长度为８位,而且转接对象为坐席时自动加前缀的bug
						if (blindxferdialstring.length > 8)
						//if (blindxferdialstring.length > 7)
							{blindxferdialstring = temp_dial_prefix + "" + temp_phone_code + "" + blindxferdialstring;}
						}
					}
				no_delete_VDAC=0;
				if (taskvar == 'XfeRVMAIL')
					{
					var blindxferdialstring = campaign_am_message_exten + '*' + campaign + '*' + document.vicidial_form.phone_code.value + '*' + document.vicidial_form.phone_number.value + '*' + document.vicidial_form.lead_id.value;
					no_delete_VDAC=1;
					}
				if (blindxferdialstring.length<'1')
					{
					xferredirect_query='';
					taskvar = 'NOTHING';
					alert("请先输入外线号码！");
					}
				else
					{
					xferredirect_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ACTION=RedirectVD&format=text&channel=" + redirectvalue + "&call_server_ip=" + redirectserverip + "&queryCID=" + queryCID + "&exten=" + blindxferdialstring + "&ext_context=" + ext_context + "&ext_priority=1&auto_dial_level=" + auto_dial_level + "&campaign=" + campaign + "&uniqueid=" + document.vicidial_form.uniqueid.value + "&lead_id=" + document.vicidial_form.lead_id.value + "&secondS=" + VD_live_call_secondS + "&session_id=" + session_id + "&nodeletevdac=" + no_delete_VDAC;
					}
				}
			if (taskvar == 'XfeRINTERNAL') 
				{
				var closerxferinternal = '';
				taskvar = 'XfeRLOCAL';
				}
			else 
				{
				var closerxferinternal = '9';
				}
			if (taskvar == 'XfeRLOCAL')
				{
				CustomerData_update();

				var XfeRSelecT = document.getElementById("XfeRGrouP");
				var queryCID = "XLvdcW" + epoch_sec + user_abb;
				// 		 "90009*$group**$lead_id**$phone_number*$user*$agent_only*";
				//Mod by fnatic
				//var redirectdestination = closerxferinternal + '90009*' + XfeRSelecT.value + '**' + document.vicidial_form.lead_id.value + '**' + dialed_number + '*' + user + '*' + document.vicidial_form.xfernumber.value + '*';
				var redirectdestination = closerxferinternal + '90009*' + XfeRSelecT.value + '**' + document.vicidial_form.lead_id.value + '**' + dialed_number + '*' + user + '*' + document.getElementById("xfernumber").value + '*';

				xferredirect_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ACTION=RedirectVD&format=text&channel=" + redirectvalue + "&call_server_ip=" + redirectserverip + "&queryCID=" + queryCID + "&exten=" + redirectdestination + "&ext_context=" + ext_context + "&ext_priority=1&auto_dial_level=" + auto_dial_level + "&campaign=" + campaign + "&uniqueid=" + document.vicidial_form.uniqueid.value + "&lead_id=" + document.vicidial_form.lead_id.value + "&secondS=" + VD_live_call_secondS + "&session_id=" + session_id;
				}
			if (taskvar == 'XfeR')
				{
				var queryCID = "LRvdcW" + epoch_sec + user_abb;
				var redirectdestination = document.vicidial_form.extension_xfer.value;
				xferredirect_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ACTION=RedirectName&format=text&channel=" + redirectvalue + "&call_server_ip=" + redirectserverip + "&queryCID=" + queryCID + "&extenName=" + redirectdestination + "&ext_context=" + ext_context + "&ext_priority=1" + "&session_id=" + session_id;
				}
			if (taskvar == 'VMAIL')
				{
				var queryCID = "LVvdcW" + epoch_sec + user_abb;
				var redirectdestination = document.vicidial_form.extension_xfer.value;
				xferredirect_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ACTION=RedirectNameVmail&format=text&channel=" + redirectvalue + "&call_server_ip=" + redirectserverip + "&queryCID=" + queryCID + "&exten=" + voicemail_dump_exten + "&extenName=" + redirectdestination + "&ext_context=" + ext_context + "&ext_priority=1" + "&session_id=" + session_id;
				}
			if (taskvar == 'ENTRY')
				{
				var queryCID = "LEvdcW" + epoch_sec + user_abb;
				var redirectdestination = document.vicidial_form.extension_xfer_entry.value;
				xferredirect_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ACTION=Redirect&format=text&channel=" + redirectvalue + "&call_server_ip=" + redirectserverip + "&queryCID=" + queryCID + "&exten=" + redirectdestination + "&ext_context=" + ext_context + "&ext_priority=1" + "&session_id=" + session_id;
				}
			if (taskvar == '3WAY')
				{
				xferredirect_query='';

				var queryCID = "VXvdcW" + epoch_sec + user_abb;
				var redirectdestination = "NEXTAVAILABLE";
				var redirectXTRAvalue = XDchannel;
				//Mod by fnatic 
				//var redirecttype_test = document.vicidial_form.xfernumber.value;
				var redirecttype_test = document.getElementById("xfernumber").value;
				var XfeRSelecT = document.getElementById("XfeRGrouP");
				var regRXFvars = new RegExp("CXFER","g");
				if ( ( (redirecttype_test.match(regRXFvars)) || (consultativexfer_checked > 0) ) && (local_consult_xfers > 0) )
					{var redirecttype = 'RedirectXtraCXNeW';}
				else
					{var redirecttype = 'RedirectXtraNeW';}
				DispO3waychannel = redirectvalue;
				DispO3wayXtrAchannel = redirectXTRAvalue;
				DispO3wayCalLserverip = redirectserverip;
				//Mod by fnatic 
				//DispO3wayCalLxfernumber = document.vicidial_form.xfernumber.value;
				DispO3wayCalLxfernumber = document.getElementById("xfernumber").value;
				DispO3wayCalLcamptail = '';

				xferredirect_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ACTION=" + redirecttype + "&format=text&channel=" + redirectvalue + "&call_server_ip=" + redirectserverip + "&queryCID=" + queryCID + "&exten=" + redirectdestination + "&ext_context=" + ext_context + "&ext_priority=1&extrachannel=" + redirectXTRAvalue + "&lead_id=" + document.vicidial_form.lead_id.value + "&phone_code=" + document.vicidial_form.phone_code.value + "&phone_number=" + document.vicidial_form.phone_number.value + "&filename=" + taskdebugnote + "&campaign=" + XfeRSelecT.value + "&session_id=" + session_id + "&agentchannel=" + agentchannel + "&protocol=" + protocol + "&extension=" + extension + "&auto_dial_level=" + auto_dial_level;
                //alert(xferredirect_query);
				if (taskdebugnote == 'FIRST') 
					{
					document.getElementById("DispoSelectHAspan").innerHTML = "<a href=\"#\" onclick=\"DispoLeavE3wayAgaiN()\">Leave 3Way Call Again</a>";
					}
				}
			if (taskvar == 'ParK')
				{
				if (CalLCID.length < 1)
					{
					CalLCID = MDnextCID;
					}
				blind_transfer=0;
				var queryCID = "LPvdcW" + epoch_sec + user_abb;
				var redirectdestination = taskxferconf;

				//Mod by fnatic start :global parked channel value 
				if(Customer_Hangup_Goto_Dispo_Enable == 'Y' && taskxferconf.substr(0,5)!='Local')
					{ 
					Parked_Channel_Value = taskxferconf;
					}
				//alert(Parked_Channel_Value);
				//Mod by fnatic end

				var redirectdestserverip = taskserverip;
				var parkedby = protocol + "/" + extension;
				xferredirect_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ACTION=RedirectToPark&format=text&channel=" + redirectdestination + "&call_server_ip=" + redirectdestserverip + "&queryCID=" + queryCID + "&exten=" + park_on_extension + "&ext_context=" + ext_context + "&ext_priority=1&extenName=park&parkedby=" + parkedby + "&session_id=" + session_id + "&CalLCID=" + CalLCID;
                //alert(taskvar+"|"+taskxferconf+"|"+taskserverip);
				//alert(xferredirect_query);
                //alert(redirectdestination+" || "+redirectdestserverip);
				ParkControlCount = 1;
				ParkControlredirectdestserverip = redirectdestserverip;
				ParkControlredirectdestination = redirectdestination;
				document.getElementById("ParkControl").innerHTML = "<IMG SRC=\"../agc/images/cn/vdc_LB_parkcall_OFF_cn.gif\" border=0 alt=\"保持电话\">";
				
				//当按了"保持电话"时，转接按钮不可用
				if (VU_vicidial_transfers == '1'){
					document.getElementById("XferControl").innerHTML = "<IMG SRC=\"../agc/images/cn/vdc_LB_transferconf_OFF_cn.gif\" border=0 alt=\"转接\">";
				}
				//hideDiv('TransferMain');
				//$("#TransferMainDIV").dialog("close");
				customerparked=1;
				}
			if (taskvar == 'FROMParK')
				{
				if(AutoDialWaiting == 2){
					alert("提取电话正在通话中！");
					return;
				}
				blind_transfer=0;
				var queryCID = "FPvdcW" + epoch_sec + user_abb;
				var redirectdestination = taskxferconf;
				var redirectdestserverip = taskserverip;

				if( (server_ip == taskserverip) && (taskserverip.length > 6) )
					{var dest_dialstring = session_id;}
				else
					{
					if(taskserverip.length > 6)
						{var dest_dialstring = server_ip_dialstring + "" + session_id;}
					else
						{var dest_dialstring = session_id;}
					}

				xferredirect_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ACTION=RedirectFromPark&format=text&channel=" + redirectdestination + "&call_server_ip=" + redirectdestserverip + "&queryCID=" + queryCID + "&exten=" + dest_dialstring + "&ext_context=" + ext_context + "&ext_priority=1" + "&session_id=" + session_id;
				//alert(xferredirect_query);
				
				document.getElementById("ParkControl").innerHTML ="<a href=\"#\" onclick=\"mainxfer_send_redirect('ParK','" + redirectdestination + "','" + redirectdestserverip + "');return false;\"><IMG SRC=\"../agc/images/cn/vdc_LB_parkcall_cn.gif\" border=0 alt=\"保持电话\"></a>";
				//转接按钮可以用
				if (VU_vicidial_transfers == '1'){
					document.getElementById("XferControl").innerHTML = "<a href=\"#\" onclick=\"ShoWTransferMain('ON');\"><IMG SRC=\"../agc/images/cn/vdc_LB_transferconf_cn.gif\" border=0 alt=\"转接 - 电话会议\"></a>";
				}
				customerparked=0;
				}

			var XFRDop = '';
			xmlhttpXF.open('POST', 'manager_send.php'); 
			xmlhttpXF.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
			//alert(xferredirect_query);
			xmlhttpXF.send(xferredirect_query); 
			xmlhttpXF.onreadystatechange = function() 
				{ 
				if (xmlhttpXF.readyState == 4 && xmlhttpXF.status == 200) 
					{

					var XfeRRedirecToutput = null;
					XfeRRedirecToutput = xmlhttpXF.responseText;
					var XfeRRedirecToutput_array=XfeRRedirecToutput.split("|");
					//alert(XfeRRedirecToutput_array[0]);

					var XFRDop = XfeRRedirecToutput_array[0];
					if (XFRDop == "NeWSessioN")
						{
						threeway_end=1;
						document.vicidial_form.callchannel.value = '';
						document.vicidial_form.callserverip.value = '';
					
						dialedcall_send_hangup();

						//Mod by fnatic document.vicidial_form.xferchannel.value = '';
                        document.getElementById("xferchannel").value = '';
						xfercall_send_hangup();

						session_id = XfeRRedirecToutput_array[1];
						document.getElementById("sessionIDspan").innerHTML = session_id;

				//		alert("session_id changed to: " + session_id);
	                    //Add by fantic use to destory TransferMainDIV when leave 3 way start
		               // $("#TransferMainDIV").dialog("close");
                        //Add by fantic use to destory TransferMainDIV when leave 3 way end  
						}
				//	alert(xferredirect_query + "\n" + xmlhttpXF.responseText);
				//	document.getElementById("debugbottomspan").innerHTML = xferredirect_query + "\n" + xmlhttpXF.responseText;
					}
				}
			delete xmlhttpXF;
			}

			// used to send second Redirect for manual dial calls
			if ( (auto_dial_level == 0) && (taskvar != '3WAY') )
			{
				RedirecTxFEr = 1;
				var xmlhttpXF2=false;
				/*@cc_on @*/
				/*@if (@_jscript_version >= 5)
				// JScript gives us Conditional compilation, we can cope with old IE versions.
				// and security blocked creation of the objects.
				 try {
				  xmlhttpXF2 = new ActiveXObject("Msxml2.XMLHTTP");
				 } catch (e) {
				  try {
				   xmlhttpXF2 = new ActiveXObject("Microsoft.XMLHTTP");
				  } catch (E) {
				   xmlhttpXF2 = false;
				  }
				 }
				@end @*/
				if (!xmlhttpXF2 && typeof XMLHttpRequest!='undefined')
				{
					xmlhttpXF2 = new XMLHttpRequest();
				}
				if (xmlhttpXF2) 
				{ 
					xmlhttpXF2.open('POST', 'manager_send.php'); 
					xmlhttpXF2.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
					xmlhttpXF2.send(xferredirect_query + "&stage=2NDXfeR"); 
					xmlhttpXF2.onreadystatechange = function() 
						{ 
						if (xmlhttpXF2.readyState == 4 && xmlhttpXF2.status == 200) 
							{
							Nactiveext = null;
							Nactiveext = xmlhttpXF2.responseText;
					//		alert(RedirecTxFEr + "|" + xmlhttpXF2.responseText);
						}
				}
				delete xmlhttpXF2;
				}
			}

		if ( (taskvar == 'XfeRLOCAL') || (taskvar == 'XfeRBLIND') || (taskvar == 'XfeRVMAIL') )
			{
			if (auto_dial_level == 0) {RedirecTxFEr = 1;}
			document.vicidial_form.callchannel.value = '';
			document.vicidial_form.callserverip.value = '';
			if( document.images ) { document.images['livecall'].src = image_livecall_OFF.src;}
		//	alert(RedirecTxFEr + "|" + auto_dial_level);
			dialedcall_send_hangup(taskdispowindow,'','',no_delete_VDAC);

	    //Add by fantic use to destory TransferMainDIV when leave 3 way start
		 // $("#TransferMainDIV").dialog("close");
        //Add by fantic use to destory TransferMainDIV when leave 3 way end  

			}
				
		}

// ################################################################################
// Finish the alternate dialing and move on to disposition the call
	function ManualDialAltDonE()
		{
		alt_phone_dialing=starting_alt_phone_dialing;
		alt_dial_active = 0;
		alt_dial_status_display = 0;
		open_dispo_screen=1;
		document.getElementById("MainStatuSSpan").innerHTML = "<font style=\"font-family:'宋体';font-size:12px;\">拨下一个号码</font>";
		}
// ################################################################################
// Insert or update the vicidial_log entry for a customer call
	function DialLog(taskMDstage,nodeletevdac)
		{
		var alt_num_status = 0;
		if (taskMDstage == "start") 
			{
			var MDlogEPOCH = 0;
			var UID_test = document.vicidial_form.uniqueid.value;
			if (UID_test.length < 4)
				{
				UID_test = epoch_sec + '.' + random;
				document.vicidial_form.uniqueid.value = UID_test;
				}
			}
		else
			{
			// 修改vicidial_log.length_in_sec为talktime秒数 + fnatic
			var out_length_in_sec = 0 ;
			if (document.vicidial_form.SecondS.value!=0)
			{
				out_length_in_sec = document.vicidial_form.SecondS.value;
			//	alert(out_length_in_sec);
			}			
			// 结束
			if (alt_phone_dialing == 1)
				{
				if (document.vicidial_form.DiaLAltPhonE.checked==true)
					{
					alt_num_status = 1;
					reselect_alt_dial = 1;
					alt_dial_active = 1;
					alt_dial_status_display = 1;
					var man_status = "<font style=\"font-family:'宋体';font-size:12px;\">拨打其它电话号码: <a href=\"#\" onclick=\"ManualDialOnly('MaiNPhonE')\">主要电话</a> 或者 <a href=\"#\" onclick=\"ManualDialOnly('ALTPhonE')\">其它电话</a> 或者 <a href=\"#\" onclick=\"ManualDialOnly('AddresS3')\">地址3</a> 或者 <a href=\"#\" onclick=\"ManualDialAltDonE()\">结束纪录</a></font>"; 
					document.getElementById("MainStatuSSpan").innerHTML = man_status;
					}
				}
			}
		var xmlhttp=false;
		/*@cc_on @*/
		/*@if (@_jscript_version >= 5)
		// JScript gives us Conditional compilation, we can cope with old IE versions.
		// and security blocked creation of the objects.
		 try {
		  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		 } catch (e) {
		  try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  } catch (E) {
		   xmlhttp = false;
		  }
		 }
		@end @*/
		if (!xmlhttp && typeof XMLHttpRequest!='undefined')
			{
			xmlhttp = new XMLHttpRequest();
			}
		if (xmlhttp) 
			{
			manDiaLlog_query = "format=text&server_ip=" + server_ip + "&session_name=" + session_name + "&status_type=" + status_type + "&ACTION=manDiaLlogCaLL&stage=" + taskMDstage + "&uniqueid=" + document.vicidial_form.uniqueid.value + 
			"&user=" + user + "&pass=" + pass + "&campaign=" + campaign + 
			"&lead_id=" + document.vicidial_form.lead_id.value + 
			"&list_id=" + document.vicidial_form.list_id.value + 
			"&length_in_sec=0&phone_code=" + document.vicidial_form.phone_code.value + 
			"&phone_number=" + lead_dial_number + 
			"&exten=" + extension + "&channel=" + lastcustchannel + "&start_epoch=" + MDlogEPOCH + "&auto_dial_level=" + auto_dial_level + "&VDstop_rec_after_each_call=" + VDstop_rec_after_each_call + "&conf_silent_prefix=" + conf_silent_prefix + "&protocol=" + protocol + "&extension=" + extension + "&ext_context=" + ext_context + "&conf_exten=" + session_id + "&user_abb=" + user_abb + "&agent_log_id=" + agent_log_id + "&MDnextCID=" + LasTCID + "&inOUT=" + inOUT + "&alt_dial=" + dialed_label + "&DB=0" + "&agentchannel=" + agentchannel + "&conf_dialed=" + conf_dialed + "&leaving_threeway=" + leaving_threeway + "&hangup_all_non_reserved=" + hangup_all_non_reserved + "&blind_transfer=" + blind_transfer + "&dial_method" + dial_method + "&nodeletevdac=" + nodeletevdac + "&alt_num_status=" + alt_num_status + "&out_length_in_sec=" + out_length_in_sec;
			xmlhttp.open('POST', 'vdc_db_query.php'); 
			xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
		//		document.getElementById("busycallsdebug").innerHTML = "vdc_db_query.php?" + manDiaLlog_query;
			xmlhttp.send(manDiaLlog_query); 
			xmlhttp.onreadystatechange = function() 
				{ 
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
					{
					var MDlogResponse = null;
			//		alert(xmlhttp.responseText);
					MDlogResponse = xmlhttp.responseText;
					var MDlogResponse_array=MDlogResponse.split("\n");
					MDlogLINE = MDlogResponse_array[0];
					if ( (MDlogLINE == "LOG NOT ENTERED") && (VDstop_rec_after_each_call != 1) ) //cn bug
						{
				//		alert("error: log not entered\n");
						}
					else
						{
						MDlogEPOCH = MDlogResponse_array[1];
				//		alert("CCMS Call log entered:\n" + document.vicidial_form.uniqueid.value);
						if ( (taskMDstage != "start") && (VDstop_rec_after_each_call == 1) )
							{
							var conf_rec_start_html = "<a href=\"#\" onclick=\"conf_send_recording('MonitorConf','" + session_id + "','');return false;\"><IMG SRC=\"../agc/images/vdc_LB_startrecording_cn.gif\" border=0 alt=\"启动录音\"></a>";
							if ( (LIVE_campaign_recording == 'NEVER') || (LIVE_campaign_recording == 'ALLFORCE') )
								{
								document.getElementById("RecorDControl").innerHTML = "<IMG SRC=\"../agc/images/vdc_LB_startrecording_OFF.gif\" border=0 alt=\"启动录音\">";
								}
							else
								{document.getElementById("RecorDControl").innerHTML = conf_rec_start_html;}
							
							MDlogRecorDings = MDlogResponse_array[3];
							if (window.MDlogRecorDings)
								{
								var MDlogRecorDings_array=MDlogRecorDings.split("|");
								recording_filename = MDlogRecorDings_array[2];
								recording_id = MDlogRecorDings_array[3];

								var RecDispNamE = MDlogRecorDings_array[2];
								if (RecDispNamE.length > 25)
									{
									RecDispNamE = RecDispNamE.substr(0,22);
									RecDispNamE = RecDispNamE + '...';
									}
								document.getElementById("RecorDingFilename").innerHTML = RecDispNamE;
								document.getElementById("RecorDID").innerHTML = MDlogRecorDings_array[3];
								}
							}
						}
						xmlhttp = null;
						CollectGarbage();
					}
				}
			delete xmlhttp;
			}
		RedirecTxFEr=0;
		conf_dialed=0;
		}


// ################################################################################
// Request number of dialable leads left in this campaign
	function DiaLableLeaDsCounT()
		{
		var xmlhttp=false;
		/*@cc_on @*/
		/*@if (@_jscript_version >= 5)
		// JScript gives us Conditional compilation, we can cope with old IE versions.
		// and security blocked creation of the objects.
		 try {
		  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		 } catch (e) {
		  try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  } catch (E) {
		   xmlhttp = false;
		  }
		 }
		@end @*/
		if (!xmlhttp && typeof XMLHttpRequest!='undefined')
			{
			xmlhttp = new XMLHttpRequest();
			}
		if (xmlhttp) 
			{ 
			DLcount_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ACTION=DiaLableLeaDsCounT&campaign=" + campaign + "&format=text";
			xmlhttp.open('POST', 'vdc_db_query.php'); 
			xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
			xmlhttp.send(DLcount_query); 
			xmlhttp.onreadystatechange = function() 
				{ 
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
					{
				//	alert(xmlhttp.responseText);
					var DLcounT = xmlhttp.responseText;
						document.getElementById("dialableleadsspan").innerHTML ="Dialable Leads:<BR> " + DLcounT;
												xmlhttp = null;
						CollectGarbage();
					}
				}
			delete xmlhttp;
			}
		}


// ################################################################################
// Request number of USERONLY callbacks for this agent
	function CalLBacKsCounTCheck()
		{
		var xmlhttp=false;
		/*@cc_on @*/
		/*@if (@_jscript_version >= 5)
		// JScript gives us Conditional compilation, we can cope with old IE versions.
		// and security blocked creation of the objects.
		 try {
		  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		 } catch (e) {
		  try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  } catch (E) {
		   xmlhttp = false;
		  }
		 }
		@end @*/
		if (!xmlhttp && typeof XMLHttpRequest!='undefined')
			{
			xmlhttp = new XMLHttpRequest();
			}
		if (xmlhttp) 
			{ 
			CBcount_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ACTION=CalLBacKCounT&campaign=" + campaign + "&format=text";
			xmlhttp.open('POST', 'vdc_db_query.php');
			xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
			xmlhttp.send(CBcount_query); 
			xmlhttp.onreadystatechange = function() 
				{ 
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
					{
				//	alert(xmlhttp.responseText);
					var CBcounT = xmlhttp.responseText;
					if (CBcounT == 0) {var CBprint = "";}
					else {var CBprint = "["+CBcounT+"]";}
						document.getElementById("CBstatusSpan").innerHTML ="<a href=\"#\" onclick=\"CalLBacKsLisTCheck();return false;\">个人回拨提示" + CBprint + "</a>";
						
					xmlhttp = null;
					CollectGarbage();
					}
				}
			delete xmlhttp;
			}
		}


// ################################################################################
// Request list of USERONLY callbacks for this agent
	function CalLBacKsLisTCheck()
		{
		if ( (AutoDialWaiting == 1) || (VD_live_customer_call==1) || (alt_dial_active==1) || (MD_channel_look==1) )
			{
			alert("您必须暂停才可以查看个人回拨提示！");
			}
		else
			{
			showDiv('CallBacKsLisTBox');
 		    $('#CallBacKsLisTBoxDIV').dialog
				({
                     autoOpen:false,
                     draggable:false,
                     resizable:false,
                     title:'个人回拨提示',
                     height:450,
                     width:950,
                     modal:true,
					 close:function()
				     {
					   hideDiv('CallBacKsLisTBox');
					 }
		         });
			$('#CallBacKsLisTBoxDIV').dialog('open');
			var xmlhttp=false;
			/*@cc_on @*/
			/*@if (@_jscript_version >= 5)
			// JScript gives us Conditional compilation, we can cope with old IE versions.
			// and security blocked creation of the objects.
			 try {
			  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
			 } catch (e) {
			  try {
			   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			  } catch (E) {
			   xmlhttp = false;
			  }
			 }
			@end @*/
			if (!xmlhttp && typeof XMLHttpRequest!='undefined')
				{
				xmlhttp = new XMLHttpRequest();
				}
			if (xmlhttp) 
				{ 
				var CBlist_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ACTION=CalLBacKLisT&campaign=" + campaign + "&format=text";
				xmlhttp.open('POST', 'vdc_db_query.php'); 
				xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
				xmlhttp.send(CBlist_query); 
				xmlhttp.onreadystatechange = function() 
					{ 
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
						{
					//	alert(xmlhttp.responseText);
						var all_CBs = null;
						all_CBs = xmlhttp.responseText;
						//alert(all_CBs);
						var all_CBs_array=all_CBs.split("\n");
						var CB_calls = all_CBs_array[0];
						var loop_ct=0;
						var conv_start=0;
						var CB_HTML = "<table width=100% border=0 cellspacing=1 cellpadding=1><tr bgcolor='#CCCCCC'><td>#</td><td>回拨时间</td><td>电话号码</td><td>话务员状态</td><td>CAMPAIGN</td><td>最后通话时间</td><td>备注</td></tr>"
						while (loop_ct < CB_calls)
							{
							loop_ct++;
							loop_s = loop_ct.toString();
							if (loop_s.match(/1$|3$|5$|7$|9$/)) 
								{var row_color = '#E7E7E7';}
							else
								{var row_color = '#FFFFFF';}
							var conv_ct = (loop_ct + conv_start);
							var call_array = all_CBs_array[conv_ct].split(" ~");
							var CB_name = call_array[0] + " " + call_array[1];
							var CB_phone = call_array[2];
							var CB_id = call_array[3];
							var CB_lead_id = call_array[4];
							var CB_campaign = call_array[5];
							var CB_status = call_array[6];
							if (CB_status == 'LIVE')
								{
									CB_status = "已过回拨时间";
								}
							else if(CB_status == 'ACTIVE')
								{
									CB_status = "未到回拨时间";
								}
							var CB_lastcall_time = call_array[7];
							var CB_callback_time = call_array[8];
							var CB_comments = call_array[9];
							CB_HTML = CB_HTML + "<tr bgcolor=\"" + row_color + "\"><td>" + loop_ct + "</td><td>" + CB_callback_time + "</td><td><a href=\"#\" onclick=\"new_callback_call_vtiger_search('" + CB_id + "','" + CB_lead_id + "', '"+CB_phone+"');return false;\">" + CB_phone + "</a></td><td>" + CB_status + "</td><td>" + CB_campaign + "</td><td>" + CB_lastcall_time + "&nbsp;</td><td>" + CB_comments + "</td></tr>";
					
							}
						CB_HTML = CB_HTML + "</table>";
						document.getElementById("CallBacKsLisT").innerHTML = CB_HTML;
						xmlhttp = null;
						CollectGarbage();
						}
					}
				delete xmlhttp;
				}
			}
		}


// ################################################################################
// Open up a callback customer record as manual dial preview mode
	function new_callback_call(taskCBid,taskLEADid)
		{
	//	alt_phone_dialing=1;
		auto_dial_level=0;
		manual_dial_in_progress=1;
		MainPanelToFront();
		
		buildDiv('DiaLLeaDPrevieW');
		if (alt_phone_dialing == 1)
			{buildDiv('DiaLDiaLAltPhonE');}
		document.vicidial_form.LeadPreview.checked=true;
	//	document.vicidial_form.DiaLAltPhonE.checked=true;
		hideDiv('CallBacKsLisTBox');
        $('#CallBacKsLisTBoxDIV').dialog('close');
		ManualDialNext(taskCBid,taskLEADid,'','','','0');
		}
// ################################################################################
// Add by Fnatic 用于向vtiger_search.php传递号码去查询vtigerCRM该号码的详细资料 
	function new_callback_call_vtiger_search(taskCBid,taskLEADid,taskPhoneNumber)
		{
	//	alert("111");
		if(DispoSelectBoxStatus == 1){
            alert("请先提交电话小结！");
            return false;
        } 
    // 	alert("222");   
	//	alt_phone_dialing=1;
		auto_dial_level=0;
		manual_dial_in_progress=1;
		MainPanelToFront();
		
		buildDiv('DiaLLeaDPrevieW');
		if (alt_phone_dialing == 1)
			{buildDiv('DiaLDiaLAltPhonE');}
		document.vicidial_form.LeadPreview.checked=true;
	//	document.vicidial_form.DiaLAltPhonE.checked=true;
		hideDiv('CallBacKsLisTBox');
        $('#CallBacKsLisTBoxDIV').dialog('close');
		ManualDialNext(taskCBid,taskLEADid,'','','','0');
		   alert("VtigeRLogiNScripT:"+VtigeRLogiNScripT+" VtigeREnableD:"+VtigeREnableD);   
	    if ( (VtigeRLogiNScripT == 'Y') && (VtigeREnableD > 0) )
			{
			
		//	alert("444");   
	//		var sss = "http://172.17.1.90/ccms/CallCenter/index_vici.php?action=CrmSearch?iocheck=in&user="+user+"&campaign="+campaign+"&phone="+taskPhoneNumber+"\"";
		//	alert(sss);
			var d_h=$(document).outerHeight()-64;
			var d_w=$(document).outerWidth()-170;
			
			$("#ScriptPanel").css({"height":d_h+"px","width":d_w+"px"});
			
			
			document.getElementById("ScriptContents").innerHTML = "<iframe onload=\"SetCwinHeight(this)\"  src=\"http://172.17.1.90/ccms/CallCenter/index_vici.php?action=CrmSearch&iocheck=in&user="+user+"&campaign="+campaign+"&phone="+taskPhoneNumber+"\" style=\"background-color:transparent;\" scrolling=\"auto\" frameborder=\"0\" allowtransparency=\"true\" id=\"popupFrame\" name=\"popupFrame\" width='"+d_w+"' height=\"" + d_h + "\" STYLE=\"z-index:17\"></iframe>";
			console.log($(document).outerHeight()+"-"+$(document).outerWidth())
			console.log("<iframe onload=\"SetCwinHeight(this)\"  src=\"http://172.17.1.90/ccms/CallCenter/index_vici.php?action=CrmSearch&iocheck=in&user="+user+"&campaign="+campaign+"&phone="+taskPhoneNumber+"\" style=\"background-color:transparent;\" scrolling=\"auto\" frameborder=\"0\" allowtransparency=\"true\" id=\"popupFrame\" name=\"popupFrame\" width='"+d_w+"' height=\"" + d_h + "\" STYLE=\"z-index:17\"></iframe>")
			}
		}


// ################################################################################
// Finish Callback and go back to original screen
	function manual_dial_finished()
		{
		alt_phone_dialing=starting_alt_phone_dialing;
		auto_dial_level=starting_dial_level;
		MainPanelToFront();
		CalLBacKsCounTCheck();
		manual_dial_in_progress=0;
		}


// ################################################################################
// Open page to enter details for a new manual dial lead
	function NeWManuaLDiaLCalL(TVfast)
		{
		/*
		if ( (AutoDialWaiting == 1) || (VD_live_customer_call==1) || (alt_dial_active==1) || (MD_channel_look==1) )
			{
			alert("在暂停状态下才可外拨！");
			}
		else
			{
		*/
			if (TVfast=='FAST')
				{
				NeWManuaLDiaLCalLSubmiTfast();
				}
			else
				{
				if (agent_allow_group_alias == 'Y')
					{
					document.getElementById("ManuaLDiaLGrouPSelecteD").innerHTML = "<font size=2 face=\"Arial,Helvetica\">技能组代名: " + active_group_alias + "</font>";
					document.getElementById("ManuaLDiaLGrouP").innerHTML = "<a href=\"#\" onclick=\"GroupAliasSelectContent_create('0');\"><font size=1 face=\"Arial,Helvetica\">点及此处选择技能组代名</font></a>";
					}
				showDiv('NeWManuaLDiaLBox');
                //Add by fnatic start
		        $("#ManualDialDIV").dialog
				({ draggable: false,
				   resizable:false ,
				   width:300,
			       height:'auto',
			       modal: true,
			       title:"手动外拨号码"
		        });
		       $("#ManualDialDIV").dialog('open');
			   if(MDLookuPLeaD=="new"){document.getElementById('LeadLookuP').checked=false;}
			   if(MDLookuPLeaD=="lookup"){document.getElementById('LeadLookuP').checked=true;}
			   if(MDLookuPLeaD_display=="none"){
					document.getElementById('LeadLookuP_area').style.display="none";
			   }
               //Add by fnatic end
				}
				
			//}
		}


	function InternalDialByAgentClick(phone){
		$('#AgentViewSpanDIV').dialog('close');
		document.getElementById('manudial_dial_type').checked = true;
		document.getElementById('MDPhonENumbeR').value = phone;
		NeWManuaLDiaLCalLSubmiT('NOW');
	}
// ################################################################################
// Insert the new manual dial as a lead and go to manual dial screen
	function NeWManuaLDiaLCalLSubmiT(tempDiaLnow)
		{
		if(DispoSelectBoxStatus == 1){
			alert("请先提交电话小结！");
			return false;
		}
		//要agent挂断电话后才可以打电话
		var status_temp = document.getElementById("HangupControl").innerHTML;
		
		if(status_temp.indexOf("vdc_LB_hangupcustomer_cn.gif")>0){
			alert("请先挂断电话！");
			return false;
		}
		if(CheckOutboundChannelLine2 == 1){
			outbound_redirect_line2("8301");
		}
		//判断外拨类型,如果为内部分机互打则号码前加93走 93XXXX DialPlan + fnatic
		//修改为用复选框来判断内线和外线  20110726 + fnatic
		var dial_submit_result = false ;
		var manudial_dial_type = 'external'; // + 

		if (document.getElementById('manudial_dial_type').checked) // // + 
		{
			manudial_dial_type = 'internal';  // + 
		}
		else // + 
		{// + 
			manudial_dial_type = 'external';// + 
		}// + 

		//dial_submit_result = dial_submit(document.getElementById('MDPhonENumbeR').value,manudial_dial_type); // + 
		var phone_temp = document.getElementById('MDPhonENumbeR').value;
		
		var re = /^[0-9|*|#]*$/;
		if (!re.test(phone_temp) || phone_temp.length > 16){
			alert("号码必须为数字且长度小于16！");
			document.getElementById('MDPhonENumbeR').value = "";
			return false;
		}
		
		phone_temp = phone_temp.replace(/^\s*/,"").replace(/\s*$/,"");
		var MDPhonENumbeRform = phone_temp;
		if(manudial_dial_type == "internal"){
			document.getElementById('MDPhonENumbeR').value = "9399909*" + phone_temp + "*in*" + extension;
			MDPhonENumbeRform = document.getElementById('MDPhonENumbeR').value;
		}
		
		hideDiv('NeWManuaLDiaLBox');
		if (parent.AutoDialReady == 1) 
		{
		if(confirm("目前为可用状态，请在暂停状态下进行外拨，点击确定切换到暂停状态并外拨，如不需要点击取消"))
		{
		AutoDial_PauSe_Default('Dial','VDADpause');
		if ( (parent.AutoDialWaiting == 1) || (parent.VD_live_customer_call==1) || (parent.alt_dial_active==1) || (parent.MD_channel_look==1) )
		{
				//alert("自动暂停");
				AutoDialReSumeStatus = 1;
		}
		//Del by fnatic document.getElementById("debugbottomspan").innerHTML = "TESTING NOW HERE" + document.vicidial_form.MDPhonENumbeR.value + "|" + active_group_alias;
		// ring the agent client phone if campaign is ring mode + fnatic 
		if(dial_method=='INBOUND_MAN' && inbound_mode=='ring' && grab_client_phone_command==0)	
			{
			client_phone_manager('client_phone_ring');
			}
		// end
		$('#ManualDialDIV').dialog("close");
		var sending_group_alias = 0;
	    
	    var MDDiaLCodEform = document.getElementById('MDDiaLCodE').value;
     	
		var MDDiaLOverridEform = document.getElementById('MDDiaLOverridE').value;

		var MDVendorLeadCode = document.vicidial_form.vendor_lead_code.value;

	    if (document.getElementById('LeadLookuP').checked==true)
			{MDLookuPLeaD = 'lookup';}
		else
			{MDLookuPLeaD = 'new';}

		if (MDDiaLCodEform.length < 1)
			{MDDiaLCodEform = document.vicidial_form.phone_code.value;}

		if (MDDiaLOverridEform.length > 0)
			{
			agent_dialed_number=1;
			agent_dialed_type='MANUAL_OVERRIDE';
			basic_originate_call(session_id,'NO','YES',MDDiaLOverridEform,'YES','','1','0');
			}
		else
			{
			auto_dial_level=0;
			manual_dial_in_progress=1;
			agent_dialed_number=1;
			MainPanelToFront();

			if (tempDiaLnow == 'PREVIEW')
				{
			//	alt_phone_dialing=1;
				agent_dialed_type='MANUAL_PREVIEW';
				buildDiv('DiaLLeaDPrevieW');
				if (alt_phone_dialing == 1)
					{buildDiv('DiaLDiaLAltPhonE');}
				document.vicidial_form.LeadPreview.checked=true;
			//	document.vicidial_form.DiaLAltPhonE.checked=true;
				}
			else
				{
				agent_dialed_type='MANUAL_DIALNOW';
				document.vicidial_form.LeadPreview.checked=false;
				document.vicidial_form.DiaLAltPhonE.checked=false;
				}
			if (active_group_alias.length > 1)
				{var sending_group_alias = 1;}
			try{
			document.getElementById("PauseCodeLinkSpan").style.display="none";
			}catch(err){
				
			}
			ManualDialNext("","",MDDiaLCodEform,MDPhonENumbeRform,MDLookuPLeaD,MDVendorLeadCode,sending_group_alias);
			}
        //Mod by fnatic
		//document.vicidial_form.MDPhonENumbeR.value = '';
		//document.vicidial_form.MDDiaLOverridE.value = '';
		document.getElementById('MDPhonENumbeR').value = '';
		document.getElementById('MDDiaLOverridE').value = '';
		}
		$('#ManualDialDIV').dialog("close");
		exit;
		}
				AutoDial_PauSe_Default('Dial','VDADpause');
		if ( (parent.AutoDialWaiting == 1) || (parent.VD_live_customer_call==1) || (parent.alt_dial_active==1) || (parent.MD_channel_look==1) )
		{
				//alert("自动暂停");
				AutoDialReSumeStatus = 1;
		}
		//Del by fnatic document.getElementById("debugbottomspan").innerHTML = "TESTING NOW HERE" + document.vicidial_form.MDPhonENumbeR.value + "|" + active_group_alias;
		// ring the agent client phone if campaign is ring mode + fnatic 
		if(dial_method=='INBOUND_MAN' && inbound_mode=='ring' && grab_client_phone_command==0)	
			{
			client_phone_manager('client_phone_ring');
			}
		// end
		$('#ManualDialDIV').dialog("close");
		
		var sending_group_alias = 0;
	    
	    var MDDiaLCodEform = document.getElementById('MDDiaLCodE').value;
     	
		var MDDiaLOverridEform = document.getElementById('MDDiaLOverridE').value;

		var MDVendorLeadCode = document.vicidial_form.vendor_lead_code.value;

	    if (document.getElementById('LeadLookuP').checked==true)
			{MDLookuPLeaD = 'lookup';}
		else
			{MDLookuPLeaD = 'new';}

		if (MDDiaLCodEform.length < 1)
			{MDDiaLCodEform = document.vicidial_form.phone_code.value;}

		if (MDDiaLOverridEform.length > 0)
			{
			agent_dialed_number=1;
			agent_dialed_type='MANUAL_OVERRIDE';
			basic_originate_call(session_id,'NO','YES',MDDiaLOverridEform,'YES','','1','0');
			}
		else
			{
			auto_dial_level=0;
			manual_dial_in_progress=1;
			agent_dialed_number=1;
			MainPanelToFront();

			if (tempDiaLnow == 'PREVIEW')
				{
			//	alt_phone_dialing=1;
				agent_dialed_type='MANUAL_PREVIEW';
				buildDiv('DiaLLeaDPrevieW');
				if (alt_phone_dialing == 1)
					{buildDiv('DiaLDiaLAltPhonE');}
				document.vicidial_form.LeadPreview.checked=true;
			//	document.vicidial_form.DiaLAltPhonE.checked=true;
				}
			else
				{
				agent_dialed_type='MANUAL_DIALNOW';
				document.vicidial_form.LeadPreview.checked=false;
				document.vicidial_form.DiaLAltPhonE.checked=false;
				}
			if (active_group_alias.length > 1)
				{var sending_group_alias = 1;}
			try{
			document.getElementById("PauseCodeLinkSpan").style.display="none";
			}catch(err){
				
			}
			ManualDialNext("","",MDDiaLCodEform,MDPhonENumbeRform,MDLookuPLeaD,MDVendorLeadCode,sending_group_alias);
			}
        //Mod by fnatic
		//document.vicidial_form.MDPhonENumbeR.value = '';
		//document.vicidial_form.MDDiaLOverridE.value = '';
		document.getElementById('MDPhonENumbeR').value = '';
		document.getElementById('MDDiaLOverridE').value = '';
		}

// ################################################################################
// Fast version of manual dial
		function NeWManuaLDiaLCalLSubmiTfast()
		{
		var MDDiaLCodEform = document.vicidial_form.phone_code.value;
		var MDPhonENumbeRform = document.vicidial_form.phone_number.value;
		var MDVendorLeadCode = document.vicidial_form.vendor_lead_code.value;

		if ( (MDDiaLCodEform.length < 1) || (MDPhonENumbeRform.length < 5) )
			{
			alert("您必须输入电话号码和区号以使用快速拨号！");
			}
		else
			{
			
			if (document.vicidial_form.LeadLookuP.checked==true)
				{MDLookuPLeaD = 'lookup';}
			else
				{MDLookuPLeaD = 'new';}
		
			agent_dialed_number=1;
			agent_dialed_type='MANUAL_DIALFAST';
		//	alt_phone_dialing=1;
			auto_dial_level=0;
			manual_dial_in_progress=1;
			MainPanelToFront();
			buildDiv('DiaLLeaDPrevieW');
			if (alt_phone_dialing == 1)
				{buildDiv('DiaLDiaLAltPhonE');}
			document.vicidial_form.LeadPreview.checked=false;
		//	document.vicidial_form.DiaLAltPhonE.checked=true;
			ManualDialNext("","",MDDiaLCodEform,MDPhonENumbeRform,MDLookuPLeaD,MDVendorLeadCode,'0');
			}
		}

// ################################################################################
// Request lookup of manual dial channel
	function ManualDialCheckChanneL(taskCheckOR)
		{
		if (taskCheckOR == 'YES')
			{
			var CIDcheck = XDnextCID;
			}
		else
			{
			var CIDcheck = MDnextCID;
			}
		var xmlhttp=false;
		/*@cc_on @*/
		/*@if (@_jscript_version >= 5)
		// JScript gives us Conditional compilation, we can cope with old IE versions.
		// and security blocked creation of the objects.
		 try {
		  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		 } catch (e) {
		  try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  } catch (E) {
		   xmlhttp = false;
		  }
		 }
		@end @*/
		if (!xmlhttp && typeof XMLHttpRequest!='undefined')
			{
			xmlhttp = new XMLHttpRequest();
			}
		if (xmlhttp) 
			{ 
			manDiaLlook_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=manDiaLlookCaLL&conf_exten=" + session_id + "&user=" + user + "&pass=" + pass + "&MDnextCID=" + CIDcheck + "&agent_log_id=" + agent_log_id + "&lead_id=" + document.vicidial_form.lead_id.value + "&DiaL_SecondS=" + MD_ring_secondS;
			//alert(manDiaLlook_query);
			xmlhttp.open('POST', 'vdc_db_query.php'); 
			xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
			xmlhttp.send(manDiaLlook_query); 
			xmlhttp.onreadystatechange = function() 
				{ 
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
					{
					var MDlookResponse = null;
				//	alert(xmlhttp.responseText);
					MDlookResponse = xmlhttp.responseText;
					var MDlookResponse_array=MDlookResponse.split("\n");
					var MDlookCID = MDlookResponse_array[0];
					var regMDL = new RegExp("^Local","ig");

					//alert(MDlookCID); 
					if (MDlookCID == "NO")
						{
						MD_ring_secondS++;
						var dispnum = lead_dial_number;

						var status_display_number = phone_number_format(dispnum);

						if (alt_dial_status_display=='0')
							{
					//		alert(document.getElementById("MainStatuSSpan").innerHTML);
							//document.getElementById("MainStatuSSpan").innerHTML = "<font style=\"font-family:'宋体';font-size:12px;\">拨号中: " + status_display_number + " UID: " + CIDcheck + " &nbsp; 进入闲置状态... " + MD_ring_secondS + " 秒<font style=\"font-family:'宋体';font-size:12px;\">";
							document.getElementById("MainStatuSSpan").innerHTML = "<font style=\"font-family:'宋体';font-size:12px;\">拨号中: " + status_display_number + " UID: " + MDnextCID + " &nbsp; 进入闲置状态..." + "</font>";
					//		alert("channel not found yet:\n" + campaign);
							}
						}
					else
						{
						if (taskCheckOR == 'YES')
							{
							XDuniqueid = MDlookResponse_array[0];
							XDchannel = MDlookResponse_array[1];
							var XDalert = MDlookResponse_array[2];
							
							if (XDalert == 'ERROR')
								{
								var XDerrorDesc = MDlookResponse_array[3];
								var DiaLAlerTMessagE = "Call Rejected: " + XDchannel + "\n" + XDerrorDesc;
								TimerActionRun("DiaLAlerT",DiaLAlerTMessagE);
								}
							if ( (XDchannel.match(regMDL)) && (asterisk_version != '1.0.8') && (asterisk_version != '1.0.9') && (MD_ring_secondS < 10) )
								{
								// bad grab of Local channel, try again
								MD_ring_secondS++;
								}
							else
								{

								document.getElementById("xferuniqueid").value	= MDlookResponse_array[0];
								document.getElementById("xferchannel").value   = MDlookResponse_array[1];
								lastxferchannel = MDlookResponse_array[1];
								document.getElementById("xferlength").value		= 0;
                                
								XD_live_customer_call = 1;
								XD_live_call_secondS = 0;
								MD_channel_look=0;

								document.getElementById("MainStatuSSpan").innerHTML = " <font style=\"font-family:'宋体';font-size:12px;\">拨给第三方: " + document.getElementById("xfernumber").value + " UID: " + CIDcheck+"</font>";
                                document.getElementById("MainStatuSSpan").innerHTML = " <font style=\"font-family:'宋体';font-size:12px;\">拨给第三方: " + document.getElementById("xfernumber").value + " UID: " + CIDcheck + "</font>";


								if(Xfer_Dial_With_Customer_Display=='Y')
									{
								document.getElementById("DialWithCustomer").innerHTML ="<IMG SRC=\"../agc/images/cn/vdc_XB_dialwithcustomer_OFF_cn.gif\" border=0 alt=\"不挂断拨号\" style=\"vertical-align:middle\">";
									}
                                //Mod by fnatic end
								document.getElementById("ParkCustomerDial").innerHTML ="<IMG SRC=\"../agc/images/cn/vdc_XB_parkcustomerdial_OFF_cn.gif\" border=0 alt=\"保持客户拨号\" style=\"vertical-align:middle\">";

								xferchannellive=1;
								XDcheck = '';
								}
							}
						else
							{
							MDuniqueid = MDlookResponse_array[0];
							MDchannel = MDlookResponse_array[1];
							var MDalert = MDlookResponse_array[2];
							
							if (MDalert == 'ERROR')
								{
								var MDerrorDesc = MDlookResponse_array[3];
								//Mod by fnatic start
								//var DiaLAlerTMessagE = "Call Rejected: " + MDchannel + "\n" + MDerrorDesc;
                                var DiaLAlerTMessagE = "<center><br/><br/><b>客户无法接通!</b></center>";
								//Mod by fnatic end
								TimerActionRun("DiaLAlerT",DiaLAlerTMessagE);
								}
							if ( (MDchannel.match(regMDL)) && (asterisk_version != '1.0.8') && (asterisk_version != '1.0.9') )
								{
								// bad grab of Local channel, try again
								MD_ring_secondS++;
								}
							else
								{
								custchannellive=1;

								document.vicidial_form.uniqueid.value		= MDlookResponse_array[0];
								last_uniqueid = MDlookResponse_array[0];
								document.vicidial_form.callchannel.value	= MDlookResponse_array[1];
								lastcustchannel = MDlookResponse_array[1];
								
                                //Modified by Kelvin Begin
								if (Manual_Ring_Launch=='SCRIPT') 
								{
								if (delayed_script_load == 'YES')
									{
									load_script_contents();
									}
									//alert(1);
								ScriptPanelToFront();
								}
								//Modified by Kelvin End
								document.getElementById("status_code").innerHTML="通话";
								if(Pause_Code_Selected_Link_Display=='Y' && (agent_pause_codes_active=='FORCE' || agent_pause_codes_active=="Y")){
									document.getElementById("PauseCodeLinkSpan").style.display="none";
								}
								if( document.images ) { document.images['livecall'].src = image_livecall_ON.src;}
								status_type = 1;
								document.vicidial_form.SecondS.value		= 0;
								document.getElementById("SecondSDISP").innerHTML = '0';
                               // alert(XD_live_customer_call);  answered call 
							    //ccms_006_called = 1;
								VD_live_customer_call = 1;
								VD_live_call_secondS = 0;

								MD_channel_look=0;
								var dispnum = lead_dial_number;
								var status_display_number = phone_number_format(dispnum);

							    document.getElementById("MainStatuSSpan").innerHTML = "<font style=\"font-family:'宋体';font-size:12px;\">已拨号: " + status_display_number + " UID: " + CIDcheck + " </font>";

								if(CheckOutboundChannelLine2 == 0){
									document.getElementById("out_line12").innerHTML = "<input type='text' size=\"15\" maxlength=\"20\" name=\"tel_out_line2\" id=\"tel_out_line2\" value=\"\" ><input type='button' onClick=\"outbound_dial_line2();return false;\" value=\"拨号\" />";
								}
								
								document.getElementById("ParkControl").innerHTML ="<a href=\"#\" onclick=\"mainxfer_send_redirect('ParK','" + lastcustchannel + "','" + lastcustserverip + "');return false;\"><IMG SRC=\"../agc/images/cn/vdc_LB_parkcall_cn.gif\" border=0 alt=\"保持电话\"></a>";
								document.getElementById("HangupControl").innerHTML = "<a href=\"#\" onclick=\"dialedcall_send_hangup();\"><IMG SRC=\"../agc/images/cn/vdc_LB_hangupcustomer_cn.gif\" border=0 alt=\"挂断\"></a>";

								if (VU_vicidial_transfers == '1'){
									document.getElementById("XferControl").innerHTML = "<a href=\"#\" onclick=\"ShoWTransferMain('ON');\"><IMG SRC=\"../agc/images/cn/vdc_LB_transferconf_cn.gif\" border=0 alt=\"转接 - 电话会议\"></a>";
                                }
								//Mod by fnatic start
								if(Xfer_Local_Closer_Display=='Y')
									{
								document.getElementById("LocalCloser").innerHTML = "<a href=\"#\" onclick=\"mainxfer_send_redirect('XfeRLOCAL','" + lastcustchannel + "','" + lastcustserverip + "');return false;\"><IMG SRC=\"../agc/images/vdc_XB_localcloser_cn.gif\" border=0 alt=\"转本地技能组\" style=\"vertical-align:middle\"></a>";
								    }
								if(Xfer_Blind_Display=='Y')
									{
								//document.getElementById("DialBlindTransfer").innerHTML = "<a href=\"#\" onclick=\"mainxfer_send_redirect('XfeRBLIND','" + lastcustchannel + "','" + lastcustserverip + "');return false;\"><IMG SRC=\"../agc/images/vdc_XB_blindtransfer_cn.gif\" border=0 alt=\"盲转\" style=\"vertical-align:middle\"></a>";
								//TransferMain@20110104 start
								document.getElementById("DialBlindTransfer").innerHTML = "<IMG SRC=\"../agc/images/cn/vdc_XB_blindtransfer_OFF_cn.gif\" border=0 alt=\"盲转\" style=\"vertical-align:middle\">";
								//TransferMain@20110104 end
								    }
								
                                if(Xfer_Answer_Machine_Message_Display=='Y')
									{
								document.getElementById("DialBlindVMail").innerHTML = "<a href=\"#\" onclick=\"mainxfer_send_redirect('XfeRVMAIL','" + lastcustchannel + "','" + lastcustserverip + "');return false;\"><IMG SRC=\"../agc/images/vdc_XB_ammessage_cn.gif\" border=0 alt=\"VM\" style=\"vertical-align:middle\"></a>";
								    }
								//Mod by fnatic end
								document.getElementById("VolumeUpSpan").innerHTML = "<a href=\"#\" onclick=\"volume_control('UP','" + MDchannel + "','');return false;\"><IMG SRC=\"../agc/images/vdc_volume_up.gif\" BORDER=0></a>";
								document.getElementById("VolumeDownSpan").innerHTML = "<a href=\"#\" onclick=\"volume_control('DOWN','" + MDchannel + "','');return false;\"><IMG SRC=\"../agc/images/vdc_volume_down.gif\" BORDER=0></a>";

								if (quick_transfer_button == 'IN_GROUP')
									{
									document.getElementById("QuickXfer").innerHTML = "<a href=\"#\" onclick=\"mainxfer_send_redirect('XfeRLOCAL','" + lastcustchannel + "','" + lastcustserverip + "');return false;\"><IMG SRC=\"../agc/images/vdc_LB_quickxfer_cn.gif\" border=0 alt=\"快速传递\"></a>";
									}
								if (prepopulate_transfer_preset_enabled > 0)
									{
									if (prepopulate_transfer_preset == 'PRESET_1')
										{
										//Mod by fnatic
										//document.vicidial_form.xfernumber.value = CalL_XC_a_NuMber;
										document.getElementById("xfernumber").value = CalL_XC_a_NuMber;
										}
									if (prepopulate_transfer_preset == 'PRESET_2')
										{
										//Mod by fnatic
										//document.vicidial_form.xfernumber.value = CalL_XC_b_NuMber;
										document.getElementById("xfernumber").value = CalL_XC_b_NuMber;
										}
									if (prepopulate_transfer_preset == 'PRESET_3')
										{
										//Mod by fnatic
										//document.vicidial_form.xfernumber.value = CalL_XC_c_NuMber;
										document.getElementById("xfernumber").value = CalL_XC_c_NuMber;
										}
									if (prepopulate_transfer_preset == 'PRESET_4')
										{
										//Mod by fnatic
										//document.vicidial_form.xfernumber.value = CalL_XC_d_NuMber;
										document.getElementById("xfernumber").value = CalL_XC_d_NuMber;
										}
									if (prepopulate_transfer_preset == 'PRESET_5')
										{
										//Mod by fnatic 
										//document.vicidial_form.xfernumber.value = CalL_XC_e_NuMber;}
										document.getElementById("xfernumber").value = CalL_XC_e_NuMber;
										}
									}
								if ( (quick_transfer_button == 'PRESET_1') || (quick_transfer_button == 'PRESET_2') || (quick_transfer_button == 'PRESET_3') || (quick_transfer_button == 'PRESET_4') || (quick_transfer_button == 'PRESET_5') )
									{
									document.getElementById("QuickXfer").innerHTML = "<a href=\"#\" onclick=\"mainxfer_send_redirect('XfeRBLIND','" + lastcustchannel + "','" + lastcustserverip + "');return false;\"><IMG SRC=\"../agc/images/vdc_LB_quickxfer_cn.gif\" border=0 alt=\"快速传递\"></a>";

									if (quick_transfer_button == 'PRESET_1')
										{
										//Mod by fnatic
										//document.vicidial_form.xfernumber.value = CalL_XC_a_NuMber;
										document.getElementById("xfernumber").value = CalL_XC_a_NuMber;
										}
									if (quick_transfer_button == 'PRESET_2')
										{
										//Mod by fnatic
										//document.vicidial_form.xfernumber.value = CalL_XC_b_NuMber;
										document.getElementById("xfernumber").value = CalL_XC_b_NuMber;
										}
									if (quick_transfer_button == 'PRESET_3')
										{
										//Mod by fnatic
										//document.vicidial_form.xfernumber.value = CalL_XC_c_NuMber;
										document.getElementById("xfernumber").value = CalL_XC_c_NuMber;
										}
									if (quick_transfer_button == 'PRESET_4')
										{
										//Mod by fnatic
										//document.vicidial_form.xfernumber.value = CalL_XC_d_NuMber;
										document.getElementById("xfernumber").value = CalL_XC_d_NuMber;
										}
									if (quick_transfer_button == 'PRESET_5')
										{
										//Mod by fnatic 
										//document.vicidial_form.xfernumber.value = CalL_XC_e_NuMber;
										document.getElementById("xfernumber").value = CalL_XC_e_NuMber;
										}
									}

								if (call_requeue_button > 0)
									{
									var CloserSelectChoices = document.vicidial_form.CloserSelectList.value;
									var regCRB = new RegExp("AGENTDIRECT","ig");
									if ( (CloserSelectChoices.match(regCRB)) || (VU_closer_campaigns.match(regCRB)) )
										{
										document.getElementById("ReQueueCall").innerHTML =  "<a href=\"#\" onclick=\"call_requeue_launch();return false;\"><IMG SRC=\"../agc/images/vdc_LB_requeue_call.gif\" border=0 alt=\"Re-Queue Call\"></a>";
										}
									else
										{
										document.getElementById("ReQueueCall").innerHTML =  "<IMG SRC=\"../agc/images/vdc_LB_requeue_call_OFF.gif\" border=0 alt=\"Re-Queue Call\">";
										}
									}

								// Build transfer pull-down list
								var loop_ct = 0;
								var live_XfeR_HTML = '';
								var XfeR_SelecT = '';
								while (loop_ct < XFgroupCOUNT)
									{
									if (VARxfergroups[loop_ct] == LIVE_default_xfer_group)
										{XfeR_SelecT = 'selected ';}
									else {XfeR_SelecT = '';}
									live_XfeR_HTML = live_XfeR_HTML + "<option " + XfeR_SelecT + "value=\"" + VARxfergroups[loop_ct] + "\">" + VARxfergroups[loop_ct] + " - " + VARxfergroupsnames[loop_ct] + "</option>\n";
									loop_ct++;
									}
								document.getElementById("XfeRGrouPLisT").innerHTML = "<select size=1 name=XfeRGrouP id=XfeRGrouP  onChange=\"XferAgentSelectLink();return false;\">" + live_XfeR_HTML + "</select>";

								// INSERT VICIDIAL_LOG ENTRY FOR THIS DIAL PROCESS
								//alert(manudial_noanswer_log);
								//if (manudial_noanswer_log == 0)
									//{
									DialLog("start");
									//}
								
								custchannellive=1;
								}
							}
						}
						xmlhttp = null;
						CollectGarbage();
					}
				}
			delete xmlhttp;
			}

		if (MD_ring_secondS == 61) 
			{
			var xmlhttp=false;
			if (!xmlhttp && typeof XMLHttpRequest!='undefined')
				{
				xmlhttp = new XMLHttpRequest();
				}
			if (xmlhttp) 
				{
				manDiaLlook_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=manDiaLlookCaLL2&conf_exten=" + session_id + "&user=" + user + "&pass=" + pass + "&MDnextCID=" + CIDcheck + "&agent_log_id=" + agent_log_id + "&lead_id=" + document.vicidial_form.lead_id.value + "&DiaL_SecondS=" + MD_ring_secondS;
				//alert(manDiaLlook_query);
				xmlhttp.open('POST', 'vdc_db_query.php'); 
				xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
				xmlhttp.send(manDiaLlook_query); 
				xmlhttp.onreadystatechange = function() 
					{ 
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
						{
						var MDlookResponse = null;
						//alert(xmlhttp.responseText);
						MDlookResponse = xmlhttp.responseText;
						var MDlookResponse_array=MDlookResponse.split("\n");
						var MDlookCID = MDlookResponse_array[0];
						var regMDL = new RegExp("^Local","ig");
				
									//alert(MDlookCID); 
									if (MDlookCID == "NO")
										{
										MD_channel_look=0;
										MD_ring_secondS=0;
										//alert("拨号超时，请与系统管理员联系\n");
										dialedcall_send_hangup();
										}
									else
										{
										if (taskCheckOR == 'YES')
											{
											XDuniqueid = MDlookResponse_array[0];
											XDchannel = MDlookResponse_array[1];
											var XDalert = MDlookResponse_array[2];
											
											if (XDalert == 'ERROR')
												{
												var XDerrorDesc = MDlookResponse_array[3];
												var DiaLAlerTMessagE = "Call Rejected: " + XDchannel + "\n" + XDerrorDesc;
												TimerActionRun("DiaLAlerT",DiaLAlerTMessagE);
												}
											if ( (XDchannel.match(regMDL)) && (asterisk_version != '1.0.8') && (asterisk_version != '1.0.9') && (MD_ring_secondS < 10) )
												{
												// bad grab of Local channel, try again
												MD_ring_secondS++;
												}
											else
												{
				
												document.getElementById("xferuniqueid").value	= MDlookResponse_array[0];
												document.getElementById("xferchannel").value   = MDlookResponse_array[1];
												lastxferchannel = MDlookResponse_array[1];
												document.getElementById("xferlength").value		= 0;
				                                
												XD_live_customer_call = 1;
												XD_live_call_secondS = 0;
												MD_channel_look=0;
				
												document.getElementById("MainStatuSSpan").innerHTML = " <font style=\"font-family:'宋体';font-size:12px;\">拨给第三方: " + document.getElementById("xfernumber").value + " UID: " + CIDcheck+"</font>";
				                                document.getElementById("MainStatuSSpan").innerHTML = " <font style=\"font-family:'宋体';font-size:12px;\">拨给第三方: " + document.getElementById("xfernumber").value + " UID: " + CIDcheck + "</font>";
				
				
												if(Xfer_Dial_With_Customer_Display=='Y')
													{
												document.getElementById("DialWithCustomer").innerHTML ="<IMG SRC=\"../agc/images/cn/vdc_XB_dialwithcustomer_OFF_cn.gif\" border=0 alt=\"不挂断拨号\" style=\"vertical-align:middle\">";
													}
				                                //Mod by fnatic end
												document.getElementById("ParkCustomerDial").innerHTML ="<IMG SRC=\"../agc/images/cn/vdc_XB_parkcustomerdial_OFF_cn.gif\" border=0 alt=\"保持客户拨号\" style=\"vertical-align:middle\">";
				
												xferchannellive=1;
												XDcheck = '';
												}
											}
										else
											{
											MDuniqueid = MDlookResponse_array[0];
											MDchannel = MDlookResponse_array[1];
											var MDalert = MDlookResponse_array[2];
											
											if (MDalert == 'ERROR')
												{
												var MDerrorDesc = MDlookResponse_array[3];
												//Mod by fnatic start
												//var DiaLAlerTMessagE = "Call Rejected: " + MDchannel + "\n" + MDerrorDesc;
				                                var DiaLAlerTMessagE = "<center><br/><br/><b>客户无法接通!</b></center>";
												//Mod by fnatic end
												TimerActionRun("DiaLAlerT",DiaLAlerTMessagE);
												}
											if ( (MDchannel.match(regMDL)) && (asterisk_version != '1.0.8') && (asterisk_version != '1.0.9') )
												{
												// bad grab of Local channel, try again
												MD_ring_secondS++;
												}
											else
												{
												custchannellive=1;
				
												document.vicidial_form.uniqueid.value		= MDlookResponse_array[0];
												last_uniqueid = MDlookResponse_array[0];
												document.vicidial_form.callchannel.value	= MDlookResponse_array[1];
												lastcustchannel = MDlookResponse_array[1];
												
				                                //Modified by Kelvin Begin
												if (Manual_Ring_Launch=='SCRIPT') 
												{
												if (delayed_script_load == 'YES')
													{
													load_script_contents();
													}
													//alert(1);
												ScriptPanelToFront();
												}
												//Modified by Kelvin End
												document.getElementById("status_code").innerHTML="通话";
												if(Pause_Code_Selected_Link_Display=='Y' && (agent_pause_codes_active=='FORCE' || agent_pause_codes_active=="Y")){
													document.getElementById("PauseCodeLinkSpan").style.display="none";
												}
												if( document.images ) { document.images['livecall'].src = image_livecall_ON.src;}
												document.vicidial_form.SecondS.value		= 0;
												document.getElementById("SecondSDISP").innerHTML = '0';
				                               // alert(XD_live_customer_call);  answered call 
											    //ccms_006_called = 1;
												VD_live_customer_call = 1;
												VD_live_call_secondS = 0;
				
												MD_channel_look=0;
												var dispnum = lead_dial_number;
												var status_display_number = phone_number_format(dispnum);
				
											    document.getElementById("MainStatuSSpan").innerHTML = "<font style=\"font-family:'宋体';font-size:12px;\">已拨号: " + status_display_number + " UID: " + CIDcheck + " </font>";
												
												if(CheckOutboundChannelLine2 == 0){
													document.getElementById("out_line12").innerHTML = "<input type='text' size=\"15\" maxlength=\"20\" name=\"tel_out_line2\" id=\"tel_out_line2\" value=\"\" ><input type='button' onClick=\"outbound_dial_line2();return false;\" value=\"拨号\" />";
												}
												document.getElementById("ParkControl").innerHTML ="<a href=\"#\" onclick=\"mainxfer_send_redirect('ParK','" + lastcustchannel + "','" + lastcustserverip + "');return false;\"><IMG SRC=\"../agc/images/cn/vdc_LB_parkcall_cn.gif\" border=0 alt=\"保持电话\"></a>";
												document.getElementById("HangupControl").innerHTML = "<a href=\"#\" onclick=\"dialedcall_send_hangup();\"><IMG SRC=\"../agc/images/cn/vdc_LB_hangupcustomer_cn.gif\" border=0 alt=\"挂断\"></a>";
				
												if (VU_vicidial_transfers == '1'){
													document.getElementById("XferControl").innerHTML = "<a href=\"#\" onclick=\"ShoWTransferMain('ON');\"><IMG SRC=\"../agc/images/cn/vdc_LB_transferconf_cn.gif\" border=0 alt=\"转接 - 电话会议\"></a>";
				                                }
												//Mod by fnatic start
												if(Xfer_Local_Closer_Display=='Y')
													{
												document.getElementById("LocalCloser").innerHTML = "<a href=\"#\" onclick=\"mainxfer_send_redirect('XfeRLOCAL','" + lastcustchannel + "','" + lastcustserverip + "');return false;\"><IMG SRC=\"../agc/images/vdc_XB_localcloser_cn.gif\" border=0 alt=\"转本地技能组\" style=\"vertical-align:middle\"></a>";
												    }
												if(Xfer_Blind_Display=='Y')
													{
												//document.getElementById("DialBlindTransfer").innerHTML = "<a href=\"#\" onclick=\"mainxfer_send_redirect('XfeRBLIND','" + lastcustchannel + "','" + lastcustserverip + "');return false;\"><IMG SRC=\"../agc/images/vdc_XB_blindtransfer_cn.gif\" border=0 alt=\"盲转\" style=\"vertical-align:middle\"></a>";
												//TransferMain@20110104 start
												document.getElementById("DialBlindTransfer").innerHTML = "<IMG SRC=\"../agc/images/cn/vdc_XB_blindtransfer_OFF_cn.gif\" border=0 alt=\"盲转\" style=\"vertical-align:middle\">";
												//TransferMain@20110104 end
												    }
												
				                                if(Xfer_Answer_Machine_Message_Display=='Y')
													{
												document.getElementById("DialBlindVMail").innerHTML = "<a href=\"#\" onclick=\"mainxfer_send_redirect('XfeRVMAIL','" + lastcustchannel + "','" + lastcustserverip + "');return false;\"><IMG SRC=\"../agc/images/vdc_XB_ammessage_cn.gif\" border=0 alt=\"VM\" style=\"vertical-align:middle\"></a>";
												    }
												//Mod by fnatic end
												document.getElementById("VolumeUpSpan").innerHTML = "<a href=\"#\" onclick=\"volume_control('UP','" + MDchannel + "','');return false;\"><IMG SRC=\"../agc/images/vdc_volume_up.gif\" BORDER=0></a>";
												document.getElementById("VolumeDownSpan").innerHTML = "<a href=\"#\" onclick=\"volume_control('DOWN','" + MDchannel + "','');return false;\"><IMG SRC=\"../agc/images/vdc_volume_down.gif\" BORDER=0></a>";
				
												if (quick_transfer_button == 'IN_GROUP')
													{
													document.getElementById("QuickXfer").innerHTML = "<a href=\"#\" onclick=\"mainxfer_send_redirect('XfeRLOCAL','" + lastcustchannel + "','" + lastcustserverip + "');return false;\"><IMG SRC=\"../agc/images/vdc_LB_quickxfer_cn.gif\" border=0 alt=\"快速传递\"></a>";
													}
												if (prepopulate_transfer_preset_enabled > 0)
													{
													if (prepopulate_transfer_preset == 'PRESET_1')
														{
														//Mod by fnatic
														//document.vicidial_form.xfernumber.value = CalL_XC_a_NuMber;
														document.getElementById("xfernumber").value = CalL_XC_a_NuMber;
														}
													if (prepopulate_transfer_preset == 'PRESET_2')
														{
														//Mod by fnatic
														//document.vicidial_form.xfernumber.value = CalL_XC_b_NuMber;
														document.getElementById("xfernumber").value = CalL_XC_b_NuMber;
														}
													if (prepopulate_transfer_preset == 'PRESET_3')
														{
														//Mod by fnatic
														//document.vicidial_form.xfernumber.value = CalL_XC_c_NuMber;
														document.getElementById("xfernumber").value = CalL_XC_c_NuMber;
														}
													if (prepopulate_transfer_preset == 'PRESET_4')
														{
														//Mod by fnatic
														//document.vicidial_form.xfernumber.value = CalL_XC_d_NuMber;
														document.getElementById("xfernumber").value = CalL_XC_d_NuMber;
														}
													if (prepopulate_transfer_preset == 'PRESET_5')
														{
														//Mod by fnatic 
														//document.vicidial_form.xfernumber.value = CalL_XC_e_NuMber;}
														document.getElementById("xfernumber").value = CalL_XC_e_NuMber;
														}
													}
												if ( (quick_transfer_button == 'PRESET_1') || (quick_transfer_button == 'PRESET_2') || (quick_transfer_button == 'PRESET_3') || (quick_transfer_button == 'PRESET_4') || (quick_transfer_button == 'PRESET_5') )
													{
													document.getElementById("QuickXfer").innerHTML = "<a href=\"#\" onclick=\"mainxfer_send_redirect('XfeRBLIND','" + lastcustchannel + "','" + lastcustserverip + "');return false;\"><IMG SRC=\"../agc/images/vdc_LB_quickxfer_cn.gif\" border=0 alt=\"快速传递\"></a>";
				
													if (quick_transfer_button == 'PRESET_1')
														{
														//Mod by fnatic
														//document.vicidial_form.xfernumber.value = CalL_XC_a_NuMber;
														document.getElementById("xfernumber").value = CalL_XC_a_NuMber;
														}
													if (quick_transfer_button == 'PRESET_2')
														{
														//Mod by fnatic
														//document.vicidial_form.xfernumber.value = CalL_XC_b_NuMber;
														document.getElementById("xfernumber").value = CalL_XC_b_NuMber;
														}
													if (quick_transfer_button == 'PRESET_3')
														{
														//Mod by fnatic
														//document.vicidial_form.xfernumber.value = CalL_XC_c_NuMber;
														document.getElementById("xfernumber").value = CalL_XC_c_NuMber;
														}
													if (quick_transfer_button == 'PRESET_4')
														{
														//Mod by fnatic
														//document.vicidial_form.xfernumber.value = CalL_XC_d_NuMber;
														document.getElementById("xfernumber").value = CalL_XC_d_NuMber;
														}
													if (quick_transfer_button == 'PRESET_5')
														{
														//Mod by fnatic 
														//document.vicidial_form.xfernumber.value = CalL_XC_e_NuMber;
														document.getElementById("xfernumber").value = CalL_XC_e_NuMber;
														}
													}
				
												if (call_requeue_button > 0)
													{
													var CloserSelectChoices = document.vicidial_form.CloserSelectList.value;
													var regCRB = new RegExp("AGENTDIRECT","ig");
													if ( (CloserSelectChoices.match(regCRB)) || (VU_closer_campaigns.match(regCRB)) )
														{
														document.getElementById("ReQueueCall").innerHTML =  "<a href=\"#\" onclick=\"call_requeue_launch();return false;\"><IMG SRC=\"../agc/images/vdc_LB_requeue_call.gif\" border=0 alt=\"Re-Queue Call\"></a>";
														}
													else
														{
														document.getElementById("ReQueueCall").innerHTML =  "<IMG SRC=\"../agc/images/vdc_LB_requeue_call_OFF.gif\" border=0 alt=\"Re-Queue Call\">";
														}
													}
				
												// Build transfer pull-down list
												var loop_ct = 0;
												var live_XfeR_HTML = '';
												var XfeR_SelecT = '';
												while (loop_ct < XFgroupCOUNT)
													{
													if (VARxfergroups[loop_ct] == LIVE_default_xfer_group)
														{XfeR_SelecT = 'selected ';}
													else {XfeR_SelecT = '';}
													live_XfeR_HTML = live_XfeR_HTML + "<option " + XfeR_SelecT + "value=\"" + VARxfergroups[loop_ct] + "\">" + VARxfergroups[loop_ct] + " - " + VARxfergroupsnames[loop_ct] + "</option>\n";
													loop_ct++;
													}
												document.getElementById("XfeRGrouPLisT").innerHTML = "<select size=1 name=XfeRGrouP id=XfeRGrouP  onChange=\"XferAgentSelectLink();return false;\">" + live_XfeR_HTML + "</select>";
				
												// INSERT VICIDIAL_LOG ENTRY FOR THIS DIAL PROCESS
												//alert(manudial_noanswer_log);
												//if (manudial_noanswer_log == 0)
													//{
													DialLog("start");
													//}
												
												custchannellive=1;
												}
											}
										}
										xmlhttp = null;
										CollectGarbage();
									}
								}
							delete xmlhttp;
							}
			}

		}

// ################################################################################
// Update Agent screen with values from vicidial_list record
	function UpdateFieldsData()
		{
		var fields_list = update_fields_data + ',';
		update_fields=0;
		update_fields_data='';
		var xmlhttp=false;
		/*@cc_on @*/
		/*@if (@_jscript_version >= 5)
		// JScript gives us Conditional compilation, we can cope with old IE versions.
		// and security blocked creation of the objects.
		 try {
		  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		 } catch (e) {
		  try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  } catch (E) {
		   xmlhttp = false;
		  }
		 }
		@end @*/
		if (!xmlhttp && typeof XMLHttpRequest!='undefined')
			{
			xmlhttp = new XMLHttpRequest();
			}
		if (xmlhttp) 
			{
			UpdateFields_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=UpdateFields&conf_exten=" + session_id + "&user=" + user + "&pass=" + pass + "&stage=" + update_fields_data;
			//		alert(manual_dial_filter + "\n" +manDiaLnext_query);
			xmlhttp.open('POST', 'vdc_db_query.php');
			xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
			xmlhttp.send(UpdateFields_query); 
			xmlhttp.onreadystatechange = function() 
				{ 
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
					{
					var UDfieldsResponse = null;
				//	alert(UpdateFields_query);
				//	alert(xmlhttp.responseText);
					UDfieldsResponse = xmlhttp.responseText;

					var UDfieldsResponse_array=UDfieldsResponse.split("\n");

					var UDresponse_status							= UDfieldsResponse_array[0];
					if (UDresponse_status == 'GOOD')
						{
						var regUDvendor_lead_code = new RegExp("vendor_lead_code,","ig");
						if (fields_list.match(regUDvendor_lead_code))
							{document.vicidial_form.vendor_lead_code.value	= UDfieldsResponse_array[1];}
						var regUDsource_id = new RegExp("source_id,","ig");
						if (fields_list.match(regUDsource_id))
							{source_id										= UDfieldsResponse_array[2];}
						var regUDgmt_offset_now = new RegExp("gmt_offset_now,","ig");
						if (fields_list.match(regUDgmt_offset_now))
							{document.vicidial_form.gmt_offset_now.value	= UDfieldsResponse_array[3];}
						var regUDphone_code = new RegExp("phone_code,","ig");
						if (fields_list.match(regUDphone_code))
							{document.vicidial_form.phone_code.value		= UDfieldsResponse_array[4];}
						var regUDphone_number = new RegExp("phone_number,","ig");
						if (fields_list.match(regUDphone_number))
							{
							if ( (disable_alter_custphone=='Y') || (disable_alter_custphone=='HIDE') )
								{
								var tmp_pn = document.getElementById("phone_numberDISP");
								if (disable_alter_custphone=='Y')
									{
									tmp_pn.innerHTML						= UDfieldsResponse_array[5];
									}
								}
							document.vicidial_form.phone_number.value		= UDfieldsResponse_array[5];
							}
						var regUDtitle = new RegExp("title,","ig");
						if (fields_list.match(regUDtitle))
							{document.vicidial_form.title.value				= UDfieldsResponse_array[6];}
						var regUDfirst_name = new RegExp("first_name,","ig");
						if (fields_list.match(regUDfirst_name))
							{document.vicidial_form.first_name.value		= UDfieldsResponse_array[7];}
						var regUDmiddle_initial = new RegExp("middle_initial,","ig");
						if (fields_list.match(regUDmiddle_initial))
							{document.vicidial_form.middle_initial.value	= UDfieldsResponse_array[8];}
						var regUDlast_name = new RegExp("last_name,","ig");
						if (fields_list.match(regUDlast_name))
							{document.vicidial_form.last_name.value			= UDfieldsResponse_array[9];}
						var regUDaddress1 = new RegExp("address1,","ig");
						if (fields_list.match(regUDaddress1))
							{document.vicidial_form.address1.value			= UDfieldsResponse_array[10];}
						var regUDaddress2 = new RegExp("address2,","ig");
						if (fields_list.match(regUDaddress2))
							{document.vicidial_form.address2.value			= UDfieldsResponse_array[11];}
						var regUDaddress3 = new RegExp("address3,","ig");
						if (fields_list.match(regUDaddress3))
							{document.vicidial_form.address3.value			= UDfieldsResponse_array[12];}
						var regUDcity = new RegExp("city,","ig");
						if (fields_list.match(regUDcity))
							{document.vicidial_form.city.value				= UDfieldsResponse_array[13];}
						var regUDstate = new RegExp("state,","ig");
						if (fields_list.match(regUDstate))
							{document.vicidial_form.state.value				= UDfieldsResponse_array[14];}
						var regUDprovince = new RegExp("province,","ig");
						if (fields_list.match(regUDprovince))
							{document.vicidial_form.province.value			= UDfieldsResponse_array[15];}
						var regUDpostal_code = new RegExp("postal_code,","ig");
						if (fields_list.match(regUDpostal_code))
							{document.vicidial_form.postal_code.value		= UDfieldsResponse_array[16];}
						var regUDcountry_code = new RegExp("country_code,","ig");
						if (fields_list.match(regUDcountry_code))
							{document.vicidial_form.country_code.value		= UDfieldsResponse_array[17];}
						var regUDgender = new RegExp("gender,","ig");
						if (fields_list.match(regUDgender))
							{
							document.vicidial_form.gender.value				= UDfieldsResponse_array[18];
							var gIndex = 0;
							if (document.vicidial_form.gender.value == 'M') {var gIndex = 1;}
							if (document.vicidial_form.gender.value == 'F') {var gIndex = 2;}
							document.getElementById("gender_list").selectedIndex = gIndex;
							var genderIndex = document.getElementById("gender_list").selectedIndex;
							var genderValue =  document.getElementById('gender_list').options[genderIndex].value;
							document.vicidial_form.gender.value = genderValue;
							}
						var regUDdate_of_birth = new RegExp("date_of_birth,","ig");
						if (fields_list.match(regUDdate_of_birth))
							{document.vicidial_form.date_of_birth.value		= UDfieldsResponse_array[19];}

						var regUDalt_phone = new RegExp("alt_phone,","ig");
						if (fields_list.match(regUDalt_phone))
							{document.vicidial_form.alt_phone.value			= UDfieldsResponse_array[20];}
						var regUDemail = new RegExp("email,","ig");
						if (fields_list.match(regUDemail))
							{document.vicidial_form.email.value				= UDfieldsResponse_array[21];}
						var regUDsecurity_phrase = new RegExp("security_phrase,","ig");
						if (fields_list.match(regUDsecurity_phrase))
							{document.vicidial_form.security_phrase.value	= UDfieldsResponse_array[22];}
						var regUDcomments = new RegExp("comments,","ig");
						if (fields_list.match(regUDcomments))
							{
							var REGcommentsNL = new RegExp("!N","g");
							UDfieldsResponse_array[23] = UDfieldsResponse_array[23].replace(REGcommentsNL, "\n");
							document.vicidial_form.comments.value			= UDfieldsResponse_array[23];
							}
						var regUDrank = new RegExp("rank,","ig");
						if (fields_list.match(regUDrank))
							{document.vicidial_form.rank.value				= UDfieldsResponse_array[24];}
						var regUDowner = new RegExp("owner,","ig");
						if (fields_list.match(regUDowner))
							{document.vicidial_form.owner.value				= UDfieldsResponse_array[25];}


						var regWFAcustom = new RegExp("^VAR","ig");
						if (VDIC_web_form_address.match(regWFAcustom))
							{
							URLDecode(VDIC_web_form_address,'YES');
							TEMP_VDIC_web_form_address = decoded;
							TEMP_VDIC_web_form_address = TEMP_VDIC_web_form_address.replace(regWFAcustom, '');
							}
						else
							{
							web_form_vars = 
							"&lead_id=" + document.vicidial_form.lead_id.value + 
							"&vendor_id=" + document.vicidial_form.vendor_lead_code.value + 
							"&list_id=" + document.vicidial_form.list_id.value + 
							"&gmt_offset_now=" + document.vicidial_form.gmt_offset_now.value + 
							"&phone_code=" + document.vicidial_form.phone_code.value + 
							"&phone_number=" + document.vicidial_form.phone_number.value + 
							"&title=" + document.vicidial_form.title.value + 
							"&first_name=" + document.vicidial_form.first_name.value + 
							"&middle_initial=" + document.vicidial_form.middle_initial.value + 
							"&last_name=" + document.vicidial_form.last_name.value + 
							"&address1=" + document.vicidial_form.address1.value + 
							"&address2=" + document.vicidial_form.address2.value + 
							"&address3=" + document.vicidial_form.address3.value + 
							"&city=" + document.vicidial_form.city.value + 
							"&state=" + document.vicidial_form.state.value + 
							"&province=" + document.vicidial_form.province.value + 
							"&postal_code=" + document.vicidial_form.postal_code.value + 
							"&country_code=" + document.vicidial_form.country_code.value + 
							"&gender=" + document.vicidial_form.gender.value + 
							"&date_of_birth=" + document.vicidial_form.date_of_birth.value + 
							"&alt_phone=" + document.vicidial_form.alt_phone.value + 
							"&email=" + document.vicidial_form.email.value + 
							"&security_phrase=" + document.vicidial_form.security_phrase.value + 
							"&comments=" + document.vicidial_form.comments.value + 
							"&user=" + user + 
							"&pass=" + pass + 
							"&campaign=" + campaign + 
							"&phone_login=" + phone_login + 
							"&original_phone_login=" + original_phone_login +
							"&phone_pass=" + phone_pass + 
							"&fronter=" + fronter + 
							"&closer=" + user + 
							"&group=" + group + 
							"&channel_group=" + group + 
							"&SQLdate=" + SQLdate + 
							"&epoch=" + UnixTime + 
							"&uniqueid=" + document.vicidial_form.uniqueid.value + 
							"&customer_zap_channel=" + lastcustchannel + 
							"&customer_server_ip=" + lastcustserverip +
							"&server_ip=" + server_ip + 
							"&SIPexten=" + extension + 
							"&session_id=" + session_id + 
							"&phone=" + document.vicidial_form.phone_number.value + 
							"&parked_by=" + document.vicidial_form.lead_id.value +
							"&dispo=" + LeaDDispO + '' +
							"&dialed_number=" + dialed_number + '' +
							"&dialed_label=" + dialed_label + '' +
							"&source_id=" + source_id + '' +
							"&rank=" + document.vicidial_form.rank.value + '' +
							"&owner=" + document.vicidial_form.owner.value + '' +
							"&camp_script=" + campaign_script + '' +
							"&in_script=" + CalL_ScripT_id + '' +
							"&script_width=" + script_width + '' +
							"&script_height=" + script_height + '' +
							"&fullname=" + LOGfullname + '' +
							"&recording_filename=" + recording_filename + '' +
							"&recording_id=" + recording_id + '' +
							"&user_custom_one=" + VU_custom_one + '' +
							"&user_custom_two=" + VU_custom_two + '' +
							"&user_custom_three=" + VU_custom_three + '' +
							"&user_custom_four=" + VU_custom_four + '' +
							"&user_custom_five=" + VU_custom_five + '' +
							"&preset_number_a=" + CalL_XC_a_NuMber + '' +
							"&preset_number_b=" + CalL_XC_b_NuMber + '' +
							"&preset_number_c=" + CalL_XC_c_NuMber + '' +
							"&preset_number_d=" + CalL_XC_d_NuMber + '' +
							"&preset_number_e=" + CalL_XC_e_NuMber + '' +
							"&preset_dtmf_a=" + CalL_XC_a_Dtmf + '' +
							"&preset_dtmf_b=" + CalL_XC_b_Dtmf + '' +
							webform_session;
							
							var regWFspace = new RegExp(" ","ig");
							web_form_vars = web_form_vars.replace(regWF, '');
							var regWF = new RegExp("\\`|\\~|\\:|\\;|\\#|\\'|\\\"|\\{|\\}|\\(|\\)|\\*|\\^|\\%|\\$|\\!|\\%|\\r|\\t|\\n","ig");
							web_form_vars = web_form_vars.replace(regWFspace, '+');
							web_form_vars = web_form_vars.replace(regWF, '');

							var regWFAvars = new RegExp("\\?","ig");
							if (VDIC_web_form_address.match(regWFAvars))
								{web_form_vars = '&' + web_form_vars}
							else
								{web_form_vars = '?' + web_form_vars}

							TEMP_VDIC_web_form_address = VDIC_web_form_address + "" + web_form_vars;

							var regWFAqavars = new RegExp("\\?&","ig");
							var regWFAaavars = new RegExp("&&","ig");
							TEMP_VDIC_web_form_address = TEMP_VDIC_web_form_address.replace(regWFAqavars, '?');
							TEMP_VDIC_web_form_address = TEMP_VDIC_web_form_address.replace(regWFAaavars, '&');
							}

						if (VDIC_web_form_address_two.match(regWFAcustom))
							{
							URLDecode(VDIC_web_form_address_two,'YES');
							TEMP_VDIC_web_form_address_two = decoded;
							TEMP_VDIC_web_form_address_two = TEMP_VDIC_web_form_address_two.replace(regWFAcustom, '');
							}
						else
							{
							web_form_vars_two = 
							"&lead_id=" + document.vicidial_form.lead_id.value + 
							"&vendor_id=" + document.vicidial_form.vendor_lead_code.value + 
							"&list_id=" + document.vicidial_form.list_id.value + 
							"&gmt_offset_now=" + document.vicidial_form.gmt_offset_now.value + 
							"&phone_code=" + document.vicidial_form.phone_code.value + 
							"&phone_number=" + document.vicidial_form.phone_number.value + 
							"&title=" + document.vicidial_form.title.value + 
							"&first_name=" + document.vicidial_form.first_name.value + 
							"&middle_initial=" + document.vicidial_form.middle_initial.value + 
							"&last_name=" + document.vicidial_form.last_name.value + 
							"&address1=" + document.vicidial_form.address1.value + 
							"&address2=" + document.vicidial_form.address2.value + 
							"&address3=" + document.vicidial_form.address3.value + 
							"&city=" + document.vicidial_form.city.value + 
							"&state=" + document.vicidial_form.state.value + 
							"&province=" + document.vicidial_form.province.value + 
							"&postal_code=" + document.vicidial_form.postal_code.value + 
							"&country_code=" + document.vicidial_form.country_code.value + 
							"&gender=" + document.vicidial_form.gender.value + 
							"&date_of_birth=" + document.vicidial_form.date_of_birth.value + 
							"&alt_phone=" + document.vicidial_form.alt_phone.value + 
							"&email=" + document.vicidial_form.email.value + 
							"&security_phrase=" + document.vicidial_form.security_phrase.value + 
							"&comments=" + document.vicidial_form.comments.value + 
							"&user=" + user + 
							"&pass=" + pass + 
							"&campaign=" + campaign + 
							"&phone_login=" + phone_login + 
							"&original_phone_login=" + original_phone_login +
							"&phone_pass=" + phone_pass + 
							"&fronter=" + fronter + 
							"&closer=" + user + 
							"&group=" + group + 
							"&channel_group=" + group + 
							"&SQLdate=" + SQLdate + 
							"&epoch=" + UnixTime + 
							"&uniqueid=" + document.vicidial_form.uniqueid.value + 
							"&customer_zap_channel=" + lastcustchannel + 
							"&customer_server_ip=" + lastcustserverip +
							"&server_ip=" + server_ip + 
							"&SIPexten=" + extension + 
							"&session_id=" + session_id + 
							"&phone=" + document.vicidial_form.phone_number.value + 
							"&parked_by=" + document.vicidial_form.lead_id.value +
							"&dispo=" + LeaDDispO + '' +
							"&dialed_number=" + dialed_number + '' +
							"&dialed_label=" + dialed_label + '' +
							"&source_id=" + source_id + '' +
							"&rank=" + document.vicidial_form.rank.value + '' +
							"&owner=" + document.vicidial_form.owner.value + '' +
							"&camp_script=" + campaign_script + '' +
							"&in_script=" + CalL_ScripT_id + '' +
							"&script_width=" + script_width + '' +
							"&script_height=" + script_height + '' +
							"&fullname=" + LOGfullname + '' +
							"&recording_filename=" + recording_filename + '' +
							"&recording_id=" + recording_id + '' +
							"&user_custom_one=" + VU_custom_one + '' +
							"&user_custom_two=" + VU_custom_two + '' +
							"&user_custom_three=" + VU_custom_three + '' +
							"&user_custom_four=" + VU_custom_four + '' +
							"&user_custom_five=" + VU_custom_five + '' +
							"&preset_number_a=" + CalL_XC_a_NuMber + '' +
							"&preset_number_b=" + CalL_XC_b_NuMber + '' +
							"&preset_number_c=" + CalL_XC_c_NuMber + '' +
							"&preset_number_d=" + CalL_XC_d_NuMber + '' +
							"&preset_number_e=" + CalL_XC_e_NuMber + '' +
							"&preset_dtmf_a=" + CalL_XC_a_Dtmf + '' +
							"&preset_dtmf_b=" + CalL_XC_b_Dtmf + '' +
							webform_session;
							
							var regWFspace = new RegExp(" ","ig");
							web_form_vars_two = web_form_vars_two.replace(regWF, '');
							var regWF = new RegExp("\\`|\\~|\\:|\\;|\\#|\\'|\\\"|\\{|\\}|\\(|\\)|\\*|\\^|\\%|\\$|\\!|\\%|\\r|\\t|\\n","ig");
							web_form_vars_two = web_form_vars_two.replace(regWFspace, '+');
							web_form_vars_two = web_form_vars_two.replace(regWF, '');

							var regWFAvars = new RegExp("\\?","ig");
							if (VDIC_web_form_address_two.match(regWFAvars))
								{web_form_vars_two = '&' + web_form_vars_two}
							else
								{web_form_vars_two = '?' + web_form_vars_two}

							TEMP_VDIC_web_form_address_two = VDIC_web_form_address_two + "" + web_form_vars_two;

							var regWFAqavars = new RegExp("\\?&","ig");
							var regWFAaavars = new RegExp("&&","ig");
							TEMP_VDIC_web_form_address_two = TEMP_VDIC_web_form_address_two.replace(regWFAqavars, '?');
							TEMP_VDIC_web_form_address_two = TEMP_VDIC_web_form_address_two.replace(regWFAaavars, '&');
							}

                        //Modified by Kelvin Begin
						if (WebForm_Button_Display!='NONE') {
						document.getElementById("WebFormSpan").innerHTML = "<a href=\"" + TEMP_VDIC_web_form_address + "\" target=\"" + web_form_target + "\" onMouseOver=\"WebFormRefresH();\"><IMG SRC=\"../agc/images/cn/vdc_LB_webform_cn.gif\" border=0 alt=\"网页表单\"></a>\n";
						if (enable_second_webform > 0)
							{
							document.getElementById("WebFormSpanTwo").innerHTML = "<a href=\"" + TEMP_VDIC_web_form_address_two + "\" target=\"" + web_form_target + "\" onMouseOver=\"WebFormTwoRefresH();\"><IMG SRC=\"../agc/images/cn/vdc_LB_webform_two_cn.gif\" border=0 alt=\"网页表单2\"></a>\n";
							}
						}
                        //Modified by Kelvin End

						}
					else
						{
						alert("Update Fields Error!: " + xmlhttp.responseText);
						}
						xmlhttp = null;
						CollectGarbage();
					}
				}
			}
		}


// ################################################################################
// Send the Manual 拨下一个号码 request
	function ManualDialNext(mdnCBid,mdnBDleadid,mdnDiaLCodE,mdnPhonENumbeR,mdnStagE,mdVendorid,mdgroupalias)
		{
		inOUT = 'OUT';
		all_record = 'NO';
		all_record_count=0;
		if (dial_method == "INBOUND_MAN")
			{
			auto_dial_level=0;

			if (VDRP_stage != 'PAUSED')
				{
				agent_log_id = AutoDial_ReSume_PauSe("VDADpause",'','','',"DIALNEXT");

				PauseCodeSelect_submit("NXDIAL");
				}
			else
				{auto_dial_level=starting_dial_level;}
            
			//Mod by fnatic start
			if(Dial_Next_Display=='Y')
				{				   
			document.getElementById("DiaLControl").innerHTML = "<IMG SRC=\"../agc/images/cn/vdc_LB_pause_OFF_cn.gif\" border=0 alt=\" 暂停 \"><IMG SRC=\"../agc/images/cn/vdc_LB_resume_OFF_cn.gif\" border=0 alt=\"恢复\"><BR><IMG SRC=\"../agc/images/cn/vdc_LB_dialnextnumber_OFF_cn.gif\" border=0 alt=\"拨下一个号码\">";
			    }
				else
				{		
			document.getElementById("DiaLControl").innerHTML = "<IMG SRC=\"../agc/images/cn/vdc_LB_pause_OFF_cn.gif\" border=0 alt=\" 暂停 \"><IMG SRC=\"../agc/images/cn/vdc_LB_resume_OFF_cn.gif\" border=0 alt=\"恢复\">";			
				}
			//Mod by fnaitc end

			}
		else
			{
			//Mod by fnatic start
		    if(Dial_Next_Display=='Y')	
				{
			document.getElementById("DiaLControl").innerHTML = "<IMG SRC=\"../agc/images/cn/vdc_LB_dialnextnumber_OFF_cn.gif\" border=0 alt=\"拨下一个号码\">";
				}
			else
				{
			document.getElementById("DiaLControl").innerHTML = "";
			    }
			//Mod by fnatic end
			}
		if (document.vicidial_form.LeadPreview.checked==true)
			{
			reselect_preview_dial = 1;
			var man_preview = 'YES';
		//	var man_status = "预览资料后 <a href=\"#\" onclick=\"ManualDialOnly()\">拨打lead</a>  或者 <a href=\"#\" onclick=\"ManualDialSkip()\">跳过lead</a>  "; 

		// Modify By Fnatic start
		    //var man_status = "预览资料后 <a href=\"#\" onclick=\"ManualDialOnly()\"><font style='font-size:14px;'>拨打该lead </font></a> 或者 <a href=\"#\" onclick=\"ManualDialSkip()\">跳过lead</a>";
			var man_status = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a class='med_text_link' href=\"#\" onclick=\"ManualDialOnly()\">拨打潜在客户</a>     <a class='med_text_link' href=\"#\" onclick=\"ManualDialSkip()\">跳过潜在客户</a>";
		// Modify By Fnatic end
			}
		else
			{
			reselect_preview_dial = 0;
			var man_preview = 'NO';
			var man_status = "进入闲置状态..."; 
			}

		var xmlhttp=false;
		/*@cc_on @*/
		/*@if (@_jscript_version >= 5)
		// JScript gives us Conditional compilation, we can cope with old IE versions.
		// and security blocked creation of the objects.
		 try {
		  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		 } catch (e) {
		  try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  } catch (E) {
		   xmlhttp = false;
		  }
		 }
		@end @*/
		if (!xmlhttp && typeof XMLHttpRequest!='undefined')
			{
			xmlhttp = new XMLHttpRequest();
			}
		if (xmlhttp) 
			{ 
			if (cid_choice.length > 3) 
				{var call_cid = cid_choice;}
			else 
				{var call_cid = campaign_cid;}
			if (prefix_choice.length > 0)
				{var call_prefix = prefix_choice;}
			else
				{var call_prefix = dial_prefix;}

			manDiaLnext_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=manDiaLnextCaLL&conf_exten=" + session_id + "&user=" + user + "&pass=" + pass + "&campaign=" + campaign + "&ext_context=" + ext_context + "&dial_timeout=" + dial_timeout + "&dial_prefix=" + call_prefix + "&campaign_cid=" + call_cid + "&preview=" + man_preview + "&agent_log_id=" + agent_log_id + "&callback_id=" + mdnCBid + "&lead_id=" + mdnBDleadid + "&phone_code=" + mdnDiaLCodE + "&phone_number=" + mdnPhonENumbeR + "&list_id=" + mdnLisT_id + "&stage=" + mdnStagE  + "&use_internal_dnc=" + use_internal_dnc + "&use_campaign_dnc=" + use_campaign_dnc + "&omit_phone_code=" + omit_phone_code + "&manual_dial_filter=" + manual_dial_filter + "&vendor_lead_code=" + mdVendorid + "&usegroupalias=" + mdgroupalias + "&account=" + active_group_alias + "&agent_dialed_number=" + agent_dialed_number + "&agent_dialed_type=" + agent_dialed_type + "&vtiger_callback_id=" + vtiger_callback_id + "&dial_method=" + dial_method;
				//	alert(manDiaLnext_query);
			xmlhttp.open('POST', 'vdc_db_query.php');
			xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
			xmlhttp.send(manDiaLnext_query); 
			xmlhttp.onreadystatechange = function() 
				{ 
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
					{
					var MDnextResponse = null;
			//		alert(manDiaLnext_query);
			//		alert(xmlhttp.responseText);
					MDnextResponse = xmlhttp.responseText;
					var MDnextResponse_array=MDnextResponse.split("\n");
					MDnextCID = MDnextResponse_array[0];

					var regMNCvar = new RegExp("HOPPER","ig");
					var regMDFvarDNC = new RegExp("DNC","ig");
					var regMDFvarCAMP = new RegExp("CAMPLISTS","ig");
					if ( (MDnextCID.match(regMNCvar)) || (MDnextCID.match(regMDFvarDNC)) || (MDnextCID.match(regMDFvarCAMP)) )
						{
						var alert_displayed=0;
						alt_phone_dialing=starting_alt_phone_dialing;
						auto_dial_level=starting_dial_level;
						MainPanelToFront();
						CalLBacKsCounTCheck();
						if (MDnextCID.match(regMNCvar))
							{alert("本Campaign已无leads:\n" + campaign + "!");   alert_displayed=1;}
						if (MDnextCID.match(regMDFvarDNC))
							{alert("这个电话存在于黑名单中:\n" + mdnPhonENumbeR);   alert_displayed=1;}
						if (MDnextCID.match(regMDFvarCAMP))
							{alert("此电话号码不在Campaign名单中:\n" + mdnPhonENumbeR);   alert_displayed=1;}
						if (alert_displayed==0)						
							{alert("Unspecified error:\n" + mdnPhonENumbeR + "|" + MDnextCID);   alert_displayed=1;}

						if (starting_dial_level == 0)
							{
                             //Mod by fnatic start
							if(Dial_Next_Display=='Y')
								{											
							document.getElementById("DiaLControl").innerHTML = "<a href=\"#\" onclick=\"ManualDialNext('','','','','','0');\"><IMG SRC=\"../agc/images/cn/vdc_LB_dialnextnumber_cn.gif\" border=0 alt=\"拨下一个号码\"></a>";
							   }
							else
								{
							document.getElementById("DiaLControl").innerHTML = "";							
							    }
							 //Mod by fnatic end

							}
						else
							{
							if (dial_method == "INBOUND_MAN")
								{
								auto_dial_level=starting_dial_level;
                                //Mod by fnatic start
                                if(Dial_Next_Display=='Y')
									{
								document.getElementById("DiaLControl").innerHTML = "<IMG SRC=\"../agc/images/cn/vdc_LB_pause_OFF_cn.gif\" border=0 alt=\" 暂停 \"><a href=\"#\" onclick=\"AutoDial_ReSume_PauSe('VDADready');\"><IMG SRC=\"../agc/images/cn/vdc_LB_resume_cn.gif\" border=0 alt=\"恢复\"></a><BR><a href=\"#\" onclick=\"ManualDialNext('','','','','','0');\"><IMG SRC=\"../agc/images/cn/vdc_LB_dialnextnumber_cn.gif\" border=0 alt=\"拨下一个号码\"></a>";
								    }
							    else
									{
								document.getElementById("DiaLControl").innerHTML = "<IMG SRC=\"../agc/images/cn/vdc_LB_pause_OFF_cn.gif\" border=0 alt=\" 暂停 \"><a href=\"#\" onclick=\"AutoDial_ReSume_PauSe('VDADready');\"><IMG SRC=\"../agc/images/cn/vdc_LB_resume_cn.gif\" border=0 alt=\"恢复\"></a>";					
								    }
								//Mod by fnatic end

								}
							else
								{
								document.getElementById("DiaLControl").innerHTML = DiaLControl_auto_HTML;
								}
							//document.getElementById("MainStatuSSpan").style.background = panel_bgcolor;
							document.getElementById("MainStatuSSpan").style.Color = panel_bgcolor;
							reselect_alt_dial = 0;
							}
						}
					else
						{
						fronter = user;
						LasTCID											= MDnextResponse_array[0];
						document.vicidial_form.lead_id.value			= MDnextResponse_array[1];
						LeaDPreVDispO									= MDnextResponse_array[2];
						document.vicidial_form.vendor_lead_code.value	= MDnextResponse_array[4];
						document.vicidial_form.list_id.value			= MDnextResponse_array[5];
						document.vicidial_form.gmt_offset_now.value		= MDnextResponse_array[6];
						document.vicidial_form.phone_code.value			= MDnextResponse_array[7];
						if ( (disable_alter_custphone=='Y') || (disable_alter_custphone=='HIDE') )
							{
							var tmp_pn = document.getElementById("phone_numberDISP");
							if (disable_alter_custphone=='Y')
								{
								tmp_pn.innerHTML						= MDnextResponse_array[8];
								}
							}
						document.vicidial_form.phone_number.value		= MDnextResponse_array[8];
						document.vicidial_form.title.value				= MDnextResponse_array[9];
						document.vicidial_form.first_name.value			= MDnextResponse_array[10];
						document.vicidial_form.middle_initial.value		= MDnextResponse_array[11];
						document.vicidial_form.last_name.value			= MDnextResponse_array[12];
						document.vicidial_form.address1.value			= MDnextResponse_array[13];
						document.vicidial_form.address2.value			= MDnextResponse_array[14];
						document.vicidial_form.address3.value			= MDnextResponse_array[15];
						document.vicidial_form.city.value				= MDnextResponse_array[16];
						document.vicidial_form.state.value				= MDnextResponse_array[17];
						document.vicidial_form.province.value			= MDnextResponse_array[18];
						document.vicidial_form.postal_code.value		= MDnextResponse_array[19];
						
						document.vicidial_form.country_code.value		= MDnextResponse_array[20];
						document.vicidial_form.gender.value				= MDnextResponse_array[21];
						document.vicidial_form.date_of_birth.value		= MDnextResponse_array[22];
						document.vicidial_form.alt_phone.value			= MDnextResponse_array[23];
						document.vicidial_form.email.value				= MDnextResponse_array[24];
						document.vicidial_form.security_phrase.value	= MDnextResponse_array[25];
						var REGcommentsNL = new RegExp("!N","g");
						MDnextResponse_array[26] = MDnextResponse_array[26].replace(REGcommentsNL, "\n");
						document.vicidial_form.comments.value			= MDnextResponse_array[26];
						document.vicidial_form.called_count.value		= MDnextResponse_array[27];
						previous_called_count							= MDnextResponse_array[27];
						previous_dispo									= MDnextResponse_array[2];
						CBentry_time									= MDnextResponse_array[28];
						CBcallback_time									= MDnextResponse_array[29];
						CBuser											= MDnextResponse_array[30];
						CBcomments										= MDnextResponse_array[31];
						dialed_number									= MDnextResponse_array[32];
						dialed_label									= MDnextResponse_array[33];
						source_id										= MDnextResponse_array[34];
						document.vicidial_form.rank.value				= MDnextResponse_array[35];
						document.vicidial_form.owner.value				= MDnextResponse_array[36];
					//	CalL_ScripT_id									= MDnextResponse_array[37];
						script_recording_delay							= MDnextResponse_array[38];
						CalL_XC_a_NuMber								= MDnextResponse_array[39];
						CalL_XC_b_NuMber								= MDnextResponse_array[40];
						CalL_XC_c_NuMber								= MDnextResponse_array[41];
						CalL_XC_d_NuMber								= MDnextResponse_array[42];
						CalL_XC_e_NuMber								= MDnextResponse_array[43];
						document.vicidial_form.modify_date.value = MDnextResponse_array[45];
						document.vicidial_form.entry_date.value = MDnextResponse_array[44];
						agent_dial_start_epoch = MDnextResponse_array[46];
						timer_action = campaign_timer_action;
						timer_action_message = campaign_timer_action_message;
						timer_action_seconds = campaign_timer_action_seconds;
			
						lead_dial_number = document.vicidial_form.phone_number.value;
						var dispnum = document.vicidial_form.phone_number.value;
						var status_display_number = phone_number_format(dispnum);

					//	document.getElementById("MainStatuSSpan").innerHTML = "<font style=\"font-family:'宋体';font-size:12px;\">拨号中: " + status_display_number + " UID: " + MDnextCID + " &nbsp; " + man_status + "</font>";
						document.getElementById("MainStatuSSpan").innerHTML = "<font style=\"font-family:'宋体';font-size:12px;\">拨号中: " + status_display_number + " UID: " + MDnextCID + " &nbsp; " + man_status + "</font>";
						if ( (dialed_label.length < 2) || (dialed_label=='NONE') ) {dialed_label='MAIN';}

						var gIndex = 0;
						if (document.vicidial_form.gender.value == 'M') {var gIndex = 1;}
						if (document.vicidial_form.gender.value == 'F') {var gIndex = 2;}
						document.getElementById("gender_list").selectedIndex = gIndex;

						var genderIndex = document.getElementById("gender_list").selectedIndex;
						var genderValue =  document.getElementById('gender_list').options[genderIndex].value;
						document.vicidial_form.gender.value = genderValue;
						LeaDDispO='';

						VDIC_web_form_address = VICIDiaL_web_form_address
						VDIC_web_form_address_two = VICIDiaL_web_form_address_two

						var regWFAcustom = new RegExp("^VAR","ig");
						if (VDIC_web_form_address.match(regWFAcustom))
							{
							URLDecode(VDIC_web_form_address,'YES');
							TEMP_VDIC_web_form_address = decoded;
							TEMP_VDIC_web_form_address = TEMP_VDIC_web_form_address.replace(regWFAcustom, '');
							}
						else
							{
							web_form_vars = 
							"&lead_id=" + document.vicidial_form.lead_id.value + 
							"&vendor_id=" + document.vicidial_form.vendor_lead_code.value + 
							"&list_id=" + document.vicidial_form.list_id.value + 
							"&gmt_offset_now=" + document.vicidial_form.gmt_offset_now.value + 
							"&phone_code=" + document.vicidial_form.phone_code.value + 
							"&phone_number=" + document.vicidial_form.phone_number.value + 
							"&title=" + document.vicidial_form.title.value + 
							"&first_name=" + document.vicidial_form.first_name.value + 
							"&middle_initial=" + document.vicidial_form.middle_initial.value + 
							"&last_name=" + document.vicidial_form.last_name.value + 
							"&address1=" + document.vicidial_form.address1.value + 
							"&address2=" + document.vicidial_form.address2.value + 
							"&address3=" + document.vicidial_form.address3.value + 
							"&city=" + document.vicidial_form.city.value + 
							"&state=" + document.vicidial_form.state.value + 
							"&province=" + document.vicidial_form.province.value + 
							"&postal_code=" + document.vicidial_form.postal_code.value + 
							"&country_code=" + document.vicidial_form.country_code.value + 
							"&gender=" + document.vicidial_form.gender.value + 
							"&date_of_birth=" + document.vicidial_form.date_of_birth.value + 
							"&entry_date=" + document.vicidial_form.entry_date.value + 
							"&modify_date=" + document.vicidial_form.modify_date.value + 
							"&alt_phone=" + document.vicidial_form.alt_phone.value + 
							"&email=" + document.vicidial_form.email.value + 
							"&security_phrase=" + document.vicidial_form.security_phrase.value + 
							"&comments=" + document.vicidial_form.comments.value + 
							"&user=" + user + 
							"&pass=" + pass + 
							"&campaign=" + campaign + 
							"&phone_login=" + phone_login + 
							"&original_phone_login=" + original_phone_login +
							"&phone_pass=" + phone_pass + 
							"&fronter=" + fronter + 
							"&closer=" + user + 
							"&group=" + group + 
							"&channel_group=" + group + 
							"&SQLdate=" + SQLdate + 
							"&epoch=" + UnixTime + 
							"&uniqueid=" + document.vicidial_form.uniqueid.value + 
							"&customer_zap_channel=" + lastcustchannel + 
							"&customer_server_ip=" + lastcustserverip +
							"&server_ip=" + server_ip + 
							"&SIPexten=" + extension + 
							"&session_id=" + session_id + 
							"&phone=" + document.vicidial_form.phone_number.value + 
							"&parked_by=" + document.vicidial_form.lead_id.value +
							"&dispo=" + LeaDDispO + '' +
							"&dialed_number=" + dialed_number + '' +
							"&dialed_label=" + dialed_label + '' +
							"&source_id=" + source_id + '' +
							"&rank=" + document.vicidial_form.rank.value + '' +
							"&owner=" + document.vicidial_form.owner.value + '' +
							"&camp_script=" + campaign_script + '' +
							"&in_script=" + CalL_ScripT_id + '' +
							"&script_width=" + script_width + '' +
							"&script_height=" + script_height + '' +
							"&fullname=" + LOGfullname + '' +
							"&recording_filename=" + recording_filename + '' +
							"&recording_id=" + recording_id + '' +
							"&user_custom_one=" + VU_custom_one + '' +
							"&user_custom_two=" + VU_custom_two + '' +
							"&user_custom_three=" + VU_custom_three + '' +
							"&user_custom_four=" + VU_custom_four + '' +
							"&user_custom_five=" + VU_custom_five + '' +
							"&preset_number_a=" + CalL_XC_a_NuMber + '' +
							"&preset_number_b=" + CalL_XC_b_NuMber + '' +
							"&preset_number_c=" + CalL_XC_c_NuMber + '' +
							"&preset_number_d=" + CalL_XC_d_NuMber + '' +
							"&preset_number_e=" + CalL_XC_e_NuMber + '' +
							"&preset_dtmf_a=" + CalL_XC_a_Dtmf + '' +
							"&preset_dtmf_b=" + CalL_XC_b_Dtmf + '' +
							webform_session;
							
							var regWFspace = new RegExp(" ","ig");
							web_form_vars = web_form_vars.replace(regWF, '');
							var regWF = new RegExp("\\`|\\~|\\:|\\;|\\#|\\'|\\\"|\\{|\\}|\\(|\\)|\\*|\\^|\\%|\\$|\\!|\\%|\\r|\\t|\\n","ig");
							web_form_vars = web_form_vars.replace(regWFspace, '+');
							web_form_vars = web_form_vars.replace(regWF, '');

							var regWFAvars = new RegExp("\\?","ig");
							if (VDIC_web_form_address.match(regWFAvars))
								{web_form_vars = '&' + web_form_vars}
							else
								{web_form_vars = '?' + web_form_vars}

							TEMP_VDIC_web_form_address = VDIC_web_form_address + "" + web_form_vars;

							var regWFAqavars = new RegExp("\\?&","ig");
							var regWFAaavars = new RegExp("&&","ig");
							TEMP_VDIC_web_form_address = TEMP_VDIC_web_form_address.replace(regWFAqavars, '?');
							TEMP_VDIC_web_form_address = TEMP_VDIC_web_form_address.replace(regWFAaavars, '&');
							}

						if (VDIC_web_form_address_two.match(regWFAcustom))
							{
							URLDecode(VDIC_web_form_address_two,'YES');
							TEMP_VDIC_web_form_address_two = decoded;
							TEMP_VDIC_web_form_address_two = TEMP_VDIC_web_form_address_two.replace(regWFAcustom, '');
							}
						else
							{
							web_form_vars_two = 
							"&lead_id=" + document.vicidial_form.lead_id.value + 
							"&vendor_id=" + document.vicidial_form.vendor_lead_code.value + 
							"&list_id=" + document.vicidial_form.list_id.value + 
							"&gmt_offset_now=" + document.vicidial_form.gmt_offset_now.value + 
							"&phone_code=" + document.vicidial_form.phone_code.value + 
							"&phone_number=" + document.vicidial_form.phone_number.value + 
							"&title=" + document.vicidial_form.title.value + 
							"&first_name=" + document.vicidial_form.first_name.value + 
							"&middle_initial=" + document.vicidial_form.middle_initial.value + 
							"&last_name=" + document.vicidial_form.last_name.value + 
							"&address1=" + document.vicidial_form.address1.value + 
							"&address2=" + document.vicidial_form.address2.value + 
							"&address3=" + document.vicidial_form.address3.value + 
							"&city=" + document.vicidial_form.city.value + 
							"&state=" + document.vicidial_form.state.value + 
							"&province=" + document.vicidial_form.province.value + 
							"&postal_code=" + document.vicidial_form.postal_code.value + 
							"&country_code=" + document.vicidial_form.country_code.value + 
							"&gender=" + document.vicidial_form.gender.value + 
							"&entry_date=" + document.vicidial_form.entry_date.value + 
							"&modify_date=" + document.vicidial_form.modify_date.value + 
							"&date_of_birth=" + document.vicidial_form.date_of_birth.value + 
							"&alt_phone=" + document.vicidial_form.alt_phone.value + 
							"&email=" + document.vicidial_form.email.value + 
							"&security_phrase=" + document.vicidial_form.security_phrase.value + 
							"&comments=" + document.vicidial_form.comments.value + 
							"&user=" + user + 
							"&pass=" + pass + 
							"&campaign=" + campaign + 
							"&phone_login=" + phone_login + 
							"&original_phone_login=" + original_phone_login +
							"&phone_pass=" + phone_pass + 
							"&fronter=" + fronter + 
							"&closer=" + user + 
							"&group=" + group + 
							"&channel_group=" + group + 
							"&SQLdate=" + SQLdate + 
							"&epoch=" + UnixTime + 
							"&uniqueid=" + document.vicidial_form.uniqueid.value + 
							"&customer_zap_channel=" + lastcustchannel + 
							"&customer_server_ip=" + lastcustserverip +
							"&server_ip=" + server_ip + 
							"&SIPexten=" + extension + 
							"&session_id=" + session_id + 
							"&phone=" + document.vicidial_form.phone_number.value + 
							"&parked_by=" + document.vicidial_form.lead_id.value +
							"&dispo=" + LeaDDispO + '' +
							"&dialed_number=" + dialed_number + '' +
							"&dialed_label=" + dialed_label + '' +
							"&source_id=" + source_id + '' +
							"&rank=" + document.vicidial_form.rank.value + '' +
							"&owner=" + document.vicidial_form.owner.value + '' +
							"&camp_script=" + campaign_script + '' +
							"&in_script=" + CalL_ScripT_id + '' +
							"&script_width=" + script_width + '' +
							"&script_height=" + script_height + '' +
							"&fullname=" + LOGfullname + '' +
							"&recording_filename=" + recording_filename + '' +
							"&recording_id=" + recording_id + '' +
							"&user_custom_one=" + VU_custom_one + '' +
							"&user_custom_two=" + VU_custom_two + '' +
							"&user_custom_three=" + VU_custom_three + '' +
							"&user_custom_four=" + VU_custom_four + '' +
							"&user_custom_five=" + VU_custom_five + '' +
							"&preset_number_a=" + CalL_XC_a_NuMber + '' +
							"&preset_number_b=" + CalL_XC_b_NuMber + '' +
							"&preset_number_c=" + CalL_XC_c_NuMber + '' +
							"&preset_number_d=" + CalL_XC_d_NuMber + '' +
							"&preset_number_e=" + CalL_XC_e_NuMber + '' +
							"&preset_dtmf_a=" + CalL_XC_a_Dtmf + '' +
							"&preset_dtmf_b=" + CalL_XC_b_Dtmf + '' +
							webform_session;
							
							var regWFspace = new RegExp(" ","ig");
							web_form_vars_two = web_form_vars_two.replace(regWF, '');
							var regWF = new RegExp("\\`|\\~|\\:|\\;|\\#|\\'|\\\"|\\{|\\}|\\(|\\)|\\*|\\^|\\%|\\$|\\!|\\%|\\r|\\t|\\n","ig");
							web_form_vars_two = web_form_vars_two.replace(regWFspace, '+');
							web_form_vars_two = web_form_vars_two.replace(regWF, '');

							var regWFAvars = new RegExp("\\?","ig");
							if (VDIC_web_form_address_two.match(regWFAvars))
								{web_form_vars_two = '&' + web_form_vars_two}
							else
								{web_form_vars_two = '?' + web_form_vars_two}

							TEMP_VDIC_web_form_address_two = VDIC_web_form_address_two + "" + web_form_vars_two;

							var regWFAqavars = new RegExp("\\?&","ig");
							var regWFAaavars = new RegExp("&&","ig");
							TEMP_VDIC_web_form_address_two = TEMP_VDIC_web_form_address_two.replace(regWFAqavars, '?');
							TEMP_VDIC_web_form_address_two = TEMP_VDIC_web_form_address_two.replace(regWFAaavars, '&');
							}
                        //alert(TEMP_VDIC_web_form_address);
						TEMP_VDIC_web_form_address = encodeURI(TEMP_VDIC_web_form_address);
                        //Modified by Kelvin Begin
						if (WebForm_Button_Display !='NONE') {
						document.getElementById("WebFormSpan").innerHTML = "<a href=\"" + TEMP_VDIC_web_form_address + "\" target=\"" + web_form_target + "\" onMouseOver=\"WebFormRefresH();\"><IMG SRC=\"../agc/images/cn/vdc_LB_webform_cn.gif\" border=0 alt=\"网页表单\"></a>\n";
						if (enable_second_webform > 0)
							{
							document.getElementById("WebFormSpanTwo").innerHTML = "<a href=\"" + TEMP_VDIC_web_form_address_two + "\" target=\"" + web_form_target + "\" onMouseOver=\"WebFormTwoRefresH();\"><IMG SRC=\"../agc/images/cn/vdc_LB_webform_two_cn.gif\" border=0 alt=\"网页表单 2\"></a>\n";
							}
						}
                        //Modified by Kelvin End
						if (LeaDPreVDispO == 'CALLBK')
							{
							document.getElementById("CusTInfOSpaN").innerHTML = " <B> PREVIOUS 拨号BACK </B>";
							document.getElementById("CusTInfOSpaN").style.background = CusTCB_bgcolor;
							document.getElementById("CBcommentsBoxA").innerHTML = "<b>上一通电话:</b>" + CBentry_time;
							document.getElementById("CBcommentsBoxB").innerHTML = "<b>回拨电话:</b>" + CBcallback_time;
							document.getElementById("CBcommentsBoxC").innerHTML = "<b>话务员:</b>" + CBuser;
							document.getElementById("CBcommentsBoxD").innerHTML = "<b>备注:</b><br>" + CBcomments;
							showDiv('CBcommentsBox');
							}

						if (document.vicidial_form.LeadPreview.checked==false)
							{
							reselect_preview_dial = 0;
							MD_channel_look=1;
							custchannellive=1;

							document.getElementById("HangupControl").innerHTML = "<a href=\"#\" onclick=\"dialedcall_send_hangup();\"><IMG SRC=\"../agc/images/cn/vdc_LB_hangupcustomer_cn.gif\" border=0 alt=\"挂断\"></a>";

							if ( (LIVE_campaign_recording == 'ALLCALLS') || (LIVE_campaign_recording == 'ALLFORCE') )
								{all_record = 'YES';}

							if ( (view_scripts == 1) && (campaign_script.length > 0) )
								{
								web_form_vars = 
								"&lead_id=" + document.vicidial_form.lead_id.value + 
								"&vendor_id=" + document.vicidial_form.vendor_lead_code.value + 
								"&list_id=" + document.vicidial_form.list_id.value + 
								"&gmt_offset_now=" + document.vicidial_form.gmt_offset_now.value + 
								"&phone_code=" + document.vicidial_form.phone_code.value + 
								"&phone_number=" + document.vicidial_form.phone_number.value + 
								"&title=" + document.vicidial_form.title.value + 
								"&first_name=" + document.vicidial_form.first_name.value + 
								"&middle_initial=" + document.vicidial_form.middle_initial.value + 
								"&last_name=" + document.vicidial_form.last_name.value + 
								"&address1=" + document.vicidial_form.address1.value + 
								"&address2=" + document.vicidial_form.address2.value + 
								"&address3=" + document.vicidial_form.address3.value + 
								"&city=" + document.vicidial_form.city.value + 
								"&state=" + document.vicidial_form.state.value + 
								"&province=" + document.vicidial_form.province.value + 
								"&postal_code=" + document.vicidial_form.postal_code.value + 
								"&country_code=" + document.vicidial_form.country_code.value + 
								"&gender=" + document.vicidial_form.gender.value + 
								"&date_of_birth=" + document.vicidial_form.date_of_birth.value + 
								"&alt_phone=" + document.vicidial_form.alt_phone.value + 
								"&email=" + document.vicidial_form.email.value + 
								"&security_phrase=" + document.vicidial_form.security_phrase.value + 
								"&comments=" + document.vicidial_form.comments.value + 
								"&user=" + user + 
								"&pass=" + pass + 
								"&campaign=" + campaign + 
								"&phone_login=" + phone_login + 
								"&original_phone_login=" + original_phone_login +
								"&phone_pass=" + phone_pass + 
								"&fronter=" + fronter + 
								"&closer=" + user + 
								"&group=" + group + 
								"&channel_group=" + group + 
								"&SQLdate=" + SQLdate + 
								"&epoch=" + UnixTime + 
								"&uniqueid=" + document.vicidial_form.uniqueid.value + 
								"&customer_zap_channel=" + lastcustchannel + 
								"&customer_server_ip=" + lastcustserverip +
								"&server_ip=" + server_ip + 
								"&SIPexten=" + extension + 
								"&session_id=" + session_id + 
								"&phone=" + document.vicidial_form.phone_number.value + 
								"&parked_by=" + document.vicidial_form.lead_id.value +
								"&dispo=" + LeaDDispO + '' +
								"&dialed_number=" + dialed_number + '' +
								"&dialed_label=" + dialed_label + '' +

								"&source_id=" + source_id + '' +
								"&rank=" + document.vicidial_form.rank.value + '' +
								"&owner=" + document.vicidial_form.owner.value + '' +
								"&camp_script=" + campaign_script + '' +
								"&in_script=" + CalL_ScripT_id + '' +
								"&script_width=" + script_width + '' +
								"&script_height=" + script_height + '' +
								"&fullname=" + LOGfullname + '' +
								"&recording_filename=" + recording_filename + '' +
								"&recording_id=" + recording_id + '' +
								"&user_custom_one=" + VU_custom_one + '' +
								"&user_custom_two=" + VU_custom_two + '' +
								"&user_custom_three=" + VU_custom_three + '' +
								"&user_custom_four=" + VU_custom_four + '' +
								"&user_custom_five=" + VU_custom_five + '' +
								"&preset_number_a=" + CalL_XC_a_NuMber + '' +
								"&preset_number_b=" + CalL_XC_b_NuMber + '' +
								"&preset_number_c=" + CalL_XC_c_NuMber + '' +
								"&preset_number_d=" + CalL_XC_d_NuMber + '' +
								"&preset_number_e=" + CalL_XC_e_NuMber + '' +
								"&preset_dtmf_a=" + CalL_XC_a_Dtmf + '' +
								"&preset_dtmf_b=" + CalL_XC_b_Dtmf + '' +
								webform_session;
								
								var regWFspace = new RegExp(" ","ig");
								web_form_vars = web_form_vars.replace(regWF, '');
								var regWF = new RegExp("\\`|\\~|\\:|\\;|\\#|\\'|\\\"|\\{|\\}|\\(|\\)|\\*|\\^|\\%|\\$|\\!|\\%|\\r|\\t|\\n","ig");
								web_form_vars = web_form_vars.replace(regWFspace, '+');
								web_form_vars = web_form_vars.replace(regWF, '');

								if ( (script_recording_delay > 0) && ( (LIVE_campaign_recording == 'ALLCALLS') || (LIVE_campaign_recording == 'ALLFORCE') ) )
									{
									delayed_script_load = 'YES';
									RefresHScript('CLEAR');
									}
								else
									{
									load_script_contents();
									}
								}

							if (get_call_launch == 'SCRIPT')
								{
								if (delayed_script_load == 'YES')
									{
									load_script_contents();
									}
									//alert(2);
								ScriptPanelToFront();
								}

							if (get_call_launch == 'WEBFORM')
								{//去电弹屏
								 $("#webaddress").attr("src",TEMP_VDIC_web_form_address);
								 $("#dialog-confirm").dialog(
								 {
								     
								     width:800,
										 //minHeight:320,
										 height:500,
										
								   
								 }); 
								//window.open(TEMP_VDIC_web_form_address, web_form_target, 'toolbar=1,scrollbars=1,location=1,statusbar=1,menubar=1,resizable=1,width=640,height=450');
								}
							if (get_call_launch == 'WEBFORMTWO')
								{
								window.open(TEMP_VDIC_web_form_address_two, web_form_target, 'toolbar=1,scrollbars=1,location=1,statusbar=1,menubar=1,resizable=1,width=640,height=450');
								}

							}
						else
							{
							reselect_preview_dial = 1;
							}
						}
						xmlhttp = null;
						CollectGarbage();
					}
				}
			delete xmlhttp;

			if (document.vicidial_form.LeadPreview.checked==false)
				{
				active_group_alias='';
				cid_choice='';
				prefix_choice='';
				agent_dialed_number='';
				agent_dialed_type='';
				CalL_ScripT_id='';
				}
			}
		}


// ################################################################################
// Send the Manual Dial Skip
	function ManualDialSkip()
		{
		if (manual_dial_in_progress==1)
			{
			alert('您不能跳过回拨或是人工拨号，您必须拨打本次记录');
			}
		else
			{
			if (dial_method == "INBOUND_MAN")
				{
				auto_dial_level=starting_dial_level;
				//Mod by fnatic start
                if(Dial_Next_Display=='Y')
					{
				document.getElementById("DiaLControl").innerHTML = "<IMG SRC=\"../agc/images/cn/vdc_LB_pause_OFF_cn.gif\" border=0 alt=\" 暂停 \"><IMG SRC=\"../agc/images/cn/vdc_LB_resume_OFF_cn.gif\" border=0 alt=\"恢复\"><BR><IMG SRC=\"../agc/images/cn/vdc_LB_dialnextnumber_OFF_cn.gif\" border=0 alt=\"拨下一个号码\">";
					}
				else
					{
				document.getElementById("DiaLControl").innerHTML = "<IMG SRC=\"../agc/images/cn/vdc_LB_pause_OFF_cn.gif\" border=0 alt=\" 暂停 \"><IMG SRC=\"../agc/images/cn/vdc_LB_resume_OFF_cn.gif\" border=0 alt=\"恢复\">";				   
				    }
				//Mod by fnatic end
				}
			else
				{
				//Mod by fnatic start
				if(Dial_Next_Display=='Y')
					{
				document.getElementById("DiaLControl").innerHTML = "<IMG SRC=\"../agc/images/cn/vdc_LB_dialnextnumber_OFF_cn.gif\" border=0 alt=\"拨下一个号码\">";
					}
				else{
				document.getElementById("DiaLControl").innerHTML = "";				
				    }
				//Mod by fnatic end
				}

			var xmlhttp=false;
			/*@cc_on @*/
			/*@if (@_jscript_version >= 5)
			// JScript gives us Conditional compilation, we can cope with old IE versions.
			// and security blocked creation of the objects.
			 try {
			  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
			 } catch (e) {
			  try {
			   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			  } catch (E) {
			   xmlhttp = false;
			  }
			 }
			@end @*/
			if (!xmlhttp && typeof XMLHttpRequest!='undefined')
				{
				xmlhttp = new XMLHttpRequest();
				}
			if (xmlhttp) 
				{ 
				manDiaLskip_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=manDiaLskip&conf_exten=" + session_id + "&user=" + user + "&pass=" + pass + "&lead_id=" + document.vicidial_form.lead_id.value + "&stage=" + previous_dispo + "&called_count=" + previous_called_count;
				xmlhttp.open('POST', 'vdc_db_query.php'); 
				xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
				xmlhttp.send(manDiaLskip_query); 
				xmlhttp.onreadystatechange = function() 
					{ 
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
						{
						var MDSnextResponse = null;
					//	alert(manDiaLskip_query);
					//	alert(xmlhttp.responseText);
						MDSnextResponse = xmlhttp.responseText;

						var MDSnextResponse_array=MDSnextResponse.split("\n");
						MDSnextCID = MDSnextResponse_array[0];
						if (MDSnextCID == "LEAD NOT REVERTED")
							{
							alert("错误！leads尚未恢复！:\n" + MDSnextResponse);
							}
						else
							{
							document.vicidial_form.lead_id.value		='';
							document.vicidial_form.vendor_lead_code.value='';
							document.vicidial_form.list_id.value		='';
							document.vicidial_form.gmt_offset_now.value	='';
							document.vicidial_form.phone_code.value		='';
							if ( (disable_alter_custphone=='Y') || (disable_alter_custphone=='HIDE') )
								{
								var tmp_pn = document.getElementById("phone_numberDISP");
								tmp_pn.innerHTML			= ' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ';
								}
							document.vicidial_form.phone_number.value	='';
							document.vicidial_form.title.value			='';
							document.vicidial_form.first_name.value		='';
							document.vicidial_form.middle_initial.value	='';
							document.vicidial_form.last_name.value		='';
							document.vicidial_form.address1.value		='';
							document.vicidial_form.address2.value		='';
							document.vicidial_form.address3.value		='';
							document.vicidial_form.city.value			='';
							document.vicidial_form.state.value			='';
							document.vicidial_form.province.value		='';
							document.vicidial_form.postal_code.value	='';
							document.vicidial_form.country_code.value	='';
							document.vicidial_form.gender.value			='';
							document.vicidial_form.date_of_birth.value	='';
							document.vicidial_form.alt_phone.value		='';
							document.vicidial_form.email.value			='';
							document.vicidial_form.security_phrase.value='';
							document.vicidial_form.comments.value		='';
							document.vicidial_form.called_count.value	='';
							document.vicidial_form.rank.value			='';
							document.vicidial_form.owner.value			='';
							VDCL_group_id = '';
							fronter = '';
							previous_called_count = '';
							previous_dispo = '';
							custchannellive=1;

							document.getElementById("MainStatuSSpan").innerHTML = "<font style=\"font-family:'宋体';font-size:12px;\">该潜在客户已跳过，请拨打下一个！</font>";

							if (dial_method == "INBOUND_MAN")
								{
								//Mod by fnatic start
								if(Dial_Next_Display=='Y')
									{
								document.getElementById("DiaLControl").innerHTML = "<IMG SRC=\"../agc/images/cn/vdc_LB_pause_OFF_cn.gif\" border=0 alt=\" 暂停 \"><a href=\"#\" onclick=\"AutoDial_ReSume_PauSe('VDADready');\"><IMG SRC=\"../agc/images/cn/vdc_LB_resume_cn.gif\" border=0 alt=\"恢复\"></a><BR><a href=\"#\" onclick=\"ManualDialNext('','','','','','0');\"><IMG SRC=\"../agc/images/cn/vdc_LB_dialnextnumber_cn.gif\" border=0 alt=\"拨下一个号码\"></a>";
									}
								else
									{
								document.getElementById("DiaLControl").innerHTML = "<IMG SRC=\"../agc/images/cn/vdc_LB_pause_OFF_cn.gif\" border=0 alt=\" 暂停 \"><a href=\"#\" onclick=\"AutoDial_ReSume_PauSe('VDADready');\"><IMG SRC=\"../agc/images/cn/vdc_LB_resume_cn.gif\" border=0 alt=\"恢复\"></a>";								
								    }
								//Mod by fnatic end
								}
							else
								{
								//Mod by fnatic start
								if(Dial_Next_Display=='Y')
									{
								document.getElementById("DiaLControl").innerHTML = "<a href=\"#\" onclick=\"ManualDialNext('','','','','','0');\"><IMG SRC=\"../agc/images/cn/vdc_LB_dialnextnumber_cn.gif\" border=0 alt=\"拨下一个号码\"></a>";
									}
								else
									{
									document.getElementById("DiaLControl").innerHTML = "";							
								    }
								//Mod by fnatic end
								}
							}
						xmlhttp = null;
						CollectGarbage();
						}
					}
				delete xmlhttp;
				active_group_alias='';
				cid_choice='';
				prefix_choice='';
				agent_dialed_number='';
				agent_dialed_type='';
				CalL_ScripT_id='';
				}
			}
		}


// ################################################################################
// Send the Manual Dial Only - dial the previewed lead
	function ManualDialOnly(taskaltnum)
		{
		inOUT = 'OUT';
		alt_dial_status_display = 0;
		all_record = 'NO';
		all_record_count=0;
		var usegroupalias=0;
		if (taskaltnum == 'ALTPhonE')
			{
			var manDiaLonly_num = document.vicidial_form.alt_phone.value;
			lead_dial_number = document.vicidial_form.alt_phone.value;
			dialed_number = lead_dial_number;
			dialed_label = 'ALT';
			WebFormRefresH('');
			}
		else
			{
			if (taskaltnum == 'AddresS3')
				{
				var manDiaLonly_num = document.vicidial_form.address3.value;
				lead_dial_number = document.vicidial_form.address3.value;
				dialed_number = lead_dial_number;
				dialed_label = 'ADDR3';
				WebFormRefresH('');
				}
			else
				{
				var manDiaLonly_num = document.vicidial_form.phone_number.value;
				lead_dial_number = document.vicidial_form.phone_number.value;
				dialed_number = lead_dial_number;
				dialed_label = 'MAIN';
				WebFormRefresH('');
				}
			}
		if (dialed_label == 'ALT')
			{document.getElementById("CusTInfOSpaN").innerHTML = " <B> 其它拨打号码: ALT </B>";}
		if (dialed_label == 'ADDR3')
			{document.getElementById("CusTInfOSpaN").innerHTML = " <B> 其它拨打号码: 地址3 </B>";}
		var REGalt_dial = new RegExp("X","g");
		if (dialed_label.match(REGalt_dial))
			{
			document.getElementById("CusTInfOSpaN").innerHTML = " <B> 其它拨打号码: " + dialed_label + "</B>";
			document.getElementById("EAcommentsBoxA").innerHTML = "<b>电话区号和号码: </b>" + EAphone_code + " " + EAphone_number;

			var EAactive_link = '';
			if (EAalt_phone_active == 'Y') 
				{EAactive_link = "<a href=\"#\" onclick=\"alt_phone_change('" + EAphone_number + "','" + EAalt_phone_count + "','" + document.vicidial_form.lead_id.value + "','N');\">变更此电话号码为未启动</a>";}
			else
				{EAactive_link = "<a href=\"#\" onclick=\"alt_phone_change('" + EAphone_number + "','" + EAalt_phone_count + "','" + document.vicidial_form.lead_id.value + "','Y');\">变更此电话号码为启动</a>";}

			document.getElementById("EAcommentsBoxB").innerHTML = "<b>启动: </b>" + EAalt_phone_active + "<BR>" + EAactive_link;
			document.getElementById("EAcommentsBoxC").innerHTML = "<b>Alt Count:</b>" + EAalt_phone_count;
			document.getElementById("EAcommentsBoxD").innerHTML = "<b>注意: </b><br>" + EAalt_phone_notes;
			showDiv('EAcommentsBox');
			}

		var xmlhttp=false;
		/*@cc_on @*/
		/*@if (@_jscript_version >= 5)
		// JScript gives us Conditional compilation, we can cope with old IE versions.
		// and security blocked creation of the objects.
		 try {
		  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		 } catch (e) {
		  try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  } catch (E) {
		   xmlhttp = false;
		  }
		 }
		@end @*/
		if (!xmlhttp && typeof XMLHttpRequest!='undefined')
			{
			xmlhttp = new XMLHttpRequest();
			}
		if (xmlhttp) 
			{ 
			if (cid_choice.length > 3) 
				{
				var call_cid = cid_choice;
				usegroupalias=1;
				}
			else 
				{var call_cid = campaign_cid;}
			if (prefix_choice.length > 0)
				{var call_prefix = prefix_choice;}
			else
				{var call_prefix = dial_prefix;}

			manDiaLonly_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=manDiaLonly&conf_exten=" + session_id + "&user=" + user + "&pass=" + pass + "&lead_id=" + document.vicidial_form.lead_id.value + "&phone_number=" + manDiaLonly_num + "&phone_code=" + document.vicidial_form.phone_code.value + "&campaign=" + campaign + "&ext_context=" + ext_context + "&dial_timeout=" + dial_timeout + "&dial_prefix=" + call_prefix + "&campaign_cid=" + call_cid + "&omit_phone_code=" + omit_phone_code + "&usegroupalias=" + usegroupalias + "&account=" + active_group_alias + "&agent_dialed_number=" + agent_dialed_number + "&agent_dialed_type=" + agent_dialed_type + "&dial_method=" + dial_method + "&agent_log_id=" + agent_log_id;
			xmlhttp.open('POST', 'vdc_db_query.php'); 
			xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
			xmlhttp.send(manDiaLonly_query);
			xmlhttp.onreadystatechange = function() 
				{ 
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
					{
					var MDOnextResponse = null;
			//		alert(manDiaLonly_query);
			//		alert(xmlhttp.responseText);
					MDOnextResponse = xmlhttp.responseText;

					var MDOnextResponse_array=MDOnextResponse.split("\n");
					MDnextCID =		MDOnextResponse_array[0];
					agent_log_id =	MDOnextResponse_array[1];
					if (MDnextCID == " CALL NOT PLACED") //cn bug
						{
						alert("错误！电话未置入！:\n" + MDOnextResponse);
						}
					else
						{
						LasTCID =	MDOnextResponse_array[0];
						MD_channel_look=1;
						custchannellive=1;

						var dispnum = manDiaLonly_num;
						var status_display_number = phone_number_format(dispnum);

						if (alt_dial_status_display=='0')
							{
						//	document.getElementById("MainStatuSSpan").innerHTML = " 拨号中: " + status_display_number + " UID: " + MDnextCID + " &nbsp; 进入闲置状态...";
							document.getElementById("MainStatuSSpan").innerHTML = " 拨号中: " + status_display_number + " UID: " + MDnextCID + " &nbsp; 进入闲置状态...";
							
							document.getElementById("HangupControl").innerHTML = "<a href=\"#\" onclick=\"dialedcall_send_hangup();\"><IMG SRC=\"../agc/images/cn/vdc_LB_hangupcustomer_cn.gif\" border=0 alt=\"挂断\"></a>";
							}
						if ( (LIVE_campaign_recording == 'ALLCALLS') || (LIVE_campaign_recording == 'ALLFORCE') )
							{all_record = 'YES';}

						if ( (view_scripts == 1) && (campaign_script.length > 0) )
							{
							web_form_vars = 
							"&lead_id=" + document.vicidial_form.lead_id.value + 
							"&vendor_id=" + document.vicidial_form.vendor_lead_code.value + 
							"&list_id=" + document.vicidial_form.list_id.value + 
							"&gmt_offset_now=" + document.vicidial_form.gmt_offset_now.value + 
							"&phone_code=" + document.vicidial_form.phone_code.value + 
							"&phone_number=" + document.vicidial_form.phone_number.value + 
							"&title=" + document.vicidial_form.title.value + 
							"&first_name=" + document.vicidial_form.first_name.value + 
							"&middle_initial=" + document.vicidial_form.middle_initial.value + 
							"&last_name=" + document.vicidial_form.last_name.value + 
							"&address1=" + document.vicidial_form.address1.value + 
							"&address2=" + document.vicidial_form.address2.value + 
							"&address3=" + document.vicidial_form.address3.value + 
							"&city=" + document.vicidial_form.city.value + 
							"&state=" + document.vicidial_form.state.value + 
							"&province=" + document.vicidial_form.province.value + 
							"&postal_code=" + document.vicidial_form.postal_code.value + 
							"&country_code=" + document.vicidial_form.country_code.value + 
							"&gender=" + document.vicidial_form.gender.value + 
							"&date_of_birth=" + document.vicidial_form.date_of_birth.value + 
							"&alt_phone=" + document.vicidial_form.alt_phone.value + 
							"&email=" + document.vicidial_form.email.value + 
							"&security_phrase=" + document.vicidial_form.security_phrase.value + 
							"&comments=" + document.vicidial_form.comments.value + 
							"&user=" + user + 
							"&pass=" + pass + 
							"&campaign=" + campaign + 
							"&phone_login=" + phone_login + 
							"&original_phone_login=" + original_phone_login +
							"&phone_pass=" + phone_pass + 
							"&fronter=" + fronter + 
							"&closer=" + user + 
							"&group=" + group + 
							"&channel_group=" + group + 
							"&SQLdate=" + SQLdate + 
							"&epoch=" + UnixTime + 
							"&uniqueid=" + document.vicidial_form.uniqueid.value + 
							"&customer_zap_channel=" + lastcustchannel + 
							"&customer_server_ip=" + lastcustserverip +
							"&server_ip=" + server_ip + 
							"&SIPexten=" + extension + 
							"&session_id=" + session_id + 
							"&phone=" + document.vicidial_form.phone_number.value + 
							"&parked_by=" + document.vicidial_form.lead_id.value +
							"&dispo=" + LeaDDispO + '' +
							"&dialed_number=" + dialed_number + '' +
							"&dialed_label=" + dialed_label + '' +
							"&source_id=" + source_id + '' +
							"&rank=" + document.vicidial_form.rank.value + '' +
							"&owner=" + document.vicidial_form.owner.value + '' +
							"&camp_script=" + campaign_script + '' +
							"&in_script=" + CalL_ScripT_id + '' +
							"&script_width=" + script_width + '' +
							"&script_height=" + script_height + '' +
							"&fullname=" + LOGfullname + '' +
							"&recording_filename=" + recording_filename + '' +
							"&recording_id=" + recording_id + '' +
							"&user_custom_one=" + VU_custom_one + '' +
							"&user_custom_two=" + VU_custom_two + '' +
							"&user_custom_three=" + VU_custom_three + '' +
							"&user_custom_four=" + VU_custom_four + '' +
							"&user_custom_five=" + VU_custom_five + '' +
							"&preset_number_a=" + CalL_XC_a_NuMber + '' +
							"&preset_number_b=" + CalL_XC_b_NuMber + '' +
							"&preset_number_c=" + CalL_XC_c_NuMber + '' +
							"&preset_number_d=" + CalL_XC_d_NuMber + '' +
							"&preset_number_e=" + CalL_XC_e_NuMber + '' +
							"&preset_dtmf_a=" + CalL_XC_a_Dtmf + '' +
							"&preset_dtmf_b=" + CalL_XC_b_Dtmf + '' +
							webform_session;
							
							var regWFspace = new RegExp(" ","ig");
							web_form_vars = web_form_vars.replace(regWF, '');
							var regWF = new RegExp("\\`|\\~|\\:|\\;|\\#|\\'|\\\"|\\{|\\}|\\(|\\)|\\*|\\^|\\%|\\$|\\!|\\%|\\r|\\t|\\n","ig");
							web_form_vars = web_form_vars.replace(regWFspace, '+');
							web_form_vars = web_form_vars.replace(regWF, '');

							if ( (script_recording_delay > 0) && ( (LIVE_campaign_recording == 'ALLCALLS') || (LIVE_campaign_recording == 'ALLFORCE') ) )
								{
								delayed_script_load = 'YES';
								RefresHScript('CLEAR');
								}
							else
								{
								load_script_contents();
								}
							}

						if (get_call_launch == 'SCRIPT')
							{
							if (delayed_script_load == 'YES')
								{
								load_script_contents();
								}
								//alert(3);
							ScriptPanelToFront();
							}
						if (get_call_launch == 'WEBFORM')
							{
							window.open(TEMP_VDIC_web_form_address, web_form_target, 'toolbar=1,scrollbars=1,location=1,statusbar=1,menubar=1,resizable=1,width=640,height=450');
							}
						if (get_call_launch == 'WEBFORMTWO')
							{
							window.open(TEMP_VDIC_web_form_address_two, web_form_target, 'toolbar=1,scrollbars=1,location=1,statusbar=1,menubar=1,resizable=1,width=640,height=450');
							}
						}
						xmlhttp = null;
						CollectGarbage();
					}
				}
			delete xmlhttp;
			active_group_alias='';
			cid_choice='';
			prefix_choice='';
			agent_dialed_number='';
			agent_dialed_type='';
			CalL_ScripT_id='';
			}

		}


//begin add by pie 20130411 for check Agent MAX Pause Counts
	function check_max_pause_count()
	{
		var maxpauses="CheckMaxPauses";
//		var isCheckMaxPause = 0;
		var xmlhttp=false;
		try
		{
			xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
		} catch(e)
		{
			try
			{
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}catch(e)
			{
				xmlhttp=false;
			}
		}
		
		if(!xmlhttp && typeof XMLHttpRequest!='undefined')
		{
			xmlhttp=new XMLHttpRequest();
		}

		if(xmlhttp)
		{
			maxPauseCount_query="server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&campaign=" + campaign + "&ACTION="+maxpauses;
//			alert(maxPauseCount_query);
//			exit;
			xmlhttp.open('POST','vdc_db_query.php',true);
			xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded;charset=UTF-8');
			xmlhttp.send(maxPauseCount_query);
			xmlhttp.onreadystatechange=function()
			{
				if(xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					check_result='null';
					check_result=xmlhttp.responseText;
//					alert(check_result);
					if(check_result!='null')
					{
						select_res=confirm("当前暂停人数过多，再坚持一下，如有急事请点击确定，否则请取消");
// 						alert(select_res);
						if(select_res==true)
						{
							AutoDial_ReSume_PauSe('VDADpause');
						}
						else
						{
							return false;
						}
					}
					else
					{
						AutoDial_ReSume_PauSe('VDADpause');
					}
					xmlhttp=null;
					CollectGarbage();
				}
			}
			delete xmlhttp;
		}
//		alert("test");
//		var statustimer = setTimeout("check_max_pause_count()", 1000);
	}
//	onload=check_max_pause_count;
//end add 20130411
		
// ################################################################################
// Set the client to READY and start looking for calls (VDADready, VDADpause)
	function AutoDial_ReSume_PauSe(taskaction,taskagentlog,taskwrapup,taskstatuschange,temp_reason)
		{
		if (taskaction == 'VDADready')
			{
			agent_available_reset_check = 0;
			agent_available_reset_count = 0;		
			
			AutoDialCheckStatus = 3;
			//Add by fnatic start
            if(Xfer_Waiting_Web_Play_Music_Enable=='Y')
				{
			      document.getElementById('snd').src="";//一恢复就清除背景音乐
				}
			//Add by fnatic end 
			VDRP_stage = 'READY';
			if (INgroupCOUNT > 0)
				{
				if (VICIDiaL_closer_blended == 0)
					{VDRP_stage = 'CLOSER';}
				else 
					{VDRP_stage = 'READY';}
				}
			AutoDialReady = 1;
			AutoDialWaiting = 1;
			if (dial_method == "INBOUND_MAN")
				{
				auto_dial_level=starting_dial_level;
				
				//Mod by fnatic start
                if(Dial_Next_Display=='Y')
					{
				document.getElementById("DiaLControl").innerHTML = "<a href=\"#\" onclick=\"check_max_pause_count();\"><IMG SRC=\"../agc/images/cn/vdc_LB_pause_cn.gif\" border=0 alt=\" 暂停 \"></a><IMG SRC=\"../agc/images/cn/vdc_LB_resume_OFF_cn.gif\" border=0 alt=\"恢复\"></a><BR><a href=\"#\" onclick=\"ManualDialNext('','','','','','0');\"><IMG SRC=\"../agc/images/cn/vdc_LB_dialnextnumber_cn.gif\" border=0 alt=\"挂断\"></a>";
				    }
				else
					{
				document.getElementById("DiaLControl").innerHTML = "<a href=\"#\" onclick=\"check_max_pause_count();\"><IMG SRC=\"../agc/images/cn/vdc_LB_pause_cn.gif\" border=0 alt=\" 暂停 \"></a><IMG SRC=\"../agc/images/cn/vdc_LB_resume_OFF_cn.gif\" border=0 alt=\"恢复\"></a>";								
				    }
				//Mod by fnatic end

				}
			else
				{
				document.getElementById("DiaLControl").innerHTML = DiaLControl_auto_HTML_ready;
				}
			//if(agent_pause_codes_active=='FORCE' && Default_Pause_Code_Enable=="Y")
			if(agent_pause_codes_active=='FORCE' || agent_pause_codes_active=='Y')
				 {
				   document.getElementById("last_pause_code").innerHTML="";
				 }
			document.getElementById("status_code").innerHTML="可用";
			if(Pause_Code_Selected_Link_Display=='Y' && (agent_pause_codes_active=='FORCE' || agent_pause_codes_active=="Y")){
				document.getElementById("PauseCodeLinkSpan").style.display="none";
			}
			}
		else
			{
			AutoDialCheckStatus = 4;
			VDRP_stage = 'PAUSED';
			AutoDialReady = 0;
			AutoDialWaiting = 0;
			pause_code_counter = 0;

			if (dial_method == "INBOUND_MAN")
				{
				auto_dial_level=starting_dial_level;
                
				//Add by fnatic start
				if(Dial_Next_Display=='Y')
					{
				document.getElementById("DiaLControl").innerHTML = "<IMG SRC=\"../agc/images/cn/vdc_LB_pause_OFF_cn.gif\" border=0 alt=\" 暂停 \"><a href=\"#\" onclick=\"AutoDial_ReSume_PauSe('VDADready');\"><IMG SRC=\"../agc/images/cn/vdc_LB_resume_cn.gif\" border=0 alt=\"恢复\"></a><BR><a href=\"#\" onclick=\"ManualDialNext('','','','','','0');\"><IMG SRC=\"../agc/images/cn/vdc_LB_dialnextnumber_cn.gif\" border=0 alt=\"挂断\"></a>";
					}
				else
					{
					//alert(AutopauseControlCount);
					if(AutopauseControlCount >=1){
					AutopauseControlCount ++;
					if(AutopauseControlCount ==4){
					//alert(AutopauseControlCount);
					document.getElementById("DiaLControl").innerHTML = "<IMG SRC=\"../agc/images/vdc_LB_pause_OFF_cn.gif\" border=0 alt=\" 暂停 \"><a href=\"#\" onclick=\"AutoDial_ReSume_PauSe('VDADready');\"><IMG SRC=\"../agc/images/vdc_LB_resume_cn.gif\" border=0 alt=\"恢复\"></a>";				   
					AutopauseControlCount = 0;
					 }
					 }if(AutopauseControlCount ==0){
					document.getElementById("DiaLControl").innerHTML = "<IMG SRC=\"../agc/images/vdc_LB_pause_OFF_cn.gif\" border=0 alt=\" 暂停 \"><a href=\"#\" onclick=\"AutoDial_ReSume_PauSe('VDADready');\"><IMG SRC=\"../agc/images/vdc_LB_resume_cn.gif\" border=0 alt=\"恢复\"></a>";				   
					}}
				//Add by fnatic end
			   
				}
			else
				{
				document.getElementById("DiaLControl").innerHTML = DiaLControl_auto_HTML;
				}

			if ( (agent_pause_codes_active=='FORCE') && (temp_reason != 'LOGOUT') && (temp_reason != 'REQUEUE') && (temp_reason != 'DIALNEXT') )
				{   
		        // PauseCodeSelectContent_create(); 
 				}
			if(AutoDialReSumeStatus == 1){
				document.getElementById("status_code").innerHTML="通话";
				if(Pause_Code_Selected_Link_Display=='Y' && (agent_pause_codes_active=='FORCE' || agent_pause_codes_active=="Y")){
					document.getElementById("PauseCodeLinkSpan").style.display="none";
				}
			}else{
				document.getElementById("status_code").innerHTML="暂停";
				if(Pause_Code_Selected_Link_Display=='Y' && (agent_pause_codes_active=='FORCE' || agent_pause_codes_active=="Y")){
					document.getElementById("PauseCodeLinkSpan").style.display="";
				}
			}
				
			}
		
		var xmlhttp=false;
		/*@cc_on @*/
		/*@if (@_jscript_version >= 5)
		// JScript gives us Conditional compilation, we can cope with old IE versions.
		// and security blocked creation of the objects.
		 try {
		  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		 } catch (e) {
		  try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  } catch (E) {
		   xmlhttp = false;
		  }
		 }
		@end @*/
		if (!xmlhttp && typeof XMLHttpRequest!='undefined')
			{
			xmlhttp = new XMLHttpRequest();
			}
		if (xmlhttp) 
			{ 
			 autoDiaLready_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=" + taskaction + "&user=" + user + "&pass=" + pass + "&stage=" + VDRP_stage + "&agent_log_id=" + agent_log_id + "&agent_log=" + taskagentlog + "&wrapup=" + taskwrapup + "&campaign=" + campaign + "&dial_method" + dial_method + "&comments=" + taskstatuschange

			//alert(autoDiaLready_query);
			//alert("PAUSE|||READT|||:"+autoDiaLready_query);
			xmlhttp.open('POST', 'vdc_db_query.php'); 
			xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
			xmlhttp.send(autoDiaLready_query); 
			xmlhttp.onreadystatechange = function() 
				{ 
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
					{

               //Add by fnatic start
					if (taskaction != 'VDADready' && (agent_pause_codes_active=='FORCE'||agent_pause_codes_active=='Y') && temp_reason != 'LOGOUT' && temp_reason != 'REQUEUE' && temp_reason != 'DIALNEXT')
						{
						  //modify by bear 当设置为Y时在电话小结时能正常显示暂停码
						  if(agent_pause_codes_active=='Y'){
									 Cortorl_Pausecode_Insert_Db = 'Y';
									 PauseCodeSelect_submit(document.getElementById("PauseCodeSelection").value);
									 Original_Pause_Code = document.getElementById("PauseCodeSelection").value;
									 document.getElementById("PauseCodeSelection").value='';
						  }else{
							  if(Default_Pause_Code_Enable=='Y')
								{
								 if(Cortorl_Pausecode_Insert_Db=='N')
								   {
									 Cortorl_Pausecode_Insert_Db='Y';
									 PauseCodeSelect_submit(document.getElementById("PauseCodeSelection").value);
									 document.getElementById("PauseCodeSelection").value='';
								   }
								 else
								  { 
                  PauseCodeSelect_submit(Default_Pause_Code);
								  $('#PauseCodeSelectBoxDIV').dialog('open');
									
									
									Undefined_Dialog_Status = 'Y';
									//PauseCodeSelectContent_create(); 
								  }
								}
							  else
								{ 
								  $('#PauseCodeSelectBoxDIV').dialog('open');
								  Undefined_Dialog_Status = 'Y';
								  //PauseCodeSelectContent_create();
								}
						  }

						}
					
		       //Add by fnatic end
				    
					var check_dispo = null;
					check_dispo = xmlhttp.responseText;
					var check_DS_array=check_dispo.split("\n");
					//alert(xmlhttp.responseText + "\n|" + check_DS_array[1] + "\n|" + check_DS_array[2] + "|");
					if (check_DS_array[1] == 'Next agent_log_id:')
						{
						agent_log_id = check_DS_array[2];
						//Add by fnatic start
						//document.getElementById("last_pause_code").innerHTML="";
						//Add by fnatic end
						}
						xmlhttp = null;
						CollectGarbage();
					}
				}
			delete xmlhttp;
			}
		return agent_log_id;
		}
	
	function changePauseCode(){
		$('#PauseCodeSelectBoxDIV').dialog('open');
		Undefined_Dialog_Status = 'Y';
		//PauseCodeSelectContent_create();
	}
	function closePauseCodeSelect(){
		$('#PauseCodeSelectBoxDIV').dialog('close');
	}
	//当外拔时如果未暂停时调用
	function AutoDial_PauSe_Default(pausecode_temp,taskaction,taskagentlog,taskwrapup,taskstatuschange,temp_reason)
		{
		if (taskaction == 'VDADready')
			{

			}
		else
			{
			VDRP_stage = 'PAUSED';
			AutoDialReady = 0;
			AutoDialWaiting = 0;
			pause_code_counter = 0;

			if (dial_method == "INBOUND_MAN")
				{
				auto_dial_level=starting_dial_level;
                
				//Add by fnatic start
				if(Dial_Next_Display=='Y')
					{
				document.getElementById("DiaLControl").innerHTML = "<IMG SRC=\"../agc/images/cn/vdc_LB_pause_OFF_cn.gif\" border=0 alt=\" 暂停 \"><a href=\"#\" onclick=\"AutoDial_ReSume_PauSe('VDADready');\"><IMG SRC=\"../agc/images/cn/vdc_LB_resume_cn.gif\" border=0 alt=\"恢复\"></a><BR><a href=\"#\" onclick=\"ManualDialNext('','','','','','0');\"><IMG SRC=\"../agc/images/cn/vdc_LB_dialnextnumber_cn.gif\" border=0 alt=\"挂断\"></a>";
					}
				else
					{
				document.getElementById("DiaLControl").innerHTML = "<IMG SRC=\"../agc/images/cn/vdc_LB_pause_OFF_cn.gif\" border=0 alt=\" 暂停 \"><a href=\"#\" onclick=\"AutoDial_ReSume_PauSe('VDADready');\"><IMG SRC=\"../agc/images/cn/vdc_LB_resume_cn.gif\" border=0 alt=\"恢复\"></a>";				   
				    }
				//Add by fnatic end
			   
				}
			else
				{
				document.getElementById("DiaLControl").innerHTML = DiaLControl_auto_HTML;
				}

			if ( (agent_pause_codes_active=='FORCE') && (temp_reason != 'LOGOUT') && (temp_reason != 'REQUEUE') && (temp_reason != 'DIALNEXT') )
				{   
		        // PauseCodeSelectContent_create(); 
 				}
			document.getElementById("status_code").innerHTML="暂停";
			if(Pause_Code_Selected_Link_Display=='Y' && (agent_pause_codes_active=='FORCE' || agent_pause_codes_active=="Y")){
				document.getElementById("PauseCodeLinkSpan").style.display="";
			}
			}

		var xmlhttp=false;
		/*@cc_on @*/
		/*@if (@_jscript_version >= 5)
		// JScript gives us Conditional compilation, we can cope with old IE versions.
		// and security blocked creation of the objects.
		 try {
		  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		 } catch (e) {
		  try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  } catch (E) {
		   xmlhttp = false;
		  }
		 }
		@end @*/
		if (!xmlhttp && typeof XMLHttpRequest!='undefined')
			{
			xmlhttp = new XMLHttpRequest();
			}
		if (xmlhttp) 
			{ 

			 autoDiaLready_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=" + taskaction + "&user=" + user + "&pass=" + pass + "&stage=" + VDRP_stage + "&agent_log_id=" + agent_log_id + "&agent_log=" + taskagentlog + "&wrapup=" + taskwrapup + "&campaign=" + campaign + "&dial_method" + dial_method + "&comments=" + taskstatuschange

			// alert(autoDiaLready_query);
			//alert("PAUSE|||READT|||:"+autoDiaLready_query);
			xmlhttp.open('POST', 'vdc_db_query.php'); 
			xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
			xmlhttp.send(autoDiaLready_query); 
			xmlhttp.onreadystatechange = function() 
				{ 
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
					{

               //Add by fnatic start
					if (taskaction != 'VDADready' && agent_pause_codes_active=='FORCE' && temp_reason != 'LOGOUT' && temp_reason != 'REQUEUE' && temp_reason != 'DIALNEXT')
						{
							Cortorl_Pausecode_Insert_Db = "Y";
			              	//PauseCodeSelect_submit("Dial");
							PauseCodeSelect_submit(pausecode_temp);
						}
					if (taskaction != 'VDADready' && agent_pause_codes_active=='Y' && temp_reason != 'LOGOUT' && temp_reason != 'REQUEUE' && temp_reason != 'DIALNEXT')
						{
							Cortorl_Pausecode_Insert_Db = "Y";
			              	//PauseCodeSelect_submit("Dial");
							PauseCodeSelect_submit(pausecode_temp);
						}
		       //Add by fnatic end
				    
					var check_dispo = null;
					check_dispo = xmlhttp.responseText;
					var check_DS_array=check_dispo.split("\n");
					//alert(xmlhttp.responseText + "\n|" + check_DS_array[1] + "\n|" + check_DS_array[2] + "|");
					if (check_DS_array[1] == 'Next agent_log_id:')
						{
						agent_log_id = check_DS_array[2];
						//Add by fnatic start
						//document.getElementById("last_pause_code").innerHTML="";
						//Add by fnatic end
						}
						xmlhttp = null;
						CollectGarbage();
					}
				}
			delete xmlhttp;
			}
		return agent_log_id;
		}

// ################################################################################
// Check to see if there is a call being sent from the auto-dialer to agent conf
	function ReChecKCustoMerChaN()
		{
		var xmlhttp=false;
		/*@cc_on @*/
		/*@if (@_jscript_version >= 5)
		// JScript gives us Conditional compilation, we can cope with old IE versions.
		// and security blocked creation of the objects.
		 try {
		  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		 } catch (e) {
		  try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  } catch (E) {
		   xmlhttp = false;
		  }
		 }
		@end @*/
		if (!xmlhttp && typeof XMLHttpRequest!='undefined')
			{
			xmlhttp = new XMLHttpRequest();
			}
		if (xmlhttp) 
			{ 
			recheckVDAI_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&campaign=" + campaign + "&ACTION=VDADREcheckINCOMING" + "&agent_log_id=" + agent_log_id + "&lead_id=" + document.vicidial_form.lead_id.value;
			xmlhttp.open('POST', 'vdc_db_query.php'); 
			xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
			xmlhttp.send(recheckVDAI_query); 
			xmlhttp.onreadystatechange = function() 
				{ 
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
					{
					var recheck_incoming = null;
					recheck_incoming = xmlhttp.responseText;
				//	alert(xmlhttp.responseText);
					var recheck_VDIC_array=recheck_incoming.split("\n");
					if (recheck_VDIC_array[0] == '1')
						{
						var reVDIC_data_VDAC=recheck_VDIC_array[1].split("|");
						if (reVDIC_data_VDAC[3] == lastcustchannel)
							{
						// do nothing
							}
						else
							{
				//	alert("Channel has changed from:\n" + lastcustchannel + '|' + lastcustserverip + "\nto:\n" + reVDIC_data_VDAC[3] + '|' + reVDIC_data_VDAC[4]);
							document.vicidial_form.callchannel.value	= reVDIC_data_VDAC[3];
							lastcustchannel = reVDIC_data_VDAC[3];
							document.vicidial_form.callserverip.value	= reVDIC_data_VDAC[4];
							lastcustserverip = reVDIC_data_VDAC[4];
							custchannellive = 1;
							}
						}
											xmlhttp = null;
						CollectGarbage();
					}
				}
			delete xmlhttp;
			}
		}


// ################################################################################
// pull the script contents sending the webform variables to the script display script
	function load_script_contents()
		{
		var new_script_content = null;
		var xmlhttp=false;
		/*@cc_on @*/
		/*@if (@_jscript_version >= 5)
		// JScript gives us Conditional compilation, we can cope with old IE versions.
		// and security blocked creation of the objects.
		 try {
		  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		 } catch (e) {
		  try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  } catch (E) {
		   xmlhttp = false;
		  }
		 }
		@end @*/
		if (!xmlhttp && typeof XMLHttpRequest!='undefined')
			{
			xmlhttp = new XMLHttpRequest();
			}
		if (xmlhttp) 
			{ 
			NeWscript_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ScrollDIV=1&" + web_form_vars;
			xmlhttp.open('POST', 'vdc_script_display.php');
			xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
			xmlhttp.send(NeWscript_query); 
			xmlhttp.onreadystatechange = function() 
				{ 
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
					{
					new_script_content = xmlhttp.responseText;
					//alert("new_script_content"+new_script_content);
					//alert(4);
					
						xmlhttp = null;
						CollectGarbage();
					}
				}
			delete xmlhttp;
			}
		}


// ################################################################################
// Alternate phone number change
	function alt_phone_change(APCphone,APCcount,APCleadID,APCactive)
		{

		var EAactive_link = '';
		if (APCactive == 'Y') 
			{EAactive_link = "<a href=\"#\" onclick=\"alt_phone_change('" + EAphone_number + "','" + EAalt_phone_count + "','" + document.vicidial_form.lead_id.value + "','N');\">变更此电话号码为未启动</a>";}
		else
			{EAactive_link = "<a href=\"#\" onclick=\"alt_phone_change('" + EAphone_number + "','" + EAalt_phone_count + "','" + document.vicidial_form.lead_id.value + "','Y');\">变更此电话号码为启动</a>";}

		document.getElementById("EAcommentsBoxB").innerHTML = "<b>启动: </b>" + EAalt_phone_active + "<BR>" + EAactive_link;

		var xmlhttp=false;
		/*@cc_on @*/
		/*@if (@_jscript_version >= 5)
		// JScript gives us Conditional compilation, we can cope with old IE versions.
		// and security blocked creation of the objects.
		 try {
		  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		 } catch (e) {
		  try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  } catch (E) {
		   xmlhttp = false;
		  }
		 }
		@end @*/
		if (!xmlhttp && typeof XMLHttpRequest!='undefined')
			{
			xmlhttp = new XMLHttpRequest();
			}
		if (xmlhttp) 
			{ 
			APC_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&campaign=" + campaign + "&ACTION=alt_phone_change" + "&phone_number=" + APCphone + "&lead_id=" + APCleadID + "&called_count=" + APCcount + "&stage=" + APCactive;
			xmlhttp.open('POST', 'vdc_db_query.php'); 
			xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
			xmlhttp.send(APC_query); 
			xmlhttp.onreadystatechange = function() 
				{ 
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
					{
			//		alert(xmlhttp.responseText);
									xmlhttp = null;
						CollectGarbage();
					}
				}
			delete xmlhttp;
			}
		}


// ################################################################################
// Check to see if there is a call being sent from the auto-dialer to agent conf
	function check_for_auto_incoming()
		{
		if (typeof(xmlhttprequestcheckauto) == "undefined") 
			{
			all_record = 'NO';
			all_record_count=0;
			document.vicidial_form.lead_id.value = '';
			var xmlhttprequestcheckauto=false;
			/*@cc_on @*/
			/*@if (@_jscript_version >= 5)
			// JScript gives us Conditional compilation, we can cope with old IE versions.
			// and security blocked creation of the objects.
			 try {
			  xmlhttprequestcheckauto = new ActiveXObject("Msxml2.XMLHTTP");
			 } catch (e) {
			  try {
			   xmlhttprequestcheckauto = new ActiveXObject("Microsoft.XMLHTTP");
			  } catch (E) {
			   xmlhttprequestcheckauto = false;
			  }
			 }
			@end @*/
			if (!xmlhttprequestcheckauto && typeof XMLHttpRequest!='undefined')
				{
				xmlhttprequestcheckauto = new XMLHttpRequest();
				}
			if (xmlhttprequestcheckauto) 
				{ 
				checkVDAI_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&campaign=" + campaign + "&ACTION=VDADcheckINCOMING" + "&agent_log_id=" + agent_log_id;
				xmlhttprequestcheckauto.open('POST', 'vdc_db_query.php'); 
				xmlhttprequestcheckauto.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
				xmlhttprequestcheckauto.send(checkVDAI_query); 
				xmlhttprequestcheckauto.onreadystatechange = function() 
					{ 
					if (xmlhttprequestcheckauto.readyState == 4 && xmlhttprequestcheckauto.status == 200) 
						{
						var check_incoming = null;
						check_incoming = xmlhttprequestcheckauto.responseText;
					//	alert(checkVDAI_query);
					//	alert(xmlhttprequestcheckauto.responseText);
						var check_VDIC_array=check_incoming.split("\n");
						if (check_VDIC_array[0] == '1')
							{
							if(CheckOutboundChannelLine2 == 0){
								
							}else{
								outbound_redirect_line2("8301");
							}
							//alert(xmlhttprequestcheckauto.responseText);
							//当有电话进线时自动弹屏
							window.focus();
							AutoDialWaiting = 0;

							var VDIC_data_VDAC=check_VDIC_array[1].split("|");
							VDIC_web_form_address = VICIDiaL_web_form_address
							VDIC_web_form_address_two = VICIDiaL_web_form_address_two
							var VDIC_fronter='';

							var VDIC_data_VDIG=check_VDIC_array[2].split("|");
							if (VDIC_data_VDIG[0].length > 5)
								{VDIC_web_form_address = VDIC_data_VDIG[0];}
							var VDCL_group_name			= VDIC_data_VDIG[1];
							var VDCL_group_color		= VDIC_data_VDIG[2];
							var VDCL_fronter_display	= VDIC_data_VDIG[3];
							 VDCL_group_id				= VDIC_data_VDIG[4];
							 CalL_ScripT_id				= VDIC_data_VDIG[5];
							 CalL_AutO_LauncH			= VDIC_data_VDIG[6];
							 CalL_XC_a_Dtmf				= VDIC_data_VDIG[7];
							 CalL_XC_a_NuMber			= VDIC_data_VDIG[8];
							 CalL_XC_b_Dtmf				= VDIC_data_VDIG[9];
							 CalL_XC_b_NuMber			= VDIC_data_VDIG[10];
							if ( (VDIC_data_VDIG[11].length > 1) && (VDIC_data_VDIG[11] != '---NONE---') )
								{LIVE_default_xfer_group = VDIC_data_VDIG[11];}
							else
								{LIVE_default_xfer_group = default_xfer_group;}

							if ( (VDIC_data_VDIG[12].length > 1) && (VDIC_data_VDIG[12]!='DISABLED') )
								{LIVE_campaign_recording = VDIC_data_VDIG[12];}
							else
								{LIVE_campaign_recording = campaign_recording;}

							if ( (VDIC_data_VDIG[13].length > 1) && (VDIC_data_VDIG[13]!='NONE') )
								{LIVE_campaign_rec_filename = VDIC_data_VDIG[13];}
							else
								{LIVE_campaign_rec_filename = campaign_rec_filename;}

							if ( (VDIC_data_VDIG[14].length > 1) && (VDIC_data_VDIG[14]!='NONE') )
								{LIVE_default_group_alias = VDIC_data_VDIG[14];}
							else
								{LIVE_default_group_alias = default_group_alias;}

							if ( (VDIC_data_VDIG[15].length > 1) && (VDIC_data_VDIG[15]!='NONE') )
								{LIVE_caller_id_number = VDIC_data_VDIG[15];}
							else
								{LIVE_caller_id_number = default_group_alias_cid;}

							if (VDIC_data_VDIG[16].length > 0)
								{LIVE_web_vars = VDIC_data_VDIG[16];}
							else
								{LIVE_web_vars = default_web_vars;}

							if (VDIC_data_VDIG[17].length > 5)
								{VDIC_web_form_address_two = VDIC_data_VDIG[17];}

							var call_timer_action							= VDIC_data_VDIG[18];

							if ( (call_timer_action == 'NONE') || (call_timer_action.length < 2) )
								{
								timer_action = campaign_timer_action;
								timer_action_message = campaign_timer_action_message;
								timer_action_seconds = campaign_timer_action_seconds;
								}
							else
								{
								var call_timer_action_message				= VDIC_data_VDIG[19];
								var call_timer_action_seconds				= VDIC_data_VDIG[20];
								timer_action = call_timer_action;
								timer_action_message = call_timer_action_message;
								timer_action_seconds = call_timer_action_seconds;
								}

							CalL_XC_c_NuMber			= VDIC_data_VDIG[21];
							CalL_XC_d_NuMber			= VDIC_data_VDIG[22];
							CalL_XC_e_NuMber			= VDIC_data_VDIG[23];

							var VDIC_data_VDFR=check_VDIC_array[3].split("|");
							if ( (VDIC_data_VDFR[1].length > 1) && (VDCL_fronter_display == 'Y') )
								{VDIC_fronter = " 来自: " + VDIC_data_VDFR[0] + " " + VDIC_data_VDFR[1] + " " + VDIC_data_VDIG[24];}
							var extension_info = "" + VDIC_data_VDFR[2];
							if(typeof(VDIC_data_VDFR[2]) == "undefined"){
									extension_info = "";
							}
							//alert(check_VDIC_array[3]);
							document.vicidial_form.lead_id.value		= VDIC_data_VDAC[0];
							document.vicidial_form.uniqueid.value		= VDIC_data_VDAC[1];
							last_uniqueid								= VDIC_data_VDAC[1];
							CIDcheck									= VDIC_data_VDAC[2];
							CalLCID										= VDIC_data_VDAC[2];
							document.vicidial_form.callchannel.value	= VDIC_data_VDAC[3];
							lastcustchannel = VDIC_data_VDAC[3];
							document.vicidial_form.callserverip.value	= VDIC_data_VDAC[4];
							lastcustserverip = VDIC_data_VDAC[4];
							document.getElementById("status_code").innerHTML="通话";
							if(Pause_Code_Selected_Link_Display=='Y' && (agent_pause_codes_active=='FORCE' || agent_pause_codes_active=="Y")){
								document.getElementById("PauseCodeLinkSpan").style.display="none";
							}
							if( document.images )
							{
							document.images['livecall'].src = image_livecall_ON.src;
							// + fnatic 20110622
							if(dial_method=='INBOUND_MAN' && inbound_mode=='ring'){client_phone_channel_check_enable=1;}
							}
							if(CheckOutboundChannelLine2 == 0){
								document.getElementById("out_line12").innerHTML = "<input type='text' size=\"15\" maxlength=\"20\" name=\"tel_out_line2\" id=\"tel_out_line2\" value=\"\" ><input type='button' onClick=\"outbound_dial_line2();return false;\" value=\"拨号\" />";
							}
							document.vicidial_form.SecondS.value		= 0;
							document.getElementById("SecondSDISP").innerHTML = '0';

							VD_live_customer_call = 1;
							VD_live_call_secondS = 0;

							// INSERT VICIDIAL_LOG ENTRY FOR THIS DIAL PROCESS
						//	DialLog("start");

							custchannellive=1;

							LasTCID											= check_VDIC_array[4];
							LeaDPreVDispO									= check_VDIC_array[6];
							fronter											= check_VDIC_array[7];
							document.vicidial_form.vendor_lead_code.value	= check_VDIC_array[8];
							document.vicidial_form.list_id.value			= check_VDIC_array[9];
							document.vicidial_form.gmt_offset_now.value		= check_VDIC_array[10];
							document.vicidial_form.phone_code.value			= check_VDIC_array[11];
							if ( (disable_alter_custphone=='Y') || (disable_alter_custphone=='HIDE') )
								{
								var tmp_pn = document.getElementById("phone_numberDISP");
								if (disable_alter_custphone=='Y')
									{
									tmp_pn.innerHTML						= check_VDIC_array[12];
									}
								}
							document.vicidial_form.phone_number.value		= check_VDIC_array[12];
							document.vicidial_form.title.value				= check_VDIC_array[13];
							document.vicidial_form.first_name.value			= check_VDIC_array[14];
							document.vicidial_form.middle_initial.value		= check_VDIC_array[15];
							document.vicidial_form.last_name.value			= check_VDIC_array[16];
							document.vicidial_form.address1.value			= check_VDIC_array[17];
							document.vicidial_form.address2.value			= check_VDIC_array[18];
							document.vicidial_form.address3.value			= check_VDIC_array[19];
							document.vicidial_form.city.value				= check_VDIC_array[20];
							document.vicidial_form.state.value				= check_VDIC_array[21];
							document.vicidial_form.province.value			= check_VDIC_array[22];
							document.vicidial_form.postal_code.value		= check_VDIC_array[23];
							document.vicidial_form.country_code.value		= check_VDIC_array[24];
							document.vicidial_form.gender.value				= check_VDIC_array[25];
							document.vicidial_form.date_of_birth.value		= check_VDIC_array[26];
							document.vicidial_form.alt_phone.value			= check_VDIC_array[27];
							document.vicidial_form.email.value				= check_VDIC_array[28];
							document.vicidial_form.security_phrase.value	= check_VDIC_array[29];
							var REGcommentsNL = new RegExp("!N","g");
							check_VDIC_array[30] = check_VDIC_array[30].replace(REGcommentsNL, "\n");
							document.vicidial_form.comments.value			= check_VDIC_array[30];
							document.vicidial_form.called_count.value		= check_VDIC_array[31];
							CBentry_time									= check_VDIC_array[32];
							CBcallback_time									= check_VDIC_array[33];
							CBuser											= check_VDIC_array[34];
							CBcomments										= check_VDIC_array[35];
							dialed_number									= check_VDIC_array[36];
							dialed_label									= check_VDIC_array[37];
							source_id										= check_VDIC_array[38];
							EAphone_code									= check_VDIC_array[39];
							EAphone_number									= check_VDIC_array[40];
							EAalt_phone_notes								= check_VDIC_array[41];
							EAalt_phone_active								= check_VDIC_array[42];
							EAalt_phone_count								= check_VDIC_array[43];
							document.vicidial_form.rank.value				= check_VDIC_array[44];
							document.vicidial_form.owner.value				= check_VDIC_array[45];
							script_recording_delay							= check_VDIC_array[46];

							var gIndex = 0;
							if (document.vicidial_form.gender.value == 'M') {var gIndex = 1;}
							if (document.vicidial_form.gender.value == 'F') {var gIndex = 2;}
							document.getElementById("gender_list").selectedIndex = gIndex;

							lead_dial_number = document.vicidial_form.phone_number.value;
							var dispnum = document.vicidial_form.phone_number.value;
							var status_display_number = phone_number_format(dispnum);
							var callnum = dialed_number;
							var dial_display_number = phone_number_format(callnum);
							
							//document.getElementById("MainStatuSSpan").innerHTML = " 进线: " + dial_display_number + " UID: " + CIDcheck + " &nbsp; " + VDIC_fronter; 
							document.getElementById("MainStatuSSpan").innerHTML = " 进线: " + dial_display_number + " &nbsp; " + VDIC_fronter; 

							if (LeaDPreVDispO == 'CALLBK')
								{
								document.getElementById("CusTInfOSpaN").innerHTML = " <B> PREVIOUS 拨号BACK </B>";
								document.getElementById("CusTInfOSpaN").style.background = CusTCB_bgcolor;
								document.getElementById("CBcommentsBoxA").innerHTML = "<b>上一通电话:</b>" + CBentry_time;
								document.getElementById("CBcommentsBoxB").innerHTML = "<b>回拨电话:</b>" + CBcallback_time;
								document.getElementById("CBcommentsBoxC").innerHTML = "<b>话务员:</b>" + CBuser;
								document.getElementById("CBcommentsBoxD").innerHTML = "<b>备注:</b><br>" + CBcomments;
								showDiv('CBcommentsBox');
								}
							if (dialed_label == 'ALT')
								{document.getElementById("CusTInfOSpaN").innerHTML = " <B> 其它拨打号码: ALT </B>";}
							if (dialed_label == 'ADDR3')
								{document.getElementById("CusTInfOSpaN").innerHTML = " <B> 其它拨打号码: 地址3 </B>";}
							var REGalt_dial = new RegExp("X","g");
							if (dialed_label.match(REGalt_dial))
								{
								document.getElementById("CusTInfOSpaN").innerHTML = " <B> 其它拨打号码: " + dialed_label + "</B>";
								document.getElementById("EAcommentsBoxA").innerHTML = "<b>电话区号和号码: </b>" + EAphone_code + " " + EAphone_number;

								var EAactive_link = '';
								if (EAalt_phone_active == 'Y') 
									{EAactive_link = "<a href=\"#\" onclick=\"alt_phone_change('" + EAphone_number + "','" + EAalt_phone_count + "','" + document.vicidial_form.lead_id.value + "','N');\">变更此电话号码为未启动</a>";}
								else
									{EAactive_link = "<a href=\"#\" onclick=\"alt_phone_change('" + EAphone_number + "','" + EAalt_phone_count + "','" + document.vicidial_form.lead_id.value + "','Y');\">变更此电话号码为启动</a>";}

								document.getElementById("EAcommentsBoxB").innerHTML = "<b>启动: </b>" + EAalt_phone_active + "<BR>" + EAactive_link;
								document.getElementById("EAcommentsBoxC").innerHTML = "<b>Alt Count:</b>" + EAalt_phone_count;
								document.getElementById("EAcommentsBoxD").innerHTML = "<b>注意: </b>" + EAalt_phone_notes;
								showDiv('EAcommentsBox');
								}

							if (VDIC_data_VDIG[1].length > 0)
								{
								inOUT = 'IN';
								if (VDIC_data_VDIG[2].length > 2)
									{
									document.getElementById("MainStatuSSpan").style.background = VDIC_data_VDIG[2];
									}
								var dispnum = document.vicidial_form.phone_number.value;
								var status_display_number = phone_number_format(dispnum);
								var callnum = dialed_number;
								var dial_display_number = phone_number_format(callnum);

								//来电归属地
																document.getElementById("MainStatuSSpan").innerHTML = " 主叫: " + dial_display_number + "<span id='location'></span> 技能组: " + VDIC_data_VDIG[1] + " &nbsp; " + VDIC_fronter + "&nbsp;&nbsp;" + extension_info; 
								}

							document.getElementById("ParkControl").innerHTML ="<a href=\"#\" onclick=\"mainxfer_send_redirect('ParK','" + lastcustchannel + "','" + lastcustserverip + "');return false;\"><IMG SRC=\"../agc/images/cn/vdc_LB_parkcall_cn.gif\" border=0 alt=\"保持电话\"></a>";

							document.getElementById("HangupControl").innerHTML = "<a href=\"#\" onclick=\"dialedcall_send_hangup();\"><IMG SRC=\"../agc/images/cn/vdc_LB_hangupcustomer_cn.gif\" border=0 alt=\"挂断\"></a>";
							if (VU_vicidial_transfers == '1'){
								document.getElementById("XferControl").innerHTML = "<a href=\"#\" onclick=\"ShoWTransferMain('ON');\"><IMG SRC=\"../agc/images/cn/vdc_LB_transferconf_cn.gif\" border=0 alt=\"转接\"></a>";
							}
							//Add by fnatic start
							if(Xfer_Local_Closer_Display=='Y')
								{
							document.getElementById("LocalCloser").innerHTML = "<a href=\"#\" onclick=\"mainxfer_send_redirect('XfeRLOCAL','" + lastcustchannel + "','" + lastcustserverip + "');return false;\"><IMG SRC=\"../agc/images/vdc_XB_localcloser_cn.gif\" border=0 alt=\"转本地技能组\" style=\"vertical-align:middle\"></a>";
							    }
							if(Xfer_Blind_Display=='Y')
								{
							document.getElementById("DialBlindTransfer").innerHTML = "<IMG SRC=\"../agc/images/cn/vdc_XB_blindtransfer_OFF_cn.gif\" border=0 alt=\"盲转\" style=\"vertical-align:middle\">";
							    }
                            
							if(Xfer_Answer_Machine_Message_Display=='Y')
								{
							document.getElementById("DialBlindVMail").innerHTML = "<a href=\"#\" onclick=\"mainxfer_send_redirect('XfeRVMAIL','" + lastcustchannel + "','" + lastcustserverip + "');return false;\"><IMG SRC=\"../agc/images/vdc_XB_ammessage_cn.gif\" border=0 alt=\"VM\" style=\"vertical-align:middle\"></a>";
								}
		                    //Add by fnatic end

							if (quick_transfer_button == 'IN_GROUP')
								{
								document.getElementById("QuickXfer").innerHTML = "<a href=\"#\" onclick=\"mainxfer_send_redirect('XfeRLOCAL','" + lastcustchannel + "','" + lastcustserverip + "');return false;\"><IMG SRC=\"../agc/images/vdc_LB_quickxfer_cn.gif\" border=0 alt=\"快速传递\"></a>";
								}
							if (prepopulate_transfer_preset_enabled > 0)
								{
								if (prepopulate_transfer_preset == 'PRESET_1')
									{
									//Mod by fnatic
									//document.vicidial_form.xfernumber.value = CalL_XC_a_NuMber;
									document.getElementById("xfernumber").value = CalL_XC_a_NuMber;
									}
								if (prepopulate_transfer_preset == 'PRESET_2')
									{
									//Mod by fnatic
									//document.vicidial_form.xfernumber.value = CalL_XC_b_NuMber;
									document.getElementById("xfernumber").value = CalL_XC_b_NuMber;
									}
								if (prepopulate_transfer_preset == 'PRESET_3')
									{
									//Mod by fnatic
									//document.vicidial_form.xfernumber.value = CalL_XC_c_NuMber;
									document.getElementById("xfernumber").value = CalL_XC_c_NuMber;
									}
								if (prepopulate_transfer_preset == 'PRESET_4')
									{
									//Mod by fnatic
									//document.vicidial_form.xfernumber.value = CalL_XC_d_NuMber;
									document.getElementById("xfernumber").value = CalL_XC_d_NuMber;
									}
								if (prepopulate_transfer_preset == 'PRESET_5')
									{
									//Mod by fnatic
									//document.vicidial_form.xfernumber.value = CalL_XC_e_NuMber;
									document.getElementById("xfernumber").value = CalL_XC_e_NuMber;
									}
								}
							if ( (quick_transfer_button == 'PRESET_1') || (quick_transfer_button == 'PRESET_2') || (quick_transfer_button == 'PRESET_3') || (quick_transfer_button == 'PRESET_4') || (quick_transfer_button == 'PRESET_5') )
								{
								document.getElementById("QuickXfer").innerHTML = "<a href=\"#\" onclick=\"mainxfer_send_redirect('XfeRBLIND','" + lastcustchannel + "','" + lastcustserverip + "');return false;\"><IMG SRC=\"../agc/images/vdc_LB_quickxfer_cn.gif\" border=0 alt=\"快速转接\"></a>";

								if (quick_transfer_button == 'PRESET_1')
									{
									//Mod by fnatic
									//document.vicidial_form.xfernumber.value = CalL_XC_a_NuMber;
									document.getElementById("xfernumber").value = CalL_XC_a_NuMber;
									}
								if (quick_transfer_button == 'PRESET_2')
									{
									//Mod by fnatic
									//document.vicidial_form.xfernumber.value = CalL_XC_b_NuMber;
									document.getElementById("xfernumber").value = CalL_XC_b_NuMber;
									}
								if (quick_transfer_button == 'PRESET_3')
									{
									//Mod by fnatic
									//document.vicidial_form.xfernumber.value = CalL_XC_c_NuMber;
									document.getElementById("xfernumber").value = CalL_XC_c_NuMber;
									}
								if (quick_transfer_button == 'PRESET_4')
									{//Mod by fnatic
									//document.vicidial_form.xfernumber.value = CalL_XC_d_NuMber;
									document.getElementById("xfernumber").value = CalL_XC_d_NuMber;
									}
								if (quick_transfer_button == 'PRESET_5')
									{//Mod by fnatic
									//document.vicidial_form.xfernumber.value = CalL_XC_e_NuMber;
                                     document.getElementById("xfernumber").value = CalL_XC_e_NuMber;
									}
								}

							if (call_requeue_button > 0)
								{
								var CloserSelectChoices = document.vicidial_form.CloserSelectList.value;
								var regCRB = new RegExp("AGENTDIRECT","ig");
								if ( (CloserSelectChoices.match(regCRB)) || (VU_closer_campaigns.match(regCRB)) )
									{
									document.getElementById("ReQueueCall").innerHTML =  "<a href=\"#\" onclick=\"call_requeue_launch();return false;\"><IMG SRC=\"../agc/images/vdc_LB_requeue_call.gif\" border=0 alt=\"Re-Queue Call\"></a>";
									}
								else
									{
									document.getElementById("ReQueueCall").innerHTML =  "<IMG SRC=\"../agc/images/vdc_LB_requeue_call_OFF.gif\" border=0 alt=\"Re-Queue Call\">";
									}
								}

							// Build transfer pull-down list
							var loop_ct = 0;
							var live_XfeR_HTML = '';
							var XfeR_SelecT = '';
							while (loop_ct < XFgroupCOUNT)
								{
								if (VARxfergroups[loop_ct] == LIVE_default_xfer_group)
									{XfeR_SelecT = 'selected ';}
								else {XfeR_SelecT = '';}
								live_XfeR_HTML = live_XfeR_HTML + "<option " + XfeR_SelecT + "value=\"" + VARxfergroups[loop_ct] + "\">" + VARxfergroups[loop_ct] + " - " + VARxfergroupsnames[loop_ct] + "</option>\n";
								loop_ct++;
								}
							document.getElementById("XfeRGrouPLisT").innerHTML = "<select size=1 name=XfeRGrouP  id=XfeRGrouP  onChange=\"XferAgentSelectLink();return false;\">" + live_XfeR_HTML + "</select>";

							if (lastcustserverip == server_ip)
								{
								document.getElementById("VolumeUpSpan").innerHTML = "<a href=\"#\" onclick=\"volume_control('UP','" + lastcustchannel + "','');return false;\"><IMG SRC=\"../agc/images/vdc_volume_up.gif\" BORDER=0></a>";
								document.getElementById("VolumeDownSpan").innerHTML = "<a href=\"#\" onclick=\"volume_control('DOWN','" + lastcustchannel + "','');return false;\"><IMG SRC=\"../agc/images/vdc_volume_down.gif\" BORDER=0></a>";
								}

							if (dial_method == "INBOUND_MAN")
								{

								//Mod by fnatic start
								if(Dial_Next_Display=='Y')
									{
								document.getElementById("DiaLControl").innerHTML = "<IMG SRC=\"../agc/images/cn/vdc_LB_pause_OFF_cn.gif\" border=0 alt=\" 暂停 \"><IMG SRC=\"../agc/images/cn/vdc_LB_resume_OFF_cn.gif\" border=0 alt=\"恢复\"><BR><IMG SRC=\"../agc/images/cn/vdc_LB_dialnextnumber_OFF_cn.gif\" border=0 alt=\"挂断\">";
								    }
								else
									{
								document.getElementById("DiaLControl").innerHTML = "<IMG SRC=\"../agc/images/cn/vdc_LB_pause_OFF_cn.gif\" border=0 alt=\" 暂停 \"><IMG SRC=\"../agc/images/cn/vdc_LB_resume_OFF_cn.gif\" border=0 alt=\"恢复\">";							
								    }
								//Mod by fnatic end
								}
							else
								{
								document.getElementById("DiaLControl").innerHTML = DiaLControl_auto_HTML_OFF;
								}

							if (VDCL_group_id.length > 1)
								{var group = VDCL_group_id;}
							else
								{var group = campaign;}
							if ( (dialed_label.length < 2) || (dialed_label=='NONE') ) {dialed_label='MAIN';}

							var genderIndex = document.getElementById("gender_list").selectedIndex;
							var genderValue =  document.getElementById('gender_list').options[genderIndex].value;
							document.vicidial_form.gender.value = genderValue;
							LeaDDispO='';

							var regWFAcustom = new RegExp("^VAR","ig");
							if (VDIC_web_form_address.match(regWFAcustom))
								{
								URLDecode(VDIC_web_form_address,'YES');
								TEMP_VDIC_web_form_address = decoded;
								TEMP_VDIC_web_form_address = TEMP_VDIC_web_form_address.replace(regWFAcustom, '');
								}
							else
								{
								web_form_vars = 
								"&lead_id=" + document.vicidial_form.lead_id.value + 
								"&vendor_id=" + document.vicidial_form.vendor_lead_code.value + 
								"&list_id=" + document.vicidial_form.list_id.value + 
								"&gmt_offset_now=" + document.vicidial_form.gmt_offset_now.value + 
								"&phone_code=" + document.vicidial_form.phone_code.value + 
								"&phone_number=" + document.vicidial_form.phone_number.value + 
								"&title=" + document.vicidial_form.title.value + 
								"&first_name=" + document.vicidial_form.first_name.value + 
								"&middle_initial=" + document.vicidial_form.middle_initial.value + 
								"&last_name=" + document.vicidial_form.last_name.value + 
								"&address1=" + document.vicidial_form.address1.value + 
								"&address2=" + document.vicidial_form.address2.value + 
								"&address3=" + document.vicidial_form.address3.value + 
								"&city=" + document.vicidial_form.city.value + 
								"&state=" + document.vicidial_form.state.value + 
								"&province=" + document.vicidial_form.province.value + 
								"&postal_code=" + document.vicidial_form.postal_code.value + 
								"&country_code=" + document.vicidial_form.country_code.value + 
								"&gender=" + document.vicidial_form.gender.value + 
								"&date_of_birth=" + document.vicidial_form.date_of_birth.value + 
								"&alt_phone=" + document.vicidial_form.alt_phone.value + 
								"&email=" + document.vicidial_form.email.value + 
								"&security_phrase=" + document.vicidial_form.security_phrase.value + 
								"&comments=" + document.vicidial_form.comments.value + 
								"&user=" + user + 
								"&pass=" + pass + 
								"&campaign=" + campaign + 
								"&phone_login=" + phone_login + 
								"&original_phone_login=" + original_phone_login +
								"&phone_pass=" + phone_pass + 
								"&fronter=" + fronter + 
								"&closer=" + user + 
								"&group=" + group + 
								"&channel_group=" + group + 
								"&SQLdate=" + SQLdate + 
								"&epoch=" + UnixTime + 
								"&uniqueid=" + document.vicidial_form.uniqueid.value + 
								"&customer_zap_channel=" + lastcustchannel + 
								"&customer_server_ip=" + lastcustserverip +
								"&server_ip=" + server_ip + 
								"&SIPexten=" + extension + 
								"&session_id=" + session_id + 
								"&phone=" + document.vicidial_form.phone_number.value + 
								"&parked_by=" + document.vicidial_form.lead_id.value +
								"&dispo=" + LeaDDispO + '' +
								"&dialed_number=" + dialed_number + '' +
								"&dialed_label=" + dialed_label + '' +
								"&source_id=" + source_id + '' +
								"&rank=" + document.vicidial_form.rank.value + '' +
								"&owner=" + document.vicidial_form.owner.value + '' +
								"&camp_script=" + campaign_script + '' +
								"&in_script=" + CalL_ScripT_id + '' +
								"&script_width=" + script_width + '' +
								"&script_height=" + script_height + '' +
								"&fullname=" + LOGfullname + '' +
								"&recording_filename=" + recording_filename + '' +
								"&recording_id=" + recording_id + '' +
								"&user_custom_one=" + VU_custom_one + '' +
								"&user_custom_two=" + VU_custom_two + '' +
								"&user_custom_three=" + VU_custom_three + '' +
								"&user_custom_four=" + VU_custom_four + '' +
								"&user_custom_five=" + VU_custom_five + '' +
								"&preset_number_a=" + CalL_XC_a_NuMber + '' +
								"&preset_number_b=" + CalL_XC_b_NuMber + '' +
								"&preset_number_c=" + CalL_XC_c_NuMber + '' +
								"&preset_number_d=" + CalL_XC_d_NuMber + '' +
								"&preset_number_e=" + CalL_XC_e_NuMber + '' +
								"&preset_dtmf_a=" + CalL_XC_a_Dtmf + '' +
								"&preset_dtmf_b=" + CalL_XC_b_Dtmf + '' +
								"&iocheck=" + "in" + '' +
								webform_session;
								
								var regWFspace = new RegExp(" ","ig");
								web_form_vars = web_form_vars.replace(regWF, '');
								var regWF = new RegExp("\\`|\\~|\\:|\\;|\\#|\\'|\\\"|\\{|\\}|\\(|\\)|\\*|\\^|\\%|\\$|\\!|\\%|\\r|\\t|\\n","ig");
								web_form_vars = web_form_vars.replace(regWFspace, '+');
								web_form_vars = web_form_vars.replace(regWF, '');

								var regWFAvars = new RegExp("\\?","ig");
								if (VDIC_web_form_address.match(regWFAvars))
									{web_form_vars = '&' + web_form_vars}
								else
									{web_form_vars = '?' + web_form_vars}

								TEMP_VDIC_web_form_address = VDIC_web_form_address + "" + web_form_vars;

								var regWFAqavars = new RegExp("\\?&","ig");
								var regWFAaavars = new RegExp("&&","ig");
								TEMP_VDIC_web_form_address = TEMP_VDIC_web_form_address.replace(regWFAqavars, '?');
								TEMP_VDIC_web_form_address = TEMP_VDIC_web_form_address.replace(regWFAaavars, '&');
								}

							if (VDIC_web_form_address_two.match(regWFAcustom))
								{
								URLDecode(VDIC_web_form_address_two,'YES');
								TEMP_VDIC_web_form_address_two = decoded;
								TEMP_VDIC_web_form_address_two = TEMP_VDIC_web_form_address_two.replace(regWFAcustom, '');
								}
							else
								{
								web_form_vars_two = 
								"&lead_id=" + document.vicidial_form.lead_id.value + 
								"&vendor_id=" + document.vicidial_form.vendor_lead_code.value + 
								"&list_id=" + document.vicidial_form.list_id.value + 
								"&gmt_offset_now=" + document.vicidial_form.gmt_offset_now.value + 
								"&phone_code=" + document.vicidial_form.phone_code.value + 
								"&phone_number=" + document.vicidial_form.phone_number.value + 
								"&title=" + document.vicidial_form.title.value + 
								"&first_name=" + document.vicidial_form.first_name.value + 
								"&middle_initial=" + document.vicidial_form.middle_initial.value + 
								"&last_name=" + document.vicidial_form.last_name.value + 
								"&address1=" + document.vicidial_form.address1.value + 
								"&address2=" + document.vicidial_form.address2.value + 
								"&address3=" + document.vicidial_form.address3.value + 
								"&city=" + document.vicidial_form.city.value + 
								"&state=" + document.vicidial_form.state.value + 
								"&province=" + document.vicidial_form.province.value + 
								"&postal_code=" + document.vicidial_form.postal_code.value + 
								"&country_code=" + document.vicidial_form.country_code.value + 
								"&gender=" + document.vicidial_form.gender.value + 
								"&date_of_birth=" + document.vicidial_form.date_of_birth.value + 
								"&alt_phone=" + document.vicidial_form.alt_phone.value + 
								"&email=" + document.vicidial_form.email.value + 
								"&security_phrase=" + document.vicidial_form.security_phrase.value + 
								"&comments=" + document.vicidial_form.comments.value + 
								"&user=" + user + 
								"&pass=" + pass + 
								"&campaign=" + campaign + 
								"&phone_login=" + phone_login + 
								"&original_phone_login=" + original_phone_login +
								"&phone_pass=" + phone_pass + 
								"&fronter=" + fronter + 
								"&closer=" + user + 
								"&group=" + group + 
								"&channel_group=" + group + 
								"&SQLdate=" + SQLdate + 
								"&epoch=" + UnixTime + 
								"&uniqueid=" + document.vicidial_form.uniqueid.value + 
								"&customer_zap_channel=" + lastcustchannel + 
								"&customer_server_ip=" + lastcustserverip +
								"&server_ip=" + server_ip + 
								"&SIPexten=" + extension + 
								"&session_id=" + session_id + 
								"&phone=" + document.vicidial_form.phone_number.value + 
								"&parked_by=" + document.vicidial_form.lead_id.value +
								"&dispo=" + LeaDDispO + '' +
								"&dialed_number=" + dialed_number + '' +
								"&dialed_label=" + dialed_label + '' +
								"&source_id=" + source_id + '' +
								"&rank=" + document.vicidial_form.rank.value + '' +
								"&owner=" + document.vicidial_form.owner.value + '' +
								"&camp_script=" + campaign_script + '' +
								"&in_script=" + CalL_ScripT_id + '' +
								"&script_width=" + script_width + '' +
								"&script_height=" + script_height + '' +
								"&fullname=" + LOGfullname + '' +
								"&recording_filename=" + recording_filename + '' +
								"&recording_id=" + recording_id + '' +
								"&user_custom_one=" + VU_custom_one + '' +
								"&user_custom_two=" + VU_custom_two + '' +
								"&user_custom_three=" + VU_custom_three + '' +
								"&user_custom_four=" + VU_custom_four + '' +
								"&user_custom_five=" + VU_custom_five + '' +
								"&preset_number_a=" + CalL_XC_a_NuMber + '' +
								"&preset_number_b=" + CalL_XC_b_NuMber + '' +
								"&preset_number_c=" + CalL_XC_c_NuMber + '' +
								"&preset_number_d=" + CalL_XC_d_NuMber + '' +
								"&preset_number_e=" + CalL_XC_e_NuMber + '' +
								"&preset_dtmf_a=" + CalL_XC_a_Dtmf + '' +
								"&preset_dtmf_b=" + CalL_XC_b_Dtmf + '' +
								webform_session;
								
								var regWFspace = new RegExp(" ","ig");
								web_form_vars_two = web_form_vars_two.replace(regWF, '');
								var regWF = new RegExp("\\`|\\~|\\:|\\;|\\#|\\'|\\\"|\\{|\\}|\\(|\\)|\\*|\\^|\\%|\\$|\\!|\\%|\\r|\\t|\\n","ig");
								web_form_vars_two = web_form_vars_two.replace(regWFspace, '+');
								web_form_vars_two = web_form_vars_two.replace(regWF, '');

								var regWFAvars = new RegExp("\\?","ig");
								if (VDIC_web_form_address_two.match(regWFAvars))
									{web_form_vars_two = '&' + web_form_vars_two}
								else
									{web_form_vars_two = '?' + web_form_vars_two}

								TEMP_VDIC_web_form_address_two = VDIC_web_form_address_two + "" + web_form_vars_two;

								var regWFAqavars = new RegExp("\\?&","ig");
								var regWFAaavars = new RegExp("&&","ig");
								TEMP_VDIC_web_form_address_two = TEMP_VDIC_web_form_address_two.replace(regWFAqavars, '?');
								TEMP_VDIC_web_form_address_two = TEMP_VDIC_web_form_address_two.replace(regWFAaavars, '&');
								}

                            //Modified by Kelvin Begin
							if (WebForm_Button_Display!='NONE') {
							document.getElementById("WebFormSpan").innerHTML = "<a href=\"" + TEMP_VDIC_web_form_address + "\" target=\"" + web_form_target + "\" onMouseOver=\"WebFormRefresH();\"><IMG SRC=\"../agc/images/cn/vdc_LB_webform_cn.gif\" border=0 alt=\"网页表单\"></a>\n";

							if (enable_second_webform > 0)
								{
								document.getElementById("WebFormSpanTwo").innerHTML = "<a href=\"" + TEMP_VDIC_web_form_address_two + "\" target=\"" + web_form_target + "\" onMouseOver=\"WebFormTwoRefresH();\"><IMG SRC=\"../agc/images/cn/vdc_LB_webform_two_cn.gif\" border=0 alt=\"网页表单2\"></a>\n";
								}
							}
                            //Modified by Kelvin End
							if ( (LIVE_campaign_recording == 'ALLCALLS') || (LIVE_campaign_recording == 'ALLFORCE') )
								{all_record = 'YES';}

	
							if ( (view_scripts == 1) && (CalL_ScripT_id.length > 0) )
								{
								web_form_vars = 
								"&lead_id=" + document.vicidial_form.lead_id.value + 
								"&vendor_id=" + document.vicidial_form.vendor_lead_code.value + 
								"&list_id=" + document.vicidial_form.list_id.value + 
								"&gmt_offset_now=" + document.vicidial_form.gmt_offset_now.value + 
								"&phone_code=" + document.vicidial_form.phone_code.value + 
								"&phone_number=" + document.vicidial_form.phone_number.value + 
								"&title=" + document.vicidial_form.title.value + 
								"&first_name=" + document.vicidial_form.first_name.value + 
								"&middle_initial=" + document.vicidial_form.middle_initial.value + 
								"&last_name=" + document.vicidial_form.last_name.value + 
								"&address1=" + document.vicidial_form.address1.value + 
								"&address2=" + document.vicidial_form.address2.value + 
								"&address3=" + document.vicidial_form.address3.value + 
								"&city=" + document.vicidial_form.city.value + 
								"&state=" + document.vicidial_form.state.value + 
								"&province=" + document.vicidial_form.province.value + 
								"&postal_code=" + document.vicidial_form.postal_code.value + 
								"&country_code=" + document.vicidial_form.country_code.value + 
								"&gender=" + document.vicidial_form.gender.value + 
								"&date_of_birth=" + document.vicidial_form.date_of_birth.value + 
								"&alt_phone=" + document.vicidial_form.alt_phone.value + 
								"&email=" + document.vicidial_form.email.value + 
								"&security_phrase=" + document.vicidial_form.security_phrase.value + 
								"&comments=" + document.vicidial_form.comments.value + 
								"&user=" + user + 
								"&pass=" + pass + 
								"&campaign=" + campaign + 
								"&phone_login=" + phone_login + 
								"&original_phone_login=" + original_phone_login +
								"&phone_pass=" + phone_pass + 
								"&fronter=" + fronter + 
								"&closer=" + user + 
								"&group=" + group + 
								"&channel_group=" + group + 
								"&SQLdate=" + SQLdate + 
								"&epoch=" + UnixTime + 
								"&uniqueid=" + document.vicidial_form.uniqueid.value + 
								"&customer_zap_channel=" + lastcustchannel + 
								"&customer_server_ip=" + lastcustserverip +
								"&server_ip=" + server_ip + 
								"&SIPexten=" + extension + 
								"&session_id=" + session_id + 
								"&phone=" + document.vicidial_form.phone_number.value + 
								"&parked_by=" + document.vicidial_form.lead_id.value +
								"&dispo=" + LeaDDispO + '' +
								"&dialed_number=" + dialed_number + '' +
								"&dialed_label=" + dialed_label + '' +
								"&source_id=" + source_id + '' +
								"&rank=" + document.vicidial_form.rank.value + '' +
								"&owner=" + document.vicidial_form.owner.value + '' +
								"&camp_script=" + campaign_script + '' +
								"&in_script=" + CalL_ScripT_id + '' +
								"&script_width=" + script_width + '' +
								"&script_height=" + script_height + '' +
								"&fullname=" + LOGfullname + '' +
								"&recording_filename=" + recording_filename + '' +
								"&recording_id=" + recording_id + '' +
								"&user_custom_one=" + VU_custom_one + '' +
								"&user_custom_two=" + VU_custom_two + '' +
								"&user_custom_three=" + VU_custom_three + '' +
								"&user_custom_four=" + VU_custom_four + '' +
								"&user_custom_five=" + VU_custom_five + '' +
								"&preset_number_a=" + CalL_XC_a_NuMber + '' +
								"&preset_number_b=" + CalL_XC_b_NuMber + '' +
								"&preset_number_c=" + CalL_XC_c_NuMber + '' +
								"&preset_number_d=" + CalL_XC_d_NuMber + '' +
								"&preset_number_e=" + CalL_XC_e_NuMber + '' +
								"&preset_dtmf_a=" + CalL_XC_a_Dtmf + '' +
								"&preset_dtmf_b=" + CalL_XC_b_Dtmf + '' +
								webform_session;
								
								var regWFspace = new RegExp(" ","ig");
								web_form_vars = web_form_vars.replace(regWF, '');
								var regWF = new RegExp("\\`|\\~|\\:|\\;|\\#|\\'|\\\"|\\{|\\}|\\(|\\)|\\*|\\^|\\%|\\$|\\!|\\%|\\r|\\t|\\n","ig");
								web_form_vars = web_form_vars.replace(regWFspace, '+');
								web_form_vars = web_form_vars.replace(regWF, '');

								if ( (script_recording_delay > 0) && ( (LIVE_campaign_recording == 'ALLCALLS') || (LIVE_campaign_recording == 'ALLFORCE') ) )
									{
									delayed_script_load = 'YES';
									RefresHScript('CLEAR');
									}
								else
									{
									load_script_contents();
									}
								}

							if (CalL_AutO_LauncH == 'SCRIPT')
								{
								if (delayed_script_load == 'YES')
									{
									
									load_script_contents();
									}
									//alert(4);
								ScriptPanelToFront();
								}
							if (CalL_AutO_LauncH == 'WEBFORM')
								{
								//alert("TEMP_VDIC_web_form_address:"+TEMP_VDIC_web_form_address+" \n web_form_target:"+web_form_target);
								//来电弹屏
								 $("#webaddress").attr("src",TEMP_VDIC_web_form_address);
								 $("#dialog-confirm").dialog(
								 {
								     
								     width:800,
										 //minHeight:320,
										 height:500,
										
								   
								 }); 
								 
								//window.open(TEMP_VDIC_web_form_address, web_form_target, 'toolbar=1,scrollbars=1,location=1,statusbar=1,menubar=1,resizable=1,width=640,height=450');
								}
							if (CalL_AutO_LauncH == 'WEBFORMTWO')
								{
								window.open(TEMP_VDIC_web_form_address_two, web_form_target, 'toolbar=1,scrollbars=1,location=1,statusbar=1,menubar=1,resizable=1,width=640,height=450');
								}

							if ( (CopY_tO_ClipboarD != 'NONE') && (useIE > 0) )
								{
								var tmp_clip = document.getElementById(CopY_tO_ClipboarD);
								window.clipboardData.setData('Text', tmp_clip.value)
								}

							if (alert_enabled=='ON')
								{
								var callnum = dialed_number;
								var dial_display_number = phone_number_format(callnum);
								//Modify By Fnatic Start
								if(Incoming_Web_Play_Music_Enable=='Y'){document.getElementById('snd').src=Incoming_Web_Play_Music_Filename;}
								//alert(" 进线: " + dial_display_number + " 技能组: " + VDIC_data_VDIG[1] + " " + VDIC_fronter);
																var str_temp = " 主叫: " + dial_display_number + "<br> 技能组: " + VDIC_data_VDIG[1] + "<br> " + VDIC_fronter;
								
								document.getElementById("ShowFromCallInfo").innerHTML = str_temp  + "<br>" + extension_info;
//								$(function(){
//								$("#ShowFromCallInfoDIV").floatdiv({left:"0px",bottom:"0px"});
								$("#ShowFromCallInfoDIV").dialog
								({ draggable: false,
									resizable:false ,
									width:'250',
									height:'auto',
									modal: false,
									position:["left","bottom"]
//									title:"Show From Call Info"
								});
								$("#ShowFromCallInfoDIV").dialog('open');

								//alert(str_temp);
//								var url ='./show_from_call_info.php?call_from='+encodeURI(str_temp)+'&phone_location=&from_user=';
//								SystemModelessDialog(url,'300','150');
								                                if(Incoming_Web_Play_Music_Enable=='Y'){document.getElementById('snd').src="";}
								//Modify By Fnatic End 
								}
							}
						else
							{
								if(check_VDIC_array[1].indexOf('acw_hold_time:')==0){
									acw_hold_time = parseInt(check_VDIC_array[1].replace("acw_hold_time:",""));
								}
							// do nothing
							}
							xmlhttprequestcheckauto = undefined;
							delete xmlhttprequestcheckauto;
						}
					}
				}
			}
		}

// ################################################################################
// refresh or clear the SCRIPT frame contents
	function RefresHScript(temp_wipe)
		{
		if (temp_wipe == 'CLEAR')
			{
			document.getElementById("ScriptContents").innerHTML = '';
			}
		else
			{//alert(3);
			document.getElementById("ScriptContents").innerHTML = '';
			WebFormRefresH('','','1');
			load_script_contents();
			}
		}


// ################################################################################
// refresh the content of the web form URL
	function WebFormRefresH(taskrefresh,submittask,force_webvars_refresh) 
		{
		var webvars_refresh=0;

		if (VDCL_group_id.length > 1)
			{var group = VDCL_group_id;}
		else
			{var group = campaign;}
		if ( (dialed_label.length < 2) || (dialed_label=='NONE') ) {dialed_label='MAIN';}

		if (submittask != 'YES')
			{
			var genderIndex = document.getElementById("gender_list").selectedIndex;
			var genderValue =  document.getElementById('gender_list').options[genderIndex].value;
			document.vicidial_form.gender.value = genderValue;
			}

		var regWFAcustom = new RegExp("^VAR","ig");
		if (VDIC_web_form_address.match(regWFAcustom))
			{
			URLDecode(VDIC_web_form_address,'YES');
			TEMP_VDIC_web_form_address = decoded;
			TEMP_VDIC_web_form_address = TEMP_VDIC_web_form_address.replace(regWFAcustom, '');
			}
		else
			{webvars_refresh=1;}

		if ( (webvars_refresh > 0) || (force_webvars_refresh > 0) )
			{
			web_form_vars = 
			"&lead_id=" + document.vicidial_form.lead_id.value + 
			"&vendor_id=" + document.vicidial_form.vendor_lead_code.value + 
			"&list_id=" + document.vicidial_form.list_id.value + 
			"&gmt_offset_now=" + document.vicidial_form.gmt_offset_now.value + 
			"&phone_code=" + document.vicidial_form.phone_code.value + 
			"&phone_number=" + document.vicidial_form.phone_number.value + 
			"&title=" + document.vicidial_form.title.value + 
			"&first_name=" + document.vicidial_form.first_name.value + 
			"&middle_initial=" + document.vicidial_form.middle_initial.value + 
			"&last_name=" + document.vicidial_form.last_name.value + 
			"&address1=" + document.vicidial_form.address1.value + 
			"&address2=" + document.vicidial_form.address2.value + 
			"&address3=" + document.vicidial_form.address3.value + 
			"&city=" + document.vicidial_form.city.value + 
			"&state=" + document.vicidial_form.state.value + 
			"&province=" + document.vicidial_form.province.value + 
			"&postal_code=" + document.vicidial_form.postal_code.value + 
			"&country_code=" + document.vicidial_form.country_code.value + 
			"&gender=" + document.vicidial_form.gender.value + 
			"&date_of_birth=" + document.vicidial_form.date_of_birth.value + 
			"&alt_phone=" + document.vicidial_form.alt_phone.value + 
			"&email=" + document.vicidial_form.email.value + 
			"&security_phrase=" + document.vicidial_form.security_phrase.value + 
			"&comments=" + document.vicidial_form.comments.value + 
			"&user=" + user + 
			"&pass=" + pass + 
			"&campaign=" + campaign + 
			"&phone_login=" + phone_login + 
			"&original_phone_login=" + original_phone_login +
			"&phone_pass=" + phone_pass + 
			"&fronter=" + fronter + 
			"&closer=" + user + 
			"&group=" + group + 
			"&channel_group=" + group + 
			"&SQLdate=" + SQLdate + 
			"&epoch=" + UnixTime + 
			"&uniqueid=" + document.vicidial_form.uniqueid.value + 
			"&customer_zap_channel=" + lastcustchannel + 
			"&customer_server_ip=" + lastcustserverip +
			"&server_ip=" + server_ip + 
			"&SIPexten=" + extension + 
			"&session_id=" + session_id + 
			"&phone=" + document.vicidial_form.phone_number.value + 
			"&parked_by=" + document.vicidial_form.lead_id.value +
			"&dispo=" + LeaDDispO + '' +
			"&dialed_number=" + dialed_number + '' +
			"&dialed_label=" + dialed_label + '' +
			"&source_id=" + source_id + '' +
			"&rank=" + document.vicidial_form.rank.value + '' +
			"&owner=" + document.vicidial_form.owner.value + '' +
			"&camp_script=" + campaign_script + '' +
			"&in_script=" + CalL_ScripT_id + '' +
			"&script_width=" + script_width + '' +
			"&script_height=" + script_height + '' +
			"&fullname=" + LOGfullname + '' +
			"&recording_filename=" + recording_filename + '' +
			"&recording_id=" + recording_id + '' +
			"&user_custom_one=" + VU_custom_one + '' +
			"&user_custom_two=" + VU_custom_two + '' +
			"&user_custom_three=" + VU_custom_three + '' +
			"&user_custom_four=" + VU_custom_four + '' +
			"&user_custom_five=" + VU_custom_five + '' +
			"&preset_number_a=" + CalL_XC_a_NuMber + '' +
			"&preset_number_b=" + CalL_XC_b_NuMber + '' +
			"&preset_number_c=" + CalL_XC_c_NuMber + '' +
			"&preset_number_d=" + CalL_XC_d_NuMber + '' +
			"&preset_number_e=" + CalL_XC_e_NuMber + '' +
			"&preset_dtmf_a=" + CalL_XC_a_Dtmf + '' +
			"&preset_dtmf_b=" + CalL_XC_b_Dtmf + '' +
			webform_session;
			
			var regWFspace = new RegExp(" ","ig");
			web_form_vars = web_form_vars.replace(regWF, '');
			var regWF = new RegExp("\\`|\\~|\\:|\\;|\\#|\\'|\\\"|\\{|\\}|\\(|\\)|\\*|\\^|\\%|\\$|\\!|\\%|\\r|\\t|\\n","ig");
			web_form_vars = web_form_vars.replace(regWFspace, '+');
			web_form_vars = web_form_vars.replace(regWF, '');

			var regWFAvars = new RegExp("\\?","ig");
			if (VDIC_web_form_address.match(regWFAvars))
				{web_form_vars = '&' + web_form_vars}
			else
				{web_form_vars = '?' + web_form_vars}

			TEMP_VDIC_web_form_address = VDIC_web_form_address + "" + web_form_vars;

			var regWFAqavars = new RegExp("\\?&","ig");
			var regWFAaavars = new RegExp("&&","ig");
			TEMP_VDIC_web_form_address = TEMP_VDIC_web_form_address.replace(regWFAqavars, '?');
			TEMP_VDIC_web_form_address = TEMP_VDIC_web_form_address.replace(regWFAaavars, '&');
			}

        //Modified by Kelvin Begin
		if (WebForm_Button_Display !='NONE') {
		if (taskrefresh == 'OUT')
			{
			document.getElementById("WebFormSpan").innerHTML = "<a href=\"" + TEMP_VDIC_web_form_address + "\" target=\"" + web_form_target + "\" onMouseOver=\"WebFormRefresH('IN');\"><IMG SRC=\"../agc/images/cn/vdc_LB_webform_cn.gif\" border=0 alt=\"网页表单\"></a>\n";
			}
		else 
			{
			document.getElementById("WebFormSpan").innerHTML = "<a href=\"" + TEMP_VDIC_web_form_address + "\" target=\"" + web_form_target + "\" onMouseOut=\"WebFormRefresH('OUT');\"><IMG SRC=\"../agc/images/cn/vdc_LB_webform_cn.gif\" border=0 alt=\"网页表单\"></a>\n";
			}
		}
		}
		//Modified by Kelvin End


// ################################################################################
// refresh the content of the second web form URL
	function WebFormTwoRefresH(taskrefresh,submittask) 
		{
		if (VDCL_group_id.length > 1)
			{var group = VDCL_group_id;}
		else
			{var group = campaign;}
		if ( (dialed_label.length < 2) || (dialed_label=='NONE') ) {dialed_label='MAIN';}

		if (submittask != 'YES')
			{
			var genderIndex = document.getElementById("gender_list").selectedIndex;
			var genderValue =  document.getElementById('gender_list').options[genderIndex].value;
			document.vicidial_form.gender.value = genderValue;
			}

		var regWFAcustom = new RegExp("^VAR","ig");
		if (VDIC_web_form_address_two.match(regWFAcustom))
			{
			URLDecode(VDIC_web_form_address_two,'YES');
			TEMP_VDIC_web_form_address_two = decoded;
			TEMP_VDIC_web_form_address_two = TEMP_VDIC_web_form_address_two.replace(regWFAcustom, '');
			}
		else
			{
			web_form_vars_two = 
			"&lead_id=" + document.vicidial_form.lead_id.value + 
			"&vendor_id=" + document.vicidial_form.vendor_lead_code.value + 
			"&list_id=" + document.vicidial_form.list_id.value + 
			"&gmt_offset_now=" + document.vicidial_form.gmt_offset_now.value + 
			"&phone_code=" + document.vicidial_form.phone_code.value + 
			"&phone_number=" + document.vicidial_form.phone_number.value + 
			"&title=" + document.vicidial_form.title.value + 
			"&first_name=" + document.vicidial_form.first_name.value + 
			"&middle_initial=" + document.vicidial_form.middle_initial.value + 
			"&last_name=" + document.vicidial_form.last_name.value + 
			"&address1=" + document.vicidial_form.address1.value + 
			"&address2=" + document.vicidial_form.address2.value + 
			"&address3=" + document.vicidial_form.address3.value + 
			"&city=" + document.vicidial_form.city.value + 
			"&state=" + document.vicidial_form.state.value + 
			"&province=" + document.vicidial_form.province.value + 
			"&postal_code=" + document.vicidial_form.postal_code.value + 
			"&country_code=" + document.vicidial_form.country_code.value + 
			"&gender=" + document.vicidial_form.gender.value + 
			"&date_of_birth=" + document.vicidial_form.date_of_birth.value + 
			"&alt_phone=" + document.vicidial_form.alt_phone.value + 
			"&email=" + document.vicidial_form.email.value + 
			"&security_phrase=" + document.vicidial_form.security_phrase.value + 
			"&comments=" + document.vicidial_form.comments.value + 
			"&user=" + user + 
			"&pass=" + pass + 
			"&campaign=" + campaign + 
			"&phone_login=" + phone_login + 
			"&original_phone_login=" + original_phone_login +
			"&phone_pass=" + phone_pass + 
			"&fronter=" + fronter + 
			"&closer=" + user + 
			"&group=" + group + 
			"&channel_group=" + group + 
			"&SQLdate=" + SQLdate + 
			"&epoch=" + UnixTime + 
			"&uniqueid=" + document.vicidial_form.uniqueid.value + 
			"&customer_zap_channel=" + lastcustchannel + 
			"&customer_server_ip=" + lastcustserverip +
			"&server_ip=" + server_ip + 
			"&SIPexten=" + extension + 
			"&session_id=" + session_id + 
			"&phone=" + document.vicidial_form.phone_number.value + 
			"&parked_by=" + document.vicidial_form.lead_id.value +
			"&dispo=" + LeaDDispO + '' +
			"&dialed_number=" + dialed_number + '' +
			"&dialed_label=" + dialed_label + '' +
			"&source_id=" + source_id + '' +
			"&rank=" + document.vicidial_form.rank.value + '' +
			"&owner=" + document.vicidial_form.owner.value + '' +
			"&camp_script=" + campaign_script + '' +
			"&in_script=" + CalL_ScripT_id + '' +
			"&script_width=" + script_width + '' +
			"&script_height=" + script_height + '' +
			"&fullname=" + LOGfullname + '' +
			"&recording_filename=" + recording_filename + '' +
			"&recording_id=" + recording_id + '' +
			"&user_custom_one=" + VU_custom_one + '' +
			"&user_custom_two=" + VU_custom_two + '' +
			"&user_custom_three=" + VU_custom_three + '' +
			"&user_custom_four=" + VU_custom_four + '' +
			"&user_custom_five=" + VU_custom_five + '' +
			"&preset_number_a=" + CalL_XC_a_NuMber + '' +
			"&preset_number_b=" + CalL_XC_b_NuMber + '' +
			"&preset_number_c=" + CalL_XC_c_NuMber + '' +
			"&preset_number_d=" + CalL_XC_d_NuMber + '' +
			"&preset_number_e=" + CalL_XC_e_NuMber + '' +
			"&preset_dtmf_a=" + CalL_XC_a_Dtmf + '' +
			"&preset_dtmf_b=" + CalL_XC_b_Dtmf + '' +
			webform_session;
			
			var regWFspace = new RegExp(" ","ig");
			web_form_vars_two = web_form_vars_two.replace(regWF, '');
			var regWF = new RegExp("\\`|\\~|\\:|\\;|\\#|\\'|\\\"|\\{|\\}|\\(|\\)|\\*|\\^|\\%|\\$|\\!|\\%|\\r|\\t|\\n","ig");
			web_form_vars_two = web_form_vars_two.replace(regWFspace, '+');
			web_form_vars_two = web_form_vars_two.replace(regWF, '');

			var regWFAvars = new RegExp("\\?","ig");
			if (VDIC_web_form_address_two.match(regWFAvars))
				{web_form_vars_two = '&' + web_form_vars_two}
			else
				{web_form_vars_two = '?' + web_form_vars_two}

			TEMP_VDIC_web_form_address_two = VDIC_web_form_address_two + "" + web_form_vars_two;

			var regWFAqavars = new RegExp("\\?&","ig");
			var regWFAaavars = new RegExp("&&","ig");
			TEMP_VDIC_web_form_address_two = TEMP_VDIC_web_form_address_two.replace(regWFAqavars, '?');
			TEMP_VDIC_web_form_address_two = TEMP_VDIC_web_form_address_two.replace(regWFAaavars, '&');
			}

            //Modified by Kelvin Begin
	    if (WebForm_Button_Display !='NONE') {
		if (enable_second_webform > 0 )
			{
			if (taskrefresh == 'OUT')
				{
				document.getElementById("WebFormSpanTwo").innerHTML = "<a href=\"" + TEMP_VDIC_web_form_address_two + "\" target=\"" + web_form_target + "\" onMouseOver=\"WebFormTwoRefresH('IN');\"><IMG SRC=\"../agc/images/cn/vdc_LB_webform_two_cn.gif\" border=0 alt=\"网页表单 2\"></a>\n";
				}
			else 
				{
				document.getElementById("WebFormSpanTwo").innerHTML = "<a href=\"" + TEMP_VDIC_web_form_address_two + "\" target=\"" + web_form_target + "\" onMouseOut=\"WebFormTwoRefresH('OUT');\"><IMG SRC=\"../agc/images/cn/vdc_LB_webform_two_cn.gif\" border=0 alt=\"网页表单 2\"></a>\n";
				}
			}
		}
            //Modified by Kelvin End

		}


// ################################################################################
// Send hangup a second time from the dispo screen 
	function DispoHanguPAgaiN() 
	{
	form_cust_channel = AgaiNHanguPChanneL;
	document.vicidial_form.callchannel.value = AgaiNHanguPChanneL;
	document.vicidial_form.callserverip.value = AgaiNHanguPServeR;
	lastcustchannel = AgaiNHanguPChanneL;
	lastcustserverip = AgaiNHanguPServeR;
	VD_live_call_secondS = AgainCalLSecondS;
	CalLCID = AgaiNCalLCID;

	document.getElementById("DispoSelectHAspan").innerHTML = "";

	dialedcall_send_hangup();
	}


// ################################################################################
// Send leave 3way call a second time from the dispo screen 
	function DispoLeavE3wayAgaiN() 
	{
	XDchannel = DispO3wayXtrAchannel;
	//Mod by fnatic
	//document.vicidial_form.xfernumber.value = DispO3wayCalLxfernumber;
	document.getElementById("xfernumber").value = DispO3wayCalLxfernumber;
	MDchannel = DispO3waychannel;
	lastcustserverip = DispO3wayCalLserverip;

	document.getElementById("DispoSelectHAspan").innerHTML = "";

	leave_3way_call('SECOND');

	DispO3waychannel = '';
	DispO3wayXtrAchannel = '';
	DispO3wayCalLserverip = '';
	DispO3wayCalLxfernumber = '';
	DispO3wayCalLcamptail = '';
	}


// ################################################################################
// Start Hangup Functions for both 
	function bothcall_send_hangup() 
	{
		
		if (lastcustchannel.length > 3)
			{
			dialedcall_send_hangup();}
		if (lastxferchannel.length > 3)
			{
			xfercall_send_hangup();}
		}

// ################################################################################
// Send Hangup command for customer call connected to the conference now to Manager
	function dialedcall_send_hangup(dispowindow,hotkeysused,altdispo,nodeletevdac) 
		{
		if(AutoDialWaiting == 2){
			alert("提取电话正在通话中！");
		}else{
		ParkControlCount = 0;
		customerparked=0;
		// restore the global value + fnatic 
		Parked_Channel_Value="";
		Xfer_Target_Unavailable_Remind_Enable_Count=0;
        Queue_Music_Alert_Count=0;
		manudial_noanswer_log=0;
		if(CheckOutboundChannelLine2==0){
			document.getElementById("out_line12").innerHTML = "";
		}else{
			outbound_redirect_line2(session_id);
			//outbound_hangup_line2();
		}

		 
		// 如果有用转接功能的，要运行该函数停止轮轮询问 + fnatic
		stopCount_all();

		// 获得录音文件名称
		var stop_recording_filename = document.getElementById("RecorDingFilename_input").value;
		
		// 恢复话务员文字的可点击
		document.getElementById("agentdirectlink").innerHTML = '<b><a href="#" onClick="agent_check(this);XferAgentSelectLaunch();return false;" style="font-size:12px;" title="话务员">话务员</a></b>';
		// 结束

		if(dial_method=='INBOUND_MAN' && inbound_mode=='ring')
			{
			client_phone_manager('client_phone_hangup');	//挂断坐席分机
			grab_client_phone_command=0;	
			client_phone_channel_check_enable=0;
			client_phone_channel_check_count=0;
			}	
		
		// 修复录音按钮隐藏时不能挂断录音通道 + fantic
		if(LIVE_campaign_recording == 'ALLFORCE' || LIVE_campaign_recording == 'ALLCALLS')
			{			
			conf_send_recording('StopMonitorConf',session_id,stop_recording_filename);
			document.getElementById("RecorDingFilename_input").value='';
			//document.getElementById("recording_debug").innerHTML = "录音停止";
			}
		// 结束

		if (VDCL_group_id.length > 1)
			{var group = VDCL_group_id;}
		else
			{var group = campaign;}
		var form_cust_channel = document.vicidial_form.callchannel.value;
		var form_cust_serverip = document.vicidial_form.callserverip.value;
		var customer_channel = lastcustchannel;
		var customer_server_ip = lastcustserverip;
		AgaiNHanguPChanneL = lastcustchannel;
		AgaiNHanguPServeR = lastcustserverip;
		AgainCalLSecondS = VD_live_call_secondS;
		AgaiNCalLCID = CalLCID;
		var process_post_hangup=0;
		if ( (RedirecTxFEr < 1) && ( (MD_channel_look==1) || (auto_dial_level == 0) ) )
			{
			MD_channel_look=0;
			DialTimeHangup('MAIN');
			}
		if (form_cust_channel.length > 3)
			{
			var xmlhttp=false;
			/*@cc_on @*/
			/*@if (@_jscript_version >= 5)
			// JScript gives us Conditional compilation, we can cope with old IE versions.
			// and security blocked creation of the objects.
			 try {
			  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
			 } catch (e) {
			  try {
			   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			  } catch (E) {
			   xmlhttp = false;
			  }
			 }
			@end @*/
			if (!xmlhttp && typeof XMLHttpRequest!='undefined')
				{
				xmlhttp = new XMLHttpRequest();
				}
			if (xmlhttp) 
				{ 
				var queryCID = "HLvdcW" + epoch_sec + user_abb;
				var hangupvalue = customer_channel;
				//		alert(auto_dial_level + "|" + CalLCID + "|" + customer_server_ip + "|" + hangupvalue + "|" + VD_live_call_secondS);
				custhangup_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=Hangup&format=text&user=" + user + "&pass=" + pass + "&channel=" + hangupvalue + "&call_server_ip=" + customer_server_ip + "&queryCID=" + queryCID + "&auto_dial_level=" + auto_dial_level + "&CalLCID=" + CalLCID + "&secondS=" + VD_live_call_secondS + "&exten=" + session_id + "&campaign=" + group + "&stage=CALLHANGUP&nodeletevdac=" + nodeletevdac;
				xmlhttp.open('POST', 'manager_send.php'); 
				xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
				xmlhttp.send(custhangup_query); 
				xmlhttp.onreadystatechange = function() 
					{ 
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
						{
						Nactiveext = null;
						Nactiveext = xmlhttp.responseText;

					//		alert(xmlhttp.responseText);
					//	var HU_debug = xmlhttp.responseText;
					//	var HU_debug_array=HU_debug.split(" ");
					//	if (HU_debug_array[0] == 'Call')
					//		{
					//		alert(xmlhttp.responseText);
					//		}
						xmlhttp = null;
						CollectGarbage();
						}
					}
				process_post_hangup=1;
				delete xmlhttp;
				}
			}
			else {process_post_hangup=1;}
			if (process_post_hangup==1)
			{
			VD_live_customer_call = 0;
			VD_live_call_secondS = 0;
		//	alert(MD_ring_secondS+'|'+VD_live_customer_call);
			MD_ring_secondS = 0;
			CalLCID = '';
			MDnextCID = '';

		//	UPDATE VICIDIAL_LOG ENTRY FOR THIS DIAL PROCESS
			DialLog("end",nodeletevdac);
			conf_dialed=0;


			if (dispowindow == 'NO')
				{
				open_dispo_screen=0;
				}
			else
				{
				if (auto_dial_level == 0)			
					{
					if (document.vicidial_form.DiaLAltPhonE.checked==true)
						{
						reselect_alt_dial = 1;
						open_dispo_screen=0;
						}
					else
						{
						reselect_alt_dial = 0;
						open_dispo_screen=1;
						}
					}
				else
					{
					if (document.vicidial_form.DiaLAltPhonE.checked==true)
						{
						reselect_alt_dial = 1;
						open_dispo_screen=0;
						auto_dial_level=0;
						manual_dial_in_progress=1;
						auto_dial_alt_dial=1;
						}
					else
						{
						reselect_alt_dial = 0;
						open_dispo_screen=1;
						}
					}
				}

		//  DEACTIVATE CHANNEL-DEPENDANT BUTTONS AND VARIABLES
			document.vicidial_form.callchannel.value = '';
			document.vicidial_form.callserverip.value = '';
			lastcustchannel='';
			lastcustserverip='';
			MDchannel='';
       
			if( document.images ) { document.images['livecall'].src = image_livecall_OFF.src;}
            //Modified by Kelvin Begin
			if (WebForm_Button_Display !='NONE' ) {
			document.getElementById("WebFormSpan").innerHTML = "<IMG SRC=\"../agc/images/cn/vdc_LB_webform_OFF_cn.gif\" border=0 alt=\"网页表单\">";
			if (enable_second_webform > 0)
				{
				document.getElementById("WebFormSpanTwo").innerHTML = "<IMG SRC=\"../agc/images/cn/vdc_LB_webform_two_OFF_cn.gif\" border=0 alt=\"网页表单 2\">";
				}
			}
            //Modified by Kelvin Begin
			document.getElementById("ParkControl").innerHTML = "<IMG SRC=\"../agc/images/cn/vdc_LB_parkcall_OFF_cn.gif\" border=0 alt=\"保持电话\">";
			document.getElementById("HangupControl").innerHTML = "<IMG SRC=\"../agc/images/cn/vdc_LB_hangupcustomer_OFF_cn.gif\" border=0 alt=\"挂断\">";
			if (VU_vicidial_transfers == '1'){
				document.getElementById("XferControl").innerHTML = "<IMG SRC=\"../agc/images/cn/vdc_LB_transferconf_OFF_cn.gif\" border=0 alt=\"转接\">";
			}

			//Mod by fnatic start
			if(Xfer_Local_Closer_Display=='Y')
				{
			document.getElementById("LocalCloser").innerHTML = "<IMG SRC=\"../agc/images/vdc_XB_localcloser_OFF_cn.gif\" border=0 alt=\"LOCAL CLOSER\" style=\"vertical-align:middle\">";
				}		
			if(Xfer_Blind_Display=='Y')
			   {
			document.getElementById("DialBlindTransfer").innerHTML = "<IMG SRC=\"../agc/images/cn/vdc_XB_blindtransfer_OFF_cn.gif\" border=0 alt=\"盲转\" style=\"vertical-align:middle\">";
			   }			
			if(Xfer_Answer_Machine_Message_Display=='Y')
				{
			document.getElementById("DialBlindVMail").innerHTML = "<IMG SRC=\"../agc/images/vdc_XB_ammessage_OFF_cn.gif\" border=0 alt=\"Blind Transfer VMail Message\" style=\"vertical-align:middle\">";
				}
			//Mod by fnatic end

			document.getElementById("VolumeUpSpan").innerHTML = "<IMG SRC=\"../agc/images/vdc_volume_up_off.gif\" BORDER=0>";
			document.getElementById("VolumeDownSpan").innerHTML = "<IMG SRC=\"../agc/images/vdc_volume_down_off.gif\" BORDER=0>";

			if (quick_transfer_button_enabled > 0)
				{document.getElementById("QuickXfer").innerHTML = "<IMG SRC=\"../agc/images/vdc_LB_quickxfer_OFF_cn.gif\" border=0 alt=\"快速转接\">";}

			if (call_requeue_button > 0)
				{
				document.getElementById("ReQueueCall").innerHTML =  "<IMG SRC=\"../agc/images/vdc_LB_requeue_call_OFF.gif\" border=0 alt=\"快速转接\">";
				}

			document.vicidial_form.custdatetime.value		= '';

			if ( (auto_dial_level == 0) && (dial_method != 'INBOUND_MAN') )
				{
				if (document.vicidial_form.DiaLAltPhonE.checked==true)
					{
					reselect_alt_dial = 1;
					if (altdispo == 'ALTPH2')
						{
						ManualDialOnly('ALTPhonE');
						}
					else
						{
						if (altdispo == 'ADDR3')
							{
							ManualDialOnly('AddresS3');
							}
						else
							{
							if (hotkeysused == 'YES')
								{
								reselect_alt_dial = 0;
								manual_auto_hotkey = 1;
								}
							}
						}
					}
				else
					{
					if (hotkeysused == 'YES')
						{
						manual_auto_hotkey = 1;
						}
					else
						{
						//Mod by fnatic start
						if(Dial_Next_Display=='Y')
							{
						document.getElementById("DiaLControl").innerHTML = "<a href=\"#\" onclick=\"ManualDialNext('','','','','','0');\"><IMG SRC=\"../agc/images/cn/vdc_LB_dialnextnumber_cn.gif\" border=0 alt=\"挂断\"></a>";
							}
						else
							{
							document.getElementById("DiaLControl").innerHTML = "";					
						    }
						//Mod by fnatic end
						}
					reselect_alt_dial = 0;
					}
				}
			else
				{
				if (document.vicidial_form.DiaLAltPhonE.checked==true)
					{
					reselect_alt_dial = 1;
					if (altdispo == 'ALTPH2')
						{
						ManualDialOnly('ALTPhonE');
						}
					else
						{
						if (altdispo == 'ADDR3')
							{
							ManualDialOnly('AddresS3');
							}
						else
							{
							if (hotkeysused == 'YES')
								{
								manual_auto_hotkey = 1;
								alt_dial_active=0;

								//document.getElementById("MainStatuSSpan").style.background = panel_bgcolor;
								document.getElementById("MainStatuSSpan").style.Color = panel_bgcolor;
								document.getElementById("MainStatuSSpan").innerHTML = '';
								if (dial_method == "INBOUND_MAN")
									{
									//Mod by fnatic start
									if(Dial_Next_Display=='Y')
										{
									document.getElementById("DiaLControl").innerHTML = "<IMG SRC=\"../agc/images/cn/vdc_LB_pause_OFF_cn.gif\" border=0 alt=\"暂停\"><IMG SRC=\"../agc/images/cn/vdc_LB_resume_OFF_cn.gif\" border=0 alt=\"恢复\"><BR><IMG SRC=\"../agc/images/cn/vdc_LB_dialnextnumber_OFF_cn.gif\" border=0 alt=\"挂断\">";
										}
									else
										{
										document.getElementById("DiaLControl").innerHTML = "<IMG SRC=\"../agc/images/cn/vdc_LB_pause_OFF_cn.gif\" border=0 alt=\"暂停\"><IMG SRC=\"../agc/images/cn/vdc_LB_resume_OFF_cn.gif\" border=0 alt=\"恢复\">";								
									    }
								    //Mod by fnatic end
									}
								else
									{
									document.getElementById("DiaLControl").innerHTML = DiaLControl_auto_HTML_OFF;
									}
								reselect_alt_dial = 0;
								}
							}
						}
					}
				else
					{
					//document.getElementById("MainStatuSSpan").style.background = panel_bgcolor;
					document.getElementById("MainStatuSSpan").style.Color = panel_bgcolor;
					if (dial_method == "INBOUND_MAN")
						{
						//Mod by fnatic start
						if(Dial_Next_Display=='Y')
							{
						document.getElementById("DiaLControl").innerHTML = "<IMG SRC=\"../agc/images/cn/vdc_LB_pause_OFF_cn.gif\" border=0 alt=\"暂停\"><IMG SRC=\"../agc/images/cn/vdc_LB_resume_OFF_cn.gif\" border=0 alt=\"恢复\"><BR><IMG SRC=\"../agc/images/cn/vdc_LB_dialnextnumber_OFF_cn.gif\" border=0 alt=\"挂断\">";
						    }
						else
					       {
						document.getElementById("DiaLControl").innerHTML = "<IMG SRC=\"../agc/images/cn/vdc_LB_pause_OFF_cn.gif\" border=0 alt=\"暂停\"><IMG SRC=\"../agc/images/cn/vdc_LB_resume_OFF_cn.gif\" border=0 alt=\"恢复\">";			
						   }
						//Mod by fnatic end
						}
					else
						{
						document.getElementById("DiaLControl").innerHTML = DiaLControl_auto_HTML_OFF;
						}
					reselect_alt_dial = 0;
					}
				}

			ShoWTransferMain('OFF');
			}
			//yanson@20110310 start
			try
			{
				document.getElementById("consultativexfer").disabled=false;
				document.getElementById("xferoverride").disabled=false;
				document.getElementById("xferoverrideaaa").disabled=false;
				document.getElementById("xferoverridebbb").disabled=false;
			}catch(err){ }
			document.getElementById("Leave3WayCall").innerHTML ="<IMG SRC=\"../agc/images/cn/vdc_XB_leave3waycall_OFF_cn.gif\" border=0 alt=\"离开三方通话\" style=\"vertical-align:middle\">"; 
		}
		}


// ################################################################################
// Send Hangup command for 3rd party call connected to the conference now to Manager
	function xfercall_send_hangup() 
		{			
		//Mod by fnatic var xferchannel = document.vicidial_form.xferchannel.value;
        var xferchannel = document.getElementById("xferchannel").value;
		var xfer_channel = lastxferchannel;
		var process_post_hangup=0;
		if ( (MD_channel_look==1) && (leaving_threeway < 1) )
			{
			MD_channel_look=0;
			DialTimeHangup('XFER');
			}

		if (xferchannel.length > 3)
			{
			var xmlhttp=false;
			/*@cc_on @*/
			/*@if (@_jscript_version >= 5)
			// JScript gives us Conditional compilation, we can cope with old IE versions.
			// and security blocked creation of the objects.
			 try {
			  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
			 } catch (e) {
			  try {
			   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			  } catch (E) {
			   xmlhttp = false;
			  }
			 }
			@end @*/
			if (!xmlhttp && typeof XMLHttpRequest!='undefined')
				{
				xmlhttp = new XMLHttpRequest();
				}
			if (xmlhttp) 
				{ 
				var queryCID = "HXvdcW" + epoch_sec + user_abb;
				var hangupvalue = xfer_channel;
				custhangup_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=Hangup&format=text&user=" + user + "&pass=" + pass + "&channel=" + hangupvalue + "&queryCID=" + queryCID;
			//	alert(custhangup_query);

				xmlhttp.open('POST', 'manager_send.php'); 
				xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
				xmlhttp.send(custhangup_query); 
				xmlhttp.onreadystatechange = function() 
					{ 
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
						{
						Nactiveext = null;
						Nactiveext = xmlhttp.responseText;
				//		alert(xmlhttp.responseText);
						xmlhttp = null;
						CollectGarbage();
						}
					}
				process_post_hangup=1;
				delete xmlhttp;
				}
			}
		else {process_post_hangup=1;}
		if (process_post_hangup==1)
			{
			XD_live_customer_call = 0;
			XD_live_call_secondS = 0;
			MD_ring_secondS = 0;
			MD_channel_look=0;
			XDnextCID = '';
			XDcheck = '';
			xferchannellive=0;

		//  DEACTIVATE CHANNEL-DEPENDANT BUTTONS AND VARIABLES
		//Mod by fnatic	document.vicidial_form.xferchannel.value = "";
		    document.getElementById("xferchannel").value = '';
			lastxferchannel='';

		//	document.getElementById("Leave3WayCall").innerHTML ="<IMG SRC=\"../agc/images/vdc_XB_leave3waycall_OFF_cn.gif\" border=0 alt=\"离开三方通话\">";
		   
		    //Mod by fnatic start
            if(Xfer_Dial_With_Customer_Display=='Y')
				{
			document.getElementById("DialWithCustomer").innerHTML ="<a href=\"#\" onclick=\"DialWithCustomerClick(1);return false;\"><IMG SRC=\"../agc/images/cn/vdc_XB_dialwithcustomer_cn.gif\" border=0 alt=\"不挂断拨号\" style=\"vertical-align:middle\"></a>";
			    }
            
			document.getElementById("ParkCustomerDial").innerHTML ="<a href=\"#\" onclick=\"DialWithCustomerClick(0);return false;\"><IMG SRC=\"../agc/images/cn/vdc_XB_parkcustomerdial_cn.gif\" border=0 alt=\"保持客户拨号\" style=\"vertical-align:middle\"></a>";
            //when project is ehsn image changed
            if(Fast_Hangup_Xferline_And_Grab_Custline=='N')
				{
			document.getElementById("HangupXferLine").innerHTML ="<IMG SRC=\"../agc/images/cn/vdc_XB_hangupxferline_OFF_cn.gif\" border=0 alt=\"挂断第三方转接线\" style=\"vertical-align:middle\">";
				}
            else
				{
			document.getElementById("Leave3WayCall").innerHTML ="<IMG SRC=\"../agc/images/cn/vdc_XB_leave3waycall_OFF_cn.gif\" border=0 alt=\"离开三方通话\" style=\"vertical-align:middle\">";
            document.getElementById("HangupXferLine").innerHTML ="<IMG SRC=\"../agc/images/cn/vdc_XB_hangupxferline_OFF_cn_ehsn.gif\" border=0 alt=\"挂断第三方转接线\" style=\"vertical-align:middle\">";
				}
	
			document.getElementById("HangupBothLines").innerHTML ="<IMG SRC=\"../agc/images/cn/vdc_XB_hangupbothlines_OFF_cn.gif\" border=0 alt=\"全部挂断\" style=\"vertical-align:middle\">";
			}
		    //Add by fnatic start
			//$("#TransferMainDIV").dialog("close");
			//Add by fnatic end
		}

// ################################################################################
// Send Hangup command for any Local call that is not in the quiet(7) entry - used to stop manual dials even if no connect
	function DialTimeHangup(tasktypecall) 
		{
		if ( (RedirecTxFEr < 1) && (leaving_threeway < 1) )
			{
	//	alert("RedirecTxFEr|" + RedirecTxFEr);
		MD_channel_look=0;
		var xmlhttp=false;
		/*@cc_on @*/
		/*@if (@_jscript_version >= 5)
		// JScript gives us Conditional compilation, we can cope with old IE versions.
		// and security blocked creation of the objects.
		 try {
		  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		 } catch (e) {
		  try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  } catch (E) {
		   xmlhttp = false;
		  }
		 }
		@end @*/
		if (!xmlhttp && typeof XMLHttpRequest!='undefined')
			{
			xmlhttp = new XMLHttpRequest();
			}
		if (xmlhttp) 
			{ 
			var queryCID = "HTvdcW" + epoch_sec + user_abb;
			custhangup_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=HangupConfDial&format=text&user=" + user + "&pass=" + pass + "&exten=" + session_id + "&ext_context=" + ext_context + "&queryCID=" + queryCID;
			xmlhttp.open('POST', 'manager_send.php'); 
			xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
			xmlhttp.send(custhangup_query); 
			xmlhttp.onreadystatechange = function() 
				{ 
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
					{
					Nactiveext = null;
					Nactiveext = xmlhttp.responseText;
				//	alert(xmlhttp.responseText + "\n" + tasktypecall + "\n" + leaving_threeway);
										xmlhttp = null;
						CollectGarbage();
 					}
				}
			delete xmlhttp;
			}
			}
		}


// ################################################################################
// Update vicidial_list lead record with all altered values from form
	function CustomerData_update()
		{

		var REGcommentsAMP = new RegExp('&',"g");
		var REGcommentsQUES = new RegExp("\\?","g");
		var REGcommentsPOUND = new RegExp("\\#","g");
		var REGcommentsRESULT = document.vicidial_form.comments.value.replace(REGcommentsAMP, "MP--");
		REGcommentsRESULT = REGcommentsRESULT.replace(REGcommentsQUES, "--QUES--");
		REGcommentsRESULT = REGcommentsRESULT.replace(REGcommentsPOUND, "--POUND--");

		var xmlhttp=false;
		/*@cc_on @*/
		/*@if (@_jscript_version >= 5)
		// JScript gives us Conditional compilation, we can cope with old IE versions.
		// and security blocked creation of the objects.
		 try {
		  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		 } catch (e) {
		  try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  } catch (E) {
		   xmlhttp = false;
		  }
		 }
		@end @*/
		if (!xmlhttp && typeof XMLHttpRequest!='undefined')
			{
			xmlhttp = new XMLHttpRequest();
			}
		if (xmlhttp) 
			{ 

			var genderIndex = document.getElementById("gender_list").selectedIndex;
			var genderValue =  document.getElementById('gender_list').options[genderIndex].value;
			document.vicidial_form.gender.value = genderValue;

			VLupdate_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&campaign=" + campaign +  "&ACTION=updateLEAD&format=text&user=" + user + "&pass=" + pass + 
			"&lead_id=" + document.vicidial_form.lead_id.value + 
			"&vendor_lead_code=" + document.vicidial_form.vendor_lead_code.value + 
			"&phone_number=" + document.vicidial_form.phone_number.value + 
			"&title=" + document.vicidial_form.title.value + 
			"&first_name=" + document.vicidial_form.first_name.value + 
			"&middle_initial=" + document.vicidial_form.middle_initial.value + 
			"&last_name=" + document.vicidial_form.last_name.value + 
			"&address1=" + document.vicidial_form.address1.value + 
			"&address2=" + document.vicidial_form.address2.value + 
			"&address3=" + document.vicidial_form.address3.value + 
			"&city=" + document.vicidial_form.city.value + 
			"&state=" + document.vicidial_form.state.value + 
			"&province=" + document.vicidial_form.province.value + 
			"&postal_code=" + document.vicidial_form.postal_code.value + 
			"&country_code=" + document.vicidial_form.country_code.value + 
			"&gender=" + document.vicidial_form.gender.value + 
			"&date_of_birth=" + document.vicidial_form.date_of_birth.value + 
			"&alt_phone=" + document.vicidial_form.alt_phone.value + 
			"&email=" + document.vicidial_form.email.value + 
			"&security_phrase=" + document.vicidial_form.security_phrase.value + 
			"&comments=" + REGcommentsRESULT;
			xmlhttp.open('POST', 'vdc_db_query.php'); 
			xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
			xmlhttp.send(VLupdate_query); 
			xmlhttp.onreadystatechange = function() 
				{ 
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
					{
				//	alert(xmlhttp.responseText);
										xmlhttp = null;
						CollectGarbage();
					}
				}
			delete xmlhttp;
			}

		}

// ################################################################################
// Generate the Call Disposition Chooser panel
	function DispoSelectContent_NA_create(taskDSgrp,taskDSstage)
		{
		HidEGenDerPulldown();
		AgentDispoing = 1;
		var VD_NAstatuses_ct_half = parseInt(VD_NAstatuses_ct / 2);
		var dispo_HTML = "<table cellpadding=5 cellspacing=5 width='100%'><tr>No Answer<td bgcolor='#FEFBE2' style='border:1px solid #FEEB84;border-collapse:collapse;' height=300 width=240 valign=top>";
		var loop_ct = 0;
		var PauseCode_Default = "";
		var Default_Call_Result = "";
		document.getElementById("DispoSelection").value = Default_Call_Result;
		while (loop_ct < VD_NAstatuses_ct)
			{
			if(Default_Call_Result == VARNAstatuses[loop_ct]){
				dispo_HTML = dispo_HTML + "<div class='dispo_content_normal' onmousemove=\"this.className='dispo_content_hover'\" onmouseout=\"this.className='dispo_content_normal'\" title='"+VARNAstatusnames[loop_ct]+"'><input type=\"radio\" name=\"DispoResultRadioSelect\" value=\"" + VARNAstatuses[loop_ct] + "\" id=\"DispoResultRadioSelect\" onclick=\"setDispoResultDispoSelection(this);\" checked/>" + VARNAstatuses[loop_ct] + " - " + VARNAstatusnames[loop_ct] + "</div>";
			}else{
				dispo_HTML = dispo_HTML + "<div class='dispo_content_normal' onmousemove=\"this.className='dispo_content_hover'\" onmouseout=\"this.className='dispo_content_normal'\" title='"+VARNAstatusnames[loop_ct]+"'><input type=\"radio\" name=\"DispoResultRadioSelect\" value=\"" + VARNAstatuses[loop_ct] + "\" id=\"DispoResultRadioSelect\" onclick=\"setDispoResultDispoSelection(this);\"/>" + VARNAstatuses[loop_ct] + " - " + VARNAstatusnames[loop_ct] + "</div>";
			}
			loop_result = loop_ct % 12 ;
			//alert(loop_result);
			//if (loop_ct == VD_NAstatuses_ct_half) 
			//小结数量超过23，按照每12个多分一个单元格的样式排列，小于23按照默认样式排列 + fnatic 
			if (VD_NAstatuses_ct > 23)
				{
				if (loop_ct>0 && !loop_result)
					{
					dispo_HTML = dispo_HTML + "</td><td bgcolor='#FEFBE2' style='border:1px solid #FEEB84;border-collapse:collapse;' height=300 width=240 valign=top>";
					}
				}
			else
				{
				if (loop_ct == VD_NAstatuses_ct_half)
					{
					dispo_HTML = dispo_HTML + "</td><td bgcolor='#FEFBE2' style='border:1px solid #FEEB84;border-collapse:collapse;' height=300 width=240 valign=top>";
					}
				}
			loop_ct++;
			}
		dispo_HTML = dispo_HTML + "</td></tr></table>";
				PauseCode_HTML = '';

		document.getElementById("PauseCodeSelection").value = '';

		PauseCode_HTML = "<table class=\"pausecode_tb\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"100%\" ><tr><td>";
		var loop_ct = 0;
		while (loop_ct < VD_pause_codes_ct)
		{
			if((PauseCode_Default!="") && (PauseCode_Default==VARpause_codes[loop_ct])){
				PauseCode_HTML = PauseCode_HTML + "<input onclick=\"PauseCodeSelect_submit('" + VARpause_codes[loop_ct] + "');\" type=\"radio\" name=\"PauseRadioSelect\" value=\"" + VARpause_codes[loop_ct] + "\" id=\"PauseRadioSelect\" disabled=\"disabled\" checked=\"checked\"/>" + VARpause_codes[loop_ct] + " - " + VARpause_code_names[loop_ct] + "&nbsp;&nbsp;";
			}else{
				PauseCode_HTML = PauseCode_HTML + "<input onclick=\"PauseCodeSelect_submit('" + VARpause_codes[loop_ct] + "');\" type=\"radio\" name=\"PauseRadioSelect\" value=\"" + VARpause_codes[loop_ct] + "\" id=\"PauseRadioSelect\" disabled=\"disabled\"/>" + VARpause_codes[loop_ct] + " - " + VARpause_code_names[loop_ct] + "&nbsp;&nbsp;";
			}
			loop_ct++;
		}

		PauseCode_HTML = PauseCode_HTML + "</td></tr></table>";
		if (agent_pause_codes_active=='FORCE' || agent_pause_codes_active=='Y'){
			document.getElementById("DispoPauseHTMLContent").innerHTML = PauseCode_HTML;
		}		
		document.getElementById("DispoSelectContent").innerHTML = dispo_HTML;
		}

// ################################################################################

// ################################################################################
// Generate the Call Disposition Chooser panel
	function DispoSelectContent_create(taskDSgrp,taskDSstage)
		{
		HidEGenDerPulldown();
		AgentDispoing = 1;
		var VD_statuses_ct_half = parseInt(VD_statuses_ct / 2);
		var dispo_HTML = "<table cellpadding=5 cellspacing=5 width='100%'><tr>Answer<td bgcolor='#FEFBE2' style='border:1px solid #FEEB84;border-collapse:collapse;' height=300 width=240 valign=top>";
		var loop_ct = 0;
		var PauseCode_Default = "";
		var Default_Call_Result = "";
		document.getElementById("DispoSelection").value = Default_Call_Result;
		while (loop_ct < VD_statuses_ct)
			{
			if(Default_Call_Result == VARstatuses[loop_ct]){
				dispo_HTML = dispo_HTML + "<div class='dispo_content_normal' onmousemove=\"this.className='dispo_content_hover'\" onmouseout=\"this.className='dispo_content_normal'\" title='"+VARstatusnames[loop_ct]+"'><input type=\"radio\" name=\"DispoResultRadioSelect\" value=\"" + VARstatuses[loop_ct] + "\" id=\"DispoResultRadioSelect\" onclick=\"setDispoResultDispoSelection(this);\" checked/>" + VARstatuses[loop_ct] + " - " + VARstatusnames[loop_ct] + "</div>";
			}else{
				dispo_HTML = dispo_HTML + "<div class='dispo_content_normal' onmousemove=\"this.className='dispo_content_hover'\" onmouseout=\"this.className='dispo_content_normal'\" title='"+VARstatusnames[loop_ct]+"'><input type=\"radio\" name=\"DispoResultRadioSelect\" value=\"" + VARstatuses[loop_ct] + "\" id=\"DispoResultRadioSelect\" onclick=\"setDispoResultDispoSelection(this);\"/>" + VARstatuses[loop_ct] + " - " + VARstatusnames[loop_ct] + "</div>";
			}
			loop_result = loop_ct % 12 ;
			//alert(loop_result);
			//if (loop_ct == VD_statuses_ct_half) 
			//小结数量超过23，按照每12个多分一个单元格的样式排列，小于23按照默认样式排列 + fnatic 
			if (VD_statuses_ct > 23)
				{
				if (loop_ct>0 && !loop_result)
					{
					dispo_HTML = dispo_HTML + "</td><td bgcolor='#FEFBE2' style='border:1px solid #FEEB84;border-collapse:collapse;' height=300 width=240 valign=top>";
					}
				}
			else
				{
				if (loop_ct == VD_statuses_ct_half)
					{
					dispo_HTML = dispo_HTML + "</td><td bgcolor='#FEFBE2' style='border:1px solid #FEEB84;border-collapse:collapse;' height=300 width=240 valign=top>";
					}
				}
			loop_ct++;
			}
		dispo_HTML = dispo_HTML + "</td></tr></table>";
				PauseCode_HTML = '';

		document.getElementById("PauseCodeSelection").value = '';

		PauseCode_HTML = "<table class=\"pausecode_tb\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"100%\" ><tr><td>";
		var loop_ct = 0;
		while (loop_ct < VD_pause_codes_ct)
		{
			if((PauseCode_Default!="") && (PauseCode_Default==VARpause_codes[loop_ct])){
				PauseCode_HTML = PauseCode_HTML + "<input onclick=\"PauseCodeSelect_submit('" + VARpause_codes[loop_ct] + "');\" type=\"radio\" name=\"PauseRadioSelect\" value=\"" + VARpause_codes[loop_ct] + "\" id=\"PauseRadioSelect\" disabled=\"disabled\" checked=\"checked\"/>" + VARpause_codes[loop_ct] + " - " + VARpause_code_names[loop_ct] + "&nbsp;&nbsp;";
			}else{
				PauseCode_HTML = PauseCode_HTML + "<input onclick=\"PauseCodeSelect_submit('" + VARpause_codes[loop_ct] + "');\" type=\"radio\" name=\"PauseRadioSelect\" value=\"" + VARpause_codes[loop_ct] + "\" id=\"PauseRadioSelect\" disabled=\"disabled\"/>" + VARpause_codes[loop_ct] + " - " + VARpause_code_names[loop_ct] + "&nbsp;&nbsp;";
			}
			loop_ct++;
		}

		PauseCode_HTML = PauseCode_HTML + "</td></tr></table>";
		if (agent_pause_codes_active=='FORCE' || agent_pause_codes_active=='Y'){
			document.getElementById("DispoPauseHTMLContent").innerHTML = PauseCode_HTML;
		}		
		document.getElementById("DispoSelectContent").innerHTML = dispo_HTML;
		}

// ################################################################################

// Generate the pause Code Chooser panel
	function PauseCodeSelectContent_create()
		{
				
		if ( (AutoDialWaiting == 1) || (VD_live_customer_call==1) || (alt_dial_active==1) || (MD_channel_look==1) )
			{
			alert("你必须先暂停才能输入暂停码!");
			}
		else
			{
			HidEGenDerPulldown();

			showDiv('PauseCodeSelectBox');
			var PauseCode_Default = "";
			WaitingForNextStep=1;
			PauseCode_HTML = '';
			//Mod by fnatic document.vicidial_form.PauseCodeSelection.value = '';	
			document.getElementById("PauseCodeSelection").value = '';	
			var VD_pause_codes_ct_half = parseInt(VD_pause_codes_ct / 2);
			PauseCode_HTML = "<table class=\"pausecode_tb\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"100%\" ><tr><td>";
			var loop_ct = 0;
			while (loop_ct < VD_pause_codes_ct)
				{
				//PauseCode_HTML = PauseCode_HTML + "<tr><td><a class=\"pausedcode\" href=\"#\" onclick=\"PauseCodeSelect_submit('" + VARpause_codes[loop_ct] + "');return false;\">" + VARpause_codes[loop_ct] + "  </a>"+"-"+VARpause_code_names[loop_ct]+"<td></tr>";	
				if((PauseCode_Default!="") && (PauseCode_Default==VARpause_codes[loop_ct])){
					PauseCode_HTML = PauseCode_HTML + "<input class=\"pausedcode\" type=\"radio\" name=\"PauseCodeSelectRadio\" value=\"" + VARpause_codes[loop_ct] + "\" checked=\"checked\"/>" + VARpause_codes[loop_ct] + "  "+"-"+VARpause_code_names[loop_ct]+"&nbsp;&nbsp;";
				}else{
					PauseCode_HTML = PauseCode_HTML + "<input class=\"pausedcode\" type=\"radio\" name=\"PauseCodeSelectRadio\" value=\"" + VARpause_codes[loop_ct] + "\"/>" + VARpause_codes[loop_ct] + "  "+"-"+VARpause_code_names[loop_ct]+"&nbsp;&nbsp;";
				}
				
				loop_ct++;
				if (loop_ct == VD_pause_codes_ct_half) 
					{PauseCode_HTML = PauseCode_HTML + "";}
				}
			/*
			if (agent_pause_codes_active=='FORCE')
				{var Go_BacK_LinK = '';}
			else
				{var Go_BacK_LinK = "<a href=\"#\" onclick=\"PauseCodeSelect_submit('');return false;\">Go Back</a>";}
			*/
			if (agent_pause_codes_active=='Y')
				{var Close_LinK = "&nbsp;&nbsp;<a href=\"#\" onclick=\"closePauseCodeSelect();return false;\" style=\"font-size:14px;\">取消</a>";}
			else
				{var Close_LinK = '';}
			PauseCode_HTML = PauseCode_HTML + "</td></tr><tr><td align=\"center\"><a href=\"#\" onclick=\"PauseCodeSelect_submit_by_radio();return false;\" style=\"font-size:14px;\">确认</a>" + Close_LinK + "</td></tr></td></tr></table>";
			document.getElementById("PauseCodeSelectContent").innerHTML = PauseCode_HTML;

			}
		}

// ################################################################################
// Generate the 技能组代名 Chooser panel
	function GroupAliasSelectContent_create(task3way)
		{
		HidEGenDerPulldown();
		showDiv('GroupAliasSelectBox');
		WaitingForNextStep=1;
		GroupAlias_HTML = '';
		document.vicidial_form.GroupAliasSelection.value = '';		
		var VD_group_aliases_ct_half = parseInt(VD_group_aliases_ct / 2);
		GroupAlias_HTML = "<table cellpadding=5 cellspacing=5 width=500><tr><td colspan=2><B> GROUP ALIAS</B></td></tr><tr><td bgcolor=\"#99FF99\" height=300 width=240 valign=top><font class=\"log_text\"><span id=GroupAliasSelectA>";
		if (task3way > 0)
			{
			VD_group_aliases_ct_half = (VD_group_aliases_ct_half - 1);
			GroupAlias_HTML = GroupAlias_HTML + "<font size=2 style=\"BACKGROUND-COLOR: #FFFFCC\"><b><a href=\"#\" onclick=\"GroupAliasSelect_submit('CAMPAIGN','" + campaign_cid + "','0');return false;\">CAMPAIGN - " + campaign_cid + "</a></b></font><BR><BR>";
			GroupAlias_HTML = GroupAlias_HTML + "<font size=2 style=\"BACKGROUND-COLOR: #FFFFCC\"><b><a href=\"#\" onclick=\"GroupAliasSelect_submit('CUSTOMER','" + document.vicidial_form.phone_number.value + "','0');return false;\">CUSTOMER - " + document.vicidial_form.phone_number.value + "</a></b></font><BR><BR>";
			GroupAlias_HTML = GroupAlias_HTML + "<font size=2 style=\"BACKGROUND-COLOR: #FFFFCC\"><b><a href=\"#\" onclick=\"GroupAliasSelect_submit('AGENT_PHONE','" + outbound_cid + "','0');return false;\">AGENT_PHONE - " + outbound_cid + "</a></b></font><BR><BR>";
			}
		var loop_ct = 0;
		while (loop_ct < VD_group_aliases_ct)
			{
			GroupAlias_HTML = GroupAlias_HTML + "<font size=2 style=\"BACKGROUND-COLOR: #FFFFCC\"><b><a href=\"#\" onclick=\"GroupAliasSelect_submit('" + VARgroup_alias_ids[loop_ct] + "','" + VARcaller_id_numbers[loop_ct] + "','1');return false;\">" + VARgroup_alias_ids[loop_ct] + " - " + VARgroup_alias_names[loop_ct] + " - " + VARcaller_id_numbers[loop_ct] + "</a></b></font><BR><BR>";
			loop_ct++;
			if (loop_ct == VD_group_aliases_ct_half) 
				{GroupAlias_HTML = GroupAlias_HTML + "</span></font></td><td bgcolor=\"#99FF99\" height=300 width=240 valign=top><font class=\"log_text\"><span id=GroupAliasSelectB>";}
			}

		var Go_BacK_LinK = "<font size=3 style=\"BACKGROUND-COLOR: #FFFFCC\"><b><a href=\"#\" onclick=\"GroupAliasSelect_submit('');return false;\">返回</a>";

		GroupAlias_HTML = GroupAlias_HTML + "</span></font></td></tr></table><BR><BR>" + Go_BacK_LinK;
		document.getElementById("GroupAliasSelectContent").innerHTML = GroupAlias_HTML;
		}

// ################################################################################
// open web form, then submit disposition
	function WeBForMDispoSelect_submit()
		{
		leaving_threeway=0;
		blind_transfer=0;
		document.vicidial_form.callchannel.value = '';
		document.vicidial_form.callserverip.value = '';
		//Mod by fnatic document.vicidial_form.xferchannel.value = '';
		document.getElementById("xferchannel").value = '';
		//Mod by fnatic start
		if(Xfer_Dial_With_Customer_Display=='Y')
			{
		document.getElementById("DialWithCustomer").innerHTML ="<a href=\"#\" onclick=\"DialWithCustomerClick(1);return false;\"><IMG SRC=\"../agc/images/cn/vdc_XB_dialwithcustomer_cn.gif\" border=0 alt=\"不挂断拨号\" style=\"vertical-align:middle\"></a>";
		    }
	    //Mod by fnatic end
		document.getElementById("ParkCustomerDial").innerHTML ="<a href=\"#\" onclick=\"DialWithCustomerClick(0);return false;\"><IMG SRC=\"../agc/images/cn/vdc_XB_parkcustomerdial_cn.gif\" border=0 alt=\"保持客户拨号\" style=\"vertical-align:middle\"></a>";
		document.getElementById("HangupBothLines").innerHTML ="<a href=\"#\" onclick=\"confirm_bothcall_send_hangup();return false;\"><IMG SRC=\"../agc/images/cn/vdc_XB_hangupbothlines_cn.gif\" border=0 alt=\"全部挂断\" style=\"vertical-align:middle\"></a>";

		var DispoChoice = document.getElementById("DispoSelection").value;

		if (DispoChoice.length < 1) {alert("请选择小结类别！");}
		else
			{
			document.getElementById("CusTInfOSpaN").innerHTML = "";
			document.getElementById("CusTInfOSpaN").style.background = panel_bgcolor;

			LeaDDispO = DispoChoice;
	
			WebFormRefresH('NO','YES');

			document.getElementById("WebFormSpan").innerHTML = "<IMG SRC=\"../agc/images/cn/vdc_LB_webform_OFF_cn.gif\" border=0 alt=\"网页表单\">";
			if (enable_second_webform > 0)
				{
				document.getElementById("WebFormSpanTwo").innerHTML = "<IMG SRC=\"../agc/images/cn/vdc_LB_webform_two_OFF_cn.gif\" border=0 alt=\"网页表单 2\">";
				}
			window.open(TEMP_VDIC_web_form_address, web_form_target, 'toolbar=1,scrollbars=1,location=1,statusbar=1,menubar=1,resizable=1,width=640,height=450');

			DispoSelect_submit();
			}
		}


// ################################################################################
// Update vicidial_list lead record with disposition selection
	function DispoSelect_submit()
		{
		if (VDCL_group_id.length > 1)
			{var group = VDCL_group_id;}
		else
			{var group = campaign;}
		leaving_threeway=0;
		blind_transfer=0;
		CheckDEADcallON=0;
		document.vicidial_form.callchannel.value = '';
		document.vicidial_form.callserverip.value = '';
		//Mod by fnatic document.vicidial_form.xferchannel.value = '';
		document.getElementById("xferchannel").value = '';
		//Mod by fnatic start
		if(Xfer_Dial_With_Customer_Display=='Y')
			{
		document.getElementById("DialWithCustomer").innerHTML ="<a href=\"#\" onclick=\"DialWithCustomerClick(1);return false;\"><IMG SRC=\"../agc/images/cn/vdc_XB_dialwithcustomer_cn.gif\" border=0 alt=\"不挂断拨号\" style=\"vertical-align:middle\"></a>";
			}
		document.getElementById("ParkCustomerDial").innerHTML ="<a href=\"#\" onclick=\"DialWithCustomerClick(0);return false;\"><IMG SRC=\"../agc/images/cn/vdc_XB_parkcustomerdial_cn.gif\" border=0 alt=\"保持客户拨号\" style=\"vertical-align:middle\"></a>";
		document.getElementById("HangupBothLines").innerHTML ="<a href=\"#\" onclick=\"confirm_bothcall_send_hangup();return false;\"><IMG SRC=\"../agc/images/cn/vdc_XB_hangupbothlines_cn.gif\" border=0 alt=\"全部挂断\" style=\"vertical-align:middle\"></a>";
        //电话小结后恢复挂断第三方转接线按狃为不可用,恢复转接面板还停留在话务员列表页
		//when project is ehsn image changed 
        if(Fast_Hangup_Xferline_And_Grab_Custline=='N')
			{
		document.getElementById("HangupXferLine").innerHTML ="<IMG SRC=\"../agc/images/cn/vdc_XB_hangupxferline_OFF_cn.gif\" border=0 alt=\"挂断第三方转接线\" style=\"vertical-align:middle\">";
			}
		else
			{
		document.getElementById("HangupXferLine").innerHTML ="<IMG SRC=\"../agc/images/cn/vdc_XB_hangupxferline_OFF_cn_ehsn.gif\" border=0 alt=\"挂断第三方转接线\" style=\"vertical-align:middle\">";
			}
			document.getElementById("Leave3WayCall").innerHTML ="<IMG SRC=\"../agc/images/cn/vdc_XB_leave3waycall_OFF_cn.gif\" border=0 alt=\"离开三方通话\" style=\"vertical-align:middle\">";
            document.getElementById("HangupXferLine").innerHTML ="<IMG SRC=\"../agc/images/cn/vdc_XB_hangupxferline_OFF_cn_ehsn.gif\" border=0 alt=\"挂断第三方转接线\" style=\"vertical-align:middle\">";
				
			document.getElementById("HangupBothLines").innerHTML ="<IMG SRC=\"../agc/images/cn/vdc_XB_hangupbothlines_OFF_cn.gif\" border=0 alt=\"全部挂断\" style=\"vertical-align:middle\">";
		AgentsXferSelect('0','AgentXferViewSelect');
		//Add by fnatic end
 
		
		var DispoChoice = document.getElementById("DispoSelection").value;

		if (DispoChoice.length < 1) {alert("请选择小结类别！");}
		else
			{
			document.getElementById("CusTInfOSpaN").innerHTML = "";
			document.getElementById("CusTInfOSpaN").style.background = panel_bgcolor;
			//更新联系历史记录(以下为vtiger_activity需要更新的字段)
			if(document.getElementById("vtiger_activity_id").value != ""){
				var activityid = document.getElementById("vtiger_activity_id").value;
				document.getElementById("vtiger_activity_id").value = "";
				$.get("update_activity.php", { activityid: activityid, subject: DispoChoice,campaignid:'edu'},
				   function(data){
						//alert("更新vtiger_activity成功!!!!!");
				   }
				);
			}
			if ( (DispoChoice == 'CALLBK') && (scheduled_callbacks > 0) ) {showDiv('CallBackSelectBox');}
			else
				{
				var xmlhttp=false;
				/*@cc_on @*/
				/*@if (@_jscript_version >= 5)
				// JScript gives us Conditional compilation, we can cope with old IE versions.
				// and security blocked creation of the objects.
				 try {
				  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				 } catch (e) {
				  try {
				   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				  } catch (E) {
				   xmlhttp = false;
				  }
				 }
				@end @*/
				if (!xmlhttp && typeof XMLHttpRequest!='undefined')
					{
					xmlhttp = new XMLHttpRequest();
					}
				if (xmlhttp) 
					{

						DSupdate_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&status_type="  + status_type + "&agent_dial_start_epoch=" + agent_dial_start_epoch + "&ACTION=updateDISPO&format=text&user=" + user + "&pass=" + pass + "&dispo_choice=" + DispoChoice + "&lead_id=" + document.vicidial_form.lead_id.value + "&campaign=" + campaign + "&auto_dial_level=" + auto_dial_level + "&agent_log_id=" + agent_log_id + "&CallBackDatETimE=" + CallBackDatETimE + "&list_id=" + document.vicidial_form.list_id.value + "&recipient=" + CallBackrecipient + "&use_internal_dnc=" + use_internal_dnc + "&use_campaign_dnc=" + use_campaign_dnc + "&MDnextCID=" + LasTCID + "&stage=" + group + "&vtiger_callback_id=" + vtiger_callback_id + "&phone_number=" + document.vicidial_form.phone_number.value + "&phone_code=" + document.vicidial_form.phone_code.value + "&dial_method" + dial_method + "&uniqueid=" + last_uniqueid + "&comments=" + CallBackCommenTs;			

					//alert(DSupdate_query);
					xmlhttp.open('POST', 'vdc_db_query.php');
					xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
					xmlhttp.send(DSupdate_query); 
					xmlhttp.onreadystatechange = function() 
						{ 
						//alert(DSupdate_query + "\n" +xmlhttp.responseText);

						if ( (xmlhttp.readyState == 4 && xmlhttp.status == 200) && (auto_dial_level < 1) )
							{
							var check_dispo = null;
							check_dispo = xmlhttp.responseText;
							var check_DS_array=check_dispo.split("\n");
						//	alert(xmlhttp.responseText + "\n|" + check_DS_array[1] + "\n|" + check_DS_array[2] + "|");
							if (check_DS_array[1] == 'Next agent_log_id:')
								{
								agent_log_id = check_DS_array[2];
								}
														xmlhttp = null;
						CollectGarbage();
							}
						}
					delete xmlhttp;
					}
				// CLEAR ALL FORM VARIABLES
				//Add by fnatic start @clear pausecode input@
				//document.getElementById("PauseCodeSelection").value='';
				//Add by fnatic end 
				document.vicidial_form.lead_id.value		='';
				document.vicidial_form.vendor_lead_code.value='';
				document.vicidial_form.list_id.value		='';
				document.vicidial_form.gmt_offset_now.value	='';
				document.vicidial_form.phone_code.value		='';
				if ( (disable_alter_custphone=='Y') || (disable_alter_custphone=='HIDE') )
					{
					var tmp_pn = document.getElementById("phone_numberDISP");
					tmp_pn.innerHTML			= ' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ';
					}
				document.vicidial_form.phone_number.value	= '';
				document.vicidial_form.title.value			='';
				document.vicidial_form.first_name.value		='';
				document.vicidial_form.middle_initial.value	='';
				document.vicidial_form.last_name.value		='';
				document.vicidial_form.address1.value		='';
				document.vicidial_form.address2.value		='';
				document.vicidial_form.address3.value		='';
				document.vicidial_form.city.value			='';
				document.vicidial_form.state.value			='';
				document.vicidial_form.province.value		='';
				document.vicidial_form.postal_code.value	='';
				document.vicidial_form.country_code.value	='';
				document.vicidial_form.gender.value			='';
				document.vicidial_form.date_of_birth.value	='';
				document.vicidial_form.alt_phone.value		='';
				document.vicidial_form.email.value			='';
				document.vicidial_form.security_phrase.value='';
				document.vicidial_form.comments.value		='';
				document.vicidial_form.called_count.value	='';
				VDCL_group_id = '';
				fronter = '';
				inOUT = 'OUT';
				vtiger_callback_id='0';
				recording_filename='';
				recording_id='';
				document.vicidial_form.uniqueid.value='';
				//Add by Fnatic start
                last_uniqueid='';
				//Add by Fnatic end
				MDuniqueid='';
				XDuniqueid='';
				tmp_vicidial_id='';
				EAphone_code='';
				EAphone_number='';
				EAalt_phone_notes='';
				EAalt_phone_active='';
				EAalt_phone_count='';
				XDnextCID='';
				XDcheck = '';
				MDnextCID='';
				XD_live_customer_call = 0;
				XD_live_call_secondS = 0;
				MD_channel_look=0;
				MD_ring_secondS=0;

				if (manual_dial_in_progress==1)
					{
					manual_dial_finished();
					}
				document.getElementById("GENDERhideFORieALT").innerHTML = '';
				document.getElementById("GENDERhideFORie").innerHTML = '<select style="display:none" size=1 name=gender_list class="cust_form" id=gender_list><option value="U">U - 尚未定义</option><option value="M">M - Male</option><option value="F">F - Female</option></select>';
				//bear hideDiv('DispoSelectBox');
				hideDiv('DispoButtonHideA');
				hideDiv('DispoButtonHideB');
				hideDiv('DispoButtonHideC');
				//bear document.getElementById("DispoSelectBox").style.top = 1;
				document.getElementById("DispoSelectMaxMin").innerHTML = "<a href=\"#\" onclick=\"DispoMinimize()\"> minimize </a>";
				document.getElementById("DispoSelectHAspan").innerHTML = "<a href=\"#\" onclick=\"DispoHanguPAgaiN()\">Hangup Again</a>";

				CBcommentsBoxhide();
				EAcommentsBoxhide();

				AgentDispoing = 0;	
				if (shift_logout_flag < 1)
					{
					if (wrapup_waiting == 0)
						{
						if (document.getElementById("DispoSelectStop").checked==true)
							{//如果选择暂停的复选框被勾选,则出现暂停面板,Fnatic
							if (auto_dial_level != '0')
								{
								AutoDialWaiting = 0;

								//Add by fnatic start
								//Cortorl_Pausecode_Insert_Db='Y';
								//PauseCodeSelect_submit(document.getElementById("PauseCodeSelection").value);
								//document.getElementById("PauseCodeSelection").value='';
								//Add by fnatic end

								AutoDial_ReSume_PauSe("VDADpause");
						//		document.getElementById("DiaLControl").innerHTML = DiaLControl_auto_HTML;
								}
							VICIDiaL_pause_calling = 1;
							if (dispo_check_all_pause != '1')
								{
								document.getElementById("DispoSelectStop").checked=false;
								}
							}
						else
							{
							if (auto_dial_level != '0')
								{
								AutoDialWaiting = 1;
								agent_log_id = AutoDial_ReSume_PauSe("VDADready","NEW_ID");
								//document.getElementById("DiaLControl").innerHTML = DiaLControl_auto_HTML_ready;
								}
							else
								{
								// trigger HotKeys manual dial automatically go to next lead
								if (manual_auto_hotkey == '1')
									{
									manual_auto_hotkey = 0;
									ManualDialNext('','','','','','0');
									}
								}
							}
						}
					}
				else
					{
					LogouT('SHIFT');
					}
				}
			}
		}
	function setDispoResultDispoSelection(obj){
		try{
			document.getElementById("DispoSelection").value = obj.value;
		}catch(err){
			alert(err);
		}
	}
	function DispoSelect_submit2()
		{
		if (VDCL_group_id.length > 1)
			{var group = VDCL_group_id;}
		else
			{var group = campaign;}
		leaving_threeway=0;
		blind_transfer=0;
		CheckDEADcallON=0;
		document.vicidial_form.callchannel.value = '';
		document.vicidial_form.callserverip.value = '';
		//Mod by fnatic document.vicidial_form.xferchannel.value = '';
		document.getElementById("xferchannel").value = '';
		//Mod by fnatic start
		if(Xfer_Dial_With_Customer_Display=='Y')
			{
		document.getElementById("DialWithCustomer").innerHTML ="<a href=\"#\" onclick=\"DialWithCustomerClick(1);return false;\"><IMG SRC=\"../agc/images/cn/vdc_XB_dialwithcustomer_cn.gif\" border=0 alt=\"不挂断拨号\" style=\"vertical-align:middle\"></a>";
			}
		document.getElementById("ParkCustomerDial").innerHTML ="<a href=\"#\" onclick=\"DialWithCustomerClick(0);return false;\"><IMG SRC=\"../agc/images/cn/vdc_XB_parkcustomerdial_cn.gif\" border=0 alt=\"保持客户拨号\" style=\"vertical-align:middle\"></a>";
		document.getElementById("HangupBothLines").innerHTML ="<IMG SRC=\"../agc/images/cn/vdc_XB_hangupbothlines_OFF_cn.gif\" border=0 alt=\"全部挂断\" style=\"vertical-align:middle\">";
        //电话小结后恢复挂断第三方转接线按狃为不可用,恢复转接面板还停留在话务员列表页
		//when project is ehsn image changed
        if(Fast_Hangup_Xferline_And_Grab_Custline=='N')
			{
		document.getElementById("HangupXferLine").innerHTML ="<IMG SRC=\"../agc/images/cn/vdc_XB_hangupxferline_OFF_cn.gif\" border=0 alt=\"挂断第三方转接线\" style=\"vertical-align:middle\">";
			}
		else
			{
		document.getElementById("HangupXferLine").innerHTML ="<IMG SRC=\"../agc/images/cn/vdc_XB_hangupxferline_OFF_cn_ehsn.gif\" border=0 alt=\"挂断第三方转接线\" style=\"vertical-align:middle\">";
			}
		AgentsXferSelect('0','AgentXferViewSelect');
		//Add by fnatic end
		
		var DispoChoice = document.getElementById("DispoSelection").value;
		var checkIfPauseForDial = false;
		if (DispoChoice.length < 1) {alert("请选择小结类别！");}
		else
			{
			document.getElementById("CusTInfOSpaN").innerHTML = "";
			document.getElementById("CusTInfOSpaN").style.background = panel_bgcolor;
			//更新联系历史记录(以下为vtiger_activity需要更新的字段)
			if(document.getElementById("vtiger_activity_id").value != ""){
				var activityid = document.getElementById("vtiger_activity_id").value;
				document.getElementById("vtiger_activity_id").value = "";
				$.get("update_activity.php", { activityid: activityid, subject: DispoChoice,campaignid:'edu'},
				   function(data){
						//alert("更新vtiger_activity成功!!!!!");
				   }
				);
			}
			if ( (DispoChoice == 'CALLBK') && (scheduled_callbacks > 0) )
			{
				//$('#DispoSelectBox').dialog('close');
				//调用回拔界面
				//showDiv('CallBackSelectBox');
				$('#CallBackSelectBox').dialog('open');
			}
			else
				{
				var xmlhttp=false;
				/*@cc_on @*/
				/*@if (@_jscript_version >= 5)
				// JScript gives us Conditional compilation, we can cope with old IE versions.
				// and security blocked creation of the objects.
				 try {
				  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				 } catch (e) {
				  try {
				   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				  } catch (E) {
				   xmlhttp = false;
				  }
				 }
				@end @*/
				if (!xmlhttp && typeof XMLHttpRequest!='undefined')
					{
					xmlhttp = new XMLHttpRequest();
					}
				if (xmlhttp) 
					{

						DSupdate_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&status_type=" + status_type + "&agent_dial_start_epoch=" + agent_dial_start_epoch + "&ACTION=updateDISPO&format=text&user=" + user + "&pass=" + pass + "&dispo_choice=" + DispoChoice + "&lead_id=" + document.vicidial_form.lead_id.value + "&campaign=" + campaign + "&auto_dial_level=" + auto_dial_level + "&agent_log_id=" + agent_log_id + "&CallBackDatETimE=" + CallBackDatETimE + "&list_id=" + document.vicidial_form.list_id.value + "&recipient=" + CallBackrecipient + "&use_internal_dnc=" + use_internal_dnc + "&use_campaign_dnc=" + use_campaign_dnc + "&MDnextCID=" + LasTCID + "&stage=" + group + "&vtiger_callback_id=" + vtiger_callback_id + "&phone_number=" + document.vicidial_form.phone_number.value + "&phone_code=" + document.vicidial_form.phone_code.value + "&dial_method" + dial_method + "&uniqueid=" + last_uniqueid + "&comments=" + CallBackCommenTs;
				//	alert(DSupdate_query);
					xmlhttp.open('POST', 'vdc_db_query.php');
					xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
					xmlhttp.send(DSupdate_query); 
					xmlhttp.onreadystatechange = function() 
						{ 
						//alert(DSupdate_query + "\n" +xmlhttp.responseText);

						if ( (xmlhttp.readyState == 4 && xmlhttp.status == 200) && (auto_dial_level < 1) )
							{
							var check_dispo = null;
							check_dispo = xmlhttp.responseText;
							var check_DS_array=check_dispo.split("\n");
						//	alert(xmlhttp.responseText + "\n|" + check_DS_array[1] + "\n|" + check_DS_array[2] + "|");
							if (check_DS_array[1] == 'Next agent_log_id:')
								{
								agent_log_id = check_DS_array[2];
								}
														xmlhttp = null;
						CollectGarbage();
							}
						}
					delete xmlhttp;
					}
				// CLEAR ALL FORM VARIABLES
				//Add by fnatic start @clear pausecode input@
				//document.getElementById("PauseCodeSelection").value='';
				//Add by fnatic end 
				document.vicidial_form.lead_id.value		='';
				document.vicidial_form.vendor_lead_code.value='';
				document.vicidial_form.list_id.value		='';
				document.vicidial_form.gmt_offset_now.value	='';
				document.vicidial_form.phone_code.value		='';
				if ( (disable_alter_custphone=='Y') || (disable_alter_custphone=='HIDE') )
					{
					var tmp_pn = document.getElementById("phone_numberDISP");
					tmp_pn.innerHTML			= ' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ';
					}
				document.vicidial_form.phone_number.value	= '';
				document.vicidial_form.title.value			='';
				document.vicidial_form.first_name.value		='';
				document.vicidial_form.middle_initial.value	='';
				document.vicidial_form.last_name.value		='';
				document.vicidial_form.address1.value		='';
				document.vicidial_form.address2.value		='';
				document.vicidial_form.address3.value		='';
				document.vicidial_form.city.value			='';
				document.vicidial_form.state.value			='';
				document.vicidial_form.province.value		='';
				document.vicidial_form.postal_code.value	='';
				document.vicidial_form.country_code.value	='';
				document.vicidial_form.gender.value			='';
				document.vicidial_form.date_of_birth.value	='';
				document.vicidial_form.alt_phone.value		='';
				document.vicidial_form.email.value			='';
				document.vicidial_form.security_phrase.value='';
				document.vicidial_form.comments.value		='';
				document.vicidial_form.called_count.value	='';
				VDCL_group_id = '';
				fronter = '';
				inOUT = 'OUT';
				vtiger_callback_id='0';
				recording_filename='';
				recording_id='';
				document.vicidial_form.uniqueid.value='';
				//Add by Fnatic start
                last_uniqueid='';
				//Add by Fnatic end
				MDuniqueid='';
				XDuniqueid='';
				tmp_vicidial_id='';
				EAphone_code='';
				EAphone_number='';
				EAalt_phone_notes='';
				EAalt_phone_active='';
				EAalt_phone_count='';
				XDnextCID='';
				XDcheck = '';
				MDnextCID='';
				XD_live_customer_call = 0;
				XD_live_call_secondS = 0;
				MD_channel_look=0;
				MD_ring_secondS=0;
				if (manual_dial_in_progress==1)
					{
					manual_dial_finished();
					}
				document.getElementById("GENDERhideFORieALT").innerHTML = '';
				document.getElementById("GENDERhideFORie").innerHTML = '<select style="display:none" size=1 name=gender_list class="cust_form" id=gender_list><option value="U">U - 尚未定义</option><option value="M">M - Male</option><option value="F">F - Female</option></select>';
				//bear hideDiv('DispoSelectBox');
				//关闭电话小结窗口
				$('#DispoSelectBox').dialog('close');
				DispoSelectBoxStatus = 0;
				auto_dispo_time_count = 0;
				hideDiv('DispoButtonHideA');
				hideDiv('DispoButtonHideB');
				hideDiv('DispoButtonHideC');
				//bear document.getElementById("DispoSelectBox").style.top = 1;
				//document.getElementById("DispoSelectMaxMin").innerHTML = "<a href=\"#\" onclick=\"DispoMinimize()\"> minimize </a>";
				//document.getElementById("DispoSelectHAspan").innerHTML = "<a href=\"#\" onclick=\"DispoHanguPAgaiN()\">Hangup Again</a>";
				
				CBcommentsBoxhide();
				EAcommentsBoxhide();
				AgentDispoing = 0;
				if (shift_logout_flag < 1)
					{
					if (wrapup_waiting == 0)
						{
						if (document.getElementById("DispoSelectStop").checked==true)
							{//如果选择暂停的复选框被勾选,则出现暂停面板,Fnatic
							checkIfPauseForDial = true;
							var obj = document.getElementsByName("PauseRadioSelect");
							for(var i = 0; i < obj.length; i++)
							{
								if(obj[i].checked){
									Original_Pause_Code = obj[i].value;
								}
							}
							
							AutoDialReSumeStatus = 0;
							if (auto_dial_level != '0')
								{
								AutoDialWaiting = 0;
								
								//Add by fnatic start
								//Cortorl_Pausecode_Insert_Db='Y';
								//PauseCodeSelect_submit(document.getElementById("PauseCodeSelection").value);
								//document.getElementById("PauseCodeSelection").value='';
								//Add by fnatic end
								
								AutoDial_ReSume_PauSe("VDADpause");
						//		document.getElementById("DiaLControl").innerHTML = DiaLControl_auto_HTML;
								}
							VICIDiaL_pause_calling = 1;
							if (dispo_check_all_pause != '1')
								{
								document.getElementById("DispoSelectStop").checked=false;
								}
							}
						else
							{
							if (auto_dial_level != '0')
								{
									if(AutoDialReSumeStatus == 1){
										//alert("暂停后恢复状态");
										AutoDialReSumeStatus = 0;
										AutoDial_ReSume_PauSe('VDADready');
										document.getElementById("status_code").innerHTML="可用";
										if(Pause_Code_Selected_Link_Display=='Y' && (agent_pause_codes_active=='FORCE' || agent_pause_codes_active=="Y")){
											document.getElementById("PauseCodeLinkSpan").style.display="none";
										}
									}else{
										
										if(AutoDialCheckStatus==4){
											AutoDial_PauSe_Default(Original_Pause_Code,'VDADpause');
											document.getElementById("status_code").innerHTML="暂停";
											if(Pause_Code_Selected_Link_Display=='Y' && (agent_pause_codes_active=='FORCE' || agent_pause_codes_active=="Y")){
												document.getElementById("PauseCodeLinkSpan").style.display="";
											}
										}else{
											AutoDialWaiting = 1;
											agent_log_id = AutoDial_ReSume_PauSe("VDADready","NEW_ID");
											document.getElementById("DiaLControl").innerHTML = DiaLControl_auto_HTML_ready + DiaLControl_manual_HTML;
											document.getElementById("status_code").innerHTML="可用";
											if(Pause_Code_Selected_Link_Display=='Y' && (agent_pause_codes_active=='FORCE' || agent_pause_codes_active=="Y")){
												document.getElementById("PauseCodeLinkSpan").style.display="none";
											}
										}
									}
								}
							else
								{
								// trigger HotKeys manual dial automatically go to next lead
								if (manual_auto_hotkey == '1')
									{
									manual_auto_hotkey = 0;
									ManualDialNext('','','','','','0');
									}
								}
							}
							//alert("bear暂停后恢复状态");
						}
					}
				else
					{
					LogouT('SHIFT');
					}
				}
			}
			document.getElementById("DispoSelection").value = "";
			if(Dial_Next_Display=='Y' && checkIfPauseForDial == false){
				if(document.getElementById("DispoDialNext").checked){
					ManualDialNext('','','','','','0');
				}
			}
		}

	// ################################################################################
	// Submit the 暂停 Code 
	function PauseCodeSelect_submit_by_radio(){
		var val = "";
		var objArr = document.getElementsByName("PauseCodeSelectRadio");
		for(var i=0;i<objArr.length;i++){
			if(objArr[i].checked){
				val = objArr[i].value;
			}
		}
		if(val == ""){
			alert("请选择暂停原因!");
		}else{
			try{
			Original_Pause_Code = val;
			Cortorl_Pausecode_Insert_Db = 'Y';
			PauseCodeSelect_submit(val);
			document.getElementById("PauseCodeSelection").value = '';
			}catch(err){
				alert(err);
			}
		}
	}
	function PauseCodeSelect_submit(newpausecode)
		{
      //Add by fnatic start
	  
	   if(Cortorl_Pausecode_Insert_Db=='N')
		{
		 document.getElementById("PauseCodeSelection").value=newpausecode;
		 if(agent_pause_codes_active=='FORCE' && Default_Pause_Code_Enable == 'Y')
			{
		      if(Undefined_Dialog_Status=='Y') //如果JqueryDialog层显示 则调用关闭方法
				{ 
			      $('#PauseCodeSelectBoxDIV').dialog('close');
				  Undefined_Dialog_Status = 'N';
				}
		    }
		  return false;
		}
		//Add by fnatic end

		document.getElementById("PauseCodeSelection").value=newpausecode;
		//hideDiv('PauseCodeSelectBox');
		ShoWGenDerPulldown();
		WaitingForNextStep=0;

		if(agent_available_reset == 'Y'){
			if(newpausecode == agent_available_reset_codde){
				agent_available_reset_count = 0;
				agent_available_reset_check = 1;
			}else{
				agent_available_reset_count = 0;
				agent_available_reset_check = 0;
			}
		}		
		
		if(agent_pause_codes_active=='FORCE' && Undefined_Dialog_Status=='Y')
			{
             $('#PauseCodeSelectBoxDIV').dialog('close');
			 Undefined_Dialog_Status = 'N';
		    }
		if(agent_pause_codes_active=='Y' && Undefined_Dialog_Status=='Y')
			{
             $('#PauseCodeSelectBoxDIV').dialog('close');
			 Undefined_Dialog_Status = 'N';
		    }

		var xmlhttp=false;
		/*@cc_on @*/
		/*@if (@_jscript_version >= 5)
		// JScript gives us Conditional compilation, we can cope with old IE versions.
		// and security blocked creation of the objects.
		 try {
		  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		 } catch (e) {
		  try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  } catch (E) {
		   xmlhttp = false;
		  }
		 }
		@end @*/
		if (!xmlhttp && typeof XMLHttpRequest!='undefined')
			{
			xmlhttp = new XMLHttpRequest();
			}
		if (xmlhttp) 
			{
			//alert(newpausecode);
			VMCpausecode_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass  + "&ACTION=PauseCodeSubmit&format=text&status=" + newpausecode + "&agent_log_id=" + agent_log_id + "&campaign=" + campaign + "&extension=" + extension + "&protocol=" + protocol + "&phone_ip=" + phone_ip + "&enable_sipsak_messages=" + enable_sipsak_messages + "&stage=" + pause_code_counter;
 
			//alert(VMCpausecode_query);
			pause_code_counter++;
			xmlhttp.open('POST', 'vdc_db_query.php'); 
			xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
			xmlhttp.send(VMCpausecode_query); 
			xmlhttp.onreadystatechange = function() 
				{ 
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
					{
					var check_pause_code = null;
					var check_pause_code = xmlhttp.responseText;
					//alert(check_pause_code);
					var check_PC_array=check_pause_code.split("\n");
					if (check_PC_array[1] == 'Next agent_log_id:')
						{
						//Add by fnatic start
						//if(agent_pause_codes_active=='FORCE' && Default_Pause_Code_Enable=="Y")
						if(agent_pause_codes_active=='FORCE' || agent_pause_codes_active=='Y')
							{
							document.getElementById("last_pause_code").innerHTML= check_PC_array[3];
							}					
						//Add by fnatic end
						agent_log_id = check_PC_array[2];
					    }
				//	alert(xmlhttp.responseText + "\n|" + check_PC_array[1] + "\n|" + check_PC_array[2] + "|" + agent_log_id + "|" + pause_code_counter);
										xmlhttp = null;
						CollectGarbage();
					}
				}
			delete xmlhttp;
			}
//		return agent_log_id;
		}

// ################################################################################
// Submit the 技能组代名 
	function GroupAliasSelect_submit(newgroupalias,newgroupcid,newusegroup)
		{
		hideDiv('GroupAliasSelectBox');
		ShoWGenDerPulldown();
		WaitingForNextStep=0;
		
		if (newusegroup > 0)
			{
			active_group_alias = newgroupalias;
			document.getElementById("ManuaLDiaLGrouPSelecteD").innerHTML = "<font size=2 face=\"Arial,Helvetica\">技能组代名: " + active_group_alias + "</font>";
			document.getElementById("XfeRDiaLGrouPSelecteD").innerHTML = "<font size=1 face=\"Arial,Helvetica\">技能组代名: " + active_group_alias + "</font>";
			}
		cid_choice = newgroupcid;
		}


// ################################################################################
// Populate the dtmf and xfer number for each preset link in xfer-conf frame
	function DtMf_PreSet_a()
		{
		document.vicidial_form.conf_dtmf.value = CalL_XC_a_Dtmf;
		//Mod by fnatic
		//document.vicidial_form.xfernumber.value = CalL_XC_a_NuMber;
		document.getElementById("xfernumber").value = CalL_XC_a_NuMber;
		}
	function DtMf_PreSet_b()
		{
		document.vicidial_form.conf_dtmf.value = CalL_XC_b_Dtmf;
		//Mod by fnatic
		//document.vicidial_form.xfernumber.value = CalL_XC_b_NuMber;
		document.getElementById("xfernumber").value = CalL_XC_b_NuMber;
		}
	function DtMf_PreSet_c()
		{//Mod by fnatic
		//document.vicidial_form.xfernumber.value = CalL_XC_c_NuMber;
		document.getElementById("xfernumber").value = CalL_XC_c_NuMber;

		}
	function DtMf_PreSet_d()
		{//Mod by fnatic
		//document.vicidial_form.xfernumber.value = CalL_XC_d_NuMber;
		document.getElementById("xfernumber").value = CalL_XC_d_NuMber;
		}
	function DtMf_PreSet_e()
		{//Mod by fnatic
		//document.vicidial_form.xfernumber.value = CalL_XC_e_NuMber;
        document.getElementById("xfernumber").value = CalL_XC_e_NuMber;
		}

	function DtMf_PreSet_a_DiaL()
		{
		document.vicidial_form.conf_dtmf.value = CalL_XC_a_Dtmf;
		//Mod by fnatic
		//document.vicidial_form.xfernumber.value = CalL_XC_a_NuMber;
		document.getElementById("xfernumber").value = CalL_XC_a_NuMber;
		basic_originate_call(CalL_XC_a_NuMber,'NO','YES',session_id,'YES','','1','0');
		}
	function DtMf_PreSet_b_DiaL()
		{
		document.vicidial_form.conf_dtmf.value = CalL_XC_b_Dtmf;
		//Mod by fnatic
		//document.vicidial_form.xfernumber.value = CalL_XC_b_NuMber;
		document.getElementById("xfernumber").value = CalL_XC_b_NuMber;
		basic_originate_call(CalL_XC_b_NuMber,'NO','YES',session_id,'YES','','1','0');
		}
	function DtMf_PreSet_c_DiaL()
		{//Mod by fnatic
		//document.vicidial_form.xfernumber.value = CalL_XC_c_NuMber;
		document.getElementById("xfernumber").value = CalL_XC_c_NuMber;
		basic_originate_call(CalL_XC_c_NuMber,'NO','YES',session_id,'YES','','1','0');
		}
	function DtMf_PreSet_d_DiaL()
		{//Mod by fnatic
		//document.vicidial_form.xfernumber.value = CalL_XC_d_NuMber;
		document.getElementById("xfernumber").value = CalL_XC_d_NuMber;
		basic_originate_call(CalL_XC_d_NuMber,'NO','YES',session_id,'YES','','1','0');
		}
	function DtMf_PreSet_e_DiaL()
		{//Mod by fnatic
		//document.vicidial_form.xfernumber.value = CalL_XC_e_NuMber;
		document.getElementById("xfernumber").value = CalL_XC_e_NuMber;
		basic_originate_call(CalL_XC_e_NuMber,'NO','YES',session_id,'YES','','1','0');
		}

// ################################################################################
// 展现 message that customer has hungup the call before agent has
	function CustomerChanneLGone()
		{
		//Mod by fnatic skip display CustomerGoneBox to CustomerGoneHangup();
		showDiv('CustomerGoneBox');
//		CustomerGoneHangup();
		//Mod by fnatic end
		document.vicidial_form.callchannel.value = '';
		document.vicidial_form.callserverip.value = '';
		document.getElementById("CustomerGoneChanneL").innerHTML = lastcustchannel;
		if( document.images ) { document.images['livecall'].src = image_livecall_OFF.src;}
		WaitingForNextStep=1;
		}
	function CustomerGoneOK()
		{
		hideDiv('CustomerGoneBox');
		WaitingForNextStep=0;
		custchannellive=0;
		}
	function CustomerGoneHangup()
		{
		hideDiv('CustomerGoneBox');
		WaitingForNextStep=0;
		custchannellive=0;
		//alert(1);
		dialedcall_send_hangup();
		}
// ################################################################################
// 展现 message that there are no voice channels in the VICIDIAL session
	function NoneInSession()
		{
		showDiv('NoneInSessionBox');
		document.getElementById("NoneInSessionID").innerHTML = session_id;
		WaitingForNextStep=1;
		}
	function NoneInSessionOK()
		{
		hideDiv('NoneInSessionBox');
		WaitingForNextStep=0;
		nochannelinsession=0;
		}
	function NoneInSessionCalL()
		{
		hideDiv('NoneInSessionBox');
		WaitingForNextStep=0;
		nochannelinsession=0;

		if ( (protocol == 'EXTERNAL') || (protocol == 'Local') )
			{
			var protodial = 'Local';
			var extendial = extension;
	//		var extendial = extension + "@" + ext_context;
			}
		else
			{
			var protodial = protocol;
			var extendial = extension;
			}
		var originatevalue = protodial + "/" + extendial;
		var queryCID = "ACagcW" + epoch_sec + user_abb;

		var xmlhttp=false;
		/*@cc_on @*/
		/*@if (@_jscript_version >= 5)
		// JScript gives us Conditional compilation, we can cope with old IE versions.
		// and security blocked creation of the objects.
		 try {
		  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		 } catch (e) {
		  try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  } catch (E) {
		   xmlhttp = false;
		  }
		 }
		@end @*/
		if (!xmlhttp && typeof XMLHttpRequest!='undefined')
			{
			xmlhttp = new XMLHttpRequest();
			}
		if (xmlhttp) 
			{ 
			VMCoriginate_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass  + "&ACTION=OriginateVDRelogin&format=text&channel=" + originatevalue + "&queryCID=" + queryCID + "&exten=" + session_id + "&ext_context=" + ext_context + "&ext_priority=1" + "&extension=" + extension + "&protocol=" + protocol + "&phone_ip=" + phone_ip + "&enable_sipsak_messages=" + enable_sipsak_messages + "&allow_sipsak_messages=" + allow_sipsak_messages + "&campaign=" + campaign + "&outbound_cid=" + campaign_cid;
			xmlhttp.open('POST', 'manager_send.php'); 
			xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
			xmlhttp.send(VMCoriginate_query); 
			xmlhttp.onreadystatechange = function() 
				{ 
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
					{
			//		alert(xmlhttp.responseText);
									xmlhttp = null;
						CollectGarbage();
					}
				}
			delete xmlhttp;
			}
		if (auto_dial_level > 0)
			{
			AutoDial_ReSume_PauSe("VDADpause");
			}
		}


// ################################################################################
// Generate the Closer In Group Chooser panel
	function CloserSelectContent_create()
		{
		HidEGenDerPulldown();
		if ( (VU_agent_choose_ingroups == '1') && (manager_ingroups_set < 1) )
			{
			var live_CSC_HTML = "<table cellpadding=5 cellspacing=5 width=500><tr><td><B>未选择技能组</B></td><td><B>已选技能组</B></td></tr><tr><td bgcolor=\"#99FF99\" height=300 width=240 valign=top><font class=\"log_text\"><span id=CloserSelectAdd> &nbsp; <a href=\"#\" onclick=\"CloserSelect_change('---DD-ALL-----','ADD');return false;\"><B>--- 全部选择 ---</B><BR>";
			var loop_ct = 0;
			while (loop_ct < INgroupCOUNT)
				{
				live_CSC_HTML = live_CSC_HTML + "<a href=\"#\" onclick=\"CloserSelect_change('" + VARingroups[loop_ct] + "','ADD');return false;\">" + VARingroups[loop_ct] + "<BR>";
				loop_ct++;
				}
			live_CSC_HTML = live_CSC_HTML + "</span></font></td><td bgcolor=\"#99FF99\" height=300 width=240 valign=top><font class=\"log_text\"><span id=CloserSelectDelete></span></font></td></tr></table>";

			document.vicidial_form.CloserSelectList.value = '';
			document.getElementById("CloserSelectContent").innerHTML = live_CSC_HTML;
			}
		else
			{
		//	alert(VU_agent_choose_ingroups);
			VU_agent_choose_ingroups_DV = "MGRLOCK";
			var live_CSC_HTML = "经理已经为你设定了技能组<BR>";
			document.vicidial_form.CloserSelectList.value = '';
			document.getElementById("CloserSelectContent").innerHTML = live_CSC_HTML;
			//yanson@20100926
			if(Skip_Choose_Ingroup_Enable == 'Y'){
				CloserSelect_submit();
			}
			}
		}

// ################################################################################
// Move a Closer In Group record to the selected column or reverse
	function CloserSelect_change(taskCSgrp,taskCSchange)
		{
		var CloserSelectListValue = document.vicidial_form.CloserSelectList.value;
		var CSCchange = 0;
		var regCS = new RegExp(" " + taskCSgrp + " ","ig");
		var regCSall = new RegExp("-ALL-----","ig");
		var regCSallADD = new RegExp("---DD-ALL-----","ig");
		var regCSallDELETE = new RegExp("-----DELETE-ALL-----","ig");
		if ( (CloserSelectListValue.match(regCS)) && (CloserSelectListValue.length > 3) )
			{
			if (taskCSchange == 'DELETE') {CSCchange = 1;}
			}
		else
			{
			if (taskCSchange == 'ADD') {CSCchange = 1;}
			}
		if (taskCSgrp.match(regCSall))
			{CSCchange = 1;}

	//	alert(taskCSgrp+"|"+taskCSchange+"|"+CloserSelectListValue.length+"|"+CSCchange+"|"+CSCcolumn+"|"+INgroupCOUNT)

		if (CSCchange==1) 
			{
			var loop_ct = 0;
			var CSCcolumn = '';
			var live_CSC_HTML_ADD = '';
			var live_CSC_HTML_DELETE = '';
			var live_CSC_LIST_value = " ";
			while (loop_ct < INgroupCOUNT)
				{
				var regCSL = new RegExp(" " + VARingroups[loop_ct] + " ","ig");
				if (CloserSelectListValue.match(regCSL)) {CSCcolumn = 'DELETE';}
				else {CSCcolumn = 'ADD';}
				if ( ( (VARingroups[loop_ct] == taskCSgrp) && (taskCSchange == 'DELETE') ) || (taskCSgrp.match(regCSallDELETE)) ) {CSCcolumn = 'ADD';}
				if ( ( (VARingroups[loop_ct] == taskCSgrp) && (taskCSchange == 'ADD') ) || (taskCSgrp.match(regCSallADD)) ) {CSCcolumn = 'DELETE';}
					

				if (CSCcolumn == 'DELETE')
					{
					live_CSC_HTML_DELETE = live_CSC_HTML_DELETE + "<a href=\"#\" onclick=\"CloserSelect_change('" + VARingroups[loop_ct] + "','DELETE');return false;\">" + VARingroups[loop_ct] + "<BR>";
					live_CSC_LIST_value = live_CSC_LIST_value + VARingroups[loop_ct] + " ";
					}
				else
					{
					live_CSC_HTML_ADD = live_CSC_HTML_ADD + "<a href=\"#\" onclick=\"CloserSelect_change('" + VARingroups[loop_ct] + "','ADD');return false;\">" + VARingroups[loop_ct] + "<BR>";
					}
				loop_ct++;
				}

			document.vicidial_form.CloserSelectList.value = live_CSC_LIST_value;
			document.getElementById("CloserSelectAdd").innerHTML = " &nbsp; <a href=\"#\" onclick=\"CloserSelect_change('---DD-ALL-----','ADD');return false;\"><B>--- 全部选择 ---</B><BR>" + live_CSC_HTML_ADD;
			document.getElementById("CloserSelectDelete").innerHTML = " &nbsp; <a href=\"#\" onclick=\"CloserSelect_change('-----DELETE-ALL-----','DELETE');return false;\"><B>--- 全部取消 ---</B><BR>" + live_CSC_HTML_DELETE;
			}
		}

// ################################################################################
// Update vicidial_live_agents record with closer in group choices
	function CloserSelect_submit()
		{
		if (dial_method == "INBOUND_MAN")
			{document.vicidial_form.CloserSelectBlended.checked=false;}
		if (document.vicidial_form.CloserSelectBlended.checked==true)
			{VICIDiaL_closer_blended = 1;}
		else
			{VICIDiaL_closer_blended = 0;}

		var CloserSelectChoices = document.vicidial_form.CloserSelectList.value;

		if (call_requeue_button > 0)
			{
			document.getElementById("ReQueueCall").innerHTML =  "<IMG SRC=\"../agc/images/vdc_LB_requeue_call_OFF.gif\" border=0 alt=\"Re-Queue Call\">";
			}
		else
			{
			document.getElementById("ReQueueCall").innerHTML =  "";
			}

		if (VU_agent_choose_ingroups_DV == "MGRLOCK")
			{CloserSelectChoices = "MGRLOCK";}

		var xmlhttp=false;
		/*@cc_on @*/
		/*@if (@_jscript_version >= 5)
		// JScript gives us Conditional compilation, we can cope with old IE versions.
		// and security blocked creation of the objects.
		 try {
		  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		 } catch (e) {
		  try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  } catch (E) {
		   xmlhttp = false;
		  }
		 }
		@end @*/
		if (!xmlhttp && typeof XMLHttpRequest!='undefined')
			{
			xmlhttp = new XMLHttpRequest();
			}
		if (xmlhttp) 
			{ 
			CSCupdate_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=regCLOSER&format=text&user=" + user + "&pass=" + pass + "&comments=" + VU_agent_choose_ingroups_DV + "&closer_blended=" + VICIDiaL_closer_blended + "&campaign=" + campaign + "&dial_method" + dial_method + "&closer_choice=" + CloserSelectChoices + "-";
			xmlhttp.open('POST', 'vdc_db_query.php'); 
			xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
			xmlhttp.send(CSCupdate_query); 
			xmlhttp.onreadystatechange = function() 
				{ 
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
					{
		//			alert(xmlhttp.responseText);
								xmlhttp = null;
						CollectGarbage();
					}
				}
			delete xmlhttp;
			}

		hideDiv('CloserSelectBox');
		MainPanelToFront();
		//alert(5);
		ScriptPanelToFront();
		CloserSelecting = 0;
		}


// ################################################################################
// Generate the Territory Chooser panel
	function TerritorySelectContent_create()
		{
		if (agent_select_territories == '1')
			{
			HidEGenDerPulldown();
			if (agent_choose_territories > 0)
				{
				var live_TERR_HTML = "<table cellpadding=5 cellspacing=5 width=500><tr><td><B>TERRITORIES NOT SELECTED</B></td><td><B>SELECTED TERRITORIES</B></td></tr><tr><td bgcolor=\"#99FF99\" height=300 width=240 valign=top><font class=\"log_text\"><span id=TerritorySelectAdd> &nbsp; <a href=\"#\" onclick=\"TerritorySelect_change('---DD-ALL-----','ADD');return false;\"><B>--- 全部选择 ---</B><BR>";
				var loop_ct = 0;
				while (loop_ct < territoryCOUNT)
					{
					live_TERR_HTML = live_TERR_HTML + "<a href=\"#\" onclick=\"TerritorySelect_change('" + VARterritories[loop_ct] + "','ADD');return false;\">" + VARterritories[loop_ct] + "<BR>";
					loop_ct++;
					}
				live_TERR_HTML = live_TERR_HTML + "</span></font></td><td bgcolor=\"#99FF99\" height=300 width=240 valign=top><font class=\"log_text\"><span id=TerritorySelectDelete></span></font></td></tr></table>";

				document.vicidial_form.TerritorySelectList.value = '';
				document.getElementById("TerritorySelectContent").innerHTML = live_TERR_HTML;
				}
			else
				{
				agent_select_territories = "MGRLOCK";
				var live_TERR_HTML = "经理已经为你设定了地域<BR>";
				document.vicidial_form.TerritorySelectList.value = '';
				document.getElementById("TerritorySelectContent").innerHTML = live_TERR_HTML;
				}
			}
		}

// ################################################################################
// Move a Territory record to the selected column or reverse
	function TerritorySelect_change(taskTERRgrp,taskTERRchange)
		{
		var TerritorySelectListValue = document.vicidial_form.TerritorySelectList.value;
		var TERRchange = 0;
		var regTERR = new RegExp(" " + taskTERRgrp + " ","ig");
		var regTERRall = new RegExp("-ALL-----","ig");
		var regTERRallADD = new RegExp("---DD-ALL-----","ig");
		var regTERRallDELETE = new RegExp("-----DELETE-ALL-----","ig");
		if ( (TerritorySelectListValue.match(regTERR)) && (TerritorySelectListValue.length > 3) )
			{
			if (taskTERRchange == 'DELETE') {TERRchange = 1;}
			}
		else
			{
			if (taskTERRchange == 'ADD') {TERRchange = 1;}
			}
		if (taskTERRgrp.match(regTERRall))
			{TERRchange = 1;}
//	alert("TERR: " + TerritorySelectListValue + "\nCHANGE: " + TERRchange + "\nACTION: " + taskTERRchange + "\nSELECTED: " + taskTERRgrp + "\nTOTAL: " + territoryCOUNT);
		if (TERRchange==1) 
			{
			var loop_ct = 0;
			var TERRcolumn = '';
			var live_TERR_HTML_ADD = '';
			var live_TERR_HTML_DELETE = '';
			var live_TERR_LIST_value = " ";
			while (loop_ct < territoryCOUNT)
				{
				var regTERRL = new RegExp(" " + VARterritories[loop_ct] + " ","ig");
				if (TerritorySelectListValue.match(regTERRL)) {TERRcolumn = 'DELETE';}
				else {TERRcolumn = 'ADD';}
				if ( ( (VARterritories[loop_ct] == taskTERRgrp) && (taskTERRchange == 'DELETE') ) || (taskTERRgrp.match(regTERRallDELETE)) ) 
					{TERRcolumn = 'ADD';}
				if ( ( (VARterritories[loop_ct] == taskTERRgrp) && (taskTERRchange == 'ADD') ) || (taskTERRgrp.match(regTERRallADD)) ) 
					{TERRcolumn = 'DELETE';}

				if (TERRcolumn == 'DELETE')
					{
					live_TERR_HTML_DELETE = live_TERR_HTML_DELETE + "<a href=\"#\" onclick=\"TerritorySelect_change('" + VARterritories[loop_ct] + "','DELETE');return false;\">" + VARterritories[loop_ct] + "<BR>";
					live_TERR_LIST_value = live_TERR_LIST_value + VARterritories[loop_ct] + " ";
					}
				else
					{
					live_TERR_HTML_ADD = live_TERR_HTML_ADD + "<a href=\"#\" onclick=\"TerritorySelect_change('" + VARterritories[loop_ct] + "','ADD');return false;\">" + VARterritories[loop_ct] + "<BR>";
					}
				loop_ct++;
				}

			document.vicidial_form.TerritorySelectList.value = live_TERR_LIST_value;
			document.getElementById("TerritorySelectAdd").innerHTML = " &nbsp; <a href=\"#\" onclick=\"TerritorySelect_change('---DD-ALL-----','ADD');return false;\"><B>--- 全部选择 ---</B><BR>" + live_TERR_HTML_ADD;
			document.getElementById("TerritorySelectDelete").innerHTML = " &nbsp; <a href=\"#\" onclick=\"TerritorySelect_change('-----DELETE-ALL-----','DELETE');return false;\"><B>--- 全部取消 ---</B><BR>" + live_TERR_HTML_DELETE;
			}
		}

// ################################################################################
// Update vicidial_live_agents record with territory choices
	function TerritorySelect_submit()
		{
		var TerritorySelectChoices = document.vicidial_form.TerritorySelectList.value;

		if (agent_select_territories == "MGRLOCK")
			{TerritorySelectChoices = "MGRLOCK";}

		var xmlhttp=false;
		/*@cc_on @*/
		/*@if (@_jscript_version >= 5)
		// JScript gives us Conditional compilation, we can cope with old IE versions.
		// and security blocked creation of the objects.
		 try {
		  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		 } catch (e) {
		  try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  } catch (E) {
		   xmlhttp = false;
		  }
		 }
		@end @*/
		if (!xmlhttp && typeof XMLHttpRequest!='undefined')
			{
			xmlhttp = new XMLHttpRequest();
			}
		if (xmlhttp) 
			{ 
			TERRupdate_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=regTERRITORY&format=text&user=" + user + "&pass=" + pass + "&comments=" + agent_select_territories + "&campaign=" + campaign + "&agent_territories=" + TerritorySelectChoices + "-";
			xmlhttp.open('POST', 'vdc_db_query.php'); 
			xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
			xmlhttp.send(TERRupdate_query); 
			xmlhttp.onreadystatechange = function() 
				{ 
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
					{
		//			alert(xmlhttp.responseText);
								xmlhttp = null;
						CollectGarbage();
					}
				}
			delete xmlhttp;
			}

		hideDiv('TerritorySelectBox');
		MainPanelToFront();
		TerritorySelecting = 0;
		}


// ################################################################################
// Log the user out of the system when they close their browser while logged in
	function BrowserCloseLogout()
		{
		/*
		if ( (VtigeRLogiNScripT == 'Y') && (VtigeREnableD > 0) )
		{
		document.getElementById("ScriptContents").innerHTML = "<iframe onload=\"SetCwinHeight(this)\"  src=\"" + VtigeRurl + "/index.php?module=Users&action=Logout\" frameborder=\"0\" id=\"popupFrame\"></iframe>";
		}
		*/
		if (logout_stop_timeouts < 1)
			{
			if (VDRP_stage != 'PAUSED')
				{
				AutoDial_ReSume_PauSe("VDADpause",'','','',"LOGOUT");
				}
			LogouT('CLOSE');
			alert("下次注销时请点击注销退出的链接.\n");
			try{
				imOpener.focus();
				imOpener.close();
			}catch(err){
			
			}
			}
		}


// ################################################################################
// Normal logout with check for pause stage first
	function NormalLogout()
		{
		/*
		if ( (VtigeRLogiNScripT == 'Y') && (VtigeREnableD > 0) )
		{
		document.getElementById("ScriptContents").innerHTML = "<iframe onload=\"SetCwinHeight(this)\"  src=\"" + VtigeRurl + "/index.php?module=Users&action=Logout\" frameborder=\"0\" id=\"popupFrame\"></iframe>";
		}
		*/
		
		if (logout_stop_timeouts < 1)
			{
			if (VDRP_stage != 'PAUSED' && MD_channel_look !=1 && VD_live_customer_call !=1)
				{
				AutoDial_ReSume_PauSe("VDADpause",'','','',"LOGOUT");
				}
			LogouT('NORMAL');
			try{
				imOpener.focus();
				imOpener.close();
			}catch(err){
			
			}
			}
		}


// ################################################################################
// Log the user out of the system, if active call or active dial is occuring, don't let them.
	function LogouT(tempreason)
		{
		if (MD_channel_look==1)
			{alert("拨号过程中无法注销退出系统！");}
		else
			{
			if (VD_live_customer_call==1)
				{
				alert("电话仍在通话中,请先挂断再注销退出系统！");
				}
			else
				{
				if (alt_dial_status_display==1)
					{
					alert("You are in ALT dial mode, you must finish the lead before logging out.\n" + reselect_alt_dial);
					}
				else
					{
					var xmlhttp=false;
					/*@cc_on @*/
					/*@if (@_jscript_version >= 5)
					// JScript gives us Conditional compilation, we can cope with old IE versions.
					// and security blocked creation of the objects.
					 try {
					  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
					 } catch (e) {
					  try {
					   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
					  } catch (E) {
					   xmlhttp = false;
					  }
					 }
					@end @*/
					if (!xmlhttp && typeof XMLHttpRequest!='undefined')
						{
						xmlhttp = new XMLHttpRequest();
						}
					if (xmlhttp) 
						{ 
						VDlogout_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=userLOGout&format=text&user=" + user + "&pass=" + pass + "&campaign=" + campaign + "&conf_exten=" + session_id + "&extension=" + extension + "&protocol=" + protocol + "&agent_log_id=" + agent_log_id + "&no_delete_sessions=" + no_delete_sessions + "&phone_ip=" + phone_ip + "&enable_sipsak_messages=" + enable_sipsak_messages + "&LogouTKicKAlL=" + LogouTKicKAlL + "&ext_context=" + ext_context +"&session_RemotePhone=" + session_RemotePhone;
						xmlhttp.open('POST', 'vdc_db_query.php'); 
						xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
						xmlhttp.send(VDlogout_query); 
						xmlhttp.onreadystatechange = function() 	
							{ 
							if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
								{
				//				alert(xmlhttp.responseText);
											xmlhttp = null;
						CollectGarbage();
								}
							}
						delete xmlhttp;
						}
					hideDiv('MainPanel');
					showDiv('LogouTBox');
					var logout_content='';
					if (tempreason=='SHIFT')
						{logout_content='Your Shift is over or has changed, you have been logged out of your session<BR><BR>';}
					document.getElementById("LogouTBoxLink").innerHTML = logout_content + "<a href=\"" + agcPAGE + "?relogin=YES&session_epoch=" + epoch_sec + "&session_id=" + session_id + "&session_name=" + session_name + "&VD_login=" + user + "&VD_campaign=" + campaign + "&phone_login=" + original_phone_login + "&phone_pass=" + phone_pass + "&VD_pass=" + pass + "\">按此重新登入</a>\n";
					logout_stop_timeouts = 1;
						
					//	window.location= agcPAGE + "?relogin=YES&session_epoch=" + epoch_sec + "&session_id=" + session_id + "&session_name=" + session_name + "&VD_login=" + user + "&VD_campaign=" + campaign + "&phone_login=" + phone_login + "&phone_pass=" + phone_pass + "&VD_pass=" + pass;
					}
				}
			}
		}
// ################################################################################
// W3C-compliant hotkeypress function to bind hotkeys defined in the campaign to dispositions
	function hotkeypress(evt)
		{
		enter_disable();
		if ( (hot_keys_active==1) && ( (VD_live_customer_call==1) || (MD_ring_secondS > 4) ) )
			{
			var e = evt? evt : window.event;
			if(!e) return;
			var key = 0;
			if (e.keyCode) { key = e.keyCode; } // for moz/fb, if keyCode==0 use 'which'
			else if (typeof(e.which)!= 'undefined') { key = e.which; }
			//
			var HKdispo = hotkeys[String.fromCharCode(key)];
			if (HKdispo) 
				{
				document.vicidial_form.inert_button.focus();
				document.vicidial_form.inert_button.blur();
				CustomerData_update();
				var HKdispo_ary = HKdispo.split(" ----- ");
				if ( (HKdispo_ary[0] == 'ALTPH2') || (HKdispo_ary[0] == 'ADDR3') )
					{
					if (document.vicidial_form.DiaLAltPhonE.checked==true)
						{
						dialedcall_send_hangup('NO', 'YES', HKdispo_ary[0]);
						}
					}
				else
					{
					HKdispo_display = 4;
					HKfinish=1;
					document.getElementById("HotKeyDispo").innerHTML = HKdispo_ary[0] + " - " + HKdispo_ary[1];
					showDiv('HotKeyActionBox');
					hideDiv('HotKeyEntriesBox');
					document.getElementById("DispoSelection").value = HKdispo_ary[0];
					dialedcall_send_hangup('NO', 'YES', HKdispo_ary[0]);
					}
			//	DispoSelect_submit();
			//	AutoDialWaiting = 1;
			//	AutoDial_ReSume_PauSe("VDADready");
			//	alert(HKdispo + " - " + HKdispo_ary[0] + " - " + HKdispo_ary[1]);
				}
			}
		}

// ################################################################################
// disable enter/return keys to not clear out vars on customer info
	function enter_disable(evt)
		{
		var e = evt? evt : window.event;
		if(!e) return;
		var key = 0;
		if (e.keyCode) { key = e.keyCode; } // for moz/fb, if keyCode==0 use 'which'
		else if (typeof(e.which)!= 'undefined') { key = e.which; }
		return key != 13;
		}


// ################################################################################
// decode the scripttext and scriptname so that it can be displayed
	function URLDecode(encodedvar,scriptformat)
	{
   // Replace %ZZ with equivalent character
   // Put [ERR] in output if %ZZ is invalid.
	var HEXCHAR = "0123456789ABCDEFabcdef"; 
	var encoded = encodedvar;
	decoded = '';
	var i = 0;
	var RGnl = new RegExp("[\r]\n","g");
	var RGplus = new RegExp(" ","g");
	var RGiframe = new RegExp("iframe","gi");

	var xtest;
	xtest=unescape(encoded);
	encoded=utf8_decode(xtest);

	if (scriptformat == 'YES')
		{
		var SCvendor_lead_code = document.vicidial_form.vendor_lead_code.value;
		var SCsource_id = source_id;
		var SClist_id = document.vicidial_form.list_id.value;
		var SCgmt_offset_now = document.vicidial_form.gmt_offset_now.value;
		var SCcalled_since_last_reset = "";
		var SCphone_code = document.vicidial_form.phone_code.value;
		var SCphone_number = document.vicidial_form.phone_number.value;
		var SCtitle = document.vicidial_form.title.value;
		var SCfirst_name = document.vicidial_form.first_name.value;
		var SCmiddle_initial = document.vicidial_form.middle_initial.value;
		var SClast_name = document.vicidial_form.last_name.value;
		var SCaddress1 = document.vicidial_form.address1.value;
		var SCaddress2 = document.vicidial_form.address2.value;
		var SCaddress3 = document.vicidial_form.address3.value;
		var SCcity = document.vicidial_form.city.value;
		var SCstate = document.vicidial_form.state.value;
		var SCprovince = document.vicidial_form.province.value;
		var SCpostal_code = document.vicidial_form.postal_code.value;
		var SCcountry_code = document.vicidial_form.country_code.value;
		var SCgender = document.vicidial_form.gender.value;
		var SCdate_of_birth = document.vicidial_form.date_of_birth.value;
		var SCalt_phone = document.vicidial_form.alt_phone.value;
		var SCemail = document.vicidial_form.email.value;
		var SCsecurity_phrase = document.vicidial_form.security_phrase.value;
		var SCcomments = document.vicidial_form.comments.value;
		var SCfullname = LOGfullname;
		var SCfronter = fronter;
		var SCuser = user;
		var SCpass = pass;
		var SClead_id = document.vicidial_form.lead_id.value;
		var SCcampaign = campaign;
		var SCphone_login = phone_login;
		var SCoriginal_phone_login = original_phone_login;
		var SCgroup = group;
		var SCchannel_group = group;
		var SCSQLdate = SQLdate;
		var SCepoch = UnixTime;
		var SCuniqueid = document.vicidial_form.uniqueid.value;
		var SCcustomer_zap_channel = lastcustchannel;
		var SCserver_ip = server_ip;
		var SCSIPexten = extension;
		var SCsession_id = session_id;
		var SCdispo = LeaDDispO;
		var SCdialed_number = dialed_number;
		var SCdialed_label = dialed_label;
		var SCrank = document.vicidial_form.rank.value;
		var SCowner = document.vicidial_form.owner.value;
		var SCcamp_script = campaign_script;
		var SCin_script = CalL_ScripT_id;
		var SCscript_width = script_width;
		var SCscript_height = script_height;
		var SCrecording_filename = recording_filename;
		var SCrecording_id = recording_id;
		var SCuser_custom_one = VU_custom_one;
		var SCuser_custom_two = VU_custom_two;
		var SCuser_custom_three = VU_custom_three;
		var SCuser_custom_four = VU_custom_four;
		var SCuser_custom_five = VU_custom_five;
		var SCpreset_number_a = CalL_XC_a_NuMber;
		var SCpreset_number_b = CalL_XC_b_NuMber;
		var SCpreset_number_c = CalL_XC_c_NuMber;
		var SCpreset_number_d = CalL_XC_d_NuMber;
		var SCpreset_number_e = CalL_XC_e_NuMber;
		var SCpreset_dtmf_a = CalL_XC_a_Dtmf;
		var SCpreset_dtmf_b = CalL_XC_b_Dtmf;
		var SCweb_vars = LIVE_web_vars;

		if (encoded.match(RGiframe))
			{
			SCvendor_lead_code = SCvendor_lead_code.replace(RGplus,'+');
			SCsource_id = SCsource_id.replace(RGplus,'+');
			SClist_id = SClist_id.replace(RGplus,'+');
			SCgmt_offset_now = SCgmt_offset_now.replace(RGplus,'+');
			SCcalled_since_last_reset = SCcalled_since_last_reset.replace(RGplus,'+');
			SCphone_code = SCphone_code.replace(RGplus,'+');
			SCphone_number = SCphone_number.replace(RGplus,'+');
			SCtitle = SCtitle.replace(RGplus,'+');
			SCfirst_name = SCfirst_name.replace(RGplus,'+');
			SCmiddle_initial = SCmiddle_initial.replace(RGplus,'+');
			SClast_name = SClast_name.replace(RGplus,'+');
			SCaddress1 = SCaddress1.replace(RGplus,'+');
			SCaddress2 = SCaddress2.replace(RGplus,'+');
			SCaddress3 = SCaddress3.replace(RGplus,'+');
			SCcity = SCcity.replace(RGplus,'+');
			SCstate = SCstate.replace(RGplus,'+');
			SCprovince = SCprovince.replace(RGplus,'+');
			SCpostal_code = SCpostal_code.replace(RGplus,'+');
			SCcountry_code = SCcountry_code.replace(RGplus,'+');
			SCgender = SCgender.replace(RGplus,'+');
			SCdate_of_birth = SCdate_of_birth.replace(RGplus,'+');
			SCalt_phone = SCalt_phone.replace(RGplus,'+');
			SCemail = SCemail.replace(RGplus,'+');
			SCsecurity_phrase = SCsecurity_phrase.replace(RGplus,'+');
			SCcomments = SCcomments.replace(RGplus,'+');
			SCfullname = SCfullname.replace(RGplus,'+');
			SCfronter = SCfronter.replace(RGplus,'+');
			SCuser = SCuser.replace(RGplus,'+');
			SCpass = SCpass.replace(RGplus,'+');
			SClead_id = SClead_id.replace(RGplus,'+');
			SCcampaign = SCcampaign.replace(RGplus,'+');
			SCphone_login = SCphone_login.replace(RGplus,'+');
			SCoriginal_phone_login = SCoriginal_phone_login.replace(RGplus,'+');
			SCgroup = SCgroup.replace(RGplus,'+');
			SCchannel_group = SCchannel_group.replace(RGplus,'+');
			SCSQLdate = SCSQLdate.replace(RGplus,'+');
			SCuniqueid = SCuniqueid.replace(RGplus,'+');
			SCcustomer_zap_channel = SCcustomer_zap_channel.replace(RGplus,'+');
			SCserver_ip = SCserver_ip.replace(RGplus,'+');
			SCSIPexten = SCSIPexten.replace(RGplus,'+');
			SCdispo = SCdispo.replace(RGplus,'+');
			SCdialed_number = SCdialed_number.replace(RGplus,'+');
			SCdialed_label = SCdialed_label.replace(RGplus,'+');
			SCrank = SCrank.replace(RGplus,'+');
			SCowner = SCowner.replace(RGplus,'+');
			SCcamp_script = SCcamp_script.replace(RGplus,'+');
			SCin_script = SCin_script.replace(RGplus,'+');
			SCscript_width = SCscript_width.replace(RGplus,'+');
			SCscript_height = SCscript_height.replace(RGplus,'+');
			SCrecording_filename = SCrecording_filename.replace(RGplus,'+');
			SCrecording_id = SCrecording_id.replace(RGplus,'+');
			SCuser_custom_one = SCuser_custom_one.replace(RGplus,'+');
			SCuser_custom_two = SCuser_custom_two.replace(RGplus,'+');
			SCuser_custom_three = SCuser_custom_three.replace(RGplus,'+');
			SCuser_custom_four = SCuser_custom_four.replace(RGplus,'+');
			SCuser_custom_five = SCuser_custom_five.replace(RGplus,'+');
			SCpreset_number_a = SCpreset_number_a.replace(RGplus,'+');
			SCpreset_number_b = SCpreset_number_b.replace(RGplus,'+');
			SCpreset_number_c = SCpreset_number_c.replace(RGplus,'+');
			SCpreset_number_d = SCpreset_number_d.replace(RGplus,'+');
			SCpreset_number_e = SCpreset_number_e.replace(RGplus,'+');
			SCpreset_dtmf_a = SCpreset_dtmf_a.replace(RGplus,'+');
			SCpreset_dtmf_b = SCpreset_dtmf_b.replace(RGplus,'+');
			SCweb_vars = SCweb_vars.replace(RGplus,'+');
			}

		var RGvendor_lead_code = new RegExp("--A--vendor_lead_code--B--","g");
		var RGsource_id = new RegExp("--A--source_id--B--","g");
		var RGlist_id = new RegExp("--A--list_id--B--","g");
		var RGgmt_offset_now = new RegExp("--A--gmt_offset_now--B--","g");
		var RGcalled_since_last_reset = new RegExp("--A--called_since_last_reset--B--","g");
		var RGphone_code = new RegExp("--A--phone_code--B--","g");
		var RGphone_number = new RegExp("--A--phone_number--B--","g");
		var RGtitle = new RegExp("--A--title--B--","g");
		var RGfirst_name = new RegExp("--A--first_name--B--","g");
		var RGmiddle_initial = new RegExp("--A--middle_initial--B--","g");
		var RGlast_name = new RegExp("--A--last_name--B--","g");
		var RGaddress1 = new RegExp("--A--address1--B--","g");
		var RGaddress2 = new RegExp("--A--address2--B--","g");
		var RGaddress3 = new RegExp("--A--address3--B--","g");
		var RGcity = new RegExp("--A--city--B--","g");
		var RGstate = new RegExp("--A--state--B--","g");
		var RGprovince = new RegExp("--A--province--B--","g");
		var RGpostal_code = new RegExp("--A--postal_code--B--","g");
		var RGcountry_code = new RegExp("--A--country_code--B--","g");
		var RGgender = new RegExp("--A--gender--B--","g");
		var RGdate_of_birth = new RegExp("--A--date_of_birth--B--","g");
		var RGalt_phone = new RegExp("--A--alt_phone--B--","g");
		var RGemail = new RegExp("--A--email--B--","g");
		var RGsecurity_phrase = new RegExp("--A--security_phrase--B--","g");
		var RGcomments = new RegExp("--A--comments--B--","g");
		var RGfullname = new RegExp("--A--fullname--B--","g");
		var RGfronter = new RegExp("--A--fronter--B--","g");
		var RGuser = new RegExp("--A--user--B--","g");
		var RGpass = new RegExp("--A--pass--B--","g");
		var RGlead_id = new RegExp("--A--lead_id--B--","g");
		var RGcampaign = new RegExp("--A--campaign--B--","g");
		var RGphone_login = new RegExp("--A--phone_login--B--","g");
		var RGoriginal_phone_login = new RegExp("--A--original_phone_login--B--","g");
		var RGgroup = new RegExp("--A--group--B--","g");
		var RGchannel_group = new RegExp("--A--channel_group--B--","g");
		var RGSQLdate = new RegExp("--A--SQLdate--B--","g");
		var RGepoch = new RegExp("--A--epoch--B--","g");
		var RGuniqueid = new RegExp("--A--uniqueid--B--","g");
		var RGcustomer_zap_channel = new RegExp("--A--customer_zap_channel--B--","g");
		var RGserver_ip = new RegExp("--A--server_ip--B--","g");
		var RGSIPexten = new RegExp("--A--SIPexten--B--","g");
		var RGsession_id = new RegExp("--A--session_id--B--","g");
		var RGdispo = new RegExp("--A--dispo--B--","g");
		var RGdialed_number = new RegExp("--A--dialed_number--B--","g");
		var RGdialed_label = new RegExp("--A--dialed_label--B--","g");
		var RGrank = new RegExp("--A--rank--B--","g");
		var RGowner = new RegExp("--A--owner--B--","g");
		var RGcamp_script = new RegExp("--A--camp_script--B--","g");
		var RGin_script = new RegExp("--A--in_script--B--","g");
		var RGscript_width = new RegExp("--A--script_width--B--","g");
		var RGscript_height = new RegExp("--A--script_height--B--","g");
		var RGrecording_filename = new RegExp("--A--recording_filename--B--","g");
		var RGrecording_id = new RegExp("--A--recording_id--B--","g");
		var RGuser_custom_one = new RegExp("--A--user_custom_one--B--","g");
		var RGuser_custom_two = new RegExp("--A--user_custom_two--B--","g");
		var RGuser_custom_three = new RegExp("--A--user_custom_three--B--","g");
		var RGuser_custom_four = new RegExp("--A--user_custom_four--B--","g");
		var RGuser_custom_five = new RegExp("--A--user_custom_five--B--","g");
		var RGpreset_number_a = new RegExp("--A--preset_number_a--B--","g");
		var RGpreset_number_b = new RegExp("--A--preset_number_b--B--","g");
		var RGpreset_number_c = new RegExp("--A--preset_number_c--B--","g");
		var RGpreset_number_d = new RegExp("--A--preset_number_d--B--","g");
		var RGpreset_number_e = new RegExp("--A--preset_number_e--B--","g");
		var RGpreset_dtmf_a = new RegExp("--A--preset_dtmf_a--B--","g");
		var RGpreset_dtmf_b = new RegExp("--A--preset_dtmf_b--B--","g");
		var RGweb_vars = new RegExp("--A--web_vars--B--","g");

		encoded = encoded.replace(RGvendor_lead_code, SCvendor_lead_code);
		encoded = encoded.replace(RGsource_id, SCsource_id);
		encoded = encoded.replace(RGlist_id, SClist_id);
		encoded = encoded.replace(RGgmt_offset_now, SCgmt_offset_now);
		encoded = encoded.replace(RGcalled_since_last_reset, SCcalled_since_last_reset);
		encoded = encoded.replace(RGphone_code, SCphone_code);
		encoded = encoded.replace(RGphone_number, SCphone_number);
		encoded = encoded.replace(RGtitle, SCtitle);
		encoded = encoded.replace(RGfirst_name, SCfirst_name);
		encoded = encoded.replace(RGmiddle_initial, SCmiddle_initial);
		encoded = encoded.replace(RGlast_name, SClast_name);
		encoded = encoded.replace(RGaddress1, SCaddress1);
		encoded = encoded.replace(RGaddress2, SCaddress2);
		encoded = encoded.replace(RGaddress3, SCaddress3);
		encoded = encoded.replace(RGcity, SCcity);
		encoded = encoded.replace(RGstate, SCstate);
		encoded = encoded.replace(RGprovince, SCprovince);
		encoded = encoded.replace(RGpostal_code, SCpostal_code);
		encoded = encoded.replace(RGcountry_code, SCcountry_code);
		encoded = encoded.replace(RGgender, SCgender);
		encoded = encoded.replace(RGdate_of_birth, SCdate_of_birth);
		encoded = encoded.replace(RGalt_phone, SCalt_phone);
		encoded = encoded.replace(RGemail, SCemail);
		encoded = encoded.replace(RGsecurity_phrase, SCsecurity_phrase);
		encoded = encoded.replace(RGcomments, SCcomments);
		encoded = encoded.replace(RGfullname, SCfullname);
		encoded = encoded.replace(RGfronter, SCfronter);
		encoded = encoded.replace(RGuser, SCuser);
		encoded = encoded.replace(RGpass, SCpass);
		encoded = encoded.replace(RGlead_id, SClead_id);
		encoded = encoded.replace(RGcampaign, SCcampaign);
		encoded = encoded.replace(RGphone_login, SCphone_login);
		encoded = encoded.replace(RGoriginal_phone_login, SCoriginal_phone_login);
		encoded = encoded.replace(RGgroup, SCgroup);
		encoded = encoded.replace(RGchannel_group, SCchannel_group);
		encoded = encoded.replace(RGSQLdate, SCSQLdate);
		encoded = encoded.replace(RGepoch, SCepoch);
		encoded = encoded.replace(RGuniqueid, SCuniqueid);
		encoded = encoded.replace(RGcustomer_zap_channel, SCcustomer_zap_channel);
		encoded = encoded.replace(RGserver_ip, SCserver_ip);
		encoded = encoded.replace(RGSIPexten, SCSIPexten);
		encoded = encoded.replace(RGsession_id, SCsession_id);
		encoded = encoded.replace(RGdispo, SCdispo);
		encoded = encoded.replace(RGdialed_number, SCdialed_number);
		encoded = encoded.replace(RGdialed_label, SCdialed_label);
		encoded = encoded.replace(RGrank, SCrank);
		encoded = encoded.replace(RGowner, SCowner);
		encoded = encoded.replace(RGcamp_script, SCcamp_script);
		encoded = encoded.replace(RGin_script, SCin_script);
		encoded = encoded.replace(RGscript_width, SCscript_width);
		encoded = encoded.replace(RGscript_height, SCscript_height);
		encoded = encoded.replace(RGrecording_filename, SCrecording_filename);
		encoded = encoded.replace(RGrecording_id, SCrecording_id);
		encoded = encoded.replace(RGuser_custom_one, SCuser_custom_one);
		encoded = encoded.replace(RGuser_custom_two, SCuser_custom_two);
		encoded = encoded.replace(RGuser_custom_three, SCuser_custom_three);
		encoded = encoded.replace(RGuser_custom_four, SCuser_custom_four);
		encoded = encoded.replace(RGuser_custom_five, SCuser_custom_five);
		encoded = encoded.replace(RGpreset_number_a, SCpreset_number_a);
		encoded = encoded.replace(RGpreset_number_b, SCpreset_number_b);
		encoded = encoded.replace(RGpreset_number_c, SCpreset_number_c);
		encoded = encoded.replace(RGpreset_number_d, SCpreset_number_d);
		encoded = encoded.replace(RGpreset_number_e, SCpreset_number_e);
		encoded = encoded.replace(RGpreset_dtmf_a, SCpreset_dtmf_a);
		encoded = encoded.replace(RGpreset_dtmf_b, SCpreset_dtmf_b);
		encoded = encoded.replace(RGweb_vars, SCweb_vars);
		}
	decoded=encoded; // simple no ?
	decoded = decoded.replace(RGnl, "<BR>");
	//	   while (i < encoded.length) {
	//		   var ch = encoded.charAt(i);
	//		   if (ch == "%") {
	//				if (i < (encoded.length-2) 
	//						&& HEXCHAR.indexOf(encoded.charAt(i+1)) != -1 
	//						&& HEXCHAR.indexOf(encoded.charAt(i+2)) != -1 ) {
	//					decoded += unescape( encoded.substr(i,3) );
	//					i += 3;
	//				} else {
	//					alert( 'Bad escape combo near ...' + encoded.substr(i) );
	//					decoded += "%[ERR]";
	//					i++;
	//				}
	//			} else {
	//			   decoded += ch;
	//			   i++;
	//			}
	//		} // while
	//		decoded = decoded.replace(RGnl, "<BR>");
	//
	return false;
	};


// ################################################################################
// Taken form php.net Angelos
function utf8_decode(utftext) {
        var string = "";
        var i = 0;
        var c = c1 = c2 = 0;

        while ( i < utftext.length ) {

            c = utftext.charCodeAt(i);

            if (c < 128) {
                string += String.fromCharCode(c);
                i++;
            }
            else if((c > 191) && (c < 224)) {
                c2 = utftext.charCodeAt(i+1);
                string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
                i += 2;
            }
            else {
                c2 = utftext.charCodeAt(i+1);
                c3 = utftext.charCodeAt(i+2);
                string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
                i += 3;
            }

        }

        return string;
    };


// ################################################################################
// phone number format
function phone_number_format(formatphone) {
	// customer_local_time, status date display 9999999999
	//	vdc_header_phone_format
	//	CN_NODS 0000000000 - CHINA phone number<BR>
	//	US_DASH 000-000-0000 - USA dash separated phone number<BR>
	//	US_PARN (000)000-0000 - USA dash separated number with area code in parenthesis<BR>
	//	UK_DASH 00 0000-0000 - UK dash separated phone number with space after city code<BR>
	//	AU_SPAC 000 000 000 - Australia space separated phone number<BR>
	//	IT_DASH 0000-000-000 - Italy dash separated phone number<BR>
	//	FR_SPAC 00 00 00 00 00 - France space separated phone number<BR>
	var regUS_DASHphone = new RegExp("US_DASH","g");
	var regUS_PARNphone = new RegExp("US_PARN","g");
	var regUK_DASHphone = new RegExp("UK_DASH","g");
	var regAU_SPACphone = new RegExp("AU_SPAC","g");
	var regIT_DASHphone = new RegExp("IT_DASH","g");
	var regFR_SPACphone = new RegExp("FR_SPAC","g");

	//Add by fnatic start
	var regCN_NODSphone = new RegExp("CN_NODS","g");
	//Add by fnatic end

	var status_display_number = formatphone;
	var dispnum = formatphone;
	if (disable_alter_custphone == 'HIDE')
		{
		var status_display_number = 'XXXXXXXXXX';
		var dispnum = 'XXXXXXXXXX';
		}

    //Add by fnatic start

	if (vdc_header_phone_format.match(regCN_NODSphone))
		{
		var status_display_number = dispnum;
		}

	//Add by fnatic end

	if (vdc_header_phone_format.match(regUS_DASHphone))
		{
		var status_display_number = dispnum.substring(0,3) + '-' + dispnum.substring(3,6) + '-' + dispnum.substring(6,10);
		}
	if (vdc_header_phone_format.match(regUS_PARNphone))
		{
		var status_display_number = '(' + dispnum.substring(0,3) + ')' + dispnum.substring(3,6) + '-' + dispnum.substring(6,10);
		}
	if (vdc_header_phone_format.match(regUK_DASHphone))
		{
		var status_display_number = dispnum.substring(0,2) + ' ' + dispnum.substring(2,6) + '-' + dispnum.substring(6,10);
		}
	if (vdc_header_phone_format.match(regAU_SPACphone))
		{
		var status_display_number = dispnum.substring(0,3) + ' ' + dispnum.substring(3,6) + ' ' + dispnum.substring(6,9);
		}
	if (vdc_header_phone_format.match(regIT_DASHphone))
		{
		var status_display_number = dispnum.substring(0,4) + '-' + dispnum.substring(4,7) + '-' + dispnum.substring(8,10);
		}
	if (vdc_header_phone_format.match(regFR_SPACphone))
		{
		var status_display_number = dispnum.substring(0,2) + ' ' + dispnum.substring(2,4) + ' ' + dispnum.substring(4,6) + ' ' + dispnum.substring(6,8) + ' ' + dispnum.substring(8,10);
		}

	return status_display_number;
	};


// ################################################################################
// RefresH the agents view sidebar or xfer frame
	function refresh_agents_view(RAlocation,RAcount)
		{
		if (RAlocation == 'AgentXferViewSelect'){
			var agentViewUsergroup = document.getElementById("AgentViewUsergroup2").options[document.getElementById("AgentViewUsergroup2").options.selectedIndex].value;
			var agentViewTechgroup = document.getElementById("AgentViewTechgroup2").options[document.getElementById("AgentViewTechgroup2").options.selectedIndex].value;
		}else{
			var agentViewUsergroup = document.getElementById("AgentViewUsergroup").options[document.getElementById("AgentViewUsergroup").options.selectedIndex].value;
			var agentViewTechgroup = document.getElementById("AgentViewTechgroup").options[document.getElementById("AgentViewTechgroup").options.selectedIndex].value;
		}
		if (RAcount > 0)
			{
			if (even > 0)
				{
				var xmlhttp=false;
				/*@cc_on @*/
				/*@if (@_jscript_version >= 5)
				// JScript gives us Conditional compilation, we can cope with old IE versions.
				// and security blocked creation of the objects.
				 try {
				  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				 } catch (e) {
				  try {
				   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				  } catch (E) {
				   xmlhttp = false;
				  }
				 }
				@end @*/
				if (!xmlhttp && typeof XMLHttpRequest!='undefined')
					{
					xmlhttp = new XMLHttpRequest();
					}
				if (xmlhttp) 
					{ 
					//RAview_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=AGENTSview&format=text&user=" + user + "&pass=" + pass + "&user_group=" + VU_user_group + "&conf_exten=" + session_id + "&extension=" + extension + "&protocol=" + protocol + "&stage=" + agent_status_view_time + "&agentViewUsergroup=" + agentViewUsergroup + "&agentViewTechgroup=" + agentViewTechgroup  + "&campaign=" + campaign + "&comments=" + RAlocation;
					RAview_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=AGENTSview&format=text&user=" + user + "&pass=" + pass + "&user_group=" + VU_user_group + "&conf_exten=" + session_id + "&extension=" + extension + "&protocol=" + protocol + "&stage=" + agent_status_view_time + "&agentViewUsergroup=" + agentViewUsergroup + "&redirectcalltoagentid=" + redirectcalltoagentid + "&agentViewTechgroup=" + agentViewTechgroup  + "&campaign=" + campaign + "&comments=" + RAlocation;
					
					//alert(RAview_query);
					xmlhttp.open('POST', 'vdc_db_query.php'); 
					xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
					xmlhttp.send(RAview_query); 
					xmlhttp.onreadystatechange = function() 
						{ 
						if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
							{
							var newRAlocationHTML = xmlhttp.responseText;
							//alert(newRAlocationHTML);

							if (RAlocation == 'AgentXferViewSelect') 
								{
								document.getElementById(RAlocation).innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><a href=\"#\" onclick=\"AgentsXferSelect('0','AgentXferViewSelect');return false;\">返回</a></b>&nbsp;&nbsp;&nbsp;&nbsp;"+newRAlocationHTML;
								}
							else
								{
								document.getElementById(RAlocation).innerHTML = newRAlocationHTML + "\n";
								}
													xmlhttp = null;
						CollectGarbage();
							}
						}
					delete xmlhttp;
					}
				}
			}
		}

		
	function ringcallredirect(CQauto_call_id){
		redirectcalltoagentid = CQauto_call_id;
		AgentsViewOpen('AgentViewSpan','open');
	}
	
	function ringcallredirect2(CQauto_call_id,direct_user){
		var xmlhttp=false;
		/*@cc_on @*/
		/*@if (@_jscript_version >= 5)
		// JScript gives us Conditional compilation, we can cope with old IE versions.
		// and security blocked creation of the objects.
		 try {
		  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		 } catch (e) {
		  try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  } catch (E) {
		   xmlhttp = false;
		  }
		 }
		@end @*/
		if (!xmlhttp && typeof XMLHttpRequest!='undefined')
			{
			xmlhttp = new XMLHttpRequest();
			}
		if (xmlhttp) 
			{
			var RAview_query = "server_ip=" + server_ip + "&account=" + direct_user+ "&session_name=" + session_name + "&format=text&user=" + user + "&pass=" + pass + "&conf_exten=" + session_id + "&stage=" + CQauto_call_id + "&ACTION=ringcallredirect";
			xmlhttp.open('POST', 'vdc_db_query.php');
			xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
			xmlhttp.send(RAview_query); 
			xmlhttp.onreadystatechange = function() 
				{
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
					{
					$('#AgentViewSpanDIV').dialog('close');
					redirectcalltoagentid = "";
					var CQgrabresponse = xmlhttp.responseText;
					xmlhttp = null;
					CollectGarbage();
					}
				}
			delete xmlhttp;
			}
	}
		
	function checkqueuegrab(CQauto_call_id){
		if(CheckOutboundChannelLine2 == 0){
			document.getElementById("out_line12").innerHTML = "";
			if(AutoDialWaiting == 2){
				alert("提取电话正在通话中！");
			}else{
				if ( customerparked == 0 )
					{
						mainxfer_send_redirect('ParK',lastcustchannel,lastcustserverip);
						customerparked = 1;
					}
				if ( customerparked == 1 )
					{
						callinqueuegrab2(CQauto_call_id);
					}
				else if (VDRP_stage == 'PAUSED')
					{
						callinqueuegrab(CQauto_call_id);
					}
				else
					{
						alert("你要暂停或者保持电话情况下才可以提取电话！");
					}
			}
		}else{
			alert("请先挂断line2");
		}

	}
// ################################################################################
// Grab the call in queue and bring it into the session
	function callinqueuegrab(CQauto_call_id)
		{
		if (CQauto_call_id > 0)
			{

				var xmlhttp=false;
				/*@cc_on @*/
				/*@if (@_jscript_version >= 5)
				// JScript gives us Conditional compilation, we can cope with old IE versions.
				// and security blocked creation of the objects.
				 try {
				  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				 } catch (e) {
				  try {
				   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				  } catch (E) {
				   xmlhttp = false;
				  }
				 }
				@end @*/
				if (!xmlhttp && typeof XMLHttpRequest!='undefined')
					{
					xmlhttp = new XMLHttpRequest();
					}
				if (xmlhttp) 
					{ 
					RAview_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=CALLSINQUEUEgrab&format=text&user=" + user + "&pass=" + pass + "&conf_exten=" + session_id + "&extension=" + extension + "&protocol=" + protocol + "&campaign=" + campaign + "&stage=" + CQauto_call_id;
					xmlhttp.open('POST', 'vdc_db_query.php'); 
					xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
					xmlhttp.send(RAview_query); 
					xmlhttp.onreadystatechange = function() 
						{ 
						if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
							{
							var CQgrabresponse = xmlhttp.responseText;
							var regCQerror = new RegExp("ERROR","ig");
							if (CQgrabresponse.match(regCQerror))
								{
								alert(CQgrabresponse);
								}
							else
								{
								AutoDial_ReSume_PauSe("VDADready",'','','NO_STATUS_CHANGE');
								AutoDialWaiting=1;
								}
													xmlhttp = null;
						CollectGarbage();
							}
						}
					delete xmlhttp;
					}
			}
		}
	function check_for_grab_outcoming(){
		var CQauto_call_id = "1";
		var xmlhttp=false;
		/*@cc_on @*/
		/*@if (@_jscript_version >= 5)
		// JScript gives us Conditional compilation, we can cope with old IE versions.
		// and security blocked creation of the objects.
		 try {
		  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		 } catch (e) {
		  try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  } catch (E) {
		   xmlhttp = false;
		  }
		 }
		@end @*/
		if (!xmlhttp && typeof XMLHttpRequest!='undefined')
			{
			xmlhttp = new XMLHttpRequest();
			}
		if (xmlhttp) 
			{ 
			RAview_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=CALLSOUTBOUNDECHECK&format=text&user=" + user + "&pass=" + pass + "&conf_exten=" + session_id + "&extension=" + extension + "&protocol=" + protocol + "&campaign=" + campaign + "&stage=" + CQauto_call_id;
			xmlhttp.open('POST', 'vdc_db_query.php'); 
			xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
			xmlhttp.send(RAview_query); 
			xmlhttp.onreadystatechange = function() 
				{ 
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
					{
						var CQgrabresponse = xmlhttp.responseText;
						if(CQgrabresponse==0){
							CountOutboundChannelLine2 ++;
						}else{
							CountOutboundChannelLine2 = 0;
						}
						if(CountOutboundChannelLine2 >= 4){
							outbound_hangup_line2();
						}
						xmlhttp = null;
						CollectGarbage();
					}
				}
			delete xmlhttp;
			}
	}
	function check_for_grab_incoming(){
		var CQauto_call_id = CALLSINQUEUEGRABID;
		var xmlhttp=false;
		/*@cc_on @*/
		/*@if (@_jscript_version >= 5)
		// JScript gives us Conditional compilation, we can cope with old IE versions.
		// and security blocked creation of the objects.
		 try {
		  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		 } catch (e) {
		  try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  } catch (E) {
		   xmlhttp = false;
		  }
		 }
		@end @*/
		if (!xmlhttp && typeof XMLHttpRequest!='undefined')
			{
			xmlhttp = new XMLHttpRequest();
			}
		if (xmlhttp) 
			{ 
			RAview_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=CALLSINQUEUECHECK&format=text&user=" + user + "&pass=" + pass + "&conf_exten=" + session_id + "&extension=" + extension + "&protocol=" + protocol + "&campaign=" + campaign + "&stage=" + CQauto_call_id;
			xmlhttp.open('POST', 'vdc_db_query.php'); 
			xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
			xmlhttp.send(RAview_query); 
			xmlhttp.onreadystatechange = function() 
				{ 
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
					{
						var CQgrabresponse = xmlhttp.responseText;
						if(CQgrabresponse==0){
							check_for_grab_incoming_count ++;
						}else{
							check_for_grab_incoming_count = 0;
						}
						if(check_for_grab_incoming_count == 5){
							callinqueuehangup(1);
							check_for_grab_incoming_count = 0;
						}
						xmlhttp = null;
						CollectGarbage();
					}
				}
			delete xmlhttp;
			}
	}
	function callinqueuegrab2(CQauto_call_id){
		AutoDialWaiting = 2;
		if (CQauto_call_id > 0)
			{
				var xmlhttp=false;
				/*@cc_on @*/
				/*@if (@_jscript_version >= 5)
				// JScript gives us Conditional compilation, we can cope with old IE versions.
				// and security blocked creation of the objects.
				 try {
				  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				 } catch (e) {
				  try {
				   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				  } catch (E) {
				   xmlhttp = false;
				  }
				 }
				@end @*/
				if (!xmlhttp && typeof XMLHttpRequest!='undefined')
					{
					xmlhttp = new XMLHttpRequest();
					}
				if (xmlhttp) 
					{

					RAview_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=CALLSINQUEUEgrab2&format=text&user=" + user + "&pass=" + pass + "&conf_exten=" + session_id + "&extension=" + extension + "&protocol=" + protocol + "&user_group=" + VU_user_group + "&last_name=" + recording_exten +"&campaign=" + campaign + "&stage=" + CQauto_call_id;
					xmlhttp.open('POST', 'vdc_db_query.php'); 
					xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
					xmlhttp.send(RAview_query); 
					xmlhttp.onreadystatechange = function() 
						{ 
						if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
							{
								var CQgrabresponse = xmlhttp.responseText;
								CALLSINQUEUEGRABSTR = CQgrabresponse;
								var arr_temp = CQgrabresponse.split("|");
								CALLSINQUEUEGRABID = arr_temp[0];
								agent_log_id_line2 = arr_temp[4];								
								
								//document.getElementById("line12").innerHTML = "<a href=\"#\" onClick=\"callinqueuehangup(0);return false;\">挂断提取电话</a>";
								document.getElementById("line12").innerHTML = "<input type='button' onclick=\"callinqueuehangup(0);return false;\" value=\"挂断\" />";
								xmlhttp = null;
								CollectGarbage();
							}
						}
					delete xmlhttp;
					}
			}
	}
	function callinqueuehangup(type){
		var CQauto_call_id = CALLSINQUEUEGRABSTR + "|" + type;
		var xmlhttp=false;
		/*@cc_on @*/
		/*@if (@_jscript_version >= 5)
		// JScript gives us Conditional compilation, we can cope with old IE versions.
		// and security blocked creation of the objects.
		 try {
		  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		 } catch (e) {
		  try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  } catch (E) {
		   xmlhttp = false;
		  }
		 }
		@end @*/
		if (!xmlhttp && typeof XMLHttpRequest!='undefined')
			{
			xmlhttp = new XMLHttpRequest();
			}
		if (xmlhttp) 
			{ 
			RAview_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=CALLSINQUEUEHANGUP&format=text&user=" + user + "&pass=" + pass + "&conf_exten=" + session_id + "&extension=" + extension + "&protocol=" + protocol + "&campaign=" + campaign + "&stage=" + CQauto_call_id + "&agent_log_id_line2=" + agent_log_id_line2;
			xmlhttp.open('POST', 'vdc_db_query.php'); 
			xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
			xmlhttp.send(RAview_query); 
			xmlhttp.onreadystatechange = function() 
				{ 
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
					{
						AutoDialWaiting=0;
						document.getElementById("line12").innerHTML = "";
						xmlhttp = null;
						CollectGarbage();
						document.getElementById("out_line12").innerHTML = "<input type='text' size=\"15\" maxlength=\"20\" name=\"tel_out_line2\" id=\"tel_out_line2\" value=\"\" ><input type='button' onClick=\"outbound_dial_line2();return false;\" value=\"拨号\" />";
						agent_log_id_line2 = 0;
					}
				}
			delete xmlhttp;
			}
	}
// ################################################################################
// RefresH the calls in queue bottombar
	function refresh_calls_in_queue(CQcount)
		{
		if (CQcount > 0)
			{
			if (even > 0)
				{
				var xmlhttp=false;
				/*@cc_on @*/
				/*@if (@_jscript_version >= 5)
				// JScript gives us Conditional compilation, we can cope with old IE versions.
				// and security blocked creation of the objects.
				 try {
				  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				 } catch (e) {
				  try {
				   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				  } catch (E) {
				   xmlhttp = false;
				  }
				 }
				@end @*/
				if (!xmlhttp && typeof XMLHttpRequest!='undefined')
					{
					xmlhttp = new XMLHttpRequest();
					}
				if (xmlhttp) 
					{ 
					RAview_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=CALLSINQUEUEview&format=text&user=" + user + "&pass=" + pass + "&conf_exten=" + session_id + "&extension=" + extension + "&protocol=" + protocol + "&campaign=" + campaign + "&stage=100%";
					xmlhttp.open('POST', 'vdc_db_query.php'); 
					xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
					xmlhttp.send(RAview_query); 
					xmlhttp.onreadystatechange = function() 
						{ 
						if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
							{
						//	alert(xmlhttp.responseText);
							document.getElementById('callsinqueuelist').innerHTML = xmlhttp.responseText + "\n";
							xmlhttp = null;
							CollectGarbage();
							}
						}
					delete xmlhttp;
					}

				}
			}
		}
//#########################################edit by pie 20110422
function SystemModelessDialog(url,width,height)
{
//	alert(url);
//	window.open(url);
//	var clientHeight	= document.body.clientHeight;
//	alert(clientHeight);
//	var top				= clientHeight - height-10;
//	alert(top);
	var top				= 1800;

//	subWin = window.showModelessDialog(url,window, "dialogWidth:" + width + "px;dialogHeight:" + height + "px;help:no;resizable:no;scroll:no;status:no;dialogTop:"+ top +"px;dialogLeft:1px");
		subWin = window.open(url,"newwindow", "height=" + height + "px, width=" + width + "px, top=" + top + "px, left=1px, toolbar=no, menubar=no, scrollbars=no, resizable=no, location=no, status=no, help=no");

//var i = screen.width;
//	var xml_width = '400';
//	var left = 0;
//	var width = i;
//	var top = 0;
//	if(xml_width!='0'){
//		left = i - 400 - 0;
//		width= 400;
//		top = 0;
//	}
//	var height= screen.height;
//
//	window.open("agc_cn/vicidial.php?relogin=YES","","height=" + height + ", width=" + width + ", top=" + top + ", left=" + left + ", toolbar=no, menubar=no, scrollbars=yes, resizable=yes, location=no, status=no");



}
//############################################################################
//####################################################yanson@20100803
function phone_location(phone,campaignid){
		var xmlHttp = false;
		  var result;
		  if(window.ActiveXObject){ xmlHttp = new ActiveXObject("Microsoft.XMLHTTP"); }
		  else if(window.XMLHttpRequest){ xmlHttp = new XMLHttpRequest(); }
		  if(xmlHttp){
			var queryString =  "&phone="+phone+"&campaign="+campaignid;
			xmlHttp.open("POST", "../agc/phone_location.php", true);
			xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
			xmlHttp.send(queryString);
			xmlHttp.onreadystatechange = function() {
			  if (xmlHttp.readyState == 4 && xmlHttp.status == 200){
				//alert(xmlHttp.responseText);
				document.getElementById("location").innerHTML ="("+ xmlHttp.responseText + ")";
				xmlhttp = null;
				CollectGarbage();
			  }
			};
			delete xmlHttp;
		 
	}
}
function phone_location_str_alert(phone,str1,str2,campaignid){
		  var xmlHttp = false;
		  var result;
		  var call_from	= str1;
		  var from_user	=	str2;
		  if(window.ActiveXObject){ xmlHttp = new ActiveXObject("Microsoft.XMLHTTP"); }
		  else if(window.XMLHttpRequest){ xmlHttp = new XMLHttpRequest(); }
		  if(xmlHttp){
			var queryString =  "&phone="+phone+"&campaign="+campaignid;
			xmlHttp.open("POST", "../agc/phone_location.php", true);
			xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
			xmlHttp.send(queryString);
			xmlHttp.onreadystatechange = function() {
				if (xmlHttp.readyState == 4 && xmlHttp.status == 200){
//edit by pie 2011-04-25
				document.getElementById("ShowFromCallInfo").innerHTML = str1  + "(" + xmlHttp.responseText + ")" + str2 + "<br>";
//				$(function(){
//				$("#ShowFromCallInfoDIV").floatdiv({left:"0px",bottom:"0px"});
				$("#ShowFromCallInfoDIV").dialog
				({ draggable: false,
					resizable:false ,
					width:'250',
					height:'auto',
					modal: false,
					position:["left","bottom"]
//					title:"Show From Call Info"
				});
				$("#ShowFromCallInfoDIV").dialog('open');
//				});
//edit end 2011-04-25
//					alert(xmlHttp.responseText);
				var url ='./show_from_call_info.php?call_from='+encodeURI(call_from)+'&phone_location='+encodeURI(xmlHttp.responseText)+'&from_user='+encodeURI(from_user);

//				SystemModelessDialog(url,'300','150');
				//alert(str1 + "("+ xmlHttp.responseText + ")" + str2);
				xmlhttp = null;
				CollectGarbage();
				}
			};
		    delete xmlHttp;
	      }
}
// ################################################################################
// ################################################################################
// Open or close the callsinqueue view bottombar
	function show_calls_in_queue(CQoperation)
		{
		if (CQoperation=='SHOW')
			{
			//Mod by fnatic
			//document.getElementById("callsinqueuelink").innerHTML = "<a href=\"#\"  onclick=\"show_calls_in_queue('HIDE');\">隐藏队列通话</a>";
			document.getElementById("callsinqueuelink").innerHTML = "<a href=\"#\"  onclick=\"show_calls_in_queue('SHOW');\">提取队列通话</a>";
			view_calls_in_queue_active=1;
			showDiv('callsinqueuedisplay');
			$('#callsinqueuedisplayDIV').dialog('open');
			}
		/*else
			{
			document.getElementById("callsinqueuelink").innerHTML = "<a href=\"#\"  onclick=\"show_calls_in_queue('SHOW');\">查看队列中的电话</a>";
			view_calls_in_queue_active=0;
			hideDiv('callsinqueuedisplay');
			$("#callsinqueuedisplayDIV").dialog("destory");
			}*/
		}


// ################################################################################
// Open or close the agents view sidebar or xfer frame
	function AgentsViewOpen(AVlocation,AVoperation)
		{
		if (AVoperation=='open')
			{
			if (AVlocation=='AgentViewSpan')
				{//Mod by fnatic 
				document.getElementById("AgentViewStatus").innerHTML = "";
				//document.getElementById("AgentViewLink").innerHTML = "<a href=\"#\" onclick=\"AgentsViewOpen('AgentViewSpan','close');return false;\">查看话务员状态</a>";
				document.getElementById("AgentViewLink").innerHTML = "<a href=\"#\" onclick=\"redirectcalltoagentid = '';AgentsViewOpen('AgentViewSpan','open');return false;\">查看话务员状态</a>";
				agent_status_view_active=1;
				$('#AgentViewSpanDIV').dialog('open');
				}
			showDiv(AVlocation);
			}
		else
			{
			if (AVlocation=='AgentViewSpan')
				{
				document.getElementById("AgentViewLink").innerHTML = "<a href=\"#\" onclick=\"redirectcalltoagentid = '';AgentsViewOpen('AgentViewSpan','open');return false;\">查看话务员状态</a>";
				agent_status_view_active=0;
				$('#AgentViewSpanDIV').dialog('close');
				}
			hideDiv(AVlocation);
			
			}
		}


// ################################################################################
// Populate the number to dial field with the selected user ID
	function AgentsXferSelect(AXuser,AXlocation)
		{
		xfer_select_agents_active=0;
		document.getElementById('AgentXferViewSelect').innerHTML = '';
		hideDiv('AgentXferViewSpan');
		hideDiv(AXlocation);
		//Mod by fnatic
		showDiv('XfeRGrouP');
		//document.vicidial_form.xfernumber.value = AXuser;
		if(AXuser != 0){
			document.getElementById("xfernumber").value = AXuser;
		}
		}
	function chekTel(obj){

	    var re = /^[0-9]*$/;
        if (!re.test(obj.value) || obj.value.length > 16){
            alert("号码必须为数字且长度小于16！");
            obj.value = "";
            return false;
        }
	}

// ################################################################################
// OnChange function for transfer group select list
	function XferAgentSelectLink()
		{
		var XfeRSelecT = document.getElementById("XfeRGrouP");
		var XScheck = XfeRSelecT.value
		if (XScheck.match(/AGENTDIRECT/))
			{
			showDiv('agentdirectlink');
			}
		else
			{
			//yanson@20101230
			//hideDiv('agentdirectlink');
			}
		}


// ################################################################################
// function for number to dial for AGENTDIRECT in-group transfers
	function XferAgentSelectLaunch()
		{
		var XfeRSelecT = document.getElementById("XfeRGrouP");
		var XScheck = XfeRSelecT.value;
		if (XScheck.match(/AGENTDIRECT/))
			{
			hideDiv('XfeRGrouP');
			showDiv('AgentXferViewSpan');
			AgentsViewOpen('AgentXferViewSelect','open');
			refresh_agents_view('AgentXferViewSelect',agent_status_view);
			xfer_select_agents_active=1;
			}
		}


// ################################################################################
// Call ReQueue call back to AGENTDIRECT queue launch
	function call_requeue_launch()
		{
		//Mod by fnatic
		//document.vicidial_form.xfernumber.value = user;
        document.getElementById("xfernumber").value = user;
		// Build transfer pull-down list
		var loop_ct = 0;
		var live_XfeR_HTML = '';
		var XfeR_SelecT = '';
		while (loop_ct < XFgroupCOUNT)
			{
			if (VARxfergroups[loop_ct] == 'AGENTDIRECT')
				{XfeR_SelecT = 'selected ';}
			else {XfeR_SelecT = '';}
			live_XfeR_HTML = live_XfeR_HTML + "<option " + XfeR_SelecT + "value=\"" + VARxfergroups[loop_ct] + "\">" + VARxfergroups[loop_ct] + " - " + VARxfergroupsnames[loop_ct] + "</option>\n";
			loop_ct++;
			}
		document.getElementById("XfeRGrouPLisT").innerHTML = "<select size=1 name=XfeRGrouP  id=XfeRGrouP  onChange=\"XferAgentSelectLink();return false;\">" + live_XfeR_HTML + "</select>";

		mainxfer_send_redirect('XfeRLOCAL',lastcustchannel,lastcustserverip,'','NO');

		document.getElementById("DispoSelection").value = 'RQXFER';
		DispoSelect_submit();

		AutoDial_ReSume_PauSe("VDADpause",'','','',"REQUEUE");

		PauseCodeSelect_submit("RQUEUE");
		}


// ################################################################################
// Move the Dispo frame out of the way and change the link to maximize
	function DispoMinimize()
		{
		showDiv('DispoButtonHideA');
		showDiv('DispoButtonHideB');
		showDiv('DispoButtonHideC');
		//bear document.getElementById("DispoSelectBox").style.top = 340;
		document.getElementById("DispoSelectMaxMin").innerHTML = "<a href=\"#\" onclick=\"DispoMaximize()\"> 最大 </a>";
		}


// ################################################################################
// Move the Dispo frame to the top and change the link to minimize
	function DispoMaximize()
		{
		//bear document.getElementById("DispoSelectBox").style.top = 1;
		//Del by fnatic document.getElementById("DispoSelectMaxMin").innerHTML = "<a href=\"#\" onclick=\"DispoMinimize()\"> 最小 </a>";
		hideDiv('DispoButtonHideA');
		hideDiv('DispoButtonHideB');
		hideDiv('DispoButtonHideC');
		}


// ################################################################################
// 展现 the groups selection span
	function OpeNGrouPSelectioN()
		{
		if ( (AutoDialWaiting == 1) || (VD_live_customer_call==1) || (alt_dial_active==1) || (MD_channel_look==1) )
			{
			alert("您必须暂停才能变更技能组");
			}
		else
			{
			if (manager_ingroups_set > 0)
				{
				alert("经理" + external_igb_set_name + " 您可选择的技能组");
				}
			else
				{
				HidEGenDerPulldown();
				showDiv('CloserSelectBox')
				}
			}
		}


// ################################################################################
// 展现 the territories selection span
	function OpeNTerritorYSelectioN()
		{
		if ( (AutoDialWaiting == 1) || (VD_live_customer_call==1) || (alt_dial_active==1) || (MD_channel_look==1) )
			{
			alert("YOU MUST BE PAUSED TO CHANGE TERRITORIES");
			}
		else
			{
			showDiv('TerritorySelectBox');
			}
		}


// ################################################################################
// Hide the CBcommentsBox span upon click
	function CBcommentsBoxhide()
		{
		CBentry_time = '';
		CBcallback_time = '';
		CBuser = '';
		CBcomments = '';
		document.getElementById("CBcommentsBoxA").innerHTML = "";
		document.getElementById("CBcommentsBoxB").innerHTML = "";
		document.getElementById("CBcommentsBoxC").innerHTML = "";
		document.getElementById("CBcommentsBoxD").innerHTML = "";
		hideDiv('CBcommentsBox');
		}


// ################################################################################
// Hide the EAcommentsBox span upon click
	function EAcommentsBoxhide(minimizetask)
		{
		hideDiv('EAcommentsBox');
		if (minimizetask=='YES')
			{showDiv('EAcommentsMinBox');}
		else
			{hideDiv('EAcommentsMinBox');}
		}


// ################################################################################
// 展现 the EAcommentsBox span upon click
	function EAcommentsBoxshow()
		{
		showDiv('EAcommentsBox');
		hideDiv('EAcommentsMinBox');
		}


// ################################################################################
// Populating the date field in the callback frame prior to submission
	function CB_date_pick(taskdate)
		{
		document.getElementById("CallBackDatESelectioN").value = taskdate;
		document.getElementById("CallBackDatEPrinT").innerHTML = taskdate;
		}


// ################################################################################
// Submitting the callback date and time to the system
	function fall_CallBack(){
		$('#CallBackSelectBox').dialog('close');
	}

	function CallBackDatE_submit()
		{
		CallBackDatEForM = document.getElementById("CallBackDatESelectioN").value;
		CallBackCommenTs = document.getElementById("CallBackCommenTsField").value;
		if (CallBackDatEForM.length < 2)
			{alert("您必须选择日期");}
		else
			{

			CallBackTimEHouR = document.getElementById("CBT_hour").value;
			CallBackTimEMinuteS = document.getElementById("CBT_minute").value;
			CallBackTimEAmpM = document.getElementById("CBT_ampm").value;

			document.getElementById("CBT_hour").value = '01';
			document.getElementById("CBT_minute").value = '00';
			document.getElementById("CBT_ampm").value = 'PM';

			if (CallBackTimEHouR == '12')
				{
				if (CallBackTimEAmpM == 'AM')
					{
					CallBackTimEHouR = '00';
					}
				}
			else
				{
				if (CallBackTimEAmpM == 'PM')
					{
					CallBackTimEHouR = CallBackTimEHouR * 1;
					CallBackTimEHouR = (CallBackTimEHouR + 12);
					}
				}
			CallBackDatETimE = CallBackDatEForM + " " + CallBackTimEHouR + ":" + CallBackTimEMinuteS + ":00";

			if (document.getElementById("CallBackOnlyMe").checked==true)
				{
				CallBackrecipient = 'USERONLY';
				}
			else
				{
				CallBackrecipient = 'ANYONE';
				}
			document.getElementById("CallBackDatEPrinT").innerHTML = "选择日期小于";
		//	document.getElementById("CallBackOnlyMe").checked=false;
			document.getElementById("CallBackDatESelectioN").value = '';
			document.getElementById("CallBackCommenTsField").value = '';

		//	alert(CallBackDatETimE + "|" + CallBackCommenTs);

			document.getElementById("DispoSelection").value = 'CBHOLD';
			//bear hideDiv('CallBackSelectBox');
			$('#CallBackSelectBox').dialog('close');
			DispoSelect_submit2();
			}
			
		}


// ################################################################################
// Finish the wrapup timer early
	function TimerActionRun(taskaction,taskdialalert)
		{
		if (taskaction == 'DiaLAlerT')
			{
		//  Mod by fnatic start
		//	document.getElementById("TimerContentSpan").innerHTML = "<b>拨号提示:<BR><BR>" + taskdialalert.replace("\n","<BR>") + "</b>";
		    document.getElementById("TimerContentSpan").innerHTML =  taskdialalert.replace("\n","<BR>");
          
			showDiv('TimerSpan');
			$('#DailAlertDIV').dialog('open');
	    //  Mod by fnatic end  
			}
		else
			{
			if ( (timer_action_message.length > 0) || (timer_action == 'MESSAGE_ONLY') )
				{
				document.getElementById("TimerContentSpan").innerHTML = "<b>定时器通知: " + timer_action_seconds + " 秒<BR><BR>" + timer_action_message + "</b>";

				showDiv('TimerSpan');
				}

			if (timer_action == 'WEBFORM')
				{
				WebFormRefresH('NO','YES');
				window.open(TEMP_VDIC_web_form_address, web_form_target, 'toolbar=1,scrollbars=1,location=1,statusbar=1,menubar=1,resizable=1,width=640,height=450');
				}
			if (timer_action == 'WEBFORM2')
				{
				WebFormTwoRefresH('NO','YES');
				window.open(TEMP_VDIC_web_form_address_two, web_form_target, 'toolbar=1,scrollbars=1,location=1,statusbar=1,menubar=1,resizable=1,width=640,height=450');
				}
			if (timer_action == 'D1_DIAL')
				{
				DtMf_PreSet_a_DiaL();
				}
			if (timer_action == 'D2_DIAL')
				{
				DtMf_PreSet_b_DiaL();
				}
			if (timer_action == 'D3_DIAL')
				{
				DtMf_PreSet_c_DiaL();
				}
			if (timer_action == 'D4_DIAL')
				{
				DtMf_PreSet_d_DiaL();
				}
			if (timer_action == 'D5_DIAL')
				{
				DtMf_PreSet_e_DiaL();
				}
			}
		timer_action = 'NONE';
		}


// ################################################################################
// Finish the wrapup timer early
	function WrapupFinish()
		{
		wrapup_counter=999;
		}

    
// ################################################################################
// GLOBAL FUNCTIONS
	function begin_all_refresh()
		{
						// + fnatic
		//if(dial_method == "INBOUND_MAN")
			//{alert(1);ScriptPanelToFront();}		
		// End
		all_refresh();
		}
	function start_all_refresh()
		{
		
		if(ParkControlCount>=1){
			ParkControlCount ++;
			if(ParkControlCount ==6){
				document.getElementById("ParkControl").innerHTML ="<a href=\"#\" onclick=\"mainxfer_send_redirect('FROMParK','" + ParkControlredirectdestination + "','" + ParkControlredirectdestserverip + "');return false;\"><IMG SRC=\"../agc/images/cn/vdc_LB_grabparkedcall_cn.gif\" border=0 alt=\"接起\"></a>";
				ParkControlCount = 0;
			}
		}
		if(AutopauseControlCount >=2){
					AutopauseControlCount ++;
					if(AutopauseControlCount ==4){
					//alert(AutopauseControlCount);
					document.getElementById("DiaLControl").innerHTML = "<IMG SRC=\"../agc/images/vdc_LB_pause_OFF_cn.gif\" border=0 alt=\" 暂停 \"><a href=\"#\" onclick=\"AutoDial_ReSume_PauSe('VDADready');\"><IMG SRC=\"../agc/images/vdc_LB_resume_cn.gif\" border=0 alt=\"恢复\"></a>";				   
					AutopauseControlCount = 0;
					}
				}
		
		try{
    
		if (VICIDiaL_closer_login_checked==0)
			{
			hideDiv('NothingBox');
			hideDiv('CBcommentsBox');
			hideDiv('EAcommentsBox');
			hideDiv('EAcommentsMinBox');
			hideDiv('HotKeyActionBox');
			hideDiv('HotKeyEntriesBox');
			hideDiv('MainPanel');
			//edit@20101015 clear annotate hideDiv('ScriptPanel');
			hideDiv('ScriptPanel');
			hideDiv('ScriptRefresH');
			//bear hideDiv('DispoSelectBox');
			hideDiv('LogouTBox');
			hideDiv('AgenTDisablEBoX');
			hideDiv('SysteMDisablEBoX');
			hideDiv('CustomerGoneBox');
			hideDiv('NoneInSessionBox');
			hideDiv('WrapupBox');
			hideDiv('TransferMain');
			hideDiv('WelcomeBoxA'); //cn bug
			//bear hideDiv('CallBackSelectBox');
			hideDiv('DispoButtonHideA');
			hideDiv('DispoButtonHideB');
			hideDiv('DispoButtonHideC');
			hideDiv('CallBacKsLisTBox');
			hideDiv('NeWManuaLDiaLBox');
			//hideDiv('PauseCodeSelectBox');
			PauseCodeSelectContent_create();
			hideDiv('GroupAliasSelectBox');
			hideDiv('AgentViewSpan');
			hideDiv('AgentXferViewSpan');
			hideDiv('TimerSpan');
			hideDiv('agentdirectlink');
			if (view_calls_in_queue_launch != '1')
				{hideDiv('callsinqueuedisplay');}
			if (agentonly_callbacks != '1')
				{hideDiv('CallbacksButtons');}
			if (allow_alerts < 1)
				{hideDiv('AgentAlertSpan');}
		//	if ( (agentcall_manual != '1') && (starting_dial_level > 0) )
			if (agentcall_manual != '1')
				{hideDiv('ManuaLDiaLButtons');}
			if (callholdstatus != '1')
				{hideDiv('AgentStatusCalls');} //cn bug
			if (agentcallsstatus != '1')
				{hideDiv('AgentStatusSpan');} //cn bug
			if ( ( (auto_dial_level > 0) && (dial_method != "INBOUND_MAN") ) || (manual_dial_preview < 1) )
				{clearDiv('DiaLLeaDPrevieW');}
			if (alt_phone_dialing != 1)
				{clearDiv('DiaLDiaLAltPhonE');}
			if (volumecontrol_active != '1')
				{hideDiv('VolumeControlSpan');}
			if (DefaulTAlTDiaL == '1')
				{document.vicidial_form.DiaLAltPhonE.checked=true;}
			if (agent_status_view != '1')
				{document.getElementById("AgentViewLink").innerHTML = "";}
			if (dispo_check_all_pause == '1')
				{document.getElementById("DispoSelectStop").checked=true;}

			document.vicidial_form.LeadLookuP.checked=true;

			if ( (agent_pause_codes_active=='Y') || (agent_pause_codes_active=='FORCE') )
				{
				
				//Mod by fnatic start
				if(Pause_Code_Selected_Link_Display=='Y')
					{
				     document.getElementById("PauseCodeLinkSpan").innerHTML = "<a href=\"#\" onclick=\"changePauseCode();\">修改</a>";			   
				    }
				//Mod by fnatic end
				//Mod by yanson start
                if(agent_pause_codes_active=='FORCE' && Default_Pause_Code_Enable == 'Y'){
					PauseCodeSelect_submit(Default_Pause_Code);
					}
                //Mod by yanson end

				}
		  
			if (VICIDiaL_allow_closers < 1)
				{
				document.getElementById("LocalCloser").style.visibility = 'hidden';
				}
			document.getElementById("sessionIDspan").innerHTML = session_id;
			if ( (LIVE_campaign_recording == 'NEVER') || (LIVE_campaign_recording == 'ALLFORCE') )
				{
				document.getElementById("RecorDControl").innerHTML = "<IMG SRC=\"../agc/images/vdc_LB_startrecording_OFF.gif\" border=0 alt=\"启动录音\">";
				}
			if (INgroupCOUNT > 0)
				{
				if (VU_closer_default_blended == 1)
					{document.vicidial_form.CloserSelectBlended.checked=true}
				CloserSelectContent_create();
				showDiv('CloserSelectBox');
				var CloserSelecting = 1;
				CloserSelectContent_create();
				}
			else
				{
				hideDiv('CloserSelectBox');
				MainPanelToFront();
				var CloserSelecting = 0;
				if (dial_method == "INBOUND_MAN")
					{
					dial_method = "MANUAL";
					auto_dial_level=0;
					starting_dial_level=0;
					document.getElementById("DiaLControl").innerHTML = DiaLControl_manual_HTML;
					}
				}
			if (territoryCOUNT > 0)
				{
				showDiv('TerritorySelectBox');
				var TerritorySelecting = 1;
				TerritorySelectContent_create();
				}
			else
				{
				hideDiv('TerritorySelectBox');
				MainPanelToFront();
				var TerritorySelecting = 0;
				}
			
			if ( (VtigeRLogiNScripT == 'Y') && (VtigeREnableD > 0) )
				{//登陆后主窗口
					var d_h=$(document).outerHeight()-64;
				var d_w=$(document).outerWidth()-170;
			
				$("#ScriptPanel").css({"height":d_h+"px","width":d_w+"px"});
					document.getElementById("ScriptContents").innerHTML = "<iframe onload=\"SetCwinHeight(this)\"  src=\"" + VtigeRurl + "/index.php?module=Users&action=Authenticate&return_module=Users&return_action=Login&user_name=" + user + "&user_password=" + pass + "&login_theme=softed&login_language=zh_cn\" style=\"background-color:transparent;\" scrolling=\"auto\" frameborder=\"0\" allowtransparency=\"true\" id=\"popupFrame\"  name=\"popupFrame\"  target=\"popupFrame\"  width='"+d_w+"' height=\"" + d_h + "\" STYLE=\"z-index:17\"></iframe>";
					console.log($(document).outerHeight()+"-"+$(document).outerWidth())
			console.log("<iframe onload=\"SetCwinHeight(this)\"  src=\"http://172.17.1.90/ccms/CallCenter/index_vici.php?action=CrmSearch&iocheck=in&user="+user+"&campaign="+campaign+"&phone="+taskPhoneNumber+"\" style=\"background-color:transparent;\" scrolling=\"auto\" frameborder=\"0\" allowtransparency=\"true\" id=\"popupFrame\" name=\"popupFrame\" width='"+d_w+"' height=\"" + d_h + "\" STYLE=\"z-index:17\"></iframe>")

				}
			if ( (VtigeRLogiNScripT == 'NEW_WINDOW') && (VtigeREnableD > 0) )
				{
				var VtigeRall = VtigeRurl + "/index.php?module=Users&action=Authenticate&return_module=Users&return_action=Login&user_name=" + user + "&user_password=" + pass + "&login_theme=softed";
				
				VtigeRwin =window.open(VtigeRall, web_form_target,'toolbar=1,location=1,directories=1,status=1,menubar=1,scrollbars=1,resizable=1,width=700,height=480');

				VtigeRwin.blur();
				}
			if ( (crm_popup_login == 'Y') && (crm_login_address.length > 4) )
				{
				var regWFAcustom = new RegExp("^VAR","ig");
				URLDecode(crm_login_address,'YES');
				var TEMP_crm_login_address = decoded;
				TEMP_crm_login_address = TEMP_crm_login_address.replace(regWFAcustom, '');
				// + fnatic 
				//alert(crm_target);
				if(crm_target=='CCMS')
					{
						var d_h=$(document).outerHeight()-64;
						var d_w=$(document).outerWidth()-170;
					
						$("#ScriptPanel").css({"height":d_h+"px","width":d_w+"px"});
					document.getElementById("ScriptContents").innerHTML = "<iframe onload=\"SetCwinHeight(this)\"  src=\"" + TEMP_crm_login_address + "\" style=\"background-color:transparent;\"  frameborder=\"0\"  scrolling=\"yes\" allowtransparency=\"true\" id=\"popupFrame\" name=\"popupFrame\" width='"+d_w+"' height='"+d_h+"' STYLE=\"z-index:18\"></iframe>";	
					console.log($(document).outerHeight()+"-"+$(document).outerWidth())
			console.log("<iframe onload=\"SetCwinHeight(this)\"  src=\"http://172.17.1.90/ccms/CallCenter/index_vici.php?action=CrmSearch&iocheck=in&user="+user+"&campaign="+campaign+"&phone="+taskPhoneNumber+"\" style=\"background-color:transparent;\" scrolling=\"auto\" frameborder=\"0\" allowtransparency=\"true\" id=\"popupFrame\" name=\"popupFrame\" width='"+d_w+"' height=\"" + d_h + "\" STYLE=\"z-index:17\"></iframe>")
					}
				// end
				else if(crm_target=='_blank')
					{
					var CRMwin = 'CRMwin';
				
					CRMwin = window.open(TEMP_crm_login_address, CRMwin,'toolbar=1,location=1,directories=1,status=1,menubar=1,scrollbars=1,resizable=1,width=700,height=480');

					CRMwin.blur();
					}
				}
			if (INgroupCOUNT > 0)
				{
				HidEGenDerPulldown();
				}
			VICIDiaL_closer_login_checked = 1;
			document.getElementById("status_code").innerHTML="暂停";
			if(Pause_Code_Selected_Link_Display=='Y' && (agent_pause_codes_active=='FORCE' || agent_pause_codes_active=="Y")){
				document.getElementById("PauseCodeLinkSpan").style.display="";
			}

			}
		else
			{
			
			var WaitingForNextStep=0;
			if ( (CloserSelecting==1) || (TerritorySelecting==1) )	{WaitingForNextStep=1;}
			if (open_dispo_screen==1)
				{
				var Auto_Submit_Dispo = "N";
				
				wrapup_counter=0;
				if (wrapup_seconds > 0)	
					{
					showDiv('WrapupBox');
					document.getElementById("WrapupTimer").innerHTML = wrapup_seconds;
					wrapup_waiting=1;
					}
				CustomerData_update();
				document.getElementById("GENDERhideFORie").innerHTML = '';
				document.getElementById("GENDERhideFORieALT").innerHTML = '<select style="display:none" size=1 name=gender_list class="cust_form" id=gender_list><option value="U">U - 尚未定义</option><option value="M">M - Male</option><option value="F">F - Female</option></select>';
				//showDiv('DispoSelectBox');
				//alert("电话小结");
				DispoSelectBoxStatus = 1;
				
				if(Auto_Submit_Dispo == "N"){
					$('#DispoSelectBox').dialog('open');
					if(Dial_Next_Display=='Y'){
						document.getElementById("DispoDialNextContent").style.display = "";
					}
					//yanson@20100831 006 start
										//yanson@20100831 006 end
					//alert(last_uniqueid.length);
					if(last_uniqueid.length == 0)
					{
						DispoSelectContent_NA_create('','ReSET');
						status_type = 0;
					}		
					if(last_uniqueid.length > 0)
					{
						DispoSelectContent_create('','ReSET');
						status_type = 1;
					}	
				}else{
				
					if(last_uniqueid.length == 0)
					{
						status_type = 0;
					}		
					if(last_uniqueid.length > 0)
					{
						status_type = 1;
					}	
				}
				
				
				WaitingForNextStep=1;
				open_dispo_screen=0;
				LIVE_default_xfer_group = default_xfer_group;
				LIVE_campaign_recording = campaign_recording;
				LIVE_campaign_rec_filename = campaign_rec_filename;
				if (auto_dial_level == 0)
					{
					if (document.vicidial_form.DiaLAltPhonE.checked==true)
						{
						reselect_alt_dial = 1;
						
						//Mod by fnatic start
						if(Dial_Next_Display=='Y')
							{
						document.getElementById("DiaLControl").innerHTML = "<a href=\"#\" onclick=\"ManualDialNext('','','','','','0');\"><IMG SRC=\"../agc/images/cn/vdc_LB_dialnextnumber_cn.gif\" border=0 alt=\"拨下一个号码\"></a>";
							}
						else
							{
						document.getElementById("DiaLControl").innerHTML = "";						
							}
						//Mod by fnatic end

						document.getElementById("MainStatuSSpan").innerHTML = "Dial Next Call";
						}
					else
						{
						reselect_alt_dial = 0;
						}
					}
				//自动提交电话小结
				if(Auto_Submit_Dispo == "Y"){
					var Default_Call_Result = "";
					document.getElementById("DispoSelection").value = Default_Call_Result;
					DispoSelect_submit2();
				}
				}
			if (DispoSelectBoxStatus == 1 && auto_dispo_time > 0){
				auto_dispo_time_count = auto_dispo_time_count + 1;
				if(auto_dispo_time_count == auto_dispo_time){
					document.getElementById("DispoSelectStop").checked=true;
					change_pause_code(document.getElementById("DispoSelectStop"));
					DispoSelect_submit2();
				}
			}
			if (AgentDispoing==1)	
				{
				WaitingForNextStep=1;
				check_for_conf_calls(session_id, '0');
				}
			if (logout_stop_timeouts==1)	{WaitingForNextStep=1;}
			//Mod by fnatic custchannellive < -30 to -10 for CustomerChanneLGone()
			//Mod by fnatic custchannellive < -10 to -5 for ReChecKCustoMerChaN()
			//alert(custchannellive+"|"+lastcustchannel.length+"|"+no_empty_session_warnings);
			if ( (custchannellive < -15) && (lastcustchannel.length > 3) && (no_empty_session_warnings < 1) ) {CustomerChanneLGone();}
			//if ( (custchannellive < -30) && (lastcustchannel.length > 3) && (no_empty_session_warnings < 1) ) {CustomerChanneLGone();}
			if ( (custchannellive < -10) && (lastcustchannel.length > 3) ) {ReChecKCustoMerChaN();} 
			// inbound mode is not need this msg alert + fnatic
			if (inbound_mode!='ring')
				{
				if ( (nochannelinsession > 16) && (check_n > 15) && (no_empty_session_warnings < 1) ) {NoneInSession();}
				}			
			// end

			if (WaitingForNextStep==0)
				{
				// check for live channels in conference room and get current datetime
				//alert(2);
				check_for_conf_calls(session_id, '0');
				// refresh agent status view
				if (agent_status_view_active > 0)
					{
					refresh_agents_view('AgentViewStatus',agent_status_view); //cn bug
					}
				if (view_calls_in_queue_active > 0)
					{
					refresh_calls_in_queue(view_calls_in_queue);
					}
				if (xfer_select_agents_active > 0)
					{
					refresh_agents_view('AgentXferViewSelect',agent_status_view);
					}
				if (agentonly_callbacks == '1')
					{CB_count_check++;}

				if (AutoDialWaiting == 1)
					{
					check_for_auto_incoming();
					}
				if (AutoDialWaiting == 2)
					{
					check_for_grab_incoming();
					}
				if(CheckOutboundChannelLine2 == 1){
					check_for_grab_outcoming();
				}
				// look for a channel name for the manually dialed call
				if (MD_channel_look==1)
					{
					ManualDialCheckChanneL(XDcheck);
					}
				if ( (CB_count_check > 19) && (agentonly_callbacks == '1') )
					{
					CalLBacKsCounTCheck();
					CB_count_check=0;
					}
				if ( (even > 0) && (agent_display_dialable_leads > 0) )
					{
					DiaLableLeaDsCounT();
					}
				if (VD_live_customer_call==1)
					{
					VD_live_call_secondS++;
					document.vicidial_form.SecondS.value		= VD_live_call_secondS;
					document.getElementById("SecondSDISP").innerHTML = VD_live_call_secondS;
					}
				if (XD_live_customer_call==1)
					{
					XD_live_call_secondS++;
					//Mod by fnatic 
					//document.vicidial_form.xferlength.value		= XD_live_call_secondS;
					document.getElementById("xferlength").value		= XD_live_call_secondS;
					}
				if ( (update_fields > 0) && (update_fields_data.length > 2) )
					{
					UpdateFieldsData();
					}
				if ( (timer_action != 'NONE') && (timer_action.length > 3) && (timer_action_seconds <= VD_live_call_secondS) && (timer_action_seconds >= 0) )
					{
					TimerActionRun('','');
					}
				if (HKdispo_display > 0)
					{
					if ( (HKdispo_display == 3) && (HKfinish==1) )
						{
						HKfinish=0;
						DispoSelect_submit();
					//	AutoDialWaiting = 1;
					//	AutoDial_ReSume_PauSe("VDADready");
						}
					if (HKdispo_display == 1)
						{
						if (hot_keys_active==1)
							{showDiv('HotKeyEntriesBox');}
						hideDiv('HotKeyActionBox');
						}
					HKdispo_display--;
					}
				if (all_record == 'YES')
					{
					if (all_record_count < allcalls_delay)
						{all_record_count++;}
					else
						{
						conf_send_recording('MonitorConf',session_id ,'');
						all_record = 'NO';
						all_record_count=0;
						}
					}


				if (active_display==1)
					{
					check_s = check_n.toString();
						if ( (check_s.match(/00$/)) || (check_n<2) ) 
							{
						//	check_for_conf_calls();
							}
					}
				if (check_n<2) 
					{
					}
				else
					{
				//	check_for_live_calls();
					check_s = check_n.toString();
					}
				if (wrapup_seconds > 0)	
					{
					document.getElementById("WrapupTimer").innerHTML = (wrapup_seconds - wrapup_counter);
					wrapup_counter++;
					if ( (wrapup_counter > wrapup_seconds) && (document.getElementById("WrapupBox").style.visibility == 'visible') )
						{
						wrapup_waiting=0;
						hideDiv('WrapupBox');
						if (document.getElementById("DispoSelectStop").checked==true)
							{
							if (auto_dial_level != '0')
								{
								AutoDialWaiting = 0;
						//		alert('wrapup pause');
								AutoDial_ReSume_PauSe("VDADpause");
						//		document.getElementById("DiaLControl").innerHTML = DiaLControl_auto_HTML;
								}
							VICIDiaL_pause_calling = 1;
							if (dispo_check_all_pause != '1')
								{
								document.getElementById("DispoSelectStop").checked=false;
								alert("unchecking PAUSE");
								}
							}
						else
							{
							if (auto_dial_level != '0')
								{
								AutoDialWaiting = 1;
						//		alert('wrapup ready');
								AutoDial_ReSume_PauSe("VDADready","NEW_ID","WRAPUP");
						//		document.getElementById("DiaLControl").innerHTML = DiaLControl_auto_HTML_ready;
								}
							}
						}
					}
				if(document.images['livecall'].src == image_livecall_ON.src && AutoDialWaiting != 2){
					if(CheckOutboundChannelLine2 == 0){
						if(AutoDialWaiting != 2){
							agent_grab_line2();
						}
					}
				}
				}
				
			}
			
			if(agent_available_reset_check==1){
				agent_available_reset_count = agent_available_reset_count + 1;
					if(agent_available_reset_count >=acw_hold_time){
					agent_available_reset_check = 0;
					agent_available_reset_count = 0;
					var DiaLControl_html = document.getElementById("DiaLControl").innerHTML;
					if(DiaLControl_html.indexOf("vdc_LB_resume_OFF_cn.gif")>0){
						
					}else{
							if(pauseCodeSelectBoxStatus == 1){
								pauseCodeSelectBoxStatus = 0;
								PauseCodeSelect_submit_by_radio();
							}
						AutoDial_ReSume_PauSe('VDADready');
					}
				}
			}		
			
		}catch(err){}
		setTimeout("all_refresh()", refresh_interval);
		}
	function agent_grab_line2(){
		var xmlhttp=false;
		/*@cc_on @*/
		/*@if (@_jscript_version >= 5)
		// JScript gives us Conditional compilation, we can cope with old IE versions.
		// and security blocked creation of the objects.
		 try {
		  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		 } catch (e) {
		  try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  } catch (E) {
		   xmlhttp = false;
		  }
		 }
		@end @*/
		if (!xmlhttp && typeof XMLHttpRequest!='undefined')
			{
			xmlhttp = new XMLHttpRequest();
			}
		if (xmlhttp) 
			{ 
			RAview_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=agent_grab_line2&format=text&user=" + user + "&pass=" + pass + "&conf_exten=" + session_id + "&extension=" + extension + "&protocol=" + protocol + "&campaign=" + campaign + "&stage=100%";
			xmlhttp.open('POST', 'vdc_db_query.php'); 
			xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
			xmlhttp.send(RAview_query); 
			xmlhttp.onreadystatechange = function() 
				{ 
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
					{
					//alert(xmlhttp.responseText);
					if(AutoDialWaiting != 2){
							document.getElementById("line12").innerHTML = xmlhttp.responseText;
							if(xmlhttp.responseText !="" && alertline2 == 0)
							{
							alert("直线分机！");
							alertline2 = 1;
							}
							if(xmlhttp.responseText =="")
							{
							alertline2 = 0;
							}
					}
					
					xmlhttp = null;
					CollectGarbage();
					}
				}
			delete xmlhttp;
			}
	}
	function all_refresh()
		{
		epoch_sec++;
		check_n++;
		even++;
		if (even > 1)
			{even=0;}
		var year= t.getYear()
		var month= t.getMonth()
			month++;
		var daym= t.getDate()
		var hours = t.getHours();
		var min = t.getMinutes();
		var sec = t.getSeconds();
		var regMSdate = new RegExp("MS_","g");
		var regUSdate = new RegExp("US_","g");
		var regEUdate = new RegExp("EU_","g");
		var regALdate = new RegExp("AL_","g");
		var regAMPMdate = new RegExp("AMPM","g");
		if (year < 1000) {year+=1900}
		if (month< 10) {month= "0" + month}
		if (daym< 10) {daym= "0" + daym}
		if (hours < 10) {hours = "0" + hours;}
		if (min < 10) {min = "0" + min;}
		if (sec < 10) {sec = "0" + sec;}
		var Tyear = (year-2000);
		filedate = year + "" + month + "" + daym + "-" + hours + "" + min + "" + sec;
		tinydate = Tyear + "" + month + "" + daym + "" + hours + "" + min + "" + sec;
		SQLdate = year + "-" + month + "-" + daym + " " + hours + ":" + min + ":" + sec;

		var status_date = '';
		var status_time = hours + ":" + min + ":" + sec;
		if (vdc_header_date_format.match(regMSdate))
			{
			status_date = year + "-" + month + "-" + daym;
			}
		if (vdc_header_date_format.match(regUSdate))
			{
			status_date = month + "/" + daym + "/" + year;
			}
		if (vdc_header_date_format.match(regEUdate))
			{
			status_date = daym + "/" + month + "/" + year;
			}
		if (vdc_header_date_format.match(regALdate))
			{
			var statusmon='';
			if (month == 1) {statusmon = "一月";}
			if (month == 2) {statusmon = "二月";}
			if (month == 3) {statusmon = "三月";}
			if (month == 4) {statusmon = "四月";}
			if (month == 5) {statusmon = "五月";}
			if (month == 6) {statusmon = "六月";}
			if (month == 7) {statusmon = "七月";}
			if (month == 8) {statusmon = "八月";}
			if (month == 9) {statusmon = "九月";}
			if (month == 10) {statusmon = "十月";}
			if (month == 11) {statusmon = "十一月";}
			if (month == 12) {statusmon = "十二月";}

			status_date = statusmon + " " + daym;
			}
		if (vdc_header_date_format.match(regAMPMdate))
			{
			var AMPM = '上午';
			if (hours == 12) {AMPM = '下午';}
			if (hours == 0) {AMPM = '上午'; hours = '12';}
			if (hours > 12) {hours = (hours - 12);   AMPM = '下午';}
			status_time = hours + ":" + min + ":" + sec + " " + AMPM;
			}

		document.getElementById("status").innerHTML = status_date + " " + status_time  + display_message;
		if (VD_live_customer_call==1)
			{
			var customer_gmt = parseFloat(document.vicidial_form.gmt_offset_now.value);
			var AMPM = '上午';
			var customer_gmt_diff = (customer_gmt - local_gmt);
			var UnixTimec = (UnixTime + (3600 * customer_gmt_diff));
			var UnixTimeMSc = (UnixTimec * 1000);
			c.setTime(UnixTimeMSc);
			var Cyear= c.getYear()
			var Cmon= c.getMonth()
				Cmon++;
			var Cdaym= c.getDate()
			var Chours = c.getHours();
			var Cmin = c.getMinutes();
			var Csec = c.getSeconds();
			if (Cyear < 1000) {Cyear+=1900}
			if (Cmon < 10) {Cmon= "0" + Cmon}
			if (Cdaym < 10) {Cdaym= "0" + Cdaym}
			if (Chours < 10) {Chours = "0" + Chours;}
			if ( (Cmin < 10) && (Cmin.length < 2) ) {Cmin = "0" + Cmin;}
			if ( (Csec < 10) && (Csec.length < 2) ) {Csec = "0" + Csec;}
			if (Cmin < 10) {Cmin = "0" + Cmin;}
			if (Csec < 10) {Csec = "0" + Csec;}

		var customer_date = '';
		var customer_time = Chours + ":" + Cmin + ":" + Csec;
		if (vdc_customer_date_format.match(regMSdate))
			{
			customer_date = Cyear + "-" + Cmon + "-" + Cdaym;
			}
		if (vdc_customer_date_format.match(regUSdate))
			{
			customer_date = Cmon + "/" + Cdaym + "/" + Cyear;
			}
		if (vdc_customer_date_format.match(regEUdate))
			{
			customer_date = Cdaym + "/" + Cmon + "/" + Cyear;
			}
		if (vdc_customer_date_format.match(regALdate))
			{
			var customermon='';
			if (Cmon == 1) {customermon = "一月";}
			if (Cmon == 2) {customermon = "二月";}
			if (Cmon == 3) {customermon = "三月";}
			if (Cmon == 4) {customermon = "四月";}
			if (Cmon == 5) {customermon = "五月";}
			if (Cmon == 6) {customermon = "六月";}
			if (Cmon == 7) {customermon = "七月";}
			if (Cmon == 8) {customermon = "八月";}
			if (Cmon == 9) {customermon = "九月";}
			if (Cmon == 10) {customermon = "十月";}
			if (Cmon == 11) {customermon = "十一月";}
			if (Cmon == 12) {customermon = "十二月";}

			customer_date = customermon + " " + Cdaym + " ";
			}
		if (vdc_customer_date_format.match(regAMPMdate))
			{
			var AMPM = '上午';
			if (Chours == 12) {AMPM = '下午';}
			if (Chours == 0) {AMPM = '上午'; Chours = '12';}
			if (Chours > 12) {Chours = (Chours - 12);   AMPM = '下午';}
			customer_time = Chours + ":" + Cmin + ":" + Csec + " " + AMPM;
			}

			var customer_local_time = customer_date + " " + customer_time;
			document.vicidial_form.custdatetime.value		= customer_local_time;

			}
		start_all_refresh();
		}
	function pause()	// Pauses the refreshing of the lists
		{active_display=2;  display_message="  - 暂停启用显示 - ";}
	function start()	// resumes the refreshing of the lists
		{active_display=1;  display_message='';}
	function faster()	// lowers by 1000 milliseconds the time until the next refresh
		{
		 if (refresh_interval>1001)
			{refresh_interval=(refresh_interval - 1000);}
		}
	function slower()	// raises by 1000 milliseconds the time until the next refresh
		{
		refresh_interval=(refresh_interval + 1000);
		}

	// activeext-specific functions
	function activeext_force_refresh()	// forces immediate refresh of list content
		{getactiveext();}
	function activeext_order_asc()	// changes order of activeext list to ascending
		{
		activeext_order="asc";   getactiveext();
		desc_order_HTML ='<a href="#" onClick="activeext_order_desc();return false;">ORDER</a>';
		document.getElementById("activeext_order").innerHTML = desc_order_HTML;
		}
	function activeext_order_desc()	// changes order of activeext list to descending
		{
		activeext_order="desc";   getactiveext();
		asc_order_HTML ='<a href="#" onClick="activeext_order_asc();return false;">ORDER</a>';
		document.getElementById("activeext_order").innerHTML = asc_order_HTML;
		}

	// busytrunk-specific functions
	function busytrunk_force_refresh()	// forces immediate refresh of list content
		{getbusytrunk();}
	function busytrunk_order_asc()	// changes order of busytrunk list to ascending
		{
		busytrunk_order="asc";   getbusytrunk();
		desc_order_HTML ='<a href="#" onClick="busytrunk_order_desc();return false;">ORDER</a>';
		document.getElementById("busytrunk_order").innerHTML = desc_order_HTML;
		}
	function busytrunk_order_desc()	// changes order of busytrunk list to descending
		{
		busytrunk_order="desc";   getbusytrunk();
		asc_order_HTML ='<a href="#" onClick="busytrunk_order_asc();return false;">ORDER</a>';
		document.getElementById("busytrunk_order").innerHTML = asc_order_HTML;
		}
	function busytrunkhangup_force_refresh()	// forces immediate refresh of list content
		{busytrunkhangup();}

	// busyext-specific functions
	function busyext_force_refresh()	// forces immediate refresh of list content
		{getbusyext();}
	function busyext_order_asc()	// changes order of busyext list to ascending
		{
		busyext_order="asc";   getbusyext();
		desc_order_HTML ='<a href="#" onClick="busyext_order_desc();return false;">ORDER</a>';
		document.getElementById("busyext_order").innerHTML = desc_order_HTML;
		}
	function busyext_order_desc()	// changes order of busyext list to descending
		{
		busyext_order="desc";   getbusyext();
		asc_order_HTML ='<a href="#" onClick="busyext_order_asc();return false;">ORDER</a>';
		document.getElementById("busyext_order").innerHTML = asc_order_HTML;
		}
	function busylocalhangup_force_refresh()	// forces immediate refresh of list content
		{busylocalhangup();}


	// functions to hide and show different DIVs
	function showDiv(divvar) 
		{
			hideSelect();
		if (document.getElementById(divvar))
			{
			divref = document.getElementById(divvar).style;
			divref.visibility = 'visible';
			}
		}
	function hideDiv(divvar)
		{
			showSelect();
		if (document.getElementById(divvar))
			{
			divref = document.getElementById(divvar).style;
			divref.visibility = 'hidden';
			}
		}
	function clearDiv(divvar)
		{
		if (document.getElementById(divvar))
			{
			document.getElementById(divvar).innerHTML = '';
			if (divvar == 'DiaLLeaDPrevieW')
				{
				//Mod by fnatic start
				if(Lead_Preview_Display=='Y')
					{			    
				var buildDivHTML = "<font class=\"preview_text\"> <input type=checkbox name=LeadPreview size=1 value=\"0\"> 预览潜在客户<BR></font>";
				    }
				else
					{
				var buildDivHTML ="";
				    }
			    //Mod by fnatic end
				document.getElementById("DiaLLeaDPrevieWHide").innerHTML = buildDivHTML;
				}
			if (divvar == 'DiaLDiaLAltPhonE')
				{
				var buildDivHTML = "<font class=\"preview_text\"> <input type=checkbox name=DiaLAltPhonE size=1 value=\"0\"> 拨打其它电话<BR></font>";
				document.getElementById("DiaLDiaLAltPhonEHide").innerHTML = buildDivHTML;
				}
			if (DefaulTAlTDiaL == '1')
				{document.vicidial_form.DiaLAltPhonE.checked=true;}
			}
		}
	function buildDiv(divvar)
		{
		if (document.getElementById(divvar))
			{
			var buildDivHTML = "";
			if (divvar == 'DiaLLeaDPrevieW')
				{
				document.getElementById("DiaLLeaDPrevieWHide").innerHTML = '';
				//Mod by fnatic start
				if(Lead_Preview_Display=='Y')
					{				 
				var buildDivHTML = "<font class=\"preview_text\"> <input type=checkbox name=LeadPreview size=1 value=\"0\"> 预览潜在客户<BR></font>";
				    }
					else
					{
				var	buildDivHTML = "<input type=hidden name=LeadPreview size=1 value=\"0\">";
					}
				document.getElementById(divvar).innerHTML = buildDivHTML;
				if (reselect_preview_dial==1)
					{document.vicidial_form.LeadPreview.checked=true}
				}
			if (divvar == 'DiaLDiaLAltPhonE')
				{
				document.getElementById("DiaLDiaLAltPhonEHide").innerHTML = '';
				var buildDivHTML = "<font class=\"preview_text\"> <input type=checkbox name=DiaLAltPhonE size=1 value=\"0\"> 拨打其它电话<BR></font>";
				document.getElementById(divvar).innerHTML = buildDivHTML;
				if (reselect_alt_dial==1)
					{document.vicidial_form.DiaLAltPhonE.checked=true}
				if (DefaulTAlTDiaL == '1')
					{document.vicidial_form.DiaLAltPhonE.checked=true;}
				}
			}
		}

	function conf_channels_detail(divvar) 
		{
		if (divvar == 'SHOW')
			{
			conf_channels_xtra_display = 1;
			if(Conference_Channel_Display=='Y')
				{//Mod by fnatic
			   //  document.getElementById("busycallsdisplay").innerHTML = "<a href=\"#\"  onclick=\"conf_channels_detail('HIDE');\">隐藏通道信息</a>";
			   document.getElementById("busycallsdisplay").innerHTML = "<a href=\"#\"  onclick=\"conf_channels_detail('SHOW');\">显示通道信息</a>";
			    }

		   //Add by fnatic start
		   $('#MaiNfooterspanDIV').dialog
				({ 
			       draggable: false,
				   resizable:false ,
				   title:'显示通道信息',
				   width:950,
			       height:350,
			       modal: true
			    });
			$('#MaiNfooterspanDIV').dialog('open');
			//Add by fnatic end 
			LMAe[0]=''; LMAe[1]=''; LMAe[2]=''; LMAe[3]=''; LMAe[4]=''; LMAe[5]=''; 
			LMAcount=0;
			}
		else
			{
			conf_channels_xtra_display = 0;
			if(Conference_Channel_Display=='Y')
				{
			     document.getElementById("busycallsdisplay").innerHTML = "<a href=\"#\"  onclick=\"conf_channels_detail('SHOW');\">显示通道信息</a>";
			    }
			
			document.getElementById("outboundcallsspan").innerHTML = '';
			LMAe[0]=''; LMAe[1]=''; LMAe[2]=''; LMAe[3]=''; LMAe[4]=''; LMAe[5]=''; 
			LMAcount=0;
			}
		}

	function HotKeys(HKstate) 
		{
		if ( (HKstate == 'ON') && (HKbutton_allowed == 1) )
			{
			showDiv('HotKeyEntriesBox');
			hot_keys_active = 1;
			document.getElementById("hotkeysdisplay").innerHTML = "<a href=\"#\" onMouseOut=\"HotKeys('OFF')\"><IMG SRC=\"../agc/images/vdc_XB_hotkeysactive_cn.gif\" border=0 alt=\"启用快捷键\"></a>";
			}
		else
			{
			hideDiv('HotKeyEntriesBox');
			hot_keys_active = 0;
			document.getElementById("hotkeysdisplay").innerHTML = "<a href=\"#\" onMouseOver=\"HotKeys('ON')\"><IMG SRC=\"../agc/images/vdc_XB_hotkeysactive_OFF_cn.gif\" border=0 alt=\"关闭快捷键\"></a>";
			}
		}

	function ShoWTransferMain(showxfervar,showoffvar)
		{
		if (VU_vicidial_transfers == '1')
			{
			XferAgentSelectLink();

			if (showxfervar == 'ON')
				{
				var xfer_height = 310;
				if (alt_phone_dialing>0) {xfer_height = (xfer_height + 20);}
				if ( (auto_dial_level == 0) && (manual_dial_preview == 1) ) {xfer_height = (xfer_height + 20);}
				//Del by fnatic document.getElementById("TransferMain").style.top = xfer_height;
				HKbutton_allowed = 0;
				showDiv('TransferMain');
				//Add by fnatic start
				 $("#TransferMainDIV").dialog('open');
				//Add by fnatic end

				//Del by fnatic document.getElementById("XferControl").innerHTML = "<a href=\"#\" onclick=\"ShoWTransferMain('OFF','YES');\"><IMG SRC=\"../agc/images/vdc_LB_transferconf_cn.gif\" border=0 alt=\"转接 - 电话会议\"></a>";
				if (quick_transfer_button_enabled > 0)
					{document.getElementById("QuickXfer").innerHTML = "<IMG SRC=\"../agc/images/vdc_LB_quickxfer_OFF_cn.gif\" border=0 alt=\"快速传递\">";}
				showDiv('agentdirectlink');
				agent_check();
				}
			else
				{
				HKbutton_allowed = 1;
				hideDiv('TransferMain');
				//Add by fnatic start
				$("#TransferMainDIV").dialog("close");
				//Add by fnatic end
				//hideDiv('agentdirectlink');

				if (showoffvar == 'YES')
					{
					if (VU_vicidial_transfers == '1'){
						document.getElementById("XferControl").innerHTML = "<a href=\"#\" onclick=\"ShoWTransferMain('ON');\"><IMG SRC=\"../agc/images/cn/vdc_LB_transferconf_cn.gif\" border=0 alt=\"转接\"></a>";
					}
					if (quick_transfer_button == 'IN_GROUP')
						{
						document.getElementById("QuickXfer").innerHTML = "<a href=\"#\" onclick=\"mainxfer_send_redirect('XfeRLOCAL','" + lastcustchannel + "','" + lastcustserverip + "');return false;\"><IMG SRC=\"../agc/images/vdc_LB_quickxfer_cn.gif\" border=0 alt=\"快速传递\"></a>";
						}
					if ( (quick_transfer_button == 'PRESET_1') || (quick_transfer_button == 'PRESET_2') || (quick_transfer_button == 'PRESET_3') || (quick_transfer_button == 'PRESET_4') || (quick_transfer_button == 'PRESET_5') )
						{
						document.getElementById("QuickXfer").innerHTML = "<a href=\"#\" onclick=\"mainxfer_send_redirect('XfeRBLIND','" + lastcustchannel + "','" + lastcustserverip + "');return false;\"><IMG SRC=\"../agc/images/vdc_LB_quickxfer_cn.gif\" border=0 alt=\"快速传递\"></a>";
						}
					}
				}
			if (three_way_call_cid == 'AGENT_CHOOSE')
				{
				if ( (active_group_alias.length < 1) && (LIVE_default_group_alias.length > 1) && (LIVE_caller_id_number.length > 3) )
					{
					active_group_alias = LIVE_default_group_alias;
					cid_choice = LIVE_caller_id_number;
					}
				document.getElementById("XfeRDiaLGrouPSelecteD").innerHTML = "<font size=1 face=\"Arial,Helvetica\">技能组代名: " + active_group_alias + "</font>";
				document.getElementById("XfeRCID").innerHTML = "<a href=\"#\" onclick=\"GroupAliasSelectContent_create('1');\"><font size=1 face=\"Arial,Helvetica\">点及此处选择技能组代名</font></a>";
				}
			else
				{
				document.getElementById("XfeRCID").innerHTML = "";
				document.getElementById("XfeRDiaLGrouPSelecteD").innerHTML = "";
				}
			}
		else
			{
			if (showxfervar != 'OFF')
				{
				alert('您没有转接电话的权限');
				}
			}
		}

	function MainPanelToFront(resumevar)
		{
		document.getElementById("MainTable").style.backgroundColor="#FFFFFF";
		document.getElementById("MaiNfooter").style.backgroundColor="#FFFFFF";
		//hideDiv('ScriptPanel');
		hideDiv('ScriptRefresH');
		showDiv('MainPanel');
		ShoWGenDerPulldown();

		if (resumevar != 'NO')
			{
			if (alt_phone_dialing == 1)
				{buildDiv('DiaLDiaLAltPhonE');}
			else
				{clearDiv('DiaLDiaLAltPhonE');}
			if (auto_dial_level == 0)
				{
				if (auto_dial_alt_dial==1)
					{
					auto_dial_alt_dial=0;
					document.getElementById("DiaLControl").innerHTML = DiaLControl_auto_HTML_OFF;
					}
				else
					{
					document.getElementById("DiaLControl").innerHTML = DiaLControl_manual_HTML;
					if (manual_dial_preview == 1)
						{buildDiv('DiaLLeaDPrevieW');}
					}
				}
			else
				{
				if (dial_method == "INBOUND_MAN")
					{

					//Mod by fnatic start
					if(Dial_Next_Display=='Y')
						{
					document.getElementById("DiaLControl").innerHTML = "<IMG SRC=\"../agc/images/cn/vdc_LB_pause_OFF_cn.gif\" border=0 alt=\" 暂停 \"><a href=\"#\" onclick=\"AutoDial_ReSume_PauSe('VDADready');\"><IMG SRC=\"../agc/images/cn/vdc_LB_resume_cn.gif\" border=0 alt=\"恢复\"></a><a href=\"#\" onclick=\"ManualDialNext('','','','','','0');\"><IMG SRC=\"../agc/images/cn/vdc_LB_dialnextnumber_cn.gif\" border=0 alt=\"拨下一个号码\"></a>";
						}
					else
						{
						//alert(AutopauseControlCount);
						if(AutopauseControlCount>=1){
						AutopauseControlCount ++;
						if(AutopauseControlCount ==4){
						//alert(AutopauseControlCount);
						document.getElementById("DiaLControl").innerHTML = "<IMG SRC=\"../agc/images/vdc_LB_pause_OFF_cn.gif\" border=0 alt=\" 暂停 \"><a href=\"#\" onclick=\"AutoDial_ReSume_PauSe('VDADready');\"><IMG SRC=\"../agc/images/vdc_LB_resume_cn.gif\" border=0 alt=\"恢复\"></a>";					
						AutopauseControlCount = 0;
						}
						}
						if(AutopauseControlCount == 0){
						document.getElementById("DiaLControl").innerHTML = "<IMG SRC=\"../agc/images/vdc_LB_pause_OFF_cn.gif\" border=0 alt=\" 暂停 \"><a href=\"#\" onclick=\"AutoDial_ReSume_PauSe('VDADready');\"><IMG SRC=\"../agc/images/vdc_LB_resume_cn.gif\" border=0 alt=\"恢复\"></a>";					
					    }
					    }
					//Mod by fnatic end

					if (manual_dial_preview == 1)
						{buildDiv('DiaLLeaDPrevieW');}
					}
				else
					{
					document.getElementById("DiaLControl").innerHTML = DiaLControl_auto_HTML;
					clearDiv('DiaLLeaDPrevieW');
					}
				}
			}
		panel_bgcolor='red';
		//document.getElementById("MainStatuSSpan").style.background = panel_bgcolor;
		document.getElementById("MainStatuSSpan").style.Color = panel_bgcolor;
		}

	function ScriptPanelToFront()
		{
		showDiv('ScriptPanel');
		showDiv('ScriptRefresH');
		// + fnatic alert(1);
		//alert(1);
		//if ( (VtigeRLogiNScripT == 'N'))
		//{		
		//WebFormRefresH('','','1');
		//alert(1);
		//load_script_contents();
		//	}
		//End
		document.getElementById("MainTable").style.backgroundColor="#FFFFFF";
		document.getElementById("MaiNfooter").style.backgroundColor="#FFFFFF";
		panel_bgcolor='#FFFFFF';
		//document.getElementById("MainStatuSSpan").style.background = panel_bgcolor;
		document.getElementById("MainStatuSSpan").style.Color = panel_bgcolor;

		HidEGenDerPulldown();
		}

	function HidEGenDerPulldown()
		{
		var gIndex = 0;
		var genderIndex = document.getElementById("gender_list").selectedIndex;
		var genderValue =  document.getElementById('gender_list').options[genderIndex].value;
		if (genderValue == 'M') {var gIndex = 1;}
		if (genderValue == 'F') {var gIndex = 2;}
		document.getElementById("GENDERhideFORieALT").innerHTML = '<select style="display:none" size=1 name=gender_list class="cust_form" id=gender_list><option value="U">U - 尚未定义</option><option value="M">M - Male</option><option value="F">F - Female</option></select>';
		document.getElementById("GENDERhideFORie").innerHTML = '';
		document.getElementById("gender_list").selectedIndex = gIndex;
		}

	function ShoWGenDerPulldown()
		{
		var gIndex = 0;
		var genderIndex = document.getElementById("gender_list").selectedIndex;
		var genderValue =  document.getElementById('gender_list').options[genderIndex].value;
		if (genderValue == 'M') {var gIndex = 1;}
		if (genderValue == 'F') {var gIndex = 2;}
		document.getElementById("GENDERhideFORie").innerHTML = '<select style="display:none" size=1 name=gender_list class="cust_form" id=gender_list><option value="U">U - 尚未定义</option><option value="M">M - Male</option><option value="F">F - Female</option></select>';
		document.getElementById("GENDERhideFORieALT").innerHTML = '';
		document.getElementById("gender_list").selectedIndex = gIndex;
		}

    function SetCwinHeight(iframeObj)
		{ 
         if (document.getElementById)
		   { 
            if (iframeObj && !window.opera)
		       {
                try
                {
				 if (iframeObj.contentDocument && iframeObj.contentDocument.body.offsetHeight)
				     { 
					   iframeObj.height = iframeObj.contentDocument.body.offsetHeight; 
                      // iframeObj.width = iframeObj.contentDocument.body.offsetWidth;
                     }
			     else if(document.frames[iframeObj.name].document && document.frames[iframeObj.name].document.body.scrollHeight)
				    { 
                      iframeObj.height = document.frames[iframeObj.name].document.body.scrollHeight+30+'px'; 
                      //iframeObj.width = document.frames[iframeObj.name].document.body.scrollWidth;
                    } 	
                }
                catch (err)
                {
					//alert(err);
					iframeObj.height = "680px";
					//alert(err);
                }


             } 
         } 
     } 


   /* this function used to agent client phone ring or hangup  + fnatic
		@param client_phone_ring string - cilent phone ring command
		@param client_phone_hangup string - cilent phone hangup command
	    @param client_phone_request_dial string - client phone request outbound call
   */
	function client_phone_manager(taskvar)
		{
		var xmlhttp=false;
		var SIP_user_DiaL="";
		var return_value="";

		if(taskvar=='client_phone_ring' || taskvar=='client_phone_request_dial')
			{ 
			SIP_user_DiaL= 'SIP/66669';
			}

		/*@cc_on @*/
		/*@if (@_jscript_version >= 5)
		// JScript gives us Conditional compilation, we can cope with old IE versions.
		// and security blocked creation of the objects.
		 try {
			 xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
			 } catch (e) {
		try {
			 xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (E) {
			xmlhttp = false;
			}
			}
		@end @*/
		if (!xmlhttp && typeof XMLHttpRequest!='undefined')
			{
			xmlhttp = new XMLHttpRequest();
			}
					
		if (xmlhttp) 
			{ 
			manager_request_parameter = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=" + taskvar + "&format=text&conf_exten=" + session_id + "&protocol=" + protocol  + "&extension=" + extension + "&SIP_user_DiaL=" + SIP_user_DiaL + "&ext_context=" + ext_context + "&campaign_cid=" + campaign_cid ;
		//	alert(manager_request_parameter);
			xmlhttp.open('POST', 'client_phone_manger.php'); 
			xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
			xmlhttp.send(manager_request_parameter); 
			xmlhttp.onreadystatechange = function() 
				{ 
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
					{
					//alert(xmlhttp.responseText);
					return_value=xmlhttp.responseText;
					
					if (taskvar=='client_phone_ring' && return_value.length>4)
						{
						client_phone_channel_check_enable=1;
						}
					else if (taskvar=='client_phone_sip_channel_checked')
						{
						if (return_value.length>2)
							{
							client_phone_channel_check_count=1;
							}
						else	
							{
							client_phone_channel_check_count--;
							}
							
						}
					else if(taskvar=='client_phone_hangup' && return_value.length>2)
						{ 
						livehangup_send_hangup(return_value); 
						} 
					//调用livehangup_send_hangup函数挂断坐席分机
					else if(taskvar=='client_phone_request_dial' && return_value.length >= 8)
						{
						 return_value=return_value.replace(/(^\s*)|(\s*$)/g,"");
					//	 alert(return_value);	
					     document.getElementById("MDPhonENumbeR").value=return_value;
						 grab_client_phone_command = 1;
						 //alert("检查到话盒插入到ccms_live_phone表的外拨号码就调用NeWManuaLDiaLCalLSubmiT外拨！");
						 NeWManuaLDiaLCalLSubmiT('NOW');
						 client_phone_channel_check_enable = 1;
						 return false;
						}
						xmlhttp = null;
						CollectGarbage();
					}
				}
			delete xmlhttp;
			}
	  }
    //End
	</script>





<style type="text/css">
<!--
	body{margin:0px 0px;overflow-x:hidden;font-size:12px;}
	div.scroll_list {height: 400px; width: 140px; overflow: scroll;}
	div.scroll_script {height: 301px; width: 760px; background:#FFCC99; overflow: scroll; font-size: 12px;  font-family:"宋体";}
	div.text_input {overflow: auto; font-size: 10px;  font-family:"宋体";}
   .body_text {font-size: 12px;  font-family:"宋体";}
   .queue_text_red {font-size: 12px;  font-family:"宋体"; font-weight: bold;color:red;}
   .queue_text {font-size: 12px;  font-family:"宋体"; color: black}
   .preview_text {font-size: 12px;  font-family:"宋体"; background: #F46E0B;font-weight:bold}
   .preview_text_red {font-size: 12px;  font-family:"宋体"; background: #FFCCCC}
   .banner_text {font-size:12px; font-family:"宋体"; color:#FFFFFF; font-weight:bold}
   .body_small {font-size: 12px;  font-family:"宋体";}
   .body_tiny {font-size: 12px;  font-family:"宋体";}
   .log_text {font-size: 12px;  font-family:"宋体";}
   .log_text_red {font-size: 12px;  font-family:"宋体"; font-weight: bold; background: #FF3333}
   .log_title {font-size: 12px;  font-family:"宋体"; font-weight: bold;}
   .sd_text {font-size: 12px;  font-family:"宋体"; font-weight: bold;}
   .sh_text {font-size: 12px;  font-family:"宋体"; font-weight: bold;}
   .sb_text {font-size: 12px;  font-family:"宋体";}
   .sk_text {font-size: 12px;  font-family:"宋体";}
   .skb_text {font-size: 12px;  font-family:"宋体"; font-weight: bold;}
   .ON_conf {font-size: 12px;  font-family:"宋体";background: #FFFF99}
   .OFF_conf {font-size: 12px;  font-family:"宋体";background: #FFCC77}
   .cust_form {font-family:"宋体"; font-size: 10px; overflow: hidden}
   .cust_form_text {font-family:"宋体"; font-size:12px; overflow: auto}
    a {font-family:"宋体";font-size:12px;color:#FF9900;}
	/*Add css by fnatic*/
   .pausecode_tb tr{height:22px;line-height:22px;}
   a.pausedcode{color:#FF9900;font-weight:bold;} 
   #hidden_show_control{float:left;}
   #button_pannel{ float:left;width:170px; margin-top:0px;}
   #pannel_img{ cursor:pointer;}
   div.button_link{text-align:left;margin:5px 0px 0px 0px;}
   div.button_link span{margin:0px 0px;}
   div.button_link a{font-size:12px;font-weight:blod;display:block;width:auto;height:18px;padding-top:2px;padding-left:5px;margin:0px 0px;}
   div.button_link a:hover,div.button_link a:active{background-color:#FF6600;color:#FFFFFF;}
   div.volume_button{ text-align:left; margin-left:3px;}
   #MainTable td {vertical-align:middle; text-align:left;}
   .queuediv{ float:left;font-weight:bold;}
   #MainStatuSSpan{font-weight:bold;color:red;margin-left:15px;}
   .banner_text_2 { width:745px!important; /*ff*/ *width:755px;/*ie6 7 8*/ }
   #MaiNfooterspan{top:486px !important;/*ff*/ *top:466px;/*ie6 7 8*/}
   table.transfer_table{font-size:12px;width:95%;}
   table.transfer_table tr{line-height:20px;height:20px;}
   table.transfer_table td{text-align:left;vertical-align:bottom;padding:5px 5px;} 
   table.transfer_table td.title{text-align:left;padding-left:5px;font-weight:bold; }
   table.transfer_table td a {font-family: Arial, Helvetica, sans-serif;font-size:12px;color:#FF9900;}
   #SendDTMFdiv{margin-bottom:5px;}
   .agent_info_table {font-size:12px;font-family:"宋体";padding:0px 0px;margin:0px 0px;}
   .agent_info_table tr{height:18px;}
   .agent_info_table td.head{text-align:left;width:30%;}
   #XfeRGrouP{width:200px;vertical-align:text-bottom;}
   .callbacklist th{font-size:12px;font-family:"宋体";font-weight:normal;}
   .PauseCode-dialog .ui-dialog-titlebar-close{display: none;}
   #ScriptContents{border:#eee 3px solid;}
   .dispo_content_hover{
	    background:#FDF39D; 
		margin-top:8px; 		
		border-top:1px #DFC904 solid;
		border-right:none;
		border-left:none;
		border-bottom:1px #DFC904 solid;
		color:#ff0000;
		font-size:12px;
		}
   .dispo_content_normal{margin-top:10px;font-size:12px;}
   .med_text_link{font-size:14px;color:#676767;}
   .med_text_link:hover,.med_text_link:active{color:#ff0000;}
   /*End*/
-->
</style>
	<style>
	#demo-frame > div.demo { padding: 10px !important; };
	</style>
	<script>
	var Volume_max = 9;
	var Volume_min = 1;
	var Volume_original = 5;
	var Volume_spec_channel;
	var Volume_status_array = Array();
	function volume_display_value(value11){
		$( "#slider-vertical" ).slider({
			orientation: "vertical",
			range: "min",
			min: Volume_min,
			max: Volume_max,
			value: value11,
			slide: function( event, ui ) {}
		});
	}
	
	function volume_display_control(action,channel,station,myQueryCID){
		if(!Volume_data_array[channel]){
			Volume_data_array[channel] = Volume_original;
		}
		if(action == 'UP'){
			Volume_data_array[channel] = Volume_data_array[channel]+1;
		}
		else if(action == 'DOWN'){
			Volume_data_array[channel] = Volume_data_array[channel]-1;
		}
		else if(action == 'NONE'){
		
		}
		else if(action == 'MUTING' || action == 'UNMUTE'){
			if(station == "start"){
				Volume_status_array[channel] = action == 'MUTING'?20:21;
				try{volume_status_control(channel,Volume_status_array[channel],myQueryCID);}
				catch(e){}
			}
		}
		
		if(Volume_data_array[channel] > Volume_max){Volume_data_array[channel] = Volume_max;}
		if(Volume_data_array[channel] < Volume_min){Volume_data_array[channel] = Volume_min;}
		
		volume_display_value(Volume_data_array[channel]);
	}
	
	function refresh_Volume_hidden_data(Volume_channel_array){
		var Volume_data_array_2 = Array();
		var Volume_status_array_2 = Array();
		for(i=0;i<Volume_channel_array.length;i++){
			//音量数组
			if(!Volume_data_array[Volume_channel_array[i]]){
				Volume_data_array[Volume_channel_array[i]] = Volume_original;
			}
			Volume_data_array_2[Volume_channel_array[i]] = Volume_data_array[Volume_channel_array[i]];
			
			//声音状态数组
			if(!(Volume_status_array[Volume_channel_array[i]] == 0 || Volume_status_array[Volume_channel_array[i]] == 1 || Volume_status_array[Volume_channel_array[i]] == 20 || Volume_status_array[Volume_channel_array[i]] == 21)){
				Volume_status_array[Volume_channel_array[i]] = 1;
			}
			Volume_status_array_2[Volume_channel_array[i]] = Volume_status_array[Volume_channel_array[i]];
			try{volume_status_control(Volume_channel_array[i],Volume_status_array[Volume_channel_array[i]],'');}
			catch(e){}
		}
		
		Volume_data_array_2[Volume_spec_channel] = Volume_data_array[Volume_spec_channel];
		Volume_data_array = Volume_data_array_2;
		
		Volume_status_array = Volume_status_array_2;
	}
	
	function volume_status_control(channel,myValue,myQueryCID){
		var new_channel = tool_1(channel);
		if(myValue == 0){
			try{
				document.getElementById("volume_status_"+new_channel+"_a").innerHTML = "静音";
				document.getElementById("volume_status_"+new_channel).onclick = function(){volume_control('UNMUTE',channel,'');return false;};
				document.getElementById("volume_status_"+new_channel).src = "../agc/images/vdc_volume_UNMUTE_cn.gif";
			}
			catch(e){}
		}
		else if(myValue == 1){
			try{
				document.getElementById("volume_status_"+new_channel+"_a").innerHTML = "正常";
				document.getElementById("volume_status_"+new_channel).onclick = function(){volume_control('MUTING',channel,'');return false;};
				document.getElementById("volume_status_"+new_channel).src = "../agc/images/vdc_volume_MUTE_cn.gif";
			}
			catch(e){}
		}
		else if(myValue == 20||myValue == 21){
			try{
				document.getElementById("volume_status_"+new_channel).onclick = function(){};
				document.getElementById("volume_status_"+new_channel+"_img").src = "../agc/images/loading.gif";
				document.getElementById("volume_status_"+new_channel+"_img").style.display = "";
			}
			catch(e){}
			volume_status_check(channel,myQueryCID);
		}
	}
	function tool_1(myValue){
		var returnValue = myValue;
		returnValue = returnValue.replace("/","_");
		returnValue = returnValue.replace(",","_");
		returnValue = returnValue.replace("@","_");
		return returnValue;
	}
	
	var count_try_times_array = Array();
	function volume_status_check(channel,myQueryCID){
		if((Volume_status_array[channel] == 20||Volume_status_array[channel] == 21) && myQueryCID != ""){
			var new_channel = tool_1(channel);
			var xmlhttp=false;
			var msg = null;
			try {
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
			} catch (e) {
				try {
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e) {
				   xmlhttp = false;
				}
			}
			if (!xmlhttp && typeof XMLHttpRequest!='undefined'){
				xmlhttp = new XMLHttpRequest();
			}
			if (xmlhttp){
				var queryString =  "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ACTION=VolumeStatusCheck&campaign=" + campaign + "&queryCID=" + myQueryCID;
				xmlhttp.open('POST', 'manager_send.php'); 
				xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
				xmlhttp.send(queryString); 
				xmlhttp.onreadystatechange = function(){ 
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
						var return_str;
						return_str = xmlhttp.responseText;
						if(return_str == 'NEW' || return_str == 'QUEUE'){//请求正在执行
							setTimeout("volume_status_check('"+channel+"','"+myQueryCID+"')", 1000);
						}
						else if(return_str == 'SENT' || return_str == 'UPDATED'){//请求执行成功
							Volume_status_array[channel] = Volume_status_array[channel]==20?0:1;
							document.getElementById("volume_status_"+new_channel+"_img").src = "../agc/images/right.png";
						}
						else if(return_str == 'DEAD' ){//请求失败
							msg = "请求失败，建议再次尝试";
						}
						else{//尝试查找记录
							if(!count_try_times_array[channel]){count_try_times_array[channel] = 1;}
							else{count_try_times_array[channel] = count_try_times_array[channel]+1;}
							
							if(count_try_times_array[channel] >10){
								msg = return_str;
								count_try_times_array[channel] = null;
							}
							else{setTimeout("volume_status_check('"+channel+"','"+myQueryCID+"')", 1000);}
						}
					}
				}
			}
			if(msg){//请求出现异常
				document.getElementById("volume_status_"+new_channel+"_msg").innerHTML = msg;
				Volume_status_array[channel] = Volume_status_array[channel]==20?1:0;
			}
			if(Volume_status_array[channel]==0||Volume_status_array[channel]==1){try{volume_status_control(channel,Volume_status_array[channel],'');}catch(e){}}
		}
		
	}
	</script>

</head>
<BODY onbeforeunload="return '真的要关闭CCMS？'" onLoad="begin_all_refresh();"  onunload="BrowserCloseLogout();">
<div id='divtest' style='position: absolute;display:none; z-index: 9999;width:200px;height:20px;'><div class="demo"><div id="slider-vertical" style="height:100px;"></div></div></div>
<FORM name=vicidial_form>
<input type=HIDDEN NAME=vtiger_activity_id ID=vtiger_activity_id value="">
<span style="width:100%;position:absolute;left:0px;top:0px;z-index:2; " id="Header">
<TABLE width="100%" BORDER=0 CELLPADDING=0 CELLSPACING=0 BGCOLOR=white height="30px" MARGINWIDTH=0 MARGINHEIGHT=0 LEFTMARGIN=0 TOPMARGIN=0 VALIGN=TOP ALIGN=LEFT>
  <TR VALIGN=TOP ALIGN=LEFT>

   <TD width="80px" COLSPAN=2 VALIGN=TOP ALIGN=LEFT  style="background:url(../agc/images/logo_r1_c3.jpg); background-repeat:repeat-x" >
     <img src="../agc/images/logo_r1_c1.jpg" align="middle" />
     <INPUT TYPE=HIDDEN NAME=extension>
   </TD>

  <TD style="background:url(../agc/images/logo_r1_c3.jpg); background-repeat:repeat-x;width:1%">&nbsp;</TD>

  <TD class="banner_text_2" COLSPAN=4  VALIGN=TOP ALIGN=RIGHT style="background:url(../agc/images/logo_r1_c3.jpg); background-repeat:repeat-x;text-algin:left;">
    <b><span style="color:#FFFFFF; font-size:12px; font-family:Arial, Helvetica, sans-serif;" id="status">LIVE</span></b>&nbsp;
     <font class="banner_text">
       <span id="SecondSspan">
	    <font class="body_text">通话时长(秒): 
        <span id="SecondSDISP"></span>
      </span>
      <!--客户时间: <input type=text size=20 name=custdatetime class="cust_form" value=""> &nbsp;
      通道: <input type=text size=20 name=callchannel class="cust_form" value="">&nbsp; &nbsp;-->
      <input type="hidden" name="custdatetime"  value="">
      <input type="hidden" name="callchannel"  value="">
            	  <a href="../admin.php" target="_blank">CCMS Admin</a>&nbsp;&nbsp;	  <a href="#" onClick="changepassword();return false;">修改密码</a>&nbsp;&nbsp;
      <a href="#" onclick="NormalLogout();return false;">注销</a>
<img src="../agc/images/logo_r1_c5.jpg" align="middle" />
    </font>
  </TD>

 </TR>
</TABLE>
</SPAN>
<div style="display:none" id="dialog-password" title="修改密码">
	<table>
<tr><td><label for="name">旧密码:</label></td><td><input type="password" name="old_password" id="old_password" value="" class="text ui-widget-content ui-corner-all"/></td></tr>
<tr><td><label for="email">新密码:</label></td><td><input type="password" name="new_password1" id="new_password1" value="" class="text ui-widget-content ui-corner-all"/></td></tr>
<tr><td><label for="password">确认新密码:</label></td><td><input type="password" name="new_password2" id="new_password2" value="" class="text ui-widget-content ui-corner-all"/></td></tr>
<tr><td colspan="2"  align="center"><button onClick="change_pass();">确认</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button onClick="closedialog();">取消</button></td></tr>
</table>
</div>
<span style="position:absolute;left:0px;top:13px;z-index:1;" id="Tabs">
   <!-- <table border=0 bgcolor="#FFFFFF" width= height=30>
<TR VALIGN=TOP ALIGN=LEFT>
<TD ALIGN=LEFT WIDTH=115><A HREF="#" onClick="MainPanelToFront('NO');"><IMG SRC="../agc/images/customer_info_cn.gif" ALT="CCMS" WIDTH=143 HEIGHT=27 BORDER=0></A></TD>
<TD ALIGN=LEFT WIDTH=105><A HREF="#" onClick="ScriptPanelToFront();"><IMG SRC="../agc/images/script_tab_cn.jpg" ALT="SCRIPT" WIDTH=143 HEIGHT=27 BORDER=0></A></TD>
<TD WIDTH= VALIGN=MIDDLE ALIGN=CENTER><font class="body_text">&nbsp;</TD>
<TD WIDTH=109></TD>
</TR></TABLE>-->
</span>

<span style="position:absolute;left:0px;top:0px;z-index:3;" id="WelcomeBoxA">
    <!--<table border=0 bgcolor="#FFFFFF" width=100% height=660><TR><TD align=center><BR><span id="WelcomeBoxAt">Agent Screen</span></TD></TR>-->

    <table border=0 bgcolor="#FFFFFF" width=100% ><TR><TD align=center><BR><span id="WelcomeBoxAt">Agent Screen</span></TD></TR></TABLE>
</span>

<!--<span style="position:absolute;left:300px;top:px;z-index:12;" id="ManuaLDiaLButtons"><font class="body_text">
<span id="MDstatusSpan"><a href="#" onClick="NeWManuaLDiaLCalL('NO');return false;">人工拨号</a></span> &nbsp; &nbsp; &nbsp; <a href="#" onClick="NeWManuaLDiaLCalL('FAST');return false;">快速拨号</a><BR>
</font></span>-->

<!--<span style="position:absolute;left:300px;top:px;z-index:13;" id="CallbacksButtons"><font class="body_text">
<span id="CBstatusSpan">X 生效的回拨电话</span> <BR>
</font></span>-->

<!--<span style="position:absolute;left:430px;top:px;z-index:14;" id="PauseCodeButtons"><font class="body_text">
<span id="PauseCodeLinkSpan"></span> <BR>
</font></span>

<span style="position:absolute;left:px;top:49px;z-index:18;" id="SecondSspan"><font class="body_text"> 秒: 
<span id="SecondSDISP"> &nbsp; &nbsp; </span>
</font></span>-->

<span style="position:absolute;left:910px;top:400px;z-index:22;" id="AgentMuteANDPreseTDiaL"><font class="body_text">
	<BR>
<BR><BR> &nbsp; <BR>
</font></span>


<div id="CallBacKsLisTBoxDIV">
<span id="CallBacKsLisTBox">
    <table border="0" cellspacing="0" cellpadding="0" width="100%">
	<TR><TD align="center" valign="top">
	<!--话务员的回拨电话 :<BR>点选以下回拨记录进行客户回拨，如果点选记录进行拨号，本次记录将会从名单内移除.-->
	<!--<BR>-->
	<div id="CallBacKsLisT"></div>
	<!--<BR> &nbsp; 
	<a href="#" onClick="CalLBacKsLisTCheck();return false;">刷新</a>-->
	 &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; 
	<!--<a href="#" onClick="hideDiv('CallBacKsLisTBox');return false;">回上一页</a>-->
	</TD></TR></TABLE>
</span>
</div>

<div id="shownotice">
<div id="noticeContent">
</div>
</div>


<!--<span style="position:absolute;left:0px;top:0px;z-index:52;" id="NeWManuaLDiaLBox">
    <table border=1 bgcolor="#F4F4F4" width=100% height=540><TR><TD align=center VALIGN=top><!-- 新的人工拨号纪录给 :<BR><BR>请输入下面的信息给您想要外拨的新记录.
	<BR>
		<!--Note: all new manual dial leads will go into list <BR><BR>
	<table><tr>
	<td align=right><font class="body_text"></td>
	<td align=left><font class="body_text"><input type=hidden size=7 maxlength=10 name=MDDiaLCodE class="cust_form" value="1"><!--&nbsp; (This is usually a 1 in the USA-Canada)</td>
	</tr><tr>
	<td align=right><font class="body_text"> 电话号码: </td>
	<td align=left><font class="body_text">
	<input type=text size=14 maxlength=12 name=MDPhonENumbeR class="cust_form" value=""><!--&nbsp; (12 digits max - digits only)
	</td>
	</tr><tr>
	<td align=right><font class="body_text"></td>
	<td align=left><font class="body_text"><div style="display:none"><input type=checkbox name=LeadLookuP size=1 value="0"></div><!--&nbsp; (本选项勾选时，在增加新的纪录时会寻找系统中的电话号码)</td>
	</tr><tr>

	<td align=left colspan=2>
	<CENTER>
	<span id="ManuaLDiaLGrouPSelecteD"></span> &nbsp; &nbsp; <span id="ManuaLDiaLGrouP"></span>
	</CENTER>
	<!--<BR><BR>If you want to dial a number and have it NOT be added as a new lead, enter in the exact dialstring that you want to call in the 覆盖拨号 field below. To hangup this call you will have to open the 拨号S IN THIS SESSION link at the bottom of the screen and hang it up by clicking on its channel link there.<BR> &nbsp;</td>
	</tr><tr>
	<td align=right><font class="body_text"></td>
	<td align=left><font class="body_text"><input type=hidden size=24 maxlength=20 name=MDDiaLOverridE class="cust_form" value=""><!--&nbsp; (限数字码输入)
	</td>
	</tr></table>
	<BR>
	<a href="#" onClick="NeWManuaLDiaLCalLSubmiT('NOW');return false;">立即拨号</a>
	 &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; 
	<!--<a href="#" onClick="NeWManuaLDiaLCalLSubmiT('PREVIEW');return false;">预览电话</a>
	 &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; 
	<a href="#" onClick="hideDiv('NeWManuaLDiaLBox');return false;">回上一页</a>
	</TD></TR></TABLE>
</span>-->

<script>
function clickPhone(phonenumber){
    var MDPhonENumbeR = document.getElementById("MDPhonENumbeR").value;
    var MDPhonENumbeR = MDPhonENumbeR+phonenumber;
    document.getElementById("MDPhonENumbeR").value = MDPhonENumbeR;
    document.getElementById("MDPhonENumbeRs").focus();
}
</script>

<!--Add by fnatic start-->
<div id="ManualDialDIV">
<span id="NeWManuaLDiaLBox">
   <input type="hidden" size="7" maxlength="10" name="MDDiaLCodE" id="MDDiaLCodE" class="cust_form" value="">
   <!--搜索现有潜在客户-->
   <input type="hidden" size="14" maxlength="20" name="MDDiaLOverridE" id="MDDiaLOverridE" class="cust_form" value="">
   <span id="ManuaLDiaLGrouPSelecteD"></span><span id="ManuaLDiaLGrouP"></span>
 <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
	   <td height="37"><input type='checkbox' name='manudial_dial_type' id='manudial_dial_type' title='勾选打内线' /> 呼叫<!-- + fnatic 20110627 -->
	       <input type='text' size="15" maxlength="20" name="MDPhonENumbeR" id="MDPhonENumbeR" value="" >
		   <input type='button' onClick="NeWManuaLDiaLCalLSubmiT('NOW');return false;" value="拨号" />
        <table border="1">
</table>
<tr>
    <td height="37"><div align="center">
      <input type="button" name="1" id="1" value="1" onclick="clickPhone(this.value)" style="width:50px;height:30px;"/>&nbsp;
      <input type="button" name="2" id="2" value="2" onclick="clickPhone(this.value)" style="width:50px;height:30px;"/>&nbsp;
      <input type="button" name="3" id="3" value="3" onclick="clickPhone(this.value)" style="width:50px;height:30px;"/>&nbsp;
    </div></td>
  </tr>
  <tr>
    <td height="37"><div align="center">
      <input type="button" name="4" id="4" value="4" onclick="clickPhone(this.value)" style="width:50px;height:30px;"/>&nbsp;
      <input type="button" name="5" id="5" value="5" onclick="clickPhone(this.value)" style="width:50px;height:30px;"/>&nbsp;
      <input type="button" name="6" id="6" value="6" onclick="clickPhone(this.value)" style="width:50px;height:30px;"/>&nbsp;
    </div></td>
  </tr>
  <tr>
    <td height="37"><div align="center">
      <input type="button" name="7" id="7" value="7" onclick="clickPhone(this.value)" style="width:50px;height:30px;"/>&nbsp;
      <input type="button" name="8" id="8" value="8" onclick="clickPhone(this.value)" style="width:50px;height:30px;"/>&nbsp;
      <input type="button" name="9" id="9" value="9" onclick="clickPhone(this.value)" style="width:50px;height:30px;"/>&nbsp;
    </div></td>
  </tr>
  <tr>
    <td height="37"><div align="center">
      <input type="button" name="*" id="*" value="*" onclick="clickPhone(this.value)" style="width:50px;height:30px;"/>&nbsp;
      <input type="button" name="0" id="0" value="0" onclick="clickPhone(this.value)" style="width:50px;height:30px;"/>&nbsp;
      <input type="button" name="#" id="#" value="#" onclick="clickPhone(this.value)" style="width:50px;height:30px;"/>&nbsp;
    </div></td>
    </tr>   
		</td>
	</tr>	       
	<tr>
		<td id="LeadLookuP_area">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" name="LeadLookuP" id="LeadLookuP" size="1" value="0">搜索现有潜在客户
		</td>
	</tr>
 </table>
 </span>
</div>
<!--Add by fnatic end-->

<span style="position:absolute;left:35px;top:440px;z-index:20;" id="AgentStatusSpan"><font class="body_text">
您目前的状态: <span id="AgentStatusStatus"></span> <BR>Calls Dialing: <span id="AgentStatusDiaLs"></span> 
</font></span>

<!-- TransferMain@20110104 start -->
<div id="TransferMainDIV">
<span id="TransferMain">
   <span id="xferchannel_span"></span>
   <input type="hidden"  name="xferlength" id="xferlength" maxlength=4 size=24 >
   <input type="hidden"  name="xferchannel" id="xferchannel" maxlength=200 size=35>
   <input type="hidden" name="xferuniqueid" id="xferuniqueid" size=35>
 <table cellpadding="0" cellspacing="0" border="0" class="transfer_table" align="center">
  <!-- <tr>
    <td>

	</td>
   </tr>-->
   <!--秒 <input type="text" size="4" name="xferlength" id="xferlength" maxlength=4 >
   通道 <input type="text" size="26" name="xferchannel" id="xferchannel" maxlength=200 >-->
   <tr>
    <td>
       <span style="position:absolute;left:0px;top:0px;width:360px;height:300px;background-color:#FFFFFF" id="AgentXferViewSpan">
			 <span style="margin-top:5px;margin-bottom:5px; padding-bottom:5px; text-align:center;width:100%;border-bottom:1px solid #eee;">
				 用户组：
				 <select name="AgentViewUsergroup2" id="AgentViewUsergroup2" style="width:120px;">
				   <option value="Demo">[All]</option><option value="Demo">演示用户组</option>		     </select>
			 技能组：
			 <select name="AgentViewTechgroup2" id="AgentViewTechgroup2" style="width:120px;"><option value="IVR_AIA">[All]</option><option value="IVR_AIA">IVR_AIA</option></select>
			 </span>
            <span id="AgentXferViewSelect"></span>       </span>	</td>
   </tr>
   <tr>
   <td>
   <fieldset>
	<legend style="color:#000">转接目标</legend>
	<div style="margin:2px 2px">
	 <input type="radio" name="btnTransferTarget" id="consultativexfer" value="0" checked="checked" style="vertical-align:text-bottom" onClick="agentclick()"><span id="agentdirectlink" style="width:45px;"><b><a href="#" onClick="agent_check(this);XferAgentSelectLaunch();return false;" style="font-size:12px;" title="话务员">话务员</a></b>
     </span>
	 <span id="agentinput"><input type="text" size="12" name="xfernumber" id="xfernumber" maxlength="25" value="" style="margin-left:19px"></span>	
	</div>

    <div style="margin:2px 2px">
	 <input type="radio" name="btnTransferTarget" id="xferoverride" size="1" value="0" style="vertical-align:text-bottom" onClick="overrideclick()">外线号码	 <span id="overrideinput"><input type="text" size="12"  maxlength="25" value="" style="margin-left:10px"></span>
     
	</div>
    
	<div id="preset_num">
	</div>
	<div style="margin:4px 2px">
	 <input type="radio" name="btnTransferTarget" id="xferoverrideaaa" size="1" value="0" style="vertical-align:text-bottom" onClick="trasfertargetclick()">技能组	 <span id="XfeRGrouPLisT" style="margin-left:22px;">	    
		<select size=1 name="XfeRGrouP" id="XfeRGrouP" onChange="XferAgentSelectLink();return false;" ><option>-- 选择转接技能组--</option></select>
	 </span>
      <span STYLE="background-color: #FFFFFF;display:none" id="LocalCloser">
       		<IMG style="vertical-align:top;" SRC="../agc/images/vdc_XB_localcloser_OFF_cn.gif" border=0 alt="转本地技能组" >
	        </span>
	  <span STYLE="background-color: #FFFFFF;display:none" id="DialBlindVMail">
	 	  <IMG SRC="../agc/images/vdc_XB_ammessage_OFF_cn.gif" border=0 alt="Blind Transfer VMail Message" style="vertical-align:middle">
	  	</span>
	</div>

		<div style="margin:2px 2px">
	 <input type="radio" name="btnTransferTarget" id="xferoverridebbb" size="1" value="0" style="vertical-align:text-bottom" onClick="vmclick()">语音信息	</div>
	 </fieldset>   </td>
  </tr>

  

  <tr>
   <td>
    <fieldset>
	  <legend style="color:#000">转接方式</legend>
     <span STYLE="background-color: #FFFFFF" id="DialBlindTransfer">	 </span>&nbsp; 

     <span STYLE="background-color: #FFFFFF" id="DialWithCustomer">
	     <a href="#" onClick="DialWithCustomerClick(1);return false;">
		  		  <IMG SRC="../agc/images/cn/vdc_XB_dialwithcustomer_cn.gif" border=0 alt="不挂断拨号" style="vertical-align:middle">
		  		 </a>	</span>&nbsp;

    <span STYLE="background-color: #FFFFFF" id="ParkCustomerDial">
	  <a href="#" onClick="DialWithCustomerClick(0);return false;">
	     <IMG SRC="../agc/images/cn/vdc_XB_parkcustomerdial_cn.gif" border=0 alt="保持客户拨号" style="vertical-align:middle">	  </a>	</span>
   </fieldset>   </td>
  </tr>
  
  <tr>
   <td>
     <fieldset>
	  <legend style="color:#000">挂断方式</legend>
      <span STYLE="background-color: #FFFFFF" id="HangupXferLine">
	   <!--when project is ehsn image changed-->
      <IMG SRC="../agc/images/cn/vdc_XB_hangupxferline_OFF_cn_ehsn.gif" border=0 alt="挂断第三方转接线" style="vertical-align:middle">	  </span>    
     <span STYLE="background-color: #FFFFFF" id="HangupBothLines">
	  
	     <IMG SRC="../agc/images/cn/vdc_XB_hangupbothlines_OFF_cn.gif" border=0 alt="全部挂断" style="vertical-align:middle">	 </span>
    <span STYLE="background-color: #FFFFFF" id="Leave3WayCall">
	  
	    <IMG SRC="../agc/images/cn/vdc_XB_leave3waycall_OFF_cn.gif" border=0 alt="离开三方通话" style="vertical-align:middle">	</span>
  </fieldset>   </td>
  </tr>
 </table>
    <span id="XfeRDiaLGrouPSelecteD"></span><span id="XfeRCID"></span>
</span>
</div>

<!-- ShowFromCallInfo@20110425 end -->
<div id="ShowFromCallInfoDIV">
<span id="ShowFromCallInfoBox">
	<span id="ShowFromCallInfo"></span>
</span>
</div>

<!-- TransferMain@20110104 end -->
<div id="callsinqueuedisplayDIV" title="电话队列">
 <span  id="callsinqueuedisplay">
  <span id="callsinqueuelist"></span>
  <span id="callsinqueuehangup"></span>
 </span>
</div>
<!--Mod by fnatic z-index:25 => 35 -->
<div id="AgentViewSpanDIV">
 <span style="margin-bottom:5px; padding-bottom:5px; text-align:center;width:100%;border-bottom:1px solid #eee;">
	 用户组：<select name="AgentViewUsergroup" id="AgentViewUsergroup" style="width:150px;"><option value="Demo">[All]</option><option value="Demo">演示用户组</option></select>
	 技能组：<select name="AgentViewTechgroup" id="AgentViewTechgroup" style="width:150px;"><option value="IVR_AIA">[All]</option><option value="IVR_AIA">IVR_AIA</option></select>
 </span>
 <span id="AgentViewSpan">
  <TABLE CELLPADDING=0 CELLSPACING=0 BORDER=0 WIDTH=100%>
  <TR>
   <TD ALIGN=CENTER>
     <span id="AgentViewStatus">&nbsp;</span>
   </TD>
 </TR>
  </TABLE>
 </span>
</div>

<font class="body_small"><span style="position:absolute;left:200px;top:440px;z-index:28;" id="dialableleadsspan">
</span></font>

<!--<span style="position:absolute;left:px;top:px;z-index:29;" id="AgentMuteSpan"></span>-->

<span style="position:absolute;left:5px;top:310px;z-index:34;" id="HotKeyActionBox">
    <table border=0 bgcolor="#FFDD99" width=950 height=70>
	<TR bgcolor="#FFEEBB"><TD height=70><font class="sh_text"> 设定结束码为: </font><BR><BR><CENTER>
	<font class="sd_text"><span id="HotKeyDispo"> - </span></font></CENTER>
	</TD>
	</TR></TABLE>
</span>

<span style="position:absolute;left:5px;top:310px;z-index:35;" id="HotKeyEntriesBox">
    <table border=0 bgcolor="#FFDD99" width=950 height=70>
	<TR bgcolor="#FFEEBB"><TD width=200><font class="sh_text"> 结束码快捷键: </font></td><td colspan=2>
	<font class="body_small">启用时，只需点选结束码对应之快捷键，系统即会自动下结束码与挂断电话:</font></td></tr><tr>
	<TD width=200><font class="sk_text">
	<span id="HotKeyBoxA"></span>
	</font></TD>
	<TD width=200><font class="sk_text">
	<span id="HotKeyBoxB"></span>
	</font></TD>
	<TD><font class="sk_text">
	<span id="HotKeyBoxC"></span>
	</font></TD>
	</TR></TABLE>
</span>

<span style="position:absolute;left:5px;top:310px;z-index:36;" id="CBcommentsBox">
    <table border=0 bgcolor="#FFFFCC" width=950 height=70>
	<TR bgcolor="#FFFF66">
	<TD align=left><font class="sh_text"> 过去的个人回拨提示信息: </font></td>
	<TD align=right><font class="sk_text"> <a href="#" onClick="CBcommentsBoxhide();return false;">close</a> </font></td>
	</tr><tr>
	<TD><font class="sk_text">
	<span id="CBcommentsBoxA"></span><BR>
	<span id="CBcommentsBoxB"></span><BR>
	<span id="CBcommentsBoxC"></span><BR>
	</font></TD>
	<TD width=320><font class="sk_text">
	<span id="CBcommentsBoxD"></span>
	</font></TD>
	</TR></TABLE>
</span>

<span style="position:absolute;left:5px;top:310px;z-index:37;" id="EAcommentsBox">
    <table border=0 bgcolor="#FFFFCC" width=950 height=70>
	<TR bgcolor="#FFFF66">
	<TD align=left><font class="sh_text"> 扩充的其它电话信息: </font></td>
	<TD align=right><font class="sk_text"> <a href="#" onClick="EAcommentsBoxhide('YES');return false;"> 最小 </a> </font></td>
	</tr><tr>
	<TD VALIGN=top><font class="sk_text">
	<span id="EAcommentsBoxC"></span><BR>
	<span id="EAcommentsBoxB"></span><BR>
	</font></TD>
	<TD width=320 VALIGN=top><font class="sk_text">
	<span id="EAcommentsBoxA"></span><BR>
	<span id="EAcommentsBoxD"></span>
	</font></TD>
	</TR></TABLE>
</span>

<span style="position:absolute;left:695px;top:310px;z-index:38;" id="EAcommentsMinBox">
    <table border=0 bgcolor="#FFFFCC" width=40 height=20>
	<TR bgcolor="#FFFF66">
	<TD align=left><font class="sk_text"><a href="#" onClick="EAcommentsBoxshow();return false;"> 最大 </a> <BR>Alt 电话 Info</font></td>
	</tr></TABLE>
</span>

<span style="position:absolute;left:0px;top:0px;z-index:39;width:100%;" id="NoneInSessionBox">
    <table border=1 bgcolor="#CCFFFF" width=100% height=540><TR><TD align=center> 无人在这个会议中: <span id="NoneInSessionID"></span><BR>
	<a href="#" onClick="NoneInSessionOK();return false;">返回</a>
	<BR><BR>
	<a href="#" onClick="NoneInSessionCalL();return false;">再次呼叫话务员</a>
	</TD></TR></TABLE>
</span>

<span style="position:absolute;left:0px;top:0px;z-index:40;width:100%;" id="CustomerGoneBox">
    <table border=1 bgcolor="#CCFFFF" width=100% height=540><TR><TD align=center> 客户已挂断电话: <span id="CustomerGoneChanneL"></span><BR>
	<a href="#" onClick="CustomerGoneOK();return false;">返回</a>
	<BR><BR>
	<a href="#" onClick="CustomerGoneHangup();return false;">结束通话,填写小结</a>
	</TD></TR></TABLE>
</span>

<span style="position:absolute;left:0px;top:0px;z-index:41;width:100%;" id="WrapupBox">
    <table border=1 bgcolor="#F4F4F4" width=100% height=540><TR><TD align=center> 电话文书: <span id="WrapupTimer"></span> 文书状态尚余秒数<BR><BR>
	<span id="WrapupMessage">Wrapup Call</span>
	<BR><BR>
	<a href="#" onClick="WrapupFinish();return false;">结束文书并继续</a>
	</TD></TR></TABLE>
</span>


<div id="DailAlertDIV">
<span id="TimerSpan">
	<span id="TimerContentSpan"></span>
	<!--<a href="#" onClick="hideDiv('TimerSpan');return false;">关闭消息</a>-->
</span>
</div>

<span style="position:absolute;left:0px;top:0px;z-index:43;width:100%;" id="AgenTDisablEBoX">
    <table border=1 bgcolor="#FFFFFF" width=100% height=540><TR><TD align=center>你的会话已不可用<BR><a href="#" onClick="LogouT('DISABLED');return false;">注销</a><BR><BR><a href="#" onClick="hideDiv('AgenTDisablEBoX');return false;">返回</a>
</TD></TR></TABLE>
</span>

<span style="position:absolute;left:0px;top:0px;z-index:44;width:100%;" id="SysteMDisablEBoX">
    <table border=1 bgcolor="#FFFFFF" width=100% height=540><TR><TD align=center>系统中有时间同步问题，请联系系统管理者<BR><BR><BR><a href="#" onClick="hideDiv('SysteMDisablEBoX');return false;">返回</a>
</TD></TR></TABLE>
</span>

<span style="position:absolute;left:0px;top:0px;z-index:45;width:100%" id="LogouTBox">
    <table border=1 bgcolor="#FFFFFF" width=100% height=540><TR><TD align=center><BR><span id="LogouTBoxLink">注销</span></TD></TR></TABLE>
</span>

<span style="position:absolute;left:0px;top:70px;z-index:46;" id="DispoButtonHideA">
    <table border=0 bgcolor="#F4F4F4" width=195 height=70><TR><TD align=center VALIGN=top></TD></TR></TABLE>
</span>

<span style="position:absolute;left:0px;top:138px;z-index:47;" id="DispoButtonHideB">
    <table border=0 bgcolor="#F4F4F4" width=195 height=250><TR><TD align=center VALIGN=top>&nbsp;</TD></TR></TABLE>
</span>

<span style="position:absolute;left:0px;top:0px;z-index:48;" id="DispoButtonHideC">
    <table border=0 bgcolor="#F4F4F4" width=100% height=47><TR><TD align=center VALIGN=top>你必须先更改客户数据，再挂断电话。否则所做变更将不会生效！. </TD></TR></TABLE>
</span>

<div id="DispoSelectBox">
	<span id="DispoSelectPhonE" style="display:none"></span>
	<span id="DispoSelectHAspan" style="display:none"><a href="#" onClick="DispoHanguPAgaiN()">Hangup Again</a></span>
	<span id="DispoSelectMaxMin" style="display:none"><a href="#" onClick="DispoMinimize()"> minimize </a></span>
	<BR>
    	<span id="DispoSelectContent"> 结束码选择 </span>
	<input type="hidden" name="DispoSelection" id=DispoSelection><BR><!-- yanson target -->

	<input type="checkbox" name="DispoSelectStop" id="DispoSelectStop" size=1 value="0"  onClick="change_pause_code(this);">暂停	<BR>
	<span id="DispoPauseHTMLContent"></span>
		<span style="width:100%;height:30px;"><span id="DispoDialNextContent"><input type="checkbox" name="DispoDialNext" id="DispoDialNext" size=1 value="0">拨打下一个</span>&nbsp;</span>
		<span style="width:100%;height:30px;">
	<p align="center"><a href="#" onClick="DispoSelect_submit2();return false;" style="font-size:14px;">确认</a></p>
	</span>
		
</div>
<script>

 function change_pause_code(myobj)
 {
	try{
		var obj = document.getElementsByName("PauseRadioSelect");
		var PauseCode_Default = "";
		var PauseOnlyOnce = true;
		Default_Pause_Code_Enable='Y';
		for(var i = 0; i < obj.length; i++)
		{
			obj[i].disabled = !myobj.checked;
		}
		if(myobj.checked){
			//外拔后如果选择了暂停代码就不用再重新恢复
			if(Dial_Next_Display=='Y'){
				document.getElementById("DispoDialNextContent").style.display = "none";
			}
			Cortorl_Pausecode_Insert_Db='N';
			if(PauseCode_Default!="" && PauseOnlyOnce){
				PauseCodeSelect_submit(PauseCode_Default);
				PauseOnlyOnce = false;
			}
		}else{
			if(Dial_Next_Display=='Y'){
				document.getElementById("DispoDialNextContent").style.display = "";
			}
			Cortorl_Pausecode_Insert_Db='Y';
			document.getElementById("PauseCodeSelection").value='';
		}
	}catch(err){
		//alert(err);
	}
 }
</script>
<div id="PauseCodeSelectBoxDIV">
<span id="PauseCodeSelectBox">
    <table border="0" cellspacing="0" cellpadding="0" width="100%"><TR><TD align=center VALIGN=top>
	<span id="PauseCodeSelectContent">请选择暂停码</span>
	<input type="hidden" name="PauseCodeSelection" id="PauseCodeSelection">
	</TD></TR></TABLE>
</span>
</div>

<span style="position:absolute;left:0px;top:0px;z-index:65;width:100%;" id="GroupAliasSelectBox">
    <table border=1 bgcolor="#F4F4F4" width=100% height=540><TR><TD align=center VALIGN=top> 选择技能组代名 :<BR>
	<span id="GroupAliasSelectContent"> 技能组代名选择 </span>
	<input type=hidden name=GroupAliasSelection>
	<BR><BR> &nbsp; 
	</TD></TR></TABLE>
</span>

<!--<span style="position:absolute;left:0px;top:1500px;z-index:66;" id="GENDERhideFORieALT"></span>-->
<!--Edit by fnatic-->
<span style=" visibility:hidden" id="GENDERhideFORieALT"></span>

<!--End-->
<div id="CallBackSelectBox">
    <!--<table border=1 bgcolor="#F4F4F4" width= height=><TR><TD align=center VALIGN=top> 选择回拨日期 :<span id="CallBackDatE">-->
    <table width=100% border=0 cellpadding="5"><TR><td bgcolor="#FEFBE2" style="border:1px solid #FEEB84;border-collapse:collapse;">
	<span id="CallBackDatE"></span>
	<span id="CallBackDatEPrinT">选择日期:</span>
	<input type="text" name="CallBackDatESelectioN" ID="CallBackDatESelectioN">
	<input type="hidden" name="CallBackTimESelectioN" ID="CallBackTimESelectioN">
	<span id="CallBackTimEPrinT"></span>
	<SELECT SIZE=1 NAME="CBT_hour" ID="CBT_hour">
	<option>01</option>
	<option>02</option>
	<option>03</option>
	<option>04</option>
	<option>05</option>
	<option>06</option>
	<option>07</option>
	<option>08</option>
	<option>09</option>
	<option>10</option>
	<option>11</option>
	<option>12</option>
	</select>&nbsp;时
	<SELECT SIZE=1 NAME="CBT_minute" ID="CBT_minute">
	<option>00</option>
	<option>05</option>
	<option>10</option>
	<option>15</option>
	<option>20</option>
	<option>25</option>
	<option>30</option>
	<option>35</option>
	<option>40</option>
	<option>45</option>
	<option>50</option>
	<option>55</option>
	</select>&nbsp;分

	<SELECT SIZE=1 NAME="CBT_ampm" ID="CBT_ampm">
	<option>AM</option>
	<option selected>PM</option>
	</select> &nbsp;
	<input type=checkbox checked=checked name=CallBackOnlyMe id=CallBackOnlyMe size=1 value="0">自己跟进<BR>	</TD></TR><TR><td bgcolor="#FEFBE2" style="border:1px solid #FEEB84;border-collapse:collapse;">
	备注:<input type=text name="CallBackCommenTsField" id="CallBackCommenTsField" size=50 maxlength=255>
	</TD></TR><TR><td bgcolor="#FEFBE2" style="border:1px solid #FEEB84;border-collapse:collapse;" align="center">
	<a href="#" onClick="CallBackDatE_submit();return false;" style="font-size:14px;">确认</a>       <a href="#" onClick="fall_CallBack();";style="font-size:14px;">返回</a><BR>

	</TD></TR></TABLE>
</div>

<span style="position:absolute;left:0px;top:0px;z-index:53;width:100%;" id="CloserSelectBox">
    <table border=1 bgcolor="#F4F4F4"  height=540 width=100%><TR><TD align=center VALIGN=top>请选择技能组 <BR>
	<span id="CloserSelectContent"> Closer Inbound Group Selection </span>
	<input type=hidden name=CloserSelectList><BR>
		<a href="#" onClick="CloserSelectContent_create();return false;"> 重置 </a> | 
	<a href="#" onClick="CloserSelect_submit();return false;">确认</a>
	<BR>
	</TD></TR></TABLE>
</span>

<span style="position:absolute;left:0px;top:0px;z-index:54;" id="TerritorySelectBox">
    <table border=1 bgcolor="#F4F4F4" width=100% height=540><TR><TD align=center VALIGN=top> TERRITORY SELECTION <BR>
	<span id="TerritorySelectContent"> Territory Selection </span>
	<input type=hidden name=TerritorySelectList><BR>
	<a href="#" onClick="TerritorySelectContent_create();return false;"> 重置 </a> | 
	<a href="#" onClick="TerritorySelect_submit();return false;">确认</a>
	<BR><BR><BR><BR> &nbsp; 
	</TD></TR></TABLE>
</span>

<span style="position:absolute;left:0px;top:0px;z-index:55;" id="NothingBox">
    <BUTTON Type=button name="inert_button"><img src="../agc/images/blank.gif"></BUTTON>
	<span id="DiaLLeaDPrevieWHide"> 通道</span>
	<span id="DiaLDiaLAltPhonEHide"> 通道</span>
	<input type=checkbox name=CloserSelectBlended size=1 value="0"> 呼入/呼出 混合模式<BR></span>

<span  style="position:absolute;left:172px;top:75px;z-index:30; width: 88%; heigth:88%; text-align:left;" id="ScriptPanel">
        <div id="ScriptContents"></div>        
</span>


<span style="position:absolute;left:910px;top:60px;z-index:31;" id="ScriptRefresH">
<!--<a href="#" onClick="RefresHScript()"><font class="body_small">refresh</font></a>-->
</span>



<div id="MaiNfooterspanDIV">
<span id="MaiNfooterspan">
<table BGCOLOR="#FFFFFF" id="MaiNfooter" width=100%>
<tr>
 <td>
  <span id="outboundcallsspan"></span>
 </td>
</tr>
<!--<tr><td colspan=3>
<font class="body_small">
<span id="debugbottomspan"></span>
</font>
</td></tr>-->
</TABLE>
</span>
</div>

<!-- BEGIN *********   Here is the main CCMS display panel -->
<span style="position:absolute;left:0px;top:36px;z-index:10;width:100%;" id="MainPanel">
<!--<TABLE border=0 BGCOLOR="" width= id="MainTable" >-->
<TABLE border=0 BGCOLOR="#FFFFFF" width="100%" id="MainTable" >
<TR>
  <TD colspan="2">
   <table border=0 width="100%" cellspacing="0" cellpadding="0">
    <tr>
	 <td width="175px" align="center">
	  <IMG SRC="../agc/images/cn/agc_live_call_OFF_cn.gif" NAME=livecall  WIDTH=109 HEIGHT=30 BORDER=0>
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  <IMG SRC="../agc/images/pannel_control_img.jpg" style="margin-bottom:10px;" id="pannel_img" onClick="javascript:show_pannel_div();" ALT="隐藏面板" border="0">
	 </td>
	 <td align="left" valign="middle">
	   <div class="queuediv">
		 <span id="out_line12">
		 </span>
		 <span id="line12"></span>
	     <span id="recording_debug"></span>
	     <span id="AgentStatusCalls"></span>
	     <span id="MainStatuSSpan"></span>
	   </div>
	 </td>
	</tr>
   </table>
 <span id="busycallsdebug"></span>
 </TD>
</TR>
<tr>
<td id="button_pannel_td" nowrap="nowrap" style="width:175px;">
<div id="button_pannel">
<span id="HangupControl"><IMG SRC="../agc/images/cn/vdc_LB_hangupcustomer_OFF_cn.gif" border=0 alt="挂断"></span>
<span id="DiaLControl">
<a href="#" onClick="ManualDialNext('','','','','','0');"><IMG SRC="../agc/images/vdc_LB_dialnextnumber_OFF_cn.gif" border=0 alt="拨下一个号码"></a>
</span>
<BR>
<span id="ParkControl"><IMG SRC="../agc/images/cn/vdc_LB_parkcall_OFF_cn.gif" border=0 alt="保持电话"></span>
<span id="XferControl"><IMG SRC="../agc/images/cn/vdc_LB_transferconf_OFF_cn.gif" border=0 alt="转接"></span><BR>
<span style="" id="VolumeControlSpan"><span id="VolumeUpSpan"><IMG SRC="../agc/images/vdc_volume_up_off.gif" BORDER=0></span><BR><span id="VolumeDownSpan"><IMG SRC="../agc/images/vdc_volume_down_off.gif" BORDER=0></span>
</span><BR>
<span id="DiaLLeaDPrevieW">
<input type=checkbox name=LeadPreview size=1 value="0">预览潜在客户</span>
<span id="DiaLDiaLAltPhonE"><input type=checkbox name=DiaLAltPhonE size=1 value="0">拨打其它电话</span>

<!--
 MODIFY BY FNATIC-->

<!-- recording + fnatic -->
<div style="display:none"> 
  <span id="RecorDingFilename"></span>
  <span id="RecorDID"></span>
  <span STYLE="background-color: #FFFFFF" id="RecorDControl"><a href="#" onClick="conf_send_recording('MonitorConf',session_id,'');return false;"><IMG SRC="../agc/images/vdc_LB_startrecording_cn.gif" border=0 alt="启动录音"></a></span>
  <!--// fix vicidial record bug + fantic-->
  <input type="hidden" id="RecorDingFilename_input" value="" />
  <!--// end -->
</div>
<!-- end -->

 <!--<a href=\"#\" onclick=\"conf_send_recording('MonitorConf','" + head_conf + "','');return false;\">录音</a> -->

<!--<span id="SpacerSpanA"><IMG SRC="../agc/images/blank.gif" width=145 height=16 border=0></span>-->
<span STYLE="background-color: #FFFFFF" id="WebFormSpan"><IMG SRC="../agc/images/cn/vdc_LB_webform_OFF_cn.gif" border=0 alt="网页表单"></span>
<span STYLE="background-color: #FFFFFF" id="WebFormSpanTwo"><IMG SRC="../agc/images/cn/vdc_LB_webform_two_OFF_cn.gif" border=0 alt="网页表单 2"></span>
<!--<span id="SpacerSpanB"><IMG SRC="../agc/images/blank.gif" width=145 height=16 border=0></span><BR>-->



<span id="ReQueueCall"></span>



<!--<span id="SpacerSpanC"><IMG SRC="../agc/images/blank.gif" width=145 height=16 border=0></span><BR>
<span id="SpacerSpanD"><IMG SRC="../agc/images/blank.gif" width=145 height=16 border=0></span><BR>-->
<!--Mod by fnatic -->
<div class="button_link">
<table>
<tr>
	<td>
	   <span id="ManuaLDiaLButtons"><span id="MDstatusSpan">
		<a href="#" onClick="NeWManuaLDiaLCalL('NO');return false;">手动外拨号码</a>
	 </span><!--<a href="#" onClick="NeWManuaLDiaLCalL('FAST');return false;">快速拨号</a>--></span>   
	</td>
</tr>
<tr >
	<td>
	 <span id="AgentViewLinkSpan">
	  <span id="AgentViewLink">
	  
	   <a href="#" onClick="redirectcalltoagentid = '';AgentsViewOpen('AgentViewSpan','open');return false;">查看话务员状态</a>
	  </span>
	 </span>
	</td>
</tr>
<tr>
	<td>
	<span id="AgentAlertSpan">
	<a href="#" onclick="alert_control('ON');return false;">开启进线提示</a>	</span>
	</td>
</tr>
<tr>
	<td>
	<span  id="callsinqueuelink">
		</span>   
	</td>
</tr>
<tr>
	<td>
	<span id="CallbacksButtons"></span><span id="CBstatusSpan"><a href="#" onClick="CalLBacKsLisTCheck();return false;">个人回拨提示</a></span>
	</td>
</tr>
</table>

<!--Add fnatic start-->
<bgsound id="snd" loop="1" src="">
<!--Add fnatic end-->

</div>

<table width="100%">
<tr><td>公告</td></tr>
<tr><td>
<marquee height=100 width=100% direction=up scrollamount=2 onmouseover=this.stop() onmouseout=this.start() >
<table  width="100%">
</table>
</marquee>
</td></tr>
</table>

<div class="volume_button" style="display:none">

<div id="SendDTMFdiv">
   <span id="SendDTMF">
	 <IMG style="cursor:pointer;" onClick="SendConfDTMF(session_id);return false;" SRC="../agc/images/vdc_LB_senddtmf_cn.gif" border="0" alt="DTMF" align="absmiddle">
   <input type="text" size="8" name="conf_dtmf" value="" maxlength="50">
  </span>
</div>
<span id="AgentMuteSpan"></span>&nbsp;
<span id="VolumeControlSpan"><span id="VolumeUpSpan"><IMG SRC="../agc/images/vdc_volume_up_off.gif" BORDER=0></span>&nbsp;<span id="VolumeDownSpan"><IMG SRC="../agc/images/vdc_volume_down_off.gif" BORDER=0></span>
</font></span>
</div>
<hr>
 <!-- version:  
  版次:  
  主机:   -->

   <!-- <br/>
  <b>暂停原因</b>
  
  <br/>
  <b>会议 ID:</b>
  <span id="sessionIDspan"></span>
  <span id="status" style="font-family:sans-serif; font-size:12px; color:#FFFFFF">LIVE</span>
  <span id="agentchannelSPAN"></span>-->

<table class="agent_info_table" border="0" cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="head" colspan=2>话务员帐号：66669  </td>
 </tr>
  <tr>
  <td class="head">分机号码：
  </td>
  <td>SIP/66669  </td>
 </tr>
  <tr style="display:none">
  <td class="head">会 议 ID：
  </td>
  <td>  
  <span id="sessionIDspan"></span>
  <span id="status" style="font-family:sans-serif; font-size:12px; color:#FFFFFF">LIVE</span>
  <span id="agentchannelSPAN"></span>
  </td>
 </tr>
  <tr>
  <td class="head">Campaign：
  </td>
  <td>edu<input type="hidden" name="vicidial_campaign_id" id="vicidial_campaign_id"  value="edu">
  </td>
 </tr>
 <tr>
  <td class="head">今天登陆：
  </td>
  <td>2015-03-19 08:57:12  </td>
 </tr>
 <tr>
  <td class="head" colspan=2>话务员状态：<span id="status_code"></span>
  </td>

 </tr>

   <tr>
 <td colspan=2>
 <span id="debugbottomspan"></span>
 </td>
 </tr>
   <tr>
 <td colspan=2>
 CCMS 版本 ：3.0.3 (Build 03) </td>
 </tr>
</table>
</div>
<iframe id="hiddeniframe" name="hiddeniframe" src="" width="0" height="0" frameborder="no" border="0" marginwidth="0" marginheight="0" scrolling="no" allowtransparency="yes"></iframe>
<!--end-->
</td>
<td width= align=left valign=top>
<input type=hidden name=uniqueid value="">
<input type=hidden name=lead_id value="">
<input type=hidden name=list_id value="">
<input type=hidden name=called_count value="">
<input type=hidden name=rank value="">
<input type=hidden name=owner value="">
<input type=hidden name=gmt_offset_now value="">
<input type=hidden name=gender value="">
<input type=hidden name=date_of_birth value="">
<input type=hidden name=country_code value="">
<input type=hidden name=modify_date value="">
<input type=hidden name=entry_date value="">

<input type=hidden name=callserverip value="">
<input type=hidden name=SecondS value="">
<div class="text_input" id="MainPanelCustInfo" style="visibility:hidden">
<table border="0" ><tr>
<td align=center><A HREF="#" onClick="MainPanelToFront('NO');"><IMG SRC="../agc/images/customer_info_cn.gif" ALT="CCMS" WIDTH=143 HEIGHT=27 BORDER=0></A>&nbsp;&nbsp;&nbsp;&nbsp;<A HREF="#" onClick="ScriptPanelToFront();"><IMG SRC="../agc/images/script_tab_cn.jpg" ALT="SCRIPT" WIDTH=143 HEIGHT=27 BORDER=0></A></td>
</tr><tr>
<td colspan=4 align=center>客户信息: <span id="CusTInfOSpaN"></span></td>
</tr><tr>
<td align=left colspan=2>
<table><tr>
<td align=right><font class="body_text"> 职位: </font></td>
<td align=left colspan=5><font class="body_text"><input type=text size=4 name=title maxlength=4 class="cust_form" value="">&nbsp; 名: <input type=text size=17 name=first_name maxlength=30 class="cust_form" value="">&nbsp; MI:<input type=text size=1 name=middle_initial maxlength=1 class="cust_form" value="">&nbsp; 姓: <input type=text size=23 name=last_name maxlength=30 class="cust_form" value=""></td>
</tr><tr>
<td align=right><font class="body_text"> 地址1: </td>
<td align=left colspan=5><font class="body_text"><input type=text size=85 name=address1 maxlength=100 class="cust_form" value=""></td>
</tr><tr>
<td align=right><font class="body_text"> 地址2: </td>
<td align=left><font class="body_text"><input type=text size=20 name=address2 maxlength=100 class="cust_form" value=""></td>
<td align=right><font class="body_text">地址3: </td>
<td align=left colspan=3><font class="body_text"><input type=text size=45 name=address3 maxlength=100 class="cust_form" value=""></td>
</tr><tr>
<td align=right><font class="body_text"> 市: </td>
<td align=left><font class="body_text"><input type=text size=20 name=city maxlength=50 class="cust_form" value=""></td>
<td align=right><font class="body_text">州: </td>
<td align=left><font class="body_text"><input type=text size=4 name=state maxlength=2 class="cust_form" value=""></td>
<td align=right><font class="body_text">邮政编码: </td>
<td align=left><font class="body_text"><input type=text size=14 name=postal_code maxlength=10 class="cust_form" value=""></td>
</tr><tr>
<td align=right><font class="body_text"> 省: </td>
<td align=left><font class="body_text"><input type=text size=20 name=province maxlength=50 class="cust_form" value=""></td>
<td align=right><font class="body_text">Vendor ID: </td>
<td align=left><font class="body_text"><input type=text size=15 name=vendor_lead_code maxlength=20 class="cust_form" value=""></td>
<td align=right><font class="body_text">性别: </td>
<td align=left><font class="body_text"><span id="GENDERhideFORie"><select style="display:none" size=1 name=gender_list class="cust_form" id=gender_list><option value="U">U - 尚未定义</option><option value="M">M - Male</option><option value="F">F - Female</option></select></span></td>
</tr><tr>
<td align=right><font class="body_text"> 电话: </td>
<td align=left><font class="body_text">
<font class="body_text"><span id=phone_numberDISP> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </span></font><input type=hidden name=phone_number value="">
</td>
<td align=right><font class="body_text">区号: </td>
<td align=left><font class="body_text"><input type=text size=4 name=phone_code maxlength=10 class="cust_form" value=""></td>
<td align=right><font class="body_text">其它电话: </td>
<td align=left><font class="body_text"><input type=text size=14 name=alt_phone maxlength=16 class="cust_form" value=""></td>
</tr><tr>
<td align=right><font class="body_text"> 展现: </td>
<td align=left><font class="body_text"><input type=text size=20 name=security_phrase maxlength=100 class="cust_form" value=""></td>
<td align=right><font class="body_text">Email: </td>
<td align=left colspan=3><font class="body_text"><input type=text size=45 name=email maxlength=70 class="cust_form" value=""></td>
</tr><tr>
<td align=right valign=top><font class="body_text"> 备注:</td>
<td align=left colspan=5>
<font class="body_text">
<TEXTAREA NAME=comments ROWS=2 COLS=85 class="cust_form_text" value=""></TEXTAREA>
</font>
</td>

</tr></table></td>
</tr></table>
</div></td>
<td width=1 align=center>
</td>
</tr>
 
<!-- END *********   Here is the main CCMS display panel -->
 </TABLE>
</FORM>

<script language="javascript">

//Modified by Kelvin Begin
if (WebForm_Button_Display=='NONE') {
  document.getElementById("WebFormSpan").innerHTML="";
  document.getElementById("WebFormSpanTwo").innerHTML="";
}
//Modified by Kelvin End
//yanson edit@20100831 start
function hideSelect()
{   
	try{
		var sel = popupFrame.window.document.getElementsByTagName('select');
		if(sel.length>0){
			for(var i=0;i<sel.length;i++){
				popupFrame.window.document.getElementsByTagName('select')[i].style.display="none";
			}
		}
	}catch(err){}
}
function showSelect(){
	try{
		var sel = popupFrame.window.document.getElementsByTagName('select');
		if(sel.length>0){
			for(var i=0;i<sel.length;i++){
				popupFrame.window.document.getElementsByTagName('select')[i].style.display="";
			}
		}
	}catch(err){}
}
//yanson edit@20100831 end
function confirm_xfercall_send_hangup(){
	//yanson@20101027 start
	//when project is ehsn confirm changed	
	//xfercall_tmp = 1;
    var confirm_value="是否挂断第三方转接线？";

	
	
	//alert(document.getElementById("xferoverride").checked);
	//当转外线的单选按钮选中时，要先判断外线通道是否建立
	if (document.getElementById("xferoverride").checked==true && (document.getElementById("xferchannel").value == "" || document.getElementById("xferchannel").value == null) )
		{
		alert("外线通道未获取成功，请稍等1-2秒后重试！");
		return false;
		}
	 

	
	else if (document.getElementById("consultativexfer").checked==true && (document.getElementById("xferchannel").value == "" || document.getElementById("xferchannel").value == null) )
	{
		alert("内线通道未获取成功，请稍等1-2秒后重试！");
		return false;
	}

	else if(!confirm(confirm_value))
		{
			return false;
		}
	
	xfercall_send_hangup();
	// 挂断时停止轮询 + fnatic
	stopCount_all();
	// 结束
	// 恢复话务员文字的可点击
	document.getElementById("agentdirectlink").innerHTML = '<b><a href="#" onClick="agent_check(this);XferAgentSelectLaunch();return false;" style="font-size:12px;" title="话务员">话务员</a></b>';
	// 结束
	
	//如果客户要音乐保持就调用
	if (customerparked > 0 && Fast_Hangup_Xferline_And_Grab_Custline == "Y")
	{
	mainxfer_send_redirect('FROMParK',lastcustchannel,lastcustserverip);
	}
	

	//当转外线的单选按钮选中时，就置盲转按钮为可用
	if (document.getElementById("xferoverride").checked==true && Xfer_Blind_Display=='Y' )
		{
		document.getElementById("DialBlindTransfer").innerHTML = "<a href=\"#\" onclick=\"mainxfer_send_redirect('XfeRBLIND','" + lastcustchannel + "','" + lastcustserverip + "');return false;\"><IMG SRC=\"../agc/images/cn/vdc_XB_blindtransfer_cn.gif\" border=0 alt=\"盲转\" style=\"vertical-align:middle\"></a>";

		}
	//yanson@20110310 start
		try
		{
			document.getElementById("consultativexfer").disabled=false;
			document.getElementById("xferoverride").disabled=false;
			document.getElementById("xferoverrideaaa").disabled=false;
			document.getElementById("xferoverridebbb").disabled=false;
		}catch(err){ }

	document.getElementById("Leave3WayCall").innerHTML ="<IMG SRC=\"../agc/images/cn/vdc_XB_leave3waycall_OFF_cn.gif\" border=0 alt=\"离开三方通话\" style=\"vertical-align:middle\">";	

	//yanson@20101027 end
	//yanson@20110310 end
}
function confirm_bothcall_send_hangup(){
	//yanson@20101027 start
	if(!confirm("是否全部挂断？")){
		return false;
	}
	bothcall_send_hangup();
	//yanson@20101027 end
		//yanson@20110310 start
		try{
			document.getElementById("consultativexfer").disabled=false;
			document.getElementById("xferoverride").disabled=false;
			document.getElementById("xferoverrideaaa").disabled=false;
			document.getElementById("xferoverridebbb").disabled=false;
		}catch(err){ }
			
	//yanson@20101027 end
	document.getElementById("Leave3WayCall").innerHTML ="<IMG SRC=\"../agc/images/cn/vdc_XB_leave3waycall_OFF_cn.gif\" border=0 alt=\"离开三方通话\" style=\"vertical-align:middle\">";
	// 恢复话务员文字的可点击
	document.getElementById("agentdirectlink").innerHTML = '<b><a href="#" onClick="agent_check(this);XferAgentSelectLaunch();return false;" style="font-size:12px;" title="话务员">话务员</a></b>';
	// 结束
}
//fnatic edit@20100831 end
function confirm_leave_3way_call(){
	//fnatic@20101027 start
	if(!confirm("是否离开三方通话？")){
			return false;
	}
	leave_3way_call('FIRST');
	//fnatic@20101027 end
		//yanson@20110310 start
		try{
			document.getElementById("consultativexfer").disabled=false;
			document.getElementById("xferoverride").disabled=false;
			document.getElementById("xferoverrideaaa").disabled=false;
			document.getElementById("xferoverridebbb").disabled=false;
		}catch(err){ }
		document.getElementById("Leave3WayCall").innerHTML ="<IMG SRC=\"../agc/images/cn/vdc_XB_leave3waycall_OFF_cn.gif\" border=0 alt=\"离开三方通话\" style=\"vertical-align:middle\">";
	//yanson@20101027 end
	// 恢复话务员文字的可点击
	document.getElementById("agentdirectlink").innerHTML = '<b><a href="#" onClick="agent_check(this);XferAgentSelectLaunch();return false;" style="font-size:12px;" title="话务员">话务员</a></b>';
	// 结束
}

function show_pannel_div()
{   
     var pannel_div=document.getElementById("button_pannel");   
	 var pannel_td =document.getElementById("button_pannel_td");
     var script_span=document.getElementById("ScriptPanel");
	 var pannel_img=document.getElementById("pannel_img");
     pannel_div.style.display=(pannel_div.style.display=='none')?'block':'none'; 
     pannel_td.style.width=(pannel_td.style.width=='175px')?'0px':'175px';
	 script_span.style.left=(script_span.style.left=='172px')?'5px':'172px'; 
	 pannel_img.alt=(pannel_img.alt=="隐藏面板")?'展开面板':'隐藏面板';
}
//TransferMain@20110104 start
function agentclick(){
	loop_ct = 0;
	
	document.getElementById("overrideinput").innerHTML = '<input type="text" size="12"  maxlength="25" value="" style="margin-left:10px">';
	document.getElementById("agentinput").innerHTML = '<input type="text" size="12" name="xfernumber" id="xfernumber" readonly="true" maxlength="25" value="" style="margin-left:19px">';
	while (loop_ct < XFgroupCOUNT){
		if (VARxfergroups[loop_ct].match(/AGENTDIRECT/))
		{
			document.getElementById("XfeRGrouP").value = VARxfergroups[loop_ct];
		}
		loop_ct++;
	}
	if(Xfer_Blind_Display=='Y')
	{
		document.getElementById("DialBlindTransfer").innerHTML = "<IMG SRC=\"../agc/images/cn/vdc_XB_blindtransfer_OFF_cn.gif\" border=0 alt=\"盲转\" style=\"vertical-align:middle\">";
	}
	if(Xfer_Dial_With_Customer_Display=='Y')
	{
		document.getElementById("DialWithCustomer").innerHTML ="<a href=\"#\" onclick=\"DialWithCustomerClick(1);return false;\"><IMG SRC=\"../agc/images/cn/vdc_XB_dialwithcustomer_cn.gif\" border=0 alt=\"不挂断拨号\" style=\"vertical-align:middle\"></a>";
	}
	document.getElementById("ParkCustomerDial").innerHTML ="<a href=\"#\" onclick=\"DialWithCustomerClick(0);return false;\"><IMG SRC=\"../agc/images/cn/vdc_XB_parkcustomerdial_cn.gif\" border=0 alt=\"保持客户拨号\" style=\"vertical-align:middle\"></a>";
	document.getElementById("xfernumber").focus();
}
function overrideclick(){
	document.getElementById("agentinput").innerHTML = '<input type="text" size="12"  maxlength="25" readonly="true" value="" style="margin-left:19px">';
	document.getElementById("overrideinput").innerHTML = '<input type="text" size="12" name="xfernumber" id="xfernumber" maxlength="25" value="" style="margin-left:10px">';
	if(Xfer_Blind_Display=='Y')
	{
		document.getElementById("DialBlindTransfer").innerHTML = "<a href=\"#\" onclick=\"mainxfer_send_redirect('XfeRBLIND','" + lastcustchannel + "','" + lastcustserverip + "');return false;\"><IMG SRC=\"../agc/images/cn/vdc_XB_blindtransfer_cn.gif\" border=0 alt=\"盲转\" style=\"vertical-align:middle\"></a>";
	}
	if(Xfer_Dial_With_Customer_Display=='Y')
	{
		document.getElementById("DialWithCustomer").innerHTML ="<a href=\"#\" onclick=\"DialWithCustomerClick(1);return false;\"><IMG SRC=\"../agc/images/cn/vdc_XB_dialwithcustomer_cn.gif\" border=0 alt=\"不挂断拨号\" style=\"vertical-align:middle\"></a>";
	}
	document.getElementById("ParkCustomerDial").innerHTML ="<a href=\"#\" onclick=\"DialWithCustomerClick(0);return false;\"><IMG SRC=\"../agc/images/cn/vdc_XB_parkcustomerdial_cn.gif\" border=0 alt=\"保持客户拨号\" style=\"vertical-align:middle\"></a>";
	document.getElementById("xfernumber").focus();
}
function trasfertargetclick(){
	document.getElementById("overrideinput").innerHTML = '<input type="text" size="12"  maxlength="25" value="" style="margin-left:10px">';
	document.getElementById("agentinput").innerHTML = '<input type="text" size="12" name="xfernumber" id="xfernumber" maxlength="25" value="" style="margin-left:19px">';
 
	if(Xfer_Blind_Display=='Y')
	{
		document.getElementById("DialBlindTransfer").innerHTML = "<a href=\"#\" onclick=\"mainxfer_send_redirect('XfeRLOCAL','" + lastcustchannel + "','" + lastcustserverip + "');return false;\"><IMG SRC=\"../agc/images/cn/vdc_XB_blindtransfer_cn.gif\" border=0 alt=\"盲转\" style=\"vertical-align:middle\"></a>";
	}

	if(Xfer_Dial_With_Customer_Display=='Y')
	{
		document.getElementById("DialWithCustomer").innerHTML ="<IMG SRC=\"../agc/images/cn/vdc_XB_dialwithcustomer_OFF_cn.gif\" border=0 alt=\"不挂断拨号\" style=\"vertical-align:middle\">";
	}
	document.getElementById("ParkCustomerDial").innerHTML ="<IMG SRC=\"../agc/images/cn/vdc_XB_parkcustomerdial_OFF_cn.gif\" border=0 alt=\"保持客户拨号\" style=\"vertical-align:middle\"></a>";
	target_arr_sore();
}
function threeCall(){
	if(Fast_Hangup_Xferline_And_Grab_Custline=='N')
	{
		document.getElementById("HangupXferLine").innerHTML ="<a href=\"#\" onclick=\"confirm_xfercall_send_hangup();return false;\"><IMG SRC=\"../agc/images/cn/vdc_XB_hangupxferline_cn.gif\" border=0 alt=\"挂断第三方转接线\" style=\"vertical-align:middle\"></a>";
    }
	else
	{
		document.getElementById("HangupXferLine").innerHTML ="<a href=\"#\" onclick=\"confirm_xfercall_send_hangup();return false;\"><IMG SRC=\"../agc/images/cn/vdc_XB_hangupxferline_cn_ehsn.gif\" border=0 alt=\"挂断第三方转接线\" style=\"vertical-align:middle\"></a>";
	}
    document.getElementById("HangupBothLines").innerHTML ="<a href=\"#\" onclick=\"confirm_bothcall_send_hangup();return false;\"><IMG SRC=\"../agc/images/cn/vdc_XB_hangupbothlines_cn.gif\" border=0 alt=\"全部挂断\" style=\"vertical-align:middle\"></a>";
	document.getElementById("Leave3WayCall").innerHTML ="<a href=\"#\" onclick=\"confirm_leave_3way_call();return false;\"><IMG SRC=\"../agc/images/cn/vdc_XB_leave3waycall_cn.gif\" border=0 alt=\"离开三方通话\" style=\"vertical-align:middle\"></a>";
}
function tranferClick(){
	if(Fast_Hangup_Xferline_And_Grab_Custline=='N')
	{
		document.getElementById("HangupXferLine").innerHTML ="<a href=\"#\" onclick=\"confirm_xfercall_send_hangup();return false;\"><IMG SRC=\"../agc/images/cn/vdc_XB_hangupxferline_cn.gif\" border=0 alt=\"挂断第三方转接线\" style=\"vertical-align:middle\"></a>";
    }
	else
	{
		document.getElementById("HangupXferLine").innerHTML ="<a href=\"#\" onclick=\"confirm_xfercall_send_hangup();return false;\"><IMG SRC=\"../agc/images/cn/vdc_XB_hangupxferline_cn_ehsn.gif\" border=0 alt=\"挂断第三方转接线\" style=\"vertical-align:middle\"></a>";
	}
    document.getElementById("HangupBothLines").innerHTML ="<IMG SRC=\"../agc/images/cn/vdc_XB_hangupbothlines_OFF_cn.gif\" border=0 alt=\"全部挂断\" style=\"vertical-align:middle\">";
	document.getElementById("Leave3WayCall").innerHTML ="<IMG SRC=\"../agc/images/cn/vdc_XB_leave3waycall_OFF_cn.gif\" border=0 alt=\"离开三方通话\" style=\"vertical-align:middle\">";
}
function target_check(){
	
	document.getElementById("xferoverride").checked = "true";
	overrideclick();

}
function agent_check(){
	document.getElementById("consultativexfer").checked = "true";
	agentclick();
}
function agent_check2(){
	document.getElementById("consultativexfer").checked = "true";
	agentclick();
}
function agent_check3(){
	document.getElementById("xferoverride").checked = "true";
	overrideclick();
}
function agent_check4(){
	document.getElementById("xferoverrideaaa").checked = "true";
	trasfertargetclick();
}
function vmclick(){
 	document.getElementById("overrideinput").innerHTML = '<input type="text" size="12"  maxlength="25" value="" style="margin-left:10px">';
	document.getElementById("agentinput").innerHTML = '<input type="text" size="12" name="xfernumber" id="xfernumber" readonly="true" maxlength="25" value="" style="margin-left:19px">';
 
	if(Xfer_Blind_Display=='Y')
	{
		document.getElementById("DialBlindTransfer").innerHTML = "<a href=\"#\" onclick=\"mainxfer_send_redirect('XfeRVMAIL','" + lastcustchannel + "','" + lastcustserverip + "');return false;\"><IMG SRC=\"../agc/images/cn/vdc_XB_blindtransfer_cn.gif\" border=0 alt=\"盲转\" style=\"vertical-align:middle\"></a>";
	}

	if(Xfer_Dial_With_Customer_Display=='Y')
	{
		document.getElementById("DialWithCustomer").innerHTML ="<IMG SRC=\"../agc/images/cn/vdc_XB_dialwithcustomer_OFF_cn.gif\" border=0 alt=\"不挂断拨号\" style=\"vertical-align:middle\">";
	}
	document.getElementById("ParkCustomerDial").innerHTML ="<IMG SRC=\"../agc/images/cn/vdc_XB_parkcustomerdial_OFF_cn.gif\" border=0 alt=\"保持客户拨号\" style=\"vertical-align:middle\"></a>";
}
if(CalL_XC_a_NuMber != ""){
	document.getElementById("preset_num").innerHTML = '&nbsp;<a href="#" onClick="target_check();DtMf_PreSet_a();return false;">服务评分</a> &nbsp;';
}
if(CalL_XC_b_NuMber != ""){
	document.getElementById("preset_num").innerHTML = document.getElementById("preset_num").innerHTML + '<a href="#" onClick="target_check();DtMf_PreSet_b();return false;">D2</a> &nbsp;';
}
if(CalL_XC_c_NuMber != ""){
	document.getElementById("preset_num").innerHTML = document.getElementById("preset_num").innerHTML + '<a href="#" onClick="target_check();DtMf_PreSet_c();return false;">D3</a> &nbsp;';
}
if(CalL_XC_d_NuMber != ""){
	document.getElementById("preset_num").innerHTML = document.getElementById("preset_num").innerHTML + '<a href="#" onClick="target_check();DtMf_PreSet_d();return false;">D4</a> &nbsp;';
}
if(CalL_XC_e_NuMber != ""){
	document.getElementById("preset_num").innerHTML = document.getElementById("preset_num").innerHTML + '<a href="#" onClick="target_check();DtMf_PreSet_e();return false;">D5</a> &nbsp;';
}
if(CalL_XC_a_NuMber != "" || CalL_XC_b_NuMber != "" || CalL_XC_c_NuMber != "" || CalL_XC_d_NuMber != "" || CalL_XC_e_NuMber != "" ){
	document.getElementById("preset_num").style.marginLeft = "79px";
}
function target_arr_sore(){
	var loop_ct = 0;
	var live_XfeR_HTML = '';
	var XfeR_SelecT = '';
	while (loop_ct < XFgroupCOUNT)
	{
		if (VARxfergroups[loop_ct].match(/AGENTDIRECT/))
		{
			
			
		}else{
			if (VARxfergroups[loop_ct] == LIVE_default_xfer_group)
			{XfeR_SelecT = 'selected ';}
			else {XfeR_SelecT = '';}
			live_XfeR_HTML = live_XfeR_HTML + "<option " + XfeR_SelecT + "value=\"" + VARxfergroups[loop_ct] + "\">" + VARxfergroups[loop_ct] + " - " + VARxfergroupsnames[loop_ct] + "</option>\n";
			
			
		}
		loop_ct++;
	}
	var loop_ct = 0;
	while (loop_ct < XFgroupCOUNT)
	{
		if (VARxfergroups[loop_ct].match(/AGENTDIRECT/))
		{
			if (VARxfergroups[loop_ct] == LIVE_default_xfer_group)
			{XfeR_SelecT = 'selected ';}
			else {XfeR_SelecT = '';}
			live_XfeR_HTML = live_XfeR_HTML + "<option " + XfeR_SelecT + "value=\"" + VARxfergroups[loop_ct] + "\">" + VARxfergroups[loop_ct] + " - " + VARxfergroupsnames[loop_ct] + "</option>\n";
			
			
		}
		loop_ct++;
	}
	document.getElementById("XfeRGrouPLisT").innerHTML = "<select size=1 name=XfeRGrouP  id=XfeRGrouP onChange=\"XferAgentSelectLink();return false;\">" + live_XfeR_HTML + "</select>";
}
//add by bear用于在转接面版中按“不挂断拨号”或“保持客户拨号”时检查话务员或者外线号码是否为空
function DialWithCustomerClick(type){
	
	var manual_number_temp = document.getElementById("xfernumber").value;
	var manual_string_temp = manual_number_temp.toString();
	if (manual_string_temp.length == 0){
		if(document.getElementById("consultativexfer").checked){
			alert("请先选择话务员！");
		}else{
			alert("请先输入外线号码！");
		}
		return false;
	}else{
		if(!check_dnc(manual_string_temp,1,3,"")){//add by akin
			return false;
		}//end
		getCallStatus();
		if(type==1){
			//不挂断拨号时调用
			SendManualDial('YES');
		}else{
			//保持客户拨号时调用
			xfer_park_dial();
		}
	}
}

function getCallStatus(){
	tranferClick();
	var transferType = null;
	var xfercheck = document.getElementById("consultativexfer").checked;
	//alert(xfercheck);
	if(xfercheck){
		transferType = "agent";
	}else{
		transferType = "out";
	}
	//alert(transferType);
	var transferNum = document.getElementById("xfernumber").value;
	//setTimeout("transferTarget('"+transferType+"','"+transferNum+"')", 1000);
	transferTarget(transferType,transferNum);
}
//用于停止transferTarget和transferTargetStart轮询函数 + fnatic

function stopCount_all()
{ //alert(1);
clearTimeout(transferTarget_t) ;
clearTimeout(transferTargetStart_t) ;
} 
//结束

function transferTarget(transferType,transferNum)
{
	//alert(transferType);
	var xmlHttp = false;
	var result;
	if(window.ActiveXObject){ xmlHttp = new ActiveXObject("Microsoft.XMLHTTP"); }
	else if(window.XMLHttpRequest){ xmlHttp = new XMLHttpRequest(); }
	if(xmlHttp){
		var queryString =  "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ACTION=CallingStatus&campaign=" + campaign + "&format=text&transferTarget="+transferType+"&transferNum="+transferNum;
		//alert(queryString);
		xmlHttp.open("POST", "vdc_db_query.php", true);
		xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
		xmlHttp.send(queryString);
		xmlHttp.onreadystatechange = function() {
			if (xmlHttp.readyState == 4 && xmlHttp.status == 200) 
			{
				//alert(xmlHttp.responseText);
				var DLcounT = xmlHttp.responseText;
				if(DLcounT > 0){
					if(transferType == "agent"){
						threeCall();
					}else{
						//setTimeout("transferTargetStart('"+transferType+"','"+transferNum+"')", 1000);
						transferTargetStart(transferType,transferNum);
					}
				}else{
					//alert(DLcounT);
					transferTarget_t = setTimeout("transferTarget('"+transferType+"','"+transferNum+"')", 1000);
				}
				xmlhttp = null;
				CollectGarbage();
			}
		};
	
		delete xmlHttp;
	}
}
//var xfercall_tmp = 0;
function transferTargetStart(transferType,transferNum)
{	//alert(1);
	var xmlHttp = false;
	var result;
	if(window.ActiveXObject){ xmlHttp = new ActiveXObject("Microsoft.XMLHTTP"); }
	else if(window.XMLHttpRequest){ xmlHttp = new XMLHttpRequest(); }
	if(xmlHttp){
		var queryString =  "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ACTION=CallingStatus&campaign=" + campaign + "&format=text&transferTarget="+transferType+"&start=1&transferNum="+transferNum;
		//alert(queryString);
		xmlHttp.open("POST", "vdc_db_query.php", true);
		xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
		xmlHttp.send(queryString);
		xmlHttp.onreadystatechange = function() {
			if (xmlHttp.readyState == 4 && xmlHttp.status == 200) 
			{
			//	alert(xmlhttp.responseText);
				var DLcounT = xmlHttp.responseText;
			//	alert(DLcounT);
				if(DLcounT > 0){
					//alert('no answer');
					transferTargetStart_t = setTimeout("transferTargetStart('"+transferType+"','"+transferNum+"')", 1000);
				}else{
					//alert('three call');
					//alert(DLcounT);
					//if(xfercall_tmp == 0){
						threeCall();
					//}else{
					//	xfercall_tmp = 0;
					//}
					
				}
				xmlhttp = null;
				CollectGarbage();
			}
		};
	
		delete xmlHttp;
	}
}
//TransferMain@20110104 end

//agent拨号前检查号码是否为黑名单，如果不存在于黑名单，按type后续操作  add by akin
function check_dnc(phone_number,system_st,type,var_str){
	if(phone_number == ""){
		phone_number = document.getElementById("xfernumber").value;
	}
	
	var xmlhttp = false;
	try{
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	}catch(e){
		try{
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}catch(E){
			xmlhttp = false;
		}
	}

	if (!xmlhttp && typeof XMLHttpRequest!='undefined'){
		xmlhttp = new XMLHttpRequest();
	}
	if (xmlhttp){
		var VMCoriginate_query;
		VMCoriginate_query = "phone_number="+phone_number+"&system_st="+system_st+"&type=0";
		xmlhttp.open('POST', 'check_dnc.php',false); 
		xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
		xmlhttp.send(VMCoriginate_query); 
		xmlhttp.onreadystatechange = function(){}
		 
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
			var return_str;
			return_str = xmlhttp.responseText;
			if(return_str.substring(0,3) == "DNC"){
				alert("此号码存在于黑名单中"+xmlhttp.responseText);
				//if(type == "1"){
//					if(confirm("是否将号码"+phone_number+"移除个人回拨列表？")){
//						delete_from_callback_list(phone_number);
//					}
//				}
				delete xmlHttp;
				return false;
			}
			else{
				var var_array=new Array();
				var_array = var_str.split(",");
				if(type == "1"){//个人回拨
					new_callback_call_vtiger_search(var_array[0],var_array[1],var_array[2]);
				}
				else if(type == "2"){
					mainxfer_send_redirect(var_array[0],var_array[1],var_array[2])
				}
				else if(type == "3" ){//不挂断拨号或保持客户通话拨号
					//do nothing
				}
				delete xmlHttp;
				return true;
			}
		}
	}
}


//删除agent的个人回拨列表  add by akin
function delete_from_callback_list(phone_number){
	var xmlhttp=false;
	try {
	  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
		   xmlhttp = false;
		}
	}
	if (!xmlhttp && typeof XMLHttpRequest!='undefined'){
		xmlhttp = new XMLHttpRequest();
	}
	if (xmlhttp){
		var VMCoriginate_query;
		VMCoriginate_query = "phone_number="+phone_number+"&type=del";
		xmlhttp.open('POST', 'check_dnc.php'); 
		xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
		xmlhttp.send(VMCoriginate_query); 
		xmlhttp.onreadystatechange = function(){ 
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
				var return_str;
				return_str = xmlhttp.responseText;
				if(return_str.substring(0,7) == "SUCCESS"){
					alert("移除成功");
					CalLBacKsLisTCheck();
				}
				else{
					alert("移除失败！");
				}
				xmlhttp = null;
				CollectGarbage();
			}
		}
	}

}

//过滤显示号码中多余的字符 by akin
function status_display_number_(status_display_number){
    return status_display_number.replace(/^\s*\d*\*|\*.*\s*$/g,'');
}

function check_xfre_update(xfre_action){
	if(xfre_action == 'start'){transfer_Xfre_Value = 0;}
	if(Xfer_Target_Unavailable_Update_Enable_Count >= 1){
		var xmlhttp=false;
		try {
			xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (E) {
			   xmlhttp = false;
			}
		}
		if (!xmlhttp && typeof XMLHttpRequest!='undefined'){
			xmlhttp = new XMLHttpRequest();
		}
		if (xmlhttp){
			var queryString =  "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ACTION=XferUpdate&campaign=" + campaign + "&uniqueid=" + document.vicidial_form.uniqueid.value + "&xfre_action=" + xfre_action + "&transfer_Xfre_Value=" + transfer_Xfre_Value;
			xmlhttp.open('POST', 'vdc_db_query.php'); 
			xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
			xmlhttp.send(queryString); 
			xmlhttp.onreadystatechange = function(){ 
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
					var return_str;
					return_str = xmlhttp.responseText;
					get_transfer_Xfre_Value(xmlhttp.responseText);
				}
			}
		}
	}
}

function get_transfer_Xfre_Value(xmlhttp_responseText){
	var return_transfer_Xfre_Valuearray = xmlhttp_responseText.split("||");
	for(var i=0;i<return_transfer_Xfre_Valuearray.length;i++){
		if(return_transfer_Xfre_Valuearray[i].indexOf("transfer_Xfre_Value") == 0){
			if(return_transfer_Xfre_Valuearray[i].match(/\d/) != null){
				transfer_Xfre_Value = return_transfer_Xfre_Valuearray[i].match(/\d/);
			}
		}
	}
}

//弹出修改密码框 by fox
$( "#dialog-password" ).dialog({
			autoOpen: false,
			height: 155,
			width: 280,
			modal: true,
			draggable:false,	
			resizable:false,
			close: function() {
				
			}
		});
		


	function changepassword(){
	
		if (MD_channel_look==1)
			{alert("拨号过程中无法修改密码!");}
		else
			{
			if (VD_live_customer_call==1)
				{
				alert("电话仍在通话中,请先挂断再修改密码！");
				}
			else
				{
				if (alt_dial_status_display==1)
					{
					alert("You are in ALT dial mode, you must finish the lead before logging out.\n" + reselect_alt_dial);
					}
				else
					{
						if (VDRP_stage != 'PAUSED'){
							alert("请先暂停才可以修改密码！");
						}else{
							try{
								$( "#dialog-password" ).dialog( "open" );
							}catch(err){
								$( "#dialog-password" ).dialog( "open" );
							}
						}
					}
				}
			}
			
		}
function closedialog(){
	$( "#dialog-password" ).dialog( "close" );
}
function change_pass(){
	if($( "#old_password" ).val()=="" || $( "#new_password1" ).val()=="" || $( "#new_password2" ).val()==""){
		alert("密码不能为空！");
	}else{
		var para = "name=" + user + "&old_password=" + $( "#old_password" ).val() + "&new_password1=" + $( "#new_password1" ).val() + "&new_password2=" + $( "#new_password2" ).val() + "&action=modify_password&campaign_id=" + campaign;
		//alert(para);
		$.post("check_user.php", para,
		function(data){
			if(data == "1"){
				alert("旧密码不对，请重新输入！");
			}else if(data == "2"){
				alert("新密码不统一，请重新输入！");
			}else if(data == "3"){
				alert("新密码长度在2到10之间！");
			}else if(data == "4"){
				alert("新密码只允许输入数字和字母类型！");
			}else{
				alert("修改成功，请重新登陆！");
				$( "#dialog-password" ).dialog( "close" );
				NormalLogout();
			}
		});
	}
				
}

//fox
function showNotice(id)
		{
			//alert(id);
			var xmlHttp = false;
			var result;
			if(window.ActiveXObject){ xmlHttp = new ActiveXObject("Microsoft.XMLHTTP"); }
			else if(window.XMLHttpRequest){ xmlHttp = new XMLHttpRequest(); }
			if(xmlHttp){
				var data =  "id=" + id;
				//alert(queryString);
				xmlHttp.open("POST", "../getNotice.php", true);
				xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
				xmlHttp.send(data);
				xmlHttp.onreadystatechange = function() {
					if (xmlHttp.readyState == 4 && xmlHttp.status == 200) 
					{
					//	alert(xmlhttp.responseText);
						var DLcounT = xmlHttp.responseText;
						//alert(DLcounT);
						document.getElementById("noticeContent").innerHTML=DLcounT;
						xmlhttp = null;
						CollectGarbage();
					}
				};
			
				delete xmlHttp;
			}
			showDiv('noticeContent');
 		    $('#shownotice').dialog
				({
                     autoOpen:false,
                     draggable:false,
                     resizable:false,
                     title:'公告',
                     height:450,
                     width:950,
                     modal:true,
					 close:function()
				     {
					   hideDiv('noticeContent');
					 }
		         });
			$('#shownotice').dialog('open');
			
		}



</script>
<script>
var para = "name="+user+"&action=check_user_login";
//alert(para);
$.post("check_user.php", para,
function(data){
    if(data == "0"){
        $( "#dialog-password" ).dialog( "open" );
    }
});
volume_display_value(Volume_original);
</script>




<div id="dialog-confirm" title="详细信息">
<iframe id="webaddress" src="" width="780" height="1"></iframe>
</div>
</body>
</html>

