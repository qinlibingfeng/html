<?php
//修改密码
session_start();
header("Content-Type: text/html; charset=UTF-8");
define("N", TRUE);
//判断是否登录


//旧密码
$oldpwd = md5(trim($_POST["oldpwd"]));
//新密码
$newpwd = md5(trim($_POST["newpwd1"]));
require_once "conn.php";
$sql = "update `admin` set apwd = '{$newpwd}' where apwd = '{$oldpwd}'";
if(mysql_query($sql)) {
	if(mysql_affected_rows()) {
		//修改成功
		echo "<script>alert('修改成功！');window.location.href = './index.php'</script>";
	} else {
		//修改失败
		echo "<script>alert('修改失败！');window.location.href = './editpwd.php'</script>";	
	}
} else {
	//修改失败
	echo "<script>alert('修改失败！');window.location.href = './editpwd.php'</script>";	
}



?>
