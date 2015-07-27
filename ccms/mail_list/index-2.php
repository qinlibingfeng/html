<?php
session_start();
define("N", TRUE);
//require_once "../agc_cn/vicidial.php";
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
	//require_once "header.php";
?>

<script>


function AgentsXferSelect(callnum){			
	window.parent.parent.document.getElementById("xfernumber").value = callnum;	
	//window.parent.document.getElementById("dialog-confirm11").style.display="none";		
}


</script>
<div id = "content">
<form method = "post" action = "Search_xfer.php">
<table cellpadding = "0" cellspacing = "0">
	<tr>
		<td>按姓名查找：</td>
		<td><input type = "text" name = "username_find" /></td>
		<td>按部门查找：</td>
		<td>
		<select name="userposition_find" id="userposition_find"">
		 <option value ="">未填写</option>
		  <option value ="经理办公室">经理办公室</option>
		  <option value="商务核算部">商务核算部</option>
		  <option value="财务部">财务部</option>
		  <option value ="市场运营部">市场运营部</option>
		  <option value="订舱平台">订舱平台</option>
		  <option value="客户服务部">客户服务部</option>
		  <option value="销售一部">销售一部</option>
		  <option value="销售二部">销售二部</option>
		  <option value="支线部">支线部</option>
		  <option value="出口部">出口部</option>
		  <option value="进口部">进口部</option>
		  <option value="箱管部">箱管部</option>
		  <option value="计划部">计划部</option>
		  <option value="船勤部">船勤部</option>
		  <option value="内贸部">内贸部</option>
		  <option value="发展部">发展部</option>
		</select></td>
		

		<td colspan = "2" style = "text-align:center;">
		<input type = "submit" name = "sub" value = "查&nbsp;询" />
		</td>
	</tr>
</table>
</form>

<form method = "post" action = "">
		<ul>	
			<li class = " title1 contact-list">
			<span>姓名</span>	
			<span>职位</span>	
			<span>部门</span>	
			<span>电话</span>	
			<span>办公室电话</span>	
				
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
$sql = "select cid, cname, cposition, cdepartment, ctel, clandline from contract order by cid {$page -> limit}";
$rs = mysql_query($sql);
while($row = mysql_fetch_assoc($rs)) {
	//$row['cbirth'] = date("y.m.d", intval($row['cbirth']));
	//$row['csex'] = empty($row['csex']) ? '女' : '男';
	echo <<<STR

	

<li class = "contact-list">
			<span>{$row['cname']}</span>	
			<span>{$row['cposition']}</span>	
			<span>{$row['cdepartment']}</span>	
			<span><a href="javascript:;" onclick="AgentsXferSelect({$row['ctel']})" >{$row['ctel']}</a></span>	
			<span><a href="javascript:;" onclick="AgentsXferSelect({$row['clandline']})" >{$row['clandline']}</a></span>
			
			<span style="display:none">
				<a href = "edit.php?id={$row['cid']}">修改</a> |	
				<a href = "del.php?id={$row['cid']}">删除</a>	
			</span>	
		</li>
STR;
}

?>			

</ul>
<div  class = "paging">
	<?php echo $page->fpage(array(8,3,4,5,6,7,0,1,2)); ?>		
</div>
</form>
</div>
<?php
	//require_once "footer.php";
?>
</body>
</html>

