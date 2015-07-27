<?php
/** Send the output header and invoke function for contents output */
header("Content-Disposition:attachment;filename=report.csv");
header("Content-Type:text/csv;charset=utf8");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT" );
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT" );
header("Cache-Control: post-check=0, pre-check=0", false );
echo(chr(239).chr(187).chr(191));


$str_header = array("Path","Report Name","Count");
$line = implode("\",\"",$str_header);
$line = "\"" .$line;
$line .= "\"\r\n";

require("dbconnect_report.php");
$sql = "select path,reportfile,count(*) as count from ccms_report_analyse group by path,reportfile;";

$res = mysql_query($sql,$link);
if ( $res ){
	  while ( $row = mysql_fetch_assoc($res) ){
				$line .= "\"" . $row["path"] . "\",\"" . $row["reportfile"] . "\",\"" . $row["count"] . "\"\r\n";
	  }

}

echo $line;

?>