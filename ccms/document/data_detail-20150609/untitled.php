<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xHTML1/DTD/xHTML1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<meta http-equiv="Content-Type" content="text/HTML; charset=utf-8" />
<title>亚铭科技电话营销管理系统-录音质检</title>
<link href="/css/main.css?v=2013-07-11" rel="stylesheet" type="text/css">
<link href="/css/day.css" rel="stylesheet" type="text/css">
<script src="/js/jquery-1.8.3.min.js"></script>
<script src="/js/main.js?v=2013-07-11"></script>
<script src="/js/pub_func.js?v=2013-07-11"></script>
<script src="/js/calendar.js"></script>
<script>
  
function do_setquality(){
	 
	if($("#quality_status").val() == ""){
		alert("请选择质检结果！");
		$("#quality_status").focus();
		return false;
	}
	
	if($("#status").val() == ""){
		alert("请选择呼叫结果！");
		$("#status").focus();
		return false;
	}
	
 	//if(confirm("确定提交质检吗？"))	{}else{return false;}
  	  
	$('#load').show();
	var datas="action=callqulity_set&"+$('#form1').serialize()+times;
	 
	$.ajax({
		 
		url: "send.php",
		data:datas,
		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){ 
		
 		 if(json.counts=="1"){
 			 
			$(_DialogInstance.ParentWindow.document).find("#tr_"+$("#index").val()+" td:eq(8)").html("<span class=\"red\">"+$("#status option:selected").text()+"</span>");
			$(_DialogInstance.ParentWindow.document).find("#tr_"+$("#index").val()+" td:eq(9)").html("<span class=\"red\">"+$("#call_des").val()+"</span>");
			$(_DialogInstance.ParentWindow.document).find("#tr_"+$("#index").val()+" td:eq(10)").attr("title","admin质检于："+json.now_time+" 结果为："+$("#quality_status option:selected").text()+" 描述为："+$("#qualitydes").val()).html("<span class=\"red\">"+$("#quality_status option:selected").text()+"</span>");
 			_DialogInstance.ParentWindow.request_tip("<strong>"+$("#phone_number").val()+"</strong> 质检完成！检为："+$("#quality_status option:selected").text(),1);
 			do_stop_wav();
			
		  }else{
			alert(json.des);
		  }
			
		} 
	});
   
}

function show_detail(elm){
 	
	$("."+elm).each(
		function(){
			$(this).toggle();
		}
 	);
	
};

function do_change(){
	$("#isedit").val("yes");
}

</script>
<style>
.data_detail{display:none}
.td_underline td{border-bottom: 1px dotted #ccc; height:24px;line-height:24px}
.td_underline select{*margin-top:1px}
</style>
</head>
<body>
<div id="load" class="load_layer"><img src="/images/loading.gif"align="absmiddle"/>数据加载中...</div>
<script>$(document).ready(function(){
     
		get_select_opt("CG","send.php","get_status_type","status","def_n","&status_type=call_status");
		get_select_opt("0","send.php","get_status_type","quality_status","def_n","&status_type=qua_status");
	 });
	 </script> 
<script>
$(document).ready(function() { 
	
  	$(".td_underline tr:odd").addClass("alt");
	$('#show_details').toggle(function(){
			$('#show_text').html("隐藏客户详情");
 		},function(){
			$('#show_text').html("显示客户详情");
   	});
  	 
	$(":input[type='text']").addClass("inputText").hover(function(){$(this).addClass("inputTextHover")},function(){$(this).removeClass("inputTextHover")}).focus(function(){$(this).removeClass("inputText inputTextHover").addClass("input_focus")}).blur(function(){$(this).addClass("inputText").removeClass("input_focus inputTextHover")});
	
	//if(isIE){ 
		$("#player_").html('<object classid="clsid:22D6F312-B0F6-11D0-94AB-0080C74C7E95" name="wav_player" width="100%" height="64" align="absmiddle" id="wav_player"><param name="FileName" value="172.17.29.253/2013-04-26/20130426-175539_15000228062-all.wav" /><param name="showstatusbar" value="1"><param name="Volume" value="0"><param name="showcontrols" value="1"><embed pluginspage="http://www.microsoft.com/Windows/Downloads/Contents/Products/MediaPlayer/" type="video/x-ms-wmv" id="wav_player_wmp" src="172.17.29.253/2013-04-26/20130426-175539_15000228062-all.wav" autostart="1" showControls="1" volume="0" width="100%" height="64" showstatusbar="1" ></embed></object>');
		 $("#wav_player_wmp").css({"zoom":2,"display":"block"});
	/*}else{
		$("#player_").html('<audio src="" controls="true" id="wav_player" type="audio/mpeg" autoplay="true" volume="0" height="44"></audio>');
	}*/
	var evt=window.event;Calendar.setup({inputField:"call_date",showsTime:true,ifFormat:"%Y-%m-%d %H:%M:%S",timeFormat:"24"});
});
function do_stop_wav(){document.getElementById("wav_player").Filename="";$("#wav_player_wmp").attr("src","");Dialog.close();};


function test(){
	alert($("#status option:selected").index());
	alert($("#status option:selected").val());
	
 }

</script>
 <div class="page_nav">
         <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
         <div class="nav_">当前位置：<a href="javascript:void(0);" id="page_focus">首页</a> &gt; 数据报表 &gt; 录音质检 ：<span class="red">15000228062</span></div>
         <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
     
    </div>
    
    <div class="page_main">
    <table width="98%" align="center" style="margin:4PX;"  border="1" cellpadding="1" cellspacing="0"bordercolor="#eeeeee">
    
        <tr>
          <td  align="center" valign="middle">
           <div id="player_"><object classid="clsid:22D6F312-B0F6-11D0-94AB-0080C74C7E95" name="wav_player" width="100%" height="64" align="absmiddle" id="wav_player"><param name="FileName" value="" /><param name="showstatusbar" value="1"><param name="Volume" value="0"><param name="showcontrols" value="1"><embed pluginspage="http://www.microsoft.com/Windows/Downloads/Contents/Products/MediaPlayer/" type="video/x-ms-wmv" id="wav_player_wmp" src="" autostart="1" showControls="1" volume="0" width="100%" height="64" showstatusbar="1" ></embed></object></div>
           <script>
           	function test_wav(wav){
				document.getElementById("wav_player").Filename="./"+wav+".wav";
				$("#wav_player_wmp").attr("src","./"+wav+".wav");	
				
			}
           </script>
           
           <a href="javascript:void(0)" onclick="test_wav(1)">111111</a> <a href="javascript:void(0)" onclick="test_wav('m2')">222222</a> 
        </td>
        </tr>
    </table>
    <input type="hidden" name="index" id="index" value="4">
    <input type="hidden" name="get_status" id="get_status" value="0">
    <input type="hidden" name="get_quality_status" id="get_quality_status" value="0">
	<form name="form1" id="form1" method="post" action="">
    
      <input type="hidden" name="phone_number" id="phone_number" value="15000228062">
      <input type="hidden" name="uniqueid" value="1366970139.35117">
      <input type="hidden" name="lead_id" value="2626959">
      <input type="hidden" name="list_id" value="998">
      <input type="hidden" name="campaign_id" value="20121225">
      <input type="hidden" name="quserid" value="admin">
      <input type="hidden" name="old_status" value="CG">
      <input type="hidden" name="isedit" id="isedit" value="">
      <input type="hidden" name="qua_id" id="qua_id" value="">
      <input type="hidden" name="recording_id" id="recording_id" value="926165">
  <table width="98%" align="center" style="margin:4px;"  border="0" cellpadding="2" cellspacing="0" bordercolor="#eeeeee" class="td_underline">
 		
		<tr>
		  <td width="100" height="22" align="right" nowrap="nowrap">质检人：</td>
		  <td height="22">Admin[admin]</td>
		  <td width="100" align="right" nowrap="nowrap" >业务活动：</td>
		  <td class="deepgreen">2011奥迪销售线索跟踪调研</td>
      </tr>		
		<tr>
			<td width="100" height="22" align="right" nowrap="nowrap">呼叫号码：</td>
		  <td height="22" colspan="3" class="blue"><span style="margin-right:10px;float:left">15000228062</span> <span class="gray" style="margin-right:10px; float:left">手动</span><span class="gray" style="margin-right:10px; float:left"><?php 
		  $s1=strtotime(date("Y-m-d H:i:s"));
		  $s2=strtotime(date("Y-m-d H:i:s",strtotime(" -3 hour")));
		  
		  
		  echo date("Y-m-d H:i:s",strtotime(" -3 hour"))."<br><br>"; 
		  
		  echo $s1-$s2."<br><br>"; 
		  ?></span><a href='javascript:void(0);' class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false' id="show_details" onclick="show_detail('data_detail')" priv="true" ><img src="/images/icons/icon021a4.gif" /><b id="show_text">显示详细信息&nbsp;</b></a></td>
	  </tr>		
      <tr class=" ">
        <td height="22" align="right" nowrap="nowrap">标题：</td>
          <td height="22"><input name="title" type="text" id="title" value="" size="30" class="s_input" onchange="do_change();" /></td>
        <td align="right" nowrap="nowrap" >名字：</td>
          <td ><input maxlength="118" size="30" class="s_input" name="list_id" id="list_id" onkeyup="this.value=this.value.replace(/[\d|\\|?|*|#|/|`|&|^|$|']/g,'')"/>onkeyup="this.value=this.value.replace(/\D/g,'')"</td>
      </tr>
      <tr class="data_detail">
          <td height="22" align="right" nowrap="nowrap">中间名：</td>
          <td height="22"><input name="middle_initial" type="text" id="middle_initial" size="30" class="s_input" value="" onchange="do_change();"/></td>
          <td align="right" nowrap="nowrap" >姓氏：</td>
          <td ><input name="last_name" type="text" id="last_name" size="30" class="s_input" value="" onchange="do_change();"/></td>
      </tr>
      <tr class="data_detail">
          <td height="22" align="right" nowrap="nowrap">地址1：</td>
          <td height="22"><input name="address1" type="text" id="address1" size="30" class="s_input" value="" onchange="do_change();"/></td>
          <td align="right" nowrap="nowrap" >地址2：</td>
          <td ><input name="address2" type="text" id="address2" size="30" class="s_input" value="" onchange="do_change();"/></td>
      </tr>
      <tr class="data_detail">
          <td height="22" align="right" nowrap="nowrap">地址3：</td>
          <td height="22"><input name="address3" type="text" id="address3" size="30" class="s_input" value="" onchange="do_change();"/></td>
          <td align="right" nowrap="nowrap" >城市：</td>
          <td ><input name="city" type="text" id="city" size="30" class="s_input" value="" onchange="do_change();"/></td>
      </tr>
      <tr class="data_detail">
          <td height="22" align="right" nowrap="nowrap">地区：</td>
          <td height="22"><input name="state" type="text" id="state" size="30" class="s_input" value="" onchange="do_change();"/></td>
          <td align="right" nowrap="nowrap" >邮编：</td>
          <td ><input name="postal_code" type="text" id="postal_code" size="30" class="s_input" value="" onchange="do_change();"/></td>
      </tr>
      <tr class="data_detail">
	      <td height="22" align="right" nowrap="nowrap">省份：</td>
	      <td height="22"><input name="province" type="text" id="province" size="30" class="s_input" value="" onchange="do_change();"/></td>
	      <td align="right" nowrap="nowrap" >性别：</td>
	      <td ><input name="gender_list" type="text" id="gender_list" size="30" class="s_input" value="U" onchange="do_change();"/> </td>
      </tr>
      <tr class="data_detail">
	      <td height="22" align="right" nowrap="nowrap">备用电话：</td>
	      <td height="22"><input name="alt_phone" type="text" id="alt_phone" size="30" class="s_input" value="" onchange="do_change();"/></td>
	      <td align="right" nowrap="nowrap" >邮箱：</td>
	      <td ><input name="email" type="text" id="email" size="30" class="s_input" value="" onchange="do_change();"/></td>
      </tr>
      <tr class="data_detail">
	      <td height="22" align="right" nowrap="nowrap">生日：</td>
	      <td height="22" ><input name="date_of_birth" type="text" id="date_of_birth" size="30" class="s_input" value="" onchange="do_change();"/></td>
          <td align="right" >呼叫时间：</td>
	      <td ><input name="old_call_date" type="hidden" id="old_call_date" value="2013-04-26 17:55:45" /><input name="call_date" type="text" id="call_date" size="30" class="s_input" value="2013-04-26 17:55:45" /></td>
      </tr>
       <tr class="data_detail">
	      <td height="22" align="right" nowrap="nowrap">客户备注：</td>
	      <td height="22" colspan="3" ><input name="comments" type="text" id="comments" size="30" class="s_input" value="" onchange="do_change();"/></td>
      </tr>
      <div id="2222">
      <tr >
			<td width="100" height="22" align="right" nowrap="nowrap">客户名称：</td>
			<td height="22"> </td>
			<td width="100" align="right" nowrap="nowrap" >上次质检人：</td>
			<td >
			</td>
	  </tr>	   
	  </div>
		<tr>
			<td width="100" height="22" align="right" nowrap="nowrap">人员工号：</td>
		  <td height="22">柯福英[3060] <span class="gray" style="margin-right:10px"> 分机：3060</span></td>
		  <td width="100" align="right" nowrap="nowrap" >上次质检时间：</td>
		  <td ><input type="button" name="button" id="button" value="按钮"  onclick="test()" /></td>
      </tr>
                
		<tr>
        	<td width="100" align="right" nowrap="nowrap" >质检结果：</td>
		  <td >
          <select name="quality_status"  class="s_option" id="quality_status" >
          
	      </select>
          </td>
			<td width="100" height="22" align="right" nowrap="nowrap">呼叫结果：</td>
		  <td height="22">
          
          <select name="status"  class="s_option" id="status" >
	         
          </select>
          
          </td>
		  
      </tr>
		<tr>
		  <td width="100" align="right" nowrap="nowrap" >质检描述：</td>
		  <td ><textarea name="qualitydes" id="qualitydes" cols="34" style="height:60px" rows="5"></textarea></td>
		  <td width="100" height="22" align="right" nowrap="nowrap">呼叫描述：</td>
		  <td height="22"><textarea name="call_des" id="call_des" cols="34" style="height:60px" rows="5"></textarea></td>
	  </tr>		
		
  	  
    </table>
	</form>

 </div>


</body>
</html>
 