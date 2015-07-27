<?php
error_reporting(E_ALL || ~E_NOTICE);

if(!isset($_SESSION)) { 
	session_start(); 
}

//编码
header("content-type:text/html;charset=utf-8");

//结束用户的会话状态
function exitUser(){
	 
	session_unregister('user_name');
	session_unregister('user_pass');

	//DropCookie('agentid');
	//DropCookie('LoginTime');
	$_SESSION = array();
	session_unset();
    session_destroy();
}

function check_login(){
	 
	if ($_SESSION["user_name"]==""){
		echo ("<script>setTimeout(\"parent.location.href='login.php?action=logout';\",5)</script>");
		die();
	}	
}

?>
