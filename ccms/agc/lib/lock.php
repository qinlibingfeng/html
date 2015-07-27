<?php
//如果用户没有登录而试图进入网站，回到系统登录界面
$session = new Session();
//if(!$session->IsRegistered('GLOBAL_SESSION_USER_ID'))
//{
//	$sLoginString = <<<EOD
//<script language="javascript">
//<!--
//	top.location.href ="/";
//-->
//</script>
//EOD;
//die($sLoginString);
//}
?>