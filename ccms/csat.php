<?php
if (isset($_GET["csat_action"]))				{$csat_action=$_GET["csat_action"];}
	elseif (isset($_POST["csat_action"]))		{$csat_action=$_POST["csat_action"];}
if (isset($_GET["csat_id"]))				{$csat_id=$_GET["csat_id"];}
	elseif (isset($_POST["csat_id"]))		{$csat_id=$_POST["csat_id"];}
if (isset($_GET["csat_name"]))				{$csat_name=$_GET["csat_name"];}
	elseif (isset($_POST["csat_name"]))		{$csat_name=$_POST["csat_name"];}
if (isset($_GET["description"]))				{$description=$_GET["description"];}
	elseif (isset($_POST["description"]))		{$description=$_POST["description"];}
if (isset($_GET["campaign_id"]))				{$campaign_id=$_GET["campaign_id"];}
	elseif (isset($_POST["campaign_id"]))		{$campaign_id=$_POST["campaign_id"];}
if (isset($_GET["ending_audio_file"]))				{$ending_audio_file=$_GET["ending_audio_file"];}
	elseif (isset($_POST["ending_audio_file"]))		{$ending_audio_file=$_POST["ending_audio_file"];}
if (isset($_GET["csat_timeout"]))				{$csat_timeout=$_GET["csat_timeout"];}
	elseif (isset($_POST["csat_timeout"]))		{$csat_timeout=$_POST["csat_timeout"];}
if (isset($_GET["csat_repeat"]))				{$csat_repeat=$_GET["csat_repeat"];}
	elseif (isset($_POST["csat_repeat"]))		{$csat_repeat=$_POST["csat_repeat"];}
if (isset($_GET["csat_timeout_prompt"]))				{$csat_timeout_prompt=$_GET["csat_timeout_prompt"];}
	elseif (isset($_POST["csat_timeout_prompt"]))		{$csat_timeout_prompt=$_POST["csat_timeout_prompt"];}
if (isset($_GET["csat_Invalid_prompt"]))				{$csat_Invalid_prompt=$_GET["csat_Invalid_prompt"];}
	elseif (isset($_POST["csat_Invalid_prompt"]))		{$csat_Invalid_prompt=$_POST["csat_Invalid_prompt"];}
if (isset($_GET["csat_voicemail"]))				{$csat_voicemail=$_GET["csat_voicemail"];}
	elseif (isset($_POST["csat_voicemail"]))		{$csat_voicemail=$_POST["csat_voicemail"];}
if (isset($_GET["csat_items"]))				{$csat_items=$_GET["csat_items"];}
	elseif (isset($_POST["csat_items"]))		{$csat_items=$_POST["csat_items"];}
if (isset($_GET["csat_item_id"]))				{$csat_item_id=$_GET["csat_item_id"];}
	elseif (isset($_POST["csat_item_id"]))		{$csat_item_id=$_POST["csat_item_id"];}
if (isset($_GET["csat_item_name"]))				{$csat_item_name=$_GET["csat_item_name"];}
	elseif (isset($_POST["csat_item_name"]))		{$csat_item_name=$_POST["csat_item_name"];}
if (isset($_GET["audio_file"]))				{$audio_file=$_GET["audio_file"];}
	elseif (isset($_POST["audio_file"]))		{$audio_file=$_POST["audio_file"];}
if (isset($_GET["option_count"]))				{$option_count=$_GET["option_count"];}
	elseif (isset($_POST["option_count"]))		{$option_count=$_POST["option_count"];}
if (isset($_GET["confirm"]))				{$confirm=$_GET["confirm"];}
	elseif (isset($_POST["confirm"]))		{$confirm=$_POST["confirm"];}
	
if ($LOGast_admin_access==1)
	{
	if ($ADD==99998888){
		if($csat_action == "save"){
			if(trim($csat_name)=="" || trim($campaign_id)=="" || trim($csat_timeout)=="" || trim($csat_repeat)==""){
				echo "<br><b>CSAT Name,Campaign,CSAT Timeout,CSAT Repeat can't be empty!</b>";
				echo "<br><a href=\"\" onclick=\"window.history.back();return false;\">back</a>";
			}else if(!is_numeric($csat_timeout)){
				echo "<br><b>CSAT Timeout isn't number!</b>";
				echo "<br><a href=\"\" onclick=\"window.history.back();return false;\">back</a>";
			}else if($csat_timeout<1000){
				echo "<br><b>CSAT Timeout should be greater than 1000!</b>";
				echo "<br><a href=\"\" onclick=\"window.history.back();return false;\">back</a>";
			}else if(!is_numeric($csat_repeat)){
				echo "<br><b>CSAT Repeat isn't number!</b>";
				echo "<br><a href=\"\" onclick=\"window.history.back();return false;\">back</a>";
			}else if($csat_repeat<0){
				echo "<br><b>CSAT Repeat should be greater than 0!</b>";
				echo "<br><a href=\"\" onclick=\"window.history.back();return false;\">back</a>";
			}else{
				if($csat_id!=""){
					$stmt="UPDATE ccms_csats set csat_name='$csat_name',description='$description',campaign_id='$campaign_id',ending_audio_file='$ending_audio_file',csat_timeout='$csat_timeout',csat_repeat='$csat_repeat',csat_timeout_prompt='$csat_timeout_prompt',csat_Invalid_prompt='$csat_Invalid_prompt',csat_voicemail='$csat_voicemail' where csat_id='$csat_id';";
					$rslt=mysql_query($stmt, $link);
					$stmt="delete from ccms_csat_item where csat_id='$csat_id';";
					$rslt=mysql_query($stmt, $link);
					echo "<br><B>CSAT MODIFIED</B>\n";
				}else{
					$stmt="insert into ccms_csats(csat_name,description,campaign_id,ending_audio_file,csat_timeout,csat_repeat,csat_timeout_prompt,csat_Invalid_prompt,csat_voicemail) values('$csat_name','$description','$campaign_id','$ending_audio_file','$csat_timeout','$csat_repeat','$csat_timeout_prompt','$csat_Invalid_prompt','$csat_voicemail')";
					$rslt=mysql_query($stmt, $link);
					echo "<br><B>CSAT ADDED</B>\n";
					$csat_id = mysql_insert_id();
				}
				foreach($csat_items as $temp){
					$stmt="insert into ccms_csat_item(csat_id,csat_item_id) values($csat_id,$temp)";
					$rslt=mysql_query($stmt, $link);
				}
				$csat_action="modify";
			}
		}
		if($csat_action == "del"){
			if($confirm=="no"){
				echo "<br><a href=\"$PHP_SELF?ADD=99998888&csat_action=del&csat_id=$csat_id&confirm=yes\">Click here to delete CSAT</a><br>";
				$csat_action = "modify";
			}else{
				$stmt="DELETE from ccms_csat_item where csat_id='$csat_id';";
				$rslt=mysql_query($stmt, $link);
				$stmt="DELETE from ccms_csats where csat_id='$csat_id' limit 1;";
				$rslt=mysql_query($stmt, $link);
				$csat_action = "";
			}
		}
		if($csat_action == "modify" || $csat_action == "add"){
			echo "<TABLE><TR><TD>\n";
			echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";
			if($csat_id!=""){
				$stmt="SELECT csat_name,description,campaign_id,ending_audio_file,csat_timeout,csat_repeat,csat_timeout_prompt,csat_Invalid_prompt,csat_voicemail from ccms_csats where csat_id=$csat_id;";
				$rslt=mysql_query($stmt, $link);
				$row=mysql_fetch_row($rslt);
				$csat_name = $row[0];
				$description = $row[1];
				$campaign_id = $row[2];
				$ending_audio_file = $row[3];
				$csat_timeout = $row[4];
				$csat_repeat = $row[5];
				$csat_timeout_prompt = $row[6];
				$csat_Invalid_prompt = $row[7];
				$csat_voicemail = $row[8];
			}else{
				$csat_name = "";
				$description = "";
				$campaign_id = "";
				$ending_audio_file = "";
				$csat_timeout = "3000";
				$csat_repeat = "0";
				$csat_timeout_prompt = "NONE";
				$csat_Invalid_prompt = "NONE";
				$csat_voicemail = "0";
			}
			echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";
			echo "<br>MODIFY A CSAT<form name=scriptForm action=$PHP_SELF method=POST>\n";
			echo "<input type=hidden name=ADD value=99998888>\n";
			echo "<input type=hidden name=csat_action value=\"save\">\n";
			echo "<input type=hidden name=csat_id value=\"$csat_id\">\n";
			echo "<tr bgcolor=#FFFFFF><td align=right>CSAT ID: </td><td align=left><B>$csat_id</B></td></tr>\n";
			echo "<tr bgcolor=#FFFFFF><td align=right>CSAT Name: </td><td align=left><input type=text name=csat_name size=40 maxlength=50 value=\"$csat_name\"> </td></tr>\n";
			echo "<tr bgcolor=#FFFFFF><td align=right>CSAT Description: </td><td align=left><input type=text name=description size=40 maxlength=50 value=\"$description\"> </td></tr>\n";
			
			$stmt = getCampaignSql($LOGuser_level,$LOGuser_name_id,'Y');
			$rslt=mysql_query($stmt, $link);
			$campaigns_to_print = mysql_num_rows($rslt);
			$o=0;
			$Campaign_Select_Str = "<select name=\"campaign_id\" id=\"campaign_id\" style=\"width:200px;\"><option value=\"\">NONE</option>";
			while ($campaigns_to_print > $o) 
			{
				$row=mysql_fetch_row($rslt);
				if($campaign_id==$row[0]){
					$Campaign_Select_Str = $Campaign_Select_Str . "<option value=\"$row[0]\" selected>$row[1]</option>";
				}else{
					$Campaign_Select_Str = $Campaign_Select_Str . "<option value=\"$row[0]\">$row[1]</option>";
				}
				$o++;
			}
			$Campaign_Select_Str = $Campaign_Select_Str . "</select>";
			if($csat_voicemail==1){
				$Voicemail_Select_Str = "<select size=1 name=csat_voicemail><option value=\"1\" selected>Y</option><option value=\"0\">N</option></select>";
			}else{
				$Voicemail_Select_Str = "<select size=1 name=csat_voicemail><option value=\"1\">Y</option><option value=\"0\" selected>N</option></select>";
			}
			
			$Csat_Items_Check_str = "";
			//ccms_csat_item
			$csat_items_arr = array();
			$stmt = "select csat_item_id from ccms_csat_item where csat_id=$csat_id";
			$rslt = mysql_query($stmt, $link);
			$CSATs_to_print = mysql_num_rows($rslt);
			$o=0;
			while ($CSATs_to_print > $o) {
				$row=mysql_fetch_row($rslt);
				$csat_items_arr[] = $row[0];
				$o++;
			}
			//ccms_csat_items
			$stmt = "SELECT csat_item_id,csat_item_name FROM ccms_csat_items order by csat_item_id";
			$rslt = mysql_query($stmt, $link);
			$CSATs_to_print = mysql_num_rows($rslt);
			$o=0;
			while ($CSATs_to_print > $o) {
				$row=mysql_fetch_row($rslt);
				if (in_array($row[0],$csat_items_arr)){
					$Csat_Items_Check_str = $Csat_Items_Check_str . "<input type=\"checkbox\" name=\"csat_items[]\" value=\"$row[0]\" checked/>$row[1]<br>";
				}else{
					$Csat_Items_Check_str = $Csat_Items_Check_str . "<input type=\"checkbox\" name=\"csat_items[]\" value=\"$row[0]\"/>$row[1]<br>";
				}
				$o++;
			}
			
			
			echo "<tr bgcolor=#FFFFFF><td align=right>Campaign: </td><td align=left>$Campaign_Select_Str</td></tr>\n";
			echo "<tr bgcolor=#FFFFFF><td align=right>Ending Audio File: </td><td align=left><input type=text name=ending_audio_file id=ending_audio_file size=40 maxlength=50 value=\"$ending_audio_file\"><a href=\"javascript:launch_chooser('ending_audio_file','date',100);\">audio chooser</a> </td></tr>\n";
			echo "<tr bgcolor=#FFFFFF><td align=right>CSAT Timeout: </td><td align=left><input type=text name=csat_timeout size=40 maxlength=50 value=\"$csat_timeout\"> </td></tr>\n";
			echo "<tr bgcolor=#FFFFFF><td align=right>CSAT Repeat: </td><td align=left><input type=text name=csat_repeat size=40 maxlength=50 value=\"$csat_repeat\"> </td></tr>\n";
			echo "<tr bgcolor=#FFFFFF><td align=right>CSAT Timeout Prompt: </td><td align=left><input type=text name=csat_timeout_prompt id=csat_timeout_prompt size=40 maxlength=50 value=\"$csat_timeout_prompt\"><a href=\"javascript:launch_chooser('csat_timeout_prompt','date',100);\">audio chooser</a> </td></tr>\n";
			echo "<tr bgcolor=#FFFFFF><td align=right>CSAT Invalid Prompt: </td><td align=left><input type=text name=csat_Invalid_prompt id=csat_Invalid_prompt size=40 maxlength=50 value=\"$csat_Invalid_prompt\"><a href=\"javascript:launch_chooser('csat_Invalid_prompt','date',100);\">audio chooser</a> </td></tr>\n";
			echo "<tr bgcolor=#FFFFFF><td align=right>CSAT Voicemail: </td><td align=left>$Voicemail_Select_Str</td></tr>\n";
			echo "<tr bgcolor=#FFFFFF><td align=right>CSAT Items: </td><td align=left>$Csat_Items_Check_str</td></tr>\n";
			echo "<tr bgcolor=#FFFFFF><td align=center colspan=2><input type=submit name=SUBMIT value=SUBMIT></td></tr>\n";
			echo "</TABLE>\n";
			if($csat_id!=""){
				echo "<br><a href=\"$PHP_SELF?ADD=99998888&csat_action=del&csat_id=$csat_id&confirm=no\">DELETE THIS CSAT</a>\n";
			}
		}

		if($csat_action == ""){
			echo "<TABLE><TR><TD>\n";
			echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

			$stmt="SELECT a.csat_id,a.csat_name,a.description,b.campaign_name FROM ccms_csats a left join vicidial_campaigns b on a.campaign_id=b.campaign_id order by a.csat_id";
			$rslt=mysql_query($stmt, $link);
			$CSATs_to_print = mysql_num_rows($rslt);

			echo "<br>CSAT LISTINGS:\n";
			echo "<center><TABLE width=$section_width cellspacing=0 cellpadding=1>\n";
			echo "<tr class=tr_bg_color>";
			echo "<td><font size=1 color=white align=left><B>CSAT ID</B></td>";
			echo "<td><font size=1 color=white><B>CSAT NAME</B></td>";
			echo "<td><font size=1 color=white><B>Description</B></td>";
			echo "<td><font size=1 color=white><B>Campaign</B></td>";
			echo "<td align=center><font size=1 color=white><B>MODIFY</B></td></tr>\n";

			$o=0;
			while ($CSATs_to_print > $o) 
				{
				$row=mysql_fetch_row($rslt);
				if (eregi("1$|3$|5$|7$|9$", $o))
					{$bgcolor='bgcolor="#FFFFFF"';} 
				else
					{$bgcolor='bgcolor="#C2C2C2"';}
				echo "<tr $bgcolor><td><font size=1><a href=\"$PHP_SELF?ADD=99998888&csat_id=$row[0]&csat_action=modify\">$row[0]</a></td>";
				echo "<td><font size=1> $row[1]</td>";
				echo "<td><font size=1> $row[2] </td>";
				echo "<td><font size=1> $row[3] </td>";
				echo "<td align=center><font size=1><a href=\"$PHP_SELF?ADD=99998888&csat_id=$row[0]&csat_action=modify\">MODIFY</a></td></tr>\n";
				$o++;
				}

			echo "</TABLE></center>\n";
		}
	}
	if ($ADD==999988888){
		if($csat_action == "save"){
			if(trim($csat_item_name)=="" || trim($audio_file)==""){
				echo "<br><b>CSAT Item Name and Audio File can't be empty!</b>";
				echo "<br><a href=\"\" onclick=\"window.history.back();return false;\">back</a>";
			}else{
				if($csat_item_id!=""){
					$stmt="UPDATE ccms_csat_items set csat_item_name='$csat_item_name',option_count='$option_count',audio_file='$audio_file' where csat_item_id='$csat_item_id';";
					$rslt=mysql_query($stmt, $link);
					echo "<br><B>CSAT Item MODIFIED</B>\n";
				}else{
					$stmt="insert into ccms_csat_items(csat_item_name,option_count,audio_file) values('$csat_item_name','$option_count','$audio_file')";
					$rslt=mysql_query($stmt, $link);
					echo "<br><B>CSAT Item ADDED</B>\n";
					$csat_item_id = mysql_insert_id();
				}
				$csat_action="modify";
			}
		}
		if($csat_action == "del"){
			$stmt = "SELECT csat_name FROM ccms_csats where csat_id in (SELECT csat_id FROM ccms_csat_item where csat_item_id =$csat_item_id)";
			$rslt = mysql_query($stmt, $link);
			$CSATs_to_print = mysql_num_rows($rslt);
			$o=0;
			$csat_arr = array();
			while ($CSATs_to_print > $o) {
				$row=mysql_fetch_row($rslt);
				$csat_arr[] = $row[0];
				$o++;
			}
			if($CSATs_to_print == 0){
				if($confirm=="no"){
					echo "<br><a href=\"$PHP_SELF?ADD=999988888&csat_action=del&csat_item_id=$csat_item_id&confirm=yes\">Click here to delete CSAT Item</a>\n";
					$csat_action = "modify";
				}else{
					$stmt = "DELETE from ccms_csat_items where csat_item_id='$csat_item_id' limit 1;";
					$rslt = mysql_query($stmt, $link);
					$csat_action = "";
				}

			}else{
				echo "<br><b>Can't delete the Item because " . implode($csat_arr,",") . " use this Item !</b>";
				$csat_action = "modify";
			}
		}
		if($csat_action == "modify" || $csat_action == "add"){
			echo "<TABLE><TR><TD>\n";
			echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";
			if($csat_item_id!=""){
				$stmt="SELECT csat_item_name,audio_file,option_count FROM ccms_csat_items where csat_item_id=$csat_item_id";
				$rslt=mysql_query($stmt, $link);
				$row=mysql_fetch_row($rslt);
				$csat_item_name = $row[0];
				$audio_file = $row[1];
				$option_count = $row[2];
			}else{
				$csat_item_id = "";
				$csat_item_name = "";
				$audio_file = "";
				$option_count = "";
			}
			$Option_Count_Select_str = "<select size=1 name=option_count >";
			for($i = 2;$i<=10;$i++){
				if($i == $option_count){
					$Option_Count_Select_str = $Option_Count_Select_str . "<option selected=\"selected\">$i</option>";
				}else{
					$Option_Count_Select_str = $Option_Count_Select_str . "<option>$i</option>";
				}
			}
			$Option_Count_Select_str = $Option_Count_Select_str . "</select>";
			echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";
			echo "<br>MODIFY A CSAT Item<form name=scriptForm action=$PHP_SELF method=POST>\n";
			echo "<input type=hidden name=ADD value=999988888>\n";
			echo "<input type=hidden name=csat_action value=\"save\">\n";
			echo "<input type=hidden name=csat_item_id value=\"$csat_item_id\">\n";
			echo "<tr bgcolor=#FFFFFF><td align=right>CSAT Item ID: </td><td align=left><B>$csat_item_id</B></td></tr>\n";
			echo "<tr bgcolor=#FFFFFF><td align=right>CSAT Item Name: </td><td align=left><input type=text name=csat_item_name size=40 maxlength=50 value=\"$csat_item_name\"> </td></tr>\n";
			echo "<tr bgcolor=#FFFFFF><td align=right>Option Count: </td><td align=left>$Option_Count_Select_str </td></tr>\n";
			echo "<tr bgcolor=#FFFFFF><td align=right>Audio File: </td><td align=left><input type=text name=audio_file id=audio_file size=40 maxlength=50 value=\"$audio_file\"><a href=\"javascript:launch_chooser('audio_file','date',100);\">audio chooser</a></td></tr>\n";
			echo "<tr bgcolor=#FFFFFF><td align=center colspan=2><input type=submit name=SUBMIT value=SUBMIT></td></tr>\n";
			echo "</TABLE>\n";
			if($csat_item_id!=""){
				echo "<br><a href=\"$PHP_SELF?ADD=999988888&csat_action=del&csat_item_id=$csat_item_id&confirm=no\">DELETE THIS CSAT Item</a>\n";
			}
		}

		if($csat_action == ""){
			echo "<TABLE><TR><TD>\n";
			echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

			$stmt="SELECT csat_item_id,csat_item_name,audio_file,option_count FROM ccms_csat_items order by csat_item_id";
			$rslt=mysql_query($stmt, $link);
			$CSATs_to_print = mysql_num_rows($rslt);

			echo "<br>CSAT LISTINGS:\n";
			echo "<center><TABLE width=$section_width cellspacing=0 cellpadding=1>\n";
			echo "<tr class=tr_bg_color>";
			echo "<td><font size=1 color=white align=left><B>CSAT Item ID</B></td>";
			echo "<td><font size=1 color=white><B>CSAT Item NAME</B></td>";
			echo "<td><font size=1 color=white><B>Option Count</B></td>";
			echo "<td align=center><font size=1 color=white><B>MODIFY</B></td></tr>\n";

			$o=0;
			while ($CSATs_to_print > $o) 
				{
				$row=mysql_fetch_row($rslt);
				if (eregi("1$|3$|5$|7$|9$", $o))
					{$bgcolor='bgcolor="#FFFFFF"';} 
				else
					{$bgcolor='bgcolor="#C2C2C2"';}
				echo "<tr $bgcolor><td><font size=1><a href=\"$PHP_SELF?ADD=999988888&csat_item_id=$row[0]&csat_action=modify\">$row[0]</a></td>";
				echo "<td><font size=1> $row[1]</td>";
				echo "<td><font size=1> $row[3] </td>";
				echo "<td align=center><font size=1><a href=\"$PHP_SELF?ADD=999988888&csat_item_id=$row[0]&csat_action=modify\">MODIFY</a></td></tr>\n";
				$o++;
				}

			echo "</TABLE></center>\n";
		}
	}
	}
else
	{
	echo "You do not have permission to view this page\n";
	exit;
	}
?>
