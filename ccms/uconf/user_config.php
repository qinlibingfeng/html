<?php 
require("config.ini.php"); 
check_login();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="js/jquery.js"></script>



<script type="text/javascript">
	var $user = <?php echo $_SESSION["user_name"];?>;
	var $pass = <?php echo $_SESSION["user_pass"];?>;
	
	$(function(){	
		
		get_user_area();
				
		$("#submit").click(user_area_submit);	
	})	

	function get_user_area(){

		var datas="action=user_area_get&user="+$user+"&pass="+$pass;
		
		$.ajax({
			url:"send.php",
			data: datas,
			type:"post",
			dataType:"json",
     	success: function (data) {
     		if(data.ok == 0)
     		{    			
      		$("#user_area").val(data.user_area);
      	}
      
      }
    });
	}
	function user_area_submit(){
		
		var user_area = $("#user_area").val();	
		var datas="action=user_area_submit&user="+$user+"&pass="+$pass+"&user_area="+user_area;
		
		$.ajax({
			url:"send.php",
			data: datas,
			type:"post",
			dataType:"json",
     	success: function (data) {

     		if(data.ok == 0)
     		{
      		alert("保存成功");
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
    <li><a href="#">所在地区设置</a></li>
    </ul>
    </div>
    
    <div class="formbody">
    
    <div class="formtitle"><span>所在地区设置</span></div>
    
    <ul class="forminfo">
    	<li><label>所在地市:</label><input id="user_area" type="text" class="dfinput" /><i></i></li> 
    	<li><label>&nbsp;</label><input id="submit" type="button" class="btn" value="保存"/></li>
    	
   
    	<!--
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
