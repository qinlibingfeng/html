#!/usr/bin/php -q
<?php
include_once("phpagi.php"); 
include_once("phpagi-asmanager.php");
include_once("dbconnect.php");

$agi=new AGI;
/*
$action		= (string)$agi->request['action'];
$uniqueid	= (string)$agi->request['uniqueid'];
$filename	= (string)$agi->request['filename'];
$extension  = (string)$agi->request['extension'];
$start_time = (string)$agi->request['start_time'];
$end_time	= (string)$agi->request['end_time'];
*/

//$argv[0];
foreach($argv  as $val)
{
	$get_arg[] =$val;
}
 $agi->verbose("YYYYYYYYYYYYYYYYYYYY".$get_arg[1]);
/*
if(!empty($action)){
	if($action == "insert"){
		if(!empty($uniqueid) && !empty($filename) && !empty($extension) && !empty($start_time)){
			$server_ip = "10.201.107.82";
			$start_epoch = strtotime($start_time);
			$location = "http://".$server_ip."/RECORDING/MP3/".$filename;
			$sql = "insert into recording_log (server_ip,extension,start_time,start_epoch,filename,location,vicidial_id,user) value ('$server_ip', '$extension' , '$start_time', $start_epoch,'$filename','$location','$uniqueid','$extension')";
			mysql_query($sql, $link);
		}
	}
	if($action == "update"){
		if(!empty($uniqueid) && !empty($end_time)){
			$ehd_epoch = strtotime($end_time);
			$sql = "select start_time from recording_log where vicidial_id = '$uniqueid'";
			$rs = mysql_query($sql, $link);
			$row=mysql_fetch_array($rs);
			$rs_start_time = $row[0];
			$length_in_sec = $ehd_epoch - strtotime($rs_start_time);
			$length_in_min = $length_in_sec/60;
			$sql = "update recording_log set end_time = '$end_time',end_epoch = '$ehd_epoch',length_in_sec = $length_in_sec,length_in_min = $length_in_min where vicidial_id = '$uniqueid'";
			mysql_query($sql, $link);
		}
	
	}
}*/
?>

