<?php
require("dbconnect.php");

function writelog($temp){
		$efp = fopen ("kent.txt", "a");
		fwrite ($efp, "$temp\n");
		fclose($efp);
}

//writelog($_SERVER['QUERY_STRING']);
$phone_number = $_REQUEST['phone_number'];
$extension = str_replace("SIP/", "", $_REQUEST['extension_temp']);
$user = $_REQUEST['user'];
$uniqueid = $_REQUEST['uniqueid'];

if(!isset($phone_number) || !isset($extension) || !isset($user) || !isset($uniqueid))
{
	//echo "传递参数出错";
	writelog("Invalid Parameter.");
	exit;
}
if($phone_number == "" || $extension == "" || $user == "" || $uniqueid == "")
{
	//echo "传递参数出错";
	writelog("Invalid Parameter.");
	exit;
}
writelog("Time: ".date("Y-m-d H:i:s")."		phone_number: ".$phone_number."		extension: ".$extension."		user: ".$user."			uniqueid: ".$uniqueid);

//DB Connection
//$mylink = mysql_connect( '10.201.107.82', 'root', 'anlaigz' );
//mysql_select_db( 'vicidial', $mylink );
//mysql_query( "SET NAMES utf8", $mylink );
$mylink = $link;

$sql = "select * from ccms_live_call_event where uniqueid = '".$uniqueid."'";
$cmd = mysql_query($sql);
$res = mysql_fetch_array($cmd);
if(!empty($res))
{
	//echo "该电话记录已存在，请不要重复提交。";
	writelog("The call has been submited. Please don't submited again.");
	exit;
}

$result = 0;
$sql = "select * from ccms_live_call_event where extension = '".$extension."'";
$cmd = mysql_query( $sql );
$res = mysql_fetch_array($cmd);
if(empty($res))
{
	$sql = "insert into ccms_live_call_event(phone_number, extension, user, uniqueid, modified_time) values('".$phone_number."', '".$extension."', '".$user."', '".$uniqueid."', NOW())";
	mysql_query($sql);
	$result = 1;
}
else
{
	$sql = "update ccms_live_call_event set phone_number = '".$phone_number."', user = '".$user."', uniqueid = '".$uniqueid."', call_handled = 0, modified_time = NOW() where extension = '".$extension."'";
	mysql_query($sql);
	$result = 1;
}

if($result == 1)
{
	//echo "OK.";
	writelog("OK.");
}
else
{
	//echo "Failed.";
	writelog("Failed.");
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<style>
  body
  {
	  font-family:Arial, Helvetica, sans-serif;
	  font-size:12px;
	  color:#676767;
	  }
  input 
  {
	  border:1px dotted #C00;
	  text-align:left;
	  height:22px;
	  color:#C00;
	  }
  input.submitbtn
  {
	  border:1px solid #676767;
	  text-align:center;
	  }
  .record_data_table
  {
	  background:#E8F3FF;
	 }
 .record_data_table td
 {
	 background:#FFF;
	 }
 .record_data_table td.tdhead
 {
	 background:#A2D0FF;
	 color:#000;
	 font-weight:bold;
	}
 h3
 {
	 color:#A2D0FF
	 }
 
</style>
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#FF9966" vlink="#FF9966" alink="#FFCC99">
<?php

?>
</body>
<script type="text/javascript">
<!--  

//--> 
</script>
</html>