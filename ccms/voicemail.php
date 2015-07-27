<?php
	include "voicemail_search/config.php";
	include "voicemail_search/func.php";
	
	$from = (isset($_GET["from"]) && !is_null($_GET["from"]) && $_GET["from"]!=NULL && $_GET["from"]!="") ? $_GET["from"] : date("d-m-Y");
	$to = (isset($_GET["to"]) && !is_null($_GET["to"]) && $_GET["to"]!=NULL && $_GET["to"]!=NULL) ? $_GET["to"] : date("d-m-Y");
 ?>
<HTML><HEAD><TITLE>CCMS</TITLE>
<META content=issuesummary name=decorator>
<META http-equiv=Content-Type content="text/html; charset=UTF-8">
<META http-equiv=Pragma content=no-cache>
<META http-equiv=Expires content=-1>
    <link rel="stylesheet" type="text/css" href="index.files/style.css" />
    <link rel="stylesheet" type="text/css" href="stylefont.css" /> 

    <script language="JavaScript" src="js/datefunctions.js"></script>


 <!--Edit by fnatic jquery end-->
<META content="MSHTML 6.00.2900.3020" name=GENERATOR>
</HEAD>

<BODY vLink=#c05800 aLink=#fe7501 link=#c05800 bgColor=#f0f0f0 leftMargin=0 topMargin=0 marginheight="0" marginwidth="0">

<div class="sectionHeader"><b  class="small cellLabel3">Query Condition</b> </div>
<div class="sectionBody" id="lyr1">
<form action="?" name="newGroupForm" method="get">
<TABLE cellSpacing=0 cellPadding=0 width="80%" border=0>
       <tr>
          <td>
            From: <input type="text"  name="from" id="datepicker_from" value="<?php echo $from; ?>">
                  <a href="javascript:cal1.popup();" onMouseover="window.status='Select a date'; return true;" onMouseout="window.status=''; return true;"><img src="images/icons/cal.gif" width="16" height="16" border="0" align="absimddle"></a>
              
          </td>
          <td>
            To: <input type="text" name="to" id="datepicker_to" value="<?php echo $to; ?>">
                <a href="javascript:cal12.popup();" onMouseover="window.status='Select a date'; return true;" onMouseout="window.status=''; return true;"><img src="images/icons/cal.gif" width="16" height="16" border="0" align="absimddle"></a>
          </td>
          <td>
                <input type="submit" value="submit" >
          </td>
       </tr>

   <!-- End demo -->
</table>
</form>
</div>
<div class="sectionHeader"><b  class="small cellLabel3">Query results</b> </div>
<div class="sectionBody" id="lyr1">

<table border="0" cellpadding="1" cellspacing="1" width="95%" bgcolor="#dddddd">
<TBODY>
    <TR id=rowForcustomfield_10020>
        <TD vAlign=top width="20%" align="center" class="small cellLabel3"><B>Caller</B></TD>
        <TD vAlign=top width="20%" align="center" class="small cellLabel3"><B>Time</B></TD>
        <TD vAlign=top width="20%" align="center" class="small cellLabel3"><B>Voice</B></TD>
        <TD vAlign=top width="20%" align="center" class="small cellLabel3"><B>Action</B></TD>
    </TR>
    <?
	
    $begin = getunixtime(substr($from,6,4).'-'.substr($from,3,2).'-'.substr($from,0,2)." "."00:00:00");
    $end   = getunixtime(substr($to,6,4).'-'.substr($to,3,2).'-'.substr($to,0,2)." "."23:59:59");
    echo $from." to ".$to."<br>";
    $VmPath = $VoiceMailPath."77801/INBOX/";
    $StatVm = VoiceMail($VmPath,$begin,$end);
    if(sizeof($StatVm)>0) {
    while ( list( $key, $val ) = each( $StatVm ) ) {
    ?>
    <TR id=rowForcustomfield_10030 bgcolor="#ffffff">
        <TD vAlign=top width="20%" class="small cellLabel2"><?php echo $val['caller'];?></TD>
        <TD vAlign=top width="20%" class="small cellLabel2"><?php echo Date2Str($val['ortime']);?></TD>
        <TD vAlign=top width="20%" class="small cellLabel2"><a href="voicemail_search/getwav.php?vm=<?php echo $vm;?>&file=<?php echo $val['wav']?>" target="_blank"><?php echo $val['wav'];?></a></TD>
        <TD vAlign=top width="20%" class="small cellLabel2"><a href="#" disabled>Delete</a></TD>
    </TR>
    <?
    }
    }
    ?></TBODY>
</TABLE>
</div>

<script  language="javascript">     

    var cal1 = new calendar1(document.getElementById("datepicker_from"));
    cal1.path="/ccms/js/";
    cal1.year_scroll = true;
    cal1.time_comp = false;

    var cal12 = new calendar1(document.getElementById("datepicker_to"));
    cal12.path="/ccms/js/";
    cal12.year_scroll = true;
    cal12.time_comp = false;
 
</script>
</BODY></HTML>
