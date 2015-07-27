<?php
/**
 * 来电归属地
 * 
 *
 */
ini_set('display_errors','Off');
if (isset($_GET["campaign"]))				{$campaign=$_GET["campaign"];}
	elseif (isset($_POST["campaign"]))		{$campaign=$_POST["campaign"];}

if(empty($campaign)){
	echo ""; //"Campaign Id can't be empty!";
	exit;
}
require("dbconnect.php");
mysql_query("set names utf8");
$stmt = "SELECT phone_place_enable,phone_place_db_server_ip,phone_place_db_name,phone_place_db_login,phone_place_db_password,phone_place_default FROM ccms_campaigns where campaign_id='$campaign';";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "";}
$ss_conf_ct = mysql_num_rows($rslt);
if ($ss_conf_ct > 0)
{
	$row=mysql_fetch_row($rslt);
	$phone_place_enable			 =	$row[0];
	$phone_place_db_server_ip	=	$row[1];
	$phone_place_db_name =			$row[2];
	$phone_place_db_login =			$row[3];
	$phone_place_db_password =		$row[4];
	$phone_place_default =			$row[5];
}else{
	echo "";//"Campaign Id can't be empty!";
	exit;
}
$db_link=mysql_connect($phone_place_db_server_ip, $phone_place_db_login , $phone_place_db_password);

if (!$db_link) {
	echo "";
	exit;
}
mysql_select_db($phone_place_db_name,$db_link);
mysql_query("set names utf8");
$leadphone = $_REQUEST['phone'];
$phone_city = '';

if( !empty( $leadphone ) ){
	// 手机号码段
	if( substr($leadphone,0,2) == '13' || substr($leadphone,0,2) == '15' || substr($leadphone,0,2) == '18' || substr($leadphone,0,3) == '013' || substr($leadphone,0,3) == '015' || substr($leadphone,0,3) == '018' ){
		$focus->column_fields["mobile"] = $leadphone;
		if( substr( $leadphone, 0, 1 ) == 0 ){
			$phone_key = substr( $leadphone, 1, 7 );
		}else{
			$phone_key = substr( $leadphone, 0, 7 );
		}
		$select_phone = "select `city` from `vtiger_phone_region` where `phone` = '" . $phone_key . "' limit 1";
		$rslt = mysql_query($select_phone,$db_link);
		$row = mysql_fetch_row($rslt);
		$phone_city = $row[0];
		//echo $phone_city;
		if( $phone_city == '' ){
			$phone_city = $phone_place_default;
		}
	}else{
		// 固话号码段
		$focus->column_fields["phone"] = $leadphone;
		if( strpos( $leadphone, '-' ) ){
			//存在'-'
			$phone_key_array = explode( '-', $leadphone );
			$phone_key = $phone_key_array[0];
			$select_phone = "select `city` from `vtiger_phone_region` where `region` = '" . $phone_key . "' limit 1";
			$rslt = mysql_query($select_phone,$db_link);
			$row = mysql_fetch_row($rslt);
			$phone_city = $row[0];
		}else{
			//不存在'-'
			if( strlen($leadphone) == 7 || strlen($leadphone) == 8 || strlen($leadphone) == 10 || strlen($leadphone) == 11 || strlen($leadphone) == 12 ){
				if( strlen($leadphone) == 7 || strlen($leadphone) == 8 ){
					// 1、无区号电话号码
					//$leadphone =  $leadphone;
					$phone_city = $phone_place_default;
				}else{
					// 2、有区号电话号码
					//情况一：区号为3位数
					$phone_key = substr( $leadphone, 0, 3 );
					$select_phone = "select `city` from `vtiger_phone_region` where `region` = '" . $phone_key . "' limit 1";
					$rslt = mysql_query($select_phone,$db_link);
					$row = mysql_fetch_row($rslt);
					$phone_city = $row[0];
					if( empty( $phone_city ) ){
						//情况二：区号为4位数
						$phone_key = substr( $leadphone, 0, 4 );
						$select_phone = "select `city` from `vtiger_phone_region` where `region` = '" . $phone_key . "' limit 1";
						$rslt = mysql_query($select_phone,$db_link);
						$row = mysql_fetch_row($rslt);
						$phone_city = $row[0];
					}
					if( $phone_city == '' ){
						$phone_city = $phone_place_default;
					}
				}
			}else{
				// 3、短号码
				$phone_city = $phone_place_default;
			}
		}
	}
}
echo $phone_city;
?>