<?php
$project_html1 = "";

$project_html2 = <<<EOD
			document.getElementById("iframetree").innerHTML="";
EOD;

$project_html3 = <<<EOD
				document.getElementById("iframetree").innerHTML='<iframe  scrolling="auto" width="350px" height="680px" frameborder="no" border="0" marginwidth="0" marginheight="0" scrolling="no" allowtransparency="yes" src="../agc/ehsn_finish.php?canpaign=006" ></iframe>';
EOD;

$project_html4 = <<<EOD
	<span id="DispoSelectContent" style="display:none"> 结束码选择 </span>
	<div id="iframetree"></div>
	<input type=checkbox name=DispoSelectStop size=1 value="0" onClick="change_pause_code();">暂停话务员<BR>
	<div style="display:none">
	<a href="#" onClick="DispoSelect_submit();return false;">确认</a>
	<input type=hidden name=DispoSelection id=DispoSelection ><BR><!-- yanson target -->
	</div>
EOD;
?>
