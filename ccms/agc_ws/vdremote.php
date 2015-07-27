<?

$version = '1.1.12';
$build = '60619-1603';

require("dbconnect.php");

$PHP_AUTH_USER=$_SERVER['PHP_AUTH_USER'];
$PHP_AUTH_PW=$_SERVER['PHP_AUTH_PW'];
/*if(isset($_GET['pr_login'])) {$PHP_AUTH_USER=$_GET['pr_login'];}
    elseif(isset($_POST['pr_login'])) {$PHP_AUTH_USER=$_POST['pr_login'];}
if(isset($_GET['pr_password'])) {$PHP_AUTH_PW=$_GET['pr_password'];}
    elseif(isset($_POST['pr_password'])) {$PHP_AUTH_PW=$_POST['pr_password'];}*/
$PHP_SELF=$_SERVER['PHP_SELF'];
if (isset($_GET["ADD"]))				{$ADD=$_GET["ADD"];}
	elseif (isset($_POST["ADD"]))		{$ADD=$_POST["ADD"];}
if (isset($_GET["DB"]))				{$DB=$_GET["DB"];}
	elseif (isset($_POST["DB"]))		{$DB=$_POST["DB"];}
if (isset($_GET["user"]))				{$user=$_GET["user"];}
	elseif (isset($_POST["user"]))		{$user=$_POST["user"];}
if (isset($_GET["force_logout"]))				{$force_logout=$_GET["force_logout"];}
	elseif (isset($_POST["force_logout"]))		{$force_logout=$_POST["force_logout"];}
if (isset($_GET["groups"]))				{$groups=$_GET["groups"];}
	elseif (isset($_POST["groups"]))		{$groups=$_POST["groups"];}
if (isset($_GET["remote_agent_id"]))				{$remote_agent_id=$_GET["remote_agent_id"];}
	elseif (isset($_POST["remote_agent_id"]))		{$remote_agent_id=$_POST["remote_agent_id"];}
if (isset($_GET["user_start"]))				{$user_start=$_GET["user_start"];}
	elseif (isset($_POST["user_start"]))		{$user_start=$_POST["user_start"];}
if (isset($_GET["number_of_lines"]))				{$number_of_lines=$_GET["number_of_lines"];}
	elseif (isset($_POST["number_of_lines"]))		{$number_of_lines=$_POST["number_of_lines"];}
if (isset($_GET["server_ip"]))				{$server_ip=$_GET["server_ip"];}
	elseif (isset($_POST["server_ip"]))		{$server_ip=$_POST["server_ip"];}
if (isset($_GET["conf_exten"]))				{$conf_exten=$_GET["conf_exten"];}
	elseif (isset($_POST["conf_exten"]))		{$conf_exten=$_POST["conf_exten"];}
if (isset($_GET["status"]))				{$status=$_GET["status"];}
	elseif (isset($_POST["status"]))		{$status=$_POST["status"];}
if (isset($_GET["campaign_id"]))				{$campaign_id=$_GET["campaign_id"];}
	elseif (isset($_POST["campaign_id"]))		{$campaign_id=$_POST["campaign_id"];}
if (isset($_GET["groups"]))				{$groups=$_GET["groups"];}
	elseif (isset($_POST["groups"]))		{$groups=$_POST["groups"];}
if (isset($_GET["submit"]))				{$submit=$_GET["submit"];}
	elseif (isset($_POST["submit"]))		{$submit=$_POST["submit"];}
if (isset($_GET["SUBMIT"]))				{$SUBMIT=$_GET["SUBMIT"];}
	elseif (isset($_POST["SUBMIT"]))		{$SUBMIT=$_POST["SUBMIT"];}

if (!isset($force_logout)) {$force_logout = 0;}

if ($force_logout)
{
  if( (strlen($PHP_AUTH_USER)>0) or (strlen($PHP_AUTH_PW)>0) )
	{
    Header("WWW-Authenticate: Basic realm=\"VICI-PROJECTS\"");
    Header("HTTP/1.0 401 Unauthorized");
	}
    echo "你已经签退,谢谢\n";
    exit;
}

$PHP_AUTH_USER = ereg_replace("[^0-9a-zA-Z]","",$PHP_AUTH_USER);
$PHP_AUTH_PW = ereg_replace("[^0-9a-zA-Z]","",$PHP_AUTH_PW);


$popup_page = './closer_popup.php';
$STARTtime = date("U");
$NOW_DATE = date("Y-m-d");
$NOW_TIME = date("Y-m-d H:i:s");
if (!isset($query_date)) {$query_date = $NOW_DATE;}

	$stmt="SELECT count(*) from vicidial_users where user='$PHP_AUTH_USER' and pass='$PHP_AUTH_PW' and user_level > 3;";
	if ($DB) {echo "|$stmt|\n";}
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$auth=$row[0];

$fp = fopen ("./project_auth_entries.txt", "a");
$date = date("r");
$ip = getenv("REMOTE_ADDR");
$browser = getenv("HTTP_USER_AGENT");

  if( (strlen($PHP_AUTH_USER)<2) or (strlen($PHP_AUTH_PW)<2) or (!$auth))
	{
    Header("WWW-Authenticate: Basic realm=\"VICI-PROJECTS\"");
    Header("HTTP/1.0 401 Unauthorized");
    echo "Invalid Username/Password: |$PHP_AUTH_USER|$PHP_AUTH_PW|\n";
    exit;
	}
  else
	{
	header ("Content-type: text/html; charset=utf-8");

	if($auth>0)
		{
		$office_no=strtoupper($PHP_AUTH_USER);
		$password=strtoupper($PHP_AUTH_PW);
		$stmt="SELECT full_name from vicidial_users where user='$PHP_AUTH_USER' and pass='$PHP_AUTH_PW'";
		$rslt=mysql_query($stmt, $link);
		$row=mysql_fetch_row($rslt);
		$LOGfullname=$row[0];

		$stmt="SELECT count(*) from vicidial_remote_agents where user_start='$PHP_AUTH_USER';";
		if ($DB) {echo "|$stmt|\n";}
		$rslt=mysql_query($stmt, $link);
		$row=mysql_fetch_row($rslt);
		$authx=$row[0];

		if($authx>0)
			{
			$stmt="SELECT id,server_ip,number_of_lines from vicidial_remote_agents where user_start='$PHP_AUTH_USER';";
			if ($DB) {echo "|$stmt|\n";}
			$rslt=mysql_query($stmt, $link);
			$row=mysql_fetch_row($rslt);
			$remote_agent_id=$row[0];
			$server_ip=$row[1];
			if (!$number_of_lines) {$number_of_lines=$row[2];}

			fwrite ($fp, "VDremote|GOOD|$date|$PHP_AUTH_USER|$PHP_AUTH_PW|$ip|$browser|$LOGfullname|\n");
			fclose($fp);
			}
		else
			{
			fwrite ($fp, "VDremote|FAIL|$date|$PHP_AUTH_USER|$PHP_AUTH_PW|$ip|$browser|$LOGfullname|\n");
			fclose($fp);
			echo "This remote agent does not exist: |$PHP_AUTH_USER|\n";
			exit;
			}
		}
	else
		{
		fwrite ($fp, "VDremote|FAIL|$date|$PHP_AUTH_USER|$PHP_AUTH_PW|$ip|$browser|\n");
		fclose($fp);
		}
	}

echo "<html>\n";
echo "<head>\n";
echo "<META HTTP-EQUIV=\"Content-Type\" CONTENT=\"text/html; charset=utf-8\">\n";
if ($ADD==61111)
	{
	echo"<META HTTP-EQUIV=Refresh CONTENT=\"5; URL=$PHP_SELF?ADD=61111&user=$user&DB=$DB\">\n";
	}
echo "<!-- 版本: $version     编译: $build -->\n";
?>
<STYLE type="text/css">
  .green {color: white; background-color: green}
   .red {color: white; background-color: red}
   .blue {color: white; background-color: blue}
   .purple {color: white; background-color: purple}
   .yellow {color: black; background-color: yellow}
   .orange {color: black; background-color: orange}
body{ font-family:Arial, Helvetica, sans-serif; font-size:12px;}
a{ color:#FFFFFF; }
.vdtable{ width:620px; border:none;  padding:8px 0px; background:url(vipic.gif) repeat;}
.vdtable tr.trone{ background:#865911; font-size:13px; color:#FFFFFF; font-weight:bold;}
.vdtable tr.trtwo{ background:#F4CB82; color:#000000; font-size:12px;}
.vdtable tr.trtwo a{ color:#000000;}
.vdtable td.trthree{ background:#EEEEE6; color:#000000; padding:0px 10px;}
.vdtable1{  border:none; width:600px; font-size:12px; color:#000000; margin-top:10px;border:1px solid #ffffff; border-collapse:collapse; margin-bottom:10px;}
.vdtable1 td{ border:1px solid #ffffff; border-collapse:collapse;}
.vdtable1 td a{ color:#000000;}

 </STYLE>
<?
echo "<title>远程座席: $LOGfullname - $PHP_AUTH_USER   ";

if (!$ADD)			{$ADD="31111";}
if ($ADD==31111)	{echo "修改远程座席";}
if ($ADD==41111)	{echo "外拨状态";}



if (strlen($ADD)>4)
	{
	##### get server listing for dynamic pulldown
	$stmt="SELECT server_ip,server_description from servers order by server_ip";
	$rslt=mysql_query($stmt, $link);
	$servers_to_print = mysql_num_rows($rslt);
	$servers_list='';

	$o=0;
	while ($servers_to_print > $o)
		{
		$rowx=mysql_fetch_row($rslt);
		$servers_list .= "<option value=\"$rowx[0]\">$rowx[0] - $rowx[1]</option>\n";
		$o++;
		}

	##### get campaigns listing for dynamic pulldown
	$stmt="SELECT campaign_id,campaign_name from vicidial_campaigns order by campaign_id";
	$rslt=mysql_query($stmt, $link);
	$campaigns_to_print = mysql_num_rows($rslt);
	$campaigns_list='';

	$o=0;
	while ($campaigns_to_print > $o)
		{
		$rowx=mysql_fetch_row($rslt);
		$campaigns_list .= "<option value=\"$rowx[0]\">$rowx[0] - $rowx[1]</option>\n";
		$o++;
		}

	##### get inbound groups listing for checkboxes
	if ( (($ADD==31111) or ($ADD==31111)) and (count($groups)<1) )
	{
	$stmt="SELECT closer_campaigns from vicidial_remote_agents where id='" . mysql_real_escape_string($remote_agent_id) . "';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$closer_campaigns =	$row[0];
	$closer_campaigns = preg_replace("/ -$/","",$closer_campaigns);
	$groups = explode(" ", $closer_campaigns);
	}

	$stmt="SELECT group_id,group_name from vicidial_inbound_groups order by group_id";
	$rslt=mysql_query($stmt, $link);
	$groups_to_print = mysql_num_rows($rslt);
	$groups_list='';
	$groups_value='';

	$o=0;
	while ($groups_to_print > $o)
		{
		$rowx=mysql_fetch_row($rslt);
		$group_id_value = $rowx[0];
		$group_name_value = $rowx[1];
		$groups_list .= "<input type=\"checkbox\" name=\"groups[]\" value=\"$group_id_value\"";
		$p=0;
		while ($p<50)
			{
			if ($group_id_value == $groups[$p]) 
				{
				$groups_list .= " CHECKED";
				$groups_value .= " $group_id_value";
				}
			$p++;
			}
		$groups_list .= "> $group_id_value - $group_name_value<BR>\n";
		$o++;
		}
	if (strlen($groups_value)>2) {$groups_value .= " -";}
	}

?>
</title>
</head>
<BODY>
<CENTER>
<TABLE class="vdtable">
<TR class="trone">
<TD ALIGN=LEFT> &nbsp; 远程座席: <? echo "$PHP_AUTH_USER " ?> &nbsp; <a href="<? echo $PHP_SELF ?>?force_logout=1">签出</a></TD>
<TD ALIGN=RIGHT><? echo date("l F j, Y G:i:s A") ?> &nbsp; </TD>
</TR>
<TR class="trtwo">
<TD ALIGN=LEFT COLSPAN=2> &nbsp; <a href="./vdremote.php">修改</a> | <a href="./vdremote.php?ADD=61111&user=<? echo "$PHP_AUTH_USER" ?>">状态</a></TD>
</TR>


<TR><TD class="trthree" align="left" colspan="2">
<? 



######################
# ADD=31111 modify remote agents info in the system
######################

if ($ADD==31111)
{
	echo "&nbsp;&nbsp;<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT * from vicidial_remote_agents where id='" . mysql_real_escape_string($remote_agent_id) . "';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$remote_agent_id =	$row[0];
	$user_start =		$row[1];
	$number_of_lines =	$row[2];
	$server_ip =		$row[3];
	$conf_exten =		$row[4];
	$status =			$row[5];
	$campaign_id =		$row[6];
?>
<center>
<br>

修改远程座席信息: <?php echo $row[0] ;?>
<form action=<?php echo $_SERVER['PHP_SELF'];?> method=POST>
<input type=hidden name=ADD value=41111>
<input type=hidden name=remote_agent_id value="<?php echo $row[0] ;?>">
<TABLE  class="vdtable1" >
<TR>
<td align=right>起始用户号: </TD>
<td align=left>
<?php echo $user_start ;?></TD>
</TR>
<TR>
<td align=right>线数: </TD>
<td align=left><input type=text name=number_of_lines size=3 maxlength=3 value="<?php echo $number_of_lines;?>"> (只能是数字)</TD>
</TR>
<tr >
<td align=right>服务器IP: </TD>
<td align=left><?php echo $row[3] ;?></TD>
</TR>
<TR>
<td align=right>座席号码: </TD>
<td align=left>
<input type=text name=conf_exten size=20 maxlength=20 value="<?php echo $conf_exten;?>"> (手机前加0)</TD>
</TR>
<TR>
<td align=right>状态: </TD>
<td align=left>
<select size="1" name="status">
<option  value="ACTIVE">激活</option>
<option value="INACTIVE">不激活</option>
<option value="<?php echo $status;?>" selected="selected"><?php if ($status=="ACTIVE") echo "激活"; if ($status=="INACTIVE") echo "不激活";?></option>
</select>
</TD>
</TR>
<TR>
<td align=right>任务: </TD>
<td align=left><?php echo $campaign_id;?></TD>
</TR>

<TR>
<td align=center colspan=2>
<input type=submit name="submit" value="提交">
</TD>
</TR>
</TABLE>
</form>
</center>
<?php } ?>
<!--

######################
# ADD=41111 modify remote agents info in the system
######################
-->
<?php 

if ($ADD==41111)
{
	echo "&nbsp;&nbsp;<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($number_of_lines) < 1) or (strlen($conf_exten) < 2) )
		{echo "<br>远程座席修改失败|$number_of_lines|$conf_exten|.\n";}
	 else
		{
		$stmt="UPDATE vicidial_remote_agents set number_of_lines='" . mysql_real_escape_string($number_of_lines) . "', conf_exten='" . mysql_real_escape_string($conf_exten) . "', status='" . mysql_real_escape_string($status) . "', closer_campaigns='" . mysql_real_escape_string($groups_value) . "' where id='" . mysql_real_escape_string($remote_agent_id) . "';";
		$rslt=mysql_query($stmt, $link);

#		echo "$stmt\n";
		echo "<br>远程座席修改成功\n";

		### LOG CHANGES TO LOG FILE ###
		$fp = fopen ("./admin_changes_log.txt", "a");
		fwrite ($fp, "$date|MODIFY REMOTE AGENTS ENTRY     |$PHP_AUTH_USER|$ip|$stmt|\n");
		fclose($fp);

		}

	$stmt="SELECT * from vicidial_remote_agents where id='" . mysql_real_escape_string($remote_agent_id) . "';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$remote_agent_id =	$row[0];
	$user_start =		$row[1];
	$number_of_lines =	$row[2];
	$server_ip =		$row[3];
	$conf_exten =		$row[4];
	$status =			$row[5];
	$campaign_id =		$row[6];
	
	if($DB) echo "status=".$status;
?>
<center>
修改座席记录: <?php echo $row[0];?>
<form action=<?php echo $_SERVER['PHP_SELF'];?> method=POST>
<input type="hidden" name="ADD" value="41111">

<input type="hidden" name="remote_agent_id" value="<?php echo $row[0];?>">

<TABLE class="vdtable1">
<TR>
<td align=right>起始用户号: </TD>
<td align=left><?php echo $user_start;?></TD>
</TR>
<TR>
<td align=right>线数: </TD>
<td align=left><?php echo $number_of_lines;?></TD>
</TR>
<TR>
<td align=right>服务器IP: </TD>
<td align=left><?php echo $row[3];?></TD>
</TR>
<TR>
<td align=right>座席号码: </TD>
<td align=left><input type="text name=conf_exten" size="20" maxlength="20" value="<?php echo $conf_exten;?>"> </TD>
</TR>
<TR>
<td align=right>状态: </TD>
<td align=left><select size="1" name="status"><option value="ACTIVE">激活</option><option value="INACTIVE">不激活</option><option value="<?php echo $status; ?>" SELECTED><?php if ($status=="ACTIVE") echo "激活"; if ($status=="INACTIVE") echo "不激活";?></option></select></TD>
</TR>
<tr >
<td align=right>任务: </TD>
<td align=left><?php echo $campaign_id;?></TD>
</TR>
<TR>
<td align=center colspan=2><input type=submit name=submit value=提交></TD>
</TR>
</TABLE>
</form>

<?php }?>
</center>
<!--
######################
# ADD=61111 status of remote agent in the system and active calls and queue
######################
-->
<?php if ($ADD==61111)
{


	 if ( (strlen($server_ip) < 2) or (strlen($user) < 2) )
		{echo "<br>没有这个远程话务员 \n";}
	 else
		{

		$users_list = '';
		$k=0;
		while($k < $number_of_lines)
			{
			$nextuser=($user + $k);
			$users_list .= "'" . mysql_real_escape_string($nextuser) . "',";
			$k++;
			}
		$users_list = preg_replace("/.$/","",$users_list);
        echo"<br>";
		echo "&nbsp;&nbsp;<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";
		echo "远程座席时间统计&nbsp;：&nbsp;$NOW_TIME\n\n";
		echo"<br><br>";
		echo "<center><TABLE class=vdtable1 \n";
		echo "<tr>
		      <td> 位置</td>
			  <td>用户</td>
			  <td>外拨纪录号</td>
			  <td>客户姓名</td>
			  <td>客户电话号码</td>
			  <td>通道</td>
			  <td>状态</td>
		      <td>开始时间</td>
			  <td> 时长(分)</td>
			  </tr>\n";
		mysql_query("set names 'utf-8'"); 
		//$stmt="select extension,user,lead_id,channel,status,last_call_time,UNIX_TIMESTAMP(last_call_time),UNIX_TIMESTAMP(last_call_finish),t2.first_name,t2.phone_number from vicidial_live_agents t1,vicidial_list t2 where status NOT IN('PAUSED') and server_ip='" . mysql_real_escape_string($server_ip) . "' and user = '".$user."' and lead_id = t2.lead_id order by extension;";
		$stmt="select extension,user,lead_id,channel,status,last_call_time,UNIX_TIMESTAMP(last_call_time),UNIX_TIMESTAMP(last_call_finish) from vicidial_live_agents t1 where status NOT IN('PAUSED') and server_ip='" . mysql_real_escape_string($server_ip) . "' and user = '".$user."'  order by extension;";
		$rslt=mysql_query($stmt, $link);
		
//$edit_message_sql="select edit_message from vicidial_remote_agents where id='" . mysql_real_escape_string($remote_agent_id) . "';";
//$edit_message_res=mysql_query($edit_message_sql,$link);
//$edit_message_all=mysql_fetch_row($edit_message_res);

		$talking_to_print = mysql_num_rows($rslt);
			if ($talking_to_print > 0)
			{
			$i=0;
			while ($i < $talking_to_print)
				{
				$leadlink=0;
				$row=mysql_fetch_row($rslt);
					if (eregi("READY|PAUSED",$row[4]))
					{
					$row[3]='';
					$row[5]=' - 等待 - ';
					$row[6]=$row[7];
					}
					
				$extension =		sprintf("%-10s", $row[0]);
				$user =				sprintf("%-6s", $row[1]);
				$leadid =			sprintf("%-12s", $row[2]);
				$leadidorig=$leadid;
				if ($row[2] > 0) 
					{
					$leadidLINK=$row[2];
					$leadlink++;
					if ( eregi("QUEUE",$row[4]) ) {$row[6]=$STARTtime;}
					//if($edit_message_all[0]=0){
					$leadid = "<a href=\"./remote_dispo.php?lead_id=$row[2]&call_began=$row[6]\" target=\"_blank\">$leadid</a>";
					//}					
					}
				$channel =			sprintf("%-10s", $row[3]);
					$cc=0;
				while ( (strlen($channel) > 10) and ($cc < 100) )
					{
					$channel = eregi_replace(".$","",$channel);   
					$cc++;
					if (strlen($channel) <= 10) {$cc=101;}
					}
				$status =			sprintf("%-6s", $row[4]);
				$start_time =		sprintf("%-19s", $row[5]);
				$call_time_S = ($STARTtime - $row[6]);

				$call_time_M = ($call_time_S / 60);
				$call_time_M = round($call_time_M, 2);
				$call_time_M_int = intval("$call_time_M");
				$call_time_SEC = ($call_time_M - $call_time_M_int);
				$call_time_SEC = ($call_time_SEC * 60);
				$call_time_SEC = round($call_time_SEC, 0);
				if ($call_time_SEC < 10) {$call_time_SEC = "0$call_time_SEC";}
				$call_time_MS = "$call_time_M_int:$call_time_SEC";
				$call_time_MS =		sprintf("%7s", $call_time_MS);
				$G = '';		$EG = '';
				if ($call_time_M_int >= 5) {$G='<SPAN class="yellow"><B>'; $EG='</B></SPAN>';}
				if ($call_time_M_int >= 10) {$G='<SPAN class="orange"><B>'; $EG='</B></SPAN>';}
				
				if (eregi("READY",$row[4])) {$status="就绪";}
				if (eregi("PAUSED",$row[4])) {$status="暂停";}
				if (eregi("QUEUE",$row[4])) {$status="排队";}
				if (eregi("INCALL",$row[4])) {$status="通话";}
				if ($leadidorig <>0){
					
					$stmtlead="select first_name,phone_number from vicidial_list where lead_id=".$leadidorig;
					mysql_query("set names 'utf8'");
					$rsltlead=mysql_query($stmtlead, $link);
					if ($DB) {echo "$stmtlead\n";}
					$leadnum = mysql_num_rows($rsltlead);
					if ($leadnum > 0) 
					{
						$j=0;
						$name="";
						$phone_number="";
						while ($j < $leadnum)
						{
								$leadrow=mysql_fetch_row($rsltlead);
								$name=$leadrow[0];
								$phone_number=$leadrow[1];
								$j++;
						} 
					}
				}
				echo "<tr>
				<td>$G$extension$EG </td>
				<td>$G$user$EG </td>
				<td > $G$leadid$EG</td>
				<td>$G$name$EG</td>
				<td>$G$phone_number$EG </td>
				<td>$G$channel$EG</td>
				<td>$G$status$EG </td>
				<td>$G$start_time$EG </td>
				<td>$G$call_time_MS$EG</td>
				</tr>\n";
				

				$i++;
				
				
             
				
				
				}

				
				echo "  $i 座席签入服务器 $server_ip\n\n";

				echo "  <SPAN class=\"yellow\"><B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</B></SPAN><B>- 通话时间超过5分钟</B>\n";
				echo "  <SPAN class=\"orange\"><B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</B></SPAN><B>- 通话时间超过10分钟</B>\n";





			}
			else
			{
			 echo "</TABLE></center>\n";
			 echo"<br>";
			echo "<br>********************************* 没有激活座席 *********************************\n";
			
			
			}
		}




}


$ENDtime = date("U");

$RUNtime = ($ENDtime - $STARTtime);

echo "\n\n\n<br><br><br>\n\n";


echo "\n<br>\n运行时间: $RUNtime 秒";


?>
</TD></TR><TABLE>
</body>
</html>
<?
exit; 
?>





 