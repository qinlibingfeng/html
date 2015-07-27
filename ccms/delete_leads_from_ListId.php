<?php
		set_time_limit(0);
		header ("Content-type: text/html; charset=utf-8");
		require("dbconnect.php");

		if (isset($_GET["list_id"]))	{$list_id=$_GET["list_id"];}
		elseif (isset($_POST["list_id"]))	{$list_id=$_POST["list_id"];}

		$stmt="SELECT campaign_id from vicidial_lists where list_id='$list_id' limit 1;";
//		echo $stmt."<br>";
		$rslt=mysql_query("SET NAMES 'UTF8'");
		$rslt=mysql_query($stmt, $link);
//		echo $stmt."<br>";
		$rslt=mysql_query($stmt, $link);
		$row=mysql_fetch_row($rslt);
		$campaign_id=$row[0];
//		echo $campaign_id."<br>";

##### START SYSTEM_SETTINGS VTIGER CONNECTION INFO LOOKUP #####
		$stmt = "SELECT enable_vtiger_integration,vtiger_server_ip,vtiger_dbname,vtiger_login,vtiger_pass,vtiger_url FROM vicidial_campaigns where campaign_id='$campaign_id' and enable_vtiger_integration = '1' ;";
//		echo $stmt."<br>";
		$rslt=mysql_query("SET NAMES 'UTF8'");
		$rslt=mysql_query($stmt, $link);
//		if ($DB) {echo "$stmt\n";}
		$conf_count = mysql_num_rows($rslt);
		if ($conf_count > 0)
		{
			$row=mysql_fetch_row($rslt);
			$enable_vtiger_integration =	$row[0];
			$vtiger_server_ip	=			$row[1];
			$vtiger_dbname =				$row[2];
			$vtiger_login =					$row[3];
			$vtiger_pass =					$row[4];
			$vtiger_url =					$row[5];

### connect to your vtiger database
		$linkV=mysql_connect("$vtiger_server_ip", "$vtiger_login","$vtiger_pass");
		if (!$linkV) {die("Could not connect: $vtiger_server_ip|$vtiger_dbname|$vtiger_login|$vtiger_pass" . mysql_error());}
//		echo "Connected successfully\n<BR>\n";
		mysql_select_db("$vtiger_dbname", $linkV);

#### start 根据list_id 获取要删除的leadid;
		$stmt	=	"SELECT leadid FROM vtiger_leadscf  WHERE cf_605 = '$list_id'";
//		echo $stmt."<br>";
		$rslt=mysql_query("SET NAMES 'UTF8'");
		$rslt=mysql_query($stmt, $linkV);
//		if ($DB) {echo "$stmt\n";}
		$conf_count = mysql_num_rows($rslt);
		$i=0;
		$arr_leadid = array();
		while ($conf_count > $i) 
		{
			$row=mysql_fetch_row($rslt);
			$arr_leadid[$i] = "'".$row[0]."'";
			$i++;
		}
		$leadid_lists = implode(",",$arr_leadid);
//		echo $leadid_lists."<br>";
		if($leadid_lists == ''){$leadid_lists = "''";}

#### end 根据list_id 获取要删除的leadid;
################################
################################
#### start 根据获取的leadid再获取对应的activityid;
		$stmt	=	"SELECT activityid FROM vtiger_seactivityrel  WHERE crmid in (".$leadid_lists.")";
//		echo $stmt."<br>";
		$rslt=mysql_query("SET NAMES 'UTF8'");
		$rslt=mysql_query($stmt, $linkV);
//		if ($DB) {echo "$stmt\n";}
		$conf_count = mysql_num_rows($rslt);
		$i=0;
		$arr_activityid = array();
		while ($conf_count > $i) 
		{
			$row=mysql_fetch_row($rslt);
			$arr_activityid[$i] = "'".$row[0]."'";
			$i++;
		}
		$activityid_lists = implode(",",$arr_activityid);
//		echo $activityid_lists."<br>";
		if($activityid_lists == ''){$activityid_lists = "''";}

#### end 根据获取的leadid再获取对应的activityid;

#####################################
#####Start Delete Vtiger's Leads

####1 Removing LIST LEADS FROM vtiger_crmentity TABLE
		$stmtA="DELETE from vtiger_crmentity where crmid in (".$leadid_lists.")";
//		echo $stmtA."<br>";
		$rslt=mysql_query("SET NAMES 'UTF8'");
		$rslt=mysql_query($stmtA, $linkV);

####2 Removing LIST LEADS FROM vtiger_leaddetails TABLE
		$stmtB="DELETE from vtiger_leaddetails where leadid in (".$leadid_lists.")";
//		echo $stmtB."<br>";
		$rslt=mysql_query("SET NAMES 'UTF8'");
		$rslt=mysql_query($stmtB, $linkV);

####3 Removing LIST LEADS FROM vtiger_leadaddress TABLE
		$stmtC="DELETE from vtiger_leadaddress where leadaddressid in (".$leadid_lists.")";
//		echo $stmtC."<br>";
		$rslt=mysql_query("SET NAMES 'UTF8'");
		$rslt=mysql_query($stmtC, $linkV);

####4 Removing LIST LEADS FROM vtiger_leadscf TABLE
		$stmtD="DELETE from vtiger_leadscf where leadid in (".$leadid_lists.")";
//		echo $stmtD."<br>";
		$rslt=mysql_query("SET NAMES 'UTF8'");
		$rslt=mysql_query($stmtD, $linkV);

####5 Removing LIST LEADS FROM vtiger_leadsubdetails TABLE
		$stmtE="DELETE from vtiger_leadsubdetails where leadsubscriptionid in (".$leadid_lists.")";
//		echo $stmtE."<br>";
		$rslt=mysql_query("SET NAMES 'UTF8'");
		$rslt=mysql_query($stmtE, $linkV);

####6 Removing LIST LEADS FROM vtiger_activity TABLE
		$stmtF="DELETE from vtiger_activity where activityid in (".$activityid_lists.")";
//		echo $stmtF."<br>";
		$rslt=mysql_query("SET NAMES 'UTF8'");
		$rslt=mysql_query($stmtF, $linkV);

####7 Removing LIST LEADS FROM vtiger_salesmanactivityrel TABLE
		$stmtG="DELETE from vtiger_salesmanactivityrel where activityid in (".$activityid_lists.")";
//		echo $stmtG."<br>";
		$rslt=mysql_query("SET NAMES 'UTF8'");
		$rslt=mysql_query($stmtG, $linkV);

####8 Removing LIST LEADS FROM vtiger_seactivityrel TABLE
		$stmtH="DELETE from vtiger_seactivityrel where activityid in (".$activityid_lists.")";
//		echo $stmtH."<br>";
		$rslt=mysql_query("SET NAMES 'UTF8'");
		$rslt=mysql_query($stmtH, $linkV);
	
		}
		echo "Delete Successfully!\n";
		exit;
?>