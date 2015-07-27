<?php
	session_start();
	
	//echo $_SESSION['fieldHideValue'];exit;
	include("./ehsn_et1_config.php");
//	header("Content-Type: text/html; charset=utf-8");
	$pre_url	= $_SESSION['et1url'];
	$pre_url_bak= "http://10.201.209.204/AgentID";
	require("dbconnect.php");
	require_once('./lib/tools.inc.php');

	$contactid			= trim($_SESSION['contactid']);
	unset($_SESSION['contactid']);
	//var_dump($contactid);
	$contactid			= str_replace("<CONTACTID>", "", $contactid);
	$contactid			= str_replace("</CONTACTID>", "", $contactid);
	$RadioGroup_type	= $_POST['RadioGroup_type'];
	$remark				= $_POST['remark'];
	$customerid			= $_POST['customerid'];
	$canpaign			= $_POST['canpaign'];
	$fieldHideValue 	= $_POST['fieldHideValue'];
	$_SESSION['fieldHideValue'] = $fieldHideValue;
	$comments			= urlencode($_POST['comments']);
	if($RadioGroup_type == '')
	{
		$iFlag = 2;
		$sExplain = "小结项目不能为空";

	}else if(!empty($customerid) && ( substr($customerid,0,1) != '1' || strlen($customerid) != 7)){
		$sExplain = "客户代号有误,请检查";
	}
	else
	{
		$arr_type	= explode('#',$RadioGroup_type);
		$cwcid		= trim($arr_type[0]);
		$cwcname	= urlencode($arr_type[1]);

		$update_history_url = $pre_url."/updateContactHistory.".$_SESSION['etlsuffix']."?contactid=$contactid&actioncode=3&customerid=$customerid";
		$update_history_url_bak = $pre_url_bak."/updateContactHistory.asp?contactid=$contactid&actioncode=3&customerid=$customerid";
//		echo $update_history_url."<hr>";//file
		$arr_job	=@file($update_history_url);
		if(!$arr_job){
			$arr_job	=@file($update_history_url_bak);
		}

		$insert_comment = $pre_url."/insertContactCWCComments.".$_SESSION['etlsuffix']."?contactid=$contactid&cwcid=$cwcid&comments=$comments&cwcname=$cwcname";
		$insert_comment_bak = $pre_url_bak."/insertContactCWCComments.asp?contactid=$contactid&cwcid=$cwcid&comments=$comments&cwcname=$cwcname";
		//echo $insert_comment."<hr>";//file
		$arr_job	=@file($insert_comment);
		if(!$arr_job){
			$arr_job	=@file($insert_comment_bak);
		}
		mysql_query("SET NAMES 'UTF8'");
		$stmt = "SELECT status FROM vicidial_campaign_statuses where status = '$cwcid' and campaign_id = '$canpaign';";
		$rslt=mysql_query($stmt, $link);
		$qm_conf_ct = mysql_num_rows($rslt);
		if ($qm_conf_ct <= 0){
			//$cwcvalue = iconv("UTF-8", "gbk", $arr_type[1]);
			$insert_sql = "insert into vicidial_campaign_statuses ( status , status_name,campaign_id ) values ( '$cwcid' , '{$arr_type[1]}','$canpaign' )";
			$insert_rs  =mysql_query($insert_sql, $link);
		}
		$iFlag = 1;
		$sExplain = "保存成功！#".$cwcid;
		//$sExplain = $insert_comment;
	}

		
	ActionReturnXml($iFlag,$sExplain);
?>