<?php

	if (isset($_GET["action"]))	{$action=$_GET["action"];}
					elseif (isset($_POST["action"]))	{$action=$_POST["action"];}

	if (isset($_GET["user"]))	{$user=$_GET["user"];}
					elseif (isset($_POST["user"]))	{$user=$_POST["user"];}

	if (isset($_GET["pass"]))	{$pass=$_GET["pass"];}
					elseif (isset($_POST["user"]))	{$pass=$_POST["pass"];}					

	if (isset($_GET["phone"]))	{$phone=$_GET["phone"];}
					elseif (isset($_POST["phone"]))	{$phone=$_POST["phone"];}									
	
	if (isset($_GET["ser_ip"]))	{$ser_ip=$_GET["ser_ip"];}
					elseif (isset($_POST["ser_ip"]))	{$ser_ip=$_POST["ser_ip"];}											
					
$ret = array("ok"=>'1');
//
//$ser_ip="172.17.1.90";
//echo $ser_ip."$$$$$$$$$$\n";

switch($action){
	
	case "tel" :	
		$url= "http://$ser_ip/ccms/vicidial_interface.php?action=Tel&user=$user&pass=$pass&phone=$phone";
		$ret["ok"] = file_get_contents($url);
		echo  json_encode($ret);
		break;
		
	case "getNumber" :	
		$url= "http://$ser_ip/ccms/vicidial_interface.php?action=GetNumber&user=$user&pass=$pass";
		$number = file_get_contents($url);
		$ret["ok"] = 'ok';
		$ret["number"] = $number;
		echo  json_encode($ret);
		break;
	case "ready":	
		$url= "http://$ser_ip/ccms/vicidial_interface.php?action=Ready&user=$user&pass=$pass";
		$ret["ok"] = file_get_contents($url);
		echo  json_encode($ret);
	break;
	case "pause":	
		$url= "http://$ser_ip/ccms/vicidial_interface.php?action=Pause&user=$user&pass=$pass";
		$ret["ok"] = file_get_contents($url);
		echo  json_encode($ret);	
	break;
	case "logout":	
		$url= "http://$ser_ip/ccms/vicidial_interface.php?action=Logout&user=$user&pass=$pass";
		$ret["ok"] = file_get_contents($url);
		echo  json_encode($ret);		
	break;
	case "login":	
		$url= "http://$ser_ip/ccms/vicidial_interface.php?action=Login&user=$user&pass=$pass";
		$ret["ok"] = file_get_contents($url);
		echo  json_encode($ret);			
	break;
	/*case "recordlist":	
		$url= "http://$ser_ip/ccms/vicidial_interface.php?action=RecordList&user=$user&pass=$pass";
		$ret["ok"] = file_get_contents($url);
		echo  json_encode($ret);			
	break;*/
	case "getip":			
		$ret["ok"] = 'ok';
		$ret["ip"] = gethostbyname($_SERVER["SERVER_NAME"]);  
		echo  json_encode($ret);			
	break;	
}		
		
	      



?>