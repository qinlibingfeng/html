<?php
session_start();
define("N", TRUE);
//判断是否登录

header("Content-Type: text/html;charset=UTF-8");
//添加信息
//用户信息
$username = trim($_POST["username"]);
$userposition = trim($_POST["userposition"]);
$userdepartment = trim($_POST["userdepartment"]);
$usertel = trim($_POST["usertel"]);
$userlandline = trim($_POST["userlandline"]);


//验证数据是否正确
if(empty($username) || empty($userposition) || empty($usertel) || empty($userdepartment)) {
	echo "<script>alert('数据需要完整！');window.location.href = './add.php'</script>";
	exit;
}

//插入数据库
require_once "conn.php";
//require("dbconnect.php");

//判断是否是更新操作
if(isset($_GET['update'])) {
		$id = intval(trim($_GET['update']));
	$sql = "update contract set cname = '{$username}', cposition = '{$userposition}', cdepartment = '{$userdepartment}', ctel = '{$usertel}', clandline = '{$userlandline}' where cid = {$id}";
} else {
	$sql = "insert into contract(cname, cposition, cdepartment, ctel, clandline)
		 values('{$username}', '{$userposition}', '{$userdepartment}', '{$usertel}', '{$userlandline}')";
}
if(mysql_query($sql)) {
	//插入成功
	echo "<script>alert('操作成功！');window.location.href = './index-1.php'</script>";
} else {
	//插入失败
	echo "<script>alert('操作失败！');window.location.href = './add.php'</script>";
}
?>
