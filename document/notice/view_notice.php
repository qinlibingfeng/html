<?php require("../../inc/pub_func.php"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xHTML1/DTD/xHTML1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" style="overflow-x:hidden">
<head>
<meta http-equiv="Content-Type" content="text/HTML; charset=utf-8" />
<title> <?php echo $system_name ?>-查看公告</title>
<link href="/css/main.css?v=<?php echo $today ?>" rel="stylesheet" type="text/css">
<script src="/js/jquery-1.8.3.min.js"></script>
<script src="/js/main.js?v=<?php echo $today ?>"></script>

<script>

$(document).ready(function() {
  
     
});
  
</script>
 
</head>
 
<body>
 <?php 
$cid=trim($_REQUEST["cid"]);
$sql="select a.notice_title,a.notice_content,a.addtime,a.user_id,b.full_name from data_notice a left join vicidial_users b on a.user_id=b.user inner join data_notice_user c on a.notice_id=c.notice_id and c.user_id='".$_SESSION["username"]."' where  a.notice_id='".$cid."' limit 0,1 ";
//echo $sql;
$rows=mysqli_query($db_conn,$sql);
$row_counts_list=mysqli_num_rows($rows);

 
 
if ($row_counts_list!=0) {
	while($rs= mysqli_fetch_array($rows)){ 
		$notice_title=$rs["notice_title"];
		$notice_content=$rs["notice_content"];
		$addtime=$rs["addtime"];
		$user_id=$rs["user_id"];
		$full_name=$rs["full_name"];
  	}
 
}else {
	$counts="0";
	$des="未找到符合条件的数据！";
	echo '<script>$(document).ready(function(){Dialog.alert("记录不存在！请检查后重试！");});</script>';
 }
mysqli_free_result($rows);
 
 
 ?>
    <div class="page_nav">
         <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
         <div class="nav_">当前位置：查看公告</div>
         <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
     
    </div>
    
    <div class="page_main">
      <table border="0" width="98%" align="center" cellpadding="4" cellspacing="1" style="table-layout: fixed" >
        <tr>
          <td height="26" align="center" valign="middle"><strong><?php echo $notice_title ?></strong></td>
        </tr>
        <tr align='center' >
          <td height="24" align="center" valign="middle" style="border-bottom:dotted 1px #ccc"><span class="gray">发布人：</span><?php echo $full_name ?> [<?php echo $user_id ?>]<span class="gray">&nbsp; 发布时间：</span><?php echo $addtime ?></td>
        </tr>
        <tr align='center' >
          <td height="40" align="left" valign="top" style="word-wrap:break-word;word-break:break-all;"><?php echo stripslashes($notice_content); ?></td>
        </tr>
      </table>
    </div>
 
</body>
</html>
<?php 
mysqli_close($db_conn);
?>
  