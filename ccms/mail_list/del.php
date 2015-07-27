<?php
session_start();
header("Content-Type: text/html; charset=UTF-8");

require_once "conn.php";
//require("dbconnect.php");

//多个信息删除
if(isset($_GET['action'])) {
	//var_dump($_POST['ck']);
	$dels = join(",", $_POST['ck']);
	$sql = "delete from contract where cid in ({$dels})";
	if(mysql_query($sql)) {
		//插入成功
		echo "<script>alert('删除成功！');window.location.href = './index.php'</script>";
	} else {
		//插入失败
		echo "<script>alert('删除失败！');window.location.href = './index.php'</script>";
	}

}

//单个信息删除
if(isset($_GET["id"])) {
	$id = intval($_GET["id"]);
	$sql = "delete from contract where cid = {$id}";
	if(mysql_query($sql)) {
		//插入成功
		echo "<script>alert('删除成功！');window.location.href = './index-1.php'</script>";
	} else {
		//插入失败
		echo "<script>alert('删除失败！');window.location.href = './index-1.php'</script>";
	}
}
?>
