<?php
	session_start();
	$pre_url	= "http://10.201.209.200/ehsn/et1/ui/internet/cti/screens";
//	$phone_number	= $_GET['phone_number'];

	$option_type		= $_POST['option_type'];
	$option_value		= $_POST['option_value'];
	$phone_type			= $_POST['phone_type'];
	$area_code_YN		= $_POST['area_code_YN'];
	$item_id			= $_POST['item_id'];

//	$getCustomerPhoneNumber = $pre_url."/getCustomerPhoneNumber.jsp?OptionType=$option_type&OptionValue=$option_value&PhoneType=$phone_type&AreaCode_YN=$area_code_YN&ItemID=$item_id";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script language="JavaScript" type="text/javascript" src="./common.js"></script>
<script language="JavaScript" type="text/javascript" src="./general.js"></script>
<script language="JavaScript" type="text/javascript">

function checkData(form)
{
	with(form)
	{
//			if($('RadioGroup_type').value == '')
//			{
//				alert("小结项目不能为空");
//				return false;
//			}
	
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
function setPhoneNum(){
	var xmlHttp = false;
	var result;
	var option_type		= document.getElementById("option_type").value;
	var option_value	= document.getElementById("option_value").value;
	var phone_type		= document.getElementById("phone_type").value;
	var area_code_YN	= document.getElementById("area_code_YN").checked;
	var item_id			= document.getElementById("item_id").value;
	if(option_value == ""){
		alert("请输入客户电话依据条件！");
		return false;
	}
	if(area_code_YN == true){
		area_code_YN = 'Y';
	}else{
		area_code_YN = 'N';
	}
	
		  if(window.ActiveXObject){ xmlHttp = new ActiveXObject("Microsoft.XMLHTTP"); }
		  else if(window.XMLHttpRequest){ xmlHttp = new XMLHttpRequest(); }
		  if(xmlHttp){
			var queryString =  "&option_type="+option_type+"&option_value="+option_value+"&phone_type="+phone_type+"&area_code_YN="+area_code_YN+"&item_id="+item_id;
			xmlHttp.open("POST", "A_ehsn_phone_number.php", true);
			xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
			xmlHttp.send(queryString);
			xmlHttp.onreadystatechange = function() {
			  if (xmlHttp.readyState == 4 && xmlHttp.status == 200){
				//alert(xmlHttp.responseText);
				var obj = new Object(); 
				obj.name = xmlHttp.responseText; 
				if(xmlHttp.responseText == ""){
					alert("无记录！");
					return false;
				}
				window.returnValue = obj; 
				window.close(); 
			  }
			};
			delete xmlHttp;
		 
	}
    
}


</script>

<title>查询客户电话</title>
</head>
<body>
	<form id="form1" action="A_ehsn_phone_number.php"  name="logging" method='POST' onSubmitXXX="return checkData(this)">
	<table width="100%" border="0">
		  <tr>
			<td height="133" align="right"></td>
			<td>
			  <fieldset>
			  <legend align="center" ><strong>请输入要进行Call Back的电话咨讯</strong></legend>
			  <table width="80%" border="0">
			  <tr>
				<td nowrap="nowrap">客户电话依据条件：</td>
				<td>
					<select name="option_type" id="option_type">
					  <option value="01">依订单</option>
					  <option value="02">依销退单</option>
					  <option value="03">依客代</option>
					  <option value="04">依身分ID</option>
					  <option value="05">依地址序号</option>
					</select>        
				</td>
				<td><input type="text" name="option_value" id="option_value" /></td>
				<td nowrap="nowrap">订单項目代号:</td>
				<td><input type="text" name="item_id" id="item_id" /></td>
			  </tr>
			  <tr>
				<td nowrap="nowrap">电话类型:</td>
				<td>
					<select name="phone_type" id="phone_type">
					  <option value="01">联系地手机</option>
					  <option value="02">联系地市話</option>
					  <option value="03">配送地手机</option>
					  <option value="04">配送地市話</option>
					</select>        
				</td>
				<td nowrap="nowrap">是否加区号:</td>
				<td><input name="area_code_YN" type="checkbox" id="area_code_YN" value="Y" /></td>
				<td>&nbsp;</td>
			  </tr>
			  </table>
			  </fieldset>
			  </td>
			<td>&nbsp;</td>
		  </tr>
		  <tr>
			<td align="right">&nbsp;</td>
			<td align="center"><input type="button" name="Submit" value="查询" onClick="setPhoneNum()" />
			  <input type="button" name="Submit2" value="取消" onClick="window.close();"></td>
			<td>&nbsp;</td>
		  </tr>
	</table>
	</form>
</body>
</html>

