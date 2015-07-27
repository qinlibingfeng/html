<?php

	session_start();
	$pre_url	= "http://10.201.209.200/ehsn/et1/ui/internet/cti/screens";

	$option_type		= $_GET['nodeid'];
	$option_value		= $_GET['parentnodeid'];

	
	$getCustomerPhoneNumber = $pre_url."/getOrganization.jsp";
	$arr_job = file($getCustomerPhoneNumber);
	
	$root = "北京得易购国际贸易有限公司";
	$department = "呼叫中心";
	$person = "";
	foreach($arr_job  as $key => $xml_value)
	{
		//print_r($xml_value);
		if(trim($xml_value) != '' && trim($xml_value) != '</EOF>')
		{
			$xml = simplexml_load_string( iconv("gbk", "UTF-8", $xml_value));

			$result = $xml->xpath('C1');
			
			if($result[0]=="1"){
				$temp = $xml->xpath('C2');
				$root = $temp[0];
			}
			if($result[0]=="2081"){
				$temp = $xml->xpath('C5');
				$person = $temp[0];
				$temp2 = $xml->xpath("C2");
				$department = $temp2[0];
			}
		}
	}

	$person_arr = explode(",",$person);
	$str = "<?xml version='1.0' encoding='utf-8'?>";
	$str = $str . '<tree id="0"><item text="' . $root . '" id="' . $root . '" open="1" im0="books_close.gif" im1="tombs.gif" im2="tombs.gif" call="1" select="1">';
	$str = $str . '<item text="' . $department . '" id="' . $department . '" im0="book.gif" im1="books_open.gif" im2="books_close.gif">';
	foreach($person_arr as $p){
		if($p!=""){
			$per_arr = explode("(",$p);
			$str = $str . '<item text="' . $per_arr[0] . '" id="' . substr($per_arr[1],0,strlen($per_arr[1])-1) . '" im0="book.gif" im1="books_open.gif" im2="book.gif"></item>';
		}
	}
	$str = $str . '</item></item></tree>';
	header("Content-type: text/xml");
	echo $str;exit;






?>
