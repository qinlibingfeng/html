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

echo "<script>alert($ssh);window.location.href = './index-1.php'</script>";




?>
