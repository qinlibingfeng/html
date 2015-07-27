<?php
require("dbconnect.php");

function checkUser($f,$v){
	global $link;
	global $langu_php;
	
	if($langu_php == "en.php"){
		$lang_login_check = " use phone ";
		$lang_login_check2 = " is used by user ";
		$lang_agent_link = "Agent";
		$lang_outline_phone = "Phone";
	}else{
		$lang_login_check = "已使用分机";
		$lang_login_check2 = "已被账号";
		$lang_agent_link = "话务员";
		$lang_outline_phone = "外线号码";
	}	
	
	$stmt= "";
	$inbound_mode = "";
	if($f == "a.user"){
		$stmt="SELECT a.user,b.extension,b.computer_ip from vicidial_live_agents a left join phones b on substring(a.extension,5)=b.extension where " . $f . "='" . $v . "'";
		$inbound_mode = checkInboundMode($v);
		if($inbound_mode == "false"){
			return "false";
		}
	}else{
		$stmt="SELECT a.user,b.extension,b.computer_ip from vicidial_live_agents a,phones b where a.extension = CONCAT(\"SIP/\",b.extension) and b.login='" . $v . "'";
	}
	//echo $stmt;
	
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	if($row){
		if($f == "a.user"){
			return "$lang_agent_link " . $row[0] . "$lang_login_check" . $row[1] . " IP:" . $row[2] . " :::" . $inbound_mode;
		}else{
			return "$lang_outline_phone " . $row[1] . "$lang_login_check2" . $row[0] . " IP:" . $row[2];
		}

	}else{
		if($f == "a.user"){
			return ":::" . $inbound_mode;
		}else{
			return "";
		}
		
	}
	
}
function delUser($f,$v){
	global $link;
	$stmt= "";
	if($f == "a.user"){
		$stmt="delete from vicidial_live_agents where user ='$v'";
	}else{
		$stmt="delete from vicidial_live_agents where extension = CONCAT(\"SIP/\",(select extension from phones where login='$v'))";
	}
	$rslt=mysql_query($stmt, $link);
	sleep(2);
	return "success";
}

function checkInboundMode($u){
	global $link;
	$stmt = "select closer_campaigns from vicidial_users where user='$u'";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	if($row){
		$close_campaigns = $row[0];
		$ingroup = explode(" ",trim($close_campaigns));
		for($i=0;$i<count($ingroup);$i++){
			$ingroup[$i] = "'" . $ingroup[$i] . "'";
		}
		$ingroup_str = implode($ingroup,",");
		$stmt = "select distinct(inbound_mode) from vicidial_inbound_groups where group_id in($ingroup_str) and group_id not like 'AGENTDIRECT%'";
		$rslt=mysql_query($stmt, $link);
		$count = mysql_num_rows($rslt);
		if($count>1){
			return "false";
		}
		if($count == 1){
			$row=mysql_fetch_row($rslt);
			return $row[0];
		}
		return "auto";
	}
}

if (isset($_GET["name"]))				{$value=$_GET["name"];}
	elseif (isset($_POST["name"]))		{$value=$_POST["name"];}
if (isset($_GET["name1"]))				{$value1=$_GET["name1"];}
	elseif (isset($_POST["name1"]))		{$value1=$_POST["name1"];}
if (isset($_GET["status"]))				{$status=$_GET["status"];}
	elseif (isset($_POST["status"]))		{$status=$_POST["status"];}
if (isset($_GET["action"]))				{$action=$_GET["action"];}
	elseif (isset($_POST["action"]))		{$action=$_POST["action"];}
/*
if($action == "mode"){
	echo checkInboundMode("bear3");
	exit;
}
*/
if($action == "check"){
	$field = "a.user";
	if($status == 3){
		$field = "a.extension";
		exit;//$value = 'SIP/' . $value;
	}
	if($status ==3 || $status == 2){
		echo checkUser($field,$value);
		exit;
	}
	if($status ==4){
		$temp = checkUser("a.extension",$value) . checkUser("a.user",$value1);
		if(stripos($temp,"false")){
			echo "false";
			exit;
		}else{
			echo $temp;
			exit;
		}
		
	}
}

if($action == "del"){
	$field = "a.user";
	if($status == 3){
		$field = "a.extension";
		exit;
		//$value = 'SIP/' . $value;
	}
	if($status ==3 || $status == 2){
		echo delUser($field,$value);
		exit;
	}
	if($status ==4){
		echo delUser("a.user",$value1);
		exit;
	}
}

//add by fox for change password;
if (isset($_GET["old_password"]))	 {$old_password=$_GET["old_password"];}
    elseif (isset($_POST["old_password"]))	 {$old_password=$_POST["old_password"];}
if (isset($_GET["new_password1"]))	 {$new_password1=$_GET["new_password1"];}
    elseif (isset($_POST["new_password1"]))	 {$new_password1=$_POST["new_password1"];}
if (isset($_GET["new_password2"]))	 {$new_password2=$_GET["new_password2"];}
    elseif (isset($_POST["new_password2"]))	 {$new_password2=$_POST["new_password2"];}
if (isset($_GET["campaign_id"]))	 {$campaign_id=$_GET["campaign_id"];}
    elseif (isset($_POST["campaign_id"]))	 {$campaign_id=$_POST["campaign_id"];}
if($action == "modify_password"){
    //echo $value;
    echo modify_password($value,$old_password,$new_password1,$new_password2,$campaign_id);
    exit;
}
function modify_password($value,$old_password,$new_password1,$new_password2,$campaign_id){
    global $link;
    if(strlen($new_password1) < 2 || strlen($new_password1) > 10){
        return 3;
    }
    $stmt = "select * from vicidial_users where user='$value' and pass='$old_password'";
    //echo $stmt;
    $rslt=mysql_query($stmt, $link);
    $count = mysql_num_rows($rslt);
    if($count<1){
        return 1;
    }
    //echo $new_password1 . '--' . $new_password2;
    if($new_password1 != $new_password2){
        return 2;
    }
    
    $stmt="UPDATE vicidial_users set pass='$new_password1',pwd_status='1' where user='$value';";
    $rslt=mysql_query($stmt, $link);
    $stmt="SELECT ccms_url from system_settings;";
            $rslt=mysql_query($stmt, $link);
            $row=mysql_fetch_row($rslt);
            $ccms_url_link = $row[0];
            $url_link = $ccms_url_link."integrate_vtiger_user.php?campaign=" . $campaign_id . "&user=".$value;
            //echo $url_link;
            file("$url_link");
    $stmt="delete from vicidial_live_agents where user ='$value'";
    $rslt=mysql_query($stmt, $link);
/**
    ###############################################################
    ##### START SYSTEM_SETTINGS VTIGER CONNECTION INFO LOOKUP #####
    $stmt = "SELECT enable_vtiger_integration,vtiger_server_ip,vtiger_dbname,vtiger_login,vtiger_pass,vtiger_url FROM vicidial_campaigns where campaign_id='$campaign_id';";
    //echo $stmt . "
";
    $rslt=mysql_query($stmt, $link);
    $ss_conf_ct = mysql_num_rows($rslt);
    if ($ss_conf_ct > 0)
    {
        $row=mysql_fetch_row($rslt);
        $enable_vtiger_integration =	$row[0];
        $vtiger_server_ip	=	 $row[1];
        $vtiger_dbname =	 $row[2];
        $vtiger_login =	 $row[3];
        $vtiger_pass =	 $row[4];
        $vtiger_url =	 $row[5];
        if ($enable_vtiger_integration > 0){
            //Synchronize to vtiger
            $salt = substr($value, 0, 2);
            $salt = '$1$' . $salt . '$';
            $encrypted_password = crypt($new_password1, $salt);
            //echo $encrypted_password."
";
            $linkV=mysql_connect("$vtiger_server_ip", "$vtiger_login","$vtiger_pass");
            mysql_select_db($vtiger_dbname,$linkV);
            mysql_query("set names utf8");	
            $stmtA = "UPDATE vtiger_users SET user_password='$encrypted_password' where user_name='$value';";
            //echo $stmtA. "
";	
            $rslt=mysql_query($stmtA, $linkV) or die("Invalid query: " . mysql_error());
            //printf ("Updated records: %d\n", mysql_affected_rows());
            //echo "
";
            //Synchronize file
            $stmt="SELECT ccms_url from system_settings;";
            $rslt=mysql_query($stmt, $link);
            $row=mysql_fetch_row($rslt);
            $ccms_url_link = $row[0];
            $url_link = $ccms_url_link."integrate_vtiger_user.php?campaign=" . $campaign_id . "&user=".$value;
            //echo $url_link;
            file("$url_link");
        }
    }
    ##### END SYSTEM_SETTINGS VTIGER CONNECTION INFO LOOKUP #####
    #############################################################
**/
    return 0;
}

function check_user_login($value){
    global $link;
    $stmt = "select pwd_status from vicidial_users where user='$value';";
    $rslt=mysql_query($stmt, $link);
    $row=mysql_fetch_row($rslt);
    $pwd_status = $row[0];
    if($pwd_status == 0) return 0;
        else return 1;
}

if($action == "check_user_login"){
    echo check_user_login($value);
    //echo $value;
    exit;
}


?>