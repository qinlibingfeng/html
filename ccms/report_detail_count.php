<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <title>CCMS Report Analyse Detail</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="index.files/style.css" />
<style type="text/css">
<!--
.STYLERED {
	font-size: small;
	color: #FF0000;
	font-family: "";
}
html{overflow-x:hidden;}
-->
</style>


	
</head>
<body bgcolor="#ffffff">   	
	

<?php 
# report_count.php
$version = '2.2.0-52';
$build = '100303-0930';

require("dbconnect_report.php");


if (isset($_GET["reportpath"]))			{$reportpath = $_GET["reportpath"];}
	elseif (isset($_POST["reportpath"]))	{$reportpath = $_POST["reportpath"];}
	
if (isset($_GET["reportfile"]))			{ $reportfile = $_GET["reportfile"];}
	elseif (isset($_POST["reportfile"]))	{$reportfile = $_POST["reportfile"];}
	
	
#############################################
##### START SYSTEM_SETTINGS LOOKUP #####
$stmt = "SELECT use_non_latin FROM system_settings;";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$qm_conf_ct = mysql_num_rows($rslt);
if ($qm_conf_ct > 0){
	$row=mysql_fetch_row($rslt);
	$non_latin =					$row[0];
}
	
if ($non_latin > 0) { $rslt=mysql_query("SET NAMES 'UTF8'");}

$reporttime = date("Y-m-d H:i:s",time());

$sql = "select path,reportfile,reporttime,starttime,endtime,ipaddress from ccms_report_analyse where path='$reportpath' and reportfile='$reportfile' order by reporttime";

$res = mysql_query($sql,$link);
?>
    <table border="0" cellpadding="1" cellspacing="1" bgcolor="#707070" width="100%" >
		<thead>
         <tr class=tr_bg_color>
    	 	<td colspan="4" height="20"><font size="1" color="white"><b>Report Analyse Detail</b></font></td>
  		 </tr>
         <tr bgcolor='#c2c2c2'>
    	 	<td colspan="4" height="20"><font size="1" color="white"><b><?php echo $reportpath . "/". $reportfile; ?></b></font></td>
  		 </tr>  		 
		 <tr bgcolor='#c2c2c2'>
	  <!-- <td width="120"><b>Call ID</b></td> -->
		   <td width="10%" align="center" style="word-wrap:break-word;"><b>Report Date</b></td>
		   <td width="10%" align="center" style="word-wrap:break-word;"><b>Start Date</b></td>
		   <td width="10%" align="center" style="word-wrap:break-word;"><b>End Date</b></td>
		   <td width="10%" align="center" style="word-wrap:break-word;"><b>Client IP</b></td>		   
		  </tr>
		  </thead>

<?php 

if ( $res ){
	  while ( $row = mysql_fetch_assoc($res) ){
	  	  echo "<tr bgcolor='#ffffff' align='left'  style='cursor:default'><td>" . $row["reporttime"] . "</td><td>" . $row["starttime"] . "</td><td>" .  $row["endtime"] . "</td><td>" .  $row["ipaddress"] . "</td>";
	  	  echo "</tr>";
	  	      
	  }

}

echo "</table>";
?>
</body>
</html>