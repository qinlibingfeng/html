<?php
session_start();
define("N", TRUE);
//判断是否登录

header("Content-Type: text/html;charset=UTF-8");
//添加信息
//用户信息
$username = trim($_POST["username"]);
$usersex = trim($_POST["usersex"]);
$userbirth = !strtotime(trim($_POST["userbirth"])) ? 1 : strtotime(trim($_POST["userbirth"]));
$usertel = trim($_POST["usertel"]);
$useraddr = trim($_POST["useraddr"]);

//验证数据是否正确
if(empty($username) || empty($userbirth) || empty($usertel) || empty($useraddr)) {
	echo "<script>alert('数据需要完整！');window.location.href = './add.php'</script>";
	exit;
}

//插入数据库
require_once "conn.php";

//判断是否是更新操作
if(isset($_GET['update'])) {
		$id = intval(trim($_GET['update']));
	$sql = "update contract set cname = '{$username}', csex = '{$usersex}', cbirth = '{$userbirth}', ctel = '{$usertel}', caddr = '{$useraddr}' where cid = {$id}";
} else {
	$sql = "insert into contract(cname, csex, cbirth, ctel, caddr)
		 values('{$username}', '{$usersex}', '{$userbirth}', '{$usertel}', '{$useraddr}')";
}
if(mysql_query($sql)) {
	//插入成功
	echo "<script>alert('操作成功！');window.location.href = './index.php'</script>";
} else {
	//插入失败
	echo "<script>alert('操作失败！');window.location.href = './add.php'</script>";
}
?>
