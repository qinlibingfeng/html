<?php 
# AST_timeonVDADall.php
# 
# Copyright (C) 2010  Matt Florell <vicidial@gmail.com>    LICENSE: AGPLv2
#
# live real-time stats for the CCMS Auto-Dialer all servers
#
# STOP=4000, SLOW=40, GO=4 seconds refresh interval
# 
# CHANGELOG:
# 50406-0920 - Added Paused agents < 1 min
# 51130-1218 - Modified layout and info to show all servers in a CCMS system
# 60421-1043 - check GET/POST vars lines with isset to not trigger PHP NOTICES
# 60511-1343 - Added leads and drop info at the top of the screen
# 60608-1539 - Fixed CLOSER tallies for active calls
# 60619-1658 - Added variable filtering to eliminate SQL injection attack threat
#            - Added required user/pass to gain access to this page
# 60626-1453 - Added display of system load to bottom (Angelito Manansala)
# 60901-1123 - Changed display elements at the top of the screen
# 60905-1342 - Fixed non INCALL|QUEUE timer column
# 61002-1642 - Added TRUNK SHORT/FILL stats
# 61101-1318 - Added SIP and IAX Listen and Barge links option
# 61101-1647 - Added Usergroup column and user name option as well as sorting
# 61102-1155 - Made display of columns more modular, added ability to hide server info
# 61215-1131 - Added answered calls and drop percent taken from answered calls
# 70111-1600 - Added ability to use BLEND/INBND/*_C/*_B/*_I as closer campaigns
# 70123-1151 - Added non_latin options for substr in display variables, thanks Marin Blu
# 70206-1140 - Added call-type Call Result to display(A-Auto, M-Manual, I-Inbound/Closer)
# 70619-1339 - Added Status Category tally display
# 71029-1900 - Changed CLOSER-type to not require campaign_id restriction
# 80227-0418 - Added priority to waiting calls display
# 80311-1550 - Added calls_today on all agents and wait time/in-group for inbound calls
# 80422-0033 - Added phonediaplay option, allow for toggle-sorting on sortable fields
# 80422-1001 - Fixed sort by phone login
# 80424-0515 - Added non_latin lookup from system_settings
# 80525-1040 - Added IVR status display and summary for inbound calls
# 80619-2047 - Added DISPO status for post-call-work while paused
# 80704-0543 - Added DEAD status for agents INCALL with no live call
# 80822-1222 - Added option for display of customer phone number
# 81011-0335 - Fixed remote agent display bug
# 81022-1500 - Added inbound call stats display option
# 81029-1023 - Changed drop percent calculation for multi-stat reports
# 81029-1706 - Added pause code display if enabled per campaign
# 81108-2337 - Added inbound-only section
# 90105-1153 - Changed monitor links to use 0 prefix instead of 6
# 90202-0108 - Changed options to pop-out frame, added outbound_autodial_active option
# 90310-0906 - Added admin header
# 90428-0727 - Changed listen and barge to use the API and manager must enter phone
# 90508-0623 - Changed to PHP long tags
# 90518-0930 - Fixed $CALLSdisplay static assignment bug for some links(bug #210)
# 90524-2231 - Changed to use functions.php for seconds to HH:MM:SS conversion
# 90602-0405 - Added list mix display in Call Result and order if active
# 90603-1845 - Fixed color coding bug
# 90627-0608 - Some Formatting changes, added in-group name display
# 90701-0657 - Fixed inbound=No calculation issues
# 90808-0212 - Fixed inbound only non-ALL bug, changed times to use agent last_state_change
# 90907-0915 - Added PARK status
# 90914-1154 - Added AgentOnly display column to waiting calls section
# 91102-2013 - Changed in-group color styles for incoming calls waiting
# 91204-1548 - Added ability to change agent in-groups and blended
# 100214-1127 - Added no-dialable-leads alert and in-groups stats option
# 100301-1229 - Added 3-WAY status for consultative transfer agents
# 100303-0930 - Added carrier stats display option
#

$version = '2.2.0-52';
$build = '100303-0930';

header ("Content-type: text/html; charset=utf-8");

require("dbconnect.php");
//require("dbconnect_report.php");
require("functions.php");
require("function_util.php");
require("voicemail_search/func.php");
require("voicemail_search/config.php");

$PHP_AUTH_USER=$_SERVER['PHP_AUTH_USER'];
$PHP_AUTH_PW=$_SERVER['PHP_AUTH_PW'];
$PHP_SELF=$_SERVER['PHP_SELF'];

if (isset($_GET["server_ip"]))			{$server_ip=$_GET["server_ip"];}
	elseif (isset($_POST["server_ip"]))	{$server_ip=$_POST["server_ip"];}
if (isset($_GET["RR"]))					{$RR=$_GET["RR"];}
	elseif (isset($_POST["RR"]))		{$RR=$_POST["RR"];}
//获取“降速”--start--;
if (isset($_GET["RF"]))					{$RF=$_GET["RF"];} 
	elseif (isset($_POST["RF"]))		{$RF=$_POST["RF"];}
if(!isset($RF))								{$RF='false';}
//获取“降速”--end--;

if (isset($_GET["inbound"]))			{$inbound=$_GET["inbound"];}
	elseif (isset($_POST["inbound"]))	{$inbound=$_POST["inbound"];}
if (isset($_GET["group"]))				{$group=$_GET["group"];}
	elseif (isset($_POST["group"]))		{$group=$_POST["group"];}
if (isset($_GET["groups"]))				{$groups=$_GET["groups"];}
	elseif (isset($_POST["groups"]))	{$groups=$_POST["groups"];}
if (isset($_GET["usergroup"]))			{$usergroup=$_GET["usergroup"];}
	elseif (isset($_POST["usergroup"]))	{$usergroup=$_POST["usergroup"];}
if (isset($_GET["DB"]))					{$DB=$_GET["DB"];}
	elseif (isset($_POST["DB"]))		{$DB=$_POST["DB"];}
if (isset($_GET["adastats"]))			{$adastats=$_GET["adastats"];}
	elseif (isset($_POST["adastats"]))	{$adastats=$_POST["adastats"];}
if (isset($_GET["submit"]))				{$submit=$_GET["submit"];}
	elseif (isset($_POST["submit"]))	{$submit=$_POST["submit"];}
if (isset($_GET["SUBMIT"]))				{$SUBMIT=$_GET["SUBMIT"];}
	elseif (isset($_POST["SUBMIT"]))	{$SUBMIT=$_POST["SUBMIT"];}
if (isset($_GET["SIPmonitorLINK"]))				{$SIPmonitorLINK=$_GET["SIPmonitorLINK"];}
	elseif (isset($_POST["SIPmonitorLINK"]))	{$SIPmonitorLINK=$_POST["SIPmonitorLINK"];}
if (isset($_GET["IAXmonitorLINK"]))				{$IAXmonitorLINK=$_GET["IAXmonitorLINK"];}
	elseif (isset($_POST["IAXmonitorLINK"]))	{$IAXmonitorLINK=$_POST["IAXmonitorLINK"];}
if (isset($_GET["UGdisplay"]))			{$UGdisplay=$_GET["UGdisplay"];}
	elseif (isset($_POST["UGdisplay"]))	{$UGdisplay=$_POST["UGdisplay"];}
if (isset($_GET["UidORname"]))			{$UidORname=$_GET["UidORname"];}
	elseif (isset($_POST["UidORname"]))	{$UidORname=$_POST["UidORname"];}
if (isset($_GET["orderby"]))			{$orderby=$_GET["orderby"];}
	elseif (isset($_POST["orderby"]))	{$orderby=$_POST["orderby"];}
if (isset($_GET["SERVdisplay"]))			{$SERVdisplay=$_GET["SERVdisplay"];}
	elseif (isset($_POST["SERVdisplay"]))	{$SERVdisplay=$_POST["SERVdisplay"];}
if (isset($_GET["CALLSdisplay"]))			{$CALLSdisplay=$_GET["CALLSdisplay"];}
	elseif (isset($_POST["CALLSdisplay"]))	{$CALLSdisplay=$_POST["CALLSdisplay"];}
if (isset($_GET["PHONEdisplay"]))			{$PHONEdisplay=$_GET["PHONEdisplay"];}
	elseif (isset($_POST["PHONEdisplay"]))	{$PHONEdisplay=$_POST["PHONEdisplay"];}
if (isset($_GET["CUSTPHONEdisplay"]))			{$CUSTPHONEdisplay=$_GET["CUSTPHONEdisplay"];}
	elseif (isset($_POST["CUSTPHONEdisplay"]))	{$CUSTPHONEdisplay=$_POST["CUSTPHONEdisplay"];}
if (isset($_GET["NOLEADSalert"]))			{$NOLEADSalert=$_GET["NOLEADSalert"];}
	elseif (isset($_POST["NOLEADSalert"]))	{$NOLEADSalert=$_POST["NOLEADSalert"];}
if (isset($_GET["DROPINGROUPstats"]))			{$DROPINGROUPstats=$_GET["DROPINGROUPstats"];}
	elseif (isset($_POST["DROPINGROUPstats"]))	{$DROPINGROUPstats=$_POST["DROPINGROUPstats"];}
if (isset($_GET["ALLINGROUPstats"]))			{$ALLINGROUPstats=$_GET["ALLINGROUPstats"];}
	elseif (isset($_POST["ALLINGROUPstats"]))	{$ALLINGROUPstats=$_POST["ALLINGROUPstats"];}
if (isset($_GET["with_inbound"]))			{$with_inbound=$_GET["with_inbound"];}
	elseif (isset($_POST["with_inbound"]))	{$with_inbound=$_POST["with_inbound"];}
if (isset($_GET["monitor_active"]))				{$monitor_active=$_GET["monitor_active"];}
	elseif (isset($_POST["monitor_active"]))	{$monitor_active=$_POST["monitor_active"];}
if (isset($_GET["monitor_phone"]))				{$monitor_phone=$_GET["monitor_phone"];}
	elseif (isset($_POST["monitor_phone"]))		{$monitor_phone=$_POST["monitor_phone"];}
if (isset($_GET["CARRIERstats"]))			{$CARRIERstats=$_GET["CARRIERstats"];}
	elseif (isset($_POST["CARRIERstats"]))	{$CARRIERstats=$_POST["CARRIERstats"];}

if (isset($_GET["report_name"]))			{$report_name=$_GET["report_name"];}
	elseif (isset($_POST["report_name"]))	{$report_name=$_POST["report_name"];}

if (isset($_GET["sumreport"]))			{$sumreport=$_GET["sumreport"];}
	elseif (isset($_POST["sumreport"]))	{$sumreport=$_POST["sumreport"];}

if (isset($_GET["voicemaildisplay"]))			{$voicemaildisplay=$_GET["voicemaildisplay"];}
	elseif (isset($_POST["voicemaildisplay"]))	{$voicemaildisplay=$_POST["voicemaildisplay"];}
if (isset($_GET["inoutdisplay"]))			{$inoutdisplay=$_GET["inoutdisplay"];}
	elseif (isset($_POST["inoutdisplay"]))	{$inoutdisplay=$_POST["inoutdisplay"];}



if($RF=='ture')	
{ 
	$RR = $RR +3;
	if($RR >=30)	{$RR=30;}
}
if ( !isset($sumreport) || empty($sumreport) ){
	   $sumreport = "N";
}

#############################################
##### START SYSTEM_SETTINGS LOOKUP #####
$stmt = "SELECT use_non_latin,outbound_autodial_active FROM system_settings;";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$qm_conf_ct = mysql_num_rows($rslt);
if ($qm_conf_ct > 0)
	{
	$row=mysql_fetch_row($rslt);
	$non_latin =					$row[0];
	$outbound_autodial_active =		$row[1];
	}
##### END SETTINGS LOOKUP #####
###########################################

if (!isset($DB))			{$DB=0;}
if (!isset($RR))			{$RR=3;}


if (!isset($group))			{$group='';}
if (!isset($usergroup))		{$usergroup='';}
if (!isset($UGdisplay))		{$UGdisplay=0;}	# 0=no, 1=yes
if (!isset($UidORname))		{$UidORname=1;}	# 0=id, 1=name
if (!isset($orderby))		{$orderby='timeup';}
if (!isset($SERVdisplay))	{$SERVdisplay=0;}	# 0=no, 1=yes
if (!isset($CALLSdisplay))	{$CALLSdisplay=1;}	# 0=no, 1=yes
if (!isset($PHONEdisplay))	{$PHONEdisplay=0;}	# 0=no, 1=yes
if (!isset($CUSTPHONEdisplay))	{$CUSTPHONEdisplay=0;}	# 0=no, 1=yes
if (!isset($PAUSEcodes))	{$PAUSEcodes='N';}  # 0=no, 1=yes
if (!isset($with_inbound))	
	{
	if ($outbound_autodial_active > 0)
		{$with_inbound='Y';}  # N=no, Y=yes, O=only
	else
		{$with_inbound='O';}  # N=no, Y=yes, O=only
	}
if ( !isset($voicemaildisplay) ) { $voicemaildisplay = 0; }
if ( !isset($inoutdisplay) ) { $inoutdisplay = 0; }
	
$ingroup_detail='';

if (strlen($group)>1) {$groups[0] = $group;  $RR=3;}
else {$group = $groups[0];}


$NOW_TIME = date("Y-m-d H:i:s");
$NOW_DAY = date("Y-m-d");
$NOW_HOUR = date("H:i:s");
$STARTtime = date("U");
$epochONEminuteAGO = ($STARTtime - 60);
$timeONEminuteAGO = date("Y-m-d H:i:s",$epochONEminuteAGO);
$epochFIVEminutesAGO = ($STARTtime - 300);
$timeFIVEminutesAGO = date("Y-m-d H:i:s",$epochFIVEminutesAGO);
$epochFIFTEENminutesAGO = ($STARTtime - 900);
$timeFIFTEENminutesAGO = date("Y-m-d H:i:s",$epochFIFTEENminutesAGO);
$epochONEhourAGO = ($STARTtime - 3600);
$timeONEhourAGO = date("Y-m-d H:i:s",$epochONEhourAGO);
$epochSIXhoursAGO = ($STARTtime - 21600);
$timeSIXhoursAGO = date("Y-m-d H:i:s",$epochSIXhoursAGO);
$epochTWENTYFOURhoursAGO = ($STARTtime - 86400);
$timeTWENTYFOURhoursAGO = date("Y-m-d H:i:s",$epochTWENTYFOURhoursAGO);


$PHP_AUTH_USER = ereg_replace("[^0-9a-zA-Z]","",$PHP_AUTH_USER);
$PHP_AUTH_PW = ereg_replace("[^0-9a-zA-Z]","",$PHP_AUTH_PW);

//$stmt="SELECT count(*) from vicidial_users where user='$PHP_AUTH_USER' and pass='$PHP_AUTH_PW' and user_level > 6 and view_reports='1' and active='Y';";
$stmt="SELECT count(*) from vicidial_users where user='$PHP_AUTH_USER' and pass='$PHP_AUTH_PW' and view_reports='1' and active='Y';";
if ($DB) {echo "|$stmt|\n";}
if ($non_latin > 0) {$rslt=mysql_query("SET NAMES 'UTF8'");}
$rslt=mysql_query($stmt, $link);
$row=mysql_fetch_row($rslt);
$auth=$row[0];


  if( (strlen($PHP_AUTH_USER)<2) or (strlen($PHP_AUTH_PW)<2) or (!$auth))
	{
    Header("WWW-Authenticate: Basic realm=\"CCMS\"");
    Header("HTTP/1.0 401 Unauthorized");
    echo "Invalid Username/Password: |$PHP_AUTH_USER|$PHP_AUTH_PW|\n";
    exit;
	}
#  and (preg_match("/MONITOR|BARGE|HIJACK/",$monitor_active) ) )
if ( (!isset($monitor_phone)) or (strlen($monitor_phone)<1) )
	{
	$stmt="select phone_login from vicidial_users where user='$PHP_AUTH_USER' and pass='$PHP_AUTH_PW' and active='Y';";
	$rslt=mysql_query($stmt, $link);
	if ($DB) {echo "$stmt\n";}
	$row=mysql_fetch_row($rslt);
	$monitor_phone = $row[0];
	}
	
##Add by fnatic start##
$user_level=0;
$stmt="select user_level, user_group,user_id,user from vicidial_users where user='$PHP_AUTH_USER' and pass='$PHP_AUTH_PW'";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$row=mysql_fetch_row($rslt);
$user_level = $row[0];
$userg = $row[1];
$user_id = $row[2];
$user_name = $row[3];
/*
if($user_level==8)
{
  $stmt="select allowed_campaigns from vicidial_user_groups where user_group='$row[1]'";
  $rslt=mysql_query($stmt, $link);
  if($DB) {echo "$stmt\n";}
  $row=mysql_fetch_row($rslt);
  $allowed_campaigns=$row[0];
  $allowed_campaigns=substr(trim($allowed_campaigns),0,strlen($allowed_campaigns)-3);
  $allowed_campaigns_array = explode(" ",$allowed_campaigns);
}
*/

##Add by fnatic end##
if ( $user_level == 5 ){
	  $stmt = "SELECT campaign_id,campaign_name,active,dial_method,auto_dial_level,lead_order,dial_statuses,vtiger_url,enable_vtiger_integration,inbound_mode,voicemail_ext from vicidial_campaigns ";
	  $stmt = $stmt . " where exists ( select 1 from  vicidial_live_agents b where b.user='$user_name' and  b.campaign_id = vicidial_campaigns.campaign_id ) ";
}else{
	  $stmt = getCampaignSql($user_level,$user_name);
}

$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$groups_to_print = mysql_num_rows($rslt);
$i=0;
	//Modified by Kelvin Begin
	/*bug 0001463 comment by heibo 
    if($user_level==9) {
		$LISTgroups[$i]='ALL-ACTIVE';
		$i++;
		$groups_to_print++;
    }
  */  
	//Modified by Kelvin End

while ($i < $groups_to_print)
	{
	$row=mysql_fetch_row($rslt);

	$LISTgroups[$i] =$row[0];
	$LISTnames[$i] =$row[1];
	$LISTinboundmode = $row[8];

	$i++;
	}


$i=0;
$group_string='|';
$group_ct = count($groups);

while($i < $group_ct)
	{
	$group_string .= "$groups[$i]|";
	$group_SQL .= "'$groups[$i]',";
	$groupQS .= "&groups[]=$groups[$i]";
	$i++;
	}

$group_SQL = eregi_replace(",$",'',$group_SQL);
### if no campaigns selected, display all

if ($group_ct < 1)
	{
	/*
	$groups[0] = 'ALL-ACTIVE';
	$group_string = 'ALL-ACTIVE';
	$group = 'ALL-ACTIVE';
	$groupQS .= "&groups[]=ALL-ACTIVE";
	*/
	#### add by heibo 2011-4-7 15:59:51 bug 1518
	$groups[0] = $LISTgroups[0];
	$group_string = "|" . $LISTgroups[0] . "|";
	$group = $LISTgroups[0];
	$groupQS .= "&groups[]=" . $LISTgroups[0];
	
	$group_SQL    = "'" . $LISTgroups[0] . "'";
	$group_SQLand = "and campaign_id IN ($group_SQL)";
	$group_SQLwhere = "where campaign_id IN($group_SQL)";	
	
	$ALLINGROUPstats = 1; //显示技能组
	### bug 1518
		
	}

#Mod by fnatic 
#if ( (ereg("--NONE--",$group_string) ) or ($group_ct < 1) )
if ( (ereg("--NONE--",$group_string) ))
	{
	$all_active = 0;
	$group_SQL = "''";
	$group_SQLand = "and FALSE";
	$group_SQLwhere = "where FALSE";
	}
elseif ( eregi('ALL-ACTIVE',$group_string) )
	{
	$all_active = 1;
	$group_SQL = "''";
	$group_SQLand = "";
	$group_SQLwhere = "";
	}
else
	{
	$all_active = 0;
	$group_SQLand = "and campaign_id IN($group_SQL)";
	$group_SQLwhere = "where campaign_id IN($group_SQL)";
	}

//print_r($group_SQL);
//echo "<hr>";
//Real-Time Main Report 添加显示所选Campaign-2011-03-31 start;
$select_campains = array();
$stmt= "select campaign_id,campaign_name from vicidial_campaigns $group_SQLwhere order by campaign_id";
$while_rslt=mysql_query($stmt, $link);
while($row = mysql_fetch_assoc($while_rslt)){
	$report_campaign_id		 = $row["campaign_id"];
	$report_campaign_name	 = $row["campaign_name"];
	$select_campaigns[]			 = $report_campaign_id . " - " . $report_campaign_name;
}
$select_campaign_string	= implode(" | ", $select_campaigns);
//echo $select_campaign_string."<hr>";
$select_campaign_info = "<table width='100%' class='HT_table'><tr><th align=left><span class=\"font_calls\">".$select_campaign_string."</span></th></tr></table>";
//Real-Time Main Report 添加显示所选Campaign-2011-03-31 end;

# Add by fnatic start
$Agent_Status_Dead_Display_Enable='Y';
$AGENTDIRECT_Enable='N';

/* add by heibo 2011-4-29 17:48:50 bug1636
 if($group_SQL=="'006'")
  {
    $Agent_Status_Dead_Display_Enable='N';
    $AGENTDIRECT_Enable='N';
  }
*/  
# Add by fnatic end


$stmt="select user_group from vicidial_user_groups";
if ( $user_level == 5 ){
	$stmt= $stmt . " where exists ( select 1 from vicidial_users b,vicidial_live_agents c where b.user = c.user and c.user = '$user_name' and b.user_group = vicidial_user_groups.user_group )  ";
}
//当为supervisor或manager时，只显示该用户管理的组
if( $user_level ==6 || $user_level == 7 || $user_level ==8){
	$stmt= $stmt . " where fun_instr(supervisor,'$user_name') = 1 or fun_instr(manager,'$user_name') = 1 or fun_instr(qa,'$user_name') = 1 ";
}
//echo $stmt . $user_level;
$rslt=mysql_query($stmt, $link);
if (!isset($DB))   {$DB=0;}
if ($DB) {echo "$stmt\n";}
$usergroups_to_print = mysql_num_rows($rslt);
$i=0;
while ($i < $usergroups_to_print)
	{
	$row=mysql_fetch_row($rslt);
	$usergroups[$i] =$row[0];
	$i++;
	}

if (!isset($RR))   {$RR=3;}


$NFB = '<b><font size=6 face="courier">';
$NFE = '</font></b>';
$F=''; $FG=''; $B=''; $BG='';

$select_list = "<TABLE WIDTH=700 CELLPADDING=5 BGCOLOR=\"#D9E6FE\"><TR><TD VALIGN=TOP>请选择要监控的Campaigns<BR>";
$select_list .= "<SELECT SIZE=15 multiple=\"multiple\"  NAME=groups[] ID=groups onchange=open_ehsn_et1_group()>";
$o=0;

while ($groups_to_print > $o)
	{
	if (ereg("\|$LISTgroups[$o]\|",$group_string)) 
		{$select_list .= "<option selected value=\"$LISTgroups[$o]\">$LISTgroups[$o] - $LISTnames[$o]</option>";}
    #Mod by fnatic else
	elseif(!is_null($LISTgroups[$o]) || !is_null($LISTnames[$o]))
		{$select_list .= "<option value=\"$LISTgroups[$o]\"  >$LISTgroups[$o] - $LISTnames[$o]</option>";}
	$o++;
	}
$select_list .= "</SELECT>";
$select_list .= "<BR>(按Ctrl可以选择监控多个Campaigns)";
$select_list .= "</TD><TD VALIGN=TOP ALIGN=CENTER>";
$select_list .= "<a href=\"#\" onclick=\"closeDiv(\'campaign_select_list\');\">关闭设置选项</a><BR><BR>";
$select_list .= "<TABLE CELLPADDING=2 CELLSPACING=2 BORDER=0>";
if($report_name=="real" || $report_name==""){
	$select_list .= "<TR><TD align=right>";
	$select_list .= "Campaign信息区类型:</TD><TD align=left><SELECT SIZE=1 NAME=with_inbound>";
	$select_list .= "<option value=\"N\"";
		if ($with_inbound=='N') {$select_list .= " selected";} 
	$select_list .= ">呼出</option>";
	$select_list .= "<option value=\"Y\"";
		if ($with_inbound=='Y') {$select_list .= " selected";} 
	$select_list .= ">混合</option>";
	$select_list .= "<option value=\"O\"";
		if ($with_inbound=='O') {$select_list .= " selected";} 
	$select_list .= ">呼入</option>";
	$select_list .= "</SELECT></TD></TR>";
}
if($report_name=="monitor"){
	$select_list .= "<TR><TD align=right>";
	$select_list .= "监控类型:  </TD><TD align=left><SELECT SIZE=1 NAME=monitor_active>";
	$select_list .= "<option value=\"\"";
		//if (strlen($monitor_active) < 2) {$select_list .= " selected";} 
	$select_list .= ">无</option>";
	$select_list .= "<option value=\"MONITOR\"";
		if ($monitor_active=='MONITOR') {$select_list .= " selected";} 
	$select_list .= ">监听</option>";
	$select_list .= "<option value=\"BARGE\"";
		if ($monitor_active=='BARGE') {$select_list .= " selected";} 
	$select_list .= ">强插</option>";
	#Add by fnatic start
	$select_list .= "<option value=\"WHISPER\"";
		if ($monitor_active=='WHISPER') {$select_list .= " selected";} 
	$select_list .= ">耳语</option>";
	$select_list .= "<option value=\"MONITOR_ALL\"";
		if ($monitor_active=='MONITOR_ALL' || strlen($monitor_active) < 2) {$select_list .= " selected";} 
	$select_list .= ">全部</option>";
	#Add by fnatic end 
	#$select_list .= "<option value=\"HIJACK\"";
	#	if ($monitor_active=='HIJACK') {$select_list .= " selected";} 
	#$select_list .= ">HIJACK</option>";
	$select_list .= "</SELECT></TD></TR>";

	$select_list .= "<TR><TD align=right>";
	$select_list .= "监听分机:  </TD><TD align=left>";
	$select_list .= "<INPUT type=text size=10 maxlength=20 NAME=monitor_phone VALUE=\"$monitor_phone\">";
	$select_list .= "</TD></TR>";
	$select_list .= "<TR><TD align=center COLSPAN=2> &nbsp; </TD></TR>";
}
//yanson@20100914 start	
$select_list .= "<TR ID=ET1_GROUP style=display:none><TD align=right>";
$select_list .= "选择ET1用户组:</TD><TD align=left>";
$select_list .= "<input type=\"hidden\" value=\"\" name=\"et1_group_value\" id=\"et1_group_value\" /><input type=\"text\" value=\"\" name=\"selected_group\" id=\"selected_group\" style=\"width:110px\" readonly=\"readonly\" /><a href=#V onclick=show_select_group()>选择</a>";
$select_list .= "</SELECT></TD></TR>";
//yanson@20100914 end
	//Modified by Kelvin Begin
	
    if($user_level==7) {
      $usergroup=$userg; 
    }
	//Modified by Kelvin End
//"选择用户组"条件作为默认查询条件，不需隐藏--2011-03-29 ==edit start==
//if ($UGdisplay > 0)
//	{
	$select_list .= "<TR><TD align=right>";
	$select_list .= "选择用户组:</TD><TD align=left>";
	//Modified by Kelvin Begin
	$select_list .= "<SELECT SIZE=1 NAME=usergroup ";

    if($user_level==7) {
      $select_list .= "disabled=true";
    }
	$select_list .= 	">";
	//Modified by Kelvin End
	$select_list .= "<option value=\"\">ALL USER GROUPS</option>";
	$o=0;
	while ($usergroups_to_print > $o)
		{
		if ($usergroups[$o] == $usergroup) {$select_list .= "<option selected value=\"$usergroups[$o]\">$usergroups[$o]</option>";}
		else {$select_list .= "<option value=\"$usergroups[$o]\">$usergroups[$o]</option>";}
		$o++;
		}
	$select_list .= "</SELECT></TD></TR>";
//	}
//--2011-03-29 ==edit end==
//Del by fnatic start
/*
$select_list .= "<TR><TD align=right>";
$select_list .= "可拨打的Leads数量提示:  </TD><TD align=left><SELECT SIZE=1 NAME=NOLEADSalert>";
$select_list .= "<option value=\"\"";
	if (strlen($NOLEADSalert) < 2) {$select_list .= " selected";} 
$select_list .= ">不显示</option>";
$select_list .= "<option value=\"YES\"";
	if ($NOLEADSalert=='YES') {$select_list .= " selected";} 
$select_list .= ">显示</option>";
$select_list .= "</SELECT></TD></TR>";

$select_list .= "<TR><TD align=right>";
$select_list .= "技能组掉线状态:</TD><TD align=left><SELECT SIZE=1 NAME=DROPINGROUPstats>";
$select_list .= "<option value=\"0\"";
	if ($DROPINGROUPstats < 1) {$select_list .= " selected";} 
$select_list .= ">不显示</option>";
$select_list .= "<option value=\"1\"";
	if ($DROPINGROUPstats=='1') {$select_list .= " selected";} 
$select_list .= ">显示</option>";
$select_list .= "</SELECT></TD></TR>";

$select_list .= "<TR><TD align=right>";
$select_list .= "线路状态:</TD><TD align=left><SELECT SIZE=1 NAME=CARRIERstats>";
$select_list .= "<option value=\"0\"";
	if ($CARRIERstats < 1) {$select_list .= " selected";} 
$select_list .= ">不显示</option>";
$select_list .= "<option value=\"1\"";
	if ($CARRIERstats=='1') {$select_list .= " selected";} 
$select_list .= ">显示</option>";
$select_list .= "</SELECT></TD></TR>";
*/
//Del by fnatic end

$select_list .= "</TABLE>";
$select_list .= "<INPUT type=submit NAME=SUBMIT VALUE=提交><FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2> &nbsp; &nbsp; &nbsp; &nbsp; ";
$select_list .= "</TD></TR>";
$select_list .= "<TR><TD ALIGN=CENTER>";
$select_list .= "<font size=1> &nbsp; </font>";
$select_list .= "</TD>";
$select_list .= "<TD NOWRAP align=right>";
//$select_list .= "<font size=1>VERSION: $version &nbsp; BUILD: $build</font>";
$select_list .= "</TD></TR></TABLE>";
//yanson add fn open_ehsn_et1_group()
//$open_list = "<TABLE WIDTH=100% CELLPADDING=0 CELLSPACING=0 BGCOLOR=\"#D9E6FE\" class=\"dlal\"><TR><TD ALIGN=CENTER><a href=\"#\" onclick=\"openDiv(\'campaign_select_list\');open_ehsn_et1_group()\"><font size=2>Choose Report Display Options</a></TD></TR></TABLE>";


//获取外呼失败回滚设置		---start
$campaign_id = $group;
$stmt="SELECT recycle_id,campaign_id,status,attempt_delay,attempt_maximum,active from vicidial_lead_recycle where campaign_id='$campaign_id' and `status`='U' order by status";
$rslt=mysql_query($stmt, $link);
$recycle_to_print = mysql_num_rows($rslt);
$o=0;
while ($recycle_to_print > $o) 
	{
	$rowx=mysql_fetch_row($rslt);
	$RECYCLE_status[$o] =	$rowx[2];
	$RECYCLE_delay[$o] =	$rowx[3];
	$RECYCLE_attempt[$o] =	$rowx[4];
	$RECYCLE_active[$o] =	$rowx[5];
	$RECYCLE_count[$o] = "'Y','Y1','Y2','Y3','Y4','Y5','Y6','Y7','Y8','Y9','Y10'";
	$RECYCLE_count_available[$o] = "'Y','Y1','Y2','Y3','Y4','Y5','Y6','Y7','Y8','Y9','Y10'";
	### Modifed by fnatic for nielsen project ### 
	if ($RECYCLE_attempt[$o]==1) 
		{
		$RECYCLE_count[$o] = "'Y1','Y2','Y3','Y4','Y5','Y6','Y7','Y8','Y9','Y10'";
		$RECYCLE_count_available[$o] = "'Y'";
		}
	if ($RECYCLE_attempt[$o]==2) 
		{
		$RECYCLE_count[$o] = "'Y2','Y3','Y4','Y5','Y6','Y7','Y8','Y9','Y10'";
		$RECYCLE_count_available[$o] = "'Y','Y1'";
		}
	if ($RECYCLE_attempt[$o]==3) 
		{
		$RECYCLE_count[$o] = "'Y3','Y4','Y5','Y6','Y7','Y8','Y9','Y10'";
		$RECYCLE_count_available[$o] = "'Y','Y1','Y2'";
		}
	if ($RECYCLE_attempt[$o]==4) 
		{
		$RECYCLE_count[$o] = "'Y4','Y5','Y6','Y7','Y8','Y9','Y10'";
		$RECYCLE_count_available[$o] = "'Y','Y1','Y2','Y3'";
		}
	if ($RECYCLE_attempt[$o]==5) 
		{
		$RECYCLE_count[$o] = "'Y5','Y6','Y7','Y8','Y9','Y10'";
		$RECYCLE_count_available[$o] = "'Y','Y1','Y2','Y3','Y4'";
		}
	if ($RECYCLE_attempt[$o]==6) 
		{
		$RECYCLE_count[$o] = "'Y6','Y7','Y8','Y9','Y10'";
		$RECYCLE_count_available[$o] = "'Y','Y1','Y2','Y3','Y4','Y5'";
		}
	if ($RECYCLE_attempt[$o]==7) 
		{
		$RECYCLE_count[$o] = "'Y7','Y8','Y9','Y10'";
		$RECYCLE_count_available[$o] = "'Y','Y1','Y2','Y3','Y4','Y5','Y6'";
		}
	if ($RECYCLE_attempt[$o]==8) 
		{
		$RECYCLE_count[$o] = "'Y8','Y9','Y10'";
		$RECYCLE_count_available[$o] = "'Y','Y1','Y2','Y3','Y4','Y5','Y6','Y7'";
		}
	if ($RECYCLE_attempt[$o]==9) 
		{
		$RECYCLE_count_available[$o] = "'Y','Y1','Y2','Y3','Y4','Y5','Y6','Y7','Y8'";
		}
	if ($RECYCLE_attempt[$o]>9) 
		{
		$RECYCLE_count[$o] = "'Y10'";
		$RECYCLE_count_available[$o] = "'Y','Y1','Y2','Y3','Y4','Y5','Y6','Y7','Y8','Y9'";
		}
	#End#
	$o++;
	}

//获取外呼失败回滚设置		---end




$stmt="SELECT campaign_id,campaign_name,active,dial_status_a,dial_status_b,dial_status_c,dial_status_d,dial_status_e,lead_order,park_ext,park_file_name,web_form_address,allow_closers,hopper_level,auto_dial_level,next_agent_call,local_call_time,voicemail_ext,dial_timeout,dial_prefix,campaign_cid,campaign_vdad_exten,campaign_rec_exten,campaign_recording,campaign_rec_filename,campaign_script,get_call_launch,am_message_exten,amd_send_to_vmx,xferconf_a_dtmf,xferconf_a_number,xferconf_b_dtmf,xferconf_b_number,alt_number_dialing,scheduled_callbacks,lead_filter_id,drop_call_seconds,drop_action,safe_harbor_exten,display_dialable_count,wrapup_seconds,wrapup_message,closer_campaigns,use_internal_dnc,allcalls_delay,omit_phone_code,dial_method,available_only_ratio_tally,adaptive_dropped_percentage,adaptive_maximum_level,adaptive_latest_server_time,adaptive_intensity,adaptive_dl_diff_target,concurrent_transfers,auto_alt_dial,auto_alt_dial_statuses,agent_pause_codes_active,campaign_description,campaign_changedate,campaign_stats_refresh,campaign_logindate,dial_statuses,disable_alter_custdata,no_hopper_leads_logins,list_order_mix,campaign_allow_inbound,manual_dial_list_id,default_xfer_group,xfer_groups,queue_priority,drop_inbound_group,qc_enabled,qc_statuses,qc_lists,qc_shift_id,qc_get_record_launch,qc_show_recording,qc_web_form_address,qc_script,survey_first_audio_file,survey_dtmf_digits,survey_ni_digit,survey_opt_in_audio_file,survey_ni_audio_file,survey_method,survey_no_response_action,survey_ni_status,survey_response_digit_map,survey_xfer_exten,survey_camp_record_dir,disable_alter_custphone,display_queue_count,manual_dial_filter,agent_clipboard_copy,agent_extended_alt_dial,use_campaign_dnc,three_way_call_cid,three_way_dial_prefix,web_form_target,vtiger_search_category,vtiger_create_call_record,vtiger_create_lead_record,vtiger_screen_login,cpd_amd_action,agent_allow_group_alias,default_group_alias,vtiger_search_dead,vtiger_status_call,survey_third_digit,survey_third_audio_file,survey_third_status,survey_third_exten,survey_fourth_digit,survey_fourth_audio_file,survey_fourth_status,survey_fourth_exten,drop_lockout_time,quick_transfer_button,prepopulate_transfer_preset,drop_rate_group,view_calls_in_queue,view_calls_in_queue_launch,grab_calls_in_queue,call_requeue_button,pause_after_each_call,no_hopper_dialing,agent_dial_owner_only,agent_display_dialable_leads,web_form_address_two,waitforsilence_options,agent_select_territories,campaign_calldate,crm_popup_login,crm_login_address,timer_action,timer_action_message,timer_action_seconds,start_call_url,dispo_call_url,xferconf_c_number,xferconf_d_number,xferconf_e_number,inbound_mode,enable_vtiger_integration,vtiger_server_ip,vtiger_dbname,vtiger_login,vtiger_pass,vtiger_url,xfer_a_name,xfer_b_name,xfer_c_name,xfer_d_name,xfer_e_name,crm_target,acw_hold_time,shortest_time_send_call,wait_time_for_connet_agent,auto_dial_level_switch,refresh_time,max_abandon_rate,max_wait_time,wait_time_avg,prefix_wait_hopper_level_add,wait_hopper_level_add,abadon_rate_avg,prefix_abandon_hopper_level_add,abandon_hopper_level_add from vicidial_campaigns where campaign_id='$campaign_id';";
		$rslt=mysql_query($stmt, $link);
		$row=mysql_fetch_row($rslt);
		$campaign_name = $row[1];
		$dial_status_a = $row[3];
		$dial_status_b = $row[4];
		$dial_status_c = $row[5];
		$dial_status_d = $row[6];
		$dial_status_e = $row[7];
		$lead_order = $row[8];
		$web_form_address = stripslashes($row[11]);
		$allow_closers = $row[12];
		$hopper_level = $row[13];
		$auto_dial_level = $row[14];
		$next_agent_call = $row[15];
		$local_call_time = $row[16];
		$voicemail_ext = $row[17];
		$dial_timeout = $row[18];
		$dial_prefix = $row[19];
		$campaign_cid = $row[20];
		$campaign_vdad_exten = $row[21];
		$campaign_rec_exten = $row[22];
		$campaign_recording = $row[23];
		$campaign_rec_filename = $row[24];
		$script_id = $row[25];
		$get_call_launch = $row[26];
		$am_message_exten = $row[27];
		$amd_send_to_vmx = $row[28];
		$xferconf_a_dtmf = $row[29];
		$xferconf_a_number = $row[30];
		$xferconf_b_dtmf = $row[31];
		$xferconf_b_number = $row[32];
		$alt_number_dialing = $row[33];
		$scheduled_callbacks = $row[34];
		$lead_filter_id = $row[35];
			if ($lead_filter_id=='') {$lead_filter_id='NONE';}
		$drop_call_seconds = $row[36];
		$drop_action = $row[37];
		$safe_harbor_exten = $row[38];
		$display_dialable_count = $row[39];
		$wrapup_seconds = $row[40];
		$wrapup_message = $row[41];
	#	$closer_campaigns = $row[42];
		$use_internal_dnc = $row[43];
		$allcalls_delay = $row[44];
		$omit_phone_code = $row[45];
		$dial_method = $row[46];
		$available_only_ratio_tally = $row[47];
		$adaptive_dropped_percentage = $row[48];
		$adaptive_maximum_level = $row[49];
		$adaptive_latest_server_time = $row[50];
		$adaptive_intensity = $row[51];
		$adaptive_dl_diff_target = $row[52];
		$concurrent_transfers = $row[53];
		$auto_alt_dial = $row[54];
		$auto_alt_dial_statuses = $row[55];
		$agent_pause_codes_active = $row[56];
		$campaign_description = $row[57];
		$campaign_changedate = $row[58];
		$campaign_stats_refresh = $row[59];
		$campaign_logindate = $row[60];
		$dial_statuses = $row[61];
		$disable_alter_custdata = $row[62];
		$no_hopper_leads_logins = $row[63];
		$list_order_mix = $row[64];
		$campaign_allow_inbound = $row[65];
		$manual_dial_list_id = $row[66];
		$default_xfer_group = $row[67];
		$queue_priority = $row[69];
		$drop_inbound_group = $row[70];
		$qc_enabled = $row[71];
		$qc_statuses = $row[72];
		$qc_lists = $row[73];
		$qc_shift_id = $row[74];
		$qc_get_record_launch = $row[75];
		$qc_show_recording = $row[76];
		$qc_web_form_address = stripslashes($row[77]);
		$qc_script = $row[78];
		$survey_first_audio_file = $row[79];
		$survey_dtmf_digits = $row[80];
		$survey_ni_digit = $row[81];
		$survey_opt_in_audio_file = $row[82];
		$survey_ni_audio_file = $row[83];
		$survey_method = $row[84];
		$survey_no_response_action = $row[85];
		$survey_ni_status = $row[86];
		$survey_response_digit_map = $row[87];
		$survey_xfer_exten = $row[88];
		$survey_camp_record_dir = $row[89];
		$disable_alter_custphone = $row[90];
		$display_queue_count = $row[91];
		$manual_dial_filter = $row[92];
		$agent_clipboard_copy = $row[93];
		$agent_extended_alt_dial = $row[94];
		$use_campaign_dnc = $row[95];
		$three_way_call_cid = $row[96];
		$three_way_dial_prefix = $row[97];
		$web_form_target = $row[98];
		$vtiger_search_category = $row[99];
		$vtiger_create_call_record = $row[100];
		$vtiger_create_lead_record = $row[101];
		$vtiger_screen_login = $row[102];
		$cpd_amd_action = $row[103];
		$agent_allow_group_alias = $row[104];
		$default_group_alias = $row[105];
		$vtiger_search_dead = $row[106];
		$vtiger_status_call = $row[107];
		$survey_third_digit = $row[108];
		$survey_third_audio_file = $row[109];
		$survey_third_status = $row[110];
		$survey_third_exten = $row[111];
		$survey_fourth_digit = $row[112];
		$survey_fourth_audio_file = $row[113];
		$survey_fourth_status = $row[114];
		$survey_fourth_exten = $row[115];
		$drop_lockout_time = $row[116];
		$quick_transfer_button = $row[117];
		$prepopulate_transfer_preset = $row[118];
		$drop_rate_group = $row[119];
		$view_calls_in_queue = $row[120];
		$view_calls_in_queue_launch = $row[121];
		$grab_calls_in_queue = $row[122];
		$call_requeue_button = $row[123];
		$pause_after_each_call = $row[124];
		$no_hopper_dialing = $row[125];
		$agent_dial_owner_only = $row[126];
		$agent_display_dialable_leads = $row[127];
		$web_form_address_two = $row[128];
		$waitforsilence_options = $row[129];
		$agent_select_territories = $row[130];
		$campaign_calldate = $row[131];
		$crm_popup_login = $row[132];
		$crm_login_address = $row[133];
		$timer_action = $row[134];
		$timer_action_message = $row[135];
		$timer_action_seconds = $row[136];
		$start_call_url = $row[137];
		$dispo_call_url = $row[138];
		$xferconf_c_number = $row[139];
		$xferconf_d_number = $row[140];
		$xferconf_e_number = $row[141];
		$inbound_mode = $row[142];
		//vtiger campaign setting.
		$enable_vtiger_integration = 	$row[143];
		$vtiger_server_ip = 			$row[144];
		$vtiger_dbname = 				$row[145];
		$vtiger_login = 				$row[146];
		$vtiger_pass = 					$row[147];
		$vtiger_url = 					$row[148];
		
		$xfer_a_name =				$row[149];
		$xfer_b_name =				$row[150];
		$xfer_c_name =				$row[151];
		$xfer_d_name =				$row[152];
		$xfer_e_name =				$row[153];
		// + fnatic
		$crm_target  =				$row[154];
		// End 
		
		$acw_hold_time  =				$row[155];
		$shortest_time_send_call  =		$row[156];
		$wait_time_for_connet_agent  =	$row[157];
		$auto_dial_level_switch = 	$row[158];
		$refresh_time = 	$row[159];
		$max_abandon_rate = 	$row[160];
		$max_wait_time = 	$row[161];
		$wait_time_avg = 	$row[162];
		$prefix_wait_hopper_level_add = 	$row[163];
		$wait_hopper_level_add = 	$row[164];
		$abadon_rate_avg = 	$row[165];
		$prefix_abandon_hopper_level_add = 	$row[166];
		$abandon_hopper_level_add = 	$row[167];
		
$refresh_time_selected = "refresh_time_selected_$refresh_time";
$$refresh_time_selected = " selected=selected ";

$wait_time_avg_selected = "wait_time_avg_selected_$wait_time_avg";
$$wait_time_avg_selected = " selected=selected ";

$prefix_wait_hopper_level_add_selected = "prefix_wait_hopper_level_add_selected_$prefix_wait_hopper_level_add";
$$prefix_wait_hopper_level_add_selected = " selected=selected ";

$wait_hopper_level_add_selected = "wait_hopper_level_add_selected_$wait_hopper_level_add";
$$wait_hopper_level_add_selected = " selected=selected ";

$abadon_rate_avg_selected = "abadon_rate_avg_selected_$abadon_rate_avg";
$$abadon_rate_avg_selected = " selected=selected ";

$prefix_abandon_hopper_level_add_selected = "prefix_abandon_hopper_level_add_selected_$prefix_abandon_hopper_level_add";
$$prefix_abandon_hopper_level_add_selected = " selected=selected ";

$abandon_hopper_level_add_selected = "abandon_hopper_level_add_selected_$abandon_hopper_level_add";
$$abandon_hopper_level_add_selected = " selected=selected ";

$hopper_level_selected = "hopper_level_selected_$hopper_level";
$$hopper_level_selected = " selected=selected ";

$auto_dial_level_selected = "auto_dial_level_selected_".str_replace(".","_",floatval($auto_dial_level));
$$auto_dial_level_selected = " selected=selected ";
$auto_dial_level_checkbox_checked = "";
if($auto_dial_level_switch == "Y"){
	$auto_dial_level_checkbox_checked = " checked=checked ";
}


$stmt="SELECT campaign_id, switch, abandon_time,  limit_con, total_available, check_time, last_order_time from ccms_campaigns where campaign_id='$campaign_id';";
//echo $stmt."<br>";
		$rslt=mysql_query($stmt, $link);
		$row=mysql_fetch_row($rslt);
//		$campaign_id = $row[0];
		$isSwitch				=	$row[1];
		$abandon_time		=	$row[2];
		$limit_con				=	$row[3];
		$total_available		=	$row[4];
		$check_time			=	$row[5];
		$last_order_time	=	$row[6];
//echo $isSwitch."--".$abandon_time."--".$limit_con."--".$total_available."--".$check_time."--".$last_order_time;
?>

<HTML>
<HEAD>
<script language="Javascript">
	function openNewWindow(url) {
		/*add by pie 20130508*/
	  window.open (url,"",'width=620,height=300,scrollbars=yes,menubar=yes,address=yes');
	}

window.onload = startup;

// function to detect the XY position on the page of the mouse
function startup() 
	{
	hide_ingroup_info();
	if (window.Event) 
		{
		document.captureEvents(Event.MOUSEMOVE);
		}
	document.onmousemove = getCursorXY;
	begin_all_refresh_dial();
	begin_all_refresh();
	}

function getCursorXY(e) 
	{
	document.getElementById('cursorX').value = (window.Event) ? e.pageX : event.clientX + (document.documentElement.scrollLeft ? document.documentElement.scrollLeft : document.body.scrollLeft);
	document.getElementById('cursorY').value = (window.Event) ? e.pageY : event.clientY + (document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop);
	}
function begin_all_refresh_dial(){
	all_refresh_dial();
	var interval = "<?php echo $refresh_time; ?>";
	if(interval != "STOP"){
		window.setInterval("all_refresh_dial()",parseInt(interval)*6000);
	}
}
function begin_all_refresh(){
	all_refresh();
	var interval = "<?php echo $RR; ?>";
	if(interval != "STOP"){
		window.setInterval("all_refresh()",parseInt(interval)*1000);
	}
}
function show_pausestatus(obj,user,campaign){
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
		url_para = "action=pause_status&user=" + user + "&campaign=" + campaign;
		xmlhttp.open('POST', 'forecast_outbound_handle_action.php'); 
		xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
		xmlhttp.send(url_para); 
		xmlhttp.onreadystatechange = function() 
		{ 
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
			{
				Nactiveext = null;
				Nactiveext = xmlhttp.responseText;
				obj.title = "暂停原因：" + Nactiveext;
				xmlhttp = null;
				CollectGarbage();
			}
		}
		delete xmlhttp;
	}
}
function all_refresh(){
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
	var use_auto_dial_level = 0;
	if(document.getElementById("auto_dial_level_checkbox").checked)
		use_auto_dial_level = 1;
	if (xmlhttp) 
	{
		url_para = "<?php echo "RR=$RR&DB=$DB$groupQS&refresh_time=$refresh_time&adastats=$adastats&SIPmonitorLINK=$SIPmonitorLINK&report_name=$report_name&IAXmonitorLINK=$IAXmonitorLINK&usergroup=$usergroup&UGdisplay=$UGdisplay&UidORname=$UidORname&orderby=$orderby&SERVdisplay=$SERVdisplay&CALLSdisplay=$CALLSdisplay&PHONEdisplay=$PHONEdisplay&voicemaildisplay=$voicemaildisplay&inoutdisplay=$inoutdisplay&CUSTPHONEdisplay=$CUSTPHONEdisplay&with_inbound=$with_inbound&monitor_active=$monitor_active&monitor_phone=$monitor_phone&ALLINGROUPstats=$ALLINGROUPstats&DROPINGROUPstats=$DROPINGROUPstats&NOLEADSalert=$NOLEADSalert&CARRIERstats=$CARRIERstats&sumreport=$sumreport"; ?>&use_auto_dial_level="+use_auto_dial_level;

		xmlhttp.open('POST', 'forecast_outbound_handle_action.php'); 
		xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
		xmlhttp.send(url_para); 
		xmlhttp.onreadystatechange = function() 
		{ 
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
			{
				Nactiveext = null;
				Nactiveext = xmlhttp.responseText;
				document.getElementById("ajax_content").innerHTML = Nactiveext;
				
       // script_load();

				//var abandon_rate = document.getElementById("abandon_rate_a").innerHTML;
//				var suggest_dial_level = document.getElementById("suggest_dial_level").value;
				var limit_used_leads_alert = document.getElementById("limit_used_leads_alert").value;
				if(limit_used_leads_alert > 0)
				{
				alert("当前Lead即将外呼完毕,请导入New Lead");
				}

//				document.getElementById("suggest_dial_level_a").innerHTML = suggest_dial_level;
//				if(use_auto_dial_level)
//					document.getElementById("auto_dial_level").value = suggest_dial_level;
				
				xmlhttp = null;
				//CollectGarbage();
			}
		}
		delete xmlhttp;
	}
}

function all_refresh_dial(){
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
	var use_auto_dial_level = 0;
	if(document.getElementById("auto_dial_level_checkbox").checked)
		use_auto_dial_level = 1;
	if (xmlhttp) 
	{
		url_para = "<?php echo "RR=$RR&DB=$DB$groupQS&refresh_time=$refresh_time&adastats=$adastats&SIPmonitorLINK=$SIPmonitorLINK&report_name=$report_name&IAXmonitorLINK=$IAXmonitorLINK&usergroup=$usergroup&UGdisplay=$UGdisplay&UidORname=$UidORname&orderby=$orderby&SERVdisplay=$SERVdisplay&CALLSdisplay=$CALLSdisplay&PHONEdisplay=$PHONEdisplay&voicemaildisplay=$voicemaildisplay&inoutdisplay=$inoutdisplay&CUSTPHONEdisplay=$CUSTPHONEdisplay&with_inbound=$with_inbound&monitor_active=$monitor_active&monitor_phone=$monitor_phone&ALLINGROUPstats=$ALLINGROUPstats&DROPINGROUPstats=$DROPINGROUPstats&NOLEADSalert=$NOLEADSalert&CARRIERstats=$CARRIERstats&sumreport=$sumreport"; ?>&use_auto_dial_level="+use_auto_dial_level;

		xmlhttp.open('POST', 'forecast_outbound_handle_action_dial.php'); 
		xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
		xmlhttp.send(url_para); 
		xmlhttp.onreadystatechange = function() 
		{ 
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
			{
				Nactiveext = null;
				Nactiveext = xmlhttp.responseText;
				document.getElementById("ajax_content").innerHTML = Nactiveext;
				
       // script_load();

				//var abandon_rate = document.getElementById("abandon_rate_a").innerHTML;
//				var suggest_dial_level = document.getElementById("suggest_dial_level").value;

//				document.getElementById("suggest_dial_level_a").innerHTML = suggest_dial_level;
//				if(use_auto_dial_level)
//					document.getElementById("auto_dial_level").value = suggest_dial_level;
				
				xmlhttp = null;
				//CollectGarbage();
			}
		}
		delete xmlhttp;
	}
}

function checked_auto_dial_level_checkbox(update){
	var obj = document.getElementById("auto_dial_level_checkbox");
	var disabled_valaue = false;
	var allow_value = true;
	var auto_dial_level_switch = "N";

	if(obj.checked){
		disabled_valaue = true;
		var allow_value = false;
		auto_dial_level_switch = "Y";
	}

	document.getElementById("auto_dial_level").disabled = disabled_valaue;
	document.getElementById("refresh_time").disabled = allow_value;
	document.getElementById("max_abandon_rate").disabled = allow_value;
	document.getElementById("max_wait_time").disabled = allow_value;
	document.getElementById("wait_time_avg").disabled = allow_value;
	document.getElementById("prefix_wait_hopper_level_add").disabled = allow_value;
	document.getElementById("wait_hopper_level_add").disabled = allow_value;
	document.getElementById("abadon_rate_avg").disabled = allow_value;
	document.getElementById("prefix_abandon_hopper_level_add").disabled = allow_value;
	document.getElementById("abandon_hopper_level_add").disabled = allow_value;
	document.getElementById("hopper_level").disabled = allow_value;
	
	if(update){
		var xmlhttp=false;
		if (!xmlhttp && typeof XMLHttpRequest!='undefined')
			{
			xmlhttp = new XMLHttpRequest();
			}
		if (xmlhttp){
			var monitorQuery = "campaign_id="+campaign_id+"&auto_dial_level_switch="+auto_dial_level_switch;
			xmlhttp.open('POST', 'forecast_outbound_handle_ajax.php'); 
			xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
			xmlhttp.send(monitorQuery); 
			xmlhttp.onreadystatechange = function(){ 
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
					//do nothing
				}
				
			}
			delete xmlhttp;
		}
		
	}

}


var select_list = '<?php echo $select_list ?>';
var open_list = '<?php echo $open_list ?>';
var monitor_phone = '<?php echo $monitor_phone ?>';
var user = '<?php echo $PHP_AUTH_USER ?>';
var pass = '<?php echo $PHP_AUTH_PW ?>';
var campaign_id = '<?php echo $campaign_id;?>';

// functions to hide and show different DIVs
function openDiv(divvar) 
	{
	document.getElementById(divvar).innerHTML = select_list;
	document.getElementById(divvar).style.left = 0;
	}
function closeDiv(divvar)
	{
	document.getElementById(divvar).innerHTML = open_list;
	document.getElementById(divvar).style.left = 160;
	}
function closeAlert(divvar)
	{
	document.getElementById(divvar).innerHTML = '';
	}
// function to launch monitoring calls

function send_monitor(session_id,server_ip,stage)
	{
	//	alert(session_id + "|" + server_ip + "|" + monitor_phone + "|" + stage + "|" + user);
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
		var monitorQuery = "source=realtime&function=blind_monitor&user=" + user + "&pass=" + pass + "&phone_login=" + monitor_phone + "&session_id=" + session_id + '&server_ip=' + server_ip + '&stage=' + stage;
		//alert(monitorQuery);
		xmlhttp.open('POST', 'non_agent_api.php'); 
		xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
		xmlhttp.send(monitorQuery); 
		xmlhttp.onreadystatechange = function() 
			{ 
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
				{
			//	alert(xmlhttp.responseText);
				var Xoutput = null;
				Xoutput = xmlhttp.responseText;
				var regXFerr = new RegExp("ERROR","g");
				var regXFscs = new RegExp("SUCCESS","g");
				if (Xoutput.match(regXFerr))
					{alert(xmlhttp.responseText);}
				if (Xoutput.match(regXFscs))
					{alert("SUCCESS: calling " + monitor_phone);}
				}
			}
		delete xmlhttp;
		}
	}




// function to whisper add by fnatic 

function send_monitor_whisper(session_id,server_ip,stage,user_phone_extension)
	{
	//	alert(session_id + "|" + server_ip + "|" + monitor_phone + "|" + stage + "|" + user);
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
		var monitorQuery = "source=realtime&function=blind_monitor&user=" + user + "&pass=" + pass + "&phone_login=" + monitor_phone + "&session_id=" + session_id + '&server_ip=' + server_ip + '&stage=' + stage + '&user_phone_extension=' + user_phone_extension;
		//alert(monitorQuery);
		xmlhttp.open('POST', 'non_agent_api.php'); 
		xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
		xmlhttp.send(monitorQuery); 
		xmlhttp.onreadystatechange = function() 
			{ 
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
				{
			//	alert(xmlhttp.responseText);
				var Xoutput = null;
				Xoutput = xmlhttp.responseText;
				var regXFerr = new RegExp("ERROR","g");
				var regXFscs = new RegExp("SUCCESS","g");
				if (Xoutput.match(regXFerr))
					{alert(xmlhttp.responseText);}
				if (Xoutput.match(regXFscs))
					{alert("SUCCESS: calling " + monitor_phone);}
				}
			}
		delete xmlhttp;
		}
	}

// function to change in-groups selected for a specific agent
function submit_ingroup_changes(temp_agent_user)
	{
	var temp_ingroup_add_remove_changeIndex = document.getElementById("ingroup_add_remove_change").selectedIndex;
	var temp_ingroup_add_remove_change =  document.getElementById('ingroup_add_remove_change').options[temp_ingroup_add_remove_changeIndex].value;

	var temp_set_as_defaultIndex = document.getElementById("set_as_default").selectedIndex;
	var temp_set_as_default =  document.getElementById('set_as_default').options[temp_set_as_defaultIndex].value;

	var temp_blendedIndex = document.getElementById("blended").selectedIndex;
	var temp_blended =  document.getElementById('blended').options[temp_blendedIndex].value;

	var temp_ingroup_choices = '';
	var txtSelectedValuesObj = document.getElementById('txtSelectedValues');
	var selectedArray = new Array();
	var selObj = document.getElementById('ingroup_new_selections');
	var i;
	var count = 0;
	for (i=0; i<selObj.options.length; i++) 
		{
		if (selObj.options[i].selected) 
			{
		//	selectedArray[count] = selObj.options[i].value;
			temp_ingroup_choices = temp_ingroup_choices + '+' + selObj.options[i].value;
			count++;
			}
		}

	temp_ingroup_choices = temp_ingroup_choices + '+-';

	//	alert(session_id + "|" + server_ip + "|" + monitor_phone + "|" + stage + "|" + user);
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
		var changeQuery = "source=realtime&function=change_ingroups&user=" + user + "&pass=" + pass + "&agent_user=" + temp_agent_user + "&value=" + temp_ingroup_add_remove_change + '&set_as_default=' + temp_set_as_default + '&blended=' + temp_blended + '&ingroup_choices=' + temp_ingroup_choices;
		xmlhttp.open('POST', '../agc/api.php'); 
		xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
		xmlhttp.send(changeQuery); 
		xmlhttp.onreadystatechange = function() 
			{ 
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
				{
			//	alert(changeQuery);
				var Xoutput = null;
				Xoutput = xmlhttp.responseText;
				var regXFerr = new RegExp("ERROR","g");
				if (Xoutput.match(regXFerr))
					{alert(xmlhttp.responseText);}
				else
					{
					alert(xmlhttp.responseText);
					hide_ingroup_info();
					}
				}
			}
		delete xmlhttp;
		}
	}

// function to display in-groups selected for a specific agent
function ingroup_info(agent_user,count)
	{
	var cursorheight = (document.REALTIMEform.cursorY.value - 0);
	var newheight = (cursorheight + 10);
	document.getElementById("agent_ingroup_display").style.top = newheight;
	//	alert(session_id + "|" + server_ip + "|" + monitor_phone + "|" + stage + "|" + user);
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
		var monitorQuery = "source=realtime&function=agent_ingroup_info&stage=change&user=" + user + "&pass=" + pass + "&agent_user=" + agent_user;
		xmlhttp.open('POST', 'non_agent_api.php'); 
		xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
		xmlhttp.send(monitorQuery); 
		xmlhttp.onreadystatechange = function() 
			{ 
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
				{
			//	alert(xmlhttp.responseText);
				var Xoutput = null;
				Xoutput = xmlhttp.responseText;
				var regXFerr = new RegExp("ERROR","g");
				if (Xoutput.match(regXFerr))
					{alert(xmlhttp.responseText);}
				else
					{
					document.getElementById("agent_ingroup_display").visibility = "visible";
					document.getElementById("agent_ingroup_display").innerHTML = Xoutput;
					}
				}
			}
		delete xmlhttp;
		}
	}

// function to display in-groups selected for a specific agent
function hide_ingroup_info()
	{
	document.getElementById("agent_ingroup_display").visibility = "hidden";
	document.getElementById("agent_ingroup_display").innerHTML = '';
	}


function submit_to_set(){
	//start edit by pie 20130125;
	//end edit;
//	var attempt_maximum = document.getElementById("attempt_maximum").value;
//	var attempt_delay = document.getElementById("attempt_delay").value;
	var drop_call_seconds = document.getElementById("drop_call_seconds").value;
	var acw_hold_time = document.getElementById("acw_hold_time").value;
	var shortest_time_send_call = document.getElementById("shortest_time_send_call").value;
	var wait_time_for_connet_agent = document.getElementById("wait_time_for_connet_agent").value;
	var hopper_level = document.getElementById("hopper_level").value;
	var auto_dial_level = document.getElementById("auto_dial_level").value;
	var refresh_time = document.getElementById("refresh_time").value;
	var max_abandon_rate = document.getElementById("max_abandon_rate").value;
	var max_wait_time = document.getElementById("max_wait_time").value;
	var wait_time_avg = document.getElementById("wait_time_avg").value;
	var prefix_wait_hopper_level_add = document.getElementById("prefix_wait_hopper_level_add").value;
	var wait_hopper_level_add = document.getElementById("wait_hopper_level_add").value;
	var abadon_rate_avg = document.getElementById("abadon_rate_avg").value;
	var prefix_abandon_hopper_level_add = document.getElementById("prefix_abandon_hopper_level_add").value;
	var abandon_hopper_level_add = document.getElementById("abandon_hopper_level_add").value;

	var use_auto_dial_level = 0;
	if(document.getElementById("auto_dial_level_checkbox").checked)
		use_auto_dial_level = 1;
	
	in_setting("on");
	
	var xmlhttp=false;
	if (!xmlhttp && typeof XMLHttpRequest!='undefined')
		{
		xmlhttp = new XMLHttpRequest();
		}
	if (xmlhttp){
		var monitorQuery = "campaign_id="+campaign_id+ "&drop_call_seconds=" + drop_call_seconds + "&acw_hold_time="+acw_hold_time+"&shortest_time_send_call="+shortest_time_send_call+"&wait_time_for_connet_agent="+wait_time_for_connet_agent+"&hopper_level=" + hopper_level + "&auto_dial_level=" + auto_dial_level +"&use_auto_dial_level=" + use_auto_dial_level+"&refresh_time=" + refresh_time +"&max_abandon_rate=" + max_abandon_rate +"&max_wait_time=" + max_wait_time +"&wait_time_avg=" + wait_time_avg +"&prefix_wait_hopper_level_add=" + prefix_wait_hopper_level_add +"&wait_hopper_level_add=" + wait_hopper_level_add +"&abadon_rate_avg=" + abadon_rate_avg +"&prefix_abandon_hopper_level_add=" + prefix_abandon_hopper_level_add +"&abandon_hopper_level_add=" + abandon_hopper_level_add;
		xmlhttp.open('POST', 'forecast_outbound_handle_ajax.php'); 
		xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
		xmlhttp.send(monitorQuery); 
		xmlhttp.onreadystatechange = function(){ 
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
				var response = [];
				var response_parameter_error = "";
				var response_sql_error = "";
				var response_return = "";
				response = xmlhttp.responseText.split("<=>");
				response_parameter_error = response[0];
				response_sql_error = response[1];
				response_return = response[2];
				
				if(response_parameter_error)
					alert(response_parameter_error);
				else if(response_sql_error)
					alert(response_sql_error);
				else{
					alert("设置成功");
				}
				in_setting("done");
			}
			
		}
		delete xmlhttp;
	}
	
}

function in_setting(staus){
	var disabled_value = false;
	if(staus == "on"){
		disabled_value = true;
	}
	//start edit by pie 20130125;
	//end edit;
//	document.getElementById('attempt_maximum').disabled = disabled_value;
//	document.getElementById('attempt_delay').disabled = disabled_value;
	document.getElementById('drop_call_seconds').disabled = disabled_value;
	document.getElementById('acw_hold_time').disabled = disabled_value;
	document.getElementById('shortest_time_send_call').disabled = disabled_value;
	document.getElementById('wait_time_for_connet_agent').disabled = disabled_value;
	document.getElementById('hopper_level').disabled = disabled_value;
	document.getElementById('submit_button').disabled = disabled_value;
	
	if(!document.getElementById("auto_dial_level_checkbox").checked){
		document.getElementById('auto_dial_level').disabled = disabled_value;
	}
}

</script>

<STYLE type="text/css">
<!--
	.green {color: white; background-color: green}
	.red1  {color:white; background-color: #ffa2a2}
	.red2  {color:white; background-color: #ff4d4d}
	.red3  {color:white; background-color: red}
	.dispo {color:white; background-color:#0080C0}
	.lightblue,.lightblue td,.lightblue a:link{color: black; background-color: #ADD8E6}
	.blue,.blue td,.blue a:link{color: white; background-color: blue}
	.dispo td,.dispo a:link{color:white; background-color:#0080C0}
	.midnightblue,.midnightblue td,.midnightblue a:link{color: white; background-color: #191970}
	.purple,.purple td,.purple a:link{color: white; background-color: purple}
	.violet,.violet td,.violet a:link{color: black; background-color: #EE82EE} 
	.thistle,.thistle td,.thistle a:link{color: black; background-color: #D8BFD8} 
	.olive,.olive td, .olive a:link{color: white; background-color: #808000}
	.lime,.lime td, .lime a {color: white; background-color: #006600}
	.yellow,.yellow td, .yellow a:link{color: black; background-color: yellow}
	.khaki,.khaki td, .khaki a:link{color: black; background-color: #F0E68C}
	.orange,.orange td, .orange a:link{color: black; background-color: orange}
	.black, .black td, .black a:link{color: white; background-color: black}

	.r1 {color: black; background-color: #FFCCCC}
	.r2 {color: black; background-color: #FF9999}
	.r3 {color: black; background-color: #FF6666}
	.r4 {color: white; background-color: #FF0000}
	.b1 {color: black; background-color: #CCCCFF}
	.b2 {color: black; background-color: #9999FF}
	.b3 {color: black; background-color: #6666FF}
	.b4 {color: white; background-color: #0000FF}
	
	.inputsubmit {
    background: none repeat scroll 0 0 #494949;
    color: #FFFFFF;
	}
	.set_title{
		font-size:18px;
		font-weight:bolder;	
	}
	
<?php
	$stmt="select group_id,group_color from vicidial_inbound_groups;";
	$rslt=mysql_query($stmt, $link);
	if ($DB) {echo "$stmt\n";}
	$INgroups_to_print = mysql_num_rows($rslt);
		if ($INgroups_to_print > 0)
		{
		$g=0;
		while ($g < $INgroups_to_print)
			{
			$row=mysql_fetch_row($rslt);
			$group_id[$g] = $row[0];
			$group_color[$g] = $row[1];
			echo "   .csc$group_id[$g] {color: black; background-color: $group_color[$g]}\n";
			$g++;
			}
		}

echo "\n-->\n
</STYLE>\n";

$stmt = "select count(*) from vicidial_campaigns where active='Y' and campaign_allow_inbound='Y' $group_SQLand;";

$rslt=mysql_query($stmt, $link);
	if ($DB) {echo "$stmt\n";}
	$row=mysql_fetch_row($rslt);
	$campaign_allow_inbound = $row[0];

echo "<META HTTP-EQUIV=\"Content-Type\" CONTENT=\"text/html; charset=utf-8\">\n";
//===edit 2011-03-30 start==;
//echo $RF."<hr>";

$Refresh_content = $RR;
//echo $Refresh_content."<hr>";
//===edit 2011-03-30 end==;
//echo "<META HTTP-EQUIV=Refresh CONTENT=\"$RR; URL=$PHP_SELF?RR=$RR&DB=$DB$groupQS&adastats=$adastats&SIPmonitorLINK=$SIPmonitorLINK&report_name=$report_name&IAXmonitorLINK=$IAXmonitorLINK&usergroup=$usergroup&UGdisplay=$UGdisplay&UidORname=$UidORname&orderby=$orderby&SERVdisplay=$SERVdisplay&CALLSdisplay=$CALLSdisplay&PHONEdisplay=$PHONEdisplay&CUSTPHONEdisplay=$CUSTPHONEdisplay&with_inbound=$with_inbound&monitor_active=$monitor_active&monitor_phone=$monitor_phone&ALLINGROUPstats=$ALLINGROUPstats&DROPINGROUPstats=$DROPINGROUPstats&NOLEADSalert=$NOLEADSalert&CARRIERstats=$CARRIERstats&sumreport=$sumreport\">\n";

echo "<TITLE>CCMS__Forecast Outbound Handle</TITLE></HEAD><BODY BGCOLOR=WHITE marginheight=0 marginwidth=0 leftmargin=0 topmargin=0>\n";

	$short_header=1;

	require("admin_header.php");
?>

<?php
echo "<FORM ACTION=\"$PHP_SELF\" METHOD=GET NAME=REALTIMEform ID=REALTIMEform>\n";
echo "<INPUT TYPE=HIDDEN NAME=RR VALUE=\"$RR\">\n";
//echo "<INPUT TYPE=HIDDEN NAME=RS VALUE=\"$RS\">\n";
echo "<INPUT TYPE=HIDDEN NAME=RF VALUE=\"$RF\">\n";
echo "<INPUT TYPE=HIDDEN NAME=DB VALUE=\"$DB\">\n";
echo "<INPUT TYPE=HIDDEN NAME=cursorX ID=cursorX>\n";
echo "<INPUT TYPE=HIDDEN NAME=cursorY ID=cursorY>\n";
echo "<INPUT TYPE=HIDDEN NAME=adastats VALUE=\"$adastats\">\n";
echo "<INPUT TYPE=HIDDEN NAME=SIPmonitorLINK VALUE=\"$SIPmonitorLINK\">\n";
echo "<INPUT TYPE=HIDDEN NAME=report_name VALUE=\"$report_name\">\n";
echo "<INPUT TYPE=HIDDEN NAME=IAXmonitorLINK VALUE=\"$IAXmonitorLINK\">\n";
echo "<INPUT TYPE=HIDDEN NAME=usergroup VALUE=\"$usergroup\">\n";
echo "<INPUT TYPE=HIDDEN NAME=UGdisplay VALUE=\"$UGdisplay\">\n";
echo "<INPUT TYPE=HIDDEN NAME=UidORname VALUE=\"$UidORname\">\n";
echo "<INPUT TYPE=HIDDEN NAME=orderby VALUE=\"$orderby\">\n";
echo "<INPUT TYPE=HIDDEN NAME=SERVdisplay VALUE=\"$SERVdisplay\">\n";
echo "<INPUT TYPE=HIDDEN NAME=CALLSdisplay VALUE=\"$CALLSdisplay\">\n";
echo "<INPUT TYPE=HIDDEN NAME=PHONEdisplay VALUE=\"$PHONEdisplay\">\n";
echo "<INPUT TYPE=HIDDEN NAME=CUSTPHONEdisplay VALUE=\"$CUSTPHONEdisplay\">\n";
echo "<INPUT TYPE=HIDDEN NAME=DROPINGROUPstats VALUE=\"$DROPINGROUPstats\">\n";
//echo "<INPUT TYPE=HIDDEN NAME=ALLINGROUPstats VALUE=\"$ALLINGROUPstats\">\n";
echo "<INPUT TYPE=HIDDEN NAME=ALLINGROUPstats VALUE=\"1\">\n";
echo "<INPUT TYPE=HIDDEN NAME=CARRIERstats VALUE=\"$CARRIERstats\">\n";

echo "<span style=\"position:absolute;left:160px;top:27px;z-index:19;\" id=campaign_select_list>\n";
echo "</span>\n";
echo "<span style=\"position:absolute;left:10px;top:120px;z-index:18;\" id=agent_ingroup_display>\n";
echo " &nbsp; ";
echo "</span>\n";
echo "<TABLE WIDTH=100% BORDER=0 CELLPADDING=0 CELLSPACING=0 ><TR><TD>";
//echo "CCMS实时监控| ";
//yanson add fn open_ehsn_et1_group()
echo "<ul id=navmenu-h>";
if($report_name != "summary"){
	if ( $sumreport == "N" ){
	   echo "<li><a href=\"#\" class=\"top\" onclick=\"openDiv('campaign_select_list');open_ehsn_et1_group()\"><img src=new_style/images/settings.png border=0 style='vertical-align:middle;'/>设 置</a></li>";
	   echo "<li><a href=\"forecast_outbound_handle_config.php?groups%5B%5D=$campaign_id\" target=\"_blank\" class=\"top\"><img src=new_style/images/settings.png border=0 style='vertical-align:middle;'/>参 数</a></li>";
	}   
}
echo "<li><a href=\"$PHP_SELF?RR=STOP$groupQS&DB=$DB&adastats=$adastats&SIPmonitorLINK=$SIPmonitorLINK&report_name=$report_name&IAXmonitorLINK=$IAXmonitorLINK&usergroup=$usergroup&UGdisplay=$UGdisplay&UidORname=$UidORname&orderby=$orderby&SERVdisplay=$SERVdisplay&CALLSdisplay=$CALLSdisplay&PHONEdisplay=$PHONEdisplay&CUSTPHONEdisplay=$CUSTPHONEdisplay&with_inbound=$with_inbound&monitor_active=$monitor_active&monitor_phone=$monitor_phone&ALLINGROUPstats=$ALLINGROUPstats&DROPINGROUPstats=$DROPINGROUPstats&NOLEADSalert=$NOLEADSalert&CARRIERstats=$CARRIERstats&sumreport=$sumreport\" class=\"top\" >停 止</a></li>";
echo "<li><a href=\"$PHP_SELF?RR=$RR$groupQS&RF=ture&DB=$DB&adastats=$adastats&SIPmonitorLINK=$SIPmonitorLINK&report_name=$report_name&IAXmonitorLINK=$IAXmonitorLINK&usergroup=$usergroup&UGdisplay=$UGdisplay&UidORname=$UidORname&orderby=$orderby&SERVdisplay=$SERVdisplay&CALLSdisplay=$CALLSdisplay&PHONEdisplay=$PHONEdisplay&CUSTPHONEdisplay=$CUSTPHONEdisplay&with_inbound=$with_inbound&monitor_active=$monitor_active&monitor_phone=$monitor_phone&ALLINGROUPstats=$ALLINGROUPstats&DROPINGROUPstats=$DROPINGROUPstats&NOLEADSalert=$NOLEADSalert&CARRIERstats=$CARRIERstats&sumreport=$sumreport\" class=\"top\" >降 速</a></li>";
echo "<li><a href=\"$PHP_SELF?RR=3$groupQS&DB=$DB&adastats=$adastats&SIPmonitorLINK=$SIPmonitorLINK&report_name=$report_name&IAXmonitorLINK=$IAXmonitorLINK&usergroup=$usergroup&UGdisplay=$UGdisplay&UidORname=$UidORname&orderby=$orderby&SERVdisplay=$SERVdisplay&CALLSdisplay=$CALLSdisplay&PHONEdisplay=$PHONEdisplay&CUSTPHONEdisplay=$CUSTPHONEdisplay&with_inbound=$with_inbound&monitor_active=$monitor_active&monitor_phone=$monitor_phone&ALLINGROUPstats=$ALLINGROUPstats&DROPINGROUPstats=$DROPINGROUPstats&NOLEADSalert=$NOLEADSalert&CARRIERstats=$CARRIERstats&sumreport=$sumreport\" class=\"top\" >开 始</a></li>";
if($Refresh_content=="STOP"){$Refresh_content=0;}
//echo "<li><a href=\"#\" class=\"top\">刷新频率：".$Refresh_content." 秒</a></li>";	
if (eregi('ALL-ACTIVE',$group_string))
	{
	//Del by fnatic echo "<a href=\"./admin.php?ADD=10\" class=\"top\" >编辑</a> | ";
	}
else
	{
	//Del by fnatic echo "<a href=\"./admin.php?ADD=34&campaign_id=$group\" class=\"top\" >编辑</a> | ";
	}
//Del by fnaticecho "<a href=\"./AST_timeonVDADallSUMMARY.php?RR=$RR&DB=$DB&adastats=$adastats\" class=\"top\" >摘要</a> </FONT>\n";
//echo "\n\n";

### Mod by fnatic control option position start
if ( $sumreport == "N" ){
if($report_name != "summary"){
if ($adastats<2)
	{
	//echo "<a href=\"$PHP_SELF?$groupQS&RR=$RR&DB=$DB&adastats=2&SIPmonitorLINK=$SIPmonitorLINK&report_name=$report_name&IAXmonitorLINK=$IAXmonitorLINK&usergroup=$usergroup&UGdisplay=$UGdisplay&UidORname=$UidORname&orderby=$orderby&SERVdisplay=$SERVdisplay&CALLSdisplay=$CALLSdisplay&PHONEdisplay=$PHONEdisplay&CUSTPHONEdisplay=$CUSTPHONEdisplay&with_inbound=$with_inbound&monitor_active=$monitor_active&monitor_phone=$monitor_phone&ALLINGROUPstats=$ALLINGROUPstats&DROPINGROUPstats=$DROPINGROUPstats&NOLEADSalert=$NOLEADSalert&CARRIERstats=$CARRIERstats\">显示更多数据</a>";
	}
else
	{
	//echo "<a href=\"$PHP_SELF?$groupQS&RR=$RR&DB=$DB&adastats=1&SIPmonitorLINK=$SIPmonitorLINK&report_name=$report_name&IAXmonitorLINK=$IAXmonitorLINK&usergroup=$usergroup&UGdisplay=$UGdisplay&UidORname=$UidORname&orderby=$orderby&SERVdisplay=$SERVdisplay&CALLSdisplay=$CALLSdisplay&PHONEdisplay=$PHONEdisplay&CUSTPHONEdisplay=$CUSTPHONEdisplay&with_inbound=$with_inbound&monitor_active=$monitor_active&monitor_phone=$monitor_phone&ALLINGROUPstats=$ALLINGROUPstats&DROPINGROUPstats=$DROPINGROUPstats&NOLEADSalert=$NOLEADSalert&CARRIERstats=$CARRIERstats\">隐藏更多数据</a>";
	}
if ($ALLINGROUPstats>0)
	{
	//echo " &nbsp; &nbsp;<a href=\"$PHP_SELF?$groupQS&RR=$RR&DB=$DB&adastats=$adastats&SIPmonitorLINK=$SIPmonitorLINK&report_name=$report_name&IAXmonitorLINK=$IAXmonitorLINK&usergroup=$usergroup&UGdisplay=$UGdisplay&UidORname=$UidORname&orderby=$orderby&SERVdisplay=$SERVdisplay&CALLSdisplay=$CALLSdisplay&PHONEdisplay=$PHONEdisplay&CUSTPHONEdisplay=$CUSTPHONEdisplay&with_inbound=$with_inbound&monitor_active=$monitor_active&monitor_phone=$monitor_phone&ALLINGROUPstats=0&DROPINGROUPstats=$DROPINGROUPstats&NOLEADSalert=$NOLEADSalert&CARRIERstats=$CARRIERstats\">隐藏技能组数据</a>";
	}
else
	{
	//echo " &nbsp; &nbsp;<a href=\"$PHP_SELF?$groupQS&RR=$RR&DB=$DB&adastats=$adastats&SIPmonitorLINK=$SIPmonitorLINK&report_name=$report_name&IAXmonitorLINK=$IAXmonitorLINK&usergroup=$usergroup&UGdisplay=$UGdisplay&UidORname=$UidORname&orderby=$orderby&SERVdisplay=$SERVdisplay&CALLSdisplay=$CALLSdisplay&PHONEdisplay=$PHONEdisplay&CUSTPHONEdisplay=$CUSTPHONEdisplay&with_inbound=$with_inbound&monitor_active=$monitor_active&monitor_phone=$monitor_phone&ALLINGROUPstats=1&DROPINGROUPstats=$DROPINGROUPstats&NOLEADSalert=$NOLEADSalert&CARRIERstats=$CARRIERstats\">显示技能组数据</a>";
	}
if ($CALLSdisplay>0)
	{
	echo "<li class='sec'><a href=\"$PHP_SELF?$groupQS&RR=$RR&DB=$DB&adastats=$adastats&SIPmonitorLINK=$SIPmonitorLINK&report_name=$report_name&IAXmonitorLINK=$IAXmonitorLINK&usergroup=$usergroup&UGdisplay=$UGdisplay&UidORname=$UidORname&orderby=$orderby&SERVdisplay=$SERVdisplay&CALLSdisplay=0&PHONEdisplay=$PHONEdisplay&voicemaildisplay=$voicemaildisplay&inoutdisplay=$inoutdisplay&CUSTPHONEdisplay=$CUSTPHONEdisplay&with_inbound=$with_inbound&monitor_active=$monitor_active&monitor_phone=$monitor_phone&ALLINGROUPstats=$ALLINGROUPstats&DROPINGROUPstats=$DROPINGROUPstats&NOLEADSalert=$NOLEADSalert&CARRIERstats=$CARRIERstats\"><font class=\"font_date\">[ 隐藏等待中的通话 ]</font></a></li>";
	}
else
	{
	echo "<li class='sec'><a href=\"$PHP_SELF?$groupQS&RR=$RR&DB=$DB&adastats=$adastats&SIPmonitorLINK=$SIPmonitorLINK&report_name=$report_name&IAXmonitorLINK=$IAXmonitorLINK&usergroup=$usergroup&UGdisplay=$UGdisplay&UidORname=$UidORname&orderby=$orderby&SERVdisplay=$SERVdisplay&CALLSdisplay=1&PHONEdisplay=$PHONEdisplay&voicemaildisplay=$voicemaildisplay&inoutdisplay=$inoutdisplay&CUSTPHONEdisplay=$CUSTPHONEdisplay&with_inbound=$with_inbound&monitor_active=$monitor_active&monitor_phone=$monitor_phone&ALLINGROUPstats=$ALLINGROUPstats&DROPINGROUPstats=$DROPINGROUPstats&NOLEADSalert=$NOLEADSalert&CARRIERstats=$CARRIERstats\"><font class=\"font_date\">[ 显示等待中的通话 ]</font></a></li>";
	}
if ($PHONEdisplay>0)
	{
	echo "<li class='sec'><a href=\"$PHP_SELF?$groupQS&RR=$RR&DB=$DB&adastats=$adastats&SIPmonitorLINK=$SIPmonitorLINK&report_name=$report_name&IAXmonitorLINK=$IAXmonitorLINK&usergroup=$usergroup&UGdisplay=$UGdisplay&UidORname=$UidORname&orderby=$orderby&SERVdisplay=$SERVdisplay&CALLSdisplay=$CALLSdisplay&PHONEdisplay=0&voicemaildisplay=$voicemaildisplay&inoutdisplay=$inoutdisplay&CUSTPHONEdisplay=$CUSTPHONEdisplay&with_inbound=$with_inbound&monitor_active=$monitor_active&monitor_phone=$monitor_phone&ALLINGROUPstats=$ALLINGROUPstats&DROPINGROUPstats=$DROPINGROUPstats&NOLEADSalert=$NOLEADSalert&CARRIERstats=$CARRIERstats\"><font class=\"font_date\">[ 隐藏分机 ]</font></a></li>";
	}
else
	{
	echo "<li class='sec'><a href=\"$PHP_SELF?$groupQS&RR=$RR&DB=$DB&adastats=$adastats&SIPmonitorLINK=$SIPmonitorLINK&report_name=$report_name&IAXmonitorLINK=$IAXmonitorLINK&usergroup=$usergroup&UGdisplay=$UGdisplay&UidORname=$UidORname&orderby=$orderby&SERVdisplay=$SERVdisplay&CALLSdisplay=$CALLSdisplay&PHONEdisplay=1&voicemaildisplay=$voicemaildisplay&inoutdisplay=$inoutdisplay&CUSTPHONEdisplay=$CUSTPHONEdisplay&with_inbound=$with_inbound&monitor_active=$monitor_active&monitor_phone=$monitor_phone&ALLINGROUPstats=$ALLINGROUPstats&DROPINGROUPstats=$DROPINGROUPstats&NOLEADSalert=$NOLEADSalert&CARRIERstats=$CARRIERstats\"><font class=\"font_date\">[ 显示分机 ]</font></a></li>";
	}
if ($UGdisplay>0)
	{
	echo "<li class='sec'><a href=\"$PHP_SELF?$groupQS&RR=$RR&DB=$DB&adastats=$adastats&SIPmonitorLINK=$SIPmonitorLINK&report_name=$report_name&IAXmonitorLINK=$IAXmonitorLINK&usergroup=$usergroup&UGdisplay=0&UidORname=$UidORname&orderby=$orderby&SERVdisplay=$SERVdisplay&CALLSdisplay=$CALLSdisplay&PHONEdisplay=$PHONEdisplay&voicemaildisplay=$voicemaildisplay&inoutdisplay=$inoutdisplay&CUSTPHONEdisplay=$CUSTPHONEdisplay&with_inbound=$with_inbound&monitor_active=$monitor_active&monitor_phone=$monitor_phone&ALLINGROUPstats=$ALLINGROUPstats&DROPINGROUPstats=$DROPINGROUPstats&NOLEADSalert=$NOLEADSalert&CARRIERstats=$CARRIERstats\"><font class=\"font_date\">[ 隐藏用户组 ]</font></a></li>";
	}
else
	{
	echo "<li class='sec'><a href=\"$PHP_SELF?$groupQS&RR=$RR&DB=$DB&adastats=$adastats&SIPmonitorLINK=$SIPmonitorLINK&report_name=$report_name&IAXmonitorLINK=$IAXmonitorLINK&usergroup=$usergroup&UGdisplay=1&UidORname=$UidORname&orderby=$orderby&SERVdisplay=$SERVdisplay&CALLSdisplay=$CALLSdisplay&PHONEdisplay=$PHONEdisplay&voicemaildisplay=$voicemaildisplay&inoutdisplay=$inoutdisplay&CUSTPHONEdisplay=$CUSTPHONEdisplay&with_inbound=$with_inbound&monitor_active=$monitor_active&monitor_phone=$monitor_phone&ALLINGROUPstats=$ALLINGROUPstats&DROPINGROUPstats=$DROPINGROUPstats&NOLEADSalert=$NOLEADSalert&CARRIERstats=$CARRIERstats\"><font class=\"font_date\">[ 显示用户组 ]</font></a></li>";
	}
if ($CUSTPHONEdisplay>0)
	{
	echo "<li class='sec'><a href=\"$PHP_SELF?$groupQS&RR=$RR&DB=$DB&adastats=$adastats&SIPmonitorLINK=$SIPmonitorLINK&report_name=$report_name&IAXmonitorLINK=$IAXmonitorLINK&usergroup=$usergroup&UGdisplay=$UGdisplay&UidORname=$UidORname&orderby=$orderby&SERVdisplay=$SERVdisplay&CALLSdisplay=$CALLSdisplay&PHONEdisplay=$PHONEdisplay&voicemaildisplay=$voicemaildisplay&inoutdisplay=$inoutdisplay&CUSTPHONEdisplay=0&with_inbound=$with_inbound&monitor_active=$monitor_active&monitor_phone=$monitor_phone&ALLINGROUPstats=$ALLINGROUPstats&DROPINGROUPstats=$DROPINGROUPstats&NOLEADSalert=$NOLEADSalert&CARRIERstats=$CARRIERstats\"><font class=\"font_date\">[ 隐藏客户电话 ]</font></a></li>";
	}
else
	{
	echo "<li class='sec'><a href=\"$PHP_SELF?$groupQS&RR=$RR&DB=$DB&adastats=$adastats&SIPmonitorLINK=$SIPmonitorLINK&report_name=$report_name&IAXmonitorLINK=$IAXmonitorLINK&usergroup=$usergroup&UGdisplay=$UGdisplay&UidORname=$UidORname&orderby=$orderby&SERVdisplay=$SERVdisplay&CALLSdisplay=$CALLSdisplay&PHONEdisplay=$PHONEdisplay&voicemaildisplay=$voicemaildisplay&inoutdisplay=$inoutdisplay&CUSTPHONEdisplay=1&with_inbound=$with_inbound&monitor_active=$monitor_active&monitor_phone=$monitor_phone&ALLINGROUPstats=$ALLINGROUPstats&DROPINGROUPstats=$DROPINGROUPstats&NOLEADSalert=$NOLEADSalert&CARRIERstats=$CARRIERstats\"><font class=\"font_date\">[ 显示客户电话 ]</font></a></li>";
	}
if ($SERVdisplay>0)
	{
	echo "<li class='sec'><a href=\"$PHP_SELF?$groupQS&RR=$RR&DB=$DB&adastats=$adastats&SIPmonitorLINK=$SIPmonitorLINK&report_name=$report_name&IAXmonitorLINK=$IAXmonitorLINK&usergroup=$usergroup&UGdisplay=$UGdisplay&UidORname=$UidORname&orderby=$orderby&SERVdisplay=0&CALLSdisplay=$CALLSdisplay&PHONEdisplay=$PHONEdisplay&voicemaildisplay=$voicemaildisplay&inoutdisplay=$inoutdisplay&CUSTPHONEdisplay=$CUSTPHONEdisplay&with_inbound=$with_inbound&monitor_active=$monitor_active&monitor_phone=$monitor_phone&ALLINGROUPstats=$ALLINGROUPstats&DROPINGROUPstats=$DROPINGROUPstats&NOLEADSalert=$NOLEADSalert&CARRIERstats=$CARRIERstats\"><font class=\"font_date\">[ 隐藏服务器信息 ]</font></a></li>";
	}
else
	{
	echo "<li class='sec'><a href=\"$PHP_SELF?$groupQS&RR=$RR&DB=$DB&adastats=$adastats&SIPmonitorLINK=$SIPmonitorLINK&report_name=$report_name&IAXmonitorLINK=$IAXmonitorLINK&usergroup=$usergroup&UGdisplay=$UGdisplay&UidORname=$UidORname&orderby=$orderby&SERVdisplay=1&CALLSdisplay=$CALLSdisplay&PHONEdisplay=$PHONEdisplay&voicemaildisplay=$voicemaildisplay&inoutdisplay=$inoutdisplay&CUSTPHONEdisplay=$CUSTPHONEdisplay&with_inbound=$with_inbound&monitor_active=$monitor_active&monitor_phone=$monitor_phone&ALLINGROUPstats=$ALLINGROUPstats&DROPINGROUPstats=$DROPINGROUPstats&NOLEADSalert=$NOLEADSalert&CARRIERstats=$CARRIERstats\"><font class=\"font_date\">[ 显示服务器信息 ]</font></a></li>";
	}
if ($voicemaildisplay>0)
	{
	echo "<li class='sec'><a href=\"$PHP_SELF?$groupQS&RR=$RR&DB=$DB&adastats=$adastats&SIPmonitorLINK=$SIPmonitorLINK&report_name=$report_name&IAXmonitorLINK=$IAXmonitorLINK&usergroup=$usergroup&UGdisplay=$UGdisplay&UidORname=$UidORname&orderby=$orderby&SERVdisplay=$SERVdisplay&CALLSdisplay=$CALLSdisplay&PHONEdisplay=0&voicemaildisplay=0&inoutdisplay=$inoutdisplay&CUSTPHONEdisplay=$CUSTPHONEdisplay&with_inbound=$with_inbound&monitor_active=$monitor_active&monitor_phone=$monitor_phone&ALLINGROUPstats=$ALLINGROUPstats&DROPINGROUPstats=$DROPINGROUPstats&NOLEADSalert=$NOLEADSalert&CARRIERstats=$CARRIERstats\"><font class=\"font_date\">[ 隐藏语音留言 ]</font></a></li>";
	}
else
	{
		if ( $user_level == 5 ) {
		}else{
	    echo "<li class='sec'><a href=\"$PHP_SELF?$groupQS&RR=$RR&DB=$DB&adastats=$adastats&SIPmonitorLINK=$SIPmonitorLINK&report_name=$report_name&IAXmonitorLINK=$IAXmonitorLINK&usergroup=$usergroup&UGdisplay=$UGdisplay&UidORname=$UidORname&orderby=$orderby&SERVdisplay=$SERVdisplay&CALLSdisplay=$CALLSdisplay&PHONEdisplay=0&voicemaildisplay=1&inoutdisplay=$inoutdisplay&CUSTPHONEdisplay=$CUSTPHONEdisplay&with_inbound=$with_inbound&monitor_active=$monitor_active&monitor_phone=$monitor_phone&ALLINGROUPstats=$ALLINGROUPstats&DROPINGROUPstats=$DROPINGROUPstats&NOLEADSalert=$NOLEADSalert&CARRIERstats=$CARRIERstats\"><font class=\"font_date\">[ 显示语音留言 ]</font></a></li>";
	  }  
	}
//add by fox 20120912
if ($inoutdisplay>0)
	{
	echo "<li class='sec'><a href=\"$PHP_SELF?$groupQS&RR=$RR&DB=$DB&adastats=$adastats&SIPmonitorLINK=$SIPmonitorLINK&report_name=$report_name&IAXmonitorLINK=$IAXmonitorLINK&usergroup=$usergroup&UGdisplay=$UGdisplay&UidORname=$UidORname&orderby=$orderby&SERVdisplay=$SERVdisplay&CALLSdisplay=$CALLSdisplay&PHONEdisplay=0&voicemaildisplay=$voicemaildisplay&inoutdisplay=0&CUSTPHONEdisplay=$CUSTPHONEdisplay&with_inbound=$with_inbound&monitor_active=$monitor_active&monitor_phone=$monitor_phone&ALLINGROUPstats=$ALLINGROUPstats&DROPINGROUPstats=$DROPINGROUPstats&NOLEADSalert=$NOLEADSalert&CARRIERstats=$CARRIERstats\"><font class=\"font_date\">[ 不区分进线和外拨电话 ]</font></a></li>";
	}
else
	{
		if ( $user_level == 5 ) {
		}else{
	    echo "<li class='sec'><a href=\"$PHP_SELF?$groupQS&RR=$RR&DB=$DB&adastats=$adastats&SIPmonitorLINK=$SIPmonitorLINK&report_name=$report_name&IAXmonitorLINK=$IAXmonitorLINK&usergroup=$usergroup&UGdisplay=$UGdisplay&UidORname=$UidORname&orderby=$orderby&SERVdisplay=$SERVdisplay&CALLSdisplay=$CALLSdisplay&PHONEdisplay=0&voicemaildisplay=$voicemaildisplay&inoutdisplay=1&CUSTPHONEdisplay=$CUSTPHONEdisplay&with_inbound=$with_inbound&monitor_active=$monitor_active&monitor_phone=$monitor_phone&ALLINGROUPstats=$ALLINGROUPstats&DROPINGROUPstats=$DROPINGROUPstats&NOLEADSalert=$NOLEADSalert&CARRIERstats=$CARRIERstats\"><font class=\"font_date\">[ 区分进线和外拨电话 ]</font></a></li>";
	  }  
	}	
}
}
?>

<?php 
echo "</TD></TR></TABLE>";
echo "<span id=\"ajax_content\"></span>";
?>
</form>
 <div id="select_group_text" style="width:320px; height:500px; background-color:#d9e6fe;position:absolute;top:200px;left:700px;z-index:100;display:none">
<div style="width:300px;text-align:right"><a href="#v" onClick="close_select_group();">关闭</a></div>
<iframe id="select_group_text_iframe" src=""  scrolling="auto" width="320px" height="500px" frameborder="no" border="0" marginwidth="0" marginheight="0" scrolling="no" allowtransparency="yes" ></iframe>
</div>

</BODY></HTML>
<br>
<!--start edit by pie 20130125 start-->
<table width=90% border=0 id="forecast_outbound_handle_config_table" style="display:none"  align="center">
	<tr>
		<td colspan=100%><a href="#" class="set_title" onclick="closetestopenDiv('forecast_outbound_handle_config_table');"><img src=new_style/images/settings.png border=0 style='vertical-align:middle;'/><font color="FF0000">关闭参数设置</font></a></td>
	</tr>
<!--
</table>
<br><br>
<table width=90% border=0 id="forecast_outbound_handle_set_table">
-->
<!---end edit-->
<!--- start add by pie 20130427 -->
<!--
	<tr>
		<td colspan=100% class="set_title">Business Config:</td>
	</tr>
	<tr>
    	<td align=right>Switch：</td>
        <td>
        	<select size="1" id="isSwitch" name="isSwitch">
            	<option value="Y">Y</option>
                <option value="N">N</option>
                <option selected="selected" value="<?php echo $isSwitch;?>"><?php echo $isSwitch;?></option>
            </select>
        </td>
        <td align=right>坐席闲置率(%)：</td>
        <td><input type="text" id="total_available" name="total_available" value="<?php echo $total_available;?>"/></td>
    </tr>
    <tr>
    	<td align=right>Abandon号码有效时长(S)：</td>
        <td><input type="text" id="abandon_time" name="abandon_time" value="<?php echo $abandon_time;?>" /></td>
        <td align=right>启动预测外拨判断间隔时长(S)：</td>
        <td><input type="text" id="check_time" name="check_time" value="<?php echo $check_time;?>"/></td>
    </tr>
    <tr>
    	<td align=right>最小历史订餐金额(￥)：</td>
        <td><input type="text" id="limit_con" name="limit_con" value="<?php echo $limit_con;?>"</td>
        <td align=right>订餐记录有效时长(S)：</td>
        <td><input type="text" id="last_order_time" name="last_order_time" value="<?php echo $last_order_time;?>"</td>
    </tr>
-->
<!-- end add -->

	<tr>
		<td colspan=100% class="set_title"><br>System Config:</td>
	</tr>
	<tr>
		<td align=right><input type=checkbox id="auto_dial_level_checkbox" name="auto_dial_level_checkbox" <?php echo $auto_dial_level_checkbox_checked;?> onclick=checked_auto_dial_level_checkbox(1) />系统自动调整拨号级别&nbsp;<a href="javascript:openNewWindow('admin.php?ADD=99999#sys_conf_auto_dial_level_checkbox')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a><!--add by pie 20130508--></td>
		<td>　</td> 
		<td align=right>拨号级别:</td>
		<td>
			<select size=1 name=auto_dial_level id="auto_dial_level">
				<option <?php echo $auto_dial_level_selected_0;?> value=0>0</option>
				<option <?php echo $auto_dial_level_selected_1;?> value=1>1</option>
				<option <?php echo $auto_dial_level_selected_1_1;?> value=1.1>1.1</option>
				<option <?php echo $auto_dial_level_selected_1_2;?> value=1.2>1.2</option>
				<option <?php echo $auto_dial_level_selected_1_3;?> value=1.3>1.3</option>
				<option <?php echo $auto_dial_level_selected_1_4;?> value=1.4>1.4</option>
				<option <?php echo $auto_dial_level_selected_1_5;?> value=1.5>1.5</option>
				<option <?php echo $auto_dial_level_selected_1_6;?> value=1.6>1.6</option>
				<option <?php echo $auto_dial_level_selected_1_7;?> value=1.7>1.7</option>
				<option <?php echo $auto_dial_level_selected_1_8;?> value=1.8>1.8</option>
				<option <?php echo $auto_dial_level_selected_1_9;?> value=1.9>1.9</option>
				<option <?php echo $auto_dial_level_selected_2;?> value=2>2</option>
				<option <?php echo $auto_dial_level_selected_2_1;?> value=2.1>2.1</option>
				<option <?php echo $auto_dial_level_selected_2_2;?> value=2.2>2.2</option>
				<option <?php echo $auto_dial_level_selected_2_3;?> value=2.3>2.3</option>
				<option <?php echo $auto_dial_level_selected_2_4;?> value=2.4>2.4</option>
				<option <?php echo $auto_dial_level_selected_2_5;?> value=2.5>2.5</option>
				<option <?php echo $auto_dial_level_selected_2_6;?> value=2.6>2.6</option>
				<option <?php echo $auto_dial_level_selected_2_7;?> value=2.7>2.7</option>
				<option <?php echo $auto_dial_level_selected_2_8;?> value=2.8>2.8</option>
				<option <?php echo $auto_dial_level_selected_2_9;?> value=2.9>2.9</option>
				<option <?php echo $auto_dial_level_selected_3;?> value=3>3</option>
				<option <?php echo $auto_dial_level_selected_3_25;?> value=3.25>3.25</option>
				<option <?php echo $hopper_level_selectes_3_5;?> value=3.5>3.5</option>
				<option <?php echo $auto_dial_level_selected_3_75;?> value=3.75>3.75</option>
				<option <?php echo $auto_dial_level_selected_4;?> value=4>4</option>
				<option <?php echo $auto_dial_level_selected_4_5;?> value=4.5>4.5</option>
				<option <?php echo $auto_dial_level_selected_5;?> value=5>5</option>
			</select>(0为关闭)&nbsp;<a style=color:FF0000></a>
			&nbsp;<a href="javascript:openNewWindow('admin.php?ADD=99999#sys_conf_auto_dial_level')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a><!--add by pie 20130508-->
		</td>
	</tr>
	<tr>
		<td align=right>客户最大等待时长(S):</td>
		<td><input type=text id="drop_call_seconds" name="drop_call_seconds" id="drop_call_seconds" value="<?php echo $drop_call_seconds;?>" />&nbsp;<a href="javascript:openNewWindow('admin.php?ADD=99999#sys_conf_drop_call_seconds')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a><!--add by pie 20130508--></td>
		<td align=right>最短提前派Call时长(S):</td>
		<td><input type=text id="shortest_time_send_call" value="<?php echo $shortest_time_send_call;?>"/>(0为关闭)&nbsp;<a href="javascript:openNewWindow('admin.php?ADD=99999#sys_conf_shortest_time_send_call')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a><!--add by pie 20130508--></td>
	</tr>
	<tr>
		<td align=right>ACW状态保持时长(S):</td>
		<td><input type=text id="acw_hold_time" value="<?php echo $acw_hold_time;?>"/>&nbsp;<a href="javascript:openNewWindow('admin.php?ADD=99999#sys_conf_acw_hold_time')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a><!--add by pie 20130508--></td>
		<td align=right>外拨派Call时长:</td>
		<td><input type=text id="wait_time_for_connet_agent" value="<?php echo $wait_time_for_connet_agent;?>" />&nbsp;<a href="javascript:openNewWindow('admin.php?ADD=99999#sys_conf_wait_time_for_connet_agent')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a><!--add by pie 20130508--></td>
	</tr>
	<tr>
		<td>　</td>
	</tr>
	<tr>
	<td><a href=admin.php?ADD=31&SUB=25&campaign_id=<?php echo "$campaign_id";?> target="_blank" /><font color="FF0000">外呼失败最大回滚次数&间隔时间设置</font></a></td> 
	</tr>
	<tr>
		<td>　</td>
	</tr>
	<tr>
		<td align=right>刷新频率(M):</td>
		<td>
			<select size=1 name=refresh_time id="refresh_time">
				<option <?php echo $refresh_time_selected_5;?> value=5>0.5</option>
				<option <?php echo $refresh_time_selected_10;?> value=10>1</option>
				<option <?php echo $refresh_time_selected_20;?> value=20>2</option>
				<option <?php echo $refresh_time_selected_30;?> value=30>3</option>
			</select>
			&nbsp;<a href="javascript:openNewWindow('admin.php?ADD=99999#sys_conf_refresh_time')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a><!--add by pie 20130508-->
		</td>
		<td align=right width=200>拨号漏斗级别:</td>
		<td width=300>
			<select size=1 name=hopper_level id="hopper_level">
			<option <?php echo $hopper_level_selected_1;?> value=1>1</option>
			<option <?php echo $hopper_level_selected_5;?> value=5>5</option>
			<option <?php echo $hopper_level_selected_10;?> value=10>10</option>
			<option <?php echo $hopper_level_selected_20;?> value=20>20</option>
			<option <?php echo $hopper_level_selected_50;?> value=50>50</option>
			<option <?php echo $hopper_level_selected_100;?> value=100>100</option>
			<option <?php echo $hopper_level_selected_200;?> value=200>200</option>
			<option <?php echo $hopper_level_selected_500;?> value=500>500</option>
			<option <?php echo $hopper_level_selected_700;?> value=700>700</option>
			<option <?php echo $hopper_level_selected_1000;?> value=1000>1000</option>
			<option <?php echo $hopper_level_selected_2000;?> value=2000>2000</option>
			</select>
			&nbsp;<a href="javascript:openNewWindow('admin.php?ADD=99999#sys_conf_hopper_level')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a><!--add by pie 20130508-->
		</td>
	</tr>
		<tr>
		<td align=right>目标掉线率(%):</td>
		<td><input type=text id="max_abandon_rate" value="<?php echo $max_abandon_rate;?>"/>&nbsp;<a href="javascript:openNewWindow('admin.php?ADD=99999#sys_conf_max_abandon_rate')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a><!--add by pie 20130508--></td>
		<td align=right>目标平均等待时间(S):</td>
		<td><input type=text id="max_wait_time" value="<?php echo $max_wait_time;?>" />&nbsp;<a href="javascript:openNewWindow('admin.php?ADD=99999#sys_conf_max_wait_time')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a><!--add by pie 20130508--></td>
	</tr>
	<tr>
		<td align=right>平均等待时间(S):</td>
		<td>
			<select size=1 name=wait_time_avg id="wait_time_avg">
				<option <?php echo $wait_time_avg_selected_1;?> value=1>1</option>
				<option <?php echo $wait_time_avg_selected_5;?> value=5>5</option>
				<option <?php echo $wait_time_avg_selected_10;?> value=10>10</option>
				<option <?php echo $wait_time_avg_selected_15;?> value=15>15</option>
			</select>
			&nbsp;<a href="javascript:openNewWindow('admin.php?ADD=99999#sys_conf_wait_time_avg')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a><!--add by pie 20130508-->
		</td>
		<td align=right width=200>拨号级别:
			<select size=1 name=prefix_wait_hopper_level_add id="prefix_wait_hopper_level_add">
			<option <?php echo $prefix_wait_hopper_level_add_selected_1;?> value=1>+</option>
			<option <?php echo $prefix_wait_hopper_level_add_selected_2;?> value=2>-</option>
			</select>
			
		</td>
		<td width=300>
			<select size=1 name=wait_hopper_level_add id="wait_hopper_level_add">
			<option <?php echo $wait_hopper_level_add_selected_1;?> value=1>0.1</option>
			<option <?php echo $wait_hopper_level_add_selected_2;?> value=2>0.2</option>
			<option <?php echo $wait_hopper_level_add_selected_3;?> value=3>0.3</option>
			<option <?php echo $wait_hopper_level_add_selected_4;?> value=4>0.4</option>
			<option <?php echo $wait_hopper_level_add_selected_5;?> value=5>0.5</option>
			</select>
			&nbsp;<a href="javascript:openNewWindow('admin.php?ADD=99999#sys_conf_wait_hopper_level')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a><!--add by pie 20130508-->
		</td>
	</tr>
	<tr>
		<td align=right>掉线率(%):</td>
		<td>
			<select size=1 name=abadon_rate_avg id="abadon_rate_avg">
				<option <?php echo $abadon_rate_avg_selected_1;?> value=1>1</option>
				<option <?php echo $abadon_rate_avg_selected_2;?> value=2>2</option>
				<option <?php echo $abadon_rate_avg_selected_3;?> value=3>3</option>
				<option <?php echo $abadon_rate_avg_selected_4;?> value=4>4</option>
				<option <?php echo $abadon_rate_avg_selected_5;?> value=5>5</option>
			</select>
			&nbsp;<a href="javascript:openNewWindow('admin.php?ADD=99999#sys_conf_abadon_rate_avg')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a><!--add by pie 20130508-->
		</td>
		<td align=right width=200>拨号级别:
			<select size=1 name=prefix_abandon_hopper_level_add id="prefix_abandon_hopper_level_add">
			<option <?php echo $prefix_abandon_hopper_level_add_selected_1;?> value=1>+</option>
			<option <?php echo $prefix_abandon_hopper_level_add_selected_2;?> value=2>-</option>
			</select>
		</td>
		<td width=300>
			<select size=1 name=abandon_hopper_level_add id="abandon_hopper_level_add">
			<option <?php echo $abandon_hopper_level_add_selected_1;?> value=1>0.1</option>
			<option <?php echo $abandon_hopper_level_add_selected_2;?> value=2>0.2</option>
			<option <?php echo $abandon_hopper_level_add_selected_3;?> value=3>0.3</option>
			<option <?php echo $abandon_hopper_level_add_selected_4;?> value=4>0.4</option>
			<option <?php echo $abandon_hopper_level_add_selected_5;?> value=5>0.5</option>
			</select>
			&nbsp;<a href="javascript:openNewWindow('admin.php?ADD=99999#sys_conf_abandon_hopper_level')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a><!--add by pie 20130508-->
		</td>
	</tr>
	<tr>
		<td>　</td>
	</tr>
	<tr>
		<td align=right colspan=2><input class="inputsubmit" type="submit" id="submit_button" onClick="submit_to_set();return false;" value="SUBMIT"></td>
	</tr>
	<tr>
		<td>　</td>
	</tr>
</table>



<script>
//yanson@20100914 add js fn
var group_temp_value = "";
function open_ehsn_et1_group(){
	var select_group = document.getElementById("groups");   
    var intvalue="";
	
    for(i=0;i<select_group.length;i++){      
		if(select_group.options[i].selected){   
			 intvalue+=select_group.options[i].value+",";   
		}   
    }   
    if(intvalue.substr(0,intvalue.length-1)=='006' ){
		document.getElementById("ET1_GROUP").style.display = "";
		document.getElementById('et1_group_value').value = group_temp_value;
		//alert(group_temp_value);
	}else{
		document.getElementById("ET1_GROUP").style.display = "none";
		group_temp_value = document.getElementById('et1_group_value').value ;
		//alert(group_temp_value);
		document.getElementById('et1_group_value').value = "";
	}  
}
function show_select_group(){
	
	if(document.getElementById("select_group_text_iframe").src == ""){
		//alert("hello");
		document.getElementById("select_group_text_iframe").src = "./ehsn_select_group.php";
	}
	document.getElementById("select_group_text").style.display = "";
	
}
function close_select_group(){
	document.getElementById("select_group_text").style.display = "none";
}

function testopenDiv(){
	document.getElementById("forecast_outbound_handle_config_table").style.display = "block";
}

function closetestopenDiv(){
	document.getElementById("forecast_outbound_handle_config_table").style.display = "none";
}

checked_auto_dial_level_checkbox(0);

</script>
