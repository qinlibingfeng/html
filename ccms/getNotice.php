<?php
require("dbconnect.php");
mysql_query("SET NAMES 'UTF8'");
$id = $_POST['id'];
$sql = "select title,content,date from ccms_notice where id='$id'";
$rslt = mysql_query($sql,$link);

while($row = mysql_fetch_row($rslt)){
    echo "<table width=\"950\" height=\"420\" border=\"0\">";
    echo " <tr>";
    echo "	<td height=\"30\"><div align=\"center\"><h5>$row[0]<h5></div></td>";
    echo " </tr>";	
    echo " <tr>";
    echo "	<td height=\"20\"><div align=\"center\">$row[2]</div></td>";
    echo " </tr>";
    echo " <tr>";
    echo "	<td align=\"left\" valign=\"top\">
<div>$row[1]</div></td>";
    echo " </tr>";
    echo " <tr>";
    echo "	<td height=\"20\"> </td>";
    echo " </tr>";
    echo "</table>";
}

?>