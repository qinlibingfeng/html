<?php
//下面是数据库连接信息，修改为你自己的即可
$host = localhost ;
$user = cron;
$pwd = 1234;
$db = MyDB;

#连接数据库，服务器，用户名和密码都由SAE提供
$link = mysql_connect($host, $user, $pwd);
if(!$link) {
	echo "mysql connect error: ", mysql_error();
	exit;
}
#选择要使用的数据库
mysql_select_db($db);

#设定编码
mysql_query("set names utf8");


?>
