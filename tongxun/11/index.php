<?php
session_start();
define("N", TRUE);
//判断是否登录
//if(empty($_SESSION["uid"])) {
//	header("Location: ./login.html");
//}
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
<div id = "content">
<form method = "post" action = "del.php?action=multi">
		<ul>	
			<li class = " title1 contact-list">
			&nbsp;&nbsp;
			<span>姓名</span>	
			<span>性别</span>	
			<span>生日</span>	
			<span>电话</span>	
			<span>地址</span>	
			<span>操作</span>	
		</li>
<?php
require_once "conn.php";
require_once "lib/Page.class.php";
$rs = mysql_query("select * from contract");
//总记录数
$total_nums = mysql_num_rows($rs);
//每页记录数
$num = 10;
$page = new Page($total_nums, $num);
$sql = "select cid, cname, csex, cbirth, ctel, caddr from contract order by cid {$page -> limit}";
$rs = mysql_query($sql);
while($row = mysql_fetch_assoc($rs)) {
	$row['cbirth'] = date("y.m.d", intval($row['cbirth']));
	$row['csex'] = empty($row['csex']) ? '女' : '男';
	echo <<<STR

<li class = "contact-list">
			<input type = "checkbox" name = "ck[]" value = "{$row['cid']}">
			<span>{$row['cname']}</span>	
			<span>{$row['csex']}</span>	
			<span>{$row['cbirth']}</span>	
			<span><a href="#">{$row['ctel']}</a></span>	
			<span>{$row['caddr']}</span>	
			<span>
				<a href = "edit.php?id={$row['cid']}">修改</a> |	
				<a href = "del.php?id={$row['cid']}">删除</a>	
			</span>	
		</li>
		
STR;
}

?>
</ul>
<div class = "paging">
	<input type = "submit" value = "删除多项" /> | 
	<?php echo $page->fpage(array(8,3,4,5,6,7,0,1,2)); ?>		
</div>
</form>
</div>
<?php
	//require_once "footer.php";
?>
</body>
</html>
