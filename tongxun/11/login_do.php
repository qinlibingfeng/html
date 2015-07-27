<?php
session_start();
header("Content-Type: text/html;charset=UTF-8");
$username = trim($_POST["username"]);
$userpwd = md5(trim($_POST["userpwd"]));

require_once "conn.php";
$sql = "select aname, apwd from admin where aname = '{$username}' and apwd = '{$userpwd}'";
$rs = mysql_query($sql);
if(mysql_num_rows($rs) > 0) {
	//登录成功
	$_SESSION["uid"] = 1;
	header("Location: ./index.php");
	exit;
} else {
	echo "<script>alert($username);</script>";
	echo "<script>alert($userpwd);</script>";
	echo "<script>alert('登录失败！');window.location.href = './login.html'</script>";
}
?>
