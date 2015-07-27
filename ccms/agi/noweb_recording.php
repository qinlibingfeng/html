#!/usr/bin/php -q
<?php

include_once("phpagi.php"); 
include_once("phpagi-asmanager.php");
include_once("dbconnect.php");
set_time_limit(10);
ini_set("date.timezone","Asia/Shanghai");
ob_implicit_flush(false);
error_reporting(0);
if ( file_exists("/etc/astguiclient.conf") )
        {
        $DBCagc = file("/etc/astguiclient.conf");
        foreach ($DBCagc as $DBCline) 
                {
                $DBCline = preg_replace("/ |>|\n|\r|\t|\#.*|;.*/","",$DBCline);
                if (ereg("^VARserver_ip", $DBCline))
                        {$VARserver_ip = $DBCline;   $VARserver_ip = preg_replace("/.*=/","",$VARserver_ip);}
                }
        }

$agi=new AGI;

foreach($argv  as $val)
{
	$get_arg[] =$val;
}

if($get_arg[1] == "insert"){

	$uniqueid	= $get_arg[2];
	$filename	= $get_arg[3];
	$extension  	= $get_arg[4];
	$start_time 	= substr($get_arg[5],0,4)."-".substr($get_arg[5],4,2)."-".substr($get_arg[5],6,2)." ".substr($get_arg[5],9,2).":".substr($get_arg[5],11,2).":".substr($get_arg[5],13,2);
	
	if(!empty($uniqueid) && !empty($filename) && !empty($extension) && !empty($start_time)){
		
		$server_ip = $VARserver_ip;
		$start_epoch = strtotime($start_time);
		$location = "http://".$server_ip."/RECORDINGS/GSW/".$filenamei."-all.mp3";
                 $sql = "insert into recording_log (server_ip,extension,start_time,start_epoch,filename,location,vicidial_id,user) value ('$server_ip', '$extension' , '$start_time', $start_epoch,'$filename','$location','$uniqueid','$extension')";
		mysql_query($sql, $link);
	}

}
if($get_arg[1] == "update"){
	//$agi->verbose("XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX");

	$uniqueid	= $get_arg[2];
	$end_time	= substr($get_arg[3],0,4)."-".substr($get_arg[3],4,2)."-".substr($get_arg[3],6,2)." ".substr($get_arg[3],9,2).":".substr($get_arg[3],11,2).":".substr($get_arg[3],13,2);
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
	#	$sql = "update call_log set end_time = '$end_time',end_epoch = '$ehd_epoch',length_in_sec = $length_in_sec,length_in_min = $length_in_min where uniqueid = '$uniqueid'";
	#	mysql_query($sql, $link);
	}
}
if($get_arg[1] == "calllog"){

        $uniqueid       = $get_arg[2];
	      $phone	  	= $get_arg[3];
       if(!empty($uniqueid) && !empty($phone)){
		            $sql = "select extension from vicidial_live_agents where conf_exten = '$phone'";
                $rs = mysql_query($sql, $link);
                $row=mysql_fetch_array($rs);
                $sipphone = $row[0];
                //$webphone = substr("$sipphone",4,4);
                $pos  = strpos($sipphone,"-",4);
                if ( $pos === false ){
                	  $webphone = substr("$sipphone",4);
                }else{
                	  $webphone = substr("$sipphone",4,($pos - 4 ));
              	}
              			            
                $sql = "update call_log set extension = '$webphone' where uniqueid = '$uniqueid'";
                
		            mysql_query($sql, $link);
        }
}

     
if($get_arg[1] == "outbound"){

        $caller		= $get_arg[2];
        $phone          = $get_arg[3];
        if(!empty($caller) && !empty($phone)){
	              $sql = "select extension from vicidial_live_agents where conf_exten = '$phone'";
                $rs = mysql_query($sql, $link);
                $row=mysql_fetch_array($rs);
                $sipphone = $row[0];
                //$webphone = substr("$sipphone",4,4);
                $pos  = strpos($sipphone,"-",4);
                if ( $pos === false ){
                	  $webphone = substr("$sipphone",4);
                }else{
                	  $webphone = substr("$sipphone",4,($pos - 4 ));
              	}
                
                
                $sql = "update call_log set extension = '$webphone' where caller_code = '$caller'";
                mysql_query($sql, $link);
        }
}
function yhb_log($islog,$action){
	
	$NOW_TIME = date("Y-m-d H:i:s");
	
	if ($islog ){
		$efp = fopen ("/tmp/yhb.txt", "a");
		fwrite ($efp,"$NOW_TIME|$action\n");  			
		
		fclose($efp);		
	}

	
}
function writelog($temp){
	$efp = fopen ("/tmp/yhb.txt", "a");
	fwrite ($efp, "$temp\n");
	fclose($efp);
}
mysql_query($link);

exit;
?>

