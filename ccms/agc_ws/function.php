<?php
function serializeuser(){
   global $link;

   $stmt = "SELECT vicidial_live_agents.conf_exten,vicidial_live_agents.extension,vicidial_live_agents.status,vicidial_live_agents.campaign_id,vicidial_live_agents.server_ip,vicidial_live_agents.user,vicidial_live_agents.inbound_mode from vicidial_live_agents";

   $rslt=mysql_query($stmt, $link);
   $rows_count = mysql_num_rows($rslt);
   $agent = array();
   if ($rows_count>0){
   	   $i = 0;
       while ( $i < $rows_count ){
       	       $rows = mysql_fetch_row($rslt);
			         $agent[$i]['conf_exten'] = $rows[0];
			         $agent[$i]['extension'] = $rows[1];
			         $agent[$i]['status'] = $rows[2];
			         $agent[$i]['campaign_id'] = $rows[3];
			         $agent[$i]['server_ip'] = $rows[4];
			         $agent[$i]['user'] = $rows[5];
			         $agent[$i]['campaign_inbound_mode'] = $rows[6];
			         $i = $i + 1;
			       	       
       }
   }
		 
   $contents = serialize($agent);
   
   $PATHweb = "/var/www/html";
   $conf_file = file("/etc/astguiclient.conf");
   foreach ($conf_file as $line){
		  $line = preg_replace("/ |>|\n|\r|\t|\#.*|;.*/","",$line);
		  if (ereg("^PATHweb", $line)) 			{$PATHweb = $line;   $PATHweb = preg_replace("/.*=/","",$PATHweb);}
   }
  
   //file_put_contents($PATHweb . "/ccms/agent_serialize",$contents);

   file_put_contents("/tmp/agent_serialize",$contents);      
   
}
//取得对应用户组
function getAgentViewUsergroup($user,$campaignid){
	global $link;
	$stmt="SELECT agent_status_viewable_groups from vicidial_user_groups where user_group=(select user_group from vicidial_users where user='$user');";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$agent_status_viewable_groups = "---" . $row[0];
	
	//echo $agent_status_viewable_groups;
	$group_arr = array();
	if(strpos($agent_status_viewable_groups,"--ALL-GROUPS--")){
		$stmt = "select user_group,group_name from vicidial_user_groups";
		$rslt=mysql_query($stmt, $link);
		$count_temp = mysql_num_rows($rslt);
		$i = 0;
		if($DB) {echo "$stmt\n";}
		while($i< $count_temp){
		  $row=mysql_fetch_row($rslt);
		  $group_arr[$row[0]]= $row[1];
		  $i++;
		}
	}elseif(strpos($agent_status_viewable_groups,"--CAMPAIGN-AGENTS--")){
		$stmt = "select a.user_group,a.group_name from vicidial_user_groups a,vicidial_users b  where a.user_group=b.user_group and b.user in(select user from vicidial_live_agents where campaign_id='$campaignid')";
		$rslt=mysql_query($stmt, $link);
		$count_temp = mysql_num_rows($rslt);
		$i = 0;
		if($DB) {echo "$stmt\n";}
		while($i< $count_temp){
		  $row=mysql_fetch_row($rslt);
		  $group_arr[$row[0]]= $row[1];
		  $i++;
		}
	}else{
		//echo $row[0];
		$groups = explode(" ", trim($row[0]));
		$groups_arr = array();
		foreach($groups as $temp){
			$groups_arr[] = "'" . $temp . "'";
		}
		$stmt = "select user_group,group_name from vicidial_user_groups where user_group in(" . implode(",",$groups_arr) . ")";
		$rslt=mysql_query($stmt, $link);
		$count_temp = mysql_num_rows($rslt);
		$i = 0;
		if($DB) {echo "$stmt\n";}
		while($i< $count_temp){
		  $row=mysql_fetch_row($rslt);
		  $group_arr[$row[0]]= $row[1];
		  $i++;
		}
		
	}
	//var_dump($group_arr);
	$result = "";
	$all_temp = array();
	foreach($group_arr as $k=>$v){
		$result = $result . "<option value=\"" . $k . "\">" . $v . "</option>";
	}
	if(count($group_arr)==1){
		foreach($group_arr as $k=>$v){
			$all_temp[] = $k;
		}
	}else{
		foreach($group_arr as $k=>$v){
			$all_temp[] = "'" . $k . "'";
		}
	}
	$result = "<option value=\"" . implode(",",$all_temp) . "\">[All]</option>" . $result;
	return $result;
}
//取得技能组
function getAgentViewTechgroup($VD_campaign){
	global $link;
	$stmt="SELECT closer_campaigns from vicidial_campaigns where campaign_id='$VD_campaign';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$closer_campaigns =	$row[0];
	$closer_campaigns = preg_replace("/ -$/","",$closer_campaigns);
	//$closer_campaigns = str_replace(" ",",",trim($closer_campaigns));
	$groups = explode(" ", trim($closer_campaigns));
	$groups_arr = array();
	foreach($groups as $temp){
		$groups_arr[] = "'" . $temp . "'";
	}
	$stmt="SELECT group_id,group_name from vicidial_inbound_groups where group_id in(" . implode(",",$groups_arr) . ") order by inbound_mode,group_id";
	//echo $stmt;
	$rslt=mysql_query($stmt, $link);
	$count_temp = mysql_num_rows($rslt);
	$i = 0;
	if($DB) {echo "$stmt\n";}
	$result = "";
	$all_temp = array();
	while($i< $count_temp){
	  $row=mysql_fetch_row($rslt);
	  if(!strpos("a" . $row[0],"AGENTDIRECT")){
	    $all_temp[] = $row[0] ;
		$result = $result . "<option value=\"" . $row[0] . "\">" . $row[1] . "</option>";
	  }
	  $i++;
	}
	$result = "<option value=\"" . implode(",",$all_temp) . "\">[All]</option>" . $result;
	return $result;
}
?>
