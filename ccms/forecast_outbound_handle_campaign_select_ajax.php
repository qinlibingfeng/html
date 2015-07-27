<?php 
require("dbconnect.php");
$campaign_id = $_REQUEST['campaign_id'];

$stmt = "SELECT
  auto_dial_level_switch,
  auto_dial_level,
  drop_call_seconds,
  shortest_time_send_call,
  acw_hold_time,
  wait_time_for_connet_agent,
  refresh_time,
  hopper_level,
  max_abandon_rate,
  max_wait_time,
  wait_time_avg,
  prefix_wait_hopper_level_add,
  wait_hopper_level_add,
  abadon_rate_avg,
  prefix_abandon_hopper_level_add,
  abandon_hopper_level_add  
FROM vicidial_campaigns
 where campaign_id='$campaign_id';";

$rslt=mysql_query($stmt, $link);
while ($row = mysql_fetch_array($rslt)){
	$auto_dial_level_switch = $row[0];
	$auto_dial_level = $row[1];
	$drop_call_seconds = $row[2];
	$shortest_time_send_call = $row[3];
	$acw_hold_time = $row[4];
	$wait_time_for_connet_agent = $row[5];
	$refresh_time = $row[6];
	$hopper_level = $row[7];
	$max_abandon_rate = $row[8];
	$max_wait_time = $row[9];
	$wait_time_avg = $row[10];
	$prefix_wait_hopper_level_add = $row[11];
	$wait_hopper_level_add = $row[12];
	$abadon_rate_avg = $row[13];
	$prefix_abandon_hopper_level_add = $row[14];
	$abandon_hopper_level_add = $row[15];
}

$auto_dial_level_checkbox_checked = "";
if($auto_dial_level_switch == "Y"){
	$auto_dial_level_checkbox_checked = " checked=checked ";
}

?>
<table width=90% border=0 align="center">
	<tr>
		<td colspan=100% class="set_title"><br>System Config:</td>
	</tr>
	<tr>
		<td align=right><input type=checkbox id="auto_dial_level_checkbox" name="auto_dial_level_checkbox" <?php echo $auto_dial_level_checkbox_checked;?> onclick=checked_auto_dial_level_checkbox(1) />系统自动调整拨号级别&nbsp;<a href="javascript:openNewWindow('admin.php?ADD=99999#sys_conf_auto_dial_level_checkbox')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a><!--add by pie 20130508--></td>
		<td>　</td> 
		<td align=right>拨号级别:</td>
		<td>
			<select size=1 name=auto_dial_level id="auto_dial_level">
				<option selected value=<?php echo $auto_dial_level; ?>><?php echo $auto_dial_level; ?></option>
				<option  value=0>0</option>
				<option  value=0>0</option>
				<option  value=1>1</option>
				<option  value=1.1>1.1</option>
				<option  value=1.2>1.2</option>
				<option  value=1.3>1.3</option>
				<option  value=1.4>1.4</option>
				<option  value=1.5>1.5</option>
				<option  value=1.6>1.6</option>
				<option  value=1.7>1.7</option>
				<option  value=1.8>1.8</option>
				<option  value=1.9>1.9</option>
				<option  value=2>2</option>
				<option  value=2.1>2.1</option>
				<option value=2.2>2.2</option>
				<option value=2.3>2.3</option>
				<option value=2.5>2.5</option>
				<option value=2.6>2.6</option>
				<option value=2.7>2.7</option>
				<option value=2.8>2.8</option>
				<option value=2.9>2.9</option>
				<option value=3>3</option>
				<option value=3.25>3.25</option>
				<option value=3.5>3.5</option>
				<option value=3.75>3.75</option>
				<option value=4>4</option>
				<option value=4.5>4.5</option>
				<option value=5>5</option>
			</select>(0为关闭)&nbsp;<a style=color:FF0000></a>
			&nbsp;<a href="javascript:openNewWindow('admin.php?ADD=99999#sys_conf_auto_dial_level')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a><!--add by pie 20130508-->
		</td>
	</tr>
	<tr>
		<td align=right>客户最大等待时长(S):</td>
		<td><input type=text id="drop_call_seconds" name="drop_call_seconds" id="drop_call_seconds" value="<?php echo $drop_call_seconds;?>" />&nbsp;<a href="javascript:openNewWindow('admin.php?ADD=99999#sys_conf_drop_call_seconds')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a><!--add by pie 20130508--></td>
		<td align=right>最短提前派Call时长(S):</td>
		<td><input type=text id="shortest_time_send_call" value="<?php echo $shortest_time_send_call;?>"/>(0为关闭)&nbsp;<a href="javascript:openNewWindow('admin.php?ADD=99999#sys_conf_shortest_time_send_call')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a><!--add by pie 20130508--></td>
	</tr>
	<tr>
		<td align=right>ACW状态保持时长(S):</td>
		<td><input type=text id="acw_hold_time" value="<?php echo $acw_hold_time;?>"/>&nbsp;<a href="javascript:openNewWindow('admin.php?ADD=99999#sys_conf_acw_hold_time')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a><!--add by pie 20130508--></td>
		<td align=right>外拨派Call时长:</td>
		<td><input type=text id="wait_time_for_connet_agent" value="<?php echo $wait_time_for_connet_agent;?>" />&nbsp;<a href="javascript:openNewWindow('admin.php?ADD=99999#sys_conf_wait_time_for_connet_agent')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a><!--add by pie 20130508--></td>
	</tr>
	<tr>
		<td>　</td>
	</tr>
	<tr>
	<td><a href=admin.php?ADD=31&SUB=25&campaign_id=<?php echo "$campaign_id";?> target="_blank" /><font color="FF0000">外呼失败最大回滚次数&间隔时间设置</font></a></td> 
	</tr>
	<tr>
		<td>　</td>
	</tr>
	<tr>
		<td align=right>刷新频率(M):</td>
		<td>
			<select size=1 name=refresh_time id="refresh_time">
				<option selected value=<?php echo $refresh_time; ?>><?php echo $refresh_time; ?></option>
				<option  value=5>0.5</option>
				<option  value=10>1</option>
				<option  value=20>2</option>
				<option  value=30>3</option>
			</select>
			&nbsp;<a href="javascript:openNewWindow('admin.php?ADD=99999#sys_conf_refresh_time')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a><!--add by pie 20130508-->
		</td>
		<td align=right width=200>拨号漏斗级别:</td>
		<td width=300>
			<select size=1 name=hopper_level id="hopper_level">
			<option selected value=<?php echo $hopper_level; ?> ><?php echo $hopper_level; ?></option>
			<option value=1>1</option>
			<option value=5>5</option>
			<option value=10>10</option>
			<option value=20>20</option>
			<option value=50>50</option>
			<option value=100>100</option>
			<option value=200>200</option>
			<option value=500>500</option>
			<option value=700>700</option>
			<option value=1000>1000</option>
			<option value=2000>2000</option>
			</select>
			&nbsp;<a href="javascript:openNewWindow('admin.php?ADD=99999#sys_conf_hopper_level')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a><!--add by pie 20130508-->
		</td>
	</tr>
		<tr>
		<td align=right>目标掉线率(%):</td>
		<td><input type=text id="max_abandon_rate" value="<?php echo $max_abandon_rate;?>"/>&nbsp;<a href="javascript:openNewWindow('admin.php?ADD=99999#sys_conf_max_abandon_rate')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a><!--add by pie 20130508--></td>
		<td align=right>目标平均等待时间(S):</td>
		<td><input type=text id="max_wait_time" value="<?php echo $max_wait_time;?>" />&nbsp;<a href="javascript:openNewWindow('admin.php?ADD=99999#sys_conf_max_wait_time')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a><!--add by pie 20130508--></td>
	</tr>
	<tr>
		<td align=right>平均等待时间(S):</td>
		<td>
			<select size=1 name=wait_time_avg id="wait_time_avg">
				<option selected value=<?php echo $wait_time_avg; ?> ><?php echo $wait_time_avg; ?></option>
				<option value=1>1</option>
				<option value=1>1</option>
				<option value=5>5</option>
				<option value=10>10</option>
				<option value=15>15</option>
			</select>
			&nbsp;<a href="javascript:openNewWindow('admin.php?ADD=99999#sys_conf_wait_time_avg')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a><!--add by pie 20130508-->
		</td>
		<td align=right width=200>拨号级别:
			<select size=1 name=prefix_wait_hopper_level_add id="prefix_wait_hopper_level_add">
			<option selected value=<?php echo $prefix_wait_hopper_level_add; ?>><?php echo $prefix_wait_hopper_level_add==1?"+":"-"; ?></option>
			<option value=1>+</option>
			<option value=2>-</option>
			</select>
			
		</td>
		<td width=300>
			<select size=1 name=wait_hopper_level_add id="wait_hopper_level_add">
			<option selected value=<?php echo $wait_hopper_level_add; ?> ><?php echo $wait_hopper_level_add; ?></option>
			<option  value=1>0.1</option>
			<option  value=2>0.2</option>
			<option  value=3>0.3</option>
			<option value=4>0.4</option>
			<option  value=5>0.5</option>
			</select>
			&nbsp;<a href="javascript:openNewWindow('admin.php?ADD=99999#sys_conf_wait_hopper_level')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a><!--add by pie 20130508-->
		</td>
	</tr>
	<tr>
		<td align=right>掉线率(%):</td>
		<td>
			<select size=1 name=abadon_rate_avg id="abadon_rate_avg">
			<option selected value=<?php echo $abadon_rate_avg; ?> ><?php echo $abadon_rate_avg; ?></option>
				<option  value=1>1</option>
				<option  value=2>2</option>
				<option value=3>3</option>
				<option  value=4>4</option>
				<option value=5>5</option>
			</select>
			&nbsp;<a href="javascript:openNewWindow('admin.php?ADD=99999#sys_conf_abadon_rate_avg')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a><!--add by pie 20130508-->
		</td>
		<td align=right width=200>拨号级别:
			<select size=1 name=prefix_abandon_hopper_level_add id="prefix_abandon_hopper_level_add">
			<option selected value=<?php echo $prefix_abandon_hopper_level_add; ?>><?php echo $prefix_abandon_hopper_level_add==1?"+":"-"; ?></option>
			<option value=1>+</option>
			<option value=2>-</option>
			</select>
		</td>
		<td width=300>
			<select size=1 name=abandon_hopper_level_add id="abandon_hopper_level_add">
			<option selected value=<?php echo $abandon_hopper_level_add;?>><?php echo $abandon_hopper_level_add;?></option>
			<option  value=1>0.1</option>
			<option  value=2>0.2</option>
			<option value=3>0.3</option>
			<option value=4>0.4</option>
			<option value=5>0.5</option>
			</select>
			&nbsp;<a href="javascript:openNewWindow('admin.php?ADD=99999#sys_conf_abandon_hopper_level')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a><!--add by pie 20130508-->
		</td>
	</tr>
	<tr>
		<td>　</td>
	</tr>
	<tr>
		<td align=right colspan=2><input class="inputsubmit" type="submit" id="submit_button" onClick="submit_to_set();return false;" value="SUBMIT"></td>
	</tr>
	<tr>
		<td>　</td>
	</tr>
</table>