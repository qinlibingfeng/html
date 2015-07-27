<?php
header ("Content-type: text/html; charset=utf-8");

//require("dbconnect.php");
require("dbconnect_report.php");
require("functions.php");
require("function_util.php");
require("voicemail_search/func.php");
require("voicemail_search/config.php");

$PHP_AUTH_USER=$_SERVER['PHP_AUTH_USER'];
$PHP_AUTH_PW=$_SERVER['PHP_AUTH_PW'];
$PHP_SELF=$_SERVER['PHP_SELF'];

$select_one = 0;

$selfurl = "$PHP_SELF" . "?";

if ( isset($_REQUEST["campaign"]) && !empty($_REQUEST["campaign"]) ){
  	 $campaignid   =  $_REQUEST["campaign"];
  	 $campaignname =  $_REQUEST["campaign_name"];
  	 
  	 $sql        =  "select dial_method from vicidial_campaigns where campaign_id = $campaignid LIMIT 1";
  	 $rslt       =  mysql_query($sql, $link);
	   $row        =  mysql_fetch_row($rslt);
	   $Dialmethod =	$row[0];  	 
  	 
}else{
	   $select_one = 1;
}

if ( isset($_REQUEST["ingroup"]) && !empty($_REQUEST["ingroup"]) ){
  	 $ingroups      =  $_REQUEST["ingroup"];
  	 $ingroup_names =  $_REQUEST["ingroup_name"];
}


$stmt = "SELECT use_non_latin FROM system_settings;";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$qm_conf_ct = mysql_num_rows($rslt);
if ($qm_conf_ct > 0)	{
	$row=mysql_fetch_row($rslt);
	$non_latin =					$row[0];
}
	if ($non_latin > 0) { $rslt=mysql_query("SET NAMES 'UTF8'");}


$PHP_AUTH_USER = ereg_replace("[^0-9a-zA-Z]","",$PHP_AUTH_USER);
$PHP_AUTH_PW = ereg_replace("[^0-9a-zA-Z]","",$PHP_AUTH_PW);

//$stmt="SELECT count(*) from vicidial_users where user='$PHP_AUTH_USER' and pass='$PHP_AUTH_PW' and user_level > 6 and view_reports='1' and active='Y';";
$stmt="SELECT count(*) from vicidial_users where user='$PHP_AUTH_USER' and pass='$PHP_AUTH_PW' and view_reports='1' and active='Y';";
if ($DB) {echo "|$stmt|\n";}
if ($non_latin > 0) {$rslt=mysql_query("SET NAMES 'UTF8'");}
$rslt=mysql_query($stmt, $link);
$row=mysql_fetch_row($rslt);
$auth=$row[0];


if( (strlen($PHP_AUTH_USER)<2) or (strlen($PHP_AUTH_PW)<2) or (!$auth))	{
    Header("WWW-Authenticate: Basic realm=\"CCMS\"");
    Header("HTTP/1.0 401 Unauthorized");
    echo "Invalid Username/Password: |$PHP_AUTH_USER|$PHP_AUTH_PW|\n";
    exit;
}

$user_level=0;
$stmt="select user_level, user_group,user_id,user from vicidial_users where user='$PHP_AUTH_USER' and pass='$PHP_AUTH_PW'";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$row=mysql_fetch_row($rslt);
$user_level = $row[0];
$userg = $row[1];
$user_id = $row[2];
$user_name = $row[3];


$stmt= getOwnCampaigns($user_level,$user_name);
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$groups_to_print = mysql_num_rows($rslt);
$i=0;

while ($i < $groups_to_print)
{
	$row=mysql_fetch_row($rslt);

	$LISTgroups[$i] =$row[0];
	$LISTnames[$i]  =$row[1];
  $LISTvoice[$i]  =$row[10];
  $ListDialmethod[$i] = $row[3];  
	$i++;
}

if ( $select_one ==1 ){
	 $campaignid   = $LISTgroups[0];
	 $campaignname = $LISTnames[0];
	 $Dialmethod   = $ListDialmethod[0];
}


$select_list = "Campaign:<SELECT NAME=campaign ID=campaign onchange='javascript:formsubmit();' style=\"width:200px;\">";
$o=0;

while ($groups_to_print > $o)
	{
		if ( $campaignid == $LISTgroups[$o]  ){
	      $select_list .= "<option value=\"$LISTgroups[$o]\" selected >$LISTnames[$o]</option>";
	      
	      /*技能组*/
			  $sql = "select group_id,group_name,inbound_mode from vicidial_inbound_groups a  where ";
			  $sql = $sql .  "   exists (     select 1 from vicidial_campaigns b          where   campaign_id = '" . $campaignid . "' ";
			  $sql = $sql .  "                and concat(' ',b.closer_campaigns,' ') regexp binary concat(' ',ltrim(rtrim(a.group_id)),' ') = 1 ";
			  $sql = $sql .  " ) order by group_id ";
			  
			  $tmp_group_A     = array();
			  $tmp_groupname_A = array();
			  $rslt_ingroups = mysql_query($sql, $link);
			  while ( $row_ingroups = mysql_fetch_row($rslt_ingroups) ){
			  	      if ( strpos(strtoupper($row_ingroups[0]),"AGENTDIRECT") === false && strpos(strtoupper($row_ingroups[0]),"TRACKING") === false ){
			  	           $tmp_group_A[]       = $row_ingroups[0];
			  	           $tmp_groupname_A[]   = $row_ingroups[1];
			  	      }	

			  }
        /*检查传过来的技能组是否是同一个campaign*/		
        $b_isonecampaign  = false;
        
		  	$ingroups_A       = explode(",",$ingroups);
		  	$ingroup_names_A  = explode(",",$ingroup_names);  

		  	if ( count($ingroups_A) > 0){          	  			  
					  foreach($tmp_group_A as $value){
					  	  if ( in_array($value,$ingroups_A) ){
					  	  	   $b_isonecampaign = true;
					  	  	   break;
					  	  } 
					  }
				}	  
			  /*检查end*/
			  $html_ingroups = "In Groups:";
			  
			  foreach ( $tmp_group_A as $key => $value  ){
			  	      $tmp_groupid     = $value;
			  	      $tmp_groupname   = $tmp_groupname_A[$key];
			  	      if ( $b_isonecampaign ){
			  	      	   if ( in_array($tmp_groupid,$ingroups_A) ){
			  	      	        $html_ingroups   = $html_ingroups . "<input checked type=\"checkbox\" NAME=chkbox_ingroup ID=chkbox_ingroup value=\"" . $tmp_groupid . "\" alt='$tmp_groupname' >" . $tmp_groupname ;	 
			  	      	   }else{
			  	      	 	      $html_ingroups   = $html_ingroups . "<input type=\"checkbox\" NAME=chkbox_ingroup ID=chkbox_ingroup value=\"" . $tmp_groupid . "\" alt='$tmp_groupname' >" . $tmp_groupname ;
			  	      	 	 }
			  	      }else{
			  	      	   $html_ingroups   = $html_ingroups . "<input checked type=\"checkbox\" NAME=chkbox_ingroup ID=chkbox_ingroup value=\"" . $tmp_groupid . "\" alt='$tmp_groupname' >" . $tmp_groupname ;
			  	    	}
			  	      
			  }
			  $html_ingroups = $html_ingroups . "<input type=\"hidden\" id=ingroup name=ingroup ><input type=\"hidden\" id=ingroup_name name=ingroup_name >";	 
		 	       
	      /*技能组*/
	  }else{
		    $select_list .= "<option value=\"$LISTgroups[$o]\"  >$LISTnames[$o]</option>";
		}
	
	$o++;
	}
$select_list .= "</SELECT>";
?>
	
<HTML><HEAD><TITLE>Real Time Campaign</TITLE>
<META content=issuesummary name=decorator>
<META http-equiv=Content-Type content="text/html; charset=UTF-8">
<META http-equiv=Pragma content=no-cache>
<META http-equiv=Expires content=-1>
<link rel="stylesheet" type="text/css" href="index.files/style.css" />
<!--<link rel="stylesheet" type="text/css" href="stylefont.css" /> -->
<script src="../ccms_jquery1.4.2/jquery-1.4.2.js"></script>
<script language="JavaScript" src="js/datefunctions.js"></script>
<script language="JavaScript">
	  function formsubmit(){
	  	  var url = "<?php echo $selfurl?>";
        var campaign       = document.getElementById("campaign"); 
        var chkbox_ingroup = document.getElementsByName("chkbox_ingroup");
        var dialmethod     = document.getElementById("dialmethod");

        var tmp_ingroup     = new Array();
        var tmp_ingroupname = new Array();
        for (var i =0 ;i<campaign.length; i++){
        	   if ( campaign.options[i].selected ){
                  url = url + "campaign=" + encodeURIComponent(campaign.options[i].value) + "&campaign_name=" + encodeURIComponent(campaign.options[i].text);
        	   }
        }

        var j=0;
        for (var i =0 ;i<chkbox_ingroup.length; i++){
        	   if ( chkbox_ingroup[i].checked ){
        	   	    tmp_ingroup[j]     = chkbox_ingroup[i].value;
                  tmp_ingroupname[j] = chkbox_ingroup[i].alt;
                  j = j + 1;
        	   }
        }

        document.getElementsByName("ingroup").value = tmp_ingroup.join(",");
        document.getElementsByName("ingroup_name").value = tmp_ingroupname.join(",");
        
        url = url + "&ingroup=" + encodeURIComponent(tmp_ingroup.join(",")) + "&ingroup_name=" + encodeURIComponent(tmp_ingroupname.join(","));

        for (var i =0 ;i<dialmethod.length; i++){
        	   if ( dialmethod.options[i].selected ){
                  url = url + "&direction=" + encodeURIComponent(dialmethod.options[i].value) ;
        	   }
        }        

        location.href = url;
	  }
	
</script>

 <!--Edit by fnatic jquery end-->
<META content="MSHTML 6.00.2900.3020" name=GENERATOR>
</HEAD>

<BODY vLink=#c05800 aLink=#fe7501 link=#c05800 bgcolor="#FFFFFF" leftMargin=0 topMargin=0 marginheight="0" marginwidth="0" style="font-size:11px;">
	
<form  name="newGroupForm" id="MyForm" method="post">
<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0 bgcolor="#FFFFFF" style="font-size:11px;">
  <tr class=tr_bg_color>
    <td height="20" colspan="4"><font size="1" color="white"><b>QUERY CONDITION</b></font></td>
  </tr>
  <tr bgcolor='#c2c2c2'>
  	<td height="24" colspan="2">
  		<?php echo $select_list; ?>    </td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr bgcolor='#c2c2c2'>
  	<td height="24" colspan="2">
  		<?php echo $html_ingroups; ?>    </td>  		
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr bgcolor='#c2c2c2'>
  	<td height="24" colspan="2">
  		Dial Method:<select name=dialmethod id=dialmethod style="width:200px;">
  			<option value="inbound" <?php if ( $Dialmethod == "INBOUND_MAN" ) echo "selected" ?> >Inbound</option>
  			<option value="outbound" <?php if ( $Dialmethod != "INBOUND_MAN" ) echo "selected" ?>>Outbound</option>
  			</select>   
  	</td>  		
    <td colspan="2">&nbsp;</td>
  </tr>  
  <tr>
    <td colspan="4" align="right"><input  type="button" class="inputsubmit" name="add" value="SEARCH" onclick="javascript:formsubmit();"></td>
  </tr>
   <!-- End demo -->
</table>
</form>	
</BODY>
</HTML>	
<?php
?>