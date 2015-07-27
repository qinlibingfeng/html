<?
	
	$useIP = "10.201.209.200";
	$backupIP = "10.201.209.204";
	if(empty($_SESSION['et1url'])){
		//$rs = @file("http://10.201.209.200/ehsn/et1/ui/internet/cti/screens/getCWC.jsp");
		if(@fsockopen($useIP, 80, $errno, $errstr, 5)){
			$_SESSION['et1url'] = "http://".$useIP."/ehsn/et1/ui/internet/cti/screens";
			$_SESSION['etlsuffix'] = "jsp";
		}else{
			$_SESSION['et1url'] = "http://".$backupIP."/AgentID";
			$_SESSION['etlsuffix'] = "asp";
		}
	}else{
		if($_SESSION['etlsuffix'] == "jsp"){
			if(!@fsockopen($useIP, 80, $errno, $errstr, 5)){
				$_SESSION['et1url'] = "http://".$backupIP."/AgentID";
				$_SESSION['etlsuffix'] = "asp";
			}
		}else{
			if(!@fsockopen($backupIP, 80, $errno, $errstr, 5)){
				$_SESSION['et1url'] = "http://".$useIP."/ehsn/et1/ui/internet/cti/screens";
				$_SESSION['etlsuffix'] = "jsp";
			}
		}
	}
?>