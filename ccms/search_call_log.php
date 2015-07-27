<?
	//ini_set('display_errors','On');
	$nowIp = "";
	$suffix = "gsm";
	require("dbconnect_report.php");
	require("functions.php");
	require("function_util.php");
$stmt="SELECT ccms_url from system_settings";
$rslt=mysql_query($stmt, $link);
$row=mysql_fetch_row($rslt);

$ccms_url =				$row[0];
$PHP_AUTH_USER=$_SERVER['PHP_AUTH_USER'];
$PHP_AUTH_PW=$_SERVER['PHP_AUTH_PW'];


$PHP_SELF=$_SERVER['PHP_SELF'];
if (isset($_GET["query_date"]))				{$query_date=$_GET["query_date"];}
	elseif (isset($_POST["query_date"]))	{$query_date=$_POST["query_date"];}
if (isset($_GET["end_date"]))				{$end_date=$_GET["end_date"];}
	elseif (isset($_POST["end_date"]))		{$end_date=$_POST["end_date"];}
if (isset($_GET["group"]))					{$group=$_GET["group"];}
	elseif (isset($_POST["group"]))			{$group=$_POST["group"];}
if (isset($_GET["user_group"]))				{$user_group=$_GET["user_group"];}
	elseif (isset($_POST["user_group"]))	{$user_group=$_POST["user_group"];}
if (isset($_GET["shift"]))					{$shift=$_GET["shift"];}
	elseif (isset($_POST["shift"]))			{$shift=$_POST["shift"];}
if (isset($_GET["stage"]))					{$stage=$_GET["stage"];}
	elseif (isset($_POST["stage"]))			{$stage=$_POST["stage"];}
if (isset($_GET["duration"]))					{$duration=$_GET["duration"];}
	elseif (isset($_POST["duration"]))			{$duration=$_POST["duration"];}
if (isset($_GET["durationBS"]))					{$bs=$_GET["durationBS"];}
	elseif (isset($_POST["durationBS"]))			{$bs=$_POST["durationBS"];}
if (isset($_GET["file_download"]))			{$file_download=$_GET["file_download"];}
	elseif (isset($_POST["file_download"]))	{$file_download=$_POST["file_download"];}
if (isset($_GET["DB"]))						{$DB=$_GET["DB"];}
	elseif (isset($_POST["DB"]))			{$DB=$_POST["DB"];}
if (isset($_GET["submit"]))					{$submit=$_GET["submit"];}
	elseif (isset($_POST["submit"]))		{$submit=$_POST["submit"];}
if (isset($_GET["SUBMIT"]))					{$SUBMIT=$_GET["SUBMIT"];}
	elseif (isset($_POST["SUBMIT"]))		{$SUBMIT=$_POST["SUBMIT"];}
if (isset($_GET["call_log_status"]))					{$call_log_status=$_GET["call_log_status"];}
	elseif (isset($_POST["call_log_status"]))		{$call_log_status=$_POST["call_log_status"];}
if(!isset($call_log_status)){
	$call_log_status = 1;
}

# add by seven start
if($call_log_status==1){

if(!isset($_POST['direction'])){
	$_POST['direction'] = "Outbound";
}
if($_POST['direction']=="Outbound"){
    $search_view_name = "v_call_log_outbound_realtime";
}else if($_POST['direction']=="Inbound"){
    $search_view_name = "v_call_log_inbound_realtime";
}else{
    $search_view_name = "v_call_log_realtime";
} 
}else{
if(!isset($_POST['direction'])){
	$_POST['direction'] = "Outbound";
}
if($_POST['direction']=="Outbound"){
    $search_view_name = "v_call_log_outbound";
}else if($_POST['direction']=="Inbound"){
    $search_view_name = "v_call_log_inbound";
}else{
    $search_view_name = "v_call_log";
} 
}
# add by seven end


#Add by fnatic start
//$record_sec_start="";
//$record_sec_end="";
$status_all = getAllStatus();

if (isset($_GET["record_sec_start"]))   {$record_sec_start=$_GET["record_sec_start"];}
    elseif (isset($_POST["record_sec_start"])) { $record_sec_start=$_POST["record_sec_start"];}
if (isset($_GET["record_sec_end"]))   {$record_sec_end=$_GET["record_sec_end"];}
   elseif (isset($_POST["record_sec_end"])) { $record_sec_end=$_POST["record_sec_end"];}
#Add by fantic end

if (strlen($shift)<2) {$shift='ALL';}
if (strlen($stage)<2) {$stage='NAME';}

#############################################
##### START SYSTEM_SETTINGS LOOKUP #####
$stmt = "SELECT use_non_latin FROM system_settings;";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$qm_conf_ct = mysql_num_rows($rslt);
if ($qm_conf_ct > 0)
	{
	$row=mysql_fetch_row($rslt);
	$non_latin =					$row[0];
	}
##### END SETTINGS LOOKUP #####
###########################################

$PHP_AUTH_USER = ereg_replace("[^0-9a-zA-Z]","",$PHP_AUTH_USER);
$PHP_AUTH_PW = ereg_replace("[^0-9a-zA-Z]","",$PHP_AUTH_PW);

//$stmt="SELECT user_level,user_group,user_id,user from vicidial_users where user='$PHP_AUTH_USER' and pass='$PHP_AUTH_PW' and user_level >= 5 and view_reports='1';";
$stmt="SELECT user_level,user_group,user_id,user from vicidial_users where user='$PHP_AUTH_USER' and pass='$PHP_AUTH_PW' and user_level >= 5;";
if ($DB) {echo "|$stmt|\n";}
if ($non_latin > 0) { $rslt=mysql_query("SET NAMES 'UTF8'");}
$rslt=mysql_query($stmt, $link);
$row=mysql_fetch_row($rslt);

$auth=$row[0];
$usergroups = $row[1];
$user_id = $row[2];
$user_name = $row[3];
$level = $auth;


//echo	"db:".$REPORT_server.":".$REPORT_port.":".$REPORT_user.":".$REPORT_pass.":".$REPORT_database;


//echo "\nauth:".$PHP_AUTH_USER .":". $PHP_AUTH_USER.":".$auth;
//exit;

if( (strlen($PHP_AUTH_USER)<2) or (strlen($PHP_AUTH_PW)<2) or (!$auth))
	{
    Header("WWW-Authenticate: Basic realm=\"CCMS-PROJECTS\"");
    Header("HTTP/1.0 401 Unauthorized");
    echo "Invalid Username/Password: |$PHP_AUTH_USER|$PHP_AUTH_PW|\n";
    exit;
	}
	include("page.php");
	//print_r($_POST);
	//get data for phones////////////////////////////////
	$phone_sql = "select dialplan_number from phones ORDER BY -dialplan_number DESC";
	$phone_rs  = mysql_query($phone_sql,$link);
	$phones_list = array();
	while ($row=mysql_fetch_row($phone_rs))
	{
		$phones_list = array_merge($phones_list,$row);
	}
	$phones_list  = implode(',',$phones_list);
	//get data for in-group////////////////////////////////
	//$ingroup_sql = "select group_id from vicidial_inbound_groups";
	$ingroup_sql = getIngroupList_Access($level,$user_name);
	$ingroup_rs = mysql_query($ingroup_sql,$link);
	$ingroup_list = "";
	while ($row=mysql_fetch_row($ingroup_rs))
	{
		if($ingroup_list == ""){
			$ingroup_list = "'".$row[0]."'";
			//echo $ingroup_list;
		}else{
			$ingroup_list .= ",'".$row[0]."'";
		}
	}
	//get data for user-group/////////////////////////////
	//$group_sql = "select user_group from vicidial_user_groups";
	$group_sql = getUserGroupsList_Access($level,$user_name,1);
  
	$group_rs  = mysql_query($group_sql,$link);

	//get data for user-group/////////////////////////////
	/*comment by heibo 2011-4-22 11:47:20 统一函数
	$users_sql = "select user from vicidial_users";
	if($level<9){
		$users_sql = "select user from vicidial_users where user_level<=$level and user_group in (select distinct(user_group) from vicidial_user_groups where manager='" . $user_name . "' or supervisor='" . $user_name . "')";
	}
	*/
	$users_sql = getUsersList_Access($level,$user_name);

	$users_rs  = mysql_query($users_sql,$link);
	
	//get data for status/////////////////////////////
	//$status_sql = "select status,CONCAT('System-',status_name) from vicidial_statuses UNION select status,CONCAT('Campaign Id-',status_name) from vicidial_campaign_statuses";
	$status_sql = "select status,CONCAT('System-',status_name) from vicidial_statuses UNION select status,CONCAT(Campaign_id,'-',status_name) from vicidial_campaign_statuses";
	$status_rs = mysql_query($status_sql,$link);
	//date setting
	if (empty($searchdate1)){$searchdate1=date("d-m-Y");}
	if (empty($searchdate2)){$searchdate2=date("d-m-Y");}
	if(empty($searchstarthour)){$searchstarthour="00";}
	if(empty($searchstartminute)){$searchstartminute="00";}
	if(empty($searchstartsecond)){$searchstartsecond="00";}
	if(empty($searchendhour)){$searchendhour="23";}
	if(empty($searchendminute)){$searchendminute="59";}
	if(empty($searchendsecond)){$searchendsecond="59";}
	//$ingroup_list  = implode(',',$ingroup_list);
	//echo $ingroup_list;exit;
	//////////////////////search moude//////////////////////////
	if(!empty($_POST['searchlog'])){
		//print_r($_POST);
		if(!empty($_POST['selectedColumnsString'])){
			$phones = $_POST['selectedColumnsString'];
			$conditions .= " and extension in ($phones)";
			//echo $phones;
		}
		if(!empty($_POST['selectedColumnsString2'])){
			/*foreach(explode(',',$_POST['selectedColumnsString2']) as $items){
				if($sel_ingroup_list == ""){
					$sel_ingroup_list = "'".$items."'";
					//echo $ingroup_list;
				}else{
					$sel_ingroup_list .= ",'".$items."'";
				}
			}*/
			$conditions .= " and group_id in ({$_POST['selectedColumnsString2']})";
			//echo $conditions;
		}
		if($_POST['usergroup'] != 'All'){
			$conditions .= " and user_group = '{$_POST['usergroup']}'";
			//echo $conditions;
		}else{
			if($level<9){
				//$group_sql2 = "select user_group from vicidial_user_groups where manager='" . $user_name . "' or supervisor='" . $user_name . "'";
				$group_sql2= getUserGroupsList_Access($level,$user_name,1);
				$group_rs2 = mysql_query($group_sql2,$link);
				$group_arr = array();
				while ($row=mysql_fetch_row($group_rs2)){
					$group_arr[] = "'" . $row[0] . "'";
				}
				$conditions .=" and user_group in(" . implode(",",$group_arr) . ")";
			}
		}
		if($_POST['users'] != 'All'){
			$conditions .= " and user = '{$_POST['users']}'";
			//echo $conditions;
		}else{
			if($level<5){
				$user_arr = array();
				while($row=mysql_fetch_row($users_rs)){
					$user_arr[] = "'" . $row[0] . "'";
				}
				$conditions .=" and user in(" . implode(",",$user_arr) . ")";
			}
		}
		

		if($_POST['termreason'] != 'All'){
			$conditions .= " and term_reason = '{$_POST['termreason']}'";
			//echo $conditions;
		}
		
		if($_POST['status'] != 'All'){
			$conditions .= " and $search_view_name.status = '{$_POST['status']}'";
			//echo $conditions;
		}
		if($_POST['direction'] != 'All'){
			$conditions .= " and $search_view_name.direction = '{$_POST['direction']}'";
			//echo $conditions;
		}

		if(strlen($record_sec_start)>0)
		{
		   $conditions .= " and $search_view_name.length_in_sec >= ".$record_sec_start;
		   
		}

		if(strlen($record_sec_end)>0)
		{
		   //$conditions .= " and $search_view_name.incall_second <= ".$record_sec_end;
		   $conditions .= " and $search_view_name.length_in_sec <= ".$record_sec_end;
		   
		}

		$start_date_time = substr($_POST['searchText2'],6,4).'-'.substr($_POST['searchText2'],3,2).'-'.substr($_POST['searchText2'],0,2).' '.$_POST['searchstarthour'].':'.$_POST['searchstartminute'].':'.$_POST['searchstartsecond'];
		$end_date_time   = substr($_POST['searchText3'],6,4).'-'.substr($_POST['searchText3'],3,2).'-'.substr($_POST['searchText3'],0,2).' '.$_POST['searchendhour'].':'.$_POST['searchendminute'].':'.$_POST['searchendsecond'];
		$conditions .= " and (start_time  >= '$start_date_time' and start_time <= '$end_date_time')";
		///if(isset($duration) && $duration !=''){
			//$bss = ">=";
			//if($_POST['durationBS'] == 's'){
				//$bss = "<=";
			//}
			//$conditions .=" and (length_in_sec " . $bss . " '$duration' and length_in_sec is not null)";	
		//}
		//echo $conditions;
		$searchdate1=$_POST['searchText2'];
		$searchdate2=$_POST['searchText3'];
		$searchstarthour=$_POST['searchstarthour'];
		$searchstartminute=$_POST['searchstartminute'];
		$searchstartsecond=$_POST['searchstartsecond'];
		$searchendhour=$_POST['searchendhour'];
		$searchendminute=$_POST['searchendminute'];
		$searchendsecond=$_POST['searchendsecond'];
		$searchsortby   = $_POST['sortby'];
		
		$_POST['cunstomerphone'] = trim($_POST['cunstomerphone']);
		if(!empty($_POST['cunstomerphone'])){
			if($_POST['direction']=="Outbound"){
				$conditions .= " and ( phone_number = '{$_POST['cunstomerphone']}')";
			}else{
				$conditions .= " and ( number_dialed like '%{$_POST['cunstomerphone']}' or caller_code = '{$_POST['cunstomerphone']}')";
			}
			
			//$conditions .= " and ( number_dialed = concat(B.dial_prefix,'{$_POST['cunstomerphone']}') or caller_code = '{$_POST['cunstomerphone']}' or phone_number = '{$_POST['cunstomerphone']}')";
		}
		$conditions .= " order by {$_POST['sortby']} desc";
		//echo $conditions;
		if(!empty($selectedPhones)){
			//$selectedPhones = 
		}

		if (isset($_GET["pagesize"]))					{$pagesize=$_GET["pagesize"];}
		elseif (isset($_POST["pagesize"]))			{$pagesize=$_POST["pagesize"];}
		else										{$pagesize=20;}
		$rs = mysql_query("select count(*) as dd from $search_view_name where 1 = 1 ".$conditions);
		$row = mysql_fetch_array($rs,$link);
		$count = $row["dd"];
		$total_record=get_total_page($count,$pagesize);

	}

  $did_number = array();
  $did_sql = "select inline,hotline from inbound_number";
	$did_rs  = mysql_query($did_sql,$link);
	while( $row = mysql_fetch_assoc($did_rs) ){
		    $did_number[$row["inline"]][] = $row["hotline"];
  }   
  

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <title>CCMS ADMINISTRATION: search call log</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <link rel="stylesheet" type="text/css" href="index.files/style.css" />
    <script language="JavaScript" type="text/javascript" src="js/general.js"></script>
    <script src="js/mootools.js" type="text/javascript"></script>
    <script src="js/moodx.js" type="text/javascript"></script>
    <script language="JavaScript" src="js/datefunctions.js"></script>
<style type="text/css">
<!--
.STYLERED {
	font-size: small;
	color: #FF0000;
	font-family: "";
}
html{overflow-x:hidden;}
-->
</style>
</head>
<body bgcolor="#ffffff">   				
<script>
function checkPageSize(){
	
	var pg = document.getElementById("pagesize_txt");
	if(isNaN(pg.value)){
		alert("The Page Size field should be a number!");
		pg.value='';
		pg.focus();
	}else{
		if(pg.value > 1000){
			alert("The number you input can't over 1000!");
			document.getElementById("pagesize_txt").value = document.getElementById("pagesize").value;
		}else{
			document.getElementById("pagesize").value = pg.value;
			document.newGroupForm.log_submit.click();
		}
		
	}
}
</script>
<!-- server -->
<!--   #search_call_log导航栏#
<TABLE width="100%" CELLPADDING=0 CELLSPACING=0 BGCOLOR="#015B91">
    <TR>
      <TD width="78"><IMG SRC="images/vicidial_admin_web_logo_small.gif"></TD>
      <TD width="75">&nbsp; <A HREF="admin.php" ALT="Users"><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B>Users</B></A> &nbsp; </TD>
      <TD width="104">&nbsp; <A HREF="admin.php?ADD=10" ALT="Campaigns"><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B>Campaigns</B></A> &nbsp; </TD>
      <TD width="63">&nbsp; <A HREF="admin.php?ADD=100" ALT="Lists"><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B>Lists</B></A> &nbsp; </TD>
      <TD width="76">&nbsp; <A HREF="admin.php?ADD=1000000" ALT="Scripts"><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B>Scripts</B></A> &nbsp; </TD>
      <TD width="73">&nbsp; <A HREF="admin.php?ADD=10000000" ALT="Filters"><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B>Filters</B></A> &nbsp; </TD>
      <TD width="98">&nbsp; <A HREF="admin.php?ADD=1000" ALT="In-Groups"><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B>In-Groups</B></A> &nbsp; </TD>
      <TD width="115">&nbsp; <A HREF="admin.php?ADD=100000" ALT="User Groups"><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B>User Groups</B></A> &nbsp; </TD>
      <TD width="103">&nbsp; <A HREF="admin.php?ADD=10000" ALT="Remote Agents"><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B>Remote ents</B></A></TD>
      <TD width="73">&nbsp; <A HREF="admin.php?ADD=10000000000" ALT="Admin"><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B>Admin</B></A> &nbsp; </TD>
      <TD width="90">&nbsp; <A HREF="admin.php?ADD=999999" ALT="Reports"><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B>Reports</B></A> &nbsp; </TD>
    </TR>
</TABLE>
-->
<!-- recent documents -->


<!--<div class="sectionHeader" class="c"><b  class="small cellLabel3">Query Condition</b> </div>--><!--<div class="sectionBody" id="lyr1">-->
<form action='' name="newGroupForm" method='POST' style="background-color:#ffffff">
<input type="hidden" name="page" id="page"  value="1">
<input type="hidden" name="searchlog"  value="1">
<table border=0 cellpadding=2 cellspacing=0 width="100%" bgcolor="#fffff">
  <tr class=tr_bg_color>
    <td height="20" colspan="4"><font size="1" color="white"><b>QUERY CONDITION</b></font></td>
  </tr>
  <tr bgcolor='#c2c2c2'>
    <td valign="top"  colspan="2">Phones:</td>
    <td valign="top"  colspan="2">In-Groups:</td>
<!--    <td>&nbsp;</td>
    <td>&nbsp;</td>-->
  </tr>
  <tr bgcolor="#ffffff">
    <td colspan="2">
		<table width="100%">
			<tr>                          
			  <td class="small cellLabel3"><br>
				<select id="availList" name="availList" size=6 multiple style="border:1px solid #737373;width:150px;"></select>
				<input type="hidden" name="selectedColumnsString" id="selectedColumnsString" value="<? if(!empty($_POST['selectedColumnsString'])) echo $phones ?>"/>			  </td>
				<td width="20">&nbsp;
				<input type="button" name="Button" value="&nbsp;&rsaquo;&rsaquo;&nbsp;" onClick="setObjects('phone');addColumn()" class="crmButton small"/><br /><br />&nbsp;
                <input type="button" name="Button1" value="&nbsp;&lsaquo;&lsaquo;&nbsp;" onClick="setObjects('phone');delColumn()" class="crmButton small"/>			  </td>
				<td  class="small cellLabel3">Phones of Selected<br>
				<select id="selectedColumns" name="selectedColumns[]"  size=6 multiple style="border:1px solid #cccccc;width:150px;">
<?php
	if(!empty($_POST['selectedColumnsString'])){
	foreach(explode(',',str_replace ("'","",$_POST['selectedColumnsString'])) as $items){	
?>
				<option value="<?= $items ?>"><?= $items ?></option>
<?	}} ?>
				</select>				</td>
			</tr>
		</table>    </td>
    <td colspan="2">
    	<table width="100%">
        	<tr>                          
       		  <td class="small cellLabel3">Inbound Only<br>
            	<select id="availList2" name="availList2" size=6 multiple style="border:1px solid #737373;width:150px;"></select>
            	<input type="hidden" name="pagesize" id="pagesize" value="<? if(isset($pagesize)){echo $pagesize;}else{echo '200';} ?>"/> 
            	<input type="hidden" name="selectedColumnsString2" id="selectedColumnsString2" value="<? if(!empty($_POST['selectedColumnsString2'])) echo $_POST['selectedColumnsString2']?>"/>           	  </td>
            	<td width="20">&nbsp;<input type="button" name="Button" value="&nbsp;&rsaquo;&rsaquo;&nbsp;" onClick="setObjects('in-group');addColumn()" class="crmButton small"/><br /><br/>		         	    &nbsp;
                <input type="button" name="Button1" value="&nbsp;&lsaquo;&lsaquo;&nbsp;" onClick="setObjects('in-group');delColumn()" class="crmButton small"/></td>
            	<td class="small cellLabel3">In-Groups of Selected<br>
            	<select id="selectedColumns2" name="selectedColumns2[]"  size=6 multiple style="border:1px solid #cccccc;width:150px;">
<?php
	if(!empty($_POST['selectedColumnsString2'])){
	foreach(explode(',',str_replace ("'","",$_POST['selectedColumnsString2'])) as $items){	
?>
				<option value="<?= $items ?>"><?= $items ?></option>
<?php	}} ?>
				</select>           		</td>
			</tr>
		</table>    </td>
<!--    <td>&nbsp;</td>
    <td>&nbsp;</td>-->
  </tr>
  <tr bgcolor='#c2c2c2'>
    <td class="small cellLabel3" align="left">User Group:</td>
    <td class="small cellLabel3" align="left">
    <select name="usergroup" size="1" class="importBox small" id="usergroup" onchange="" style="width:200px">

	<option value="All">[All]</option>
<?php
	while($row=mysql_fetch_row($group_rs))
	{
?>
	<option value="<?= $row[0] ?>" <? if ($row[0]==$_POST['usergroup']){echo " selected";}?>><?= $row[0] ?></option>
<?php
	}
?>
	</select>    </td>
    <td class="small cellLabel3" align="left">User:</td>
    <td class="small cellLabel3" align="left">
    <select name="users" size="1" class="importBox small" id="users" onchange="" style="width:280px">
    <option value="All">[All]</option>
<?php
	$users_rs = mysql_query($users_sql,$link);
	while($row=mysql_fetch_row($users_rs)){ 
?>
	<option value="<?= $row[0] ?>" <? if ($row[0]==$_POST['users']){echo " selected";}?>><?= $row[1] ?></option>
<?php } ?>
	</select>    </td>
  </tr>
  <tr bgcolor='#ffffff'>
    <td class="small cellLabel3" align="left">Direction:</td>
	<td class="small cellLabel3" align="left">
    <select name="direction" size="1" class="importBox small" id="direction" onchange="" style="width:200px">
	<option value="Inbound" <? if ("Inbound"==$_POST['direction']){echo " selected";}?>>Inbound</option>
	<option value="Outbound" <? if ("Outbound"==$_POST['direction']){echo " selected";}?>>Outbound</option>
        <option value="All" <? if ("All"==$_POST['direction']){echo " selected";}?>>All</option>
	</select>    </td>
    <td class="small cellLabel3" align="left">Status:</td>
	<td class="small cellLabel3" align="left">
	<select name="status" size="1" class="importBox small" id="status" style="width:280px" onchange="" onmouseoverxxx="FixWidth(this)">
	<option value="All">[All]</option>
<?php
	while($row=mysql_fetch_row($status_rs)){ ?>
	<option value="<?= $row[0] ?>" <? if ($row[0]==$_POST['status']){echo " selected";}?>><?= $row[1] ?></option>
	<?php } ?>
	</select>    </td> 
  </tr>

  <tr bgcolor='#c2c2c2'>
    <td class="small cellLabel3" align="left" nowrap="nowrap">Call Start Time From:</td>
    <td class="small cellLabel3" align="left"> 
	<input type=hidden name='searchText2' id='searchText2' class="inputbox" style="width:100px" value="<?= $searchdate1 ?>">
	<span id="datefrom_show" stylexxx="font-weight: bold;"><?= $searchdate1 ?></span>
	<a href="javascript:cal1.popup();" onMouseover="window.status='Select a date'; return true;" onMouseout="window.status=''; return true;"><img src="images/icons/cal.gif" width="16" height="16" border="0" align="absimddle"></a>&nbsp;&nbsp;
	<input type="text" class="inputtext" name="searchstarthour" id ="searchstarthour" maxlength=2 value="<?= $searchstarthour ?>" style="font-family: Arial, Helvetica, sans-serif;font-size: 11px;color: #000000;border:0px #solid#bababa;padding-left:0px;	width:20px;background-color:#ffffff;">:
	<input type="text" class="inputtext" name="searchstartminute" id ="searchstartminute" maxlength=2 value="<?= $searchstartminute ?>" style="font-family: Arial, Helvetica, sans-serif;font-size: 11px;color: #000000;border:0px #solid#bababa;padding-left:0px;	width:20px;background-color:#ffffff;">:
    <input type="text" class="inputtext" name="searchstartsecond" id ="searchstartsecond" maxlength=2 value="<?= $searchstartsecond ?>" style="font-family: Arial, Helvetica, sans-serif;font-size: 11px;color: #000000;border:0px #solid#bababa;padding-left:0px;	width:20px;background-color:#ffffff;"></td>
	<td class="small cellLabel3" align="left" nowrap="nowrap">Call Start Time To:</td>
    <td class="small cellLabel3" align="left">
	<input type=hidden class="inputtext" name='searchText3' id='searchText3' style="width:100px" value="<?= $searchdate2 ?>">
    <span id="dateto_show" stylexxx="font-weight: bold;"><?= $searchdate2 ?></span>
	<a href="javascript:cal2.popup();" onMouseover="window.status='Select a date'; return true;" onMouseout="window.status=''; return true;"><img src="images/icons/cal.gif" width="16" height="16" border="0" align="absimddle"></a>
	<input type="text" class="inputtext" name="searchendhour" id ="searchendhour" maxlength=2 value="<?= $searchendhour ?>" style="font-family: Arial, Helvetica, sans-serif;font-size: 11px;color: #000000;border:0px#solid; #bababa;padding-left:0px;	width:20px;background-color:#ffffff;">:
	<input type="text" class="inputtext" name="searchendminute" id ="searchendminute" maxlength=2 value="<?= $searchendminute ?>" style="font-family: Arial, Helvetica, sans-serif;font-size: 11px;color: #000000;border:0px #solid#bababa;padding-left:0px;	width:20px;background-color:#ffffff;">:
    <input type="text" class="inputtext" name="searchendsecond" id ="searchendsecond" maxlength=2 value="<?= $searchendsecond ?>" style="font-family: Arial, Helvetica, sans-serif;font-size: 11px;color: #000000;border:0px #solid#bababa;padding-left:0px;	width:20px;background-color:#ffffff;">	</td>
  </tr>
  <tr bgcolor='#ffffff'>
    <td class="small cellLabel3" align="left">Customer Phone:</td>
    <td class="small cellLabel3" align="left">
    <input type=text name='cunstomerphone' id='cunstomerphone' class="inputtext" style="width:196px" value="<?= trim($_POST['cunstomerphone']) ?>" maxlength="20" onblur="checkPhone();"/></td>
	<td align="left" class="small cellLabel3">Call Time:</td>
	<td align="left" class="small cellLabel3">From:&nbsp;
        <input type="text" class="inputtext" name="record_sec_start" size="1" maxlength="4" value="<?php echo $record_sec_start;?>" style="width:80px">
	  &nbsp;&nbsp;&nbsp;&nbsp;To:&nbsp;
	  <input type="text" class="inputtext" name="record_sec_end" size="1" maxlength="4" value="<?php echo $record_sec_end;?>" style="width:80px"/>
	</td>
  </tr>
  <tr bgcolor='#c2c2c2'>
    <td class="small cellLabel3"  align="left">Sort By:</td>
    <td class="small cellLabel3"  align="left"><select name="sortby" style="width:200px">
	<option value="start_time" <? if ($searchsortby == "start_time") { echo "selected"; } ?> >Call Start Time</option>
	<option value="caller_code" <? if ($searchsortby == "caller_code") { echo "selected"; } ?> >Call FROM</option>
	<option value="number_dialed" <? if ($searchsortby == "number_dialed") { echo "selected"; } ?> >Call TO</option>
	</select>    </td>
	<td class="small cellLabel3" align="left">Term Reason:</td>
	<td class="small cellLabel3" align="left">
		<select name="termreason" size="1" class="importBox small" id="termreason" onchange="" style="width:128px">
		<option value="All">[All]</option>
		<option value="AGENT" <?if ("AGENT"==$_POST['termreason']){echo " selected";}?>>AGENT</option>
		<option value="CALLER" <?if ("CALLER"==$_POST['termreason']){echo " selected";}?>>CALLER</option>
		<option value="ABANDON" <?if ("ABANDON"==$_POST['termreason']){echo " selected";}?>>ABANDON</option>
		<option value="QUEUETIMEOUT" <?if ("QUEUETIMEOUT"==$_POST['termreason']){echo " selected";}?>>QUEUETIMEOUT</option>
		<option value="NOAGENT" <?if ("NOAGENT"==$_POST['termreason']){echo " selected";}?>>NOAGENT</option>
		</select>
	</td>
  </tr>
  <tr bgcolor='#ffffff'>
    <td class="small cellLabel3"  align="left"><input name="call_log_status" type="radio" id="call_log_status" value="1" <?php if($call_log_status==1){echo "checked=\"checked\"";} ?> onclick="changeSearchDate()"/><font color="red">Real-Time Call Log (Today Only)</td>
    <td class="small cellLabel3"  align="left">&nbsp;</td>
	<td class="small cellLabel3" align="left"><input name="call_log_status" type="radio" id="call_log_status" value="0" <?php if($call_log_status!=1){echo "checked=\"checked\"";} ?> onclick="changeSearchDate();"/><font color="red">Historical Call Log (Before Today)</td>
	<td class="small cellLabel3" align="left">&nbsp;</td>
  </tr>
  <tr bgcolor='#ffffff'>
    <td colspan=4 align=right>
<?php
	if($errmsg=="")
	{
?>
		<input type="button" class="inputsubmit" name="add" value="SEARCH" onclick="checkdate();">
<!--		<input type="button" class="crmButton cancel small" name="cancel" value="Cancel" onClick="change2();">-->
<?php
	}
	else
	{
  		echo $errmsg;
	}
?>
		<input type='submit' name='log_submit' value='Search logs' style="display:none">    </td>
<!--    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>-->
  </tr>
</table>

<!--</div>-->

<!-- database -->
<!--<div class="sectionHeader"><b class="small cellLabel3">Query results</b></div>--><!--<div class="sectionBody" id="lyr4">-->
<!--		<p class="small cellLabel3" style="background-color:#ffffff">report date from : <?= $start_date_time ?> to : <?= $end_date_time ?>     Search Time:<?= date("Y-m-d H:i:s") ?><p /> -->

		<table border="0" cellpadding="1" cellspacing="1" bgcolor="#707070" width="100%" >
		<thead>
         <tr class=tr_bg_color>
    	 	<td colspan="13" height="20"><font size="1" color="white"><b>QUERY RESULTS</b></font></td>
  		 </tr>
		 <tr bgcolor='#c2c2c2'>
	  <!-- <td width="120"><b>Call ID</b></td> -->
		   <td width="57" align="center" style="word-wrap:break-word; width:57px"><b>User Group</b></td>
		   <td width="57" align="center" style="word-wrap:break-word; width:57px"><b>User</b></td>
		   <td width="64" align="center" style="word-wrap:break-word; width:64px"><b>Phone</b></td>
		   <td width="57" align="center" style="word-wrap:break-word; width:57px"><b>In-Group</b></td>
		   <td width="70" align="center" style="word-wrap:break-word; width:70px"><b>Direction</b></td>
		   <td width="57" align="center" style="word-wrap:break-word; width:57px"><b>Call Start Time</b></td>
		   <td width="57" align="center" style="word-wrap:break-word; width:57px"><b>Call End Time</b></td>		   
		   <td width="57" align="center" style="word-wrap:break-word; width:57px"><b>From</b></td>
		   <td width="57" align="center" style="word-wrap:break-word; width:57px"><b>To</b></td>
		   <td width="55" align="center" style="word-wrap:break-word; width:55px"><b>Status</b></td>
	     <td width="58" align="center" style="word-wrap:break-word;"><b>Call Time</b></td>
		   <td width="56" align="center" style="word-wrap:break-word; width:60px"><b>Term Reason</b></td>
		   <td width="70" align="right" style="word-wrap:break-word; width:70px"><b>Download</b></td>
		  </tr>
		  </thead>
		  <tbody>
		  <?php
 
         //$stmt="select caller_code,uniqueid,extension,number_dialed,user_group,user,group_id,direction,start_time,end_time,phone_number,caller_account,term_reason,status,sec_to_time($search_view_name.length_in_sec) as call_time from $search_view_name where 1 = 1".$conditions.' '.get_limit($pagesize);
         if($_POST['direction']=="Outbound"){
			 //$stmt="select caller_code,uniqueid,extension,number_dialed,user_group,user,group_id,direction,start_time,end_time,phone_number,caller_account,term_reason,status,sec_to_time($search_view_name.length_in_sec) as call_time from $search_view_name left join vicidial_campaigns B on $search_view_name.campaign_id = B.campaign_id where 1 = 1".$conditions.' '.get_limit($pagesize);
			 $stmt="select caller_code,uniqueid,extension,number_dialed,user_group,user,group_id,direction,start_time,end_time,phone_number,caller_account,term_reason,status,sec_to_time($search_view_name.call_seconds) as call_time from $search_view_name left join vicidial_campaigns B on $search_view_name.campaign_id = B.campaign_id where 1 = 1".$conditions.' '.get_limit($pagesize);
		 }else{
			 $stmt = "select caller_code,uniqueid,";
			 $stmt = $stmt . " case when $search_view_name.campaign_id is not NULL and direction='Outbound' and left(extension,length(B.dial_prefix))= B.dial_prefix and length(extension)>8 then substring(extension,(length(B.dial_prefix) + 1))    else extension end as extension,";
			 $stmt = $stmt . " case when $search_view_name.campaign_id is not NULL and direction='Outbound' and left(number_dialed,length(B.dial_prefix))= B.dial_prefix and length(number_dialed)>8 then substring(number_dialed,(length(B.dial_prefix) + 1) )    else number_dialed end as number_dialed,";
			 $stmt = $stmt . " user_group,user,group_id,direction,start_time,end_time,phone_number,caller_account,term_reason,status,sec_to_time($search_view_name.length_in_sec) as call_time,did from $search_view_name left join vicidial_campaigns B on  $search_view_name.campaign_id = B.campaign_id ";
			 $stmt = $stmt . " where 1 = 1".$conditions.' '.get_limit($pagesize);
		 }
				//echo $stmt;

				$rslt=mysql_query($stmt, $link);

				while ($row=mysql_fetch_array($rslt))
				{  
				if(strpos($row['caller_code'],"->") != false){
					$display_direction = "XFER";
				}
				else $display_direction = $row['direction'];
					//var_dump($row);
			     if(substr($row['extension'],0,3)=="727" && strlen($row['extension']) >= 9 )
				   {
				     $row['extension'] = "9".substr($row['extension'],3,strlen($row['extension']));
				   }
				 if(substr($row['number_dialed'],0,3)=="727" && strlen($row['number_dialed']) >= 9 )
				   {
					 $row['number_dialed'] = "9".substr($row['number_dialed'],3,strlen($row['number_dialed']));
				   }
		 ?>          
          <tr  bgcolor="#ffffff" align="left"  style="cursor:default" onmousemove="javascript:this.style.background='#cccccc'" onmouseout="javascript:this.style.background='#ffffff'">
		  <td align="left" style="word-wrap:break-word; width:57px"><?= $row['user_group']?></td>
		  <td align="left" style="word-wrap:break-word; width:57px"><?= $row['user']?></td>
		  <td align="left" style="word-wrap:break-word; width:64px"><?= $row['extension']?></td>
		  <td align="left" style="word-wrap:break-word; width:57px"><?= $row['group_id'] ?></td>
		  <td align="left" style="word-wrap:break-word; width:70px"><?= $display_direction?></td>
		  <td align="left" style="word-wrap:break-word; width:57px"><?= $row['start_time']?></td>
		  <td align="left" style="word-wrap:break-word; width:57px"><?= $row['end_time'] ?></td>	
          <td align="left" style="word-wrap:break-word; width:57px">
		   <?= $row['caller_code'] 
		//	if($row['direction']=='Inbound') {echo $row['phone_number'];} else {echo $row['caller_account'];} 
		  
		     ?>
		  </td>

		  <td align="left" style="word-wrap:break-word; width:57px">
		  <?
			  //= $row['number_dialed'] 
			  if($row['direction']=='Outbound' && $display_direction != 'XFER') {
			  	echo $row['phone_number'];
			  } else {
			  	if ( $row['direction']=='Inbound' ){
			  		   if ( array_key_exists($row['did'],$did_number) ){
			  		   	    echo implode(",",$did_number[$row['did']]);
			  		   }else{
			  		   	    echo $row['did'];
			  		 	 }
			  		   
			    }else{
			    	   echo $row['number_dialed'];
			  	} 
			    
			  } 
		  ?>
		  </td>
		  <td align="left" style="word-wrap:break-word; width:55px">
		  <?php
			if($status_all[$row['status']]==""){
				echo $row['status'];
			}else{
				echo $status_all[$row['status']];
			}
		  ?>
		  </td>
		  <td align="right" style="word-wrap:break-word;">
		  <? 
			  //echo $row['call_time']; 
			  //echo time_diff($row['start_time'],$row['end_time']);
			  if( $row['direction']=='Outbound' ) { echo $row['call_time'];  } else { echo time_diff($row['start_time'],$row['end_time']); };
		    //echo $row['incall_second']; 
		  ?></p></td>
		  <td align="left"><?= $row['term_reason'] ?></td>
		  <td align="right">
		  <a href='<? echo $ccms_url ?>Download.php?status=<?= $call_log_status ?>&uniqueid=<?= $row['uniqueid'] ?>&phone2=<?= $row['phone_number'] ?>&phone=<?= trim($_POST['cunstomerphone']) ?>&direction=<?= $row['direction']?>&user=<?= $row['user']?>' target='_blank'>DownLoad</a>
		  </td>
		  </tr>
         <?php } ?>
		  <tr bgcolor='#c2c2c2'>
			<td valign="top" ><b>Totals:</b></td>
			<td colspan="12">
			<b>
			<?php
			    echo $count;
		   ?>&nbsp; 
		  </b></td>
		  </tr>
		  </tbody>
		</table>
     </form>
		<div style="text-align:right; background-color:#ffffff">
		<?
			$pageurl="search_call_log.php";

			
			echo get_page_list($pageurl,$count,$pagesize,5);

			
        ?>
        <b>Page Size:</b><input type=text id='pagesize_txt' name='pagesize_txt' class="inputbox" style="width:20px" value="<? if(isset($pagesize)){echo $pagesize;}else{echo "200";} ?>" maxlength="10" onblur="checkPageSize();">
		</div> 
		</form>
<!--</div>-->
<script language="javascript">
var phoneIdArr=new Array(<?= $phones_list ?>);
var phoneNameArr=new Array(<?= $phones_list ?>);
var groupIdArr=new Array(<?= $ingroup_list ?>);
var groupNameArr=new Array(<?= $ingroup_list ?>);
function showOptions()
{
		constructSelectOptions('phone',phoneIdArr,phoneNameArr);
		constructSelectOptions('in-group',groupIdArr,groupNameArr);
}

function constructSelectOptions(selectedType,idArr,nameArr)
{
	constructedOptionValue = idArr;
	constructedOptionName = nameArr;
	for(j=0;j<constructedOptionName.length;j++)
	{
		var nowName = constructedOptionName[j];
		var nowId = constructedOptionValue[j];
		if(selectedType == 'phone'){
			document.forms['newGroupForm'].availList.options[j] = new Option(nowName,nowId);
		}
		if(selectedType == 'in-group'){
			document.forms['newGroupForm'].availList2.options[j] = new Option(nowName,nowId);
		}
	}
}
var moveupLinkObj,moveupDisabledObj,movedownLinkObj,movedownDisabledObj,nowtype;
function setObjects(searchtype) 
{
	if(searchtype == 'phone'){
		nowtype = 'phone';
		availListObj=document.forms['newGroupForm'].availList;
		selectedColumnsObj=document.forms['newGroupForm'].selectedColumns;
	}
	if(searchtype == 'in-group'){
		nowtype = 'in-group';
		availListObj=document.forms['newGroupForm'].availList2;
		selectedColumnsObj=document.forms['newGroupForm'].selectedColumns2;
	}
}

function addColumn() 
{
    //alert(selectedColumnsObj.length);   	
    for (i=0;i<selectedColumnsObj.length;i++) 
    {
		 //alert(selectedColumnsObj.length);
         selectedColumnsObj.options[i].selected=false
    }

   for (i=0;i<availListObj.length;i++) 
   {
   		
       if (availListObj.options[i].selected==true) 
       {    
	   		//alert(availListObj.length)   	
			var rowFound=false;
			var existingObj=null;
			for (j=0;j<selectedColumnsObj.length;j++) 
			{
				//alert(selectedColumnsObj.length);
				if (selectedColumnsObj.options[j].value==availListObj.options[i].value) 
				{
					rowFound=true
					existingObj=selectedColumnsObj.options[j]
					break
				}
			}
			
			if (rowFound!=true) 
			{
				var newColObj=document.createElement("OPTION")
                        newColObj.value=availListObj.options[i].value
                        if (browser_ie) newColObj.innerText=availListObj.options[i].innerText
                        else if (browser_nn4 || browser_nn6) newColObj.text=availListObj.options[i].text
                        selectedColumnsObj.appendChild(newColObj)
                        availListObj.options[i].selected=false
                        newColObj.selected=true
                        rowFound=false
			} 
			else 
			{
				if(existingObj != null) existingObj.selected=true
			}
		
		}
	}
formSelectColumnString();
}


function delColumn() 
{
	for (i=selectedColumnsObj.options.length;i>0;i--) 
	{
		if (selectedColumnsObj.options.selectedIndex>=0)
		selectedColumnsObj.remove(selectedColumnsObj.options.selectedIndex)
	}
	formSelectColumnString();
}


//setObjects();
showOptions();
function formSelectColumnString()
{
	var selectedColStr = "";
	for (i=0;i<selectedColumnsObj.options.length;i++) 
	{
		if(selectedColStr == ""){
			selectedColStr = "'"+selectedColumnsObj.options[i].value+"'";
		}else{
			selectedColStr += ",'"+selectedColumnsObj.options[i].value+"'";
		}
	
	}
	
	if(nowtype == 'phone'){
		//alert(selectedColStr);
		document.getElementById('selectedColumnsString').value = selectedColStr;
	}
	if(nowtype == 'in-group'){
		//alert(selectedColStr);
		document.getElementById('selectedColumnsString2').value = selectedColStr;
	}
	//alert(document.getElementById('selectedColumnsString').value);
}

				
function submit_link(now_page){

	document.getElementById("page").value = now_page;
	document.forms['newGroupForm'].submit();
  }

</script>
<script language="javascript">       
    var cal1 = new calendar1(document.forms['newGroupForm'].elements['searchText2'], document.getElementById("datefrom_show"));
    cal1.path="/ccms/js/";
    cal1.year_scroll = true;
    cal1.time_comp = false;

    var cal2 = new calendar1(document.forms['newGroupForm'].elements['searchText3'], document.getElementById("dateto_show"));
    cal2.path="/ccms/js/";
    cal1.year_scroll = true;
    cal1.time_comp = false;
  <!--       
    
  function toppage()         
  {                                                       
	  if     (self.location!=top.location)       
	  {       
			parent.document.all(self.name).height=document.body.scrollHeight;       
	  }        
  }       
 
--> 
    
</script>
<script type="text/javascript">
function checkPhone(){
	var obj = document.getElementById("cunstomerphone");
	if(isNaN(obj.value)){
		alert("请输入数字！");
		document.getElementById("cunstomerphone").value="";
	}
}
function FixWidth(selectObj)
{
    var newSelectObj = document.createElement("select");
    newSelectObj = selectObj.cloneNode(true);
    newSelectObj.selectedIndex = selectObj.selectedIndex;
    newSelectObj.onmouseover = null;
    
    var e = selectObj;
    var absTop = e.offsetTop;
    var absLeft = e.offsetLeft;
    while(e = e.offsetParent)
    {
        absTop += e.offsetTop;
        absLeft += e.offsetLeft;
    }
    with (newSelectObj.style)
    {
        position = "absolute";
        top = absTop + "px";
        left = absLeft + "px";
        width = "auto";
    }
    
    var rollback = function(){ RollbackWidth(selectObj, newSelectObj); };
    if(window.addEventListener)
    {
        newSelectObj.addEventListener("blur", rollback, false);
        newSelectObj.addEventListener("change", rollback, false);
    }
    else
    {
        newSelectObj.attachEvent("onblur", rollback);
        newSelectObj.attachEvent("onchange", rollback);
    }
    
    selectObj.style.visibility = "hidden";
    document.body.appendChild(newSelectObj);
    newSelectObj.focus();
}

function RollbackWidth(selectObj, newSelectObj)
{
    selectObj.selectedIndex = newSelectObj.selectedIndex;
    selectObj.style.visibility = "visible";
    document.body.removeChild(newSelectObj);
}
function checkdate(){
	//取消了日期限制1777
	/*
	var from = document.getElementById("datefrom_show").innerHTML.split("-");
	var date_from = new Date(from[2],from[1],from[0]);
	var to = document.getElementById("dateto_show").innerHTML.split("-");
	var date_to = new Date(to[2],to[1],to[0]);
	var diff = Math.floor((date_to.getTime() - date_from.getTime()) / (1000*60*60*24));
	if(diff > 31){
		alert("只允许搜索一个月内的记录！");
		return false;
	}else{
		document.newGroupForm.log_submit.click();
	}
	*/
	document.newGroupForm.log_submit.click();
}
function changeSearchDate(){
	var elm=document.getElementsByName('call_log_status');
	var num = 1;
	for(ii=0;ii<elm.length;ii++)
	{
		if(elm[ii].checked){
			num = elm[ii].value;
		}
	}
	
	var today = new Date();
	var year = today.getFullYear();
	var month = today.getMonth() + 1;
	var day = today.getDate();
	var today_str = (day> 9?day:( "0"+day))+ "-" + (month> 9?month:( "0"+month)) + "-"+ year;

	var yesterday = new Date();
	yesterday.setDate(yesterday.getDate()-1);
	year = yesterday.getFullYear();
	var month = yesterday.getMonth() + 1;
	var day = yesterday.getDate();
	var yesterday_str = (day> 9?day:( "0"+day))+ "-" + (month> 9?month:( "0"+month)) + "-"+ year;
	
	
	if(num == 1){
		document.getElementById("datefrom_show").innerHTML = today_str;
		document.getElementById('searchText2').value = today_str;
		document.getElementById("searchstarthour").value = "00";
		document.getElementById("searchstartminute").value = "00";
		document.getElementById("searchstartsecond").value = "00";

		document.getElementById("dateto_show").innerHTML = today_str;
		document.getElementById('searchText3').value = today_str;
		document.getElementById("searchendhour").value = "23";
		document.getElementById("searchendminute").value = "59";
		document.getElementById("searchendsecond").value = "59";
	}else{
		document.getElementById("datefrom_show").innerHTML = yesterday_str;
		document.getElementById('searchText2').value = yesterday_str;
		document.getElementById("searchstarthour").value = "00";
		document.getElementById("searchstartminute").value = "00";
		document.getElementById("searchstartsecond").value = "00";

		document.getElementById("dateto_show").innerHTML = yesterday_str;
		document.getElementById('searchText3').value = yesterday_str;
		document.getElementById("searchendhour").value = "23";
		document.getElementById("searchendminute").value = "59";
		document.getElementById("searchendsecond").value = "59";
	}
}
</script>

</body>
</html>
