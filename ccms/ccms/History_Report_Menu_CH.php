<?php
if ($LOGview_historical_reports==1){
	
	$stmt="select server_id,server_description,server_ip,active,sysload,channels_total,cpu_idle_percent,disk_usage from servers order by server_id;";
		$rslt=mysql_query($stmt, $link);
		if ($DB) {echo "$stmt\n";}
		$servers_to_print = mysql_num_rows($rslt);
		$i=0;
		while ($i < $servers_to_print)
			{
			$row=mysql_fetch_row($rslt);
			$server_id[$i] =			$row[0];
			$server_description[$i] =	$row[1];
			$server_ip[$i] =			$row[2];
			$active[$i] =				$row[3];
			$sysload[$i] =				$row[4];
			$channels_total[$i] =		$row[5];
			$cpu_idle_percent[$i] =		$row[6];
			$disk_usage[$i] =			$row[7];
			$i++;
			}

		$stmt="SELECT queuemetrics_url,vtiger_url,ccms_report_url from system_settings;";
		$rslt=mysql_query($stmt, $link);
		$row=mysql_fetch_row($rslt);
		$queuemetrics_url_LU =				$row[0];
		$vtiger_url_LU =					$row[1];
		$Report_Server_URL =				$row[2];

		$stmt="SELECT count(*) from vicidial_list_update_log;";
		$rslt=mysql_query($stmt, $link);
		$row=mysql_fetch_row($rslt);
		$list_update_count =				$row[0];
	
		$query = "select title,link,category from ccms_report_manager where is_open='Y' and cn_en='cn';";
		$rslt=mysql_query($query, $link);
		
		$num = mysql_num_rows($rslt);
		$o=0;
		$arr = array();
		while($num > $o){		 
			$row=mysql_fetch_row($rslt);
			/*
			$dir = explode("/",$row[1]);
			$prpt_arr = explode(" ",$dir[1]);
			$prpt = implode("+",$prpt_arr);
			
			echo "<a href=\"#\" onclick=\"small_menu_openwindow('".$Report_Server_URL."/content/reporting/reportviewer/report.html?userid=joe&password=password&solution=CCMS&path=%2F".$dir[0]."&name=".$prpt."&locale=zh_CN&autoSubmit=false&VIEWER=".$LOGuser_name_id."');\">$row[0]</a>";
			*/					
			$arr[$row[2]][] = array($row[0],$row[1]);
			$o++;			
		}	
?>
<table width="750" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td class="right_centerbg">
<style>
.out{
	width:100%;

}
.in{
	width:50%;
	float:left;
overflow:hidden;
display:inline;
*margin-left:-1px; 	
}
.in li{
	list-style-type:none;
	color: #555;
	text-decoration: none;
	font-size: 12px;
}
h3{		
	padding:0px;
	margin:0px;
	background-color:#c2c2c2;
	font-size: x-small;
	color: black;
	font-weight : normal;
}
</style>
<div class="out">
<?php
foreach($arr as $key=>$arr1){
	echo "<div class=\"in\">";
	echo "<h3>[ $key ]</h3>";
	foreach($arr1 as $key=>$arr2){	
		$dir = explode("/",$arr2[1]);
		$prpt_arr = explode(" ",$dir[1]);
		$prpt = implode("+",$prpt_arr);
		echo "<li><a href=\"#\" onclick=\"small_menu_openwindow('".$Report_Server_URL."/content/reporting/reportviewer/report.html?userid=joe&password=password&solution=CCMS&path=%2F".$dir[0]."&name=".$prpt."&locale=zh_CN&autoSubmit=false&VIEWER=".$LOGuser_name_id."');\">$arr2[0]</a></li>";
	}
	echo "</div>";
}

?>
</div>
</td></tr></table>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr><td><div class="out"><div class="in">
<h3>[ Campaign Report ]</h3>
<?php
    $stmt = getCampaignSql($LOGuser_level,$LOGuser_name_id,'Y');
    $rslt=mysql_query($stmt, $link);
    $campaigns_to_print = mysql_num_rows($rslt);
    
    if($campaigns_to_print>0){
        $o=0;
        $campaigns_arr_temp = array();
        while ($campaigns_to_print > $o) 
            {
            $rowx=mysql_fetch_row($rslt);
            $campaigns_arr_temp[] = "'" . $rowx[0] . "'";
            $o++;
            }
        foreach($campaigns_arr_temp as $campaign){
            $query = "select title,link from ccms_report_manager where campaign_id=$campaign and is_open='N' and cn_en='cn';";
            $rslt=mysql_query($query, $link);
            $num = mysql_num_rows($rslt);
            $o=0;
            while($num > $o){
                $row=mysql_fetch_row($rslt);
                
                $dir = explode("/",$row[1]);
                $prpt_arr = explode(" ",$dir[1]);
                $prpt = implode("+",$prpt_arr);
                
                echo "<li><a href=\"#\" onclick=\"small_menu_openwindow('".$Report_Server_URL."/content/reporting/reportviewer/report.html?userid=joe&password=password&solution=CCMS&path=%2F".$dir[0]."&name=".$prpt."&locale=zh_CN&autoSubmit=false&VIEWER=".$LOGuser_name_id."');\">$row[0]</a></li>";
                $o++;
            }
        }
    }
    
    ?>
</div></div></td></tr></table>
<?php
		
		
	}else{
		echo "You do not have permission to view this page\n";
	}