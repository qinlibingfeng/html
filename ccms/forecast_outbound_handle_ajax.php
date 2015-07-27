<?php
require("dbconnect.php");

$response_parameter_error = "";
$response_sql_error = "";
$response_return = "";

$campaign_id = (isset($_POST['campaign_id']))?$_POST['campaign_id']:$_GET['campaign_id'];
//start edit by pie 20130125;
$isSwitch	 =	 (isset($_POST['isSwitch']))?$_POST['isSwitch']:$_GET['isSwitch'];
$total_available	 =	 (isset($_POST['total_available']))?$_POST['total_available']:$_GET['total_available'];
$abandon_time	 =	 (isset($_POST['abandon_time']))?$_POST['abandon_time']:$_GET['abandon_time'];
$check_time	 =	 (isset($_POST['check_time']))?$_POST['check_time']:$_GET['check_time'];
$limit_con	 =	 (isset($_POST['limit_con']))?$_POST['limit_con']:$_GET['limit_con'];
$last_order_time	 =	 (isset($_POST['last_order_time']))?$_POST['last_order_time']:$_GET['last_order_time'];
//end;
$drop_call_seconds = (isset($_POST['drop_call_seconds']))?$_POST['drop_call_seconds']:$_GET['drop_call_seconds'];
$acw_hold_time = (isset($_POST['acw_hold_time']))?$_POST['acw_hold_time']:$_GET['acw_hold_time'];
$shortest_time_send_call = (isset($_POST['shortest_time_send_call']))?$_POST['shortest_time_send_call']:$_GET['shortest_time_send_call'];
$wait_time_for_connet_agent = (isset($_POST['wait_time_for_connet_agent']))?$_POST['wait_time_for_connet_agent']:$_GET['wait_time_for_connet_agent'];
$hopper_level = (isset($_POST['hopper_level']))?$_POST['hopper_level']:$_GET['hopper_level'];
$auto_dial_level = (isset($_POST['auto_dial_level']))?$_POST['auto_dial_level']:$_GET['auto_dial_level'];
$use_auto_dial_level = (isset($_POST['use_auto_dial_level']))?$_POST['use_auto_dial_level']:$_GET['use_auto_dial_level'];
$auto_dial_level_switch = (isset($_POST['auto_dial_level_switch']))?$_POST['auto_dial_level_switch']:$_GET['auto_dial_level_switch'];
$refresh_time = (isset($_POST['refresh_time']))?$_POST['refresh_time']:$_GET['refresh_time'];
$max_abandon_rate = (isset($_POST['max_abandon_rate']))?$_POST['max_abandon_rate']:$_GET['max_abandon_rate'];
$max_wait_time = (isset($_POST['max_wait_time']))?$_POST['max_wait_time']:$_GET['max_wait_time'];
$wait_time_avg = (isset($_POST['wait_time_avg']))?$_POST['wait_time_avg']:$_GET['wait_time_avg'];
$prefix_wait_hopper_level_add = (isset($_POST['prefix_wait_hopper_level_add']))?$_POST['prefix_wait_hopper_level_add']:$_GET['prefix_wait_hopper_level_add'];
$wait_hopper_level_add = (isset($_POST['wait_hopper_level_add']))?$_POST['wait_hopper_level_add']:$_GET['wait_hopper_level_add'];
$abadon_rate_avg = (isset($_POST['abadon_rate_avg']))?$_POST['abadon_rate_avg']:$_GET['abadon_rate_avg'];
$prefix_abandon_hopper_level_add = (isset($_POST['prefix_abandon_hopper_level_add']))?$_POST['prefix_abandon_hopper_level_add']:$_GET['prefix_abandon_hopper_level_add'];
$abandon_hopper_level_add = (isset($_POST['abandon_hopper_level_add']))?$_POST['abandon_hopper_level_add']:$_GET['abandon_hopper_level_add'];
$limit_used_leads = (isset($_POST['limit_used_leads']))?$_POST['limit_used_leads']:$_GET['limit_used_leads'];

if($campaign_id=="") 										$response_parameter_error .= "Campaigns值有误\n";
if($auto_dial_level_switch){
		$query = "update vicidial_campaigns set auto_dial_level_switch='$auto_dial_level_switch' where campaign_id='$campaign_id'";
		$result = mysql_query($query) or $response_sql_error .= "设置失败:".mysql_error()."\n";
}
else{
	if($auto_dial_level_switch == "Y"){
//start edit by pie 20130125;
//	if(!preg_match("/^[0-9]+$/",$isSwitch)) 				$response_parameter_error .= Switch数值有误\n";
//	if(!preg_match("/^[0-9]+(\.[0-9]+)?$/",$total_available))		$response_parameter_error .= "坐席闲置率数值有误\n";
//	if(!preg_match("/^[0-9]+$/",$abandon_time)) 					$response_parameter_error .= "Abandon号码有效时长数值有误\n";
//	if(!preg_match("/^[0-9]+$/",$check_time)) 						$response_parameter_error .= "启动预测外拨判断间隔时长数值有误\n";
//	if(!preg_match("/^[0-9]+$/",$limit_con)) 							$response_parameter_error .= "最小历史订餐金额数值有误\n";
//	if(!preg_match("/^[0-9]+$/",$last_order_time)) 					$response_parameter_error .= "订餐记录有效时长数值有误\n";
//end;
if(!preg_match("/^[0-9]+$/",$drop_call_seconds)) 			$response_parameter_error .= "客户最大等待时长值有误\n";
if(!preg_match("/^[0-9]+$/",$acw_hold_time)) 				$response_parameter_error .= "ACW状态保持时长值有误\n";
if(!preg_match("/^[0-9]+$/",$shortest_time_send_call)) 		$response_parameter_error .= "最短提前派Call时长值有误\n";
if(!preg_match("/^[0-9]+$/",$hopper_level)) 				$response_parameter_error .= "号码缓冲池大小值有误\n";
if(!preg_match("/^[0-9]+(\.[0-9]+)?$/",$auto_dial_level))	$response_parameter_error .= "预测外拨比率值有误$auto_dial_level\n";
if(!preg_match("/^[0-9]+(\.[0-9]+)?$/",$refresh_time))	$response_parameter_error .= "刷新频率有误$refresh_time\n";
if(!preg_match("/^[0-9]+(\.[0-9]+)?$/",$max_abandon_rate))	$response_parameter_error .= "目标掉线率值有误$max_abandon_rate\n";
if(!preg_match("/^[0-9]+(\.[0-9]+)?$/",$max_wait_time))	$response_parameter_error .= "目标平均等待时间值有误$max_wait_time\n";
if(!preg_match("/^[0-9]+(\.[0-9]+)?$/",$wait_time_avg))	$response_parameter_error .= "平均等待时间值有误$wait_time_avg\n";
if(!preg_match("/^[0-9]+(\.[0-9]+)?$/",$wait_hopper_level_add))	$response_parameter_error .= "拨号级别值有误$wait_hopper_level_add\n";
if(!preg_match("/^[0-9]+(\.[0-9]+)?$/",$abadon_rate_avg))	$response_parameter_error .= "掉线率值有误$abadon_rate_avg\n";
if(!preg_match("/^[0-9]+(\.[0-9]+)?$/",$abandon_hopper_level_add))	$response_parameter_error .= "拨号级别值有误$abandon_hopper_level_add\n";
}

//	if(!$response_error){  edit by pie 20130125;
	if(!$response_parameter_error){
	
	$more_sql = "";
	if(!$use_auto_dial_level) $more_sql = ",auto_dial_level='$auto_dial_level' ";

	$query = "update vicidial_campaigns set drop_call_seconds='$drop_call_seconds',acw_hold_time='$acw_hold_time',shortest_time_send_call='$shortest_time_send_call',wait_time_for_connet_agent='$wait_time_for_connet_agent',hopper_level='$hopper_level',refresh_time='$refresh_time',max_abandon_rate='$max_abandon_rate',max_wait_time='$max_wait_time',wait_time_avg='$wait_time_avg',prefix_wait_hopper_level_add='$prefix_wait_hopper_level_add',wait_hopper_level_add='$wait_hopper_level_add',abadon_rate_avg='$abadon_rate_avg',prefix_abandon_hopper_level_add='$prefix_abandon_hopper_level_add',abandon_hopper_level_add='$abandon_hopper_level_add',limit_used_leads='$limit_used_leads' $more_sql where campaign_id='$campaign_id'";
	$result = mysql_query($query) or $response_sql_error .= "客户最大等待时长|号码缓冲池大小|预测外拨比率 更新有误:".mysql_error()."\n";

		$query = "update ccms_campaigns set switch='$isSwitch', total_available='$total_available', abandon_time='$abandon_time', check_time='$check_time', limit_con='$limit_con', last_order_time='$last_order_time' where campaign_id='$campaign_id'";
		$result = mysql_query($query) or $response_sql_error .= "Switch|坐席闲置率|Abandon号码有效时长|启动预测外拨判断间隔时长|最小历史订餐金额|订餐记录有效时长 更新有误:".mysql_error()."\n";
	
	}
}

echo "$response_parameter_error<=>$response_sql_error<=>$response_return";

