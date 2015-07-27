<?php

header ("Content-type: text/html; charset=utf-8");
require("dbconnect.php");

if (isset($_GET["action"]))				{$action=$_GET["action"];}
	elseif (isset($_POST["action"]))		{$action=$_POST["action"];}
if (isset($_GET["usergroup"]))			{$usergroup=$_GET["usergroup"];}
	elseif (isset($_POST["usergroup"]))		{$usergroup=$_POST["usergroup"];}if (isset($_GET["user"]))				{$user=$_GET["user"];}
	elseif (isset($_POST["user"]))			{$user=$_POST["user"];}if (isset($_GET["level"]))				{$level=$_GET["level"];}
	elseif (isset($_POST["level"]))			{$level=$_POST["level"];}
if (isset($_GET["disabled_campaigns"]))			{$disabled_campaigns=$_GET["disabled_campaigns"];}
	elseif (isset($_POST["disabled_campaigns"]))		{$disabled_campaigns=$_POST["disabled_campaigns"];}	
	
	
if($action == "campaign"){
	mysql_query("SET NAMES 'UTF8'");
	if($level == "7"){
		$result = check_supervisor($user,$usergroup);
		if($result != ""){
			echo " ::" . $result;
			exit;
		}
	}
	$stmt="SELECT allowed_campaigns from vicidial_user_groups where user_group='$usergroup';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	if ( (!eregi("ALL-CAMPAIGNS",$row[0])) )
	{
	$LOGallowed_campaignsSQL = eregi_replace(' -','',$row[0]);
	$LOGallowed_campaignsSQL = eregi_replace(' ',"','",$LOGallowed_campaignsSQL);
	$LOGallowed_campaignsSQL = "and campaign_id IN('$LOGallowed_campaignsSQL')";
	}
	
	$stmt="SELECT campaign_id,campaign_name from vicidial_campaigns where active='Y' $LOGallowed_campaignsSQL order by campaign_id;";
	
	$rslt=mysql_query($stmt, $link);
	$camps_to_print = mysql_num_rows($rslt);
	$o=0;
	$campaigns_list_user = "";
	$all_campaigns_hidden = "";
	while ($camps_to_print > $o) 
	{
		$rowx=mysql_fetch_row($rslt);
		$str_check = "";
		if ( (!eregi($rowx[0],$disabled_campaigns)) ){
			$str_check = " checked";
		}
		$bg = "#C2C2C2";
		if($o%2!=0){
			$bg = "$ffffff";	
		}
		$campaigns_list_user .= "<tr bgcolor=\"$bg\"><td><input name=\"al_campaign[]\" value=\"$rowx[0]\" type=\"checkbox\" $str_check/>$rowx[0] - $rowx[1]</td></tr>\n";
		$all_campaigns_hidden .= $rowx[0] . ",";
		$o++;
	}
	echo "<table border=0><input type=\"hidden\" name=\"all_campaigns_hidden\" value=\"$all_campaigns_hidden\" />\n";
	echo "$campaigns_list_user";
	echo "</table>\n";
}
if($action == "usergroup"){
	echo check_supervisor($user,$usergroup);
}

function check_supervisor($user,$usergroup){
	global $link;
	
	//modify by heibo 2011-4-21 10:19:30 bug 1581
	//$stmt="SELECT user_group from vicidial_user_groups where supervisor='$user' and user_group != '$usergroup'";
	$stmt="SELECT user_group from vicidial_user_groups where fun_instr(supervisor,'$user') = 1 and user_group != '$usergroup'";
	
	$rslt=mysql_query($stmt, $link);
	$camps_to_print = mysql_num_rows($rslt);
	if($camps_to_print > 0){
		$rowx=mysql_fetch_row($rslt);
		return $rowx[0];
	}else{
		return "";
	}
}	
?>