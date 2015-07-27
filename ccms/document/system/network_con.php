<?php require("../../inc/config.ini.php"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xHTML1/DTD/xHTML1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xHTML">
<head>
<meta http-equiv="Content-Type" content="text/HTML; charset=utf-8" />
<title> <?php echo $system_name ?></title>
<link href="/css/main.css?v=<?php echo $today ?>" rel="stylesheet" type="text/css">
<link href="/css/day.css" rel="stylesheet" type="text/css">
<script src="/js/jquery-1.8.3.min.js"></script>
<script src="/js/main.js?v=<?php echo $today ?>"></script>
<script src="/js/pub_func.js?v=<?php echo $today ?>"></script>
<script>

function server_set(){
	
	if(confirm("本操作将重建系统服务器的网络连接！\n\n本操作不可撤销，您确定要执行重连接指令吗？")){
 	}else{
		return false;
	}
  	
	$("#shell_cmd").val("pppd call myclient");
	$("#shell_do").val("网络重连接");
	$("#server_id").val("11");
 
	//$("#server_form").attr("action","http://"+ip+"/Document/system/server_con.php");
  	
	request_tip("即将执行网络重连接指令...",1);
	var urls="http://<?php echo $db_server_ip ?>/document/system/server_con.php?"+$('#server_form').serialize()+times+"&callback=?";
	 
	$.getJSON(urls,function(json){
			 
			request_tip(json.des,json.counts);
			if(json.counts=="0"){
				alert(json.des);
			} 
		} 
 	);  
} 
 
$(document).ready(function(){
	 
});
  
</script>
<style>
.hide_tit{width:120px;}
</style>

</head>
<body>
<div id="load" class="load_layer"><img src="/images/loading.gif"align="absmiddle"/>数据加载中...</div>
<div id="auto_save_res" class="load_layer"></div>
 
    
<div class="page_main">
   <form action="" method="post" name="server_form" target="" id="server_form">
        <input type="hidden" name="shell_cmd" id="shell_cmd" value="" />
        <input type="hidden" name="shell_do" id="shell_do" value="" />
        <input type="hidden" name="server_id" id="server_id" value="" />
       </form>
  <table border="0" align="center" cellpadding="0" cellspacing="0"  style="width:180px; margin-top:100px;">
     <tr>
        <td colspan="2"><a href='javascript:void(0);'  class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false' priv="true" onclick="server_set('');" title="重建网络连接"><img src="/images/icons/icons_15.gif" style="margin-top:4px"/><b>重建网络连接&nbsp;</b></a></td>
    </tr>
    </table>
</div>
 
</body>
</html>
   
