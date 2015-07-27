#! /usr/bin/php -q
<?php
set_time_limit(60);
ob_implicit_flush(false);
include("phpagi.php");
include("dbconnect.php");
$agi=new AGI;
	$num=$agi->request["agi_callerid"];
	$url=$agi->request["agi_rdnis"];
	$openurl=$url."&num=".$num;
	$agi->verbose($openurl);
	$last_line=file($openurl);
	$OPTION=$last_line[0];
	$agi->verbose($OPTION);
if($OPTION=='')
{
$OPTIONS="0";
}else{
$OPTIONS="1";
}
$agi->verbose($OPTIONS);
$setoption="Set OPTION=".$OPTION;
$setoptions="Set OPTIONS=".$OPTIONS;
$agi->verbose($setoption);
$agi->verbose($setoptions);
$agi->exec($setoption);
$agi->exec($setoptions);
exit;
?>
