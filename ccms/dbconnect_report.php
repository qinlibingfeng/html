<?php
# 
# dbconnect.php    version 2.2.0
#
# database connection settings and some global web settings
#
# Copyright (C) 2010  Matt Florell <vicidial@gmail.com>    LICENSE: AGPLv2
#
if ( file_exists("/etc/astguiclient.conf") )
	{
	$DBCagc = file("/etc/astguiclient.conf");
	foreach ($DBCagc as $DBCline) 
		{
		$DBCline = preg_replace("/ |>|\n|\r|\t|\#.*|;.*/","",$DBCline);
		if (ereg("^PATHlogs", $DBCline))
			{$PATHlogs = $DBCline;   $PATHlogs = preg_replace("/.*=/","",$PATHlogs);}
		if (ereg("^PATHweb", $DBCline))
			{$WeBServeRRooT = $DBCline;   $WeBServeRRooT = preg_replace("/.*=/","",$WeBServeRRooT);}
		if (ereg("^VARserver_ip", $DBCline))
			{$WEBserver_ip = $DBCline;   $WEBserver_ip = preg_replace("/.*=/","",$WEBserver_ip);}
		if (ereg("^REPORT_server", $DBCline))
			{$REPORT_server = $DBCline;   $REPORT_server = preg_replace("/.*=/","",$REPORT_server);}
		if (ereg("^REPORT_database", $DBCline))
			{$REPORT_database = $DBCline;   $REPORT_database = preg_replace("/.*=/","",$REPORT_database);}
		if (ereg("^REPORT_user", $DBCline))
			{$REPORT_user = $DBCline;   $REPORT_user = preg_replace("/.*=/","",$REPORT_user);}
		if (ereg("^REPORT_pass", $DBCline))
			{$REPORT_pass = $DBCline;   $REPORT_pass = preg_replace("/.*=/","",$REPORT_pass);}
		if (ereg("^REPORT_port", $DBCline))
			{$REPORT_port = $DBCline;   $REPORT_port = preg_replace("/.*=/","",$REPORT_port);}
		}
	}
else
	{
	#defaults for DB connection
	$REPORT_server = 'localhost';
	$REPORT_port = '3306';
	$REPORT_user = 'cron';
	$REPORT_pass = '1234';
	$REPORT_database = '1234';
	$WeBServeRRooT = '/usr/local/apache2/htdocs';
	}

$link=mysql_connect("$REPORT_server:$REPORT_port", "$REPORT_user", "$REPORT_pass");
if (!$link) 
	{
    die('MySQL connect ERROR: ' . mysql_error());
	}
mysql_select_db("$REPORT_database");

$local_DEF = 'Local/';
$conf_silent_prefix = '7';
$local_AMP = '@';
$ext_context = 'default';
$recording_exten = '8309';
$WeBRooTWritablE = '1';
$non_latin = '0';	# set to 1 for UTF rules
$AM_shift_BEGIN = '03:45:00';
$AM_shift_END = '17:45:00';
$PM_shift_BEGIN = '17:45:01';
$PM_shift_END = '23:59:59';
$admin_qc_enabled = '0';
?>
