<?php
# vicidial.php 
 
$version         = '2.2.1-259';
$build           = '100510-2014';
$mel             = 1; # Mysql Error Log enabled = 1
$mysql_log_count = 64;
$one_mysql_log   = 0;

##### MySQL Error Logging #####
function mysql_error_logging($NOW_TIME, $link, $mel, $stmt, $query_id, $user, $server_ip, $session_name, $one_mysql_log){
    $NOW_TIME = date("Y-m-d H:i:s");
    $errno    = '';
    $error    = '';
    if (($mel > 0) or ($one_mysql_log > 0)) {
        $errno = mysql_errno($link);
        
        if (($errno > 0) or ($mel > 1) or ($one_mysql_log > 0)) {
            $error = mysql_error($link);
            $efp   = fopen("./vicidial_mysql_errors.txt", "a");
            fwrite($efp, "$NOW_TIME|vicidial    |$query_id|$errno|$error|$stmt|$user|$server_ip|$session_name|\n");
            fclose($efp);
        }
    }
    $one_mysql_log = 0;
    return $errno;
}


if (isset($_GET["DB"])) {
    $DB = $_GET["DB"];
} elseif (isset($_POST["DB"])) {
    $DB = $_POST["DB"];
}
if (isset($_GET["JS_browser_width"])) {
    $JS_browser_width = $_GET["JS_browser_width"];
} elseif (isset($_POST["JS_browser_width"])) {
    $JS_browser_width = $_POST["JS_browser_width"];
}
if (isset($_GET["JS_browser_height"])) {
    $JS_browser_height = $_GET["JS_browser_height"];
} elseif (isset($_POST["JS_browser_height"])) {
    $JS_browser_height = $_POST["JS_browser_height"];
}
if (isset($_GET["phone_login"])) {
    $phone_login = $_GET["phone_login"];
} elseif (isset($_POST["phone_login"])) {
    $phone_login = $_POST["phone_login"];
}
if (isset($_GET["phone_pass"])) {
    $phone_pass = $_GET["phone_pass"];
} elseif (isset($_POST["phone_pass"])) {
    $phone_pass = $_POST["phone_pass"];
}
if (isset($_GET["VD_login"])) {
    $VD_login = $_GET["VD_login"];
} elseif (isset($_POST["VD_login"])) {
    $VD_login = $_POST["VD_login"];
}
if (isset($_GET["VD_pass"])) {
    $VD_pass = $_GET["VD_pass"];
} elseif (isset($_POST["VD_pass"])) {
    $VD_pass = $_POST["VD_pass"];
}
if (isset($_GET["VD_campaign"])) {
    $VD_campaign = $_GET["VD_campaign"];
} elseif (isset($_POST["VD_campaign"])) {
    $VD_campaign = $_POST["VD_campaign"];
}
if (isset($_GET["relogin"])) {
    $relogin = $_GET["relogin"];
} elseif (isset($_POST["relogin"])) {
    $relogin = $_POST["relogin"];
}
if (isset($_GET["MGR_override"])) {
    $MGR_override = $_GET["MGR_override"];
} elseif (isset($_POST["MGR_override"])) {
    $MGR_override = $_POST["MGR_override"];
}

if (!isset($phone_login)) {
    if (isset($_GET["pl"])) {
        $phone_login = $_GET["pl"];
    } elseif (isset($_POST["pl"])) {
        $phone_login = $_POST["pl"];
    }
}

if (!isset($phone_pass)) {
    if (isset($_GET["pp"])) {
        $phone_pass = $_GET["pp"];
        
    } elseif (isset($_POST["pp"])) {
        $phone_pass = $_POST["pp"];
    }
}

if (isset($VD_campaign)) {
    $VD_campaign = strtoupper($VD_campaign);
    $VD_campaign = eregi_replace(" ", '', $VD_campaign);
}
if (!isset($flag_channels)) {
    $flag_channels = 0;
    $flag_string   = '';
}

### security strip all non-alphanumeric characters out of the variables ###

$DB          = ereg_replace("[^0-9a-z]", "", $DB);
$phone_login = ereg_replace("[^\,0-9a-zA-Z]", "", $phone_login);
$phone_pass  = ereg_replace("[^0-9a-zA-Z]", "", $phone_pass);
$VD_login    = ereg_replace("[^-_0-9a-zA-Z]", "", $VD_login);
$VD_pass     = ereg_replace("[^-_0-9a-zA-Z]", "", $VD_pass);
$VD_campaign = ereg_replace("[^-_0-9a-zA-Z]", "", $VD_campaign);

$forever_stop = 0;

if ($force_logout) {
    echo "您已经签退，请重新签入！\n";
    exit;
}

$isdst             = date("I");
$StarTtimE         = date("U");
$NOW_TIME          = date("Y-m-d H:i:s");
$tsNOW_TIME        = date("YmdHis");
$FILE_TIME         = date("Ymd-His");
$loginDATE         = date("Ymd");
$CIDdate           = date("ymdHis");
$month_old         = mktime(11, 0, 0, date("m"), date("d") - 2, date("Y"));
$past_month_date   = date("Y-m-d H:i:s", $month_old);
$minutes_old       = mktime(date("H"), date("i") - 2, date("s"), date("m"), date("d"), date("Y"));
$past_minutes_date = date("Y-m-d H:i:s", $minutes_old);


$random = (rand(1000000, 9999999) + 10000000);

#############################################
##### START SYSTEM_SETTINGS LOOKUP #####
$stmt = "SELECT use_non_latin,vdc_header_date_format,vdc_customer_date_format,vdc_header_phone_format,webroot_writable,timeclock_end_of_day,vtiger_url,enable_vtiger_integration,outbound_autodial_active,enable_second_webform,user_territories_active FROM system_settings;";
$rslt = mysql_query($stmt, $link);
if ($mel > 0) {
    mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01001', $VD_login, $server_ip, $session_name, $one_mysql_log);
}
if ($DB) {
    echo "$stmt\n";
}
$qm_conf_ct = mysql_num_rows($rslt);
if ($qm_conf_ct > 0) {
    $row                       = mysql_fetch_row($rslt);
    $non_latin                 = $row[0];
    $vdc_header_date_format    = $row[1];
    $vdc_customer_date_format  = $row[2];
    $vdc_header_phone_format   = $row[3];
    $WeBRooTWritablE           = $row[4];
    $timeclock_end_of_day      = $row[5];
    $vtiger_url                = $row[6];
    $enable_vtiger_integration = $row[7];
    $outbound_autodial_active  = $row[8];
    $enable_second_webform     = $row[9];
    $user_territories_active   = $row[10];
}
##### END SETTINGS LOOKUP #####
###########################################


##### DEFINABLE SETTINGS AND OPTIONS
###########################################
$conf_silent_prefix       = '5'; # vicidial_conferences prefix to enter silently and muted for recording
$dtmf_silent_prefix       = '7'; # vicidial_conferences prefix to enter silently
$HKuser_level             = '5'; # minimum vicidial user_level for HotKeys
$campaign_login_list      = '1'; # show drop-down list of campaigns at login	
$manual_dial_preview      = '1'; # allow preview lead option when manual dial
$multi_line_comments      = '1'; # set to 1 to allow multi-line comment box
$user_login_first         = '0'; # set to 1 to have the vicidial_user login before the phone login
$view_scripts             = '1'; # set to 1 to show the SCRIPTS tab
$dispo_check_all_pause    = '0'; # set to 1 to allow for persistent pause after dispo
$callholdstatus           = '1'; # set to 1 to show calls on hold count
$agentcallsstatus         = '0'; # set to 1 to show agent status and call dialed count
$campagentstatctmax       = '3'; # Number of seconds for campaign call and agent stats
$show_campname_pulldown   = '1'; # set to 1 to show campaign name on login pulldown
$webform_sessionname      = '1'; # set to 1 to include the session_name in webform URL
$local_consult_xfers      = '1'; # set to 1 to send consultative transfers from original server
$clientDST                = '1'; # set to 1 to check for DST on server for agent time
$no_delete_sessions       = '1'; # set to 1 to not delete sessions at logout
$volumecontrol_active     = '1'; # set to 1 to allow agents to alter volume of channels
$PreseT_DiaL_LinKs        = '0'; # set to 1 to show a DIAL link for Dial Presets
$LogiNAJAX                = '1'; # set to 1 to do lookups on campaigns for login
$HidEMonitoRSessionS      = '1'; # set to 1 to hide remote monitoring channels from "session calls"
$hangup_all_non_reserved  = '1'; # set to 1 to force hangup all non-reserved channels upon Hangup Customer
$LogouTKicKAlL            = '1'; # set to 1 to hangup all calls in session upon agent logout
$PhonESComPIP             = '1'; # set to 1 to log computer IP to phone if blank, set to 2 to force log each login
$DefaulTAlTDiaL           = '0'; # set to 1 to enable ALT DIAL by default if enabled for the campaign
$AgentAlert_allowed       = '1'; # set to 1 to allow Agent alert option
$disable_blended_checkbox = '0'; # set to 1 to disable the BLENDED checkbox from the in-group chooser screen

$TEST_all_statuses = '0'; # TEST variable allows all statuses in dispo screen

$stretch_dimensions = '1'; # sets the vicidial screen to the size of the browser window
$BROWSER_HEIGHT     = 500; # set to the minimum browser height, default=500
$BROWSER_WIDTH      = 770; # set to the minimum browser width, default=770
//$MAIN_COLOR				= '#00CC00';	# old default is E0C2D6
$MAIN_COLOR         = ''; # old default is E0C2D6
//$SCRIPT_COLOR			= '#E6E6E6';	# old default is FFE7D0
$SCRIPT_COLOR       = '';
$SIDEBAR_COLOR      = '#F6F6F6';

# options now set in DB:
#$alt_phone_dialing		= '1';	# allow agents to call alt phone numbers
#$scheduled_callbacks	= '1';	# set to 1 to allow agent to choose scheduled callbacks
#   $agentonly_callbacks	= '1';	# set to 1 to allow agent to choose agent-only scheduled callbacks
#$agentcall_manual		= '1';	# set to 1 to allow agent to make manual calls during autodial session


$US          = '_';
$CL          = ':';
$AT          = '@';
$DS          = '-';
$date        = date("r");
$ip          = getenv("REMOTE_ADDR");
$browser     = getenv("HTTP_USER_AGENT");
/*$script_name = getenv("SCRIPT_NAME");
$server_name = getenv("SERVER_NAME");
$server_port = getenv("SERVER_PORT");*/
//echo (getenv("SCRIPT_NAME"));
/*
if (eregi("443", $server_port)) {
    $HTTPprotocol = 'https://';
} else {
    $HTTPprotocol = 'http://';
}
if (($server_port == '80') or ($server_port == '443')) {
    $server_port = '';
} else {
    $server_port = "$CL$server_port";
}
$agcPAGE = "$HTTPprotocol$server_name$server_port$script_name";
$agcDIR  = eregi_replace('vicidial.php', '', $agcPAGE);

header("Content-type: text/html; charset=utf-8");
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Pragma: no-cache"); // HTTP/1.0*/

$html_head = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xHTML1/DTD/xHTML1-transitional.dtd\">\n";
$html_head .= "<HTML xmlns=\"http://www.w3.org/1999/xHTML\">\n";
$html_head .= "<head>\n";
$html_head .= "<meta http-equiv=\"Content-Type\" content=\"text/HTML; charset=utf-8\" />\n";
$html_head .= "<title>$system_name</title>\n";
$html_head .= "<link href=\"style.css?v=$random\" rel=\"stylesheet\" type=\"text/css\">\n";
$html_head .= "<script src=\"/js/jquery-1.8.3.min.js\"></script>\n";

if ($campaign_login_list > 0) {
    $camp_form_code = "<select size=1 name=VD_campaign id=VD_campaign onFocus=\"login_allowable_campaigns()\">\n";
    $camp_form_code .= "<option value=\"\"></option>\n";
    
    $LOGallowed_campaignsSQL = '';
    if ($relogin == 'YES') {
        $stmt = "SELECT user_group from vicidial_users where user='$VD_login' and pass='$VD_pass';";
        if ($non_latin > 0) {
            $rslt = mysql_query("SET NAMES 'UTF8'");
        }
        $rslt = mysql_query($stmt, $link);
        if ($mel > 0) {
            mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01002', $VD_login, $server_ip, $session_name, $one_mysql_log);
        }
        $row           = mysql_fetch_row($rslt);
        $VU_user_group = $row[0];
        
        $stmt = "SELECT allowed_campaigns from vicidial_user_groups where user_group='$VU_user_group';";
        $rslt = mysql_query($stmt, $link);
        if ($mel > 0) {
            mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01003', $VD_login, $server_ip, $session_name, $one_mysql_log);
        }
        $row = mysql_fetch_row($rslt);
        if ((!eregi("ALL-CAMPAIGNS", $row[0]))) {
            $LOGallowed_campaignsSQL = eregi_replace(' -', '', $row[0]);
            $LOGallowed_campaignsSQL = eregi_replace(' ', "','", $LOGallowed_campaignsSQL);
            $LOGallowed_campaignsSQL = "and campaign_id IN('$LOGallowed_campaignsSQL')";
        }
    }
    
    ### code for manager override of shift restrictions
    if ($MGR_override > 0) {
        if (isset($_GET["MGR_login$loginDATE"])) {
            $MGR_login = $_GET["MGR_login$loginDATE"];
        } elseif (isset($_POST["MGR_login$loginDATE"])) {
            $MGR_login = $_POST["MGR_login$loginDATE"];
        }
        if (isset($_GET["MGR_pass$loginDATE"])) {
            $MGR_pass = $_GET["MGR_pass$loginDATE"];
        } elseif (isset($_POST["MGR_pass$loginDATE"])) {
            $MGR_pass = $_POST["MGR_pass$loginDATE"];
        }
        
        $stmt = "SELECT count(*) from vicidial_users where user='$MGR_login' and pass='$MGR_pass' and manager_shift_enforcement_override='1' and active='Y';";
        if ($DB) {
            echo "|$stmt|\n";
        }
        $rslt = mysql_query($stmt, $link);
        if ($mel > 0) {
            mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01058', $VD_login, $server_ip, $session_name, $one_mysql_log);
        }
        $row      = mysql_fetch_row($rslt);
        $MGR_auth = $row[0];
        
        if ($MGR_auth > 0) {
            $stmt = "UPDATE vicidial_users SET shift_override_flag='1' where user='$VD_login' and pass='$VD_pass';";
            if ($DB) {
                echo "|$stmt|\n";
            }
            $rslt = mysql_query($stmt, $link);
            if ($mel > 0) {
                mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01059', $VD_login, $server_ip, $session_name, $one_mysql_log);
            }
            echo "<!-- Shift Override entered for $VD_login by $MGR_login -->\n";
            
            ### Add a record to the vicidial_admin_log
            $SQL_log = "$stmt|";
            $SQL_log = ereg_replace(';', '', $SQL_log);
            $SQL_log = addslashes($SQL_log);
            $stmt    = "INSERT INTO vicidial_admin_log set event_date='$NOW_TIME', user='$MGR_login', ip_address='$ip', event_section='AGENT', event_type='OVERRIDE', record_id='$VD_login', event_code='MANAGER OVERRIDE OF AGENT SHIFT ENFORCEMENT', event_sql=\"$SQL_log\", event_notes='user: $VD_login';";
            if ($DB) {
                echo "|$stmt|\n";
            }
            $rslt = mysql_query($stmt, $link);
            if ($mel > 0) {
                mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01060', $VD_login, $server_ip, $session_name, $one_mysql_log);
            }
        }
    }
    
    
    $stmt = "SELECT campaign_id,campaign_name from vicidial_campaigns where active='Y' $LOGallowed_campaignsSQL order by campaign_id;";
    if ($non_latin > 0) {
        $rslt = mysql_query("SET NAMES 'UTF8'");
    }
    $rslt = mysql_query($stmt, $link);
    if ($mel > 0) {
        mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01004', $VD_login, $server_ip, $session_name, $one_mysql_log);
    }
    $camps_to_print = mysql_num_rows($rslt);
    
    $o = 0;
    while ($camps_to_print > $o) {
        $rowx = mysql_fetch_row($rslt);
        if ($show_campname_pulldown) {
            $campname = " - $rowx[1]";
        } else {
            $campname = '';
        }
        if ($VD_campaign) {
            if ((eregi("$VD_campaign", $rowx[0])) and (strlen($VD_campaign) == strlen($rowx[0]))) {
                $camp_form_code .= "<option value=\"$rowx[0]\" selected>$rowx[0]$campname</option>\n";
            } else {
                if (!ereg('login_allowable_campaigns', $camp_form_code)) {
                    $camp_form_code .= "<option value=\"$rowx[0]\">$rowx[0]$campname</option>\n";
                }
            }
            
        } else {
            if (!ereg('login_allowable_campaigns', $camp_form_code)) {
                $camp_form_code .= "<option value=\"$rowx[0]\">$rowx[0]$campname</option>\n";
            }
        }
        $o++;
    }
    $camp_form_code .= "</select>\n";
} else {
    $camp_form_code = "<INPUT TYPE=TEXT NAME=VD_campaign id='VD_campaign' SIZE=10 MAXLENGTH=20 VALUE=\"$VD_campaign\">\n";
}


if ($LogiNAJAX > 0) {
    echo $html_head;
?>

<script language="Javascript">
 
function fTrim(str){return str.replace(/(^\s*)|(\s*$)/g,"")};
function fLoginFormSubmit() {
   
    phone_login = fTrim($("#phone_login").val());
    phone_pass = fTrim($("#phone_pass").val());
    VD_login = fTrim($("#VD_login").val());
    VD_pass = fTrim($("#VD_pass").val());
    if (phone_login == "") {
        alert("请输入分机号码！");
        $("#phone_login").focus();
        return false
    }
    if (phone_pass == "") {
        alert("请输入分机密码！");
        $("#phone_pass").focus();
        return false
    }
    if (VD_login == "") {
        alert("请输入工号号码！");
        $("#VD_login").focus();
        return false
    }
    if (VD_pass== "") {
        alert("请输入工号密码！");
        $("#VD_pass").focus();
        return false
    }
    if ($("#VD_campaign").val() == "") {
        alert("请选择您要进入的业务活动！");
        $("#VD_campaign").focus();
        return false
    }
    return true
}

var BrowseWidth = 0;
var BrowseHeight = 0;
 
function login_allowable_campaigns(){
	 
	logincampaign_query = "&user="+$("#VD_login").val()+"&pass=" +$("#VD_pass").val()+"&ACTION=LogiNCamPaigns&format=html";
 	$.ajax({
		type: "post", 
		dataType: "html", 
		url: "vdc_db_query.php",
		data:logincampaign_query,
		cache:false,
		beforeSend:function(){$('#load').css("top",$(document).scrollTop());$('#load').show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(htmls){ 
			$("#LogiNCamPaigns").html(htmls);
			<?php 
				if($relogin=="YES"){
					echo "$('#VD_campaign').val($VD_campaign);";
				}
			?>
			
			$("#LogiNReseT").html("<input name=\"relist\" type=\"image\" id=\"relist\" src=\"/img/login_list.jpg\" alt=\"刷新获取业务活动列表\" onClick=\"javascript:login_allowable_campaigns();return false\"/>");
			
		},error:function(XMLHttpRequest,textStatus ){
			alert("页面请求错误，请联系系统管理员！\n"+textStatus);
		}
	});
}
 
</script>

<?php
 
}

if ($relogin == 'YES') {
	echo "<script>$(document).ready(function(){login_allowable_campaigns();});</script>";
    echo "</head>\n";
    echo "<body marginheight=\"0\" marginwidth=\"0\" >\n";
    //echo "<div class=\"time_lock\" ><a href=\"./timeclock.php?referrer=agent&pl=$phone_login&pp=$phone_pass&VD_login=$VD_login&VD_pass=$VD_pass\">时间锁</a></div>\n";
    echo "<div class=\"login_form\">\n";
    echo "   <form id=\"vicidial_form\" name=\"vicidial_form\" method=\"post\" action=\"?\" onSubmit=\"return fLoginFormSubmit();\" >\n";
    if ($VDdisplayMESSAGE) {
        echo "<div class=\"load_layer\">$VDdisplayMESSAGE</div>\n";
    }
    echo "        <input type=\"hidden\" name=\"DB\" value=\"$DB\">\n";
    
    echo "        <div class=\"login_1\"><img src=\"/img/login_bg_1.jpg\" width=\"631\" height=\"60\" /></div>\n";
    echo "        <div class=\"login_2\">\n";
    echo "        <div class=\"login_user\"><input name=\"phone_login\" id=\"phone_login\" title=\"请输入分机号\" maxlength=\"20\" value=\"$phone_login\" /></div>\n";
    echo "       <div class=\"login_user\"><input name=\"phone_pass\" id=\"phone_pass\" title=\"请输入分机密码\" maxlength=\"20\" type=\"password\" value=\"$phone_pass\" /></div>\n";
    echo "       <div class=\"login_user\"><input name=\"VD_login\" id=\"VD_login\" title=\"请输入工号\" maxlength=\"20\" value=\"$VD_login\" /></div>\n";
    echo "        <div class=\"login_user\"><input name=\"VD_pass\" id=\"VD_pass\" title=\"请输入工号密码\" maxlength=\"20\" type=\"password\" value=\"$VD_pass\" /></div>\n";
    echo "        <div class=\"login_user\">\n";
    echo "            <span id=\"LogiNCamPaigns\">\n";
    echo "                <select name=\"VD_campaign\" id=\"VD_campaign\" onFocus=\"login_allowable_campaigns()\" class=\"lead\" title=\"请选择您要进入的业务活动\">\n";
    echo "                 <option value=\"\"></option>\n";
    echo "                </select>\n";
    echo "            </span>\n";
    echo "        </div>\n";
    echo "     </div>\n";
    echo "        <div class=\"login_3\">\n";
    echo "       	  <div class=\"login_sub\">\n";
    echo "       	     <input name=\"imageField\" type=\"image\" id=\"imageField\" src=\"/img/login_sumit.jpg\" alt=\"点击登陆\" />\n";
    echo "        	</div>\n";
    echo "            <div class=\"login_sub\">\n";
    echo "            	<span id=\"LogiNReseT\">\n";
    echo "             		<input name=\"relist\" type=\"image\" id=\"relist\" src=\"/img/login_list.jpg\" alt=\"刷新获取业务活动列表\" onClick=\"javascript:login_allowable_campaigns();return false\"/>\n";
    echo "              	</span>\n";
    echo "            </div>\n";
    echo "        </div>\n";
    echo "    </form>\n";
    echo "    <div class=\"login_foot\">$system_company</div>\n";
    echo "</div>\n";
    echo "</body>\n";
    echo "</html>\n";
    exit;
}

if ($user_login_first == 1) {
    if ((strlen($VD_login) < 1) or (strlen($VD_pass) < 1) or (strlen($VD_campaign) < 1)) {
        echo "</head>\n";
        echo "<body marginheight=\"0\" marginwidth=\"0\" >\n";
        //echo "<div class=\"time_lock\" ><a href=\"./timeclock.php?referrer=agent&pl=$phone_login&pp=$phone_pass&VD_login=$VD_login&VD_pass=$VD_pass\">时间锁</a></div>\n";
        echo "<div class=\"login_form\">\n";
        echo "   <form id=\"vicidial_form\" name=\"vicidial_form\" method=\"post\" action=\"?\" onSubmit=\"return fLoginFormSubmit();\" >\n";
        if ($VDdisplayMESSAGE) {
            echo "<div class=\"load_layer\">$VDdisplayMESSAGE</div>\n";
        }
        echo "        <input type=\"hidden\" name=\"DB\" value=\"$DB\">\n";
        
        echo "        <div class=\"login_1\"><img src=\"/img/login_bg_1.jpg\" width=\"631\" height=\"60\" /></div>\n";
        echo "        <div class=\"login_2\">\n";
        echo "        <div class=\"login_user\"><input name=\"phone_login\" id=\"phone_login\" title=\"请输入分机号\" maxlength=\"20\" value=\"$phone_login\" /></div>\n";
        echo "       <div class=\"login_user\"><input name=\"phone_pass\" id=\"phone_pass\" title=\"请输入分机密码\" maxlength=\"20\" type=\"password\" value=\"$phone_pass\" /></div>\n";
        echo "       <div class=\"login_user\"><input name=\"VD_login\" id=\"VD_login\" title=\"请输入工号\" maxlength=\"20\" value=\"$VD_login\" /></div>\n";
        echo "        <div class=\"login_user\"><input name=\"VD_pass\" id=\"VD_pass\" title=\"请输入工号密码\" maxlength=\"20\" type=\"password\" value=\"$VD_pass\" /></div>\n";
        echo "        <div class=\"login_user\">\n";
        echo "            <span id=\"LogiNCamPaigns\">\n";
        echo "                <select name=\"VD_campaign\" id=\"VD_campaign\" onFocus=\"login_allowable_campaigns()\" class=\"lead\" title=\"请选择您要进入的业务活动\">\n";
        echo "                 <option value=\"\"></option>\n";
        echo "                </select>\n";
        echo "            </span>\n";
        echo "        </div>\n";
        echo "     </div>\n";
        echo "        <div class=\"login_3\">\n";
        echo "       	  <div class=\"login_sub\">\n";
        echo "       	     <input name=\"imageField\" type=\"image\" id=\"imageField\" src=\"/img/login_sumit.jpg\" alt=\"点击登陆\" />\n";
        echo "        	</div>\n";
        echo "            <div class=\"login_sub\">\n";
        echo "            	<span id=\"LogiNReseT\">\n";
        echo "             		<input name=\"relist\" type=\"image\" id=\"relist\" src=\"/img/login_list.jpg\" alt=\"刷新获取业务活动列表\" onClick=\"javascript:login_allowable_campaigns();return false\"/>\n";
        echo "              	</span>\n";
        echo "            </div>\n";
        echo "        </div>\n";
        echo "    </form>\n";
        echo "    <div class=\"login_foot\">$system_company</div>\n";
        echo "</div>\n";
        echo "</body>\n";
        echo "</html>\n";
        exit;
        
    } else {
        if ((strlen($phone_login) < 2) or (strlen($phone_pass) < 2)) {
            $stmt = "SELECT phone_login,phone_pass,full_name from vicidial_users where user='$VD_login' and pass='$VD_pass' and user_level > 0 and active='Y';";
			
			
            if ($DB) {
                echo "|$stmt|\n";
            }
            $rslt = mysql_query($stmt, $link);
            if ($mel > 0) {
                mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01005', $VD_login, $server_ip, $session_name, $one_mysql_log);
            }
            $row         = mysql_fetch_row($rslt);
            $phone_login = $row[0];
            $phone_pass  = $row[1];
            //$full_name=$row[2];
            
            echo "</head>\n";
            echo "<body marginheight=\"0\" marginwidth=\"0\" >\n";
            //echo "<div class=\"time_lock\" ><a href=\"./timeclock.php?referrer=agent&pl=$phone_login&pp=$phone_pass&VD_login=$VD_login&VD_pass=$VD_pass\">时间锁</a></div>\n";
            echo "<div class=\"login_form\">\n";
            echo "   <form id=\"vicidial_form\" name=\"vicidial_form\" method=\"post\" action=\"?\" onSubmit=\"return fLoginFormSubmit();\" >\n";
            if ($VDdisplayMESSAGE) {
                echo "<div class=\"load_layer\">$VDdisplayMESSAGE</div>\n";
            }
            echo "        <input type=\"hidden\" name=\"DB\" value=\"$DB\">\n";
            
            echo "        <div class=\"login_1\"><img src=\"/img/login_bg_1.jpg\" width=\"631\" height=\"60\" /></div>\n";
            echo "        <div class=\"login_2\">\n";
            echo "        <div class=\"login_user\"><input name=\"phone_login\" id=\"phone_login\" title=\"请输入分机号\" maxlength=\"20\" value=\"$phone_login\" /></div>\n";
            echo "       <div class=\"login_user\"><input name=\"phone_pass\" id=\"phone_pass\" title=\"请输入分机密码\" maxlength=\"20\" type=\"password\" value=\"$phone_pass\" /></div>\n";
            echo "       <div class=\"login_user\"><input name=\"VD_login\" id=\"VD_login\" title=\"请输入工号\" maxlength=\"20\" value=\"$VD_login\" /></div>\n";
            echo "        <div class=\"login_user\"><input name=\"VD_pass\" id=\"VD_pass\" title=\"请输入工号密码\" maxlength=\"20\" type=\"password\" value=\"$VD_pass\" /></div>\n";
            echo "        <div class=\"login_user\">\n";
            echo "            <span id=\"LogiNCamPaigns\">\n";
            echo "                <select name=\"VD_campaign\" id=\"VD_campaign\" onFocus=\"login_allowable_campaigns()\" class=\"lead\" title=\"请选择您要进入的业务活动\">\n";
            echo "                 <option value=\"\"></option>\n";
            echo "                </select>\n";
            echo "            </span>\n";
            echo "        </div>\n";
            echo "     </div>\n";
            echo "        <div class=\"login_3\">\n";
            echo "       	  <div class=\"login_sub\">\n";
            echo "       	     <input name=\"imageField\" type=\"image\" id=\"imageField\" src=\"/img/login_sumit.jpg\" alt=\"点击登陆\" />\n";
            echo "        	</div>\n";
            echo "            <div class=\"login_sub\">\n";
            echo "            	<span id=\"LogiNReseT\">\n";
            echo "             		<input name=\"relist\" type=\"image\" id=\"relist\" src=\"/img/login_list.jpg\" alt=\"刷新获取业务活动列表\" onClick=\"javascript:login_allowable_campaigns();return false\"/>\n";
            echo "              	</span>\n";
            echo "            </div>\n";
            echo "        </div>\n";
            echo "    </form>\n";
            echo "    <div class=\"login_foot\">$system_company</div>\n";
            echo "</div>\n";
            echo "</body>\n";
            echo "</html>\n";
            exit;
        }
    }
}

if ((strlen($phone_login) < 2) or (strlen($phone_pass) < 2)) {
    echo "</head>\n";
    echo "<body marginheight=\"0\" marginwidth=\"0\" >\n";
    //echo "<div class=\"time_lock\" ><a href=\"./timeclock.php?referrer=agent&pl=$phone_login&pp=$phone_pass&VD_login=$VD_login&VD_pass=$VD_pass\">时间锁</a></div>\n";
    echo "<div class=\"login_form\">\n";
    echo "   <form id=\"vicidial_form\" name=\"vicidial_form\" method=\"post\" action=\"?\" onSubmit=\"return fLoginFormSubmit();\" >\n";
    if ($VDdisplayMESSAGE) {
        echo "<div class=\"load_layer\">$VDdisplayMESSAGE</div>\n";
    }
    echo "        <input type=\"hidden\" name=\"DB\" value=\"$DB\">\n";
    
    echo "        <div class=\"login_1\"><img src=\"/img/login_bg_1.jpg\" width=\"631\" height=\"60\" /></div>\n";
    echo "        <div class=\"login_2\">\n";
    echo "        <div class=\"login_user\"><input name=\"phone_login\" id=\"phone_login\" title=\"请输入分机号\" maxlength=\"20\" value=\"$phone_login\" /></div>\n";
    echo "       <div class=\"login_user\"><input name=\"phone_pass\" id=\"phone_pass\" title=\"请输入分机密码\" maxlength=\"20\" type=\"password\" value=\"$phone_pass\" /></div>\n";
    echo "       <div class=\"login_user\"><input name=\"VD_login\" id=\"VD_login\" title=\"请输入工号\" maxlength=\"20\" value=\"$VD_login\" /></div>\n";
    echo "        <div class=\"login_user\"><input name=\"VD_pass\" id=\"VD_pass\" title=\"请输入工号密码\" maxlength=\"20\" type=\"password\" value=\"$VD_pass\" /></div>\n";
    echo "        <div class=\"login_user\">\n";
    echo "            <span id=\"LogiNCamPaigns\">\n";
    echo "                <select name=\"VD_campaign\" id=\"VD_campaign\" onFocus=\"login_allowable_campaigns()\" class=\"lead\" title=\"请选择您要进入的业务活动\">\n";
    echo "                 <option value=\"\"></option>\n";
    echo "                </select>\n";
    echo "            </span>\n";
    echo "        </div>\n";
    echo "     </div>\n";
    echo "        <div class=\"login_3\">\n";
    echo "       	  <div class=\"login_sub\">\n";
    echo "       	     <input name=\"imageField\" type=\"image\" id=\"imageField\" src=\"/img/login_sumit.jpg\" alt=\"点击登陆\" />\n";
    
    
    echo "        	</div>\n";
    echo "            <div class=\"login_sub\">\n";
    echo "            	<span id=\"LogiNReseT\">\n";
    echo "             		<input name=\"relist\" type=\"image\" id=\"relist\" src=\"/img/login_list.jpg\" alt=\"刷新获取业务活动列表\" onClick=\"javascript:login_allowable_campaigns();return false\"/>\n";
    echo "              	</span>\n";
    echo "            </div>\n";
    echo "        </div>\n";
    echo "    </form>\n";
    echo "    <div class=\"login_foot\">$system_company</div>\n";
    echo "</div>\n";
    echo "</body>\n";
    echo "</html>\n";
    exit;
    
} else {
    if ($WeBRooTWritablE > 0) {
        $fp = fopen("./vicidial_auth_entries.txt", "a");
    }
    $VDloginDISPLAY = 0;
    
    if ((strlen($VD_login) < 2) or (strlen($VD_pass) < 2) or (strlen($VD_campaign) < 2)) {
        $VDloginDISPLAY = 1;
    } else {
        $stmt = "SELECT count(*) from vicidial_users where user='$VD_login' and pass='$VD_pass' and user_level > 0 and active='Y';";
        if ($DB) {
            echo "|$stmt|\n";
        }
        $rslt = mysql_query($stmt, $link);
        if ($mel > 0) {
            mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01006', $VD_login, $server_ip, $session_name, $one_mysql_log);
        }
        $row  = mysql_fetch_row($rslt);
        $auth = $row[0];
        
        if ($auth > 0) {
            $login    = strtoupper($VD_login);
            $password = strtoupper($VD_pass);
            ##### grab the full name of the agent
            $stmt     = "SELECT full_name,user_level,hotkeys_active,agent_choose_ingroups,scheduled_callbacks,agentonly_callbacks,agentcall_manual,vicidial_recording,vicidial_transfers,closer_default_blended,user_group,vicidial_recording_override,alter_custphone_override,alert_enabled,agent_shift_enforcement_override,shift_override_flag,allow_alerts,closer_campaigns,agent_choose_territories,custom_one,custom_two,custom_three,custom_four,custom_five from vicidial_users where user='$VD_login' and pass='$VD_pass'";
            $rslt     = mysql_query($stmt, $link);
            if ($mel > 0) {
                mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01007', $VD_login, $server_ip, $session_name, $one_mysql_log);
            }
            $row                                 = mysql_fetch_row($rslt);
            $LOGfullname                         = $row[0];
            $user_level                          = $row[1];
            $VU_hotkeys_active                   = $row[2];
            $VU_agent_choose_ingroups            = $row[3];
            $VU_scheduled_callbacks              = $row[4];
            $agentonly_callbacks                 = $row[5];
            $agentcall_manual                    = $row[6];
            $VU_vicidial_recording               = $row[7];
            $VU_vicidial_transfers               = $row[8];
            $VU_closer_default_blended           = $row[9];
            $VU_user_group                       = $row[10];
            $VU_vicidial_recording_override      = $row[11];
            $VU_alter_custphone_override         = $row[12];
            $VU_alert_enabled                    = $row[13];
            $VU_agent_shift_enforcement_override = $row[14];
            $VU_shift_override_flag              = $row[15];
            $VU_allow_alerts                     = $row[16];
            $VU_closer_campaigns                 = $row[17];
            $VU_agent_choose_territories         = $row[18];
            $VU_custom_one                       = $row[19];
            $VU_custom_two                       = $row[20];
            $VU_custom_three                     = $row[21];
            $VU_custom_four                      = $row[22];
            $VU_custom_five                      = $row[23];
            
            if (($VU_alert_enabled > 0) and ($VU_allow_alerts > 0)) {
                $VU_alert_enabled = 'ON';
            } else {
                $VU_alert_enabled = 'OFF';
            }
            $AgentAlert_allowed = $VU_allow_alerts;
            
            ### Gather timeclock and shift enforcement restriction settings
            $stmt = "SELECT forced_timeclock_login,shift_enforcement,group_shifts,agent_status_viewable_groups,agent_status_view_time from vicidial_user_groups where user_group='$VU_user_group';";
            $rslt = mysql_query($stmt, $link);
            if ($mel > 0) {
                mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01052', $VD_login, $server_ip, $session_name, $one_mysql_log);
            }
            $row                             = mysql_fetch_row($rslt);
            $forced_timeclock_login          = $row[0];
            $shift_enforcement               = $row[1];
            $LOGgroup_shiftsSQL              = eregi_replace('  ', '', $row[2]);
            $LOGgroup_shiftsSQL              = eregi_replace(' ', "','", $LOGgroup_shiftsSQL);
            $LOGgroup_shiftsSQL              = "shift_id IN('$LOGgroup_shiftsSQL')";
            $agent_status_viewable_groups    = $row[3];
            $agent_status_viewable_groupsSQL = eregi_replace('  ', '', $agent_status_viewable_groups);
            $agent_status_viewable_groupsSQL = eregi_replace(' ', "','", $agent_status_viewable_groupsSQL);
            $agent_status_viewable_groupsSQL = "user_group IN('$agent_status_viewable_groupsSQL')";
            $agent_status_view               = 0;
            if (strlen($agent_status_viewable_groups) > 2) {
                $agent_status_view = 1;
            }
            $agent_status_view_time = 0;
            if ($row[4] == 'Y') {
                $agent_status_view_time = 1;
            }
            
            ### BEGIN - CHECK TO SEE IF AGENT IS LOGGED IN TO TIMECLOCK, IF NOT, OUTPUT ERROR
            if ((ereg('Y', $forced_timeclock_login)) or ((ereg('ADMIN_EXEMPT', $forced_timeclock_login)) and ($VU_user_level < 8))) {
                $last_agent_event = '';
                $HHMM             = date("Hi");
                $HHteod           = substr($timeclock_end_of_day, 0, 2);
                $MMteod           = substr($timeclock_end_of_day, 2, 2);
                
                if ($HHMM < $timeclock_end_of_day) {
                    $EoD = mktime($HHteod, $MMteod, 10, date("m"), date("d") - 1, date("Y"));
                } else {
                    $EoD = mktime($HHteod, $MMteod, 10, date("m"), date("d"), date("Y"));
                }
                
                $EoDdate = date("Y-m-d H:i:s", $EoD);
                
                ##### grab timeclock logged-in time for each user #####
                $stmt = "SELECT event from vicidial_timeclock_log where user='$VD_login' and event_epoch >= '$EoD' order by timeclock_id desc limit 1;";
                $rslt = mysql_query($stmt, $link);
                if ($mel > 0) {
                    mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01053', $VD_login, $server_ip, $session_name, $one_mysql_log);
                }
                $events_to_parse = mysql_num_rows($rslt);
                if ($events_to_parse > 0) {
                    $rowx             = mysql_fetch_row($rslt);
                    $last_agent_event = $rowx[0];
                }
                if ($DB > 0) {
                    echo "|$stmt|$events_to_parse|$last_agent_event|";
                }
                if ((strlen($last_agent_event) < 2) or (ereg('LOGOUT', $last_agent_event))) {
                    $VDloginDISPLAY   = 1;
                    $VDdisplayMESSAGE = "您必须先登陆时间锁<BR>";
                }
            }
            ### END - CHECK TO SEE IF AGENT IS LOGGED IN TO TIMECLOCK, IF NOT, OUTPUT ERROR
            
            ### BEGIN - CHECK TO SEE IF SHIFT ENFORCEMENT IS ENABLED AND AGENT IS OUTSIDE OF THEIR SHIFTS, IF SO, OUTPUT ERROR
            if (((ereg("START|ALL", $shift_enforcement)) and (!ereg("OFF", $VU_agent_shift_enforcement_override))) or (ereg("START|ALL", $VU_agent_shift_enforcement_override))) {
                $shift_ok = 0;
                if ((strlen($LOGgroup_shiftsSQL) < 3) and ($VU_shift_override_flag < 1)) {
                    $VDloginDISPLAY   = 1;
                    $VDdisplayMESSAGE = "错误: 您的用户组没有激活的班次<BR>";
                } else {
                    $HHMM = date("Hi");
                    $wday = date("w");
                    
                    $stmt = "SELECT shift_id,shift_start_time,shift_length,shift_weekdays from vicidial_shifts where $LOGgroup_shiftsSQL order by shift_id";
                    $rslt = mysql_query($stmt, $link);
                    if ($mel > 0) {
                        mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01056', $VD_login, $server_ip, $session_name, $one_mysql_log);
                    }
                    $shifts_to_print = mysql_num_rows($rslt);
                    
                    $o = 0;
                    while (($shifts_to_print > $o) and ($shift_ok < 1)) {
                        $rowx             = mysql_fetch_row($rslt);
                        $shift_id         = $rowx[0];
                        $shift_start_time = $rowx[1];
                        $shift_length     = $rowx[2];
                        $shift_weekdays   = $rowx[3];
                        
                        if (eregi("$wday", $shift_weekdays)) {
                            $HHshift_length     = substr($shift_length, 0, 2);
                            $MMshift_length     = substr($shift_length, 3, 2);
                            $HHshift_start_time = substr($shift_start_time, 0, 2);
                            $MMshift_start_time = substr($shift_start_time, 2, 2);
                            $HHshift_end_time   = ($HHshift_length + $HHshift_start_time);
                            $MMshift_end_time   = ($MMshift_length + $MMshift_start_time);
                            if ($MMshift_end_time > 59) {
                                $MMshift_end_time = ($MMshift_end_time - 60);
                                $HHshift_end_time++;
                            }
                            if ($HHshift_end_time > 23) {
                                $HHshift_end_time = ($HHshift_end_time - 24);
                            }
                            $HHshift_end_time = sprintf("%02s", $HHshift_end_time);
                            $MMshift_end_time = sprintf("%02s", $MMshift_end_time);
                            $shift_end_time   = "$HHshift_end_time$MMshift_end_time";
                            
                            if ((($HHMM >= $shift_start_time) and ($HHMM < $shift_end_time)) or (($HHMM < $shift_start_time) and ($HHMM < $shift_end_time) and ($shift_end_time <= $shift_start_time)) or (($HHMM >= $shift_start_time) and ($HHMM >= $shift_end_time) and ($shift_end_time <= $shift_start_time))) {
                                $shift_ok++;
                            }
                        }
                        $o++;
                    }
                    
                    if (($shift_ok < 1) and ($VU_shift_override_flag < 1)) {
                        $VDloginDISPLAY   = 1;
                        $VDdisplayMESSAGE = "错误：您不允许登录此班次<BR>";
                    }
                }
                if (($shift_ok < 1) and ($VU_shift_override_flag < 1) and ($VDloginDISPLAY > 0)) {
                    $VDdisplayMESSAGE .= "<BR><BR>管理覆盖:<BR>\n";
                    $VDdisplayMESSAGE .= "<FORM ACTION=\"$PHP_SELF\" METHOD=POST>\n";
                    $VDdisplayMESSAGE .= "<INPUT TYPE=HIDDEN NAME=MGR_override VALUE=\"1\">\n";
                    $VDdisplayMESSAGE .= "<INPUT TYPE=HIDDEN NAME=relogin VALUE=\"YES\">\n";
                    $VDdisplayMESSAGE .= "<INPUT TYPE=HIDDEN NAME=DB VALUE=\"$DB\">\n";
                    $VDdisplayMESSAGE .= "<INPUT TYPE=HIDDEN NAME=phone_login VALUE=\"$phone_login\">\n";
                    $VDdisplayMESSAGE .= "<INPUT TYPE=HIDDEN NAME=phone_pass VALUE=\"$phone_pass\">\n";
                    $VDdisplayMESSAGE .= "<INPUT TYPE=HIDDEN NAME=VD_login VALUE=\"$VD_login\">\n";
                    $VDdisplayMESSAGE .= "<INPUT TYPE=HIDDEN NAME=VD_pass VALUE=\"$VD_pass\">\n";
                    $VDdisplayMESSAGE .= "Manager Login: <INPUT TYPE=TEXT NAME=\"MGR_login$loginDATE\" SIZE=10 MAXLENGTH=20><br>\n";
                    $VDdisplayMESSAGE .= "Manager Password: <INPUT TYPE=PASSWORD NAME=\"MGR_pass$loginDATE\" SIZE=10 MAXLENGTH=20><br>\n";
                    $VDdisplayMESSAGE .= "<INPUT TYPE=SUBMIT NAME=SUBMIT VALUE=提交></FORM>\n";
                }
            }
            ### END - CHECK TO SEE IF SHIFT ENFORCEMENT IS ENABLED AND AGENT IS OUTSIDE OF THEIR SHIFTS, IF SO, OUTPUT ERROR
            
            
            
            if ($WeBRooTWritablE > 0&&$fp) {
                fwrite($fp, "vdweb|GOOD|$date|$VD_login|$VD_pass|$ip|$browser|$LOGfullname|\n");
                fclose($fp);
            }
            $user_abb = "$VD_login$VD_login$VD_login$VD_login";
            while ((strlen($user_abb) > 4) and ($forever_stop < 200)) {
                $user_abb = eregi_replace("^.", "", $user_abb);
                $forever_stop++;
            }
            
            $stmt = "SELECT allowed_campaigns from vicidial_user_groups where user_group='$VU_user_group';";
            $rslt = mysql_query($stmt, $link);
            if ($mel > 0) {
                mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01008', $VD_login, $server_ip, $session_name, $one_mysql_log);
            }
            $row                  = mysql_fetch_row($rslt);
            $LOGallowed_campaigns = $row[0];
            
            if ((!eregi(" $VD_campaign ", $LOGallowed_campaigns)) and (!eregi("ALL-CAMPAIGNS", $LOGallowed_campaigns))) {
                echo "</head>\n";
                echo "<body marginheight=\"0\" marginwidth=\"0\" >\n";
                //echo "<div class=\"time_lock\" ><a href=\"./timeclock.php?referrer=agent&pl=$phone_login&pp=$phone_pass&VD_login=$VD_login&VD_pass=$VD_pass\">时间锁</a></div>\n";
                echo "<div class=\"login_form\">\n";
                echo "   <form id=\"vicidial_form\" name=\"vicidial_form\" method=\"post\" action=\"$PHP_SELF\" onSubmit=\"return fLoginFormSubmit();\" >\n";
                $VDdisplayMESSAGE = "对不起，您不允许登录该活动: $VD_campaign";
                if ($VDdisplayMESSAGE) {
                    echo "<div class=\"load_layer\">$VDdisplayMESSAGE</div>\n";
                }
                echo "        <input type=\"hidden\" name=\"DB\" value=\"$DB\">\n";
                
                echo "        <div class=\"login_1\"><img src=\"/img/login_bg_1.jpg\" width=\"631\" height=\"60\" /></div>\n";
                echo "        <div class=\"login_2\">\n";
                echo "        <div class=\"login_user\"><input name=\"phone_login\" id=\"phone_login\" title=\"请输入分机号\" maxlength=\"20\" value=\"$phone_login\" /></div>\n";
                echo "       <div class=\"login_user\"><input name=\"phone_pass\" id=\"phone_pass\" title=\"请输入分机密码\" maxlength=\"20\" type=\"password\" value=\"$phone_pass\" /></div>\n";
                echo "       <div class=\"login_user\"><input name=\"VD_login\" id=\"VD_login\" title=\"请输入工号\" maxlength=\"20\" value=\"$VD_login\" /></div>\n";
                echo "        <div class=\"login_user\"><input name=\"VD_pass\" id=\"VD_pass\" title=\"请输入工号密码\" maxlength=\"20\" type=\"password\" value=\"$VD_pass\" /></div>\n";
                echo "        <div class=\"login_user\">\n";
                echo "            <span id=\"LogiNCamPaigns\">\n";
                echo "                <select name=\"VD_campaign\" id=\"VD_campaign\" onFocus=\"login_allowable_campaigns()\" class=\"lead\" title=\"请选择您要进入的业务活动\">\n";
                echo "                 <option value=\"\"></option>\n";
                echo "                </select>\n";
                echo "            </span>\n";
                echo "        </div>\n";
                echo "     </div>\n";
                echo "        <div class=\"login_3\">\n";
                echo "       	  <div class=\"login_sub\">\n";
                echo "       	     <input name=\"imageField\" type=\"image\" id=\"imageField\" src=\"/img/login_sumit.jpg\" alt=\"点击登陆\" />\n";
                echo "        	</div>\n";
                echo "            <div class=\"login_sub\">\n";
                echo "            	<span id=\"LogiNReseT\">\n";
                echo "             		<input name=\"relist\" type=\"image\" id=\"relist\" src=\"/img/login_list.jpg\" alt=\"刷新获取业务活动列表\" onClick=\"javascript:login_allowable_campaigns();return false\"/>\n";
                echo "              	</span>\n";
                echo "            </div>\n";
                echo "        </div>\n";
                echo "    </form>\n";
                echo "    <div class=\"login_foot\">$system_company</div>\n";
                echo "</div>\n";
                echo "</body>\n";
                echo "</html>\n";
                exit;
                
            }
            
            ##### check to see that the campaign is active
            $stmt = "SELECT count(*) FROM vicidial_campaigns where campaign_id='$VD_campaign' and active='Y';";
            if ($DB) {
                echo "|$stmt|\n";
            }
            $rslt = mysql_query($stmt, $link);
            if ($mel > 0) {
                mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01009', $VD_login, $server_ip, $session_name, $one_mysql_log);
            }
            $row        = mysql_fetch_row($rslt);
            $CAMPactive = $row[0];
            if ($CAMPactive > 0) {
                if ($TEST_all_statuses > 0) {
                    $selectableSQL = '';
                } else {
                    $selectableSQL = "selectable='Y' and";
                }
                $VARstatuses    = '';
                $VARstatusnames = '';
                ##### grab the statuses that can be used for dispositioning by an agent
                $stmt           = "SELECT status,status_name FROM vicidial_statuses WHERE $selectableSQL status != 'NEW' order by status ;";
                $rslt           = mysql_query($stmt, $link);
                if ($mel > 0) {
                    mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01010', $VD_login, $server_ip, $session_name, $one_mysql_log);
                }
                if ($DB) {
                    echo "$stmt\n";
                }
                $VD_statuses_ct = mysql_num_rows($rslt);
                $i              = 0;
                while ($i < $VD_statuses_ct) {
                    $row              = mysql_fetch_row($rslt);
                    $statuses[$i]     = $row[0];
                    $status_names[$i] = $row[1];
                    $VARstatuses      = "$VARstatuses'$statuses[$i]',";
                    $VARstatusnames   = "$VARstatusnames'$status_names[$i]',";
                    $i++;
                }
                
                ##### grab the campaign-specific statuses that can be used for dispositioning by an agent
                $stmt = "SELECT status,status_name FROM vicidial_campaign_statuses WHERE $selectableSQL status != 'NEW' and campaign_id='$VD_campaign' order by status limit 80;";
                $rslt = mysql_query($stmt, $link);
                if ($mel > 0) {
                    mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01011', $VD_login, $server_ip, $session_name, $one_mysql_log);
                }
                if ($DB) {
                    echo "$stmt\n";
                }
                $VD_statuses_camp = mysql_num_rows($rslt);
                $j                = 0;
                while ($j < $VD_statuses_camp) {
                    $row              = mysql_fetch_row($rslt);
                    $statuses[$i]     = $row[0];
                    $status_names[$i] = $row[1];
                    $VARstatuses      = "$VARstatuses'$statuses[$i]',";
                    $VARstatusnames   = "$VARstatusnames'$status_names[$i]',";
                    $i++;
                    $j++;
                }
                $VD_statuses_ct = ($VD_statuses_ct + $VD_statuses_camp);
                $VARstatuses    = substr("$VARstatuses", 0, -1);
                $VARstatusnames = substr("$VARstatusnames", 0, -1);
                
                ##### grab the campaign-specific HotKey statuses that can be used for dispositioning by an agent
                $stmt = "SELECT hotkey,status,status_name FROM vicidial_campaign_hotkeys WHERE selectable='Y' and status != 'NEW' and campaign_id='$VD_campaign' order by hotkey limit 9;";
                $rslt = mysql_query($stmt, $link);
                if ($mel > 0) {
                    mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01012', $VD_login, $server_ip, $session_name, $one_mysql_log);
                }
                if ($DB) {
                    echo "$stmt\n";
                }
                $HK_statuses_camp = mysql_num_rows($rslt);
                $w                = 0;
                $HKboxA           = '';
                $HKboxB           = '';
                $HKboxC           = '';
                while ($w < $HK_statuses_camp) {
                    $row               = mysql_fetch_row($rslt);
                    $HKhotkey[$w]      = $row[0];
                    $HKstatus[$w]      = $row[1];
                    $HKstatus_name[$w] = $row[2];
                    $HKhotkeys         = "$HKhotkeys'$HKhotkey[$w]',";
                    $HKstatuses        = "$HKstatuses'$HKstatus[$w]',";
                    $HKstatusnames     = "$HKstatusnames'$HKstatus_name[$w]',";
                    if ($w < 3) {
                        $HKboxA = "$HKboxA <font class=\"skb_text\">$HKhotkey[$w]</font> - $HKstatus[$w] - $HKstatus_name[$w]<BR>";
                    }
                    if (($w >= 3) and ($w < 6)) {
                        $HKboxB = "$HKboxB <font class=\"skb_text\">$HKhotkey[$w]</font> - $HKstatus[$w] - $HKstatus_name[$w]<BR>";
                    }
                    if ($w >= 6) {
                        $HKboxC = "$HKboxC <font class=\"skb_text\">$HKhotkey[$w]</font> - $HKstatus[$w] - $HKstatus_name[$w]<BR>";
                    }
                    $w++;
                }
                $HKhotkeys     = substr("$HKhotkeys", 0, -1);
                $HKstatuses    = substr("$HKstatuses", 0, -1);
                $HKstatusnames = substr("$HKstatusnames", 0, -1);
                
                ##### grab the campaign settings
                $stmt = "SELECT park_ext,park_file_name,web_form_address,allow_closers,auto_dial_level,dial_timeout,dial_prefix,campaign_cid,campaign_vdad_exten,campaign_rec_exten,campaign_recording,campaign_rec_filename,campaign_script,get_call_launch,am_message_exten,xferconf_a_dtmf,xferconf_a_number,xferconf_b_dtmf,xferconf_b_number,alt_number_dialing,scheduled_callbacks,wrapup_seconds,wrapup_message,closer_campaigns,use_internal_dnc,allcalls_delay,omit_phone_code,agent_pause_codes_active,no_hopper_leads_logins,campaign_allow_inbound,manual_dial_list_id,default_xfer_group,xfer_groups,disable_alter_custphone,display_queue_count,manual_dial_filter,agent_clipboard_copy,use_campaign_dnc,three_way_call_cid,dial_method,three_way_dial_prefix,web_form_target,vtiger_screen_login,agent_allow_group_alias,default_group_alias,quick_transfer_button,prepopulate_transfer_preset,view_calls_in_queue,view_calls_in_queue_launch,call_requeue_button,pause_after_each_call,no_hopper_dialing,agent_dial_owner_only,agent_display_dialable_leads,web_form_address_two,agent_select_territories,crm_popup_login,crm_login_address,timer_action,timer_action_message,timer_action_seconds,start_call_url,dispo_call_url,xferconf_c_number,xferconf_d_number,xferconf_e_number,campaign_name,hangup_stop_rec,display_dtmf_alter FROM vicidial_campaigns where campaign_id = '$VD_campaign';";
                $rslt = mysql_query($stmt, $link);
                if ($mel > 0) {
                    mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01013', $VD_login, $server_ip, $session_name, $one_mysql_log);
                }
                if ($DB) {
                    echo "$stmt\n";
                }
                $row                          = mysql_fetch_row($rslt);
                $park_ext                     = $row[0];
                $park_file_name               = $row[1];
                $web_form_address             = stripslashes($row[2]);
                $allow_closers                = $row[3];
                $auto_dial_level              = $row[4];
                $dial_timeout                 = $row[5];
                $dial_prefix                  = $row[6];
                $campaign_cid                 = $row[7];
                $campaign_vdad_exten          = $row[8];
                $campaign_rec_exten           = $row[9];
                $campaign_recording           = $row[10];
                $campaign_rec_filename        = $row[11];
                $campaign_script              = $row[12];
                $get_call_launch              = $row[13];
                $campaign_am_message_exten    = '8320';
                $xferconf_a_dtmf              = $row[15];
                $xferconf_a_number            = $row[16];
                $xferconf_b_dtmf              = $row[17];
                $xferconf_b_number            = $row[18];
                $alt_number_dialing           = $row[19];
                $VC_scheduled_callbacks       = $row[20];
                $wrapup_seconds               = $row[21];
                $wrapup_message               = $row[22];
                $closer_campaigns             = $row[23];
                $use_internal_dnc             = $row[24];
                $allcalls_delay               = $row[25];
                $omit_phone_code              = $row[26];
                $agent_pause_codes_active     = $row[27];
                $no_hopper_leads_logins       = $row[28];
                $campaign_allow_inbound       = $row[29];
                $manual_dial_list_id          = $row[30];
                $default_xfer_group           = $row[31];
                $xfer_groups                  = $row[32];
                $disable_alter_custphone      = $row[33];
                $display_queue_count          = $row[34];
                $manual_dial_filter           = $row[35];
                $CopY_tO_ClipboarD            = $row[36];
                $use_campaign_dnc             = $row[37];
                $three_way_call_cid           = $row[38];
                $dial_method                  = $row[39];
                $three_way_dial_prefix        = $row[40];
                $web_form_target              = $row[41];
                $vtiger_screen_login          = $row[42];
                $agent_allow_group_alias      = $row[43];
                $default_group_alias          = $row[44];
                $quick_transfer_button        = $row[45];
                $prepopulate_transfer_preset  = $row[46];
                $view_calls_in_queue          = $row[47];
                $view_calls_in_queue_launch   = $row[48];
                $call_requeue_button          = $row[49];
                $pause_after_each_call        = $row[50];
                $no_hopper_dialing            = $row[51];
                $agent_dial_owner_only        = $row[52];
                $agent_display_dialable_leads = $row[53];
                $web_form_address_two         = $row[54];
                $agent_select_territories     = $row[55];
                $crm_popup_login              = $row[56];
                $crm_login_address            = $row[57];
                $timer_action                 = $row[58];
                $timer_action_message         = $row[59];
                $timer_action_seconds         = $row[60];
                $start_call_url               = $row[61];
                $dispo_call_url               = $row[62];
                $xferconf_c_number            = $row[63];
                $xferconf_d_number            = $row[64];
                $xferconf_e_number            = $row[65];
                $campaign_name                = $row[66];
				$hangup_stop_rec              = $row[67];
                $display_dtmf_alter           = $row[68];
				
				if($manual_dial_list_id=="998"){
					 
					$stmt = "select list_id from vicidial_lists where campaign_id = '$VD_campaign'  order by list_lastcalldate desc  limit 1;";
					
					$rslt = mysql_query($stmt, $link);
 					$row = mysql_fetch_row($rslt);
					$manual_dial_list_id2= $row[0];
					if($manual_dial_list_id2!=""){
						$manual_dial_list_id=$manual_dial_list_id2;	
					}
					mysql_free_result($rslt);
 				}
				
				
                if ($user_territories_active < 1) {
                    $agent_select_territories = 0;
                }
                if (preg_match("/Y/", $agent_select_territories)) {
                    $agent_select_territories = 1;
                } else {
                    $agent_select_territories = 0;
                }
                
                if (preg_match("/Y/", $agent_display_dialable_leads)) {
                    $agent_display_dialable_leads = 1;
                } else {
                    $agent_display_dialable_leads = 0;
                }
                
                if (preg_match("/Y/", $no_hopper_dialing)) {
                    $no_hopper_dialing = 1;
                } else {
                    $no_hopper_dialing = 0;
                }
                
                if ((preg_match("/Y/", $call_requeue_button)) and ($auto_dial_level > 0)) {
                    $call_requeue_button = 1;
                } else {
                    $call_requeue_button = 0;
                }
                
                if ((preg_match("/AUTO/", $view_calls_in_queue_launch)) and ($auto_dial_level > 0)) {
                    $view_calls_in_queue_launch = 1;
                } else {
                    $view_calls_in_queue_launch = 0;
                }
                
                if ((!preg_match("/NONE/", $view_calls_in_queue)) and ($auto_dial_level > 0)) {
                    $view_calls_in_queue = 1;
                } else {
                    $view_calls_in_queue = 0;
                }
                
                if (preg_match("/Y/", $pause_after_each_call)) {
                    $dispo_check_all_pause = 1;
                }
                
                $quick_transfer_button_enabled = 0;
                if (preg_match("/IN_GROUP|PRESET_1|PRESET_2|PRESET_3|PRESET_4|PRESET_5/", $quick_transfer_button)) {
                    $quick_transfer_button_enabled = 1;
                }
                
                $preset_populate                     = '';
                $prepopulate_transfer_preset_enabled = 0;
                if (preg_match("/PRESET_1|PRESET_2|PRESET_3|PRESET_4|PRESET_5/", $prepopulate_transfer_preset)) {
                    $prepopulate_transfer_preset_enabled = 1;
                    if (preg_match("/PRESET_1/", $prepopulate_transfer_preset)) {
                        $preset_populate = $xferconf_a_number;
                    }
                    if (preg_match("/PRESET_2/", $prepopulate_transfer_preset)) {
                        $preset_populate = $xferconf_b_number;
                    }
                    if (preg_match("/PRESET_3/", $prepopulate_transfer_preset)) {
                        $preset_populate = $xferconf_c_number;
                    }
                    if (preg_match("/PRESET_4/", $prepopulate_transfer_preset)) {
                        $preset_populate = $xferconf_d_number;
                    }
                    if (preg_match("/PRESET_5/", $prepopulate_transfer_preset)) {
                        $preset_populate = $xferconf_e_number;
                    }
                }
                
                $default_group_alias_cid = '';
                if (strlen($default_group_alias) > 1) {
                    $stmt = "select caller_id_number from groups_alias where group_alias_id='$default_group_alias';";
                    if ($DB) {
                        echo "$stmt\n";
                    }
                    $rslt = mysql_query($stmt, $link);
                    if ($mel > 0) {
                        mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01055', $VD_login, $server_ip, $session_name, $one_mysql_log);
                    }
                    $VDIG_cidnum_ct = mysql_num_rows($rslt);
                    if ($VDIG_cidnum_ct > 0) {
                        $row                     = mysql_fetch_row($rslt);
                        $default_group_alias_cid = $row[0];
                    }
                }
                
                $stmt = "select group_web_vars from vicidial_campaign_agents where campaign_id='$VD_campaign' and user='$VD_login';";
                if ($DB) {
                    echo "$stmt\n";
                }
                $rslt = mysql_query($stmt, $link);
                if ($mel > 0) {
                    mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01056', $VD_login, $server_ip, $session_name, $one_mysql_log);
                }
                $VDIG_cidogwv = mysql_num_rows($rslt);
                if ($VDIG_cidogwv > 0) {
                    $row              = mysql_fetch_row($rslt);
                    $default_web_vars = $row[0];
                }
                
                if ((!ereg('DISABLED', $VU_vicidial_recording_override)) and ($VU_vicidial_recording > 0)) {
                    $campaign_recording = $VU_vicidial_recording_override;
                    echo "<!-- USER RECORDING OVERRIDE: |$VU_vicidial_recording_override|$campaign_recording| -->\n";
                }
                if (($VC_scheduled_callbacks == 'Y') and ($VU_scheduled_callbacks == '1')) {
                    $scheduled_callbacks = '1';
                }
                if ($VU_vicidial_recording == '0') {
                    $campaign_recording = 'NEVER';
                }
                if ($VU_alter_custphone_override == 'ALLOW_ALTER') {
                    $disable_alter_custphone = 'N';
                }
                if (strlen($three_way_dial_prefix) < 1) {
                    $three_way_dial_prefix = $dial_prefix;
                }
                if ($alt_number_dialing == 'Y') {
                    $alt_phone_dialing = '1';
                } else {
                    $alt_phone_dialing = '0';
                    $DefaulTAlTDiaL    = '0';
                }
                if ($display_queue_count == 'N') {
                    $callholdstatus = '0';
                }
                if (($dial_method == 'INBOUND_MAN') or ($outbound_autodial_active < 1)) {
                    $VU_closer_default_blended = 0;
                }
                
                $closer_campaigns = preg_replace("/^ | -$/", "", $closer_campaigns);
                $closer_campaigns = preg_replace("/ /", "','", $closer_campaigns);
                $closer_campaigns = "'$closer_campaigns'";
                
                if ((ereg('Y', $agent_pause_codes_active)) or (ereg('FORCE', $agent_pause_codes_active))) {
                    ##### grab the pause codes for this campaign$VD_campaign
                    $stmt = "SELECT pause_code,pause_code_name FROM vicidial_pause_codes WHERE campaign_id='system' order by pause_code limit 50;";
                    $rslt = mysql_query($stmt, $link);
                    if ($mel > 0) {
                        mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01014', $VD_login, $server_ip, $session_name, $one_mysql_log);
                    }
                    if ($DB) {
                        echo "$stmt\n";
                    }
                    $VD_pause_codes = mysql_num_rows($rslt);
                    $j              = 0;
                    while ($j < $VD_pause_codes) {
                        $row                  = mysql_fetch_row($rslt);
                        $pause_codes[$i]      = $row[0];
                        $pause_code_names[$i] = $row[1];
                        $VARpause_codes       = "$VARpause_codes'$pause_codes[$i]',";
                        $VARpause_code_names  = "$VARpause_code_names'$pause_code_names[$i]',";
                        $i++;
                        $j++;
                    }
                    $VD_pause_codes_ct   = ($VD_pause_codes_ct + $VD_pause_codes);
                    $VARpause_codes      = substr("$VARpause_codes", 0, -1);
                    $VARpause_code_names = substr("$VARpause_code_names", 0, -1);
                }
                
                ##### grab the inbound groups to choose from if campaign contains CLOSER
                $VARingroups = "''";
                if (($campaign_allow_inbound == 'Y') and ($dial_method != 'MANUAL')) {
                    $VARingroups = '';
                    $stmt        = "select group_id from vicidial_inbound_groups where active = 'Y' and group_id IN($closer_campaigns) order by group_id limit 600;";
                    $rslt        = mysql_query($stmt, $link);
                    if ($mel > 0) {
                        mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01015', $VD_login, $server_ip, $session_name, $one_mysql_log);
                    }
                    if ($DB) {
                        echo "$stmt\n";
                    }
                    $closer_ct = mysql_num_rows($rslt);
                    $INgrpCT   = 0;
                    while ($INgrpCT < $closer_ct) {
                        $row                     = mysql_fetch_row($rslt);
                        $closer_groups[$INgrpCT] = $row[0];
                        $VARingroups             = "$VARingroups'$closer_groups[$INgrpCT]',";
                        $INgrpCT++;
                    }
                    $VARingroups = substr("$VARingroups", 0, -1);
                } else {
                    $closer_campaigns = "''";
                }
                
                ##### gather territory listings for this agent if select territories is enabled
                $VARterritories = '';
                if ($agent_select_territories > 0) {
                    $stmt = "SELECT territory from vicidial_user_territories where user='$VD_login';";
                    $rslt = mysql_query($stmt, $link);
                    if ($mel > 0) {
                        mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01062', $VD_login, $server_ip, $session_name, $one_mysql_log);
                    }
                    if ($DB) {
                        echo "$stmt\n";
                    }
                    $territory_ct = mysql_num_rows($rslt);
                    $territoryCT  = 0;
                    while ($territoryCT < $territory_ct) {
                        $row                       = mysql_fetch_row($rslt);
                        $territories[$territoryCT] = $row[0];
                        $VARterritories            = "$VARterritories'$territories[$territoryCT]',";
                        $territoryCT++;
                    }
                    $VARterritories = substr("$VARterritories", 0, -1);
                    echo "<!-- $territory_ct  $territoryCT |$stmt| -->\n";
                }
                
                ##### grab the allowable inbound groups to choose from for transfer options
                $xfer_groups   = preg_replace("/^ | -$/", "", $xfer_groups);
                $xfer_groups   = preg_replace("/ /", "','", $xfer_groups);
                $xfer_groups   = "'$xfer_groups'";
                $VARxfergroups = "''";
                if ($allow_closers == 'Y') {
                    $VARxfergroups = '';
                    $stmt          = "select group_id,group_name from vicidial_inbound_groups where active = 'Y' and group_id IN($xfer_groups) order by group_id limit 600;";
                    $rslt          = mysql_query($stmt, $link);
                    if ($mel > 0) {
                        mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01016', $VD_login, $server_ip, $session_name, $one_mysql_log);
                    }
                    if ($DB) {
                        echo "$stmt\n";
                    }
                    $xfer_ct = mysql_num_rows($rslt);
                    $XFgrpCT = 0;
                    while ($XFgrpCT < $xfer_ct) {
                        $row                = mysql_fetch_row($rslt);
                        $VARxfergroups      = "$VARxfergroups'$row[0]',";
                        $VARxfergroupsnames = "$VARxfergroupsnames'$row[1]',";
                        if ($row[0] == "$default_xfer_group") {
                            $default_xfer_group_name = $row[1];
                        }
                        $XFgrpCT++;
                    }
                    $VARxfergroups      = substr("$VARxfergroups", 0, -1);
                    $VARxfergroupsnames = substr("$VARxfergroupsnames", 0, -1);
                }
                
                if (ereg('Y', $agent_allow_group_alias)) {
                    ##### grab the active group aliases
                    $stmt = "SELECT group_alias_id,group_alias_name,caller_id_number FROM groups_alias WHERE active='Y' order by group_alias_id limit 1000;";
                    $rslt = mysql_query($stmt, $link);
                    if ($mel > 0) {
                        mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01054', $VD_login, $server_ip, $session_name, $one_mysql_log);
                    }
                    if ($DB) {
                        echo "$stmt\n";
                    }
                    $VD_group_aliases = mysql_num_rows($rslt);
                    $j                = 0;
                    while ($j < $VD_group_aliases) {
                        $row                  = mysql_fetch_row($rslt);
                        $group_alias_id[$i]   = $row[0];
                        $group_alias_name[$i] = $row[1];
                        $caller_id_number[$i] = $row[2];
                        $VARgroup_alias_ids   = "$VARgroup_alias_ids'$group_alias_id[$i]',";
                        $VARgroup_alias_names = "$VARgroup_alias_names'$group_alias_name[$i]',";
                        $VARcaller_id_numbers = "$VARcaller_id_numbers'$caller_id_number[$i]',";
                        $i++;
                        $j++;
                    }
                    $VD_group_aliases_ct  = ($VD_group_aliases_ct + $VD_group_aliases);
                    $VARgroup_alias_ids   = substr("$VARgroup_alias_ids", 0, -1);
                    $VARgroup_alias_names = substr("$VARgroup_alias_names", 0, -1);
                    $VARcaller_id_numbers = substr("$VARcaller_id_numbers", 0, -1);
                }
                
                ##### grab the number of leads in the hopper for this campaign
                $stmt = "SELECT count(*) FROM vicidial_hopper where campaign_id = '$VD_campaign' and status='READY';";
                $rslt = mysql_query($stmt, $link);
                if ($mel > 0) {
                    mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01017', $VD_login, $server_ip, $session_name, $one_mysql_log);
                }
                if ($DB) {
                    echo "$stmt\n";
                }
                $row                    = mysql_fetch_row($rslt);
                $campaign_leads_to_call = $row[0];
                echo "<!-- $campaign_leads_to_call - leads left to call in hopper -->\n";
                
            } else {
                $VDloginDISPLAY   = 1;
                $VDdisplayMESSAGE = "活动未激活，请重试<BR>";
            }
        } else {
            if ($WeBRooTWritablE > 0&&$fp) {
                fwrite($fp, "vdweb|FAIL|$date|$VD_login|$VD_pass|$ip|$browser|\n");
                fclose($fp);
            }
            $VDloginDISPLAY   = 1;
            $VDdisplayMESSAGE = "登录错误，请重试";
        }
    }
    if ($VDloginDISPLAY) {
        echo "</head>\n";
        echo "<body marginheight=\"0\" marginwidth=\"0\" >\n";
        //echo "<div class=\"time_lock\" ><a href=\"./timeclock.php?referrer=agent&pl=$phone_login&pp=$phone_pass&VD_login=$VD_login&VD_pass=$VD_pass\">时间锁</a></div>\n";
        echo "<div class=\"login_form\">\n";
        echo "   <form id=\"vicidial_form\" name=\"vicidial_form\" method=\"post\" action=\"?\" onSubmit=\"return fLoginFormSubmit();\" >\n";
        if ($VDdisplayMESSAGE) {
            echo "<div class=\"load_layer\">$VDdisplayMESSAGE</div>\n";
        }
        echo "        <input type=\"hidden\" name=\"DB\" value=\"$DB\">\n";
        
        echo "        <div class=\"login_1\"><img src=\"/img/login_bg_1.jpg\" width=\"631\" height=\"60\" /></div>\n";
        echo "        <div class=\"login_2\">\n";
        echo "        <div class=\"login_user\"><input name=\"phone_login\" id=\"phone_login\" title=\"请输入分机号\" maxlength=\"20\" value=\"$phone_login\" /></div>\n";
        echo "       <div class=\"login_user\"><input name=\"phone_pass\" id=\"phone_pass\" title=\"请输入分机密码\" maxlength=\"20\" type=\"password\" value=\"$phone_pass\" /></div>\n";
        echo "       <div class=\"login_user\"><input name=\"VD_login\" id=\"VD_login\" title=\"请输入工号\" maxlength=\"20\" value=\"$VD_login\" /></div>\n";
        echo "        <div class=\"login_user\"><input name=\"VD_pass\" id=\"VD_pass\" title=\"请输入工号密码\" maxlength=\"20\" type=\"password\" value=\"$VD_pass\" /></div>\n";
        echo "        <div class=\"login_user\">\n";
        echo "            <span id=\"LogiNCamPaigns\">\n";
        echo "                <select name=\"VD_campaign\" id=\"VD_campaign\" onFocus=\"login_allowable_campaigns()\" class=\"lead\" title=\"请选择您要进入的业务活动\">\n";
        echo "                 <option value=\"\"></option>\n";
        echo "                </select>\n";
        echo "            </span>\n";
        echo "        </div>\n";
        echo "     </div>\n";
        echo "        <div class=\"login_3\">\n";
        echo "       	  <div class=\"login_sub\">\n";
        echo "       	     <input name=\"imageField\" type=\"image\" id=\"imageField\" src=\"/img/login_sumit.jpg\" alt=\"点击登陆\" />\n";
        echo "        	</div>\n";
        echo "            <div class=\"login_sub\">\n";
        echo "            	<span id=\"LogiNReseT\">\n";
        echo "             		<input name=\"relist\" type=\"image\" id=\"relist\" src=\"/img/login_list.jpg\" alt=\"刷新获取业务活动列表\" onClick=\"javascript:login_allowable_campaigns();return false\"/>\n";
        echo "              	</span>\n";
        echo "            </div>\n";
        echo "        </div>\n";
        echo "    </form>\n";
        echo "    <div class=\"login_foot\">$system_company</div>\n";
        echo "</div>\n";
        echo "</body>\n";
        echo "</html>\n";
        exit;
    }
    
    $original_phone_login = $phone_login;
    
    # code for parsing load-balanced agent phone allocation where agent interface
    # will send multiple phones-table logins so that the script can determine the
    # server that has the fewest agents logged into it.
    #   login: ca101,cb101,cc101
    $alias_found = 0;
    $stmt        = "select count(*) from phones_alias where alias_id = '$phone_login';";
    $rslt        = mysql_query($stmt, $link);
    if ($mel > 0) {
        mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01018', $VD_login, $server_ip, $session_name, $one_mysql_log);
    }
    $alias_ct = mysql_num_rows($rslt);
    if ($alias_ct > 0) {
        $row         = mysql_fetch_row($rslt);
        $alias_found = "$row[0]";
    }
    if ($alias_found > 0) {
        $stmt = "select alias_name,logins_list from phones_alias where alias_id = '$phone_login' limit 1;";
        $rslt = mysql_query($stmt, $link);
        if ($mel > 0) {
            mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01019', $VD_login, $server_ip, $session_name, $one_mysql_log);
        }
        $alias_ct = mysql_num_rows($rslt);
        if ($alias_ct > 0) {
            $row         = mysql_fetch_row($rslt);
            $alias_name  = "$row[0]";
            $phone_login = "$row[1]";
        }
    }
    
    $pa = 0;
    if ((eregi(',', $phone_login)) and (strlen($phone_login) > 2)) {
        $phoneSQL       = "(";
        $phones_auto    = explode(',', $phone_login);
        $phones_auto_ct = count($phones_auto);
        while ($pa < $phones_auto_ct) {
            if ($pa > 0) {
                $phoneSQL .= " or ";
            }
            $desc = ($phones_auto_ct - $pa); # traverse in reverse order
            $phoneSQL .= "(login='$phones_auto[$desc]' and pass='$phone_pass')";
            $pa++;
        }
        $phoneSQL .= ")";
    } else {
        $phoneSQL = "login='$phone_login' and pass='$phone_pass'";
    }
    
    $authphone = 0;
    #$stmt="SELECT count(*) from phones where $phoneSQL and active = 'Y';";
    $stmt      = "SELECT count(*) from phones,servers where $phoneSQL and phones.active = 'Y' and active_agent_login_server='Y' and phones.server_ip=servers.server_ip;";
    
    if ($DB) {
        echo "|$stmt|\n";
    }
    $rslt = mysql_query($stmt, $link);
    if ($mel > 0) {
        mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01020', $VD_login, $server_ip, $session_name, $one_mysql_log);
    }
    $row       = mysql_fetch_row($rslt);
    $authphone = $row[0];
    if (!$authphone) {
        echo "</head>\n";
        echo "<body marginheight=\"0\" marginwidth=\"0\" >\n";
        //echo "<div class=\"time_lock\" ><a href=\"./timeclock.php?referrer=agent&pl=$phone_login&pp=$phone_pass&VD_login=$VD_login&VD_pass=$VD_pass\">时间锁</a></div>\n";
        echo "<div class=\"login_form\">\n";
        echo "   <form id=\"vicidial_form\" name=\"vicidial_form\" method=\"post\" action=\"?\" onSubmit=\"return fLoginFormSubmit();\" >\n";
        $VDdisplayMESSAGE = "对不起，您的分机账号尚未激活";
        if ($VDdisplayMESSAGE) {
            echo "<div class=\"load_layer\">$VDdisplayMESSAGE</div>\n";
        }
        echo "        <input type=\"hidden\" name=\"DB\" value=\"$DB\">\n";
        
        echo "        <div class=\"login_1\"><img src=\"/img/login_bg_1.jpg\" width=\"631\" height=\"60\" /></div>\n";
        echo "        <div class=\"login_2\">\n";
        echo "        <div class=\"login_user\"><input name=\"phone_login\" id=\"phone_login\" title=\"请输入分机号\" maxlength=\"20\" value=\"$phone_login\" /></div>\n";
        echo "       <div class=\"login_user\"><input name=\"phone_pass\" id=\"phone_pass\" title=\"请输入分机密码\" maxlength=\"20\" type=\"password\" value=\"$phone_pass\" /></div>\n";
        echo "       <div class=\"login_user\"><input name=\"VD_login\" id=\"VD_login\" title=\"请输入工号\" maxlength=\"20\" value=\"$VD_login\" /></div>\n";
        echo "        <div class=\"login_user\"><input name=\"VD_pass\" id=\"VD_pass\" title=\"请输入工号密码\" maxlength=\"20\" type=\"password\" value=\"$VD_pass\" /></div>\n";
        echo "        <div class=\"login_user\">\n";
        echo "            <span id=\"LogiNCamPaigns\">\n";
        echo "                <select name=\"VD_campaign\" id=\"VD_campaign\" onFocus=\"login_allowable_campaigns()\" class=\"lead\" title=\"请选择您要进入的业务活动\">\n";
        echo "                 <option value=\"\"></option>\n";
        echo "                </select>\n";
        echo "            </span>\n";
        echo "        </div>\n";
        echo "     </div>\n";
        echo "        <div class=\"login_3\">\n";
        echo "       	  <div class=\"login_sub\">\n";
        echo "       	     <input name=\"imageField\" type=\"image\" id=\"imageField\" src=\"/img/login_sumit.jpg\" alt=\"点击登陆\" />\n";
        echo "        	</div>\n";
        echo "            <div class=\"login_sub\">\n";
        echo "            	<span id=\"LogiNReseT\">\n";
        echo "             		<input name=\"relist\" type=\"image\" id=\"relist\" src=\"/img/login_list.jpg\" alt=\"刷新获取业务活动列表\" onClick=\"javascript:login_allowable_campaigns();return false\"/>\n";
        echo "              	</span>\n";
        echo "            </div>\n";
        echo "        </div>\n";
        echo "    </form>\n";
        echo "    <div class=\"login_foot\">$system_company</div>\n";
        echo "</div>\n";
        echo "</body>\n";
        echo "</html>\n";
        exit;
        
    } else {
        ### go through the entered phones to figure out which server has fewest agents
        ### logged in and use that phone login account
        if ($pa > 0) {
            $pb           = 0;
            $pb_login     = '';
            $pb_server_ip = '';
            $pb_count     = 0;
            $pb_log       = '';
            while ($pb < $phones_auto_ct) {
                ### find the server_ip of each phone_login
                $stmtx = "SELECT server_ip from phones where login = '$phones_auto[$pb]';";
                if ($DB) {
                    echo "|$stmtx|\n";
                }
                if ($non_latin > 0) {
                    $rslt = mysql_query("SET NAMES 'UTF8'");
                }
                $rslt = mysql_query($stmtx, $link);
                if ($mel > 0) {
                    mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01021', $VD_login, $server_ip, $session_name, $one_mysql_log);
                }
                $rowx = mysql_fetch_row($rslt);
                
                ### get number of agents logged in to each server
                $stmt = "SELECT count(*) from vicidial_live_agents where server_ip = '$rowx[0]';";
                if ($DB) {
                    echo "|$stmt|\n";
                }
                $rslt = mysql_query($stmt, $link);
                if ($mel > 0) {
                    mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01022', $VD_login, $server_ip, $session_name, $one_mysql_log);
                }
                $row = mysql_fetch_row($rslt);
                
                ### find out whether the server is set to active
                $stmt = "SELECT count(*) from servers where server_ip = '$rowx[0]' and active='Y' and active_agent_login_server='Y';";
                if ($DB) {
                    echo "|$stmt|\n";
                }
                $rslt = mysql_query($stmt, $link);
                if ($mel > 0) {
                    mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01023', $VD_login, $server_ip, $session_name, $one_mysql_log);
                }
                $rowy = mysql_fetch_row($rslt);
                
                ### find out whether the server_updater is running
                $stmt = "SELECT count(*) from server_updater where server_ip = '$rowx[0]' and last_update > '$past_minutes_date';";
                if ($DB) {
                    echo "|$stmt|\n";
                }
                $rslt = mysql_query($stmt, $link);
                if ($mel > 0) {
                    mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01024', $VD_login, $server_ip, $session_name, $one_mysql_log);
                }
                $rowz = mysql_fetch_row($rslt);
                
                $pb_log .= "$phones_auto[$pb]|$rowx[0]|$row[0]|$rowy[0]|$rowz[0]|  ";
                
                if (($rowy[0] > 0) && ($rowz[0] > 0)) {
                    if (($pb_count >= $row[0]) || (strlen($pb_server_ip) < 4)) {
                        $pb_count     = $row[0];
                        $pb_server_ip = $rowx[0];
                        $phone_login  = $phones_auto[$pb];
                    }
                }
                $pb++;
            }
            echo "<!-- Phones balance selection: $phone_login|$pb_server_ip|$past_minutes_date|     |$pb_log -->\n";
        }
        $stmt = "SELECT extension,dialplan_number,voicemail_id,phone_ip,computer_ip,server_ip,login,pass,status,active,phone_type,fullname,company,picture,messages,old_messages,protocol,local_gmt,ASTmgrUSERNAME,ASTmgrSECRET,login_user,login_pass,login_campaign,park_on_extension,conf_on_extension,VICIDIAL_park_on_extension,VICIDIAL_park_on_filename,monitor_prefix,recording_exten,voicemail_exten,voicemail_dump_exten,ext_context,dtmf_send_extension,call_out_number_group,client_browser,install_directory,local_web_callerID_URL,VICIDIAL_web_URL,AGI_call_logging_enabled,user_switching_enabled,conferencing_enabled,admin_hangup_enabled,admin_hijack_enabled,admin_monitor_enabled,call_parking_enabled,updater_check_enabled,AFLogging_enabled,QUEUE_ACTION_enabled,CallerID_popup_enabled,voicemail_button_enabled,enable_fast_refresh,fast_refresh_rate,enable_persistant_mysql,auto_dial_next_number,VDstop_rec_after_each_call,DBX_server,DBX_database,DBX_user,DBX_pass,DBX_port,DBY_server,DBY_database,DBY_user,DBY_pass,DBY_port,outbound_cid,enable_sipsak_messages,email,template_id,conf_override,phone_context,phone_ring_timeout,conf_secret from phones where login='$phone_login' and pass='$phone_pass' and active = 'Y';";
        if ($DB) {
            echo "|$stmt|\n";
        }
        $rslt = mysql_query($stmt, $link);
        if ($mel > 0) {
            mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01025', $VD_login, $server_ip, $session_name, $one_mysql_log);
        }
        $row                        = mysql_fetch_row($rslt);
        $extension                  = $row[0];
        $dialplan_number            = $row[1];
        $voicemail_id               = $row[2];
        $phone_ip                   = $row[3];
        $computer_ip                = $row[4];
        $server_ip                  = $row[5];
        $login                      = $row[6];
        $pass                       = $row[7];
        $status                     = $row[8];
        $active                     = $row[9];
        $phone_type                 = $row[10];
        $fullname                   = $row[11];
        $company                    = $row[12];
        $picture                    = $row[13];
        $messages                   = $row[14];
        $old_messages               = $row[15];
        $protocol                   = $row[16];
        $local_gmt                  = $row[17];
        $ASTmgrUSERNAME             = $row[18];
        $ASTmgrSECRET               = $row[19];
        $login_user                 = $row[20];
        $login_pass                 = $row[21];
        $login_campaign             = $row[22];
        $park_on_extension          = $row[23];
        $conf_on_extension          = $row[24];
        $VICIDiaL_park_on_extension = $row[25];
        $VICIDiaL_park_on_filename  = $row[26];
        $monitor_prefix             = $row[27];
        $recording_exten            = $row[28];
        $voicemail_exten            = $row[29];
        $voicemail_dump_exten       = $row[30];
        $ext_context                = $row[31];
        $dtmf_send_extension        = $row[32];
        $call_out_number_group      = $row[33];
        $client_browser             = $row[34];
        $install_directory          = $row[35];
        $local_web_callerID_URL     = $row[36];
        $VICIDiaL_web_URL           = $row[37];
        $AGI_call_logging_enabled   = $row[38];
        $user_switching_enabled     = $row[39];
        $conferencing_enabled       = $row[40];
        $admin_hangup_enabled       = $row[41];
        $admin_hijack_enabled       = $row[42];
        $admin_monitor_enabled      = $row[43];
        $call_parking_enabled       = $row[44];
        $updater_check_enabled      = $row[45];
        $AFLogging_enabled          = $row[46];
        $QUEUE_ACTION_enabled       = $row[47];
        $CallerID_popup_enabled     = $row[48];
        $voicemail_button_enabled   = $row[49];
        $enable_fast_refresh        = $row[50];
        $fast_refresh_rate          = $row[51];
        $enable_persistant_mysql    = $row[52];
        $auto_dial_next_number      = $row[53];
        $VDstop_rec_after_each_call = $row[54];
        $DBX_server                 = $row[55];
        $DBX_database               = $row[56];
        $DBX_user                   = $row[57];
        $DBX_pass                   = $row[58];
        $DBX_port                   = $row[59];
        $outbound_cid               = $row[65];
        $enable_sipsak_messages     = $row[66];
        
        $no_empty_session_warnings = 0;
        if ($phone_login == 'nophone') {
            $no_empty_session_warnings = 1;
        }
        if ($PhonESComPIP == '1') {
            if (strlen($computer_ip) < 4) {
                $stmt = "UPDATE phones SET computer_ip='$ip' where login='$phone_login' and pass='$phone_pass' and active = 'Y';";
                if ($DB) {
                    echo "|$stmt|\n";
                }
                $rslt = mysql_query($stmt, $link);
                if ($mel > 0) {
                    mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01026', $VD_login, $server_ip, $session_name, $one_mysql_log);
                }
            }
        }
        if ($PhonESComPIP == '2') {
            $stmt = "UPDATE phones SET computer_ip='$ip' where login='$phone_login' and pass='$phone_pass' and active = 'Y';";
            if ($DB) {
                echo "|$stmt|\n";
            }
            $rslt = mysql_query($stmt, $link);
            if ($mel > 0) {
                mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01027', $VD_login, $server_ip, $session_name, $one_mysql_log);
            }
        }
        if ($clientDST) {
            $local_gmt = ($local_gmt + $isdst);
        }
        if ($protocol == 'EXTERNAL') {
            $protocol  = 'Local';
            $extension = "$dialplan_number$AT$ext_context";
        }
        $SIP_user      = "$protocol/$extension";
        $SIP_user_DiaL = "$protocol/$extension";
        if ((ereg('8300', $dialplan_number)) and (strlen($dialplan_number) < 5) and ($protocol == 'Local')) {
            $SIP_user = "$protocol/$extension$VD_login";
        }
        
        $stmt = "SELECT asterisk_version from servers where server_ip='$server_ip';";
        if ($DB) {
            echo "|$stmt|\n";
        }
        $rslt = mysql_query($stmt, $link);
        if ($mel > 0) {
            mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01028', $VD_login, $server_ip, $session_name, $one_mysql_log);
        }
        $row              = mysql_fetch_row($rslt);
        $asterisk_version = $row[0];
        
        # If a park extension is not set, use the default one
        if ((strlen($park_ext) > 0) && (strlen($park_file_name) > 0)) {
            $VICIDiaL_park_on_extension = "$park_ext";
            $VICIDiaL_park_on_filename  = "$park_file_name";
            echo "<!-- CAMPAIGN CUSTOM PARKING:  |$VICIDiaL_park_on_extension|$VICIDiaL_park_on_filename| -->\n";
        }
        echo "<!-- CAMPAIGN DEFAULT PARKING: |$VICIDiaL_park_on_extension|$VICIDiaL_park_on_filename| -->\n";
        
        # If a web form address is not set, use the default one
        if (strlen($web_form_address) > 0) {
            $VICIDiaL_web_form_address = "$web_form_address";
            echo "<!-- CAMPAIGN CUSTOM WEB FORM:   |$VICIDiaL_web_form_address| -->\n";
        } else {
            $VICIDiaL_web_form_address = "$VICIDiaL_web_URL";
            print "<!-- CAMPAIGN DEFAULT WEB FORM:  |$VICIDiaL_web_form_address| -->\n";
            $VICIDiaL_web_form_address_enc = rawurlencode($VICIDiaL_web_form_address);
        }
        $VICIDiaL_web_form_address_enc = rawurlencode($VICIDiaL_web_form_address);
        
        # If a web form address two is not set, use the first one
        if (strlen($web_form_address_two) > 0) {
            $VICIDiaL_web_form_address_two = "$web_form_address_two";
            echo "<!-- CAMPAIGN CUSTOM WEB FORM 2:   |$VICIDiaL_web_form_address_two| -->\n";
            
        } else {
            $VICIDiaL_web_form_address_two = "about:blank";
            echo "<!-- CAMPAIGN DEFAULT WEB FORM 2:  |$VICIDiaL_web_form_address_two| -->\n";
            $VICIDiaL_web_form_address_two_enc = rawurlencode($VICIDiaL_web_form_address_two);
        }
        
        $VICIDiaL_web_form_address_two_enc = rawurlencode($VICIDiaL_web_form_address_two);
        
        # If closers are allowed on this campaign
        if ($allow_closers == "Y") {
            $VICIDiaL_allow_closers = 1;
            echo "<!-- CAMPAIGN ALLOWS CLOSERS:    |$VICIDiaL_allow_closers| -->\n";
        } else {
            $VICIDiaL_allow_closers = 0;
            echo "<!-- CAMPAIGN ALLOWS NO CLOSERS: |$VICIDiaL_allow_closers| -->\n";
        }
        
        
        $session_ext = eregi_replace("[^a-z0-9]", "", $extension);
        if (strlen($session_ext) > 10) {
            $session_ext = substr($session_ext, 0, 10);
        }
        $session_rand = (rand(1, 9999999) + 10000000);
        $session_name = "$StarTtimE$US$session_ext$session_rand";
        
        if ($webform_sessionname) {
            $webform_sessionname = "&session_name=$session_name";
        } else {
            $webform_sessionname = '';
        }
        
        $stmt = "DELETE from web_client_sessions where start_time < '$past_month_date' and extension='$extension' and server_ip = '$server_ip' and program = 'vicidial';";
        if ($DB) {
            echo "|$stmt|\n";
        }
        $rslt = mysql_query($stmt, $link);
        if ($mel > 0) {
            mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01029', $VD_login, $server_ip, $session_name, $one_mysql_log);
        }
        
        $stmt = "INSERT INTO web_client_sessions values('$extension','$server_ip','vicidial','$NOW_TIME','$session_name');";
        if ($DB) {
            echo "|$stmt|\n";
        }
        $rslt = mysql_query($stmt, $link);
        if ($mel > 0) {
            mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01030', $VD_login, $server_ip, $session_name, $one_mysql_log);
        }
        
        if ((($campaign_allow_inbound == 'Y') and ($dial_method != 'MANUAL')) || ($campaign_leads_to_call > 0) || (ereg('Y', $no_hopper_leads_logins))) {
            ### insert an entry into the user log for the login event
            $stmt = "INSERT INTO vicidial_user_log (user,event,campaign_id,event_date,event_epoch,user_group) values('$VD_login','LOGIN','$VD_campaign','$NOW_TIME','$StarTtimE','$VU_user_group')";
            if ($DB) {
                echo "|$stmt|\n";
            }
            $rslt = mysql_query($stmt, $link);
            if ($mel > 0) {
                mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01031', $VD_login, $server_ip, $session_name, $one_mysql_log);
            }
            
            ##### check to see if the user has a conf extension already, this happens if they previously exited uncleanly
            $stmt = "SELECT conf_exten FROM vicidial_conferences where extension='$SIP_user' and server_ip = '$server_ip' LIMIT 1;";
			
			//echo $stmt;
            $rslt = mysql_query($stmt, $link);
            if ($mel > 0) {
                mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01032', $VD_login, $server_ip, $session_name, $one_mysql_log);
            }
            if ($DB) {
                echo "$stmt\n";
            }
            $prev_login_ct = mysql_num_rows($rslt);
            $i             = 0;
            while ($i < $prev_login_ct) {
                $row        = mysql_fetch_row($rslt);
                $session_id = $row[0];
                $i++;
            }
            if ($prev_login_ct > 0) {
                echo "<!-- USING PREVIOUS MEETME ROOM - $session_id - $NOW_TIME - $SIP_user -->\n";
            } else {
                ##### grab the next available vicidial_conference room and reserve it
                $stmt = "SELECT count(*) FROM vicidial_conferences where server_ip='$server_ip' and ((extension='') or (extension is null));";
                if ($DB) {
                    echo "$stmt\n";
                }
                $rslt = mysql_query($stmt, $link);
                if ($mel > 0) {
                    mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01033', $VD_login, $server_ip, $session_name, $one_mysql_log);
                }
                $row = mysql_fetch_row($rslt);
                if ($row[0] > 0) {
                    $stmt = "UPDATE vicidial_conferences set extension='$SIP_user', leave_3way='0' where server_ip='$server_ip' and ((extension='') or (extension is null)) limit 1;";
                    if ($format == 'debug') {
                        echo "\n<!-- $stmt -->";
                    }
                    $rslt = mysql_query($stmt, $link);
                    if ($mel > 0) {
                        mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01034', $VD_login, $server_ip, $session_name, $one_mysql_log);
                    }
                    
                    $stmt = "SELECT conf_exten from vicidial_conferences where server_ip='$server_ip' and ( (extension='$SIP_user') or (extension='$VD_login') );";
                    if ($format == 'debug') {
                        echo "\n<!-- $stmt -->";
                    }
                    $rslt = mysql_query($stmt, $link);
                    if ($mel > 0) {
                        mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01035', $VD_login, $server_ip, $session_name, $one_mysql_log);
                    }
                    $row        = mysql_fetch_row($rslt);
                    $session_id = $row[0];
                }
                echo "<!-- USING NEW MEETME ROOM - $session_id - $NOW_TIME - $SIP_user -->\n";
            }
            
            ### mark leads that were not dispositioned during previous calls as ERI
            $stmt = "UPDATE vicidial_list set status='ERI', user='' where status IN('QUEUE','INCALL') and user ='$VD_login';";
            if ($DB) {
                echo "$stmt\n";
            }
            $rslt = mysql_query($stmt, $link);
            if ($mel > 0) {
                mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01036', $VD_login, $server_ip, $session_name, $one_mysql_log);
            }
            $affected_rows = mysql_affected_rows($link);
            echo "<!-- old QUEUE and INCALL reverted list:   |$affected_rows| -->\n";
            
            $stmt = "DELETE from vicidial_hopper where status IN('QUEUE','INCALL','DONE') and user ='$VD_login';";
            if ($DB) {
                echo "$stmt\n";
            }
            $rslt = mysql_query($stmt, $link);
            if ($mel > 0) {
                mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01037', $VD_login, $server_ip, $session_name, $one_mysql_log);
            }
            $affected_rows = mysql_affected_rows($link);
            echo "<!-- old QUEUE and INCALL reverted hopper: |$affected_rows| -->\n";
            
            $stmt = "DELETE from vicidial_live_agents where user ='$VD_login';";
            if ($DB) {
                echo "$stmt\n";
            }
            $rslt = mysql_query($stmt, $link);
            if ($mel > 0) {
                mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01038', $VD_login, $server_ip, $session_name, $one_mysql_log);
            }
            $affected_rows = mysql_affected_rows($link);
            echo "<!-- old vicidial_live_agents records cleared: |$affected_rows| -->\n";
            
            $stmt = "DELETE from vicidial_live_inbound_agents where user ='$VD_login';";
            if ($DB) {
                echo "$stmt\n";
            }
            $rslt = mysql_query($stmt, $link);
            if ($mel > 0) {
                mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01039', $VD_login, $server_ip, $session_name, $one_mysql_log);
            }
            $affected_rows = mysql_affected_rows($link);
            echo "<!-- old vicidial_live_inbound_agents records cleared: |$affected_rows| -->\n";
            
            #	echo "<B>You have logged in as user: $VD_login on phone: $SIP_user to campaign: $VD_campaign</B><BR>\n";
            $VICIDiaL_is_logged_in = 1;
            
            ### set the callerID for manager middleware-app to connect the phone to the user
            $SIqueryCID = "S$CIDdate$session_id";
            
            #############################################
            ##### START SYSTEM_SETTINGS LOOKUP #####
            $stmt = "SELECT enable_queuemetrics_logging,queuemetrics_server_ip,queuemetrics_dbname,queuemetrics_login,queuemetrics_pass,queuemetrics_log_id,vicidial_agent_disable,allow_sipsak_messages FROM system_settings;";
            $rslt = mysql_query($stmt, $link);
            if ($mel > 0) {
                mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01040', $VD_login, $server_ip, $session_name, $one_mysql_log);
            }
            if ($DB) {
                echo "$stmt\n";
            }
            $qm_conf_ct = mysql_num_rows($rslt);
            if ($qm_conf_ct > 0) {
                $row                         = mysql_fetch_row($rslt);
                $enable_queuemetrics_logging = $row[0];
                $queuemetrics_server_ip      = $row[1];
                $queuemetrics_dbname         = $row[2];
                $queuemetrics_login          = $row[3];
                $queuemetrics_pass           = $row[4];
                $queuemetrics_log_id         = $row[5];
                $vicidial_agent_disable      = $row[6];
                $allow_sipsak_messages       = $row[7];
            }
            ##### END QUEUEMETRICS LOGGING LOOKUP #####
            ###########################################
            
            if (($enable_sipsak_messages > 0) and ($allow_sipsak_messages > 0) and (eregi("SIP", $protocol))) {
                $SIPSAK_prefix = 'LIN-';
                echo "<!-- sending login sipsak message: $SIPSAK_prefix$VD_campaign -->\n";
                passthru("/usr/local/bin/sipsak -M -O desktop -B \"$SIPSAK_prefix$VD_campaign\" -r 5060 -s sip:$extension@$phone_ip > /dev/null");
                $SIqueryCID = "$SIPSAK_prefix$VD_campaign$DS$CIDdate";
            }
            
            ### insert a NEW record to the vicidial_manager table to be processed
            $stmt = "INSERT INTO vicidial_manager values('','','$NOW_TIME','NEW','N','$server_ip','','Originate','$SIqueryCID','Channel: $SIP_user_DiaL','Context: $ext_context','Exten: $session_id','Priority: 1','Callerid: \"$SIqueryCID\" <$campaign_cid>','','','','','');";
            if ($DB) {
                echo "$stmt\n";
            }
            $rslt = mysql_query($stmt, $link);
            if ($mel > 0) {
                mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01041', $VD_login, $server_ip, $session_name, $one_mysql_log);
            }
            $affected_rows = mysql_affected_rows($link);
            echo "<!-- call placed to session_id: $session_id from phone: $SIP_user $SIP_user_DiaL -->\n";
            
            ##### grab the campaign_weight and number of calls today on that campaign for the agent
            $stmt = "SELECT campaign_weight,calls_today FROM vicidial_campaign_agents where user='$VD_login' and campaign_id = '$VD_campaign';";
            $rslt = mysql_query($stmt, $link);
            if ($mel > 0) {
                mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01042', $VD_login, $server_ip, $session_name, $one_mysql_log);
            }
            if ($DB) {
                echo "$stmt\n";
            }
            $vca_ct = mysql_num_rows($rslt);
            if ($vca_ct > 0) {
                $row             = mysql_fetch_row($rslt);
                $campaign_weight = $row[0];
                $calls_today     = $row[1];
                $i++;
            } else {
                $campaign_weight = '0';
                $calls_today     = '0';
                $stmt            = "INSERT INTO vicidial_campaign_agents (user,campaign_id,campaign_rank,campaign_weight,calls_today) values('$VD_login','$VD_campaign','0','0','$calls_today');";
                if ($DB) {
                    echo "$stmt\n";
                }
                $rslt = mysql_query($stmt, $link);
                if ($mel > 0) {
                    mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01043', $VD_login, $server_ip, $session_name, $one_mysql_log);
                }
                $affected_rows = mysql_affected_rows($link);
                echo "<!-- new vicidial_campaign_agents record inserted: |$affected_rows| -->\n";
            }
            
            if ($auto_dial_level > 0) {
                echo "<!-- campaign is set to auto_dial_level: $auto_dial_level -->\n";
                
                
                $closer_chooser_string = '';
                $stmt                  = "INSERT INTO vicidial_live_agents (user,server_ip,conf_exten,extension,status,lead_id,campaign_id,uniqueid,callerid,channel,random_id,last_call_time,last_update_time,last_call_finish,closer_campaigns,user_level,campaign_weight,calls_today,last_state_change,outbound_autodial,manager_ingroup_set) values('$VD_login','$server_ip','$session_id','$SIP_user','PAUSED','','$VD_campaign','','','','$random','$NOW_TIME','$tsNOW_TIME','$NOW_TIME','$closer_chooser_string','$user_level','$campaign_weight','$calls_today','$NOW_TIME','Y','N');";
                if ($DB) {
                    echo "$stmt\n";
                }
                $rslt = mysql_query($stmt, $link);
                if ($mel > 0) {
                    mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01044', $VD_login, $server_ip, $session_name, $one_mysql_log);
                }
                $affected_rows = mysql_affected_rows($link);
                echo "<!-- new vicidial_live_agents record inserted: |$affected_rows| -->\n";
                
                if ($enable_queuemetrics_logging > 0) {
                    $linkB = mysql_connect("$queuemetrics_server_ip", "$queuemetrics_login", "$queuemetrics_pass");
                    mysql_select_db("$queuemetrics_dbname", $linkB);
                    
                    $stmt = "INSERT INTO queue_log SET partition='P01',time_id='$StarTtimE',call_id='NONE',queue='NONE',agent='Agent/$VD_login',verb='AGENTLOGIN',data1='$VD_login@agents',serverid='$queuemetrics_log_id';";
                    if ($DB) {
                        echo "$stmt\n";
                    }
                    $rslt = mysql_query($stmt, $linkB);
                    if ($mel > 0) {
                        mysql_error_logging($NOW_TIME, $linkB, $mel, $stmt, '01045', $VD_login, $server_ip, $session_name, $one_mysql_log);
                    }
                    $affected_rows = mysql_affected_rows($linkB);
                    echo "<!-- queue_log AGENTLOGIN entry added: $VD_login|$affected_rows -->\n";
                    
                    $stmt = "INSERT INTO queue_log SET partition='P01',time_id='$StarTtimE',call_id='NONE',queue='NONE',agent='Agent/$VD_login',verb='PAUSEALL',serverid='$queuemetrics_log_id';";
                    if ($DB) {
                        echo "$stmt\n";
                    }
                    $rslt = mysql_query($stmt, $linkB);
                    if ($mel > 0) {
                        mysql_error_logging($NOW_TIME, $linkB, $mel, $stmt, '01046', $VD_login, $server_ip, $session_name, $one_mysql_log);
                    }
                    $affected_rows = mysql_affected_rows($linkB);
                    echo "<!-- queue_log PAUSE entry added: $VD_login|$affected_rows -->\n";
                    
                    mysql_close($linkB);
                    mysql_select_db("$VARDB_database", $link);
                }
                
                
                if (($campaign_allow_inbound == 'Y') and ($dial_method != 'MANUAL')) {
                    print "<!-- CLOSER-type campaign -->\n";
                }
            } else {
                print "<!-- campaign is set to manual dial: $auto_dial_level -->\n";
                
                $stmt = "INSERT INTO vicidial_live_agents (user,server_ip,conf_exten,extension,status,lead_id,campaign_id,uniqueid,callerid,channel,random_id,last_call_time,last_update_time,last_call_finish,user_level,campaign_weight,calls_today,last_state_change,outbound_autodial,manager_ingroup_set) values('$VD_login','$server_ip','$session_id','$SIP_user','PAUSED','','$VD_campaign','','','','$random','$NOW_TIME','$tsNOW_TIME','$NOW_TIME','$user_level', '$campaign_weight', '$calls_today','$NOW_TIME','N','N');";
                if ($DB) {
                    echo "$stmt\n";
                }
                $rslt = mysql_query($stmt, $link);
                if ($mel > 0) {
                    mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01047', $VD_login, $server_ip, $session_name, $one_mysql_log);
                }
                $affected_rows = mysql_affected_rows($link);
                echo "<!-- new vicidial_live_agents record inserted: |$affected_rows| -->\n";
                
                if ($enable_queuemetrics_logging > 0) {
                    $linkB = mysql_connect("$queuemetrics_server_ip", "$queuemetrics_login", "$queuemetrics_pass");
                    mysql_select_db("$queuemetrics_dbname", $linkB);
                    
                    $stmt = "INSERT INTO queue_log SET partition='P01',time_id='$StarTtimE',call_id='NONE',queue='$VD_campaign',agent='Agent/$VD_login',verb='AGENTLOGIN',data1='$VD_login@agents',serverid='$queuemetrics_log_id';";
                    if ($DB) {
                        echo "$stmt\n";
                    }
                    $rslt = mysql_query($stmt, $linkB);
                    if ($mel > 0) {
                        mysql_error_logging($NOW_TIME, $linkB, $mel, $stmt, '01048', $VD_login, $server_ip, $session_name, $one_mysql_log);
                    }
                    $affected_rows = mysql_affected_rows($linkB);
                    echo "<!-- queue_log AGENTLOGIN entry added: $VD_login|$affected_rows -->\n";
                    
                    $stmt = "INSERT INTO queue_log SET partition='P01',time_id='$StarTtimE',call_id='NONE',queue='NONE',agent='Agent/$VD_login',verb='PAUSEALL',serverid='$queuemetrics_log_id';";
                    if ($DB) {
                        echo "$stmt\n";
                    }
                    $rslt = mysql_query($stmt, $linkB);
                    if ($mel > 0) {
                        mysql_error_logging($NOW_TIME, $linkB, $mel, $stmt, '01049', $VD_login, $server_ip, $session_name, $one_mysql_log);
                    }
                    $affected_rows = mysql_affected_rows($linkB);
                    echo "<!-- queue_log PAUSE entry added: $VD_login|$affected_rows -->\n";
                    
                    mysql_close($linkB);
                    mysql_select_db("$VARDB_database", $link);
                }
            }
        } else {
            echo "</head>\n";
            echo "<body marginheight=\"0\" marginwidth=\"0\" >\n";
            //echo "<div class=\"time_lock\" ><a href=\"./timeclock.php?referrer=agent&pl=$phone_login&pp=$phone_pass&VD_login=$VD_login&VD_pass=$VD_pass\">时间锁</a></div>会议室不存在，users、vicidial_conferences\n";
			
            echo "<div class=\"login_form\">\n";
            echo "   <form id=\"vicidial_form\" name=\"vicidial_form\" method=\"post\" action=\"$PHP_SELF\" onSubmit=\"return fLoginFormSubmit();\" >\n";
            $VDdisplayMESSAGE = "对不起，该活动中没有可拨打的号码";
            if ($VDdisplayMESSAGE) {
                echo "<div class=\"load_layer\">$VDdisplayMESSAGE</div>\n";
            }
            echo "        <input type=\"hidden\" name=\"DB\" value=\"$DB\">\n";
            
            echo "        <div class=\"login_1\"><img src=\"/img/login_bg_1.jpg\" width=\"631\" height=\"60\" /></div>\n";
            echo "        <div class=\"login_2\">\n";
            echo "        <div class=\"login_user\"><input name=\"phone_login\" id=\"phone_login\" title=\"请输入分机号\" maxlength=\"20\" value=\"$phone_login\" /></div>\n";
            echo "       <div class=\"login_user\"><input name=\"phone_pass\" id=\"phone_pass\" title=\"请输入分机密码\" maxlength=\"20\" type=\"password\" value=\"$phone_pass\" /></div>\n";
            echo "       <div class=\"login_user\"><input name=\"VD_login\" id=\"VD_login\" title=\"请输入工号\" maxlength=\"20\" value=\"$VD_login\" /></div>\n";
            echo "        <div class=\"login_user\"><input name=\"VD_pass\" id=\"VD_pass\" title=\"请输入工号密码\" maxlength=\"20\" type=\"password\" value=\"$VD_pass\" /></div>\n";
            echo "        <div class=\"login_user\">\n";
            echo "            <span id=\"LogiNCamPaigns\">\n";
            echo "                <select name=\"VD_campaign\" id=\"VD_campaign\" onFocus=\"login_allowable_campaigns()\" class=\"lead\" title=\"请选择您要进入的业务活动\">\n";
            echo "                 <option value=\"\"></option>\n";
            echo "                </select>\n";
            echo "            </span>\n";
            echo "        </div>\n";
            echo "     </div>\n";
            echo "        <div class=\"login_3\">\n";
            echo "       	  <div class=\"login_sub\">\n";
            echo "       	     <input name=\"imageField\" type=\"image\" id=\"imageField\" src=\"/img/login_sumit.jpg\" alt=\"点击登陆\" />\n";
            echo "        	</div>\n";
            echo "            <div class=\"login_sub\">\n";
            echo "            	<span id=\"LogiNReseT\">\n";
            echo "             		<input name=\"relist\" type=\"image\" id=\"relist\" src=\"/img/login_list.jpg\" alt=\"刷新获取业务活动列表\" onClick=\"javascript:login_allowable_campaigns();return false\"/>\n";
            echo "              	</span>\n";
            echo "            </div>\n";
            echo "        </div>\n";
            echo "    </form>\n";
            echo "    <div class=\"login_foot\">$system_company</div>\n";
            echo "</div>\n";
            echo "</body>\n";
            echo "</html>\n";
            exit;
            
        }
        if (strlen($session_id) < 1) {
            echo "</head>\n";
            echo "<body marginheight=\"0\" marginwidth=\"0\" >\n";
            //echo "<div class=\"time_lock\" ><a href=\"./timeclock.php?referrer=agent&pl=$phone_login&pp=$phone_pass&VD_login=$VD_login&VD_pass=$VD_pass\">时间锁</a></div>\n";
            echo "<div class=\"login_form\">\n";
            echo "   <form id=\"vicidial_form\" name=\"vicidial_form\" method=\"post\" action=\"$PHP_SELF\" onSubmit=\"return fLoginFormSubmit();\" >\n";
            $VDdisplayMESSAGE = "Sorry, there are no available sessions";
            if ($VDdisplayMESSAGE) {
                echo "<div class=\"load_layer\">$VDdisplayMESSAGE</div>\n";
            }
            echo "        <input type=\"hidden\" name=\"DB\" value=\"$DB\">\n";
            
            echo "        <div class=\"login_1\"><img src=\"/img/login_bg_1.jpg\" width=\"631\" height=\"60\" /></div>\n";
            echo "        <div class=\"login_2\">\n";
            echo "        <div class=\"login_user\"><input name=\"phone_login\" id=\"phone_login\" title=\"请输入分机号\" maxlength=\"20\" value=\"$phone_login\" /></div>\n";
            echo "       <div class=\"login_user\"><input name=\"phone_pass\" id=\"phone_pass\" title=\"请输入分机密码\" maxlength=\"20\" type=\"password\" value=\"$phone_pass\" /></div>\n";
            echo "       <div class=\"login_user\"><input name=\"VD_login\" id=\"VD_login\" title=\"请输入工号\" maxlength=\"20\" value=\"$VD_login\" /></div>\n";
            echo "        <div class=\"login_user\"><input name=\"VD_pass\" id=\"VD_pass\" title=\"请输入工号密码\" maxlength=\"20\" type=\"password\" value=\"$VD_pass\" /></div>\n";
            echo "        <div class=\"login_user\">\n";
            echo "            <span id=\"LogiNCamPaigns\">\n";
            echo "                <select name=\"VD_campaign\" id=\"VD_campaign\" onFocus=\"login_allowable_campaigns()\" class=\"lead\" title=\"请选择您要进入的业务活动\">\n";
            echo "                 <option value=\"\"></option>\n";
            echo "                </select>\n";
            echo "            </span>\n";
            echo "        </div>\n";
            echo "     </div>\n";
            echo "        <div class=\"login_3\">\n";
            echo "       	  <div class=\"login_sub\">\n";
            echo "       	     <input name=\"imageField\" type=\"image\" id=\"imageField\" src=\"/img/login_sumit.jpg\" alt=\"点击登陆\" />\n";
            echo "        	</div>\n";
            echo "            <div class=\"login_sub\">\n";
            echo "            	<span id=\"LogiNReseT\">\n";
            echo "             		<input name=\"relist\" type=\"image\" id=\"relist\" src=\"/img/login_list.jpg\" alt=\"刷新获取业务活动列表\" onClick=\"javascript:login_allowable_campaigns();return false\"/>\n";
            echo "              	</span>\n";
            echo "            </div>\n";
            echo "        </div>\n";
            echo "    </form>\n";
            echo "    <div class=\"login_foot\">$system_company</div>\n";
            echo "</div>\n";
            echo "</body>\n";
            echo "</html>\n";
            exit;
            
        }
        
        if (ereg('MSIE', $browser)) {
            $useIE = 1;
            echo "<!-- client web browser used: MSIE |$browser|$useIE| -->\n";
        } else {
            $useIE = 0;
            echo "<!-- client web browser used: W3C-Compliant |$browser|$useIE| -->\n";
        }
        
        $StarTtimE = date("U");
        $NOW_TIME  = date("Y-m-d H:i:s");
        ##### Agent is going to log in so insert the vicidial_agent_log entry now
        $stmt      = "INSERT INTO vicidial_agent_log (user,server_ip,event_time,campaign_id,pause_epoch,pause_sec,wait_epoch,user_group,sub_status) values('$VD_login','$server_ip','$NOW_TIME','$VD_campaign','$StarTtimE','0','$StarTtimE','$VU_user_group','LOGIN');";
        if ($DB) {
            echo "$stmt\n";
        }
        $rslt = mysql_query($stmt, $link);
        if ($mel > 0) {
            mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01050', $VD_login, $server_ip, $session_name, $one_mysql_log);
        }
        $affected_rows = mysql_affected_rows($link);
        $agent_log_id  = mysql_insert_id($link);
        echo "<!-- vicidial_agent_log record inserted: |$affected_rows|$agent_log_id| -->\n";
        
        ##### update vicidial_campaigns to show agent has logged in
        $stmt = "UPDATE vicidial_campaigns set campaign_logindate='$NOW_TIME' where campaign_id='$VD_campaign';";
        if ($DB) {
            echo "$stmt\n";
        }
        $rslt = mysql_query($stmt, $link);
        if ($mel > 0) {
            mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01064', $VD_login, $server_ip, $session_name, $one_mysql_log);
        }
        $VCaffected_rows = mysql_affected_rows($link);
        echo "<!-- vicidial_campaigns campaign_logindate updated: |$VCaffected_rows|$NOW_TIME| -->\n";
        
        if ($enable_queuemetrics_logging > 0) {
            $StarTtimEpause = ($StarTtimE + 1);
            $linkB          = mysql_connect("$queuemetrics_server_ip", "$queuemetrics_login", "$queuemetrics_pass");
            mysql_select_db("$queuemetrics_dbname", $linkB);
            
            $stmt = "INSERT INTO queue_log SET partition='P01',time_id='$StarTtimEpause',call_id='NONE',queue='NONE',agent='Agent/$VD_login',verb='PAUSEREASON',data1='LOGIN',serverid='$queuemetrics_log_id';";
            if ($DB) {
                echo "$stmt\n";
            }
            $rslt = mysql_query($stmt, $linkB);
            
            if ($mel > 0) {
                mysql_error_logging($NOW_TIME, $linkB, $mel, $stmt, '01063', $VD_login, $server_ip, $session_name, $one_mysql_log);
            }
            $affected_rows = mysql_affected_rows($linkB);
            echo "<!-- queue_log PAUSEREASON LOGIN entry added: $VD_login|$affected_rows -->\n";
            
            mysql_close($linkB);
            mysql_select_db("$VARDB_database", $link);
        }
        
        $stmt = "UPDATE vicidial_live_agents SET agent_log_id='$agent_log_id' where user='$VD_login';";
        if ($DB) {
            echo "$stmt\n";
        }
        $rslt = mysql_query($stmt, $link);
        if ($mel > 0) {
            mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01061', $VD_login, $server_ip, $session_name, $one_mysql_log);
        }
        $VLAaffected_rows_update = mysql_affected_rows($link);
        
        $stmt = "UPDATE vicidial_users SET shift_override_flag='0' where user='$VD_login' and shift_override_flag='1';";
        if ($DB) {
            echo "$stmt\n";
        }
        $rslt = mysql_query($stmt, $link);
        if ($mel > 0) {
            mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01057', $VD_login, $server_ip, $session_name, $one_mysql_log);
        }
        $VUaffected_rows = mysql_affected_rows($link);
        
        $S      = '*';
        $D_s_ip = explode('.', $server_ip);
        if (strlen($D_s_ip[0]) < 2) {
            $D_s_ip[0] = "0$D_s_ip[0]";
        }
        if (strlen($D_s_ip[0]) < 3) {
            $D_s_ip[0] = "0$D_s_ip[0]";
        }
        if (strlen($D_s_ip[1]) < 2) {
            $D_s_ip[1] = "0$D_s_ip[1]";
        }
        if (strlen($D_s_ip[1]) < 3) {
            $D_s_ip[1] = "0$D_s_ip[1]";
        }
        if (strlen($D_s_ip[2]) < 2) {
            $D_s_ip[2] = "0$D_s_ip[2]";
        }
        if (strlen($D_s_ip[2]) < 3) {
            $D_s_ip[2] = "0$D_s_ip[2]";
        }
        if (strlen($D_s_ip[3]) < 2) {
            $D_s_ip[3] = "0$D_s_ip[3]";
        }
        if (strlen($D_s_ip[3]) < 3) {
            $D_s_ip[3] = "0$D_s_ip[3]";
        }
        $server_ip_dialstring = "$D_s_ip[0]$S$D_s_ip[1]$S$D_s_ip[2]$S$D_s_ip[3]$S";
        
        ##### grab the datails of all active scripts in the system
        $stmt = "SELECT script_id,script_name FROM vicidial_scripts WHERE active='Y' order by script_id limit 1000;";
        $rslt = mysql_query($stmt, $link);
        if ($mel > 0) {
            mysql_error_logging($NOW_TIME, $link, $mel, $stmt, '01051', $VD_login, $server_ip, $session_name, $one_mysql_log);
        }
        if ($DB) {
            echo "$stmt\n";
        }
        $MM_scripts = mysql_num_rows($rslt);
        $e          = 0;
        while ($e < $MM_scripts) {
            $row              = mysql_fetch_row($rslt);
            $MMscriptid[$e]   = $row[0];
            $MMscriptname[$e] = urlencode($row[1]);
            $MMscriptids      = "$MMscriptids'$MMscriptid[$e]',";
            $MMscriptnames    = "$MMscriptnames'$MMscriptname[$e]',";
            $e++;
        }
        $MMscriptids   = substr("$MMscriptids", 0, -1);
        $MMscriptnames = substr("$MMscriptnames", 0, -1);
    }
}


### SCREEN WIDTH AND HEIGHT CALCULATIONS ###
### DO NOT EDIT! ###
if ($stretch_dimensions > 0) {
    if ($agent_status_view < 1) {
        if ($JS_browser_width >= 510) {
            $BROWSER_WIDTH = ($JS_browser_width - 80);
        }
    } else {
        if ($JS_browser_width >= 730) {
            $BROWSER_WIDTH = ($JS_browser_width - 300);
        }
    }
    if ($JS_browser_height >= 340) {
        $BROWSER_HEIGHT = ($JS_browser_height - 40);
    }
}
$MASTERwidth  = ($BROWSER_WIDTH - 340);
$MASTERheight = ($BROWSER_HEIGHT - 200);
if ($MASTERwidth < 430) {
    $MASTERwidth = '430';
}
if ($MASTERheight < 300) {
    $MASTERheight = '300';
}

$CAwidth = ($MASTERwidth + 340); # 770 - cover all (none-in-session, customer hunngup, etc...)
$SBwidth = ($MASTERwidth + 331); # 761 - SideBar starting point
$MNwidth = ($MASTERwidth + 330); # 760 - main frame
$XFwidth = ($MASTERwidth + 320); # 750 - transfer/conference
$HCwidth = ($MASTERwidth + 310); # 740 - hotkeys and callbacks
$CQwidth = ($MASTERwidth + 300); # 730 - calls in queue listings
$AMwidth = ($MASTERwidth + 270); # 700 - preset-dial links
$SCwidth = ($MASTERwidth + 230); # 670 - live call seconds counter, sidebar link
$MUwidth = ($MASTERwidth + 180); # 610 - agent mute
$SSwidth = ($MASTERwidth + 176); # 606 - scroll script
$SDwidth = ($MASTERwidth + 170); # 600 - scroll script, customer data and calls-in-session
$HKwidth = ($MASTERwidth + 20); # 450 - Hotkeys button
$HSwidth = ($MASTERwidth + 1); # 431 - Header spacer
$CLwidth = ($MASTERwidth - 160); # 270 - Calls in queue link

$WRheight = ($MASTERheight + 160); # 460 - Warning boxes
$CQheight = ($MASTERheight + 140); # 440 - Calls in queue section
$SLheight = ($MASTERheight + 122); # 422 - SideBar link, Calls in queue link
$HKheight = ($MASTERheight + 105); # 405 - HotKey active Button
$AMheight = ($MASTERheight + 100); # 400 - Agent mute and preset dial links
$MBheight = ($MASTERheight + 65); # 365 - Manual Dial Buttons
$CBheight = ($MASTERheight + 50); # 350 - Agent Callback, pause code, volume control Buttons and agent status
$SSheight = ($MASTERheight + 31); # 331 - script content
$HTheight = ($MASTERheight + 10); # 310 - transfer frame, callback comments and hotkey
$BPheight = ($MASTERheight - 250); # 50 - bottom buffer, Agent Xfer Span


################################################################
### BEGIN - build the callback calendar (12 months)          ###
################################################################
define('ADAY', (60 * 60 * 24));
$CdayARY    = getdate();
$Cmon       = $CdayARY['mon'];
$Cyear      = $CdayARY['year'];
$CTODAY     = date("Y-m");
$CTODAYmday = date("j");
$CINC       = 0;

$Cmonths = Array(
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
    'July',
    'August',
    'September',
    'October',
    'November',
    'December'
);
$Cdays   = Array(
    'Sun',
    'Mon',
    'Tue',
    'Wed',
    'Thu',
    'Fri',
    'Sat'
);
 

?>