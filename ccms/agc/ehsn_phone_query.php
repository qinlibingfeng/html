<?php
	session_start();
	var_dump($_GET);
	$pre_url	= "http://10.201.209.200/ehsn/et1/ui/internet/cti/screens";

	$option_type		= $_GET['OptionType'];
	$option_value		= $_GET['OptionValue'];
	$phone_type			= $_GET['PhoneType'];
	$area_code_YN		= $_GET['AreaCode_YN'];
	$item_id			= $_GET['ItemID'];

	$getCustomerPhoneNumber = $pre_url."/getCustomerPhoneNumber.jsp?OptionType=$option_type&OptionValue=$option_value&PhoneType=$phone_type&AreaCode_YN=$area_code_YN&ItemID=$item_id";
	echo $getCustomerPhoneNumber;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script language="JavaScript" type="text/javascript" src="./common.js"></script>
<script language="JavaScript" type="text/javascript" src="./general.js"></script>

<script language="JavaScript" type="text/javascript">


function slect_phone()
{
	SystemModalDialog2('slect_phone_number.php',700,220)
}
function checkData(form)
{
	with(form)
	{
		ECHOSOFT.Http.upload(id,fnCallBack);
	}
}
function fnCallBack(pNode)
{
	var pRetXml = ECHOSOFT.Dom.actionReturnXml(pNode);
	alert(pRetXml.sContent);
	if(pRetXml.iFlag == 1)
	{
		window.close();
	}
}
function startCall( ){
	//alert(callid);
	var callnum = document.getElementById('phone_num').value;
	//alert(callnum);
	if(callnum == ""){
		alert("请输入手机号码");
		return false;
	}
	parent.document.vicidial_form.MDPhonENumbeR.value = callnum;
	parent.NeWManuaLDiaLCalLSubmiT("NEW");
}
function startCall2( ){
	//alert(callid);
	var callnum = document.getElementById('phone_value2').value;
	//alert(callnum);
	if(callnum == ""){
		alert("请输入手机号码");
		return false;
	}
	parent.document.vicidial_form.MDPhonENumbeR.value = callnum;
	parent.NeWManuaLDiaLCalLSubmiT("NEW");
}
</script>

<title>Manual Dial</title>
</head>
<body>

<form id="form" action="A_ehsn_finish.php"  name="logging" method='POST' onSubmit="return checkData(this)">

<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    <td><input name="phone_value" type="text" id="phone_value" value="" readonly="readonly" />&nbsp;&nbsp;&nbsp;
      <input type="button" name="client_phone" id="client_phone" value="客户电话" onclick="slect_phone()"/> <input type="hidden" name="phone_num" id="phone_num" value="" /></td>
	 
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td><a href="#a" onClick="startCall()" style="color:#000000; font-size:14px">拨打</a></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;&nbsp;&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input name="phone_value2" type="text" id="phone_value2" value="" />&nbsp;&nbsp;&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td><a href="#a" onClick="startCall2()" style="color:#000000; font-size:14px">拨打</a></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;&nbsp;&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><a href="../joomlaehsn" style="color:#000000; font-size:14px" target="_blank">知识库</a></td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
</body>
</html>