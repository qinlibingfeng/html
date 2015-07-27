<?php
# vtiger_user.php - script used to synchronize the users from the CCMS
#                   vicidial_users table into the Vtiger system as well as
#                   the groups from CCMS to Vtiger
#
# Copyright (C) 2009  Matt Florell <vicidial@gmail.com>    LICENSE: AGPLv2
#
# CHANGES
# 81231-1307 - First build
# 90228-2152 - Added Groups support
# 90508-0644 - Changed to PHP long tags
#
	header ("Content-type: text/html; charset=utf-8");

	require("dbconnect.php");
//	require("function_util.php");

	$PHP_AUTH_USER=$_SERVER['PHP_AUTH_USER'];
	$PHP_AUTH_PW=$_SERVER['PHP_AUTH_PW'];
	$PHP_SELF=$_SERVER['PHP_SELF'];

	if (isset($_GET["user_group"]))	{$user_group=$_GET["user_group"];}
	elseif (isset($_POST["user_group"]))	{$user_group=$_POST["user_group"];}

//	if (isset($_GET["campaign"]))				{$campaign=$_GET["campaign"];}
//	elseif (isset($_POST["campaign"]))		{$campaign=$_POST["campaign"];}


#	$DB = '1';	# DEBUG override
//	$US = '_';
//	$STARTtime = date("U");
//	$TODAY = date("Y-m-d");
//	$NOW_TIME = date("Y-m-d H:i:s");
//	$REC_TIME = date("Ymd-His");
//	$FILE_datetime = $STARTtime;
//	$parked_time = $STARTtime;

#### BEGIN Grab ALLOWED CAMPAIGNS
	$stmt="SELECT allowed_campaigns from vicidial_user_groups where user_group='$user_group';";
	$rslt=mysql_query("SET NAMES 'UTF8'");
	$rslt=mysql_query($stmt, $link);
	$itotal = mysql_num_rows($rslt);
	if($itotal >0)
	{
		$row=mysql_fetch_row($rslt);
		if ( (!eregi("ALL-CAMPAIGNS",$row[0])) )
		{
			$LOGallowed_campaignsSQL = eregi_replace(' -','',$row[0]);
			$LOGallowed_campaignsSQL = eregi_replace(' ',"','",$LOGallowed_campaignsSQL);
			$LOGallowed_campaignsSQL = "and campaign_id IN('$LOGallowed_campaignsSQL')";
		}

		$stmt="SELECT campaign_id,campaign_name from vicidial_campaigns where active='Y' $LOGallowed_campaignsSQL order by campaign_id;";
	//	echo $stmt."<hr>";
		$rslt=mysql_query("SET NAMES 'UTF8'");
		$rslt=mysql_query($stmt, $link);
		$camps_to_print = mysql_num_rows($rslt);
		$o=0;
		$allowed_campaigns = array();
		$campaigns_list_user = "";
		while ($camps_to_print > $o) 
		{
			$rowx=mysql_fetch_row($rslt);
	//		$str_check = "";
	//		if ( (!eregi($rowx[0] . ',',$disabled_campaigns)) ){
	//			$str_check = " checked";
				$allowed_campaigns[$o] = "'".$rowx[0]."'";
				//echo $rowx[0] . '--';
	//		}
			$o++;
		}
		$allowed_campaigns_list = implode(",",$allowed_campaigns);
	}
	if($allowed_campaigns_list == ''){$allowed_campaigns_list = "''";}
//	echo $allowed_campaigns_list."<br>";

#### END Grab ALLOWED CAMPAIGNS


###############################################################
##### Grab Every Integrate Vtiger's Info
##### START SYSTEM_SETTINGS VTIGER CONNECTION INFO LOOKUP #####
	$stmt = "SELECT enable_vtiger_integration,vtiger_server_ip,vtiger_dbname,vtiger_login,vtiger_pass,vtiger_url FROM vicidial_campaigns where campaign_id in (".$allowed_campaigns_list.") and enable_vtiger_integration = '1' ;";
//	echo $stmt."<br>";
	$rslt=mysql_query("SET NAMES 'UTF8'");
	$rslt=mysql_query($stmt, $link);
	if ($DB) {echo "$stmt\n";}
	$ss_conf_ct = mysql_num_rows($rslt);
	$i=0;
	while ($i < $ss_conf_ct)
	{
		$row=mysql_fetch_row($rslt);
		$enable_vtiger_integrations[$i] =	$row[0];
		$vtiger_server_ips[$i]	=			$row[1];
		$vtiger_dbnames[$i] =				$row[2];
		$vtiger_logins[$i] =					$row[3];
		$vtiger_passes[$i] =					$row[4];
		$vtiger_urls[$i] =					$row[5];
		$i++;
	}
//	echo $ss_conf_ct."<br>";
//	print_r($enable_vtiger_integrations);
//	echo "<br>";
//	print_r($vtiger_urls);
//	echo "<hr><hr>";

##### END SYSTEM_SETTINGS VTIGER CONNECTION INFO LOOKUP #####
#############################################################

##### grab the existing user_groups in the vicidial_user_groups table
	
	$stmt="SELECT user_group,group_name FROM vicidial_user_groups WHERE user_group = '$user_group';";
	$rslt=mysql_query("SET NAMES 'UTF8'");
	$rslt=mysql_query($stmt, $link);
	if ($DB) {echo "$stmt\n";}
	$VD_groups_ct = mysql_num_rows($rslt);
	$i=0;
	while ($i < $VD_groups_ct)
	{
		$row=mysql_fetch_row($rslt);
		$UGid[$i] =		$row[0];
		$UGname[$i] =	$row[1];
		$i++;
	}
//	echo "User_group<br>";
//	print_r($UGid);
//	echo "<br><hr>";


##### grab the existing users in the vicidial_users table
	$stmt="SELECT user,pass,full_name,user_level,active,user_group FROM vicidial_users	 WHERE user_group = '$user_group';";
	$rslt=mysql_query("SET NAMES 'UTF8'");
	$rslt=mysql_query($stmt, $link);
	if ($DB) {echo "$stmt\n";}
	$VD_users_ct = mysql_num_rows($rslt);
	$i=0;
	while ($i < $VD_users_ct)
	{
		$row=mysql_fetch_row($rslt);
		$users[$i] =			$row[0];
		$passes[$i] =			$row[1];
		$full_names[$i] =	$row[2];   
		while (strlen($full_names[$i])>30) 
		{
			$full_names[$i] = eregi_replace(".$",'',$full_names[$i]);
		}
		$user_levels[$i] =	$row[3];
		$actives[$i] =		$row[4];
		$user_groups[$i] =	$row[5];
		$users_in_group[$i]="'".$row[0]."'";
		$i++;
	}
	$users_in_group_list = implode(",",$users_in_group);
	if($users_in_group_list == ''){$users_in_group_list = "''";}
//	print_r($user_levels);
////	echo "user_group<br>";
////	print_r($user_groups);
//	echo "<br><hr>";



##### BEGIN Every Vtiger Integrate;
	$v=0;
	while($v < $ss_conf_ct)
	{
		$vtiger_server_ip	=	$vtiger_server_ips[$v];
		$vtiger_dbname	=	$vtiger_dbnames[$v];
		$vtiger_login			=	$vtiger_logins[$v];
		$vtiger_pass			=	$vtiger_passes[$v];
		$vtiger_url				=	$vtiger_urls[$v];

### connect to your vtiger database
	$linkV=mysql_connect("$vtiger_server_ip", "$vtiger_login","$vtiger_pass");
	if (!$linkV) {die("Could not connect: $vtiger_server_ip|$vtiger_dbname|$vtiger_login|$vtiger_pass" . mysql_error());}
//	echo "Connected successfully\n<BR>\n";
	mysql_select_db("$vtiger_dbname", $linkV);

##########################

### BEGIN Group export
	$i=0;
	while ($i < $VD_groups_ct)
	{
		$VTgroup_name =			$UGid[$i];
		$VTgroup_description =	$UGname[$i];
//		echo $VTgroup_name."<br>";
//		echo $VTgroup_description."<br>";

		$stmt="SELECT count(*) from vtiger_groups where groupname='$VTgroup_name';";
		$rslt=mysql_query("SET NAMES 'UTF8'");
		$rslt=mysql_query($stmt, $linkV);
		if ($DB) {echo "$stmt\n";}
		if (!$rslt) {die('Could not execute: ' . mysql_error());}
		$row=mysql_fetch_row($rslt);
		$group_found_count = $row[0];

### group exists in vtiger, grab groupid, update description
		if ($group_found_count > 0)
		{
			$stmt="SELECT groupid from vtiger_groups where groupname='$VTgroup_name';";
			$rslt=mysql_query("SET NAMES 'UTF8'");
			$rslt=mysql_query($stmt, $linkV);
			if ($DB) {echo "$stmt\n";}
			if (!$rslt) {die('Could not execute: ' . mysql_error());}
			$row=mysql_fetch_row($rslt);
			$groupid = $row[0];
			$VTugID[$i] = $groupid;
			mysql_query("set names utf8");
			$stmtA = "UPDATE vtiger_groups SET description='$VTgroup_description' where groupid='$groupid';";

			if ($DB) {echo "|$stmtA|\n";}
			$rslt=mysql_query($stmtA, $linkV);
			if (!$rslt) {die('Could not execute: ' . mysql_error());}

//			echo "GROUP- $VTgroup_name: $groupid<BR>\n";
//			echo "<BR>\n";
		}

### group doesn't exist in vtiger, insert it
		else
		{
#### BEGIN CREATE NEW GROUP RECORD IN VTIGER

# Get next available id from vtiger_users_seq to use as groupid
			$stmt="SELECT id from vtiger_users_seq;";
			if ($DB) {echo "$stmt\n";}
			$rslt=mysql_query("SET NAMES 'UTF8'");
			$rslt=mysql_query($stmt, $linkV);
			$row=mysql_fetch_row($rslt);
			$groupid = ($row[0] + 1);
			if (!$rslt) {die('Could not execute: ' . mysql_error());}
			$VTugID[$i] = $groupid;

# Increase next available groupid with 1 so next record gets proper id
			$stmt="UPDATE vtiger_users_seq SET id = '$groupid';";
			$rslt=mysql_query("SET NAMES 'UTF8'");
			if ($DB) {echo "$stmt\n";}
			$rslt=mysql_query($stmt, $linkV);
			if (!$rslt) {die('Could not execute: ' . mysql_error());}
			mysql_query("set names utf8");
			$stmtA = "INSERT INTO vtiger_groups SET groupid='$groupid',groupname='$VTgroup_name',description='$VTgroup_description';";
			if ($DB) {echo "|$stmtA|\n";}
			$rslt=mysql_query("SET NAMES 'UTF8'");
			$rslt=mysql_query($stmtA, $linkV);
			if (!$rslt) {die('Could not execute: ' . mysql_error());}

//			echo "GROUP- $VTgroup_name: $groupid<BR>\n";
//			echo "<BR>\n";
#### END CREATE NEW GROUP RECORD IN VTIGER
		}
		$i++;
	}
### END Group export
##########################


##########################
### BEGIN User export
	$i=0;
	while ($i < $VD_users_ct)
	{
		$user_name =		$users[$i];
		$VUgroup =			$user_groups[$i];
		$user_password =	$passes[$i];
		$last_name =		$full_names[$i];
		$is_admin =			'off';
		$roleid =			'H5';
		$status =			'Active';
		$groupid =			'1';
		if ($user_levels[$i] >= 7) {$roleid = 'H4';}
		if ($user_levels[$i] >= 8) {$roleid = 'H3';}
		if ($user_levels[$i] >= 9) {$roleid = 'H2';}
		if ($user_levels[$i] >= 9) {$is_admin = 'on';}
		if (ereg('N',$actives[$i])) {$status = 'Inactive';}
		$salt = substr($user_name, 0, 2);
		$salt = '$1$' . $salt . '$';
		$encrypted_password = crypt($user_password, $salt);
		$i++;

		$j=0;
		$all_VICIDIAL_groups_SQL='';
		while ($j < $VD_groups_ct)
		{
			if ( (eregi("$UGid[$j]",$VUgroup)) and ( (strlen($UGid[$j]))==(strlen($VUgroup)) ) )
			{
				$groupid =				$VTugID[$j];
				$VTgroup_name =			$UGid[$j];
				$VTgroup_description =	$UGname[$j];
			}
			else
			{
				$all_VICIDIAL_groups_SQL .= "'$VTugID[$j]',";
			}
			$j++;
		}
		$all_VICIDIAL_groups_SQL = preg_replace("/.$/",'',$all_VICIDIAL_groups_SQL);
//		echo $all_VICIDIAL_groups_SQL."<hr><hr><hr>";

		$stmt="SELECT count(*) from vtiger_users where user_name='$user_name';";
		$rslt=mysql_query("SET NAMES 'UTF8'");
		$rslt=mysql_query($stmt, $linkV);
		if ($DB) {echo "$stmt\n";}
		if (!$rslt) {die('Could not execute: ' . mysql_error());}
		$row=mysql_fetch_row($rslt);
		$found_count = $row[0];

### user exists in vtiger, update it
		if ($found_count > 0)
		{
			$stmt="SELECT id from vtiger_users where user_name='$user_name';";
			$rslt=mysql_query("SET NAMES 'UTF8'");
			$rslt=mysql_query($stmt, $linkV);
			if ($DB) {echo "$stmt\n";}
			if (!$rslt) {die('Could not execute: ' . mysql_error());}
			$row=mysql_fetch_row($rslt);
			$userid = $row[0];

			$stmt="SELECT count(*) from vtiger_users2group WHERE userid='$userid' and groupid='$groupid';";
			$rslt=mysql_query("SET NAMES 'UTF8'");
			$rslt=mysql_query($stmt, $linkV);
			if ($DB) {echo "$stmt\n";}
			if (!$rslt) {die('Could not execute: ' . mysql_error());}
			$row=mysql_fetch_row($rslt);
			$usergroupcount = $row[0];

			$stmtA = "UPDATE vtiger_users SET user_password='$encrypted_password',last_name='$last_name',is_admin='$is_admin',status='$status' where id='$userid';";
			if ($DB) {echo "|$stmtA|\n";}
			$rslt=mysql_query("SET NAMES 'UTF8'");
			$rslt=mysql_query($stmtA, $linkV);
			if (!$rslt) {die('Could not execute: ' . mysql_error());}

			$stmtB = "UPDATE vtiger_user2role SET roleid='$roleid' where userid='$userid';";
			if ($DB) {echo "|$stmtB|\n";}
			$rslt=mysql_query("SET NAMES 'UTF8'");
			$rslt=mysql_query($stmtB, $linkV);
			if (!$rslt) {die('Could not execute: ' . mysql_error());}
			if ($usergroupcount < 1)
			{
				if($all_VICIDIAL_groups_SQL != ''){
				$stmtC = "DELETE FROM vtiger_users2group WHERE userid='$userid' and groupid IN($all_VICIDIAL_groups_SQL);";
//				echo $stmtC."1111";
				if ($DB) {echo "|$stmtC|\n";}
				$rslt=mysql_query("SET NAMES 'UTF8'");
				$rslt=mysql_query($stmtC, $linkV);
				}
				if (!$rslt) {die('Could not execute: ' . mysql_error());}

				$stmtD = "INSERT INTO vtiger_users2group SET userid='$userid',groupid='$groupid';";
				if ($DB) {echo "|$stmtD|\n";}
				$rslt=mysql_query("SET NAMES 'UTF8'");
				$rslt=mysql_query($stmtD, $linkV);
				if (!$rslt) {die('Could not execute: ' . mysql_error());}
			}
			else
			{
				$stmtC='';
			}

//			echo "$user_name: $userid<BR>\n";
//			echo "$stmtA<BR>\n";
//			echo "$stmtB<BR>\n";
//			echo "$stmtC<BR>\n";
//			echo "$stmtD<BR>\n";
//			echo "<BR>\n";

		}

### user doesn't exist in vtiger, insert it
		else
		{
#### BEGIN CREATE NEW USER RECORD IN VTIGER
			$stmt="SELECT id from vtiger_users_seq;";
			if ($DB) {echo "$stmt\n";}
			$rslt=mysql_query("SET NAMES 'UTF8'");
			$rslt=mysql_query($stmt, $linkV);
			$row=mysql_fetch_row($rslt);
			$userid = ($row[0] + 1);
			
			$stmtA = "INSERT INTO vtiger_users SET id='$userid',user_name='$user_name',user_password='$encrypted_password',last_name='$last_name',is_admin='$is_admin',status='$status',date_format='yyyy-mm-dd',first_name='',reports_to_id='',description='',title='',department='',phone_home='',phone_mobile='',phone_work='',phone_other='',phone_fax='',email1='',email2='',yahoo_id='',signature='',address_street='',address_city='',address_state='',address_country='',address_postalcode='',user_preferences='',imagename='';";
			if ($DB) {echo "|$stmtA|\n";}
			$rslt=mysql_query("SET NAMES 'UTF8'");
			$rslt=mysql_query($stmtA, $linkV);
			if (!$rslt) {die('Could not execute: ' . mysql_error());}
//			$userid = mysql_insert_id($linkV);
		
			$stmtB = "INSERT INTO vtiger_user2role SET userid='$userid',roleid='$roleid';";
			if ($DB) {echo "|$stmtB|\n";}
			$rslt=mysql_query("SET NAMES 'UTF8'");
			$rslt=mysql_query($stmtB, $linkV);
			if (!$rslt) {die('Could not execute: ' . mysql_error());}

			$stmtC = "INSERT INTO vtiger_users2group SET userid='$userid',groupid='$groupid';";
			if ($DB) {echo "|$stmtC|\n";}
			$rslt=mysql_query("SET NAMES 'UTF8'");
			$rslt=mysql_query($stmtC, $linkV);
			if (!$rslt) {die('Could not execute: ' . mysql_error());}

			$stmtD = "UPDATE vtiger_users_seq SET id='$userid';";
			if ($DB) {echo "|$stmtD|\n";}
			$rslt=mysql_query("SET NAMES 'UTF8'");
			$rslt=mysql_query($stmtD, $linkV);
			if (!$rslt) {die('Could not execute: ' . mysql_error());}

//			echo "$user_name:<BR>\n";
//			echo "$stmtA<BR>\n";
//			echo "$stmtB<BR>\n";
//			echo "$stmtC<BR>\n";
//			echo "$stmtD<BR>\n";
//			echo "<BR>\n";
#### END CREATE NEW USER RECORD IN VTIGER
		}

	}
### END User export
##########################

### add by heibo start 2011-3-28 17:03:12 同时调用vtiger的“重新计算权限”功能

//	chdir("/var/www/html/ccms/crm_default/");
	$crm_url	= $WeBServeRRooT.$vtiger_url."/";
	chdir("$crm_url");
//	echo getcwd();


	require_once("config.php");
	require_once('include/utils/utils.php');
	require_once('include/utils/UserInfoUtil.php');

	RecalculateSharingRules_group($users_in_group_list);

### add by heibo end
//echo "第".$v."次<br>";
		$v++;
	}
#### END Every Vtiger Integrate;

	echo "Synchronize Users with CRM Successfully!\n";
	exit;
