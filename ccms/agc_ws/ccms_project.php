<?php
$project_html1 = <<<EOD
		PauseCode_HTML = '';

		document.getElementById("PauseCodeSelection").value = '';

		PauseCode_HTML = "<table class=\"pausecode_tb\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"100%\" ><tr><td>";
		var loop_ct = 0;
		while (loop_ct < VD_pause_codes_ct)
		{
			if((PauseCode_Default!="") && (PauseCode_Default==VARpause_codes[loop_ct])){
				PauseCode_HTML = PauseCode_HTML + "<input onclick=\"PauseCodeSelect_submit('" + VARpause_codes[loop_ct] + "');\" type=\"radio\" name=\"PauseRadioSelect\" value=\"" + VARpause_codes[loop_ct] + "\" id=\"PauseRadioSelect\" disabled=\"disabled\" checked=\"checked\"/>" + VARpause_codes[loop_ct] + " - " + VARpause_code_names[loop_ct] + "&nbsp;&nbsp;";
			}else{
				PauseCode_HTML = PauseCode_HTML + "<input onclick=\"PauseCodeSelect_submit('" + VARpause_codes[loop_ct] + "');\" type=\"radio\" name=\"PauseRadioSelect\" value=\"" + VARpause_codes[loop_ct] + "\" id=\"PauseRadioSelect\" disabled=\"disabled\"/>" + VARpause_codes[loop_ct] + " - " + VARpause_code_names[loop_ct] + "&nbsp;&nbsp;";
			}
			loop_ct++;
		}

		PauseCode_HTML = PauseCode_HTML + "</td></tr></table>";
		if (agent_pause_codes_active=='FORCE' || agent_pause_codes_active=='Y'){
			document.getElementById("DispoPauseHTMLContent").innerHTML = PauseCode_HTML;
		}
EOD;

$project_html2 = "";

$project_html3 = "";

$project_html4 = "";
?>
