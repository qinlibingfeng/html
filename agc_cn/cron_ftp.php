<?php
require("../inc/config.ini.php");


if(!$db_host){$db_host="localhost";}
if(!$db__name){$db__name="asterisk";}
if(!$db__user){$db__user="cron";}
if(!$db__pass){$db__pass="1234";}

$db_conn = mysqli_connect("$db_host","$db__user","$db__pass");
 
if (!$db_conn){
	
	$json_data="{";
	$json_data=$json_data."\"counts\":\"0\",";
	$json_data=$json_data."\"des\":\"database_error\"";
	$json_data=$json_data."}";
	
	echo $json_data;
	die();
}
mysqli_select_db($db_conn,$db__name);
mysqli_query($db_conn,"SET NAMES utf8"); 
 
if(file_exists("/etc/astguiclient.conf")){

	$FTPagc = file("/etc/astguiclient.conf");
	foreach ($FTPagc as $FTPline){
		$FTPline = preg_replace("/ |>|\n|\r|\t|\#.*|;.*/","",$FTPline);
		
		if (ereg("^PATHDONEmonitor", $FTPline)){
			$PATHDONEmonitor = $FTPline;
			$PATHDONEmonitor = preg_replace("/.*=/","",$PATHDONEmonitor);
		}
		if (ereg("^VARFTP_host", $FTPline)){
			$VARFTP_host = $FTPline;
			$VARFTP_host = preg_replace("/.*=/","",$VARFTP_host);
		}
		if (ereg("^VARFTP_user", $FTPline)){
			$VARFTP_user = $FTPline;
			$VARFTP_user = preg_replace("/.*=/","",$VARFTP_user);
		}
		if (ereg("^VARFTP_pass", $FTPline)){
			$VARFTP_pass = $FTPline;
			$VARFTP_pass = preg_replace("/.*=/","",$VARFTP_pass);
		}
		if (ereg("^VARFTP_port", $FTPline)){
			$VARFTP_port = $FTPline;
			$VARFTP_port = preg_replace("/.*=/","",$VARFTP_port);
		}
		 
		if (ereg("^VARHTTP_path", $FTPline)){
			$VARHTTP_path = $FTPline;
			$VARHTTP_path = preg_replace("/.*=/","",$VARHTTP_path);
		}
	}
 	
	$ftp_conn=ftp_connect($VARFTP_host,$VARFTP_port);                
	$ftp_result=ftp_login($ftp_conn,$VARFTP_user,$VARFTP_pass); 
	 
	if($ftp_result){
		$today=date("Y-m-d");
		
		ftp_mkdir($ftp_conn,$today);
		ftp_chdir($ftp_conn,$today);
		
		$file_dir="$PATHDONEmonitor/GSW/";
		
		$dh = opendir($file_dir);
		$i=0;
		$file_names="";
		if($dh){
			 
			while($file = readdir($dh)){
				if ($file != "." && $file != "..") {
				   $i++;
					
				   if(ftp_put($ftp_conn,$file,$file_dir.$file,FTP_BINARY,0)){
 						
						$file_names.="'".str_replace("-all.wav","",$file)."',";
						 
						rename($file_dir.$file,"$PATHDONEmonitor/FTP/".$file);
						//echo "suc $file\n";
					}else{
						echo "err $file\n";
					}
					
					if ($i % 50 == 0){
						//echo "mod\n";
						sleep(1);
					}
 					
				}
			} 
			
			if($file_names!=""){
				$file_names=substr($file_names,0,-1);
				$up_sql="UPDATE recording_log set location=concat('$VARHTTP_path/$today/',filename,'-all.wav') where filename in($file_names);";
				
				mysqli_query($db_conn,$up_sql); 
 				
			}
		}
		
		closedir($dh);  
		echo "closedir\n";
		
		ftp_close($ftp_conn); 
		echo "suc_all\n";
		
	}else{
		echo "ftp login fail\n";	
	}
 
}else{
	echo "open conf fail\n";	
}

unset($up_sql); 
unset($file_names); 
 
mysqli_close($db_conn);
unset($db_conn);  
?> 
