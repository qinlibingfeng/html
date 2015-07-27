<?
//require("dbconnect.php");

if (isset($_GET["uniqueid"])){
	$unqiueid=$_GET["uniqueid"];
}
if (isset($_GET["phone"])){
	$phone=$_GET["phone"];
}
if (isset($_GET["user"])){
	$user=$_GET["user"];
}
if(empty($unqiueid)){
	echo "invalid!";
	exit;
}
	$pos = strpos ($unqiueid, "."); 
	$new_unqiueid = substr($unqiueid,$pos + 1,strlen($unqiueid)-$pos);
	$unqiueid_add =  $new_unqiueid + 1;
	if($new_unqiueid != "0"){
		$unqiueid_minus =  $new_unqiueid - 1;
	}else{
		$unqiueid_minus =  $new_unqiueid ;
	}
	$unqiueid_add = substr($unqiueid,0,$pos).".".$unqiueid_add;
	$unqiueid_minus = substr($unqiueid,0,$pos).".".$unqiueid_minus;
	  	
	
	echo $unqiueid . "<BR>" . $unqiueid_add . "<BR>" . $unqiueid_minus;
	exit;
//echo get_sound_file_other($unqiueid,$phone);exit;
$num = get_call_log_inbound($unqiueid);

if($num == 0){
$num = get_call_log_outbound($unqiueid);
}
if($num == 0){
	$pos = strpos ($unqiueid, "."); 
	$new_unqiueid = str_replace(".","",$unqiueid);
	$unqiueid_add =  sprintf( "%.0f ",$new_unqiueid + 1);
	$unqiueid_minus =  sprintf( "%.0f ",$new_unqiueid - 1);
	$unqiueid_add = substr($unqiueid_add,0,$pos).".".substr($unqiueid_add,$pos,strlen($unqiueid)-$pos);
	$unqiueid_minus = substr($unqiueid_minus,0,$pos).".".substr($unqiueid_minus,$pos,strlen($unqiueid)-$pos);
	$num = get_call_log_inbound($unqiueid_add,$user);
	if($num == 0){
		$num = get_call_log_outbound($unqiueid_add,$user);
	}
	if($num == 0){
		$num = get_call_log_inbound($unqiueid_minus,$user);
	}
	if($num == 0){
		$num = get_call_log_outbound($unqiueid_minus,$user);
	}
	if($num == 0){
		$num = get_sound_file_other($unqiueid,$phone);
	}
	if($num == 0){
		$num = get_sound_file_other($unqiueid_add,$phone);
	}
	if($num == 0){
		$num = get_sound_file_other($unqiueid_minus,$phone);
	}
	if($num == 0){
		echo "录音不存在，原因可能是以下两种：<br>1、电话未接通（客户来电时座席未接听；拨打外线时无法接通或无人接听）；<br>2、电话接通后断开；<br>";
	}
	
}
function get_call_log_inbound($unqiueid,$user){
	require("dbconnect_report.php");
	if(empty($user)){
		$stmt="SELECT location,filename FROM v_recording_log WHERE inbound_uniqueid='$unqiueid'";
	}else{
		$stmt="SELECT location,filename FROM v_recording_log WHERE inbound_uniqueid='$unqiueid' and user='$user'";
	}
	
	if ($DB) {echo "|$stmt|\n";}
	$rslt=mysql_query($stmt, $link);
	while($row=mysql_fetch_array($rslt)){

		$location[] = $row[0];
		$filename[] = $row[1];
	}
	$num= count($location);
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
	if(empty($user)){
		$stmt="SELECT location,filename FROM v_recording_log WHERE outbound_uniqueid='$unqiueid'";
	}else{
		$stmt="SELECT location,filename FROM v_recording_log WHERE outbound_uniqueid='$unqiueid' and user='$user'";
	}
	//echo $stmt;exit;
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
function get_sound_file_other($unqiueid,$phone){
	require("dbconnect_report.php");
	$stmt="SELECT number_dialed,start_epoch FROM call_log WHERE uniqueid='$unqiueid'";
	//echo $stmt . "<br>";
	if ($DB) {echo "|$stmt|\n";}
	$rslt = mysql_query($stmt, $link);
	$row = mysql_fetch_array($rslt);
	if(!empty($row)){
		$number_dialed = $row[0];
		$start_epoch = $row[1];
	}else{
		return 0;
	}
	$start_time = $start_epoch - 10;
	$end_time = $start_epoch + 10;
	$stmt="SELECT location,filename FROM recording_log WHERE location like '%$phone-all.%' and start_epoch >= $start_time and start_epoch <= $end_time";
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
function writelog($temp){
		$efp = fopen ("recording.txt", "a");
		fwrite ($efp, "$temp\n");
		fclose($efp);
}
?>

