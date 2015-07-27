<?php 
require("config.ini.php"); 
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>欢迎登录后台管理系统</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="js/jquery.js"></script>
<script src="js/cloud.js" type="text/javascript"></script>

<script language="javascript">
	$(function(){
		
		$("#user_submit").click(user_login);	
			
	  $('.loginbox').css({'position':'absolute','left':($(window).width()-692)/2});
		$(window).resize(function(){  
	    $('.loginbox').css({'position':'absolute','left':($(window).width()-692)/2});
	    })  
	});  


	function user_login(){
		
		var $user = $("#user_name").val();
		var $pass = $("#user_pass").val();
		var $datas="action=user_login&user="+$user+"&pass="+$pass;
		
		$.ajax({
			url:"send.php",
			data: $datas,
			type:"post",
			dataType:"json",
     	success: function (data) {

     		if(data.ok == 0)
     		{
      		document.location.href='main.php';
      	}else{
      		alert("用户名或密码错误");
      	}
      
      }
    });
	}
</script> 

</head>

<body style="background-color:#1c77ac; background-image:url(images/light.png); background-repeat:no-repeat; background-position:center top; overflow:hidden;">



    <div id="mainBody">
      <div id="cloud1" class="cloud"></div>
      <div id="cloud2" class="cloud"></div>
    </div>  


<div class="logintop">    
    <span>欢迎登录后台管理界面平台</span>    
    <ul>
    <li><a href="#">回首页</a></li>
    <li><a href="#">帮助</a></li>
    <li><a href="#">关于</a></li>
    </ul>    
    </div>
    
    <div class="loginbody">
    
    <span class="systemlogo"></span> 
       
    <div class="loginbox">
    
    <ul>
    <li><input id="user_name" type="text" class="loginuser" /></li>
    <li><input id="user_pass" type="password" class="loginpwd"/></li>
    <li><input id="user_submit" type="button" class="loginbtn" value="登录"   /></li>
    </ul>
    
    
    </div>
    
    </div>
    
    
    
    <div class="loginbm">版权所有  2015  <a href="http://www.djhjzx.com">djhjzx.com</a> </div>
	
    
</body>
<?php
if (strtolower(trim($_REQUEST["action"]))=="logout"){
	exitUser();
}
?> 
</html>
