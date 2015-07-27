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

	
$ingroup_detail='';

if (strlen($group)>1) {$groups[0] = $group;  $RR=3;}
else {$group = $groups[0];}

function get_server_load($windows = false) 
	{
	$os = strtolower(PHP_OS);
	if(strpos($os, "win") === false) 
		{
		if(file_exists("/proc/loadavg")) 
			{
			$load = file_get_contents("/proc/loadavg");
			$load = explode(' ', $load);
			return $load[0] . ' ' . $load[1] . ' ' . $load[2];
			}
		elseif(function_exists("shell_exec")) 
			{
			$load = explode(' ', `uptime`);
			return $load[count($load)-3] . ' ' . $load[count($load)-2] . ' ' . $load[count($load)-1];
			}
		else 
			{
		return false;
			}
		}
	elseif($windows) 
		{
		if(class_exists("COM")) 
			{
			$wmi = new COM("WinMgmts:\\\\.");
			$cpus = $wmi->InstancesOf("Win32_Processor");

			$cpuload = 0;
			$i = 0;
			while ($cpu = $cpus->Next()) 
				{
				$cpuload += $cpu->LoadPercentage;
				$i++;
				}

			$cpuload = round($cpuload / $i, 2);
			return "$cpuload%";
			}
		else 
			{
			return false;
			}
		}
	}

$load_ave = get_server_load(true);

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
$select_list .= "<SELECT SIZE=15 NAME=groups[] ID=groups onchange=open_ehsn_et1_group()>";
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
//$select_list .= "<BR>(按Ctrl可以选择监控多个Campaigns)";
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
	}

function getCursorXY(e) 
	{
	document.getElementById('cursorX').value = (window.Event) ? e.pageX : event.clientX + (document.documentElement.scrollLeft ? document.documentElement.scrollLeft : document.body.scrollLeft);
	document.getElementById('cursorY').value = (window.Event) ? e.pageY : event.clientY + (document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop);
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
if($RF=='ture')	
{ 
	$RR = $RR +3;
	if($RR >=30)	{$RR=30;}
//	echo $RR."<br>";
}
$Refresh_content = $RR;
//echo $Refresh_content."<hr>";
//===edit 2011-03-30 end==;
echo "<META HTTP-EQUIV=Refresh CONTENT=\"$RR; URL=$PHP_SELF?RR=$RR&DB=$DB$groupQS&adastats=$adastats&SIPmonitorLINK=$SIPmonitorLINK&report_name=$report_name&IAXmonitorLINK=$IAXmonitorLINK&usergroup=$usergroup&UGdisplay=$UGdisplay&UidORname=$UidORname&orderby=$orderby&SERVdisplay=$SERVdisplay&CALLSdisplay=$CALLSdisplay&PHONEdisplay=$PHONEdisplay&CUSTPHONEdisplay=$CUSTPHONEdisplay&with_inbound=$with_inbound&monitor_active=$monitor_active&monitor_phone=$monitor_phone&ALLINGROUPstats=$ALLINGROUPstats&DROPINGROUPstats=$DROPINGROUPstats&NOLEADSalert=$NOLEADSalert&CARRIERstats=$CARRIERstats&sumreport=$sumreport\">\n";

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
echo "<li><a href=\"#\" class=\"top\">刷新频率：".$Refresh_content." 秒</a></li>";		
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

if ($CALLSdisplay>0)
	{
	echo "<li class='sec'><a href=\"$PHP_SELF?$groupQS&RR=$RR&DB=$DB&adastats=$adastats&SIPmonitorLINK=$SIPmonitorLINK&report_name=$report_name&IAXmonitorLINK=$IAXmonitorLINK&usergroup=$usergroup&UGdisplay=$UGdisplay&UidORname=$UidORname&orderby=$orderby&SERVdisplay=$SERVdisplay&CALLSdisplay=0&PHONEdisplay=$PHONEdisplay&CUSTPHONEdisplay=$CUSTPHONEdisplay&with_inbound=$with_inbound&monitor_active=$monitor_active&monitor_phone=$monitor_phone&ALLINGROUPstats=$ALLINGROUPstats&DROPINGROUPstats=$DROPINGROUPstats&NOLEADSalert=$NOLEADSalert&CARRIERstats=$CARRIERstats\"><font class=\"font_date\">[ 隐藏等待中的通话 ]</font></a></li>";
	}
else
	{
	echo "<li class='sec'><a href=\"$PHP_SELF?$groupQS&RR=$RR&DB=$DB&adastats=$adastats&SIPmonitorLINK=$SIPmonitorLINK&report_name=$report_name&IAXmonitorLINK=$IAXmonitorLINK&usergroup=$usergroup&UGdisplay=$UGdisplay&UidORname=$UidORname&orderby=$orderby&SERVdisplay=$SERVdisplay&CALLSdisplay=1&PHONEdisplay=$PHONEdisplay&CUSTPHONEdisplay=$CUSTPHONEdisplay&with_inbound=$with_inbound&monitor_active=$monitor_active&monitor_phone=$monitor_phone&ALLINGROUPstats=$ALLINGROUPstats&DROPINGROUPstats=$DROPINGROUPstats&NOLEADSalert=$NOLEADSalert&CARRIERstats=$CARRIERstats\"><font class=\"font_date\">[ 显示等待中的通话 ]</font></a></li>";
	}
if ($PHONEdisplay>0)
	{
	echo "<li class='sec'><a href=\"$PHP_SELF?$groupQS&RR=$RR&DB=$DB&adastats=$adastats&SIPmonitorLINK=$SIPmonitorLINK&report_name=$report_name&IAXmonitorLINK=$IAXmonitorLINK&usergroup=$usergroup&UGdisplay=$UGdisplay&UidORname=$UidORname&orderby=$orderby&SERVdisplay=$SERVdisplay&CALLSdisplay=$CALLSdisplay&PHONEdisplay=0&CUSTPHONEdisplay=$CUSTPHONEdisplay&with_inbound=$with_inbound&monitor_active=$monitor_active&monitor_phone=$monitor_phone&ALLINGROUPstats=$ALLINGROUPstats&DROPINGROUPstats=$DROPINGROUPstats&NOLEADSalert=$NOLEADSalert&CARRIERstats=$CARRIERstats\"><font class=\"font_date\">[ 隐藏分机 ]</font></a></li>";
	}
else
	{
	echo "<li class='sec'><a href=\"$PHP_SELF?$groupQS&RR=$RR&DB=$DB&adastats=$adastats&SIPmonitorLINK=$SIPmonitorLINK&report_name=$report_name&IAXmonitorLINK=$IAXmonitorLINK&usergroup=$usergroup&UGdisplay=$UGdisplay&UidORname=$UidORname&orderby=$orderby&SERVdisplay=$SERVdisplay&CALLSdisplay=$CALLSdisplay&PHONEdisplay=1&CUSTPHONEdisplay=$CUSTPHONEdisplay&with_inbound=$with_inbound&monitor_active=$monitor_active&monitor_phone=$monitor_phone&ALLINGROUPstats=$ALLINGROUPstats&DROPINGROUPstats=$DROPINGROUPstats&NOLEADSalert=$NOLEADSalert&CARRIERstats=$CARRIERstats\"><font class=\"font_date\">[ 显示分机 ]</font></a></li>";
	}
if ($UGdisplay>0)
	{
	echo "<li class='sec'><a href=\"$PHP_SELF?$groupQS&RR=$RR&DB=$DB&adastats=$adastats&SIPmonitorLINK=$SIPmonitorLINK&report_name=$report_name&IAXmonitorLINK=$IAXmonitorLINK&usergroup=$usergroup&UGdisplay=0&UidORname=$UidORname&orderby=$orderby&SERVdisplay=$SERVdisplay&CALLSdisplay=$CALLSdisplay&PHONEdisplay=$PHONEdisplay&CUSTPHONEdisplay=$CUSTPHONEdisplay&with_inbound=$with_inbound&monitor_active=$monitor_active&monitor_phone=$monitor_phone&ALLINGROUPstats=$ALLINGROUPstats&DROPINGROUPstats=$DROPINGROUPstats&NOLEADSalert=$NOLEADSalert&CARRIERstats=$CARRIERstats\"><font class=\"font_date\">[ 隐藏用户组 ]</font></a></li>";
	}
else
	{
	echo "<li class='sec'><a href=\"$PHP_SELF?$groupQS&RR=$RR&DB=$DB&adastats=$adastats&SIPmonitorLINK=$SIPmonitorLINK&report_name=$report_name&IAXmonitorLINK=$IAXmonitorLINK&usergroup=$usergroup&UGdisplay=1&UidORname=$UidORname&orderby=$orderby&SERVdisplay=$SERVdisplay&CALLSdisplay=$CALLSdisplay&PHONEdisplay=$PHONEdisplay&CUSTPHONEdisplay=$CUSTPHONEdisplay&with_inbound=$with_inbound&monitor_active=$monitor_active&monitor_phone=$monitor_phone&ALLINGROUPstats=$ALLINGROUPstats&DROPINGROUPstats=$DROPINGROUPstats&NOLEADSalert=$NOLEADSalert&CARRIERstats=$CARRIERstats\"><font class=\"font_date\">[ 显示用户组 ]</font></a></li>";
	}
if ($CUSTPHONEdisplay>0)
	{
	echo "<li class='sec'><a href=\"$PHP_SELF?$groupQS&RR=$RR&DB=$DB&adastats=$adastats&SIPmonitorLINK=$SIPmonitorLINK&report_name=$report_name&IAXmonitorLINK=$IAXmonitorLINK&usergroup=$usergroup&UGdisplay=$UGdisplay&UidORname=$UidORname&orderby=$orderby&SERVdisplay=$SERVdisplay&CALLSdisplay=$CALLSdisplay&PHONEdisplay=$PHONEdisplay&CUSTPHONEdisplay=0&with_inbound=$with_inbound&monitor_active=$monitor_active&monitor_phone=$monitor_phone&ALLINGROUPstats=$ALLINGROUPstats&DROPINGROUPstats=$DROPINGROUPstats&NOLEADSalert=$NOLEADSalert&CARRIERstats=$CARRIERstats\"><font class=\"font_date\">[ 隐藏客户电话 ]</font></a></li>";
	}
else
	{
	echo "<li class='sec'><a href=\"$PHP_SELF?$groupQS&RR=$RR&DB=$DB&adastats=$adastats&SIPmonitorLINK=$SIPmonitorLINK&report_name=$report_name&IAXmonitorLINK=$IAXmonitorLINK&usergroup=$usergroup&UGdisplay=$UGdisplay&UidORname=$UidORname&orderby=$orderby&SERVdisplay=$SERVdisplay&CALLSdisplay=$CALLSdisplay&PHONEdisplay=$PHONEdisplay&CUSTPHONEdisplay=1&with_inbound=$with_inbound&monitor_active=$monitor_active&monitor_phone=$monitor_phone&ALLINGROUPstats=$ALLINGROUPstats&DROPINGROUPstats=$DROPINGROUPstats&NOLEADSalert=$NOLEADSalert&CARRIERstats=$CARRIERstats\"><font class=\"font_date\">[ 显示客户电话 ]</font></a></li>";
	}
if ($SERVdisplay>0)
	{
	echo "<li class='sec'><a href=\"$PHP_SELF?$groupQS&RR=$RR&DB=$DB&adastats=$adastats&SIPmonitorLINK=$SIPmonitorLINK&report_name=$report_name&IAXmonitorLINK=$IAXmonitorLINK&usergroup=$usergroup&UGdisplay=$UGdisplay&UidORname=$UidORname&orderby=$orderby&SERVdisplay=0&CALLSdisplay=$CALLSdisplay&PHONEdisplay=$PHONEdisplay&CUSTPHONEdisplay=$CUSTPHONEdisplay&with_inbound=$with_inbound&monitor_active=$monitor_active&monitor_phone=$monitor_phone&ALLINGROUPstats=$ALLINGROUPstats&DROPINGROUPstats=$DROPINGROUPstats&NOLEADSalert=$NOLEADSalert&CARRIERstats=$CARRIERstats\"><font class=\"font_date\">[ 隐藏服务器信息 ]</font></a></li>";
	}
else
	{
	echo "<li class='sec'><a href=\"$PHP_SELF?$groupQS&RR=$RR&DB=$DB&adastats=$adastats&SIPmonitorLINK=$SIPmonitorLINK&report_name=$report_name&IAXmonitorLINK=$IAXmonitorLINK&usergroup=$usergroup&UGdisplay=$UGdisplay&UidORname=$UidORname&orderby=$orderby&SERVdisplay=1&CALLSdisplay=$CALLSdisplay&PHONEdisplay=$PHONEdisplay&CUSTPHONEdisplay=$CUSTPHONEdisplay&with_inbound=$with_inbound&monitor_active=$monitor_active&monitor_phone=$monitor_phone&ALLINGROUPstats=$ALLINGROUPstats&DROPINGROUPstats=$DROPINGROUPstats&NOLEADSalert=$NOLEADSalert&CARRIERstats=$CARRIERstats\"><font class=\"font_date\">[ 显示服务器信息 ]</font></a></li>";
	}
}
}
echo "</TD></TR></TABLE>";

####heibo 2011-3-16 17:05:02 加入的summary报表  $sumreport 为N 为原来的报表  $sumreport 为Y 为所有Campaign报表
if ($sumreport == "N") {
echo $select_campaign_info;//显示所选Campaign-2011-03-31;
if (!$group) 
	{echo "<BR><BR>please select a campaign from the pulldown above</FORM>\n"; exit;}
else
{
$multi_drop=0;
### Gather list of all Closer group ids for exclusion from stats
$stmt = "select group_id from vicidial_inbound_groups;";
$rslt=mysql_query($stmt, $link);
$ingroups_to_print = mysql_num_rows($rslt);
while ($ingroups_to_print > $c)
	{
	$row=mysql_fetch_row($rslt);
	$ALLcloser_campaignsSQL .= "'$row[0]',";
	$c++;
	}
$ALLcloser_campaignsSQL = preg_replace("/,$/","",$ALLcloser_campaignsSQL);
if (strlen($ALLcloser_campaignsSQL)<2)
	{$ALLcloser_campaignsSQL="''";}
if ($DB > 0) {echo "\n|$ALLcloser_campaignsSQL|$stmt|\n";}


##### INBOUND #####

if ( ( ereg('Y',$with_inbound) or ereg('O',$with_inbound) ) and ($campaign_allow_inbound > 0) )
	{
	### Gather list of Closer group ids

	### Add by fnatic start ###
	$allowed_campaign_id="";
	$SQL_allowed_campaign="";
    if($user_level==8 && strlen($group_SQLand)==0)
		{
	      foreach($allowed_campaigns_array as $val)
			{
		      $allowed_campaign_id.="'$val',";
			}
			$allowed_campaign_id=substr($allowed_campaign_id,0,strlen($allowed_campaign_id)-1);
			$SQL_allowed_campaign="AND campaign_id IN(".$allowed_campaign_id.")";			
	    }
	### Add by fnatic end ###

	###Mod by fnatic $stmt = "select closer_campaigns from vicidial_campaigns where active='Y' $group_SQLand;";
	$stmt = "select closer_campaigns from vicidial_campaigns where active='Y' $group_SQLand $SQL_allowed_campaign;";
	//echo $stmt;
	$rslt=mysql_query($stmt, $link);
	$ccamps_to_print = mysql_num_rows($rslt);
	$c=0;
	while ($ccamps_to_print > $c)
		{
		$row=mysql_fetch_row($rslt);
		$closer_campaigns = $row[0];
		$closer_campaigns = preg_replace("/^ | -$/","",$closer_campaigns);
		$closer_campaigns = preg_replace("/ /","','",$closer_campaigns);
		$closer_campaignsSQL .= "'$closer_campaigns',";
		//echo $closer_campaignsSQL;
		$c++;
		}
	$closer_campaignsSQL = preg_replace("/,$/","",$closer_campaignsSQL);
	}
else
	{
	$closer_campaignsSQL = "''";
	}	
//	echo  "closer_campaignsSQL:".$closer_campaignsSQL."<br/>";
if ($DB > 0) {echo "\n|$closer_campaigns|$closer_campaignsSQL|$stmt|\n";}

##### SHOW IN-GROUP STATS OR INBOUND ONLY WITH VIEW-MORE ###

 if ( ($ALLINGROUPstats > 0) or ( (ereg('O',$with_inbound)) and ($adastats > 1) ) )
	{
		//add by heibo 2011-4-20 11:59:49 bug 1577
		      
		      $inbound_voicemail = 0;
		
		    	$stmt  = "select voicemail_ext from vicidial_campaigns where campaign_id = $group_SQL;";

					$rslt  = mysql_query($stmt, $link);
					$row   = mysql_fetch_row($rslt);
					$voicemail_ext = $row[0];
					
          if ( !empty($voicemail_ext) ){
    	        $from_date  = date("d-m-Y");
    	        $to_date    = date("d-m-Y");
              $begin = getunixtime(substr($from_date,6,4).'-'.substr($from_date,3,2).'-'.substr($from_date,0,2)." "."00:00:00");
              $end   = getunixtime(substr($to_date,6,4).'-'.substr($to_date,3,2).'-'.substr($to_date,0,2)." "."23:59:59");
        	
					    $VmPath = $VoiceMailPath."$voicemail_ext/INBOX/";
					    $StatVm = VoiceMail($VmPath,$begin,$end);
              
              $inbound_voicemail = count($StatVm);
        	}

	  //end by heibo bug 1577				
					
//	echo "ALLINGROUPstats:".$ALLINGROUPstats."|with_inbound:".$with_inbound."|adastats:".$adastats;
//  Mod by fnatic Filter AGENTDIRECT INGOUP DATA
    if($AGENTDIRECT_Enable=='N')
		{
	$stmtB="select calls_today,drops_today,answers_today,status_category_1,status_category_count_1,status_category_2,status_category_count_2,status_category_3,status_category_count_3,status_category_4,status_category_count_4,hold_sec_stat_one,hold_sec_stat_two,hold_sec_answer_calls,hold_sec_drop_calls,hold_sec_queue_calls,campaign_id from vicidial_campaign_stats where campaign_id IN ($closer_campaignsSQL) AND LEFT(campaign_id,11)!='AGENTDIRECT' order by campaign_id;";	         
	    }
	else
		{
	$stmtB="select calls_today,drops_today,answers_today,status_category_1,status_category_count_1,status_category_2,status_category_count_2,status_category_3,status_category_count_3,status_category_4,status_category_count_4,hold_sec_stat_one,hold_sec_stat_two,hold_sec_answer_calls,hold_sec_drop_calls,hold_sec_queue_calls,campaign_id from vicidial_campaign_stats where campaign_id IN ($closer_campaignsSQL) order by campaign_id;";
	}
	if ($DB > 0) {echo "\n|$stmtB|\n";}
	
  //echo $stmtB;
	$r=0;
	$rslt=mysql_query($stmtB, $link);
	$ingroups_to_print = mysql_num_rows($rslt);
//	echo "ingroups_to_print:".$ingroups_to_print;
	if ($ingroups_to_print > 0)
		{
		 $ingroup_detail .= "<table cellpadding=1 cellspacing=1 width=100% class=ingroup_stats>";
		 //Add by fnatic start
         $ingroup_detail .="<tr>";
		 $ingroup_detail .="<th>技能组</th>";
		 $ingroup_detail .="<th>当前等待</th>";
		 $ingroup_detail .="<th>当前振铃</th>";		 
		 $ingroup_detail .="<th>当前通话</th>";		 
		 $ingroup_detail .="<th>今天通话</th>";
		 $ingroup_detail .="<th>一级服务率</th>";
		 $ingroup_detail .="<th>二级服务率</th>";
		 $ingroup_detail .="<th>今天应答</th>";
		 $ingroup_detail .="<th>平均等待时长(应答)</th>";
		 $ingroup_detail .="<th>今天掉线</th>";
		 $ingroup_detail .="<th>平均等待时长(掉线)</th>";
		 $ingroup_detail .="<th>掉线率</th>";
		 $ingroup_detail .="<th>平均等待时长(全部)</th>";
		 $ingroup_detail .="<th>今天语音留言</th>";		 
         $ingroup_detail .="</tr>";
		 //Add by fnatic end
		 
		}
        
		
	while ($ingroups_to_print > $r)
		{
		$row=mysql_fetch_row($rslt);
		$callsTODAY =				$row[0];
		$dropsTODAY =				$row[1];
		$answersTODAY =				$row[2];
		$VSCcat1 =					$row[3];
		$VSCcat1tally =				$row[4];
		$VSCcat2 =					$row[5];
		$VSCcat2tally =				$row[6];
		$VSCcat3 =					$row[7];
		$VSCcat3tally =				$row[8];
		$VSCcat4 =					$row[9];
		$VSCcat4tally =				$row[10];
		$hold_sec_stat_one =		$row[11];
		$hold_sec_stat_two =		$row[12];
		$hold_sec_answer_calls =	$row[13];
		$hold_sec_drop_calls =		$row[14];
		$hold_sec_queue_calls =		$row[15];
		$ingroupdetail =			$row[16];
				
		if ( ($dropsTODAY > 0) and ($answersTODAY > 0) )
			{

			### Mod by fnatic start
			###$drpctTODAY = ( ($dropsTODAY / $answersTODAY) * 100);
            $drpctTODAY = ( ($dropsTODAY / $callsTODAY) * 100);
            ### Mod by fnatic end

			$drpctTODAY = round($drpctTODAY, 2);
			$drpctTODAY = sprintf("%01.2f", $drpctTODAY);
			}
		else
			{$drpctTODAY=0;}

		if ($callsTODAY > 0)
			{
			$AVGhold_sec_queue_calls = ($hold_sec_queue_calls / $callsTODAY);
			$AVGhold_sec_queue_calls = round($AVGhold_sec_queue_calls, 0);
			$AVGhold_sec_queue_calls = date("H:i:s",strtotime($NOW_DAY) + $AVGhold_sec_queue_calls);
			}
		else
			{$AVGhold_sec_queue_calls='00:00:00';}

		if ($dropsTODAY > 0)
			{
			$AVGhold_sec_drop_calls = ($hold_sec_drop_calls / $dropsTODAY);
			$AVGhold_sec_drop_calls = round($AVGhold_sec_drop_calls, 0);
			$AVGhold_sec_drop_calls = date("H:i:s",strtotime($NOW_DAY) + $AVGhold_sec_drop_calls);
			}
		else
			{$AVGhold_sec_drop_calls='00:00:00';}

		if ($answersTODAY > 0)
			{
			$PCThold_sec_stat_one = ( ($hold_sec_stat_one / $answersTODAY) * 100);
			$PCThold_sec_stat_one = round($PCThold_sec_stat_one, 2);
			$PCThold_sec_stat_one = sprintf("%01.2f", $PCThold_sec_stat_one);
			$PCThold_sec_stat_two = ( ($hold_sec_stat_two / $answersTODAY) * 100);
			$PCThold_sec_stat_two = round($PCThold_sec_stat_two, 2);
			$PCThold_sec_stat_two = sprintf("%01.2f", $PCThold_sec_stat_two);
			$AVGhold_sec_answer_calls = ($hold_sec_answer_calls / $answersTODAY);
			$AVGhold_sec_answer_calls = date("H:i:s",strtotime($NOW_DAY) + round($AVGhold_sec_answer_calls, 0));
			if ($agent_non_pause_sec > 0)
				{
				$AVG_ANSWERagent_non_pause_sec = (($answersTODAY / $agent_non_pause_sec) * 60);
				$AVG_ANSWERagent_non_pause_sec = round($AVG_ANSWERagent_non_pause_sec, 2);
				$AVG_ANSWERagent_non_pause_sec = sprintf("%01.2f", $AVG_ANSWERagent_non_pause_sec);
				}
			else
				{$AVG_ANSWERagent_non_pause_sec=0;}
			}
		else
			{
			$PCThold_sec_stat_one=0;
			$PCThold_sec_stat_two=0;
			$AVGhold_sec_answer_calls='00:00:00';
			$AVG_ANSWERagent_non_pause_sec=0;
			}

		if (ereg("0$|2$|4$|6$|8$",$r)) {$bgcolor='#E6E6E6';}
		else {$bgcolor='white';}
		$ingroup_detail .= "<TR bgcolor=\"$bgcolor\">";
       
	    ### Add by fnatic start 

		$stmtC="select status from vicidial_auto_calls where campaign_id='$ingroupdetail';";
		$rsltC=mysql_query($stmtC, $link);
		$Total_Call=mysql_num_rows($rsltC);
		
        $stmtD="select group_name from vicidial_inbound_groups where group_id='".$ingroupdetail."'";
        $rsltD=mysql_query($stmtD, $link);
		$group_name=mysql_fetch_row($rsltD);
		$group_name=$group_name[0];

        $stmtE="select count(*) from vicidial_auto_calls where status in ('LIVE') and campaign_id='$ingroupdetail';";
		$rsltE=mysql_query($stmtE,$link);
		$Wait_Call=mysql_fetch_row($rsltE);
		$Wait_Call=$Wait_Call[0];

        $stmtF="select count(*) from vicidial_auto_calls where status in ('CLOSER') and campaign_id='$ingroupdetail';";
		$rsltF=mysql_query($stmtF,$link);
		$Closer_Call=mysql_fetch_row($rsltF);
		$Closer_Call=$Closer_Call[0];        
        
         $stmtG="select count(*) from vicidial_auto_calls where status not in ('LIVE','CLOSER','IVR') and campaign_id='$ingroupdetail';";
		$rsltG=mysql_query($stmtG,$link);
		$Ring_Call=mysql_fetch_row($rsltG);
		$Ring_Call=$Ring_Call[0]; 
        ### Add by fnatic end 
        
       ### add by heibo start 2011-3-30 11:43:13 bug 1461
       $stmt_inboudmode = "select inbound_mode from vicidial_campaigns where instr(closer_campaigns,'" . $ingroupdetail . "') > 0";
       $rslt_inboudmode = mysql_query($stmt_inboudmode,$link);
       $inboundmode     = mysql_fetch_row($rslt_inboudmode);
       $inboundmode     = $inboundmode[0];

       ### add by heibo end       
       
       
       ### add by heibo start 2011-3-28 11:51:57 模拟成技能组的掉线数
       $stmt_call_menu = "select  count(*) from vicidial_call_menu where tracking_group ='$ingroupdetail'; ";
       $rslt_call_menu = mysql_query($stmt_call_menu,$link);
       $ivr_call_menu  = mysql_fetch_row($rslt_call_menu);
       $ivr_call_menu  = $ivr_call_menu[0];
       
       if ( $ivr_call_menu > 0){
       	  
       	  $stmt_ivr_log = "select count(*),sum(ivr_dropped_call),sec_to_time(sum(ivr_length_in_sec*ivr_dropped_call)/count(*)),sum(ivr_dropped_call)/count(*),sec_to_time(avg(ivr_length_in_sec))";
       	  $stmt_ivr_log = $stmt_ivr_log . " from v_ivr_log where group_id ='$ingroupdetail' and   start_time >='$NOW_DAY'";
       	  
       	  //echo $stmt_ivr_log;
       	  
       	  $rslt_ivr_log = mysql_query($stmt_ivr_log,$link);
       	  $ivr_ivr      = mysql_fetch_row($rslt_ivr_log);
       	  $callsTODAY   = $ivr_ivr[0];
       	  $dropsTODAY   = isset($ivr_ivr[1])?$ivr_ivr[1]:0;
       	  $AVGhold_sec_drop_calls = isset($ivr_ivr[2])?$ivr_ivr[2]:'00:00:00';
       	  $drpctTODAY   = isset($ivr_ivr[3])?round($ivr_ivr[3] * 100,2):'0';
       	  $AVGhold_sec_queue_calls = isset($ivr_ivr[4])?$ivr_ivr[4]:'00:00:00';
       	  
					$ingroup_detail .= "<TD>$group_name</TD>";
					$ingroup_detail .= "<TD>-</TD>";
          //if ($inboundmode == "auto"){
          	  $ingroup_detail .= "<TD>-</TD>";
          //}else{
          //	  $ingroup_detail .= "<TD>$Ring_Call</TD>";
     	    //}
          if ($inboundmode == "auto"){
          	  $ingroup_detail .= "<TD>$Total_Call</TD>";	
          }else{
          	  $ingroup_detail .= "<TD>$Total_Call</TD>";	
     	    } 					
					$ingroup_detail .= "<TD>$callsTODAY&nbsp;</TD>";
					$ingroup_detail .= "<TD>-</TD>";
					$ingroup_detail .= "<TD>-</TD>";
					$ingroup_detail .= "<TD>-</TD>";
					$ingroup_detail .= "<TD>-</TD>";
					$ingroup_detail .= "<TD>$dropsTODAY</TD>";
					$ingroup_detail .= "<TD>$AVGhold_sec_drop_calls</TD>";
					$ingroup_detail .= "<TD>$drpctTODAY%&nbsp;</TD>";
					$ingroup_detail .= "<TD>$AVGhold_sec_queue_calls</TD>";
					
					       	 
       }else{
       	
					$ingroup_detail .= "<TD>$group_name</TD>";
					$ingroup_detail .= "<TD>$Wait_Call</TD>";
          if ($inboundmode == "auto"){
          	  $ingroup_detail .= "<TD>-</TD>";
          }else{
          	  $ingroup_detail .= "<TD>$Ring_Call</TD>";
     	    }					
          if ($inboundmode == "auto"){
          	  $ingroup_detail .= "<TD>$Closer_Call</TD>";	
          }else{
          	  $ingroup_detail .= "<TD>$Closer_Call</TD>";	
     	    } 	
					$ingroup_detail .= "<TD>$callsTODAY&nbsp;</TD>";
					$ingroup_detail .= "<TD>$PCThold_sec_stat_one%</TD>";
					$ingroup_detail .= "<TD>$PCThold_sec_stat_two%</TD>";
					$ingroup_detail .= "<TD>$answersTODAY</TD>";
					$ingroup_detail .= "<TD>$AVGhold_sec_answer_calls</TD>";
					$ingroup_detail .= "<TD>$dropsTODAY</TD>";
					$ingroup_detail .= "<TD>$AVGhold_sec_drop_calls</TD>";
					$ingroup_detail .= "<TD>$drpctTODAY%&nbsp;</TD>";
					$ingroup_detail .= "<TD>$AVGhold_sec_queue_calls</TD>";

		       	
       }
       ### add by heibo 2011-4-20 12:12:47 bug 1577
       if ($r == 0){
           $ingroup_detail .= "<TD rowspan=$ingroups_to_print>$inbound_voicemail</TD>";
       }
       $ingroup_detail .= "</TR>";
       ### add by heibo end


		$r++;
		}

	if ($ingroups_to_print > 0)
		{
		//Mod by fnatic $ingroup_detail .= "</table>";
		 $ingroup_detail .= "";	
		}
	}


##### DROP IN-GROUP ONLY TOTALS ROW ###
$DROPINGROUPstatsHTML='';
if ( ($DROPINGROUPstats > 0) and (!preg_match("/ALL-ACTIVE/",$group_string)) )
	{
	$DIGcampaigns='';
	$stmtB="select drop_inbound_group from vicidial_campaigns where campaign_id IN($group_SQL) and drop_inbound_group NOT IN('---NONE---','');";
	if ($DB > 0) {echo "\n|$stmtB|\n";}
	$rslt=mysql_query($stmtB, $link);
	$dig_to_print = mysql_num_rows($rslt);
	$dtp=0;
	while ($dig_to_print > $dtp)
		{
		$row=mysql_fetch_row($rslt);
		$DIGcampaigns .=		"'$row[0]',";
		$dtp++;
		}
	$DIGcampaigns = preg_replace("/,$/",'',$DIGcampaigns);
	if (strlen($DIGcampaigns) < 2) {$DIGcampaigns = "''";}

	$stmtB="select sum(calls_today),sum(drops_today),sum(answers_today) from vicidial_campaign_stats where campaign_id IN($DIGcampaigns);";
	if ($DB > 0) {echo "\n|$stmtB|\n";}

	$rslt=mysql_query($stmtB, $link);
	$row=mysql_fetch_row($rslt);
	$callsTODAY =				$row[0];
	$dropsTODAY =				$row[1];
	$answersTODAY =				$row[2];
	if ( ($dropsTODAY > 0) and ($callsTODAY > 0) )
		{
		$drpctTODAY = ( ($dropsTODAY / $callsTODAY) * 100);
		$drpctTODAY = round($drpctTODAY, 2);
		$drpctTODAY = sprintf("%01.2f", $drpctTODAY);
		}
	else
		{$drpctTODAY=0;}
//Del by fnatic
/*	$DROPINGROUPstatsHTML .= "<TR BGCOLOR=\"#E6E6E6\">";
	$DROPINGROUPstatsHTML .= "<TD ALIGN=RIGHT COLSPAN=2><font size=2><B>技能组掉线信息</B></TD>";
	$DROPINGROUPstatsHTML .= "<TD ALIGN=RIGHT><font size=2><B>掉线率:</B></TD><TD ALIGN=LEFT><font size=2>&nbsp; $drpctTODAY% &nbsp; &nbsp; </TD>";
	$DROPINGROUPstatsHTML .= "<TD ALIGN=RIGHT><font size=2><B>通话数量:</B></TD><TD ALIGN=LEFT><font size=2>&nbsp; $callsTODAY &nbsp; &nbsp; </TD>";
	$DROPINGROUPstatsHTML .= "<TD ALIGN=RIGHT><font size=2><B>掉线/应答:</B></TD><TD ALIGN=LEFT><font size=2>&nbsp; $dropsTODAY / $answersTODAY &nbsp; &nbsp; </TD>";
	$DROPINGROUPstatsHTML .= "</TR>";
*/
	}


##### CARRIER STATS TOTALS ###
$CARRIERstatsHTML='';

if ($CARRIERstats > 0)
	{
	$stmtB="select dialstatus,count(*) from vicidial_carrier_log where call_date >= \"$timeTWENTYFOURhoursAGO\" group by dialstatus;";
	if ($DB > 0) {echo "\n|$stmtB|\n";}
	$rslt=mysql_query($stmtB, $link);
	$car_to_print = mysql_num_rows($rslt);
	$ctp=0;
	while ($car_to_print > $ctp)
		{
		$row=mysql_fetch_row($rslt);
		$TFhour_status[$ctp] =	$row[0];
		$TFhour_count[$ctp] =	$row[1];
		$dialstatuses .=		"'$row[0]',";
		$ctp++;
		}
	$dialstatuses = preg_replace("/,$/",'',$dialstatuses);
//Del by fnatic
/*	$CARRIERstatsHTML .= "<TR BGCOLOR=white><TD ALIGN=left COLSPAN=8>";
	$CARRIERstatsHTML .= "<TABLE width=100% CELLPADDING=1 CELLSPACING=1 BORDER=0 BGCOLOR=white class=carrier_tb>";
	$CARRIERstatsHTML .= "<TR>";
	$CARRIERstatsHTML .= "<TD class=head>线路状态</TD>";
	$CARRIERstatsHTML .= "<TD class=head>挂机状态</TD>";
	$CARRIERstatsHTML .= "<TD class=head>24小时</TD>";
	$CARRIERstatsHTML .= "<TD class=head>6小时</TD>";
	$CARRIERstatsHTML .= "<TD class=head>1小时</TD>";
	$CARRIERstatsHTML .= "<TD class=head>15分钟</TD>";
	$CARRIERstatsHTML .= "<TD class=head>5分钟</TD>";
	$CARRIERstatsHTML .= "<TD class=head>1分钟</TD>";
	$CARRIERstatsHTML .= "</TR>";
*/
	if (strlen($dialstatuses) > 1)
		{
		$stmtB="select dialstatus,count(*) from vicidial_carrier_log where call_date >= \"$timeSIXhoursAGO\" group by dialstatus;";
		if ($DB > 0) {echo "\n|$stmtB|\n";}
		$rslt=mysql_query($stmtB, $link);
		$scar_to_print = mysql_num_rows($rslt);
		$print_sctp=0;
		while ($scar_to_print > $print_sctp)
			{
			$row=mysql_fetch_row($rslt);
			$print_ctp=0;
			while ($print_ctp < $ctp)
				{
				if ($TFhour_status[$print_ctp] == $row[0])
					{$SIXhour_count[$print_ctp] = $row[1];}
				$print_ctp++;
				}
			$print_sctp++;
			}

		$stmtB="select dialstatus,count(*) from vicidial_carrier_log where call_date >= \"$timeONEhourAGO\" group by dialstatus;";
		if ($DB > 0) {echo "\n|$stmtB|\n";}
		$rslt=mysql_query($stmtB, $link);
		$scar_to_print = mysql_num_rows($rslt);
		$print_sctp=0;
		while ($scar_to_print > $print_sctp)
			{
			$row=mysql_fetch_row($rslt);
			$print_ctp=0;
			while ($print_ctp < $ctp)
				{
				if ($TFhour_status[$print_ctp] == $row[0])
					{$ONEhour_count[$print_ctp] = $row[1];}
				$print_ctp++;
				}
			$print_sctp++;
			}

		$stmtB="select dialstatus,count(*) from vicidial_carrier_log where call_date >= \"$timeFIFTEENminutesAGO\" group by dialstatus;";
		if ($DB > 0) {echo "\n|$stmtB|\n";}
		$rslt=mysql_query($stmtB, $link);
		$scar_to_print = mysql_num_rows($rslt);
		$print_sctp=0;
		while ($scar_to_print > $print_sctp)
			{
			$row=mysql_fetch_row($rslt);
			$print_ctp=0;
			while ($print_ctp < $ctp)
				{
				if ($TFhour_status[$print_ctp] == $row[0])
					{$FTminute_count[$print_ctp] = $row[1];}
				$print_ctp++;
				}
			$print_sctp++;
			}

		$stmtB="select dialstatus,count(*) from vicidial_carrier_log where call_date >= \"$timeFIVEminutesAGO\" group by dialstatus;";
		if ($DB > 0) {echo "\n|$stmtB|\n";}
		$rslt=mysql_query($stmtB, $link);
		$scar_to_print = mysql_num_rows($rslt);
		$print_sctp=0;
		while ($scar_to_print > $print_sctp)
			{
			$row=mysql_fetch_row($rslt);
			$print_ctp=0;
			while ($print_ctp < $ctp)
				{
				if ($TFhour_status[$print_ctp] == $row[0])
					{$FIVEminute_count[$print_ctp] = $row[1];}
				$print_ctp++;
				}
			$print_sctp++;
			}

		$stmtB="select dialstatus,count(*) from vicidial_carrier_log where call_date >= \"$timeONEminuteAGO\" group by dialstatus;";
		if ($DB > 0) {echo "\n|$stmtB|\n";}
		$rslt=mysql_query($stmtB, $link);
		$scar_to_print = mysql_num_rows($rslt);
		$print_sctp=0;
		while ($scar_to_print > $print_sctp)
			{
			$row=mysql_fetch_row($rslt);
			$print_ctp=0;
			while ($print_ctp < $ctp)
				{
				if ($TFhour_status[$print_ctp] == $row[0])
					{$ONEminute_count[$print_ctp] = $row[1];}
				$print_ctp++;
				}
			$print_sctp++;
			}


		$print_ctp=0;
		while ($print_ctp < $ctp)
			{
			if (strlen($TFhour_count[$print_ctp])<1) {$TFhour_count[$print_ctp]=0;}
			if (strlen($SIXhour_count[$print_ctp])<1) {$SIXhour_count[$print_ctp]=0;}
			if (strlen($ONEhour_count[$print_ctp])<1) {$ONEhour_count[$print_ctp]=0;}
			if (strlen($FTminute_count[$print_ctp])<1) {$FTminute_count[$print_ctp]=0;}
			if (strlen($FIVEminute_count[$print_ctp])<1) {$FIVEminute_count[$print_ctp]=0;}
			if (strlen($ONEminute_count[$print_ctp])<1) {$ONEminute_count[$print_ctp]=0;}
//Del by fnatic
/*			$CARRIERstatsHTML .= "<TR>";
			$CARRIERstatsHTML .= "<TD></TD>";
			$CARRIERstatsHTML .= "<TD>$TFhour_status[$print_ctp]</TD>";
			$CARRIERstatsHTML .= "<TD>$TFhour_count[$print_ctp]</TD>";
			$CARRIERstatsHTML .= "<TD>$SIXhour_count[$print_ctp]</TD>";
			$CARRIERstatsHTML .= "<TD>$ONEhour_count[$print_ctp]</TD>";
			$CARRIERstatsHTML .= "<TD>$FTminute_count[$print_ctp]</TD>";
			$CARRIERstatsHTML .= "<TD>$FIVEminute_count[$print_ctp]</TD>";
			$CARRIERstatsHTML .= "<TD>$ONEminute_count[$print_ctp]</TD>";
			$CARRIERstatsHTML .= "</TR>";
*/
			$print_ctp++;
			}
		}
	else
		{
//Del by fnatic
//            $CARRIERstatsHTML .= "<TR><TD BGCOLOR=white colspan=7 style=color:red><center>24小时内没有相关线路状态信息</center></TD></TR>";
		}
//	$CARRIERstatsHTML .= "</TABLE>";
//	$CARRIERstatsHTML .= "</TD></TR>";
	}


##### INBOUND ONLY ###
if (ereg('O',$with_inbound))
	{
	$multi_drop++;

	$stmt="select agent_pause_codes_active from vicidial_campaigns $group_SQLwhere;";

	$stmtB="select sum(calls_today),sum(drops_today),sum(answers_today),max(status_category_1),sum(status_category_count_1),max(status_category_2),sum(status_category_count_2),max(status_category_3),sum(status_category_count_3),max(status_category_4),sum(status_category_count_4),sum(hold_sec_stat_one),sum(hold_sec_stat_two),sum(hold_sec_answer_calls),sum(hold_sec_drop_calls),sum(hold_sec_queue_calls) from vicidial_campaign_stats where campaign_id IN ($closer_campaignsSQL);";

	if (eregi('ALL-ACTIVE',$group_string))
		{
		$inboundSQL = "where campaign_id IN ($ALLcloser_campaignsSQL)";
		$stmtB="select sum(calls_today),sum(drops_today),sum(answers_today),max(status_category_1),sum(status_category_count_1),max(status_category_2),sum(status_category_count_2),max(status_category_3),sum(status_category_count_3),max(status_category_4),sum(status_category_count_4),sum(hold_sec_stat_one),sum(hold_sec_stat_two),sum(hold_sec_answer_calls),sum(hold_sec_drop_calls),sum(hold_sec_queue_calls) from vicidial_campaign_stats $inboundSQL;";
		}

	$stmtC="select agent_non_pause_sec from vicidial_campaign_stats $group_SQLwhere;";


	if ($DB > 0) {echo "\n|$stmt|$stmtB|$stmtC|\n";}

	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$agent_pause_codes_active = $row[0];

	$rslt=mysql_query($stmtC, $link);
	$row=mysql_fetch_row($rslt);
	$agent_non_pause_sec = $row[0];

	$rslt=mysql_query($stmtB, $link);
	$row=mysql_fetch_row($rslt);
	$callsTODAY =				$row[0];
	$dropsTODAY =				$row[1];
	$answersTODAY =				$row[2];
	$VSCcat1 =					$row[3];
	$VSCcat1tally =				$row[4];
	$VSCcat2 =					$row[5];
	$VSCcat2tally =				$row[6];
	$VSCcat3 =					$row[7];
	$VSCcat3tally =				$row[8];
	$VSCcat4 =					$row[9];
	$VSCcat4tally =				$row[10];
	$hold_sec_stat_one =		$row[11];
	$hold_sec_stat_two =		$row[12];
	$hold_sec_answer_calls =	$row[13];
	$hold_sec_drop_calls =		$row[14];
	$hold_sec_queue_calls =		$row[15];
	if ( ($dropsTODAY > 0) and ($answersTODAY > 0) )
		{
		### Mod by fnatic start
		###$drpctTODAY = ( ($dropsTODAY / $answersTODAY) * 100);
		$drpctTODAY = ( ($dropsTODAY / $callsTODAY) * 100);		
		### Mod by fnatic end
		$drpctTODAY = round($drpctTODAY, 2);
		$drpctTODAY = sprintf("%01.2f", $drpctTODAY);
		}
	else
		{$drpctTODAY=0;}

	if ($callsTODAY > 0)
		{
		$AVGhold_sec_queue_calls = ($hold_sec_queue_calls / $callsTODAY);
		$AVGhold_sec_queue_calls = round($AVGhold_sec_queue_calls, 0);
		}
	else
		{$AVGhold_sec_queue_calls=0;}

	if ($dropsTODAY > 0)
		{
		$AVGhold_sec_drop_calls = ($hold_sec_drop_calls / $dropsTODAY);
		$AVGhold_sec_drop_calls = round($AVGhold_sec_drop_calls, 0);
		}
	else
		{$AVGhold_sec_drop_calls=0;}

	if ($answersTODAY > 0)
		{
		$PCThold_sec_stat_one = ( ($hold_sec_stat_one / $answersTODAY) * 100);
		$PCThold_sec_stat_one = round($PCThold_sec_stat_one, 2);
		$PCThold_sec_stat_one = sprintf("%01.2f", $PCThold_sec_stat_one);
		$PCThold_sec_stat_two = ( ($hold_sec_stat_two / $answersTODAY) * 100);
		$PCThold_sec_stat_two = round($PCThold_sec_stat_two, 2);
		$PCThold_sec_stat_two = sprintf("%01.2f", $PCThold_sec_stat_two);
		$AVGhold_sec_answer_calls = ($hold_sec_answer_calls / $answersTODAY);
		$AVGhold_sec_answer_calls = round($AVGhold_sec_answer_calls, 0);
		if ($agent_non_pause_sec > 0)
			{
			$AVG_ANSWERagent_non_pause_sec = (($answersTODAY / $agent_non_pause_sec) * 60);
			$AVG_ANSWERagent_non_pause_sec = round($AVG_ANSWERagent_non_pause_sec, 2);
			$AVG_ANSWERagent_non_pause_sec = sprintf("%01.2f", $AVG_ANSWERagent_non_pause_sec);
			}
		else
			{$AVG_ANSWERagent_non_pause_sec=0;}
		}
	else
		{
		$PCThold_sec_stat_one=0;
		$PCThold_sec_stat_two=0;
		$AVGhold_sec_answer_calls=0;
		$AVG_ANSWERagent_non_pause_sec=0;
		}

if ( ($ALLINGROUPstats > 0) or ( (ereg('O',$with_inbound)) and ($adastats > 1) ) )
		{
       //  $ingroup_detail.="<tr>";
	    // $ingroup_detail.="<TD colspan=3>合计</TD>";
	    // $ingroup_detail.="<TD>$callsTODAY</b></TD>";
	    // $ingroup_detail.="<TD>$PCThold_sec_stat_one%</TD>";
	    // $ingroup_detail.="<TD>$PCThold_sec_stat_two%</TD>";
	   //  $ingroup_detail.="<TD>$answersTODAY</TD>";
	   //  $ingroup_detail.="<TD>$AVGhold_sec_answer_calls</TD>";
	   //  $ingroup_detail.="<TD>$dropsTODAY</TD>";	
	    // $ingroup_detail.="<TD>$AVGhold_sec_drop_calls</TD>";	
      //   $ingroup_detail.="<TD>$drpctTODAY%</TD>";
	    // $ingroup_detail.="<TD>$AVGhold_sec_queue_calls</TD>";
	    // $ingroup_detail.="</tr>";
	     $ingroup_detail.="</table>";
		}
	}

##### NOT INBOUND ONLY ###
else
	{
	if (eregi('ALL-ACTIVE',$group_string))
		{
		$non_inboundSQL='';
		if (ereg('N',$with_inbound))
			{$non_inboundSQL = "where campaign_id NOT IN ($ALLcloser_campaignsSQL)";}
		$multi_drop++;
		$stmt="select avg(auto_dial_level),min(dial_status_a),min(dial_status_b),min(dial_status_c),min(dial_status_d),min(dial_status_e),min(lead_order),min(lead_filter_id),sum(hopper_level),min(dial_method),avg(adaptive_maximum_level),avg(adaptive_dropped_percentage),avg(adaptive_dl_diff_target),avg(adaptive_intensity),min(available_only_ratio_tally),min(adaptive_latest_server_time),min(local_call_time),avg(dial_timeout),min(dial_statuses),max(agent_pause_codes_active),max(list_order_mix) from vicidial_campaigns where active='Y';";

		$stmtB="select sum(dialable_leads),sum(calls_today),sum(drops_today),avg(drops_answers_today_pct),avg(differential_onemin),avg(agents_average_onemin),sum(balance_trunk_fill),sum(answers_today),max(status_category_1),sum(status_category_count_1),max(status_category_2),sum(status_category_count_2),max(status_category_3),sum(status_category_count_3),max(status_category_4),sum(status_category_count_4) from vicidial_campaign_stats $non_inboundSQL;";
		}
	else
		{
		if ($DB > 0) {echo "\n|$with_inbound|$campaign_allow_inbound|\n";}

		if ( (ereg('Y',$with_inbound)) and ($campaign_allow_inbound > 0) )
			{
			$multi_drop++;
			if ($DB) {echo "with_inbound|$with_inbound|$campaign_allow_inbound\n";}

			$stmt="select auto_dial_level,dial_status_a,dial_status_b,dial_status_c,dial_status_d,dial_status_e,lead_order,lead_filter_id,hopper_level,dial_method,adaptive_maximum_level,adaptive_dropped_percentage,adaptive_dl_diff_target,adaptive_intensity,available_only_ratio_tally,adaptive_latest_server_time,local_call_time,dial_timeout,dial_statuses,agent_pause_codes_active,list_order_mix from vicidial_campaigns where campaign_id IN ($group_SQL,$closer_campaignsSQL);";

			$stmtB="select sum(dialable_leads),sum(calls_today),sum(drops_today),avg(drops_answers_today_pct),avg(differential_onemin),avg(agents_average_onemin),sum(balance_trunk_fill),sum(answers_today),max(status_category_1),sum(status_category_count_1),max(status_category_2),sum(status_category_count_2),max(status_category_3),sum(status_category_count_3),max(status_category_4),sum(status_category_count_4) from vicidial_campaign_stats where campaign_id IN ($group_SQL,$closer_campaignsSQL);";
			}
		else
			{
			$stmt="select avg(auto_dial_level),max(dial_status_a),max(dial_status_b),max(dial_status_c),max(dial_status_d),max(dial_status_e),max(lead_order),max(lead_filter_id),max(hopper_level),max(dial_method),max(adaptive_maximum_level),avg(adaptive_dropped_percentage),avg(adaptive_dl_diff_target),avg(adaptive_intensity),max(available_only_ratio_tally),max(adaptive_latest_server_time),max(local_call_time),max(dial_timeout),max(dial_statuses),max(agent_pause_codes_active),max(list_order_mix) from vicidial_campaigns where campaign_id IN($group_SQL);";

			$stmtB="select sum(dialable_leads),sum(calls_today),sum(drops_today),avg(drops_answers_today_pct),avg(differential_onemin),avg(agents_average_onemin),sum(balance_trunk_fill),sum(answers_today),max(status_category_1),sum(status_category_count_1),max(status_category_2),sum(status_category_count_2),max(status_category_3),sum(status_category_count_3),max(status_category_4),sum(status_category_count_4) from vicidial_campaign_stats where campaign_id IN($group_SQL);";
			}
		}
	if ($DB > 0) {echo "\n|$stmt|$stmtB|\n";}

  
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$DIALlev =		$row[0];
	$DIALstatusA =	$row[1];
	$DIALstatusB =	$row[2];
	$DIALstatusC =	$row[3];
	$DIALstatusD =	$row[4];
	$DIALstatusE =	$row[5];
	$DIALorder =	$row[6];
	$DIALfilter =	$row[7];
	$HOPlev =		$row[8];
	$DIALmethod =	$row[9];
	$maxDIALlev =	$row[10];
	$DROPmax =		$row[11];
	$targetDIFF =	$row[12];
	$ADAintense =	$row[13];
	$ADAavailonly =	$row[14];
	$TAPERtime =	$row[15];
	$CALLtime =		$row[16];
	$DIALtimeout =	$row[17];
	$DIALstatuses =	$row[18];
	$agent_pause_codes_active = $row[19];
	$DIALmix =		$row[20];


	$stmt="select count(*) from vicidial_hopper $group_SQLwhere;";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$VDhop = $row[0];

  //echo $stmtB;
	$rslt=mysql_query($stmtB, $link);
	$row=mysql_fetch_row($rslt);
	
	
	$DAleads =		$row[0];
	$callsTODAY =	$row[1];
	$dropsTODAY =	$row[2];
	$drpctTODAY =	$row[3];
	$diffONEMIN =	$row[4];
	$agentsONEMIN = $row[5];
	$balanceFILL =	$row[6];
	$answersTODAY = $row[7];
	if ($multi_drop > 0)
		{
		if ( ($dropsTODAY > 0) and ($answersTODAY > 0) )
			{
			
			### Mod by fnatic 
			### $drpctTODAY = ( ($dropsTODAY / $answersTODAY) * 100);
            $drpctTODAY = ( ($dropsTODAY / $callsTODAY) * 100);
			$drpctTODAY = round($drpctTODAY, 2);
			$drpctTODAY = sprintf("%01.2f", $drpctTODAY);
			}
		else
			{$drpctTODAY=0;}
		}
	$VSCcat1 =		$row[8];
	$VSCcat1tally = $row[9];
	$VSCcat2 =		$row[10];
	$VSCcat2tally = $row[11];
	$VSCcat3 =		$row[12];
	$VSCcat3tally = $row[13];
	$VSCcat4 =		$row[14];
	$VSCcat4tally = $row[15];

	if ( ($diffONEMIN != 0) and ($agentsONEMIN > 0) )
		{
		$diffpctONEMIN = ( ($diffONEMIN / $agentsONEMIN) * 100);
		$diffpctONEMIN = sprintf("%01.2f", $diffpctONEMIN);
		}
	else {$diffpctONEMIN = '0.00';}

	$stmt="select sum(local_trunk_shortage) from vicidial_campaign_server_stats $group_SQLwhere;";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$balanceSHORT = $row[0];

	if (ereg('DISABLED',$DIALmix))
		{
		$DIALstatuses = (preg_replace("/ -$|^ /","",$DIALstatuses));
		$DIALstatuses = (ereg_replace(' ',', ',$DIALstatuses));
		}
	else
		{
		$stmt="select vcl_id from vicidial_campaigns_list_mix where status='ACTIVE' $groupSQLand limit 1;";
		$rslt=mysql_query($stmt, $link);
		$Lmix_to_print = mysql_num_rows($rslt);
		if ($Lmix_to_print > 0)
			{
			$row=mysql_fetch_row($rslt);
			$DIALstatuses = "List Mix: $row[0]";
			$DIALorder =	"List Mix: $row[0]";
			}
		}
	
	$str_table_top_info= "<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"bordertop\"><TR>";
  $str_table_top_info .= "<td width=\"15%\" class=\"font_date\"></TD><td width=\"7%\" class=\"font_left\"></TD>";
	$str_table_top_info .= "<td width=\"19%\" class=\"font_date\"></TD><td width=\"10%\" class=\"font_left\"></TD>";
	$str_table_top_info .= "<td width=\"11%\" class=\"font_date\"></TD><td width=\"7%\" class=\"font_left\"></TD>";
	$str_table_top_info .= "<td width=\"13%\" class=\"font_date\"></TD><td width=\"18%\" class=\"font_left\"></TD>";	
  //$str_table_top_info .= "<td width=\"15%\" class=\"font_date\">拨号级别:</TD><td width=\"7%\" class=\"font_left\">".round($DIALlev,5)."</TD>";
	//$str_table_top_info .= "<td width=\"19%\" class=\"font_date\">中继线路:</TD><td width=\"10%\" class=\"font_left\">$balanceSHORT / $balanceFILL</TD>";
	//$str_table_top_info .= "<td width=\"11%\" class=\"font_date\">客户过滤:</TD><td width=\"7%\" class=\"font_left\">$DIALfilter</TD>";
	//$str_table_top_info .= "<td width=\"13%\" class=\"font_date\">时    间:</TD><td width=\"18%\" class=\"font_left\">$NOW_TIME</TD>";
	$str_table_top_info .= "</TR>";

	if ($adastats>1)
		{
		$str_table_top_info .= "<TR BGCOLOR=\"#f7f7f7\">";
		$str_table_top_info .= "<td class=\"font_date\">预拨号级别:</TD><td class=\"font_left\">$maxDIALlev</TD>";
		$str_table_top_info .= "<td class=\"font_date\">最高掉线率:</TD><td class=\"font_left\">$DROPmax%</TD>";
		$str_table_top_info .= "<td class=\"font_date\">等待目标差异:</TD><td class=\"font_left\">$targetDIFF</TD>";
		$str_table_top_info .= "<td class=\"font_date\">拨号强度:</TD><td class=\"font_left\">$ADAintense</TD>";
		$str_table_top_info .= "</TR>";

		$str_table_top_info .= "<TR BGCOLOR=\"#f7f7f7\">";
		$str_table_top_info .= "<td class=\"font_date\">拨号超时(秒):</TD><td class=\"font_left\">$DIALtimeout</TD>";
		$str_table_top_info .= "<td class=\"font_date\">期望停止时间:</TD><td class=\"font_left\">$TAPERtime</TD>";
		$str_table_top_info .= "<td class=\"font_date\">拨号时间方案:</TD><td class=\"font_left\">$CALLtime</TD>";
		$str_table_top_info .= "<td class=\"font_date\">可用话务员方案:</TD><td class=\"font_left\">$ADAavailonly</TD>";
		$str_table_top_info .= "</TR>";
		}

	$str_table_top_info .= "<TR>";
	$str_table_top_info .= "<td class=\"font_date\">拨号级别:</TD><td class=\"font_left\">".round($DIALlev,5)."</TD>";
	$str_table_top_info .= "<td class=\"font_date\">可拨打的Leads:</TD><td class=\"font_left\">$DAleads</TD>";
	//$str_table_top_info .= "<td class=\"font_date\">今天进线总数:</TD><td class=\"font_left\">$callsTODAY</TD>";
	$str_table_top_info .= "<td class=\"font_date\">可用话务员/分钟:</TD><td class=\"font_left\"> " . round($agentsONEMIN,3) . "</TD>";
	$str_table_top_info .= "<td class=\"font_date\">拨号模式:</TD><td class=\"font_left\">$DIALmethod</TD>";
	$str_table_top_info .= "</TR>";

	$str_table_top_info .= "<TR>";
	$str_table_top_info .= "<td class=\"font_date\">拨号漏斗级别:</TD><td class=\"font_left\">$HOPlev</TD>";
	$str_table_top_info .= "<td class=\"font_date\">掉线/应答:</TD><td class=\"font_left\">$dropsTODAY / $answersTODAY</TD>";
	$str_table_top_info .= "<td class=\"font_date\">可用Leads状态:</TD><td class=\"font_left\" colspan=3>$DIALstatuses</TD>";
	$str_table_top_info .= "<!--<td class=\"font_date\">DL DIFF:&nbsp;</TD><td class=\"font_left\">$diffONEMIN&nbsp;</TD>-->";
	$str_table_top_info .= "</TR>";

	$str_table_top_info .= "<TR>";
	$str_table_top_info .= "<td class=\"font_date\">漏斗的Leads数量:</TD><td class=\"font_left\">$VDhop</TD>";
	$str_table_top_info .= "<td class=\"font_date\">掉线率:</TD><td class=\"font_left\">";
	if ($drpctTODAY >= $DROPmax)
		{$str_table_top_info .= "$drpctTODAY%</font>";}
	else
		{$str_table_top_info .= "$drpctTODAY%";}
	$str_table_top_info .= "</TD>";
  
  $str_table_top_info .= "<td class=\"font_date\"></TD><td class=\"font_left\"></TD>";
	//$str_table_top_info .= "<td class=\"font_date\">Leads的排序:</TD><td class=\"font_left\">$DIALorder</TD>";
	$str_table_top_info .= "<td class=\"font_date\"><!--DIFF:-->&nbsp;</TD><td class=\"font_left\"><!--$diffpctONEMIN%-->&nbsp;</TD>";

	$str_table_top_info .= "</TR>";
    $str_table_top_info .= "</table>";
	if($report_name=="real" || $report_name==""){
		//Campaign信息区
		echo $str_table_top_info;
	}
	echo "$DROPINGROUPstatsHTML\n";
	echo "$CARRIERstatsHTML\n";
	}
echo "<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">";
echo "<TR>";
echo "<TD>";
if ( (!eregi('NULL',$VSCcat1)) and (strlen($VSCcat1)>0) )
	{echo "<font size=2><B>$VSCcat1:</B> &nbsp; $VSCcat1tally &nbsp;  &nbsp;  &nbsp; \n";}
if ( (!eregi('NULL',$VSCcat2)) and (strlen($VSCcat2)>0) )
	{echo "<font size=2><B>$VSCcat2:</B> &nbsp; $VSCcat2tally &nbsp;  &nbsp;  &nbsp; \n";}
if ( (!eregi('NULL',$VSCcat3)) and (strlen($VSCcat3)>0) )
	{echo "<font size=2><B>$VSCcat3:</B> &nbsp; $VSCcat3tally &nbsp;  &nbsp;  &nbsp; \n";}
if ( (!eregi('NULL',$VSCcat4)) and (strlen($VSCcat4)>0) )
	{echo "<font size=2><B>$VSCcat4:</B> &nbsp; $VSCcat4tally &nbsp;  &nbsp;  &nbsp; \n";}
echo "</TD></TR>";
echo "<TR>";
echo "<TD class=\"view\">";
	if($report_name=="real" || $report_name==""){
      echo "$ingroup_detail";
  }    
echo "</TD>";
echo "</TR>";
echo "</TABLE>";
echo "</FORM>";

##### check for campaigns with no dialable leads if enabled #####
if ( ($with_inbound != 'O') and ($NOLEADSalert == 'YES') )
	{
	$NDLcampaigns='';
	$stmtB="select campaign_id from vicidial_campaign_stats where campaign_id IN($group_SQL) and dialable_leads < 1 order by campaign_id;";
	if ($DB > 0) {echo "\n|$stmt|$stmtB|\n";}
	$rslt=mysql_query($stmtB, $link);
	$campaigns_to_print = mysql_num_rows($rslt);
	$ctp=0;
	while ($campaigns_to_print > $ctp)
		{
		$row=mysql_fetch_row($rslt);
		$NDLcampaigns .=		" <a href=\"./admin.php?ADD=34&campaign_id=$row[0]\">$row[0]</a> &nbsp; ";
		$ctp++;
		if (preg_match("/0$|5$/",$ctp))
			{$NDLcampaigns .= "<BR>";}
		}
	if ($ctp > 0)
		{
		echo "<span style=\"position:absolute;left:0px;top:47px;z-index:15;\" id=no_dialable_leads_span>\n";
		echo "<TABLE WIDTH=500 CELLPADDING=0 CELLSPACING=0 BGCOLOR=\"#d9e6fe\"><TR><TD align=right style=padding-right:5px;><a href=\"#\" onclick=\"closeAlert('no_dialable_leads_span');\">关闭</a><TD></TR><TR><TD ALIGN=CENTER>\n";
		echo "<BR><BR><BR><BR><BR><b>Campaigns没有可用的leads:<BR><BR>$NDLcampaigns<b><BR>";
		echo "<BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR> &nbsp; ";
		echo "</TD></TR></TABLE>\n";
		echo "</span>\n";
		}
	}
}

}
####end heibo summary报表 2011-3-16 17:04:55

####heibo 2011-3-16 17:05:02 加入的summary报表  $sumreport 为N 为原来的报表  $sumreport 为Y 为所有Campaign报表
if ($sumreport == "N") {

###################################################################################
###### INBOUND/OUTBOUND CALLS
###################################################################################

if ($campaign_allow_inbound > 0)
	{
	if (eregi('ALL-ACTIVE',$group_string)) 
		{
		$stmt="select closer_campaigns from vicidial_campaigns $group_SQLwhere";
		$rslt=mysql_query($stmt, $link);
		$closer_campaigns="";
		while ($row=mysql_fetch_row($rslt)) 
			{
			$closer_campaigns.="$row[0]";
			}
		$closer_campaigns = preg_replace("/^ | -$/","",$closer_campaigns);
		$closer_campaigns = preg_replace("/ - /"," ",$closer_campaigns);
		$closer_campaigns = preg_replace("/ /","','",$closer_campaigns);
		$closer_campaignsSQL = "'$closer_campaigns'";
		}	
	$stmtB="from vicidial_auto_calls where status NOT IN('XFER') and ( (call_type='IN' and campaign_id IN($closer_campaignsSQL)) or (call_type IN('OUT','OUTBALANCE') $group_SQLand) ) order by queue_priority desc,campaign_id,call_time;";
	}
else
	{
	$stmtB="from vicidial_auto_calls where status NOT IN('XFER') $group_SQLand order by queue_priority desc,campaign_id,call_time;";
	}
if ($CALLSdisplay > 0)
	{
	$stmtA = "SELECT status,campaign_id,phone_number,server_ip,UNIX_TIMESTAMP(call_time),call_type,queue_priority,agent_only";
	}
else
	{
	$stmtA = "SELECT status";
	}

$str_table_info = "<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"number\">";

$k=0;
$agentonlycount=0;
$stmt = "$stmtA $stmtB";

$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$parked_to_print = mysql_num_rows($rslt);

	if ($parked_to_print > 0)
	{
	$i=0;
  
  ### add by heibo 先取数据 2011-4-8 11:18:14
  $Listrow = array();
  $ListIp  = array();
  while( $i < $parked_to_print ){
  	$Listrow[$i] = mysql_fetch_row($rslt);
  	$ListIp[$i]  = $Listrow[$i][3];
  	$i++;
  }
  ###过滤重复ip
  $ListIp   = array_unique($ListIp);
  $ipcount  = count($ListIp);

  ###

  $i=0;	
	$out_total=0;
	$out_ring=0;
	$out_live=0;
	$in_ivr=0;
  $in_incall =0;
  
  ###按ip取数据
  foreach($ListIp as $ipvalue){
     $ListIpData[$ipvalue]["out_total"] = 0;
     $ListIpData[$ipvalue]["out_ring"]  = 0;
     $ListIpData[$ipvalue]["out_live"]  = 0;
     $ListIpData[$ipvalue]["in_ivr"]    = 0;
     $ListIpData[$ipvalue]["in_incall"] = 0;     	
  }
  ###

	while ($i < $parked_to_print)
		{
		$row=$Listrow[$i];
    $ipvalue = $row[3];
    
		if (eregi("LIVE",$row[0])) 
			{
			$out_live++;
      $ListIpData[$ipvalue]["out_live"]++;
			if ($CALLSdisplay > 0)
				{
				$CDstatus[$k] =			$row[0];
				$CDcampaign_id[$k] =	$row[1];
				$CDphone_number[$k] =	$row[2];
				$CDserver_ip[$k] =		$row[3];
				$CDcall_time[$k] =		$row[4];
				$CDcall_type[$k] =		$row[5];
				$CDqueue_priority[$k] =	$row[6];
				$CDagent_only[$k] =		$row[7];
				if (strlen($CDagent_only[$k]) > 0) {$agentonlycount++;}
				$k++;
				}
			}
		else
			{
			if (eregi("IVR",$row[0])) 
				{
				$in_ivr++;
        $ListIpData[$ipvalue]["in_ivr"]++;
				if ($CALLSdisplay > 0)
					{
					$CDstatus[$k] =			$row[0];
					$CDcampaign_id[$k] =	$row[1];
					$CDphone_number[$k] =	$row[2];
					$CDserver_ip[$k] =		$row[3];
					$CDcall_time[$k] =		$row[4];
					$CDcall_type[$k] =		$row[5];
					$CDqueue_priority[$k] =	$row[6];
					$CDagent_only[$k] =		$row[7];
					if (strlen($CDagent_only[$k]) > 0) {$agentonlycount++;}
					$k++;
					}
				}elseif (eregi("CLOSER",$row[0])) {
				 $nothing=1;   
				 $in_incall = $in_incall + 1;
				 $ListIpData[$ipvalue]["in_incall"]++;
		  }
			else 
				{ $out_ring++;
					$ListIpData[$ipvalue]["out_ring"]++;
				}
			}
 
		$out_total++;
		$ListIpData[$ipvalue]["out_total"]++;
		$i++;
		} 

		if ($out_live > 0) {$F='<FONT class="r1">'; $FG='</FONT>';}
		if ($out_live > 4) {$F='<FONT class="r2">'; $FG='</FONT>';}
		if ($out_live > 9) {$F='<FONT class="r3">'; $FG='</FONT>';}
		if ($out_live > 14) {$F='<FONT class="r4">'; $FG='</FONT>';}
	### Mod by fnatic start	
	  foreach($ListIp as $ipvalue){
				$str_table_info .= "<tr>";
				if ($ipcount <= 1){
					  $str_table_info .= "<td width=\"10%\" class=\"border_bot\" align=center ><B>实时通话统计:</B>" . "<span class=\"total_font_calls\">" . $ListIpData[$ipvalue]["out_total"] . "</span></td>" ;
				}else{
				    $str_table_info .= "<td width=\"20%\" class=\"border_bot\" align=center ><B>" . $ipvalue . "  -- " . "实时通话统计:</B>" . "<span class=\"total_font_calls\">" . $ListIpData[$ipvalue]["out_total"] . "</span></td>" ;
				}
			  
				$str_table_info .= "<td width=\"5%\" class=\"border_bot\">通话:</td><td width=\"5%\" class=\"font_calls\">";
				if ($campaign_allow_inbound > 0)
					{$str_table_info .= $ListIpData[$ipvalue]['in_incall'] . "</td>";}
				else
					{$str_table_info .= $ListIpData[$ipvalue]['in_incall'] . "</td>";}
				
				$str_table_info .= "<td width=\"5%\" class=\"border_bot\">振铃:</td><td width=\"5%\" class=\"font_calls\">" . $ListIpData[$ipvalue]['out_ring'] . "</td>";
				$str_table_info .= "<td width=\"5%\" class=\"border_bot\">队列:</td><td width=\"5%\" class=\"font_calls\">" . $ListIpData[$ipvalue]['out_live'] . "</td>";
				$str_table_info .= "<td width=\"5%\" class=\"border_bot\">IVR:</td><td width=\"5%\" class=\"font_calls\">" . $ListIpData[$ipvalue]['in_ivr'] . "</td>";
				$str_table_info .= "<td width=\"5%\" class=\"border_bot\">&nbsp;</td><td width=\"5%\" class=\"font_calls\">&nbsp;</td>";
		    $str_table_info .= "<td width=\"5%\" class=\"border_bot\">&nbsp;</td><td width=\"5%\" class=\"font_calls\">&nbsp;</td>";		
				$str_table_info .= "</tr>";
	 }
	### Mod by fnatic end
	}
	else
	{
	//echo "<tr><td colspan=5><font color=red style=\"font-size:11px;\">无电话等待</font></td></tr>";
	 $str_table_info .= "<tr>";
	 $str_table_info .= "<td width=\"10%\" class=\"border_bot\" align=center ><b>实时通话统计:</b>" . "<span class=\"total_font_calls\">" . chk_callstatus_number($out_total) . "</span></td>" ;
	 $str_table_info .= "<td width=\"5%\" class=\"border_bot\">通话:</td><td width=\"5%\" class=\"font_calls\">";
	 $in_incall=chk_callstatus_number($in_incall);
	 if ($campaign_allow_inbound > 0)
	  {$str_table_info .= "$in_incall</td>";}
	 else
	  {$str_table_info .= "$in_incall</td>";}
     
	 $str_table_info .= "<td width=\"5%\" class=\"border_bot\">振铃:</td><td width=\"5%\" class=\"font_calls\">".chk_callstatus_number($out_ring)."</td>";
	 $str_table_info .= "<td width=\"5%\" class=\"border_bot\">队列:</td><td width=\"5%\" class=\"font_calls\">".chk_callstatus_number($out_live)."</td>";
	 $str_table_info .= "<td width=\"5%\" class=\"border_bot\">IVR:</td><td width=\"5%\" class=\"font_calls\">".chk_callstatus_number($in_ivr)."</td>";
     $str_table_info .= "<td width=\"5%\" class=\"border_bot\">&nbsp;</td><td width=\"5%\" class=\"font_calls\">&nbsp;</td>";
     $str_table_info .= "<td width=\"5%\" class=\"border_bot\">&nbsp;</td><td width=\"5%\" class=\"font_calls\">&nbsp;</td>";     
	 $str_table_info .= "</tr>";
	}


}
####end heibo summary报表 2011-3-16 17:04:55





####heibo 2011-3-16 17:05:02 加入的summary报表  $sumreport 为N 为原来的报表  $sumreport 为Y 为所有Campaign报表
if ($sumreport == "N") {
	
###################################################################################
###### CALLS WAITING
###################################################################################
$agentonlyheader = '';
if ($agentonlycount > 0)
	{$agentonlyheader = 'AGENTONLY';}
$Cecho = '';

$Cecho .= "<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"waitbor\">";
$Cecho .= "<tr>";
$Cecho .= "<td width=\"11%\" class=\"wait_tit\">当前状态</td>";
$Cecho .= "<td width=\"19%\" class=\"wait_tit\">技能组</td>";
$Cecho .= "<td width=\"20%\" class=\"wait_tit\">客户电话</td>";
$Cecho .= "<td width=\"15%\" class=\"wait_tit\">服务器IP</td>";
$Cecho .= "<td width=\"13%\" class=\"wait_tit\">通话时长</td>";
$Cecho .= "<td width=\"11%\" class=\"wait_tit\">通话类型</td>";
$Cecho .= "<td width=\"11%\" class=\"wait_tit\">级别</td>";
$Cecho .= "<td width=\"11%\" class=\"wait_tit\">$agentonlyheader</td>";
$Cecho .= "</tr>";
//$Cecho .= "+--------+----------------------+--------------+-----------------+---------+------------+----------+\n";
//$Cecho .= "| STATUS | CAMPAIGN             | PHONE NUMBER | SERVER_IP       | DIALTIME| CALL TYPE  | PRIORITY | $agentonlyheader\n";
//$Cecho .= "+--------+----------------------+--------------+-----------------+---------+------------+----------+\n";

$p=0;
while($p<$k)
	{
	$Cstatus =			sprintf("%-6s", $CDstatus[$p]);
	$Ccampaign_id =		sprintf("%-20s", $CDcampaign_id[$p]);//Mod1
	$Cphone_number =	sprintf("%-12s", $CDphone_number[$p]);
	$Cserver_ip =		sprintf("%-15s", $CDserver_ip[$p]);
	$Ccall_type =		sprintf("%-10s", $CDcall_type[$p]);
	$Cqueue_priority =	sprintf("%8s", $CDqueue_priority[$p]);
	$Cagent_only =		sprintf("%8s", $CDagent_only[$p]);

	$Ccall_time_S = ($STARTtime - $CDcall_time[$p]);
	$Ccall_time_MS =		sec_convert($Ccall_time_S,'M'); 
	$Ccall_time_MS =		sprintf("%7s", $Ccall_time_MS);

	$G = '';		$EG = '';
	if ($CDcall_type[$p] == 'IN')
		{
		$G="<SPAN class=\"csc$CDcampaign_id[$p]\"><B>"; $EG='</B></SPAN>';
		}
	if (strlen($CDagent_only[$p]) > 0)
		{$Gcalltypedisplay = "$G$Cagent_only$EG";}
	else
		{$Gcalltypedisplay = '';}

	### Add by fnatic start
        $stmtE="select group_name from vicidial_inbound_groups where group_id='".$Ccampaign_id."'";
        $rsltE=mysql_query($stmtE, $link);
		$group_name=mysql_fetch_row($rsltE);
		$group_name=$group_name[0];
	### Add by fnatic end

	//$Cecho .= "| $G$Cstatus$EG | $G$Ccampaign_id$EG | $G$Cphone_number$EG | $G$Cserver_ip$EG | $G$Ccall_time_MS$EG | $G$Ccall_type$EG | $G$Cqueue_priority$EG | $Gcalltypedisplay \n";
	$Cecho .= "<tr><td class=\"wait_list\">$Cstatus</td><td class=\"wait_list\">$group_name</td><td class=\"wait_list\">$Cphone_number</td><td class=\"wait_list\">$Cserver_ip</td> <td class=\"wait_list\">$Ccall_time_MS</td><td class=\"wait_list\">$Ccall_type</td><td class=\"wait_list\">$Cqueue_priority</td><td class=\"wait_list\">$Gcalltypedisplay</td>";

	$p++;
	}
//$Cecho .= "+--------+----------------------+--------------+-----------------+---------+------------+----------+\n";
  $Cecho .= "</table>";
if ($p<1)
	{$Cecho='';}

}
####end heibo summary报表 2011-3-16 17:04:55


###################################################################################
###### AGENT TIME ON SYSTEM
###################################################################################


####heibo 2011-3-16 17:05:02 加入的summary报表  $sumreport 为N 为原来的报表  $sumreport 为Y 为所有Campaign报表
if ($sumreport == "N") {	
	
$agent_incall=0;
$agent_ready=0;
$agent_paused=0;
$agent_dead=0;
$agent_total=0;
$agent_ring = 0;
$agent_dispo=0;

$phoneord=$orderby;
$userord=$orderby;
$groupord=$orderby;
$timeord=$orderby;
$campaignord=$orderby;
### add by fnatic @param $statusord ###
$statusord=$orderby;

if ($phoneord=='phoneup') {$phoneord='phonedown';}
  else {$phoneord='phoneup';}
if ($userord=='userup') {$userord='userdown';}
  else {$userord='userup';}
if ($groupord=='groupup') {$groupord='groupdown';}
  else {$groupord='groupup';}
if ($timeord=='timeup') {$timeord='timedown';}
  else {$timeord='timeup';}
if ($campaignord=='campaignup') {$campaignord='campaigndown';}
  else {$campaignord='campaignup';}
### add by fnatic @param $statusord ###
if($statusord=='statusup') {$statusord='statusdown';}
  else {$statusord='statusup';}

//$Aecho = '<br/>';
//$Aecho .= "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
//$Aecho .= "<tr>";
//$Aecho .= "<td width=\"50%\">";
//$Aecho .= "<font style=\"font-size:12px;\"><b>Campaign: $group_string\n 话务员列表</font>";
//$Aecho .= "</td>";
//$Aecho .= "<td width=\"50%\" class=\"waitstation\">";
//$Aecho .= "<font color=red style=\"font-size:11px;\">".$NOW_TIME."</font>";
//$Aecho .= "</td>";
//$Aecho .= "</tr>";
//$Aecho .= "</table>";

$HDbegin =			"+";
$HTbegin =			"";

$HDstation =		"----------------+";
//$HTstation =		"<td class=\"HT_tdhead\">位置</td>";

$HDphone =		"-------------+";
$HTphone =		"<td class=\"HT_tdhead\"><a href=\"$PHP_SELF?$groupQS&RR=$RR&DB=$DB&adastats=$adastats&SIPmonitorLINK=$SIPmonitorLINK&report_name=$report_name&IAXmonitorLINK=$IAXmonitorLINK&usergroup=$usergroup&UGdisplay=$UGdisplay&UidORname=$UidORname&orderby=$phoneord&SERVdisplay=$SERVdisplay&CALLSdisplay=$CALLSdisplay&PHONEdisplay=$PHONEdisplay&CUSTPHONEdisplay=$CUSTPHONEdisplay&with_inbound=$with_inbound&monitor_active=$monitor_active&monitor_phone=$monitor_phone&ALLINGROUPstats=$ALLINGROUPstats&DROPINGROUPstats=$DROPINGROUPstats&NOLEADSalert=$NOLEADSalert&CARRIERstats=$CARRIERstats\">分机</a></td>";

$HDuser =			"------------------------+";
$HTuser =			"<td class=\"HT_tdhead\" width=\"180px\"><a href=\"$PHP_SELF?$groupQS&RR=$RR&DB=$DB&adastats=$adastats&SIPmonitorLINK=$SIPmonitorLINK&report_name=$report_name&IAXmonitorLINK=$IAXmonitorLINK&usergroup=$usergroup&UGdisplay=$UGdisplay&UidORname=$UidORname&orderby=$userord&SERVdisplay=$SERVdisplay&CALLSdisplay=$CALLSdisplay&PHONEdisplay=$PHONEdisplay&CUSTPHONEdisplay=$CUSTPHONEdisplay&with_inbound=$with_inbound&monitor_active=$monitor_active&monitor_phone=$monitor_phone&ALLINGROUPstats=$ALLINGROUPstats&DROPINGROUPstats=$DROPINGROUPstats&NOLEADSalert=$NOLEADSalert&CARRIERstats=$CARRIERstats\">话务员</a>";


if ($UidORname>0)
	{
	$HTuser .= " <a href=\"$PHP_SELF?$groupQS&RR=$RR&DB=$DB&adastats=$adastats&SIPmonitorLINK=$SIPmonitorLINK&report_name=$report_name&IAXmonitorLINK=$IAXmonitorLINK&usergroup=$usergroup&UGdisplay=$UGdisplay&UidORname=0&orderby=$orderby&SERVdisplay=$SERVdisplay&CALLSdisplay=$CALLSdisplay&PHONEdisplay=$PHONEdisplay&CUSTPHONEdisplay=$CUSTPHONEdisplay&with_inbound=$with_inbound&monitor_active=$monitor_active&monitor_phone=$monitor_phone&ALLINGROUPstats=$ALLINGROUPstats&DROPINGROUPstats=$DROPINGROUPstats&NOLEADSalert=$NOLEADSalert&CARRIERstats=$CARRIERstats\">显示帐号</a></td>";
	}
else
	{
	$HTuser .= "<a href=\"$PHP_SELF?$groupQS&RR=$RR&DB=$DB&adastats=$adastats&SIPmonitorLINK=$SIPmonitorLINK&report_name=$report_name&IAXmonitorLINK=$IAXmonitorLINK&usergroup=$usergroup&UGdisplay=$UGdisplay&UidORname=1&orderby=$orderby&SERVdisplay=$SERVdisplay&CALLSdisplay=$CALLSdisplay&PHONEdisplay=$PHONEdisplay&CUSTPHONEdisplay=$CUSTPHONEdisplay&with_inbound=$with_inbound&monitor_active=$monitor_active&monitor_phone=$monitor_phone&ALLINGROUPstats=$ALLINGROUPstats&DROPINGROUPstats=$DROPINGROUPstats&NOLEADSalert=$NOLEADSalert&CARRIERstats=$CARRIERstats\"> 显示姓名</a></td>";
	}

//$HTuser .= "信息";


$HDusergroup =		"--------------+";
$HTusergroup =		"<td class=\"HT_tdhead\"><a href=\"$PHP_SELF?$groupQS&RR=$RR&DB=$DB&adastats=$adastats&SIPmonitorLINK=$SIPmonitorLINK&report_name=$report_name&IAXmonitorLINK=$IAXmonitorLINK&usergroup=$usergroup&UGdisplay=$UGdisplay&UidORname=$UidORname&orderby=$groupord&SERVdisplay=$SERVdisplay&CALLSdisplay=$CALLSdisplay&PHONEdisplay=$PHONEdisplay&CUSTPHONEdisplay=$CUSTPHONEdisplay&with_inbound=$with_inbound&monitor_active=$monitor_active&monitor_phone=$monitor_phone&ALLINGROUPstats=$ALLINGROUPstats&DROPINGROUPstats=$DROPINGROUPstats&NOLEADSalert=$NOLEADSalert&CARRIERstats=$CARRIERstats\">用户组</a></td>";

$HDsessionid =		"------------------+";
//$HTsessionid =		"<td class=\"HT_tdhead\">会议室ID</td>";

$HDbarge =			"-------+";
$HTbarge =			"<td class=\"HT_tdhead\">强插</td>";

$HDstatus =			"----------+";
$HTstatus =			"<td class=\"HT_tdhead\">状态</td>";

$HDcustphone =		"-------------+";
$HTcustphone =		"<td class=\"HT_tdhead\" width=\"80px\">客户电话</td>";

$HDserver_ip =		"-----------------+";
$HTserver_ip =		"<td class=\"HT_tdhead\">服务器IP</td>";

$HDcall_server_ip =	"-----------------+";
$HTcall_server_ip =	"<td class=\"HT_tdhead\">拨号服务器IP</td>";

$HDtime =			"---------+";
$HTtime =			"<td class=\"HT_tdhead\" width=\"140px\"><a href=\"$PHP_SELF?$groupQS&RR=$RR&DB=$DB&adastats=$adastats&SIPmonitorLINK=$SIPmonitorLINK&report_name=$report_name&IAXmonitorLINK=$IAXmonitorLINK&usergroup=$usergroup&UGdisplay=$UGdisplay&UidORname=$UidORname&orderby=$timeord&SERVdisplay=$SERVdisplay&CALLSdisplay=$CALLSdisplay&PHONEdisplay=$PHONEdisplay&CUSTPHONEdisplay=$CUSTPHONEdisplay&with_inbound=$with_inbound&monitor_active=$monitor_active&monitor_phone=$monitor_phone&ALLINGROUPstats=$ALLINGROUPstats&DROPINGROUPstats=$DROPINGROUPstats&NOLEADSalert=$NOLEADSalert&CARRIERstats=$CARRIERstats\">当前状态持续时长(分)</a></td>";

$HDcampaign =		"------------+";
$HTcampaign =		"<td class=\"HT_tdhead\"  width=\"90px\"><a href=\"$PHP_SELF?$groupQS&RR=$RR&DB=$DB&adastats=$adastats&SIPmonitorLINK=$SIPmonitorLINK&report_name=$report_name&IAXmonitorLINK=$IAXmonitorLINK&usergroup=$usergroup&UGdisplay=$UGdisplay&UidORname=$UidORname&orderby=$campaignord&SERVdisplay=$SERVdisplay&CALLSdisplay=$CALLSdisplay&PHONEdisplay=$PHONEdisplay&CUSTPHONEdisplay=$CUSTPHONEdisplay&with_inbound=$with_inbound&monitor_active=$monitor_active&monitor_phone=$monitor_phone&ALLINGROUPstats=$ALLINGROUPstats&DROPINGROUPstats=$DROPINGROUPstats&NOLEADSalert=$NOLEADSalert&CARRIERstats=$CARRIERstats\">Campaign</a></td>";

$HDcalls =			"-------+";
$HTcalls =			"<td class=\"HT_tdhead\" width=\"90px\">今天通话</td>";

//Add by fnatic start
$HTcalls .=			"<td class=\"HT_tdhead\" width=\"90px\">今天呼入</td>";
$HTcalls .=			"<td class=\"HT_tdhead\" width=\"90px\">今天呼出</td>";
//Add by fnatic end

$HDpause =	'';
$HTpause =	'';
$HDigcall =			"------+------------------";
$HTholdtime= "<td class=\"HT_tdhead\" width=\"120px\">等待接入时长(秒)</td>";
$HTigcall =			"<td class=\"HT_tdhead\">技能组</td>";

if (!ereg("N",$agent_pause_codes_active))
	{
	$HDstatus =			"----------";
	$HTstatus =			"<td class=\"HT_tdhead\"  width=\"125px\"><a href=\"$PHP_SELF?$groupQS&RR=$RR&DB=$DB&adastats=$adastats&SIPmonitorLINK=$SIPmonitorLINK&report_name=$report_name&IAXmonitorLINK=$IAXmonitorLINK&usergroup=$usergroup&UGdisplay=$UGdisplay&UidORname=$UidORname&orderby=$statusord&SERVdisplay=$SERVdisplay&CALLSdisplay=$CALLSdisplay&PHONEdisplay=$PHONEdisplay&CUSTPHONEdisplay=$CUSTPHONEdisplay&with_inbound=$with_inbound&monitor_active=$monitor_active&monitor_phone=$monitor_phone&ALLINGROUPstats=$ALLINGROUPstats&DROPINGROUPstats=$DROPINGROUPstats&NOLEADSalert=$NOLEADSalert&CARRIERstats=$CARRIERstats\">状态</a> ";
	$HDpause =			"-------+";
	$HTpause =			"</td>";
	}
if ($PHONEdisplay < 1)
	{
	$HDphone =	'';
	$HTphone =	'';
	}
if ($CUSTPHONEdisplay < 1)
	{
	$HDcustphone =	'';
	$HTcustphone =	'';
	}
if ($UGdisplay < 1)
	{
	$HDusergroup =	'';
	$HTusergroup =	'';
	}
if ( ($SIPmonitorLINK<1) and ($IAXmonitorLINK<1) and (!preg_match("/MONITOR|BARGE/",$monitor_active) ) ) 
	{
	$HDsessionid =	"-----------+";
	//$HTsessionid =	"<td class=\"HT_tdhead\">会议室ID</td>";
	}
if ( ($SIPmonitorLINK<2) and ($IAXmonitorLINK<2) and (!preg_match("/BARGE/",$monitor_active) ) ) 
	{
	$HDbarge =		'';
	$HTbarge =		'';
	}
if ($SERVdisplay < 1)
	{
	$HDserver_ip =		'';
	$HTserver_ip =		'';
	$HDcall_server_ip =	'';
	$HTcall_server_ip =	'';
	}



$Aline  = "$HDbegin$HDstation$HDphone$HDuser$HDusergroup$HDsessionid$HDbarge$HDstatus$HDpause$HDcustphone$HDserver_ip$HDcall_server_ip$HDtime$HTholdtime$HDcampaign$HDcalls$HDigcall\n";
//$Bline  = "$HTbegin$HTstation$HTphone$HTuser$HTusergroup$HTsessionid$HTbarge$HTstatus$HTpause$HTcustphone$HTserver_ip$HTcall_server_ip$HTtime$HTcampaign$HTcalls$HTigcall\n";

//Mod by fnatic start
$Bline .="<table class=\"HT_table\" width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">";
$Bline .="<tr>";
//$Bline .="<td class=\"HT_tdhead\">$HTbegin</td>";
$Bline .="$HTstation$HTphone$HTuser$HTusergroup$HTsessionid$HTbarge$HTstatus$HTpause$HTcustphone$HTserver_ip$HTcall_server_ip$HTtime$HTholdtime$HTcampaign$HTcalls$HTigcall";

$Bline .="</tr>";

//Mod by fnatic end


//$Aecho .= "$Aline";
$Aecho .= "$Bline"; // tdhead
//$Aecho .= "$Aline";

if ($orderby=='timeup') {$orderSQL='vicidial_live_agents.status,last_call_time';}
if ($orderby=='timedown') {$orderSQL='vicidial_live_agents.status desc,last_call_time desc';}
if ($orderby=='campaignup') {$orderSQL='vicidial_live_agents.campaign_id,vicidial_live_agents.status,last_call_time';}
if ($orderby=='campaigndown') {$orderSQL='vicidial_live_agents.campaign_id desc,vicidial_live_agents.status desc,last_call_time desc';}
if ($orderby=='groupup') {$orderSQL='user_group,vicidial_live_agents.status,last_call_time';}
if ($orderby=='groupdown') {$orderSQL='user_group desc,vicidial_live_agents.status desc,last_call_time desc';}
if ($orderby=='phoneup') {$orderSQL='extension,server_ip';}
if ($orderby=='phonedown') {$orderSQL='extension desc,server_ip desc';}
### add by fnatic @param $statusord ###
if ($orderby=='statusup') {$orderSQL='vicidial_live_agents.status,vicidial_live_agents.last_state_change asc';}
if ($orderby=='statusdown') {$orderSQL='vicidial_live_agents.status desc,vicidial_live_agents.last_state_change asc';}

if ($UidORname > 0)
	{
	if ($orderby=='userup') {$orderSQL='full_name,status,last_call_time';}
	if ($orderby=='userdown') {$orderSQL='full_name desc,status desc,last_call_time desc';}
	}
else
	{
	if ($orderby=='userup') {$orderSQL='vicidial_live_agents.user';}
	if ($orderby=='userdown') {$orderSQL='vicidial_live_agents.user desc';}
	}
//echo $usergroup . '====';exit;
if (eregi('ALL-ACTIVE',$group_string)) {$UgroupSQL = '';}
else {$UgroupSQL = " and vicidial_live_agents.campaign_id IN($group_SQL)";}
if (strlen($usergroup)<1) {
	//当用户为manager时默认列出该用户所管理的组
	if( $user_level==8 || $user_level==7 || $user_level==6 ){
		$stmt="select user_group from vicidial_user_groups where fun_instr(manager,'$user_name') =1 or fun_instr(supervisor,'$user_name') =1 or fun_instr(qa,'$user_name') =1";
	    $rslt=mysql_query($stmt, $link);
	    $count_temp = mysql_num_rows($rslt);
	    $i = 0;
	    if($DB) {echo "$stmt\n";}
	    $user_group_arr =  array();
	    while($i< $count_temp){
			  $row=mysql_fetch_row($rslt);
			  $user_group_arr[]= "'" . $row[0] . "'";
			  $i++;
	    }
		$usergroupSQL = ' and user_group in(' . implode(",",$user_group_arr) . ')';
		//echo $usergroupSQL;exit;
	}else{
		$usergroupSQL = '';
	}
}
else {$usergroupSQL = " and user_group='" . mysql_real_escape_string($usergroup) . "'";}
if(!empty($_GET['et1_group_value'])){
$usergroupSQL .=" and vicidial_users.user in ({$_GET['et1_group_value']})";
//var_dump($_GET['et1_group_value']);
}
$stmt="select extension,vicidial_live_agents.user,conf_exten,vicidial_live_agents.status,vicidial_live_agents.server_ip,UNIX_TIMESTAMP(last_call_time),UNIX_TIMESTAMP(last_call_finish),call_server_ip,vicidial_live_agents.campaign_id,vicidial_users.user_group,vicidial_users.full_name,vicidial_live_agents.comments,vicidial_live_agents.calls_today,vicidial_live_agents.callerid,lead_id,UNIX_TIMESTAMP(last_state_change) from vicidial_live_agents,vicidial_users where vicidial_live_agents.user=vicidial_users.user $UgroupSQL $usergroupSQL order by $orderSQL;";
//echo $stmt;
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$talking_to_print = mysql_num_rows($rslt);
	if ($talking_to_print > 0)
	{
	$i=0;
	while ($i < $talking_to_print)
		{
		$row=mysql_fetch_row($rslt);

		$Aextension[$i] =		$row[0];
		$Auser[$i] =			$row[1];
		$Asessionid[$i] =		$row[2];
		$Astatus[$i] =			$row[3];
		$Aserver_ip[$i] =		$row[4];
		$Acall_time[$i] =		$row[5];
		$Acall_finish[$i] =		$row[6];
		$Acall_server_ip[$i] =	$row[7];
		$Acampaign_id[$i] =		$row[8];
		$Auser_group[$i] =		$row[9];
		$Afull_name[$i] =		$row[10];
		$Acomments[$i] = 		$row[11];
		$Acalls_today[$i] =		$row[12];
		$Acallerid[$i] =		$row[13];
		$Alead_id[$i] =			$row[14];
		$Astate_change[$i] =	$row[15];

		### 3-WAY Check ###
		if ($Alead_id[$i]!=0) 
			{
			$threewaystmt="select UNIX_TIMESTAMP(last_call_time) from vicidial_live_agents where lead_id='$Alead_id[$i]' and status='INCALL' order by UNIX_TIMESTAMP(last_call_time) desc";
			$threewayrslt=mysql_query($threewaystmt, $link);
			if (mysql_num_rows($threewayrslt)>1) 
				{
				$Astatus[$i]="3-WAY";
				$srow=mysql_fetch_row($threewayrslt);
				$Acall_mostrecent[$i]=$srow[0];
				}
			}
		### END 3-WAY Check ###

		$i++;
		}
   

   
$callerids='';
$pausecode='';
$stmt="select callerid,lead_id,phone_number from vicidial_auto_calls;";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$calls_to_list = mysql_num_rows($rslt);
	if ($calls_to_list > 0)
	{
	$i=0;
	while ($i < $calls_to_list)
		{
		$row=mysql_fetch_row($rslt);
		$callerids .=	"$row[0]|";
		$VAClead_ids[$i] =	$row[1];
		$VACphones[$i] =	$row[2];
		$i++;
		}
	}

### Lookup phone logins
	$i=0;
	while ($i < $talking_to_print)
		{
		if (eregi("R/",$Aextension[$i])) 
			{
			$protocol = 'EXTERNAL';
			$dialplan = eregi_replace('R/',"",$Aextension[$i]);
			$dialplan = eregi_replace("\@.*",'',$dialplan);
			$exten = "dialplan_number='$dialplan'";
			}
		if (eregi("Local/",$Aextension[$i])) 
			{
			$protocol = 'EXTERNAL';
			$dialplan = eregi_replace('Local/',"",$Aextension[$i]);
			$dialplan = eregi_replace("\@.*",'',$dialplan);
			$exten = "dialplan_number='$dialplan'";
			}
		if (eregi('SIP/',$Aextension[$i])) 
			{
			$protocol = 'SIP';
			$dialplan = eregi_replace('SIP/',"",$Aextension[$i]);
			$dialplan = eregi_replace("-.*",'',$dialplan);
			$exten = "extension='$dialplan'";
			}
		if (eregi('IAX2/',$Aextension[$i])) 
			{
			$protocol = 'IAX2';
			$dialplan = eregi_replace('IAX2/',"",$Aextension[$i]);
			$dialplan = eregi_replace("-.*",'',$dialplan);
			$exten = "extension='$dialplan'";
			}
		if (eregi('Zap/',$Aextension[$i])) 
			{
			$protocol = 'Zap';
			$dialplan = eregi_replace('Zap/',"",$Aextension[$i]);
			$exten = "extension='$dialplan'";
			}
		if (eregi('DAHDI/',$Aextension[$i])) 
			{
			$protocol = 'Zap';
			$dialplan = eregi_replace('DAHDI/',"",$Aextension[$i]);
			$exten = "extension='$dialplan'";
			}

		$stmt="select login from phones where server_ip='$Aserver_ip[$i]' and $exten and protocol='$protocol';";
		$rslt=mysql_query($stmt, $link);
		if ($DB) {echo "$stmt\n";}
		$phones_to_print = mysql_num_rows($rslt);
		if ($phones_to_print > 0)
			{
			$row=mysql_fetch_row($rslt);
			$Alogin[$i] = "$row[0]-----$i";
			}
		else
			{
			$Alogin[$i] = "$Aextension[$i]-----$i";
			}
		$i++;
		}

### Sort by phone if selected
	if ($orderby=='phoneup')
		{
		sort($Alogin);
		}
	if ($orderby=='phonedown')
		{
		rsort($Alogin);
		}

### Run through the loop to display agents




### Add by fnatic status images start
define('NEW_STYLE','./new_style/images');
$Status_Image_Description="";
$Ring_Status_Img="<img style=\"vertical-align:text-bottom\" src=".NEW_STYLE."/a.gif"." border=0 title='振铃' />";
$Nocall_Status_Ready_Img="<img style=\"vertical-align:text-bottom\" src=".NEW_STYLE."/ready.gif"." border=0 title='可用' />";
$Nocall_Status_Dead_Img="<img style=\"vertical-align:text-bottom\" src=".NEW_STYLE."/dead.gif"." border=0  title='休止' />";
$Nocall_Status_Dispo_Img="<img style=\"vertical-align:text-bottom\" src=".NEW_STYLE."/dispo.gif"." border=0 title='小结' />";
$Nocall_Status_Incall_Img="<img style=\"vertical-align:text-bottom\" src=".NEW_STYLE."/incall.gif"." border=0 title='通话' />";
$Nocall_Status_Paused_Img="<img style=\"vertical-align:text-bottom\" src=".NEW_STYLE."/paused.gif"." border=0 title='暂停' />";
$Incall_Status_A_Img="<img style=\"vertical-align:text-bottom\" src=".NEW_STYLE."/a.gif"." border=0 title='自动外拨' />";
$Incall_Status_M_img="<img style=\"vertical-align:text-bottom\" src=".NEW_STYLE."/m.gif"." border=0 title='手动外拨' />";
$Incall_status_I_img="<img style=\"vertical-align:text-bottom\" src=".NEW_STYLE."/i.gif"." border=0 title='呼入' />";
### Add by fnatic status images end

	$j=0;
	$agentcount=0;
	
   ### add by heibo 2011-4-8 12:24:22 按IP显示 bug 1514
   $AgentIp = array_unique($Aserver_ip);
   
   foreach($AgentIp as $ipvalue){
		 $AgentIpData[$ipvalue]["agent_incall"] = 0;
		 $AgentIpData[$ipvalue]["agent_ready"]  = 0;
		 $AgentIpData[$ipvalue]["agent_paused"]  = 0;
		 $AgentIpData[$ipvalue]["agent_dead"]    = 0;
		 $AgentIpData[$ipvalue]["agent_total"] = 0;     
		 $AgentIpData[$ipvalue]["agent_ring"]    = 0;
		 $AgentIpData[$ipvalue]["agent_dispo"] = 0;     	
   }
   ####

	
	while ($j < $talking_to_print)
		{
		$n=0;
		$custphone='';
		##当前IP
		$ipvalue = $Aserver_ip[$j];
		
		while ($n < $calls_to_list)
			{
			if ( (ereg("$VAClead_ids[$n]", $Alead_id[$j])) and (strlen($VAClead_ids[$n]) == strlen($Alead_id[$j])) )
				{$custphone = $VACphones[$n];}
			$n++;
			}

		$phone_split = explode("-----",$Alogin[$j]);
		$i = $phone_split[1];

		if (eregi("READY|PAUSED",$Astatus[$i]))
			{
			$Acall_time[$i]=$Astate_change[$i];

			if ($Alead_id[$i] > 0)
				{
				$Astatus[$i] =	'DISPO';
				$Lstatus =		'DISPO';
				$status =		' DISPO';
				## Add by fnatic 
				$Status_Image_Description=$Nocall_Status_Dispo_Img;
				}
			}
		if ($non_latin < 1)
			{
			$extension = eregi_replace('Local/',"",$Aextension[$i]);
			$extension =		sprintf("%-14s", $extension);
			while(strlen($extension)>14) {$extension = substr("$extension", 0, -1);}
			}
		else
			{
			$extension = eregi_replace('Local/',"",$Aextension[$i]);
			$extension =		sprintf("%-48s", $extension);
			while(mb_strlen($extension, 'utf-8')>14) {$extension = mb_substr("$extension", 0, -1,'utf8');}
			}

		$phone =			sprintf("%-12s", $phone_split[0]);
		$custphone =		sprintf("%-11s", $custphone);
		$Luser =			$Auser[$i];
		$user =				sprintf("%-20s", $Auser[$i]);
		$Lsessionid =		$Asessionid[$i];
		$sessionid =		sprintf("%-9s", $Asessionid[$i]);
		$Lstatus =			$Astatus[$i];
		$status =			sprintf("%-6s", $Astatus[$i]);
		$Lserver_ip =		$Aserver_ip[$i];
		$server_ip =		sprintf("%-15s", $Aserver_ip[$i]);
		$call_server_ip =	sprintf("%-15s", $Acall_server_ip[$i]);
		$campaign_id =	sprintf("%-10s", $Acampaign_id[$i]);
		$comments=		$Acomments[$i];
		$calls_today =	sprintf("%-5s", $Acalls_today[$i]);
		   
		if (!ereg("N",$agent_pause_codes_active))
			{$pausecode='       ';}
		else
			{$pausecode='';}

		if (eregi("INCALL",$Lstatus)) 
			{
			$stmtP="select count(*) from parked_channels where channel_group='$Acallerid[$i]';";
			$rsltP=mysql_query($stmtP,$link);
			$rowP=mysql_fetch_row($rsltP);
			$parked_channel = $rowP[0];
			## Add by fnatic
			$Status_Image_Description=$Nocall_Status_Incall_Img."\n";

			if ($parked_channel > 0)
				{
				$Astatus[$i] =	'PARK';
				$Lstatus =		'PARK';
				$status =		' PARK ';
				}
			else
				{

				if (!ereg("$Acallerid[$i]\|",$callerids))
					{
						
					$Acall_time[$i]=$Astate_change[$i];

					$Astatus[$i] =	'DEAD';
					$Lstatus =		'DEAD';
					$status =		' DEAD ';
					## Add by fnatic
					$Status_Image_Description=$Status_Image_Description.$Nocall_Status_Dead_Img;
					}
				}

			if ( (eregi("AUTO",$comments)) or (strlen($comments)<1) )
				{
				$CM='A';
                ## Add by fnatic
                $Status_Image_Description=$Incall_Status_A_Img;
				}
			else
				{
				if (eregi("INBOUND",$comments)) 
					{
					$CM='I';
                ## Add by fnatic
                $Status_Image_Description=$Incall_status_I_img;
					}

				else
					{
					$CM='M';
					// grab vicidial_manager status to fix manudial agent status bug + fnatic
					$Status_Image_Description=$Incall_Status_M_img;	
					$manager_status="";
					$stmtK="SELECT vicidial_manager.status FROM vicidial_manager,vicidial_live_agents WHERE vicidial_live_agents.user='$user' AND vicidial_live_agents.callerid=vicidial_manager.callerid";
					$rsltK=mysql_query($stmtK,$link);
					$rowK=mysql_fetch_row($rsltK);
					$manager_status=$rowK[0];
					if($manager_status=="SENT")
						{
						$status="MDWAIT"; //manudial wait for customer pick up
						}
					elseif($manager_status=="UPDATED")
						{
					    $status="INCALL";
						}
					// end
					}
				}
			}
		else {
			$CM=' ';
			$Status_Image_Description='';
			}

		if ($UGdisplay > 0)
			{
			if ($non_latin < 1)
				{
				$user_group =		sprintf("%-12s", $Auser_group[$i]);
				while(strlen($user_group)>12) {$user_group = substr("$user_group", 0, -1);}
				}
			else
				{
				$user_group =		sprintf("%-40s", $Auser_group[$i]);
				while(mb_strlen($user_group, 'utf-8')>12) {$user_group = mb_substr("$user_group", 0, -1,'utf8');}
				}
			}
		if ($UidORname > 0)
			{
			if ($non_latin < 1)
				{
				$user =		sprintf("%-20s", $Afull_name[$i]);
				while(strlen($user)>20) {$user = substr("$user", 0, -1);}
				}
			else
				{
				$user =		sprintf("%-60s", $Afull_name[$i]);
				while(mb_strlen($user, 'utf-8')>20) {$user = mb_substr("$user", 0, -1,'utf8');}              
				}			
			}
		if (!eregi("INCALL|QUEUE|PARK|3-WAY",$Astatus[$i]))
			{$call_time_S = ($STARTtime - $Astate_change[$i]);}
		else if (eregi("3-WAY",$Astatus[$i]))
			{$call_time_S = ($STARTtime - $Acall_mostrecent[$i]);}		
		else
			{$call_time_S = ($STARTtime - $Acall_time[$i]);}

		$call_time_MS =		sec_convert($call_time_S,'M'); 
		$call_time_MS =		sprintf("%7s", $call_time_MS);
		$G = '';		$EG = '';
		//Add by fnatic 
		$NG = '';
		if ( ($Lstatus=='INCALL') or ($Lstatus=='PARK') )
			{$NG='class="thistle"' ;
			if ($call_time_S >= 10) {$G='<SPAN class="thistle"><B>'; $EG='</B></SPAN>'; $NG='class="thistle"' ;}
			if ($call_time_S >= 60) {$G='<SPAN class="violet"><B>'; $EG='</B></SPAN>';$NG='class="violet"' ;}
			if ($call_time_S >= 300) {$G='<SPAN class="purple"><B>'; $EG='</B></SPAN>';$NG='class="purple"' ;}
	#		if ($call_time_S >= 600) {$G='<SPAN class="purple"><B>'; $EG='</B></SPAN>';}

			}
		if ($Lstatus=='3-WAY')
			{$NG='class="lime"';
			if ($call_time_S >= 10) {$G='<SPAN class="lime"><B>'; $EG='</B></SPAN>'; $NG='class="lime"' ;}
			}
		if ($Lstatus=='DEAD')
			{ $NG='class="black"' ;
			if ($call_time_S >= 21600) 
				{$j++; continue;} 
			else
				{
				$agent_dead++;  $agent_total++;

		    $AgentIpData[$ipvalue]["agent_dead"]++;
		    $AgentIpData[$ipvalue]["agent_total"]++;   

				$G=''; $EG='';
				if ($call_time_S >= 10) {$G='<SPAN class="black"><B>'; $EG='</B></SPAN>'; $NG='class="black"' ;}
				}
			}
		if ($Lstatus=='DISPO')
			{
			$NG='class="khaki"' ;
		    $Status_Image_Description=$Nocall_Status_Dispo_Img;
			if ($call_time_S >= 21600) 
				{$j++; continue;} 
			else
				{
				$agent_dispo++;  $agent_total++;
		    $AgentIpData[$ipvalue]["agent_dispo"]++;
		    $AgentIpData[$ipvalue]["agent_total"]++;				
				$G='';
				if ($call_time_S >= 10) {$G='<SPAN class="dispo"><B>'; $EG='</B></SPAN>'; $NG='class="dispo"' ;}
				if ($call_time_S >= 60) {$G='<SPAN class="dispo"><B>'; $EG='</B></SPAN>';$NG='class="dispo"' ;}
				if ($call_time_S >= 300) {$G='<SPAN class="dispo"><B>'; $EG='</B></SPAN>';$NG='class="dispo"' ;}
				}
			}
		if ($Lstatus=='PAUSED') 
			{$NG='class="khaki"' ;
            ## Add by fnatic
            $Status_Image_Description=$Nocall_Status_Paused_Img;
			
			if (!ereg("N",$agent_pause_codes_active))
				{
				###$stmtC="select sub_status from vicidial_agent_log where user='$Luser' order by agent_log_id desc limit 1;";
				###Edit by fnatic
				//$stmtC="select vicidial_pause_codes.pause_code_name from vicidial_pause_codes, vicidial_agent_log where vicidial_agent_log.user='$Luser' and vicidial_pause_codes.pause_code =vicidial_agent_log.sub_status order by vicidial_agent_log.agent_log_id desc limit 1;";
				//$stmtC="select vicidial_pause_codes.pause_code_name from vicidial_pause_codes, vicidial_agent_log where vicidial_agent_log.user='$Luser' and vicidial_pause_codes.pause_code =vicidial_agent_log.sub_status and vicidial_pause_codes.campaign_id='$campaign_id' order by vicidial_agent_log.agent_log_id desc limit 1;";
				$stmtC  = "select pause_code_name from vicidial_pause_codes a,";
				$stmtC = $stmtC . " ( select sub_status from vicidial_agent_log where user='$Luser' order by agent_log_id desc limit 1 ) b ";
				$stmtC = $stmtC .  " where a.pause_code = b.sub_status and a.campaign_id='$campaign_id' ";

				  $rsltC=mysql_query($stmtC,$link);
				  $rowC=mysql_fetch_row($rsltC);
					if ($rowC) {

						###$pausecode = sprintf("%-6s", $rowC[0]);
						###Edit by fnatic
						###$pausecode = sprintf("%-10s", $rowC[0]);
		
						$pausecode = sprintf("%s", $rowC[0]);
						$pausecode = "[$pausecode]";
					}else{
						$pausecode='';
					}	
				}
			else
				{$pausecode='';}

			if ($call_time_S >= 21600) 
				{$j++; continue;} 
			else
				{
				$agent_paused++;  $agent_total++;
		    $AgentIpData[$ipvalue]["agent_paused"]++;
		    $AgentIpData[$ipvalue]["agent_total"]++;					
				$G='';
				if ($call_time_S >= 10) {$G='<SPAN class="khaki"><B>'; $EG='</B></SPAN>';$NG='class="khaki"' ;}
				if ($call_time_S >= 60) {$G='<SPAN class="yellow"><B>'; $EG='</B></SPAN>';$NG='class="yellow"' ;}
				if ($call_time_S >= 300) {$G='<SPAN class="olive"><B>'; $EG='</B></SPAN>';$NG='class="olive"' ;}
				}
			}
#		if ( (strlen($Acall_server_ip[$i])> 4) and ($Acall_server_ip[$i] != "$Aserver_ip[$i]") )
#				{$G='<SPAN class="orange"><B>'; $EG='</B></SPAN>';}
    if ( eregi("RING",$status) ) { 
    	$Status_Image_Description=$Ring_Status_Img;
    	$NG='class="red1"' ;
    	if ($call_time_S >= 21600) 
			  {$j++; continue;} 
			else
				{
					$agent_ring++;  $agent_total++;
					
		      $AgentIpData[$ipvalue]["agent_ring"]++;
		      $AgentIpData[$ipvalue]["agent_total"]++;	
		      					
    	    $G='<SPAN class="red1"><B>'; $EG='</B></SPAN>';$NG='class="red1"' ;
				if ($call_time_S >= 5) {$G='<SPAN class="red1"><B>'; $EG='</B></SPAN>';$NG='class="red1"' ;}
				if ($call_time_S >= 10) {$G='<SPAN class="red2"><B>'; $EG='</B></SPAN>';$NG='class="red2"' ;}
				if ($call_time_S >= 30) {$G='<SPAN class="red3"><B>'; $EG='</B></SPAN>';$NG='class="red3"' ;}
			}	
    }
		if ( (eregi("INCALL",$status)) or (eregi("QUEUE",$status))  or (eregi("3-WAY",$status)) or (eregi("PARK",$status))) 
		{
			$agent_incall++;  $agent_total++;
		  $AgentIpData[$ipvalue]["agent_incall"]++;
		  $AgentIpData[$ipvalue]["agent_total"]++;			
			}
		if ( (eregi("READY",$status)) or (eregi("CLOSER",$status)) ) 
		{$agent_ready++;  $agent_total++;
		  $AgentIpData[$ipvalue]["agent_ready"]++;
		  $AgentIpData[$ipvalue]["agent_total"]++;			
			}
		if ( (eregi("READY",$status)) or (eregi("CLOSER",$status)) ) 
			{
            ## Add by fnatic
            $Status_Image_Description=$Nocall_Status_Ready_Img;
			
			$G='<SPAN class="lightblue"><B>'; $EG='</B></SPAN>'; $NG='class="lightblue"' ;
			if ($call_time_S >= 60) {$G='<SPAN class="blue"><B>'; $EG='</B></SPAN>';$NG='class="blue"' ;}
			if ($call_time_S >= 300) {$G='<SPAN class="midnightblue"><B>'; $EG='</B></SPAN>';$NG='class="midnightblue"' ;}
			}

		$L='';
		$R='';
		if ($SIPmonitorLINK>0) {$L=" <a href=\"sip:0$Lsessionid@$server_ip\">监听</a>";   $R='';}
		if ($IAXmonitorLINK>0) {$L=" <a href=\"iax:0$Lsessionid@$server_ip\">监听</a>";   $R='';}
		if ($SIPmonitorLINK>1) {$R=" | <a href=\"sip:$Lsessionid@$server_ip\">强插</a>";}
		if ($IAXmonitorLINK>1) {$R=" | <a href=\"iax:$Lsessionid@$server_ip\">强插</a>";}
		//Modify by fnatic start
		if ( (strlen($monitor_phone)>1) and (preg_match("/MONITOR/",$monitor_active) ) )
			{$L="  <<a href=\"javascript:send_monitor('$Lsessionid','$Lserver_ip','MONITOR');\">监听</a>>";   $R='';}
		if ( (strlen($monitor_phone)>1) and (preg_match("/BARGE/",$monitor_active) ) )       
			{$R="  <<a href=\"javascript:send_monitor('$Lsessionid','$Lserver_ip','BARGE');\">强插</a>>";}
		if ( (strlen($monitor_phone)>1) and (preg_match("/WHISPER/",$monitor_active) ) )
			{$R="  <<a href=\"javascript:send_monitor_whisper('$Lsessionid','$Lserver_ip','WHISPER', '".trim(preg_replace("/[a-zA-Z]|\//","",$phone))."');\">耳语</a>>";}
		if ( (strlen($monitor_phone)>1) and (preg_match("/MONITOR_ALL/",$monitor_active) ) )
			{
			 $L="  <<a href=\"javascript:send_monitor('$Lsessionid','$Lserver_ip','MONITOR');\">监听</a>>";   $R='';
			 $R.="  <<a href=\"javascript:send_monitor('$Lsessionid','$Lserver_ip','BARGE');\">强插</a>>";
			 $R.="  <<a href=\"javascript:send_monitor_whisper('$Lsessionid','$Lserver_ip','WHISPER', '".trim(preg_replace("/[a-zA-Z]|\//","",$phone))."');\">耳语</a>>";
			}
		//Modify by fnatic end

		if ($CUSTPHONEdisplay > 0)	{$CP = "<td>$custphone</td>";}
		else	{$CP = "";}

		if ($UGdisplay > 0)	{$UGD = "<td>$user_group</td>";}
		else	{$UGD = "";}

		if ($SERVdisplay > 0)	{$SVD = "<td>$server_ip</td><td>$call_server_ip</td>";}
		else	{$SVD = "";}

		if ($PHONEdisplay > 0)	{$phoneD = "<td>$phone</td>";}
		else	{$phoneD = "";}

		$vac_stage='';
		$vac_campaign='';
		$INGRP='';
		if ($CM == 'I') 
			{
			$stmt="select vac.campaign_id,vac.stage,vig.group_name from vicidial_auto_calls vac,vicidial_inbound_groups vig where vac.callerid='$Acallerid[$i]' and vac.campaign_id=vig.group_id LIMIT 1;";
			$rslt=mysql_query($stmt, $link);
			if ($DB) {echo "$stmt\n";}
			$ingrp_to_print = mysql_num_rows($rslt);
			
				if ($ingrp_to_print > 0)
				{
				$row=mysql_fetch_row($rslt);
				###Mod by fnatic
				###$vac_campaign =	sprintf("%-20s", "$row[0] - $row[2]");
	            $vac_campaign =	sprintf("%-20s", "$row[2]");

				$row[1] = eregi_replace(".*-",'',$row[1]);
				$vac_stage =	sprintf("%-4s", $row[1]);
				}

			// Mod by fnatic $INGRP = "<td>$vac_stage</td><td>$vac_campaign</td>";
			}
		
		//Add by fnatic start
		#  $INGRP = ($CM == 'I') ? "<td>$vac_stage</td><td>$vac_campaign</td>" : "<td>&nbsp;</td><td>&nbsp;</td>";
		  if($CM == 'I')
			{
		     $INGRP="<td>$vac_campaign</td>";
			 $HoldTimeVal="<td>$vac_stage</td>";
		    }
		else
			{
		    $INGRP="<td>&nbsp;</td>";
			$HoldTimeVal="<td>&nbsp;</td>";
		    }
        // Add by fnatic end
		$agentcount++;
//Mod by fnatic start
		//$Aecho .= "| $G$extension$EG |$phoneD<a href=\"./user_status.php?user=$Luser\" target=\"_blank\">$G$user$EG</a> <a href=\"javascript:ingroup_info('$Luser','$j');\">+</a> |$UGD $G$sessionid$EG$L$R | $G$status$EG $CM $pausecode| $CP$SVD$G$call_time_MS$EG | $G$campaign_id$EG | $G$calls_today$EG |$INGRP\n";

 $Aecho .= "<tr $NG>";
 //$Aecho .= "<td>$extension</td>";
 $Aecho .= "$phoneD";
 $Aecho .= "<td style='text-align:left;padding-left:15px;'>";
 $Aecho .= "<a href=\"./user_status.php?user=$Luser\" target=\"_blank\"><font $NG>$user</font></a>";
 $Aecho .= "<a href=\"javascript:ingroup_info('$Luser','$j');\">+</a>$L$R";
 $Aecho .= "</td>";
 $Aecho .= "$UGD";
 //$Aecho .= "<td>$sessionid$L$R</td>";
 $Aecho .= "<td style='text-align:left;padding-left:15px;'>$Status_Image_Description ".status_en2cn($status);
 //$Aecho .= $CM;
 $Aecho .= "$pausecode</td>";
 $Aecho .= "$CP$SVD";
 $Aecho .= "<td style='text-align:left;padding-left:15px;'>$call_time_MS</td>";
 $Aecho .= "$HoldTimeVal";
 $Aecho .= "<td>$campaign_id</td>";

 $agent_inboundcall_today = 0;
 $agent_outboundcall_today = 0;
 $stmtF="select count(*) from vicidial_closer_log where user='$Auser[$i]' and call_date>curdate();";
 $rsltF=mysql_query($stmtF, $link);
 if($rsltF)
    {
    $rowF=mysql_result($rsltF,0); 
    $agent_inboundcall_today=$rowF;
    }

 $stmtH="select count(*) from vicidial_log where user='$Auser[$i]' and call_date>curdate();";
 $rsltH=mysql_query($stmtH, $link);
 if($rsltH)
    {
    $rowH=mysql_result($rsltH,0); 
    $agent_outboundcall_today=$rowH;
    }
 $Aecho .= "<td>$calls_today</td>";

 $Aecho .= "<td>$agent_inboundcall_today</td>";
 $Aecho .= "<td>$agent_outboundcall_today</td>";

 $Aecho .= "$INGRP";
 $Aecho .= "</tr>"; 

		$j++;
		}

$Aecho .="</table>";
		//$Aecho .= "$Aline";
		$Aecho .= "$agentcount个话务员登陆所有服务器\n";
		//$Aecho .= "  System Load Average: $load_ave\n\n";

	#	$Aecho .= "  <SPAN class=\"orange\"><B>          </SPAN> - Balanced call</B>\n";
	
 $Aecho .= "<table border=0 cellspacing=1 cellpadding=0 width=100%><tr>";
 $Aecho .= "<tr><td width=10></td><td colspan=3 height=20px></td></tr>";
 $Aecho .= "<td></td>";
 $Aecho .="<td>";
 $Aecho .= "<span class=\"lightblue\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> -可用<br/>";
 $Aecho .= "<span class=\"blue\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> -可用时长大于1分钟<br/>";
 $Aecho .= "<span class=\"midnightblue\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> -可用时长大于5分钟";
 $Aecho .="</td>";
 $Aecho .="<td>";
 $Aecho .= "<span class=\"thistle\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> -通话时长大于10秒<br/>";
 $Aecho .= "<span class=\"violet\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> -通话时长大于1分钟<br/>";
 $Aecho .= "<span class=\"purple\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> -通话时长大于5分钟<br/>";
 $Aecho .= "</td>";
 $Aecho .= "<td>";
 $Aecho .= "<span class=\"khaki\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> -暂停时长大于10秒<br/>";
 $Aecho .= "<span class=\"yellow\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> -暂停时长大于1分钟<br/>";
 $Aecho .= "<span class=\"olive\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> -暂停时长大于5分钟";
 $Aecho .= "</td>";
 $Aecho .= "<td>";
 $Aecho .= "<span class=\"red1\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> -振铃时长大于5秒<br/>";
 $Aecho .= "<span class=\"red2\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> -振铃大于10秒<br/>";
 $Aecho .= "<span class=\"red3\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> -振铃大于30秒";
 $Aecho .= "</td>"; 
 $Aecho .= "<td>";
 $Aecho .= "<span class=\"dispo\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> -小结<br/>";
 $Aecho .= "<span class=\"lime\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> -三方通话大于10秒<br/>";
 $Aecho .= "<span class=\"black\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> -休止";
 $Aecho .= "</td>";
 $Aecho .= "</tr></table>";




		if ($agent_ready > 0) {$B='<FONT class="b1">'; $BG='</FONT>';}
		if ($agent_ready > 4) {$B='<FONT class="b2">'; $BG='</FONT>';}
		if ($agent_ready > 9) {$B='<FONT class="b3">'; $BG='</FONT>';}
		if ($agent_ready > 14) {$B='<FONT class="b4">'; $BG='</FONT>';}
  
  ####按IP显示 bug 1514
  $tmpipcount = count($AgentIp);   
	foreach($AgentIp as $ipvalue){	
			//echo "\n<BR>\n";
			$str_table_info .= "<tr>";
			if ( $tmpipcount <= 1){
				   $str_table_info .= "<td class=\"border_bot\" align=center ><b>实时话务员统计:</b>" . "<span class=\"total_font_calls\">" . chk_callstatus_number($AgentIpData[$ipvalue]["agent_total"]) . "</span></td>" ;
		  }else{
		  	   $str_table_info .= "<td class=\"border_bot\" align=center ><b>" . $ipvalue . " -- 实时话务员统计:</b>" . "<span class=\"total_font_calls\">" . chk_callstatus_number($AgentIpData[$ipvalue]["agent_total"]) . "</span></td>" ;
			}
	    
			$str_table_info .= "<td class=\"border_bot\">可用:</td><td class=\"font_calls\" >" . $AgentIpData[$ipvalue]["agent_ready"] . "</td>";
			$str_table_info .= "<td class=\"border_bot\">振铃:</td><td class=\"font_calls\" >" . $AgentIpData[$ipvalue]["agent_ring"] . "</td>";
			$str_table_info .= "<td class=\"border_bot\">通话:</td><td class=\"font_calls\" >" . $AgentIpData[$ipvalue]["agent_incall"] . "</td>";
			
			if($Agent_Status_Dead_Display_Enable=='Y')
			{
			$str_table_info .= "<td class=\"border_bot\">休止:</td><td class=\"font_calls\">" . $AgentIpData[$ipvalue]["agent_dead"] . "</td>";
			}
			$str_table_info .= "<td class=\"border_bot\">小结:</td><td class=\"font_calls\">" . $AgentIpData[$ipvalue]["agent_dispo"] . "</td>";
			$str_table_info .= "<td class=\"border_bot\">暂停:</td><td class=\"font_calls\">" . $AgentIpData[$ipvalue]["agent_paused"]. "</td></tr>";
	}		
			$str_table_info .= "</table><br>";
		
		//echo "<PRE><FONT SIZE=2>";
		//echo "";
		if($report_name=="real" || $report_name==""){
			//Campaign统计信息区
			echo $str_table_info;
		}
		echo "$Cecho";
		
		
		echo "$Aecho";
		
	}
	else
	{
	//echo "无登录话务员\n";

	//Add by fnatic start

		$str_table_info .= "<tr>";
	  $str_table_info .= "<td class=\"border_bot\" align=center ><b>实时话务员统计:</b>" . "<span class=\"total_font_calls\">$agent_total</span></td>" ;
	  
	  $str_table_info .= "<td class=\"border_bot\">可用:</td><td class=\"font_calls\">$agent_ready</td>";	
		$str_table_info .= "<td class=\"border_bot\">振铃:</td><td class=\"font_calls\">$agent_ring</td>";
		$str_table_info .= "<td class=\"border_bot\">通话:</td><td class=\"font_calls\">$agent_incall</td>";
		
		$str_table_info .= "<td class=\"border_bot\">休止:</td><td class=\"font_calls\">$agent_dead</td>";
		$str_table_info .= "<td class=\"border_bot\">小结:</td><td class=\"font_calls\">$agent_dispo</td>";
		$str_table_info .= "<td class=\"border_bot\">暂停:</td><td class=\"font_calls\">$agent_paused</td></tr>";
		$str_table_info .= "</table><br>";		
		if($report_name=="real" || $report_name==""){
			echo $str_table_info;
		}		
		echo "<PRE><FONT SIZE=2>";
		echo "$Aecho";
		//Add by fnatic end
		echo "<PRE>$Cecho";
	
	}

}
####end heibo summary报表 2011-3-16 17:04:55











####heibo 2011-3-16 17:05:02 加入的summary报表  $sumreport 为N 为原来的报表  $sumreport 为Y 为所有Campaign报表
if ($sumreport == "Y") {	
	
   $stmt= getOwnCampaigns($user_level,$user_name);
//   echo $stmt."<hr>";
   $while_rslt=mysql_query($stmt, $link);


   while ($row = mysql_fetch_assoc($while_rslt)){
         $report_campaign_id    = $row["campaign_id"];
   	     $report_campaign_name  = $row["campaign_name"];
   	     $dial_method    = $row["dial_method"];   	
    	   $group_SQLwhere = " where campaign_id = '" . $row['campaign_id']  . "'";
    	   $group_SQLand   = " and campaign_id = '" . $row['campaign_id']  . "'";
         $group_SQL      = "'" . $row['campaign_id'] . "'";
         
         $group_string   = "'" . $row['campaign_id'] . "'";
         
         $sub_stamt = " select closer_campaigns from vicidial_campaigns $group_SQLwhere ;";
         $sub_rslt=mysql_query($sub_stamt, $link);
         if ($sub_rslt){
             $sub_row = mysql_fetch_assoc($sub_rslt);
             $closer_campaignsSQL = getclosercampaigns($sub_row['closer_campaigns']);
         }else{
       	     $closer_campaignsSQL = "''";
       	 }  
       	 





		      $inbound_voicemail = 0;
		
		    	$stmt  = "select voicemail_ext from vicidial_campaigns where campaign_id = $group_SQL;";

					$rslt  = mysql_query($stmt, $link);
					$row   = mysql_fetch_row($rslt);
					$voicemail_ext = $row[0];
					
          if ( !empty($voicemail_ext) ){
    	        $from_date  = date("d-m-Y");
    	        $to_date    = date("d-m-Y");
              $begin = getunixtime(substr($from_date,6,4).'-'.substr($from_date,3,2).'-'.substr($from_date,0,2)." "."00:00:00");
              $end   = getunixtime(substr($to_date,6,4).'-'.substr($to_date,3,2).'-'.substr($to_date,0,2)." "."23:59:59");
        	
					    $VmPath = $VoiceMailPath."$voicemail_ext/INBOX/";
					    $StatVm = VoiceMail($VmPath,$begin,$end);
              
              $inbound_voicemail = count($StatVm);
        	}


   //技能组信息2011-3-24 11:05:17

     $ingroup_detail = "";  	 	
       	

    if($AGENTDIRECT_Enable=='N')
		{
	$stmtB="select calls_today,drops_today,answers_today,status_category_1,status_category_count_1,status_category_2,status_category_count_2,status_category_3,status_category_count_3,status_category_4,status_category_count_4,hold_sec_stat_one,hold_sec_stat_two,hold_sec_answer_calls,hold_sec_drop_calls,hold_sec_queue_calls,campaign_id from vicidial_campaign_stats where campaign_id IN ($closer_campaignsSQL) AND LEFT(campaign_id,11)!='AGENTDIRECT' order by campaign_id;";	         
	    }
	else
		{
	$stmtB="select calls_today,drops_today,answers_today,status_category_1,status_category_count_1,status_category_2,status_category_count_2,status_category_3,status_category_count_3,status_category_4,status_category_count_4,hold_sec_stat_one,hold_sec_stat_two,hold_sec_answer_calls,hold_sec_drop_calls,hold_sec_queue_calls,campaign_id from vicidial_campaign_stats where campaign_id IN ($closer_campaignsSQL) order by campaign_id;";
	}
	if ($DB > 0) {echo "\n|$stmtB|\n";}
  //echo $stmtB;
	$r=0;
	$rslt=mysql_query($stmtB, $link);
	$ingroups_to_print = mysql_num_rows($rslt);
//	echo "ingroups_to_print:".$ingroups_to_print;
	if ($ingroups_to_print > 0)
		{
		 $ingroup_detail .= "<table cellpadding=1 cellspacing=1 width=100% class=ingroup_stats>";
		 //Add by fnatic start
         $ingroup_detail .="<tr>";
		 $ingroup_detail .="<th>技能组</th>";
		 $ingroup_detail .="<th>当前等待</th>";
		 $ingroup_detail .="<th>当前振铃</th>";		 
		 $ingroup_detail .="<th>当前通话</th>";		 
		 $ingroup_detail .="<th>今天通话</th>";
		 $ingroup_detail .="<th>一级服务率</th>";
		 $ingroup_detail .="<th>二级服务率</th>";
		 $ingroup_detail .="<th>今天应答</th>";
		 $ingroup_detail .="<th>平均等待时长(应答)</th>";
		 $ingroup_detail .="<th>今天掉线</th>";
		 $ingroup_detail .="<th>平均等待时长(掉线)</th>";
		 $ingroup_detail .="<th>掉线率</th>";
		 $ingroup_detail .="<th>平均等待时长(全部)</th>";
		 $ingroup_detail .="<th>今天语音留言</th>";		 
         $ingroup_detail .="</tr>";
		 //Add by fnatic end
		 
		}
        
		
	while ($ingroups_to_print > $r)
		{
		$row=mysql_fetch_row($rslt);
		$callsTODAY =				$row[0];
		$dropsTODAY =				$row[1];
		$answersTODAY =				$row[2];
		$VSCcat1 =					$row[3];
		$VSCcat1tally =				$row[4];
		$VSCcat2 =					$row[5];
		$VSCcat2tally =				$row[6];
		$VSCcat3 =					$row[7];
		$VSCcat3tally =				$row[8];
		$VSCcat4 =					$row[9];
		$VSCcat4tally =				$row[10];
		$hold_sec_stat_one =		$row[11];
		$hold_sec_stat_two =		$row[12];
		$hold_sec_answer_calls =	$row[13];
		$hold_sec_drop_calls =		$row[14];
		$hold_sec_queue_calls =		$row[15];
		$ingroupdetail =			$row[16];
				
		if ( ($dropsTODAY > 0) and ($answersTODAY > 0) )
			{

			### Mod by fnatic start
			###$drpctTODAY = ( ($dropsTODAY / $answersTODAY) * 100);
            $drpctTODAY = ( ($dropsTODAY / $callsTODAY) * 100);
            ### Mod by fnatic end

			$drpctTODAY = round($drpctTODAY, 2);
			$drpctTODAY = sprintf("%01.2f", $drpctTODAY);
			}
		else
			{$drpctTODAY=0;}

		if ($callsTODAY > 0)
			{
			$AVGhold_sec_queue_calls = ($hold_sec_queue_calls / $callsTODAY);
			$AVGhold_sec_queue_calls = round($AVGhold_sec_queue_calls, 0);
			$AVGhold_sec_queue_calls = date("H:i:s",strtotime($NOW_DAY) + $AVGhold_sec_queue_calls);
			}
		else
			{$AVGhold_sec_queue_calls='00:00:00';}

		if ($dropsTODAY > 0)
			{
			$AVGhold_sec_drop_calls = ($hold_sec_drop_calls / $dropsTODAY);
			$AVGhold_sec_drop_calls = round($AVGhold_sec_drop_calls, 0);
			$AVGhold_sec_drop_calls = date("H:i:s",strtotime($NOW_DAY) + $AVGhold_sec_drop_calls);
			}
		else
			{$AVGhold_sec_drop_calls='00:00:00';}

		if ($answersTODAY > 0)
			{
			$PCThold_sec_stat_one = ( ($hold_sec_stat_one / $answersTODAY) * 100);
			$PCThold_sec_stat_one = round($PCThold_sec_stat_one, 2);
			$PCThold_sec_stat_one = sprintf("%01.2f", $PCThold_sec_stat_one);
			$PCThold_sec_stat_two = ( ($hold_sec_stat_two / $answersTODAY) * 100);
			$PCThold_sec_stat_two = round($PCThold_sec_stat_two, 2);
			$PCThold_sec_stat_two = sprintf("%01.2f", $PCThold_sec_stat_two);
			$AVGhold_sec_answer_calls = ($hold_sec_answer_calls / $answersTODAY);
			$AVGhold_sec_answer_calls = date("H:i:s",strtotime($NOW_DAY) + round($AVGhold_sec_answer_calls, 0));
			if ($agent_non_pause_sec > 0)
				{
				$AVG_ANSWERagent_non_pause_sec = (($answersTODAY / $agent_non_pause_sec) * 60);
				$AVG_ANSWERagent_non_pause_sec = round($AVG_ANSWERagent_non_pause_sec, 2);
				$AVG_ANSWERagent_non_pause_sec = sprintf("%01.2f", $AVG_ANSWERagent_non_pause_sec);
				}
			else
				{$AVG_ANSWERagent_non_pause_sec=0;}
			}
		else
			{
			$PCThold_sec_stat_one=0;
			$PCThold_sec_stat_two=0;
			$AVGhold_sec_answer_calls='00:00:00';
			$AVG_ANSWERagent_non_pause_sec=0;
			}

		if (ereg("0$|2$|4$|6$|8$",$r)) {$bgcolor='#E6E6E6';}
		else {$bgcolor='white';}
		$ingroup_detail .= "<TR bgcolor=\"$bgcolor\">";
       
	    ### Add by fnatic start 

		$stmtC="select status from vicidial_auto_calls where campaign_id='$ingroupdetail';";
		$rsltC=mysql_query($stmtC, $link);
		$Total_Call=mysql_num_rows($rsltC);
		
        $stmtD="select group_name from vicidial_inbound_groups where group_id='".$ingroupdetail."'";
        $rsltD=mysql_query($stmtD, $link);
		$group_name=mysql_fetch_row($rsltD);
		$group_name=$group_name[0];

        $stmtE="select count(*) from vicidial_auto_calls where status in ('LIVE') and campaign_id='$ingroupdetail';";
		$rsltE=mysql_query($stmtE,$link);
		$Wait_Call=mysql_fetch_row($rsltE);
		$Wait_Call=$Wait_Call[0];

        $stmtF="select count(*) from vicidial_auto_calls where status in ('CLOSER') and campaign_id='$ingroupdetail';";
		$rsltF=mysql_query($stmtF,$link);
		$Closer_Call=mysql_fetch_row($rsltF);
		$Closer_Call=$Closer_Call[0];        
        
         $stmtG="select count(*) from vicidial_auto_calls where status not in ('LIVE','CLOSER','IVR') and campaign_id='$ingroupdetail';";
		$rsltG=mysql_query($stmtG,$link);
		$Ring_Call=mysql_fetch_row($rsltG);
		$Ring_Call=$Ring_Call[0]; 
        ### Add by fnatic end 
        
       ### add by heibo start 2011-3-30 11:43:13 bug 1461
       $stmt_inboudmode = "select inbound_mode from vicidial_campaigns where instr(closer_campaigns,'" . $ingroupdetail . "') > 0";
       $rslt_inboudmode = mysql_query($stmt_inboudmode,$link);
       $inboundmode     = mysql_fetch_row($rslt_inboudmode);
       $inboundmode     = $inboundmode[0];

       ### add by heibo end       
       
       
       ### add by heibo start 2011-3-28 11:51:57 模拟成技能组的掉线数
       $stmt_call_menu = "select  count(*) from vicidial_call_menu where tracking_group ='$ingroupdetail'; ";
       $rslt_call_menu = mysql_query($stmt_call_menu,$link);
       $ivr_call_menu  = mysql_fetch_row($rslt_call_menu);
       $ivr_call_menu  = $ivr_call_menu[0];
       
       if ( $ivr_call_menu > 0){
       	  
       	  $stmt_ivr_log = "select count(*),sum(ivr_dropped_call),sec_to_time(sum(ivr_length_in_sec*ivr_dropped_call)/count(*)),sum(ivr_dropped_call)/count(*),sec_to_time(avg(ivr_length_in_sec))";
       	  $stmt_ivr_log = $stmt_ivr_log . " from v_ivr_log where group_id ='$ingroupdetail' and   start_time >='$NOW_DAY'";
       	  
       	  //echo $stmt_ivr_log;
       	  
       	  $rslt_ivr_log = mysql_query($stmt_ivr_log,$link);
       	  $ivr_ivr      = mysql_fetch_row($rslt_ivr_log);
       	  $callsTODAY   = $ivr_ivr[0];
       	  $dropsTODAY   = isset($ivr_ivr[1])?$ivr_ivr[1]:0;
       	  $AVGhold_sec_drop_calls = isset($ivr_ivr[2])?$ivr_ivr[2]:'00:00:00';
       	  $drpctTODAY   = isset($ivr_ivr[3])?round($ivr_ivr[3] * 100,2):'0';
       	  $AVGhold_sec_queue_calls = isset($ivr_ivr[4])?$ivr_ivr[4]:'00:00:00';
       	  
					$ingroup_detail .= "<TD>$group_name</TD>";
					$ingroup_detail .= "<TD>-</TD>";
          //if ($inboundmode == "auto"){
          	  $ingroup_detail .= "<TD>-</TD>";
          //}else{
          //	  $ingroup_detail .= "<TD>$Ring_Call</TD>";
     	    //}
          if ($inboundmode == "auto"){
          	  $ingroup_detail .= "<TD>$Total_Call</TD>";	
          }else{
          	  $ingroup_detail .= "<TD>$Total_Call</TD>";	
     	    } 					
					$ingroup_detail .= "<TD>$callsTODAY&nbsp;</TD>";
					$ingroup_detail .= "<TD>-</TD>";
					$ingroup_detail .= "<TD>-</TD>";
					$ingroup_detail .= "<TD>-</TD>";
					$ingroup_detail .= "<TD>-</TD>";
					$ingroup_detail .= "<TD>$dropsTODAY</TD>";
					$ingroup_detail .= "<TD>$AVGhold_sec_drop_calls</TD>";
					$ingroup_detail .= "<TD>$drpctTODAY%&nbsp;</TD>";
					$ingroup_detail .= "<TD>$AVGhold_sec_queue_calls</TD>";
					
					       	 
       }else{
       	
					$ingroup_detail .= "<TD>$group_name</TD>";
					$ingroup_detail .= "<TD>$Wait_Call</TD>";
          if ($inboundmode == "auto"){
          	  $ingroup_detail .= "<TD>-</TD>";
          }else{
          	  $ingroup_detail .= "<TD>$Ring_Call</TD>";
     	    }					
          if ($inboundmode == "auto"){
          	  $ingroup_detail .= "<TD>$Closer_Call</TD>";	
          }else{
          	  $ingroup_detail .= "<TD>$Closer_Call</TD>";	
     	    } 	
					$ingroup_detail .= "<TD>$callsTODAY&nbsp;</TD>";
					$ingroup_detail .= "<TD>$PCThold_sec_stat_one%</TD>";
					$ingroup_detail .= "<TD>$PCThold_sec_stat_two%</TD>";
					$ingroup_detail .= "<TD>$answersTODAY</TD>";
					$ingroup_detail .= "<TD>$AVGhold_sec_answer_calls</TD>";
					$ingroup_detail .= "<TD>$dropsTODAY</TD>";
					$ingroup_detail .= "<TD>$AVGhold_sec_drop_calls</TD>";
					$ingroup_detail .= "<TD>$drpctTODAY%&nbsp;</TD>";
					$ingroup_detail .= "<TD>$AVGhold_sec_queue_calls</TD>";

		       	
       }
       ### add by heibo 2011-4-20 12:12:47 bug 1577
       if ($r == 0){
           $ingroup_detail .= "<TD rowspan=$ingroups_to_print>$inbound_voicemail</TD>";
       }
       $ingroup_detail .= "</TR>";
       ### add by heibo end


		$r++;
		}

	if ($ingroups_to_print > 0)
		{
		//Mod by fnatic $ingroup_detail .= "</table>";
		 $ingroup_detail .= "";	
		}
  
  #end 技能组信息 2011-3-24 11:05:35



		if ( (ereg('Y',$with_inbound)) and ($campaign_allow_inbound > 0) )
			{
			$multi_drop++;
			if ($DB) {echo "with_inbound|$with_inbound|$campaign_allow_inbound\n";}

			$stmt="select auto_dial_level,dial_status_a,dial_status_b,dial_status_c,dial_status_d,dial_status_e,lead_order,lead_filter_id,hopper_level,dial_method,adaptive_maximum_level,adaptive_dropped_percentage,adaptive_dl_diff_target,adaptive_intensity,available_only_ratio_tally,adaptive_latest_server_time,local_call_time,dial_timeout,dial_statuses,agent_pause_codes_active,list_order_mix from vicidial_campaigns where campaign_id IN ($group_SQL,$closer_campaignsSQL);";

			$stmtB="select sum(dialable_leads),sum(calls_today),sum(drops_today),avg(drops_answers_today_pct),avg(differential_onemin),avg(agents_average_onemin),sum(balance_trunk_fill),sum(answers_today),max(status_category_1),sum(status_category_count_1),max(status_category_2),sum(status_category_count_2),max(status_category_3),sum(status_category_count_3),max(status_category_4),sum(status_category_count_4) from vicidial_campaign_stats where campaign_id IN ($group_SQL,$closer_campaignsSQL);";
			}
		else
			{
			$stmt="select avg(auto_dial_level),max(dial_status_a),max(dial_status_b),max(dial_status_c),max(dial_status_d),max(dial_status_e),max(lead_order),max(lead_filter_id),max(hopper_level),max(dial_method),max(adaptive_maximum_level),avg(adaptive_dropped_percentage),avg(adaptive_dl_diff_target),avg(adaptive_intensity),max(available_only_ratio_tally),max(adaptive_latest_server_time),max(local_call_time),max(dial_timeout),max(dial_statuses),max(agent_pause_codes_active),max(list_order_mix) from vicidial_campaigns where campaign_id IN($group_SQL);";

			$stmtB="select sum(dialable_leads),sum(calls_today),sum(drops_today),avg(drops_answers_today_pct),avg(differential_onemin),avg(agents_average_onemin),sum(balance_trunk_fill),sum(answers_today),max(status_category_1),sum(status_category_count_1),max(status_category_2),sum(status_category_count_2),max(status_category_3),sum(status_category_count_3),max(status_category_4),sum(status_category_count_4) from vicidial_campaign_stats where campaign_id IN($group_SQL);";
			}



	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$DIALlev =		$row[0];
	$DIALstatusA =	$row[1];
	$DIALstatusB =	$row[2];
	$DIALstatusC =	$row[3];
	$DIALstatusD =	$row[4];
	$DIALstatusE =	$row[5];
	$DIALorder =	$row[6];
	$DIALfilter =	$row[7];
	$HOPlev =		$row[8];
	$DIALmethod =	$row[9];
	$maxDIALlev =	$row[10];
	$DROPmax =		$row[11];
	$targetDIFF =	$row[12];
	$ADAintense =	$row[13];
	$ADAavailonly =	$row[14];
	$TAPERtime =	$row[15];
	$CALLtime =		$row[16];
	$DIALtimeout =	$row[17];
	$DIALstatuses =	$row[18];
	$agent_pause_codes_active = $row[19];
	$DIALmix =		$row[20];


	$stmt="select count(*) from vicidial_hopper $group_SQLwhere;";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$VDhop = $row[0];

	$rslt=mysql_query($stmtB, $link);
	$row=mysql_fetch_row($rslt);
	$DAleads =		$row[0];
	$callsTODAY =	$row[1];
	$dropsTODAY =	$row[2];
	$drpctTODAY =	$row[3];
	$diffONEMIN =	$row[4];
	$agentsONEMIN = $row[5];
	$balanceFILL =	$row[6];
	$answersTODAY = $row[7];
	if ($multi_drop > 0)
		{
		if ( ($dropsTODAY > 0) and ($answersTODAY > 0) )
			{
			
			### Mod by fnatic 
			### $drpctTODAY = ( ($dropsTODAY / $answersTODAY) * 100);
            $drpctTODAY = ( ($dropsTODAY / $callsTODAY) * 100);
			$drpctTODAY = round($drpctTODAY, 2);
			$drpctTODAY = sprintf("%01.2f", $drpctTODAY);
			}
		else
			{$drpctTODAY=0;}
		}
	$VSCcat1 =		$row[8];
	$VSCcat1tally = $row[9];
	$VSCcat2 =		$row[10];
	$VSCcat2tally = $row[11];
	$VSCcat3 =		$row[12];
	$VSCcat3tally = $row[13];
	$VSCcat4 =		$row[14];
	$VSCcat4tally = $row[15];

	if ( ($diffONEMIN != 0) and ($agentsONEMIN > 0) )
		{
		$diffpctONEMIN = ( ($diffONEMIN / $agentsONEMIN) * 100);
		$diffpctONEMIN = sprintf("%01.2f", $diffpctONEMIN);
		}
	else {$diffpctONEMIN = '0.00';}

	$stmt="select sum(local_trunk_shortage) from vicidial_campaign_server_stats $group_SQLwhere;";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$balanceSHORT = $row[0];

	if (ereg('DISABLED',$DIALmix))
		{
		$DIALstatuses = (preg_replace("/ -$|^ /","",$DIALstatuses));
		$DIALstatuses = (ereg_replace(' ',', ',$DIALstatuses));
		}
	else
		{
		$stmt="select vcl_id from vicidial_campaigns_list_mix where status='ACTIVE' $groupSQLand limit 1;";
		$rslt=mysql_query($stmt, $link);
		$Lmix_to_print = mysql_num_rows($rslt);
		if ($Lmix_to_print > 0)
			{
			$row=mysql_fetch_row($rslt);
			$DIALstatuses = "List Mix: $row[0]";
			$DIALorder =	"List Mix: $row[0]";
			}
		}
	echo "<table width='100%' ><tr><th align=left><span class=\"font_calls\">" . $report_campaign_id . " " . $report_campaign_name . "</span></th></tr></table>";
	$str_table_top_info= "<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"bordertop\"><TR>";
	$str_table_top_info .= "<td width=\"15%\" class=\"font_date\"></TD><td width=\"7%\" class=\"font_left\"></TD>";
	$str_table_top_info .= "<td width=\"19%\" class=\"font_date\"></TD><td width=\"10%\" class=\"font_left\"></TD>";
	$str_table_top_info .= "<td width=\"11%\" class=\"font_date\"></TD><td width=\"7%\" class=\"font_left\"></TD>";
	$str_table_top_info .= "<td width=\"13%\" class=\"font_date\"></TD><td width=\"18%\" class=\"font_left\"></TD>";
	//$str_table_top_info .= "<td width=\"15%\" class=\"font_date\">拨号级别:</TD><td width=\"7%\" class=\"font_left\">".round($DIALlev,5)."</TD>";
	//$str_table_top_info .= "<td width=\"19%\" class=\"font_date\">中继线路:</TD><td width=\"10%\" class=\"font_left\">$balanceSHORT / $balanceFILL</TD>";
	//$str_table_top_info .= "<td width=\"11%\" class=\"font_date\">客户过滤:</TD><td width=\"7%\" class=\"font_left\">$DIALfilter</TD>";
	//$str_table_top_info .= "<td width=\"13%\" class=\"font_date\">时    间:</TD><td width=\"18%\" class=\"font_left\">$NOW_TIME</TD>";
	$str_table_top_info .= "</TR>";

	if ($adastats>1)
		{
		$str_table_top_info .= "<TR BGCOLOR=\"#f7f7f7\">";
		$str_table_top_info .= "<td class=\"font_date\">预拨号级别:</TD><td class=\"font_left\">$maxDIALlev</TD>";
		$str_table_top_info .= "<td class=\"font_date\">最高掉线率:</TD><td class=\"font_left\">$DROPmax%</TD>";
		$str_table_top_info .= "<td class=\"font_date\">等待目标差异:</TD><td class=\"font_left\">$targetDIFF</TD>";
		$str_table_top_info .= "<td class=\"font_date\">拨号强度:</TD><td class=\"font_left\">$ADAintense</TD>";
		$str_table_top_info .= "</TR>";

		$str_table_top_info .= "<TR BGCOLOR=\"#f7f7f7\">";
		$str_table_top_info .= "<td class=\"font_date\">拨号超时(秒):</TD><td class=\"font_left\">$DIALtimeout</TD>";
		$str_table_top_info .= "<td class=\"font_date\">期望停止时间:</TD><td class=\"font_left\">$TAPERtime</TD>";
		$str_table_top_info .= "<td class=\"font_date\">拨号时间方案:</TD><td class=\"font_left\">$CALLtime</TD>";
		$str_table_top_info .= "<td class=\"font_date\">可用话务员方案:</TD><td class=\"font_left\">$ADAavailonly</TD>";
		$str_table_top_info .= "</TR>";
		}

	$str_table_top_info .= "<TR>";
	$str_table_top_info .= "<td class=\"font_date\">拨号级别:</TD><td class=\"font_left\">".round($DIALlev,5)."</TD>";
	$str_table_top_info .= "<td class=\"font_date\">可拨打的Leads:</TD><td class=\"font_left\">$DAleads</TD>";
	//$str_table_top_info .= "<td class=\"font_date\">今天进线总数:</TD><td class=\"font_left\">$callsTODAY</TD>";
	$str_table_top_info .= "<td class=\"font_date\">可用话务员/分钟:</TD><td class=\"font_left\">" . round($agentsONEMIN,3) . "</TD>";
	$str_table_top_info .= "<td class=\"font_date\">拨号模式:</TD><td class=\"font_left\">$DIALmethod</TD>";
	$str_table_top_info .= "</TR>";

	$str_table_top_info .= "<TR>";
	$str_table_top_info .= "<td class=\"font_date\">拨号漏斗级别:</TD><td class=\"font_left\">$HOPlev</TD>";
	$str_table_top_info .= "<td class=\"font_date\">掉线/应答:</TD><td class=\"font_left\">$dropsTODAY / $answersTODAY</TD>";
	$str_table_top_info .= "<td class=\"font_date\">可用Leads状态:</TD><td class=\"font_left\" colspan=3>$DIALstatuses</TD>";
	$str_table_top_info .= "<!--<td class=\"font_date\">DL DIFF:&nbsp;</TD><td class=\"font_left\">$diffONEMIN&nbsp;</TD>-->";
	$str_table_top_info .= "</TR>";

	$str_table_top_info .= "<TR>";
	$str_table_top_info .= "<td class=\"font_date\">漏斗的Leads数量:</TD><td class=\"font_left\">$VDhop</TD>";
	$str_table_top_info .= "<td class=\"font_date\">掉线率:</TD><td class=\"font_left\">";
	if ($drpctTODAY >= $DROPmax)
		{$str_table_top_info .= "$drpctTODAY%</font>";}
	else
		{$str_table_top_info .= "$drpctTODAY%";}
	$str_table_top_info .= "</TD>";

	//$str_table_top_info .= "<td class=\"font_date\">Leads的排序:</TD><td class=\"font_left\">$DIALorder</TD>";
	$str_table_top_info .= "<td class=\"font_date\"></TD><td class=\"font_left\"></TD>";
	$str_table_top_info .= "<td class=\"font_date\"><!--DIFF:-->&nbsp;</TD><td class=\"font_left\"><!--$diffpctONEMIN%-->&nbsp;</TD>";

	$str_table_top_info .= "</TR>";
    $str_table_top_info .= "</table>";
	if($report_name=="real" || $report_name==""){
		//Campaign信息区
		if ( $dial_method != "INBOUND_MAN" ) {
		     echo $str_table_top_info;
		}     
	}

echo "<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">";
echo "<TD class=\"view\">";
echo "$ingroup_detail";
echo "</TD>";
echo "</TR>";
echo "</TABLE>";



###################################################################################
###### INBOUND/OUTBOUND CALLS
###################################################################################
if ($campaign_allow_inbound > 0)
	{

	$stmtB="from vicidial_auto_calls where status NOT IN('XFER') and ( (call_type='IN' and campaign_id IN($closer_campaignsSQL)) or (call_type IN('OUT','OUTBALANCE') $group_SQLand) ) order by queue_priority desc,campaign_id,call_time;";

	}
else
	{
	$stmtB="from vicidial_auto_calls where status NOT IN('XFER') $group_SQLand order by queue_priority desc,campaign_id,call_time;";
	}
if ($CALLSdisplay > 0)
	{
	$stmtA = "SELECT status,campaign_id,phone_number,server_ip,UNIX_TIMESTAMP(call_time),call_type,queue_priority,agent_only";
	}
else
	{
	$stmtA = "SELECT status";
	}

$str_table_info = "<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"number\">";

$k=0;
$agentonlycount=0;
$stmt = "$stmtA $stmtB";
//echo $stmt;
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$parked_to_print = mysql_num_rows($rslt);

	$out_total=0;
	$out_ring=0;
	$out_live=0;
	$in_ivr=0;
	$in_incall = 0;
	
  ### add by heibo 先取数据 2011-4-8 11:18:14
  $i=0;
  $Listrow = array();
  $ListIp  = array();
  while( $i < $parked_to_print ){
  	$Listrow[$i] = mysql_fetch_row($rslt);
  	$ListIp[$i]  = $Listrow[$i][3];
  	$i++;
  }
  ###过滤重复ip
  $ListIpData = array();
  $ListIp   = array_unique($ListIp);
  $ipcount  = count($ListIp);
  ###按ip取数据
  foreach($ListIp as $ipvalue){
     $ListIpData[$ipvalue]["out_total"] = 0;
     $ListIpData[$ipvalue]["out_ring"]  = 0;
     $ListIpData[$ipvalue]["out_live"]  = 0;
     $ListIpData[$ipvalue]["in_ivr"]    = 0;
     $ListIpData[$ipvalue]["in_incall"] = 0;     	
  }
  ###
  	
	
	if ($parked_to_print > 0)
	{
	$i=0;
	
	while ($i < $parked_to_print)
		{
		$row=$Listrow[$i];
    $ipvalue = $row[3];
    
		if (eregi("LIVE",$row[0])) 
			{
			$out_live++;
      $ListIpData[$ipvalue]["out_live"]++;
      
			if ($CALLSdisplay > 0)
				{
				$CDstatus[$k] =			$row[0];
				$CDcampaign_id[$k] =	$row[1];
				$CDphone_number[$k] =	$row[2];
				$CDserver_ip[$k] =		$row[3];
				$CDcall_time[$k] =		$row[4];
				$CDcall_type[$k] =		$row[5];
				$CDqueue_priority[$k] =	$row[6];
				$CDagent_only[$k] =		$row[7];
				if (strlen($CDagent_only[$k]) > 0) {$agentonlycount++;}
				$k++;
				}
			}
		else
			{
			if (eregi("IVR",$row[0])) 
				{
				$in_ivr++;
        $ListIpData[$ipvalue]["in_ivr"]++;
				if ($CALLSdisplay > 0)
					{
					$CDstatus[$k] =			$row[0];
					$CDcampaign_id[$k] =	$row[1];
					$CDphone_number[$k] =	$row[2];
					$CDserver_ip[$k] =		$row[3];
					$CDcall_time[$k] =		$row[4];
					$CDcall_type[$k] =		$row[5];
					$CDqueue_priority[$k] =	$row[6];
					$CDagent_only[$k] =		$row[7];
					if (strlen($CDagent_only[$k]) > 0) {$agentonlycount++;}
					$k++;
					}
				}elseif (eregi("CLOSER",$row[0])) 
				{$nothing=1;$in_incall = $in_incall + 1;
					$ListIpData[$ipvalue]["in_incall"]++;
					}
			else 
				{$out_ring++;
					$ListIpData[$ipvalue]["out_ring"]++;
					}
			}
    $ListIpData[$ipvalue]["out_total"]++;
		$out_total++;
		$i++;
		}
    

		if ($out_live > 0) {$F='<FONT class="r1">'; $FG='</FONT>';}
		if ($out_live > 4) {$F='<FONT class="r2">'; $FG='</FONT>';}
		if ($out_live > 9) {$F='<FONT class="r3">'; $FG='</FONT>';}
		if ($out_live > 14) {$F='<FONT class="r4">'; $FG='</FONT>';}
		
		$ipcount = count($ListIp);
	  foreach($ListIp as $ipvalue){
				$str_table_info .= "<tr>";
				if ($ipcount <= 1){
					  $str_table_info .= "<td width=\"10%\" class=\"border_bot\" align=center ><B>实时通话统计:</B>" . "<span class=\"total_font_calls\">" . $ListIpData[$ipvalue]["out_total"] . "</span></td>" ;
				}else{
				    $str_table_info .= "<td width=\"20%\" class=\"border_bot\" align=center ><B>" . $ipvalue . "  -- " . "实时通话统计:</B>" . "<span class=\"total_font_calls\">" . $ListIpData[$ipvalue]["out_total"] . "</span></td>" ;
				}
			  
				$str_table_info .= "<td width=\"5%\" class=\"border_bot\">通话:</td><td width=\"5%\" class=\"font_calls\">";
				if ($campaign_allow_inbound > 0)
					{$str_table_info .= $ListIpData[$ipvalue]['in_incall'] . "</td>";}
				else
					{$str_table_info .= $ListIpData[$ipvalue]['in_incall'] . "</td>";}
				
				$str_table_info .= "<td width=\"5%\" class=\"border_bot\">振铃:</td><td width=\"5%\" class=\"font_calls\">" . $ListIpData[$ipvalue]['out_ring'] . "</td>";
				$str_table_info .= "<td width=\"5%\" class=\"border_bot\">队列:</td><td width=\"5%\" class=\"font_calls\">" . $ListIpData[$ipvalue]['out_live'] . "</td>";
				$str_table_info .= "<td width=\"5%\" class=\"border_bot\">IVR:</td><td width=\"5%\" class=\"font_calls\">" . $ListIpData[$ipvalue]['in_ivr'] . "</td>";
				$str_table_info .= "<td width=\"5%\" class=\"border_bot\">&nbsp;</td><td width=\"5%\" class=\"font_calls\">&nbsp;</td>";
		    $str_table_info .= "<td width=\"5%\" class=\"border_bot\">&nbsp;</td><td width=\"5%\" class=\"font_calls\">&nbsp;</td>";		
				$str_table_info .= "</tr>";
	 }		
		
		}
	else
	{
	//echo "<tr><td colspan=5><font color=red style=\"font-size:11px;\">无电话等待</font></td></tr>";
	 $str_table_info .= "<tr>";
	 $str_table_info .= "<td width=\"10%\" class=\"border_bot\" align=center ><b>实时通话统计:</b>" . "<span class=\"total_font_calls\">" . chk_callstatus_number($out_total) . "</span></td>" ;
	 $str_table_info .= "<td width=\"5%\" class=\"border_bot\">通话:</td><td width=\"5%\" class=\"font_calls\">";
	 $in_incall=chk_callstatus_number($in_incall);
	 if ($campaign_allow_inbound > 0)
	  {$str_table_info .= "$in_incall</td>";}
	 else
	  {$str_table_info .= "$in_incall</td>";}
     
	 $str_table_info .= "<td width=\"5%\" class=\"border_bot\">振铃:</td><td width=\"5%\" class=\"font_calls\">".chk_callstatus_number($out_ring)."</td>";
	 $str_table_info .= "<td width=\"5%\" class=\"border_bot\">队列:</td><td width=\"5%\" class=\"font_calls\">".chk_callstatus_number($out_live)."</td>";
	 $str_table_info .= "<td width=\"5%\" class=\"border_bot\">IVR:</td><td width=\"5%\" class=\"font_calls\">".chk_callstatus_number($in_ivr)."</td>";
     $str_table_info .= "<td width=\"5%\" class=\"border_bot\">&nbsp;</td><td width=\"5%\" class=\"font_calls\">&nbsp;</td>";
     $str_table_info .= "<td width=\"5%\" class=\"border_bot\">&nbsp;</td><td width=\"5%\" class=\"font_calls\">&nbsp;</td>";     
	 $str_table_info .= "</tr>";
	 
	}
  
  









$AgentIp = array();
$AgentIpData = array();
 
$agent_incall=0;
$agent_ready=0;
$agent_paused=0;
$agent_dispo=0;
$agent_dead=0;
$agent_total=0;
$agent_ring = 0;


$phoneord=$orderby;
$userord=$orderby;
$groupord=$orderby;
$timeord=$orderby;
$campaignord=$orderby;
### add by fnatic @param $statusord ###
$statusord=$orderby;

if ($phoneord=='phoneup') {$phoneord='phonedown';}
  else {$phoneord='phoneup';}
if ($userord=='userup') {$userord='userdown';}
  else {$userord='userup';}
if ($groupord=='groupup') {$groupord='groupdown';}
  else {$groupord='groupup';}
if ($timeord=='timeup') {$timeord='timedown';}
  else {$timeord='timeup';}
if ($campaignord=='campaignup') {$campaignord='campaigndown';}
  else {$campaignord='campaignup';}
### add by fnatic @param $statusord ###
if($statusord=='statusup') {$statusord='statusdown';}
  else {$statusord='statusup';}





if ($orderby=='timeup') {$orderSQL='vicidial_live_agents.status,last_call_time';}
if ($orderby=='timedown') {$orderSQL='vicidial_live_agents.status desc,last_call_time desc';}
if ($orderby=='campaignup') {$orderSQL='vicidial_live_agents.campaign_id,vicidial_live_agents.status,last_call_time';}
if ($orderby=='campaigndown') {$orderSQL='vicidial_live_agents.campaign_id desc,vicidial_live_agents.status desc,last_call_time desc';}
if ($orderby=='groupup') {$orderSQL='user_group,vicidial_live_agents.status,last_call_time';}
if ($orderby=='groupdown') {$orderSQL='user_group desc,vicidial_live_agents.status desc,last_call_time desc';}
if ($orderby=='phoneup') {$orderSQL='extension,server_ip';}
if ($orderby=='phonedown') {$orderSQL='extension desc,server_ip desc';}
### add by fnatic @param $statusord ###
if ($orderby=='statusup') {$orderSQL='vicidial_live_agents.status,vicidial_live_agents.last_state_change asc';}
if ($orderby=='statusdown') {$orderSQL='vicidial_live_agents.status desc,vicidial_live_agents.last_state_change asc';}

if ($UidORname > 0)
	{
	if ($orderby=='userup') {$orderSQL='full_name,status,last_call_time';}
	if ($orderby=='userdown') {$orderSQL='full_name desc,status desc,last_call_time desc';}
	}
else
	{
	if ($orderby=='userup') {$orderSQL='vicidial_live_agents.user';}
	if ($orderby=='userdown') {$orderSQL='vicidial_live_agents.user desc';}
	}
//echo $usergroup . '====';exit;
if (eregi('ALL-ACTIVE',$group_string)) {$UgroupSQL = '';}
else {$UgroupSQL = " and vicidial_live_agents.campaign_id IN($group_SQL)";}
if (strlen($usergroup)<1) {
	//当用户为manager时默认列出该用户所管理的组
	if($user_level==8 || $user_level==7 || $user_level==6){
		$stmt="select user_group from vicidial_user_groups where fun_instr(manager,'$user_name') =1 or fun_instr(supervisor,'$user_name') =1 or fun_instr(qa,'$user_name') =1 ";
	    $rslt=mysql_query($stmt, $link);
	    $count_temp = mysql_num_rows($rslt);
	    $i = 0;
	    if($DB) {echo "$stmt\n";}
	    $user_group_arr =  array();
	    while($i< $count_temp){
			  $row=mysql_fetch_row($rslt);
			  $user_group_arr[]= "'" . $row[0] . "'";
			  $i++;
	    }
		$usergroupSQL = ' and user_group in(' . implode(",",$user_group_arr) . ')';
		//echo $usergroupSQL;exit;
	}else{
		$usergroupSQL = '';
	}
}
else {$usergroupSQL = " and user_group='" . mysql_real_escape_string($usergroup) . "'";}
if(!empty($_GET['et1_group_value'])){
$usergroupSQL .=" and vicidial_users.user in ({$_GET['et1_group_value']})";
//var_dump($_GET['et1_group_value']);
}

$stmt="select extension,vicidial_live_agents.user,conf_exten,vicidial_live_agents.status,vicidial_live_agents.server_ip,UNIX_TIMESTAMP(last_call_time),UNIX_TIMESTAMP(last_call_finish),call_server_ip,vicidial_live_agents.campaign_id,vicidial_users.user_group,vicidial_users.full_name,vicidial_live_agents.comments,vicidial_live_agents.calls_today,vicidial_live_agents.callerid,lead_id,UNIX_TIMESTAMP(last_state_change) from vicidial_live_agents,vicidial_users where vicidial_live_agents.user=vicidial_users.user $UgroupSQL $usergroupSQL order by $orderSQL;";
//echo $stmt;
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$talking_to_print = mysql_num_rows($rslt);
	if ($talking_to_print > 0)
	{
	$i=0;
	while ($i < $talking_to_print)
		{
		$row=mysql_fetch_row($rslt);

		$Aextension[$i] =		$row[0];
		$Auser[$i] =			$row[1];
		$Asessionid[$i] =		$row[2];
		$Astatus[$i] =			$row[3];
		$Aserver_ip[$i] =		$row[4];
		$Acall_time[$i] =		$row[5];
		$Acall_finish[$i] =		$row[6];
		$Acall_server_ip[$i] =	$row[7];
		$Acampaign_id[$i] =		$row[8];
		$Auser_group[$i] =		$row[9];
		$Afull_name[$i] =		$row[10];
		$Acomments[$i] = 		$row[11];
		$Acalls_today[$i] =		$row[12];
		$Acallerid[$i] =		$row[13];
		$Alead_id[$i] =			$row[14];
		$Astate_change[$i] =	$row[15];

		### 3-WAY Check ###
		if ($Alead_id[$i]!=0) 
			{
			$threewaystmt="select UNIX_TIMESTAMP(last_call_time) from vicidial_live_agents where lead_id='$Alead_id[$i]' and status='INCALL' order by UNIX_TIMESTAMP(last_call_time) desc";
			$threewayrslt=mysql_query($threewaystmt, $link);
			if (mysql_num_rows($threewayrslt)>1) 
				{
				$Astatus[$i]="3-WAY";
				$srow=mysql_fetch_row($threewayrslt);
				$Acall_mostrecent[$i]=$srow[0];
				}
			}
		### END 3-WAY Check ###

		$i++;
		}
   
   ###按IP显示
   $AgentIp = array_unique($Aserver_ip);
   foreach($AgentIp as $ipvalue){
		 $AgentIpData[$ipvalue]["agent_incall"] = 0;
		 $AgentIpData[$ipvalue]["agent_ready"]  = 0;
		 $AgentIpData[$ipvalue]["agent_paused"]  = 0;
		 $AgentIpData[$ipvalue]["agent_dead"]    = 0;
		 $AgentIpData[$ipvalue]["agent_total"] = 0;     
		 $AgentIpData[$ipvalue]["agent_ring"]    = 0;
		 $AgentIpData[$ipvalue]["agent_dispo"] = 0;     	
   }
   
$callerids='';
$pausecode='';
$stmt="select callerid,lead_id,phone_number from vicidial_auto_calls;";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$calls_to_list = mysql_num_rows($rslt);
	if ($calls_to_list > 0)
	{
	$i=0;
	while ($i < $calls_to_list)
		{
		$row=mysql_fetch_row($rslt);
		$callerids .=	"$row[0]|";
		$VAClead_ids[$i] =	$row[1];
		$VACphones[$i] =	$row[2];
		$i++;
		}
	}

### Lookup phone logins
	$i=0;
	while ($i < $talking_to_print)
		{
		if (eregi("R/",$Aextension[$i])) 
			{
			$protocol = 'EXTERNAL';
			$dialplan = eregi_replace('R/',"",$Aextension[$i]);
			$dialplan = eregi_replace("\@.*",'',$dialplan);
			$exten = "dialplan_number='$dialplan'";
			}
		if (eregi("Local/",$Aextension[$i])) 
			{
			$protocol = 'EXTERNAL';
			$dialplan = eregi_replace('Local/',"",$Aextension[$i]);
			$dialplan = eregi_replace("\@.*",'',$dialplan);
			$exten = "dialplan_number='$dialplan'";
			}
		if (eregi('SIP/',$Aextension[$i])) 
			{
			$protocol = 'SIP';
			$dialplan = eregi_replace('SIP/',"",$Aextension[$i]);
			$dialplan = eregi_replace("-.*",'',$dialplan);
			$exten = "extension='$dialplan'";
			}
		if (eregi('IAX2/',$Aextension[$i])) 
			{
			$protocol = 'IAX2';
			$dialplan = eregi_replace('IAX2/',"",$Aextension[$i]);
			$dialplan = eregi_replace("-.*",'',$dialplan);
			$exten = "extension='$dialplan'";
			}
		if (eregi('Zap/',$Aextension[$i])) 
			{
			$protocol = 'Zap';
			$dialplan = eregi_replace('Zap/',"",$Aextension[$i]);
			$exten = "extension='$dialplan'";
			}
		if (eregi('DAHDI/',$Aextension[$i])) 
			{
			$protocol = 'Zap';
			$dialplan = eregi_replace('DAHDI/',"",$Aextension[$i]);
			$exten = "extension='$dialplan'";
			}

		$stmt="select login from phones where server_ip='$Aserver_ip[$i]' and $exten and protocol='$protocol';";
		$rslt=mysql_query($stmt, $link);
		if ($DB) {echo "$stmt\n";}
		$phones_to_print = mysql_num_rows($rslt);
		if ($phones_to_print > 0)
			{
			$row=mysql_fetch_row($rslt);
			$Alogin[$i] = "$row[0]-----$i";
			}
		else
			{
			$Alogin[$i] = "$Aextension[$i]-----$i";
			}
		$i++;
		}

### Sort by phone if selected
	if ($orderby=='phoneup')
		{
		sort($Alogin);
		}
	if ($orderby=='phonedown')
		{
		rsort($Alogin);
		}

### Run through the loop to display agents

	$j=0;
	$agentcount=0;
	while ($j < $talking_to_print)
		{
		$n=0;
		$custphone='';
		##当前IP
		$ipvalue = $Aserver_ip[$j];
		
		while ($n < $calls_to_list)
			{
			if ( (ereg("$VAClead_ids[$n]", $Alead_id[$j])) and (strlen($VAClead_ids[$n]) == strlen($Alead_id[$j])) )
				{$custphone = $VACphones[$n];}
			$n++;
			}

		$phone_split = explode("-----",$Alogin[$j]);
		$i = $phone_split[1];

		if (eregi("READY|PAUSED",$Astatus[$i]))
			{
			$Acall_time[$i]=$Astate_change[$i];

			if ($Alead_id[$i] > 0)
				{
				$Astatus[$i] =	'DISPO';
				$Lstatus =		'DISPO';
				$status =		' DISPO';
				## Add by fnatic 
				$Status_Image_Description=$Nocall_Status_Dispo_Img;
				}
			}
		if ($non_latin < 1)
			{
			$extension = eregi_replace('Local/',"",$Aextension[$i]);
			$extension =		sprintf("%-14s", $extension);
			while(strlen($extension)>14) {$extension = substr("$extension", 0, -1);}
			}
		else
			{
			$extension = eregi_replace('Local/',"",$Aextension[$i]);
			$extension =		sprintf("%-48s", $extension);
			while(mb_strlen($extension, 'utf-8')>14) {$extension = mb_substr("$extension", 0, -1,'utf8');}
			}

		$phone =			sprintf("%-12s", $phone_split[0]);
		$custphone =		sprintf("%-11s", $custphone);
		$Luser =			$Auser[$i];
		$user =				sprintf("%-20s", $Auser[$i]);
		$Lsessionid =		$Asessionid[$i];
		$sessionid =		sprintf("%-9s", $Asessionid[$i]);
		$Lstatus =			$Astatus[$i];
		$status =			sprintf("%-6s", $Astatus[$i]);
		$Lserver_ip =		$Aserver_ip[$i];
		$server_ip =		sprintf("%-15s", $Aserver_ip[$i]);
		$call_server_ip =	sprintf("%-15s", $Acall_server_ip[$i]);
		$campaign_id =	sprintf("%-10s", $Acampaign_id[$i]);
		$comments=		$Acomments[$i];
		$calls_today =	sprintf("%-5s", $Acalls_today[$i]);
		   
		if (!ereg("N",$agent_pause_codes_active))
			{$pausecode='       ';}
		else
			{$pausecode='';}

		if (eregi("INCALL",$Lstatus)) 
			{
			$stmtP="select count(*) from parked_channels where channel_group='$Acallerid[$i]';";
			$rsltP=mysql_query($stmtP,$link);
			$rowP=mysql_fetch_row($rsltP);
			$parked_channel = $rowP[0];
			## Add by fnatic
			$Status_Image_Description=$Nocall_Status_Incall_Img."\n";

			if ($parked_channel > 0)
				{
				$Astatus[$i] =	'PARK';
				$Lstatus =		'PARK';
				$status =		' PARK ';
				}
			else
				{
				if (!ereg("$Acallerid[$i]\|",$callerids))
					{
					$Acall_time[$i]=$Astate_change[$i];

					$Astatus[$i] =	'DEAD';
					$Lstatus =		'DEAD';
					$status =		' DEAD ';
					## Add by fnatic
					$Status_Image_Description=$Status_Image_Description.$Nocall_Status_Dead_Img;
					}
				}

			if ( (eregi("AUTO",$comments)) or (strlen($comments)<1) )
				{
				$CM='A';
                ## Add by fnatic
                $Status_Image_Description=$Incall_Status_A_Img;
				}
			else
				{
				if (eregi("INBOUND",$comments)) 
					{
					$CM='I';
                ## Add by fnatic
                $Status_Image_Description=$Incall_status_I_img;
					}

				else
					{
					$CM='M';
					// grab vicidial_manager status to fix manudial agent status bug + fnatic
					$Status_Image_Description=$Incall_Status_M_img;	
					$manager_status="";
					$stmtK="SELECT vicidial_manager.status FROM vicidial_manager,vicidial_live_agents WHERE vicidial_live_agents.user='$user' AND vicidial_live_agents.callerid=vicidial_manager.callerid";
					$rsltK=mysql_query($stmtK,$link);
					$rowK=mysql_fetch_row($rsltK);
					$manager_status=$rowK[0];
					if($manager_status=="SENT")
						{
						$status="MDWAIT"; //manudial wait for customer pick up
						}
					elseif($manager_status=="UPDATED")
						{
					    $status="INCALL";
						}
					// end
					}
				}
			}
		else {
			$CM=' ';
			$Status_Image_Description='';
			}

		if ($UGdisplay > 0)
			{
			if ($non_latin < 1)
				{
				$user_group =		sprintf("%-12s", $Auser_group[$i]);
				while(strlen($user_group)>12) {$user_group = substr("$user_group", 0, -1);}
				}
			else
				{
				$user_group =		sprintf("%-40s", $Auser_group[$i]);
				while(mb_strlen($user_group, 'utf-8')>12) {$user_group = mb_substr("$user_group", 0, -1,'utf8');}
				}
			}
		if ($UidORname > 0)
			{
			if ($non_latin < 1)
				{
				$user =		sprintf("%-20s", $Afull_name[$i]);
				while(strlen($user)>20) {$user = substr("$user", 0, -1);}
				}
			else
				{
				$user =		sprintf("%-60s", $Afull_name[$i]);
				while(mb_strlen($user, 'utf-8')>20) {$user = mb_substr("$user", 0, -1,'utf8');}              
				}			
			}
		if (!eregi("INCALL|QUEUE|PARK|3-WAY",$Astatus[$i]))
			{$call_time_S = ($STARTtime - $Astate_change[$i]);}
		else if (eregi("3-WAY",$Astatus[$i]))
			{$call_time_S = ($STARTtime - $Acall_mostrecent[$i]);}		
		else
			{$call_time_S = ($STARTtime - $Acall_time[$i]);}

		$call_time_MS =		sec_convert($call_time_S,'M'); 
		$call_time_MS =		sprintf("%7s", $call_time_MS);
		$G = '';		$EG = '';
		//Add by fnatic 
		$NG = '';
		if ( ($Lstatus=='INCALL') or ($Lstatus=='PARK') )
			{$NG='class="thistle"' ;
			if ($call_time_S >= 10) {$G='<SPAN class="thistle"><B>'; $EG='</B></SPAN>'; $NG='class="thistle"' ;}
			if ($call_time_S >= 60) {$G='<SPAN class="violet"><B>'; $EG='</B></SPAN>';$NG='class="violet"' ;}
			if ($call_time_S >= 300) {$G='<SPAN class="purple"><B>'; $EG='</B></SPAN>';$NG='class="purple"' ;}
	#		if ($call_time_S >= 600) {$G='<SPAN class="purple"><B>'; $EG='</B></SPAN>';}

			}
		if ($Lstatus=='3-WAY')
			{$NG='class="lime"';
			if ($call_time_S >= 10) {$G='<SPAN class="lime"><B>'; $EG='</B></SPAN>'; $NG='class="lime"' ;}
			}
		if ($Lstatus=='DEAD')
			{ $NG='class="black"' ;
			if ($call_time_S >= 21600) 
				{$j++; continue;} 
			else
				{
				$agent_dead++;  $agent_total++;

		    $AgentIpData[$ipvalue]["agent_dead"]++;
		    $AgentIpData[$ipvalue]["agent_total"]++;   

				$G=''; $EG='';
				if ($call_time_S >= 10) {$G='<SPAN class="black"><B>'; $EG='</B></SPAN>'; $NG='class="black"' ;}
				}
			}
		if ($Lstatus=='DISPO')
			{
			$NG='class="khaki"' ;
		    $Status_Image_Description=$Nocall_Status_Dispo_Img;
			if ($call_time_S >= 21600) 
				{$j++; continue;} 
			else
				{
				$agent_dispo++;  $agent_total++;
		    $AgentIpData[$ipvalue]["agent_dispo"]++;
		    $AgentIpData[$ipvalue]["agent_total"]++;				
				$G='';
				if ($call_time_S >= 10) {$G='<SPAN class="dispo"><B>'; $EG='</B></SPAN>'; $NG='class="dispo"' ;}
				if ($call_time_S >= 60) {$G='<SPAN class="dispo"><B>'; $EG='</B></SPAN>';$NG='class="dispo"' ;}
				if ($call_time_S >= 300) {$G='<SPAN class="dispo"><B>'; $EG='</B></SPAN>';$NG='class="dispo"' ;}
				}
			}
		if ($Lstatus=='PAUSED') 
			{$NG='class="khaki"' ;
            ## Add by fnatic
            $Status_Image_Description=$Nocall_Status_Paused_Img;
			
			if (!ereg("N",$agent_pause_codes_active))
				{
				###$stmtC="select sub_status from vicidial_agent_log where user='$Luser' order by agent_log_id desc limit 1;";
				###Edit by fnatic
				//$stmtC="select vicidial_pause_codes.pause_code_name from vicidial_pause_codes, vicidial_agent_log where vicidial_agent_log.user='$Luser' and vicidial_pause_codes.pause_code =vicidial_agent_log.sub_status order by vicidial_agent_log.agent_log_id desc limit 1;";
				$stmtC  = "select pause_code_name from vicidial_pause_codes a,";
				$stmtC = $stmtC . " ( select sub_status from vicidial_agent_log where user='$Luser' order by agent_log_id desc limit 1 ) b ";
				$stmtC = $stmtC .  " where a.pause_code = b.sub_status and a.campaign_id='$campaign_id' ";

				  $rsltC=mysql_query($stmtC,$link);
				  $rowC=mysql_fetch_row($rsltC);
					if ($rowC) {

						###$pausecode = sprintf("%-6s", $rowC[0]);
						###Edit by fnatic
						###$pausecode = sprintf("%-10s", $rowC[0]);
		
						$pausecode = sprintf("%s", $rowC[0]);
						$pausecode = "[$pausecode]";
					}else{
						$pausecode='';
					}
					
				}
			else
				{$pausecode='';}

			if ($call_time_S >= 21600) 
				{$j++; continue;} 
			else
				{
				$agent_paused++;  $agent_total++;
		    $AgentIpData[$ipvalue]["agent_paused"]++;
		    $AgentIpData[$ipvalue]["agent_total"]++;					
				$G='';
				if ($call_time_S >= 10) {$G='<SPAN class="khaki"><B>'; $EG='</B></SPAN>';$NG='class="khaki"' ;}
				if ($call_time_S >= 60) {$G='<SPAN class="yellow"><B>'; $EG='</B></SPAN>';$NG='class="yellow"' ;}
				if ($call_time_S >= 300) {$G='<SPAN class="olive"><B>'; $EG='</B></SPAN>';$NG='class="olive"' ;}
				}
			}
#		if ( (strlen($Acall_server_ip[$i])> 4) and ($Acall_server_ip[$i] != "$Aserver_ip[$i]") )
#				{$G='<SPAN class="orange"><B>'; $EG='</B></SPAN>';}
    if ( eregi("RING",$status) ) { 
    	$Status_Image_Description=$Ring_Status_Img;
    	$NG='class="red1"' ;
    	if ($call_time_S >= 21600) 
			  {$j++; continue;} 
			else
				{
					$agent_ring++;  $agent_total++;
					
		      $AgentIpData[$ipvalue]["agent_ring"]++;
		      $AgentIpData[$ipvalue]["agent_total"]++;	
		      					
    	    $G='<SPAN class="red1"><B>'; $EG='</B></SPAN>';$NG='class="red1"' ;
				if ($call_time_S >= 5) {$G='<SPAN class="red1"><B>'; $EG='</B></SPAN>';$NG='class="red1"' ;}
				if ($call_time_S >= 10) {$G='<SPAN class="red2"><B>'; $EG='</B></SPAN>';$NG='class="red2"' ;}
				if ($call_time_S >= 30) {$G='<SPAN class="red3"><B>'; $EG='</B></SPAN>';$NG='class="red3"' ;}
			}	
    }
		if ( (eregi("INCALL",$status)) or (eregi("QUEUE",$status))  or (eregi("3-WAY",$status)) or (eregi("PARK",$status))) 
		{
			$agent_incall++;  $agent_total++;
		  $AgentIpData[$ipvalue]["agent_incall"]++;
		  $AgentIpData[$ipvalue]["agent_total"]++;			
			}
		if ( (eregi("READY",$status)) or (eregi("CLOSER",$status)) ) 
		{$agent_ready++;  $agent_total++;
		  $AgentIpData[$ipvalue]["agent_ready"]++;
		  $AgentIpData[$ipvalue]["agent_total"]++;			
			}
		if ( (eregi("READY",$status)) or (eregi("CLOSER",$status)) ) 
			{
            ## Add by fnatic
            $Status_Image_Description=$Nocall_Status_Ready_Img;
			
			$G='<SPAN class="lightblue"><B>'; $EG='</B></SPAN>'; $NG='class="lightblue"' ;
			if ($call_time_S >= 60) {$G='<SPAN class="blue"><B>'; $EG='</B></SPAN>';$NG='class="blue"' ;}
			if ($call_time_S >= 300) {$G='<SPAN class="midnightblue"><B>'; $EG='</B></SPAN>';$NG='class="midnightblue"' ;}
			}

		$L='';
		$R='';
		if ($SIPmonitorLINK>0) {$L=" <a href=\"sip:0$Lsessionid@$server_ip\">监听</a>";   $R='';}
		if ($IAXmonitorLINK>0) {$L=" <a href=\"iax:0$Lsessionid@$server_ip\">监听</a>";   $R='';}
		if ($SIPmonitorLINK>1) {$R=" | <a href=\"sip:$Lsessionid@$server_ip\">强插</a>";}
		if ($IAXmonitorLINK>1) {$R=" | <a href=\"iax:$Lsessionid@$server_ip\">强插</a>";}
		//Modify by fnatic start
		if ( (strlen($monitor_phone)>1) and (preg_match("/MONITOR/",$monitor_active) ) )
			{$L="  <<a href=\"javascript:send_monitor('$Lsessionid','$Lserver_ip','MONITOR');\">监听</a>>";   $R='';}
		if ( (strlen($monitor_phone)>1) and (preg_match("/BARGE/",$monitor_active) ) )       
			{$R="  <<a href=\"javascript:send_monitor('$Lsessionid','$Lserver_ip','BARGE');\">强插</a>>";}
		if ( (strlen($monitor_phone)>1) and (preg_match("/WHISPER/",$monitor_active) ) )
			{$R="  <<a href=\"javascript:send_monitor_whisper('$Lsessionid','$Lserver_ip','WHISPER', '".trim(preg_replace("/[a-zA-Z]|\//","",$phone))."');\">耳语</a>>";}
		if ( (strlen($monitor_phone)>1) and (preg_match("/MONITOR_ALL/",$monitor_active) ) )
			{
			 $L="  <<a href=\"javascript:send_monitor('$Lsessionid','$Lserver_ip','MONITOR');\">监听</a>>";   $R='';
			 $R.="  <<a href=\"javascript:send_monitor('$Lsessionid','$Lserver_ip','BARGE');\">强插</a>>";
			 $R.="  <<a href=\"javascript:send_monitor_whisper('$Lsessionid','$Lserver_ip','WHISPER', '".trim(preg_replace("/[a-zA-Z]|\//","",$phone))."');\">耳语</a>>";
			}
		//Modify by fnatic end

		if ($CUSTPHONEdisplay > 0)	{$CP = "<td>$custphone</td>";}
		else	{$CP = "";}

		if ($UGdisplay > 0)	{$UGD = "<td>$user_group</td>";}
		else	{$UGD = "";}

		if ($SERVdisplay > 0)	{$SVD = "<td>$server_ip</td><td>$call_server_ip</td>";}
		else	{$SVD = "";}

		if ($PHONEdisplay > 0)	{$phoneD = "<td>$phone</td>";}
		else	{$phoneD = "";}

		$vac_stage='';
		$vac_campaign='';
		$INGRP='';
		if ($CM == 'I') 
			{
			$stmt="select vac.campaign_id,vac.stage,vig.group_name from vicidial_auto_calls vac,vicidial_inbound_groups vig where vac.callerid='$Acallerid[$i]' and vac.campaign_id=vig.group_id LIMIT 1;";
			$rslt=mysql_query($stmt, $link);
			if ($DB) {echo "$stmt\n";}
			$ingrp_to_print = mysql_num_rows($rslt);
			
				if ($ingrp_to_print > 0)
				{
				$row=mysql_fetch_row($rslt);
				###Mod by fnatic
				###$vac_campaign =	sprintf("%-20s", "$row[0] - $row[2]");
	            $vac_campaign =	sprintf("%-20s", "$row[2]");

				$row[1] = eregi_replace(".*-",'',$row[1]);
				$vac_stage =	sprintf("%-4s", $row[1]);
				}

			// Mod by fnatic $INGRP = "<td>$vac_stage</td><td>$vac_campaign</td>";
			}
		
		//Add by fnatic start
		#  $INGRP = ($CM == 'I') ? "<td>$vac_stage</td><td>$vac_campaign</td>" : "<td>&nbsp;</td><td>&nbsp;</td>";
		  if($CM == 'I')
			{
		     $INGRP="<td>$vac_campaign</td>";
			 $HoldTimeVal="<td>$vac_stage</td>";
		    }
		else
			{
		    $INGRP="<td>&nbsp;</td>";
			$HoldTimeVal="<td>&nbsp;</td>";
		    }
        // Add by fnatic end
		$agentcount++;
//Mod by fnatic start
		//$Aecho .= "| $G$extension$EG |$phoneD<a href=\"./user_status.php?user=$Luser\" target=\"_blank\">$G$user$EG</a> <a href=\"javascript:ingroup_info('$Luser','$j');\">+</a> |$UGD $G$sessionid$EG$L$R | $G$status$EG $CM $pausecode| $CP$SVD$G$call_time_MS$EG | $G$campaign_id$EG | $G$calls_today$EG |$INGRP\n";

 $Aecho .= "<tr $NG>";
 //$Aecho .= "<td>$extension</td>";
 $Aecho .= "$phoneD";
 $Aecho .= "<td style='text-align:left;padding-left:15px;'>";
 $Aecho .= "<a href=\"./user_status.php?user=$Luser\" target=\"_blank\"><font $NG>$user</font></a>";
 $Aecho .= "<a href=\"javascript:ingroup_info('$Luser','$j');\">+</a>$L$R";
 $Aecho .= "</td>";
 $Aecho .= "$UGD";
 //$Aecho .= "<td>$sessionid$L$R</td>";
 $Aecho .= "<td style='text-align:left;padding-left:15px;'>$Status_Image_Description ".status_en2cn($status);
 //$Aecho .= $CM;
 $Aecho .= "$pausecode</td>";
 $Aecho .= "$CP$SVD";
 $Aecho .= "<td style='text-align:left;padding-left:15px;'>$call_time_MS</td>";
 $Aecho .= "$HoldTimeVal";
 $Aecho .= "<td>$campaign_id</td>";

 $agent_inboundcall_today = 0;
 $agent_outboundcall_today = 0;
 $stmtF="select count(*) from vicidial_closer_log where user='$Auser[$i]' and call_date>curdate();";
 $rsltF=mysql_query($stmtF, $link);
 if($rsltF)
    {
    $rowF=mysql_result($rsltF,0); 
    $agent_inboundcall_today=$rowF;
    }

 $stmtH="select count(*) from vicidial_log where user='$Auser[$i]' and call_date>curdate();";
 $rsltH=mysql_query($stmtH, $link);
 if($rsltH)
    {
    $rowH=mysql_result($rsltH,0); 
    $agent_outboundcall_today=$rowH;
    }
 $Aecho .= "<td>$calls_today</td>";

 $Aecho .= "<td>$agent_inboundcall_today</td>";
 $Aecho .= "<td>$agent_outboundcall_today</td>";

 $Aecho .= "$INGRP";
 $Aecho .= "</tr>"; 

		$j++;
		}




		if ($agent_ready > 0) {$B='<FONT class="b1">'; $BG='</FONT>';}
		if ($agent_ready > 4) {$B='<FONT class="b2">'; $BG='</FONT>';}
		if ($agent_ready > 9) {$B='<FONT class="b3">'; $BG='</FONT>';}
		if ($agent_ready > 14) {$B='<FONT class="b4">'; $BG='</FONT>';}

		
		  ####按IP显示 bug 1514
		  $tmpipcount = count($AgentIp);   
			foreach($AgentIp as $ipvalue){	
					//echo "\n<BR>\n";
					$str_table_info .= "<tr>";
					if ( $tmpipcount <= 1){
						   $str_table_info .= "<td class=\"border_bot\" align=center ><b>实时话务员统计:</b>" . "<span class=\"total_font_calls\">" . chk_callstatus_number($AgentIpData[$ipvalue]["agent_total"]) . "</span></td>" ;
				  }else{
				  	   $str_table_info .= "<td class=\"border_bot\" align=center ><b>" . $ipvalue . " -- 实时话务员统计:</b>" . "<span class=\"total_font_calls\">" . chk_callstatus_number($AgentIpData[$ipvalue]["agent_total"]) . "</span></td>" ;
					}
			    
					$str_table_info .= "<td class=\"border_bot\">可用:</td><td class=\"font_calls\" >" . $AgentIpData[$ipvalue]["agent_ready"] . "</td>";
					$str_table_info .= "<td class=\"border_bot\">振铃:</td><td class=\"font_calls\" >" . $AgentIpData[$ipvalue]["agent_ring"] . "</td>";
					$str_table_info .= "<td class=\"border_bot\">通话:</td><td class=\"font_calls\" >" . $AgentIpData[$ipvalue]["agent_incall"] . "</td>";
					
					if($Agent_Status_Dead_Display_Enable=='Y')
					{
					$str_table_info .= "<td class=\"border_bot\">休止:</td><td class=\"font_calls\">" . $AgentIpData[$ipvalue]["agent_dead"] . "</td>";
					}
					$str_table_info .= "<td class=\"border_bot\">小结:</td><td class=\"font_calls\">" . $AgentIpData[$ipvalue]["agent_dispo"] . "</td>";
					$str_table_info .= "<td class=\"border_bot\">暂停:</td><td class=\"font_calls\">" . $AgentIpData[$ipvalue]["agent_paused"]. "</td></tr>";
			}		
					$str_table_info .= "</table><br>";
			

		
		//echo "<PRE><FONT SIZE=2>";
		//echo "";
		if($report_name=="real" || $report_name==""){
			//Campaign统计信息区
			echo $str_table_info;
		}
		//echo "$Cecho";
		
		
		//echo "$Aecho";
		
	}
	else
	{
	//echo "无登录话务员\n";

	//Add by fnatic start
	
		$str_table_info .= "<tr>";
	  $str_table_info .= "<td class=\"border_bot\" align=center ><b>实时话务员统计:</b>" . "<span class=\"total_font_calls\">$agent_total</span></td>" ;
	  
	  $str_table_info .= "<td class=\"border_bot\">可用:</td><td class=\"font_calls\">$agent_ready</td>";	
		$str_table_info .= "<td class=\"border_bot\">振铃:</td><td class=\"font_calls\">$agent_ring</td>";
		$str_table_info .= "<td class=\"border_bot\">通话:</td><td class=\"font_calls\">$agent_incall</td>";
		
		$str_table_info .= "<td class=\"border_bot\">休止:</td><td class=\"font_calls\">$agent_dead</td>";
		$str_table_info .= "<td class=\"border_bot\">小结:</td><td class=\"font_calls\">$agent_dispo</td>";
		$str_table_info .= "<td class=\"border_bot\">暂停:</td><td class=\"font_calls\">$agent_paused</td></tr>";
		$str_table_info .= "</table><br>";		
		if($report_name=="real" || $report_name==""){
			echo $str_table_info;
		}			

		//echo "$Aecho";
		//Add by fnatic end
		//echo "<PRE>$Cecho";
	
	} ### end 实时话务员统计




   } #### end while 循环每个Campaigns


	
	

}	### end heibo $sumreport 为Y 为所有Campaign报表


	  function chk_callstatus_number($count)
	  {
	    if(!is_null($count)) return $count;
		else return 0;
	  }
	  

function status_en2cn($status_en)
	{ 
	  $status_en=trim($status_en);
      switch($status_en)
		{
	      case "PAUSED":
			  $status_cn='暂停';
			  break;
		  case "READY":
			  $status_cn='可用';
		      break;
		  case "INCALL":
			  $status_cn='通话';
			  break;
		  case "3-WAY":
			  $status_cn='三方通话';
			  break;
		  case "PARK":
			  $status_cn='保持电话';
			  break;
		  case "QUEUE":
			  $status_cn='排队';
			  break;
		  case "CLOSER":
			  $status_cn='可用'; //纯呼入型话务员为CLOSER,呼出或混合型话务员为READY
		      break;
		  case "DISPO":
			  $status_cn='小结';
			  break;
		  case "DEAD":
			  $status_cn='休止';
			  break;
		  case "RING":
			  $status_cn='振铃';
			  break;
		  case "MDWAIT":
			  $status_cn='外拨中...';
			  break;			  
	    }
		//return $status_en.$status_cn.strlen($status_en);
		return $status_cn;
    }
    


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