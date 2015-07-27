<?php
require("config.ini.php"); 

require("../agc_cn/dbconnect.php");

	if (isset($_GET["action"]))	{$action=$_GET["action"];}
					elseif (isset($_POST["action"]))	{$action=$_POST["action"];}

	if (isset($_GET["user"]))	{$user=$_GET["user"];}
					elseif (isset($_POST["user"]))	{$user=$_POST["user"];}

	if (isset($_GET["pass"]))	{$pass=$_GET["pass"];}
					elseif (isset($_POST["user"]))	{$pass=$_POST["pass"];}					

	if (isset($_GET["user_area"]))	{$user_area=$_GET["user_area"];}
					elseif (isset($_POST["user_area"]))	{$user_area=$_POST["user_area"];}					
											
	if (isset($_GET["file_name"]))	{$file_name=$_GET["file_name"];}
					elseif (isset($_POST["file_name"]))	{$file_name=$_POST["file_name"];}			
													
	if (isset($_GET["op"]))	{$op=$_GET["op"];}
					elseif (isset($_POST["op"]))	{$op=$_POST["op"];}													
					
$ret = array("ok"=>'0');
$campaigns_id = $_SESSION["campaign_id"];
$upload_path = 'attachment';

function keepUser($use_rname, $user_pass){
 	if($use_rname != ''){
		
		$_SESSION["user_name"] = $use_rname;
		$_SESSION["user_pass"] = $user_pass;
		$_SESSION["campaign_id"] = "edu";
		
  	return 1;
	}else{
		return 0;
	}
}


function authUser($linkV, $user, $pass)
{
		$stmt="select count(*) from vicidial_users where user = '$user' and pass = '$pass'";
		$rslt=mysql_query($stmt, $linkV);
		if ($DB) {echo "$stmt\n";}
		if (!$rslt) {die('Could not execute: ' . mysql_error());}
		$row=mysql_fetch_row($rslt);
		$count = $row[0];
	
		if ($count > 0)
		{
			keepUser($user, $pass);
			return 0;
		}else
		{
			return 1;
		}	
}
function get_area($linkV, $campaigns_id)
{
		$campaigns_id = $_SESSION["campaign_id"];
		$stmt="select area_code from data_campaigns_area where campaigns_id = '$campaigns_id'";
		
		$rslt=mysql_query($stmt, $linkV);
		if ($DB) {echo "$stmt\n";}
		if (!$rslt) {die('Could not execute: ' . mysql_error());}
		$row=mysql_fetch_row($rslt);
		$area_code = $row[0];

		
		return $area_code;

}
		
function submit_area($linkV, $campaigns_id, $user_area)
{
		
		$stmt="select count(*) from data_campaigns_area where campaigns_id = '$campaigns_id'";
		
		$rslt=mysql_query($stmt, $linkV);
		if ($DB) {echo "$stmt\n";}
		if (!$rslt) {die('Could not execute: ' . mysql_error());}
		$row=mysql_fetch_row($rslt);
		$count = $row[0];
	
		if ($count > 0)
		{
			$stmt="update data_campaigns_area set area_code='$user_area' where campaigns_id = '$campaigns_id'";
		}else
		{
			$stmt="insert into data_campaigns_area(campaigns_id, area_code) values('$campaigns_id', '$user_area')";
		}
		$rslt=mysql_query($stmt, $linkV);
		if ($DB) {echo "$stmt\n";}
		if (!$rslt) {die('Could not execute: ' . mysql_error());}
		
		return 0;

}
	
switch($action){
	
	case "user_login" :	
		
		$ret["ok"] = authUser($link, $user, $pass);
		echo  json_encode($ret);
		break;
	case "user_area_get" :	
		
		$ret["ok"] = 0;
		$ret["user_area"] = get_area($link, $campaigns_id);
		echo  json_encode($ret);
		break;		
	case "user_area_submit" :	
	
		$ret["ok"] = submit_area($link, $campaigns_id, $user_area);
		echo  json_encode($ret);
		break;	
		
	case "user_shell" :	
	
		system("sudo sh sh/user_shell.sh $op > /tmp/result");
		
		$fp = fopen("/tmp/result",'r');
		
		$ret["ok"] = 0;
		$ret["result"] = '';
		
		while(!feof($fp)) 
		{ 
			$ret["result"] .= fgets($fp); 
		} 
		fclose($fp); 
		echo  json_encode($ret);
		break;	
		
	case "user_update_upload" :	
		//$file_info = var_export($_FILES,true);
		//$ok = file_put_contents("attachment/file_info.txt",$file_info);

		$upFilePath = "$upload_path/".$_FILES['tar']['name'];
		$ok=move_uploaded_file($_FILES['tar']['tmp_name'],$upFilePath);
		if($ok === false){
			$ret["ok"] = 1;
		  $ret["result"]='上传失败';
		}else{
			$ret["ok"] = 0;
		  $ret["result"]='上传成功';
		  $ret["filename"]=$_FILES['tar']['name'];
	 	}
	 	echo  json_encode($ret);
	 break;
	 	
/*	 	
	case "user_check_ini" :	

		system("cd sh && sh update.sh -t ../$upload_path".$file_name." > result");
	
		$fp = fopen("sh/result",'r');	
		$ret["ok"] = 0;
		$ret["result"] = '';
		
		while(!feof($fp)) 
		{ 
			$ret["result"] .= fgets($fp); 
		} 
		fclose($fp); 
		echo  json_encode($ret);
	break;		
	case "user_update_ini" :	

		system("cd sh && sh update.sh -f ../$upload_path/".$file_name." > result");
	
		$fp = fopen("sh/result",'r');	
		$ret["ok"] = 0;
		$ret["result"] = '';
		
		while(!feof($fp)) 
		{ 
			$ret["result"] .= fgets($fp); 
		} 
		fclose($fp); 
		echo  json_encode($ret);
	break;
	*/
	case "user_update_sh" :	

		system("cd sh && sudo sh user_update.sh ".$file_name." > /tmp/sh_result 2>&1");
	
		$fp = fopen("/tmp/sh_result",'r');	
		$ret["ok"] = 0;
		$ret["result"] = '';
		
		while(!feof($fp)) 
		{ 
			$ret["result"] .= fgets($fp); 
		} 
		fclose($fp); 
		echo  json_encode($ret);
	break;		 	
			 					
		
		
}		
		
	      



?>