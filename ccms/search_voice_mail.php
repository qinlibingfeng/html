<?php
include "voicemail_search/config.php";
include "voicemail_search/func.php";
	
require("dbconnect.php");
require("functions.php");
require("function_util.php");
$PHP_AUTH_USER=$_SERVER['PHP_AUTH_USER'];
$PHP_AUTH_PW=$_SERVER['PHP_AUTH_PW'];

$stmt = "SELECT use_non_latin FROM system_settings;";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$qm_conf_ct = mysql_num_rows($rslt);
if ($qm_conf_ct > 0)
	{
	$row=mysql_fetch_row($rslt);
	$non_latin =					$row[0];
	}
	if ($non_latin > 0) { $rslt=mysql_query("SET NAMES 'UTF8'");}
	

$user_level=0;
$stmt="select user_level, user_group,user_id,user,user_code from vicidial_users where user='$PHP_AUTH_USER' and pass='$PHP_AUTH_PW'";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$row=mysql_fetch_row($rslt);
$user_level = $row[0];
$userg = $row[1];
$user_id = $row[2];
$user_name = $row[3];
$user_code = $row[4];


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
	$i++;
}

	
if ( isset($_POST["from"]) && !empty($_POST["from"])  ){
		 $from = $_POST["from"];
}
if ( isset($_POST["to"]) && !empty($_POST["to"]) ){
  	 $to =  $_POST["to"];
}
if ( isset($_POST["campaignid"]) && !empty($_POST["campaignid"]) ){
  	 $campaignid =  $_POST["campaignid"];
}
if ( isset($_POST["user_code"]) && !empty($_POST["user_code"]) ){
  	 $user_code =  $_POST["user_code"];
} 

$searchdate1=$_POST['searchText2'];
$searchdate2=$_POST['searchText3'];
$searchstarthour=$_POST['searchstarthour'];
$searchstartminute=$_POST['searchstartminute'];
$searchstartsecond=$_POST['searchstartsecond'];
$searchendhour=$_POST['searchendhour'];
$searchendminute=$_POST['searchendminute'];
$searchendsecond=$_POST['searchendsecond'];
//echo "searchdate1 ".$searchdate1."<br>";

//date setting
if(empty($searchdate1)){$searchdate1=date("d-m-Y");}
if(empty($searchdate2)){$searchdate2=date("d-m-Y");}
if(empty($searchstarthour)){$searchstarthour="00";}
if(empty($searchstartminute)){$searchstartminute="00";}
if(empty($searchstartsecond)){$searchstartsecond="00";}
if(empty($searchendhour)){$searchendhour="23";}
if(empty($searchendminute)){$searchendminute="59";}
if(empty($searchendsecond)){$searchendsecond="59";}

$start_date_time = substr($_POST['searchText2'],6,4).'-'.substr($_POST['searchText2'],3,2).'-'.substr($_POST['searchText2'],0,2).' '.$_POST['searchstarthour'].':'.$_POST['searchstartminute'].':'.$_POST['searchstartsecond'];
$end_date_time   = substr($_POST['searchText3'],6,4).'-'.substr($_POST['searchText3'],3,2).'-'.substr($_POST['searchText3'],0,2).' '.$_POST['searchendhour'].':'.$_POST['searchendminute'].':'.$_POST['searchendsecond'];

if($user_level == 5){
$select_list = "Agent:<SELECT NAME=user_code ID=user_code ><option value='$user_code'>$user_code</option>";
}
else{

$select_list = "Campaign:<SELECT NAME=campaignid ID=campaignid ><option value='[All]'>[All]</option>";
$o=0;

while ($groups_to_print > $o)
	{
		if ( $campaignid == $LISTgroups[$o] ){
	      $select_list .= "<option value=\"$LISTgroups[$o]\" selected >$LISTgroups[$o] - $LISTnames[$o]</option>";
	  }else{
		    $select_list .= "<option value=\"$LISTgroups[$o]\"  >$LISTgroups[$o] - $LISTnames[$o]</option>";
		}
	
	$o++;
	}
$select_list .= "</SELECT>";
}
 ?>
 
<HTML><HEAD><TITLE>Voice Mail</TITLE>
<META content=issuesummary name=decorator>
<META http-equiv=Content-Type content="text/html; charset=UTF-8">
<META http-equiv=Pragma content=no-cache>
<META http-equiv=Expires content=-1>
<link rel="stylesheet" type="text/css" href="index.files/style.css" />
<!--<link rel="stylesheet" type="text/css" href="stylefont.css" /> -->
<script src="../ccms_jquery1.4.2/jquery-1.4.2.js"></script>
<script language="JavaScript" src="js/datefunctions.js"></script>
<script language="JavaScript">
	  function deletevm(vm,file,row){
	  	  if (confirm("Are you sure to delete?")){
	  	  	
	        var rowIndex = document.getElementById('rowForcustomfield_'+row).rowIndex; 
	        /*
	        document.getElementById('vmlisttable').deleteRow(rowIndex);
	        */
	        $.ajax({ 
               type: "post",
               url : "voicemail_search/deletewav.php", 
               dataType:'text',
               data:  'vm='+vm+'&file='+file+'&row='+row,
               success: function(retvalue){
               	           if ( retvalue == "1"){
                                document.getElementById('vmlisttable').deleteRow(rowIndex);
                           }else{
                           	    alert("Delete the error, Please contact your administrator!");
                           }     
                        }   
               });


	      }  
	  	
	  }
</script>

 <!--Edit by fnatic jquery end-->
<META content="MSHTML 6.00.2900.3020" name=GENERATOR>
</HEAD>

<BODY vLink=#c05800 aLink=#fe7501 link=#c05800 bgcolor="#FFFFFF" leftMargin=0 topMargin=0 marginheight="0" marginwidth="0" style="font-size:11px;">

<!--<div class="sectionHeader"><b  class="small cellLabel3">QUERY CONDITION</b> </div>-->

<form action='#' name="newGroupForm" method="post">
<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0 bgcolor="#FFFFFF" style="font-size:11px;">
  <tr bgcolor="#ffcc00">
    <td height="20" colspan="4"><font size="1" color="white"><b>QUERY CONDITION</b></font></td>
  </tr>
  <tr bgcolor='#c2c2c2'>
  	<td height="24" colspan="2">
  		<?php echo $select_list; ?>    </td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="28"> Call Start Time From:<!--
      <input type="text"  size="10" name="from" id="datepicker_from" value="<?php if (isset($from) ) { echo $from; } else { echo date("d-m-Y");} ?>">
      <a href="javascript:cal1.popup();" onMouseover="window.status='Select a date'; return true;" onMouseout="window.status=''; return true;"><img src="images/icons/cal.gif" width="16" height="16" border="0" align="absimddle"></a> --></td>
    <td>
    <input type=hidden name='searchText2' class="inputbox" style="width:100px" value="<?= $searchdate1 ?>">
	<span id="datefrom_show" stylexxx="font-weight: bold;"><?= $searchdate1 ?></span>
	<a href="javascript:cal1.popup();" onMouseover="window.status='Select a date'; return true;" onMouseout="window.status=''; return true;"><img src="images/icons/cal.gif" width="16" height="16" border="0" align="absimddle"></a>&nbsp;&nbsp;
	<input type="text" class="inputtext" name="searchstarthour" id ="searchstarthour" maxlength=2 value="<?= $searchstarthour ?>" style="font-family: Arial, Helvetica, sans-serif;font-size: 11px;color: #000000;border:1px #solid#bababa;padding-left:0px;	width:20px;background-color:#ffffff;">:
	<input type="text" class="inputtext" name="searchstartminute" id ="searchstartminute" maxlength=2 value="<?= $searchstartminute ?>" style="font-family: Arial, Helvetica, sans-serif;font-size: 11px;color: #000000;border:1px #solid#bababa;padding-left:0px;	width:20px;background-color:#ffffff;">:
    <input type="text" class="inputtext" name="searchstartsecond" id ="searchstartsecond" maxlength=2 value="<?= $searchstartsecond ?>" style="font-family: Arial, Helvetica, sans-serif;font-size: 11px;color: #000000;border:1px #solid#bababa;padding-left:0px;	width:20px;background-color:#ffffff;">
    </td>
    <td> Call Start Time To:
      <!--<input type="text" size="10" name="to" id="datepicker_to" value="<?php if (isset($to) ) { echo $to; } else { echo date("d-m-Y");} ?>">
      <a href="javascript:cal12.popup();" onMouseover="window.status='Select a date'; return true;" onMouseout="window.status=''; return true;"><img src="images/icons/cal.gif" width="16" height="16" border="0" align="absimddle"></a> --></td>
    <td>
    <input type=hidden class="inputtext" name='searchText3' style="width:100px" value="<?= $searchdate2 ?>">
    <span id="dateto_show" stylexxx="font-weight: bold;"><?= $searchdate2 ?></span>
	<a href="javascript:cal2.popup();" onMouseover="window.status='Select a date'; return true;" onMouseout="window.status=''; return true;"><img src="images/icons/cal.gif" width="16" height="16" border="0" align="absimddle"></a>
	<input type="text" class="inputtext" name="searchendhour" id ="searchendhour" maxlength=2 value="<?= $searchendhour ?>" style="font-family: Arial, Helvetica, sans-serif;font-size: 11px;color: #000000;border:1px #solid#bababa;padding-left:0px;	width:20px;background-color:#ffffff;">:
	<input type="text" class="inputtext" name="searchendminute" id ="searchendminute" maxlength=2 value="<?= $searchendminute ?>" style="font-family: Arial, Helvetica, sans-serif;font-size: 11px;color: #000000;border:1px #solid#bababa;padding-left:0px;	width:20px;background-color:#ffffff;">:
    <input type="text" class="inputtext" name="searchendsecond" id ="searchendsecond" maxlength=2 value="<?= $searchendsecond ?>" style="font-family: Arial, Helvetica, sans-serif;font-size: 11px;color: #000000;border:1px #solid#bababa;padding-left:0px;	width:20px;background-color:#ffffff;">
    </td>
  </tr>
  <tr>
    <td colspan="4" align="right"><input  type="submit" class="inputsubmit" name="add" value="SEARCH"></td>
  </tr>
   <!-- End demo -->
</table>
<p></p>
  <!--<div class="sectionHeader"><b  class="small cellLabel3">QUERY RESULTS</b> </div>-->
  <!--<div class="sectionBody" id="lyr1">-->

<table id="vmlisttable" border="0" cellpadding="1" cellspacing="1" width="100%" bgcolor="#707070" style="font-size:11px;">
<TBODY>
    <TR bgcolor="#ffcc00">
    	<TD colspan="4" height="20"><font size="1" color="white"><b>QUERY RESULTS</b></font></TD>
  	</TR>
    <TR id=rowForcustomfield_10020 bgcolor='#c2c2c2'>
        <TD width="20%" height="24" align="center" vAlign=top class="small cellLabel3"><B>Caller</B></TD>
        <TD vAlign=top width="20%" align="center" class="small cellLabel3"><B>Time</B></TD>
        <TD vAlign=top width="20%" align="center" class="small cellLabel3"><B>Voice</B></TD>
        <!--
        <TD vAlign=top width="20%" align="center" class="small cellLabel3"><B>Action</B></TD>
        -->
    </TR>
<?php
  if ( isset($start_date_time) && isset($end_date_time) ) {	
  	
//    $begin = getunixtime(substr($from,6,4).'-'.substr($from,3,2).'-'.substr($from,0,2)." "."00:00:00");
//    $end   = getunixtime(substr($to,6,4).'-'.substr($to,3,2).'-'.substr($to,0,2)." "."23:59:59");
  	
//	echo "start_date_time".$start_date_time."<br>";
	$begin	= getunixtime($start_date_time);
	$end 	= getunixtime($end_date_time);

//	echo "begin ".$begin."<br>";
//  echo "end ".$end."<br>";  
//	echo "from ".$searchdate1."<br>";
//	echo "to ".$searchdate2."<br>";
//    echo $from." to ".$to."<br>";
    if($user_level == 5){
		$voicemail_ext = $user_code;
		$VmPath = $VoiceMailPath."$voicemail_ext/INBOX/";
					    $StatVm = VoiceMail($VmPath,$begin,$end);
					    if(sizeof($StatVm)>0) {
					    while ( list( $key, $val ) = each( $StatVm ) ) { 
							$rowindex = $rowindex + 1;
							$val['wav']=str_replace(".wav",".WAV",$val['wav']);

					    ?>
					    <TR id=rowForcustomfield_<?php echo "$rowindex";?> stylexx="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#737373" bgcolor="#ffffff">
					        <TD vAlign=top width="20%"><?php echo $val['caller'];?></TD>
					        <TD vAlign=top width="20%"><?php echo Date2Str($val['ortime']);?></TD>
					        <TD vAlign=top width="20%"><a href="voicemail_search/getwav.php?vm=<?php echo $voicemail_ext;?>&file=<?php echo $val['wav']?>" target="_blank"><?php echo $val['wav'];?></a></TD>
					        <!--  <TD vAlign=top width="20%"><a href="#" >Delete</a></TD> -->
					    </TR>
					    <?php
					    }
					    }
	}else{
		if ( $campaignid == "[All]"){
    	
    	   $stmt  = getOwnVoicemails($user_level,$user_name);
    	   $rslt  = mysql_query($stmt, $link);
    	   
    	   $rowindex = 0;
    	   
    	   while ($row = mysql_fetch_row($rslt)){
    	   	
    	     $voicemail_ext = $row[0];
           $campaignname  = $row[1];
           
           
            
	          if ( !empty($voicemail_ext) ){
	    	
						    $VmPath = $VoiceMailPath."$voicemail_ext/INBOX/";
						    $StatVm = VoiceMail($VmPath,$begin,$end);
						    if(sizeof($StatVm)>0) {
						    ?>
						    <TR id=rowForcustomfield_10030 bgcolor="#ffffff">
						        <TD vAlign=top width="20%" colspan="4"><b><?php echo "$campaignname";?></b></TD>
						    </TR>						    
						    <?php	
						    while ( list( $key, $val ) = each( $StatVm ) ) { 
								$rowindex = $rowindex + 1;
								$val['wav']=str_replace(".wav",".WAV",$val['wav']);
						    ?>
						    <TR id=rowForcustomfield_<?php echo "$rowindex";?> stylexx="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#737373" bgcolor="#ffffff">
						        <TD vAlign=top width="20%"><?php echo $val['caller'];?></TD>
						        <TD vAlign=top width="20%"><?php echo Date2Str($val['ortime']);?></TD>
						        <TD vAlign=top width="20%"><a href="voicemail_search/getwav.php?vm=<?php echo $voicemail_ext;?>&file=<?php echo $val['wav']?>" target="_blank"><?php echo $val['wav'];?></a></TD>
						        <!-- <TD vAlign=top width="20%"><a href="#" >Delete</a></TD> -->
						    </TR>
						    <?php
						    }
						    }
	        	}    	   	  
    	   	
    	   }
    	  
    	  
    }else{
    	    
    	    $stmt  = "select voicemail_ext from vicidial_campaigns where campaign_id = '" . $campaignid . "'";
					$rslt  = mysql_query($stmt, $link);
					$row   = mysql_fetch_row($rslt);
					$voicemail_ext = $row[0];
          
          $rowindex = 0;
          
          if ( !empty($voicemail_ext) ){
    	
					    $VmPath = $VoiceMailPath."$voicemail_ext/INBOX/";
					    $StatVm = VoiceMail($VmPath,$begin,$end);
					    if(sizeof($StatVm)>0) {
					    while ( list( $key, $val ) = each( $StatVm ) ) { 
							$rowindex = $rowindex + 1;
							$val['wav']=str_replace(".wav",".WAV",$val['wav']);
					    ?>
					    <TR id=rowForcustomfield_<?php echo "$rowindex";?> stylexx="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#737373" bgcolor="#ffffff">
					        <TD vAlign=top width="20%"><?php echo $val['caller'];?></TD>
					        <TD vAlign=top width="20%"><?php echo Date2Str($val['ortime']);?></TD>
					        <TD vAlign=top width="20%"><a href="voicemail_search/getwav.php?vm=<?php echo $voicemail_ext;?>&file=<?php echo $val['wav']?>" target="_blank"><?php echo $val['wav'];?></a></TD>
					        <!--  <TD vAlign=top width="20%"><a href="#" >Delete</a></TD> -->
					    </TR>
					    <?php
					    }
					    }
        	}
  	}
	}
  }
    ?>
    </TBODY>
</TABLE>
</form>
<!--</div>-->

<script  language="javascript">     

	var cal1 = new calendar1(document.forms['newGroupForm'].elements['searchText2'], document.getElementById("datefrom_show"));
    cal1.path="/ccms/js/";
    cal1.year_scroll = true;
    cal1.time_comp = false;

    var cal2 = new calendar1(document.forms['newGroupForm'].elements['searchText3'], document.getElementById("dateto_show"));
    cal2.path="/ccms/js/";
    cal1.year_scroll = true;
    cal1.time_comp = false;
 
</script>
</BODY>
</HTML>
