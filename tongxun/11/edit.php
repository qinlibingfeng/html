<?php
session_start();

define("N", TRUE);
?>
<!doctype html>
<html>
<head>
<title>修改</title>
<meta http-equiv="content-type" content="text/html;charset=utf-8">
<link rel="stylesheet" href="css/index.css" />
<script type="text/javascript" src="js/calendar.js"></script>
</head>
<body>
<?php
require_once "header.php";
require_once "conn.php";
$id = intval(trim($_GET['id']));	
$sql = "select cid, cname, csex, cbirth, ctel, caddr from contract where cid = {$id}";
$rs = mysql_query($sql);
$row = mysql_fetch_assoc($rs);
?>

<div id = "add">
<h2 class = "title">修改信息</h2>
<form method = "post" action = "add_do.php?update=<?php echo $id;?>">
<table cellpadding = "0" cellspacing = "0">
	<tr>
		<td>姓名：</td>
		<td><input type = "text" name = "username" value = "<?php echo $row['cname'];?>"/></td>
	</tr>
	<tr>
		<td>性别：</td>
		<td>
		男<input type = "radio" name = "usersex" <?php echo $row['csex'] ? "checked = 'checked'" : "";?> value = "1" />
			女<input type = "radio" name = "usersex" <?php echo !$row['csex'] ? "checked = 'checked'" : "";?> value = "0" />
		</td>
	</tr>
	<tr>
		<td>生日：</td>
		<td><input type = "text" name = "userbirth" onclick="new Calendar().show(this);" value = "<?php echo date('Y-m-d', $row['cbirth'])?>"></td>
	</tr>
	<tr>
		<td>电话：</td>
		<td><input type = "text" name = "usertel" value = "<?php echo $row['ctel'];?>"></td>
	</tr>
	<tr>
		<td>地址：</td>
		<td><input type = "text" name = "useraddr" value = "<?php echo $row['caddr'];?>"></td>
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
	require_once "footer.php";
?>
</body>
</html>
