<?php
	require("dbconnect.php");
	$stmt="SELECT ccms_url from system_settings";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);

	$ccms_url =	$row[0];
	$action = $_REQUEST['action'];

	if (isset($_GET["action"]))
	{
		$action=trim($_GET["action"]);
	}
	elseif (isset($_POST["action"]))
	{
		$action=trim($_POST["action"]);
	}	
	//修改用户密码API update_user_password
	if($action == 'update_user_password')
	{
		if (isset($_GET["user"]))
		{
			$username=trim($_GET["user"]);
		}
		elseif (isset($_POST["user"]))
		{
			$username=trim($_POST["user"]);
		}
		if (isset($_GET["password"]))
		{
			$pass_word=trim($_GET["password"]);
		}
		elseif (isset($_POST["password"]))
		{
			$pass_word=trim($_POST["password"]);
		}

//		echo "username:".$username."<br>";
//		echo "password:".$pass_word."<hr>";

		if(!empty($pass_word) && !empty($username))
		{
			$select_users = "select user from vicidial_users where user='$username'";
			$rslt=mysql_query($select_users, $link);
			$row=mysql_fetch_row($rslt);
			$user =	$row[0];
//			echo "user:".$user;
			if(empty($user))
			{
				echo "0";//CCMS 系统不存在该用户！;
			}
			else
			{
				$change_pass = "update vicidial_users set pass='$pass_word' where user='$username'";
				$rslt=mysql_query($change_pass, $link);
				$row=mysql_fetch_row($rslt);
				echo "1";//密码更改成功！;
			}
		}
		elseif(empty($username))
		{
			echo "2";//用户名不能为空！;
		}
		elseif(empty($pass_word))
		{
			echo "3";//密码不能为空！;
		}
	}
	//点击拨号API external_dial
	if($action == "external_dial"){
		$agent_user = $_REQUEST['user_name'];
		$agent_pwd  = $_REQUEST['password'];
		$phone_num  = $_REQUEST['dst_phone'];
		$source	    = $_REQUEST['source'];
		$first_name = $_REQUEST['first_name'];
		$last_name  = $_REQUEST['last_name'];
		//var_dump($_GET);exit;
		if(!empty($agent_user) &&!empty($agent_pwd) &&!empty($phone_num) &&!empty($source)){
			
			//file($ccms_url."agc/api.php?source=csc&user=admin&pass=123456&agent_user=".$agent_user."&function=external_pause&value=PAUSE");
			
			//file($ccms_url."agc/api.php?source=".$source."&user=".$agent_user."&pass=".$agent_pwd."&agent_user=".$agent_user."&function=external_add_lead&phone_number=".$phone_num."&phone_code=1&first_name=".$first_name."&last_name=".$last_name."&dnc_check=YES");
			$rs = file($ccms_url."agc/api.php?source=".$source."&user=admin&pass=123456&agent_user=".$agent_user."&function=external_dial&value=".$phone_num."&phone_code=&search=NO&preview=NO&focus=NO");
		
			if(strpos($rs[0],"paused")){
				echo 0;//"在暂停状态下才可外拨";
			}else{
				echo 1;//外拨成功
			}
		}else{
			echo "agent_user:$agent_user|agent_pwd:$agent_pwd |phone_num:$phone_num|source:$source";
		}
	}
	//内部拨打
	if($action == "internal_dial"){
		$user = $_REQUEST['user'];
		$campaign = $_REQUEST['campaign'];
		$phone = $_REQUEST['phone'];
		if(empty($user) || empty($campaign) || empty($phone)){
			echo "2";
			exit;
		}
		$stmt = "SELECT inbound_mode FROM vicidial_campaigns where campaign_id = '$campaign'";
		$rslt=mysql_query($stmt, $link);
		$row=mysql_fetch_row($rslt);
		$inbound_mode =	$row[0];
		if(empty($inbound_mode)){
			echo "0";
			exit;
		}else{
			if($inbound_mode == "auto"){
				//$phone = "93" . $phone;
			}
		}
		$rslt=mysql_query($stmt, $link);
		$row=mysql_fetch_row($rslt);
		
		$stmt = "select pass from vicidial_users where user='$user'";
		$rslt=mysql_query($stmt, $link);
		$row=mysql_fetch_row($rslt);
		$pass =	$row[0];

		if(empty($pass))
		{
			echo "0";//CCMS 系统不存在该用户！;
			exit;
		}else{

			$url = $ccms_url . "agc/api.php?source=" . $campaign . "&user=" . $user . "&pass=" . $pass . "&agent_user=" . $user . "&function=external_dial&value=" . $phone . "&phone_code=1&search=YES&preview=NO&focus=YES";
			//echo $url . "<br>";
			$rs = file($url);
			//echo $rs[0] . "<br>";
			if(strpos("--" . $rs[0],"SUCCESS")){
				echo 1;
			}else{
				echo 3;
			}
		}
	}
?>