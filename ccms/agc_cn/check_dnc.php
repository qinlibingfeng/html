<?php
require("dbconnect.php");
if (isset($_GET["phone_number"]))				{$phone_number=$_GET["phone_number"];}
	elseif (isset($_POST["phone_number"]))		{$phone_number=$_POST["phone_number"];}
if (isset($_GET["system_st"]))					{$system_st=$_GET["system_st"];}
	elseif (isset($_POST["system_st"]))			{$system_st=$_POST["system_st"];}
	else										{$system_st = 0;}
if (isset($_GET["type"]))						{$type=$_GET["type"];}
	elseif (isset($_POST["type"]))				{$type=$_POST["type"];}
	else										{$type = 0;}


if(strlen(trim($phone_number)) > 1){

	$dnc = 0;
	session_start();
	
	$user 				= $_SESSION['VD_login'];
	$password 			= $_SESSION['VD_pass'];
	$campaign 			= $_SESSION['VD_campaign'];
	$extension 			= $_SESSION['extension'];
	$context 			= $_SESSION['ext_context'];
	$server_ip 			= $_SESSION['server_ip'];
	$session_id 		= $_SESSION['session_id'];
	
	if($type == "del"){
		$stmt = "select `lead_id` from `vicidial_list` where `phone_number` = '$phone_number'";
		if ($format=='debug') {echo "\n<!-- $stmt -->";}
		$rslt=mysql_query($stmt, $link);
		if ($mel > 0) {$error = "error[0]:mysql-->$stmt";}
		$row=mysql_fetch_row($rslt);
		$lead_id = $row[0];
				
		$stmt="update `vicidial_callbacks` set `status` = 'DEAD' where `user` = '$user' and `lead_id` = '$lead_id'";
		
		if ($format=='debug') {echo "\n<!-- $stmt -->";}
		$rslt=mysql_query($stmt, $link);
		if($rslt) echo "SUCCESS";
		else echo "ERROR";

		exit();
	}

	header ("Content-type: text/html; charset=utf-8");
	header ("Cache-Control: no-cache, must-revalidate");
	header ("Pragma: no-cache");
	
	
	if($user){
	
		if($system_st){
			$stmt = "select * from `vicidial_dnc` where `phone_number` = '$phone_number'";
			
			$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'07005',$user,$server_ip,$session_name,$one_mysql_log);}
			
			$row=mysql_fetch_row($rslt);
			if($row[0]){
				echo "DNC:SYSTEM|".$phone_number;
				$dnc = 1;
				exit();
			}
		}
	
		if($dnc == 0 && trim($campaign) != ""){
			
				$stmt = "select * from `vicidial_campaign_dnc` where `phone_number` = '$phone_number' and `campaign_id` = '$campaign' limit 1";
					
				$rslt=mysql_query($stmt, $link);
				if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'07004',$user,$server_ip,$session_name,$one_mysql_log);}
					
				$row=mysql_fetch_row($rslt);
				if($row[0]){
					echo "DNC:Campaign(".$campaign.")|".$phone_number;
					$dnc = 1;
					exit();
				}
		}
	
	}
}

$str_array = array();
if($system_st == 1) $str_array[] = "SYSTEM";
if(trim($campaign) != "") $str_array[] = "CAMPAIGN($campaign)";
if(count($str_array) > 0){
	$str = implode(",",$str_array);
	echo "PASS:".$str."|".$phone_number;
}
else{
	echo "ERROR:No set any system or campaign";
}
?>