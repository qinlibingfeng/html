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

//require("dbconnect.php");
require("dbconnect_report.php");
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

$stmt= getCampaignSql($user_level,$user_name);
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
$select_list .= "<SELECT SIZE=15 NAME=groups[] ID=groups multiple=\"multiple\" onchange=open_ehsn_et1_group()>";
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

?>

<HTML>
<HEAD>

<script language="Javascript">

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
	begin_all_refresh();
	}

function getCursorXY(e) 
	{
	document.getElementById('cursorX').value = (window.Event) ? e.pageX : event.clientX + (document.documentElement.scrollLeft ? document.documentElement.scrollLeft : document.body.scrollLeft);
	document.getElementById('cursorY').value = (window.Event) ? e.pageY : event.clientY + (document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop);
	}
function begin_all_refresh(){
	all_refresh();
	var interval = "<?php echo $RR; ?>";
	if(interval != "STOP"){
		window.setInterval("all_refresh()",parseInt(interval)*1000);
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
	if (xmlhttp) 
	{
		url_para = "<?php echo "RR=$RR&DB=$DB$groupQS&adastats=$adastats&SIPmonitorLINK=$SIPmonitorLINK&report_name=$report_name&IAXmonitorLINK=$IAXmonitorLINK&usergroup=$usergroup&UGdisplay=$UGdisplay&UidORname=$UidORname&orderby=$orderby&SERVdisplay=$SERVdisplay&CALLSdisplay=$CALLSdisplay&PHONEdisplay=$PHONEdisplay&voicemaildisplay=$voicemaildisplay&inoutdisplay=$inoutdisplay&CUSTPHONEdisplay=$CUSTPHONEdisplay&with_inbound=$with_inbound&monitor_active=$monitor_active&monitor_phone=$monitor_phone&ALLINGROUPstats=$ALLINGROUPstats&DROPINGROUPstats=$DROPINGROUPstats&NOLEADSalert=$NOLEADSalert&CARRIERstats=$CARRIERstats&sumreport=$sumreport"; ?>";

		xmlhttp.open('POST', 'AST_timeonVDADallAJAX_Action.php'); 
		xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
		xmlhttp.send(url_para); 
		xmlhttp.onreadystatechange = function() 
		{ 
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
			{
				Nactiveext = null;
				Nactiveext = xmlhttp.responseText;
				document.getElementById("ajax_content").innerHTML = Nactiveext;
				xmlhttp = null;
				CollectGarbage();
			}
		}
		delete xmlhttp;
	}
}

var select_list = '<?php echo $select_list ?>';
var open_list = '<?php echo $open_list ?>';
var monitor_phone = '<?php echo $monitor_phone ?>';
var user = '<?php echo $PHP_AUTH_USER ?>';
var pass = '<?php echo $PHP_AUTH_PW ?>';

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

echo "<TITLE>CCMS</TITLE></HEAD><BODY BGCOLOR=WHITE marginheight=0 marginwidth=0 leftmargin=0 topmargin=0>\n";

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
	echo "<li class='sec'><a href=\"$PHP_SELF?$groupQS&RR=$RR&DB=$DB&adastats=$adastats&SIPmonitorLINK=$SIPmonitorLINK&report_name=$report_name&IAXmonitorLINK=$IAXmonitorLINK&usergroup=$usergroup&UGdisplay=$UGdisplay&UidORname=$UidORname&orderby=$orderby&SERVdisplay=$SERVdisplay&CALLSdisplay=$CALLSdisplay&PHONEdisplay=0&voicemaildisplay=1&inoutdisplay=$inoutdisplay&CUSTPHONEdisplay=$CUSTPHONEdisplay&with_inbound=$with_inbound&monitor_active=$monitor_active&monitor_phone=$monitor_phone&ALLINGROUPstats=$ALLINGROUPstats&DROPINGROUPstats=$DROPINGROUPstats&NOLEADSalert=$NOLEADSalert&CARRIERstats=$CARRIERstats\"><font class=\"font_date\">[ 显示语音留言 ]</font></a></li>";
	}
if ($inoutdisplay>0)
	{
	echo "<li class='sec'><a href=\"$PHP_SELF?$groupQS&RR=$RR&DB=$DB&adastats=$adastats&SIPmonitorLINK=$SIPmonitorLINK&report_name=$report_name&IAXmonitorLINK=$IAXmonitorLINK&$usergroup_QS&UGdisplay=$UGdisplay&UidORname=$UidORname&orderby=$orderby&SERVdisplay=$SERVdisplay&CALLSdisplay=$CALLSdisplay&PHONEdisplay=0&voicemaildisplay=$voicemaildisplay&inoutdisplay=0&CUSTPHONEdisplay=$CUSTPHONEdisplay&with_inbound=$with_inbound&monitor_active=$monitor_active&monitor_phone=$monitor_phone&ALLINGROUPstats=$ALLINGROUPstats&DROPINGROUPstats=$DROPINGROUPstats&NOLEADSalert=$NOLEADSalert&CARRIERstats=$CARRIERstats\"><font class=\"font_date\">[ 不区分进线和外拨电话 ]</font></a></li>";
	}
else
	{

	    echo "<li class='sec'><a href=\"$PHP_SELF?$groupQS&RR=$RR&DB=$DB&adastats=$adastats&SIPmonitorLINK=$SIPmonitorLINK&report_name=$report_name&IAXmonitorLINK=$IAXmonitorLINK&$usergroup_QS&UGdisplay=$UGdisplay&UidORname=$UidORname&orderby=$orderby&SERVdisplay=$SERVdisplay&CALLSdisplay=$CALLSdisplay&PHONEdisplay=0&voicemaildisplay=$voicemaildisplay&inoutdisplay=1&CUSTPHONEdisplay=$CUSTPHONEdisplay&with_inbound=$with_inbound&monitor_active=$monitor_active&monitor_phone=$monitor_phone&ALLINGROUPstats=$ALLINGROUPstats&DROPINGROUPstats=$DROPINGROUPstats&NOLEADSalert=$NOLEADSalert&CARRIERstats=$CARRIERstats\"><font class=\"font_date\">[ 区分进线和外拨电话 ]</font></a></li>";

	}		
}
}
echo "</TD></TR></TABLE>";
echo "<span id=\"ajax_content\"></span>";



?>
</PRE>
 <div id="select_group_text" style="width:320px; height:500px; background-color:#d9e6fe;position:absolute;top:200px;left:700px;z-index:100;display:none">
<div style="width:300px;text-align:right"><a href="#v" onClick="close_select_group();">关闭</a></div>
<iframe id="select_group_text_iframe" src=""  scrolling="auto" width="320px" height="500px" frameborder="no" border="0" marginwidth="0" marginheight="0" scrolling="no" allowtransparency="yes" ></iframe>
</div>
</BODY></HTML>
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
</script>