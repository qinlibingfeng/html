<?php

	header ("Content-type: text/html; charset=utf-8");
	require("dbconnect.php");

	if (isset($_GET["leadid"]))				{$leadid=$_GET["leadid"];}
		elseif (isset($_POST["leadid"]))		{$leadid=$_POST["leadid"];}
	$campaignid = "nielsen2";
	$stmt = "SELECT enable_vtiger_integration,vtiger_server_ip,vtiger_dbname,vtiger_login,vtiger_pass,vtiger_url FROM vicidial_campaigns where campaign_id='$campaignid';";
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
	}
	mysql_query("SET NAMES UTF8");
	$linkV=mysql_connect("$vtiger_server_ip", "$vtiger_login","$vtiger_pass");
	mysql_query("SET NAMES UTF8");
	if (!$linkV) {die("Could not connect: $vtiger_server_ip|$vtiger_dbname|$vtiger_login|$vtiger_pass" . mysql_error());}
	mysql_select_db("$vtiger_dbname", $linkV);
	
	//SELECT lastname FROM crm_default.vtiger_leaddetails WHERE leadid = 11028
	$lastname = "";
	$stmt = "SELECT lastname FROM crm_default.vtiger_leaddetails WHERE leadid = $leadid";
	$rslt=mysql_query($stmt, $link);
	if ($DB) {echo "$stmt\n";}
	$ss_conf_ct = mysql_num_rows($rslt);
	if ($ss_conf_ct > 0)
	{
		$row=mysql_fetch_row($rslt);
		$lastname = $row[0];
	}
	//SELECT country, phone, mobile, fax FROM crm_default.vtiger_leadaddress WHERE leadaddressid = 11028;
	$country = "";
	$phone = "";
	$mobile = "";
	$fax = "";
	$stmt = "SELECT country, phone, mobile, fax FROM crm_default.vtiger_leadaddress WHERE leadaddressid = $leadid";
	$rslt=mysql_query($stmt, $link);
	if ($DB) {echo "$stmt\n";}
	$ss_conf_ct = mysql_num_rows($rslt);
	if ($ss_conf_ct > 0)
	{
		$row=mysql_fetch_row($rslt);
		$country = $row[0];
		$phone = $row[1];
		$mobile = $row[2];
		$fax = $row[3];
	}
	//SELECT cf_639, cf_640, cf_641 FROM crm_default.vtiger_leadscf WHERE leadid = 11028;
	$cf_639 = "";
	$cf_640 = "";
	$cf_641 = "";
	$stmt = "SELECT cf_639, cf_640, cf_641 FROM crm_default.vtiger_leadscf WHERE leadid = $leadid";
	$rslt=mysql_query($stmt, $link);
	if ($DB) {echo "$stmt\n";}
	$ss_conf_ct = mysql_num_rows($rslt);
	if ($ss_conf_ct > 0)
	{
		$row=mysql_fetch_row($rslt);
		$cf_639 = $row[0];
		$cf_640 = $row[1];
		$cf_641 = $row[2];
	}
	
	$url = "http://10.201.107.82/ccms/crm_default/survey/index.php?sid=86499&newtest=Y&lang=zh-Hans&86499X33X229=$cf_639&86499X33X231=$cf_640&86499X33X233=$lastname&86499X33X235=$cf_641&86499X33X237=$mobile&86499X33X239=$phone&86499X33X241=$fax&86499X33X243=$country";
	//echo $url;
	echo "<meta http-equiv=\"refresh\" content=\"0;URL=$url\">";
?>