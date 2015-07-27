<html>
<head>
<?
//require("dbconnect.php");

if (isset($_GET["uniqueid"])){
	$unqiueid=$_GET["uniqueid"];
}
if (isset($_GET["status"])){
	$status=$_GET["status"];
}
if (isset($_GET["phone"])){
	$phone=$_GET["phone"];
}
if (isset($_GET["phone2"])){
	$phone2=$_GET["phone2"];
}
if (isset($_GET["direction"])){
	$direction=$_GET["direction"];
}
if (isset($_GET["user"])){
	$user=$_GET["user"];
}
if(empty($unqiueid)){
	echo "invalid!";
	exit;
}

if($status=="1"){
	$v_recording_log = "recording_log";
	$vicidial_log = "vicidial_log";
	$recording_log = "recording_log";
	$call_log_all = "call_log";
	$vicidial_closer_log = "vicidial_closer_log";
}else{
	$v_recording_log = "recording_log_archive";
	$vicidial_log = "vicidial_log_archive";
	$recording_log = "recording_log_archive";
	$call_log_all = "call_log_archive";
	$vicidial_closer_log = "vicidial_closer_log_archive";
	}


if($direction=="Inbound"){
	$num = get_call_log_inbound($unqiueid);
}else{
	$num = get_call_log_outbound($unqiueid);
}

if($num == 0 && $direction=="Outbound"){
	$num = get_outboundRecord_from_recording_log($unqiueid);
	if($num == 0){
		$num = get_sound_file_other_outbound($unqiueid,$phone2,$user,500);
	}
	if($num == 0){
		$num = get_sound_file_other_outbound($unqiueid,$phone2,$user,1000);
	}
	if($num == 0){
		$num = get_sound_file_other_outbound($unqiueid,$phone2,$user,1500);
	}
	if($num == 0){
		$num = get_sound_file_other_outbound($unqiueid,$phone2,$user,2000);
	}
	if($num == 0){
		$num = get_sound_file_other_outbound($unqiueid,$phone2,$user,3000);
	}
}
if($num == 0){
	$pos = strpos ($unqiueid, ".");
	//$new_unqiueid = str_replace(".","",$unqiueid);
	$new_unqiueid = substr($unqiueid,$pos + 1,strlen($unqiueid)-$pos);
	$unqiueid_add =  $new_unqiueid + 1;
	if($new_unqiueid != "0"){
		$unqiueid_minus =  $new_unqiueid - 1;
	}else{
		$unqiueid_minus =  $new_unqiueid ;
	}
	$unqiueid_add = substr($unqiueid,0,$pos).".".$unqiueid_add;
	$unqiueid_minus = substr($unqiueid,0,$pos).".".$unqiueid_minus;
	  	
	if($direction=="Inbound"){
		$num = get_call_log_inbound($unqiueid_add);
	}else{
		$num = get_call_log_outbound($unqiueid_add);
	}


	if($num == 0){
		if($direction=="Inbound"){
			$num = get_call_log_inbound($unqiueid_minus);
		}else{
			$num = get_call_log_outbound($unqiueid_minus);
		}
	}
	
	if($num == 0){
		$num = get_sound_file_vicidialid($unqiueid,$phone,$user);
	}
	if($num == 0){
		$num = get_direct_call_log($unqiueid);
	}
	if($num == 0){
		echo "录音不存在，原因可能是以下两种：<br>1、电话未接通（客户来电时座席未接听；拨打外线时无法接通或无人接听）；<br>2、电话接通后断开；<br>";
	}
	
}
function get_call_log_inbound($unqiueid){
	require("dbconnect_report.php");
	global $v_recording_log;
	global $recording_log;
	global $vicidial_closer_log;
	global $user;
	$stmt="SELECT closecallid FROM $vicidial_closer_log where uniqueid='$unqiueid';";
	$num = 0;
	$rslt=mysql_query($stmt, $link);
	if ($rslt) {$calls_count = mysql_num_rows($rslt);}
	$loop_count=0;
	while ($calls_count > $loop_count)
		{
		$row=mysql_fetch_row($rslt);
		$closecallid = $row[0];
		if(!empty($closecallid)){
			$stmt="SELECT location,filename FROM $recording_log WHERE vicidial_id='$closecallid' and user ='$user'";
			if ($DB) {echo "|$stmt|\n";}
			$rslt2=mysql_query($stmt, $link);
			while($row2=mysql_fetch_array($rslt2)){
				$location[] = $row2[0];
				$filename[] = $row2[1];
			}
			$num= count($location);
		}
		$loop_count++;
		}

	//echo $num;
	if($num == 1){
		writelog($stmt);
		header("Location:".$location[0]);
		return $num;
	}
	if($num > 1){
		writelog($stmt);
		$i = 0;
		foreach($location as $itmes){
			echo "<a href='".$itmes."' target='_blank'>".$filename[$i]."</a><br>";
			$i++;
		}
		return $num;
	}
	if($num == 0){
		return 0;
	}
}
function get_call_log_outbound($unqiueid){
	require("dbconnect_report.php");
	global $v_recording_log;
	$stmt="SELECT location,filename FROM $v_recording_log WHERE vicidial_id='$unqiueid'";

	//echo $stmt . "<br>";
	if ($DB) {echo "|$stmt|\n";}
	$rslt=mysql_query($stmt, $link);
	while($row=mysql_fetch_array($rslt)){

		$location[] = $row[0];
		$filename[] = $row[1];
	}
	//print_r($location[0]);exit;
	$num= count($location);
	
	if($num == 1){
		writelog($stmt);
		header("Location:".$location[0]);

		return $num;
	}
	if($num > 1){
		writelog($stmt);
		$i = 0;
		foreach($location as $itmes){
			echo "<a href='".$itmes."' target='_blank'>".$filename[$i]."</a><br>";
			$i++;
		}
		return $num;
	}
	if($num == 0){
		return 0;
	}
}
/*
	在CCMS 3.0项目中，如果客户使用CCMS座席页面拨打电话后未点击挂断进入小结或点击小结后未提交，会造成该通话的录音在vicidial/Recording_log表中缺少vicidial_id(即uniqueid)导致无法下载录音，解决办法

*/

function get_sound_file_other_outbound($unqiueid,$phone,$user,$dur){
	require("dbconnect_report.php");
	global $vicidial_log;
	global $recording_log;
	$stmt="SELECT start_epoch FROM $vicidial_log WHERE uniqueid='$unqiueid'";
	//echo $stmt . "<br>";
	if ($DB) {echo "|$stmt|\n";}
	$rslt = mysql_query($stmt, $link);
	$row = mysql_fetch_array($rslt);
	if(!empty($row)){
		$start_epoch = $row[0];
	}else{
		return 0;
	}
	$start_time = $start_epoch - $dur;
	$end_time = $start_epoch + $dur;
	if($user!=""){
		$stmt="SELECT location,filename FROM $recording_log WHERE user='$user' and location like '%" . $phone . "-all.%' and start_epoch >= $start_time and start_epoch <= $end_time";
	}else{
		$stmt="SELECT location,filename FROM $recording_log WHERE location like '%" . $phone . "-all.%' and start_epoch >= $start_time and start_epoch <= $end_time";
	}
	//echo $stmt;exit;
	if ($DB) {echo "|$stmt|\n";}
	$rslt=mysql_query($stmt, $link);
	while($row=mysql_fetch_array($rslt)){

		$location[] = $row[0];
		$filename[] = $row[1];
	}
	$num= count($location);
	
	if($num == 1){
		writelog($stmt);
		header("Location:".$location[0]);
		return $num;
	}
	if($num > 1){
		writelog($stmt);
		$i = 0;
		foreach($location as $itmes){
			echo "<a href='".$itmes."' target='_blank'>".$filename[$i]."</a><br>";
			$i++;
		}
		return $num;
	}
	if($num == 0){
		return 0;
	}
}


/*
	当recording_log中vicidial_id为空时查找录音
*/
function get_sound_file_vicidialid($unqiueid,$phone,$user){
	require("dbconnect_report.php");
	global $call_log;
	global $recording_log;
	$stmt="SELECT start_time,number_dialed FROM $call_log WHERE uniqueid='$unqiueid'";
	//echo $stmt . "<br>";
	if ($DB) {echo "|$stmt|\n";}
	$rslt = mysql_query($stmt, $link);
	$row = mysql_fetch_array($rslt);
	if(!empty($row)){
		$start_time = $row[0];
		$number_dialed = $row[1];
	}else{
		return 0;
	}
	//echo $start_time . "<BR>";
	$end_time = date("Y-m-d H:i:s",strtotime($start_time) + 1);
	if($user == ""){
		if($phone == ""){
			$stmt="SELECT location,filename FROM `vicidial`.`$recording_log` where vicidial_id is null and start_time>='$start_time' and start_time<='$end_time'" . " union " . "SELECT location,filename FROM `vicidial`.`$recording_log` where vicidial_id = '' and start_time>='$start_time' and start_time<='$end_time'";
		}else{
			$stmt="SELECT location,filename FROM `vicidial`.`$recording_log` where location like '%" . $phone . "-all.%' and vicidial_id is null and start_time>='$start_time' and start_time<='$end_time'" . " union " . "SELECT location,filename FROM `vicidial`.`$recording_log` where location like '%" . $phone . "-all.%' and vicidial_id = '' and start_time>='$start_time' and start_time<='$end_time'";
		}
	}else{
		$stmt="SELECT location,filename FROM `vicidial`.`$recording_log` where vicidial_id is null and user='$user' and start_time>='$start_time' and start_time<='$end_time'" . " union " . "SELECT location,filename FROM `vicidial`.`$recording_log` where vicidial_id = '' and user='$user' and start_time>='$start_time' and start_time<='$end_time'";
	}
	
	//echo $stmt;exit;
	if ($DB) {echo "|$stmt|\n";}
	$rslt=mysql_query($stmt, $link);
	while($row=mysql_fetch_array($rslt)){

		$location[] = $row[0];
		$filename[] = $row[1];
	}
	$num= count($location);
	
	if($num == 1){
		writelog($stmt);
		if(!empty($location[0])){
			header("Location:".$location[0]);
		}else{
			echo "录音文件对应字段为空";
			writelog("录音文件对应字段为空" . $stmt);
		}
		return $num;
	}
	if($num > 1){
		writelog($stmt);
		$i = 0;
		foreach($location as $itmes){
			echo "<a href='".$itmes."' target='_blank'>".$filename[$i]."</a><br>";
			$i++;
		}
		return $num;
	}
	if($num == 0){
		return 0;
	}
}

function get_direct_call_log($unqiueid){
	require("dbconnect_report.php");
	global $recording_log;
	$stmt="SELECT location,filename FROM $recording_log WHERE vicidial_id='$unqiueid'";

	//echo $stmt . "<br>";exit;
	if ($DB) {echo "|$stmt|\n";}
	$rslt=mysql_query($stmt, $link);
	while($row=mysql_fetch_array($rslt)){

		$location[] = $row[0];
		$filename[] = $row[1];
	}
	//print_r($location[0]);exit;
	$num= count($location);
	
	if($num == 1){
		writelog($stmt);
		header("Location:".$location[0]);
		return $num;
	}
	if($num > 1){
		writelog($stmt);
		$i = 0;
		foreach($location as $itmes){
			echo "<a href='".$itmes."' target='_blank'>".$filename[$i]."</a><br>";
			$i++;
		}
		return $num;
	}
	if($num == 0){
		return 0;
	}
}

function writelog($temp){
		$efp = fopen ("recording.txt", "a");
		fwrite ($efp, "$temp\n");
		fclose($efp);
}

function get_outboundRecord_from_recording_log($unqiueid){
	require("dbconnect_report.php");
	
	$stmt="SELECT location,filename FROM recording_log WHERE vicidial_id='$unqiueid'";

	//echo $stmt . "<br>";
	if ($DB) {echo "|$stmt|\n";}
	$rslt=mysql_query($stmt, $link);
	while($row=mysql_fetch_array($rslt)){

		$location[] = $row[0];
		$filename[] = $row[1];
	}
	//print_r($location[0]);exit;
	$num= count($location);
	
	if($num == 1){
		writelog($stmt);
		header("Location:".$location[0]);

		return $num;
	}
	if($num > 1){
		writelog($stmt);
		$i = 0;
		foreach($location as $itmes){
			echo "<a href='".$itmes."' target='_blank'>".$filename[$i]."</a><br>";
			$i++;
		}
		return $num;
	}
	if($num == 0){
		return 0;
	}
}
?>
</head>
<body>
</body>
</html>
