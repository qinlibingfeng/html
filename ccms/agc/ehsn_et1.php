<?php
	//ini_set('display_errors','On');
	$rs = @file("http://10.201.209.200/ehsn/et1/ui/internet/cti/screens/getCWC.jsp");
	if(!$rs){
	$rs = file("http://10.201.209.204/AgentID/getCWC.asp");
	
	}
	var_dump($rs);
?>
		