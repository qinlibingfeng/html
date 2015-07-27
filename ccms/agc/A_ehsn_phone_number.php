<?php
	session_start();
	include("./ehsn_et1_config.php");
	//print_r($_POST);exit;
	//echo "<hr>";
//	header("Content-Type: text/html; charset=utf-8");
	$pre_url	= $_SESSION['et1url'];
	$pre_url_bak= "http://10.201.209.204/ehsn/et1/ui/internet/cti/screens";
	require_once('./lib/tools.inc.php');

//	$contactid			= trim($_SESSION['contactid']);
//	$RadioGroup_type	= $_POST['RadioGroup_type'];
//	$remark				= $_POST['remark'];
//	$customerid			= $_POST['customerid'];
//	$comments			= $_POST['comments'];
	$option_type		= $_REQUEST['option_type'];
	$option_value		= trim($_REQUEST['option_value']);
	$phone_type			= $_REQUEST['phone_type'];
	$area_code_YN		= trim($_REQUEST['area_code_YN']);
	$item_id			= $_REQUEST['item_id'];
	if($area_code_YN == '') $area_code_YN='N';
	//echo $option_value . '--' . $option_type;exit;
	//echo $area_code_YN;
	//echo "###";
	if($option_type == '')
	{
		$iFlag = 2;
		$sExplain = "请选择客戶電話依據條件";
	}
	elseif($option_value == '')
	{
		$iFlag = 3;
		$sExplain = "请输入依據條件的值";
	}
	elseif($phone_type == '')
	{
		$iFlag = 4;
		$sExplain = "请选择電話類型";
	}
	else
	{
		$getCustomerPhoneNumber = $pre_url."/getCustomerPhoneNumber.".$_SESSION['etlsuffix']."?OptionType=$option_type&OptionValue=$option_value&PhoneType=$phone_type&AreaCode_YN=$area_code_YN&ItemID=$item_id";
		$getCustomerPhoneNumber_bak = $pre_url_bak."/getCustomerPhoneNumber.asp?OptionType=$option_type&OptionValue=$option_value&PhoneType=$phone_type&AreaCode_YN=$area_code_YN&ItemID=$item_id";
		$CustomerPhone	= @file($getCustomerPhoneNumber);
		if(!$CustomerPhone){
			$CustomerPhone	=@file($getCustomerPhoneNumber_bak);
		}
		$CustomerPhone[12] = iconv("gbk", "UTF-8", $CustomerPhone[12]);
		$phone_number  =$CustomerPhone[12];
		$patterns = "/\d+/";
		preg_match_all($patterns,$phone_number,$arr);
		foreach($arr[0] as $items){
			$now_num .= $items;
		}
		echo $now_num;

	}
?>