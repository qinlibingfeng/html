<?php
session_start();
define("N", TRUE);

?>
<!doctype html>
<html>
<head>
<title>通讯录管理程序</title>
<meta http-equiv="content-type" content="text/html;charset=utf-8">
<link rel="stylesheet" href="css/index.css" />
</head>
<body>
<?php
	require_once "header.php";
?>
<div id = "editpwd">
<h2 class = "title">修改密码</h2>
<form method = "post" action = "editpwd_do.php">
<span>旧密码：<input type = "text" name = "oldpwd" /></span><br />
<span>新密码：<input type = "text" name = "newpwd1" /></span><br />
<span>重&nbsp;&nbsp;复：<input type = "text" name = "newpwd2" /></span><br />
<input type = "submit" value = "确 定" />
</form>
</div>

<?php
	require_once "footer.php";
?>
</body>
</html>
