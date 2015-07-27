<?php
session_start();
header("Content-Type: text/html; charset=UTF-8");

require_once "conn.php";


//$action = $_REQUEST["action"];	
	
//if($action == "search_name"){
//按号码搜索

$id = intval(trim($_GET['id']));	

$sql = "select ctel from contract where cid = {$id}";
$rs = mysql_query($sql);
$row = mysql_fetch_assoc($rs);

$ssh=$row['ctel'];

//echo "<script>alert($ssh);window.location.href = './index-1.php'</script>";

$url= "http://172.17.1.90/ccms/vicidial_interface.php?action=Tel&user=1000&pass=1000&phone=$ssh";
$ret["ok"] = file_get_contents($url);

echo "<script>alert($ssh);window.location.href = './index-1.php'</script>";
//echo  json_encode($ret);

?>
