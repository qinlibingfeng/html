<?
# csc.php - CSC project API
#
# Copyright (C) 2011  dyx
# 
require("../dbconnect.php");
require("./csc_config.php");

$stmt="SELECT ccms_url from system_settings";
$rslt=mysql_query($stmt, $link);
$row=mysql_fetch_row($rslt);

$ccms_url =				$row[0];
$action = $_REQUEST['action'];

//弹屏处理
if($action == "popup_customer"){
	$uniqueid = $_REQUEST['uniqueid'];
	$phone_number= $_REQUEST['phone_number'];
	$stmt="SELECT cid,tid,lang from ast_ivr_trace_mcd_new where uniqueid ='$uniqueid';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$cid =		$row[0];
	$tid =		$row[1];
	$lang =		$row[2];
	header ("Location: ".$ticket_site_URL."bottom.jsp?customer_id=".$cid."&ivr_id=".$uniqueid."&ticket_id=".$tid."&caller_id=".$phone_number."&lang=".$lang);
}

//电话小结,通话记录处理
if($action == "insert_voice_record"){
	$uniqueid = $_REQUEST['uniqueid'];
	$user_name = $_REQUEST['user_name'];
	$dst_phone = $_REQUEST['dst_phone'];
	if(empty($uniqueid)){
		$stmt="SELECT ticket_id as tid,log_type from ccms_csc_ticketid where phonenum ='$dst_phone';";
		$rslt=mysql_query($stmt, $link);
		$row=mysql_fetch_row($rslt);
		$tid		= $row[0];
		$log_type	= $row[1];
		
		if(!empty($tid)){
			file($ticket_site_URL."updateIVRSDetail.jsp?ccis=callout&user_name=".$user_name."&ticket_id=".$tid."&ivr_id=&call_start_time=&call_end_time=&dialed_time=&dst_phone=".$dst_phone."&answer=no&log_type=".$log_type."&ivr_url=".$ccms_url."Download.php?uniqueid=");
			$str = $ticket_site_URL."updateIVRSDetail.jsp?ccis=callout&user_name=".$user_name."&ticket_id=".$tid."&ivr_id=&call_start_time=&call_end_time=&dialed_time=&dst_phone=".$dst_phone."&answer=no&log_type=".$log_type."&ivr_url=".$ccms_url."Download.php?uniqueid=";
			//$sql = "insert into ccms_csc_test (id) values ('$str')";
			//$rslt=mysql_query($sql, $link);
		}
	}else{
		$sql = "select direction,start_time,end_time,length_in_sec as call_time from v_call_log where uniqueid = '$uniqueid'";
		$rslt=mysql_query($sql, $link);
		$row=mysql_fetch_array($rslt);
		$direction = $row['direction'];
		$call_start_time = urlencode($row['start_time']);
		$call_end_time = urlencode($row['end_time']);
		$dialed_time = $row['call_time'];
		if($direction == 'Inbound'){
			$stmt="SELECT tid from ast_ivr_trace_mcd_new where uniqueid ='$uniqueid';";
			$rslt=mysql_query($stmt, $link);
			$row=mysql_fetch_row($rslt);
			$tid =		$row[0];
			//if(!empty($tid)){
				//file("http://192.168.100.48/updateIVRSDetail.jsp?ccis=callin&ivr_id=".$uniqueid."&call_start_time=".$call_start_time."&call_end_time=".$call_end_time."&dialed_time=".$dialed_time);
				$rs  = file($ticket_site_URL."updateIVRSDetail.jsp?ccis=callin&ivr_id=".$uniqueid."&call_start_time=".$call_start_time."&call_end_time=".$call_end_time."&dialed_time=".$dialed_time."&ivr_url=".$ccms_url."Download.php?uniqueid=".$uniqueid);
			
				$str = $ticket_site_URL."updateIVRSDetail.jsp?ccis=callin&ivr_id=".$uniqueid."&call_start_time=".$call_start_time."&call_end_time=".$call_end_time."&dialed_time=".$dialed_time."&ivr_url=".$ccms_url."Download.php?uniqueid=".$uniqueid;
				//$temstr = serialize($rs);
				//$sql = "insert into ccms_csc_test (id) values ('$str')";
				//$rslt=mysql_query($sql, $link);
			//}
			
		}
		if($direction == 'Outbound'){
			$stmt="SELECT ticket_id as tid,log_type from ccms_csc_ticketid where phonenum ='$dst_phone';";
			$rslt=mysql_query($stmt, $link);
			$row=mysql_fetch_row($rslt);
			$tid		= $row[0];
			$log_type	= $row[1];
			if(!empty($tid)){
				file($ticket_site_URL."updateIVRSDetail.jsp?ccis=callout&user_name=".$user_name."&ticket_id=".$tid."&ivr_id=".$uniqueid."&call_start_time=".$call_start_time."&call_end_time=".$call_end_time."&dialed_time=".$dialed_time."&dst_phone=".$dst_phone."&answer=".phonestatus($uniqueid)."&log_type=".$log_type."&ivr_url=".$ccms_url."Download.php?uniqueid=".$uniqueid);
				$str = $ticket_site_URL."updateIVRSDetail.jsp?ccis=callout&user_name=".$user_name."&ticket_id=".$tid."&ivr_id=".$uniqueid."&call_start_time=".$call_start_time."&call_end_time=".$call_end_time."&dialed_time=".$dialed_time."&dst_phone=".$dst_phone."&answer=".phonestatus($uniqueid)."&log_type=".$log_type."&ivr_url=".$ccms_url."Download.php?uniqueid=".$uniqueid;
				//$sql = "insert into ccms_csc_test (id) values ('$str')";
				//$rslt=mysql_query($sql, $link);
			}
			//file("http://192.168.100.48/updateIVRSDetail.jsp?ccis=callout&user_name=andyg&ticket_id=123654&ivr_id=".$uniqueid."&call_start_time=".$call_start_time."&call_end_time=".$call_end_time."&dialed_time=".$dialed_time."&dst_phone=".$dst_phone."&answer=yes&log_type=ccfc&ivr_url=http://10.201.107.82/Download.php?uniqueid=".$uniqueid);
		}
	}
	$sql = "delete from ccms_csc_ticketid where phonenum = '$dst_phone'";
	mysql_query($sql, $link);
	
}
//电话外拨保存tid
if($action == "ccms_csc_ticketid"){
	
	$phonenum = $_REQUEST['phonenum'];
	$tid = $_REQUEST['tid'];
	if(!empty($phonenum) && !empty($tid)){
		$sql = "insert into ccms_csc_ticketid (ticket_id,phonenum) values ($tid,'$phonenum')";
		mysql_query($sql, $link);
	}
}
//点击拨号接口
if($action == "external_dial"){
	$agent_user = $_REQUEST['user_name'];
	$agent_pwd  = $_REQUEST['password'];
	$phone_num  = $_REQUEST['dst_phone'];
	$tid		= $_REQUEST['ticket_id'];
	$log_type	= $_REQUEST['log_type'];

	if(!empty($tid) && !empty($agent_user) &&!empty($agent_pwd) &&!empty($phone_num) &&!empty($log_type)){
		
		$rs = file($ccms_url."/ccms_api.php?action=external_dial&user_name=".$agent_user."&password=".$agent_pwd."&dst_phone=".$phone_num."&source=csc&first_name=csc&last_name=csc");

		if($rs[0]==0){
			echo 0;//"在暂停状态下才可外拨";
		}else{
			echo 1;//外拨成功
			$sql = "delete from ccms_csc_ticketid where phonenum = '$phone_num'";
			mysql_query($sql, $link);
			$sql = "insert into ccms_csc_ticketid (ticket_id,phonenum,log_type) values ('$tid','$phone_num','$log_type')";
			mysql_query($sql, $link);
		}
	}else{
		echo "agent_user:$agent_user|agent_pwd:$agent_pwd |phone_num:$phone_num|tid:$tid|log_type:$log_type";
	}
	
}

//根据电话uniqueid判断电话是否成功接通
function phonestatus($uniqueid){
	global $link;
	$stmt = "select length_in_sec from vicidial_log where uniqueid='$uniqueid' order by uniqueid desc limit 1";
	$rslt = mysql_query($stmt, $link);
	$row = mysql_fetch_row($rslt);
	$length_in_sec = $row[0];
	if(empty($length_in_sec)){
		return "no";
	}
	if($length_in_sec > 0){
		return "yes";
	}else{
		return "no";
	}
}