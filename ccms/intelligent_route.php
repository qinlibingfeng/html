<?php
if (isset($_GET["action"]))				{$action=$_GET["action"];}
	elseif (isset($_POST["action"]))		{$action=$_POST["action"];}
if (isset($_GET["intelligent_route_name"]))				{$intelligent_route_name=$_GET["intelligent_route_name"];}
	elseif (isset($_POST["intelligent_route_name"]))		{$intelligent_route_name=$_POST["intelligent_route_name"];}
if (isset($_GET["get_url"]))				{$get_url=$_GET["get_url"];}
	elseif (isset($_POST["get_url"]))		{$get_url=$_POST["get_url"];}
if (isset($_GET["description"]))				{$description=$_GET["description"];}
	elseif (isset($_POST["description"]))		{$description=$_POST["description"];}
if (isset($_GET["route_id"]))				{$route_id=$_GET["route_id"];}
	elseif (isset($_POST["route_id"]))		{$route_id=$_POST["route_id"];}
if (isset($_GET["route_name"]))				{$route_name=$_GET["route_name"];}
	elseif (isset($_POST["route_name"]))		{$route_name=$_POST["route_name"];}
if (isset($_GET["default_option"]))				{$default_option=$_GET["default_option"];}
	elseif (isset($_POST["default_option"]))		{$default_option=$_POST["default_option"];}
if (isset($_GET["confirm"]))				{$confirm=$_GET["confirm"];}
	elseif (isset($_POST["confirm"]))		{$confirm=$_POST["confirm"];}	
if($action == "del"){
	if($confirm=="no"){
		echo "<br><br><a href=\"$PHP_SELF?ADD=1500099&route_id=$route_id&action=del&confirm=yes\">Click here to delete this route</a>\n";
		$action = "modify";
	}else{
		$stmt="DELETE from ccms_intelligent_route where intelligent_route_id='$route_id';";
		$rslt=mysql_query($stmt, $link);
		$stmt="DELETE from ccms_intelligent_route_options where intelligent_route_option_id='$route_id';";
		$rslt=mysql_query($stmt, $link);
		$action = "";
	}

}
if($action == ""){
	echo "<TABLE><TR><TD>\n";
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT intelligent_route_id,intelligent_route_name,get_url from ccms_intelligent_route";
	$rslt=mysql_query($stmt, $link);
	$menus_to_print = mysql_num_rows($rslt);

	echo "<br>Intelligent Route LISTINGS:\n";
	echo "<center><TABLE width=$section_width cellspacing=0 cellpadding=1>\n";
	echo "<TR class=tr_bg_color>";
	echo "<TD><font size=1 color=white>INTELLIGNET ROUTE ID</TD>";
	echo "<TD><font size=1 color=white>NAME</TD>";
	echo "<TD><font size=1 color=white>GET URL</TD>\n";
	echo "<TD><font size=1 color=white>MODIFY</TD>\n";
	echo "</TR>\n";

	$o=0;
	$route_id = $MT;

	while ($menus_to_print > $o) 
		{
		$row=mysql_fetch_row($rslt);
		$route_id[$o] =		$row[0];
		$intelligent_route_name[$o] =	$row[1];
		$get_url[$o] =	$row[2];
		$o++;
		}

	$o=0;
	while ($menus_to_print > $o) 
		{
		$stmt="SELECT count(*) from ccms_intelligent_route_options where route_id=\"$route_id[$o]\";";
		$rslt=mysql_query($stmt, $link);
		$row=mysql_fetch_row($rslt);
		if (eregi("1$|3$|5$|7$|9$", $o))
			{$bgcolor='bgcolor="#FFFFFF"';} 
		else
			{$bgcolor='bgcolor="#C2C2C2"';}
		echo "<tr $bgcolor><td><font size=1><a href=\"$PHP_SELF?ADD=1500099&action=modify&route_id=$route_id[$o]\">$route_id[$o]</a></td>";
		echo "<td><font size=1> $intelligent_route_name[$o]</td>";
		echo "<td><font size=1> $get_url[$o]</td>";
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=1500099&action=modify&route_id=$route_id[$o]\">MODIFY</a></td></tr>\n";
		$o++;
		}

	echo "</TABLE></center>\n";
}

	
if ($action == "save")
{
if ($LOGmodify_dids==1)
	{
		if(trim($intelligent_route_name)==""){
				echo "<br><b>Intelligent Route Name can't be empty!</b>";
				echo "<br><a href=\"\" onclick=\"window.history.back();return false;\">back</a>";
				exit;
		}
		
		//
		$intelligent_route_option_arr = array();
		$stmt = "select option_value from ccms_intelligent_route_options where intelligent_route_option_id='$route_id'";
		$rslt = mysql_query($stmt, $link);
		$intelligent_route_to_print = mysql_num_rows($rslt);
		$o=0;
		while ($intelligent_route_to_print > $o) {
			$row=mysql_fetch_row($rslt);
			$intelligent_route_option_arr[] = $row[0];
			$o++;
		}

		if($route_id == ""){
			$stmt="insert into ccms_intelligent_route(intelligent_route_name,get_url,description,default_option) values('$intelligent_route_name','$get_url','$description','$default_option');";
			$rslt=mysql_query($stmt, $link);
			$route_id = mysql_insert_id();
			echo "<br><B>Intelligent Route ADDED: $route_id</B>\n";
		}else{
			$stmt="UPDATE ccms_intelligent_route set intelligent_route_name='$intelligent_route_name',get_url='$get_url',description='$description',default_option='$default_option' where intelligent_route_id='$route_id';";
			$rslt=mysql_query($stmt, $link);
			echo "<br><B>Intelligent Route MODIFIED: $route_id</B>\n";
		}

		$h=0;
		$option_value_list='|';
		while ($h <= 18)
			{
			$option_value=''; $option_description=''; $option_route=''; $option_route_value=''; $option_route_value_context='';

			if (isset($_GET["option_value_$h"]))				{$option_value=$_GET["option_value_$h"];}
				elseif (isset($_POST["option_value_$h"]))		{$option_value=$_POST["option_value_$h"];}
			if (isset($_GET["option_description_$h"]))			{$option_description=$_GET["option_description_$h"];}
				elseif (isset($_POST["option_description_$h"]))	{$option_description=$_POST["option_description_$h"];}
			if (isset($_GET["option_route_$h"]))				{$option_route=$_GET["option_route_$h"];}
				elseif (isset($_POST["option_route_$h"]))		{$option_route=$_POST["option_route_$h"];}
			if (isset($_GET["option_route_value_$h"]))			{$option_route_value=$_GET["option_route_value_$h"];}
				elseif (isset($_POST["option_route_value_$h"]))	{$option_route_value=$_POST["option_route_value_$h"];}
			if (isset($_GET["option_route_value_context_$h"]))	{$option_route_value_context=$_GET["option_route_value_context_$h"];}
				elseif (isset($_POST["option_route_value_context_$h"]))	{$option_route_value_context=$_POST["option_route_value_context_$h"];}

			if ($option_route == "INGROUP")
				{
				if (isset($_GET["IGhandle_method_$h"]))				{$IGhandle_method=$_GET["IGhandle_method_$h"];}
					elseif (isset($_POST["IGhandle_method_$h"]))	{$IGhandle_method=$_POST["IGhandle_method_$h"];}
				if (isset($_GET["IGsearch_method_$h"]))				{$IGsearch_method=$_GET["IGsearch_method_$h"];}
					elseif (isset($_POST["IGsearch_method_$h"]))	{$IGsearch_method=$_POST["IGsearch_method_$h"];}
				if (isset($_GET["IGlist_id_$h"]))					{$IGlist_id=$_GET["IGlist_id_$h"];}
					elseif (isset($_POST["IGlist_id_$h"]))			{$IGlist_id=$_POST["IGlist_id_$h"];}
				if (isset($_GET["IGcampaign_id_$h"]))				{$IGcampaign_id=$_GET["IGcampaign_id_$h"];}
					elseif (isset($_POST["IGcampaign_id_$h"]))		{$IGcampaign_id=$_POST["IGcampaign_id_$h"];}
				if (isset($_GET["IGphone_code_$h"]))				{$IGphone_code=$_GET["IGphone_code_$h"];}
					elseif (isset($_POST["IGphone_code_$h"]))		{$IGphone_code=$_POST["IGphone_code_$h"];}

				$option_route_value_context = "$IGhandle_method,$IGsearch_method,$IGlist_id,$IGcampaign_id,$IGphone_code";
				}

			if ($non_latin < 1)
				{
				$option_value = ereg_replace("[^-\_0-9A-Z]","",$option_value);
				$option_description = ereg_replace("[^- \:\/\_0-9a-zA-Z]","",$option_description);
				$option_route = ereg_replace("[^-_0-9a-zA-Z]","",$option_route);
				$option_route_value = ereg_replace("[^-\/\|\_\#\*\,\.\_0-9a-zA-Z]","",$option_route_value);
				$option_route_value_context = ereg_replace("[^,-_0-9a-zA-Z]","",$option_route_value_context);
				}

			if (strlen($option_route) > 0)
				{
				$stmtA="SELECT count(*) from ccms_intelligent_route_options where intelligent_route_option_id='$route_id' and option_value='$option_value';";
				$rslt=mysql_query($stmtA, $link);
				$row=mysql_fetch_row($rslt);
				$option_exists = $row[0];

				if ($option_exists > 0)
					{
					$stmtA="UPDATE ccms_intelligent_route_options SET option_description='$option_description',option_route='$option_route',option_route_value='$option_route_value',option_route_value_context='$option_route_value_context' where intelligent_route_option_id='$route_id' and option_value='$option_value';";
					$rslt=mysql_query($stmtA, $link);
					$stmtAX .= "$stmtA|";
					}
				else
					{
					$stmtA="INSERT INTO ccms_intelligent_route_options SET intelligent_route_option_id='$route_id',option_value='$option_value',option_description='$option_description',option_route='$option_route',option_route_value='$option_route_value',option_route_value_context='$option_route_value_context';";
					$rslt=mysql_query($stmtA, $link);
					$stmtAX .= "$stmtA|";
					}
				}
			else
				{
				$stmtA="SELECT count(*) from ccms_intelligent_route_options where intelligent_route_option_id='$route_id' and option_value='$option_value';";
				$rslt=mysql_query($stmtA, $link);
				$row=mysql_fetch_row($rslt);
				$option_exists_db = $row[0];

				if ($option_exists_db > 0)
					{
					$stmtA="DELETE FROM ccms_intelligent_route_options where intelligent_route_option_id='$route_id' and option_value='$option_value';";
					$rslt=mysql_query($stmtA, $link);
					$stmtAX .= "$stmtA|";
					}
				}
			$option_value_list .= "$option_value|";
			$h++;
			}
		## delete existing database records that were not in the submit
		$h = 0;
		while ($h <= count($intelligent_route_option_arr))
			{
			if (!preg_match("/\|$intelligent_route_option_arr[$h]\|/i",$option_value_list))
				{
				$stmtA="SELECT count(*) from ccms_intelligent_route_options where intelligent_route_option_id='$route_id' and option_value='$intelligent_route_option_arr[$h]';";
				$rslt=mysql_query($stmtA, $link);
				$row=mysql_fetch_row($rslt);
				$option_exists_db = $row[0];

				if ($option_exists_db > 0)
					{
					$stmtA="DELETE FROM ccms_intelligent_route_options where intelligent_route_option_id='$route_id' and option_value='$intelligent_route_option_arr[$h]';";
					$rslt=mysql_query($stmtA, $link);
					$stmtAX .= "$stmtA|";
					$stmtA="update ccms_intelligent_route set default_option = null where intelligent_route_id = '$route_id' and default_option = '$intelligent_route_option_arr[$h]';";
					$rslt=mysql_query($stmtA, $link);
					}
				}
			$h++;
			}

		$stmtA="UPDATE servers set rebuild_conf_files='Y' where generate_vicidial_conf='Y' and active_asterisk_server='Y';";
		$rslt=mysql_query($stmtA, $link);
		$stmtAX .= "$stmtA|";

		$SQL_log = "$stmt|$stmtAX";
		$SQL_log = ereg_replace(';','',$SQL_log);
		$SQL_log = addslashes($SQL_log);
		$stmt="INSERT INTO vicidial_admin_log set event_date='$SQLdate', user='$PHP_AUTH_USER', ip_address='$ip', event_section='Intelligent Route', event_type='MODIFY', record_id='$route_id', event_code='ADMIN MODIFY ROUTE', event_sql=\"$SQL_log\", event_notes='';";
		if ($DB) {echo "|$stmt|\n";}
		$rslt=mysql_query($stmt, $link);

		$action = "modify";
	}
else
	{
	echo "You do not have permission to view this page\n";
	exit;
	}
$ADD=3511;	# go to IVR modification form below
}
	
if ($action == "modify")
{
if ($LOGmodify_dids==1)
	{

	echo "<TABLE><TR><TD>\n";
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";
	if($route_name){
		$stmt="SELECT intelligent_route_name,get_url,description,default_option,intelligent_route_id from ccms_intelligent_route where intelligent_route_name='$route_name';";
	}else{
		$stmt="SELECT intelligent_route_name,get_url,description,default_option,intelligent_route_id from ccms_intelligent_route where intelligent_route_id='$route_id';";
	}
	
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$intelligent_route_name = $row[0];
	$get_url = $row[1];
	$description = $row[2];
	$default_option = $row[3];
	$route_id = $row[4];
	$stmt = "SELECT option_value FROM ccms_intelligent_route_options where intelligent_route_option_id='$route_id'";
	$rslt=mysql_query($stmt, $link);
	$option_to_print = mysql_num_rows($rslt);
	$o=0;
	$option_Select_Str = "<select name=\"default_option\" id=\"default_option\" style=\"width:120px;\"><option value=\"\">NONE</option>";
	while ($option_to_print > $o) 
	{
		$row=mysql_fetch_row($rslt);
		if($default_option==$row[0]){
			$option_Select_Str = $option_Select_Str . "<option value=\"$row[0]\" selected>$row[0]</option>";
		}else{
			$option_Select_Str = $option_Select_Str . "<option value=\"$row[0]\">$row[0]</option>";
		}
		$o++;
	}
	$option_Select_Str = $option_Select_Str . "</select>";
	if($intelligent_route_name==""){
		$intelligent_route_name = "IB_";
	}
	echo "<br>MODIFY A Intelligent Route RECORD: $route_id<form action=$PHP_SELF method=POST name=admin_form id=admin_form>\n";
	echo "<input type=hidden name=ADD value=1500099>\n";
	echo "<input type=hidden name=action value=save>\n";
	echo "<input type=hidden name=route_id value=\"$route_id\">\n";
	echo "<center><TABLE width=$section_width cellspacing=3>\n";
	echo "<tr bgcolor=#FFFFFF><td align=right>Intelligent Route ID: </td><td align=left>$route_id</td></tr>\n";
	echo "<tr bgcolor=#FFFFFF><td align=right>Intelligent Route Name: </td><td align=left><input type=text name=intelligent_route_name size=40 maxlength=100 value=\"$intelligent_route_name\"></td></tr>\n";
	echo "<tr bgcolor=#FFFFFF><td align=right>Get URL: </td><td align=left><input type=text name=get_url size=40 maxlength=200 value=\"$get_url\"></td></tr>\n";
	echo "<tr bgcolor=#FFFFFF><td align=right>Intelligent Route Description: </td><td align=left><input type=text name=description size=40 maxlength=50 value=\"$description\"></td></tr>\n";
	echo "<tr bgcolor=#FFFFFF><td align=right>Default Option: </td><td align=left>$option_Select_Str</td></tr>\n";
	echo "<tr><td align=center colspan=2> <input type=submit name=SUBMIT value=SUBMIT> </td></tr>\n";
	echo "<tr bgcolor=#FFFFFF><td align=CENTER colspan=2> Intelligent Route Options: </td></tr>\n";

	$j=0;
	$stmtA="SELECT option_value,option_description,option_route,option_route_value,option_route_value_context from ccms_intelligent_route_options where intelligent_route_option_id='$route_id' order by option_value;";
	$rslt=mysql_query($stmtA, $link);
	$menus_to_print = mysql_num_rows($rslt);

	while ($menus_to_print > $j)
		{
		$row=mysql_fetch_row($rslt);
		$Aoption_value[$j] =				$row[0];
		$Aoption_description[$j] =			$row[1];
		$Aoption_route[$j] =				$row[2];
		$Aoption_route_value[$j] =			$row[3];
		$Aoption_route_value_context[$j] =	$row[4];
		$j++;
		}

	$j=0;
	while ($menus_to_print > $j)
		{
		$choose_height = (($j * 40) + 400);
		$option_value =					$Aoption_value[$j];
		$option_description =			$Aoption_description[$j];
		$option_route =					$Aoption_route[$j];
		$option_route_value =			$Aoption_route_value[$j];
		$option_route_value_context =	$Aoption_route_value_context[$j];



		if (eregi("1$|3$|5$|7$|9$", $j))
			{$bgcolor='bgcolor="#CCFFFF"';} 
		else
			{$bgcolor='bgcolor="#99FFCC"';}

		echo "<tr $bgcolor><td align=CENTER colspan=2> 
		Option: <input type=text name=option_value_$j size=10 maxlength=20 value=\"$option_value\"> &nbsp; 
		Description: <input type=text name=option_description_$j size=40 maxlength=255 value=\"$option_description\"> 
		Route: <select size=1 name=option_route_$j id=option_route_$j onChange=\"call_menu_option('$j','$option_route','$option_route_value','$option_route_value_context','$choose_height');\">
			<option>CALLMENU</option>
			<option>INGROUP</option>
			<option>DID</option>
			<option>HANGUP</option>
			<option>EXTENSION</option>
			<option>PHONE</option>
			<option>VOICEMAIL</option>
			<option>AGI</option>
			<option>INTELLIGENT ROUTE</option>
			<option value=\"\">* REMOVE *</option>
			<option selected value=\"$option_route\">$option_route</option>
		</select>		$NWB#vicidial_call_menu-option_value$NWE <BR>

		<span id=\"option_value_value_context_$j\" name=\"option_value_value_context_$j\">\n";

		if ($option_route=='CALLMENU')
			{
			echo "<span name=option_route_link_$j id=option_route_link_$j>";
			echo "<a href=\"$PHP_SELF?ADD=3511&route_id=$option_route_value\">IVR:</a>";
			echo "</span>";
			echo " <select size=1 name=option_route_value_$j id=option_route_value_$j onChange=\"call_menu_link('$j','CALLMENU');\">$call_menu_list<option SELECTED>$option_route_value</option></select>\n";
			}
		if ($option_route=='INTELLIGENT ROUTE')
			{
			echo "<span name=option_route_link_$j id=option_route_link_$j>";
			echo "<a href=\"$PHP_SELF?ADD=1500099&action=modify&route_name=$option_route_value\">INTELLIGENT ROUTE:</a>";
			echo "</span>";
			echo " <select size=1 name=option_route_value_$j id=option_route_value_$j onChange=\"call_menu_link('$j','INTELLIGENT');\">$intelligent_menu_list<option SELECTED>$option_route_value</option></select>\n";
			}
		if ($option_route=='INGROUP')
			{
			if (strlen($option_route_value_context) < 10)
				{$option_route_value_context = 'CID,LB,998,TESTCAMP,1';}
			$IGoption_route_value_context = explode(",",$option_route_value_context);
			$IGhandle_method =	$IGoption_route_value_context[0];
			$IGsearch_method =	$IGoption_route_value_context[1];
			$IGlist_id =		$IGoption_route_value_context[2];
			$IGcampaign_id =	$IGoption_route_value_context[3];
			$IGphone_code =		$IGoption_route_value_context[4];
			echo "<span name=option_route_link_$j id=option_route_link_$j>";
			echo "<a href=\"$PHP_SELF?ADD=3111&group_id=$option_route_value\">In-Group:</a>";
			echo "</span>";
			echo " <input type=hidden name=option_route_value_context_$j id=option_route_value_context_$j value=\"$option_route_value_context\">";
			echo " <select size=1 name=option_route_value_$j id=option_route_value_$j onChange=\"call_menu_link('$j','INGROUP');\">";
			echo "$ingroup_list<option SELECTED>$option_route_value</option></select>";
			echo " &nbsp; Handle Method: <select size=1 name=IGhandle_method_$j id=IGhandle_method_$j>";
			echo "$IGhandle_method_list<option SELECTED>$IGhandle_method</option></select>\n";
			echo "<BR>Search Method: <select size=1 name=IGsearch_method_$j id=IGsearch_method_$j>";
			echo "$IGsearch_method_list<option SELECTED>$IGsearch_method</option></select>\n";
			echo " &nbsp; List ID: <input type=text size=5 maxlength=14 name=IGlist_id_$j id=IGlist_id_$j value=\"$IGlist_id\">";
			echo "<BR>Campaign ID: <select size=1 name=IGcampaign_id_$j id=IGcampaign_id_$j>";
			echo "$IGcampaign_id_list<option SELECTED>$IGcampaign_id</option></select>\n";
			echo " &nbsp; Phone Code: <input type=text size=5 maxlength=14 name=IGphone_code_$j id=IGphone_code_$j value=\"$IGphone_code\">";
			}
		if ($option_route=='DID')
			{
			$stmt="SELECT did_id from vicidial_inbound_dids where did_pattern='$option_route_value';";
			$rslt=mysql_query($stmt, $link);
			$row=mysql_fetch_row($rslt);
			$did_id =			$row[0];

			echo "<span name=option_route_link_$j id=option_route_link_$j>";
			echo "<a href=\"$PHP_SELF?ADD=3311&did_id=$did_id\">DID:</a>";
			echo "</span>";
			echo " <select size=1 name=option_route_value_$j id=option_route_value_$j onChange=\"call_menu_link('$j','DID');\">$did_list<option SELECTED>$option_route_value</option></select>\n";
			}
		if ($option_route=='HANGUP')
			{
			echo "Audio File: <input type=text name=option_route_value_$j id=option_route_value_$j size=50 maxlength=255 value=\"$option_route_value\"> <a href=\"javascript:launch_chooser('option_route_value_$j','date',$choose_height);\">audio chooser</a>\n";
			}
		if ($option_route=='EXTENSION')
			{
			echo "Extension: <input type=text name=option_route_value_$j id=option_route_value_$j size=20 maxlength=255 value=\"$option_route_value\"> &nbsp; Context: <input type=text name=option_route_value_context_$j id=option_route_value_context_$j size=20 maxlength=255 value=\"$option_route_value_context\">\n";
			}
		if ($option_route=='PHONE')
			{
			echo "Phone: <select size=1 name=option_route_value_$j id=option_route_value_$j>$phone_list<option SELECTED>$option_route_value</option></select>\n";
			}
		if ($option_route=='VOICEMAIL')
			{
			echo "Voicemail Box: <input type=text name=option_route_value_$j id=option_route_value_$j size=12 maxlength=10 value=\"$option_route_value\"> <a href=\"javascript:launch_vm_chooser('option_route_value_$j','vm',700);\">voicemail chooser</a>\n";
			}
		if ($option_route=='AGI')
			{
			echo "AGI: <input type=text name=option_route_value_$j id=option_route_value_$j size=80 maxlength=255 value=\"$option_route_value\">\n";
			}

		echo "</span>
		<BR> &nbsp; </td></tr>\n";
		$j++;
		}

	while ($j <= 18)
		{
		$choose_height = (($j * 40) + 400);

		if (eregi("1$|3$|5$|7$|9$", $j))
			{$bgcolor='bgcolor="#FFFFFF"';} 
		else
			{$bgcolor='bgcolor="#C2C2C2"';}

		echo "<tr $bgcolor><td align=CENTER colspan=2> 
		Option: <input type=text name=option_value_$j size=10 maxlength=20 value=\"\">  &nbsp; 
		Description: <input type=text name=option_description_$j size=40 maxlength=255 value=\"\">  
		Route: <select size=1 name=option_route_$j id=option_route_$j onChange=\"call_menu_option('$j','','','','$choose_height');\">
			<option>CALLMENU</option>
			<option>INGROUP</option>
			<option>DID</option>
			<option>HANGUP</option>
			<option>EXTENSION</option>
			<option>PHONE</option>
			<option>VOICEMAIL</option>
			<option>AGI</option>
			<option>INTELLIGENT ROUTE</option>
			<option SELECTED value=\"\"> </option>
		</select> 
		$NWB#vicidial_call_menu-option_value$NWE <BR>

		<span id=\"option_value_value_context_$j\" name=\"option_value_value_context_$j\">\n";
		echo "</span>
		<BR> &nbsp; </td></tr>\n";
		$j++;
		}


	echo "<tr bgcolor=#FFFFFF><td align=center colspan=2><input type=submit name=SUBMIT value=SUBMIT></td></tr>\n";
	echo "</table>\n";
	echo "<BR></center></FORM><br>\n";
	


	if ($LOGdelete_dids > 0)
		{
		echo "<br><br><a href=\"$PHP_SELF?ADD=1500099&route_id=$route_id&action=del&confirm=no\">DELETE THIS ROUTE</a>\n";
		}

	}
else
	{
	echo "You do not have permission to view this page\n";
	exit;
	}
}
?>