<?php
# admin.php - CCMS administration page
#
# Copyright (C) 2010  Matt Florell <vicidial@gmail.com>    LICENSE: AGPLv2
# 
session_start();
require("dbconnect.php");
require("function_util.php");
######################################################################################################
######################################################################################################
#######   static variable settings for display options
######################################################################################################
######################################################################################################

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


if (isset($_GET["ADD"]))			{$ADD=$_GET["ADD"];}
	elseif (isset($_POST["ADD"]))	{$ADD=$_POST["ADD"];}

	


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




##### END VARIABLE FILTERING FOR SECURITY #####


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

$stmt="SELECT count(*) from vicidial_users where user='$PHP_AUTH_USER' and pass='$PHP_AUTH_PW' and user_level >= 5 and active='Y';";
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
		$stmt="SELECT user_id,user,pass,full_name,user_level,user_group,phone_login,phone_pass,delete_users,delete_user_groups,delete_lists,delete_campaigns,delete_ingroups,delete_remote_agents,load_leads,campaign_detail,ast_admin_access,ast_delete_phones,delete_scripts,modify_leads,hotkeys_active,change_agent_campaign,agent_choose_ingroups,closer_campaigns,scheduled_callbacks,agentonly_callbacks,agentcall_manual,vicidial_recording,vicidial_transfers,delete_filters,alter_agent_interface_options,closer_default_blended,delete_call_times,modify_call_times,modify_users,modify_campaigns,modify_lists,modify_scripts,modify_filters,modify_ingroups,modify_usergroups,modify_remoteagents,modify_servers,view_reports,vicidial_recording_override,alter_custdata_override,qc_enabled,qc_user_level,qc_pass,qc_finish,qc_commit,add_timeclock_log,modify_timeclock_log,delete_timeclock_log,alter_custphone_override,vdc_agent_api_access,modify_inbound_dids,delete_inbound_dids,active,alert_enabled,download_lists,agent_shift_enforcement_override,manager_shift_enforcement_override,shift_override_flag,export_reports,delete_from_dnc,email,user_code,territory,allow_alerts,add_new_users,add_new_campaigns,add_new_lists,add_new_usergroups,add_from_dnc,view_historical_reports,live_monitor,search_historical_call,search_voice_mail from vicidial_users where user='$PHP_AUTH_USER' and pass='$PHP_AUTH_PW';";
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
if ($ADD==11)			{$hh='campaigns';	$sh='basic';}
if ($ADD==12)			{$hh='campaigns';	$sh='basic';}
if ($ADD==111)			{$hh='lists';}
if ($ADD==121)			{$hh='lists';}
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
if ($ADD==999999 || $ADD==9999991 || $ADD==201211161052|| $ADD==201211151704|| $ADD==201211200945|| $ADD==201211151027 || $ADD==201211151034|| $ADD==201211131535|| $ADD==201211131143)		{$hh='reports';}

### Add by fnatic start ###
if($ccms_admin_modules=='list_leads') { $hh='lists';}
if($ccms_admin_modules=='vtigercrm') { $hh='admin';}
if($ccms_admin_modules=='search_call_log') { $hh='Monitor';}

if($ccms_admin_modules=='search_voice_mail') { $hh='Monitor';}
if($ccms_admin_modules=='live_monitor') { $hh='Monitor';}
### Add by fnatic end


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
	<BR>
	<A NAME="vicidial_campaigns-use_campaign_dnc">
	<BR>
	<B>Use Campaign DNC List -</B> This defines whether this campaign is to filter leads against a DNC list that is specific to that campaign only. If it is set to Y, the hopper will look for each phone number in the campaign-specific DNC list before placing it in the hopper. If it is in the campaign-specific DNC list then it will change that lead status to DNCC so it cannot be dialed. Default is N. The AREACODE option is just like the Y option, except it is used to also filter out an entire area code in North America from being dialed, in this case using the 201XXXXXXX entry in the DNC list would block all calls to the 201 areacode if enabled.

	<BR><BR><BR><BR><BR><BR><BR><BR>
	<BR><BR><BR><BR><BR><BR><BR><BR>
	THE END
	</TD></TR></TABLE></BODY></HTML>
	<?php
	exit;

	#### END HELP SCREENS
	}


######################################################################################################
######################################################################################################
#######   7 series, filter count preview and script preview
######################################################################################################
######################################################################################################




$ADMIN=$PHP_SELF;
require("admin_header.php");




######################
# ADD=550 user search form
######################

if ($ADD==550)
	{
	echo "<TABLE><TR><TD>\n";
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	echo "<br>SEARCH FOR A USER<form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=660>\n";
	echo "<center><TABLE width=$section_width cellspacing=3>\n";
	echo "<tr bgcolor=#FFFFFF><td align=right>User Number: </td><td align=left><input type=text name=user size=20 maxlength=20></td></tr>\n";
	echo "<tr bgcolor=#FFFFFF><td align=right>Full Name: </td><td align=left><input type=text name=full_name size=30 maxlength=30></td></tr>\n";
	echo "<tr bgcolor=#FFFFFF><td align=right>User Level: </td><td align=left><select size=1 name=user_level>";
	$user_level_arr = array("5"=>"Agent","6"=>"QA","7"=>"Supervisor","8"=>"Manager","9"=>"Admin");
	foreach($user_level_arr as $k=>$v){
		if($k<=$LOGuser_level){
			echo "<option value=\"".$k."\">" . $v . "</option>";
		}
	}
	echo "</select></td></tr>\n";
	echo "<tr bgcolor=#FFFFFF><td align=right>User Group: </td><td align=left><select size=1 name=user_group>\n";
  
  /*comment by heibo 2011-4-22 9:37:47 缁熶竴鎴愪竴涓嚱鏁?	if($LOGuser_level==9){
		$stmt="SELECT user_group,group_name from vicidial_user_groups order by user_group";
	}else{
		$stmt="SELECT user_group,group_name from vicidial_user_groups where supervisor='$LOGuser_name_id' or manager='$LOGuser_name_id' order by user_group";
	}
	*/
	$stmt = getUserGroupsList($LOGuser_level,$LOGuser_name_id,1);
	$rslt=mysql_query($stmt, $link);
	$groups_to_print = mysql_num_rows($rslt);
	$o=0;
	$groups_list='';
	while ($groups_to_print > $o) 
		{
		$rowx=mysql_fetch_row($rslt);
		$groups_list .= "<option value=\"$rowx[0]\">$rowx[0] - $rowx[1]</option>\n";
		$o++;
		}
	echo "$groups_list</select></td></tr>\n";

	echo "<tr bgcolor=#FFFFFF><td align=center colspan=2><input type=submit name=search value=search></td></tr>\n";
	echo "</TABLE></center>\n";
	}



######################
# ADD=0 display all active users
######################
### Mod by fnatic if ($ADD==0)



if ($ADD==9999991)
{
	require("History_Report_Menu_CH.php");
}
?>




<?php

$ENDtime = date("U");

$RUNtime = ($ENDtime - $STARTtime);


################ vtigercrm module ############
if($ccms_admin_modules=='vtigercrm')
  {
   //$stmt="SELECT vtiger_url from system_settings;";
   if(empty($campaign_id)){
		$stmt = getCampaignSql($LOGuser_level,$LOGuser_name_id);
   }else{
		$stmt = "SELECT campaign_id,campaign_name,active,dial_method,auto_dial_level,lead_order,dial_statuses,vtiger_url,enable_vtiger_integration from vicidial_campaigns where campaign_id='$campaign_id'";
   }
   $rslt=mysql_query($stmt, $link);
   $row=mysql_fetch_row($rslt);
   $vtiger_url = $row[7];	
   $VtigeRall = $vtiger_url."/index.php?module=Users&action=Authenticate&return_module=Users&return_action=Login&user_name=".$PHP_AUTH_USER."&user_password=" .$PHP_AUTH_PW."&login_theme=softed"; 
   //echo $VtigeRall;exit;
?>

<TABLE></TR><TD>

<script type="text/javascript"> 
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
</script> 

<center><iframe id="module_iframe" src="<?php echo $VtigeRall;?>" name="module_iframe"  width="1000px" onload="SetCwinHeight(this)"  frameborder="0" ></iframe></center>

<?php } 
if($ccms_admin_modules=='search_call_log'){
?>

<TABLE></TR><TD>
<?php
	if ($LOGsearch_historical_call==1){
?>

<center><iframe id="module_iframe" src="./search_call_log.php" name="search_call_log"  width="1000px" onload="SetIframeHeight(this)"  frameborder="0" scrolling="no"></iframe></center>
<?php
	}else{
		echo "You do not have permission to view this page\n";
?>

<?php }}
if($ccms_admin_modules=='performance_report'){
	if ($LOGast_admin_access==1)
		{
?>
<TABLE></TR><TD>
<center><iframe id="module_iframe" src="./AST_server_performance.php" name="AST_server_performance"  width="900px" height="800px"  frameborder="0" ></iframe></center>

<?php 
		}
	else
		{
		echo "You do not have permission to view this page\n";
		exit;
		}
} 
if($ccms_admin_modules=='list_leads'){
	if (isset($_GET["vtiger_url"]))					{$vtiger_url=$_GET["vtiger_url"];}	
	elseif (isset($_POST["vtiger_url"]))			{$vtiger_url=$_POST["vtiger_url"];}
	
	if (isset($_GET["vtiger_type"]))					{$vtiger_type=$_GET["vtiger_type"];}	
	elseif (isset($_POST["vtiger_type"]))			{$vtiger_type=$_POST["vtiger_type"];}
	if($vtiger_type == 1){
		$vtiger_leads_url = "$vtiger_url/index.php?authbypara=true&user_name=$PHP_AUTH_USER&user_password=$PHP_AUTH_PW&module=Leads&action=Import&step=1&return_module=Leads&return_action=index&parenttab=My Home Page";
	}else if($vtiger_type == 2){
		$vtiger_leads_url = "$vtiger_url/index.php?authbypara=true&user_name=$PHP_AUTH_USER&user_password=$PHP_AUTH_PW&module=Leads&action=Import&step=1&return_module=Leads&return_action=index&parenttab=My Home Page";
		$vtiger_leads_url = "$vtiger_url/index.php?authbypara=true&user_name=$PHP_AUTH_USER&user_password=$PHP_AUTH_PW&action=ListView&module=Leads&parenttab=My Home Page";
	}else if($vtiger_type == 3){
		$vtiger_leads_url = "$vtiger_url/index.php?authbypara=true&user_name=$PHP_AUTH_USER&user_password=$PHP_AUTH_PW&action=ListView&module=Leads&parenttab=My Home Page";
	}else{
		$vtiger_leads_url = "$vtiger_url/index.php?authbypara=true&user_name=$PHP_AUTH_USER&user_password=$PHP_AUTH_PW&action=ListView&module=Leads&parenttab=My Home Page";
	}
?>
<TABLE></TR><TD>
<center><iframe id="module_iframe" src="<?php echo $vtiger_leads_url; ?>" width="950px" height="800px"  frameborder="0" ></iframe></center>
<?php
}
if($ccms_admin_modules=='search_voice_mail'){
?>

<TABLE></TR><TD>
<?php
	if ($LOGsearch_voice_mail==1){
?>
<center><iframe id="module_iframe" src="./search_voice_mail.php" name="search_voice_mail"  width="750px"  onload="SetIframeHeight(this)"  frameborder="0" scrolling="no"></iframe></center>
<?php
	}else{
		echo "You do not have permission to view this page\n";
?>
<?php
}}
if($ccms_admin_modules=='live_monitor'){
	echo "You do not have permission to view this page\n";
}
?>

</TD></TR></TABLE>

<?php 
if ($ADD!=999999){ ?>
</div>
<?php } ?>

<b class="xbottom"><b class="xb4"></b><b class="xb3"></b><b class="xb2"></b><b class="xb1"></b></b>
</div></td></tr></table></div><div id="clear"></div></div></td></tr></table></center>
<?php
//echo "<TR><TD BGCOLOR=#FFFFFF ALIGN=CENTER>\n";
//echo "<font size=0 color=black><br><br><!-- RUNTIME: $RUNtime seconds<BR> -->";
//echo "VERSION: $admin_version<BR>";
//echo "BUILD: $build</font>\n";

exit;

?>      