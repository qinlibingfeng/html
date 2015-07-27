#!/usr/bin/php -q
<?php
include_once("phpagi.php"); 
include_once("phpagi-asmanager.php");

file_put_contents("/tmp/handle.txt","|" . date("Y-m-d H:i:s",time()) . "|\n",FILE_APPEND);
include_once("dbconnect.php");
file_put_contents("/tmp/handle.txt","||" . date("Y-m-d H:i:s",time()) . "||\n",FILE_APPEND);

## 不让该脚本运行超过10秒
set_time_limit(10);

## 关闭php输出的缓冲区
ob_implicit_flush(false);

## 关闭php所有输出的错误报告
error_reporting(0);

$agi = new AGI;

$callerid = "";
$protocol = "";
$channel = "";
$calleridname = "";
$extension = "";
$context = "default";
$priority = 1;
$rows_count = 0;
$conf_exten = "";
$status = "";
$campaign_id = "";
$server_ip = "";
$user = "";
//$NOW_TIME = date("Y-m-d H:i:s");
//$CIDdate = date("ymdHis");
//$StarTtime = date("U");
$SIqueryCID = "";
$options = 0;
$called = "";



if ($agi instanceof AGI)
	{
	$callerid = $agi->request["agi_callerid"];
	$protocol = $agi->request["agi_type"];
	$channel = $agi->request["agi_channel"];
	$calleridname = $agi->request["agi_calleridname"];
	$context = $agi->request["agi_context"];
	$unique_id = $agi->request["agi_uniqueid"];
	$dnid = $agi->request["agi_dnid"];
	$called = $dnid; 
	$extension = ($protocol."/".$callerid);
	$SIqueryCID = $calleridname;
	$agi->verbose("++++++++++++++++++$callerid++++++++++++++++$dnid++++++++++++++++++++++++++++++++++++++++++++++++");	
	## 台头分机打外线
	if (strlen($callerid)<=6 && strlen($dnid)>=8)
		{
/*
		$stmt = "SELECT vicidial_live_agents.conf_exten,vicidial_live_agents.status,vicidial_live_agents.campaign_id,vicidial_live_agents.server_ip,vicidial_live_agents.user,vicidial_live_agents.inbound_mode from vicidial_live_agents where vicidial_live_agents.extension like '%$extension%'";

    
		$rslt=mysql_query($stmt, $link);
		$rows_count = mysql_num_rows($rslt);

		if ($rows_count>0)
			{
			$rows = mysql_fetch_row($rslt);
			$conf_exten = "$rows[0]";
			$status = "$rows[1]";
			$campaign_id = "$rows[2]";
			$server_ip = "$rows[3]";
			$user = "$rows[4]";
			$campaign_inbound_mode = "$rows[5]";
			
			$agi->verbose("campaign_inbound_mode:".$campaign_inbound_mode);
			if ($campaign_inbound_mode == "ring")
				{
				$affected_rows=0;

				$stmt = "INSERT INTO ccms_live_phones (server_ip,unique_id,user,phone_ext,phone_status,conf_exten,agc_channel,callerid,call_type,dnid,start_time) values ('$server_ip','$unique_id','$user','$extension','MEETME','$conf_exten','$channel','$callerid','OUT','$dnid',now())";
				$agi->verbose("$stmt");
				$rslt = mysql_query($stmt, $link);
				$affected_rows = mysql_affected_rows();

				if ($affected_rows > 0) { $options = 1;	}			
				}
			}		
*/
		$agi->set_variable("OBROUTER",$options);
		if ($options==1)
			{
			$agi->set_variable("CONF_EXTEN",$conf_exten);
			}	
		}

	## AUTO模式台头分机打内线
	else if (strlen($callerid)<=6 && strlen($dnid)<=6) 
		{

		$found_agent = 0;
		/*
		$stmt = "SELECT count(*) from vicidial_live_agents where extension like '%$dnid%'";

		$rslt = mysql_query($stmt, $link);
		$row = mysql_fetch_row($rslt);
		$found_agent = $row[0];
    */
		if ($found_agent>0)
			{
			$agi->exec_goto($context,'93'.$dnid,1);
			}

		}
	}
?>
