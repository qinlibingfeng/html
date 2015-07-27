<?php
	include "config.php";
	include "func.php";
	
	$from = (isset($_GET["from"]) && !is_null($_GET["from"]) && $_GET["from"]!=NULL && $_GET["from"]!="") ? $_GET["from"] : date("Y-m-d");
	$to = (isset($_GET["to"]) && !is_null($_GET["to"]) && $_GET["to"]!=NULL && $_GET["to"]!=NULL) ? $_GET["to"] : date("Y-m-d");
 ?>
<HTML><HEAD><TITLE>Voice Mail</TITLE>
<META content=issuesummary name=decorator>
<META http-equiv=Content-Type content="text/html; charset=UTF-8">
<META http-equiv=Pragma content=no-cache>
<META http-equiv=Expires content=-1>
<LINK media=print href="images/combined-printable.css" type=text/css rel=stylesheet>
<LINK media=all href="images/combined.css" type=text/css rel=StyleSheet>
<LINK media=all href="images/global.css" type=text/css rel=StyleSheet>
<SCRIPT language=JavaScript src="images/combined-javascript.js" type=text/javascript></SCRIPT>
<SCRIPT src="images/calendar.js" type=text/javascript></SCRIPT>
<SCRIPT src="images/calendar-en.js" type=text/javascript></SCRIPT>
<SCRIPT src="images/calendar-setup.js" type=text/javascript></SCRIPT>
<SCRIPT type=text/javascript>
            // Hack to avoid bug in jscalendar - JRA-7713
            if (!Calendar._TT["WEEKEND"]) { Calendar._TT["WEEKEND"] = "0,6";}
            if (!Calendar._TT["DAY_FIRST"]) { Calendar._TT["DAY_FIRST"] = "Display %s first";}
</SCRIPT>

<!--Edit by fnatic jquery start-->
	<link type="text/css" href="./jquery/jquery.ui.all.css" rel="stylesheet" />
	<script type="text/javascript" src="./jquery/jquery-1.4.2.js"></script>
	<script type="text/javascript" src="./jquery/jquery.ui.core.js"></script>
	<script type="text/javascript" src="./jquery/jquery.ui.widget.js"></script>
	<script type="text/javascript" src="./jquery/jquery.ui.datepicker.js"></script>
	<link type="text/css" href="./jquery/demos.css" rel="stylesheet" />
	<script type="text/javascript">
	$(function() {
		$('#datepicker_from').datepicker({
			showButtonPanel: true,
			dateFormat: "yy-mm-dd"
		});	
		$('#datepicker_to').datepicker({
			showButtonPanel: true,
			dateFormat: "yy-mm-dd"
		});			
	});
	
	</script>
 <!--Edit by fnatic jquery end-->
<META content="MSHTML 6.00.2900.3020" name=GENERATOR>
</HEAD>

<BODY vLink=#c05800 aLink=#fe7501 link=#c05800 bgColor=#f0f0f0 leftMargin=0 topMargin=0 marginheight="0" marginwidth="0">
<SCRIPT src="images/quicksearch.js" type=text/javascript></SCRIPT>
<form action="?" method="get">
<TABLE cellSpacing=0 cellPadding=0 width="35%" border=0>
       <tr>
          <td>
            From: <input type="text"  name="from" id="datepicker_from" value="<?php echo $from; ?>">
                  <!--<select id="from_hour" name="from_hour">
                     <option>hour</option>
                     <option value="00">00</option>
                     <option value="01">01</option>
                     <option value="02">02</option>
                     <option value="03">03</option>
                     <option value="04">04</option>
                     <option value="05">05</option>
                     <option value="06">06</option>
                     <option value="07">07</option>
                     <option value="08">08</option>
                     <option value="09">09</option>
                     <option value="10">10</option>
                     <option value="11">11</option>
                     <option value="12">12</option>
                     <option value="13">13</option>
                     <option value="14">14</option>
                     <option value="15">15</option>
                     <option value="16">16</option>
                     <option value="17">17</option>  
                     <option value="18">18</option>
                     <option value="19">19</option>
                     <option value="20">20</option>
                     <option value="21">21</option>
                     <option value="22">22</option> 
                     <option value="23">23</option>               
                  </select>
                  <select id="from_min">
                     <option>minute</option>
                     <option value="00">00</option>
                     <option value="01">05</option>
                     <option value="02">10</option>
                     <option value="03">15</option>
                     <option value="04">20</option>
                     <option value="05">25</option>
                     <option value="06">30</option>
                     <option value="07">35</option>
                     <option value="08">40</option>
                     <option value="09">45</option>
                     <option value="10">50</option>
                     <option value="11">55</option>
                     <option value="12">60</option>              
                  </select>
                  <select id="from_sec">
                     <option>secord</option>
                     <option value="00">00</option>
                     <option value="01">05</option>
                     <option value="02">10</option>
                     <option value="03">15</option>
                     <option value="04">20</option>
                     <option value="05">25</option>
                     <option value="06">30</option>
                     <option value="07">35</option>
                     <option value="08">40</option>
                     <option value="09">45</option>
                     <option value="10">50</option>
                     <option value="11">55</option>
                     <option value="12">60</option>              
                  </select>-->
              
          </td>
          <td>
            To: <input type="text" name="to" id="datepicker_to" value="<?php echo $to; ?>">
                 <!-- <select id="to_hour">
                     <option>hour</option>
                     <option value="00">00</option>
                     <option value="01">01</option>
                     <option value="02">02</option>
                     <option value="03">03</option>
                     <option value="04">04</option>
                     <option value="05">05</option>
                     <option value="06">06</option>
                     <option value="07">07</option>
                     <option value="08">08</option>
                     <option value="09">09</option>
                     <option value="10">10</option>
                     <option value="11">11</option>
                     <option value="12">12</option>
                     <option value="13">13</option>
                     <option value="14">14</option>
                     <option value="15">15</option>
                     <option value="16">16</option>
                     <option value="17">17</option>  
                     <option value="18">18</option>
                     <option value="19">19</option>
                     <option value="20">20</option>
                     <option value="21">21</option>
                     <option value="22">22</option> 
                     <option value="23">23</option>               
                  </select>
                  <select id="to_min">
                     <option>minute</option>
                     <option value="00">00</option>
                     <option value="01">05</option>
                     <option value="02">10</option>
                     <option value="03">15</option>
                     <option value="04">20</option>
                     <option value="05">25</option>
                     <option value="06">30</option>
                     <option value="07">35</option>
                     <option value="08">40</option>
                     <option value="09">45</option>
                     <option value="10">50</option>
                     <option value="11">55</option>
                     <option value="12">60</option>              
                  </select>
                  <select id="to_sec">
                     <option>secord</option>
                     <option value="00">00</option>
                     <option value="01">05</option>
                     <option value="02">10</option>
                     <option value="03">15</option>
                     <option value="04">20</option>
                     <option value="05">25</option>
                     <option value="06">30</option>
                     <option value="07">35</option>
                     <option value="08">40</option>
                     <option value="09">45</option>
                     <option value="10">50</option>
                     <option value="11">55</option>
                     <option value="12">60</option>              
                  </select>-->
          </td>
          <td>
                <input type="submit" value="submit" >
          </td>
       </tr>

   <!-- End demo -->
</table>
</form>
<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
<TBODY>
	<TR>
		<TD vAlign=top bgColor=#ffffff>
			<DIV id=issueContent style="PADDING-RIGHT: 10px; PADDING-LEFT: 10px; PADDING-BOTTOM: 10px; PADDING-TOP: 10px">
			<STYLE>
				.fieldArea .fieldLabelArea {
					WIDTH: 10%
				}
				.fieldArea .fieldValueArea {
					WIDTH: 90%
				}
				#pinCommentContainer {
					FONT-SIZE: 10px; FLOAT: right
				}
				#pinCommentContainer A {
					MARGIN: 0px 0.2em
				}
			</STYLE>
			<?
			$ToDay = date("Y-m-d");
			?>
		<TABLE class=gridTabBox id=tab1 cellSpacing=1 cellPadding=3 width="100%" align=center>
        <TBODY>
			<TR id=rowForcustomfield_10020>
				<TD vAlign=top width="20%" bgColor=#f0f0f0><B>Caller</B></TD>
				<TD vAlign=top width="20%" bgColor=#f0f0f0><B>Time</B></TD>
				<TD vAlign=top width="20%" bgColor=#f0f0f0><B>Voice</B></TD>
				<TD vAlign=top width="20%" bgColor=#f0f0f0><B>Action</B></TD>
			</TR>
			<?
			$begin = getunixtime($from." "."00:00:00");
			$end   = getunixtime($to." "."23:59:59");
			echo $from." to ".$to."<br>";
			$VmPath = $VoiceMailPath."77801/INBOX/";
			$StatVm = VoiceMail($VmPath,$begin,$end);
			if(sizeof($StatVm)>0) {
			while ( list( $key, $val ) = each( $StatVm ) ) {
			?>
			<TR id=rowForcustomfield_10030>
				<TD vAlign=top width="20%" bgColor=#ffffff><?php echo $val['caller'];?></TD>
				<TD vAlign=top width="20%" bgColor=#ffffff><?php echo Date2Str($val['ortime']);?></TD>
				<TD vAlign=top width="20%" bgColor=#ffffff><a href="getwav.php?vm=<?php echo $vm;?>&file=<?php echo $val['wav']?>" target="_blank"><?php echo $val['wav'];?></a></TD>
				<TD vAlign=top width="20%" bgColor=#ffffff><a href="#" disabled>Delete</a></TD>
			</TR>
			<?
			}
			}
			?></TBODY>
		</TABLE><BR><BR>
		<BR></DIV>
	</TD>
	</TR></TBODY>
</TABLE>

<DIV class=footer>
<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
<TBODY>
	<TR>
		<TD bgColor=#bbbbbb><IMG height=1 alt="" src="images/spacer.gif" width=100 border=0></TD></TR>
	<TR></TR>
	<TR>
		<TD background="images/border_bottom.gif" height=12><IMG height=1 src="images/spacer.gif" width=1 border=0></TD>
	</TR></TBODY>
</TABLE>
</DIV></BODY></HTML>
