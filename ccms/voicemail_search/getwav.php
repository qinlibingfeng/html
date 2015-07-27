<?
include "config.php";


if(isset($_GET["file"]))
{  
  $file = $_GET["file"];
  $file_name = $file;
}
$voicemail_ext = $_GET["vm"];

$file_dir = $VoiceMailPath."$voicemail_ext/INBOX/".$file_name;
if (!file_exists($file_dir)) { 
	echo "Cannot find the voice mail wav file.";
	exit;
} else {

	$file = fopen($file_dir,"r"); 

	Header("Content-type: application/octet-stream");
	Header("Accept-Ranges: bytes");
	Header("Accept-Length: ".filesize($file_dir));
	Header("Content-Disposition: attachment; filename=" . $file_name);

	echo fread($file,filesize($file_dir));
	fclose($file);
}
?>
