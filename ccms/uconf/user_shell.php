<?php 
require("config.ini.php"); 
check_login();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>系统维护</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="js/jquery.js"></script>



<script type="text/javascript">
	
	$(function(){	
				
		$("#user_check").click(function (){
			user_shell("user_check");
		});	
		$("#user_reboot").click(function (){
			
		if(window.confirm("确定重启服务器吗？")){
		   user_shell("user_reboot");
		 }else{
		   return false;
		 }
 
			
		});
		$("#user_asterisk").click(function (){
			user_shell("user_asterisk");
		});

	})	

	
	function user_shell($op){

		$("#result").val("");	
			var datas="action=user_shell&op="+$op;
			$.ajax({
				url:"send.php",
				data: datas,
				type:"post",
				dataType:"json",
	     	success: function (data) {	
	     		if(data.ok == 0)
	     		{
	      		$("#result").val(data.result);	
	      	}
	      
	      }
	    });

	}
</script>

</head>

<body>

	<div class="place">
    <span>位置：</span>
    <ul class="placeul">
    <li><a href="#">首页</a></li>
    <li><a href="#">系统维护</a></li>
    </ul>
    </div>
    
    <div class="formbody">
    
    <div class="formtitle"><span>系统维护</span></div>
    
    <ul class="forminfo">
    	
    	<li><label>操作</label><input id="user_check" type="button" class="btn" value="系统检测"/>
    			<input id="user_reboot" type="button" class="btn" value="重启服务器"/>
    			<input id="user_asterisk" type="button" class="btn" value="重启呼叫服务"/>
    			
    	</li>
    	<li><label>结果</label><textarea id="result"  cols="" rows="10" class="textresult" ></textarea></li>
    	
    	<!--
    	<input id="user_httpd" type="button" class="btn" value="重启HTTP服务"/>
	    <li><label>文章标题</label><input name="" type="text" class="dfinput" /><i>标题不能超过30个字符</i></li> 
	    <li><label>关键字</label><input name="" type="text" class="dfinput" /><i>多个关键字用,隔开</i></li>
	    <li><label>是否审核</label><cite><input name="" type="radio" value="" checked="checked" />是&nbsp;&nbsp;&nbsp;&nbsp;<input name="" type="radio" value="" />否</cite></li>
	    <li><label>引用地址</label><input name="" type="text" class="dfinput" value="http://www.uimaker.com/uimakerhtml/uidesign/" /></li>
	    <li><label>文章内容</label><textarea name="" cols="" rows="" class="textinput"></textarea></li>
	    <li><label>&nbsp;</label><input name="" type="button" class="btn" value="确认保存"/></li>
	    -->
    </ul>
    
    
    </div>


</body>

</html>
