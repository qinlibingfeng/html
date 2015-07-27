<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <title>CCMS Report Analyse</title>
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

	<script>
	function small_menu_openwindow(url)
			{
			var wd_url=url;
			var wd_width=600;
			var wd_height=800;
			var wd_top= (screen.availHeight - 800 )/2;
			var wd_left= ( screen.availWidth - 300)/2;
			var wd_toolbar=0;
			var wd_menubar="no";
			var wd_scrollbars="YES";
			var wd_resizable="YES";
			var wd_location="no";
			var wd_status="no"; 

			window.open (wd_url, '', 'height='+wd_height+', width='+wd_width+', top='+wd_top+', left='+wd_left+', toolbar='+wd_toolbar+', menubar='+wd_menubar+', scrollbars='+wd_scrollbars+', resizable='+wd_resizable+',location='+wd_location+', status='+wd_status);
			
			}
</script>
	
</head>
<body bgcolor="#ffffff">   	
	

<?php 
# report_count.php
$version = '2.2.0-52';
$build = '100303-0930';

require("dbconnect_report.php");

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

$sql = "select path,reportfile,count(*) as count from ccms_report_analyse group by path,reportfile;";

$res = mysql_query($sql,$link);
?>
    <table border="0" cellpadding="1" cellspacing="1" bgcolor="#707070" width="100%" >
		<thead>
         <tr class=tr_bg_color>
    	 	<td colspan="4" height="20"><font size="1" color="white"><b>Report Analyse</b> </font> <a href="report_export.php">Export</a></td>
  		 </tr>
		 <tr bgcolor='#c2c2c2'>
	  <!-- <td width="120"><b>Call ID</b></td> -->
		   <td width="10%" align="center" style="word-wrap:break-word;"><b>Path</b></td>
		   <td width="70%" align="center" style="word-wrap:break-word;"><b>Report Name</b></td>
		   <td width="10%" align="center" style="word-wrap:break-word;"><b>Count</b></td>
		   <td width="10%" align="center" style="word-wrap:break-word;"><b>Detail</b></td>
		  </tr>
		  </thead>

<?php 

if ( $res ){
	  while ( $row = mysql_fetch_assoc($res) ){
	  	  echo "<tr bgcolor='#ffffff' align='left'  style='cursor:default'><td>" . $row["path"] . "</td><td>" . $row["reportfile"] . "</td><td>" .  $row["count"] . "</td>";
	  	  echo "<td>" . "<a onclick='javascript:small_menu_openwindow(\"report_detail_count.php?reportpath=" . $row["path"] . "&reportfile=" . $row["reportfile"] . "\")' href='#'>View" . "</a></td>";
	  	  echo "</tr>";
	  	      
	  }

}

echo "</table>";
?>
</body>
</html>