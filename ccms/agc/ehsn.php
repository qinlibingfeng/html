<?php
	//echo "hello";exit;
	
	$_SESSION['customerid'] = '';
	$_SESSION['greeting']	= '';
	$_SESSION['contactid']	= '';

	$pre_url	= "http://10.201.209.200/ehsn/et1/ui/internet/cti/screens";
	$pre_url_bak= "http://192.168.108.43/ehsn/et1/ui/internet/cti/screens";
	
//	$phone_number	= $_GET['phone_number'];
	$userloginid	= $_GET['userloginid'];
	$dn				= $_GET['dn'];
	$vdn			= $_GET['vdn'];
	$ivrpath		= $_GET['ivrpath'];
	$ani			= $_GET['ani'];
	$connid			= $_GET['connid'];
	$contacttype	= $_GET['contacttype'];
//	$phone_number	= $_GET['phone_number'];
//	$phone_number	= $_GET['phone_number'];
//	$phone_number	= $_GET['phone_number'];

	$phone_number	= $ani;
	
//echo debug
//	$phone_number	= '020-83142100';
//echo debug
//	$ani			= '13910562931';
//echo debug
//	$ivrpath		= '4298';
//	$phone_number	= '13414341539';
	$phone_len		= strlen($phone_number);	


	$leadphone = $phone_number;


$phone_key = getPhoneCode($phone_number);;
if($phone_key != "0"){
	$phone_key_code  = $phone_key[0];
	$phone_key_phone = $phone_key[1];
	$phone_len		= strlen($phone_key_phone);
	
	$phone_key = "1";
}
//	echo "phone_key---$phone_key <hr>";
	if($vdn == "320"){
		$connid =  substr(time().".".$dn,0,20); 
	}
	$insert_history		= $pre_url."/insertContactHistory.jsp?userloginid=$userloginid&dn=$dn&vdn=$vdn&ivrpath=$ivrpath&ani=$ani&connid=$connid&contacttype=$contacttype";
	//echo $insert_history;
	$insert_history_bak	= $pre_url_bak."/insertContactHistory.asp?userloginid=$userloginid&dn=$dn&vdn=$vdn&ivrpath=$ivrpath&ani=$ani&connid=$connid&contacttype=$contacttype";
	$greeting_url	= $pre_url."/getGreetingbyANI.jsp?ani=$ani&ivrpath=$ivrpath";
	$greeting_url_bak	= $pre_url_bak."/getGreetingbyANI.asp?ani=$ani&ivrpath=$ivrpath";
//	echo $greeting_url."<hr>";

function getPhoneCode($phone){
	$phonecode = array('010','021','022','023','852','853','0310','0311','0312','0313','0314','0315','0316','0317','0318','0319','0335','0570','0571','0572','0573','0574','0575','0576','0577','0578','0579','0580','024','0410','0411','0412','0413','0414','0415','0416','0417','0418','0419','0421','0427','0429','027','0710','0711','0712','0713','0714','0715','0716','0717','0718','0719','0722','0724','0728','025','0510','0511','0512','0513','0514','0515','0516','0517','0517','0518','0519','0523','0470','0471','0472','0473','0474','0475','0476','0477','0478','0479','0482','0483','0790','0791','0792','0793','0794','0795','0796','0797','0798','0799','0701','0350','0351','0352','0353','0354','0355','0356','0357','0358','0359','0930','0931','0932','0933','0934','0935','0936','0937','0938','0941','0943','0530','0531','0532','0533','0534','0535','0536','0537','0538','0539','0450','0451','0452','0453','0454','0455','0456','0457','0458','0459','0591','0592','0593','0594','0595','0595','0596','0597','0598','0599','020','0751','0752','0753','0754','0755','0756','0757','0758','0759','0760','0762','0763','0765','0766','0768','0769','0660','0661','0662','0663','028','0810','0811','0812','0813','0814','0816','0817','0818','0819','0825','0826','0827','0830','0831','0832','0833','0834','0835','0836','0837','0838','0839','0840','0730','0731','0732','0733','0734','0735','0736','0737','0738','0739','0743','0744','0745','0746','0370','0371','0372','0373','0374','0375','0376','0377','0378','0379','0391','0392','0393','0394','0395','0396','0398','0870','0871','0872','0873','0874','0875','0876','0877','0878','0879','0691','0692','0881','0883','0886','0887','0888','0550','0551','0552','0553','0554','0555','0556','0557','0558','0559','0561','0562','0563','0564','0565','0566','0951','0952','0953','0954','0431','0432','0433','0434','0435','0436','0437','0438','0439','0440','0770','0771','0772','0773','0774','0775','0776','0777','0778','0779','0851','0852','0853','0854','0855','0856','0857','0858','0859','029','0910','0911','0912','0913','0914','0915','0916','0917','0919','0971','0972','0973','0974','0975','0976','0977','0890','0898','0899','0891','0892','0893');

	for($i=0;$i<count($phonecode);$i++){
		if(substr($phone,0,strlen($phonecode[$i])) == $phonecode[$i]){
			return array($phonecode[$i],substr($phone,strlen($phonecode[$i]),strlen($phone)-strlen($phonecode[$i])));
		}else{
			return "0";
		}
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<script language="JavaScript" type="text/javascript">

var phone = '<?=$phone_number?>';
var phone_len = '<?=$phone_len?>';
var phone_key = '<?=$phone_key?>';
var insert_history = '<?=$insert_history?>'


function create_file(cid)
{
	var fso, f1,fpath,ts;
	fso = new ActiveXObject("Scripting.FileSystemObject");
	if(cid == 0){
		if(phone_key == '0')
		{
			f1 = fso.CreateTextFile("C:/CConnector/" + "p;"+ phone + ";" + phone_len ,true);
			//fpath = "C:/CConnector/" + "p;"+ phone + ";" + phone_len;
		}
		else
		{
			f1 = fso.CreateTextFile("C:/CConnector/" + "p;<?= $phone_key_phone ?>;" + phone_len + ";<?= $phone_key_code ?>" ,true);
			//fpath = "C:/CConnector/" + "p;"+ phone + ";" + phone_len + ";" + phone_key;
		}
	}else{
		f1 = fso.CreateTextFile("C:/CConnector/" + "c;"+ cid ,true);
		//fpath = "C:/CConnector/" + "c;"+ cid;
	}
	f1.Close();
}
</script>
<title>web form</title>
</head>

<body>
<?php
	function insert_history($url,$insert_history_bak) 
	{
//		echo $url."<hr>";//file
//echo $url;
		$arr_job	= @file($url);
		var_dump($arr_job);exit;
		if(!$arr_job){
			$arr_job	=@file($insert_history_bak);
		}
		$contactid	= $arr_job[11];
		
		
		$_SESSION['contactid'] = $contactid;
//		print_r($arr_job);
//		echo "---------<hr>"; 
	}

	//新增一个客户联系历史纪录
	insert_history($insert_history,$insert_history_bak);
	//echo $greeting_url."<hr>";

	//获取问候语
	$arr_greeting	= @file($greeting_url);
	//var_dump($arr_greeting);
	if(!$arr_greeting){
			$arr_greeting	=@file($greeting_url_bak);
	}
	$xml_value		=  $arr_greeting[12];
//	echo $xml_value;
	$greeting_str	= str_replace("<CUSTOMERID>", "", "$xml_value");
	$greeting_str	= str_replace("</GREETING>", "", "$greeting_str");
//	$greeting_str	= str_replace("</CUSTOMERID><GREETING>", ",", "$greeting_str");

	$arr_greeting_value	= explode('</CUSTOMERID><GREETING>',$greeting_str);
	$customerid		= $arr_greeting_value[0];
	//var_dump($customerid);
	if(empty($customerid)){
		$cid = 0;
	}else{
		$cid = $customerid;
	}
	echo "<script>";
	echo "create_file(".$cid.");";
	echo "</script>";
	$greeting		= $arr_greeting_value[1];
//	echo 'CUSTOMERID: ',$customerid,"\n<hr>";
//	echo 'greeting: ',  $greeting,"\n<hr>";
	echo iconv("gbk", "UTF-8", $greeting);  //,"\n<hr>";
	$_SESSION['customerid'] = $customerid;
	$_SESSION['greeting']	= $greeting;
	$contactid = $_SESSION['contactid'];
	$update_history_url = $pre_url."/updateContactHistory.jsp?contactid=$contactid&actioncode=1&customerid=$customerid";
	//echo $update_history_url;
	$update_history_url_bak = $pre_url_bak."/updateContactHistory.asp?contactid=$contactid&actioncode=1&customerid=$customerid";
//		echo $update_history_url."<hr>";//file
	$arr_job	=@file($update_history_url);
	if(!$arr_job){
		$arr_job	=@file($update_history_url_bak);
	}
?>
</body>
</html>

