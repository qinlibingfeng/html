<?php

require("dbconnect.php");
$mel=0;					# Mysql Error Log enabled = 1
$NOW_TIME=date("Y-m-d H:i:s");
$CIDdate=date("ymdHis");
$StarTtime=date("U");
$session_id="";
$SIP_user_DiaL="";
$ACTION="";
$server_ip="";
$campaign_cid="";
$ext_context="default";
$conf_exten="";
$protocol="SIP";
$$extension="";
$dnid="";

if (isset($_GET['SIP_user_DiaL'])) { $SIP_user_DiaL=$_GET['SIP_user_DiaL']; }
  elseif (isset($_POST['SIP_user_DiaL'])) { $SIP_user_DiaL=$_POST['SIP_user_DiaL']; }
if (isset($_GET['ACTION'])) { $ACTION=$_GET['ACTION'];}
  elseif (isset($_POST['ACTION'])) { $ACTION=$_POST['ACTION']; }
if (isset($_GET['server_ip'])) { $server_ip=$_GET['server_ip'];}
  elseif (isset($_POST['server_ip'])) { $server_ip=$_POST['server_ip'];}
if (isset($_GET['campaign_cid'])) { $campaign_cid=$_GET['campaign_cid'];}
  elseif (isset($_POST['campaign_cid'])) { $campaign_cid=$_POST['campaign_cid'];}
if (isset($_GET['ext_context'])) { $ext_context=$_GET['ext_context'];}
  elseif (isset($_POST['ext_context'])) { $ext_context=$_POST['ext_context']; }
if (isset($_GET['conf_exten'])) { $conf_exten=$_GET['conf_exten']; }
  elseif (isset($_POST['conf_exten'])) { $conf_exten=$_POST['conf_exten']; }
if (isset($_GET['protocol'])) { $protocol=$_GET['protocol']; }
  elseif (isset($_POST['protocol'])) { $protocol=$_POST['protocol']; }
if (isset($_GET['extension'])) { $extension=$_GET['extension']; }
  elseif (isset($_POST['extension'])) { $extension=$_POST['extension'];}

$session_id=$conf_exten;
$SIqueryCID = "S$CIDdate$session_id";

### ring the agent phone
### insert a new record to the vicidial_manager table to be processed
if ($ACTION=='client_phone_ring')
   {
     $stmt="INSERT INTO vicidial_manager values('','','$NOW_TIME','NEW','N','$server_ip','','Originate','$SIqueryCID','Channel: $SIP_user_DiaL','Context: $ext_context','Exten: $conf_exten','Priority: 1','Callerid: \"$SIqueryCID\" <$campaign_cid>','','','','','');";
     if ($DB) {echo "$stmt\n";}
     $rslt=mysql_query($stmt, $link);
	 if ($rslt) { echo "$SIP_user_DiaL"; }
     if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'01041',$VD_login,$server_ip,$session_name,$one_mysql_log);}
   }
### End ###

### Hangup the client phone or check the client phone sip channel
if ($ACTION=='client_phone_hangup' || $ACTION=='client_phone_sip_channel_checked')
    { 
	 $stmt="SELECT channel FROM live_sip_channels WHERE server_ip = '$server_ip' and channel LIKE \"$protocol/$extension%\" LIMIT 1;";
     if ($format=='debug') {echo "\n<!-- $stmt -->";}
	 $rslt=mysql_query($stmt, $link);
	 if ($rslt) 
	    {
		  $row=mysql_fetch_row($rslt);
		  $agent_channel = "$row[0]";
		  echo $agent_channel;
		  if ($format=='debug') {echo "\n<!-- $row[0] -->";}
		}
	}
### End ###

### Check ccms_live_phone whether outbound data for this the client phone
if ($ACTION=='client_phone_request_dial')
    { 
	 $stmt="SELECT dnid FROM ccms_live_phones WHERE server_ip = '$server_ip' and phone_ext='$SIP_user_DiaL' and phone_status='MEETME' and call_type='OUT'  order by start_time desc LIMIT 1;";
	 $rslt=mysql_query($stmt, $link);
	 if ($rslt) 
	    {
		  $row=mysql_fetch_row($rslt);
		  $dnid = "$row[0]";
		  if($dnid>=8)
			{
			$affected_row=0;
			$stmt="DELETE FROM ccms_live_phones WHERE server_ip='$server_ip' and phone_ext='$SIP_user_DiaL' and phone_status='MEETME' and call_type='OUT' and dnid=$dnid order by start_time desc  LIMIT 1;";
			$affected_row=mysql_query($stmt, $link);
			if($affected_row>0)
				{
				echo $dnid;
				}
			}  
		}
	}
### End ###


##### MySQL Error Logging #####
function mysql_error_logging($NOW_TIME,$link,$mel,$stmt,$query_id,$user,$server_ip,$session_name,$one_mysql_log)
{
$NOW_TIME = date("Y-m-d H:i:s");
#	mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00001',$user,$server_ip,$session_name,$one_mysql_log);
$errno='';   $error='';
if ( ($mel > 0) or ($one_mysql_log > 0) )
	{
	$errno = mysql_errno($link);
	if ( ($errno > 0) or ($mel > 1) or ($one_mysql_log > 0) )
		{
		$error = mysql_error($link);
		$efp = fopen ("./vicidial_mysql_errors.txt", "a");
		fwrite ($efp, "$NOW_TIME|vdc_db_query|$query_id|$errno|$error|$stmt|$user|$server_ip|$session_name|\n");
		fclose($efp);
		}
	}
$one_mysql_log=0;
return $errno;
}
?>