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
		
		//get_user_area();
				
		$("#submit").click(user_area_submit);	
	})	



	function user_area_submit(){
	
		var server_IP = $("#server_IP").val();
		var server_Mask = $("#server_Mask").val();
		var server_Gatway = $("#server_Gatway").val();

		if(server_IP.length==0 || server_Mask==0 || server_Gatway==0){
			 alert("输入框不能为空!");
			 //document.input.t1.focus();
			 return false;
		}
		if(server_IP.length<7 || server_Mask.length<7  || server_Gatway.length<7 || server_IP.length > 15 || server_Mask.length > 15 ||server_Gatway.length > 15)
		{
			 alert("您输入的信息不符合要求");
			 //document.input.t1.focus();
			 return false;
		}
		

		//alert(server_IP + ' ' + server_Mask +' '+ server_Gatway);
		//if(confirm("你确定要修改服务器IP吗?"))
		//{
			//if(confirm("请核实你要修改的信息："+'\n'+"IP："+server_IP+'\n'+"Mask："+ server_Mask +'\n'+"Gatway：" + server_Gatway))
			//{
				//alert("注意"+'\n'+"提交后您的服务器需要重启！！");
				var datas="action=change_server_IP&user="+$user+"&pass="+$pass+"&server_IP="+server_IP+"&server_Mask="+server_Mask+"&server_Gatway="+server_Gatway;
				
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
			//}
		//}

	}



</script>

</head>

<body>

  
	<div class="place">
    <span>位置：</span>
    <ul class="placeul">
    <li><a href="#">首页</a></li>
    <li><a href="#">服务器ip设置</a></li>
    </ul>
    </div>
    
	<form name="input" action="3.php" method="get">
    <div class="formbody">
    <div class="formtitle"><span>服务器ip设置</span></div>
    
    <ul class="forminfo">
    	<li><label>IP地址:</label><input id="server_IP" name="server_IP" type="text" class="dfinput" /><i></i></li>
		<li><label>子网掩码:</label><input id="server_Mask" type="text" class="dfinput" /><i></i></li> 
		<li><label>网关:</label><input id="server_Gatway" type="text" class="dfinput" /><i></i></li> 
    	<li><label>&nbsp;</label><input id="submit" type="button" class="btn" value="提交"/></li>
    </ul>
    </div>
	</form>


</body>

</html>
