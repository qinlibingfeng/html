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
<script>
function AgentsXferSelect(callnum){			
	window.parent.parent.document.getElementById("xfernumber").value = callnum;	
	//alert("号码已填充");
	//window.parent.document.getElementById("dialog-confirm11").style.display="none";		
}

</script>
<div id = "content">
<form method = "post" action = "">
		<ul>	
			<li class = " title1 contact-list">
			<span>姓名</span>	
			<span>职位</span>	
			<span>部门</span>	
			<span>电话</span>	
			<span>办公室电话</span>	
			<span style="display:none">操作</span>	
		</li>
<?php
require_once "conn.php";
require_once "lib/Page.class.php";

if (isset($_GET["sWhere"]))						    {$sWhere=$_GET["sWhere"];}
	        elseif (isset($_POST["sWhere"]))            {$action=$_POST["sWhere"];}      

$Wheres=urldecode($sWhere);

$rs = mysql_query("select * from contract where ".$Wheres."");
//总记录数
$total_nums = mysql_num_rows($rs);
//每页记录数
$num = 10;
$page = new Page($total_nums, $num);
$sql = "select cid, cname, cposition, cdepartment, ctel, clandline from contract where ".$Wheres." order by cid {$page -> limit}";
$rs = mysql_query($sql);
while($row = mysql_fetch_assoc($rs)) {
	echo <<<STR
	
<li class = "contact-list">
			<span>{$row['cname']}</span>	
			<span>{$row['cposition']}</span>	
			<span>{$row['cdepartment']}</span>	
			<span><a href="javascript:;" onclick="AgentsXferSelect({$row['ctel']})" >{$row['ctel']}</a></span>	
			<span><a href="javascript:;" onclick="AgentsXferSelect({$row['clandline']})" >{$row['clandline']}</a></span>
		</li>
STR;
}

?>			

</ul>
<div  class = "paging">
	<a  style="font-size:12px; (文字大小) color:#FF0000;(色) font-family: "新宋体"; " href = "index-2.php">返回</a>
	<?php echo $page->fpage(array(8,3,4,5,6,7,0,1,2)); ?>		
</div>
</form>
</div>
<?php
	//require_once "footer.php";
?>
</body>
</html>

