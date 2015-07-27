<?php
	header ("Content-type: text/html; charset=utf-8");
	require("dbconnect.php");
	if (isset($_GET["campaignid"]))					{$campaignid=$_GET["campaignid"];}
		elseif (isset($_POST["campaignid"]))		{$campaignid=$_POST["campaignid"];}
	$stmt = "SELECT enable_vtiger_integration,vtiger_server_ip,vtiger_dbname,vtiger_login,vtiger_pass,vtiger_url,vtiger_status_call FROM vicidial_campaigns where campaign_id='$campaignid';";
	$rslt=mysql_query($stmt, $link);
	if ($DB) {echo "$stmt\n";}
	$ss_conf_ct = mysql_num_rows($rslt);
	if ($ss_conf_ct > 0)
	{
		$row=mysql_fetch_row($rslt);
		$enable_vtiger_integration =	$row[0];
		$vtiger_server_ip	=			$row[1];
		$vtiger_dbname =				$row[2];
		$vtiger_login =					$row[3];
		$vtiger_pass =					$row[4];
		$vtiger_url =					$row[5];
		$vtiger_status_call =			$row[6];
	}
	if (isset($_GET["activityid"]))					{$activityid=$_GET["activityid"];}
		elseif (isset($_POST["activityid"]))			{$activityid=$_POST["activityid"];}
	if (isset($_GET["subject"]))					{$subject=$_GET["subject"];}
		elseif (isset($_POST["subject"]))			{$subject=$_POST["subject"];}

	mysql_query("SET NAMES UTF8");
	$subject = getDescription($subject,$campaignid);
	//echo $subject;exit;
	$TODAY = date("Y-m-d");
	$HHMMnow = date("H:i");
	
	$linkV=mysql_connect("$vtiger_server_ip", "$vtiger_login","$vtiger_pass");
	mysql_query("SET NAMES UTF8");
	if (!$linkV) {die("Could not connect: $vtiger_server_ip|$vtiger_dbname|$vtiger_login|$vtiger_pass" . mysql_error());}
	mysql_select_db("$vtiger_dbname", $linkV);
	$stmt="UPDATE vtiger_activity SET subject='$subject',due_date='$TODAY',time_end='$HHMMnow' where activityid='$activityid';";

	if ($DB) {echo "$stmt\n";}
	$rslt=mysql_query($stmt, $linkV);
	if (!$rslt) {die('Could not execute: ' . mysql_error());}
	if($vtiger_status_call=="LEAD"){
		updateLeadStatus($activityid,$subject);
	}
	echo "success";
	function getDescription($n,$campaignid){
		mysql_query("SET NAMES UTF8");
		global $link;
		#$stmt = "select status_name from v_dim_status where status = '$n' and campaign_id='$campaignid'";
		$stmt = "select status_name from vicidial_campaign_statuses where status = '$n'";
		$rslt=mysql_query($stmt, $link);
		if ($DB) {echo "$stmt\n";}
		$ss_conf_ct = mysql_num_rows($rslt);
		if ($ss_conf_ct > 0)
		{
			$row=mysql_fetch_row($rslt);
			return $row[0];
		}
		else
		{
			$stmt = "select status_name from vicidial_statuses where status = '$n'";
			$rslt=mysql_query($stmt, $link);
			if ($DB) {echo "$stmt\n";}
			$ss_conf_ct = mysql_num_rows($rslt);
			if ($ss_conf_ct > 0)
			{
				$row=mysql_fetch_row($rslt);
				return $row[0];
			}
			
		}
		return $n;
	}
	function updateLeadStatus($activityid,$status){
		mysql_query("SET NAMES UTF8");
		global $linkV;
		$crmid = "";
		$stmt = "SELECT crmid FROM vtiger_seactivityrel where activityid='$activityid'";
		$rslt=mysql_query($stmt, $linkV);
		if ($DB) {echo "$stmt\n";}
		$ss_conf_ct = mysql_num_rows($rslt);

		if ($ss_conf_ct > 0)
		{
			$row=mysql_fetch_row($rslt);
			$crmid = $row[0];
			$stmt = "update vtiger_leaddetails set leadstatus='$status' where leadid='$crmid'";
			$rslt=mysql_query($stmt, $linkV);
			if (!$rslt) {die('Could not execute: ' . mysql_error());}
		}
	}
?>