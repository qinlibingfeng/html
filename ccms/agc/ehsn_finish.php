<?php
	ini_set('display_errors','On');
	session_start();
	
	include("./ehsn_et1_config.php");
	//echo $_SESSION['customerid']."<hr>" ;
//	echo $_SESSION['greeting']."<hr>" ;
	//echo $_SESSION['contactid']."<hr>" ;
	
	$customerid	= $_SESSION['customerid'];
	unset($_SESSION['customerid']);
	$contactid			= trim($_SESSION['contactid']);
	$contactid = str_replace("<CONTACTID>", "", $contactid);
	$contactid = str_replace("</CONTACTID>", "", $contactid);
	$pre_url	= $_SESSION['et1url'];
	$pre_url_bak= "http://10.201.209.204/AgentID";
	$phone_number	= $_GET['phone_number'];

	$userloginid	= $_GET['userloginid'];
	$canpaign		= $_GET['canpaign'];
	$dn				= $_GET['dn'];
	$vdn			= $_GET['vpn'];
	$ivrpath		= $_GET['ivrpath'];
	$ani			= $_GET['ani'];
	$connid			= $_GET['connid'];
	$contacttype	= $_GET['contacttype'];
	$phone_number	= $_GET['phone_number'];
	$calltype		= $_GET['calltype'];
	//echo $userloginid . '-' . $canpaign . '-' . $dn . '-' . $vdn . '-' . $ivrpath . '-' . $ani . '-' . $connid . '-' . $contacttype . '-' . $phone_number . '-' . $calltype;
	//exit;
	//inbound insert history
		//yanson@20100901
		//$contactid = $contactid;
		//echo $contactid;
		$update_history_url = $pre_url."/updateContactHistory.".$_SESSION['etlsuffix']."?contactid=$contactid&actioncode=2&customerid=$customerid";
		$update_history_url_bak = $pre_url_bak."/updateContactHistory.asp?contactid=$contactid&actioncode=2&customerid=$customerid";
		//echo $update_history_url."<hr>";//file
		$arr_job	= file($update_history_url);
		//var_dump($arr_job);
		if(!$arr_job){
			$arr_job	= @file($update_history_url_bak);
		}
	
	

//	$phone_number	= '020-83142100';
//	$phone_number	= '13414341539';
	$phone_len		= strlen($phone_number);

	$get_cwc_url = $pre_url."/getCWC.".$_SESSION['etlsuffix'];
	//echo $get_cwc_url;
	$get_cwc_url_bak = $pre_url_bak."/getCWC.asp";
	

	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<script language="JavaScript" type="text/javascript" src="./common.js"></script>
	<link rel="stylesheet" href="jquery.treeview.css" />
	<link rel="stylesheet" href="screen.css" />
	
	<script src="lib/jquery.js" type="text/javascript"></script>
	<script src="lib/jquery.cookie.js" type="text/javascript"></script>
	<script src="jquery.treeview.js" type="text/javascript"></script>
	<script>
	  $(document).ready(function(){
		$("#example").treeview();
	  });
	</script>
<script language="javascript">
function killErrors(){
return true;
}
window.onerror = killErrors;
</script>
<script language="JavaScript" type="text/javascript">

var phone = '<?=$phone_number?>';
var phone_len = '<?=$phone_len?>';
var phone_key = '<?=$phone_key?>';
var insert_history = '<?=$insert_history?>'



function checkData(form)
{
	$("#fieldHideValue").val("");
	$("#example").find("li[id]").each(function(i) {
	 var style_status = $(this).find("ul").attr("style");
	 if(style_status==undefined || style_status == "" || style_status == null){
		$("#fieldHideValue").val($("#fieldHideValue").val() + $(this).attr("id") + ",");
	 }else if(style_status.toLowerCase()=="display: block;" || style_status.toLowerCase()=="display: block"){
		$("#fieldHideValue").val($("#fieldHideValue").val() + $(this).attr("id") + ",");
	 }
	});
	//alert($("#fieldHideValue").val());
	var customerid = document.getElementById("customerid").value;
	var radios=document.getElementsByName("RadioGroup_type");
	var radios_choose = true;
	var checkNum = fucCheckNUM(customerid);
    for(var i=0;i<radios.length;i++)
    {
        if(radios[i].checked==true)
        {
            radios_choose = false;
        }
    }
	if(radios_choose){
		alert("小结项目不能为空");
		return false;
	}
	if(document.getElementById("customerid").value == ""){
		if(!confirm("无客代，是否继续保存？")){
			return false;
		}
	}
	if(customerid != "" && (customerid.substring(0, 1) != '1' || customerid.length != 7 || checkNum != 1)){
		alert("客户代号有误,请检查");
		return false;
	}
	
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
	var getContent = pRetXml.sContent.split("#");
	alert(getContent[0]);
	if(getContent[0] == '小结项目不能为空' || getContent[0] == '客户代号有误,请检查'){
		return false;
	}
	submit_status(getContent[1]);
	if(pRetXml.iFlag == 1)
	{
		//window.close();
	}
}

function submit_status(cwcid){
	parent.document.getElementById("DispoSelection").value = cwcid;

	parent.document.getElementById("iframe_ehsn_ccms_scriptcontent").src = "../agc/ehsn_ccms_scriptcontent.php";
	//parent.close_pause_code();
	parent.DispoSelect_submit2();
	return false;
}
function fucCheckNUM(NUM)
{
	 var i,j,strTemp;
	 strTemp="0123456789";
	 if ( NUM.length== 0)
	  return 0
	 for (i=0;i<NUM.length;i++)
	 {
	  j=strTemp.indexOf(NUM.charAt(i)); 
	  if (j==-1)
	  {
	  //说明有字符不是数字
	   return 0;
	  }
	 }
	 //说明是数字
	 return 1;
}


</script>

<title>web form</title>
</head>

<body onloadxx="create_file()">
<?php
	$arr_job	=file($get_cwc_url);
	if(!$arr_job){
		$arr_job	=file($get_cwc_url_bak);
	}

class Tree
{
       public $data=array();
       public $cateArray=array();
      
       function Tree()
       {
            
       }
       function setNode ($id, $parent, $value)
{
       $parent = $parent?$parent:0;
       $this->data[$id]             = $value;
       $this->cateArray[$id]        = $parent;
}
function getChildsTree($id=0)
{
         $childs=array();
         foreach ($this->cateArray as $child=>$parent) 
         {
                   if ($parent==$id) 
                   {
                        $childs[$child]=$this->getChildsTree($child);
                   }
                  
         }
         return $childs;
}
function getChilds($id=0)
{
         $childArray=array();
         $childs=$this->getChild($id);
         foreach ($childs as $child) 
         {
                   $childArray[]=$child;
                   $childArray=array_merge($childArray,$this->getChilds($child));
         }
         return $childArray;
}
function getChild($id)
{
         $childs=array();
         foreach ($this->cateArray as $child=>$parent) 
         {
                   if ($parent==$id) 
                   {
                        $childs[$child]=$child;
                   }
         }
         return $childs;
}
//单线获取父节点
function getNodeLever($id)
{
         $parents=array();
         if (key_exists($this->cateArray[$id],$this->cateArray)) 
         {
                   $parents[]=$this->cateArray[$id];
                   $parents=array_merge($parents,$this->getNodeLever($this->cateArray[$id]));
         }
         return $parents;
}
function getLayer($id,$preStr='|-')
{
         return str_repeat($preStr,count($this->getNodeLever($id)));
}
function getValue ($id)
{
       return $this->data[$id];
} // end func
}
$Tree = new Tree("请选择分类");
if($_SESSION['etlsuffix'] == "jsp")
{
	foreach($arr_job  as $key => $xml_value)
	{
//		print_r($xml_value);
		if(trim($xml_value) != '' && trim($xml_value) != '</EOF>')
		{
//			print_r($xml_value);
			$xml = simplexml_load_string( iconv("gbk", "UTF-8", $xml_value));
//			$xml = simplexml_load_string( $xml_value);

			/* Search for <a><b><c> */
			$result = $xml->xpath('C1');
			while(list( , $node) = each($result)) {
//				echo 'C1: ',$node,"\n<hr>";
				$c1		= $node;
			}

			$result = $xml->xpath('C2');
			while(list( , $node) = each($result)) {
//				echo 'C2: ',$node,"\n<hr>";
				$c2		= $node;
			}

			$result = $xml->xpath('C3');
			while(list( , $node) = each($result)) {
//				echo 'C3: ',$node,"\n<hr>";
				$c3		= $node;
//				$c3		= iconv("UTF-8", "gbk", trim($node));//$node;
//				echo 'C3: ',$c3,"\n<hr>";
			}
			@$arr_cwc_data[$c1][$c2]	= "$c3";

			$arr_cwc_c2	= $c2;

			$Tree->setNode(trim($c1), trim($c2), "$c3");

		}
	}
}else{
	$dom = new domDocument;
	$xmlstr = "<EOF>".iconv("gbk", "UTF-8", $arr_job[0]);

	$dom->loadXML($xmlstr);


	$s = simplexml_import_dom($dom);
	foreach($s as $xml_value){
		
		$c1		= $xml_value->C1;

		$c2		= $xml_value->C2;
			
		$c3		= $xml_value->C3;
		@$arr_cwc_data[$c1][$c2]	= "$c3";

		$arr_cwc_c2	= $c2;

		$Tree->setNode(trim($c1), trim($c2), "$c3");

		
	}
}
$category = $Tree->getChilds();
?>
<style>
  .disp_tb
  {
    font-size:13px;
	color:#676767;
  }

  .disp_tb td
  {
    vertical-align:top;
  }
  .f_title
  {
    font-weight:bold;
  }
</style>

<form id="form1" action="A_ehsn_finish.php"  name="logging" method='POST' onSubmit="return checkData(this)">
<input type="hidden" value="<?= $canpaign ?>" name="canpaign" id="canpaign" />
<table width="350px" border="0" class="disp_tb" align="center">
  <tr>
    <td colspan=3>
	<ul id="example" class="filetree">
	<?php
	$str ="";
	$id_arr = array();
	function checkResult($var){
		$fieldHideValue	= $_SESSION['fieldHideValue'];
		if(!strstr($fieldHideValue,$var.",")){
			return " class='closed' ";
		}else{
			return " ";
		}
	}
	foreach ($category as $key=>$id)
	{
		$lable	= $Tree->getValue($id);

		if(count($Tree->getNodeLever($id)) == 0)
		{
			$str = $str . "</ul></li><li" . checkResult("file_top_" . $id) . "id='file_top_" . $id . "'><span class='folder'>".$Tree->getLayer($id, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;').$Tree->getValue($id)."</span><ul>";
			$id_arr[]= $id;
			//echo "<font class=f_title>".$Tree->getLayer($id, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;').$Tree->getValue($id)."</font>\n<br>";
	    }
		else
		{
			$str = $str . "<li><span><input type='radio' value='" . $id . "#" . $lable . "' name='RadioGroup_type'>".$Tree->getValue($id)."</span></li>";
			//echo $Tree->getLayer($id, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;')."<label>
	     //<input type=\"radio\"  name=\"RadioGroup_type\" value=\"$id#$lable\" />".$Tree->getValue($id)."</label>\n<br>";
	    }
	}
		$str = substr($str,10) . "</ul></li>";
		echo $str;
		
	?>
	</ul>
	</td>
  </tr>
   <tr>
    <td align="right">客代</td>
    <td>
	<input type="hidden" id="fieldHideValue" name="fieldHideValue" value=""/>
	<input name="customerid" size="5" maxlength=13 type="text" id="customerid" value="<?=$customerid?>" />
	</td>
    <td>&nbsp;</td>
    </tr>
    <tr>
       <td align="right" valign="top">备注</td>
       <td><textarea name="comments" cols="30" rows="5" id="comments"></textarea></td>
       <td>&nbsp;</td>
    </tr>
  <tr>
    <td align=center colspan=3><input type="submit" name="Submit" value="保存电话小结"/></td>
  </tr>
</table>
</form>
</body>
</html>

