<?php
//ini_set('display_errors','On');
include "config.php";

$retvalue = 0;

if(isset($_POST["file"]))
{  
  $file = $_POST["file"];
  $file_name = $file;
}
if(isset($_POST["vm"])){
  $voicemail_ext = $_POST["vm"];	
}

$file_dir = $VoiceMailPath."$voicemail_ext/INBOX/".$file_name;
$file_txt = str_replace(".wav",".txt",$file_dir);

if (!file_exists($file_dir)) {
	$retvalue = 0;
}else{
	
  if ( unlink($file_dir) && unlink($file_txt) ){
  	   $retvalue = 1;
  }else{
  	   $retvalue = 0;
	}


}

echo $retvalue;
exit;

?>
