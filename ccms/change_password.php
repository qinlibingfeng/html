<?php
	require("dbconnect.php");

//echo "username:".$username."<br>";
//echo "password:".$pass_word."<hr>";
if($_GET['atction'] == 'update_user_password'){
	if (isset($_GET["user_name"]))
	{
		$username=trim($_GET["user_name"]);
	}
	elseif (isset($_POST["user_name"]))
	{
		$username=trim($_POST["user_name"]);
	}
	if (isset($_GET["pwd"]))
	{
		$pass_word=trim($_GET["pwd"]);
	}
	elseif (isset($_POST["pwd"]))
	{
		$pass_word=trim($_POST["pwd"]);
	}
	if(!empty($pass_word) && !empty($username))
	{
		$select_users = "select user from vicidial_users where user='$username'";
		$rslt=mysql_query($select_users, $link);
		$row=mysql_fetch_row($rslt);
		$user =	$row[0];
//		echo "user:".$user;
		if(empty($user))
		{
			echo "0";
		}
		else
		{
			$change_pass = "update vicidial_users set pass='$pass_word' where user='$username'";
			$rslt=mysql_query($change_pass, $link);
			$row=mysql_fetch_row($rslt);
			echo "1";
		}
	}
	elseif(empty($username))
	{
		echo "0";
	}
	elseif(empty($pass_word))
	{
		echo "0";
	}

}

?>