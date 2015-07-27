<?php
session_start();
define("N", TRUE);

?>
<!doctype html>
<html>
<head>
<title>添加</title>
<meta http-equiv="content-type" content="text/html;charset=utf-8">
<link rel="stylesheet" href="css/index.css" />
<script type="text/javascript" src="js/calendar.js"></script>
</head>
<body>
<?php
	require_once "header.php";
?>
<div id = "add">
<h2 class = "title">添加信息</h2>
<form method = "post" action = "add_do.php">
<table cellpadding = "0" cellspacing = "0">
	<tr>
		<td>姓名：</td>
		<td><input type = "text" name = "username" /></td>
	</tr>
	<tr>
		<td>性别：</td>
		<td>
			男<input type = "radio" name = "usersex" value = "1" checked = "checked" />
			女<input type = "radio" name = "usersex" value = "0" />
		</td>
	</tr>
	<tr>
		<td>生日：</td>
		<td><input type = "text" onclick="new Calendar().show(this);" name = "userbirth" /></td>
	</tr>
	<tr>
		<td>电话：</td>
		<td><input type = "text" name = "usertel"></td>
	</tr>
	<tr>
		<td>地址：</td>
		<td><input type = "text" name = "useraddr"></td>
	</tr>
	<tr>
		<td colspan = "2" style = "text-align:center;">
		<input type = "submit" name = "sub" value = "提&nbsp;交" />
		</td>
	</tr>
</table>
</form>
</div>

<?php
	//require_once "footer.php";
?>
</body>
</html>
