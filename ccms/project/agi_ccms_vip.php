<?php
#ini_set('error_reporting', E_ALL);
#ini_set('display_errors','On');
require("dbconnect.php");

$num = trim($_GET["num"]);
$level = strtoupper(trim($_GET["level"]));

$log = 0;

if ( empty($num) || empty($level) ) {
     if ($log) message_logging("not params:$num|$level");
     echo "";
     exit;
} 

if ( trim($level) == "SYSTEM" ) {
       $stmt = "SELECT COUNT(*) as count FROM vicidial_dnc_inbound WHERE phone_number = '$num'";
       $rslt = mysql_query($stmt, $link);
       if ( $rslt ){
             $row = mysql_fetch_row($rslt);
             $count = $row[0];
             if ( $count >= 1 ){
                    if ($log) message_logging($level . "|" . $stmt);
                    echo "DNC";
                    exit;
             }
          }
}else{
       $stmt = "SELECT COUNT(*) as count FROM vicidial_campaign_dnc_inbound WHERE phone_number = '$num' and campaign_id = '$level'";
       
       $rslt = mysql_query($stmt, $link);
       if ( $rslt ){
             $row = mysql_fetch_row($rslt);
             $count = $row[0];
             if ( $count >= 1 ){
                    if ($log) message_logging($level . "|" . $stmt);
                    echo "DNC";
                    exit;
             }
          } 
}

if ($log) message_logging("not find phone_number:$num|$level" );
echo "";

function message_logging($message){

    $strdate = date("Y-m-d");
    $curtime = date("Y-m-d H:i:s");
    $AGILOGfile = "./ccms_vip.$strdate";
    
  $efp = fopen ($AGILOGfile, "a");
  fwrite ($efp, "$curtime|agi_ccms_vip.php|++++$message+++\r\n");
    fclose($efp);
            
}

?> 